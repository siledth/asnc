<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteGeneral extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cargar los modelos que se usarán en el reporte general
        $this->load->model('ReporteOrganosMensual_model');
        $this->load->model('ReporteUsuarios_model');
        $this->load->model('ReporteComisiones_model');
        $this->load->model('ReportePAC_model');
        $this->load->model('ReporteLlamados_model');
        $this->load->model('ReporteEvaluaciones_model');
        $this->load->model('ReporteTop10_model'); // Nuevo modelo
        // Agrega aquí los demás modelos a medida que los integremos
    }

    public function ReporteGeneral1()
    {
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('reportes/reporte_general.php');
        $this->load->view('templates/footer.php');
    }

    public function generarReporte()
    {
        header('Content-Type: application/json');

        try {
            $anio_actual = date('Y');
            $anio_anterior = $anio_actual - 1;

            // Obtener datos del primer reporte (Órganos)
            $reporteOrganos = $this->ReporteOrganosMensual_model->obtenerOrganosMensual($anio_actual, $anio_anterior);

            // Obtener datos del segundo reporte (Usuarios)
            $reporteUsuarios = $this->ReporteUsuarios_model->obtenerUsuariosMensual($anio_actual, $anio_anterior);

            // Obtener datos del tercer reporte (Comisiones)
            $reporteComisiones = $this->ReporteComisiones_model->obtenerComisionesMensual($anio_actual, $anio_anterior);

            // Obtener datos del cuarto reporte (PAC)
            $reportePAC = $this->ReportePAC_model->obtenerDatosMensuales($anio_actual, $anio_anterior);

            // Obtener datos del quinto reporte (Llamados)
            $reporteLlamados = $this->ReporteLlamados_model->obtenerLlamadosMensual($anio_actual, $anio_anterior);

            // Obtener datos del último reporte (Evaluaciones)
            $reporteEvaluaciones = $this->ReporteEvaluaciones_model->obtenerEvaluacionesMensual($anio_actual, $anio_anterior);

            // Obtener datos del nuevo reporte (Top 10)
            $reporteTop10 = [
                'solicitados' => $this->ReporteTop10_model->obtenerTop10Solicitados($anio_actual),
                'rendidos' => $this->ReporteTop10_model->obtenerTop10Rendidos($anio_actual),
                'organos' => $this->ReporteTop10_model->obtenerTop10Organos($anio_actual)
            ];

            echo json_encode([
                'success' => true,
                'data' => [
                    'organos' => $reporteOrganos,
                    'usuarios' => $reporteUsuarios,
                    'comisiones' => $reporteComisiones,
                    'pac' => $reportePAC,
                    'llamados' => $reporteLlamados,
                    'evaluaciones' => $reporteEvaluaciones,
                    'top10' => $reporteTop10, // Reporte de Top 10 integrado
                ],
                'anio_actual' => $anio_actual,
                'anio_anterior' => $anio_anterior
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
