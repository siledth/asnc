 

// function consultar_rif() {
//     var rif_b = $('#rif_b').val();
//     var $form = $('#sav_ext'); // Referencia al formulario

//     if (rif_b == '') {
//         swal.fire({ title: "¡ATENCIÓN!", text: "El campo RIF no puede estar vacío.", type: "warning" });
//         $("#existe").hide();
//         $("#no_existe").hide();
//         $form.attr('data-rif-status', ''); // Resetear el estado si el campo RIF está vacío
//         return;
//     }
//                 // var base_url = window.location.origin + '/asnc/index.php/gestion/llenar_organos_planila';

//     var base_url = '/index.php/gestion/llenar_organos_planila';

//     $.ajax({
//         url: base_url,
//         method: 'post',
//         data: { rif_b: rif_b },
//         dataType: 'json',
//         success: function (data) {
//             if (data === null) { // RIF NO ENCONTRADO
//                 $("#no_existe").show();
//                 $("#existe").hide();

//                 // Limpiar campos de la sección 'existe'
//                 $('#sel_rif_nombre5').val('');
//                 $('#nombre_conta_5').val('');
//                 $('#cod_onapre_existe').val('');
//                 $('#siglas_existe').val('');
//                 $('#clasificacion_existe').val('');
//                 $('#tel_local_existe').val('');
//                 $('#pag_web_existe').val('');

//                 // Transferir RIF a la sección 'no_existe'
//                 $('#rif_55').val(rif_b);

//                 $form.attr('data-rif-status', 'no_existe'); // Establecer el estado del formulario

//             } else { // RIF ENCONTRADO
//                 $("#existe").show();
//                 $("#no_existe").hide();

//                 // Rellenar campos de la sección 'existe'
//                 $('#sel_rif_nombre5').val(data.rif);
//                 $('#nombre_conta_5').val(data.descripcion);
//                 $('#cod_onapre_existe').val(data.cod_onapre);
//                 $('#siglas_existe').val(data.siglas);
//                 $('#clasificacion_existe').val(data.clasificacion_nombre);
//                 $('#tel_local_existe').val(data.telefono_local);
//                 $('#pag_web_existe').val(data.pagina_web);

//                 $form.attr('data-rif-status', 'existe'); // Establecer el estado del formulario
//             }
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             console.error("Error en la consulta de RIF:", textStatus, errorThrown);
//             swal.fire("¡ERROR!", "Ocurrió un problema al consultar el RIF. Por favor, inténtelo de nuevo.", "error");

