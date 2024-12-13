<?php
    class Evaluacion_desempenio_model extends CI_model{

        public function __construct(){
            parent::__construct();
            // Este metodo conecta a nuestra segunda conexión
            // y asigna a nuestra propiedad $this->db_b_b; los recursos de la misma.
            $this->db_c = $this->load->database('SNCenlinea', true);
        }

        public function consulta_operadora(){
            $this->db->select('*');
            $query = $this->db->get('public.operadora');
            return $response = $query->result_array();
        }
//-------------------------------------------------------
        public function consulta_med_notf(){
            $this->db->select('*');
            $query = $this->db->get('public.medio_notf');
            return $response = $query->result_array();
        }
        /// este se usa cuando esta en prueba
    // public function llenar_contratista($data){
    //     $this->db->select('c.user_id,
    //                         c.edocontratista_id,
    //                         c.rifced,
    //                         c.numcertrnc,
    //                         c.nombre,
    //                         c.dirfiscal,
    //                         e.descedo,
    //                         c.ciudade_id,
    //                         c2.descciu,
    //                         m.descmun,
    //                         c.percontacto,
    //                         c.telf1,
    //                         c.ultprocaprob');
    //     $this->db->join('public.estados e', 'e.id = c.estado_id');
    //     $this->db->join('public.municipios m', 'm.id = c.municipio_id');
    //     $this->db->join('public.ciudades c2', 'c2.id = c.ciudade_id');
    //     $this->db->where('c.rifced',$data['rif_b']);
    //     //$query = $this->db->get('public.contratistas c');
    //     $query = $this->db->get('evaluacion_desempenio.contratistas c');
    //     $result = $query->row_array();
    //         if ($result == '') {
    //             $this->db->select('c.user_id,
    //                                  c.edocontratista_id,
    //                                  c.rifced,
    //                                  c.nombre,
    //                                  c.dirfiscal,
    //                                  e.descedo,
    //                                  m.descmun,
    //                                  c.percontacto,
    //                                  c.telf1,
    //                                  c.procactual');
    //             $this->db->join('public.estados e', 'e.id = c.estado_id');
    //             $this->db->join('public.municipios m', 'm.id = c.municipio_id');
    //             $this->db->where('c.rifced',$data['rif_b']);
    //             $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
    //             return $result = $query->row_array();
    //         }else {
    //             return $result;
    //         }
    // }
//------------------------------------------------------- esta se usa cunaod esta en produccion
        public function llenar_contratista($data){
            $this->db->select('c.user_id,
                                c.edocontratista_id,
                                c.rifced,
                                c.nombre,
                                c.dirfiscal,
                                e.descedo,
                                m.descmun,
                                c.percontacto,
                                c.telf1,
                                c.procactual');
                    $this->db->join('public.estados e', 'e.id = c.estado_id');
                    $this->db->join('public.municipios m', 'm.id = c.municipio_id');
                    $this->db->where('c.rifced',$data['rif_b']);
                    $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
                    $result = $query->row_array();
        
                if ($result == '') {
                    $this->db_c->select('c.user_id,
                                        c.edocontratista_id,
                                        c.objcontratista_id,
                                        c.nivelfinanciero_id,
                                        c.racoficina_id,
                                        c.tipocontratista,
                                        c.estado_id,
                                        e.descedo,
                                        c.ciudade_id,
                                        c2.descciu,
                                        c.municipio_id,
                                        m.descmun,
                                        c.parroquia_id,
                                        c.rifced,
                                        c.nombre,
                                        c.tipopersona,
                                        c.dencomerciale_id,
                                        c.ultprocaprob,
                                        c.procactual,
                                        c.dirfiscal,
                                        c.percontacto,
                                        c.telf1,
                                        c.fecactsusc_at,
                                        c.fecvencsusc_at,
                                        c.fecinscrnc_at,
                                        c.fecvencrnc_at,
                                        c.numcertrnc,
                                        c.numcontrol_certrnc,
                                        c.contimp_certrnc,
                                        c.contimp_copiarnc,
                                        c.codedocont,
                                        c.loginant,
                                        c.fecvencrechazo_at,
                                        c.recibido
                                        ');
                    $this->db_c->join('public.estados e', 'e.id = c.estado_id', 'left');
                    $this->db_c->join('public.municipios m', 'm.id = c.municipio_id', 'left');
                    $this->db_c->join('public.ciudades c2', 'c2.id = c.ciudade_id', 'left');
                    $this->db_c->where('c.rifced',$data['rif_b']);
                    $query = $this->db_c->get('public.contratistas c');
                    $result = $query->row_array();

                    if ($result != '') {
                        $data_eval = array(
                            'user_id' 		     => $this->session->userdata('id_user'),
                            'edocontratista_id'  => $result['edocontratista_id'],
                            'objcontratista_id'  => $result['objcontratista_id'],
                            'nivelfinanciero_id' => $result['nivelfinanciero_id'],
                            'racoficina_id' 	 => $result['racoficina_id'],
                            'tipocontratista' 	 => $result['tipocontratista'],
                            'estado_id' 		 => $result['estado_id'],
                            'ciudade_id'         => $result['ciudade_id'],
                            'municipio_id'       => $result['municipio_id'],
                            'parroquia_id'       => $result['parroquia_id'],
    
                            'rifced' 	         => $result['rifced'],
                            'nombre' 	         => $result['nombre'],
                            'tipopersona'        => $result['tipopersona'],
                            'dencomerciale_id'   => $result['dencomerciale_id'],
                            'ultprocaprob'       => $result['ultprocaprob'],
                            'procactual'         => $result['procactual'],
                            'dirfiscal'          => $result['dirfiscal'],
                            'percontacto'        => $result['percontacto'],
                            'telf1'              => $result['telf1'],
                            'fecactsusc_at'      => $result['fecactsusc_at'],
                            'fecvencsusc_at'     => $result['fecvencsusc_at'],
                            'fecinscrnc_at'      => $result['fecinscrnc_at'],
                            'fecvencrnc_at'      => $result['fecvencrnc_at'],
                            'numcertrnc'         => $result['numcertrnc'],
                            'numcontrol_certrnc' => $result['numcontrol_certrnc'],
                            'contimp_certrnc'    => $result['contimp_certrnc'],
                            'contimp_copiarnc'   => $result['contimp_copiarnc'],
                            'codedocont'         => $result['codedocont'],
                            'loginant'           => $result['loginant'],
                            'fecvencrechazo_at'  => $result['fecvencrechazo_at'],
                            'recibido'           => $result['recibido']    
                        );
    
                        $quers =$this->db->insert('evaluacion_desempenio.contratistas_nr', $data_eval);
                        
                        $this->db_c->select('*');
                        $this->db_c->where('proceso_id', $result['ultprocaprob']);
                        $querye = $this->db_c->get('public.accionistas');
                        $resultadoo = $querye->result_array();
                        
                        $count_prog = count($resultadoo);
                            for ($i=0; $i < $count_prog; $i++) {
                            /*foreach ($resultadoo as $key => $value) {*/
                            
                                if ($resultadoo[$i]['edocivil'] == 'S'){
                                    $civil = 1;
                                }
                                elseif ($resultadoo[$i]['edocivil'] == 'C') {
                                    $civil = 2;
                                }
                                elseif ($resultadoo[$i]['edocivil'] == 'D') {
                                    $civil = 3;
                                }elseif ($resultadoo[$i]['edocivil'] == 'V') {
                                    $civil = 4;
                                }else {
                                    $civil = 0;
                                }
    
                                $data1 = array(
                                    'rif_contratista' => $result['rifced'],
                                    'paise_id'        => $resultadoo[$i]['paise_id'],
                                    'apeacc'          => $resultadoo[$i]['apeacc'],
                                    'nomacc'          => $resultadoo[$i]['nomacc'],
                                    'tipo'            => $resultadoo[$i]['tipo'],
                                    'cedrif'          => $resultadoo[$i]['cedrif'],
                                    'edocivil'        => $civil,
                                    'acc'             => $resultadoo[$i]['acc'],
                                    'jd'              => $resultadoo[$i]['jd'],
                                    'rl'              => $resultadoo[$i]['rl'],
                                    'porcacc'         => $resultadoo[$i]['porcacc'],
                                    'cargo'           => $resultadoo[$i]['cargo'],
                                    'tipobl'          => $resultadoo[$i]['tipobl'],
                                    'id_operadora'    => 0,
                                    'telf'            => '000-000',
                                    'correo'          => 'No Aplica',
                                    'modif'           => $resultadoo[$i]['modif']
                                );
    
                                $this->db->insert('evaluacion_desempenio.accionistas_nr',$data1);
                            /*}*/
                        }              
                    }
                    return $result;
                }else {
                    return $result;
                }

                
        }
////para consultar solo rif y nombre  para
public function llenar_contratista_2($data){
    $this->db_c->select('
                        c.rifced,
                        c.nombre,
                        c.ultprocaprob
                       ');
    $this->db_c->where('c.rifced',$data['rif_b']);
    $query = $this->db_c->get('public.contratistas c');
    $result = $query->row_array();
        if ($result == '') {
            $this->db->select('  c.rifced,
                                 c.nombre
                                ');
            
            $this->db->where('c.rifced',$data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
            return $result = $query->row_array();
        }else {
            return $result;
        }
}
//-------------------------------------------------------
        public function llenar_contratista_rp($data){
            $this->db_c->select('proceso_id,
                        	   cedrif,
                               concat(nomacc, \'\' ,apeacc) as repr,
                        	   cargo ');
            $this->db_c->where('proceso_id', $data['ultprocaprob']);
            $query = $this->db_c->get('public.accionistas');
            $result = $query->result_array();

            if ($result == Array ()) {
                $this->db->select('cedrif,
                                   concat(nomacc, \'\' ,apeacc) as repr,
                            	   cargo ');
                $this->db->where('rif_contratista', $data['rif_cont_nr']);
                $query = $this->db->get('evaluacion_desempenio.accionistas_nr');

                return $result = $query->result_array();
            }else {
                return $result;
            }
        }
//-------------------------------------------------------
        public function consulta_modalidades(){
            $this->db->select('*');
            $query = $this->db->get('evaluacion_desempenio.modalidad');
            return $result = $query->result_array();
        }
//-------------------------------------------------------
        public function llenar_sub_modalidad($data){
            $this->db->select('*');
            $this->db->where('id_modalidad', $data['id_modalidad']);
            $query = $this->db->get('evaluacion_desempenio.sub_modalidad');
            return $result = $query->result_array();
        }
//-------------------------------------------------------
        public function registrar($exitte,$data,$data_ev,$data_repr_legal){
            $existe = $exitte;
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('evaluacion_desempenio.evaluacion e');
            $response = $query->row_array();
            if ($response){
                $id = $response['id'] + 1 ;
                $data_eval = array(
                    'id' 		        => $id,
                    'rif_contrat' 		 => $data_ev['rif_contrat'],
        			'id_modalidad' 		 => $data_ev['id_modalidad'],
        			'id_sub_modalidad' 	 => $data_ev['id_sub_modalidad'],
        			'fec_inicio_cont' 	 => $data_ev['fec_inicio_cont'],
        			'fec_fin_cont' 		 => $data_ev['fec_fin_cont'],
        			'nro_procedimiento'  => $data_ev['nro_procedimiento'],
        			'nro_contrato' 		 => $data_ev['nro_contrato'],
        			'id_estado_contrato' => $data_ev['id_estado_contrato'],
        			'bienes' 			 => $data_ev['bienes'],
        			'servicios' 		 => $data_ev['servicios'],
        			'obras' 			 => $data_ev['obras'],
        			'descr_contrato' 	 => $data_ev['descr_contrato'],
        			'monto' 			 => $data_ev['monto'],
        			'dolar' 			 => $data_ev['dolar'],
        			'euro' 				 => $data_ev['euro'],
        			'petros' 			 => $data_ev['petros'],
        			'bolivares' 		 => $data_ev['bolivares'],
        			'calidad' 			 => $data_ev['calidad'],
        			'responsabilidad' 	 => $data_ev['responsabilidad'],
        			'conocimiento' 		 => $data_ev['conocimiento'],
        			'oportunidad' 		 => $data_ev['oportunidad'],
        			'total_calif' 		 => $data_ev['total_calif'],
        			'calificacion' 		 => $data_ev['calificacion'],
                    'notf_cont' 		 => $data_ev['notf_cont'],
        			'fecha_not' 		 => $data_ev['fecha_not'],
        			'medio' 			 => $data_ev['medio'],
        			'nro_oc_os' 		 => $data_ev['nro_oc_os'],
        		 	'fileimagen' 		 => $data_ev['fileimagen'],
        			'id_usuario' 		 => $data_ev['id_usuario'],
                    'id_estatus'         => $data_ev['id_estatus'],
                    'mod_otro'           => $data_ev['mod_otro'],
                    'id_estatus'         => $data_ev['id_estatus'],
                    'otro'               => $data_ev['otro'],
                    'snc'               => 1,
                );
                $quers =$this->db->insert('evaluacion_desempenio.evaluacion', $data_eval);

                // if ($quers2) {
                //     $this->db->select('max(e.id) as id');
                //     $query = $this->db->get('evaluacion_desempenio.evaluacion e');
                //     $response2 = $query->row_array();
                //     return $response2;
                // }

                if ($existe == 0){
                    $quers1 = $this->db->insert('evaluacion_desempenio.contratistas_nr',$data);
                    $quers2 = $this->db->insert('evaluacion_desempenio.accionistas_nr',$data_repr_legal);
                    return $id;
                }
                return $id;
            }
        }
//-------------------------------------------------------
        // public function consulta_eval_not($usuario){
        //     $this->db->select('ed.id,
        //                     	 ed.rif_contrat,
        //                     	 concat(cn.nombre,\'\',c.nombre ) as nombre,
        //                          ed.calificacion
        //                        ');
        //     $this->db->join('evaluacion_desempenio.contratistas c', 'c.rifced = ed.rif_contrat', 'left');
        //     $this->db->join('evaluacion_desempenio.contratistas_nr cn', 'cn.rifced = ed.rif_contrat', 'left');
        //     $this->db->where('ed.id_usuario', $usuario);
        //     $this->db->where('id_estatus', 1);
        //     $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
        //     return $response = $query->result_array();
        // }
//-------------------------------------------------------
        //Registrar notificacion
        public function registrar_not($data){
            $id_evaluacion = $data['id_evaluacion'];
            $separar        = explode('"', $id_evaluacion);
            //print_r($separar);die;
            $id_evaluacion = $separar['3'];

            $data_reg = array(
                        'id_evaluacion' => $id_evaluacion,
                        'medio' => $data['medio'],
                        'nro_not' => $data['nro_not'],
                        'correo' => $data['correo'],
                        'fileimagen' => $data['fileimagen'],
                        'id_usuario' => $data['id_usuario'],
            );
            $quers =$this->db->insert('evaluacion_desempenio.not_evaluacion', $data_reg);
            if ($quers){
                $data1 = array('id_estatus' => $data['id_estatus']);
                $this->db->where('id', $id_evaluacion);
                $update = $this->db->update('evaluacion_desempenio.evaluacion', $data1);
                return true;
            }
            return true;
        }
//-------------------------------------------------------
        // // public function registrar_not_2($data){
        // //     $id_evaluacion = $data['id_evaluacion'];
        // //
        // //     $data_reg = array(
        // //                 'id_evaluacion' => $id_evaluacion,
        // //                 'medio' => $data['medio'],
        // //                 'nro_not' => $data['nro_not'],
        // //                 'correo' => $data['correo'],
        // //                 'fileimagen' => $data['fileimagen'],
        // //                 'id_usuario' => $data['id_usuario'],
        // //     );
        // //     $quers =$this->db->insert('evaluacion_desempenio.not_evaluacion', $data_reg);
        // //
        // //     if ($quers){
        // //         $data1 = array('id_estatus' => $data['id_estatus']);
        // //         $this->db->where('id', $id_evaluacion);
        // //         $update = $this->db->update('evaluacion_desempenio.evaluacion', $data1);
        // //         return true;
        // //     }
        // //
        // //     return true;
        // // }
//-------------------------------------------------------
        // Reporte de Evaluacion de Desempeño por Usuario
        public function consulta_eval($usuario){
            // $this->db->select('ed.id,
            //                    ed.rif_contrat,
            //                    DATE_FORMAT(21/21/2221,'%Y-%m') as fecha,
            //                    concat(cn.nombre,\'\',c.nombre ) as nombre,
            //                    ed.calificacion,
            //                    e.descripcion
            // ');
            // $this->db->join('evaluacion_desempenio.contratistas c', 'c.rifced = ed.rif_contrat', 'left');
            // $this->db->join('evaluacion_desempenio.contratistas_nr cn', 'cn.rifced = ed.rif_contrat', 'left');
            // $this->db->join('public.estatus e', 'e.id = ed.id_estatus');
            // $this->db->where('ed.id_usuario', $usuario);
            // $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
            // return $response = $query->result_array();

            $query = $this->db->query("SELECT ed.id,
                                              to_char(ed.fecha_reg_eval, 'dd-mm-yyyy') as fecha,
                                              ed.rif_contrat,
                                              concat(cn.nombre,'',c.nombre ) as nombre,
                                              ed.calificacion,
                                              ed.id_estatus,
                                              e.descripcion,
                                              ed.id_usuario, 
                                              p.rif_organoente, 
                                              r.descripcion as contratante
                                        FROM evaluacion_desempenio.evaluacion as ed
                                        left join evaluacion_desempenio.contratistas c on  c.rifced = ed.rif_contrat
                                        left join evaluacion_desempenio.contratistas_nr cn on cn.rifced = ed.rif_contrat
                                        left join seguridad.usuarios p on  p.id = ed.id_usuario
                                        left join public.organoente r on  r.rif = p.rif_organoente
                                    --    join public.planillapirmera2 cn on cn.rifced = ed.rif_contrat
                                       join public.estatus e on e.id = ed.id_estatus
                                    --    where ed.id_usuario = '$usuario' //COMENTE ESTO HAY QUE HACERLO EN EL OTRO
                                    where ed.snc = '1' 
                                    -- esto para que se vea solo cuando el snc haga la notificacion
                                       "
                                       );
            return $query->result_array();

        }
        

        public function consulta_eval_user($usuario){
        $query = $this->db->query("SELECT ed.id,
        to_char(ed.fecha_reg_eval, 'dd-mm-yyyy') as fecha,
        ed.rif_contrat,
        concat(cn.nombre,'',c.nombre ) as nombre,
        ed.calificacion,
        ed.id_estatus,
        e.descripcion, ed.id_usuario, p.rif_organoente, r.descripcion as contratante
        FROM evaluacion_desempenio.evaluacion as ed
        left join evaluacion_desempenio.contratistas c on  c.rifced = ed.rif_contrat
        left join evaluacion_desempenio.contratistas_nr cn on cn.rifced = ed.rif_contrat
        left join seguridad.usuarios p on  p.id = ed.id_usuario
        left join public.organoente r on  r.rif = p.rif_organoente

        join public.estatus e on e.id = ed.id_estatus
        where ed.id_usuario = '$usuario'");
return $query->result_array();

}


        //Se consulta la Evaluación de desempeño. Tomando en cuenta que hay dos tablas de consultas de los contratistas (Solicitado de esa forma).
        public function consulta_eval_ind($id_evaluacion){


            /*$this->db->select('ed.id,
                                ed.id_usuario,
                                u.unidad,
                                en.rif as rif_organo,
                                en.descripcion as organo,
                                 ed.rif_contrat,
                                 concat(cn.nombre,\'\',c.nombre) as nom_comer,
                                 concat(e2.descedo,\'\', e3.descedo) as est_contratista,
                                 concat(m.descmun,\'\', m2.descmun) as mun_contratista,
                                 concat(c2.descciu,\'\', c3.descciu) as ciudad,
                                 concat(c.percontacto,\'\', cn.percontacto) as per_cont,
                                 concat(c.telf1,\'\', cn.telf1) as tef_cont,
                                 m3.descripcion as modalidad,
                                 sm.descripcion as sub_modalidad,
                                 ed.fec_inicio_cont,
                            	 ed.fec_fin_cont,
                            	 ed.nro_procedimiento,
                            	 ed.nro_contrato,
                            	 e.descedo as estado_contrato,
                            	 ed.descr_contrato,
                            	 ed.bienes,
                            	 ed.servicios,
                            	 ed.obras,
                            	 ed.monto,
                            	 ed.dolar,
                            	 ed.euro,
                            	 ed.petros,
                            	 ed.bolivares,
                            	 ed.calidad,
                            	 ed.responsabilidad,
                            	 ed.conocimiento,
                            	 ed.oportunidad,
                            	 ed.total_calif,
                            	 ed.calificacion,
                                 ed.notf_cont,
                                 ed.fecha_not,
                                 ed.medio,
                                 ed.nro_oc_os,
                                 ed.fileimagen,
                                 ed.otro,
                                 ed.mod_otro,
                                 ed.id_estatus,
                                 e5.descripcion,
                                 ed.fecha_reg_eval,
                                 ed.snc');
                $this->db->join('seguridad.usuarios u', 'u.id = ed.id_usuario'); ////esto es para saber quien lo cargo
                $this->db->join('public.organoente en', 'en.rif = u.rif_organoente', 'left');      
                $this->db->join('evaluacion_desempenio.contratistas_nr cn', 'cn.rifced = ed.rif_contrat', 'left');
                $this->db->join('evaluacion_desempenio.contratistas c', 'c.rifced = ed.rif_contrat', 'left');
                $this->db->join('public.estados e', 'e.id = ed.id_estado_contrato');
                $this->db->join('public.estados e2', 'e2.id = c.estado_id', 'left');
                $this->db->join('public.estados e3', 'e3.id = cn.estado_id', 'left');
                $this->db->join('public.municipios m', 'm.id = c.municipio_id', 'left');
                $this->db->join('public.municipios m2', 'm2.id = cn.municipio_id', 'left');
                $this->db->join('public.ciudades c3', 'c3.id = c.ciudade_id', 'left');
                $this->db->join('public.ciudades c2', 'c2.id = cn.ciudade_id', 'left');
                $this->db->join('evaluacion_desempenio.modalidad m3', 'm3.id = ed.id_modalidad');
                $this->db->join('evaluacion_desempenio.sub_modalidad sm', 'sm.id = ed.id_sub_modalidad');
                $this->db->join('public.estatus e5', 'e5.id = ed.id_estatus');
                $this->db->where('ed.id', $id_evaluacion); //Aqui hace la busqueda del id que se envia desde la tabla
            
            $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
            
            
            
            return $response = $query->row_array();
                */
            
            $query = $this->db->query("select ed.id,
                                ed.id_usuario,
                                u.unidad,
                                en.rif as rif_organo,
                                en.descripcion as organo,
                                 ed.rif_contrat,
                                 case when cn.nombre != '' then cn.nombre else c.nombre END AS nom_comer,
                                 case when e2.descedo != '' then e2.descedo else e3.descedo END AS est_contratista,
                                 case when m.descmun != '' then m.descmun else m2.descmun END AS mun_contratista,
                                 case when c2.descciu != '' then c2.descciu else c3.descciu END AS ciudad,
                                 case when c.percontacto != '' then c.percontacto else cn.percontacto END AS per_cont,
                                 case when c.telf1 != '' then c.telf1 else cn.telf1 END AS tef_cont,
                                 m3.descripcion as modalidad,
                                 sm.descripcion as sub_modalidad,
                                 ed.fec_inicio_cont,
                            	 ed.fec_fin_cont,
                            	 ed.nro_procedimiento,
                            	 ed.nro_contrato,
                            	 e.descedo as estado_contrato,
                            	 ed.descr_contrato,
                            	 ed.bienes,
                            	 ed.servicios,
                            	 ed.obras,
                            	 ed.monto,
                            	 ed.dolar,
                            	 ed.euro,
                            	 ed.petros,
                            	 ed.bolivares,
                            	 ed.calidad,
                            	 ed.responsabilidad,
                            	 ed.conocimiento,
                            	 ed.oportunidad,
                            	 ed.total_calif,
                            	 ed.calificacion,
                                 ed.notf_cont,
                                 ed.fecha_not,
                                 ed.medio,
                                 ed.nro_oc_os,
                                 ed.fileimagen,
                                 ed.otro,
                                 ed.mod_otro,
                                 ed.id_estatus,
                                 e5.descripcion,
                                 ed.fecha_reg_eval,
                                 ed.snc
                            from evaluacion_desempenio.evaluacion ed 
                            left join evaluacion_desempenio.contratistas_nr cn on cn.rifced = ed.rif_contrat
                            left join evaluacion_desempenio.contratistas c on c.rifced = ed.rif_contrat
                            left join seguridad.usuarios u on u.id = ed.id_usuario
                            left join public.organoente en on en.rif = u.rif_organoente 
                            --left join public.organoente en on en.codigo = u.unidad
                            left join public.estados e on e.id = ed.id_estado_contrato
                            left join public.estados e2 on e2.id = c.estado_id
                            left join public.estados e3 on e3.id = cn.estado_id
                            left join public.municipios m on m.id = c.municipio_id
                            left join public.municipios m2 on m2.id = cn.municipio_id
                            left join public.ciudades c3 on c3.id = c.ciudade_id
                            left join public.ciudades c2 on c2.id = cn.ciudade_id
                            left join evaluacion_desempenio.modalidad m3 on m3.id = ed.id_modalidad
                            left join evaluacion_desempenio.sub_modalidad sm on sm.id = ed.id_sub_modalidad
                            left join public.estatus e5 on e5.id = ed.id_estatus
                            where ed.id = '$id_evaluacion'");
            return $response = $query->row_array();
            
        }

        public function consulta_eval_ind_img($id_evaluacion){
            $this->db->select('ed.id,
                                    ed.notf_cont,
                                    ed.fecha_not,
                                    ed.medio,
                                    ed.nro_oc_os,
                                    ed.fileimagen,
                                    ed.otro,
                                    ed.mod_otro,
                                    ed.id_estatus,
                                 ed.snc');
            $this->db->where('ed.id', $id_evaluacion);
            $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
            return $response = $query->row_array();
        }
        public function get_imagen($nombre_archivo) {
            $this->db->select('fileimagen, id');
            $this->db->from('evaluacion_desempenio.evaluacion');
            $this->db->where('fileimagen', $nombre_archivo);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return false;
            }
        }

        public function consutar_dt_eval($id_evaluacion){
            $this->db->select('*');
            $this->db->where('a.id_evaluacion', $id_evaluacion);
            $query = $this->db->get('evaluacion_desempenio.anulacion a');
            return $response = $query->row_array();
        }

        public function graficos($data){
            $response = array();
            $this->db->select('count(e.calificacion) as t_calificacion,
	                           e.calificacion');
            $this->db->group_by('e.calificacion');
            $this->db->order_by('e.calificacion');
            $this->db->where('e.rif_contrat', $data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.evaluacion e');
            $response = $query->result_array();
            return $response;
        }

        public function inf_tabla($data){
            $this->db->select('fecha_evaluacion,
                        	   rif_contratista,
                        	   razon_social as contratista,
                        	   nombre_ente,
                        	   calificacion,
                               objeto,
                        	   nombre_calificacion,
                        	   num_contrato,
                        	   numero_procedimiento');
            $this->db->where('eca.rif_contratista', $data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.evaluacion_contratistas_ant eca');
            $response = $query->result_array();
            return $response;
        }

        public function inf_tabla2($data){
            $this->db->select('e.rif_contrat rif_contratista,
                        	   e.fecha_reg_eval fecha_evaluacion,
                        	   e.calificacion nombre_calificacion,
                        	   e.id_usuario,
                               e.descr_contrato,
                        	   u.nombre,
                        	   u.unidad,
                        	   concat(o.desc_organo,\'\', e2.desc_entes) nombre_ente');
            $this->db->join('seguridad.usuarios u', 'u.id = e.id_usuario');
            $this->db->join('public.organos o', 'o.codigo = u.unidad', 'left');
            $this->db->join('public.entes e2', 'e2.codigo = u.unidad', 'left');
            $this->db->where('e.rif_contrat', $data['rif_b']);
            $query = $this->db->get('evaluacion_desempenio.evaluacion e');
            $response = $query->result_array();
            return $response;
        }

        public function consulta_contr_nr(){ 
            $this->db->select('cn.id,
                        	   cn.user_id,
                        	   cn.rifced rif_contratante,
                        	   cn.nombre contratante,
                        	   u.unidad,
                               concat(tr.desc_rif,\'\',o.rif, tr2.desc_rif,\'\', e.rif, tr3.desc_rif,\'\',ea.rif) as rif_contratista,
                        	   concat(o.desc_organo,\'\', e.desc_entes, \'\', ea.desc_entes_ads) as contratista');
            $this->db->join('seguridad.usuarios u', 'u.id = cn.user_id');
            $this->db->join('public.organos o', 'o.codigo = u.unidad' ,'left');
            $this->db->join('public.entes e', 'e.codigo = u.unidad' ,'left');
            $this->db->join('public.entes_ads ea', 'ea.codigo = u.unidad' ,'left');
            $this->db->join('public.tipo_rif tr', 'tr.id_rif = o.tipo_rif' ,'left');
            $this->db->join('public.tipo_rif tr2', 'tr2.id_rif = e.tipo_rif' ,'left');
            $this->db->join('public.tipo_rif tr3', 'tr3.id_rif = ea.tipo_rif' ,'left');
            $query = $this->db->get('evaluacion_desempenio.contratistas_nr cn');
            $response = $query->result_array();
            return $response;
        }
        

        // Consulta de Evaluacion completas para anulación
        public function consulta_eval_anul($usuario){
            $query = $this->db->query("SELECT ed.id,
                                    		to_char(ed.fecha_reg_eval, 'dd-mm-yyyy') as fecha,
                                        ed.rif_contrat,
                                        concat(cn.nombre,'',c.nombre ) as nombre,
                                        ed.calificacion,
                                        ed.id_estatus,
                                        e.descripcion
                                    from evaluacion_desempenio.evaluacion ed
                                    left join evaluacion_desempenio.contratistas c on c.rifced = ed.rif_contrat
                                    left join evaluacion_desempenio.contratistas_nr cn on cn.rifced = ed.rif_contrat
                                    join public.estatus e on e.id = ed.id_estatus
                                    where ed.id_usuario = '$usuario'");
            return $query->result_array();
        }

        public function save_anulacion($id, $d_anulacion){
            $quers =$this->db->insert('evaluacion_desempenio.anulacion', $d_anulacion);
            $data2 = array(
                'id_estatus' => 2,
            );
            $this->db->where('id', $id);
            $update = $this->db->update('evaluacion_desempenio.evaluacion', $data2);
            return $id;
        }

        public function consulta_anulacion($data){
            $this->db->select('*');
            $this->db->where('id_evaluacion', $data['id_evaluacion']);
            $query = $this->db->get('evaluacion_desempenio.anulacion');
            return $response = $query->row_array();
        }

        public function consl_proc_anulacion(){
            // $this->db->select('ed.id,
            //                    ed.rif_contrat,
            //                    concat(cn.nombre,\'\',c.nombre ) as nombre,
            //                    ed.calificacion,
            //                    ed.id_estatus,
            //                    e.descripcion
            // ');
            // $this->db->join('evaluacion_desempenio.contratistas c', 'c.rifced = ed.rif_contrat', 'left');
            // $this->db->join('evaluacion_desempenio.contratistas_nr cn', 'cn.rifced = ed.rif_contrat', 'left');
            // $this->db->join('public.estatus e', 'e.id = ed.id_estatus');
            // $query = $this->db->get('evaluacion_desempenio.evaluacion ed');
            // return $response = $query->result_array();

            $query = $this->db->query("SELECT a.id_anulacion,
                                        	   a.id_evaluacion,
                                        	   e.rif_contrat,
                                        	   concat(c.nombre, '', cn.nombre) AS contratante,
                                               e.calificacion,
                                        	   e.id_estatus,
                                        	   e2.descripcion AS estatus,
                                        	   to_char(a.fecha_reg_anulacion, 'dd-mm-yyyy') AS fech_reg
                                        FROM evaluacion_desempenio.anulacion a
                                        JOIN evaluacion_desempenio.evaluacion e ON e.id = a.id_evaluacion
                                        LEFT JOIN evaluacion_desempenio.contratistas c ON c.rifced = e.rif_contrat
                                        LEFT JOIN evaluacion_desempenio.contratistas_nr cn ON cn.rifced = e.rif_contrat
                                        JOIN public.estatus e2 ON e2.id = e.id_estatus 
                                        where e.id_estatus = 2");
            return $query->result_array();
        }

        public function aprv_anulacion($data){

            $data1 = array(
                'fecha_aprv_anul' => date('Y-m-d'),
            );
            $this->db->where('id_evaluacion', $data['id_evaluacion']);
            $update = $this->db->update('evaluacion_desempenio.anulacion', $data1);


            $data2 = array(
                'id_estatus' => 3,
            );
            $this->db->where('id', $data['id_evaluacion']);
            $update = $this->db->update('evaluacion_desempenio.evaluacion', $data2);

            return $data['id_evaluacion'];
        }



        public function registrar_sns($exitte,$data,$data_ev,$data_repr_legal){
            $existe = $exitte;
            $this->db->select('max(e.id) as id');
            $query = $this->db->get('evaluacion_desempenio.evaluacion e');
            $response = $query->row_array();
            if ($response){
                $id = $response['id'] + 1 ;
                $data_eval = array(
                    'id' 		        => $id,
                    'rif_contrat' 		 => $data_ev['rif_contrat'],
        			'id_modalidad' 		 => $data_ev['id_modalidad'],
        			'id_sub_modalidad' 	 => $data_ev['id_sub_modalidad'],
        			'fec_inicio_cont' 	 => $data_ev['fec_inicio_cont'],
        			'fec_fin_cont' 		 => $data_ev['fec_fin_cont'],
        			'nro_procedimiento'  => $data_ev['nro_procedimiento'],
        			'nro_contrato' 		 => $data_ev['nro_contrato'],
        			'id_estado_contrato' => $data_ev['id_estado_contrato'],
        			'bienes' 			 => $data_ev['bienes'],
        			'servicios' 		 => $data_ev['servicios'],
        			'obras' 			 => $data_ev['obras'],
        			'descr_contrato' 	 => $data_ev['descr_contrato'],
        			'monto' 			 => $data_ev['monto'],
        			'dolar' 			 => $data_ev['dolar'],
        			'euro' 				 => $data_ev['euro'],
        			'petros' 			 => $data_ev['petros'],
        			'bolivares' 		 => $data_ev['bolivares'],
        			'calidad' 			 => $data_ev['calidad'],
        			'responsabilidad' 	 => $data_ev['responsabilidad'],
        			'conocimiento' 		 => $data_ev['conocimiento'],
        			'oportunidad' 		 => $data_ev['oportunidad'],
        			'total_calif' 		 => $data_ev['total_calif'],
        			'calificacion' 		 => $data_ev['calificacion'],
                    'notf_cont' 		 => $data_ev['notf_cont'],
        			'fecha_not' 		 => $data_ev['fecha_not'],
        			'medio' 			 => $data_ev['medio'],
        			'nro_oc_os' 		 => $data_ev['nro_oc_os'],
        		 	'fileimagen' 		 => $data_ev['fileimagen'],
        			'id_usuario' 		 => $data_ev['id_usuario'],
                    'id_estatus'         => $data_ev['id_estatus'],
                    'mod_otro'           => $data_ev['mod_otro'],
                    'id_estatus'         => $data_ev['id_estatus'],
                    'otro'               => $data_ev['otro'],
                    'snc'               =>0,
                );
                $quers =$this->db->insert('evaluacion_desempenio.evaluacion', $data_eval);

                // if ($quers2) {
                //     $this->db->select('max(e.id) as id');
                //     $query = $this->db->get('evaluacion_desempenio.evaluacion e');
                //     $response2 = $query->row_array();
                //     return $response2;
                // }

                if ($existe == 0){
                    $quers1 = $this->db->insert('evaluacion_desempenio.contratistas_nr',$data);
                    $quers2 = $this->db->insert('evaluacion_desempenio.accionistas_nr',$data_repr_legal);
                    return $id;
                }
                return $id;
            }
        }



        public function consultar_snc_evalu($usuario){
  
            $query = $this->db->query("SELECT ed.id,
                                	   to_char(ed.fecha_reg_eval, 'dd-mm-yyyy') as fecha,
                                       ed.rif_contrat,
                                       concat(cn.nombre,'',c.nombre ) as nombre,
                                       ed.calificacion,
                                       ed.id_estatus,
                                       e.descripcion
                                       FROM evaluacion_desempenio.evaluacion as ed
                                       left join evaluacion_desempenio.contratistas c on  c.rifced = ed.rif_contrat
                                       left join evaluacion_desempenio.contratistas_nr cn on cn.rifced = ed.rif_contrat
                                       
                                    --    join public.planillapirmera2 cn on cn.rifced = ed.rif_contrat
                                       join public.estatus e on e.id = ed.id_estatus
                                    --    where ed.id_usuario = '$usuario' //COMENTE ESTO HAY QUE HACERLO EN EL OTRO
                                    where ed.snc = '0' 
                                    -- esto para que se vea solo cuando el snc haga la notificacion
                                       "
                                       );
            return $query->result_array();

        }


        function consulta_2($data){
            $this->db->select('*');
            $this->db->from('evaluacion_desempenio.evaluacion');
            $this->db->where('id', $data['id']);
           // $this->db->order_by("codigo_b", "Asc");
            $query = $this->db->get();
            if (count($query->result()) > 0) {
                return $query->row();
            }
        } 
        public function save_notificacion($notifiacion){
            $this->db->select('id as id');
            $this->db->where('id', $notifiacion['id']);
            $query = $this->db->get('evaluacion_desempenio.evaluacion e');
            $response = $query->row_array();
            $id = $response['id']+ 0;

            $this->db->where('id', $notifiacion['id']);
			$update = $this->db->update('evaluacion_desempenio.evaluacion', $notifiacion);
			//return true;
            return $id; 
        }

        public function consultar_contratista($data){
            $this->db->select('rifced,nombre');
            $this->db->like('rifced', $data['ccnu_b_m']);
            $query = $this->db->get('evaluacion_desempenio.contratistas');
            return $query->result_array();
        } 

       
    // public function consultar_contratista($data){
    //     $this->db->select('c.user_id,
    //                         c.edocontratista_id,
    //                         c.rifced,
    //                         c.numcertrnc,
    //                         c.nombre,
    //                         c.dirfiscal,
    //                         e.descedo,
    //                         c.ciudade_id,
    //                         c2.descciu,
    //                         m.descmun,
    //                         c.percontacto,
    //                         c.telf1,
    //                         c.ultprocaprob');
    //     $this->db->join('public.estados e', 'e.id = c.estado_id');
    //     $this->db->join('public.municipios m', 'm.id = c.municipio_id');
    //     $this->db->join('public.ciudades c2', 'c2.id = c.ciudade_id');
    //     //$this->db->where('c.rifced',$data['rif_b']);
    //     //$query = $this->db->get('public.contratistas c');
    //     $query = $this->db->get('evaluacion_desempenio.contratistas c');
    //     $result = $query->row_array();
    //         if ($result == '') {
    //             $this->db->select('c.user_id,
    //                                  c.edocontratista_id,
    //                                  c.rifced,
    //                                  c.nombre,
    //                                  c.dirfiscal,
    //                                  e.descedo,
    //                                  m.descmun,
    //                                  c.percontacto,
    //                                  c.telf1,
    //                                  c.procactual');
    //             $this->db->join('public.estados e', 'e.id = c.estado_id');
    //             $this->db->join('public.municipios m', 'm.id = c.municipio_id');
    //             //$this->db->where('c.rifced',$data['rif_b']);
    //             $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
    //             return $result = $query->row_array();
    //         }else {
    //             return $result;
    //         }
    // }

    }






















?>