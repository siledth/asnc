<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteTop10 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ReporteTop10_model');
    }

    public function reporte_top10()
    {
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('reportes/reporte_top10.php');
        $this->load->view('templates/footer.php');
    }

    public function generarReporte()
    {
        header('Content-Type: application/json');

        try {
            $anio_actual = date('Y');

            $data = [
                'top_solicitados' => $this->ReporteTop10_model->obtenerTop10Solicitados($anio_actual),
                'top_rendidos' => $this->ReporteTop10_model->obtenerTop10Rendidos($anio_actual),
                'top_organos' => $this->ReporteTop10_model->obtenerTop10Organos($anio_actual) // Nuevo
            ];

            echo json_encode([
                'success' => true,
                'data' => $data,
                'anio_actual' => $anio_actual
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
