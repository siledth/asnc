<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteTop10_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    /**
     * Obtiene el top 10 de productos más solicitados de la programacion anual.
     * @param int $anio
     * @return array
     */
    public function obtenerTop10Solicitados($anio)
    {
        $sql = "
            SELECT
                t1.id_ccnu,
                t2.desc_ccnu,
                t2.codigo_ccnu,
                SUM(CAST(REPLACE(REPLACE(NULLIF(t1.cantidad, ''), '.', ''), ',', '.') AS numeric)) AS cantidad_solicitada,
                SUM(CAST(REPLACE(REPLACE(NULLIF(t1.monto_estimado, ''), '.', ''), ',', '.') AS numeric)) AS monto_total
            FROM
                programacion.p_items t1
            INNER JOIN
                programacion.ccnu t2 ON t1.id_ccnu = t2.codigo_ccnu
            WHERE
                EXTRACT(YEAR FROM t1.fecha_desde) = ?
            GROUP BY
                t1.id_ccnu, t2.codigo_ccnu, t2.desc_ccnu
            ORDER BY
                cantidad_solicitada DESC
            LIMIT 10
        ";
        $query = $this->db->query($sql, [$anio]);
        return $query->result_array();
    }

    /**
     * Obtiene el top 10 de productos más rendidos.
     * @param int $anio
     * @return array
     */
    public function obtenerTop10Rendidos($anio)
    {
        $sql = "
            SELECT
                t1.codigo_ccnu,
                t1.desc_ccnu,
                SUM(CAST(REPLACE(REPLACE(NULLIF(t1.cantidad_ejecu, ''), '.', ''), ',', '.') AS numeric)) AS cantidad_ejecutada,
                SUM(CAST(REPLACE(REPLACE(NULLIF(t1.total_rendi, ''), '.', ''), ',', '.') AS numeric)) AS monto_total
            FROM
                programacion.rendidicion t1
            WHERE
                EXTRACT(YEAR FROM t1.fecha_rendicion) = ?
            GROUP BY
                t1.codigo_ccnu, t1.desc_ccnu
            ORDER BY
                cantidad_ejecutada DESC
            LIMIT 10
        ";
        $query = $this->db->query($sql, [$anio]);
        return $query->result_array();
    }
    /**
     * Obtiene el top 10 de organos/entes que más llamados a concurso han realizado.
     * @param int $anio
     * @return array
     */
    public function obtenerTop10Organos($anio)
    {
        $sql = "
            SELECT
                t1.rif_padre AS rif,
                t2.descripcion AS descripcion,
                COUNT(*) AS cantidad_llamados
            FROM
                public.llamado_concurso_2 t1
            INNER JOIN
                public.organoente t2 ON t1.rif_padre = t2.rif
            WHERE
                EXTRACT(YEAR FROM t1.fecha_disponible_llamado) = ?
            GROUP BY
                t1.rif_padre, t2.descripcion
            ORDER BY
                cantidad_llamados DESC
            LIMIT 10
        ";
        $query = $this->db->query($sql, [$anio]);
        return $query->result_array();
    }
}
