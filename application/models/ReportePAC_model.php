<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportePAC_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    /**
     * Obtiene el conteo mensual para PAC y Rendiciones.
     * @param int $anio_actual
     * @param int $anio_anterior
     * @return array
     */
    public function obtenerDatosMensuales($anio_actual, $anio_anterior)
    {
        $anios = [$anio_anterior, $anio_actual];
        $results = [];

        foreach ($anios as $anio) {
            // PAC Registrados
            $sql_registrados = "
                SELECT 
                    EXTRACT(MONTH FROM fecha) AS mes_numero,
                    COUNT(*) AS total
                FROM 
                    programacion.programacion
                WHERE 
                    EXTRACT(YEAR FROM fecha) = ?
                GROUP BY 
                    mes_numero
                ORDER BY 
                    mes_numero ASC
            ";
            $query_registrados = $this->db->query($sql_registrados, [$anio]);
            $results['registrados'][$anio] = $query_registrados->result_array();

            // PAC Notificados
            $sql_notificados = "
                SELECT COUNT(DISTINCT p.id_programacion) AS total_notificadas, EXTRACT(MONTH FROM p.fecha) AS mes_numero
                FROM programacion.programacion p
                INNER JOIN programacion.inf_enviada ie ON p.id_programacion = ie.id_programacion
                WHERE EXTRACT(YEAR FROM p.fecha) = ?
                GROUP BY mes_numero
                ORDER BY mes_numero ASC
            ";
            $query_notificados = $this->db->query($sql_notificados, [$anio]);
            $results['notificados'][$anio] = $query_notificados->result_array();

            // Rendiciones Registradas
            $sql_rendidas = "
                SELECT COUNT(DISTINCT p.id_programacion) AS total_rendida, EXTRACT(MONTH FROM p.fecha) AS mes_numero
                FROM programacion.programacion p
                INNER JOIN programacion.inf_enviada_rendi ie ON p.id_programacion = ie.id_programacion
                WHERE EXTRACT(YEAR FROM p.fecha) = ?
                GROUP BY mes_numero
                ORDER BY mes_numero ASC
            ";
            $query_rendidas = $this->db->query($sql_rendidas, [$anio]);
            $results['rendidas'][$anio] = $query_rendidas->result_array();
        }

        return $results;
    }
}
