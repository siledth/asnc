<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/third_party/fpdf/fpdf.php';


class Conciliar_pj extends FPDF
{
    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
    }

    function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        $this->SetMargins(10, 10, 10);

        $this->Image(base_url() . 'baner/logo4.png', 10, 10, 190, 20);

        $this->Ln(25);
        $this->Cell(0, 5, utf8_decode('RECIBO DE PAGO CONCILIADO'), 0, 1, 'C');

        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, 'Fecha de Emision: ' . date('d/m/Y H:i:s'), 0, 1, 'R');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetMargins(10, 15, 10);
        $this->SetY(-15);

        $this->SetFont('Arial', '', 8);
        $this->MultiCell(0, 4, utf8_decode('Edificio Nova, Final del Bulevar de Sabana Grande, al lado del Metro de Chacaíto. Punto de Referencia: Frente al C.C. Chacaíto. Caracas, Venezuela, (0212) 508.55.99. Twitter: @snc_info Página Web: http://www.snc.gob.ve'), 0,  'C');

        $this->Ln(2);
        $this->Cell(0, 5, utf8_decode('RIF. G-200024518               Pagina') . $this->PageNo() . '/' . $this->AliasNbPages, 0, 0, 'C');
    }
}
