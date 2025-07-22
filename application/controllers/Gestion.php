<?php




class Gestion extends CI_Controller
{
  private function sesionIniciada()
  {
    if (!$this->session->userdata('session')) {
      redirect('login');
    }
  }

  public function dias_feriados()
  {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/feriados.php');
    $this->load->view('templates/footer.php');
  }

  public function lapsos()
  {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/lapsos.php');
    $this->load->view('templates/footer.php');
  }

  public function perfilinstitucional()
  {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/organoente.php');
    $this->load->view('templates/footer.php');
  }

  public function registrollamado()
  {
    $this->sesionIniciada();
    $data['time'] = date("Y-m-d");
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/regllamadoconcurso.php', $data);
    $this->load->view('templates/footer.php');
  }

  public function editarllamado($numeroProceso)
  {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/editllamadoconcurso.php');
    $this->load->view('templates/footer.php');
  }

  public function llamadoconcurso()
  {
    if (!$this->session->userdata('session')) {
      $this->load->view('templates/header.php');
      $this->load->view('templates/navsinsesion.php');
      $this->load->view('gestion/llamadoconcurso.php');
      $this->load->view('templates/footer.php');
    } else {
      $this->load->view('templates/header.php');
      $this->load->view('templates/navigator.php');
      $this->load->view('gestion/llamadoconcurso.php');
      $this->load->view('templates/footer.php');
    }
  }
  /////////////////////////////////////////////////////// cosulta externa de certificacion privada
  // public function certificacion1() {
  //   if (!$this->session->userdata('session')) {
  //     $data['ver_certi'] = $this->Certificacion_model->consulta_certi_exter2();
  //     $this->load->view('templates/header.php');
  //     $this->load->view('templates/navsinsesion.php');
  //     $this->load->view('certificacion/cert_publ.php', $data);
  //     $this->load->view('templates/footer.php');
  //   } else {

  //     $this->load->view('templates/header.php');
  //     $this->load->view('templates/navsinsesion.php');
  //     $this->load->view('certificacion/cert_publ.php');
  //     $this->load->view('templates/footer.php');
  //   } 

  // }

  // public function pdf() {
  //   if (!$this->session->userdata('session')) {
  //     $comprobante = $this->input->get('id');
  //     $data['time']=date("d-m-Y");
  //      // $data =	$this->Certificacion_model->certificaciones_id($data);
  //       $data['inf_pdf'] =	$this->Certificacion_model->ver_pdfs($comprobante);
  //       $data['ver_pdfs_2'] =	$this->Certificacion_model->ver_pdfs_2($comprobante);

  //       $this->load->view('templates/header.php');
  //       $this->load->view('templates/navsinsesion.php');
  // 	$this->load->view('certificacion/pdf_ext.php', $data);
  //       $this->load->view('templates/footer.php');
  //   } else {

  //     $this->load->view('templates/header.php');
  //     $this->load->view('templates/navsinsesion.php');
  //     $this->load->view('certificacion/cert_publ.php');
  //     $this->load->view('templates/footer.php');
  //   }



