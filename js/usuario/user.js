function may(e){
	e.value = e.value.toUpperCase();
}
// function validateEmail(){
                
//     // Get our input reference.
//     var emailField = document.getElementById('email');
    
//     // Define our regular expression.
//     var validEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     var errorMsg = document.getElementById("errorMsgc");

//     // Using test we can check if the text match the pattern
//     if( validEmail.test(emailField.value) ){
//         errorMsg.style.color = "green";
//        errorMsg.innerHTML = "Correo valido.";
//         $("#guardar_user").prop('disabled', false)
//         return true;
//     }else{
//         errorMsg.style.color = "red";
//        errorMsg.innerHTML = "Correo No valido.Ingrese Corre Institucional";
//         $("#guardar_user").prop('disabled', true)
//         return false;
//     }
// }
// function validateUsers() {
//     var cedula = document.getElementById('cedula').value;
//    // console.log('cedula:', cedula);
//     var base_url = '/index.php/User/valida_ced4';
//     var no=0;
//     $.ajax({
//       type: "POST",
//       url: base_url,
//       data: {
//         cedula: cedula
//       },    

//       success: function(data) {
       
//         data = data.trim();

//         if (data == no) {
//             alert('La cedula no existe, puede continuar');
//        $("#guardar_user").prop('disabled', false)   

//         } else {
//             alert('La cedula ya existe, Revisa y vuelve a intentar');
//             $("#guardar_user").prop('disabled', true)

//         }
//       }
//     });
//   }
  
// function guardar_b(){
//     var nombrefun = $("#nombrefun").val();
//     var apellido = $("#apellido").val();
//     var cedula = $("#cedula").val();
//     var cargo = $("#cargo").val();
//     var tele_1 = $("#tele_1").val();
//     var tele_2 = $("#tele_2").val();
//     var oficina = $("#oficina").val();
//     var fecha_designacion = $("#fecha_designacion").val();
//     var numero_gaceta = $("#numero_gaceta").val();
//     var obser = $("#obser").val();
//     var email = $("#email").val();
//     var usuario = $("#usuario").val();
//     var nombrefun = $("#nombrefun").val();
//     var password = $("#password").val();

//     event.preventDefault();
//     swal
//         .fire({
//             title: "¿Registrar?",
//             text: "¿Esta seguro de registrar",
//             type: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             cancelButtonText: "Cancelar",
//             confirmButtonText: "¡Si, guardar!",
//         })
//         .then((result) => {
              
//             if ($("#perfil option:selected").val() == 0) {
//                 alert("Debe Seleccionar un Perfil");
//                 document.getElementById("perfil").focus();
//                 return false;
//             }
//             if ($("#id_unidad option:selected").val() == 0) {
//                 alert("Debe Seleccionar  Organo/Ente *");
//                 document.getElementById("id_unidad").focus();
//                 return false;
//             }
//             if(nombrefun == ''){
//                 alert("Debe ingresar un Nombre")
//                 document.getElementById("nombrefun").focus();
//                 return false;
//             }
//             if(apellido == ''){
//                 alert("Debe ingresar un Apellido COmpleto")
//                 document.getElementById("apellido").focus();
//                 return false;
//             }
//             if(cedula == ''){
//                 alert("Debe ingresar Cedula de Indentidad")
//                 document.getElementById("cedula").focus();
//                 return false;
//             }
//             if(cargo == ''){
//                 alert("Debe ingresar cargo")
//                 document.getElementById("cargo").focus();
//                 return false;
//             }
//             if(tele_1 == ''){
//                 alert("Debe ingresar Telèfono")
//                 document.getElementById("tele_1").focus();
//                 return false;
//             }
//             if(tele_2 == ''){
//                 alert("Debe ingresar Telèfono 2 ")
//                 document.getElementById("tele_2").focus();
//                 return false;
//             }
//             if(oficina == ''){
//                 alert("Debe ingresar oficina ")
//                 document.getElementById("oficina").focus();
//                 return false;
//             }         
//             if(fecha_designacion == ''){
//                 alert("Debe ingresar fecha designaciòn ")
//                 document.getElementById("fecha_designacion").focus();
//                 return false;
//             }
//             if(numero_gaceta == ''){
//                 alert("Debe ingresar numero gaceta ")
//                 document.getElementById("numero_gaceta").focus();
//                 return false;
//             }
//             if(obser == ''){
//                 alert("Debe ingresar obser ")
//                 document.getElementById("Observaciòn").focus();
//                 return false;
//             } if(email == ''){
//                 alert("Debe ingresar Correo Institucional ")
//                 document.getElementById("email").focus();
//                 return false;
//             } if(usuario == ''){
//                 alert("Debe ingresar usuario ")
//                 document.getElementById("usuario").focus();
//                 return false;
//             }
//             if(password == ''){
//                 alert("Debe ingresar Contraseña ")
//                 document.getElementById("password").focus();
//                 return false;
//             }
         
