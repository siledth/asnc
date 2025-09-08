<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteOrganosMensual_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    /**
     * Obtiene el conteo de órganos creados en cada mes para los dos años de comparación.
     * @param int $anio_actual
     * @param int $anio_anterior
     * @return array
     */
    public function obtenerOrganosMensual($anio_actual, $anio_anterior)
    {
        $sql = "
            SELECT 
                EXTRACT(YEAR FROM fecha) AS anio,
                EXTRACT(MONTH FROM fecha) AS mes_numero,
                COUNT(*) AS total
            FROM 
                public.organoente
            WHERE 
                EXTRACT(YEAR FROM fecha) IN (?, ?)
            GROUP BY 
                anio, mes_numero
            ORDER BY 
                anio ASC, mes_numero ASC
        ";
        $query = $this->db->query($sql, [$anio_anterior, $anio_actual]);
        $monthly_data = $query->result_array();

        return [
            'monthly_data' => $monthly_data
        ];
    }
}