  // }
  /////////////////////////////////////vista de llamado a concurso modificado
  public function llamadoxterno()
  {
    if (!$this->session->userdata('session')) {
      $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
      $generar3 = $this->Publicaciones_model->generar2(); // finalizar llamad
      $generar4 = $this->Publicaciones_model->generar3(); // finalizar llamad
      $date = date("Y-m-d");
      $data['exonerado'] = $this->Certificacion_model->consultar_llamados_externos($date);
      $data['estados']    = $this->Configuracion_model->consulta_estados();
      $data['objeto']    = $this->Configuracion_model->objeto();
      $this->load->view('templates/header.php');
      $this->load->view('templates/navbarlog');

      $this->load->view('publicaciones/reporte/llamadoexterno.php', $data);
      $this->load->view('templates/footer.php');
    } else {
      $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
      $generar3 = $this->Publicaciones_model->generar2(); // finalizar llamad
      $generar4 = $this->Publicaciones_model->generar3(); // finalizar llamad
      $date = date("d-m-Y");
      $data['exonerado'] = $this->Certificacion_model->consultar_llamados_externos($date);
      $data['estados']    = $this->Configuracion_model->consulta_estados();
      $data['objeto']    = $this->Configuracion_model->objeto();
      $this->load->view('templates/header.php');
      $this->load->view('templates/navigator.php');
      $this->load->view('publicaciones/reporte/llamadoexterno.php', $data);
      $this->load->view('templates/footer.php');
    }
  }
  public function evaluaciones_internas($offset = 0)
  {
    if (!$this->session->userdata('session')) redirect('login');

    $date = date("d-m-Y");
    $rif = $this->session->userdata['rif_organoente'];

    // Definir el límite de registros por página
    $limit = 10;

    // Obtener los datos paginados
    $data['exonerado'] = $this->Publicaciones_model->consultar_llamados_internos($date, $rif, $limit, $offset);

    // Contar el total de registros
    $data['total_rows'] = $this->Publicaciones_model->count_llamados_internos($date, $rif);

    // Obtener otros datos necesarios
    $data['estados'] = $this->Configuracion_model->consulta_estados();
    $data['objeto'] = $this->Configuracion_model->objeto();
    $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
    $generar3 = $this->Publicaciones_model->generar2(); // finalizar llamad
    $generar4 = $this->Publicaciones_model->generar3(); // finalizar llamad

    // Cargar las vistas
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('publicaciones/reporte/llamadointerno.php', $data);
    $this->load->view('templates/footer.php');
  }
  public function llamadoxternot()
  {
    if (!$this->session->userdata('session')) {
      $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
      $generar3 = $this->Publicaciones_model->generar2(); // finalizar llamad
      $generar4 = $this->Publicaciones_model->generar3(); // finalizar llamad
      $date = date("d-m-Y");
      $data['exonerado'] = $this->Certificacion_model->consultar_llamados_externos($date);
      $data['estado'] = $this->input->post("estado");
      $data['objetos']     = $this->input->post("objeto");
      $data['estados']    = $this->Configuracion_model->consulta_estados();
      $objeto   = $this->Configuracion_model->objeto();
      $this->load->view('templates/header.php');
      $this->load->view('templates/navsinsesion.php');
      $this->load->view('publicaciones/reporte/llamadoexterno.php', $data, $objeto);
      $this->load->view('templates/footer.php');
    } else {
      $generar2 = $this->Publicaciones_model->generar1(); // finalizar llamad
      $generar3 = $this->Publicaciones_model->generar2(); // finalizar llamad
      $generar4 = $this->Publicaciones_model->generar3(); // finalizar llamad
      $date = date("d-m-Y");
      $data['estado'] = $this->input->post("estado");
      $data['objetos']     = $this->input->post("objeto");
      $data['estados']    = $this->Configuracion_model->consulta_estados();
      $data['objeto']    = $this->Configuracion_model->objeto();
      $data['exonerado'] = $this->Certificacion_model->consultar_llamados_externos($date);
      $this->load->view('templates/header.php');
      $this->load->view('templates/navigator.php');
      $this->load->view('publicaciones/reporte/llamadoexterno.php', $data);
      $this->load->view('templates/footer.php');
    }
  }

  public function consulta_t()
  {
    if (!$this->session->userdata('session')) {
      $data = $this->input->post();
      $data = $this->Certificacion_model->consulta_llamado($data);
      echo json_encode($data);
    } else {

      $data = $this->input->post();
      $data = $this->Certificacion_model->consulta_llamado($data);
      echo json_encode($data);
    }
  }

  ///////////////////////solicitud de claves 
  public function solicitud()
  {


    $data['final']  = $this->User_model->consulta_organoente();
    $data['clasificacion'] = $this->Configuracion_model->consulta_clasificacion();

    $data['acto'] = $this->Configuracion_model->consulta_acto_admin();

    $data['estados']    = $this->Configuracion_model->consulta_estados();
    $data['objeto']    = $this->Configuracion_model->objeto();

    $this->load->view('templates/headerlog');
    $this->load->view('templates/navbarlog');
    $this->load->view('solicitud/solicitud.php', $data);
    $this->load->view('templates/footerlog');
  }


  public function consulta_og()
  {
    $data = $this->input->post();
    $data =  $this->User_model->llenar_organos($data);
    echo json_encode($data);
  }
  public function llenar_organos_planila()
  {
    $data = $this->input->post();
    $data =  $this->User_model->llenar_organos_planila($data);
    echo json_encode($data);
  }

  public function consulta_og2()
  {
    $data = $this->input->post();
    $data =  $this->User_model->llenar_organos2($data);
    echo json_encode($data);
  }
}
