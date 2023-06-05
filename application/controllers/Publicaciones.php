<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Publicaciones extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        //$this->load->model('Tablas_model');
    }
    public function consultar_numeropro(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Publicaciones_model->consultar_numeropro($data);
        echo json_encode($data);
    }
    //aca anulacion de un llamdo a consulros 

    public function anulacion(){
		if(!$this->session->userdata('session'))redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $rif = $this->session->userdata['rif_organoente'];
        $data['time']=date("Y-m-d");
        $data['llamados'] = $this->Publicaciones_model->consulta_llamados($rif);
        $data['causa_suspencion'] = $this->Publicaciones_model->causa_suspencion();
        $data['supuestos'] = $this->Publicaciones_model->supuestos();
        $data['terminar_manual'] = $this->Publicaciones_model->terminar_manual();
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('anularllamado/anularllamado.php', $data);
        $this->load->view('templates/footer.php');
	}
// lo vera solo el snc o perfil 1 
    public function anulaciones_general(){
		if(!$this->session->userdata('session'))redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
      $data['rif'] = $this->session->userdata('rif');
       $rif = $this->session->userdata['rif_organoente'];
        $data['llamados'] = $this->Publicaciones_model->consulta_anulacion_general();
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('anularllamado/anulados_general.php', $data);
        $this->load->view('templates/footer.php');
	}
   
    public function anular(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $parametros = $this->input->get('id');
        $data['numero_proceso']=$this->input->get('id');
        $data['causas'] = $this->Publicaciones_model->causa_b();

        $data['inf_1'] = $this->Publicaciones_model->inf_1($data['numero_proceso']);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        
          $this->load->view('anularllamado/anular.php', $data);
        
        $this->load->view('templates/footer.php');
    }
    public function guardar_anulacion(){
		if(!$this->session->userdata('session'))redirect('login');
        
        $numero_proceso = $this->input->post("numero_proceso");
        $numero_proceso2 = $this->input->post("numero_proceso2");
        $estatus = '2';
        $observaciones = $this->input->post("observaciones"); 
        $especifique_anulacion = $this->input->post("especifique_anulacion"); 
        
        $anular = array(
                
            "numero_proceso"     => $numero_proceso2,
            "estatus"     => $estatus,
            "observaciones"     => $observaciones,
            "especifique_anulacion"     => $especifique_anulacion              
        ); 
       $data = $this->Publicaciones_model->guardar_anulaciones($anular, $numero_proceso,$numero_proceso2);
	 
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('Publicaciones/anulacion');
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('Publicaciones/anulacion');
		 }
	}

    ////////////////////////////////////Prorroga
    public function prorroga(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $parametros = $this->input->get('id');
        $data['numero_proceso']=$this->input->get('id');
        $data['causa_prorroga'] = $this->Publicaciones_model->causa_prorroga();
        $data['time']=date("Y-m-d");

        $data['inf_1'] = $this->Publicaciones_model->inf_1($data['numero_proceso']);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
          $this->load->view('publicaciones/prorroga/prorroga.php', $data);
        
        $this->load->view('templates/footer.php');
    }
    public function guardar_Prorroga() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'numero_proceso' => $this->input->POST('numero_proceso'),
            'fecha_fin_llamado' => $this->input->POST('fecha_fin_llamado'),
            'fecha_tope' => $this->input->POST('fecha_tope'),
            'articulo' => $this->input->POST('causa_prorroga'),
            'hora_desde' => $this->input->POST('hora_desde'),
            'hora_hasta' => $this->input->POST('hora_hasta'),
            'hora_desde_sobre' => $this->input->POST('hora_desde_sobre'),
            'observaciones' => $this->input->POST('observaciones'),
            'especifique_anulacion' => $this->input->POST('especifique_anulacion'),
            'estatus' => 5,
            
        );
        $data = $this->Publicaciones_model->guardar_Prorroga($data);
        echo json_encode($data);
    }
    public function guardar_Prorroga12(){
		if(!$this->session->userdata('session'))redirect('login');
        $data['time']=date("Y-m-d");
        $numero_proceso = $this->input->post("numero_proceso");
      //  $numero_proceso2 = $this->input->post("numero_proceso2");
        $estatus = '5';
        $fecha_fin_llamado=$this->input->post("fecha_fin_llamado");
        $fecha_tope=$this->input->post("fecha_tope");
        $articulo=$this->input->post("articulo");
       
        $especifique_anulacion = $this->input->post("especifique_anulacion"); 
        $fecha_cam_estatus=date("Y-m-d");
        $prorroga = array(
                
            "numero_proceso"     => $numero_proceso,
            "estatus"     => $estatus,
            "fecha_fin_llamado"     => $fecha_fin_llamado,
            "fecha_tope"     => $fecha_tope,
            "articulo"     => $articulo,
            "fecha_cam_estatus"     => $fecha_cam_estatus,
            "especifique_anulacion"     => $especifique_anulacion              
        ); 
       $data = $this->Publicaciones_model->guardar_Prorroga1($prorroga, $numero_proceso,$numero_proceso2);
	 
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('Publicaciones/anulacion');
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('Publicaciones/anulacion');
		 }
	}
