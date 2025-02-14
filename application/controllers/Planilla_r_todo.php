<?php

require_once APPPATH.'third_party/fpdf/fpdf.php';

class Pdf extends FPDF
{
    var $id_programacion;
    var $Contratista_model;

    function __construct($id_programacion)
    {
        parent::__construct();
        $this->id_programacion = $id_programacion;
        $this->Contratista_model = new Contratista_model();
    }

 

    function Header()
    {
        // Set font
        $this->SetFont('Arial','B',15);
        // Set the cell margins
        $this->SetMargins(15, 15, 15);
         $this->Image(base_url().'baner/logo3.png',30,1,150);
         $this->Ln(4);
        // Add a new cell with the header text
        $this->Cell(0,5,utf8_decode('PLANILLA  RESUMEN'),0,1,'C');
        // $this->Cell(0,5,utf8_decode('SISTEMA INTEGRADO SNC'),0,1,'C');

  $this->SetFont('Arial','B',9);
  $this->Ln(1);


   
    }
    function Footer() {
        // Set the cell margins
        $this->SetMargins(30, 15, 30);
        $this->Ln(1);
        $this->SetY(-15);
        // Add footer section
        $this->SetFont('Arial','',6);
        $this->Cell(150, 5, utf8_decode('Avenida Lecuna, Parque Central, Torre Oeste, Piso 6., (0212) 508.55.99. Twitter: @snc_info 
Página Web: http://www.snc.gob.ve'). $this->PageNo(). '/'. $this->AliasNbPages, 0, 1, 'C');

        $this->Cell(150, 5, utf8_decode('RIF. G-200024518               Pagina'). $this->PageNo(). '/'. $this->AliasNbPages, 0, 0, 'C');
      
       
    }
}

class Planilla_r_todo extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function pdfrt()
{
    // Get the id_programacion variable from the URL
    $id_programacion = $this->input->get('id');

    // Create a new instance of the Pdf class and pass the $id_programacion argument
    $pdf = new Pdf($id_programacion);
    $pdf->AliasNbPages();

    // Set the document properties
    $pdf->AddPage('P', array(215.9, 279.4));

$pdf->SetFont('Arial','',12);

   
  $data = $this->Contratista_model->consulta_planillaresumen_todo1($id_programacion);
  if($data != ''){
     
   foreach($data as $d){   

                        $pdf->SetFont('Arial','B',9);
                             
                $pdf->Cell(130,5,utf8_decode('INFORMACIÓN DE LA EMPRESA  REGISTRADA:'),0,1,'R'); 

                $pdf->SetFont('Arial','',9);
               // Establecer el color rojo

                    $pdf->SetTextColor(255, 0, 0); // RGB para rojo


                    // Crear la celda con el texto

                    $pdf->MultiCell(185, 5, utf8_decode($d->descripcion), 0, 'L');


                    // Si deseas restablecer el color a negro después

                    $pdf->SetTextColor(0, 0, 0); // RGB para negro
                    $pdf->SetFont('Arial','B',9);

                    $pdf->Cell(100,5,utf8_decode('INFORMACIÓN EN EL RNC:'),0,1,'R'); 
                    $pdf->SetFont('Arial','',9);

                    $pdf->Cell(40,5,utf8_decode('Número de Certificado:'),0,0,'R'); 

                    $pdf->Cell(10,5, $d->numcertrnc,0,0,'L');          
                    $pdf->Cell(80,5,utf8_decode('Inscripción en el RNC:'),0,0,'R');
                    $pdf->Cell(10,5, $d->fecinscrnc_at,0,1,'L');          

                    $pdf->Cell(55,5,utf8_decode('Oficina Registro Auxiliar o Unico:'),0,0,'R'); 
                    // $pdf->Cell(10,5, $d->numcertrnc,0,0,'L');          
                    // $pdf->MultiCell(200,5, utf8_decode($d->numcertrnc), 0, 'L');
                    $pdf->Cell(75,5,utf8_decode('Vencimiento en el RNC:'),0,0,'R');
                    $pdf->Cell(10,5, $d->fecvencrnc_at,0,1,'L'); 
                    $pdf->SetFont('Arial','B',9);

                    $pdf->Cell(105,5,utf8_decode('DATOS GENERALES DE LA EMPRESA'),0,1,'R'); 
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(25,5,utf8_decode('Rif del Contratista:'),0,0,'R');
                    $pdf->Cell(80,5,utf8_decode('Nombre y Apellido o Razón Social:'),0,1,'R'); 


                    $pdf->Cell(60,5, $d->rifced,0,0,'L');
                    $pdf->MultiCell(200,5, utf8_decode($d->nombre), 0, 'L');

                    $pdf->Cell(14,5,utf8_decode('Tipo de Persona:'),0,0,'C'); 
                    $pdf->Cell(50,5,utf8_decode('Denominación Comercial:'),0,0,'R'); 
                    $pdf->Cell(30,5,utf8_decode('Siglas:'),0,0,'R'); 
                    $pdf->Cell(50,5,utf8_decode('Nómina Promedio Anual:'),0,1,'R'); 


                   if ($d->tipopersona ==  'J') {
                       $pdf->Cell(50, 5, utf8_decode( 'Jurídica'), 0, 0, 'L');
                       } else {  
                       $pdf->Cell(50, 5, utf8_decode( 'Persona Natural'), 0, 0, 'L');
                        
                       }

                    $pdf->Cell(70,5, $d->descdencom,0,0,'L');
                    $pdf->Cell(10,5, '',0,0,'L');
                    $pdf->Cell(30,5, $d->nomprom,0,1,'L');

                    $pdf->Cell(-5,5,utf8_decode(''),0,0,'C'); 
                    $pdf->SetFont('Arial','B',9);

                    $pdf->Cell(30,5,utf8_decode('Empresa de Seguro:'),0,0,'C'); 
                    $pdf->Cell(60,5,utf8_decode('Empresa del Vigilancia y Seguridad:'),0,0,'C'); 
                    $pdf->Cell(50,5,utf8_decode('Fabricante de Prendas Militares:'),0,0,'C'); 
                    $pdf->Cell(60,5,utf8_decode('Objeto Principal de la Empresa:'),0,1,'C'); 
                    $pdf->SetFont('Arial','',9);
                    
                    if ($d->empseguro ==  '0') {
                       $pdf->Cell(50, 5, utf8_decode( 'NO'), 0, 0, 'L');
                       } else {  
                       $pdf->Cell(50, 5, utf8_decode( 'SI'), 0, 0, 'L');
                        
                       }
                        if ($d->vigilancia ==  '0') {
                       $pdf->Cell(50, 5, utf8_decode( 'NO'), 0, 0, 'L');
                       } else {  
                       $pdf->Cell(50, 5, utf8_decode( 'SI'), 0, 0, 'L');
                        
                       }
                        if ($d->prendamilitar ==  '0') {
                       $pdf->Cell(50, 5, utf8_decode( 'NO'), 0, 0, 'L');
                       } else {  
                       $pdf->Cell(50, 5, utf8_decode( 'SI'), 0, 0, 'L');
                        
                       }
                    $pdf->Cell(30,5, $d->descobjcont,0,1,'L');
                    $pdf->SetFont('Arial','B',9);

                     $pdf->Cell(5,5,utf8_decode('Proveedor:'),0,1,'C'); 
                    
                    $pdf->SetFont('Arial','',9);
                     $pdf->Cell(-10,5,utf8_decode(':'),0,0,'C'); 

                     $pdf->Cell(20,5,utf8_decode('Fabricante:'),0,0,'C'); 

                     if ($d->provf ==  't') {
                       $pdf->Cell(50, 5, utf8_decode( 'SI'), 0, 0, 'L');
                       } else {  
                       $pdf->Cell(50, 5, utf8_decode( 'NO'), 0, 0, 'L');
                        }
                     $pdf->Cell(20,5,utf8_decode('Distribuidor:'),0,0,'C'); 

                         if ($d->provd ==  't') {
                       $pdf->Cell(50, 5, utf8_decode( 'SI'), 0, 0, 'L');
                       } else {  
                       $pdf->Cell(50, 5, utf8_decode( 'NO'), 0, 0, 'L');
                        }
                     $pdf->Cell(50,5,utf8_decode('Distribuidor Autorizado:'),0,0,'C'); 

                         if ($d->prova ==  't') {
                       $pdf->Cell(50, 5, utf8_decode( 'SI'), 0, 1, 'L');
                       } else {  
                       $pdf->Cell(50, 5, utf8_decode( 'NO'), 0, 1, 'L');
                        }
                    $pdf->SetFont('Arial','B',9);


                    $pdf->Cell(5,5,utf8_decode('Obras:'),0,0,'C'); 
                    $pdf->Cell(100,5,utf8_decode('Servicios:'),0,1,'C'); 
                    $pdf->SetFont('Arial','',9);
                     if ($d->obras ==  't') {
                       $pdf->Cell(50, 5, utf8_decode( 'SI'), 0, 0, 'L');
                       } else {  
                       $pdf->Cell(50, 5, utf8_decode( 'NO'), 0, 0, 'L');
                        }
                    $pdf->Cell(25,5,utf8_decode('Servicio:'),0,0,'C'); 

                          if ($d->servn ==  't') {
                       $pdf->Cell(40, 5, utf8_decode( 'SI'), 0, 0, 'L');
                       } else {  
                       $pdf->Cell(40, 5, utf8_decode( 'NO'), 0, 0, 'L');
                        }
                    $pdf->Cell(30,5,utf8_decode('Servicio Autorizado:'),0,0,'C'); 

                          if ($d->serva ==  't') {
                       $pdf->Cell(60, 5, utf8_decode( 'SI'), 0, 1, 'L');
                       } else {  
                       $pdf->Cell(60, 5, utf8_decode( 'NO'), 0, 1, 'L');
                        }
                    $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');

                     $pdf->SetFont('Arial','B',9);

                     $pdf->Cell(35,5,utf8_decode('Información de Domicilio Principal:'),0,1,'C');
                     $pdf->Cell(50,5,utf8_decode('Sector/Zona/URb:'),0,0,'C'); 
                     $pdf->Cell(50,5,utf8_decode('Calle/Esquina/Av:'),0,0,'C'); 
                     $pdf->Cell(60,5,utf8_decode('Edif./Quinta/Residencia:'),0,1,'C'); 
                     $pdf->SetFont('Arial','',9);

                       $pdf->Cell(70,5, $d->dir1,0,0,'L');
                       $pdf->Cell(80,5, $d->dir2,0,0,'L');
                       $pdf->Cell(70,5, $d->dir3,0,1,'L');
                    $pdf->SetFont('Arial','B',9);

                     $pdf->Cell(70,5,utf8_decode('Nro./Piso/Ofic:'),0,0,'C'); 
                     $pdf->Cell(50,5,utf8_decode('Punto de Referencia:'),0,1,'C');                     
                     $pdf->SetFont('Arial','',9);
                       $pdf->Cell(25,5, '',0,0,'L');

                       $pdf->Cell(60,5, $d->dir4,0,0,'L');
                     
                    $pdf->MultiCell(185, 5, utf8_decode($d->ptoref), 0, 'L');
                    $pdf->SetFont('Arial','B',9);
                      $pdf->Cell(-5,5,utf8_decode(''),0,0,'C'); 

                      $pdf->Cell(20,5,utf8_decode('Estado:'),0,0,'C'); 
                     $pdf->Cell(50,5,utf8_decode('Ciudad:'),0,0,'C'); 
                     $pdf->Cell(60,5,utf8_decode('Municipio:'),0,0,'C'); 
                     $pdf->Cell(60,5,utf8_decode('Parroquia:'),0,1,'C'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(40,5, $d->descedo,0,0,'L');
                     $pdf->Cell(45,5, $d->descciu,0,0,'L');
                     $pdf->Cell(70,5, $d->descmun,0,0,'L');
                     $pdf->Cell(70,5, $d->descparro,0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                     $pdf->Cell(20,5,utf8_decode('Información de Contacto:'),0,1,'C');
                     $pdf->Cell(50,5,utf8_decode('Persona Contacto:'),0,0,'C'); 
                     $pdf->Cell(50,5,utf8_decode('Teléfono Fijo o Móvil:'),0,0,'C'); 
                     $pdf->Cell(60,5,utf8_decode('Teléfono Móvil:'),0,1,'C'); 

                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(70,5, utf8_decode($d->percontacto),0,0,'L');
                     $pdf->Cell(60,5, $d->telf1,0,0,'L');
                     $pdf->Cell(70,5, $d->telf2,0,1,'L');
                     $pdf->SetFont('Arial','B',9);

                     $pdf->Cell(60,5,utf8_decode('Correo Electrónico:'),0,0,'C'); 
                     $pdf->Cell(60,5,utf8_decode('Página Web:'),0,1,'C'); 

                     $pdf->SetFont('Arial','',9);

                     $pdf->Cell(70,5, $d->email,0,0,'L');
                     $pdf->Cell(20,5, $d->website,0,1,'L');
                  


                     

            }  
    
    }
    $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');

       $pdf->SetFont('Arial','B',9);
                     $pdf->Cell(150,5,utf8_decode('Acta Constitutiva y Modificaciones Estatutarias:'),0,1,'C');
                    //  $pdf->Cell(-8,5,'',0,0,'C'); 
                    
                    //  $pdf->Cell(5,5,utf8_decode('Descripción'),0,0,'C'); 
                    //  $pdf->Cell(65,5,utf8_decode('Tipo de Registro'),0,0,'C'); 
                    //  $pdf->Cell(20,5,utf8_decode('Circunscripción'),0,0,'C'); 
                    //  $pdf->Cell(40,5,utf8_decode('Nro. de Registro'),0,0,'C'); 
                    //  $pdf->Cell(50,5,utf8_decode('Fecha de Registro'),0,0,'C'); 
                    //  $pdf->Cell(60,5,utf8_decode('Tomo'),0,0,'C'); 
                    //  $pdf->Cell(70,5,utf8_decode('Folio'),0,1,'C'); 


 
//   $data = $this->Contratista_model->consulta_planillaresumen_todo3($id_programacion);
//         if($data != ''){
//             foreach($data as $d4){    
//             $pdf->SetFont('Arial','',10);
//                      $pdf->Cell(-15,5,'',0,0,'C'); 

            
//             $pdf->Cell(1,5, utf8_decode($d4->descmodif),0,0,'L');
//             $pdf->Cell(50,5, utf8_decode($d4->descrm),0,0,'R');
//             $pdf->Cell(70,5, utf8_decode($d4->desccirjudicial),0,1,'R');

            
//         }
//      }
                       $pdf->Cell(-12,5,'',0,0,'C'); 

        $pdf->Cell(40, 5, utf8_decode('Descripción'), 1, 0, 'C'); 
        $pdf->Cell(40, 5, utf8_decode('Tipo de Registro'), 1, 0, 'C'); 
        $pdf->Cell(45, 5, utf8_decode('Circunscripción'), 1, 0, 'C'); 
        $pdf->Cell(20, 5, utf8_decode('N Registro'), 1, 0, 'C'); 
        $pdf->Cell(30, 5, utf8_decode('Fecha de Registro'), 1, 0, 'C'); 
        $pdf->Cell(10, 5, utf8_decode('Tomo'), 1, 0, 'C'); 
        $pdf->Cell(10, 5, utf8_decode('Folio'), 1, 0, 'C'); 



        $pdf->Ln(); // Salto de línea para el siguiente conjunto de celdas
        // Establecer la fuente para las filas
        $pdf->SetFont('Arial', '', 10);
// Obtener los datos
// $data = $this->Contratista_model->consulta_planillaresumen_todo3($id_programacion);

// if ($data != '') {

//     foreach ($data as $d4) {    

//         // Aquí puedes ajustar el ancho de las celdas según sea necesario
//                       $pdf->Cell(-12,5,'',0,0,'C'); 

//         $pdf->Cell(40, 5, utf8_decode($d4->descmodif), 1, 0, 'L');
//         $pdf->Cell(40, 5, utf8_decode($d4->descrm), 1, 0, 'L');
//         $pdf->Cell(45, 5, utf8_decode($d4->desccirjudicial), 1, 0, 'L');  
//         $pdf->Cell(20, 5, utf8_decode($d4->numreg), 1, 0, 'L'); // Cambia 'R' a 'L' para alineación izquierda
//         $pdf->Cell(30, 5,  $d4->fecreg_at , 1, 0, 'L'); // Cambia 'R' a 'L' para alineación izquierda
//         $pdf->Cell(10, 5,  $d4->tomo , 1, 0, 'L');
//         $pdf->Cell(10, 5,  $d4->folio , 1, 1, 'L');
//     }

// }
    function ajustarTexto($pdf, $texto, $anchoMaximo) {
    $palabras = explode(' ', $texto);
    $linea = '';
    $lineas = [];

    foreach ($palabras as $palabra) {
        // Verificar si agregar la palabra excede el ancho
        if ($pdf->GetStringWidth($linea . ' ' . $palabra) > $anchoMaximo) {
            // Almacenar la línea actual y comenzar una nueva
            $lineas[] = trim($linea);
            $linea = $palabra; // Comenzar nueva línea con la palabra actual
        } else {
            $linea .= ' ' . $palabra; // Agregar palabra a la línea
        }
    }

    // Almacenar cualquier texto restante
    if (!empty($linea)) {
        $lineas[] = trim($linea);
    }

    return $lineas; // Devolver las líneas ajustadas
}

// Uso en el bucle
$pdf->SetFont('Arial', '', 10);
$data = $this->Contratista_model->consulta_planillaresumen_todo3($id_programacion);

if ($data != '') {
    foreach ($data as $d4) {
        // Ajustar y obtener las líneas para cada campo
        $descripcion = ajustarTexto($pdf, utf8_decode($d4->descmodif), 30); // Ajustar Descripción
        $tipoRegistro = ajustarTexto($pdf, utf8_decode($d4->descrm), 50); // Ajustar Tipo de Registro
        $circunscripcion = ajustarTexto($pdf, utf8_decode($d4->desccirjudicial), 35); // Ajustar Circunscripción
        $numreg = ajustarTexto($pdf, utf8_decode($d4->numreg), 20); // Ajustar Circunscripción
        $fecreg_at = ajustarTexto($pdf, utf8_decode($d4->fecreg_at), 29); // Ajustar Circunscripción
        $tomo = ajustarTexto($pdf, utf8_decode($d4->tomo), 10); // Ajustar Circunscripción
        $folio = ajustarTexto($pdf, utf8_decode($d4->folio), 20); // Ajustar Circunscripción



        // Determinar la cantidad de líneas máximas
        $maxLineas = max(count($descripcion), count($tipoRegistro), count($circunscripcion), count($numreg));

        // Imprimir las líneas
        for ($i = 0; $i < $maxLineas; $i++) {
            // Imprimir Descripción
            $pdf->Cell(30, 5, isset($descripcion[$i]) ? $descripcion[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Tipo de Registro
            $pdf->Cell(50, 5, isset($tipoRegistro[$i]) ? $tipoRegistro[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Circunscripción
            $pdf->Cell(35, 5, isset($circunscripcion[$i]) ? $circunscripcion[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(20, 5, isset($numreg[$i]) ? $numreg[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(29, 5, isset($fecreg_at[$i]) ? $fecreg_at[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(10, 5, isset($tomo[$i]) ? $tomo[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(20, 5, isset($folio[$i]) ? $folio[$i] : '', 0, 1, 'L'); // Con borde externo

        }
    }
}    

    $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');
                   
    
     
  

  $data = $this->Contratista_model->consulta_planillaresumen_todo2($id_programacion);
  if($data != ''){
     
   foreach($data as $c){   

                        $pdf->SetFont('Arial','B',9);
                             
                $pdf->Cell(100,5,utf8_decode('Información del Registro Mercantil:'),0,1,'R'); 

                $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(30,5,utf8_decode('Dirección Fiscal:'),0,0,'C'); 
                $pdf->SetFont('Arial','',9);

                    $pdf->MultiCell(160, 5, utf8_decode($c->domfiscal), 0, 'L');
                    $pdf->SetFont('Arial','B',9);

                 $pdf->Cell(30,5,utf8_decode('Objeto Social:'),0,0,'C'); 
                $pdf->SetFont('Arial','',9);

                    $pdf->MultiCell(160, 5, utf8_decode($c->objsocial), 0, 'J');
                    $pdf->SetFont('Arial','B',9);
                  
                    $pdf->Cell(50,5,utf8_decode('Duración de la Empresa Actual:'),0,0,'C'); 
                    $pdf->SetFont('Arial','',9);

                     $pdf->Cell(50,5, date("d/m/Y", strtotime($c->fecduremp_at)),0,0,'L');
                    $pdf->SetFont('Arial','B',9);

                    $pdf->Cell(65,5,utf8_decode('Duración de la Junta Directiva Actual:'),0,0,'C'); 

                $pdf->SetFont('Arial','',9);
          // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');
                     $pdf->Cell(90,5, date("d/m/Y", strtotime($c->fecdurjd_at)),0,1,'L');
                     
                    $pdf->SetFont('Arial','B',9);

                    $pdf->Cell(50,5,utf8_decode('Cierre Fiscal Actual:'),0,0,'C'); 
                    $pdf->SetFont('Arial','',9);
                   $pdf->Cell(50, 5, $c->diaciefcal . ' /' . $c->mesciefcal, 0, 0, 'L');
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(65,5,utf8_decode('Capital Social Suscrito Actual:'),0,0,'C'); 
                    $pdf->SetFont('Arial','',9);
                     $pdf->Cell(90,5, $c->capsusc,0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                      $pdf->Cell(65,5,utf8_decode('Capital Social Pagado Actual:'),0,0,'C'); 
                    $pdf->SetFont('Arial','',9);
                     $pdf->Cell(90,5, $c->cappagado,0,1,'L');
                    $pdf->SetFont('Arial','B',9);
            }  
    
    }
    $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');

 
    $pdf->SetFont('Arial','B',9);
                             
                $pdf->Cell(140,5,utf8_decode('Accionistas, Miembros de la Junta Directiva y Representantes Legales'),0,1,'R'); 

// $pdf->Cell(-12,5,'',0,0,'C'); 
        $pdf->Cell(30, 5, utf8_decode('Apellidos'), 1, 0, 'C'); 
        $pdf->Cell(25, 5, utf8_decode('Nombres'), 1, 0, 'C'); 
        $pdf->Cell(30, 5, utf8_decode('C.I o Pasaporte'), 1, 0, 'C'); 
        $pdf->Cell(15, 5, utf8_decode('Acc'), 1, 0, 'C'); 
        $pdf->Cell(15, 5, utf8_decode('J.D'), 1, 0, 'C'); 
        $pdf->Cell(15, 5, utf8_decode('R.L'), 1, 0, 'C'); 
        $pdf->Cell(25, 5, utf8_decode('% de Acciones'), 1, 0, 'C'); 
        $pdf->Cell(20, 5, utf8_decode('Cargo'), 1, 0, 'C'); 
        $pdf->Cell(20, 5, utf8_decode('Obligación'), 1, 0, 'C'); 

   $pdf->Ln(6);
                $pdf->SetFont('Arial', '', 8);
$data = $this->Contratista_model->consulta_planillaresumen_todo4($id_programacion); 

if ($data != '') {
    foreach ($data as $d4) {
       // $pdf->Cell(-10, 5, '', 0, 0, 'C'); 

        // Ajustar y obtener las líneas para cada campo
        $apeacc = ajustarTexto($pdf, utf8_decode($d4->apeacc), 30); // Ajustar Descripción
        $nomacc = ajustarTexto($pdf, utf8_decode($d4->nomacc), 30); // Ajustar Tipo de Registro
        $tipo = ajustarTexto($pdf, utf8_decode($d4->tipo), 4); // Ajustar Circunscripción
        $cedrif = ajustarTexto($pdf, utf8_decode($d4->cedrif), 25); // Ajustar Circunscripción
        $acc_status = ajustarTexto($pdf, utf8_decode($d4->acc_status), 15); // Ajustar Circunscripción
        $jd_status = ajustarTexto($pdf, utf8_decode($d4->jd_status), 15); // Ajustar Circunscripción rl_status
        $rl_status = ajustarTexto($pdf, utf8_decode($d4->rl_status), 15); // Ajustar Circunscripción rl_status
        $porcacc = ajustarTexto($pdf, utf8_decode($d4->porcacc), 25); // Ajustar Circunscripción rl_status

        $cargo = ajustarTexto($pdf, utf8_decode($d4->cargo), 35); // Ajustar Circunscripción rl_status

         $tipobl = ajustarTexto($pdf, utf8_decode($d4->tipobl), 10);


        // $tomo = ajustarTexto($pdf, utf8_decode($d4->tomo), 10); // Ajustar Circunscripción
        // $folio = ajustarTexto($pdf, utf8_decode($d4->folio), 20); // Ajustar Circunscripción



        // Determinar la cantidad de líneas máximas
        $maxLineas = max(count($apeacc), count($nomacc), count($tipo), count($cedrif), count($acc_status) , 
        count($jd_status), count($rl_status), count($porcacc), count($cargo), count($tipobl));

        // Imprimir las líneas
        for ($i = 0; $i < $maxLineas; $i++) {
            // Imprimir Descripción
            $pdf->Cell(30, 5, isset($apeacc[$i]) ? $apeacc[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Tipo de Registro
            $pdf->Cell(30, 5, isset($nomacc[$i]) ? $nomacc[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Circunscripción
            $pdf->Cell(4, 5, isset($tipo[$i]) ? $tipo[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(25, 5, isset($cedrif[$i]) ? $cedrif[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(15, 5, isset($acc_status[$i]) ? $acc_status[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(15, 5, isset($jd_status[$i]) ? $jd_status[$i] : '', 0, 0, 'L');
            $pdf->Cell(15, 5, isset($rl_status[$i]) ? $rl_status[$i] : '', 0, 0, 'L');
            $pdf->Cell(25, 5, isset($porcacc[$i]) ? $porcacc[$i] : '', 0, 0, 'L');
            $pdf->Cell(15, 5, isset($cargo[$i]) ? $cargo[$i] : '', 0, 0, 'R');
            $pdf->Cell(15, 5, isset($tipobl[$i]) ? $tipobl[$i] : '', 0, 1, 'C');




            // $pdf->Cell(29, 5, isset($fecreg_at[$i]) ? $fecreg_at[$i] : '', 0, 0, 'L'); // Con borde externo
            // $pdf->Cell(10, 5, isset($tomo[$i]) ? $tomo[$i] : '', 0, 0, 'L'); // Con borde externo
            // $pdf->Cell(20, 5, isset($folio[$i]) ? $folio[$i] : '', 0, 1, 'L'); // Con borde externo

        }
    }
}    

    $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');
    $pdf->SetFont('Arial','B',9);
               
    $pdf->Cell(100,5,utf8_decode('Comisario(s) de la Empresas'),0,1,'R'); 
                   
        $pdf->Cell(35, 5, utf8_decode('Apellidos'), 1, 0, 'C'); 
        $pdf->Cell(35, 5, utf8_decode('Nombres'), 1, 0, 'C'); 
        $pdf->Cell(30, 5, utf8_decode('C.I o Pasaporte'), 1, 0, 'C'); 
        $pdf->Cell(35, 5, utf8_decode('Tipo de Comisario'), 1, 0, 'C'); 
        $pdf->Cell(35, 5, utf8_decode('Nro. Colegiado'), 1, 0, 'C'); 
        $pdf->Cell(25, 5, utf8_decode('Vigente Hasta'), 1, 0, 'C'); 

   $pdf->Ln(6);
                $pdf->SetFont('Arial', '', 8);
$data = $this->Contratista_model->consulta_planillaresumen_todo5($id_programacion); 

if ($data != '') {
    foreach ($data as $d5) {
       // $pdf->Cell(-10, 5, '', 0, 0, 'C'); 

        // Ajustar y obtener las líneas para cada campo
        $apecom = ajustarTexto($pdf, utf8_decode($d5->apecom), 40); // Ajustar Descripción
        $nomcom = ajustarTexto($pdf, utf8_decode($d5->nomcom), 35); // Ajustar Tipo de Registro
        $cedcom = ajustarTexto($pdf, utf8_decode($d5->cedcom), 35); // Ajustar Circunscripción
        $tipocom = ajustarTexto($pdf, utf8_decode($d5->tipocom), 35); // Ajustar Circunscripción
        $cpc = ajustarTexto($pdf, utf8_decode($d5->cpc), 25); // Ajustar Circunscripción rl_status
        $fecdurcom_at = ajustarTexto($pdf, utf8_decode($d5->fecdurcom_at), 30); // Ajustar Circunscripción rl_status
    


        // $tomo = ajustarTexto($pdf, utf8_decode($d4->tomo), 10); // Ajustar Circunscripción
        // $folio = ajustarTexto($pdf, utf8_decode($d4->folio), 20); // Ajustar Circunscripción



        // Determinar la cantidad de líneas máximas
        $maxLineas = max(count($apecom), count($nomcom),   count($cedcom), count($tipocom) , 
        count($cpc), count($fecdurcom_at));

        // Imprimir las líneas
        for ($i = 0; $i < $maxLineas; $i++) {
            // Imprimir Descripción
            $pdf->Cell(40, 5, isset($apecom[$i]) ? $apecom[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Tipo de Registro
            $pdf->Cell(35, 5, isset($nomcom[$i]) ? $nomcom[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Circunscripción
            $pdf->Cell(35, 5, isset($cedcom[$i]) ? $cedcom[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(35, 5, isset($tipocom[$i]) ? $tipocom[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(25, 5, isset($cpc[$i]) ? $cpc[$i] : '', 0, 0, 'L');
            $pdf->Cell(30, 5, isset($fecdurcom_at[$i]) ? $fecdurcom_at[$i] : '', 0, 1, 'L');

        }
    }
}   
    $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');
    $pdf->SetFont('Arial','B',9);
                
    $pdf->Cell(140,5,utf8_decode('Actividades y Productos del Catálogo de Clasificación de Compras del Estado'),0,1,'R');
                $pdf->SetFont('Arial', '', 7);
                
                
        $pdf->Cell(38, 5, utf8_decode('Descripción de las Actividades'), 1, 0, 'C'); 
        $pdf->Cell(25, 5, utf8_decode('Experiencia'), 1, 0, 'C'); 
        $pdf->Cell(13, 5, utf8_decode('Principal'), 1, 0, 'C'); 
        $pdf->Cell(30, 5, utf8_decode('Tipo'), 1, 0, 'C'); 
        $pdf->Cell(40, 5, utf8_decode('Descripción del Producto'), 1, 0, 'C'); 
        $pdf->Cell(33, 5, utf8_decode('Información del Producto'), 1, 0, 'C'); 
        $pdf->Cell(20, 5, utf8_decode('Relación'), 1, 0, 'C'); 


   $pdf->Ln(6);
                $pdf->SetFont('Arial', '', 7);
$data = $this->Contratista_model->consulta_planillaresumen_todo6($id_programacion); 

if ($data != '') {
    foreach ($data as $d6) {
       // $pdf->Cell(-10, 5, '', 0, 0, 'C'); 

        // Ajustar y obtener las líneas para cada campo
        $segmento_id = ajustarTexto($pdf, utf8_decode($d6->segmento_id), 5); // Ajustar Descripción
        $desc_seg_mostrar = ajustarTexto($pdf, utf8_decode($d6->desc_seg_mostrar), 35); // Ajustar Tipo de Registro
        $anoexp = ajustarTexto($pdf, utf8_decode($d6->anoexp), 5); // Ajustar Circunscripción
        $tipexp_status = ajustarTexto($pdf, utf8_decode($d6->tipexp_status), 16); // Ajustar Circunscripción
        $principal_status = ajustarTexto($pdf, utf8_decode($d6->principal_status), 10); // Ajustar Circunscripción rl_status
        $tipo_status = ajustarTexto($pdf, utf8_decode($d6->tipo_status), 30); // Ajustar Circunscripción rl_status
        $articulo_id = ajustarTexto($pdf, utf8_decode($d6->articulo_id), 15); // Ajustar Circunscripción rl_status
        $desc_arti_mostrar = ajustarTexto($pdf, utf8_decode($d6->desc_arti_mostrar), 25); // Ajustar Circunscripción rl_status
        $infoprod = ajustarTexto($pdf, utf8_decode($d6->infoprod), 30); // Ajustar Circunscripción rl_status
        $desctiprel = ajustarTexto($pdf, utf8_decode($d6->desctiprel), 25); // Ajustar Circunscripción rl_status
    


        // $tomo = ajustarTexto($pdf, utf8_decode($d4->tomo), 10); // Ajustar Circunscripción
        // $folio = ajustarTexto($pdf, utf8_decode($d4->folio), 20); // Ajustar Circunscripción



        // Determinar la cantidad de líneas máximas
        $maxLineas = max(count($segmento_id), count($desc_seg_mostrar),   count($anoexp), count($tipexp_status) , 
        count($principal_status), count($tipo_status) , count($articulo_id),
        count($desc_arti_mostrar), count($infoprod), count($desctiprel));

        // Imprimir las líneas
        for ($i = 0; $i < $maxLineas; $i++) {
            // Imprimir Descripción
            $pdf->Cell(5, 5, isset($segmento_id[$i]) ? $segmento_id[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Tipo de Registro
            $pdf->Cell(40, 5, isset($desc_seg_mostrar[$i]) ? $desc_seg_mostrar[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Circunscripción
            $pdf->Cell(5, 5, isset($anoexp[$i]) ? $anoexp[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(16, 5, isset($tipexp_status[$i]) ? $tipexp_status[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(10, 5, isset($principal_status[$i]) ? $principal_status[$i] : '', 0, 0, 'L');
            $pdf->Cell(30, 5, isset($tipo_status[$i]) ? $tipo_status[$i] : '', 0, 0, 'L');
            $pdf->Cell(15, 5, isset($articulo_id[$i]) ? $articulo_id[$i] : '', 0, 0, 'L');
            $pdf->Cell(25, 5, isset($desc_arti_mostrar[$i]) ? $desc_arti_mostrar[$i] : '', 0, 0, 'L');
            $pdf->Cell(25, 5, isset($infoprod[$i]) ? $infoprod[$i] : '', 0, 0, 'L');
           $pdf->Cell(25, 5, isset($desctiprel[$i]) ? $desctiprel[$i] : '', 0, 1, 'R');

        }
    }
}   





                
    $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');
      
    $pdf->SetFont('Arial','B',9);
                
    $pdf->Cell(100,5,utf8_decode('Relación de Obras y/o Servicios'),0,1,'R');
                $pdf->SetFont('Arial', '', 7);

                             $pdf->SetFont('Arial', '', 7);
                
                
        $pdf->Cell(38, 5, utf8_decode('Clientes'), 1, 0, 'C'); 
        //$pdf->Cell(30, 5, utf8_decode('Número de Contrato'), 1, 0, 'C'); 
        $pdf->Cell(50, 5, utf8_decode('Obra o servicio'), 1, 0, 'C'); 
        $pdf->Cell(40, 5, utf8_decode('Fecha Inicio'), 1, 0, 'C'); 
        $pdf->Cell(33, 5, utf8_decode('Fecha Final'), 1, 0, 'C'); 
        $pdf->Cell(33, 5, utf8_decode('Ejecutado'), 1, 0, 'C'); 



   $pdf->Ln(6);
$data = $this->Contratista_model->consulta_planillaresumen_todo7($id_programacion); 

if ($data != '') {
    foreach ($data as $d6) {
       // $pdf->Cell(-10, 5, '', 0, 0, 'C'); 

        // Ajustar y obtener las líneas para cada campo
        $cliente = ajustarTexto($pdf, utf8_decode($d6->cliente), 35); // Ajustar Tipo de Registro
      //  $numcontrato = ajustarTexto($pdf, utf8_decode($d6->numcontrato), 50);  
        $obraserv = ajustarTexto($pdf, utf8_decode($d6->obraserv), 50);  
        $fecini_at = ajustarTexto($pdf, utf8_decode($d6->fecini_at), 30);  
        $fecfin_at = ajustarTexto($pdf, utf8_decode($d6->fecfin_at), 25); 
        $porcejec = ajustarTexto($pdf, utf8_decode($d6->porcejec), 25);  
       


        // Determinar la cantidad de líneas máximas
        $maxLineas = max(  count($cliente),    count($obraserv) , 
        count($fecini_at), count($fecfin_at) , count($porcejec),
        count($desc_arti_mostrar), count($infoprod), count($desctiprel));

        // Imprimir las líneas
        for ($i = 0; $i < $maxLineas; $i++) {
            // Imprimir Descripción
            // Imprimir Tipo de Registro
            $pdf->Cell(40, 5, isset($cliente[$i]) ? $cliente[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Circunscripción
           // $pdf->Cell(30, 5, isset($numcontrato[$i]) ? $numcontrato[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(55, 5, isset($obraserv[$i]) ? $obraserv[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(35, 5, isset($fecini_at[$i]) ? $fecini_at[$i] : '', 0, 0, 'L');
            $pdf->Cell(35, 5, isset($fecfin_at[$i]) ? $fecfin_at[$i] : '', 0, 0, 'L');
            $pdf->Cell(25, 5, isset($porcejec[$i]) ? $porcejec[$i] : '', 0, 1, 'L');
        

        }
    }
}  
    $pdf->SetFont('Arial','B',9);

 $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');
      
    $pdf->SetFont('Arial','B',9);
                
    $pdf->Cell(100,5,utf8_decode('Relación de Clientes'),0,1,'R');
                $pdf->SetFont('Arial', '', 7);

                             $pdf->SetFont('Arial', '', 7);
                
                
        $pdf->Cell(38, 5, utf8_decode('Clientes'), 1, 0, 'C'); 
      //  $pdf->Cell(30, 5, utf8_decode('Número de Contrato'), 1, 0, 'C'); 
        $pdf->Cell(50, 5, utf8_decode('Objeto del Contrato'), 1, 0, 'C'); 
        $pdf->Cell(40, 5, utf8_decode('Persona Contacto'), 1, 0, 'C'); 
        $pdf->Cell(33, 5, utf8_decode('Teléfono'), 1, 0, 'C'); 
        $pdf->Cell(33, 5, utf8_decode('Descripción del Producto'), 1, 0, 'C'); 



   $pdf->Ln(6);
$data = $this->Contratista_model->consulta_planillaresumen_todo8($id_programacion); 

if ($data != '') {
    foreach ($data as $d6) {
       // $pdf->Cell(-10, 5, '', 0, 0, 'C'); 

        // Ajustar y obtener las líneas para cada campo
        $cliente = ajustarTexto($pdf, utf8_decode($d6->cliente), 35); // Ajustar Tipo de Registro
       // $numcontrato = ajustarTexto($pdf, utf8_decode($d6->numcontrato), 50);  
        $objcontrato = ajustarTexto($pdf, utf8_decode($d6->objcontrato), 50);  
        $replegal = ajustarTexto($pdf, utf8_decode($d6->replegal), 30);  
        $telf1 = ajustarTexto($pdf, utf8_decode($d6->telf1), 25); 
        $prodrel = ajustarTexto($pdf, utf8_decode($d6->prodrel), 25);  
       


        // Determinar la cantidad de líneas máximas
        $maxLineas = max(  count($cliente),   count($objcontrato) , 
        count($replegal), count($telf1) , count($prodrel));

        // Imprimir las líneas
        for ($i = 0; $i < $maxLineas; $i++) {
            // Imprimir Descripción
            // Imprimir Tipo de Registro
            $pdf->Cell(40, 5, isset($cliente[$i]) ? $cliente[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Circunscripción
           // $pdf->Cell(30, 5, isset($numcontrato[$i]) ? $numcontrato[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(55, 5, isset($objcontrato[$i]) ? $objcontrato[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(35, 5, isset($replegal[$i]) ? $replegal[$i] : '', 0, 0, 'L');
            $pdf->Cell(35, 5, isset($telf1[$i]) ? $telf1[$i] : '', 0, 0, 'L');
            $pdf->Cell(25, 5, isset($prodrel[$i]) ? $prodrel[$i] : '', 0, 1, 'L');
        

        }
    }
}  
$pdf->SetFont('Arial','B',9);

 $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');
      
                
    $pdf->Cell(100,5,utf8_decode('Informes de Distribución'),0,1,'R');
                $pdf->SetFont('Arial', '', 7);

                             $pdf->SetFont('Arial', '', 7);
                
                
        $pdf->Cell(38, 5, utf8_decode('Producto'), 1, 0, 'C'); 
      //  $pdf->Cell(30, 5, utf8_decode('Número de Contrato'), 1, 0, 'C'); 
        $pdf->Cell(50, 5, utf8_decode('Marca'), 1, 0, 'C'); 
        $pdf->Cell(40, 5, utf8_decode('Capacidad de Almacenaje'), 1, 0, 'C'); 
        $pdf->Cell(33, 5, utf8_decode('Mercadeo del Producto'), 1, 0, 'C'); 



   $pdf->Ln(6);
$data = $this->Contratista_model->consulta_planillaresumen_todo9($id_programacion); 

if ($data != '') {
    foreach ($data as $d6) {
       // $pdf->Cell(-10, 5, '', 0, 0, 'C'); 

        // Ajustar y obtener las líneas para cada campo
        $desc_arti_mostrar = ajustarTexto($pdf, utf8_decode($d6->desc_arti_mostrar), 35); // Ajustar Tipo de Registro
       // $numcontrato = ajustarTexto($pdf, utf8_decode($d6->numcontrato), 50);  
        $marca = ajustarTexto($pdf, utf8_decode($d6->marca), 50);  
        $capalm = ajustarTexto($pdf, utf8_decode($d6->capalm), 30);  
        $total = ajustarTexto($pdf, utf8_decode($d6->total), 25); 
       


        // Determinar la cantidad de líneas máximas
        $maxLineas = max(  count($desc_arti_mostrar), count($marca) , 
        count($capalm), count($total)  );

        // Imprimir las líneas
        for ($i = 0; $i < $maxLineas; $i++) {
            // Imprimir Descripción
            // Imprimir Tipo de Registro
            $pdf->Cell(40, 5, isset($desc_arti_mostrar[$i]) ? $desc_arti_mostrar[$i] : '', 0, 0, 'L'); // Sin borde interno
            // Imprimir Circunscripción
           // $pdf->Cell(30, 5, isset($numcontrato[$i]) ? $numcontrato[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(55, 5, isset($marca[$i]) ? $marca[$i] : '', 0, 0, 'L'); // Con borde externo
            $pdf->Cell(35, 5, isset($capalm[$i]) ? $capalm[$i] : '', 0, 0, 'L');
            $pdf->Cell(35, 5, isset($total[$i]) ? $total[$i] : '', 0,1, 'L');
        

        }
    }
}
$pdf->SetFont('Arial','B',9);

 $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');
    $pdf->Cell(100,5,utf8_decode('Dictamen de Auditoría'),0,1,'R');
    $data = $this->Contratista_model->consulta_planillaresumen_todo10($id_programacion);
  if($data != ''){
     
   foreach($data as $c){   

                $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Apellidos del Contador Público Colegiado:'),0,0,'L'); 
                    $pdf->Cell(30,5,utf8_decode('Nombres del Contador Público Colegiado:'),0,1,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(100,5, utf8_decode($c->apecont),0,0,'L');
                     $pdf->Cell(90,5, utf8_decode($c->nomcont),0,1,'L');

                $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Cédula del Contador Público Colegiado:'),0,0,'L'); 
                    $pdf->Cell(30,5,utf8_decode('Número del Contador Público Colegiado:'),0,1,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(100,5, utf8_decode($c->cedcont),0,0,'L');
                     $pdf->Cell(90,5, utf8_decode($c->cpc),0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Fecha del Dictamen:'),0,0,'L'); 
                    $pdf->Cell(30,5,utf8_decode('Nombre de la firma de la Auditoría:'),0,1,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(90,5, date("d/m/Y", strtotime($c->fecha_at)),0,0,'L');
                     $pdf->Cell(90,5, utf8_decode($c->firmaaudit),0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                     
                     $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Presenta Dictamen de opinión Limpia:'),0,0,'L'); 
                    $pdf->Cell(30,5,utf8_decode('Presenta Dictamen de Absteción de Opinión:'),0,1,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(90,5, utf8_decode($c->opilimpia_status),0,0,'L');
                     $pdf->Cell(90,5, utf8_decode($c->abstopinion_status),0,1,'L');
                    $pdf->SetFont('Arial','B',9);

               $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Opinión con Salvedad:'),0,1,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(90,5, utf8_decode($c->opinion),0,1,'L');

            }  
    
    }
    $pdf->SetFont('Arial','B',9);

 $pdf->Cell(170, 5, '________________________________________________________________________________________________________________________', 0, 1, 'C');
  $pdf->SetFont('Arial','B',9);  
 $pdf->Cell(100,5,utf8_decode('Balance General de Cierre'),0,1,'R');

    $data = $this->Contratista_model->consulta_planillaresumen_todo11($id_programacion);
  if($data != ''){
     
   foreach($data as $c){   

                $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Fecha del Balance:'),0,0,'L'); 
                    $pdf->Cell(30,5,utf8_decode('¿Es Balance de Apertura?:'),0,1,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(90,5, date("d/m/Y", strtotime($c->fecbalgen_at)),0,0,'L');
                     $pdf->Cell(90,5, utf8_decode($c->apertura_status),0,1,'L');

                $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Tuvo Actididad Económica:'),0,0,'L'); 
                    $pdf->Cell(30,5,utf8_decode('Los Valores del Balance están a Costos Históricos:'),0,1,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(100,5, utf8_decode($c->actecon_status),0,0,'L');
                     $pdf->Cell(90,5, utf8_decode($c->costohist_status),0,1,'L');
                       $pdf->SetFont('Arial','B',9);  
 $pdf->Cell(100,5,utf8_decode('ACTIVOS'),0,1,'R');
 $pdf->Cell(100,5,utf8_decode('ACTIVO CIRCULANTE'),0,1,'R');


                    $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Efecivo en Caja Y Banco:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->caja_banco), 2, ".", ","),0,1,'L');
                    $pdf->SetFont('Arial','B',9);

                     $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Inversiones Temporales:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->invtemp), 2, ".", ","),0,1,'L');
                  $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Cuentas por Cobrar Comerciales:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->cxccom), 2, ".", ","),0,1,'L');
                             
                    $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('(Provisión Para Cuentas Incobrales):'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->provctasinco), 2, ".", ","),0,1,'L');
                            
                    $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Cuentas por Cobrar Neto:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->cxcneto), 2, ".", ","),0,1,'L');
                           $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Retenciones por Cobrar:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->retxcobrar), 2, ".", ","),0,1,'L');
                         
                           $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Otras Cuentas por Cobrar:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrcxc), 2, ".", ","),0,1,'L');
                          $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Efectos por Cobrar:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->efectos_cobrar), 2, ".", ","),0,1,'L');
                       
                           $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('(Efectos por Cobrar Descontados):'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->efectos_desc), 2, ".", ","),0,1,'L');
                       
                       
                           $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Efectos por Cobrar Descontados Neto:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->efectos_neto), 2, ".", ","),0,1,'L');
                      
                        $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Inventarios:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->inventarios), 2, ".", ","),0,1,'L');
                         $pdf->SetFont('Arial','B',9);
                    // Crear la celda con el texto
                    $pdf->Cell(-10,5,'',0,0,'L'); 

                    $pdf->Cell(100,5,utf8_decode('Anticipos Otorgados:'),0,0,'L'); 

                $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->antotorgados), 2, ".", ","),0,1,'L');
                      
                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Gastos Prepagados:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->gastprepagados), 2, ".", ","),0,1,'L');
                      
                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otros Activos Circulantes:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otractcirc), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL ACTIVO CIRCULANTE:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totactcirc), 2, ".", ","),0,1,'L');

                $pdf->Cell(100,5,utf8_decode('PROPIEDAD, PLANTA Y EQUIPOS'),0,1,'R');
                
                   $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Edificaciones:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->edif), 2, ".", ","),0,1,'L');
                    
                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Maquinarias Y Equipo:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->maqequipos), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Mobiliario y Vehículo:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->mobvehiculos), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('(Depreciación Acumulada):'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->depacum), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Propiedades, Plantas y Equipos Neto:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->ppe_neto), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Terrenos:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->terrenos), 2, ".", ","),0,1,'L');
 
                   $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Construcciones en Proceso :'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->constproc), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otras Propiedades, Plantas y Equipos :'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrppe), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL PROPIEDAD, PLANTA Y EQUIPOS:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totppe), 2, ".", ","),0,1,'L');
 
                $pdf->Cell(100,5,utf8_decode('OTROS ACTIVOS'),0,1,'R');

                $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Inversiones Acciones:  '),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->invacciones), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Inversiones Bonos:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->invbonos), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otras Inversiones a Largo Plazo :'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrinvlp), 2, ".", ","),0,1,'L');

