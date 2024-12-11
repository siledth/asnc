<?php
    class Rnc_model extends CI_model{
        public function read_sending_pay(){
        $this->db->select('p.id_pago, p.id_contratista, p.proceso_id, p.statusid, 
        p.currency, p.amount, p.title, p.description, p.letter, p.numberc, 
        p.transactionid, p.paymentmethoddescription, p.authorizationcode, 
        p.paymentmethodnumber, p.paymentdate, p.pan, c.rifced, c.nombre');
        $this->db->join('rnc.contratista c','c.id_contratista = p.id_contratista');
        $query = $this->db->get('rnc.pay p');
        return $query->result_array();
    }
}