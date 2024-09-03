<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $date=date("Y-m-d");
        $date1=date("Y-m-d");
        $generar = $this->Publicaciones_model->generar($date); // finalizar llamad
       // $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
       $generar_vencimiento_comision = $this->Comision_contrata_model->generar_vencimiento_comision($date1); // finalizar llamad

       
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('home/index.php');
        $this->load->view('templates/footer.php');
    }
    public function update_session() {
        if ($this->session->userdata('last_activity') + $this->config->item('sess_time_to_update') < time()) {
            // Update session data
            $this->session->set_userdata('last_activity', time());
        }
    }

}