//             // En caso de error, asumir que no existe y mostrar 'no_existe'
//             $("#no_existe").show();
//             $("#existe").hide();
//             $('#rif_55').val(rif_b);
//             $form.attr('data-rif-status', 'no_existe'); // Establecer el estado del formulario en 'no_existe' en caso de error
//         }
//     });
// }
function consultar_rif() {
    var rif_b = $('#rif_b').val().trim();
    var $form = $('#sav_ext');

    if (rif_b === '') {
        swal.fire({ title: "¡ATENCIÓN!", text: "El campo RIF no puede estar vacío.", type: "warning" });
        $("#existe").hide();
        $("#no_existe").hide();
        $form.attr('data-rif-status', '');

        // Si el RIF principal está vacío, limpiar y habilitar adscripción para ingreso manual
        $('#rifadscrito').val('').prop('readonly', false).attr('required', true);
        $('#nameadscrito').val('').prop('readonly', false).attr('required', true);
        resetRecaptcha();
        return;
    }
    var base_url = '/index.php/gestion/llenar_organos_planila';
   // var base_url = window.location.origin + '/asnc/index.php/gestion/llenar_organos_planila';

    $.ajax({
        url: base_url,
        method: 'post',
        data: { rif_b: rif_b },
        dataType: 'json',
        success: function (data) {
            console.log("Datos recibidos del servidor:", data); // Mantenemos este log para depuración

            if (data === null) { // RIF Principal NO ENCONTRADO
                $("#no_existe").show();
                $("#existe").hide();

                // Limpiar campos de la sección 'existe'
                $('#sel_rif_nombre5').val('');
                $('#nombre_conta_5').val('');
                $('#cod_onapre_existe').val('');
                $('#siglas_existe').val('');
                $('#clasificacion_existe').val('');
                $('#tel_local_existe').val('');
                $('#pag_web_existe').val('');

                // Transferir RIF a la sección 'no_existe'
                $('#rif_55').val(rif_b);

                $form.attr('data-rif-status', 'no_existe');

                // Si el RIF principal NO existe, permitir ingreso manual de adscripción
                // Los campos se mantienen vacíos para que el usuario los llene.
                $('#rifadscrito').val('').prop('readonly', false).attr('required', true);
                $('#nameadscrito').val('').prop('readonly', false).attr('required', true);

            } else { // RIF Principal ENCONTRADO
                $("#existe").show();
                $("#no_existe").hide();

                // Rellenar campos de la sección 'existe'
                $('#sel_rif_nombre5').val(data.rif);
                $('#nombre_conta_5').val(data.descripcion);
                $('#cod_onapre_existe').val(data.cod_onapre);
                $('#siglas_existe').val(data.siglas);
                $('#clasificacion_existe').val(data.clasificacion_nombre);
                $('#tel_local_existe').val(data.telefono_local);
                $('#pag_web_existe').val(data.pagina_web);

                $form.attr('data-rif-status', 'existe');

                // --- Lógica para Datos del Órgano/Ente de Adscripción ---
                // Si id_organoenteads es exactamente '0' o null/undefined
                if (data.id_organoenteads === '0' || data.id_organoenteads === null || data.id_organoenteads === undefined) {
                    // Si no hay una adscripción real (id_organoenteads es '0' o nulo),
                    // llenamos con los datos del mismo órgano y los hacemos editables.
                    $('#rifadscrito').val(data.rif).prop('readonly', false).attr('required', true);
                    $('#nameadscrito').val(data.descripcion).prop('readonly', false).attr('required', true);
                } else {
                    // Si hay una adscripción real (id_organoenteads es diferente de '0' y no nulo),
                    // llenamos con los datos de la adscripción y los hacemos de solo lectura.
                    $('#rifadscrito').val(data.rifadscrito_bd || '').prop('readonly', true).removeAttr('required');
                    $('#nameadscrito').val(data.nombreadscrito_bd || '').prop('readonly', true).removeAttr('required');
                }
            }
            resetRecaptcha();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown, jqXHR.responseText);
            swal.fire("¡ERROR!", "Ocurrió un problema al consultar el RIF. Por favor, inténtelo de nuevo.", "error");

            $("#no_existe").show();
            $("#existe").hide();
            $('#rif_55').val(rif_b);
            $form.attr('data-rif-status', 'no_existe');

            // En caso de error, hacer los campos de adscripción editables y vacíos
            $('#rifadscrito').val('').prop('readonly', false).attr('required', true);
            $('#nameadscrito').val('').prop('readonly', false).attr('required', true);
            resetRecaptcha();
        }
    });
}
function validateTelefonoF() {
    const telefonoInput = document.getElementById('telefono_f');
    const telefonoValue = telefonoInput.value.trim(); // Obtener el valor y eliminar espacios en blanco

    // Expresión regular para permitir solo dígitos
    const numericPattern = /^[0-9]+$/;

    // Reiniciar mensajes de error previos
    // (Asegúrate de tener un elemento para mostrar el error, si no, puedes usar swal.fire)
    // Por ejemplo, podrías tener un <p id="errorTelefonoF" class="text-danger"></p> debajo del input
    // const errorMsgElement = document.getElementById('errorTelefonoF');
    // if (errorMsgElement) errorMsgElement.textContent = '';

    // Validación 1: Solo números
    if (!numericPattern.test(telefonoValue)) {
        swal.fire({
            title: "¡ATENCIÓN!",
            text: "El teléfono solo puede contener números.",
            type: "warning"
        }).then(() => {
            telefonoInput.value = ''; // Limpiar el campo
            telefonoInput.focus();   // Poner el foco de nuevo en el campo
        });
        return false;
    }

    // Validación 2: Mayor que 0
    // Convertir a número para la comparación, pero mantener el valor original si empieza con 0
    if (telefonoValue.length > 0 && parseInt(telefonoValue, 10) === 0) {
        swal.fire({
            title: "¡ATENCIÓN!",
            text: "El número de teléfono no puede ser cero.",
            type: "warning"
        }).then(() => {
            telefonoInput.value = '';
            telefonoInput.focus();
        });
        return false;
    }

    // Validación 3: Máximo 20 caracteres
    if (telefonoValue.length > 20) {
        swal.fire({
            title: "¡ATENCIÓN!",
            text: "El número de teléfono no puede exceder los 20 dígitos.",
            type: "warning"
        }).then(() => {
            telefonoInput.value = telefonoValue.substring(0, 20); // Recortar a 20 caracteres
            telefonoInput.focus();
        });
        return false; // Aunque se haya recortado, es bueno indicar que hubo un problema inicial
    }

    // Si todas las validaciones pasan
    return true;
}
function validateTelefonoF2() {
    const telefonoInput = document.getElementById('tel_local');
    const telefonoValue = telefonoInput.value.trim(); // Obtener el valor y eliminar espacios en blanco

    // Expresión regular para permitir solo dígitos
    const numericPattern = /^[0-9]+$/;

    // Reiniciar mensajes de error previos
    // (Asegúrate de tener un elemento para mostrar el error, si no, puedes usar swal.fire)
    // Por ejemplo, podrías tener un <p id="errorTelefonoF" class="text-danger"></p> debajo del input
    // const errorMsgElement = document.getElementById('errorTelefonoF');
    // if (errorMsgElement) errorMsgElement.textContent = '';

    // Validación 1: Solo números
    if (!numericPattern.test(telefonoValue)) {
        swal.fire({
            title: "¡ATENCIÓN!",
            text: "El teléfono solo puede contener números.",
            type: "warning"
        }).then(() => {
            telefonoInput.value = ''; // Limpiar el campo
            telefonoInput.focus();   // Poner el foco de nuevo en el campo
        });
        return false;
    }

    // Validación 2: Mayor que 0
    // Convertir a número para la comparación, pero mantener el valor original si empieza con 0
    if (telefonoValue.length > 0 && parseInt(telefonoValue, 10) === 0) {
        swal.fire({
            title: "¡ATENCIÓN!",
            text: "El número de teléfono no puede ser cero.",
            type: "warning"
        }).then(() => {
            telefonoInput.value = '';
            telefonoInput.focus();
        });
        return false;
    }

    // Validación 3: Máximo 20 caracteres
    if (telefonoValue.length > 20) {
        swal.fire({
            title: "¡ATENCIÓN!",
            text: "El número de teléfono no puede exceder los 20 dígitos.",
            type: "warning"
        }).then(() => {
            telefonoInput.value = telefonoValue.substring(0, 20); // Recortar a 20 caracteres
            telefonoInput.focus();
        });
        return false; // Aunque se haya recortado, es bueno indicar que hubo un problema inicial
    }

    // Si todas las validaciones pasan
    return true;
}
function llenar_municipio(){
    var id_estado_n = $('#id_estado_n').val();
//    var base_url = window.location.origin+'/asnc/index.php/User/listar_municipio';
    var base_url = '/index.php/User/listar_municipio';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_estado: id_estado_n},
        dataType:'json',

        success: function(response){
            $('#id_municipio_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_municipio_n').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
            });
        }
    });
}
function llenar_parroquia(){
    var id_municipio_n = $('#id_estado_n').val();
//    var base_url = window.location.origin+'/asnc/index.php/User/listar_parroquia';
    var base_url = '/index.php/User/listar_parroquia';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_municipio: id_municipio_n},
        dataType:'json',

        success: function(response){
            $('#id_parroquia_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_parroquia_n').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
            });
        }
    });
}

 function validateEmail() {
    const emailInput = document.getElementById('correo');
    const emailValue = emailInput.value.trim();

    const gmailPattern = /@gmail\.com$/i;
    const hotmailPattern = /@hotmail\.com$/i;

    if (gmailPattern.test(emailValue) || hotmailPattern.test(emailValue)) {
        swal.fire({
            title: "¡ATENCIÓN!",
            text: "Solo se permiten correos institucionales o Cifrados (no @gmail.com ni @hotmail.com).",
            type: "warning"
        }).then(() => {
            emailInput.value = '';
            emailInput.focus();
        });
        const guardarButton = document.getElementById('guardar');
        if (guardarButton) {
            guardarButton.disabled = true;
        }
        return false;
    } else {
        const guardarButton = document.getElementById('guardar');
        if (guardarButton) {
            guardarButton.disabled = false;
        }
        return true;
    }
}

    var recaptchaWidgetId;

 function fetchUserDetails() {
    console.log("fetchUserDetails function called!");
    const cedula = $('#cedula_f').val();
    console.log("Cédula entered: " + cedula);

    // Clear previous user details if any
    $('#name_f').val('');
    $('#apellido_f').val('');
    $('#cargo_f').val('');
    $('#telefono_f').val('');
    $('#correo').val('');
      var base_url = '/index.php/User/getUserDetailsByCedula';

    // var base_url = window.location.origin + '/asnc/index.php/User/getUserDetailsByCedula';
    //console.log("AJAX URL: " + base_url);

    if (cedula.length > 0) {
        $.ajax({
            url: base_url,
            type: 'POST',
            data: {
                cedula: cedula
            },
            dataType: 'json',
            success: function(response) {
              //  console.log("AJAX Success Response:", response);
                if (response.status === 'success' && response.data) {
                    const user = response.data;
                    $('#name_f').val(user.nombrefun);
                    $('#apellido_f').val(user.apellido);
                    $('#cargo_f').val(user.cargo);
                    $('#telefono_f').val(user.tele_1);
                    $('#correo').val(user.email);
                } else {
                    console.log('Usuario no encontrado o error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
                console.error("Response Text:", xhr.responseText);
            }
        });
    } else {
        console.log("Cédula is empty, not making AJAX call.");
    }
}

function save(event) {
    event.preventDefault();
      var $form = $('#sav_ext');
    var rifStatus = $form.attr('data-rif-status'); // Obtener el estado del RIF
      // --- Validaciones de campos (del lado del cliente) ---
    // Si alguna validación falla, mostraremos el SweetAlert
    // Y luego REINICIAREMOS el CAPTCHA inmediatamente.

    // if (document.sav_ext.rif_b.value.length == 0) {
    //     swal.fire({ title: 'No Puede dejar campo RIF vacío', text: 'Ingrese un valor.', type: 'warning' }).then(() => { resetRecaptcha(); });
    //     document.sav_ext.rif_b.focus(); return 0; }
         // 1. Validar que el RIF principal haya sido consultado
    if (!rifStatus) { // Si el estado no está definido, significa que rif_b no se ha consultado o está vacío
        swal.fire({ title: 'Atención', text: 'Por favor, ingrese y valide el RIF antes de continuar.', type: 'warning' });
        document.sav_ext.rif_b.focus();
        resetRecaptcha();
        return 0;
    }

     if (rifStatus === 'no_existe') {
        // --- Campos OBLIGATORIOS cuando el RIF NO existe ---
        if (document.sav_ext.rif_55.value.length === 0) {
            swal.fire({ title: 'Debe ingresar el RIF del Órgano/Ente', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.rif_55.focus(); return 0;
        }
        if (document.sav_ext.razon_social.value.length === 0) {
            swal.fire({ title: 'Debe ingresar el Nombre del Órgano/Ente', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.razon_social.focus(); return 0;
        }
        if (document.sav_ext.cod_onapre.value.length === 0) {
            swal.fire({ title: 'Debe ingresar el Código ONAPRE', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.cod_onapre.focus(); return 0;
        }
        if (document.sav_ext.siglas.value.length === 0) {
            swal.fire({ title: 'Debe ingresar las Siglas del Órgano/Ente', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.siglas.focus(); return 0;
        }
        if (document.sav_ext.id_clasificacion.value === '0') { // Para select, verificar el valor por defecto
            swal.fire({ title: 'Debe seleccionar la Clasificación del Órgano/Ente', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.id_clasificacion.focus(); return 0;
        }
        if (document.sav_ext.tel_local.value.length === 0) {
            swal.fire({ title: 'Debe ingresar el Teléfono Local del Órgano/Ente', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.tel_local.focus(); return 0;
        }
        if (document.sav_ext.pag_web.value.length === 0) {
            swal.fire({ title: 'Debe ingresar la Página Web del Órgano/Ente', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.pag_web.focus(); return 0;
        }
        if (document.sav_ext.id_estado_n.value === '0') {
            swal.fire({ title: 'Debe seleccionar el Estado de la Dirección Fiscal', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.id_estado_n.focus(); return 0;
        }
        if (document.sav_ext.id_municipio_n.value === '0') {
            swal.fire({ title: 'Debe seleccionar el Municipio de la Dirección Fiscal', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.id_municipio_n.focus(); return 0;
        }
        if (document.sav_ext.id_parroquia_n.value === '0') {
            swal.fire({ title: 'Debe seleccionar la Parroquia de la Dirección Fiscal', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.id_parroquia_n.focus(); return 0;
        }
        if (document.sav_ext.direccion_fiscal.value.length === 0) {
            swal.fire({ title: 'Debe ingresar la Dirección Fiscal Completa', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.direccion_fiscal.focus(); return 0;
        }
        if (document.sav_ext.rifadscrito.value.length === 0) {
            swal.fire({ title: 'Debe ingresar el RIF del Órgano/Ente de Adscripción', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.rifadscrito.focus(); return 0;
        }
        if (document.sav_ext.nameadscrito.value.length === 0) {
            swal.fire({ title: 'Debe ingresar el Nombre del Órgano/Ente de Adscripción', type: 'warning' }).then(() => { resetRecaptcha(); });
            document.sav_ext.nameadscrito.focus(); return 0;
        }
    } else if (rifStatus === 'existe') {
        // --- Campos que NO son obligatorios cuando el RIF ya existe ---
        // (No necesitamos validarlos aquí, ya que no son visibles/editables)
        // Puedes quitar las validaciones comentadas que tenías anteriormente
    }

     if (document.sav_ext.name_max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar Nombre de la máxima autoridad o cuentadante', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.name_max_a_f.focus(); return 0; }
    if (document.sav_ext.cargo__max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar Cargo de la máxima autoridad o cuentadante', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.cargo__max_a_f.focus(); return 0; }
    if (document.sav_ext.cedula__max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar cédula de la máxima autoridad', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.cedula__max_a_f.focus(); return 0; }
    if (document.sav_ext.actoad__max_a_f.value == '0') { // Si es un select
        swal.fire({ title: 'Debe seleccionar el Acto Administrativo de Designación', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.actoad__max_a_f.focus(); return 0; }
    if (document.sav_ext.n__max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar el N° del Acto Administrativo', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.n__max_a_f.focus(); return 0; }
    if (document.sav_ext.fecha__max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar la Fecha del Acto Administrativo', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.fecha__max_a_f.focus(); return 0; }
    if (document.sav_ext.gaceta__max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar la Gaceta del Acto Administrativo', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.gaceta__max_a_f.focus(); return 0; }
    if (document.sav_ext.gfecha__max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar la Fecha de la Gaceta del Acto Administrativo', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.gfecha__max_a_f.focus(); return 0; }

        if (document.sav_ext.name_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar el Nombre del Usuario o Usuaria de la Clave', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.name_f.focus(); return 0; }
    if (document.sav_ext.apellido_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar el Apellido del Usuario o Usuaria de la Clave', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.apellido_f.focus(); return 0; }
    if (document.sav_ext.cedula_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar la Cédula de Identidad del Usuario o Usuaria de la Clave', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.cedula_f.focus(); return 0; }
    if (document.sav_ext.cargo_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar el Cargo del Usuario o Usuaria de la Clave', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.cargo_f.focus(); return 0; }
    if (document.sav_ext.telefono_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar el Teléfono del Usuario o Usuaria de la Clave', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.telefono_f.focus(); return 0; }
    if (document.sav_ext.correo.value.length == 0) {
        swal.fire({ title: 'Debe ingresar el Correo Electrónico del Usuario o Usuaria de la Clave', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.correo.focus(); return 0; }
    // --- FIN Validaciones de campos ---

 var anyCheckboxChecked = false;
    $('#sav_ext .form-section:has(h5:contains("Solicitud de Acceso a los Módulos")) input[type="checkbox"]').each(function() {
        if ($(this).is(':checked')) {
            anyCheckboxChecked = true;
            return false; // Exit the loop early
        }
    });

    if (!anyCheckboxChecked) {
        swal.fire({ title: 'Debe seleccionar al menos un Módulo de Acceso', type: 'warning' }).then(() => { resetRecaptcha(); });
        return 0;
    }
    // Obtener la respuesta de reCAPTCHA JUSTO ANTES de la confirmación de envío
    var recaptcha_response = grecaptcha.getResponse();

    // Validar el reCAPTCHA (si está vacío, porque no se marcó o se reinició)
    if (recaptcha_response.length === 0) {
        swal.fire({
            title: 'Verificación CAPTCHA',
            text: 'Por favor, marque la casilla "No soy un robot".',
            type: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then(() => {
            resetRecaptcha(); // Reinicia el CAPTCHA después de mostrar la advertencia
        });
        return 0; // Detiene la ejecución
    }
    swal
        .fire({
            title: "¿Solicitar?",
            text: "¿Está seguro de enviar la solicitud?, ESTA PLANILLA DEBE REMITIRSE FIRMADA POR LA MAXIMA AUTORIDAD  O CUENTADANTE AL SIGUIENTE CORREO clavesi@snc.gob.ve, números corporativos: 0426-5654730/0426-5654740",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Sí, Descargar!",
        })
        .then((result) => {
    
       


            if (result.value) {
                // var datos = new FormData($("#sav_ext")[0]); esto comente siled
                var datos = new FormData($form[0]);
                 // Añadir el token de reCAPTCHA al FormData
                    datos.append('g-recaptcha-response', recaptcha_response);
                // var base_url = window.location.origin + '/asnc/index.php/User/save_solicitud';
                // var base_url_pdf_download = window.location.origin + '/asnc/index.php/Solicitud/pdfrt?id=';
                var base_url = '/index.php/User/save_solicitud';
                var base_url_pdf_download = '/index.php/Solicitud/pdfrt?id=';


                $.ajax({
                url: base_url,
                method: "POST",
                data: datos,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var downloadUrl = base_url_pdf_download + response.id_solicitud;

                        var downloadLink = document.createElement('a');
                        downloadLink.href = downloadUrl;
                        downloadLink.target = '_blank';
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);

                        swal.fire({
                            title: 'Solicitud Exitosa',
                            html: 'ESTA PLANILLA DEBE REMITIRSE FIRMADA POR LA MÁXIMA AUTORIDAD O CUENTADANTE AL SIGUIENTE CORREO clavesi@snc.gob.ve, números corporativos: 0426-5654730/0426-5654740<br>Número de Solicitud: ' + response.id_solicitud + '<br><br>Si la descarga no inicia automáticamente:',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Haga clic aquí para descargar el PDF',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didClose: () => {
                                location.reload();
                            }
                        });

                    } else { // Si el servidor devuelve status 'error'
                        swal.fire({
                            title: 'Error',
                            text: response.message,
                            type: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            resetRecaptcha(); // ¡Importante! Reiniciar el CAPTCHA si el servidor da error de validación
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", xhr.responseText, status, error);
                    swal.fire({
                        title: 'Error de Comunicación',
                        text: 'Hubo un problema al conectar con el servidor. Por favor, inténtelo de nuevo.',
                        type: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        resetRecaptcha(); // ¡Importante! Reiniciar el CAPTCHA si hay un error de comunicación
                    });
                }
            });
        } else {
            // Si el usuario cancela el SweetAlert de confirmación inicial
            resetRecaptcha(); // Reinicia el CAPTCHA si no va a enviar el formulario
        }
    });
}

$(document).ready(function() {
    console.log("Document is ready, attaching blur event to #cedula_f");
    $('#cedula_f').on('blur', fetchUserDetails);
     $('#telefono_f').on('blur', validateTelefonoF); 
     $('#tel_local').on('blur', validateTelefonoF2);  
      $('#correo').on('input', validateEmail);
});