<?php
// application/controllers/Profile_controller.php

class Profile_controller extends CI_Controller
{
    private $per_page = 10; // Definimos cuántos usuarios por página
    public function __construct()
    {
        parent::__construct();

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
        // $data['users'] = $this->User_model->get_all_users_with_profile_names();
        // Carga la vista 'profile_editor_view' y le pasa los datos de los usuarios.
        $data['users'] = $this->User_model->get_users_paginated($this->per_page, 0);
        $data['total_users'] = $this->User_model->count_all_users();
        $data['per_page'] = $this->per_page;
        $this->load->view('templates/header.php');
        $this->load->view('templates/navigator.php');
        $this->load->view('user/profile_editor_view.php', $data);
        $this->load->view('templates/footer.php');
    }



    public function get_user_data_for_edit()
    {
        $user_id = $this->input->post('user_id');

        if ($user_id) {
            // Esta función del modelo ahora trae más datos
            $user_details = $this->User_model->get_user_details($user_id);
            $all_profiles = $this->User_model->get_all_profiles_dropdown();

            if ($user_details) {
                $current_profile_permissions = $this->User_model->get_profile_permissions($user_details['perfil']);

                unset($current_profile_permissions['id_perfil']);
                unset($current_profile_permissions['nombrep']);
                unset($current_profile_permissions['fecha_creacion']);

                echo json_encode(array(
                    'success' => true,
                    'user' => $user_details, // user_details ahora incluye datos de funcionario
                    'all_profiles' => $all_profiles,
                    'current_profile_permissions' => $current_profile_permissions
                ));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Usuario no encontrado.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'ID de usuario no proporcionado.'));
        }
    }


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


    public function update_user_and_profile()
    {
        $user_id = $this->input->post('user_id');
        $new_profile_id = $this->input->post('new_profile_id');
        $permissions_data = $this->input->post('permissions');

        // Recoger los nuevos datos del usuario desde POST
        $new_nombre = $this->input->post('new_nombre');

        $new_nombrefun = $this->input->post('new_nombrefun');
        $new_apellido = $this->input->post('new_apellido');
        $new_cedula_tipo = $this->input->post('new_cedula_tipo'); // Asumiendo que tendrás un campo para el tipo (V, E, P)
        $new_cedula_num = $this->input->post('new_cedula_num');
        $new_email = $this->input->post('new_email');
        $new_cargo = $this->input->post('new_cargo');
        $new_oficina = $this->input->post('new_oficina');
        $new_tele_1 = $this->input->post('new_tele_1');


        if ($user_id && $new_profile_id) {
            $this->db->trans_start(); // Iniciar transacción

            // 1. Datos para actualizar seguridad.usuarios
            $user_data_to_update = array(
                'nombre' => $new_nombre,
                'email' => $new_email
            );

            // 2. Datos para actualizar seguridad.funcionarios
            $funcionario_data_to_update = array(
                'nombrefun' => $new_nombrefun,
                'apellido' => $new_apellido,
                'tipo_cedula' => $new_cedula_tipo,
                'cedula' => $new_cedula_num,
                'cargo' => $new_cargo,
                'oficina' => $new_oficina,
                'tele_1' => $new_tele_1
            );


            // Llamar a la nueva función del modelo para actualizar datos de usuario y funcionario
            $user_details_update_success = $this->User_model->update_user_details(
                $user_id,
                $user_data_to_update,
                $funcionario_data_to_update
            );

            // 3. Actualizar el perfil asignado al usuario
            $user_profile_update_success = $this->User_model->update_user_assigned_profile($user_id, $new_profile_id);

            // 4. Actualizar los permisos del perfil seleccionado
            $profile_permissions_update_success = true;
            if (is_array($permissions_data) && !empty($permissions_data)) {
                foreach ($permissions_data as $key => $value) {
                    $permissions_data[$key] = (int)$value;
                }
                $profile_permissions_update_success = $this->User_model->update_profile_permissions($new_profile_id, $permissions_data);
            }

            // Verificar el estado de todas las operaciones
            if ($this->db->trans_status() === FALSE || !$user_details_update_success || !$user_profile_update_success || !$profile_permissions_update_success) {
                $this->db->trans_rollback();
                echo json_encode(array('success' => false, 'message' => 'Error al actualizar el usuario, su perfil o sus permisos. Operación revertida.'));
            } else {
                $this->db->trans_commit();
                echo json_encode(array('success' => true, 'message' => 'Usuario, perfil y permisos actualizados correctamente.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Datos incompletos para la actualización.'));
        }
    }


    public function get_filtered_users()
    {
        $offset = $this->input->post('offset') ?: 0;
        $nombre_usuario_filter = $this->input->post('nombre_usuario') ?: '';
        $cedula_filter = $this->input->post('cedula') ?: '';
        $organo_ente_filter = $this->input->post('organo_ente') ?: '';

        $filters = [];
        if ($nombre_usuario_filter !== '') {
            $filters['nombre_usuario'] = $nombre_usuario_filter;
        }
        if ($cedula_filter !== '') {
            $filters['cedula'] = $cedula_filter;
        }
        if ($organo_ente_filter !== '') {
            $filters['organo_ente'] = $organo_ente_filter;
        }

        $users = $this->User_model->get_users_paginated($this->per_page, $offset, $filters);
        $total_filtered_users = $this->User_model->count_all_users($filters);

        echo json_encode(array(
            'success' => true,
            'users' => $users,
            'count' => count($users),
            'total_filtered' => $total_filtered_users
        ));
    }

    public function update_user_status_ajax()
    {
        $user_id = $this->input->post('user_id');
        $new_status_val = $this->input->post('new_status_val'); // 1 para activar, 4 para desactivar

        $status_data = [];
        if ($new_status_val == 1) { // Activar usuario
            $status_data = array(
                'id_estatus' => 1,
                'intentos'   => 0,
                'password' => '$2y$10$T3rwxYhqdCJxft4p32W4J.KLZpOZViLs38JH2NuHGH9zBvuPExiPC', // cave generica
            );
        } elseif ($new_status_val == 4) { // Desactivar usuario
            $status_data = array(
                'id_estatus' => 4,
                'intentos'   => 3, // Reiniciar intentos a 3 cuando se desactiva,
                'password' => '$2y$10$T3rwxYhqdCJxft4p32W4J.KLZpOZViLs38JH2NuHGH9zBvuPExi8C', // cave generica
            );
        } else {
            echo json_encode(array('success' => false, 'message' => 'Valor de estado inválido.'));
            return;
        }

        if ($user_id && !empty($status_data)) {
            $update_success = $this->User_model->update_user_status($user_id, $status_data);

            if ($update_success) {
                echo json_encode(array('success' => true, 'message' => 'Estado del usuario actualizado correctamente.'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Error al actualizar el estado del usuario en la base de datos.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'ID de usuario o datos de estado incompletos.'));
        }
    }

    public function assign_profile_and_permissions()
    {
        $user_id = $this->input->post('user_id');
        $permissions_data = $this->input->post('permissions');

        if ($user_id && is_array($permissions_data)) {
            $this->db->trans_start(); // Iniciar transacción

            // 1. Obtener el nombre del usuario
            $user_data = $this->User_model->get_user_by_id($user_id);
            if (!$user_data) {
                $this->db->trans_rollback();
                echo json_encode(array('success' => false, 'message' => 'Usuario no encontrado.'));
                return;
            }

            // 2. Insertar un nuevo perfil con el ID del usuario
            $profile_name = "Perfil Usuario {$user_id} - {$user_data->nombre}";
            $profile_data = array_merge($permissions_data, ['nombrep' => $profile_name, 'id_perfil' => $user_id]);
            $profile_insert_success = $this->User_model->insert_new_profile($profile_data);

            if (!$profile_insert_success) {
                $this->db->trans_rollback();
                echo json_encode(array('success' => false, 'message' => 'Error al crear el nuevo perfil.'));
                return;
            }

            // 3. Actualizar la tabla de usuarios con el nuevo ID de perfil
            $user_update_success = $this->User_model->update_user_assigned_profile($user_id, $user_id);

            if ($this->db->trans_status() === FALSE || !$user_update_success) {
                $this->db->trans_rollback();
                echo json_encode(array('success' => false, 'message' => 'Error al actualizar el usuario. Operación revertida.'));
            } else {
                $this->db->trans_commit();
                echo json_encode(array('success' => true, 'message' => 'Permisos y perfil asignados correctamente.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Datos incompletos para la asignación.'));
        }
    }
}
