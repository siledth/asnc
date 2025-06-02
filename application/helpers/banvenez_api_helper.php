<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// function verify_payment_with_banvenez($data, $api_key)
// {
//     $url = 'https://bdvconciliacion.banvenez.com/getMovement';

//     // Intentar con cURL primero
//     if (function_exists('curl_init')) {
//         $ch = curl_init();

//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//         curl_setopt($ch, CURLOPT_HTTPHEADER, [
//             'Content-Type: application/json',
//             'X-API-KEY: ' . $api_key
//         ]);

//         $response = curl_exec($ch);
//         $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//         if (curl_errno($ch)) {
//             return ['success' => false, 'message' => 'Error en la conexión: ' . curl_error($ch)];
//         }

//         curl_close($ch);
//     } else {
//         // Fallback con file_get_contents (menos recomendado)
//         $options = [
//             'http' => [
//                 'header'  => [
//                     'Content-Type: application/json',
//                     'X-API-KEY: ' . $api_key
//                 ],
//                 'method'  => 'POST',
//                 'content' => json_encode($data),
//                 'ignore_errors' => true
//             ]
//         ];

//         $context = stream_context_create($options);
//         $response = file_get_contents($url, false, $context);
//         $http_code = isset($http_response_header) ? (int)substr($http_response_header[0], 9, 3) : 500;
//     }

//     if ($http_code != 200) {
//         return ['success' => false, 'message' => 'Error HTTP: ' . $http_code];
//     }

//     return json_decode($response, true);
// }

function verify_payment_with_banvenez($data, $api_key)
{
    $url = 'https://bdvconciliacion.banvenez.com/getMovement';

    $payload = json_encode($data);

    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\nX-API-KEY: $api_key\r\n",
            'method'  => 'POST',
            'content' => $payload,
            'ignore_errors' => true // Para capturar respuestas HTTP aunque sean 4xx/5xx
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ];

    $context = stream_context_create($options);

    try {
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            return [
                'error' => 'Error al conectar con el servicio de verificación',
                'http_response' => $http_response_header ?? []
            ];
        }

        $response = json_decode($result, true);

        // Si hay error en el JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'error' => 'Respuesta no válida del servidor',
                'raw_response' => $result
            ];
        }

        // Verificar si es un error HTTP (pero con cuerpo JSON)
        if (isset($http_response_header[0]) && strpos($http_response_header[0], '200') === false) {
            $response['http_status'] = $http_response_header[0];
        }

        return $response;
    } catch (Exception $e) {
        return [
            'error' => 'Excepción al contactar el servicio: ' . $e->getMessage()
        ];
    }
}


function consulta_movimientos_banvenez_v2($api_key, $referencia = '')
{
    // $url = 'https://bdvconciliacionqa.banvenez.com:444/apis/bdv/consulta/movimientos/v2';//desarrollo
    $url = ' https://bdvconciliacion.banvenez.com/apis/bdv/consulta/movimientos/'; // produccion



    $data = [
        'cuenta'      => '01020552270000042877',
        'fechaIni'    => date('d/m/Y', strtotime('-1 month')),
        // 'fechaIni'    => '01/06/2025',
        // 'fechaFin'    => '30/06/2025',
        'fechaFin'    => date('d/m/Y'),
        'tipoMoneda'  => 'VES',
        'nroMovimiento' => '' // Se envía vacío según tu necesidad
    ];

    $options = [
        'http' => [
            'header'        => "Content-Type: application/json\r\nX-API-KEY: $api_key\r\n",
            'method'        => 'POST',
            'content'       => json_encode($data),
            'ignore_errors' => true, // Importante para manejar errores HTTP
            'timeout'       => 30
        ],
        'ssl' => [
            'verify_peer'      => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];

    try {
        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context); // Usamos @ para suprimir advertencias y manejar el error de forma controlada

        if ($result === FALSE) {
            // Manejar errores de conexión o red antes de intentar decodificar JSON
            $error = error_get_last();
            return [
                'success' => false,
                'error'   => ['code' => 'NETWORK_ERROR', 'message' => 'Error de conexión con la API: ' . ($error['message'] ?? 'Desconocido')]
            ];
        }

        $response = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success'      => false,
                'error'        => ['code' => 'JSON_PARSE_ERROR', 'message' => 'Respuesta de la API inválida o no es JSON'],
                'raw_response' => $result
            ];
        }

        // Verificar el 'code' de la respuesta de la API, si existe y es un indicador de error
        if (isset($response['code']) && $response['code'] !== '1000') {
            return [
                'success' => false,
                'error'   => ['code' => $response['code'], 'message' => $response['message'] ?? 'Error desconocido de la API']
            ];
        }

        // Si se proporciona referencia, filtrar resultados
        if (!empty($referencia) && isset($response['data']) && is_array($response['data'])) {
            foreach ($response['data'] as $movimiento) {
                // Asegúrate de que 'referencia' exista y coincida exactamente
                if (isset($movimiento['referencia']) && $movimiento['referencia'] == $referencia) {
                    return [
                        'success' => true,
                        'data'    => $movimiento, // Solo el movimiento coincidente
                        'message' => 'Referencia encontrada correctamente.'
                    ];
                }
            }
            // Si el bucle termina y no se encontró la referencia
            return [
                'success' => false,
                'error'   => ['code' => 'REFERENCE_NOT_FOUND', 'message' => 'La referencia ' . $referencia . ' no fue encontrada en los movimientos.'],
                'full_response' => $response // Puedes incluir la respuesta completa para depuración
            ];
        }

        // Si no se proporcionó una referencia o la API devolvió sin 'data'
        // Esto depende de si esperas que la API siempre devuelva 'data'
        // Si no se espera filtrar por referencia, puedes devolver toda la respuesta:
        return [
            'success' => true,
            'data'    => $response['data'] ?? [], // Devuelve los datos o un array vacío si no hay
            'message' => 'Consulta de movimientos exitosa (sin filtrar por referencia).'
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'error'   => ['code' => 'EXCEPTION', 'message' => 'Excepción en el helper: ' . $e->getMessage()]
        ];
    }
}
