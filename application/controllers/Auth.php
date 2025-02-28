<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->library('session');
        $this->load->helper('url');
    }
    
    public function index() {
        // Check if user is already logged in
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        
        $this->load->view('login_view');
    }
    
    public function autenticar() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $usuario = $this->Usuario_model->iniciar($username, $password);
        
        if (is_array($usuario)) {
            // Set session data
            $session_data = array(
                'user_id' => $usuario['id'],
                'username' => $usuario['nombre'],
                'email' => $usuario['email'],
                'perfil_id' => $usuario['perfil'],
                'perfil_nombre' => $usuario['nombre_perfil'],
                'menu_rnce' => $usuario['menu_rnce'],
                'logged_in' => TRUE
            );
            
            $this->session->set_userdata($session_data);
            
            // Redirect based on user profile
            redirect('dashboard');
        } else if ($usuario === 'FALLIDO') {
            $data['error'] = 'Usuario o contraseña incorrectos';
            $this->load->view('login_view', $data);
        } else if ($usuario === 'BLOQUEADO') {
            $data['error'] = 'Usuario bloqueado. Contacte al administrador';
            $this->load->view('login_view', $data);
        } else {
            $data['error'] = 'Usuario no encontrado';
            $this->load->view('login_view', $data);
        }
    }
    
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('auth');
    }
}