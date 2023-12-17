<?php
    class Publicaciones_model extends CI_model{
		
		public function consultar_numeropro($data){
            $this->db->select('m.*');
            $this->db->from('public.llamado_concurso m');
            $this->db->where('m.numero_proceso', $data['numero_proceso']);
            $query = $this->db->get();
            $resultado = $query->row_array();
            return $resultado;
	    }
		public function consulta_llamados($rif){
            $this->db->select('*');
            $this->db->from('public.llamado_concurso_view');
            $this->db->where('rif_organoente', $rif);
		
            $query = $this->db->get();
            return $result = $query->result_array();
        }
		public function consulta_anulacion($rif){
            $this->db->select('*');
            $this->db->from('public.llamado_concurso');
            $this->db->where('rif_organoente', $rif);
            $query = $this->db->get();
            return $result = $query->result_array();
        }
		public function consulta_anulacion_general(){
            $this->db->select('m.*,
			b.descripcion');
			$this->db->join('public.organoente b', 'b.rif = m.rif_organoente');
            $this->db->from('public.llamado_concurso m');
			
            $this->db->where('estatus', "2");
            $query = $this->db->get();
            return $result = $query->result_array();
        }
		
		   public function inf_1($data ){
           
            $this->db->select('*');
            $this->db->where('numero_proceso', $data );
            $query = $this->db->get('public.llamado_concurso_view');
            return $query->result_array();
        }
		public function causa_b(){
            $this->db->select('*');
            $this->db->from('public.causa_anulacion');
			$this->db->order_by("id", "Asc");
            $this->db->where('estatus', 2);
            $query = $this->db->get();
            return $result = $query->result_array();
        }
		public function causa_suspencion(){
            $this->db->select('*');
            $this->db->from('public.causa_anulacion');
			$this->db->order_by("id", "Asc");
            $this->db->where('id', 4);
            $query = $this->db->get();
            return $result = $query->result_array();
        }
		public function supuestos(){
            $this->db->select('*');
            $this->db->from('public.causa_anulacion');
			$this->db->order_by("id", "Asc");
            $this->db->where('id >', 4);
			$this->db->where('id <', 9);
            $query = $this->db->get();
            return $result = $query->result_array();
        }
		public function causa_prorroga(){
           
			$this->db->select('descripcion,estatus');	
			$this->db->where('estatus', 5);
			$query = $this->db->get('public.causa_anulacion');
			return $query->result_array();
		}
		
		public function causa_reiniciado(){
           
			$this->db->select('descripcion,estatus');	
			$this->db->where('estatus', 6);
			$query = $this->db->get('public.causa_anulacion');
			return $query->result_array();
		}
		public function terminar_manual(){
           
			$this->db->select('descripcion,estatus');	
			$this->db->where('id', '10');
			$query = $this->db->get('public.causa_anulacion');
			return $query->result_array();
		}
		
		public function guardar_anulaciones($anular, $numero_proceso,$numero_proceso2){

               
			$this->db->where('numero_proceso', $numero_proceso);
        
            $update = $this->db->update('public.llamado_concurso', $anular);
			$query = $this->db->query("insert into historico_llamado_concurso (  rif_organoente, numero_proceso, id_modalidad, id_mecanismo, 
			id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, 
			fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, 
			descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, 
			id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, 
			direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria
			)
			select  rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles,
			 fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, 
			 descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre,
			  id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, 
			  especifique_anulacion, fecha_inicio_aclaratoria
			FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso2'" 
									 );
           
            return true;
        }
		/////////////////////////Guardar Prorroga
		
		public function guardar_Prorroga($data){
			$numero_proceso=$data['numero_proceso'];
			$this->db->select('max(e.id) as id');
                 $query = $this->db->get('historico_llamado_concurso  e');
				 $this->db->where('numero_proceso', $numero_proceso);
                 $response3 = $query->row_array();
                 $id = $response3['id'] + 1 ;
               
			//esto guarda el primer registro
			$query = $this->db->query("insert into historico_llamado_concurso (id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, 
			fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   )
		   select $id, rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso'" 
									 );
									 ////esto actualiza la tabla llamado a concurso 
			 $this->db->where('numero_proceso', $numero_proceso);
        
			 $update = $this->db->update('public.llamado_concurso', $data);
			 //// esto guarda el historico de este cambio en el llamado
			 $this->db->select('max(e.id) as id');
			 $query = $this->db->get('historico_llamado_concurso  e');
			 $this->db->where('numero_proceso', $numero_proceso);
			 $response4 = $query->row_array();
			 $id1 = $response4['id'] + 1 ;
			 $query = $this->db->query("insert into historico_llamado_concurso (id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo,
			  id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado,
			   denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, 
			   id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, 
			fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   )
		   select  $id1,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, 
		   fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso,
		    descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, 
			hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones,
			 estatus, especifique_anulacion, fecha_inicio_aclaratoria, fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso'and estatus='5'" 
									 );
            return true;
        }
		///////////////////////guardar suspencion
		public function guardar_suspencion($data){
			$numero_proceso=$data['numero_proceso'];
			$this->db->select('max(e.id) as id');
			$query = $this->db->get('historico_llamado_concurso  e');
			$this->db->where('numero_proceso', $numero_proceso);
			$response3 = $query->row_array();
			$id = $response3['id'] + 1 ;
			//esto guarda el primer registro
			$query = $this->db->query("insert into historico_llamado_concurso (id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, 
			fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   )
		   select $id, rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso'" 
									 );
									 ////esto actualiza la tabla llamado a concurso 
			 $this->db->where('numero_proceso', $numero_proceso);
        
			 $update = $this->db->update('public.llamado_concurso', $data);
			 //// esto guarda el historico de este cambio en el llamado
			 $this->db->select('max(e.id) as id');
			 $query = $this->db->get('historico_llamado_concurso  e');
			 $this->db->where('numero_proceso', $numero_proceso);
			 $response4 = $query->row_array();
			 $id1 = $response4['id'] + 1 ;
			 $query = $this->db->query("insert into historico_llamado_concurso (id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, 
			fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   )
		   select  $id1, rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso'and estatus='7'" 
									 );
            return true;
        }
		/////////////////////////////reiniciar////////////
		public function guardar_reinicio($data){
			$numero_proceso=$data['numero_proceso'];
			$this->db->select('max(e.id) as id');
                 $query = $this->db->get('historico_llamado_concurso  e');
				 $this->db->where('numero_proceso', $numero_proceso);
                 $response3 = $query->row_array();
                 $id = $response3['id'] + 1 ;
               
			//esto guarda el primer registro
			$query = $this->db->query("insert into historico_llamado_concurso (id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, 
			fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   )
		   select  $id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso'" 
									 );
									 ////esto actualiza la tabla llamado a concurso 
			 $this->db->where('numero_proceso', $numero_proceso);
        
			 $update = $this->db->update('public.llamado_concurso', $data);
			 //// esto guarda el historico de este cambio en el llamado
			 $this->db->select('max(e.id) as id');
			 $query = $this->db->get('historico_llamado_concurso  e');
			 $this->db->where('numero_proceso', $numero_proceso);
			 $response4 = $query->row_array();
			 $id1 = $response4['id'] + 1 ;
			 $query = $this->db->query("insert into historico_llamado_concurso (id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, 
			fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   )
		   select $id1, rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso'and estatus='6'" 
									 );
            return true;
        }
		///////////////////////terminacion

		public function guar_termino($data){
			$numero_proceso=$data['numero_proceso'];
			$this->db->select('max(e.id) as id');
                 $query = $this->db->get('historico_llamado_concurso  e');
				 $this->db->where('numero_proceso', $numero_proceso);
                 $response3 = $query->row_array();
                 $id = $response3['id'] + 1 ;
               
			//esto guarda el primer registro
			$query = $this->db->query("insert into historico_llamado_concurso (id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, 
			fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   )
		   select  $id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso'" 
									 );
									 ////esto actualiza la tabla llamado a concurso 
			 $this->db->where('numero_proceso', $numero_proceso);
        
			 $update = $this->db->update('public.llamado_concurso', $data);
			 //// esto guarda el historico de este cambio en el llamado
			 $this->db->select('max(e.id) as id');
			 $query = $this->db->get('historico_llamado_concurso  e');
			 $this->db->where('numero_proceso', $numero_proceso);
			 $response4 = $query->row_array();
			 $id1 = $response4['id'] + 1 ;
			 $query = $this->db->query("insert into historico_llamado_concurso (id,rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, 
			fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   )
		   select $id1, rif_organoente, numero_proceso, id_modalidad, id_mecanismo, id_objeto_contratacion, dias_habiles, fecha_llamado, fecha_disponible_llamado, fecha_fin_aclaratoria, fecha_tope, fecha_fin_llamado, denominacion_proceso, descripcion_contratacion, web_contratante, hora_desde, hora_hasta, id_estado, id_municipio, direccion, hora_desde_sobre, id_estado_sobre, id_municipio_sobre, direccion_sobre, lugar_entrega, observaciones, estatus, especifique_anulacion, fecha_inicio_aclaratoria, fecha_cam_estatus, articulo, id_usuario, fecha45dias
		   FROM public.llamado_concurso
			where numero_proceso= '$numero_proceso'and estatus='0'" 
									 );
            return true;
        }

		function consulta_llamado($data1){
			//$id=$data['numero_proceso'];
			$query = $this->db->query("SELECT c.rif_organoente, c.numero_proceso, c.id_modalidad, 
			c.id_mecanismo, c.id_objeto_contratacion, c.dias_habiles, 
			c.fecha_llamado, c.fecha_disponible_llamado, c.fecha_fin_aclaratoria, 
			c.fecha_tope, c.fecha_fin_llamado, 
			c.denominacion_proceso, c.descripcion_contratacion, 
			c.web_contratante, c.hora_desde, c.hora_hasta, 
			c.id_estado, c.id_municipio, c.direccion, 
			c.hora_desde_sobre, c.id_estado_sobre, c.id_municipio_sobre, 
			c.direccion_sobre, c.lugar_entrega, c.observaciones, 
			 c.idestatus, c.fecha_inicio_aclaratoria, 
			c.mecanismo, c.modalidad, c.objeto_contratacion, c.estado, c.municipio,
			 c.organoente, c.siglas, c.estado_sobre, c.municipio_sobre, 
			 c.id_llcestatus, c.estatus, m.descripcion as descr, obj.descripcion as obj
			 FROM public.llamado_concurso_view c 
			 left join public.modalidad m on m.id_modalidad = c.id_modalidad
			 left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
			 join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
			 where numero_proceso = '$data1'");
			if($query->num_rows()>0){
				return $query->result();
			}
			else{
				return NULL;
			}
		}
		/////////////////////////////////////////////////
	//CRUP BANCO
		function consultar_b(){
			$this->db->select('*');
			$this->db->from('publicaciones.banco');
			$this->db->order_by("codigo_b", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_b($data){
			$this->db->insert('publicaciones.banco',$data);
			return true;
		}
		//VER PARA EDITAR
		function consulta_b($data){
			$this->db->select('*');
			$this->db->from('publicaciones.banco');
			$this->db->where('id_banco', $data['id_banco']);
			$this->db->order_by("codigo_b", "Asc");
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->row();
			}
		}
		//EDITAR
		function editar_b($data){
			$this->db->where('id_banco', $data['id_banco']);
			$update = $this->db->update('publicaciones.banco', $data);
			return true;
		}
		//ELIMAR
		function eliminar_b($data){
			$this->db->where('id_banco', $data['id_banco']);
			$query = $this->db->delete('publicaciones.banco');
			return true;
		}
	////////////////////////////////////////////////////////////////
	//CRUP CUENTA
		function consultar_tc(){
			$this->db->select('*');
			$this->db->from('publicaciones.tipocuenta');
			$this->db->order_by("id_tipocuenta", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_tc($data){
			$this->db->insert('publicaciones.tipocuenta',$data);
			return true;
		}
		//VER PARA EDITAR
		function consulta_tc($data){
			$this->db->select('*');
			$this->db->from('publicaciones.tipocuenta');
			$this->db->where('id_tipocuenta', $data['id_tipocuenta']);
			$this->db->order_by("id_tipocuenta", "Asc");
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->row();
			}
		}//EDITAR
		function editar_tc($data){
			$this->db->where('id_tipocuenta', $data['id_tipocuenta']);
			$update = $this->db->update('publicaciones.tipocuenta', $data);
			return true;
		}
		//ELIMAR
		function eliminar_tc($data){
			$this->db->where('id_tipocuenta', $data['id_tipocuenta']);
			$query = $this->db->delete('publicaciones.tipocuenta');
			return true;
		}
	////////////////////////////////////////////////////////////////
	//CRUP DATOS BANCARIOS
		function consultar_datosb($usuario){
			$this->db->select('d.id_datosb,
								d.id_banco,
								b.nombre_b,
								d.id_tipocuenta,
								t.tipo_cuenta,
								concat(b.codigo_b,\' \',b.nombre_b) as nombre_b,
								d.n_cuenta,
								d.beneficiario');
			$this->db->join('publicaciones.banco b', 'b.id_banco = d.id_banco');
			$this->db->join('publicaciones.tipocuenta t', 't.id_tipocuenta = d.id_tipocuenta');
			$this->db->from('publicaciones.datosbancarios d');
			$this->db->where('d.id_usuario', $usuario);
			$this->db->order_by("d.id_datosb", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_datosb($data){
			$this->db->insert('publicaciones.datosbancarios',$data);
			return true;
		}
		//EDITAR
		function consulta_datosba($data){
			$this->db->select('d.id_datosb,
								d.id_banco,
								b.nombre_b,
								d.id_tipocuenta,
								t.tipo_cuenta,
								concat(b.codigo_b,\' \',b.nombre_b) as nombre_b,
								d.n_cuenta,
								d.beneficiario');
			$this->db->join('publicaciones.banco b', 'b.id_banco = d.id_banco');
			$this->db->join('publicaciones.tipocuenta t', 't.id_tipocuenta = d.id_tipocuenta');
			$this->db->from('publicaciones.datosbancarios d');
			$this->db->where('d.id_datosb', $data['id_datob']);
			$this->db->order_by("d.id_datosb", "Asc");
			$query = $this->db->get();
			return $query->row();
		}
		//CONSULTAS
		function consulta_bancoe($data){
				$this->db->select('*');
				$this->db->from('publicaciones.banco');
				$this->db->where('id_banco !=', $data['id_banco']);
				$this->db->order_by("codigo_b", "Asc");
				$query = $this->db->get();
				if (count($query->result()) > 0) {
					return $query->result_array();
				}
		}
		function consulta_tipocentae($data){
			$this->db->select('*');
			$this->db->from('publicaciones.tipocuenta');
			$this->db->where('id_tipocuenta !=', $data['id_tipocuenta']);
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->result_array();
			}
		}
		function editar_datosb($data, $id_datosb){
			$this->db->where('id_datosb', $id_datosb);
			$update = $this->db->update('publicaciones.datosbancarios', $data);
			return true;
		}
		//ELIMAR
		function eliminar_datosb($data){
			$this->db->where('id_datosb', $data['id_datosb']);
			$query = $this->db->delete('publicaciones.datosbancarios');
			return true;
		}
	////////////////////////////////////////////////////////////////
	//CRUP DATOS MODALIDAD
		function consultar_m(){
			$this->db->select('*');
			$this->db->from('publicaciones.modalidad');
			$this->db->order_by("id_modalidad", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_modalidad($data){
			$this->db->insert('publicaciones.modalidad',$data);
			return true;
		}
		//VER PARA EDITAR
		function consulta_mod($data){
			$this->db->select('*');
			$this->db->from('publicaciones.modalidad');
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->row();
			}
		}
		//EDITAR
		function editar_m($data){
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$update = $this->db->update('publicaciones.modalidad', $data);
			return true;
		}
		//ELIMAR
		function eliminar_m($data){
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$query = $this->db->delete('publicaciones.modalidad');
			return true;
		}
	////////////////////////////////////////////////////////////////
	//CRUP DATOS MECANISMO
		function consultar_mec(){
			$this->db->select('m.id_mecanismo,
								m.id_modalidad,
								m.decr_mecanismo,
								m2.decr_modalidad');
			$this->db->from('publicaciones.mecanismo m');
			$this->db->join('publicaciones.modalidad m2', 'm2.id_modalidad = m.id_modalidad');
			$this->db->order_by("id_mecanismo", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_mec($data){
			$this->db->insert('publicaciones.mecanismo',$data);
			return true;
		}

		function consulta_modalidades($data){
			$this->db->select('*');
			$this->db->from('publicaciones.modalidad');
			$this->db->where('id_modalidad !=', $data['id_modalidad']);
			$this->db->order_by("id_modalidad", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}

		function consulta_mec($data){
			$this->db->select('m.id_mecanismo,
								m.id_modalidad,
								m.decr_mecanismo,
								m2.decr_modalidad');
			$this->db->from('publicaciones.mecanismo m');
			$this->db->join('publicaciones.modalidad m2', 'm2.id_modalidad = m.id_modalidad');
      		$this->db->where('m.id_mecanismo', $data['id_mecanismo']);
			$this->db->order_by("id_mecanismo", "Asc");
			$query = $this->db->get();
			return $query->row_array();
		}
		//EDITAR
		function editar_mec($data){
			$this->db->where('id_mecanismo', $data['id_mecanismo']);
			$update = $this->db->update('publicaciones.mecanismo', $data);
			return true;
		}
		//ELIMAR
		function eliminar_mec($data){
			$this->db->where('id_mecanismo', $data['id_mecanismo']);
			$query = $this->db->delete('publicaciones.mecanismo');
			return true;
		}
	/////////////
	//CRUD ACTIVIDAD
		function consulta_actividades(){
			$this->db->select('a.id_actividad,
								a.id_modalidad,
								m.decr_modalidad,
								a.id_mecanismo,
								m2.decr_mecanismo,
								a.id_obj_cont,
								oc.desc_objeto_contrata,
								a.dias');
			$this->db->from('publicaciones.actividad a');
			$this->db->join('publicaciones.modalidad m', 'm.id_modalidad = a.id_modalidad');
			$this->db->join('publicaciones.mecanismo m2', 'm2.id_mecanismo = a.id_mecanismo');
			$this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = a.id_obj_cont ');
			$this->db->order_by("id_actividad", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}

		function buscar_mec($data){
			$this->db->select('*');
			$this->db->from('publicaciones.mecanismo m');
			$this->db->where('m.id_modalidad', $data['id_modalidad']);
			$query = $this->db->get();
			return $query->result_array();
		}
		function consulta_obj_cont(){
            $this->db->select('*');
            $query = $this->db->get('programacion.objeto_contrata');
            return $result = $query->result_array();
        }
		//GUARDAR
		function registrar_act($data){
			$this->db->insert('publicaciones.actividad',$data);
			return true;
		}
		function consulta_mecanismos($data){
			$this->db->select('*');
			$this->db->from('publicaciones.mecanismo');
			$this->db->where('id_mecanismo !=', $data['id_mecanismo']);
			$this->db->order_by("id_mecanismo", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		function consulta_objconta($data){
			$this->db->select('*');
			$this->db->from('programacion.objeto_contrata');
			$this->db->where('id_objeto_contrata !=', $data['id_obj_cont']);
			$this->db->order_by("id_objeto_contrata", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		function consulta_act($data){
			$this->db->select('a.id_actividad,
								a.id_modalidad,
								m.decr_modalidad,
								a.id_mecanismo,
								m2.decr_mecanismo,
								a.id_obj_cont,
								oc.desc_objeto_contrata,
								a.dias');
			$this->db->from('publicaciones.actividad a');
			$this->db->join('publicaciones.modalidad m', 'm.id_modalidad = a.id_modalidad');
			$this->db->join('publicaciones.mecanismo m2', 'm2.id_mecanismo = a.id_mecanismo');
			$this->db->join('programacion.objeto_contrata oc', 'oc.id_objeto_contrata = a.id_obj_cont ');
			$this->db->where('id_actividad', $data['id_actividad']);
			$this->db->order_by("id_actividad", "Asc");
			$query = $this->db->get();
			return $query->row_array();
		}
		//EDITAR
		function editar_act($data){
			$this->db->where('id_actividad', $data['id_actividad']);
			$update = $this->db->update('publicaciones.actividad', $data);
			return true;
		}
		//ELIMAR
		function eliminar_act($data){
			$this->db->where('id_actividad', $data['id_actividad']);
			$query = $this->db->delete('publicaciones.actividad');
			return true;
		}
	//CRUD FERIADOS NACIONALES
		function consultar_d(){
			$this->db->select('*');
			$this->db->from('publicaciones.feriados_nacionales');
			$this->db->order_by("id_feriado_n", "Asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		//GUARDAR
		function registrar_fer($data){
			$this->db->insert('publicaciones.feriados_nacionales',$data);
			return true;
		}
		//VER PARA EDITAR
		function consulta_d($data){
			$this->db->select('*');
			$this->db->from('publicaciones.feriados_nacionales');
			$this->db->where('id_feriado_n', $data['id_feriado_n']);
			$query = $this->db->get();
			if (count($query->result()) > 0) {
				return $query->row();
			}
		}
		//EDITAR
		function editar_d($data){
			$this->db->where('id_feriado_n', $data['id_feriado_n']);
			$update = $this->db->update('publicaciones.feriados_nacionales', $data);
			return true;
		}
		//ELIMAR
		function eliminar_d($data){
			$this->db->where('id_feriado_n', $data['id_feriado_n']);
			$query = $this->db->delete('publicaciones.feriados_nacionales');
			return true;
		}
	//CRUD FERIADOS ESTADALES
		
	//LLAMADO A CONCURSO
		function buscar_act($data){
			$this->db->select('*');
			$this->db->from('publicaciones.actividad');
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$this->db->where('id_mecanismo', $data['id_mecanismo']);
			$this->db->where('id_obj_cont', $data['id_obj_cont']);
			$query = $this->db->get();
			return $query->result_array();
		}
		function buscar_act_e($data){
			$this->db->select('*');
			$this->db->from('publicaciones.actividad');
			$this->db->where('id_actividad', $data['id_actividad']);
			$query = $this->db->get();
			return $query->row_array();
		}
		function buscar_obj($data){
			$this->db->select('*');
			$this->db->from('programacion.objeto_contrata');
			$this->db->where('id_modalidad', $data['id_modalidad']);
			$query = $this->db->get();
			return $query->result_array();
		}
	

	function consultar_llamados_externos(){
		$this->db->select('*');
		$this->db->from('public.llamado_concurso_view');
	   // $this->db->order_by("codigo_b", "Asc");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function generar($date){
		$data1 = array('estatus' => '1');		    
            $this->db->where('fecha_fin_llamado', $date);
			$this->db->where('estatus >', '3');
			$this->db->where('estatus <', '7');
            $update = $this->db->update('public.llamado_concurso', $data1);

            return true;
           // return $id;
	}
	public function generar1(){
		$query = $this->db->query("UPDATE llamado_concurso SET numero_proceso=rtrim(numero_proceso)");

		// $data1 = array('estatus' => '1');		    
        //     $this->db->where('fecha_fin_llamado', $date);
		// 	$this->db->where('estatus >', '3');
		// 	$this->db->where('estatus <', '7');
        //     $update = $this->db->update('public.llamado_concurso', $data1);

            return true;
           // return $id;
	}
	public function generar2(){
		$query = $this->db->query("UPDATE llamado_concurso SET numero_proceso=trim(numero_proceso);");

		// $data1 = array('estatus' => '1');		    
        //     $this->db->where('fecha_fin_llamado', $date);
		// 	$this->db->where('estatus >', '3');
		// 	$this->db->where('estatus <', '7');
        //     $update = $this->db->update('public.llamado_concurso', $data1);

            return true;
           // return $id;
	}
	public function generar3(){
		$query = $this->db->query("UPDATE llamado_concurso SET numero_proceso=SUBSTRING(numero_proceso,2) WHERE LEFT(numero_proceso,1)=' '");

		// $data1 = array('estatus' => '1');		    
        //     $this->db->where('fecha_fin_llamado', $date);
		// 	$this->db->where('estatus >', '3');
		// 	$this->db->where('estatus <', '7');
        //     $update = $this->db->update('public.llamado_concurso', $data1);

            return true;
           // return $id;
	}


	 function ver_deudas(){
		$this->db->select('*');
					$this->db->from('public.llamado_concurso');
					
					$query = $this->db->get();
					$resultado = $query->result_array();
		return $resultado;
	}
	public function consultar_historico_llamados_externos($data){

		$this->db->select('id,rif_organoente,organoente,numero_proceso,estatus,objeto_contratacion,fecha_disponible_llamado as formatted_date,fecha_disponible_llamado,denominacion_proceso,estado');
		$this->db->from('public.llamado_concurso_historial_view');
		$this->db->where('rif_organoente', $data['id_unidad']);
		$this->db->where('fecha_cam_estatus >=', $data['desde']);
        $this->db->where('fecha_cam_estatus <=', $data['hasta']);
	   // $this->db->where('fecha_disponible_llamado <=', $date);
		$this->db->order_by("fecha_disponible_llamado", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	function consulta_llamado_statu($data){
		$id=$data['id'];
		$this->db->select('c.*, m.descripcion, me.descripcion as descr, obj.descripcion as obj');
		$this->db->join('public.modalidad m', 'm.id_modalidad = c.id_modalidad');
		$this->db->join('public.mecanismo me', 'me.id_mecanismo = c.id_mecanismo');
		$this->db->join('public.objeto_contratacion obj', 'obj.id_objeto_contratacion = c.id_objeto_contratacion');
		$this->db->from('public.llamado_concurso_historial_view c');
		$this->db->where("id",$id);
	   // $this->db->order_by("codigo_b", "Asc");
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}
	}
	public function consultar_historico_llamados_externos2($data,$rif){
		
		if ($rif == 'G200024518')  {
			$this->db->select('id,rif_organoente,organoente,numero_proceso,estatus,objeto_contratacion,fecha_disponible_llamado as formatted_date,fecha_disponible_llamado,denominacion_proceso,estado');
		$this->db->from('public.llamado_concurso_historial_view');
	   // $this->db->where('fecha_disponible_llamado <=', $date);
		$this->db->order_by("fecha_disponible_llamado", "desc");
		$query = $this->db->get();
		return $query->result_array();
		} else {
			$this->db->select('id,rif_organoente,organoente,numero_proceso,estatus,objeto_contratacion,fecha_disponible_llamado as formatted_date,fecha_disponible_llamado,denominacion_proceso,estado');
		$this->db->from('public.llamado_concurso_historial_view');
		$this->db->where('rif_organoente', $rif);
	   // $this->db->where('fecha_disponible_llamado <=', $date);
		$this->db->order_by("fecha_disponible_llamado", "desc");
		$query = $this->db->get();
		return $query->result_array();# code...
		}
		
		
	}
	
	public function consultar_llamados_externos12($id_objeto,$date,$id_estado){

		$this->db->select('rif_organoente,organoente,numero_proceso,estatus,id_estado,id_objeto_contratacion,objeto_contratacion,fecha_disponible_llamado as formatted_date,fecha_disponible_llamado,denominacion_proceso,estado');
		$this->db->from('public.llamado_concurso_view');
		$this->db->where ("id_llcestatus >", "3");
		$this->db->where ("id_estado", $id_estado);
		$this->db->where ("id_objeto_contratacion", $id_objeto);
	   // $this->db->where('fecha_disponible_llamado <=', $date); activar esto cuando este en produccion
		$this->db->order_by("fecha_disponible_llamado", "desc");
		$query = $this->db->get();
		return $query->result_array();
	  
	
	}
	/////////////////////consulta interna
	public function consultar_llamados_internos($date,$rif){
		if ($rif == 'G200024518')  {
		$this->db->select('rif_organoente,organoente,numero_proceso,estatus,objeto_contratacion,fecha_disponible_llamado as formatted_date,fecha_disponible_llamado,denominacion_proceso,estado');
		$this->db->from('public.llamado_concurso_view');
	   // $this->db->where('fecha_disponible_llamado <=', $date);
		$this->db->order_by("fecha_disponible_llamado", "desc");
		$query = $this->db->get();
		return $query->result_array();
	} else {
		$this->db->select('rif_organoente,organoente,numero_proceso,estatus,objeto_contratacion,fecha_disponible_llamado as formatted_date,fecha_disponible_llamado,denominacion_proceso,estado');
		$this->db->from('public.llamado_concurso_view');
		$this->db->where('rif_organoente', $rif);
	   // $this->db->where('fecha_disponible_llamado <=', $date);
		$this->db->order_by("fecha_disponible_llamado", "desc");
		$query = $this->db->get();
		return $query->result_array();

	}
	  
	
	}

	/////fpdf consulta 
	function consulta_llamado($data1){
		$query1 = $this->db->query("SELECT  TRIM(BOTH FROM ' $data1  '),
        TRIM(' $data1  ' ");
		//$id=$data['numero_proceso'];
		$query = $this->db->query("SELECT c.rif_organoente, c.numero_proceso, c.id_modalidad, 
		c.id_mecanismo, c.id_objeto_contratacion, c.dias_habiles, 
		c.fecha_llamado, c.fecha_disponible_llamado, c.fecha_fin_aclaratoria, 
		c.fecha_tope, c.fecha_fin_llamado, 
		c.denominacion_proceso, c.descripcion_contratacion, 
		c.web_contratante, c.hora_desde, c.hora_hasta, 
		c.id_estado, c.id_municipio, c.direccion, 
		c.hora_desde_sobre, c.id_estado_sobre, c.id_municipio_sobre, 
		c.direccion_sobre, c.lugar_entrega, c.observaciones, 
		c.especifique_anulacion, c.idestatus, c.fecha_inicio_aclaratoria, 
		c.mecanismo, c.modalidad, c.objeto_contratacion, c.estado, c.municipio,
		 c.organoente, c.siglas, c.estado_sobre, c.municipio_sobre, 
		 c.id_llcestatus, c.estatus, m.descripcion as descr, obj.descripcion as obj
         FROM public.llamado_concurso_view c 
		 left join public.modalidad m on m.id_modalidad = c.id_modalidad
		 left join public.mecanismo  cn on cn.id_mecanismo = c.id_mecanismo
		 join public.objeto_contratacion obj on obj.id_objeto_contratacion = c.id_objeto_contratacion	    
		 where numero_proceso = '$data1'");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	public function consulta_llamado_statu_detalle($parametros){   
		 
		$this->db->select('c.*, m.descripcion, me.descripcion as descr, obj.descripcion as obj');
		$this->db->join('public.modalidad m', 'm.id_modalidad = c.id_modalidad');
		$this->db->join('public.mecanismo me', 'me.id_mecanismo = c.id_mecanismo');
		$this->db->join('public.objeto_contratacion obj', 'obj.id_objeto_contratacion = c.id_objeto_contratacion');
		$this->db->where("id",$parametros);
		$query = $this->db->get('public.llamado_concurso_historial_view c');
		return $query->result_array();
	}


}
?>