                $pdf->Cell(100,5,utf8_decode('Cuentas Por Cobrar a Largo Plazo:'),0,1,'R');


                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Comerciales:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->cxclpcom), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Accionistas y Empleados:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->cxclpaccemp), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Compañías Relacionadas:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->cxclpcomprel), 2, ".", ","),0,1,'L');
                $pdf->SetFont('Arial','B',9);

                $pdf->Cell(100,5,utf8_decode('CARGOS DIFERIDOS'),0,1,'R');

                $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Dépositos en Garantia:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->depgarantia), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otros Activos:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otractivos), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL OTROS ACTIVOS'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->tototractivos), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL ACTIVOS:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totactivos), 2, ".", ","),0,1,'L');
                $pdf->SetFont('Arial','B',9);

                $pdf->Cell(100,5,utf8_decode('PASIVO Y PATRIMONIO:'),0,1,'R');
                $pdf->Cell(100,5,utf8_decode('PASIVO CIRCULANTE:'),0,1,'R');

                $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode(' Deudas y Sobregiros Bancarios:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->deusob), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Efectos Por Pagar:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->efecxp), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Cuentas Por Pagar:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->ctasxp), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Impuestos por Pagar:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->impxp), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Retenciones y Contribuciones por Pagar:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->retcontxp), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Dividendos por Pagar:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->divxp), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Gastos Acumulados por Pagar'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->gastacumxp), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Anticipos Recibidos :'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->antrecib), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Porción Circulante Deuda a Largo Plazo:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->circdeudalp), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Participación Estatuaria:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->partestat), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otras cuentas por Pagar:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrascxp), 2, ".", ","),0,1,'L');


                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otros Pasivos Circulantes:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrpascirc), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL PASIVO CIRCULANTE:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totpascirc), 2, ".", ","),0,1,'L');

                       $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL PASIVO CIRCULANTE:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totpascirc), 2, ".", ","),0,1,'L');
            $pdf->SetFont('Arial','B',9);

                $pdf->Cell(100,5,utf8_decode(' PASIVO A LARGO PLAZO:'),0,1,'R');


                       $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Deuda a Largo Plazo'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->deudalp), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Prestaciones Sociales:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->prestsociales), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otros Pasivos a Largo Plazo:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrplp), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL PASIVO A LARGO PLAZO:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totpaslp), 2, ".", ","),0,1,'L');

 $pdf->SetFont('Arial','B',9);

                $pdf->Cell(100,5,utf8_decode('OTROS PASIVO:'),0,1,'R');

$pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Cuentas Por Pagar Accionistas/Empleados:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->cxpaccemp), 2, ".", ","),0,1,'L');


$pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Cuentas Por Pagar Compañías Relacionadas:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->cxpcomprel), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Créditos Diferidos:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->creddif), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otros Pasivos:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrpasivos), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL OTROS PASIVOS:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->tototrpasivos), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL PASIVOS:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totpasivos), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);

                $pdf->Cell(100,5,utf8_decode('PATRIMONIO:'),0,1,'R');

  $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Capital Social Actualizado:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->capsocact), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Utilidades o Pérdidas Acumuladas:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->utilperacum), 2, ".", ","),0,1,'L');
                     
                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Reserva Legal:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->reslegal), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otras Reservas de Capital:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrasrescap), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode(' Resultado No realizado por tenencia de Activos:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->tenenactivos), 2, ".", ","),0,1,'L');

                       $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('Otros Patrimonios:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->otrpatrim), 2, ".", ","),0,1,'L');

                     $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('TOTAL PATRIMONIO:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totpatri), 2, ".", ","),0,1,'L');

                      $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(-10,5,'',0,0,'L'); 
                    $pdf->Cell(100,5,utf8_decode('OTAL PASIVO Y PATRIMONIO:'),0,0,'L'); 
                     $pdf->SetFont('Arial','',9);
                     $pdf->Cell(30,5, number_format(($c->totpaspatri), 2, ".", ","),0,1,'L');

























 
 
 
 
 
 
 
 
 
 
 
 


                    }  
    
    }
      
     $pdf->Output('Planilla Resumen' , 'D' );
 }
}