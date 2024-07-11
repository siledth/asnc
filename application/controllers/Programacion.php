<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programacion extends CI_Controller {

    //----Carga todos los años ya registrados y para registrar----
    public function index(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
        $unidad = $this->session->userdata('id_unidad');

        $data['ver_programaciones'] = $this->Programacion_model->consultar_programaciones($unidad);
        $data['fecha'] = date('yy');

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/ver_programaciones.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function validadanio(){ //validar existencia js
        $des_unidad= $this->session->userdata('id_unidad');

        $anio = $this->input->post('anio');
        $data= $this->Programacion_model->valida_anio($anio, $des_unidad);
       //$data = $this->input->post();
      echo json_encode($data);
       
    }
    //----Agregar año de programacion----
    public function agg_programacion_anio(){
        if(!$this->session->userdata('session'))redirect('login');

        $data = array(
            'unidad'        => $this->session->userdata('id_unidad'),
            'anio'          => $this->input->POST('anio'),
            'id_usuario' 	=> $this->session->userdata('id_user'),
            'estatus' 	    => 0,
        );

        $data = $this->Programacion_model->agg_programacion_anio($data);
        echo json_encode($data);
    }

    //Consulta los proyectos y acc por año
    public function nueva_prog(){
        if(!$this->session->userdata('session'))redirect('login');
        //Información traido por el session de usuario para mostrar inf
        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
        $unidad = $this->session->userdata('id_unidad');
        $data['id_programacion'] = $this->input->get('id');

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
        $data['anio'] = $data['programacion_anio']['anio'];

        //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
        $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos($data['id_programacion']);
        $data['ver_acc_centralizada'] = $this->Programacion_model->consultar_acc_centralizada($data['id_programacion']);
        $data['totalespartida'] = $this->Programacion_model->total_por_partidas($data['id_programacion']);


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/nueva_prog.php', $data);
        $this->load->view('templates/footer.php');
    }
   
//////////////nuevo guardado de proyecto o accion centralizada
public function nuevo_registro_acc_py() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $acc = array(
        'id_programacion' => $this->input->POST('id_programacion1'),
        'acc_cargar' => $this->input->POST('acc_cargar'),
        'id_p_acc_centralizada' => $this->input->POST('selec_acc'),
        'id_obj_comercial' => $this->input->POST('selec_obj'),
       
    );
    $proy = array(
        'id_programacion' => $this->input->POST('id_programacion1'),
        'acc_cargar' => $this->input->POST('acc_cargar'),
        'nombre_proyecto' => $this->input->POST('nombre_proyecto'),
        'id_obj_comercial' => $this->input->POST('selec_obj'), 
    );
   

    $data = $this->Programacion_model->nuevo_registro_acc_py($acc,$proy);
    echo json_encode($data);
}



    // Anterior
    public function add(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];


        //Proyecto
        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
        $data['fuente'] = $this->Programacion_model->consulta_fuente();
        $data['act_com'] = $this->Programacion_model->consulta_act_com();
        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
        $data['unid'] 	= $this->Programacion_model->consulta_unid();
        $data['iva'] 	= $this->Programacion_model->consulta_iva();

        //ACCION CENTRALIZADA
        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/add.php', $data);
        $this->load->view('templates/footer.php');
    }

    //funcion para cargar la información completa de la programación (En desarrollo)
    public function pdf_compl(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        $data['proyectos'] = $this->Programacion_model->consultar_proyectos_compl($data['id_programacion'], $data['unidad']);

        $data['pp_ff'] = $this->Programacion_model->llenar_ff($data['proyectos']);
        //print_r($data['pp_ff']);die;
        // $count_prog = count($data['proyectos']);

        // for ($i=0; $i < $count_prog; $i++) {
            // foreach ($data['proyectos'] as $key => $value) {
            //     for ($i=0; $i < $count_prog; $i++) {
            //         $id_p_proyecto = $value['id_p_proyecto'];
            //         $data['pp_ff'] = $this->Programacion_model->llenar_ff($id_p_proyecto);
            //     }
            //
            // }

        // }


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/pdf_compl.php', $data);
        $this->load->view('templates/footer.php');
    }


    //Registrar Servicio
    public function agregar_servicio(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];


        //Proyecto
        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
        $data['fuente'] = $this->Programacion_model->consulta_fuente();
        $data['act_com'] = $this->Programacion_model->consulta_act_com();
        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
        $data['unid'] 	= $this->Programacion_model->consulta_unid();
        $data['iva'] 	= $this->Programacion_model->consulta_iva();

        //ACCION CENTRALIZADA
        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/servicio/agregar_servicio.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_servicio(){
        if(!$this->session->userdata('session'))redirect('login');

        $acc_cargar = $this->input->POST('acc_cargar');

        $p_proyecto = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto'),
            'id_obj_comercial'       => 2,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

        $p_acc_centralizada = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada'),
            'id_obj_comercial'       => 2,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
       );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
            'id_ccnu' 		         => $this->input->post('id_ccnu'),
            'id_tip_obra' 		     => 0,
            'id_alcance_obra' 		 => 0,
            'id_obj_obra' 		     => 0,
            'fecha_desde'   	     => $this->input->POST('fecha_desde'),
            'fecha_hasta'   	     => $this->input->POST('fecha_hasta'),
            'especificacion' 		 => $this->input->post('especificacion'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida'),
            'i' 		             => $this->input->post('i'),
            'ii' 		             => $this->input->post('ii'),
            'iii' 		             => $this->input->post('iii'),
            'iv' 		             => $this->input->post('iv'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
            'est_trim_1' 		 => $this->input->post('estimado_i'),
            'est_trim_2' 		 => $this->input->post('estimado_ii'),
            'est_trim_3' 		=> $this->input->post('estimado_iii'),
            'est_trim_4' 		 => $this->input->post('estimado_iV'), 
            'estimado_total_t_acc' => $this->input->post('estimado_total_t'),
            'estatus_rendi' => 0,//estatus inical de progrmacion
        );

        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento'),
            'descripcion_ff' 	                => $this->input->post('descripcion_ff'),
            'porcentaje' 	            => $this->input->post('porcentaje'),
        );

        $data = $this->Programacion_model->save_servicio($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento);
        echo json_encode($data);
    }

    // Registrar Bienes
    public function agregar_bien(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];


        //Proyecto
        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
        $data['fuente'] = $this->Programacion_model->consulta_fuente();
        $data['act_com'] = $this->Programacion_model->consulta_act_com();
        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
        $data['unid'] 	= $this->Programacion_model->consulta_unid();
        $data['iva'] 	= $this->Programacion_model->consulta_iva();

        //ACCION CENTRALIZADA
        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/bien/agregar_bien.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_bien(){
        if(!$this->session->userdata('session'))redirect('login');

        $acc_cargar = $this->input->POST('acc_cargar');

        $p_proyecto = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto'),
            'id_obj_comercial'       => 1,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

        $p_acc_centralizada = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada'),
            'id_obj_comercial'       => 1,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
       );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
            'id_ccnu' 		         => $this->input->post('id_ccnu'),
            'id_tip_obra' 		     => 0,
            'id_alcance_obra' 		 => 0,
            'id_obj_obra' 		     => 0,
            'fecha_desde'   	     => date('Y-m-d'),
            'fecha_hasta'   	     => date('Y-m-d'),
            'especificacion' 		 => $this->input->post('especificacion'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida'),
            'cantidad'               => $this->input->post('cantidad'),
            'i' 		             => $this->input->post('I'),
            'ii' 		             => $this->input->post('II'),
            'iii' 		             => $this->input->post('III'),
            'iv' 		             => $this->input->post('IV'),
            'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
            'costo_unitario' 	     => $this->input->post('costo_unitario'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
            'est_trim_1' 		 => $this->input->post('estimado_i'),
            'est_trim_2' 		 => $this->input->post('estimado_ii'),
            'est_trim_3' 		=> $this->input->post('estimado_iii'),
            'est_trim_4' 		 => $this->input->post('estimado_iV'), 
            'estimado_total_t_acc' => $this->input->post('estimado_total_t'),
            'estatus_rendi' => 0,//estatus inical de progrmacion
        );

        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento'),
            'descripcion_ff' 	                => $this->input->post('descripcion_ff'),
            'porcentaje' 	            => $this->input->post('porcentaje'),
        );

        $data = $this->Programacion_model->save_bienes($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento);
        echo json_encode($data);
    }

    //Registrar Obras
    public function agregar_obra(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['id_programacion'] = $this->input->get('id');
        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];


        //Proyecto
        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
        $data['fuente'] = $this->Programacion_model->consulta_fuente();
        $data['act_com'] = $this->Programacion_model->consulta_act_com();
        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
        $data['unid'] 	= $this->Programacion_model->consulta_unid();
        $data['iva'] 	= $this->Programacion_model->consulta_iva();

        $data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
        $data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
        $data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

        //ACCION CENTRALIZADA
        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/obra/agregar_obra.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function registrar_obra(){
        if(!$this->session->userdata('session'))redirect('login');

        $acc_cargar = $this->input->POST('acc_cargar');

        $p_proyecto = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto'),
            'id_obj_comercial'       => 3,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

        $p_acc_centralizada = array(
            'id_programacion'        => $this->input->POST('id_programacion'),
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada'),
            'id_obj_comercial'       => 3,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
       );

       $p_items = array(
           'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
           'id_ccnu' 		        => $this->input->post('id_ccnu'),
           'id_tip_obra' 		    => $this->input->post('id_tip_obra'),
           'id_alcance_obra' 		=> $this->input->post('id_alcance_obra'),
           'id_obj_obra' 		    => $this->input->post('id_obj_obra'),
           'fecha_desde'   	        => $this->input->POST('fecha_desde'),
           'fecha_hasta'   	        => $this->input->POST('fecha_hasta'),
           'especificacion' 		=> $this->input->post('especificacion'),
           'id_unidad_medida' 		=> $this->input->post('id_unidad_medida'),
           'i' 		                => $this->input->post('i'),
           'ii' 		            => $this->input->post('ii'),
           'iii' 		            => $this->input->post('iii'),
           'iv' 		            => $this->input->post('iv'),
           'precio_total' 		    => $this->input->post('precio_total'),
           'id_alicuota_iva' 		=> $this->input->post('id_alicuota_iva'),
           'iva_estimado' 		    => $this->input->post('iva_estimado'),
           'monto_estimado' 	    => $this->input->post('monto_estimado'),
           'est_trim_1' 		 => $this->input->post('estimado_i'),
           'est_trim_2' 		 => $this->input->post('estimado_ii'),
           'est_trim_3' 		=> $this->input->post('estimado_iii'),
           'est_trim_4' 		 => $this->input->post('estimado_iV'), 
           'estimado_total_t_acc' => $this->input->post('estimado_total_t'),
           'estatus_rendi' => 0,//estatus inical de progrmacion
       );

       $p_ffinanciamiento = array(
           'id_estado'   		        => $this->input->post('id_estado'),
           'id_par_presupuestaria' 	    => $this->input->post('par_presupuestaria_ff'),
           'id_fuente_financiamiento'   => $this->input->post('fuente_financiamiento'),
           'descripcion_ff' 	        => $this->input->post('descripcion_ff'),
           'porcentaje' 	            => $this->input->post('porcentaje'),
       );

       $data = $this->Programacion_model->save_obra($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento);
       echo json_encode($data);

    }

///////////////////////////////////////////////////////////////////////////////////////
    public function ver_programacion_proy(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $parametros = $this->input->get('id');
        $separar        = explode("/", $parametros);
        $data['id_p_proyecto']  = $separar['0'];
        $data['id_programacion'] = $separar['1'];
        $data['id_obj_comercial'] = $separar['2'];

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);
        $data['inf_2'] = $this->Programacion_model->inf_2($data['id_p_proyecto']);
        $data['inf_3'] = $this->Programacion_model->inf_3($data['id_p_proyecto']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        if ($data['id_obj_comercial'] == 3) {
          $this->load->view('programacion/obra/pdf_obra.php', $data);
        }else {
          $this->load->view('programacion/pdf_proyecto.php', $data);
        }
        $this->load->view('templates/footer.php');
    }

    //Para editar desde la ptabla de Proyectos Registrados--------------------------------------------------
    public function editar_proy(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $data['unidad']          = $this->session->userdata('id_unidad');
        $data['des_unidad']      = $this->session->userdata('unidad');
        $data['rif']             = $this->session->userdata('rif');
        $data['codigo_onapre']   = $this->session->userdata('codigo_onapre');

        $parametros              = $this->input->get('id');
        $separar                 = explode("/", $parametros);
        $data['id_p_proyecto']   = $separar['0'];
        $id_obj_comercial        = $separar['1'];
        $data['id_programacion'] = $separar['2'];

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        //Se pregunta y depende de la actividad comercial muestra la vista correspondiente------------------------
        if ($id_obj_comercial == '2') {
            //SERVICIO
            $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            //ACCION CENTRALIZADA
            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/servicio/editar_proy.php', $data);
            $this->load->view('templates/footer.php');

        }elseif ($id_obj_comercial == '1'){
            //BIEN
            $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            //ACCION CENTRALIZADA
            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/bien/editar_proy_b.php', $data);
            $this->load->view('templates/footer.php');
        }elseif ($id_obj_comercial == '3'){
            //OBRA
            $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
          
			$data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
			$data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
			$data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            //ACCION CENTRALIZADA
            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/obra/editar_proy.php', $data);
            $this->load->view('templates/footer.php');
        }
    }

    public function ver_proy_editar(){
        if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_2_edit($data);
	    echo json_encode($data);
    }

    public function ver_proy_editar_items(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_3_edit($data);
		echo json_encode($data);
    }

    public function ver_proy_editar_items_b(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_3_b($data);
		echo json_encode($data);
    }

	public function ver_proy_editar_items_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_3_o($data);
		echo json_encode($data);
    }

    public function editar_programacion_proy(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $nombre_proy = $this->input->POST('nombre_proyecto_a');

        $id_programaciones  = $this->input->POST('id_programacion');
        $separar          = explode("/", $id_programaciones);
        $id_programacion  = $separar['0'];
        $id_p_proyecto    = $separar['1'];

        $p_proyecto = array(
			'nombre_proyecto'        => $this->input->POST('nombre_proyecto_a'),
            'id_obj_comercial'       => $this->input->post('id_obj_comercial'),
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
	    );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
			'id_ccnu' 		         => $this->input->post('id_ccnu'),
            'fecha_desde'   	     => $this->input->POST('fecha_desde'),
            'fecha_hasta'   	     => $this->input->POST('fecha_hasta'),
			'especificacion' 		 => $this->input->post('especificacion'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida'),
            'i' 		             => $this->input->post('i'),
            'ii' 		             => $this->input->post('ii'),
            'iii' 		             => $this->input->post('iii'),
            'iv' 		             => $this->input->post('iv'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
		);

        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento'),
            'porcentaje' 	            => $this->input->post('porcentaje'),
        );

        $data = $this->Programacion_model->editar_programacion_proy($id_p_proyecto, $id_programacion, $p_proyecto,$p_items,$p_ffinanciamiento);

        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }else{
		   $this->session->set_flashdata('sa-error', 'error');
		   redirect('Programacion/nueva_prog?id='.$id_programacion);
	    }
    }

    public function editar_programacion_proy_b(){
        $nombre_proy = $this->input->POST('nombre_proyecto_a');

        $id_programaciones  = $this->input->POST('id_programacion');
        $separar          = explode("/", $id_programaciones);
        $id_programacion  = $separar['0'];
        $id_p_proyecto    = $separar['1'];

        $p_proyecto = array(
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto_a'),
            'id_obj_comercial'       => $this->input->post('id_obj_comercial'),
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria_acc'),
			'id_ccnu' 		         => $this->input->post('id_ccnu_acc'),
            'fecha_desde'   	     => date('Y-m-d'),
            'fecha_hasta'   	     => date('Y-m-d'),
			'especificacion' 		 => $this->input->post('especificacion_acc'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida_acc'),
            'cantidad'               => $this->input->post('cantidad_acc'),
            'i' 		             => $this->input->post('I_acc'),
            'ii' 		             => $this->input->post('II_acc'),
            'iii' 		             => $this->input->post('III_acc'),
            'iv' 		             => $this->input->post('IV_acc'),
            'cant_total_distribuir'  => $this->input->post('cant_total_distribuir_acc'),
            'costo_unitario' 	     => $this->input->post('costo_unitario_acc'),
            'precio_total' 		     => $this->input->post('precio_total_acc'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva_acc'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
		        );

            $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado_acc'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_acc_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento_acc'),
            'porcentaje' 	            => $this->input->post('porcentaje_acc'),
          );

        $data = $this->Programacion_model->editar_programacion_proy_b($id_p_proyecto, $id_programacion, $p_proyecto,$p_items,$p_ffinanciamiento);
        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }else{
  		    $this->session->set_flashdata('sa-error', 'error');
  		   redirect('Programacion/nueva_prog?id='.$id_programacion);
  	    }
    }

	public function editar_programacion_proy_o(){
		if(!$this->session->userdata('session'))redirect('login');

        $nombre_proy = $this->input->POST('nombre_proyecto_a');

        $id_programaciones  = $this->input->POST('id_programacion');
        $separar          = explode("/", $id_programaciones);
        $id_programacion  = $separar['0'];
        $id_p_proyecto    = $separar['1'];

        $p_proyecto = array(
            'nombre_proyecto'        => $this->input->POST('nombre_proyecto_a'),
            'id_obj_comercial'       => 3,
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
        );

       $p_items = array(
           'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
           'id_ccnu' 		        => $this->input->post('id_ccnu'),
           'id_tip_obra' 		    => $this->input->post('id_tip_obra_e'),
           'id_alcance_obra' 		=> $this->input->post('id_alcance_obra_e'),
           'id_obj_obra' 		    => $this->input->post('id_obj_obra_e'),
           'fecha_desde'   	        => $this->input->POST('fecha_desde'),
           'fecha_hasta'   	        => $this->input->POST('fecha_hasta'),
           'especificacion' 		=> $this->input->post('especificacion'),
           'id_unidad_medida' 		=> $this->input->post('id_unidad_medida'),
           'i' 		                => $this->input->post('i'),
           'ii' 		            => $this->input->post('ii'),
           'iii' 		            => $this->input->post('iii'),
           'iv' 		            => $this->input->post('iv'),
           'precio_total' 		    => $this->input->post('precio_total_e'),
           'id_alicuota_iva' 		=> $this->input->post('id_alicuota_iva'),
           'iva_estimado' 		    => $this->input->post('iva_estimado'),
           'monto_estimado' 	    => $this->input->post('monto_estimado'),
       );

       $p_ffinanciamiento = array(
           'id_estado'   		        => $this->input->post('id_estado'),
           'id_par_presupuestaria' 	    => $this->input->post('par_presupuestaria_ff'),
           'id_fuente_financiamiento'   => $this->input->post('fuente_financiamiento'),
           'descripcion_ff' 	        => $this->input->post('descripcion_ff'),
           'porcentaje' 	            => $this->input->post('porcentaje'),
       );
      /* $data = $this->Programacion_model->save_obra($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento);
       echo json_encode($data);*/

	   $data = $this->Programacion_model->editar_programacion_proy_o($id_p_proyecto, $id_programacion, $p_proyecto,$p_items,$p_ffinanciamiento);
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('Programacion/nueva_prog?id='.$id_programacion);
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('Programacion/nueva_prog?id='.$id_programacion);
		 }
	}

    //LLENADO PARA EL MODAL DE PROYECTO / OBRAS
    public function cons_items_proy_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->cons_items_proy_o($data);
		
		echo json_encode($data);
    }

    public function editar_fila_ip(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->editar_fila_ip($data);
  		echo json_encode($data);
  	}

	public function editar_fila_ip_o(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Programacion_model->editar_fila_ip_b_o($data);
		echo json_encode($data);
	}

	/////LLENA LOS SELECT DENTRO DE LOS MODALES
    public function llenar_par_pre_mod(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->llenar_par_pre_mod($data);
  		echo json_encode($data);
  	}

    public function llenar_uni_med_mod(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->llenar_uni_med_mod($data);
  		echo json_encode($data);
  	}
      public function llenar_ff_(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->llenar_ff_($data);
        echo json_encode($data);
    }
      public function llenar_modalidad(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->llenar_modalidad($data);
        echo json_encode($data);
    }

    public function llenar_tipo_doc_contrata(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->llenar_tipo_doc_contrata($data);
        echo json_encode($data);
    }
    
    public function llenar_comp_resp_social(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->llenar_comp_resp_social($data);
        echo json_encode($data);
    }
    public function consultar_acc14(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->consultar_acc14($data);
        echo json_encode($data);
    }
    public function consultar_obto(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->consultar_obto($data);
        echo json_encode($data);
    }
    public function llenar_trimestre(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->llenar_trimestre($data);
        echo json_encode($data);
    }
    public function consultar_contratista(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Evaluacion_desempenio_model->consultar_contratista($data);
        echo json_encode($data);
    }
    
    public function llenar_alic_iva_mod(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->llenar_alic_iva_mod($data);
  		echo json_encode($data);
  	}
      public function llenar_tipo_obra(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->consulta_tip_obra($data);
        echo json_encode($data);
    }
    public function llenar_alcance_obra(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->consulta_alcance_obra($data);
        echo json_encode($data);
    }
    public function llenar_objeto_obra(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->consulta_obj_obra($data);
        echo json_encode($data);
    }

    public function llenar_selc_ccnu_m(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->llenar_selc_ccnu_m($data);
  		echo json_encode($data);
  	}

	public function llenar_alic_tip_obra(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Programacion_model->llenar_alic_tip_obra($data);
		echo json_encode($data);
	}

	public function llenar_alic_alc_obra(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Programacion_model->llenar_alic_alc_obra($data);
		echo json_encode($data);
	}

	public function llenar_alic_obj_obra(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Programacion_model->llenar_alic_obj_obra($data);
		echo json_encode($data);
	}
	

	///////
    public function eliminar_proy(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->eliminar_proy($data);
        echo json_encode($data);
    }

    public function ver_programacion_acc(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $parametros = $this->input->get('id');
        $separar        = explode("/", $parametros);
        $data['id_p_acc_centralizada']  = $separar['0'];
        $data['id_programacion'] = $separar['1'];
        $data['id_obj_comercial'] = $separar['2'];

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
        $data['inf_2_acc'] = $this->Programacion_model->inf_2_acc_pdf($data['id_p_acc_centralizada']);
        $data['inf_3_acc'] = $this->Programacion_model->inf_3_acc_pdf($data['id_p_acc_centralizada']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');

        if ($data['id_obj_comercial'] == 3) {
          $this->load->view('programacion/obra/pdf_obra_acc.php', $data);
        }else {
          $this->load->view('programacion/pdf_acc.php', $data);
        }
        $this->load->view('templates/footer.php');

    }

    //Para editar desde la ptabla de Acción Centralizada Registradas ---------------------------------------
    public function editar_acc(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

        $parametros         = $this->input->get('id');
        $separar        = explode("/", $parametros);
        $data['id_p_acc_centralizada']  = $separar['0'];
        $id_obj_comercial = $separar['1'];
        $data['id_programacion'] = $separar['2'];

        $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
        $data['anio'] = $data['programacion_anio']['anio'];

        //Se pregunta y depende de la actividad comercial muestra la vista correspondiente----------------------------------------
        if ($id_obj_comercial == '2') {
            //SERVICIO
            $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);

            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/servicio/editar_acc.php', $data);
            $this->load->view('templates/footer.php');

        }elseif ($id_obj_comercial == '1') {
            //BIEN
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/bien/editar_acc_b.php', $data);
            $this->load->view('templates/footer.php');
        }elseif ($id_obj_comercial == '3') {
            //OBRA
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

			$data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
			$data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
			$data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

            $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);

            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/obra/editar_acc.php', $data);
            $this->load->view('templates/footer.php');
        }
    }

    public function ver_acc_editar(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_2_acc($data);
		 echo json_encode($data);
    }

    public function ver_acc_editar_items(){
        if(!$this->session->userdata('session'))
        redirect('login');
		      $data = $this->input->post();
		        $data = $this->Programacion_model->inf_3_acc($data);
		          echo json_encode($data);
    }

	public function ver_acc_editar_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_2_acc($data);
		 echo json_encode($data);
    }

	public function ver_acc_editar_items_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_4_acc_o($data);
		echo json_encode($data);
    }

    public function ver_acc_editar_items_b(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Programacion_model->inf_3_acc_b($data);
		echo json_encode($data);
    }

    public function editar_programacion_acc(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $id_accion_centralizada = $this->input->POST('id_accion_centralizada');

        $id_programaciones  = $this->input->POST('id_programacion');
        $separar          = explode("/", $id_programaciones);
        $id_programacion  = $separar['0'];
        $id_p_acc_centralizada    = $separar['1'];

        $p_acc_centralizada = array(
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada'),
            'id_obj_comercial'       => $this->input->post('id_obj_comercial'),
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
	         );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria'),
			         'id_ccnu' 		         => $this->input->post('id_ccnu'),
            'fecha_desde'   	     => $this->input->POST('fecha_desde'),
            'fecha_hasta'   	     => $this->input->POST('fecha_hasta'),
			         'especificacion' 		 => $this->input->post('especificacion'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida'),
            'i' 		             => $this->input->post('i'),
            'ii' 		             => $this->input->post('ii'),
            'iii' 		             => $this->input->post('iii'),
            'iv' 		             => $this->input->post('iv'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva'),
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
		        );

        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento'),
            'porcentaje' 	            => $this->input->post('porcentaje'),
        );

        $data = $this->Programacion_model->editar_programacion_acc($id_p_acc_centralizada, $id_programacion, $p_acc_centralizada,$p_items,$p_ffinanciamiento);
        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
    		redirect('Programacion/nueva_prog?id='.$id_programacion);
        }else{
            $this->session->set_flashdata('sa-error', 'error');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }

    }

    public function editar_programacion_acc_b(){
        if(!$this->session->userdata('session'))
        redirect('login');

        $id_accion_centralizada = $this->input->POST('id_programacion_acc_b');
        $separar                 = explode("/", $id_accion_centralizada);
        $id_programacion         = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $p_acc_centralizada = array(
            'id_accion_centralizada' => $this->input->POST('id_accion_centralizada_acc'),
            'id_obj_comercial'       => $this->input->post('id_obj_comercial_acc'),
            'id_usuario' 		     => $this->session->userdata('id_user'),
            'estatus'                => 1
	         );

        $p_items = array(
            'id_par_presupuestaria'  => $this->input->post('par_presupuestaria_acc'),
			         'id_ccnu' 		         => $this->input->post('id_ccnu_acc'),
            'fecha_desde'   	     => date('Y-m-d'),
            'fecha_hasta'   	     => date('Y-m-d'),
			         'especificacion' 		 => $this->input->post('especificacion_acc'),
            'id_unidad_medida' 		 => $this->input->post('id_unidad_medida_acc'),
            'cantidad'               => $this->input->post('cantidad_acc'),
            'i' 		             => $this->input->post('I_acc'),
            'ii' 		             => $this->input->post('II_acc'),
            'iii' 		             => $this->input->post('III_acc'),
            'iv' 		             => $this->input->post('IV_acc'),
            'cant_total_distribuir'  => $this->input->post('cant_total_distribuir_acc'),
            'costo_unitario' 	     => $this->input->post('costo_unitario_acc'),
            'precio_total' 		     => $this->input->post('precio_total_acc'),
            'id_alicuota_iva' 		 => $this->input->post('id_alicuota_iva_acc'),
            'iva_estimado' 		     => $this->input->post('iva_estimado_acc'),
            'monto_estimado' 		 => $this->input->post('monto_estimado_acc'),
		        );


        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado_acc'),
            'id_par_presupuestaria' 	=> $this->input->post('par_presupuestaria_acc_ff'),
            'id_fuente_financiamiento'  => $this->input->post('fuente_financiamiento_acc'),
            'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        );

        $data = $this->Programacion_model->editar_programacion_acc_b($id_p_acc_centralizada, $id_programacion, $p_acc_centralizada,$p_items,$p_ffinanciamiento);
        if ($data) {
            $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }else{
            $this->session->set_flashdata('sa-error', 'error');
            redirect('Programacion/nueva_prog?id='.$id_programacion);
        }
    }

    //LLENADO PARA EL MODAL DE PROYECTO / BIENES
    public function cons_items_proy_b(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data = $this->input->post();
        $data = $this->Programacion_model->cons_items_proy($data);
        echo json_encode($data);
    }

    public function editar_fila_ip_b(){
  		if(!$this->session->userdata('session'))redirect('login');
  		$data = $this->input->post();
  		$data =	$this->Programacion_model->editar_fila_ip_b($data);
  		echo json_encode($data);
  	}
      public function reprogramar_items_acc_bienes(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->reprogramar_items_acc_bienes($data);
        echo json_encode($data);
    }

    public function cons_items_acc_b(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data = $this->input->post();
        $data = $this->Programacion_model->cons_items_acc_b($data);
        echo json_encode($data);
    }

	public function cons_items_acc_o(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data = $this->input->post();
        $data = $this->Programacion_model->cons_items_acc_o($data);
        echo json_encode($data);
    }

    public function eliminar_acc(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->eliminar_acc($data);
        echo json_encode($data);
    }
    public function consulta_general(){
        if(!$this->session->userdata('session'))redirect('login');

        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
        $unidad = $this->session->userdata('id_unidad');

        $data['ver_programaciones'] = $this->Programacion_model->consultar_programacio($unidad);
        $data['fecha'] = date('yy');

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('programacion/consulta/consulta_an.php', $data);
        $this->load->view('templates/footer.php');
    }
