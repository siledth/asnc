<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

     public function iniciar($usuario, $contrasena) {
        $sql = "SELECT u.*,  p.*, o.descripcion, o.cod_onapre,o.rif
                FROM seguridad.usuarios u
                LEFT JOIN seguridad.perfil p ON p.id_perfil = u.perfil
                LEFT JOIN public.organoente o ON o.codigo = u.unidad
                WHERE u.nombre = ?";
        $query = $this->db->query($sql, array($usuario));
        
        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            $id_estatus = $row['id_estatus'];
            
            if ($id_estatus == 1) {
                $db_clave = $row['password'];
                
                // Verify password using the same method as in your code
                if (password_verify(base64_encode(hash('sha256', $contrasena, true)), $db_clave)) {
                    // Reset login attempts on successful login
                    $this->db->set('intentos', 0);
                    $this->db->where('nombre', $usuario);
                    $this->db->update('seguridad.usuarios');
                    
                    return $row;
                } else {
                    // Increment login attempts
                    $intento = $row['intentos'];
                    if ($intento < 3) {
                        $intento = $intento + 1;
                        $this->db->set('intentos', $intento);
                        $this->db->where('nombre', $usuario);
                        $this->db->update('seguridad.usuarios');
                        return 'FALLIDO';
                    } else {
                        // Block user after 3 failed attempts
                        $this->db->set('id_estatus', 4);
                        $this->db->where('nombre', $usuario);
                        $this->db->update('seguridad.usuarios');
                        return 'BLOQUEADO';
                    }
                }
            } else {
                return 'BLOQUEADO';
            }
        } else {
            return 'FALSE';
        }
    }

    public function verificar_unidad_en_organoente($id_unidad) {
    // Verificar si el id_unidad existe en la tabla organoente
    $this->db->where('codigo', $id_unidad);
    $query = $this->db->get('public.organoente');
    return $query->num_rows() > 0;
}

public function insertar_login($login_data) {

    $this->db->where('user_id', $login_data['user_id']);
    $query = $this->db->get('seguridad.user_sessions');

    if ($query->num_rows() > 0) {
       return FALSE; 

    } else {
     $this->db->select('max(e.id) as id1');
        $query1 = $this->db->get('seguridad.user_sessions e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;
          $data1 = array(
            'id'		    => $id1,
            'user_id'		=> $login_data['user_id'],
            'session_id'		=> $login_data['session_id'],
            'login_time'		    => $login_data['login_time'],
        );    
        $this->db->insert("seguridad.user_sessions", $data1);
        return TRUE;

  }
     
}


    // public function verificar_usuario($username, $password) {
        
       
    //     $this->db->where('nombre', $username);
    //     $query = $this->db->get('seguridad.usuarios');
    
    //     if ($query->num_rows() == 1) {
    //         $usuario = $query->row();
    //         $db_clave = $usuario->password; // Obtenemos la contraseña almacenada
    //         $id_perfil = $usuario->perfil;
    //        // var_dump($usuario);
              
    //         // Verificamos si el hash de la contraseña ingresada coincide con el hash almacenado
    //         if (password_verify(base64_encode(hash('sha256', $password, true)), $db_clave)) {
            
    //             return $id_perfil; // La contraseña es correcta
    //         } else {
    //             echo ""; // Para depuración Contraseña incorrecta
    //         }
    //     } else {
    //         echo ""; // Para depuración Usuario no encontrado
    //     }
    //     return false; // Contraseña incorrecta o usuario no encontrado
    // }
    //  public function obtener_permisos($id_perfil) {
    //     $this->db->select('menu_rnce, menu_progr, menu_eval_desem, menu_reg_eval_desem, menu_soli_anular_eval_desem, menu_proc_anular_eval_desem');
    //     $this->db->from('seguridad.perfil');
    //     $this->db->where('id_perfil', $id_perfil);
    //     return $this->db->get()->row();
    // }
}