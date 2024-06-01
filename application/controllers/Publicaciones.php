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
    public function acciones(){
		if(!$this->session->userdata('session'))redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $rif = $this->session->userdata['rif_organoente'];
        $data['time']=date("Y-m-d");
        $data['llamados'] = $this->Publicaciones_model->consulta_llamadosfinal($rif);
        $data['causa_suspencion'] = $this->Publicaciones_model->causa_suspencion();
        $data['supuestos'] = $this->Publicaciones_model->supuestos();
        $data['terminar_manual'] = $this->Publicaciones_model->terminar_manual();
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('anularllamado/acciones.php', $data);
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
            'fecha_cam_estatus' => date("Y-m-d"),
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
public function suspension(){
    if(!$this->session->userdata('session'))
    redirect('login');
    $data['descripcion'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $parametros = $this->input->get('id');
    $data['numero_proceso']=$this->input->get('id');
    $data['causa_prorroga'] = $this->Publicaciones_model->causa_prorroga();
    $data['time']=date("Y-m-d");
    $data['causa_suspencion'] = $this->Publicaciones_model->causa_suspencion();
    $data['supuestos'] = $this->Publicaciones_model->supuestos();
    $data['inf_1'] = $this->Publicaciones_model->inf_1($data['numero_proceso']);
    
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
      $this->load->view('publicaciones/suspension/suspension.php', $data);
    
    $this->load->view('templates/footer.php');
}

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
            'fecha_cam_estatus' => date("Y-m-d"),
            
        );
        $data = $this->Publicaciones_model->guardar_reinicio($data);
        echo json_encode($data);
    }
    ///////////////////////////////terminacion manual///////////////////////
    public function terminado(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $parametros = $this->input->get('id');
        $data['numero_proceso']=$this->input->get('id');
        $data['causa_prorroga'] = $this->Publicaciones_model->causa_prorroga();
        $data['time']=date("Y-m-d");
        $data['causa_suspencion'] = $this->Publicaciones_model->causa_suspencion();
        $data['supuestos'] = $this->Publicaciones_model->supuestos();
        $data['inf_1'] = $this->Publicaciones_model->inf_1($data['numero_proceso']);
        $data['terminar_manual'] = $this->Publicaciones_model->terminar_manual();
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
          $this->load->view('publicaciones/terminado/terminado.php', $data);
        
        $this->load->view('templates/footer.php');
    }
   
   
    public function guardar_terminados() {
        if (!$this->session->userdata('session'))
            redirect('login');
            $estatus = '0';
        $data = array(
            'numero_proceso' => $this->input->POST('numero_proceso'),
            'fecha_cam_estatus' =>date("Y-m-d"),
            'especifique_anulacion' => $this->input->POST('especifique_anulacion'),
            'articulo' => $this->input->POST('causa_termino'),
            "estatus"     => $this->input->POST('estatus'),

            
        );
        $data = $this->Publicaciones_model->guar_termino($data);
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
///////////////////////////////Reportes estatus llc
public function rp_estatus(){
    if(!$this->session->userdata('session'))redirect('login');
    $data['final']  = $this->User_model->consulta_organoente();
    $rif = $this->session->userdata['rif_organoente'];
    $hasta     = $this->input->post("hasta");
    $desde     = $this->input->post("desde");
    $data['desde'] = date('Y-m-d', strtotime($desde));
    $data['hasta'] = date('Y-m-d', strtotime($hasta)); 
    $rif = $this->session->userdata['rif_organoente'];
    $data['historial'] = $this->Publicaciones_model->consultar_historico_llamados_externos2($data,$rif);
//	$this->form_validation->set_rules('t_pago', 't_pago', 'required|callback_select_validate');
    $this->form_validation->set_rules('hasta', 'Fecha hasta', 'required|min_length[1]');
    $this->form_validation->set_rules('desde', 'Fecha Desde ', 'required|min_length[1]');
    
    if ($this->form_validation->run() == FALSE) {

            $data['descripcion'] = $this->session->userdata('unidad');
            $data['rif'] = $this->session->userdata['rif_organoente'];
            $data['final']  = $this->User_model->consulta_organoente();  
            $data['historial'] = $this->Publicaciones_model->consultar_historico_llamados_externos2($data,$rif);
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('publicaciones/reporte_estatusllamado/estatus_llamado.php', $data,$rif);
            
            $this->load->view('templates/footer.php');
        } else {
           
            $date=date("d-m-Y");
           
            $data['descripcion'] = $this->session->userdata('unidad');
           
            $data['id_unidad']     = $this->input->post("id_unidad");
    
            $data['desde'] = date('Y-m-d', strtotime($desde));
            $data['hasta'] = date('Y-m-d', strtotime($hasta)); 
            $data['historial'] = $this->Publicaciones_model->consultar_historico_llamados_externos($data);
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('publicaciones/reporte_estatusllamado/resul_rep_estatus.php', $data);
            $this->load->view('templates/footer.php');
    }

}
        public function consulta_estatu() {
            if (!$this->session->userdata('session'))
            redirect('login');
            $data = $this->input->post();
            $data = $this->Publicaciones_model->consulta_llamado_statu($data);
            echo json_encode($data);
            

        }
        public function filtro(){
            if (!$this->session->userdata('session')) {
                        $date=date("d-m-Y");
                        $id_estado = $this->input->post("id_estado");
                        $id_objeto = $this->input->post("id_objeto");
                        $data['historial'] = $this->Publicaciones_model->consultar_llamados_externos12($id_objeto,$date,$id_estado);
                        $this->load->view('templates/header.php');
                        $this->load->view('templates/navsinsesion.php');
                        $this->load->view('publicaciones/reporte/ver_llamado.php', $data);                        
                        $this->load->view('templates/footer.php');
            }
         else {
                    $date=date("d-m-Y");           
                    $id_estado= $this->input->post("id_estado");
                    $id_objeto = $this->input->post("id_objeto");
                    $data['historial'] = $this->Publicaciones_model->consultar_llamados_externos12($id_objeto,$date,$id_estado);
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/navsinsesion.php');
                    $this->load->view('publicaciones/reporte/ver_llamado.php', $data);                    
                    $this->load->view('templates/footer.php');
        }  }
        
     
        

///////////////////////////consulta interna
public function llamadointerno() {
    if(!$this->session->userdata('session'))redirect('login');
      $date=date("d-m-Y");
      $rif = $this->session->userdata['rif_organoente'];
      $data['exonerado'] = $this->Publicaciones_model->consultar_llamados_internos($date,$rif);
      $data['estados'] 	 = $this->Configuracion_model->consulta_estados();
      $data['objeto'] 	 = $this->Configuracion_model->objeto();
      $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
      $generar3 = $this->Publicaciones_model->generar2(); // finalizar llamad
      $generar4 = $this->Publicaciones_model->generar3(); // finalizar llamad

      $this->load->view('templates/header.php');
      $this->load->view('templates/navigator.php');
      $this->load->view('publicaciones/reporte/llamadointerno.php', $data);
      $this->load->view('templates/footer.php');
   

  }

  public function Llamado() //hacer un pdf
  {
    //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
       //Se agrega la clase desde thirdparty para usar FPDF
       require_once APPPATH.'third_party/fpdf/fpdf.php';
     //  $unidad
       
       $pdf = new FPDF();
       $pdf->AliasNbPages();
       $pdf->AddPage('P','A4',0);
       $pdf->SetMargins(8,8,8,8);
       $pdf->SetFont('Arial','B',12);
       //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
       $pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);
       $pdf->Ln(10);
       
       $pdf->Cell(195,5,'LLamado a Concurso',0,1,'C');
       
       $pdf->Image(base_url().'imagenes/logosnc.png',140,6,50);
       $pdf->SetFont('Arial','I',8);

       $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
       $pdf->SetFont('Arial','B',12);

       $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
       $pdf->Cell(195,10,'Datos del Organo o Ente',0,1,'C');

          $data1 = $this->input->get('id');
          $data = $this->Publicaciones_model->consulta_llamado($data1);
          foreach($data as $d){
              
              $pdf->Cell(60,10,'Rif:',0,0,'C'); 
              $pdf->Cell(100,10,'Denominacion social:',0,1,'C');                  
              $pdf->SetFont('Arial','',10);
              $pdf->Cell(60,10, $d->rif_organoente,0,0,'C');
              $pdf->Cell(100,10, utf8_decode($d->organoente),0,1,'C');
              
              $pdf->SetFont('Arial','B',12);
              $pdf->Cell(60,10,'Siglas:',0,0,'C'); 
              $pdf->Cell(100,10,'Pagina Web',0,1,'C'); 
              $pdf->SetFont('Arial','',10);
              $pdf->Cell(60,10, $d->siglas,0,0,'C');
             // $pdf->Cell(85,10,'Pagina Web:',0,0,'C'); 
             // $pdf->SetFont('Arial','',8);                  
                 $pdf->MultiCell(100,5, utf8_decode($d->web_contratante), 0, 'L');
             // $pdf->Cell(100,10, $d->web_contratante,0,1,'C');
              $pdf->Cell(195,10,'____________________________________________________________________________________________________',0,1,'C');
           $pdf->SetFont('Arial','B',12);
           $pdf->Cell(195,10,'Llamados a Concurso',0,1,'C');               
              $pdf->Cell(80,10,'Numero de Proceso:',0,0,'C'); 
           $pdf->SetFont('Arial','B',10);
              $pdf->Cell(48,10, $d->numero_proceso,0,1,'C');
           $pdf->SetFont('Arial','B',12);
              $pdf->Cell(85,10,'Denominacion del proceso:',0,0,'C'); 
           $pdf->SetFont('Arial','',8);                  
              $pdf->MultiCell(100,5, utf8_decode($d->denominacion_proceso), 0, 'L');
              $pdf->SetFont('Arial','B',12);
             
              $pdf->Cell(80,10,'Fecha de Llamado:',0,0,'C');
              $pdf->Cell(60,10,'Estatus:',0,1,'C'); 

          $pdf->SetFont('Arial','',10);
                 $pdf->Cell(80,10, date("d/m/Y", strtotime($d->fecha_llamado)),0,0,'C');
                 $pdf->Cell(60,10, $d->estatus,0,1,'C');
          $pdf->SetFont('Arial','B',12);
                 $pdf->Cell(90,10,utf8_decode('Descripcion de Contratación:'),0,1,'C'); 
           $pdf->SetFont('Arial','',8);                  
                 $pdf->MultiCell(180,5, utf8_decode($d->descripcion_contratacion), 0);
          $pdf->SetFont('Arial','B',12);
          $pdf->Cell(195,10,'_______________________________________________________________________________________',0,1,'C');
                 $pdf->Cell(195,5,'Lapsos',0,1,'C'); 
                 $pdf->SetFont('Arial','B',12);
             
              $pdf->Cell(60,5,'Modalidad:',0,0,'C');
              $pdf->Cell(60,5,'Mecanismo:',0,0,'C');
              $pdf->Cell(60,5,utf8_decode('Objeto de Contratación:'),0,1,'C'); 


          $pdf->SetFont('Arial','',10);
                 $pdf->Cell(60,10, utf8_decode($d->modalidad),0,0,'C');
                 $pdf->Cell(60,10, utf8_decode($d->mecanismo),0,0,'C');   
                 $pdf->Cell(60,10, $d->objeto_contratacion,0,1,'C');        
          
          $pdf->SetFont('Arial','B',12);
             
                //  $pdf->Cell(100,10,' ',0,0,'C');
                 $pdf->Cell(180,10,utf8_decode('Acto Público:'),0,1,'C');   

          $pdf->SetFont('Arial','',10);
                    // $pdf->Cell(100,5, date("d/m/Y", strtotime($d->fecha_disponible_llamado)),0,0,'C');
                    $pdf->Cell(180,5, date("d/m/Y", strtotime($d->fecha_fin_llamado)),0,1,'C');   
          $pdf->SetFont('Arial','B',12);
                  $pdf->Cell(195,10,'_______________________________________________________________________________________',0,1,'C');
                  $pdf->SetFont('Arial','B',12);
             
                  $pdf->Cell(180,5,'Fecha de disponibilidad:',0,1,'C');
                  $pdf->SetFont('Arial','',10);
                  $pdf->Cell(80,5,'Desde:',0,0,'C');
                  $pdf->Cell(5,5, date("d/m/Y", strtotime($d->fecha_disponible_llamado)),0,0,'C');
                  $pdf->Cell(50,5,'Hasta:',0,0,'C');
                  $pdf->Cell(10,5, date("d/m/Y", strtotime($d->fecha_tope)),0,1,'C'); 
                  $pdf->SetFont('Arial','B',12);
                  $pdf->Cell(195,5,utf8_decode('Dirección Para Adquisición de Retiro de Pliego'),0,1,'C'); 
          $pdf->SetFont('Arial','B',12);
                  $pdf->Cell(100,5,'Hora desde:',0,0,'C');
                  $pdf->Cell(60,5,'Hora hasta:',0,1,'C');   
           $pdf->SetFont('Arial','',10);
                     $pdf->Cell(100,5, $d->hora_desde,0,0,'C');
                     $pdf->Cell(60,5, $d->hora_hasta,0,1,'C');
          $pdf->SetFont('Arial','B',12);
                     $pdf->Cell(60,5,utf8_decode('Dirección:'),0,0,'C'); 
          $pdf->SetFont('Arial','',8);        
                     $pdf->MultiCell(130,5, utf8_decode($d->direccion), 0, 'L');
          $pdf->SetFont('Arial','B',12);
          $pdf->Cell(195,10,'_______________________________________________________________________________________',0,1,'C');
                      $pdf->Cell(195,10,utf8_decode('Períodos de Aclaratoria'),0,1,'C'); 
          $pdf->SetFont('Arial','B',12);
                         $pdf->Cell(80,5,'Fecha Inicio de Aclaratoria:',0,0,'C');
                         $pdf->Cell(40,5,'Fecha Fin de Aclaratoria:',0,0,'C');
                         $pdf->Cell(55,5,'Fecha Tope:',0,1,'C'); 
          $pdf->SetFont('Arial','',10);
                        $pdf->Cell(60,5, date("d/m/Y", strtotime($d->fecha_inicio_aclaratoria)),0,0,'C');
                        $pdf->Cell(60,5, date("d/m/Y", strtotime($d->fecha_fin_aclaratoria)),0,0,'C');   
                        $pdf->Cell(60,5, date("d/m/Y", strtotime($d->fecha_tope)),0,1,'C');        
          $pdf->SetFont('Arial','B',12);
                      $pdf->Cell(195,5,'_______________________________________________________________________________________',0,1,'C');
                      $pdf->Cell(195,10,utf8_decode('Apertura de Sobres'),0,1,'C'); 
          $pdf->SetFont('Arial','B',12);
                            $pdf->Cell(100,5,'Fecha de Entrega:',0,0,'C');
                            $pdf->Cell(60,5,'Hora Desde:',0,1,'C');   
          $pdf->SetFont('Arial','',10);
                               $pdf->Cell(100,8, date("d/m/Y", strtotime($d->fecha_fin_llamado)),0,0,'C');
                               $pdf->Cell(60,8, $d->hora_desde_sobre,0,1,'C');
          $pdf->SetFont('Arial','B',12);
                               $pdf->Cell(60,5,'Lugar de Entrega:',0,0,'C'); 
          $pdf->SetFont('Arial','',10);        
                               $pdf->MultiCell(130,5, utf8_decode($d->lugar_entrega), 0, 'L');
          $pdf->SetFont('Arial','B',12);
                               $pdf->Cell(60,5,utf8_decode('Dirección:'),0,0,'C'); 
          $pdf->SetFont('Arial','',10);        
                               $pdf->MultiCell(130,5, utf8_decode($d->direccion_sobre), 0, 'L');
                               $pdf->SetFont('Arial','B',12);
                               $pdf->Cell(60,5,utf8_decode('Observaciones:'),0,0,'C'); 
          $pdf->SetFont('Arial','',10);        
                               $pdf->MultiCell(130,5, utf8_decode($d->observaciones), 0, 'L');

                              
          $pdf->Ln(10);
         $curdate = date('d-m-Y H:i:s');
                               $pdf->SetFont('Arial','B',12);
                               $pdf->Cell(60,10,utf8_decode('Fecha de Impresión:'),0,0,'C'); 
                               $pdf->Cell(30,10, $curdate,0,1,'C');
                               $pdf->SetX(-15);
                              // Arial italic 8
                              $pdf->SetFont('Arial','I',8);
                              // Número de página
                              $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
          }
         // $pdf->Ln(10);
        
          // $curdate = date('d-m-Y H:i:s');
          // $pdf->SetFont('Arial','B',12);
          // $pdf->Cell(60,10,utf8_decode('Fecha de Impresión:'),0,0,'C'); 
          // $pdf->Cell(30,10, $curdate,0,1,'C');
     //  $pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
// Posición: a 1,5 cm del final
          // $pdf->SetX(-15);
          // // Arial italic 8
          // $pdf->SetFont('Arial','I',8);
          // // Número de página
          // $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
         // $pdf->SetX(10);
          ///$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');
 // $this->SetFont('Arial','I',8); 
  //$pdf->Cell(0,10,'Servicio Nacional de Contrataciones','T',1,'C');
  //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');
          $pdf->Output('llamado_concurso '.$curdate.'.pdf', 'D');
         // $this->load->view('headfoot/header', $datos);
  }
  public function Llamado_1() //hacer un pdf externo
  {
    //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
       //Se agrega la clase desde thirdparty para usar FPDF
       require_once APPPATH.'third_party/fpdf/fpdf.php';
     //  $unidad
       
       $pdf = new FPDF();
       $pdf->AliasNbPages();
       $pdf->AddPage('P','A4',0);
       $pdf->SetMargins(8,8,8,8);
       $pdf->SetFont('Arial','B',12);
       //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
       $pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);
       $pdf->Ln(10);
       
       $pdf->Cell(195,5,'LLamado a Concurso',0,1,'C');
       
       $pdf->Image(base_url().'imagenes/logosnc.png',140,6,50);
       $pdf->SetFont('Arial','I',8);

       $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
       $pdf->SetFont('Arial','B',12);

       $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
       $pdf->Cell(195,10,'Datos del Organo o Ente',0,1,'C');

          $data1 = $this->input->get('id');
          $data = $this->Publicaciones_model->consulta_llamado($data1);
          foreach($data as $d){
              
              $pdf->Cell(60,10,'Rif:',0,0,'C'); 
              $pdf->Cell(100,10,'Denominacion social:',0,1,'C');                  
              $pdf->SetFont('Arial','',10);
              $pdf->Cell(60,10, $d->rif_organoente,0,0,'C');
              $pdf->Cell(100,10, utf8_decode($d->organoente),0,1,'C');
              
              $pdf->SetFont('Arial','B',12);
              $pdf->Cell(60,10,'Siglas:',0,0,'C'); 
             
              $pdf->SetFont('Arial','',10);
              $pdf->Cell(60,10, $d->siglas,0,0,'C');
            
              $pdf->Cell(85,10,'Pagina Web:',0,0,'C'); 
              $pdf->SetFont('Arial','',8);                  
                 $pdf->MultiCell(100,5, utf8_decode($d->web_contratante), 0, 'L');
                 $pdf->SetFont('Arial','B',12);
              $pdf->Cell(195,10,'____________________________________________________________________________________________________',0,1,'C');
           $pdf->SetFont('Arial','B',12);
           $pdf->Cell(195,10,'Llamados a Concurso',0,1,'C');               
              $pdf->Cell(80,10,'Numero de Proceso:',0,0,'C'); 
           $pdf->SetFont('Arial','B',10);
              $pdf->Cell(48,10, $d->numero_proceso,0,1,'C');
           $pdf->SetFont('Arial','B',12);
              $pdf->Cell(85,10,'Denominacion del proceso:',0,0,'C'); 
           $pdf->SetFont('Arial','',8);                  
              $pdf->MultiCell(100,5, utf8_decode($d->denominacion_proceso), 0, 'L');
              $pdf->SetFont('Arial','B',12);
             
              $pdf->Cell(80,10,'Fecha de Llamado:',0,0,'C');
              $pdf->Cell(60,10,'Estatus:',0,1,'C'); 

          $pdf->SetFont('Arial','',10);
                 $pdf->Cell(80,10, date("d/m/Y", strtotime($d->fecha_llamado)),0,0,'C');
                 $pdf->Cell(60,10, $d->estatus,0,1,'C');
          $pdf->SetFont('Arial','B',12);
                 $pdf->Cell(90,10,utf8_decode('Descripcion de Contratación:'),0,1,'C'); 
           $pdf->SetFont('Arial','',8);                  
                 $pdf->MultiCell(180,5, utf8_decode($d->descripcion_contratacion), 0);
          $pdf->SetFont('Arial','B',12);
          $pdf->Cell(195,10,'_______________________________________________________________________________________',0,1,'C');
                 $pdf->Cell(195,5,'Lapsos',0,1,'C'); 
                 $pdf->SetFont('Arial','B',12);
             
              $pdf->Cell(60,5,'Modalidad:',0,0,'C');
              $pdf->Cell(60,5,'Mecanismo:',0,0,'C');
              $pdf->Cell(60,5,utf8_decode('Objeto de Contratación:'),0,1,'C'); 


          $pdf->SetFont('Arial','',10);
                 $pdf->Cell(60,10, utf8_decode($d->modalidad),0,0,'C');
                 $pdf->Cell(60,10, utf8_decode($d->mecanismo),0,0,'C');   
                 $pdf->Cell(60,10, $d->objeto_contratacion,0,1,'C');        
          
          $pdf->SetFont('Arial','B',12);
             
                 $pdf->Cell(100,10,'Fecha de disponibilidad:',0,0,'C');
                 $pdf->Cell(60,10,'Fecha Fin:',0,1,'C');   

          $pdf->SetFont('Arial','',10);
                    $pdf->Cell(100,5, date("d/m/Y", strtotime($d->fecha_disponible_llamado)),0,0,'C');
                    $pdf->Cell(60,5, date("d/m/Y", strtotime($d->fecha_fin_llamado)),0,1,'C');   
          $pdf->SetFont('Arial','B',12);
                  $pdf->Cell(195,10,'_______________________________________________________________________________________',0,1,'C');
                  $pdf->Cell(195,10,utf8_decode('Dirección Para Adquisición de Retiro de Pliego'),0,1,'C'); 
          $pdf->SetFont('Arial','B',12);
                  $pdf->Cell(100,5,'Hora desde:',0,0,'C');
                  $pdf->Cell(60,5,'Hora hasta:',0,1,'C');   
           $pdf->SetFont('Arial','',10);
                     $pdf->Cell(100,5, $d->hora_desde,0,0,'C');
                     $pdf->Cell(60,5, $d->hora_hasta,0,1,'C');
          $pdf->SetFont('Arial','B',12);
                     $pdf->Cell(60,5,utf8_decode('Dirección:'),0,0,'C'); 
          $pdf->SetFont('Arial','',8);        
                     $pdf->MultiCell(130,5, utf8_decode($d->direccion), 0, 'L');
          $pdf->SetFont('Arial','B',12);
          $pdf->Cell(195,10,'_______________________________________________________________________________________',0,1,'C');
                      $pdf->Cell(195,10,utf8_decode('Períodos de Aclaratoria'),0,1,'C'); 
          $pdf->SetFont('Arial','B',12);
                         $pdf->Cell(80,5,'Fecha Inicio de Aclaratoria:',0,0,'C');
                         $pdf->Cell(40,5,'Fecha Fin de Aclaratoria:',0,0,'C');
                         $pdf->Cell(55,5,'Fecha Tope:',0,1,'C'); 
          $pdf->SetFont('Arial','',10);
                        $pdf->Cell(60,5, date("d/m/Y", strtotime($d->fecha_inicio_aclaratoria)),0,0,'C');
                        $pdf->Cell(60,5, date("d/m/Y", strtotime($d->fecha_fin_aclaratoria)),0,0,'C');   
                        $pdf->Cell(60,5, date("d/m/Y", strtotime($d->fecha_tope)),0,1,'C');        
          $pdf->SetFont('Arial','B',12);
                      $pdf->Cell(195,5,'_______________________________________________________________________________________',0,1,'C');
                      $pdf->Cell(195,10,utf8_decode('Apertura de Sobres'),0,1,'C'); 
          $pdf->SetFont('Arial','B',12);
                            $pdf->Cell(100,5,'Fecha de Entrega:',0,0,'C');
                            $pdf->Cell(60,5,'Hora Desde:',0,1,'C');   
          $pdf->SetFont('Arial','',10);
                               $pdf->Cell(100,8, date("d/m/Y", strtotime($d->fecha_fin_llamado)),0,0,'C');
                               $pdf->Cell(60,8, $d->hora_desde_sobre,0,1,'C');
          $pdf->SetFont('Arial','B',12);
                               $pdf->Cell(60,5,'Lugar de Entrega:',0,0,'C'); 
          $pdf->SetFont('Arial','',10);        
                               $pdf->MultiCell(130,5, utf8_decode($d->lugar_entrega), 0, 'L');
          $pdf->SetFont('Arial','B',12);
                               $pdf->Cell(60,5,utf8_decode('Dirección:'),0,0,'C'); 
          $pdf->SetFont('Arial','',10);        
                               $pdf->MultiCell(130,5, utf8_decode($d->direccion_sobre), 0, 'L');
                               $pdf->SetFont('Arial','B',12);
                               $pdf->Cell(60,5,utf8_decode('Observaciones:'),0,0,'C'); 
          $pdf->SetFont('Arial','',10);        
                               $pdf->MultiCell(130,5, utf8_decode($d->observaciones), 0, 'L');

                              
          $pdf->Ln(10);
         $curdate = date('d-m-Y H:i:s');
                               $pdf->SetFont('Arial','B',12);
                               $pdf->Cell(60,10,utf8_decode('Fecha de Impresión:'),0,0,'C'); 
                               $pdf->Cell(30,10, $curdate,0,1,'C');
                               $pdf->SetX(-15);
                              // Arial italic 8
                              $pdf->SetFont('Arial','I',8);
                              // Número de página
                              $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
          }
         // $pdf->Ln(10);
        
          // $curdate = date('d-m-Y H:i:s');
          // $pdf->SetFont('Arial','B',12);
          // $pdf->Cell(60,10,utf8_decode('Fecha de Impresión:'),0,0,'C'); 
          // $pdf->Cell(30,10, $curdate,0,1,'C');
     //  $pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
