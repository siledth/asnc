<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
{ // Nombre del nuevo controlador

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pago_model');       // Necesitas el modelo de pagos
        $this->load->library('conciliar_pj');  // Carga tu librería FPDF renombrada
        // Si necesitas otros modelos para obtener datos adicionales en tus reportes, cárgalos aquí
        // $this->load->model('Diplomado_model');
    }

    /**
     * Genera y descarga un recibo de pago conciliado en formato PDF.
     * @param int $pago_id El ID del pago conciliado a reportar.
     */
    public function generar_recibo_conciliado($pago_id)
    {
        // 1. Obtener los datos del pago usando el ID
        $pago_data = $this->Pago_model->get_pago_by_id($pago_id);

        if (!$pago_data) {
            show_error('El pago conciliado no fue encontrado.', 404);
            return;
        }

        // 2. Crear una instancia de FPDF con tu clase personalizada
        $pdf = new Conciliar_pj('P', 'mm', 'A4'); // Usamos el nombre de tu clase
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetMargins(20, 15, 20); // Márgenes generales para el cuerpo del documento

        // 3. Contenido del Recibo - Adaptado a los datos de conciliación

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 128, 0); // Verde para el estatus
        $pdf->Cell(0, 10, 'ESTATUS: CONCILIADO', 0, 1, 'C');
        $pdf->SetTextColor(0, 0, 0); // Restaurar color

        $pdf->Ln(10); // Salto de línea

        // Sección de Detalles del Pago
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(230, 230, 230); // Fondo gris claro para los títulos de sección
        $pdf->Cell(0, 8, utf8_decode('Información del Pago Conciliado'), 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(60, 7, utf8_decode('Código de Planilla:'), 'LR', 0);
        $pdf->Cell(0, 7, utf8_decode($pago_data->codigo_planilla), 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('ID Transacción Interna:'), 'LR', 0);
        $pdf->Cell(0, 7, $pago_data->id, 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('Tipo de Pago:'), 'LR', 0);
        $tipo_pago_texto = '';
        if ($pago_data->tipo_pago == '1') {
            $tipo_pago_texto = 'Pronto Pago';
        } elseif ($pago_data->tipo_pago == '2') {
            $tipo_pago_texto = 'Crédito';
        } else {
            $tipo_pago_texto = 'Desconocido';
        }
        $pdf->Cell(0, 7, utf8_decode($tipo_pago_texto), 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('Monto Bruto (Total Pago):'), 'LR', 0);
        $pdf->Cell(0, 7, 'Bs. ' . number_format($pago_data->total_pago, 2, ',', '.'), 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('IVA Aplicado:'), 'LR', 0);
        $pdf->Cell(0, 7, 'Bs. ' . number_format($pago_data->iva, 2, ',', '.'), 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('Total con IVA:'), 'LR', 0);
        $pdf->Cell(0, 7, 'Bs. ' . number_format($pago_data->total_iva, 2, ',', '.'), 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('Monto Final Conciliado:'), 'LR', 0);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 7, 'Bs. ' . number_format($pago_data->monto, 2, ',', '.'), 'R', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(60, 7, utf8_decode('Banco de Origen:'), 'LR', 0);
        $banco_nombre = $pago_data->bancoOrigen;
        $pdf->Cell(0, 7, utf8_decode($banco_nombre), 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('Número de Referencia:'), 'LR', 0);
        $pdf->Cell(0, 7, utf8_decode($pago_data->referencia), 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('Fecha del Pago:'), 'LR', 0);
        $pdf->Cell(0, 7, date('d/m/Y', strtotime($pago_data->fechaPago)), 'R', 1);

        $pdf->Cell(60, 7, utf8_decode('Número de Factura SIGES:'), 'LRB', 0);
        $pdf->Cell(0, 7, utf8_decode($pago_data->nfsiges), 'RB', 1);

        $pdf->Ln(10);

        // Sección de Retenciones
        if (!empty($pago_data->retencion1) || !empty($pago_data->retencion2) || !empty($pago_data->retencion3)) {
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->Cell(0, 8, utf8_decode('Retenciones Aplicadas'), 1, 1, 'C', true);
            $pdf->SetFont('Arial', '', 10);

            if (!empty($pago_data->retencion1) && $pago_data->retencion1 > 0) {
                $pdf->Cell(60, 7, utf8_decode('Retención 1:'), 'LR', 0);
                $pdf->Cell(0, 7, 'Bs. ' . number_format($pago_data->retencion1, 2, ',', '.'), 'R', 1);
            }
            if (!empty($pago_data->retencion2) && $pago_data->retencion2 > 0) {
                $pdf->Cell(60, 7, utf8_decode('Retención 2:'), 'LR', 0);
                $pdf->Cell(0, 7, 'Bs. ' . number_format($pago_data->retencion2, 2, ',', '.'), 'R', 1);
            }
            if (!empty($pago_data->retencion3) && $pago_data->retencion3 > 0) {
                $pdf->Cell(60, 7, utf8_decode('Retención 3:'), 'LR', 0);
                $pdf->Cell(0, 7, 'Bs. ' . number_format($pago_data->retencion3, 2, ',', '.'), 'R', 1);
            }

            $pdf->Cell(60, 7, utf8_decode('Total Después Retenciones:'), 'LRB', 0);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(0, 7, 'Bs. ' . number_format($pago_data->total_despues_retenciones, 2, ',', '.'), 'RB', 1);
            $pdf->SetFont('Arial', '', 10);

            $pdf->Ln(10);
        }

        $pdf->SetFont('Arial', 'I', 9);
        $pdf->MultiCell(0, 5, utf8_decode('Este recibo es un comprobante de conciliación del pago con ID ' . $pago_data->id . '. Por favor, guárdelo para sus registros.'), 0, 'C');

        // 4. Salida del PDF (forzar descarga)
        $file_name = 'recibo_conciliado_planilla_' . $pago_data->codigo_planilla . '.pdf';
        $pdf->Output('D', $file_name);
    }
}
