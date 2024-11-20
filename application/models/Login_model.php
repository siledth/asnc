<?php

class Login_model extends CI_model
{
    public function iniciar($usuario, $contrasena)
    {
        $sql = "SELECT f.*,
            c.*
            FROM seguridad.usuarios f
            LEFT JOIN seguridad.perfil c ON c.id_perfil = f.perfil
            WHERE nombre = ?";
        $result = $this->db->query($sql, array($usuario));
        if ($result->num_rows() == 1) {
            $id_estatus = $result->row('id_estatus');
            if ($id_estatus == 1) {
                $db_clave = $result->row('password');
                $unidad = $result->row('unidad');
                if (password_verify(base64_encode(hash('sha256', $contrasena, true)), $db_clave)) {
                    $this->db->set('intentos', 0);
                    $this->db->where('nombre', $usuario);
                    $this->db->update('seguridad.usuarios');
                    return $result->row_array();
                } else {
                    $intento = $result->row('intentos');
                    if ($intento < 1) {
                        $intento = $intento + 3;
                        $this->db->set('intentos', $intento);
                        $this->db->where('nombre', $usuario);
                        $this->db->update('seguridad.usuarios');
                        return 'FALLIDO';
                    } else {
                        $this->db->set('id_estatus', 4);
                        $this->db->where('nombre', $usuario);
                        $this->db->update('seguridad.usuarios');
                        return 'FALLIDO';
                    }
                }
            } else {
                return 'BLOQUEADO';
            }
        } else {
            return 'FALSE';
        }
    }
    function existe($id_user) {  
        $this->db->select('user_id');
        $this->db->where('user_id', $id_user);
       // $this->db->where('login_time',date('Y-m-d'));
        $query = $this->db->get('seguridad.user_sessions');
        $response = $query->row_array();
        return $response ;


        // $query = $ci->db->get_where('user_sessions', array(
        //   'user_id' => $user_id,
        //   'login_time >' => date('Y-m-d H:i:s', strtotime('-10 minutes'))
        // ));
      
        // return $query->num_rows() > 0;
      }
      public function save_session($data_session)
{
    // Verificar si ya existe un registro con el 'user_id' proporcionado
    $this->db->where('user_id', $data_session['user_id']);
    $query = $this->db->get('seguridad.user_sessions');

    if ($query->num_rows() > 0) {
        // Si ya existe un registro con el 'user_id', actualizar el registro existente
        $this->session->set_flashdata('message', 'El usuario ya tiene una sesión activa.');
        $this->session->set_flashdata('message_type', 'danger');
        return 'OPEN';

    } else {
        // Si no existe un registro con el 'user_id', insertar un nuevo registro
        $this->db->select('max(e.id) as id1');
        $query1 = $this->db->get('seguridad.user_sessions e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id'		    => $id1,
            'user_id'		=> $data_session['user_id'],
            'session_id'		=> $data_session['session_id'],
            'login_time'		    => $data_session['login_time'],
        );    
        $this->db->insert("seguridad.user_sessions", $data1);
    }
}

