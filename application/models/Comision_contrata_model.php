<?php
    class Comision_contrata_model extends CI_model{
        private $table = "comisiones.comision";
        private $table2 = "comisiones.certificado";

        function check_logger_commission($rif_organoente){
            $this->db->select('c.id_comision,c.rif_organoente,c.observacion,c.id_status,c.snc,c.tipo_comi, c.fecha_desig, 
            c,num_acto, c.fecha_acto, c.acto_adm, c.dura_com_desde, c.dura_com_hasta, stu.desc_status, nto.desc_status_snc,
             act.desc_acto_admin, c.snc');
            $this->db->from('comisiones.comision c');
            $this->db->join('comisiones.status_comision stu', 'stu.id_status = c.id_status');
            $this->db->join('comisiones.notificacion_comision nto', 'nto.id_status_snc = c.snc'); 
            $this->db->join('comisiones.acto_admin act', 'act.id_acto_admin = c.acto_adm');           

            $this->db->where('rif_organoente', $rif_organoente);
            $this->db->where('c.id_status', 1);

        

            $query = $this->db->get();
            return $query->result_array();
        }
        function check_logger_commission_snc(){
            $this->db->select('c.id_comision,c.rif_organoente,c.observacion,c.id_status,c.snc,c.tipo_comi, c.fecha_desig, 
            c,num_acto, c.fecha_acto, c.acto_adm, c.dura_com_desde, c.dura_com_hasta, stu.desc_status, nto.desc_status_snc,
             act.desc_acto_admin, c.snc');
            $this->db->from('comisiones.comision c');
            $this->db->join('comisiones.status_comision stu', 'stu.id_status = c.id_status');
            $this->db->join('comisiones.notificacion_comision nto', 'nto.id_status_snc = c.snc'); 
            $this->db->join('comisiones.acto_admin act', 'act.id_acto_admin = c.acto_adm'); 
            $this->db->where('c.id_status', 1);


           // $this->db->where('rif_organoente', $rif_organoente);
        

            $query = $this->db->get();
            return $query->result_array();
        }
        function logger_type_sncinactivo(){
            $this->db->select('c.id_comision,c.rif_organoente,c.observacion,c.id_status,c.snc,c.tipo_comi, c.fecha_desig, 
            c,num_acto, c.fecha_acto, c.acto_adm, c.dura_com_desde, c.dura_com_hasta, stu.desc_status, nto.desc_status_snc,
             act.desc_acto_admin, c.snc');
            $this->db->from('comisiones.comision c');
            $this->db->join('comisiones.status_comision stu', 'stu.id_status = c.id_status');
            $this->db->join('comisiones.notificacion_comision nto', 'nto.id_status_snc = c.snc'); 
            $this->db->join('comisiones.acto_admin act', 'act.id_acto_admin = c.acto_adm'); 
            $this->db->where('c.id_status', 2);


           // $this->db->where('rif_organoente', $rif_organoente);
        

            $query = $this->db->get();
            return $query->result_array();
        }
        function logger_type_sncactivo(){
            $this->db->select('c.id_comision,c.rif_organoente,c.observacion,c.id_status,c.snc,c.tipo_comi, c.fecha_desig, 
            c,num_acto, c.fecha_acto, c.acto_adm, c.dura_com_desde, c.dura_com_hasta, stu.desc_status, nto.desc_status_snc,
             act.desc_acto_admin, c.snc');
            $this->db->from('comisiones.comision c');
            $this->db->join('comisiones.status_comision stu', 'stu.id_status = c.id_status');
            $this->db->join('comisiones.notificacion_comision nto', 'nto.id_status_snc = c.snc'); 
            $this->db->join('comisiones.acto_admin act', 'act.id_acto_admin = c.acto_adm'); 
            $this->db->where('c.id_status', 1);


           // $this->db->where('rif_organoente', $rif_organoente);
        

            $query = $this->db->get();
            return $query->result_array();
        }
        function check_logger_commission2($rif_organoente){
            $this->db->select('c.id_comision,c.rif_organoente,c.observacion,c.id_status,c.snc,c.tipo_comi, c.fecha_desig, c,num_acto, c.fecha_acto, 
            c.acto_adm, c.dura_com_desde, c.dura_com_hasta, stu.desc_status, nto.desc_status_snc, act.desc_acto_admin,c.snc');
            $this->db->from('comisiones.comision c');
            $this->db->join('comisiones.status_comision stu', 'stu.id_status = c.id_status');
            $this->db->join('comisiones.notificacion_comision nto', 'nto.id_status_snc = c.snc'); 
            $this->db->join('comisiones.acto_admin act', 'act.id_acto_admin = c.acto_adm');           

            $this->db->where('c.rif_organoente', $rif_organoente);
            $this->db->where('c.snc', 2);
            $this->db->where('c.id_status', 1);

            $query = $this->db->get();
            return $query->result_array();
        }
        function check_logger_commissionsnc1(){
            $this->db->select('c.id_comision,c.rif_organoente,c.observacion,c.id_status,c.snc,c.tipo_comi, c.fecha_desig, c,num_acto, c.fecha_acto, 
            c.acto_adm, c.dura_com_desde, c.dura_com_hasta, stu.desc_status, nto.desc_status_snc, act.desc_acto_admin,c.snc');
            $this->db->from('comisiones.comision c');
            $this->db->join('comisiones.status_comision stu', 'stu.id_status = c.id_status');
            $this->db->join('comisiones.notificacion_comision nto', 'nto.id_status_snc = c.snc'); 
            $this->db->join('comisiones.acto_admin act', 'act.id_acto_admin = c.acto_adm');           

           // $this->db->where('c.rif_organoente', $rif_organoente);
            $this->db->where('c.snc', 2);
            $this->db->where('c.id_status', 1);

            $query = $this->db->get();
            return $query->result_array();
        }
        function check_logger_commissionsnc3inac(){
            $this->db->select('c.id_comision,c.rif_organoente,c.observacion,c.id_status,c.snc,c.tipo_comi, c.fecha_desig, c,num_acto, c.fecha_acto, 
            c.acto_adm, c.dura_com_desde, c.dura_com_hasta, stu.desc_status, nto.desc_status_snc, act.desc_acto_admin,c.snc');
            $this->db->from('comisiones.comision c');
            $this->db->join('comisiones.status_comision stu', 'stu.id_status = c.id_status');
            $this->db->join('comisiones.notificacion_comision nto', 'nto.id_status_snc = c.snc'); 
            $this->db->join('comisiones.acto_admin act', 'act.id_acto_admin = c.acto_adm');           

           // $this->db->where('c.rif_organoente', $rif_organoente);
            $this->db->where('c.snc', 2);
            $this->db->where('c.id_status', 2);

            $query = $this->db->get();
            return $query->result_array();
        }
        
        function logger_commission($data){
            $p='Comisiòn';
            $r=$data['unidad'];
            $concatenated_variable = (string) $p . ' ' . (string) $r;
            $tipo = $data['tipo_comi'];
            if ($tipo == 1) {
                $nombre = $concatenated_variable;
                $desde=  date("Y-m-d");
                $hasta = date("Y-m-d"); 
            }else {
                $nombre = $data['observacion'];
                $desde=$data['dura_com_desde'];
                $hasta =$data['dura_com_hasta']; 
            }

            if ( $data['fecha_gaceta'] == '') {
                
                $fecha_gaceta = date("Y-m-d"); 
            }else {
                $fecha_gaceta = $data['fecha_gaceta'];
            }
            $this->db->select('max(e.id_comision) as id1');
            $query1 = $this->db->get('comisiones.comision e');
            $response4 = $query1->row_array();
            $id1 = $response4['id1'] + 1 ; 
            $data1 = array(
                'id_comision'           => $id1,
               'rif_organoente'             => $data['rif_organoente'],
               'tipo_comi'             => $data['tipo_comi'],
               'observacion'           => $nombre,
               'dura_com_desde'           => $desde,
               'dura_com_hasta'           => $hasta,
               'fecha_desig'             => $data['datedsg'],
               'acto_adm'             => $data['acto'],
               'num_acto'             => $data['nacto'],
               'fecha_acto'             => $data['facto'],

               'gaceta'             => $data['gaceta'],
               'fecha_gaceta'             => $fecha_gaceta,


               'fecha_notifiacion'             => $data['fecha_notifiacion'],


               'id_usuario'             => $data['id_usuario'],
               'fecha_creacion'             => $data['fecha_creacion'],
               'snc'             => $data['snc'],
               'id_status'             => $data['id_status'],               
               'fecha_cambi_statu'             => $data['fecha_cambi_statu'],      
           );
       //    print_r($data1);die;

            $this->db->insert('comisiones.comision',$data1);
            return true;
        }
        public function get_employees()
        { 
            $this->db->select('id_comision, rif_organoente, tipo_comision, cedula, nombre, apellido');
           // $this->db->where('c.id_comision', $data['id_comision']);

            $query = $this->db->get('comisiones.miembros');
            return $query->result();
        }

        public function check_tipo_com(){
            $this->db->select('id_tipo_comision, descripcion');
            $this->db->from('comisiones.tipo_comision');
            $this->db->order_by('id_tipo_comision ASC');
            $query = $this->db->get();
            return $result = $query->result_array();
        }
        public function check_areas(){
            $this->db->select('id_area_miembro, desc_area_miembro');
            $this->db->from('comisiones.area_miembro');
            $this->db->order_by('id_area_miembro ASC');
            $query = $this->db->get();
            return $result = $query->result_array();
        }
        public function check_espec(){
            $this->db->select('id_academico, desc_academico');
            $this->db->from('comisiones.academico');
            $this->db->order_by('id_academico ASC');
            $query = $this->db->get();
            return $result = $query->result_array();
        }
        public function check_organo(){
            $this->db->select('rif, descripcion');
            $this->db->from('public.organoente');
            $this->db->where('certificaciones', '0');
           // $this->db->order_by('id_academico ASC');
            $query = $this->db->get();
            return $result = $query->result_array();
        }
        public function check_tipo(){
            $this->db->select('id_tp_miembro, desc_tp_miembro');
            $this->db->from('comisiones.tp_miembro');
            $this->db->order_by('id_tp_miembro ASC');
            $query = $this->db->get();
            return $result = $query->result_array();
        }
        public function check_comision($data){
            $this->db->select('c.id_comision,c.rif_organoente');
            $this->db->from('comisiones.comision c');
            $this->db->where('c.id_comision', $data['id_comision']);
            $this->db->order_by('c.id_comision ASC');
            $query = $this->db->get();
            $resultado = $query->row_array();
            return $resultado;
	    } 
        public function check_comision_inf($data){
            $this->db->select('c.id_miembros,c.id_comision,c.rif_organoente');
            $this->db->from('comisiones.miembros c');
            $this->db->where('c.id_miembros', $data['id_miembros']);
            $this->db->order_by('c.id_miembros ASC');
            $query = $this->db->get();
            $resultado = $query->row_array();
            return $resultado;
	    }
       
        public function save_miembros($data){
            $this->db->select('max(e.id_miembros) as id1');
                $query1 = $this->db->get('comisiones.miembros e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ; 
            $data1 = array(
                'id_miembros'             => $id1,                 
                'id_comision'             => $data['id_comision'],                
                'rif_organoente'                   => $data['rif_organoente'],
                //'tipo_comision'                   => 1, ///la comision se elije antes no significa nada borrar de la tabla 
                'cedula'                   => $data['cedula'],
                'nombre'                   => $data['nombre'],
                'apellido'                   => $data['apellido'],
                'id_area_miembro'                   => $data['id_area_miembro'],
                'id_tp_miembro'                   => $data['id_tp_miembro'],
                'correo'                   => $data['correo'],
                'telf'                   => $data['telf'],
                'id_status'                   => 1,
                'fecha_cambi_statu'                   => date('Y-m-d'),
                'id_usuario'                   => $this->session->userdata('id_user'),
                'fecha_creacion'                   => date('Y-m-d'),
                'obj_comision'                   => $data['obj_comision'],
                'id_remplazo'                   => 1,
                'id_cert'                   => 1,// no certificado
                'snc'                   => 1,// no enviado
               // 'inf_car'                   => 1,// no cargada






 

            );
       //print_r($data1);die;
            $query=$this->db->insert('comisiones.miembros',$data1);
            return true;
        }
        public function check_miembros($data){
            $this->db->select('pi2.id_miembros,pi2.cedula');
            $this->db->where('pi2.id_comision', $data['id_comision']);
            $query = $this->db->get('comisiones.miembros pi2');
            return $query->result_array();
        }
        public function check_miembros1($data){
            $this->db->select('pi2.id_miembros,pi2.cedula,pi2.nombre,pi2.apellido');
            $this->db->where('pi2.id_miembros', $data['id_miembro']);
            $query = $this->db->get('comisiones.miembros pi2');
            return $query->result_array();
        }
    

        function check_miemb($id_comision){

            $this->db->select('pi2.id_miembros, pi2.id_comision, pi2.rif_organoente, pi2.cedula, pi2.nombre, pi2.apellido, 
            pi2.id_area_miembro, c2.desc_area_miembro, c3.desc_tp_miembro, st.desc_status,pi2.id_status');
                $this->db->join('comisiones.area_miembro c2','c2.id_area_miembro = pi2.id_area_miembro');
                $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
                $this->db->join('comisiones.status_comision st','st.id_status = pi2.id_status');

                $this->db->where('pi2.id_comision', $id_comision);
                $this->db->where('pi2.id_status', 1);

                $this->db->from('comisiones.miembros pi2');
                $query = $this->db->get();
                return $query->result_array();
        }
        function check_miemb_certi($id_comision){

            $this->db->select('pi2.id_miembros, pi2.id_comision, pi2.rif_organoente, pi2.cedula, pi2.nombre, pi2.apellido, 
            pi2.id_area_miembro, c2.desc_area_miembro, c3.desc_tp_miembro, st.desc_status,pi2.id_status,pi2.id_cert, pi2.snc');
                $this->db->join('comisiones.area_miembro c2','c2.id_area_miembro = pi2.id_area_miembro');
                $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
                $this->db->join('comisiones.status_comision st','st.id_status = pi2.id_status');

                $this->db->where('pi2.id_comision', $id_comision);
                $this->db->where('pi2.id_status', 1);

                $this->db->from('comisiones.miembros pi2');
                $query = $this->db->get();
                return $query->result_array();
        }
        function check_miemb2($data){

            $this->db->select('pi2.id_miembros, pi2.id_comision, pi2.rif_organoente, pi2.cedula, pi2.nombre, pi2.apellido, pi2.id_area_miembro, 
            c2.desc_area_miembro, c3.desc_tp_miembro');
                $this->db->join('comisiones.area_miembro c2','c2.id_area_miembro = pi2.id_area_miembro');
                $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
                $this->db->where('pi2.id_comision', $data['id']);
                $this->db->from('comisiones.miembros pi2');
                $query = $this->db->get();
                return $query->result_array();
        }
        public function enviar_snc($data, $des_unidad, $codigo_onapre, $rif){
            $this->db->select('total');
            $this->db->where('id_comision', $data['id']);            

                        $query1 = $this->db->get('comisiones.impar_view');                
                        $response4 = $query1->row_array();
                        $numero = $response4['total'] ;

                        if ($numero % 2 == 0){
                            return false;
                } else {
                    $qrcode_data = $this->_generate_data_qrcode();
                    $this->db->select('max(e.n) as id1');
                    $query1 = $this->db->get('comisiones.comision e');
                    $response4 = $query1->row_array();
                    $id1 = $response4['id1'] + 1 ;
                    $this->db->select('rif_organoente as rif_cont');
                    $this->db->where('id_comision', $data['id']);            
                    $query2 = $this->db->get('comisiones.comision e');
                    $response5 = $query2->row_array();
                    $rif_cont = $response5['rif_cont'];

                    $p='Nº SNC-NMC-2024-000';
                    $r=$id1;
                    $concatenated_variable = (string) $p . '' . (string) $r;


                    $data1 = array('snc' => '2',// enviado al snc
                                'id_usuario' => $this->session->userdata('id_user'),
                                'fecha_notifiacion' => date('Y-m-d h:i:s'),
                                'n' => $id1,
                                'comprobante' => $concatenated_variable,
                                'qrcode_path'   => $this->_generate_qrcode($rif_cont,$qrcode_data), //memanggil method _generate_qrcode dengan mengirimkan dua parameter yaitu data fullname dan data qrcode
                                'qrcode_data'   => $qrcode_data

                            );
                $this->db->where('id_comision', $data['id']);
                $update = $this->db->update('comisiones.comision', $data1);
                    return true;

                }
                
        }
        public function enviar_snc1($data, $des_unidad, $codigo_onapre, $rif){
            $this->db->select('total');
            $this->db->where('id_comision', $data['id']);            

                        $query1 = $this->db->get('comisiones.impar_view');                
                        $response4 = $query1->row_array();
                        $numero = $response4['total'] ;

                        if ($numero % 2 == 0){
                            return false;
                } else {
                    $qrcode_data = $this->_generate_data_qrcode();
                    $this->db->select('max(e.n) as id1');
                    $query1 = $this->db->get('comisiones.comision e');
                    $response4 = $query1->row_array();
                    $id1 = $response4['id1'] + 1 ;

                    $this->db->select('rif_organoente as rif_cont');
                    $this->db->where('id_comision', $data['id']);            
                    $query2 = $this->db->get('comisiones.comision e');
                    $response5 = $query2->row_array();
                    $rif_cont = $response5['rif_cont'];

                    $p='Nº SNC-NMC-2024-000';
                    $r=$id1;
                    $concatenated_variable = (string) $p . '' . (string) $r;


                    $data1 = array('snc' => '2',// enviado al snc
                                'id_usuario' => $this->session->userdata('id_user'),
                                //'fecha_notifiacion' => date('Y-m-d h:i:s'),
                                'n' => $id1,
                                'comprobante' => $concatenated_variable,
                                'qrcode_path'   => $this->_generate_qrcode($rif_cont,$qrcode_data), //memanggil method _generate_qrcode dengan mengirimkan dua parameter yaitu data fullname dan data qrcode
                                'qrcode_data'   => $qrcode_data

                            );
                $this->db->where('id_comision', $data['id']);
                $update = $this->db->update('comisiones.comision', $data1);
                    return true;

                }
                
        }
        function consulta_total_objeto_acc($data1){ //da totales agrupados por bienes, servicio, obras
    
            $query = $this->db->query("SELECT c.id_comision, c.rif_organoente,c.observacion, 
            c.id_status, c.fecha_creacion, c.fecha_notifiacion, c.tipo_comi, c.fecha_desig, c.num_acto, c.fecha_acto,
             c.acto_adm, c.dura_com_desde,c.dura_com_hasta, c.gaceta, c.fecha_gaceta, o.descripcion, tc.descripcion as tipo_comision,
             ac.desc_acto_admin
            
                 FROM comisiones.comision c 
                --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                join public.organoente o on o.rif = c.rif_organoente	
                join comisiones.tipo_comision tc on tc.id_tipo_comision = c.tipo_comi
                join comisiones.acto_admin ac on ac.id_acto_admin = c.acto_adm	


                    
                 where c.id_comision = '$data1' 
                  ");
                if($query->num_rows()>0){
                    return $query->result();
                }
                else{
                    return NULL;
                }
            }
            function consulta_mib($data2){ //da totales agrupados por bienes, servicio, obras
    
                $query = $this->db->query("SELECT  cedula, nombre, apellido, id_area_miembro, id_tp_miembro,id_status
                
                     FROM comisiones.miembros          
                     where id_comision = '$data2'  and id_tp_miembro = '1' and id_area_miembro ='1' and id_status ='1'
                      ");
                    if($query->num_rows()>0){
                        return $query->result();
                    }
                    else{
                        return NULL;
                    }
                }
                function consulta_mib_s_j($data3){ //da totales agrupados por bienes, servicio, obras
    
                    $query = $this->db->query("SELECT  cedula, nombre, apellido, id_area_miembro, id_tp_miembro,id_status
                    
                         FROM comisiones.miembros          
                         where id_comision = '$data3'  and id_tp_miembro = '2' and id_area_miembro ='1'  and id_status ='1'
                          ");
                        if($query->num_rows()>0){
                            return $query->result();
                        }
                        else{
                            return NULL;
                        }
                    }
                    function consulta_mib_tec($data4){ //da totales agrupados por bienes, servicio, obras
    
                        $query = $this->db->query("SELECT  cedula, nombre, apellido, id_area_miembro, id_tp_miembro,id_status
                        
                             FROM comisiones.miembros          
                             where id_comision = '$data4'  and id_tp_miembro = '1' and id_area_miembro ='2' and id_status ='1'
                              ");
                            if($query->num_rows()>0){
                                return $query->result();
                            }
                            else{
                                return NULL;
                            }
                        }
                        function consulta_mib_s_t($data3){ //da totales agrupados por bienes, servicio, obras
    
                            $query = $this->db->query("SELECT  cedula, nombre, apellido, id_area_miembro, id_tp_miembro,id_status
                            
                                 FROM comisiones.miembros          
                                 where id_comision = '$data3'  and id_tp_miembro = '2' and id_area_miembro ='2' and id_status ='1'
                                  ");
                                if($query->num_rows()>0){
                                    return $query->result();
                                }
                                else{
                                    return NULL;
                                }
                            }
                            function consulta_mib_fin($data6){ //da totales agrupados por bienes, servicio, obras
    
                                $query = $this->db->query("SELECT  cedula, nombre, apellido, id_area_miembro, id_tp_miembro,id_status
                                
                                     FROM comisiones.miembros          
                                     where id_comision = '$data6'  and id_tp_miembro = '1' and id_area_miembro ='3' and id_status ='1'
                                      ");
                                    if($query->num_rows()>0){
                                        return $query->result();
                                    }
                                    else{
                                        return NULL;
                                    }
                                }
                                function consulta_mib_s_fin($data7){ //da totales agrupados por bienes, servicio, obras
    
                                    $query = $this->db->query("SELECT  cedula, nombre, apellido, id_area_miembro, id_tp_miembro,id_status
                                    
                                         FROM comisiones.miembros          
                                         where id_comision = '$data7'  and id_tp_miembro = '2' and id_area_miembro ='3' and id_status ='1'
                                          ");
                                        if($query->num_rows()>0){
                                            return $query->result();
                                        }
                                        else{
                                            return NULL;
                                        }
                                    }
                                    function consulta_mib_secre($data9){ //da totales agrupados por bienes, servicio, obras
    
                                        $query = $this->db->query("SELECT  cedula, nombre, apellido, id_area_miembro, id_tp_miembro ,id_status
                                        
                                             FROM comisiones.miembros          
                                             where id_comision = '$data9'  and id_tp_miembro = '1' and id_area_miembro ='5' and id_status ='1'
                                              ");
                                            if($query->num_rows()>0){
                                                return $query->result();
                                            }
                                            else{
                                                return NULL;
                                            }
                                        }
                                        function consulta_mib_s_decre($data10){ //da totales agrupados por bienes, servicio, obras
    
                                            $query = $this->db->query("SELECT  cedula, nombre, apellido, id_area_miembro, id_tp_miembro,id_status
                                            
                                                 FROM comisiones.miembros          
                                                 where id_comision = '$data10'  and id_tp_miembro = '2' and id_area_miembro ='5' and id_status ='1'
                                                  ");
                                                if($query->num_rows()>0){
                                                    return $query->result();
                                                }
                                                else{
                                                    return NULL;
                                                }
                                            }
                                            function comprobante($data1){
                                                //$id=$data['numero_proceso'];
                                                $query = $this->db->query("SELECT   id_comision,comprobante
                                            
                                                 FROM comisiones.comision 
                                                --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                                                --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
                                                --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
                                                 where id_comision = '$data1'");
                                                if($query->num_rows()>0){
                                                    return $query->result();
                                                }
                                                else{
                                                    return NULL;
                                                }
                                            }

                                            function con_qr($data11){ //
    
                                                $query = $this->db->query("SELECT  qrcode_path                                                
                                                     FROM comisiones.comision          
                                                     where id_comision = '$data11' 
                                                      ");
                                                    if($query->num_rows()>0){
                                                        return $query->result();
                                                    }
                                                    else{
                                                        return NULL;
                                                    }
                                                }


                                            ///////////////////qr
public function save_data()
{
 //memanggil method _generate_data_qrcode untuk proses generate data qrcode
 $qrcode_data = $this->_generate_data_qrcode();

 $data = array(
           'fullname'      => $this->input->post('fullname'),
           'email'       => $this->input->post('email'),
           'qrcode_path'   => $this->_generate_qrcode($this->input->post('fullname'),$qrcode_data), //memanggil method _generate_qrcode dengan mengirimkan dua parameter yaitu data fullname dan data qrcode
           'qrcode_data'   => $qrcode_data
       );
       $this->db->insert($this->table,$data);
}
//generate qrcode data
public function _generate_data_qrcode()
{
 $this->load->helper('string');
 $code = strtoupper(random_string('alnum', 6));
 //proses cek data qrcode untuk memastikan data qrcode bersifat unik
 $cek_data=$this->get_data($code); 
 if(!empty($cek_data)){
  //jika data qrcode ada yang sama, maka karakter terakhir dari data qrcode
  //akan di-replace dengan angka jumlah data yang sama + 1
    $code = substr_replace($code, count($cek_data)+1, 5);
 }
 return $code;
}
public function _generate_data_qrcode2()
{
 $this->load->helper('string');
 $code = strtoupper(random_string('alnum', 6));
 //proses cek data qrcode untuk memastikan data qrcode bersifat unik
 $cek_data=$this->get_data2($code); 
 if(!empty($cek_data)){
  //jika data qrcode ada yang sama, maka karakter terakhir dari data qrcode
  //akan di-replace dengan angka jumlah data yang sama + 1
    $code = substr_replace($code, count($cek_data)+1, 5);
 }
 return $code;
}
//generate image qrcode
public function _generate_qrcode($fullname, $data_code)
{
 //load libraru qrcode
  $this->load->library('ciqrcode');

  //persiapan direktori untuk menyimpan image qrcode hasil generate. 
  //Path dan nama direktori bisa kalian sesuaikan dengan kebutuhan kalian
  $directory = "./assets/img/qrcodemiembros";
  //persiapan filename untuk image qrcode. Diambil dari data fullname tanpa spasi + 3 digit angka random
  $file_name = str_replace(" ", "", strtolower($fullname)).rand(pow(10, 2), pow(10, 3)-1);

  //pembuatan direktori jika belum ada
  if (!is_dir($directory)) {
     mkdir($directory, 777, TRUE);
  }

  $config['cacheable']    = true; //boolean, the default is true
  $config['quality']      = true; //boolean, the default is true
  $config['size']         = '1024'; //interger, the default is 1024
  $config['black']        = array(224,255,255); // array, default is array(255,255,255)
  $config['white']        = array(70,130,180); // array, default is array(0,0,0)
  $this->ciqrcode->initialize($config);

  //menyisipkan ekstensi png pada filename qrcode
  $image_name=$file_name.'.png';

  $params['data'] = $data_code; //data yang akan di jadikan QR CODE
  $params['level'] = 'H'; //H=High
  $params['size'] = 10;
  $params['savename'] = $directory.'/'.$image_name;
 
  $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
  
  return  $image_name;
}
public function _generate_qrcode2($fullname, $data_code)
{
 //load libraru qrcode
  $this->load->library('ciqrcode');

  //persiapan direktori untuk menyimpan image qrcode hasil generate. 
  //Path dan nama direktori bisa kalian sesuaikan dengan kebutuhan kalian
  $directory = "./assets/img/qe_certi";
  //persiapan filename untuk image qrcode. Diambil dari data fullname tanpa spasi + 3 digit angka random
  $file_name = str_replace(" ", "", strtolower($fullname)).rand(pow(10, 2), pow(10, 3)-1);

  //pembuatan direktori jika belum ada
  if (!is_dir($directory)) {
     mkdir($directory, 777, TRUE);
  }

  $config['cacheable']    = true; //boolean, the default is true
  $config['quality']      = true; //boolean, the default is true
  $config['size']         = '1024'; //interger, the default is 1024
  $config['black']        = array(224,255,255); // array, default is array(255,255,255)
  $config['white']        = array(70,130,180); // array, default is array(0,0,0)
  $this->ciqrcode->initialize($config);

  //menyisipkan ekstensi png pada filename qrcode
  $image_name=$file_name.'.png';

  $params['data'] = $data_code; //data yang akan di jadikan QR CODE
  $params['level'] = 'H'; //H=High
  $params['size'] = 10;
  $params['savename'] = $directory.'/'.$image_name;
 
  $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
  
  return  $image_name;
}

public function get_data($qrcode_data="")
{
 $this->db->select('*')
       ->from($this->table);

    if(!empty($qrcode_data)){
     $this->db->where('qrcode_data', $qrcode_data);
    }

    $res = $this->db->get();
    return $res->result_array();
}
public function get_data2($qrcode_data="")
{
 $this->db->select('*')
       ->from($this->table2);

    if(!empty($qrcode_data)){
     $this->db->where('qrcode_data', $qrcode_data);
    }

    $res = $this->db->get();
    return $res->result_array();
}

function consulta_b($data){
    $this->db->select('gaceta, fecha_gaceta,id_comision');
    $this->db->from('comisiones.comision');
    $this->db->where('id_comision', $data['id_comision']);
   // $this->db->order_by("codigo_b", "Asc");
    $query = $this->db->get();
    if (count($query->result()) > 0) {
        return $query->row();
    }
}
function editar_b($data){
    $this->db->where('id_comision', $data['id_comision']);
    $update = $this->db->update('comisiones.comision', $data);
    return true;
}
public function incactiva($data){
                $data1 = array('id_status' => '2',// inactiva
                        'id_usuario' => $this->session->userdata('id_user'),
                        'fecha_cambi_statu' => date('Y-m-d h:i:s'),
                    );
        $this->db->where('id_comision', $data['id']);
        $update = $this->db->update('comisiones.comision', $data1);
            return true;

        
        
}
public function incactiva_mb($data){
    $data1 = array('id_status' => '2',// inactiva
            'id_usuario' => $this->session->userdata('id_user'),
            'fecha_cambi_statu' => date('Y-m-d h:i:s'),
        );
$this->db->where('id_miembros', $data['id']);
$update = $this->db->update('comisiones.miembros', $data1);
return true;



}
public function save_inff($data){
    $this->db->select('max(e.id_inf_academ) as id1');
        $query1 = $this->db->get('comisiones.inf_academ e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ; 
    $data1 = array( 
        'id_inf_academ'             => $id1,                 
        'id_comision'             => $data['id_comision'],
        'id_academico'             => $data['fm_ac'], 
        'id_miembros'             => $data['id_miembros'],                     
        'titulo'                   => $data['titulo'],
        'anio_inicio'                   => $data['anioi'],
        'anio_fin'                   => $data['anioc'],
        'cursando'                   => $data['curso'],
    );
//print_r($data1);die;
    $query=$this->db->insert('comisiones.inf_academ',$data1);
    return true;
}
public function save_exp($data){
    $this->db->select('max(e.id_inf_exp5) as id1');
        $query1 = $this->db->get('comisiones.inf_exp5 e');
        $response4 = $query1->row_array();
        $id1 = $response4['id1'] + 1 ;  
    $data1 = array( 
        'id_inf_exp5'             => $id1,                 
        'id_comision'             => $data['id_comision'],
        'rif'             => $data['id_unidad'], 
        'id_miembros'             => $data['id_miembros'],                     
        'areas'                   => $data['area'],
        'cargo'                   => $data['cargo'],
        'desde'                   => $data['desde'],
        'hasta'                   => $data['hasta'],
        'act'                   => $data['act'],

    );
//print_r($data1);die;
    $query=$this->db->insert('comisiones.inf_exp5',$data1);
    return true;
}
function save41($data){
    $this->db->select('max(e.id_cap_contr_publ) as id1');
    $query1 = $this->db->get('comisiones.cap_contr_publ e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ; 

    $rif_contrat = $data['sel_rif_nombre'];
    if ($rif_contrat == '') {
       
        $sel_rif_nombre = 0;
        $exit_rnc=0;
        $nombre_contratista=0;

    }else {
    
        $sel_rif_nombre = $data['sel_rif_nombre'];
        $nombre_contratista = $data['nombre_contratista'];
        $exit_rnc=1;



    }
    $data1 = array(
        'id_cap_contr_publ'		    => $id1,
       'sel_rif_nombre' => $sel_rif_nombre,
       
       'nombre_contratista' => $nombre_contratista,
       'razon_social_no_rnc' => $data['razon_social_no_rnc'],
       
        'rif_contr_no_rnc' => $data['rif_contr_no_rnc'],
        'exit_rnc' =>  $exit_rnc,
        'namecurso' => $data['namecurso'],
        'horas' => $data['horas'],
        'ncertificado' => $data['ncertificado'],
        'fcerti' => $data['fcerti'],
        'vigencia' => $data['vigencia'],
       'id_miembros'           => $data['id_miembros'],
       'id_comision'           => $data['id_comision'],
             
    );    

    $query=$this->db->insert('comisiones.cap_contr_publ',$data1);
    
    return true;
}
function save45($data){
    $this->db->select('max(e.id_cap_comi_contr) as id1');
    $query1 = $this->db->get('comisiones.cap_comi_contr e');
    $response4 = $query1->row_array();
    $id1 = $response4['id1'] + 1 ; 

    $rif_contrat = $data['sel_rif_nombre'];
    if ($rif_contrat == '') {
       
        $sel_rif_nombre = 0;
        $exit_rnc=0;
        $nombre_contratista=0;

    }else {
    
        $sel_rif_nombre = $data['sel_rif_nombre'];
        $nombre_contratista = $data['nombre_contratista'];
        $exit_rnc=1;



    }
    $data1 = array(
        'id_cap_comi_contr'		    => $id1,
       'sel_rif_nombre' => $sel_rif_nombre,
       
       'nombre_contratista' => $nombre_contratista,
       'razon_social_no_rnc' => $data['razon_social_no_rnc'],
       
        'rif_contr_no_rnc' => $data['rif_contr_no_rnc'],
        'exit_rnc' =>  $exit_rnc,
        'namecurso' => $data['namecurso'],
        'horas' => $data['horas'],
        'ncertificado' => $data['ncertificado'],
        'fcerti' => $data['fcerti'],
        'vigencia' => $data['vigencia'],
       'id_miembros'           => $data['id_miembros'],
       'id_comision'           => $data['id_comision'],
             
    );    

    $query=$this->db->insert('comisiones.cap_comi_contr',$data1);
    
    return true;
}
public function carga_completa($data){
   
        $this->db->select('exit_rnc');
        $this->db->where('id_miembros', $data['id']);
        $query2 = $this->db->get('comisiones.cap_comi_contr');
        $response2 = $query2->row_array();
        $numero2 = $response2['exit_rnc'] ?? 0;

        if ($numero2 == 0) {
            $this->db->set('id_cert', '3'); // condicionado
            $this->db->where('id_miembros', $data['id']);
            $update = $this->db->update('comisiones.miembros');
            return true;

        } elseif($numero2 == '') {
            $this->db->set('id_cert', '3'); // certificado
            $this->db->where('id_miembros', $data['id']);
            $update = $this->db->update('comisiones.miembros');
            return true;
        } else {
            $this->db->set('id_cert', '2'); // certificado
            $this->db->where('id_miembros', $data['id']);
            $update = $this->db->update('comisiones.miembros');
            return true;
        }
        
    
            }

            function check_miemb_inf_ac($id_miembros){

                $this->db->select('pi2.id_inf_academ, pi2.id_academico, pi2.id_miembros, pi2.id_comision, pi2.titulo,
                pi2.anio_inicio, pi2.anio_fin, pi2.cursando, c2.desc_academico');
                     $this->db->join('comisiones.academico c2','c2.id_academico = pi2.id_academico');
                    // $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
                    // $this->db->join('comisiones.status_comision st','st.id_status = pi2.id_status');
    
                    $this->db->where('pi2.id_miembros', $id_miembros);
                    $this->db->from('comisiones.inf_academ pi2');
                    $query = $this->db->get();
                    return $query->result_array();
            }
            function check_miemb_inf_exp5($id_miembros){

                $this->db->select('pi2.rif,pi2.areas, pi2.cargo, pi2.desde, pi2.hasta');
                 //    $this->db->join('FROM public.organoente c2','c2.rif = pi2.rif');
                    // $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
                    // $this->db->join('comisiones.status_comision st','st.id_status = pi2.id_status');
    
                    $this->db->where('pi2.id_miembros', $id_miembros);
                    $this->db->from('comisiones.inf_exp5 pi2');
                    $query = $this->db->get();
                    return $query->result_array();
            }
            function check_miemb_inf_contr_pub($id_miembros){

                $this->db->select('sel_rif_nombre, rif_contr_no_rnc, razon_social_no_rnc, nombre_contratista, exit_rnc, namecurso, horas, ncertificado, fcerti, vigencia');
                 //    $this->db->join('FROM public.organoente c2','c2.rif = pi2.rif');
                    // $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
                    // $this->db->join('comisiones.status_comision st','st.id_status = pi2.id_status');
    
                    $this->db->where('id_miembros', $id_miembros);
                    $this->db->from('comisiones.cap_contr_publ');
                    $query = $this->db->get();
                    return $query->result_array();
            }
            function check_miemb_inf_cap($id_miembros){

                $this->db->select('sel_rif_nombre, rif_contr_no_rnc, razon_social_no_rnc, nombre_contratista, exit_rnc, namecurso, horas, ncertificado, fcerti, vigencia');
                 //    $this->db->join('FROM public.organoente c2','c2.rif = pi2.rif');
                    // $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = pi2.id_tp_miembro');
                    // $this->db->join('comisiones.status_comision st','st.id_status = pi2.id_status');
    
                    $this->db->where('id_miembros', $id_miembros);
                    $this->db->from('comisiones.cap_comi_contr');
                    $query = $this->db->get();
                    return $query->result_array();
            }

            public function consultar_t($data){
                $this->db->select('m.*');
                $this->db->from('comisiones.comision m');
               
                $this->db->where('m.id_comision', $data['id']);
            
                $query = $this->db->get();
                $resultado = $query->row_array();
                return $resultado;
            }
            public function guardar_proc_pag($data){
                // se guardan los fecha de vigencia 
                $qrcode_data = $this->_generate_data_qrcode2();
                $this->db->select('max(e.n) as id1');
                $query1 = $this->db->get('comisiones.certificado e');
                $response4 = $query1->row_array();
                $id1 = $response4['id1'] + 1 ;

                $this->db->select('rif_organoente as rif_cont');
                $this->db->where('id_comision', $data['id_mesualidad_ver']);            
                $query2 = $this->db->get('comisiones.comision');
                $response5 = $query2->row_array();
                $rif_cont = $response5['rif_cont'];

               

                $p='Nº SNC-CMC-2024-000';
                $r=$id1;
                $concatenated_variable = (string) $p . '' . (string) $r;

                $data1 = array(
                                //'status' => $data['status'],
                                // 'vigen_cert_desde' => $data['vigen_cert_desde'],
        
                                // 'vigen_cert_hasta' => $data['vigen_cert_hasta'],
                                'id_comision' => $data['id_mesualidad_ver'],
                                'fecha_creacion' => date('Y-m-d'),
                                'fecha_notifiacion' => date('Y-m-d'),

                           
                                'n' => $id1,
                                'comprobante' => $concatenated_variable,
                                'qrcode_path'   => $this->_generate_qrcode2($rif_cont,$qrcode_data), //memanggil method _generate_qrcode dengan mengirimkan dua parameter yaitu data fullname dan data qrcode
                                'qrcode_data'   => $qrcode_data
                                
                            );
                           
                                
            
                $this->db->insert('comisiones.certificado',$data1);
                //return true;
                
                $this->db->select('id_cert');
                $this->db->where('id_comision', $data['id_mesualidad_ver']);
                $this->db->where('id_status', 1);
                $query3 = $this->db->get('comisiones.miembros');
               // $response3 = $query3->result_array();
                
                if ($query3->num_rows() > 0) {               
                    $data5 = array(
                        //'status' => $data['status'],
                         'vigentedesde' => $data['vigen_cert_desde2'],

                         'vigentehasta' => $data['vigen_cert_hasta2'],
                         'snc' => 2,//notificado

                     
                    );                  
                        
                    $this->db->where('id_comision', $data['id_mesualidad_ver']);
                    $this->db->where('id_cert', 3);
                    $update = $this->db->update('comisiones.miembros', $data5);
                    $data6 = array(
                        //'status' => $data['status'],
                         'vigentedesde' => $data['vigen_cert_desde'],

                         'vigentehasta' => $data['vigen_cert_hasta'],
                         'snc' => 2,//notificado

                     
                    );  
                  
                    $this->db->where('id_comision', $data['id_mesualidad_ver']);
                        $this->db->where('id_cert', 2);

                        $update = $this->db->update('comisiones.miembros', $data6);
                            return true;

                } else {
                    return 0;
                }
                // foreach ($response3 as $row) {
                //     $idc = $row['id_cert'];
                //     if ($idc == 2) {
                //         $data5 = array(
                //             //'status' => $data['status'],
                //              'vigentedesde' => $data['vigen_cert_desde'],
    
                //              'vigentehasta' => $data['vigen_cert_hasta'],
                         
                //         );
                       
                            
                //         $this->db->where('id_comision', $data['id_mesualidad_ver']);
                //         $this->db->where('id_cert', 2);

                //         $update = $this->db->update('comisiones.miembros', $data5);
                //             return true;
                //     }else {

                //         $data6 = array(
                //             //'status' => $data['status'],
                //              'vigentedesde' => $data['vigen_cert_desde2'],
    
                //              'vigentehasta' => $data['vigen_cert_hasta2'],
                         
                //         );
                       
                            
                //         $this->db->where('id_comision', $data['id_mesualidad_ver']);
                //         $this->db->where('id_cert', 3);

                //         $update = $this->db->update('comisiones.miembros', $data6);
                //             return true;

                //     }
                // }
                   
               

            
            }
            
            function comprobante2($data1){
                //$id=$data['numero_proceso'];
                $query = $this->db->query("SELECT   id_comision,comprobante
            
                 FROM comisiones.certificado 
                --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
                --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
                 where id_comision = '$data1'");
                if($query->num_rows()>0){
                    return $query->result();
                }
                else{
                    return NULL;
                }
            }
            function cct($data1){
                //$id=$data['numero_proceso'];
                $query = $this->db->query("SELECT   *
            
                 FROM comisiones.certi_view
                --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
                --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
                 where id_comision = '$data1' and id_status = '1' and id_cert  > 1");
                 
                 
                if($query->num_rows()>0){
                    return $query->result();
                }
                else{
                    return NULL;
                }
            }
            function comin($data1){
                //$id=$data['numero_proceso'];
                $query = $this->db->query("SELECT   *
            
                 FROM comisiones.certi_view
                --  left join public.modalidad m on m.id_modalidad = c.id_modalidad
                --  left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
                --  join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
                 where id_comision = '$data1' and id_status = '1' 
                 order by id_area_miembro  ASC, id_tp_miembro ASC ");
                 
                if($query->num_rows()>0){
                    return $query->result();
                }
                else{
                    return NULL;
                }
            }
            function consulta_mb($data){
                $this->db->select('mb.*, c2.desc_area_miembro, c3.desc_tp_miembro');
                $this->db->from('comisiones.miembros mb');
                $this->db->join('comisiones.area_miembro c2','c2.id_area_miembro = mb.id_area_miembro');
                $this->db->join('comisiones.tp_miembro c3','c3.id_tp_miembro = mb.id_tp_miembro');
                $this->db->where('mb.id_miembros', $data['id_miembros']);
               // $this->db->order_by("codigo_b", "Asc");
                $query = $this->db->get();
                if (count($query->result()) > 0) {
                    return $query->row();
                }
            }
            public function llenar_area($data){
                $this->db->select('id_area_miembro, desc_area_miembro');
               // $this->db->where('pi2.id_area_miembro !=', $data['id_area_miembro']);
                $query = $this->db->get('comisiones.area_miembro pi2');
                return $query->result_array();
            }
            public function llenar_tipo($data){
                $this->db->select('id_tp_miembro, desc_tp_miembro');
               // $this->db->where('pi2.id_area_miembro !=', $data['id_area_miembro']);
                $query = $this->db->get('comisiones.tp_miembro ');
                return $query->result_array();
            }
            public function editar_fila_ip_b($data){

                $this->db->where('id_miembros', $data['id']);
    
                
    
                $unid_m_s = $data['sel_camb_unid_medi'];
                if ($unid_m_s == 0) {
                    $id_unidad_medida = $data['unid_med'];
                }else {
                    $id_unidad_medida = $data['sel_camb_unid_medi'];
                }
    
                $tipo = $data['sel_camb_tipo_medi'];
                if ($tipo == 0) {
                    $id_tp_miembro = $data['tipo'];
                }else {
                    $id_tp_miembro = $data['sel_camb_tipo_medi'];
                }
    
                $data1 = array(
                    
                    'cedula'             => $data['cedula'],
                    'nombre'                   => $data['nombre'],
                    'apellido'                   => $data['apellido'],
                    'id_area_miembro'           => $id_unidad_medida,
                    'id_tp_miembro'           => $id_tp_miembro,

                     
                            
    
                );
                $update = $this->db->update('comisiones.miembros', $data1);
                return true;
            }
            public function generar_vencimiento_comision($date1){
                $data1 = array('id_cert' => '4');		    
                    $this->db->where('vigentehasta', $date1);
                    $this->db->where('id_cert', '3');
                    $this->db->where('snc', '2');
                    $update = $this->db->update('comisiones.miembros', $data1);
        
                    return true;
                   // return $id;
            }
    }

    