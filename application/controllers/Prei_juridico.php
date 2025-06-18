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
        $this->Cell(0, 5, utf8_decode('PLANILLA  DE SOLICITUD DE INSCRIPCIÓN'), 0, 1, 'C');
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
        $this->MultiCell(150, 5, utf8_decode('Edificio Nova, Final del Bulevar de Sabana Grande, al lado del Metro de Chacaíto. Punto de Referencia: Frente al C.C. Chacaíto. Caracas,Venezuela, (0212) 508.55.99. Twitter: @snc_info Página Web: http://www.snc.gob.ve'), 0,  'C');


        $this->Cell(150, 5, utf8_decode('RIF. G-200024518               Pagina') . $this->PageNo() . '/' . $this->AliasNbPages, 0, 0, 'C');
    }
}

class Prei_juridico extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function pdfrt()
    {

        $codigo_planilla = $this->input->get('id');
        $pdf = new Pdf($codigo_planilla);
        $pdf->AliasNbPages();
        $pdf->AddPage('P', array(215.9, 279.4));
        $pdf->SetFont('Arial', '', 12);

        // 1. OBTENER DATOS (usando las nuevas funciones del modelo)
        $info_general = $this->Diplomado_model->get_info_inscripcion_grupal($codigo_planilla);

        if (!$info_general) {
            $pdf->Cell(0, 10, 'No se encontró la inscripcion solicitada', 0, 1);
            $pdf->Output('Solicitud Inscripcion.pdf', 'D');
            return;
        }

        $participantes = $this->Diplomado_model->get_participantes_inscripcion($info_general->id_inscripcion_grupal);

        // 2. MOSTRAR ENCABEZADO Y DATOS GENERALES (UNA SOLA VEZ)
        $this->mostrarEncabezado($pdf, $info_general);
        $this->mostrarInfoDiplomado($pdf, $info_general);
        $this->mostrarInfoEmpresa($pdf, $info_general);

        // 3. MOSTRAR PARTICIPANTES (TODOS LOS REGISTROS)
        foreach ($participantes as $index => $participante) {
            // if ($index > 0) { // Salto de página para cada participante adicional
            //     $pdf->AddPage();
            // }
            $this->mostrarInfoParticipante($pdf, $participante);
        }

        // 4. MOSTRAR DECLARACIÓN JURADA (AL FINAL)
        $this->mostrarDeclaracionJurada($pdf);

        $pdf->Output('Solicitud Inscripcion.pdf', 'D');
    }

    // ============ FUNCIONES AUXILIARES ============ //

    private function mostrarEncabezado($pdf, $data)
    {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Ln(5);
        $pdf->Cell(10, 5, utf8_decode('Código planilla:'), 0, 0, 'C');
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(70, 5, $data->codigo_planilla, 0, 0, 'C');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(20, 5, 'Estatus:', 0, 0, 'R');
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(40, 5, $data->des_estatus, 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(160, 5, '_________________________________________________________________________________', 0, 1, 'C');
        $pdf->Ln(1);
    }


    private function mostrarInfoDiplomado($pdf, $data)
    {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(160, 5, utf8_decode('INFORMACIÓN DEL DIPLOMADO'), 0, 1, 'C');

        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(1);

        $pdf->Cell(35, 5, 'Nombre del diplomado:', 0, 0, 'R');
        $pdf->MultiCell(125, 5, utf8_decode($data->name_d), 0, 'L');


        $pdf->Cell(35, 5, 'Desde:', 0, 0, 'R');
        $pdf->Cell(20, 5, $data->fdesde, 0, 0, 'C');
        $pdf->Cell(35, 5, 'Hasta:', 0, 0, 'R');
        $pdf->Cell(20, 5, $data->fhasta, 0, 1, 'C');

        $pdf->Cell(35, 5, 'Modalidad:', 0, 0, 'R');
        $modalidad = ($data->id_modalidad == '1') ? 'OnLine' : 'Bimodal';
        $pdf->Cell(70, 5, $modalidad, 0, 0, 'L');

        $pdf->Cell(18, 5, 'Costo por persona Bs:', 0, 0, 'R');
        $pdf->Cell(20, 5, number_format($data->pay, 2, ',', '.'), 0, 1, 'C');
        if ($data->id_pago == '2') { // 2 es credito  / 1 es prontopago
            // Calcular montos

            $pdf->Cell(58, 5, 'Forma de pago :', 0, 0, 'R');
            $pdf->Cell(20, 5, 'Credito', 0, 1, 'C');

            $subtotal = $data->pay * $data->participantes_aceptados;
            $iva_percent = ($data->ente_gubernamental == 1) ? 8 : 16; // 8% o 16%
            $iva = $subtotal * ($iva_percent / 100);
            $total = $subtotal + $iva;

            // Mostrar en el PDF
            $pdf->Cell(58, 5, 'Costo por persona Bs:', 0, 0, 'R');
            $pdf->Cell(20, 5, number_format($data->pay, 2, ',', '.'), 0, 1, 'C');

            $pdf->Cell(58, 5, 'Participantes aceptados:', 0, 0, 'R');
            $pdf->Cell(20, 5, $data->participantes_aceptados, 0, 1, 'C');

            $pdf->Cell(58, 5, 'Subtotal estimado Bs:', 0, 0, 'R');
            $pdf->Cell(20, 5, number_format($subtotal, 2, ',', '.'), 0, 1, 'C');

            $pdf->Cell(58, 5, 'IVA estimado (' . $iva_percent . '%) Bs:', 0, 0, 'R');
            $pdf->Cell(20, 5, number_format($iva, 2, ',', '.'), 0, 1, 'C');

            $pdf->Cell(58, 5, 'Total a pagar  estimado Bs:', 0, 0, 'R');
            $pdf->Cell(20, 5, number_format($total, 2, ',', '.'), 0, 1, 'C');
        } elseif ($data->id_pago == '1') { //ponto pago
            // Calcular montos
            $pdf->Cell(58, 5, 'Forma de pago :', 0, 0, 'R');
            $pdf->Cell(20, 5, 'Pronto Pago', 0, 1, 'C');

            $subtotal = $data->pronto_pago * $data->participantes_aceptados;
            $iva_percent = ($data->ente_gubernamental == 1) ? 8 : 16; // 8% o 16%
            $iva = $subtotal * ($iva_percent / 100);
            $total = $subtotal + $iva;

            // Mostrar en el PDF
            $pdf->Cell(58, 5, 'Costo por persona Bs:', 0, 0, 'R');
            $pdf->Cell(20, 5, number_format($data->pronto_pago, 2, ',', '.'), 0, 1, 'C');

            $pdf->Cell(58, 5, 'Participantes aceptados:', 0, 0, 'R');
            $pdf->Cell(20, 5, $data->participantes_aceptados, 0, 1, 'C');

            $pdf->Cell(58, 5, 'Subtotal estimado Bs:', 0, 0, 'R');
            $pdf->Cell(20, 5, number_format($subtotal, 2, ',', '.'), 0, 1, 'C');

            $pdf->Cell(58, 5, 'IVA estimado (' . $iva_percent . '%) Bs:', 0, 0, 'R');
            $pdf->Cell(20, 5, number_format($iva, 2, ',', '.'), 0, 1, 'C');

            $pdf->Cell(58, 5, 'Total a pagar  estimado Bs:', 0, 0, 'R');
            $pdf->Cell(20, 5, number_format($total, 2, ',', '.'), 0, 1, 'C');
        }
        $pdf->Cell(160, 5, '_________________________________________________________________________________', 0, 1, 'C');
    }

    private function mostrarInfoEmpresa($pdf, $data)
    {
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Ln(1);
        $pdf->Cell(160, 5, utf8_decode('INFORMACIÓN DE LA EMPRESA'), 0, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(1);

        $pdf->Cell(40, 5, 'Nombre de la Empresa:', 0, 0, 'R');
        $pdf->MultiCell(125, 5, $data->razon_social, 0, 'L');

        $pdf->Cell(40, 5, 'Rif de la Empresa:', 0, 0, 'R');
        $pdf->MultiCell(125, 5, $data->rif, 0, 'L');

        $pdf->Cell(40, 5, utf8_decode('Teléfono:'), 0, 0, 'R');
        $pdf->MultiCell(125, 5, $data->telefono, 0, 'L');
        $pdf->Cell(160, 5, '_________________________________________________________________________________', 0, 1, 'C');

        $pdf->SetTextColor(255, 0, 0);
        $pdf->Ln(1);
        $pdf->Cell(160, 5, utf8_decode('INFORMACIÓN DE PARTICIPANTES'), 0, 1, 'C');
        $pdf->Ln(1);
        $pdf->SetTextColor(0, 0, 0);
    }

    private function mostrarInfoParticipante($pdf, $participante)
    {

        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(40, 5, 'Nombre(s), Apellido(s):', 0, 0, 'R');
        $pdf->SetFont('Arial', '', 12);

        $pdf->MultiCell(125, 5, $participante->nombres . ' ' . $participante->apellidos, 0, 'L');
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(40, 5, utf8_decode('Cédula:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(50, 5, $participante->cedula, 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(30, 5, utf8_decode('Teléfono:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(60, 5, $participante->tel_p, 0, 1, 'L');

        // ========= INFORMACIÓN CURRICULAR ========= //
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 5, utf8_decode('Grado de instrucción:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(125, 5, utf8_decode($participante->desc_academico), 0, 'L');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 5, utf8_decode('Título obtenido:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(125, 5, utf8_decode($participante->titulo_obtenido), 0, 'L');

        $pdf->SetFont('Arial', 'B', 12);
        // $pdf->Cell(80, 5, utf8_decode('Experiencia en contrataciones públicas:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 12);
        // $pdf->Cell(70, 5, ($participante->t_contrata_p == '1') ? 'Si' : 'No', 0, 1, 'L');

        if ($participante->t_contrata_p == '1') {
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(80, 5, utf8_decode('Tiempo de experiencia (años):'), 0, 0, 'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->MultiCell(125, 5, $participante->experiencia_contrataciones_publicas, 0, 'L');
        }
        // ========= CAPACITACIONES ========= //
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(80, 5, utf8_decode('Capacitación en contrataciones públicas:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(70, 5, ($participante->tiene_capacitacion_contrataciones == '1') ? 'Si' : 'No', 0, 1, 'L');

        if ($participante->tiene_capacitacion_contrataciones == '1') {
            // Obtener capacitaciones del participante
            $capacitaciones = $this->Diplomado_model->get_capacitaciones($participante->id_curriculum);

            if (!empty($capacitaciones)) {
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 5, utf8_decode('Detalle de capacitaciones:'), 0, 1, 'L');
                $pdf->SetFont('Arial', '', 12);

                foreach ($capacitaciones as $index => $cap) {
                    $pdf->Cell(10, 5, ($index + 1) . ')', 0, 0, 'R');
                    $pdf->MultiCell(
                        0,
                        5,
                        utf8_decode($cap->nombre_curso) . ' - ' .
                            utf8_decode($cap->institucion_formadora) . ' (' .
                            $cap->anio_realizacion . ')',
                        0,
                        'L'
                    );

                    $pdf->Ln(2); // Espacio entre capacitaciones
                }
            }
        }
        $pdf->Cell(160, 5, '_________________________________________________________________________________', 0, 1, 'C');
    }


    private function mostrarDeclaracionJurada($pdf)
    {
        $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(25, 5, utf8_decode('Declaración Jurada:'), 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(-10, 5, '', 0, 0, 'L');
        $pdf->MultiCell(180, 4, utf8_decode('Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la Preinscripción'), 0, 'J');
    }
}
