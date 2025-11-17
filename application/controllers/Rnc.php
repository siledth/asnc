<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rnc extends CI_Controller
{
    //     public function see_pay(){
    //     if(!$this->session->userdata('session'))redirect('login');



    //     $data['read'] = $this->Rnc_model->read_sending_pay();
    //     $data['fecha'] = date('yy');

    //     $this->load->view('templates/header.php');
    //     $this->load->view('templates/navigator.php');
    //     $this->load->view('RNC/consulta_pay.php', $data);
    //     $this->load->view('templates/footer.php');
    // }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reportes_model');
    }
    public function auditoria_rnc()
    {
        if (!$this->session->userdata('session')) redirect('login');



        $data['read'] = $this->Rnc_model->read_sending_audit();
        $data['fecha'] = date('yy');

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('RNC/auditoria_rnc.php', $data);
        $this->load->view('templates/footer.php');
    }


    public function see_pay()
    {
        // Función para mostrar la vista del formulario de reporte de pagos
        if (!$this->session->userdata('session')) redirect('login');

        // Carga tu vista de pagos
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('RNC/consulta_pay.php'); // <-- Nombre de la nueva vista
        $this->load->view('templates/footer.php');
    }

    public function generar_reporte_pagos() // <-- Nueva función para la solicitud AJAX
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $filtros = $this->input->post();

        $data_reporte = $this->Rnc_model->get_reporte_pagos($filtros);

        echo json_encode(['status' => 'success', 'data' => $data_reporte]);
    }

    // Función de Exportación a CSV
    //     public function exportar_pagos_csv()
    //     {
    //         if (!$this->session->userdata('session')) show_error('Acceso denegado', 403);

    //         $filtros = $this->input->get();
    //         $data_reporte = $this->Rnc_model->get_reporte_pagos($filtros);

    //         if (empty($data_reporte)) {
    //             echo "No hay datos para exportar.";
    //             return;
    //         }

    //         $filename = 'reporte_pagos_' . date('Ymd_His') . '.csv';

    //         header('Content-Type: text/csv; charset=utf-8');
    //         header('Content-Disposition: attachment; filename="' . $filename . '"');

    //         $output = fopen('php://output', 'w');

    //         // Nombres de las columnas (Header)
    //         fputcsv($output, [
    //             'ID Proceso',
    //             'Fecha Pago',
    //             'RIF Contratista',
    //             'Nombre Contratista',
    //             'Monto',
    //             'Tipo Transaccion',
    //             'Metodo Pago',
    //             'Referencia'
    //         ]);

    //         // Contenido de las filas
    //         foreach ($data_reporte as $row) {
    //             fputcsv($output, [
    //                 $row['id'],
    //                 $row['paymentdate'],
    //                 $row['rif_contratista'],
    //                 $row['nombre_contratista'],
    //                 $row['amount'],
    //                 $row['tipo_transaccion'],
    //                 $row['metodo_pago'],
    //                 $row['transactionid']
    //             ]);
    //         }

    //         fclose($output);
    //         exit;
    //     }
    public function exportar_pagos_csv()
    {
        if (!$this->session->userdata('session')) show_error('Acceso denegado', 403);

        $filtros = $this->input->get();
        // Llamada al modelo con los nuevos filtros
        $data_reporte = $this->Rnc_model->get_reporte_pagos($filtros);

        if (empty($data_reporte)) {
            echo "No hay datos para exportar.";
            return;
        }

        $filename = 'reporte_pagos_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Nombres de las columnas (Header) - ORDEN FINAL (10 columnas)
        fputcsv($output, [
            'Fecha Pago',
            'ID Proceso',
            'RIF Contratista',
            'Nombre Contratista',
            'Tipo Inscripción',
            'Tipo Transacción',
            'Referencia',
            'Monto',
            'Método Pago',
            'Clasificación Tarifa'
        ]);

        // Contenido de las filas - ORDEN FINAL (10 columnas)
        foreach ($data_reporte as $row) {
            fputcsv($output, [
                $row['paymentdate'],
                $row['id'], // proceso_id
                $row['rif_contratista'],
                $row['nombre_contratista'],
                $row['tipo_inscripcion'],
                $row['tipo_transaccion'],
                $row['transactionid'],
                $row['amount'],
                $row['metodo_pago'],
                $row['clasificacion_tarifa']
            ]);
        }

        fclose($output);
        exit;
    }

    public function general()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $data['username'] = $this->session->userdata('username');
        $data['perfil_id'] = $this->session->userdata('perfil');
        // $this->session->userdata('perfil') == 1
        $data['menu_rnce'] = $this->session->userdata('menu_rnce');
        $data['menu_progr'] = $this->session->userdata('menu_progr');
        $data['perfil_nombre'] = $this->session->userdata('perfil_nombre');
        $date = date("Y-m-d");
        $date1 = date("Y-m-d");


        //  Totales KPI de Ingresos (Solo si el perfil lo requiere)
        if ($data['perfil_id'] == 1 || $data['perfil_id'] == 3) {
            $data['kpi_ingresos'] = $this->Reportes_model->get_totales_kpi_home();
        } else {
            $data['kpi_ingresos'] = null;
        }

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('RNC/genral.php', $data);
        $this->load->view('templates/footer.php');
    }
}
