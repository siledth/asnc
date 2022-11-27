<?php

class Login_model extends CI_model {

    public function iniciar($usuario, $contrasena) {
        $this->db->select('f.*,
        c.id_perfil, c.menu_rnce, c.menu_progr, c.menu_eval_desem, c.menu_reg_eval_desem, c.menu_soli_anular_eval_desem, 
        c.menu_proc_anular_eval_desem, c.menu_comprobante_eval_desem, c.menu_estdi_eval_desem, 
        c.menu_noregi_eval_desem, c.menu_llamado, c.consultar_llamado, c.reg_llamado, anul_llamado, 
        c.ver_anul_llamado, c.ver_rnc, c.ver_conf, c.ver_parametro, 
        c.ver_conf_publ, c.ver_user, c.ver_user_exter, c.ver_user_desb, c.ver_user_lista, c.ver_user_perfil, c.menu_anulacion, c.menu_repor_evalu');
        
        $this->db->from('seguridad.usuarios f');
        $this->db->join('seguridad.perfil c', 'c.id_perfil = f.perfil', 'left');
        $this->db->where('nombre', $usuario);
        $result = $this->db->get();
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
                    if ($intento <= 6) {
                        $intento = $intento + 1;
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

    public function consultar_organo($id_unidad) {
        $this->db->select('o.id_organo,
                               o.codigo,
                               o.cod_onapre,
                               concat(tr.desc_rif, \' - \' ,o.rif) as rif,
                               o.desc_organo');
        $this->db->join('tipo_rif tr', 'tr.id_rif = o.tipo_rif');
        $this->db->where('o.codigo', $id_unidad);
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
            $this->db->where('e.codigo', $id_unidad);
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
                $this->db->where('ea.codigo', $id_unidad);
                $this->db->from('entes_ads ea');
                $result = $this->db->get();
                return $result->row_array();
            } else {
                return $result->row_array();
            }
        } else {
            return $result->row_array();
        }
    }

    public function cambiar_clave($id_usuario, $data) {
        $this->db->where('id', $id_usuario);
        $update = $this->db->update('seguridad.usuarios', $data);
        return $update;
    }

}

?>
