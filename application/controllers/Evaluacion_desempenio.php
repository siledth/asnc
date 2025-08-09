<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluacion_desempenio extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Preguntas_model'); // Cargar el modelo de preguntas
	}
	public function index()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$user_id = $this->session->userdata('id_user');
		if (!$this->Preguntas_model->tiene_preguntas($user_id)) {
			// Si no tiene preguntas, redirigir a la vista de creación de preguntas
			redirect(site_url('Preguntas_controller/preguntas1'));
			//$this->load->view('user/crear_preguntas_view.php');

		}
		$data['estados'] 	 = $this->Configuracion_model->consulta_estados();
		$data['pais'] 		 = $this->Configuracion_model->consulta_paises();
		$data['edo_civil'] 	 = $this->Configuracion_model->consulta_edo_civil();
		$data['operadora'] 	 = $this->Evaluacion_desempenio_model->consulta_operadora();
		$data['modalidades'] = $this->Evaluacion_desempenio_model->consulta_modalidades();
		$data['med_not'] 	 = $this->Evaluacion_desempenio_model->consulta_med_notf();
		$data['time'] = date("Y-m-d");
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/registro.php', $data);
		$this->load->view('templates/footer.php');
	}
	public function registro_snc()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data['estados'] 	 = $this->Configuracion_model->consulta_estados();
		$data['pais'] 		 = $this->Configuracion_model->consulta_paises();
		$data['edo_civil'] 	 = $this->Configuracion_model->consulta_edo_civil();
		$data['operadora'] 	 = $this->Evaluacion_desempenio_model->consulta_operadora();
		$data['modalidades'] = $this->Evaluacion_desempenio_model->consulta_modalidades();
		$data['med_not'] 	 = $this->Evaluacion_desempenio_model->consulta_med_notf();

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/evaluacion_snc/registrar_snc.php', $data);
		$this->load->view('templates/footer.php');
	}

	//Registro de Evaluacion Desempenio
	public function listar_municipio()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Configuracion_model->listar_municipio($data);
		echo json_encode($data);
	}

	public function listar_parroquia()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Configuracion_model->listar_parroquia($data);
		echo json_encode($data);
	}

	public function listar_ciudades()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Configuracion_model->listar_ciudades($data);
		echo json_encode($data);
	}

	//Consulta si existe el contrastis
	public function llenar_contratista()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_contratista($data);
		echo json_encode($data);
	}

	//Consulta si existe el contrastis2 para la rendicion se consulta la bd de rnc
	public function llenar_contratista_2()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_contratista_2($data);
		echo json_encode($data);
	}

	public function llenar_contratista_rp_2()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_contratista_rp_2($data);
		echo json_encode($data);
	}
	/////////////////

	public function llenar_contratista_rp()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_contratista_rp($data);
		echo json_encode($data);
	}


	public function llenar_contratistafn()
	{
		if (!$this->session->userdata('session')) {
			redirect('login');
		}

		$rif_b = $this->input->post('rif_b');

		// Usar la nueva función del modelo para buscar el contratista
		$contratista_data = $this->Evaluacion_desempenio_model->buscar_contratista_por_rif($rif_b);

		// Devolver el resultado en formato JSON
		echo json_encode($contratista_data);
	}
	//-------------------------------------------------

	public function llenar_sub_modalidad()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->llenar_sub_modalidad($data);
		echo json_encode($data);
	}

	public function registrar()
	{
		if (!$this->session->userdata('session')) redirect('login');

		//los datos se traen de la vista Evaluación Desempeño medianto el js(AJAX)

		$rif_cont = $this->input->POST('rif_cont');
		$rif_cont_n = $this->input->POST('rif_cont_n');

		$exitte = $this->input->POST('exitte');

		if ($rif_cont == '') {
			$rif_contrat = $rif_cont_n;
		} else {
			$rif_contrat = $rif_cont;
		}

		$data = array(
			'user_id' 			 => $this->session->userdata('id_user'),
			'edocontratista_id'  => 1,
			'objcontratista_id'  => 0,
			'nivelfinanciero_id' => 0,
			'racoficina_id' 	 => 0,
			'tipocontratista' 	 => 0,
			'estado_id' 		 => $this->input->POST('id_estado_n'),
			'ciudade_id' 		 => $this->input->POST('ciudad_n'),
			'municipio_id' 		 => $this->input->POST('id_municipio_n'),
			'parroquia_id' 		 => $this->input->POST('id_parroquia_n'),
			'rifced' 			 => $rif_contrat,
			'nombre' 			 => $this->input->POST('nombre_n'),
			'tipopersona' 		 => 0, //tipo de rif
			'dencomerciale_id' 	 => 0,
			'ultprocaprob' 		 => 0,
			'procactual' 		 => 0,
			'dirfiscal' 		 => 'no',
			'percontacto' 		 => 'N/A',
			'telf1' 		  	 => 'N/A',
			'fecactsusc_at' 	 =>  '2020-01-01',
			'fecvencsusc_at' 	 => '2020-01-01',
			'fecinscrnc_at'	     => '2020-01-01',
			'fecvencrnc_at' 	 => '2020-01-01',
			'numcertrnc' 	     => '0',
			'numcontrol_certrnc' => '0',
			'contimp_certrnc'    => '0',
			'contimp_copiarnc'   => '0',
			'codedocont' 		 => '0',
			'loginant' 			 => '0',
			'fecvencrechazo_at'  => '2020-01-01',
			'recibido' 			 => '0'
		);

		$data_repr_legal = array(
			'rif_contratista' => $rif_contrat,
			'paise_id' 		  => $this->input->POST('id_pais_n'),
			'apeacc' 		  => $this->input->POST('ape_rep_leg_n'),
			'nomacc' 		  => $this->input->POST('nom_rep_leg_n'),
			'tipo' 			  => '',
			'cedrif' 		  => $this->input->POST('ced_rep_leg_n'),
			'edocivil' 		  => $this->input->POST('ced_rep_leg_n'),
			'acc' 			  => '0',
			'jd' 			  => '0',
			'rl' 			  => '0',
			'porcacc' 		  => '0',
			'cargo' 		  => $this->input->POST('cargo_rep_leg_n'),
			'tipobl' 		  => '',
			'id_operadora' 	  => $this->input->POST('operadora_n'),
			'telf' 		      => $this->input->POST('numero_n'),
			'correo' 		  => $this->input->POST('correo_rep_leg_n')
		);

		if (!empty($_FILES['fileImagen']['name'])) {
			$config['upload_path'] = './imagenes';;
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			// $config['max_size'] = '1000px';
			// $config['max_width'] = '1000px';
			// $config['max_height'] = '1000px';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('fileImagen')) {
				$img = $this->upload->data();
			} else {
				$img = 'N/A';
				echo $this->upload->display_errors();
			}
		}
		if (!isset($img_1['file_name'])) {
			$img_1['file_name'] = "";
		}

		$dato = $_POST['radio_css'];

		if ($dato == 1) {
			$bolivares = 'on';
			$petros  = '';
			$dolar  = '';
			$euro  = '';
			$otro  = '';
		} elseif ($dato == 2) {
			$bolivares = '';
			$petros  = 'on';
			$dolar  = '';
			$euro  = '';
			$otro  = '';
		} elseif ($dato == 3) {
			$bolivares = '';
			$petros  = '';
			$dolar  = 'on';
			$euro  = '';
			$otro  = '';
		} elseif ($dato == 4) {
			$bolivares = '';
			$petros  = '';
			$dolar  = '';
			$euro  = 'on';
			$otro  = '';
		} elseif ($dato == 5) {
			$bolivares = '';
			$petros  = '';
			$dolar  = '';
			$euro  = '';
			$otro  = 'on';
		}

		$data_ev = array(
			'rif_contrat' 			=> $rif_contrat,
			'id_modalidad' 		=> $this->input->POST('id_modalidad'),
			'id_sub_modalidad' 	=> $this->input->POST('id_sub_modalidad'),
			'fec_inicio_cont'	 	=> $this->input->POST('start'),
			'fec_fin_cont' 		=> $this->input->POST('end'),
			'nro_procedimiento' 	=> $this->input->POST('nro_procedimiento'),
			'nro_contrato' 		=> $this->input->POST('nro_cont_oc_os'),
			'id_estado_contrato' 	=> $this->input->POST('id_estado_dc'),
			'bienes' 				=> $this->input->POST('cssCheckbox1'),
			'servicios' 			=> $this->input->POST('cssCheckbox2'),
			'obras' 				=> $this->input->POST('cssCheckbox3'),
			'descr_contrato' 		=> $this->input->POST('desc_contratacion'),
			'monto' 				=> $this->input->POST('monto'),
			'dolar' 				=> $dolar,
			'euro' 				=> $euro,
			'petros' 				=> $petros,
			'bolivares' 			=> $bolivares,
			'calidad' 				=> $this->input->POST('calidad'),
			'responsabilidad' 		=> $this->input->POST('responsabilidad'),
			'conocimiento' 		=> $this->input->POST('conocimiento'),
			'oportunidad' 			=> $this->input->POST('oportunidad'),
			'total_calif' 			=> $this->input->POST('total_claf'),
			'calificacion' 		=> $this->input->POST('calificacion'),
			'notf_cont' 			=> 0,
			'fecha_not' 			=> $this->input->POST('fec_notificacion'),
			'medio' 				=> $this->input->POST('medio'),
			'nro_oc_os' 			=> $this->input->POST('nro_oc_os'),
			'fileimagen' 			=> $img['file_name'],
			'id_usuario' 			=> $this->session->userdata('id_user'),
			'id_estatus'			=> 1,
			'otro' 				=> $otro,
			'mod_otro' 			=> $this->input->POST('mod_otro')
		);
		$data =	$this->Evaluacion_desempenio_model->registrar($exitte, $data, $data_ev, $data_repr_legal);
		echo json_encode($data);
	}

	//Para consultar las evaluaciones que tiene el usuarios registradas
	// public function reporte(){
	// 	if(!$this->session->userdata('session'))redirect('login');
	// 	$data['rif_organoente']= $this->session->userdata('rif_organoente');
	// 	$usuario = $this->session->userdata('id_user');
	// 	$data['reportes'] 	= $this->Evaluacion_desempenio_model->consulta_evaluaciones($usuario);
	// 	//print_r($data['reportes']);die;
	// 	$data['reportes_user'] 	= $this->Evaluacion_desempenio_model->consulta_evaluaciones2($usuario);
	// 	$this->load->view('templates/header.php');
	//     $this->load->view('templates/navigator.php');
	// 	$this->load->view('evaluacion_desempenio/reporte.php', $data);
	//     $this->load->view('templates/footer.php');
	// }

	// public function reporte($offset = 0)
	// {
	// 	if (!$this->session->userdata('session')) redirect('login');

	// 	$date = date("d-m-Y");
	// 	$rif = $this->session->userdata['rif_organoente'];

	// 	// Definir el límite de registros por página
	// 	$limit = 10;
	// 	// Obtener el término de búsqueda

	// 	$search = $this->input->get('search');
	// 	// Obtener los datos paginados
	// 	$data['reportes'] = $this->Evaluacion_desempenio_model->consultar_evaluacion_totales($date, $rif, $limit, $offset, $search);

	// 	// Contar el total de registros
	// 	$data['total_rows'] = $this->Evaluacion_desempenio_model->count_evaluaciones_totales($date, $rif, $search);

	// 	// Obtener otros datos necesarios
	// 	$data['estados'] = $this->Configuracion_model->consulta_estados();
	// 	$data['objeto'] = $this->Configuracion_model->objeto();
	// 	// $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
	// 	// $generar3 = $this->Publicaciones_model->generar2(); // finalizar llamad
	// 	// $generar4 = $this->Publicaciones_model->generar3(); // finalizar llamad

	// 	// Cargar las vistas
	// 	$this->load->view('templates/header.php');
	// 	$this->load->view('templates/navigator.php');
	// 	$this->load->view('evaluacion_desempenio/reporte.php', $data);
	// 	$this->load->view('templates/footer.php');
	// }



	// public function reporte()
	// {
	// 	if (!$this->session->userdata('session')) redirect('login');


	// 	$data['reportes_user'] 	= $this->Evaluacion_desempenio_model->consulta_evaluacionestd();

	// 	$this->load->view('templates/header.php');
	// 	$this->load->view('templates/navigator.php');
	// 	$this->load->view('evaluacion_desempenio/reporte.php', $data);
	// 	$this->load->view('templates/footer.php');
	// }
	// public function get_evaluaciones_datatable()
	// {
	// 	if (!$this->session->userdata('session')) {
	// 		echo json_encode(['error' => 'No autorizado']);
	// 		return;
	// 	}

	// 	$date = date("d-m-Y");
	// 	$rif = $this->session->userdata['rif_organoente'];

	// 	// Parámetros de DataTables
	// 	$start = $this->input->post('start');
	// 	$length = $this->input->post('length');
	// 	$search = $this->input->post('search')['value'];
	// 	$order_column = $this->input->post('order')[0]['column'];
	// 	$order_dir = $this->input->post('order')[0]['dir'];

	// 	// Obtener datos
	// 	$data['data'] = $this->Evaluacion_desempenio_model->get_evaluaciones_for_datatable(
	// 		$date,
	// 		$rif,
	// 		$start,
	// 		$length,
	// 		$search,
	// 		$order_column,
	// 		$order_dir
	// 	);

	// 	$total_records = $this->Evaluacion_desempenio_model->count_all_evaluaciones($date, $rif);
	// 	$total_filtered = $this->Evaluacion_desempenio_model->count_filtered_evaluaciones($date, $rif, $search);

	// 	$data['draw'] = $this->input->post('draw');
	// 	$data['recordsTotal'] = $total_records;
	// 	$data['recordsFiltered'] = $total_filtered;

	// 	echo json_encode($data);
	// }






	/////////////////////////////////////////////////////////


	public function reporte_final()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$user_id = $this->session->userdata('id_user');
		if (!$this->Preguntas_model->tiene_preguntas($user_id)) {
			// Si no tiene preguntas, redirigir a la vista de creación de preguntas
			redirect(site_url('Preguntas_controller/preguntas1'));
		}
		$data['rif_organoente'] = $this->session->userdata('rif_organoente');
		$usuario = $this->session->userdata('id_user');
		//print_r($data['reportes']);die;
		$data['reportes_user'] 	= $this->Evaluacion_desempenio_model->consulta_evaluaciones2($usuario);
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/consulta_tdo.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function reporte_externo()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$user_id = $this->session->userdata('id_user');
		if (!$this->Preguntas_model->tiene_preguntas($user_id)) {
			// Si no tiene preguntas, redirigir a la vista de creación de preguntas
			redirect(site_url('Preguntas_controller/preguntas1'));
		}
		$data['rif_organoente'] = $this->session->userdata('rif_organoente');
		$usuario = $this->session->userdata('id_user');
		//print_r($data['reportes']);die;
		///$data['reportes_user'] 	= $this->Evaluacion_desempenio_model->consulta_evaluaciones2($usuario);
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/consulta_externa.php', $data);
		$this->load->view('templates/footer.php');
	}
	///consulta evaluaciones por mes 
	public function generar_reporte_evaluaciones()
	{
		if (!$this->session->userdata('session')) {
			redirect('login');
		}
		$usuario = $this->session->userdata('id_user');

		$fecha_desde = $this->input->post('fecha_desde');
		$fecha_hasta = $this->input->post('fecha_hasta');

		if (empty($fecha_desde) || empty($fecha_hasta)) {
			// Manejar el caso de fechas vacías
			echo json_encode(['status' => 'error', 'message' => 'Las fechas no pueden estar vacías.']);
			return;
		}

		// Llama a la función del modelo para obtener los datos
		$data_reporte = $this->Evaluacion_desempenio_model->get_evaluaciones_por_rango($fecha_desde, $fecha_hasta, $usuario);

		echo json_encode(['status' => 'success', 'data' => $data_reporte]);
	}



	public function ver_evaluacion()
	{
		if (!$this->session->userdata('session')) redirect('login');

		$id_evaluacion = $this->input->get('id');

		$data['eval_ind'] 	= $this->Evaluacion_desempenio_model->consulta_eval_ind($id_evaluacion);
		//print_r($data['eval_ind']);die;
		$data['dt_eval']	= $this->Evaluacion_desempenio_model->consutar_dt_eval($id_evaluacion);

		$fecha_d = $data['eval_ind']['fec_inicio_cont'];
		$date_d = date("d-m-Y", strtotime($fecha_d));
		$data['fec_inicio_cont'] = $date_d;

		$fecha_h = $data['eval_ind']['fec_fin_cont'];
		$date_h = date("d-m-Y", strtotime($fecha_h));
		$data['fec_fin_cont'] = $date_h;

		$fecha_r = $data['eval_ind']['fecha_reg_eval'];
		$date_r = date("d-m-Y", strtotime($fecha_r));
		$data['fecha_reg_eval'] = $date_r;


		// $img = $data['eval_ind']['fileimagen'];
		// $separar  = explode(".", $img);
		// $data['tipo_img'] = $separar['1'];

		//print_r($data['eval_ind']);die;




		$calidad = $data['eval_ind']['calidad'];
		$data['calc_cald'] = $calidad * 25;

		$responsabilidad = $data['eval_ind']['responsabilidad'];
		$data['calc_responsabilidad'] = $responsabilidad * 25;

		$conocimiento = $data['eval_ind']['conocimiento'];
		$data['calc_conocimiento'] = $conocimiento * 25;

		$oportunidad = $data['eval_ind']['oportunidad'];
		$data['calc_oportunidad'] = $oportunidad * 25;

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/pdf_eval.php', $data);
		$this->load->view('templates/footer.php');
	}
	public function ver_evaluacion_img()
	{
		if (!$this->session->userdata('session')) redirect('login');

		$id_evaluacion = $this->input->get('id');
		$data['eval_ind'] 	= $this->Evaluacion_desempenio_model->consulta_eval_ind_img($id_evaluacion);
		//$data['dt_eval']	= $this->Evaluacion_desempenio_model->consutar_dt_eval($id_evaluacion);



		$img = $data['eval_ind']['fileimagen'];
		if ($img == 'N') {
			$data['eval_ind']['fileimagen'];
		} else {

			$separar  = explode(".", $img);
			$data['tipo_img'] = $separar['1'];
		}

		//print_r($data['eval_ind']);die;

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/img_eval.php', $data);
		$this->load->view('templates/footer.php');
	}
	public function descargar($nombre_archivo)
	{
		$this->load->helper('download');
		$this->load->model('Evaluacion_desempenio_model');

		$archivo = $this->Evaluacion_desempenio_model->get_imagen($nombre_archivo);

		if ($archivo) {
			force_download($archivo['id'], file_get_contents(base_url() . 'imagenes/' . $archivo['fileimagen']));
		} else {
			show_404();
		}
	}


	//Para La Consulta de Gráficos
	public function consulta()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/consulta.php');
		$this->load->view('templates/footer_g.php');
	}

	public function graficos()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->graficos($data);
		echo json_encode($data);
	}

	public function inf_tabla()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->inf_tabla($data);
		echo json_encode($data);
	}

	public function inf_tabla2()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->inf_tabla2($data);
		echo json_encode($data);
	}

	// CONSULTA DE CONTRATISTAS QUE CONTRATARON A NOREG

	public function estatus_contratista()
	{
		if (!$this->session->userdata('session')) redirect('login');

		$data['contrat']	= $this->Evaluacion_desempenio_model->consulta_contr_nr();

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/estatus_contratista.php', $data);
		$this->load->view('templates/footer.php');
	}

	//Anulacion de Evaluacion de Desempeños
	public function anulacion()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$usuario = $this->session->userdata('id_user');
		$data['evaluaciones']	= $this->Evaluacion_desempenio_model->consulta_eval_anul($usuario);

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/anulacion.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function resgistrar_anulacion()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$id = $this->input->POST('id');
		$d_anulacion = array(
			'id_evaluacion'   => $this->input->POST('id'),
			'nro_oficicio'    => $this->input->POST('nro_oficicio'),
			'fecha_anulacion' => $this->input->POST('fec_solicitud'),
			'nro_expediente'  => $this->input->POST('nro_expediente'),
			'nro_gacet_resol' => $this->input->POST('nro_gacet_resol'),
			'cedula_solc'     => $this->input->POST('cedula_solc'),
			'nom_ape_solc'    => $this->input->POST('nom_ape_solc'),
			'cargo'        	  => $this->input->POST('cargo'),
			'telf_solc'       => $this->input->POST('telf_solc'),
			'descp_anul'	  => $this->input->POST('descp_anul'),
			'id_usuario' 	  => $this->session->userdata('id_user'),
			'fecha_aprv_anul' => date('Y-m-d'),
		);

		$data = $this->Evaluacion_desempenio_model->save_anulacion($id, $d_anulacion);
		echo json_encode($data);
	}

	public function consulta_anulacion()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		$data =	$this->Evaluacion_desempenio_model->consulta_anulacion($data);
		echo json_encode($data);
	}

	public function proc_anulacion()
	{
		if (!$this->session->userdata('session')) redirect('login');

		$data['anulaciones']	= $this->Evaluacion_desempenio_model->consl_proc_anulacion();

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/proc_anulacion.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function resgistrar_aprv_anulacion()
	{
		if (!$this->session->userdata('session')) redirect('login');
		// $id_evaluacion = $this->input->POST('id_evaluacion');
		$data = $this->input->post();
		$data = $this->Evaluacion_desempenio_model->aprv_anulacion($data);
		echo json_encode($data);
	}

	// _______________________________________--evaluaciones realizadas por el snc
	public function registrar_snc()
	{
		if (!$this->session->userdata('session')) redirect('login');

		//los datos se traen de la vista Evaluación Desempeño medianto el js(AJAX)

		$rif_cont = $this->input->POST('rif_cont');
		$rif_cont_n = $this->input->POST('rif_cont_n');

		$exitte = $this->input->POST('exitte');

		if ($rif_cont == '') {
			$rif_contrat = $rif_cont_n;
		} else {
			$rif_contrat = $rif_cont;
		}

		$data = array(
			'user_id' 			 => $this->session->userdata('id_user'),
			'edocontratista_id'  => 1,
			'objcontratista_id'  => 0,
			'nivelfinanciero_id' => 0,
			'racoficina_id' 	 => 0,
			'tipocontratista' 	 => 0,
			'estado_id' 		 => $this->input->POST('id_estado_n'),
			'ciudade_id' 		 => $this->input->POST('ciudad_n'),
			'municipio_id' 		 => $this->input->POST('id_municipio_n'),
			'parroquia_id' 		 => $this->input->POST('id_parroquia_n'),
			'rifced' 			 => $rif_contrat,
			'nombre' 			 => $this->input->POST('nombre_n'),
			'tipopersona' 		 => 0, //tipo de rif
			'dencomerciale_id' 	 => 0,
			'ultprocaprob' 		 => 0,
			'procactual' 		 => 0,
			'dirfiscal' 		 => 'no',
			'percontacto' 		 => 'N/A',
			'telf1' 		  	 => 'N/A',
			'fecactsusc_at' 	 =>  '2020-01-01',
			'fecvencsusc_at' 	 => '2020-01-01',
			'fecinscrnc_at'	     => '2020-01-01',
			'fecvencrnc_at' 	 => '2020-01-01',
			'numcertrnc' 	     => '0',
			'numcontrol_certrnc' => '0',
			'contimp_certrnc'    => '0',
			'contimp_copiarnc'   => '0',
			'codedocont' 		 => '0',
			'loginant' 			 => '0',
			'fecvencrechazo_at'  => '2020-01-01',
			'recibido' 			 => '0'
		);

		$data_repr_legal = array(
			'rif_contratista' => $rif_contrat,
			'paise_id' 		  => $this->input->POST('id_pais_n'),
			'apeacc' 		  => $this->input->POST('ape_rep_leg_n'),
			'nomacc' 		  => $this->input->POST('nom_rep_leg_n'),
			'tipo' 			  => '',
			'cedrif' 		  => $this->input->POST('ced_rep_leg_n'),
			'edocivil' 		  => $this->input->POST('ced_rep_leg_n'),
			'acc' 			  => '0',
			'jd' 			  => '0',
			'rl' 			  => '0',
			'porcacc' 		  => '0',
			'cargo' 		  => $this->input->POST('cargo_rep_leg_n'),
			'tipobl' 		  => '',
			'id_operadora' 	  => $this->input->POST('operadora_n'),
			'telf' 		      => $this->input->POST('numero_n'),
			'correo' 		  => $this->input->POST('correo_rep_leg_n')
		);

		if (!empty($_FILES['fileImagen']['name'])) {
			$config['upload_path'] = './imagenes';;
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			// $config['max_size'] = '1000px';
			// $config['max_width'] = '1000px';
			// $config['max_height'] = '1000px';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('fileImagen')) {
				$img = $this->upload->data();
			} else {
				$img = 'N/A';
				echo $this->upload->display_errors();
			}
		}
		if (!isset($img_1['file_name'])) {
			$img_1['file_name'] = "";
		}

		$dato = $_POST['radio_css'];

		if ($dato == 1) {
			$bolivares = 'on';
			$petros  = '';
			$dolar  = '';
			$euro  = '';
			$otro  = '';
		} elseif ($dato == 2) {
			$bolivares = '';
			$petros  = 'on';
			$dolar  = '';
			$euro  = '';
			$otro  = '';
		} elseif ($dato == 3) {
			$bolivares = '';
			$petros  = '';
			$dolar  = 'on';
			$euro  = '';
			$otro  = '';
		} elseif ($dato == 4) {
			$bolivares = '';
			$petros  = '';
			$dolar  = '';
			$euro  = 'on';
			$otro  = '';
		} elseif ($dato == 5) {
			$bolivares = '';
			$petros  = '';
			$dolar  = '';
			$euro  = '';
			$otro  = 'on';
		}

		$data_ev = array(
			'rif_contrat' 			=> $rif_contrat,
			'id_modalidad' 		=> $this->input->POST('id_modalidad'),
			'id_sub_modalidad' 	=> $this->input->POST('id_sub_modalidad'),
			'fec_inicio_cont'	 	=> $this->input->POST('start'),
			'fec_fin_cont' 		=> $this->input->POST('end'),
			'nro_procedimiento' 	=> $this->input->POST('nro_procedimiento'),
			'nro_contrato' 		=> $this->input->POST('nro_cont_oc_os'),
			'id_estado_contrato' 	=> $this->input->POST('id_estado_dc'),
			'bienes' 				=> $this->input->POST('cssCheckbox1'),
			'servicios' 			=> $this->input->POST('cssCheckbox2'),
			'obras' 				=> $this->input->POST('cssCheckbox3'),
			'descr_contrato' 		=> $this->input->POST('desc_contratacion'),
			'monto' 				=> $this->input->POST('monto'),
			'dolar' 				=> $dolar,
			'euro' 				=> $euro,
			'petros' 				=> $petros,
			'bolivares' 			=> $bolivares,
			'calidad' 				=> $this->input->POST('calidad'),
			'responsabilidad' 		=> $this->input->POST('responsabilidad'),
			'conocimiento' 		=> $this->input->POST('conocimiento'),
			'oportunidad' 			=> $this->input->POST('oportunidad'),
			'total_calif' 			=> $this->input->POST('total_claf'),
			'calificacion' 		=> $this->input->POST('calificacion'),
			'notf_cont' 			=> 0,
			'fecha_not' 			=> '2023-01-01',
			'medio' 				=> 1,
			'nro_oc_os' 			=> 1,
			'fileimagen' 			=> 1,
			'id_usuario' 			=> $this->session->userdata('id_user'),
			'id_estatus'			=> 1, // snc
			'otro' 				=> $otro,
			'mod_otro' 			=> $this->input->POST('mod_otro')
		);
		$data =	$this->Evaluacion_desempenio_model->registrar_sns($exitte, $data, $data_ev, $data_repr_legal);
		echo json_encode($data);
	}

	public function consulta_2()
	{
		if (!$this->session->userdata('session'))
			redirect('login');
		$data = $this->input->post();
		$data = $this->Evaluacion_desempenio_model->consulta_2($data);
		echo json_encode($data);
	}
	public function consultar_snc()
	{ // consulta evaluaciones snc
		if (!$this->session->userdata('session')) redirect('login');
		$data['rif_organoente'] = $this->session->userdata('rif_organoente');
		$usuario = $this->session->userdata('id_user');
		$data['reportes'] 	= $this->Evaluacion_desempenio_model->consultar_snc_evalu($usuario);
		$data['reportes_user'] 	= $this->Evaluacion_desempenio_model->consulta_eval_user($usuario);
		$data['med_not'] 	 = $this->Evaluacion_desempenio_model->consulta_med_notf();
		$data['time'] = date("Y-m-d");
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/evaluacion_snc/consulta_snc.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function resgistrar_asnc()
	{
		if (!$this->session->userdata('session')) redirect('login');
		$data = $this->input->post();
		if (!empty($_FILES['fileImagen']['name'])) {
			$config['upload_path'] = './imagenes';;
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			// $config['max_size'] = '1000px';
			// $config['max_width'] = '1000px';
			// $config['max_height'] = '1000px';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('fileImagen')) {
				$img = $this->upload->data();
			} else {
				$img = 'N/A';
				echo $this->upload->display_errors();
			}
		}
		if (!isset($img_1['file_name'])) {
			$img_1['file_name'] = "";
		}


		$notifiacion = array(
			'id'   => $this->input->POST('id'),
			'fecha_not'    => $this->input->POST('fecha_not'),
			'medio'       => $this->input->POST('medio'),
			'nro_oc_os'	  => $this->input->POST('nro_oc_os'),
			'fileimagen'  => $img['file_name'],
			'id_usuario' 	  => $this->session->userdata('id_user'),
			'snc' => 1,
		);

		$data = $this->Evaluacion_desempenio_model->save_notificacion($notifiacion);
		echo json_encode($data);
	}

	public function llenar_evaluaciones_contratistas()
	{
		if (!$this->session->userdata('session')) {
			redirect('login');
		}

		$cedula = $this->input->post('nombre');
		$result = $this->Evaluacion_desempenio_model->llenar_contratista_comi_conta22($cedula);

		if (!empty($result)) {
			echo json_encode($result);
		} else {
			// Handle error
			echo json_encode(array('error' => 'No results found'));
		}
	}

	public function busquedallenar_evaluaciones_contratistas()
	{


		// Obtener el valor del select (puede ser por URL o GET)
		$tipo_persona = $this->input->get('tipo_persona'); // Si usas método GET
		// O bien:
		// $tipo_persona = $this->uri->segment(3); // Si pasas el valor como segmento de URL

		// Pasar la variable a la vista
		$data['tipo_persona'] = $tipo_persona ?? null; // Usamos null como valor por defecto

		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('contratista/consultas/evaluaciones_busqueda.php', $data);
		$this->load->view('templates/footer.php');
	}


	public function estadistica()
	{
		$user_id = $this->session->userdata('id_user');
		if (!$this->Preguntas_model->tiene_preguntas($user_id)) {
			// Si no tiene preguntas, redirigir a la vista de creación de preguntas
			redirect(site_url('Preguntas_controller/preguntas1'));
		}
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('contratista/estadisticas/estadisticas2.php');
		$this->load->view('templates/footer.php');
	}

	public function reporte()
	{
		if (!$this->session->userdata('session')) {
			redirect('login');
		}
		$this->load->view('templates/header.php');
		$this->load->view('templates/navigator.php');
		$this->load->view('evaluacion_desempenio/reporte.php');
		$this->load->view('templates/footer.php');
	}

	public function get_evaluaciones_ajax()
	{
		// Asegúrate de que la solicitud sea AJAX y de que haya sesión activa
		if (!$this->input->is_ajax_request()) {
			echo json_encode(['error' => 'Acceso denegado. Solicitud no AJAX.']);
			return;
		}
		if (!$this->session->userdata('session')) {
			echo json_encode(['error' => 'Sesión expirada. Por favor, inicie sesión nuevamente.', 'redirect' => base_url('login')]);
			return;
		}

		// Obtener los parámetros enviados por DataTables
		$draw = $this->input->post('draw');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search_value = $this->input->post('search')['value'] ?? ''; // Usa el operador null coalesce para evitar el error si 'value' no existe

		// Inicializa los valores de ordenación con valores por defecto
		$order_column_name = 'id'; // Columna por defecto para ordenar
		$order_direction = 'desc'; // Dirección por defecto

		// Verifica si los parámetros de ordenación existen antes de acceder a ellos
		$order_array = $this->input->post('order');
		$columns_array = $this->input->post('columns');

		if (!empty($order_array) && isset($order_array[0]['column']) && !empty($columns_array) && isset($columns_array[$order_array[0]['column']]['data'])) {
			$order_column_index = $order_array[0]['column'];
			$order_direction = $order_array[0]['dir'];
			$order_column_name = $columns_array[$order_column_index]['data'];
		}

		try {
			// Obtener el total de registros sin filtrar
			$total_records = $this->Evaluacion_desempenio_model->count_all_evaluaciones();

			// Obtener los registros filtrados y paginados
			$filtered_data = $this->Evaluacion_desempenio_model->get_evaluaciones_datatables($start, $length, $search_value, $order_column_name, $order_direction);
			$total_filtered_records = $this->Evaluacion_desempenio_model->count_filtered_evaluaciones($search_value);

			// Preparar la respuesta en formato JSON para DataTables
			$output = array(
				"draw" => intval($draw), // Convertir a entero para seguridad
				"recordsTotal" => intval($total_records),
				"recordsFiltered" => intval($total_filtered_records),
				"data" => $filtered_data
			);

			// Establecer el encabezado Content-Type a application/json
			$this->output->set_content_type('application/json');
			echo json_encode($output);
		} catch (Exception $e) {
			// Capturar cualquier excepción y devolver un JSON de error
			$error_message = 'Error en el servidor: ' . $e->getMessage();
			log_message('error', 'Error en get_evaluaciones_ajax: ' . $e->getMessage() . ' - Trace: ' . $e->getTraceAsString()); // Loguea el error completo
			$this->output->set_content_type('application/json');
			echo json_encode([
				"draw" => intval($draw),
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => [],
				"error" => $error_message
			]);
		}
	}



	public function generar_reporte_evaluacionessnc()
	{
		if (!$this->session->userdata('session')) {
			redirect('login');
		}

		$filtros = $this->input->post();

		// Llama a la función del modelo para obtener los datos
		$data_reporte = $this->Evaluacion_desempenio_model->get_evaluaciones_por_rangosnc($filtros);

		echo json_encode(['status' => 'success', 'data' => $data_reporte]);
	}
}
