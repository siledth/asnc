<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preguntas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function tiene_preguntas($id_usuario) {
        $this->db->where('id_usuario', $id_usuario);
        $query = $this->db->get('seguridad.respuestas_seguridad');
        return $query->num_rows() >= 3; // Verificar si tiene al menos 3 preguntas
    }

        public function preguntas_(){
            $this->db->select('*');
            $query = $this->db->get('seguridad.preguntas');
            return $result = $query->result_array();
        }

          public function guardar_respuesta($data) {
        // Insertar los datos en la tabla 'seguridad.respuestas_seguridad'
        $this->db->insert('seguridad.respuestas_seguridad', $data);
        return $this->db->insert_id(); // Devolver el ID del registro insertado
    }
}