<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/fpdf/fpdf.php';

// ====================================================================================
// CLASE FPDF PERSONALIZADA (ADAPTADA para Certificado de Acreditación)
// ====================================================================================
class Pdf extends FPDF // Tu clase FPDF personalizada
{
    private $certificate_data; // Usaremos esta variable para todos los datos del certificado

    // Constructor adaptado para recibir todos los datos necesarios para el certificado
    function __construct($certificate_data_from_controller)
    {
        parent::__construct('P', 'mm', 'Letter'); // 'P' (Portrait), 'mm', 'Letter' (tamaño carta)
        $this->certificate_data = $certificate_data_from_controller;
        $this->SetAutoPageBreak(true, 15); // Salto de página automático
    }

    // Cabecera del certificado
    function Header()
    {
        // Logo superior (el de tu ejemplo)
        $this->Image(base_url() . 'baner/logo4.png', 10, 1, 190, 20); // Ancho 180, Alto 50
        // Títulos de la República y SNC
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->SetXY(50, 10);
        $this->Ln(10);

        $this->Cell(0, 5, utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'), 0, 1, 'C');
        $this->SetX(10);
        $this->Cell(0, 5, utf8_decode('SERVICIO NACIONAL DE CONTRATACIONES'), 0, 1, 'C');
        $this->Ln(5);

        // Título Principal del Certificado: REGISTRO ÚNICO DE certificacion de facilitadores
        $this->SetX(20);
        $this->SetFont('Arial', 'B', 14);

        $this->Cell(0, 6, utf8_decode('REGISTRO ÚNICO DE CERTIFICACIÓN DE FACILITADORES'), 0, 1, 'C'); // Título de tu imagen

        // QR Code (Superior Izquierda, como en la imagen)
        $qr_path_from_db = $this->certificate_data['certificacion_info']['qrcode_path'] ?? null;

        // --- CAMBIO CLAVE AQUÍ: Inicializar $full_physical_qr_path antes del IF ---
        $full_physical_qr_path = ''; // Inicializar con una cadena vacía o nula. Esto evita el "Undefined variable".

        if ($qr_path_from_db) {
            $full_physical_qr_path = FCPATH . $qr_path_from_db;
        }
        // --- FIN CAMBIO CLAVE ---

        // Las líneas de error_log ahora están seguras porque $full_physical_qr_path siempre estará definido
        error_log('DEBUG_QR: qrcode_path from DB: ' . var_export($qr_path_from_db, true));
        error_log('DEBUG_QR: Full physical path FPDF will use: ' . var_export($full_physical_qr_path, true));
        error_log('DEBUG_QR: File exists check for QR: ' . (file_exists($full_physical_qr_path) ? 'TRUE' : 'FALSE'));

        if ($qr_path_from_db && file_exists($full_physical_qr_path)) {
            $this->Image($full_physical_qr_path, 10, 20, 30, 30);
        } else {
            $this->SetXY(10, 20);
            $this->SetFont('Arial', '', 8);
            $this->Cell(30, 30, utf8_decode('QR no disponible'), 1, 0, 'C');
        }

        // $this->Ln(5); // Espacio después de la cabecera
    }

    // Pie de página del certificado (Firma y referencia legal)
    function Footer()
    {
        $this->SetY(-50); // Posición para la firma (ajusta según necesites)
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, utf8_decode('Anthoni Camilo Torres'), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('Director General'), 0, 1, 'C');
        $this->SetFont('Arial', '', 8);
        $this->MultiCell(0, 4, utf8_decode('Resolución CCP/DGCJ N° 001/2014 de fecha 07 de enero de 2014, Publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nº 40.334 de fecha 15 de enero de 2014.'), 0, 'C');
        $this->Cell(0, 5, utf8_decode('Fecha de Consulta: ') . ($this->certificate_data['time'] ?? date('d-m-Y')), 0, 1, 'C');

        $this->SetY(-25); // Pie de página de la institución
        $this->SetFont('Arial', '', 8);
        $this->MultiCell(0, 4, utf8_decode('Edificio Nova, Final del Bulevar de Sabana Grande, al lado del Metro de Chacaíto. Punto de Referencia: Frente al C.C. Chacaíto. Caracas,Venezuela, (0212) 508.55.99. Twitter: @snc_info Página Web: http://www.snc.gob.ve'), 0, 'C');
        $this->Cell(0, 5, utf8_decode('RIF. G-200024518               Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Método para renderizar el contenido principal del certificado
    function RenderCertificateContent()
    {
        $cert_info = $this->certificate_data['certificacion_info']; // Datos de la certificación
        $facilitadores = $this->certificate_data['facilitadores_detalles']; // Datos de los facilitadores

        // Subtítulo/Declaración
        $this->SetFont('Arial', '', 10);
        $this->Ln(20); // Espacio después de la cabecera

        $this->MultiCell(0, 5, utf8_decode('Esta Dirección de Capacitación de Contrataciones Públicas, certifica que el Organo/Ente detallado a continuación de conformidad a los criterios técnicos emitidos por el Servicio Nacional de Contrataciones (SNC), se encuentra acreditado para impartir los programas, cursos y talleres en materia de Comisión de Contrataciones Públicas:'), 0, 'J');
        $this->Ln(5);

        // Bloque de Datos del Contratista (usando celdas para el diseño de cuadro)
        $this->SetFont('Arial', 'B', 9);
        $this->SetFillColor(240, 240, 240); // Fondo para etiquetas
        $this->SetDrawColor(0, 0, 0); // Borde negro
        $cell_height = 7;

        $this->Cell(80, $cell_height, utf8_decode('Razón Social:'), 1, 0, 'L', true);
        $this->SetFont('Arial', '', 9);
        $this->Cell(110, $cell_height, utf8_decode($cert_info['nombre'] ?? 'N/A'), 1, 1, 'L');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(80, $cell_height, utf8_decode('Número de Identificación Fiscal RIF:'), 1, 0, 'L', true);
        $this->SetFont('Arial', '', 9);
        $this->Cell(110, $cell_height, utf8_decode($cert_info['rif_cont'] ?? 'N/A'), 1, 1, 'L');



        $this->SetFont('Arial', 'B', 9);
        $this->Cell(80, $cell_height, utf8_decode('N° de Comprobante Registro:'), 1, 0, 'L', true);
        $this->SetFont('Arial', '', 9);
        $this->Cell(110, $cell_height, utf8_decode($cert_info['nro_comprobante'] ?? 'N/A'), 1, 1, 'L');

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(80, $cell_height, utf8_decode('Vigencia de la Certificación:'), 1, 0, 'L', true);
        $this->SetFont('Arial', '', 9);
        $vigencia_desde = $cert_info['vigen_cert_desde'] ?? 'N/A';
        $vigencia_hasta = $cert_info['vigen_cert_hasta'] ?? 'N/A';
        $this->Cell(110, $cell_height, utf8_decode("Desde {$vigencia_desde} / Hasta {$vigencia_hasta}"), 1, 1, 'L');
        $this->Ln(10);

        // Bloque de Información del Facilitador(a)
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 7, utf8_decode('INFORMACIÓN DEL FACILITADOR(A)'), 0, 1, 'C');
        $this->Ln(2);

        if (!empty($facilitadores)) {
            $headers = ['Nombre y Apellido', 'Cédula'];
            $column_widths = [140, 50]; // Anchos en mm

            $this->SetFont('Arial', 'B', 9);
            $this->SetFillColor(240, 240, 240);
            $x_pos_headers = $this->GetX();
            $y_pos_headers = $this->GetY();
            foreach ($headers as $i => $header) {
                $this->MultiCell($column_widths[$i], 7, utf8_decode($header), 1, 'C', true);
                $this->SetXY($x_pos_headers + array_sum(array_slice($column_widths, 0, $i + 1)), $y_pos_headers);
            }
            $this->Ln(7);

            $this->SetFont('Arial', '', 9);
            $this->SetFillColor(255, 255, 255);
            foreach ($facilitadores as $facilitador) {
                $x_start_row = $this->GetX();
                $y_start_row = $this->GetY();
                $this->MultiCell($column_widths[0], 6, utf8_decode($facilitador['nombre_ape'] ?? 'N/A'), 1, 'L');
                $this->SetXY($x_start_row + $column_widths[0], $y_start_row);
                $this->MultiCell($column_widths[1], 6, utf8_decode($facilitador['cedula'] ?? 'N/A'), 1, 'L');
                $this->Ln(0); // Para asegurarse de que el cursor avance correctamente
            }
        } else {
            $this->SetFont('Arial', '', 9);
            $this->Cell(0, 6, utf8_decode('No hay facilitadores asociados a esta certificación.'), 0, 1, 'C');
        }
    }

    // Método principal para generar el reporte
    function GenerateReport()
    {
        $this->AddPage(); // Añadir la primera página
        $this->RenderCertificateContent(); // Llamar al nuevo método de contenido
    }
}

// ====================================================================================
// CLASE CONTROLADOR DE CODEIGNITER
// ====================================================================================
class Pdfcertificacion extends CI_Controller // Este es el controlador que se accede por URL
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Certificacion_model'); // Cargar tu modelo
        // Asegúrate de que este modelo tenga todas las funciones necesarias para obtener datos
        // (get_certificacion_info, get_experiencia_empresa, get_facilitadores_by_cert_id,
        // check_miemb_inf_ac, check_miemb_inf_contr_pub, check_miemb_inf_exp_comis, check_miemb_inf_cap_dictado)
    }

