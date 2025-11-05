<?php
class Programacion_model extends CI_model
{

    // PROGRAMACION
    public function consultar_programaciones($unidad)
    {
        $this->db->select('id_programacion, unidad, anio,estatus');
        $this->db->where('unidad', $unidad);
        $query = $this->db->get('programacion.programacion');
        return $query->result_array();
    }

    //----Registrar año de programación--
    public function agg_programacion_anio($data)
    {
        $data['fecha'] = date('Y-m-d H:i:s'); // Registrar la fecha y hora exacta
        $data['estatus'] = 0; // En creación
        // $data['modificado'] = $data['id_usuario']; // El que la crea es el primero en "modificarla"
        $data['fecha_modifi'] = date('Y-m-d H:i:s');
        // $data['id_version_anterior'] = NULL; // Es la primera versión
        // $data['num_reprogramacion'] = 0; // Es la versión original

        $quers = $this->db->insert('programacion.programacion', $data);
        if ($quers) {
            return 1; // O el ID insertado si lo necesitas de vuelta para el JS
        } else {
            return 0;
        }
    }

    // public function consultar_prog_anio($id_programacion, $unidad)
    // {
    //     $this->db->select('*');
    //     $this->db->where('unidad', $unidad);
    //     $this->db->where('id_programacion', $id_programacion);
    //     $query = $this->db->get('programacion.programacion');
    //     return $query->row_array();
    // }
    //crear proyectos y acciones centralizadas
    function nuevo_registro_acc_py($acc, $proy)
    {
        $this->db->select('max(e.id_p_proyecto) as id1');
        $query1 = $this->db->get('programacion.p_proyecto e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        if ($acc['acc_cargar'] == '1') { // Proyecto
            $data1 = array(
                'id_p_proyecto'   => $id1,
                'id_programacion' => $proy['id_programacion'],
                'nombre_proyecto' => $proy['nombre_proyecto'],
                'id_obj_comercial' => $proy['id_obj_comercial'],
                'estatus'         => 1,
                'fecha'           => date('Y-m-d H:i:s'),
                'id_original'     => $id1,   // 👈 importante
                'version'         => 1,      // primera versión
                'vigente'         => true,
                'fecha_version'   => date('Y-m-d H:i:s'),
                'usuario_version' => $proy['id_usuario']
            );
            $query = $this->db->insert('programacion.p_proyecto', $data1);
        } elseif ($acc['acc_cargar'] == '2') { // Acción centralizada
            $this->db->select('max(e.id_p_acc_centralizada) as id2');
            $query2 = $this->db->get('programacion.p_acc_centralizada e');
            $response5 = $query2->row_array();
            $id2 = $response5['id2'] + 1;

            $data2 = array(
                'id_p_acc_centralizada' => $id2,
                'id_programacion'       => $acc['id_programacion'],
                'id_accion_centralizada' => $acc['id_p_acc_centralizada'],
                'id_obj_comercial'      => $acc['id_obj_comercial'],
                'estatus'               => 1,
                'fecha'                 => date('Y-m-d H:i:s'),
                'id_original'           => $id2,   // 👈 importante
                'version'               => 1,      // primera versión
                'vigente'               => true,
                'fecha_version'         => date('Y-m-d H:i:s'),
                'usuario_version'       => $acc['id_usuario']
            );
            $query = $this->db->insert('programacion.p_acc_centralizada', $data2);
        }
        return true;
    }
    function nuevo_registro_acc_pyv2($acc, $proy)
    {
        // Si es PROYECTO
        if ($acc['acc_cargar'] == '1') {
            $this->db->select('MAX(id_p_proyecto) as id1');
            $id1 = $this->db->get('programacion.p_proyecto')->row()->id1 + 1;

            $data1 = array(
                'id_p_proyecto'   => $id1,
                'id_programacion' => $proy['id_programacion'],
                'nombre_proyecto' => $proy['nombre_proyecto'],
                'id_obj_comercial' => $proy['id_obj_comercial'],
                'estatus'         => 1,
                'fecha'           => date('Y-m-d H:i:s'),
                'id_original'     => $id1,   // opcional: podrías mantenerlo igual al id
                'version'         => 2,      // 👈 SIEMPRE versión 2
                'vigente'         => true,
                'fecha_version'   => date('Y-m-d H:i:s'),
                'usuario_version' => $proy['id_usuario']
            );
            $this->db->insert('programacion.p_proyecto', $data1);
        }

        // Si es ACCIÓN CENTRALIZADA
        elseif ($acc['acc_cargar'] == '2') {
            $this->db->select('MAX(id_p_acc_centralizada) as id2');
            $id2 = $this->db->get('programacion.p_acc_centralizada')->row()->id2 + 1;

            $data2 = array(
                'id_p_acc_centralizada' => $id2,
                'id_programacion'       => $acc['id_programacion'],
                'id_accion_centralizada' => $acc['id_p_acc_centralizada'],
                'id_obj_comercial'      => $acc['id_obj_comercial'],
                'estatus'               => 1,
                'fecha'                 => date('Y-m-d H:i:s'),
                'id_original'           => $id2,   // igual al ID para mantener relación
                'version'               => 2,      // 👈 SIEMPRE versión 2
                'vigente'               => true,
                'fecha_version'         => date('Y-m-d H:i:s'),
                'usuario_version'       => $acc['id_usuario']
            );
            $this->db->insert('programacion.p_acc_centralizada', $data2);
        }

        return true;
    }


