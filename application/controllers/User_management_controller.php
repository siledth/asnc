<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_management_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_management_model');

        $this->load->library('session');
    }

    public function v_assign_units()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $data['usuarios'] = $this->User_management_model->get_all_users();
        $data['organos_entes'] = $this->User_model->consulta_organoente();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/user_management/assign_units_view', $data);
        $this->load->view('templates/footer.php');
    }

    public function assign_additional_units()
    {
        $id_usuario = $this->input->post('id_usuario');
        $unidades = $this->input->post('unidades');

        if (empty($id_usuario) || empty($unidades)) {
            echo json_encode(['success' => false, 'message' => 'Faltan datos para la asignación.']);
            return;
        }

        $result = $this->User_management_model->assign_additional_units($id_usuario, $unidades);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Unidades asignadas exitosamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ocurrió un error al asignar las unidades.']);
        }
    }
    // --- NUEVAS FUNCIONES PARA GESTIONAR RIFS ---

    // Función para cargar la vista de gestión de RIFs
    public function v_manage_user_rifs()
    {
        if (!$this->session->userdata('session')) {
            redirect('login');
        }

        $data['usuarios'] = $this->User_management_model->get_all_users();

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/user_management/manage_user_rifs_view', $data);
        $this->load->view('templates/footer.php');
    }

    // Función para obtener los RIFs de un usuario (para la tabla)
    public function get_user_rifs()
    {
        $id_usuario = $this->input->post('id_usuario');
        if (empty($id_usuario)) {
            echo json_encode(['success' => false, 'message' => 'ID de usuario no proporcionado.']);
            return;
        }

        $rifs = $this->User_management_model->get_user_additional_rifs($id_usuario);

        echo json_encode(['success' => true, 'rifs' => $rifs]);
    }

    // Función para actualizar el estatus de un RIF
    public function update_rif_status()
    {
        $id_usuario = $this->input->post('id_usuario');
        $rif_organoente = $this->input->post('rif_organoente');
        $status = $this->input->post('status');

        if (empty($id_usuario) || empty($rif_organoente) || !isset($status)) {
            echo json_encode(['success' => false, 'message' => 'Faltan datos para la actualización.']);
            return;
        }

        $result = $this->User_management_model->update_rif_status($id_usuario, $rif_organoente, $status);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Estatus actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el estatus.']);
        }
    }
}
