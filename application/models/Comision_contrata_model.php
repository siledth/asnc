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
            $this->db->insert('comisiones.comision',$data);
            return true;
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
                'tipo_comision'                   => $data['tipo_comision'],
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
            $this->db->where('pi2.id_comision', $data['id_comision3']);
            $query = $this->db->get('comisiones.miembros pi2');
            return $query->result_array();
        }
        public function check_miembros1($data){
            $this->db->select('pi2.id_miembros,pi2.cedula,pi2.nombre,pi2.apellido');
            $this->db->where('pi2.id_miembros', $data['id_miembro']);
            $query = $this->db->get('comisiones.miembros pi2');
            return $query->result_array();
        }
    }

    