<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReporteRNCE extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ReporteG_model');
        // $this->load->library('pagination');
        //$this->load->model('Tablas_model');
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
                // 'total_notificadas' => $data['total_notificadas'] ?? 0
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
