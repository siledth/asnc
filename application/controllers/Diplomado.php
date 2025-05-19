<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Diplomado extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ReporteG_model');
        // $this->load->library('pagination');
        //$this->load->model('Tablas_model');
    }

    public function Registrar_diplomado()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['exonerado'] = $this->Diplomado_model->consultar_dip();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('diplomado/Cdiplomado.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function  conciliado()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['exonerado'] = $this->Diplomado_model->consultar_dip();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('diplomado/conciliado.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function registrar_b()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'name_d' => $this->input->POST('name_d'),
            'fdesde' => $this->input->POST('fdesde'),
            'fhasta' => $this->input->POST('fhasta'),
            'id_modalidad' => $this->input->POST('id_modalidad'),
            'topmax' => $this->input->POST('topmax'),
            'topmin' => $this->input->POST('topmin'),
            'pay' => $this->input->POST('pay'),
            'd_hrs' => $this->input->POST('d_hrs'),
            'pronto_pago' => $this->input->POST('pronto_pago'),
            'pago2desde' => $this->input->POST('pago2desde'),
            'pago2hasta' => $this->input->POST('pago2hasta'),



        );
        $data = $this->Diplomado_model->registrar_b($data);
        echo json_encode($data);
    }



    public function reporteG()
    {
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('reportes/reporte_RNCE.php');
        $this->load->view('templates/footer.php');
    }
    public function generarReporte()
    {
        header('Content-Type: application/json');

        try {
            $fechad = $this->input->post('fechad');
            $fechah = $this->input->post('fechah');

            if (empty($fechad) || empty($fechah)) {
                throw new Exception('Debe especificar ambas fechas');
            }

            if (strtotime($fechah) < strtotime($fechad)) {
                throw new Exception('La fecha hasta no puede ser menor que la fecha desde');
            }

            $data = $this->ReporteG_model->obtenerTotales($fechad, $fechah);

            if (empty($data)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'No se encontraron resultados para el rango de fechas especificado',
                    'data' => null
                ]);
                return;
            }

            echo json_encode([
                'success' => true,
                'data' => $data,
                'total_programacion' => $data['total_programacion'] ?? 0,
                'total_notificadas' => $data['total_notificadas'] ?? 0
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }



    public function getDiplomadoInfo($idDiplomado)
    {
        $this->output->set_content_type('application/json');

        if (empty($idDiplomado)) {
            echo json_encode(['success' => false, 'message' => 'ID de diplomado no proporcionado']);
            return;
        }

        $diplomado = $this->Diplomado_model->get_diplomado_by_id($idDiplomado);

        if ($diplomado) {
            echo json_encode(['success' => true, 'data' => $diplomado]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Diplomado no encontrado']);
        }
    }
    public function verificar_pago()
    {
        $this->output->set_content_type('application/json');

        // Validar método POST
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Método no permitido'
            ]));
        }

        // Validar campos requeridos
        $required_fields = ['telefonoPagador', 'referencia', 'fechaPago', 'importe', 'bancoOrigen'];
        foreach ($required_fields as $field) {
            if (empty($this->input->post($field))) {
                return $this->output->set_output(json_encode([
                    'success' => false,
                    'message' => 'Faltan campos requeridos: ' . $field
                ]));
            }
        }

        // Preparar datos para la API (usando los mismos nombres que en el ejemplo funcional)
        $datos_api = [
            'telefonoPagador' => $this->input->post('telefonoPagador'),
            'telefonoDestino' => $this->input->post('telefonoDestino') ?: '',
            'referencia' => $this->input->post('referencia'), // Nota: verifica si es 'referencia' o 'referencia'
            'fechaPago' => $this->input->post('fechaPago'),
            'importe' => $this->input->post('importe'),
            'bancoOrigen' => $this->input->post('bancoOrigen')
        ];

        // Llamar al helper
        $this->load->helper('banvenez_api');
        $api_key = $this->config->item('banvenez_api_key');
        $response = verify_payment_with_banvenez($datos_api, $api_key);

        // Debug: Loggear la respuesta (opcional)
        // log_message('debug', 'Respuesta de Banvenez: ' . print_r($response, true));

        // Procesar respuesta de manera robusta
        if (!is_array($response)) {
            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Respuesta inválida del servidor de pagos',
                'error' => $response
            ]));
        }

        // Caso 1: Respuesta con estructura esperada (con code)
        if (isset($response['code'])) {
            $code = (int)$response['code'];

            // Código 1000 = éxito según tu ejemplo
            if ($code === 1000) {
                return $this->output->set_output(json_encode([
                    'success' => true,
                    'message' => 'Pago verificado correctamente'
                ]));
            }

            // Otros códigos (como 1010 en tu ejemplo)
            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => $response['message'] ?? 'Pago no verificado',
                'code' => $code,
                'error' => $response
            ]));
        }

        // Caso 2: Respuesta con error HTTP
        if (isset($response['error'])) {
            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Error en la comunicación con el servidor de pagos',
                'error' => $response['error']
            ]));
        }

        // Caso 3: Respuesta inesperada
        return $this->output->set_output(json_encode([
            'success' => false,
            'message' => 'Respuesta inesperada del servidor de pagos',
            'error' => $response
        ]));
    }




    public function preinscrip()
    {


        $this->load->view('templates/headerlog');
        $this->load->view('templates/navbarlog');
        $this->load->view('diplomado/preins.php');
        $this->load->view('templates/footerlog');
    }

    // public function solic()
    // {
    //     // Verificar que sea POST y tenga el campo tipo_persona
    //     if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('tipo_persona')) {
    //         // Procesar para persona natural
    //         $data['tipo_persona'] = $this->input->post('tipo_persona');

    //         // Carga los datos necesarios para el formulario
    //         $data['final'] = $this->User_model->consulta_organoente();
    //         $data['clasificacion'] = $this->Diplomado_model->consulta_grado();
    //         $data['diplomado'] = $this->Diplomado_model->consulta_diplomado();
    //         $data['estados'] = $this->Configuracion_model->consulta_estados();
    //         $data['objeto'] = $this->Configuracion_model->objeto();
    //         $data['banco'] = $this->Configuracion_model->get_bancos();

    //         // Cargar vistas
    //         $this->load->view('templates/headerlog');
    //         $this->load->view('templates/navbarlog');
    //         $this->load->view('diplomado/solicitud_pnatural.php', $data);
    //         $this->load->view('templates/footerlog');
    //     } else {
    //         // Redireccionar si no es POST
    //         redirect('pagina_principal');
    //     }
    // }

    public function solic()
    {
        // Verificar que sea una petición POST (opcional)
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Método no permitido', 403);
            return;
        }

        // Elimina la verificación CSRF manual
        // if (!$this->_check_csrf()) {
        //     log_message('error', 'Falló CSRF');
        //     redirect('error/csrf');
        //     return;
        // }

        // Verificar campo tipo_persona
        if (!$this->input->post('tipo_persona')) {
            redirect('preinscrip');
            return;
        }

        // Procesar para persona natural
        $data['tipo_persona'] = $this->input->post('tipo_persona');

        // Cargar datos necesarios
        $data['final'] = $this->User_model->consulta_organoente();
        $data['clasificacion'] = $this->Diplomado_model->consulta_grado();
        $data['diplomado'] = $this->Diplomado_model->consulta_diplomado();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['objeto'] = $this->Configuracion_model->objeto();
        $data['banco'] = $this->Configuracion_model->get_bancos();

        // Cargar vistas
        $this->load->view('templates/headerlog');
        $this->load->view('templates/navbarlog');
        $this->load->view('diplomado/solicitud.php', $data);
        $this->load->view('templates/footerlog');
    }

    // private function _check_csrf()
    // {
    //     // Verificar token CSRF
    //     if ($this->config->item('csrf_protection')) {
    //         $this->security->csrf_verify();
    //         return true;
    //     }
    //     return true; // Si CSRF está desactivado en config
    // }

    public function solic_juridica()
    {
        // Verificar que sea una petición POST (opcional)
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Método no permitido', 403);
            return;
        }

        // Elimina la verificación CSRF manual
        // if (!$this->_check_csrf()) {
        //     log_message('error', 'Falló CSRF');
        //     redirect('error/csrf');
        //     return;
        // }

        // Verificar campo tipo_persona
        if (!$this->input->post('tipo_persona')) {
            redirect('preinscrip');
            return;
        }

        // Procesar para persona natural
        $data['tipo_persona'] = $this->input->post('tipo_persona');

        // Cargar datos necesarios
        $data['final'] = $this->User_model->consulta_organoente();
        $data['clasificacion'] = $this->Diplomado_model->consulta_grado();
        $data['diplomado'] = $this->Diplomado_model->consulta_diplomado();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['objeto'] = $this->Configuracion_model->objeto();
        // $data['banco'] = $this->Configuracion_model->get_bancos();

        // Cargar vistas
        $this->load->view('templates/headerlog');
        $this->load->view('templates/navbarlog');
        $this->load->view('diplomado/solicitud_juridica.php', $data);
        $this->load->view('templates/footerlog');
    }

    // public function solic_juridica()
    // {
    //     // Verificar que sea POST y tenga el campo tipo_persona
    //     if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('tipo_persona')) {
    //         // Procesar para persona jurídica
    //         $data['tipo_persona'] = $this->input->post('tipo_persona');

    //         // Carga los datos necesarios para el formulario jurídico
    //         // ... (similar al método solic pero con datos para jurídica)

    //         // Cargar vistas
    //         $this->load->view('templates/headerlog');
    //         $this->load->view('templates/navbarlog');
    //         $this->load->view('diplomado/solicitud_pjuridica.php', $data);
    //         $this->load->view('templates/footerlog');
    //     } else {
    //         // Redireccionar si no es POST
    //         redirect('pagina_principal');
    //     }
    // }

    public function guardar_inscripcion()
    {
        // Validar campos obligatorios base
        $required_fields = [
            'id_diplomado',
            'cedula_f',
            'name_f',
            'apellido_f',
            'telefono_f',
            'direccion_fiscal_',
            'trabajo'
        ];

        foreach ($required_fields as $field) {
            if (empty($this->input->post($field))) {
                $this->output->set_status_header(400);
                echo json_encode(['success' => false, 'message' => 'El campo ' . $field . ' es requerido']);
                return;
            }
        }

        // Validaciones específicas
        // if (!preg_match('/^\d{8}$/', $this->input->post('cedula_f'))) {
        //     $this->output->set_status_header(400);
        //     echo json_encode(['success' => false, 'message' => 'La cédula debe tener 8 dígitos numéricos']);
        //     return;
        // }

        if (!empty($this->input->post('correo')) && !filter_var($this->input->post('correo'), FILTER_VALIDATE_EMAIL)) {
            $this->output->set_status_header(400);
            echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido']);
            return;
        }
        // Agregar validación para información curricular
        $required_curricular = [
            'grado_instruccion',
            'titulo_obtenido',
            //'experiencia_publicas',
            't_contrata_p',
            'tiene_capacitacion'
        ];

        foreach ($required_curricular as $field) {
            if (empty($this->input->post($field))) {
                $this->output->set_status_header(400);
                echo json_encode(['success' => false, 'message' => 'El campo ' . $field . ' es requerido']);
                return;
            }
        }
        // Validar capacitaciones si tiene
        if ($this->input->post('tiene_capacitacion') == '1') {
            $capacitaciones = $this->input->post('capacitaciones');
            if (empty($capacitaciones)) {  // Aquí faltaba el paréntesis de cierre
                $this->output->set_status_header(400);
                echo json_encode(['success' => false, 'message' => 'Debe agregar al menos una capacitación']);
                return;
            }
        }

        $id_empresa = 1; // Por defecto "No trabaja"

        if ($this->input->post('trabajo') == '1') {
            $rif = $this->input->post('rif_b');
            $rif_existente = $this->input->post('sel_rif_nombre5');

            if (empty($rif) && empty($rif_existente)) {
                echo json_encode(['success' => false, 'message' => 'Debe ingresar o seleccionar un RIF']);
                return;
            }

            // Si hay RIF en campos readonly (ya verificado)
            if (!empty($rif_existente)) {
                // Verificar si ya existe en empresas
                $empresa = $this->Diplomado_model->verificar_rif_empresa($rif_existente);

                if (!$empresa) {
                    // Registrar en empresas con datos mínimos
                    $id_empresa = $this->Diplomado_model->registrar_empresa(
                        $rif_existente,
                        $this->input->post('nombre_conta_5'),
                        '0',
                        '-'
                    );
                } else {
                    $id_empresa = $empresa['id_empresa'];
                }
            }
            // Si es un RIF nuevo
            else {
                // Primero verificar en organoente
                $organoente = $this->Diplomado_model->verificar_rif_organoente($rif);

                if ($organoente) {
                    // Registrar en empresas con datos de organoente
                    $id_empresa = $this->Diplomado_model->registrar_empresa(
                        $organoente['rif'],
                        $organoente['descripcion'],
                        '0',
                        '-'
                    );
                } else {
                    // Validar campos requeridos para nueva empresa
                    $required_empresa = [
                        'razon_social',
                        'tel_local',
                        // 'id_estado_n',
                        // 'id_municipio_n',
                        // 'id_parroquia_n',
                        'direccion_fiscal'
                    ];

                    foreach ($required_empresa as $field) {
                        if (empty($this->input->post($field))) {
                            echo json_encode(['success' => false, 'message' => 'Debe completar todos los datos de la institución']);
                            return;
                        }
                    }

                    // Registrar nueva empresa completa
                    $id_empresa = $this->Diplomado_model->registrar_empresa(
                        $rif,
                        $this->input->post('razon_social'),
                        $this->input->post('tel_local'),
                        $this->input->post('direccion_fiscal')
                    );
                }
            }

            if (!$id_empresa) {
                echo json_encode(['success' => false, 'message' => 'Error al registrar la empresa']);
                return;
            }
        }

        // Registrar participante (sin info curricular)
        $id_participante = $this->Diplomado_model->registrar_participante(
            $this->input->post(),
            $id_empresa
        );

        if (!$id_participante) {
            $this->output->set_status_header(500);
            echo json_encode(['success' => false, 'message' => 'Error al registrar el participante']);
            return;
        }
        if ($this->input->post('t_contrata_p') == '2') {
            $experiencia_contrataciones_publicas = 0;
        } else {
            $experiencia_contrataciones_publicas = $this->security->xss_clean($this->input->post('experiencia_publicas'));
        }

        // Registrar información curricular
        $curriculum_data = [
            'id_participante' => $id_participante,
            'grado_instruccion' => $this->security->xss_clean($this->input->post('grado_instruccion')),
            'titulo_obtenido' => $this->security->xss_clean($this->input->post('titulo_obtenido')),
            'experiencia_contrataciones_publicas' => $experiencia_contrataciones_publicas,
            't_contrata_p' => $this->security->xss_clean($this->input->post('t_contrata_p')),
            'tiene_capacitacion_contrataciones' => $this->security->xss_clean($this->input->post('tiene_capacitacion'))
        ];

        $id_curriculum = $this->Diplomado_model->registrar_curriculum($curriculum_data);

        if (!$id_curriculum) {
            $this->output->set_status_header(500);
            echo json_encode(['success' => false, 'message' => 'Error al registrar información curricular']);
            return;
        }
        if ($this->input->post('tiene_capacitacion') == '1') {
            $capacitaciones = $this->input->post('capacitaciones');
            foreach ($capacitaciones as $capacitacion) {
                $capacitacion_data = [
                    'id_curriculum' => $id_curriculum,
                    'nombre_curso' => $this->security->xss_clean($capacitacion['nombre_curso']),
                    'institucion_formadora' => $this->security->xss_clean($capacitacion['institucion']),
                    'anio_realizacion' => $this->security->xss_clean($capacitacion['anio'])
                ];

                if (!$this->Diplomado_model->registrar_capacitacion($capacitacion_data)) {
                    $this->output->set_status_header(500);
                    echo json_encode(['success' => false, 'message' => 'Error al registrar capacitaciones']);
                    return;
                }
            }
        }
        // Registrar inscripción
        $result = $this->Diplomado_model->registrar_inscripcion(
            $id_participante,
            $this->input->post('id_diplomado')
        );

        if ($result) {
            // Obtener el código de planilla
            $this->db->select('codigo_planilla');
            $this->db->where('id_participante', $id_participante);
            $inscripcion = $this->db->get('diplomado.inscripciones')->row_array();

            echo json_encode([
                'success' => true,
                'message' => 'Inscripción registrada correctamente',
                'codigo' => $inscripcion['codigo_planilla']
            ]);
        } else {
            $this->output->set_status_header(500);
            echo json_encode(['success' => false, 'message' => 'Error al registrar la inscripción']);
        }
    }

    public function sel_participantes()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['participantes'] = $this->Diplomado_model->consultar_participantes();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('diplomado/participantes.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function sel_participantes_juridico()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['participantes'] = $this->Diplomado_model->consultar_participantes_juridico1();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('diplomado/participantes_juridico.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function actualizar_inscripcion()
    {
        $this->load->model('Diplomado_model');
        $usuario = $this->session->userdata('id_user');

        $data = array(
            'id_inscripcion' => $this->input->post('id_inscripcion'),
            'estatus' => $this->input->post('estatus'),
            'observacion' => $this->input->post('observacion'),
            'tipo_pago' => $this->input->post('tipo_pago'),

            'id_usuario' => $usuario
        );

        $result = $this->Diplomado_model->procesar_decision($data);

        echo json_encode($result);
    }
    public function actualizar_inscripcion_pj()
    {
        $this->load->model('Diplomado_model');
        $usuario = $this->session->userdata('id_user');

        $data = array(
            'id_inscripcion' => $this->input->post('id_inscripcion'),
            'estatus' => $this->input->post('estatus'),
            'observacion' => $this->input->post('observacion'),
            'id_usuario' => $usuario
        );

        $result = $this->Diplomado_model->procesar_decision_pj($data);

        echo json_encode($result);
    }
    public function participanteselec()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['participantes'] = $this->Diplomado_model->consultar_participantes_selecci();
        $data['participantes_js'] = $this->Diplomado_model->consultar_participantes_juridico2();


        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('diplomado/seleccionadop.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function pago()
    {



        // // Procesar para persona natural
        // $data['tipo_persona'] = $this->input->post('tipo_persona');

        // // Cargar datos necesarios
        // $data['final'] = $this->User_model->consulta_organoente();
        // $data['clasificacion'] = $this->Diplomado_model->consulta_grado();
        // $data['diplomado'] = $this->Diplomado_model->consulta_diplomado();
        // $data['estados'] = $this->Configuracion_model->consulta_estados();
        // $data['objeto'] = $this->Configuracion_model->objeto();
        // $data['banco'] = $this->Diplomado_model->get_bancos();

        // Cargar vistas
        $this->load->view('templates/headerlog');
        $this->load->view('templates/navbarlog');
        $this->load->view('diplomado/pay.php');
        $this->load->view('templates/footerlog');
    }

    public function guardar_pago()
    {
        // Validar que la petición sea POST
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            return;
        }

        // Obtener datos del formulario
        $id_inscripcion = $this->input->post('id_inscripcion');
        $codigo_planilla = $this->input->post('codigo_planilla');
        $monto = $this->input->post('importe');
        $fecha_pago = $this->input->post('fechaPago');
        $referencia = $this->input->post('referencia');
        $cedula_pagador = $this->input->post('cedulaPagador');
        $telefono_pagador = $this->input->post('telefonoPagador');
        $telefono_destino = $this->input->post('telefonoDestino');
        $banco = $this->input->post('bancoOrigen');
        $tipo_pago = $this->input->post('tipo_pago');


        // Validar datos requeridos
        if (empty($id_inscripcion) || empty($monto) || empty($fecha_pago) || empty($referencia)) {
            echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos']);
            return;
        }

        // Registrar el pago
        $pago_data = [
            'id_inscripcion' => $id_inscripcion,
            'monto' => $monto,
            'fecha_pago' => $fecha_pago,
            'referencia' => $referencia,
            'banco' => $banco,
            'tipo_pago' => $tipo_pago,
            'estatus' => 4, // 4=Confirmado (asumiendo que ya fue validado)
            'observaciones' => "Pago registrado por cédula: $cedula_pagador, tel: $telefono_pagador"
        ];

        $pago_id = $this->Diplomado_model->registar_pago($pago_data);

        if ($pago_id) {
            // Actualizar estado de la inscripción a 4 (pagado)
            $actualizado = $this->Diplomado_model->actualizar_estado_inscripcion($codigo_planilla, 4);

            if ($actualizado) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Pago registrado y estado actualizado correctamente',
                    'pago_id' => $pago_id
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Pago registrado pero no se pudo actualizar el estado de la inscripción'
                ]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar el pago']);
        }
    }

    // public function consulta_og()
    // {
    //     $rif_b = $this->input->post('rif_b');
    //     $result = $this->Diplomado_model->planilla_pay(['rif_b' => $rif_b]);

    //     if ($result) {
    //         echo json_encode([
    //             'success' => true,
    //             'data' => $result
    //         ]);
    //     } else {
    //         echo json_encode([
    //             'success' => false,
    //             'message' => 'Planilla no encontrada'
    //         ]);
    //     }
    // }

    public function consulta_og()
    {
        $rif_b = $this->input->post('rif_b');
        $result = $this->Diplomado_model->planilla_pay(['rif_b' => $rif_b]);

        if ($result) {
            echo json_encode([
                'success' => true,
                'data' => [
                    'fecha_limite_pago' => $result['fecha_limite_pago'],
                    'id_inscripcion' => $result['id_inscripcion'],
                    'pronto_pago' => $result['pronto_pago'],
                    'pay' => $result['pay'],
                    'codigo_planilla' => $result['codigo_planilla'],


                ]
            ]);
        } else {
            // Asegúrate de que el status HTTP sea 200 aunque falle
            http_response_code(200);
            echo json_encode([
                'success' => false,
                'message' => 'Planilla no encontrada'
            ]);
        }
    }
    public function registrar_actualizar_empresa($data)
    {
        // Verificar si la empresa ya existe
        $this->db->where('rif', $data['rif']);
        $empresa = $this->db->get('diplomado.empresas')->row_array();

        if ($empresa) {
            // Actualizar datos existentes
            $this->db->where('id_empresa', $empresa['id_empresa']);
            $this->db->update('diplomado.empresas', $data);
            return $empresa['id_empresa'];
        } else {
            // Insertar nueva empresa
            $this->db->insert('diplomado.empresas', $data);
            return $this->db->insert_id();
        }
    }

    public function registrar_participante($data)
    {
        // Verificar si el participante ya existe para este diplomado y empresa
        $this->db->where('cedula', $data['cedula']);
        $this->db->where('id_diplomado', $data['id_diplomado']);
        $this->db->where('id_empresa', $data['id_empresa']);
        $existente = $this->db->get('diplomado.participantes')->row_array();

        if ($existente) {
            return $existente['id_participante'];
        }

        $this->db->insert('diplomado.participantes', $data);
        return $this->db->insert_id();
    }

    public function registrar_curriculum($data)
    {
        $this->db->insert('diplomado.curriculum_participante', $data);
        return $this->db->insert_id();
    }

    public function registrar_capacitacion($data)
    {
        return $this->db->insert('diplomado.capacitaciones_participante', $data);
    }

    public function registrar_inscripcion($id_participante, $id_diplomado)
    {
        // Generar código de planilla (ej: DIP-2023-001)
        $codigo = 'DIP-' . date('Y') . '-' . str_pad($this->db->count_all('diplomado.inscripciones') + 1, 3, '0', STR_PAD_LEFT);

        $data = [
            'id_participante' => $id_participante,
            'id_diplomado' => $id_diplomado,
            'codigo_planilla' => $codigo,
            'estatus' => 1, // 1 = Pendiente
            'fecha_limite_pago' => date('Y-m-d', strtotime('+7 days')) // 7 días para pagar
        ];

        return $this->db->insert('diplomado.inscripciones', $data);
    }
    public function guardar_inscripcion_persona_juridica()
    {
        // Verificar método de solicitud
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'Método no permitido'
                ]));
            return;
        }

        // Iniciar transacción para asegurar atomicidad
        $this->db->trans_begin();

        try {
            // Obtener datos de entrada (tanto POST como raw JSON)
            $input = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $input = $this->input->post();
            }

            // Validar datos básicos
            if (empty($input)) {
                throw new Exception("No se recibieron datos");
            }

            // Validar datos de empresa
            $required_empresa = ['rif', 'razon_social', 'tel_local', 'direccion_fiscal', 'ente', 'id_diplomado'];
            foreach ($required_empresa as $field) {
                if (!isset($input[$field]) || empty($input[$field])) {
                    throw new Exception("El campo {$field} de la empresa es requerido");
                }
            }





            // 2. Registrar o actualizar empresa
            $empresa_data = [
                'rif' => strtoupper($this->security->xss_clean($this->input->post('rif'))),
                'razon_social' => $this->security->xss_clean($this->input->post('razon_social')),
                'telefono' => $this->security->xss_clean($this->input->post('tel_local')),
                'direccion_fiscal' => $this->security->xss_clean($this->input->post('direccion_fiscal')),
                'ente_gubernamental' => $this->security->xss_clean($this->input->post('ente'))
            ];

            $id_empresa = $this->Diplomado_model->registrar_actualizar_empresa($empresa_data);
            if (!$id_empresa) {
                throw new Exception("Error al registrar la empresa aca");
            }

            // 3. Validar participantes
            $participantes = $this->input->post('participantes');
            if (empty($participantes) || !is_array($participantes)) {
                throw new Exception("Debe incluir al menos un participante");
            }

            if (count($participantes) > 15) {
                throw new Exception("Máximo 15 participantes por empresa");
            }

            // 4. Procesar cada participante
            $ids_participantes = [];
            foreach ($participantes as $index => $participante) {
                // Validar datos básicos del participante
                $required_participante = [
                    'cedula',
                    'nombres',
                    'apellidos',
                    'telefono',
                    'direccion'
                ];

                foreach ($required_participante as $field) {
                    if (empty($participante[$field])) {
                        throw new Exception("Participante #{$index}: El campo {$field} es requerido");
                    }
                }

                // Validar cédula
                if (!preg_match('/^\d{8}$/', $participante['cedula'])) {
                    throw new Exception("Participante #{$index}: La cédula debe tener 8 dígitos");
                }

                // Validar email si existe
                if (!empty($participante['correo']) && !filter_var($participante['correo'], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Participante #{$index}: Correo electrónico no válido");
                }

                // Registrar participante
                $participante_data = [
                    'id_diplomado' => $this->input->post('id_diplomado'),
                    'id_tipo' => 2, // 2 = Jurídica
                    'id_empresa' => $id_empresa,
                    'cedula' => $participante['cedula'],
                    'nombres' => $this->security->xss_clean($participante['nombres']),
                    'apellidos' => $this->security->xss_clean($participante['apellidos']),
                    'telefono' => $this->security->xss_clean($participante['telefono']),
                    'correo' => !empty($participante['correo']) ? $this->security->xss_clean($participante['correo']) : null,
                    'edad' => !empty($participante['edad']) ? $this->security->xss_clean($participante['edad']) : null,
                    'direccion' => $this->security->xss_clean($participante['direccion']),
                    'trabaja_actualmente' => 1 // Siempre trabaja si es jurídica
                ];

                //$id_participante = $this->Diplomado_model->registrar_participantejs($participante_data);
                $id_participante = $this->Diplomado_model->registrar_participantejs($participante_data);


                if (!$id_participante) {
                    throw new Exception("Participante #{$index}: Error al registrar participante");
                }
                $ids_participantes[] = $id_participante;

                // Procesar información curricular
                if (empty($participante['grado_instruccion']) || empty($participante['titulo_obtenido'])) {
                    throw new Exception("Participante #{$index}: Información curricular incompleta");
                }

                $curriculum_data = [
                    'id_participante' => $id_participante,
                    'grado_instruccion' => $this->security->xss_clean($participante['grado_instruccion']),
                    'titulo_obtenido' => $this->security->xss_clean($participante['titulo_obtenido']),
                    't_contrata_p' => $this->security->xss_clean($participante['t_contrata_p']),
                    'experiencia_contrataciones_publicas' => ($participante['t_contrata_p'] == '1') ?
                        $this->security->xss_clean($participante['experiencia_publicas']) : 0,
                    'tiene_capacitacion_contrataciones' => $this->security->xss_clean($participante['tiene_capacitacion'])
                ];

                $id_curriculum = $this->Diplomado_model->registrar_curriculumjs($curriculum_data);
                if (!$id_curriculum) {
                    throw new Exception("Participante #{$index}: Error al registrar curriculum");
                }

                // Procesar capacitaciones si aplica
                if ($participante['tiene_capacitacion'] == '1') {
                    if (empty($participante['capacitaciones']) || !is_array($participante['capacitaciones'])) {
                        throw new Exception("Participante #{$index}: Debe agregar al menos una capacitación");
                    }

                    if (count($participante['capacitaciones']) > 3) {
                        throw new Exception("Participante #{$index}: Máximo 3 capacitaciones por participante");
                    }

                    foreach ($participante['capacitaciones'] as $cap_index => $capacitacion) {
                        $required_capacitacion = [
                            'nombre_curso',
                            'institucion',
                            'anio'
                        ];

                        foreach ($required_capacitacion as $field) {
                            if (empty($capacitacion[$field])) {
                                throw new Exception("Participante #{$index}, Capacitación #{$cap_index}: Campo {$field} requerido");
                            }
                        }

                        $capacitacion_data = [
                            'id_curriculum' => $id_curriculum,
                            'nombre_curso' => $this->security->xss_clean($capacitacion['nombre_curso']),
                            'institucion_formadora' => $this->security->xss_clean($capacitacion['institucion']),
                            'anio_realizacion' => $this->security->xss_clean($capacitacion['anio'])
                        ];

                        if (!$this->Diplomado_model->registrar_capacitacionjs($capacitacion_data)) {
                            throw new Exception("Participante #{$index}, Capacitación #{$cap_index}: Error al registrar");
                        }
                    }
                }

                // Registrar inscripción para este participante
                // if (!$this->Diplomado_model->registrar_inscripcionjs($id_participante, $this->input->post('id_diplomado'))) {
                //     throw new Exception("Participante #{$index}: Error al registrar inscripción");
                // }

                // Registrar inscripción GRUPAL (en lugar de individual)
                $codigo_planilla = $this->Diplomado_model->registrar_inscripcion_grupal(
                    $id_empresa,
                    $input['id_diplomado'],
                    $ids_participantes
                );
            }

            // Si todo salió bien, confirmar transacción
            $this->db->trans_commit();

            // // Obtener códigos de planilla generados
            // $this->db->select('codigo_planilla');
            // $this->db->where_in('id_participante', $ids_participantes);
            // $inscripciones = $this->db->get('diplomado.inscripciones_grupales')->result_array();

            // $response = [
            //     'success' => true,
            //     'message' => 'Inscripción registrada correctamente',
            //     'total_participantes' => count($ids_participantes),
            //     'codigos_planilla' => array_column($inscripciones, 'codigo_planilla')
            // ];
            $response = [
                'success' => true,
                'message' => 'Inscripción registrada correctamente',
                'codigo_planilla' => $codigo_planilla,
                'total_participantes' => count($ids_participantes)
            ];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    //validar existencias de cedulas
    public function validarCedula()
    {
        $cedula = $this->input->post('cedula');
        $id_diplomado = $this->input->post('id_diplomado');

        // Validar datos de entrada
        if (empty($cedula) || empty($id_diplomado)) {
            echo json_encode(['error' => 'Datos incompletos']);
            return;
        }

        // Llamar al modelo para verificar
        $existe = $this->Diplomado_model->verificarCedulaEnDiplomado($cedula, $id_diplomado);

        echo json_encode(['existe' => $existe]);
    }
}
