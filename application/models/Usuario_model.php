<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //  public function iniciar($usuario, $contrasena) {
    //     $sql = "SELECT u.*,  p.*, o.descripcion, o.cod_onapre,o.rif
    //             FROM seguridad.usuarios u
    //             LEFT JOIN seguridad.perfil p ON p.id_perfil = u.perfil
    //             LEFT JOIN public.organoente o ON o.codigo = u.unidad
    //             WHERE u.nombre = ?";
    //     $query = $this->db->query($sql, array($usuario));

    //     if ($query->num_rows() == 1) {
    //         $row = $query->row_array();
    //         $id_estatus = $row['id_estatus'];

    //         if ($id_estatus == 1) {
    //             $db_clave = $row['password'];

    //             // Verify password using the same method as in your code
    //             if (password_verify(base64_encode(hash('sha256', $contrasena, true)), $db_clave)) {
    //                 // Reset login attempts on successful login
    //                 $this->db->set('intentos', 0);
    //                 $this->db->where('nombre', $usuario);
    //                 $this->db->update('seguridad.usuarios');

    //                 return $row;
    //             } else {
    //                 // Increment login attempts
    //                 $intento = $row['intentos'];
    //                 if ($intento < 3) {
    //                     $intento = $intento + 1;
    //                     $this->db->set('intentos', $intento);
    //                     $this->db->where('nombre', $usuario);
    //                     $this->db->update('seguridad.usuarios');
    //                     return 'FALLIDO';
    //                 } else {
    //                     // Block user after 3 failed attempts
    //                     $this->db->set('id_estatus', 4);
    //                     $this->db->where('nombre', $usuario);
    //                     $this->db->update('seguridad.usuarios');
    //                     return 'BLOQUEADO';
    //                 }
    //             }
    //         } else {
    //             return 'BLOQUEADO';
    //         }
    //     } else {
    //         return 'FALSE';
    //     }
    // }
    /**
     * @param string $usuario_nombre El nombre de usuario.
     * @param string $contrasena La contraseña ingresada.
     * @return array|string Retorna un array con los datos del usuario si el login es exitoso,
     * o un string con el estado ('FALLIDO', 'BLOQUEADO', 'FALSE').
     */
    public function iniciar($usuario_nombre, $contrasena)
    {
        $sql = "SELECT u.*,  p.*, o.descripcion, o.cod_onapre,o.rif as rif_organoente
                FROM seguridad.usuarios u
                LEFT JOIN seguridad.perfil p ON p.id_perfil = u.perfil
                LEFT JOIN public.organoente o ON o.codigo = u.unidad
                WHERE u.nombre = ?";
        $query = $this->db->query($sql, array($usuario_nombre));

        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            $id_estatus = $row['id_estatus'];

            if ($id_estatus == 1) {
                $db_clave = $row['password'];

                if (password_verify(base64_encode(hash('sha256', $contrasena, true)), $db_clave)) {
                    $this->db->set('intentos', 0);
                    $this->db->where('nombre', $usuario_nombre);
                    $this->db->update('seguridad.usuarios');

                    return $row;
                } else {
                    $intento = $row['intentos'];
                    if ($intento < 3) {
                        $intento = $intento + 1;
                        $this->db->set('intentos', $intento);
                        $this->db->where('nombre', $usuario_nombre);
                        $this->db->update('seguridad.usuarios');
                        return 'FALLIDO';
                    } else {
                        $this->db->set('id_estatus', 4);
                        $this->db->where('nombre', $usuario_nombre);
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
    public function get_additional_organoentes($user_id)
    {
        $this->db->select('rif_organoente, unidad');
        $this->db->from('seguridad.usuario_organoente');
        $this->db->where('id_usuario', $user_id);
        $this->db->where('status', 1); // Solo accesos activos
        $query = $this->db->get();
        return $query->result_array();
    }
    /**
     * Obtiene todos los datos y permisos de un usuario para un RIF y unidad específicos.
     * @param int $user_id El ID del usuario.
     * @param string $rif_organoente El RIF del órgano/ente seleccionado.
     * @param string $unidad_codigo El código de la unidad del órgano/ente.
     * @return array|null Retorna un array con todos los datos si se encuentra, o null.
     */
    public function get_user_data_by_organoente($user_id, $rif_organoente, $unidad_codigo)
    {
        // Obtenemos los datos del usuario y perfil
        $sql = "SELECT u.*, p.*, o.descripcion, o.cod_onapre
                FROM seguridad.usuarios u
                LEFT JOIN seguridad.perfil p ON p.id_perfil = u.perfil
                LEFT JOIN public.organoente o ON o.codigo = ? AND o.rif = ?
                WHERE u.id = ?";

        $query = $this->db->query($sql, array($unidad_codigo, $rif_organoente, $user_id));

        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            // Sobreescribimos los valores de RIF y unidad con los nuevos
            $row['rif_organoente'] = $rif_organoente;
            $row['unidad'] = $unidad_codigo;
            return $row;
        }
        return null;
    }
    public function get_organoente_by_rif($rif)
    {
        $this->db->select('codigo, descripcion');
        $this->db->from('public.organoente');
        $this->db->where('rif', $rif);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        return null;
    }
    ////////////////////////////////////////////////////////
    public function verificar_unidad_en_organoente($id_unidad)
    {
        // Verificar si el id_unidad existe en la tabla organoente
        $this->db->where('codigo', $id_unidad);
        $query = $this->db->get('public.organoente');
        return $query->num_rows() > 0;
    }

    public function insertar_login($login_data)
    {

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
                'id'            => $id1,
                'user_id'        => $login_data['user_id'],
                'session_id'        => $login_data['session_id'],
                'login_time'            => $login_data['login_time'],
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
