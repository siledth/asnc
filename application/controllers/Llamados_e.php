<?php

require_once APPPATH . 'third_party/fpdf/fpdf.php';

// Definición de Colores (AJUSTADO A ROJO)
define('COLOR_PRIMARY', array(200, 0, 0)); // Rojo
define('COLOR_SECONDARY', array(230, 230, 230)); // Gris Claro para fondos
define('COLOR_TEXT_PRIMARY', array(50, 50, 50)); // Negro Suave para texto principal

class Pdf extends FPDF
{
    var $id_programacion;

    function __construct($id_programacion)
    {
        parent::__construct();
        $this->id_programacion = $id_programacion;
    }

    function Header()
    {
        // 1. LOGO Y LÍNEA DE ENCABEZADO
        // Asegúrate de que 'baner6.png' esté en la ruta correcta
        $this->Image(base_url() . 'baner/baner6.png', 10, 8, 190); // Ajustado posición y tamaño para el nuevo banner

        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(COLOR_PRIMARY[0], COLOR_PRIMARY[1], COLOR_PRIMARY[2]); // Título en rojo
        $this->Cell(0, 40, utf8_decode('LLAMADO A CONCURSO'), 0, 1, 'C'); // Ajuste Y para el título

        $this->Ln(1);

        // Línea Separadora (en rojo)
        $this->SetFillColor(COLOR_PRIMARY[0], COLOR_PRIMARY[1], COLOR_PRIMARY[2]);
        $this->Rect(10, 45, 190, 0.5, 'F'); // Ajustada posición Y de la línea

        $this->SetMargins(15, 10, 15); // Margenes actualizados
        $this->Ln(1);
    }

    function Footer()
    {
        // Línea Separadora (en rojo)
        $this->SetY(-18);
        $this->SetFillColor(COLOR_PRIMARY[0], COLOR_PRIMARY[1], COLOR_PRIMARY[2]);
        $this->Rect(10, $this->GetY(), 190, 0.5, 'F');

        // Número de página
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(100, 100, 100); // Gris
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/' . $this->AliasNbPages, 0, 0, 'R');
    }

    // Función auxiliar para un campo de estilo "ficha"
    function FichaCampo($label, $value, $width_label, $width_value, $is_multiline = false)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(COLOR_TEXT_PRIMARY[0], COLOR_TEXT_PRIMARY[1], COLOR_TEXT_PRIMARY[2]);
        $this->Cell($width_label, 6, utf8_decode($label), 0, 0, 'L');

        $this->SetFont('Arial', '', 10);
        $current_x = $this->GetX();
        $current_y = $this->GetY();

        if ($is_multiline) {
            $this->MultiCell($width_value, 6, utf8_decode($value), 0, 'L');
            // Después de MultiCell, el cursor Y se mueve. Necesitamos reposicionar X si el siguiente campo va en la misma línea.
            // Para asegurar, simplemente nos movemos al inicio de la siguiente línea, o se maneja externamente.
            // Para este caso, vamos a forzar un salto de línea si es multilínea.
            $this->SetX(15);
        } else {
            $this->Cell($width_value, 6, utf8_decode($value), 0, 1, 'L'); // Salto de línea después de Cell
        }
    }

    // Función auxiliar para crear títulos de sección estilizados (en rojo)
    function TituloSeccion($titulo)
    {
        $this->Ln(4);
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(255, 255, 255); // Texto Blanco
        $this->SetFillColor(COLOR_PRIMARY[0], COLOR_PRIMARY[1], COLOR_PRIMARY[2]); // Fondo Rojo
        $this->Cell(180, 7, '  ' . utf8_decode($titulo), 0, 1, 'L', true); // Ancho ajustado
        $this->SetTextColor(COLOR_TEXT_PRIMARY[0], COLOR_TEXT_PRIMARY[1], COLOR_TEXT_PRIMARY[2]); // Restaurar color de texto
        $this->Ln(3);
        $this->SetX(15); // Asegurarse de que el cursor X esté en el margen izquierdo
    }
}

