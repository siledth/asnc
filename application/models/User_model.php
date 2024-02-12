<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    //desbloquear un usuario

    public function consulta_usuarios()
    {
        $this->db->select("f.id,
                        f.nombre,
                        f.id_estatus,
                        f.intentos,
                        c.nombrefun,
                        c.apellido
                       ");
        $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
        $this->db->where('f.id_estatus >', '3');
        $query = $this->db->get('seguridad.usuarios f');
        return $result = $query->result_array();

    }
   
    public function consulta_usuariost()
    {
        $this->db->select("f.id,
                        f.nombre,
                        f.id_estatus,
                        f.intentos,
                        c.nombrefun,
                        c.apellido
                       ");
        $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
       // $this->db->where('f.id_estatus >', '3');
        $query = $this->db->get('seguridad.usuarios f');
        return $result = $query->result_array();

    }
    public function desblo_usuario($data)
    {
        $data1 = array('id_estatus' => '1',
                        'intentos' => '0',
                        'password'=> '$2y$10$T3rwxYhqdCJxft4p32W4J.KLZpOZViLs38JH2NuHGH9zBvuPExiPC',
                        'fecha_update' => date('Y-m-d h:i:s'));
        $this->db->where('id', $data['id']);
        $update = $this->db->update('seguridad.usuarios', $data1);
        return true;
    }
    /////////////bloque o inhabilitacion usuario
    public function blo_usuario($data)
    {
        $data1 = array('id_estatus' => '4',
                        'intentos' => '3',
                        //'password'=> '$2y$10$T3rwxYhqdCJxft4p32W4J.KLZpOZViLs38JH2NuHGH9zBvuPExiPC',
                        'fecha_update' => date('Y-m-d h:i:s'));
        $this->db->where('id', $data['id']);
        $update = $this->db->update('seguridad.usuarios', $data1);
        return true;
    }

        public function save($data)
        {
            //$this->db->query("ALTER TABLE user AUTO_INCREMENT 1");
            $this->db->insert("seguridad.usuarios", $data);
        }

        public function getUsers()
        {
            $this->db->select("*");
            $this->db->from("seguridad.usuarios");
            $results = $this->db->get();
            return $results->result();
        }

        public function getUser($id)
        {
            $this->db->select("u.id, u.nombre, u.email");
            $this->db->from("seguridad.usuarios u");
            $this->db->where("u.id", $id);
            $result = $this->db->get();
            return $result->row();
        }

        public function update($data, $id)
        {
            $this->db->where("id", $id);
            $this->db->update("seguridad.usuarios", $data);
        }

        public function delete($id)
        {
            $this->db->where("id", $id);
            $this->db->delete("seguridad.user");
        }


        // CUENTA DANTE
        public function consultar_organos()
        {
            $this->db->select('o.id_organo,
                           o.codigo,
                          o.cod_onapre,
                          concat(tr.desc_rif, \' - \' ,o.rif) as rif,
                          o.siglas,
                           o.desc_organo');
            $this->db->join('tipo_rif tr', 'tr.id_rif = o.tipo_rif');
            $this->db->order_by('o.id_organo');
            $query = $this->db->get('organos o');
            return $query->result_array();
        }

        public function consultar_entes()
        {
            $this->db->select('e.id_entes,
                           e.codigo,
                          concat(tr.desc_rif, \' - \' ,e.rif) as rif,
                          e.desc_entes');
            $this->db->order_by('e.id_entes');
            $this->db->join('tipo_rif tr', 'tr.id_rif = e.tipo_rif');
            $query = $this->db->get('entes e');
            $response = $query->result_array();
            return $response;
        }

        public function consultar_enteads()
        {
            $this->db->select('ea.id_entes_ads,
                           ea.codigo,
                          concat(tr.desc_rif, \' - \' ,ea.rif) as rif,
                          ea.desc_entes_ads ');
            $this->db->order_by('ea.id_entes_ads');
            $this->db->join('tipo_rif tr', 'tr.id_rif = ea.tipo_rif');
            $query = $this->db->get('entes_ads ea ');
            $response = $query->result_array();
            return $response;
        }

        public function llenarm($data)
        {
            //print_r($data['rif_b']);die;
            $this->db->select('o.id_organo,
                           o.codigo,
                           o.rif,
                           o.desc_organo,
                           o.cod_onapre,
                           o.siglas,
                           o.direccion_fiscal');
            $this->db->where('o.rif', $data['rif_b']);
            $this->db->from('organos o');
            $result = $this->db->get();

            if($result->num_rows() != 1) {
                $this->db->select('e.id_organo,
                               e.id_entes,
                               e.codigo,
                        	   e.rif,
                        	   e.desc_entes as desc_organo,
                        	   e.cod_onapre,
                        	   e.siglas,
                        	   e.direccion_fiscal');
                $this->db->where('e.rif', $data['rif_b']);
                $this->db->from('entes e');
                $result = $this->db->get();

                if ($result->num_rows() != 1) {
                    $this->db->select('ea.id_entes,
                                   ea.id_entes_ads,
                                   ea.codigo,
                                   ea.rif,
                                   ea.desc_entes_ads as desc_organo,
                                   ea.cod_onapre,
                                   ea.siglas,
                                   ea.direccion_fiscal');
                    $this->db->where('ea.rif', $data['rif_b']);
                    $this->db->from('entes_ads ea');
                    $result = $this->db->get();
                    return $result->row_array();
                } else {
                    return $result->row_array();
                }
            } else {
                return $result->row_array();
            }
            //return $result = $query->row_array();
        }


        // aca debe guardar cuenta dante en usuario y guardar los otros datos en funcionarios
        public function savedante($data, $data2)
        {  
            $this->db->select('max(e.id) as id1');
            $query1 = $this->db->get('seguridad.usuarios e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1 ;
           
            $data1 = array(
                'id'		    => $id1,
                'nombre'		=> $data['nombre'],
                'password'		=> $data['password'],
                'email'		    => $data['email'],
                'perfil'        => $data['perfil'],
                'foto'          => 1,
                'estado'        => 1,
                'ultimo_login'  => $data['ultimo_login'],
                'fecha'		    => $data['fecha'],
                'intentos'	 	=> $data['intentos'],
                'unidad' 		=> $data['unidad'],
                'id_estatus' 	=> $data['id_estatus'],
                'fecha_update' 	=> $data['fecha_update'],               
                'rif_organoente' => $data['rif_organoente'],

            );
            $quers =$this->db->insert("seguridad.usuarios", $data1);
            if ($quers) {
                $id = $id;

                $data3 = array(
                    'id_usuario'    => $id1,
                    'id'		    => $id1,
                    'nombrefun'		=> $data2['nombrefun'],
                    'apellido'		=> $data2['apellido'],
                    'tipo_cedula'	=> $data2['tipo_cedula'],
                    'cedula'	 	=> $data2['cedula'],
                    'tele_1'	 	=> $data2['tele_1'],
                    'tele_2'	 	=> $data2['tele_2'],
                    'cargo'	 	    => $data2['cargo'],
                    'oficina'	 	=> $data2['oficina'],
                    'obser'	 	=> $data2['obser'],
                    'fecha_designacion'	 	=> $data2['fecha_designacion'],
                    'numero_gaceta'	 	=> $data2['numero_gaceta'],
                    'email'	 	=> $data2['email'],
                    'tipo_funcionario'	 	=> $data2['tipo_funcionario'],
                    'unidad'	 	=> $data2['unidad']
                        );
                        $this->db->insert('seguridad.funcionarios', $data3);
                        return true;    
                 }
        }
        public function get_usuario()
        {
            $this->db->select("f.id,
                    f.nombre,
                    f.id_estatus,
                    f.intentos,
                    c.nombrefun,
                    c.apellido,
                    r.descripcion,
                    r.rif,
                    c.id as id1,
                    t.nombrep
                ");
            $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
            $this->db->join('public.organoente r', 'r.rif = f.rif_organoente', 'left');
            $this->db->join('seguridad.perfil t', 't.id_perfil = f.perfil', 'left');
            $this->db->where('f.rif_organoente ', 'G200024518');
            $query = $this->db->get('seguridad.usuarios f');
            return $result = $query->result_array();


            //$query = $this->db->get('programacion.alicuota_iva');
            // if (count($query->result()) > 0) {
            //return $query->result();
            // }
        }
        public function get_usuario_externos()
        {
            $this->db->select("f.id,
                    f.nombre,
                    f.id_estatus,
                    f.intentos,
                    c.nombrefun,
                    c.apellido,
                    r.descripcion,
                    r.rif,
                    c.id as id1,
                    t.nombrep
                ");
            $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
            $this->db->join('public.organoente r', 'r.rif = f.rif_organoente', 'left');
            $this->db->join('seguridad.perfil t', 't.id_perfil = f.perfil', 'left');
            $this->db->where('f.rif_organoente !=', 'G200024518');
            $query = $this->db->get('seguridad.usuarios f');
            return $result = $query->result_array();



        }
        public function read_list($data){
            $this->db->select('e.id as id1, 
            e.perfil, 
            e.rif_organoente,
            e.unidad as und,
              f.*, 
              t.nombrep,
              t.id_perfil,
              r.descripcion,
              r.rif,');
            $this->db->from('seguridad.usuarios e');
            $this->db->join('seguridad.funcionarios f', 'f.id_usuario = e.id', 'left');
            $this->db->join('seguridad.perfil t', 't.id_perfil = e.perfil', 'left');
            $this->db->join('public.organoente r', 'r.rif = e.rif_organoente', 'left');
            $this->db->where('e.id',$data['id']);
            $query = $this->db->get();
            $resultado = $query->row_array();
            return $resultado;
        }
    
        public function single_user($id)
        {
            $this->db->select('e.id as id1, 
                           e.perfil, 
                           e.rif_organoente,
                           e.unidad,
                             f.*, 
                             t.nombrep,
                             t.id_perfil,
                             r.descripcion,
                             r.rif,');
            $this->db->join('seguridad.funcionarios f', 'f.id_usuario = e.id', 'left');
            $this->db->join('seguridad.perfil t', 't.id_perfil = e.perfil', 'left');
            $this->db->join('public.organoente r', 'r.rif = e.rif_organoente', 'left');
            $this->db->where('e.id', $id);
            $query = $this->db->get('seguridad.usuarios e ');
            return $query->result_array();
        }

         // public function single_user1($data) {
        //     $this->db->select('e.*
        //                          f.*');
        //     $this->db->join('seguridad.funcionarios f', 'f.id = e.id_usuario', 'left');
        //     $this->db->join('seguridad.perfil t', 't.id_perfil = e.perfil', 'left');
        //     $this->db->from('seguridad.usuarios e');
        //     $this->db->where('id_usuario', $data['id']);
        //     $query = $this->db->get();
        //         $resultado = $query->row_array();
        //         return $resultado;
        // }
        // public function guardar_mod_user($data) {
        //     return $this->db->update('seguridad.funcionarios', $data, array('id_usuario' => $data['id_ver']));
        // }

    /// GUARDAR UN USUARIO MODIFICADO Y EL PERFIL DE ESE USUARIO
            public function editar_modi_usua($usua, $funci, $id)
            {
                $dataus = array(
                       
                      'perfil' 	            => $usua['perfil'],
                       'unidad' 	            => $usua['unidad1'],
                       'rif_organoente' 	            => $usua['rif_organoente1'],
                       'fecha_update'             => $usua['fecha_update'],
                       

                   );
                $this->db->where('id', $id);
                $update = $this->db->update('seguridad.usuarios', $dataus);

                if ($update) {
                    $this->db->where('id_usuario', $id);
                    // $this->db->where('id_p_acc', 0);

                    $data_inf = array(
                     // 'id_usuario'              => $id,
                        'nombrefun'   		    => $funci['nombrefun'],
                        'apellido'          	=> $funci['apellido'],
                        'cedula'            	=> $funci['cedula'],
                        'cargo' 	            => $funci['cargo'],
                        'oficina' 	            => $funci['oficina'],
                       'tele_1' 	            => $funci['tele_1'],
                        'tele_2' 	            => $funci['tele_2'],
                        'fecha_designacion' 	            => $funci['fecha_designacion'],
                        'numero_gaceta'             => $funci['numero_gaceta'],
                        'email'             =>$funci['email'],

                    );
                    $update = $this->db->update('seguridad.funcionarios', $data_inf);



                }
                return true;
            }

    ///////////////////////////////////////////////////////////////////////////////////



         public function guardar_mod_user($data)
         {


             //aca modifique
             $data1 = array('nombrefun' => $data['nombrefun'],
                             'apellido' => $data['apellido'],
                             'cedula' => $data['cedula'],
                             'email' => $data['email'],
                             'cargo' => $data['cargo'],
                             'oficina' => $data['oficina'],
                             'tele_1' => $data['tele_1'],
                             'tele_2' => $data['tele_2'],
                         //    'fecha_update' => date('Y-m-d h:i:s'),
                         //      'nro_factura' => $data['numfact'],
                         //     'nota' => $data['nota'],
                         //     'fechapago' => $data['fechapago'],
                         );

             $this->db->where('id_usuario', $data['id_ver']);
             $update = $this->db->update('seguridad.funcionarios', $data1);

             return true;

         }


         // ver usuarios
         public function ver_users($data)
         {
             $this->db->select("f.id,
        f.nombre,
        f.id_estatus,
        f.intentos,
        c.*,
        r.descripcion,
        r.rif,
        c.id as id1");
             $this->db->from('seguridad.usuarios f');
             $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
             $this->db->join('public.organoente r', 'r.rif = f.rif_organoente', 'left');
             $this->db->where('c.id_usuario', $data);
             $query = $this->db->get();
             $resultado = $query->row_array();
             return $resultado;
         }

        public function consulta_organoente()
        {
            $this->db->select("id_organoente, rif, id_organoenteads, tipo_organoente, descripcion, cod_onapre, id_estado, id_municipio, id_parroquia, siglas, direccion, 
                            gaceta, fecha_gaceta, pagina_web, correo, tel1, tel2, movil1, movil2, usuario, fecha, codigo,certificaciones
                                ");
            // $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
            $this->db->where('certificaciones', '0');
            $query = $this->db->get('public.organoente');
            return $result = $query->result_array();

        }


        //perfiles
        public function consultar_perfiles()
        {
            $this->db->select("f.id_perfil, 
                          f.nombrep,
                           f.fecha_creacion                   
                ");
            $query = $this->db->get('seguridad.perfil f');
            return $result = $query->result_array();


        }
        public function consultar_perfiles1($data){
            $this->db->select('f.id_perfil, 
            f.nombrep,
             f.fecha_creacion');
            $this->db->where('f.id_perfil !=', $data['id_perfil']);
            $query = $this->db->get('seguridad.perfil f');
            return $query->result_array();
        }
        public function organo_ent($data){
            $this->db->select('rif,codigo ,descripcion,certificaciones');
            $this->db->where('certificaciones', '0');  
            $query = $this->db->get('public.organoente');
            return $query->result_array();
        }
        public function organo_ent1($data){
            $this->db->select('rif,codigo ,descripcion,certificaciones');
            $this->db->where('rif', $data['camb_org']); 
            $this->db->where('certificaciones', '0');  
            $query = $this->db->get('public.organoente');
            return $query->result_array();
        }
        public function save_modif_user1($data){ //externo

            $this->db->where('id', $data['id']);
        
            $pp_s = $data['cambio_perf'];
            if ($pp_s == 0) {
                $perfil = $data['id_perfil'];
            }else {
                $perfil = $data['cambio_perf'];
            }
        
            $org_en = $data['camb_org'];
            if ($org_en == 1) {
                $rif_organoente1 = $data['rif_organoente1'];
                $unidad1 = $data['unidad1'];

            }else {
                $rif_organoente1 = $data['rif1'];
                $unidad1 = $data['code1'];

            }         
        
            $data1 = array(
                'perfil'        => $perfil,
                'rif_organoente'         => $rif_organoente1,
                'unidad'         => $unidad1              
            );
            // print_r($data1);die;
            $update = $this->db->update('seguridad.usuarios', $data1);
            if ($update) {
                $this->db->where('id_usuario', $data['id']);
                // $this->db->where('id_p_acc', 0);

                $data_inf = array(
                    'nombrefun'   		    => $data['nombrefun'],
                    'apellido'          	=> $data['apellido'],
                    'cedula'            	=> $data['cedula'],
                    'cargo' 	            => $data['cargo'],
                //     'oficina' 	            => $data['oficina'],
                //    'tele_1' 	            => $data['tele_1'],
                //     'tele_2' 	            => $data['tele_2'],
                //     'fecha_designacion' 	            => $funci['fecha_designacion'],
                //     'numero_gaceta'             => $funci['numero_gaceta'],
                    'email'             =>$data['email'],

                );
                $update1 = $this->db->update('seguridad.funcionarios', $data_inf);



            }
            if ($update= true) {               
                return 1;        
            } else {
                return 0;
            }
           // return true;
        }
        public function guardar_perfil($data)
        {

            $data1 = array(
                        'nombrep' => $data['nombrep'],
                        'menu_rnce' => $data['menu_rnce'],
                        'menu_progr' => $data['menu_progr'],
                        'menu_eval_desem' => $data['menu_eval_desem'],
                        'menu_reg_eval_desem' => $data['menu_reg_eval_desem'],
                        'menu_soli_anular_eval_desem' => $data['menu_soli_anular_eval_desem'],
                        'menu_proc_anular_eval_desem' => $data['menu_proc_anular_eval_desem'],
                        'menu_comprobante_eval_desem' => $data['menu_comprobante_eval_desem'],
                        'menu_estdi_eval_desem' => $data['menu_estdi_eval_desem'],
                        'menu_noregi_eval_desem' => $data['menu_noregi_eval_desem'],
                        'menu_llamado' => $data['menu_llamado'],
                        'consultar_llamado' => $data['consultar_llamado'],
                        'reg_llamado' => $data['reg_llamado'],
                        'anul_llamado'=> $data['anul_llamado'],
                        'ver_anul_llamado' => $data['ver_anul_llamado'],
                        'ver_rnc' => $data['ver_rnc'],
                        'ver_conf' => $data['ver_conf'],
                        'ver_parametro' => $data['ver_parametro'],
                        'ver_conf_publ' => $data['ver_conf_publ'],
                        'ver_user' => $data['ver_user'],
                        'ver_user_exter' => $data['ver_user_exter'],
                        'ver_user_desb' => $data['ver_user_desb'],
                        'ver_user_lista' => $data['ver_user_lista'],
                        'ver_user_perfil' => $data['ver_user_perfil'],
                        'fecha_creacion' => date('Y-m-d h:i:s'),
                        'menu_anulacion' => $data['menu_anulacion'],
                        'menu_repor_evalu' => $data['menu_repor_evalu'],
                        );

            $this->db->insert("seguridad.perfil", $data1);

            return true;

        }

         public function ver_perfil($data)
         {
             $this->db->select("f.*");
             $this->db->from('seguridad.perfil f');
             $this->db->where('f.id_perfil', $data);
             $query = $this->db->get();
             $resultado = $query->row_array();
             return $resultado;
         }
         public function save_user_c($data, $data2)
        {  
            $this->db->select('max(e.id) as id1');
            $query1 = $this->db->get('seguridad.usuarios e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1 ;
           
            $data1 = array(
                'id'		    => $id1,
                'nombre'		=> $data['nombre'],
                'password'		=> $data['password'],
                'email'		    => $data['email'],
                'perfil'        => $data['perfil'],
                'foto'          => 1,
                'estado'        => 1,
                'ultimo_login'  => $data['ultimo_login'],
                'fecha'		    => $data['fecha'],
                'intentos'	 	=> $data['intentos'],
                'unidad' 		=> $data['unidad'],
                'id_estatus' 	=> $data['id_estatus'],
                'fecha_update' 	=> $data['fecha_update'],               
                'rif_organoente' => $data['rif_organoente'],
                'id_usuario_c' => $data['id_usuario_c']


            );
            $quers =$this->db->insert("seguridad.usuarios", $data1);
            if ($quers) {
                $id = $id;

                $data3 = array(
                    'id_usuario'    => $id1,
                    'id'		    => $id1,
                    'nombrefun'		=> $data2['nombrefun'],
                    'apellido'		=> $data2['apellido'],
                    'tipo_cedula'	=> $data2['tipo_cedula'],
                    'cedula'	 	=> $data2['cedula'],
                    'tele_1'	 	=> $data2['tele_1'],
                    'tele_2'	 	=> $data2['tele_2'],
                    'cargo'	 	    => $data2['cargo'],
                    'oficina'	 	=> $data2['oficina'],
                    'obser'	 	=> $data2['obser'],
                    'fecha_designacion'	 	=> $data2['fecha_designacion'],
                    'numero_gaceta'	 	=> $data2['numero_gaceta'],
                    'email'	 	=> $data2['email'],
                    'tipo_funcionario'	 	=> $data2['tipo_funcionario'],
                    'unidad'	 	=> $data2['unidad']
                        );
                        $this->db->insert('seguridad.funcionarios', $data3);
                        return true;    
                 }
        }
    
        public function valida_ced4($cedula){
            // $this->db->select('cedula');
            // $this->db->where('cedula', $cedula);
            // //$this->db->order_by('id desc');
            // $query = $this->db->get('seguridad.funcionarios');
            // $response = $query->row_array();
            // return $response;


            $this->db->where('cedula', $cedula);
            $query = $this->db->get('seguridad.funcionarios');
        
            if ($query->num_rows() > 0) {
               
                return 1;
        
            } else {
                return 0;

            }


        }
        public function valida_correo($email){
            // $this->db->select('email');
            // $this->db->where('email ', $email);
            // //$this->db->order_by('id desc');
            // $query = $this->db->get('seguridad.usuarios');
            // $response = $query->row_array();
            // return $response;
            $this->db->select('email');
            $this->db->where('email', $email);
            $query = $this->db->get('seguridad.usuarios');
        
            if ($query->num_rows() > 0) {               
                return 1;        
            } else {
                return 0;
            }
        }
        public function validad_users($usuario){
            $this->db->select('nombre');
            $this->db->where('nombre', $usuario);
            $query = $this->db->get('seguridad.usuarios');
        
            if ($query->num_rows() > 0) {               
                return 1;        
            } else {
                return 0;
            }
            // $this->db->where('nombre ', $usuario);
            // //$this->db->order_by('id desc');
            // $query = $this->db->get('seguridad.usuarios');
            // $response = $query->row_array();
            // return $response;
        }
        function red_ssses(){
            $this->db->select('s.id, s.user_id,login_time,c.nombre');
             $this->db->join('seguridad.usuarios c', 'c.id = s.user_id');
            $this->db->from('seguridad.user_sessions s');
           // $this->db->order_by("codigo_b", "Asc");
            $query = $this->db->get();
            return $query->result_array();
        }
        function delet_sse($data){
            $this->db->where('user_id', $data['user_id']);
            $query = $this->db->delete('seguridad.user_sessions');
            return true;
        }
}