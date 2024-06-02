<?php

class Tablas_comi_model extends CI_Model {

    function consultaracademi(){
        $this->db->select('*');
        $this->db->from('comisiones.academico');
       // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function registrar_b($data){
        $this->db->select('max(e.id_academico) as id1');
        $query1 = $this->db->get('comisiones.academico e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ;

        $data3 = array(
            'id_academico'    => $id1,
           // 'codigopartida_presupuestaria'   		        => $data['codigopartida_presupuestaria'],
            'desc_academico' => $data['desc_academico'],
            'id_usuario' => $data['id_usuario'],
            'fecha' => $data['fecha']

            
                );
                $this->db->insert('comisiones.academico', $data3);
        return true;
    }
    function consulta_b($data){
        $this->db->select('*');
        $this->db->from('comisiones.academico');
        $this->db->where('id_academico', $data['id_academico']);
       // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    function editar_b($data){
        $this->db->where('id_academico', $data['id_academico']);
        $update = $this->db->update('comisiones.academico', $data);
        return true;
    }
    ////////////////////
    function consultaactoadmin(){
        $this->db->select('*');
        $this->db->from('comisiones.acto_admin');
       // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function registrar_actoadmin($data){
        $this->db->select('max(e.id_acto_admin) as id1');
        $query1 = $this->db->get('comisiones.acto_admin e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ;

        $data3 = array(
            'id_acto_admin'    => $id1,
           // 'codigopartida_presupuestaria'   		        => $data['codigopartida_presupuestaria'],
            'desc_acto_admin' => $data['desc_acto_admin'],
            'id_usuario' => $data['id_usuario'],
            'fecha' => $data['fecha']

            
                );
                $this->db->insert('comisiones.acto_admin', $data3);
        return true;
    }
    function consulta_actoadmin($data){
        $this->db->select('*');
        $this->db->from('comisiones.acto_admin');
        $this->db->where('id_acto_admin', $data['id_acto_admin']);
       // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    function editar_actoadmin($data){
        $this->db->where('id_acto_admin', $data['id_acto_admin']);
        $update = $this->db->update('comisiones.acto_admin', $data);
        return true;
    }
    //////////////////////
    function consultaarea_mb(){
        $this->db->select('*');
        $this->db->from('comisiones.area_miembro');
       // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function registrar_area_mb($data){
        $this->db->select('max(e.id_area_miembro) as id1');
        $query1 = $this->db->get('comisiones.area_miembro e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ;

        $data3 = array(
            'id_area_miembro'    => $id1,
           // 'codigopartida_presupuestaria'   		        => $data['codigopartida_presupuestaria'],
            'desc_area_miembro' => $data['desc_area_miembro'],
            'id_usuario' => $data['id_usuario'],
            'fecha' => $data['fecha']

            
                );
                $this->db->insert('comisiones.area_miembro', $data3);
        return true;
    }
    function consulta_area_mb($data){
        $this->db->select('*');
        $this->db->from('comisiones.area_miembro');
        $this->db->where('id_area_miembro', $data['id_area_miembro']);
       // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    function editar_area_mb($data){
        $this->db->where('id_area_miembro', $data['id_area_miembro']);
        $update = $this->db->update('comisiones.area_miembro', $data);
        return true;
    }
    /////////////////////////////////////
    function consultaestatus_mbb(){
        $this->db->select('*');
        $this->db->from('comisiones.status_miembro');
       // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function registrar_estatus_mb($data){
        $this->db->select('max(e.id_status_miembro) as id1');
        $query1 = $this->db->get('comisiones.status_miembro e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ;

        $data3 = array(
            'id_status_miembro'    => $id1,
           // 'codigopartida_presupuestaria'   		        => $data['codigopartida_presupuestaria'],
            'desc_status_miembro' => $data['desc_status_miembro'],
            
            
                );
                $this->db->insert('comisiones.status_miembro', $data3);
        return true;
    }
    function consulta_estatus_mb($data){
        $this->db->select('*');
        $this->db->from('comisiones.status_miembro');
        $this->db->where('id_status_miembro', $data['id_status_miembro']);
       // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    function editar_estatus_mb($data){
        $this->db->where('id_status_miembro', $data['id_status_miembro']);
        $update = $this->db->update('comisiones.status_miembro', $data);
        return true;
    }
}
