<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_management_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Obtiene todos los usuarios para el selector del formulario.
     */
    public function get_all_users()
    {
        $this->db->select('id, nombre, email');
        $query = $this->db->get('seguridad.usuarios');
        return $query->result_array();
    }

    /**
     * Asigna unidades adicionales a un usuario.
     * @param int $id_usuario El ID del usuario.
     * @param array $unidades Array de strings con 'rif/codigo'.
     * @return bool Retorna true si la inserción es exitosa, false en caso de error.
     */
    public function assign_additional_units($id_usuario, $unidades)
    {
        $this->db->trans_start();

        foreach ($unidades as $unidad_str) {
            list($rif, $codigo) = explode('/', $unidad_str);

            // Verificar si el registro ya existe para evitar duplicados
            $this->db->where('id_usuario', $id_usuario);
            $this->db->where('rif_organoente', $rif);
            $existing_row = $this->db->get('seguridad.usuario_organoente');

            if ($existing_row->num_rows() == 0) {
                $data = [
                    'id_usuario' => $id_usuario,
                    'rif_organoente' => $rif,
                    'unidad' => $codigo,
                    'status' => 1
                ];
                $this->db->insert('seguridad.usuario_organoente', $data);
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * Obtiene todos los RIFs adicionales de un usuario.
     * @param int $user_id El ID del usuario.
     * @return array Array de objetos con 'id_usuario', 'rif_organoente', 'unidad' y 'status'.
     */
    public function get_user_additional_rifs($user_id)
    {
        $this->db->select('id_usuario, rif_organoente, unidad, status');
        $this->db->from('seguridad.usuario_organoente');
        $this->db->where('id_usuario', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Actualiza el estatus de un RIF_Organoente para un usuario específico.
     * @param int $user_id El ID del usuario.
     * @param string $rif_organoente El RIF a actualizar.
     * @param int $status El nuevo estatus (1 o 0).
     * @return bool True si se actualizó correctamente, false en caso contrario.
     */
    public function update_rif_status($user_id, $rif_organoente, $status)
    {
        $this->db->where('id_usuario', $user_id);
        $this->db->where('rif_organoente', $rif_organoente);
        $this->db->set('status', $status);
        $this->db->update('seguridad.usuario_organoente');

        return $this->db->affected_rows() > 0;
    }
}
