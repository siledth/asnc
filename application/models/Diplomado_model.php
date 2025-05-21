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
    }

    function consultar_dip()
    {
        $this->db->select('*');
        $this->db->from('diplomado.diplomado');

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
        // $this->db->join('comisiones.academico a ', 'a.id_academico = p.grado_instruccion');
        $this->db->join('diplomado.empresas e ', 'e.id_empresa = p.id_empresa');
        $this->db->join('diplomado.estatus_inscripcion t ', 't.id_estatus = i.estatus');

        $this->db->where('i.estatus >', 1);
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
        $query = $this->db->get();
        return $query->result_array();
    }
    public function planilla_pay($data)
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

        $query = $this->db->get('diplomado.ver_cod_pay');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            log_message('debug', 'No se encontró la planilla: ' . $rif_b);
            return null;
        }
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
            'telefono' => $telefono,
            'direccion_fiscal' => $direccion
        );

        $this->db->insert('diplomado.empresas', $empresa);
        return $this->db->insert_id();
    }

    public function registrar_participante($data, $id_empresa)
    {
        $participante = array(
            'id_diplomado' => $this->security->xss_clean($data['id_diplomado']),
            'id_tipo' => 1, // Persona natural
            'id_empresa' => $id_empresa,
            'cedula' => $this->security->xss_clean($data['cedula_f']),
            'nombres' => $this->security->xss_clean($data['name_f']),
            'apellidos' => $this->security->xss_clean($data['apellido_f']),
            'telefono' => $this->security->xss_clean($data['telefono_f']),
            'correo' => filter_var($data['correo'], FILTER_SANITIZE_EMAIL),
            'edad' => $this->security->xss_clean($data['edad']),
            // 'grado_instruccion' => $this->security->xss_clean($data['id_clasificacion']),
            // 'titulo_obtenido' => $this->security->xss_clean($data['tutulo']),
            'direccion' => $this->security->xss_clean($data['direccion_fiscal_']),
            'trabaja_actualmente' => ($data['trabajo'] == '1') ? 1 : 0,
            'observacion' => $this->security->xss_clean($data['obser'])
        );

        $this->db->insert('diplomado.participantes', $participante);
        return $this->db->insert_id();
    }
    public function registrar_curriculum($data)
    {
        $this->db->insert('diplomado.curriculum_participante', $data);
        return $this->db->insert_id();
    }

    public function registrar_capacitacion($data)
    {
        return $this->db->insert('diplomado.capacitaciones_participante', $data);
    }
    public function registrar_inscripcion($id_participante, $id_diplomado)
    {
        // Generar código de planilla (ej: DIP-2023-001)
        $codigo = 'DIP-' . date('Y') . '-' . str_pad($this->db->count_all('diplomado.inscripciones') + 1, 3, '0', STR_PAD_LEFT);

        $inscripcion = array(
            'id_participante' => $id_participante,
            'id_diplomado' => $id_diplomado,
            'codigo_planilla' => $codigo,
            'estatus' => 1, // Pendiente
            'id_pago' => 1  // Pendiente
        );

        return $this->db->insert('diplomado.inscripciones', $inscripcion);
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
       e.razon_social, e.telefono, e.direccion_fiscal, c.id_curriculum, c.t_contrata_p
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
        SELECT nombre_curso, institucion_formadora, anio_realizacion 
        FROM diplomado.capacitaciones_participante 
        WHERE id_curriculum = ?
        ORDER BY id_capacitacion
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
                'tipo_pago' => $data['tipo_pago'] // Aquí se incluye el tipo_pago correctamente
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
}
