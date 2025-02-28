<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['username'] = $this->session->userdata('username');
        $data['perfil_id'] = $this->session->userdata('perfil_id');
        $data['menu_rnce'] = $this->session->userdata('menu_rnce');

        $data['perfil_nombre'] = $this->session->userdata('perfil_nombre');
         $date=date("Y-m-d");
        $date1=date("Y-m-d");
        $generar = $this->Publicaciones_model->generar($date); // finalizar llamad
       // $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
       $generar_vencimiento_comision = $this->Comision_contrata_model->generar_vencimiento_comision($date1); // finalizar llamad

        $this->load->view('templates/header');
        $this->load->view('templates/navigator', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}