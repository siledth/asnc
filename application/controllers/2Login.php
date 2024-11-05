<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
    }

    public function index() {
        $this->load->view('login_view');
    }

    public function autenticar() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $usuario = $this->Usuario_model->verificar_usuario($username, $password);

        if ($usuario) {
            // Si el usuario es válido, puedes iniciar sesión
            // $this->session->set_userdata('id', $usuario->id);
            $this->session->set_userdata('perfil_id', $id_perfil);
             var_dump($id_perfil);

            
        // $permisos = $this->Usuario_model->obtener_permisos($perfil_id);
        // $this->session->set_userdata('usuario_id', $usuario_id);
        // $this->session->set_userdata('perfil_id', $perfil_id);
        // $this->session->set_userdata('permisos', $permisos);
           $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('home/index.php');
        $this->load->view('templates/footer.php');
        } else {
            $data['error'] = 'Usuario o contraseña incorrectos';
            $this->load->view('login_view', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}