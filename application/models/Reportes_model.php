<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_model extends CI_Model
{

    // Asumiendo que $this->db_b es la conexión a tu base de datos PostgreSQL
    // definida en database.php para la base de datos 'b'
    public function __construct()
    {
        parent::__construct();
        $this->db_b = $this->load->database('SNCenlinea', true);
    }

    /**
     * Obtiene todos los datos necesarios para los tres gráficos
     * @param string $fecha_desde Fecha de inicio (YYYY-MM-DD)
     * @param string $fecha_hasta Fecha de fin (YYYY-MM-DD)
     * @return array Array asociativo con los resultados de los tres gráficos
     */
    public function get_data_graficos($fecha_desde, $fecha_hasta)
    {
        // Calcular el límite superior seguro para la cláusula WHERE (inicio del día siguiente)
        $fecha_hasta_fin_dia = date('Y-m-d', strtotime($fecha_hasta . ' +1 day'));

        $data = [];

        // --- Gráfico 1: Ingresos por Tipo de Transacción (Barras) ---
        $sql_ingresos = "
            SELECT
                tipo_transaccion,
                SUM(amount) AS total_ingresos
            FROM
                repr_pagos_rnc_view
            WHERE
                fecha_registro >= ?  -- Desde el inicio del primer día
                AND fecha_registro < ?  -- Hasta el inicio del día siguiente (excluyente)
            GROUP BY
                tipo_transaccion
            ORDER BY
                total_ingresos DESC
        ";
        $query_ingresos = $this->db_b->query($sql_ingresos, [$fecha_desde, $fecha_hasta_fin_dia]);
        $data['ingresos'] = $query_ingresos->result_array();


        // --- Gráfico 2: Evolución Mensual de Transacciones por Tipo (Líneas) ---
        $sql_evolucion_transacciones = "
            SELECT
                TO_CHAR(fecha_registro, 'YYYY-MM') AS mes, -- Extrae el año y mes
                tipo_transaccion,
                COUNT(id) AS cantidad_transacciones
            FROM
                repr_pagos_rnc_view
            WHERE
                fecha_registro >= ? 
                AND fecha_registro < ? 
            GROUP BY
                mes, tipo_transaccion
            ORDER BY
                mes ASC, tipo_transaccion ASC
        ";
        $query_evolucion = $this->db_b->query($sql_evolucion_transacciones, [$fecha_desde, $fecha_hasta_fin_dia]);
        $data['evolucion_transacciones'] = $query_evolucion->result_array();

        // --- Gráfico 3: Comparación Anual de Ingresos (Barra y Línea) ---
        $data['comparacion_anual'] = $this->get_ingresos_anuales_comparados($fecha_hasta);

        return $data;
    }

    /**
     * Obtiene los ingresos mensuales para el año actual y el año anterior para la comparación.
     * @param string $fecha_hasta La fecha de fin usada en el filtro (determina el año "actual")
     * @return array Datos mensuales para ambos años
     */
    public function get_ingresos_anuales_comparados($fecha_hasta)
    {
        // 1. Determinar los años a comparar
        $ano_actual = date('Y', strtotime($fecha_hasta));
        $ano_anterior = (int)$ano_actual - 1;

        // 2. Consulta SQL optimizada para ambos años
        $sql = "
            SELECT
                EXTRACT(YEAR FROM fecha_registro) AS ano,
                EXTRACT(MONTH FROM fecha_registro) AS mes,
                SUM(amount) AS total_ingresos
            FROM
                repr_pagos_rnc_view
            WHERE
                EXTRACT(YEAR FROM fecha_registro) IN (?, ?)
            GROUP BY
                ano, mes
            ORDER BY
                ano ASC, mes ASC
        ";
        $query = $this->db_b->query($sql, [$ano_anterior, $ano_actual]);
        $resultados = $query->result_array();

        // 3. Formatear los resultados para Chart.js
        $datos_anuales = [
            'ano_actual' => $ano_actual,
            'ano_anterior' => $ano_anterior,
            'actual' => array_fill(1, 12, 0.0), // 12 meses inicializados a 0.0
            'anterior' => array_fill(1, 12, 0.0)
        ];

        foreach ($resultados as $row) {
            $mes = (int)$row['mes'];
            $monto = (float)$row['total_ingresos'];

            if ($row['ano'] == $ano_actual) {
                $datos_anuales['actual'][$mes] = $monto;
            } elseif ($row['ano'] == $ano_anterior) {
                $datos_anuales['anterior'][$mes] = $monto;
            }
        }

        return $datos_anuales;
    }
    /**
     * Obtiene los totales consolidados de ingresos del año actual por tipo de transacción.
     * Esto ofrece un mejor rendimiento que consultar toda la historia.
     * @return array Montos totales por tipo de transacción.
     */
    public function get_totales_kpi_home()
    {
        $ano_actual = date('Y');

        // Consulta usando la vista creada anteriormente (repr_pagos_rnc_view o reporte_pagos_view)
        $sql = "
            SELECT
                tipo_transaccion,
                SUM(amount) AS total_ingresos
            FROM
                repr_pagos_rnc_view -- Asumiendo que esta es la vista que contiene tipo_transaccion
            WHERE
                EXTRACT(YEAR FROM fecha_registro) = ?
            GROUP BY
                tipo_transaccion
            ORDER BY
                total_ingresos DESC
        ";

        $query = $this->db_b->query($sql, [$ano_actual]);

        // Formatear los resultados en un mapa para la vista
        $resultados_map = [];
        $total_general = 0;

        foreach ($query->result_array() as $row) {
            $key = strtolower(str_replace(' ', '_', $row['tipo_transaccion']));
            $key = str_replace(['botón', 'móvil'], ['boton', 'movil'], $key); // Normalizar tildes
            $monto = (float)$row['total_ingresos'];

            $resultados_map[$key] = $monto;
            $total_general += $monto;
        }

        $data = [
            'totales' => $resultados_map,
            'total_general' => $total_general
        ];

        return $data;
    }
}