    // Función que genera el PDF (Método principal del controlador)
    public function verpdf()
    {

        if (!$this->session->userdata('session')) redirect('login');

        $comprobante_id = $this->input->get('id'); // ID de la certificación (ej. 13)

        // --- Verificación y Manejo de Errores del ID ---
        if (empty($comprobante_id) || !is_numeric($comprobante_id)) {
            log_message('error', 'verpdf: ID de certificación no válido o faltante: ' . var_export($comprobante_id, true));
            $this->session->set_flashdata('error_message', 'ID de certificación no válido o faltante para generar PDF.');
            redirect('ver_ficha_tecnica');
            return;
        }

        // --- 1. Obtener Información de Certificación principal ---
        $certificacion_info = $this->Certificacion_model->get_certificacion_info($comprobante_id);

        if (!$certificacion_info) {
            log_message('error', 'verpdf: No se encontró información para la certificación ID: ' . $comprobante_id);
            $this->session->set_flashdata('error_message', 'No se encontró información para la certificación solicitada para PDF.');
            redirect('ver_ficha_tecnica');
            return;
        }

        // --- 2. Experiencia de la Empresa en Capacitación (NO SE USA EN ESTE CERTIFICADO ESPECÍFICO) ---
        // Según la imagen, esta sección no va en este certificado.
        // Si necesitas este dato para otras verificaciones, lo obtendrías, pero no se renderizaría.
        // $experiencia_empresa = $this->Certificacion_model->get_experiencia_empresa($comprobante_id);


        // --- 3. Obtener Información de Facilitadores (Solo datos básicos) ---
        // Para este certificado, solo necesitamos Nombre y Cédula del facilitador, no todos sus detalles.
        // La lógica get_facilitadores_by_cert_id ya nos trae nombre_ape y cedula.
        $facilitadores_basic_list = $this->Certificacion_model->get_facilitadores_by_cert_id($comprobante_id);

        // --- Preparar todos los datos para pasar al PDF ---
        // SOLO LOS DATOS QUE REALMENTE SE USAN EN ESTE CERTIFICADO
        $all_report_data = [
            'certificacion_info' => $certificacion_info,
            'facilitadores_detalles' => $facilitadores_basic_list, // Solo la lista básica de facilitadores
            'time' => date("d-m-Y"), // Fecha actual para el reporte (Fecha de Consulta)
        ];

        // --- Generar el PDF ---
        $pdf = new Pdf($all_report_data); // <<< Instanciar la clase FPDF 'Pdf'
        $pdf->AliasNbPages();

        $pdf->GenerateReport(); // Este método contendrá toda la lógica de añadir páginas y contenido

        // Salida del PDF (FORZAR DESCARGA)
        $pdf->Output('Certificado_Acreditacion_' . ($certificacion_info['rif_cont'] ?? 'documento') . '.pdf', 'D');
    }
}
