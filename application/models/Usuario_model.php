<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function verificar_usuario($username, $password) {
        
       
        $this->db->where('nombre', $username);
        $query = $this->db->get('seguridad.usuarios');
    
        if ($query->num_rows() == 1) {
            $usuario = $query->row();
            $db_clave = $usuario->password; // Obtenemos la contraseña almacenada
            $id_perfil = $usuario->perfil;
           // var_dump($usuario);
              
            // Verificamos si el hash de la contraseña ingresada coincide con el hash almacenado
            if (password_verify(base64_encode(hash('sha256', $password, true)), $db_clave)) {
            
                return $id_perfil; // La contraseña es correcta
            } else {
                echo ""; // Para depuración Contraseña incorrecta
            }
        } else {
            echo ""; // Para depuración Usuario no encontrado
        }
        return false; // Contraseña incorrecta o usuario no encontrado
    }
     public function obtener_permisos($id_perfil) {
        $this->db->select('menu_rnce, menu_progr, menu_eval_desem, menu_reg_eval_desem, menu_soli_anular_eval_desem, menu_proc_anular_eval_desem');
        $this->db->from('seguridad.perfil');
        $this->db->where('id_perfil', $id_perfil);
        return $this->db->get()->row();
    }
}