<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificacion extends CI_Controller
{
    public function registrar()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['estados'] 	 = $this->Configuracion_model->consulta_estados();
        $data['pais'] 		 = $this->Configuracion_model->consulta_paises();
        $data['edo_civil'] 	 = $this->Configuracion_model->consulta_edo_civil();
        $data['operadora'] 	 = $this->Evaluacion_desempenio_model->consulta_operadora();
        $data['modalidades'] = $this->Evaluacion_desempenio_model->consulta_modalidades();
        $data['inf_1'] = $this->Certificacion_model-> inf_1();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/registro_certificacion.php', $data);
        $this->load->view('templates/footer.php');
    }

    //Consulta si existe el contrastita
	public function llenar_contratista(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_contratista($data);
		echo json_encode($data);
	}

	public function llenar_contratista_rp(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_contratista_rp($data);
		echo json_encode($data);
	}
}