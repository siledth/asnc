<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller {

  public function index() {
    if (!$this->session->userdata('session')) {
      $this->load->view('login/index.php');
    } else {
     redirect('home');
    }
  }

  public function validacion() {
    $username = $this->db->escape($username);
    $password = $this->db->escape($password);

    $usuario1 = $_POST['usuario'];
    $contrasena1 = $_POST['contrasena'];
    $data = $this->login_model->iniciar($usuario1, $contrasena1);
    //print_r();die;
    if ($data == 'FALLIDO') {
      $this->session->set_flashdata('fallido', 'Intento Fallido.');
      redirect('login', 'refres');
    } else if ($data == 'BLOQUEADO') {
      $this->session->set_flashdata('sa-error2', 'Usuario bloqueado.');
      redirect('login', 'refres');
    } else if ($data == 'FALSE') {
      $this->session->set_flashdata('sa-error', 'Datos de autenticación erróneos.');
      redirect('login', 'refres');
    } else {
      $inf = ['id_unidad' => $data['unidad']];
      $id_unidad =$inf['id_unidad'];

      $id_user =  $ssesion['id'];
      $ssesion = ['id' => $data['id']];
      $id_user =  $ssesion['id'];
      
     // $data5 = $this->login_model->existe($id_user);
     
      $data2 = $this->login_model->consultar_organo($id_unidad);
      // if ($data5 == TRUE) {
      //   $this->session->set_flashdata('alert', 'Su sesión se cerro por inactividad, vuelva a iniciar Sesión.');
      //   $data6 = $this->login_model->delesesion2($id_user);

      //   redirect('login');

      // } 
      
      // else{      
      if ($data2) {
        $user_data = [
          'id_user' => $data['id'],
          'nombre' => $data['nombre'],
          'email' => $data['email'],
          'perfil' => $data['perfil'],
          'id_unidad' => $data['unidad'],
          'unidad' => $data2['desc_organo'],
          'codigo_onapre' => $data2['cod_onapre'],
          'rif' => $data2['rif'],
          'rif_organoente' => $data['rif_organoente'],
                    'menu_rnce' => $data['menu_rnce'],
                    'menu_progr' => $data['menu_progr'],
                    'menu_eval_desem' => $data['menu_eval_desem'],
                    'menu_reg_eval_desem' => $data['menu_reg_eval_desem'],
                    'menu_anulacion' => $data['menu_anulacion'],
                    'menu_soli_anular_eval_desem' => $data['menu_soli_anular_eval_desem'],
                    'menu_proc_anular_eval_desem' => $data['menu_proc_anular_eval_desem'],
                    'menu_repor_evalu' => $data['menu_repor_evalu'],
                    'menu_comprobante_eval_desem' => $data['menu_comprobante_eval_desem'],
                    'menu_estdi_eval_desem' => $data['menu_estdi_eval_desem'],
                    'menu_noregi_eval_desem' => $data['menu_noregi_eval_desem'],
                    'menu_llamado' => $data['menu_llamado'],
                    'consultar_llamado' => $data['consultar_llamado'],
                    'reg_llamado' => $data['reg_llamado'],
                    'anul_llamado'=> $data['anul_llamado'],
                    'ver_anul_llamado' => $data['ver_anul_llamado'],
                    'ver_rnc' => $data['ver_rnc'],
                    'ver_conf' => $data['ver_conf'],
                    'ver_parametro' => $data['ver_parametro'],
                    'ver_conf_publ' => $data['ver_conf_publ'],
                    'ver_user' => $data['ver_user'],
                    'ver_user_exter' => $data['ver_user_exter'],
                    'ver_user_desb' => $data['ver_user_desb'],
                    'ver_user_lista' => $data['ver_user_lista'],
                    'ver_user_perfil' => $data['ver_user_perfil'],
                    'certificacion' => $data['certificacion'],
                    'certi_externo' => $data['certi_externo'],
                    'menu_certi' => $data['menu_certi'], 
                    'pdvsa' => $data['pdvsa'],  
                    'accion_llamado' => $data['accion_llamado'],  


          'session' => TRUE,
        ];

        $this->session->set_userdata($user_data);
        $data_session = array(

          'login_time' => date('Y-m-d H:i:s'),
          'user_id' =>$id_user,
          'session_id' => $id_user,
      );
     // $data = $this->login_model->save_session($data_session);
      echo json_encode($data);
        redirect('home');
      } else {
        echo "<script>alert('usuario o Clave Errorena! Por favor intente de nuevo.');</script>";
        redirect('login');
      }
    // } 
    }
    // else{
    // 	echo "<script>alert('usuario o Clave Errorena! Por favor intente de nuevo.');</script>";
    //     redirect('login/index');
    // }
  }
  
  public function logout() {
   
    $data = array(
      'user_id' => $this->session->userdata('id_user'),
      'ultimo_login' 	=> date('Y-m-d H:i:s') 
  );
  $data = $this->login_model->delesesion1($data);
  echo json_encode($data);
  if ($data == TRUE) {
    $this->session->sess_destroy();
    redirect('login');
  
  } else{      
   
    $this->session->set_flashdata('alert','algo paso');
    redirect('login');
  }
}
  
  public function validad_ssesion(){
    $usuario = $this->input->post('usuario');
    $data= $this->login_model->existe($usuario);
   //$data = $this->input->post();
    echo json_encode($data);
      } 
  public function validad_correo(){
    $email = $this->input->post('email');
    $data= $this->login_model->valida_correo($email);
   //$data = $this->input->post();
    echo json_encode($data);
// echo json_encode($email);
// if (json_encode($data) == 'null') {
//   echo '<div class="alert alert-success"><strong>Bien!</strong> Correo disponible.</div>';
  
// }else {
//   echo '<div class="alert alert-danger"><strong>Oh no!</strong> Correo ya Registrado, ingrese otro Correo .</div>';
// }

}
public function validad_cedula(){
  $cedula_prop = $this->input->post('cedula_prop');
  $data= $this->login_model->valida_ced($cedula_prop);
 //$data = $this->input->post();
echo json_encode($data);
 

}

  public function v_camb_clave() {
    if (!$this->session->userdata('session')) {
      redirect('login');
    }

    $this->load->view('templates/header.php');
    $this->load->view('templates/navigator.php');
    $this->load->view('login/cambiar_clave.php');
    $this->load->view('templates/footer.php');
  }

  public function cambiar_clave() {
    $id_usuario = $this->session->userdata('id_user');
    $clave = $this->input->POST('clave');
    $c_clave = $this->input->POST('c_clave');

    if ($clave == $c_clave) {
      $clave_r = password_hash(
        base64_encode(
          hash('sha256', $clave, true)
        ),
        PASSWORD_DEFAULT
      );
      //	print_r($clave_r);die;
      $data = array(
        'password' => $clave_r,
        'fecha_update' => date('Y-m-d'),
      );
      $data = $this->login_model->cambiar_clave($id_usuario, $data);
      echo json_encode($data);
    } else {
      $data = 0;
      echo json_encode($data);
    }
  }

  public function registrar_prp(){
    $nombrecomp = $this->input->post('nombre');
    $nombres = explode(' ',  $nombrecomp );

    //Para generar clave aleatoria
    $comb = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $combLen = strlen($comb) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $combLen);
        $pass[] = $comb[$n];
    }
    $clave = implode($pass); 
    $passwords = implode($pass); 
    $password = password_hash(
      base64_encode(
        hash('sha256', $passwords, true)
      ),
      PASSWORD_DEFAULT
    );
    $inf_usu = array(
      
      
     
     'nombre'   => $this->input->post('email'),
      'password'   => $password,
      'email'    => $this->input->post('email'),
      'perfil'   => 8,
      'foto'   => 1,
      'estado'   => 1,
      'ultimo_login'   => date('Y-m-d h:i:s'),
      'fecha'   => date('Y-m-d h:i:s'),
      'intentos'    => 0,
      'unidad'   => $this->input->post('cedula_prop'),
      'fecha_update'   => date('Y-m-d h:i:s'),
     'id_estatus'   => 1,
     'rif_organoente'   => $this->input->post('cedula_prop'),






      // 'nombre'       => $nombres[0],
      // 'apellido'     => $nombres[1],
      // 'email'        => $this->input->post('email'),
      // 'rif'          => $this->input->post('rif'),
      // 'password'     => $password,
      // 'tele_1'       => $this->input->post('tele_1'),
      // 'perfil'       => 3,
      // 'foto'         => 2,
      // 'intentos'     => 0,
      // 'id_estatus'   => 1,
      // 'fecha'        => date('Y-m-d h:i:s'),
      // 'fecha_update' => date('Y-m-d h:i:s')
    );

    $variables = $this->input->post('cedula_prop');
    $ced = explode("-", $variables);

    $inf_prop = array(
  

    'nombrefun'       => $nombres[0],
    //'apellido'     => $nombres[1],
      'cedula'     => $this->input->post('cedula_prop'),
      //'tipo_cedula'   => $ced['0'],
      'email'      => $this->input->post('email'),
      'fecha'        => date('Y-m-d h:i:s'),
      'id_usuario'        => 1,
    );
   
    $if_emp = array(
     
      'codigo'          => $this->input->post('cedula_prop'),
      'desc_entes'  => $this->input->post('cedula_prop'),
      'rif'  => $this->input->post('cedula_prop'),
      'correo'        => $this->input->post('email'),
      'usuario' => 1,
      'fecha'        => date('Y-m-d h:i:s'),
      
    );
    require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer(true);                           // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'soportecertificacionsnc2023@gmail.com';               // SMTP username
    //$mail->Password = 'kefxqwunkuubkdlf';
    $mail->Password = 'kvzzafmwziqmcris';                 // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->Timeout = 20;
    $mail->setFrom('soportecertificacion2023p@gmail.com', 'Certificacion 2023');

    $mail->addAddress($this->input->post('email'), '');     // Add a recipient
    $mail->Subject = 'Envio de Clave de Acceso para el REGISTRO PARA CERTIFICACION  DE PERSONAS NATURALES Y JURIDICAS';
    $mail->Body    = 'Su Clave para ingresar <b>' . $clave .'</b> <br>
    IMPORTANTE 
    * Este registro es unicamente pára realizar la carga de Certificado de Persona Natural y Juridica. <br>
    * Para Realizar carga de llamados a concusos, evaluaciones, programación anual, consulta de contratista, por favor contactar con el Servico Nacional de Contrataciones para solicitar Usuario de Ingreso <br>
    *Este Usuario sera eliminado si no realiza la carga  de solicitud de certificacion , durante los 3 das siguientes a su  creacion <br>
    Este Correo Fue Generado de Forma Automatica. No responder a Este Correo';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->SMTPDebug = true;
    $data = $this->login_model->guardar_prp($inf_usu,$inf_prop, $if_emp);
     if ($data == true) {
       if(!$mail->send()) {
        echo json_encode(false);   
       
       }else {
       
         echo json_encode($data);
       }
     }
    
 
    }
  }

//11s