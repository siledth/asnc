<?php
class Certificacion_model extends CI_model
{
    public function inf_1(){
           
        $this->db->select('*');
        $this->db->where('id_tarifa', 3 );
        $query = $this->db->get('certificacion.tarifas');
        return $result = $query->result_array();
    }
    public function inf_2(){
           
        $this->db->select('*');
        $this->db->where('id_alicuota_iva', 5 );
        $query = $this->db->get('public.alicuota_iva');
        return $result = $query->result_array();
    }
    public function inf_3(){
           
        $this->db->select('*');
        $this->db->where('id_tarifa', 1 );
        $query = $this->db->get('certificacion.tarifas');
        return $result = $query->result_array();
    }
    public function cons_nro_comprobante(){
        $this->db->select('id,tipo_pers');
        $this->db->where('tipo_pers ', 1 );
        $this->db->order_by('id desc');
        $query = $this->db->get('certificacion.certificaciones ');
        $response = $query->row_array();
        return $response;
    }
    
    public function consulta_certi(){
        $this->db->select('*');
        $this->db->from('certificacion.certificaciones ');
        //$this->db->where('status', '1');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function save_certificacion($certifi, $experi_empre_capa,$experi_empre_cap_comisi,
    $infor_per_natu,$infor_per_prof,$for_mat_contr_publ,$exp_par_comi_10,$exp_dic_cap_3){
        $this->db->select('max(e.id) as id');
        $query = $this->db->get('certificacion.certificaciones e');
        $response3 = $query->row_array();
        $id = $response3['id'] + 1 ;
        $certifi1 = array(

            'id'=> $id,
            'nro_comprobante'=> $certifi['nro_comprobante'],
            'n_certif'=> $certifi['n_certif'],
            'rif_cont'=> $certifi['rif_cont'],
            'nombre'=> $certifi['nombre'],
            'tipo_pers'=> $certifi['tipo_pers'],
            'objetivo'=> $certifi['objetivo'],
            'cont_prog'=> $certifi['cont_prog'],
            'total_bss'=> $certifi['total_bss'],
            'n_ref'=> $certifi['n_ref'],
            'banco_e'=> $certifi['banco_e'],
            'banco_rec'=> $certifi['banco_rec'],
            'fecha_trans'=> $certifi['fecha_trans'],
            'monto_trans'=> $certifi['monto_trans'],
            'declara'=> $certifi['declara'],
            'acepto' => $certifi['acepto'],
            'fecha_solic'=> $certifi['fecha_solic'],
            'user_soli'=> $certifi['user_soli'],
            'status' => $certifi['status'],
            );         
        $quers =$this->db->insert('certificacion.certificaciones',$certifi1);

            if ($quers) {

                $id = $id;
                $cant_proy = $experi_empre_capa['organo_experi_empre_capa'];
                $count_prog = count($cant_proy);
                for ($i=0; $i < $count_prog; $i++) {
                    $data1 = array(
                        'id'              => $id,
                        'organo_experi_empre_capa'   		    => $experi_empre_capa['organo_experi_empre_capa'][$i],
                        'actividad_experi_empre_capa'          	=> $experi_empre_capa['actividad_experi_empre_capa'][$i],
                        'desde_experi_empre_capa'           	=> $experi_empre_capa['desde_experi_empre_capa'][$i],
                        'hasta_experi_empre_capa' 	            => $experi_empre_capa['hasta_experi_empre_capa'][$i],
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'             => $experi_empre_capa['rif_cont'],  
                        'nro_comprobante'=> $experi_empre_capa['nro_comprobante']
                    );
                    $this->db->insert('certificacion.experi_empre_capa',$data1);
                }

                $cant_pff = $experi_empre_cap_comisi['organo_expe'];
                $count_pff = count($cant_pff);

                for ($i=0; $i < $count_pff; $i++) {
                    $data2 = array(
                        'id'              => $id,
                        'nro_comprobante'             => $experi_empre_cap_comisi['nro_comprobante'],
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $experi_empre_cap_comisi['rif_cont'],
                        'organo_expe'   		        => $experi_empre_cap_comisi['organo_expe'][$i],
                        'actividad_exp'          	=> $experi_empre_cap_comisi['actividad_exp'][$i],
                        'desde_exp'             => $experi_empre_cap_comisi['desde_exp'][$i],
                        'hasta_exp' 	            => $experi_empre_cap_comisi['hasta_exp'][$i],
                       
                    );
                    $this->db->insert('certificacion.experi_empre_cap_comisi',$data2);
                }

                $cant_pfft = $infor_per_natu['nombre_ape'];
                $count_pffr = count($cant_pfft);

                for ($i=0; $i < $count_pffr; $i++) {
                    $data3 = array(
                        'id'              => $id,
                        'nro_comprobante'=> $certifi['nro_comprobante'],
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'nombre_ape'   		        => $infor_per_natu['nombre_ape'][$i],
                        'cedula'          	=> $infor_per_natu['cedula'][$i],
                        'rif'             => $infor_per_natu['rif'][$i],
                        'bolivar_estimado' 	            => $infor_per_natu['bolivar_estimado'][$i],
                        'pj' 	            => $infor_per_natu['pj'],
                        'sub_total' 	            => $infor_per_natu['sub_total'],
                        'total_final' 	            => $infor_per_natu['total_bss'],
                       
                    );
                    $this->db->insert('certificacion.infor_per_natu',$data3);
                }

                $cant_pfftt = $infor_per_prof['for_academica'];
                $count_pffrt = count($cant_pfftt);

                for ($i=0; $i < $count_pffrt; $i++) {
                    $data4 = array(
                        'id'              => $id,
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'for_academica'   		=> $infor_per_prof['for_academica'][$i],
                        'titulo'          	=> $infor_per_prof['titulo'][$i],
                        'ano'             => $infor_per_prof['ano'][$i],
                        'culminacion' 	 => $infor_per_prof['culminacion'][$i],
                        'curso' 	            => $infor_per_prof['curso'][$i],
                        'nro_comprobante'=> $certifi['nro_comprobante']
                        
                       
                    );
                    $this->db->insert('certificacion.infor_per_prof',$data4);
                }

                $cant_1 = $for_mat_contr_publ['taller'];
                $count_1 = count($cant_1);

                for ($i=0; $i < $count_1; $i++) {
                    $data5 = array(
                        'id'              => $id,
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'taller'   		=> $for_mat_contr_publ['taller'][$i],
                        'institucion'   => $for_mat_contr_publ['institucion'][$i],
                        'hor_dura'      => $for_mat_contr_publ['hor_dura'][$i],
                        'certi' 	 => $for_mat_contr_publ['certi'][$i],
                        'fech_cert' 	 => $for_mat_contr_publ['fech_cert'][$i],
                        'vigencia' 	   => $for_mat_contr_publ['vigencia'][$i],
                        'nro_comprobante'=> $certifi['nro_comprobante']
                        
                       
                    );
                    $this->db->insert('certificacion.for_mat_contr_publ',$data5);
                }
                $cant_2 = $exp_par_comi_10['organo10'];
                $count_3 = count($cant_2);

                for ($i=0; $i < $count_3; $i++) {
                    $data6 = array(
                        'id'              => $id,
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'organo10'   		=> $exp_par_comi_10['organo10'][$i],
                        'act_adminis_desid'   => $exp_par_comi_10['act_adminis_desid'][$i],
                        'n_acto'      => $exp_par_comi_10['n_acto'][$i],
                        'fecha_act' 	 => $exp_par_comi_10['fecha_act'][$i],
                        'area_10' 	 => $exp_par_comi_10['area_10'][$i],
                        'dura_comi' 	   => $exp_par_comi_10['dura_comi'][$i],
                       
                        
                       
                    );
                    $this->db->insert('certificacion.exp_par_comi_10',$data6);
                }

                $cant_4 = $exp_dic_cap_3['organo3'];
                $count_5 = count($cant_4);

                for ($i=0; $i < $count_5; $i++) {
                    $data7 = array(
                        'id'              => $id,
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'organo3'   		=> $exp_dic_cap_3['organo3'][$i],
                        'actividad3'   => $exp_dic_cap_3['actividad3'][$i],
                        'desde3'      => $exp_dic_cap_3['desde3'][$i],
                        'hasta3' 	 => $exp_dic_cap_3['hasta3'][$i],
                       
                        
                       
                    );
                    $this->db->insert('certificacion.exp_dic_cap_3',$data7);
                }


            }
            return true;
    }