//             if (result.value == true) {
//                 event.preventDefault();
//                 var datos = new FormData($("#guardar_ba")[0]);
//                 //  var base_url =window.location.origin+'/asnc/index.php/User/save_user_c';
//                 var base_url = '/index.php/User/save_user_c';
                
//                 $.ajax({
//                     url: base_url,
//                     method: "POST",
//                     data: datos,
//                     contentType: false,
//                     processData: false,
//                     success: function(response) {
//                         var menj = 'Guardado';
                       
//                        if (response != '') {
//                         swal.fire({
//                             title: 'Registro Exitoso ',
//                             text: menj ,
//                             type: 'success',
//                             showCancelButton: false,
//                             confirmButtonColor: '#3085d6',
//                             confirmButtonText: 'Ok'
//                         }).then((result) => {
//                             if (result.value == true){
//                                 location.reload();
//                             }
//                         });
//                         }
                        
//                     },error: function(jqXHR, textStatus, errorThrown) {
//                         swal.fire({
//                             title: 'Error',
//                             type: 'error',
//                             text: 'ocurrio un error, por favor vuelva a intentar.'
//                         });
//                     }
//                 });
//             }
//         });
    
// }

// assets/js/usuario/user.js

// assets/js/usuario/user.js

 // assets/js/usuario/user.js

