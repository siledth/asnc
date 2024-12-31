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
        public function objeto(){
            $this->db->select('id_objeto_contratacion,descripcion');
            $query = $this->db->get('public.objeto_contratacion');
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
        public function save_organismo($data1){       

            $this->db->select('*');
          //  $this->db->where('tipo_rif', $data['tipor']);
            $this->db->where('rif', $data1['rif']);
            $query2 = $this->db->get('organoente');
            $response2 = $query2->row_array();

            $this->db->select('max(e.codigo) as codigo');
            $query = $this->db->get('public.organoente e');
            $response4 = $query->row_array();


            $this->db->select('max(e.id_organoente) as id');
            $query = $this->db->get('public.organoente e');
            $response3 = $query->row_array();
            if ($response2) {
                return 'false';
            }else { 
                $id = $response3['id'] + 1 ;
                $codigo = $response4['codigo'] + 1 ;
                $data = array(
                    'id_organoente'		    => $id,
                    'id_organoenteads'		=> $data1['id_organoads'],
                    'tipo_organoente'		=> 0,//es un organo
                    'codigo'            => $id,
                    'descripcion'		=> $data1['descripcion'],
                    'cod_onapre'	 	=> $data1['cod_onapre'],
                    'siglas' 			=> $data1['siglas'],                    
                    'rif' 				=> $data1['tipor'].$data1['rif'],
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
                    'direccion' 	    => $data1['direccion_fiscal'],
                    'gaceta'	        => $data1['gaceta_oficial'],
                    'fecha_gaceta'		=> $data1['fecha_gaceta'],
                    'usuario'		    => $data1['usuario'],
                    'certificaciones'		    => 0,

                );
        //print_r($data);die;

                $this->db->insert("public.organoente",$data); //colo nombre de la tabla
               



                return true;
            }
        }

        // ENTES
        // public function consulta_organismo(){
        //     $this->db->select('id_organo, desc_organo');
        //     $query = $this->db->get('organos');
        //     return $result = $query->result_array();
        // }
        public function consulta_organo(){ //para inscribir un organo aun ente
          
            $this->db->select('id_organoente as id_organo, rif, descripcion as desc_organo,id_organoenteads,certificaciones');
            $this->db->where('certificaciones', '0');            
            $query = $this->db->get('public.organoente');  
            return $result = $query->result_array();
        }
        
        public function consulta_clasificacion(){
            $this->db->select('id_clasificacion, desc_clasificacion');
            $this->db->order_by('id_clasificacion asc');
            $query = $this->db->get('public.clasificacion');
            return $result = $query->result_array();
        }
        public function save_ente($data1){

            // $this->db->select('codigo');
            // $this->db->where('id_organoente', $data1['id_organo']);
            // $this->db->order_by('id_organoente desc');
            // $query = $this->db->get('organoente');
            // $response = $query->row_array();

            // $cod = $response['codigo'];
            // $separa = explode('-', $cod);
            // $letra = $separa['0'];
            // $codi = $separa['1'];
            // $codig = $codi + '00001';
            // $codigo = $letra.'-'.$codig;

            $this->db->select('*');
            //$this->db->where('tipo_rif', $data['tipo_rif']);
            $this->db->where('rif', $data1['rif']);
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
                    'id_organoenteads'		=> $data1['id_organoenteads'],
                    'tipo_organoente'		=> 2, // 2 porque es un ente 
                    'codigo'            => $id,
                    'descripcion'		=> $data1['descripcion'],
                    'cod_onapre'	 	=> $data1['cod_onapre'],
                    'siglas' 			=> $data1['siglas'],                    
                    'rif' 				=> $data1['tipor'].$data1['rif'],
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
                    'direccion' 	    => $data1['direccion_fiscal'],
                    'gaceta'	        => $data1['gaceta_oficial'],
                    'fecha_gaceta'		=> $data1['fecha_gaceta'],
                    'usuario'		    => $data1['usuario'],
                    'certificaciones'		    => 0,

                );
       // print_r($data);die;

                $this->db->insert("public.organoente",$data);
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
                    'id_organoenteads'		=> $data['id_organoenteads'],
                    'tipo_organoente'		=> 3,// 3 porque es un ente adcr
                    'codigo'            =>$id,                    
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
                    'certificaciones'		    => 0,


                );
                $this->db->insert("public.organoente",$data); //colo nombre de la tabla
                
                // $data2 = array(
                //     'id_entes_ads'		    => $id,
                //     'id_entes'		    => $data1['id_organoente'],
                //     'codigo'            => $id,
                //     'desc_entes_ads'	=> $data1['ente'],
                //     'cod_onapre'	 	=> $data1['cod_onapre'],
                //     'siglas' 			=> $data1['siglas'],
                //     'tipo_rif'			=> $data1['tipo_rif2'],
                //     'rif' 				=> $data1['rif'],
                //     'id_clasificacion' 	=> $data1['id_clasificacion'],
                //     'tel1' 		        => $data1['tel_local'],
                //     'tel2' 		        => $data1['tel_local_2'],
                //     'movil1'			=> $data1['tel_movil'],
                //     'movil2' 		    => $data1['tel_movil_2'],
                //     'pagina_web' 		=> $data1['pag_web'],
                //     'correo'			=> $data1['email'],
                //     'id_estado' 		=> $data1['id_estado'],
                //     'id_municipio' 		=> $data1['id_municipio'],
                //     'id_parroquia' 		=> $data1['id_parroquia'],
                //     'direccion_fiscal' 	=> $data1['direccion_fiscal'],
                //     'gaceta'	        => $data1['gaceta_oficial'],
                //     'fecha_gaceta'		=> $data1['fecha_gaceta'],
                //     'usuario'		    => $data1['usuario'],
                // );
                // $this->db->insert("entes_ads",$data2); //colo nombre de la tabla
                return true;
            }
        }
        function consultar_lis(){
            $this->db->select(' orn.id_organoente, orn.rif,
            orn.descripcion');
                // $this->db->join('p.ccnu c2','c2.codigo_ccnu = pi2.id_ccnu');
                // $this->db->join('programacion.partida_presupuestaria pp','pp.id_partida_presupuestaria = pi2.id_partidad_presupuestaria');
                // $this->db->join('programacion.unidad_medida um','um.id_unidad_medida = pi2.id_unidad_medida');
                // $this->db->join('programacion.p_acc_centralizada p','p.id_p_acc_centralizada = pi2.id_enlace');// esto viara cuando sea un proyecto consultar tabla proyecto
                // $this->db->where('pi2.id_enlace', $id_p_acc_centralizada);
                 $this->db->where('orn.certificaciones', 0);
                $this->db->from('public.organoente orn');
                $query = $this->db->get();
                return $query->result_array();
        }
         	///////////////////////////////consultar items para modal editar bienes
	public function read_list($data){
		$this->db->select(' orn.id_organoente, orn.rif, orn.id_organoenteads, orn.tipo_organoente, 
        orn.descripcion, orn.cod_onapre, orn.id_estado, orn.id_municipio, orn.id_parroquia, 
        orn.siglas, orn.direccion, orn.gaceta, orn.fecha_gaceta, orn.pagina_web, orn.correo, orn.tel1, orn.tel2,
        orn.movil1, orn.movil2, orn.usuario, orn.fecha, orn.codigo, orn.id_clasificacion, edo.descedo, mun.descmun , prq.descparro '
						);
		$this->db->from('public.organoente orn');
       $this->db->join('public.estados edo','edo.id = orn.id_estado', 'left');
       $this->db->join('public.municipios mun','mun.id = orn.id_municipio', 'left');
       $this->db->join('public.parroquias prq','prq.id = orn.id_parroquia', 'left');


      	$this->db->where('orn.id_organoente', $data['id_organoente']);
		// $this->db->order_by('mc.id_p_items desc');
		$query = $this->db->get();
		$resultado = $query->row_array();
		return $resultado;
	}

    public function llenar_edo($data){
        $this->db->select('pi2.id, pi2.descedo');
        $this->db->where('pi2.id !=', $data['id_estado']);
        $query = $this->db->get('public.estados pi2');
        return $query->result_array();
    }
   
    public function llenar_munic($data){
        $this->db->select('pi2.id, pi2.estado_id,  pi2.descmun');
        $this->db->where('pi2.estado_id =', $data['id_edos']);
        $query = $this->db->get('public.municipios pi2');
        return $result = $query->result_array();
    }
    public function llenar_parroq($data){
        $this->db->select('pi2.id, pi2.estado_id, pi2.descparro');
        $this->db->where('pi2.estado_id =', $data['id_edos']);
        $query = $this->db->get('public.parroquias pi2');
        return $result = $query->result_array();
    }
    public function save_modif_org1($data){

        $this->db->where('id_organoente', $data['id_organoente']);
    
        $pp_s = $data['cambio_edo'];
        if ($pp_s == 0) {
            $id_estado = $data['id_estado'];
        }else {
            $id_estado = $data['cambio_edo'];
        }
    
        $ccnu_s = $data['camb_muni'];
        if ($ccnu_s == 0) {
            $id_municipio = $data['id_municipio'];
        }else {
            $id_municipio = $data['camb_muni'];
        }
        $alcance = $data['camb_parrq'];
        if ($alcance == 0) {
            $id_parroquia = $data['id_parroquia'];
        }else {
            $id_parroquia = $data['camb_parrq'];
        }  
       
    
        $data1 = array(
            'descripcion'        => $data['descripcion'],
            'cod_onapre'         => $data['cod_onapre'],
            'correo'         => $data['correo'],
            'siglas'             => $data['siglas'],
            'pagina_web'         => $data['pagina_web'],
            'id_estado'          => $id_estado,
            'id_municipio'          => $id_municipio,
            'id_parroquia'          => $id_parroquia,
            'direccion'         => $data['direccion'],
            'tel1'         => $data['tel1'],
            'tel2'         => $data['tel2'],
            'movil1'         => $data['movil1'],
            'movil2'         => $data['movil2'],
            'gaceta'         => $data['gaceta'],      
           
    
    
        );
        $update = $this->db->update('public.organoente', $data1);
        return true;
    }
   
    public function valida_corre($email){
       
        $this->db->select('correo');
            $this->db->where('correo', $email);
            $query = $this->db->get('public.organoente');
        
            if ($query->num_rows() > 0) {               
                return 1;        
            } else {
                return 0;
            }
    }
    public function save_eng_ads($data1){

        // $this->db->select('codigo');
        // $this->db->where('id_organoente', $data1['id_organo']);
        // $this->db->order_by('id_organoente desc');
        // $query = $this->db->get('organoente');
        // $response = $query->row_array();

        // $cod = $response['codigo'];
        // $separa = explode('-', $cod);
        // $letra = $separa['0'];
        // $codi = $separa['1'];
        // $codig = $codi + '00001';
        // $codigo = $letra.'-'.$codig;

        $this->db->select('*');
        //$this->db->where('tipo_rif', $data['tipo_rif']);
        $this->db->where('rif', $data1['rif']);
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
                'id_organoenteads'		=> $data1['id_organoenteads'],
                'tipo_organoente'		=> 3, // 3 porque es un ente adscrito
                'codigo'            => $id,
                'descripcion'		=> $data1['descripcion'],
                'cod_onapre'	 	=> $data1['cod_onapre'],
                'siglas' 			=> $data1['siglas'],                    
                'rif' 				=> $data1['tipor'].$data1['rif'],
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
                'direccion' 	    => $data1['direccion_fiscal'],
                'gaceta'	        => $data1['gaceta_oficial'],
                'fecha_gaceta'		=> $data1['fecha_gaceta'],
                'usuario'		    => $data1['usuario'],
                'certificaciones'		    => 0,

            );
   // print_r($data);die;

            $this->db->insert("public.organoente",$data);
            return true;
        }
    }
    public function save_filiar($data1){       
        $this->db->select('max(e.filiar) as filiar1');
        $this->db->where('e.tipo_organoente', 4);
        //$this->db->group_by("e.filiar,e.tipo_organoente");
        $query = $this->db->get('public.organoente e');
        $response4 = $query->row_array();

        $this->db->select('max(e.id_organoente) as id');
        $query = $this->db->get('public.organoente e');
        $response3 = $query->row_array();
        $this->db->select('rif');
        $this->db->where('rif', 'G20007867');
        $query6 = $this->db->get('organoente');
        $response2 = $query6->row_array();
        if ($response2) {
            return 'false';
        }else { 
           
            $filiar1=$response4['filiar1'] + 1;
            $filiar2 = sprintf('F%09d', $filiar1);
           // $filiar2 = 'F' . (string)$filiar1;
           // print_r($filiar2);die;
            $id = $response3['id'] + 1 ;
            $data = array(
                'id_organoente'		    => $id,
                'id_organoenteads'		=> $data1['id_organoads'],
                'tipo_organoente'		=> 4,//es un filiar
                'codigo'            => $id,
                'descripcion'		=> $data1['descripcion'],
                'cod_onapre'	 	=> $data1['cod_onapre'],
                'siglas' 			=> $data1['siglas'],                    
                'rif' 				=> $filiar2,
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
                'direccion' 	    => $data1['direccion_fiscal'],
                'gaceta'	        => $data1['gaceta_oficial'],
                'fecha_gaceta'		=> $data1['fecha_gaceta'],
                'usuario'		    => $data1['usuario'],
                'certificaciones'		    => 0,
                'filiar'		    => $filiar1,
            );
          // print_r($data);die;

            $this->db->insert("public.organoente",$data); //colo nombre de la tabla
           



            return true;
        }
    }
}
?>