///////////////SUSPENCION//////////////////////////
    public function guardar_suspencion() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'numero_proceso' => $this->input->POST('numero_proceso'),
            'fecha_cam_estatus' =>date("Y-m-d"),
            'especifique_anulacion' => $this->input->POST('especifique_anulacion'),
            'articulo' => $this->input->POST('supuesto'),
            'estatus' => 7,

            
        );
        $data = $this->Publicaciones_model->guardar_suspencion($data);
        echo json_encode($data);
    }
    //////////////////////RE-iniciar////////////////////////////////
    public function re_iniciar(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $parametros = $this->input->get('id');
        $data['numero_proceso']=$this->input->get('id');
        $data['causa_reiniciado'] = $this->Publicaciones_model->causa_reiniciado();
        $data['time']=date("Y-m-d");

        $data['inf_1'] = $this->Publicaciones_model->inf_1($data['numero_proceso']);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
          $this->load->view('publicaciones/reiniciar/reiniciar.php', $data);
        
        $this->load->view('templates/footer.php');
    }
    public function guardar_reinicio() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'numero_proceso' => $this->input->POST('numero_proceso'),
            'fecha_fin_llamado' => $this->input->POST('fecha_fin_llamado'),
            'fecha_tope' => $this->input->POST('fecha_tope'),
            'articulo' => $this->input->POST('causa_prorroga'),
            'hora_desde' => $this->input->POST('hora_desde'),
            'hora_hasta' => $this->input->POST('hora_hasta'),
            'hora_desde_sobre' => $this->input->POST('hora_desde_sobre'),
            'direccion_sobre' => $this->input->POST('direccion_sobre'),
            'lugar_entrega' => $this->input->POST('lugar_entrega'),
            'observaciones' => $this->input->POST('observaciones'),
            'especifique_anulacion' => $this->input->POST('especifique_anulacion'),
            'estatus' => 6,
            
        );
        $data = $this->Publicaciones_model->guardar_reinicio($data);
        echo json_encode($data);
    }
    ///////////////////////////////terminacion manual///////////////////////
    public function guardar_termina() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'numero_proceso' => $this->input->POST('numero_proceso2'),
            'fecha_cam_estatus' =>date("Y-m-d"),
            'especifique_anulacion' => $this->input->POST('especifique_anulacion2'),
            'articulo' => $this->input->POST('causa_termino'),
            'estatus' => 0,

            
        );
        $data = $this->Publicaciones_model->guardar_termino($data);
        echo json_encode($data);
    }
    //CRUD BANCO
    public function banco() {
        $data['bancos'] = $this->Publicaciones_model->consultar_b();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/banco.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'codigo_b' => $this->input->POST('codigo_b'),
            'nombre_b' => $this->input->POST('nombre_b'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_b($data);
        echo json_encode($data);
    }

    //LLENAR MODAL PARA EDITAR
    public function consulta_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_b($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_banco' => $data['id_banco'],
            'codigo_b' => $data['codigo_b'],
            'nombre_b' => $data['nombre_b'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_b($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_b($data);
        echo json_encode($data);
    }

    /////////////////////
    //CRUD TIPO DE CUENTA
    public function tipo_cuenta() {
        $data['tipocuenta'] = $this->Publicaciones_model->consultar_tc();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/tipo_cuenta.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_tc() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'tipo_cuenta' => $this->input->POST('tipo_cuenta'),
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->registrar_tc($data);
        echo json_encode($data);
    }

    //LLENAR MODAL PARA EDITAR
    public function consulta_tc() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_tc($data);
        echo json_encode($data);
    }

//EDITAR

    public function editar_tc() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_tipocuenta' => $data['id_tipocuenta'],
            'tipo_cuenta' => $data['tipo_cuenta'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_tc($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_tc() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_tc($data);
        echo json_encode($data);
    }

    //////////////
    //CRUD DE DATOS BANCARIOS
    public function datosbancarios() {
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['tipocuenta'] = $this->Publicaciones_model->consultar_tc();

        $usuario = $this->session->userdata('id_user');
        $data['datosb'] = $this->Publicaciones_model->consultar_datosb($usuario);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/datosbancarios.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_datosb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'id_banco' => $this->input->POST('id_banco'),
            'id_tipocuenta' => $this->input->POST('id_tipocuenta'),
            'n_cuenta' => $this->input->POST('n_cuenta'),
            'beneficiario' => $this->input->POST('beneficiario'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_datosb($data);
        echo json_encode($data);
    }

    //CONSULTAR DATOS
    public function consulta_datosb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_datosba($data);
        echo json_encode($data);
    }

    public function consulta_tipocentae() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_tipocentae($data);
        echo json_encode($data);
    }

    public function consulta_bancoe() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_bancoe($data);
        echo json_encode($data);
    }

    public function editar_datosb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $id_datosb = $data['id_datosb'];

        $data = array(
            'id_banco' => $data['id_banco'],
            'id_tipocuenta' => $data['id_tipocuenta'],
            'n_cuenta' => $data['ncuenta_edit'],
            'beneficiario' => $data['beneficiario_edit'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_datosb($data, $id_datosb);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_datosb() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_datosb($data);
        echo json_encode($data);
    }

    //////////////
    //CRUD DE MODALIDAD
    public function modalidad() {
        $data['modalidad'] = $this->Publicaciones_model->consultar_m();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/modalidad.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_modalidad() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'decr_modalidad' => $this->input->POST('decr_modalidad'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_modalidad($data);
        echo json_encode($data);
    }

    //LLENAR MODAL PARA EDITAR
    public function consulta_mod() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_mod($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_m() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->editar_m($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_m() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_m($data);
        echo json_encode($data);
    }

    ///////////////
    //CRUD DE MECANISMO
    public function mecanismo() {
        $data['modalidad'] = $this->Publicaciones_model->consultar_m();
        $data['mecanismos'] = $this->Publicaciones_model->consultar_mec();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/mecanismo.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'id_modalidad' => $this->input->POST('id_modalidad'),
            'decr_mecanismo' => $this->input->POST('decr_mecanismo'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_mec($data);
        echo json_encode($data);
    }

    //CONSULTAR DATOS
    public function consulta_modalidades() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_modalidades($data);
        echo json_encode($data);
    }

    public function consulta_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_mec($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_mecanismo' => $data['id_mecanismo'],
            'id_modalidad' => $data['id_modalidad'],
            'decr_mecanismo' => $data['decr_mecanismo'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_mec($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_mec($data);
        echo json_encode($data);
    }

    /////////////////////
    //CRUD DE ACTIVIDAD
    public function actividad() {
        $data['modalidad'] = $this->Publicaciones_model->consultar_m();
        $data['obj_contrat'] = $this->Publicaciones_model->consulta_obj_cont();

        $data['actividades'] = $this->Publicaciones_model->consulta_actividades();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/actividad.php', $data);
        $this->load->view('templates/footer.php');
    }

    //BUSCAR DATOS
    public function buscar_mec() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->buscar_mec($data);
        echo json_encode($data);
    }

    //GUARDAR
    public function registrar_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'id_modalidad' => $this->input->POST('id_modalidad'),
            'id_mecanismo' => $this->input->POST('id_mecanismo'),
            'id_obj_cont' => $this->input->POST('id_obj_cont'),
            'dias' => $this->input->POST('dias'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_act($data);
        echo json_encode($data);
    }

    //CONSULTAS
    public function consulta_mecanismos() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_mecanismos($data);
        echo json_encode($data);
    }

    public function consulta_objconta() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_objconta($data);
        echo json_encode($data);
    }

    public function consulta_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_act($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_actividad' => $data['id_actividad'],
            'id_modalidad' => $data['id_modalidad'],
            'id_mecanismo' => $data['id_mecanismo'],
            'id_obj_cont' => $data['id_obj_cont'],
            'dias' => $data['dias'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_act($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_act($data);
        echo json_encode($data);
    }

    ///////////////////////////////////
    //CRUD FERIADOS NACIONALES
    public function feriados() {
        $data['dias'] = $this->Publicaciones_model->consultar_d();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/feriados.php', $data);
        $this->load->view('templates/footer.php');
    }

    //GUARDAR
    public function registrar_fer() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'dia' => $this->input->POST('dia'),
            'descripcion' => $this->input->POST('descripcion'),
            'id_usuario' => $this->session->userdata('id_user')
        );
        $data = $this->Publicaciones_model->registrar_fer($data);
        echo json_encode($data);
    }

    //LLENAR MODAL PARA EDITAR
    public function consulta_d() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_d($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_d() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_feriado_n' => $data['id_feriado'],
            'dia' => $data['dia'],
            'descripcion' => $data['descripcion'],
            'id_usuario' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_d($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_d() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->eliminar_d($data);
        echo json_encode($data);
    }

    //REGISTRO DE LLAMADO A CONCURSO
    public function registro_p() {
        $data['obj_contrat'] = $this->Publicaciones_model->consulta_obj_cont();
        $data['modalidades'] = $this->Publicaciones_model->consultar_m();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('publicaciones/registro_p.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function buscar_act() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->buscar_act($data);
        echo json_encode($data);
    }

    public function buscar_act_e() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->buscar_act_e($data);
        echo json_encode($data);
    }

}

?>