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
            'datedsg' => date("Y-m-d"),
            'acto' => $this->input->POST('acto'),
            'nacto' => $this->input->POST('nacto'),
            'facto' => $this->input->POST('facto'),
            'dura_com_desde' => $this->input->POST('dura_com_desde'),
            'dura_com_hasta' => $this->input->POST('dura_com_hasta'),
            'gaceta' => $this->input->POST('gaceta'),
            'fecha_gaceta' => $this->input->POST('fecha_gaceta'),



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
    public function logger_commission12() {
        if (!$this->session->userdata('session'))
            redirect('login');
            $parametros = $this->input->post('id_unidad');
            $separar        = explode("/", $parametros);
            $codigo= $separar['0'];
            $rif= $separar['1'];
        $data = array(

            'rif_organoente' => $rif,
            'unidad' => $codigo,
            //'datedsg' => $this->input->POST('datent'),

            'tipo_comi' => $this->input->POST('tipo_com'),
            'datedsg' => $this->input->POST('datedsg'),
            'acto' => $this->input->POST('acto'),
            'nacto' => $this->input->POST('nacto'),
            'facto' => $this->input->POST('facto'),
            'dura_com_desde' => $this->input->POST('dura_com_desde'),
            'dura_com_hasta' => $this->input->POST('dura_com_hasta'),
            'gaceta' => $this->input->POST('gaceta'),
            'fecha_gaceta' => $this->input->POST('fecha_gaceta'),



            'observacion' => $this->input->POST('observacion'),
            'id_usuario' => $this->session->userdata('id_user'),
            'fecha_creacion' => $this->input->POST('datent'),
            'fecha_notifiacion' => $this->input->POST('datent'),            
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
    public function check_comision_inf(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Comision_contrata_model->check_comision_inf($data);
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
  

    public function save_inff(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Comision_contrata_model->save_inff($data);
        echo json_encode($data);
    }
    public function save_exp(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->Comision_contrata_model->save_exp($data);
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
        $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
        $data['area'] = $this->Comision_contrata_model->check_areas();
        $data['tipo'] = $this->Comision_contrata_model->check_tipo();
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
    public function enviar_cm1()
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
        $data = $this->Comision_contrata_model->enviar_snc1($data, $des_unidad, $codigo_onapre, $rif);

        print_r($data);die;
        //echo json_encode($data);
    }
    
    public function certificadosnc()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $rif_organoente = $this->session->userdata('rif_organoente');
        $data['time']=date("Y-m-d"); // para calcular la vigencia

        $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
        $data['unidad'] 		 = $this->session->userdata('unidad');

        $data['comisiones'] = $this->Comision_contrata_model->check_logger_commissionsnc1();
        $usuario = $this->session->userdata('id_user');
        $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
        $data['area'] = $this->Comision_contrata_model->check_areas();
        $data['tipo'] = $this->Comision_contrata_model->check_tipo();

        //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
        
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('comision_contrata/certificar.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function certificado()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $rif_organoente = $this->session->userdata('rif_organoente');
        $data['time']=date("Y-m-d"); // para calcular la vigencia

        $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
        $data['unidad'] 		 = $this->session->userdata('unidad');

        $data['comisiones'] = $this->Comision_contrata_model->check_logger_commission2($rif_organoente);
        $usuario = $this->session->userdata('id_user');
        $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
        $data['area'] = $this->Comision_contrata_model->check_areas();
        $data['tipo'] = $this->Comision_contrata_model->check_tipo();

        //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
        
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('comision_contrata/certificar.php', $data);
        $this->load->view('templates/footer.php');
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
   $pdf->Image(base_url().'baner/logo3.png',30,1,150);

   //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
   //$pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);
   $pdf->Ln(3);
   
   $pdf->Cell(195,5,utf8_decode('CERTIFICADO DE CUMPLIMIENTO DE'),0,1,'C');
   $pdf->Cell(195,5,utf8_decode('NOTIFICACIÓN DE LAS DESIGNACIONES DE LOS MIEMBROS DE COMISIÓN DE'),0,1,'C'); 
   $pdf->Cell(195,5,utf8_decode('CONTRATACIONES '),0,1,'C');
   $id_programacion = $this->input->get('id');
    
   $dat5 = $this->Comision_contrata_model->comprobante($id_programacion);   
       if($dat5 != ''){ 
           foreach($dat5 as $dt5){ 
   $pdf->Cell(195,5,utf8_decode($dt5->comprobante),0,1,'C');
       
          
       }}
   $pdf->SetFont('Arial','I',8);

// c   $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
   $pdf->SetFont('Arial','',12);
 

   $da = $this->session->userdata('rif');
   
   $pdf->Ln(3);

   $pdf->Cell(60,5,utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que ha recibido la notificación'),0,1,'L');
   $pdf->Cell(60,5,utf8_decode('de las Designaciones de los Miembros de Comisión, de conformidad a lo establecido en el Artículo 14'),0,1,'L');
   $pdf->Cell(60,5,utf8_decode('del Decreto con Rango Valor y Fuerza de Ley de Contrataciones Públicas(DCRVFLCP)'),0,1,'L');
   
   $pdf->SetFont('Arial','B',9);

   $pdf->Ln(5);

   $pdf->Cell(110,3,'',0,'L');
   $pdf->MultiCell(200,1, utf8_decode('   "Integración de las Comisiones de Contrataciones'), 0, 'L');
   $pdf->Cell(5,1,'',0,'L');

   $pdf->MultiCell(180,5, utf8_decode('    
   Artículo 14. En los sujetos del presente Decreto con Rango, Valor y Fuerza de Ley, debe constituirse una o varias Comisiones de Contrataciones, que podrán ser permanentes o temporales, atendiendo a la especialidad, cantidad y complejidad de las obras a ejecutar, la adquisición de bienes y la prestación de servicios.
   '), 0, 'J');
        //    $pdf->Cell(50,10,'',0,'L');

        //    $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
   $pdf->Cell(5,1,'',0,'L');
   $pdf->SetFont('Arial','I',9);

   $pdf->MultiCell(180,4, utf8_decode('Estarán integradas por un número impar de miembros principales con sus suplentes, de calificada competencia profesional y reconocida honestidad, designados por la máxima autoridad del contratante preferentemente entre sus empleados o funcionarios, quienes serán solidariamente responsables con la máxima autoridad,  del contratante preferentemente entre sus empleados o funcionarios, quienes serán solidariamente responsables con la máxima autoridad,por las recomendaciones que se presenten sean aprobadas'), 0, 'J');
   $pdf->Ln(1);
   $pdf->Cell(5,3,'',0,'L');
   
//    $pdf->Cell(90,5,utf8_decode(' sean aprobadas.'),0,'L');
   $pdf->SetFont('Arial','B',9);
   $pdf->MultiCell(180,5, utf8_decode('Las designaciones de los miembros de las comisiones de contrataciones, se realizarán a título personal y deberán ser notificadas al Servicio Nacional de Contrataciones dentro de los cinco días siguientes, una vez dictado el acto.'), 0, 'J');
   $pdf->Cell(70,3,'',0,'L');
   
   $pdf->Cell(180,3,utf8_decode('(Negrillas nuestras)'),0,1,'L');
   $pdf->SetFont('Arial','I',9);
   $pdf->Ln(2);
   $pdf->Cell(80,5,'',0,'L');

   $pdf->Cell(180,5,utf8_decode('Omissis ... "'),0,1,'L');
   $pdf->Ln(3);


   $pdf->SetFont('Arial','B',9);
   $pdf->Cell(195,5,utf8_decode('INFORMACIÓN DE LA COMISIÓN DE CONTRATACIONES'),0,1,'C');
   $pdf->Ln(3);

   $pdf->Cell(50,5,utf8_decode('Órgano / Ente / Adscrito:'),0,0,'R'); 

   $id_programacion = $this->input->get('id');
   
   $data = $this->Comision_contrata_model->consulta_total_objeto_acc($id_programacion);
   if($data != ''){
    foreach($data as $d){    
        $pdf->SetFont('Arial','',9);
        
       $pdf->Cell(60,5, utf8_decode($d->descripcion),0,0,'L');
     //  $pdf->Cell(40,5, number_format($d->precio_total, 2, ",", "."),0,0,'R');
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(50,5,utf8_decode('RIF:'),0,0,'R'); 
     $pdf->SetFont('Arial','',9); 
     $pdf->Cell(0,5, $d->rif_organoente,0,1,'C');
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(50,5,utf8_decode('Tipo de Comisión:'),0,0,'R'); 
     $pdf->SetFont('Arial','',9);
     $pdf->Cell(60,5, utf8_decode($d->tipo_comision),0,0,'L');
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(50,5,utf8_decode('Fecha de Notificación al SNC:'),0,0,'R'); 
     $pdf->SetFont('Arial','',9); 
     $pdf->Cell(0,5, date("d/m/Y", strtotime($d->fecha_notifiacion)),0,1,'C');
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(50,5,utf8_decode('Acto Administrativo de Designación:'),0,0,'R'); 
     $pdf->SetFont('Arial','',9);
     $pdf->Cell(40,5, utf8_decode($d->desc_acto_admin),0,0,'L');
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(25,5,utf8_decode('Fecha del acto:'),0,0,'L'); 
     $pdf->SetFont('Arial','',9); 
     $pdf->Cell(25,5, date("d/m/Y", strtotime($d->fecha_acto)),0,0,'L');
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(25,5,utf8_decode('Nº del acto:'),0,0,'L'); 
     $pdf->SetFont('Arial','',9); 
     $pdf->Cell(1,5,utf8_decode( $d->num_acto),0,1,'L');
     if($d->tipo_comi == 2){ 
        $pdf->SetFont('Arial','B',9);
   $pdf->Ln(3);

        $pdf->Cell(195,3,utf8_decode('Información solo si la Comisión es Temporal'),0,1,'C');
        $pdf->Cell(50,3,utf8_decode('Objeto de la Comisión:'),0,0,'R'); 
        $pdf->SetFont('Arial','',9);
        $pdf->MultiCell(100,3, utf8_decode($d->observacion), 0, 'L');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(50,3,utf8_decode('Desde(fecha estimada):'),0,0,'R'); 
        $pdf->SetFont('Arial','',9); 
        $pdf->Cell(25,3, date("d/m/Y", strtotime($d->dura_com_desde)),0,0,'L');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(40,3,utf8_decode('Hasta(fecha estimada):'),0,0,'L'); 
        $pdf->SetFont('Arial','',9); 
        $pdf->Cell(1,3,date("d/m/Y", strtotime( $d->dura_com_hasta)),0,1,'L');
    } 
     
     } 
   }
   $pdf->SetFont('Arial','B',9);
   $pdf->Ln(3);
   $pdf->Cell(25,3,'',0,0,'L');
   $pdf->Cell(15,3,'Cedula',0,0,'L'); 
   $pdf->Cell(55,3, utf8_decode('Nombres y Apellidos'),0,0,'C'); 
   $pdf->Cell(40,3, utf8_decode('Área '),0,0,'C');      
   $pdf->Cell(30,3,'Tipo de Miembro',0,1,'R'); 

  
 
 
 
   $pdf->SetFont('Arial','B',9);
  
 
   $data = $this->Comision_contrata_model->comin($id_programacion);
    if($data != ''){
     foreach($data as $d){    
         $pdf->SetFont('Arial','',8);
   $pdf->Cell(25,3,'',0,0,'L');
         
        $pdf->Cell(15,10, $d->cedula,0,0,'L');
        $pdf->Cell(70,10, utf8_decode($d->nombre_completo),0,0,'L');
        
        $pdf->Cell(33,10, utf8_decode($d->desc_area_miembro),0,0,'L');
        $pdf->Cell(20,10, utf8_decode($d->desc_tp_miembro),0,1,'L');
   

 
 
    
     
      } 
    }

//    $pdf->SetFont('Arial','B',9);
//    $pdf->Ln(2);

//    $pdf->Cell(150,5,utf8_decode('1.- Área Jurídica'),0,1,'C');
//    $pdf->Ln(2);

//    $pdf->Cell(100,3,utf8_decode('Miembro Principal'),0,0,'C'); 
//    $pdf->Cell(50,3,utf8_decode('Miembro Suplente'),0,1,'C'); 


//    $id_programacion = $this->input->get('id');
   
//    $data2 = $this->Comision_contrata_model->consulta_mib($id_programacion);
//    if($data2 != ''){
//     foreach($data2 as $d1){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(5,3,'',0,'L');
        
//        $pdf->Cell(30,3, utf8_decode($d1->nombre),0,0,'L');
//        $pdf->Cell(30,3, utf8_decode($d1->apellido),0,0,'L');   
//      } 
//    }
//    $data2 = $this->Comision_contrata_model->consulta_mib_s_j($id_programacion);
//    if($data2 != ''){
//     foreach($data2 as $d1){    
//         $pdf->SetFont('Arial','',9);
//         $pdf->Cell(5,3,'',0,'L');

        
//        $pdf->Cell(35,3, utf8_decode($d1->nombre),0,0,'L');
//        $pdf->Cell(1,3, utf8_decode($d1->apellido),0,1,'L');   
     
//      } 
//    }
//    $data2 = $this->Comision_contrata_model->consulta_mib($id_programacion);
//    if($data2 != ''){
//     foreach($data2 as $d1){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(35,3,'',0,'L');
        
//        $pdf->Cell(30,3, utf8_decode($d1->cedula),0,0,'L');
       
//      } 
//    }    
//    $data2 = $this->Comision_contrata_model->consulta_mib_s_j($id_programacion);
//    if($data2 != ''){
//     foreach($data2 as $d1){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(55,3,'',0,'L');
        
    
//        $pdf->Cell(1,5, utf8_decode($d1->cedula),0,1,'L');   
     
//      } 
//    }
//    $pdf->SetFont('Arial','B',9);
//    $pdf->Cell(150,5,utf8_decode('2.- Área Técnica '),0,1,'C');
//    $pdf->Ln(2);

//    $pdf->Cell(100,3,utf8_decode('Miembro Principal'),0,0,'C'); 
//    $pdf->Cell(50,3,utf8_decode('Miembro Suplente'),0,1,'C'); 


//    $id_programacion = $this->input->get('id');
   
//    $data4 = $this->Comision_contrata_model->consulta_mib_tec($id_programacion);
//    if($data4 != ''){
//     foreach($data4 as $d4){    
//         $pdf->Cell(5,3,'',0,'L');

        
//        $pdf->Cell(30,3, utf8_decode($d4->nombre),0,0,'L');
//        $pdf->Cell(30,3, utf8_decode($d4->apellido),0,0,'L');   
//      } 
//    }
//    $data5 = $this->Comision_contrata_model->consulta_mib_s_t($id_programacion);
//    if($data5 != ''){
//     foreach($data5 as $d5){    
//         $pdf->SetFont('Arial','',9);
//         $pdf->Cell(5,3,'',0,'L');

        
//        $pdf->Cell(35,3, utf8_decode($d5->nombre),0,0,'L');
//        $pdf->Cell(1,3, utf8_decode($d5->apellido),0,1,'L');   
     
//      } 
//    }
//    $data2 = $this->Comision_contrata_model->consulta_mib_tec($id_programacion);
//    if($data2 != ''){
//     foreach($data2 as $d1){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(35,3,'',0,'L');
        
//        $pdf->Cell(30,3, utf8_decode($d1->cedula),0,0,'L');
       
//      } 
//    }    
//    $data5 = $this->Comision_contrata_model->consulta_mib_s_t($id_programacion);
//    if($data5 != ''){
//     foreach($data5 as $d5){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(55,3,'',0,'L');
        
    
//        $pdf->Cell(1,5, utf8_decode($d5->cedula),0,1,'L');   
     
//      } 
//    }
//    $pdf->SetFont('Arial','B',9);
//    $pdf->Cell(175,5,utf8_decode('3.- Área Económico Financiera'),0,1,'C');
//    $pdf->Ln(2);

//    $pdf->Cell(100,3,utf8_decode('Miembro Principal'),0,0,'C'); 
//    $pdf->Cell(50,3,utf8_decode('Miembro Suplente'),0,1,'C'); 


//    $id_programacion = $this->input->get('id');
   
//    $data6 = $this->Comision_contrata_model->consulta_mib_fin($id_programacion);
//    if($data6 != ''){
//     foreach($data6 as $d6){    
//         $pdf->SetFont('Arial','',9);
//         $pdf->Cell(5,3,'',0,'L');

        
//        $pdf->Cell(50,3, utf8_decode($d6->nombre),0,0,'L');
//        $pdf->Cell(30,3, utf8_decode($d6->apellido),0,0,'L');   
//      } 
//    }
//    $data7 = $this->Comision_contrata_model->consulta_mib_s_fin($id_programacion);
//    if($data7 != ''){
//     foreach($data7 as $d7){    
//         $pdf->SetFont('Arial','',9);
//         $pdf->Cell(5,3,'',0,'L');

        
//        $pdf->Cell(35,3, utf8_decode($d7->nombre),0,0,'L');
//        $pdf->Cell(1,3, utf8_decode($d7->apellido),0,1,'L');   
     
//      } 
//    }
//    $data6 = $this->Comision_contrata_model->consulta_mib_fin($id_programacion);
//    if($data6 != ''){
//     foreach($data6 as $d8){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(35,3,'',0,'L');
        
//        $pdf->Cell(30,3, utf8_decode($d8->cedula),0,0,'L');
       
//      } 
//    }    
//    $data7 = $this->Comision_contrata_model->consulta_mib_s_fin($id_programacion);
//    if($data7 != ''){
//     foreach($data7 as $d7){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(55,3,'',0,'L');
        
    
//        $pdf->Cell(1,5, utf8_decode($d7->cedula),0,1,'L');   
     
//      } 
//    }
//    $pdf->SetFont('Arial','B',9);
//    $pdf->Cell(175,5,utf8_decode('4.- Secretaría'),0,1,'C');
//    $pdf->Ln(2);

//    $pdf->Cell(100,3,utf8_decode('Secretario(a)'),0,0,'C'); 
//    $pdf->Cell(50,3,utf8_decode('Secretario(a) Suplente'),0,1,'C'); 


//    $id_programacion = $this->input->get('id');
   
//    $data9 = $this->Comision_contrata_model->consulta_mib_secre($id_programacion);
//    if($data9 != ''){
//     foreach($data9 as $d9){    
//         $pdf->SetFont('Arial','',9);
//         $pdf->Cell(5,3,'',0,'L');

        
//    $pdf->Cell(30,3, utf8_decode($d9->nombre),0,0,'L');
//    $pdf->Cell(50,3, utf8_decode($d9->apellido),0,0,'L'); 
//      } 
//    }
//    $data10 = $this->Comision_contrata_model->consulta_mib_s_decre($id_programacion);
//    if($data10 != ''){
//     foreach($data10 as $d10){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(15,3,'',0,'L');
        
//        $pdf->Cell(35,3, utf8_decode($d10->nombre),0,0,'L');
//        $pdf->Cell(1,3, utf8_decode($d10->apellido),0,1,'L');   
     
//      } 
//    }
//    $data9 = $this->Comision_contrata_model->consulta_mib_secre($id_programacion);
//    if($data9 != ''){
//     foreach($data9 as $d9){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(35,3,'',0,'L');
        
//        $pdf->Cell(30,3, utf8_decode($d9->cedula),0,0,'L');
       
//      } 
//    }    
//    $data10 = $this->Comision_contrata_model->consulta_mib_s_decre($id_programacion);
//    if($data10 != ''){
//     foreach($data10 as $d10){    
//         $pdf->SetFont('Arial','',9);
//    $pdf->Cell(55,3,'',0,'L');
        
    
//        $pdf->Cell(1,3, utf8_decode($d10->cedula),0,1,'L');   
     
//      } 
//    }
   $data11 = $this->Comision_contrata_model->con_qr($id_programacion);
   if($data11 != ''){
    foreach($data11 as $d11){    
        $pdf->SetFont('Arial','',9);
   $pdf->Cell(55,3,'',0,'L');
   $imagePath = $d11->qrcode_path;     
    
      // $pdf->Cell(1,3, utf8_decode($d11->qrcode_path),0,1,'L');   
     // $imagePath =Image($d11->qrcode_path, 10, 10, 50, 30);
      $pdf->Image(base_url().'assets/img/qrcodemiembros/'.$imagePath, 15, 235, 30);

       //$pdf->Image($imagePath, 10, 10, 50, 30);

     } 
   }
   $pdf->Ln(10);

   $pdf->Image(base_url().'baner/fp.png',70, 230, 70);
   $pdf->Ln(30);
       
    $curdate = date('d-m-Y H:i:s');
    $pdf->SetFont('Arial','',6);
    $pdf->Cell(50,2,utf8_decode(''),0,0,'C'); 
   $pdf->SetFont('Arial','',6);
    $pdf->Cell(90,4,'RIF. G-200024518  Pagina'.$pdf->PageNo().'/{nb}',0,0,'C');

    $pdf->Cell(25,2,utf8_decode('Fecha de Emisión:'),0,0,'L'); 
    $pdf->Cell(1,2, $curdate,0,1,'L');
                          
      
                          
                          // $pdf->MultiCell(200,5, utf8_decode('RIF. G-200024518'), 0);

                           
                          
                        //    $pdf->SetX(-15);
                        //   // Arial italic 8
                        //   $pdf->SetFont('Arial','',8);
                          // Número de página
                        //   $pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
      
     // $pdf->Ln(10);
    
    
     
      $pdf->Output('Comprobantemiembros '.$curdate.'.pdf', 'D');
     // $this->load->view('headfoot/header', $datos);
}

public function miemb2(){
    if(!$this->session->userdata('session'))redirect('login');
    //Información traido por el session de usuario para mostrar inf
    $data['time']=date("Y-m-d");
    $data['id_comision'] = $this->input->get('id');
    $data['carrera'] = $this->Comision_contrata_model->check_espec();
     $data['final']  = $this->Comision_contrata_model->check_organo();

    $data['ver'] = $this->Comision_contrata_model->check_miemb_certi($data['id_comision']);
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('comision_contrata/see_mb2.php', $data);
    $this->load->view('templates/footer.php');
}
public function consulta_b() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = $this->input->post();
    $data = $this->Comision_contrata_model->consulta_b($data);
    echo json_encode($data);
}
public function editar_b() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = $this->input->post();

    $data = array(
        'id_comision' => $data['id_comision'],  
        'gaceta' => $data['gace'],
        'fecha_gaceta' => $data['dateg'],
        // 'id_usuaio' => $this->session->userdata('id_user')
    );

    $data = $this->Comision_contrata_model->editar_b($data);
    echo json_encode($data);
}
public function incactiva()
{
    if(!$this->session->userdata('session')) {
        redirect('login');
    }
    $data = $this->input->post();
    
    // $des_unidad = $this->session->userdata('unidad');
    // $codigo_onapre = $this->session->userdata('codigo_onapre');
    // $rif = $this->session->userdata('rif_organoente');
    $id_comision = $data['id'];
    $data = $this->Comision_contrata_model->incactiva($data);

    print_r($data);die;
    //echo json_encode($data);
}
public function incactiva_mb()
{
    if(!$this->session->userdata('session')) {
        redirect('login');
    }
    $data = $this->input->post();
    
    // $des_unidad = $this->session->userdata('unidad');
    // $codigo_onapre = $this->session->userdata('codigo_onapre');
    // $rif = $this->session->userdata('rif_organoente');
    $id_comision = $data['id'];
    $data = $this->Comision_contrata_model->incactiva_mb($data);

    print_r($data);die;
    //echo json_encode($data);
}
public function logger_type_snc()
{
    if (!$this->session->userdata('session')) {
        redirect('login');
    }
    $rif_organoente = $this->session->userdata('rif_organoente');

    $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
    $data['unidad'] 		 = $this->session->userdata('unidad');

    $data['comisiones'] = $this->Comision_contrata_model->check_logger_commission_snc();
    $usuario = $this->session->userdata('id_user');
    $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
    $data['area'] = $this->Comision_contrata_model->check_areas();
    $data['tipo'] = $this->Comision_contrata_model->check_tipo();
    $data['final']  = $this->User_model->consulta_organoente();

   //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
    
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('comision_contrata/reg_snc.php', $data);
    $this->load->view('templates/footer.php');
}
public function save_rtre() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
       
        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre7'),
        'nombre_contratista' => $this->input->POST('nombre_conta_7'),       
        'razon_social_no_rnc' => $this->input->POST('razon_social7'),
        'rif_contr_no_rnc' => $this->input->POST('rif_7'),
        'snc' => 0,//esto sera para el comproba
        'namecurso' => $this->input->POST('namecurso'),
        'horas' => $this->input->POST('horasd'),
        'ncertificado' => $this->input->POST('ncerti'),
        'fcerti' => $this->input->POST('fcerti'),
        'vigencia' => $this->input->POST('vigencia'),
        'id_miembros' => $this->input->POST('id_miembros4'),
        'id_comision' => $this->input->POST('id_comision4'),   
    );
   

    $data = $this->Comision_contrata_model->save41($data);
    echo json_encode($data);
}
public function save_rtre8() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = array(
       
        'sel_rif_nombre' => $this->input->POST('sel_rif_nombre8'),
        'nombre_contratista' => $this->input->POST('nombre_conta_8'),       
        'razon_social_no_rnc' => $this->input->POST('razon_social8'),
        'rif_contr_no_rnc' => $this->input->POST('rif_8'),
        'snc' => 0,//esto sera para el comproba
        'namecurso' => $this->input->POST('namecurso8'),
        'horas' => $this->input->POST('horasd8'),
        'ncertificado' => $this->input->POST('ncerti8'),
        'fcerti' => $this->input->POST('fcerti8'),
        'vigencia' => $this->input->POST('vigencia8'),
        'id_miembros' => $this->input->POST('id_miembros8'),
        'id_comision' => $this->input->POST('id_comision8'),   
    );
   

    $data = $this->Comision_contrata_model->save45($data);
    echo json_encode($data);
}
public function  carga_completa()
{
    if(!$this->session->userdata('session')) {
        redirect('login');
    }
    $data = $this->input->post();
    
    $des_unidad = $this->session->userdata('unidad');
    $codigo_onapre = $this->session->userdata('codigo_onapre');
    $rif = $this->session->userdata('rif_organoente');
    $id_miembros = $data['id'];
    
    
    // $data2 = $this->Programacion_model->consulta_total_objeto_acc($id_programacion);
    
    // $data3 = $this->Programacion_model->consulta_total_acc($id_programacion);
   
    // $data4 = $this->Programacion_model->consulta_total_objeto_py2($id_programacion);
    //print_r($data4);die;
    
    // $data5 = $this->Programacion_model->consulta_total_PYT($id_programacion); 
    
    // $data = $this->Programacion_model->enviar_snc($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5);
    $data = $this->Comision_contrata_model->carga_completa($data);

    print_r($data);die;
    //echo json_encode($data);
}
public function miemb_inf(){
    if(!$this->session->userdata('session'))redirect('login');
    //Información traido por el session de usuario para mostrar inf
   
    $data['id_miembros'] = $this->input->get('id');

    $data['academico'] = $this->Comision_contrata_model->check_miemb_inf_ac($data['id_miembros']);
    $data['exp5'] = $this->Comision_contrata_model->check_miemb_inf_exp5($data['id_miembros']);
    $data['con_p'] = $this->Comision_contrata_model->check_miemb_inf_contr_pub($data['id_miembros']);
    $data['con_c'] = $this->Comision_contrata_model->check_miemb_inf_cap($data['id_miembros']);



    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('comision_contrata/see_inf.php', $data);
    $this->load->view('templates/footer.php');
}
public function consultar_t(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data['time']=date("d-m-Y");
    $data['users']= $this->session->userdata('id_user');
    $data =	$this->Comision_contrata_model->consultar_t($data);
    echo json_encode($data);
}
public function guardar_proc_pag(){ //se guardA EL NUEVO ESTATUS DEL CERTIFICADO
    if(!$this->session->userdata('session'))redirect('login');
    $data['time']=date("d-m-Y");
    $data['users']= $this->session->userdata('id_user');
    $data = $this->input->post();
    $data =	$this->Comision_contrata_model->guardar_proc_pag($data);
    echo json_encode($data);
}
public function read_send2() //hacer un pdf de comprobante programacion final para ver por el snc
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
  $pdf->Image(base_url().'baner/logo3.png',30,1,150);

  //$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');            
  //$pdf->Image(base_url().'imagenes/logosnc.png',10,6,50);
  $pdf->Ln(3);
  
  $pdf->Cell(195,5,utf8_decode('CERTIFICACIÓN DE LOS MIEMBROS DE COMISIÓN DE CONTRATACIONES'),0,1,'C');
  $id_programacion = $this->input->get('id');
   
  $dat5 = $this->Comision_contrata_model->comprobante2($id_programacion);   
      if($dat5 != ''){ 
          foreach($dat5 as $dt5){ 
  $pdf->Cell(195,5,utf8_decode($dt5->comprobante),0,1,'C');
      
         
      }}

  $da = $this->session->userdata('rif');
    
  $pdf->SetFont('Arial','',9);

  $pdf->Ln(5);

  $pdf->Cell(110,3,'',0,'L');
  $pdf->MultiCell(200,1, utf8_decode('   "Integración de las Comisiones de Contrataciones'), 0, 'L');
  $pdf->Cell(5,1,'',0,'L');

  $pdf->MultiCell(180,5, utf8_decode('    
  Artículo 14. En los sujetos del presente Decreto con Rango, Valor y Fuerza de Ley, debe constituirse una o varias Comisiones de Contrataciones, que podrán ser permanentes o temporales, atendiendo a la especialidad, cantidad y complejidad de las obras a ejecutar, la adquisición de bienes y la prestación de servicios.'), 0, 'J');
  $pdf->Cell(90,1,'',0,'L');
  
  $pdf->Cell(180,5,utf8_decode('Omissis ... '),0,1,'L');



       //    $pdf->MultiCell(200,5, utf8_decode(' . . . Omissis'), 0, 'L');
  $pdf->Cell(5,1,'',0,'L');
  $pdf->SetFont('Arial','B',9);

  $pdf->MultiCell(180,4, utf8_decode('Los miembros de las comisiones de contrataciones, deberán certificarse en materia de contrataciones públicas por ante el Servicio Nacional de Contrataciones.'), 0, 'J');
  $pdf->Ln(1);

  $pdf->Cell(70,3,'',0,'L');
  
  $pdf->Cell(180,3,utf8_decode('(Negrillas nuestras)'),0,1,'L');
  $pdf->SetFont('Arial','I',9);
  $pdf->Ln(2);
  $pdf->Cell(80,5,'',0,'L');

  $pdf->Cell(180,5,utf8_decode('Omissis ... "'),0,1,'L');
  $pdf->Ln(3);
  $pdf->MultiCell(180,4, utf8_decode('Recibida la información suministrada y de conformidad con lo establecido en el Articulo 14 del Decreto con Rango Valor y Fuerza de Ley de Contrataciones Públicas, y con la Providencia Nº DG/2024/010, de fecha 19 de mayo del año 2024, se detallada lo siguiente:'), 0, 'J');


  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(195,5,utf8_decode('INFORMACIÓN DE LA COMISIÓN DE CONTRATACIONES'),0,1,'C');
  $pdf->Ln(3);

  $pdf->Cell(50,5,utf8_decode('Órgano / Ente / Adscrito:'),0,0,'R'); 

  $id_programacion = $this->input->get('id');
  
  $data = $this->Comision_contrata_model->consulta_total_objeto_acc($id_programacion);
  if($data != ''){
   foreach($data as $d){    
       $pdf->SetFont('Arial','',9);
       
      $pdf->Cell(60,5, utf8_decode($d->descripcion),0,0,'L');
    //  $pdf->Cell(40,5, number_format($d->precio_total, 2, ",", "."),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(50,5,utf8_decode('RIF:'),0,0,'R'); 
    $pdf->SetFont('Arial','',9); 
    $pdf->Cell(0,5, $d->rif_organoente,0,1,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(50,5,utf8_decode('Tipo de Comisión:'),0,0,'R'); 
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(60,5, utf8_decode($d->tipo_comision),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(50,5,utf8_decode('Fecha de Notificación al SNC:'),0,0,'R'); 
    $pdf->SetFont('Arial','',9); 
    $pdf->Cell(0,5, date("d/m/Y", strtotime($d->fecha_notifiacion)),0,1,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(50,5,utf8_decode('Acto Administrativo de Designación:'),0,0,'R'); 
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(40,5, utf8_decode($d->desc_acto_admin),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(25,5,utf8_decode('Fecha del acto:'),0,0,'L'); 
    $pdf->SetFont('Arial','',9); 
    $pdf->Cell(25,5, date("d/m/Y", strtotime($d->fecha_acto)),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(25,5,utf8_decode('Nº del acto:'),0,0,'L'); 
    $pdf->SetFont('Arial','',9); 
    $pdf->Cell(1,5,utf8_decode( $d->num_acto),0,1,'L');
    if($d->tipo_comi == 2){ 
       $pdf->SetFont('Arial','B',9);
  $pdf->Ln(3);

       $pdf->Cell(195,3,utf8_decode('Información solo si la Comisión es Temporal'),0,1,'C');
       $pdf->Cell(50,3,utf8_decode('Objeto de la Comisión:'),0,0,'R'); 
       $pdf->SetFont('Arial','',9);
       $pdf->MultiCell(100,3, utf8_decode($d->observacion), 0, 'L');
       $pdf->SetFont('Arial','B',9);
       $pdf->Cell(50,3,utf8_decode('Desde(fecha estimada):'),0,0,'R'); 
       $pdf->SetFont('Arial','',9); 
       $pdf->Cell(25,3, date("d/m/Y", strtotime($d->dura_com_desde)),0,0,'L');
       $pdf->SetFont('Arial','B',9);
       $pdf->Cell(40,3,utf8_decode('Hasta(fecha estimada):'),0,0,'L'); 
       $pdf->SetFont('Arial','',9); 
       $pdf->Cell(1,3,date("d/m/Y", strtotime( $d->dura_com_hasta)),0,1,'L');
   } 
    
    } 
  }
  $pdf->Ln(3);
  //$pdf->Cell(10,3,'',0,0,'L');
  $pdf->Cell(15,3,'Cedula',0,0,'L'); 
  $pdf->Cell(55,3, utf8_decode('Nombres y Apellidos'),0,0,'C'); 
  $pdf->Cell(40,3, utf8_decode('Área '),0,0,'C');      
  $pdf->Cell(30,3,'Tipo de Miembro',0,0,'R'); 
//   $pdf->Cell(30,3,'Baremo Obenido',0,0,'L'); //
  $pdf->Cell(20,3,'Resultado',0,0,'L'); 
  $pdf->Cell(25,3,'Vigencia',0,1,'L');
 



  $pdf->SetFont('Arial','B',9);
 

  $data = $this->Comision_contrata_model->cct($id_programacion);
   if($data != ''){
    foreach($data as $d){    
        $pdf->SetFont('Arial','',8);
        
       $pdf->Cell(15,10, $d->cedula,0,0,'L');
       $pdf->Cell(70,10, utf8_decode($d->nombre_completo),0,0,'L');
       
       $pdf->Cell(33,10, utf8_decode($d->desc_area_miembro),0,0,'L');
       $pdf->Cell(20,10, utf8_decode($d->desc_tp_miembro),0,0,'L');
    //    if ($d->exit_rnc == '1' && $d->termino == '1') {
    //     $pdf->Cell(20,10, '100',0,0,'L');
    // } else if ($d->exit_rnc == '0' && $d->termino == '1') {
    //     $pdf->Cell(20,10, '65',0,0,'L');
    // } else if ($d->exit_rnc == '1' && $d->termino == '0') {
    //     $pdf->Cell(20,10, '85',0,0,'L');
    // } else if ($d->exit_rnc == '0' && $d->termino == '0') {
    //     $pdf->Cell(20,10, '50',0,0,'L');
    // }
    // else if ($d->exit_rnc == '' && $d->termino == '') {
    //     $pdf->Cell(20,10, '50',0,0,'L');
    // }
    // else if ($d->exit_rnc == '0' && $d->exit_rnc == '1') {
    //     $pdf->Cell(20,10, '85',0,0,'L');
    // }
   $pdf->SetFont('Arial','B',8);

    $pdf->Cell(25,10, utf8_decode($d->desc_status_miembro),0,0,'L');

   
    $pdf->Cell(1,10, date("d/m/Y", strtotime($d->vigentehasta)),0,1,'L');    
     } 
   }
   $pdf->Ln(5);
   $pdf->SetFont('Arial','B',9);
    $pdf->Cell(38,5,utf8_decode('CONTROL POSTERIOR:'),0,1,'R'); 
    $pdf->SetFont('Arial','',9);
   $pdf->MultiCell(180,4, utf8_decode('
El Servicio Nacional de Contrataciones podrá realizar las labores de control posterior y supervisión que le corresponde, para verificar la información remitida con motivo de la certificación de los miembros de la Comisión de Contrataciones, con fundamento a lo establecido en la Ley que regula la simplificación de trámites administrativos'), 0, 'J');
 
  $data11 = $this->Comision_contrata_model->con_qr($id_programacion);
  if($data11 != ''){
   foreach($data11 as $d11){    
       $pdf->SetFont('Arial','',9);
  $pdf->Cell(55,3,'',0,'L');
  $imagePath = $d11->qrcode_path;     
   
     // $pdf->Cell(1,3, utf8_decode($d11->qrcode_path),0,1,'L');   
    // $imagePath =Image($d11->qrcode_path, 10, 10, 50, 30);
     $pdf->Image(base_url().'assets/img/qrcodemiembros/'.$imagePath, 15, 235, 30);

      //$pdf->Image($imagePath, 10, 10, 50, 30);

    } 
  }
  $pdf->Ln(10);

  $pdf->Image(base_url().'baner/fp.png',70, 230, 70);


  $pdf->Ln(40);
       
  $curdate = date('d-m-Y H:i:s');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(50,2,utf8_decode(''),0,0,'C'); 
 $pdf->SetFont('Arial','',6);
  $pdf->Cell(90,4,'RIF. G-200024518  Pagina'.$pdf->PageNo().'/{nb}',0,0,'C');

  $pdf->Cell(25,2,utf8_decode('Fecha de Emisión:'),0,0,'L'); 
  $pdf->Cell(1,2, $curdate,0,1,'L');
   
   
    
     $pdf->Output('Comprobantemiembros '.$curdate.'.pdf', 'D');
    // $this->load->view('headfoot/header', $datos);
}
public function consulta_mb() {
    if (!$this->session->userdata('session'))
        redirect('login');
    $data = $this->input->post();
    $data = $this->Comision_contrata_model->consulta_mb($data);
    echo json_encode($data);
}
public function llenar_area(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Comision_contrata_model->llenar_area($data);
    echo json_encode($data);
}
public function llenar_tipo(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Comision_contrata_model->llenar_tipo($data);
    echo json_encode($data);
} 
public function editar_fila_ip_b(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Comision_contrata_model->editar_fila_ip_b($data);
    echo json_encode($data);
}
public function logger_type_sncinactivo()
{
    if (!$this->session->userdata('session')) {
        redirect('login');
    }
    $rif_organoente = $this->session->userdata('rif_organoente');
    $data['time']=date("Y-m-d"); // para calcular la vigencia

    $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
    $data['unidad'] 		 = $this->session->userdata('unidad');

    $data['comisiones'] = $this->Comision_contrata_model->check_logger_commissionsnc3inac();
    $usuario = $this->session->userdata('id_user');
    $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
    $data['area'] = $this->Comision_contrata_model->check_areas();
    $data['tipo'] = $this->Comision_contrata_model->check_tipo();

    //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
    
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('comision_contrata/consultas/consulta_com_inc.php', $data);
    $this->load->view('templates/footer.php');
}
public function logger_type_sncactivo()
{
    if (!$this->session->userdata('session')) {
        redirect('login');
    }
    $rif_organoente = $this->session->userdata('rif_organoente');
    $data['time']=date("Y-m-d"); // para calcular la vigencia

    $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
    $data['unidad'] 		 = $this->session->userdata('unidad');

    $data['comisiones'] = $this->Comision_contrata_model->check_logger_commissionsnc1();
    $usuario = $this->session->userdata('id_user');
    $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
    $data['area'] = $this->Comision_contrata_model->check_areas();
    $data['tipo'] = $this->Comision_contrata_model->check_tipo();

    //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
    
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('comision_contrata/consultas/consulta_com_act.php', $data);
    $this->load->view('templates/footer.php');
}
public function logger_type_snc_vencidos()
{
    if (!$this->session->userdata('session')) {
        redirect('login');
    }
    $rif_organoente = $this->session->userdata('rif_organoente');
    $data['time']=date("Y-m-d"); // para calcular la vigencia

    $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
    $data['unidad'] 		 = $this->session->userdata('unidad');

    $data['miembros'] = $this->Comision_contrata_model->check_logger_miebros_vencidos();
    $usuario = $this->session->userdata('id_user');
    $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
    $data['area'] = $this->Comision_contrata_model->check_areas();
    $data['tipo'] = $this->Comision_contrata_model->check_tipo();

    //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
    
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('comision_contrata/estatus_miebros/vencidos.php', $data);
    $this->load->view('templates/footer.php');
}
public function miembro_vencido_cer(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Comision_contrata_model->miembro_vencido_cer2($data);
    echo json_encode($data);
}
public function logger_type_snc_condicionado()
{
    if (!$this->session->userdata('session')) {
        redirect('login');
    }
    $rif_organoente = $this->session->userdata('rif_organoente');
    $data['time']=date("Y-m-d"); // para calcular la vigencia

    $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
    $data['unidad'] 		 = $this->session->userdata('unidad');

    $data['miembros'] = $this->Comision_contrata_model->check_logger_miebros_condicionado();
    $usuario = $this->session->userdata('id_user');
    $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
    $data['area'] = $this->Comision_contrata_model->check_areas();
    $data['tipo'] = $this->Comision_contrata_model->check_tipo();

    //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
    
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('comision_contrata/estatus_miebros/condicionado.php', $data);
    $this->load->view('templates/footer.php');
}
public function miembro_condicionado_cer(){
    if(!$this->session->userdata('session'))redirect('login');
    $data = $this->input->post();
    $data =	$this->Comision_contrata_model->miembro_condicionado_cer2($data);
    echo json_encode($data);
}
public function logger_type_snc_certificados()
{
    if (!$this->session->userdata('session')) {
        redirect('login');
    }
    $rif_organoente = $this->session->userdata('rif_organoente');
    $data['time']=date("Y-m-d"); // para calcular la vigencia

    $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
    $data['unidad'] 		 = $this->session->userdata('unidad');

    $data['miembros'] = $this->Comision_contrata_model->check_logger_miebros_certificados();
    $usuario = $this->session->userdata('id_user');
    $data['tp_contrata'] = $this->Comision_contrata_model->check_tipo_com();
    $data['area'] = $this->Comision_contrata_model->check_areas();
    $data['tipo'] = $this->Comision_contrata_model->check_tipo();

    //$data['mat'] = $this->Programacion_model->consulta_itemsr($data['id_programacion']);
    
    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('comision_contrata/estatus_miebros/certificados.php', $data);
    $this->load->view('templates/footer.php');
}
}

