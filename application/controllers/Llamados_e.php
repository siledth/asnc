<?php

require_once APPPATH.'third_party/fpdf/fpdf.php';

class Pdf extends FPDF
{
    var $id_programacion;
    var $comision_contrata_model;

    function __construct($id_programacion)
    {
        parent::__construct();
        $this->id_programacion = $id_programacion;
        $this->comision_contrata_model = new Comision_contrata_model();
    }

 

    function Header()
    {
        // Set font
        $this->SetFont('Arial','B',15);
        // Set the cell margins
        $this->SetMargins(15, 15, 15);
         $this->Image(base_url().'baner/logo3.png',30,1,150);
         $this->Ln(8);
        // Add a new cell with the header text
        // $this->Cell(0,5,utf8_decode('LLAMADO A CONCURSO'),0,1,'C');
        $this->Cell(35,3,'',0,'L');

     
        
       
  $this->Ln(1);


   
    }
    function Footer() {
        // Set the cell margins
        $this->SetMargins(30, 15, 30);
        $this->Ln(1);
    
        // Move the cursor to the bottom of the page
     
        $this->SetY(-15);
        // Add footer section
        $this->SetFont('Arial','',6);
        
        $this->Cell(220, 10, utf8_decode('                              página'). $this->PageNo(). '/'. $this->AliasNbPages, 0, 0, 'C');
        $this->SetY(-35);
     
     
    }
}

class Llamados_e extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function pdfrt()
{
    // Get the id_programacion variable from the URL
   // $id_programacion = $this->input->get('id');
    // $parametros = $this->input->get('id');
    // $separar = explode("/", $parametros);
    // // Asignar los valores a variables individuales
    // $rif_organoente = $separar[0]; // Accede al primer elemento del array
    // $numero_proceso = $separar[1]; // Accede al segundo elemento del array

    $rif_organoente = $this->input->get('rif');
    $numero_proceso = $this->input->get('numero');



    // Create a new instance of the Pdf class and pass the $id_programacion argument
    $pdf = new Pdf($numero_proceso);
    $pdf->AliasNbPages();

    // Set the document properties
    $pdf->AddPage('P','A4',0);
$pdf->SetFont('Arial','B',14);

 $pdf->Cell(150,5,'LLamado a Concurso',0,1,'C');
          $pdf->Ln(3);
       $pdf->Cell(195,3,'____________________________________________________________________________',0,1,'C');


$pdf->SetFont('Arial','B',12);

 $pdf->Cell(150,10,'Datos del Organo o Ente',0,1,'C');

       
          $data = $this->Publicaciones_model->consulta_llamado2($rif_organoente,$numero_proceso);
          foreach($data as $d){
            
              $pdf->SetFont('Arial','B',12);
              
              $pdf->Cell(60,10,'Rif:',0,0,'C');
              $pdf->SetFont('Arial','',10);

              $pdf->Cell(60,10, $d->rif_organoente,0,1,'C');
              $pdf->SetFont('Arial','B',12);

              $pdf->Cell(70,10,'Denominacion social:',0,0,'C');                  
              $pdf->SetFont('Arial','',10);
              $pdf->MultiCell(125, 10, utf8_decode($d->organoente), 0, 'L');

            //   $pdf->Cell(100,10, utf8_decode($d->organoente),0,1,'C');
              
              $pdf->SetFont('Arial','B',12);
              $pdf->Cell(60,10,'Siglas:',0,0,'C'); 
              $pdf->Cell(100,10,'Pagina Web:',0,1,'C'); 
              $pdf->SetFont('Arial','',10);
              $pdf->Cell(60,10, $d->siglas,0,0,'C');
             // $pdf->Cell(85,10,'Pagina Web:',0,0,'C'); 
             // $pdf->SetFont('Arial','',8);                  
                 $pdf->MultiCell(100,10, utf8_decode($d->web_contratante), 0, 'L');
             // $pdf->Cell(100,10, $d->web_contratante,0,1,'C');
              $pdf->Cell(195,10,'____________________________________________________________________________________________________',0,1,'C');
           $pdf->SetFont('Arial','B',12);
           $pdf->Cell(150,10,'Llamados a Concurso',0,1,'C');               
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
                 $pdf->MultiCell(180,10, utf8_decode($d->descripcion_contratacion), 0);
          $pdf->SetFont('Arial','B',12);
          $pdf->Cell(195,10,'_______________________________________________________________________________________',0,1,'C');
                 $pdf->Cell(195,5,'Lapsos',0,1,'C'); 
                 $pdf->SetFont('Arial','B',12);
             
              $pdf->Cell(60,5,'Modalidad:',0,0,'C');
              $pdf->Cell(60,5,'Mecanismo:',0,1,'C');


          $pdf->SetFont('Arial','',10);
                 $pdf->Cell(60,10, utf8_decode($d->modalidad),0,0,'C');
                   $pdf->MultiCell(100,5, utf8_decode($d->mecanismo), 0, 'L');  
                 $pdf->SetFont('Arial','B',12);

              $pdf->Cell(60,10,utf8_decode('Objeto de Contratación:'),0,0,'C'); 
                 $pdf->Cell(180,10,utf8_decode('Acto Público:'),0,1,'C');   

          $pdf->SetFont('Arial','',10);

                 $pdf->Cell(60,10, $d->objeto_contratacion,0,0,'C');   
          
          $pdf->SetFont('Arial','B',12);
             
                //  $pdf->Cell(100,10,' ',0,0,'C');

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
                              
          }
       
          $pdf->Output('llamado_concurso '.$curdate.'.pdf', 'D');
}
}