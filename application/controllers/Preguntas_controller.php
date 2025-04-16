<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Preguntas_controller extends CI_Controller {

      public function __construct() {
        parent::__construct();
        $this->load->model('Preguntas_model'); // Cargar el modelo de preguntas
        $this->load->library('form_validation'); 
    }
    public function preguntas1() {
         if (!$this->session->userdata('session')) {
            redirect('login');
        }
      
    $data['preguntas'] = $this->Preguntas_model->preguntas_();
 
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/crear_preguntas_view.php', $data);
        $this->load->view('templates/footer.php');
    }
    
    public function guardar() {
        // Validar los datos de entrada
        $this->form_validation->set_rules('pregunta', 'Pregunta', 'required|numeric');
        $this->form_validation->set_rules('respuesta', 'Respuesta', 'required|max_length[255]');

        if ($this->form_validation->run() == FALSE) {
            // Si la validación falla, devolver un error
            $response = array(
                'success' => false,
                'message' => validation_errors()
            );
        } else {
            // Si la validación es exitosa, sanitizar los datos
            $pregunta_id = $this->input->post('pregunta', TRUE); // Sanitizar entrada
            $respuestas = $this->input->post('respuesta', TRUE); // Sanitizar entrada
            $respuesta_encriptada = password_hash(
                    base64_encode(
                        hash('sha256', $respuestas, true)
                    ),
                    PASSWORD_DEFAULT
                );
            // Encriptar la respuesta (opcional)
         //   $respuesta_encriptada = password_hash($respuesta, PASSWORD_BCRYPT);

            // Preparar los datos para insertar
            $data = array(
                'id_usuario' => $this->session->userdata('id_user'),
                'id_despregunta' => $pregunta_id,
                'respuesta' => $respuesta_encriptada
            );

            // Insertar en la base de datos
            $insert_id = $this->Preguntas_model->guardar_respuesta($data);

            if ($insert_id) {
                $response = array(
                    'success' => true,
                    'message' => 'Pregunta guardada correctamente.'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error al guardar la pregunta.'
                );
            }
        }

        // Devolver la respuesta en formato JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}