    //Consulta los proyectos por separado de cada programación
    public function consultar_proyectos($id_programacion)
    {
        $this->db->select('pp.id_p_proyecto,
                               pp.nombre_proyecto,
                        	   pp.id_programacion,
                        	   pp.id_obj_comercial,
                               p.estatus,
                        	   oc.desc_objeto_contrata');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
        $this->db->join('programacion.programacion p', 'p.id_programacion = pp.id_programacion');
        $this->db->where('pp.id_programacion', $id_programacion);
        $this->db->where('pp.vigente', 'true');

        $query = $this->db->get('programacion.p_proyecto pp');
        return $query->result_array();
    }

    public function consultar_proyectos_compl($id_programacion, $id_unidad)
    {
        $this->db->select('pp.id_p_proyecto,
	                           pp.nombre_proyecto,
	                           oc.desc_objeto_contrata ');
        $this->db->join('programacion.p_proyecto pp', 'pp.id_programacion = p.id_programacion');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
        $this->db->where('p.id_programacion', $id_programacion);
        $query = $this->db->get('programacion..programacion p');
        return $query->result_array();
    }

    public function llenar_ff($proyectos)
    {
        foreach ($proyectos as $key) {
            $this->db->select('*');
            $this->db->where('id_enlace', $key['id_p_proyecto']);
            $this->db->from('programacion.p_items');
            $result = $this->db->get();
        }
        return $result->result_array();
    }
    //------------------------------------------------------
    // CONSULTAS GENERALES
    public function consulta_part_pres()
    {
        $this->db->select('*');
        $query = $this->db->get('programacion.partida_presupuestaria');
        return $result = $query->result_array();
    }

    public function consulta_fuente()
    {
        $this->db->select('*');
        $this->db->order_by('id_fuente_financiamiento ASC');
        $query = $this->db->get('programacion.fuente_financiamiento');
        return $result = $query->result_array();
    }

    public function consulta_act_com()
    {
        $this->db->select('*');
        $this->db->where('id_objeto_contrata !=', 1);
        $query = $this->db->get('programacion.objeto_contrata');
        return $result = $query->result_array();
    }

    public function consulta_cnnu()
    {
        $this->db->select('*');
        // $this->db->limit(10);
        $query = $this->db->get('programacion.ccnu');
        return $result = $query->result_array();
    }

    public function consulta_unid()
    {
        $this->db->select('*');
        $query = $this->db->get('programacion.unidad_medida');
        return $result = $query->result_array();
    }

    public function consulta_iva()
    {
        $this->db->select('*');
        $query = $this->db->get('programacion.alicuota_iva');
        return $result = $query->result_array();
    }

    public function consulta_tip_obra()
    {
        $this->db->select('id_tip_obra, descripcion_tip_obr');
        $query = $this->db->get('programacion.tip_obra');
        return $result = $query->result_array();
    }

    public function consulta_alcance_obra()
    {
        $this->db->select('*');
        $query = $this->db->get('programacion.alcance_obra');
        return $result = $query->result_array();
    }

    public function consulta_obj_obra()
    {
        $this->db->select('id_obj_obra, descripcion_obj_obra');
        $query = $this->db->get('programacion.obj_obra');
        return $result = $query->result_array();
    }
    //------------------------------------------------------
    // REGISTRAR SERVICIO
    public function save_servicio($acc_cargar, $p_proyecto, $p_acc_centralizada, $p_items, $p_ffinanciamiento)
    {
        if ($acc_cargar == '1') {

            $this->db->select('max(e.id_p_items) as id1');
            $query1 = $this->db->get('programacion.p_items e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1;

            $quers = $this->db->insert('programacion.p_proyecto', $p_proyecto);
            if ($quers) {
                $id = $this->db->insert_id();
                $cant_proy = $p_items['id_ccnu'];
                $count_prog = count($cant_proy);
                for ($i = 0; $i < $count_prog; $i++) {
                    $data1 = array(
                        'id_p_items'                  => $id1,
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 0, //proyecto
                        'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                        'id_ccnu'                    => $p_items['id_ccnu'][$i],
                        'id_tip_obra'                => $p_items['id_tip_obra'],
                        'id_alcance_obra'            => $p_items['id_alcance_obra'],
                        'id_obj_obra'                => $p_items['id_obj_obra'],
                        'fecha_desde'                => $p_items['fecha_desde'][$i],
                        'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                        'especificacion'             => $p_items['especificacion'][$i],
                        'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                        'cantidad'                   => 0,
                        'i'                          => $p_items['i'][$i],
                        'ii'                         => $p_items['ii'][$i],
                        'iii'                        => $p_items['iii'][$i],
                        'iv'                         => $p_items['iv'][$i],
                        'costo_unitario'             => 0,
                        'cant_total_distribuir'      => 0,
                        'precio_total'               => $p_items['precio_total'][$i],
                        'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                        'iva_estimado'               => $p_items['iva_estimado'][$i],
                        'monto_estimado'             => $p_items['monto_estimado'][$i],
                        'iva_estimado'               => $p_items['iva_estimado'][$i],
                        'monto_estimado'             => $p_items['monto_estimado'][$i],
                        'est_trim_1'          => $p_items['est_trim_1'][$i],
                        'est_trim_2'          => $p_items['est_trim_2'][$i],
                        'est_trim_3'         => $p_items['est_trim_3'][$i],
                        'est_trim_4'          => $p_items['est_trim_4'][$i],
                        'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                        'estatus_rendi' => $p_items['estatus_rendi'],

                    );
                    $this->db->insert('programacion.p_items', $data1);
                }
                $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                $count_pff = count($cant_pff);

                for ($i = 0; $i < $count_pff; $i++) {

                    $data2 = array(
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 0, //proyecto
                        'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                        'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                        'descripcion_ff'             => $p_ffinanciamiento['descripcion_ff'][$i],
                        'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        'id_p_items'                  => $id1,
                    );
                    $this->db->insert('programacion.p_ffinanciamiento', $data2);
                }
            }
            return true;
        } elseif ($acc_cargar == '2') {
            $this->db->select('max(e.id_p_items) as id1');
            $query1 = $this->db->get('programacion.p_items e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1;
            $quers = $this->db->insert('programacion.p_acc_centralizada', $p_acc_centralizada);
            if ($quers) {
                $id = $this->db->insert_id();
                $cant_proy = $p_items['id_ccnu'];
                $count_prog = count($cant_proy);
                for ($i = 0; $i < $count_prog; $i++) {
                    $data1 = array(
                        'id_p_items'                  => $id1,
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 1, //accion centralizada
                        'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                        'id_ccnu'                    => $p_items['id_ccnu'][$i],
                        'id_tip_obra'                => $p_items['id_tip_obra'],
                        'id_alcance_obra'            => $p_items['id_alcance_obra'],
                        'id_obj_obra'                => $p_items['id_obj_obra'],
                        'fecha_desde'                => $p_items['fecha_desde'][$i],
                        'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                        'especificacion'             => $p_items['especificacion'][$i],
                        'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                        'cantidad'                   => 0,
                        'i'                          => $p_items['i'][$i],
                        'ii'                         => $p_items['ii'][$i],
                        'iii'                        => $p_items['iii'][$i],
                        'iv'                         => $p_items['iv'][$i],
                        'cant_total_distribuir'      => 0,
                        'costo_unitario'             => 0,
                        'precio_total'               => $p_items['precio_total'][$i],
                        'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                        'iva_estimado'               => $p_items['iva_estimado'][$i],
                        'monto_estimado'             => $p_items['monto_estimado'][$i],
                        'est_trim_1'          => $p_items['est_trim_1'][$i],
                        'est_trim_2'          => $p_items['est_trim_2'][$i],
                        'est_trim_3'         => $p_items['est_trim_3'][$i],
                        'est_trim_4'          => $p_items['est_trim_4'][$i],
                        'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                        'estatus_rendi' => $p_items['estatus_rendi'],
                    );
                    $this->db->insert('programacion.p_items', $data1);
                }

                $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                $count_pff = count($cant_pff);

                for ($i = 0; $i < $count_pff; $i++) {

                    $data2 = array(
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 1, //acc
                        'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                        'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                        'descripcion_ff'             => $p_ffinanciamiento['descripcion_ff'][$i],
                        'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        'id_p_items'                  => $id1,
                    );
                    $this->db->insert('programacion.p_ffinanciamiento', $data2);
                }
            }
            return true;
        }
    }
    //------------------------------------------------------
    //REGISTRAR BIENES
    public function save_bienes($acc_cargar, $p_proyecto, $p_acc_centralizada, $p_items, $p_ffinanciamiento)
    {
        if ($acc_cargar == '1') {
            $this->db->select('max(e.id_p_items) as id1');
            $query1 = $this->db->get('programacion.p_items e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1;
            $quers = $this->db->insert('programacion.p_proyecto', $p_proyecto);
            if ($quers) {
                $id = $this->db->insert_id();
                $cant_proy = $p_items['id_ccnu'];
                $count_prog = count($cant_proy);
                for ($i = 0; $i < $count_prog; $i++) {
                    $data1 = array(
                        'id_p_items'                  => $id1,
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 0, //proyecto
                        'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                        'id_ccnu'                    => $p_items['id_ccnu'][$i],
                        'id_tip_obra'                => $p_items['id_tip_obra'],
                        'id_alcance_obra'            => $p_items['id_alcance_obra'],
                        'id_obj_obra'                => $p_items['id_obj_obra'],
                        'fecha_desde'                => $p_items['fecha_desde'],
                        'fecha_hasta'                => $p_items['fecha_hasta'],
                        'especificacion'             => $p_items['especificacion'][$i],
                        'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                        'cantidad'                   => $p_items['cantidad'][$i],
                        'i'                          => $p_items['i'][$i],
                        'ii'                         => $p_items['ii'][$i],
                        'iii'                        => $p_items['iii'][$i],
                        'iv'                         => $p_items['iv'][$i],
                        'cant_total_distribuir'      => $p_items['cant_total_distribuir'][$i],
                        'costo_unitario'             => $p_items['costo_unitario'][$i],
                        'precio_total'               => $p_items['precio_total'][$i],
                        'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                        'iva_estimado'               => $p_items['iva_estimado'][$i],
                        'monto_estimado'             => $p_items['monto_estimado'][$i],
                        'est_trim_1'          => $p_items['est_trim_1'][$i],
                        'est_trim_2'          => $p_items['est_trim_2'][$i],
                        'est_trim_3'         => $p_items['est_trim_3'][$i],
                        'est_trim_4'          => $p_items['est_trim_4'][$i],
                        'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                        'estatus_rendi' => $p_items['estatus_rendi'],
                    );
                    $this->db->insert('programacion.p_items', $data1);
                }

                $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                $count_pff = count($cant_pff);

                for ($i = 0; $i < $count_pff; $i++) {
                    $data2 = array(
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 0, //proyecto
                        'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                        'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                        'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        'id_p_items'                  => $id1,

                    );
                    $this->db->insert('programacion.p_ffinanciamiento', $data2);
                }
            }
            return true;
        } elseif ($acc_cargar == '2') {
            $this->db->select('max(e.id_p_items) as id1');
            $query1 = $this->db->get('programacion.p_items e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1;
            $quers = $this->db->insert('programacion.p_acc_centralizada', $p_acc_centralizada);
            if ($quers) {
                $id = $this->db->insert_id();
                $cant_proy = $p_items['id_ccnu'];
                $count_prog = count($cant_proy);
                for ($i = 0; $i < $count_prog; $i++) {
                    $data1 = array(
                        'id_p_items'                  => $id1,
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 1, //acc
                        'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                        'id_ccnu'                    => $p_items['id_ccnu'][$i],
                        'id_tip_obra'                => $p_items['id_tip_obra'],
                        'id_alcance_obra'            => $p_items['id_alcance_obra'],
                        'id_obj_obra'                => $p_items['id_obj_obra'],
                        'fecha_desde'                => $p_items['fecha_desde'],
                        'fecha_hasta'                => $p_items['fecha_hasta'],
                        'especificacion'             => $p_items['especificacion'][$i],
                        'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                        'cantidad'                   => $p_items['cantidad'][$i],
                        'i'                          => $p_items['i'][$i],
                        'ii'                         => $p_items['ii'][$i],
                        'iii'                        => $p_items['iii'][$i],
                        'iv'                         => $p_items['iv'][$i],
                        'cant_total_distribuir'      => $p_items['cant_total_distribuir'][$i],
                        'costo_unitario'             => $p_items['costo_unitario'][$i],
                        'precio_total'               => $p_items['precio_total'][$i],
                        'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                        'iva_estimado'               => $p_items['iva_estimado'][$i],
                        'monto_estimado'             => $p_items['monto_estimado'][$i],
                        'est_trim_1'          => $p_items['est_trim_1'][$i],
                        'est_trim_2'          => $p_items['est_trim_2'][$i],
                        'est_trim_3'         => $p_items['est_trim_3'][$i],
                        'est_trim_4'          => $p_items['est_trim_4'][$i],
                        'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                        'estatus_rendi' => $p_items['estatus_rendi'],
                    );
                    $this->db->insert('programacion.p_items', $data1);
                }

                $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                $count_pff = count($cant_pff);

                for ($i = 0; $i < $count_pff; $i++) {

                    $data2 = array(
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 1, //acc
                        'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                        'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                        'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        'id_p_items'                  => $id1,
                    );
                    $this->db->insert('programacion.p_ffinanciamiento', $data2);
                }
            }
            return true;
        }
    }
    //------------------------------------------------------
    //REGISTRAR OBRAS
    public function save_obra($acc_cargar, $p_proyecto, $p_acc_centralizada, $p_items, $p_ffinanciamiento)
    {

        if ($acc_cargar == '1') {
            $this->db->select('max(e.id_p_items) as id1');
            $query1 = $this->db->get('programacion.p_items e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1;

            $quers = $this->db->insert('programacion.p_proyecto', $p_proyecto);
            if ($quers) {
                $id = $this->db->insert_id();
                $cant_proy = $p_items['id_par_presupuestaria'];
                $count_prog = count($cant_proy);
                for ($i = 0; $i < $count_prog; $i++) {
                    $data1 = array(
                        'id_p_items'                  => $id1,
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 0, //proyecto
                        'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                        'id_ccnu'                    => 0,
                        'id_tip_obra'                => $p_items['id_tip_obra'][$i],
                        'id_alcance_obra'            => $p_items['id_alcance_obra'][$i],
                        'id_obj_obra'                => $p_items['id_obj_obra'][$i],
                        'fecha_desde'                => $p_items['fecha_desde'][$i],
                        'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                        'especificacion'             => $p_items['especificacion'][$i],
                        'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                        'cantidad'                   => 0,
                        'i'                          => $p_items['i'][$i],
                        'ii'                         => $p_items['ii'][$i],
                        'iii'                        => $p_items['iii'][$i],
                        'iv'                         => $p_items['iv'][$i],
                        'costo_unitario'             => 0,
                        'cant_total_distribuir'      => 0,
                        'precio_total'               => $p_items['precio_total'][$i],
                        'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                        'iva_estimado'               => $p_items['iva_estimado'][$i],
                        'monto_estimado'             => $p_items['monto_estimado'][$i],
                        'iva_estimado'               => $p_items['iva_estimado'][$i],
                        'monto_estimado'             => $p_items['monto_estimado'][$i],
                        'est_trim_1'          => $p_items['est_trim_1'][$i],
                        'est_trim_2'          => $p_items['est_trim_2'][$i],
                        'est_trim_3'         => $p_items['est_trim_3'][$i],
                        'est_trim_4'          => $p_items['est_trim_4'][$i],
                        'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                        'estatus_rendi' => $p_items['estatus_rendi'],
                    );
                    $this->db->insert('programacion.p_items', $data1);
                }
                $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                $count_pff = count($cant_pff);

                for ($i = 0; $i < $count_pff; $i++) {

                    $data2 = array(
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 0, //proyecto
                        'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                        'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                        'descripcion_ff'             => $p_ffinanciamiento['descripcion_ff'][$i],
                        'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        'id_p_items'                  => $id1,

                    );

                    $this->db->insert('programacion.p_ffinanciamiento', $data2);
                }
            }
            return true;
        } elseif ($acc_cargar == '2') {
            $this->db->select('max(e.id_p_items) as id1');
            $query1 = $this->db->get('programacion.p_items e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1;
            $quers = $this->db->insert('programacion.p_acc_centralizada', $p_acc_centralizada);
            if ($quers) {
                $id = $this->db->insert_id();
                $cant_proy = $p_items['id_par_presupuestaria'];
                $count_prog = count($cant_proy);
                for ($i = 0; $i < $count_prog; $i++) {
                    $data1 = array(
                        'id_p_items'                  => $id1,
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 1, //acc
                        'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                        'id_ccnu'                    => 0,
                        'id_tip_obra'                => $p_items['id_tip_obra'][$i],
                        'id_alcance_obra'            => $p_items['id_alcance_obra'][$i],
                        'id_obj_obra'                => $p_items['id_obj_obra'][$i],
                        'fecha_desde'                => $p_items['fecha_desde'][$i],
                        'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                        'especificacion'             => $p_items['especificacion'][$i],
                        'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                        'cantidad'                   => 0,
                        'i'                          => $p_items['i'][$i],
                        'ii'                         => $p_items['ii'][$i],
                        'iii'                        => $p_items['iii'][$i],
                        'iv'                         => $p_items['iv'][$i],
                        'cant_total_distribuir'      => 0,
                        'costo_unitario'             => 0,
                        'precio_total'               => $p_items['precio_total'][$i],
                        'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                        'iva_estimado'               => $p_items['iva_estimado'][$i],
                        'monto_estimado'             => $p_items['monto_estimado'][$i],
                        'est_trim_1'          => $p_items['est_trim_1'][$i],
                        'est_trim_2'          => $p_items['est_trim_2'][$i],
                        'est_trim_3'         => $p_items['est_trim_3'][$i],
                        'est_trim_4'          => $p_items['est_trim_4'][$i],
                        'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                        'estatus_rendi' => $p_items['estatus_rendi'],
                    );
                    $this->db->insert('programacion.p_items', $data1);
                }

                $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                $count_pff = count($cant_pff);

                for ($i = 0; $i < $count_pff; $i++) {
                    $data2 = array(
                        'id_enlace'                  => $id,
                        'id_p_acc'                   => 1, //acc
                        'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                        'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                        'descripcion_ff'             => $p_ffinanciamiento['descripcion_ff'][$i],
                        'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        'id_p_items'                  => $id1,

                    );
                    $this->db->insert('programacion.p_ffinanciamiento', $data2);
                }
            }
            return true;
        }
    }

    //------------------------------------------------------
    // INVESTIGAR
    public function inf_1($id_p_proyecto)
    {
        $this->db->select('pp.id_p_proyecto,
                               pp.nombre_proyecto,
                        	   pp.id_programacion,
                        	   pp.id_obj_comercial,
                        	   oc.desc_objeto_contrata');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
        $this->db->where('pp.id_p_proyecto', $id_p_proyecto);
        $query = $this->db->get('programacion.p_proyecto pp');
        return $query->result_array();
    }

    public function inf_2($id_p_proyecto)
    {
        $this->db->select('pf.id_enlace,
                        	   pf.id_partidad_presupuestaria,
                        	   pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	
                        	   pf.id_fuente_financiamiento,
                        	   ff.desc_fuente_financiamiento,
                               sum(pf.porcentaje) as porcentaje');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
        $this->db->join('programacion.fuente_financiamiento ff', 'ff.id_fuente_financiamiento = pf.id_fuente_financiamiento');
        $this->db->where('pf.id_enlace', $id_p_proyecto);
        $this->db->where('pf.id_p_acc', 0);
        $this->db->group_by('pf.id_enlace,
            pf.id_partidad_presupuestaria,
            pp.desc_partida_presupuestaria,
            pp.codigopartida_presupuestaria,
        
            pf.id_fuente_financiamiento,
            ff.desc_fuente_financiamiento');
        $query = $this->db->get('programacion.p_ffinanciamientototal pf');
        return $query->result_array();
    }
    // public function total_por_partidas($id_programacion)
    // {
    //     $this->db->select("pf.id_proyecto,
    //                              pf.id_partidad_presupuestaria,
    //                              pp.desc_partida_presupuestaria,
    //                              pp.codigopartida_presupuestaria,
    //                              SUM(COALESCE(to_number(NULLIF(pf.precio_total, ''), '999999999999D99'), 0)) as precio_total,
    //                              SUM(COALESCE(to_number(NULLIF(pf.monto_estimado, ''), '999999999999D99'), 0)) as monto_estimado,
    //                             ");
    //     $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
    //     $this->db->where('pf.id_proyecto', $id_programacion);
    //     //  $this->db->where('pf.id_p_acc', 0);
    //     $this->db->group_by('pf.id_proyecto,
    //                              pf.id_partidad_presupuestaria,
    //                              pp.desc_partida_presupuestaria,
    //                              pp.codigopartida_presupuestaria');
    //     $query = $this->db->get('programacion.p_items pf');
    //     return $query->result_array();
    // }
    public function total_por_partidas($id_programacion)
    {
        $this->db->select("pf.id_proyecto,
                             pf.id_partidad_presupuestaria,
                             pp.desc_partida_presupuestaria,
                             pp.codigopartida_presupuestaria,
                             SUM(CASE
                                     WHEN TRIM(pf.precio_total) = '' THEN 0
                                     WHEN LOWER(TRIM(pf.precio_total)) = 'nan' THEN 0
                                     ELSE to_number(pf.precio_total, '999999999999D99')
                                 END) as precio_total,
                             SUM(CASE
                                     WHEN TRIM(pf.monto_estimado) = '' THEN 0
                                     WHEN LOWER(TRIM(pf.monto_estimado)) = 'nan' THEN 0
                                     ELSE to_number(pf.monto_estimado, '999999999999D99')
                                 END) as monto_estimado
                           "); // Notice the removed trailing comma here, it caused an error in the previous code

        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
        $this->db->where('pf.id_proyecto', $id_programacion);
        $this->db->where('pf.vigente', 'true');

        $this->db->group_by('pf.id_proyecto,
                             pf.id_partidad_presupuestaria,
                             pp.desc_partida_presupuestaria,
                             pp.codigopartida_presupuestaria');
        $query = $this->db->get('programacion.p_items pf');
        return $query->result_array();
    }
    // public function total_por_partidas_primero($id_programacion)
    // {
    //     $this->db->select("pf.id_proyecto,
    //                     	   pf.codigopartida_presupuestaria,
    //                     	   pf.desc_partida_presupuestaria,
    //                            sum(to_number(pf.total_rendi,'999999999999D99')) as total_rendi,
    //                            sum(to_number(pf.subtotal_rend_ejecu,'999999999999D99')) as precio_rend_ejecu,
    //                           ");
    //     // $this->db->join('programacion.partida_presupuestaria pp','pp.codigopartida_presupuestaria = pf.codigopartida_presupuestaria');
    //     $this->db->where('pf.id_programacion', $id_programacion);
    //     //  $this->db->where('pf.id_p_acc', 0);
    //     $this->db->group_by('pf.id_proyecto,
    //         pf.codigopartida_presupuestaria,
    //         pf.desc_partida_presupuestaria');
    //     $query = $this->db->get('programacion.rendidicion pf');
    //     return $query->result_array();
    // }

    public function total_por_partidas_primero($id_programacion)
    {
        $this->db->select("pf.id_proyecto,
                            pf.codigopartida_presupuestaria,
                            pf.desc_partida_presupuestaria,
                            sum(CASE
                                    WHEN TRIM(pf.total_rendi) = '' THEN 0
                                    WHEN LOWER(TRIM(pf.total_rendi)) = 'nan' THEN 0
                                    ELSE to_number(pf.total_rendi, '999999999999D99')
                                END) as total_rendi,
                            sum(CASE
                                    WHEN TRIM(pf.subtotal_rend_ejecu) = '' THEN 0
                                    WHEN LOWER(TRIM(pf.subtotal_rend_ejecu)) = 'nan' THEN 0
                                    ELSE to_number(pf.subtotal_rend_ejecu, '999999999999D99')
                                END) as precio_rend_ejecu
                           ");
        $this->db->where('pf.id_programacion', $id_programacion);
        $this->db->group_by('pf.id_proyecto,
        pf.codigopartida_presupuestaria,
        pf.desc_partida_presupuestaria');
        $query = $this->db->get('programacion.rendidicion pf');
        return $query->result_array();
    }
    public function inf_2_edit($data)
    {
        $this->db->select('pf.id_enlace,
                        	   pf.id_partidad_presupuestaria,
                        	   pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pf.id_estado,
                        	   pf.id_fuente_financiamiento,
                        	   ff.desc_fuente_financiamiento,
                        	   pf.porcentaje ');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
        $this->db->join('programacion.fuente_financiamiento ff', 'ff.id_fuente_financiamiento = pf.id_fuente_financiamiento');
        $this->db->where('pf.id_enlace', $data['id_p_proyecto']);
        $this->db->where('pf.id_p_acc', 0);
        $query = $this->db->get('programacion.p_ffinanciamiento pf');
        return $query->result_array();
    }

    public function inf_3($id_p_proyecto)
    {
        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.id_tip_obra,
                               to2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               ao.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               oo.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu', 'left');
        $this->db->join('programacion.tip_obra to2', 'to2.id_tip_obra = pi2.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra ao', 'ao.id_alcance_obra = pi2.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra oo', 'oo.id_obj_obra = pi2.id_obj_obra', 'left');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $id_p_proyecto);
        $this->db->where('pi2.id_p_acc', 0);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    public function inf_3_edit($data)
    {
        $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                        	   pi2.fecha_desde,
                        	   pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $data['id_p_proyecto']);
        $this->db->where('pi2.id_p_acc', 0);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    public function inf_3_b($data)
    {
        $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                        	   pi2.fecha_desde,
                        	   pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.cant_total_distribuir,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $data['id_p_proyecto']);
        $this->db->where('pi2.id_p_acc', 0);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    public function inf_3_o($id_p_proyecto)
    {
        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_tip_obra,
                               to2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               ao.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               oo.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu', 'left');
        $this->db->join('programacion.tip_obra to2', 'to2.id_tip_obra = pi2.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra ao', 'ao.id_alcance_obra = pi2.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra oo', 'oo.id_obj_obra = pi2.id_obj_obra', 'left');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $id_p_proyecto['id_p_proyecto']);
        $this->db->where('pi2.id_p_acc', 0);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    public function editar_programacion_proy($id_p_proyecto, $id_programacion, $p_proyecto, $p_items, $p_ffinanciamiento)
    {

        $this->db->where('id_programacion', $id_programacion);
        $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('programacion.p_proyecto', $p_proyecto);

        if ($update) {
            $this->db->where('id_enlace', $id_p_proyecto);
            $this->db->where('id_p_acc', 0);
            $this->db->delete('programacion.p_items');

            $cant_proy = $p_items['id_ccnu'];
            $count_prog = count($cant_proy);
            for ($i = 0; $i < $count_prog; $i++) {
                $data1 = array(
                    'id_enlace'                  => $id_p_proyecto,
                    'id_p_acc'                   => 0,
                    'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                    'id_ccnu'                    => $p_items['id_ccnu'][$i],
                    'id_tip_obra'                => 0,
                    'id_alcance_obra'            => 0,
                    'id_obj_obra'                => 0,
                    'fecha_desde'                => $p_items['fecha_desde'][$i],
                    'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                    'especificacion'             => $p_items['especificacion'][$i],
                    'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                    'cantidad'                   => 0,
                    'i'                          => $p_items['i'][$i],
                    'ii'                         => $p_items['ii'][$i],
                    'iii'                        => $p_items['iii'][$i],
                    'iv'                         => $p_items['iv'][$i],
                    'cant_total_distribuir'      => 0,
                    'costo_unitario'             => 0,
                    'precio_total'               => $p_items['precio_total'][$i],
                    'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                    'iva_estimado'               => $p_items['iva_estimado'][$i],
                    'monto_estimado'               => $p_items['monto_estimado'][$i],
                );
                $this->db->insert('programacion.p_items', $data1);
            }

            $this->db->where('id_enlace', $id_p_proyecto);
            $this->db->where('id_p_acc', 0);
            $this->db->delete('programacion.p_ffinanciamiento');

            $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
            $count_pff = count($cant_pff);

            for ($i = 0; $i < $count_pff; $i++) {

                $data2 = array(
                    'id_enlace'                  => $id_p_proyecto,
                    'id_p_acc'                   => 0,
                    'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                    'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                    'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                    'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                );
                $this->db->insert('programacion.p_ffinanciamiento', $data2);
            }
        }
        return true;
    }

    public function editar_programacion_proy_b($id_p_proyecto, $id_programacion, $p_proyecto, $p_items, $p_ffinanciamiento)
    {
        $this->db->where('id_programacion', $id_programacion);
        $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('programacion.p_proyecto', $p_proyecto);

        if ($update) {
            $this->db->where('id_enlace', $id_p_proyecto);
            $this->db->where('id_p_acc', 0);
            $this->db->delete('programacion.p_items');
            $cant_proy = $p_items['id_ccnu'];
            $count_prog = count($cant_proy);
            for ($i = 0; $i < $count_prog; $i++) {
                $data1 = array(
                    'id_enlace'                  => $id_p_proyecto,
                    'id_p_acc'                   => 0,
                    'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                    'id_ccnu'                    => $p_items['id_ccnu'][$i],
                    'id_tip_obra'                => 0,
                    'id_alcance_obra'            => 0,
                    'id_obj_obra'                => 0,
                    'fecha_desde'                => $p_items['fecha_desde'],
                    'fecha_hasta'                => $p_items['fecha_hasta'],
                    'especificacion'             => $p_items['especificacion'][$i],
                    'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                    'cantidad'                   => $p_items['cantidad'][$i],
                    'i'                          => $p_items['i'][$i],
                    'ii'                         => $p_items['ii'][$i],
                    'iii'                        => $p_items['iii'][$i],
                    'iv'                         => $p_items['iv'][$i],
                    'cant_total_distribuir'      => $p_items['cant_total_distribuir'][$i],
                    'costo_unitario'             => $p_items['costo_unitario'][$i],
                    'precio_total'               => $p_items['precio_total'][$i],
                    'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                    'iva_estimado'               => $p_items['iva_estimado'][$i],
                    'monto_estimado'             => $p_items['monto_estimado'][$i],
                );
                $this->db->insert('programacion.p_items', $data1);
            }
            $this->db->where('id_enlace', $id_p_proyecto);
            $this->db->where('id_p_acc', 0);
            $this->db->delete('programacion.p_ffinanciamiento');
            $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
            $count_pff = count($cant_pff);

            for ($i = 0; $i < $count_pff; $i++) {

                $data2 = array(
                    'id_enlace'                  => $id_p_proyecto,
                    'id_p_acc'                   => 0,
                    'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                    'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                    'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                    'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                );
                $this->db->insert('programacion.p_ffinanciamiento', $data2);
            }
        }
        return true;
    }

    public function editar_programacion_proy_o($id_p_proyecto, $id_programacion, $p_proyecto, $p_items, $p_ffinanciamiento)
    {

        $this->db->where('id_programacion', $id_programacion);
        $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('programacion.p_proyecto', $p_proyecto);

        if ($update) {
            $this->db->where('id_enlace', $id_p_proyecto);
            $this->db->where('id_p_acc', 0);
            $this->db->delete('programacion.p_items');


            $cant_proy = $p_items['id_tip_obra'];
            $count_prog = count($cant_proy);
            for ($i = 0; $i < $count_prog; $i++) {
                $data_inf = array(
                    'id_enlace'                  => $id_p_proyecto,
                    'id_p_acc'                   => 0,
                    'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                    'id_ccnu'                    => 0,
                    'id_tip_obra'                => $p_items['id_tip_obra'][$i],
                    'id_alcance_obra'            => $p_items['id_alcance_obra'][$i],
                    'id_obj_obra'                => $p_items['id_obj_obra'][$i],
                    'fecha_desde'                => $p_items['fecha_desde'][$i],
                    'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                    'especificacion'             => $p_items['especificacion'][$i],
                    'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                    'cantidad'                   => 0,
                    'i'                          => $p_items['i'][$i],
                    'ii'                         => $p_items['ii'][$i],
                    'iii'                        => $p_items['iii'][$i],
                    'iv'                         => $p_items['iv'][$i],
                    'cant_total_distribuir'      => 0,
                    'costo_unitario'             => 0,
                    'precio_total'               => $p_items['precio_total'][$i],
                    'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                    'iva_estimado'               => $p_items['iva_estimado'][$i],
                    'monto_estimado'             => $p_items['monto_estimado'][$i],
                );
                $this->db->insert('programacion.p_items', $data_inf);
            }

            $this->db->where('id_enlace', $id_p_proyecto);
            $this->db->where('id_p_acc', 0);
            $this->db->delete('programacion.p_ffinanciamiento');

            $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
            $count_pff = count($cant_pff);

            for ($i = 0; $i < $count_pff; $i++) {

                $data2 = array(
                    'id_enlace'                  => $id_p_proyecto,
                    'id_p_acc'                   => 0,
                    'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                    'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                    'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                    'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                );
                $this->db->insert('programacion.p_ffinanciamiento', $data2);
            }
        }
        return true;
    }

    public function cons_items_proy($data)
    {
        $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                        	   pi2.fecha_desde,
                        	   pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.cant_total_distribuir,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_p_items', $data['id_items_proy']);
        $this->db->where('pi2.id_p_acc', 0);
        $query = $this->db->get('programacion.p_items pi2');

        return $query->row_array();
    }

    public function cons_items_proy_o($data)
    {
        $this->db->select('pi2.id_p_items,
								pi2.id_enlace,
								pi2.id_partidad_presupuestaria,
								pp.desc_partida_presupuestaria,
								pp.codigopartida_presupuestaria,
								pi2.id_tip_obra,
								to2.descripcion_tip_obr,
								pi2.id_alcance_obra,
								ao.descripcion_alcance_obra,
								pi2.id_obj_obra,
								oo.descripcion_obj_obra,
								pi2.fecha_desde,
								pi2.fecha_hasta,
								pi2.especificacion,
								pi2.id_unidad_medida,
								um.desc_unidad_medida,
								pi2.i,
								pi2.ii,
								pi2.iii,
								pi2.iv,
								pi2.precio_total,
								pi2.alicuota_iva,
								pi2.iva_estimado,
								pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu', 'left');
        $this->db->join('programacion.tip_obra to2', 'to2.id_tip_obra = pi2.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra ao', 'ao.id_alcance_obra = pi2.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra oo', 'oo.id_obj_obra = pi2.id_obj_obra', 'left');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_p_items', $data['id_items_proy']);
        $this->db->where('pi2.id_p_acc', 0);
        $query = $this->db->get('programacion.p_items pi2');

        return $query->row_array();
    }


    public function llenar_par_pre_mod($data)
    {
        $this->db->select('*');
        $this->db->where('codigopartida_presupuestaria !=', $data['cod_partida_pre']);
        $query = $this->db->get('programacion.partida_presupuestaria');
        return $query->result_array();
    }

    public function llenar_uni_med_mod($data)
    {
        $this->db->select('*');
        $this->db->where('pi2.id_unidad_medida !=', $data['id_unid_med']);
        $query = $this->db->get('programacion.unidad_medida pi2');
        return $query->result_array();
    }

    public function llenar_ff_($data)
    {
        $this->db->select('pi2.id_fuente_financiamiento, pi2.desc_fuente_financiamiento');
        // $this->db->where('pi2.id_fuente_financiamiento !=', $data['id_ff_b']);
        $query = $this->db->get('programacion.fuente_financiamiento pi2');
        return $query->result_array();
    }
    public function llenar_modalidad($data)
    {
        $this->db->select('*');
        // $this->db->where('pi2.id !=', $data['id']);
        $query = $this->db->get('evaluacion_desempenio.modalidad');
        return $query->result_array();
    }
    public function llenar_tipo_doc_contrata($data)
    {
        $this->db->select('id_tipo_doc_contrata,desc_tipo_doc_contrata');
        // $this->db->where('pi2.id !=', $data['id']);
        $query = $this->db->get('programacion.tipo_doc_contrata');
        return $query->result_array();
    }
    public function llenar_comp_resp_social($data)
    {
        $this->db->select('id_comp_resp_social,desc_comp_resp_social');
        // $this->db->where('pi2.id !=', $data['id']);
        $query = $this->db->get('programacion.comp_resp_social');
        return $query->result_array();
    }
    public function consultar_acc14($data)
    {
        $this->db->select('*');
        // $this->db->where('pi2.id !=', $data['id']);
        $query = $this->db->get('programacion.accion_centralizada');
        return $query->result_array();
    }
    public function consultar_obto($data)
    {
        $this->db->select('id_objeto_contrata, desc_objeto_contrata');
        $query = $this->db->get('programacion.objeto_contrata');
        return $query->result_array();
    }
    public function llenar_trimestre($data)
    {
        $this->db->select('id_trimestre, descripcion_trimestre');
        // $this->db->where('pi2.id !=', $data['id']);
        $query = $this->db->get('programacion.trimestre');
        return $query->result_array();
    }

    public function llenar_alic_iva_mod()
    {
        $this->db->select('*');
        $query = $this->db->get('programacion.alicuota_iva');
        return $query->result_array();
    }

    public function llenar_selc_ccnu_m($data)
    {
        $this->db->select('*');
        $this->db->like('desc_ccnu', $data['ccnu_b_m']);
        $query = $this->db->get('programacion.ccnu');
        return $query->result_array();
    }

    public function llenar_alic_tip_obra($data)
    {
        $this->db->select('*');
        $this->db->where('id_tip_obra !=', $data['id_tipo_obra_m']);
        $query = $this->db->get('programacion.tip_obra');
        return $result = $query->result_array();
    }

    public function llenar_alic_alc_obra($data)
    {
        $this->db->select('*');
        $this->db->where('id_alcance_obra !=', $data['alcance_obra_m']);
        $query = $this->db->get('programacion.alcance_obra');
        return $result = $query->result_array();
    }

    public function llenar_alic_obj_obra($data)
    {
        $this->db->select('*');
        $this->db->where('id_obj_obra !=', $data['objeto_obra_m']);
        $query = $this->db->get('programacion.obj_obra');
        return $result = $query->result_array();
    }

    public function editar_fila_ip($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        $pp_s = $data['selc_part_pres'];
        if ($pp_s == 0) {
            $id_partidad_presupuestaria = $data['partida_pre'];
        } else {
            $id_partidad_presupuestaria = $data['selc_part_pres'];
        }

        $ccnu_s = $data['sel_ccnu'];
        if ($ccnu_s == 0) {
            $id_ccnu = $data['ccnu'];
        } else {
            $id_ccnu = $data['sel_ccnu'];
        }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            'id_partidad_presupuestaria' => $id_partidad_presupuestaria,
            'id_ccnu'                    => $id_ccnu,
            'fecha_desde'                => $data['fecha_desde_e'],
            'fecha_hasta'                => $data['fecha_hasta_e'],
            'especificacion'             => $data['esp'],
            'id_unidad_medida'           => $id_unidad_medida,
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }
    // ACCION CENTRALIZADA

    public function consultar_acc_centralizada($id_programacion)
    {
        $this->db->select('pac.id_p_acc_centralizada,
                        	   pac.id_programacion,
                        	   pac.id_accion_centralizada,
                               p.estatus,
                        	   ac.desc_accion_centralizada,
                        	   pac.id_obj_comercial,
                        	   oc.desc_objeto_contrata');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
        $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
        //    $this->db->join('programacion.p_items ', 'p.id_enlace = pac.id_programacion');

        $this->db->where('pac.id_programacion', $id_programacion);
        $this->db->where('pac.vigente', 'true');

        $query = $this->db->get('programacion.p_acc_centralizada pac');
        return $query->result_array();
    }

    public function consulta_act_com2()
    {
        $this->db->select('*');
        $this->db->where('id_objeto_contrata', 1);
        $query = $this->db->get('programacion.objeto_contrata');
        return $result = $query->result_array();
    }

    public function accion_centralizada()
    {
        $this->db->select('*');
        $query = $this->db->get('programacion.accion_centralizada');
        return $result = $query->result_array();
    }

    public function eliminar_proy($data)
    {
        $this->db->where('id_p_proyecto', $data['id_items_proy']);
        $query = $this->db->delete('programacion.p_proyecto');

        if ($query) {
            $this->db->where('id_enlace', $data['id_items_proy']);
            $this->db->where('id_p_acc', 0);
            $query = $this->db->delete('programacion.p_items');

            $this->db->where('id_enlace', $data['id_items_proy']);
            $this->db->where('id_p_acc', 0);
            $query = $this->db->delete('programacion.p_ffinanciamiento');
        }
        return true;
    }

    public function inf_1_acc($id_p_acc_centralizada)
    {
        $this->db->select('pac.id_p_acc_centralizada,
                        	   pac.id_programacion,
                        	   pac.id_accion_centralizada,
                        	   ac.desc_accion_centralizada,
                        	   pac.id_obj_comercial,
                        	   oc.desc_objeto_contrata ');
        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
        $this->db->where('pac.id_p_acc_centralizada', $id_p_acc_centralizada);
        $query = $this->db->get('programacion.p_acc_centralizada pac ');
        return $query->result_array();
    }

    public function inf_2_acc_pdf($id_p_acc_centralizada)
    {
        $this->db->select('pf.id_enlace,
                        	   pf.id_partidad_presupuestaria,
                        	   pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	
                        	   pf.id_fuente_financiamiento,
                        	   ff.desc_fuente_financiamiento,
                        	  sum(pf.porcentaje) as porcentaje ');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
        $this->db->join('programacion.fuente_financiamiento ff', 'ff.id_fuente_financiamiento = pf.id_fuente_financiamiento');
        $this->db->where('pf.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pf.id_p_acc', 1);
        $this->db->group_by('pf.id_enlace,
            pf.id_partidad_presupuestaria,
            pp.desc_partida_presupuestaria,
            pp.codigopartida_presupuestaria,
        
            pf.id_fuente_financiamiento,
            ff.desc_fuente_financiamiento');
        $query = $this->db->get('programacion.p_ffinanciamientototal pf');
        return $query->result_array();
    }

    public function inf_3_acc_pdf($id_p_acc_centralizada)
    {
        $this->db->select('pi2.id_p_items,
                        	     pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	     pi2.id_ccnu,
                        	     c2.desc_ccnu,
                               pi2.id_tip_obra,
                               to2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               ao.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               oo.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                        	     pi2.especificacion,
                               pi2.id_unidad_medida,
                        	     um.desc_unidad_medida,
                        	     pi2.i,
                        	     pi2.ii,
                        	     pi2.iii,
                        	     pi2.iv,
                               pi2.costo_unitario,
                        	     pi2.precio_total,
                        	     pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu', 'left');
        $this->db->join('programacion.tip_obra to2', 'to2.id_tip_obra = pi2.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra ao', 'ao.id_alcance_obra = pi2.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra oo', 'oo.id_obj_obra = pi2.id_obj_obra', 'left');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.id_p_acc', 1);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    public function inf_2_acc($data)
    {
        $this->db->select('pf.id_enlace,
                        	   pf.id_partidad_presupuestaria,
                        	   pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	 
                        	   pf.id_fuente_financiamiento,
                        	   ff.desc_fuente_financiamiento,
                               sum(pf.porcentaje) as porcentaje');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
        $this->db->join('programacion.fuente_financiamiento ff', 'ff.id_fuente_financiamiento = pf.id_fuente_financiamiento');
        $this->db->where('pf.id_enlace', $data['id_p_acc_centralizada']);
        $this->db->where('pf.id_p_acc', 1);
        $this->db->group_by('pf.id_enlace,
            pf.id_partidad_presupuestaria,
            pp.desc_partida_presupuestaria,
            pp.codigopartida_presupuestaria,
        
            pf.id_fuente_financiamiento,
            ff.desc_fuente_financiamiento');
        $query = $this->db->get('programacion.p_ffinanciamientototal pf');

        // $query = $this->db->get('programacion.p_ffinanciamiento pf');
        return $query->result_array();
    }

    public function inf_3_acc($data)
    {
        $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.costo_unitario,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $data['id_p_acc_centralizada']);
        $this->db->where('pi2.id_p_acc', 1);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    public function inf_3_acc_b($data)
    {
        $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                               pi2.cantidad,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.costo_unitario,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $data['id_p_acc_centralizada']);
        $this->db->where('pi2.id_p_acc', 1);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    public function inf_4_acc_o($data)
    {
        $this->db->select('pi2.id_p_items,
								pi2.id_enlace,
								pi2.id_partidad_presupuestaria,
								pp.desc_partida_presupuestaria,
								pp.codigopartida_presupuestaria,
								pi2.fecha_desde,
								pi2.fecha_hasta,
								pi2.especificacion,
								pi2.id_unidad_medida,
								um.desc_unidad_medida,
								pi2.id_tip_obra,
								to2.descripcion_tip_obr,
								pi2.id_alcance_obra,
								ao.descripcion_alcance_obra,
								pi2.id_obj_obra,
								oo.descripcion_obj_obra,
								pi2.i,
								pi2.ii,
								pi2.iii,
								pi2.iv,
								pi2.costo_unitario,
								pi2.precio_total,
								pi2.alicuota_iva,
								pi2.iva_estimado,
								pi2.monto_estimado');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.tip_obra to2', 'to2.id_tip_obra = pi2.id_tip_obra');
        $this->db->join('programacion.alcance_obra ao', 'ao.id_alcance_obra = pi2.id_alcance_obra');
        $this->db->join('programacion.obj_obra oo', 'oo.id_obj_obra = pi2.id_obj_obra');
        $this->db->where('pi2.id_enlace', $data['id_p_acc_centralizada']);
        $this->db->where('pi2.id_p_acc', 1);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    public function editar_programacion_acc($id_p_acc_centralizada, $id_programacion, $p_acc_centralizada, $p_items, $p_ffinanciamiento)
    {

        $this->db->where('id_programacion', $id_programacion);
        $this->db->where('id_p_acc_centralizada', $id_p_acc_centralizada);
        $update = $this->db->update('programacion.p_acc_centralizada', $p_acc_centralizada);

        if ($update) {
            $this->db->where('id_enlace', $id_p_acc_centralizada);
            $this->db->where('id_p_acc', 1);
            $this->db->delete('programacion.p_items');

            $cant_proy = $p_items['id_ccnu'];
            $count_prog = count($cant_proy);
            for ($i = 0; $i < $count_prog; $i++) {
                $data1 = array(
                    'id_enlace'                  => $id_p_acc_centralizada,
                    'id_p_acc'                   => 1,
                    'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                    'id_ccnu'                    => $p_items['id_ccnu'][$i],
                    'id_tip_obra'                => 0,
                    'id_alcance_obra'            => 0,
                    'id_obj_obra'                => 0,
                    'fecha_desde'                => $p_items['fecha_desde'][$i],
                    'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                    'especificacion'             => $p_items['especificacion'][$i],
                    'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                    'cantidad'                   => 0,
                    'i'                          => $p_items['i'][$i],
                    'ii'                         => $p_items['ii'][$i],
                    'iii'                        => $p_items['iii'][$i],
                    'iv'                         => $p_items['iv'][$i],
                    'costo_unitario'             => 0,
                    'cant_total_distribuir'      => 0,
                    'precio_total'               => $p_items['precio_total'][$i],
                    'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                    'iva_estimado'               => $p_items['iva_estimado'][$i],
                    'monto_estimado'               => $p_items['monto_estimado'][$i],
                );
                $this->db->insert('programacion.p_items', $data1);
            }

            $this->db->where('id_enlace', $id_p_acc_centralizada);
            $this->db->where('id_p_acc', 1);
            $this->db->delete('programacion.p_ffinanciamiento');

            $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
            $count_pff = count($cant_pff);

            for ($i = 0; $i < $count_pff; $i++) {

                $data2 = array(
                    'id_enlace'                  => $id_p_acc_centralizada,
                    'id_p_acc'                   => 1,
                    'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                    'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                    'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                    'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                );
                $this->db->insert('programacion.p_ffinanciamiento', $data2);
            }
        }
        return true;
    }

    public function editar_programacion_acc_b($id_p_acc_centralizada, $id_programacion, $p_acc_centralizada, $p_items, $p_ffinanciamiento)
    {

        $this->db->where('id_programacion', $id_programacion);
        $this->db->where('id_p_acc_centralizada', $id_p_acc_centralizada);
        $update = $this->db->update('programacion.p_acc_centralizada', $p_acc_centralizada);

        if ($update) {
            $this->db->where('id_enlace', $id_p_acc_centralizada);
            $this->db->where('id_p_acc', 1);
            $this->db->delete('programacion.p_items');

            $cant_proy = $p_items['id_ccnu'];
            $count_prog = count($cant_proy);
            for ($i = 0; $i < $count_prog; $i++) {
                $data1 = array(
                    'id_enlace'                  => $id_p_acc_centralizada,
                    'id_p_acc'                   => 1,
                    'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                    'id_ccnu'                    => $p_items['id_ccnu'][$i],
                    'id_tip_obra'                => 0,
                    'id_alcance_obra'            => 0,
                    'id_obj_obra'                => 0,
                    'fecha_desde'                => $p_items['fecha_desde'],
                    'fecha_hasta'                => $p_items['fecha_hasta'],
                    'especificacion'             => $p_items['especificacion'][$i],
                    'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                    'cantidad'                   => $p_items['cantidad'][$i],
                    'i'                          => $p_items['i'][$i],
                    'ii'                         => $p_items['ii'][$i],
                    'iii'                        => $p_items['iii'][$i],
                    'iv'                         => $p_items['iv'][$i],
                    'cant_total_distribuir'      => $p_items['cant_total_distribuir'][$i],
                    'costo_unitario'             => $p_items['costo_unitario'][$i],
                    'precio_total'               => $p_items['precio_total'][$i],
                    'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                    'iva_estimado'               => $p_items['iva_estimado'][$i],
                    'monto_estimado'             => $p_items['monto_estimado'][$i],
                );
                $this->db->insert('programacion.p_items', $data1);
            }

            $this->db->where('id_enlace', $id_p_acc_centralizada);
            $this->db->where('id_p_acc', 1);
            $this->db->delete('programacion.p_ffinanciamiento');

            $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
            $count_pff = count($cant_pff);

            for ($i = 0; $i < $count_pff; $i++) {

                $data2 = array(
                    'id_enlace'                  => $id_p_acc_centralizada,
                    'id_p_acc'                   => 1,
                    'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                    'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                    'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                    'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                );
                $this->db->insert('programacion.p_ffinanciamiento', $data2);
            }
        }
        return true;
    }

    //FUNTION PARA EDITAR LA INFORMACION DESDE EL MODAL BIENES
    public function editar_fila_ip_b($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        // $pp_s = $data['selc_part_pres'];
        // if ($pp_s == 0) {
        //     $id_partidad_presupuestaria = $data['partida_pre'];
        // }else {
        //     $id_partidad_presupuestaria = $data['selc_part_pres'];
        // }

        // $ccnu_s = $data['sel_ccnu'];
        // if ($ccnu_s == 0) {
        //     $id_ccnu = $data['ccnu'];
        // }else {
        //     $id_ccnu = $data['sel_ccnu'];
        // }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            // 'id_partidad_presupuestaria' => $data['partida_pre'],
            // 'id_ccnu'                    => $id_ccnu,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'             => $data['estimado_total_t_acc'],

        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }
    //FUNTION PARA rendir bienes acc
    public function reprogramar_items_acc_bienes($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        // $pp_s = $data['selc_part_pres'];
        // if ($pp_s == 0) {
        //     $id_partidad_presupuestaria = $data['partida_pre'];
        // }else {
        //     $id_partidad_presupuestaria = $data['selc_part_pres'];
        // }

        // $ccnu_s = $data['sel_ccnu'];
        // if ($ccnu_s == 0) {
        //     $id_ccnu = $data['ccnu'];
        // }else {
        //     $id_ccnu = $data['sel_ccnu'];
        // }
        $ff1 = $data['sel_camb_ff1'];
        if ($ff1 == 0) {
            $id_ff = $data['ff'];
        } else {
            $id_ff = $data['sel_camb_ff1'];
        }
        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            // 'id_partidad_presupuestaria' => $data['partida_pre'],
            // 'id_ccnu'                    => $id_ccnu,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'   => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),
            'observaciones' => $data['observaciones'],


        );
        $update = $this->db->update('programacion.p_items', $data1);
        if ($update) {

            $this->db->where('id_p_items', $data['id_items_proy']);
            $data3 = array(

                'id_fuente_financiamiento'           => $id_ff,
                // 'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                //   'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],

            );
            //$this->db->insert('programacion.p_ffinanciamiento', $data3);
            $update = $this->db->update('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }

    public function cons_items_acc_b($data)
    {
        $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                        	   pi2.fecha_desde,
                        	   pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.cant_total_distribuir,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_p_items', $data['id_items_proy']);
        $this->db->where('pi2.id_p_acc', 1);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->row_array();
    }

    public function cons_items_acc_o($data)
    {

        $this->db->select('pi2.id_p_items,
								pi2.id_enlace,
								pi2.id_partidad_presupuestaria,
								pp.desc_partida_presupuestaria,
								pp.codigopartida_presupuestaria,
								pi2.fecha_desde,
								pi2.fecha_hasta,
								pi2.especificacion,
								pi2.id_unidad_medida,
								um.desc_unidad_medida,
								pi2.id_tip_obra,
								to2.descripcion_tip_obr,
								pi2.id_alcance_obra,
								ao.descripcion_alcance_obra,
								pi2.id_obj_obra,
								oo.descripcion_obj_obra,
								pi2.i,
								pi2.ii,
								pi2.iii,
								pi2.iv,
								pi2.costo_unitario,
								pi2.precio_total,
								pi2.alicuota_iva,
								pi2.iva_estimado,
								pi2.monto_estimado');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.tip_obra to2', 'to2.id_tip_obra = pi2.id_tip_obra');
        $this->db->join('programacion.alcance_obra ao', 'ao.id_alcance_obra = pi2.id_alcance_obra');
        $this->db->join('programacion.obj_obra oo', 'oo.id_obj_obra = pi2.id_obj_obra');
        $this->db->where('pi2.id_p_items', $data['id_items_proy']);
        $this->db->where('pi2.id_p_acc', 1);
        $query = $this->db->get('programacion.p_items pi2');
        return $query->row_array();
    }

    public function eliminar_acc($data)
    {
        $this->db->where('id_p_acc_centralizada', $data['id_items_acc']);
        $query = $this->db->delete('programacion.p_acc_centralizada');

        if ($query) {
            $this->db->where('id_enlace', $data['id_items_acc']);
            $this->db->where('id_p_acc', 1);
            $query = $this->db->delete('programacion.p_items');

            $this->db->where('id_enlace', $data['id_items_acc']);
            $this->db->where('id_p_acc', 1);
            $query = $this->db->delete('programacion.p_ffinanciamiento');
        }
        return true;
    }

    public function desactivar_acc_centralizada($data)
    {
        $id_acc = $data['id_items_acc'];
        $id_usuario = $data['id_usuario'];

        // 🔹 1. Marcar la acción centralizada como NO vigente
        $this->db->where('id_p_acc_centralizada', $id_acc);
        $update_acc = $this->db->update('programacion.p_acc_centralizada', [
            'vigente' => false,
            'fecha_version' => date('Y-m-d H:i:s'),
            'tipo_operacion' => 'deletd',
            'id_usuario' => $id_usuario
        ]);

        // 🔹 2. Marcar los ítems relacionados como NO vigentes
        $this->db->where('id_enlace', $id_acc);
        $this->db->where('id_p_acc', 1); // 1 = acción centralizada
        $update_items = $this->db->update('programacion.p_items', [
            'vigente' => false,
            'fecha_fin_vigencia' => date('Y-m-d H:i:s'),
            'tipo_operacion' => 'deletd',
            'id_usuario_operacion' => $id_usuario
        ]);

        // (Opcional) 🔹 3. Si quieres marcar también la fuente de financiamiento
        $this->db->where('id_enlace', $id_acc);
        $this->db->where('id_p_acc', 1);
        $this->db->update('programacion.p_ffinanciamiento', [
            'vigente' => false,
            'fecha_version' => date('Y-m-d H:i:s'),
            'descripcion_ff' => 'deletd',
            'usuario_version' => $id_usuario
        ]);

        if ($update_acc && $update_items) {

            return 1;
        } else {
            return 0;
        }
    }
    public function desactivar_proyecto($data)
    {
        $id_proyecto = $data['id_proyecto'];
        $id_usuario = $data['id_usuario'];

        // 🔹 1. Desactivar el proyecto
        $this->db->where('id_p_proyecto', $id_proyecto);
        $update_proy = $this->db->update('programacion.p_proyecto', [
            'vigente' => false,
            'fecha_version' => date('Y-m-d H:i:s'),
            'tipo_operacion' => 'DELETEd',
            'id_usuario' => $id_usuario
        ]);

        // 🔹 2. Desactivar los ítems asociados
        $this->db->where('id_enlace', $id_proyecto);
        $this->db->where('id_p_acc', 0); // 0 = Proyecto
        $update_items = $this->db->update('programacion.p_items', [
            'vigente' => false,
            'fecha_fin_vigencia' => date('Y-m-d H:i:s'),
            'tipo_operacion' => 'DELETEd',
            'id_usuario_operacion' => $id_usuario
        ]);

        // (Opcional) 🔹 3. Desactivar también fuentes de financiamiento
        $this->db->where('id_enlace', $id_proyecto);
        $this->db->where('id_p_acc', 0);
        $this->db->update('programacion.p_ffinanciamiento', [
            'vigente' => false,
            'fecha_version' => date('Y-m-d H:i:s'),
            'descripcion_ff' => 'DELETEd',
            'usuario_version' => $id_usuario
        ]);
        if ($update_proy && $update_items) {
            return 1;
        } else {
            return 0;
        }
    }


    public function editar_fila_ip_b_o($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        $pp_s = $data['selc_part_pres'];
        if ($pp_s == 0) {
            $id_partidad_presupuestaria = $data['partida_pre'];
        } else {
            $id_partidad_presupuestaria = $data['selc_part_pres'];
        }

        $sel_obra = $data['sel_obra'];
        if ($sel_obra == 0) {
            $sel_obra = $data['obra'];
        } else {
            $sel_obra = $data['sel_obra'];
        }

        $sel_alc_obr = $data['sel_alc_obr'];
        if ($sel_alc_obr == 0) {
            $sel_alc_obr = $data['alc_obr'];
        } else {
            $sel_alc_obr = $data['sel_alc_obr'];
        }

        $sel_obj_obr = $data['sel_obj_obr'];
        if ($sel_obj_obr == 0) {
            $sel_obj_obr = $data['obj_obr'];
        } else {
            $sel_obj_obr = $data['sel_obj_obr'];
        }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            'id_partidad_presupuestaria' => $data['partida_pre'],
            'id_tip_obra'                => $sel_obra,
            'id_alcance_obra'            => $sel_alc_obr,
            'id_obj_obra'                 => $sel_obj_obr,
            'especificacion'             => $data['esp'],
            'id_unidad_medida'           => $id_unidad_medida,
            'fecha_desde'                => $data['fecha_desde_e'],
            'fecha_hasta'                => $data['fecha_hasta_e'],
            'cantidad'                   => $data['cant_total_dist_m'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => 0,
            'costo_unitario'             => 0,
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }
    // consulta PROGRAMACION general por el snc
    public function consultar_programacio($unidad)
    {
        $this->db->select('c.id_programacion, c.unidad, c.anio, m.rif,  m.descripcion,');
        $this->db->join('public.organoente m', 'm.codigo = c.unidad');
        // $this->db->where('unidad', $unidad);
        $query = $this->db->get('programacion.programacion c');
        return $query->result_array();
    }

    function consultar_proyecto($id_p_proyecto)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $id_p_proyecto);
        $this->db->where('pi2.id_p_acc', 0); //que esean proyectos
        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    // public function inf_3_b($data){
    //     $this->db->select('pi2.id_p_items,
    //                        pi2.id_enlace,
    //                        pi2.id_partidad_presupuestaria,
    //                        pp.desc_partida_presupuestaria,
    //                        pp.codigopartida_presupuestaria,
    //                        pi2.id_ccnu,
    //                        c2.desc_ccnu,
    //                        pi2.fecha_desde,
    //                        pi2.fecha_hasta,
    //                        pi2.especificacion,
    //                        pi2.id_unidad_medida,
    //                        um.desc_unidad_medida,
    //                        pi2.cantidad,
    //                        pi2.costo_unitario,
    //                        pi2.i,
    //                        pi2.ii,
    //                        pi2.iii,
    //                        pi2.iv,
    //                        pi2.cant_total_distribuir,
    //                        pi2.precio_total,
    //                        pi2.alicuota_iva,
    //                        pi2.iva_estimado,
    //                        pi2.monto_estimado');
    //     $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
    //     $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
    //     $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
    //     $this->db->where('pi2.id_enlace', $data['id_p_proyecto']);
    //     $this->db->where('pi2.id_p_acc', 0);
    //     $query = $this->db->get('programacion.p_items pi2');

    ///////////////////////////////////consultar accion centralizada bienes
    function consultar_scc($id_p_acc_centralizada)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.p_acc_centralizada p', 'p.id_p_acc_centralizada = pi2.id_enlace'); // esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.id_p_acc', 1);
        // $this->db->where('pi2.vigente', 'TRUE');
        $this->db->where('pi2.version', '1');


        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    ///////////////////////////////////consultar tabla servicio proyecto
    function consultar_py_ser($id_p_proyecto)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                              
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               py.id_p_proyecto');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.p_proyecto py', 'py.id_p_proyecto = pi2.id_enlace'); // esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_proyecto);
        $this->db->where('pi2.id_p_acc', 0);
        $this->db->where('pi2.vigente', 'TRUE');
        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    ///////////////////////////////////consultar proyecto bienes
    function consultar_item_py_bienes($id_p_proyecto)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               ');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        //  $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_proyecto);
        $this->db->where('pi2.id_p_acc', 0); //busca que sean proyectos
        $this->db->where('pi2.vigente', 'TRUE');
        // $this->db->where('pi2.version', '1');

        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    function consultar_item_py_bienes2($id_p_proyecto)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               ');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        //  $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_proyecto);
        $this->db->where('pi2.id_p_acc', 0); //busca que sean proyectos
        // $this->db->where('pi2.vigente', 'TRUE');
        $this->db->where('pi2.version', '1');

        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    function consultar_item_py_servicio($id_programacion)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                              ');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        // $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_programacion);
        $this->db->where('pi2.id_p_acc', 0); //busca que sean proyectos
        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    ////////////consultar editar items servicios acc
    public function consultar_itms_serv($id_p_items)
    {

        $this->db->select('pi2.id_p_items,
                            pi2.id_enlace,
                            pi2.id_partidad_presupuestaria,
                            pp.desc_partida_presupuestaria,
                            pp.codigopartida_presupuestaria,
                            pi2.id_ccnu,
                            c2.desc_ccnu,
                            pi2.fecha_desde,
                            pi2.fecha_hasta,
                            pi2.especificacion,
                            pi2.id_unidad_medida,
                            um.desc_unidad_medida,
                            pi2.cantidad,
                            pi2.costo_unitario,
                            pi2.i,
                            pi2.ii,
                            pi2.iii,
                            pi2.iv,
                            pi2.cant_total_distribuir,
                            pi2.precio_total,
                            pi2.alicuota_iva,
                            pi2.iva_estimado,
                            pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_p_items', $id_p_items);
        $this->db->where('pi2.id_p_acc', 1); //eto verifica que sea una accion centralizada
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    ////////////consultar editar items servicios proyecto
    public function consultar_itms_serv_py($id_p_items)
    {

        $this->db->select('pi2.id_p_items,
                            pi2.id_enlace,
                            pi2.id_partidad_presupuestaria,
                            pp.desc_partida_presupuestaria,
                            pp.codigopartida_presupuestaria,
                            pi2.id_ccnu,
                            c2.desc_ccnu,
                            pi2.fecha_desde,
                            pi2.fecha_hasta,
                            pi2.especificacion,
                            pi2.id_unidad_medida,
                            um.desc_unidad_medida,
                            pi2.cantidad,
                            pi2.costo_unitario,
                            pi2.i,
                            pi2.ii,
                            pi2.iii,
                            pi2.iv,
                            pi2.cant_total_distribuir,
                            pi2.precio_total,
                            pi2.alicuota_iva,
                            pi2.iva_estimado,
                            pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_p_items', $id_p_items);
        $this->db->where('pi2.id_p_acc', 0); //eto verifica que sea un proyecto
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }


    //////////////////////consultar item obras para cargar mas items acc
    function consultar_tems_obras($id_p_acc_centralizada)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_tip_obra,
                               c2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               c3.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               c4.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.tip_obra c2', 'c2.id_tip_obra = pi2.id_tip_obra');
        $this->db->join('programacion.alcance_obra c3', 'c3.id_alcance_obra = pi2.id_alcance_obra');
        $this->db->join('programacion.obj_obra c4', 'c4.id_obj_obra = pi2.id_obj_obra');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.id_p_acc', 1);
        $this->db->where('pi2.version', 1);

        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }

    function consultar_tems_obrasv($id_p_acc_centralizada)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_tip_obra,
                               c2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               c3.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               c4.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.tip_obra c2', 'c2.id_tip_obra = pi2.id_tip_obra');
        $this->db->join('programacion.alcance_obra c3', 'c3.id_alcance_obra = pi2.id_alcance_obra');
        $this->db->join('programacion.obj_obra c4', 'c4.id_obj_obra = pi2.id_obj_obra');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.id_p_acc', 1);
        $this->db->where('pi2.vigente', 'TRUE');

        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    //////////////////////consultar item obras para cargar mas items proyecto
    function consultar_tems_obras_py($id_p_proyecto)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_tip_obra,
                               c2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               c3.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               c4.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.tip_obra c2', 'c2.id_tip_obra = pi2.id_tip_obra');
        $this->db->join('programacion.alcance_obra c3', 'c3.id_alcance_obra = pi2.id_alcance_obra');
        $this->db->join('programacion.obj_obra c4', 'c4.id_obj_obra = pi2.id_obj_obra');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $id_p_proyecto);
        $this->db->where('pi2.id_p_acc', 0); //indico que consulte los proyectos con ese id_enlace
        $this->db->where('pi2.version', 1);
        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    function consultar_tems_obras_pyv2($id_p_proyecto)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_tip_obra,
                               c2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               c3.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               c4.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
        $this->db->join('programacion.tip_obra c2', 'c2.id_tip_obra = pi2.id_tip_obra');
        $this->db->join('programacion.alcance_obra c3', 'c3.id_alcance_obra = pi2.id_alcance_obra');
        $this->db->join('programacion.obj_obra c4', 'c4.id_obj_obra = pi2.id_obj_obra');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_enlace', $id_p_proyecto);
        $this->db->where('pi2.id_p_acc', 0); //indico que consulte los proyectos con ese id_enlace
        $this->db->where('pi2.vigente', 'TRUE');
        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }

    ////////////////////////////UNA VEZ MODIFICADO LOS ITEMS DE SERVICIO SE GUARDAN ACA
    public function guardar_items_modificados_servi($id_p_items, $itm_serv)
    {

        $this->db->where('id_p_items', $id_p_items);
        // $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('programacion.p_items', $itm_serv);
    }



    ///////////////////////////////consultar items para modal editar bienes
    public function consultar_items($data)
    {
        $this->db->select('m.id_p_items,
                             m.id_partidad_presupuestaria,
                             m.id_ccnu,
                             m.id_tip_obra,
                             m.id_alcance_obra,
                             m.id_obj_obra,
                             m.especificacion,
                             m.fecha_desde, 
                             m.fecha_hasta,
                             m.id_unidad_medida,
                             m.cantidad,
                             m.i,
                             m.ii,
                             m.iii,
                             m.iv,
                             m.cant_total_distribuir,
                             m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                             m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                             pp.codigopartida_presupuestaria,
                             pp.desc_partida_presupuestaria,
                             cc.desc_ccnu,
                             un.desc_unidad_medida,
                             tpo.descripcion_tip_obr,
                             al.descripcion_alcance_obra,
                             obj.descripcion_obj_obra,
                             ff.id_fuente_financiamiento ,
                             f1.desc_fuente_financiamiento');
        $this->db->from('programacion.p_items m');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.tip_obra tpo', 'tpo.id_tip_obra = m.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra al', 'al.id_alcance_obra = m.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra obj', 'obj.id_obj_obra = m.id_obj_obra', 'left');
        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento f1', 'f1.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');
        $this->db->where('m.id_p_items', $data['id_p_items']);
        // $this->db->order_by('mc.id_p_items desc');
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }

    ////////////////////////agrega mas items a BIENES///////////////////
    function agregar_mas_item_proyecto($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        // Insertamos con versión inicial
        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace'             => $data['id_enlace'],
            'id_p_acc'              => $data['id_p_acc'],
            'id_obj_comercial'      => $data['id_obj_comercial'],
            'id_tip_obra'           => $data['id_tip_obra'],
            'id_alcance_obra'       => $data['id_alcance_obra'],
            'id_obj_obra'           => $data['id_obj_obra'],
            'fecha_desde'           => $data['fecha_desde'],
            'fecha_hasta'           => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'               => $data['id_ccnu'],
            'especificacion'        => $data['especificacion'],
            'id_unidad_medida'      => $data['id_unidad_medida'],
            'cantidad'              => $data['cantidad'],
            'i'                     => $data['i'],
            'ii'                    => $data['ii'],
            'iii'                   => $data['iii'],
            'iv'                    => $data['iv'],
            'cant_total_distribuir' => $data['cant_total_distribuir'],
            'precio_total'          => $data['precio_total'],
            'alicuota_iva'          => $data['alicuota_iva'],
            'iva_estimado'          => $data['iva_estimado'],
            'costo_unitario'        => $data['costo_unitario'],
            'monto_estimado'        => $data['monto_estimado'],
            'est_trim_1'            => $data['est_trim_1'],
            'est_trim_2'            => $data['est_trim_2'],
            'est_trim_3'            => $data['est_trim_3'],
            'est_trim_4'            => $data['est_trim_4'],
            'estimado_total_t_acc'  => $data['estimado_total_t_acc'],
            'estatus_rendi'         => $data['estatus_rendi'],
            'id_proyecto'           => $data['id_proyecto'],
            'id_usuario'            => $data['id_usuario'],
            'id_original'           => $id1,
            'version'               => 1,
            'vigente'               => true,
            'fecha_version'         => date('Y-m-d H:i:s'),
            'usuario_version'       => $data['id_usuario']
        );

        $insert = $this->db->insert("programacion.p_items", $data1);

        if ($insert) {
            // // actualizamos id_original para que apunte a sí mismo (versión base)
            // $this->db->set('id_original', $id1);
            // $this->db->where('id_p_items', $id1);
            // $this->db->update('programacion.p_items');

            // insertar fuente de financiamiento asociada
            $data3 = array(
                'id_p_items'             => $id1,
                'id_estado'              => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'             => $p_ffinanciamiento['porcentaje'],
                'id_enlace'              => $p_ffinanciamiento['id_enlace'],
                'id_p_acc'               => $p_ffinanciamiento['id_p_acc'],
                'id_original'           => $id1,
                'version'               => 1,
                'vigente'               => true,
                'fecha_version'         => date('Y-m-d H:i:s'),
                'usuario_version'       => $data['id_usuario']

            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);

            return true;
        } else {
            return false;
        }
    }


    ////////////////////////agrega mas items a BIENES REPROGRAMACION esta si ///////////////////
    function agregar_mas_item_reprogramado($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => $data['estatus_rendi'],
            'reprogramado' => $data['reprogramado'],
            'fecha_reprogramacion' => $data['fecha_reprogramacion'],
            'id_proyecto' => $data['id_proyecto'],
            'id_obj_comercial' => $data['id_obj_comercial'],

            'observaciones' => $data['observaciones'],




        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {
            $id = $id;

            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }
    //////////////////gUARDAR agregar mas items servicio accion centralizada
    function agregar_mas_item_servicio($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_obj_comercial' => $data['id_obj_comercial'],

            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => $data['estatus_rendi'],
            'reprogramado' => 0,
            'id_proyecto' => $data['id_proyecto'],
            'id_usuario' => $data['id_usuario'],
            'id_original'           => $id1,
            'version'               => 1,
            'vigente'               => true,
            'fecha_version'         => date('Y-m-d H:i:s'),
            'usuario_version'       => $data['id_usuario']


        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {
            // $id = $id;

            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc'],
                'id_original'           => $id1,
                'version'               => 1,
                'vigente'               => true,
                'fecha_version'         => date('Y-m-d H:i:s'),
                'usuario_version'       => $data['id_usuario']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
        //va a historico
        //  $data4 = array(
        //     'id_historico'		    => $id1,
        //     rif_organoente,
        //     'id_p_items'		    => $id1,
        //     'id_enlace' => $data['id_enlace'],
        //     'id_p_acc' => $data['id_p_acc'],
        //     'id_tip_obra' => $data['id_tip_obra'],
        //     'id_alcance_obra' => $data['id_alcance_obra'],
        //     'id_obj_obra'=>  $data['id_obj_obra'],
        //     'fecha_desde'=>  $data['fecha_desde'],
        //     'fecha_hasta'=> $data['fecha_hasta'],
        //    'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
        //    'id_ccnu' 		        => $data['id_ccnu'],
        //    'especificacion' 		=> $data['especificacion'],
        //    'id_unidad_medida' 		 => $data['id_unidad_medida'],
        //    'cantidad' 		 => $data['cantidad'],
        //    'i' 		          => $data['i'],
        //    'ii' 		            => $data['ii'],
        //    'iii' 		            => $data['iii'],
        //    'iv' 		             => $data['iv'],
        //    'cant_total_distribuir'  => $data['cant_total_distribuir'],
        //    'precio_total' 		    => $data['precio_total'],
        //    'alicuota_iva' 		=> $data['alicuota_iva'],
        //    'iva_estimado' 		    => $data['iva_estimado'],
        //    'costo_unitario' 		=> $data['costo_unitario'],
        //    'monto_estimado' 		=> $data['monto_estimado'],
        //    'est_trim_1' 		 => $data['est_trim_1'],
        //    'est_trim_2' 		 => $data['est_trim_2'],
        //    'est_trim_3' 		=> $data['est_trim_3'],
        //    'est_trim_4' 		 => $data['est_trim_4'],
        //    'estimado_total_t_acc' => $data['estimado_total_t_acc'],
        //    'estatus_rendi' => $data['estatus_rendi'],
        //    'reprogramado' => 0,
        //    'id_proyecto' => $data['id_proyecto'],

        //    rif_organoente varchar(15) NOT NULL,
        //    id_programacion int4 NULL,
        //    id_enlace int4 NULL,
        //    id_p_acc int4 NULL,
        //    id_proyecto varchar NULL,
        //    nombre_proyecto varchar null,
        //    codigopartida_presupuestaria varchar (100) NULL,
        //    desc_partida_presupuestaria varchar (200) NULL,
        //    id_p_items int4 NULL,
        //    codigo_ccnu varchar(100) NULL,
        //    desc_ccnu varchar(200) NULL,
        //    id_accion_centralizada int4 NULL,
        //    desc_accion_centralizada varchar(300) NULL,
        //    id_obj_comercial int4 NULL,
        //    desc_objeto_contrata varchar(50) NULL,
        //    estado varchar(50) NULL,
        //    id_fuente_financiamiento int4 NULL,
        //    desc_fuente_financiamiento varchar(200) NULL,
        //    porcentaje varchar(20) NULL,	
        //    id_tip_obra int4 NULL,
        //    des_tip_obra varchar (200) null,
        //    id_alcance_obra int4 NULL,
        //    des_alcance_obra varchar (200) null,
        //    id_obj_obra int4 NULL,
        //    des_obj_obra varchar (200) null,
        //    fecha_desde date NULL,
        //    fecha_hasta date NULL,
        //    especificacion varchar(300) NULL,
        //    id_unidad_medida int4 NULL,
        //    cantidad int4 NULL,
        //    i varchar NULL,
        //    ii varchar NULL,
        //    iii varchar NULL,
        //    iv varchar NULL,
        //    cant_total_distribuir varchar NULL,
        //    costo_unitario varchar NULL,
        //    sub_total_b varchar NULL,
        //    precio_total varchar NULL,
        //    alicuota_iva varchar NULL,
        //    iva_estimado varchar NULL,
        //    monto_estimado varchar NULL,
        //    est_trim_1 varchar NULL,
        //    est_trim_2 varchar NULL,
        //    est_trim_3 varchar NULL,
        //    est_trim_4 varchar NULL,
        //    estimado_total_t_acc varchar NULL);


        // );

    }




    //////////////////eliminar items de servcio
    public function eliminar_items_serv($data)
    {
        $this->db->where('id_p_items', $data['id_p_items']);
        $query = $this->db->delete('programacion.p_items');

        if ($query) {
            // $this->db->where('id_enlace', $data['id_items_proy']);
            // $this->db->where('id_p_acc', 0);
            // $query = $this->db->delete('programacion.p_items');

            $this->db->where('id_p_items', $data['id_p_items']);
            // $this->db->where('id_p_acc', 0);
            $query = $this->db->delete('programacion.p_ffinanciamiento');
        }
        return true;
    }
    //////////////////eliminar items de servcio
    public function eliminar_items_bienes($data)
    {
        $this->db->where('id_p_items', $data['id_p_items']);
        $query = $this->db->delete('programacion.p_items');

        if ($query) {

            $this->db->where('id_p_items', $data['id_p_items']);
            // $this->db->where('id_p_acc', 0);
            $query = $this->db->delete('programacion.p_ffinanciamiento');
        }
        return true;
    }

    /////////////////////////////////////
    public function eliminar_rendiciones($data)
    {
        $this->db->where('id_rendicion', $data['id_rendicion']);
        $query = $this->db->delete('programacion.rendidicion');
        return true;
    }
    //////////////////gUARDAR agregar mas items Obras
    function agregar_mas_item_obras($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_obj_comercial' => $data['id_obj_comercial'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'id_proyecto' => $data['id_proyecto'],
            'id_usuario' => $data['id_usuario'],
            'id_original'           => $id1,
            'version'               => 1,
            'vigente'               => true,
            'fecha_version'         => date('Y-m-d H:i:s'),
            'usuario_version'       => $data['id_usuario']


        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {
            // $id = $id;

            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc'],
                'id_original'           => $id1,
                'version'               => 1,
                'vigente'               => true,
                'fecha_version'         => date('Y-m-d H:i:s'),
                'usuario_version'       => $data['id_usuario']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }
    //guarda el estatus de la modificacion de la proframacion
    public function enviar_snc_reprogramacion($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5)
    {
        $this->db->select('anio');
        $this->db->where('id_programacion', $data['id']);
        $query1 = $this->db->get('programacion.programacion');
        $response4 = $query1->row_array();
        $id1 = $response4['anio'] + 0;
        //ACC 1
        $id_obj_comr_obra_a = 0;
        $precio_total_obra_a = 0;
        $porcentaje_obra_a = 0;
        $id_obj_comr_bien_a = 0;
        $precio_total_bien_a = 0;
        $porcentaje_bien_a = 0;
        $id_obj_comr_serv_a = 0;
        $precio_total_serv_a = 0;
        $porcentaje_serv_a = 0;

        if ($data2 != '') {
            foreach ($data2 as $d2) {
                if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == '3') {
                    $id_obj_comr_obra_a = $d2->id_obj_comercial;
                    $precio_total_obra_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_obra_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 1) {
                    $id_obj_comr_bien_a = $d2->id_obj_comercial;
                    $precio_total_bien_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_bien_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 2) {
                    $id_obj_comr_serv_a = $d2->id_obj_comercial;
                    $precio_total_serv_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_serv_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                }
            }

            foreach ($data3 as $total_ass) {
                $total_acc = $total_ass->precio_total;
            }
        } else {
            $id_obj_comr_obra_a = 0;
            $precio_total_obra_a = 0;
            $porcentaje_obra_a = 0;
            $id_obj_comr_bien_a = 0;
            $precio_total_bien_a = 0;
            $porcentaje_bien_a = 0;
            $id_obj_comr_serv_ac = 0;
            $precio_total_serv_a = 0;
            $porcentaje_serv_a = 0;
            $total_acc = 0;
        }

        //PROYECTO 0

        $id_obj_comr_obra_p = 0;
        $precio_total_obra_p = 0;
        $porcentaje_obra_p = 0;
        $id_obj_comr_bien_p = 0;
        $precio_total_bien_p = 0;
        $porcentaje_bien_p = 0;
        $id_obj_comr_serv_p = 0;
        $precio_total_serv_p = 0;
        $porcentaje_serv_p = 0;

        if ($data4 != '') {
            foreach ($data4 as $d) {
                if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 3) {
                    $id_obj_comr_obra_p = $d->id_obj_comercial;
                    $precio_total_obra_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_obra_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 1) {
                    $id_obj_comr_bien_p = $d->id_obj_comercial;
                    $precio_total_bien_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_bien_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 2) {
                    $id_obj_comr_serv_p = $d->id_obj_comercial;
                    $precio_total_serv_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_serv_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                }
            }

            foreach ($data5 as $total_ass) {
                $total_proy = $total_ass->precio_total_py;
            }
        } else {
            $id_obj_comr_obra_p = 0;
            $precio_total_obra_p = 0;
            $porcentaje_obra_p = 0;
            $id_obj_comr_bien_p = 0;
            $precio_total_bien_p = 0;
            $porcentaje_bien_p = 0;
            $id_obj_comr_serv_p = 0;
            $precio_total_serv_p = 0;
            $porcentaje_serv_p = 0;
            $total_proy = 0;
        }

        $resulta = array(
            'id_programacion'      => $data['id'],
            'des_unidad'            => $des_unidad,
            'codigo_onapre'         => $codigo_onapre,

            'rif'                   => $rif,
            'id_p_acc_proy'         => 0,
            'id_obj_comr_obra'      => $id_obj_comr_obra_p,
            'precio_total_obra'     => $precio_total_obra_p,
            'porcentaje_obra'       => $porcentaje_obra_p,
            'id_obj_comr_bien'      => $id_obj_comr_bien_p,
            'precio_total_bien'     => $precio_total_bien_p,
            'porcentaje_bien'       => $porcentaje_bien_p,
            'id_obj_comr_serv'      => $id_obj_comr_serv_p,
            'precio_total_serv'     => $precio_total_serv_p,
            'porcentaje_serv'       => $porcentaje_serv_p,
            'total_proy'            => $total_proy,
            'id_p_acc'              => 1,
            'id_obj_comr_obra_a'    => $id_obj_comr_obra_a,
            'precio_total_obra_a'   => $precio_total_obra_a,
            'porcentaje_obra_a'     => $porcentaje_obra_a,
            'id_obj_comr_bien_a'    => $id_obj_comr_bien_a,
            'precio_total_bien_a'   => $precio_total_bien_a,
            'porcentaje_bien_a'     => $porcentaje_bien_a,
            'id_obj_comr_serv_a'    => $id_obj_comr_serv_a,
            'precio_total_serv_a'   => $precio_total_serv_a,
            'porcentaje_serv_a'     => $porcentaje_serv_a,
            'total_acc'             => $total_acc,
            'id_usuario'            => $this->session->userdata('id_user'),
            'anio'            => $id1,

        );
        //print_r($resulta);die;
        $this->db->insert('programacion.inf_modif', $resulta);

        $data1 = array(
            'modificado' => '2', // se puede Modificar y rendir 
            //'id_usuario' => $this->session->userdata('id_user'),
            'fecha_modifi' => date('Y-m-d h:i:s')
        );
        $this->db->where('id_programacion', $data['id']);
        $update = $this->db->update('programacion.programacion', $data1);
        return true;
    }
    /////////////cambia el status de la programacion
    // public function enviar_snc_reprogramacion($data)
    // {
    //     $data1 = array('estatus' => '3',// se puede reprogramar y rendir 
    //                     'id_usuario' => '0',
    //                     'fecha' => date('Y-m-d h:i:s'));
    //     $this->db->where('id_programacion', $data['id']);
    //     $update = $this->db->update('programacion.programacion', $data1);
    //     return true;
    // }
    /////////////cambia el status de la programacion enviar al snc
    // public function enviar_snc($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5)
    // {
    //     $this->db->select('anio');
    //     $this->db->where('id_programacion', $data['id']);
    //     $query1 = $this->db->get('programacion.programacion');
    //     $response4 = $query1->row_array();
    //     $id1 = $response4['anio'] + 0;
    //     //ACC 1
    //     $id_obj_comr_obra_a = 0;
    //     $precio_total_obra_a = 0;
    //     $porcentaje_obra_a = 0;
    //     $id_obj_comr_bien_a = 0;
    //     $precio_total_bien_a = 0;
    //     $porcentaje_bien_a = 0;
    //     $id_obj_comr_serv_a = 0;
    //     $precio_total_serv_a = 0;
    //     $porcentaje_serv_a = 0;

    //     if ($data2 != '') {
    //         foreach ($data2 as $d2) {
    //             if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == '3') {
    //                 $id_obj_comr_obra_a = $d2->id_obj_comercial;
    //                 $precio_total_obra_a = number_format($d2->precio_total, 2, ",", ".");

    //                 foreach ($data3 as $d3) {
    //                     $porcentaje_obra_a = $d2->precio_total / $d3->precio_total * 100;
    //                 }
    //             } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 1) {
    //                 $id_obj_comr_bien_a = $d2->id_obj_comercial;
    //                 $precio_total_bien_a = number_format($d2->precio_total, 2, ",", ".");

    //                 foreach ($data3 as $d3) {
    //                     $porcentaje_bien_a = $d2->precio_total / $d3->precio_total * 100;
    //                 }
    //             } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 2) {
    //                 $id_obj_comr_serv_a = $d2->id_obj_comercial;
    //                 $precio_total_serv_a = number_format($d2->precio_total, 2, ",", ".");

    //                 foreach ($data3 as $d3) {
    //                     $porcentaje_serv_a = $d2->precio_total / $d3->precio_total * 100;
    //                 }
    //             }
    //         }

    //         foreach ($data3 as $total_ass) {
    //             $total_acc = $total_ass->precio_total;
    //         }
    //     } else {
    //         $id_obj_comr_obra_a = 0;
    //         $precio_total_obra_a = 0;
    //         $porcentaje_obra_a = 0;
    //         $id_obj_comr_bien_a = 0;
    //         $precio_total_bien_a = 0;
    //         $porcentaje_bien_a = 0;
    //         $id_obj_comr_serv_ac = 0;
    //         $precio_total_serv_a = 0;
    //         $porcentaje_serv_a = 0;
    //         $total_acc = 0;
    //     }

    //     //PROYECTO 0

    //     $id_obj_comr_obra_p = 0;
    //     $precio_total_obra_p = 0;
    //     $porcentaje_obra_p = 0;
    //     $id_obj_comr_bien_p = 0;
    //     $precio_total_bien_p = 0;
    //     $porcentaje_bien_p = 0;
    //     $id_obj_comr_serv_p = 0;
    //     $precio_total_serv_p = 0;
    //     $porcentaje_serv_p = 0;

    //     if ($data4 != '') {
    //         foreach ($data4 as $d) {
    //             if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 3) {
    //                 $id_obj_comr_obra_p = $d->id_obj_comercial;
    //                 $precio_total_obra_p = number_format($d->precio_total, 2, ",", ".");

    //                 foreach ($data5 as $d3) {
    //                     $porcentaje_obra_p = $d->precio_total / $d3->precio_total_py * 100;
    //                 }
    //             } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 1) {
    //                 $id_obj_comr_bien_p = $d->id_obj_comercial;
    //                 $precio_total_bien_p = number_format($d->precio_total, 2, ",", ".");

    //                 foreach ($data5 as $d3) {
    //                     $porcentaje_bien_p = $d->precio_total / $d3->precio_total_py * 100;
    //                 }
    //             } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 2) {
    //                 $id_obj_comr_serv_p = $d->id_obj_comercial;
    //                 $precio_total_serv_p = number_format($d->precio_total, 2, ",", ".");

    //                 foreach ($data5 as $d3) {
    //                     $porcentaje_serv_p = $d->precio_total / $d3->precio_total_py * 100;
    //                 }
    //             }
    //         }

    //         foreach ($data5 as $total_ass) {
    //             $total_proy = $total_ass->precio_total_py;
    //         }
    //     } else {
    //         $id_obj_comr_obra_p = 0;
    //         $precio_total_obra_p = 0;
    //         $porcentaje_obra_p = 0;
    //         $id_obj_comr_bien_p = 0;
    //         $precio_total_bien_p = 0;
    //         $porcentaje_bien_p = 0;
    //         $id_obj_comr_serv_p = 0;
    //         $precio_total_serv_p = 0;
    //         $porcentaje_serv_p = 0;
    //         $total_proy = 0;
    //     }

    //     $resulta = array(
    //         'id_programacion'      => $data['id'],
    //         'des_unidad'            => $des_unidad,
    //         'codigo_onapre'         => $codigo_onapre,

    //         'rif'                   => $rif,
    //         'id_p_acc_proy'         => 0,
    //         'id_obj_comr_obra'      => $id_obj_comr_obra_p,
    //         'precio_total_obra'     => $precio_total_obra_p,
    //         'porcentaje_obra'       => $porcentaje_obra_p,
    //         'id_obj_comr_bien'      => $id_obj_comr_bien_p,
    //         'precio_total_bien'     => $precio_total_bien_p,
    //         'porcentaje_bien'       => $porcentaje_bien_p,
    //         'id_obj_comr_serv'      => $id_obj_comr_serv_p,
    //         'precio_total_serv'     => $precio_total_serv_p,
    //         'porcentaje_serv'       => $porcentaje_serv_p,
    //         'total_proy'            => $total_proy,
    //         'id_p_acc'              => 1,
    //         'id_obj_comr_obra_a'    => $id_obj_comr_obra_a,
    //         'precio_total_obra_a'   => $precio_total_obra_a,
    //         'porcentaje_obra_a'     => $porcentaje_obra_a,
    //         'id_obj_comr_bien_a'    => $id_obj_comr_bien_a,
    //         'precio_total_bien_a'   => $precio_total_bien_a,
    //         'porcentaje_bien_a'     => $porcentaje_bien_a,
    //         'id_obj_comr_serv_a'    => $id_obj_comr_serv_a,
    //         'precio_total_serv_a'   => $precio_total_serv_a,
    //         'porcentaje_serv_a'     => $porcentaje_serv_a,
    //         'total_acc'             => $total_acc,
    //         'id_usuario'            => $this->session->userdata('id_user'),
    //         'anio'            => $id1,

    //     );
    //     //   print_r($resulta);die;
    //     $this->db->insert('programacion.inf_enviada', $resulta);

    //     $data1 = array(
    //         'estatus' => '2', // se puede reprogramar y rendir 
    //         'id_usuario' => $this->session->userdata('id_user'),
    //         'date_sending' => date('Y-m-d h:i:s')
    //     );
    //     $this->db->where('id_programacion', $data['id']);
    //     $update = $this->db->update('programacion.programacion', $data1);
    //     return true;
    // }
    public function enviar_snc($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5)
    {
        $this->db->select('anio');
        $this->db->where('id_programacion', $data['id']);
        $query1 = $this->db->get('programacion.programacion');
        $response4 = $query1->row_array();
        $id1 = $response4['anio'] + 0;

        // Valores iniciales ACC
        $id_obj_comr_obra_a = 0;
        $precio_total_obra_a = 0;
        $porcentaje_obra_a = 0;
        $id_obj_comr_bien_a = 0;
        $precio_total_bien_a = 0;
        $porcentaje_bien_a = 0;
        $id_obj_comr_serv_a = 0;
        $precio_total_serv_a = 0;
        $porcentaje_serv_a = 0;
        $total_acc = 0;

        if ($data2 != '') {
            foreach ($data2 as $d2) {
                if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == '3') {
                    $id_obj_comr_obra_a = $d2->id_obj_comercial;
                    $precio_total_obra_a = number_format($d2->precio_total, 2, ",", ".");
                    foreach ($data3 as $d3) {
                        $porcentaje_obra_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 1) {
                    $id_obj_comr_bien_a = $d2->id_obj_comercial;
                    $precio_total_bien_a = number_format($d2->precio_total, 2, ",", ".");
                    foreach ($data3 as $d3) {
                        $porcentaje_bien_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 2) {
                    $id_obj_comr_serv_a = $d2->id_obj_comercial;
                    $precio_total_serv_a = number_format($d2->precio_total, 2, ",", ".");
                    foreach ($data3 as $d3) {
                        $porcentaje_serv_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                }
            }
            foreach ($data3 as $total_ass) {
                $total_acc = $total_ass->precio_total;
            }
        }

        // Valores iniciales PROY
        $id_obj_comr_obra_p = 0;
        $precio_total_obra_p = 0;
        $porcentaje_obra_p = 0;
        $id_obj_comr_bien_p = 0;
        $precio_total_bien_p = 0;
        $porcentaje_bien_p = 0;
        $id_obj_comr_serv_p = 0;
        $precio_total_serv_p = 0;
        $porcentaje_serv_p = 0;
        $total_proy = 0;

        if ($data4 != '') {
            foreach ($data4 as $d) {
                if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 3) {
                    $id_obj_comr_obra_p = $d->id_obj_comercial;
                    $precio_total_obra_p = number_format($d->precio_total, 2, ",", ".");
                    foreach ($data5 as $d3) {
                        $porcentaje_obra_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 1) {
                    $id_obj_comr_bien_p = $d->id_obj_comercial;
                    $precio_total_bien_p = number_format($d->precio_total, 2, ",", ".");
                    foreach ($data5 as $d3) {
                        $porcentaje_bien_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 2) {
                    $id_obj_comr_serv_p = $d->id_obj_comercial;
                    $precio_total_serv_p = number_format($d->precio_total, 2, ",", ".");
                    foreach ($data5 as $d3) {
                        $porcentaje_serv_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                }
            }
            foreach ($data5 as $total_ass) {
                $total_proy = $total_ass->precio_total_py;
            }
        }

        // 🚨 Validación: si no tiene cargas (ACC ni PROY) no se puede enviar
        if ($total_acc == 0 && $total_proy == 0) {
            return "no_data"; // devolvemos mensaje de error
        }

        // Datos a insertar en tabla de histórico inf_enviada
        $resulta = array(
            'id_programacion'      => $data['id'],
            'des_unidad'           => $des_unidad,
            'codigo_onapre'        => $codigo_onapre,
            'rif'                  => $rif,
            'id_p_acc_proy'        => 0,
            'id_obj_comr_obra'     => $id_obj_comr_obra_p,
            'precio_total_obra'    => $precio_total_obra_p,
            'porcentaje_obra'      => $porcentaje_obra_p,
            'id_obj_comr_bien'     => $id_obj_comr_bien_p,
            'precio_total_bien'    => $precio_total_bien_p,
            'porcentaje_bien'      => $porcentaje_bien_p,
            'id_obj_comr_serv'     => $id_obj_comr_serv_p,
            'precio_total_serv'    => $precio_total_serv_p,
            'porcentaje_serv'      => $porcentaje_serv_p,
            'total_proy'           => $total_proy,
            'id_p_acc'             => 1,
            'id_obj_comr_obra_a'   => $id_obj_comr_obra_a,
            'precio_total_obra_a'  => $precio_total_obra_a,
            'porcentaje_obra_a'    => $porcentaje_obra_a,
            'id_obj_comr_bien_a'   => $id_obj_comr_bien_a,
            'precio_total_bien_a'  => $precio_total_bien_a,
            'porcentaje_bien_a'    => $porcentaje_bien_a,
            'id_obj_comr_serv_a'   => $id_obj_comr_serv_a,
            'precio_total_serv_a'  => $precio_total_serv_a,
            'porcentaje_serv_a'    => $porcentaje_serv_a,
            'total_acc'            => $total_acc,
            'id_usuario'           => $this->session->userdata('id_user'),
            'anio'                 => $id1,
        );

        $this->db->insert('programacion.inf_enviada', $resulta);

        // Actualizar estatus de la programación
        $data1 = array(
            'estatus'      => '2',
            'id_usuario'   => $this->session->userdata('id_user'),
            'date_sending' => date('Y-m-d h:i:s')
        );
        $this->db->where('id_programacion', $data['id']);
        $this->db->update('programacion.programacion', $data1);

        return true;
    }

    //////////////////gUARDAR agregar mas items servicio proyecto
    function Guardar_mas_item_py_servicio($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_obj_comercial' => $data['id_obj_comercial'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => $data['estatus_rendi'],
            'id_proyecto' => $data['id_proyecto'],
            'id_usuario' => $data['id_usuario'],
            'id_original'           => $id1,
            'version'               => 1,
            'vigente'               => true,
            'fecha_version'         => date('Y-m-d H:i:s'),
            'usuario_version'       => $data['id_usuario']


        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {


            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc'],
                'id_original'           => $id1, // agregamos el mismo ID como original
                'version'               => 1,
                'vigente'               => true,
                'fecha_version'         => date('Y-m-d H:i:s'),
                'usuario_version'       => $data['id_usuario']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }
    /////////////////gUARDAR agregar mas items servicio obras
    function Guardar_mas_item_py_obras($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_obj_comercial' => $data['id_obj_comercial'],

            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => $data['estatus_rendi'],
            'id_proyecto' => $data['id_proyecto'],
            'id_usuario' => $this->session->userdata('id_user'),
            'id_original'           => $id1,
            'version'               => 1,
            'vigente'               => true,
            'fecha_version'         => date('Y-m-d H:i:s'),
            'usuario_version'       => $data['id_usuario']


        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {


            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc'],
                'id_original'           => $id1,
                'version'               => 1,
                'vigente'               => true,
                'fecha_version'         => date('Y-m-d H:i:s'),
                'usuario_version'       => $data['id_usuario']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }


    /////////////////reprogramacion 
    ///////////consultar años disponibles para reprogramar
    public function consultar_reprogramacion($unidad)
    {
        $this->db->select('*');
        $this->db->where('unidad', $unidad);
        $this->db->where('estatus >', 1);
        $this->db->where('estatus <', 4);

        // Opcional: Quita el $this->db->order_by() anterior para evitar conflictos

        $query = $this->db->get('programacion.programacion');
        $resultado = $query->result_array();

        // SOLUCIÓN GARANTIZADA: Ordenar el array en PHP (Numérico Descendente)
        usort($resultado, function ($a, $b) {
            // Convierte a INT y resta para ordenar DESC (b - a)
            return (int)$b['anio'] - (int)$a['anio'];
        });

        return $resultado;
    }

    //reprogrma servicio editar items
    public function Reprogrma_guardar_items_modificados_servi($id_p_items, $itm_serv, $id_programaciones)
    {

        $this->db->where('id_p_items', $id_p_items);
        // $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('programacion.p_items', $itm_serv);
        if ($update) {
            $this->db->where('id_programacion', $id_programaciones['id_programacion']);
            $update = $this->db->update('programacion.programacion', $id_programaciones);
        }
    }

    function Guardar_mas_item_acc_servicio2($data, $p_ffinanciamiento, $id_programaciones)
    {

        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;



        $this->db->where('id_programacion', $id_programaciones['id_programacion']);
        $update = $this->db->update('programacion.programacion', $id_programaciones);

        if ($update) {

            $data1 = array(
                'id_p_items'            => $id1,
                'id_enlace' => $data['id_enlace'],
                'id_p_acc' => $data['id_p_acc'],
                'id_tip_obra' => $data['id_tip_obra'],
                'id_alcance_obra' => $data['id_alcance_obra'],
                'id_obj_obra' =>  $data['id_obj_obra'],
                'fecha_desde' =>  $data['fecha_desde'],
                'fecha_hasta' => $data['fecha_hasta'],
                'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
                'id_ccnu'                 => $data['id_ccnu'],
                'especificacion'         => $data['especificacion'],
                'id_unidad_medida'          => $data['id_unidad_medida'],
                'cantidad'          => $data['cantidad'],
                'i'                   => $data['i'],
                'ii'                     => $data['ii'],
                'iii'                     => $data['iii'],
                'iv'                      => $data['iv'],
                'cant_total_distribuir'  => $data['cant_total_distribuir'],
                'precio_total'             => $data['precio_total'],
                'alicuota_iva'         => $data['alicuota_iva'],
                'iva_estimado'             => $data['iva_estimado'],
                'costo_unitario'         => $data['costo_unitario'],
                'monto_estimado'         => $data['monto_estimado'],
                'est_trim_1'          => $data['est_trim_1'],
                'est_trim_2'          => $data['est_trim_2'],
                'est_trim_3'         => $data['est_trim_3'],
                'est_trim_4'          => $data['est_trim_4'],
                'estimado_total_t_acc' => $data['estimado_total_t_acc'],
                'estatus_rendi' => $data['estatus_rendi'],
                'reprogramado' => $data['reprogramado'],
                'fecha_reprogramacion' => $data['fecha_reprogramacion'],
                'id_proyecto' => $data['id_proyecto'],
                'id_obj_comercial' => $data['id_obj_comercial'],

                'observaciones' => $data['observaciones'],

            );
            $quers = $this->db->insert("programacion.p_items", $data1);
            // $this->db->insert('programacion.p_items',$data);

            // $id = $id1;

            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
            //     }
        }
    }


    ///////////////////////////////consultar items para modal rendir servicios
    public function consultar_items_servicio_acc_rendir($data)
    {
        $this->db->select(
            'm.id_p_items,
                             m.id_enlace,
                             m.id_partidad_presupuestaria,
                             m.id_ccnu,
                             m.id_tip_obra, m.id_alcance_obra, m.id_obj_obra,
                             m.especificacion,
                             m.id_unidad_medida,
                             m.cantidad,
                             m.i,
                             m.ii,
                             m.iii,
                             m.iv,
                             m.cant_total_distribuir,
                             m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                             m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                             m.fecha_desde,
                             m.fecha_hasta,
                             pp.codigopartida_presupuestaria,
                             pp.desc_partida_presupuestaria,
                             cc.codigo_ccnu,
                             cc.desc_ccnu,
                             un.desc_unidad_medida,
                             pcc.id_accion_centralizada,
                             pcc.id_obj_comercial,
                             pcc.id_programacion,
                             ff.id_estado,
                             ff.id_fuente_financiamiento,
                             ff.porcentaje,
                             fr.desc_fuente_financiamiento,
                             ac.desc_accion_centralizada,
                             ob.desc_objeto_contrata,
                             re.trimestre,
                             tr.descripcion_trimestre,
                             tpo.descripcion_tip_obr,
                             al.descripcion_alcance_obra,
                             obj.descripcion_obj_obra
                             '
        );
        $this->db->from('programacion.p_items m');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.p_acc_centralizada pcc', 'pcc.id_p_acc_centralizada = m.id_enlace', 'left');

        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento fr', 'fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');

        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pcc.id_accion_centralizada', 'left');

        $this->db->join('programacion.objeto_contrata ob', 'ob.id_objeto_contrata = pcc.id_obj_comercial', 'left');
        $this->db->join('programacion.rendidicion re', 're.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = re.trimestre', 'left');
        $this->db->join('programacion.tip_obra tpo', 'tpo.id_tip_obra = m.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra al', 'al.id_alcance_obra = m.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra obj', 'obj.id_obj_obra = m.id_obj_obra', 'left');
        $this->db->where('m.id_p_items', $data['id_p_items']);
        // $this->db->order_by('mc.id_p_items desc');
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }




    function guardar_rendi_servicio_acc($data, $id_p_itemss)
    {
        $this->db->select('max(e.id_rendicion) as id1');
        $query1 = $this->db->get('programacion.rendidicion e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $unid_m_s = $data['facturacion5'];
        if ($unid_m_s == 2) {
            $datefactura_rendi = date("Y-m-d");
            $fecha_pago_rendi = date("Y-m-d");
            //   $fecha_pago_rendi = date("Y-m-d");
            $subtotal_rendi_factura = 0;
            $monto_factura_rend = 0;
            $total_pago_rendi = 0;
            $paridad_rendi_factura = 0;
        } else {
            $datefactura_rendi = $data['datefactura_rendi'];
            $fecha_pago_rendi = $data['fecha_pago_rendi'];
            $subtotal_rendi_factura = $data['subtotal_rendi_factura'];
            $monto_factura_rend = $data['monto_factura_rend'];
            $total_pago_rendi = $data['total_pago_rendi'];
            $paridad_rendi_factura = $data['paridad_rendi_factura'];
        }
        $rif_contrat = $data['sel_rif_nombre'];
        if ($rif_contrat == '') {

            $sel_rif_nombre = 0;
            $exit_rnc = 0;
            $nombre_contratista = 0;
        } else {

            $sel_rif_nombre = $data['sel_rif_nombre'];
            $nombre_contratista = $data['nombre_contratista'];
            $exit_rnc = 1;
        }
        $data1 = array(
            'id_rendicion'            => $id1,
            'rif_organoente' => $data['rif_organoente'],
            'id_programacion' => $data['id_programacion'],
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_proyecto' => $data['id_proyecto'],
            'nombre_proyecto' => $data['nombre_proyecto'],

            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' => $data['id_obj_obra'],
            'codigopartida_presupuestaria' => $data['codigopartida_presupuestaria'],
            'id_p_items' => $data['id_p_items'],
            'desc_partida_presupuestaria' => $data['desc_partida_presupuestaria'],
            'codigo_ccnu' => $data['codigo_ccnu'],
            'desc_ccnu' => $data['desc_ccnu'],
            'id_accion_centralizada' => $data['id_accion_centralizada'],
            'desc_accion_centralizada' => $data['desc_accion_centralizada'],
            'id_obj_comercial' => $data['id_obj_comercial'],
            'desc_objeto_contrata' => $data['desc_objeto_contrata'],
            'estado' => $data['estado'],
            'id_fuente_financiamiento' => $data['id_fuente_financiamiento'],
            'desc_fuente_financiamiento' => $data['desc_fuente_financiamiento'],
            'fecha_desde'         => $data['fecha_desde'],
            'fecha_hasta'         => $data['fecha_hasta'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => 0,
            'costo_unitario'             => $data['costo_unitario'],

            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],

            'cantidad_ejecu' => $data['cantidad_ejecu'],
            'costo_unitario_rend_ejecu' => $data['costo_unitario_rend_ejecu'],
            'subtotal_rend_ejecu' => $data['subtotal_rend_ejecu'],
            'selc_iva_rendi' => $data['selc_iva_rendi'],
            'iva_estimado_rend' => $data['iva_estimado_rend'],
            'total_rendi' => $data['total_rendi'],
            'paridad_rendi' => $data['paridad_rendi'],
            'subtotal_rendiusdt' => $data['subtotal_rendiusdt'],
            'id_modalida_rendi' => $data['id_modalida_rendi'],
            'supuestos_procedimiento' => $data['supuestos_procedimiento'],

            'sel_rif_nombre' => $sel_rif_nombre,

            'nombre_contratista' => $nombre_contratista,

            'num_contrato' => $data['num_contrato'],
            'fecha_contrato' => $data['fecha_contrato'],
            'selc_tipo_doc_contrata' => $data['selc_tipo_doc_contrata'],
            'selc_com_res_social' => $data['selc_com_res_social'],
            'monto3_rendim' => $data['monto3_rendim'],
            'nfactura_rendi' => $data['nfactura_rendi'],
            'datefactura_rendi' => $datefactura_rendi,
            'base_imponible_rendi' => $data['base_imponible_rendi'],
            'selc_iva_rendi2' => $data['selc_iva_rendi2'],

            'monto_factura_rend' => $monto_factura_rend,
            'total_pago_rendi' => $data['total_pago_rendi'],
            'paridad_rendi_factura' => $paridad_rendi_factura,
            'subtotal_rendi_factura' => $subtotal_rendi_factura,
            'fecha_pago_rendi' => $fecha_pago_rendi,
            'estatus' => $data['estatus'],
            'fecha_rendicion' => $data['fecha_rendicion'],
            'fecha_cam_estatus' => $data['fecha_cam_estatus'],
            'id_usuario' => $data['id_usuario'],
            'fecha30dias_notificacion' => $data['fecha30dias_notificacion'],
            'trimestre' => $data['trimestre'],
            'snc' => 0,
            'razon_social_no_rnc' => $data['razon_social_no_rnc'],

            'rif_contr_no_rnc' => $data['rif_contr_no_rnc'],
            'exit_rnc' =>  $exit_rnc,

            //'id_unidad_medida'           => $id_unidad_medida,

        );

        $query = $this->db->insert('programacion.rendidicion', $data1);
        if ($query) {
            $this->db->where('id_p_items', $data['id_p_items']);
            $update = $this->db->update('programacion.p_items', $id_p_itemss);
            return 1;
        } else {
            return 0;
        }
    }

    function rendir_serv_acc($id_p_acc_centralizada)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pi2.estatus_rendi,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada,
                               ');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.p_acc_centralizada p', 'p.id_p_acc_centralizada = pi2.id_enlace'); // esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.i  >', 0);
        $this->db->where('pi2.estatus_rendi  <', 4);
        $this->db->where('pi2.id_p_acc', 1);
        $this->db->from('programacion.primerotrimestre pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    function rendir_serv_acc2($id_p_acc_centralizada)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pi2.estatus_rendi,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada,
                               ');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.p_acc_centralizada p', 'p.id_p_acc_centralizada = pi2.id_enlace'); // esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.ii  >', 0);
        $this->db->where('pi2.estatus_rendi  <', 4);
        $this->db->where('pi2.id_p_acc', 1);
        $this->db->from('programacion.segundotrimestre pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    function rendir_serv_acc3($id_p_acc_centralizada)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pi2.estatus_rendi,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada,
                               ');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.p_acc_centralizada p', 'p.id_p_acc_centralizada = pi2.id_enlace'); // esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.iii  >', 0);
        $this->db->where('pi2.estatus_rendi  <', 4);
        $this->db->where('pi2.id_p_acc', 1);
        $this->db->from('programacion.tercerotrimestre pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    function rendir_serv_acc4($id_p_acc_centralizada)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pi2.estatus_rendi,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada,
                               ');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.p_acc_centralizada p', 'p.id_p_acc_centralizada = pi2.id_enlace'); // esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.iv  >', 0);
        $this->db->where('pi2.estatus_rendi  <', 4);
        $this->db->where('pi2.id_p_acc', 1);
        $this->db->from('programacion.cuartotrimestre pi2');
        $query = $this->db->get();
        return $query->result_array();
    }
    ////////////////////editar items py obras
    public function editar_fila_py_obra($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        $pp_s = $data['camb_tipo_obra'];
        if ($pp_s == 0) {
            $id_tip_obra = $data['tipo_obra'];
        } else {
            $id_tip_obra = $data['camb_tipo_obra'];
        }

        $ccnu_s = $data['camb_id_alcance_obra'];
        if ($ccnu_s == 0) {
            $id_alcance_obra = $data['alcance_obra'];
        } else {
            $id_alcance_obra = $data['camb_id_alcance_obra'];
        }
        $alcance = $data['camb_id_obj_obra'];
        if ($alcance == 0) {
            $obj_obra = $data['obj_obra'];
        } else {
            $obj_obra = $data['camb_id_obj_obra'];
        }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            'id_tip_obra' => $id_tip_obra,
            'id_alcance_obra'                    => $id_alcance_obra,
            'id_obj_obra'                    => $obj_obra,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'             => $data['estimado_total_t_acc'],

        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }

    ////////////////////reprogramar modal items acc obras
    public function reprogramar_fila_acc_obra($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        $pp_s = $data['camb_tipo_obra'];
        if ($pp_s == 0) {
            $id_tip_obra = $data['tipo_obra'];
        } else {
            $id_tip_obra = $data['camb_tipo_obra'];
        }

        $ff1 = $data['sel_camb_ff1'];
        if ($ff1 == 0) {
            $id_ff = $data['ff'];
        } else {
            $id_ff = $data['sel_camb_ff1'];
        }

        $ccnu_s = $data['camb_id_alcance_obra'];
        if ($ccnu_s == 0) {
            $id_alcance_obra = $data['alcance_obra'];
        } else {
            $id_alcance_obra = $data['camb_id_alcance_obra'];
        }
        $alcance = $data['camb_id_obj_obra'];
        if ($alcance == 0) {
            $obj_obra = $data['obj_obra'];
        } else {
            $obj_obra = $data['camb_id_obj_obra'];
        }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            'id_tip_obra' => $id_tip_obra,
            'id_alcance_obra'                    => $id_alcance_obra,
            'id_obj_obra'                    => $obj_obra,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'             => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),
            'observaciones'             => $data['observaciones'],



        );
        $update = $this->db->update('programacion.p_items', $data1);
        if ($update) {

            $this->db->where('id_p_items', $data['id_items_proy']);
            $data3 = array(

                'id_fuente_financiamiento'           => $id_ff,
                // 'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                //   'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],

            );
            //$this->db->insert('programacion.p_ffinanciamiento', $data3);
            $update = $this->db->update('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }

    ////////////////////reprogramar modal items acc servi
    public function reprogramar_fila_acc_serv($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $ff1 = $data['sel_camb_ff1'];
        if ($ff1 == 0) {
            $id_ff = $data['ff'];
        } else {
            $id_ff = $data['sel_camb_ff1'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            //  'id_tip_obra' => $id_tip_obra,
            //  'id_alcance_obra'                    => $id_alcance_obra,
            //  'id_obj_obra'                    => $obj_obra,
            'especificacion'             => $data['especificacion'],
            'fecha_hasta'             => $data['fecha_hasta1'],
            'fecha_desde'             => $data['fecha_desde1'],

            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'             => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),
            'observaciones' => $data['observaciones'],



        );
        $update = $this->db->update('programacion.p_items', $data1);
        if ($update) {

            $this->db->where('id_p_items', $data['id_items_proy']);
            $data3 = array(

                'id_fuente_financiamiento'           => $id_ff,
                // 'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                //   'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],

            );
            //$this->db->insert('programacion.p_ffinanciamiento', $data3);
            $update = $this->db->update('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }

    //////////////////gUARDAR agregar mas items Obras  acc

    function Guardar_repro_item_acc_obra($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),
            'id_proyecto' => $data['id_proyecto'],
            'id_obj_comercial' => $data['id_obj_comercial'],
            'observaciones' => $data['observaciones'],
            'id_usuario' => $data['id_usuario'],




        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {
            $id = $id;

            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }

    ///////////reprogramar py bienes modal
    public function reprogramar_fila_ip_bien_proyecto($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        // $pp_s = $data['selc_part_pres'];
        // if ($pp_s == 0) {
        //     $id_partidad_presupuestaria = $data['partida_pre'];
        // }else {
        //     $id_partidad_presupuestaria = $data['selc_part_pres'];
        // }

        // $ccnu_s = $data['sel_ccnu'];
        // if ($ccnu_s == 0) {
        //     $id_ccnu = $data['ccnu'];
        // }else {
        //     $id_ccnu = $data['sel_ccnu'];
        // }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            // 'id_partidad_presupuestaria' => $data['partida_pre'],
            // 'id_ccnu'                    => $id_ccnu,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'             => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),

        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }
    ////////////////////////reprogramo proyecto mas items a BIENES///////////////////
    function Guardar_reprogramacion_item_bienes_py($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),
            'id_proyecto' => $data['id_proyecto'],
            'id_obj_comercial' => $data['id_obj_comercial'],


        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {
            $id = $id;

            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }

    ////////////////////reprogramar modal items proyecto obras
    public function Repro_modal_py_obra($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        $pp_s = $data['camb_tipo_obra'];
        if ($pp_s == 0) {
            $id_tip_obra = $data['tipo_obra'];
        } else {
            $id_tip_obra = $data['camb_tipo_obra'];
        }

        $ccnu_s = $data['camb_id_alcance_obra'];
        if ($ccnu_s == 0) {
            $id_alcance_obra = $data['alcance_obra'];
        } else {
            $id_alcance_obra = $data['camb_id_alcance_obra'];
        }
        $alcance = $data['camb_id_obj_obra'];
        if ($alcance == 0) {
            $obj_obra = $data['obj_obra'];
        } else {
            $obj_obra = $data['camb_id_obj_obra'];
        }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            'id_tip_obra' => $id_tip_obra,
            'id_alcance_obra'                    => $id_alcance_obra,
            'id_obj_obra'                    => $obj_obra,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'             => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),
            'observaciones'             => $data['observaciones'],



        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }
    function Repro_py_obra($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),
            'id_proyecto' => $data['id_proyecto'],
            'id_obj_comercial' => $data['id_obj_comercial'],
            'observaciones' => $data['observaciones'],
            'id_usuario' => $data['id_usuario'],


        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {
            $id = $id;

            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }
    function Repro_py_servicio($data, $p_ffinanciamiento)
    {
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id_p_items'            => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' =>  $data['id_obj_obra'],
            'fecha_desde' =>  $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
            'id_ccnu'                 => $data['id_ccnu'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => $data['cant_total_distribuir'],
            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'costo_unitario'         => $data['costo_unitario'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),
            'id_proyecto' => $data['id_proyecto'],
            'id_obj_comercial' => $data['id_obj_comercial'],




        );
        $quers = $this->db->insert("programacion.p_items", $data1);
        // $this->db->insert('programacion.p_items',$data);
        if ($quers) {


            $data3 = array(
                'id_p_items'    => $id1,
                'id_estado'                   => $p_ffinanciamiento['id_estado'],
                'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
                'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
                'porcentaje'                => $p_ffinanciamiento['porcentaje'],
                'id_enlace' => $p_ffinanciamiento['id_enlace'],
                'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;
        }
    }
    ////////////////////reprogramar Guardar modal items proyecto sericio 
    public function Repro_modal_py_servicios($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            'id_tip_obra' => 0,
            'id_alcance_obra'                    => 0,
            'id_obj_obra'                    => 0,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'   => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),


        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }
    ////////////////////editar Guardar modal items proyecto sericio 
    public function edit_modal_py_servicios($data)
    {

        $this->db->where('id_p_items', $data['id_items_proy']);

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        } else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        } else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
            'id_tip_obra' => 0,
            'id_alcance_obra'                    => 0,
            'id_obj_obra'                    => 0,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => 1,
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'   => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 0,
            'fecha_reprogramacion' => date('Y-m-d'),


        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }
    ///////////////pruebas
    public function consultar_items_servicio_acc_rendir5($data)
    {
        $this->db->select(
            'm.id_p_items,
                         m.id_enlace,
                         m.id_partidad_presupuestaria,
                         m.id_ccnu,
                         m.especificacion,
                         m.id_unidad_medida,
                         m.cantidad,
                         m.i,
                         m.ii,
                         m.iii,
                         m.iv,
                         m.cant_total_distribuir,
                         m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                         m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                         m.fecha_desde,
                         m.fecha_hasta,
                         pp.codigopartida_presupuestaria,
                         pp.desc_partida_presupuestaria,
                         cc.codigo_ccnu,
                         cc.desc_ccnu,
                         un.desc_unidad_medida,
                         pcc.id_accion_centralizada,
                         pcc.id_obj_comercial,
                         pcc.id_programacion,
                         ff.id_estado,
                         ff.id_fuente_financiamiento,
                         ff.porcentaje,
                         fr.desc_fuente_financiamiento,
                         ac.desc_accion_centralizada,
                         ob.desc_objeto_contrata,
                         re.trimestre,
                         tr.descripcion_trimestre
                         '
        );
        $this->db->from('programacion.p_items m');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.p_acc_centralizada pcc', 'pcc.id_p_acc_centralizada = m.id_enlace', 'left');
        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento fr', 'fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');
        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pcc.id_accion_centralizada', 'left');
        $this->db->join('programacion.objeto_contrata ob', 'ob.id_objeto_contrata = pcc.id_obj_comercial', 'left');
        $this->db->join('programacion.rendidicion re', 're.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = re.trimestre', 'left');
        $this->db->where('m.id_p_items', $data['id_p_items']);
        // $this->db->order_by('mc.id_p_items desc');
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }

    public function consultar_acc_centralizada5($id_programacion)
    {
        $this->db->select('pac.id_p_acc_centralizada,
                       pac.id_programacion,
                       pac.id_accion_centralizada,
                       p.estatus,
                       ac.desc_accion_centralizada,
                       pac.id_obj_comercial,
                       oc.desc_objeto_contrata,
                       ip.id_ccnu,
                       ip.id_p_items,
                       ip.estatus_rendi,
                       ip.id_partidad_presupuestaria,
                       pp.codigopartida_presupuestaria,
                       pp.desc_partida_presupuestaria,
                       cc.codigo_ccnu,
                         cc.desc_ccnu,');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
        $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
        $this->db->join('programacion.p_items ip', 'ip.id_enlace = pac.id_p_acc_centralizada');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = ip.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = ip.id_ccnu', 'left');
        $this->db->where('pac.id_programacion', $id_programacion);
        $this->db->from('programacion.p_acc_centralizada pac');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function consultar_acc_centralizada_pimertimetre($id_programacion)
    {
        $this->db->select('pac.id_p_acc_centralizada,
                       pac.id_programacion,
                       pac.id_accion_centralizada,
                       p.estatus,
                       ac.desc_accion_centralizada,
                       pac.id_obj_comercial,
                       oc.desc_objeto_contrata,
                       ip.id_ccnu,
                       ip.id_p_items,
                       ip.estatus_rendi,
                       ip.id_partidad_presupuestaria,
                       ip.especificacion,
                       pp.codigopartida_presupuestaria,
                       pp.desc_partida_presupuestaria,
                       cc.codigo_ccnu,
                         cc.desc_ccnu,');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
        $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
        $this->db->join('programacion.primerotrimestre1 ip', 'ip.id_enlace = pac.id_p_acc_centralizada');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = ip.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = ip.id_ccnu', 'left');
        $this->db->where('ip.id_proyecto', $id_programacion);
        $this->db->where('ip.id_p_acc', 1);

        $this->db->from('programacion.p_acc_centralizada pac');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function consultar_acc_centralizada_pimertimetre1($id_programacion)
    {
        $this->db->select('pac.id_p_acc_centralizada,
                       pac.id_programacion,
                       pac.id_accion_centralizada,
                       p.estatus,
                       ac.desc_accion_centralizada,
                       pac.id_obj_comercial,
                       oc.desc_objeto_contrata,
                       ip.id_ccnu,
                       ip.id_p_items,
                       ip.estatus_rendi,
                       ip.id_partidad_presupuestaria,
                       ip.especificacion,
                       pp.codigopartida_presupuestaria,
                       pp.desc_partida_presupuestaria,
                       cc.codigo_ccnu,
                         cc.desc_ccnu,');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
        $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
        $this->db->join('programacion.primerotrimestre1 ip', 'ip.id_enlace = pac.id_p_acc_centralizada');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = ip.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = ip.id_ccnu', 'left');
        $this->db->where('ip.id_proyecto', $id_programacion);
        $this->db->where('ip.id_p_acc', 1);

        $this->db->from('programacion.p_acc_centralizada pac');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function consultar_proyectos55($id_programacion)
    {
        $this->db->select('pp.id_p_proyecto,
                       pp.nombre_proyecto,
                       pp.id_programacion,
                       pp.id_obj_comercial,
                       p.estatus,
                       oc.desc_objeto_contrata,
                       ip.id_ccnu,
                       ip.id_p_items,
                       ip.id_partidad_presupuestaria,
                       pt.codigopartida_presupuestaria,
                       pt.desc_partida_presupuestaria,
                       cc.codigo_ccnu,
                        cc.desc_ccnu,');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
        $this->db->join('programacion.programacion p', 'p.id_programacion = pp.id_programacion');
        $this->db->join('programacion.p_items ip', 'ip.id_enlace = pp.id_p_proyecto');

        $this->db->join('programacion.partida_presupuestaria pt', 'pt.id_partida_presupuestaria = ip.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = ip.id_ccnu', 'left');
        $this->db->where('pp.id_programacion', $id_programacion);
        $this->db->from('programacion.p_proyecto pp');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function consultar_proyectos555($id_programacion)
    {
        $this->db->select('pp.id_p_proyecto,
                       pp.nombre_proyecto,
                       pp.id_programacion,
                       pp.id_obj_comercial,
                       p.estatus,
                       oc.desc_objeto_contrata,
                       ip.id_ccnu,
                       ip.id_p_items,
                       ip.id_p_acc,
                       ip.id_partidad_presupuestaria,
                       pt.codigopartida_presupuestaria,
                       pt.desc_partida_presupuestaria,
                       cc.codigo_ccnu,
                        cc.desc_ccnu,');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
        $this->db->join('programacion.programacion p', 'p.id_programacion = pp.id_programacion');
        $this->db->join('programacion.p_items ip', 'ip.id_enlace = pp.id_p_proyecto');

        $this->db->join('programacion.partida_presupuestaria pt', 'pt.id_partida_presupuestaria = ip.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = ip.id_ccnu', 'left');
        $this->db->where('pp.id_programacion', $id_programacion);
        $this->db->where('ip.id_p_acc', 0);
        $this->db->from('programacion.p_proyecto pp');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function consultar_proyectos_primero($id_programacion)
    {
        $this->db->select('pp.id_p_proyecto,
        pp.nombre_proyecto,
        pp.id_programacion,
        pp.id_obj_comercial,
        p.estatus,
        oc.desc_objeto_contrata,
        ip.id_ccnu,
        ip.id_p_items,
        ip.id_p_acc,
        ip.id_partidad_presupuestaria,
        pt.codigopartida_presupuestaria,
        pt.desc_partida_presupuestaria,
        cc.codigo_ccnu,
        cc.desc_ccnu,');
        $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
        $this->db->join('programacion.programacion p', 'p.id_programacion = pp.id_programacion');
        $this->db->join('programacion.primerotrimestre1 ip', 'ip.id_enlace = pp.id_p_proyecto');
        $this->db->join('programacion.partida_presupuestaria pt', 'pt.id_partida_presupuestaria = ip.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = ip.id_ccnu', 'left');
        $this->db->where('pp.id_programacion', $id_programacion);
        $this->db->where('ip.id_p_acc', 0);
        $this->db->from('programacion.p_proyecto pp');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function consultar_item_modal_PY_bienes($data)
    {
        $this->db->select(
            'm.id_p_items,
                         m.id_enlace,
                         m.id_partidad_presupuestaria,
                         m.id_ccnu,
                         m.id_tip_obra, m.id_alcance_obra, m.id_obj_obra,
                         m.especificacion,
                         m.id_unidad_medida,
                         m.cantidad,
                         m.i,
                         m.ii,
                         m.iii,
                         m.iv,
                         m.cant_total_distribuir,
                         m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                         m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                         m.fecha_desde,
                         m.fecha_hasta,
                         pp.codigopartida_presupuestaria,
                         pp.desc_partida_presupuestaria,
                         cc.codigo_ccnu,
                         cc.desc_ccnu,
                         un.desc_unidad_medida,
                         pcc.id_programacion, pcc.nombre_proyecto, pcc.id_obj_comercial ,
                         ff.id_estado,
                         ff.id_fuente_financiamiento,
                         ff.porcentaje,
                         fr.desc_fuente_financiamiento,
                       
                         ob.desc_objeto_contrata,
                         re.trimestre,
                         tr.descripcion_trimestre,
                         tpo.descripcion_tip_obr,
                         al.descripcion_alcance_obra,
                         obj.descripcion_obj_obra
                         '
        );
        $this->db->from('programacion.p_items m');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.p_proyecto pcc', 'pcc.id_p_proyecto = m.id_enlace', 'left');


        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento fr', 'fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');

        $this->db->join('programacion.objeto_contrata ob', 'ob.id_objeto_contrata = pcc.id_obj_comercial', 'left');
        $this->db->join('programacion.rendidicion re', 're.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = re.trimestre', 'left');
        $this->db->join('programacion.tip_obra tpo', 'tpo.id_tip_obra = m.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra al', 'al.id_alcance_obra = m.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra obj', 'obj.id_obj_obra = m.id_obj_obra', 'left');
        $this->db->where('m.id_p_items', $data['id_p_items']);
        // $this->db->order_by('mc.id_p_items desc');
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }


    ////////////////////////guardar rendir proyecto bienes
    function guardar_rendi_bienes_py($data, $id_p_itemss)
    {
        $this->db->select('max(e.id_rendicion) as id1');
        $query1 = $this->db->get('programacion.rendidicion e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;
        $unid_m_s = $data['facturacion5'];
        if ($unid_m_s == 2) {
            $datefactura_rendi = date("Y-m-d");
            $fecha_pago_rendi = date("Y-m-d");
            // $fecha_pago_rendi = date("Y-m-d");
            $subtotal_rendi_factura = 0;
            $monto_factura_rend = 0;
            $total_pago_rendi = 0;
            $paridad_rendi_factura = 0;
        } else {
            $datefactura_rendi = $data['datefactura_rendi'];
            $datefactura_rendi = $data['fecha_pago_rendi'];
            $subtotal_rendi_factura = $data['subtotal_rendi_factura'];
            $monto_factura_rend = $data['monto_factura_rend'];
            $total_pago_rendi = $data['total_pago_rendi'];
            $paridad_rendi_factura = $data['paridad_rendi_factura'];
        }
        $rif_contrat = $data['sel_rif_nombre'];
        if ($rif_contrat == '') {

            $sel_rif_nombre = 0;
            $exit_rnc = 0;
            $nombre_contratista = 0;
        } else {

            $sel_rif_nombre = $data['sel_rif_nombre'];
            $nombre_contratista = $data['nombre_contratista'];
            $exit_rnc = 1;
        }
        $data1 = array(
            'id_rendicion'            => $id1,
            'rif_organoente' => $data['rif_organoente'],
            'id_programacion' => $data['id_programacion'],
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_proyecto' => $data['id_proyecto'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' => $data['id_obj_obra'],
            'codigopartida_presupuestaria' => $data['codigopartida_presupuestaria'],
            'id_p_items' => $data['id_p_items'],
            'desc_partida_presupuestaria' => $data['desc_partida_presupuestaria'],
            'codigo_ccnu' => $data['codigo_ccnu'],
            'desc_ccnu' => $data['desc_ccnu'],
            'id_accion_centralizada' => 0,
            'desc_accion_centralizada' => 0,
            'id_obj_comercial' => $data['id_obj_comercial'],
            'desc_objeto_contrata' => $data['desc_objeto_contrata'],
            'estado' => $data['estado'],
            'id_fuente_financiamiento' => $data['id_fuente_financiamiento'],
            'desc_fuente_financiamiento' => $data['desc_fuente_financiamiento'],
            'porcentaje' => $data['porcentaje'],
            'fecha_desde'         => $data['fecha_desde'],
            'fecha_hasta'         => $data['fecha_hasta'],
            'especificacion'         => $data['especificacion'],
            'id_unidad_medida'          => $data['id_unidad_medida'],
            'cantidad'          => $data['cantidad'],
            'i'                   => $data['i'],
            'ii'                     => $data['ii'],
            'iii'                     => $data['iii'],
            'iv'                      => $data['iv'],
            'cant_total_distribuir'  => 0,
            'costo_unitario'             => $data['costo_unitario'],

            'precio_total'             => $data['precio_total'],
            'alicuota_iva'         => $data['alicuota_iva'],
            'iva_estimado'             => $data['iva_estimado'],
            'monto_estimado'         => $data['monto_estimado'],
            'est_trim_1'          => $data['est_trim_1'],
            'est_trim_2'          => $data['est_trim_2'],
            'est_trim_3'         => $data['est_trim_3'],
            'est_trim_4'          => $data['est_trim_4'],
            'estimado_total_t_acc' => $data['estimado_total_t_acc'],
            'cantidad_ejecu' => $data['cantidad_ejecu'],

            'costo_unitario_rend_ejecu' => $data['costo_unitario_rend_ejecu'],
            'precio_rend_ejecu' => $data['precio_rend_ejecu'],
            'selc_iva_rendi' => $data['selc_iva_rendi'],
            'iva_estimado_rend' => $data['iva_estimado_rend'],
            'total_rendi' => $data['total_rendi'],
            'paridad_rendi' => $data['paridad_rendi'],
            'subtotal_rendi' => $data['subtotal_rendi'],
            'id_modalida_rendi' => $data['id_modalida_rendi'],
            'supuestos_procedimiento' => $data['supuestos_procedimiento'],

            'sel_rif_nombre' => $sel_rif_nombre,
            'nombre_contratista' => $nombre_contratista,
            'num_contrato' => $data['num_contrato'],
            'fecha_contrato' => $data['fecha_contrato'],
            'selc_tipo_doc_contrata' => $data['selc_tipo_doc_contrata'],
            'selc_com_res_social' => $data['selc_com_res_social'],
            'monto3_rendim' => $data['monto3_rendim'],
            'nfactura_rendi' => $data['nfactura_rendi'],
            'datefactura_rendi' => $datefactura_rendi,

            'base_imponible_rendi' => $data['base_imponible_rendi'],
            'selc_iva_rendi2' => $data['selc_iva_rendi2'],
            'monto_factura_rend' => $monto_factura_rend,

            'total_pago_rendi' => $data['total_pago_rendi'],
            'paridad_rendi_factura' => $paridad_rendi_factura,
            'subtotal_rendi_factura' => $subtotal_rendi_factura,
            'fecha_pago_rendi' => $fecha_pago_rendi,

            'estatus' => $data['estatus'],
            'fecha_rendicion' => $data['fecha_rendicion'],
            'fecha_cam_estatus' => $data['fecha_cam_estatus'],
            'id_usuario' => $data['id_usuario'],
            'fecha30dias_notificacion' => $data['fecha30dias_notificacion'],
            'trimestre' => $data['trimestre'],
            'snc' => 0,
            'razon_social_no_rnc' => $data['razon_social_no_rnc'],

            'rif_contr_no_rnc' => $data['rif_contr_no_rnc'],
            'exit_rnc' =>  $exit_rnc,

        );
        $query = $this->db->insert('programacion.rendidicion', $data1);
        if ($query) {
            $this->db->where('id_p_items', $data['id_p_items']);
            $update = $this->db->update('programacion.p_items', $id_p_itemss);
        }
        return true;
    }

    public function pdf_rendir($data1)
    {
        $query = $this->db->query("SELECT * 
    
    
    FROM programacion.rendidicion where id_programacion = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    public function rendir($id_programacion)
    {
        $this->db->select('pac.*,
    cc.descripcion,
    ti.desc_tipo_doc_contrata,
    se.desc_comp_resp_social, tr.descripcion_trimestre
    ');
        $this->db->join('evaluacion_desempenio.modalidad cc', 'cc.id = pac.id_modalida_rendi', 'left');
        $this->db->join('programacion.tipo_doc_contrata ti', 'ti.id_tipo_doc_contrata = pac.selc_tipo_doc_contrata', 'left');
        $this->db->join('programacion.comp_resp_social se', 'se.id_comp_resp_social = pac.selc_com_res_social', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = pac.trimestre', 'left');


        $this->db->where('pac.id_programacion', $id_programacion);
        $query = $this->db->get('programacion.rendidicion pac');
        return $query->result_array();
        // return $query->result_array();
    }
    function consulta_item_edit($data)
    { //mostrar para editar informacion de la facturacion de la rendicion

        $this->db->select('pi2.nfactura_rendi,   pi2.datefactura_rendi, pi2.base_imponible_rendi, pi2.selc_iva_rendi2, pi2.monto_factura_rend,
                                    pi2.total_pago_rendi, pi2.paridad_rendi_factura, pi2.subtotal_rendi_factura,  pi2.selc_com_res_social ,pi2.monto3_rendim,
                                     pi2.fecha_pago_rendi, se.desc_comp_resp_social');
        $this->db->join('programacion.comp_resp_social se', 'se.id_comp_resp_social = pi2.selc_com_res_social', 'left');
        $this->db->where('pi2.id_rendicion', $data['id_rendicion']);
        $this->db->from('programacion.rendidicion pi2');
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }
    public function editar_informacion_factura($data)
    {  // edita la informacion  de la facturacion de la rendicion

        $this->db->where('id_rendicion', $data['id_rendiciones']);
        $academico = $data['camb_selc_com_res_social5s'];
        if ($academico == 0) {
            $id_academico = $data['id_selc_com_res_social'];
        } else {
            $id_academico = $data['camb_selc_com_res_social5s'];
        }
        $data1 = array(
            'nfactura_rendi'             => $data['n_factura'],
            'datefactura_rendi'                   => $data['datefactura_rendisr'],
            'base_imponible_rendi'                          => $data['base_imponible_rendi5s'],
            'selc_iva_rendi2'                          => $data['camb_id_iva'],
            'monto_factura_rend'                          => $data['monto_factura_rend5s'],
            'total_pago_rendi'                          => $data['total_pago_rendi5s'],
            'paridad_rendi_factura'                          => $data['paridad_rendi_factura5s'],
            'subtotal_rendi_factura'                          => $data['subtotal_rendi_factura5s'],
            'selc_com_res_social'           => $id_academico,
            'monto3_rendim'                          => $data['monto3_rendibiness'],
            'fecha_pago_rendi'                          => $data['fecha_pago_rendi5s'],

        );
        $update = $this->db->update('programacion.rendidicion', $data1);
        return true;
    }
    public function ver_rendir1($id_programacion)
    {
        $this->db->select('pac.*,
    cc.descripcion,
    ti.desc_tipo_doc_contrata,
    se.desc_comp_resp_social, tr.descripcion_trimestre
    ');
        $this->db->join('evaluacion_desempenio.modalidad cc', 'cc.id = pac.id_modalida_rendi', 'left');
        $this->db->join('programacion.tipo_doc_contrata ti', 'ti.id_tipo_doc_contrata = pac.selc_tipo_doc_contrata', 'left');
        $this->db->join('programacion.comp_resp_social se', 'se.id_comp_resp_social = pac.selc_com_res_social', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = pac.trimestre', 'left');
        $this->db->where('pac.id_programacion', $id_programacion);
        $this->db->where('pac.trimestre', 1);

        $query = $this->db->get('programacion.rendidicion pac');
        return $query->result_array();
        // return $query->result_array();
    }
    public function ver_rendir2($id_programacion)
    {
        $this->db->select('pac.*,
    cc.descripcion,
    ti.desc_tipo_doc_contrata,
    se.desc_comp_resp_social, tr.descripcion_trimestre
    ');
        $this->db->join('evaluacion_desempenio.modalidad cc', 'cc.id = pac.id_modalida_rendi', 'left');
        $this->db->join('programacion.tipo_doc_contrata ti', 'ti.id_tipo_doc_contrata = pac.selc_tipo_doc_contrata', 'left');
        $this->db->join('programacion.comp_resp_social se', 'se.id_comp_resp_social = pac.selc_com_res_social', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = pac.trimestre', 'left');
        $this->db->where('pac.id_programacion', $id_programacion);
        $this->db->where('pac.trimestre', 2);

        $query = $this->db->get('programacion.rendidicion pac');
        return $query->result_array();
        // return $query->result_array();
    }
    public function ver_rendir3($id_programacion)
    {
        $this->db->select('pac.*,
    cc.descripcion,
    ti.desc_tipo_doc_contrata,
    se.desc_comp_resp_social, tr.descripcion_trimestre
    ');
        $this->db->join('evaluacion_desempenio.modalidad cc', 'cc.id = pac.id_modalida_rendi', 'left');
        $this->db->join('programacion.tipo_doc_contrata ti', 'ti.id_tipo_doc_contrata = pac.selc_tipo_doc_contrata', 'left');
        $this->db->join('programacion.comp_resp_social se', 'se.id_comp_resp_social = pac.selc_com_res_social', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = pac.trimestre', 'left');
        $this->db->where('pac.id_programacion', $id_programacion);
        $this->db->where('pac.trimestre', 3);

        $query = $this->db->get('programacion.rendidicion pac');
        return $query->result_array();
        // return $query->result_array();
    }
    public function ver_rendir4($id_programacion)
    {
        $this->db->select('pac.*,
    cc.descripcion,
    ti.desc_tipo_doc_contrata,
    se.desc_comp_resp_social, tr.descripcion_trimestre
    ');
        $this->db->join('evaluacion_desempenio.modalidad cc', 'cc.id = pac.id_modalida_rendi', 'left');
        $this->db->join('programacion.tipo_doc_contrata ti', 'ti.id_tipo_doc_contrata = pac.selc_tipo_doc_contrata', 'left');
        $this->db->join('programacion.comp_resp_social se', 'se.id_comp_resp_social = pac.selc_com_res_social', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = pac.trimestre', 'left');
        $this->db->where('pac.id_programacion', $id_programacion);
        $this->db->where('pac.trimestre', 4);

        $query = $this->db->get('programacion.rendidicion pac');
        return $query->result_array();
        // return $query->result_array();
    }

    public function consulta_items($id_programacion)
    {
        $this->db->select('*');
        $this->db->from('programacion.p_items ');
        $this->db->where('id_proyecto', $id_programacion);
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function listar_info($data)
    {
        $this->db->select("m.id_p_items,
                             m.id_enlace,
                             m.id_partidad_presupuestaria,
                             m.id_ccnu,
                             m.id_tip_obra, m.id_alcance_obra, m.id_obj_obra,
                             m.especificacion,
                             m.id_unidad_medida,
                             m.cantidad,
                             m.i,
                             m.ii,
                             m.iii,
                             m.iv,
                             m.cant_total_distribuir,
                             m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                             m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                             m.fecha_desde,
                             m.fecha_hasta,
                             pp.codigopartida_presupuestaria,
                             pp.desc_partida_presupuestaria,
                             cc.codigo_ccnu,
                             cc.desc_ccnu,
                             un.desc_unidad_medida,
                             pcc.id_accion_centralizada,
                             pcc.id_obj_comercial,
                             pcc.id_programacion,
                             ff.id_estado,
                             ff.id_fuente_financiamiento,
                             ff.porcentaje,
                             fr.desc_fuente_financiamiento,
                             ac.desc_accion_centralizada,
                             ob.desc_objeto_contrata,
                             re.trimestre,
                             tr.descripcion_trimestre,
                             tpo.descripcion_tip_obr,
                             al.descripcion_alcance_obra,
                             obj.descripcion_obj_obra");
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.p_acc_centralizada pcc', 'pcc.id_p_acc_centralizada = m.id_enlace', 'left');
        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento fr', 'fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');
        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pcc.id_accion_centralizada', 'left');
        $this->db->join('programacion.objeto_contrata ob', 'ob.id_objeto_contrata = pcc.id_obj_comercial', 'left');
        $this->db->join('programacion.rendidicion re', 're.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = re.trimestre', 'left');
        $this->db->join('programacion.tip_obra tpo', 'tpo.id_tip_obra = m.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra al', 'al.id_alcance_obra = m.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra obj', 'obj.id_obj_obra = m.id_obj_obra', 'left');
        // $this->db->where('m.id_p_items', $data['id_p_items']);
        $this->db->where('m.id_ccnu', $data['id_ccnu']);
        // $this->db->where('p.tipo', 'principal');
        $query = $this->db->get('programacion.p_items m');
        return $query->row_array();
    }
    public function Consultar_programacion_final($id_programacion)
    {
        $this->db->select('pac.id_p_items, pac.id_proyecto, pac.id_obj_comercial  , pac.id_enlace, pac.id_p_acc, 
    pac.id_partidad_presupuestaria, pac.id_ccnu,
    pac.id_tip_obra, pac.id_alcance_obra, pac.id_obj_obra, pac.fecha_desde, pac.fecha_hasta, pac.especificacion, pac.id_unidad_medida, 
    pac.cantidad, pac.i, pac.ii, pac.iii, pac.iv, pac.costo_unitario, pac.precio_total, pac.alicuota_iva, pac.iva_estimado, pac.monto_estimado,    
    cc.codigopartida_presupuestaria,cc.desc_partida_presupuestaria,
                        ti.codigo_ccnu, ti.desc_ccnu,ff.id_fuente_financiamiento,ff.porcentaje,ff.id_estado,
                         f.desc_fuente_financiamiento, un.desc_unidad_medida, obj.desc_objeto_contrata
    
    ');
        $this->db->join('programacion.partida_presupuestaria cc', 'cc.id_partida_presupuestaria = pac.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu ti', 'ti.codigo_ccnu = pac.id_ccnu', 'left');
        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = pac.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento f', 'f.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = pac.id_unidad_medida', 'left');
        $this->db->join('programacion.objeto_contrata obj', 'obj.id_objeto_contrata = pac.id_obj_comercial', 'left');
        $this->db->where('pac.id_proyecto', $id_programacion);
        $this->db->where('pac.version', 1);

        $query = $this->db->get('programacion.p_items pac');
        return $query->result_array();
    }
    public function Consultar_programacion_finalmodis($id_programacion)
    {
        $this->db->select('pac.id_p_items, pac.id_proyecto, pac.id_obj_comercial  , pac.id_enlace, pac.id_p_acc, 
    pac.id_partidad_presupuestaria, pac.id_ccnu,
    pac.id_tip_obra, pac.id_alcance_obra, pac.id_obj_obra, pac.fecha_desde, pac.fecha_hasta, pac.especificacion, pac.id_unidad_medida, 
    pac.cantidad, pac.i, pac.ii, pac.iii, pac.iv, pac.costo_unitario, pac.precio_total, pac.alicuota_iva, pac.iva_estimado, pac.monto_estimado,    
    cc.codigopartida_presupuestaria,cc.desc_partida_presupuestaria,
                        ti.codigo_ccnu, ti.desc_ccnu,ff.id_fuente_financiamiento,ff.porcentaje,ff.id_estado,
                         f.desc_fuente_financiamiento, un.desc_unidad_medida, obj.desc_objeto_contrata
    
    ');
        $this->db->join('programacion.partida_presupuestaria cc', 'cc.id_partida_presupuestaria = pac.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu ti', 'ti.codigo_ccnu = pac.id_ccnu', 'left');
        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = pac.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento f', 'f.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = pac.id_unidad_medida', 'left');
        $this->db->join('programacion.objeto_contrata obj', 'obj.id_objeto_contrata = pac.id_obj_comercial', 'left');
        $this->db->where('pac.id_proyecto', $id_programacion);
        $this->db->where('pac.vigente', 'true');

        $query = $this->db->get('programacion.p_items pac');
        return $query->result_array();
    }

    public function valida_anio($anio, $des_unidad)
    {

        // $this->db->select('anio,unidad');
        // $this->db->where('anio', $anio);
        // $this->db->where('unidad', $des_unidad);

        // //$this->db->order_by('id desc');
        // $query = $this->db->get('programacion.programacion');
        // $response = $query->row_array();
        // return $response;

        $this->db->select('anio,unidad');
        $this->db->where('anio', $anio);
        $this->db->where('unidad', $des_unidad);
        $query = $this->db->get('programacion.programacion');

        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function valida_anios($anio, $des_unidad)
    {
        $this->db->select('anio');
        $this->db->where('anio', $anio);
        $this->db->where('unidad', $des_unidad);
        $query = $this->db->get('programacion.programacion');

        return $query->num_rows() > 0; // true si existe, false si no
    }
    public function consultar_acc_todo($id_programacion)
    {
        // $this->db->select('pac.id_p_acc_centralizada,
        //                    pac.id_programacion,
        //                    pac.id_accion_centralizada,
        //                    p.estatus,
        //                    ac.desc_accion_centralizada,
        //                    pac.id_obj_comercial,
        //                    oc.desc_objeto_contrata,
        //                    i.id_enlace');
        // $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
        // $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
        // $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
        // $this->db->join('programacion.p_items i', 'i.id_enlace = pac.id_programacion');

        // $this->db->where('pac.id_programacion', $id_programacion);
        // $query = $this->db->get('programacion.p_acc_centralizada pac');

        $this->db->select("pac.id_enlace, pac.id_p_acc,pac.id_proyecto,
                                i.id_obj_comercial,
                               sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total,
      ");
        // $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
        // $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
        // $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
        $this->db->join('programacion.p_acc_centralizada i', 'i.id_p_acc_centralizada = pac.id_enlace');
        $this->db->where('pac.id_p_acc', 1);
        $this->db->where('pac.id_proyecto', $id_programacion);
        $this->db->group_by('pac.id_enlace, pac.id_p_acc,pac.id_proyecto,
    i.id_obj_comercial');
        $query = $this->db->get('programacion.p_items pac');

        return $query->result_array();
    }
    public function consultar_acc_todo1($id_programacion)
    {


        $this->db->select(" pac.id_p_acc,pac.id_proyecto,
                               sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total");
        // $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
        // $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
        // $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
        //$this->db->join('programacion.p_acc_centralizada i', 'i.id_p_acc_centralizada = pac.id_enlace');
        $this->db->where('pac.id_p_acc', 1);
        $this->db->where('pac.id_proyecto', $id_programacion);
        $this->db->group_by(' pac.id_p_acc,pac.id_proyecto,
   ');
        $query = $this->db->get('programacion.p_items pac');
        return $query->result_array();
    }
    // function consulta_total_acc($data1)
    // {
    //     //$id=$data['numero_proceso'];
    //     $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_proyecto,
    // sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total

    //  FROM programacion.p_items pac 
    // --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
    // --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
    // --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
    //  where pac.id_proyecto = '$data1' and pac.id_p_acc ='1'
    //  group by pac.id_p_acc,pac.id_proyecto ");
    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     } else {
    //         return NULL;
    //     }
    // }

    function consulta_total_objeto_acc2($id_programacion)
    {

        $this->db->select("pac.id_enlace, pac.id_p_acc,pac.id_proyecto,
                                i.id_obj_comercial,ob.desc_objeto_contrata,
                               sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total,
      ");
        $this->db->join('programacion.p_acc_centralizada i', 'i.id_p_acc_centralizada = pac.id_enlace');
        $this->db->join('programacion.objeto_contrata ob', 'ob.id_objeto_contrata = i.id_obj_comercial');
        $this->db->where('pac.id_p_acc', 1);
        $this->db->where('pac.id_proyecto', $id_programacion);
        $this->db->group_by('pac.id_enlace, pac.id_p_acc,pac.id_proyecto,
    i.id_obj_comercial,ob.desc_objeto_contrata');
        $query = $this->db->get('programacion.p_items pac');

        return $query->result_array();
    }
    //     function consulta_total_objeto_acc($data1)
    //     { //da totales agrupados por bienes, servicio, obras

    //         $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_proyecto,
    //     pac.id_obj_comercial,ob.desc_objeto_contrata,
    //    sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total
    //         FROM programacion.p_items pac 
    //     --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
    //    -- join programacion.p_acc_centralizada i on i.id_p_acc_centralizada = pac.id_enlace	
    //      join programacion.objeto_contrata ob on ob.id_objeto_contrata = pac.id_obj_comercial	

    //      where pac.id_proyecto = '$data1' and pac.id_p_acc ='1'
    //      group by pac.id_p_acc,pac.id_proyecto,
    //     pac.id_obj_comercial,ob.desc_objeto_contrata ");
    //         if ($query->num_rows() > 0) {
    //             return $query->result();
    //         } else {
    //             return NULL;
    //         }
    //     }

    function consulta_total_objeto_acc_rendi1($data1)
    { //da totales agrupados por bienes, servicio, obras

        $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_proyecto,
        pac.id_obj_comercial,ob.desc_objeto_contrata,
       sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total
    
         FROM programacion.rendidicion pac 
        --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
       -- join programacion.p_acc_centralizada i on i.id_p_acc_centralizada = pac.id_enlace	
         join programacion.objeto_contrata ob on ob.id_objeto_contrata = pac.id_obj_comercial	
            
         where pac.id_proyecto = '$data1' and pac.id_p_acc ='1'
         group by pac.id_p_acc,pac.id_proyecto,
        pac.id_obj_comercial,ob.desc_objeto_contrata ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_total_objeto_acc3($data1)
    { //da totales agrupados por bienes, servicio, obras

        $query = $this->db->query("SELECT pac.* ,to_number(pac.porcentaje_bien_a,'999999999999D99')as porcentaje_bien_a1  
         FROM programacion.inf_enviada pac                   
         where pac.id_programacion = '$data1' 
         ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    // function consulta_total_objeto_py2($data1)
    // { //da totales agrupados por bienes, servicio, obras

    //     $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_proyecto,
    //     pac.id_obj_comercial,ob.desc_objeto_contrata,
    //    sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total

    //      FROM programacion.p_items pac 
    //     --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
    //    -- join programacion.p_acc_centralizada i on i.id_p_acc_centralizada = pac.id_enlace	
    //      join programacion.objeto_contrata ob on ob.id_objeto_contrata = pac.id_obj_comercial	

    //      where pac.id_proyecto = '$data1' and pac.id_p_acc ='0'
    //      group by pac.id_p_acc,pac.id_proyecto,
    //     pac.id_obj_comercial,ob.desc_objeto_contrata ");
    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     } else {
    //         return NULL;
    //     }
    // }
    function consulta_total_objeto_py1($id_programacion)
    {

        $this->db->select("pac.id_enlace, pac.id_p_acc,pac.id_proyecto,
    i.id_obj_comercial,ob.desc_objeto_contrata,sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total,
      ");
        $this->db->join('programacion.p_proyecto i', 'i.id_p_proyecto = pac.id_enlace');
        $this->db->join('programacion.objeto_contrata ob', 'ob.id_objeto_contrata = i.id_obj_comercial');
        $this->db->where('pac.id_p_acc', 0);
        $this->db->where('pac.id_proyecto', $id_programacion);
        $this->db->group_by('pac.id_enlace, pac.id_p_acc,pac.id_proyecto,
    i.id_obj_comercial,ob.desc_objeto_contrata');
        $query = $this->db->get('programacion.p_items pac');

        return $query->result_array();
    }
    function consulta_total_objeto_py($data1)
    {
        //$id=$data['numero_proceso'];
        $query = $this->db->query("SELECT  pac.id_enlace, pac.id_p_acc,pac.id_proyecto,
    i.id_obj_comercial,ob.desc_objeto_contrata,
   sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total

     FROM programacion.p_items pac 
    --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
    join programacion.p_proyecto i on i.id_p_proyecto = pac.id_enlace	
     join programacion.objeto_contrata ob on ob.id_objeto_contrata = i.id_obj_comercial	
        
     where pac.id_proyecto = '$data1' and pac.id_p_acc ='0'
     group by pac.id_enlace, pac.id_p_acc,pac.id_proyecto,
    i.id_obj_comercial,ob.desc_objeto_contrata ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    // function consulta_total_PYT($data1)
    // {
    //     //$id=$data['numero_proceso'];
    //     $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_proyecto,
    // sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total_py

    //  FROM programacion.p_items pac 
    // --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
    // --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
    // --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
    //  where pac.id_proyecto = '$data1' and pac.id_p_acc ='0'
    //  group by pac.id_p_acc,pac.id_proyecto ");
    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     } else {
    //         return NULL;
    //     }
    // }
    function anio_programacion($data1)
    {
        //$id=$data['numero_proceso'];
        $query = $this->db->query("SELECT  pac.id_programacion, pac.fecha, pac.anio,pac.fecha_modifi

     FROM programacion.programacion pac 
    --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
    --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
    --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
     where pac.id_programacion = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    // function consulta_llamado($data1){
    //     //$id=$data['numero_proceso'];
    //     $query = $this->db->query("SELECT c.rif_organoente, c.numero_proceso, c.id_modalidad, 
    //     c.id_mecanismo, c.id_objeto_contratacion, c.dias_habiles, 
    //     c.fecha_llamado, c.fecha_disponible_llamado, c.fecha_fin_aclaratoria, 
    //     c.fecha_tope, c.fecha_fin_llamado, 
    //     c.denominacion_proceso, c.descripcion_contratacion, 
    //     c.web_contratante, c.hora_desde, c.hora_hasta, 
    //     c.id_estado, c.id_municipio, c.direccion, 
    //     c.hora_desde_sobre, c.id_estado_sobre, c.id_municipio_sobre, 
    //     c.direccion_sobre, c.lugar_entrega, c.observaciones, 
    //      c.idestatus, c.fecha_inicio_aclaratoria, 
    //     c.mecanismo, c.modalidad, c.objeto_contratacion, c.estado, c.municipio,
    //      c.organoente, c.siglas, c.estado_sobre, c.municipio_sobre, 
    //      c.id_llcestatus, c.estatus, m.descripcion as descr, obj.descripcion as obj
    //      FROM public.llamado_concurso_view c 
    //      left join public.modalidad m on m.id_modalidad = c.id_modalidad
    //      left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
    //      join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
    //      where numero_proceso = '$data1'");
    //     if($query->num_rows()>0){
    //         return $query->result();
    //     }
    //     else{
    //         return NULL;
    //     }
    // }
    public function save_certificado($data)
    { //por hacer
        $precio_py = $data['precio_py'];
        if ($precio_py == '') {

            $precio_pyt = 0;
        } else {

            $precio_pyt = $data['precio_py'];
        }

        $porcenta_py = $data['porcenta_py'];
        if ($porcenta_py == '') {

            $porcenta_pyt = 0;
        } else {

            $porcenta_pyt = $data['precio_py'];
        }


        $this->db->select('max(e.id) as id1');
        $query1 = $this->db->get('programacion.totales e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        ///7 $quers =$this->db->insert('programacion.p_proyecto',$p_proyecto);



        for ($i = 0; $i < 10; $i++) {
            $data1 = array(

                'id'               => $id1,

                'id_programacion'               => $data['id_programacion'],
                'objeto_contrata'             => $data['objeto_acc'][$i],
                'precio_acc'          => $data['totales_acc'][$i],
                'porcentaje_acc'          => $data['porcentaje_acc'][$i],
                'total_acc'         => $data['total_acc'][$i],
                //'precio_py' 		 => $precio_pyt[$i],
                'precio_py' => $data['precio_py'][$i],

                'porcentaje_py' => $data['porcenta_py'][$i],
                'total_py' => $data['total_py'],

                'fecha1' => $data['fecha1'],

            );
            $quers = $this->db->insert('programacion.totales', $data1);
        }
        return true;
    }
    public function read_sending_prier_ren($rif)
    {
        $this->db->select('id_ainf_enviada, id_programacion, anio,des_unidad,rif, trimestre');
        $this->db->where('rif', $rif);
        $this->db->where('trimestre', 1);
        $query = $this->db->get('programacion.inf_enviada_rendi');
        return $query->result_array();
    }
    public function read_sending_segun_ren($rif)
    {
        $this->db->select('id_ainf_enviada, id_programacion, anio,des_unidad,rif, trimestre');
        $this->db->where('rif', $rif);
        $this->db->where('trimestre', 2);
        $query = $this->db->get('programacion.inf_enviada_rendi');
        return $query->result_array();
    }
    public function read_sending_terc_ren($rif)
    {
        $this->db->select('id_ainf_enviada, id_programacion, anio,des_unidad,rif, trimestre');
        $this->db->where('rif', $rif);
        $this->db->where('trimestre', 3);
        $query = $this->db->get('programacion.inf_enviada_rendi');
        return $query->result_array();
    }
    public function read_sending_cuarto_ren($rif)
    {
        $this->db->select('id_ainf_enviada, id_programacion, anio,des_unidad,rif, trimestre');
        $this->db->where('rif', $rif);
        $this->db->where('trimestre', 4);
        $query = $this->db->get('programacion.inf_enviada_rendi');
        return $query->result_array();
    }
    public function read_sending_p()
    { //esto se vera el historico
        $this->db->select('id_ainf_enviada, id_programacion, anio,des_unidad,rif');
        $this->db->where('anio >', 0);
        $query = $this->db->get('programacion.inf_enviada');
        return $query->result_array();
    }
    public function read_sending_p1()
    {
        $this->db->select('id_ainf_enviada, id_programacion, anio,des_unidad,rif');
        $this->db->where('anio >', 0);
        $query = $this->db->get('programacion.inf_enviadafil');
        return $query->result_array();
    }
    public function read_sending_pmodificaciones()
    {
        $this->db->select('des_unidad, total_veces,rif,anio');
        $query = $this->db->get('programacion.inf_enviadafiltro_modi');
        return $query->result_array();
    }
    public function read_sending_prendiciones()
    {
        $this->db->select('des_unidad, rif, anio');
        $query = $this->db->get('programacion.inf_enviadafil_rendiciones');
        return $query->result_array();
    }
    public function read_usuarios()
    {
        $this->db->select('razon_social, rif_organoente, total_usuarios');
        $query = $this->db->get('programacion.total_usuario');
        return $query->result_array();
    }

    public function read_sending_p1total()
    {
        $this->db->select('anio, total_id_programacion as total');
        $this->db->where('anio >', 0);
        $this->db->order_by('anio', 'ASC');
        $query = $this->db->get('programacion.inf_enviadatotal_anio');
        return $query->result_array();
    }
    public function get_totales_por_anio_modifi()
    {
        $this->db->select('anio, total_veces');
        $this->db->order_by('anio', 'ASC');
        $query = $this->db->get('programacion.inf_enviadaf_modi_total_anio');
        return $query->result_array();
    }
    public function get_anio_totales_rendi()
    { ///rendiicones
        $this->db->select('anio, total_rendicion');
        $this->db->order_by('anio', 'ASC');
        $query = $this->db->get('programacion.inf_enviadatotal_anio_rendi');
        return $query->result_array();
    }

    public function get_totales_por_anio()
    {
        $this->db->select('anio, total_id_programacion as total');
        $this->db->from('programacion.inf_enviadatotal_anio');
        $this->db->where('anio >', 0);
        $this->db->order_by('anio', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function anio_totales_modi_graf()
    {
        $this->db->select('anio, total_veces');
        $this->db->from('programacion.inf_enviadaf_modi_total_anio');
        $this->db->order_by('anio', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function anio_totales_rendi_graf()
    {
        $this->db->select('anio, total_rendicion');
        $this->db->from('programacion.inf_enviadatotal_anio_rendi');
        $this->db->order_by('anio', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function read_sending_pdvsa()
    {
        $this->db->select('i.id_ainf_enviada, i.id_programacion, i.anio,i.des_unidad,i.rif');
        $this->db->join('programacion.pdvsaf or', 'or.rif = i.rif');
        //$this->db->where('i.rif!=', 'G200004088');
        // $this->db->where('or.id_organoenteads', '13');//acc
        $query = $this->db->get('programacion.inf_enviada i');
        return $query->result_array();
    }
    public function read_sending_pdvsa_rendi()
    {
        $this->db->select('i.id_ainf_enviada, i.id_programacion, i.anio,i.des_unidad,i.rif');
        $this->db->join('programacion.pdvsaf or', 'or.rif = i.rif');
        // $this->db->where('i.rif!=', 'G200004088');
        // $this->db->where('or.id_organoenteads', '13');//acc
        $query = $this->db->get('programacion.inf_enviada_rendi i');
        return $query->result_array();
    }
    function read_sending_p2($data1)
    {
        $query = $this->db->query("SELECT  pac.id_programacion, pac.des_unidad, pac.rif, pac.codigo_onapre, 
        org.filiar, org.id_organoenteads ,p.descripcion ,p.rif as filiares
        FROM programacion.inf_enviada pac 
        join public.organoente org on pac.rif = org.rif
        join public.organoente p on p.id_organoente = org.id_organoenteads
        where pac.id_programacion = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function read_sending_p2_($data1)
    {
        $query = $this->db->query("SELECT  pac.id_ainf_enviada pac.id_programacion, pac.des_unidad, pac.rif, pac.codigo_onapre, 
        org.filiar, org.id_organoenteads ,p.descripcion ,p.rif as filiares
        FROM programacion.inf_enviada pac 
        join public.organoente org on pac.rif = org.rif
        join public.organoente p on p.id_organoente = org.id_organoenteads
        where pac.id_ainf_enviada = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function read_sending_p2_snc($data1)
    {
        $query = $this->db->query("SELECT pac.id_ainf_enviada, pac.id_programacion, pac.des_unidad, pac.rif, pac.codigo_onapre, 
        org.filiar, org.id_organoenteads ,p.descripcion ,p.rif as filiares
        FROM programacion.inf_enviada pac 
        join public.organoente org on pac.rif = org.rif
        join public.organoente p on p.id_organoente = org.id_organoenteads
        where pac.id_ainf_enviada = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    /////pdf rendiciones
    function read_sending_rendiciones($data1)
    {
        $query = $this->db->query("SELECT  pac.id_programacion, pac.des_unidad, pac.rif,
         pac.codigo_onapre, org.filiar, org.id_organoenteads ,p.descripcion ,
         p.rif as filiares, pac.anio,pac.fecha, pac.trimestre,t.descripcion_trimestre
        FROM programacion.inf_enviada_rendi pac 
        join public.organoente org on pac.rif = org.rif
        join public.organoente p on p.id_organoente = org.id_organoenteads
        join programacion.trimestre t on t.id_trimestre = pac.trimestre

        where pac.id_ainf_enviada = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function read_sending_rendi_obs($data1)
    {
        $query = $this->db->query("SELECT   observacion
        FROM programacion.obs_rend   
        where id_ainf_enviada = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function read_sending_rendiciones14($data1)
    {
        $query = $this->db->query("SELECT  pac.id_programacion, pac.des_unidad, pac.rif,
         pac.codigo_onapre, org.filiar, org.id_organoenteads ,p.descripcion ,
         p.rif as filiares, pac.anio,pac.fecha
        FROM programacion.inf_enviada_rendi pac 
        join public.organoente org on pac.rif = org.rif
        join public.organoente p on p.id_organoente = org.id_organoenteads
        where pac.id_programacion = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function read_sending_rendiciones_snc2($data1)
    {
        $query = $this->db->query("SELECT   id_programacion,  
        id_obj_comr_obra, precio_total_obra, porcentaje_obra, id_obj_comr_bien, precio_total_bien, 
        porcentaje_bien, id_obj_comr_serv, precio_total_serv, porcentaje_serv, total_proy, id_p_acc, 
        id_obj_comr_obra_a, precio_total_obra_a, porcentaje_obra_a, id_obj_comr_bien_a, precio_total_bien_a,
        porcentaje_bien_a, id_obj_comr_serv_a, precio_total_serv_a, porcentaje_serv_a, total_acc
        FROM programacion.inf_enviada_rendi 
       
        where  id_ainf_enviada = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function read_sending_rendiciones_snctotales($data20)
    {
        $query = $this->db->query("SELECT  id_ainf_enviada, id_programacion, precio_total_bien_a,precio_total_serv_a,precio_total_obra_a,total_acc,precio_total_obra,
                                          precio_total_bien, precio_total_serv,total_proy
        FROM  programacion.inf_enviada       
        where  id_programacion = '$data20'
        ORDER BY id_ainf_enviada DESC
        LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /////consutar item llena el select para el modal de rendicion especificacion acc
    public function consulta_itemsr($id_programacion)
    {
        $this->db->select('especificacion,id_proyecto,id_p_items,id_p_acc');
        $this->db->from('programacion.list_itms2');
        $this->db->where('id_p_acc', 1); //acc
        $this->db->where('id_proyecto', $id_programacion);
        $this->db->where('vigente', 'true');

        $query = $this->db->get();
        return $result = $query->result_array();
    }
    /////consutar item llena el select para el modal de rendicion especificacion proyecto
    public function consulta_itemsr_py($id_programacion)
    {
        $this->db->select('especificacion,id_proyecto,id_p_items,id_p_acc');
        $this->db->from('programacion.list_itms2');
        $this->db->where('id_p_acc', 0); //acc
        $this->db->where('id_proyecto', $id_programacion);
        $this->db->where('vigente', 'true');

        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function tolist_info($data)
    {
        $this->db->distinct();
        $this->db->select(
            '
                m.id_p_items,m.vigente,
                m.id_p_acc,
                m.id_enlace,
                m.id_partidad_presupuestaria,
                m.id_ccnu,
                m.id_tip_obra,
                m.id_alcance_obra,
                m.id_obj_obra,
                m.especificacion,
                m.id_unidad_medida,
                m.cantidad,
                m.i,
                m.ii,
                m.iii,
                m.iv,
                m.cant_total_distribuir,
                m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                m.fecha_desde,
                m.fecha_hasta,
                pp.codigopartida_presupuestaria,
                pp.desc_partida_presupuestaria,
                cc.codigo_ccnu,
                cc.desc_ccnu,
                un.desc_unidad_medida,
                pcc.id_accion_centralizada,
                pcc.id_obj_comercial,
                pcc.id_programacion,
                ff.id_estado,
                ff.id_fuente_financiamiento,
                ff.porcentaje,
                fr.desc_fuente_financiamiento,
                ac.desc_accion_centralizada,
                ob.desc_objeto_contrata,
                re.trimestre,
                tr.descripcion_trimestre,
                tpo.descripcion_tip_obr,
                al.descripcion_alcance_obra,
                obj.descripcion_obj_obra
                '
        );
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.p_acc_centralizada pcc', 'pcc.id_p_acc_centralizada = m.id_enlace', 'left');
        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento fr', 'fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');
        $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pcc.id_accion_centralizada', 'left');
        $this->db->join('programacion.objeto_contrata ob', 'ob.id_objeto_contrata = pcc.id_obj_comercial', 'left');
        $this->db->join('programacion.rendidicion re', 're.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = re.trimestre', 'left');
        $this->db->join('programacion.tip_obra tpo', 'tpo.id_tip_obra = m.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra al', 'al.id_alcance_obra = m.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra obj', 'obj.id_obj_obra = m.id_obj_obra', 'left');
        $this->db->where('m.id_p_acc =', 1);
        $this->db->where('m.id_p_items', $data['id_p_items']);
        // $this->db->where('m.vigente', 'true');
        $query = $this->db->get('programacion.p_items m');
        return $query->row_array();
    }
    public function tolist_info_py($data)
    {
        $this->db->select(
            '
    m.id_p_items,
    m.id_p_acc,
    m.id_enlace,
    m.id_partidad_presupuestaria,
    m.id_ccnu,
    m.id_tip_obra,
    m.id_alcance_obra,
    m.id_obj_obra,
    m.especificacion,
    m.id_unidad_medida,
    m.cantidad,
    m.i,
    m.ii,
    m.iii,
    m.iv,
    m.cant_total_distribuir,
    m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
    m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
    m.fecha_desde,
    m.fecha_hasta,
    m.id_proyecto,

    pp.codigopartida_presupuestaria,
    pp.desc_partida_presupuestaria,
    cc.codigo_ccnu,
    cc.desc_ccnu,
    un.desc_unidad_medida,    
    ff.id_estado,
    ff.id_fuente_financiamiento, 
    fr.desc_fuente_financiamiento, 
    re.trimestre,
    tr.descripcion_trimestre,
    tpo.descripcion_tip_obr,
    al.descripcion_alcance_obra,
    obj.descripcion_obj_obra,
    py.id_p_proyecto,
    py.nombre_proyecto,
    py.id_obj_comercial,
  
    obc.desc_objeto_contrata

    '
        );
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc', 'cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un', 'un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.p_proyecto py', 'py.id_p_proyecto = m.id_enlace', 'left');

        $this->db->join('programacion.objeto_contrata obc', 'obc.id_objeto_contrata = py.id_obj_comercial', 'left');

        $this->db->join('programacion.p_ffinanciamiento ff', 'ff.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento fr', 'fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');

        $this->db->join('programacion.rendidicion re', 're.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.trimestre tr', 'tr.id_trimestre = re.trimestre', 'left');
        $this->db->join('programacion.tip_obra tpo', 'tpo.id_tip_obra = m.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra al', 'al.id_alcance_obra = m.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra obj', 'obj.id_obj_obra = m.id_obj_obra', 'left');
        $this->db->where('m.id_p_acc =', 0);
        $this->db->where('m.id_p_items', $data['id_p_items']);
        $query = $this->db->get('programacion.p_items m');
        return $query->row_array();
    }


    public function read_sending_upd()
    {
        $this->db->select('id_ainf_enviada, id_programacion, anio,des_unidad,rif, fecha');
        $query = $this->db->get('programacion.inf_modif');
        return $query->result_array();
    }
    public function read_sending_upd_pdvsa()
    {
        $this->db->select('i.id_ainf_enviada, i.id_programacion, i.anio,i.des_unidad,i.rif,i.fecha');
        $this->db->join('programacion.pdvsaf or', 'or.rif = i.rif');
        //  $this->db->where('i.rif!=', 'G200004088');
        $query = $this->db->get('programacion.inf_modif i');
        return $query->result_array();
    }
    public function read_sending_red()
    {
        $this->db->select('id_ainf_enviada, id_programacion, anio,des_unidad,rif, fecha');
        $query = $this->db->get('programacion.inf_enviada_rendi');
        return $query->result_array();
    }
    function read_sending_upd2($data1)
    {
        $query = $this->db->query("SELECT pac.id_ainf_enviada ,pac.id_programacion,pac.rif, pac.des_unidad, pac.rif, pac.codigo_onapre,
                                    pac.fecha, pac.anio
    
        FROM programacion.inf_modif pac 
        where pac.id_ainf_enviada = '$data1'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function read_sending_upd3($data1)
    { //da totales agrupados por bienes, servicio, obras

        $query = $this->db->query("SELECT pac.*   
             FROM programacion.inf_modif pac                   
             where  pac.id_ainf_enviada = '$data1' 
             ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function consulta_total_objeto_acc_rendi($data1)
    { //da totales agrupados por bienes, servicio, obras

        $query = $this->db->query("SELECT 
            ob.id_objeto_contrata,
            pac.id_p_acc,
            pac.id_programacion,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata,
            SUM(TO_NUMBER(pac.total_rendi, '999999999999D99')) AS precio_total
        FROM 
            programacion.objeto_contrata ob
        LEFT JOIN 
            programacion.rendidicion pac ON ob.id_objeto_contrata = pac.id_obj_comercial AND pac.id_programacion = '$data1' AND pac.id_p_acc ='1' and pac.trimestre='1'
        GROUP BY 
            ob.id_objeto_contrata,
            pac.id_p_acc,
            pac.id_programacion,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_total_accrendi($data1)
    {

        $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_proyecto,
                pac.id_obj_comercial,ob.desc_objeto_contrata,
            sum(to_number(pac.monto_estimado,'999999999999D99')) as precio_total

                FROM programacion.p_items pac 
                --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
            -- join programacion.p_acc_centralizada i on i.id_p_acc_centralizada = pac.id_enlace	
                join programacion.objeto_contrata ob on ob.id_objeto_contrata = pac.id_obj_comercial	
                    
                where pac.id_proyecto = '$data1' and pac.id_p_acc ='1' and pac.id_obj_comercial='2'
                group by pac.id_p_acc,pac.id_proyecto,
                pac.id_obj_comercial,ob.desc_objeto_contrata ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_total_accrendi2($data1)
    {

        $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_programacion,
            sum(to_number(pac.total_rendi,'999999999999D99')) as precio_total
             FROM programacion.rendidicion pac 
             where pac.id_programacion = '$data1' and pac.id_p_acc ='1'
             group by pac.id_p_acc,pac.id_programacion");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function consulta_total_objeto_py2rendi($data1)
    { //da totales agrupados por bienes, servicio, obras

        $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_programacion,
                    pac.id_obj_comercial,ob.desc_objeto_contrata,
                   sum(to_number(pac.total_rendi,'999999999999D99')) as precio_total
                
                     FROM programacion.rendidicion pac 
                    --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                   -- join programacion.p_acc_centralizada i on i.id_p_acc_centralizada = pac.id_enlace	
                     join programacion.objeto_contrata ob on ob.id_objeto_contrata = pac.id_obj_comercial	
                        
                     where pac.id_programacion = '$data1' and pac.id_p_acc ='0'
                     group by pac.id_p_acc,pac.id_programacion,
                    pac.id_obj_comercial,ob.desc_objeto_contrata ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function consulta_total_PYTrendi($data1)
    {
        //$id=$data['numero_proceso'];
        $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_programacion,
                    sum(to_number(pac.total_rendi,'999999999999D99')) as precio_total_py
                
                     FROM programacion.rendidicion pac 
                    --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                    --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
                    --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
                     where pac.id_programacion = '$data1' and pac.id_p_acc ='0'
                     group by pac.id_p_acc,pac.id_programacion ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function enviar_snc_rendi($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5)
    {
        $this->db->select('anio');
        $this->db->where('id_programacion', $data['id']);
        $query1 = $this->db->get('programacion.programacion');
        $response4 = $query1->row_array();
        $id1 = $response4['anio'] + 0;
        //ACC 1
        $id_obj_comr_obra_a = 0;
        $precio_total_obra_a = 0;
        $porcentaje_obra_a = 0;
        $id_obj_comr_bien_a = 0;
        $precio_total_bien_a = 0;
        $porcentaje_bien_a = 0;
        $id_obj_comr_serv_a = 0;
        $precio_total_serv_a = 0;
        $porcentaje_serv_a = 0;
        $total_acc = 0;
        if ($data2 != '') {
            foreach ($data2 as $d2) {
                if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == '3') {
                    $id_obj_comr_obra_a = $d2->id_obj_comercial;
                    $precio_total_obra_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_obra_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 1) {
                    $id_obj_comr_bien_a = $d2->id_obj_comercial;
                    $precio_total_bien_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_bien_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 2) {
                    $id_obj_comr_serv_a = $d2->id_obj_comercial;
                    $precio_total_serv_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_serv_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                }
            }

            // foreach($data3 as $total_ass){
            //     $total_acc = $total_ass->precio_total;
            // }
            if (!empty($data3)) {

                foreach ($data3 as $total_ass) {

                    $total_acc = $total_ass->precio_total;
                }
            }
        } else {
            $id_obj_comr_obra_a = 0;
            $precio_total_obra_a = 0;
            $porcentaje_obra_a = 0;
            $id_obj_comr_bien_a = 0;
            $precio_total_bien_a = 0;
            $porcentaje_bien_a = 0;
            $id_obj_comr_serv_a = 0;
            $precio_total_serv_a = 0;
            $porcentaje_serv_a = 0;
            $total_acc = 0;
        }

        //PROYECTO 0

        $id_obj_comr_obra_p = 0;
        $precio_total_obra_p = 0;
        $porcentaje_obra_p = 0;
        $id_obj_comr_bien_p = 0;
        $precio_total_bien_p = 0;
        $porcentaje_bien_p = 0;
        $id_obj_comr_serv_p = 0;
        $precio_total_serv_p = 0;
        $porcentaje_serv_p = 0;

        if ($data4 != '') {
            foreach ($data4 as $d) {
                if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 3) {
                    $id_obj_comr_obra_p = $d->id_obj_comercial;
                    $precio_total_obra_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_obra_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 1) {
                    $id_obj_comr_bien_p = $d->id_obj_comercial;
                    $precio_total_bien_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_bien_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 2) {
                    $id_obj_comr_serv_p = $d->id_obj_comercial;
                    $precio_total_serv_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_serv_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                }
            }

            // foreach($data5 as $total_ass){
            //     $total_proy = $total_ass->precio_total_py;
            // }    
            if (!empty($data5)) {

                foreach ($data5 as $total_ass) {

                    $total_proy = $total_ass->precio_total_py;
                }
            }
        } else {
            $id_obj_comr_obra_p = 0;
            $precio_total_obra_p = 0;
            $porcentaje_obra_p = 0;
            $id_obj_comr_bien_p = 0;
            $precio_total_bien_p = 0;
            $porcentaje_bien_p = 0;
            $id_obj_comr_serv_p = 0;
            $precio_total_serv_p = 0;
            $porcentaje_serv_p = 0;
            $total_proy = 0;
        }

        $resulta = array(
            'id_programacion'      => $data['id'],
            'des_unidad'            => $des_unidad,
            'codigo_onapre'         => $codigo_onapre,
            'rif'                   => $rif,
            'id_p_acc_proy'         => 0,
            'id_obj_comr_obra'      => $id_obj_comr_obra_p,
            'precio_total_obra'     => $precio_total_obra_p,
            'porcentaje_obra'       => $porcentaje_obra_p,
            'id_obj_comr_bien'      => $id_obj_comr_bien_p,
            'precio_total_bien'     => $precio_total_bien_p,
            'porcentaje_bien'       => $porcentaje_bien_p,
            'id_obj_comr_serv'      => $id_obj_comr_serv_p,
            'precio_total_serv'     => $precio_total_serv_p,
            'porcentaje_serv'       => $porcentaje_serv_p,
            'total_proy'            => $total_proy,
            'id_p_acc'              => 1,
            'id_obj_comr_obra_a'    => $id_obj_comr_obra_a,
            'precio_total_obra_a'   => $precio_total_obra_a,
            'porcentaje_obra_a'     => $porcentaje_obra_a,
            'id_obj_comr_bien_a'    => $id_obj_comr_bien_a,
            'precio_total_bien_a'   => $precio_total_bien_a,
            'porcentaje_bien_a'     => $porcentaje_bien_a,
            'id_obj_comr_serv_a'    => $id_obj_comr_serv_a,
            'precio_total_serv_a'   => $precio_total_serv_a,
            'porcentaje_serv_a'     => $porcentaje_serv_a,
            'total_acc'             => $total_acc,
            'id_usuario'            => $this->session->userdata('id_user'),
            'anio'            => $id1,
            'trimestre'      => $data['trimestre'],

        );
        //  print_r($resulta);die;
        $this->db->insert('programacion.inf_enviada_rendi', $resulta);

        $data1 = array(
            'snc' => '4', //   y rendir 
            'id_usuario' => $this->session->userdata('id_user'),
            'fecha30dias_notificacion' => date('Y-m-d')
        );
        $this->db->where('id_programacion', $data['id']);
        $update = $this->db->update('programacion.rendidicion', $data1);
        return true;
    }

    function consulta_total_objeto_acc_rendi_f($id_programacion, $trimestre)
    { //da totales agrupados por bienes, servicio, obras

        $query = $this->db->query("SELECT 
                    ob.id_objeto_contrata,
                    pac.id_p_acc,
                    pac.id_programacion,
                    pac.id_obj_comercial,
                    ob.desc_objeto_contrata,
                    pac.trimestre,
                    SUM(TO_NUMBER(pac.total_rendi, '999999999999D99')) AS precio_total
                FROM 
                    programacion.objeto_contrata ob
                LEFT JOIN 
                    programacion.rendidicion pac ON ob.id_objeto_contrata = pac.id_obj_comercial AND pac.id_programacion = '$id_programacion' AND pac.id_p_acc ='1' 
                    and pac.trimestre='$trimestre'
                GROUP BY 
                    ob.id_objeto_contrata,
                    pac.id_p_acc,
                    pac.id_programacion,
                    pac.id_obj_comercial,
                    ob.desc_objeto_contrata,pac.trimestre");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }


    function consulta_total_accrendi2_f($id_programacion, $trimestre)
    {

        $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_programacion,pac.trimestre,
                            sum(to_number(pac.total_rendi,'999999999999D99')) as precio_total
                             FROM programacion.rendidicion pac 
                             where pac.id_programacion = '$id_programacion' and pac.id_p_acc ='1' and pac.trimestre='$trimestre'
                             group by pac.id_p_acc,pac.id_programacion,pac.trimestre");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function consulta_total_objeto_py2rendi_f($id_programacion, $trimestre)
    { //da totales agrupados por bienes, servicio, obras

        $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_programacion,
                                pac.id_obj_comercial,ob.desc_objeto_contrata,pac.trimestre,
                               sum(to_number(pac.total_rendi,'999999999999D99')) as precio_total
                            
                                 FROM programacion.rendidicion pac 
                                --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                               -- join programacion.p_acc_centralizada i on i.id_p_acc_centralizada = pac.id_enlace	
                                 join programacion.objeto_contrata ob on ob.id_objeto_contrata = pac.id_obj_comercial	
                                    
                                 where pac.id_programacion = '$id_programacion' and pac.id_p_acc ='0' and pac.trimestre='$trimestre'
                                 group by pac.id_p_acc,pac.id_programacion,
                                pac.id_obj_comercial,ob.desc_objeto_contrata,pac.trimestre ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_total_PYTrendi_f($id_programacion, $trimestre)
    {
        //$id=$data['numero_proceso'];
        $query = $this->db->query("SELECT  pac.id_p_acc,pac.id_programacion,
                                sum(to_number(pac.total_rendi,'999999999999D99')) as precio_total_py
                            
                                 FROM programacion.rendidicion pac 
                                --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                                --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
                                --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
                                 where pac.id_programacion = '$id_programacion' and pac.id_p_acc ='0' and pac.trimestre='$trimestre'
                                 group by pac.id_p_acc,pac.id_programacion ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function rendir_cero($data, $des_unidad, $codigo_onapre, $rif, $data2, $data3, $data4, $data5, $observacion)
    {
        $this->db->select('anio');
        $this->db->where('id_programacion', $data['id']);
        $query1 = $this->db->get('programacion.programacion');
        $response4 = $query1->row_array();
        $id1 = $response4['anio'] + 0;
        //ACC 1
        $id_obj_comr_obra_a = 0;
        $precio_total_obra_a = 0;
        $porcentaje_obra_a = 0;
        $id_obj_comr_bien_a = 0;
        $precio_total_bien_a = 0;
        $porcentaje_bien_a = 0;
        $id_obj_comr_serv_a = 0;
        $precio_total_serv_a = 0;
        $porcentaje_serv_a = 0;
        $total_acc = 0;
        if ($data2 != '') {
            foreach ($data2 as $d2) {
                if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == '3') {
                    $id_obj_comr_obra_a = $d2->id_obj_comercial;
                    $precio_total_obra_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_obra_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 1) {
                    $id_obj_comr_bien_a = $d2->id_obj_comercial;
                    $precio_total_bien_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_bien_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                } else if ($d2->id_obj_comercial != '' && $d2->id_obj_comercial == 2) {
                    $id_obj_comr_serv_a = $d2->id_obj_comercial;
                    $precio_total_serv_a = number_format($d2->precio_total, 2, ",", ".");

                    foreach ($data3 as $d3) {
                        $porcentaje_serv_a = $d2->precio_total / $d3->precio_total * 100;
                    }
                }
            }

            // foreach($data3 as $total_ass){
            //     $total_acc = $total_ass->precio_total;
            // }
            if (!empty($data3)) {

                foreach ($data3 as $total_ass) {

                    $total_acc = $total_ass->precio_total;
                }
            }
        } else {
            $id_obj_comr_obra_a = 0;
            $precio_total_obra_a = 0;
            $porcentaje_obra_a = 0;
            $id_obj_comr_bien_a = 0;
            $precio_total_bien_a = 0;
            $porcentaje_bien_a = 0;
            $id_obj_comr_serv_a = 0;
            $precio_total_serv_a = 0;
            $porcentaje_serv_a = 0;
            $total_acc = 0;
        }

        //PROYECTO 0

        $id_obj_comr_obra_p = 0;
        $precio_total_obra_p = 0;
        $porcentaje_obra_p = 0;
        $id_obj_comr_bien_p = 0;
        $precio_total_bien_p = 0;
        $porcentaje_bien_p = 0;
        $id_obj_comr_serv_p = 0;
        $precio_total_serv_p = 0;
        $porcentaje_serv_p = 0;

        if ($data4 != '') {
            foreach ($data4 as $d) {
                if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 3) {
                    $id_obj_comr_obra_p = $d->id_obj_comercial;
                    $precio_total_obra_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_obra_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 1) {
                    $id_obj_comr_bien_p = $d->id_obj_comercial;
                    $precio_total_bien_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_bien_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                } else if ($d->id_obj_comercial != '' && $d->id_obj_comercial == 2) {
                    $id_obj_comr_serv_p = $d->id_obj_comercial;
                    $precio_total_serv_p = number_format($d->precio_total, 2, ",", ".");

                    foreach ($data5 as $d3) {
                        $porcentaje_serv_p = $d->precio_total / $d3->precio_total_py * 100;
                    }
                }
            }

            // foreach($data5 as $total_ass){
            //     $total_proy = $total_ass->precio_total_py;
            // }    
            if (!empty($data5)) {

                foreach ($data5 as $total_ass) {

                    $total_proy = $total_ass->precio_total_py;
                }
            }
        } else {
            $id_obj_comr_obra_p = 0;
            $precio_total_obra_p = 0;
            $porcentaje_obra_p = 0;
            $id_obj_comr_bien_p = 0;
            $precio_total_bien_p = 0;
            $porcentaje_bien_p = 0;
            $id_obj_comr_serv_p = 0;
            $precio_total_serv_p = 0;
            $porcentaje_serv_p = 0;
            $total_proy = 0;
        }

        $resulta = array(
            'id_programacion'      => $data['id'],
            'des_unidad'            => $des_unidad,
            'codigo_onapre'         => $codigo_onapre,
            'rif'                   => $rif,
            'id_p_acc_proy'         => 0,
            'id_obj_comr_obra'      => $id_obj_comr_obra_p,
            'precio_total_obra'     => $precio_total_obra_p,
            'porcentaje_obra'       => $porcentaje_obra_p,
            'id_obj_comr_bien'      => $id_obj_comr_bien_p,
            'precio_total_bien'     => $precio_total_bien_p,
            'porcentaje_bien'       => $porcentaje_bien_p,
            'id_obj_comr_serv'      => $id_obj_comr_serv_p,
            'precio_total_serv'     => $precio_total_serv_p,
            'porcentaje_serv'       => $porcentaje_serv_p,
            'total_proy'            => $total_proy,
            'id_p_acc'              => 1,
            'id_obj_comr_obra_a'    => $id_obj_comr_obra_a,
            'precio_total_obra_a'   => $precio_total_obra_a,
            'porcentaje_obra_a'     => $porcentaje_obra_a,
            'id_obj_comr_bien_a'    => $id_obj_comr_bien_a,
            'precio_total_bien_a'   => $precio_total_bien_a,
            'porcentaje_bien_a'     => $porcentaje_bien_a,
            'id_obj_comr_serv_a'    => $id_obj_comr_serv_a,
            'precio_total_serv_a'   => $precio_total_serv_a,
            'porcentaje_serv_a'     => $porcentaje_serv_a,
            'total_acc'             => $total_acc,
            'id_usuario'            => $this->session->userdata('id_user'),
            'anio'            => $id1,
            'trimestre'      => $data['trimestre'],

        );
        //  print_r($resulta);die;
        $this->db->insert('programacion.inf_enviada_rendi', $resulta);
        $id_ainf_enviada = $this->db->insert_id();
        $data1 = array(
            'id_ainf_enviada' => $id_ainf_enviada,
            'id_programacion'      => $data['id'],
            'observacion' =>  $data['observacion'], //    
            'id_usuario' => $this->session->userdata('id_user'),

        );

        $this->db->insert('programacion.obs_rend', $data1);
        return true;
    }
    public function get_declared_zero_trimesters($id_programacion)
    {
        $this->db->select('i.trimestre');
        $this->db->distinct();
        $this->db->from('programacion.inf_enviada_rendi i');
        $this->db->join('programacion.obs_rend o', 'i.id_ainf_enviada = o.id_ainf_enviada AND i.id_programacion = o.id_programacion');
        $this->db->where('i.id_programacion', $id_programacion);

        $query = $this->db->get();
        return array_column($query->result_array(), 'trimestre');
    }
    public function check_trimestre_declarado($id_programacion, $trimestre)
    {
        $this->db->select('1');
        $this->db->from('programacion.inf_enviada_rendi i');
        $this->db->join('programacion.obs_rend o', 'i.id_ainf_enviada = o.id_ainf_enviada AND i.id_programacion = o.id_programacion');
        $this->db->where('i.id_programacion', $id_programacion);
        $this->db->where('i.trimestre', $trimestre);

        $query = $this->db->get();
        return $query->num_rows() > 0;
    }


    // En Programacion_model.php

    // ... (tus otras funciones) ...

    // Modificación de la función para consultar reprogramaciones
    public function consultar_reprogramacion2($unidad)
    {
        $this->db->select('pp.*, pp_next.id_programacion AS id_siguiente_version'); // Seleccionar id_siguiente_version
        $this->db->from('programacion.programacion pp');
        $this->db->where('pp.unidad', $unidad);
        // Modificamos el WHERE para incluir también las versiones históricas (estatus 4) y las en creación (0)
        // Esto es para que el usuario pueda ver todas las versiones de sus programaciones.
        $this->db->where_in('pp.estatus', array(0, 2, 4)); // 0: En creación, 2: Finalizada, 4: Histórica/Reemplazada

        // LEFT JOIN para encontrar la siguiente versión (si existe)
        $this->db->join('programacion.programacion pp_next', 'pp_next.id_version_anterior = pp.id_programacion', 'left');

        $this->db->order_by('pp.anio', 'DESC'); // Ordenar por año para mejor visualización
        $this->db->order_by('pp.fecha', 'DESC'); // Y por fecha para versiones del mismo año
        $query = $this->db->get();
        return $query->result_array();
    }

    // ... (La función duplicar_programacion_completa que te di antes) ...

    public function duplicar_programacion_completa($id_programacion_original, $id_usuario_actual)
    {
        $this->db->trans_start(); // Iniciar transacción

        // 1. Duplicar programacion.programacion
        $this->db->select('*');
        $this->db->from('programacion.programacion');
        $this->db->where('id_programacion', $id_programacion_original);
        $query_original_prog = $this->db->get();
        $original_prog_data = $query_original_prog->row_array();

        if (!$original_prog_data) {
            $this->db->trans_rollback();
            return false; // No se encontró la programación original
        }

        $nueva_prog_data = array(
            'unidad'             => $original_prog_data['unidad'],
            'anio'               => $original_prog_data['anio'],
            'id_usuario'         => $id_usuario_actual,
            'fecha'              => date('Y-m-d H:i:s'), // Fecha actual de la duplicación
            'estatus'            => 0, // Estatus 'en creación' para la nueva versión
            'date_sending'       => NULL, // Se envía cuando se finaliza
            'modificado'         => $id_usuario_actual,
            'fecha_modifi'       => date('Y-m-d H:i:s'),
            'id_version_anterior' => $id_programacion_original, // Vincula a la versión original
            'id_siguiente_version' => NULL // Inicialmente no tiene una versión siguiente
        );
        $this->db->insert('programacion.programacion', $nueva_prog_data);
        $nueva_id_programacion = $this->db->insert_id();

        // 2. Duplicar programacion.p_proyecto
        $this->db->select('*');
        $this->db->from('programacion.p_proyecto');
        $this->db->where('id_programacion', $id_programacion_original);
        $proyectos_originales = $this->db->get()->result_array();

        foreach ($proyectos_originales as $proy_orig) {
            $nueva_proy_data = array(
                'id_programacion'   => $nueva_id_programacion,
                'nombre_proyecto'   => $proy_orig['nombre_proyecto'],
                'id_obj_comercial'  => $proy_orig['id_obj_comercial'],
                'id_usuario'        => $id_usuario_actual,
                'fecha'             => date('Y-m-d H:i:s'),
                'estatus'           => $proy_orig['estatus']
            );
            $this->db->insert('programacion.p_proyecto', $nueva_proy_data);
            $nueva_id_p_proyecto = $this->db->insert_id();

            // Duplicar p_items asociados a este proyecto
            $this->db->select('*');
            $this->db->from('programacion.p_items');
            $this->db->where('id_enlace', $proy_orig['id_p_proyecto']);
            $this->db->where('id_proyecto IS NOT NULL');
            $items_originales_proy = $this->db->get()->result_array();

            foreach ($items_originales_proy as $item_orig) {
                $nueva_item_data = array(
                    'id_enlace'                 => $nueva_id_p_proyecto,
                    'id_p_acc'                  => $nueva_id_p_proyecto,
                    'id_partidad_presupuestaria' => $item_orig['id_partidad_presupuestaria'],
                    'id_ccnu'                   => $item_orig['id_ccnu'],
                    'id_tip_obra'               => $item_orig['id_tip_obra'],
                    'id_alcance_obra'           => $item_orig['id_alcance_obra'],
                    'id_obj_obra'               => $item_orig['id_obj_obra'],
                    'fecha_desde'               => $item_orig['fecha_desde'],
                    'fecha_hasta'               => $item_orig['fecha_hasta'],
                    'especificacion'            => $item_orig['especificacion'],
                    'id_unidad_medida'          => $item_orig['id_unidad_medida'],
                    'cantidad'                  => $item_orig['cantidad'],
                    'i'                         => $item_orig['i'],
                    'ii'                        => $item_orig['ii'],
                    'iii'                       => $item_orig['iii'],
                    'iv'                        => $item_orig['iv'],
                    'cant_total_distribuir'     => $item_orig['cant_total_distribuir'],
                    'costo_unitario'            => $item_orig['costo_unitario'],
                    'precio_total'              => $item_orig['precio_total'],
                    'alicuota_iva'              => $item_orig['alicuota_iva'],
                    'iva_estimado'              => $item_orig['iva_estimado'],
                    'monto_estimado'            => $item_orig['monto_estimado'],
                    'est_trim_1'                => $item_orig['est_trim_1'],
                    'est_trim_2'                => $item_orig['est_trim_2'],
                    'est_trim_3'                => $item_orig['est_trim_3'],
                    'est_trim_4'                => $item_orig['est_trim_4'],
                    'estimado_total_t_acc'      => $item_orig['estimado_total_t_acc'],
                    'estatus_rendi'             => $item_orig['estatus_rendi'],
                    'reprogramado'              => 1,
                    'fecha_reprogramacion'      => date('Y-m-d H:i:s'),
                    'id_proyecto'               => $item_orig['id_proyecto'],
                    'supuestos_procedimiento'   => $item_orig['supuestos_procedimiento'],
                    'nombre_contratista'        => $item_orig['nombre_contratista'],
                    'observaciones'             => $item_orig['observaciones'],
                    'id_obj_comercial'          => $item_orig['id_obj_comercial'],
                    'id_usuario'                => $id_usuario_actual
                );
                $this->db->insert('programacion.p_items', $nueva_item_data);
            }
        }

        // 3. Duplicar programacion.p_acc_centralizada
        $this->db->select('*');
        $this->db->from('programacion.p_acc_centralizada');
        $this->db->where('id_programacion', $id_programacion_original);
        $acc_originales = $this->db->get()->result_array();

        foreach ($acc_originales as $acc_orig) {
            $nueva_acc_data = array(
                'id_programacion'           => $nueva_id_programacion,
                'id_accion_centralizada'    => $acc_orig['id_accion_centralizada'],
                'id_obj_comercial'          => $acc_orig['id_obj_comercial'],
                'id_usuario'                => $id_usuario_actual,
                'fecha'                     => date('Y-m-d H:i:s'),
                'estatus'                   => $acc_orig['estatus']
            );
            $this->db->insert('programacion.p_acc_centralizada', $nueva_acc_data);
            $nueva_id_p_acc_centralizada = $this->db->insert_id();

            // Duplicar p_items asociados a esta acción centralizada
            $this->db->select('*');
            $this->db->from('programacion.p_items');
            $this->db->where('id_enlace', $acc_orig['id_p_acc_centralizada']);
            $this->db->where('id_proyecto IS NULL');
            $items_originales_acc = $this->db->get()->result_array();

            foreach ($items_originales_acc as $item_orig) {
                $nueva_item_data = array(
                    'id_enlace'                 => $nueva_id_p_acc_centralizada,
                    'id_p_acc'                  => $nueva_id_p_acc_centralizada,
                    'id_partidad_presupuestaria' => $item_orig['id_partidad_presupuestaria'],
                    'id_ccnu'                   => $item_orig['id_ccnu'],
                    'id_tip_obra'               => $item_orig['id_tip_obra'],
                    'id_alcance_obra'           => $item_orig['id_alcance_obra'],
                    'id_obj_obra'               => $item_orig['id_obj_obra'],
                    'fecha_desde'               => $item_orig['fecha_desde'],
                    'fecha_hasta'               => $item_orig['fecha_hasta'],
                    'especificacion'            => $item_orig['especificacion'],
                    'id_unidad_medida'          => $item_orig['id_unidad_medida'],
                    'cantidad'                  => $item_orig['cantidad'],
                    'i'                         => $item_orig['i'],
                    'ii'                        => $item_orig['ii'],
                    'iii'                       => $item_orig['iii'],
                    'iv'                        => $item_orig['iv'],
                    'cant_total_distribuir'     => $item_orig['cant_total_distribuir'],
                    'costo_unitario'            => $item_orig['costo_unitario'],
                    'precio_total'              => $item_orig['precio_total'],
                    'alicuota_iva'              => $item_orig['alicuota_iva'],
                    'iva_estimado'              => $item_orig['iva_estimado'],
                    'monto_estimado'            => $item_orig['monto_estimado'],
                    'est_trim_1'                => $item_orig['est_trim_1'],
                    'est_trim_2'                => $item_orig['est_trim_2'],
                    'est_trim_3'                => $item_orig['est_trim_3'],
                    'est_trim_4'                => $item_orig['est_trim_4'],
                    'estimado_total_t_acc'      => $item_orig['estimado_total_t_acc'],
                    'estatus_rendi'             => $item_orig['estatus_rendi'],
                    'reprogramado'              => 1,
                    'fecha_reprogramacion'      => date('Y-m-d H:i:s'),
                    'id_proyecto'               => $item_orig['id_proyecto'],
                    'supuestos_procedimiento'   => $item_orig['supuestos_procedimiento'],
                    'nombre_contratista'        => $item_orig['nombre_contratista'],
                    'observaciones'             => $item_orig['observaciones'],
                    'id_obj_comercial'          => $item_orig['id_obj_comercial'],
                    'id_usuario'                => $id_usuario_actual
                );
                $this->db->insert('programacion.p_items', $nueva_item_data);
            }
        }

        // Actualizar la programación original para que apunte a la nueva versión
        $this->db->set('id_siguiente_version', $nueva_id_programacion);
        // Y cambiar su estatus a 4 (Histórica/Reemplazada)
        $this->db->set('estatus', 4);
        $this->db->where('id_programacion', $id_programacion_original);
        $this->db->update('programacion.programacion');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        return $nueva_id_programacion;
    }


    ////////////////////
    // Obtener todas las programaciones para una unidad (incluyendo históricas y en creación)
    public function get_all_programaciones_by_unidad($unidad)
    {
        $this->db->select('p.*');
        $this->db->from('programacion.programacion p');
        $this->db->where('p.unidad', $unidad);
        $this->db->order_by('p.anio', 'DESC');
        $this->db->order_by('p.num_reprogramacion', 'DESC'); // Las versiones más recientes primero
        $query = $this->db->get();
        return $query->result_array();
    }

    // Consultar una programación específica (usada en nueva_prog.php)
    public function consultar_prog_anio($id_programacion, $unidad)
    {
        $this->db->select('*');
        $this->db->from('programacion.programacion');
        $this->db->where('id_programacion', $id_programacion);
        $this->db->where('unidad', $unidad); // Asegurar que es de la unidad del usuario
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Crea una nueva versión de la programación anual (encabezado).
     * Marca la versión original como histórica.
     */
    public function crear_nueva_version_programacion($id_programacion_original, $id_usuario_actual)
    {
        $this->db->trans_start(); // Iniciar transacción

        // 1. Obtener la programación original
        $this->db->select('*');
        $this->db->from('programacion.programacion');
        $this->db->where('id_programacion', $id_programacion_original);
        $original_prog_data = $this->db->get()->row_array();

        if (!$original_prog_data) {
            $this->db->trans_rollback();
            return false; // No se encontró la programación original
        }

        // 2. Insertar la nueva versión del encabezado de la programación
        $nueva_prog_data = array(
            'unidad'             => $original_prog_data['unidad'],
            'anio'               => $original_prog_data['anio'],
            'id_usuario'         => $id_usuario_actual,
            'fecha'              => date('Y-m-d H:i:s'), // Fecha de creación de esta nueva versión
            'estatus'            => 0, // En creación/reprogramación
            'date_sending'       => NULL,
            'modificado'         => $id_usuario_actual,
            'fecha_modifi'       => date('Y-m-d H:i:s'),
            'id_version_anterior' => $id_programacion_original, // Apunta a la original
            'num_reprogramacion' => $original_prog_data['num_reprogramacion'] + 1 // Incrementa el contador
        );
        $this->db->insert('programacion.programacion', $nueva_prog_data);
        $nueva_id_programacion = $this->db->insert_id();

        // 3. Marcar la versión original como histórica
        $this->db->set('estatus', 4); // Cambiar a estatus 'Histórica/Reemplazada'
        $this->db->set('fecha_modifi', date('Y-m-d H:i:s')); // Actualizar fecha de modificación
        $this->db->set('modificado', $id_usuario_actual);
        $this->db->where('id_programacion', $id_programacion_original);
        $this->db->update('programacion.programacion');

        // 4. (Opcional pero recomendado) Actualizar los ítems y proyectos/acciones de la versión original
        // para que también apunten a la nueva id_programacion si no se modificaron,
        // o si queremos un historial "aplanado" de cada versión.
        // OJO: Esta parte es delicada y depende de cómo manejes las consultas.
        // En este modelo de versionado a nivel de registro, los ítems y proyectos/acciones
        // de la versión original se mantienen tal cual, y al consultar la nueva versión,
        // solo se mostrarán los que tienen id_programacion = nueva_id_programacion
        // y fecha_fin_vigencia IS NULL.

        $this->db->trans_complete(); // Finalizar transacción

        if ($this->db->trans_status() === FALSE) {
            return false; // Falló la transacción
        }
        return $nueva_id_programacion; // Retorna el ID de la nueva programación en edición
    }

    /**
     * Marca una programación como finalizada (estatus 2).
     */
    public function finalizar_programacion($id_programacion_actual, $id_usuario_actual)
    {
        $this->db->trans_start();

        $data = array(
            'estatus'      => 2, // Finalizada/Activa
            'date_sending' => date('Y-m-d'), // Fecha de envío
            'modificado'   => $id_usuario_actual,
            'fecha_modifi' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_programacion', $id_programacion_actual);
        $this->db->update('programacion.programacion', $data);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // --- Métodos de CRUD para Proyectos (p_proyecto) ---
    // ESTOS MÉTODOS DEBEN SER ADAPTADOS PARA EL VERSIONADO DE REGISTROS

    /**
     * Inserta un nuevo proyecto (primera versión o una nueva versión si fue editado/eliminado).
     */
    public function insert_proyecto($data)
    {
        // $data debe contener: id_programacion, nombre_proyecto, id_obj_comercial, id_usuario
        $data['fecha'] = date('Y-m-d H:i:s');
        $data['fecha_fin_vigencia'] = NULL;
        $data['id_version_anterior_proyecto'] = NULL; // Asumimos INSERT de un proyecto nuevo o una nueva versión
        $data['tipo_operacion'] = 'INSERT';
        $data['id_usuario_operacion'] = $data['id_usuario'];

        $this->db->insert('programacion.p_proyecto', $data);
        return $this->db->insert_id();
    }

    /**
     * Actualiza un proyecto (marca la versión anterior como histórica e inserta una nueva).
     */
    public function update_proyecto($id_p_proyecto_original, $new_data, $id_usuario_actual)
    {
        $this->db->trans_start();

        // 1. Marcar la versión original como no vigente
        $this->db->set('fecha_fin_vigencia', date('Y-m-d H:i:s'));
        $this->db->set('tipo_operacion', 'UPDATE'); // Marcar la operación que terminó su vigencia
        $this->db->set('id_usuario_operacion', $id_usuario_actual); // Quién la marcó
        $this->db->where('id_p_proyecto', $id_p_proyecto_original);
        $this->db->update('programacion.p_proyecto');

        // 2. Insertar la nueva versión del proyecto con los datos actualizados
        $new_data['fecha'] = date('Y-m-d H:i:s'); // Fecha de creación de esta nueva versión
        $new_data['fecha_fin_vigencia'] = NULL; // Vigente
        $new_data['id_version_anterior_proyecto'] = $id_p_proyecto_original; // Apunta a la versión anterior
        $new_data['tipo_operacion'] = 'INSERT'; // Esta es la nueva inserción
        $new_data['id_usuario_operacion'] = $id_usuario_actual;
        // id_programacion ya debe venir en $new_data (la id de la programacion actual)
        $this->db->insert('programacion.p_proyecto', $new_data);
        $nuevo_id_p_proyecto = $this->db->insert_id();

        $this->db->trans_complete();
        return $this->db->trans_status() ? $nuevo_id_p_proyecto : false;
    }

    /**
     * Elimina "lógicamente" un proyecto (marca la versión actual como no vigente).
     */
    public function delete_proyecto_logico($id_p_proyecto, $id_usuario_actual)
    {
        $this->db->set('fecha_fin_vigencia', date('Y-m-d H:i:s'));
        $this->db->set('tipo_operacion', 'DELETE');
        $this->db->set('id_usuario_operacion', $id_usuario_actual);
        $this->db->where('id_p_proyecto', $id_p_proyecto);
        return $this->db->update('programacion.p_proyecto');
    }

    /**
     * Consulta proyectos VIGENTES para una PROGRAMACIÓN ESPECÍFICA.
     */
    public function consultar_proyectos_vigentes($id_programacion)
    {
        $this->db->select('pp.*');
        $this->db->from('programacion.p_proyecto pp');
        $this->db->where('pp.id_programacion', $id_programacion);
        $this->db->where('pp.fecha_fin_vigencia IS NULL'); // SOLO VIGENTES
        // Si necesitas JOIN con otras tablas (ej. para nombre_proyecto o desc_objeto_contrata)
        // $this->db->join('otra_tabla ot', 'ot.id = pp.otro_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


    // --- Métodos de CRUD para Acciones Centralizadas (p_acc_centralizada) ---
    // Adaptar de forma similar a los proyectos

    /**
     * Inserta una nueva acción centralizada.
     */
    public function insert_acc_centralizada($data)
    {
        // ... (similar a insert_proyecto) ...
        $data['fecha'] = date('Y-m-d H:i:s');
        $data['fecha_fin_vigencia'] = NULL;
        $data['id_version_anterior_acc'] = NULL;
        $data['tipo_operacion'] = 'INSERT';
        $data['id_usuario_operacion'] = $data['id_usuario'];
        $this->db->insert('programacion.p_acc_centralizada', $data);
        return $this->db->insert_id();
    }

    /**
     * Actualiza una acción centralizada.
     */
    public function update_acc_centralizada($id_p_acc_centralizada_original, $new_data, $id_usuario_actual)
    {
        $this->db->trans_start();

        $this->db->set('fecha_fin_vigencia', date('Y-m-d H:i:s'));
        $this->db->set('tipo_operacion', 'UPDATE');
        $this->db->set('id_usuario_operacion', $id_usuario_actual);
        $this->db->where('id_p_acc_centralizada', $id_p_acc_centralizada_original);
        $this->db->update('programacion.p_acc_centralizada');

        $new_data['fecha'] = date('Y-m-d H:i:s');
        $new_data['fecha_fin_vigencia'] = NULL;
        $new_data['id_version_anterior_acc'] = $id_p_acc_centralizada_original;
        $new_data['tipo_operacion'] = 'INSERT';
        $new_data['id_usuario_operacion'] = $id_usuario_actual;
        $this->db->insert('programacion.p_acc_centralizada', $new_data);
        $nuevo_id_p_acc_centralizada = $this->db->insert_id();

        $this->db->trans_complete();
        return $this->db->trans_status() ? $nuevo_id_p_acc_centralizada : false;
    }

    /**
     * Elimina "lógicamente" una acción centralizada.
     */
    public function delete_acc_centralizada_logico($id_p_acc_centralizada, $id_usuario_actual)
    {
        $this->db->set('fecha_fin_vigencia', date('Y-m-d H:i:s'));
        $this->db->set('tipo_operacion', 'DELETE');
        $this->db->set('id_usuario_operacion', $id_usuario_actual);
        $this->db->where('id_p_acc_centralizada', $id_p_acc_centralizada);
        return $this->db->update('programacion.p_acc_centralizada');
    }

    /**
     * Consulta acciones centralizadas VIGENTES para una PROGRAMACIÓN ESPECÍFICA.
     */
    public function consultar_acc_centralizada_vigentes($id_programacion)
    {
        $this->db->select('pac.*');
        $this->db->from('programacion.p_acc_centralizada pac');
        $this->db->where('pac.id_programacion', $id_programacion);
        $this->db->where('pac.fecha_fin_vigencia IS NULL'); // SOLO VIGENTES
        $query = $this->db->get();
        return $query->result_array();
    }


    // --- Métodos de CRUD para Ítems (p_items) ---
    // ESTOS MÉTODOS SON LOS MÁS CRÍTICOS PARA ADAPTAR

    /**
     * Inserta un nuevo ítem (primera versión o nueva versión de un ítem modificado).
     */
    public function insert_item($data)
    {
        // $data debe contener id_enlace (vigente), id_programacion (actual), y todos los campos del ítem
        $data['fecha_inicio_vigencia'] = date('Y-m-d H:i:s');
        $data['fecha_fin_vigencia'] = NULL; // Vigente
        $data['id_version_anterior_item'] = NULL; // Si es una nueva inserción
        $data['tipo_operacion'] = 'INSERT';
        $data['id_usuario_operacion'] = $data['id_usuario'];
        $this->db->insert('programacion.p_items', $data);
        return $this->db->insert_id();
    }

    /**
     * Actualiza un ítem (marca la versión anterior como no vigente e inserta una nueva versión).
     */
    public function update_item($id_p_items_original, $new_data, $id_usuario_actual)
    {
        $this->db->trans_start();

        // 1. Marcar la versión original del ítem como no vigente
        $this->db->set('fecha_fin_vigencia', date('Y-m-d H:i:s'));
        $this->db->set('tipo_operacion', 'UPDATE'); // La operación que causó el cambio
        $this->db->set('id_usuario_operacion', $id_usuario_actual);
        $this->db->where('id_p_items', $id_p_items_original);
        $this->db->update('programacion.p_items');

        // 2. Insertar la nueva versión del ítem con los datos actualizados
        $new_data['fecha_inicio_vigencia'] = date('Y-m-d H:i:s');
        $new_data['fecha_fin_vigencia'] = NULL;
        $new_data['id_version_anterior_item'] = $id_p_items_original; // Apunta a la versión anterior
        $new_data['tipo_operacion'] = 'INSERT'; // Esta es la nueva inserción
        $new_data['id_usuario_operacion'] = $id_usuario_actual;
        // Asegúrate de que $new_data contenga 'id_enlace' (del proyecto/acción VIGENTE) y 'id_programacion' (de la programación ACTUAL)
        $this->db->insert('programacion.p_items', $new_data);
        $nuevo_id_p_items = $this->db->insert_id();

        $this->db->trans_complete();
        return $this->db->trans_status() ? $nuevo_id_p_items : false;
    }

    /**
     * Elimina "lógicamente" un ítem (marca la versión actual como no vigente).
     */
    public function delete_item_logico($id_p_items, $id_usuario_actual)
    {
        $this->db->set('fecha_fin_vigencia', date('Y-m-d H:i:s'));
        $this->db->set('tipo_operacion', 'DELETE');
        $this->db->set('id_usuario_operacion', $id_usuario_actual);
        $this->db->where('id_p_items', $id_p_items);
        return $this->db->update('programacion.p_items');
    }

    /**
     * Consulta ítems VIGENTES para una PROGRAMACIÓN ESPECÍFICA (y su proyecto/acción vigente).
     */
    public function consultar_items_vigentes($id_programacion, $id_enlace_vigente)
    {
        $this->db->select('pi.*');
        $this->db->from('programacion.p_items pi');
        $this->db->where('pi.id_programacion', $id_programacion);
        $this->db->where('pi.id_enlace', $id_enlace_vigente); // Es crucial que el id_enlace sea el de la versión vigente del proyecto/acción
        $this->db->where('pi.fecha_fin_vigencia IS NULL'); // SOLO VIGENTES
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Consulta el total por partidas presupuestarias para una PROGRAMACIÓN ESPECÍFICA (solo ítems vigentes).
     */
    public function total_por_partidas_vigentes($id_programacion)
    {
        $this->db->select('ppp.codigopartida_presupuestaria, ppp.desc_partida_presupuestaria, SUM(CAST(pi.precio_total AS NUMERIC)) AS precio_total, SUM(CAST(pi.monto_estimado AS NUMERIC)) AS monto_estimado');
        $this->db->from('programacion.p_items pi');
        $this->db->join('programacion.partida_presupuestaria ppp', 'ppp.id = pi.id_partidad_presupuestaria'); // Asumo nombre de tabla y columna
        $this->db->where('pi.id_programacion', $id_programacion);
        $this->db->where('pi.fecha_fin_vigencia IS NULL'); // Solo ítems vigentes
        $this->db->group_by('ppp.codigopartida_presupuestaria, ppp.desc_partida_presupuestaria');
        $this->db->order_by('ppp.codigopartida_presupuestaria');
        $query = $this->db->get();
        return $query->result_array();
    }


    // --- Métodos para consultar el HISTÓRICO de un Ítem/Proyecto/Acción ---
    // (Opcional, para una vista de auditoría)
    public function get_item_history($original_item_id)
    {
        $this->db->select('*');
        $this->db->from('programacion.p_items');
        $this->db->where('id_p_items', $original_item_id);
        $this->db->or_where('id_version_anterior_item', $original_item_id);
        $this->db->order_by('fecha_inicio_vigencia', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    ///////////////////////versionado 
    // Obtener la versión actual
    public function obtener_version_actual($id_enlace)
    {
        $this->db->select('MAX(version) as version');
        $this->db->where('id_enlace', $id_enlace);
        $query = $this->db->get('programacion.p_items');
        $row = $query->row();
        return $row ? $row->version : 1;
    }

    // Desactivar versión anterior
    public function desactivar_version_anterior($id_enlace)
    {
        $this->db->where('id_enlace', $id_enlace);
        $this->db->where('vigente', TRUE);
        $this->db->update('programacion.p_items', ['vigente' => FALSE]);
    }

    // Insertar nuevo ítem con nueva versión
    public function agregar_mas_item_versionado($data, $p_ffinanciamiento)
    {
        // Obtener nuevo id_p_items
        $this->db->select('MAX(id_p_items) as id1');
        $query = $this->db->get('programacion.p_items');
        $id1 = $query->row()->id1 + 1;
        $data['id_p_items'] = $id1;

        // Si viene sin id_original, significa que es un item nuevo
        if (!isset($data['id_original']) || empty($data['id_original'])) {
            $data['id_original'] = $id1;
        }

        // Si es una nueva versión, id_original debe venir del item anterior
        // y la versión anterior debe marcarse como no vigente
        if (isset($data['id_p_items_ant'])) {
            $this->db->set('vigente', FALSE);
            $this->db->where('id_p_items', $data['id_p_items_ant']);
            $this->db->update('programacion.p_items');
        }

        // Inserta el nuevo item versionado
        $insert = $this->db->insert('programacion.p_items', $data);

        if ($insert) {
            $p_ffinanciamiento['id_p_items'] = $id1;
            $p_ffinanciamiento['id_original'] = $data['id_original'];
            $this->db->insert('programacion.p_ffinanciamiento', $p_ffinanciamiento);
            return true;
        }

        return false;
    }
    public function desactivar_item_versionado($id_p_items, $id_usuario)
    {
        $this->db->where('id_p_items', $id_p_items);
        return $this->db->update('programacion.p_items', [
            'vigente' => FALSE,
            'fecha_version' => date('Y-m-d H:i:s'),
            'usuario_version' => $id_usuario
        ]);
    }

    function consultar_scc_version($id_p_acc_centralizada)
    {

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada');
        $this->db->join('programacion.ccnu c2', 'c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp', 'pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um', 'um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->join('programacion.p_acc_centralizada p', 'p.id_p_acc_centralizada = pi2.id_enlace'); // esto viara cuando sea un proyecto consultar tabla proyecto
        $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
        $this->db->where('pi2.id_p_acc', 1);
        $this->db->where('pi2.vigente', 'TRUE');
        // $this->db->where('pi2.version', '1');


        $this->db->from('programacion.p_items pi2');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function agregar_mas_item_versionado2($data, $p_ffinanciamiento)
    {
        // Obtener nuevo id_p_items
        $this->db->select('MAX(id_p_items) as id1');
        $query = $this->db->get('programacion.p_items');
        $id1 = $query->row()->id1 + 1;
        $data['id_p_items'] = $id1;

        // Si viene sin id_original, significa que es un item nuevo
        if (!isset($data['id_original']) || empty($data['id_original'])) {
            $data['id_original'] = $id1;
        }

        // Si es una nueva versión, id_original debe venir del item anterior
        // y la versión anterior debe marcarse como no vigente
        if (isset($data['id_p_items_ant'])) {
            $this->db->set('vigente', FALSE);
            $this->db->where('id_p_items', $data['id_p_items_ant']);
            $this->db->update('programacion.p_items');
        }

        // Inserta el nuevo item versionado
        $insert = $this->db->insert('programacion.p_items', $data);

        if ($insert) {
            $p_ffinanciamiento['id_p_items'] = $id1;
            $p_ffinanciamiento['id_original'] = $data['id_original'];
            $this->db->insert('programacion.p_ffinanciamiento', $p_ffinanciamiento);
            return true;
        }

        return false;
    }

    ///reporte de modificaciones 
    public function consulta_total_objeto_acc($data1)
    {

        $query = $this->db->query("
        SELECT  
            pac.id_p_acc,
            pac.id_proyecto,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata,
            SUM(to_number(pac.monto_estimado, '999999999999D99')) AS precio_total
        FROM programacion.p_items pac
        JOIN programacion.objeto_contrata ob 
            ON ob.id_objeto_contrata = pac.id_obj_comercial
        WHERE pac.id_proyecto = '$data1' 
          AND pac.id_p_acc = '1'
         AND pac.vigente = TRUE  
        GROUP BY 
            pac.id_p_acc,
            pac.id_proyecto,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata
    ");

        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }
    public function consulta_total_acc($data1)
    {
        $query = $this->db->query("
        SELECT  
            pac.id_p_acc,
            pac.id_proyecto,
            SUM(to_number(pac.monto_estimado, '999999999999D99')) AS precio_total
        FROM programacion.p_items pac
        WHERE pac.id_proyecto = '$data1' 
          AND pac.id_p_acc = '1'
          AND pac.vigente = TRUE   
        GROUP BY pac.id_p_acc, pac.id_proyecto
    ");

        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }
    public function consulta_total_objeto_py2($data1)
    {
        // Totales agrupados por bienes, servicios y obras (proyectos)
        $query = $this->db->query("
        SELECT  
            pac.id_p_acc,
            pac.id_proyecto,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata,
            SUM(to_number(pac.monto_estimado, '999999999999D99')) AS precio_total
        FROM programacion.p_items pac
        JOIN programacion.objeto_contrata ob 
            ON ob.id_objeto_contrata = pac.id_obj_comercial
        WHERE pac.id_proyecto = '$data1' 
          AND pac.id_p_acc = '0'
          AND pac.vigente = TRUE  -- ✅ Solo ítems vigentes
        GROUP BY 
            pac.id_p_acc,
            pac.id_proyecto,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata
    ");

        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }

    public function consulta_total_PYT($data1)
    {
        $query = $this->db->query("
        SELECT  
            pac.id_p_acc,
            pac.id_proyecto,
            SUM(to_number(pac.monto_estimado, '999999999999D99')) AS precio_total_py
        FROM programacion.p_items pac
        WHERE pac.id_proyecto = '$data1' 
          AND pac.id_p_acc = '0'
          AND pac.vigente = TRUE  -- ✅ Solo ítems vigentes
        GROUP BY pac.id_p_acc, pac.id_proyecto
    ");

        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }

    /////////////////////////
    public function consulta_total_objeto_accv1($data1)
    {

        $query = $this->db->query("
        SELECT  
            pac.id_p_acc,
            pac.id_proyecto,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata,
            SUM(to_number(pac.monto_estimado, '999999999999D99')) AS precio_total
        FROM programacion.p_items pac
        JOIN programacion.objeto_contrata ob 
            ON ob.id_objeto_contrata = pac.id_obj_comercial
        WHERE pac.id_proyecto = '$data1' 
          AND pac.id_p_acc = '1'
         AND pac.version = '1'  
        GROUP BY 
            pac.id_p_acc,
            pac.id_proyecto,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata
    ");

        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }
    public function consulta_total_accv1($data1)
    {
        $query = $this->db->query("
        SELECT  
            pac.id_p_acc,
            pac.id_proyecto,
            SUM(to_number(pac.monto_estimado, '999999999999D99')) AS precio_total
        FROM programacion.p_items pac
        WHERE pac.id_proyecto = '$data1' 
          AND pac.id_p_acc = '1'
         AND pac.version = '1'  
        GROUP BY pac.id_p_acc, pac.id_proyecto
    ");

        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }

    public function consulta_total_objeto_pyv1($data1)
    {
        // Totales agrupados por bienes, servicios y obras (proyectos)
        $query = $this->db->query("
        SELECT  
            pac.id_p_acc,
            pac.id_proyecto,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata,
            SUM(to_number(pac.monto_estimado, '999999999999D99')) AS precio_total
        FROM programacion.p_items pac
        JOIN programacion.objeto_contrata ob 
            ON ob.id_objeto_contrata = pac.id_obj_comercial
        WHERE pac.id_proyecto = '$data1' 
          AND pac.id_p_acc = '0'
           AND pac.version = '1' 
        GROUP BY 
            pac.id_p_acc,
            pac.id_proyecto,
            pac.id_obj_comercial,
            ob.desc_objeto_contrata
    ");

        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }

    public function consulta_total_PYTv1($data1)
    {
        $query = $this->db->query("
        SELECT  
            pac.id_p_acc,
            pac.id_proyecto,
            SUM(to_number(pac.monto_estimado, '999999999999D99')) AS precio_total_py
        FROM programacion.p_items pac
        WHERE pac.id_proyecto = '$data1' 
          AND pac.id_p_acc = '0'
          AND pac.version = '1'  
        GROUP BY pac.id_p_acc, pac.id_proyecto
    ");

        return ($query->num_rows() > 0) ? $query->result() : NULL;
    }

    ////////////////////execiones
    // Lista años programados por RIF (según tu tabla programacion.programacion)
    public function anios_programados_por_rif($rif)
    {
        // DISTINCT debe ir sin escapar -> segundo argumento FALSE
        $this->db->select('DISTINCT p.anio', false);
        $this->db->from('programacion.programacion p');
        $this->db->join('public.organoente o', 'o.codigo = p.unidad');
        $this->db->where('o.rif', $rif);
        $this->db->order_by('p.anio', 'DESC');

        $q = $this->db->get();
        return $q->result_array(); // devuelve [ ['anio'=>2025], ... ]
    }
    public function ente_por_rif($rif)
    {
        if (!$rif) return null;
        $this->db->select('descripcion, rif, codigo');
        $this->db->where('rif', $rif);
        $this->db->limit(1);
        $q = $this->db->get('public.organoente');
        return $q->num_rows() ? $q->row_array() : null;
    }

    public function descripcion_por_rif_exacta($rif)
    {
        if (!$rif) return null;
        // Búsqueda exacta. Si tu columna guarda en mayúsculas, usa strtoupper().
        return $this->db
            ->select('descripcion, rif, codigo, cod_onapre')
            ->from('public.organoente')
            ->where('rif', trim($rif))   // <-- exacto
            ->limit(1)
            ->get()
            ->row_array();
    }

    // Crear excepción
    public function crear_excepcion_rendicion($rif, $anio, $fecha_inicio, $fecha_fin, $motivo, $user_id)
    {
        $data = [
            'rif'          => $rif,
            'anio'         => (int)$anio,
            'habilitado'   => true,
            'fecha_inicio' => $fecha_inicio ?: null,
            'fecha_fin'    => $fecha_fin ?: null,
            'motivo'       => $motivo,
            'creado_por'   => $user_id
        ];
        return $this->db->insert('programacion.rendicion_excepciones', $data);
    }

    // Deshabilitar excepción (soft off)
    // En Programacion_model.php
    // Programacion_model.php

    public function deshabilitar_excepcion_rendicion($id)
    {
        if (empty($id)) {
            return ['ok' => false, 'affected' => 0, 'msg' => 'ID vacío'];
        }

        $this->db->trans_start();

        // Consulta CORREGIDA: Simplemente actualiza el estado por ID
        $sql = "
    UPDATE programacion.rendicion_excepciones
       SET habilitado = FALSE
     WHERE id = ? 
    ";
        $this->db->query($sql, [(int)$id]);

        $affected = $this->db->affected_rows();
        $this->db->trans_complete();

        // Mantenemos la lógica de estado para devolver un mensaje informativo
        $ok = $this->db->trans_status() && ($affected > 0);

        return [
            'ok'       => $ok,
            'affected' => $affected,
            'msg'      => $ok ? 'Excepción deshabilitada' : 'No se actualizó ninguna fila (es posible que ya estuviera deshabilitada o el ID no exista).'
            // Si $affected es 1, retorna code 1 y el JS recarga.
            // Si $affected es 0, retorna code 0 y el JS muestra el mensaje de error/informativo.
        ];
    }


    // Listar excepciones por RIF (para panel admin)
    public function listar_excepciones_por_rif($rif)
    {
        $this->db->from('programacion.rendicion_excepciones');
        $this->db->where('rif', $rif);
        $this->db->order_by('anio', 'DESC');
        return $this->db->get()->result_array();
    }

    // ¿Tiene excepción vigente hoy para ese año?
    public function tiene_excepcion_rendicion($rif, $anio)
    {
        $hoy = date('Y-m-d');
        $where = "habilitado = true AND rif = ? AND anio = ? AND
             ( (fecha_inicio IS NULL OR fecha_inicio <= ?) AND
               (fecha_fin    IS NULL OR fecha_fin    >= ?) )";
        $q = $this->db->query("
        SELECT 1 
          FROM programacion.rendicion_excepciones 
         WHERE $where 
         LIMIT 1
    ", [$rif, (int)$anio, $hoy, $hoy]);
        return $q->num_rows() > 0;
    }
}
