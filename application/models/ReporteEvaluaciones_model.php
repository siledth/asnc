<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteEvaluaciones_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    /**
     * Obtiene el conteo mensual de evaluaciones por calificación y las anuladas.
     * @param int $anio_actual
     * @param int $anio_anterior
     * @return array
     */
    public function obtenerEvaluacionesMensual($anio_actual, $anio_anterior)
    {
        $anios = [$anio_anterior, $anio_actual];
        $results = [];

        foreach ($anios as $anio) {
            // Evaluaciones por calificación (EXCELENTE, BUENO, REGULAR, DEFICIENTE)
            $sql_calificaciones = "
                SELECT
                    EXTRACT(YEAR FROM fecha_reg_eval) AS anio,
                    EXTRACT(MONTH FROM fecha_reg_eval) AS mes_numero,
                    calificacion,
                    COUNT(*) AS total
                FROM
                    evaluacion_desempenio.evaluacion
                WHERE
                    EXTRACT(YEAR FROM fecha_reg_eval) = ? AND id_estatus =1 AND fecha_reg_eval <= CURRENT_DATE
                GROUP BY
                    anio, mes_numero, calificacion
                ORDER BY
                    anio ASC, mes_numero ASC
            ";
            $query_calificaciones = $this->db->query($sql_calificaciones, [$anio]);
            $results['calificaciones'][$anio] = $query_calificaciones->result_array();

            // Evaluaciones Anuladas
            $sql_anuladas = "
                SELECT
                    EXTRACT(YEAR FROM fecha_reg_eval) AS anio,
                    EXTRACT(MONTH FROM fecha_reg_eval) AS mes_numero,
                    COUNT(*) AS total
                FROM
                    evaluacion_desempenio.evaluacion
                WHERE
                    EXTRACT(YEAR FROM fecha_reg_eval) = ? AND id_estatus = 3 AND fecha_reg_eval <= CURRENT_DATE
                GROUP BY
                    anio, mes_numero
                ORDER BY
                    anio ASC, mes_numero ASC
            ";
            $query_anuladas = $this->db->query($sql_anuladas, [$anio]);
            $results['anuladas'][$anio] = $query_anuladas->result_array();
        }

        return $results;
    }
}
