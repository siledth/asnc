// function may(e){
// 	e.value = e.value.toUpperCase();
// }

// $(document).ready(function() {
//     console.log("Script user.js loaded and DOM Ready!");

//     // Initialize select2 if you're using it
//     // $('.default-select2').select2();

//     // --- Helper Functions ---

//     function capitalize(str) {
//         if (!str) return '';
//         return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
//     }

//     function generateUsernameOptions(firstName, lastName) {
//         let firstNames = firstName.split(' ').filter(n => n.trim() !== '');
//         let lastNames = lastName.split(' ').filter(a => a.trim() !== '');

//         if (firstNames.length === 0 || lastNames.length === 0) return [];

//         let options = [];
//         options.push(capitalize(firstNames[0].charAt(0).toLowerCase() + lastNames[0].toLowerCase()));
//         if (lastNames.length > 1 && lastNames[1].trim() !== '') {
//             options.push(capitalize(firstNames[0].charAt(0).toLowerCase() + lastNames[0].toLowerCase() + lastNames[1].charAt(0).toLowerCase()));
//         }
//         return options;
//     }

//     function loadOrganosEntes() {
//         // Your HTML already loads these from PHP. This is a placeholder
//         // if you decide to load them dynamically via AJAX.
//     }

//     // --- Username Generation and Validation Logic ---

//     $('#nombrefun, #apellido').on('blur', function() {
//         let firstName = $('#nombrefun').val().trim();
//         let lastName = $('#apellido').val().trim();
//         console.log("Blur on first name/last name. First Name:", firstName, "Last Name:", lastName);

//         if (firstName && lastName) {
//             let options = generateUsernameOptions(firstName, lastName);
//             console.log("Generated username options:", options);
//             if (options.length > 0) {
//                 checkUsernameAvailability(options, 0);
//             } else {
//                 $('#usuario').val('');
//                 $('#result-usuario').html('');
//                 $("#guardar_user").prop('disabled', true);
//             }
//         } else {
//             $('#usuario').val('');
//             $('#result-usuario').html('');
//             $("#guardar_user").prop('disabled', true);
//         }
//     });

//     function checkUsernameAvailability(options, index, counter = 1) {
//         $('#result-usuario').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        
//         if (index >= options.length) {
//             let lastOption = options[options.length - 1] + counter;
//             console.log("Trying option with counter:", lastOption);
//             verifyUsername(lastOption, function(available) {
//                 if (available) {
//                     $('#usuario').val(lastOption);
//                     $('#result-usuario').fadeIn(300).html(
//                         '<div class="alert alert-success"><strong>Success!</strong> Username available.</div>'
//                     ).css('opacity', '1');
//                     $("#guardar_user").prop('disabled', false);
//                 } else {
//                     checkUsernameAvailability(options, index, counter + 1);
//                 }
//             });
//             return;
//         }

//         console.log("Checking option:", options[index]);
//         verifyUsername(options[index], function(available) {
//             if (available) {
//                 $('#usuario').val(options[index]);
//                 $('#result-usuario').fadeIn(300).html(
//                     '<div class="alert alert-success"><strong>Success!</strong> usuario.</div>'
//                 ).css('opacity', '1');
//                 $("#guardar_user").prop('disabled', false);
//             } else {
//                 checkUsernameAvailability(options, index + 1);
//             }
//         });
//     }

//     function verifyUsername(username, callback) {
//         // var baseUrl = window.location.origin + '/asnc/index.php/User/validad_users';
//         var baseUrl = '/index.php/User/validad_users';
//         $.ajax({
//             type: "POST",
//             url: baseUrl,
//             data: { usuario: username },
//             success: function(data) { 
//                 console.log("Response verifyUsername:", data); 
//                 callback(data == 0);
//                 if (data != 0) { // If username is NOT available (data is 1)
//                     Swal.fire({
//                         title: 'Username Taken',
//                         text: 'The username "' + username + '" is already registered. Please try another one.',
//                         icon: 'info', // Use 'info' for less intrusive feedback
//                         toast: true, // Make it a small toast notification
//                         position: 'top-end', // Position it at the top right
//                         showConfirmButton: false, // Don't show a confirm button
//                         timer: 3000, // Automatically close after 3 seconds
//                         timerProgressBar: true
//                     });
//                 }
//             },
//             error: function() { 
//                 console.error("Error verifying username."); 
//                 Swal.fire('Connection Error', 'Could not verify username availability.', 'error'); 
//                 callback(false);
//             }
//         });
//     }

