<?php
// Asegúrate de que FPDF está incluido. Si usas Composer, sería algo así:
// require_once FCPATH . 'vendor/setasign/fpdf/fpdf.php';
// Si lo tienes manualmente en fpdf186/, asegúrate de que el path sea correcto.
// Asumo que ya tienes una forma de incluir FPDF en tu proyecto.
// Ejemplo: require_once APPPATH . 'libraries/fpdf186/fpdf.php'; (si lo pones en libraries)
// O si lo tienes en fpdf186/ en la raíz del proyecto
require_once FCPATH . 'fpdf186/fpdf.php';

class PDF extends FPDF
{
    // Cabecera de página personalizada (opcional, si quieres un header específico)
    function Header()
    {
        // Puedes agregar un logo o texto en el encabezado de cada página del PDF
        // $this->Image('path/to/your/logo.png',10,8,33);
        // $this->SetFont('Arial','B',15);
        // $this->Cell(80);
        // $this->Cell(30,10,'Titulo del Documento',1,0,'C');
        // $this->Ln(20);
    }

    // Pie de página personalizada (opcional)
    function Footer()
    {
        // $this->SetY(-15);
        // $this->SetFont('Arial','I',8);
        // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Crear una instancia de PDF
$pdf = new PDF();
$pdf->AliasNbPages(); // Para el número de páginas {nb}
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12); // Fuente base

// --- TÍTULO PRINCIPAL ---
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, mb_strtoupper('Registro Único de Personas Naturales y Jurídicas de Carácter Privado'), 0, 1, 'C'); // mb_strtoupper para tildes
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Esta Dirección de Capacitación de Contrataciones Públicas, certifica que el Contratista detallado a continuación de conformidad a los criterios técnicos emitidos por el Servicio Nacional de Contrataciones (SNC), se encuentra acreditado para impartir los programas, cursos y talleres en materia de Comisión de Contrataciones Públicas:', 0, 1, 'J');
$pdf->Ln(5);

// --- INFORMACIÓN DE LA PERSONA JURÍDICA ---
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, mb_strtoupper('Información de la Persona Jurídica'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);

// Asegúrate de que $inf_certificacion contiene los datos que esperas
// Utiliza ?? '' para evitar errores si la clave no existe
$razon_social = $inf_certificacion['razon_social'] ?? 'N/A'; // Ajusta la clave a tu DB
$rif_pj = $inf_certificacion['rif_pj'] ?? 'N/A'; // Ajusta la clave a tu DB
$nro_certificado_rnc = $inf_certificacion['nro_certificado_rnc'] ?? 'N/A'; // Ajusta la clave a tu DB
$nro_comprobante_registro = $inf_certificacion['nro_comprobante_registro'] ?? 'N/A'; // Ajusta la clave a tu DB
$vigencia_desde = $inf_certificacion['vigencia_desde'] ?? 'N/A'; // Ajusta la clave a tu DB
$vigencia_hasta = $inf_certificacion['vigencia_hasta'] ?? 'N/A'; // Ajusta la clave a tu DB


$pdf->Cell(0, 6, 'Razón Social: ' . $razon_social, 0, 1, 'L');
$pdf->Cell(0, 6, 'Número de Identificación Fiscal RIF: ' . $rif_pj, 0, 1, 'L');
$pdf->Cell(0, 6, 'N° de Certificado Registro Nacional de Contratista RNC: ' . $nro_certificado_rnc, 0, 1, 'L');
$pdf->Cell(0, 6, 'N° de Comprobante Registro: ' . $nro_comprobante_registro, 0, 1, 'L');
$pdf->Cell(0, 6, 'Vigencia de la Certificación: Desde ' . $vigencia_desde . ' / Hasta ' . $vigencia_hasta, 0, 1, 'L');
$pdf->Ln(5);

// --- INFORMACIÓN DEL FACILITADOR(A) ---
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, mb_strtoupper('Información del Facilitador(a)'), 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 6, mb_strtoupper('Nombre y Apellido'), 1, 0, 'C');
$pdf->Cell(50, 6, mb_strtoupper('Cédula'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);

// Iterar sobre los facilitadores
if (!empty($facilitadores)) {
    foreach ($facilitadores as $facilitador) {
        $nombre_facilitador = $facilitador['nombre_ape'] ?? 'N/A'; // Asumo 'nombre_ape' para el facilitador
        $cedula_facilitador = $facilitador['cedula'] ?? 'N/A'; // Asumo 'cedula' para el facilitador
        $pdf->Cell(90, 6, utf8_decode($nombre_facilitador), 1, 0, 'L'); // utf8_decode para caracteres especiales en FPDF
        $pdf->Cell(50, 6, utf8_decode($cedula_facilitador), 1, 1, 'L');
    }
} else {
    $pdf->Cell(140, 6, 'No se encontraron facilitadores.', 1, 1, 'C');
}
$pdf->Ln(10);

// --- PIE DE REPORTE ---
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'final del reporte', 0, 1, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 6, 'Anthoni Camilo Torres', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, 'Director General', 0, 1, 'L');
$pdf->MultiCell(0, 5, utf8_decode('"Resolución CCP/DGCJ N° 001/2014 de fecha 07 de enero de 2014, Publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nº 40.334 de fecha 15 de enero de 2014."'), 0, 'J');
$pdf->Cell(0, 6, 'Fecha de Consulta ' . date('d-m-Y', strtotime($time)), 0, 1, 'L'); // Usar $time del controlador

// Salida del PDF
$pdf->Output('Ficha_Tecnica_Certificacion_' . ($all_report_data['certificacion_info']['rif_cont'] ?? 'documento') . '.pdf', 'D'); // <--- ¡CAMBIADO A 'D'!