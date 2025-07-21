<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Certificacion extends CI_Controller
{
    public function validad_exo()
    {
        $numcertrnc2 = $this->input->post('numcertrnc2');
        $data = $this->Certificacion_model->valida_exon($numcertrnc2);
        //$data = $this->input->post();
        echo json_encode($data);
    }
    public function registrar()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['estados']      = $this->Configuracion_model->consulta_estados();
        $data['pais']          = $this->Configuracion_model->consulta_paises();
        $data['edo_civil']      = $this->Configuracion_model->consulta_edo_civil();
        $data['rif_organoente'] = $this->session->userdata('rif_organoente');

        $usuario = $this->session->userdata('id_user');
        $data['inf_1'] = $this->Certificacion_model->inf_1();
        $data['inf_2'] = $this->Certificacion_model->inf_2();
        $data['inf_3'] = $this->Certificacion_model->inf_3();
        $data['time'] = date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado($data);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/registro_certificacion.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function Consulta_certificacion()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi();
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/consultas/consult_snc.php', $data);
        $this->load->view('templates/footer.php');
        //where ed.id_usuario = '$usuario'");
    }
    public function Listado_certificacion()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi_pendiente();
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['time'] = date("Y-m-d");
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/listar_certificado.php', $data);
        $this->load->view('templates/footer.php');
        //where ed.id_usuario = '$usuario'");
    }
    public function Listado_certificacion_exter()
    { // esto es el perfil 8 
        if (!$this->session->userdata('session')) redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        $data['usuario']  = $this->session->userdata('id_user');
        $data['ver'] = $this->Certificacion_model->consulta_certi50($usuario);
        $data['ver3'] = $this->Certificacion_model->consulta_certi_exter50($usuario);
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi_exter($usuario);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['time'] = date("Y-m-d");
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/listado_externo.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function Listado_certificacion_externo2()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');

        $data['ver_certi'] = $this->Certificacion_model->consulta_certi_exter($usuario);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/listado_externo.php', $data);
        $this->load->view('templates/footer.php');
    }

    //Consulta si existe el contrastita
    public function llenar_contratista()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data =    $this->Certificacion_model->llenar_contratista($data);
        echo json_encode($data);
    }

    public function llenar_contratista_rp()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data =    $this->Certificacion_model->llenar_contratista_rp($data);
        echo json_encode($data);
    }

    public function nro_comprobante()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data =    $this->Certificacion_model->cons_nro_comprobante();
        echo json_encode($data);
    }

    public function registrar_certificacion()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $acc_cargar = $this->input->POST('acc_cargar');
        $numcertrnc = $this->input->post("numcertrnc");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1; //persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $percontacto  = $this->input->post("percontacto");
        $usuario = $this->session->userdata('id_user');
        $declara  = "Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.";
        $acepto  = "SI";
        $fecha_solic  = date('Y-m-d');

        $status  = '1'; //estats pendiente  
        $nro_comprobante = $this->input->post("nro_comprobantes");

        $certifi = array(
            "nro_comprobante"  =>  $nro_comprobante,
            "n_certif"  =>  $numcertrnc,
            "rif_cont"    =>        $rif_cont,
            "nombre"  =>       $nombresocial,
            "tipo_pers"     =>     1,
            "objetivo"      =>      $objetivo,
            "cont_prog"     =>      $cont_prog,
            "total_bss"     =>     $total_bss,
            "n_ref"         =>    $n_ref,
            "banco_e"       =>     $banco_e,
            "banco_rec"     =>    $banco_rec,
            "fecha_trans"   =>     $fecha_trans,
            "monto_trans"   =>     $monto_trans,
            "declara"       =>     $declara,
            "acepto"        =>    $acepto,
            "fecha_solic"   =>   date("Y-m-d"),
            "user_soli"     =>  $usuario,
            "status"        =>   1


        );

        $experi_empre_capa = array( //experi_empre_capa
            'organo_experi_empre_capa'       => $this->input->post('organo_experi_empre_capa'),
            'actividad_experi_empre_capa'     => $this->input->post('actividad_experi_empre_capa'),
            'desde_experi_empre_capa'    => $this->input->post('desde_experi_empre_capa'),
            'hasta_experi_empre_capa'         => $this->input->post('hasta_experi_empre_capa'),
            "n_certif"     => $this->input->post("n_ref"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,

        );

        $experi_empre_cap_comisi = array( // experien cap 3 años
            'organo_expe'        => $this->input->post('organo_expe'),
            'actividad_exp'   => $this->input->post('actividad_exp'),
            'desde_exp'  => $this->input->post('desde_exp'),
            'hasta_exp'      => $this->input->post('hasta_exp'),
            "n_certif"     => $this->input->post("n_ref"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,

        );
        $infor_per_natu = array( // registro de persona natural
            'nombre_ape'        => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado'      => $this->input->post('bolivar_estimado'),
            "pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("sub_total"),
            "total_bss"     => $this->input->post("total_bss"),
            "status"     => 1,


        );
        $infor_per_prof = array( // registro infor profesional de la persona
            'for_academica'        => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion'      => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso")
        );

        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'        => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi'      => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
        );

        $exp_par_comi_10 = array( // registro infor profesional de la persona
            'organo10'        => $this->input->post('organo10'),
            'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
            'n_acto'  => $this->input->post('n_acto'),
            'fecha_act'      => $this->input->post('fecha_act'),
            "area_10"     => $this->input->post("area_10"),
            "dura_comi"     => $this->input->post("dura_comi"),
        );
        $exp_dic_cap_3 = array( // registro infor profesional de la persona
            'organo3'        => $this->input->post('organo3'),
            'actividad3'   => $this->input->post('actividad3'),
            'desde3'  => $this->input->post('desde3'),
            'hasta3'      => $this->input->post('hasta3'),

        );



        $data = $this->Certificacion_model->save_certificacion(
            $certifi,
            $experi_empre_capa,
            $experi_empre_cap_comisi,
            $infor_per_natu,
            $infor_per_prof,
            $for_mat_contr_publ,
            $exp_par_comi_10,
            $exp_dic_cap_3
        );
        echo json_encode($data);
    }

    public function ver_certifi()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data['rif_organoente'] = $this->session->userdata('rif_organoente');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $parametros = $this->input->get('id');
        $data['rif_cont'] = $this->input->get('id');
        $data['users'] = $this->session->userdata('id_user');
        $data['time'] = date("Y-m-d"); // para calcular la vigencia
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['inf_2'] = $this->Certificacion_model->certificaciones2($data['rif_cont']);
        $data['inf_3'] = $this->Certificacion_model->certificaciones3($data['rif_cont']);
        $data['inf_4'] = $this->Certificacion_model->certificaciones4($data['rif_cont']);
        $data['inf_5'] = $this->Certificacion_model->certificaciones5($data['rif_cont']);
        $data['inf_6'] = $this->Certificacion_model->certificaciones6($data['rif_cont']);
        $data['inf_7'] = $this->Certificacion_model->certificaciones7($data['rif_cont']);
        $data['inf_8'] = $this->Certificacion_model->certificaciones8($data['rif_cont']);
        $data['inf_9'] = $this->Certificacion_model->certificaciones_ver($data['rif_cont']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');

        $this->load->view('certificacion/consulta_id.php', $data);

        $this->load->view('templates/footer.php');
    }

    //////////////////////////

    public function editar_certificacion()
    {
        if (!$this->session->userdata('session')) redirect('login');
        //$data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['rif_cont']       = $this->input->get('id');
        $data['rif_organoente'] = $this->session->userdata('rif_organoente');
        // $data['id_propiet'] = $separar['2'];
        $data['time'] = date("Y-m-d");
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['inf_11'] = $this->Certificacion_model->inf_1();
        $data['inf_12'] = $this->Certificacion_model->inf_2();
        $data['inf_14'] = $this->Certificacion_model->inf_3();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado($data);
        $data['inf_20'] = $this->Certificacion_model->inf_1();
        $data['inf_21'] = $this->Certificacion_model->inf_3();


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/ver_edit_cert.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function editar_certificacion_pn()
    {
        if (!$this->session->userdata('session')) redirect('login');
        //$data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['rif_cont']       = $this->input->get('id');
        // $data['id_propiet'] = $separar['2'];
        $data['time'] = date("Y-m-d");
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['inf_11'] = $this->Certificacion_model->inf_1();
        $data['inf_12'] = $this->Certificacion_model->inf_2();
        $data['inf_14'] = $this->Certificacion_model->inf_35();
        $data['inf__15'] = $this->Certificacion_model->certificaciones4($data['rif_cont']);
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado($data);

        //$data['inf_1'] = $this->Programacion_model->inf_1($data['matricula']);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/ver_edit_cert_pn.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function guardar_editar_certficado_pn()
    {
        if (!$this->session->userdata('session')) redirect('login');

        $numcertrnc = $this->input->post("numcertrnc");
        $nro_comprobante = $this->input->post("nro_comprobante");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1; //persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("monto_estimado");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = $this->session->userdata('id_user');;
        $status  = '1'; //estats pendiente  
        $tipo_pers  = $this->input->post("tipo_pers");
        $id  = $this->input->post("id_");






        $certifi = array(

            "rif_cont"    =>        $rif_cont,
            "nombre"  =>       $nombresocial,
            "tipo_pers"     =>     $tipo_pers,
            "objetivo"      =>      $objetivo,
            "cont_prog"     =>      $cont_prog,
            "total_bss"     =>     $total_bss,
            "n_ref"         =>    $n_ref,
            "banco_e"       =>     $banco_e,
            "banco_rec"     =>    $banco_rec,
            "fecha_trans"   =>     $fecha_trans,
            "monto_trans"   =>     $monto_trans,

            "fecha_solic"   =>  $fecha_solic,
            "user_soli"     =>  $user_soli,
            "status"        =>   1


        );
        $infor_per_natu = array( // registro de persona natural
            'id'        => $id,
            'nombre_ape'        => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado'      => $this->input->post('bolivar_estimado'),
            //"pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("iva_estimado"),
            "total_final"     => $this->input->post("monto_estimado"),
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,


        );
        $infor_per_prof = array( // registro infor profesional de la persona
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            'for_academica'        => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion'      => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso"),
            'id'        => $id,
        );
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'        => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi'      => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
            "n_certif"     => $this->input->post("numcertrnc"),
            "nro_comprobante"  =>  $nro_comprobante,
            'id'        => $id,

        );
        $exp_par_comi_10 = array( // registro infor profesional de la persona
            'organo10'        => $this->input->post('organo10'),
            'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
            'n_acto'  => $this->input->post('n_acto'),
            'fecha_act'      => $this->input->post('fecha_act'),
            "area_10"     => $this->input->post("area_10"),
            "dura_comi"     => $this->input->post("dura_comi"),
            "n_certif"     => $this->input->post("numcertrnc"),
            "nro_comprobante"  =>  $nro_comprobante,
            'id'        => $id,
        );
        $exp_dic_cap_3 = array( // registro capsita 3 años de experiencia
            'organo3'        => $this->input->post('organo3'),
            'actividad3'   => $this->input->post('actividad3'),
            'desde3'  => $this->input->post('desde3'),
            'hasta3'      => $this->input->post('hasta3'),
            "n_certif"     => $this->input->post("numcertrnc"),
            "nro_comprobante"  =>  $nro_comprobante,
            'id'        => $id,
        );
        $data = $this->Certificacion_model->sav_editar__certificacion_pn(
            $rif_cont,
            $certifi,
            $infor_per_natu,
            $infor_per_prof,
            $for_mat_contr_publ,
            $exp_par_comi_10,
            $exp_dic_cap_3
        );

        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('certificacion/Listado_certificacion_exter');
        } else {
            $this->session->set_flashdata('sa-error', 'error');
            redirect('certificacion/Listado_certificacion_exter');
        }
    }
    public function ver_certi_editar()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->inf_2_edit($data);
        echo json_encode($data);
    }
    public function ver_certi_editar2()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->inf_3_o($data);
        echo json_encode($data);
    }
    public function ver_certi_editar3()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->inf_3_1($data);
        echo json_encode($data);
    }
    public function ver_certi_editar4()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->inf_3_2($data);
        echo json_encode($data);
    }
    public function ver_certi_editar5()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->inf_3_3($data);
        echo json_encode($data);
    }
    public function ver_certi_editar6()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->inf_3_4($data);
        echo json_encode($data);
    }
    public function ver_certi_editar7()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->inf_3_5($data);
        echo json_encode($data);
    }


    // editar certififcacion pj
    public function editar_certficado()
    {
        if (!$this->session->userdata('session')) redirect('login');

        $numcertrnc = $this->input->post("numcertrnc");
        $nro_comprobante = $this->input->post("nro_comprobante");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1; //persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = $this->session->userdata('id_user');;
        $status  = '1'; //estats pendiente  
        $tipo_pers  = $this->input->post("tipo_pers");
        $id  = $this->input->post("id_");

        $fecha_trans1 = $fecha_trans;
        if ($fecha_trans1 == '') {
            $fecha_trans2 = $fecha_solic;
        } else {
            $fecha_trans2 = $fecha_trans;
        }



        $certifi = array(

            "rif_cont"    =>        $rif_cont,
            "nombre"  =>       $nombresocial,
            "tipo_pers"     =>     $tipo_pers,
            "objetivo"      =>      $objetivo,
            "cont_prog"     =>      $cont_prog,
            "total_bss"     =>     $total_bss,
            "n_ref"         =>    $n_ref,
            "banco_e"       =>     $banco_e,
            "banco_rec"     =>    $banco_rec,
            "fecha_trans"   =>     $fecha_trans2,
            "monto_trans"   =>     $monto_trans,

            "fecha_solic"   =>   date("Y-m-d"),
            "user_soli"     =>  $user_soli,
            "status"        =>   1


        );
        $experi_empre_capa = array( //experi_empre_capa
            'organo_experi_empre_capa'       => $this->input->post('organo_experi_empre_capa'),
            'actividad_experi_empre_capa'     => $this->input->post('actividad_experi_empre_capa'),
            'desde_experi_empre_capa'    => $this->input->post('desde_experi_empre_capa'),
            'hasta_experi_empre_capa'         => $this->input->post('hasta_experi_empre_capa'),
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            "id"    =>        $id,

        );

        $experi_empre_cap_comisi = array( // experien cap 3 años
            'organo_expe'        => $this->input->post('organo_expe'),
            'actividad_exp'   => $this->input->post('actividad_exp'),
            'desde_exp'  => $this->input->post('desde_exp'),
            'hasta_exp'      => $this->input->post('hasta_exp'),
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            "id"    =>        $id,

        );
        $infor_per_natu = array( // registro de persona natural
            'nombre_ape'        => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado'      => $this->input->post('bolivar_estimado'),
            "pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("sub_total"),
            "total_bss"     => $this->input->post("total_bss"),
            "status"     => 1,


        );
        $infor_per_prof = array( // registro infor profesional de la persona
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            'for_academica'        => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion'      => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso"),
            "id"    =>        $id,
        );
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'        => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi'      => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
            "n_certif"     => $this->input->post("numcertrnc"),
            "id"    =>        $id,

        );
        $exp_par_comi_10 = array( // registro infor profesional de la persona
            'cedul10'        => $this->input->post('cedul10'),
            'organo10'        => $this->input->post('organo10'),
            'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
            'n_acto'  => $this->input->post('n_acto'),
            'fecha_act'      => $this->input->post('fecha_act'),
            "area_10"     => $this->input->post("area_10"),
            "dura_comi"     => $this->input->post("dura_comi"),
            "n_certif"     => $this->input->post("numcertrnc"),
            "id"    =>        $id,
        );
        $exp_dic_cap_3 = array( // registro capsita 3 años de experiencia
            'organo3'        => $this->input->post('organo3'),
            'actividad3'   => $this->input->post('actividad3'),
            'desde3'  => $this->input->post('desde3'),
            'hasta3'      => $this->input->post('hasta3'),
            "n_certif"     => $this->input->post("numcertrnc"),
            "id"    =>        $id,
        );
        $data = $this->Certificacion_model->editarcertificacion_pj(
            $rif_cont,
            $certifi,
            $experi_empre_capa,
            $experi_empre_cap_comisi,
            $infor_per_natu,
            $infor_per_prof,
            $for_mat_contr_publ,
            $exp_par_comi_10,
            $exp_dic_cap_3
        );

        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('certificacion/Listado_certificacion_exter');
        } else {
            $this->session->set_flashdata('sa-error', 'error');
            redirect('certificacion/Listado_certificacion_exter');
        }
    }
    public function renovar_certificacion()
    {
        if (!$this->session->userdata('session')) redirect('login');

        $numcertrnc = $this->input->post("numcertrnc");
        $nro_comprobante = $this->input->post("nro_comprobante");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1; //persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = $this->session->userdata('id_user');
        $status  = '1'; //estats pendiente  
        $tipo_pers  = $this->input->post("tipo_pers");
        $id1  = $this->input->post("id");
        $certifi = array(

            "rif_cont"    =>        $rif_cont,
            "nombre"  =>       $nombresocial,
            "tipo_pers"     =>     $tipo_pers,
            "objetivo"      =>      $objetivo,
            "cont_prog"     =>      $cont_prog,
            "total_bss"     =>     $total_bss,
            "n_ref"         =>    $n_ref,
            "banco_e"       =>     $banco_e,
            "banco_rec"     =>    $banco_rec,
            "fecha_trans"   =>     $fecha_trans,
            "monto_trans"   =>     $monto_trans,
            "fecha_solic"   =>   date("Y-m-d"),
            "user_soli"     =>  $user_soli,
            "status"        =>   1


        );
        $experi_empre_capa = array( //experi_empre_capa
            'organo_experi_empre_capa'       => $this->input->post('organo_experi_empre_capa'),
            'actividad_experi_empre_capa'     => $this->input->post('actividad_experi_empre_capa'),
            'desde_experi_empre_capa'    => $this->input->post('desde_experi_empre_capa'),
            'hasta_experi_empre_capa'         => $this->input->post('hasta_experi_empre_capa'),
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            "id"  =>  $id1,

        );

        $experi_empre_cap_comisi = array( // experien cap 3 años
            'organo_expe'        => $this->input->post('organo_expe'),
            'actividad_exp'   => $this->input->post('actividad_exp'),
            'desde_exp'  => $this->input->post('desde_exp'),
            'hasta_exp'      => $this->input->post('hasta_exp'),
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            "id"  =>  $id1,


        );
        $infor_per_natu = array( // registro de persona natural
            'nombre_ape'        => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado'      => $this->input->post('bolivar_estimado'),
            "pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("sub_total"),
            "total_bss"     => $this->input->post("total_bss"),
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            "id"  =>  $id1,



        );
        $infor_per_prof = array( // registro infor profesional de la persona
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            'for_academica'        => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion'      => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso"),
            "id"  =>  $id1,
        );
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'        => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi'      => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
            "n_certif"     => $numcertrnc,
            "nro_comprobante"  =>  $nro_comprobante,
            "id"  =>  $id1,

        );
        $exp_par_comi_10 = array( // registro infor profesional de la persona
            'organo10'        => $this->input->post('organo10'),
            'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
            'n_acto'  => $this->input->post('n_acto'),
            'fecha_act'      => $this->input->post('fecha_act'),
            "area_10"     => $this->input->post("area_10"),
            "dura_comi"     => $this->input->post("dura_comi"),
            "n_certif"     => $numcertrnc,
            "id"  =>  $id1,
        );
        $exp_dic_cap_3 = array( // registro capsita 3 años de experiencia
            'organo3'        => $this->input->post('organo3'),
            'actividad3'   => $this->input->post('actividad3'),
            'desde3'  => $this->input->post('desde3'),
            'hasta3'      => $this->input->post('hasta3'),
            "n_certif"     => $numcertrnc,
            "id"  =>  $id1,
        );
        $data = $this->Certificacion_model->renovacion__certificacion(
            $rif_cont,
            $certifi,
            $experi_empre_capa,
            $experi_empre_cap_comisi,
            $infor_per_prof,
            $for_mat_contr_publ,
            $exp_par_comi_10,
            $exp_dic_cap_3,
            $infor_per_natu
        );

        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('certificacion/Listado_certificacion_exter');
        } else {
            $this->session->set_flashdata('sa-error', 'error');
            redirect('certificacion/Listado_certificacion_exter');
        }
    }

    public function renovar_certificacion1()
    {
        if (!$this->session->userdata('session')) redirect('login');
        //$data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['rif_cont']       = $this->input->get('id');
        // $data['id_propiet'] = $separar['2'];
        $data['time'] = date("Y-m-d");
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['inf_11'] = $this->Certificacion_model->inf_1();
        $data['inf_12'] = $this->Certificacion_model->inf_2();
        $data['inf_14'] = $this->Certificacion_model->inf_3();

        $data['rif_organoente'] = $this->session->userdata('rif_organoente');
        $data['inf_15'] = $this->Certificacion_model->inf_1();
        $data['inf_2'] = $this->Certificacion_model->inf_2();
        $data['inf_3'] = $this->Certificacion_model->inf_3();
        $data['time'] = date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();

        //$data['inf_1'] = $this->Programacion_model->inf_1($data['matricula']);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/ver_renovar_certificacion1.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function renovar_certificacion_pn()
    {
        if (!$this->session->userdata('session')) redirect('login');
        //$data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['rif_cont']       = $this->input->get('id');
        // $data['id_propiet'] = $separar['2'];
        $data['time'] = date("Y-m-d");
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['inf_11'] = $this->Certificacion_model->inf_1();
        $data['inf_12'] = $this->Certificacion_model->inf_2();
        $data['inf_14'] = $this->Certificacion_model->inf_3();

        $data['rif_organoente'] = $this->session->userdata('rif_organoente');
        $data['inf_15'] = $this->Certificacion_model->inf_1();
        $data['inf_2'] = $this->Certificacion_model->inf_2();
        $data['inf_3'] = $this->Certificacion_model->inf_3();
        $data['time'] = date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/renovar/ver_renovar_certificacion_pn.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function renovar_certificacion_pn1()
    {
        if (!$this->session->userdata('session')) redirect('login');

        $numcertrnc = $this->input->post("numcertrnc");
        $nro_comprobante = $this->input->post("nro_comprobante");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1; //persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = $this->session->userdata('id_user');
        $status  = '1'; //estats pendiente  
        $tipo_pers  = $this->input->post("tipo_pers");
        $id1  = $this->input->post("id_");
        $certifi = array(

            "rif_cont"    =>        $rif_cont,
            "nombre"  =>       $nombresocial,
            "tipo_pers"     =>     $tipo_pers,
            "objetivo"      =>      $objetivo,
            "cont_prog"     =>      $cont_prog,
            "total_bss"     =>     $total_bss,
            "n_ref"         =>    $n_ref,
            "banco_e"       =>     $banco_e,
            "banco_rec"     =>    $banco_rec,
            "fecha_trans"   =>     $fecha_trans,
            "monto_trans"   =>     $monto_trans,
            "fecha_solic"   =>   date("Y-m-d"),
            "user_soli"     =>  $user_soli,
            "status"        =>   1


        );

        $infor_per_natu = array( // registro de persona natural
            "id"  =>  $id1,
            'nombre_ape'        => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado'      => $this->input->post('bolivar_estimado'),

            "sub_total"     => $this->input->post("iva_estimado"),
            "total_final"     => $this->input->post("monto_estimado"),
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,


        );
        $infor_per_prof = array( // registro infor profesional de la persona
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,
            'for_academica'        => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion'      => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso"),
            "id"  =>  $id1,
        );
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'        => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi'      => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
            "n_certif"     => $numcertrnc,
            "nro_comprobante"  =>  $nro_comprobante,
            "id"  =>  $id1,

        );
        $exp_par_comi_10 = array( // registro infor profesional de la persona
            'organo10'        => $this->input->post('organo10'),
            'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
            'n_acto'  => $this->input->post('n_acto'),
            'fecha_act'      => $this->input->post('fecha_act'),
            "area_10"     => $this->input->post("area_10"),
            "dura_comi"     => $this->input->post("dura_comi"),
            "n_certif"     => $numcertrnc,
            "id"  =>  $id1,
        );
        $exp_dic_cap_3 = array( // registro capsita 3 años de experiencia
            'organo3'        => $this->input->post('organo3'),
            'actividad3'   => $this->input->post('actividad3'),
            'desde3'  => $this->input->post('desde3'),
            'hasta3'      => $this->input->post('hasta3'),
            "n_certif"     => $numcertrnc,
            "id"  =>  $id1,
        );
        $data = $this->Certificacion_model->save_renovacion__certificacion_pn(
            $rif_cont,
            $certifi,
            $infor_per_prof,
            $for_mat_contr_publ,
            $exp_par_comi_10,
            $exp_dic_cap_3,
            $infor_per_natu
        );

        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('certificacion/Listado_certificacion_exter');
        } else {
            $this->session->set_flashdata('sa-error', 'error');
            redirect('certificacion/Listado_certificacion_exter');
        }
    }

    public function consultar_certificacion()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data['time'] = date("d-m-Y");
        $data['users'] = $this->session->userdata('id_user');
        $data =    $this->Certificacion_model->certificaciones_id($data);
        echo json_encode($data);
    }


    public function guardar_proc_pag()
    { //se guardA EL NUEVO ESTATUS DEL CERTIFICADO
        if (!$this->session->userdata('session')) redirect('login');
        $data['time'] = date("d-m-Y");
        $data['users'] = $this->session->userdata('id_user');
        $data = $this->input->post();
        $data =    $this->Certificacion_model->guardar_proc_pag($data);
        echo json_encode($data);
    }




    //////////pdf

    // public function verpdf()
    // {
    //     if (!$this->session->userdata('session')) redirect('login');
    //     $comprobante = $this->input->get('id');

    //     $data['descripcion'] = $this->session->userdata('unidad');
    //     $data['rif'] = $this->session->userdata('rif');

    //     $data['time'] = date("d-m-Y");
    //     // $data =	$this->Certificacion_model->certificaciones_id($data);
    //     $data['inf_pdf'] =    $this->Certificacion_model->ver_pdfs($comprobante);
    //     $data['ver_pdfs_2'] =    $this->Certificacion_model->ver_pdfs_2($comprobante);


    //     $this->load->view('templates/header.php');
    //     $this->load->view('templates/navigator.php');
    //     $this->load->view('certificacion/pdf.php', $data);
    //     $this->load->view('templates/footer.php');
    // }
    public function verpdf()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $comprobante = $this->input->get('id');

        // *** Solución: Asegurarse de que $comprobante es un entero ***
        $id_limpio = (int)$comprobante; // Convertir explícitamente a entero

        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['time'] = date("d-m-Y");

        $data['inf_pdf'] = $this->Certificacion_model->ver_pdfs($id_limpio); // Usar el ID limpio
        $data['ver_pdfs_2'] = $this->Certificacion_model->ver_pdfs_2($id_limpio); // Usar el ID limpio


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/pdf.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function verpdf2()
    {

        $comprobante = $this->input->get('id');


        $data['time'] = date("d-m-Y");
        // $data =	$this->Certificacion_model->certificaciones_id($data);
        $data['inf_pdf'] =    $this->Certificacion_model->ver_pdfs($comprobante);


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/pdf_ext.php', $data);
        $this->load->view('templates/footer.php');
    }



    public function verpdf3()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $comprobante = $this->input->get('id');

        // *** ASEGURAR QUE $comprobante ES UN ENTERO ***
        $id_limpio = (int)$comprobante;

        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['time'] = date("d-m-Y");

        // Obtener la información principal de la certificación
        $data['inf_certificacion'] = $this->Certificacion_model->ver_pdfs($id_limpio);
        // Obtener la lista de facilitadores para esa certificación
        $data['facilitadores'] = $this->Certificacion_model->ver_pdfs_2($id_limpio);


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/pdf.php', $data); // Pasar $data al archivo pdf.php
        $this->load->view('templates/footer.php');
    }

    ///////////////////////////////////////////////////////////////// registrar PN//////////////////////////////////////
    public function registrar_pn()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['estados']      = $this->Configuracion_model->consulta_estados();
        $data['pais']          = $this->Configuracion_model->consulta_paises();
        $data['edo_civil']      = $this->Configuracion_model->consulta_edo_civil();
        $data['rif_organoente'] = $this->session->userdata('rif_organoente');
        $data['inf_1'] = $this->Certificacion_model->inf_1();
        $data['inf_2'] = $this->Certificacion_model->inf_2();
        $data['inf_3'] = $this->Certificacion_model->inf_3();
        $data['time'] = date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado($data);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/registro_pn.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function nro_comprobante_pn()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data =    $this->Certificacion_model->cons_nro_comprobantenn();
        echo json_encode($data);
    }
    /// registrar_certificacion_pn
    public function registrar_certificacion_pn()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $acc_cargar = $this->input->POST('acc_cargar');
        $numcertrnc = $this->input->post("numcertrnc");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 2; //persona natural
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("monto_estimado");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = date('Y-m-d');
        $user_soli  = $this->session->userdata('id_user');
        $status  = '1'; //estats pendiente  
        $nro_comprobante = $this->input->post("nro_comprobantes");

        $certifi = array(
            "nro_comprobante"  =>  $nro_comprobante,
            "n_certif"  =>  $numcertrnc,
            "rif_cont"    =>        $rif_cont,
            "nombre"  =>       $nombresocial,
            "tipo_pers"     =>     2,
            "objetivo"      =>      $objetivo,
            "cont_prog"     =>      $cont_prog,
            "total_bss"     =>     $total_bss,
            "n_ref"         =>    $n_ref,
            "banco_e"       =>     $banco_e,
            "banco_rec"     =>    $banco_rec,
            "fecha_trans"   =>     $fecha_trans,
            "monto_trans"   =>     $monto_trans,
            "declara"       =>     $declara,
            "acepto"        =>    $acepto,
            "fecha_solic"   =>   date("Y-m-d"),
            "user_soli"     =>  $user_soli,
            "status"        =>   1


        );




        $infor_per_natu = array( // registro de persona natural
            'nombre_ape'        => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado'      => $this->input->post('bolivar_estimado'),
            //"pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("iva_estimado"),
            "total_bss"     => $this->input->post("monto_estimado"),


        );
        $infor_per_prof = array( // registro infor profesional de la persona
            'for_academica'        => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion'      => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso")
        );

        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'        => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi'      => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
        );

        $exp_par_comi_10 = array( // registro infor profesional de la persona
            'organo10'        => $this->input->post('organo10'),
            'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
            'n_acto'  => $this->input->post('n_acto'),
            'fecha_act'      => $this->input->post('fecha_act'),
            "area_10"     => $this->input->post("area_10"),
            "dura_comi"     => $this->input->post("dura_comi"),
        );
        $exp_dic_cap_3 = array( // registro infor profesional de la persona
            'organo3'        => $this->input->post('organo3'),
            'actividad3'   => $this->input->post('actividad3'),
            'desde3'  => $this->input->post('desde3'),
            'hasta3'      => $this->input->post('hasta3'),

        );



        $data = $this->Certificacion_model->save_certificacion_pn(
            $certifi,
            $infor_per_natu,
            $infor_per_prof,
            $for_mat_contr_publ,
            $exp_par_comi_10,
            $exp_dic_cap_3
        );
        echo json_encode($data);
    }

    public function llenar_contratistas()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data = $this->input->post();
        $data =    $this->Contratista_model->llenar_contratistas($data);
        echo json_encode($data);
    }

    public function registrar_exonerado()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado_2();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('tablas/confi_certificacion/add_exonerado.php', $data);
        $this->load->view('templates/footer.php');
    }



    public function registrar_b()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'rif' => $this->input->POST('codigo_b'),
            'descripcion' => $this->input->POST('nombre_b'),
            'id_usuaio' => $this->session->userdata('id_user'),
            'fecha_creacion' => date("Y-m-d"),
        );
        $data = $this->Certificacion_model->registrar_b($data);
        echo json_encode($data);
    }
    //LLENAR MODAL PARA consultar exonerado
    public function consulta_b()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->consulta_b($data);
        echo json_encode($data);
    }

    //guardar exonerado
    public function editar_b()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_exonerado' => $data['id_banco'],
            'rif' => $data['codigo_b'],
            'descripcion' => $data['nombre_b'],
            'id_usuaio' => $this->session->userdata('id_user')
        );

        $data = $this->Certificacion_model->editar_b($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_b()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->eliminar_b($data);
        echo json_encode($data);
    }

    ///////////////////////esto es facilitador
    public function ver_facilitador()
    {
        if (!$this->session->userdata('session'))
            redirect('login');

        $usuario = $this->session->userdata('id_user');
        $data['ver_facilitador'] = $this->Certificacion_model->consulta_facilitador($usuario);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');

        $this->load->view('certificacion/desin_instruc/desin_faci.php', $data);

        $this->load->view('templates/footer.php');
    }
    public function consulta_facilitadores()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->consulta_facilitadores($data);
        echo json_encode($data);
    }
    ///cambiar estatus facilitador desincorporar
    public function cambiar_estatus()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        if (($data['status'] == 1)) {
            $data = array(
                'cedula' => $data['cedula'],
                'rif_cont' => $data['rif_cont'],
                'nombre_desin' => $data['nombre_desin'],
                'cargo_desin' => $data['cargo_desin'],
                'motivo' => $data['motivo'],
                'status' => 0,

            );
        } else {
            $data = array(
                'cedula' => $data['cedula'],
                'rif_cont' => $data['rif_cont'],
                'nombre_desin' => $data['nombre_desin'],
                'cargo_desin' => $data['cargo_desin'],
                'motivo' => $data['motivo'],
                'status' => 1,

            );
        }


        $data = $this->Certificacion_model->cambiar_estatus($data);
        echo json_encode($data);
    }

    //////////////////Reportes

    public function fecha_vencimiento()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif']          = $this->session->userdata('rif');


        $hasta     = $this->input->post("hasta");
        $desde     = $this->input->post("desde");
        $data['desde'] = date('Y-m-d', strtotime($desde));
        $data['hasta'] = date('Y-m-d', strtotime($hasta));
        //	$this->form_validation->set_rules('t_pago', 't_pago', 'required|callback_select_validate');
        $this->form_validation->set_rules('hasta', 'Fecha hasta', 'required|min_length[1]');
        $this->form_validation->set_rules('desde', 'Fecha Desde ', 'required|min_length[1]');


        if ($this->form_validation->run() == FALSE) {
            $data['descripcion'] = $this->session->userdata('unidad');
            $data['rif']          = $this->session->userdata('rif');

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('certificacion/Reporte/fecha_venci.php', $data);
            $this->load->view('templates/footer.php');
        } else {



            $hasta     = $this->input->post("hasta");
            $desde     = $this->input->post("desde");
            $data['desde'] = date('Y-m-d', strtotime($desde));
            $data['hasta'] = date('Y-m-d', strtotime($hasta));
            $data['results']      =    $this->Certificacion_model->consultar_vencimiento($data);

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('certificacion/Reporte/ver_vencimi.php', $data);
            $this->load->view('templates/footer.php');
        }
    }

    public function status()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif']          = $this->session->userdata('rif');
        $hasta     = $this->input->post("hasta");
        $desde     = $this->input->post("desde");
        $data['desde'] = date('Y-m-d', strtotime($desde));
        $data['hasta'] = date('Y-m-d', strtotime($hasta));
        //	$this->form_validation->set_rules('t_pago', 't_pago', 'required|callback_select_validate');
        $this->form_validation->set_rules('hasta', 'Fecha hasta', 'required|min_length[1]');
        $this->form_validation->set_rules('desde', 'Fecha Desde ', 'required|min_length[1]');


        if ($this->form_validation->run() == FALSE) {
            $data['descripcion'] = $this->session->userdata('unidad');
            $data['rif']          = $this->session->userdata('rif');

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('certificacion/Reporte/status.php', $data);
            $this->load->view('templates/footer.php');
        } else {
            $hasta     = $this->input->post("hasta");
            $desde     = $this->input->post("desde");
            $data['desde'] = date('Y-m-d', strtotime($desde));
            $data['hasta'] = date('Y-m-d', strtotime($hasta));
            $data['status'] = $this->input->post("status");
            $data['results']      =    $this->Certificacion_model->status($data);

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('certificacion/Reporte/ver_status.php', $data);
            $this->load->view('templates/footer.php');
        }
    }
    /////////pagos 2 certificar
    public function consulta_pago2()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->consulta_pago_2($data);
        echo json_encode($data);
    }
    // guardar pago2 revision
    public function guardar_pago2()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id' => $data['id'],
            'pago2' => $data['pago2'],
            'nro_referencia2' => $data['nro_referencia2'],
            'banco_e2' => $data['banco_e2'],
            'banco_rec_2' => $data['banco_rec_2'],
            'fechatrnas2' => $data['fechatrnas2'],
            'motivo_pago_2' => $data['motivo_pago_2'],
            'status' => 1,
            'fecha_solic' => date('Y-m-d'),
            'revision' => 1,

        );

        $data = $this->Certificacion_model->guardar_pago_2($data);
        echo json_encode($data);
    }
    ////////interno 
    public function reg_pn()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['estados']      = $this->Configuracion_model->consulta_estados();
        $data['pais']          = $this->Configuracion_model->consulta_paises();
        $data['edo_civil']      = $this->Configuracion_model->consulta_edo_civil();
        $data['rif_organoente'] = $this->session->userdata('rif_organoente'); ///rif_cont
        $data['des_unidad'] = $this->session->userdata('unidad'); ///nombre
        $data['id_user'] = $this->session->userdata('id_user'); // ID del usuario logueado


        $data['inf_1'] = $this->Certificacion_model->inf_1();
        $data['inf_2'] = $this->Certificacion_model->inf_2();
        $data['inf_3'] = $this->Certificacion_model->inf_3();
        $data['time'] = date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado($data);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/certificacion_oeu/reg_pn.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function Listado_certificacion_interno_contralodira()
    { // esto lo vera los organos y entes interno
        if (!$this->session->userdata('session')) redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        $data['usuario']  = $this->session->userdata('id_user');
        $data['ver'] = $this->Certificacion_model->consulta_certi50($usuario);
        $data['ver3'] = $this->Certificacion_model->consulta_certi_exter50($usuario);
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi_exter($usuario);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['time'] = date("Y-m-d");
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/certificacion_oeu/listado_externo.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_reg_pn()
    {
        if (!$this->session->userdata('session')) redirect('login');
        $acc_cargar = $this->input->POST('acc_cargar');
        $numcertrnc = 1;
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 2; //persona natural
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("monto_estimado");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = date('Y-m-d');
        $user_soli  = $this->session->userdata('id_user');
        $status  = '1'; //estats pendiente  
        $nro_comprobante = $this->input->post("nro_comprobantes");

        $certifi = array(
            "nro_comprobante"  =>  $nro_comprobante,
            "n_certif"  =>  $numcertrnc,
            "rif_cont"    =>        $rif_cont,
            "nombre"  =>       $nombresocial,
            "tipo_pers"     =>     2,
            "objetivo"      =>      $objetivo,
            "cont_prog"     =>      $cont_prog,
            "total_bss"     =>     $total_bss,
            "n_ref"         =>    $n_ref,
            "banco_e"       =>     $banco_e,
            "banco_rec"     =>    $banco_rec,
            "fecha_trans"   =>     $fecha_trans,
            "monto_trans"   =>     $monto_trans,
            "declara"       =>     $declara,
            "acepto"        =>    $acepto,
            "fecha_solic"   =>   date("Y-m-d"),
            "user_soli"     =>  $user_soli,
            "status"        =>   1


        );




        $infor_per_natu = array( // registro de persona natural
            'nombre_ape'        => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado'      => $this->input->post('bolivar_estimado'),
            //"pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("iva_estimado"),
            "total_bss"     => $this->input->post("monto_estimado"),


        );
        $infor_per_prof = array( // registro infor profesional de la persona
            'for_academica'        => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion'      => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso")
        );

        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'        => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi'      => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
        );

        $exp_par_comi_10 = array( // registro infor profesional de la persona
            'organo10'        => $this->input->post('organo10'),
            'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
            'n_acto'  => $this->input->post('n_acto'),
            'fecha_act'      => $this->input->post('fecha_act'),
            "area_10"     => $this->input->post("area_10"),
            "dura_comi"     => $this->input->post("dura_comi"),
        );
        $exp_dic_cap_3 = array( // registro infor profesional de la persona
            'organo3'        => $this->input->post('organo3'),
            'actividad3'   => $this->input->post('actividad3'),
            'desde3'  => $this->input->post('desde3'),
            'hasta3'      => $this->input->post('hasta3'),

        );



        $data = $this->Certificacion_model->save_certificacion_pn(
            $certifi,
            $infor_per_natu,
            $infor_per_prof,
            $for_mat_contr_publ,
            $exp_par_comi_10,
            $exp_dic_cap_3
        );
        echo json_encode($data);
    }


    ///////////////////////

    // Nueva función para manejar el registro inicial de la certificación (Fase 1)
    public function registrar_certificacion_inicial_pn()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            return;
        }
        // echo json_encode(['success' => true, 'message' => '¡Llegó al controlador y envía JSON!']);
        // exit; // Detiene la ejecución aquí.
        // Datos que vienen del formulario
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("monto_estimado");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");

        // Datos que vienen de la sesión
        $rif_cont = $this->session->userdata('rif_organoente'); // RIF del usuario logueado
        $nombresocial = $this->session->userdata('unidad'); // Nombre del usuario logueado
        $user_soli  = $this->session->userdata('id_user'); // ID del usuario logueado

        // Preparar los datos para insertar
        $data_to_insert = array(
            // 'nro_comprobante' se generará en el modelo
            "rif_cont"        => $rif_cont,
            "nombre"          => $nombresocial,
            "tipo_pers"       => 2, // persona natural
            "objetivo"        => $objetivo,
            "cont_prog"       => $cont_prog,
            "total_bss"       => str_replace('.', '', str_replace(',', '.', $total_bss)),
            "n_ref"           => $n_ref,
            "banco_e"         => $banco_e,
            "banco_rec"       => $banco_rec,
            "fecha_trans"     => $fecha_trans,
            "monto_trans"     => str_replace('.', '', str_replace(',', '.', $monto_trans)),
            "fecha_solic"     => date("Y-m-d"), // Fecha actual del servidor
            "user_soli"       => $user_soli,
            "status"          => 1 // 1 para Pendiente
            // Los campos como n_certif, declara, acepto, qrcode_path, qrcode_data se manejarán después
        );

        // Llamar al modelo para guardar los datos iniciales
        $result = $this->Certificacion_model->save_initial_certificacion_pn($data_to_insert);

        if ($result['success']) {
            echo json_encode([
                'success' => true,
                'message' => 'Certificación inicial guardada con éxito. Ahora puede agregar los detalles.',
                'cert_id' => $result['cert_id'], // El ID global de la certificación
                'nro_comprobante' => $result['nro_comprobante'], // El nro_comprobante generado
                'rif_cont' => $rif_cont,
                'nombre' => $nombresocial,
                'objetivo' => $objetivo
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => $result['message']]);
        }
    }
    // Función para guardar Información de Persona Natural (si no se hizo en la principal)
    public function guardar_infor_persona_natural()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            return;
        }

        $cert_id = $this->input->post('cert_id');
        $nombre_ape = $this->input->post('nombre_ape');
        $cedula = $this->input->post('cedula');
        $rif = $this->input->post('rif');
        $bolivar_estimado = str_replace('.', '', str_replace(',', '.', $this->input->post('bolivar_estimado')));
        $iva_estimado = str_replace('.', '', str_replace(',', '.', $this->input->post('iva_estimado')));
        $monto_estimado = str_replace('.', '', str_replace(',', '.', $this->input->post('monto_estimado')));

        // Obtener nro_comprobante, n_certif, rif_cont de la tabla principal usando cert_id
        $main_cert_info = $this->Certificacion_model->get_cert_info_by_id($cert_id);
        if (!$main_cert_info) {
            echo json_encode(['success' => false, 'message' => 'Certificación principal no encontrada.']);
            return;
        }

        $data_pn = array(
            'id'               => $cert_id,
            'nro_comprobante'  => $main_cert_info->nro_comprobante,
            'n_certif'         => $main_cert_info->n_certif,
            'rif_cont'         => $main_cert_info->rif_cont,
            'nombre_ape'       => $nombre_ape,
            'cedula'           => $cedula,
            'rif'              => $rif,
            'bolivar_estimado' => $bolivar_estimado,
            'sub_total'        => $iva_estimado,
            'total_final'      => $monto_estimado,
        );

        $result = $this->Certificacion_model->save_infor_persona_natural($data_pn);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Información de persona natural guardada.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar la información de la persona natural.']);
        }
    }

    // Función para agregar Formación Profesional
    public function agregar_formacion_profesional()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            return;
        }

        $cert_id = $this->input->post('cert_id');
        // Obtener nro_comprobante, n_certif, rif_cont de la tabla principal
        $main_cert_info = $this->Certificacion_model->get_cert_info_by_id($cert_id);
        if (!$main_cert_info) {
            echo json_encode(['success' => false, 'message' => 'Certificación principal no encontrada.']);
            return;
        }

        $data_fp = array(
            'id'              => $cert_id,
            'n_certif'        => $main_cert_info->n_certif,
            'rif_cont'        => $main_cert_info->rif_cont,
            'for_academica'   => $this->input->post('for_academica'),
            'titulo'          => $this->input->post('titulo'),
            'ano'             => $this->input->post('ano'),
            'culminacion'     => $this->input->post('culminacion'),
            'curso'           => $this->input->post('curso'),
            'nro_comprobante' => $main_cert_info->nro_comprobante
        );

        $result = $this->Certificacion_model->add_formacion_profesional($data_fp);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Formación profesional agregada.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar formación profesional.']);
        }
    }

    // Función para obtener la lista de formación profesional
    public function get_formacion_profesional($cert_id)
    {
        if (!$this->session->userdata('session')) {
            echo json_encode([]);
            return;
        }
        $data = $this->Certificacion_model->get_formacion_profesional_by_cert_id($cert_id);
        echo json_encode($data);
    }

    // Función para eliminar formación profesional
    public function delete_formacion_profesional()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            return;
        }
        $id_infor_prof = $this->input->post('id');
        $result = $this->Certificacion_model->delete_formacion_profesional($id_infor_prof);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar.']);
        }
    }
    // Repetir funciones similares para:
    // - agregar_for_mat_contr_publ()
    // - get_for_mat_contr_publ()
    // - delete_for_mat_contr_publ()
    // - agregar_exp_par_comi_10()
    // - get_exp_par_comi_10()
    // - delete_exp_par_comi_10()
    // - agregar_exp_dic_cap_3()
    // - get_exp_dic_cap_3()
    // - delete_exp_dic_cap_3()

    // Función para finalizar el registro (Declaración)
    public function finalizar_registro_pn()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            return;
        }

        $cert_id = $this->input->post('cert_id');
        $declara = $this->input->post('declara');
        $acepto = $this->input->post('acepto'); // 'Si'

        $data_update = array(
            'declara' => $declara,
            'acepto'  => $acepto,
            'status'  => 2 // O un estado diferente si aún requiere aprobación manual
        );

        $result = $this->Certificacion_model->update_certificacion_status($cert_id, $data_update);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Registro finalizado con éxito.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al finalizar el registro.']);
        }
    }

    ///////////

    public function registrar2()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['estados']      = $this->Configuracion_model->consulta_estados();
        $data['pais']          = $this->Configuracion_model->consulta_paises();
        $data['edo_civil']      = $this->Configuracion_model->consulta_edo_civil();
        $data['rif_organoente'] = $this->session->userdata('rif_organoente');
        $data['des_unidad'] = $this->session->userdata('unidad'); ///nombre
        $data['id_user'] = $this->session->userdata('id_user'); // ID del usuario logueado
        $usuario = $this->session->userdata('id_user');
        $data['inf_1'] = $this->Certificacion_model->inf_1();
        $data['inf_2'] = $this->Certificacion_model->inf_2();
        $data['inf_3'] = $this->Certificacion_model->inf_3();
        $data['time'] = date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado($data);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/certificacion_oeu/registro_certificacion.php', $data);
        $this->load->view('templates/footer.php');
    }

    // public function registrar_certificacion2()
    // {
    //     if (!$this->session->userdata('session')) redirect('login');
    //     $acc_cargar = $this->input->POST('acc_cargar');
    //     $numcertrnc = $this->input->post("numcertrnc");
    //     $rif_cont = $this->input->post("rif_cont");
    //     $nombresocial = $this->input->post("nombre");
    //     $tipo_pers = 1; //persona juridica
    //     $objetivo = $this->input->post("objetivo");
    //     $cont_prog  = $this->input->post("cont_prog");
    //     $total_bss  = $this->input->post("total_bss");
    //     $n_ref  = $this->input->post("n_ref");
    //     $banco_e  = $this->input->post("banco_e");
    //     $banco_rec  = $this->input->post("banco_rec");
    //     $fecha_trans = $this->input->post("fecha_trans");
    //     $monto_trans  = $this->input->post("monto_trans");
    //     $declara  = $this->input->post("declara");
    //     $acepto  = $this->input->post("acepto");
    //     $percontacto  = $this->input->post("percontacto");
    //     $usuario = $this->session->userdata('id_user');
    //     $declara  = "Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.";
    //     $acepto  = "SI";
    //     $fecha_solic  = date('Y-m-d');

    //     $status  = '1'; //estats pendiente  
    //     $nro_comprobante = $this->input->post("nro_comprobantes");

    //     $certifi = array(
    //         "nro_comprobante"  =>  $nro_comprobante,
    //         "n_certif"  =>  $numcertrnc,
    //         "rif_cont"    =>        $rif_cont,
    //         "nombre"  =>       $nombresocial,
    //         "tipo_pers"     =>     1,
    //         "objetivo"      =>      $objetivo,
    //         "cont_prog"     =>      $cont_prog,
    //         "total_bss"     =>     $total_bss,
    //         "n_ref"         =>    $n_ref,
    //         "banco_e"       =>     $banco_e,
    //         "banco_rec"     =>    $banco_rec,
    //         "fecha_trans"   =>     $fecha_trans,
    //         "monto_trans"   =>     $monto_trans,
    //         "declara"       =>     $declara,
    //         "acepto"        =>    $acepto,
    //         "fecha_solic"   =>   date("Y-m-d"),
    //         "user_soli"     =>  $usuario,
    //         "status"        =>   1


    //     );

    //     $experi_empre_capa = array( //experi_empre_capa
    //         'organo_experi_empre_capa'       => $this->input->post('organo_experi_empre_capa'),
    //         'actividad_experi_empre_capa'     => $this->input->post('actividad_experi_empre_capa'),
    //         'desde_experi_empre_capa'    => $this->input->post('desde_experi_empre_capa'),
    //         'hasta_experi_empre_capa'         => $this->input->post('hasta_experi_empre_capa'),
    //         "n_certif"     => $this->input->post("n_ref"),
    //         "rif_cont"     => $this->input->post("rif_cont"),
    //         "nro_comprobante"  =>  $nro_comprobante,

    //     );

    //     $experi_empre_cap_comisi = array( // experien cap 3 años
    //         'organo_expe'        => $this->input->post('organo_expe'),
    //         'actividad_exp'   => $this->input->post('actividad_exp'),
    //         'desde_exp'  => $this->input->post('desde_exp'),
    //         'hasta_exp'      => $this->input->post('hasta_exp'),
    //         "n_certif"     => $this->input->post("n_ref"),
    //         "rif_cont"     => $this->input->post("rif_cont"),
    //         "nro_comprobante"  =>  $nro_comprobante,

    //     );

    //     $data = $this->Certificacion_model->save_certificacion2(
    //         $certifi,
    //         $experi_empre_capa,
    //         $experi_empre_cap_comisi,
    //         // $infor_per_natu,
    //         // $infor_per_prof,
    //         // $for_mat_contr_publ,
    //         // $exp_par_comi_10,
    //         // $exp_dic_cap_3
    //     );
    //     echo json_encode($data);
    // }

    public function registrar_certificacion2()
    {
        if (!$this->session->userdata('session')) redirect('login');

        $numcertrnc = $this->input->post("numcertrnc");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("total_bss"); // These might not be used for juridica, double check
        $n_ref  = $this->input->post("n_ref"); // This seems to be used as n_certif in your model, confirm its purpose
        $banco_e  = $this->input->post("banco_e"); // These might not be used for juridica, double check
        $banco_rec  = $this->input->post("banco_rec"); // These might not be used for juridica, double check
        $fecha_trans = $this->input->post("fecha_trans"); // These might not be used for juridica, double check
        $monto_trans   = str_replace('.', '', $this->input->post("monto_trans")); // Remove dots for monetary value
        $monto_trans   = str_replace(',', '.', $monto_trans); // Replace comma with dot for decimal
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $usuario = $this->session->userdata('id_user');
        $fecha_solic  = date('Y-m-d');
        $status  = '1'; //estats pendiente
        $nro_comprobante = $this->input->post("nro_comprobantes");

        // Main Certification Data
        $certifi = array(
            "nro_comprobante" => $nro_comprobante,
            "n_certif"        => $numcertrnc,
            "rif_cont"        => $rif_cont,
            "nombre"          => $nombresocial,
            "tipo_pers"       => 1, //persona juridica
            "objetivo"        => $objetivo,
            "cont_prog"       => $cont_prog,
            "total_bss"       => $total_bss,
            "n_ref"           => $n_ref, // This is potentially your certificate number, be consistent
            "banco_e"         => $banco_e,
            "banco_rec"       => $banco_rec,
            "fecha_trans"     => $fecha_trans,
            "monto_trans"     => $monto_trans,
            "declara"         => "Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.",
            "acepto"          => "SI",
            "fecha_solic"     => date("Y-m-d"),
            "user_soli"       => $usuario,
            "status"          => 1
        );

        // Data for experi_empre_capa (Experience in Training in Public Procurement)
        $experi_empre_capa_data = array(
            'organo_experi_empre_capa'    => $this->input->post('organo_experi_empre_capa'),
            'actividad_experi_empre_capa' => $this->input->post('actividad_experi_empre_capa'),
            'desde_experi_empre_capa'     => $this->input->post('desde_experi_empre_capa'),
            'hasta_experi_empre_capa'     => $this->input->post('hasta_experi_empre_capa')
        );

        // Data for experi_empre_cap_comisi (Experience in Training in Contracting Commissions)
        $experi_empre_cap_comisi_data = array(
            'organo_expe'     => $this->input->post('organo_expe'),
            'actividad_exp'   => $this->input->post('actividad_exp'),
            'desde_exp'       => $this->input->post('desde_exp'),
            'hasta_exp'       => $this->input->post('hasta_exp')
        );

        $data = $this->Certificacion_model->save_certificacion2(
            $certifi,
            $experi_empre_capa_data, // Pass the collected array directly
            $experi_empre_cap_comisi_data // Pass the collected array directly
        );
        echo json_encode($data);
    }
    public function miemb2()
    {
        if (!$this->session->userdata('session')) redirect('login');
        //Información traido por el session de usuario para mostrar inf
        $data['time'] = date("Y-m-d");
        $data['id_comision'] = $this->input->get('id');

        $data['carrera'] = $this->Comision_contrata_model->check_espec();
        $data['final']  = $this->Comision_contrata_model->check_organo();


        $data['ver'] = $this->Certificacion_model->check_miemb_certi($data['id_comision']);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/certificacion_oeu/agg_miembros.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_facilitadoresjs()
    {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'id' => $this->input->POST('id'),
            'nombre_ape' => $this->input->POST('nombre_ape'),
            'cedula' => $this->input->POST('cedula'),
            'rif_cont' => $this->input->POST('cedula'),

            'status' => 1,
        );
        $data = $this->Certificacion_model->registrar_facilitadoresjs($data);
        echo json_encode($data);
    }

    public function save_inff() // Keep the existing function name
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $data = $this->input->post();

        // Debugging (optional): Log received data from JS
        log_message('debug', 'Data received in save_inff controller: ' . print_r($data, true));

        $response = $this->Certificacion_model->save_inff($data);
        echo json_encode($response); // Return 1 for success, 0 or message for error
    }

    public function miemb_inf()
    {
        if (!$this->session->userdata('session')) redirect('login');

        $cedula_from_url = $this->input->get('id'); // This correctly captures '21151372' from '?id=21151372'

        // --- CRUCIAL: Initialize ALL variables to be used in the view ---
        $data['id_miembros_actual'] = ''; // Initialize id to empty string
        $data['cedula_del_miembro_actual'] = $cedula_from_url; // Always use the cedula that came from the URL
        $data['nro_comprobante_del_miembro_actual'] = ''; // Initialize nro_comprobante to empty string

        // Attempt to retrieve more complete member info from the database
        $member_info = $this->Certificacion_model->get_member_basic_info_by_cedula($cedula_from_url);

        // If member info is found, overwrite the initialized values
        if ($member_info) {
            $data['id_miembros_actual'] = $member_info['id'];
            $data['cedula_del_miembro_actual'] = $member_info['cedula']; // Confirm with DB value
            $data['nro_comprobante_del_miembro_actual'] = 1;
        }
        // --- End CRUCIAL initialization ---

        // The rest of your controller code
        $data['time'] = date("Y-m-d");

        // Pass the correct cedula to your model functions
        $data['academico'] = $this->Certificacion_model->check_miemb_inf_ac($data['cedula_del_miembro_actual']);
        $data['formc'] = $this->Certificacion_model->check_miemb_inf_contr_pub($data['cedula_del_miembro_actual']);
        $data['con_p'] = $this->Certificacion_model->check_miemb_inf_EXP_10($data['cedula_del_miembro_actual']);
        $data['con_c'] = $this->Certificacion_model->check_miemb_inf_EXP_3($data['cedula_del_miembro_actual']);
        $data['final']  = $this->Comision_contrata_model->check_organo();
        $data['carrera'] = $this->Comision_contrata_model->check_espec();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/certificacion_oeu/see_inf.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save_formacion_cp()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $data = $this->input->post();

        // **Importante**: Aquí puedes añadir validaciones adicionales si lo deseas
        // Por ejemplo, verificar que los campos obligatorios no estén vacíos

        $response = $this->Certificacion_model->save_formacion_cp($data);
        echo json_encode($response); // Devolver 1 para éxito, 0 o mensaje para error
    }

    public function save_experiencia_comision()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $data = $this->input->post();

        // Aquí puedes añadir validaciones adicionales si lo deseas

        $response = $this->Certificacion_model->save_experiencia_comision($data);
        echo json_encode($response); // Devolver 1 para éxito, 0 o mensaje para error
    }
    public function save_dictado_capacitacion()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $data = $this->input->post();

        // Aquí puedes añadir validaciones adicionales si lo deseas

        $response = $this->Certificacion_model->save_dictado_capacitacion($data);
        echo json_encode($response); // Devolver 1 para éxito, 0 o mensaje para error
    }

    //////////////editar informacion de los facilitadores 
    // Método para obtener los datos de un registro académico por su ID (para edición)
    public function get_inf_academica_by_id()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['error' => 'Sesión no iniciada']);
            return;
        }

        $id_per = $this->input->post('id_per'); // Recibe el id_per del registro

        if (!$id_per) {
            echo json_encode(['error' => 'ID de registro no proporcionado']);
            return;
        }

        $data = $this->Certificacion_model->get_inf_academica_by_id($id_per);
        echo json_encode($data); // Devuelve los datos como JSON
    }

    // Método para actualizar un registro de información académica
    public function update_inf_academica()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['error' => 'Sesión no iniciada']);
            return;
        }

        $id_per = $this->input->post('id_per'); // ID del registro a actualizar

        // Recoger los datos actualizados del formulario
        $update_data = array(
            'for_academica' => $this->input->post('for_academica'),
            'titulo'        => $this->input->post('titulo'),
            'ano'           => $this->input->post('ano'),
            'culminacion'   => $this->input->post('culminacion'),
            'curso'         => $this->input->post('curso')
        );

        if (!$id_per || empty($update_data)) {
            echo json_encode(['error' => 'Datos insuficientes para actualizar']);
            return;
        }

        $response = $this->Certificacion_model->update_inf_academica($id_per, $update_data);
        echo json_encode($response); // Devuelve 1 para éxito, 0 para error
    }

    public function get_formacion_cp_by_id()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['error' => 'Sesión no iniciada']);
            return;
        }

        $id_form = $this->input->post('id_form'); // Recibe el id_form del registro

        if (!$id_form) {
            echo json_encode(['error' => 'ID de registro no proporcionado']);
            return;
        }

        $data = $this->Certificacion_model->get_formacion_cp_by_id($id_form);
        echo json_encode($data); // Devuelve los datos como JSON
    }

    // Método para actualizar un registro de Formación Contratación Pública
    public function update_formacion_cp()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['error' => 'Sesión no iniciada']);
            return;
        }

        $id_form = $this->input->post('id_form'); // ID del registro a actualizar

        // Recoger los datos actualizados del formulario
        $update_data = array(
            'taller'       => $this->input->post('taller'),
            'institucion'  => $this->input->post('institucion'),
            'hor_dura'     => $this->input->post('hor_dura'),
            'certi'        => $this->input->post('certi'), // Asegúrate que sea el campo correcto en DB
            'fech_cert'    => $this->input->post('fech_cert'),
            'vigencia'     => $this->input->post('vigencia')
        );

        if (!$id_form || empty($update_data)) {
            echo json_encode(['error' => 'Datos insuficientes para actualizar']);
            return;
        }

        $response = $this->Certificacion_model->update_formacion_cp($id_form, $update_data);
        echo json_encode($response); // Devuelve 1 para éxito, 0 para error
    }
    public function get_exp_comis_by_id()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['error' => 'Sesión no iniciada']);
            return;
        }

        $id_exp_10 = $this->input->post('id_exp_10'); // Recibe el id_exp_10 del registro

        if (!$id_exp_10) {
            echo json_encode(['error' => 'ID de registro no proporcionado']);
            return;
        }

        $data = $this->Certificacion_model->get_exp_comis_by_id($id_exp_10);
        echo json_encode($data); // Devuelve los datos como JSON
    }

    // Método para actualizar un registro de Experiencia en Comisiones
    public function update_exp_comis()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['error' => 'Sesión no iniciada']);
            return;
        }

        $id_exp_10 = $this->input->post('id_exp_10'); // ID del registro a actualizar

        // Recoger los datos actualizados del formulario
        $update_data = array(
            'organo10'          => $this->input->post('organo10'),
            'act_adminis_desid' => $this->input->post('act_adminis_desid'),
            'n_acto'            => $this->input->post('n_acto'),
            'fecha_act'         => $this->input->post('fecha_act'),
            'area_10'           => $this->input->post('area_10'),
            'dura_comi'         => $this->input->post('dura_comi')
        );

        if (!$id_exp_10 || empty($update_data)) {
            echo json_encode(['error' => 'Datos insuficientes para actualizar']);
            return;
        }

        $response = $this->Certificacion_model->update_exp_comis($id_exp_10, $update_data);
        echo json_encode($response); // Devuelve 1 para éxito, 0 para error
    }
    public function get_dictado_cap_by_id()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['error' => 'Sesión no iniciada']);
            return;
        }

        $id_dic_cap_3 = $this->input->post('id_dic_cap_3'); // Recibe el id_dic_cap_3 del registro

        if (!$id_dic_cap_3) {
            echo json_encode(['error' => 'ID de registro no proporcionado']);
            return;
        }

        $data = $this->Certificacion_model->get_dictado_cap_by_id($id_dic_cap_3);
        echo json_encode($data); // Devuelve los datos como JSON
    }

    // Método para actualizar un registro de Dictado de Capacitación
    public function update_dictado_cap()
    {
        if (!$this->session->userdata('session')) {
            echo json_encode(['error' => 'Sesión no iniciada']);
            return;
        }

        $id_dic_cap_3 = $this->input->post('id_dic_cap_3'); // ID del registro a actualizar

        // Recoger los datos actualizados del formulario
        $update_data = array(
            'organo3'    => $this->input->post('organo3'),
            'actividad3' => $this->input->post('actividad3'),
            'desde3'     => $this->input->post('desde3'),
            'hasta3'     => $this->input->post('hasta3')
        );

        if (!$id_dic_cap_3 || empty($update_data)) {
            echo json_encode(['error' => 'Datos insuficientes para actualizar']);
            return;
        }

        $response = $this->Certificacion_model->update_dictado_cap($id_dic_cap_3, $update_data);
        echo json_encode($response); // Devuelve 1 para éxito, 0 para error
    }
    ////////////// ficha tecnica de contraloria
    public function ver_ficha_tecnica()
    {
        if (!$this->session->userdata('session')) redirect('login');

        $id_certificacion = $this->input->get('id'); // Asumo que el ID de la certificación viene por GET

        if (!$id_certificacion) {
            // Redirigir o mostrar error si no hay ID de certificación
            redirect('alguna_pagina_de_error_o_lista');
            return;
        }

        // --- 1. Obtener Información de Certificación principal ---
        $data['certificacion_info'] = $this->Certificacion_model->get_certificacion_info($id_certificacion);

        if (!$data['certificacion_info']) {
            // No se encontró la certificación
            redirect('alguna_pagina_de_error_o_lista');
            return;
        }

        //experiencia d ela empresa 3 años
        $data['experiencia_empresa'] = $this->Certificacion_model->get_experiencia_empresa($id_certificacion);
        //experiencia de la empresa 5 años esto lo agregue
        $data['experiencia_empresa10'] = $this->Certificacion_model->get_experiencia_empresa10($id_certificacion);


        // --- 3. Obtener Información de Facilitadores ---
        // Asumo que los facilitadores vinculados a esta certificación se pueden obtener
        // por el 'id' de la certificación o por alguna otra columna en infor_per_natu que la vincule.
        // Si certificaciones no tiene un ID de facilitador, podemos buscar facilitadores
        // asociados al 'rif_cont' de la certificación, o se debe aclarar cómo se vinculan.
        // Para simplificar, asumiré que `certificacion_info` puede tener `rif_cont` o `cedula_facilitador`
        // y que los detalles del facilitador se buscan con la `cedula`.
        // Si la tabla 'certificaciones' tiene una relación uno a muchos con 'infor_per_natu',
        // o un campo 'cedula_facilitador' directamente.
        // Para este ejemplo, si `certificaciones` no tiene una relación directa con `infor_per_natu`,
        // tendrías que adaptar esta parte.

        // === ADAPTACIÓN CLAVE: CÓMO OBTENER LOS FACILITADORES DE ESTA CERTIFICACIÓN ===
        // Opción A: Si 'certificaciones' tiene un campo 'cedula_facilitador' o similar
        // $facilitador_cedula = $data['certificacion_info']['cedula_facilitador'];
        // $facilitadores_basic_info = $this->Certificacion_model->get_member_basic_info_by_cedula($facilitador_cedula);
        //
        // Opción B: Si necesitas obtener MULTIPLES facilitadores asociados por el ID de la certificacion.
        // Esto implicaría una tabla intermedia como certificacion_facilitadores (id_cert, id_facilitador)
        // $data['facilitadores_ids'] = $this->Certificacion_model->get_facilitator_ids_for_cert($id_certificacion);
        //
        // Opción C (Simplificación si no hay vínculo claro y solo quieres mostrar TODOS los facilitadores o buscar por rif_cont):
        // Basándome en la descripción y las tablas, parece que 'infor_per_natu' es una tabla general de personas.
        // Las tablas de formación y experiencia de los facilitadores se vinculan a 'infor_per_natu' por 'id' y 'cedula'.
        //
        // Para la "Ficha Técnica", lo más lógico es que muestre los facilitadores que están 'vinculados' a esa certificación.
        // Si no hay un vínculo explícito en `certificaciones`, podríamos listar los que tienen registros en `infor_per_natu`.
        // Asumo que la `cedula` del facilitador se usará como identificador principal para buscar sus detalles.
        // Por ahora, obtendré TODOS los facilitadores de `infor_per_natu` para DEMOSTRACIÓN, pero tú deberías filtrar.
        // Una opción más realista es que `certificaciones` tenga una columna `facilitador_cedula` o `facilitador_id`.

        // **Para este ejemplo, buscaremos los facilitadores directamente asociados al `rif_cont` de la certificación principal**
        // (Esto es una ASUNCIÓN, si tu modelo de datos es diferente, deberás cambiarlo).
        $rif_cont_certificacion = $data['certificacion_info']['rif_cont'];
        $facilitadores = $this->Certificacion_model->get_facilitadores_by_rif_cont($id_certificacion);

        $data['facilitadores_detalles'] = [];
        foreach ($facilitadores as $facilitador) {
            $facilitador_cedula = $facilitador['cedula'];
            $facilitador_id_infor_per_natu = $facilitador['id']; // El ID de la tabla infor_per_natu

            // Obtener la información detallada para cada facilitador
            $facilitador_detail = $facilitador; // Iniciar con la info básica
            $facilitador_detail['formacion_academica'] = $this->Certificacion_model->check_miemb_inf_ac($facilitador_cedula); // Asumo que esta ya hace el JOIN
            $facilitador_detail['formacion_cp'] = $this->Certificacion_model->check_miemb_inf_contr_pub($facilitador_cedula);
            $facilitador_detail['experiencia_comisiones'] = $this->Certificacion_model->check_miemb_inf_exp_comis($facilitador_cedula); // Nuevo
            $facilitador_detail['dictado_capacitacion'] = $this->Certificacion_model->check_miemb_inf_cap_dictado($facilitador_cedula); // Nuevo

            $data['facilitadores_detalles'][] = $facilitador_detail;
        }


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/certificacion_oeu/ficha_tecnica.php', $data); // Nueva vista
        $this->load->view('templates/footer.php');
    }

    public function registrar_certificacion3()
    {
        if (!$this->session->userdata('session')) redirect('login');

        $numcertrnc = $this->input->post("numcertrnc");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog");
        $total_bss  = $this->input->post("total_bss"); // These might not be used for juridica, double check
        $n_ref  = $this->input->post("n_ref"); // This seems to be used as n_certif in your model, confirm its purpose
        $banco_e  = $this->input->post("banco_e"); // These might not be used for juridica, double check
        $banco_rec  = $this->input->post("banco_rec"); // These might not be used for juridica, double check
        $fecha_trans = $this->input->post("fecha_trans"); // These might not be used for juridica, double check
        $monto_trans   = str_replace('.', '', $this->input->post("monto_trans")); // Remove dots for monetary value
        $monto_trans   = str_replace(',', '.', $monto_trans); // Replace comma with dot for decimal
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $usuario = $this->session->userdata('id_user');
        $fecha_solic  = date('Y-m-d');
        $status  = '1'; //estats pendiente
        $nro_comprobante = $this->input->post("nro_comprobantes");

        // Main Certification Data
        $certifi = array(
            "nro_comprobante" => $nro_comprobante,
            "n_certif"        => $numcertrnc,
            "rif_cont"        => $rif_cont,
            "nombre"          => $nombresocial,
            "tipo_pers"       => 1, //persona juridica
            "objetivo"        => $objetivo,
            "cont_prog"       => $cont_prog,
            "total_bss"       => $total_bss,
            "n_ref"           => $n_ref, // This is potentially your certificate number, be consistent
            "banco_e"         => $banco_e,
            "banco_rec"       => $banco_rec,
            "fecha_trans"     => $fecha_trans,
            "monto_trans"     => $monto_trans,
            "declara"         => "Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.",
            "acepto"          => "SI",
            "fecha_solic"     => date("Y-m-d"),
            "user_soli"       => $usuario,
            "status"          => 1
        );

        // Data for experi_empre_capa (Experience in Training in Public Procurement)
        $experi_empre_capa_data = array(
            'organo_experi_empre_capa'    => $this->input->post('organo_experi_empre_capa'),
            'actividad_experi_empre_capa' => $this->input->post('actividad_experi_empre_capa'),
            'desde_experi_empre_capa'     => $this->input->post('desde_experi_empre_capa'),
            'hasta_experi_empre_capa'     => $this->input->post('hasta_experi_empre_capa')
        );

        // Data for experi_empre_cap_comisi (Experience in Training in Contracting Commissions)
        $experi_empre_cap_comisi_data = array(
            'organo_expe'     => $this->input->post('organo_expe'),
            'actividad_exp'   => $this->input->post('actividad_exp'),
            'desde_exp'       => $this->input->post('desde_exp'),
            'hasta_exp'       => $this->input->post('hasta_exp')
        );
        $verification_url_base = base_url('index.php/verificador/certificado?id=');
        $data = $this->Certificacion_model->save_certificacion3(
            $certifi,
            $experi_empre_capa_data, // Pass the collected array directly
            $experi_empre_cap_comisi_data, // Pass the collected array directly
            $verification_url_base
        );
        echo json_encode($data);
    }
}
