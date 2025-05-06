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
    public function registrar_b()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'name_d' => $this->input->POST('name_d'),
            'fdesde' => $this->input->POST('fdesde'),
            'fhasta' => $this->input->POST('fhasta'),
            'id_modalidad' => $this->input->POST('id_modalidad'),
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


    public function solic()
    {
        if (!$this->session->userdata('session')) {

            $data['final']  = $this->User_model->consulta_organoente();
            $data['clasificacion'] = $this->Diplomado_model->consulta_grado();
            $data['diplomado'] = $this->Diplomado_model->consulta_diplomado();
            $data['banco'] = $this->Diplomado_model->consulta_banco();



            $data['estados']    = $this->Configuracion_model->consulta_estados();
            $data['objeto']    = $this->Configuracion_model->objeto();
            // $this->load->view('templates/header.php');
            // $this->load->view('templates/navsinsesion.php');
            $this->load->view('templates/headerlog');
            $this->load->view('templates/navbarlog');
            $this->load->view('diplomado/solicitud.php', $data);
            $this->load->view('templates/footerlog');

            // $this->load->view('templates/footer.php');
        } else {
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

        // Validar que sea una petición POST
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            return;
        }

        // Validar campos requeridos
        $required_fields = ['cedulaPagador', 'telefonoPagador', 'referencia', 'fechaPago', 'importe', 'bancoOrigen'];
        foreach ($required_fields as $field) {
            if (empty($this->input->post($field))) {
                echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos']);
                return;
            }
        }

        // Preparar datos para la API
        $datos_api = [
            'cedulaPagador' => $this->input->post('cedulaPagador'),
            'telefonoPagador' => $this->input->post('telefonoPagador'),
            'telefonoDestino' => $this->input->post('telefonoDestino') ?: '',
            'referencia' => $this->input->post('referencia'),
            'fechaPago' => $this->input->post('fechaPago'),
            'importe' => $this->input->post('importe'),
            'bancoOrigen' => $this->input->post('bancoOrigen')
            // 'reqCed' => true
        ];

        // Configurar la API key de forma segura
        $api_key = $this->config->item('banvenez_api_key'); // Configurada en application/config/config.php

        // Llamar al helper que hará la petición
        $this->load->helper('banvenez_api');
        $response = verify_payment_with_banvenez($datos_api, $api_key);

        // Procesar respuesta
        if ($response['code'] == 1000) {
            echo json_encode(['success' => true, 'message' => 'Pago verificado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Pago no verificado', 'error' => $response['message'] ?? 'Error desconocido']);
        }
    }
}
