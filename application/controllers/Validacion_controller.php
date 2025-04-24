<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validacion_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Validacion_model');
    }
    public function recuperar()
    {
        if (!$this->session->userdata('session')) {


            $this->load->view('templates/headerlog');
            $this->load->view('templates/navbarlog');
            $this->load->view('user/validar_usuario_view.php');
            $this->load->view('templates/footerlog');
        } else {
        }
    }
    // Paso 1: Validar usuario
    public function validar_usuario()  //esto estoy modificando
    {
        $username = json_decode(file_get_contents('php://input'), true)['username'];

        // Verificar si el usuario existe
        // Validar que el campo no esté vacío
        if (empty($username)) {
            $response = array(
                'success' => false,
                'message' => 'El campo Nombre de Usuario es obligatorio.'
            );
        } else {
            // Verificar si el usuario existe
            $usuario = $this->Validacion_model->obtener_usuario($username);

            if ($usuario) {
                // $response = array(
                //     'success' => true,
                //     'id_usuario' => $usuario->id


                // );
                $id_usuario = $usuario->id;
                // Generar un token temporal
                $token = bin2hex(random_bytes(32));
                // Guardar el token en la base de datos
                $this->Validacion_model->guardar_token($id_usuario, $token);
                $response = array(
                    'success' => true,
                    'message' => 'Respuestas válidas.',
                    'token' => $token // Incluir el token en la respuesta
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Usuario  incorecto.'
                );
            }
        }

        // Devolver la respuesta en formato JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    // Paso 2: Mostrar preguntas de seguridad
    public function mostrar_preguntas()
    {
        $token = $this->input->get('token');
        $id_usuario = $this->Validacion_model->validar_token($token);

        // Obtener 2 preguntas aleatorias del usuario
        if ($id_usuario) {
            $preguntas = $this->Validacion_model->obtener_preguntas_aleatorias($id_usuario);

            if ($preguntas) {
                $data['preguntas'] = $preguntas;
                $data['id_usuario'] = $id_usuario;
                $this->load->view('templates/headerlog');
                $this->load->view('templates/navbarlog');
                $this->load->view('user/validar_preguntas_view', $data);
                $this->load->view('templates/footerlog');
            } else {
                echo "No se encontraron preguntas de seguridad para este usuario.";
            }
        } else {
            // Token inválido, redirigir a una página de error
            redirect('error');
        }
    }

    ///esto es un cambio lloco 
    public function obtener_preguntas_json()
    {
        $token = $this->input->get('token');
        $id_usuario = $this->Validacion_model->validar_token($token);

        if (!$id_usuario) {
            echo json_encode(['success' => false, 'message' => 'Token inválido']);
            return;
        }

        $preguntas = $this->Validacion_model->obtener_preguntas_aleatorias($id_usuario);

        if ($preguntas) {
            echo json_encode([
                'success' => true,
                'id_usuario' => $id_usuario,
                'preguntas' => $preguntas
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se encontraron preguntas de seguridad para este usuario.'
            ]);
        }
    }
    // Paso 3: Validar respuestas
    public function validar_respuestas()
    {
        $id_usuario = $this->input->post('id_usuario');
        $respuestas = $this->input->post('respuestas');
        // Validar las respuestas
        $resultado = $this->Validacion_model->validar_respuestas($id_usuario, $respuestas);
        if ($resultado) {
            // Generar un token temporal
            $token = bin2hex(random_bytes(32));
            // Guardar el token en la base de datos
            $this->Validacion_model->guardar_token($id_usuario, $token);
            $response = array(
                'success' => true,
                'message' => 'Respuestas válidas.',
                'token' => $token // Incluir el token en la respuesta
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Respuestas incorrectas.'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function modificar_clave()
    {
        $token = $this->input->get('token');

        // Validar el token y obtener el ID del usuario (llamar al modelo)
        $id_usuario = $this->Validacion_model->validar_token($token);

        if ($id_usuario) {
            // Pasar el ID del usuario y el token a la vista
            $data['id_usuario'] = $id_usuario;
            $data['token'] = $token;
            $this->load->view('templates/headerlog');
            $this->load->view('templates/navbarlog');
            $this->load->view('user/modificar_clave_view', $data);
            $this->load->view('templates/footerlog');
        } else {
            // Token inválido, redirigir a una página de error
            redirect('error');
        }
    }
    public function cambiar_clave()
    {
        $id_usuario = $this->input->post('id_usuario');
        $clave = $this->input->post('clave');
        $c_clave = $this->input->post('c_clave');
        $token = $this->input->post('token'); // Obtener el token del formulario

        if ($clave == $c_clave) {
            // Encriptar la nueva clave
            $clave_encriptada = password_hash(base64_encode(hash('sha256', $clave, true)), PASSWORD_DEFAULT);

            // Actualizar la clave en la base de datos (llamar al modelo)
            $this->Validacion_model->actualizar_clave($id_usuario, $clave_encriptada);

            // Eliminar el token después de usarlo (llamar al modelo)
            $this->Validacion_model->eliminar_token($token);

            $response = array(
                'success' => true,
                'message' => 'Clave actualizada correctamente.'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Las claves no coinciden.'
            );
        }

        // Devolver la respuesta en formato JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function re_user()
    {
        if (!$this->session->userdata('session')) {


            $this->load->view('templates/headerlog');
            $this->load->view('templates/navbarlog');
            $this->load->view('user/rec_user.php');
            $this->load->view('templates/footerlog');
        } else {
        }
    }

    public function validar_cedula()
    {
        $username = json_decode(file_get_contents('php://input'), true)['username'];

        // Verificar si el usuario existe
        // Validar que el campo no esté vacío
        if (empty($username)) {
            $response = array(
                'success' => false,
                'message' => 'El campo Cedula es obligatorio.'
            );
        } else {
            // Verificar si el usuario existe
            $usuario = $this->Validacion_model->obtener_cd($username);

            if ($usuario) {
                $response = array(
                    'success' => true,
                    'id_usuario' => $usuario->id
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'incorrecto'
                );
            }
        }

        // Devolver la respuesta en formato JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function v_user()
    {
        $token = $this->input->get('token');

        // Validar el token y obtener el ID del usuario (llamar al modelo)
        $id_usuario = $this->Validacion_model->validar_token($token);


        if ($id_usuario) {

            if (!$this->session->userdata('session')) {
                $data['id_usuario'] = $id_usuario;
                $data['token'] = $token;
                //  $data ['nombre']= $this->Validacion_model->obtener_user($id_usuario);

                // Pasar el ID del usuario y el token a la vista
                $this->load->view('templates/headerlog');
                $this->load->view('templates/navbarlog');
                $this->load->view('user/v_user', $data);
                $this->load->view('templates/footerlog');
            }
        } else {
            // Token inválido, redirigir a una página de error
            redirect('error');
        }
    }
    public function mostrar_preguntas2($id_usuario)
    {
        // Obtener 2 preguntas aleatorias del usuario
        $preguntas = $this->Validacion_model->obtener_preguntas_aleatorias($id_usuario);

        if ($preguntas) {
            $data['preguntas'] = $preguntas;
            $data['id_usuario'] = $id_usuario;
            $this->load->view('templates/headerlog');
            $this->load->view('templates/navbarlog');
            $this->load->view('user/validar_preguntas2', $data);
            $this->load->view('templates/footerlog');
        } else {
            echo "No se encontraron preguntas de seguridad para este usuario.";
        }
    }
}
