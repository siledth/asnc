<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificacion extends CI_Controller
{
    public function validad_exo(){
        $numcertrnc2 = $this->input->post('numcertrnc2');
        $data= $this->Certificacion_model->valida_exon($numcertrnc2);
       //$data = $this->input->post();
      echo json_encode($data);
       
      
      }
    public function registrar()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['estados'] 	 = $this->Configuracion_model->consulta_estados();
        $data['pais'] 		 = $this->Configuracion_model->consulta_paises();
        $data['edo_civil'] 	 = $this->Configuracion_model->consulta_edo_civil();
        $data['rif_organoente']= $this->session->userdata('rif_organoente');
   
        $usuario = $this->session->userdata('id_user');
        $data['inf_1'] = $this->Certificacion_model-> inf_1();
        $data['inf_2'] = $this->Certificacion_model-> inf_2();
        $data['inf_3'] = $this->Certificacion_model-> inf_3();
        $data['time']=date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado($data);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/registro_certificacion.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function Consulta_certificacion(){
		if(!$this->session->userdata('session'))redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi();
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/consultas/consult_snc.php', $data);
        $this->load->view('templates/footer.php');
        //where ed.id_usuario = '$usuario'");
	}
    public function Listado_certificacion(){
		if(!$this->session->userdata('session'))redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi_pendiente();
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/listar_certificado.php', $data);
        $this->load->view('templates/footer.php');
        //where ed.id_usuario = '$usuario'");
	}
    public function Listado_certificacion_exter(){ // esto es el perfil 8 
		if(!$this->session->userdata('session'))redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        $data['usuario']  = $this->session->userdata('id_user');
        $data['ver'] = $this->Certificacion_model->consulta_certi50($usuario);
        $data['ver3'] = $this->Certificacion_model->consulta_certi_exter50($usuario);
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi_exter($usuario);
        $data['time']=date("Y-m-d");
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/listado_externo.php', $data);
        $this->load->view('templates/footer.php');
       
	}
    public function Listado_certificacion_externo2(){
		if(!$this->session->userdata('session'))redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi_exter($usuario);
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/listado_externo.php', $data);
        $this->load->view('templates/footer.php');
       
	}

    //Consulta si existe el contrastita
	public function llenar_contratista(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Certificacion_model->llenar_contratista($data);
		echo json_encode($data);
	}

	public function llenar_contratista_rp(){
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Certificacion_model->llenar_contratista_rp($data);
		echo json_encode($data);
	}

    public function nro_comprobante(){
        if(!$this->session->userdata('session'))redirect('login');
	   	$data =	$this->Certificacion_model->cons_nro_comprobante();
	   	echo json_encode($data);
    }

    public function registrar_certificacion(){ 
        if(!$this->session->userdata('session'))redirect('login');
        $acc_cargar = $this->input->POST('acc_cargar');
        $numcertrnc = $this->input->post("numcertrnc");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1;//persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog"); 
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $percontacto  = $this->input->post("percontacto");
        $usuario = $this->session->userdata('id_user');
        $declara  = "Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.";
        $acepto  = "SI";
        $fecha_solic  = date('Y-m-d');
        
        $status  = '1';//estats pendiente  
        $nro_comprobante = $this->input->post("nro_comprobantes");     
        
        $certifi = array(
            "nro_comprobante"  =>  $nro_comprobante,  
            "n_certif"  =>  $numcertrnc,  
            "rif_cont"    =>        $rif_cont , 
            "nombre"  =>       $nombresocial ,
            "tipo_pers"     =>     1,  
            "objetivo"      =>      $objetivo , 
            "cont_prog"     =>      $cont_prog,  
            "total_bss"     =>     $total_bss ,  
            "n_ref"         =>    $n_ref   ,
            "banco_e"       =>     $banco_e , 
            "banco_rec"     =>    $banco_rec,  
            "fecha_trans"   =>     $fecha_trans  ,
            "monto_trans"   =>     $monto_trans ,  
            "declara"       =>     $declara   ,
            "acepto"        =>    $acepto ,  
            "fecha_solic"   =>   date("Y-m-d"),  
            "user_soli"     =>  $usuario ,  
            "status"        =>   1 


        ); 

        $experi_empre_capa = array( //experi_empre_capa
            'organo_experi_empre_capa'   	=> $this->input->post('organo_experi_empre_capa'),
            'actividad_experi_empre_capa'     => $this->input->post('actividad_experi_empre_capa'),
            'desde_experi_empre_capa'    => $this->input->post('desde_experi_empre_capa'),
            'hasta_experi_empre_capa' 	    => $this->input->post('hasta_experi_empre_capa'),  
            "n_certif"     => $this->input->post("n_ref"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
                    
        ); 

        $experi_empre_cap_comisi = array( // experien cap 3 años
            'organo_expe'   	 => $this->input->post('organo_expe'),
            'actividad_exp'   => $this->input->post('actividad_exp'),
            'desde_exp'  => $this->input->post('desde_exp'),
            'hasta_exp' 	 => $this->input->post('hasta_exp'),
            "n_certif"     => $this->input->post("n_ref"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante,  

        );
        $infor_per_natu = array( // registro de persona natural
            'nombre_ape'   	 => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado' 	 => $this->input->post('bolivar_estimado'),
            "pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("sub_total"),
            "total_bss"     => $this->input->post("total_bss"),
            "status"     => 1,
              

        );
        $infor_per_prof = array( // registro infor profesional de la persona
            'for_academica'   	 => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion' 	 => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso")
                );
                
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'   	 => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi' 	 => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
                        )        ;  
                        
          $exp_par_comi_10 = array( // registro infor profesional de la persona
          'organo10'   	 => $this->input->post('organo10'),
           'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
           'n_acto'  => $this->input->post('n_acto'),
           'fecha_act' 	 => $this->input->post('fecha_act'),
           "area_10"     => $this->input->post("area_10"),
           "dura_comi"     => $this->input->post("dura_comi"),
                                );  
            $exp_dic_cap_3 = array( // registro infor profesional de la persona
                  'organo3'   	 => $this->input->post('organo3'),
                  'actividad3'   => $this->input->post('actividad3'),
                  'desde3'  => $this->input->post('desde3'),
                   'hasta3' 	 => $this->input->post('hasta3'),

                                                          );                                                      
              
        

        $data = $this->Certificacion_model->save_certificacion($certifi,$experi_empre_capa,$experi_empre_cap_comisi, 
                                                                $infor_per_natu,$infor_per_prof,$for_mat_contr_publ, 
                                                                $exp_par_comi_10,$exp_dic_cap_3);
        echo json_encode($data);
    }

    public function ver_certifi(){
        if(!$this->session->userdata('session'))
        redirect('login');
        $data['rif_organoente']= $this->session->userdata('rif_organoente');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $parametros = $this->input->get('id');
        $data['rif_cont']=$this->input->get('id');
        $data['users']= $this->session->userdata('id_user');
        $data['time']=date("Y-m-d"); // para calcular la vigencia
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['inf_2'] = $this->Certificacion_model->certificaciones2($data['rif_cont']);
        $data['inf_3'] = $this->Certificacion_model->certificaciones3($data['rif_cont']);
        $data['inf_4'] = $this->Certificacion_model->certificaciones4($data['rif_cont']);
        $data['inf_5'] = $this->Certificacion_model->certificaciones5($data['rif_cont']);
        $data['inf_6'] = $this->Certificacion_model->certificaciones6($data['rif_cont']);
        $data['inf_7'] = $this->Certificacion_model->certificaciones7($data['rif_cont']);
        $data['inf_8'] = $this->Certificacion_model->certificaciones8($data['rif_cont']);
        $data['inf_9'] = $this->Certificacion_model->certificaciones_ver($data['rif_cont']);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        
          $this->load->view('certificacion/consulta_id.php', $data);
        
        $this->load->view('templates/footer.php');
    }

    //////////////////////////
    
    public function editar_certificacion(){
		if(!$this->session->userdata('session'))redirect('login');
        //$data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['rif_cont']       =$this->input->get('id');
       // $data['id_propiet'] = $separar['2'];
       $data['time']=date("Y-m-d");
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['inf_11'] = $this->Certificacion_model-> inf_1();
        $data['inf_12'] = $this->Certificacion_model-> inf_2();
        $data['inf_14'] = $this->Certificacion_model-> inf_3();

        //$data['inf_1'] = $this->Programacion_model->inf_1($data['matricula']);
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/ver_edit_cert.php', $data);
        $this->load->view('templates/footer.php');
	}
    public function editar_certificacion_pn(){
		if(!$this->session->userdata('session'))redirect('login');
        //$data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['rif_cont']       =$this->input->get('id');
       // $data['id_propiet'] = $separar['2'];
       $data['time']=date("Y-m-d");
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['inf_11'] = $this->Certificacion_model-> inf_1();
        $data['inf_12'] = $this->Certificacion_model-> inf_2();
        $data['inf_14'] = $this->Certificacion_model-> inf_35();
        $data['inf__15'] = $this->Certificacion_model-> certificaciones4($data['rif_cont']);

        //$data['inf_1'] = $this->Programacion_model->inf_1($data['matricula']);
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/ver_edit_cert_pn.php', $data);
        $this->load->view('templates/footer.php');
	}

    public function guardar_editar_certficado_pn(){
		if(!$this->session->userdata('session'))redirect('login');
        
        $numcertrnc = $this->input->post("numcertrnc");
        $nro_comprobante = $this->input->post("nro_comprobante");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1;//persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog"); 
        $total_bss  = $this->input->post("monto_estimado");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = $this->session->userdata('id_user');;
        $status  = '1';//estats pendiente  
        $tipo_pers  = $this->input->post("tipo_pers");
        $id  = $this->input->post("id_");
        
        
        

       

        $certifi = array(
            
            "rif_cont"    =>        $rif_cont , 
            "nombre"  =>       $nombresocial ,
            "tipo_pers"     =>     $tipo_pers,  
            "objetivo"      =>      $objetivo , 
            "cont_prog"     =>      $cont_prog,  
            "total_bss"     =>     $total_bss ,  
            "n_ref"         =>    $n_ref   ,
            "banco_e"       =>     $banco_e , 
            "banco_rec"     =>    $banco_rec,  
            "fecha_trans"   =>     $fecha_trans  ,
            "monto_trans"   =>     $monto_trans ,  
        
            "fecha_solic"   =>  $fecha_solic,  
            "user_soli"     =>  $user_soli ,  
            "status"        =>   1 


        ); 
        $infor_per_natu = array( // registro de persona natural
            'id'   	 => $id,
            'nombre_ape'   	 => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado' 	 => $this->input->post('bolivar_estimado'),
            //"pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("iva_estimado"),
            "total_final"     => $this->input->post("monto_estimado"),
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
              

        );
        $infor_per_prof = array( // registro infor profesional de la persona
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            'for_academica'   	 => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion' 	 => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso"),
            'id'   	 => $id,
                );
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
                    'taller'   	 => $this->input->post('taller'),
                    'institucion'   => $this->input->post('institucion'),
                    'hor_dura'  => $this->input->post('hor_dura'),
                    'certi' 	 => $this->input->post('certi'),
                    "fech_cert"     => $this->input->post("fech_cert"),
                    "vigencia"     => $this->input->post("vigencia"),
                    "n_certif"     => $this->input->post("numcertrnc"),
                    "nro_comprobante"  =>  $nro_comprobante,
                    'id'   	 => $id, 
                    
                                ) ;   
       $exp_par_comi_10 = array( // registro infor profesional de la persona
          'organo10'   	 => $this->input->post('organo10'),
           'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
           'n_acto'  => $this->input->post('n_acto'),
           'fecha_act' 	 => $this->input->post('fecha_act'),
           "area_10"     => $this->input->post("area_10"),
           "dura_comi"     => $this->input->post("dura_comi"),
           "n_certif"     => $this->input->post("numcertrnc"),
           "nro_comprobante"  =>  $nro_comprobante, 
           'id'   	 => $id,
                                );  
        $exp_dic_cap_3 = array( // registro capsita 3 años de experiencia
                  'organo3'   	 => $this->input->post('organo3'),
                  'actividad3'   => $this->input->post('actividad3'),
                  'desde3'  => $this->input->post('desde3'),
                   'hasta3' 	 => $this->input->post('hasta3'),
                   "n_certif"     => $this->input->post("numcertrnc"),
                   "nro_comprobante"  =>  $nro_comprobante, 
                   'id'   	 => $id,
        );
        $data = $this->Certificacion_model->sav_editar__certificacion_pn($rif_cont,$certifi,$infor_per_natu,$infor_per_prof,
        $for_mat_contr_publ,$exp_par_comi_10, $exp_dic_cap_3);
                                                    
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('certificacion/Listado_certificacion_exter');
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('certificacion/Listado_certificacion_exter');
		 }
	}
    public function ver_certi_editar(){
        if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data = $this->Certificacion_model->inf_2_edit($data);
	    echo json_encode($data);
    }
    public function ver_certi_editar2(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Certificacion_model->inf_3_o($data);
		echo json_encode($data);
    }
    public function ver_certi_editar3(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Certificacion_model->inf_3_1($data);
		echo json_encode($data);
    }
    public function ver_certi_editar4(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Certificacion_model->inf_3_2($data);
		echo json_encode($data);
    }
    public function ver_certi_editar5(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Certificacion_model->inf_3_3($data);
		echo json_encode($data);
    }
    public function ver_certi_editar6(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Certificacion_model->inf_3_4($data);
		echo json_encode($data);
    }
    public function ver_certi_editar7(){
        if(!$this->session->userdata('session'))
        redirect('login');
		$data = $this->input->post();
		$data = $this->Certificacion_model->inf_3_5($data);
		echo json_encode($data);
    }


