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

    // --- Funciones de Modales (Edición y Asignación) ---

    // Funciones del Modal de Edición (originales)
    window.openModal = function() { document.getElementById('editProfileModal').style.display = 'block'; }
    window.closeModal = function() { document.getElementById('editProfileModal').style.display = 'none'; }
    document.querySelector('#editProfileModal .close-button').addEventListener('click', closeModal);

    // NUEVAS Funciones del Modal de Asignación
    window.openAssignModal = function() { document.getElementById('assignPermissionsModal').style.display = 'block'; }
    window.closeAssignModal = function() { document.getElementById('assignPermissionsModal').style.display = 'none'; }
    document.querySelector('#assignPermissionsModal .close-button').addEventListener('click', closeAssignModal);
    
    // Controlador de clics para cerrar cualquier modal
    window.onclick = function(event) { 
        if (event.target == document.getElementById('editProfileModal')) { closeModal(); }
        if (event.target == document.getElementById('assignPermissionsModal')) { closeAssignModal(); }
    };

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
        if (fieldName === 'consultas_exter_mb_certificado') {
            return 'Consultas Miembros Externos Certificados'; 
        }
        if (fieldName === 'registrar_prog_anual') {
            return 'Registrar Programación Anual'; 
        }
        
        // Formato general
        return fieldName
            .replace(/_/g, ' ')
            .replace(/\b\w/g, char => char.toUpperCase());
    }

    // Modificada para ser genérica y usarse en ambos modales
    function renderPermissions(permissions, containerId) {
        const permissionsGrid = $(`#${containerId}`);
        permissionsGrid.empty();
        PERMISSION_FIELDS.forEach(field => {
            const isChecked = permissions[field] == 1; 
            const formattedName = formatPermissionName(field);
            const permissionHtml = `
                <div class="permission-item">
                    <label for="${containerId}-${field}">${formattedName}:</label>
                    <label class="switch">
                        <input type="checkbox" id="${containerId}-${field}" name="permissions[${field}]" value="1" ${isChecked ? 'checked' : ''}>
                        <span class="slider"></span>
                    </label>
                </div>
            `;
            permissionsGrid.append(permissionHtml);
        });
    }

    // --- Funciones de Paginación y Filtrado (Modificada) ---

    function updateLoadMoreButtonState() {
        if (currentOffset >= totalUsersCount) {
            $('#loadMoreUsersBtn').prop('disabled', true).text('No hay más usuarios');
        } else {
            $('#loadMoreUsersBtn').prop('disabled', false).text('Cargar Más Usuarios');
        }
    }

    // Modificada para añadir el botón de "Asignar Permisos"
    function addUsersToTable(users) {
        const tableBody = $('#userTableBody');
        if (users.length === 0 && currentOffset === 0) {
            tableBody.html('<tr><td colspan="7" style="text-align: center;">No hay usuarios registrados que coincidan con los criterios.</td></tr>');
        } else {
            if (tableBody.find('td[colspan="7"]').text() === 'Cargando usuarios...') {
                tableBody.empty();
            }
            users.forEach(user => {
                let fullCedula = 'N/A';
                if (user.cedula_funcionario) { 
                    if (user.tipo_cedula) { 
                        fullCedula = `${user.tipo_cedula}-${user.cedula_funcionario}`;
                    } else { 
                        fullCedula = user.cedula_funcionario;
                    }
                }

                const isActive = (user.id_estatus == 1);
                const sliderClass = isActive ? '' : 'slider-danger';
                
                // Lógica para mostrar el botón correcto
                let actionsHtml = '';
                if (user.perfil_id == 0) {
                    actionsHtml = `<button class="assign-permissions-btn" data-user-id="${user.id}">Asignar Permisos</button>`;
                } else {
                    actionsHtml = `<button class="edit-profile-btn" data-user-id="${user.id}">Editar</button>`;
                }

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
                            ${actionsHtml}
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

    // Evento para el Toggle de Estado
    $('body').on('change', '.status-toggle', function() {
        const userId = $(this).data('user-id'); 
        const isChecked = $(this).is(':checked');
        const newStatusVal = isChecked ? 1 : 4; 

        const statusText = isChecked ? 'activar' : 'Inhabilitar'; 
        const confirmText = `¿Está seguro de ${statusText} al usuario ID ${userId}?`;
        const successMessage = isChecked ? 'Usuario activado correctamente.' : 'Usuario Inhabilitar correctamente.';
        const errorMessage = `Error al ${statusText} el usuario.`;

        const $thisToggle = $(this); 
        const $sliderSpan = $thisToggle.next('.slider'); 

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
            if (result.value) { 
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
                            if (newStatusVal == 1) { 
                                $sliderSpan.removeClass('slider-danger'); 
                            } else { 
                                $sliderSpan.addClass('slider-danger'); 
                            }
                        } else {
                            Swal.fire('Error', errorMessage + ' ' + response.message, 'error');
                            $thisToggle.prop('checked', !isChecked);
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error de Conexión', 'No se pudo contactar al servidor para actualizar el estado.', 'error');
                        console.error("AJAX error: ", status, error, xhr.responseText);
                        $thisToggle.prop('checked', !isChecked);
                    }
                });
            } else {
                $thisToggle.prop('checked', !isChecked);
            }
        });
    });

    // --- NUEVOS Eventos para el Botón y Modal de Asignación de Permisos ---

    // Evento click en el botón "Asignar Permisos"
    $('body').on('click', '.assign-permissions-btn', function() {
        const userId = $(this).data('user-id');
        const userName = $(this).closest('tr').find('td:nth-child(2)').text();
        
        $('#assignUserId').val(userId);
        $('#assignUserName').val(userName);

        const defaultPermissions = {}; // Un objeto vacío para que todos los checkboxes estén desmarcados
        renderPermissions(defaultPermissions, 'assignPermissionsGrid');
        
        openAssignModal();
    });

    // Evento submit del formulario de ASIGNACIÓN de permisos
    $('#assignPermissionsForm').on('submit', function(e) {
        e.preventDefault();

        const userId = $('#assignUserId').val();
        
        const permissionsData = {};
        $('#assignPermissionsGrid input[type="checkbox"]').each(function() {
            const nameAttr = $(this).attr('name');
            const fieldName = nameAttr.substring(nameAttr.indexOf('[') + 1, nameAttr.indexOf(']'));
            permissionsData[fieldName] = $(this).is(':checked') ? 1 : 0;
        });

        Swal.fire({
            title: '¿Confirmar asignación?',
            text: 'Se creará un nuevo perfil y se le asignarán los permisos seleccionados.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, asignar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.value) {
                var assignProfileUrl = '/index.php/Profile_controller/assign_profile_and_permissions';

                const dataToSend = {
                    user_id: userId,
                    permissions: permissionsData
                };

                $.ajax({
                    url: assignProfileUrl,
                    method: 'POST',
                    data: dataToSend,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Éxito', response.message, 'success').then(() => {
                                closeAssignModal();
                                currentOffset = 0;
                                loadUsers(false); // Recarga la tabla para mostrar el cambio
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error de Conexión', 'No se pudieron asignar los permisos. Por favor, intente de nuevo.', 'error');
                        console.error("AJAX error: ", status, error, xhr.responseText);
                    }
                });
            }
        });
    });

    // --- Eventos para el Modal de Edición Existente ---

    $('body').on('click', '.edit-profile-btn', function() {
        const userId = $(this).data('user-id');
        $('#editUserId').val(userId);
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

                    $('#userName').val(user.nombre);
                    $('#userEmail').val(user.email);
                    $('#usernombrefun').val(user.nombrefun || '');
                    $('#userApellido').val(user.apellido || '');
                    $('#userCedulaTipo').val(user.tipo_cedula || 'V'); 
                    $('#userCedulaNum').val(user.cedula || '');
                    $('#userCargo').val(user.cargo || '');
                    $('#userOficina').val(user.oficina || '');
                    $('#userTele1').val(user.tele_1 || '');

                    const profileSelect = $('#profileSelect');
                    profileSelect.empty();
                    allProfiles.forEach(profile => {
                        const selected = (profile.id_perfil == user.perfil) ? 'selected' : '';
                        profileSelect.append(`<option value="${profile.id_perfil}" ${selected}>${profile.nombrep}</option>`);
                    });

                    renderPermissions(currentProfilePermissions, 'permissionsGrid');
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

    $('#profileSelect').on('change', function() {
        const selectedProfileId = $(this).val();
        if (selectedProfileId) {
                var getPermissionsUrl = '/index.php/Profile_controller/get_permissions_for_profile';
            
            $.ajax({
                url: getPermissionsUrl,
                method: 'POST',
                data: { profile_id: selectedProfileId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        renderPermissions(response.permissions, 'permissionsGrid');
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

        const newUserData = {
            new_nombre: $('#userName').val().trim(),
            new_nombrefun: $('#usernombrefun').val().trim(), 
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
                var updateProfileUrl = '/index.php/Profile_controller/update_user_and_profile';

                const dataToSend = {
                    user_id: userId,
                    new_profile_id: newProfileId,
                    permissions: permissionsData,
                    ...newUserData
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
                                loadUsers(false);
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
