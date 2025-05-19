<?php

require_once APPPATH . 'third_party/fpdf/fpdf.php';

class Pdf extends FPDF
{
    var $id_programacion;
    // var $comision_contrata_model;

    function __construct($id_programacion)
    {
        parent::__construct();
        $this->id_programacion = $id_programacion;
        // $this->comision_contrata_model = new Comision_contrata_model();
    }



    function Header()
    {
        // Set font
        $this->SetFont('Arial', 'B', 15);
        // Set the cell margins
        $this->SetMargins(30, 30, 15);
        //  $this->Cell(-400, 5, '', 0, 1, 'C');

        $this->Image(base_url() . 'baner/logo4.png', 10, 1, 190, 20); // Ancho 180, Alto 50


        //$this->Image(base_url() . 'Plantilla/img/loij.png', 30, 1, 150);
        $this->Ln(20);
        // Add a new cell with the header text
        $this->Cell(0, 5, utf8_decode('RECIBO INSCRIPCIÓN'), 0, 1, 'C');
        // $this->Cell(0,5,utf8_decode('SISTEMA INTEGRADO SNC'),0,1,'C');

        $this->SetFont('Arial', 'B', 9);
        $this->Ln(1);
    }
    function Footer()
    {
        // Set the cell margins
        $this->SetMargins(30, 15, 30);
        $this->Ln(1);
        $this->SetY(-15);
        // Add footer section
        $this->SetFont('Arial', '', 9);
        $this->Cell(150, 5, utf8_decode('Avenida Lecuna, Parque Central, Torre Oeste, Piso 6., (0212) 508.55.99. Twitter: @snc_info 
Página Web: http://www.snc.gob.ve'), 0, 1, 'C');

        $this->Cell(150, 5, utf8_decode('RIF. G-200024518               Pagina') . $this->PageNo() . '/' . $this->AliasNbPages, 0, 0, 'C');
    }
}

class recibonatural extends CI_Controller
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
        $pdf->AddPage('P', array(215.9, 279.4));

        $pdf->SetFont('Arial', '', 12);


        // $da = $this->session->userdata('rif');


        // $id_programacion = $this->input->get('id');
        $data = $this->Diplomado_model->nombre_diplomado($id_programacion);


        //     $data = $this->User_model->consulta_solictud($id_programacion);
        if ($data != '') {

            foreach ($data as $d) {
                $pdf->SetFont('Arial', 'B', 20);
                $pdf->Ln(5);
                // $pdf->Cell(40, 5,  '', 0, 0, 'R');

                $pdf->Cell(35, 5, utf8_decode('Código planilla:'), 0, 0, 'C');
                $pdf->SetFont('Arial', 'B', 20);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->Cell(70, 5, utf8_decode($d->codigo_planilla), 0, 0, 'C');

                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('Arial', 'B', 10);

                $pdf->Cell(20, 5, utf8_decode('Estatus:'), 0, 0, 'R');
                $pdf->SetTextColor(255, 0, 0);

                $pdf->MultiCell(40, 5, utf8_decode($d->des_estatus), 0, 'L');
                $pdf->SetTextColor(0, 0, 0);

                $pdf->Cell(160, 5, utf8_decode('_______________________________________________________________________________'), 0, 1, 'C');
                $pdf->Ln(1);

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetTextColor(255, 0, 0);

                $pdf->Cell(160, 5, utf8_decode('INFORMACIÓN DEL DIPLOMADO'), 0, 1, 'C');

                $pdf->SetTextColor(0, 0, 0);

                $pdf->Ln(1);

                $pdf->SetFont('Arial', 'B', 12);

                $pdf->Cell(35, 5, utf8_decode('Nombre del diplomado:'), 0, 0, 'R');

                $pdf->MultiCell(125, 5, utf8_decode($d->name_d), 0, 'L');
                $pdf->Cell(35, 5, utf8_decode('Desde:'), 0, 0, 'R');
                $pdf->Cell(20, 5, $d->fdesde, 0, 0, 'C');
                $pdf->Cell(35, 5, utf8_decode('Hasta:'), 0, 0, 'R');
                $pdf->Cell(20, 5, $d->fhasta, 0, 1, 'C');
                $pdf->Cell(35, 5, utf8_decode('Modalidad:'), 0, 0, 'R');

                if ($d->id_modalidad == '1') {
                    $pdf->Cell(70, 5,  utf8_decode('OnLine'), 0, 1, 'L');
                } else {
                    $pdf->Cell(70, 5,  utf8_decode('Bimodal'), 0, 1, 'L');
                }


                $datos_pago = $this->Diplomado_model->obtener_datos_pago($d->id_inscripcion);
                if ($d->estatus == '1') {
                    $pdf->Cell(40, 5, utf8_decode('Costo estimado por persona Bs:'), 0, 0, 'R');
                    $pdf->Cell(20, 5, $d->pay, 0, 1, 'C');

                    // Calcular los valores primero
                    $costo_persona = $d->pay;
                    $iva = $costo_persona * 0.16;
                    $total = $costo_persona + $iva;

                    // Formatear los números con 2 decimales
                    $costo_formateado = number_format($costo_persona, 2, ',', '.');
                    $iva_formateado = number_format($iva, 2, ',', '.');
                    $total_formateado = number_format($total, 2, ',', '.');

                    // Mostrar en el PDF
                    $pdf->Cell(35, 5, utf8_decode('Base imponible Bs:'), 0, 0, 'R');
                    $pdf->Cell(20, 5, $costo_formateado, 0, 1, 'C');

                    $pdf->Cell(35, 5, utf8_decode('IVA (16%) Bs:'), 0, 0, 'R');
                    $pdf->Cell(20, 5, $iva_formateado, 0, 1, 'C');

                    $pdf->Cell(35, 5, utf8_decode('Total + IVA Bs:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', 'B', 12); // Puedes poner en negrita el total
                    $pdf->Cell(20, 5, $total_formateado, 0, 1, 'C');
                    $pdf->SetFont('Arial', '', 12); // Volver a la fuente normal


                } elseif ($d->estatus == '4') {
                    // Mostrar monto cancelado (usando el monto de pagos si existe)
                    $monto_mostrar = ($datos_pago && $datos_pago->monto) ? $datos_pago->monto : $d->monto;

                    $pdf->Cell(35, 5, utf8_decode('Monto Cancelado Bs:'), 0, 0, 'R');
                    $pdf->Cell(20, 5, $monto_mostrar, 0, 1, 'C');

                    // Mostrar detalles del pago si existen
                    if ($datos_pago) {
                        $pdf->Cell(35, 5, utf8_decode('Fecha de Pago:'), 0, 0, 'R');
                        $pdf->Cell(20, 5, $datos_pago->fecha_pago, 0, 1, 'C');

                        $pdf->Cell(35, 5, utf8_decode('Referencia:'), 0, 0, 'R');
                        $pdf->Cell(20, 5, $datos_pago->referencia, 0, 1, 'C');

                        // $pdf->Cell(18, 5, utf8_decode('Banco:'), 0, 0, 'R');
                        // $pdf->Cell(20, 5, $datos_pago->banco, 0, 1, 'C');
                        $pdf->Cell(35, 5, utf8_decode('infomacion:'), 0, 0, 'R');

                        $pdf->MultiCell(125, 5, utf8_decode($datos_pago->observaciones), 0, 'L');
                    }
                }


                $pdf->Cell(160, 5, utf8_decode('_______________________________________________________________________________'), 0, 1, 'C');

                $pdf->SetTextColor(255, 0, 0);
                $pdf->Ln(1);
                $pdf->SetFont('Arial', 'B', 12);

                $pdf->Cell(160, 5, utf8_decode('INFORMACIÓN DEL PARTICIPANTE '), 0, 1, 'C');
                $pdf->Ln(1);

                $pdf->SetTextColor(0, 0, 0);

                $pdf->Cell(40, 5, utf8_decode('Nombre(s), Apellido(s):'), 0, 0, 'R');

                $pdf->SetFont('Arial', '', 12);
                $pdf->MultiCell(125, 5, $d->nombres . ' ' . $d->apellidos, 0, 'L');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(40, 5, utf8_decode('Cédula:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);

                $pdf->Cell(50, 5, utf8_decode($d->cedula), 0, 0, 'L');
                $pdf->SetFont('Arial', 'B', 12);

                $pdf->Cell(20, 5, utf8_decode('Teléfono:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);

                $pdf->Cell(60, 5, utf8_decode($d->tel_p), 0, 1, 'L');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(40, 5, utf8_decode('Correo:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);
                $pdf->MultiCell(125, 5, utf8_decode($d->correo), 0, 'L');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(40, 5, utf8_decode('edad:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);
                $pdf->MultiCell(125, 5, utf8_decode($d->edad), 0, 'L');

                // $pdf->SetFont('Arial', 'B', 12);
                // $pdf->Cell(40, 5, utf8_decode('Grado de instrucción:'), 0, 0, 'R');
                // $pdf->SetFont('Arial', '', 12);
                // $pdf->MultiCell(125, 5, utf8_decode($d->desc_academico), 0, 'L');

                // $pdf->SetFont('Arial', 'B', 12);
                // $pdf->Cell(40, 5, utf8_decode('Titulo Obtenido:'), 0, 0, 'R');
                // $pdf->SetFont('Arial', '', 12);
                // $pdf->MultiCell(125, 5, utf8_decode($d->titulo_obtenido), 0, 'L');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(40, 5, utf8_decode('Dirección:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);
                $pdf->MultiCell(125, 5, utf8_decode($d->direccion), 0, 'L');

                $pdf->Cell(160, 5, utf8_decode('_______________________________________________________________________________'), 0, 1, 'C');

                $pdf->SetTextColor(255, 0, 0);
                $pdf->Ln(1);
                $pdf->SetFont('Arial', 'B', 12);

                $pdf->Cell(160, 5, utf8_decode('RESUMEN CURRICULAR'), 0, 1, 'C');
                $pdf->Ln(1);

                $pdf->SetTextColor(0, 0, 0);


                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(40, 5, utf8_decode('Grado de instrucción:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);
                $pdf->MultiCell(125, 5, utf8_decode($d->desc_academico), 0, 'L');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(40, 5, utf8_decode('Titulo obtenido:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);
                $pdf->MultiCell(125, 5, utf8_decode($d->titulo_obtenido), 0, 'L');
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(80, 5, utf8_decode('Tiene experiencia en contrataciones públicas:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);


                if ($d->t_contrata_p == '1') {
                    $pdf->Cell(70, 5,  utf8_decode('Si'), 0, 1, 'L');
                    $pdf->SetFont('Arial', 'B', 12);

                    $pdf->Cell(80, 5, utf8_decode('Tiempo de experiencia en contrataciones públicas:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->MultiCell(125, 5, utf8_decode($d->experiencia_contrataciones_publicas) . ' ' . utf8_decode('años'), 0, 'L');
                } else {
                    $pdf->Cell(70, 5,  utf8_decode('No'), 0, 1, 'L');
                }


                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(60, 5, '', 0, 0, 'R');

                $pdf->Cell(40, 5, utf8_decode('Tiene formación en materia de contrataciones públicas:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 12);

                if ($d->tiene_capacitacion_contrataciones == '1') {
                    $pdf->Cell(80, 5, utf8_decode('SI'), 0, 1, 'L');

                    // Obtener el modelo correctamente (elimina el $ antes de d)
                    $id_curriculum = $d->id_curriculum;

                    // Obtener las capacitaciones
                    $capacitaciones = $this->Diplomado_model->get_capacitaciones($id_curriculum);

                    $pdf->Ln(3);
                    // Mostrar cada capacitación
                    foreach ($capacitaciones as $cap) {
                        $pdf->SetFont('Arial', 'B', 12);
                        $pdf->Cell(40, 5, utf8_decode('Nombre del curso:'), 0, 0, 'R');
                        $pdf->SetFont('Arial', '', 12);
                        $pdf->MultiCell(125, 5, utf8_decode($cap->nombre_curso), 0, 'L');

                        $pdf->SetFont('Arial', 'B', 12);
                        $pdf->Cell(40, 5, utf8_decode('Institución formadora:'), 0, 0, 'R');
                        $pdf->SetFont('Arial', '', 12);
                        $pdf->MultiCell(125, 5, utf8_decode($cap->institucion_formadora), 0, 'L');

                        $pdf->SetFont('Arial', 'B', 12);
                        $pdf->Cell(40, 5, utf8_decode('Año realizado:'), 0, 0, 'R');
                        $pdf->SetFont('Arial', '', 12);
                        $pdf->MultiCell(125, 5, utf8_decode($cap->anio_realizacion), 0, 'L');

                        // Espacio entre capacitaciones
                        $pdf->Ln(3);
                    }
                } else {
                    $pdf->Cell(80, 5,  utf8_decode('NO'), 0, 1, 'L');
                }
                $pdf->Cell(160, 5, utf8_decode('_______________________________________________________________________________'), 0, 1, 'C');

                $pdf->SetTextColor(255, 0, 0);
                $pdf->Ln(1);
                $pdf->SetFont('Arial', 'B', 12);


                $pdf->Cell(160, 5, utf8_decode('INFORMACIÓN DE LA EMPRESA '), 0, 1, 'C');
                $pdf->SetTextColor(0, 0, 0);

                $pdf->Ln(1);
                if ($d->trabaja_actualmente == '0') {
                    $pdf->Cell(80, 5,  utf8_decode('No Trabaja'), 0, 1, 'L');
                } else {
                    $pdf->SetTextColor(255, 0, 0);




                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->Cell(40, 5, utf8_decode('Nombre de la Empresa:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->MultiCell(125, 5, utf8_decode($d->razon_social), 0, 'L');
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->Cell(40, 5, utf8_decode('Rif de la Empresa:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->MultiCell(125, 5, utf8_decode($d->rif), 0, 'L');
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->Cell(40, 5, utf8_decode('Teléfono:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->MultiCell(125, 5, utf8_decode($d->telefono), 0, 'L');
                }
                // $pdf->Cell(160, 5, utf8_decode('_______________________________________________________________________________'), 0, 1, 'C');

                // $pdf->Ln(5);

                // $pdf->SetTextColor(255, 0, 0);

                // $pdf->Cell(160, 5, utf8_decode('INFORMACIÓN '), 0, 1, 'C');

                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(160, 5, utf8_decode('_______________________________________________________________________________'), 0, 1, 'C');
            }
        }
        // } else {
        //     $data = $this->User_model->consulta_solictud3($id_programacion);
        //     if ($data != '') {
        //         //////////////////no existe en el snc
        //         foreach ($data as $d2) {


        //             $pdf->SetFont('Arial', 'B', 9);

        //             $pdf->Cell(40, 5, utf8_decode('Órgano / Ente / Adscrito:'), 0, 0, 'R');

        //             $pdf->SetFont('Arial', '', 9);
        //             $pdf->MultiCell(125, 5, utf8_decode($d2->descripcion), 0, 'L');
        //         }
        //     }
        // }
        $pdf->Ln(1);




        //    $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(160, 5, utf8_decode('DECLARACIÓN JURADA:'), 0, 1, 'C');

        // $pdf->Cell(25, 5, utf8_decode('DECLARACIÓN JURADA:'), 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(-10, 5, '', 0, 0, 'L');
        $pdf->MultiCell(180, 4, utf8_decode('Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la Preinscripción'), 0, 'J');

        // $pdf->SetFont('Arial', '', 7);
        // $pdf->MultiCell(180, 4, utf8_decode('observaciones                '), 0, 'J');

        $pdf->Output('Solicitud Inscripcion.pdf', 'D');
    }
}
