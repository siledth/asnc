<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
        if (!$this->session->userdata('id')) {
            redirect('login'); // Redirige al login si no está autenticado
        }
		$this->load->view('home/index.php');
        //$this->load->view('home');
    }
}
