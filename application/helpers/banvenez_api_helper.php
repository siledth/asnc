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
