<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Obtener usuario por nombre de usuario
    public function obtener_usuario($username) {
        $this->db->where('nombre', $username);
        return $this->db->get('seguridad.usuarios')->row();
    }

//     // Obtener preguntas de seguridad del usuario
//     public function obtener_preguntas_usuario($id_usuario) {
//     $this->db->select('p.id AS id_despregunta, p.despregunta, r.respuesta');
//     $this->db->from('seguridad.respuestas_seguridad r');
//     $this->db->join('seguridad.preguntas p', 'r.id_despregunta = p.id');
//     $this->db->where('r.id_usuario', $id_usuario);
//     return $this->db->get()->result();
// }
public function obtener_preguntas_aleatorias($id_usuario) {
    // Obtener todas las preguntas del usuario
     $this->db->select('p.id AS id_despregunta, p.despregunta, r.respuesta');
     $this->db->join('seguridad.preguntas p', 'r.id_despregunta = p.id');
    $this->db->where('r.id_usuario', $id_usuario);
    $this->db->order_by('r.id_rps', 'RANDOM'); // Ordenar aleatoriamente
    $this->db->limit(2); // Limitar a 2 preguntas
    return $this->db->get('seguridad.respuestas_seguridad r')->result();
}
   public function validar_respuestas($id_usuario, $respuestas) {
    // Obtener las respuestas almacenadas para el usuario
    $this->db->where('id_usuario', $id_usuario);
    // Filtrar por los IDs de las preguntas mostradas
    $ids_preguntas_mostradas = array_keys($respuestas);
    $this->db->where_in('id_despregunta', $ids_preguntas_mostradas);
    $respuestas_db = $this->db->get('seguridad.respuestas_seguridad')->result();
    // Verificar cada respuesta
    foreach ($respuestas_db as $respuesta_db) {
        // Obtener la respuesta proporcionada por el usuario para esta pregunta
        if (!isset($respuestas[$respuesta_db->id_despregunta])) {
            return false; // Si no se proporcionó una respuesta para esta pregunta, devolver false
        }
        $respuesta_usuario = trim($respuestas[$respuesta_db->id_despregunta]);
        // Comparar la respuesta del usuario con el hash almacenado
        if (!password_verify(base64_encode(hash('sha256', $respuesta_usuario, true)), $respuesta_db->respuesta)) {
        //    echo "La respuesta no coincide.<br>";
            return false; // Si alguna respuesta no coincide, devolver false
        }  
    }

    return true; // Si todas las respuestas coinciden, devolver true
}
 // Función para guardar un token temporal
    public function guardar_token($id_usuario, $token) {
        // Definir la fecha de expiración (por ejemplo, 1 hora después de la creación)
        $fecha_expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Preparar los datos para insertar
        $data = array(
            'id_usuario' => $id_usuario,
            'token' => $token,
            'fecha_expiracion' => $fecha_expiracion
        );

        // Insertar el token en la base de datos
        $this->db->insert('seguridad.tokens', $data);
    }

    // Función para validar un token y obtener el ID del usuario
    public function validar_token($token) {
        // Obtener el token de la base de datos
        $this->db->where('token', $token);
        $this->db->where('fecha_expiracion >', date('Y-m-d H:i:s')); // Verificar que no haya expirado
        $query = $this->db->get('seguridad.tokens');

        if ($query->num_rows() > 0) {
            // Devolver el ID del usuario asociado al token
            return $query->row()->id_usuario;
        } else {
            // Token inválido o expirado
            return false;
        }
    }

    // Función para actualizar la clave del usuario
    public function actualizar_clave($id_usuario, $clave_encriptada) {
        // Preparar los datos para actualizar
        $data = array(
            'password' => $clave_encriptada,
            'fecha_update' => date('Y-m-d'),
             'intentos' => 0,
             'id_estatus' => 1,


        );

        // Actualizar la clave en la base de datos
        $this->db->where('id', $id_usuario);
        $this->db->update('seguridad.usuarios', $data);
    }

    // Función para eliminar un token después de usarlo
    public function eliminar_token($token) {
        $this->db->where('token', $token);
        $this->db->delete('seguridad.tokens');
    }
    // Obtener usuario cedula
    public function obtener_cd($username) {
        $this->db->where('cedula', $username);
        return $this->db->get('seguridad.funcionarios')->row();
    }
      public function obtener_user($id_usuario) {
     $this->db->select(' id, nombre');
        $this->db->where('id', $id_usuario);
        return $this->db->get('seguridad.usuarios')->row();
    }
}