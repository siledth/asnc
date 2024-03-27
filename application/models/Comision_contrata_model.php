<?php
    class Comision_contrata_model extends CI_model{

        function check_logger_commission($rif_organoente){
            $this->db->select('c.id_comision,c.rif_organoente,c.observacion,c.id_status,c.snc, stu.desc_status, nto.desc_status_snc');
            $this->db->from('comisiones.comision c');
            $this->db->join('comisiones.status_comision stu', 'stu.id_status = c.id_status');
            $this->db->join('comisiones.notificacion_comision nto', 'nto.id_status_snc = c.snc');           
            $this->db->where('rif_organoente', $rif_organoente);
            $query = $this->db->get();
            return $query->result_array();
        }
        function logger_commission($data){
            $p='Comisiòn';
            $r=$data['unidad'];
            $concatenated_variable = (string) $p . ' ' . (string) $r;
            $tipo = $data['tipo_comi'];
            if ($tipo == 1) {
                $nombre = $concatenated_variable;
            }else {
                $nombre = $data['observacion'];
            }
            $this->db->select('max(e.id_comision) as id1');
            $query1 = $this->db->get('comisiones.comision e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1 ; 
            $data1 = array(
                'id_comision'           => $id1,
               'rif_organoente'             => $data['rif_organoente'],
               'tipo_comi'             => $data['tipo_comi'],
               'observacion'           => $nombre,
               'id_usuario'             => $data['id_usuario'],
               'fecha_creacion'             => $data['fecha_creacion'],
               'snc'             => $data['snc'],
               'id_status'             => $data['id_status'],               
               'fecha_cambi_statu'             => $data['fecha_cambi_statu'],      
           );
       //    print_r($data1);die;

            $this->db->insert('comisiones.comision',$data1);
            return true;
        }
        public function get_employees()
        { 
            $this->db->select('id_comision, rif_organoente, tipo_comision, cedula, nombre, apellido');
           // $this->db->where('c.id_comision', $data['id_comision']);

            $query = $this->db->get('comisiones.miembros');
            return $query->result();
        }

        public function check_tipo_com(){
            $this->db->select('id_tipo_comision, descripcion');
            $this->db->from('comisiones.tipo_comision');
            $this->db->order_by('id_tipo_comision ASC');
            $query = $this->db->get();
            return $result = $query->result_array();
        }
        public function check_areas(){
            $this->db->select('id_area_miembro, desc_area_miembro');
            $this->db->from('comisiones.area_miembro');
            $this->db->order_by('id_area_miembro ASC');
            $query = $this->db->get();
            return $result = $query->result_array();
        }
        public function check_tipo(){
            $this->db->select('id_tp_miembro, desc_tp_miembro');
            $this->db->from('comisiones.tp_miembro');
            $this->db->order_by('id_tp_miembro ASC');
            $query = $this->db->get();
            return $result = $query->result_array();
        }
        public function check_comision($data){
            $this->db->select('c.id_comision,c.rif_organoente');
            $this->db->from('comisiones.comision c');
            $this->db->where('c.id_comision', $data['id_comision']);
            $this->db->order_by('c.id_comision ASC');
            $query = $this->db->get();
            $resultado = $query->row_array();
            return $resultado;
	    }
       
        public function save_miembros($data){
            $this->db->select('max(e.id_miembros) as id1');
                $query1 = $this->db->get('comisiones.miembros e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ; 
            $data1 = array(
                'id_miembros'             => $id1,                 
                'id_comision'             => $data['id_comision'],                
                'rif_organoente'                   => $data['rif_organoente'],
                'tipo_comision'                   => 1, ///la comision se elije antes no significa nada borrar de la tabla 
                'cedula'                   => $data['cedula'],
                'nombre'                   => $data['nombre'],
                'apellido'                   => $data['apellido'],
                'id_area_miembro'                   => $data['id_area_miembro'],
                'id_tp_miembro'                   => $data['id_tp_miembro'],
                'fecha_desig'                   => $data['fecha_desig'],
                'acto_adm'                   => $data['acto_adm'],
                'num_acto'                   => $data['num_acto'],
                'fecha_acto'                   => $data['fecha_acto'],
                'correo'                   => $data['correo'],
                'telf'                   => $data['telf'],
                'id_status'                   => 1,
                'fecha_cambi_statu'                   => date('Y-m-d'),
                'id_usuario'                   => $this->session->userdata('id_user'),
                'fecha_creacion'                   => date('Y-m-d'),
                'obj_comision'                   => $data['obj_comision'],


 

            );
       //print_r($data1);die;

            $query=$this->db->insert('comisiones.miembros',$data1);
            return true;
        }
        public function check_miembros($data){
            $this->db->select('pi2.id_miembros,pi2.cedula');
            $this->db->where('pi2.id_comision', $data['id_comision']);
            $query = $this->db->get('comisiones.miembros pi2');
            return $query->result_array();
        }
        public function check_miembros1($data){
            $this->db->select('pi2.id_miembros,pi2.cedula,pi2.nombre,pi2.apellido');
            $this->db->where('pi2.id_miembros', $data['id_miembro']);
            $query = $this->db->get('comisiones.miembros pi2');
            return $query->result_array();
        }
    

        function check_miemb($id_comision){

            $this->db->select('pi2.id_miembros, pi2.id_comision, pi2.rif_organoente, pi2.cedula, pi2.nombre, pi2.apellido,');
                // $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
                // $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
                // $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
                // $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
                $this->db->where('pi2.id_comision', $id_comision);
                // $this->db->where('pi2.id_p_acc', 1);
                $this->db->from('comisiones.miembros pi2');
                $query = $this->db->get();
                return $query->result_array();
        }
        public function enviar_snc($data, $des_unidad, $codigo_onapre, $rif){
            $this->db->select('total');
            $this->db->where('id_comision', $data['id']);
            

                        $query1 = $this->db->get('comisiones.impar_view');                
                        $response4 = $query1->row_array();
                        $numero = $response4['total'] ;

                        if ($numero % 2 == 0){
                            return false;
                } else {
                    $data1 = array('snc' => '2',// enviado al snc
                                'id_usuario' => $this->session->userdata('id_user'),
                                'fecha_notifiacion' => date('Y-m-d h:i:s')
                            );
                $this->db->where('id_comision', $data['id']);
                $update = $this->db->update('comisiones.comision', $data1);
                    return true;
                }
        
             //   print_r($resulta);die;
             //  $this->db->insert('programacion.inf_enviada',$resulta);
        
                // $data1 = array('estatus' => '2',// se puede reprogramar y rendir 
                //                 'id_usuario' => $this->session->userdata('id_user'),
                //                 'date_sending' => date('Y-m-d h:i:s')
                //             );
                // $this->db->where('id_programacion', $data['id']);
                // $update = $this->db->update('programacion.programacion', $data1);
                
        }
    }

    