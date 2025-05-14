<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generar_pdf_inscripcion')) {
    function generar_pdf_inscripcion($datos)
    {
        require_once APPPATH . 'third_party/fpdf/fpdf.php';

        class PDF_Inscripcion extends FPDF
        {
            function Header()
            {
                $this->SetFont('Arial', 'B', 15);
                $this->SetMargins(15, 15, 15);
                $this->Image(base_url() . 'Plantilla/img/loij.png', 30, 10, 150);
                $this->Ln(20);
                $this->Cell(0, 10, 'COMPROBANTE DE INSCRIPCION AL DIPLOMADO', 0, 1, 'C');
                $this->SetFont('Arial', '', 10);
                $this->Ln(5);
            }

            function Footer()
            {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
            }

            function agregarDato($titulo, $valor, $salto = 1)
            {
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(50, 6, $titulo, 0, 0);
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 6, $valor, 0, $salto);
                $this->Ln(2);
            }
        }

        $pdf = new PDF_Inscripcion();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        // Información del participante
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'DATOS DEL PARTICIPANTE', 0, 1);
        $pdf->Ln(2);

        $pdf->agregarDato('Codigo de Inscripcion:', $datos['codigo']);
        $pdf->agregarDato('Nombre Completo:', $datos['participante']['nombres'] . ' ' . $datos['participante']['apellidos']);
        $pdf->agregarDato('Cedula de Identidad:', $datos['participante']['cedula']);
        $pdf->agregarDato('Telefono:', $datos['participante']['telefono']);
        $pdf->agregarDato('Correo Electronico:', $datos['participante']['correo']);
        $pdf->agregarDato('Edad:', $datos['participante']['edad']);
        $pdf->agregarDato('Direccion:', $datos['participante']['direccion']);

        // Información del diplomado
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'INFORMACION DEL DIPLOMADO', 0, 1);
        $pdf->Ln(2);

        $pdf->agregarDato('Nombre del Diplomado:', $datos['diplomado']['nombre']);
        $pdf->agregarDato('Fecha de Inicio:', $datos['diplomado']['fecha_inicio']);

        // Información de la empresa si aplica
        if (isset($datos['empresa']) && $datos['empresa']) {
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'DATOS LABORALES', 0, 1);
            $pdf->Ln(2);

            $pdf->agregarDato('Empresa/Institucion:', $datos['empresa']['razon_social']);
            $pdf->agregarDato('RIF:', $datos['empresa']['rif']);
            $pdf->agregarDato('Telefono:', $datos['empresa']['telefono']);
            $pdf->agregarDato('Direccion Fiscal:', $datos['empresa']['direccion_fiscal']);
        }

        // Pie de página con información adicional
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->MultiCell(0, 5, utf8_decode('Este documento es el comprobante de su inscripción al diplomado. Por favor presentarlo el día del inicio de actividades.'));

        return $pdf->Output('S', 'comprobante_inscripcion.pdf');
    }
}