// Posición: a 1,5 cm del final
          // $pdf->SetX(-15);
          // // Arial italic 8
          // $pdf->SetFont('Arial','I',8);
          // // Número de página
          // $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
         // $pdf->SetX(10);
          ///$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');
 // $this->SetFont('Arial','I',8); 
  //$pdf->Cell(0,10,'Servicio Nacional de Contrataciones','T',1,'C');
  //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');
          $pdf->Output('llamado_concurso '.$curdate.'.pdf', 'D');
         // $this->load->view('headfoot/header', $datos);
  }


    public function v_estatus_llamado(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $parametros = $this->input->get('id');
        $data['id']=$this->input->get('id');
         
        $data['time']=date("Y-m-d");
        $data['inf_2'] = $this->Publicaciones_model->consulta_llamado_statu_detalle($parametros);
  
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
          $this->load->view('publicaciones/reporte_estatusllamado/est_llamado.php', $data);
        
        $this->load->view('templates/footer.php');
    }
    public function Accion2(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $rif_organoente = $this->session->userdata('rif_organoente');

        $data['rif'] = $this->session->userdata('rif');
        $parametros = $this->input->get('id');
        $data['numero_proceso']=$this->input->get('id');
        $data['llamadot'] = $this->Publicaciones_model->check_logger_accion($rif_organoente,$data['numero_proceso']);

        $data['time']=date("Y-m-d");

        $data['inf_1'] = $this->Publicaciones_model->inf_1($data['numero_proceso']);
        $data['results_2']      =  $this->Publicaciones_model->consultar_cxc_client3($data['numero_proceso']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
          $this->load->view('publicaciones/acciones/acciones2.php', $data);
        
        $this->load->view('templates/footer.php');
    }
    public function acciones3() {
        if (!$this->session->userdata('session'))
            redirect('login');
            $rif_organoente = $this->session->userdata('rif_organoente');
        $data = array(       
            'rif_organoente' => $rif_organoente,

            'numero_proceso' => $this->input->POST('numero_proceso'),
            'id_accion_cargar' => $this->input->POST('acc_cargar'),
            'id_articulo_113' => $this->input->POST('selec_acc'),
            'observacion_desierto' => $this->input->POST('observacion'),
            'adjudicado' => $this->input->POST('total'),

            'facto' => $this->input->POST('rif_b'),
            'sel_rif_nombre' => $this->input->POST('sel_rif_nombre5'),
            'nombre_contratista' => $this->input->POST('nombre_conta_5'),
            'rif_contr_no_rnc' => $this->input->POST('rif_55'),

            'razon_social_no_rnc' => $this->input->POST('razon_social'),
            'id_objeto_c' => $this->input->POST('selec_obj'),
            'num_contrato' => $this->input->POST('num_con'),
            'monto_contrato' => $this->input->POST('total_rendi5'),
            'paridad' => $this->input->POST('paridad_rendi5'),
            'total_contrato' => $this->input->POST('subtotal_rendi5'),
            'fecha_paridad' => $this->input->POST('fecha_paridad'),
         
            'id_usuario' => $this->session->userdata('id_user'),
            'fecha_creacion' => date("Y-m-d"), 
            'snc' => 1, 
            'exit_rnc' => 0

        );
        //print_r($data);die;
        $data = $this->Publicaciones_model->saveacciones3($data);
        echo json_encode($data);
    }
    public function consulta_accll() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Publicaciones_model->consulta_accll($data);
        echo json_encode($data);
    }
    public function editar_accll() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_accion' => $data['id_banco'],
            'num_contrato' => $data['nombre_b'],
            //'id_usuaio' => $this->session->userdata('id_user')
        );

        $data = $this->Publicaciones_model->editar_accll($data);
        echo json_encode($data);
    }
    public function enviar_notificar_llc()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data = $this->input->post();
        
        $des_unidad = $this->session->userdata('unidad');
        $codigo_onapre = $this->session->userdata('codigo_onapre');
        $rif = $this->session->userdata('rif_organoente');
        $numero_proceso = $data['id'];
         
        
        $data = $this->Publicaciones_model->updateAccionesLlamadosAndNotifyLlc($data, $des_unidad);
        print_r($data);die;
        //echo json_encode($data);
    }
}

    
?>