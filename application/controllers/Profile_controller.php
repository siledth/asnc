<?php
// application/controllers/Profile_controller.php

class Profile_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Cargar el modelo que interactúa con las tablas de usuarios y perfiles
        // $this->load->model('User_model');
        // Cargar el helper de URL para poder usar la función redirect()
        // $this->load->helper('url');
        // Cargar la librería de sesión para verificar el estado del usuario
        // $this->load->library('session');

        // **Verificación de Sesión:**
        // Esta línea asegura que solo los usuarios con sesión activa puedan acceder a este controlador.
        // Si no hay sesión, se redirige a la página de login.
        // Asegúrate de que 'login' sea la URL correcta de tu página de inicio de sesión.
        if (!$this->session->userdata('session')) {
            redirect('login');
        }
    }

    /**
     * **Método Principal (index):**
     * Este método se encarga de cargar la vista inicial que muestra la lista de usuarios.
     * Es el punto de entrada cuando se navega a este controlador (ej. /index.php/Profile_controller).
     */
    public function profile_editor()
    {
        // Obtiene todos los usuarios junto con el nombre de su perfil desde el modelo.
        $data['users'] = $this->User_model->get_all_users_with_profile_names();
        // Carga la vista 'profile_editor_view' y le pasa los datos de los usuarios.

        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/profile_editor_view.php', $data);
        $this->load->view('templates/footer.php');
    }


    /**
     * **get_user_data_for_edit (Método AJAX):**
     * Este método es llamado por AJAX desde la vista para obtener los detalles de un usuario
     * específico y los permisos de su perfil actual cuando se abre el modal de edición.
     * Retorna los datos en formato JSON.
     */
    public function get_user_data_for_edit()
    {
        // Obtiene el ID de usuario enviado a través de POST.
        $user_id = $this->input->post('user_id');

        if ($user_id) {
            // Obtiene los detalles básicos del usuario (nombre, email, ID de perfil).
            $user_details = $this->User_model->get_user_details($user_id);
            // Obtiene la lista completa de todos los perfiles disponibles para el dropdown.
            $all_profiles = $this->User_model->get_all_profiles_dropdown();

            if ($user_details) {
                // Obtiene todos los campos del perfil actual del usuario, incluyendo los permisos (0/1).
                $current_profile_permissions = $this->User_model->get_profile_permissions($user_details['perfil']);

                // **Importante:** Eliminamos los campos que no son permisos para no enviarlos a la vista
                // como si fueran checkboxes.
                unset($current_profile_permissions['id_perfil']);
                unset($current_profile_permissions['nombrep']);
                unset($current_profile_permissions['fecha_creacion']); // Si existe en tu tabla 'perfil'

                // Envía la respuesta JSON con todos los datos necesarios para el modal.
                echo json_encode(array(
                    'success' => true,
                    'user' => $user_details,
                    'all_profiles' => $all_profiles,
                    'current_profile_permissions' => $current_profile_permissions
                ));
            } else {
                // Si el usuario no fue encontrado, envía un mensaje de error.
                echo json_encode(array('success' => false, 'message' => 'Usuario no encontrado.'));
            }
        } else {
            // Si no se proporcionó un ID de usuario, envía un mensaje de error.
            echo json_encode(array('success' => false, 'message' => 'ID de usuario no proporcionado.'));
        }
    }

    /**
     * **get_permissions_for_profile (Método AJAX):**
     * Este método es llamado por AJAX cuando el usuario cambia el perfil en el dropdown del modal.
     * Su función es obtener solo los permisos (campos 0/1) del perfil recién seleccionado
     * y devolverlos para actualizar la cuadrícula de permisos en la vista.
     * Retorna los permisos en formato JSON.
     */
    public function get_permissions_for_profile()
    {
        // Obtiene el ID del perfil seleccionado desde POST.
        $profile_id = $this->input->post('profile_id');

        if ($profile_id) {
            // Obtiene todos los campos del perfil seleccionado.
            $permissions = $this->User_model->get_profile_permissions($profile_id);
            if ($permissions) {
                // De nuevo, eliminamos los campos que no son permisos.
                unset($permissions['id_perfil']);
                unset($permissions['nombrep']);
                unset($permissions['fecha_creacion']); // Si existe en tu tabla 'perfil'
                echo json_encode(array('success' => true, 'permissions' => $permissions));
            } else {
                // Si el perfil no fue encontrado, envía un mensaje de error.
                echo json_encode(array('success' => false, 'message' => 'Perfil no encontrado.'));
            }
        } else {
            // Si no se proporcionó un ID de perfil, envía un mensaje de error.
            echo json_encode(array('success' => false, 'message' => 'ID de perfil no proporcionado.'));
        }
    }

    /**
     * **update_user_and_profile (Método AJAX):**
     * Este método se encarga de procesar la solicitud para actualizar el perfil asignado a un usuario
     * y también para actualizar los permisos (campos 0/1) del perfil seleccionado.
     * Utiliza transacciones de base de datos para asegurar que ambas operaciones se completen con éxito o se reviertan.
     * Retorna un mensaje de éxito o error en formato JSON.
     */
    public function update_user_and_profile()
    {
        // Obtiene el ID de usuario, el nuevo ID de perfil y los datos de los permisos desde POST.
        $user_id = $this->input->post('user_id');
        $new_profile_id = $this->input->post('new_profile_id');
        $permissions_data = $this->input->post('permissions'); // Esto será un array asociativo de PHP

        if ($user_id && $new_profile_id) {
            $this->db->trans_start(); // **INICIA LA TRANSACCIÓN DE BASE DE DATOS**

            // 1. **Actualiza el perfil asignado al usuario:**
            // Llama al modelo para cambiar el 'perfil' del usuario en la tabla 'seguridad.usuarios'.
            $user_update_success = $this->User_model->update_user_assigned_profile($user_id, $new_profile_id);

            // 2. **Actualiza los permisos del perfil seleccionado:**
            $profile_update_success = true; // Asumimos éxito por defecto si no hay permisos para actualizar.
            if (is_array($permissions_data) && !empty($permissions_data)) {
                // **Saneamiento:** Asegura que todos los valores de permisos sean 0 o 1.
                foreach ($permissions_data as $key => $value) {
                    $permissions_data[$key] = (int)$value; // Convierte a entero (0 o 1)
                }
                // Llama al modelo para actualizar los campos 0/1 del perfil en la tabla 'seguridad.perfil'.
                $profile_update_success = $this->User_model->update_profile_permissions($new_profile_id, $permissions_data);
            }

            // **VERIFICACIÓN DE LA TRANSACCIÓN:**
            // Comprueba si alguna de las operaciones falló o si la transacción tuvo problemas.
            if ($this->db->trans_status() === FALSE || !$user_update_success || !$profile_update_success) {
                $this->db->trans_rollback(); // **DESHACER (ROLLBACK) TODO** si algo falla.
                echo json_encode(array('success' => false, 'message' => 'Error al actualizar el usuario o los permisos del perfil. Se ha revertido la operación.'));
            } else {
                $this->db->trans_commit(); // **CONFIRMAR (COMMIT) TODO** si ambas operaciones fueron exitosas.
                echo json_encode(array('success' => true, 'message' => 'Perfil de usuario y permisos actualizados correctamente.'));
            }
        } else {
            // Si faltan datos esenciales, envía un mensaje de error.
            echo json_encode(array('success' => false, 'message' => 'Datos incompletos para la actualización.'));
        }
    }
}