class Llamados_e extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Publicaciones_model');
    }

    public function pdfrt()
    {
        $rif_organoente = $this->input->get('rif');
        $numero_proceso = $this->input->get('numero');

        $pdf = new Pdf($numero_proceso);
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'A4', 0);
        $pdf->SetMargins(15, 10, 15);
        $pdf->SetAutoPageBreak(true, 25);

        $data = $this->Publicaciones_model->consulta_llamado2($rif_organoente, $numero_proceso);

        if (empty($data)) {
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, utf8_decode('No se encontraron datos para el llamado a concurso.'), 0, 1, 'C');
            $pdf->Output('llamado_concurso_error.pdf', 'I');
            return;
        }

        foreach ($data as $d) {
            // --- DATOS DEL ÓRGANO O ENTE ---
            $pdf->TituloSeccion('DATOS DEL ÓRGANO O ENTE');

            $pdf->FichaCampo('RIF:', $d->rif_organoente, 40, 50);
            $pdf->FichaCampo('Denominación Social:', $d->organoente, 50, 130, true); // Ancho del valor ajustado

            // Siglas y Página Web en la misma línea
            $pdf->SetX(15); // Reiniciar X
            $pdf->FichaCampo('Siglas:', $d->siglas, 40, 50);
            $pdf->SetY($pdf->GetY() - 6); // Retroceder Y para el siguiente campo
            $pdf->SetX(105); // Posicionar a la mitad
            $pdf->FichaCampo('Página Web:', $d->web_contratante, 40, 65, true); // Puede ser largo, MultiCell

            $pdf->Ln(2);

            // --- LLAMADO A CONCURSO ---
            $pdf->TituloSeccion('DATOS DEL LLAMADO');

            $pdf->FichaCampo('Número de Proceso:', $d->numero_proceso, 55, 125); // Ajuste de ancho
            $pdf->FichaCampo('Denominación del Proceso:', $d->denominacion_proceso, 60, 120, true); // Ancho ajustado

            // Fecha de Llamado y Estatus en la misma línea
            $pdf->SetX(15);
            $pdf->FichaCampo('Fecha de Llamado:', date("d/m/Y", strtotime($d->fecha_llamado)), 55, 40);
            $pdf->SetY($pdf->GetY() - 6);
            $pdf->SetX(105);
            $pdf->FichaCampo('Estatus:', $d->estatus, 40, 50);


            $pdf->FichaCampo('Descripción de Contratación:', $d->descripcion_contratacion, 60, 120, true);

            $pdf->Ln(2);

            // --- LAPSOS ---
            $pdf->TituloSeccion('LAPSOS ');

            // Modalidad y Mecanismo en la misma línea
            $pdf->SetX(15);
            $pdf->FichaCampo('Modalidad:', $d->modalidad, 55, 40);
            $pdf->SetY($pdf->GetY() - 6);
            $pdf->SetX(105);
            $pdf->FichaCampo('Mecanismo:', $d->mecanismo, 40, 65, true); // Puede ser multilínea

            $pdf->FichaCampo('Objeto de Contratación:', $d->objeto_contratacion, 55, 125);
            $pdf->FichaCampo('Acto Publico:', date("d/m/Y", strtotime($d->fecha_fin_llamado)), 55, 125);

            // Fila: Disponibilidad

            // --- LAPSOS ---
            $pdf->TituloSeccion('FECHA DE DISPONIBILIDAD ');
            $pdf->SetX(15);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 6, utf8_decode('Disponibilidad de Pliego:'), 0, 1, 'L');
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetX(20); // Sangría para los detalles
            $pdf->Cell(60, 5, 'Desde: ' . date("d/m/Y", strtotime($d->fecha_disponible_llamado)), 0, 0, 'L');
            $pdf->Cell(60, 5, 'Hasta: ' . date("d/m/Y", strtotime($d->fecha_tope)), 0, 1, 'L');
            $pdf->SetX(20);
            $pdf->Cell(60, 5, 'Hora Desde: ' . $d->hora_desde, 0, 0, 'L');
            $pdf->Cell(60, 5, 'Hora Hasta: ' . $d->hora_hasta, 0, 1, 'L');
            $pdf->SetX(15);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 5, utf8_decode('Dirección para Adquisición/Retiro de Pliego:'), 0, 1, 'L');
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(20); // Sangría
            $pdf->MultiCell(175, 5, utf8_decode($d->direccion), 0, 'L'); // Ancho ajustado

            // Fila: Aclaratorias
            $pdf->Ln(2);
            $pdf->SetX(15);
            $pdf->TituloSeccion('PERÍODO DE ACLARATORIAS');

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 6, utf8_decode('Período de Aclaratorias:'), 0, 1, 'L');
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetX(20); // Sangría
            $pdf->Cell(70, 5, 'Fecha Inicio de Aclaratoria: ' . date("d/m/Y", strtotime($d->fecha_inicio_aclaratoria)), 0, 0, 'L');
            $pdf->Cell(65, 5, 'Fecha Fin de Aclaratoria: ' . date("d/m/Y", strtotime($d->fecha_fin_aclaratoria)), 0, 0, 'L');
            $pdf->Cell(50, 5, 'Fecha Tope: ' . date("d/m/Y", strtotime($d->fecha_tope)), 0, 1, 'L');

            // --- APERTURA DE SOBRES ---
            $pdf->TituloSeccion('APERTURA DE SOBRES');

            $pdf->FichaCampo('Fecha de Entrega de Sobres:', date("d/m/Y", strtotime($d->fecha_fin_llamado)), 60, 40);
            $pdf->SetY($pdf->GetY() - 6);
            $pdf->SetX(105);
            $pdf->FichaCampo('Hora Desde:', $d->hora_desde_sobre, 40, 50);

            // --- DIRECCIONES Y OBSERVACIONES ---
            // $pdf->TituloSeccion(utf8_decode('DIRECCIONES Y OBSERVACIONES'));



            $pdf->Ln(2);
            $pdf->SetX(15);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 5, utf8_decode('Lugar y Dirección de Entrega de Sobres:'), 0, 1, 'L');
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(20); // Sangría
            $pdf->MultiCell(175, 5, utf8_decode($d->lugar_entrega . ' - ' . $d->direccion_sobre), 0, 'L');

            $pdf->Ln(2);
            $pdf->SetX(15);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 5, utf8_decode('Observaciones:'), 0, 1, 'L');
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetX(20); // Sangría
            $pdf->MultiCell(175, 5, utf8_decode($d->observaciones), 0, 'L');

            $pdf->Ln(5);
            $curdate = date('d-m-Y H:i:s');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(0, 5, utf8_decode('Reporte generado el: ') . $curdate, 0, 1, 'L');
        }

        $pdf->Output('llamado_concurso_' . $numero_proceso . '.pdf', 'D');
    }
}
