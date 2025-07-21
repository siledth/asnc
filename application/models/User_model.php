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
        $data1 = array(
            'id_estatus' => '1',
            'intentos' => '0',
            'password' => '$2y$10$T3rwxYhqdCJxft4p32W4J.KLZpOZViLs38JH2NuHGH9zBvuPExiPC',
            'fecha_update' => date('Y-m-d h:i:s')
        );
        $this->db->where('id', $data['id']);
        $update = $this->db->update('seguridad.usuarios', $data1);
        return true;
    }
    /////////////bloque o inhabilitacion usuario
    public function blo_usuario($data)
    {
        $data1 = array(
            'id_estatus' => '4',
            'intentos' => '3',
            //'password'=> '$2y$10$T3rwxYhqdCJxft4p32W4J.KLZpOZViLs38JH2NuHGH9zBvuPExiPC',
            'fecha_update' => date('Y-m-d h:i:s')
        );
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

        if ($result->num_rows() != 1) {
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
        $id1 = $response4['id1'] + 1;

        $data1 = array(
            'id'            => $id1,
            'nombre'        => $data['nombre'],
            'password'        => $data['password'],
            'email'            => $data['email'],
            'perfil'        => $data['perfil'],
            'foto'          => 1,
            'estado'        => 1,
            'ultimo_login'  => $data['ultimo_login'],
            'fecha'            => $data['fecha'],
            'intentos'         => $data['intentos'],
            'unidad'         => $data['unidad'],
            'id_estatus'     => $data['id_estatus'],
            'fecha_update'     => $data['fecha_update'],
            'rif_organoente' => $data['rif_organoente'],

        );
        $quers = $this->db->insert("seguridad.usuarios", $data1);
        if ($quers) {
            // $id = $id;

            $data3 = array(
                'id_usuario'    => $id1,
                'id'            => $id1,
                'nombrefun'        => $data2['nombrefun'],
                'apellido'        => $data2['apellido'],
                'tipo_cedula'    => $data2['tipo_cedula'],
                'cedula'         => $data2['cedula'],
                'tele_1'         => $data2['tele_1'],
                'tele_2'         => $data2['tele_2'],
                'cargo'             => $data2['cargo'],
                'oficina'         => $data2['oficina'],
                'obser'         => $data2['obser'],
                'fecha_designacion'         => $data2['fecha_designacion'],
                'numero_gaceta'         => $data2['numero_gaceta'],
                'email'         => $data2['email'],
                'tipo_funcionario'         => $data2['tipo_funcionario'],
                'unidad'         => $data2['unidad']
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
                    t.nombrep,
                    id_estatus
                ");
        $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
        $this->db->join('public.organoente r', 'r.rif = f.rif_organoente', 'left');
        $this->db->join('seguridad.perfil t', 't.id_perfil = f.perfil', 'left');
        $this->db->where('f.rif_organoente ', 'G200024518');
        $this->db->where('f.id_estatus ', 1);
        $query = $this->db->get('seguridad.usuarios f');
        return $result = $query->result_array();


        //$query = $this->db->get('programacion.alicuota_iva');
        // if (count($query->result()) > 0) {
        //return $query->result();
        // }
    }
    public function get_usuario_inac_snc()
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
                    t.nombrep,
                    id_estatus
                ");
        $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
        $this->db->join('public.organoente r', 'r.rif = f.rif_organoente', 'left');
        $this->db->join('seguridad.perfil t', 't.id_perfil = f.perfil', 'left');
        $this->db->where('f.rif_organoente ', 'G200024518');
        $this->db->where('f.id_estatus ', 4);
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
    public function get_usuario_externos3()
    {
        $this->db->select("f.id,
                    f.nombre,
                    f.id_estatus,
                    f.intentos,
                    f.nombre_empresa,
                    c.nombrefun,
                    c.apellido,
                    c.id as id1,
                    t.nombrep
                ");
        $this->db->join('seguridad.funcionarios c', 'c.id_usuario = f.id', 'left');
        // $this->db->join('public.organoente r', 'r.rif = f.rif_organoente', 'left');
        $this->db->join('seguridad.perfil t', 't.id_perfil = f.perfil', 'left');
        //$this->db->where('f.rif_organoente !=', 'G200024518');
        $query = $this->db->get('programacion.userp f');
        return $result = $query->result_array();
    }

    public function read_list($data)
    {
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
        $this->db->where('e.id', $data['id']);
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

            'perfil'                 => $usua['perfil'],
            'unidad'                 => $usua['unidad1'],
            'rif_organoente'                 => $usua['rif_organoente1'],
            'fecha_update'             => $usua['fecha_update'],


        );
        $this->db->where('id', $id);
        $update = $this->db->update('seguridad.usuarios', $dataus);

        if ($update) {
            $this->db->where('id_usuario', $id);
            // $this->db->where('id_p_acc', 0);

            $data_inf = array(
                // 'id_usuario'              => $id,
                'nombrefun'               => $funci['nombrefun'],
                'apellido'              => $funci['apellido'],
                'cedula'                => $funci['cedula'],
                'cargo'                 => $funci['cargo'],
                'oficina'                 => $funci['oficina'],
                'tele_1'                 => $funci['tele_1'],
                'tele_2'                 => $funci['tele_2'],
                'fecha_designacion'                 => $funci['fecha_designacion'],
                'numero_gaceta'             => $funci['numero_gaceta'],
                'email'             => $funci['email'],

            );
            $update = $this->db->update('seguridad.funcionarios', $data_inf);
        }
        return true;
    }

    ///////////////////////////////////////////////////////////////////////////////////



    public function guardar_mod_user($data)
    {


        //aca modifique
        $data1 = array(
            'nombrefun' => $data['nombrefun'],
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
    public function consultar_perfiles1($data)
    {
        $this->db->select('f.id_perfil, 
            f.nombrep,
             f.fecha_creacion');
        $this->db->where('f.id_perfil !=', $data['id_perfil']);
        $query = $this->db->get('seguridad.perfil f');
        return $query->result_array();
    }
    public function read_list_p($data)
    {
        $this->db->select(
            ' * '
        );
        $this->db->from('perfiles_n');

        $this->db->where('id_perfil', $data['id_perfil']);
        // $this->db->order_by('mc.id_p_items desc');
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }
    public function read_list_p2($data)
    {
        $this->db->select(
            ' * '
        );
        $this->db->from('seguridad.perfil');

        $this->db->where('id_perfil', $data['id_perfil']);
        // $this->db->order_by('mc.id_p_items desc');
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }

    public function organo_ent($data)
    {
        $this->db->select('rif,codigo ,descripcion,certificaciones');
        $this->db->where('certificaciones', '0');
        $query = $this->db->get('public.organoente');
        return $query->result_array();
    }
    public function organo_ent1($data)
    {
        $this->db->select('rif,codigo ,descripcion,certificaciones');
        $this->db->where('rif', $data['camb_org']);
        $this->db->where('certificaciones', '0');
        $query = $this->db->get('public.organoente');
        return $query->result_array();
    }
    public function save_modif_user1($data)
    { //externo

        $this->db->where('id', $data['id']);

        $pp_s = $data['cambio_perf'];
        if ($pp_s == 0) {
            $perfil = $data['id_perfil'];
        } else {
            $perfil = $data['cambio_perf'];
        }

        $org_en = $data['camb_org'];
        if ($org_en == 1) {
            $rif_organoente1 = $data['rif_organoente1'];
            $unidad1 = $data['unidad1'];
        } else {
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
                'nombrefun'               => $data['nombrefun'],
                'apellido'              => $data['apellido'],
                'cedula'                => $data['cedula'],
                'cargo'                 => $data['cargo'],
                //     'oficina' 	            => $data['oficina'],
                //    'tele_1' 	            => $data['tele_1'],
                //     'tele_2' 	            => $data['tele_2'],
                //     'fecha_designacion' 	            => $funci['fecha_designacion'],
                //     'numero_gaceta'             => $funci['numero_gaceta'],
                'email'             => $data['email'],

            );
            $update1 = $this->db->update('seguridad.funcionarios', $data_inf);
        }
        if ($update = true) {
            return 1;
        } else {
            return 0;
        }
        // return true;
    }
    public function guardar_perfil($data)
    {
        $parametros = $data['id_user'];
        $separar        = explode("/", $parametros);
        $codigo = $separar['0'];
        $name = $separar['1'];
        // var_dump($codigo);
        // var_dump($rif);
        $data1 = array(
            'id_perfil'            => $codigo,
            'nombrep' => $name,
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
            'anul_llamado' => $data['anul_llamado'],

            'ver_rnc' => $data['ver_rnc'],
            'ver_avanzado' => $data['ver_avanzado'],
            'avanz_rnce' => $data['avanz_rnce'],
            'avanz_rnc' => $data['avanz_rnc'],
            'avanz_gne' => $data['avanz_gne'],
            'resultados_avza' => $data['resultados_avza'],


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
            // 'ver_anul_llamado' => $data['ver_anul_llamado'],
            'accion_llamado' => $data['accion_llamado'],

            'menu_repor_evalu' => $data['menu_repor_evalu'],
            'menu_comisiones' => $data['menu_comisiones'],
            'comisiones_interna_mieb' => $data['comisiones_interna_mieb'],
            'comisiones_interna_certifi' => $data['comisiones_interna_certifi'],
            'notif_comisi_externa_mib' => $data['notif_comisi_externa_mib'],
            'certi_miemb_externo' => $data['certi_miemb_externo'],
            'consulta_snc_certi_mb' => $data['consulta_snc_certi_mb'],
            'consultas_exter_miembros' => $data['consultas_exter_miembros'],
            'consultas_exter_mb_certificado' => $data['consultas_exter_mb_certificado'],
            'registrar_prog_anual' => $data['registrar_prog_anual'],
            'modi_prog_anual_ley' => $data['modi_prog_anual_ley'],
            'reg_rend_anual' => $data['reg_rend_anual'],
            'consul_prog_anual' => $data['consul_prog_anual'],
            'consul_mod_ley_anual' => $data['consul_mod_ley_anual'],
            'consultar_rendi_anual' => $data['consultar_rendi_anual'],
        );

        $this->db->insert("seguridad.perfil", $data1);


        if ($this->db->affected_rows() > 0) {
            // Realiza el update en la tabla usuarios
            $this->db->where('id', $codigo);
            $this->db->update('seguridad.usuarios', array('perfil' => $codigo));
            return 1;
        } else {
            return 0;
        }
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
    // public function save_user_c($data, $data2)  // ya no se usa
    // {
    //     $this->db->select('max(e.id) as id1');
    //     $query1 = $this->db->get('seguridad.usuarios e');
    //     $response4 = $query1->row_array();
    //     $id1 = $response4['id1'] + 1;

    //     $data1 = array(
    //         'id'            => $id1,
    //         'nombre'        => $data['nombre'],
    //         'password'        => $data['password'],
    //         'email'            => $data['email'],
    //         'perfil'        => $data['perfil'],
    //         'foto'          => 1,
    //         'estado'        => 1,
    //         'ultimo_login'  => $data['ultimo_login'],
    //         'fecha'            => $data['fecha'],
    //         'intentos'         => $data['intentos'],
    //         'unidad'         => $data['unidad'],
    //         'id_estatus'     => $data['id_estatus'],
    //         'fecha_update'     => $data['fecha_update'],
    //         'rif_organoente' => $data['rif_organoente'],
    //         'id_usuario_c' => $data['id_usuario_c']


    //     );
    //     $quers = $this->db->insert("seguridad.usuarios", $data1);
    //     if ($quers) {
    //         // $id = $id;

    //         $data3 = array(
    //             'id_usuario'    => $id1,
    //             'id'            => $id1,
    //             'nombrefun'        => $data2['nombrefun'],
    //             'apellido'        => $data2['apellido'],
    //             'tipo_cedula'    => $data2['tipo_cedula'],
    //             'cedula'         => $data2['cedula'],
    //             'tele_1'         => $data2['tele_1'],
    //             'tele_2'         => $data2['tele_2'],
    //             'cargo'             => $data2['cargo'],
    //             'oficina'         => $data2['oficina'],
    //             'obser'         => $data2['obser'],
    //             'fecha_designacion'         => $data2['fecha_designacion'],
    //             'numero_gaceta'         => $data2['numero_gaceta'],
    //             'email'         => $data2['email'],
    //             'tipo_funcionario'         => $data2['tipo_funcionario'],
    //             'unidad'         => $data2['unidad']
    //         );
    //         $this->db->insert('seguridad.funcionarios', $data3);
    //         return true;
    //     }
    // }

    public function valida_ced4($cedula)
    {
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
    public function valida_correo($email)
    {
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
    public function validad_users($usuario)
    {
        $this->db->select('nombre');
        $this->db->where('nombre', $usuario);
        $query = $this->db->get('seguridad.usuarios');

        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    function red_ssses()
    {
        $this->db->select('s.id, s.user_id,login_time,c.nombre');
        $this->db->join('seguridad.usuarios c', 'c.id = s.user_id');
        $this->db->from('seguridad.user_sessions s');
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function delet_sse($data)
    {
        $this->db->where('user_id', $data['user_id']);
        $query = $this->db->delete('seguridad.user_sessions');
        return true;
    }
    public function save_modif_perfil($data)
    {

        $this->db->where('id_perfil', $data['id_perfil']);

        $pp_s = $data['camb_menu_rnce'];
        if ($pp_s == 2) {
            $menu_rnce = $data['menu_rnce'];
        } else {
            $menu_rnce = $data['camb_menu_rnce'];
        }

        $ccnu_s = $data['camb_menu_progr'];
        if ($ccnu_s == 2) {
            $menu_progr = $data['menu_progr'];
        } else {
            $menu_progr = $data['camb_menu_progr'];
        }
        $menuevalu = $data['cam_menu_eval_desem'];
        if ($menuevalu == 2) {
            $menu_eval_desem = $data['menu_eval_desem'];
        } else {
            $menu_eval_desem = $data['cam_menu_eval_desem'];
        }

        $menu_reg = $data['camb_menu_reg_eval_desem'];
        if ($menu_reg == 2) {
            $menu_reg_eval_desem = $data['menu_reg_eval_desem'];
        } else {
            $menu_reg_eval_desem = $data['camb_menu_reg_eval_desem'];
        }
        $menu_anula = $data['camb_menu_anulacion'];
        if ($menu_anula == 2) {
            $menu_anulacion = $data['menu_anulacion'];
        } else {
            $menu_anulacion = $data['camb_menu_anulacion'];
        }
        $menu_soli_anular_eval_dese = $data['camb_menu_soli_anular_eval_desem'];
        if ($menu_soli_anular_eval_dese == 2) {
            $menu_soli_anular_eval_desem = $data['menu_soli_anular_eval_desem'];
        } else {
            $menu_soli_anular_eval_desem = $data['camb_menu_soli_anular_eval_desem'];
        }

        $menu_proc_anular_eval_dese = $data['camb_menu_proc_anular_eval_desem'];
        if ($menu_proc_anular_eval_dese == 2) {
            $menu_proc_anular_eval_desem = $data['menu_proc_anular_eval_desem'];
        } else {
            $menu_proc_anular_eval_desem = $data['camb_menu_proc_anular_eval_desem'];
        }
        $menu_comprobante_eval_dese = $data['camb_menu_comprobante_eval_desem'];
        if ($menu_comprobante_eval_dese == 2) {
            $menu_comprobante_eval_desem = $data['menu_comprobante_eval_desem'];
        } else {
            $menu_comprobante_eval_desem = $data['camb_menu_comprobante_eval_desem'];
        }
        $menu_estdi_eval_dese = $data['camb_menu_estdi_eval_desem'];
        if ($menu_estdi_eval_dese == 2) {
            $menu_estdi_eval_desem = $data['menu_estdi_eval_desem'];
        } else {
            $menu_estdi_eval_desem = $data['camb_menu_estdi_eval_desem'];
        }
        $menu_noregi_eval_dese  = $data['camb_menu_noregi_eval_desem'];
        if ($menu_noregi_eval_dese  == 2) {
            $menu_noregi_eval_desem = $data['menu_noregi_eval_desem'];
        } else {
            $menu_noregi_eval_desem = $data['camb_menu_noregi_eval_desem'];
        }
        $menu_llamad  = $data['camb_menu_llamado'];
        if ($menu_llamad  == 2) {
            $menu_llamado = $data['menu_llamado'];
        } else {
            $menu_llamado = $data['camb_menu_llamado'];
        }
        $consultar_llamad  = $data['camb_consultar_llamado'];
        if ($consultar_llamad  == 2) {
            $consultar_llamado = $data['consultar_llamado'];
        } else {
            $consultar_llamado = $data['camb_consultar_llamado'];
        }
        $reg_llamad  = $data['camb_reg_llamado'];
        if ($reg_llamad  == 2) {
            $reg_llamado = $data['reg_llamado'];
        } else {
            $reg_llamado = $data['camb_reg_llamado'];
        }
        $anul_llamad  = $data['camb_anul_llamado'];
        if ($anul_llamad  == 2) {
            $anul_llamado = $data['anul_llamado'];
        } else {
            $anul_llamado = $data['camb_anul_llamado'];
        }
        $ver_anul_llamad  = $data['camb_ver_anul_llamado'];
        if ($ver_anul_llamad  == 2) {
            $ver_anul_llamado = $data['ver_anul_llamado'];
        } else {
            $ver_anul_llamado = $data['camb_ver_anul_llamado'];
        }
        $ver_rnc1  = $data['camb_ver_rnc'];
        if ($ver_rnc1  == 2) {
            $ver_rnc = $data['ver_rnc'];
        } else {
            $ver_rnc = $data['camb_ver_rnc'];
        }

        $ver_ver_avanzado1  = $data['camb_ver_avanzado'];
        if ($ver_ver_avanzado1  == 2) {
            $ver_ver_avanzado = $data['ver_ver_avanzado'];
        } else {
            $ver_ver_avanzado = $data['camb_ver_avanzado'];
        }

        $ver_avanz_rnce1  = $data['camb_avanz_rnce'];
        if ($ver_avanz_rnce1  == 2) {
            $ver_avanz_rnce = $data['ver_avanz_rnce'];
        } else {
            $ver_avanz_rnce = $data['camb_avanz_rnce'];
        }

        $ver_avanz_rnc1  = $data['camb_avanz_rnc'];
        if ($ver_avanz_rnc1  == 2) {
            $ver_avanz_rnc = $data['ver_avanz_rnc'];
        } else {
            $ver_avanz_rnc = $data['camb_avanz_rnc'];
        }

        $ver_avanz_gne1  = $data['camb_avanz_gne'];
        if ($ver_avanz_gne1  == 2) {
            $ver_avanz_gne = $data['ver_avanz_gne'];
        } else {
            $ver_avanz_gne = $data['camb_avanz_gne'];
        }
        $ver_resultados_avza1  = $data['camb_resultados_avza'];
        if ($ver_resultados_avza1  == 2) {
            $ver_resultados_avza = $data['ver_resultados_avza'];
        } else {
            $ver_resultados_avza = $data['camb_resultados_avza'];
        }


        $ver_conf1  = $data['camb_ver_conf'];
        if ($ver_conf1  == 2) {
            $ver_conf = $data['ver_conf'];
        } else {
            $ver_conf = $data['camb_ver_conf'];
        }
        $ver_parametro1  = $data['camb_ver_parametro'];
        if ($ver_parametro1  == 2) {
            $ver_parametro = $data['ver_parametro'];
        } else {
            $ver_parametro = $data['camb_ver_parametro'];
        }
        $ver_conf_publ1  = $data['camb_ver_conf_publ'];
        if ($ver_conf_publ1  == 2) {
            $ver_conf_publ = $data['ver_conf_publ'];
        } else {
            $ver_conf_publ = $data['camb_ver_conf_publ'];
        }
        $ver_user1  = $data['camb_ver_user'];
        if ($ver_user1  == 2) {
            $ver_user = $data['ver_user'];
        } else {
            $ver_user = $data['camb_ver_user'];
        }
        $ver_user_exter1  = $data['camb_ver_user_exter'];
        if ($ver_user_exter1  == 2) {
            $ver_user_exter = $data['ver_user_exter'];
        } else {
            $ver_user_exter = $data['camb_ver_user_exter'];
        }
        $ver_user_desb1  = $data['camb_ver_user_desb'];
        if ($ver_user_desb1  == 2) {
            $ver_user_desb = $data['ver_user_desb'];
        } else {
            $ver_user_desb = $data['camb_ver_user_desb'];
        }
        $ver_user_lista1  = $data['camb_ver_user_lista'];
        if ($ver_user_lista1  == 2) {
            $ver_user_lista = $data['ver_user_lista'];
        } else {
            $ver_user_lista = $data['camb_ver_user_lista'];
        }
        $ver_user_perfil1  = $data['camb_ver_user_perfil'];
        if ($ver_user_perfil1  == 2) {
            $ver_user_perfil = $data['ver_user_perfil'];
        } else {
            $ver_user_perfil = $data['camb_ver_user_perfil'];
        }
        $data1 = array(

            'menu_rnce' => $menu_rnce,
            'menu_progr' => $menu_progr,
            'menu_eval_desem' => $menu_eval_desem,
            'menu_reg_eval_desem' => $menu_reg_eval_desem,
            'menu_soli_anular_eval_desem' => $menu_soli_anular_eval_desem,
            'menu_proc_anular_eval_desem' => $menu_proc_anular_eval_desem,
            'menu_comprobante_eval_desem' => $menu_comprobante_eval_desem,
            'menu_estdi_eval_desem' => $menu_estdi_eval_desem,
            'menu_noregi_eval_desem' => $menu_noregi_eval_desem,
            'menu_llamado' => $menu_llamado,
            'consultar_llamado' => $consultar_llamado,
            'reg_llamado' => $reg_llamado,
            'anul_llamado' => $anul_llamado,
            'ver_anul_llamado' => $ver_anul_llamado,
            'ver_rnc' => $ver_rnc,
            'ver_avanzado' => $ver_ver_avanzado,
            'avanz_rnce' => $ver_avanz_rnce,
            'avanz_rnc' => $ver_avanz_rnc,
            'avanz_gne' => $ver_avanz_gne,
            'resultados_avza' => $ver_resultados_avza,
            'ver_conf' => $ver_conf,
            'ver_parametro' => $ver_parametro,
            'ver_conf_publ' => $ver_conf_publ,
            'ver_user' => $ver_user,
            'ver_user_exter' => $ver_user_exter,
            'ver_user_desb' => $ver_user_desb,
            'ver_user_lista' => $ver_user_lista,
            'ver_user_perfil' => $ver_user_perfil,
            'menu_anulacion' => $menu_anulacion,


        );
        $update = $this->db->update('seguridad.perfil', $data1);
        return true;
    }
    public function check_user()
    {
        $this->db->select('id, nombre');
        $this->db->from('seguridad.usuarios');
        $this->db->where('id_estatus', '1');
        // $this->db->order_by('id_academico ASC');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function llenar_organos($data)
    {
        $this->db->select('
                        c.rif,
                        c.descripcion
                       ');
        $this->db->where('c.rif', $data['rif_b']);
        $query = $this->db->get('public.organoente c');
        $result = $query->row_array();
        if ($result == '') {
            $this->db->select('  c.rifced,
                                 c.nombre
                                ');

            $this->db->where('c.rifced', $data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
            return $result = $query->row_array();
        } else {
            return $result;
        }
    }
    public function llenar_organos2($data)
    {
        $this->db->select('
                        c.rif,
                        c.descripcion
                       ');
        $this->db->where('c.rif', $data['rif_b']);
        $query = $this->db->get('public.organoente c');
        $result = $query->row_array();

        return $result;
    }


    public function save_solicitud($data)
    {
        if (isset($data['reg_rend_anual'])) {
            $reg_rend_anual = 'on'; // Checkbox está seleccionado
        } else {
            $reg_rend_anual = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['reg_llamado'])) {
            $reg_llamado = 'on'; // Checkbox está seleccionado
        } else {
            $reg_llamado = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['consul_ll'])) {
            $consul_ll = 'on'; // Checkbox está seleccionado
        } else {
            $consul_ll = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['procesos_ll'])) {
            $procesos_ll = 'on'; // Checkbox está seleccionado
        } else {
            $procesos_ll = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['accion_llamado'])) {
            $accion_llamado = 'on'; // Checkbox está seleccionado
        } else {
            $accion_llamado = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['menu_reg_eval_desem'])) {
            $menu_reg_eval_desem = 'on'; // Checkbox está seleccionado
        } else {
            $menu_reg_eval_desem = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['menu_soli_anular_eval_desem'])) {
            $menu_soli_anular_eval_desem = 'on'; // Checkbox está seleccionado
        } else {
            $menu_soli_anular_eval_desem = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['menu_comprobante_eval_desem'])) {
            $menu_comprobante_eval_desem = 'on'; // Checkbox está seleccionado
        } else {
            $menu_comprobante_eval_desem = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['reg_not_mb_comi'])) {
            $reg_not_mb_comi = 'on'; // Checkbox está seleccionado
        } else {
            $reg_not_mb_comi = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['reg_cert_mb_comi'])) {
            $reg_cert_mb_comi = 'on'; // Checkbox está seleccionado
        } else {
            $reg_cert_mb_comi = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['consulta_mb_comi'])) {
            $consulta_mb_comi = 'on'; // Checkbox está seleccionado
        } else {
            $consulta_mb_comi = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['ver_rnc'])) {
            $ver_rnc = 'on'; // Checkbox está seleccionado
        } else {
            $ver_rnc = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['registrar_prog_anual'])) {
            $registrar_prog_anual = 'on'; // Checkbox está seleccionado
        } else {
            $registrar_prog_anual = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['modi_prog_anual_ley'])) {
            $modi_prog_anual_ley = 'on'; // Checkbox está seleccionado
        } else {
            $modi_prog_anual_ley = 'off'; // Checkbox no está seleccionado
        }
        if (isset($data['ccp_facilitadores'])) {
            $ccp_facilitadores = 'on'; // Checkbox está seleccionado
        } else {
            $ccp_facilitadores = 'off'; // Checkbox no está seleccionado
        }
        $rif_contrat = $data['sel_rif_nombre5'];
        if ($rif_contrat == '') {


            $exit_rnc = 0;
        } else {

            $exit_rnc = 1;
        }

        $this->db->select('max(e.id_solicitud_user) as id');
        $query = $this->db->get('public.solicitud_user e');
        $response = $query->row_array();
        if ($response) {
            $id = $response['id'] + 1;

            $data1 = array(
                'id_solicitud_user'     => $id,
                'rif'      => $data['rif_b'],
                'name_f'    => $data['name_f'],
                'name_max_a_f'         => $data['name_max_a_f'],
                'cargo__max_a_f'         => $data['cargo__max_a_f'],
                'apellido_f'          => $data['apellido_f'],
                'cedula_f'        => $data['cedula_f'],
                'cargo_f'       => $data['cargo_f'],
                'telefono_f'          => $data['telefono_f'],
                'correo'             => $data['correo'],
                'registrar_prog_anual'      => $registrar_prog_anual,
                'modi_prog_anual_ley'  => $modi_prog_anual_ley,
                'reg_rend_anual'  => $reg_rend_anual,
                'reg_llamado'       => $reg_llamado,
                'consul_ll'       => $consul_ll,
                'procesos_ll'       => $procesos_ll,
                'accion_llamado'       => $accion_llamado,
                'menu_reg_eval_desem'       => $menu_reg_eval_desem,
                'menu_soli_anular_eval_desem'       => $menu_soli_anular_eval_desem,
                'menu_comprobante_eval_desem'       => $menu_comprobante_eval_desem,
                'reg_not_mb_comi'       => $reg_not_mb_comi,
                'reg_cert_mb_comi'       => $reg_cert_mb_comi,
                'consulta_mb_comi'       => $consulta_mb_comi,
                'ver_rnc'       => $ver_rnc,
                'exit_rnc'       => $exit_rnc,  //debe guardar 1 si existe 
                'cod_onapre'    => $data['cod_onapre'],
                'siglas'         => $data['siglas'],
                'id_clasificacion'         => $data['id_clasificacion'],
                'tel_local'         => $data['tel_local'],
                'pag_web'             => $data['pag_web'],
                'id_estado_n'         => $data['id_estado_n'],
                'id_municipio_n'         => $data['id_municipio_n'],
                'id_parroquia_n'         => $data['id_parroquia_n'],
                'direccion_fiscal'         => $data['direccion_fiscal'],
                'rifadscrito'         => $data['rifadscrito'],
                'nameadscrito'         => $data['nameadscrito'],
                'ccp_facilitadores'         => $ccp_facilitadores,
                'cedula__max_a_f'         => $data['cedula__max_a_f'],
                'actoad__max_a_f'         => $data['actoad__max_a_f'],
                'n__max_a_f'         => $data['n__max_a_f'],
                'fecha__max_a_f'         => $data['fecha__max_a_f'],
                'gaceta__max_a_f'         => $data['gaceta__max_a_f'],
                'gfecha__max_a_f'         => $data['gfecha__max_a_f'],




            );
            $x = $this->db->insert('public.solicitud_user', $data1);
            if ($x) {
                $id = $id;
                if ($exit_rnc == 0) {
                    $data3 = array(

                        'id_solicitud_user'            => $id,
                        'rif'        => $data['rif_b'],
                        'descripcion'        => $data['razon_social'],
                        'cod_onapre'    => $data['cod_onapre'],
                        'siglas'         => $data['siglas'],
                        'id_clasificacion'         => $data['id_clasificacion'],
                        'tel_local'         => $data['tel_local'],
                        'pag_web'             => $data['pag_web'],
                        'name_max_a_f'         => $data['name_max_a_f'],
                        'cargo__max_a_f'         => $data['cargo__max_a_f'],
                        'id_estado_n'         => $data['id_estado_n'],
                        'id_municipio_n'         => $data['id_municipio_n'],
                        'id_parroquia_n'         => $data['id_parroquia_n'],
                        'direccion_fiscal'         => $data['direccion_fiscal'],
                        'rifadscrito'         => $data['rifadscrito'],
                        'nameadscrito'         => $data['nameadscrito'],
                        'cedula__max_a_f'         => $data['cedula__max_a_f'],
                        'actoad__max_a_f'         => $data['actoad__max_a_f'],
                        'n__max_a_f'         => $data['n__max_a_f'],
                        'fecha__max_a_f'         => $data['fecha__max_a_f'],
                        'gaceta__max_a_f'         => $data['gaceta__max_a_f'],
                        'gfecha__max_a_f'         => $data['gfecha__max_a_f'],

                    );
                    $this->db->insert('public.sorg_ent_no_snc', $data3);
                }
                return $id;
            }
        }
    }

    function consulta_solictud($data1)
    {

        $query = $this->db->query("SELECT c.*, o.descripcion,o.rif  , cl.rif as rifasdcr, cl.descripcion as nombreascrito,al.desc_acto_admin,
        o.cod_onapre as code_onapre, o.id_estado, o.id_municipio, o.id_parroquia, o.siglas as sliglas_, o.direccion as dri, o.pagina_web, o.id_clasificacion, c2.desc_clasificacion, 
         e.descedo, m.descmun, p.descparro, o.tel1 as tele_     
                 FROM public.solicitud_user c 
                join  public.organoente o on o.rif = c.rif	
                 join  public.organoente cl on cl.id_organoente = o.id_organoenteads
                  join  public.estados e on e.id = o.id_estado
                  join  public.municipios m on m.id = o.id_municipio	
                  join  public.parroquias p on p.id = o.id_parroquia	
                 join  comisiones.acto_admin al on al.id_acto_admin = c.actoad__max_a_f

                 join  public.clasificacion c2 on c2.id_clasificacion =  o.id_clasificacion	

                 where c.id_solicitud_user = '$data1' 
                  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }


    function consulta_solictud1($data1)
    {

        $query = $this->db->query("SELECT c.exit_rnc
                 FROM public.solicitud_user c                    
                 where c.id_solicitud_user = '$data1' 
                  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    function consulta_solictud3($data1)
    {

        $query = $this->db->query("SELECT c.*, o.descripcion,o.id_estado_n, o.id_municipio_n, o.id_parroquia_n, o.siglas, 
            o.direccion_fiscal as dri,o.siglas,o.cod_onapre, o.id_clasificacion, o.tel_local ,
             cl.desc_clasificacion,  e.descedo, m.descmun, p.descparro,  o.pag_web, o.name_max_a_f, o.cargo__max_a_f, 
             o.rifadscrito, o.nameadscrito, o.cedula__max_a_f, o.actoad__max_a_f, o.n__max_a_f, o.fecha__max_a_f, o.gaceta__max_a_f, o.gfecha__max_a_f, al.desc_acto_admin
            
                 FROM public.solicitud_user c 
                join  public.sorg_ent_no_snc o on o.rif = c.rif	
                join  public.estados e on e.id = o.id_estado_n	
                join  public.municipios m on m.id = o.id_municipio_n	
                join  public.parroquias p on p.id = o.id_parroquia_n	
                join  public.clasificacion cl on cl.id_clasificacion = o.id_clasificacion
                join  comisiones.acto_admin al on al.id_acto_admin = c.actoad__max_a_f

                    
                 where c.id_solicitud_user = '$data1' 
                  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function consulta_solictud4($data1)
    {

        $query = $this->db->query("SELECT name_f, apellido_f, cedula_f, cargo_f, telefono_f, correo, 
                            registrar_prog_anual, modi_prog_anual_ley, reg_rend_anual, consl_p_m_r, reg_llamado, consul_ll, 
                            procesos_ll, accion_llamado, menu_reg_eval_desem, menu_soli_anular_eval_desem, menu_comprobante_eval_desem, 
                            reg_not_mb_comi, reg_cert_mb_comi, consulta_mb_comi, ver_rnc,ccp_facilitadores
                 FROM public.solicitud_user 

                    
                 where id_solicitud_user = '$data1' 
                  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function consulta_solictud5($data1)
    {

        $query = $this->db->query("SELECT 
                            registrar_prog_anual, modi_prog_anual_ley, reg_rend_anual, consl_p_m_r, reg_llamado, consul_ll, 
                            procesos_ll, accion_llamado, menu_reg_eval_desem, menu_soli_anular_eval_desem, menu_comprobante_eval_desem, 
                            reg_not_mb_comi, reg_cert_mb_comi, consulta_mb_comi, ver_rnc
                 FROM public.solicitud_user 

                    
                 where id_solicitud_user = '$data1' 
                  ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }




    public function get_all_users_with_profile_names()
    {
        $this->db->select('u.id, u.nombre, u.email, p.nombrep as perfil_nombre, u.perfil as perfil_id, u.rif_organoente, u.id_estatus, o.descripcion ');
        $this->db->from('seguridad.usuarios u');
        // Join with the 'perfil' table to get the profile name (nombrep) instead of just the ID
        $this->db->join('seguridad.perfil p', 'u.perfil = p.id_perfil', 'left');
        $this->db->join('public.organoente o', 'o.rif = u.rif_organoente', 'left');

        //$this->db->where('u.rif_organoente', 'G200024518');
        //$this->db->where('u.id_estatus', 1);


        $query = $this->db->get();
        return $query->result_array(); // Returns an array of associative arrays
    }
    public function get_user_details($user_id)
    {
        // Seleccionamos email desde la tabla usuarios y cédula desde funcionarios para el modal.
        $this->db->select('u.id, u.nombre, u.email, u.perfil');
        $this->db->select('f.nombrefun, f.apellido, f.tipo_cedula, f.cedula, f.cargo, f.oficina, f.tele_1, f.tele_2'); // Alias para evitar conflicto si 'cedula' existe en 'usuarios'
        $this->db->from('seguridad.usuarios u');
        $this->db->join('seguridad.funcionarios f', 'u.id = f.id_usuario', 'left'); // Unir para obtener la cédula
        $this->db->where('u.id', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_all_profiles_dropdown()
    {
        $this->db->select('id_perfil, nombrep');
        $this->db->from('seguridad.perfil');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_profile_permissions($profile_id)
    {
        $this->db->from('seguridad.perfil');
        $this->db->where('id_perfil', $profile_id);
        $query = $this->db->get();
        return $query->row_array(); // Returns a single row with all profile fields
    }
    public function update_user_assigned_profile($user_id, $new_profile_id)
    {
        $data = array('perfil' => $new_profile_id);
        $this->db->where('id', $user_id);
        $this->db->update('seguridad.usuarios', $data);
        return $this->db->affected_rows() > 0;
    }
    public function update_profile_permissions($profile_id, $permissions_data)
    {
        $this->db->where('id_perfil', $profile_id);
        $this->db->update('seguridad.perfil', $permissions_data);
        return $this->db->affected_rows() > 0;
    }

    public function get_users_paginated($limit = 10, $offset = 0, $filters = [])
    {
        // Seleccionamos las columnas de la tabla usuarios y otras relacionadas.
        $this->db->select('u.id, u.nombre, u.email, p.nombrep as perfil_nombre, u.perfil as perfil_id, u.rif_organoente, u.id_estatus, o.descripcion as organoente_descripcion, u.fecha');
        // Seleccionamos los campos de cédula desde la tabla funcionarios.
        // Usamos f.cedula directamente y f.tipo_cedula.
        $this->db->select('f.tipo_cedula, f.cedula as cedula_funcionario');

        $this->db->from('seguridad.usuarios u');
        $this->db->join('seguridad.perfil p', 'u.perfil = p.id_perfil', 'left');
        $this->db->join('public.organoente o', 'o.rif = u.rif_organoente', 'left');
        // Realizamos el JOIN con la tabla seguridad.funcionarios usando u.id = f.id_usuario.
        $this->db->join('seguridad.funcionarios f', 'u.id = f.id_usuario', 'left');

        // Aplicar filtros si existen
        if (!empty($filters)) {
            if (isset($filters['nombre_usuario']) && $filters['nombre_usuario'] !== '') {
                $this->db->like('LOWER(u.nombre)', strtolower($filters['nombre_usuario']));
            }
            // Nuevo filtro por cédula (desde la tabla funcionarios).
            // Buscamos tanto por el número de cédula solo como por la combinación tipo_cedula-cedula.
            if (isset($filters['cedula']) && $filters['cedula'] !== '') {
                $search_cedula = strtolower($filters['cedula']);
                $this->db->group_start(); // Inicia un grupo OR
                $this->db->like('LOWER(f.cedula)', $search_cedula); // Busca solo por el número
                $this->db->or_like("LOWER(CONCAT(f.tipo_cedula, '-', f.cedula))", $search_cedula); // Busca por 'V-12345678'
                $this->db->group_end(); // Cierra el grupo OR
            }
            if (isset($filters['organo_ente']) && $filters['organo_ente'] !== '') {
                $this->db->group_start();
                $this->db->like('LOWER(u.rif_organoente)', strtolower($filters['organo_ente']));
                $this->db->or_like('LOWER(o.descripcion)', strtolower($filters['organo_ente']));
                $this->db->group_end();
            }
        }

        // Ordenar por fecha de creación descendente para los últimos creados
        $this->db->order_by('u.fecha', 'DESC');
        $this->db->order_by('u.id', 'DESC'); // Añadimos ID como segundo criterio para desempate.

        $this->db->limit($limit, $offset); // Aplica el límite y el offset para la paginación.

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Obtiene el conteo total de usuarios, aplicando los mismos filtros.
     * @param array $filters Array asociativo de filtros.
     * @return int El número total de usuarios que coinciden con los filtros.
     */
    public function count_all_users($filters = [])
    {
        $this->db->from('seguridad.usuarios u');
        $this->db->join('public.organoente o', 'o.rif = u.rif_organoente', 'left');
        // Necesario unir también la tabla funcionarios para que el filtro por cédula funcione en el conteo.
        $this->db->join('seguridad.funcionarios f', 'u.id = f.id_usuario', 'left');

        // Aplicar los mismos filtros que en get_users_paginated
        if (!empty($filters)) {
            if (isset($filters['nombre_usuario']) && $filters['nombre_usuario'] !== '') {
                $this->db->like('LOWER(u.nombre)', strtolower($filters['nombre_usuario']));
            }
            if (isset($filters['cedula']) && $filters['cedula'] !== '') { // Nuevo filtro por cédula en el conteo
                $search_cedula = strtolower($filters['cedula']);
                $this->db->group_start();
                $this->db->like('LOWER(f.cedula)', $search_cedula);
                $this->db->or_like("LOWER(CONCAT(f.tipo_cedula, '-', f.cedula))", $search_cedula);
                $this->db->group_end();
            }
            if (isset($filters['organo_ente']) && $filters['organo_ente'] !== '') {
                $this->db->group_start();
                $this->db->like('LOWER(u.rif_organoente)', strtolower($filters['organo_ente']));
                $this->db->or_like('LOWER(o.descripcion)', strtolower($filters['organo_ente']));
                $this->db->group_end();
            }
        }
        return $this->db->count_all_results();
    }

    public function update_user_details($user_id, $user_data, $funcionario_data)
    {
        $success_user = true;
        $success_funcionario = true;

        // Actualizar seguridad.usuarios
        if (!empty($user_data)) {
            $this->db->where('id', $user_id);
            $this->db->update('seguridad.usuarios', $user_data);
            // affected_rows() puede ser 0 si no hubo cambios, lo cual sigue siendo un "éxito"
            // Solo es un fallo si hubo un error de BD.
            $success_user = ($this->db->error()['code'] == 0); // Verifica si no hay error de BD
        }

        // Actualizar seguridad.funcionarios
        if (!empty($funcionario_data)) {
            // Asumimos que id_usuario en funcionarios es único y se relaciona 1:1 con usuarios.id
            $this->db->where('id_usuario', $user_id);
            $this->db->update('seguridad.funcionarios', $funcionario_data);
            $success_funcionario = ($this->db->error()['code'] == 0); // Verifica si no hay error de BD
        }

        return $success_user && $success_funcionario;
    }
    public function update_user_status($user_id, $status_data)
    {
        // Añadimos la fecha de actualización automáticamente.
        // H:i:s para incluir la hora, que es importante para la granularidad.
        $status_data['fecha_update'] = date('Y-m-d H:i:s');

        $this->db->where('id', $user_id);
        $this->db->update('seguridad.usuarios', $status_data);

        // affected_rows() puede ser 0 si no hubo cambios, lo cual es un "éxito" si la operación se realizó sin error.
        // Solo retornamos false si hubo un error de base de datos (código de error diferente de 0).
        return ($this->db->error()['code'] == 0);
    }


    //////////////////////////
    public function cedula_exists($cedula_val)
    { // Renombrado para evitar conflicto con columna
        $this->db->where('cedula', $cedula_val);
        $query = $this->db->get('seguridad.funcionarios');
        log_message('debug', 'Model::cedula_exists - Cédula recibida: ' . $cedula_val . ', Filas encontradas: ' . $query->num_rows());
        return $query->num_rows() > 0;
    }

    public function email_exists($email_val)
    { // Renombrado para evitar conflicto con columna
        $this->db->where('email', $email_val);
        $query = $this->db->get('seguridad.usuarios');
        log_message('debug', 'Model::email_exists - Email recibido: ' . $email_val . ', Filas encontradas: ' . $query->num_rows());
        return $query->num_rows() > 0;
    }

    public function username_exists($username_val)
    { // Renombrado para evitar conflicto con columna
        $this->db->where('nombre', $username_val); // 'nombre' es la columna de usuario en seguridad.usuarios
        $query = $this->db->get('seguridad.usuarios');
        log_message('debug', 'Model::username_exists - Usuario recibido: ' . $username_val . ', Filas encontradas: ' . $query->num_rows());
        return $query->num_rows() > 0;
    }
    public function save_user_c($data_user, $data_funcionario)
    {
        log_message('debug', 'Model::save_user_c - Iniciando guardado.');

        // 1. Validaciones de Unicidad
        if ($this->username_exists($data_user['nombre'])) {
            log_message('debug', 'Model::save_user_c - Fallo: Nombre de usuario duplicado.');
            return 4;
        }
        if ($this->email_exists($data_user['email'])) {
            log_message('debug', 'Model::save_user_c - Fallo: Correo electrónico duplicado.');
            return 3;
        }
        if ($this->cedula_exists($data_funcionario['cedula'])) {
            log_message('debug', 'Model::save_user_c - Fallo: Cédula duplicada.');
            return 2;
        }

        $this->db->trans_start(); // Iniciar transacción

        try {
            // **CORRECCIÓN AQUÍ:** Declarar $user_id_generado antes del bloque if
            $user_id_generado = null; // Inicializar a null o 0

            // Preparar datos para usuarios (quitar 'id' si es SERIAL)
            $user_data_for_insert = $data_user;
            unset($user_data_for_insert['id']);

            // 2. Insertar en seguridad.usuarios
            log_message('debug', 'Model::save_user_c - Insertando en seguridad.usuarios. Datos: ' . json_encode($user_data_for_insert));
            $this->db->insert("seguridad.usuarios", $user_data_for_insert);

            // Verificar inserción y obtener el ID
            if ($this->db->affected_rows() === 0 || $this->db->error()['code'] != 0) {
                throw new Exception('Error al insertar en la tabla usuarios: ' . $this->db->error()['message']);
            }
            $user_id_generado = $this->db->insert_id(); // Asignar el valor aquí
            log_message('debug', 'Model::save_user_c - Inserción en usuarios exitosa. ID generado: ' . $user_id_generado);

            // Preparar datos para funcionarios (enlazar con el ID generado, quitar 'id' si es SERIAL)
            $funcionario_data_for_insert = $data_funcionario;
            unset($funcionario_data_for_insert['id']);
            $funcionario_data_for_insert['id_usuario'] = $user_id_generado;

            // 3. Insertar en seguridad.funcionarios
            log_message('debug', 'Model::save_user_c - Insertando en seguridad.funcionarios. Datos: ' . json_encode($funcionario_data_for_insert));
            $this->db->insert('seguridad.funcionarios', $funcionario_data_for_insert);

            // Verificar inserción en funcionarios
            if ($this->db->affected_rows() === 0 || $this->db->error()['code'] != 0) {
                throw new Exception('Error al insertar en la tabla funcionarios: ' . $this->db->error()['message']);
            }
            log_message('debug', 'Model::save_user_c - Inserción en funcionarios exitosa.');

            // 4. Confirmar la Transacción
            $this->db->trans_complete(); // Usa trans_complete() para commit/rollback automático

            if ($this->db->trans_status() === FALSE) {
                log_message('error', 'Model::save_user_c - Transacción fallida (trans_status FALSE).');
                return 0; // Error general
            } else {
                log_message('debug', 'Model::save_user_c - Transacción completada con éxito. Retorna 1.');
                return 1; // Éxito
            }
        } catch (Exception $e) {
            // 5. Revertir Transacción en caso de error
            $this->db->trans_rollback();
            log_message('error', 'Model::save_user_c - Excepción capturada durante la transacción (Rollback): ' . $e->getMessage());
            return 0; // Error general de base de datos
        }
    }

    public function get_funcionario_by_cedula($cedula)
    {
        $this->db->select('nombrefun, apellido, tipo_cedula, cedula, cargo, oficina, tele_1, tele_2, fecha_designacion, numero_gaceta, email, tipo_funcionario, unidad, fecha, obser, id_usuario, id');
        $this->db->from('seguridad.funcionarios');
        $this->db->where('cedula', $cedula);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return a single row as an associative array
        }
        return null; // No user found
    }
}
