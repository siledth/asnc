let capacitacionCount = 0;
const maxCapacitaciones = 3;
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
        //  var base_url  = window.location.origin+'/asnc/index.php/gestion/consulta_og';
        //  var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

      var base_url = '/index.php/gestion/consulta_og';
        var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

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
//////////////esto es algo de solicitud persona natural

      function validarRIFExperiencia(inputElement, experienciaNum) {
    const rif = inputElement.value;
    const rifError = $(`#rifError_laboral_${experienciaNum}`);
    const consultarBtn = $(`#consultar_rif_laboral_btn_${experienciaNum}`);
    const missingCharsSpan = $(`#missingChars_laboral_${experienciaNum}`);

    if (rif.length === 10 && /^[JGVCEPDWjgvcepdw]\d{9}$/i.test(rif)) { // Agregué /i para insensible a mayúsculas/minúsculas
        rifError.addClass('d-none');
        consultarBtn.prop('disabled', false);
    } else {
        rifError.removeClass('d-none');
        const missingChars = 10 - rif.length;
        missingCharsSpan.text(missingChars > 0 ? missingChars : 0);
        consultarBtn.prop('disabled', true);
    }
}
// Función para consultar el RIF en el backend (ADAPTADA DE TU CONSULTAR_RIF ORIGINAL)
function consultar_rif_experiencia(experienciaNum) {
    // Referencias a elementos específicos de esta experiencia laboral
    const rifInput = $(`#rif_laboral_${experienciaNum}`);
    const existeDiv = $(`#existe_laboral_${experienciaNum}`);
    const noExisteDiv = $(`#no_existe_laboral_${experienciaNum}`);
    const selRifNombre5 = $(`#sel_rif_nombre5_laboral_${experienciaNum}`); // Para el RIF que existe
    const nombreConta5 = $(`#nombre_conta_5_laboral_${experienciaNum}`);   // Para el nombre que existe
    const rif55 = $(`#rif_55_laboral_${experienciaNum}`);                   // Para el RIF si no existe
    const razonSocialNoExiste = $(`#razon_social_laboral_${experienciaNum}`); // Razón Social si no existe
    const telLocalNoExiste = $(`#tel_local_laboral_${experienciaNum}`);
    const direccionFiscalNoExiste = $(`#direccion_fiscal_laboral_${experienciaNum}`);
    const consultarBtn = $(`#consultar_rif_laboral_btn_${experienciaNum}`);

    const rif_b = rifInput.val();

    if (rif_b === '') {
        swal({
            title: "¡ATENCION!",
            text: "El campo RIF no puede estar vacío.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: true // Cambiado a true para que se cierre el swal
        });
        consultarBtn.prop("disabled", true); // Asegura que el botón esté deshabilitado si está vacío
        return; // Detener la ejecución si el campo está vacío
    } else {
        // Deshabilitar botón de consulta y mostrar spinner
        consultarBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Consultando...');
        // Ocultar ambas secciones inicialmente
        existeDiv.hide();
        noExisteDiv.hide();

        // Limpiar campos de ambas secciones
        selRifNombre5.val('');
        nombreConta5.val('');
        rif55.val('');
        razonSocialNoExiste.val('');
        telLocalNoExiste.val('');
        direccionFiscalNoExiste.val('');

        // Rutas base (asegúrate de que sean las correctas para tu entorno CodeIgniter)
        // Puedes usar base_url() de PHP en la vista si está disponible.
        // var base_url_gestion = window.location.origin + '/asnc/index.php/gestion/consulta_og';
        // var base_url_evaluacion = window.location.origin + '/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

      var base_url_gestion = '/index.php/gestion/consulta_og';
      var base_url_evaluacion = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

        // var base_url_gestion = '<?= base_url("gestion/consulta_og") ?>'; // Usa base_url de CI
        // var base_url_evaluacion = '<?= base_url("evaluacion_desempenio/llenar_contratista_rp") ?>'; // Usa base_url de CI

        $.ajax({
            url: base_url_gestion,
            method: 'post',
            data: { rif_b: rif_b },
            dataType: 'json',
            success: function(data) {
                if (data === null || data.error) { // Si no se encuentra en gestion/consulta_og
                    noExisteDiv.show();
                    // Pre-llenar el RIF en la sección "no existe"
                    rif55.val(rif_b);
                    // Hacer requeridos los campos de la sección "no existe"
                    razonSocialNoExiste.prop('required', true);
                    telLocalNoExiste.prop('required', true);
                    direccionFiscalNoExiste.prop('required', true);
                    // Opcional: mostrar un mensaje de que no se encontró
                    // swal("Información", "La institución no se encontró en nuestros registros. Por favor, complete los datos.", "info");

                } else { // Si se encuentra en gestion/consulta_og
                    existeDiv.show();
                    selRifNombre5.val(data['rif']);
                    nombreConta5.val(data['descripcion']);

                    // Deshabilitar/hacer no requeridos los campos de la sección "no existe"
                    razonSocialNoExiste.prop('required', false).val('');
                    telLocalNoExiste.prop('required', false).val('');
                    direccionFiscalNoExiste.prop('required', false).val('');

                    var rif_cont_nr = data['rifced']; // Asumo que esto es lo que necesitas para la segunda consulta
                    var ultprocaprob = data['ultprocaprob']; // Asumo que esto es lo que necesitas para la segunda consulta

                    // SEGUNDA CONSULTA (tu lógica original)
                    $.ajax({
                        url: base_url_evaluacion,
                        method: 'post',
                        data: {
                            ultprocaprob: ultprocaprob,
                            rif_cont_nr: rif_cont_nr
                        },
                        dataType: 'json',
                        success: function(data2) {
                            // Aquí puedes manejar la respuesta de la segunda consulta si es necesario
                            // Por ahora, solo se ejecuta como en tu código original
                            // $.each(data2, function(index, response) { });
                        },
                        error: function(xhr2) {
                            console.error("Error en la segunda consulta AJAX:", xhr2.responseText);
                            // Opcional: Manejar errores de la segunda consulta
                        }
                    });
                }
            },
            error: function(xhr) {
                console.error("Error AJAX al consultar RIF de gestión:", xhr.responseText);
                swal("Error", "Hubo un problema al consultar el RIF. Intente de nuevo.", "error");
                noExisteDiv.show(); // Mostrar sección de no existe para que complete manualmente
                rif55.val(rif_b);
                razonSocialNoExiste.prop('required', true);
                telLocalNoExiste.prop('required', true);
                direccionFiscalNoExiste.prop('required', true);
            },
            complete: function() {
                consultarBtn.prop('disabled', false).html('<i class="fas fa-search"></i> Consultar');
            }
        });
    }
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
function llenar_municipio2(){
    var id_estado_n = $('#id_estado_n1').val();
//    var base_url = window.location.origin+'/asnc/index.php/User/listar_municipio';
    var base_url = '/index.php/User/listar_municipio';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_estado: id_estado_n},
        dataType:'json',

        success: function(response){
            $('#id_municipio_n1').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_municipio_n1').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
            });
        }
    });
}
function llenar_parroquia2(){
    var id_municipio_n = $('#id_estado_n1').val();
//    var base_url = window.location.origin+'/asnc/index.php/User/listar_parroquia';
    var base_url = '/index.php/User/listar_parroquia';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_municipio: id_municipio_n},
        dataType:'json',

        success: function(response){
            $('#id_parroquia_n1').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_parroquia_n1').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
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

// function save() {
//     event.preventDefault();
//     swal
//         .fire({
//             title: "¿Registrar?",
//             text: "¿Esta seguro de enviar la solicitud ",
//             type: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             cancelButtonText: "Cancelar",
//             confirmButtonText: "¡Si, guardar!",
//         })
//         .then((result) => {
//     //  var campos = document.querySelectorAll('#sav_ext input[type="text"]');
//     // for (var i = 0; i < campos.length; i++) {
//     //     // Verifica si el campo es visible
//     //     if (campos[i].offsetWidth > 0 && campos[i].offsetHeight > 0) {
//     //         // Solo valida si el campo es visible
//     //         if (campos[i].value.trim() === '') {
//     //             alert('Por favor, complete todos los campos obligatorios.');
//     //             campos[i].focus();
//     //             return false; // Evita el envío del formulario
//     //         }
//     //     }
//     // }

            
//         //     if (document.sav_ext.rif_b.value.length==0){
//         //        swal.fire({
//         //         title: 'Debe ingresar un RIF',
//         //         type: 'warning',
//         //         showCancelButton: false,
//         //         confirmButtonColor: '#3085d6',
//         //         confirmButtonText: 'Ok'
//         //     }).then((result) => {
//         //         if (result.value == true) {
//         //         }
//         //     });
//         //         document.sav_ext.rif_b.focus()
//         //         return 0;
//         //  } 
//         //    if (document.sav_ext.name_f.value.length==0){
//         //        swal.fire({
//         //         title: 'Debe ingresar Nombre completo del funcionario',
//         //         type: 'warning',
//         //         showCancelButton: false,
//         //         confirmButtonColor: '#3085d6',
//         //         confirmButtonText: 'Ok'
//         //     }).then((result) => {
//         //         if (result.value == true) {
//         //         }
//         //     });
//         //         document.sav_ext.name_f.focus()
//         //         return 0;
//         //  } 
//         //       if (document.sav_ext.name_f.value.length==0){
//         //        swal.fire({
//         //         title: 'Debe ingresar Nombre completo del funcionario',
//         //         type: 'warning',
//         //         showCancelButton: false,
//         //         confirmButtonColor: '#3085d6',
//         //         confirmButtonText: 'Ok'
//         //     }).then((result) => {
//         //         if (result.value == true) {
//         //         }
//         //     });
//         //         document.sav_ext.name_f.focus()
//         //         return 0;
//         //  } 
           
            
//             if (result.value == true) {
//                 event.preventDefault();
//                 var datos = new FormData($("#sav_ext")[0]);
//                  var base_url = window.location.origin+'/asnc/index.php/User/save_solicitud';
//                  var base_url_3 = window.location.origin+'/asnc/index.php/Pdfcerti_miem/pdfrt?id=';

// console.log(base_url_3);
//                 // var base_url =
//                 //     window.location.origin +
//                 //     "/asnc/index.php/Mensualidades/guardar_proc_pag";
//                 // var base_url_2 =
//                 //     window.location.origin + "/marina/index.php/Mensualidades/ver";
//                     // var base_url_3 =
//                     // window.location.origin + "/marina/index.php/Mensualidades/verPago?id=";
//                 $.ajax({
//                     url: base_url,
//                     method: "POST",
//                     data: datos,
//                     contentType: false,
//                     processData: false,
//                     success: function(response) {
//                         var menj = 'Numero de Solicitud: ';
                        
//                         if(response != '') {
//                             swal.fire({
//                                 title: 'Registro Exitoso ',
//                                 text: menj + response,
//                                 type: 'success',
//                                 showCancelButton: false,
//                                 confirmButtonColor: '#3085d6',
//                                 confirmButtonText: 'Ok'
//                             }).then((result) => {
//                                 if (result.value == true){
//                                     window.location.href = base_url_3 + response;
//                                 }
//                             });
//                         }
//                     },
//                 });
//             }
//         });
// }
function save(event) {
    event.preventDefault();
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
if (document.sav_ext.rif_b.value.length==0){
        swal.fire({
            title: 'No Puede dejar campo rif, ingrese un valor',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.rif_b.focus()
        return 0;
       }
         if (document.sav_ext.rifadscrito.value.length==0){
        swal.fire({
            title: 'Debe ingresar RIF Órgano/Ente de Adscripción',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.rifadscrito.focus()
        return 0;
       }
       if (document.sav_ext.nameadscrito.value.length==0){
        swal.fire({
            title: 'Debe ingresar Nombre Órgano/Ente de Adscripción',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.nameadscrito.focus()
        return 0;
       }
      if (document.sav_ext.cod_onapre.value.length==0){
        swal.fire({
            title: 'Debe ingresar Código ONAPRE',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.cod_onapre.focus()
        return 0;
       }
        if (document.sav_ext.siglas.value.length==0){
        swal.fire({
            title: 'Debe ingresar Siglas',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.siglas.focus()
        return 0;
       }
       if (document.sav_ext.tel_local.value.length==0){
        swal.fire({
            title: 'Debe ingresar telefono de contacto',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.tel_local.focus()
        return 0;
       }
        if (document.sav_ext.pag_web.value.length==0){
        swal.fire({
            title: 'Debe ingresar pagina web de contacto',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.pag_web.focus()
        return 0;
       }
      
         if (document.sav_ext.name_max_a_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar Nombre de la maxima autorida o cuentadante',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.name_max_a_f.focus()
        return 0;
       }
    if (document.sav_ext.cargo__max_a_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar Cargo de la maxima autorida o cuentadante',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.cargo__max_a_f.focus()
        return 0;
       }
       if (document.sav_ext.name_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar nombre funcionario',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.name_f.focus()
        return 0;
       }
       
        if (document.sav_ext.apellido_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar Apellido del funcionario',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.apellido_f.focus()
        return 0;
       }
         if (document.sav_ext.cedula_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar cedula de identidad del funcionario',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.cedula_f.focus()
        return 0;
       }
       if (document.sav_ext.cargo_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar cargo del funcionario',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.cargo_f.focus()
        return 0;
       }
         if (document.sav_ext.telefono_f.value.length==0){
        swal.fire({
            title: 'No Puede dejar campo telefono, ingrese un valor',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.telefono_f.focus()
        return 0;
       }
        if (document.sav_ext.correo.value.length==0){
        swal.fire({
            title: 'No Puede dejar campo correo, ingrese un valor',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.correo.focus()
        return 0;
       }
       


            if (result.value) {
                var datos = new FormData($("#sav_ext")[0]);
                // var base_url = window.location.origin + '/asnc/index.php/User/save_solicitud';
                // var base_url_3 = window.location.origin + '/asnc/index.php/Solicitud/pdfrt?id=';
                var base_url = '/index.php/User/save_solicitud';
                var base_url_3 = '/index.php/Solicitud/pdfrt?id=';


                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log("ID de la solicitud:", response); // Verifica el ID
                        if (response) {
                            swal.fire({
                                title: 'Solicitud Exitosa, ESTA PLANILLA DEBE REMITIRSE FIRMADA POR LA MAXIMA AUTORIDAD  O CUENTADANTE AL SIGUIENTE CORREO clavesi@snc.gob.ve, números corporativos: 0426-5654730/0426-5654740',
                                text: 'Número de Solicitud: ' + response,
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'LA DESCARGA DEBIO INICIAR, SINO DAR CLIC AQUI'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = base_url_3 + response; // Redirige a la URL generada
                                }
                            });
                              setTimeout(function() {
                                window.location.href = base_url_3 + response; // Redirige a la URL generada
                            }, 2000); // 2000 milisegundos = 2 segundos
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la solicitud:", error);
                        swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al guardar la solicitud.',
                            type: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                    }
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

    function showAlert() {
        Swal.fire({
            title: 'Debe ingresar un correo institucional, para continuar',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        });
    }




      function llenar_() {
      
        var factura = $("#trabajo").val();
        if (factura <= "1") {
            $("#campos7").show();
        } else {
            $("#campos7").hide();
        }
        }

           function llenar_2() {
      
        var factura = $("#t_contrata_p").val();
        if (factura <= "1") {
            $("#cmp1").show();
        } else {
            $("#cmp1").hide();
        }
        }

 
function llenar_3() {
    var seleccion = $("#t_contrata_p").val();
    if (seleccion == "1") {
        $("#cmp1").show();
    } else {
        $("#cmp1").hide();
        $("#experiencia_publicas").val("");
    }
}
    
    
    
   
 
  function loadDiplomadoInfo(idDiplomado) {
            if(idDiplomado == 0) {
                $('#diplomadoInfoContainer').hide();
                return;
            }
        // var base_url = window.location.origin+'/asnc/index.php/diplomado/getDiplomadoInfo/' + idDiplomado;
        var base_url = '/index.php/diplomado/getDiplomadoInfo/' + idDiplomado;
            
            $.ajax({
                url: base_url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        $('#diplomadoTitle').text(response.data.name_d);
                        $('#diplomadoFechaInicio').text(formatDate(response.data.fdesde));
                        $('#diplomadoFechaFin').text(formatDate(response.data.fhasta));
                        $('#diplomadoModalidad').text(getModalidadText(response.data.id_modalidad));
                         $('#diplomadoM').text(response.data.pay);

                        
                        // Calcular duración
                        const fechaInicio = new Date(response.data.fdesde);
                        const fechaFin = new Date(response.data.fhasta);
                        const diffTime = Math.abs(fechaFin - fechaInicio);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                        
                        $('#diplomadoDuracion').text(diffDays + ' días');
                        
                        $('#diplomadoInfoContainer').show();
                    } else {
                        alert('Error al cargar la información del diplomado');
                        $('#diplomadoInfoContainer').hide();
                    }
                },
                error: function() {
                    alert('Error en la conexión con el servidor');
                    $('#diplomadoInfoContainer').hide();
                }
            });
        }
        
        // Función para formatear fechas
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }
        
        // Función para obtener el texto de la modalidad
        function getModalidadText(idModalidad) {
            const modalidades = {
                1: 'Presencial',
                2: 'Virtual',
                3: 'Bimodal'
                // Agrega más modalidades según corresponda
            };
            return modalidades[idModalidad] || 'No especificado';
        }

    
    // Validar que el importe no sea mayor al total
    $('#importe').on('change', function() {
        const total = parseFloat($('#total_iva').val()) || 0;
        const importe = parseFloat($(this).val()) || 0;
        
        if(importe > total) {
            alert('El importe cancelado no puede ser mayor al total a pagar');
            $(this).val(total.toFixed(2));
        }
    });

//     function verificarPago() {
//     if($('#tipo_pago').val() != 1) {
//         alert('Esta función solo aplica para pagos al contado');
//         return;
//         }

//     // Validar campos obligatorios
//     const camposRequeridos = ['total_pago', 'bancoOrigen', 'cedulaPagador', 'telefonoPagador', 'referencia', 'fechaPago', 'importe'];
//     let validacionOk = true;
    
//     camposRequeridos.forEach(campo => {
//         if(!$(`#${campo}`).val()) {
//             $(`#${campo}`).addClass('is-invalid');
//             validacionOk = false;
//         } else {
//             $(`#${campo}`).removeClass('is-invalid');
//         }
//     });
    
//     if(!validacionOk) {
//         alert('Por favor complete todos los campos requeridos');
//         return;
//     }

//     // Mostrar loader
//     $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Verificando pago...');

//     // Preparar datos para enviar
//     const datosPago = {
//         cedulaPagador: $('#cedulaPagador').val(),
//         telefonoPagador: $('#telefonoPagador').val(),
//         telefonoDestino: $('#telefonoDestino').val() || '',
//         referencia: $('#referencia').val(),
//         fechaPago: $('#fechaPago').val(),
//         importe: $('#importe').val(),
//         bancoOrigen: $('#bancoOrigen').val()
//     };
//     //  var base_url = window.location.origin+'/asnc/index.php/diplomado/verificar_pago/';
//        var base_url = '/index.php/diplomado/verificar_pago';

//     // Enviar a tu backend de CodeIgniter
//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         data: datosPago,
//         success: function(response) {
//             if(response.success) {
//                 // Pago verificado correctamente
//                 alert('Pago verificado correctamente. Puede continuar .');
//                 $('#pagoVerificado').val('1'); // Campo oculto para marcar como verificado
//                 $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar ');
//             } else {
//                 // Error en la verificación
//                 alert(response.message || 'Error al verificar el pago: ' + (response.error || ''));
//                 $('#guardar').prop('disabled', true).html('<i class="fas fa-save mr-2"></i>Guardar ');
//             }
//         },
//         error: function(xhr) {
//             alert('Error de conexión con el servidor');
//             $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar ');
//         }
//     });
// }
 function verificarPago() {
    // Limpiar errores previos
    $('.is-invalid').removeClass('is-invalid');
    
    // if($('#tipo_pago').val() >= 1) {
    //     alert('Esta función solo aplica para pagos al contado');
    //     return;
    // }

    // Validar campos obligatorios
    const camposRequeridos = ['bancoOrigen', 'telefonoPagador', 'referencia', 'fechaPago', 'importe'];
    let validacionOk = true;
    
    camposRequeridos.forEach(campo => {
        if(!$(`#${campo}`).val()) {
            $(`#${campo}`).addClass('is-invalid');
            validacionOk = false;
        }
    });
    
    if(!validacionOk) {
        alert('Por favor complete todos los campos requeridos');
        return;
    }

    // Mostrar loader
    $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Verificando pago...');

    // Preparar datos para enviar (usando los mismos nombres que en el ejemplo funcional)
    const datosPago = {
        telefonoPagador: $('#telefonoPagador').val(),
        telefonoDestino: $('#telefonoDestino').val() || '',
        referencia: $('#referencia').val(),
        fechaPago: $('#fechaPago').val(),
        importe: $('#importe').val(),
        bancoOrigen: $('#bancoOrigen').val()
    };
        var base_url = '/index.php/diplomado/verificar_pago';


    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: datosPago,
        success: function(response) {
            if(response.success) {
                alert('Pago verificado correctamente. Puede continuar.');
                $('#pagoVerificado').val('1');
            } else {
                let errorMsg = response.message || 'Error al verificar el pago';
                if (response.code) errorMsg += ` (Código: ${response.code})`;
                if (response.error && typeof response.error === 'object') {
                    errorMsg += '\n' + JSON.stringify(response.error);
                } else if (response.error) {
                    errorMsg += '\n' + response.error;
                }
                alert(errorMsg);
            }
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar');
        },
        error: function(xhr) {
            let errorMsg = 'Error de conexión con el servidor';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            alert(errorMsg);
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar');
        }
    });
}
// function savei(event) {
//     event.preventDefault();
    
//     // 1. Validar pago al contado
//     if($('#tipo_pago').val() == 1 && $('#pagoVerificado').val() != '1') {
//         alert('Debe verificar el pago antes de continuar');
//         verificarPago();
//         return false;
//     }
    
//     // 2. Validación manual de campos requeridos
//     if(!validarFormulario()) {
//         return false;
//     }
    
//     // 3. Mostrar estado de carga
//     $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...');
    
//     // 4. Obtener datos del formulario
//     let formData = {
//         id_inscripcion: $('#id_inscripcion').val(),
//         codigo_planilla: $('#rif_b').val(),
//         importe: $('#importe').val(),
//         fechaPago: $('#fechaPago').val(),
//         referencia: $('#referencia').val(),
//         cedulaPagador: $('#cedulaPagador').val(),
//         telefonoPagador: $('#telefonoPagador').val(),
//         telefonoDestino: $('#telefonoDestino').val(),
//         banco: $('#bancoOrigen').val(),
//         tipo_pago: $('#tipo_pago').val(),
        


//         //banco: $('#banco').val() || null
//     };

//     // 5. Enviar datos por AJAX
//     //  var base_url = window.location.origin + '/asnc/index.php/Diplomado/guardar_pago';
//     //     var base_url2 = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; //redirigir

//        var base_url = '/index.php/Diplomado/guardar_pago';
//         var base_url2 = '/index.php/Diplomado/preinscrip';
        

//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         data: formData,
//         success: function(response) {
//             if(response.success) {
//                 alert('Pago registrado exitosamente');
//                 // Redirigir a comprobante o página de éxito
//                 if(response.pago_id) {
//                      setTimeout(function() {
//         window.location.href = base_url2 ; 
//     }, 1000);
//                     // window.location.href = base_url.replace('guardar_pago', 'comprobante') + '/' + response.pago_id;
//                 }
//             } else {
//                 alert('Error: ' + response.message);
//                 $('#guardar').prop('disabled', false).html('Guardar');
//             }
//         },
//         error: function(xhr, status, error) {
//             alert('Error al conectar con el servidor: ' + error);
//             $('#guardar').prop('disabled', false).html('Guardar');
//         }
//     });
// }

// Función de validación manual completa
function savei(event) {
    event.preventDefault();
    
    // // 1. Validar pago al contado
    if($('#tipo_pago').val() >= 1 && $('#pagoVerificado').val() != '1') {
        alert('Debe verificar el pago antes de continuar');
        verificarPago();
        return false;
    }
    
    // 2. Validación manual de campos requeridos
    if(!validarFormulario()) {
        return false;
    }
    
    // 3. Mostrar estado de carga
    $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...');
    
    // 4. Obtener datos del formulario
    let formData = {
        id_inscripcion: $('#id_inscripcion').val(),
        codigo_planilla: $('#rif_b').val(),

        codigo_planilla: $('#rif_b').val(),
        importe: $('#importe').val(),
        fechaPago: $('#fechaPago').val(),
        referencia: $('#referencia').val(),
        cedulaPagador: $('#cedulaPagador').val(),
        telefonoPagador: $('#telefonoPagador').val(),
        telefonoDestino: $('#telefonoDestino').val(),
        banco: $('#bancoOrigen').val(),
        tipo_pago: $('#tipo_pago').val()
    };

    // 5. Enviar datos por AJAX
    var base_url = '/index.php/Diplomado/guardar_pago';
    var pdf_url = '/index.php/recibonatural/pdfrt?id=' + $('#rif_b').val();

    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(response) {
            if(response.success) {
                alert('Pago registrado exitosamente');
                // Abrir el PDF en una nueva pestaña
               window.location.href = pdf_url;
                
                // Redirigir después de mostrar el PDF
                setTimeout(function() {
                    window.location.href = '/index.php/Diplomado/preinscrip'; 
                }, 1000);
            } else {
                alert('Error: ' + response.message);
                $('#guardar').prop('disabled', false).html('Guardar');
            }
        },
        error: function(xhr, status, error) {
            alert('Error al conectar con el servidor: ' + error);
            $('#guardar').prop('disabled', false).html('Guardar');
        }
    });
}

function validarFormulario() {
    let isValid = true;
    
    // Limpiar errores previos
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    
    // Validar cada campo requerido
    const camposRequeridos = [
        // { id: '#id_inscripcion', nombre: 'ID Inscripción' },
        { id: '#rif_b', nombre: 'Código Planilla' },
        { id: '#importe', nombre: 'Importe', tipo: 'numero', min: 0.01 },
        { id: '#fechaPago', nombre: 'Fecha de Pago', tipo: 'fecha' },
        { id: '#referencia', nombre: 'Referencia' },
        { id: '#cedulaPagador', nombre: 'Cédula Pagador', tipo: 'cedula' },
        { id: '#telefonoPagador', nombre: 'Teléfono Pagador', tipo: 'telefono' }
    ];
    
    camposRequeridos.forEach(campo => {
        // const $element = $(campo.id);
        
        // Verificar si el elemento existe en el DOM
        // if($element.length === 0) {
        //     console.error(`Elemento no encontrado: ${campo.id}`);
        //     mostrarError($(`[name="${campo.id.substring(1)}"]`), `Campo ${campo.nombre} no encontrado`);
        //     isValid = false;
        //     return;
        // }
        
        // Obtener valor y hacer trim solo si existe
        // const valor = $element.val() ? $element.val().trim() : '';
        
        // // Validar campo vacío
        // if(valor === '') {
        //     mostrarError($element, `${campo.nombre} es requerido`);
        //     isValid = false;
        //     return;
        // }
        
        // Validaciones específicas por tipo
        // switch(campo.tipo) {
            // case 'numero':
            //     if(isNaN(valor)) {
            //         mostrarError($element, `${campo.nombre} debe ser un número`);
            //         isValid = false;
            //     } else if(campo.min && parseFloat(valor) < campo.min) {
            //         mostrarError($element, `${campo.nombre} debe ser mayor a ${campo.min}`);
            //         isValid = false;
            //     }
            //     break;
                
            // case 'fecha':
            //     if(!isValidDate(valor)) {
            //         mostrarError($element, 'Fecha inválida (Formato: YYYY-MM-DD)');
            //         isValid = false;
            //     }
            //     break;
                
            // case 'cedula':
            //     if(!/^[VEJPGvejpg]?\d{5,9}$/.test(valor)) {
            //         mostrarError($element, 'Cédula inválida. Ej: V12345678');
            //         isValid = false;
            //     }
            //     break;
                
            // case 'telefono':
            //     if(!/^0[0-9]{10}$/.test(valor)) {
            //         mostrarError($element, 'Teléfono inválido. Ej: 04121234567');
            //         isValid = false;
            //     }
            //     break;
        // }
    });
    
    return isValid;
}
// Función auxiliar para mostrar errores
function mostrarError($element, mensaje) {
    $element.addClass('is-invalid');
    if($element.next('.invalid-feedback').length === 0) {
        $element.after(`<div class="invalid-feedback">${mensaje}</div>`);
    } else {
        $element.next('.invalid-feedback').text(mensaje);
    }
}

// Validar formato de fecha (YYYY-MM-DD)
function isValidDate(dateString) {
    const regEx = /^\d{4}-\d{2}-\d{2}$/;
    if(!dateString.match(regEx)) return false;
    const d = new Date(dateString);
    return !isNaN(d.getTime());
}
 

// function redirectToForm() {
//     const tipoPersona = $('#id_tipop').val();
    
//     if(!tipoPersona) {
//         alert('Por favor seleccione una opción');
//         return;
//     }
    
//     // Configurar el formulario oculto
//     $('#tipo_persona').val(tipoPersona);
//         var base_url = window.location.origin+'/asnc/index.php/Diplomado/solic';
    
//     // Determinar la ruta según la selección
//     let actionUrl = '';
//     if(tipoPersona == '1') {
//         actionUrl = base_url;
//     } else if(tipoPersona == '2') {
//         actionUrl = '<?php echo site_url("solic_juridica"); ?>';
//     }
    
//     console.log('Redirigiendo a:', actionUrl); // Para depuración
    
//     // Configurar y enviar el formulario
//     $('#redirectForm').attr('action', actionUrl);
//     $('#redirectForm').submit();
    
//     // Forzar el envío si es necesario
//     document.getElementById('redirectForm').submit();
// }



 
function redirectToForm() {
    const tipoPersona = $('#id_tipop').val();
    
    if(!tipoPersona) {
        alert('Por favor seleccione una opción');
        return;
    }
        var base_url = window.location.origin+'/asnc/index.php/Diplomado/solic';
    
    // Crear formulario dinámico
    const form = document.createElement('form');
    form.method = 'POST';
    
    if(tipoPersona == '1') {
        form.action = base_url;
    } else {
        form.action = '<?php echo site_url("solic_juridica"); ?>';
    }
    
    // Agregar campos ocultos
    const tipoField = document.createElement('input');
    tipoField.type = 'hidden';
    tipoField.name = 'tipo_persona';
    tipoField.value = tipoPersona;
    form.appendChild(tipoField);
    
    const csrfField = document.createElement('input');
    csrfField.type = 'hidden';
    csrfField.name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    csrfField.value = '<?php echo $this->security->get_csrf_hash(); ?>';
    form.appendChild(csrfField);
    
    // Agregar al documento y enviar
    document.body.appendChild(form);
    form.submit();
}
////////////esto es solicitud de persona juridica
 $(document).ready(function() {

      // Variable para almacenar los cursos disponibles (se llenará vía AJAX)
    let cursosDisponibles = [];

    // Función para cargar los cursos desde el backend
    // Asegúrate de que 'obtener_cursos_json' sea un método público en tu controlador 'Diplomado'
    function cargarCursos() {
        //  var base_url = window.location.origin+'/asnc/index.php/Diplomado/obtener_cursos_json'; //redirigir

       var base_url = '/index.php/Diplomado/obtener_cursos_json';
        //const urlCursos = '<?= base_url("Diplomado/obtener_cursos_json") ?>';
        $.ajax({
            url: base_url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    cursosDisponibles = response.cursos;
                    console.log('Cursos cargados:', cursosDisponibles); // Para depuración
                    // Si ya hay capacitaciones en el DOM (ej. si se recarga la página con datos previos),
                    // asegúrate de que sus selects se llenen correctamente.
                    // Esto es útil si el formulario se renderiza con datos ya existentes.
                    $('.curso-select').each(function() {
                        const currentSelect = $(this);
                        const selectedValue = currentSelect.val();
                        let optionsHtml = '<option value="">Seleccione un curso</option>';
                        cursosDisponibles.forEach(curso => {
                            optionsHtml += `<option value="${curso.id_cursos}">${curso.descripcion_cursos}</option>`;
                        });
                        currentSelect.html(optionsHtml); // Rellenar las opciones

                        // Re-seleccionar el valor si ya existía
                        if (selectedValue) {
                            currentSelect.val(selectedValue);
                            // Y disparar el evento change para mostrar/ocultar el campo "Otros"
                            currentSelect.trigger('change');
                        }
                    });
                } else {
                    console.error('Error al cargar los cursos:', response.message);
                    alert('No se pudieron cargar los cursos disponibles. Por favor, intente de nuevo.');
                }
            },
            error: function(xhr) {
                console.error('Error AJAX al cargar cursos:', xhr.responseText);
                alert('Hubo un problema de conexión al cargar los cursos.');
            }
        });
    }

    // Llama a la función para cargar los cursos al inicio, una vez que el DOM esté listo
    cargarCursos();

            // Contador de capacitaciones
            
            let capacitacionCount = 0;
            const maxCapacitaciones = 3;

            // Mostrar/ocultar sección de capacitaciones según selección
            $('#tiene_capacitacion').change(function() {
                if ($(this).val() === '1') {
                    $('#capacitaciones-container').show();
                    // Agregar primera capacitación automáticamente
                    if (capacitacionCount === 0) {
                        agregarCapacitacion();
                    }
                } else {
                    $('#capacitaciones-container').hide();
                    // Limpiar capacitaciones si selecciona "No"
                    $('#lista-capacitaciones').empty();
                    capacitacionCount = 0;
                }
            });

            // Agregar nueva capacitación
            $('#btn-add-capacitacion').click(function() {
                if (capacitacionCount < maxCapacitaciones) {
                    agregarCapacitacion();
                } else {
                    alert('Solo puede agregar hasta ' + maxCapacitaciones + ' capacitaciones.');
                }
            });

            // Función para agregar un nuevo formulario de capacitación
    function agregarCapacitacion() {
        if (capacitacionCount >= maxCapacitaciones) return;

        capacitacionCount++;
        const newId = 'capacitacion-' + capacitacionCount;

        // Construye las opciones para el select de cursos
        let optionsHtml = '<option value="">Seleccione un curso</option>';
        cursosDisponibles.forEach(curso => {
            optionsHtml += `<option value="${curso.id_cursos}">${curso.descripcion_cursos}</option>`;
        });

        const html = `
            <div class="capacitacion-item" id="${newId}">
                <h6>Capacitación #${capacitacionCount}</h6>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="id_curso_${capacitacionCount}" class="required-field">Nombre del Curso</label>
                        <select id="id_curso_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][id_curso]" class="form-control curso-select" required>
                            ${optionsHtml}
                        </select>
                    </div>

                    <div class="col-md-4 form-group" id="otros_cursos_container_${capacitacionCount}" style="display: none;">
                        <label for="nombre_curso_otro_${capacitacionCount}" class="required-field">Especifique el Curso</label>
                        <input type="text" id="nombre_curso_otro_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][nombre_curso_otro]" class="form-control">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="institucion_${capacitacionCount}" class="required-field">Institución Formadora</label>
                        <input type="text" id="institucion_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][institucion]" class="form-control" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="anio_${capacitacionCount}" class="required-field">Año de Realización</label>
                        <input type="number" id="anio_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][anio]" class="form-control" min="1900" max="${new Date().getFullYear()}" required>
                    </div>
                     <div class="col-md-4 form-group">
                        <label for="horas${capacitacionCount}" class="required-field">Total Horas Académicas</label>
                        <input type="number" id="horas${capacitacionCount}" name="capacitaciones[${capacitacionCount}][horas]" class="form-control" min="1900" max="${new Date().getFullYear()}" required>
                    </div>
                </div>

                ${capacitacionCount > 1 ? `
                <button type="button" class="btn btn-danger btn-sm btn-remove-capacitacion" onclick="eliminarCapacitacion('${newId}')">
                    <i class="fas fa-trash mr-1"></i>Eliminar esta capacitación
                </button>
                ` : ''}
                <hr> </div>
        `;

        $('#lista-capacitaciones').append(html);

        // Agrega el evento change para el select de curso recién añadido
        $(`#id_curso_${capacitacionCount}`).on('change', function() {
            const selectedValue = $(this).val();
            const currentCapacitacionNum = $(this).attr('id').replace('id_curso_', '');
            // El ID '8' es el que tienes para "Otros" en tu tabla diplomado.cursos
            if (selectedValue === '8') {
                $(`#otros_cursos_container_${currentCapacitacionNum}`).show();
                $(`#nombre_curso_otro_${currentCapacitacionNum}`).prop('required', true);
            } else {
                $(`#otros_cursos_container_${currentCapacitacionNum}`).hide();
                $(`#nombre_curso_otro_${currentCapacitacionNum}`).prop('required', false).val(''); // Limpia y hace no requerido
            }
        });


        // Ocultar botón de agregar si llegamos al máximo
        if (capacitacionCount >= maxCapacitaciones) {
            $('#btn-add-capacitacion').hide();
        }
    }

        /////////////esperiencia laboral
  

             // Contador de experiencias laborales
     let experienciaCount = 0;
    const maxExperiencias = 3;

    // Obtener la fecha actual en formato YYYY-MM-DD para la validación de fecha 'Hasta'
    const today = new Date();
    const year = today.getFullYear();
    const month = (today.getMonth() + 1).toString().padStart(2, '0'); // Meses son 0-index
    const day = today.getDate().toString().padStart(2, '0');
    const maxDate = `${year}-${month}-${day}`;

    // Mostrar/ocultar sección de experiencia laboral según selección
    $('#tiene_experiencia_laboral').change(function() {
        if ($(this).val() === '1') {
            $('#experiencia-laboral-container').show();
            // Agregar primera experiencia laboral automáticamente si no hay ninguna
            if (experienciaCount === 0) {
                agregarExperienciaLaboral();
            }
        } else {
            $('#experiencia-laboral-container').hide();
            // Limpiar experiencias laborales si selecciona "No"
            $('#lista-experiencias').empty();
            experienciaCount = 0;
        }
    });

    // Agregar nueva experiencia laboral
    $('#btn-add-experiencia').click(function() {
        if (experienciaCount < maxExperiencias) {
            agregarExperienciaLaboral();
        } else {
            alert('Solo puedes agregar hasta ' + maxExperiencias + ' experiencias laborales.');
        }
    });

    // Función para agregar un nuevo formulario de experiencia laboral
    function agregarExperienciaLaboral() {
        if (experienciaCount >= maxExperiencias) return;

        experienciaCount++;
        const newId = 'experiencia-' + experienciaCount;

        const html = `
            <div class="experiencia-item" id="${newId}">
                <h6>Experiencia Laboral #${experienciaCount}</h6>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="cargo_laboral_${experienciaCount}" class="required-field">Cargo Desempeñado</label>
                        <input type="text" id="cargo_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][cargo]" class="form-control" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="tiempo_cargo_${experienciaCount}" class="required-field">Tiempo en el Cargo (años)</label>
                        <input type="number" id="tiempo_cargo_${experienciaCount}" name="experiencias[${experienciaCount}][tiempo_cargo]" class="form-control" min="0" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="desde_laboral_${experienciaCount}" class="required-field">Fecha de Inicio</label>
                        <input type="date" id="desde_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][desde]" class="form-control" required>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="hasta_laboral_${experienciaCount}" class="required-field">Fecha de Fin</label>
                        <input type="date" id="hasta_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][hasta]" class="form-control" max="${maxDate}" required>
                    </div>
                </div>

                <div class="card p-3 mt-3">
                    <h6>Datos de la Institución donde Laboró</h6>
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label for="rif_laboral_${experienciaCount}" class="required-field">RIF de la Institución</label>
                            <input class="form-control" type="text" name="experiencias[${experienciaCount}][rif_institucion]"
                                id="rif_laboral_${experienciaCount}" placeholder="J123456789" maxlength="10"
                                oninput="validarRIFExperiencia(this, ${experienciaCount})" required>
                            <small id="rifError_laboral_${experienciaCount}" class="text-danger d-none">
                                El RIF debe tener <span id="missingChars_laboral_${experienciaCount}">10</span> caracteres exactos (Ej: J123456789)
                            </small>
                            <div class="invalid-feedback">Debe ingresar el RIF de la institución</div>
                        </div>
                        <div class="col-md-4 form-group d-flex align-items-end">
                            <button type="button" class="btn btn-default w-100" onclick="consultar_rif_experiencia(${experienciaCount})"
                                id="consultar_rif_laboral_btn_${experienciaCount}" disabled>
                                <i class="fas fa-search"></i> Consultar
                            </button>
                        </div>
                    </div>

                    <div id='existe_laboral_${experienciaCount}' style="display: none;">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle mr-2"></i>La institución está registrada en nuestro sistema.
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>RIF del Órgano / Ente</label>
                                <input class="form-control" type="text" name="experiencias[${experienciaCount}][rif_existente]"
                                    id="sel_rif_nombre5_laboral_${experienciaCount}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nombre del Órgano / Ente</label>
                                <input type="text" name="experiencias[${experienciaCount}][razon_social_existente]"
                                    id="nombre_conta_5_laboral_${experienciaCount}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div id='no_existe_laboral_${experienciaCount}' style="display: none;">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Complete los datos de la institución.
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="rif_55_laboral_${experienciaCount}"><i
                                        class="fas fa-question-circle text-danger mr-1"></i>RIF</label>
                                <input type="text" class="form-control"
                                    onKeyUp="this.value=this.value.toUpperCase();" name="experiencias[${experienciaCount}][rif_nuevo]"
                                    id="rif_55_laboral_${experienciaCount}" placeholder="Ej: J123456789"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                            </div>
                            <div class="col-md-8 form-group">
                                <label for="razon_social_laboral_${experienciaCount}" class="required-field">Razón Social</label>
                                <input id="razon_social_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][razon_social_nueva]" class="form-control"
                                    placeholder="Nombre completo de la institución">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="tel_local_laboral_${experienciaCount}" class="required-field">Teléfono Local</label>
                                <input type="number" id="tel_local_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][tel_local_nuevo]" class="form-control"
                                    placeholder="Ej: 02121234567">
                                <p id="errorMsg_laboral_${experienciaCount}" class="text-danger"></p>
                            </div>
                            <div class="col-md-8 form-group">
                                <label for="direccion_fiscal_laboral_${experienciaCount}" class="required-field">Dirección Completa</label>
                                <textarea class="form-control" id="direccion_fiscal_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][direccion_fiscal_nueva]"
                                    rows="3" placeholder="Ej: Av. Principal, Edificio XYZ, Piso 3, Oficina 301"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <div class="form-check">
                        <input class="form-check-input es-actual-checkbox" type="checkbox" value="1"
                            id="es_actual_${experienciaCount}" name="experiencias[${experienciaCount}][es_actual]">
                        <label class="form-check-label" for="es_actual_${experienciaCount}">
                            ¿Es su empleo actual? (Esta será la empresa asociada a su inscripción)
                        </label>
                    </div>
                </div>

                ${experienciaCount > 1 ? `
                <button type="button" class="btn btn-danger btn-sm btn-remove-experiencia" onclick="eliminarExperienciaLaboral('${newId}')">
                    <i class="fas fa-trash mr-1"></i>Eliminar esta experiencia
                </button>
                ` : ''}
                <hr>
            </div>
        `;

        $('#lista-experiencias').append(html);

        // Agrega el evento change para el checkbox "Es su empleo actual?"
        $(`#es_actual_${experienciaCount}`).on('change', function() {
            if ($(this).is(':checked')) {
                // Desmarca y "resetea" otros checkboxes si solo se permite un empleo actual
                // .not(this) asegura que no se desmarque a sí mismo
                // .trigger('change') asegura que la lógica de mostrar/ocultar de otros checkboxes se ejecute
                $('.es-actual-checkbox').not(this).prop('checked', false).trigger('change');
            }
        });

        // Habilita el botón de consulta de RIF inicialmente si el RIF ya está validado
        // (Esto es útil si precargas datos o si el usuario escribe y luego el campo se "autovalida")
        const rifInput = $(`#rif_laboral_${experienciaCount}`);
        validarRIFExperiencia(rifInput[0], experienciaCount);
    }

    // Asegúrate de que eliminarCapacitacion y eliminarExperienciaLaboral estén fuera
    // o que las variables capacitacionCount/experienciaCount sean globales.
    // Para este ejemplo, asumiremos que están dentro del ready y ajustaremos
    // el acceso a los contadores en las funciones de eliminación.
});

        // Función para eliminar una capacitación (definida en ámbito global)
      // Función para eliminar una capacitación (DEBE ESTAR FUERA DEL $(document).ready para ser accesible globalmente por el onclick)
function eliminarCapacitacion(id) {
    $('#' + id).remove();

    // Reorganizar los números de las capacitaciones restantes
    const items = $('.capacitacion-item');
    capacitacionCount = items.length; // Asegúrate de que capacitacionCount sea global o pasada como argumento

    items.each(function(index) {
        const newNum = index + 1;
        $(this).find('h6').text('Capacitación #' + newNum);

        // Actualizar los IDs y names de los inputs
        $(this).find('input, select').each(function() {
            const oldName = $(this).attr('name');
            if (oldName) {
                const newName = oldName.replace(/capacitaciones\[\d+\]/,
                    `capacitaciones[${newNum}]`);
                $(this).attr('name', newName);
            }

            const oldId = $(this).attr('id');
            if (oldId) {
                const newId = oldId.replace(/_(\d+)_/, `_${newNum}_`);
                $(this).attr('id', newId);
            }
        });
    });

    // Mostrar botón de agregar si no estamos en el máximo
    if (capacitacionCount < maxCapacitaciones) { // Asegúrate de que maxCapacitaciones sea global o pasada como argumento
        $('#btn-add-capacitacion').show();
    }
}

        // Función para eliminar una experiencia laboral (definida en ámbito global)
   // Función para eliminar una experiencia laboral (adaptada)
function eliminarExperienciaLaboral(id) {
    $('#' + id).remove();
    // Vuelve a calcular el count después de eliminar
    const experienciaCount = $('#lista-experiencias .experiencia-item').length;
    $('.experiencia-item').each(function(index) {
        const newNum = index + 1;
        const oldIdPrefix = $(this).attr('id').match(/experiencia-(\d+)/)[1]; // Obtener el número original del ID
        const currentItem = $(this);

        currentItem.attr('id', 'experiencia-' + newNum);
        currentItem.find('h6').text('Experiencia Laboral #' + newNum);

        currentItem.find('input, select, textarea').each(function() {
            const oldName = $(this).attr('name');
            if (oldName) {
                // Regex para reemplazar el número de la experiencia en el name del array
                const newName = oldName.replace(`experiencias[${oldIdPrefix}]`, `experiencias[${newNum}]`);
                $(this).attr('name', newName);
            }
            const oldId = $(this).attr('id');
            if (oldId) {
                // Regex para reemplazar el número de la experiencia en el ID
                const newId = oldId.replace(new RegExp(`_(${oldIdPrefix})$`), `_${newNum}`);
                $(this).attr('id', newId);
            }
        });
        // Si hay botones de eliminar, actualizar su onclick
        currentItem.find('.btn-remove-experiencia').attr('onclick', `eliminarExperienciaLaboral('experiencia-${newNum}')`);

        // Re-adjuntar el evento change para el checkbox "Es su empleo actual?"
        $(`#es_actual_${newNum}`).off('change').on('change', function() {
            if ($(this).is(':checked')) {
                $('.es-actual-checkbox').not(this).prop('checked', false).trigger('change');
            }
        });

        // Re-adjuntar el evento oninput y onclick para la validación/consulta de RIF
        $(`#rif_laboral_${newNum}`).off('input').on('input', function() {
            validarRIFExperiencia(this, newNum);
        });
        $(`#consultar_rif_laboral_btn_${newNum}`).off('click').on('click', function() {
            consultar_rif_experiencia(newNum);
        });
    });
    // Si el contador es menor que el máximo, mostrar el botón de añadir
    if (experienciaCount < 3) { // Asume maxExperiencias = 3
        $('#btn-add-experiencia').show();
    }
}
function Inscribir(event) {
    event.preventDefault();
    // Al inicio del archivo solicitud.js
  // Calcular el número de capacitaciones dinámicamente
    const capacitacionCount = $('#lista-capacitaciones .capacitacion-item').length;
    // Calcular el número de experiencias laborales dinámicamente
    const experienciaCount = $('#lista-experiencias .experiencia-item').length;

    // Validar campos obligatorios base
    const requiredFields = [
        'id_diplomado', 'cedula_f', 'name_f', 'apellido_f', 
        'telefono_f', 'direccion_fiscal_', 'trabajo'
    ];
    
    let isValid = true;
    
    // Reset validaciones
    $('.is-invalid').removeClass('is-invalid');
    
    // Validar campos requeridos
    requiredFields.forEach(field => {
        const element = $(`[name="${field}"]`);
        if (!element.val()) {
            element.addClass('is-invalid');
            isValid = false;
        }
    });
     
    // Validar si tiene capacitación pero no ha agregado ninguna
    if ($('#tiene_capacitacion').val() === '1' && capacitacionCount === 0) {
        alert('Debe agregar al menos una capacitación relacionada con Contrataciones Públicas.');
        isValid = false;
    }
     // Validar si tiene experiencia laboral pero no ha agregado ninguna
    if ($('#tiene_experiencia_laboral').val() === '1' && experienciaCount === 0) {
        alert('Debe agregar al menos una experiencia laboral.');
        isValid = false;
    }
    
    
    // Validar email si está presente
    if ($('#correo').val() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($('#correo').val())) {
        $('#correo').addClass('is-invalid');
        isValid = false;
    }
    
    
     if ($('#trabajo').val() == '1') {
        const rifIngresado = $('#rif_b').val();
        const rifExistente = $('#sel_rif_nombre5').val();
        
        if (!rifIngresado && !rifExistente) {
            $('#rif_b').addClass('is-invalid');
            isValid = false;
        } else if (!rifExistente && $('#no_existe').is(':visible')) {
            // Validar solo si no hay RIF existente y está visible no_existe
            const requiredEmpresa = [
                'razon_social', 'tel_local', 'id_estado_n',
                'id_municipio_n', 'id_parroquia_n', 'direccion_fiscal'
            ];
            
            requiredEmpresa.forEach(field => {
                const element = $(`[name="${field}"]`);
                if (!element.val()) {
                    element.addClass('is-invalid');
                    isValid = false;
                }
            });
        }
    }
    
    if (!isValid) {
        alert('Por favor complete todos los campos requeridos correctamente');
        return;
    }
    
    // Mostrar loader
    $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Guardando...');
        // var base_url = window.location.origin+'/asnc/index.php/Diplomado/guardar_inscripcion';//guardar
        // var base_url2 = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; //redirigir
        // var base_url3 = window.location.origin+'/asnc/index.php/Preinscripcionnatural/pdfrt?id=';//ver la planilla despues de guardar
// Preparar datos para enviar
        var base_url = '/index.php/Diplomado/guardar_inscripcion';
        var base_url2 = '/index.php/Diplomado/preinscrip';
        var base_url3 = '/index.php/Preinscripcionnatural/pdfrt?id=';
         
    
    // Enviar datos
    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: $('#sav_ext').serialize(),
        success: function(response) {
            if (response.success) {
                alert('Inscripción registrada con éxito. Código: ' + response.codigo);
                // Redirigir o limpiar formulario
                var link = document.createElement('a');
           var pdfUrl = base_url3 + response.codigo; // URL completa para el PDF
            var link = document.createElement('a');
            link.href = pdfUrl;
           //link.download = 'inscripcion_' + response.codigo ;
            // link.download = 'inscripcion_' + response.codigo + '.pdf';

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
    
    // Redirigir después de 2 segundos
    setTimeout(function() {
        window.location.href = base_url2 ; // Asegúrate que esta sea la ruta correcta
    }, 1000);
            } else {
                alert('Error: ' + response.message);
            }
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Inscripción');
        },
        error: function(xhr) {
            alert('Error en la conexión con el servidor');
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Inscripción');
        }
    });
}
///////////////////persona juridica fin 
// function Consultarplanilla(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
//     var rif_b = $('#rif_b').val();
//     if (rif_b == ''){
//         swal({
//             title: "¡ATENCION!",
//             text: "El campo no puede estar vacio.",
//             type: "warning",
//             showCancelButton: false,
//             confirmButtonColor: "#00897b",
//             confirmButtonText: "CONTINUAR",
//             closeOnConfirm: false
//         }, function(){
//             swal("Deleted!", "Your imaginary file has been deleted.", "success");
//         });
//         $('#ueba').attr("disabled", true);
//     }else{
//         $("#items").show();
//         var base_url  = window.location.origin+'/asnc/index.php/Diplomado/consulta_og';
//        // var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

//     //   var base_url = '/index.php/gestion/consulta_og';
//     //     var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

//         $.ajax({
//             url:base_url,
//             method: 'post',
//             data: {rif_b: rif_b},
//             dataType: 'json',
//             success: function(data){
//                 if (data == null) {
//                     $("#no_existe").show();
//                     $("#existe").hide();

//                    // $('#exitte').val(0);

//                 }else{
//                     $("#existe").show();
//                     $("#no_existe").hide();                  

//                     $('#total_pago').val(data['pay']);
//                     $('#fecha_limite_pago').val(data['fecha_limite_pago']);
                    

                    
                     
//                 }
//             }
//         })
//     }
// }

function Consultarplanilla() {
    var rif_b = $('#rif_b').val();
    
    if (!rif_b) {
        swal("¡ATENCION!", "El campo no puede estar vacío.", "warning");
        return;
    }

    // Mostrar loader mientras se consulta
    $('#loading').show();
    $("#existe").hide();
    $("#no_existe").hide();
        // var base_url = '/index.php/Diplomado/consulta_og';
        // var base_url = window.location.origin+'/asnc/index.php/Diplomado/consulta_og';
       var base_url = '/index.php/Diplomado/consulta_og';


    base_url
    $.ajax({
        url: base_url,
        
        method: 'POST',
        data: { rif_b: rif_b },
        dataType: 'json',
        success: function(response) {
            console.log("Respuesta del servidor:", response);
            $('#loading').hide();
            
            if (response.success) {
                $("#existe").show();
                $("#no_existe").hide();
                
                if(response.data) {
                    $('#fecha_limite_pago').val(response.data.fecha_limite_pago || '');
                    $('#id_inscripcion').val(response.data.id_inscripcion || '');
                    $('#total_pago').val(response.data.pronto_pago || '');
                    $('#pay').val(response.data.pay || '');
                    $('#codigo_planilla').val(response.data.codigo_planilla || '');

                    // Calcular para contado (total_pago)
                    calcularContado();
                    
                    // Calcular para crédito (pay)
                    calcularCredito();
                }
            } else {
                $("#no_existe").show();
                $("#existe").hide();
                
                // Limpiar todos los campos
                $('#fecha_limite_pago').val('');
                $('#id_inscripcion').val('');
                $('#total_pago').val('');
                $('#codigo_planilla').val('');
                $('#pay').val('');
                
                // Limpiar campos de contado
                $('#iva').val('');
                $('#total_iva').val('');
                
                // Limpiar campos de crédito
                $('#iva_credito').val('');
                $('#total_iva_credito').val('');
                $('#mitad_total_credito').val('');
                
                swal("No encontrado", response.message || 'Planilla no encontrada', "info");
            }
        },
        error: function(xhr) {
            $('#loading').hide();
            console.error("Error en la consulta:", xhr);
            swal("Error", "Ocurrió un error al consultar", "error");
        }
    });
}

// Función para calcular contado (total_pago)
function calcularContado() {
    var totalPagoStr = $('#total_pago').val().replace(/[^0-9.-]/g, '');
    var totalPago = parseFloat(totalPagoStr) || 0;
    
    var iva = totalPago * 0.16;
    var totalConIVA = totalPago + iva;
    
    $('#iva').val(iva.toFixed(2));
    $('#total_iva').val(totalConIVA.toFixed(2));
}

// Función para calcular crédito (pay)
function calcularCredito() {
    // Obtener valor del crédito
    var creditoStr = $('#pay').val().replace(/[^0-9.-]/g, '');
    var credito = parseFloat(creditoStr) || 0;
    
    // Calcular IVA (16%)
    var ivaCredito = credito * 0.16;
    
    // Calcular total con IVA
    var totalConIVACredito = credito + ivaCredito;
    
    // Calcular la mitad del total
    var mitadTotal = totalConIVACredito / 2;
    
    // Mostrar resultados
    $('#iva_credito').val(ivaCredito.toFixed(2));
    $('#total_iva_credito').val(totalConIVACredito.toFixed(2));
    $('#mitad_total_credito').val(mitadTotal.toFixed(2));
}

// Opcional: Escuchar cambios en los campos
$(document).ready(function() {
    $('#total_pago').on('change input', function() {
        calcularContado();
    });
    
    $('#pay').on('change input', function() {
        calcularCredito();
    });
});

 // Función para mostrar/ocultar campos según tipo de pago
 function togglePagoFields() {
    var tipoPago = $('#tipo_pago').val();
    
    $('#prontoPagoField').hide();
    $('#creditoPagoField').hide();
    
    if (tipoPago == '1') { // Pronto Pago
        $('#prontoPagoField').show();
    } else if (tipoPago == '2') { // Crédito
        $('#creditoPagoField').show();
    }
}

function validarRIF(input) {
    const errorElement = document.getElementById('rifError');
    const btnBuscar = document.querySelector('button[onclick="consultar_rif()"]');
    let valor = input.value.toUpperCase().replace(/[^JGV0-9]/g, '');  

    // Validación 1: Primer carácter debe ser J, G o V
    if (valor.length > 0 && !['J', 'G', 'V'].includes(valor[0])) {
        errorElement.textContent = "El RIF debe comenzar con J, G o V";
        errorElement.classList.remove('d-none');
        btnBuscar.disabled = true;
        input.value = valor = valor.replace(/[^JGV]/g, '');  
        return;
    }

    // Validación 2: Longitud exacta de 10 caracteres
    if (valor.length !== 10) {
        const faltantes = 10 - valor.length;
        errorElement.innerHTML = `Faltan <strong>${faltantes}</strong> caracteres (Ej: J123456789)`;
        errorElement.classList.remove('d-none');
        btnBuscar.disabled = true;
        return;
    }

    // Si pasa todas las validaciones:
    errorElement.classList.add('d-none');
    btnBuscar.disabled = false;
    input.value = valor; // Asegura el formato correcto
}

