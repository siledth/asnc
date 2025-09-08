<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteComisiones_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    /**
     * Obtiene el conteo de comisiones y miembros por mes para dos años.
     * @param int $anio_actual
     * @param int $anio_anterior
     * @return array
     */
    public function obtenerComisionesMensual($anio_actual, $anio_anterior)
    {
        // Totales de Comisiones Notificadas
        $sql_comisiones = "
            SELECT 
                EXTRACT(YEAR FROM fecha_creacion) AS anio,
                EXTRACT(MONTH FROM fecha_creacion) AS mes_numero,
                COUNT(*) AS total
            FROM 
                comisiones.comision
            WHERE 
                EXTRACT(YEAR FROM fecha_creacion) IN (?, ?) AND snc = 2 AND id_status = 1
            GROUP BY 
                anio, mes_numero
            ORDER BY 
                anio ASC, mes_numero ASC
        ";
        $query_comisiones = $this->db->query($sql_comisiones, [$anio_anterior, $anio_actual]);
        $data_comisiones = $query_comisiones->result_array();

        // Totales de Miembros Certificados
        $sql_miembros = "
            SELECT 
                EXTRACT(YEAR FROM fecha_cambi_statu) AS anio,
                EXTRACT(MONTH FROM fecha_cambi_statu) AS mes_numero,
                COUNT(*) AS total
            FROM 
                comisiones.miembros
            WHERE 
                EXTRACT(YEAR FROM fecha_cambi_statu) IN (?, ?) AND id_cert = '2'
            GROUP BY 
                anio, mes_numero
            ORDER BY 
                anio ASC, mes_numero ASC
        ";
        $query_miembros = $this->db->query($sql_miembros, [$anio_anterior, $anio_actual]);
        $data_miembros = $query_miembros->result_array();

        return [
            'comisiones_data' => $data_comisiones,
            'miembros_data' => $data_miembros
        ];
    }
}
