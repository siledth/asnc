<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificacion extends CI_Controller
{
    public function registrar()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['estados'] 	 = $this->Configuracion_model->consulta_estados();
        $data['pais'] 		 = $this->Configuracion_model->consulta_paises();
        $data['edo_civil'] 	 = $this->Configuracion_model->consulta_edo_civil();
       
        $data['inf_1'] = $this->Certificacion_model-> inf_1();
        $data['inf_2'] = $this->Certificacion_model-> inf_2();
        $data['inf_3'] = $this->Certificacion_model-> inf_3();
        $data['time']=date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('certificacion/registro_certificacion.php', $data);
        $this->load->view('templates/footer.php');
    }

    
    public function Listado_certificacion(){
		if(!$this->session->userdata('session'))redirect('login');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $usuario = $this->session->userdata('id_user');
        $data['ver_certi'] = $this->Certificacion_model->consulta_certi();
		$this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/listar_certificado.php', $data);
        $this->load->view('templates/footer.php');
        //where ed.id_usuario = '$usuario'");
	}
    public function Listado_certificacion_exter(){
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
        $fecha_solic  = date('Y-m-d');
        $user_soli  = 1;
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
            "user_soli"     =>  1 ,  
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



    public function editar_certficado(){
		if(!$this->session->userdata('session'))redirect('login');
        
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
        $fecha_solic  = $this->input->post("fecha_solic");
        $user_soli  = 1;
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
            "user_soli"     =>  1 ,  
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
     
        $data = $this->Certificacion_model->editar__certificacion($rif_cont,$certifi,$experi_empre_capa,$experi_empre_cap_comisi);
                                                    
	   if ($data) {
		   $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
		   redirect('certificacion/Listado_certificacion');
	   }else{
			 $this->session->set_flashdata('sa-error', 'error');
			redirect('certificacion/Listado_certificacion');
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
        

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
		$this->load->view('certificacion/pdf.php', $data);
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
       
        $data['inf_1'] = $this->Certificacion_model-> inf_1();
        $data['inf_2'] = $this->Certificacion_model-> inf_2();
        $data['inf_3'] = $this->Certificacion_model-> inf_3();
        $data['time']=date("Y-m-d");
        $data['bancos'] = $this->Publicaciones_model->consultar_b();

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
        $total_bss  = $this->input->post("total_bss");
        $n_ref  = $this->input->post("n_ref");
        $banco_e  = $this->input->post("banco_e");
        $banco_rec  = $this->input->post("banco_rec");
        $fecha_trans = $this->input->post("fecha_trans");
        $monto_trans  = $this->input->post("monto_trans");
        $declara  = $this->input->post("declara");
        $acepto  = $this->input->post("acepto");
        $fecha_solic  = date('Y-m-d');
        $user_soli  = 1;
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
            "user_soli"     =>  1 ,  
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
    
}