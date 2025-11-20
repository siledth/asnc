<?php
class Rnc_model extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        // Este metodo conecta a nuestra segunda conexión
        // y asigna a nuestra propiedad $this->db_b_b; los recursos de la misma.
        $this->db_b = $this->load->database('SNCenlinea', true);
    }


    // public function read_sending_pay()
    // {
    //     $this->db->select('p.id_pago, p.id_contratista, p.proceso_id, p.statusid, 
    //     p.currency, p.amount, p.title, p.description, p.letter, p.numberc, 
    //     p.transactionid, p.paymentmethoddescription, p.authorizationcode, 
    //     p.paymentmethodnumber, p.paymentdate, p.pan, c.rifced, c.nombre');
    //     $this->db->join('rnc.contratista c', 'c.id_contratista = p.id_contratista');
    //     $query = $this->db->get('rnc.pay p');
    //     return $query->result_array();
    // }

    // public function read_sending_audit()
    // {
    //     $this->db->select(' p.id_procesos, p.contratista_id, p.user_id, p.codedoproccola, p.codedoproc, p.tipproc,
    //      p.date_create, c.rifced, c.nombre, ed.descedoproc, r.descrealizando,
    //      a.authorizationcode, a.amount, a.transactionid ');
    //     $this->db->where("p.codedoproccola", "ER");

    //     $this->db->join('rnc.contratista c', 'c.id_contratista = p.contratista_id');
    //     $this->db->join('rnc.edoproccolas ed', 'ed.codedoproccola = p.codedoproccola');
    //     $this->db->join('rnc.realizando r', 'r.id_realizando = p.tipproc');
    //     $this->db->join('rnc.pay  a', 'a.id_contratista = p.contratista_id');
    //     $query = $this->db->get('rnc.procesos p');
    //     return $query->result_array();
    // }


    // Nueva función para el reporte de Pagos
    // public function get_reporte_pagos($filtros)
    // {
    //     $this->db_b->select("
    //     p.proceso_id AS id,
    //     p.amount,
    //     p.transactionid,
    //     p.paymentdate,
    //     c.rifced AS rif_contratista,
    //     c.nombre AS nombre_contratista,

    //     -- Lógica para obtener el Tipo de Transacción
    //     CASE 
    //         WHEN p.id_tptrans = '1' THEN 'Botón de Pago'
    //         WHEN p.id_tptrans = '2' THEN 'Transferencia'
    //         WHEN p.id_tptrans = '3' THEN 'Pago Móvil'
    //         ELSE 'Transferencia multiple'
    //     END AS tipo_transaccion,

    //     -- Lógica CONDICIONAL para el Método de Pago
    //     CASE 
    //         WHEN p.id_tptrans NOT IN ('1', '2', '3') THEN 
    //             CONCAT(p.paymentmethoddescription, ' / Monto de Transferencias: ', p.paymentmethodnumber)
    //         ELSE 
    //             p.paymentmethoddescription
    //     END AS metodo_pago
    // ");
    //     $this->db_b->from('public.pay p');
    //     $this->db_b->join('public.contratistas c', 'c.id = p.id_contratista', 'inner');

    //     // Construir la cláusula WHERE dinámicamente

    //     if (!empty($filtros['fecha_desde']) && !empty($filtros['fecha_hasta'])) {
    //         $this->db_b->where("p.paymentdate BETWEEN '{$filtros['fecha_desde']} 00:00:00' AND '{$filtros['fecha_hasta']} 23:59:59'");
    //     }

    //     if (!empty($filtros['rif_contratista'])) {
    //         $this->db_b->like('c.rifced', $filtros['rif_contratista']);
    //     }

    //     if (!empty($filtros['nombre_contratista'])) {
    //         $this->db_b->like('c.nombre', $filtros['nombre_contratista']);
    //     }

    //     if (!empty($filtros['transactionid'])) {
    //         $this->db_b->like('p.transactionid', $filtros['transactionid']);
    //     }

    //     if (!empty($filtros['proceso_id'])) {
    //         $this->db_b->where('p.proceso_id', $filtros['proceso_id']);
    //     }

    //     if (!empty($filtros['id_tptrans'])) {
    //         $this->db_b->where('p.id_tptrans', $filtros['id_tptrans']);
    //     }

    //     $query = $this->db_b->get();
    //     return $query->result_array();
    // }
    public function get_reporte_pagos($filtros)
    {
        // Usamos SELECT * para obtener todas las columnas de la vista
        $this->db_b->select('*');
        $this->db_b->from('public.repr_pagos_rnc_view'); // APUNTAMOS A LA VISTA

        // Construir la cláusula WHERE dinámicamente

        // Manejo de Fechas (TIMESTAMP Seguro)
        if (!empty($filtros['fecha_desde']) && !empty($filtros['fecha_hasta'])) {
            $fecha_hasta_fin_dia = date('Y-m-d', strtotime($filtros['fecha_hasta'] . ' +1 day'));
            $this->db_b->where("fecha_registro >= '{$filtros['fecha_desde']}' AND fecha_registro < '{$fecha_hasta_fin_dia}'");
        }

        if (!empty($filtros['rif_contratista'])) {
            $this->db_b->like('rif_contratista', $filtros['rif_contratista']);
        }

        if (!empty($filtros['nombre_contratista'])) {
            $this->db_b->like('nombre_contratista', $filtros['nombre_contratista']);
        }

        if (!empty($filtros['transactionid'])) {
            $this->db_b->like('transactionid', $filtros['transactionid']);
        }

        if (!empty($filtros['proceso_id'])) {
            $this->db_b->where('id', $filtros['proceso_id']);
        }

        // SIMPLIFICACIÓN CLAVE: Filtrar por el ID mapeado al nombre de la transacción
        if (!empty($filtros['id_tptrans'])) {
            $tipo_trans = '';
            switch ($filtros['id_tptrans']) {
                case '1':
                    $tipo_trans = 'Botón de Pago';
                    break;
                case '2':
                    $tipo_trans = 'Transferencia';
                    break;
                case '3':
                    $tipo_trans = 'Pago Móvil';
                    break;
                default:
                    break; // No aplica filtro si es otro valor
            }
            if (!empty($tipo_trans)) {
                $this->db_b->where('tipo_transaccion', $tipo_trans);
            }
        }

        $this->db_b->order_by('fecha_registro', 'DESC');

        $query = $this->db_b->get();
        return $query->result_array();
    }
}