//     $('#usuario').on('blur', function() {
//         console.log("Blur on username field. Value:", $(this).val());
//         if ($(this).val().trim() === '') {
//             $('#result-usuario').html('');
//             $("#guardar_user").prop('disabled', true);
//             return;
//         }

//         let username = capitalize($(this).val());
//         $(this).val(username);

//         $('#result-usuario').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        
//         var dataString = 'usuario=' + username;
//         // var baseUrl = window.location.origin + '/asnc/index.php/User/validad_users';
//         var baseUrl = '/index.php/User/validad_users';


//         $.ajax({
//             type: "POST",
//             url: baseUrl,
//             data: dataString,
//             success: function(data) { 
//                 console.log("Response blur username:", data); 
//                 if (data == 0) { // Username available
//                     $('#result-usuario').fadeIn(300).html(
//                         '<div class="alert alert-success"><strong>Success!</strong> Username disponible.</div>'
//                     ).css('opacity', '1');
//                     $("#guardar_user").prop('disabled', false);
//                 } else { // Username taken
//                     $('#result-usuario').fadeIn(300).html(
//                         '<div class="alert alert-danger"><strong>Username Taken!</strong> Please enter another username.</div>'
//                     ).css('opacity', '1');
//                     $("#guardar_user").prop('disabled', true);
//                     Swal.fire({ // <--- IMMEDIATE SWEETALERT FOR USERNAME DUPLICATE
//                         title: 'Username Already Registered',
//                         text: 'The username "' + username + '" is already taken. Please choose a different one.',
//                         icon: 'warning',
//                         toast: true,
//                         position: 'top-end',
//                         showConfirmButton: false,
//                         timer: 4000,
//                         timerProgressBar: true
//                     });
//                 }
//             },
//             error: function() { 
//                 console.error("Error in blur username."); 
//                 Swal.fire('Connection Error', 'Could not verify username availability.', 'error'); 
//                 $("#guardar_user").prop('disabled', true);
//                 $('#result-usuario').html('');
//             }
//         });
//     });

//     // --- Email Validation Logic ---

//     window.validateEmail = function() { 
//         console.log("Validating email. Value:", $('#email').val());
//         let email = $('#email').val().trim();
//         if (email === '') {
//             $('#result-email').html('');
//             $("#guardar_user").prop('disabled', true);
//             return true;
//         }

//         $('#result-email').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        
//         var dataString = 'email=' + email;
//         // var baseUrl = window.location.origin + '/asnc/index.php/User/valida_correo';
//         var baseUrl = '/index.php/User/valida_correo';

//         $.ajax({
//             type: "POST",
//             url: baseUrl,
//             data: dataString,
//             success: function(data) { 
//                 console.log("Response validateEmail:", data); 
//                 if (data == 0) { // Email available
//                     $('#result-email').fadeIn(300).html(
//                         '<div class="alert alert-success"><strong>Success!</strong> correo disponible.</div>'
//                     ).css('opacity', '1');
//                     $("#guardar_user").prop('disabled', false);
//                 } else { // Email taken
//                     $('#result-email').fadeIn(300).html(
//                         '<div class="alert alert-danger"><strong>correo exite!</strong> por favor ingrese otro.</div>'
//                     ).css('opacity', '1');
//                     $("#guardar_user").prop('disabled', true);
//                     Swal.fire({ // <--- IMMEDIATE SWEETALERT FOR EMAIL DUPLICATE
//                         title: 'El correo ya existe',
//                         text: 'El correo  "' + email + '" ya esta registrado. Por favor ingrese uno diferente.',
//                         icon: 'warning',
//                         toast: true,
//                         position: 'top-end',
//                         showConfirmButton: false,
//                         timer: 4000,
//                         timerProgressBar: true
//                     });
//                 }
//             },
//             error: function() { 
//                 console.error("Error in validateEmail."); 
//                 Swal.fire(' Error', 'veriviga el correo.', 'error'); 
//                 $("#guardar_user").prop('disabled', true);
//                 $('#result-email').html('');
//             }
//         });
//         return true;
//     };

//     // --- Cedula Validation Logic ---

//     window.validateUsers = function() { 
//         console.log("Validating cedula. Value:", $('#cedula').val());
//         let cedulaVal = $('#cedula').val().trim();
//         if (cedulaVal === '') {
//             $('#result-cedula').html('');
//             $("#guardar_user").prop('disabled', true);
//             return;
//         }
        
