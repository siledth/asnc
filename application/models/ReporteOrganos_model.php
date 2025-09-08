<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteOrganos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    //     public function obtenerOrganosMensual($anio_actual, $anio_anterior)
    //     {
    //         // Obtiene el total de órganos existentes antes del año anterior (base count)
    //         $sql_base_count = "
    //         SELECT COUNT(*) AS total
    //         FROM public.organoente
    //         WHERE fecha < ?
    //     ";
    //         $query_base_count = $this->db->query($sql_base_count, [$anio_anterior . '-01-01']);
    //         $base_count = $query_base_count->row()->total;

    //         // Obtiene los totales de creación de órganos por mes para los dos años
    //         $sql = "
    //         SELECT 
    //             EXTRACT(YEAR FROM fecha) AS anio,
    //             EXTRACT(MONTH FROM fecha) AS mes_numero,
    //             COUNT(*) AS total
    //         FROM 
    //             public.organoente
    //         WHERE 
    //             EXTRACT(YEAR FROM fecha) IN (?, ?)
    //         GROUP BY 
    //             anio, mes_numero
    //         ORDER BY 
    //             anio ASC, mes_numero ASC
    //     ";
    //         $query = $this->db->query($sql, [$anio_anterior, $anio_actual]);
    //         $monthly_data = $query->result_array();

    //         return [
    //             'monthly_data' => $monthly_data,
    //             'base_count' => (int)$base_count
    //         ];
    //     }
    // }
    public function obtenerOrganosMensual($anio_actual, $anio_anterior)
    {
        // Obtiene el total de órganos existentes antes del año anterior (base count)
        $sql_base_count = "
            SELECT COUNT(*) AS total
            FROM public.organoente
            WHERE fecha < ?
        ";
        $query_base_count = $this->db->query($sql_base_count, [$anio_anterior . '-01-01']);
        $base_count = $query_base_count->row()->total;

        // Obtiene los totales de creación de órganos por mes para los dos años
        $sql_monthly = "
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
        $query_monthly = $this->db->query($sql_monthly, [$anio_anterior, $anio_actual]);
        $monthly_data = $query_monthly->result_array();

        return [
            'monthly_data' => $monthly_data,
            'base_count' => (int)$base_count
        ];
    }
}
