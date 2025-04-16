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

    public function read_sending_audit(){
        $this->db->select(' p.id_procesos, p.contratista_id, p.user_id, p.codedoproccola, p.codedoproc, p.tipproc,
         p.date_create, c.rifced, c.nombre, ed.descedoproc, r.descrealizando,
         a.authorizationcode, a.amount, a.transactionid ');
        $this->db->where("p.codedoproccola", "ER");

        $this->db->join('rnc.contratista c','c.id_contratista = p.contratista_id');
        $this->db->join('rnc.edoproccolas ed','ed.codedoproccola = p.codedoproccola');
        $this->db->join('rnc.realizando r','r.id_realizando = p.tipproc');
        $this->db->join('rnc.pay  a','a.id_contratista = p.contratista_id');
        $query = $this->db->get('rnc.procesos p');
        return $query->result_array();
    }
}