<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comision_contrata extends CI_Controller
{
    public function logger_type_c()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $rif_organoente = $this->session->userdata('rif_organoente');

        $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
        $data['unidad'] 		 = $this->session->userdata('unidad');

        $data['comisiones'] = $this->Comision_contrata_model->check_logger_commission($rif_organoente);
        $usuario = $this->session->userdata('id_user');
        $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
        $data['area'] = $this->Comision_contrata_model->check_areas();
        $data['tipo'] = $this->Comision_contrata_model->check_tipo();

    //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
        
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('comision_contrata/reg_tip_contrata.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function employees()
    {
        $data['employees'] = $this->Comision_contrata_model->get_employees();
        $this->load->view('employees', $data);
    }
    public function logger_commission() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'rif_organoente' => $this->input->POST('rif_organoente'),
            'unidad' => $this->input->POST('unidad'),

            'tipo_comi' => $this->input->POST('tipo_com'),

            'observacion' => $this->input->POST('observacion'),
            'id_usuario' => $this->session->userdata('id_user'),
            'fecha_creacion' => date("Y-m-d"), 
            'snc' => 1, 
            'id_status' => 1,  
            'fecha_cambi_statu' => date("Y-m-d")

        );
        //print_r($data);die;
        $data = $this->Comision_contrata_model->logger_commission($data);
        echo json_encode($data);
    }

    public function check_comision(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Comision_contrata_model->check_comision($data);
        echo json_encode($data);
    }
    public function save() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'rif_organoente' => $this->session->userdata('rif_organoente'),
        'id_comision' => $this->input->POST('llenar_trimestre5'),

             
  
          
        );
        
        print_r($data);die;
    
            $data = $this->Comision_contrata_model->save_miembros($data);

        echo json_encode($data);
    }
  

    public function save1(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Comision_contrata_model->save_miembros($data);
        echo json_encode($data);
    }
    public function check_miembros(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Comision_contrata_model->check_miembros($data);
        echo json_encode($data);
    }
    public function check_miembros1(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Comision_contrata_model->check_miembros1($data);
        echo json_encode($data);
    }

    public function miemb(){
        if(!$this->session->userdata('session'))redirect('login');
        //Información traido por el session de usuario para mostrar inf
       
        $data['id_comision'] = $this->input->get('id');
   
        $data['ver'] = $this->Comision_contrata_model->check_miemb($data['id_comision']);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('comision_contrata/see_mb.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function enviar_cm()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data = $this->input->post();
        
        $des_unidad = $this->session->userdata('unidad');
        $codigo_onapre = $this->session->userdata('codigo_onapre');
        $rif = $this->session->userdata('rif_organoente');
        $id_comision = $data['id'];
        
        
        // $data2 = $this->Programacion_model->consulta_total_objeto_acc($id_programacion);
        
        // $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
       
        // $data4 = $this->Programacion_model->consulta_total_objeto_py2($id_programacion);
        //print_r($data4);die;
        
        // $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion); 
        
        // $data = $this->Programacion_model->enviar_snc($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5);
        $data = $this->Comision_contrata_model->enviar_snc($data, $des_unidad, $codigo_onapre, $rif);

        print_r($data);die;
        //echo json_encode($data);
    }
}