///////////////////////////////////////agregar mas item a la carga de la programacion bienes
public function agregar_items() {


    $data['unidad']          = $this->session->userdata('id_unidad');
    $data['des_unidad']      = $this->session->userdata('unidad');
    $data['rif']             = $this->session->userdata('rif');
    $data['codigo_onapre']   = $this->session->userdata('codigo_onapre');

    $parametros              = $this->input->get('id');
    $separar                 = explode("/", $parametros);
    $data['id_p_proyecto']   = $separar['0'];
    $id_obj_comercial        = $separar['1'];
    $data['id_programacion'] = $separar['2'];

    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    $data['anio'] = $data['programacion_anio']['anio'];

    $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

    $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
    $data['fuente'] = $this->Programacion_model->consulta_fuente();
    $data['act_com'] = $this->Programacion_model->consulta_act_com();
    $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
    $data['estados'] 	= $this->Configuracion_model->consulta_estados();
    $data['unid'] 	= $this->Programacion_model->consulta_unid();
    $data['iva'] 	= $this->Programacion_model->consulta_iva();

    $data['proyecto'] = $this->Programacion_model->consultar_proyecto($data['id_p_proyecto']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/bien/agregar_itms.php', $data);
    $this->load->view('templates/footer.php');
}

public function agregar_mas_item_proyecto() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva_acc');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $id_programacion2,
         'id_p_acc'=> '0',
         'id_tip_obra'=> '0',
         'id_alcance_obra'=> '0',
         'id_obj_obra'=> '0',
         'fecha_desde'=> date('Y-m-d'),
         'fecha_hasta'=> date('Y-m-d'),
        'id_partidad_presupuestaria'  => $id_presupuestaria,
        'id_ccnu' 		         => $id_ccnu_acc1,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => $this->input->post('cantidad_acc'),
        'i' 		             => $this->input->post('I_acc'),
        'ii' 		             => $this->input->post('II_acc'),
        'iii' 		             => $this->input->post('III_acc'),
        'iv' 		             => $this->input->post('IV_acc'),
        'cant_total_distribuir' 		             => $this->input->post('cant_total_distribuir_acc'),
        'precio_total' 		     => $this->input->post('precio_total_acc'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado_acc'),
        'costo_unitario' 		 => $this->input->post('costo_unitario_acc'),
        'monto_estimado' 		 => $this->input->post('monto_estimado_acc'),
        'est_trim_1' 		 => $this->input->post('estimado_i_acc'),
        'est_trim_2' 		 => $this->input->post('estimado_ii_acc'),
        'est_trim_3' 		 => $this->input->post('estimado_iii_acc'),
        'est_trim_4' 		 => $this->input->post('estimado_iV_acc'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t_acc'),
      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $id_programacion2,
        'id_p_acc'=> '1',
    );

    $data = $this->Programacion_model->agregar_mas_item_proyecto($data,$p_ffinanciamiento);
    echo json_encode($data);
}

///////////////////////////////////////agregar MAS item a accion centralizada bienes///////////////////

public function agregar_items_accioncentralizada_bienes() {
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

    $parametros         = $this->input->get('id');
    $separar        = explode("/", $parametros);
    $data['id_p_acc_centralizada']  = $separar['0'];
    $id_obj_comercial = $separar['1'];
    $data['id_programacion'] = $separar['2'];

   //Se pregunta y depende de la actividad comercial muestra la vista correspondiente------------------------
        if ($id_obj_comercial == '2') {
            //SERVICIO
            //$data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            //ACCION CENTRALIZADA
            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
            //informacion accion centralizada
            $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
            $data['accion'] = $this->Programacion_model->consultar_scc($data['id_p_acc_centralizada']);
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/servicio/agregar_items_accserv.php', $data);
            $this->load->view('templates/footer.php');

        }elseif ($id_obj_comercial == '1'){    
             //BIEN

                $data['accion'] = $this->Programacion_model->consultar_scc($data['id_p_acc_centralizada']);
                $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                $data['fuente'] = $this->Programacion_model->consulta_fuente();
                $data['act_com'] = $this->Programacion_model->consulta_act_com();
                $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                $data['unid'] 	= $this->Programacion_model->consulta_unid();
                $data['iva'] 	= $this->Programacion_model->consulta_iva();

                $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

                $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);


                //////////////////////////////////////////////////////////////
                $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                $data['fuente'] = $this->Programacion_model->consulta_fuente();
                $data['act_com'] = $this->Programacion_model->consulta_act_com();
                $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                $data['unid'] 	= $this->Programacion_model->consulta_unid();
                $data['iva'] 	= $this->Programacion_model->consulta_iva();

                $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

                $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
                ////////////////////////////////////////////////////////////////

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/bien/agregar_itm_acc.php', $data);
    $this->load->view('templates/footer.php');
}
            elseif ($id_obj_comercial == '3') {
                //OBRA
                $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                $data['fuente'] = $this->Programacion_model->consulta_fuente();
                $data['act_com'] = $this->Programacion_model->consulta_act_com();
                $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                $data['unid'] 	= $this->Programacion_model->consulta_unid();
                $data['iva'] 	= $this->Programacion_model->consulta_iva();

                $data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
                $data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
                $data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

                $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                $data['accion'] = $this->Programacion_model->consultar_tems_obras($data['id_p_acc_centralizada']);
                $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);

                $this->load->view('templates/header.php');
                $this->load->view('templates/navigator.php');
                $this->load->view('programacion/obra/agregar_items_accobra.php', $data);
                $this->load->view('templates/footer.php');
            }

}
/////////////////GUARDA MAS ITEMS BIENES acc

public function Guardar_mas_item_acc() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva_acc');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_p_acc'=> 1,
         'id_obj_comercial'=> $this->input->post('id_obj_comercial1'), 
         'id_tip_obra'=> '0',
         'id_alcance_obra'=> '0',
         'id_obj_obra'=> '0',
         'fecha_desde'=> date('Y-m-d'),
         'fecha_hasta'=> date('Y-m-d'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => $id_ccnu_acc1,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => $this->input->post('cantidad_acc'),
        'i' 		             => $this->input->post('I_acc'),
        'ii' 		             => $this->input->post('II_acc'),
        'iii' 		             => $this->input->post('III_acc'),
        'iv' 		             => $this->input->post('IV_acc'),
        'cant_total_distribuir' 		             => $this->input->post('cant_total_distribuir_acc'),
        'precio_total' 		     => $this->input->post('precio_total_acc'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado_acc'),
        'costo_unitario' 		 => $this->input->post('costo_unitario_acc'),
        'monto_estimado' 		 => $this->input->post('monto_estimado_acc'),
        'est_trim_1' 		 => $this->input->post('estimado_i_acc'),
        'est_trim_2' 		 => $this->input->post('estimado_ii_acc'),
        'est_trim_3' 		 => $this->input->post('estimado_iii_acc'),
        'est_trim_4' 		 => $this->input->post('estimado_iV_acc'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t_acc'),
        'estatus_rendi' => 0,//estatus inical del id_items
        'id_proyecto' 		 => $this->input->post('id_proyectoii'),//para calcular total de partida pp
        'id_usuario' => $this->session->userdata('id_user'),

      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '1',
    );

    $data = $this->Programacion_model->agregar_mas_item_proyecto($data,$p_ffinanciamiento);
    echo json_encode($data);
}
/////////////////agreagar mnas GUARDA MAS ITEMS BIENES acc reprogramado

public function Guar_reprogramar_mas_item_acc() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva_acc');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_p_acc'=> 1,
         'id_tip_obra'=> '0',
         'id_alcance_obra'=> '0',
         'id_obj_obra'=> '0',
         'fecha_desde'=> date('Y-m-d'),
         'fecha_hasta'=> date('Y-m-d'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => $id_ccnu_acc1,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => $this->input->post('cantidad_acc'),
        'i' 		             => $this->input->post('I_acc'),
        'ii' 		             => $this->input->post('II_acc'),
        'iii' 		             => $this->input->post('III_acc'),
        'iv' 		             => $this->input->post('IV_acc'),
        'cant_total_distribuir' 		             => $this->input->post('cant_total_distribuir_acc'),
        'precio_total' 		     => $this->input->post('precio_total_acc'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado_acc'),
        'costo_unitario' 		 => $this->input->post('costo_unitario_acc'),
        'monto_estimado' 		 => $this->input->post('monto_estimado_acc'),
        'est_trim_1' 		 => $this->input->post('estimado_i_acc'),
        'est_trim_2' 		 => $this->input->post('estimado_ii_acc'),
        'est_trim_3' 		 => $this->input->post('estimado_iii_acc'),
        'est_trim_4' 		 => $this->input->post('estimado_iV_acc'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t_acc'),
        'estatus_rendi' 		 => 0,
        'reprogramado' 		 => 1,
        'fecha_reprogramacion' 		 => date('Y-m-d'),
        'id_proyecto' 		 => $this->input->post('id_programacion3'),
        'id_obj_comercial' 		 => $this->input->post('id_obj_comercial'),        
        'observaciones' 		 => $this->input->post('observaciones'),



      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '1',
    );

    $data = $this->Programacion_model->agregar_mas_item_reprogramado($data,$p_ffinanciamiento);
    echo json_encode($data);
}
////////////////////////guardar items bienes proyecto 
public function Guardar_mas_item_bienes_py() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva_acc');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_obj_comercial'=> $this->input->post('id_obj_comercial1'),

         'id_p_acc'=> 0,///indica que es un proyecto
         'id_tip_obra'=> '0',
         'id_alcance_obra'=> '0',
         'id_obj_obra'=> '0',
         'fecha_desde'=> date('Y-m-d'),
         'fecha_hasta'=> date('Y-m-d'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => $id_ccnu_acc1,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => $this->input->post('cantidad_acc'),
        'i' 		             => $this->input->post('I_acc'),
        'ii' 		             => $this->input->post('II_acc'),
        'iii' 		             => $this->input->post('III_acc'),
        'iv' 		             => $this->input->post('IV_acc'),
        'cant_total_distribuir' 		             => $this->input->post('cant_total_distribuir_acc'),
        'precio_total' 		     => $this->input->post('precio_total_acc'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado_acc'),
        'costo_unitario' 		 => $this->input->post('costo_unitario_acc'),
        'monto_estimado' 		 => $this->input->post('monto_estimado_acc'),
        'est_trim_1' 		 => $this->input->post('estimado_i_acc'),
        'est_trim_2' 		 => $this->input->post('estimado_ii_acc'),
        'est_trim_3' 		 => $this->input->post('estimado_iii_acc'),
        'est_trim_4' 		 => $this->input->post('estimado_iV_acc'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t_acc'),
        'estatus_rendi' => 0,//estatus inical del id_items
        'id_proyecto' 		 => $this->input->post('id_proyectoii'),//para calcular total de partida pp
        'id_usuario' => $this->session->userdata('id_user'),

      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => 0,
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '0',//indica q es un proyecto
    );

    $data = $this->Programacion_model->agregar_mas_item_proyecto($data,$p_ffinanciamiento);
    echo json_encode($data);
}
//////mostrar datos en el modal para editar items de bienes/////////////////////
public function consultar_item_modal_bienes(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->consultar_items($data);
    echo json_encode($data);
}

//Editar item de servicios accion centralizada

public function editar_item_servicio_acc(){
    if(!$this->session->userdata('session'))redirect('login');
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
    $data['time']=date("d-m-Y");

    $parametros              = $this->input->get('id');
    $separar                 = explode("/", $parametros);
    $data['id']   = $separar['0'];
    $data['id_p_items']       = $separar['1'];
    
    //Proyecto
    $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
    $data['fuente'] = $this->Programacion_model->consulta_fuente();
    $data['act_com'] = $this->Programacion_model->consulta_act_com();
    $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
    $data['estados'] 	= $this->Configuracion_model->consulta_estados();
    $data['unid'] 	= $this->Programacion_model->consulta_unid();
    $data['iva'] 	= $this->Programacion_model->consulta_iva();

    //ACCION CENTRALIZADA
    $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
    $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
    //informacion accion centralizada
    // $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
    $data['accion'] = $this->Programacion_model->consultar_itms_serv($data['id_p_items']);




    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/servicio/editar_items_servicios.php', $data);
    $this->load->view('templates/footer.php');
}
/////////////////////editar items de servicio proyecto =1
public function editar_item_servicio_py(){
    if(!$this->session->userdata('session'))redirect('login');
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
    $data['time']=date("d-m-Y");

    $parametros              = $this->input->get('id');
    $separar                 = explode("/", $parametros);
    $data['id']   = $separar['0'];
    $data['id_p_items']       = $separar['1'];
    
    //Proyecto
    $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
    $data['fuente'] = $this->Programacion_model->consulta_fuente();
    $data['act_com'] = $this->Programacion_model->consulta_act_com();
    $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
    $data['estados'] 	= $this->Configuracion_model->consulta_estados();
    $data['unid'] 	= $this->Programacion_model->consulta_unid();
    $data['iva'] 	= $this->Programacion_model->consulta_iva();

    //ACCION CENTRALIZADA
    $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
    $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
    //informacion accion centralizada
    // $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
    $data['accion'] = $this->Programacion_model->consultar_itms_serv_py($data['id_p_items']);




    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/servicio/editar_item_py_serv.php', $data);
    $this->load->view('templates/footer.php');
}


   ///guardar los cambios realizados en los items de agregar_servicio accentralizada
    public function guardar_items_modificados_servi(){
		if(!$this->session->userdata('session'))redirect('login');
        
        $id_p_items = $this->input->post("id_p_items");
        $especificacion = $this->input->post("especificacion");
        $id_unidad_medida = $this->input->post("id_unidad_medida");
        $fecha_desde = $this->input->post("start");
        $fecha_hasta = $this->input->post("end");
        $I = $this->input->post("I");
        $II = $this->input->post("II");
        $III = $this->input->post("III");
        $IV = $this->input->post("IV");
        $cant_total_distribuir = $this->input->post("cant_total_distribuir");
        $precio_total = $this->input->post("precio_total");
               
        $id_alicuota_iva = $this->input->post("id_alicuota_iva"); 
        $explode = explode('/', $id_alicuota_iva);
        $id_iva = $explode['0'];
        $iva = $explode['1'];
        $iva_estimado = $this->input->post("iva_estimado"); 
        $monto_estimado = $this->input->post("monto_estimado");
        $est_trim_1 = $this->input->post("estimado_i");
        $est_trim_2 = $this->input->post("estimado_ii");
        $est_trim_3 = $this->input->post("estimado_iii");
        $est_trim_4 = $this->input->post("estimado_iV");
        $estimado_total_t_acc = $this->input->post("estimado_total_t");
        // $fecha_pago  = $this->input->post("fecha_pago");

       

        $itm_serv = array(
                
            "especificacion"   => $especificacion,
            "id_unidad_medida"     => $id_unidad_medida,
            "fecha_desde"       => $fecha_desde,
            "fecha_hasta"          => $fecha_hasta,
            "i"          => $I,
            "ii"         => $II,
            "iii"        => $III,
            "iv"         => $IV,
            "cantidad"         => $cant_total_distribuir,            
            "cant_total_distribuir"        => $cant_total_distribuir,
            "precio_total"         => $precio_total,
            "alicuota_iva"          => $id_iva,
            "iva_estimado"         => $iva_estimado,
            "monto_estimado"     => $monto_estimado,
            "est_trim_1"        => $est_trim_1,
            "est_trim_2"           => $est_trim_2,
            "est_trim_3"     => $est_trim_3,   
            "est_trim_4"    => $est_trim_4,      
            "estimado_total_t_acc"    => $estimado_total_t_acc,      

            //"fechaingreso"  => date("Y-m-d")            
        ); 
        $data = $this->Programacion_model->guardar_items_modificados_servi($id_p_items,$itm_serv);
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('programacion/index');
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('programacion/index');
		 }
	}
/////////////////////////////////////funcion agregar mas item a una accion centralizada  de servicios///////////
    public function Guardar_mas_item_acc_servicio() {
        if (!$this->session->userdata('session'))
            redirect('login');
            
            $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
            $separar                 = explode("/", $par_presupuestaria_acc);
            $id_presupuestaria        = $separar['0'];
            $id_p_acc_centralizada   = $separar['1'];
            
            $id_programacion = $this->input->POST('id_programacion');
            $separar                 = explode("/", $id_programacion);
            $id_programacion        = $separar['0'];//este
            $id_programacion2   = $separar['1'];//
    
            $id_programacion3 = $this->input->post("id_programacion2");//id_programacion     
            
            $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
            $separar                 = explode("/", $id_unidad_medida_acc);
            $id_unidad_medida_acc1        = $separar['0'];
            $id_p_acc_centralizada   = $separar['1'];
    
            $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
            $separar                 = explode("/", $id_alicuota_iva_acc);
            $id_alicuota_iva_acc1       = $separar['0'];
            $id_alicuota_iva_acc2   = $separar['1'];
    
            $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
            $separar                 = explode("/", $id_ccnu_acc);
            $id_ccnu_acc1        = $separar['0'];
            $id_ccnu_acc2   = $separar['1'];
    
            $id_estado = $this->input->POST('id_estado');
            $separar                 = explode("/", $id_estado);
            $id_estado1       = $separar['0'];
            $id_estado2   = $separar['1'];
    
            $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
            $separar                 = explode("/", $fuente_financiamiento_acc);
            $fuente_financiamiento_acc1       = $separar['0'];
            $fuente_financiamiento_acc2   = $separar['1'];
    
            $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
            $separar                 = explode("/", $par_presupuestaria_acc);
            $par_presupuestaria_acc1       = $separar['0'];
            $par_presupuestaria_acc2   = $separar['1'];
    
       $data = array(
    
       
             'id_enlace'=> $this->input->post('id_programacion'),
             'id_p_acc'=> 1,// es una accion centralizada
             'id_tip_obra'=> '0',
             'id_alcance_obra'=> '0',
             'id_obj_obra'=> '0',
             'id_obj_comercial'=> $this->input->post('id_obj_comercial'),

             'fecha_desde'=> $this->input->post('fecha_desde'),
             'fecha_hasta'=> $this->input->post('fecha_hasta'),
            'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
            'id_ccnu' 		         => $id_ccnu_acc1,
            'especificacion' 		 => $this->input->post('especificacion_acc'),
            'id_unidad_medida' 		 => $id_unidad_medida_acc1,
            'cantidad' 		 => 0,
            'i' 		             => $this->input->post('I'),
            'ii' 		             => $this->input->post('II'),
            'iii' 		             => $this->input->post('III'),
            'iv' 		             => $this->input->post('IV'),
            'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'alicuota_iva' 		 => $id_alicuota_iva_acc1,
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'costo_unitario' 		 => 0,
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
            'est_trim_1' 		 => $this->input->post('estimado_i'),
            'est_trim_2' 		 => $this->input->post('estimado_ii'),
            'est_trim_3' 		 => $this->input->post('estimado_iii'),
            'est_trim_4' 		 => $this->input->post('estimado_iV'),
            'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
            "estatus_rendi"    => 0,// estatus de la rendicion
            'id_proyecto' 		 => $this->input->post('id_proyectoii'),//para calcular total de partida pp
            'id_usuario' => $this->session->userdata('id_user'),

          
    
        );
      
        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado_acc'),
            'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
            'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
            'porcentaje' 	            => $this->input->post('porcentaje_acc'),
            'id_enlace'=> $this->input->post('id_programacion'),
            'id_p_acc'=> '1',//es una accion centralizada
        );
    
        $data = $this->Programacion_model->agregar_mas_item_servicio($data,$p_ffinanciamiento);
        echo json_encode($data);
    }

    //////////////////eliminar items de servicio
    public function eliminar_items_serv(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->eliminar_items_serv($data);
        echo json_encode($data);
    }
     //////////////////eliminar items de servicio
     public function eliminar_items_bienes(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->eliminar_items_bienes($data);
        echo json_encode($data);
    }
       //////////////////eliminar items de rendicion
       public function eliminar_rendiciones(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Programacion_model->eliminar_rendiciones($data);
        echo json_encode($data);
    }

    //////////////////////////////Agregar mas items a una accion centralizada Obra 
    public function Guardar_mas_item_acc_obra() {
        if (!$this->session->userdata('session'))
            redirect('login');
            
            $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
            $separar                 = explode("/", $par_presupuestaria_acc);
            $id_presupuestaria        = $separar['0'];
            $id_p_acc_centralizada   = $separar['1'];
            
            $id_programacion = $this->input->POST('id_programacion');
            $separar                 = explode("/", $id_programacion);
            $id_programacion        = $separar['0'];
            $id_programacion2   = $separar['1'];
            
            
            
            $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
            $separar                 = explode("/", $id_unidad_medida_acc);
            $id_unidad_medida_acc1        = $separar['0'];
            $id_p_acc_centralizada   = $separar['1'];
    
            $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
            $separar                 = explode("/", $id_alicuota_iva_acc);
            $id_alicuota_iva_acc1       = $separar['0'];
            $id_alicuota_iva_acc2   = $separar['1'];
    
            $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
            $separar                 = explode("/", $id_ccnu_acc);
            $id_ccnu_acc1        = $separar['0'];
            $id_ccnu_acc2   = $separar['1'];
    
            $id_estado = $this->input->POST('id_estado');
            $separar                 = explode("/", $id_estado);
            $id_estado1       = $separar['0'];
            $id_estado2   = $separar['1'];
    
            $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
            $separar                 = explode("/", $fuente_financiamiento_acc);
            $fuente_financiamiento_acc1       = $separar['0'];
            $fuente_financiamiento_acc2   = $separar['1'];
    
            $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
            $separar                 = explode("/", $par_presupuestaria_acc);
            $par_presupuestaria_acc1       = $separar['0'];
            $par_presupuestaria_acc2   = $separar['1'];
    
       $data = array(
    
       
             'id_enlace'=> $this->input->post('id_programacion'),
             'id_p_acc'=> 1,
             'id_obj_comercial'=> $this->input->post('id_obj_comercial'),

             'id_tip_obra'=> $this->input->post('id_tip_obra'),
             'id_alcance_obra'=> $this->input->post('id_alcance_obra'),
             'id_obj_obra'=> $this->input->post('id_obj_obra'),
             'fecha_desde'=> $this->input->post('fecha_desde'),
             'fecha_hasta'=> $this->input->post('fecha_hasta'),
            'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
            'id_ccnu' 		         => 0,
            'especificacion' 		 => $this->input->post('especificacion_acc'),
            'id_unidad_medida' 		 => $id_unidad_medida_acc1,
            'cantidad' 		 => 0,
            'i' 		             => $this->input->post('I'),
            'ii' 		             => $this->input->post('II'),
            'iii' 		             => $this->input->post('III'),
            'iv' 		             => $this->input->post('IV'),
            'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
            'precio_total' 		     => $this->input->post('precio_total'),
            'alicuota_iva' 		 => $id_alicuota_iva_acc1,
            'iva_estimado' 		     => $this->input->post('iva_estimado'),
            'costo_unitario' 		 => 0,
            'monto_estimado' 		 => $this->input->post('monto_estimado'),
            'est_trim_1' 		 => $this->input->post('estimado_i'),
            'est_trim_2' 		 => $this->input->post('estimado_ii'),
            'est_trim_3' 		 => $this->input->post('estimado_iii'),
            'est_trim_4' 		 => $this->input->post('estimado_iV'),
            'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
            'estatus_rendi' => 0,//estatus inical del id_items
            'id_proyecto' 		 => $this->input->post('id_proyectoii'),//para calcular total de partida pp
            'id_usuario' => $this->session->userdata('id_user'),

          
    
        );
      
        $p_ffinanciamiento = array(
            'id_estado'   		        => $this->input->post('id_estado_acc'),
            'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
            'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
            'porcentaje' 	            => $this->input->post('porcentaje_acc'),
            'id_enlace'=> $this->input->post('id_programacion'),
            'id_p_acc'=> '1',
        );
    
        $data = $this->Programacion_model->agregar_mas_item_obras($data,$p_ffinanciamiento);
        echo json_encode($data);
    }

    /////////////////enviar programacion al snc, cambia el status
    public function enviar_snc()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data = $this->input->post();
        
        $des_unidad = $this->session->userdata('unidad');
        $codigo_onapre = $this->session->userdata('codigo_onapre');
        $rif = $this->session->userdata('rif_organoente');
        $id_programacion = $data['id'];
        
        
        $data2 = $this->Programacion_model->consulta_total_objeto_acc($id_programacion);
        
        $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
       
        $data4 = $this->Programacion_model->consulta_total_objeto_py2($id_programacion);
        //print_r($data4);die;
        
        $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion); 
        
        $data = $this->Programacion_model->enviar_snc($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5);
        print_r($data);die;
        //echo json_encode($data);
    }


    /////////////////enviar Reprogramacion al snc, cambia el status
    public function enviar_snc_reprogramacion(){
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data = $this->input->post();
        
        $des_unidad = $this->session->userdata('unidad');
        $codigo_onapre = $this->session->userdata('codigo_onapre');
        $rif = $this->session->userdata('rif_organoente');
        $id_programacion = $data['id'];
        
        
        $data2 = $this->Programacion_model->consulta_total_objeto_acc($id_programacion);
        
        $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
       
        $data4 = $this->Programacion_model->consulta_total_objeto_py2($id_programacion);
        
        $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion); 
        
        $data = $this->Programacion_model->enviar_snc_reprogramacion($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5);
        print_r($data);die;
        // $data = $this->input->post();
        // $data = $this->Programacion_model->enviar_snc_reprogramacion($data);
        // echo json_encode($data);
    }
