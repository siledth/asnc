 
// Este código se ejecutará una vez que el DOM (Document Object Model) esté completamente cargado.
// Es una buena práctica envolver tu código jQuery en $(document).ready()
// para asegurar que todos los elementos HTML estén disponibles antes de que tu script intente interactuar con ellos.
$(document).ready(function() {

    // Array de nombres de campos de permisos de la tabla seguridad.perfil.
    // ¡IMPORTANTE!: Esta lista debe coincidir EXACTAMENTE con los nombres de tus columnas de permisos
    // en la tabla 'seguridad.perfil' que contienen valores 0 o 1.
    // Excluye columnas como 'id_perfil', 'nombrep', 'fecha_creacion' o cualquier otra que no sea un permiso 0/1.
    const PERMISSION_FIELDS = [
        'menu_rnce', 'menu_progr', 'menu_eval_desem', 'menu_reg_eval_desem',
        'menu_soli_anular_eval_desem', 'menu_proc_anular_eval_desem',
        'menu_comprobante_eval_desem', 'menu_estdi_eval_desem',
        'menu_noregi_eval_desem', 'menu_llamado', 'consultar_llamado',
        'reg_llamado', 'anul_llamado', 'ver_anul_llamado', 'ver_rnc',
        'ver_conf', 'ver_parametro', 'ver_conf_publ', 'ver_user',
        'ver_user_exter', 'ver_user_desb', 'ver_user_lista', 'ver_user_perfil',
        'menu_anulacion', 'menu_repor_evalu', 'certi_externo', 'menu_certi',
        'certificacion', 'pdvsa', 'accion_llamado', 'menu_comisiones',
        'comisiones_interna_mieb', 'comisiones_interna_certifi',
        'notif_comisi_externa_mib', 'certi_miemb_externo',
        'consulta_snc_certi_mb', 'consultas_exter_miembros',
        'consultas_exter_mb_certificado', 'registrar_prog_anual',
        'modi_prog_anual_ley', 'reg_rend_anual', 'consul_prog_anual',
        'consul_mod_ley_anual', 'consultar_rendi_anual', 'invest_contratista',
        'ver_avanzado', 'avanz_rnce', 'avanz_rnc', 'avanz_gne', 'resultados_avza'
    ];

    // --- Funciones del Modal (expuestas globalmente para que el HTML pueda llamarlas) ---

    // Abre el modal haciendo visible el elemento con id 'editProfileModal'.
    window.openModal = function() {
        document.getElementById('editProfileModal').style.display = 'block';
    }

    // Cierra el modal ocultando el elemento con id 'editProfileModal'.
    window.closeModal = function() {
        document.getElementById('editProfileModal').style.display = 'none';
    }

    // Asocia la función closeModal al clic en el botón de cerrar (la 'x') del modal.
    document.querySelector('.close-button').addEventListener('click', closeModal);

    // Cierra el modal si el usuario hace clic fuera del área del contenido del modal.
    // Esto mejora la usabilidad del modal.
    window.onclick = function(event) {
        if (event.target == document.getElementById('editProfileModal')) {
            closeModal();
        }
    };

    // --- Funciones Auxiliares ---

    // Formatea un nombre de campo de base de datos (ej. 'menu_rnce') a un formato legible (ej. 'Menú Rnce').
    function formatPermissionName(fieldName) {
        return fieldName
            .replace(/_/g, ' ') // Reemplaza guiones bajos por espacios.
            .replace(/\b\w/g, char => char.toUpperCase()); // Capitaliza la primera letra de cada palabra.
    }

    // Renderiza la cuadrícula de permisos en el modal con los checkboxes/switches.
    function renderPermissions(permissions) {
        const permissionsGrid = $('#permissionsGrid');
        permissionsGrid.empty(); // Limpia cualquier permiso que se haya mostrado previamente.

        // Itera sobre la lista predefinida de campos de permisos.
        PERMISSION_FIELDS.forEach(field => {
            // Determina si el checkbox debe estar marcado. Un valor de 1 en la BD significa 'true'.
            const isChecked = permissions[field] == 1; 
            // Obtiene el nombre formateado para mostrar al usuario.
            const formattedName = formatPermissionName(field);

            // Construye el HTML para cada permiso, incluyendo un label, un switch (checkbox oculto + slider visual).
            const permissionHtml = `
                <div class="permission-item">
                    <label for="${field}">${formattedName}:</label>
                    <label class="switch">
                        <input type="checkbox" id="${field}" name="permissions[${field}]" value="1" ${isChecked ? 'checked' : ''}>
                        <span class="slider"></span>
                    </label>
                </div>
            `;
            permissionsGrid.append(permissionHtml); // Añade el HTML al contenedor de permisos.
        });
    }

    // --- Eventos ---

    // Evento click para los botones "Editar Perfil" en la tabla de usuarios.
    // Se usa delegación de eventos en 'body' para que funcione incluso si los botones son añadidos dinámicamente
    // o si el DOM cambia después de la carga inicial.
    $('body').on('click', '.edit-profile-btn', function() {
        const userId = $(this).data('user-id'); // Obtiene el ID del usuario del atributo 'data-user-id' del botón.
        $('#editUserId').val(userId); // Establece este ID en un campo oculto dentro del formulario del modal.
            //   var base_url = window.location.origin + '/asnc/index.php/Profile_controller/get_user_data_for_edit';
					var base_url = '/index.php/Profile_controller/get_user_data_for_edit';


        // Realiza una petición AJAX al controlador para obtener los datos del usuario y la lista de todos los perfiles.
        $.ajax({
            // 'site_url()' es una función PHP, que se inserta aquí directamente para generar la URL correcta.
            url: base_url,
            method: 'POST', // Método HTTP POST para enviar el ID del usuario.
            data: { user_id: userId }, // Datos a enviar: el ID del usuario.
            dataType: 'json', // Espera que la respuesta del servidor sea en formato JSON.
            success: function(response) {
                // Esta función se ejecuta si la petición AJAX se completó con éxito (el servidor respondió).
                if (response.success) {
                    const user = response.user;
                    const allProfiles = response.all_profiles;
                    const currentProfilePermissions = response.current_profile_permissions;

                    // Rellena los campos del modal con los detalles del usuario (nombre y email).
                    $('#userName').val(user.nombre);
                    $('#userEmail').val(user.email);

                    // Rellena el dropdown de selección de perfiles con todas las opciones disponibles.
                    const profileSelect = $('#profileSelect');
                    profileSelect.empty(); // Limpia cualquier opción que pudiera haber de una edición anterior.
                    allProfiles.forEach(profile => {
                        // Determina si esta opción de perfil es la que el usuario tiene actualmente asignada.
                        const selected = (profile.id_perfil == user.perfil) ? 'selected' : '';
                        // Añade la opción al dropdown.
                        profileSelect.append(`<option value="${profile.id_perfil}" ${selected}>${profile.nombrep}</option>`);
                    });

                    // Renderiza los permisos específicos del perfil actualmente asignado al usuario.
                    renderPermissions(currentProfilePermissions);

                    openModal(); // Una vez que todos los datos están cargados, abre el modal.
                } else {
                    // Si la respuesta del servidor indica un fallo (ej. usuario no encontrado), muestra una alerta.
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                // Esta función se ejecuta si la petición AJAX falló (ej. problema de red, error en el servidor).
                Swal.fire('Error de Conexión', 'No se pudo cargar la información del usuario. Por favor, intente de nuevo.', 'error');
                console.error("AJAX error: ", status, error, xhr.responseText); // Imprime el error en la consola del navegador para depuración.
            }
        });
    });

    // Evento 'change' para el dropdown de perfil en el modal.
    // Se activa cada vez que el usuario selecciona una opción diferente en el dropdown de perfiles.
    $('#profileSelect').on('change', function() {
        const selectedProfileId = $(this).val(); // Obtiene el ID del perfil que acaba de ser seleccionado.
        if (selectedProfileId) {
            // Realiza una petición AJAX para obtener solo los permisos del perfil recién seleccionado.
            //   var base_url = window.location.origin + '/asnc/index.php/Profile_controller/get_permissions_for_profile';
					var base_url = '/index.php/Profile_controller/get_permissions_for_profile';

            
            $.ajax({
                url: base_url,
                method: 'POST',
                data: { profile_id: selectedProfileId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Si la petición es exitosa, vuelve a renderizar los permisos con los del nuevo perfil.
                        renderPermissions(response.permissions);
                    } else {
                        // Si hay un error al cargar los permisos, muestra una alerta.
                        Swal.fire('Error', 'No se pudieron cargar los permisos del perfil seleccionado.', 'error');
                        $('#permissionsGrid').empty(); // Limpia la cuadrícula de permisos si hay un error.
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error de Conexión', 'No se pudo cargar los permisos del perfil. Por favor, intente de nuevo.', 'error');
                    console.error("AJAX error: ", status, error, xhr.responseText);
                }
            });
        } else {
            $('#permissionsGrid').empty(); // Si el dropdown se vacía o no hay selección, limpia la cuadrícula.
        }
    });

    // Evento 'submit' del formulario de edición de perfil dentro del modal.
    // Se activa cuando el usuario hace clic en el botón "Guardar Cambios".
    $('#profileEditForm').on('submit', function(e) {
        e.preventDefault(); // Previene el comportamiento por defecto del formulario (recargar la página).

        const userId = $('#editUserId').val(); // Obtiene el ID del usuario que se está editando.
        const newProfileId = $('#profileSelect').val(); // Obtiene el ID del nuevo perfil seleccionado para el usuario.
        
        // Recopila el estado (0 o 1) de todos los switches de permisos.
        // Itera sobre todos los checkboxes de permisos dentro de la cuadrícula.
        const permissionsData = {};
        $('#permissionsGrid input[type="checkbox"]').each(function() {
            // Extrae el nombre del campo de permiso del atributo 'name' (ej. 'permissions[menu_rnce]' -> 'menu_rnce').
            const nameAttr = $(this).attr('name');
            const fieldName = nameAttr.substring(nameAttr.indexOf('[') + 1, nameAttr.indexOf(']'));
            // Asigna 1 si el checkbox está marcado (activado), 0 si no lo está.
            permissionsData[fieldName] = $(this).is(':checked') ? 1 : 0;
        });

        // Muestra una confirmación final al usuario antes de enviar los datos para guardar.
        Swal.fire({
            title: '¿Confirmar cambios?',
            text: '¿Está seguro de guardar las modificaciones en el perfil del usuario y los permisos asociados a este perfil?',
            icon: 'question', // Icono de pregunta.
            showCancelButton: true, // Muestra el botón de cancelar.
            confirmButtonColor: '#3085d6', // Color del botón de confirmar.
            cancelButtonColor: '#d33', // Color del botón de cancelar.
            confirmButtonText: 'Sí, guardar', // Texto del botón de confirmar.
            cancelButtonText: 'No, cancelar' // Texto del botón de cancelar.
        }).then((result) => {
            if (result.value) { // Si el usuario confirma la acción.
                // Realiza la petición AJAX al controlador para actualizar el usuario y los permisos del perfil.
            //  var base_url = window.location.origin + '/asnc/index.php/Profile_controller/update_user_and_profile';
					var base_url = '/index.php/Profile_controller/update_user_and_profile';


                $.ajax({
                    url: base_url, // URL del controlador para la actualización.
                    method: 'POST', // Método HTTP POST.
                    data: {
                        user_id: userId,
                        new_profile_id: newProfileId,
                        permissions: permissionsData // Envía los permisos como un objeto. PHP lo recibirá como un array asociativo.
                    },
                    dataType: 'json', // Espera una respuesta JSON.
                    success: function(response) {
                        // Se ejecuta si la petición AJAX se completó con éxito (el servidor respondió).
                        if (response.success) {
                            // Muestra un mensaje de éxito y luego cierra el modal y recarga la página.
                            Swal.fire('Éxito', response.message, 'success').then(() => {
                                closeModal();
                                location.reload(); // Recarga la página para que los cambios se reflejen en la tabla.
                            });
                        } else {
                            // Muestra un mensaje de error si la actualización no fue exitosa.
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Se ejecuta si la petición AJAX falló (ej. problema de red, servidor no responde).
                        Swal.fire('Error de Conexión', 'No se pudieron guardar los cambios. Por favor, intente de nuevo.', 'error');
                        console.error("AJAX error: ", status, error, xhr.responseText); // Imprime el error en la consola para depuración.
                    }
                });
            }
        });
    });
});