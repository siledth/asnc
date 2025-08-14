<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Preguntas_model'); // Cargar el modelo de preguntas
    }
    public function index()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $user_id = $this->session->userdata('id_user');
        if (!$this->Preguntas_model->tiene_preguntas($user_id)) {
            // Si no tiene preguntas, redirigir a la vista de creación de preguntas
            redirect(site_url('Preguntas_controller/preguntas1'));
            //$this->load->view('user/crear_preguntas_view.php');

        }
        $data['username'] = $this->session->userdata('username');
        $data['perfil_id'] = $this->session->userdata('perfil_id');
        $data['menu_rnce'] = $this->session->userdata('menu_rnce');
        $data['menu_progr'] = $this->session->userdata('menu_progr');
        $data['perfil_nombre'] = $this->session->userdata('perfil_nombre');
        $date = date("Y-m-d");
        $date1 = date("Y-m-d");
        $generar = $this->Publicaciones_model->generar($date); // finalizar llamad
        // $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
        $generar_vencimiento_comision = $this->Comision_contrata_model->generar_vencimiento_comision($date1); // finalizar llamad

        // Lógica para el modal: solo para perfiles 1 y 9
        if ($data['perfil_id'] == 1 || $data['perfil_id'] == 9) {
            $data['pending_payments'] = $this->Diplomado_model->get_pending_payments_all(); // Usa el nuevo método
        } else {
            $data['pending_payments'] = [];
        }
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('home/index.php');
        $this->load->view('templates/footer.php');
    }
    public function update_session()
    {
        if ($this->session->userdata('last_activity') + $this->config->item('sess_time_to_update') < time()) {
            // Update session data
            $this->session->set_userdata('last_activity', time());
        }
    }
}