$(document).ready(function() {
    console.log("Script user.js loaded and DOM Ready!");

    // Initialize select2 if you're using it
    // $('.default-select2').select2();

    // --- Helper Functions ---

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

    function loadOrganosEntes() {
        // Your HTML already loads these from PHP. This is a placeholder
        // if you decide to load them dynamically via AJAX.
    }

    // --- Username Generation and Validation Logic ---

    $('#nombrefun, #apellido').on('blur', function() {
        let firstName = $('#nombrefun').val().trim();
        let lastName = $('#apellido').val().trim();
        console.log("Blur on first name/last name. First Name:", firstName, "Last Name:", lastName);

        if (firstName && lastName) {
            let options = generateUsernameOptions(firstName, lastName);
            console.log("Generated username options:", options);
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
            console.log("Trying option with counter:", lastOption);
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

        console.log("Checking option:", options[index]);
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
        // var baseUrl = window.location.origin + '/asnc/index.php/User/validad_users';
        var baseUrl = '/index.php/User/validad_users';
        $.ajax({
            type: "POST",
            url: baseUrl,
            data: { usuario: username },
            success: function(data) { 
                console.log("Response verifyUsername:", data); 
                callback(data == 0);
                if (data != 0) { // If username is NOT available (data is 1)
                    Swal.fire({
                        title: 'Username Taken',
                        text: 'The username "' + username + '" is already registered. Please try another one.',
                        icon: 'info', // Use 'info' for less intrusive feedback
                        toast: true, // Make it a small toast notification
                        position: 'top-end', // Position it at the top right
                        showConfirmButton: false, // Don't show a confirm button
                        timer: 3000, // Automatically close after 3 seconds
                        timerProgressBar: true
                    });
                }
            },
            error: function() { 
                console.error("Error verifying username."); 
                Swal.fire('Connection Error', 'Could not verify username availability.', 'error'); 
                callback(false);
            }
        });
    }

    $('#usuario').on('blur', function() {
        console.log("Blur on username field. Value:", $(this).val());
        if ($(this).val().trim() === '') {
            $('#result-usuario').html('');
            $("#guardar_user").prop('disabled', true);
            return;
        }

        let username = capitalize($(this).val());
        $(this).val(username);

        $('#result-usuario').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        
        var dataString = 'usuario=' + username;
        // var baseUrl = window.location.origin + '/asnc/index.php/User/validad_users';
        var baseUrl = '/index.php/User/validad_users';


        $.ajax({
            type: "POST",
            url: baseUrl,
            data: dataString,
            success: function(data) { 
                console.log("Response blur username:", data); 
                if (data == 0) { // Username available
                    $('#result-usuario').fadeIn(300).html(
                        '<div class="alert alert-success"><strong>Success!</strong> Username disponible.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', false);
                } else { // Username taken
                    $('#result-usuario').fadeIn(300).html(
                        '<div class="alert alert-danger"><strong>Username Taken!</strong> Please enter another username.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', true);
                    Swal.fire({ // <--- IMMEDIATE SWEETALERT FOR USERNAME DUPLICATE
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
                console.error("Error in blur username."); 
                Swal.fire('Connection Error', 'Could not verify username availability.', 'error'); 
                $("#guardar_user").prop('disabled', true);
                $('#result-usuario').html('');
            }
        });
    });

    // --- Email Validation Logic ---

    window.validateEmail = function() { 
        console.log("Validating email. Value:", $('#email').val());
        let email = $('#email').val().trim();
        if (email === '') {
            $('#result-email').html('');
            $("#guardar_user").prop('disabled', true);
            return true;
        }

        $('#result-email').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        
        var dataString = 'email=' + email;
        // var baseUrl = window.location.origin + '/asnc/index.php/User/valida_correo';
        var baseUrl = '/index.php/User/valida_correo';

        $.ajax({
            type: "POST",
            url: baseUrl,
            data: dataString,
            success: function(data) { 
                console.log("Response validateEmail:", data); 
                if (data == 0) { // Email available
                    $('#result-email').fadeIn(300).html(
                        '<div class="alert alert-success"><strong>Success!</strong> correo disponible.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', false);
                } else { // Email taken
                    $('#result-email').fadeIn(300).html(
                        '<div class="alert alert-danger"><strong>correo exite!</strong> por favor ingrese otro.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', true);
                    Swal.fire({ // <--- IMMEDIATE SWEETALERT FOR EMAIL DUPLICATE
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
                console.error("Error in validateEmail."); 
                Swal.fire('Connection Error', 'Could not verify email availability.', 'error'); 
                $("#guardar_user").prop('disabled', true);
                $('#result-email').html('');
            }
        });
        return true;
    };

    // --- Cedula Validation Logic ---

    window.validateUsers = function() { 
        console.log("Validating cedula. Value:", $('#cedula').val());
        let cedulaVal = $('#cedula').val().trim();
        if (cedulaVal === '') {
            $('#result-cedula').html('');
            $("#guardar_user").prop('disabled', true);
            return;
        }
        
        $('#result-cedula').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>').css('opacity', '1');
        // var baseUrl = window.location.origin + '/asnc/index.php/User/valida_ced4';
        var baseUrl = '/index.php/User/valida_ced4';


        $.ajax({
            type: "POST",
            url: baseUrl,
            data: { cedula: cedulaVal },
            success: function(data) { 
                console.log("Response validateCedula:", data); 
                if (data == 0) { // Cedula available
                    $('#result-cedula').fadeIn(300).html(
                        '<div class="alert alert-success"><strong>Success!</strong> Cedula  dsiponible.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', false);
                } else { // Cedula taken
                    $('#result-cedula').fadeIn(300).html(
                        '<div class="alert alert-danger"><strong>Cedula ya registradad!</strong> por favor revise o ingrese otra cedula.</div>'
                    ).css('opacity', '1');
                    $("#guardar_user").prop('disabled', true);
                    Swal.fire({ // <--- IMMEDIATE SWEETALERT FOR CEDULA DUPLICATE
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
                console.error("Error in validateCedula."); 
                Swal.fire('Connection Error', 'Could not verify cedula availability.', 'error'); 
                $("#guardar_user").prop('disabled', true);
                $('#result-cedula').html('');
            }
        });
    };

    // --- Uppercase Function ---
    window.mayusculas = function(e) { e.value = e.value.toUpperCase(); }


    // --- Main Save Function (guardar_b) ---
    // This function is now bound to the form's 'submit' event.
    $('#guardar_ba').on('submit', function(event) { 
        event.preventDefault(); // Prevents the default form submission (page reload).

        console.log("Form 'submit' event detected. Preventing page reload.");

        // Input validations (trimming values)
        const id_unidad = $("#id_unidad option:selected").val();
        const nombrefun = $("#nombrefun").val().trim();
        const apellido = $("#apellido").val().trim();
        const cedula = $("#cedula").val().trim();
        const cargo = $("#cargo").val().trim();
        const tele_1 = $("#tele_1").val().trim();
        const tele_2 = $("#tele_2").val().trim();
        const oficina = $("#oficina").val().trim();
        const fecha_designacion = $("#fecha_designacion").val();
        const numero_gaceta = $("#numero_gaceta").val().trim();
        const obser = $("#obser").val().trim();
        const email = $("#email").val().trim();
        const usuario = $("#usuario").val().trim();
        const password = $("#password").val();
        const repeatPassord = $("#repeatPassord").val();
        
        // --- Required Field Validations (with SweetAlert2) ---
        console.log("Starting required field validations...");
        if (id_unidad == 0) { Swal.fire('Attention', 'You must select an Organization/Entity.', 'warning'); document.getElementById("id_unidad").focus(); return false; }
        if (nombrefun === '') { Swal.fire('Attention', 'You must enter the full name of the official.', 'warning'); document.getElementById("nombrefun").focus(); return false; }
        if (apellido === '') { Swal.fire('Attention', 'You must enter the full last name of the official.', 'warning'); document.getElementById("apellido").focus(); return false; }
        if (cedula === '') { Swal.fire('Attention', 'You must enter the Identity Card.', 'warning'); document.getElementById("cedula").focus(); return false; }
        if (cargo === '') { Swal.fire('Attention', 'You must enter the position.', 'warning'); document.getElementById("cargo").focus(); return false; }
        if (tele_1 === '') { Swal.fire('Attention', 'You must enter the Main Phone Number.', 'warning'); document.getElementById("tele_1").focus(); return false; }
        if (oficina === '') { Swal.fire('Attention', 'You must enter the Office.', 'warning'); document.getElementById("oficina").focus(); return false; }         
        if (fecha_designacion === '') { Swal.fire('Attention', 'You must enter the Appointment/Request Date.', 'warning'); document.getElementById("fecha_designacion").focus(); return false; }
        if (numero_gaceta === '') { Swal.fire('Attention', 'You must enter the Gazette/Resolution/Office Number.', 'warning'); document.getElementById("numero_gaceta").focus(); return false; }
        if (obser === '') { Swal.fire('Attention', 'You must enter Observations.', 'warning'); document.getElementById("obser").focus(); return false; } 
        if (email === '') { Swal.fire('Attention', 'You must enter the Institutional Email.', 'warning'); document.getElementById("email").focus(); return false; } 
        if (usuario === '') { Swal.fire('Attention', 'You must enter a Username.', 'warning'); document.getElementById("usuario").focus(); return false; }
        if (password === '') { Swal.fire('Attention', 'You must enter a Password.', 'warning'); document.getElementById("password").focus(); return false; }
        if (password !== repeatPassord) { Swal.fire('Password Error', 'Passwords do not match. Please try again.', 'error'); document.getElementById("repeatPassord").focus(); return false; }

        console.log("Required field validations completed. All fields OK.");

        // Final check: If the save button is disabled by an onblur validation, prevent submission.
        if ($("#guardar_user").is(':disabled')) {
            Swal.fire({
                title: 'Validation Error',
                text: 'There are errors in the form (e.g., duplicate Cédula, Email, or Username). Please correct them before saving.',
                icon: 'error',
                showConfirmButton: true
            });
            return false;
        }

        // If all validations pass, show final confirmation
        Swal.fire({
            title: "Register?",
            text: "Are you sure you want to register this new user?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes, save!",
        })
        .then((result) => {
            if (result.value) { // If user confirms
                var formData = new FormData(this);
                // var baseUrl = window.location.origin + '/asnc/index.php/User/save_user_c';
                 var baseUrl = '/index.php/User/save_user_c';

                
                console.log("User confirmed. Starting AJAX request to:", baseUrl);
                console.log("FormData being sent:");
                for (let [key, value] of formData.entries()) {
                    console.log(key, ":", value);
                }

                $.ajax({
                    url: baseUrl,
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        console.log("AJAX SUCCESS Response:", response);

                        if (response && response.success) {
                            Swal.fire({
                                title: 'Registration Successful',
                                text: response.message || 'The user has been registered successfully.',
                                icon: 'success',
                                showConfirmButton: true
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Registration Error',
                                text: response.message || 'An unknown error occurred while registering the user. Please check the data and try again.',
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error DETAILS:");
                        console.error("jqXHR:", jqXHR);
                        console.error("textStatus:", textStatus);
                        console.error("errorThrown:", errorThrown);
                        console.error("Response Text (if any):", jqXHR.responseText);
                        console.error("Status Code:", jqXHR.status);

                        Swal.fire({
                            title: 'Connection Error',
                            text: 'Could not contact the server. Please try again. Check the console for details.',
                            icon: 'error',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    }); // End of form submit handler

}); // End of $(document).ready