// assets/js/profile_edit.js

$(document).ready(function() {

    // --- Variables de Estado de Paginación y Filtros ---
    let currentOffset = 0;
    const usersPerPage = typeof window.usersPerPage !== 'undefined' ? window.usersPerPage : 10;
    let totalUsersCount = typeof window.totalUsersCount !== 'undefined' ? window.totalUsersCount : 0;
    
    let isLoading = false;

    let currentFilterUserName = '';
    let currentFilterCedula = ''; 
    let currentFilterOrganoEnte = '';

    const PERMISSION_FIELDS = [
        'menu_rnce', 'menu_progr', 'menu_eval_desem', 'menu_reg_eval_desem',
        'menu_soli_anular_eval_desem', 'menu_proc_anular_eval_desem',
        'menu_comprobante_eval_desem', 'menu_estdi_eval_desem',
        'menu_noregi_eval_desem', 'menu_llamado', 'consultar_llamado',
        'reg_llamado', 'anul_llamado', 'ver_anul_llamado', 'ver_rnc',
        'ver_conf', 'ver_parametro', 'ver_conf_publ', 'ver_user',
        'ver_user_exter', 'ver_user_desb', 'ver_user_lista', 'ver_user_perfil',
        'menu_anulacion', 'menu_repor_evalu',  'pdvsa', 'accion_llamado', 'menu_comisiones',
        'comisiones_interna_mieb', 'comisiones_interna_certifi',
        'notif_comisi_externa_mib', 'certi_miemb_externo',
        'consulta_snc_certi_mb', 'consultas_exter_miembros',
        'consultas_exter_mb_certificado', 'registrar_prog_anual',
        'modi_prog_anual_ley', 'reg_rend_anual', 'consul_prog_anual',
        'consul_mod_ley_anual', 'consultar_rendi_anual', 'invest_contratista',
        'ver_avanzado', 'avanz_rnce', 'avanz_rnc', 'avanz_gne', 'resultados_avza',
        'menu_certi', 'certificacion', 'certi_externo',
    ];

    // --- Funciones del Modal (expuestas globalmente) ---
    window.openModal = function() { document.getElementById('editProfileModal').style.display = 'block'; }
    window.closeModal = function() { document.getElementById('editProfileModal').style.display = 'none'; }
    document.querySelector('.close-button').addEventListener('click', closeModal);
    window.onclick = function(event) { if (event.target == document.getElementById('editProfileModal')) { closeModal(); } };

    // --- Funciones Auxiliares ---
    function formatPermissionName(fieldName) {
         
        if (fieldName === 'certi_externo') {
            return 'Certificación Facilitadores Externo CCP';  
        }
         if (fieldName === 'certificacion') {
            return 'Diplomado CCP';  
        }
         if (fieldName === 'menu_certi') {
            return 'Menú Certificación Facilitadores CCP';  
        }
        if (fieldName === 'consultas_certificado_exter_mb') {
            return 'Consultas Miembros Externos Certificados'; 
        }
        if (fieldName === 'registrar_programa_anual') {
            return 'Registrar Programación Anual'; 
        }
        // ... (puedes seguir añadiendo más condiciones para otros campos si lo deseas) ...


        // Si no es un campo con un nombre personalizado, aplica el formato general:
        // Reemplaza guiones bajos por espacios y capitaliza la primera letra de cada palabra.
        return fieldName
            .replace(/_/g, ' ')
            .replace(/\b\w/g, char => char.toUpperCase());
    }

    function renderPermissions(permissions) {
        const permissionsGrid = $('#permissionsGrid');
        permissionsGrid.empty();
        PERMISSION_FIELDS.forEach(field => {
            const isChecked = permissions[field] == 1; 
            const formattedName = formatPermissionName(field);
            const permissionHtml = `
                <div class="permission-item">
                    <label for="${field}">${formattedName}:</label>
                    <label class="switch">
                        <input type="checkbox" id="${field}" name="permissions[${field}]" value="1" ${isChecked ? 'checked' : ''}>
                        <span class="slider"></span>
                    </label>
                </div>
            `;
            permissionsGrid.append(permissionHtml);
        });
    }

    // --- Funciones de Paginación y Filtrado ---

    function updateLoadMoreButtonState() {
        if (currentOffset >= totalUsersCount) {
            $('#loadMoreUsersBtn').prop('disabled', true).text('No hay más usuarios');
        } else {
            $('#loadMoreUsersBtn').prop('disabled', false).text('Cargar Más Usuarios');
        }
    }

    // Modificada para mostrar la cédula y añadir el toggle de estado
    function addUsersToTable(users) {
        const tableBody = $('#userTableBody');
        if (users.length === 0 && currentOffset === 0) {
            tableBody.html('<tr><td colspan="7" style="text-align: center;">No hay usuarios registrados que coincidan con los criterios.</td></tr>');
        } else {
            if (tableBody.find('td[colspan="7"]').text() === 'Cargando usuarios...') {
                tableBody.empty();
            }
            users.forEach(user => {
                // Lógica de visualización de cédula:
                let fullCedula = 'N/A';
                if (user.cedula_funcionario) { 
                    if (user.tipo_cedula) { 
                        fullCedula = `${user.tipo_cedula}-${user.cedula_funcionario}`;
                    } else { 
                        fullCedula = user.cedula_funcionario;
                    }
                }

                // Determina si el usuario está activo (id_estatus = 1). Tu modelo ya debería traer este campo.
                const isActive = (user.id_estatus == 1);
                // Añade la clase 'slider-danger' si está inactivo para que el CSS lo pinte de rojo.
                const sliderClass = isActive ? '' : 'slider-danger';

                const row = `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.nombre}</td>
                        <td>${fullCedula}</td> 
                        <td>${user.perfil_nombre}</td>
                        <td>${user.organoente_descripcion ? user.organoente_descripcion : 'N/A'}</td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" class="status-toggle" 
                                    data-user-id="${user.id}" 
                                    ${isActive ? 'checked' : ''}>
                                <span class="slider ${sliderClass}"></span>
                            </label>
                        </td>
                        <td>
                            <button class="edit-profile-btn" data-user-id="${user.id}">Editar</button>
                        </td>
                    </tr>
                `;
                tableBody.append(row);
            });
        }
    }

    function loadUsers(append = true) {
        if (isLoading) return;
        isLoading = true;
        
        $('#loadMoreUsersBtn').prop('disabled', true).text('Cargando...');
        if (!append) {
            $('#userTableBody').html('<tr><td colspan="7" style="text-align: center;">Cargando usuarios...</td></tr>');
        }

        const dataToSend = {
            offset: currentOffset,
            nombre_usuario: currentFilterUserName,
            cedula: currentFilterCedula,
            organo_ente: currentFilterOrganoEnte
        };

        // const getFilteredUsersUrl = window.location.origin + '/asnc/index.php/Profile_controller/get_filtered_users';
                var getFilteredUsersUrl = '/index.php/Profile_controller/get_filtered_users';


        $.ajax({
            url: getFilteredUsersUrl,
            method: 'POST',
            data: dataToSend,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    if (!append) {
                        $('#userTableBody').empty();
                    }
                    addUsersToTable(response.users);
                    currentOffset += response.count;
                    totalUsersCount = response.total_filtered;
                    updateLoadMoreButtonState();
                } else {
                    Swal.fire('Error', response.message, 'error');
                    $('#loadMoreUsersBtn').prop('disabled', false).text('Error al cargar');
                    if ($('#userTableBody').is(':empty')) {
                        $('#userTableBody').html('<tr><td colspan="7" style="text-align: center;">Error al cargar usuarios. Intente recargar la página.</td></tr>');
                    }
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error de Conexión', 'No se pudieron cargar los usuarios. Por favor, intente de nuevo.', 'error');
                console.error("AJAX error: ", status, error, xhr.responseText);
                $('#loadMoreUsersBtn').prop('disabled', false).text('Reintentar Cargar');
                if ($('#userTableBody').is(':empty')) {
                    $('#userTableBody').html('<tr><td colspan="7" style="text-align: center;">Error de conexión. No se pudieron cargar usuarios.</td></tr>');
                }
            },
            complete: function() {
                isLoading = false;
            }
        });
    }

    // --- Event Listeners para la Interfaz Principal ---

    $('#loadMoreUsersBtn').on('click', function() {
        loadUsers(true);
    });

    $('#applyFiltersBtn').on('click', function() {
        currentFilterUserName = $('#filterUserName').val().trim();
        currentFilterCedula = $('#filterCedula').val().trim();
        currentFilterOrganoEnte = $('#filterOrganoEnte').val().trim();
        currentOffset = 0;
        loadUsers(false);
    });

    $('#clearFiltersBtn').on('click', function() {
        $('#filterUserName').val('');
        $('#filterCedula').val('');
        $('#filterOrganoEnte').val('');
        currentFilterUserName = '';
        currentFilterCedula = '';
        currentFilterOrganoEnte = '';
        currentOffset = 0;
        loadUsers(false);
    });

    // --- NUEVO Evento para el Toggle de Estado ---
    // Usamos delegación de eventos en 'body' porque los toggles se añaden dinámicamente.
    $('body').on('change', '.status-toggle', function() {
        const userId = $(this).data('user-id'); // Obtiene el ID del usuario del atributo data-user-id.
        const isChecked = $(this).is(':checked'); // true si el switch está "prendido" (activo), false si está "apagado" (inactivo).
        const newStatusVal = isChecked ? 1 : 4; // Determina el nuevo valor de id_estatus (1 para activo, 4 para inactivo).

        const statusText = isChecked ? 'activar' : 'Inhabilitar'; // Texto para el mensaje de SweetAlert.
        const confirmText = `¿Está seguro de ${statusText} al usuario ID ${userId}?`;
        const successMessage = isChecked ? 'Usuario activado correctamente.' : 'Usuario Inhabilitar correctamente.';
        const errorMessage = `Error al ${statusText} el usuario.`;

        // Guarda una referencia al 'this' (el checkbox) para usarlo dentro de las callbacks de SweetAlert y AJAX.
        const $thisToggle = $(this); 
        const $sliderSpan = $thisToggle.next('.slider'); // Referencia al slider visual para cambiar su color.

        Swal.fire({
            title: 'Confirmar Acción',
            text: confirmText,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) { // Si el usuario confirma la acción.
                // const updateStatusUrl = window.location.origin + '/asnc/index.php/Profile_controller/update_user_status_ajax';
                var updateStatusUrl = '/index.php/Profile_controller/update_user_status_ajax';

                $.ajax({
                    url: updateStatusUrl,
                    method: 'POST',
                    data: {
                        user_id: userId,
                        new_status_val: newStatusVal
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Éxito', successMessage, 'success');
                            // Actualizar visualmente el color del slider:
                            if (newStatusVal == 1) { // Si se activó
                                $sliderSpan.removeClass('slider-danger'); // Quita la clase roja.
                            } else { // Si se desactivó
                                $sliderSpan.addClass('slider-danger'); // Añade la clase roja.
                            }
                            // Opcional: Podrías recargar la tabla aquí para asegurar consistencia, pero afectaría el UX.
                            // currentOffset = 0;
                            // loadUsers(false); 
                        } else {
                            Swal.fire('Error', errorMessage + ' ' + response.message, 'error');
                            // Revertir el estado del toggle en la UI si la actualización falló en el servidor.
                            $thisToggle.prop('checked', !isChecked);
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error de Conexión', 'No se pudo contactar al servidor para actualizar el estado.', 'error');
                        console.error("AJAX error: ", status, error, xhr.responseText);
                        // Revertir el estado del toggle en la UI si hubo un error de conexión.
                        $thisToggle.prop('checked', !isChecked);
                    }
                });
            } else {
                // Si el usuario cancela la confirmación, revertir el estado del toggle en la UI.
                $thisToggle.prop('checked', !isChecked);
            }
        });
    });

    // --- Eventos para el Modal de Edición (Rellenado de campos) ---

    $('body').on('click', '.edit-profile-btn', function() {
        const userId = $(this).data('user-id');
        $('#editUserId').val(userId);

        // const getUserDataUrl = window.location.origin + '/asnc/index.php/Profile_controller/get_user_data_for_edit';
                var getUserDataUrl = '/index.php/Profile_controller/get_user_data_for_edit';


        $.ajax({
            url: getUserDataUrl,
            method: 'POST',
            data: { user_id: userId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const user = response.user;
                    const allProfiles = response.all_profiles;
                    const currentProfilePermissions = response.current_profile_permissions;

                    // Campos de seguridad.usuarios
                    $('#userName').val(user.nombre);
                    $('#userEmail').val(user.email);

                    // Campos de seguridad.funcionarios (Asegúrate de que 'nombrefun' esté bien!)
                    $('#usernombrefun').val(user.nombrefun || ''); // Este es el campo que te preocupaba
                    $('#userApellido').val(user.apellido || '');
                    $('#userCedulaTipo').val(user.tipo_cedula || 'V'); 
                    $('#userCedulaNum').val(user.cedula || ''); // Usar cedula_funcionario del modelo
                    $('#userCargo').val(user.cargo || '');
                    $('#userOficina').val(user.oficina || '');
                    $('#userTele1').val(user.tele_1 || '');

                    const profileSelect = $('#profileSelect');
                    profileSelect.empty();
                    allProfiles.forEach(profile => {
                        const selected = (profile.id_perfil == user.perfil) ? 'selected' : '';
                        profileSelect.append(`<option value="${profile.id_perfil}" ${selected}>${profile.nombrep}</option>`);
                    });

                    renderPermissions(currentProfilePermissions);
                    openModal();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error de Conexión', 'No se pudo cargar la información del usuario.', 'error');
                console.error("AJAX error: ", status, error, xhr.responseText);
            }
        });
    });

    // Evento 'change' para el dropdown de perfil en el modal (sin cambios)
    $('#profileSelect').on('change', function() {
        const selectedProfileId = $(this).val();
        if (selectedProfileId) {
            // const getPermissionsUrl = window.location.origin + '/asnc/index.php/Profile_controller/get_permissions_for_profile';
                var getPermissionsUrl = '/index.php/Profile_controller/get_permissions_for_profile';

            
            $.ajax({
                url: getPermissionsUrl,
                method: 'POST',
                data: { profile_id: selectedProfileId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        renderPermissions(response.permissions);
                    } else {
                        Swal.fire('Error', 'No se pudieron cargar los permisos del perfil seleccionado.', 'error');
                        $('#permissionsGrid').empty();
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error de Conexión', 'No se pudo cargar los permisos del perfil.', 'error');
                    console.error("AJAX error: ", status, error, xhr.responseText);
                }
            });
        } else {
            $('#permissionsGrid').empty();
        }
    });

    // Evento 'submit' del formulario de edición de perfil dentro del modal.
    $('#profileEditForm').on('submit', function(e) {
        e.preventDefault();

        const userId = $('#editUserId').val();
        const newProfileId = $('#profileSelect').val();
        
        const permissionsData = {};
        $('#permissionsGrid input[type="checkbox"]').each(function() {
            const nameAttr = $(this).attr('name');
            const fieldName = nameAttr.substring(nameAttr.indexOf('[') + 1, nameAttr.indexOf(']'));
            permissionsData[fieldName] = $(this).is(':checked') ? 1 : 0;
        });

        // Recolectar los nuevos datos editables del usuario
        const newUserData = {
            new_nombre: $('#userName').val().trim(),
            new_nombrefun: $('#usernombrefun').val().trim(), // ¡Este campo está aquí!
            new_apellido: $('#userApellido').val().trim(),
            new_cedula_tipo: $('#userCedulaTipo').val(),
            new_cedula_num: $('#userCedulaNum').val().trim(),
            new_email: $('#userEmail').val().trim(),
            new_cargo: $('#userCargo').val().trim(),
            new_oficina: $('#userOficina').val().trim(),
            new_tele_1: $('#userTele1').val().trim()
        };

        Swal.fire({
            title: '¿Confirmar cambios?',
            text: '¿Está seguro de guardar las modificaciones en el usuario, su perfil y permisos?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.value) {
                // const updateProfileUrl = window.location.origin + '/asnc/index.php/Profile_controller/update_user_and_profile';
                var updateProfileUrl = '/index.php/Profile_controller/update_user_and_profile';


                const dataToSend = {
                    user_id: userId,
                    new_profile_id: newProfileId,
                    permissions: permissionsData,
                    ...newUserData // Añadir todos los campos de usuario/funcionario aquí
                };

                $.ajax({
                    url: updateProfileUrl,
                    method: 'POST',
                    data: dataToSend,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Éxito', response.message, 'success').then(() => {
                                closeModal();
                                currentOffset = 0;
                                loadUsers(false); // Recarga la tabla para mostrar los cambios
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error de Conexión', 'No se pudieron guardar los cambios. Por favor, intente de nuevo.', 'error');
                        console.error("AJAX error: ", status, error, xhr.responseText);
                    }
                });
            }
        });
    });

    // --- Inicialización: Carga los usuarios iniciales al cargar la página ---
    loadUsers(false); 

});