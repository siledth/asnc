<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tablas_com extends CI_Controller
{
	public function registrar_cm()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
       // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['academico'] = $this->Tablas_comi_model->consultaracademi();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('tablas/comiacademico.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
           // 'codigopartida_presupuestaria' => $this->input->POST('codigo_b'),
            'desc_academico' => $this->input->POST('nombre_b'),
            'id_usuario' => $this->session->userdata('id_user'),
            'fecha' => date("Y-m-d"), 
        );
        $data = $this->Tablas_comi_model->registrar_b($data);
        echo json_encode($data);
    }

    public function consulta_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Tablas_comi_model->consulta_b($data);
        echo json_encode($data);
    }
    public function editar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_academico' => $data['id_banco'],
           // 'codigopartida_presupuestaria' => $data['codigo_b'],
            'desc_academico' => $data['nombre_b'],
            'id_usuario' => $this->session->userdata('id_user'),
			'fecha' => date("Y-m-d"), 
        );

        $data = $this->Tablas_comi_model->editar_b($data);
        echo json_encode($data);
    }


    public function actoadmin()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
       // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['acto'] = $this->Tablas_comi_model->consultaactoadmin();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('tablas/acto_admin.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_actoadmin() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
           // 'codigopartida_presupuestaria' => $this->input->POST('codigo_b'),
            'desc_acto_admin' => $this->input->POST('nombre_b'),
            'id_usuario' => $this->session->userdata('id_user'),
            'fecha' => date("Y-m-d"), 
        );
        $data = $this->Tablas_comi_model->registrar_actoadmin($data);
        echo json_encode($data);
    }

    public function consulta_actoadmin() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Tablas_comi_model->consulta_actoadmin($data);
        echo json_encode($data);
    }
    public function editar_actoadmin() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_acto_admin' => $data['id_banco'],
           // 'codigopartida_presupuestaria' => $data['codigo_b'],
            'desc_acto_admin' => $data['nombre_b'],
            'id_usuario' => $this->session->userdata('id_user'),
			'fecha' => date("Y-m-d"), 
        );

        $data = $this->Tablas_comi_model->editar_actoadmin($data);
        echo json_encode($data);
    }
/////////////////
    public function area_mb()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
       // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['area'] = $this->Tablas_comi_model->consultaarea_mb();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('tablas/area_miembro.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_area_mb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
           // 'codigopartida_presupuestaria' => $this->input->POST('codigo_b'),
            'desc_area_miembro' => $this->input->POST('nombre_b'),
            'id_usuario' => $this->session->userdata('id_user'),
            'fecha' => date("Y-m-d"), 
        );
        $data = $this->Tablas_comi_model->registrar_area_mb($data);
        echo json_encode($data);
    }

    public function consulta_area_mb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Tablas_comi_model->consulta_area_mb($data);
        echo json_encode($data);
    }
    public function editar_area_mb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_area_miembro' => $data['id_banco'],
           // 'codigopartida_presupuestaria' => $data['codigo_b'],
            'desc_area_miembro' => $data['nombre_b'],
            'id_usuario' => $this->session->userdata('id_user'),
			'fecha' => date("Y-m-d"), 
        );

        $data = $this->Tablas_comi_model->editar_area_mb($data);
        echo json_encode($data);
    }
    //////////////////////////////////////////////
    public function estatus_mb()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
       // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['estatus_mb'] = $this->Tablas_comi_model->consultaestatus_mbb();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('tablas/estatus_mb.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_estatus_mb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
           // 'codigopartida_presupuestaria' => $this->input->POST('codigo_b'),
            'desc_status_miembro' => $this->input->POST('nombre_b'),
             
        );
        $data = $this->Tablas_comi_model->registrar_estatus_mb($data);
        echo json_encode($data);
    }

    public function consulta_estatus_mb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Tablas_comi_model->consulta_estatus_mb($data);
        echo json_encode($data);
    }
    public function editar_estatus_mb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_status_miembro' => $data['id_banco'],
           // 'codigopartida_presupuestaria' => $data['codigo_b'],
            'desc_status_miembro' => $data['nombre_b'],
           
        );

        $data = $this->Tablas_comi_model->editar_estatus_mb($data);
        echo json_encode($data);
    }

 }