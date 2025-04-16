<?php
class Llamado_concurso_model extends CI_Model {

    public function __construct() {
        parent::__construct();
     
    }

    public function get_records($limit, $start, $search = NULL) {
        $this->db->select('rif_organoente, numero_proceso, estatus');
        $this->db->from('llamado_concurso_view');
        
        if ($search) {
            $this->db->like('rif_organoente', $search);
            $this->db->or_like('numero_proceso', $search);
            $this->db->or_like('estatus', $search);
        }

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all($search = NULL) {
        if ($search) {
            $this->db->like('rif_organoente', $search);
            $this->db->or_like('numero_proceso', $search);
            $this->db->or_like('estatus', $search);
        }
        return $this->db->count_all_results('llamado_concurso_view');
    }
}