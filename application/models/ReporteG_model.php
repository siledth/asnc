<?php

class ReporteG_model extends CI_Model
{
    // public function obtenerTotales($fechad, $fechah)
    // {
    //     // Total de programaciones registradas
    //     $query1 = $this->db->query("
    //         SELECT COUNT(*) AS total_programacion
    //         FROM programacion.programacion
    //         WHERE fecha BETWEEN ? AND ?
    //     ", [$fechad, $fechah]);
    //     $total_programacion = $query1->row()->total_programacion;

    //     // Total de programaciones notificadas
    //     $query2 = $this->db->query("
    //         SELECT COUNT(DISTINCT id_programacion) AS total_notificadas
    //         FROM programacion.inf_enviada
    //         WHERE fecha BETWEEN ? AND ?
    //     ", [$fechad, $fechah]);
    //     $total_notificadas = $query2->row()->total_notificadas;

    //     return [
    //         'total_programacion' => $total_programacion,
    //         'total_notificadas' => $total_notificadas
    //     ];
    // }

    // public function obtenerTotales($fechad, $fechah)
    // {
    //     // Convertir fechas al formato correcto
    //     $fechad = date('Y-m-d', strtotime($fechad));
    //     $fechah = date('Y-m-d', strtotime($fechah));

    //     // 1. Total de programaciones registradas
    //     $query1 = $this->db->query("
    //     SELECT COUNT(*) AS total_programacion
    //     FROM programacion.programacion
    //     WHERE fecha BETWEEN ? AND ?
    // ", [$fechad, $fechah]);
    //     $total_programacion = $query1->row()->total_programacion;

    //     // 2. Total de programaciones notificadas
    //     $query2 = $this->db->query("
    //     SELECT COUNT(DISTINCT id_programacion) AS total_notificadas
    //     FROM programacion.inf_enviada
    //     WHERE fecha BETWEEN ? AND ?
    // ", [$fechad, $fechah]);
    //     $total_notificadas = $query2->row()->total_notificadas;

    //     // 3. Totales de bienes, servicios y obras por proyectos
    //     $query3 = $this->db->query("
    //     SELECT 
    //         COUNT(id_p_proyecto) AS total_proyectos,
    //         SUM(CASE WHEN id_obj_comercial = 1 THEN 1 ELSE 0 END) AS total_bienes,
    //         SUM(CASE WHEN id_obj_comercial = 2 THEN 1 ELSE 0 END) AS total_servicios,
    //         SUM(CASE WHEN id_obj_comercial = 3 THEN 1 ELSE 0 END) AS total_obras
    //     FROM 
    //         programacion.p_proyecto
    //     WHERE 
    //         fecha BETWEEN ? AND ?
    // ", [$fechad, $fechah]);
    //     $proyectos_data = $query3->row();

    //     return [
    //         'total_programacion' => $total_programacion,
    //         'total_notificadas' => $total_notificadas,
    //         'total_proyectos' => $proyectos_data->total_proyectos,
    //         'total_bienes' => $proyectos_data->total_bienes,
    //         'total_servicios' => $proyectos_data->total_servicios,
    //         'total_obras' => $proyectos_data->total_obras
    //     ];
    // }

    // public function obtenerTotales($fechad, $fechah)
    // {
    //     // Convertir fechas al formato correcto
    //     $fechad = date('Y-m-d', strtotime($fechad));
    //     $fechah = date('Y-m-d', strtotime($fechah));

    //     // 1. Total de programaciones registradas
    //     $query1 = $this->db->query("
    //     SELECT COUNT(*) AS total_programacion
    //     FROM programacion.programacion
    //     WHERE fecha BETWEEN ? AND ?
    // ", [$fechad, $fechah]);
    //     $total_programacion = $query1->row()->total_programacion;

    //     // 2. Total de programaciones notificadas
    //     $query2 = $this->db->query("
    //     SELECT COUNT(DISTINCT id_programacion) AS total_notificadas
    //     FROM programacion.inf_enviada
    //     WHERE fecha BETWEEN ? AND ?
    // ", [$fechad, $fechah]);
    //     $total_notificadas = $query2->row()->total_notificadas;

    //     // 3. Totales de proyectos
    //     $query3 = $this->db->query("
    //     SELECT 
    //         COUNT(id_p_proyecto) AS total_proyectos,
    //         SUM(CASE WHEN id_obj_comercial = 1 THEN 1 ELSE 0 END) AS total_bienes_p,
    //         SUM(CASE WHEN id_obj_comercial = 2 THEN 1 ELSE 0 END) AS total_servicios_p,
    //         SUM(CASE WHEN id_obj_comercial = 3 THEN 1 ELSE 0 END) AS total_obras_p
    //     FROM programacion.p_proyecto
    //     WHERE fecha BETWEEN ? AND ?
    // ", [$fechad, $fechah]);
    //     $proyectos_data = $query3->row();

