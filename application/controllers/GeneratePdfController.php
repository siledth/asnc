<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeneratePdfController extends CI_Controller {

    public function index(){
        $comprobante = $this->input->get('id');
        $data['inf_pdf'] =	$this->Certificacion_model->consulta_llamados($comprobante);

        $this->load->library('pdf');

        // $html = $this->load->view('publicaciones/reporte/GenerarPdfView.php', [], true);
        $html = $this->load->view('publicaciones/reporte/GenerarPdfView.php', $data, TRUE);
        //$this->pdf->createPDF($html, 'mypdf', false);
// definamos un nombre para el archivo. No es necesario agregar la extension .pdf
        $filename = 'llamado a Concurso';
        // generamos el PDF. Pasemos por encima de la configuración general y definamos otro tipo de papel
        $this->pdf->generate($html, $filename, true, 'Letter', 'portrait');


        // $this->load->view('publicaciones/reporte/GenerarPdfView.php');
        
        // // Get output html
        // $html = $this->output->get_output();
        
        // // Load pdf library
        // $this->load->library('pdf');
        
        // // Load HTML content
        // $this->dompdf->loadHtml($html);
        
        // // (Optional) Setup the paper size and orientation
        // $this->dompdf->setPaper('A4', 'landscape');
        
        // // Render the HTML as PDF
        // $this->dompdf->render();
        
        // // Output the generated PDF (1 = download and 0 = preview)
        // $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    
}
}
?>