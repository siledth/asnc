<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reportes_model');
        $this->load->helper('url'); // Para la carga de assets
    }

    public function index()
    {
        $data = [
            'graficos_data' => null, // Inicialmente nulo
            'fecha_desde' => $this->input->post('fecha_desde') ? $this->input->post('fecha_desde') : '',
            'fecha_hasta' => $this->input->post('fecha_hasta') ? $this->input->post('fecha_hasta') : ''
        ];

        // Validar si se enviaron las fechas
        if (!empty($data['fecha_desde']) && !empty($data['fecha_hasta'])) {
            // Llamar al modelo solo si hay fechas
            $graficos_data = $this->Reportes_model->get_data_graficos($data['fecha_desde'], $data['fecha_hasta']);
            $data['graficos_data'] = $graficos_data;
        }
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('RNC/dashboard_view', $data);
        $this->load->view('templates/footer.php');
    }
}
