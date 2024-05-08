<?php
class Pdfgen extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function helloworld() {
        $this->load->library('mypdf');
        $this->mypdf->AddPage();
        $this->mypdf->SetFont('Arial','B',16);
        $this->mypdf->Cell(40,10,'Hello World!');
        $this->mypdf->Output();
    }
}