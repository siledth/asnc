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
    public function consulta_planilla()
    {
        $rif_b = $this->input->post('rif_b');
        $result = $this->Diplomado_model->planilla_pay2(['rif_b' => $rif_b]);

        if ($result) {
            echo json_encode([
                'success' => true,
                'data' => [
                    'fecha_limite_pago' => $result['fecha_limite_pago'],
                    'id_inscripcion_grupal' => $result['id_inscripcion_grupal'],
                    'pronto_pago' => $result['pronto_pago'],
                    'pay' => $result['pay'],
                    'codigo_planilla' => $result['codigo_planilla'],
                    'ente_gubernamental' => $result['ente_gubernamental'],



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
        $this->load->view('diplomado/reportes/Mov_CCP.php');
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
    // public function verificar_pago()
    // {
    //     $this->output->set_content_type('application/json');

    //     // Validar que sea una petición POST
    //     if ($this->input->server('REQUEST_METHOD') !== 'POST') {
    //         echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    //         return;
    //     }

    //     // Validar campos requeridos
    //     $required_fields = ['cedulaPagador', 'telefonoPagador', 'referencia', 'fechaPago', 'importe', 'bancoOrigen'];
    //     foreach ($required_fields as $field) {
    //         if (empty($this->input->post($field))) {
    //             echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos']);
    //             return;
    //         }
    //     }

    //     // Preparar datos para la API
    //     $datos_api = [
    //         'cedulaPagador' => $this->input->post('cedulaPagador'),
    //         'telefonoPagador' => $this->input->post('telefonoPagador'),
    //         'telefonoDestino' => $this->input->post('telefonoDestino') ?: '',
    //         'referencia' => $this->input->post('referencia'),
    //         'fechaPago' => $this->input->post('fechaPago'),
    //         'importe' => $this->input->post('importe'),
    //         'bancoOrigen' => $this->input->post('bancoOrigen')
    //         // 'reqCed' => true
    //     ];

    //     // Configurar la API key de forma segura
    //     $api_key = $this->config->item('banvenez_api_key'); // Configurada en application/config/config.php

    //     // Llamar al helper que hará la petición
    //     $this->load->helper('banvenez_api');
    //     $response = verify_payment_with_banvenez($datos_api, $api_key);

    //     // Procesar respuesta
    //     if ($response['code'] == 1000) {
    //         echo json_encode(['success' => true, 'message' => 'Pago verificado correctamente']);
    //     } else {
    //         echo json_encode(['success' => false, 'message' => 'Pago no verificado', 'error' => $response['message'] ?? 'Error desconocido']);
    //     }
    // }

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
        $data['diplomado'] = $this->Diplomado_model->consulta_diplomado1();
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
        $data['diplomado'] = $this->Diplomado_model->consulta_diplomado1();
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

    // public function guardar_inscripcion()
    // {
    //     // Validar campos obligatorios base
    //     $required_fields = [
    //         'id_diplomado',
    //         'cedula_f',
    //         'name_f',
    //         'apellido_f',
    //         'telefono_f',
    //         'direccion_fiscal_',
    //         'trabajo'
    //     ];

    //     foreach ($required_fields as $field) {
    //         if (empty($this->input->post($field))) {
    //             $this->output->set_status_header(400);
    //             echo json_encode(['success' => false, 'message' => 'El campo ' . $field . ' es requerido']);
    //             return;
    //         }
    //     }


    //     if (!empty($this->input->post('correo')) && !filter_var($this->input->post('correo'), FILTER_VALIDATE_EMAIL)) {
    //         $this->output->set_status_header(400);
    //         echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido']);
    //         return;
    //     }
    //     // Agregar validación para información curricular
    //     $required_curricular = [
    //         'grado_instruccion',
    //         'titulo_obtenido',
    //         //'experiencia_publicas',
    //         't_contrata_p',
    //         'tiene_capacitacion'
    //     ];

    //     foreach ($required_curricular as $field) {
    //         if (empty($this->input->post($field))) {
    //             $this->output->set_status_header(400);
    //             echo json_encode(['success' => false, 'message' => 'El campo ' . $field . ' es requerido']);
    //             return;
    //         }
    //     }
    //     // Validar capacitaciones si 'tiene_capacitacion' es '1'
    //     if ($this->input->post('tiene_capacitacion') == '1') {
    //         $capacitaciones = $this->input->post('capacitaciones');
    //         if (empty($capacitaciones)) {
    //             $this->output->set_status_header(400);
    //             echo json_encode(['success' => false, 'message' => 'Debe agregar al menos una capacitación en Contrataciones Públicas.']);
    //             return;
    //         }
    //         // Validar cada capacitación
    //         foreach ($capacitaciones as $idx => $capacitacion) {
    //             if (empty($capacitacion['id_curso'])) {
    //                 $this->output->set_status_header(400);
    //                 echo json_encode(['success' => false, 'message' => 'Seleccione un curso para la capacitación #' . ($idx + 1)]);
    //                 return;
    //             }
    //             // Si el curso seleccionado es "Otros" (ID 8), validar el campo de texto
    //             if ($capacitacion['id_curso'] == '8' && empty($capacitacion['nombre_curso_otro'])) {
    //                 $this->output->set_status_header(400);
    //                 echo json_encode(['success' => false, 'message' => 'Especifique el nombre del curso para la capacitación #' . ($idx + 1)]);
    //                 return;
    //             }
    //             if (empty($capacitacion['institucion']) || empty($capacitacion['anio'])) {
    //                 $this->output->set_status_header(400);
    //                 echo json_encode(['success' => false, 'message' => 'Complete todos los campos para la capacitación #' . ($idx + 1)]);
    //                 return;
    //             }
    //         }
    //     }


    //     // Validar experiencias laborales si 'tiene_experiencia_laboral' es '1'
    //     if ($this->input->post('tiene_experiencia_laboral') == '1') {
    //         $experiencias = $this->input->post('experiencias');
    //         if (empty($experiencias)) {
    //             $this->output->set_status_header(400);
    //             echo json_encode(['success' => false, 'message' => 'Debe agregar al menos una experiencia laboral.']);
    //             return;
    //         }
    //         // Validar campos de cada experiencia
    //         foreach ($experiencias as $idx => $experiencia) {
    //             if (empty($experiencia['institucion']) || empty($experiencia['cargo']) || empty($experiencia['tiempo_cargo']) || empty($experiencia['desde']) || empty($experiencia['hasta'])) {
    //                 $this->output->set_status_header(400);
    //                 echo json_encode(['success' => false, 'message' => 'Complete todos los campos para la experiencia laboral #' . ($idx + 1)]);
    //                 return;
    //             }
    //             // Opcional: Validar que fecha 'hasta' no sea mayor a hoy
    //             $fecha_hasta = new DateTime($experiencia['hasta']);
    //             $hoy = new DateTime();
    //             if ($fecha_hasta > $hoy) {
    //                 $this->output->set_status_header(400);
    //                 echo json_encode(['success' => false, 'message' => 'La fecha de fin para la experiencia laboral #' . ($idx + 1) . ' no puede ser mayor a la fecha actual.']);
    //                 return;
    //             }
    //         }
    //     }

    //     $id_empresa = 1; // Por defecto "No trabaja"

    //     if ($this->input->post('trabajo') == '1') {
    //         $rif = $this->input->post('rif_b');
    //         $rif_existente = $this->input->post('sel_rif_nombre5');

    //         if (empty($rif) && empty($rif_existente)) {
    //             echo json_encode(['success' => false, 'message' => 'Debe ingresar o seleccionar un RIF']);
    //             return;
    //         }

    //         // Si hay RIF en campos readonly (ya verificado)
    //         if (!empty($rif_existente)) {
    //             // Verificar si ya existe en empresas
    //             $empresa = $this->Diplomado_model->verificar_rif_empresa($rif_existente);

    //             if (!$empresa) {
    //                 // Registrar en empresas con datos mínimos
    //                 $id_empresa = $this->Diplomado_model->registrar_empresa(
    //                     $rif_existente,
    //                     $this->input->post('nombre_conta_5'),
    //                     '0',
    //                     '-'
    //                 );
    //             } else {
    //                 $id_empresa = $empresa['id_empresa'];
    //             }
    //         }
    //         // Si es un RIF nuevo
    //         else {
    //             // Primero verificar en organoente
    //             $organoente = $this->Diplomado_model->verificar_rif_organoente($rif);

    //             if ($organoente) {
    //                 // Registrar en empresas con datos de organoente
    //                 $id_empresa = $this->Diplomado_model->registrar_empresa(
    //                     $organoente['rif'],
    //                     $organoente['descripcion'],
    //                     '0',
    //                     '-'
    //                 );
    //             } else {
    //                 // Validar campos requeridos para nueva empresa
    //                 $required_empresa = [
    //                     'razon_social',
    //                     'tel_local',
    //                     // 'id_estado_n',
    //                     // 'id_municipio_n',
    //                     // 'id_parroquia_n',
    //                     'direccion_fiscal'
    //                 ];

    //                 foreach ($required_empresa as $field) {
    //                     if (empty($this->input->post($field))) {
    //                         echo json_encode(['success' => false, 'message' => 'Debe completar todos los datos de la institución']);
    //                         return;
    //                     }
    //                 }

    //                 // Registrar nueva empresa completa
    //                 $id_empresa = $this->Diplomado_model->registrar_empresa(
    //                     $rif,
    //                     $this->input->post('razon_social'),
    //                     $this->input->post('tel_local'),
    //                     $this->input->post('direccion_fiscal')
    //                 );
    //             }
    //         }

    //         if (!$id_empresa) {
    //             echo json_encode(['success' => false, 'message' => 'Error al registrar la empresa']);
    //             return;
    //         }
    //     }

    //     // Registrar participante (sin info curricular)
    //     $id_participante = $this->Diplomado_model->registrar_participante(
    //         $this->input->post(),
    //         $id_empresa
    //     );

    //     if (!$id_participante) {
    //         $this->output->set_status_header(500);
    //         echo json_encode(['success' => false, 'message' => 'Error al registrar el participante']);
    //         return;
    //     }
    //     if ($this->input->post('t_contrata_p') == '2') {
    //         $experiencia_contrataciones_publicas = 0;
    //     } else {
    //         $experiencia_contrataciones_publicas = $this->security->xss_clean($this->input->post('experiencia_publicas'));
    //     }

    //     // Registrar información curricular
    //     $curriculum_data = [
    //         'id_participante' => $id_participante,
    //         'grado_instruccion' => $this->security->xss_clean($this->input->post('grado_instruccion')),
    //         'titulo_obtenido' => $this->security->xss_clean($this->input->post('titulo_obtenido')),
    //         'experiencia_contrataciones_publicas' => $experiencia_contrataciones_publicas,
    //         't_contrata_p' => $this->security->xss_clean($this->input->post('t_contrata_p')),
    //         'tiene_capacitacion_contrataciones' => $this->security->xss_clean($this->input->post('tiene_capacitacion')),
    //         'exp_5_anio' => $this->security->xss_clean($this->input->post('tiene_experiencia_laboral')),

    //     ];

    //     $id_curriculum = $this->Diplomado_model->registrar_curriculum($curriculum_data);

    //     if (!$id_curriculum) {
    //         $this->output->set_status_header(500);
    //         echo json_encode(['success' => false, 'message' => 'Error al registrar información curricular']);
    //         return;
    //     }
    //     // Registrar capacitaciones si 'tiene_capacitacion' es '1'
    //     if ($this->input->post('tiene_capacitacion') == '1') {
    //         $capacitaciones = $this->input->post('capacitaciones');
    //         foreach ($capacitaciones as $capacitacion) {
    //             $nombre_curso_a_guardar = '';
    //             $id_curso_a_guardar = $this->security->xss_clean($capacitacion['id_curso']);

    //             if ($id_curso_a_guardar == '8') { // Si es "Otros"
    //                 $nombre_curso_a_guardar = $this->security->xss_clean($capacitacion['nombre_curso_otro']);
    //             } else {
    //                 // Obtener la descripción del curso seleccionado de la lista cargada
    //                 $curso_seleccionado = array_filter($this->Diplomado_model->obtener_todos_los_cursos(), function ($curso) use ($id_curso_a_guardar) {
    //                     return $curso['id_cursos'] == $id_curso_a_guardar;
    //                 });
    //                 $curso_seleccionado = reset($curso_seleccionado); // Obtener el primer (y único) resultado

    //                 if ($curso_seleccionado) {
    //                     $nombre_curso_a_guardar = $curso_seleccionado['descripcion_cursos'];
    //                 } else {
    //                     // Fallback o error si no se encuentra el curso
    //                     $nombre_curso_a_guardar = "Curso Desconocido (ID: " . $id_curso_a_guardar . ")";
    //                 }
    //             }

    //             $capacitacion_data = [
    //                 'id_curriculum' => $id_curriculum,
    //                 'nombre_curso' => $nombre_curso_a_guardar, // Este campo ahora contendrá el texto del curso
    //                 'institucion_formadora' => $this->security->xss_clean($capacitacion['institucion']),
    //                 'anio_realizacion' => $this->security->xss_clean($capacitacion['anio']),
    //                 'horas' => $this->security->xss_clean($capacitacion['horas'])

    //             ];

    //             if (!$this->Diplomado_model->registrar_capacitacion($capacitacion_data)) {
    //                 $this->output->set_status_header(500);
    //                 echo json_encode(['success' => false, 'message' => 'Error al registrar una o más capacitaciones.']);
    //                 return;
    //             }
    //         }
    //     }

    //     // *** NUEVA LÓGICA: Registrar experiencias laborales si 'tiene_experiencia_laboral' es '1' ***
    //     if ($this->input->post('tiene_experiencia_laboral') == '1') {
    //         $experiencias = $this->input->post('experiencias');
    //         foreach ($experiencias as $experiencia) {
    //             $experiencia_data = [
    //                 'id_curriculum' => $id_curriculum,
    //                 'nombreinstitucion' => $this->security->xss_clean($experiencia['institucion']),
    //                 'cargo' => $this->security->xss_clean($experiencia['cargo']),
    //                 'tiempo' => $this->security->xss_clean($experiencia['tiempo_cargo']),
    //                 'desde' => $this->security->xss_clean($experiencia['desde']),
    //                 'hasta' => $this->security->xss_clean($experiencia['hasta'])
    //             ];

    //             if (!$this->Diplomado_model->registrar_experiencia_laboral($experiencia_data)) {
    //                 $this->output->set_status_header(500);
    //                 echo json_encode(['success' => false, 'message' => 'Error al registrar una o más experiencias laborales.']);
    //                 return;
    //             }
    //         }
    //     }

    //     // Registrar inscripción
    //     $result = $this->Diplomado_model->registrar_inscripcion(
    //         $id_participante,
    //         $this->input->post('id_diplomado')
    //     );

    //     if ($result) {
    //         // Obtener el código de planilla
    //         $this->db->select('codigo_planilla');
    //         $this->db->where('id_participante', $id_participante);
    //         $inscripcion = $this->db->get('diplomado.inscripciones')->row_array();

    //         echo json_encode([
    //             'success' => true,
    //             'message' => 'Inscripción registrada correctamente',
    //             'codigo' => $inscripcion['codigo_planilla']
    //         ]);
    //     } else {
    //         $this->output->set_status_header(500);
    //         echo json_encode(['success' => false, 'message' => 'Error al registrar la inscripción']);
    //     }
    // }

    public function guardar_inscripcion()
    {
        // Iniciar transacción
        $this->db->trans_begin();
        // Validar campos obligatorios base
        $required_fields = [
            'id_diplomado',
            'cedula_f',
            'name_f',
            'apellido_f',
            'telefono_f',
            'edad',

            'direccion_fiscal_',
            // 'trabajo' -> ELIMINADO: Ya no es un campo directo
            'grado_instruccion', // Movido aquí por ser info básica del participante
            'titulo_obtenido',   // Movido aquí por ser info básica del participante
            't_contrata_p',      // Movido aquí por ser info básica del participante
            'tiene_capacitacion', // Movido aquí por ser info básica del participante
            'tiene_experiencia_laboral' // Este es el campo unificado
        ];

        foreach ($required_fields as $field) {
            if (empty($this->input->post($field))) {
                $this->output->set_status_header(400);
                echo json_encode(['success' => false, 'message' => 'El campo ' . $field . ' es requerido']);
                return;
            }
        }

        if (!empty($this->input->post('correo')) && !filter_var($this->input->post('correo'), FILTER_VALIDATE_EMAIL)) {
            $this->output->set_status_header(400);
            echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido']);
            return;
        }
        // --- NUEVO: Validar duplicidad de Cédula para Persona Natural y Diplomado ---
        $cedula_participante = $this->security->xss_clean($this->input->post('cedula_f'));
        $id_diplomado_seleccionado = $this->security->xss_clean($this->input->post('id_diplomado'));

        if ($this->Diplomado_model->check_cedula_diplomado_preinscripcion($cedula_participante, $id_diplomado_seleccionado, 1)) { // 1 = id_tipo Persona Natural
            throw new Exception("Esta cédula ya tiene una preinscripción registrada para este diplomado.");
        }
        // --- FIN NUEVA VALIDACIÓN ---

        // Ya no necesitamos un $required_curricular separado, ya está en required_fields
        // Eliminar validación para información curricular si ya está en required_fields
        // $required_curricular = [ ... ];
        // foreach ($required_curricular as $field) { ... }


        // --- Inicializar id_empresa_participante ---
        // Este ID se actualizará si hay un empleo actual marcado.
        // Asume que 1 es el ID para "No aplica" o "No tiene empleo actual" en tu tabla `diplomado.empresas`.
        $id_empresa_participante = 1;

        // --- LÓGICA DE REGISTRO DE PARTICIPANTE (al inicio, para tener id_participante) ---
        // Se registra con el id_empresa por defecto (1), y se actualizará si aplica.
        $id_participante = $this->Diplomado_model->registrar_participante(
            $this->input->post(),
            $id_empresa_participante
        );

        if (!$id_participante) {
            $this->output->set_status_header(500);
            echo json_encode(['success' => false, 'message' => 'Error al registrar el participante.']);
            return;
        }

        // --- LÓGICA PARA EL CURRICULUM ---
        // Determinar valor para 'experiencia_contrataciones_publicas'
        $experiencia_contrataciones_publicas = ($this->input->post('t_contrata_p') == '2') ? 0 : $this->security->xss_clean($this->input->post('experiencia_publicas'));

        // Registrar información curricular
        $curriculum_data = [
            'id_participante' => $id_participante,
            'grado_instruccion' => $this->security->xss_clean($this->input->post('grado_instruccion')),
            'titulo_obtenido' => $this->security->xss_clean($this->input->post('titulo_obtenido')),
            'experiencia_contrataciones_publicas' => $experiencia_contrataciones_publicas,
            't_contrata_p' => $this->security->xss_clean($this->input->post('t_contrata_p')),
            'tiene_capacitacion_contrataciones' => $this->security->xss_clean($this->input->post('tiene_capacitacion')),
            'exp_5_anio' => $this->security->xss_clean($this->input->post('tiene_experiencia_laboral')),
        ];

        $id_curriculum = $this->Diplomado_model->registrar_curriculum($curriculum_data);

        if (!$id_curriculum) {
            $this->output->set_status_header(500);
            echo json_encode(['success' => false, 'message' => 'Error al registrar información curricular.']);
            return;
        }

        // --- Lógica de Registro de Capacitaciones (Tu lógica existente) ---
        if ($this->input->post('tiene_capacitacion') == '1') {
            $capacitaciones = $this->input->post('capacitaciones');
            if (empty($capacitaciones)) { // Re-validar por si se borraron dinámicamente
                $this->output->set_status_header(400);
                echo json_encode(['success' => false, 'message' => 'Debe agregar al menos una capacitación en Contrataciones Públicas.']);
                return;
            }

            foreach ($capacitaciones as $idx => $capacitacion) {
                // ... (validaciones existentes para id_curso y nombre_curso_otro) ...

                // --- INICIO: NUEVA LÓGICA PARA INSTITUCIÓN FORMADORA ---

                // 1. Validar que se haya seleccionado una institución formadora
                if (empty($capacitacion['id_institucion_formadora'])) {
                    $this->output->set_status_header(400);
                    echo json_encode(['success' => false, 'message' => 'Seleccione una institución formadora para la capacitación #' . ($idx + 1)]);
                    return;
                }

                // 2. Validar el campo 'nombre_institucion_formadora_otro' si se seleccionó "Contralorías" (5) u "Otros" (6)
                $id_institucion_formadora_seleccionada = $this->security->xss_clean($capacitacion['id_institucion_formadora']);

                if (($id_institucion_formadora_seleccionada == '5' || $id_institucion_formadora_seleccionada == '6') && empty($capacitacion['nombre_institucion_formadora_otro'])) {
                    $this->output->set_status_header(400);
                    echo json_encode(['success' => false, 'message' => 'Especifique el nombre de la institución formadora para la capacitación #' . ($idx + 1)]);
                    return;
                }

                // 3. Determinar el nombre de la institución a guardar
                $nombre_institucion_a_guardar = '';

                if ($id_institucion_formadora_seleccionada == '5' || $id_institucion_formadora_seleccionada == '6') {
                    // Si es "Contralorías" u "Otros", usamos el valor del campo de texto
                    $nombre_institucion_a_guardar = $this->security->xss_clean($capacitacion['nombre_institucion_formadora_otro']);
                } else {
                    // Si es una institución predefinida, obtenemos su descripción de la base de datos
                    // Necesitas un método en tu modelo: $this->Diplomado_model->obtener_institucion_por_id($id_institucion_formadora_seleccionada)
                    $institucion_seleccionada_db = $this->Diplomado_model->obtener_institucion_por_id($id_institucion_formadora_seleccionada);
                    if ($institucion_seleccionada_db) {
                        $nombre_institucion_a_guardar = $institucion_seleccionada_db['descripcion_f'];
                    } else {
                        // Fallback si el ID no existe en la BD (esto no debería pasar si el select se llena bien)
                        $nombre_institucion_a_guardar = "Institución Desconocida (ID: " . $id_institucion_formadora_seleccionada . ")";
                    }
                }


                $nombre_curso_a_guardar = '';
                $id_curso_a_guardar = $this->security->xss_clean($capacitacion['id_curso']);

                if ($id_curso_a_guardar == '8') { // Si es "Otros"
                    $nombre_curso_a_guardar = $this->security->xss_clean($capacitacion['nombre_curso_otro']);
                } else {
                    $curso_seleccionado = array_filter($this->Diplomado_model->obtener_todos_los_cursos(), function ($curso) use ($id_curso_a_guardar) {
                        return $curso['id_cursos'] == $id_curso_a_guardar;
                    });
                    $curso_seleccionado = reset($curso_seleccionado);

                    if ($curso_seleccionado) {
                        $nombre_curso_a_guardar = $curso_seleccionado['descripcion_cursos'];
                    } else {
                        $nombre_curso_a_guardar = "Curso Desconocido (ID: " . $id_curso_a_guardar . ")";
                    }
                }

                // --- Actualizar el array $capacitacion_data para guardar ---
                $capacitacion_data = [
                    'id_curriculum' => $id_curriculum,
                    'nombre_curso' => $nombre_curso_a_guardar,
                    // CAMBIO AQUÍ: Ahora usamos el nombre de la institución que hemos determinado
                    'institucion_formadora' => $nombre_institucion_a_guardar,
                    'anio_realizacion' => $this->security->xss_clean($capacitacion['anio']),
                    'horas' => $this->security->xss_clean($capacitacion['horas'])
                ];

                if (!$this->Diplomado_model->registrar_capacitacion($capacitacion_data)) {
                    $this->output->set_status_header(500);
                    echo json_encode(['success' => false, 'message' => 'Error al registrar una o más capacitaciones.']);
                    return;
                }
            }
        }

        // --- LÓGICA UNIFICADA PARA EXPERIENCIA LABORAL Y GESTIÓN DE EMPRESA ---
        if ($this->input->post('tiene_experiencia_laboral') == '1') {
            $experiencias = $this->input->post('experiencias');
            if (empty($experiencias)) { // Re-validar por si se borraron dinámicamente
                $this->output->set_status_header(400);
                echo json_encode(['success' => false, 'message' => 'Debe agregar al menos una experiencia laboral.']);
                return;
            }

            foreach ($experiencias as $idx => $experiencia) {
                // Validar campos básicos de experiencia laboral
                if (empty($experiencia['cargo']) || empty($experiencia['tiempo_cargo']) || empty($experiencia['desde']) || empty($experiencia['hasta'])) {
                    $this->output->set_status_header(400);
                    echo json_encode(['success' => false, 'message' => 'Complete todos los campos (cargo, tiempo, inicio, fin) para la experiencia laboral #' . ($idx + 1)]);
                    return;
                }
                $fecha_hasta = new DateTime($experiencia['hasta']);
                $hoy = new DateTime();
                if ($fecha_hasta > $hoy) {
                    $this->output->set_status_header(400);
                    echo json_encode(['success' => false, 'message' => 'La fecha de fin para la experiencia laboral #' . ($idx + 1) . ' no puede ser mayor a la fecha actual.']);
                    return;
                }

                // --- Lógica para la Institución (RIF y datos de empresa) ---
                $id_empresa_asociada_experiencia = null; // ID de la empresa de esta experiencia
                $rif_a_guardar = '';
                $razon_social_a_guardar = '';
                $telefono_a_guardar = '0'; // Valores por defecto para nueva empresa
                $direccion_a_guardar = '-'; // Valores por defecto para nueva empresa

                // Validar que se haya ingresado el RIF inicial para la experiencia
                if (empty($experiencia['rif_institucion'])) {
                    $this->output->set_status_header(400);
                    echo json_encode(['success' => false, 'message' => 'Ingrese el RIF de la institución para la experiencia laboral #' . ($idx + 1)]);
                    return;
                }

                // --- Determinar qué datos de empresa usar (existente o nueva) ---
                if (!empty($experiencia['rif_existente'])) { // Viene de la sección 'existe'
                    $rif_a_guardar = $this->security->xss_clean($experiencia['rif_existente']);
                    $razon_social_a_guardar = $this->security->xss_clean($experiencia['razon_social_existente']);

                    // Al ser una empresa existente, obtenemos sus datos completos de la base de datos
                    $empresa_data_db = $this->Diplomado_model->verificar_rif_empresa($rif_a_guardar);
                    if ($empresa_data_db) {
                        $telefono_a_guardar = $empresa_data_db['telefono'];
                        $direccion_a_guardar = $empresa_data_db['direccion_fiscal'];
                    }
                } else if (!empty($experiencia['rif_nuevo'])) { // Viene de la sección 'no_existe'
                    $rif_a_guardar = $this->security->xss_clean($experiencia['rif_nuevo']);
                    $razon_social_a_guardar = $this->security->xss_clean($experiencia['razon_social_nueva']);
                    $telefono_a_guardar = $this->security->xss_clean($experiencia['tel_local_nuevo']);
                    $direccion_a_guardar = $this->security->xss_clean($experiencia['direccion_fiscal_nueva']);

                    // Validar que los campos de nueva empresa no estén vacíos
                    if (empty($razon_social_a_guardar) || empty($telefono_a_guardar) || empty($direccion_a_guardar)) {
                        $this->output->set_status_header(400);
                        echo json_encode(['success' => false, 'message' => 'Complete todos los datos (Razón Social, Teléfono, Dirección) de la institución para la experiencia laboral #' . ($idx + 1)]);
                        return;
                    }
                } else {
                    // Esto debería ser capturado por la validación de 'rif_institucion' pero como fallback
                    $this->output->set_status_header(400);
                    echo json_encode(['success' => false, 'message' => 'Faltan datos del RIF para la experiencia laboral  #' . ($idx + 1) . ' recuerde usar el boton consultar rif.']);
                    return;
                }

                // --- Registrar o Verificar la Empresa en `diplomado.empresas` ---
                $empresa_en_db = $this->Diplomado_model->verificar_rif_empresa($rif_a_guardar);
                if (!$empresa_en_db) {
                    // La empresa no existe en nuestra tabla `diplomado.empresas`, la registramos
                    $id_empresa_asociada_experiencia = $this->Diplomado_model->registrar_empresa(
                        $rif_a_guardar,
                        $razon_social_a_guardar,
                        $telefono_a_guardar,
                        $direccion_a_guardar
                    );
                } else {
                    // La empresa ya existe, usamos su ID
                    $id_empresa_asociada_experiencia = $empresa_en_db['id_empresa'];
                    // Asegurarse de usar la razón social de la base de datos si ya existe
                    $razon_social_a_guardar = $empresa_en_db['razon_social'];
                }

                if (!$id_empresa_asociada_experiencia) {
                    $this->output->set_status_header(500);
                    echo json_encode(['success' => false, 'message' => 'Error al procesar la institución para la experiencia laboral #' . ($idx + 1)]);
                    return;
                }

                // --- Determinar si es el empleo actual del participante ---
                $es_actual = isset($experiencia['es_actual']) && $experiencia['es_actual'] == '1';
                if ($es_actual) {
                    $id_empresa_participante = $id_empresa_asociada_experiencia; // Este será el ID final para el participante
                }

                // --- Registrar la Experiencia Laboral ---
                $experiencia_data = [
                    'id_curriculum' => $id_curriculum,
                    'nombreinstitucion' => $razon_social_a_guardar, // Guarda la razón social de la empresa
                    'cargo' => $this->security->xss_clean($experiencia['cargo']),
                    'tiempo' => $this->security->xss_clean($experiencia['tiempo_cargo']),
                    'desde' => $this->security->xss_clean($experiencia['desde']),
                    'hasta' => $this->security->xss_clean($experiencia['hasta'])
                    // Puedes agregar id_empresa_asociada_experiencia o es_actual aquí si tu tabla experienci_5_anio lo tiene
                    // 'id_empresa_asociada' => $id_empresa_asociada_experiencia,
                    // 'es_actual' => $es_actual ? 1 : 0
                ];

                if (!$this->Diplomado_model->registrar_experiencia_laboral($experiencia_data)) {
                    $this->output->set_status_header(500);
                    echo json_encode(['success' => false, 'message' => 'Error al registrar una o más experiencias laborales.']);
                    return;
                }
            } // Fin foreach experiencias

            // --- Actualizar id_empresa del Participante al final ---
            // Solo si se encontró un empleo actual válido (no el valor por defecto 1)
            if ($id_empresa_participante !== 1) {
                $this->Diplomado_model->actualizar_id_empresa_participante($id_participante, $id_empresa_participante);
            }
        } // Fin if tiene_experiencia_laboral

        // --- Registrar Inscripción Final ---
        $result = $this->Diplomado_model->registrar_inscripcion(
            $id_participante,
            $this->input->post('id_diplomado')
        );

        if ($result) {
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
            echo json_encode(['success' => false, 'message' => 'Error al registrar la inscripción.']);
        }
    }
    ////////////CURSOS
    public function obtener_cursos_json()
    {
        $cursos = $this->Diplomado_model->obtener_todos_los_cursos();
        if ($cursos) {
            echo json_encode(['success' => true, 'cursos' => $cursos]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontraron cursos.']);
        }
    }
    ////////instituciones 
    public function obtener_inst_formadora_json()
    {
        $this->output->set_content_type('application/json');

        $instituciones = $this->Diplomado_model->obtener_instituciones_formadoras(); // Llama a un método en tu modelo

        if ($instituciones) {
            echo json_encode(['success' => true, 'instituciones' => $instituciones]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontraron instituciones formadoras.']);
        }
    }
    //////////////////
    public function sel_participantes()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['participantes'] = $this->Diplomado_model->consultar_participantes();
        $data['inscripcion_stats'] = $this->Diplomado_model->get_inscripciones_stats();

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
        // $data['participantes'] = $this->Diplomado_model->consultar_participantes_juridico1();
        $data['empresas'] = $this->Diplomado_model->consultar_empresa();
        $data['inscripcion_juridica_stats'] = $this->Diplomado_model->get_inscripciones_juridicas_stats();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        //   $this->load->view('diplomado/participantes_juridico.php', $data);
        $this->load->view('diplomado/empresa_juridica.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function miemb()
    {
        if (!$this->session->userdata('session')) redirect('login');
        //Información traido por el session de usuario para mostrar inf

        $data['id_inscripcion_grupal'] = $this->input->get('id');

        $data['participantes'] = $this->Diplomado_model->consultar_participantes_juridico1($data['id_inscripcion_grupal']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('diplomado/slect_p_j.php', $data);
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
            'tipo_pago' => $this->input->post('tipo_pago'),

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

                // // Validar cédula
                // if (!preg_match('/^\d{8}$/', $participante['cedula'])) {
                //     throw new Exception("Participante #{$index}: La cédula debe tener 8 dígitos");
                // }

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
                            // Validar id_curso
                            if (empty($capacitacion['id_curso'])) {
                                throw new Exception("Participante #{$index}, Capacitación #{$cap_index}: Seleccione un curso.");
                            }
                            // Validar nombre_curso_otro si id_curso es '8' (Otros)
                            if ($capacitacion['id_curso'] == '8' && empty($capacitacion['nombre_curso_otro'])) {
                                throw new Exception("Participante #{$index}, Capacitación #{$cap_index}: Especifique el nombre del curso 'Otros'.");
                            }

                            // Validar id_institucion_formadora
                            if (empty($capacitacion['id_institucion_formadora'])) {
                                throw new Exception("Participante #{$index}, Capacitación #{$cap_index}: Seleccione una institución formadora.");
                            }
                            // Validar nombre_institucion_formadora_otro si id_institucion_formadora es '5' o '6'
                            if (($capacitacion['id_institucion_formadora'] == '5' || $capacitacion['id_institucion_formadora'] == '6') && empty($capacitacion['nombre_institucion_formadora_otro'])) {
                                throw new Exception("Participante #{$index}, Capacitación #{$cap_index}: Especifique el nombre de la institución formadora.");
                            }

                            // Validar anio_realizacion
                            if (empty($capacitacion['anio']) || !is_numeric($capacitacion['anio']) || $capacitacion['anio'] < 1900 || $capacitacion['anio'] > date('Y')) {
                                throw new Exception("Participante #{$index}, Capacitación #{$cap_index}: El año de realización no es válido.");
                            }
                            // Validar horas (si existe y si es numérico)
                            if (isset($capacitacion['horas']) && !empty($capacitacion['horas']) && (!is_numeric($capacitacion['horas']) || $capacitacion['horas'] < 0)) {
                                throw new Exception("Participante #{$index}, Capacitación #{$cap_index}: Las horas deben ser un número válido.");
                            }


                            // --- Determinar el nombre final del curso ---
                            $nombre_curso_final = '';
                            $id_curso_seleccionado = $this->security->xss_clean($capacitacion['id_curso']);

                            if ($id_curso_seleccionado == '8') { // Si es "Otros"
                                $nombre_curso_final = $this->security->xss_clean($capacitacion['nombre_curso_otro']);
                            } else {
                                // Suponiendo que tienes un modelo para obtener la descripción del curso por ID
                                $curso_db = $this->Diplomado_model->obtener_curso_por_id($id_curso_seleccionado);
                                if ($curso_db) {
                                    $nombre_curso_final = $curso_db['descripcion_cursos'];
                                } else {
                                    $nombre_curso_final = "Curso Desconocido (ID: " . $id_curso_seleccionado . ")";
                                }
                            }

                            // --- Determinar el nombre final de la institución formadora ---
                            $nombre_institucion_final = '';
                            $id_institucion_seleccionada = $this->security->xss_clean($capacitacion['id_institucion_formadora']);

                            if ($id_institucion_seleccionada == '5' || $id_institucion_seleccionada == '6') { // Si es "Contralorías" u "Otros"
                                $nombre_institucion_final = $this->security->xss_clean($capacitacion['nombre_institucion_formadora_otro']);
                            } else {
                                // Suponiendo que tienes un modelo para obtener la descripción de la institución por ID
                                $institucion_db = $this->Diplomado_model->obtener_institucion_por_id($id_institucion_seleccionada);
                                if ($institucion_db) {
                                    $nombre_institucion_final = $institucion_db['descripcion_f'];
                                } else {
                                    $nombre_institucion_final = "Institución Desconocida (ID: " . $id_institucion_seleccionada . ")";
                                }
                            }
                        }

                        $capacitacion_data = [
                            'id_curriculum' => $id_curriculum,
                            'nombre_curso' => $nombre_curso_final, // Nombre ya procesado
                            'institucion_formadora' => $nombre_institucion_final, // Nombre ya procesado
                            'anio_realizacion' => $this->security->xss_clean($capacitacion['anio']),
                            'horas' => !empty($capacitacion['horas']) ? $this->security->xss_clean($capacitacion['horas']) : null // Horas pueden ser null
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
    // public function verificar_referencia()
    // {
    //     $this->output->set_content_type('application/json');

    //     // Log de depuración
    //     log_message('debug', 'Solicitud de verificación recibida: ' . print_r($this->input->post(), true));

    //     $referencia = $this->input->post('referencia');

    //     if (empty($referencia)) {
    //         log_message('debug', 'Referencia vacía recibida');
    //         return $this->output->set_output(json_encode([
    //             'success' => false,
    //             'message' => 'Debe proporcionar una referencia'
    //         ]));
    //     }

    //     // Configurar API
    //     $api_key = $this->config->item('banvenez_api_key2');
    //     $url = 'https://bdvconciliacionqa.banvenez.com:444/apis/bdv/consulta/movimientos/v2';

    //     $data = [
    //         'cuenta' => '01020501830003283374',
    //         'fechaIni' => date('d/m/Y', strtotime('-1 month')),
    //         'fechaFin' => date('d/m/Y'),
    //         'tipoMoneda' => 'VES',
    //         'nroMovimiento' => ''
    //     ];

    //     log_message('debug', 'Datos enviados a API: ' . print_r($data, true));

    //     $options = [
    //         'http' => [
    //             'header'  => "Content-Type: application/json\r\nX-API-KEY: $api_key\r\n",
    //             'method'  => 'POST',
    //             'content' => json_encode($data),
    //             'ignore_errors' => true
    //         ],
    //         'ssl' => [
    //             'verify_peer' => false,
    //             'verify_peer_name' => false
    //         ]
    //     ];

    //     $context = stream_context_create($options);

    //     try {
    //         log_message('debug', 'Intentando conectar con API...');
    //         $result = file_get_contents($url, false, $context);

    //         if ($result === FALSE) {
    //             $error = error_get_last();
    //             log_message('error', 'Error al conectar con API: ' . print_r($error, true));
    //             return $this->output->set_output(json_encode([
    //                 'success' => false,
    //                 'message' => 'Error al conectar con el servicio de verificación',
    //                 'error' => $error['message'] ?? 'Desconocido'
    //             ]));
    //         }

    //         log_message('debug', 'Respuesta cruda de API: ' . $result);

    //         $response = json_decode($result, true);

    //         if (json_last_error() !== JSON_ERROR_NONE) {
    //             log_message('error', 'Error decodificando JSON: ' . json_last_error_msg());
    //             return $this->output->set_output(json_encode([
    //                 'success' => false,
    //                 'message' => 'Respuesta no válida del servidor',
    //                 'raw_response' => $result
    //             ]));
    //         }

    //         log_message('debug', 'Respuesta decodificada: ' . print_r($response, true));

    //         if (isset($response['code']) && $response['code'] == '1000' && !empty($response['data'])) {
    //             foreach ($response['data'] as $movimiento) {
    //                 if (isset($movimiento['referencia']) && $movimiento['referencia'] == $referencia) {
    //                     log_message('debug', 'Referencia encontrada: ' . $referencia);
    //                     return $this->output->set_output(json_encode([
    //                         'success' => true,
    //                         'message' => 'Referencia encontrada',
    //                         'data' => $movimiento
    //                     ]));
    //                 }
    //             }
    //             log_message('debug', 'Referencia no encontrada en los datos');
    //         } else {
    //             log_message('debug', 'Respuesta API no exitosa o sin datos');
    //         }

    //         return $this->output->set_output(json_encode([
    //             'success' => false,
    //             'message' => 'No se encontró la referencia en los registros del período consultado',
    //             'api_response' => $response
    //         ]));
    //     } catch (Exception $e) {
    //         log_message('error', 'Excepción al validar referencia: ' . $e->getMessage());
    //         return $this->output->set_output(json_encode([
    //             'success' => false,
    //             'message' => 'Error al validar la referencia: ' . $e->getMessage()
    //         ]));
    //     }
    // }

    public function verificar_referencia_v2()
    {
        $this->output->set_content_type('application/json');

        // Verificar CSRF
        // Considera que el token CSRF debería manejarse de forma más robusta,
        // pero para el ejemplo, tu implementación actual es funcional.
        // if (!$this->input->post($this->security->get_csrf_token_name())) {
        //     return $this->output->set_output(json_encode([
        //         'success' => false,
        //         'message' => 'Token de seguridad inválido o expirado. Por favor, recargue la página.'
        //     ]));
        // }

        $referencia = $this->input->post('referencia');

        if (empty($referencia)) {
            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Debe proporcionar un número de referencia.'
            ]));
        }

        // Cargar helper y config
        $this->load->helper('banvenez_api');
        // Asegúrate de que 'banvenez_api_key2' esté configurada en application/config/config.php
        $api_key = $this->config->item('banvenez_api_key2');

        // Usar helper para consultar y filtrar
        $result = consulta_movimientos_banvenez_v2($api_key, $referencia);

        if ($result['success']) {
            return $this->output->set_output(json_encode([
                'success' => true,
                'message' => $result['message'] ?? 'Referencia encontrada.',
                'data'    => $result['data'] // Esto ahora será el objeto del movimiento coincidente
            ]));
        } else {
            // Maneja los diferentes tipos de errores desde el helper
            $errorMessage = 'Error al verificar referencia.';
            if (isset($result['error']['message'])) {
                $errorMessage = $result['error']['message'];
            } elseif (isset($result['message'])) {
                $errorMessage = $result['message']; // En caso de que el helper use 'message' para errores también
            }

            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => $errorMessage,
                'error'   => $result['error'] ?? null // Puedes enviar el objeto de error para depuración
            ]));
        }
    }

    public function guardar_conciliado()
    {
        $this->output->set_content_type('application/json');

        // *** Opcional pero recomendado: Validar CSRF si lo tienes habilitado ***
        // Si $config['csrf_protection'] = TRUE;, descomenta estas líneas:
        /*
        if (!$this->input->post($this->security->get_csrf_token_name())) {
            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Token de seguridad inválido o expirado. Por favor, recargue la página.'
            ]));
        }
        */

        // 1. Validar que la referencia ha sido verificada
        // Esto depende del campo oculto 'pagoVerificado' que envías desde el frontend.
        $pago_verificado = $this->input->post('pagoVerificado');
        if (empty($pago_verificado) || $pago_verificado != '1') {
            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'El pago no ha sido verificado. Por favor, valide la referencia antes de guardar.'
            ]));
        }

        // 2. Obtener todos los datos del formulario
        // CodeIgniter's $this->input->post() obtiene todos los datos POST por defecto
        $data_form = $this->input->post();

        // Puedes agregar más validaciones aquí si es necesario (ej. usando form_validation)
        // Ejemplo:
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('referencia', 'Referencia', 'required|min_length[5]|max_length[20]');
        // if ($this->form_validation->run() == FALSE) {
        //     return $this->output->set_output(json_encode([
        //         'success' => false,
        //         'message' => validation_errors()
        //     ]));
        // }

        // 3. Llamar al modelo para guardar los datos
        $id_insertado = $this->Diplomado_model->guardar_pago_conciliado($data_form);

        if ($id_insertado) {
            return $this->output->set_output(json_encode([
                'success' => true,
                'message' => 'Pago conciliado guardado exitosamente con ID: ' . $id_insertado
            ]));
        } else {
            return $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Error al guardar el pago conciliado. Intente de nuevo.'
            ]));
        }
    }

    public function verificar_preinscripcion_rif_diplomado()
    {
        $this->output->set_content_type('application/json');

        $rif = $this->input->post('rif');
        $id_diplomado = $this->input->post('id_diplomado');

        if (empty($rif) || empty($id_diplomado)) {
            echo json_encode([
                'success' => false,
                'message' => 'RIF y ID de diplomado son requeridos para la verificación.',
                'exists' => false
            ]);
            return;
        }

        // Limpiar y normalizar el RIF para la consulta (igual que en el frontend y en la BD)
        $rif_limpio = strtoupper(preg_replace('/[^A-Z0-9]/', '', $rif));

        try {
            // Llama a un método en el modelo para verificar la existencia
            $already_registered = $this->Diplomado_model->check_rif_diplomado_preinscripcion($rif_limpio, $id_diplomado);

            if ($already_registered) {
                echo json_encode([
                    'success' => true,
                    'exists' => true,
                    'message' => 'Este RIF ya tiene una preinscripción registrada para este diplomado. Por favor, seleccione otro diplomado o ingrese un RIF diferente.'
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'exists' => false,
                    'message' => 'RIF disponible para preinscripción.'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error en el servidor al verificar preinscripción: ' . $e->getMessage(),
                'exists' => false
            ]);
        }
    }

    ///// editar diplomando 
    // Nueva función en el controlador para obtener datos del diplomado por ID
    public function get_diplomado_data()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['status' => 'error', 'message' => 'Sesión no iniciada.']);
            return;
        }

        $id_diplomado = $this->input->post('id_diplomado'); // Obtén el ID enviado por AJAX

        if ($id_diplomado) {
            $diplomado = $this->Diplomado_model->get_diplomado_by_id2($id_diplomado);
            if ($diplomado) {
                // Formatea las fechas para que los input[type="date"] las reconozcan
                $diplomado['fdesde'] = date('Y-m-d', strtotime($diplomado['fdesde']));
                $diplomado['fhasta'] = date('Y-m-d', strtotime($diplomado['fhasta']));
                $diplomado['pago2desde'] = date('Y-m-d', strtotime($diplomado['pago2desde']));
                $diplomado['pago2hasta'] = date('Y-m-d', strtotime($diplomado['pago2hasta']));

                echo json_encode(['status' => 'success', 'data' => $diplomado]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Diplomado no encontrado.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID de diplomado no proporcionado.']);
        }
    }

    // Nueva función en el controlador para actualizar los datos del diplomado
    public function actualizar_diplomado()
    {
        // 1. Verificación de sesión
        if (!$this->session->userdata('session')) {
            log_message('warn', 'Intento de acceso no autorizado a actualizar_diplomado (sin sesión).');
            echo json_encode(['status' => 'error', 'message' => 'Su sesión ha expirado o no está iniciada. Por favor, inicie sesión nuevamente.']);
            return;
        }

        // 2. Obtener y validar ID
        // Con el cambio en JS, $this->input->post('id_diplomado_edit') ahora DEBERÍA funcionar
        $id_diplomado = $this->input->post('id_diplomado_edit');
        log_message('debug', 'Controlador: Valor recibido para id_diplomado_edit: ' . $id_diplomado); // Mantén este log para verificar

        if (empty($id_diplomado)) {
            log_message('error', 'Actualización de diplomado fallida: ID de diplomado no proporcionado o vacío.');
            echo json_encode(['status' => 'error', 'message' => 'No se pudo identificar el diplomado a actualizar.']);
            return;
        }

        // 3. Configurar reglas de validación (¡Recomendado y crucial!)
        $this->form_validation->set_rules('name_d_edit', 'Nombre del Diplomado', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('fdesde_edit', 'Fecha de Inicio', 'required|trim');
        $this->form_validation->set_rules('fhasta_edit', 'Fecha de Culminación', 'required|trim');
        $this->form_validation->set_rules('id_modalidad_edit', 'Modalidad', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('topmax_edit', 'Número Máximo de Participantes', 'required|numeric|integer|greater_than[0]');
        $this->form_validation->set_rules('topmin_edit', 'Número de Participantes Exonerados', 'required|numeric|integer|greater_than_equal_to[0]|less_than_equal_to[' . $this->input->post('topmax_edit') . ']');
        $this->form_validation->set_rules('pay_edit', 'Costo del Diplomado', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('pronto_pago_edit', 'Costo Pronto Pago', 'numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('d_hrs_edit', 'Duración en Horas', 'required|numeric|integer|greater_than[0]');
        $this->form_validation->set_rules('pago2desde_edit', 'Fecha desde Segundo Pago', 'required|trim');
        $this->form_validation->set_rules('pago2hasta_edit', 'Fecha hasta Segundo Pago', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            log_message('error', 'Errores de validación en actualizar_diplomado: ' . $errors);
            echo json_encode(['status' => 'error', 'message' => 'Errores en los datos: ' . strip_tags($errors)]);
            return;
        }

        // 4. Preparar los datos
        $data_to_update = array(
            'name_d' => $this->input->post('name_d_edit'),
            'fdesde' => $this->input->post('fdesde_edit'),
            'fhasta' => $this->input->post('fhasta_edit'),
            'id_modalidad' => $this->input->post('id_modalidad_edit'),
            'topmax' => $this->input->post('topmax_edit'),
            'topmin' => $this->input->post('topmin_edit'),
            'pay' => $this->input->post('pay_edit'),
            'pronto_pago' => $this->input->post('pronto_pago_edit') ?? 0,
            'd_hrs' => $this->input->post('d_hrs_edit'),
            'pago2desde' => $this->input->post('pago2desde_edit'),
            'pago2hasta' => $this->input->post('pago2hasta_edit'),
        );

        // 5. Llamar al modelo para actualizar
        $result = $this->Diplomado_model->actualizar_diplomado($id_diplomado, $data_to_update);

        // 6. Enviar respuesta al cliente
        if ($result['status']) {
            echo json_encode(['status' => 'success', 'message' => $result['message']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => $result['message']]);
        }
    }

    /// cambio estatus 
    public function cambiar_estatus_diplomado()
    {
        if (!$this->session->userdata('session')) {
            log_message('warn', 'Intento de acceso no autorizado a cambiar_estatus_diplomado (sin sesión).');
            echo json_encode(['status' => 'error', 'message' => 'Su sesión ha expirado o no está iniciada.']);
            return;
        }

        $id_diplomado = $this->input->post('id_diplomado');
        $current_estatus = $this->input->post('current_estatus');

        if (empty($id_diplomado) || empty($current_estatus)) {
            log_message('error', 'Cambio de estatus fallido: ID de diplomado o estatus actual no proporcionado.');
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos para cambiar el estatus.']);
            return;
        }

        // Determinar el nuevo estatus
        $new_estatus = ($current_estatus == 1) ? 2 : 1; // Si estaba en 1 (Disponible), pasa a 2 (No Disponible), y viceversa.

        // Llamar al modelo
        $result = $this->Diplomado_model->actualizar_estatus_diplomado($id_diplomado, $new_estatus);

        // Enviar respuesta al cliente
        if ($result['status']) {
            echo json_encode(['status' => 'success', 'message' => $result['message'], 'new_estatus' => $new_estatus]);
        } else {
            echo json_encode(['status' => 'error', 'message' => $result['message']]);
        }
    }
}
