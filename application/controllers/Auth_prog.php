<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_prog extends CI_Controller
{ 
    public function requests_prog()
    {
        if (!$this->session->userdata('session'))
        redirect('login');
		$codigo = $this->session->userdata('rif');
    
        $data['time']=date("d-m-Y");
        $data['programacion'] 	= $this->Auth_prog_model->red_prog($codigo);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/auth_pro/requests_prog.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function resgistrar_solicitud(){
		if(!$this->session->userdata('session'))redirect('login');
		$id = $this->input->POST('id');
		$d_solicitud = array(
			'id_programacion'   => $this->input->POST('id'),            
            'cedula_solc'     => $this->input->POST('cd'),
			'nom_ape_solc'    => $this->input->POST('nom_ape_solc'),
			'cargo'        	  => $this->input->POST('cargo'),
			'telf_solc'       => $this->input->POST('telf_solc'),
			'motivo'	  => $this->input->POST('motivo'),
			'id_usuario' 	  => $this->session->userdata('id_user'),
        );

		$data = $this->Auth_prog_model->save_solicitud($id, $d_solicitud);
        echo json_encode($data);
	}
    public function see_prog()
    {
        if (!$this->session->userdata('session'))
        redirect('login');
    
        $data['time']=date("d-m-Y");
        $data['programacion'] 	= $this->Auth_prog_model->red_prog_a();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/auth_pro/auth_prog.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function resgistrar_solicitud_edit(){
		if(!$this->session->userdata('session'))redirect('login');
		// $id_evaluacion = $this->input->POST('id_evaluacion');
		$data = $this->input->post();
		$data = $this->Auth_prog_model->resgistrar_solicitud_edit1($data);
        echo json_encode($data);
	}
    public function read_solic(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Auth_prog_model->read_solic($data);
		echo json_encode($data);
	}
    public function guardar_solici(){ //se guardA EL NUEVO ESTATUS DEL CERTIFICADO
        if(!$this->session->userdata('session'))redirect('login');
        $data['time']=date("d-m-Y");
        $data['users']= $this->session->userdata('id_user');
        $data = $this->input->post();
        $data =	$this->Auth_prog_model->guardar_solici($data);
        echo json_encode($data);
    }
  
   
}