      public function save_session1($data_session)
        {  
            $this->db->select('max(e.id) as id1');
            $query1 = $this->db->get('seguridad.user_sessions e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1 ;
           
            $data1 = array(
                'id'		    => $id1,
                'user_id'		=> $data_session['user_id'],
                'session_id'		=> $data_session['session_id'],
                'login_time'		    => $data_session['login_time'],
            );    
            $quers =$this->db->insert("seguridad.user_sessions", $data1);

        }



        public function delesesion1($data)
        { 
            $this->db->where('user_id', $data['user_id']);
            $query = $this->db->delete('seguridad.user_sessions');
            return true;
        }
        public function delesesion2($data)
        { 
            $this->db->where('user_id', $data['user_id']);
            $query = $this->db->delete('seguridad.user_sessions');
            return true;
        }
    public function consultar_organo($id_unidad)
    {
        $this->db->select('ea.id_organoente,
                                    ea.rif,id_organoenteads, ea.tipo_organoente, ea.descripcion as desc_organo, 
                                    ea.cod_onapre, ea.correo,  ea.codigo, ea.id_clasificacion');
                $this->db->where('ea.codigo', $id_unidad);
                $this->db->from('public.organoente ea');
        $result = $this->db->get();

        if ($result->num_rows() != 1) {
            $this->db->select('ea.id_organoente,
                                    ea.rif,id_organoenteads, ea.tipo_organoente, ea.descripcion as desc_organo, 
                                    ea.cod_onapre, ea.correo,  ea.codigo, ea.id_clasificacion');
                $this->db->where('ea.codigo', $id_unidad);
                $this->db->from('public.organoente ea');;
            $result = $this->db->get();

            if ($result->num_rows() != 1) {
                $this->db->select('ea.id_organoente,
                                    ea.rif,id_organoenteads, ea.tipo_organoente, ea.descripcion as desc_organo, 
                                    ea.cod_onapre, ea.correo,  ea.codigo, ea.id_clasificacion');
                $this->db->where('ea.codigo', $id_unidad);
                $this->db->from('public.organoente ea');
                $result = $this->db->get();
                return $result->row_array();
            } else {
                return $result->row_array();
            }
            
        } else {
            return $result->row_array();
        }
    }

    public function cambiar_clave($id_usuario, $data)
    {
        $this->db->where('id', $id_usuario);
        $update = $this->db->update('seguridad.usuarios', $data);
       // return $update;
        if ($update == true) {               
            return 1;        
        } else {
            return 0;
        }
    }

    // esto lo guarda para ussuarios de perfil 8 chacaito
    public function guardar_prp($inf_usu, $inf_prop, $if_emp)
    {
        $this->db->select('max(e.id_organoente) as id');
        $query = $this->db->get('public.organoente e');
        $response3 = $query->row_array();
        $id = $response3['id'] + 1 ;

        $this->db->select('max(e.id) as id1');
        $query1 = $this->db->get('seguridad.usuarios e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ;

        $data = array(
                'id'		    => $id1,
                'nombre'		=> $inf_usu['nombre'],
                'password'		=> $inf_usu['password'],
                'email'		=> $inf_usu['email'],
                'perfil'            => 8,
                'foto'            => 1,
                'estado'            => 1,

                'ultimo_login'            => $inf_usu['ultimo_login'],
                'fecha'		=> $inf_usu['fecha'],
                'intentos'	 	=> $inf_usu['intentos'],
                'unidad' 			=> $inf_usu['unidad'],
                'fecha_update' 			=> $inf_usu['fecha_update'],
                'id_estatus' 			=> $inf_usu['id_estatus'],
                'rif_organoente' 			=> $inf_usu['rif_organoente'],

            );
            $quers =$this->db->insert("seguridad.usuarios", $data); //colo nombre de la tabla
            if ($quers) { 
            $id = $id;
           
            $data2 = array(
                'id_usuario'		    => $id1,
                'id'		    => $id1,
                'nombrefun'		=> $inf_prop['nombrefun'],

                'apellido'		=> $inf_prop['nombrefun'],
                'cedula'	 	=> $inf_prop['cedula'],
                'email' 			=> $inf_prop['email'],
                'fecha'          => $inf_prop['fecha'],
            );
           
            $this->db->insert('seguridad.funcionarios', $data2);
            $id = $id;
            $data3 = array(
                'id_organoente'		    => $id,
                'id_organoenteads'		=> 0,
                'tipo_organoente'		=> 0,
                'rif'		=> $if_emp['rif'],
                'codigo'		=> $if_emp['codigo'],
                'descripcion'	 	=> $if_emp['desc_entes'],
                'correo' 			=> $if_emp['correo'],
                'usuario'          => $id,
                'cod_onapre'          => 0,
                'id_estado'          => 1,
                'id_municipio'          => 1,
                'id_parroquia'          => 1,
                'direccion'          => 1,
                'gaceta'          => 1,
                'fecha_gaceta'          => $if_emp['fecha'],
                'siglas'          => 1,
                'pagina_web'          => 1,
                'tel1'          => 1,
                'tel2'          => 1,
                'movil1'          => 1,
                'movil2'          => 1,
                'fecha'          => $if_emp['fecha'],
                
            );

            $this->db->insert('public.organoente', $data3);   
            return true;      
        }
       
    }
    public function valida_correo($email){
        $this->db->select('nombre');
        $this->db->where('nombre ', $email);
        //$this->db->order_by('id desc');
        $query = $this->db->get('seguridad.usuarios');
        $response = $query->row_array();
        return $response;
    }
    public function valida_ced($cedula_prop){
        $this->db->select('codigo');
        $this->db->where('codigo ', $cedula_prop);
        //$this->db->order_by('id desc');
        $query = $this->db->get('public.organoente');
        $response = $query->row_array();
        return $response;
    }


}

?>