///////////////enviar rendicion
public function enviar_rendi8()
  {
    if(!$this->session->userdata('session')) {
        redirect('login');
    }
    $data = $this->input->post();
    
    $des_unidad = $this->session->userdata('unidad');
    $codigo_onapre = $this->session->userdata('codigo_onapre');
    $rif = $this->session->userdata('rif_organoente');
    $id_programacion = $data['id'];
    
    
    $data2 = $this->Programacion_model->consulta_total_objeto_acc_rendi($id_programacion);
    
    $data3 = $this->Programacion_model->consulta_total_accrendi($id_programacion);
   
    $data4 = $this->Programacion_model->consulta_total_objeto_py2rendi($id_programacion);
    //print_r($data4);die;
    
    $data5 = $this->Programacion_model->consulta_total_PYTrendi($id_programacion); 
    
    $data = $this->Programacion_model->enviar_snc_rendi($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5);
    print_r($data);die;
    //echo json_encode($data);
}
public function enviar_rendi()
  {
    if(!$this->session->userdata('session')) {
        redirect('login');
    }
    $data = $this->input->post();
    
    $des_unidad = $this->session->userdata('unidad');
    $codigo_onapre = $this->session->userdata('codigo_onapre');
    $rif = $this->session->userdata('rif_organoente');
    $id_programacion = $data['id'];
    $trimestre = $data['trimestre'];

    
    
    $data2 = $this->Programacion_model->consulta_total_objeto_acc_rendi_f($id_programacion,$trimestre);
    
    $data3 = $this->Programacion_model->consulta_total_accrendi2_f($id_programacion,$trimestre);
   
    $data4 = $this->Programacion_model->consulta_total_objeto_py2rendi_f($id_programacion,$trimestre);
    //print_r($data4);die;
    
    $data5 = $this->Programacion_model->consulta_total_PYTrendi_f($id_programacion,$trimestre); 
    
    $data = $this->Programacion_model->enviar_snc_rendi($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5);
    print_r($data);die;
    //echo json_encode($data);
}
    /////////////////////////////////////// Reprogramacion
 
        public function reprogramar(){
            if(!$this->session->userdata('session'))redirect('login');
    
            $data['unidad'] = $this->session->userdata('id_unidad');
            $data['des_unidad'] = $this->session->userdata('unidad');
            $data['rif'] = $this->session->userdata('rif');
            $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
            $unidad = $this->session->userdata('id_unidad');
    
            $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
            $data['fecha'] = date('yy');
    
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/reprogramacion/reprogramacion.php', $data);
            $this->load->view('templates/footer.php');
        }



        public function consultar_item_reprogramacion(){
            if(!$this->session->userdata('session'))redirect('login');
            //Información traido por el session de usuario para mostrar inf
            $data['unidad'] = $this->session->userdata('id_unidad');
            $data['des_unidad'] = $this->session->userdata('unidad');
            $data['rif'] = $this->session->userdata('rif');
            $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
            $unidad = $this->session->userdata('id_unidad');
            $data['id_programacion'] = $this->input->get('id');
    
            $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
            $data['anio'] = $data['programacion_anio']['anio'];
    
            //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
            $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos($data['id_programacion']);
            $data['ver_acc_centralizada'] = $this->Programacion_model->consultar_acc_centralizada($data['id_programacion']);
            $data['totalespartida'] = $this->Programacion_model->total_por_partidas($data['id_programacion']);
    
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/reprogramacion/reprogramaitems.php', $data);
            $this->load->view('templates/footer.php');
        }
///////////////////////////reprogramar Accion centralizada items
        public function reprogramar_items_() {
            $data['unidad'] = $this->session->userdata('id_unidad');
            $data['des_unidad'] = $this->session->userdata('unidad');
            $data['rif'] = $this->session->userdata('rif');
            $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
        
            $parametros         = $this->input->get('id');
            $separar        = explode("/", $parametros);
            $data['id_p_acc_centralizada']  = $separar['0'];
            $id_obj_comercial = $separar['1'];
            $data['id_programacion'] = $separar['2'];
        
           //Se pregunta y depende de la actividad comercial muestra la vista correspondiente------------------------
                if ($id_obj_comercial == '2') {
                    //SERVICIO
                    //$data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);
        
                    //Proyecto
                    $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                    $data['fuente'] = $this->Programacion_model->consulta_fuente();
                    $data['act_com'] = $this->Programacion_model->consulta_act_com();
                    $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                    $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                    $data['unid'] 	= $this->Programacion_model->consulta_unid();
                    $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                    //ACCION CENTRALIZADA
                    $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                    $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                    //informacion accion centralizada
                    $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
                    $data['accion'] = $this->Programacion_model->consultar_scc($data['id_p_acc_centralizada']);
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/navigator.php');
                    $this->load->view('programacion/reprogramacion/agregar_acc.php', $data);
                    $this->load->view('templates/footer.php');
        
                }elseif ($id_obj_comercial == '1'){    
                     //BIEN
        
                     $data['accion'] = $this->Programacion_model->consultar_scc($data['id_p_acc_centralizada']);
                     $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                     $data['fuente'] = $this->Programacion_model->consulta_fuente();
                     $data['act_com'] = $this->Programacion_model->consulta_act_com();
                     $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                     $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                     $data['unid'] 	= $this->Programacion_model->consulta_unid();
                     $data['iva'] 	= $this->Programacion_model->consulta_iva();
     
                     $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                     $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
     
                     $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
     
                    
                     //////////////////////////////////////////////////////////////
                     $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                     $data['fuente'] = $this->Programacion_model->consulta_fuente();
                     $data['act_com'] = $this->Programacion_model->consulta_act_com();
                     $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                     $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                     $data['unid'] 	= $this->Programacion_model->consulta_unid();
                     $data['iva'] 	= $this->Programacion_model->consulta_iva();
     
                     $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                     $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
     
                     $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
                        ////////////////////////////////////////////////////////////////
        
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/reprogramacion/reprogramar_bien_acc.php', $data);
            $this->load->view('templates/footer.php');
            }
                    elseif ($id_obj_comercial == '3') {
                        //OBRA
                        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                        $data['fuente'] = $this->Programacion_model->consulta_fuente();
                        $data['act_com'] = $this->Programacion_model->consulta_act_com();
                        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                        $data['unid'] 	= $this->Programacion_model->consulta_unid();
                        $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                        $data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
                        $data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
                        $data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();
        
                        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                        $data['accion'] = $this->Programacion_model->consultar_tems_obras($data['id_p_acc_centralizada']);
                        $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
        
                        $this->load->view('templates/header.php');
                        $this->load->view('templates/navigator.php');
                        $this->load->view('programacion/reprogramacion/reprogr_acc_obra.php', $data);
                        $this->load->view('templates/footer.php');
                    }
        
        }
        public function reprogramar_item_servicio_acc(){
            if(!$this->session->userdata('session'))redirect('login');
            $data['unidad'] = $this->session->userdata('id_unidad');
            $data['des_unidad'] = $this->session->userdata('unidad');
            $data['rif'] = $this->session->userdata('rif');
            $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
            $data['time']=date("d-m-Y");
        
            $parametros              = $this->input->get('id');
            $separar                 = explode("/", $parametros);
            $data['id']   = $separar['0'];
            $data['id_p_items']       = $separar['1'];
            
            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
            //ACCION CENTRALIZADA
            $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
            //informacion accion centralizada
            // $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
            $data['accion'] = $this->Programacion_model->consultar_itms_serv($data['id_p_items']);
        
        
        
        
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/reprogramacion/reprogramar_edit_item_servico.php', $data);
            $this->load->view('templates/footer.php');
        }
    //////////guardar items mmodificados reprogramacion
        public function guardar_items_modificados_servi_reprogr(){
            if(!$this->session->userdata('session'))redirect('login');
            $id_programacion= $this->input->post("id_programacion");
            $id_p_items = $this->input->post("id_p_items");
            $especificacion = $this->input->post("especificacion");
            $id_unidad_medida = $this->input->post("id_unidad_medida");
            $fecha_desde = $this->input->post("start");
            $fecha_hasta = $this->input->post("end");
            $I = $this->input->post("I");
            $II = $this->input->post("II");
            $III = $this->input->post("III");
            $IV = $this->input->post("IV");
            $cant_total_distribuir = $this->input->post("cant_total_distribuir");
            $precio_total = $this->input->post("precio_total");
                   
            $id_alicuota_iva = $this->input->post("id_alicuota_iva"); 
            $explode = explode('/', $id_alicuota_iva);
            $id_iva = $explode['0'];
            $iva = $explode['1'];
            $iva_estimado = $this->input->post("iva_estimado"); 
            $monto_estimado = $this->input->post("monto_estimado");
            $est_trim_1 = $this->input->post("estimado_i");
            $est_trim_2 = $this->input->post("estimado_ii");
            $est_trim_3 = $this->input->post("estimado_iii");
            $est_trim_4 = $this->input->post("estimado_iV");
            $estimado_total_t_acc = $this->input->post("estimado_total_t");
            // $fecha_pago  = $this->input->post("fecha_pago");
    
           
    
            $itm_serv = array(
                    
                "especificacion"   => $especificacion,
                "id_unidad_medida"     => $id_unidad_medida,
                "fecha_desde"       => $fecha_desde,
                "fecha_hasta"          => $fecha_hasta,
                "i"          => $I,
                "ii"         => $II,
                "iii"        => $III,
                "iv"         => $IV,
                "cantidad"         => $cant_total_distribuir,            
                "cant_total_distribuir"        => $cant_total_distribuir,
                "precio_total"         => $precio_total,
                "alicuota_iva"          => $id_iva,
                "iva_estimado"         => $iva_estimado,
                "monto_estimado"     => $monto_estimado,
                "est_trim_1"        => $est_trim_1,
                "est_trim_2"           => $est_trim_2,
                "est_trim_3"     => $est_trim_3,   
                "est_trim_4"    => $est_trim_4,      
                "estimado_total_t_acc"    => $estimado_total_t_acc,
                "estatus_rendi"    => 0,// fue reprogramado
                "reprogramado"    => 1,// fue reprogramado
                "fecha_reprogramacion"    => date("Y-m-d")           
            ); 
            $id_programaciones = array(
                'id_programacion'  => $this->input->post('id_programacion'),
                'estatus' 	=> 2,//solo cambie cuando se envie al snc la reprogramacion
                'fecha'=> date('Y-m-d')
               
            );
            $data = $this->Programacion_model->Reprogrma_guardar_items_modificados_servi($id_p_items,$itm_serv,$id_programaciones);
           if ($data) {
               $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
               redirect('programacion/reprogramar');
           }else{
                 $this->session->set_flashdata('sa-error', 'error');
                redirect('programacion/reprogramar');
             }
        }

        public function Guardar_mas_item_acc_servicio2() {
            if (!$this->session->userdata('session'))
                redirect('login');
                
                $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
                $separar                 = explode("/", $par_presupuestaria_acc);
                $id_presupuestaria        = $separar['0'];
                $id_p_acc_centralizada   = $separar['1'];
                
                $id_programacion = $this->input->POST('id_programacion');
                $separar                 = explode("/", $id_programacion);
                $id_programacion        = $separar['0'];
                $id_programacion2   = $separar['1'];
                $id_programacion4   = $separar['2'];
        
                $id_programacion3 = 30;//id_programacion     
                
                $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
                $separar                 = explode("/", $id_unidad_medida_acc);
                $id_unidad_medida_acc1        = $separar['0'];
                $id_p_acc_centralizada   = $separar['1'];
        
                $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
                $separar                 = explode("/", $id_alicuota_iva_acc);
                $id_alicuota_iva_acc1       = $separar['0'];
                $id_alicuota_iva_acc2   = $separar['1'];
        
                $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
                $separar                 = explode("/", $id_ccnu_acc);
                $id_ccnu_acc1        = $separar['0'];
                $id_ccnu_acc2   = $separar['1'];
        
                $id_estado = $this->input->POST('id_estado');
                $separar                 = explode("/", $id_estado);
                $id_estado1       = $separar['0'];
                $id_estado2   = $separar['1'];
        
                $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
                $separar                 = explode("/", $fuente_financiamiento_acc);
                $fuente_financiamiento_acc1       = $separar['0'];
                $fuente_financiamiento_acc2   = $separar['1'];
        
                $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
                $separar                 = explode("/", $par_presupuestaria_acc);
                $par_presupuestaria_acc1       = $separar['0'];
                $par_presupuestaria_acc2   = $separar['1'];
        
           $data = array(
        
           
                 'id_enlace'=> $this->input->post('id_programacion'),//
                 'id_p_acc'=> 1,
                 'id_tip_obra'=> '0',
                 'id_alcance_obra'=> '0',
                 'id_obj_obra'=> '0',
                 'fecha_desde'=> $this->input->post('fecha_desde'),
                 'fecha_hasta'=> $this->input->post('fecha_hasta'),
                'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
                'id_ccnu' 		         => $id_ccnu_acc1,
                'especificacion' 		 => $this->input->post('especificacion_acc'),
                'id_unidad_medida' 		 => $id_unidad_medida_acc1,
                'cantidad' 		 => 1,
                'i' 		             => $this->input->post('I'),
                'ii' 		             => $this->input->post('II'),
                'iii' 		             => $this->input->post('III'),
                'iv' 		             => $this->input->post('IV'),
                'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
                'precio_total' 		     => $this->input->post('precio_total'),
                'alicuota_iva' 		 => $id_alicuota_iva_acc1,
                'iva_estimado' 		     => $this->input->post('iva_estimado'),
                'costo_unitario' 		 => 0,
                'monto_estimado' 		 => $this->input->post('monto_estimado'),
                'est_trim_1' 		 => $this->input->post('estimado_i'),
                'est_trim_2' 		 => $this->input->post('estimado_ii'),
                'est_trim_3' 		 => $this->input->post('estimado_iii'),
                'est_trim_4' 		 => $this->input->post('estimado_iV'),
                'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
                'estatus_rendi' 		 => 0,
                'reprogramado' 		 =>1,
                'fecha_reprogramacion' 		 =>date('Y-m-d'),
                'id_proyecto' 		 => $this->input->post('id_programacion3'),
                'id_obj_comercial' 		 => $this->input->post('id_obj_comercial'),
                'observaciones' 		 => $this->input->post('observaciones'),

                
              
        
            );
          
            $p_ffinanciamiento = array(
                'id_estado'   		        => $this->input->post('id_estado_acc'),
                'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
                'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
                'porcentaje' 	            => $this->input->post('porcentaje_acc'),
                'id_enlace'=> $this->input->post('id_programacion'),
                'id_p_acc'=> '0',
            );
            $id_programaciones = array(
                'id_programacion'  => $this->input->post('id_programacion3'),
                'estatus' 	=> 2,
                'fecha'=> date('Y-m-d')
               
            );
        
            $data = $this->Programacion_model->Guardar_mas_item_acc_servicio2($data,$p_ffinanciamiento, $id_programaciones);
            echo json_encode($data);
        }

        // public function hojaEnBlanco() //hacer un pdf
        // {
        //   //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
        //      //Se agrega la clase desde thirdparty para usar FPDF
        //      require_once APPPATH.'third_party/fpdf/fpdf.php';
                
        //      $pdf = new FPDF();
        //      $pdf->AddPage('P','A4',0);
        //      $pdf->SetFont('Arial','B',12);
        //      $pdf->Cell(0,0,'Hola mundo FPDF desde Codeigniter',0,1,'C');
        //      $pdf->Output('result.pdf', 'D');
        //     $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);

        // }

        public function Llamado() //hacer un pdf
        {
          //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
             //Se agrega la clase desde thirdparty para usar FPDF
             require_once APPPATH.'third_party/fpdf/fpdf.php';
           //  $unidad
             
             $pdf = new FPDF();
             $pdf->AddPage('P','A4',0);
             $pdf->SetFont('Arial','B',12);
            // $pdf->Cell(0,0,'Hola mundo FPDF desde Codeigniter',0,1,'C');
             $pdf->Cell(195,10,'LLamado',0,1,'C');
             $pdf->Cell(65,10,'descripcion',1,0,'C');


                $data1 = $this->input->get('id');
                $data = $this->Programacion_model->pdf_rendir($data1);
                foreach($data as $d){
                    $pdf->SetFont('Arial','',10);
                    
                    $pdf->Cell(65,10, $d->rif_organoente,1,0,'C');
                
                // $slno = $slno+1;
                }
                $curdate = date('d-m-Y His');
                $pdf->Output('product_report'.$curdate.'.pdf', 'I');
        }


        // public function reporte432() {
        //     $html = $this->load->view('programacion/rendicion/rendiciones.php');
        //     $this->load->library('third_party/dompdf');
        //     $this->pdf_dompdf->load_html(preg_replace('/>\s+</', '><', $html));
        //     $this->pdf_dompdf->render();
        //     $this->pdf_dompdf->stream("reporte.pdf", array("Attachment" => 0));
        // }


///////////////////////////////////rendiciones solo se deben de ver aquellas que puedan ser rendidas osea en estatus 2  o estatus 3
        public function rendiciones(){
            if(!$this->session->userdata('session'))redirect('login');                                                  
    
            $data['unidad'] = $this->session->userdata('id_unidad');
            $data['des_unidad'] = $this->session->userdata('unidad');
            $data['rif'] = $this->session->userdata('rif');
            $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
            $unidad = $this->session->userdata('id_unidad');
    
            $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
            $data['fecha'] = date('yy');
    
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/rendicion/rendiciones.php', $data);
            $this->load->view('templates/footer.php');
        }
        public function consultar_item_rendir(){
            if(!$this->session->userdata('session'))redirect('login');
            //Información traido por el session de usuario para mostrar inf
            $data['unidad'] = $this->session->userdata('id_unidad');
            $data['des_unidad'] = $this->session->userdata('unidad');
            $data['rif'] = $this->session->userdata('rif');
            $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
            $unidad = $this->session->userdata('id_unidad');
            $data['id_programacion'] = $this->input->get('id');
    
            $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
            $data['anio'] = $data['programacion_anio']['anio'];
    
            //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
            $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos555($data['id_programacion']);
            $data['ver_acc_centralizada'] = $this->Programacion_model->consultar_acc_centralizada5($data['id_programacion']);
            $data['totalespartida'] = $this->Programacion_model->total_por_partidas($data['id_programacion']);
    
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/rendicion/rendiritems.php', $data);
            $this->load->view('templates/footer.php');
        }

        /////////////ver item a rendir 
        public function rendir_items_() {
            $data['unidad'] = $this->session->userdata('id_unidad');
            $data['des_unidad'] = $this->session->userdata('unidad');
            $data['rif'] = $this->session->userdata('rif');
            $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
        
            $parametros         = $this->input->get('id');
            $separar        = explode("/", $parametros);
            $data['id_p_acc_centralizada']  = $separar['0'];
            $id_obj_comercial = $separar['1'];
            $data['id_programacion'] = $separar['2'];
            $id_trimestre = $separar['3'];
        
           //Se pregunta y depende de la actividad comercial muestra la vista correspondiente------------------------
                if ($id_obj_comercial == '2') {
                    //SERVICIO
                    //$data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);
                  if($id_trimestre =='1'){
                    //Proyecto
                    $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                    $data['fuente'] = $this->Programacion_model->consulta_fuente();
                    $data['act_com'] = $this->Programacion_model->consulta_act_com();
                    $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                    $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                    $data['unid'] 	= $this->Programacion_model->consulta_unid();
                    $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                    //ACCION CENTRALIZADA
                    $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                    $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                    //informacion accion centralizada
                    $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
                    $data['rendir_serv_acc'] = $this->Programacion_model->rendir_serv_acc($data['id_p_acc_centralizada']);
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/navigator.php');
                    $this->load->view('programacion/rendicion/servicio/rendir_servicio_acc.php', $data);
                    $this->load->view('templates/footer.php');
                   }elseif($id_trimestre =='2'){
                    $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                    $data['fuente'] = $this->Programacion_model->consulta_fuente();
                    $data['act_com'] = $this->Programacion_model->consulta_act_com();
                    $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                    $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                    $data['unid'] 	= $this->Programacion_model->consulta_unid();
                    $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                    //ACCION CENTRALIZADA
                    $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                    $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                    //informacion accion centralizada
                    $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
                    $data['rendir_serv_acc'] = $this->Programacion_model->rendir_serv_acc2($data['id_p_acc_centralizada']);
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/navigator.php');
                    $this->load->view('programacion/rendicion/servicio/rendir_servicio_acc.php', $data);
                    $this->load->view('templates/footer.php');
                    
                   }
                   elseif($id_trimestre =='3'){
                    $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                    $data['fuente'] = $this->Programacion_model->consulta_fuente();
                    $data['act_com'] = $this->Programacion_model->consulta_act_com();
                    $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                    $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                    $data['unid'] 	= $this->Programacion_model->consulta_unid();
                    $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                    //ACCION CENTRALIZADA
                    $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                    $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                    //informacion accion centralizada
                    $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
                    $data['rendir_serv_acc'] = $this->Programacion_model->rendir_serv_acc3($data['id_p_acc_centralizada']);
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/navigator.php');
                    $this->load->view('programacion/rendicion/servicio/rendir_servicio_acc.php', $data);
                    $this->load->view('templates/footer.php');
                    
                   }
                   elseif($id_trimestre =='4'){
                    $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                    $data['fuente'] = $this->Programacion_model->consulta_fuente();
                    $data['act_com'] = $this->Programacion_model->consulta_act_com();
                    $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                    $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                    $data['unid'] 	= $this->Programacion_model->consulta_unid();
                    $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                    //ACCION CENTRALIZADA
                    $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                    $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                    //informacion accion centralizada
                    $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
                    $data['rendir_serv_acc'] = $this->Programacion_model->rendir_serv_acc4($data['id_p_acc_centralizada']);
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/navigator.php');
                    $this->load->view('programacion/rendicion/servicio/rendir_servicio_acc.php', $data);
                    $this->load->view('templates/footer.php');
                    
                   }

                }elseif ($id_obj_comercial == '1'){    
                     //BIEN
        
                        $data['accion'] = $this->Programacion_model->consultar_scc($data['id_p_acc_centralizada']);
                        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                        $data['fuente'] = $this->Programacion_model->consulta_fuente();
                        $data['act_com'] = $this->Programacion_model->consulta_act_com();
                        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                        $data['unid'] 	= $this->Programacion_model->consulta_unid();
                        $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
        
                        $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
        
        
                        //////////////////////////////////////////////////////////////
                        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                        $data['fuente'] = $this->Programacion_model->consulta_fuente();
                        $data['act_com'] = $this->Programacion_model->consulta_act_com();
                        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                        $data['unid'] 	= $this->Programacion_model->consulta_unid();
                        $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
        
                        $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
                        ////////////////////////////////////////////////////////////////
        
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/bien/agregar_itm_acc.php', $data);
            $this->load->view('templates/footer.php');
            }
                    elseif ($id_obj_comercial == '3') {
                        //OBRA
                        $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                        $data['fuente'] = $this->Programacion_model->consulta_fuente();
                        $data['act_com'] = $this->Programacion_model->consulta_act_com();
                        $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                        $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                        $data['unid'] 	= $this->Programacion_model->consulta_unid();
                        $data['iva'] 	= $this->Programacion_model->consulta_iva();
        
                        $data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
                        $data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
                        $data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();
        
                        $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                        $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                        $data['accion'] = $this->Programacion_model->consultar_tems_obras($data['id_p_acc_centralizada']);
                        $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
        
                        $this->load->view('templates/header.php');
                        $this->load->view('templates/navigator.php');
                        $this->load->view('programacion/obra/agregar_items_accobra.php', $data);
                        $this->load->view('templates/footer.php');
                    }
        
        }


        //////mostrar datos en el modal para rendir servicio/////////////////////
public function consultar_item_modal_servicio(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->consultar_items_servicio_acc_rendir($data);
    echo json_encode($data);
}


        //////mostrar datos en el modal para rendir servicio/////////////////////
        public function consultar_item_modal_PY_bienes(){
            if(!$this->session->userdata('session'))redirect('login');
            $data = $this->input->post();
            $data =	$this->Programacion_model->consultar_item_modal_PY_bienes($data);
            echo json_encode($data);
        }
//////////////// guardar rendicion servicio

