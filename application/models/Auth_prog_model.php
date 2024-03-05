<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_prog_model extends CI_Model
{
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
        function red_prog($rif){
            $this->db->select('id_ainf_enviada, id_programacion, des_unidad, rif,anio');
            $this->db->from('programacion.inf_enviada ');
            $this->db->where('rif', $rif);

            $query = $this->db->get();
            return $query->result_array();
        }
        function delet_sse($data){
            $this->db->where('user_id', $data['user_id']);
            $query = $this->db->delete('seguridad.user_sessions');
            return true;
        }
        function red_prog_a(){
            $this->db->select('a.id_auth, a.id_programacion, a.motivo, a.cedula_solc, a.nom_ape_solc, a.telf_solc, a.cargo,a.fecha_solicitud,a.id_estatus, p.unidad, p.anio, org.rif,org.descripcion');
            $this->db->from('programacion.auth_prog a');
            $this->db->join('programacion.programacion p', 'p.id_programacion = a.id_programacion');
            $this->db->join('public.organoente org', 'org.codigo = p.unidad');
            $query = $this->db->get();
            return $query->result_array();
        }
        public function save_solicitud($id, $d_anulacion){
            $quers =$this->db->insert('programacion.auth_prog', $d_anulacion);
            // $data2 = array(
            //     'id_estatus' => 2,
            // );
            // $this->db->where('id', $id);
            // $update = $this->db->update('evaluacion_desempenio.evaluacion', $data2);
            // return $id;
            // $this->db->select('id_auth');
            // $this->db->where('id_auth', $usuario);
            // $query = $this->db->get('programacion.auth_prog');
        }


        public function resgistrar_solicitud_edit1($data){

            $this->db->select('max(e.id_auth) as id1');
            $query1 = $this->db->get('programacion.auth_prog e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1 ;
           
            $data1 = array(
                'id_auth'		    => $id1,
                'id_programacion'		=> $data['id'],
                'motivo'		=> $data['motivo'],
                'cedula_solc'		    => $data['cd'],
                'nom_ape_solc'		    => $data['nom_ape_solc'],
                'telf_solc'		    => $data['telf_solc'],
                'cargo'  => $data['cargo'],
                'id_usuario'		    => $this->session->userdata('id_user'),
                'id_estatus' 	=>0 //no procesasda

            );
            $quers =$this->db->insert("programacion.auth_prog", $data1);
            return $data1['id_auth'];
        }
        public function read_solic($data){
            $this->db->select('a.id_auth, a.id_programacion, a.motivo, a.cedula_solc, a.nom_ape_solc, a.telf_solc, a.cargo,a.fecha_solicitud,a.id_estatus, p.unidad, p.anio, org.rif,org.descripcion');
            $this->db->where('id_auth', $data['id_auth']);
            $this->db->join('programacion.programacion p', 'p.id_programacion = a.id_programacion');
            $this->db->join('public.organoente org', 'org.codigo = p.unidad');
            $query = $this->db->get('programacion.auth_prog a');
            return $response = $query->row_array();
        }
        public function guardar_solici($data){
             
            $data1 = array('estatus' => 0,                           
                        );                     
                            
            $this->db->where('id_programacion', $data['id_programacion']);
            $update = $this->db->update('programacion.programacion', $data1);
    
            if ($update) {
                $data2 = array('id_estatus' => 2, 
                                ' aprobado_user' => $this->session->userdata('id_user'),
                                ' fecha_procesado' => date('Y-m-d'),

                                                          
            );                    
                
            $this->db->where('id_auth', $data['id_auth']);
            $update2 = $this->db->update('programacion.auth_prog', $data2);
          
           
            $this->db->where('id_programacion', $data['id_programacion']);
                    
                    $this->db->delete('programacion.inf_enviada');
            } 
            if ($update= true) {               
                return 1;        
            } else {
                return 0;
            }
        }
}