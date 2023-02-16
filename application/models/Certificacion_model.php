<?php
class Certificacion_model extends CI_model
{
    public function inf_1(){
           
        $this->db->select('*');
        $query = $this->db->get('certificacion.tarifas');
        return $result = $query->result_array();
    }

}