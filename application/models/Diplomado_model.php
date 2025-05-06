<?php
class Diplomado_model extends CI_model
{
    //private $table = "certificacion.certificaciones";
    public function __construct()
    {
        parent::__construct();
        // Este metodo conecta a nuestra segunda conexión
        // y asigna a nuestra propiedad $this->db_b_b; los recursos de la misma.
        $this->db_c = $this->load->database('SNCenlinea', true);
    }

    function consultar_dip()
    {
        $this->db->select('*');
        $this->db->from('diplomado.diplomado');
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    //GUARDAR
    function registrar_b($data)
    {
        $this->db->insert('diplomado.diplomado', $data);
        return true;
    }
    //VER PARA ver exonerado y editar
    function consulta_b($data)
    {
        $this->db->select('*');
        $this->db->from('diplomado.diplomado');
        $this->db->where('id_exonerado', $data['id_exonerado']);
        // $this->db->order_by("codigo_b", "Asc");
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    //EDITAR exonerado en bd
    function editar_b($data)
    {
        $this->db->where('id_exonerado', $data['id_exonerado']);
        $update = $this->db->update('certificacion.exonerado', $data);
        return true;
    }
    //ELIMAR
    function eliminar_b($data)
    {
        $this->db->where('id_exonerado', $data['id_exonerado']);
        $query = $this->db->delete('certificacion.exonerado');
        return true;
    }

    public function consulta_grado()
    {
        $this->db->select('id_academico, desc_academico');
        $this->db->order_by('id_academico asc');
        $query = $this->db->get('comisiones.academico');
        return $result = $query->result_array();
    }

    public function consulta_diplomado()
    {
        $this->db->select('id_diplomado, name_d,fdesde,fhasta,id_modalidad');
        $this->db->order_by('id_diplomado asc');
        $query = $this->db->get('diplomado.diplomado');
        return $result = $query->result_array();
    }
    public function get_diplomado_by_id($idDiplomado)
    {
        $this->db->select('id_diplomado, name_d, fdesde, fhasta, id_modalidad');
        $this->db->where('id_diplomado', $idDiplomado);
        $query = $this->db->get('diplomado.diplomado');
        return $query->row_array();
    }

    public function consulta_banco()
    {
        $this->db->select('id_bancos, cod_banc,des_banco');
        $this->db->order_by('id_bancos asc');
        $query = $this->db->get('rnc.bancos');
        return $result = $query->result_array();
    }
}
