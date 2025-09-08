<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteLlamados_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    /**
     * Obtiene el conteo mensual de llamados a concurso por tipo.
     * @param int $anio_actual
     * @param int $anio_anterior
     * @return array
     */
    public function obtenerLlamadosMensual($anio_actual, $anio_anterior)
    {
        $anios = [$anio_anterior, $anio_actual];
        $results = [];

        foreach ($anios as $anio) {
            // Llamados a Concurso por tipo (1: Bienes, 2: Servicios, 3: Obras)
            $sql = "
               SELECT
    EXTRACT(YEAR FROM fecha_disponible_llamado) AS anio,
    EXTRACT(MONTH FROM fecha_disponible_llamado) AS mes_numero,
    id_objeto_contratacion,
    COUNT(*) AS total
FROM
    public.llamado_concurso
WHERE
    EXTRACT(YEAR FROM fecha_disponible_llamado) = ? AND fecha_disponible_llamado <= CURRENT_DATE
GROUP BY
    anio, mes_numero, id_objeto_contratacion
ORDER BY
    anio ASC, mes_numero ASC, id_objeto_contratacion ASC
            ";
            $query = $this->db->query($sql, [$anio]);
            $results[$anio] = $query->result_array();
        }

        return $results;
    }
}
