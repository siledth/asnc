<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['organo']  = $this->User_model->consultar_organos();
        $data['entes']   = $this->User_model->consultar_entes();
        $data['enteads'] = $this->User_model->consultar_enteads();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/add.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function save()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $nombre = $this->input->post("nombre");
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $repeatPassord = $this->input->post("repeatPassord");

        $id_unidad = $this->input->post("id_unidad");
        $this->form_validation->set_rules('nombre', 'Nombre completo', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Correo eléctronico', 'required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[10]|min_length[8]|alpha_numeric');
        $this->form_validation->set_rules('repeatPassord', 'Confirma contraseña', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header.php');
            $this->load->view('templates/navigator.php');
            $this->load->view('user/add.php', $data);
            $this->load->view('templates/footer.php');
        } else {

            $clave = password_hash(
                base64_encode(
                    hash('sha256', $password, true)
                ),
                PASSWORD_DEFAULT
            );

            $data = array(
                "nombre" => $nombre,
                "password" => $clave,
                "email" => $email,
                "foto" => 2,
                "perfil" => 1,
                "estado" => 1,
                "ultimo_login" => date("Y-m-d h:m:s"),
                "fecha" => date("Y-m-d"),
                "intentos" => 1,
                "unidad" => $id_unidad,
                "fecha_update" => date("Y-m-d"),
            );

            $this->User_model->save($data);
            $this->session->set_flashdata('success', 'Se guardo los datos correctamente');
            redirect('user/index');
        }
    }
    // guardar organismo externo
    public function save_organismo()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }

        $data = array(
            'id_organoads'		=> $this->input->post("id_organoads"),
            'desc_organo'		=> $this->input->post("organo"),
            'cod_onapre'	 	=> $this->input->post("cod_onapre"),
            'siglas' 			=> $this->input->post("siglas"),
            'tipo_rif'			=> $this->input->post("tipo_rif"),
            'rif' 				=> $this->input->post("rif"),
            'id_clasificacion' 	=> $this->input->post("id_clasificacion"),
            'tel_local' 		=> $this->input->post("tel_local"),
            'tel_local_2' 		=> $this->input->post("tel_local_2"),
            'tel_movil'			=> $this->input->post("tel_movil"),
            'tel_movil_2' 		=> $this->input->post("tel_movil_2"),
            'pag_web' 			=> $this->input->post("pag_web"),
            'email'				=> $this->input->post("email"),
            'id_estado' 		=> $this->input->post("id_estado"),
            'id_municipio' 		=> $this->input->post("id_municipio"),
            'id_parroquia' 		=> $this->input->post("id_parroquia"),
            'direccion_fiscal' 	=> $this->input->post("direccion_fiscal"),
            'gaceta_oficial'	=> $this->input->post("gaceta_oficial"),
            'fecha_gaceta'		=> $this->input->post("fecha_gaceta"),
            'usuario' 			=> $this->session->userdata('id_user')
        );
        $data = $this->Configuracion_model->save_organismo($data);
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('user/cuentadante');
    }
    //_________________________________________________________________________________________________________________________________________________________
      //crerar usuario externo
      public function int()
      {
          if(!$this->session->userdata('session')) {
              redirect('login');
          }
          // $data['organo']  = $this->User_model->consultar_organos();
          // $data['entes']   = $this->User_model->consultar_entes();
          // $data['enteads'] = $this->User_model->consultar_enteads();
          $data['ver_perfil'] = $this->User_model->consultar_perfiles();
          $data['final']  = $this->User_model->consulta_organoente();
 
          $this->load->view('templates/header.php');
          $this->load->view('templates/navigator.php');
          $this->load->view('user/usuarioexterno.php', $data);
          $this->load->view('templates/footer.php');
      }
      public function create_user() {
        $data['unidad'] = $this->session->userdata('id_unidad');
        $data['des_unidad'] = $this->session->userdata('unidad');
        $data['ver_perfil'] = $this->User_model->consultar_perfiles();
        $data['final']  = $this->User_model->consulta_organoente();
        $rif_organoente = $this->session->userdata('rif_organoente');

        $data['list'] = $this->Configuracion_model->consultar_lis();
      

        $data['rif_organoente'] 		 = $this->session->userdata('rif_organoente');
        $usuario = $this->session->userdata('id_user');
    
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/c_us.php', $data);
        $this->load->view('templates/footer.php');
    } 
    public function save_user_c() { //ultimo
        if (!$this->session->userdata('session'))
            redirect('login');
            $parametros = $this->input->post('id_unidad');
            $separar        = explode("/", $parametros);
            $codigo= $separar['0'];
            $rif= $separar['1'];

            $password = $this->input->post('password');

            $clave = password_hash(
                base64_encode(
                    hash('sha256', $password, true)
                ),
                PASSWORD_DEFAULT
            );

        $data = array(
            'nombre' => $this->input->POST('usuario'),
            'password' => $clave,
            'email' => $this->input->POST('email'),
            'perfil' => $this->input->POST('perfil'),
            'foto' => '1',
            'foto' => 2,
            'estado' => 1,
            'ultimo_login' => date("Y-m-d"),
            'fecha' => date("Y-m-d"),
            'intentos' => 0,
            'unidad' => $codigo,
            'id_estatus'=>1,
            'fecha_update' => date("Y-m-d"),
            'rif_organoente' =>$rif,
            'id_usuario_c' =>$this->session->userdata('id_user')
        );
        //print_r($data);die;

        $data2 = array(
            'nombrefun' => $this->input->POST('nombrefun'),
            'apellido' => $this->input->POST('apellido'),
            'tipo_ced' => 'V',
            'cedula' => $this->input->POST('cedula'),
            'cargo' => $this->input->POST('cargo'),
            'tele_1' => $this->input->POST('tele_1'),
            'tele_2' => $this->input->POST('tele_2'),
            'oficina' => $this->input->POST('oficina'),
            'fecha_designacion' => $this->input->POST('fecha_designacion'),
            'numero_gaceta' => $this->input->POST('numero_gaceta'),
            'email' => $this->input->POST('email'),
            'tipo_funcionario' => 3,
            'unidad' => $codigo,
            'fecha' => date("Y-m-d"),
            'obser' => $this->input->POST('obser'),
            "id_usuario" => null
        );
        $data = $this->User_model->save_user_c($data,$data2);
        echo json_encode($data);
    } 
        public function chk_password_expression($str)
        {
            if(!$this->session->userdata('session')) {
                redirect('login');
            }
            if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[^a-zA-Z\d])(?=.*[a-z])(?=.*[A-Z]).*$/", $str)) {
                $this->form_validation->set_message('chk_password_expression', '%s debe tener al menos 6
				caracteres y debe contener al menos una Caracter Especial ,una letra Minúscula, una Letra Mayúscula y un Número');
                return false;
            } else {
                return true;
            }
        }
        public function select_validate($selectValue)
        {
            // 'none' is the first option and the text says something like "-Choose one-"
            if($selectValue == 'none') {
                $this->form_validation->set_message('select_validate', 'Selecione una opción');
                return false;
            } else { // user picked something
                return true;
            }
        }
        public function savedante()
        {
            if(!$this->session->userdata('session')) {
                redirect('login');
            }
            $parametros = $this->input->post('id_unidad');
            $separar        = explode("/", $parametros);
            $data['codigo']  = $separar['0'];
            $data['rif'] = $separar['1'];

            $codigo = $data['codigo'];
            $rif=$data['rif'];
            $nombrefun = $this->input->post("nombrefun");
            $apellido = $this->input->post("apellido");
            $tipo_ced = $this->input->post("tipo_ced");
            $cedula = $this->input->post("cedula");
            $cargo = $this->input->post("cargo");
            $tele_1 = $this->input->post("tele_1");
            $tele_2 = $this->input->post("tele_2");
            $oficina = $this->input->post("oficina");
            $fecha_designacion = $this->input->post("fecha_designacion");
            $numero_gaceta = $this->input->post("numero_gaceta");
            $obser = $this->input->post("obser");
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $repeatPassord = $this->input->post("repeatPassord");
            $usuario = $this->input->post("usuario");
            $unidad = $this->input->post("id_unidad");
            $perfil = $this->input->post("perfil");
            //aca empiezo las validaciones
            $this->form_validation->set_rules('perfil', 'perfil', 'trim|required|callback_select_validate');
            $this->form_validation->set_rules('id_unidad', 'id_unidad', 'trim|required|callback_select_validate');
            $this->form_validation->set_rules('nombrefun', 'Nombre ', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('apellido', 'Apellido ', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('tipo_ced', 'tipo_ced ', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('cedula', 'cedula de dentidad', 'trim|required|min_length[6]|is_natural');
            $this->form_validation->set_rules('cargo', 'cargo ', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('tele_1', 'tele_1 comleto', 'trim|required|min_length[6]|is_natural');
            $this->form_validation->set_rules('oficina', 'oficina ', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('cargo', 'cargo ', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('fecha_designacion', 'fecha_designacion ', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('numero_gaceta', 'numero_gaceta ', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('obser', 'obser ', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('email', 'Correo eléctronico ', 'trim|required|valid_email|is_unique[usuario.email]');
            //vista en public
            $this->form_validation->set_rules(
                'usuario',
                'usuario',
                'required|callback_chk_password_expression|is_unique[usuario.nombre]',
                array(
                        'required'      => 'You have not provided %s.',
                        'is_unique'     => 'El nombre de usuario ya existe, intente de nuevo'
                )
            );

            $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[6]|max_length[15]|callback_chk_password_expression');
            $this->form_validation->set_rules('repeatPassord', 'Confirma contraseña', 'required|matches[password]');
            //$this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[5]|is_unique[usuario.nombre]|callback_chk_password_expression');


            if ($this->form_validation->run() == false) {
                if(!$this->session->userdata('session')) {
                    redirect('login');
                }
                $data['organo']  = $this->User_model->consultar_organos();
                $data['entes']   = $this->User_model->consultar_entes();
                $data['enteads'] = $this->User_model->consultar_enteads();
                $data['final']  = $this->User_model->consulta_organoente();
                $data['ver_perfil'] = $this->User_model->consultar_perfiles();
                $this->load->view('templates/header.php');
                $this->load->view('templates/navigator.php');
                $this->load->view('user/usuarioexterno.php', $data);
                $this->load->view('templates/footer.php');

            } else {

                $clave = password_hash(
                    base64_encode(
                        hash('sha256', $password, true)
                    ),
                    PASSWORD_DEFAULT
                );
                //esto es lo que va a la primera tabla usuarios
                $data = array(
        // 		$codigo = $data['codigo'];
        // $rif=$data['rif'];

                    "nombre" => $usuario,
                    "password" => $clave,
                    "email" => $email,
                    "perfil" => $perfil,
                    "foto" => 2,
                    "estado" => 1,
                    "ultimo_login" => date("Y-m-d"),
                    "fecha" => date("Y-m-d"),
                    "intentos" => 0,
                    "unidad" => $codigo,
                    "id_estatus"=>1,
                    "fecha_update" => date("Y-m-d"),
                    "rif_organoente" =>$rif

                );

                $data2 = array(
                    "nombrefun" => $nombrefun,
                    "apellido" => $apellido,
                    "tipo_cedula" => $tipo_ced,
                    "cedula" => $cedula,
                    "tele_1" => $tele_1,
                    "tele_2" => $tele_2,
                    "cargo" => $cargo,
                    "oficina" => $oficina,
                    "fecha_designacion" => $fecha_designacion,
                    "numero_gaceta" => $numero_gaceta,
                    "email" => $email,
                    "obser" => $obser,
                    "tipo_funcionario" => 3, // revisar que es esto
                    "unidad" => $codigo,
                    "id_usuario" => null
                );

                $this->User_model->savedante($data, $data2);
                $this->session->set_flashdata('success', 'El usuario Registrado es de uso personal, no se debe compartir.');
                redirect('user/int');
            }
        }



    //______________________________________________________________________________________________________________________________________________________
/*
        // CUENTA DANTE
        public function contrato()
        {
            $this->load->view('contrato.php');
        }

        public function cuentadante()
        {

            $data['organo'] = $this->User_model->consultar_organos();
            $data['entes'] = $this->User_model->consultar_entes();
            $data['organismos'] = $this->Configuracion_model->consulta_organismo();
            $data['tipo_rif'] 	= $this->Configuracion_model->consulta_tipo_rif();
            $data['estados'] 	= $this->Configuracion_model->consulta_estados();
            $this->load->view('user/reg_cuentadante.php', $data);
        }
        public function llenar()
        {
            $data = $this->input->post();
            $data =	$this->User_model->llenarm($data);
            echo json_encode($data);
        }
        ///guardar Cuenta dante
        public function savedante()
        {
            $nombrefun = $this->input->post("nombrefun");
            $apellido = $this->input->post("apellido");
            $tipo_ced = $this->input->post("tipo_ced");
            $cedula = $this->input->post("cedula");
            $cargo = $this->input->post("cargo");
            $tele_1 = $this->input->post("tele_1");
            $tele_2 = $this->input->post("tele_2");
            $oficina = $this->input->post("oficina");
            $fecha_designacion = $this->input->post("fecha_designacion");
            $numero_gaceta = $this->input->post("numero_gaceta");
            $obser = $this->input->post("obser");
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $usuario = $this->input->post("usuario");
            $unidad = $this->input->post("unidad_1");

            $repeatPassord = $this->input->post("repeatPassord");

            //aca empiezo las validaciones
            //$this->form_validation->set_rules('nombrefun', 'Nombre completo', 'required|min_length[6]');
            //$this->form_validation->set_rules('apellido', 'Apellido completo', 'required|min_length[6]');
            //$this->form_validation->set_rules('tipo_ced', 'tipo_ced completo', 'required|min_length[1]');
            //$this->form_validation->set_rules('cedula', 'cedula completo', 'required|min_length[6]');
            //$this->form_validation->set_rules('cargo', 'cargo completo', 'required|min_length[1]');
            //$this->form_validation->set_rules('tele_1', 'tele_1 completo', 'required|min_length[6]');
            //$this->form_validation->set_rules('oficina', 'oficina completo', 'required|min_length[1]');
            //$this->form_validation->set_rules('cargo', 'cargo completo', 'required|min_length[1]');
            //$this->form_validation->set_rules('fecha_designacion', 'fecha_designacion completo', 'required|min_length[1]');
            //$this->form_validation->set_rules('numero_gaceta', 'numero_gaceta completo', 'required|min_length[1]');
            $this->form_validation->set_rules('email', 'Correo eléctronico', 'required|valid_email|is_unique[usuarios.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|max_length[10]|min_length[8]|alpha_numeric');
            $this->form_validation->set_rules('repeatPassord', 'Confirma contraseña', 'required|matches[password]');
            $this->form_validation->set_rules('usuario', 'Usuario completo', 'required|min_length[5]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('user/reg_cuentadante.php');
            } else {

                $clave = password_hash(
                    base64_encode(
                        hash('sha256', $password, true)
                    ),
                    PASSWORD_DEFAULT
                );
                //esto es lo que va a la primera tabla usuarios
                $data = array(
                    "nombre" => $usuario,
                    "password" => $clave,
                    "email" => $email,
                    "foto" => 2,
                    "perfil" => 3,
                    "estado" => 1,
                    "ultimo_login" => date("Y-m-d h:m:s"),
                    "fecha" => date("Y-m-d"),
                    "intentos" => 1,
                    "unidad" => $unidad
                );

                $data2 = array(
                    "nombrefun" => $nombrefun,
                    "apellido" => $apellido,
                    "tipo_cedula" => $tipo_ced,
                    "cedula" => $cedula,
                    "tele_1" => $tele_1,
                    "tele_2" => $tele_2,
                    "cargo" => $cargo,
                    "oficina" => $oficina,
                    "fecha_designacion" => $fecha_designacion,
                    "numero_gaceta" => $numero_gaceta,
                    "email" => $email,
                    "obser" => $obser,
                    "tipo_funcionario" => 3,
                    "id_usuario" => null

                );

                $this->User_model->savedante($data, $data2);
                $this->session->set_flashdata('success', 'El usuario Registrado es de uso personal, no se debe compartir.');
                redirect('user/cuentadante');
            }
        }*/

    //usuario desbloquear usuarios
    public function desblo_usuario()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        //$data['descripcion'] = $this->session->userdata('unidad');
        //$data['rif'] = $this->session->userdata('rif');
        $data['time']=date("d-m-Y");
        $data['usuarios'] 	= $this->User_model->consulta_usuarios();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/bloqueo_user.php', $data);
        $this->load->view('templates/footer.php');
    }
    
    public function desbloquear_usuario()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data = $this->input->post();
        $data = $this->User_model->desblo_usuario($data);
        echo json_encode($data);
    }
    //ver listado de usuarios

///////////////////////////bloqueo usuario
    public function bloquear_usuario()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        //$data['descripcion'] = $this->session->userdata('unidad');
        //$data['rif'] = $this->session->userdata('rif');
        $data['time']=date("d-m-Y");
        $data['usuarios'] 	= $this->User_model->consulta_usuariost();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/bloquser.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function bloquear_usuario1()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data = $this->input->post();
        $data = $this->User_model->blo_usuario($data);
        echo json_encode($data);
    }
    /////////////////////////////////////////////
    public function modif_usuarios() // listado de usuarios internos solo snc
    {if(!$this->session->userdata('session')) {
        redirect('login');
    }
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['time']=date("d-m-Y");
        $data['te']=date('d');

        $data['ver_usuarios'] = $this->User_model->get_usuario();
        $data['ver_perfil'] = $this->User_model->consultar_perfiles(); //consultar todos los perfiles

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/modi_user.php', $data);
        $this->load->view('templates/footer.php');
    }


    public function listado_usuarios() // listado de usuarios externos
    {if(!$this->session->userdata('session')) {
        redirect('login');
    }
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['time']=date("d-m-Y");
        $data['te']=date('d');

        $data['ver_usuarios'] = $this->User_model->get_usuario_externos();
        $data['ver_perfil'] = $this->User_model->consultar_perfiles(); //consultar todos los perfiles

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/listado_user_exter.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function read_list(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->User_model->read_list($data);
        echo json_encode($data);
    }
    public function consultar_perfiles1(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->User_model->consultar_perfiles1($data);
        echo json_encode($data);
    }
    public function organo_ent(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->User_model->organo_ent($data);
        echo json_encode($data);
    }
    public function organo_ent1(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data = $this->User_model->organo_ent1($data);
        echo json_encode($data);
    }
    public function save_modif_user1(){
        if(!$this->session->userdata('session'))redirect('login');
        $data = $this->input->post();
        $data =	$this->User_model->save_modif_user1($data);
        echo json_encode($data);
    }
    public function consultar_user()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data = $this->input->post();
        $data =	$this->User_model->single_user($data);
        echo json_encode($data);
    }

    public function guardar_proc_pag()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['time']=date("d-m-Y");
        $data = $this->input->post();
        $data =	$this->User_model->guardar_mod_user($data);
        echo json_encode($data);
    }
    //ver usuario
    public function verUsuario()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $id = $this->input->get('id');

        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');

        $data['time']=date("d-m-Y");

        $data['ver_usuarios'] =	$this->User_model->ver_users($id);


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/ver_user.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function verUsuario_editar() // para editar los usuarios
    {if(!$this->session->userdata('session')) {
        redirect('login');
    }
        //$id = $this->input->get('id');
        $data['id']  = $this->input->get('id');
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');

        $data['time']=date("d-m-Y");

        $data['ver_usuarios'] =	$this->User_model->single_user($data['id']);
        $data['ver_perfil'] = $this->User_model->consultar_perfiles(); //consultar todos los perfiles
        $data['final']  = $this->User_model->consulta_organoente();


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/modi_users.php', $data);
        $this->load->view('templates/footer.php');
    }
////Guardar Usuario modificado
public function modi_usua()
{
    if(!$this->session->userdata('session')) {
        redirect('login');
    }
    

    $cambio_org=$this->input->post("cambio_org");
    $rif1 = $this->input->post("rif1");
    $rif2 = $this->input->post("rif2");
    $rif3 = $this->input->post("rif3");


    $pp_s = $cambio_org;
    if ($pp_s == 0) {
        $unidad = $rif2;
        $rif_organoente = $rif3;

    }else {
    $parametros = $this->input->post('cambio_org');
    $separar        = explode("/", $parametros);
    $unidad= $separar['0'];
    $rif_organoente= $separar['1'];

    }


    $id = $this->input->post("id1");
    $perfil = $this->input->post("perfil");
    $nombrefun = $this->input->post("nombrefun");
    $apellido = $this->input->post("apellido");
    $cedula = $this->input->post("cedula");
    $cargo = $this->input->post("cargo");
    $oficina = $this->input->post("oficina");
    $tele_1 = $this->input->post("tele_1");
    $tele_2 = $this->input->post("tele_2");
    $fecha_designacion = $this->input->post("fecha_designacion");
    $numero_gaceta = $this->input->post("numero_gaceta");
    $email = $this->input->post("email");

    // $tarifas = $this->input->post("tarifa");
    // $explode = explode('/', $tarifas);
    // $id_tarifa = $explode['0'];
    // $tarifa = $explode['1'];
    // $idd_tarida = $explode['2'];



    $usua = array(
        "id"  => $id,
        "perfil"   => $perfil,
        "unidad1"   => $unidad,
        "rif_organoente1"   => $rif_organoente,
        "fecha_update"  => date("Y-m-d")
    );
       //print_r($usua);die;

    $funci = array( //propietarios
        'nombrefun'   	 => $this->input->post('nombrefun'),
        'apellido'   => $this->input->post('apellido'),
        'cedula'  => $this->input->post('cedula'),
        'cargo' 	 => $this->input->post('cargo'),
        'oficina' 	 => $this->input->post('oficina'),
        'tele_1' 	     => $this->input->post('tele_1'),
        'tele_2' 	     => $this->input->post('tele_2'),
        'fecha_designacion' 	     => $this->input->post('fecha_designacion'),
        'numero_gaceta' 	     => $this->input->post('numero_gaceta'),
        'email' 	     => $this->input->post('email'),
        "id"  => $id,

    );


    $data = $this->User_model->editar_modi_usua($usua, $funci, $id);

    if ($data) {
        $this->session->set_flashdata('sa-success2', 'Se guardo los datos correctamente');
        redirect('User/listado_usuarios');
    } else {
        $this->session->set_flashdata('sa-error', 'error');
        redirect('User/listado_usuarios');
    }
}

    //creacion de perfiles
    public function perfil_()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');
        $data['time']=date("d-m-Y");
        $data['te']=date('d');

        $data['ver_perfil'] = $this->User_model->consultar_perfiles();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/perfil.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function guardar_perfil()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['time']=date("d-m-Y");
        $data = $this->input->post();
        $data =	$this->User_model->guardar_perfil($data);
        echo json_encode($data);
    }
    public function verPerfil()
    {
        if(!$this->session->userdata('session')) {
            redirect('login');
        }
        $id = $this->input->get('id');

        $data['descripcion'] = $this->session->userdata('unidad');
        $data['rif'] = $this->session->userdata('rif');

        $data['time']=date("d-m-Y");

        $data['ver_perfil'] =	$this->User_model->ver_perfil($id);


        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/ver_peril.php', $data);
        $this->load->view('templates/footer.php');
    }

    public function valida_ced4(){
        $cedula = $this->input->post('cedula');
        $data= $this->User_model->valida_ced4($cedula);
       //$data = $this->input->post();
      echo json_encode($data);
       
      
      }
      public function validad_correo1(){
        $email = $this->input->post('email');
        $data= $this->User_model->valida_correo($email);
       //$data = $this->input->post();
    echo json_encode($data);    
    }
    public function validad_users(){
        $usuario = $this->input->post('usuario');
        $data= $this->User_model->validad_users($usuario);
       //$data = $this->input->post();
    echo json_encode($data);    
    }
    public function see_ses()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
        $data['sseesion'] = $this->User_model->red_ssses();
        $usuario = $this->session->userdata('id_user');
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/ses_open.php', $data);
        $this->load->view('templates/footer.php');
    }
    public function delet_sse() {
        if (!$this->session->userdata('session'))
            redirect('login');
        $data = $this->input->post();
        $data = $this->User_model->delet_sse($data);
        echo json_encode($data);
    }
}