//         $('#result-cedula').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
//         // var baseUrl = window.location.origin + '/asnc/index.php/User/valida_ced4';
//         var baseUrl = '/index.php/User/valida_ced4';


//         $.ajax({
//             type: "POST",
//             url: baseUrl,
//             data: { cedula: cedulaVal },
//             success: function(data) { 
//                 console.log("Response validateCedula:", data); 
//                 if (data == 0) { // Cedula available
//                     $('#result-cedula').fadeIn(300).html(
//                         '<div class="alert alert-success"><strong>Success!</strong> Cedula  dsiponible.</div>'
//                     ).css('opacity', '1');
//                     $("#guardar_user").prop('disabled', false);
//                 } else { // Cedula taken
//                     $('#result-cedula').fadeIn(300).html(
//                         '<div class="alert alert-danger"><strong>Cedula ya registradad!</strong> por favor revise o ingrese otra cedula.</div>'
//                     ).css('opacity', '1');
//                     $("#guardar_user").prop('disabled', true);
//                     Swal.fire({ // <--- IMMEDIATE SWEETALERT FOR CEDULA DUPLICATE
//                         title: 'cedula existe',
//                         text: 'la cedula "' + cedulaVal + '" esta registrada. por favor ingrese otra',
//                         icon: 'warning',
//                         toast: true,
//                         position: 'top-end',
//                         showConfirmButton: false,
//                         timer: 4000,
//                         timerProgressBar: true
//                     });
//                 }
//             },
//             error: function() { 
//                 console.error("Error in validateCedula."); 
//                 Swal.fire(' Error', 'verifia la cedula.', 'error'); 
//                 $("#guardar_user").prop('disabled', true);
//                 $('#result-cedula').html('');
//             }
//         });
//     };

//     // --- Uppercase Function ---
//     window.mayusculas = function(e) { e.value = e.value.toUpperCase(); }


//     // --- Main Save Function (guardar_b) ---
//     // This function is now bound to the form's 'submit' event.
//     $('#guardar_ba').on('submit', function(event) { 
//         event.preventDefault(); // Prevents the default form submission (page reload).

//         console.log("Form 'submit' event detected. Preventing page reload.");

//         // Input validations (trimming values)
//         const id_unidad = $("#id_unidad option:selected").val();
//         const nombrefun = $("#nombrefun").val().trim();
//         const apellido = $("#apellido").val().trim();
//         const cedula = $("#cedula").val().trim();
//         const cargo = $("#cargo").val().trim();
//         const tele_1 = $("#tele_1").val().trim();
//         const tele_2 = $("#tele_2").val().trim();
//         const oficina = $("#oficina").val().trim();
//         const fecha_designacion = $("#fecha_designacion").val();
//         const numero_gaceta = $("#numero_gaceta").val().trim();
//         const obser = $("#obser").val().trim();
//         const email = $("#email").val().trim();
//         const usuario = $("#usuario").val().trim();
//         const password = $("#password").val();
//         const repeatPassord = $("#repeatPassord").val();
        
//         // --- Required Field Validations (with SweetAlert2) ---
//         console.log("Starting required field validations...");
//         if (id_unidad == 0) { Swal.fire('Atencion', 'Seleccione Organo o Ente', 'warning'); document.getElementById("id_unidad").focus(); return false; }
//         if (nombrefun === '') { Swal.fire('Atencion', 'ingrese nombre de funcionario.', 'warning'); document.getElementById("nombrefun").focus(); return false; }
//         if (apellido === '') { Swal.fire('Atencion', 'ingrese apellido del funcionario.', 'warning'); document.getElementById("apellido").focus(); return false; }
//         if (cedula === '') { Swal.fire('Atencion', 'ingrese cedula', 'warning'); document.getElementById("cedula").focus(); return false; }
//         if (cargo === '') { Swal.fire('Atencion', 'ingrese cargo.', 'warning'); document.getElementById("cargo").focus(); return false; }
//         if (tele_1 === '') { Swal.fire('Atencion', 'ingrese numero telefonico.', 'warning'); document.getElementById("tele_1").focus(); return false; }
//         if (oficina === '') { Swal.fire('Atencion', 'ingrese numero telefonico.', 'warning'); document.getElementById("oficina").focus(); return false; }         
//         if (fecha_designacion === '') { Swal.fire('atencion', 'ingrese fecha de designacion.', 'warning'); document.getElementById("fecha_designacion").focus(); return false; }
//         if (numero_gaceta === '') { Swal.fire('Atencion', 'ingrese numero de gaceta.', 'warning'); document.getElementById("numero_gaceta").focus(); return false; }
//         if (obser === '') { Swal.fire('Atencion', 'ingrese observacion.', 'warning'); document.getElementById("obser").focus(); return false; } 
//         if (email === '') { Swal.fire('Atencion', 'ingrese correo institucional.', 'warning'); document.getElementById("email").focus(); return false; } 
//         if (usuario === '') { Swal.fire('Atencion', 'ingrese usuario.', 'warning'); document.getElementById("usuario").focus(); return false; }
//         if (password === '') { Swal.fire('Atencion', 'ingrese clave.', 'warning'); document.getElementById("password").focus(); return false; }
//         if (password !== repeatPassord) { Swal.fire('Password Error', 'claves no coinciden inente de nuevo.', 'error'); document.getElementById("repeatPassord").focus(); return false; }

