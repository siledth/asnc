function consultar_rif(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var rif_b = $('#rif_b').val();
    if (rif_b == ''){
        swal({
            title: "¡ATENCION!",
            text: "El campo no puede estar vacio.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#ueba').attr("disabled", true);
    }else{
        $("#items").show();
         var base_url  = window.location.origin+'/asnc/index.php/gestion/consulta_og';
         var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

    //   var base_url = '/index.php/gestion/consulta_og';
    //     var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

        $.ajax({
            url:base_url,
            method: 'post',
            data: {rif_b: rif_b},
            dataType: 'json',
            success: function(data){
                if (data == null) {
                    $("#no_existe").show();
                    $("#existe").hide();

                   // $('#exitte').val(0);

                }else{
                    $("#existe").show();
                    $("#no_existe").hide();                  

                    $('#sel_rif_nombre5').val(data['rif']);
                    $('#nombre_conta_5').val(data['descripcion']);
                    

                    var rif_cont_nr = data['rifced'];
                    var ultprocaprob = data['ultprocaprob'];
                    $.ajax({
                        url:base_url2,
                        method: 'post',
                        data: {ultprocaprob: ultprocaprob,
                              rif_cont_nr: rif_cont_nr},
                        dataType: 'json',
                        success: function(data){
                            $.each(data, function(index, response){
                            });
                        }
                    });
                }
            }
        })
    }
}
function llenar_municipio(){
    var id_estado_n = $('#id_estado_n').val();
   var base_url = window.location.origin+'/asnc/index.php/User/listar_municipio';
    // var base_url = '/index.php/User/listar_municipio';

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
   var base_url = window.location.origin+'/asnc/index.php/User/listar_parroquia';
    // var base_url = '/index.php/User/listar_parroquia';

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
        const guardarButton = document.getElementById('guardar');
        const emailValue = emailInput.value;

        // Expresiones regulares para validar correos de Gmail y Hotmail
        const gmailPattern = /@gmail\.com$/i;
        const hotmailPattern = /@hotmail\.com$/i;

        // Verificar si el correo es de Gmail o Hotmail
        if (gmailPattern.test(emailValue) || hotmailPattern.test(emailValue)) {
            guardarButton.disabled = true; // Deshabilitar el botón
             showAlert(); 
        } else {
            guardarButton.disabled = false; // Habilitar el botón
        }
    }

    var recaptchaWidgetId;




function save(event) {
    event.preventDefault();
    
      // --- Validaciones de campos (del lado del cliente) ---
    // Si alguna validación falla, mostraremos el SweetAlert
    // Y luego REINICIAREMOS el CAPTCHA inmediatamente.

    if (document.sav_ext.rif_b.value.length == 0) {
        swal.fire({ title: 'No Puede dejar campo RIF vacío', text: 'Ingrese un valor.', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.rif_b.focus(); return 0; }
    if (document.sav_ext.rifadscrito.value.length == 0) {
        swal.fire({ title: 'Debe ingresar RIF Órgano/Ente de Adscripción', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.rifadscrito.focus(); return 0; }
    if (document.sav_ext.nameadscrito.value.length == 0) {
        swal.fire({ title: 'Debe ingresar Nombre Órgano/Ente de Adscripción', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.nameadscrito.focus(); return 0; }
    if (document.sav_ext.cod_onapre.value.length == 0) {
        swal.fire({ title: 'Debe ingresar Código ONAPRE', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.cod_onapre.focus(); return 0; }
    if (document.sav_ext.siglas.value.length == 0) {
        swal.fire({ title: 'Debe ingresar Siglas', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.siglas.focus(); return 0; }
    if (document.sav_ext.tel_local.value.length == 0) {
        swal.fire({ title: 'Debe ingresar teléfono de contacto', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.tel_local.focus(); return 0; }
    if (document.sav_ext.pag_web.value.length == 0) {
        swal.fire({ title: 'Debe ingresar página web de contacto', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.pag_web.focus(); return 0; }
    if (document.sav_ext.name_max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar Nombre de la máxima autoridad o cuentadante', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.name_max_a_f.focus(); return 0; }
    if (document.sav_ext.cargo__max_a_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar Cargo de la máxima autoridad o cuentadante', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.cargo__max_a_f.focus(); return 0; }
    if (document.sav_ext.name_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar nombre funcionario', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.name_f.focus(); return 0; }
    if (document.sav_ext.apellido_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar Apellido del funcionario', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.apellido_f.focus(); return 0; }
    if (document.sav_ext.cedula_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar cédula de identidad del funcionario', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.cedula_f.focus(); return 0; }
    if (document.sav_ext.cargo_f.value.length == 0) {
        swal.fire({ title: 'Debe ingresar cargo del funcionario', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.cargo_f.focus(); return 0; }
    if (document.sav_ext.telefono_f.value.length == 0) {
        swal.fire({ title: 'No Puede dejar campo teléfono, ingrese un valor', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.telefono_f.focus(); return 0; }
    if (document.sav_ext.correo.value.length == 0) {
        swal.fire({ title: 'No Puede dejar campo correo, ingrese un valor', type: 'warning' }).then(() => { resetRecaptcha(); });
        document.sav_ext.correo.focus(); return 0; }

    // --- FIN Validaciones de campos ---


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
                var datos = new FormData($("#sav_ext")[0]);
                 // Añadir el token de reCAPTCHA al FormData
                    datos.append('g-recaptcha-response', recaptcha_response);
                var base_url = window.location.origin + '/asnc/index.php/User/save_solicitud';
                var base_url_pdf_download = window.location.origin + '/asnc/index.php/Solicitud/pdfrt?id=';
                // var base_url = '/index.php/User/save_solicitud';
                // var base_url_3 = '/index.php/Solicitud/pdfrt?id=';


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