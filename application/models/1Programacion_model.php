<?php
    class Programacion_model extends CI_model{

        // PROGRAMACION
        public function consultar_programaciones($unidad){
            $this->db->select('*');
            $this->db->where('unidad', $unidad);
            $query = $this->db->get('programacion.programacion');
            return $query->result_array();
        }

        //----Registrar año de programación--
        public function agg_programacion_anio($data){
            $quers =$this->db->insert('programacion.programacion',$data);
            return true;
        }

        public function consultar_prog_anio($id_programacion, $unidad){
            $this->db->select('*');
            $this->db->where('unidad', $unidad);
            $this->db->where('id_programacion', $id_programacion);
            $query = $this->db->get('programacion.programacion');
            return $query->row_array();
        }
     

        //Consulta los proyectos por separado de cada programación
        public function consultar_proyectos($id_programacion){
            $this->db->select('pp.id_p_proyecto,
                               pp.nombre_proyecto,
                        	   pp.id_programacion,
                        	   pp.id_obj_comercial,
                               p.estatus,
                        	   oc.desc_objeto_contrata');
            $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
            $this->db->join('programacion.programacion p', 'p.id_programacion = pp.id_programacion');
            $this->db->where('pp.id_programacion', $id_programacion);
            $query = $this->db->get('programacion.p_proyecto pp');
            return $query->result_array();
        }

        public function consultar_proyectos_compl($id_programacion, $id_unidad){
            $this->db->select('pp.id_p_proyecto,
	                           pp.nombre_proyecto,
	                           oc.desc_objeto_contrata ');
            $this->db->join('programacion.p_proyecto pp', 'pp.id_programacion = p.id_programacion');
            $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
            $this->db->where('p.id_programacion', $id_programacion);
            $query = $this->db->get('programacion..programacion p');
            return $query->result_array();

        }

        public function llenar_ff($proyectos){
            foreach ($proyectos as $key){
                $this->db->select('*');
                $this->db->where('id_enlace', $key['id_p_proyecto']);
                $this->db->from('programacion.p_items');
                $result = $this->db->get();
            }
            return $result->result_array();
        }
        //------------------------------------------------------
        // CONSULTAS GENERALES
        public function consulta_part_pres(){
            $this->db->select('*');
            $query = $this->db->get('programacion.partida_presupuestaria');
            return $result = $query->result_array();
        }

        public function consulta_fuente(){
            $this->db->select('*');
            $this->db->order_by('id_fuente_financiamiento ASC');
            $query = $this->db->get('programacion.fuente_financiamiento');
            return $result = $query->result_array();
        }

        public function consulta_act_com(){
            $this->db->select('*');
            $this->db->where('id_objeto_contrata !=', 1);
            $query = $this->db->get('programacion.objeto_contrata');
            return $result = $query->result_array();
        }

        public function consulta_cnnu(){
            $this->db->select('*');
            // $this->db->limit(10);
            $query = $this->db->get('programacion.ccnu');
            return $result = $query->result_array();
        }

        public function consulta_unid(){
            $this->db->select('*');
            $query = $this->db->get('programacion.unidad_medida');
            return $result = $query->result_array();
        }

        public function consulta_iva(){
            $this->db->select('*');
            $query = $this->db->get('programacion.alicuota_iva');
            return $result = $query->result_array();
        }

        public function consulta_tip_obra(){
            $this->db->select('id_tip_obra, descripcion_tip_obr');
            $query = $this->db->get('programacion.tip_obra');
            return $result = $query->result_array();
        }

        public function consulta_alcance_obra(){
            $this->db->select('*');
            $query = $this->db->get('programacion.alcance_obra');
            return $result = $query->result_array();
        }

        public function consulta_obj_obra(){
            $this->db->select('id_obj_obra, descripcion_obj_obra');
            $query = $this->db->get('programacion.obj_obra');
            return $result = $query->result_array();
        }
        //------------------------------------------------------
        // REGISTRAR SERVICIO
        public function save_servicio($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento){
            if ($acc_cargar == '1') {
               
                $this->db->select('max(e.id_p_items) as id1');
                $query1 = $this->db->get('programacion.p_items e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ;

                $quers =$this->db->insert('programacion.p_proyecto',$p_proyecto);
                if ($quers) {
                    $id = $this->db->insert_id();
                    $cant_proy = $p_items['id_ccnu'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_p_items'                  => $id1,
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 0,//proyecto
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => $p_items['id_ccnu'][$i],
                            'id_tip_obra'                => $p_items['id_tip_obra'],
                            'id_alcance_obra'            => $p_items['id_alcance_obra'],
                            'id_obj_obra'                => $p_items['id_obj_obra'],
                            'fecha_desde'                => $p_items['fecha_desde'][$i],
                            'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => 0,
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'costo_unitario'             => 0,
                            'cant_total_distribuir'      => 0,
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                            'est_trim_1' 		 => $p_items['est_trim_1'][$i],
                            'est_trim_2' 		 => $p_items['est_trim_2'][$i],
                            'est_trim_3' 		=> $p_items['est_trim_3'][$i],
                            'est_trim_4' 		 => $p_items['est_trim_4'][$i],
                            'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                            'estatus_rendi' => $p_items['estatus_rendi'],
                            
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }
                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {

                        $data2 = array(
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 0,//proyecto
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'descripcion_ff'             => $p_ffinanciamiento['descripcion_ff'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                            'id_p_items'                  => $id1,
                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
                }
                return true;
            }elseif ($acc_cargar == '2') {
                $this->db->select('max(e.id_p_items) as id1');
                $query1 = $this->db->get('programacion.p_items e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ;
                $quers =$this->db->insert('programacion.p_acc_centralizada',$p_acc_centralizada);
                if ($quers) {
                    $id = $this->db->insert_id();
                    $cant_proy = $p_items['id_ccnu'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_p_items'                  => $id1,
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 1,//accion centralizada
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => $p_items['id_ccnu'][$i],
                            'id_tip_obra'                => $p_items['id_tip_obra'],
                            'id_alcance_obra'            => $p_items['id_alcance_obra'],
                            'id_obj_obra'                => $p_items['id_obj_obra'],
                            'fecha_desde'                => $p_items['fecha_desde'][$i],
                            'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => 0,
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'cant_total_distribuir'      => 0,
                            'costo_unitario'             => 0,
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                            'est_trim_1' 		 => $p_items['est_trim_1'][$i],
                            'est_trim_2' 		 => $p_items['est_trim_2'][$i],
                            'est_trim_3' 		=> $p_items['est_trim_3'][$i],
                            'est_trim_4' 		 => $p_items['est_trim_4'][$i],
                            'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                            'estatus_rendi' => $p_items['estatus_rendi'],
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }

                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {
                     
                        $data2 = array(
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 1,//acc
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'descripcion_ff'             => $p_ffinanciamiento['descripcion_ff'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                            'id_p_items'                  => $id1,
                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
                }
                return true;
            }
        }
        //------------------------------------------------------
        //REGISTRAR BIENES
        public function save_bienes($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento){
            if ($acc_cargar == '1') {
                $this->db->select('max(e.id_p_items) as id1');
                $query1 = $this->db->get('programacion.p_items e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ;
                $quers =$this->db->insert('programacion.p_proyecto',$p_proyecto);
                if ($quers) {
                    $id = $this->db->insert_id();
                    $cant_proy = $p_items['id_ccnu'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_p_items'                  => $id1,
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 0,//proyecto
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => $p_items['id_ccnu'][$i],
                            'id_tip_obra'                => $p_items['id_tip_obra'],
                            'id_alcance_obra'            => $p_items['id_alcance_obra'],
                            'id_obj_obra'                => $p_items['id_obj_obra'],
                            'fecha_desde'                => $p_items['fecha_desde'],
                            'fecha_hasta'                => $p_items['fecha_hasta'],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => $p_items['cantidad'][$i],
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'cant_total_distribuir'      => $p_items['cant_total_distribuir'][$i],
                            'costo_unitario'             => $p_items['costo_unitario'][$i],
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                            'est_trim_1' 		 => $p_items['est_trim_1'][$i],
                            'est_trim_2' 		 => $p_items['est_trim_2'][$i],
                            'est_trim_3' 		=> $p_items['est_trim_3'][$i],
                            'est_trim_4' 		 => $p_items['est_trim_4'][$i],
                            'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                            'estatus_rendi' => $p_items['estatus_rendi'],
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }

                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {
                        $data2 = array(
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 0,//proyecto
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                            'id_p_items'                  => $id1,

                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
                }
                return true;
            }elseif ($acc_cargar == '2') {
                $this->db->select('max(e.id_p_items) as id1');
                $query1 = $this->db->get('programacion.p_items e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ;
                $quers =$this->db->insert('programacion.p_acc_centralizada',$p_acc_centralizada);
                if ($quers) {
                    $id = $this->db->insert_id();
                    $cant_proy = $p_items['id_ccnu'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_p_items'                  => $id1,
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 1,//acc
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => $p_items['id_ccnu'][$i],
                            'id_tip_obra'                => $p_items['id_tip_obra'],
                            'id_alcance_obra'            => $p_items['id_alcance_obra'],
                            'id_obj_obra'                => $p_items['id_obj_obra'],
                            'fecha_desde'                => $p_items['fecha_desde'],
                            'fecha_hasta'                => $p_items['fecha_hasta'],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => $p_items['cantidad'][$i],
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'cant_total_distribuir'      => $p_items['cant_total_distribuir'][$i],
                            'costo_unitario'             => $p_items['costo_unitario'][$i],
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                            'est_trim_1' 		 => $p_items['est_trim_1'][$i],
                            'est_trim_2' 		 => $p_items['est_trim_2'][$i],
                            'est_trim_3' 		=> $p_items['est_trim_3'][$i],
                            'est_trim_4' 		 => $p_items['est_trim_4'][$i],
                            'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                            'estatus_rendi' => $p_items['estatus_rendi'],
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }

                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);
                   
                    for ($i=0; $i < $count_pff; $i++) {

                        $data2 = array(
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 1,//acc
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                            'id_p_items'                  => $id1,
                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
                }
                return true;
            }
        }
        //------------------------------------------------------
        //REGISTRAR OBRAS
        public function save_obra($acc_cargar,$p_proyecto,$p_acc_centralizada,$p_items,$p_ffinanciamiento){

            if ($acc_cargar == '1'){
                $this->db->select('max(e.id_p_items) as id1');
                $query1 = $this->db->get('programacion.p_items e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ;
                
                $quers =$this->db->insert('programacion.p_proyecto',$p_proyecto);
                if ($quers) {
                    $id = $this->db->insert_id();
                    $cant_proy = $p_items['id_par_presupuestaria'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_p_items'                  => $id1,
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 0,//proyecto
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => 0,
                            'id_tip_obra'                => $p_items['id_tip_obra'][$i],
                            'id_alcance_obra'            => $p_items['id_alcance_obra'][$i],
                            'id_obj_obra'                => $p_items['id_obj_obra'][$i],
                            'fecha_desde'                => $p_items['fecha_desde'][$i],
                            'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => 0,
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'costo_unitario'             => 0,
                            'cant_total_distribuir'      => 0,
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                            'est_trim_1' 		 => $p_items['est_trim_1'][$i],
                            'est_trim_2' 		 => $p_items['est_trim_2'][$i],
                            'est_trim_3' 		=> $p_items['est_trim_3'][$i],
                            'est_trim_4' 		 => $p_items['est_trim_4'][$i],
                            'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                            'estatus_rendi' => $p_items['estatus_rendi'],
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }
                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {

                        $data2 = array(
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 0,//proyecto
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'descripcion_ff'             => $p_ffinanciamiento['descripcion_ff'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                            'id_p_items'                  => $id1,

                        );

                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
                }
                return true;
            }elseif ($acc_cargar == '2') {
                $this->db->select('max(e.id_p_items) as id1');
                $query1 = $this->db->get('programacion.p_items e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ;
                $quers =$this->db->insert('programacion.p_acc_centralizada',$p_acc_centralizada);
                if ($quers) {
                    $id = $this->db->insert_id();
                    $cant_proy = $p_items['id_par_presupuestaria'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_p_items'                  => $id1,
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 1,//acc
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => 0,
                            'id_tip_obra'                => $p_items['id_tip_obra'][$i],
                            'id_alcance_obra'            => $p_items['id_alcance_obra'][$i],
                            'id_obj_obra'                => $p_items['id_obj_obra'][$i],
                            'fecha_desde'                => $p_items['fecha_desde'][$i],
                            'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => 0,
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'cant_total_distribuir'      => 0,
                            'costo_unitario'             => 0,
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                            'est_trim_1' 		 => $p_items['est_trim_1'][$i],
                            'est_trim_2' 		 => $p_items['est_trim_2'][$i],
                            'est_trim_3' 		=> $p_items['est_trim_3'][$i],
                            'est_trim_4' 		 => $p_items['est_trim_4'][$i],
                            'estimado_total_t_acc' => $p_items['estimado_total_t_acc'][$i],
                            'estatus_rendi' => $p_items['estatus_rendi'],
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }
                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);


                    for ($i=0; $i < $count_pff; $i++) {
                        $data2 = array(
                            'id_enlace'                  => $id,
                            'id_p_acc'                   => 1,//acc
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'descripcion_ff'             => $p_ffinanciamiento['descripcion_ff'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                            'id_p_items'                  => $id1,

                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
                }
                return true;
            }
        }

        //------------------------------------------------------
        // INVESTIGAR
        public function inf_1($id_p_proyecto){
            $this->db->select('pp.id_p_proyecto,
                               pp.nombre_proyecto,
                        	   pp.id_programacion,
                        	   pp.id_obj_comercial,
                        	   oc.desc_objeto_contrata');
            $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
            $this->db->where('pp.id_p_proyecto', $id_p_proyecto);
            $query = $this->db->get('programacion.p_proyecto pp');
            return $query->result_array();
        }

        public function inf_2($id_p_proyecto){
            $this->db->select('pf.id_enlace,
                        	   pf.id_partidad_presupuestaria,
                        	   pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pf.id_estado,
                        	   pf.id_fuente_financiamiento,
                        	   ff.desc_fuente_financiamiento,
                        	   pf.porcentaje ');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
            $this->db->join('programacion.fuente_financiamiento ff','ff.id_fuente_financiamiento = pf.id_fuente_financiamiento');
            $this->db->where('pf.id_enlace', $id_p_proyecto);
            $this->db->where('pf.id_p_acc', 0);
            $query = $this->db->get('programacion.p_ffinanciamiento pf');
            return $query->result_array();
        }

        public function inf_2_edit($data){
            $this->db->select('pf.id_enlace,
                        	   pf.id_partidad_presupuestaria,
                        	   pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pf.id_estado,
                        	   pf.id_fuente_financiamiento,
                        	   ff.desc_fuente_financiamiento,
                        	   pf.porcentaje ');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
            $this->db->join('programacion.fuente_financiamiento ff','ff.id_fuente_financiamiento = pf.id_fuente_financiamiento');
            $this->db->where('pf.id_enlace', $data['id_p_proyecto']);
            $this->db->where('pf.id_p_acc', 0);
            $query = $this->db->get('programacion.p_ffinanciamiento pf');
            return $query->result_array();
        }

        public function inf_3($id_p_proyecto){
            $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.id_tip_obra,
                               to2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               ao.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               oo.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu', 'left');
            $this->db->join('programacion.tip_obra to2','to2.id_tip_obra = pi2.id_tip_obra', 'left');
            $this->db->join('programacion.alcance_obra ao','ao.id_alcance_obra = pi2.id_alcance_obra', 'left');
            $this->db->join('programacion.obj_obra oo','oo.id_obj_obra = pi2.id_obj_obra', 'left');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $id_p_proyecto);
            $this->db->where('pi2.id_p_acc', 0);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->result_array();
        }

        public function inf_3_edit($data){
            $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                        	   pi2.fecha_desde,
                        	   pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $data['id_p_proyecto']);
            $this->db->where('pi2.id_p_acc', 0);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->result_array();
        }

        public function inf_3_b($data){
            $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                        	   pi2.fecha_desde,
                        	   pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.cant_total_distribuir,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $data['id_p_proyecto']);
            $this->db->where('pi2.id_p_acc', 0);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->result_array();
        }

		public function inf_3_o($id_p_proyecto){
            $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_tip_obra,
                               to2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               ao.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               oo.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu', 'left');
            $this->db->join('programacion.tip_obra to2','to2.id_tip_obra = pi2.id_tip_obra', 'left');
            $this->db->join('programacion.alcance_obra ao','ao.id_alcance_obra = pi2.id_alcance_obra', 'left');
            $this->db->join('programacion.obj_obra oo','oo.id_obj_obra = pi2.id_obj_obra', 'left');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $id_p_proyecto['id_p_proyecto']);
            $this->db->where('pi2.id_p_acc', 0);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->result_array();
        }

        public function editar_programacion_proy($id_p_proyecto, $id_programacion, $p_proyecto,$p_items,$p_ffinanciamiento){

            $this->db->where('id_programacion', $id_programacion);
            $this->db->where('id_p_proyecto', $id_p_proyecto);
            $update = $this->db->update('programacion.p_proyecto', $p_proyecto);

            if ($update){
                $this->db->where('id_enlace', $id_p_proyecto);
                $this->db->where('id_p_acc', 0);
                $this->db->delete('programacion.p_items');

                    $cant_proy = $p_items['id_ccnu'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_enlace'                  => $id_p_proyecto,
                            'id_p_acc'                   => 0,
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => $p_items['id_ccnu'][$i],
                            'id_tip_obra'                => 0,
                            'id_alcance_obra'            => 0,
                            'id_obj_obra'                => 0,
                            'fecha_desde'                => $p_items['fecha_desde'][$i],
                            'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => 0,
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'cant_total_distribuir'      => 0,
                            'costo_unitario'             => 0,
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'               => $p_items['monto_estimado'][$i],
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }

                    $this->db->where('id_enlace', $id_p_proyecto);
                    $this->db->where('id_p_acc', 0);
                    $this->db->delete('programacion.p_ffinanciamiento');

                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {

                        $data2 = array(
                            'id_enlace'                  => $id_p_proyecto,
                            'id_p_acc'                   => 0,
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
            }
            return true;
        }

        public function editar_programacion_proy_b($id_p_proyecto, $id_programacion, $p_proyecto,$p_items,$p_ffinanciamiento){
            $this->db->where('id_programacion', $id_programacion);
            $this->db->where('id_p_proyecto', $id_p_proyecto);
            $update = $this->db->update('programacion.p_proyecto', $p_proyecto);

            if ($update) {
                $this->db->where('id_enlace', $id_p_proyecto);
                $this->db->where('id_p_acc', 0);
                $this->db->delete('programacion.p_items');
                    $cant_proy = $p_items['id_ccnu'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_enlace'                  => $id_p_proyecto,
                            'id_p_acc'                   => 0,
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => $p_items['id_ccnu'][$i],
                            'id_tip_obra'                => 0,
                            'id_alcance_obra'            => 0,
                            'id_obj_obra'                => 0,
                            'fecha_desde'                => $p_items['fecha_desde'],
                            'fecha_hasta'                => $p_items['fecha_hasta'],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => $p_items['cantidad'][$i],
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'cant_total_distribuir'      => $p_items['cant_total_distribuir'][$i],
                            'costo_unitario'             => $p_items['costo_unitario'][$i],
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                        );
                        $this->db->insert('programacion.p_items', $data1);
                    }
                    $this->db->where('id_enlace', $id_p_proyecto);
                    $this->db->where('id_p_acc', 0);
                    $this->db->delete('programacion.p_ffinanciamiento');
                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {

                        $data2 = array(
                            'id_enlace'                  => $id_p_proyecto,
                            'id_p_acc'                   => 0,
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
            }
            return true;
        }

		public function editar_programacion_proy_o($id_p_proyecto, $id_programacion, $p_proyecto, $p_items, $p_ffinanciamiento){

            $this->db->where('id_programacion', $id_programacion);
            $this->db->where('id_p_proyecto', $id_p_proyecto);
            $update = $this->db->update('programacion.p_proyecto', $p_proyecto);

            if ($update){
                $this->db->where('id_enlace', $id_p_proyecto);
                $this->db->where('id_p_acc', 0);
                $this->db->delete('programacion.p_items');

				
                    $cant_proy = $p_items['id_tip_obra'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data_inf = array(
                            'id_enlace'                  => $id_p_proyecto,
                            'id_p_acc'                   => 0,
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
							'id_ccnu'                    => 0,
                            'id_tip_obra'                => $p_items['id_tip_obra'][$i],
                            'id_alcance_obra'            => $p_items['id_alcance_obra'][$i],
                            'id_obj_obra'                => $p_items['id_obj_obra'][$i],
                            'fecha_desde'                => $p_items['fecha_desde'][$i],
                            'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => 0,
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'cant_total_distribuir'      => 0,
                            'costo_unitario'             => 0,
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                        );
                        $this->db->insert('programacion.p_items',$data_inf);
                    }

                    $this->db->where('id_enlace', $id_p_proyecto);
                    $this->db->where('id_p_acc', 0);
                    $this->db->delete('programacion.p_ffinanciamiento');

                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {

                        $data2 = array(
                            'id_enlace'                  => $id_p_proyecto,
                            'id_p_acc'                   => 0,
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
            }
            return true;
        }

        public function cons_items_proy($data){
            $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                        	   pi2.fecha_desde,
                        	   pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.cant_total_distribuir,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_p_items', $data['id_items_proy']);
            $this->db->where('pi2.id_p_acc', 0);
            $query = $this->db->get('programacion.p_items pi2');
			
            return $query->row_array();
        }

		public function cons_items_proy_o($data){
            $this->db->select('pi2.id_p_items,
								pi2.id_enlace,
								pi2.id_partidad_presupuestaria,
								pp.desc_partida_presupuestaria,
								pp.codigopartida_presupuestaria,
								pi2.id_tip_obra,
								to2.descripcion_tip_obr,
								pi2.id_alcance_obra,
								ao.descripcion_alcance_obra,
								pi2.id_obj_obra,
								oo.descripcion_obj_obra,
								pi2.fecha_desde,
								pi2.fecha_hasta,
								pi2.especificacion,
								pi2.id_unidad_medida,
								um.desc_unidad_medida,
								pi2.i,
								pi2.ii,
								pi2.iii,
								pi2.iv,
								pi2.precio_total,
								pi2.alicuota_iva,
								pi2.iva_estimado,
								pi2.monto_estimado');
				$this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu', 'left');
				$this->db->join('programacion.tip_obra to2','to2.id_tip_obra = pi2.id_tip_obra', 'left');
				$this->db->join('programacion.alcance_obra ao','ao.id_alcance_obra = pi2.id_alcance_obra', 'left');
				$this->db->join('programacion.obj_obra oo','oo.id_obj_obra = pi2.id_obj_obra', 'left');
				$this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
				$this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_p_items', $data['id_items_proy']);
            $this->db->where('pi2.id_p_acc', 0);
            $query = $this->db->get('programacion.p_items pi2');
			
            return $query->row_array();
        }


        public function llenar_par_pre_mod($data){
            $this->db->select('*');
            $this->db->where('codigopartida_presupuestaria !=', $data['cod_partida_pre']);
            $query = $this->db->get('programacion.partida_presupuestaria');
            return $query->result_array();
        }

        public function llenar_uni_med_mod($data){
            $this->db->select('*');
            $this->db->where('pi2.id_unidad_medida !=', $data['id_unid_med']);
            $query = $this->db->get('programacion.unidad_medida pi2');
            return $query->result_array();
        }
        public function llenar_modalidad($data){
            $this->db->select('*');
            // $this->db->where('pi2.id !=', $data['id']);
            $query = $this->db->get('evaluacion_desempenio.modalidad');
            return $query->result_array();
        }
        public function llenar_tipo_doc_contrata($data){
            $this->db->select('id_tipo_doc_contrata,desc_tipo_doc_contrata');
            // $this->db->where('pi2.id !=', $data['id']);
            $query = $this->db->get('programacion.tipo_doc_contrata');
            return $query->result_array();
        }
        public function llenar_comp_resp_social($data){
            $this->db->select('id_comp_resp_social,desc_comp_resp_social');
            // $this->db->where('pi2.id !=', $data['id']);
            $query = $this->db->get('programacion.comp_resp_social');
            return $query->result_array();
        }
        public function llenar_trimestre($data){
            $this->db->select('id_trimestre, descripcion_trimestre');
            // $this->db->where('pi2.id !=', $data['id']);
            $query = $this->db->get('programacion.trimestre');
            return $query->result_array();
        }

        public function llenar_alic_iva_mod(){
            $this->db->select('*');
            $query = $this->db->get('programacion.alicuota_iva');
            return $query->result_array();
        }

        public function llenar_selc_ccnu_m($data){
            $this->db->select('*');
            $this->db->like('desc_ccnu', $data['ccnu_b_m']);
            $query = $this->db->get('programacion.ccnu');
            return $query->result_array();
        }

		public function llenar_alic_tip_obra($data){
            $this->db->select('*');
			$this->db->where('id_tip_obra !=', $data['id_tipo_obra_m']);
            $query = $this->db->get('programacion.tip_obra');
            return $result = $query->result_array();
        }

		public function llenar_alic_alc_obra($data){
            $this->db->select('*');
			$this->db->where('id_alcance_obra !=', $data['alcance_obra_m']);
            $query = $this->db->get('programacion.alcance_obra');
            return $result = $query->result_array();
        }

		public function llenar_alic_obj_obra($data){
            $this->db->select('*');
			$this->db->where('id_obj_obra !=', $data['objeto_obra_m']);
            $query = $this->db->get('programacion.obj_obra');
            return $result = $query->result_array();
        }

        public function editar_fila_ip($data){

            $this->db->where('id_p_items', $data['id_items_proy']);

            $pp_s = $data['selc_part_pres'];
            if ($pp_s == 0) {
                $id_partidad_presupuestaria = $data['partida_pre'];
            }else {
                $id_partidad_presupuestaria = $data['selc_part_pres'];
            }

            $ccnu_s = $data['sel_ccnu'];
            if ($ccnu_s == 0) {
                $id_ccnu = $data['ccnu'];
            }else {
                $id_ccnu = $data['sel_ccnu'];
            }

            $unid_m_s = $data['sel_camb_unid_medi'];
            if ($unid_m_s == 0) {
                $id_unidad_medida = $data['unid_med'];
            }else {
                $id_unidad_medida = $data['sel_camb_unid_medi'];
            }

            $id_ali_iva = $data['sel_id_alic_iva'];
            if ($id_ali_iva == 0) {
                $alicuota_iva = $data['ali_iva_e'];
            }else {
                $alicuota_iva = $data['sel_id_alic_iva'];
            }

            $data1 = array(
                'id_partidad_presupuestaria' => $id_partidad_presupuestaria,
                'id_ccnu'                    => $id_ccnu,
                'fecha_desde'                => $data['fecha_desde_e'],
                'fecha_hasta'                => $data['fecha_hasta_e'],
                'especificacion'             => $data['esp'],
                'id_unidad_medida'           => $id_unidad_medida,
                'i'                          => $data['primero'],
                'ii'                         => $data['segundo'],
                'iii'                        => $data['tercero'],
                'iv'                         => $data['cuarto'],
                'precio_total'               => $data['prec_t'],
                'alicuota_iva'               => $alicuota_iva,
                'iva_estimado'               => $data['monto_iva_e'],
                'monto_estimado'             => $data['monto_tot_est'],
            );
            $update = $this->db->update('programacion.p_items', $data1);
            return true;
        }
        // ACCION CENTRALIZADA

        public function consultar_acc_centralizada($id_programacion){
            $this->db->select('pac.id_p_acc_centralizada,
                        	   pac.id_programacion,
                        	   pac.id_accion_centralizada,
                               p.estatus,
                        	   ac.desc_accion_centralizada,
                        	   pac.id_obj_comercial,
                        	   oc.desc_objeto_contrata');
            $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
            $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
            $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
            $this->db->where('pac.id_programacion', $id_programacion);
            $query = $this->db->get('programacion.p_acc_centralizada pac');
            return $query->result_array();
        }

        public function consulta_act_com2(){
            $this->db->select('*');
            $this->db->where('id_objeto_contrata', 1);
            $query = $this->db->get('programacion.objeto_contrata');
            return $result = $query->result_array();
        }

        public function accion_centralizada(){
            $this->db->select('*');
            $query = $this->db->get('programacion.accion_centralizada');
            return $result = $query->result_array();
        }

        public function eliminar_proy($data){
            $this->db->where('id_p_proyecto', $data['id_items_proy']);
            $query = $this->db->delete('programacion.p_proyecto');

            if ($query) {
                $this->db->where('id_enlace', $data['id_items_proy']);
                $this->db->where('id_p_acc', 0);
                $query = $this->db->delete('programacion.p_items');

                $this->db->where('id_enlace', $data['id_items_proy']);
                $this->db->where('id_p_acc', 0);
                $query = $this->db->delete('programacion.p_ffinanciamiento');
            }
           return true;
        }

        public function inf_1_acc($id_p_acc_centralizada){
            $this->db->select('pac.id_p_acc_centralizada,
                        	   pac.id_programacion,
                        	   pac.id_accion_centralizada,
                        	   ac.desc_accion_centralizada,
                        	   pac.id_obj_comercial,
                        	   oc.desc_objeto_contrata ');
            $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
            $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
            $this->db->where('pac.id_p_acc_centralizada', $id_p_acc_centralizada);
            $query = $this->db->get('programacion.p_acc_centralizada pac ');
            return $query->result_array();
        }

        public function inf_2_acc_pdf($id_p_acc_centralizada){
            $this->db->select('pf.id_enlace,
                        	   pf.id_partidad_presupuestaria,
                        	   pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pf.id_estado,
                        	   pf.id_fuente_financiamiento,
                        	   ff.desc_fuente_financiamiento,
                        	   pf.porcentaje ');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
            $this->db->join('programacion.fuente_financiamiento ff','ff.id_fuente_financiamiento = pf.id_fuente_financiamiento');
            $this->db->where('pf.id_enlace', $id_p_acc_centralizada);
            $this->db->where('pf.id_p_acc', 1);
            $query = $this->db->get('programacion.p_ffinanciamiento pf');
            return $query->result_array();
        }

        public function inf_3_acc_pdf($id_p_acc_centralizada){
            $this->db->select('pi2.id_p_items,
                        	     pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	     pi2.id_ccnu,
                        	     c2.desc_ccnu,
                               pi2.id_tip_obra,
                               to2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               ao.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               oo.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                        	     pi2.especificacion,
                               pi2.id_unidad_medida,
                        	     um.desc_unidad_medida,
                        	     pi2.i,
                        	     pi2.ii,
                        	     pi2.iii,
                        	     pi2.iv,
                               pi2.costo_unitario,
                        	     pi2.precio_total,
                        	     pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu', 'left');
            $this->db->join('programacion.tip_obra to2','to2.id_tip_obra = pi2.id_tip_obra', 'left');
            $this->db->join('programacion.alcance_obra ao','ao.id_alcance_obra = pi2.id_alcance_obra', 'left');
            $this->db->join('programacion.obj_obra oo','oo.id_obj_obra = pi2.id_obj_obra', 'left');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
            $this->db->where('pi2.id_p_acc', 1);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->result_array();
        }

        public function inf_2_acc($data){
            $this->db->select('pf.id_enlace,
                        	   pf.id_partidad_presupuestaria,
                        	   pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pf.id_estado,
                        	   pf.id_fuente_financiamiento,
                        	   ff.desc_fuente_financiamiento,
                        	   pf.porcentaje ');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pf.id_partidad_presupuestaria');
            $this->db->join('programacion.fuente_financiamiento ff','ff.id_fuente_financiamiento = pf.id_fuente_financiamiento');
            $this->db->where('pf.id_enlace', $data['id_p_acc_centralizada']);
            $this->db->where('pf.id_p_acc', 1);
            $query = $this->db->get('programacion.p_ffinanciamiento pf');
            return $query->result_array();
        }

        public function inf_3_acc($data){
            $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.costo_unitario,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $data['id_p_acc_centralizada']);
            $this->db->where('pi2.id_p_acc', 1);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->result_array();
        }

        public function inf_3_acc_b($data){
            $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                               pi2.cantidad,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.costo_unitario,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $data['id_p_acc_centralizada']);
            $this->db->where('pi2.id_p_acc', 1);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->result_array();
        }

		public function inf_4_acc_o($data){
            $this->db->select('pi2.id_p_items,
								pi2.id_enlace,
								pi2.id_partidad_presupuestaria,
								pp.desc_partida_presupuestaria,
								pp.codigopartida_presupuestaria,
								pi2.fecha_desde,
								pi2.fecha_hasta,
								pi2.especificacion,
								pi2.id_unidad_medida,
								um.desc_unidad_medida,
								pi2.id_tip_obra,
								to2.descripcion_tip_obr,
								pi2.id_alcance_obra,
								ao.descripcion_alcance_obra,
								pi2.id_obj_obra,
								oo.descripcion_obj_obra,
								pi2.i,
								pi2.ii,
								pi2.iii,
								pi2.iv,
								pi2.costo_unitario,
								pi2.precio_total,
								pi2.alicuota_iva,
								pi2.iva_estimado,
								pi2.monto_estimado');
			$this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
			$this->db->join('programacion.tip_obra to2','to2.id_tip_obra = pi2.id_tip_obra');
            $this->db->join('programacion.alcance_obra ao','ao.id_alcance_obra = pi2.id_alcance_obra');
            $this->db->join('programacion.obj_obra oo','oo.id_obj_obra = pi2.id_obj_obra');
            $this->db->where('pi2.id_enlace', $data['id_p_acc_centralizada']);
            $this->db->where('pi2.id_p_acc', 1);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->result_array();
        }

        public function editar_programacion_acc($id_p_acc_centralizada, $id_programacion, $p_acc_centralizada,$p_items,$p_ffinanciamiento){

            $this->db->where('id_programacion', $id_programacion);
            $this->db->where('id_p_acc_centralizada', $id_p_acc_centralizada);
            $update = $this->db->update('programacion.p_acc_centralizada', $p_acc_centralizada);

            if ($update) {
                $this->db->where('id_enlace', $id_p_acc_centralizada);
                $this->db->where('id_p_acc', 1);
                $this->db->delete('programacion.p_items');

                    $cant_proy = $p_items['id_ccnu'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_enlace'                  => $id_p_acc_centralizada,
                            'id_p_acc'                   => 1,
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => $p_items['id_ccnu'][$i],
							'id_tip_obra'                => 0,
                            'id_alcance_obra'            => 0,
                            'id_obj_obra'                => 0,
                            'fecha_desde'                => $p_items['fecha_desde'][$i],
                            'fecha_hasta'                => $p_items['fecha_hasta'][$i],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => 0,
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'costo_unitario'             => 0,
                            'cant_total_distribuir'      => 0,
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'               => $p_items['monto_estimado'][$i],
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }

                    $this->db->where('id_enlace', $id_p_acc_centralizada);
                    $this->db->where('id_p_acc', 1);
                    $this->db->delete('programacion.p_ffinanciamiento');

                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {

                        $data2 = array(
                            'id_enlace'                  => $id_p_acc_centralizada,
                            'id_p_acc'                   => 1,
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
            }
            return true;
        }

        public function editar_programacion_acc_b($id_p_acc_centralizada, $id_programacion, $p_acc_centralizada,$p_items,$p_ffinanciamiento){

            $this->db->where('id_programacion', $id_programacion);
            $this->db->where('id_p_acc_centralizada', $id_p_acc_centralizada);
            $update = $this->db->update('programacion.p_acc_centralizada', $p_acc_centralizada);

            if ($update) {
                $this->db->where('id_enlace', $id_p_acc_centralizada);
                $this->db->where('id_p_acc', 1);
                $this->db->delete('programacion.p_items');

                    $cant_proy = $p_items['id_ccnu'];
                    $count_prog = count($cant_proy);
                    for ($i=0; $i < $count_prog; $i++) {
                        $data1 = array(
                            'id_enlace'                  => $id_p_acc_centralizada,
                            'id_p_acc'                   => 1,
                            'id_partidad_presupuestaria' => $p_items['id_par_presupuestaria'][$i],
                            'id_ccnu'                    => $p_items['id_ccnu'][$i],
							'id_tip_obra'                => 0,
                            'id_alcance_obra'            => 0,
                            'id_obj_obra'                => 0,
                            'fecha_desde'                => $p_items['fecha_desde'],
                            'fecha_hasta'                => $p_items['fecha_hasta'],
                            'especificacion'             => $p_items['especificacion'][$i],
                            'id_unidad_medida'           => $p_items['id_unidad_medida'][$i],
                            'cantidad'                   => $p_items['cantidad'][$i],
                            'i'                          => $p_items['i'][$i],
                            'ii'                         => $p_items['ii'][$i],
                            'iii'                        => $p_items['iii'][$i],
                            'iv'                         => $p_items['iv'][$i],
                            'cant_total_distribuir'      => $p_items['cant_total_distribuir'][$i],
                            'costo_unitario'             => $p_items['costo_unitario'][$i],
                            'precio_total'               => $p_items['precio_total'][$i],
                            'alicuota_iva'               => $p_items['id_alicuota_iva'][$i],
                            'iva_estimado'               => $p_items['iva_estimado'][$i],
                            'monto_estimado'             => $p_items['monto_estimado'][$i],
                        );
                        $this->db->insert('programacion.p_items',$data1);
                    }

                    $this->db->where('id_enlace', $id_p_acc_centralizada);
                    $this->db->where('id_p_acc', 1);
                    $this->db->delete('programacion.p_ffinanciamiento');

                    $cant_pff = $p_ffinanciamiento['id_par_presupuestaria'];
                    $count_pff = count($cant_pff);

                    for ($i=0; $i < $count_pff; $i++) {

                        $data2 = array(
                            'id_enlace'                  => $id_p_acc_centralizada,
                            'id_p_acc'                   => 1,
                            'id_estado'                  => $p_ffinanciamiento['id_estado'][$i],
                            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_par_presupuestaria'][$i],
                            'id_fuente_financiamiento'   => $p_ffinanciamiento['id_fuente_financiamiento'][$i],
                            'porcentaje'                 => $p_ffinanciamiento['porcentaje'][$i],
                        );
                        $this->db->insert('programacion.p_ffinanciamiento',$data2);
                    }
            }
            return true;
        }

        //FUNTION PARA EDITAR LA INFORMACION DESDE EL MODAL BIENES
        public function editar_fila_ip_b($data){

            $this->db->where('id_p_items', $data['id_items_proy']);

            // $pp_s = $data['selc_part_pres'];
            // if ($pp_s == 0) {
            //     $id_partidad_presupuestaria = $data['partida_pre'];
            // }else {
            //     $id_partidad_presupuestaria = $data['selc_part_pres'];
            // }

            // $ccnu_s = $data['sel_ccnu'];
            // if ($ccnu_s == 0) {
            //     $id_ccnu = $data['ccnu'];
            // }else {
            //     $id_ccnu = $data['sel_ccnu'];
            // }

            $unid_m_s = $data['sel_camb_unid_medi'];
            if ($unid_m_s == 0) {
                $id_unidad_medida = $data['unid_med'];
            }else {
                $id_unidad_medida = $data['sel_camb_unid_medi'];
            }

            $id_ali_iva = $data['sel_id_alic_iva'];
            if ($id_ali_iva == 0) {
                $alicuota_iva = $data['ali_iva_e'];
            }else {
                $alicuota_iva = $data['sel_id_alic_iva'];
            }

            $data1 = array(
                // 'id_partidad_presupuestaria' => $data['partida_pre'],
                // 'id_ccnu'                    => $id_ccnu,
                'especificacion'             => $data['especificacion'],
                'id_unidad_medida'           => $id_unidad_medida,
                'cantidad'                   => $data['cantidad'],
                'i'                          => $data['primero'],
                'ii'                         => $data['segundo'],
                'iii'                        => $data['tercero'],
                'iv'                         => $data['cuarto'],
                'cant_total_distribuir'      => $data['cantidad_distribuir'],
                'costo_unitario'             => $data['cost_uni'],
                'precio_total'               => $data['prec_t'],
                'alicuota_iva'               => $alicuota_iva,
                'iva_estimado'               => $data['monto_iva_e'],
                'monto_estimado'             => $data['monto_tot_est'],
                'est_trim_1'             => $data['est_trim_1'],
                'est_trim_2'             => $data['est_trim_2'],
                'est_trim_3'             => $data['est_trim_3'],
                'est_trim_4'             => $data['est_trim_4'],
                'estimado_total_t_acc'             => $data['estimado_total_t_acc'],

            );
            $update = $this->db->update('programacion.p_items', $data1);
            return true;
        }
         //FUNTION PARA rendir bienes acc
         public function reprogramar_items_acc_bienes($data){

            $this->db->where('id_p_items', $data['id_items_proy']);

            // $pp_s = $data['selc_part_pres'];
            // if ($pp_s == 0) {
            //     $id_partidad_presupuestaria = $data['partida_pre'];
            // }else {
            //     $id_partidad_presupuestaria = $data['selc_part_pres'];
            // }

            // $ccnu_s = $data['sel_ccnu'];
            // if ($ccnu_s == 0) {
            //     $id_ccnu = $data['ccnu'];
            // }else {
            //     $id_ccnu = $data['sel_ccnu'];
            // }

            $unid_m_s = $data['sel_camb_unid_medi'];
            if ($unid_m_s == 0) {
                $id_unidad_medida = $data['unid_med'];
            }else {
                $id_unidad_medida = $data['sel_camb_unid_medi'];
            }

            $id_ali_iva = $data['sel_id_alic_iva'];
            if ($id_ali_iva == 0) {
                $alicuota_iva = $data['ali_iva_e'];
            }else {
                $alicuota_iva = $data['sel_id_alic_iva'];
            }

            $data1 = array(
                // 'id_partidad_presupuestaria' => $data['partida_pre'],
                // 'id_ccnu'                    => $id_ccnu,
                'especificacion'             => $data['especificacion'],
                'id_unidad_medida'           => $id_unidad_medida,
                'cantidad'                   => $data['cantidad'],
                'i'                          => $data['primero'],
                'ii'                         => $data['segundo'],
                'iii'                        => $data['tercero'],
                'iv'                         => $data['cuarto'],
                'cant_total_distribuir'      => $data['cantidad_distribuir'],
                'costo_unitario'             => $data['cost_uni'],
                'precio_total'               => $data['prec_t'],
                'alicuota_iva'               => $alicuota_iva,
                'iva_estimado'               => $data['monto_iva_e'],
                'monto_estimado'             => $data['monto_tot_est'],
                'est_trim_1'             => $data['est_trim_1'],
                'est_trim_2'             => $data['est_trim_2'],
                'est_trim_3'             => $data['est_trim_3'],
                'est_trim_4'             => $data['est_trim_4'],
                'estimado_total_t_acc'   => $data['estimado_total_t_acc'],
                'estatus_rendi' => 0,
                'reprogramado' => 1,
                'fecha_reprogramacion' => date('Y-m-d'),

            );
            $update = $this->db->update('programacion.p_items', $data1);
            return true;
        }

        public function cons_items_acc_b($data){
            $this->db->select('pi2.id_p_items,
                        	   pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                        	   pi2.id_ccnu,
                        	   c2.desc_ccnu,
                        	   pi2.fecha_desde,
                        	   pi2.fecha_hasta,
                        	   pi2.especificacion,
                               pi2.id_unidad_medida,
                        	   um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                        	   pi2.i,
                        	   pi2.ii,
                        	   pi2.iii,
                        	   pi2.iv,
                               pi2.cant_total_distribuir,
                        	   pi2.precio_total,
                        	   pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_p_items', $data['id_items_proy']);
            $this->db->where('pi2.id_p_acc', 1);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->row_array();
        }

		public function cons_items_acc_o($data){
            
			$this->db->select('pi2.id_p_items,
								pi2.id_enlace,
								pi2.id_partidad_presupuestaria,
								pp.desc_partida_presupuestaria,
								pp.codigopartida_presupuestaria,
								pi2.fecha_desde,
								pi2.fecha_hasta,
								pi2.especificacion,
								pi2.id_unidad_medida,
								um.desc_unidad_medida,
								pi2.id_tip_obra,
								to2.descripcion_tip_obr,
								pi2.id_alcance_obra,
								ao.descripcion_alcance_obra,
								pi2.id_obj_obra,
								oo.descripcion_obj_obra,
								pi2.i,
								pi2.ii,
								pi2.iii,
								pi2.iv,
								pi2.costo_unitario,
								pi2.precio_total,
								pi2.alicuota_iva,
								pi2.iva_estimado,
								pi2.monto_estimado');
			$this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
			$this->db->join('programacion.tip_obra to2','to2.id_tip_obra = pi2.id_tip_obra');
            $this->db->join('programacion.alcance_obra ao','ao.id_alcance_obra = pi2.id_alcance_obra');
            $this->db->join('programacion.obj_obra oo','oo.id_obj_obra = pi2.id_obj_obra');
            $this->db->where('pi2.id_p_items', $data['id_items_proy']);
            $this->db->where('pi2.id_p_acc', 1);
            $query = $this->db->get('programacion.p_items pi2');
            return $query->row_array();
        }

        public function eliminar_acc($data){
            $this->db->where('id_p_acc_centralizada', $data['id_items_acc']);
            $query = $this->db->delete('programacion.p_acc_centralizada');

            if ($query) {
                $this->db->where('id_enlace', $data['id_items_acc']);
                $this->db->where('id_p_acc', 1);
                $query = $this->db->delete('programacion.p_items');

                $this->db->where('id_enlace', $data['id_items_acc']);
                $this->db->where('id_p_acc', 1);
                $query = $this->db->delete('programacion.p_ffinanciamiento');
            }
           return true;
        }


		public function editar_fila_ip_b_o($data){

            $this->db->where('id_p_items', $data['id_items_proy']);

            $pp_s = $data['selc_part_pres'];
            if ($pp_s == 0) {
                $id_partidad_presupuestaria = $data['partida_pre'];
            }else {
                $id_partidad_presupuestaria = $data['selc_part_pres'];
            }

            $sel_obra = $data['sel_obra'];
            if ($sel_obra == 0) {
                $sel_obra = $data['obra'];
            }else {
                $sel_obra = $data['sel_obra'];
            }

			$sel_alc_obr = $data['sel_alc_obr'];
            if ($sel_alc_obr == 0) {
                $sel_alc_obr = $data['alc_obr'];
            }else {
                $sel_alc_obr = $data['sel_alc_obr'];
            }

			$sel_obj_obr = $data['sel_obj_obr'];
            if ($sel_obj_obr == 0) {
                $sel_obj_obr = $data['obj_obr'];
            }else {
                $sel_obj_obr = $data['sel_obj_obr'];
            }

            $unid_m_s = $data['sel_camb_unid_medi'];
            if ($unid_m_s == 0) {
                $id_unidad_medida = $data['unid_med'];
            }else {
                $id_unidad_medida = $data['sel_camb_unid_medi'];
            }

            $id_ali_iva = $data['sel_id_alic_iva'];
            if ($id_ali_iva == 0) {
                $alicuota_iva = $data['ali_iva_e'];
            }else {
                $alicuota_iva = $data['sel_id_alic_iva'];
            }

            $data1 = array(
                'id_partidad_presupuestaria' => $data['partida_pre'],
                'id_tip_obra'                => $sel_obra,
                'id_alcance_obra'            => $sel_alc_obr,
				'id_obj_obra'            	 => $sel_obj_obr,
                'especificacion'             => $data['esp'],
                'id_unidad_medida'           => $id_unidad_medida,
				'fecha_desde'                => $data['fecha_desde_e'],
                'fecha_hasta'                => $data['fecha_hasta_e'],
                'cantidad'                   => $data['cant_total_dist_m'],
                'i'                          => $data['primero'],
                'ii'                         => $data['segundo'],
                'iii'                        => $data['tercero'],
                'iv'                         => $data['cuarto'],
                'cant_total_distribuir'      => 0,
                'costo_unitario'             => 0,
                'precio_total'               => $data['prec_t'],
                'alicuota_iva'               => $alicuota_iva,
                'iva_estimado'               => $data['monto_iva_e'],
                'monto_estimado'             => $data['monto_tot_est'],
            );
            $update = $this->db->update('programacion.p_items', $data1);
            return true;
        }
       // consulta PROGRAMACION general por el snc
       public function consultar_programacio($unidad){
        $this->db->select('c.id_programacion, c.unidad, c.anio, m.rif,  m.descripcion,');
        $this->db->join('public.organoente m', 'm.codigo = c.unidad');
       // $this->db->where('unidad', $unidad);
        $query = $this->db->get('programacion.programacion c');
        return $query->result_array();
    }

	function consultar_proyecto($id_p_proyecto){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $id_p_proyecto);
            $this->db->where('pi2.id_p_acc', 0);//que esean proyectos
            $this->db->from('programacion.p_items pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
    // public function inf_3_b($data){
    //     $this->db->select('pi2.id_p_items,
    //                        pi2.id_enlace,
    //                        pi2.id_partidad_presupuestaria,
    //                        pp.desc_partida_presupuestaria,
    //                        pp.codigopartida_presupuestaria,
    //                        pi2.id_ccnu,
    //                        c2.desc_ccnu,
    //                        pi2.fecha_desde,
    //                        pi2.fecha_hasta,
    //                        pi2.especificacion,
    //                        pi2.id_unidad_medida,
    //                        um.desc_unidad_medida,
    //                        pi2.cantidad,
    //                        pi2.costo_unitario,
    //                        pi2.i,
    //                        pi2.ii,
    //                        pi2.iii,
    //                        pi2.iv,
    //                        pi2.cant_total_distribuir,
    //                        pi2.precio_total,
    //                        pi2.alicuota_iva,
    //                        pi2.iva_estimado,
    //                        pi2.monto_estimado');
    //     $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
    //     $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
    //     $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
    //     $this->db->where('pi2.id_enlace', $data['id_p_proyecto']);
    //     $this->db->where('pi2.id_p_acc', 0);
    //     $query = $this->db->get('programacion.p_items pi2');
  
    ///////////////////////////////////consultar accion centralizada bienes
    function consultar_scc($id_p_acc_centralizada){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
            $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
            $this->db->where('pi2.id_p_acc', 1);
            $this->db->from('programacion.p_items pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
       ///////////////////////////////////consultar tabla servicio proyecto
       function consultar_py_ser($id_p_proyecto){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                              
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               py.id_p_proyecto');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->join('programacion.p_proyecto py','py.id_p_proyecto = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
            $this->db->where('pi2.id_enlace', $id_p_proyecto);
            $this->db->where('pi2.id_p_acc', 0);
            $this->db->from('programacion.p_items pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
      ///////////////////////////////////consultar proyecto bienes
      function consultar_item_py_bienes($id_p_proyecto){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
          //  $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
            $this->db->where('pi2.id_enlace', $id_p_proyecto);
            $this->db->where('pi2.id_p_acc', 0);//busca que sean proyectos
            $this->db->from('programacion.p_items pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
    function consultar_item_py_servicio($id_programacion){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                              ');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            // $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
            $this->db->where('pi2.id_enlace', $id_programacion);
            $this->db->where('pi2.id_p_acc', 0);//busca que sean proyectos
            $this->db->from('programacion.p_items pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
    ////////////consultar editar items servicios acc
    public function consultar_itms_serv($id_p_items){
           
        $this->db->select('pi2.id_p_items,
                            pi2.id_enlace,
                            pi2.id_partidad_presupuestaria,
                            pp.desc_partida_presupuestaria,
                            pp.codigopartida_presupuestaria,
                            pi2.id_ccnu,
                            c2.desc_ccnu,
                            pi2.fecha_desde,
                            pi2.fecha_hasta,
                            pi2.especificacion,
                            pi2.id_unidad_medida,
                            um.desc_unidad_medida,
                            pi2.cantidad,
                            pi2.costo_unitario,
                            pi2.i,
                            pi2.ii,
                            pi2.iii,
                            pi2.iv,
                            pi2.cant_total_distribuir,
                            pi2.precio_total,
                            pi2.alicuota_iva,
                            pi2.iva_estimado,
                            pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_p_items', $id_p_items);
        $this->db->where('pi2.id_p_acc', 1);//eto verifica que sea una accion centralizada
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }

    ////////////consultar editar items servicios proyecto
    public function consultar_itms_serv_py($id_p_items){
           
        $this->db->select('pi2.id_p_items,
                            pi2.id_enlace,
                            pi2.id_partidad_presupuestaria,
                            pp.desc_partida_presupuestaria,
                            pp.codigopartida_presupuestaria,
                            pi2.id_ccnu,
                            c2.desc_ccnu,
                            pi2.fecha_desde,
                            pi2.fecha_hasta,
                            pi2.especificacion,
                            pi2.id_unidad_medida,
                            um.desc_unidad_medida,
                            pi2.cantidad,
                            pi2.costo_unitario,
                            pi2.i,
                            pi2.ii,
                            pi2.iii,
                            pi2.iv,
                            pi2.cant_total_distribuir,
                            pi2.precio_total,
                            pi2.alicuota_iva,
                            pi2.iva_estimado,
                            pi2.monto_estimado');
        $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
        $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
        $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
        $this->db->where('pi2.id_p_items', $id_p_items);
        $this->db->where('pi2.id_p_acc', 0);//eto verifica que sea un proyecto
        $query = $this->db->get('programacion.p_items pi2');
        return $query->result_array();
    }


    //////////////////////consultar item obras para cargar mas items acc
    function consultar_tems_obras($id_p_acc_centralizada){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_tip_obra,
                               c2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               c3.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               c4.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.tip_obra c2','c2.id_tip_obra = pi2.id_tip_obra');
            $this->db->join('programacion.alcance_obra c3','c3.id_alcance_obra = pi2.id_alcance_obra');
            $this->db->join('programacion.obj_obra c4','c4.id_obj_obra = pi2.id_obj_obra');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
            $this->db->where('pi2.id_p_acc', 1);
            $this->db->from('programacion.p_items pi2');
            $query = $this->db->get();
            return $query->result_array();
    }

    //////////////////////consultar item obras para cargar mas items proyecto
    function consultar_tems_obras_py($id_p_proyecto){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_tip_obra,
                               c2.descripcion_tip_obr,
                               pi2.id_alcance_obra,
                               c3.descripcion_alcance_obra,
                               pi2.id_obj_obra,
                               c4.descripcion_obj_obra,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado');
            $this->db->join('programacion.tip_obra c2','c2.id_tip_obra = pi2.id_tip_obra');
            $this->db->join('programacion.alcance_obra c3','c3.id_alcance_obra = pi2.id_alcance_obra');
            $this->db->join('programacion.obj_obra c4','c4.id_obj_obra = pi2.id_obj_obra');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->where('pi2.id_enlace', $id_p_proyecto);
            $this->db->where('pi2.id_p_acc', 0);//indico que consulte los proyectos con ese id_enlace
            $this->db->from('programacion.p_items pi2');
            $query = $this->db->get();
            return $query->result_array();
    }

////////////////////////////UNA VEZ MODIFICADO LOS ITEMS DE SERVICIO SE GUARDAN ACA
    public function guardar_items_modificados_servi($id_p_items,$itm_serv){

        $this->db->where('id_p_items', $id_p_items);
       // $this->db->where('id_p_proyecto', $id_p_proyecto);
        $update = $this->db->update('programacion.p_items', $itm_serv);


    }



    	///////////////////////////////consultar items para modal editar bienes
	public function consultar_items($data){
		$this->db->select('m.id_p_items,
                             m.id_partidad_presupuestaria,
                             m.id_ccnu,
                             m.id_tip_obra,
                             m.id_alcance_obra,
                             m.id_obj_obra,
                             m.especificacion,
                             m.fecha_desde, 
                             m.fecha_hasta,
                             m.id_unidad_medida,
                             m.cantidad,
                             m.i,
                             m.ii,
                             m.iii,
                             m.iv,
                             m.cant_total_distribuir,
                             m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                             m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                             pp.codigopartida_presupuestaria,
                             pp.desc_partida_presupuestaria,
                             cc.desc_ccnu,
                             un.desc_unidad_medida,
                             tpo.descripcion_tip_obr,
                             al.descripcion_alcance_obra,
                             obj.descripcion_obj_obra'
                             

						);
		$this->db->from('programacion.p_items m');
        $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc','cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un','un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.tip_obra tpo','tpo.id_tip_obra = m.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra al','al.id_alcance_obra = m.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra obj','obj.id_obj_obra = m.id_obj_obra', 'left');

		$this->db->where('m.id_p_items', $data['id_p_items']);
		// $this->db->order_by('mc.id_p_items desc');
		$query = $this->db->get();
		$resultado = $query->row_array();
		return $resultado;
	}

    ////////////////////////agrega mas items a BIENES///////////////////
    function agregar_mas_item_proyecto($data,$p_ffinanciamiento){
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ;
    
        $data1 = array(
            'id_p_items'		    => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra'=>  $data['id_obj_obra'],
            'fecha_desde'=>  $data['fecha_desde'],
            'fecha_hasta'=> $data['fecha_hasta'],
           'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
           'id_ccnu' 		        => $data['id_ccnu'],
           'especificacion' 		=> $data['especificacion'],
           'id_unidad_medida' 		 => $data['id_unidad_medida'],
           'cantidad' 		 => $data['cantidad'],
           'i' 		          => $data['i'],
           'ii' 		            => $data['ii'],
           'iii' 		            => $data['iii'],
           'iv' 		             => $data['iv'],
           'cant_total_distribuir'  => $data['cant_total_distribuir'],
           'precio_total' 		    => $data['precio_total'],
           'alicuota_iva' 		=> $data['alicuota_iva'],
           'iva_estimado' 		    => $data['iva_estimado'],
           'costo_unitario' 		=> $data['costo_unitario'],
           'monto_estimado' 		=> $data['monto_estimado'],
           'est_trim_1' 		 => $data['est_trim_1'],
           'est_trim_2' 		 => $data['est_trim_2'],
           'est_trim_3' 		=> $data['est_trim_3'],
           'est_trim_4' 		 => $data['est_trim_4'],
           'estimado_total_t_acc' => $data['estimado_total_t_acc']
        );
        $quers =$this->db->insert("programacion.p_items", $data1);
       // $this->db->insert('programacion.p_items',$data);
       if ($quers) {
        $id = $id;
    
        $data3 = array(
            'id_p_items'    => $id1,
            'id_estado'   		        => $p_ffinanciamiento['id_estado'],
            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
            'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
            'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
            'id_enlace' => $p_ffinanciamiento['id_enlace'],
            'id_p_acc' => $p_ffinanciamiento['id_p_acc']
                );
                $this->db->insert('programacion.p_ffinanciamiento', $data3);
                return true;    
         }
    } 
    
    ////////////////////////agrega mas items a BIENES REPROGRAMACION ///////////////////
    function agregar_mas_item_reprogramado($data,$p_ffinanciamiento){
        $this->db->select('max(e.id_p_items) as id1');
        $query1 = $this->db->get('programacion.p_items e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ;
    
        $data1 = array(
            'id_p_items'		    => $id1,
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra'=>  $data['id_obj_obra'],
            'fecha_desde'=>  $data['fecha_desde'],
            'fecha_hasta'=> $data['fecha_hasta'],
           'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
           'id_ccnu' 		        => $data['id_ccnu'],
           'especificacion' 		=> $data['especificacion'],
           'id_unidad_medida' 		 => $data['id_unidad_medida'],
           'cantidad' 		 => $data['cantidad'],
           'i' 		          => $data['i'],
           'ii' 		            => $data['ii'],
           'iii' 		            => $data['iii'],
           'iv' 		             => $data['iv'],
           'cant_total_distribuir'  => $data['cant_total_distribuir'],
           'precio_total' 		    => $data['precio_total'],
           'alicuota_iva' 		=> $data['alicuota_iva'],
           'iva_estimado' 		    => $data['iva_estimado'],
           'costo_unitario' 		=> $data['costo_unitario'],
           'monto_estimado' 		=> $data['monto_estimado'],
           'est_trim_1' 		 => $data['est_trim_1'],
           'est_trim_2' 		 => $data['est_trim_2'],
           'est_trim_3' 		=> $data['est_trim_3'],
           'est_trim_4' 		 => $data['est_trim_4'],
           'estimado_total_t_acc' => $data['estimado_total_t_acc'],
           'estatus_rendi' => $data['estatus_rendi'],
            'reprogramado' => $data['reprogramado'],
            'fecha_reprogramacion' => $data['fecha_reprogramacion'],

        );
        $quers =$this->db->insert("programacion.p_items", $data1);
       // $this->db->insert('programacion.p_items',$data);
       if ($quers) {
        $id = $id;
    
        $data3 = array(
            'id_p_items'    => $id1,
            'id_estado'   		        => $p_ffinanciamiento['id_estado'],
            'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
            'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
            'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
            'id_enlace' => $p_ffinanciamiento['id_enlace'],
            'id_p_acc' => $p_ffinanciamiento['id_p_acc']
                );
                $this->db->insert('programacion.p_ffinanciamiento', $data3);
                return true;    
         }
    } 
//////////////////gUARDAR agregar mas items servicio accion centralizada
function agregar_mas_item_servicio($data,$p_ffinanciamiento){
    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'estatus_rendi' => $data['estatus_rendi'],
       'reprogramado' => 0,
      
    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);
   if ($quers) {
    $id = $id;

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
     }
   
}




    //////////////////eliminar items de servcio
    public function eliminar_items_serv($data){
        $this->db->where('id_p_items', $data['id_p_items']);
        $query = $this->db->delete('programacion.p_items');

        if ($query) {
            // $this->db->where('id_enlace', $data['id_items_proy']);
            // $this->db->where('id_p_acc', 0);
            // $query = $this->db->delete('programacion.p_items');

            $this->db->where('id_p_items', $data['id_p_items']);
            // $this->db->where('id_p_acc', 0);
            $query = $this->db->delete('programacion.p_ffinanciamiento');
        }
       return true;
    }
  //////////////////eliminar items de servcio
  public function eliminar_items_bienes($data){
    $this->db->where('id_p_items', $data['id_p_items']);
    $query = $this->db->delete('programacion.p_items');

    if ($query) {
        // $this->db->where('id_enlace', $data['id_items_proy']);
        // $this->db->where('id_p_acc', 0);
        // $query = $this->db->delete('programacion.p_items');

        $this->db->where('id_p_items', $data['id_p_items']);
        // $this->db->where('id_p_acc', 0);
        $query = $this->db->delete('programacion.p_ffinanciamiento');
    }
   return true;
}
//////////////////gUARDAR agregar mas items Obras
function agregar_mas_item_obras($data,$p_ffinanciamiento){
    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc']
    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);
   if ($quers) {
    $id = $id;

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
     }
   
}

/////////////cambia el status de la programacion
public function enviar_snc_reprogramacion($data)
{
    $data1 = array('estatus' => '3',// se puede reprogramar y rendir 
                    'id_usuario' => '0',
                    'fecha' => date('Y-m-d h:i:s'));
    $this->db->where('id_programacion', $data['id']);
    $update = $this->db->update('programacion.programacion', $data1);
    return true;
}
/////////////cambia el status de la reprogramacion enviar al snc
public function enviar_snc($data)
{
    $data1 = array('estatus' => '2',// se puede reprogramar y rendir 
                    'id_usuario' => '0',
                    'fecha' => date('Y-m-d h:i:s'));
    $this->db->where('id_programacion', $data['id']);
    $update = $this->db->update('programacion.programacion', $data1);
    return true;
}
//////////////////gUARDAR agregar mas items servicio proyecto
function Guardar_mas_item_py_servicio($data,$p_ffinanciamiento){
    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'estatus_rendi' => $data['estatus_rendi'],
       

    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);
   if ($quers) {
   

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
     }
   
}
/////////////////gUARDAR agregar mas items servicio obras
function Guardar_mas_item_py_obras($data,$p_ffinanciamiento){
    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'estatus_rendi' => $data['estatus_rendi'],

    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);
   if ($quers) {
   

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
     }
   
}








/////////////////reprogramacion 
///////////consultar años disponibles para reprogramar
public function consultar_reprogramacion($unidad){
    $this->db->select('*');
    $this->db->where('unidad', $unidad);
    $this->db->where('estatus >', 1);
    $this->db->where('estatus <', 4);
    $query = $this->db->get('programacion.programacion');
    return $query->result_array();
}

  //reprogrma servicio editar items
  public function Reprogrma_guardar_items_modificados_servi($id_p_items,$itm_serv, $id_programaciones){

    $this->db->where('id_p_items', $id_p_items);
   // $this->db->where('id_p_proyecto', $id_p_proyecto);
    $update = $this->db->update('programacion.p_items', $itm_serv);
    if ($update) {
    $this->db->where('id_programacion', $id_programaciones['id_programacion']);
    $update = $this->db->update('programacion.programacion', $id_programaciones);
    }

}  
function Guardar_mas_item_acc_servicio2($data,$p_ffinanciamiento, $id_programaciones){

    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

 
  
    $this->db->where('id_programacion', $id_programaciones['id_programacion']);
    $update = $this->db->update('programacion.programacion', $id_programaciones);

    if ($update) {

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'estatus_rendi' => $data['estatus_rendi'],
       'reprogramado' => $data['reprogramado'],
       'fecha_reprogramacion' => $data['fecha_reprogramacion'],


    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);

    // $id = $id1;

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
    //     }
    }
    }


     	///////////////////////////////consultar items para modal rendir servicios
	public function consultar_items_servicio_acc_rendir($data){
		$this->db->select('m.id_p_items,
                             m.id_enlace,
                             m.id_partidad_presupuestaria,
                             m.id_ccnu,
                             m.id_tip_obra, m.id_alcance_obra, m.id_obj_obra,
                             m.especificacion,
                             m.id_unidad_medida,
                             m.cantidad,
                             m.i,
                             m.ii,
                             m.iii,
                             m.iv,
                             m.cant_total_distribuir,
                             m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                             m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                             m.fecha_desde,
                             m.fecha_hasta,
                             pp.codigopartida_presupuestaria,
                             pp.desc_partida_presupuestaria,
                             cc.codigo_ccnu,
                             cc.desc_ccnu,
                             un.desc_unidad_medida,
                             pcc.id_accion_centralizada,
                             pcc.id_obj_comercial,
                             pcc.id_programacion,
                             ff.id_estado,
                             ff.id_fuente_financiamiento,
                             ff.porcentaje,
                             fr.desc_fuente_financiamiento,
                             ac.desc_accion_centralizada,
                             ob.desc_objeto_contrata,
                             re.trimestre,
                             tr.descripcion_trimestre,
                             tpo.descripcion_tip_obr,
                             al.descripcion_alcance_obra,
                             obj.descripcion_obj_obra
                             '							
						);
		$this->db->from('programacion.p_items m');
        $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
        $this->db->join('programacion.ccnu cc','cc.codigo_ccnu = m.id_ccnu', 'left');
        $this->db->join('programacion.unidad_medida un','un.id_unidad_medida = m.id_unidad_medida', 'left');
        $this->db->join('programacion.p_acc_centralizada pcc','pcc.id_p_acc_centralizada = m.id_enlace', 'left');

        $this->db->join('programacion.p_ffinanciamiento ff','ff.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.fuente_financiamiento fr','fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');

        $this->db->join('programacion.accion_centralizada ac','ac.id_accion_centralizada = pcc.id_accion_centralizada', 'left');

        $this->db->join('programacion.objeto_contrata ob','ob.id_objeto_contrata = pcc.id_obj_comercial', 'left');
        $this->db->join('programacion.rendidicion re','re.id_p_items = m.id_p_items', 'left');
        $this->db->join('programacion.trimestre tr','tr.id_trimestre = re.trimestre', 'left');        
        $this->db->join('programacion.tip_obra tpo','tpo.id_tip_obra = m.id_tip_obra', 'left');
        $this->db->join('programacion.alcance_obra al','al.id_alcance_obra = m.id_alcance_obra', 'left');
        $this->db->join('programacion.obj_obra obj','obj.id_obj_obra = m.id_obj_obra', 'left');
		$this->db->where('m.id_p_items', $data['id_p_items']);
		// $this->db->order_by('mc.id_p_items desc');
		$query = $this->db->get();
		$resultado = $query->row_array();
		return $resultado;
	}
    



    function guardar_rendi_servicio_acc($data,$id_p_itemss){
        $this->db->select('max(e.id_rendicion) as id1');
        $query1 = $this->db->get('programacion.rendidicion e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ; 
        
        $data1 = array(
            'id_rendicion'		    => $id1,
            'rif_organoente' => $data['rif_organoente'],
            'id_programacion' => $data['id_programacion'],
            'id_enlace' => $data['id_enlace'],
            'id_p_acc' => $data['id_p_acc'],
            'id_proyecto' => $data['id_proyecto'],
            'id_tip_obra' => $data['id_tip_obra'],
            'id_alcance_obra' => $data['id_alcance_obra'],
            'id_obj_obra' => $data['id_obj_obra'],
            'codigopartida_presupuestaria' => $data['codigopartida_presupuestaria'],
            'id_p_items' => $data['id_p_items'],
            'desc_partida_presupuestaria' => $data['desc_partida_presupuestaria'],
            'codigo_ccnu' => $data['codigo_ccnu'],
            'desc_ccnu' => $data['desc_ccnu'],
            'id_accion_centralizada' => $data['id_accion_centralizada'],
            'desc_accion_centralizada' => $data['desc_accion_centralizada'],
            'id_obj_comercial' => $data['id_obj_comercial'],
            'desc_objeto_contrata' => $data['desc_objeto_contrata'],
            'estado' => $data['estado'],
            'id_fuente_financiamiento' => $data['id_fuente_financiamiento'],
            'desc_fuente_financiamiento' => $data['desc_fuente_financiamiento'],
            'porcentaje' => $data['porcentaje'],
            'fecha_desde' 		=> $data['fecha_desde'],
            'fecha_hasta' 		=> $data['fecha_hasta'],
           'especificacion' 		=> $data['especificacion'],
           'id_unidad_medida' 		 => $data['id_unidad_medida'],
           'cantidad' 		 => $data['cantidad'],
           'i' 		          => $data['i'],
           'ii' 		            => $data['ii'],
           'iii' 		            => $data['iii'],
           'iv' 		             => $data['iv'],
           'cant_total_distribuir'  => 0,
           'costo_unitario' 		    => $data['costo_unitario'],
         
           'precio_total' 		    => $data['precio_total'],
           'alicuota_iva' 		=> $data['alicuota_iva'],
           'iva_estimado' 		    => $data['iva_estimado'],
           'monto_estimado' 		=> $data['monto_estimado'],
           'est_trim_1' 		 => $data['est_trim_1'],
           'est_trim_2' 		 => $data['est_trim_2'],
           'est_trim_3' 		=> $data['est_trim_3'],
           'est_trim_4' 		 => $data['est_trim_4'],
           'estimado_total_t_acc' => $data['estimado_total_t_acc'],
           'costo_unitario_rend_ejecu' => $data['costo_unitario_rend_ejecu'],
           'precio_rend_ejecu' => $data['precio_rend_ejecu'],
           'selc_iva_rendi' => $data['selc_iva_rendi'],
           'iva_estimado_rend' => $data['iva_estimado_rend'],
           'total_rendi' => $data['total_rendi'],
           'paridad_rendi' => $data['paridad_rendi'],
           'subtotal_rendi' => $data['subtotal_rendi'],
           'id_modalida_rendi' => $data['id_modalida_rendi'],
           'sel_rif_nombre' => $data['sel_rif_nombre'],
           'num_contrato' => $data['num_contrato'],
           'fecha_contrato' => $data['fecha_contrato'],
           'selc_tipo_doc_contrata' => $data['selc_tipo_doc_contrata'],
           'selc_com_res_social' => $data['selc_com_res_social'],
           'monto3_rendim' => $data['monto3_rendim'],
           'nfactura_rendi' => $data['nfactura_rendi'],
           'datefactura_rendi' => $data['datefactura_rendi'],
           'base_imponible_rendi' => $data['base_imponible_rendi'],
           'selc_iva_rendi2' => $data['selc_iva_rendi2'],
           'monto_factura_rend' => $data['monto_factura_rend'],
           'total_pago_rendi' => $data['total_pago_rendi'],           
           'paridad_rendi_factura' => $data['paridad_rendi_factura'],
           'subtotal_rendi_factura' => $data['subtotal_rendi_factura'],
           'fecha_pago_rendi' => $data['fecha_pago_rendi'],
           'estatus' => $data['estatus'],
           'fecha_rendicion' => $data['fecha_rendicion'],
           'fecha_cam_estatus' => $data['fecha_cam_estatus'],
           'id_usuario' => $data['id_usuario'],
           'fecha30dias_notificacion' => $data['fecha30dias_notificacion'],
           'trimestre' => $data['trimestre'],
           'snc' => 0,
           
        );    
        $query=$this->db->insert('programacion.rendidicion',$data1);
        if ($query) {
            $this->db->where('id_p_items', $data['id_p_items']);
            $update = $this->db->update('programacion.p_items', $id_p_itemss);
            }
        return true;
    }

    function rendir_serv_acc($id_p_acc_centralizada){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pi2.estatus_rendi,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada,
                               ');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
            $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
            $this->db->where('pi2.i  >', 0);
            $this->db->where('pi2.estatus_rendi  <', 4);
            $this->db->where('pi2.id_p_acc', 1);
            $this->db->from('programacion.primerotrimestre pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
    function rendir_serv_acc2($id_p_acc_centralizada){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pi2.estatus_rendi,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada,
                               ');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
            $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
            $this->db->where('pi2.ii  >', 0);
            $this->db->where('pi2.estatus_rendi  <', 4);
            $this->db->where('pi2.id_p_acc', 1);
            $this->db->from('programacion.segundotrimestre pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
    function rendir_serv_acc3($id_p_acc_centralizada){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pi2.estatus_rendi,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada,
                               ');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
            $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
            $this->db->where('pi2.iii  >', 0);
            $this->db->where('pi2.estatus_rendi  <', 4);
            $this->db->where('pi2.id_p_acc', 1);
            $this->db->from('programacion.tercerotrimestre pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
    function rendir_serv_acc4($id_p_acc_centralizada){

        $this->db->select('pi2.id_p_items,
                               pi2.id_enlace,
                               pi2.id_partidad_presupuestaria,
                               pi2.estatus_rendi,
                               pp.desc_partida_presupuestaria,
                               pp.codigopartida_presupuestaria,
                               pi2.id_ccnu,
                               c2.desc_ccnu,
                               pi2.fecha_desde,
                               pi2.fecha_hasta,
                               pi2.especificacion,
                               pi2.id_unidad_medida,
                               um.desc_unidad_medida,
                               pi2.cantidad,
                               pi2.costo_unitario,
                               pi2.i,
                               pi2.ii,
                               pi2.iii,
                               pi2.iv,
                               pi2.cant_total_distribuir,
                               pi2.precio_total,
                               pi2.alicuota_iva,
                               pi2.iva_estimado,
                               pi2.monto_estimado,
                               p.id_p_acc_centralizada,
                               ');
            $this->db->join('programacion.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
            $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
            $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
            $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
            $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
            $this->db->where('pi2.iv  >', 0);
            $this->db->where('pi2.estatus_rendi  <', 4);
            $this->db->where('pi2.id_p_acc', 1);
            $this->db->from('programacion.cuartotrimestre pi2');
            $query = $this->db->get();
            return $query->result_array();
    }
////////////////////editar items py obras
    public function editar_fila_py_obra($data){

        $this->db->where('id_p_items', $data['id_items_proy']);

        $pp_s = $data['camb_tipo_obra'];
        if ($pp_s == 0) {
            $id_tip_obra = $data['tipo_obra'];
        }else {
            $id_tip_obra = $data['camb_tipo_obra'];
        }

        $ccnu_s = $data['camb_id_alcance_obra'];
        if ($ccnu_s == 0) {
            $id_alcance_obra = $data['alcance_obra'];
        }else {
            $id_alcance_obra = $data['camb_id_alcance_obra'];
        }
        $alcance = $data['camb_id_obj_obra'];
        if ($alcance == 0) {
            $obj_obra = $data['obj_obra'];
        }else {
            $obj_obra = $data['camb_id_obj_obra'];
        }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        }else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        }else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
             'id_tip_obra' => $id_tip_obra,
             'id_alcance_obra'                    => $id_alcance_obra,
             'id_obj_obra'                    => $obj_obra,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'             => $data['estimado_total_t_acc'],

        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }

    ////////////////////reprogramar modal items acc obras
    public function reprogramar_fila_acc_obra($data){

        $this->db->where('id_p_items', $data['id_items_proy']);

        $pp_s = $data['camb_tipo_obra'];
        if ($pp_s == 0) {
            $id_tip_obra = $data['tipo_obra'];
        }else {
            $id_tip_obra = $data['camb_tipo_obra'];
        }

        $ccnu_s = $data['camb_id_alcance_obra'];
        if ($ccnu_s == 0) {
            $id_alcance_obra = $data['alcance_obra'];
        }else {
            $id_alcance_obra = $data['camb_id_alcance_obra'];
        }
        $alcance = $data['camb_id_obj_obra'];
        if ($alcance == 0) {
            $obj_obra = $data['obj_obra'];
        }else {
            $obj_obra = $data['camb_id_obj_obra'];
        }

        $unid_m_s = $data['sel_camb_unid_medi'];
        if ($unid_m_s == 0) {
            $id_unidad_medida = $data['unid_med'];
        }else {
            $id_unidad_medida = $data['sel_camb_unid_medi'];
        }

        $id_ali_iva = $data['sel_id_alic_iva'];
        if ($id_ali_iva == 0) {
            $alicuota_iva = $data['ali_iva_e'];
        }else {
            $alicuota_iva = $data['sel_id_alic_iva'];
        }

        $data1 = array(
             'id_tip_obra' => $id_tip_obra,
             'id_alcance_obra'                    => $id_alcance_obra,
             'id_obj_obra'                    => $obj_obra,
            'especificacion'             => $data['especificacion'],
            'id_unidad_medida'           => $id_unidad_medida,
            'cantidad'                   => $data['cantidad'],
            'i'                          => $data['primero'],
            'ii'                         => $data['segundo'],
            'iii'                        => $data['tercero'],
            'iv'                         => $data['cuarto'],
            'cant_total_distribuir'      => $data['cantidad_distribuir'],
            'costo_unitario'             => $data['cost_uni'],
            'precio_total'               => $data['prec_t'],
            'alicuota_iva'               => $alicuota_iva,
            'iva_estimado'               => $data['monto_iva_e'],
            'monto_estimado'             => $data['monto_tot_est'],
            'est_trim_1'             => $data['est_trim_1'],
            'est_trim_2'             => $data['est_trim_2'],
            'est_trim_3'             => $data['est_trim_3'],
            'est_trim_4'             => $data['est_trim_4'],
            'estimado_total_t_acc'             => $data['estimado_total_t_acc'],
            'estatus_rendi' => 0,
            'reprogramado' => 1,
            'fecha_reprogramacion' => date('Y-m-d'),


        );
        $update = $this->db->update('programacion.p_items', $data1);
        return true;
    }

  //////////////////gUARDAR agregar mas items Obras  acc
function Guardar_repro_item_acc_obra($data,$p_ffinanciamiento){
    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'estatus_rendi' => 0,
       'reprogramado' =>1,
       'fecha_reprogramacion' => date('Y-m-d'),

    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);
   if ($quers) {
    $id = $id;

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
     }
   
}  
///////////reprogramar py bienes modal
public function reprogramar_fila_ip_bien_proyecto($data){

    $this->db->where('id_p_items', $data['id_items_proy']);

    // $pp_s = $data['selc_part_pres'];
    // if ($pp_s == 0) {
    //     $id_partidad_presupuestaria = $data['partida_pre'];
    // }else {
    //     $id_partidad_presupuestaria = $data['selc_part_pres'];
    // }

    // $ccnu_s = $data['sel_ccnu'];
    // if ($ccnu_s == 0) {
    //     $id_ccnu = $data['ccnu'];
    // }else {
    //     $id_ccnu = $data['sel_ccnu'];
    // }

    $unid_m_s = $data['sel_camb_unid_medi'];
    if ($unid_m_s == 0) {
        $id_unidad_medida = $data['unid_med'];
    }else {
        $id_unidad_medida = $data['sel_camb_unid_medi'];
    }

    $id_ali_iva = $data['sel_id_alic_iva'];
    if ($id_ali_iva == 0) {
        $alicuota_iva = $data['ali_iva_e'];
    }else {
        $alicuota_iva = $data['sel_id_alic_iva'];
    }

    $data1 = array(
        // 'id_partidad_presupuestaria' => $data['partida_pre'],
        // 'id_ccnu'                    => $id_ccnu,
        'especificacion'             => $data['especificacion'],
        'id_unidad_medida'           => $id_unidad_medida,
        'cantidad'                   => $data['cantidad'],
        'i'                          => $data['primero'],
        'ii'                         => $data['segundo'],
        'iii'                        => $data['tercero'],
        'iv'                         => $data['cuarto'],
        'cant_total_distribuir'      => $data['cantidad_distribuir'],
        'costo_unitario'             => $data['cost_uni'],
        'precio_total'               => $data['prec_t'],
        'alicuota_iva'               => $alicuota_iva,
        'iva_estimado'               => $data['monto_iva_e'],
        'monto_estimado'             => $data['monto_tot_est'],
        'est_trim_1'             => $data['est_trim_1'],
        'est_trim_2'             => $data['est_trim_2'],
        'est_trim_3'             => $data['est_trim_3'],
        'est_trim_4'             => $data['est_trim_4'],
        'estimado_total_t_acc'             => $data['estimado_total_t_acc'],
        'estatus_rendi' => 0,
       'reprogramado' => 1,
       'fecha_reprogramacion' => date('Y-m-d'),

    );
    $update = $this->db->update('programacion.p_items', $data1);
    return true;
}
////////////////////////reprogramo proyecto mas items a BIENES///////////////////
function Guardar_reprogramacion_item_bienes_py($data,$p_ffinanciamiento){
    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'estatus_rendi' => 0,
       'reprogramado' => 1,
       'fecha_reprogramacion' => date('Y-m-d'),
    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);
   if ($quers) {
    $id = $id;

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
     }
} 

////////////////////reprogramar modal items proyecto obras
public function Repro_modal_py_obra($data){

    $this->db->where('id_p_items', $data['id_items_proy']);

    $pp_s = $data['camb_tipo_obra'];
    if ($pp_s == 0) {
        $id_tip_obra = $data['tipo_obra'];
    }else {
        $id_tip_obra = $data['camb_tipo_obra'];
    }

    $ccnu_s = $data['camb_id_alcance_obra'];
    if ($ccnu_s == 0) {
        $id_alcance_obra = $data['alcance_obra'];
    }else {
        $id_alcance_obra = $data['camb_id_alcance_obra'];
    }
    $alcance = $data['camb_id_obj_obra'];
    if ($alcance == 0) {
        $obj_obra = $data['obj_obra'];
    }else {
        $obj_obra = $data['camb_id_obj_obra'];
    }

    $unid_m_s = $data['sel_camb_unid_medi'];
    if ($unid_m_s == 0) {
        $id_unidad_medida = $data['unid_med'];
    }else {
        $id_unidad_medida = $data['sel_camb_unid_medi'];
    }

    $id_ali_iva = $data['sel_id_alic_iva'];
    if ($id_ali_iva == 0) {
        $alicuota_iva = $data['ali_iva_e'];
    }else {
        $alicuota_iva = $data['sel_id_alic_iva'];
    }

    $data1 = array(
         'id_tip_obra' => $id_tip_obra,
         'id_alcance_obra'                    => $id_alcance_obra,
         'id_obj_obra'                    => $obj_obra,
        'especificacion'             => $data['especificacion'],
        'id_unidad_medida'           => $id_unidad_medida,
        'cantidad'                   => $data['cantidad'],
        'i'                          => $data['primero'],
        'ii'                         => $data['segundo'],
        'iii'                        => $data['tercero'],
        'iv'                         => $data['cuarto'],
        'cant_total_distribuir'      => $data['cantidad_distribuir'],
        'costo_unitario'             => $data['cost_uni'],
        'precio_total'               => $data['prec_t'],
        'alicuota_iva'               => $alicuota_iva,
        'iva_estimado'               => $data['monto_iva_e'],
        'monto_estimado'             => $data['monto_tot_est'],
        'est_trim_1'             => $data['est_trim_1'],
        'est_trim_2'             => $data['est_trim_2'],
        'est_trim_3'             => $data['est_trim_3'],
        'est_trim_4'             => $data['est_trim_4'],
        'estimado_total_t_acc'             => $data['estimado_total_t_acc'],
        'estatus_rendi' => 0,
        'reprogramado' => 1,
        'fecha_reprogramacion' => date('Y-m-d'),


    );
    $update = $this->db->update('programacion.p_items', $data1);
    return true;
}
function Repro_py_obra($data,$p_ffinanciamiento){
    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'estatus_rendi' => 0,
       'reprogramado' =>1,
       'fecha_reprogramacion' => date('Y-m-d'),

    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);
   if ($quers) {
    $id = $id;

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
     }
   
}  
function Repro_py_servicio($data,$p_ffinanciamiento){
    $this->db->select('max(e.id_p_items) as id1');
    $query1 = $this->db->get('programacion.p_items e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ;

    $data1 = array(
        'id_p_items'		    => $id1,
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra'=>  $data['id_obj_obra'],
        'fecha_desde'=>  $data['fecha_desde'],
        'fecha_hasta'=> $data['fecha_hasta'],
       'id_partidad_presupuestaria' => $data['id_partidad_presupuestaria'],
       'id_ccnu' 		        => $data['id_ccnu'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => $data['cant_total_distribuir'],
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'costo_unitario' 		=> $data['costo_unitario'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'estatus_rendi' => 0,
       'reprogramado' =>1,
       'fecha_reprogramacion' => date('Y-m-d'),

    );
    $quers =$this->db->insert("programacion.p_items", $data1);
   // $this->db->insert('programacion.p_items',$data);
   if ($quers) {
  

    $data3 = array(
        'id_p_items'    => $id1,
        'id_estado'   		        => $p_ffinanciamiento['id_estado'],
        'id_partidad_presupuestaria' => $p_ffinanciamiento['id_partidad_presupuestaria'],
        'id_fuente_financiamiento'  => $p_ffinanciamiento['id_fuente_financiamiento'],
        'porcentaje' 	           => $p_ffinanciamiento['porcentaje'],
        'id_enlace' => $p_ffinanciamiento['id_enlace'],
        'id_p_acc' => $p_ffinanciamiento['id_p_acc']
            );
            $this->db->insert('programacion.p_ffinanciamiento', $data3);
            return true;    
     }
   
} 
////////////////////reprogramar Guardar modal items proyecto sericio 
public function Repro_modal_py_servicios($data){

    $this->db->where('id_p_items', $data['id_items_proy']);

    $unid_m_s = $data['sel_camb_unid_medi'];
    if ($unid_m_s == 0) {
        $id_unidad_medida = $data['unid_med'];
    }else {
        $id_unidad_medida = $data['sel_camb_unid_medi'];
    }

    $id_ali_iva = $data['sel_id_alic_iva'];
    if ($id_ali_iva == 0) {
        $alicuota_iva = $data['ali_iva_e'];
    }else {
        $alicuota_iva = $data['sel_id_alic_iva'];
    }

    $data1 = array(
         'id_tip_obra' => 0,
         'id_alcance_obra'                    => 0,
         'id_obj_obra'                    => 0,
        'especificacion'             => $data['especificacion'],
        'id_unidad_medida'           => $id_unidad_medida,
        'cantidad'                   => $data['cantidad'],
        'i'                          => $data['primero'],
        'ii'                         => $data['segundo'],
        'iii'                        => $data['tercero'],
        'iv'                         => $data['cuarto'],
        'cant_total_distribuir'      => $data['cantidad_distribuir'],
        'costo_unitario'             => $data['cost_uni'],
        'precio_total'               => $data['prec_t'],
        'alicuota_iva'               => $alicuota_iva,
        'iva_estimado'               => $data['monto_iva_e'],
        'monto_estimado'             => $data['monto_tot_est'],
        'est_trim_1'             => $data['est_trim_1'],
        'est_trim_2'             => $data['est_trim_2'],
        'est_trim_3'             => $data['est_trim_3'],
        'est_trim_4'             => $data['est_trim_4'],
        'estimado_total_t_acc'   => $data['estimado_total_t_acc'],
        'estatus_rendi' => 0,
        'reprogramado' => 1,
        'fecha_reprogramacion' => date('Y-m-d'),


    );
    $update = $this->db->update('programacion.p_items', $data1);
    return true;
}
///////////////pruebas
public function consultar_items_servicio_acc_rendir5($data){
    $this->db->select('m.id_p_items,
                         m.id_enlace,
                         m.id_partidad_presupuestaria,
                         m.id_ccnu,
                         m.especificacion,
                         m.id_unidad_medida,
                         m.cantidad,
                         m.i,
                         m.ii,
                         m.iii,
                         m.iv,
                         m.cant_total_distribuir,
                         m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                         m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                         m.fecha_desde,
                         m.fecha_hasta,
                         pp.codigopartida_presupuestaria,
                         pp.desc_partida_presupuestaria,
                         cc.codigo_ccnu,
                         cc.desc_ccnu,
                         un.desc_unidad_medida,
                         pcc.id_accion_centralizada,
                         pcc.id_obj_comercial,
                         pcc.id_programacion,
                         ff.id_estado,
                         ff.id_fuente_financiamiento,
                         ff.porcentaje,
                         fr.desc_fuente_financiamiento,
                         ac.desc_accion_centralizada,
                         ob.desc_objeto_contrata,
                         re.trimestre,
                         tr.descripcion_trimestre
                         '							
                    );
    $this->db->from('programacion.p_items m');
    $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
    $this->db->join('programacion.ccnu cc','cc.codigo_ccnu = m.id_ccnu', 'left');
    $this->db->join('programacion.unidad_medida un','un.id_unidad_medida = m.id_unidad_medida', 'left');
    $this->db->join('programacion.p_acc_centralizada pcc','pcc.id_p_acc_centralizada = m.id_enlace', 'left');
    $this->db->join('programacion.p_ffinanciamiento ff','ff.id_p_items = m.id_p_items', 'left');
    $this->db->join('programacion.fuente_financiamiento fr','fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');
    $this->db->join('programacion.accion_centralizada ac','ac.id_accion_centralizada = pcc.id_accion_centralizada', 'left');
    $this->db->join('programacion.objeto_contrata ob','ob.id_objeto_contrata = pcc.id_obj_comercial', 'left');
    $this->db->join('programacion.rendidicion re','re.id_p_items = m.id_p_items', 'left');
    $this->db->join('programacion.trimestre tr','tr.id_trimestre = re.trimestre', 'left');
    $this->db->where('m.id_p_items', $data['id_p_items']);
    // $this->db->order_by('mc.id_p_items desc');
    $query = $this->db->get();
    $resultado = $query->row_array();
    return $resultado;
}

public function consultar_acc_centralizada5($id_programacion){
    $this->db->select('pac.id_p_acc_centralizada,
                       pac.id_programacion,
                       pac.id_accion_centralizada,
                       p.estatus,
                       ac.desc_accion_centralizada,
                       pac.id_obj_comercial,
                       oc.desc_objeto_contrata,
                       ip.id_ccnu,
                       ip.id_p_items,
                       ip.id_partidad_presupuestaria,
                       pp.codigopartida_presupuestaria,
                       pp.desc_partida_presupuestaria,
                       cc.codigo_ccnu,
                         cc.desc_ccnu,');
    $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pac.id_obj_comercial ');
    $this->db->join('programacion.accion_centralizada ac', 'ac.id_accion_centralizada = pac.id_accion_centralizada');
    $this->db->join('programacion.programacion p', 'p.id_programacion = pac.id_programacion');
    $this->db->join('programacion.p_items ip', 'ip.id_enlace = pac.id_p_acc_centralizada');
    $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = ip.id_partidad_presupuestaria', 'left');
    $this->db->join('programacion.ccnu cc','cc.codigo_ccnu = ip.id_ccnu', 'left');
    $this->db->where('pac.id_programacion', $id_programacion);
    $this->db->from('programacion.p_acc_centralizada pac');
    $query = $this->db->get();
    return $query->result_array();
}
public function consultar_proyectos55($id_programacion){
    $this->db->select('pp.id_p_proyecto,
                       pp.nombre_proyecto,
                       pp.id_programacion,
                       pp.id_obj_comercial,
                       p.estatus,
                       oc.desc_objeto_contrata,
                       ip.id_ccnu,
                       ip.id_p_items,
                       ip.id_partidad_presupuestaria,
                       pt.codigopartida_presupuestaria,
                       pt.desc_partida_presupuestaria,
                       cc.codigo_ccnu,
                        cc.desc_ccnu,');
    $this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = pp.id_obj_comercial');
    $this->db->join('programacion.programacion p', 'p.id_programacion = pp.id_programacion');
    $this->db->join('programacion.p_items ip', 'ip.id_enlace = pp.id_p_proyecto');

    $this->db->join('programacion.partida_presupuestaria pt','pt.id_partida_presupuestaria = ip.id_partidad_presupuestaria', 'left');
    $this->db->join('programacion.ccnu cc','cc.codigo_ccnu = ip.id_ccnu', 'left');
    $this->db->where('pp.id_programacion', $id_programacion);
    $this->db->from('programacion.p_proyecto pp');
    $query = $this->db->get();
    return $query->result_array();
}

public function consultar_item_modal_PY_bienes($data){
    $this->db->select('m.id_p_items,
                         m.id_enlace,
                         m.id_partidad_presupuestaria,
                         m.id_ccnu,
                         m.id_tip_obra, m.id_alcance_obra, m.id_obj_obra,
                         m.especificacion,
                         m.id_unidad_medida,
                         m.cantidad,
                         m.i,
                         m.ii,
                         m.iii,
                         m.iv,
                         m.cant_total_distribuir,
                         m.costo_unitario, m.precio_total, m.alicuota_iva, m.iva_estimado, m.monto_estimado,
                         m.est_trim_1, m.est_trim_2, m.est_trim_3, m.est_trim_4, m.estimado_total_t_acc,
                         m.fecha_desde,
                         m.fecha_hasta,
                         pp.codigopartida_presupuestaria,
                         pp.desc_partida_presupuestaria,
                         cc.codigo_ccnu,
                         cc.desc_ccnu,
                         un.desc_unidad_medida,
                         pcc.id_programacion, pcc.nombre_proyecto, pcc.id_obj_comercial ,
                         ff.id_estado,
                         ff.id_fuente_financiamiento,
                         ff.porcentaje,
                         fr.desc_fuente_financiamiento,
                       
                         ob.desc_objeto_contrata,
                         re.trimestre,
                         tr.descripcion_trimestre,
                         tpo.descripcion_tip_obr,
                         al.descripcion_alcance_obra,
                         obj.descripcion_obj_obra
                         '							
                    );
    $this->db->from('programacion.p_items m');
    $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = m.id_partidad_presupuestaria', 'left');
    $this->db->join('programacion.ccnu cc','cc.codigo_ccnu = m.id_ccnu', 'left');
    $this->db->join('programacion.unidad_medida un','un.id_unidad_medida = m.id_unidad_medida', 'left');
    $this->db->join('programacion.p_proyecto pcc','pcc.id_p_proyecto = m.id_enlace', 'left');


    $this->db->join('programacion.p_ffinanciamiento ff','ff.id_p_items = m.id_p_items', 'left');
    $this->db->join('programacion.fuente_financiamiento fr','fr.id_fuente_financiamiento = ff.id_fuente_financiamiento', 'left');

    $this->db->join('programacion.objeto_contrata ob','ob.id_objeto_contrata = pcc.id_obj_comercial', 'left');
    $this->db->join('programacion.rendidicion re','re.id_p_items = m.id_p_items', 'left');
    $this->db->join('programacion.trimestre tr','tr.id_trimestre = re.trimestre', 'left');        
    $this->db->join('programacion.tip_obra tpo','tpo.id_tip_obra = m.id_tip_obra', 'left');
    $this->db->join('programacion.alcance_obra al','al.id_alcance_obra = m.id_alcance_obra', 'left');
    $this->db->join('programacion.obj_obra obj','obj.id_obj_obra = m.id_obj_obra', 'left');
    $this->db->where('m.id_p_items', $data['id_p_items']);
    // $this->db->order_by('mc.id_p_items desc');
    $query = $this->db->get();
    $resultado = $query->row_array();
    return $resultado;
}


////////////////////////guardar rendir proyecto bienes
function guardar_rendi_bienes_py($data,$id_p_itemss){
    $this->db->select('max(e.id_rendicion) as id1');
    $query1 = $this->db->get('programacion.rendidicion e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ; 
    
    $data1 = array(
        'id_rendicion'		    => $id1,
        'rif_organoente' => $data['rif_organoente'],
        'id_programacion' => $data['id_programacion'],
        'id_enlace' => $data['id_enlace'],
        'id_p_acc' => $data['id_p_acc'],
        'id_proyecto' => $data['id_proyecto'],
        'id_tip_obra' => $data['id_tip_obra'],
        'id_alcance_obra' => $data['id_alcance_obra'],
        'id_obj_obra' => $data['id_obj_obra'],
        'codigopartida_presupuestaria' => $data['codigopartida_presupuestaria'],
        'id_p_items' => $data['id_p_items'],
        'desc_partida_presupuestaria' => $data['desc_partida_presupuestaria'],
        'codigo_ccnu' => $data['codigo_ccnu'],
        'desc_ccnu' => $data['desc_ccnu'],
        
        'id_obj_comercial' => $data['id_obj_comercial'],
        'desc_objeto_contrata' => $data['desc_objeto_contrata'],
        'estado' => $data['estado'],
        'id_fuente_financiamiento' => $data['id_fuente_financiamiento'],
        'desc_fuente_financiamiento' => $data['desc_fuente_financiamiento'],
        'porcentaje' => $data['porcentaje'],
        'fecha_desde' 		=> $data['fecha_desde'],
        'fecha_hasta' 		=> $data['fecha_hasta'],
       'especificacion' 		=> $data['especificacion'],
       'id_unidad_medida' 		 => $data['id_unidad_medida'],
       'cantidad' 		 => $data['cantidad'],
       'i' 		          => $data['i'],
       'ii' 		            => $data['ii'],
       'iii' 		            => $data['iii'],
       'iv' 		             => $data['iv'],
       'cant_total_distribuir'  => 0,
       'costo_unitario' 		    => $data['costo_unitario'],
     
       'precio_total' 		    => $data['precio_total'],
       'alicuota_iva' 		=> $data['alicuota_iva'],
       'iva_estimado' 		    => $data['iva_estimado'],
       'monto_estimado' 		=> $data['monto_estimado'],
       'est_trim_1' 		 => $data['est_trim_1'],
       'est_trim_2' 		 => $data['est_trim_2'],
       'est_trim_3' 		=> $data['est_trim_3'],
       'est_trim_4' 		 => $data['est_trim_4'],
       'estimado_total_t_acc' => $data['estimado_total_t_acc'],
       'costo_unitario_rend_ejecu' => $data['costo_unitario_rend_ejecu'],
       'precio_rend_ejecu' => $data['precio_rend_ejecu'],
       'selc_iva_rendi' => $data['selc_iva_rendi'],
       'iva_estimado_rend' => $data['iva_estimado_rend'],
       'total_rendi' => $data['total_rendi'],
       'paridad_rendi' => $data['paridad_rendi'],
       'subtotal_rendi' => $data['subtotal_rendi'],
       'id_modalida_rendi' => $data['id_modalida_rendi'],
       'sel_rif_nombre' => $data['sel_rif_nombre'],
       'num_contrato' => $data['num_contrato'],
       'fecha_contrato' => $data['fecha_contrato'],
       'selc_tipo_doc_contrata' => $data['selc_tipo_doc_contrata'],
       'selc_com_res_social' => $data['selc_com_res_social'],
       'monto3_rendim' => $data['monto3_rendim'],
       'nfactura_rendi' => $data['nfactura_rendi'],
       'datefactura_rendi' => $data['datefactura_rendi'],
       'base_imponible_rendi' => $data['base_imponible_rendi'],
       'selc_iva_rendi2' => $data['selc_iva_rendi2'],
       'monto_factura_rend' => $data['monto_factura_rend'],
       'total_pago_rendi' => $data['total_pago_rendi'],           
       'paridad_rendi_factura' => $data['paridad_rendi_factura'],
       'subtotal_rendi_factura' => $data['subtotal_rendi_factura'],
       'fecha_pago_rendi' => $data['fecha_pago_rendi'],
       'estatus' => $data['estatus'],
       'fecha_rendicion' => $data['fecha_rendicion'],
       'fecha_cam_estatus' => $data['fecha_cam_estatus'],
       'id_usuario' => $data['id_usuario'],
       'fecha30dias_notificacion' => $data['fecha30dias_notificacion'],
       'trimestre' => $data['trimestre'],
       'snc' => 0,
       
    );    
    $query=$this->db->insert('programacion.rendidicion',$data1);
    if ($query) {
        $this->db->where('id_p_items', $data['id_p_items']);
        $update = $this->db->update('programacion.p_items', $id_p_itemss);
        }
    return true;
}
public function rendir($id_programacion){
    $this->db->select('*');
    
    $this->db->where('pac.id_programacion', $id_programacion);
    $query = $this->db->get('programacion.rendidicion pac');
    return $query->result_array();
}
}