//         console.log("Required field validations completed. All fields OK.");

//         // Final check: If the save button is disabled by an onblur validation, prevent submission.
//         if ($("#guardar_user").is(':disabled')) {
//             Swal.fire({
//                 title: 'Error',
//                 text: 'Hay errores en el formulario (por ejemplo, cédula, correo electrónico o nombre de usuario duplicados). Corríjalos antes de guardarlos.',
//                 icon: 'error',
//                 showConfirmButton: true
//             });
//             return false;
//         }

//         // If all validations pass, show final confirmation
//         Swal.fire({
//             title: "Registrar?",
//             text: "Seguro de registrar?",
//             icon: "question",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             cancelButtonText: "Cancel",
//             confirmButtonText: "Yes, save!",
//         })
//         .then((result) => {
//             if (result.value) { // If user confirms
//                 var formData = new FormData(this);
//                 // var baseUrl = window.location.origin + '/asnc/index.php/User/save_user_c';
//                  var baseUrl = '/index.php/User/save_user_c';

                
//                 console.log("User confirmed. Starting AJAX request to:", baseUrl);
//                 console.log("FormData being sent:");
//                 for (let [key, value] of formData.entries()) {
//                     console.log(key, ":", value);
//                 }

//                 $.ajax({
//                     url: baseUrl,
//                     method: "POST",
//                     data: formData,
//                     contentType: false,
//                     processData: false,
//                     dataType: 'json',
//                     success: function(response) {
//                         console.log("AJAX SUCCESS Response:", response);

//                         if (response && response.success) {
//                             Swal.fire({
//                                 title: 'Registo',
//                                 text: response.message || 'registrado.',
//                                 icon: 'success',
//                                 showConfirmButton: true
//                             }).then(() => {
//                                 location.reload();
//                             });
//                         } else {
//                             Swal.fire({
//                                 title: 'Registration Error',
//                                 text: response.message || 'ocurrio un erro intente de nuevo.',
//                                 icon: 'error',
//                                 showConfirmButton: true
//                             });
//                         }
//                     },
//                     error: function(jqXHR, textStatus, errorThrown) {
//                         console.error("AJAX Error DETAILS:");
//                         console.error("jqXHR:", jqXHR);
//                         console.error("textStatus:", textStatus);
//                         console.error("errorThrown:", errorThrown);
//                         console.error("Response Text (if any):", jqXHR.responseText);
//                         console.error("Status Code:", jqXHR.status);

//                         Swal.fire({
//                             title: 'Connection Error',
//                             text: 'error de conexion intente de nuevo.',
//                             icon: 'error',
//                             showConfirmButton: true
//                         });
//                     }
//                 });
//             }
//         });
//     }); // End of form submit handler

// }); // End of $(document).ready



// assets/js/usuario/user.js

// assets/js/usuario/user.js

