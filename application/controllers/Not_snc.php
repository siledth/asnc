<?php

require_once APPPATH . 'third_party/fpdf/fpdf.php';

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
        $this->SetFont('Arial', 'B', 15);
        // Set the cell margins
        $this->SetMargins(15, 15, 15);
        $this->Image(base_url() . 'baner/logo3.png', 30, 1, 150);
        $this->Ln(5);
        // Add a new cell with the header text
        $this->Cell(0, 5, utf8_decode('CERTIFICADO DE CUMPLIMIENTO DE'), 0, 1, 'C');
        $this->Cell(195, 5, utf8_decode('NOTIFICACIÓN DE LAS DESIGNACIONES DE LOS MIEMBROS DE '), 0, 1, 'C');
        $this->Cell(195, 5, utf8_decode('COMISIÓN DE CONTRATACIONES '), 0, 1, 'C');
        $this->Cell(50, 3, '', 0, 'L');

        $dat5 = $this->comision_contrata_model->comprobante($this->id_programacion);
        if ($dat5 != '') {
            foreach ($dat5 as $dt5) {
                $this->Cell(90, 5, utf8_decode($dt5->comprobante), 0, 1, 'C');
            }
        }

        // Add a line break
        $this->Ln(5);
        $this->SetFont('Arial', 'I', 11);
        $this->Cell(60, 5, utf8_decode('El Servicio Nacional de Contrataciones (SNC), hace de su conocimiento que ha recibido la notificación'), 0, 1, 'L');
        $this->Cell(60, 5, utf8_decode('de las Designaciones de los Miembros de Comisión, de conformidad a lo establecido en el Artículo 14'), 0, 1, 'L');
        $this->Cell(60, 5, utf8_decode('del Decreto con Rango Valor y Fuerza de Ley de Contrataciones Públicas(DCRVFLCP)'), 0, 1, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Ln(5);
        $this->Cell(105, 3, '', 0, 'L');
        $this->MultiCell(200, 1, utf8_decode('   "Integración de las Comisiones de Contrataciones'), 0, 'L');
        $this->Cell(5, 1, '', 0, 'L');

        $this->MultiCell(180, 5, utf8_decode('    
        Artículo 14. En los sujetos del presente Decreto con Rango, Valor y Fuerza de Ley, debe constituirse una o varias Comisiones de Contrataciones, que podrán ser permanentes o temporales, atendiendo a la especialidad, cantidad y complejidad de las obras a ejecutar, la adquisición de bienes y la prestación de servicios.
        '), 0, 'J');

        $this->Cell(5, 1, '', 0, 'L');
        $this->SetFont('Arial', 'I', 9);

        $this->MultiCell(180, 4, utf8_decode('Estarán integradas por un número impar de miembros principales con sus suplentes, de calificada competencia profesional y reconocida honestidad, designados por la máxima autoridad del contratante preferentemente entre sus empleados o funcionarios, quienes serán solidariamente responsables con la máxima autoridad,por las recomendaciones que se presenten sean aprobadas'), 0, 'J');
        $this->Ln(1);
        $this->Cell(5, 3, '', 0, 'L');


        $this->SetFont('Arial', 'B', 9);
        $this->MultiCell(180, 5, utf8_decode('Las designaciones de los miembros de las comisiones de contrataciones, se realizarán a título personal y deberán ser notificadas al Servicio Nacional de Contrataciones dentro de los cinco días siguientes, una vez dictado el acto.'), 0, 'J');
        $this->Cell(70, 3, '', 0, 'L');

        $this->Cell(180, 3, utf8_decode('(Negrillas nuestras)'), 0, 1, 'L');
        $this->SetFont('Arial', 'I', 9);
        $this->Ln(2);
        $this->Cell(80, 5, '', 0, 'L');

        $this->Cell(180, 5, utf8_decode('Omissis ... "'), 0, 1, 'L');
        $this->Ln(1);
    }
    function Footer()
    {
        $this->SetMargins(30, 15, 30);
        $this->Ln(1);
        $this->SetY(-15);
        $this->SetFont('Arial', '', 6);
        $page = $this->PageNo();
        $this->Cell(220, 10, utf8_decode('RIF. G-200024518               Pagina') . $this->PageNo() . '/' . $this->AliasNbPages, 0, 0, 'C');
        $this->SetY(-35);
        // Add image
        $this->Image(base_url() . 'baner/fp.png', 80, $this->GetY(), 50);
        // $data11 = $this->comision_contrata_model->con_qr($this->id_programacion);
        // if($data11 != ''){
        //  foreach($data11 as $d11){    
        // $this->Cell(55,3,'',0,'L');
        // $imagePath = $d11->qrcode_path;     
        //    $this->Image(base_url().'assets/img/qrcodemiembros/'.$imagePath, 15, 235, 30);    
        //   } 
        // }
    }
}

class Not_snc extends CI_Controller
{

    public function __construct()
    {
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
        $pdf->AddPage('P', 'A4', 0);
        $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 9);


        $pdf->Cell(195, 5, utf8_decode('INFORMACIÓN DE LA COMISIÓN DE CONTRATACIONES'), 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 8);

        // c   $pdf->Cell(350,4,'Pagina '.$pdf->PageNo().'/{nb}',0,1,'C');
        $pdf->SetFont('Arial', '', 9);


        $da = $this->session->userdata('rif');

        $pdf->Ln(3);




        $pdf->Cell(50, 3, utf8_decode('Órgano / Ente / Adscrito:'), 0, 0, 'R');

        $id_programacion = $this->input->get('id');

        $data = $this->Comision_contrata_model->consulta_total_objeto_acc($id_programacion);
        if ($data != '') {
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 9);
                $pdf->MultiCell(100, 3, utf8_decode($d->descripcion), 0, 'L');

                // $pdf->Cell(60,6, utf8_decode($d->descripcion),0,0,'L');
                //  $pdf->Cell(40,6, number_format($d->precio_total, 2, ",", "."),0,0,'R');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(50, 6, utf8_decode('RIF:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(20, 6, $d->rif_organoente, 0, 1, 'C');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(50, 6, utf8_decode('Tipo de Comisión:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(60, 6, utf8_decode($d->tipo_comision), 0, 0, 'L');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(50, 6, utf8_decode('Fecha de Notificación al SNC:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(0, 6, date("d/m/Y", strtotime($d->fecha_notifiacion)), 0, 1, 'C');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(43, 6, utf8_decode('Acto Administrativo de Designación:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(25, 6, utf8_decode($d->desc_acto_admin), 0, 0, 'L');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(25, 6, utf8_decode('Fecha del acto:'), 0, 0, 'L');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(17, 6, date("d/m/Y", strtotime($d->fecha_acto)), 0, 0, 'L');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(18, 6, utf8_decode('Nº del acto:'), 0, 0, 'L');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(1, 6, utf8_decode($d->num_acto), 0, 1, 'L');
                if ($d->tipo_comi == 2) {
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Ln(3);

                    $pdf->Cell(195, 3, utf8_decode('Información solo si la Comisión es Temporal'), 0, 1, 'C');
                    $pdf->Cell(50, 3, utf8_decode('Objeto de la Comisión:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->MultiCell(100, 3, utf8_decode($d->observacion), 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(50, 3, utf8_decode('Desde(fecha estimada):'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(25, 3, date("d/m/Y", strtotime($d->dura_com_desde)), 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(40, 3, utf8_decode('Hasta(fecha estimada):'), 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(1, 3, date("d/m/Y", strtotime($d->dura_com_hasta)), 0, 1, 'L');
                }
            }
        }
        //    $pdf->SetFont('Arial','B',9);
        //    $pdf->Ln(3);
        //    $pdf->Cell(25,3,'',0,0,'L');
        //    $pdf->Cell(15,3,'Cedula',0,0,'L'); 
        //    $pdf->Cell(55,3, utf8_decode('Nombres y Apellidos'),0,0,'C'); 
        //    $pdf->Cell(40,3, utf8_decode('Área '),0,0,'C');      
        //    $pdf->Cell(30,3,'Tipo de Miembro',0,1,'R'); 





        $pdf->SetFont('Arial', 'B', 9);


        $data = $this->Comision_contrata_model->comin($id_programacion);
        if ($data != '') {
            foreach ($data as $d) {
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Ln(3);
                $pdf->Cell(30, 3, '', 0, 0, 'L');
                $pdf->Cell(25, 3, 'Cedula', 0, 0, 'L');
                $pdf->Cell(55, 3, utf8_decode('Nombres y Apellidos'), 0, 0, 'C');
                $pdf->Cell(40, 3, utf8_decode('Área '), 0, 0, 'C');
                $pdf->Cell(30, 3, 'Tipo de Miembro', 0, 1, 'R');
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(30, 3, '', 0, 0, 'L');

                $pdf->Cell(25, 5, $d->cedula, 0, 0, 'L');
                $pdf->Cell(70, 5, utf8_decode($d->nombre_completo), 0, 0, 'L');

                $pdf->Cell(33, 5, utf8_decode($d->desc_area_miembro), 0, 0, 'L');
                $pdf->Cell(20, 7, utf8_decode($d->desc_tp_miembro), 0, 1, 'L');
            } //
        }

        $pdf->Output('notificacion.pdf', 'D');
    }
}
