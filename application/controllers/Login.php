<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
    }

    public function index()
    {
        //   $data['title'] = 'Inicio de Sesión'; // Título para la página
        $this->load->view('templates/headerlog');
        $this->load->view('templates/navbarlog');
        $this->load->view('login_view');
        $this->load->view('templates/footerlog');
    }

    // public function autenticar()
    // {
    //     $username = $this->input->post('username');
    //     $password = $this->input->post('password');
    //     $usuario = $this->Usuario_model->iniciar($username, $password);

    //     if (is_array($usuario)) {
    //         // Verificar si 'id_unidad' existe en la tabla 'organoente'
    //         $id_unidad = $usuario['unidad'];
    //         $existe_unidad = $this->Usuario_model->verificar_unidad_en_organoente($id_unidad);

    //         if ($existe_unidad) {
    //             // Preparar datos para insertar en la tabla de sesiones
    //             $login_data = array(
    //                 'user_id' => $usuario['id'],
    //                 'session_id' => session_id(), // ID de la sesión actual
    //                 'login_time' => date('Y-m-d H:i:s') // Fecha y hora actual
    //             );

    //             // Intentar insertar el registro en la tabla de sesiones
    //             $insert_result = $this->Usuario_model->insertar_login($login_data);

    //             if ($insert_result === FALSE) {
    //                 // Si ya tiene una sesión activa, mostrar error
    //                 $data['error'] = 'Ya tiene una sesión abierta.';
    //                 $this->load->view('templates/headerlog');
    //                 $this->load->view('templates/navbarlog');
    //                 $this->load->view('login_view', $data);
    //                 $this->load->view('templates/footerlog');
    //             } else {
    //                 // Set session data
    //                 $session_data = array(
    //                     'id_user' => $usuario['id'],
    //                     'nombre' => $usuario['nombre'],
    //                     'email' => $usuario['email'],
    //                     'perfil' => $usuario['perfil'],
    //                     'id_unidad' => $usuario['unidad'],
    //                     'unidad' => $usuario['descripcion'],
    //                     'codigo_onapre' => $usuario['cod_onapre'],
    //                     'rif' => $usuario['rif'],
    //                     'rif_organoente' => $usuario['rif_organoente'],
    //                     'menu_rnce' => $usuario['menu_rnce'],
    //                     'menu_progr' => $usuario['menu_progr'],
    //                     'menu_eval_desem' => $usuario['menu_eval_desem'],
    //                     'menu_reg_eval_desem' => $usuario['menu_reg_eval_desem'],
    //                     'menu_anulacion' => $usuario['menu_anulacion'],
    //                     'menu_soli_anular_eval_desem' => $usuario['menu_soli_anular_eval_desem'],
    //                     'menu_proc_anular_eval_desem' => $usuario['menu_proc_anular_eval_desem'],
    //                     'menu_repor_evalu' => $usuario['menu_repor_evalu'],
    //                     'menu_comprobante_eval_desem' => $usuario['menu_comprobante_eval_desem'],
    //                     'menu_estdi_eval_desem' => $usuario['menu_estdi_eval_desem'],
    //                     'menu_noregi_eval_desem' => $usuario['menu_noregi_eval_desem'],
    //                     'menu_llamado' => $usuario['menu_llamado'],
    //                     'consultar_llamado' => $usuario['consultar_llamado'],
    //                     'reg_llamado' => $usuario['reg_llamado'],
    //                     'anul_llamado' => $usuario['anul_llamado'],
    //                     'ver_anul_llamado' => $usuario['ver_anul_llamado'],
    //                     'ver_rnc' => $usuario['ver_rnc'],
    //                     'ver_conf' => $usuario['ver_conf'],
    //                     'ver_parametro' => $usuario['ver_parametro'],
    //                     'ver_conf_publ' => $usuario['ver_conf_publ'],
    //                     'ver_user' => $usuario['ver_user'],
    //                     'ver_user_exter' => $usuario['ver_user_exter'],
    //                     'ver_user_desb' => $usuario['ver_user_desb'],
    //                     'ver_user_lista' => $usuario['ver_user_lista'],
    //                     'ver_user_perfil' => $usuario['ver_user_perfil'],
    //                     'certificacion' => $usuario['certificacion'],
    //                     'certi_externo' => $usuario['certi_externo'],
    //                     'menu_certi' => $usuario['menu_certi'],
    //                     'pdvsa' => $usuario['pdvsa'],
    //                     'accion_llamado' => $usuario['accion_llamado'],
    //                     'menu_comisiones' => $usuario['menu_comisiones'],
    //                     'comisiones_interna_mieb' => $usuario['comisiones_interna_mieb'],
    //                     'comisiones_interna_certifi' => $usuario['comisiones_interna_certifi'],
    //                     'notif_comisi_externa_mib' => $usuario['notif_comisi_externa_mib'],
    //                     'certi_miemb_externo' => $usuario['certi_miemb_externo'],
    //                     'consulta_snc_certi_mb' => $usuario['consulta_snc_certi_mb'],
    //                     'consultas_exter_miembros' => $usuario['consultas_exter_miembros'],
    //                     'consultas_exter_mb_certificado' => $usuario['consultas_exter_mb_certificado'],
    //                     'registrar_prog_anual' => $usuario['registrar_prog_anual'],
    //                     'modi_prog_anual_ley' => $usuario['modi_prog_anual_ley'],
    //                     'reg_rend_anual' => $usuario['reg_rend_anual'],
    //                     'consul_prog_anual' => $usuario['consul_prog_anual'],
    //                     'consul_mod_ley_anual' => $usuario['consul_mod_ley_anual'],
    //                     'consultar_rendi_anual' => $usuario['consultar_rendi_anual'],
    //                     // 'invest_contratista' => $usuario['invest_contratista'], //revisar esto
    //                     'ver_avanzado' => $usuario['ver_avanzado'],
    //                     'avanz_rnce' => $usuario['avanz_rnce'],
    //                     'avanz_rnc' => $usuario['avanz_rnc'],
    //                     'avanz_gne' => $usuario['avanz_gne'],
    //                     'permisos' => $usuario['permisos'],
    //                     'session' => TRUE
    //                 );

    //                 $this->session->set_userdata($session_data);
    //                 redirect('home');
    //             }
    //         } else {
    //             $data['error'] = 'Usuario o contraseña incorrectos';
    //             $this->load->view('templates/headerlog');
    //             $this->load->view('templates/navbarlog');
    //             $this->load->view('login_view', $data);
    //             $this->load->view('templates/footerlog');
    //         }
    //     } else if ($usuario === 'FALLIDO') {
    //         $data['error'] = 'Usuario o contraseña incorrectos';
    //         $this->load->view('templates/headerlog');
    //         $this->load->view('templates/navbarlog');
    //         $this->load->view('login_view', $data);
    //         $this->load->view('templates/footerlog');
    //     } else if ($usuario === 'BLOQUEADO') {
    //         $data['error'] = 'Usuario bloqueado. Contacte corporativos: 0426-5654730/0426-5654740';
    //         $this->load->view('templates/headerlog');
    //         $this->load->view('templates/navbarlog');
    //         $this->load->view('login_view', $data);
    //         $this->load->view('templates/footerlog');
    //     } else {
    //         $data['error'] = 'Usuario o contraseña incorrectos';
    //         $this->load->view('templates/headerlog');
    //         $this->load->view('templates/navbarlog');
    //         $this->load->view('login_view', $data);
    //         $this->load->view('templates/footerlog');
    //     }
    // }
    public function autenticar()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $usuario = $this->Usuario_model->iniciar($username, $password);

        if (is_array($usuario)) {
            $id_unidad = $usuario['unidad'];
            $existe_unidad = $this->Usuario_model->verificar_unidad_en_organoente($id_unidad);

            if ($existe_unidad) {
                $login_data = array(
                    'user_id' => $usuario['id'],
                    'session_id' => session_id(),
                    'login_time' => date('Y-m-d H:i:s')
                );

                $insert_result = $this->Usuario_model->insertar_login($login_data);

                if ($insert_result === FALSE) {
                    $data['error'] = 'Ya tiene una sesión abierta.';
                    $this->load->view('templates/headerlog');
                    $this->load->view('templates/navbarlog');
                    $this->load->view('login_view', $data);
                    $this->load->view('templates/footerlog');
                } else {
                    // --- LÓGICA MODIFICADA: Obtener RIFs adicionales y combinarlos con el principal ---
                    // Obtener los RIFs adicionales
                    $otros_rifs = $this->Usuario_model->get_additional_organoentes($usuario['id']);

                    // Crear un array que contiene el RIF principal y los adicionales
                    $todos_rifs = array_merge([['rif_organoente' => $usuario['rif_organoente'], 'unidad' => $usuario['unidad']]], $otros_rifs);

                    // Set session data
                    $session_data = array(
                        'id_user' => $usuario['id'],
                        'nombre' => $usuario['nombre'],
                        'email' => $usuario['email'],
                        'perfil' => $usuario['perfil'],
                        'id_unidad' => $usuario['unidad'],
                        'unidad' => $usuario['descripcion'],
                        'codigo_onapre' => $usuario['cod_onapre'],
                        'rif' => $usuario['rif_organoente'],
                        'rif_organoente' => $usuario['rif_organoente'],
                        'menu_rnce' => $usuario['menu_rnce'],
                        'menu_progr' => $usuario['menu_progr'],
                        'menu_eval_desem' => $usuario['menu_eval_desem'],
                        'menu_reg_eval_desem' => $usuario['menu_reg_eval_desem'],
                        'menu_anulacion' => $usuario['menu_anulacion'],
                        'menu_soli_anular_eval_desem' => $usuario['menu_soli_anular_eval_desem'],
                        'menu_proc_anular_eval_desem' => $usuario['menu_proc_anular_eval_desem'],
                        'menu_repor_evalu' => $usuario['menu_repor_evalu'],
                        'menu_comprobante_eval_desem' => $usuario['menu_comprobante_eval_desem'],
                        'menu_estdi_eval_desem' => $usuario['menu_estdi_eval_desem'],
                        'menu_noregi_eval_desem' => $usuario['menu_noregi_eval_desem'],
                        'menu_llamado' => $usuario['menu_llamado'],
                        'consultar_llamado' => $usuario['consultar_llamado'],
                        'reg_llamado' => $usuario['reg_llamado'],
                        'anul_llamado' => $usuario['anul_llamado'],
                        'ver_anul_llamado' => $usuario['ver_anul_llamado'],
                        'ver_rnc' => $usuario['ver_rnc'],
                        'ver_conf' => $usuario['ver_conf'],
                        'ver_parametro' => $usuario['ver_parametro'],
                        'ver_conf_publ' => $usuario['ver_conf_publ'],
                        'ver_user' => $usuario['ver_user'],
                        'ver_user_exter' => $usuario['ver_user_exter'],
                        'ver_user_desb' => $usuario['ver_user_desb'],
                        'ver_user_lista' => $usuario['ver_user_lista'],
                        'ver_user_perfil' => $usuario['ver_user_perfil'],
                        'certificacion' => $usuario['certificacion'],
                        'certi_externo' => $usuario['certi_externo'],
                        'menu_certi' => $usuario['menu_certi'],
                        'pdvsa' => $usuario['pdvsa'],
                        'accion_llamado' => $usuario['accion_llamado'],
                        'menu_comisiones' => $usuario['menu_comisiones'],
                        'comisiones_interna_mieb' => $usuario['comisiones_interna_mieb'],
                        'comisiones_interna_certifi' => $usuario['comisiones_interna_certifi'],
                        'notif_comisi_externa_mib' => $usuario['notif_comisi_externa_mib'],
                        'certi_miemb_externo' => $usuario['certi_miemb_externo'],
                        'consulta_snc_certi_mb' => $usuario['consulta_snc_certi_mb'],
                        'consultas_exter_miembros' => $usuario['consultas_exter_miembros'],
                        'consultas_exter_mb_certificado' => $usuario['consultas_exter_mb_certificado'],
                        'registrar_prog_anual' => $usuario['registrar_prog_anual'],
                        'modi_prog_anual_ley' => $usuario['modi_prog_anual_ley'],
                        'reg_rend_anual' => $usuario['reg_rend_anual'],
                        'consul_prog_anual' => $usuario['consul_prog_anual'],
                        'consul_mod_ley_anual' => $usuario['consul_mod_ley_anual'],
                        'consultar_rendi_anual' => $usuario['consultar_rendi_anual'],
                        'ver_avanzado' => $usuario['ver_avanzado'],
                        'avanz_rnce' => $usuario['avanz_rnce'],
                        'avanz_rnc' => $usuario['avanz_rnc'],
                        'avanz_gne' => $usuario['avanz_gne'],
                        'permisos' => $usuario['permisos'],
                        'todos_rifs' => $todos_rifs, // --- GUARDAR TODOS LOS RIFS EN SESIÓN ---
                        'session' => TRUE
                    );

                    $this->session->set_userdata($session_data);
                    redirect('home');
                }
            } else {
                $data['error'] = 'Usuario o contraseña incorrectos';
                $this->load->view('templates/headerlog');
                $this->load->view('templates/navbarlog');
                $this->load->view('login_view', $data);
                $this->load->view('templates/footerlog');
            }
        } else if ($usuario === 'FALLIDO') {
            $data['error'] = 'Usuario o contraseña incorrectos';
            $this->load->view('templates/headerlog');
            $this->load->view('templates/navbarlog');
            $this->load->view('login_view', $data);
            $this->load->view('templates/footerlog');
        } else if ($usuario === 'BLOQUEADO') {
            $data['error'] = 'Usuario bloqueado. Contacte corporativos: 0426-5654730/0426-5654740';
            $this->load->view('templates/headerlog');
            $this->load->view('templates/navbarlog');
            $this->load->view('login_view', $data);
            $this->load->view('templates/footerlog');
        } else {
            $data['error'] = 'Usuario o contraseña incorrectos';
            $this->load->view('templates/headerlog');
            $this->load->view('templates/navbarlog');
            $this->load->view('login_view', $data);
            $this->load->view('templates/footerlog');
        }
    }
    /**
     * Cambia el contexto del usuario a otro RIF_Organoente y actualiza la sesión.
     * @param string $rif_organoente El RIF del nuevo órgano/ente.
     */
    public function change_organoente($rif_organoente)
    {
        $user_id = $this->session->userdata('id_user');

        if (!$user_id) {
            redirect('login'); // Redirigir si no hay sesión
            return;
        }

        // Obtener la unidad y descripción para el nuevo RIF
        $organoente_data = $this->Usuario_model->get_organoente_by_rif($rif_organoente);
        if (!$organoente_data) {
            redirect('home'); // Redirigir si el RIF no es válido
            return;
        }

        $new_unidad = $organoente_data['codigo'];
        $new_descripcion = $organoente_data['descripcion'];

        // Obtener la información del usuario con el nuevo contexto
        $new_user_data = $this->Usuario_model->get_user_data_by_organoente($user_id, $rif_organoente, $new_unidad);

        if ($new_user_data) {
            // Actualizar solo la información relevante de la sesión
            $this->session->set_userdata('id_unidad', $new_user_data['unidad']);
            $this->session->set_userdata('unidad', $new_user_data['descripcion']);
            $this->session->set_userdata('rif_organoente', $new_user_data['rif_organoente']);

            // Actualizar permisos según el nuevo perfil (si aplica)
            $this->session->set_userdata('perfil', $new_user_data['perfil']);
            $this->session->set_userdata('menu_rnce', $new_user_data['menu_rnce']);
            // ... (Actualizar todos los permisos como en la función autenticar) ...
        }

        // Recargar la página principal para aplicar los cambios de sesión
        redirect('home');
    } ///////////////////////////
    public function logout()
    {

        $data = array(
            'user_id' => $this->session->userdata('id_user'),
            'ultimo_login'     => date('Y-m-d H:i:s')
        );
        $data = $this->login_model->delesesion1($data);
        echo json_encode($data);
        if ($data == TRUE) {
            $this->session->unset_userdata('logged_in');
            $this->session->sess_destroy();
            redirect('login');
        } else {

            $this->session->set_flashdata('alert', 'algo paso');
            redirect('login');
        }
    }

    public function v_camb_clave()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('login/cambiar_clave.php');
        $this->load->view('templates/footer.php');
    }
    public function cambiar_clave()
    {
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
}
