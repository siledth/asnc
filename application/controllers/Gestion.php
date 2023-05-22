<?php




class Gestion extends CI_Controller {
  private function sesionIniciada() {
    if (!$this->session->userdata('session')) {
      redirect('login');
    }
  }

  public function dias_feriados() {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/feriados.php');
    $this->load->view('templates/footer.php');
  }

  public function lapsos() {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/lapsos.php');
    $this->load->view('templates/footer.php');
  }

  public function perfilinstitucional() {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/organoente.php');
    $this->load->view('templates/footer.php');
  }

  public function registrollamado() {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/regllamadoconcurso.php');
    $this->load->view('templates/footer.php');
  }

  public function editarllamado($numeroProceso) {
    $this->sesionIniciada();
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('gestion/editllamadoconcurso.php');
    $this->load->view('templates/footer.php');
  }

  public function llamadoconcurso() {
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
  public function certificacion1() {
    if (!$this->session->userdata('session')) {
      $data['ver_certi'] = $this->Certificacion_model->consulta_certi_exter2();
      $this->load->view('templates/header.php');
      $this->load->view('templates/navsinsesion.php');
      $this->load->view('certificacion/cert_publ.php', $data);
      $this->load->view('templates/footer.php');
    } else {
     
      $this->load->view('templates/header.php');
      $this->load->view('templates/navsinsesion.php');
      $this->load->view('certificacion/cert_publ.php');
      $this->load->view('templates/footer.php');
    } 

  }

  public function pdf() {
    if (!$this->session->userdata('session')) {
      $comprobante = $this->input->get('id');
      $data['time']=date("d-m-Y");
       // $data =	$this->Certificacion_model->certificaciones_id($data);
        $data['inf_pdf'] =	$this->Certificacion_model->ver_pdfs($comprobante);
        

        $this->load->view('templates/header.php');
        $this->load->view('templates/navsinsesion.php');
		$this->load->view('certificacion/pdf_ext.php', $data);
        $this->load->view('templates/footer.php');
    } else {
     
      $this->load->view('templates/header.php');
      $this->load->view('templates/navsinsesion.php');
      $this->load->view('certificacion/cert_publ.php');
      $this->load->view('templates/footer.php');
    }
      
    
    
  }
  /////////////////////////////////////vista de llamado a concurso modificado
  public function llamadoxterno() {
    if (!$this->session->userdata('session')) {
      $data['exonerado'] = $this->Certificacion_model->consultar_llamados_externos();
      $this->load->view('templates/header.php');
      $this->load->view('templates/navsinsesion.php');
      $this->load->view('publicaciones/reporte/llamadoexterno.php', $data);
      $this->load->view('templates/footer.php');
    } else {
      
      $this->load->view('templates/header.php');
      $this->load->view('templates/navsinsesion.php');
      $this->load->view('publicaciones/reporte/llamadoexterno.php');
      $this->load->view('templates/footer.php');
    } 

  }

  public function consulta_t() {
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
  
  
}
