<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

// Asegúrate de que FPDF y tu clase generadora estén disponibles
// require_once APPPATH . 'third_party/fpdf/fpdf.php';
// require_once APPPATH . 'libraries/Pdf_Certificacion.php'; // Si la clase está en libraries
// O si la clase FPDF está en Pdfcertificacion.php
// require_once APPPATH . 'controllers/Pdfcertificacion.php'; // Carga el archivo donde está tu clase FPDF personalizada

class Verificador extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Certificacion_model'); // Necesitamos el modelo para obtener los datos
        $this->load->helper('url'); // Para base_url() si se usa en el modelo o aquí

        // Si tu clase FPDF (Certificacion_Pdf_Generator) está en Pdfcertificacion.php
        // y NO es autoloaded, necesitas incluir el archivo aquí.
        require_once APPPATH . 'controllers/Pdfcertificacion.php';
    }

    // Método para manejar la verificación de certificados por QR
    public function certificado()
    {
        $cert_id = $this->input->get('id'); // Obtener el ID de la URL del QR

        // --- Validación del ID ---
        if (empty($cert_id) || !is_numeric($cert_id)) {
            // Redirigir a una página de error o mostrar mensaje
            show_404(); // O redirige a una página de error más amigable
            return;
        }

        // --- Recopilar los datos para el PDF (igual que en Certificacion/verpdf) ---
        $certificacion_info = $this->Certificacion_model->get_certificacion_info($cert_id);

        if (!$certificacion_info) {
            show_404(); // No se encontró la certificación
            return;
        }

        $experiencia_empresa = $this->Certificacion_model->get_experiencia_empresa($cert_id);
        $facilitadores_basic_list = $this->Certificacion_model->get_facilitadores_by_cert_id($cert_id);

        $facilitadores_detalles = [];
        foreach ($facilitadores_basic_list as $facilitador) {
            $facilitador_cedula = $facilitador['cedula'];
            $facilitador_detail = $facilitador;

            $facilitador_detail['formacion_academica'] = $this->Certificacion_model->check_miemb_inf_ac($facilitador_cedula);
            $facilitador_detail['formacion_cp'] = $this->Certificacion_model->check_miemb_inf_contr_pub($facilitador_cedula);
            $facilitador_detail['experiencia_comisiones'] = $this->Certificacion_model->check_miemb_inf_exp_comis($facilitador_cedula);
            $facilitador_detail['dictado_capacitacion'] = $this->Certificacion_model->check_miemb_inf_cap_dictado($facilitador_cedula);
            $facilitadores_detalles[] = $facilitador_detail;
        }

        $all_report_data = [
            'certificacion_info' => $certificacion_info,
            'experiencia_empresa' => $experiencia_empresa,
            'facilitadores_detalles' => $facilitadores_detalles,
            'time' => date("d-m-Y"),
            'rif_session' => $this->session->userdata('rif') // Considera si necesitas esto en un verificador público
        ];

        // --- Generar y Forzar Descarga del PDF ---
        // Asegúrate de que 'Pdf' (Certificacion_Pdf_Generator) está disponible.
        // Si tu clase FPDF personalizada se llama 'Pdf' y está en Pdfcertificacion.php
        $pdf = new Pdf($all_report_data); // <<< Instanciar tu clase FPDF aquí
        $pdf->AliasNbPages();
        $pdf->GenerateReport();
        $pdf->Output('Certificado_Verificado_' . ($certificacion_info['rif_cont'] ?? 'documento') . '.pdf', 'D'); // 'D' para descargar
    }
}