    public function certificaciones($rif_cont ){
           
        $this->db->select('pp.*');
       
        $this->db->where('pp.rif_cont', $rif_cont );

        $query = $this->db->get('certificacion.certificaciones pp');
        return $query->result_array();
    }

    public function certificaciones2($rif_cont){
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont );
        $query = $this->db->get('certificacion.experi_empre_capa pf');
        return $query->result_array();
    }
    public function certificaciones3($rif_cont){
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont );
        $query = $this->db->get('certificacion.experi_empre_cap_comisi pf');
        return $query->result_array();
    }
    public function certificaciones4($rif_cont){
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont );
        $query = $this->db->get('certificacion.infor_per_natu pf');
        return $query->result_array();
    }
    public function certificaciones5($rif_cont){
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont );
        $query = $this->db->get('certificacion.infor_per_prof pf');
        return $query->result_array();
    }
    public function certificaciones6($rif_cont){
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont );
        $query = $this->db->get('certificacion.for_mat_contr_publ pf');
        return $query->result_array();
    }
    public function certificaciones7($rif_cont){
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont );
        $query = $this->db->get('certificacion.exp_par_comi_10 pf');
        return $query->result_array();
    }
    public function certificaciones8($rif_cont){
        $this->db->select('pf.*
                           ');
        $this->db->where('pf.rif_cont', $rif_cont );
        $query = $this->db->get('certificacion.exp_dic_cap_3 pf');
        return $query->result_array();
    }

    public function inf_2_edit($data){
        $this->db->select('pf.*
                            ');
        $this->db->join('certificacion.certificaciones pp','pp.rif_cont = pf.rif_cont');
        $this->db->where('pf.rif_cont', $data['rif_cont']);
        $query = $this->db->get('certificacion.experi_empre_capa pf');
        return $query->result_array();
    }

    public function inf_3_o($data){
        $this->db->select('pf.*,
                            ');
                $this->db->join('certificacion.certificaciones pp','pp.rif_cont = pf.rif_cont');
                $this->db->where('pf.rif_cont', $data['rif_cont']);
                $query = $this->db->get('certificacion.experi_empre_cap_comisi pf');
                return $query->result_array();
    }
    public function inf_3_1($data){
        $this->db->select('pf.*,
                            ');
                $this->db->join('certificacion.certificaciones pp','pp.rif_cont = pf.rif_cont');
                $this->db->where('pf.rif_cont', $data['rif_cont']);
                $query = $this->db->get('certificacion.infor_per_natu pf');
                return $query->result_array();
    }

    
    public function editar__certificacion($rif_cont,$certifi,$experi_empre_capa,$experi_empre_cap_comisi){
        $this->db->where('rif_cont', $rif_cont);
        // $this->db->where('id_p_proyecto', $id_p_proyecto);
         $update = $this->db->update('certificacion.certificaciones', $certifi);

         if ($update){
             $this->db->where('rif_cont', $rif_cont);
            // $this->db->where('id_p_acc', 0);
             $this->db->delete('certificacion.experi_empre_capa');	
                 $cant_proy = $experi_empre_capa['organo_experi_empre_capa'];
                 $count_prog = count($cant_proy);
                 for ($i=0; $i < $count_prog; $i++) {
                     $data_inf = array(
                       //  'id_buque'              => $id,
                         'organo_experi_empre_capa'   		    => $experi_empre_capa['organo_experi_empre_capa'][$i],
                         'actividad_experi_empre_capa'          	=> $experi_empre_capa['actividad_experi_empre_capa'][$i],
                         'desde_experi_empre_capa'           	=> $experi_empre_capa['desde_experi_empre_capa'][$i],
                         'hasta_experi_empre_capa' 	            => $experi_empre_capa['hasta_experi_empre_capa'][$i],
                         'n_certif'=> $certifi['n_certif'],
                         'rif_cont'             => $experi_empre_capa['rif_cont'],  
                         'nro_comprobante'=> $experi_empre_capa['nro_comprobante']
                         
                     );
                     $this->db->insert('certificacion.experi_empre_capa',$data_inf);
                 }

                 $this->db->where('rif_cont', $rif_cont);
                // $this->db->where('id_p_acc', 0);
                 $this->db->delete('certificacion.experi_empre_cap_comisi');

                 $cant_pff = $experi_empre_cap_comisi['organo_expe'];
                 $count_pff = count($cant_pff);

                 for ($i=0; $i < $count_pff; $i++) {

                     $data2 = array(
                        'nro_comprobante'             => $experi_empre_cap_comisi['nro_comprobante'],
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $experi_empre_cap_comisi['rif_cont'],
                        'organo_expe'   		        => $experi_empre_cap_comisi['organo_expe'][$i],
                        'actividad_exp'          	=> $experi_empre_cap_comisi['actividad_exp'][$i],
                        'desde_exp'             => $experi_empre_cap_comisi['desde_exp'][$i],
                        'hasta_exp' 	            => $experi_empre_cap_comisi['hasta_exp'][$i],
                     );
                     $this->db->insert('certificacion.experi_empre_cap_comisi',$data2);
                 }
         }
         return true;
        
    }


    public function certificaciones_id($data){
        $this->db->select('m.*');
        $this->db->from('certificacion.certificaciones m');
       
        $this->db->where('m.id', $data['id']);
    
        $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }




    public function guardar_proc_pag($data){
        // se guardan los fecha de vigencia 
    
        $this->db->select('e.id as id, e.rif_cont');
            $this->db->where('e.rif_cont', $data['rif_cont']);
            $query = $this->db->get('certificacion.certificaciones e');
            $response = $query->row_array();
          
                $id = $response['id'] + 0;
        $data1 = array('status' => $data['status'],
                        'vigen_cert_desde' => $data['vigen_cert_desde'],

                        'vigen_cert_hasta' => $data['vigen_cert_hasta'],
                        'user_snc_aprob' => $data['users'],
                        'fecha_status' => date('Y-m-d h:i:s'),
                        'observacion' => $data['observacion'],
                        
                    );
                   
                        
        $this->db->where('rif_cont', $data['rif_cont']);
        $update = $this->db->update('certificacion.certificaciones', $data1);

        //return true;
        return $id;
    
    } 


    //pdf
    public function ver_pdfs($data){
        $this->db->select('m.*, b.nombre_ape, b.cedula');
        $this->db->from('certificacion.certificaciones m');
        $this->db->join('certificacion.infor_per_natu b', 'b.id = m.id', 'left');
        $this->db->where('m.id', $data);
      $query = $this->db->get();
        $resultado = $query->row_array();
        return $resultado;
    }
    ///////////////////////////////////////////////registro pn
    public function cons_nro_comprobantenn(){
        $this->db->select('id,tipo_pers');
        $this->db->where('tipo_pers ', 2 );
        $this->db->order_by('id desc');
        $query = $this->db->get('certificacion.certificaciones ');
        $response = $query->row_array();
        return $response;
    }
    public function save_certificacion_pn($certifi, 
    $infor_per_natu,$infor_per_prof,$for_mat_contr_publ,$exp_par_comi_10,$exp_dic_cap_3){
        $this->db->select('max(e.id) as id');
        $query = $this->db->get('certificacion.certificaciones e');
        $response3 = $query->row_array();
        $id = $response3['id'] + 1 ;
        $certifi1 = array(

            'id'=> $id,
            'nro_comprobante'=> $certifi['nro_comprobante'],
            'n_certif'=> $certifi['n_certif'],
            'rif_cont'=> $certifi['rif_cont'],
            'nombre'=> $certifi['nombre'],
            'tipo_pers'=> $certifi['tipo_pers'],
            'objetivo'=> $certifi['objetivo'],
            'cont_prog'=> $certifi['cont_prog'],
            'total_bss'=> $certifi['total_bss'],
            'n_ref'=> $certifi['n_ref'],
            'banco_e'=> $certifi['banco_e'],
            'banco_rec'=> $certifi['banco_rec'],
            'fecha_trans'=> $certifi['fecha_trans'],
            'monto_trans'=> $certifi['monto_trans'],
            'declara'=> $certifi['declara'],
            'acepto' => $certifi['acepto'],
            'fecha_solic'=> $certifi['fecha_solic'],
            'user_soli'=> $certifi['user_soli'],
            'status' => $certifi['status'],
            );         
        $quers =$this->db->insert('certificacion.certificaciones',$certifi1);

            if ($quers) {

                $id = $id;

            
                    $data3 = array(
                        'id'              => $id,
                        'nro_comprobante'=> $certifi['nro_comprobante'],
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'nombre_ape'   		        => $infor_per_natu['nombre_ape'],
                        'cedula'          	=> $infor_per_natu['cedula'],
                        'rif'             => $infor_per_natu['rif'],
                        'bolivar_estimado' 	            => $infor_per_natu['bolivar_estimado'],
                        //'pj' 	            => $infor_per_natu['pj'],
                        'sub_total' 	            => $infor_per_natu['sub_total'],
                        'total_final' 	            => $infor_per_natu['total_bss'],
                       
                    );
                    $this->db->insert('certificacion.infor_per_natu',$data3);
                

                $cant_pfftt = $infor_per_prof['for_academica'];
                $count_pffrt = count($cant_pfftt);

                for ($i=0; $i < $count_pffrt; $i++) {
                    $data4 = array(
                        'id'              => $id,
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'for_academica'   		=> $infor_per_prof['for_academica'][$i],
                        'titulo'          	=> $infor_per_prof['titulo'][$i],
                        'ano'             => $infor_per_prof['ano'][$i],
                        'culminacion' 	 => $infor_per_prof['culminacion'][$i],
                        'curso' 	            => $infor_per_prof['curso'][$i],
                        'nro_comprobante'=> $certifi['nro_comprobante']
                        
                       
                    );
                    $this->db->insert('certificacion.infor_per_prof',$data4);
                }

                $cant_1 = $for_mat_contr_publ['taller'];
                $count_1 = count($cant_1);

                for ($i=0; $i < $count_1; $i++) {
                    $data5 = array(
                        'id'              => $id,
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'taller'   		=> $for_mat_contr_publ['taller'][$i],
                        'institucion'   => $for_mat_contr_publ['institucion'][$i],
                        'hor_dura'      => $for_mat_contr_publ['hor_dura'][$i],
                        'certi' 	 => $for_mat_contr_publ['certi'][$i],
                        'fech_cert' 	 => $for_mat_contr_publ['fech_cert'][$i],
                        'vigencia' 	   => $for_mat_contr_publ['vigencia'][$i],
                        'nro_comprobante'=> $certifi['nro_comprobante']
                        
                       
                    );
                    $this->db->insert('certificacion.for_mat_contr_publ',$data5);
                }
                $cant_2 = $exp_par_comi_10['organo10'];
                $count_3 = count($cant_2);

                for ($i=0; $i < $count_3; $i++) {
                    $data6 = array(
                        'id'              => $id,
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'organo10'   		=> $exp_par_comi_10['organo10'][$i],
                        'act_adminis_desid'   => $exp_par_comi_10['act_adminis_desid'][$i],
                        'n_acto'      => $exp_par_comi_10['n_acto'][$i],
                        'fecha_act' 	 => $exp_par_comi_10['fecha_act'][$i],
                        'area_10' 	 => $exp_par_comi_10['area_10'][$i],
                        'dura_comi' 	   => $exp_par_comi_10['dura_comi'][$i],
                       
                        
                       
                    );
                    $this->db->insert('certificacion.exp_par_comi_10',$data6);
                }

                $cant_4 = $exp_dic_cap_3['organo3'];
                $count_5 = count($cant_4);

                for ($i=0; $i < $count_5; $i++) {
                    $data7 = array(
                        'id'              => $id,
                        'n_certif'=> $certifi['n_certif'],
                        'rif_cont'=> $certifi['rif_cont'],
                        'organo3'   		=> $exp_dic_cap_3['organo3'][$i],
                        'actividad3'   => $exp_dic_cap_3['actividad3'][$i],
                        'desde3'      => $exp_dic_cap_3['desde3'][$i],
                        'hasta3' 	 => $exp_dic_cap_3['hasta3'][$i],
                       
                        
                       
                    );
                    $this->db->insert('certificacion.exp_dic_cap_3',$data7);
                }


            }
            return true;
    }


    public function llenar_contratista($data){
        $this->db_c->select('c.user_id,
                            c.edocontratista_id,
                            c.rifced,
                            c.numcertrnc,
                            c.nombre,
                            c.dirfiscal,
                            e.descedo,
                            c.ciudade_id,
                            c2.descciu,
                            m.descmun,
                            c.percontacto,
                            c.telf1,
                            c.ultprocaprob');
        $this->db_c->join('public.estados e', 'e.id = c.estado_id');
        $this->db_c->join('public.municipios m', 'm.id = c.municipio_id');
        $this->db_c->join('public.ciudades c2', 'c2.id = c.ciudade_id');
        $this->db_c->where('c.numcertrnc',$data['rif_b']);
        //$query = $this->db_c->get('public.contratistas c');
        $query = $this->db_c->get('evaluacion_desempenio.contratistas c');
        $result = $query->row_array();
            if ($result == '') {
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
                $this->db->where('c.numcertrnc',$data['rif_b']);
                $query = $this->db->get('evaluacion_desempenio.contratistas_nr c');
                return $result = $query->row_array();
            }else {
                return $result;
            }
    }
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


}