    //     // 4. Totales de acciones centralizadas (nueva consulta)
    //     $query4 = $this->db->query("
    //     SELECT 
    //         COUNT(id_p_acc_centralizada) AS total_acc,
    //         SUM(CASE WHEN id_obj_comercial = 1 THEN 1 ELSE 0 END) AS total_bienes_a,
    //         SUM(CASE WHEN id_obj_comercial = 2 THEN 1 ELSE 0 END) AS total_servicios_a,
    //         SUM(CASE WHEN id_obj_comercial = 3 THEN 1 ELSE 0 END) AS total_obras_a
    //     FROM programacion.p_acc_centralizada
    //     WHERE fecha BETWEEN ? AND ?
    // ", [$fechad, $fechah]);
    //     $acciones_data = $query4->row();

    //     return [
    //         'total_programacion' => $total_programacion,
    //         'total_notificadas' => $total_notificadas,
    //         'proyectos' => [
    //             'total' => $proyectos_data->total_proyectos,
    //             'bienes' => $proyectos_data->total_bienes_p,
    //             'servicios' => $proyectos_data->total_servicios_p,
    //             'obras' => $proyectos_data->total_obras_p
    //         ],
    //         'acciones' => [
    //             'total' => $acciones_data->total_acc,
    //             'bienes' => $acciones_data->total_bienes_a,
    //             'servicios' => $acciones_data->total_servicios_a,
    //             'obras' => $acciones_data->total_obras_a
    //         ]
    //     ];
    // }
    public function obtenerTotales($fechad, $fechah)
    {
        // Convertir fechas al formato correcto
        $fechad = date('Y-m-d', strtotime($fechad));
        $fechah = date('Y-m-d', strtotime($fechah));
        $anio_desde = date('Y', strtotime($fechad));
        $anio_hasta = date('Y', strtotime($fechah));
        $sql_extra = ($anio_desde == $anio_hasta) ? " AND anio = '" . $anio_desde . "'" : "";
        // 1. Total de programaciones registradas

        $query1 = $this->db->query("
            SELECT COUNT(*) AS total_programacion
            FROM programacion.programacion
            WHERE fecha BETWEEN ? AND ? $sql_extra
        ", [$fechad, $fechah]);
        $total_programacion = $query1->row()->total_programacion;
        ////total registros cargados
        $query10 = $this->db->query("
             SELECT 
                anio, 
                COUNT(*) as total_registros
            FROM programacion.programacion
            WHERE fecha BETWEEN ? AND ? AND anio > '1'
            GROUP BY anio
            ORDER BY anio
        ", [$fechad, $fechah]);
        $registros_por_anio = $query10->result_array();



        ////notificada
        $sql_notificadas = "SELECT COUNT(DISTINCT p.id_programacion) AS total_notificadas
                   FROM programacion.programacion p
                   INNER JOIN programacion.inf_enviada ie ON p.id_programacion = ie.id_programacion
                   WHERE p.fecha BETWEEN ? AND ?";

        // Agregar condición de año si ambos años son iguales
        if ($anio_desde == $anio_hasta) {
            $sql_notificadas .= " AND p.anio = ?";
            $query2 = $this->db->query($sql_notificadas, [$fechad, $fechah, $anio_desde]);
        } else {
            $query2 = $this->db->query($sql_notificadas, [$fechad, $fechah]);
        }

        $total_notificadas = $query2->row()->total_notificadas;


        //////rendida

        // // 3. Total de programaciones rendidas
        $query3 = "SELECT COUNT(DISTINCT p.id_programacion) AS total_rendida
                   FROM programacion.programacion p
                   INNER JOIN programacion.inf_enviada_rendi ie ON p.id_programacion = ie.id_programacion
                   WHERE p.fecha BETWEEN ? AND ?";

        if ($anio_desde == $anio_hasta) {
            $query3 .= " AND p.anio = ?";
            $query4 = $this->db->query($query3, [$fechad, $fechah, $anio_desde]);
        } else {
            $query4 = $this->db->query($query3, [$fechad, $fechah]);
        }
        $total_rendida = $query4->row()->total_rendida;
        //////
        // 3. Totales de proyectos
        $query3 = $this->db->query("
            SELECT
                COUNT(pp.id_p_proyecto) AS total_proyectos,
                SUM(CASE WHEN pp.id_obj_comercial = 1 THEN 1 ELSE 0 END) AS total_bienes_p,
                SUM(CASE WHEN pp.id_obj_comercial = 2 THEN 1 ELSE 0 END) AS total_servicios_p,
                SUM(CASE WHEN pp.id_obj_comercial = 3 THEN 1 ELSE 0 END) AS total_obras_p
            FROM programacion.p_proyecto pp
            WHERE pp.fecha BETWEEN ? AND ?
            AND EXISTS (
                SELECT 1 
                FROM programacion.inf_enviada ie 
                WHERE ie.id_programacion = pp.id_programacion
            )
        ", [$fechad, $fechah]);

        $proyectos_data = $query3->row();

        // 3. Totales de acc
        $query8 = $this->db->query("
            SELECT
                 COUNT(pp.id_p_acc_centralizada) AS total_acc,
                SUM(CASE WHEN pp.id_obj_comercial = 1 THEN 1 ELSE 0 END) AS total_bienes_a,
                SUM(CASE WHEN pp.id_obj_comercial = 2 THEN 1 ELSE 0 END) AS total_servicios_a,
                SUM(CASE WHEN pp.id_obj_comercial = 3 THEN 1 ELSE 0 END) AS total_obras_a
            FROM programacion.p_acc_centralizada pp
            WHERE pp.fecha BETWEEN ? AND ?
            AND EXISTS (
                SELECT 1 
                FROM programacion.inf_enviada ie 
                WHERE ie.id_programacion = pp.id_programacion
            )
        ", [$fechad, $fechah]);

        $acciones_data = $query8->row();

        // 5. Top 10 productos  programados
        $query5 = $this->db->query("
            SELECT
            pi.id_ccnu AS codigo_ccnu,
            COUNT(*) AS cantidad_utilizada,
            c.desc_ccnu AS descripcion_producto,
            SUM(
            CASE
            WHEN pi.precio_total ~ '^[0-9]+(\.[0-9]+)?$'
            THEN CAST(pi.precio_total AS DECIMAL(15,2))
            ELSE 0
            END
            ) AS monto_total
            FROM
            programacion.p_items pi
            JOIN
            programacion.programacion p ON pi.id_proyecto = p.id_programacion
            LEFT JOIN
            programacion.ccnu c ON pi.id_ccnu = c.codigo_ccnu
            WHERE
            p.fecha BETWEEN ? AND ?
            AND pi.id_obj_comercial != 3
            GROUP BY
            pi.id_ccnu, c.desc_ccnu
            ORDER BY
            cantidad_utilizada DESC
            LIMIT 10
            ", [$fechad, $fechah]);
        $top_productos = $query5->result_array();
        $queryComisiones = $this->db->query("
            SELECT COUNT(*) AS total_comision
            FROM comisiones.comision
            WHERE fecha_creacion BETWEEN ? AND ?
            AND snc = 2
            AND id_status = 1
        ", [$fechad, $fechah]);
        $total_comisiones = $queryComisiones->row()->total_comision;

        // Consulta para miembros certificados
        $queryMiembros = $this->db->query("
        SELECT COUNT(*) AS total_miembros
        FROM comisiones.miembros
        WHERE fecha_cambi_statu BETWEEN ? AND ?
        AND id_cert = '2'
        ", [$fechad, $fechah]);
        $total_miembros = $queryMiembros->row()->total_miembros;

        //         // 5. Top 10 productos  rendido
        //         $query9 = $this->db->query("
        //                     SELECT 
        //                     codigo_ccnu,
        //     desc_ccnu,
        //     COUNT(*) AS frecuencia,
        //     SUM(COALESCE(NULLIF(REGEXP_REPLACE(cantidad, '[.,]', '', 'g'), '')::NUMERIC, 0)) / 
        //         CASE WHEN COUNT(NULLIF(REGEXP_REPLACE(cantidad, '[.,]', '', 'g'), '')) > 0 
        //              THEN 100 ELSE 1 END AS total_cantidad,
        //     SUM(COALESCE(NULLIF(REGEXP_REPLACE(cantidad_ejecu, '[.,]', '', 'g'), '')::NUMERIC, 0)) / 
        //         CASE WHEN COUNT(NULLIF(REGEXP_REPLACE(cantidad_ejecu, '[.,]', '', 'g'), '')) > 0 
        //              THEN 100 ELSE 1 END AS total_cantidad_ejecutada,
        //     SUM(COALESCE(NULLIF(REGEXP_REPLACE(precio_total, '[.,]', '', 'g'), '')::NUMERIC, 0)) / 
        //         CASE WHEN COUNT(NULLIF(REGEXP_REPLACE(precio_total, '[.,]', '', 'g'), '')) > 0 
        //              THEN 100 ELSE 1 END AS total_precio
        // FROM 
        //     programacion.rendidicion              
        //                 WHERE
        //                 fecha_rendicion BETWEEN ? AND ?
        //                 AND id_obj_comercial != 3
        //                 GROUP BY
        //     codigo_ccnu, desc_ccnu
        // ORDER BY
        //     frecuencia DESC
        // LIMIT 10;
        //         ", [$fechad, $fechah]);
        //         $top_productosrendi = $query9->result_array();
        return [
            'total_programacion' => $total_programacion,
            'registros_por_anio' => $registros_por_anio,

            'total_notificadas' => $total_notificadas,
            'total_rendida' => $total_rendida,
            'proyectos' => [
                'total' => $proyectos_data->total_proyectos,
                'bienes' => $proyectos_data->total_bienes_p,
                'servicios' => $proyectos_data->total_servicios_p,
                'obras' => $proyectos_data->total_obras_p
            ],

            'acciones' => [
                'total' => $acciones_data->total_acc,
                'bienes' => $acciones_data->total_bienes_a,
                'servicios' => $acciones_data->total_servicios_a,
                'obras' => $acciones_data->total_obras_a
            ],

            'top_productos' => $top_productos,
            'comisiones' => [
                'total_comisiones' => $total_comisiones,
                'total_miembros' => $total_miembros
            ],
            //'top_productosrendi' => $top_productosrendi,


        ];
    }
}
