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
        $this->Ln(4);
        // Add a new cell with the header text
        $this->Cell(0, 5, utf8_decode('PLANILLA DE CREACIÓN O ACTUALIZACIÓN DE DATOS'), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('SISTEMA INTEGRADO SNC'), 0, 1, 'C');

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
        $this->SetFont('Arial', '', 6);
        $this->Cell(150, 5, utf8_decode('Avenida Lecuna, Parque Central, Torre Oeste, Piso 6., (0212) 508.55.99. Twitter: @snc_info 
Página Web: http://www.snc.gob.ve') . $this->PageNo() . '/' . $this->AliasNbPages, 0, 1, 'C');

        $this->Cell(150, 5, utf8_decode('RIF. G-200024518               Pagina') . $this->PageNo() . '/' . $this->AliasNbPages, 0, 0, 'C');
    }
}

class Solicitud extends CI_Controller
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


        $da = $this->session->userdata('rif');


        $id_programacion = $this->input->get('id');
        $data = $this->User_model->consulta_solictud1($id_programacion);
        if ($data != '') {
            foreach ($data as $d) {
                $exit_rnc1 = $d->exit_rnc;
                // $pdf->MultiCell(100,5, date("d/m/Y", strtotime($dt5->fecha)), 0, 'L');

            }
        }
        if ($exit_rnc1 == 1) { //si existe en el snc

            $data = $this->User_model->consulta_solictud($id_programacion);
            if ($data != '') {

                foreach ($data as $d) {

                    $pdf->SetFont('Arial', 'B', 9);
                    //
                    $pdf->Cell(56, 5, utf8_decode('Órgano / Ente / Adscrito Solicitante:'), 0, 0, 'R');

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->MultiCell(125, 5, utf8_decode($d->descripcion), 0, 'L');

                    //  $pdf->Cell(40,5, number_format($d->precio_total, 2, ",", "."),0,0,'R');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(35, 5, utf8_decode('RIF:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(20, 5, $d->rif, 0, 1, 'C');

                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(46, 5, utf8_decode('Órgano/Ente de Adscripción:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    if ($d->rifasdcr = 0) {
                        $pdf->Cell(40, 5, $d->rifasdcr, 0, 1, 'L');
                        $pdf->MultiCell(200, 5, utf8_decode($d->nombreascrito), 0, 'L');
                    } else {
                        $pdf->Cell(20, 5, $d->rif, 0, 1, 'C');
                        $pdf->MultiCell(125, 5, utf8_decode($d->descripcion), 0, 'L');
                    }
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(13, 5, utf8_decode('Siglas:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(20, 5, utf8_decode($d->sliglas_), 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(30, 5, utf8_decode('Codigo ONAPRE'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(10, 5, $d->code_onapres, 0, 0, 'C');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(35, 5, utf8_decode('Clasificación:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, $d->desc_clasificacion, 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(16, 5, utf8_decode('Telefono:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(20, 5, utf8_decode($d->tele_), 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(15, 5, utf8_decode('Estado:'), 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(30, 5, $d->descedo, 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(20, 5, utf8_decode('Municipio:'), 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(33, 5, utf8_decode($d->descmun), 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(15, 5, utf8_decode('Parroquia:'), 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(15, 5, utf8_decode($d->descparro), 0, 1, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(17, 5, utf8_decode('Dirección:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->MultiCell(180, 5, utf8_decode($d->dri), 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(62, 5, utf8_decode('Cédula Máxima Autoridad o Cuentadante:'), 0, 0, 'R');
                    $pdf->Cell(90, 5, utf8_decode('Máxima Autoridad o Cuentadante:'), 0, 1, 'R');

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, utf8_decode($d->cedulamax), 0, 0, 'C');
                    $pdf->Cell(150, 5, utf8_decode($d->namemax), 0, 1, 'C');

                    $pdf->SetFont('Arial', 'B', 9);

                    $pdf->Cell(62, 5, utf8_decode('Cargo Máxima Autoridad o Cuentadante:'), 0, 0, 'R');
                    $pdf->Cell(90, 5, utf8_decode('Acto Administrativo de Designación:'), 0, 1, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, utf8_decode($d->cargoma), 0, 0, 'C');
                    $pdf->Cell(150, 5, utf8_decode($d->desc_acto_admin), 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 9);


                    $pdf->Cell(62, 5, utf8_decode('Nº Acto Administrativo de Designación:'), 0, 0, 'R');
                    $pdf->Cell(92, 5, utf8_decode('Fecha Acto Administrativo de Designación :'), 0, 1, 'R');

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, utf8_decode($d->n_actoma), 0, 0, 'C');
                    $pdf->Cell(150, 5, date("d/m/Y", strtotime($d->fecha_acto_admin)), 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 9);

                    $pdf->Cell(62, 5, utf8_decode('Gaceta:'), 0, 0, 'R');
                    $pdf->Cell(50, 5, utf8_decode('Fecha Gaceta:'), 0, 1, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, utf8_decode($d->gacetama), 0, 0, 'C');
                    $pdf->Cell(
                        150,
                        5,
                        date("d/m/Y", strtotime($d->fecha_gacetma)),
                        0,
                        1,
                        'C'
                    );
                }
            }
        } else {
            $data = $this->User_model->consulta_solictud3($id_programacion);
            if ($data != '') {
                //////////////////no existe en el snc
                foreach ($data as $d2) {


                    $pdf->SetFont('Arial', 'B', 9);

                    $pdf->Cell(40, 5, utf8_decode('Órgano / Ente / Adscrito:'), 0, 0, 'R');

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->MultiCell(125, 5, utf8_decode($d2->no_descripcion), 0, 'L');


                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(40, 5, utf8_decode('RIF:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(20, 5, $d2->rif_noin, 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(46, 5, utf8_decode('Órgano/Ente de Adscripción:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(40, 5, $d2->rifadscrito, 0, 1, 'L');
                    $pdf->MultiCell(200, 5, utf8_decode($d2->nameadscrito), 0, 'L');



                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(13, 5, utf8_decode('Siglas:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(20, 5, utf8_decode($d2->siglas), 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(30, 5, utf8_decode('Codigo ONAPRE'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(10, 5, $d2->cod_onapre, 0, 0, 'C');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(35, 5, utf8_decode('Clasificación:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, $d2->desc_clasificacion, 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(16, 5, utf8_decode('Telefono:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(20, 5, utf8_decode($d2->tel_local), 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(15, 5, utf8_decode('Estado:'), 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(30, 5, $d2->descedo, 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(20, 5, utf8_decode('Municipio:'), 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(33, 5, utf8_decode($d2->descmun), 0, 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(15, 5, utf8_decode('Parroquia:'), 0, 0, 'L');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(15, 5, utf8_decode($d2->descparro), 0, 1, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(17, 5, utf8_decode('Dirección:'), 0, 0, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->MultiCell(180, 5, utf8_decode($d2->dri), 0, 'L');
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->SetFont('Arial', 'B', 9);
                    $pdf->Cell(62, 5, utf8_decode('Cédula Máxima Autoridad o Cuentadante:'), 0, 0, 'R');
                    $pdf->Cell(90, 5, utf8_decode('Máxima Autoridad o Cuentadante:'), 0, 1, 'R');

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, utf8_decode($d2->cedula__max_a_f), 0, 0, 'C');
                    $pdf->Cell(150, 5, utf8_decode($d2->name_max_a_f), 0, 1, 'C');

                    $pdf->SetFont('Arial', 'B', 9);

                    $pdf->Cell(62, 5, utf8_decode('Cargo Máxima Autoridad o Cuentadante:'), 0, 0, 'R');
                    $pdf->Cell(90, 5, utf8_decode('Acto Administrativo de Designación:'), 0, 1, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, utf8_decode($d2->cargo__max_a_f), 0, 0, 'C');
                    $pdf->Cell(150, 5, utf8_decode($d2->desc_acto_admin), 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 9);


                    $pdf->Cell(62, 5, utf8_decode('Nº Acto Administrativo de Designación:'), 0, 0, 'R');
                    $pdf->Cell(90, 5, utf8_decode('Fecha Acto Administrativo de Designación:'), 0, 1, 'R');

                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, utf8_decode($d2->n__max_a_f), 0, 0, 'C');
                    $pdf->Cell(150, 5, date("d/m/Y", strtotime($d2->fecha__max_a_f)), 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 9);

                    $pdf->Cell(62, 5, utf8_decode('Gaceta:'), 0, 0, 'R');
                    $pdf->Cell(50, 5, utf8_decode('Fecha Gaceta:'), 0, 1, 'R');
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(50, 5, utf8_decode($d2->gaceta__max_a_f), 0, 0, 'C');
                    $pdf->Cell(
                        150,
                        5,
                        date("d/m/Y", strtotime($d2->gfecha__max_a_f)),
                        0,
                        1,
                        'C'
                    );
                }
            }
        }
        $pdf->Ln(1);

        $pdf->SetFont('Arial', 'B', 9);

        $data = $this->User_model->consulta_solictud4($id_programacion);
        if ($data != '') {

            foreach ($data as $d) {

                $pdf->SetTextColor(255, 0, 0);
                $pdf->SetFont('Arial', 'B', 12);

                $pdf->Cell(160, 5, utf8_decode('DATOS DEL USUARIO O USUARIA DE LA CLAVE'), 0, 1, 'C');
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('Arial', 'B', 9);

                $pdf->Cell(40, 5, utf8_decode('Nombre(s), Apellido(s):'), 0, 0, 'R');

                $pdf->SetFont('Arial', '', 9);
                $pdf->MultiCell(125, 5, utf8_decode($d->name_f . ' ' . $d->apellido_f), 0, 'L');

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(16, 5, utf8_decode('Cedula:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(15, 5, $d->cedula_f, 0, 0, 'C');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(20, 5, utf8_decode('Cargo:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(90, 5, $d->cargo_f, 0, 0, 'C');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(30, 5, utf8_decode('Telefono:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(25, 5, utf8_decode($d->telefono_f), 0, 1, 'L');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(34, 5, utf8_decode('Correo Electrónico:'), 0, 0, 'R');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(90, 5, $d->correo, 0, 1, 'C');
                $pdf->Cell(2, 5, '', 0, 0, 'C');


                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetTextColor(255, 0, 0);

                $pdf->Cell(160, 5, utf8_decode('PERMISOS SOLICITADOS'), 0, 1, 'C');
                $pdf->SetTextColor(0, 0, 0);

                $pdf->SetFont('Arial', '', 9);

                if ($d->registrar_prog_anual == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Registrar Programación Anual (Art. 38 DRVLCP)'), 0, 1, 'L');
                }
                if ($d->modi_prog_anual_ley == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Modificar Programación Anual Ley (Art. 38 numeral 2 DRVLCP)'), 0, 1, 'L');
                }
                if ($d->reg_rend_anual == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Registrar Rendición Anual (Art. 38 numeral 3 DRVLCP)'), 0, 1, 'L');
                }
                if ($d->consl_p_m_r == 't') {
                    $pdf->Cell(80, 5, utf8_decode('Consulta (Programación, Modificación a la Programación y Rendición )'), 0, 1, 'L');
                }
                if ($d->reg_llamado == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Registrar Llamados a Concursos'), 0, 1, 'L');
                }
                if ($d->consul_ll == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Consulta Llamados a Concursos'), 0, 1, 'L');
                }
                if ($d->procesos_ll == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Procesos Llamados a Concursos'), 0, 1, 'L');
                }
                if ($d->accion_llamado == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Acción Llamados a Concursos'), 0, 1, 'L');
                }
                if ($d->menu_reg_eval_desem == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Registro Evaluación Desempeño'), 0, 1, 'L');
                }
                if ($d->menu_soli_anular_eval_desem == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Solicitud Anular Evaluación Desempeño'), 0, 1, 'L');
                }
                if ($d->menu_comprobante_eval_desem == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Comprobante Evaluación Desempeño'), 0, 1, 'L');
                }
                if ($d->reg_not_mb_comi == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Registrar Notificación Miembros de Comisión'), 0, 1, 'L');
                }
                if ($d->reg_cert_mb_comi == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Solicitud de Certificación de Miembros de Comisión'), 0, 1, 'L');
                }
                if ($d->consulta_mb_comi == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Consultar Comisiones'), 0, 1, 'L');
                }
                if ($d->ver_rnc == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Consultar RNC'), 0, 1, 'L');
                }
                if ($d->ccp_facilitadores == 't') {
                    $pdf->Cell(80, 5,  utf8_decode('Solicitud de Certificación de Facilitadores CCP'), 0, 1, 'L');
                }
            }
        }

        $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, utf8_decode(''), 0, 1, 'L');

        $pdf->Cell(160, 5, utf8_decode('FIRMAS y SELLO'), 0, 1, 'C');
        $pdf->Ln(4);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->Line($x, $y, $x + 80, $y);
        $pdf->Line($x + 80 + 10, $y, $x + 80 + 10 + 100, $y);
        $pdf->SetY($y + 5);

        $pdf->Cell(80, 5, utf8_decode('Máxima Autoridad  o Cuentadante'), 0, 0, 'C');

        $pdf->Cell(100, 5, utf8_decode('Usuario o Usuaria'), 0, 1, 'C');


        //    $pdf->Ln(1);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Importante:'), 0, 1, 'L');
        $pdf->SetTextColor(255, 0, 0);

        $pdf->MultiCell(180, 4, utf8_decode('ESTA PLANILLA DEBE REMITIRSE FIRMADA POR LA MAXIMA AUTORIDAD  O CUENTADANTE AL SIGUIENTE CORREO clavesi@snc.gob.ve, números corporativos: 0426-5654730/0426-5654740:'), 0, 'J');
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFont('Arial', '', 7);
        $pdf->MultiCell(180, 4, utf8_decode('Anexar la Gaceta Oficial donde se publicó el acto administrativo (Decreto, Resolución, Providencia o Decisión de Junta, del   Nombramiento de la Máxima Autoridad.
* En caso de Solicitar Clave para el Secretario o Secretaria de la Comisión de Contrataciones, anexar Decreto, Providencia, Resolución, Decisión de Junta, de Designación de la Comisión o Nombramiento o a su vez la gaceta oficial donde se publicó el acto administrativo.
* Se creará por cada Comisión de Contratación una Clave para el secretario o secretaria de la misma.
* Para el Módulo de Programación Anual de Compras se crearán hasta un máximo de tres (3) Claves
* Para el Módulo de Evaluación de Desempeño se crearán hasta un máximo de tres (3) Claves
* Para el Módulo de Consulta de Contratista se crearán hasta un máximo de tres (3) Claves
* Por cada Usuario o Usuaria debe remitirse una Planilla de Solicitud                  '), 0, 'J');

        $pdf->Output('Solicitud Usuario SNC', 'I');
    }
}