// editar certififcacion pj
    public function editar_certficado(){
		if(!$this->session->userdata('session'))redirect('login');
        
        $numcertrnc = $this->input->post("numcertrnc");
        $nro_comprobante = $this->input->post("nro_comprobante");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1;//persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog"); 
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = $this->session->userdata('id_user');;
        $status  = '1';//estats pendiente  
        $tipo_pers  = $this->input->post("tipo_pers");
        $id  = $this->input->post("id_");
        
        

       

        $certifi = array(
            
            "rif_cont"    =>        $rif_cont , 
            "nombre"  =>       $nombresocial ,
            "tipo_pers"     =>     $tipo_pers,  
            "objetivo"      =>      $objetivo , 
            "cont_prog"     =>      $cont_prog,  
            "total_bss"     =>     $total_bss ,  
            "n_ref"         =>    $n_ref   ,
            "banco_e"       =>     $banco_e , 
            "banco_rec"     =>    $banco_rec,  
            "fecha_trans"   =>     $fecha_trans  ,
            "monto_trans"   =>     $monto_trans ,  
        
            "fecha_solic"   =>   date("Y-m-d"),  
            "user_soli"     =>  $user_soli ,  
            "status"        =>   1 


        ); 
        $experi_empre_capa = array( //experi_empre_capa
            'organo_experi_empre_capa'   	=> $this->input->post('organo_experi_empre_capa'),
            'actividad_experi_empre_capa'     => $this->input->post('actividad_experi_empre_capa'),
            'desde_experi_empre_capa'    => $this->input->post('desde_experi_empre_capa'),
            'hasta_experi_empre_capa' 	    => $this->input->post('hasta_experi_empre_capa'),  
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            "id"    =>        $id , 
                    
        ); 

        $experi_empre_cap_comisi = array( // experien cap 3 años
            'organo_expe'   	 => $this->input->post('organo_expe'),
            'actividad_exp'   => $this->input->post('actividad_exp'),
            'desde_exp'  => $this->input->post('desde_exp'),
            'hasta_exp' 	 => $this->input->post('hasta_exp'),
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            "id"    =>        $id ,  

        );
        $infor_per_prof = array( // registro infor profesional de la persona
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            'for_academica'   	 => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion' 	 => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso"),
            "id"    =>        $id , 
                );
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
                    'taller'   	 => $this->input->post('taller'),
                    'institucion'   => $this->input->post('institucion'),
                    'hor_dura'  => $this->input->post('hor_dura'),
                    'certi' 	 => $this->input->post('certi'),
                    "fech_cert"     => $this->input->post("fech_cert"),
                    "vigencia"     => $this->input->post("vigencia"),
                    "n_certif"     => $this->input->post("numcertrnc"),
                    "id"    =>        $id , 
                    
                                ) ;   
       $exp_par_comi_10 = array( // registro infor profesional de la persona
          'organo10'   	 => $this->input->post('organo10'),
           'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
           'n_acto'  => $this->input->post('n_acto'),
           'fecha_act' 	 => $this->input->post('fecha_act'),
           "area_10"     => $this->input->post("area_10"),
           "dura_comi"     => $this->input->post("dura_comi"),
           "n_certif"     => $this->input->post("numcertrnc"),
           "id"    =>        $id , 
                                );  
        $exp_dic_cap_3 = array( // registro capsita 3 años de experiencia
                  'organo3'   	 => $this->input->post('organo3'),
                  'actividad3'   => $this->input->post('actividad3'),
                  'desde3'  => $this->input->post('desde3'),
                   'hasta3' 	 => $this->input->post('hasta3'),
                   "n_certif"     => $this->input->post("numcertrnc"),
                   "id"    =>        $id , 
        );
        $data = $this->Certificacion_model->editarcertificacion_pj($rif_cont,$certifi,$experi_empre_capa,
        $experi_empre_cap_comisi,$infor_per_prof,$for_mat_contr_publ,$exp_par_comi_10, $exp_dic_cap_3);
                                                    
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('certificacion/Listado_certificacion_exter');
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('certificacion/Listado_certificacion_exter');
		 }
	}
    public function renovar_certificacion(){
		if(!$this->session->userdata('session'))redirect('login');
        
        $numcertrnc = $this->input->post("numcertrnc");
        $nro_comprobante = $this->input->post("nro_comprobante");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1;//persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog"); 
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = $this->session->userdata('id_user');
        $status  = '1';//estats pendiente  
        $tipo_pers  = $this->input->post("tipo_pers");
        $id1  = $this->input->post("id");       
        $certifi = array(
            
            "rif_cont"    =>        $rif_cont , 
            "nombre"  =>       $nombresocial ,
            "tipo_pers"     =>     $tipo_pers,  
            "objetivo"      =>      $objetivo , 
            "cont_prog"     =>      $cont_prog,  
            "total_bss"     =>     $total_bss ,  
            "n_ref"         =>    $n_ref   ,
            "banco_e"       =>     $banco_e , 
            "banco_rec"     =>    $banco_rec,  
            "fecha_trans"   =>     $fecha_trans  ,
            "monto_trans"   =>     $monto_trans ,  
            "fecha_solic"   =>   date("Y-m-d"),  
            "user_soli"     =>  $user_soli ,  
            "status"        =>   1 


        ); 
        $experi_empre_capa = array( //experi_empre_capa
            'organo_experi_empre_capa'   	=> $this->input->post('organo_experi_empre_capa'),
            'actividad_experi_empre_capa'     => $this->input->post('actividad_experi_empre_capa'),
            'desde_experi_empre_capa'    => $this->input->post('desde_experi_empre_capa'),
            'hasta_experi_empre_capa' 	    => $this->input->post('hasta_experi_empre_capa'),  
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            "id"  =>  $id1, 
                    
        ); 

        $experi_empre_cap_comisi = array( // experien cap 3 años
            'organo_expe'   	 => $this->input->post('organo_expe'),
            'actividad_exp'   => $this->input->post('actividad_exp'),
            'desde_exp'  => $this->input->post('desde_exp'),
            'hasta_exp' 	 => $this->input->post('hasta_exp'),
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            "id"  =>  $id1, 
           

        );
        $infor_per_natu = array( // registro de persona natural
            'nombre_ape'   	 => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado' 	 => $this->input->post('bolivar_estimado'),
            "pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("sub_total"),
            "total_bss"     => $this->input->post("total_bss"),
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            "id"  =>  $id1, 
             
              

        );
        $infor_per_prof = array( // registro infor profesional de la persona
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            'for_academica'   	 => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion' 	 => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso"),
            "id"  =>  $id1, 
                );
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
                    'taller'   	 => $this->input->post('taller'),
                    'institucion'   => $this->input->post('institucion'),
                    'hor_dura'  => $this->input->post('hor_dura'),
                    'certi' 	 => $this->input->post('certi'),
                    "fech_cert"     => $this->input->post("fech_cert"),
                    "vigencia"     => $this->input->post("vigencia"),
                    "n_certif"     => $numcertrnc,
                    "nro_comprobante"  =>  $nro_comprobante, 
                    "id"  =>  $id1, 
                    
                                ) ;   
       $exp_par_comi_10 = array( // registro infor profesional de la persona
          'organo10'   	 => $this->input->post('organo10'),
           'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
           'n_acto'  => $this->input->post('n_acto'),
           'fecha_act' 	 => $this->input->post('fecha_act'),
           "area_10"     => $this->input->post("area_10"),
           "dura_comi"     => $this->input->post("dura_comi"),
           "n_certif"     => $numcertrnc,
           "id"  =>  $id1, 
                                );  
        $exp_dic_cap_3 = array( // registro capsita 3 años de experiencia
                  'organo3'   	 => $this->input->post('organo3'),
                  'actividad3'   => $this->input->post('actividad3'),
                  'desde3'  => $this->input->post('desde3'),
                   'hasta3' 	 => $this->input->post('hasta3'),
                   "n_certif"     => $numcertrnc,
                   "id"  =>  $id1, 
        );
        $data = $this->Certificacion_model->renovacion__certificacion($rif_cont,$certifi,$experi_empre_capa,
        $experi_empre_cap_comisi,$infor_per_prof,
        $for_mat_contr_publ,$exp_par_comi_10, $exp_dic_cap_3,$infor_per_natu);
                                                    
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('certificacion/Listado_certificacion_exter');
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('certificacion/Listado_certificacion_exter');
		 }
	}

    public function renovar_certificacion1(){
		if(!$this->session->userdata('session'))redirect('login');
        //$data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['rif_cont']       =$this->input->get('id');
       // $data['id_propiet'] = $separar['2'];
       $data['time']=date("Y-m-d");
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['inf_11'] = $this->Certificacion_model-> inf_1();
        $data['inf_12'] = $this->Certificacion_model-> inf_2();
        $data['inf_14'] = $this->Certificacion_model-> inf_3();

        $data['rif_organoente']= $this->session->userdata('rif_organoente');
        $data['inf_15'] = $this->Certificacion_model-> inf_1();
        $data['inf_2'] = $this->Certificacion_model-> inf_2();
        $data['inf_3'] = $this->Certificacion_model-> inf_3();
        $data['time']=date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();

        //$data['inf_1'] = $this->Programacion_model->inf_1($data['matricula']);
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/ver_renovar_certificacion1.php', $data);
        $this->load->view('templates/footer.php');
	} 
    public function renovar_certificacion_pn(){
		if(!$this->session->userdata('session'))redirect('login');
        //$data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['rif_cont']       =$this->input->get('id');
       // $data['id_propiet'] = $separar['2'];
       $data['time']=date("Y-m-d");
        $data['inf_1'] = $this->Certificacion_model->certificaciones($data['rif_cont']);
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['inf_11'] = $this->Certificacion_model-> inf_1();
        $data['inf_12'] = $this->Certificacion_model-> inf_2();
        $data['inf_14'] = $this->Certificacion_model-> inf_3();

        $data['rif_organoente']= $this->session->userdata('rif_organoente');
        $data['inf_15'] = $this->Certificacion_model-> inf_1();
        $data['inf_2'] = $this->Certificacion_model-> inf_2();
        $data['inf_3'] = $this->Certificacion_model-> inf_3();
        $data['time']=date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();

         
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/renovar/ver_renovar_certificacion_pn.php', $data);
        $this->load->view('templates/footer.php');
	} 
    public function renovar_certificacion_pn1(){
		if(!$this->session->userdata('session'))redirect('login');
        
        $numcertrnc = $this->input->post("numcertrnc");
        $nro_comprobante = $this->input->post("nro_comprobante");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 1;//persona juridica
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog"); 
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = $this->session->userdata('id_user');
        $status  = '1';//estats pendiente  
        $tipo_pers  = $this->input->post("tipo_pers"); 
        $id1  = $this->input->post("id_");    
        $certifi = array(
            
            "rif_cont"    =>        $rif_cont , 
            "nombre"  =>       $nombresocial ,
            "tipo_pers"     =>     $tipo_pers,  
            "objetivo"      =>      $objetivo , 
            "cont_prog"     =>      $cont_prog,  
            "total_bss"     =>     $total_bss ,  
            "n_ref"         =>    $n_ref   ,
            "banco_e"       =>     $banco_e , 
            "banco_rec"     =>    $banco_rec,  
            "fecha_trans"   =>     $fecha_trans  ,
            "monto_trans"   =>     $monto_trans ,  
            "fecha_solic"   =>   date("Y-m-d"),  
            "user_soli"     =>  $user_soli ,  
            "status"        =>   1 


        ); 
     
        $infor_per_natu = array( // registro de persona natural
            "id"  =>  $id1, 
            'nombre_ape'   	 => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado' 	 => $this->input->post('bolivar_estimado'),
             
            "sub_total"     => $this->input->post("iva_estimado"),
            "total_final"     => $this->input->post("monto_estimado"),
            "n_certif"     => $this->input->post("numcertrnc"),
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
              

        );
        $infor_per_prof = array( // registro infor profesional de la persona
            "n_certif"     => $numcertrnc,
            "rif_cont"     => $this->input->post("rif_cont"),
            "nro_comprobante"  =>  $nro_comprobante, 
            'for_academica'   	 => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion' 	 => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso"),
            "id"  =>  $id1, 
                );
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
                    'taller'   	 => $this->input->post('taller'),
                    'institucion'   => $this->input->post('institucion'),
                    'hor_dura'  => $this->input->post('hor_dura'),
                    'certi' 	 => $this->input->post('certi'),
                    "fech_cert"     => $this->input->post("fech_cert"),
                    "vigencia"     => $this->input->post("vigencia"),
                    "n_certif"     => $numcertrnc,
                    "nro_comprobante"  =>  $nro_comprobante, 
                    "id"  =>  $id1, 
                    
                                ) ;   
       $exp_par_comi_10 = array( // registro infor profesional de la persona
          'organo10'   	 => $this->input->post('organo10'),
           'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
           'n_acto'  => $this->input->post('n_acto'),
           'fecha_act' 	 => $this->input->post('fecha_act'),
           "area_10"     => $this->input->post("area_10"),
           "dura_comi"     => $this->input->post("dura_comi"),
           "n_certif"     => $numcertrnc,
           "id"  =>  $id1, 
                                );  
        $exp_dic_cap_3 = array( // registro capsita 3 años de experiencia
                  'organo3'   	 => $this->input->post('organo3'),
                  'actividad3'   => $this->input->post('actividad3'),
                  'desde3'  => $this->input->post('desde3'),
                   'hasta3' 	 => $this->input->post('hasta3'),
                   "n_certif"     => $numcertrnc,
                   "id"  =>  $id1, 
        );
        $data = $this->Certificacion_model->save_renovacion__certificacion_pn($rif_cont,$certifi,$infor_per_prof,
        $for_mat_contr_publ,$exp_par_comi_10, $exp_dic_cap_3,$infor_per_natu);
                                                    
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('certificacion/Listado_certificacion_exter');
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('certificacion/Listado_certificacion_exter');
		 }
	}

    public function consultar_certificacion(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data['time']=date("d-m-Y");
        $data['users']= $this->session->userdata('id_user');
        $data =	$this->Certificacion_model->certificaciones_id($data);
        echo json_encode($data);
    }


    public function guardar_proc_pag(){ //se guardA EL NUEVO ESTATUS DEL CERTIFICADO
        if(!$this->session->userdata('session'))redirect('login');
        $data['time']=date("d-m-Y");
        $data['users']= $this->session->userdata('id_user');
        $data = $this->input->post();
        $data =	$this->Certificacion_model->guardar_proc_pag($data);
        echo json_encode($data);
    }




    //////////pdf

    public function verpdf(){
        if(!$this->session->userdata('session'))redirect('login');
        $comprobante = $this->input->get('id');

        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
    
        $data['time']=date("d-m-Y");
       // $data =	$this->Certificacion_model->certificaciones_id($data);
        $data['inf_pdf'] =	$this->Certificacion_model->ver_pdfs($comprobante);
        $data['ver_pdfs_2'] =	$this->Certificacion_model->ver_pdfs_2($comprobante);
        

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/pdf.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function verpdf2(){
        
        $comprobante = $this->input->get('id');

        
        $data['time']=date("d-m-Y");
       // $data =	$this->Certificacion_model->certificaciones_id($data);
        $data['inf_pdf'] =	$this->Certificacion_model->ver_pdfs($comprobante);
        

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/pdf_ext.php', $data);
        $this->load->view('templates/footer.php');
    }
    ///////////////////////////////////////////////////////////////// registrar PN//////////////////////////////////////
    public function registrar_pn()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['estados'] 	 = $this->Configuracion_model->consulta_estados();
        $data['pais'] 		 = $this->Configuracion_model->consulta_paises();
        $data['edo_civil'] 	 = $this->Configuracion_model->consulta_edo_civil();
        $data['rif_organoente']= $this->session->userdata('rif_organoente');
        $data['inf_1'] = $this->Certificacion_model-> inf_1();
        $data['inf_2'] = $this->Certificacion_model-> inf_2();
        $data['inf_3'] = $this->Certificacion_model-> inf_3();
        $data['time']=date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado($data);
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/registro_pn.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function nro_comprobante_pn(){
        if(!$this->session->userdata('session'))redirect('login');
	   	$data =	$this->Certificacion_model->cons_nro_comprobantenn();
	   	echo json_encode($data);
    }
   /// registrar_certificacion_pn
    public function registrar_certificacion_pn(){ 
        if(!$this->session->userdata('session'))redirect('login');
        $acc_cargar = $this->input->POST('acc_cargar');
        $numcertrnc = $this->input->post("numcertrnc");
        $rif_cont = $this->input->post("rif_cont");
        $nombresocial = $this->input->post("nombre");
        $tipo_pers = 2;//persona natural
        $objetivo = $this->input->post("objetivo");
        $cont_prog  = $this->input->post("cont_prog"); 
        $total_bss  = $this->input->post("monto_estimado");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = date('Y-m-d');
        $user_soli  = $this->session->userdata('id_user');
        $status  = '1';//estats pendiente  
        $nro_comprobante = $this->input->post("nro_comprobantes");     
        
        $certifi = array(
            "nro_comprobante"  =>  $nro_comprobante,  
            "n_certif"  =>  $numcertrnc,  
            "rif_cont"    =>        $rif_cont , 
            "nombre"  =>       $nombresocial ,
            "tipo_pers"     =>     2,  
            "objetivo"      =>      $objetivo , 
            "cont_prog"     =>      $cont_prog,  
            "total_bss"     =>     $total_bss ,  
            "n_ref"         =>    $n_ref   ,
            "banco_e"       =>     $banco_e , 
            "banco_rec"     =>    $banco_rec,  
            "fecha_trans"   =>     $fecha_trans  ,
            "monto_trans"   =>     $monto_trans ,  
            "declara"       =>     $declara   ,
            "acepto"        =>    $acepto ,  
            "fecha_solic"   =>   date("Y-m-d"),  
            "user_soli"     =>  $user_soli  ,  
            "status"        =>   1 


        ); 

        

       
        $infor_per_natu = array( // registro de persona natural
            'nombre_ape'   	 => $this->input->post('nombre_ape'),
            'cedula'   => $this->input->post('cedula'),
            'rif'  => $this->input->post('rif'),
            'bolivar_estimado' 	 => $this->input->post('bolivar_estimado'),
            //"pj"     => $this->input->post("pj"),
            "sub_total"     => $this->input->post("iva_estimado"),
            "total_bss"     => $this->input->post("monto_estimado"),
              

        );
        $infor_per_prof = array( // registro infor profesional de la persona
            'for_academica'   	 => $this->input->post('for_academica'),
            'titulo'   => $this->input->post('titulo'),
            'ano'  => $this->input->post('ano'),
            'culminacion' 	 => $this->input->post('culminacion'),
            "curso"     => $this->input->post("curso")
                );
                
        $for_mat_contr_publ = array( // registro frmacion en mat de contra publica
            'taller'   	 => $this->input->post('taller'),
            'institucion'   => $this->input->post('institucion'),
            'hor_dura'  => $this->input->post('hor_dura'),
            'certi' 	 => $this->input->post('certi'),
            "fech_cert"     => $this->input->post("fech_cert"),
            "vigencia"     => $this->input->post("vigencia"),
                        )        ;  
                        
          $exp_par_comi_10 = array( // registro infor profesional de la persona
          'organo10'   	 => $this->input->post('organo10'),
           'act_adminis_desid'   => $this->input->post('act_adminis_desid'),
           'n_acto'  => $this->input->post('n_acto'),
           'fecha_act' 	 => $this->input->post('fecha_act'),
           "area_10"     => $this->input->post("area_10"),
           "dura_comi"     => $this->input->post("dura_comi"),
                                );  
            $exp_dic_cap_3 = array( // registro infor profesional de la persona
                  'organo3'   	 => $this->input->post('organo3'),
                  'actividad3'   => $this->input->post('actividad3'),
                  'desde3'  => $this->input->post('desde3'),
                   'hasta3' 	 => $this->input->post('hasta3'),

                                                          );                                                      
              
        

        $data = $this->Certificacion_model->save_certificacion_pn($certifi, 
                                                                $infor_per_natu,$infor_per_prof,$for_mat_contr_publ, 
                                                                $exp_par_comi_10,$exp_dic_cap_3);
        echo json_encode($data);
    }
    
    public function llenar_contratistas()
	{
		if(!$this->session->userdata('session'))redirect('login');
		$data = $this->input->post();
		$data =	$this->Contratista_model->llenar_contratistas($data);
		echo json_encode($data);
	}

    public function registrar_exonerado()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
       // $data['contratista'] =	$this->Certificacion_model->llenar_contratista_exonerado();
        $data['exonerado'] = $this->Certificacion_model->consultar_exonerado_2();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('tablas/confi_certificacion/add_exonerado.php', $data);
        $this->load->view('templates/footer.php');
    }
  


    public function registrar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = array(
            'rif' => $this->input->POST('codigo_b'),
            'descripcion' => $this->input->POST('nombre_b'),
            'id_usuaio' => $this->session->userdata('id_user'),
            'fecha_creacion' => date("Y-m-d"), 
        );
        $data = $this->Certificacion_model->registrar_b($data);
        echo json_encode($data);
    }
     //LLENAR MODAL PARA EDITAR
     public function consulta_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->consulta_b($data);
        echo json_encode($data);
    }

    //EDITAR
    public function editar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();

        $data = array(
            'id_exonerado' => $data['id_banco'],
            'rif' => $data['codigo_b'],
            'descripcion' => $data['nombre_b'],
            'id_usuaio' => $this->session->userdata('id_user')
        );

        $data = $this->Certificacion_model->editar_b($data);
        echo json_encode($data);
    }

    //ELIMINAR
    public function eliminar_b() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->eliminar_b($data);
        echo json_encode($data);
    }
  
    ///////////////////////esto es facilitador
    public function ver_facilitador(){
        if(!$this->session->userdata('session'))
        redirect('login');
       
        $usuario = $this->session->userdata('id_user');
        $data['ver_facilitador'] = $this->Certificacion_model->consulta_facilitador($usuario);

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        
          $this->load->view('certificacion/desin_instruc/desin_faci.php', $data);
        
        $this->load->view('templates/footer.php');
    }
    public function consulta_facilitadores() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->Certificacion_model->consulta_facilitadores($data);
        echo json_encode($data);
    }
    ///cambiar estatus facilitador desincorporar
    public function cambiar_estatus() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
       if   (($data['status'] == 1 )  ){ 
        $data = array(
            'cedula' => $data['cedula'],
            'rif_cont' => $data['rif_cont'],
            'nombre_desin' => $data['nombre_desin'],
            'cargo_desin' => $data['cargo_desin'],
            'motivo' => $data['motivo'],
            'status' => 0,
            
        ); 
      } else    { 
        $data = array(
            'cedula' => $data['cedula'],
            'rif_cont' => $data['rif_cont'],
            'nombre_desin' => $data['nombre_desin'],
            'cargo_desin' => $data['cargo_desin'],
            'motivo' => $data['motivo'],
            'status' => 1,
            
        );
        
            
           }
        

        $data = $this->Certificacion_model->cambiar_estatus($data);
        echo json_encode($data);
    }

    //////////////////Reportes
   
    public function fecha_vencimiento(){
		if(!$this->session->userdata('session'))redirect('login');
		$data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] 		 = $this->session->userdata('rif');
		    
		
		$hasta     = $this->input->post("hasta");
		$desde     = $this->input->post("desde");
        $data['desde'] = date('Y-m-d', strtotime($desde));
		$data['hasta'] = date('Y-m-d', strtotime($hasta)); 
	//	$this->form_validation->set_rules('t_pago', 't_pago', 'required|callback_select_validate');
		$this->form_validation->set_rules('hasta', 'Fecha hasta', 'required|min_length[1]');
		$this->form_validation->set_rules('desde', 'Fecha Desde ', 'required|min_length[1]');
		
		
		if ($this->form_validation->run() == FALSE) {
			$data['descripcion'] = $this->session->userdata('unidad');
       		$data['rif'] 		 = $this->session->userdata('rif');
			
			$this->load->view('templates/header.php');
			$this->load->view('templates/navigator.php');
			$this->load->view('certificacion/Reporte/fecha_venci.php', $data);
			$this->load->view('templates/footer.php');
		
		
		
		
		} else {

		

			$hasta     = $this->input->post("hasta");
			$desde     = $this->input->post("desde");
			$data['desde'] = date('Y-m-d', strtotime($desde));
			$data['hasta'] = date('Y-m-d', strtotime($hasta)); 
			$data['results'] 	 =	$this->Certificacion_model->consultar_vencimiento($data);
		
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/Reporte/ver_vencimi.php', $data);
        $this->load->view('templates/footer.php');
               
		
		}	
	}

    public function status(){
		if(!$this->session->userdata('session'))redirect('login');
		$data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] 		 = $this->session->userdata('rif');
		$hasta     = $this->input->post("hasta");
		$desde     = $this->input->post("desde");
        $data['desde'] = date('Y-m-d', strtotime($desde));
		$data['hasta'] = date('Y-m-d', strtotime($hasta)); 
	//	$this->form_validation->set_rules('t_pago', 't_pago', 'required|callback_select_validate');
		$this->form_validation->set_rules('hasta', 'Fecha hasta', 'required|min_length[1]');
		$this->form_validation->set_rules('desde', 'Fecha Desde ', 'required|min_length[1]');
		
		
		if ($this->form_validation->run() == FALSE) {
			$data['descripcion'] = $this->session->userdata('unidad');
       		$data['rif'] 		 = $this->session->userdata('rif');
			
			$this->load->view('templates/header.php');
			$this->load->view('templates/navigator.php');
			$this->load->view('certificacion/Reporte/status.php', $data);
			$this->load->view('templates/footer.php');
		
		} else {
			$hasta     = $this->input->post("hasta");
			$desde     = $this->input->post("desde");
			$data['desde'] = date('Y-m-d', strtotime($desde));
			$data['hasta'] = date('Y-m-d', strtotime($hasta));
            $data['status']=$this->input->post("status"); 
			$data['results'] 	 =	$this->Certificacion_model->status($data);
		
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/Reporte/ver_status.php', $data);
        $this->load->view('templates/footer.php');
               
		
		}	
	}
}