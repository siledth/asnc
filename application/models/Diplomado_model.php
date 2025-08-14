<?php
class Diplomado_model extends CI_model
{
    //private $table = "certificacion.certificaciones";
    public function __construct()
    {
        parent::__construct();
        // Este metodo conecta a nuestra segunda conexión
        // y asigna a nuestra propiedad $this->db_b_b; los recursos de la misma.
        $this->db_c = $this->load->database('SNCenlinea', true);
        $this->load->library('curl'); // Cargar la librería cURL si no la tienes
        // $this->load->config('bdv_config'); // Cargar la configuración para acceder al token
    }

    function consultar_dip()
    {
        $this->db->select('*');
        $this->db->from('diplomado.diplomado');
        $this->db->order_by('id_diplomado', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }
    function consultar_participantes()
    {
        $this->db->select('i.id_inscripcion, i.id_participante, i.id_diplomado, i.codigo_planilla, i.fecha_inscripcion,
         i.fecha_limite_pago, i.estatus, 
        i.id_pago, i.observaciones, d.name_d, d.id_modalidad , d.fdesde,  d.fhasta, p.cedula, p.nombres, p.apellidos, 
        p.telefono, p.correo, p.edad,  p.direccion, p.trabaja_actualmente, p.observacion,
        e.rif, e.razon_social, e.telefono, e.direccion_fiscal ');

        $this->db->from('diplomado.inscripciones i');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado');
        $this->db->join('diplomado.participantes p', 'p.id_participante = i.id_participante');
        // $this->db->join('comisiones.academico a ', 'a.id_academico = p.grado_instruccion');
        $this->db->join('diplomado.empresas e ', 'e.id_empresa = p.id_empresa');
        $this->db->where('i.estatus', 1);


        // $this->db->where('rif_organoente', $rif_organoente);
        //$this->db->where('c.id_status', 1);
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function consultar_participantes_juridico()
    {
        $this->db->select('i.id_inscripcion_grupal, i.id_participante, i.id_diplomado, i.codigo_planilla, i.fecha_inscripcion,
         i.fecha_limite_pago, i.estatus, 
        i.id_pago, i.observaciones, d.name_d, d.id_modalidad , d.fdesde,  d.fhasta, p.cedula, p.nombres, p.apellidos, 
        p.telefono, p.correo, p.edad,  p.direccion, p.trabaja_actualmente, p.observacion,
        e.rif, e.razon_social, e.telefono, e.direccion_fiscal ');

        $this->db->from('diplomado.inscripciones_grupales i');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado');
        $this->db->join('diplomado.participantes p', 'p.id_participante = i.id_participante');
        // $this->db->join('comisiones.academico a ', 'a.id_academico = p.grado_instruccion');
        $this->db->join('diplomado.empresas e ', 'e.id_empresa = p.id_empresa');
        $this->db->where('i.estatus', 1);


        // $this->db->where('rif_organoente', $rif_organoente);
        //$this->db->where('c.id_status', 1);
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function consultar_participantes_selecci()
    {
        $this->db->select('i.id_inscripcion, i.id_participante, i.id_diplomado, i.codigo_planilla, i.fecha_inscripcion,
         i.fecha_limite_pago, i.estatus, 
        i.id_pago, i.observaciones, d.name_d, d.id_modalidad , d.fdesde,  d.fhasta, p.cedula, p.nombres, p.apellidos, 
        p.telefono, p.correo, p.edad,  p.direccion, p.trabaja_actualmente, p.observacion,
         e.rif, e.razon_social, e.telefono, e.direccion_fiscal, t.nombre as des_estatus ');
        $this->db->from('diplomado.inscripciones i');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado');
        $this->db->join('diplomado.participantes p', 'p.id_participante = i.id_participante');
        $this->db->join('diplomado.empresas e ', 'e.id_empresa = p.id_empresa');
        $this->db->join('diplomado.estatus_inscripcion t ', 't.id_estatus = i.estatus');

        $this->db->where_in('i.estatus', array(2, 4, 5));


        //$this->db->where('c.id_status', 1);
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function consultar_participantes_juridico2()
    {
        $this->db->select(' i.id_inscripcion_grupal, i.id_diplomado, i.codigo_planilla, i.id_empresa,
            i.fecha_inscripcion, i.fecha_limite_pago, i.estatus, 
            d.name_d, d.id_modalidad, d.fdesde, d.fhasta, d.pay,
            e.rif, e.razon_social, e.telefono, e.direccion_fiscal, part.cedula, part.nombres, part.apellidos, es.nombre as des_estatus ');
        $this->db->from('diplomado.inscripciones_grupales i');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado');
        $this->db->join('diplomado.inscripciones_participantes p', 'p.id_inscripcion_grupal = i.id_inscripcion_grupal');
        $this->db->join('diplomado.participantes part', 'part.id_participante = p.id_participante');
        $this->db->join('diplomado.empresas e ', 'e.id_empresa = i.id_empresa');
        $this->db->join('diplomado.estatus_inscripcion es ', 'es.id_estatus = p.estatus');

        $this->db->where('p.estatus >', 1);
        $this->db->where('p.estatus !=', 3);
        // $this->db->where('p.estatus !=', 3);
        $query = $this->db->get();
        return $query->result_array();
    }
    // public function planilla_pay($data)
    // {
    //     // 1. Log del valor recibido (verifica en tu archivo de logs)
    //     log_message('debug', 'Valor recibido en planilla_pay(): ' . print_r($data, true));

    //     // 2. Verifica el valor exacto de rif_b
    //     $rif_b = $data['rif_b'];
    //     log_message('debug', 'Buscando planilla: ' . $rif_b);
    //     $this->db->select('*');
    //     $this->db->where('codigo_planilla', $rif_b);
    //     // 3. Log de la consulta SQL generada (útil para ver si hay filtros incorrectos)
    //     //log_message('debug', 'SQL: ' . $this->db->get_compiled_select('diplomado.ver_cod_pay'));

    //     $query = $this->db->get('diplomado.ver_cod_pay');

    //     if ($query->num_rows() > 0) {
    //         return $query->row_array();
    //     } else {
    //         log_message('debug', 'No se encontró la planilla: ' . $rif_b);
    //         return null;
    //     }
    // }
    public function planilla_pay($data)
    {
        // 1. Log del valor recibido (verifica en tu archivo de logs)
        log_message('debug', 'Valor recibido en planilla_pay(): ' . print_r($data, true));

        // 2. Verifica el valor exacto de rif_b
        $rif_b = $data['rif_b'];
        log_message('debug', 'Buscando planilla: ' . $rif_b);

        // --- PRIMERA BÚSQUEDA: Planilla en estado inicial de pago ---
        // Consulta tu vista para encontrar planillas pendientes de pago.
        $this->db->select('*');
        $this->db->where('codigo_planilla', $rif_b);
        $query_initial = $this->db->get('diplomado.ver_cod_pay');

        if ($query_initial->num_rows() > 0) {
            log_message('debug', 'Planilla encontrada en estado de pago inicial.');
            return $query_initial->row_array();
        } else {
            // --- SEGUNDA BÚSQUEDA: Si no se encuentra, delega al nuevo método. ---
            log_message('debug', 'No se encontró la planilla para pago inicial. Buscando si ya tiene un pago a crédito.');
            return $this->find_credit_payment($data);
        }
    }
    /**
     * Busca una planilla que ya haya realizado el primer pago a crédito
     * y esté pendiente del segundo.
     *
     * @param array $data El array con el código de planilla (`rif_b`).
     * @return array|null El resultado si se encuentra, de lo contrario null.
     */
    public function find_credit_payment($data)
    {
        $codigo_planilla = $data['rif_b'];

        // Nueva consulta para contar los pagos de la planilla
        $this->db->select('COUNT(p.id_pago) AS total_pagos, i.id_inscripcion, d.pay, i.fecha_limite_pago');
        $this->db->from('diplomado.pagos AS p');
        $this->db->join('diplomado.inscripciones AS i', 'i.id_inscripcion = p.id_inscripcion', 'inner');
        $this->db->join('diplomado.diplomado AS d', 'd.id_diplomado = i.id_diplomado', 'inner');
        $this->db->where('i.codigo_planilla', $codigo_planilla);
        $this->db->where('p.tipo_pago', 2); // Pago a crédito
        $this->db->group_by('i.id_inscripcion, d.pay');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row_array();

            // 👉 VERIFICACIÓN CLAVE AQUÍ:
            // Si ya hay un solo pago registrado para esta planilla,
            // significa que es el momento de pagar la segunda cuota.
            if ($result['total_pagos'] == 1) {
                log_message('debug', 'Planilla encontrada con un pago a crédito existente. Se habilita el segundo pago.');

                // Calcular el monto de la segunda cuota
                $credito = (float)$result['pay'];
                // $ivaCredito = $credito * 0.16;
                // $totalConIVACredito = $credito + $ivaCredito;
                $segundaCuota = $credito;

                return [
                    'id_inscripcion' => $result['id_inscripcion'],
                    'codigo_planilla' => $codigo_planilla,
                    'pay' => $segundaCuota,
                    'is_second_payment' => true,
                    'fecha_limite_pago' => $result['fecha_limite_pago']
                ];
            } else {
                // Si tiene 0 o 2+ pagos, no es una planilla válida para la segunda cuota.
                log_message('debug', 'Planilla con tipo_pago=2 tiene más de un pago o ninguno. No es válida para el segundo pago.');
                return null;
            }
        }

        log_message('debug', 'No se encontró la planilla o no tiene pagos a crédito.');
        return null;
    }


    public function planilla_pay2($data)
    {
        // 1. Log del valor recibido (verifica en tu archivo de logs)
        log_message('debug', 'Valor recibido en planilla_pay(): ' . print_r($data, true));

        // 2. Verifica el valor exacto de rif_b
        $rif_b = $data['rif_b'];
        log_message('debug', 'Buscando planilla: ' . $rif_b);

        $this->db->select('*');
        $this->db->where('codigo_planilla', $rif_b);


        // 3. Log de la consulta SQL generada (útil para ver si hay filtros incorrectos)
        //log_message('debug', 'SQL: ' . $this->db->get_compiled_select('diplomado.ver_cod_pay'));

        $query = $this->db->get('diplomado.ver_cod_pay_juridico');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            log_message('debug', 'No se encontró la planilla: ' . $rif_b);
            return null;
        }
    }
    public function registar_pago($data)
    {
        $this->db->trans_start(); // Iniciar transacción

        // Insertar pago
        $this->db->insert('diplomado.pagos', $data);
        $pago_id = $this->db->insert_id();

        $this->db->trans_complete(); // Completa transacción

        return $this->db->trans_status() ? $pago_id : false;
    }

    public function actualizar_estado_inscripcion($codigo_planilla, $estado)
    {
        $this->db->where('codigo_planilla', $codigo_planilla);
        return $this->db->update('diplomado.inscripciones', ['estatus' => $estado]);
    }


    //GUARDAR
    function registrar_b($data)
    {
        $this->db->insert('diplomado.diplomado', $data);
        return true;
    }
    //VER PARA ver exonerado y editar
    function consulta_b($data)
    {
        $this->db->select('*');
        $this->db->from('diplomado.diplomado');
        $this->db->where('id_exonerado', $data['id_exonerado']);
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    //EDITAR exonerado en bd
    function editar_b($data)
    {
        $this->db->where('id_exonerado', $data['id_exonerado']);
        $update = $this->db->update('certificacion.exonerado', $data);
        return true;
    }
    //ELIMAR
    function eliminar_b($data)
    {
        $this->db->where('id_exonerado', $data['id_exonerado']);
        $query = $this->db->delete('certificacion.exonerado');
        return true;
    }

    public function consulta_grado()
    {
        $this->db->select('id_academico, desc_academico');
        $this->db->order_by('id_academico asc');
        $query = $this->db->get('comisiones.academico');
        return $result = $query->result_array();
    }

    public function consulta_diplomado()
    {
        $this->db->select('id_diplomado, name_d,fdesde,fhasta,id_modalidad,pay');
        $this->db->order_by('id_diplomado asc');
        $query = $this->db->get('diplomado.diplomado');
        return $result = $query->result_array();
    }
    public function consulta_diplomado1()
    {
        $this->db->select('id_diplomado, name_d,fdesde,fhasta,id_modalidad,pay,estatus');
        $this->db->order_by('id_diplomado asc');
        $this->db->where('estatus', 1);

        $query = $this->db->get('diplomado.diplomado');
        return $result = $query->result_array();
    }
    public function get_diplomado_by_id($idDiplomado)
    {
        $this->db->select('*');
        $this->db->where('id_diplomado', $idDiplomado);
        $query = $this->db->get('diplomado.diplomado');
        return $query->row_array();
    }

    public function consulta_banco()
    {
        $this->db->select('id_bancos, cod_banc,des_banco');
        $this->db->order_by('id_bancos asc');
        $query = $this->db->get('rnc.bancos');
        return $result = $query->result_array();
    }

    //////////aca empezamos
    public function verificar_rif_organoente($rif)
    {
        $this->db->where('rif', $this->security->xss_clean($rif));
        return $this->db->get('public.organoente')->row_array();
    }

    public function verificar_rif_empresa($rif)
    {
        $this->db->where('rif', $this->security->xss_clean($rif));
        return $this->db->get('diplomado.empresas')->row_array();
    }

    // public function registrar_empresa($data)
    // {
    //     $empresa = array(
    //         'rif' => $this->security->xss_clean($data['rif_b']),
    //         'razon_social' => $this->security->xss_clean($data['razon_social']),
    //         'telefono' => $this->security->xss_clean($data['tel_local']),
    //         'direccion_fiscal' => $this->security->xss_clean($data['direccion_fiscal'])
    //     );

    //     $this->db->insert('diplomado.empresas', $empresa);
    //     return $this->db->insert_id();
    // }

    public function registrar_empresa($rif, $razon_social, $telefono = '0', $direccion = '0')
    {
        $empresa = array(
            'rif' => $this->security->xss_clean($rif),
            'razon_social' => $this->security->xss_clean($razon_social),
            'telefono' => $this->security->xss_clean($telefono), // Aplica XSS clean aquí también
            'direccion_fiscal' => $this->security->xss_clean($direccion) // Aplica XSS clean aquí también
        );

        // Agrega la fecha de registro y el ente_gubernamental si no están definidos
        // en tu función, y asegúrate de que coincida con tu CREATE TABLE
        $empresa['fecha_registro'] = date('Y-m-d');
        $empresa['ente_gubernamental'] = 2; // O el valor por defecto que uses

        $this->db->insert('diplomado.empresas', $empresa);
        return $this->db->insert_id();
    }


    // public function registrar_participante($data, $id_empresa)
    // {
    //     $participante = array(
    //         'id_diplomado' => $this->security->xss_clean($data['id_diplomado']),
    //         'id_tipo' => 1, // Persona natural
    //         'id_empresa' => $id_empresa,
    //         'cedula' => $this->security->xss_clean($data['cedula_f']),
    //         'nombres' => $this->security->xss_clean($data['name_f']),
    //         'apellidos' => $this->security->xss_clean($data['apellido_f']),
    //         'telefono' => $this->security->xss_clean($data['telefono_f']),
    //         'correo' => filter_var($data['correo'], FILTER_SANITIZE_EMAIL),
    //         'edad' => $this->security->xss_clean($data['edad']),
    //         // 'grado_instruccion' => $this->security->xss_clean($data['id_clasificacion']),
    //         // 'titulo_obtenido' => $this->security->xss_clean($data['tutulo']),
    //         'direccion' => $this->security->xss_clean($data['direccion_fiscal_']),
    //         'trabaja_actualmente' => ($data['trabajo'] == '1') ? 1 : 0,
    //         'observacion' => $this->security->xss_clean($data['obser'])
    //     );

    //     $this->db->insert('diplomado.participantes', $participante);
    //     return $this->db->insert_id();
    // }
    // public function registrar_participante($data, $id_empresa)  ultima
    // {
    //     $participante = array(
    //         'id_diplomado' => $this->security->xss_clean($data['id_diplomado']),
    //         'id_tipo' => 1, // Persona natural
    //         'id_empresa' => $id_empresa, // Este es el ID de la empresa inicial, se puede actualizar
    //         'cedula' => $this->security->xss_clean($data['cedula_f']),
    //         'nombres' => $this->security->xss_clean($data['name_f']),
    //         'apellidos' => $this->security->xss_clean($data['apellido_f']),
    //         'telefono' => $this->security->xss_clean($data['telefono_f']),
    //         'correo' => filter_var($data['correo'], FILTER_SANITIZE_EMAIL),
    //         'edad' => $this->security->xss_clean($data['edad']),
    //         // 'grado_instruccion' => $this->security->xss_clean($data['id_clasificacion']),
    //         // 'titulo_obtenido' => $this->security->xss_clean($data['tutulo']),
    //         'direccion' => $this->security->xss_clean($data['direccion_fiscal_']),
    //         'trabaja_actualmente' => 0, // ELIMINAR ESTO, YA NO SE USA
    //         // 'trabaja_actualmente' se inferirá por si id_empresa es 1 o un ID de empresa real
    //         'observacion' => $this->security->xss_clean($data['obser'] ?? '') // Usar null coalescing para observación opcional
    //     );

    //     $this->db->insert('diplomado.participantes', $participante);
    //     return $this->db->insert_id();
    // }

    public function registrar_participante($participante_data_from_controller, $id_empresa_participante) // Acepta el array ya listo
    {
        // Limpiar la cédula para la verificación de existencia
        $cedula = $this->security->xss_clean($participante_data_from_controller['cedula']); // Usar la clave 'cedula' del array ya listo
        $id_tipo_natural = 1; // ID que representa 'Persona Natural'

        // --- VERIFICAR SI EL PARTICIPANTE YA EXISTE POR CÉDULA Y TIPO ---
        $this->db->where('cedula', $cedula);
        $this->db->where('id_tipo', $id_tipo_natural); // Filtrar específicamente por Persona Natural
        $existing_participant = $this->db->get('diplomado.participantes')->row_array();

        if ($existing_participant) {
            // Si el participante con esa cédula y tipo ya existe, devolvemos su ID.
            return $existing_participant['id_participante'];
        } else {
            // El participante no existe, procedemos a insertar los datos.
            // Los datos ya vienen listos en $participante_data_from_controller
            $insert_data = $participante_data_from_controller;

            // Asegurar que id_empresa sea el correcto que vino como segundo argumento si no es el mismo que en el array
            $insert_data['id_empresa'] = $id_empresa_participante;

            // Si 'id_diplomado' es una columna NOT NULL en 'diplomado.participantes',
            // DEBES ASEGURARTE DE QUE $participante_data_from_controller LO INCLUYE Y NO SEA NULL.
            // Basado en tu error, tu tabla `participantes` sí lo tiene como NOT NULL.
            // Por lo tanto, `$participante_data_from_controller` debe contener 'id_diplomado'.

            $this->db->insert('diplomado.participantes', $insert_data); // Inserta el array directamente
            return $this->db->insert_id();
        }
    }
    // Verifica si una cédula ya tiene una inscripción registrada para un diplomado específico.
    public function check_cedula_diplomado_preinscripcion($cedula, $id_diplomado, $id_tipo)
    {
        $this->db->select('i.id_inscripcion');
        $this->db->from('diplomado.inscripciones i');
        $this->db->join('diplomado.participantes p', 'i.id_participante = p.id_participante');
        $this->db->where('p.cedula', $cedula);
        $this->db->where('p.id_tipo', $id_tipo); // Filtrar por tipo de persona
        $this->db->where('i.id_diplomado', $id_diplomado);
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }
    public function actualizar_id_empresa_participante($id_participante, $id_empresa)
    {
        $data = [
            'id_empresa' => $this->security->xss_clean($id_empresa) // Asegura limpiar antes de usar
        ];
        $this->db->where('id_participante', $this->security->xss_clean($id_participante));
        $this->db->update('diplomado.participantes', $data);
        return $this->db->affected_rows() > 0;
    }
    public function registrar_curriculum($data)
    {
        $this->db->insert('diplomado.curriculum_participante', $data);
        return $this->db->insert_id();
    }

    public function obtener_institucion_por_id($id_inst_formadora)
    {
        $this->db->select('descripcion_f'); // Selecciona solo la columna con el nombre de la institución
        $this->db->from('diplomado.inst_formadora');
        $this->db->where('id_inst_formadora', $id_inst_formadora);
        $query = $this->db->get();
        return $query->row_array(); // Devuelve una fila como array asociativo
    }
    public function obtener_curso_por_id($id_curso)
    {
        $this->db->select('id_cursos, descripcion_cursos');
        $this->db->from('diplomado.cursos'); // **Asegúrate de que 'diplomado.cursos' es el nombre CORRECTO de tu tabla de cursos**
        $this->db->where('id_cursos', $id_curso);
        $query = $this->db->get();
        return $query->row_array(); // Devuelve una fila como array
    }
    public function registrar_capacitacion($data)
    {
        // return $this->db->insert('diplomado.capacitaciones_participante', $data);
        $this->db->insert('diplomado.capacitaciones_participante', $data); // Ajusta el nombre de tu tabla
        return $this->db->insert_id(); // O devuelve true/false
    }

    public function registrar_experiencia_laboral($data)
    {

        $this->db->insert('diplomado.experienci_5_anio', $data);
        return $this->db->affected_rows() > 0;
    }
    // public function registrar_inscripcion($id_participante, $id_diplomado)  //ultima
    // {
    //     // Generar código de planilla (ej: DIP-2023-001)
    //     $codigo = 'DIP-' . date('Y') . '-' . str_pad($this->db->count_all('diplomado.inscripciones') + 1, 3, '0', STR_PAD_LEFT);

    //     $inscripcion = array(
    //         'id_participante' => $id_participante,
    //         'id_diplomado' => $id_diplomado,
    //         'codigo_planilla' => $codigo,
    //         'estatus' => 1, // Pendiente
    //         'id_pago' => 1  // Pendiente
    //     );

    //     return $this->db->insert('diplomado.inscripciones', $inscripcion);
    // }
    public function registrar_inscripcion($id_participante, $id_diplomado)
    {
        // --- VERIFICAR SI LA INSCRIPCIÓN YA EXISTE para evitar duplicados en `diplomado.inscripciones` ---
        $this->db->where('id_participante', $id_participante);
        $this->db->where('id_diplomado', $id_diplomado);
        // Puedes añadir una condición de estatus si una inscripción "cancelada" o "rechazada" no cuenta como duplicado.
        // $this->db->where('estatus', 1); // Por ejemplo, si 1 significa 'pendiente' o 'activa'
        $existing_inscription = $this->db->get('diplomado.inscripciones')->row_array();

        if ($existing_inscription) {
            // Si ya existe una inscripción para este participante y diplomado, no creamos un duplicado.
            // Devolvemos true para indicar que la "inscripción" ya está manejada.
            return true;
        }

        // Generar un código de planilla único y más robusto (ej: DIP-AABBCCDD)
        // Puedes combinar fecha y un ID único para mayor certeza
        $codigo = 'DIP-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));


        $inscripcion = array(
            'id_participante' => $id_participante,
            'id_diplomado' => $id_diplomado,
            'codigo_planilla' => $codigo,
            'fecha_inscripcion' => date('Y-m-d H:i:s'), // Usar fecha y hora actual
            'fecha_limite_pago' => date('Y-m-d', strtotime('+7 days')), // 7 días desde hoy
            'estatus' => 1, // Por ejemplo, 'Pendiente'
            'id_pago' => 1,  // ID de pago por defecto (ej. 'Pendiente')
            'observaciones' => null // o vacía si tu campo lo permite
        );

        $this->db->insert('diplomado.inscripciones', $inscripcion);
        // Retorna el ID de la inscripción insertada para que el controlador pueda obtener el código de planilla real.
        return $this->db->insert_id();
    }
    public function get_nombre_diplomado($id_diplomado)
    {
        $this->db->select('name_d');
        $this->db->where('id_diplomado', $id_diplomado);
        $query = $this->db->get('diplomado.diplomado');
        return $query->row()->name_d;
    }

    public function get_fecha_inicio($id_diplomado)
    {
        $this->db->select('fdesde');
        $this->db->where('id_diplomado', $id_diplomado);
        $query = $this->db->get('diplomado.diplomado');
        return date('d/m/Y', strtotime($query->row()->fdesde));
    }


    function nombre_diplomado($data1)
    {
        $query = $this->db->query("SELECT i.id_inscripcion, i.id_participante, i.id_diplomado, i.codigo_planilla, 
        i.fecha_inscripcion, i.fecha_limite_pago, i.estatus, 
        i.id_pago, i.observaciones, d.name_d, d.id_modalidad , d.fdesde,  d.fhasta, d.pay, p.cedula, p.nombres, p.apellidos, 
        p.telefono as tel_p, p.correo, p.edad,  p.direccion, p.trabaja_actualmente, p.observacion,t.nombre as des_estatus,
       c.grado_instruccion, c.titulo_obtenido,  a.desc_academico, c.experiencia_contrataciones_publicas, c.tiene_capacitacion_contrataciones ,e.rif, 
       e.razon_social, e.telefono, e.direccion_fiscal, c.id_curriculum, c.t_contrata_p, c.exp_5_anio
                                FROM diplomado.inscripciones i      
                join  diplomado.diplomado d on d.id_diplomado = i.id_diplomado	
                join  diplomado.participantes p on p.id_participante = i.id_participante                	
                 join  diplomado.curriculum_participante c on c.id_participante = i.id_participante
                 join  comisiones.academico a on a.id_academico = c.grado_instruccion
                join  diplomado.empresas e on e.id_empresa = p.id_empresa	
                join  diplomado.estatus_inscripcion t on t.id_estatus = i.estatus 
                 where i.codigo_planilla = '$data1' 
                  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function obtener_datos_pago($id_inscripcion)
    {
        $query = $this->db->query("SELECT id_pago, monto, fecha_pago, referencia, banco, observaciones ,tipo_pago, id_banco
                              FROM diplomado.pagos 
                              WHERE id_inscripcion = '$id_inscripcion' 
                              ORDER BY fecha_pago DESC LIMIT 1");

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }
    function obtener_datos_codigo($id_inscripcion)
    {
        $query = $this->db->query("SELECT id_inscripcion, id_participante, id_diplomado, codigo_planilla
                              FROM diplomado.inscripciones 
                              WHERE id_inscripcion = '$id_inscripcion' 
                              ORDER BY fecha_pago DESC LIMIT 1");

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }
    public function get_capacitaciones($id_curriculum)
    {
        return $this->db->query("
        SELECT nombre_curso, institucion_formadora, anio_realizacion , horas
        FROM diplomado.capacitaciones_participante 
        WHERE id_curriculum = ?
        ORDER BY id_capacitacion
    ", [$id_curriculum])->result();
    }
    ////experiencia 5 años
    public function get_experiencia($id_curriculum)
    {
        return $this->db->query("
        SELECT id_experienci_5_anio, id_curriculum, nombreinstitucion, cargo, tiempo, desde, hasta
        FROM diplomado.experienci_5_anio 
        WHERE id_curriculum = ?
        ORDER BY id_experienci_5_anio
    ", [$id_curriculum])->result();
    }

    public function procesar_decision($data)
    {
        $this->db->trans_start(); // Inicia transacción

        // 1. Actualizar tabla inscripciones
        $update_data = array('estatus' => $data['estatus']);

        if ($data['estatus'] == 2) { // Solo si es Aceptada
            $update_data['fecha_limite_pago'] = date('Y-m-d', strtotime('+5 days'));
        }

        $this->db->where('id_inscripcion', $data['id_inscripcion']);
        $this->db->update('diplomado.inscripciones', $update_data);

        // 2. Insertar en tabla resultados
        $resultado_data = array(
            'id_inscripcion' => $data['id_inscripcion'],
            'id_estatus' => $data['estatus'],
            'observacion' => $data['observacion'],
            'tipo_pago' => $data['tipo_pago'],

            'id_usuario' => $data['id_usuario']
        );

        $this->db->insert('diplomado.resultados', $resultado_data);

        $this->db->trans_complete(); // Completa transacción

        if ($this->db->trans_status() === FALSE) {
            return array('success' => false, 'message' => 'Error al procesar');
        } else {
            return array('success' => true, 'message' => 'Registro actualizado correctamente');
        }
    }
    public function cambio_estatus($data)
    {
        $this->db->trans_start(); // Inicia transacción

        // 1. Actualizar tabla inscripciones
        $update_data = array('estatus' => $data['estatus']);

        if ($data['estatus'] == 2) { // Solo si es Aceptada
            $update_data['fecha_limite_pago'] = date('Y-m-d', strtotime('+5 days'));
        }

        $this->db->where('id_inscripcion', $data['id_inscripcion']);
        $this->db->update('diplomado.inscripciones', $update_data);

        // 2. Insertar en tabla resultados
        $resultado_data = array(
            'id_inscripcion' => $data['id_inscripcion'],
            'id_estatus' => $data['estatus'],
            'observacion' => $data['observacion'],
            'tipo_pago' => 0,
            'id_usuario' => $data['id_usuario']
        );

        $this->db->insert('diplomado.resultados', $resultado_data);

        $this->db->trans_complete(); // Completa transacción

        if ($this->db->trans_status() === FALSE) {
            return array('success' => false, 'message' => 'Error al procesar');
        } else {
            return array('success' => true, 'message' => 'Registro actualizado correctamente');
        }
    }
    // public function procesar_decision_pj($data)
    // {
    //     $this->db->trans_start(); // Inicia transacción

    //     // 1. Actualizar tabla inscripciones
    //     $update_data = array('estatus' => $data['estatus']);

    //     if ($data['estatus'] == 2) { // Solo si es Aceptada
    //         // $update_data['fecha_limite_pago'] = date('Y-m-d', strtotime('+5 days'));
    //     }

    //     $this->db->where('id_participante', $data['id_inscripcion']);
    //     $this->db->update('diplomado.inscripciones_participantes', $update_data);

    //     // 2. Insertar en tabla resultados
    //     $resultado_data = array(
    //         'id_inscripcion' => $data['id_inscripcion'],
    //         'id_estatus' => $data['estatus'],
    //         'observacion' => $data['observacion'],
    //         'id_usuario' => $data['id_usuario']
    //     );

    //     $this->db->insert('diplomado.resultados', $resultado_data);

    //     $this->db->trans_complete(); // Completa transacción

    //     if ($this->db->trans_status() === FALSE) {
    //         return array('success' => false, 'message' => 'Error al procesar');
    //     } else {
    //         return array('success' => true, 'message' => 'Registro actualizado correctamente');
    //     }
    // }
    // public function procesar_decision_pj($data)
    // {
    //     $this->db->trans_start();

    //     // 1. Actualizar el participante
    //     $this->db->where('id_participante', $data['id_inscripcion']);
    //     $this->db->update('diplomado.inscripciones_participantes', ['estatus' => $data['estatus']]);

    //     // 2. Insertar en resultados
    //     $this->db->insert('diplomado.resultados', [
    //         'id_inscripcion' => $data['id_inscripcion'],
    //         'id_estatus'     => $data['estatus'],
    //         'observacion'    => $data['observacion'],
    //         'tipo_pago' => $data['tipo_pago'],

    //         'id_usuario'     => $data['id_usuario']
    //     ]);

    //     // 3. Verificar si es el último participante sin decisión
    //     $id_inscripcion_grupal = $this->db->query("
    //     SELECT id_inscripcion_grupal 
    //     FROM diplomado.inscripciones_participantes 
    //     WHERE id_participante = " . $data['id_inscripcion'])->row()->id_inscripcion_grupal;

    //     $pendientes = $this->db->query("
    //     SELECT COUNT(*) as total 
    //     FROM diplomado.inscripciones_participantes 
    //     WHERE id_inscripcion_grupal = $id_inscripcion_grupal 
    //     AND estatus IS NULL OR estatus = 0")->row()->total;

    //     $aceptados = $this->db->query("
    //     SELECT COUNT(*) as total 
    //     FROM diplomado.inscripciones_participantes 
    //     WHERE id_inscripcion_grupal = $id_inscripcion_grupal 
    //     AND estatus = 2")->row()->total;

    //     // Si es el último participante y hay al menos 1 aceptado, actualizar inscripción grupal
    //     if ($pendientes == 0 && $aceptados > 0) {
    //         $this->db->where('id_inscripcion_grupal', $id_inscripcion_grupal);
    //         $this->db->update('diplomado.inscripciones_grupales', ['estatus' => 2]);
    //     } 

    //     $this->db->trans_complete();

    //     return [
    //         'success' => $this->db->trans_status(),
    //         'message' => $this->db->trans_status()
    //             ? 'Registro actualizado correctamente'
    //             : 'Error al procesar'
    //     ];
    // }
    public function procesar_decision_pj($data)
    {
        $this->db->trans_start();

        // 1. Actualizar el participante
        $this->db->where('id_participante', $data['id_inscripcion']);
        $this->db->update('diplomado.inscripciones_participantes', ['estatus' => $data['estatus']]);

        // 2. Insertar en resultados
        $this->db->insert('diplomado.resultados', [
            'id_inscripcion' => $data['id_inscripcion'],
            'id_estatus'     => $data['estatus'],
            'observacion'    => $data['observacion'],
            'tipo_pago'      => $data['tipo_pago'],
            'id_usuario'     => $data['id_usuario']
        ]);

        // 3. Obtener ID de inscripción grupal
        $id_inscripcion_grupal = $this->db->query("
        SELECT id_inscripcion_grupal 
        FROM diplomado.inscripciones_participantes 
        WHERE id_participante = ?", [$data['id_inscripcion']])->row()->id_inscripcion_grupal;

        // 4. Verificar participantes pendientes y aceptados (optimizado)
        $query = $this->db->query("
        SELECT 
            SUM(CASE WHEN estatus IS NULL OR estatus = 0 THEN 1 ELSE 0 END) as pendientes,
            SUM(CASE WHEN estatus = 2 THEN 1 ELSE 0 END) as aceptados
        FROM diplomado.inscripciones_participantes 
        WHERE id_inscripcion_grupal = ?", [$id_inscripcion_grupal]);

        $result = $query->row();

        // 5. Actualizar inscripción grupal si es necesario
        if ($result->pendientes == 0 && $result->aceptados > 0) {
            $update_data = [
                'estatus' => 2,
                'tipo_pago' => $data['tipo_pago'], // Aquí se incluye el tipo_pago correctamente
                'id_pago' => $data['tipo_pago']
            ];

            $this->db->where('id_inscripcion_grupal', $id_inscripcion_grupal);
            $this->db->update('diplomado.inscripciones_grupales', $update_data);
        }

        $this->db->trans_complete();

        return [
            'success' => $this->db->trans_status(),
            'message' => $this->db->trans_status()
                ? 'Registro actualizado correctamente'
                : 'Error al procesar'
        ];
    }
    public function get_bancos()
    {
        $this->db->select('*');
        // $this->db->where('id_diplomado', $id_diplomado);
        $query = $this->db->get('rnc.bancos');
        return $query->row()->name_d;
    }

    public function registrar_actualizar_empresa($data)
    {
        // Verificar si la empresa ya existe
        $this->db->where('rif', $data['rif']);
        $empresa = $this->db->get('diplomado.empresas')->row_array();

        if ($empresa) {
            // Actualizar datos existentes
            $this->db->where('id_empresa', $empresa['id_empresa']);
            $this->db->update('diplomado.empresas', $data);
            return $empresa['id_empresa'];
        } else {
            // Insertar nueva empresa
            $this->db->insert('diplomado.empresas', $data);
            return $this->db->insert_id();
        }
    }

    public function registrar_participantejs($data)
    {
        // Verificar si el participante ya existe para este diplomado y empresa
        $this->db->where('cedula', $data['cedula']);
        $this->db->where('id_diplomado', $data['id_diplomado']);
        $this->db->where('id_empresa', $data['id_empresa']);
        $existente = $this->db->get('diplomado.participantes')->row_array();

        if ($existente) {
            return $existente['id_participante'];
        }

        $this->db->insert('diplomado.participantes', $data);
        return $this->db->insert_id();
    }

    public function registrar_curriculumjs($data)
    {
        $this->db->insert('diplomado.curriculum_participante', $data);
        return $this->db->insert_id();
    }

    public function registrar_capacitacionjs($data)
    {
        return $this->db->insert('diplomado.capacitaciones_participante', $data);
    }

    public function registrar_inscripcionjs($id_participante, $id_diplomado)
    {
        // Generar código de planilla (ej: DIP-2023-001)
        $codigo = 'DIP-' . date('Y') . '-' . str_pad($this->db->count_all('diplomado.inscripciones') + 1, 3, '0', STR_PAD_LEFT);

        $data = [
            'id_participante' => $id_participante,
            'id_diplomado' => $id_diplomado,
            'codigo_planilla' => $codigo,
            'estatus' => 1, // 1 = Pendiente
            'fecha_limite_pago' => date('Y-m-d', strtotime('+7 days')) // 7 días para pagar
        ];

        return $this->db->insert('diplomado.inscripciones', $data);
    }

    // ----------------------- juridico
    public function registrar_actualizar($data)
    {
        // Validación básica
        if (empty($data['rif'])) {
            throw new Exception('El RIF es requerido');
        }

        // Limpiar y formatear el RIF
        $rif = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $data['rif']));

        // Verificar si la empresa ya existe
        $empresa_existente = $this->db->get_where('diplomado.empresas', ['rif' => $rif])->row_array();

        // Preparar datos para insertar/actualizar
        $empresa_data = [
            'rif' => $rif,
            'razon_social' => $data['razon_social'] ?? '',
            'telefono' => $data['telefono'] ?? '',
            'direccion_fiscal' => $data['direccion_fiscal'] ?? '',
            'ente_gubernamental' => $data['es_ente'] ?? 2
        ];

        if ($empresa_existente) {
            // Actualizar empresa existente
            $this->db->where('id_empresa', $empresa_existente['id_empresa']);
            $this->db->update('diplomado.empresas', $empresa_data);
            return $empresa_existente['id_empresa'];
        } else {
            // Insertar nueva empresa
            $this->db->insert('diplomado.empresas', $empresa_data);
            return $this->db->insert_id();
        }
    }

    //////////////////grupales
    public function registrar_inscripcion_grupal($id_empresa, $id_diplomado, $ids_participantes)
    {
        // Verificar si ya existe una inscripción grupal para esta empresa y diplomado
        $this->db->where('id_empresa', $id_empresa);
        $this->db->where('id_diplomado', $id_diplomado);
        $existente = $this->db->get('diplomado.inscripciones_grupales')->row();

        if ($existente) {
            // Si ya existe, usar esa inscripción
            $id_inscripcion_grupal = $existente->id_inscripcion_grupal;
            $codigo_planilla = $existente->codigo_planilla;

            // Actualizar el total de participantes
            $this->db->where('id_inscripcion_grupal', $id_inscripcion_grupal)
                ->update('diplomado.inscripciones_grupales', [
                    'total_participantes' => $existente->total_participantes + count($ids_participantes)
                ]);
        } else {
            // Si no existe, crear nueva inscripción grupal
            $codigo = 'DIPGRP-' . date('Y') . '-' . strtoupper(substr(md5(uniqid()), 0, 8));

            $data_inscripcion = [
                'id_empresa' => $id_empresa,
                'id_diplomado' => $id_diplomado,
                'codigo_planilla' => $codigo,
                'fecha_inscripcion' => date('Y-m-d H:i:s'),
                'fecha_limite_pago' => date('Y-m-d', strtotime('+7 days')),
                'estatus' => 1,
                'total_participantes' => count($ids_participantes)
            ];

            $this->db->insert('diplomado.inscripciones_grupales', $data_inscripcion);
            $id_inscripcion_grupal = $this->db->insert_id();
            $codigo_planilla = $codigo;
        }

        // Registrar participantes en la inscripción grupal
        foreach ($ids_participantes as $id_participante) {
            // Verificar si el participante ya está registrado en esta inscripción
            $this->db->where('id_inscripcion_grupal', $id_inscripcion_grupal);
            $this->db->where('id_participante', $id_participante);
            $existe = $this->db->get('diplomado.inscripciones_participantes')->row();

            if (!$existe) {
                $this->db->insert('diplomado.inscripciones_participantes', [
                    'id_inscripcion_grupal' => $id_inscripcion_grupal,
                    'id_participante' => $id_participante,
                    'estatus' => 1
                ]);
            }
        }

        return $codigo_planilla;
    }
    // Obtener información del diplomado y la empresa (solo 1 registro)
    // function get_info_inscripcion_grupal($codigo_planilla)
    // {
    //     $query = $this->db->query("
    //     SELECT 
    //         i.id_inscripcion_grupal, i.id_diplomado, i.codigo_planilla, 
    //         i.fecha_inscripcion, i.fecha_limite_pago, i.estatus, 
    //         d.name_d, d.id_modalidad, d.fdesde, d.fhasta, d.pay,
    //         t.nombre as des_estatus,
    //         e.rif, e.razon_social, e.telefono, e.direccion_fiscal
    //     FROM diplomado.inscripciones_grupales i
    //     JOIN diplomado.diplomado d ON d.id_diplomado = i.id_diplomado
    //     JOIN diplomado.empresas e ON e.id_empresa = i.id_empresa
    //     JOIN diplomado.estatus_inscripcion t ON t.id_estatus = i.estatus
    //     WHERE i.codigo_planilla = ?
    // ", [$codigo_planilla]);

    //     return $query->row();
    // }

    function get_info_inscripcion_grupal($codigo_planilla)
    {
        $query = $this->db->query("
        SELECT 
            i.id_inscripcion_grupal, i.id_diplomado, i.codigo_planilla, 
            i.fecha_inscripcion, i.fecha_limite_pago, i.estatus, i.id_pago,
            d.name_d, d.id_modalidad, d.fdesde, d.fhasta, d.pay, d.pronto_pago,
            t.nombre as des_estatus,
            e.rif, e.razon_social, e.telefono, e.direccion_fiscal,
            e.ente_gubernamental,
            (SELECT COUNT(*) 
             FROM diplomado.inscripciones_participantes p 
             WHERE p.id_inscripcion_grupal = i.id_inscripcion_grupal 
             AND p.estatus = 2) as participantes_aceptados
        FROM diplomado.inscripciones_grupales i
        JOIN diplomado.diplomado d ON d.id_diplomado = i.id_diplomado
        JOIN diplomado.empresas e ON e.id_empresa = i.id_empresa
        JOIN diplomado.estatus_inscripcion t ON t.id_estatus = i.estatus
        WHERE i.codigo_planilla = ?
    ", [$codigo_planilla]);

        return $query->row();
    }

    function consultar_participantes_juridico1($id_inscripcion_grupal)
    {
        $this->db->select(' i.id_inscripcion_grupal, i.id_diplomado, i.codigo_planilla, i.id_empresa,
            i.fecha_inscripcion, i.fecha_limite_pago, i.estatus, 
            d.name_d, d.id_modalidad, d.fdesde, d.fhasta, d.pay,
            part.cedula, part.nombres, part.apellidos, p.id_participante ');
        $this->db->from('diplomado.inscripciones_grupales i');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado');
        $this->db->join('diplomado.inscripciones_participantes p', 'p.id_inscripcion_grupal = i.id_inscripcion_grupal');
        $this->db->join('diplomado.participantes part', 'part.id_participante = p.id_participante');
        $this->db->where('i.id_inscripcion_grupal', $id_inscripcion_grupal);
        $this->db->where('p.estatus', '1');
        $query = $this->db->get();
        return $query->result_array();
    }
    function consultar_empresa()
    {
        $this->db->select(' i.id_inscripcion_grupal, i.id_diplomado, i.codigo_planilla, i.id_empresa,
            i.fecha_inscripcion, i.fecha_limite_pago, i.estatus, 
            d.name_d, d.id_modalidad, d.fdesde, d.fhasta, d.pay,
            e.rif, e.razon_social, e.telefono, e.direccion_fiscal');
        $this->db->from('diplomado.inscripciones_grupales i');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado');
        $this->db->join('diplomado.empresas e ', 'e.id_empresa = i.id_empresa');
        $this->db->where('i.estatus', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Obtener participantes (todos los registros)
    function get_participantes_inscripcion($id_inscripcion_grupal)
    {
        $query = $this->db->query("
        SELECT 
            p.id_participante, p.nombres, p.apellidos, p.cedula, 
            p.telefono as tel_p, p.correo, p.edad, p.direccion,
            c.grado_instruccion, c.titulo_obtenido, 
            a.desc_academico, c.experiencia_contrataciones_publicas,
            c.tiene_capacitacion_contrataciones, c.id_curriculum, c.t_contrata_p
        FROM diplomado.inscripciones_participantes o
        JOIN diplomado.participantes p ON p.id_participante = o.id_participante
        JOIN diplomado.curriculum_participante c ON c.id_participante = p.id_participante
        JOIN comisiones.academico a ON a.id_academico = c.grado_instruccion
        WHERE o.id_inscripcion_grupal = ?
    ", [$id_inscripcion_grupal]);

        return $query->result();
    }
    public function get_capacitacionespj_($id_curriculum)
    {
        return $this->db->query("
        SELECT i.id, i.id_inscripcion_grupal, i.id_participante,
         p.cedula, p.nombres, p.apellidos, 
        p.telefono as tel_p, p.correo, p.edad,  p.direccion, p.trabaja_actualmente, p.observacion,
        FROM diplomado.inscripciones_participantes i
       join  diplomado.participantes p on p.id_participante = i.id_participante         	
        WHERE id_curriculum = ?
        ORDER BY id_capacitacion
    ", [$id_curriculum])->result();
    }

    public function verificarCedulaEnDiplomado($cedula, $id_diplomado)
    {
        // Primero validamos que la cédula tenga el formato correcto
        if (!is_numeric($cedula) || strlen($cedula) < 5 || strlen($cedula) > 10) {
            return false;
        }

        // Consulta para verificar si la cédula ya está registrada en el mismo diplomado
        $query = $this->db->query("
            SELECT COUNT(*) as total 
            FROM diplomado.participantes 
            WHERE cedula = ? AND id_diplomado = ?
        ", array($cedula, $id_diplomado));

        $resultado = $query->row();
        return ($resultado->total > 0);
    }

    ////////////OBTENER CURSOS 
    public function obtener_todos_los_cursos()
    {
        $this->db->select('id_cursos, descripcion_cursos');
        $this->db->order_by('id_cursos', 'ASC');
        $query = $this->db->get('diplomado.cursos');
        return $query->result_array();
    }

    ////////////////guardar conciliacion empresas juridicas
    public function guardar_pago_conciliado($data)
    {
        // Limpiar y preparar los datos antes de insertar
        // Esto es crucial para la seguridad (evitar SQL Injection)
        // y para asegurar que los números se guarden correctamente.

        $insert_data = [
            'codigo_planilla' => $data['codigo_planilla'] ?? null,
            'id_inscripcion' => $data['id_inscripcion'] ?? null,
            'id_ente' => $data['id_ente'] ?? null,
            'tipo_pago' => $data['tipo_pago'] ?? null,
            'total_pago' => isset($data['total_pago']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['total_pago']))) : null,
            'iva' => isset($data['iva']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['iva']))) : null,
            'total_iva' => isset($data['total_iva']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['total_iva']))) : null,
            'pay' => isset($data['pay']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['pay']))) : null,
            'iva_credito' => isset($data['iva_credito']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['iva_credito']))) : null,
            'total_iva_credito' => isset($data['total_iva_credito']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['total_iva_credito']))) : null,
            'mitad_total_credito' => isset($data['mitad_total_credito']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['mitad_total_credito']))) : null,
            'fecha_limite_pago' => $data['fecha_limite_pago'] ?? null,
            'retencion1' => isset($data['retencion1']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['retencion1']))) : null,
            'retencion2' => isset($data['retencion2']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['retencion2']))) : null,
            'retencion3' => isset($data['retencion3']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['retencion3']))) : null,
            'total_despues_retenciones' => isset($data['total_despues_retenciones']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['total_despues_retenciones']))) : null,
            'total_despues_retenciones_credito' => isset($data['total_despues_retenciones_credito']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['total_despues_retenciones_credito']))) : null,
            'bancoorigen' => $data['bancoOrigen'] ?? null,
            'referencia' => $data['referencia'] ?? null,
            'fechapago' => $data['fechaPago'] ?? null,
            'nfsiges' => $data['nfsiges'] ?? null,
            'monto' => isset($data['monto']) ? floatval(str_replace(',', '.', str_replace('.', '', $data['monto']))) : null,
            'pago_verificado' => (int)($data['pagoVerificado'] ?? 0), // Convertir a entero
        ];

        // Eliminar valores nulos para columnas que no aceptan NULL si estás usando un ORM que lo requiera o para evitar errores
        foreach ($insert_data as $key => $value) {
            if ($value === null && $key !== 'id_inscripcion' && $key !== 'id_ente' && $key !== 'descripcion' && $key !== 'nroMov') { // Ajusta las columnas que pueden ser NULL en tu BD
                unset($insert_data[$key]);
            }
        }


        // Insertar los datos en la tabla 'pagos_conciliados'
        $this->db->insert('diplomado.pagos_conciliados', $insert_data);

        // Devolver el ID del último insert, o false si falla
        return $this->db->insert_id();
    }

    ///instituciones 
    public function obtener_instituciones_formadoras()
    {
        $this->db->select('id_inst_formadora, descripcion_f, id_otros, otros'); // Selecciona las columnas relevantes
        $this->db->from('diplomado.inst_formadora');
        // Opcional: ordenar si quieres que "OTROS" aparezca al final
        $this->db->order_by('CASE WHEN descripcion_f = \'OTROS\' THEN 1 ELSE 0 END, descripcion_f');
        $query = $this->db->get();
        return $query->result_array(); // Devuelve como array de arrays
    }
    public function check_rif_diplomado_preinscripcion($rif_limpio, $id_diplomado)
    {
        $this->db->select('ig.id_inscripcion_grupal');
        $this->db->from('diplomado.inscripciones_grupales ig');
        $this->db->join('diplomado.empresas e', 'ig.id_empresa = e.id_empresa');
        $this->db->where('e.rif', $rif_limpio); // Usar el RIF limpio para la búsqueda
        $this->db->where('ig.id_diplomado', $id_diplomado);
        $query = $this->db->get();

        return $query->num_rows() > 0; // Si hay filas, significa que ya existe
    }

    // editar diplomado 
    // Nueva función para obtener un diplomado por ID
    function get_diplomado_by_id2($id_diplomado)
    {
        $this->db->select('*');
        $this->db->from('diplomado.diplomado');
        $this->db->where('id_diplomado', $id_diplomado);
        $query = $this->db->get();
        return $query->row_array(); // Retorna una sola fila como array
    }

    // Nueva función para actualizar un diplomado
    function actualizar_diplomado($id_diplomado, $data)
    {
        // Añadir log para depuración antes de la actualización
        log_message('debug', 'Intentando actualizar diplomado con ID: ' . $id_diplomado . ' y datos: ' . json_encode($data));

        $this->db->where('id_diplomado', $id_diplomado);
        $result = $this->db->update('diplomado.diplomado', $data);

        if ($result) {
            // La operación de actualización fue exitosa desde la perspectiva de CodeIgniter.
            // Esto no significa que se hayan modificado filas, solo que la consulta no falló.
            if ($this->db->affected_rows() > 0) {
                log_message('info', 'Diplomado con ID: ' . $id_diplomado . ' actualizado exitosamente.');
                return ['status' => true, 'message' => 'Diplomado actualizado exitosamente.'];
            } else {
                // No se afectaron filas, lo que puede indicar que los datos no cambiaron o el ID no existe.
                log_message('info', 'Diplomado con ID: ' . $id_diplomado . ' no modificado (datos iguales o ID no existe).');
                return ['status' => true, 'message' => 'Diplomado encontrado, pero no se realizaron cambios.'];
            }
        } else {
            // Hubo un error en la ejecución de la consulta de la base de datos.
            $error = $this->db->error(); // Obtiene el último error de la base de datos
            log_message('error', 'Error al actualizar diplomado con ID: ' . $id_diplomado . '. Código de error: ' . $error['code'] . ', Mensaje: ' . $error['message']);
            return ['status' => false, 'message' => 'Error en la base de datos: ' . $error['message']];
        }
    }

    // cambio estatus diplomado 
    function actualizar_estatus_diplomado($id_diplomado, $new_estatus)
    {
        log_message('debug', 'Intentando cambiar estatus de diplomado con ID: ' . $id_diplomado . ' a estatus: ' . $new_estatus);

        $this->db->where('id_diplomado', $id_diplomado);
        $result = $this->db->update('diplomado.diplomado', ['estatus' => $new_estatus]);

        if ($result) {
            if ($this->db->affected_rows() > 0) {
                log_message('info', 'Estatus de diplomado con ID: ' . $id_diplomado . ' cambiado a ' . $new_estatus . ' exitosamente.');
                return ['status' => true, 'message' => 'Estatus actualizado exitosamente.'];
            } else {
                log_message('info', 'Estatus de diplomado con ID: ' . $id_diplomado . ' no modificado (mismo estatus o ID no existe).');
                return ['status' => true, 'message' => 'Estatus no cambiado (ya estaba en ese estado o diplomado no encontrado).'];
            }
        } else {
            $error = $this->db->error();
            log_message('error', 'Error DB al cambiar estatus de diplomado con ID: ' . $id_diplomado . '. Código: ' . $error['code'] . ', Mensaje: ' . $error['message']);
            return ['status' => false, 'message' => 'Error en la base de datos al actualizar estatus: ' . $error['message']];
        }
    }

    ////////////////totales de participantes inscritos y demas 

    public function get_inscripciones_stats()
    {
        $stats = [];

        // 1. Conteo de inscripciones por estatus específico para cada diplomado
        // Esto agrupa por diplomado y luego cuenta los estatus 1, 2, 5, 6
        $this->db->select('
            d.id_diplomado,
            d.name_d,
            SUM(CASE WHEN i.estatus = 1 THEN 1 ELSE 0 END) AS total_preinscrito,
            SUM(CASE WHEN i.estatus = 2 THEN 1 ELSE 0 END) AS total_aceptado_espera_pago,
            SUM(CASE WHEN i.estatus = 4 THEN 1 ELSE 0 END) AS total_pagado_inscrito,
            SUM(CASE WHEN i.estatus = 5 THEN 1 ELSE 0 END) AS total_exonerado,
            SUM(CASE WHEN i.estatus = 6 THEN 1 ELSE 0 END) AS total_aprobado_proxima_corte,
            SUM(CASE WHEN i.estatus = 3 THEN 1 ELSE 0 END) AS total_no_califica,


            COUNT(i.id_inscripcion) AS total_inscritos_diplomado
        ');
        $this->db->from('diplomado.inscripciones i');
        $this->db->join('diplomado.diplomado d', 'i.id_diplomado = d.id_diplomado');
        // Puedes añadir un WHERE si solo quieres estadísticas de inscripciones de persona natural
        // (asumiendo que hay un campo en 'participantes' o 'inscripciones' que las distinga)
        // Por ahora, asumimos que todas las inscripciones en esta tabla son de persona natural.
        $this->db->group_by('d.id_diplomado, d.name_d');
        $this->db->order_by('d.name_d', 'ASC'); // Opcional: ordenar por nombre de diplomado
        $query = $this->db->get();
        $stats['by_diplomado'] = $query->result_array();


        // 2. Conteo global por estatus (opcional, si quieres un total general fuera de cada diplomado)
        // Podrías necesitar esto para un "Total General de Preinscritos", "Total General de Aceptados", etc.
        $this->db->select('
            i.estatus,
            COUNT(i.id_inscripcion) AS total_global_estatus
        ');
        $this->db->from('diplomado.inscripciones i');
        // Asumiendo que esta tabla solo tiene inscripciones de persona natural
        $this->db->where_in('i.estatus', [1, 2, 5, 6]); // Solo los estatus que te interesan
        $this->db->group_by('i.estatus');
        $query = $this->db->get();
        $stats['global_by_estatus'] = $query->result_array();


        // 3. Total general de inscripciones (para "Total Proyectos en Ejecución" o "Total Inscripciones")
        $this->db->select('COUNT(id_inscripcion) AS total_inscripciones_generales');
        $this->db->from('diplomado.inscripciones');
        $query = $this->db->get();
        $stats['total_general'] = $query->row_array()['total_inscripciones_generales'];

        return $stats;
    }
    public function get_inscripciones_juridicas_stats()
    {
        $stats = [];

        // 1. Conteo de inscripciones por estatus específico para cada diplomado (Personas Jurídicas)
        $this->db->select('
            d.id_diplomado,
            d.name_d,
            SUM(CASE WHEN ip.estatus = 1 THEN 1 ELSE 0 END) AS total_preinscrito,
            SUM(CASE WHEN ip.estatus = 2 THEN 1 ELSE 0 END) AS total_aceptado_espera_pago,
            SUM(CASE WHEN ip.estatus = 5 THEN 1 ELSE 0 END) AS total_exonerado,
            SUM(CASE WHEN ip.estatus = 6 THEN 1 ELSE 0 END) AS total_aprobado_proxima_corte,
            COUNT(ip.id) AS total_inscritos_diplomado
        ');
        $this->db->from('diplomado.inscripciones_participantes ip');
        $this->db->join('diplomado.inscripciones_grupales ig', 'ip.id_inscripcion_grupal = ig.id_inscripcion_grupal');
        $this->db->join('diplomado.diplomado d', 'ig.id_diplomado = d.id_diplomado');
        $this->db->group_by('d.id_diplomado, d.name_d');
        $this->db->order_by('d.name_d', 'ASC');
        $query = $this->db->get();
        $stats['by_diplomado_juridica'] = $query->result_array();


        // 2. Conteo global por estatus (Personas Jurídicas)
        $this->db->select('
            ip.estatus,
            COUNT(ip.id) AS total_global_estatus
        ');
        $this->db->from('diplomado.inscripciones_participantes ip');
        $this->db->where_in('ip.estatus', [1, 2, 5, 6]); // Solo los estatus que te interesan
        $this->db->group_by('ip.estatus');
        $query = $this->db->get();
        $stats['global_by_estatus_juridica'] = $query->result_array();


        // 3. Total general de inscripciones (Personas Jurídicas)
        $this->db->select('COUNT(id) AS total_inscripciones_generales');
        $this->db->from('diplomado.inscripciones_participantes');
        $query = $this->db->get();
        $stats['total_general_juridica'] = $query->row_array()['total_inscripciones_generales'];

        return $stats;
    }

    //editar persona natural usuario interno snc
    function check_miemb_inf_ac($id_participante)
    {

        $this->db->select('id_participante,cedula, nombres, apellidos, telefono, correo, edad, direccion');
        //$this->db->join('comisiones.academico c2', 'c2.id_academico = pi2.id_academico');
        // $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
        // $this->db->join('comisiones.status_comision st','st.id_status = pi2.id_status');

        $this->db->where('id_participante', $id_participante);
        $this->db->from('diplomado.participantes');
        $query = $this->db->get();
        return $query->result_array();
    }
    function check_miemb_inf_ac_($data)
    { //mostrar para editar informacion persona natural

        $this->db->select('id_participante,cedula, nombres, apellidos, telefono, correo, edad, direccion');
        //$this->db->join('comisiones.academico c2', 'c2.id_academico = pi2.id_academico');
        $this->db->where('id_participante', $data['id_participante']);
        $this->db->from('diplomado.participantes');

        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }
    public function editar_datos_pn($data)
    {  // edita la informacion academica del miembro de comision

        $this->db->where('id_participante', $data['id_participante']);

        $data1 = array(
            'nombres'             => $data['nombres'],
            'apellidos'           => $data['apellidos'],
            'telefono'            => $data['telefono'],
            'correo'              => $data['correo'],
            'edad'                => $data['edad'],
            'direccion'           => $data['direccion'],



        );
        $update = $this->db->update('diplomado.participantes', $data1);
        return true;
    }
    function check_miemb_inf_exp5($id_participante)
    {

        $this->db->select('g.id_participante, g.grado_instruccion, g.titulo_obtenido, c2.desc_academico');
        $this->db->join('comisiones.academico c2', 'c2.id_academico = g.grado_instruccion');
        // $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
        // $this->db->join('comisiones.status_comision st','st.id_status = pi2.id_status');

        $this->db->where('g.id_participante', $id_participante);
        $this->db->from('diplomado.curriculum_participante g');
        $query = $this->db->get();
        return $query->result_array();
    }

    ////////////////////reporte
    public function consultar_participantes_con_filtros($id_diplomado = null, $id_estatus = null)
    {
        $this->db->select('i.id_inscripcion, i.id_participante, i.id_diplomado, i.codigo_planilla, i.fecha_inscripcion,
                            i.fecha_limite_pago, i.estatus,
                            i.id_pago, i.observaciones, d.name_d, d.id_modalidad , d.fdesde,  d.fhasta, p.cedula, p.nombres, p.apellidos,
                            p.telefono, p.correo, p.edad,  p.direccion, p.trabaja_actualmente, p.observacion,
                            e.rif, e.razon_social, e.telefono, e.direccion_fiscal, t.nombre as des_estatus');
        $this->db->from('diplomado.inscripciones i');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado');
        $this->db->join('diplomado.participantes p', 'p.id_participante = i.id_participante');
        $this->db->join('diplomado.empresas e ', 'e.id_empresa = p.id_empresa', 'left');
        $this->db->join('diplomado.estatus_inscripcion t ', 't.id_estatus = i.estatus');

        // Aplicar filtros dinámicamente
        if (!empty($id_diplomado)) {
            $this->db->where('i.id_diplomado', $id_diplomado);
        }
        if (!empty($id_estatus)) {
            $this->db->where('i.estatus', $id_estatus);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_diplomados()
    {
        $this->db->select('id_diplomado, name_d');
        $this->db->where('estatus', 1);

        $this->db->from('diplomado.diplomado');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_estatus_inscripcion()
    {
        $this->db->select('id_estatus, nombre');
        $this->db->from('diplomado.estatus_inscripcion');
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    ////////////reporte pago
    public function obtenerPagosPorFecha($fechad, $fechah)
    {
        $this->db->select('
            p.id_pago,
            p.id_inscripcion,
            i.codigo_planilla,  
            d.name_d, 
            p.monto,
            p.fecha_pago,
            p.referencia,
            b.des_banco AS nombre_banco, 
            tp.nombre AS forma_pago_nombre,  
            p.estatus,
            p.observaciones,
            p.tipo_pago,
            p.id_banco
        ');
        $this->db->from('diplomado.pagos p');
        $this->db->join('diplomado.inscripciones i', 'p.id_inscripcion = i.id_inscripcion', 'left');
        $this->db->join('diplomado.diplomado d', 'i.id_diplomado = d.id_diplomado', 'left');
        // Nuevo JOIN para tipo_pago
        $this->db->join('diplomado.tipo_pago tp', 'p.tipo_pago = tp.id_stat_p', 'left');
        // Nuevo JOIN para bancos (usando p.banco = rnc.bancos.cod_banc como condición)
        $this->db->join('rnc.bancos b', 'p.banco = b.cod_banc', 'left');

        $this->db->where('p.fecha_pago >=', $fechad);
        $this->db->where('p.fecha_pago <=', $fechah);
        $this->db->order_by('p.fecha_pago', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }


    ///consulta movimiento banco de venezuela api
    public function obtenerMovimientosBDV($cuenta, $fechaIni, $fechaFin)
    {
        $url = 'https://bdvconciliacion.banvenez.com/apis/bdv/consulta/movimientos/';

        $token = $this->config->item('banvenez_api_key');

        if (empty($token)) {
            log_message('error', 'BDV API Key no configurada o vacía.');
            throw new Exception('Token de API BDV no configurado o vacío.');
        }

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'X-API-KEY: ' . $token // <--- ¡AQUÍ EL CAMBIO CLAVE!
            // Elimina 'Authorization: Bearer ' . $token
        ];

        $post_data = json_encode([
            "cuenta" => $cuenta,
            "fechaIni" => $fechaIni, // DD/MM/YYYY
            "fechaFin" => $fechaFin, // DD/MM/YYYY
            "tipoMoneda" => "VES",
            "nroMovimiento" => ""
        ]);

        // Iniciar cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Recordatorio: Cambiar a true en producción
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Añadir para seguir redirecciones, si las hay.

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            log_message('error', 'Error cURL al consultar BDV API: ' . $curl_error);
            throw new Exception('Error de conexión con la API de BDV: ' . $curl_error);
        }

        $decoded_response = json_decode($response, true);

        // Si la respuesta no es JSON válido o el http_code no es 200, puede haber problemas.
        // Si la API devuelve un JSON válido pero con un código de error interno (ej. 'code' != '1000'),
        // eso se manejará en el controlador.
        if ($http_code != 200) {
            // Intenta extraer el mensaje de error del JSON si está presente
            $errorMessage = $decoded_response['message'] ?? 'Error desconocido de la API BDV.';
            log_message('error', 'BDV API responded with HTTP ' . $http_code . ': ' . $errorMessage . ' | Raw Response: ' . $response);
            // Si el 401 aún persiste, este mensaje te ayudará a confirmarlo.
            throw new Exception('Error de la API BDV (HTTP ' . $http_code . '): ' . $errorMessage);
        }

        return $decoded_response;
    }

    ////notificaciones 
    public function get_pending_payments_all()
    {
        log_message('debug', 'Ejecutando get_pending_payments_all...');
        $pending_payments = [];

        // --- 1. Pagos pendientes de inscripciones naturales (estatus 2) ---
        $this->db->select('i.codigo_planilla, i.fecha_inscripcion, d.pronto_pago, d.pay, i.estatus, "Natural" AS tipo_inscripcion');
        $this->db->from('diplomado.inscripciones i');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado');
        $this->db->where('i.estatus', 2); // Estatus 2: planillas con deuda
        $query_natural = $this->db->get();
        log_message('debug', 'Resultados de consulta natural: ' . count($query_natural->result_array()));
        $pending_payments = array_merge($pending_payments, $query_natural->result_array());

        // --- 2. Pagos pendientes de inscripciones grupales (estatus 2) ---
        $this->db->select('ig.codigo_planilla, ig.fecha_inscripcion, d.pronto_pago, d.pay, ig.estatus, "Jurídica" AS tipo_inscripcion');
        $this->db->from('diplomado.inscripciones_grupales ig');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = ig.id_diplomado');
        $this->db->where('ig.estatus', 2); // Estatus 2: planillas con deuda
        $query_juridica = $this->db->get();
        $pending_payments = array_merge($pending_payments, $query_juridica->result_array());

        // --- 3. Pagos de crédito incompletos (1 cuota pagada) para ambos tipos de inscripciones ---
        // Consulta para inscripciones naturales
        $this->db->select('i.codigo_planilla, i.fecha_inscripcion, d.pronto_pago, d.pay, 2 AS estatus, "Natural" AS tipo_inscripcion');
        $this->db->from('diplomado.pagos p');
        $this->db->join('diplomado.inscripciones i', 'i.id_inscripcion = p.id_inscripcion', 'inner');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = i.id_diplomado', 'inner');
        $this->db->where('p.tipo_pago', 2);
        $this->db->group_by('i.codigo_planilla, i.fecha_inscripcion, d.pronto_pago, d.pay, i.estatus');
        $this->db->having('COUNT(p.id_pago) = 1');
        $query_credit_natural = $this->db->get();
        $pending_payments = array_merge($pending_payments, $query_credit_natural->result_array());

        // Consulta para inscripciones jurídicas
        $this->db->select('ig.codigo_planilla, ig.fecha_inscripcion, d.pronto_pago, d.pay, 2 AS estatus, "Jurídica" AS tipo_inscripcion');
        $this->db->from('diplomado.pagos p');
        $this->db->join('diplomado.inscripciones_grupales ig', 'ig.id_inscripcion_grupal = p.id_inscripcion', 'inner');
        $this->db->join('diplomado.diplomado d', 'd.id_diplomado = ig.id_diplomado', 'inner');
        $this->db->where('p.tipo_pago', 2);
        $this->db->group_by('ig.codigo_planilla, ig.fecha_inscripcion, d.pronto_pago, d.pay, ig.estatus');
        $this->db->having('COUNT(p.id_pago) = 1');
        $query_credit_juridica = $this->db->get();
        $pending_payments = array_merge($pending_payments, $query_credit_juridica->result_array());

        return $pending_payments;
    }
}