$(document).ready(function() {
    console.log("Script user.js loaded and DOM Ready!");

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

    // --- NUEVA Función para renderizar el grid de permisos con un diseño de columnas ---
    function renderPermissions() {
        const permissionsGrid = $('#permissionsGrid');
        permissionsGrid.empty();

        // Número de columnas deseado
        const columns = 4;
        const itemsPerColumn = Math.ceil(PERMISSION_FIELDS.length / columns);
        
        let columnIndex = 0;
        let columnHtml = '';

        PERMISSION_FIELDS.forEach((field, index) => {
            const formattedName = formatPermissionName(field);
            const permissionHtml = `
                <div class="permission-item">
                    <label for="perm-${field}">${formattedName}:</label>
                    <label class="switch">
                        <input type="checkbox" id="perm-${field}" name="permissions[${field}]" value="1">
                        <span class="slider"></span>
                    </label>
                </div>
            `;
            columnHtml += permissionHtml;

            // Si se completa una columna o es el último elemento
            if ((index + 1) % itemsPerColumn === 0 || index === PERMISSION_FIELDS.length - 1) {
                permissionsGrid.append(`<div class="permission-column">${columnHtml}</div>`);
                columnHtml = '';
                columnIndex++;
            }
        });
    }

    // Llama a la función al cargar la página para mostrar los permisos
    renderPermissions();

    function formatPermissionName(fieldName) {
        if (fieldName === 'certi_externo') { return 'Certificación Facilitadores Externo CCP'; }
        if (fieldName === 'certificacion') { return 'Diplomado CCP'; }
        if (fieldName === 'menu_certi') { return 'Menú Certificación Facilitadores CCP'; }
        if (fieldName === 'consultas_exter_mb_certificado') { return 'Consultas Miembros Externos Certificados'; }
        if (fieldName === 'registrar_prog_anual') { return 'Registrar Programación Anual'; }
        
        return fieldName
            .replace(/_/g, ' ')
            .replace(/\b\w/g, char => char.toUpperCase());
    }

    function capitalize(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
    }

    function generateUsernameOptions(firstName, lastName) {
        let firstNames = firstName.split(' ').filter(n => n.trim() !== '');
        let lastNames = lastName.split(' ').filter(a => a.trim() !== '');

        if (firstNames.length === 0 || lastNames.length === 0) return [];

        let options = [];
        options.push(capitalize(firstNames[0].charAt(0).toLowerCase() + lastNames[0].toLowerCase()));
        if (lastNames.length > 1 && lastNames[1].trim() !== '') {
            options.push(capitalize(firstNames[0].charAt(0).toLowerCase() + lastNames[0].toLowerCase() + lastNames[1].charAt(0).toLowerCase()));
        }
        return options;
    }

    // --- Username Generation and Validation Logic (sin cambios) ---

    $('#nombrefun, #apellido').on('blur', function() {
        let firstName = $('#nombrefun').val().trim();
        let lastName = $('#apellido').val().trim();
        if (firstName && lastName) {
            let options = generateUsernameOptions(firstName, lastName);
            if (options.length > 0) {
                checkUsernameAvailability(options, 0);
            } else {
                $('#usuario').val('');
                $('#result-usuario').html('');
                $("#guardar_user").prop('disabled', true);
            }
        } else {
            $('#usuario').val('');
            $('#result-usuario').html('');
            $("#guardar_user").prop('disabled', true);
        }
    });

    function checkUsernameAvailability(options, index, counter = 1) {
        $('#result-usuario').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        
        if (index >= options.length) {
            let lastOption = options[options.length - 1] + counter;
            verifyUsername(lastOption, function(available) {
                if (available) {
                    $('#usuario').val(lastOption);
                    $('#result-usuario').fadeIn(300).html(
                        '<div class="alert alert-success"><strong>Success!</strong> Username available.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', false);
                } else {
                    checkUsernameAvailability(options, index, counter + 1);
                }
            });
            return;
        }

        verifyUsername(options[index], function(available) {
            if (available) {
                $('#usuario').val(options[index]);
                $('#result-usuario').fadeIn(300).html(
                    '<div class="alert alert-success"><strong>Success!</strong> usuario.</div>'
                ).css('opacity', '1');
                $("#guardar_user").prop('disabled', false);
            } else {
                checkUsernameAvailability(options, index + 1);
            }
        });
    }

    function verifyUsername(username, callback) {
        var baseUrl = '/index.php/User/validad_users';
        $.ajax({
            type: "POST",
            url: baseUrl,
            data: { usuario: username },
            success: function(data) { 
                callback(data == 0);
            },
            error: function() { 
                Swal.fire('Connection Error', 'Could not verify username availability.', 'error'); 
                callback(false);
            }
        });
    }

    $('#usuario').on('blur', function() {
        let username = capitalize($(this).val());
        $(this).val(username);

        if (username.trim() === '') {
            $('#result-usuario').html('');
            $("#guardar_user").prop('disabled', true);
            return;
        }

        $('#result-usuario').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        
        var dataString = 'usuario=' + username;
        var baseUrl = '/index.php/User/validad_users';

        $.ajax({
            type: "POST",
            url: baseUrl,
            data: dataString,
            success: function(data) { 
                if (data == 0) {
                    $('#result-usuario').fadeIn(300).html(
                        '<div class="alert alert-success"><strong>Success!</strong> Username disponible.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', false);
                } else {
                    $('#result-usuario').fadeIn(300).html(
                        '<div class="alert alert-danger"><strong>Username Taken!</strong> Please enter another username.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', true);
                    Swal.fire({ 
                        title: 'Username Already Registered',
                        text: 'The username "' + username + '" is already taken. Please choose a different one.',
                        icon: 'warning',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true
                    });
                }
            },
            error: function() { 
                Swal.fire('Connection Error', 'Could not verify username availability.', 'error'); 
                $("#guardar_user").prop('disabled', true);
                $('#result-usuario').html('');
            }
        });
    });

    // --- Email Validation Logic (sin cambios) ---
    window.validateEmail = function() { 
        let email = $('#email').val().trim();
        if (email === '') {
            $('#result-email').html('');
            $("#guardar_user").prop('disabled', true);
            return true;
        }

        $('#result-email').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        
        var dataString = 'email=' + email;
        var baseUrl = '/index.php/User/valida_correo';

        $.ajax({
            type: "POST",
            url: baseUrl,
            data: dataString,
            success: function(data) { 
                if (data == 0) {
                    $('#result-email').fadeIn(300).html(
                        '<div class="alert alert-success"><strong>Success!</strong> correo disponible.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', false);
                } else { 
                    $('#result-email').fadeIn(300).html(
                        '<div class="alert alert-danger"><strong>correo exite!</strong> por favor ingrese otro.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', true);
                    Swal.fire({ 
                        title: 'El correo ya existe',
                        text: 'El correo  "' + email + '" ya esta registrado. Por favor ingrese uno diferente.',
                        icon: 'warning',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true
                    });
                }
            },
            error: function() { 
                Swal.fire(' Error', 'veriviga el correo.', 'error'); 
                $("#guardar_user").prop('disabled', true);
                $('#result-email').html('');
            }
        });
        return true;
    };

    // --- Cedula Validation Logic (sin cambios) ---
    window.validateUsers = function() { 
        let cedulaVal = $('#cedula').val().trim();
        if (cedulaVal === '') {
            $('#result-cedula').html('');
            $("#guardar_user").prop('disabled', true);
            return;
        }
        
        $('#result-cedula').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        var baseUrl = '/index.php/User/valida_ced4';

        $.ajax({
            type: "POST",
            url: baseUrl,
            data: { cedula: cedulaVal },
            success: function(data) { 
                if (data == 0) { 
                    $('#result-cedula').fadeIn(300).html(
                        '<div class="alert alert-success"><strong>Success!</strong> Cedula  dsiponible.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', false);
                } else { 
                    $('#result-cedula').fadeIn(300).html(
                        '<div class="alert alert-danger"><strong>Cedula ya registradad!</strong> por favor revise o ingrese otra cedula.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', true);
                    Swal.fire({
                        title: 'cedula existe',
                        text: 'la cedula "' + cedulaVal + '" esta registrada. por favor ingrese otra',
                        icon: 'warning',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true
                    });
                }
            },
            error: function() { 
                Swal.fire(' Error', 'verifia la cedula.', 'error'); 
                $("#guardar_user").prop('disabled', true);
                $('#result-cedula').html('');
            }
        });
    };

    // --- Uppercase Function ---
    window.mayusculas = function(e) { e.value = e.value.toUpperCase(); }


    // --- Main Save Function (guardar_b) - MODIFICADA ---
    $('#guardar_ba').on('submit', function(event) { 
        event.preventDefault(); 

        const id_unidad = $("#id_unidad option:selected").val();
        const nombrefun = $("#nombrefun").val().trim();
        const apellido = $("#apellido").val().trim();
        const cedula = $("#cedula").val().trim();
        const cargo = $("#cargo").val().trim();
        const tele_1 = $("#tele_1").val().trim();
        const oficina = $("#oficina").val().trim();
        const fecha_designacion = $("#fecha_designacion").val();
        const numero_gaceta = $("#numero_gaceta").val().trim();
        const obser = $("#obser").val().trim();
        const email = $("#email").val().trim();
        const usuario = $("#usuario").val().trim();
        const password = $("#password").val();
        const repeatPassord = $("#repeatPassord").val();
        
        // Recolectar los datos de permisos del formulario
        const permissionsData = {};
        let permissionsSelected = false;
        $('#permissionsGrid input[type="checkbox"]').each(function() {
            const nameAttr = $(this).attr('name');
            const fieldName = nameAttr.substring(nameAttr.indexOf('[') + 1, nameAttr.indexOf(']'));
            permissionsData[fieldName] = $(this).is(':checked') ? 1 : 0;
            if (permissionsData[fieldName] === 1) {
                permissionsSelected = true;
            }
        });

        if (!permissionsSelected) {
            Swal.fire('Atención', 'Debe seleccionar al menos un permiso.', 'warning');
            return false;
        }

        // --- Validaciones de campos obligatorios ---
        if (id_unidad == 0) { Swal.fire('Atencion', 'Seleccione Organo o Ente', 'warning'); document.getElementById("id_unidad").focus(); return false; }
        if (nombrefun === '') { Swal.fire('Atencion', 'ingrese nombre de funcionario.', 'warning'); document.getElementById("nombrefun").focus(); return false; }
        if (apellido === '') { Swal.fire('Atencion', 'ingrese apellido del funcionario.', 'warning'); document.getElementById("apellido").focus(); return false; }
        if (cedula === '') { Swal.fire('Atencion', 'ingrese cedula', 'warning'); document.getElementById("cedula").focus(); return false; }
        if (cargo === '') { Swal.fire('Atencion', 'ingrese cargo.', 'warning'); document.getElementById("cargo").focus(); return false; }
        if (tele_1 === '') { Swal.fire('Atencion', 'ingrese numero telefonico.', 'warning'); document.getElementById("tele_1").focus(); return false; }
        if (oficina === '') { Swal.fire('Atencion', 'ingrese numero telefonico.', 'warning'); document.getElementById("oficina").focus(); return false; }         
        if (fecha_designacion === '') { Swal.fire('atencion', 'ingrese fecha de designacion.', 'warning'); document.getElementById("fecha_designacion").focus(); return false; }
        if (numero_gaceta === '') { Swal.fire('Atencion', 'ingrese numero de gaceta.', 'warning'); document.getElementById("numero_gaceta").focus(); return false; }
        if (obser === '') { Swal.fire('Atencion', 'ingrese observacion.', 'warning'); document.getElementById("obser").focus(); return false; } 
        if (email === '') { Swal.fire('Atencion', 'ingrese correo institucional.', 'warning'); document.getElementById("email").focus(); return false; } 
        if (usuario === '') { Swal.fire('Atencion', 'ingrese usuario.', 'warning'); document.getElementById("usuario").focus(); return false; }
        if (password === '') { Swal.fire('Atencion', 'ingrese clave.', 'warning'); document.getElementById("password").focus(); return false; }
        if (password !== repeatPassord) { Swal.fire('Password Error', 'claves no coinciden inente de nuevo.', 'error'); document.getElementById("repeatPassord").focus(); return false; }

        if ($("#guardar_user").is(':disabled')) {
            Swal.fire({
                title: 'Error',
                text: 'Hay errores en el formulario (por ejemplo, cédula, correo electrónico o nombre de usuario duplicados). Corríjalos antes de guardarlos.',
                icon: 'error',
                showConfirmButton: true
            });
            return false;
        }

        Swal.fire({
            title: "Registrar?",
            text: "Seguro de registrar?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, Guardar!",
        })
        .then((result) => {
            if (result.value) {
                var formData = new FormData(this);
                // Añadir los datos de permisos a FormData
                for (const key in permissionsData) {
                    formData.append(`permissions[${key}]`, permissionsData[key]);
                }

                // NUEVO ENDPOINT DEL CONTROLADOR
                var baseUrl = '/index.php/User/save_user_with_profile';
                
                $.ajax({
                    url: baseUrl,
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.success) {
                            Swal.fire({
                                title: 'Registo',
                                text: response.message || 'registrado.',
                                icon: 'success',
                                showConfirmButton: true
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Registration Error',
                                text: response.message || 'ocurrio un erro intente de nuevo.',
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            title: 'Connection Error',
                            text: 'error de conexion intente de nuevo.',
                            icon: 'error',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    }); 
});
