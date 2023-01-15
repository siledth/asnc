<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {

    public function listar_municipio() {
        // if(!$this->session->userdata('session'))
        // redirect('login');

        $data = $this->input->post();
        $data = $this->Configuracion_model->listar_municipio($data);
        echo json_encode($data);
    }

    public function listar_parroquia() {
        // if(!$this->session->userdata('session'))
        // redirect('login');
        $data = $this->input->post();

        $data = $this->Configuracion_model->listar_parroquia($data);

        echo json_encode($data);
    }

    // ÓRGANO
    public function organismo() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data['organismos'] = $this->Configuracion_model->consulta_organismo();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();
        
        $titulo='Organismos';

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/organismo.php', $data);
        //$this->load->view('user/reg_cuentadante.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save_organismo() {
        if (!$this->session->userdata('session'))
            redirect('login');
            $parametros = $this->input->post('tipo_rif');
            $separar        = explode("/", $parametros);
            $data['id_rif']  = $separar['0'];
            $data['desc_rif'] = $separar['1'];
            
        $data1 = array( // esto va a organo
            'id_organoads' => $this->input->post("id_organoads"),
            'descripcion' => $this->input->post("organo"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
            'tipo_rif2' => $data['id_rif'],
            'tipor' => $data['desc_rif'],
            'rif' => $this->input->post("rif"),
            'id_clasificacion' => $this->input->post("id_clasificacion"),
            'tel_local' => $this->input->post("tel_local"),
            'tel_local_2' => $this->input->post("tel_local_2"),
            'tel_movil' => $this->input->post("tel_movil"),
            'tel_movil_2' => $this->input->post("tel_movil_2"),
            'pag_web' => $this->input->post("pag_web"),
            'email' => $this->input->post("email"),
            'id_estado' => $this->input->post("id_estado"),
            'id_municipio' => $this->input->post("id_municipio"),
            'id_parroquia' => $this->input->post("id_parroquia"),
            'direccion_fiscal' => $this->input->post("direccion_fiscal"),
            'gaceta_oficial' => $this->input->post("gaceta_oficial"),
            'fecha_gaceta' => $this->input->post("fecha_gaceta"),
            'usuario' => $this->session->userdata('id_user')
        );
        $data = array( //organoente tabla
            'organo' => $this->input->post("organo"),
            'id_organoads' => $this->input->post("id_organoads"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
            'tipo_rif2' => $data['id_rif'],
            'tipor' => $data['desc_rif'],
            'rif' => $this->input->post("rif"),
            'id_clasificacion' => $this->input->post("id_clasificacion"),
            'tel_local' => $this->input->post("tel_local"),
            'tel_local_2' => $this->input->post("tel_local_2"),
            'tel_movil' => $this->input->post("tel_movil"),
            'tel_movil_2' => $this->input->post("tel_movil_2"),
            'pag_web' => $this->input->post("pag_web"),
            'email' => $this->input->post("email"),
            'id_estado' => $this->input->post("id_estado_n"),
            'id_municipio' => $this->input->post("id_municipio_n"),
            'id_parroquia' => $this->input->post("id_parroquia_n"),
            'direccion_fiscal' => $this->input->post("direccion_fiscal"),
            'gaceta_oficial' => $this->input->post("gaceta_oficial"),
            'fecha_gaceta' => $this->input->post("fecha_gaceta"),
            'usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Configuracion_model->save_organismo($data1,$data);
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('configuracion/organismo');
    }

    // ENTES
    public function entes() {
        if (!$this->session->userdata('session'))
            redirect('login');

        $data['organismos'] = $this->Configuracion_model->consulta_organo();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/entes.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save_ente() {
        if (!$this->session->userdata('session'))
            redirect('login');
            $parametros = $this->input->post('tipo_rif');
            $separar        = explode("/", $parametros);
            $data['id_rif']  = $separar['0'];
            $data['desc_rif'] = $separar['1'];
            

        $data = array(
            'ente' => $this->input->post("ente"),
            'id_organo' => $this->input->post("id_organo"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
            'tipo_rif2' => $data['id_rif'],
            'tipor' => $data['desc_rif'],
            'rif' => $this->input->post("rif"),
            'id_clasificacion' => $this->input->post("id_clasificacion"),
            'tel_local' => $this->input->post("tel_local"),
            'tel_local_2' => $this->input->post("tel_local_2"),
            'tel_movil' => $this->input->post("tel_movil"),
            'tel_movil_2' => $this->input->post("tel_movil_2"),
            'pag_web' => $this->input->post("pag_web"),
            'email' => $this->input->post("email"),
            'id_estado' => $this->input->post("id_estado_n"),
            'id_municipio' => $this->input->post("id_municipio_n"),
            'id_parroquia' => $this->input->post("id_parroquia_n"),
            'direccion_fiscal' => $this->input->post("direccion_fiscal"),
            'gaceta_oficial' => $this->input->post("gaceta_oficial"),
            'fecha_gaceta' => $this->input->post("fecha_gaceta"),
            'usuario' => $this->session->userdata('id_user')
        );
        $data1 = array(
            'id_organoads' => $this->input->post("id_organoads"),
            'desc_entes' => $this->input->post("ente"),
            
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
            'tipo_rif2' => $data['id_rif'],
            
            'rif' => $this->input->post("rif"),
            'id_clasificacion' => $this->input->post("id_clasificacion"),
            'tel_local' => $this->input->post("tel_local"),
            'tel_local_2' => $this->input->post("tel_local_2"),
            'tel_movil' => $this->input->post("tel_movil"),
            'tel_movil_2' => $this->input->post("tel_movil_2"),
            'pag_web' => $this->input->post("pag_web"),
            'email' => $this->input->post("email"),
            'id_estado' => $this->input->post("id_estado_n"),
            'id_municipio' => $this->input->post("id_municipio_n"),
            'id_parroquia' => $this->input->post("id_parroquia_n"),
            'direccion_fiscal' => $this->input->post("direccion_fiscal"),
            'gaceta_oficial' => $this->input->post("gaceta_oficial"),
            'fecha_gaceta' => $this->input->post("fecha_gaceta"),
            'usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Configuracion_model->save_ente($data,$data1);
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('configuracion/entes');
    }

    // EMTES ADSCRITOS
    public function entes_adscritos() {
        if (!$this->session->userdata('session'))
            redirect('login');
            $data['entes'] = $this->Configuracion_model->consulta_organo();
       // $data['entes'] = $this->Configuracion_model->consulta_entes();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/entes_adscritos.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save_ente_adscrito() {
        if (!$this->session->userdata('session'))
            redirect('login');
            $parametros = $this->input->post('tipo_rif');
            $separar        = explode("/", $parametros);
            $data['id_rif']  = $separar['0'];
            $data['desc_rif'] = $separar['1'];
            //$data['id_organoenteads'] = $separar['2'];
           
            $parametros1 = $this->input->post('id_ente');
            $separar1        = explode("/", $parametros1);
            $data['id_organoente']  = $separar1['0'];
            $data['id_organoenteads'] = $separar1['1'];
         
            $data = array(
                'ente' => $this->input->post("ente"),
                'id_organoente' => $data['id_organoente'],
                'cod_onapre' => $this->input->post("cod_onapre"),
                'siglas' => $this->input->post("siglas"),
                'id_organoenteads' 		=> $data['id_organoenteads'],
                'tipo_rif2' => $data['id_rif'],
                'tipor' => $data['desc_rif'],
                'rif' => $this->input->post("rif"),
                'id_clasificacion' => $this->input->post("id_clasificacion"),
                'tel_local' => $this->input->post("tel_local"),
                'tel_local_2' => $this->input->post("tel_local_2"),
                'tel_movil' => $this->input->post("tel_movil"),
                'tel_movil_2' => $this->input->post("tel_movil_2"),
                'pag_web' => $this->input->post("pag_web"),
                'email' => $this->input->post("email"),
                'id_estado' => $this->input->post("id_estado_n"),
                'id_municipio' => $this->input->post("id_municipio_n"),
                'id_parroquia' => $this->input->post("id_parroquia_n"),
                'direccion_fiscal' => $this->input->post("direccion_fiscal"),
                'gaceta_oficial' => $this->input->post("gaceta_oficial"),
                'fecha_gaceta' => $this->input->post("fecha_gaceta"),
                'usuario' => $this->session->userdata('id_user')
            );
        $data1 = array(
            'ente' => $this->input->post("ente"),
            'id_organoente' => $data['id_organoente'],
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
            'tipo_rif2' => $data['id_rif'],
            'rif' => $this->input->post("rif"),
            'id_clasificacion' => $this->input->post("id_clasificacion"),
            'tel_local' => $this->input->post("tel_local"),
            'tel_local_2' => $this->input->post("tel_local_2"),
            'tel_movil' => $this->input->post("tel_movil"),
            'tel_movil_2' => $this->input->post("tel_movil_2"),
            'pag_web' => $this->input->post("pag_web"),
            'email' => $this->input->post("email"),
            'id_estado' => $this->input->post("id_estado"),
            'id_municipio' => $this->input->post("id_municipio"),
            'id_parroquia' => $this->input->post("id_parroquia"),
            'direccion_fiscal' => $this->input->post("direccion_fiscal"),
            'gaceta_oficial' => $this->input->post("gaceta_oficial"),
            'fecha_gaceta' => $this->input->post("fecha_gaceta"),
            'usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Configuracion_model->save_ente_adscrito($data, $data1);
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('configuracion/entes_adscritos');
    }

}
