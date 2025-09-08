<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteUsuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ReporteUsuarios_model');
    }
    public function reporte_usuarioM()
    {
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('reportes/reporte_usurioM.php');
        $this->load->view('templates/footer.php');
    }

    public function generarReporte()
    {
        header('Content-Type: application/json');

        try {
            $anio_actual = date('Y');
            $anio_anterior = $anio_actual - 1;

            $data = $this->ReporteUsuarios_model->obtenerUsuariosMensual($anio_actual, $anio_anterior);

            echo json_encode([
                'success' => true,
                'data' => $data,
                'anio_actual' => $anio_actual,
                'anio_anterior' => $anio_anterior
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