public function guardar_rendi_servicio_acc() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
        'rif_organoente' => $this->session->userdata('rif_organoente'),
        'id_programacion' => $this->input->POST('id_programacion2'),
        'id_enlace' => $this->input->POST('id_enlace1'),
        'id_p_acc' => 1,//es una acc
        'id_proyecto' => 0,//es un proyecto
        'codigopartida_presupuestaria' => $this->input->POST('codigopartida_presupuestaria'),
        'id_p_items' => $this->input->POST('id_p_items'),
        'desc_partida_presupuestaria' => $this->input->POST('desc_partida_presupuestaria'),
        'codigo_ccnu' => $this->input->POST('codigo_ccnu'),
        'desc_ccnu' => $this->input->POST('desc_ccnu'),
        'id_accion_centralizada' => $this->input->POST('id_accion_centralizada1'),
        'desc_accion_centralizada' => $this->input->POST('desc_accion_centralizada1'),
        'id_obj_comercial' => $this->input->POST('id_obj_comercial2'),
        'desc_objeto_contrata' => $this->input->POST('desc_objeto_contrata2'),
        'estado' => $this->input->POST('id_estado'),
        'id_fuente_financiamiento' => $this->input->POST('id_fuente_financiamiento'),
        'porcentaje' => $this->input->POST('porcentaje'),
        'desc_fuente_financiamiento' => $this->input->POST('desc_fuente_financiamiento'),
        'id_tip_obra' => 0,
        'id_alcance_obra' => 0,
        'id_obj_obra' => 0,
        'fecha_desde' => $this->input->POST('fecha_desde'),
        'fecha_hasta' => $this->input->POST('fecha_hasta'),
        'especificacion' => $this->input->POST('especificacion'),
        'id_unidad_medida' => $this->input->POST('id_unid_med_b'),
        'cantidad' => 1,
        'i' => $this->input->POST('primero_b'),
        'ii' => $this->input->POST('segundo_b'),
        'iii' => $this->input->POST('tercero_b'),
        'iv' => $this->input->POST('cuarto_b'),
        'cant_total_distribuir' => 0,
        'costo_unitario' => $this->input->POST('precio_total_mod_b'),
       
        'precio_total' => $this->input->POST('precio_total_mod_b'),
        'alicuota_iva' => $this->input->POST('ali_iva_e_b'),
        'iva_estimado' => $this->input->POST('iva_estimado_mod_b'),
        'monto_estimado' => $this->input->POST('monto_estimado_mod_b'),
        'est_trim_1' => $this->input->POST('estimado_i'),
        'est_trim_2' => $this->input->POST('estimado_ii'),
        'est_trim_3' => $this->input->POST('estimado_iii'),
        'est_trim_4' => $this->input->POST('estimado_iV'),
        'estimado_total_t_acc' => $this->input->POST('estimado_total_t'),

        'cantidad_ejecu' => $this->input->POST('cantidad0'),
        'costo_unitario_rend_ejecu' => $this->input->POST('precio_rend_ejecu'),
        'precio_rend_ejecu' => $this->input->POST('precio_rend_ejecu'),
        'selc_iva_rendi' => $this->input->POST('selc_iva_rendi'),
        'iva_estimado_rend' => $this->input->POST('iva_estimado_rend'),
        'total_rendi' => $this->input->POST('total_rendi'),
        'paridad_rendi' => $this->input->POST('paridad_rendi'),
        'subtotal_rendi' => $this->input->POST('subtotal_rendi'),
        'id_modalida_rendi' => $this->input->POST('modalida_rendi'),
        'supuestos_procedimiento' => $this->input->POST('id_sub_modalidad0'),
        
        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre'),
        'nombre_contratista' => $this->input->POST('nombre_conta_0'),

        'num_contrato' => $this->input->POST('num_contrato'),
        'fecha_contrato' => $this->input->POST('fecha_contrato'),
        'selc_tipo_doc_contrata' => $this->input->POST('selc_tipo_doc_contrata'),
        'selc_com_res_social' => $this->input->POST('selc_com_res_social'),
        'monto3_rendim' => $this->input->POST('monto3_rendi'),
        'nfactura_rendi' => $this->input->POST('nfactura_rendi'),
        'datefactura_rendi' => $this->input->POST('datefactura_rendi'),
        'base_imponible_rendi' => $this->input->POST('base_imponible_rendi'),
        'selc_iva_rendi2' => $this->input->POST('selc_iva_rendi2'),
        'monto_factura_rend' => $this->input->POST('monto_factura_rend'),
        'total_pago_rendi' => $this->input->POST('total_pago_rendi'),        
        'paridad_rendi_factura' => $this->input->POST('paridad_rendi_factura'),
        'subtotal_rendi_factura' => $this->input->POST('subtotal_rendi_factura'),
        'fecha_pago_rendi' => $this->input->POST('fecha_pago_rendi'),
        'estatus' => 4,
        'fecha_rendicion' => date("Y-m-d"), 
        'fecha_cam_estatus' => date("Y-m-d"), 
        'id_usuario' => $this->session->userdata('id_user'),
        'fecha30dias_notificacion' => date("Y-m-d"),
        'trimestre' => $this->input->POST('llenar_trimestre'),
        'snc' => 0,
       // 'id_tipo_pago' => $this->input->POST('id_tipo_pago0'),//cuando sea 1 no guardar el rif de contratista, cuando sea 2 guardar razon social en 
        'facturacion5' => $this->input->POST('facturacion0'),
        'razon_social_no_rnc' => $this->input->POST('razon_social50'),
        'rif_contr_no_rnc' => $this->input->POST('rif_50'),

    );
    $id_p_itemss = array(
              'estatus_rendi' 	=> $this->input->POST('llenar_trimestre'),//trimestre que rindio     
    );
   

    $data = $this->Programacion_model->guardar_rendi_servicio_acc($data,$id_p_itemss);
    echo json_encode($data);
}
// guardar rendir obra acc
public function guardar_rendi_obra_acc() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
        'rif_organoente' => $this->session->userdata('rif_organoente'),
        'id_programacion' => $this->input->POST('id_programacion3'),
        'id_enlace' => $this->input->POST('id_enlace3'),
        'id_p_acc' => 1,//es una acc
        'id_proyecto' => 0,// revisar que es esto
        'codigopartida_presupuestaria' => $this->input->POST('codigopartida_presupuestaria3'),
        'id_p_items' => $this->input->POST('id_p_items3'),
        'desc_partida_presupuestaria' => $this->input->POST('desc_partida_presupuestaria3'),
        'codigo_ccnu' => 0,
        'desc_ccnu' => 0,
        'id_accion_centralizada' => $this->input->POST('id_accion_centralizada3'),
        'desc_accion_centralizada' => $this->input->POST('desc_accion_centralizada3'),
        'id_obj_comercial' => $this->input->POST('id_obj_comercial3'),
        'desc_objeto_contrata' => $this->input->POST('desc_objeto_contrata3'),
        'estado' => $this->input->POST('id_estado3'),
        'id_fuente_financiamiento' => $this->input->POST('id_fuente_financiamiento3'),
        'porcentaje' => $this->input->POST('porcentaje3'),
        'desc_fuente_financiamiento' => $this->input->POST('desc_fuente_financiamiento3'),
        'id_tip_obra' => $this->input->POST('id_tip_obra'),
        'id_alcance_obra' => $this->input->POST('id_alcance_obra'),
        'id_obj_obra' => $this->input->POST('id_obj_obra'),
        'fecha_desde' => $this->input->POST('fecha_desde3'),
        'fecha_hasta' => $this->input->POST('fecha_hasta3'),
        'especificacion' => $this->input->POST('especificacion3'),
        'id_unidad_medida' => $this->input->POST('id_unid_med_b3'),
        'cantidad' => 0,
        'i' => $this->input->POST('primero_b3'),
        'ii' => $this->input->POST('segundo_b3'),
        'iii' => $this->input->POST('tercero_b3'),
        'iv' => $this->input->POST('cuarto_b3'),
        'cant_total_distribuir' => 0,
        'costo_unitario' => $this->input->POST('precio_total_mod_b3'),

        'precio_total' => $this->input->POST('precio_total_mod_b3'),
        'alicuota_iva' => $this->input->POST('ali_iva_e_b3'),
        'iva_estimado' => $this->input->POST('iva_estimado_mod_b3'),
        'monto_estimado' => $this->input->POST('monto_estimado_mod_b3'),
        'est_trim_1' => $this->input->POST('estimado_i3'),
        'est_trim_2' => $this->input->POST('estimado_ii3'),
        'est_trim_3' => $this->input->POST('estimado_iii3'),
        'est_trim_4' => $this->input->POST('estimado_iV3'),
        'estimado_total_t_acc' => $this->input->POST('estimado_total_t3'),
        'cantidad_ejecu' => $this->input->POST('cantidad3'),

        'costo_unitario_rend_ejecu' => $this->input->POST('precio_rend_ejecu3'),
        'precio_rend_ejecu' => $this->input->POST('precio_rend_ejecu3'),
        'selc_iva_rendi' => $this->input->POST('selc_iva_rendi3'),
        'iva_estimado_rend' => $this->input->POST('iva_estimado_rend3'),
        'total_rendi' => $this->input->POST('total_rendi3'),
        'paridad_rendi' => $this->input->POST('paridad_rendi3'),
        'subtotal_rendi' => $this->input->POST('subtotal_rendi3'),
        'id_modalida_rendi' => $this->input->POST('modalida_rendi3'),
        'supuestos_procedimiento' => $this->input->POST('id_sub_modalidad3'),

        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre3'),
        'nombre_contratista' => $this->input->POST('nombre_conta_3'),

        'num_contrato' => $this->input->POST('num_contrato3'),
        'fecha_contrato' => $this->input->POST('fecha_contrato3'),
        'selc_tipo_doc_contrata' => $this->input->POST('selc_tipo_doc_contrata3'),
        'selc_com_res_social' => $this->input->POST('selc_com_res_social3'),
        'monto3_rendim' => $this->input->POST('monto3_rendi3'),
        'nfactura_rendi' => $this->input->POST('nfactura_rendi3'),
        'datefactura_rendi' => $this->input->POST('datefactura_rendi3'),
        'base_imponible_rendi' => $this->input->POST('base_imponible_rendi3'),
        'selc_iva_rendi2' => $this->input->POST('selc_iva_rendi4'),
        'monto_factura_rend' => $this->input->POST('monto_factura_rend3'),
        'total_pago_rendi' => $this->input->POST('total_pago_rendi3'),        
        'paridad_rendi_factura' => $this->input->POST('paridad_rendi_factura3'),
        'subtotal_rendi_factura' => $this->input->POST('subtotal_rendi_factura3'),
        'fecha_pago_rendi' => $this->input->POST('fecha_pago_rendi3'),
        'estatus' => 4,
        'fecha_rendicion' => date("Y-m-d"), 
        'fecha_cam_estatus' => date("Y-m-d"), 
        'id_usuario' => $this->session->userdata('id_user'),
        'fecha30dias_notificacion' => date("Y-m-d"),
        'trimestre' => $this->input->POST('llenar_trimestre3'),
        'snc' => 0,
        //'id_tipo_pago' => $this->input->POST('id_tipo_pago3'),//cuando sea 1 no guardar el rif de contratista, cuando sea 2 guardar razon social en 
        'facturacion5' => $this->input->POST('facturacion3'),
        'razon_social_no_rnc' => $this->input->POST('razon_social3'),
        'rif_contr_no_rnc' => $this->input->POST('rif_3'),

    );
    $id_p_itemss = array(
              'estatus_rendi' 	=> $this->input->POST('llenar_trimestre3'),//trimestre que rindio     
    );
   

    $data = $this->Programacion_model->guardar_rendi_servicio_acc($data,$id_p_itemss);
    echo json_encode($data);
}
/////////Guardar Rendicion Accion centralizada
public function guardar_rendi_bienes_acc() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
        'rif_organoente' => $this->session->userdata('rif_organoente'),
        'id_programacion' => $this->input->POST('id_programacion5'),
        'id_enlace' => $this->input->POST('id_enlace5'),
        'id_p_acc' => 1,//es una acc
        'id_proyecto' => 0,//como no trae proyecto lo guardo como 0
        'nombre_proyecto' => 0,//como no trae proyecto lo guardo como 0
        'codigopartida_presupuestaria' => $this->input->POST('codigopartida_presupuestaria5'),
        'id_p_items' => $this->input->POST('id_p_items5'),
        'desc_partida_presupuestaria' => $this->input->POST('desc_partida_presupuestaria5'),
        'codigo_ccnu' => $this->input->POST('codigo_ccnu5'),
        'desc_ccnu' => $this->input->POST('desc_ccnu5'),
        'id_accion_centralizada' => $this->input->POST('id_accion_centralizada5'),
        'desc_accion_centralizada' => $this->input->POST('desc_accion_centralizada5'),
        'id_obj_comercial' => $this->input->POST('id_obj_comercial5'),
        'desc_objeto_contrata' => $this->input->POST('desc_objeto_contrata5'),
        'estado' => $this->input->POST('id_estado5'),
        'id_fuente_financiamiento' => $this->input->POST('id_fuente_financiamiento5'),
       
        'desc_fuente_financiamiento' => $this->input->POST('desc_fuente_financiamiento5'),
        'id_tip_obra' => $this->input->POST('id_tip_obra'),
        'id_alcance_obra' => $this->input->POST('id_alcance_obra'),
        'id_obj_obra' =>$this->input->POST('id_obj_obra'),
        'fecha_desde' =>$this->input->POST('fecha_desde'),
        'fecha_hasta' =>$this->input->POST('fecha_hasta'),
        'especificacion' => $this->input->POST('especificacion5'),
        'id_unidad_medida' => $this->input->POST('id_unid_med_b5'),
        'fecha_desde' =>$this->input->POST('fecha_desde'),
        'fecha_hasta' =>$this->input->POST('fecha_hasta'),
        'cantidad' => $this->input->POST('cantidad_mod_b5'),
        'i' => $this->input->POST('primero_b5'),
        'ii' => $this->input->POST('segundo_b5'),
        'iii' => $this->input->POST('tercero_b5'),
        'iv' => $this->input->POST('cuarto_b5'),
        'cant_total_distribuir' => 0,

        'costo_unitario' => $this->input->POST('costo_unitario_mod_b5'),
       
        'precio_total' => $this->input->POST('precio_total_mod_b5'),
        'alicuota_iva' => $this->input->POST('ali_iva_e_b5'),
        'iva_estimado' => $this->input->POST('iva_estimado_mod_b5'),
        'monto_estimado' => $this->input->POST('monto_estimado_mod_b5'),
        'est_trim_1' => $this->input->POST('estimado_i5'),
        'est_trim_2' => $this->input->POST('estimado_ii5'),
        'est_trim_3' => $this->input->POST('estimado_iii5'),
        'est_trim_4' => $this->input->POST('estimado_iV5'),
        'estimado_total_t_acc' => $this->input->POST('estimado_total_t5'),
        'cantidad_ejecu' => $this->input->POST('cantidad_rendi5'),

        'costo_unitario_rend_ejecu' => $this->input->POST('costo_unitario_remd'),
        'subtotal_rend_ejecu' => $this->input->POST('subt_rend_ejecu'),
        'selc_iva_rendi' => $this->input->POST('selc_iva_ret'),
        'iva_estimado_rend' => $this->input->POST('iva_estimado_red5'),
        'total_rendi' => $this->input->POST('total_rendi5'),
        'paridad_rendi' => $this->input->POST('paridad_rendi5'),
        'subtotal_rendiusdt' => $this->input->POST('subtotal_rendi5'),
        'id_modalida_rendi' => $this->input->POST('modalida_rendi5'),
        'supuestos_procedimiento' => $this->input->POST('id_sub_modalidad5'),

        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre5'),
        'nombre_contratista' => $this->input->POST('nombre_conta_5'),

        'num_contrato' => $this->input->POST('num_contrato5'),
        'fecha_contrato' => $this->input->POST('fecha_contrato5'),
        'selc_tipo_doc_contrata' => $this->input->POST('selc_tipo_doc_contrata5'),
        'selc_com_res_social' => $this->input->POST('selc_com_res_social5'),
        'monto3_rendim' => $this->input->POST('monto3_rendibines'),
        'nfactura_rendi' => $this->input->POST('nfactura_rendi5'),
        'datefactura_rendi' => $this->input->POST('datefactura_rendi5'),
        'base_imponible_rendi' => $this->input->POST('base_imponible_rendi5'),
        'selc_iva_rendi2' => $this->input->POST('selc_iva_rendi55'),
        'monto_factura_rend' => $this->input->POST('monto_factura_rend5'),
        'total_pago_rendi' => $this->input->POST('total_pago_rendi5'),        
        'paridad_rendi_factura' => $this->input->POST('paridad_rendi_factura5'),
        'subtotal_rendi_factura' => $this->input->POST('subtotal_rendi_factura5'),
        'fecha_pago_rendi' => $this->input->POST('fecha_pago_rendi5'), 
        'estatus' => 4,
        'fecha_rendicion' => date("Y-m-d"), 
        'fecha_cam_estatus' => date("Y-m-d"), 
        'id_usuario' => $this->session->userdata('id_user'),
        'fecha30dias_notificacion' => date("Y-m-d"),
        'trimestre' => $this->input->POST('llenar_trimestre5'),
        'razon_social_no_rnc' => $this->input->POST('razon_social'),
        'rif_contr_no_rnc' => $this->input->POST('rif_55'),
        'snc' => 0,
        'id_tipo_pago' => $this->input->POST('id_tipo_pago'),//cuando sea 1 no guardar el rif de contratista, cuando sea 2 guardar razon social en 
        'facturacion5' => $this->input->POST('facturacion5'),

    );
    $id_p_itemss = array(
              'estatus_rendi' 	=> $this->input->POST('llenar_trimestre5'),//trimestre que rindio     
    );
   

    $data = $this->Programacion_model->guardar_rendi_servicio_acc($data,$id_p_itemss);
    echo json_encode($data);
}
/////////Guardar Rendicion Proyecto
public function save_rendi_pry() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
        'rif_organoente' => $this->session->userdata('rif_organoente'),
        'id_programacion' => $this->input->POST('id_proyecto7'),
        'id_enlace' => $this->input->POST('id_enlace7'),
        'id_p_acc' => 0,//es un proyecto
        'nombre_proyecto' => $this->input->POST('nombre_proyecto7'),
        'id_proyecto' => $this->input->POST('id_enlace7'),
        
        'codigopartida_presupuestaria' => $this->input->POST('codigopartida_presupuestaria7'),
        'id_p_items' => $this->input->POST('id_p_items7'),
        'desc_partida_presupuestaria' => $this->input->POST('desc_partida_presupuestaria7'),
        'codigo_ccnu' => $this->input->POST('codigo_ccnu7'),
        'desc_ccnu' => $this->input->POST('desc_ccnu7'),
        'id_accion_centralizada' => 0,// como es un proyecto lo guardo en cero
        'desc_accion_centralizada' => 0,// como es un proyecto lo coloco en cero
        'id_obj_comercial' => $this->input->POST('id_obj_comercial7'),
        'desc_objeto_contrata' => $this->input->POST('desc_objeto_contrata7'),
        'estado' => $this->input->POST('id_estado7'),
        'id_fuente_financiamiento' => $this->input->POST('id_fuente_financiamiento7'),
        
        'desc_fuente_financiamiento' => $this->input->POST('desc_fuente_financiamiento7'),
        'id_tip_obra' => $this->input->POST('id_tip_obra7'),
        'id_alcance_obra' => $this->input->POST('id_alcance_obra7'),
        'id_obj_obra' =>$this->input->POST('id_obj_obra7'),
        'fecha_desde' =>$this->input->POST('fecha_desde7'),
        'fecha_hasta' =>$this->input->POST('fecha_hasta7'),
        'especificacion' => $this->input->POST('especificacion7'),
        'id_unidad_medida' => $this->input->POST('id_unid_med_b7'),
        'cantidad' => $this->input->POST('cantidad_mod_b7'),
        'i' => $this->input->POST('primero_b7'),
        'ii' => $this->input->POST('segundo_b7'),
        'iii' => $this->input->POST('tercero_b7'),
        'iv' => $this->input->POST('cuarto_b7'),
        'cant_total_distribuir' => 0,
        'costo_unitario' => $this->input->POST('costo_unitario_mod_b7'),
       
        'precio_total' => $this->input->POST('precio_total_mod_b7'),
        'alicuota_iva' => $this->input->POST('ali_iva_e_b7'),
        'iva_estimado' => $this->input->POST('iva_estimado_mod_b7'),
        'monto_estimado' => $this->input->POST('monto_estimado_mod_b7'),
        'est_trim_1' => $this->input->POST('estimado_i7'),
        'est_trim_2' => $this->input->POST('estimado_ii7'),
        'est_trim_3' => $this->input->POST('estimado_iii7'),
        'est_trim_4' => $this->input->POST('estimado_iV7'),
        'estimado_total_t_acc' => $this->input->POST('estimado_total_t7'),
        'cantidad_ejecu' => $this->input->POST('cantidad_rendi7'),

        'costo_unitario_rend_ejecu' => $this->input->POST('costo_unitario_remd7'),
        'subtotal_rend_ejecu' => $this->input->POST('subt_rend_ejecu7'),
        'selc_iva_rendi' => $this->input->POST('selc_iva_ret7'),
        'iva_estimado_rend' => $this->input->POST('iva_estimado_red7'),
        'total_rendi' => $this->input->POST('total_rendi7'),
        'paridad_rendi' => $this->input->POST('paridad_rendi7'),
        'subtotal_rendiusdt' => $this->input->POST('subtotal_rendi7'),
        'id_modalida_rendi' => $this->input->POST('modalida_rendi7'),
        'supuestos_procedimiento' => $this->input->POST('id_sub_modalidad7'),

        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre7'),
        'nombre_contratista' => $this->input->POST('nombre_conta_7'),

        'num_contrato' => $this->input->POST('num_contrato7'),
        'fecha_contrato' => $this->input->POST('fecha_contrato7'),
        'selc_tipo_doc_contrata' => $this->input->POST('selc_tipo_doc_contrata7'),
        'selc_com_res_social' => $this->input->POST('selc_com_res_social7'),
        'monto3_rendim' => $this->input->POST('monto3_rendibines7'),
        'nfactura_rendi' => $this->input->POST('nfactura_rendi7'),
        'datefactura_rendi' => $this->input->POST('datefactura_rendi7'),
        'base_imponible_rendi' => $this->input->POST('base_imponible_rendi7'),
        'selc_iva_rendi2' => $this->input->POST('selc_iva_rendi7'),
        'monto_factura_rend' => $this->input->POST('monto_factura_rend7'),
        'total_pago_rendi' => $this->input->POST('total_pago_rendi7'),        
        'paridad_rendi_factura' => $this->input->POST('paridad_rendi_factura7'),
        'subtotal_rendi_factura' => $this->input->POST('subtotal_rendi_factura7'),
        'fecha_pago_rendi' => $this->input->POST('fecha_pago_rendi7'),
        'estatus' => 4,
        'fecha_rendicion' => date("Y-m-d"), 
        'fecha_cam_estatus' => date("Y-m-d"), 
        'id_usuario' => $this->session->userdata('id_user'),
        'fecha30dias_notificacion' => date("Y-m-d"),
        'trimestre' => $this->input->POST('llenar_trimestre7'),
        'razon_social_no_rnc' => $this->input->POST('razon_social7'),
        'rif_contr_no_rnc' => $this->input->POST('rif_7'),
        'snc' => 0,//esto sera para el comproba
        'id_tipo_pago' => $this->input->POST('id_tipo_pago7'),//cuando sea 1 no guardar el rif de contratista, cuando sea 2 guardar razon social en 
        'facturacion5' => $this->input->POST('facturacion7'),

    );
    $id_p_itemss = array(
              'estatus_rendi' 	=> $this->input->POST('llenar_trimestre7'),//trimestre que rindio     
    );
   

    $data = $this->Programacion_model->guardar_rendi_servicio_acc($data,$id_p_itemss);
    echo json_encode($data);
}
////////////////////agregar item proyecto///////////////////////
public function agregar_items_proyecto() {
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

    $parametros              = $this->input->get('id');
    $separar                 = explode("/", $parametros);
    $data['id_p_proyecto']   = $separar['0'];
    $id_obj_comercial        = $separar['1'];
    $data['id_programacion'] = $separar['2'];

    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    $data['anio'] = $data['programacion_anio']['anio'];

    $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);
    $data['proyecto'] = $this->Programacion_model->consultar_proyecto($data['id_p_proyecto']);


   //Se pregunta y depende de la actividad comercial muestra la vista correspondiente------------------------
        if ($id_obj_comercial == '2') {
            //SERVICIO
            $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);

            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();

            // //ACCION CENTRALIZADA
            // $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
            // $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
            // //informacion accion centralizada
            // $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_acc_centralizada']);
            // $data['accion'] = $this->Programacion_model->consultar_scc($data['id_p_acc_centralizada']);
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/servicio/agregar_items_py_ser', $data);
            $this->load->view('templates/footer.php');

        }elseif ($id_obj_comercial == '1'){    
             //BIEN

                $data['accion'] = $this->Programacion_model->consultar_item_py_bienes($data['id_p_proyecto']);// lo que llena la tabla
                $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                $data['fuente'] = $this->Programacion_model->consulta_fuente();
                $data['act_com'] = $this->Programacion_model->consulta_act_com();
                $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                $data['unid'] 	= $this->Programacion_model->consulta_unid();
                $data['iva'] 	= $this->Programacion_model->consulta_iva();

                $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

                $data['inf_1_acc'] = $this->Programacion_model->inf_1($data['id_p_proyecto']); 

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/bien/agregar_itm_py_bien.php', $data);
    $this->load->view('templates/footer.php');
}
            elseif ($id_obj_comercial == '3') {
                //OBRA
                $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                $data['fuente'] = $this->Programacion_model->consulta_fuente();
                $data['act_com'] = $this->Programacion_model->consulta_act_com();
                $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                $data['unid'] 	= $this->Programacion_model->consulta_unid();
                $data['iva'] 	= $this->Programacion_model->consulta_iva();

                $data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
                $data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
                $data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

                $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                $data['accion'] = $this->Programacion_model->consultar_tems_obras_py($data['id_p_proyecto']);
                $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_proyecto']);

                $this->load->view('templates/header.php');
                $this->load->view('templates/navigator.php');
                $this->load->view('programacion/obra/agregar_items_py_obra.php', $data);
                $this->load->view('templates/footer.php');
            }

}
//////////////////////////////////funcion agregar mas item a un proyecto de servicios///////////
public function Guardar_mas_item_py_servicio() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion0        = $separar['0'];//
        $id_programacion2   = $separar['1'];//este

        $id_programacion3 = $this->input->post("id_programacion2");//id_programacion     
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_p_acc'=> 0, // 0 es un proyecto
         'id_tip_obra'=> '0',
         'id_obj_comercial'=> $this->input->post('id_obj_comercial1'),

         'id_alcance_obra'=> '0',
         'id_obj_obra'=> '0',
         'fecha_desde'=> $this->input->post('fecha_desde'),
         'fecha_hasta'=> $this->input->post('fecha_hasta'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => $id_ccnu_acc1,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => 1,
        'i' 		             => $this->input->post('I'),
        'ii' 		             => $this->input->post('II'),
        'iii' 		             => $this->input->post('III'),
        'iv' 		             => $this->input->post('IV'),
        'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
        'precio_total' 		     => $this->input->post('precio_total'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado'),
        'costo_unitario' 		 => 0,
        'monto_estimado' 		 => $this->input->post('monto_estimado'),
        'est_trim_1' 		 => $this->input->post('estimado_i'),
        'est_trim_2' 		 => $this->input->post('estimado_ii'),
        'est_trim_3' 		 => $this->input->post('estimado_iii'),
        'est_trim_4' 		 => $this->input->post('estimado_iV'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
        'estatus_rendi' => 0,//estatus inical del id_items
        'id_proyecto' 		 => $this->input->post('id_proyectoii'),//para calcular total de partida pp
        'id_usuario' => $this->session->userdata('id_user'),

        

      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => 0,
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '0',//proyecto
    );

    $data = $this->Programacion_model->Guardar_mas_item_py_servicio($data,$p_ffinanciamiento);
    echo json_encode($data);
}
/////////////////////////////////funcion agregar mas item a un proyecto de obras///////////
public function Guardar_mas_item_py_obras() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];

        $id_programacion3 = $this->input->post("id_programacion2");//id_programacion     
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_obj_comercial'=> $this->input->post('id_obj_comercial1'),
         'id_p_acc'=> 0, // 0 es un proyecto
         'id_tip_obra'=> $this->input->post('id_tip_obra'),
         'id_alcance_obra'=> $this->input->post('id_alcance_obra'),
         'id_obj_obra'=> $this->input->post('id_obj_obra'),
         'fecha_desde'=> $this->input->post('start'),
         'fecha_hasta'=> $this->input->post('end'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => 0,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => 1,
        'i' 		             => $this->input->post('I'),
        'ii' 		             => $this->input->post('II'),
        'iii' 		             => $this->input->post('III'),
        'iv' 		             => $this->input->post('IV'),
        'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
        'precio_total' 		     => $this->input->post('precio_total'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado'),
        'costo_unitario' 		 => 0,
        'monto_estimado' 		 => $this->input->post('monto_estimado'),
        'est_trim_1' 		 => $this->input->post('estimado_i'),
        'est_trim_2' 		 => $this->input->post('estimado_ii'),
        'est_trim_3' 		 => $this->input->post('estimado_iii'),
        'est_trim_4' 		 => $this->input->post('estimado_iV'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
        'estatus_rendi' => 0,//estatus inical del id_items
        'id_proyecto' 		 => $this->input->post('id_proyectoii'),//para calcular total de partida pp
        'id_usuario' => $this->session->userdata('id_user'),


      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '0',//proyecto
    );

    $data = $this->Programacion_model->Guardar_mas_item_py_obras($data,$p_ffinanciamiento);
    echo json_encode($data);
}
/////////////////////editar obras no importa si es un proyecto o una acc
public function editar_fila_py_obra(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->editar_fila_py_obra($data);
    echo json_encode($data);
}

///////////reprogramar obra items esta reprograma una accion centralizada de un proyecto
public function reprogramar_fila_acc_obra(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->reprogramar_fila_acc_obra($data);
    echo json_encode($data);
}
//////////reprogramar servicio items esta reprograma una accion centralizada de un 
public function reprogramar_fila_acc_serv(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->reprogramar_fila_acc_serv($data);
    echo json_encode($data);
}

   //////////////////////////////reprogramar items obra 
   public function reprogramar_add_obra_acc() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_p_acc'=> 1,
         'id_tip_obra'=> $this->input->post('id_tip_obra'),
         'id_alcance_obra'=> $this->input->post('id_alcance_obra'),
         'id_obj_obra'=> $this->input->post('id_obj_obra'),
         'fecha_desde'=> $this->input->post('start'),
         'fecha_hasta'=> $this->input->post('end'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => 0,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => 0,
        'i' 		             => $this->input->post('I'),
        'ii' 		             => $this->input->post('II'),
        'iii' 		             => $this->input->post('III'),
        'iv' 		             => $this->input->post('IV'),
        'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
        'precio_total' 		     => $this->input->post('precio_total'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado'),
        'costo_unitario' 		 => 0,
        'monto_estimado' 		 => $this->input->post('monto_estimado'),
        'est_trim_1' 		 => $this->input->post('estimado_i'),
        'est_trim_2' 		 => $this->input->post('estimado_ii'),
        'est_trim_3' 		 => $this->input->post('estimado_iii'),
        'est_trim_4' 		 => $this->input->post('estimado_iV'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '1',
    );

    $data = $this->Programacion_model->agregar_mas_item_obras($data,$p_ffinanciamiento);
    echo json_encode($data);
}

  //////////////////////////////Agregar mas items Reprogramando accion centralizada Obra 
  public function Guardar_repro_item_acc_obra() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_p_acc'=> 1,
         'id_tip_obra'=> $this->input->post('id_tip_obra'),
         'id_alcance_obra'=> $this->input->post('id_alcance_obra'),
         'id_obj_obra'=> $this->input->post('id_obj_obra'),
         'fecha_desde'=> $this->input->post('fecha_desde'),
         'fecha_hasta'=> $this->input->post('fecha_hasta'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => 0,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => 0,
        'i' 		             => $this->input->post('I'),
        'ii' 		             => $this->input->post('II'),
        'iii' 		             => $this->input->post('III'),
        'iv' 		             => $this->input->post('IV'),
        'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
        'precio_total' 		     => $this->input->post('precio_total'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado'),
        'costo_unitario' 		 => 0,
        'monto_estimado' 		 => $this->input->post('monto_estimado'),
        'est_trim_1' 		 => $this->input->post('estimado_i'),
        'est_trim_2' 		 => $this->input->post('estimado_ii'),
        'est_trim_3' 		 => $this->input->post('estimado_iii'),
        'est_trim_4' 		 => $this->input->post('estimado_iV'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
        'id_proyecto' 		 => $this->input->post('id_programacion3'),
        'id_obj_comercial' 		 => $this->input->post('id_obj_comercial'),
        'observaciones' 		 => $this->input->post('observaciones'),

        


      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '1',
    );

    $data = $this->Programacion_model->Guardar_repro_item_acc_obra($data,$p_ffinanciamiento);
    echo json_encode($data);
}

/////////////////reprogramar proyectos
public function reprogramar_items_py() {
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

    $parametros              = $this->input->get('id');
    $separar                 = explode("/", $parametros);
    $data['id_p_proyecto']   = $separar['0'];
    $id_obj_comercial        = $separar['1'];
    $data['id_programacion'] = $separar['2'];

    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    $data['anio'] = $data['programacion_anio']['anio'];

    $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);
    $data['proyecto'] = $this->Programacion_model->consultar_proyecto($data['id_p_proyecto']);


   //Se pregunta y depende de la actividad comercial muestra la vista correspondiente------------------------
        if ($id_obj_comercial == '2') {
            //SERVICIO
            $data['inf_1'] = $this->Programacion_model->inf_1($data['id_p_proyecto']);
            $data['accion'] = $this->Programacion_model->consultar_py_ser($data['id_p_proyecto']);//esto llena la tabla servicio proyecto
            //Proyecto
            $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
            $data['fuente'] = $this->Programacion_model->consulta_fuente();
            $data['act_com'] = $this->Programacion_model->consulta_act_com();
            $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $data['unid'] 	= $this->Programacion_model->consulta_unid();
            $data['iva'] 	= $this->Programacion_model->consulta_iva();
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('programacion/reprogramacion/reprograma_ser_py.php', $data);
            $this->load->view('templates/footer.php');

        }elseif ($id_obj_comercial == '1'){    
             //BIEN

             $data['accion'] = $this->Programacion_model->consultar_item_py_bienes($data['id_p_proyecto']);// lo que llena la tabla
             $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
             $data['fuente'] = $this->Programacion_model->consulta_fuente();
             $data['act_com'] = $this->Programacion_model->consulta_act_com();
             $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
             $data['estados'] 	= $this->Configuracion_model->consulta_estados();
             $data['unid'] 	= $this->Programacion_model->consulta_unid();
             $data['iva'] 	= $this->Programacion_model->consulta_iva();

             $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
             $data['acc_cent'] = $this->Programacion_model->accion_centralizada();

             $data['inf_1_acc'] = $this->Programacion_model->inf_1($data['id_p_proyecto']); 
                ////////////////////////////////////////////////////////////////

                $this->load->view('templates/header.php');
                $this->load->view('templates/navigator.php');
                $this->load->view('programacion/reprogramacion/reprograma_bien_py.php', $data);
                $this->load->view('templates/footer.php');
                }
            elseif ($id_obj_comercial == '3') {
                //OBRA
                $data['part_pres'] = $this->Programacion_model->consulta_part_pres();
                $data['fuente'] = $this->Programacion_model->consulta_fuente();
                $data['act_com'] = $this->Programacion_model->consulta_act_com();
                $data['ccnu'] = $this->Programacion_model->consulta_cnnu();
                $data['estados'] 	= $this->Configuracion_model->consulta_estados();
                $data['unid'] 	= $this->Programacion_model->consulta_unid();
                $data['iva'] 	= $this->Programacion_model->consulta_iva();

                $data['tip_obra'] 	= $this->Programacion_model->consulta_tip_obra();
                $data['alcance_obra'] 	= $this->Programacion_model->consulta_alcance_obra();
                $data['obj_obra'] 	= $this->Programacion_model->consulta_obj_obra();

                $data['act_com2'] = $this->Programacion_model->consulta_act_com2();
                $data['acc_cent'] = $this->Programacion_model->accion_centralizada();
                $data['accion'] = $this->Programacion_model->consultar_tems_obras_py($data['id_p_proyecto']);
                $data['inf_1_acc'] = $this->Programacion_model->inf_1_acc($data['id_p_proyecto']);

                $this->load->view('templates/header.php');
                $this->load->view('templates/navigator.php');
                $this->load->view('programacion/reprogramacion/reprograma_obra_py.php', $data);
                $this->load->view('templates/footer.php');
            }

}

public function reprogramar_fila_ip_bien_proyecto(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->reprogramar_fila_ip_bien_proyecto($data);
    echo json_encode($data);
}

////////////////////////guardar items bienes proyecto 
public function Guardar_reprogramacion_item_bienes_py() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva_acc');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_p_acc'=> 0,///indica que es un proyecto
         'id_tip_obra'=> '0',
         'id_alcance_obra'=> '0',
         'id_obj_obra'=> '0',
         'fecha_desde'=> date('Y-m-d'),
         'fecha_hasta'=> date('Y-m-d'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => $id_ccnu_acc1,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => $this->input->post('cantidad_acc'),
        'i' 		             => $this->input->post('I_acc'),
        'ii' 		             => $this->input->post('II_acc'),
        'iii' 		             => $this->input->post('III_acc'),
        'iv' 		             => $this->input->post('IV_acc'),
        'cant_total_distribuir' 		             => $this->input->post('cant_total_distribuir_acc'),
        'precio_total' 		     => $this->input->post('precio_total_acc'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado_acc'),
        'costo_unitario' 		 => $this->input->post('costo_unitario_acc'),
        'monto_estimado' 		 => $this->input->post('monto_estimado_acc'),
        'est_trim_1' 		 => $this->input->post('estimado_i_acc'),
        'est_trim_2' 		 => $this->input->post('estimado_ii_acc'),
        'est_trim_3' 		 => $this->input->post('estimado_iii_acc'),
        'est_trim_4' 		 => $this->input->post('estimado_iV_acc'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t_acc'),
        'id_proyecto' 		 => $this->input->post('id_programacion3'),
        'id_obj_comercial' 		 => $this->input->post('id_obj_comercial'),
        
        
      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '0',//indica q es un proyecto
    );

    $data = $this->Programacion_model->Guardar_reprogramacion_item_bienes_py($data,$p_ffinanciamiento);
    echo json_encode($data);
}
public function Repro_modal_py_obra(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->Repro_modal_py_obra($data);
    echo json_encode($data);
}

///////repro guardar modal de un proyecto servicio
public function Repro_modal_py_servicios(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->Repro_modal_py_servicios($data);
    echo json_encode($data);
}
public function edit_modal_py_servicios(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Programacion_model->edit_modal_py_servicios($data);
    echo json_encode($data);
}
 //////////////////////////////Agregar mas items Reprogramando proyecto Obra 
 public function Repro_py_obra() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_p_acc'=> 0,//es un proyecto
         'id_tip_obra'=> $this->input->post('id_tip_obra'),
         'id_alcance_obra'=> $this->input->post('id_alcance_obra'),
         'id_obj_obra'=> $this->input->post('id_obj_obra'),
         'fecha_desde'=> $this->input->post('start'),
         'fecha_hasta'=> $this->input->post('end'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => 0,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => 1,
        'i' 		             => $this->input->post('I'),
        'ii' 		             => $this->input->post('II'),
        'iii' 		             => $this->input->post('III'),
        'iv' 		             => $this->input->post('IV'),
        'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
        'precio_total' 		     => $this->input->post('precio_total'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado'),
        'costo_unitario' 		 => 0,
        'monto_estimado' 		 => $this->input->post('monto_estimado'),
        'est_trim_1' 		 => $this->input->post('estimado_i'),
        'est_trim_2' 		 => $this->input->post('estimado_ii'),
        'est_trim_3' 		 => $this->input->post('estimado_iii'),
        'est_trim_4' 		 => $this->input->post('estimado_iV'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
        'id_proyecto' 		 => $this->input->post('id_programacion3'),
        'id_obj_comercial' 		 => $this->input->post('id_obj_comercial'),

      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '0',// es un proyecto
    );

    $data = $this->Programacion_model->Repro_py_obra($data,$p_ffinanciamiento);
    echo json_encode($data);
}
 //////////////////////////////Agregar mas items Reprogramando proyecto servicio 
 public function Repro_py_servicio() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $id_presupuestaria        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];
        
        $id_programacion = $this->input->POST('id_programacion');
        $separar                 = explode("/", $id_programacion);
        $id_programacion        = $separar['0'];
        $id_programacion2   = $separar['1'];
        
        
        
        $id_unidad_medida_acc = $this->input->POST('id_unidad_medida_acc');
        $separar                 = explode("/", $id_unidad_medida_acc);
        $id_unidad_medida_acc1        = $separar['0'];
        $id_p_acc_centralizada   = $separar['1'];

        $id_alicuota_iva_acc = $this->input->POST('id_alicuota_iva');
        $separar                 = explode("/", $id_alicuota_iva_acc);
        $id_alicuota_iva_acc1       = $separar['0'];
        $id_alicuota_iva_acc2   = $separar['1'];

        $id_ccnu_acc = $this->input->POST('id_ccnu_acc');
        $separar                 = explode("/", $id_ccnu_acc);
        $id_ccnu_acc1        = $separar['0'];
        $id_ccnu_acc2   = $separar['1'];

        $id_estado = $this->input->POST('id_estado');
        $separar                 = explode("/", $id_estado);
        $id_estado1       = $separar['0'];
        $id_estado2   = $separar['1'];

        $fuente_financiamiento_acc = $this->input->POST('fuente_financiamiento_acc');
        $separar                 = explode("/", $fuente_financiamiento_acc);
        $fuente_financiamiento_acc1       = $separar['0'];
        $fuente_financiamiento_acc2   = $separar['1'];

        $par_presupuestaria_acc = $this->input->POST('par_presupuestaria_acc');
        $separar                 = explode("/", $par_presupuestaria_acc);
        $par_presupuestaria_acc1       = $separar['0'];
        $par_presupuestaria_acc2   = $separar['1'];

   $data = array(

   
         'id_enlace'=> $this->input->post('id_programacion'),
         'id_p_acc'=> 0,//es un proyecto
         'id_tip_obra'=> 0,
         'id_alcance_obra'=> 0,
         'id_obj_obra'=> 0,
         'fecha_desde'=> $this->input->post('start'),
         'fecha_hasta'=> $this->input->post('end'),
        'id_partidad_presupuestaria'  => $par_presupuestaria_acc1,
        'id_ccnu' 		         => $id_ccnu_acc1,
        'especificacion' 		 => $this->input->post('especificacion_acc'),
        'id_unidad_medida' 		 => $id_unidad_medida_acc1,
        'cantidad' 		 => 1,
        'i' 		             => $this->input->post('I'),
        'ii' 		             => $this->input->post('II'),
        'iii' 		             => $this->input->post('III'),
        'iv' 		             => $this->input->post('IV'),
        'cant_total_distribuir'  => $this->input->post('cant_total_distribuir'),
        'precio_total' 		     => $this->input->post('precio_total'),
        'alicuota_iva' 		 => $id_alicuota_iva_acc1,
        'iva_estimado' 		     => $this->input->post('iva_estimado'),
        'costo_unitario' 		 => 0,
        'monto_estimado' 		 => $this->input->post('monto_estimado'),
        'est_trim_1' 		 => $this->input->post('estimado_i'),
        'est_trim_2' 		 => $this->input->post('estimado_ii'),
        'est_trim_3' 		 => $this->input->post('estimado_iii'),
        'est_trim_4' 		 => $this->input->post('estimado_iV'),
        'estimado_total_t_acc' 		 => $this->input->post('estimado_total_t'),
        'id_proyecto' 		 => $this->input->post('id_programacion3'),
        'id_obj_comercial' 		 => $this->input->post('id_obj_comercial'),


      

    );
  
    $p_ffinanciamiento = array(
        'id_estado'   		        => $this->input->post('id_estado_acc'),
        'id_partidad_presupuestaria' 	=> $par_presupuestaria_acc1,
        'id_fuente_financiamiento'  => $fuente_financiamiento_acc1,
        'porcentaje' 	            => $this->input->post('porcentaje_acc'),
        'id_enlace'=> $this->input->post('id_programacion'),
        'id_p_acc'=> '0',// es un proyecto
    );

    $data = $this->Programacion_model->Repro_py_servicio($data,$p_ffinanciamiento);
    echo json_encode($data);
}
////////////////////////////////Guardar Rendicion Bienes Proyecto
/////////Guardar Rendicion bienes acc
public function guardar_rendi_bienes_py() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
        'rif_organoente' => $this->session->userdata('rif_organoente'),
        'id_programacion' => $this->input->POST('id_programacion7'),
        'id_enlace' => $this->input->POST('id_enlace7'),
        'id_p_acc' => 0,//cero significa que es un proyecto
        'id_proyecto' => $this->input->POST('nombre_proyecto7'),
        'codigopartida_presupuestaria' => $this->input->POST('codigopartida_presupuestaria7'),
        'id_p_items' => $this->input->POST('id_p_items7'),
        'desc_partida_presupuestaria' => $this->input->POST('desc_partida_presupuestaria7'),
        'codigo_ccnu' => $this->input->POST('codigo_ccnu7'),
        'desc_ccnu' => $this->input->POST('desc_ccnu7'),
       
        'id_obj_comercial' => $this->input->POST('id_obj_comercial7'),
        'desc_objeto_contrata' => $this->input->POST('desc_objeto_contrata7'),
        'estado' => $this->input->POST('id_estado7'),
        'id_fuente_financiamiento' => $this->input->POST('id_fuente_financiamiento7'),
        'porcentaje' => $this->input->POST('porcentaje7'),
        'desc_fuente_financiamiento' => $this->input->POST('desc_fuente_financiamiento7'),
        'id_tip_obra' => 0,
        'id_alcance_obra' => 0,
        'id_obj_obra' => 0,
        'fecha_desde' => date("Y-m-d"),
        'fecha_hasta' => date("Y-m-d"),
        'especificacion' => $this->input->POST('especificacion7'),
        'id_unidad_medida' => $this->input->POST('id_unid_med_b7'),
        'cantidad' => $this->input->POST('cantidad_mod_b7'),
        'i' => $this->input->POST('primero_b7'),
        'ii' => $this->input->POST('segundo_b7'),
        'iii' => $this->input->POST('tercero_b7'),
        'iv' => $this->input->POST('cuarto_b7'),
        'cant_total_distribuir' => 0,
        'costo_unitario' => $this->input->POST('costo_unitario_mod_b7'),
       
        'precio_total' => $this->input->POST('precio_total_mod_b7'),
        'alicuota_iva' => $this->input->POST('ali_iva_e_b7'),
        'iva_estimado' => $this->input->POST('iva_estimado_mod_b7'),
        'monto_estimado' => $this->input->POST('monto_estimado_mod_b7'),
        'est_trim_1' => $this->input->POST('estimado_i7'),
        'est_trim_2' => $this->input->POST('estimado_ii7'),
        'est_trim_3' => $this->input->POST('estimado_iii7'),
        'est_trim_4' => $this->input->POST('estimado_iV7'),
        'estimado_total_t_acc' => $this->input->POST('estimado_total_t7'),
        'cantidad_ejecu' => $this->input->POST('cantidad_rendi7'),

        'costo_unitario_rend_ejecu' => $this->input->POST('costo_unitario_remd7'),
        'precio_rend_ejecu' => $this->input->POST('subt_rend_ejecu7'),
        'selc_iva_rendi' => $this->input->POST('selc_iva_re7'),
        'iva_estimado_rend' => $this->input->POST('iva_estimado_red7'),
        'total_rendi' => $this->input->POST('total_rendi7'),
        'paridad_rendi' => $this->input->POST('paridad_rendi7'),
        'subtotal_rendi' => $this->input->POST('subtotal_rendi7'),
        'id_modalida_rendi' => $this->input->POST('modalida_rendi7'),
        'supuestos_procedimiento' => $this->input->POST('id_sub_modalidad7'),

        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre7'),
        'nombre_contratista' => $this->input->POST('nombre_conta_7'),

        'num_contrato' => $this->input->POST('num_contrato7'),
        'fecha_contrato' => $this->input->POST('fecha_contrato7'),
        'selc_tipo_doc_contrata' => $this->input->POST('selc_tipo_doc_contrata7'),
        'selc_com_res_social' => $this->input->POST('selc_com_res_social7'),
        'monto3_rendim' => $this->input->POST('monto3_rendibines7'),
        'nfactura_rendi' => $this->input->POST('nfactura_rendi7'),
        'datefactura_rendi' => $this->input->POST('datefactura_rendi7'),
        'base_imponible_rendi' => $this->input->POST('base_imponible_rendi7'),
        'selc_iva_rendi2' => $this->input->POST('selc_iva_rendi7'),
        'monto_factura_rend' => $this->input->POST('monto_factura_rend7'),
        'total_pago_rendi' => $this->input->POST('total_pago_rendi7'),        
        'paridad_rendi_factura' => $this->input->POST('paridad_rendi_factura7'),
        'subtotal_rendi_factura' => $this->input->POST('subtotal_rendi_factura7'),
        'fecha_pago_rendi' => $this->input->POST('fecha_pago_rendi7'),
        'estatus' => 4,
        'fecha_rendicion' => date("Y-m-d"), 
        'fecha_cam_estatus' => date("Y-m-d"), 
        'id_usuario' => $this->session->userdata('id_user'),
        'fecha30dias_notificacion' => date("Y-m-d"),
        'trimestre' => $this->input->POST('llenar_trimestre7'),
        'snc' => 0,
        'razon_social_no_rnc' => $this->input->POST('razon_social7'),
        'rif_contr_no_rnc' => $this->input->POST('rif_7'),
        'facturacion5' => $this->input->POST('facturacion7'),


    );
    $id_p_itemss = array(
              'estatus_rendi' 	=> $this->input->POST('llenar_trimestre7'),//trimestre que rindio     
    );
   

    $data = $this->Programacion_model->guardar_rendi_bienes_py($data,$id_p_itemss);
    echo json_encode($data);
}
public function guardar_rendi_servicio_py() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
        'rif_organoente' => $this->session->userdata('rif_organoente'),
        'id_programacion' => $this->input->POST('id_programacion8'),
        'id_enlace' => $this->input->POST('id_enlace8'),
        'id_p_acc' => 0,//es una proyecto el cero indca que es un proyecto
        'id_proyecto' => $this->input->POST('nombre_proyecto9'),
        'codigopartida_presupuestaria' => $this->input->POST('codigopartida_presupuestaria8'),
        'id_p_items' => $this->input->POST('id_p_items8'),
        'desc_partida_presupuestaria' => $this->input->POST('desc_partida_presupuestaria8'),
        'codigo_ccnu' => 0,
        'desc_ccnu' => 0,
        
        'id_obj_comercial' => $this->input->POST('id_obj_comercial8'),
        'desc_objeto_contrata' => $this->input->POST('desc_objeto_contrata8'),
        'estado' => $this->input->POST('id_estado8'),
        'id_fuente_financiamiento' => $this->input->POST('id_fuente_financiamiento8'),
        'porcentaje' => $this->input->POST('porcentaje8'),
        'desc_fuente_financiamiento' => $this->input->POST('desc_fuente_financiamiento8'),
        'id_tip_obra' => 0,
        'id_alcance_obra' => 0,
        'id_obj_obra' => 0,
        'fecha_desde' => $this->input->POST('fecha_desde8'),
        'fecha_hasta' => $this->input->POST('fecha_hasta8'),
        'especificacion' => $this->input->POST('especificacion8'),
        'id_unidad_medida' => $this->input->POST('id_unid_med_b8'),
        'cantidad' => 1,
        'i' => $this->input->POST('primero_b8'),
        'ii' => $this->input->POST('segundo_b8'),
        'iii' => $this->input->POST('tercero_b8'),
        'iv' => $this->input->POST('cuarto_b8'),
        'cant_total_distribuir' => 0,
        'costo_unitario' => 0,
        'precio_total' => $this->input->POST('precio_total_mod_b8'),
        'alicuota_iva' => $this->input->POST('ali_iva_e_b8'),
        'iva_estimado' => $this->input->POST('iva_estimado_mod_b8'),
        'monto_estimado' => $this->input->POST('monto_estimado_mod_b8'),
        'est_trim_1' => $this->input->POST('estimado_i8'),
        'est_trim_2' => $this->input->POST('estimado_ii8'),
        'est_trim_3' => $this->input->POST('estimado_iii8'),
        'est_trim_4' => $this->input->POST('estimado_iV8'),
        'estimado_total_t_acc' => $this->input->POST('estimado_total_t8'),
        'costo_unitario_rend_ejecu' => $this->input->POST('precio_rend_ejecu8'),
        'precio_rend_ejecu' => $this->input->POST('precio_rend_ejecu8'),
        'selc_iva_rendi' => $this->input->POST('selc_iva_rendi8'),
        'iva_estimado_rend' => $this->input->POST('iva_estimado_rend8'),
        'total_rendi' => $this->input->POST('total_rendi8'),
        'paridad_rendi' => $this->input->POST('paridad_rendi8'),
        'subtotal_rendi' => $this->input->POST('subtotal_rendi8'),
        'id_modalida_rendi' => $this->input->POST('modalida_rendi8'),
        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre8'),
        'num_contrato' => $this->input->POST('num_contrato8'),
        'fecha_contrato' => $this->input->POST('fecha_contrato8'),
        'selc_tipo_doc_contrata' => $this->input->POST('selc_tipo_doc_contrata8'),
        'selc_com_res_social' => $this->input->POST('selc_com_res_social8'),
        'monto3_rendim' => $this->input->POST('monto3_rendi8'),
        'nfactura_rendi' => $this->input->POST('nfactura_rendi8'),
        'datefactura_rendi' => $this->input->POST('datefactura_rendi8'),
        'base_imponible_rendi' => $this->input->POST('base_imponible_rendi8'),
        'selc_iva_rendi2' => $this->input->POST('selc_iva_rendi28'),
        'monto_factura_rend' => $this->input->POST('monto_factura_rend8'),
        'total_pago_rendi' => $this->input->POST('total_pago_rendi8'),        
        'paridad_rendi_factura' => $this->input->POST('paridad_rendi_factura8'),
        'subtotal_rendi_factura' => $this->input->POST('subtotal_rendi_factura8'),
        'fecha_pago_rendi' => $this->input->POST('fecha_pago_rendi8'),
        'estatus' => 4,
        'fecha_rendicion' => date("Y-m-d"), 
        'fecha_cam_estatus' => date("Y-m-d"), 
        'id_usuario' => $this->session->userdata('id_user'),
        'fecha30dias_notificacion' => date("Y-m-d"),
        'trimestre' => $this->input->POST('llenar_trimestre8'),
        'snc' => 0,
    );
    $id_p_itemss = array(
              'estatus_rendi' 	=> $this->input->POST('llenar_trimestre8'),//trimestre que rindio     
    );
   

    $data = $this->Programacion_model->guardar_rendi_bienes_py($data,$id_p_itemss);
    echo json_encode($data);
}
public function guardar_rendi_obr_py() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
        'rif_organoente' => $this->session->userdata('rif_organoente'),
        'id_programacion' => $this->input->POST('id_programacion9'),
        'id_enlace' => $this->input->POST('id_enlace9'),
        'id_p_acc' => 0,// el cero indica que es un proyecto 
        'id_proyecto' => $this->input->POST('nombre_proyecto10'),
        'codigopartida_presupuestaria' => $this->input->POST('codigopartida_presupuestaria9'),
        'id_p_items' => $this->input->POST('id_p_items9'),
        'desc_partida_presupuestaria' => $this->input->POST('desc_partida_presupuestaria9'),
        'codigo_ccnu' => 0,
        'desc_ccnu' => 0,
        
        'id_obj_comercial' => $this->input->POST('id_obj_comercial9'),
        'desc_objeto_contrata' => $this->input->POST('desc_objeto_contrata9'),
        'estado' => $this->input->POST('id_estado9'),
        'id_fuente_financiamiento' => $this->input->POST('id_fuente_financiamiento9'),
        'porcentaje' => $this->input->POST('porcentaje9'),
        'desc_fuente_financiamiento' => $this->input->POST('desc_fuente_financiamiento9'),
        'id_tip_obra' => $this->input->POST('id_tip_obra9'),
        'id_alcance_obra' => $this->input->POST('id_alcance_obra9'),
        'id_obj_obra' => $this->input->POST('id_obj_obra9'),
        'fecha_desde' => $this->input->POST('fecha_desde9'),
        'fecha_hasta' => $this->input->POST('fecha_hasta9'),
        'especificacion' => $this->input->POST('especificacion9'),
        'id_unidad_medida' => $this->input->POST('id_unid_med_b9'),
        'cantidad' => 1,
        'i' => $this->input->POST('primero_b9'),
        'ii' => $this->input->POST('segundo_b9'),
        'iii' => $this->input->POST('tercero_b9'),
        'iv' => $this->input->POST('cuarto_b9'),
        'cant_total_distribuir' => 0,
        'costo_unitario' => 0,
        'precio_total' => $this->input->POST('precio_total_mod_b9'),
        'alicuota_iva' => $this->input->POST('ali_iva_e_b9'),
        'iva_estimado' => $this->input->POST('iva_estimado_mod_b9'),
        'monto_estimado' => $this->input->POST('monto_estimado_mod_b9'),
        'est_trim_1' => $this->input->POST('estimado_i9'),
        'est_trim_2' => $this->input->POST('estimado_ii9'),
        'est_trim_3' => $this->input->POST('estimado_iii9'),
        'est_trim_4' => $this->input->POST('estimado_iV9'),
        'estimado_total_t_acc' => $this->input->POST('estimado_total_t9'),
        'costo_unitario_rend_ejecu' => $this->input->POST('precio_rend_ejecu9'),
        'precio_rend_ejecu' => $this->input->POST('precio_rend_ejecu9'),
        'selc_iva_rendi' => $this->input->POST('selc_iva_rendi9'),
        'iva_estimado_rend' => $this->input->POST('iva_estimado_rend9'),
        'total_rendi' => $this->input->POST('total_rendi9'),
        'paridad_rendi' => $this->input->POST('paridad_rendi9'),
        'subtotal_rendi' => $this->input->POST('subtotal_rendi9'),
        'id_modalida_rendi' => $this->input->POST('modalida_rendi9'),
        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre9'),
        'num_contrato' => $this->input->POST('num_contrato9'),
        'fecha_contrato' => $this->input->POST('fecha_contrato9'),
        'selc_tipo_doc_contrata' => $this->input->POST('selc_tipo_doc_contrata9'),
        'selc_com_res_social' => $this->input->POST('selc_com_res_social9'),
        'monto3_rendim' => $this->input->POST('monto3_rendi9'),
        'nfactura_rendi' => $this->input->POST('nfactura_rendi9'),
        'datefactura_rendi' => $this->input->POST('datefactura_rendi9'),
        'base_imponible_rendi' => $this->input->POST('base_imponible_rendi9'),
        'selc_iva_rendi2' => $this->input->POST('selc_iva_rendi99'),
        'monto_factura_rend' => $this->input->POST('monto_factura_rend9'),
        'total_pago_rendi' => $this->input->POST('total_pago_rendi9'),        
        'paridad_rendi_factura' => $this->input->POST('paridad_rendi_factura9'),
        'subtotal_rendi_factura' => $this->input->POST('subtotal_rendi_factura9'),
        'fecha_pago_rendi' => $this->input->POST('fecha_pago_rendi9'),
        'estatus' => 4,
        'fecha_rendicion' => date("Y-m-d"), 
        'fecha_cam_estatus' => date("Y-m-d"), 
        'id_usuario' => $this->session->userdata('id_user'),
        'fecha30dias_notificacion' => date("Y-m-d"),
        'trimestre' => $this->input->POST('llenar_trimestre8'),
        'snc' => 0,
    );
    $id_p_itemss = array(
              'estatus_rendi' 	=> $this->input->POST('llenar_trimestre9'),//trimestre que rindio     
    );
   

    $data = $this->Programacion_model->guardar_rendi_bienes_py($data,$id_p_itemss);
    echo json_encode($data);
}
public function ver_rendicion_realizadas(){ //////////visualiza las rendiciones realizadas
    if(!$this->session->userdata('session'))redirect('login');

    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

    $data['id_programacion'] = $this->input->get('id');
    
    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    $data['anio'] = $data['programacion_anio']['anio'];

 

    $data['rendir'] = $this->Programacion_model->rendir($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/rendicion/reporte1.php', $data);
    $this->load->view('templates/footer.php');
}
public function ver_rendicion_realizadas1(){ //////////visualiza las rendiciones realizadas
    if(!$this->session->userdata('session'))redirect('login');

    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

    $data['id_programacion'] = $this->input->get('id');
    
    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    $data['anio'] = $data['programacion_anio']['anio'];

 

    $data['rendir'] = $this->Programacion_model->ver_rendir1($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/rendicion/reporte1.php', $data);
    $this->load->view('templates/footer.php');
}
public function ver_rendicion_realizadas2(){ //////////visualiza las rendiciones realizadas
    if(!$this->session->userdata('session'))redirect('login');

    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

    $data['id_programacion'] = $this->input->get('id');
    
    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    $data['anio'] = $data['programacion_anio']['anio'];

 

    $data['rendir'] = $this->Programacion_model->ver_rendir2($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/rendicion/reporte1.php', $data);
    $this->load->view('templates/footer.php');
}
public function ver_rendicion_realizadas3(){ //////////visualiza las rendiciones realizadas
    if(!$this->session->userdata('session'))redirect('login');

    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

    $data['id_programacion'] = $this->input->get('id');
    
    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    $data['anio'] = $data['programacion_anio']['anio'];

 

    $data['rendir'] = $this->Programacion_model->ver_rendir3($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/rendicion/reporte1.php', $data);
    $this->load->view('templates/footer.php');
}
public function ver_rendicion_realizadas4(){ //////////visualiza las rendiciones realizadas
    if(!$this->session->userdata('session'))redirect('login');

    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

    $data['id_programacion'] = $this->input->get('id');
    
    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    $data['anio'] = $data['programacion_anio']['anio'];

 

    $data['rendir'] = $this->Programacion_model->ver_rendir4($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/rendicion/reporte1.php', $data);
    $this->load->view('templates/footer.php');
}
public function ver_programacion_final(){ //////////visualiza la programacion realizada
    if(!$this->session->userdata('session'))redirect('login');

    // $data['unidad'] = $this->session->userdata('id_unidad');
    // $data['des_unidad'] = $this->session->userdata('unidad');
    // $data['rif'] = $this->session->userdata('rif');
    // $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');

     $data['id_programacion'] = $this->input->get('id');
    // $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $data['unidad']);
    // $data['anio'] = $data['programacion_anio']['anio'];

 

    $data['programacion_final'] = $this->Programacion_model->Consultar_programacion_final($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/reportess/reporter_programacion.php', $data);
    $this->load->view('templates/footer.php');
}

public function reporte_plan(){
    if(!$this->session->userdata('session'))redirect('login');
    //Información traido por el session de usuario para mostrar inf
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
    $unidad = $this->session->userdata('id_unidad');
    $data['id_programacion'] = $this->input->get('id');

    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
    $data['anio'] = $data['programacion_anio']['anio'];

    //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
    $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos($data['id_programacion']);
    $data['ver_acc_centralizada'] = $this->Programacion_model->consultar_item_modal_bienes($data['id_programacion']);
    $data['totalespartida'] = $this->Programacion_model->total_por_partidas($data['id_programacion']);


    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/nueva_prog.php', $data);
    $this->load->view('templates/footer.php');
}
public function consultar_item_rendir2(){
    if(!$this->session->userdata('session'))redirect('login');
    //Información traido por el session de usuario para mostrar inf
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
    $unidad = $this->session->userdata('id_unidad');
    $data['id_programacion'] = $this->input->get('id');

    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
    $data['anio'] = $data['programacion_anio']['anio'];
    $data['totalespartidas'] = $this->Programacion_model->total_por_partidas($data['id_programacion']);
    

    //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
    $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos555($data['id_programacion']);
    $data['ver_acc_centralizada'] = $this->Programacion_model->consultar_acc_centralizada5($data['id_programacion']);
    $data['totalespartidattt'] = $this->Programacion_model->total_por_partidas_primero($data['id_programacion']);
    //$data['mat'] = $this->Programacion_model->consulta_items($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/rendicion/rendie2.php', $data);
    $this->load->view('templates/footer.php');
}

public function consultar_item_rendir_primero(){
    if(!$this->session->userdata('session'))redirect('login');
    //Información traido por el session de usuario para mostrar inf
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
    $unidad = $this->session->userdata('id_unidad');
    $data['id_programacion'] = $this->input->get('id');
    
  
    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
    $data['anio'] = $data['programacion_anio']['anio'];

    //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
    $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos_primero($data['id_programacion']);
    $data['ver_acc_centralizada'] = $this->Programacion_model->consultar_acc_centralizada_pimertimetre1($data['id_programacion']);
    $data['totalespartida'] = $this->Programacion_model->total_por_partidas($data['id_programacion']);
    $data['mat'] = $this->Programacion_model->consulta_items($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/rendicion/rendir_primero.php', $data);
    $this->load->view('templates/footer.php');
}
public function listar_info(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data = $this->Programacion_model->listar_info($data);
    echo json_encode($data);
}

public function certi_progra(){
    if(!$this->session->userdata('session'))redirect('login');
    //Información traido por el session de usuario para mostrar inf
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
    $unidad = $this->session->userdata('id_unidad');
    $data['id_programacion'] = $this->input->get('id');
    $id_programacion=$this->input->get('id');
    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
    $data['anio'] = $data['programacion_anio']['anio'];

    //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
    $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos($data['id_programacion']);
    $data['ver_acc_centralizada'] = $this->Programacion_model->consultar_acc_todo($data['id_programacion']);
    $data['totalespartida'] = $this->Programacion_model->total_por_partidas($data['id_programacion']);
    
    $data['totales'] = $this->Programacion_model->consultar_acc_todo1($data['id_programacion']);
    $data['toal_objeto'] = $this->Programacion_model->consulta_total_objeto_acc2($id_programacion);
    $data['toal_objeto1'] = $this->Programacion_model->consulta_total_objeto_acc2($id_programacion);
    $data['toal_objeto2'] = $this->Programacion_model->consulta_total_objeto_acc2($id_programacion);


    $data['total_acc']  = $this->Programacion_model->consulta_total_acc($id_programacion);
    $data['sueldo'] =0;
    $data['proyecto'] =0;

    $data['total_py1'] = $this->Programacion_model->consulta_total_objeto_py1($id_programacion);


    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/cer_pro/cer_prog.php', $data);
    $this->load->view('templates/footer.php');
}

public function comprobante_programacion() //hacer un pdf de comprobante programacion final
 { //programacion
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
   //$pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);
   $pdf->Ln(10);
   
   $pdf->Cell(195,5,'COMPROBANTE DE CUMPLIMIENTO',0,1,'C');
   $pdf->Cell(195,5,'ARTICULO 38 NUMERAL 1 del',0,1,'C'); 
   $pdf->Cell(195,5,'Decreto con Rango Valor y Fuerza de Ley de Contrataciones Publicas ',0,1,'C');
   $pdf->Cell(195,5,'(DCRVFLCP)',0,1,'C');
   $pdf->SetFont('Arial','I',8);
   $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
   $pdf->SetFont('Arial','B',12);
   $da = $this->session->userdata('rif');
   $des_unidad= $this->session->userdata('unidad');
   $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
   $pdf->Cell(60,5,'Organo / Ente / Adscrito:',0,'C');
   $pdf->MultiCell(100,5, utf8_decode($des_unidad), 0, 'L');
   $pdf->Cell(60,5,'Rif:',0,'L');
   $pdf->MultiCell(100,5, utf8_decode($da), 0, 'L');
   $codigo_onapre = $this->session->userdata('codigo_onapre');
   $pdf->Cell(60,5,utf8_decode('Código ONAPRE:'),0,'L');
   $pdf->MultiCell(100,5, utf8_decode($codigo_onapre), 0, 'L');
   $pdf->Cell(60,5,utf8_decode('Ejercicio Fiscal:'),0,'L');

  // $pdf->MultiCell(100,5, '2023', 0, 'L');

   $id_programacion = $this->input->get('id');
    
   $dat5 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat5 != ''){ 
           foreach($dat5 as $dt5){ 
       
           $pdf->MultiCell(100,5, $dt5->anio, 0, 'L');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}

   $pdf->Cell(60,5,utf8_decode('Fecha de Registro:'),0,'L');
   $id_programacion = $this->input->get('id');
    
   $dat6 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat6 != ''){ 
           foreach($dat6 as $dt6){ 
       
           $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt6->fecha)), 0, 'L');
          
       }}
  // $pdf->MultiCell(100,5, 'fecha', 0, 'L');
   $pdf->Ln(5);
   $pdf->SetFont('Arial','',12);
       
   $pdf->MultiCell(200,5, utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que fue recibida la carga') , 0, 'L');
   $pdf->Cell(40,10,'',0,'L');

   $pdf->Cell(60,5,utf8_decode('de la Programación Anual correspondienteal Ejercicio Fiscal'),0,'L');
   $id_programacion = $this->input->get('id');
   $pdf->SetFont('Arial','B',12);
   $dat7 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat7 != ''){ 
           foreach($dat7 as $dt7){ 
       
           $pdf->MultiCell(130,5, $dt7->anio, 0, 'C');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
   $pdf->Cell(20,10,'',0,'L');
       
   $pdf->SetFont('Arial','',12);
   $pdf->MultiCell(200,5, utf8_decode('de conformidad a lo establecido en el Articulo 38, numeral 1 del DCRVFLCP.'), 0, 'L');
   $pdf->Ln(1);
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(90,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('    Información de la Programación y de las Contrataciones'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('    
    Artículo 38. Los contratantes sujetos al presente Decreto con Rango, Valor y Fuerza de Ley, están
    en la obligación de remitir al Servicio Nacional de Contrataciones:
   '), 0, 'L');
    //    $pdf->Cell(50,10,'',0,'L');

    //    $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('1. La programación de la adquisición de bienes, prestación de servicios y ejecución de
   obras a contratar para el próximo ejercicio fiscal cuya remisión se hará en el último
   trimestre del año; salvo aquellas contrataciones que por razones de seguridad de Estado,
   estén calificadas como tales. (...Omissis ... )
   '), 0, 'L');
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
   $pdf->Cell(80,5, utf8_decode('ACCIÒN CENTRALIZADA. Bs.'),0,0,'C');      
   $pdf->Cell(35,5,'% ',0,1,'C'); 
 


   $id_programacion = $this->input->get('id');
   
   $data = $this->Programacion_model->consulta_total_objeto_acc($id_programacion);
   if($data != ''){
    foreach($data as $d){    
        $pdf->SetFont('Arial','',10);
        
       $pdf->Cell(60,5, $d->desc_objeto_contrata,0,0,'C');
       $pdf->Cell(40,5, number_format($d->precio_total, 2, ",", "."),0,0,'R');
 
       $id_programacion = $this->input->get('id');
       $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
       foreach($data3 as $d3){                
           $pdf->SetFont('Arial','',10);
             $ds = $d->precio_total / $d3->precio_total * 100;
          $pdf->Cell(90,5, number_format($ds, 2, ",", "."),0,1,'C');
         }
     } 
   }
    
    $id_programacion = $this->input->get('id');
    $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
    if($data3 != ''){
        foreach($data3 as $d3){                
            $pdf->SetFont('Arial','B',12);
         
            $pdf->Cell(175,10, number_format($d3->precio_total, 2, ",", "."),0,1,'C');
           
        }
    }
     
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
     $pdf->Cell(80,5,'PROYECTO Bs. ',0,0,'C'); 
     $pdf->Cell(35,5,'% ',0,1,'C');

    $data4 = $this->Programacion_model->consulta_total_objeto_py2($id_programacion);
        if($data4 != ''){
            foreach($data4 as $d4){    
            $pdf->SetFont('Arial','',10);
            
            $pdf->Cell(50,5, $d4->desc_objeto_contrata,0,0,'C');
            $pdf->Cell(48,5, number_format($d4->precio_total, 2, ",", "."),0,0,'R');
            $id_programacion = $this->input->get('id');
            
            $id_programacion = $this->input->get('id');
            $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion);
                if($data5 != ''){
                    foreach($data5 as $d5){                
                        $pdf->SetFont('Arial','',10);
                        $dq = $d4->precio_total / $d5->precio_total_py * 100;
                        
                        $pdf->Cell(95,5, number_format($dq, 2, ",", "."),0,1,'C');
                    }
                }
        }
     }
        
    $id_programacion = $this->input->get('id');
    
    $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion);   
        if($data5 != ''){ 
            foreach($data5 as $d5){ 
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(175,10, number_format($d5->precio_total_py, 2, ",", "."),0,1,'C');
        }}          
       
   
        $pdf->SetFont('Arial','I',8);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('ANTHONI CAMILO TORRES
    Director General'), 0);      
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
    $pdf->SetFont('Arial','B',8);

    $pdf->MultiCell(200,5, utf8_decode('Resolución CCP/ DGCJ Nº 001/2014 del 07 de Enero'), 0);
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
   
    $pdf->MultiCell(200,5, utf8_decode('de 2014, publicada en Gaceta Oficial de la República'), 0);
    $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('Bolivariana de Venezuela N° 40.334 de fecha 15 de Enero de 2014'), 0);
    
  
    
                          
      $pdf->Ln(10);
     $curdate = date('d-m-Y H:i:s');
                           $pdf->SetFont('Arial','B',10);
                           $pdf->Cell(100,5,utf8_decode(''),0,0,'C'); 

                           $pdf->Cell(60,10,utf8_decode('Fecha de Emisión:'),0,0,'C'); 
                           $pdf->Cell(30,10, $curdate,0,1,'C');
                           $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 
                           $pdf->SetFont('Arial','',6);
                           $pdf->MultiCell(200,5, utf8_decode('Av. Lecuna, Parque Central, Torre Oeste, Piso 6, Caracas, Venezuela / Telf. (0212) 508.55.14 / 55.15 RIF. G-20002451-81/3'), 0);
                           
                          
                           $pdf->SetX(-15);
                          // Arial italic 8
                          $pdf->SetFont('Arial','I',8);
                          // Número de página
                        //   $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
      
     // $pdf->Ln(10);
    
    
     
      $pdf->Output('Comprobanteproyecto '.$curdate.'.pdf', 'D');
     // $this->load->view('headfoot/header', $datos);
}
public function comprobante_programacion1() //hacer un pdf de comprobante programacion final
 { //programacion
  //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
   //Se agrega la clase desde thirdparty para usar FPDF
    require_once APPPATH.'third_party/fpdf/fpdf.php';
    //  $unidad
   
   $pdf = new FPDF();
   $pdf->AliasNbPages();
   $pdf->AddPage('P','A4',0);
   $pdf->SetMargins(8,8,8,8);
   $pdf->SetFont('Arial','B',12);
   $pdf->Image(base_url().'baner/logo3.png',40,8,150);

   $pdf->Ln(10);
   
   $pdf->Cell(195,5,'COMPROBANTE DE CUMPLIMIENTO',0,1,'C');
   $pdf->Cell(195,5,'ARTICULO 38 NUMERAL 1 del',0,1,'C'); 
   $pdf->Cell(195,5,utf8_decode('Decreto con Rango Valor y Fuerza de Ley de Contrataciones Públicas'),0,1,'C');
   $pdf->Cell(195,5,'(DCRVFLCP)',0,1,'C');
   $pdf->SetFont('Arial','I',8);
   $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
   $pdf->SetFont('Arial','B',12);
   $da = $this->session->userdata('rif');
   $des_unidad= $this->session->userdata('unidad');
   $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
   $pdf->Cell(60,5,'Organo / Ente / Adscrito:',0,'C');
   $pdf->MultiCell(100,5, utf8_decode($des_unidad), 0, 'L');
   $pdf->Cell(60,5,'Rif:',0,'L');
   $pdf->MultiCell(100,5, utf8_decode($da), 0, 'L');
   $codigo_onapre = $this->session->userdata('codigo_onapre');
   $pdf->Cell(60,5,utf8_decode('Código ONAPRE:'),0,'L');
   $pdf->MultiCell(100,5, utf8_decode($codigo_onapre), 0, 'L');
   $pdf->Cell(60,5,utf8_decode('Ejercicio Fiscal:'),0,'L');

  // $pdf->MultiCell(100,5, '2023', 0, 'L');

   $id_programacion = $this->input->get('id');
    
   $dat5 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat5 != ''){ 
           foreach($dat5 as $dt5){ 
       
           $pdf->MultiCell(100,5, $dt5->anio, 0, 'L');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}

   $pdf->Cell(60,5,utf8_decode('Fecha de Registro:'),0,'L');
   $id_programacion = $this->input->get('id');
    
   $dat6 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat6 != ''){ 
           foreach($dat6 as $dt6){ 
       
           $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt6->fecha)), 0, 'L');
          
       }}
  // $pdf->MultiCell(100,5, 'fecha', 0, 'L');
   $pdf->Ln(5);
   $pdf->SetFont('Arial','',12);
       
   $pdf->MultiCell(200,5, utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que fue recibida la carga') , 0, 'L');
   $pdf->Cell(40,10,'',0,'L');

   $pdf->Cell(60,5,utf8_decode('de la Programación Anual correspondienteal Ejercicio Fiscal'),0,'L');
   $id_programacion = $this->input->get('id');
   $pdf->SetFont('Arial','B',12);
   $dat7 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat7 != ''){ 
           foreach($dat7 as $dt7){ 
       
           $pdf->MultiCell(130,5, $dt7->anio, 0, 'C');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
   $pdf->Cell(20,10,'',0,'L');
       
   $pdf->SetFont('Arial','',12);
   $pdf->MultiCell(200,5, utf8_decode('de conformidad a lo establecido en el Articulo 38, numeral 1 del DCRVFLCP.'), 0, 'L');
   $pdf->Ln(1);
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(90,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('    Información de la Programación y de las Contrataciones'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('    
    Artículo 38. Los contratantes sujetos al presente Decreto con Rango, Valor y Fuerza de Ley, están
    en la obligación de remitir al Servicio Nacional de Contrataciones:
   '), 0, 'L');
    //    $pdf->Cell(50,10,'',0,'L');

    //    $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('1. La programación de la adquisición de bienes, prestación de servicios y ejecución de
   obras a contratar para el próximo ejercicio fiscal cuya remisión se hará en el último
   trimestre del año; salvo aquellas contrataciones que por razones de seguridad de Estado,
   estén calificadas como tales. (...Omissis ... )
   '), 0, 'L');
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
   $pdf->Cell(80,5, utf8_decode('ACCIÒN CENTRALIZADA. Bs.'),0,0,'C');      
   $pdf->Cell(30,5,'% ',0,1,'C'); 
 


   $id_programacion = $this->input->get('id');
            $pdf->SetFont('Arial','',10);

   $data = $this->Programacion_model->consulta_total_objeto_acc3($id_programacion);
   if($data != ''){ 
    foreach($data as $b){
        $pdf->Cell(70,5,utf8_decode('Bien:'),0,0,'C');       
        $pdf->Cell(70,5, $b->precio_total_bien_a, 0, 'L');
        $pdf->Cell(50,5,  number_format($b->porcentaje_bien_a, 2, ",", "."),0,1, 'L');
        $pdf->Cell(70,5,utf8_decode('Servicios:'),0,0,'C');       
        $pdf->Cell(70,5, $b->precio_total_serv_a, 0, 'L');
        $pdf->Cell(50,5,  number_format($b->porcentaje_serv_a, 2, ",", "."),0,1, 'L');
        $pdf->Cell(70,5,utf8_decode('Obras:'),0,0,'C');       
        $pdf->Cell(70,5, $b->precio_total_obra_a, 0, 'L');
        $pdf->Cell(50,5,  number_format($b->porcentaje_obra_a, 2, ",", "."),0,1, 'L');
        $pdf->SetFont('Arial','B',10);      
        $pdf->Cell(175,10, number_format($b->total_acc, 2, ",", "."),0,1,'C');

   
    }}
    $pdf->SetFont('Arial','B',10);

   $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
   $pdf->Cell(70,5, utf8_decode('PROYECTOS. Bs.'),0,0,'C');      
   $pdf->Cell(47,5,'% ',0,1,'C'); 
 


   $id_programacion = $this->input->get('id');
            $pdf->SetFont('Arial','',10);

   $data = $this->Programacion_model->consulta_total_objeto_acc3($id_programacion);
   if($data != ''){ 
    foreach($data as $c){
        $pdf->Cell(70,5,utf8_decode('Bien:'),0,0,'C');       
        $pdf->Cell(70,5, $c->precio_total_bien, 0, 'L');
        $pdf->Cell(50,5,  number_format($c->porcentaje_bien, 2, ",", "."),0,1, 'L');
        $pdf->Cell(70,5,utf8_decode('Servicios:'),0,0,'C');       
        $pdf->Cell(70,5, $c->precio_total_serv, 0, 'L');
        $pdf->Cell(50,5,  number_format($c->porcentaje_serv, 2, ",", "."),0,1, 'L');
        $pdf->Cell(70,5,utf8_decode('Obras:'),0,0,'C');       
        $pdf->Cell(70,5, $c->precio_total_obra, 0, 'L');
        $pdf->Cell(50,5,  number_format($c->porcentaje_obra, 2, ",", "."),0,1, 'L');
        $pdf->SetFont('Arial','B',10);        
        $pdf->Cell(175,10, number_format($c->total_proy, 2, ",", "."),0,1,'C');

        
   }}
     $pdf->SetFont('Arial','I',8);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('ANTHONI CAMILO TORRES
    Director General'), 0);      
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
    $pdf->SetFont('Arial','B',8);

    $pdf->MultiCell(200,5, utf8_decode('Resolución CCP/ DGCJ Nº 001/2014 del 07 de Enero'), 0);
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
   
    $pdf->MultiCell(200,5, utf8_decode('de 2014, publicada en Gaceta Oficial de la República'), 0);
    $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('Bolivariana de Venezuela N° 40.334 de fecha 15 de Enero de 2014'), 0);
    
  
    
                          
      $pdf->Ln(10);
     $curdate = date('d-m-Y H:i:s');
                           $pdf->SetFont('Arial','B',10);
                           $pdf->Cell(100,5,utf8_decode(''),0,0,'C'); 

                           $pdf->Cell(60,10,utf8_decode('Fecha de Emisión:'),0,0,'C'); 
                           $pdf->Cell(30,10, $curdate,0,1,'C');
                           $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 
                           $pdf->SetFont('Arial','',6);
                           $pdf->MultiCell(200,5, utf8_decode('Av. Lecuna, Parque Central, Torre Oeste, Piso 6, Caracas, Venezuela / Telf. (0212) 508.55.14 / 55.15 RIF. G-20002451-81/3'), 0);
                           
                          
                           $pdf->SetX(-15);
                          // Arial italic 8
                          $pdf->SetFont('Arial','I',8);
                          // Número de página
                        //   $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
      
     // $pdf->Ln(10);
    
    
     
      $pdf->Output('Comprobanteproyecto '.$curdate.'.pdf', 'D');
     // $this->load->view('headfoot/header', $datos);
}
public function read_send() //hacer un pdf de comprobante programacion final para ver por el snc
 { //programacion
  //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
   //Se agrega la clase desde thirdparty para usar FPDF
   require_once APPPATH.'third_party/fpdf/fpdf.php';
 //  $unidad
   
   $pdf = new FPDF();
   $pdf->AliasNbPages();
   $pdf->AddPage('P','A4',0);
   $pdf->SetMargins(8,8,8,8);
   $pdf->SetFont('Arial','B',12);
   $pdf->Image(base_url().'baner/logo3.png',40,8,150);

   //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
   //$pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);
   $pdf->Ln(10);
   
   $pdf->Cell(195,5,utf8_decode('COMPROBANTE DE CUMPLIMIENTO'),0,1,'C');
   $pdf->Cell(195,5,utf8_decode('ARTÍCULO 38 NUMERAL 1 del'),0,1,'C'); 
   $pdf->Cell(195,5,utf8_decode('Decreto con Rango Valor y Fuerza de Ley de Contrataciones Públicas'),0,1,'C');
   $pdf->Cell(195,5,'(DCRVFLCP)',0,1,'C');

   $pdf->SetFont('Arial','I',8);

   $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
   $pdf->SetFont('Arial','B',12);
 

   $da = $this->session->userdata('rif');
   
   $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
   $pdf->Cell(60,5,'Organo / Ente / Adscrito:',0,'C');

   $id_programacion = $this->input->get('id');
   $dat5e = $this->Programacion_model->read_sending_p2($id_programacion);   
   if($dat5e != ''){ 
       foreach($dat5e as $date3){ 
   
       $pdf->MultiCell(100,5,  utf8_decode($date3->des_unidad), 0, 'L');
      // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
      
   }}
   $pdf->Cell(60,5,'Rif:',0,'L');

   $id_programacion = $this->input->get('id');
   $date6e = $this->Programacion_model->read_sending_p2($id_programacion);   
   if($date6e != ''){ 
       foreach($date6e as $dati8){ 
   
        if($dati8->filiar > 0){
       $pdf->MultiCell(100,5,  utf8_decode($dati8->filiares), 0, 'L');
      // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
      
    }else  { 
       $pdf->MultiCell(100,5,  utf8_decode($dati8->rif), 0, 'L');

     }
   }}
   
   $pdf->Cell(60,5,utf8_decode('Código ONAPRE:'),0,'L');
   $id_programacion = $this->input->get('id');
   $dat34 = $this->Programacion_model->read_sending_p2($id_programacion);   
   if($dat34 != ''){ 
       foreach($dat34 as $dt4r){ 
   
       $pdf->MultiCell(100,5,  utf8_decode($dt4r->codigo_onapre), 0, 'L');
      // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
      
   }}


   $pdf->Cell(60,5,utf8_decode('Ejercicio Fiscal:'),0,'L');

  // $pdf->MultiCell(100,5, '2023', 0, 'L');

   $id_programacion = $this->input->get('id');
    
   $dat5 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat5 != ''){ 
           foreach($dat5 as $dt5){ 
       
           $pdf->MultiCell(100,5, $dt5->anio, 0, 'L');
         //  $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}

   $pdf->Cell(60,5,utf8_decode('Fecha de Registro:'),0,'L');
   $id_programacion = $this->input->get('id');
    
   $dat6 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat6 != ''){ 
           foreach($dat6 as $dt6){ 
       
           $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt6->fecha)), 0, 'L');
          
       }}
  // $pdf->MultiCell(100,5, 'fecha', 0, 'L');
   $pdf->Ln(5);
   $pdf->SetFont('Arial','',12);
       
   $pdf->MultiCell(200,5, utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que fue recibida la carga') , 0, 'L');
   $pdf->Cell(40,10,'',0,'L');

   $pdf->Cell(60,5,utf8_decode('de la Programación Anual correspondiente al Ejercicio Fiscal'),0,'L');
   $id_programacion = $this->input->get('id');
   $pdf->SetFont('Arial','B',12);
   $dat7 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat7 != ''){ 
           foreach($dat7 as $dt7){ 
       
           $pdf->MultiCell(130,5, $dt7->anio, 0, 'C');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
   $pdf->Cell(20,10,'',0,'L');
       
   $pdf->SetFont('Arial','',12);
   $pdf->MultiCell(200,5, utf8_decode('de conformidad a lo establecido en el Artículo 38, numeral 1 del DCRVFLCP.'), 0, 'L');
   $pdf->Ln(1);
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(90,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('    Información de la Programación y de las Contrataciones'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('    
    Artículo 38. Los contratantes sujetos al presente Decreto con Rango, Valor y Fuerza de Ley, están
    en la obligación de remitir al Servicio Nacional de Contrataciones:
   '), 0, 'L');
        //    $pdf->Cell(50,10,'',0,'L');

        //    $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('1. La programación de la adquisición de bienes, prestación de servicios y ejecución de
   obras a contratar para el próximo ejercicio fiscal cuya remisión se hará en el último
   trimestre del año; salvo aquellas contrataciones que por razones de seguridad de Estado,
   estén calificadas como tales. (...Omissis ... )
   '), 0, 'L');
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
   $pdf->Cell(80,5, utf8_decode('ACCIÒN CENTRALIZADA. Bs.'),0,0,'C');      
   $pdf->Cell(35,5,'% ',0,1,'C'); 
 


   $id_programacion = $this->input->get('id');
   
   $data = $this->Programacion_model->consulta_total_objeto_acc($id_programacion);
   if($data != ''){
    foreach($data as $d){    
        $pdf->SetFont('Arial','',10);
        
       $pdf->Cell(60,5, $d->desc_objeto_contrata,0,0,'C');
       $pdf->Cell(40,5, number_format($d->precio_total, 2, ",", "."),0,0,'R');
 
       $id_programacion = $this->input->get('id');
       $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
       foreach($data3 as $d3){                
           $pdf->SetFont('Arial','',10);
             $ds = $d->precio_total / $d3->precio_total * 100;
          $pdf->Cell(90,5, number_format($ds, 2, ",", "."),0,1,'C');
         }
     } 
   }
    
    $id_programacion = $this->input->get('id');
    $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
    if($data3 != ''){
        foreach($data3 as $d3){                
            $pdf->SetFont('Arial','B',12);
         
            $pdf->Cell(175,10, number_format($d3->precio_total, 2, ",", "."),0,1,'C');
           
        }
    }
     
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
     $pdf->Cell(80,5,'PROYECTO Bs. ',0,0,'C'); 
     $pdf->Cell(35,5,'% ',0,1,'C');

    $data4 = $this->Programacion_model->consulta_total_objeto_py2($id_programacion);
        if($data4 != ''){
            foreach($data4 as $d4){    
            $pdf->SetFont('Arial','',10);
            
            $pdf->Cell(50,5, $d4->desc_objeto_contrata,0,0,'C');
            $pdf->Cell(48,5, number_format($d4->precio_total, 2, ",", "."),0,0,'R');
            $id_programacion = $this->input->get('id');
            
            $id_programacion = $this->input->get('id');
            $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion);
                if($data5 != ''){
                    foreach($data5 as $d5){                
                        $pdf->SetFont('Arial','',10);
                        $dq = $d4->precio_total / $d5->precio_total_py * 100;
                        
                        $pdf->Cell(95,5, number_format($dq, 2, ",", "."),0,1,'C');
                    }
                }
        }
     }
        
    $id_programacion = $this->input->get('id');
    
    $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion);   
        if($data5 != ''){ 
            foreach($data5 as $d5){ 
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(175,10, number_format($d5->precio_total_py, 2, ",", "."),0,1,'C');
        }}          
       
   
        $pdf->SetFont('Arial','I',8);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('ANTHONI CAMILO TORRES
    Director General'), 0);      
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
    $pdf->SetFont('Arial','B',8);

    $pdf->MultiCell(200,5, utf8_decode('Resolución CCP/ DGCJ Nº 001/2014 del 07 de Enero'), 0);
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
   
    $pdf->MultiCell(200,5, utf8_decode('de 2014, publicada en Gaceta Oficial de la República'), 0);
    $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('Bolivariana de Venezuela N° 40.334 de fecha 15 de Enero de 2014'), 0);
    
  
    
                          
      $pdf->Ln(10);
     $curdate = date('d-m-Y H:i:s');
                           $pdf->SetFont('Arial','B',10);
                           $pdf->Cell(100,5,utf8_decode(''),0,0,'C'); 

                           $pdf->Cell(60,10,utf8_decode('Fecha de Emisión:'),0,0,'C'); 
                           $pdf->Cell(30,10, $curdate,0,1,'C');
                           $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 
                           $pdf->SetFont('Arial','',6);
                           $pdf->MultiCell(200,5, utf8_decode('Av. Lecuna, Parque Central, Torre Oeste, Piso 6, Caracas, Venezuela / Telf. (0212) 508.55.14 / 55.15 RIF. G-20002451-81/3'), 0);
                           
                          
                           $pdf->SetX(-15);
                          // Arial italic 8
                          $pdf->SetFont('Arial','I',8);
                          // Número de página
                        //   $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
      
     // $pdf->Ln(10);
    
    
     
      $pdf->Output('Comprobanteproyecto '.$curdate.'.pdf', 'D');
     // $this->load->view('headfoot/header', $datos);
}
public function modificacion_ley() //pdf segun ley
 {
   require_once APPPATH.'third_party/fpdf/fpdf.php';

    //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
   //Se agrega la clase desde thirdparty para usar FPDF
   $pdf = new FPDF();
   $pdf->AliasNbPages();
   $pdf->AddPage('P','A4',0);
   $pdf->SetMargins(8,8,8,8);
   $pdf->SetFont('Arial','B',12);
   $pdf->Image(base_url().'baner/logo3.png',40,8,150);
       $pdf->Ln(10);
   //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
   //$pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);  
   $pdf->Cell(195,5,'COMPROBANTE DE CUMPLIMIENTO',0,1,'C');
   $pdf->Cell(195,5,utf8_decode('ARTÍCULO 38 NUMERAL 2 del'),0,1,'C'); 
   $pdf->Cell(195,5,utf8_decode('Decreto con Rango Valor y Fuerza de Ley de Contrataciones Públicas'),0,1,'C');
   $pdf->Cell(195,5,'(DCRVFLCP)',0,1,'C');

     // $pdf->Image(base_url().'imagenes/logosnc.png',140,6,50);
   $pdf->SetFont('Arial','I',8);

   $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
   $pdf->SetFont('Arial','B',12);
   $da = $this->session->userdata('rif');
   $des_unidad= $this->session->userdata('unidad');
   $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
   $pdf->Cell(60,5,'Organo / Ente / Adscrito:',0,'C');
   $pdf->MultiCell(100,5, utf8_decode($des_unidad), 0, 'L');
   $pdf->Cell(60,5,'Rif:',0,'L');
   $pdf->MultiCell(100,5, utf8_decode($da), 0, 'L');
   $codigo_onapre = $this->session->userdata('codigo_onapre');
   $pdf->Cell(60,5,utf8_decode('Código ONAPRE:'),0,'L');
   $pdf->MultiCell(100,5, utf8_decode($codigo_onapre), 0, 'L');
   $pdf->Cell(60,5,utf8_decode('Ejercicio Fiscal:'),0,'L');
   $id_programacion = $this->input->get('id');
    
   $dat5 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat5 != ''){ 
           foreach($dat5 as $dt5){ 
       
           $pdf->MultiCell(100,5, $dt5->anio, 0, 'L');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
   $pdf->Cell(60,5,utf8_decode('Fecha de Registro:'),0,'L');
   $id_programacion = $this->input->get('id');
    
   $dat6 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat6 != ''){ 
           foreach($dat6 as $dt6){ 
       
           $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt6->fecha_modifi)), 0, 'L');
          
       }}
   $pdf->Ln(5);
   $pdf->SetFont('Arial','',12);

   $pdf->Cell(60,5,utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que fue recibida la'),0,1,'L');
   $pdf->Cell(60,5,utf8_decode('  Modificación de la Programación Anual correspondiente al Ejercicio Fiscal'),0,'L');
   $id_programacion = $this->input->get('id');
   $pdf->SetFont('Arial','B',12);
   $dat7 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat7 != ''){ 
           foreach($dat7 as $dt7){ 
       
           $pdf->MultiCell(180,5, $dt7->anio, 0, 'C');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
   $pdf->SetFont('Arial','',12);

   $pdf->MultiCell(200,5, utf8_decode('    de conformidad a lo establecido en el Artículo 38, numeral 2 del DCRVFLCP.'), 0, 'L');
   $pdf->Ln(1);
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(90,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('    Información de la Programación y de las Contrataciones'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('    
   Artículo 38. Los contratantes sujetos al presente Decreto con Rango, Valor y Fuerza de Ley, están
   en la obligación de remitir al Servicio Nacional de Contrataciones:
   '), 0, 'L');
   $pdf->Cell(50,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('2. Cualquier modificación a la programación de la adquisición de bienes, prestación de
   servicios y ejecución de obras, deberá ser notificada al Servicio Nacional de Contrataciones
   dentro de los quince días siguientes, contados a partir de la aprobación de la misma.
   '), 0, 'L');
   $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
   $pdf->Cell(80,5, utf8_decode('ACCIÒN CENTRALIZADA. Bs.'),0,0,'C');      
   $pdf->Cell(35,5,'% ',0,1,'C'); 
 

   $id_programacion = $this->input->get('id');
   
   $data = $this->Programacion_model->consulta_total_objeto_acc($id_programacion);
   if($data != ''){
    foreach($data as $d){    
        $pdf->SetFont('Arial','',10);
        
       $pdf->Cell(60,5, $d->desc_objeto_contrata,0,0,'C');
       $pdf->Cell(40,5, number_format($d->precio_total, 2, ",", "."),0,0,'R');
 
       $id_programacion = $this->input->get('id');
       $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
       foreach($data3 as $d3){                
           $pdf->SetFont('Arial','',10);
             $ds = $d->precio_total / $d3->precio_total * 100;
          $pdf->Cell(90,5, number_format($ds, 2, ",", "."),0,1,'C');
         }
     } 
   }
    
    $id_programacion = $this->input->get('id');
    $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
    if($data3 != ''){
        foreach($data3 as $d3){                
            $pdf->SetFont('Arial','B',12);
         
            $pdf->Cell(175,10, number_format($d3->precio_total, 2, ",", "."),0,1,'C');
           
        }
    }
     
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
     $pdf->Cell(80,5,'PROYECTO Bs. ',0,0,'C'); 
     $pdf->Cell(35,5,'% ',0,1,'C');

    $data4 = $this->Programacion_model->consulta_total_objeto_py2($id_programacion);
        if($data4 != ''){
            foreach($data4 as $d4){    
            $pdf->SetFont('Arial','',10);
            
            $pdf->Cell(50,5, $d4->desc_objeto_contrata,0,0,'C');
            $pdf->Cell(48,5, number_format($d4->precio_total, 2, ",", "."),0,0,'R');
            $id_programacion = $this->input->get('id');
            
            $id_programacion = $this->input->get('id');
            $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion);
                if($data5 != ''){
                    foreach($data5 as $d5){                
                        $pdf->SetFont('Arial','',10);
                        $dq = $d4->precio_total / $d5->precio_total_py * 100;
                        
                        $pdf->Cell(95,5, number_format($dq, 2, ",", "."),0,1,'C');
                    }
                }
        }
     }
        
    $id_programacion = $this->input->get('id');
    
    $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion);   
        if($data5 != ''){ 
            foreach($data5 as $d5){ 
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(175,10, number_format($d5->precio_total_py, 2, ",", "."),0,1,'C');
        }} 
   
    $pdf->SetFont('Arial','I',8);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('ANTHONI CAMILO TORRES
    Director General'), 0);      
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
    $pdf->SetFont('Arial','B',8);

    $pdf->MultiCell(200,5, utf8_decode('Resolución CCP/ DGCJ Nº 001/2014 del 07 de Enero'), 0);
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
   
    $pdf->MultiCell(200,5, utf8_decode('de 2014, publicada en Gaceta Oficial de la República'), 0);
    $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('Bolivariana de Venezuela N° 40.334 de fecha 15 de Enero de 2014'), 0);
    
  
    
                          
      $pdf->Ln(10);
     $curdate = date('d-m-Y H:i:s');
                           $pdf->SetFont('Arial','B',10);
                           $pdf->Cell(100,5,utf8_decode(''),0,0,'C'); 

                           $pdf->Cell(60,10,utf8_decode('Fecha de Emisión:'),0,0,'C'); 
                           $pdf->Cell(30,10, $curdate,0,1,'C');
                           $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 
                           $pdf->SetFont('Arial','',6);
                           $pdf->MultiCell(200,5, utf8_decode('Av. Lecuna, Parque Central, Torre Oeste, Piso 6, Caracas, Venezuela / Telf. (0212) 508.55.14 / 55.15 RIF. G-20002451-81/3'), 0);
                           
                          
                           $pdf->SetX(-15);
                          // Arial italic 8
                          $pdf->SetFont('Arial','I',8);
                          // Número de página
                          $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
      
     // $pdf->Ln(10);
    
      $pdf->Output('modifiacion_programacion_segun_ley '.$curdate.'.pdf', 'D');
     // $this->load->view('headfoot/header', $datos);
}
public function comprobante_rendicion() //hacer un pdf de comprobante rendidicon final
  { 
   require_once APPPATH.'third_party/fpdf/fpdf.php';

  //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
   //Se agrega la clase desde thirdparty para usar FPDF
   $pdf = new FPDF();
   $pdf->AliasNbPages();
   $pdf->AddPage('P','A4',0);
   $pdf->SetMargins(8,8,8,8);
   $pdf->SetFont('Arial','B',12);
   $pdf->Image(base_url().'baner/logo3.png',40,8,150);

   //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
   //$pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);
   $pdf->Ln(10);
   
   $pdf->Cell(195,5,'COMPROBANTE DE CUMPLIMIENTO',0,1,'C');
   $pdf->Cell(195,5,utf8_decode('ARTÍCULO 38 NUMERAL 3'),0,1,'C'); 
   $pdf->Cell(195,5,'Decreto con Rango Valor y Fuerza de Ley de Contrataciones Publicas ',0,1,'C');
   $pdf->Cell(195,5,'(DCRVFLCP)',0,1,'C');



   
  // $pdf->Image(base_url().'imagenes/logosnc.png',140,6,50);
   $pdf->SetFont('Arial','I',8);

   $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
   $pdf->SetFont('Arial','B',12);
   $da = $this->session->userdata('rif');
   $des_unidad= $this->session->userdata('unidad');
   $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
   $pdf->Cell(60,5,'Organo / Ente / Adscrito:',0,'C');
   $pdf->MultiCell(100,5, utf8_decode($des_unidad), 0, 'L');
   $pdf->Cell(60,5,'Rif:',0,'L');
   $pdf->MultiCell(100,5, utf8_decode($da), 0, 'L');
   $codigo_onapre = $this->session->userdata('codigo_onapre');
   $pdf->Cell(60,5,utf8_decode('Código ONAPRE:'),0,'L');
   $pdf->MultiCell(100,5, utf8_decode($codigo_onapre), 0, 'L');
   $pdf->Cell(60,5,utf8_decode('Ejercicio Fiscal:'),0,'L');
//    $pdf->MultiCell(100,5, '2023', 0, 'L');
$id_programacion = $this->input->get('id');

   $dat7 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat7 != ''){ 
           foreach($dat7 as $dt7){ 
       
           $pdf->MultiCell(15,5, $dt7->anio, 0, 'C');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
   $pdf->Cell(60,5,utf8_decode('Trimestre:'),0,'L');
   $pdf->MultiCell(100,5, 'I', 0, 'L');
   $pdf->Cell(60,5,utf8_decode('Fecha de Registro:'),0,'L');
   $id_programacion = $this->input->get('id');
    
   $dat6 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat6 != ''){ 
           foreach($dat6 as $dt6){ 
       
           $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt6->fecha)), 0, 'L');
          
       }}
// $id_programacion = $this->input->get('id');
    
//    $dat6 = $this->Programacion_model->read_sending_rendiciones14($id_programacion);   
//        if($dat6 != ''){ 
//            foreach($dat6 as $dt6){ 
       
//            $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt6->fecha)), 0, 'L');
          
//        }}
   $pdf->Ln(2);
   $pdf->SetFont('Arial','',12);

   $pdf->Cell(60,5,utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que fue recibida la carga'),0,1,'L');
   $pdf->Cell(60,5,utf8_decode('  de la Rendición de la Programación Anual correspondiente al I Trimestre Ejercicio Fiscal'),0,'L');
   $id_programacion = $this->input->get('id');
   $pdf->SetFont('Arial','B',12);
   $dat7 = $this->Programacion_model->anio_programacion($id_programacion);   
       if($dat7 != ''){ 
           foreach($dat7 as $dt7){ 
       
           $pdf->MultiCell(230,5, $dt7->anio, 0, 'C');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
   $pdf->SetFont('Arial','',12);

   $pdf->MultiCell(200,5, utf8_decode('   de conformidad a lo establecido en el Artículo 38, numeral 3 del Decreto con Rango, Valor y
      Fuerza de Ley de Contrataciones Públicas, (DRVFLCP). '), 0, 'L');
   $pdf->Ln(1);
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(90,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('    Información de la Programación y de las Contrataciones'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('    
   Artículo 38. Los contratantes sujetos al presente Decreto con Rango, Valor y Fuerza de Ley, están
   en la obligación de remitir al Servicio Nacional de Contrataciones:
   '), 0, 'L');
   $pdf->Cell(50,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('3. Deberán rendir la información de las contrataciones realizadas en ejecución del presente
   Decreto con Rango, Valor y Fuerza de Ley, dentro de los primeros quince días continuos
   siguientes al vencimiento de cada trimestre.
   '), 0, 'L');
   $pdf->SetFont('Arial','',10);

   $pdf->Cell(20,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('El Servicio Nacional de Contrataciones establecerá los mecanismos y parámetros para la rendición
   de la información a que se refiere el presente artículo.
   '), 0, 'L');
   $pdf->SetFont('Arial','B',10);


   $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
   $pdf->Cell(80,5, utf8_decode('ACCIÒN CENTRALIZADA. Bs.'),0,0,'C');      
   $pdf->Cell(35,5,'% ',0,1,'C'); 
 


   $id_programacion = $this->input->get('id');
   $data = $this->Programacion_model->consulta_total_objeto_acc_rendi($id_programacion);
   foreach($data as $d){    
       $pdf->SetFont('Arial','',10);
       
      $pdf->Cell(60,5, $d->desc_objeto_contrata,0,0,'C');
      $pdf->Cell(40,5, number_format($d->precio_total, 2, ",", "."),0,1,'R');
      $id_programacion = $this->input->get('id');
      
      
     }
     
     
     $id_programacion = $this->input->get('id');
     $data3 = $this->Programacion_model->consulta_total_accrendi2($id_programacion);
     foreach($data3 as $d3){                
        $pdf->SetFont('Arial','B',12);
     
        $pdf->Cell(175,10, number_format($d3->precio_total, 2, ",", "."),0,1,'C');
       
       }
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
     $pdf->Cell(80,5,'PROYECTO Bs. ',0,0,'C'); 
     $pdf->Cell(35,5,'% ',0,1,'C');
     $data4 = $this->Programacion_model->consulta_total_objeto_py2rendi($id_programacion);
        if($data4 != ''){
            foreach($data4 as $d4){    
                $pdf->SetFont('Arial','',10);
                
                $pdf->Cell(50,5, $d4->desc_objeto_contrata,0,0,'C');
                $pdf->Cell(48,5, number_format($d4->precio_total, 2, ",", "."),0,1,'R');
                $id_programacion = $this->input->get('id');
                
                $id_programacion = $this->input->get('id');
                $data5 = $this->Programacion_model->consulta_total_PYTrendi($id_programacion);
                foreach($data5 as $d5){                
                $pdf->SetFont('Arial','',10);
                $dq = $d4->precio_total / $d5->precio_total_py * 100;
                
             //   $pdf->Cell(95,5, number_format($dq, 2, ",", "."),0,1,'C');
            }
        }
        
    }
   $id_programacion = $this->input->get('id');
      $data5 = $this->Programacion_model->consulta_total_PYTrendi($id_programacion);
      if($data5 != ''){
        foreach($data5 as $d5){                
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(175,10, number_format($d5->precio_total_py, 2, ",", "."),0,1,'C');
        }
      }

    $pdf->SetFont('Arial','I',8);
    $pdf->Ln(1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('ANTHONI CAMILO TORRES
    Director General'), 0);      
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
    $pdf->SetFont('Arial','B',8);

    $pdf->MultiCell(200,5, utf8_decode('Resolución CCP/ DGCJ Nº 001/2014 del 07 de Enero'), 0);
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
   
    $pdf->MultiCell(200,5, utf8_decode('de 2014, publicada en Gaceta Oficial de la República'), 0);
    $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('Bolivariana de Venezuela N° 40.334 de fecha 15 de Enero de 2014'), 0);
    
  
    
                          
      $pdf->Ln(10);
     $curdate = date('d-m-Y H:i:s');
                           $pdf->SetFont('Arial','B',10);
                           $pdf->Cell(100,5,utf8_decode(''),0,0,'C'); 

                           $pdf->Cell(60,10,utf8_decode('Fecha de Emisión:'),0,0,'C'); 
                           $pdf->Cell(30,10, $curdate,0,1,'C');
                           $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 
                           $pdf->SetFont('Arial','',6);
                           $pdf->MultiCell(200,5, utf8_decode('Av. Lecuna, Parque Central, Torre Oeste, Piso 6, Caracas, Venezuela / Telf. (0212) 508.55.14 / 55.15 RIF. G-20002451-81/3'), 0);
                           
                          
                           $pdf->SetX(-15);
                          // Arial italic 8
                          $pdf->SetFont('Arial','I',8);
                          // Número de página
                        //   $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
      
     // $pdf->Ln(10);
    
      $pdf->Output('rendicion_programacion '.$curdate.'.pdf', 'D');
     // $this->load->view('headfoot/header', $datos);
}
public function read_send_snc() //hacer un pdf de comprobante programacion final para ver por el snc
 { 
   require_once APPPATH.'third_party/fpdf/fpdf.php';
 
   
   $pdf = new FPDF();
   $pdf->AliasNbPages();
   $pdf->AddPage('P','A4',0);
   $pdf->SetMargins(8,8,8,8);
   $pdf->SetFont('Arial','B',12);
   $pdf->Image(base_url().'baner/logo3.png',40,8,150);

   //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
   //$pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);
   $pdf->Ln(10);
   
   $pdf->Cell(195,5,utf8_decode('COMPROBANTE DE CUMPLIMIENTO'),0,1,'C');
   $pdf->Cell(195,5,utf8_decode('ARTÍCULO 38 NUMERAL 3 del'),0,1,'C'); 
   $pdf->Cell(195,5,utf8_decode('Decreto con Rango Valor y Fuerza de Ley de Contrataciones Públicas'),0,1,'C');
   $pdf->Cell(195,5,'(DCRVFLCP)',0,1,'C');

   $pdf->SetFont('Arial','I',8);

   $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
   $pdf->SetFont('Arial','B',12);
 

   $da = $this->session->userdata('rif');
   
//    $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
   $pdf->Cell(60,5,'Organo / Ente / Adscrito:',0,'C');

   $id_programacion = $this->input->get('id');
   $dat5e = $this->Programacion_model->read_sending_rendiciones($id_programacion);   
   if($dat5e != ''){ 
       foreach($dat5e as $date3){ 
   
       $pdf->MultiCell(100,5,  utf8_decode($date3->des_unidad), 0, 'L');
      // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
      
   }}
   $pdf->Cell(60,5,'Rif:',0,'L');

   $id_programacion = $this->input->get('id');
   $date6e = $this->Programacion_model->read_sending_rendiciones($id_programacion);   
   if($date6e != ''){ 
       foreach($date6e as $dati8){ 
   
        if($dati8->filiar > 0){
       $pdf->MultiCell(100,5,  utf8_decode($dati8->filiares), 0, 'L');
      // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
      
    }else  { 
       $pdf->MultiCell(100,5,  utf8_decode($dati8->rif), 0, 'L');

     }
   }}
   
   $pdf->Cell(60,5,utf8_decode('Código ONAPRE:'),0,'L');
   $id_programacion = $this->input->get('id');
   $dat34 = $this->Programacion_model->read_sending_rendiciones($id_programacion);   
   if($dat34 != ''){ 
       foreach($dat34 as $dt4r){ 
   
       $pdf->MultiCell(100,5,  utf8_decode($dt4r->codigo_onapre), 0, 'L');
      // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
      
   }}


   $pdf->Cell(60,5,utf8_decode('Ejercicio Fiscal:'),0,'L');

  // $pdf->MultiCell(100,5, '2023', 0, 'L');

   $id_programacion = $this->input->get('id');
    
   $dat5 = $this->Programacion_model->read_sending_rendiciones($id_programacion);   
       if($dat5 != ''){ 
           foreach($dat5 as $dt5){ 
       
           $pdf->MultiCell(100,5, $dt5->anio, 0, 'L');
         //  $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
       $pdf->Cell(60,5,utf8_decode('Trimestre:'),0,'L');
       $id_programacion = $this->input->get('id');
    
   $dat51 = $this->Programacion_model->read_sending_rendiciones($id_programacion);   
       if($dat51 != ''){ 
           foreach($dat51 as $dt51){ 
       
           $pdf->MultiCell(100,5, $dt51->descripcion_trimestre, 0, 'L');
         //  $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
    //    $pdf->MultiCell(100,5, 'I', 0, 'L');
   $pdf->Cell(60,5,utf8_decode('Fecha de Registro:'),0,'L');
   $id_programacion = $this->input->get('id');
    
   $dat6 = $this->Programacion_model->read_sending_rendiciones($id_programacion);   
       if($dat6 != ''){ 
           foreach($dat6 as $dt6){ 
       
           $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt6->fecha)), 0, 'L');
          
       }}
  // $pdf->MultiCell(100,5, 'fecha', 0, 'L');
   $pdf->Ln(5);
   $pdf->SetFont('Arial','',12);
       
   $pdf->Cell(60,5,utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que fue recibida la carga'),0,1,'L');
   $pdf->Cell(60,5,utf8_decode('  de la Rendición de la Programación Anual correspondiente al '),0,'L');
   $id_programacion = $this->input->get('id');
   $pdf->SetFont('Arial','B',12);
    
   $dat52 = $this->Programacion_model->read_sending_rendiciones($id_programacion);

   if($dat52!= ''){ 
       foreach($dat52 as $dt52){ 
           $pdf->Cell(180,5, $dt52->descripcion_trimestre. '   Trimestre Ejercicio Fiscal',0,0,'C');        
       }
   }

   $id_programacion = $this->input->get('id');
   $pdf->SetFont('Arial','B',12);
   $dat7 = $this->Programacion_model->read_sending_rendiciones($id_programacion);   
       if($dat7 != ''){ 
           foreach($dat7 as $dt7){ 
       
           $pdf->MultiCell(230,5, $dt7->anio, 0, 'C');
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
          
       }}
   $pdf->SetFont('Arial','',12);

   $pdf->MultiCell(200,5, utf8_decode('   de conformidad a lo establecido en el Artículo 38, numeral 3 del Decreto con Rango, Valor y
      Fuerza de Ley de Contrataciones Públicas, (DRVFLCP). '), 0, 'L');
   $pdf->Ln(1);
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(90,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('    Información de la Programación y de las Contrataciones'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode('    
   Artículo 38. Los contratantes sujetos al presente Decreto con Rango, Valor y Fuerza de Ley, están
   en la obligación de remitir al Servicio Nacional de Contrataciones:
   '), 0, 'L');
   $pdf->Cell(50,10,'',0,'L');

   $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
   $pdf->Cell(20,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('3. Deberán rendir la información de las contrataciones realizadas en ejecución del presente
   Decreto con Rango, Valor y Fuerza de Ley, dentro de los primeros quince días continuos
   siguientes al vencimiento de cada trimestre.
   '), 0, 'L');
   $pdf->SetFont('Arial','',10);

   $pdf->Cell(20,10,'',0,'L');
   $pdf->MultiCell(200,5, utf8_decode('El Servicio Nacional de Contrataciones establecerá los mecanismos y parámetros para la rendición
   de la información a que se refiere el presente artículo.
   '), 0, 'L');
   $pdf->SetFont('Arial','B',10);

   $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
   $pdf->Cell(80,5, utf8_decode('ACCIÓN CENTRALIZADA. Bs.'),0,0,'C');      
   $pdf->Cell(35,5,' ',0,1,'C'); 
   $pdf->SetFont('Arial','',10);
   
   $data = $this->Programacion_model->read_sending_rendiciones_snc2($id_programacion);   
   if($data != ''){ 
    $total = 0;
       foreach($data as $dt7){ 
        $precio_total_bien_a = str_replace('.', '', str_replace(',', '.', $dt7->precio_total_bien_a));
        $precio_total_serv_a = str_replace('.', '', str_replace(',', '.', $dt7->precio_total_serv_a));
        $precio_total_obra_a = str_replace('.', '', str_replace(',', '.', $dt7->precio_total_obra_a));
        
        $total += floatval(str_replace('.', '', str_replace(',', '.', $precio_total_bien_a))) + 
                   floatval(str_replace('.', '', str_replace(',', '.', $precio_total_serv_a))) + 
                   floatval(str_replace('.', '', str_replace(',', '.', $precio_total_obra_a)));
        
        
        $pdf->Cell(60,5, 'Bienes',0,0,'C');
       $pdf->Cell(40,5, $dt7->precio_total_bien_a,0,1,'R');
       $pdf->Cell(60,5, 'Servicios',0,0,'C');
       $pdf->Cell(40,5, $dt7->precio_total_serv_a,0,1,'R');
       $pdf->Cell(60,5, 'Obras',0,0,'C');
       $pdf->Cell(40,5, $dt7->precio_total_obra_a,0,1,'R');
   }
   $pdf->SetFont('Arial','B',10);
   $pdf->Cell(60,5, 'Total',0,0,'C');
   $pdf->Cell(40,5, number_format($total / 100, 2, ',', '.'),0,1,'R');
}
   $id_programacion = $this->input->get('id'); 
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
     $pdf->Cell(80,5,'PROYECTO Bs. ',0,0,'C'); 
     $pdf->Cell(35,5,' ',0,1,'C');
   $pdf->SetFont('Arial','',10);

     $data = $this->Programacion_model->read_sending_rendiciones_snc2($id_programacion);
     $totalpy = 0;   
     if($data != ''){ 
         foreach($data as $dtp0){ 
            $precio_total_bien = str_replace('.', '', str_replace(',', '.', $dtp0->precio_total_bien));
        $precio_total_serv = str_replace('.', '', str_replace(',', '.', $dtp0->precio_total_serv));
        $precio_total_obra = str_replace('.', '', str_replace(',', '.', $dtp0->precio_total_obra));
        
        $totalpy += floatval(str_replace('.', '', str_replace(',', '.', $precio_total_bien))) + 
                   floatval(str_replace('.', '', str_replace(',', '.', $precio_total_serv))) + 
                   floatval(str_replace('.', '', str_replace(',', '.', $precio_total_obra)));

          $pdf->Cell(60,5, 'Bienes',0,0,'C');
          $pdf->Cell(40,5, $dtp0->precio_total_bien,0,1,'R');
         $pdf->Cell(60,5, 'Servicios',0,0,'C');
         $pdf->Cell(40,5, $dtp0->precio_total_serv,0,1,'R');
         $pdf->Cell(60,5, 'Obras',0,0,'C');
         $pdf->Cell(40,5, $dtp0->precio_total_obra,0,1,'R');
    
     } $pdf->SetFont('Arial','B',10);
     $pdf->Cell(60,5, 'Total',0,0,'C');
     $pdf->Cell(40,5, number_format($totalpy / 100, 2, ',', '.'),0,1,'R');
    }
   
        
   
   
        $pdf->SetFont('Arial','I',8);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('ANTHONI CAMILO TORRES
    Director General'), 0);      
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
    $pdf->SetFont('Arial','B',8);

    $pdf->MultiCell(200,5, utf8_decode('Resolución CCP/ DGCJ Nº 001/2014 del 07 de Enero'), 0);
    $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
   
    $pdf->MultiCell(200,5, utf8_decode('de 2014, publicada en Gaceta Oficial de la República'), 0);
    $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 

    $pdf->MultiCell(200,5, utf8_decode('Bolivariana de Venezuela N° 40.334 de fecha 15 de Enero de 2014'), 0);
    
  
    
                          
      $pdf->Ln(10);
     $curdate = date('d-m-Y H:i:s');
                           $pdf->SetFont('Arial','B',10);
                           $pdf->Cell(100,5,utf8_decode(''),0,0,'C'); 

                           $pdf->Cell(60,10,utf8_decode('Fecha de Emisión:'),0,0,'C'); 
                           $pdf->Cell(30,10, $curdate,0,1,'C');
                           $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 
                           $pdf->SetFont('Arial','',6);
                           $pdf->MultiCell(200,5, utf8_decode('Av. Lecuna, Parque Central, Torre Oeste, Piso 6, Caracas, Venezuela / Telf. (0212) 508.55.14 / 55.15 RIF. G-20002451-81/3'), 0);
                           
                          
                           $pdf->SetX(-15);
                          // Arial italic 8
                          $pdf->SetFont('Arial','I',8);
                          // Número de página
                        //   $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
      
     // $pdf->Ln(10);
    
    
     
      $pdf->Output('rendicion_programacion '.$curdate.'.pdf', 'D');
     // $this->load->view('headfoot/header', $datos);
}
public function guardar_comprobante_totales() {
    if (!$this->session->userdata('session'))
        redirect('login');
        
        $id_programacion = $this->input->POST('id_programacion');
        $rif = $this->input->POST('rif');
        
        $data = array(

   
        'id_programacion' => $id_programacion, 
        'rif'             => $rif,    
        'objeto_acc' 	  => $this->input->post('objeto_acc'),
        'totales_acc'     => $this->input->post('totales_acc'),
        'porcentaje_acc'  => $this->input->post('porcentaje_acc'),
        'total_acc' 	  => $this->input->post('total_acc'),

        'precio_py' 	  => $this->input->post('precio_py'),
        'porcenta_py' 	  => $this->input->post('porcenta_py'),
        'total_py' 		  => $this->input->post('total_py'),

        
        'fecha1'=> date('Y-m-d'),
        //'fecha_hasta'=> date('Y-m-d'),
      



      

    );
    $data = $this->Programacion_model->save_certificado($data);
    echo json_encode($data);
}

public function surrender(){
    if(!$this->session->userdata('session'))redirect('login');
    //Información traido por el session de usuario para mostrar inf
    $data['unidad'] = $this->session->userdata('id_unidad');
    $data['des_unidad'] = $this->session->userdata('unidad');
    $data['rif'] = $this->session->userdata('rif');
    $data['codigo_onapre'] = $this->session->userdata('codigo_onapre');
    $unidad = $this->session->userdata('id_unidad');
    $data['id_programacion'] = $this->input->get('id');
    
   
    $data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
  //  print_r( $data['mat']);die;
    $data['py'] = $this->Programacion_model->consulta_itemsr_py($data['id_programacion']);

    $data['programacion_anio'] = $this->Programacion_model->consultar_prog_anio($data['id_programacion'], $unidad);
    $data['anio'] = $data['programacion_anio']['anio'];
    $data['rendir'] = $this->Programacion_model->rendir($data['id_programacion']);

    //Traer todo los proyectos y acc registradas por el id_programación de cada unidad
   // $data['ver_proyectos'] = $this->Programacion_model->consultar_proyectos_primero($data['id_programacion']);
   // $data['rendicion'] = $this->Programacion_model->consultar_acc_centralizada_pimertimetre1($data['id_programacion']);
    $data['totalespartida'] = $this->Programacion_model->total_por_partidas($data['id_programacion']);
   // $data['mat'] = $this->Programacion_model->consulta_items($data['id_programacion']);

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/rendicion/surrender.php', $data);
    $this->load->view('templates/footer.php');
}
public function sending_p(){
    if(!$this->session->userdata('session'))redirect('login');

   

    $data['read'] = $this->Programacion_model->read_sending_p();
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_pr.php', $data);
    $this->load->view('templates/footer.php');
}
public function sending_pdvsa(){
    if(!$this->session->userdata('session'))redirect('login');

   

    $data['read'] = $this->Programacion_model->read_sending_pdvsa();
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_pdvsa.php', $data);
    $this->load->view('templates/footer.php');
}
public function senrendi_pdvsa(){
    if(!$this->session->userdata('session'))redirect('login');

   

    $data['read'] = $this->Programacion_model->read_sending_pdvsa_rendi();
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/senrendi_pdvsa.php', $data);
    $this->load->view('templates/footer.php');
}
public function tolist_info(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data = $this->Programacion_model->tolist_info($data);
    echo json_encode($data);
}
public function tolist_info_py(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data = $this->Programacion_model->tolist_info_py($data);
    echo json_encode($data);
} 

public function sending_upd(){
    if(!$this->session->userdata('session'))redirect('login');

   

    $data['read'] = $this->Programacion_model->read_sending_upd();
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_upd.php', $data);
    $this->load->view('templates/footer.php');
}
public function sendig_upd_pdvsa(){
    if(!$this->session->userdata('session'))redirect('login');

   

    $data['read'] = $this->Programacion_model->read_sending_upd_pdvsa();
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_upd_pdvsa.php', $data);
    $this->load->view('templates/footer.php');
}
public function sending_rend(){
    if(!$this->session->userdata('session'))redirect('login');

   

    $data['read'] = $this->Programacion_model->read_sending_red();
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_red.php', $data);
    $this->load->view('templates/footer.php');
}
public function read_send_upd() //hacer un pdf de comprobante de programacion modificada final para ver por el snc
 { //programacion
  //  $data['ver_programaciones'] = $this->Programacion_model->consultar_reprogramacion($unidad);
   //Se agrega la clase desde thirdparty para usar FPDF
   require_once APPPATH.'third_party/fpdf/fpdf.php';
    //  $unidad
   
        $pdf = new FPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('P','A4',0);
        $pdf->SetMargins(8,8,8,8);
        $pdf->SetFont('Arial','B',12);
        $pdf->Image(base_url().'baner/logo3.png',40,8,150);
            $pdf->Ln(10);
        //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
        //$pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);  
        $pdf->Cell(195,5,'COMPROBANTE DE CUMPLIMIENTO',0,1,'C');
        $pdf->Cell(195,5,'ARTICULO 38 NUMERAL 2 del',0,1,'C'); 
        $pdf->Cell(195,5,utf8_decode('Decreto con Rango Valor y Fuerza de Ley de Contrataciones Públicas'),0,1,'C');
        $pdf->Cell(195,5,'(DCRVFLCP)',0,1,'C');

        // $pdf->Image(base_url().'imagenes/logosnc.png',140,6,50);
        $pdf->SetFont('Arial','I',8);

        $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');
        $pdf->Cell(60,5,'Organo / Ente / Adscrito:',0,'C');
        $id_programacion = $this->input->get('id');
        $dat5e = $this->Programacion_model->read_sending_upd2($id_programacion);   
        if($dat5e != ''){ 
            foreach($dat5e as $date3){ 
        
            $pdf->MultiCell(100,5,  utf8_decode($date3->des_unidad), 0, 'L');
            // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
            
        }} 
        $pdf->Cell(60,5,'Rif:',0,'L');
        $dat = $this->Programacion_model->read_sending_upd2($id_programacion);   
        if($dat != ''){ 
            foreach($dat as $dat3){ 
        
            $pdf->MultiCell(100,5,  utf8_decode($dat3->rif), 0, 'L');
            // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
            
        }}
        $pdf->Cell(60,5,utf8_decode('Código ONAPRE:'),0,'L');
        $da = $this->Programacion_model->read_sending_upd2($id_programacion);   
        if($da != ''){ 
            foreach($da as $da3){ 
        
            $pdf->MultiCell(100,5,  utf8_decode($da3->codigo_onapre), 0, 'L');
            // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
            
        }}
        $pdf->Cell(60,5,utf8_decode('Ejercicio Fiscal:'),0,'L');
        $id_programacion = $this->input->get('id');
        
        $dat5 = $this->Programacion_model->read_sending_upd2($id_programacion);   
            if($dat5 != ''){ 
                foreach($dat5 as $dt5){ 
            
                $pdf->MultiCell(100,5, $dt5->anio, 0, 'L');
                // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
                
            }}
        $pdf->Cell(60,5,utf8_decode('Fecha de Registro:'),0,'L');
        $id_programacion = $this->input->get('id');
        
        $dat6 = $this->Programacion_model->read_sending_upd2($id_programacion);   
            if($dat6 != ''){ 
                foreach($dat6 as $dt6){ 
            
                $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt6->fecha)), 0, 'L');
                
            }}
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',12);

        $pdf->Cell(60,5,utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que fue recibida la'),0,1,'L');
        $pdf->Cell(60,5,utf8_decode('  Modificación de la Programación Anual correspondiente al Ejercicio Fiscal'),0,'L');
        $id_programacion = $this->input->get('id');
        $pdf->SetFont('Arial','B',12);
        $dat7 = $this->Programacion_model->read_sending_upd2($id_programacion);   
            if($dat7 != ''){ 
                foreach($dat7 as $dt7){ 
            
                $pdf->MultiCell(180,5, $dt7->anio, 0, 'C');
                // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
                
            }}
        $pdf->SetFont('Arial','',12);

        $pdf->MultiCell(200,5, utf8_decode('    de conformidad a lo establecido en el Articulo 38, numeral 2 del DCRVFLCP.'), 0, 'L');
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',10);

        $pdf->Cell(90,10,'',0,'L');
        $pdf->MultiCell(200,5, utf8_decode('    Información de la Programación y de las Contrataciones'), 0, 'L');
        $pdf->Cell(20,10,'',0,'L');

        $pdf->MultiCell(200,5, utf8_decode('    
        Artículo 38. Los contratantes sujetos al presente Decreto con Rango, Valor y Fuerza de Ley, están
        en la obligación de remitir al Servicio Nacional de Contrataciones:
        '), 0, 'L');
        $pdf->Cell(50,10,'',0,'L');

        $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
        $pdf->Cell(20,10,'',0,'L');
        $pdf->MultiCell(200,5, utf8_decode('2. Cualquier modificación a la programación de la adquisición de bienes, prestación de
        servicios y ejecución de obras, deberá ser notificada al Servicio Nacional de Contrataciones
        dentro de los quince días siguientes, contados a partir de la aprobación de la misma.
        '), 0, 'L');
        $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
        $pdf->Cell(80,5, utf8_decode('ACCIÒN CENTRALIZADA. Bs.'),0,0,'C');      
        $pdf->Cell(35,5,'% ',0,1,'C'); 
        $pdf->SetFont('Arial','',10);
        $data = $this->Programacion_model->read_sending_upd3($id_programacion);
        if($data != ''){ 
            foreach($data as $b){
                $pdf->Cell(70,5,utf8_decode('Bien:'),0,0,'C');       
                $pdf->Cell(70,5, $b->precio_total_bien_a, 0, 'L');
                $pdf->Cell(50,5,  number_format($b->porcentaje_bien_a, 2, ",", "."),0,1, 'L');
                $pdf->Cell(70,5,utf8_decode('Servicios:'),0,0,'C');       
                $pdf->Cell(70,5, $b->precio_total_serv_a, 0, 'L');
                $pdf->Cell(50,5,  number_format($b->porcentaje_serv_a, 2, ",", "."),0,1, 'L');
                $pdf->Cell(70,5,utf8_decode('Obras:'),0,0,'C');       
                $pdf->Cell(70,5, $b->precio_total_obra_a, 0, 'L');
                $pdf->Cell(50,5,  number_format($b->porcentaje_obra_a, 2, ",", "."),0,1, 'L');
                $pdf->SetFont('Arial','B',10);      
                $pdf->Cell(175,10, number_format($b->total_acc, 2, ",", "."),0,1,'C');

        
            }}
            $pdf->SetFont('Arial','B',10);

        $pdf->Cell(50,5,'ACTIVIDAD',0,0,'C'); 
        $pdf->Cell(70,5, utf8_decode('PROYECTOS. Bs.'),0,0,'C');      
        $pdf->Cell(47,5,'% ',0,1,'C'); 
        


        $id_programacion = $this->input->get('id');
                    $pdf->SetFont('Arial','',10);

        $data = $this->Programacion_model->read_sending_upd3($id_programacion);
        if($data != ''){ 
            foreach($data as $c){
                $pdf->Cell(70,5,utf8_decode('Bien:'),0,0,'C');       
                $pdf->Cell(70,5, $c->precio_total_bien, 0, 'L');
                $pdf->Cell(50,5,  number_format($c->porcentaje_bien, 2, ",", "."),0,1, 'L');
                $pdf->Cell(70,5,utf8_decode('Servicios:'),0,0,'C');       
                $pdf->Cell(70,5, $c->precio_total_serv, 0, 'L');
                $pdf->Cell(50,5,  number_format($c->porcentaje_serv, 2, ",", "."),0,1, 'L');
                $pdf->Cell(70,5,utf8_decode('Obras:'),0,0,'C');       
                $pdf->Cell(70,5, $c->precio_total_obra, 0, 'L');
                $pdf->Cell(50,5,  number_format($c->porcentaje_obra, 2, ",", "."),0,1, 'L');
                $pdf->SetFont('Arial','B',10);        
                $pdf->Cell(175,10, number_format($c->total_proy, 2, ",", "."),0,1,'C');

                
        }}         
            
        
                $pdf->SetFont('Arial','I',8);
            $pdf->Ln(2);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(60,5,utf8_decode(''),0,0,'C'); 

            $pdf->MultiCell(200,5, utf8_decode('ANTHONI CAMILO TORRES
            Director General'), 0);      
            $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
            $pdf->SetFont('Arial','B',8);

            $pdf->MultiCell(200,5, utf8_decode('Resolución CCP/ DGCJ Nº 001/2014 del 07 de Enero'), 0);
            $pdf->Cell(50,5,utf8_decode(''),0,0,'C'); 
        
            $pdf->MultiCell(200,5, utf8_decode('de 2014, publicada en Gaceta Oficial de la República'), 0);
            $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 

            $pdf->MultiCell(200,5, utf8_decode('Bolivariana de Venezuela N° 40.334 de fecha 15 de Enero de 2014'), 0);
            
        
            
                                
            $pdf->Ln(10);
            $curdate = date('d-m-Y H:i:s');
                                $pdf->SetFont('Arial','B',10);
                                $pdf->Cell(100,5,utf8_decode(''),0,0,'C'); 

                                $pdf->Cell(60,10,utf8_decode('Fecha de Emisión:'),0,0,'C'); 
                                $pdf->Cell(30,10, $curdate,0,1,'C');
                                $pdf->Cell(40,5,utf8_decode(''),0,0,'C'); 
                                $pdf->SetFont('Arial','',6);
                                $pdf->MultiCell(200,5, utf8_decode('Av. Lecuna, Parque Central, Torre Oeste, Piso 6, Caracas, Venezuela / Telf. (0212) 508.55.14 / 55.15 RIF. G-20002451-81/3'), 0);
                                
                                
                                $pdf->SetX(-15);
                                // Arial italic 8
                                $pdf->SetFont('Arial','I',8);
                                // Número de página
                                //   $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
            
            // $pdf->Ln(10);
            
            
            
            $pdf->Output('Comprobanteproyectomodifica '.$curdate.'.pdf', 'D');
            // $this->load->view('headfoot/header', $datos);
}


public function sending_rendiciones_1(){
    if(!$this->session->userdata('session'))redirect('login');

    $rif = $this->session->userdata('rif_organoente');
   

    $data['read'] = $this->Programacion_model->read_sending_prier_ren($rif);
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_ren_1.php', $data);
    $this->load->view('templates/footer.php');
}
public function sending_rendiciones_2(){
    if(!$this->session->userdata('session'))redirect('login');

    $rif = $this->session->userdata('rif_organoente');
   

    $data['read'] = $this->Programacion_model->read_sending_segun_ren($rif);
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_ren_2.php', $data);
    $this->load->view('templates/footer.php');
}
public function sending_rendiciones_3(){
    if(!$this->session->userdata('session'))redirect('login');

    $rif = $this->session->userdata('rif_organoente');
   

    $data['read'] = $this->Programacion_model->read_sending_terc_ren($rif);
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_ren_3.php', $data);
    $this->load->view('templates/footer.php');
}
public function sending_rendiciones_4(){
    if(!$this->session->userdata('session'))redirect('login');

    $rif = $this->session->userdata('rif_organoente');
   

    $data['read'] = $this->Programacion_model->read_sending_cuarto_ren($rif);
    $data['fecha'] = date('yy');

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('programacion/sending/sendig_ren_4.php', $data);
    $this->load->view('templates/footer.php');
}
}
 
