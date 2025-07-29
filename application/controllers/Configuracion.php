<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Configuracion extends CI_Controller
{

    public function listar_municipio()
    {
        // if(!$this->session->userdata('session'))
        // redirect('login');

        $data = $this->input->post();
        $data = $this->Configuracion_model->listar_municipio($data);
        echo json_encode($data);
    }

    public function listar_parroquia()
    {
        // if(!$this->session->userdata('session'))
        // redirect('login');
        $data = $this->input->post();

        $data = $this->Configuracion_model->listar_parroquia($data);

        echo json_encode($data);
    }

    // ÓRGANO
    public function organismo()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data['organismos'] = $this->Configuracion_model->consulta_organo();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

        $titulo = 'Organismos';

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/organismo.php', $data);
        //$this->load->view('user/reg_cuentadante.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save_organismo()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $parametros = $this->input->post('tipo_rif');
        $separar        = explode("/", $parametros);
        $data['id_rif']  = $separar['0'];
        $data['desc_rif'] = $separar['1'];
        $organo = $this->input->post("organo");
        $cod_onapre = $this->input->post("cod_onapre");
        $siglas = $this->input->post("siglas");
        $rif = $this->input->post("rif");
        $id_clasificacion = $this->input->post("id_clasificacion");
        $tel_local = $this->input->post("tel_local");
        $tel_local_2 = $this->input->post("tel_local_2");
        $tel_movil = $this->input->post("tel_movil");
        $tel_movil_2 = $this->input->post("tel_movil_2");
        $pag_web = $this->input->post("pag_web");
        $email = $this->input->post("email");


        $this->form_validation->set_rules('organo', 'Nombre ', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('cod_onapre', 'codigo onapre ', 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('siglas', 'siglas ', 'trim|required|min_length[1]|max_length[12]');
        $this->form_validation->set_rules('rif', 'rif ', 'trim|required|min_length[9]|max_length[9]');
        // $this->form_validation->set_rules('id_clasificacion', 'id_clasificacion', 'trim|required|callback_select_validate');
        $this->form_validation->set_rules('tel_local', 'telefono local ', 'trim|required|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('tel_local_2', 'telefono local 2 ', 'trim|required|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('tel_movil', 'telefono movil ', 'trim|required|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('tel_movil_2', 'telefono movil_2 ', 'trim|required|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('pag_web', 'pag_web ', 'trim|required|min_length[3]|max_length[20]');
        // $this->form_validation->set_rules('email', 'Correo eléctronico ', 'trim|required|valid_email|is_unique[organoente.correo]');






        if ($this->form_validation->run() == false) {
            if (!$this->session->userdata('session')) {
                redirect('login');
            }
            $data['organismos'] = $this->Configuracion_model->consulta_organo();
            $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
            $data['estados'] = $this->Configuracion_model->consulta_estados();
            $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

            $titulo = 'Organismos';

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('configuracion/organismo.php', $data);
            //$this->load->view('user/reg_cuentadante.php', $data);
            $this->load->view('templates/footer.php');
        } else {


            $data1 = array( // 
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
                'id_estado' => $this->input->post("id_estado_n"),
                'id_municipio' => $this->input->post("id_municipio_n"),
                'id_parroquia' => $this->input->post("id_parroquia_n"),
                'direccion_fiscal' => $this->input->post("direccion_fiscal"),
                'gaceta_oficial' => $this->input->post("gaceta_oficial"),
                'fecha_gaceta' => $this->input->post("fecha_gaceta"),
                'usuario' => $this->session->userdata('id_user')
            );

            $data = $this->Configuracion_model->save_organismo($data1);
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('configuracion/organismo');
        }
    }

    // ENTES
    public function entes()
    {
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

    public function save_ente()
    {
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

        $data = $this->Configuracion_model->save_ente($data, $data1);
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('configuracion/entes');
    }

    // EMTES ADSCRITOS
    public function entes_adscritos()
    {
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

    public function save_ente_adscrito()
    {
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
            'id_organoenteads'         => $data['id_organoenteads'],
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
    public function list()
    {
        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');


        $data['list'] = $this->Configuracion_model->consultar_lis();
        $data['acto'] = $this->MaximaAutoridad_model->get_actos_admin();
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/list.php', $data);
        $this->load->view('templates/footer.php');
    }

    //////mostrar datos en el modal para editar listados organosentes/////////////////////
    public function read_list()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data =    $this->Configuracion_model->read_list($data);
        echo json_encode($data);
    }
    public function llenar_edo()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data =    $this->Configuracion_model->llenar_edo($data);
        echo json_encode($data);
    }
    public function llenar_munic()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data =    $this->Configuracion_model->llenar_munic($data);
        echo json_encode($data);
    }
    public function llenar_parroq()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data =    $this->Configuracion_model->llenar_parroq($data);
        echo json_encode($data);
    }
    public function save_modif_org1()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data =    $this->Configuracion_model->save_modif_org1($data);
        echo json_encode($data);
    }
    public function orga()
    { //nuevo filiares
        if (!$this->session->userdata('session'))
            redirect('login');
        $data['organismos'] = $this->Configuracion_model->consulta_organo();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

        $titulo = 'Organismos';

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/orga.php', $data);
        //$this->load->view('user/reg_cuentadante.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function validad_corre()
    {
        $email = $this->input->post('email');
        $data = $this->Configuracion_model->valida_corre($email);
        //$data = $this->input->post();
        echo json_encode($data);
    }
    public function save_org_()
    { //ultimo
        if (!$this->session->userdata('session'))
            redirect('login');
        $parametros = $this->input->post('tipo_rif');
        $separar        = explode("/", $parametros);
        $data['id_rif']  = $separar['0'];
        $data['desc_rif'] = $separar['1'];
        $data1 = array( // 
            'id_organoads' => $this->input->post("id_organoads"),
            'descripcion' => $this->input->post("organo"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
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
        //  print_r($data1);die;

        $data = $this->Configuracion_model->save_organismo($data1);
        echo json_encode($data);
    }
    public function ent()
    { //nuevo
        if (!$this->session->userdata('session'))
            redirect('login');
        $data['organismos'] = $this->Configuracion_model->consulta_organo();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

        $titulo = 'Organismos';

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/entes_1.php', $data);
        //$this->load->view('user/reg_cuentadante.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function save_eng_()
    { //ultimo
        if (!$this->session->userdata('session'))
            redirect('login');
        $parametros = $this->input->post('tipo_rif');
        $separar        = explode("/", $parametros);
        $data['id_rif']  = $separar['0'];
        $data['desc_rif'] = $separar['1'];
        $data1 = array( // 
            'id_organoenteads' => $this->input->post("id_organo"),
            'descripcion' => $this->input->post("ente"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
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
        //print_r($data1);die;

        $data = $this->Configuracion_model->save_ente($data1);
        echo json_encode($data);
    }
    // ENTES ADSCRITOS
    public function entes_adscrito()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data['entes'] = $this->Configuracion_model->consulta_organo();
        // $data['entes'] = $this->Configuracion_model->consulta_entes();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/entes_adscrito.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function save_eng_ads()
    { //ultimo
        if (!$this->session->userdata('session'))
            redirect('login');
        $parametros = $this->input->post('tipo_rif');
        $separar        = explode("/", $parametros);
        $data['id_rif']  = $separar['0'];
        $data['desc_rif'] = $separar['1'];
        $data1 = array( // 
            'id_organoenteads' => $this->input->post("id_ente"),
            'descripcion' => $this->input->post("ente"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
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
        //  print_r($data1);die;

        $data = $this->Configuracion_model->save_eng_ads($data1);
        echo json_encode($data);
    }
    public function filiares()
    { //nuevo  filiaresssssss
        if (!$this->session->userdata('session'))
            redirect('login');
        $data['organismos'] = $this->Configuracion_model->consulta_organo();
        $data['tipo_rif'] = $this->Configuracion_model->consulta_tipo_rif();
        $data['estados'] = $this->Configuracion_model->consulta_estados();
        $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

        $titulo = 'Organismos';

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('configuracion/filiares1.php', $data);
        //$this->load->view('user/reg_cuentadante.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function save_filiar_()
    { //ultimo
        if (!$this->session->userdata('session'))
            redirect('login');

        $data1 = array( // 
            'id_organoads' => $this->input->post("id_organoads"),
            'descripcion' => $this->input->post("organo"),
            'cod_onapre' => $this->input->post("cod_onapre"),
            'siglas' => $this->input->post("siglas"),
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
        //  print_r($data1);die;

        $data = $this->Configuracion_model->save_filiar($data1);
        echo json_encode($data);
    }

    public function get_maxima_autoridad_data()
    {
        $this->output->set_content_type('application/json');
        $id_organoente = $this->input->post('id_organoente');

        if ($id_organoente) {
            $data = $this->MaximaAutoridad_model->get_maxima_autoridad_by_organoente_id($id_organoente);
            // Si no se encuentran datos, devolver un 'null' para que el JS sepa que son campos vacíos
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID de Órgano/Ente no proporcionado.']);
        }
    }

    /**
     * Guarda (inserta o actualiza) los datos de la Máxima Autoridad.
     * Responde con JSON.
     */
    public function save_maxima_autoridad_data()
    {
        $this->output->set_content_type('application/json');

        // Recoge los datos del POST
        $data_to_save = [
            'id_organoente' => $this->input->post('id_organoente_max_auth'), // Este ID viene del campo oculto en el modal
            'cedula' => $this->input->post('cedula__max_a_f_modal'),
            'nombre' => $this->input->post('name_max_a_f_modal'),
            'cargo' => $this->input->post('cargo__max_a_f_modal'),
            'id_acto_admin' => $this->input->post('actoad__max_a_f_modal'),
            'n_acto_admin' => $this->input->post('n__max_a_f_modal'),
            'fecha_acto_admin' => $this->input->post('fecha__max_a_f_modal'),
            'gaceta' => $this->input->post('gaceta__max_a_f_modal'),
            'fecha_gaceta' => $this->input->post('gfecha__max_a_f_modal')
        ];

        // Validaciones básicas (puedes expandir esto con la librería form_validation de CI)
        if (empty($data_to_save['id_organoente']) || empty($data_to_save['cedula']) || empty($data_to_save['nombre']) || empty($data_to_save['cargo']) || $data_to_save['id_acto_admin'] == '0' || empty($data_to_save['n_acto_admin']) || empty($data_to_save['fecha_acto_admin']) || empty($data_to_save['gaceta']) || empty($data_to_save['fecha_gaceta'])) {
            echo json_encode(['status' => 'error', 'message' => 'Todos los campos de la Máxima Autoridad son obligatorios.']);
            return;
        }

        if ($this->MaximaAutoridad_model->save_maxima_autoridad($data_to_save)) {
            echo json_encode(['status' => 'success', 'message' => 'Datos de la Máxima Autoridad guardados exitosamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar los datos de la Máxima Autoridad.']);
        }
    }

    // Si tu vista "Listado" necesita los "actos administrativos" (para el select), asegúrate de pasarlos al cargar la vista
    // public function listado()
    // {
    //     $data['list'] = $this->MaximaAutoridad_model->get_organos_entes(); // Asumo que tienes una función para esto
    //     $data['acto'] = $this->MaximaAutoridad_model->get_actos_admin(); // Carga los actos para el modal
    //     $this->load->view('tu_vista_listado', $data); // Asegúrate de que esta sea tu vista principal del listado
    // }
}
