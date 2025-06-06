<?php

class Tablas_model extends CI_Model
{

    //________FUENTE DE FINANCIAMIENTO_____________
    public function get_entries()
    {
        $query = $this->db->get('programacion.fuente_financiamiento');
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function saves($data)
    {
        return $this->db->insert('programacion.fuente_financiamiento', $data);
    }

    public function delete_entry($id)
    {
        return $this->db->delete('programacion.fuente_financiamiento', array('id_fuente_financiamiento' => $id));
    }

    public function single_entry($id)
    {
        $this->db->select('*');
        $this->db->from('programacion.fuente_financiamiento');
        $this->db->where('id_fuente_financiamiento', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_entry($data)
    {
        return $this->db->update('programacion.fuente_financiamiento', $data, array('id_fuente_financiamiento' => $data['id_fuente_financiamiento']));
    }

    //____________ALICUOTA______________________
    public function get_alicuota()
    {
        $query = $this->db->get('programacion.alicuota_iva');
        // if (count($query->result()) > 0) {
        return $query->result();
        // }
    }

    public function savesalicuota($data)
    {
        return $this->db->insert('programacion.alicuota_iva', $data);
    }

    public function delete_alicuota($id)
    {
        return $this->db->delete('programacion.alicuota_iva', array('id_alicuota_iva' => $id));
    }

    public function single_alicuota($id)
    {
        $this->db->select('*');
        $this->db->from('programacion.alicuota_iva');
        $this->db->where('id_alicuota_iva', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_alicuota($data)
    {
        return $this->db->update('programacion.alicuota_iva', $data, array('id_alicuota_iva' => $data['id_alicuota_iva']));
    }

    //_________________PARTIDA PRESUPUESTARIA _________________________________________________
    function consultar_partida1()
    {
        $this->db->select('*');
        $this->db->from('programacion.partida_presupuestaria');
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function registrar_b($data)
    {
        // 1. Eliminar espacios de inicio y final para ambos campos
        $codigo_input_trimmed = trim($data['codigopartida_presupuestaria']);
        $descripcion_input_trimmed = trim($data['desc_partida_presupuestaria']);

        // 2. Preparar el código para validación y almacenamiento (SIEMPRE EN MAYÚSCULAS)
        $codigo_input_upper = strtoupper($codigo_input_trimmed);

        // 3. Preparar la descripción para validación (solo convertir a mayúsculas para la comparación)
        $descripcion_for_validation_upper = strtoupper($descripcion_input_trimmed);


        // --- Paso 1: Verificar si 'codigopartida_presupuestaria' ya existe (insensible a mayúsculas/minúsculas y sin espacios) ---
        // Construcción manual de la cláusula WHERE para depuración si es necesario.
        // $this->db->where("UPPER(TRIM(codigopartida_presupuestaria)) = '" . $codigo_input_upper . "'");
        $this->db->where("UPPER(TRIM(codigopartida_presupuestaria))", $codigo_input_upper);
        $query_codigo = $this->db->get('programacion.partida_presupuestaria');

        // Para depuración: Puedes imprimir la última consulta ejecutada y el número de filas.
        // log_message('debug', 'SQL Codigo: ' . $this->db->last_query());
        // log_message('debug', 'Rows Codigo: ' . $query_codigo->num_rows());

        if ($query_codigo->num_rows() > 0) {
            return 2; // El CÓDIGO ya existe
        }

        // --- Paso 2: Verificar si 'desc_partida_presupuestaria' ya existe (insensible a mayúsculas/minúsculas y sin espacios) ---
        $this->db->reset_query(); // Limpiar condiciones WHERE anteriores
        // $this->db->where("UPPER(TRIM(desc_partida_presupuestaria)) = '" . $descripcion_for_validation_upper . "'");
        $this->db->where("UPPER(TRIM(desc_partida_presupuestaria))", $descripcion_for_validation_upper);
        $query_desc = $this->db->get('programacion.partida_presupuestaria');

        // Para depuración: Puedes imprimir la última consulta ejecutada y el número de filas.
        // log_message('debug', 'SQL Desc: ' . $this->db->last_query());
        // log_message('debug', 'Rows Desc: ' . $query_desc->num_rows());

        if ($query_desc->num_rows() > 0) {
            return 3; // La DESCRIPCIÓN ya existe
        }

        // --- Paso 3: Si no hay duplicados, proceder con la inserción ---

        // Obtener el ID máximo y sumar 1
        $this->db->select('MAX(e.id_partida_presupuestaria) as id1');
        $query_max_id = $this->db->get('programacion.partida_presupuestaria e');
        $response_max_id = $query_max_id->row_array();
        $id1 = ($response_max_id['id1'] === null) ? 1 : $response_max_id['id1'] + 1;

        // Preparamos los datos para la inserción.
        $data_to_insert = array(
            'id_partida_presupuestaria'    => $id1,
            'codigopartida_presupuestaria' => $codigo_input_upper,     // En mayúsculas y sin espacios
            'desc_partida_presupuestaria'  => $descripcion_input_trimmed, // Con mayúsculas/minúsculas originales y sin espacios
            'id_usuario'                   => $data['id_usuario'],
            'fecha'                        => $data['fecha']
        );

        try {
            $this->db->insert('programacion.partida_presupuestaria', $data_to_insert);
            // log_message('debug', 'SQL Insert: ' . $this->db->last_query());
            // log_message('debug', 'Affected Rows Insert: ' . $this->db->affected_rows());
            return $this->db->affected_rows() > 0 ? 1 : 0; // 1 para éxito, 0 para fallo genérico
        } catch (Exception $e) {
            // log_message('error', 'Error de inserción en DB: ' . $e->getMessage());
            return 0; // Error general al insertar
        }
    }
    function consulta_b($data)
    {
        $this->db->select('*');
        $this->db->from('programacion.partida_presupuestaria');
        $this->db->where('id_partida_presupuestaria', $data['id_exonerado']);
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    function editar_b($data)
    {
        $this->db->where('id_partida_presupuestaria', $data['id_partida_presupuestaria']);
        $update = $this->db->update('programacion.partida_presupuestaria', $data);
        return true;
    }

    public function get_partidap()
    {
        $query = $this->db->get('programacion.partida_presupuestaria');
        // if (count($query->result()) > 0) {
        return $query->result();
        // }
    }

    public function savepartidap($data)
    {
        $this->db->select('max(e.id_partida_presupuestaria) as id1');
        $query1 = $this->db->get('programacion.partida_presupuestaria e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data3 = array(
            'id_partida_presupuestaria'    => $id1,
            'codigopartida_presupuestaria'                   => $data['codigopartida_presupuestaria'],
            'desc_partida_presupuestaria' => $data['desc_partida_presupuestaria'],
            'desc_partida_presupuestaria' => $data['desc_partida_presupuestaria'],
            'id_usuario' => $data['id_usuario'],

        );
        $this->db->insert('programacion.partida_presupuestaria', $data3);
        return true;

        // return $this->db->insert('programacion.partida_presupuestaria', $data);
    }

    public function delete_partidap($id)
    {
        return $this->db->delete('programacion.partida_presupuestaria', array('id_partida_presupuestaria' => $id));
    }

    public function single_partidap($id)
    {
        $this->db->select('*');
        $this->db->from('programacion.partida_presupuestaria');
        $this->db->where('id_partida_presupuestaria', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_partidap($data)
    {
        return $this->db->update('programacion.partida_presupuestaria', $data, array('id_partida_presupuestaria' => $data['id_partida_presupuestaria']));
    }

    //______________ACCION CENTRALIZADA______________________
    public function get_centra()
    {
        $query = $this->db->get('programacion.accion_centralizada');
        // if (count($query->result()) > 0) {
        return $query->result();
        // }
    }

    public function savecentra($data)
    {
        return $this->db->insert('programacion.accion_centralizada', $data);
    }

    public function delete_centra($id)
    {
        return $this->db->delete('programacion.accion_centralizada', array('id_accion_centralizada' => $id));
    }

    public function single_centra($id)
    {
        $this->db->select('*');
        $this->db->from('programacion.accion_centralizada');
        $this->db->where('id_accion_centralizada', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_centra($data)
    {
        return $this->db->update('programacion.accion_centralizada', $data, array('id_accion_centralizada' => $data['id_accion_centralizada']));
    }

    //_______________UNIDAD DE MEDIDA _____________
    public function get_und()
    {
        $query = $this->db->get('programacion.unidad_medida');
        // if (count($query->result()) > 0) {
        return $query->result();
        // }
    }

    public function save_und($data)
    {
        return $this->db->insert('programacion.unidad_medida', $data);
    }

    public function delete_und($id)
    {
        return $this->db->delete('programacion.unidad_medida', array('id_unidad_medida' => $id));
    }

    public function single_und($id)
    {
        $this->db->select('*');
        $this->db->from('programacion.unidad_medida');
        $this->db->where('id_unidad_medida', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_und($data)
    {
        return $this->db->update('programacion.unidad_medida', $data, array('id_unidad_medida' => $data['id_unidad_medida']));
    }

    //_____________________CCNU____________________

    public function get_ccnu()
    {
        $query = $this->db->get('programacion.ccnu');
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_ccnu($data)
    {
        return $this->db->insert('programacion.ccnu', $data);
    }

    public function delete_ccnu($id)
    {
        return $this->db->delete('programacion.ccnu', array('id_ccnu' => $id));
    }

    public function single_ccnu($id)
    {
        $this->db->select('*');
        $this->db->from('programacion.ccnu');
        $this->db->where('id_ccnu', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_ccnu($data)
    {
        return $this->db->update('programacion.ccnu', $data, array('id_ccnu' => $data['id_ccnu']));
    }

    //_______ESTADO CRUD___________________________________________________
    public function get_estado()
    {
        $query = $this->db->get('public.estados');
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_estado($data)
    {
        return $this->db->insert('public.estados', $data);
    }

    public function single_estado($id)
    {
        $this->db->select('*');
        $this->db->from('public.estados');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_estado($data)
    {
        return $this->db->update('public.estados', $data, array('id' => $data['id']));
    }

    //_______ municipio___________________________________________________
    public function get_municipio()
    {
        $this->db->order_by("estado_id", "ASC");
        $query = $this->db->get('public.municipios');

        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_municipio($data)
    {
        return $this->db->insert('public.municipios', $data);
    }

    public function single_municipio($id)
    {
        $this->db->select('*');
        $this->db->from('public.municipios');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_municipio($data)
    {
        return $this->db->update('public.municipios', $data, array('id' => $data['id']));
    }

    //_______ parroquia___________________________________________________
    public function get_parroquia()
    {
        $this->db->order_by("estado_id", "ASC");
        $query = $this->db->get('public.parroquias');

        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_parroquia($data)
    {
        return $this->db->insert('public.parroquias', $data);
    }

    public function single_parroquia($id)
    {
        $this->db->select('*');
        $this->db->from('public.parroquias');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_parroquia($data)
    {
        return $this->db->update('public.parroquias', $data, array('id' => $data['id']));
    }

    //_______ ciudades___________________________________________________
    public function get_ciudades()
    {
        $this->db->order_by("estado_id", "ASC");
        $query = $this->db->get('public.ciudades');

        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_ciudades($data)
    {
        return $this->db->insert('public.ciudades', $data);
    }

    public function single_ciudades($id)
    {
        $this->db->select('*');
        $this->db->from('public.ciudades');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_ciudades($data)
    {
        return $this->db->update('public.ciudades', $data, array('id' => $data['id']));
    }

    //_______ operadoras___________________________________________________
    public function get_operadora()
    {
        $this->db->order_by("id_operadora", "ASC");
        $query = $this->db->get('public.operadora');

        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_operadoras($data)
    {
        return $this->db->insert('public.operadora', $data);
    }

    public function single_operadora($id)
    {
        $this->db->select('*');
        $this->db->from('public.operadora');
        $this->db->where('id_operadora', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_operadora($data)
    {
        return $this->db->update('public.operadora', $data, array('id_operadora' => $data['id_operadora']));
    }

    //_______ proce___________________________________________________
    public function get_proce()
    {
        $this->db->order_by("id", "ASC");
        $query = $this->db->get('evaluacion_desempenio.modalidad');

        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_proce($data)
    {
        return $this->db->insert('evaluacion_desempenio.modalidad', $data);
    }

    public function single_proce($id)
    {
        $this->db->select('*');
        $this->db->from('evaluacion_desempenio.modalidad');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_proce($data)
    {
        return $this->db->update('evaluacion_desempenio.modalidad', $data, array('id' => $data['id']));
    }

    //_________________________________________supuestos modslidad_________________
    public function get_supuestos()
    {
        $this->db->order_by("id", "ASC");
        $query = $this->db->get('evaluacion_desempenio.sub_modalidad');

        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_supuestos($data)
    {

        return $this->db->insert('evaluacion_desempenio.sub_modalidad', $data);
    }

    public function single_supuestos($id)
    {
        $this->db->select('*');
        $this->db->from('evaluacion_desempenio.sub_modalidad');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_supuestos($data)
    {
        return $this->db->update('evaluacion_desempenio.sub_modalidad', $data, array('id' => $data['id']));
    }

    //_________________________________________edo civil_________________
    public function get_edocivil()
    {
        $this->db->order_by("id_edo_civil", "ASC");
        $query = $this->db->get('public.edo_civil');

        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    public function save_edocivil($data)
    {

        return $this->db->insert('public.edo_civil', $data);
    }

    public function single_edocivil($id)
    {
        $this->db->select('*');
        $this->db->from('public.edo_civil');
        $this->db->where('id_edo_civil', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_edocivil($data)
    {
        return $this->db->update('public.edo_civil', $data, array('id_edo_civil' => $data['id_edo_civil']));
    }


    ///clasificacion
    //guargar clasificacion
    function registrar_tc($data)
    {
        $this->db->insert('public.clasificacion', $data);
        return true;
    }
    //VER PARA EDITAR
    function consulta_tc($data)
    {
        $this->db->select('*');
        $this->db->from('public.clasificacion');
        $this->db->where('id_clasificacion', $data['id_clasificacion']);
        $this->db->order_by("id_clasificacion", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    function editar_tc($data)
    {
        $this->db->where('id_clasificacion', $data['id_clasificacion']);
        $update = $this->db->update('public.clasificacion', $data);
        return true;
    }
}
