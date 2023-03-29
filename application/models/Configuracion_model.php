<?php
    class Configuracion_model extends CI_model{
        public function consulta_tipo_rif(){
            $this->db->select('*');
            $query = $this->db->get('tipo_rif');
            return $result = $query->result_array();
        }

        public function consulta_paises(){
            $this->db->select('*');
            $query = $this->db->get('public.paises');
             return $response = $query->result_array();
        }

        public function consulta_estados(){
            $this->db->select('*');
            $query = $this->db->get('public.estados');
             return $response = $query->result_array();
        }
        public function consulta_modalidad(){
            $this->db->select('*');
            $this->db->order_by('id asc');
            $query = $this->db->get('evaluacion_desempenio.modalidad');
             return $response = $query->result_array();
        }

        public function listar_municipio($data){
            $response = array();
            $this->db->select('*');
            $this->db->where('estado_id', $data['id_estado']);
            $query = $this->db->get('public.municipios');
            $response = $query->result_array();
            return $response;
        }

        public function listar_ciudades($data){
            $response = array();
            $this->db->select('*');
            $this->db->where('estado_id', $data['id_estado']);
            $query = $this->db->get('public.ciudades');
            $response = $query->result_array();
            return $response;
        }

        public function listar_parroquia($data){
            $response = array();
            $this->db->select('*');
            $this->db->where('estado_id', $data['id_municipio']);
            $query = $this->db->get('public.parroquias');
            $response = $query->result_array();
            return $response;
        }

        public function consulta_edo_civil(){
            $this->db->select('*');
            $query = $this->db->get('public.edo_civil');
            return $response = $query->result_array();
        }


        // Organismo
        public function save_organismo($data,$data1){
            $this->db->select('codigo');
            $this->db->order_by('codigo desc');
            $query = $this->db->get('organoente');
            $response = $query->row_array();

            $cod = $response['codigo'];
            $separa = explode('-', $cod);
            $letra = $separa['0'];
            $codi = $separa['1'];
            $codig = $codi + '00001';
            $codigo = $letra.'-'.$codig;

            $this->db->select('*');
          //  $this->db->where('tipo_rif', $data['tipor']);
            $this->db->where('rif', $data['rif']);
            $query2 = $this->db->get('organoente');
            $response2 = $query2->row_array();

            $this->db->select('max(e.id_organoente) as id');
            $query = $this->db->get('public.organoente e');
            $response3 = $query->row_array();
            if ($response2) {
                return 'false';
            }else { 
                $id = $response3['id'] + 1 ;
                $data = array(
                    'id_organoente'		    => $id,
                    'id_organoenteads'		=> $data['id_organoads'],
                    'tipo_organoente'		=> 0,
                    'codigo'            => $codigo,
                    'descripcion'		=> $data['descripcion'],
                    'cod_onapre'	 	=> $data['cod_onapre'],
                    'siglas' 			=> $data['siglas'],
                    
                    'rif' 				=> $data['tipor'].$data['rif'],
                    'id_clasificacion' 	=> $data['id_clasificacion'],
                    'tel1' 		        => $data['tel_local'],
                    'tel2' 		        => $data['tel_local_2'],
                    'movil1'			=> $data['tel_movil'],
                    'movil2' 		    => $data['tel_movil_2'],
                    'pagina_web' 		=> $data['pag_web'],
                    'correo'			=> $data['email'],
                    'id_estado' 		=> $data['id_estado'],
                    'id_municipio' 		=> $data['id_municipio'],
                    'id_parroquia' 		=> $data['id_parroquia'],
                    'direccion' 	    => $data['direccion_fiscal'],
                    'gaceta'	        => $data['gaceta_oficial'],
                    'fecha_gaceta'		=> $data['fecha_gaceta'],
                    'usuario'		    => $data['usuario'],
                );
                $this->db->insert("public.organoente",$data); //colo nombre de la tabla
                $data2= array(
        			'id_organoads'		=> $data1['id_organoads'],
                    'codigo'            => $codigo,
        			'desc_organo'		=> $data1['organo'],
        			'cod_onapre'	 	=> $data1['cod_onapre'],
        			'siglas' 			=> $data1['siglas'],
                    'tipo_rif'          => $data1['tipo_rif2'],
                    
                    'rif' 				=> $data1['rif'],
        			'id_clasificacion' 	=> $data1['id_clasificacion'],
        			'tel1' 		        => $data1['tel_local'],
        			'tel2' 		        => $data1['tel_local_2'],
        			'movil1'			=> $data1['tel_movil'],
        			'movil2' 		    => $data1['tel_movil_2'],
        			'pagina_web' 		=> $data1['pag_web'],
        			'correo'			=> $data1['email'],
        			'id_estado' 		=> $data1['id_estado'],
        			'id_municipio' 		=> $data1['id_municipio'],
        			'id_parroquia' 		=> $data1['id_parroquia'],
        			'direccion_fiscal' 	=> $data1['direccion_fiscal'],
        			'gaceta'	        => $data1['gaceta_oficial'],
        			'fecha_gaceta'		=> $data1['fecha_gaceta'],
                    'usuario'		    => $data1['usuario'],
        		);
                $this->db->insert("organos",$data2); //colo nombre de la tabla



                return true;
            }
        }

        // ENTES
        public function consulta_organismo(){
            $this->db->select('id_organo, desc_organo');
            $query = $this->db->get('organos');
            return $result = $query->result_array();
        }
        public function consulta_organo(){ //para inscribir un organo aun ente
            $this->db->select('id_organoente, descripcion,id_organoenteads');
            $query = $this->db->get('organoente');
            return $result = $query->result_array();
        }
        
        public function consulta_clasificacion(){
            $this->db->select('id_clasificacion, desc_clasificacion');
            $this->db->order_by('id_clasificacion asc');
            $query = $this->db->get('public.clasificacion');
            return $result = $query->result_array();
        }
        public function save_ente($data,$data1){

            $this->db->select('codigo');
            $this->db->order_by('codigo desc');
            $query = $this->db->get('organoente');
            $response = $query->row_array();

            $cod = $response['codigo'];
            $separa = explode('-', $cod);
            $letra = $separa['0'];
            $codi = $separa['1'];
            $codig = $codi + '00001';
            $codigo = $letra.'-'.$codig;

            $this->db->select('*');
            //$this->db->where('tipo_rif', $data['tipo_rif']);
            $this->db->where('rif', $data['rif']);
            $query2 = $this->db->get('organoente');
            $response2 = $query2->row_array();
            
            $this->db->select('max(e.id_organoente) as id');
            $query = $this->db->get('public.organoente e');
            $response3 = $query->row_array();

            if ($response2) {
                return 'false';
            }else {
                $id = $response3['id'] + 1 ;
                $data = array(
                    'id_organoente'		    => $id,
                    'id_organoenteads'		=> $data['id_organo'],
                    'tipo_organoente'		=> 2, // 2 porque es un ente 
                    'codigo'            => $codigo,
                    'descripcion'		=> $data['ente'],
                    'cod_onapre'	 	=> $data['cod_onapre'],
                    'siglas' 			=> $data['siglas'],
                    
                    'rif' 				=> $data['tipor'].$data['rif'],
                    'id_clasificacion' 	=> $data['id_clasificacion'],
                    'tel1' 		        => $data['tel_local'],
                    'tel2' 		        => $data['tel_local_2'],
                    'movil1'			=> $data['tel_movil'],
                    'movil2' 		    => $data['tel_movil_2'],
                    'pagina_web' 		=> $data['pag_web'],
                    'correo'			=> $data['email'],
                    'id_estado' 		=> $data['id_estado'],
                    'id_municipio' 		=> $data['id_municipio'],
                    'id_parroquia' 		=> $data['id_parroquia'],
                    'direccion' 	    => $data['direccion_fiscal'],
                    'gaceta'	        => $data['gaceta_oficial'],
                    'fecha_gaceta'		=> $data['fecha_gaceta'],
                    'usuario'		    => $data['usuario'],
                );
                $this->db->insert("public.organoente",$data); //colo nombre de la tabla
                
                $data2 = array(
                    'id_entes'		    => $id,
                    'id_organo'		=> $data1['id_organo'],
                   
                    'codigo'            => $codigo,
                    'desc_entes'		=> $data1['desc_entes'],
                    'cod_onapre'	 	=> $data1['cod_onapre'],
                    'siglas' 			=> $data1['siglas'],
                    'tipo_rif'          => $data1['tipo_rif2'],
                    
                    'rif' 				=> $data1['rif'],
                    'id_clasificacion' 	=> $data1['id_clasificacion'],
                    'tel1' 		        => $data1['tel_local'],
                    'tel2' 		        => $data1['tel_local_2'],
                    'movil1'			=> $data1['tel_movil'],
                    'movil2' 		    => $data1['tel_movil_2'],
                    'pagina_web' 		=> $data1['pag_web'],
                    'correo'			=> $data1['email'],
                    'id_estado' 		=> $data1['id_estado'],
                    'id_municipio' 		=> $data1['id_municipio'],
                    'id_parroquia' 		=> $data1['id_parroquia'],
                    'direccion_fiscal' 	    => $data1['direccion_fiscal'],
                    'gaceta'	        => $data1['gaceta_oficial'],
                    'fecha_gaceta'		=> $data1['fecha_gaceta'],
                    'usuario'		    => $data1['usuario']
                );
                
                $this->db->insert('public.entes', $data2);
                return true;
            }
        }

        // ENTES ADSCRITOS
        public function consulta_entes(){
            $this->db->select('id_entes, desc_entes');
            $this->db->order_by('id_entes');
            $query = $this->db->get('entes');
            return $result = $query->result_array();
        }

        public function save_ente_adscrito($data,$data1){

            $this->db->select('codigo');
            $this->db->order_by('codigo desc');
            $query = $this->db->get('organoente');
            $response = $query->row_array();

            $cod = $response['codigo'];
            $separa = explode('-', $cod);
            $letra = $separa['0'];
            $codi = $separa['1'];
            $codig = $codi + '00001';
            $codigo = $letra.'-'.$codig;

            $this->db->select('*');
            //$this->db->where('tipo_rif', $data['tipo_rif']);
            $this->db->where('rif', $data['rif']);
            $query2 = $this->db->get('organoente');

            $response2 = $query2->row_array();
            $this->db->select('max(e.id_organoente) as id');
            $query = $this->db->get('public.organoente e');
            $response3 = $query->row_array();


            if ($response2) {
                return 'false';
            }else {
                $id = $response3['id'] + 1 ;
                $data = array(
                    'id_organoente'		    => $id,
                    'id_organoenteads'		=> $data['id_organoente'],
                    'tipo_organoente'		=> 3,// 3 porque es un ente adcrito
                    
                    'codigo'            => $codigo,
                    'descripcion'		=> $data['ente'],
                    'cod_onapre'	 	=> $data['cod_onapre'],
                    'siglas' 			=> $data['siglas'],
                    'rif' 				=> $data['tipor'].$data['rif'],
                    'id_clasificacion' 	=> $data['id_clasificacion'],
                    'tel1' 		        => $data['tel_local'],
                    'tel2' 		        => $data['tel_local_2'],
                    'movil1'			=> $data['tel_movil'],
                    'movil2' 		    => $data['tel_movil_2'],
                    'pagina_web' 		=> $data['pag_web'],
                    'correo'			=> $data['email'],
                    'id_estado' 		=> $data['id_estado'],
                    'id_municipio' 		=> $data['id_municipio'],
                    'id_parroquia' 		=> $data['id_parroquia'],
                    'direccion' 	    => $data['direccion_fiscal'],
                    'gaceta'	        => $data['gaceta_oficial'],
                    'fecha_gaceta'		=> $data['fecha_gaceta'],
                    'usuario'		    => $data['usuario'],
                );
                $this->db->insert("public.organoente",$data); //colo nombre de la tabla
                
                $data2 = array(
                    'id_entes_ads'		    => $id,
                    'id_entes'		    => $data1['id_organoente'],
                    'codigo'            => $codigo,
                    'desc_entes_ads'	=> $data1['ente'],
                    'cod_onapre'	 	=> $data1['cod_onapre'],
                    'siglas' 			=> $data1['siglas'],
                    'tipo_rif'			=> $data1['tipo_rif2'],
                    'rif' 				=> $data1['rif'],
                    'id_clasificacion' 	=> $data1['id_clasificacion'],
                    'tel1' 		        => $data1['tel_local'],
                    'tel2' 		        => $data1['tel_local_2'],
                    'movil1'			=> $data1['tel_movil'],
                    'movil2' 		    => $data1['tel_movil_2'],
                    'pagina_web' 		=> $data1['pag_web'],
                    'correo'			=> $data1['email'],
                    'id_estado' 		=> $data1['id_estado'],
                    'id_municipio' 		=> $data1['id_municipio'],
                    'id_parroquia' 		=> $data1['id_parroquia'],
                    'direccion_fiscal' 	=> $data1['direccion_fiscal'],
                    'gaceta'	        => $data1['gaceta_oficial'],
                    'fecha_gaceta'		=> $data1['fecha_gaceta'],
                    'usuario'		    => $data1['usuario'],
                );
                $this->db->insert("entes_ads",$data2); //colo nombre de la tabla
                return true;
            }
        }
    }
?>
