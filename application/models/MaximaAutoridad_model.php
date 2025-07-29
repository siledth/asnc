<?php
class MaximaAutoridad_model extends CI_model
{
    public function save_maxima_autoridad($data)
    {
        $id_organoente = $data['id_organoente'];
        unset($data['id_organoente']); // Eliminar de $data para usar en la condición WHERE

        // Verificar si ya existe un registro para este id_organoente
        $this->db->where('id_organoente', $id_organoente);
        $query = $this->db->get('public.maxima_autoridad');

        if ($query->num_rows() > 0) {
            // Actualizar registro existente
            $this->db->where('id_organoente', $id_organoente);
            $data['fecha_actualizacion'] = date('Y-m-d H:i:s'); // Actualizar timestamp
            return $this->db->update('public.maxima_autoridad', $data);
        } else {
            // Insertar nuevo registro
            $data['id_organoente'] = $id_organoente; // Añadir de nuevo para la inserción
            $data['fecha_creacion'] = date('Y-m-d H:i:s');
            $data['fecha_actualizacion'] = date('Y-m-d H:i:s');
            return $this->db->insert('public.maxima_autoridad', $data);
        }
    }

    /**
     * Obtiene la información de la Máxima Autoridad para un órgano/ente por su ID.
     * @param int $id_organoente El ID del órgano/ente.
     * @return array|null Los datos de la Máxima Autoridad o null si no se encuentra.
     */
    public function get_maxima_autoridad_by_organoente_id($id_organoente)
    {
        $this->db->select('*');
        $this->db->from('public.maxima_autoridad');
        $this->db->where('id_organoente', $id_organoente);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Si tu tabla 'acto_admin' no está cargada en otro lado, la necesitarás para el select en el modal
    public function get_actos_admin()
    {
        $this->db->select('id_acto_admin, desc_acto_admin');
        $this->db->from('comisiones.acto_admin');
        $query = $this->db->get();
        return $query->result_array();
    }
}
