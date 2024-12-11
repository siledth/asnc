<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rnc extends CI_Controller {
    public function see_pay(){
    if(!$this->session->userdata('session'))redirect('login');

   

    $data['read'] = $this->Rnc_model->read_sending_pay();
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('RNC/consulta_pay.php', $data);
    $this->load->view('templates/footer.php');
}
}