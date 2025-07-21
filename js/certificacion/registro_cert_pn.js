$(document).ready(function() {
    //para consultar y crear el numero de nro_comprobante
    // var base_url = window.location.origin + "/asnc/index.php/Certificacion/nro_comprobante_pn";
       var base_url = '/index.php/Certificacion/nro_comprobante_pn';

     $.ajax({
        url: base_url,
        method: "post",
        dataType: "json",
        success: function(response) {
            let numero; // Use let for block-scoped variable

            if (response === null) {
                numero = "1";
            } else {
                let numero_c = response["id_comprobante"];
                numero = Number(numero_c) + 1;
            }

            function zeroFill(number, width) {
                width -= number.toString().length;
                if (width > 0) {
                    return (
                        new Array(width + (/\./.test(number) ? 2 : 1)).join("0") + number
                    );
                }
                return number + ""; // siempre devuelve tipo cadena
            }

            // Set the value directly to the correct input field: #nro_comprobantes
            let formattedNumber = zeroFill(numero, 20); // Store the formatted number

            // Now, directly set the value of the 'nro_comprobantes' input
            // and combine it with "PN-" prefix
            let pj = "PN-";
            let finalValue = pj + formattedNumber;

            $("#nro_comprobantes").val(finalValue); // Set the final value here
            
            // If you still need the raw formatted number in a separate element
            // or for debugging, you can use #nro_comprobante if it exists,
            // otherwise, you might not need this line:
            // $("#nro_comprobante").val(formattedNumber); // Only if you have an element with ID "nro_comprobante"
        },
    });
});










function guardar_registro(){
    event.preventDefault();
    swal.fire({
        title: '¿Registrar?',
        text: '¿Esta seguro de Registrar ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {

        if (document.reg_bien.objetivo.value.length==0){
            alert("No Puede dejar el campo Objetivo vacio, Ingrese un Objetivo en el menu Programa del curso o taller")
            document.reg_bien.objetivo.focus()
            return 0;
     }
     if (document.reg_bien.acepto.value.length==0){
        alert("Debe aceptar La Declaración Para Continuar con el Registro, en el menu Declaración")
        document.reg_bien.acepto.focus()
        return 0;
 }

 if (document.reg_bien.n_ref.value.length==0){
    alert("No Puede dejar el campo referencia bancaria vacio, Ingrese un dato")
    document.reg_bien.n_ref.focus()
    return 0;
}
 if (document.reg_bien.fecha_trans.value.length==0){
    alert("No Puede dejar el campo fecha de trasferencia vacio, Ingrese una fecha de trasferencia")
    document.reg_bien.fecha_trans.focus()
    return 0;
    }
if (document.reg_bien.monto_trans.value.length==0){
    alert("No Puede dejar el campo Monto de trasferencia vacio")
    document.reg_bien.monto_trans.focus()
    return 0;
}
// if (document.reg_bien.canon.value.length==0){
//     alert("No Puede dejar el campo canon vacio, Ingrese un canon")
//     document.reg_bien.canon.focus()
//     return 0;
// }
// if (document.reg_bien.fecha_pago.value.length==0){
//     alert("No Puede dejar el campo  fecha Pago, Ingrese un fecha Pago")
//     document.reg_bien.fecha_pago.focus()
//     return 0;
// }


        if (result.value == true) {

            event.preventDefault();
            var datos = new FormData($("#reg_bien")[0]);
            // var base_url  = window.location.origin+'/asnc/index.php/Certificacion/registrar_certificacion_pn';
            //   var base_url_2 = window.location.origin + "/asnc/index.php/Certificacion/Listado_certificacion_exter";

          var base_url = '/index.php/Certificacion/registrar_certificacion_pn';

           var base_url_2 = '/index.php/Certificacion/Listado_certificacion_exter';


            $.ajax({
                url:base_url,
                method: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == 'true') {
                        swal.fire({
                            title: 'Registro Exitoso, En espera Aprobación por Parte del SNC',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                window.location.href = base_url_2;
                            }
                        });
                    }
                }
            })
        }
    });
}



function guardar_registro2(){
    event.preventDefault();
    swal.fire({
        title: '¿Registrar?',
        text: '¿Esta seguro de Registrar ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {

        if (document.reg_bien.objetivo.value.length==0){
            alert("No Puede dejar el campo Objetivo vacio, Ingrese un Objetivo en el menu Programa del curso o taller")
            document.reg_bien.objetivo.focus()
            return 0;
     }
     if (document.reg_bien.acepto.value.length==0){
        alert("Debe aceptar La Declaración Para Continuar con el Registro, en el menu Declaración")
        document.reg_bien.acepto.focus()
        return 0;
 }

 if (document.reg_bien.n_ref.value.length==0){
    alert("No Puede dejar el campo referencia bancaria vacio, Ingrese un dato")
    document.reg_bien.n_ref.focus()
    return 0;
}
 if (document.reg_bien.fecha_trans.value.length==0){
    alert("No Puede dejar el campo fecha de trasferencia vacio, Ingrese una fecha de trasferencia")
    document.reg_bien.fecha_trans.focus()
    return 0;
    }
if (document.reg_bien.monto_trans.value.length==0){
    alert("No Puede dejar el campo Monto de trasferencia vacio")
    document.reg_bien.monto_trans.focus()
    return 0;
}
// if (document.reg_bien.canon.value.length==0){
//     alert("No Puede dejar el campo canon vacio, Ingrese un canon")
//     document.reg_bien.canon.focus()
//     return 0;
// }
// if (document.reg_bien.fecha_pago.value.length==0){
//     alert("No Puede dejar el campo  fecha Pago, Ingrese un fecha Pago")
//     document.reg_bien.fecha_pago.focus()
//     return 0;
// }


        if (result.value == true) {

            event.preventDefault();
            var datos = new FormData($("#reg_bien")[0]);
            // var base_url  = window.location.origin+'/asnc/index.php/Certificacion/registrar_reg_pn';
            //   var base_url_2 = window.location.origin + "/asnc/index.php/Certificacion/Listado_certificacion_interno_contralodira";

          var base_url = '/index.php/Certificacion/registrar_certificacion_pn';

           var base_url_2 = '/index.php/Certificacion/Listado_certificacion_exter';


            $.ajax({
                url:base_url,
                method: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == 'true') {
                        swal.fire({
                            title: 'Registro Exitoso, En espera Aprobación por Parte del SNC',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                window.location.href = base_url_2;
                            }
                        });
                    }
                }
            })
        }
    });
}

// Variable global para almacenar el ID de la certificación principal
// let currentCertId = null;
// let currentNroComprobante = null; // También necesario para los inserts en tablas secundarias

// $(document).ready(function() {
//     console.log("DOM listo. Script de registro de certificación cargado.");

//     // Manejar el envío del formulario inicial
//     $('#reg_cert_initial').on('submit', function(e) {
//         console.log("Evento 'submit' del formulario inicial detectado.");
//         e.preventDefault(); // Prevenir el envío normal del formulario
//         console.log("Default del formulario prevenido.");

//         // Realizar validación Parsley aquí si es necesario
//         if (!$(this).parsley().isValid()) {
//             console.log("Validación de Parsley fallida. Deteniendo envío.");
//             return;
//         }
//         console.log("Validación de Parsley exitosa.");

//         var base_url = window.location.origin + '/asnc/index.php/Certificacion/registrar_certificacion_inicial_pn';
//         console.log("URL de AJAX para guardar inicial:", base_url);

//         // Deshabilitar el botón para evitar múltiples envíos
//         $('#btn_save_initial').prop('disabled', true).text('Guardando...');
//         console.log("Botón de guardar inicial deshabilitado.");

//         $.ajax({
//             url: base_url, // Nueva URL para el controlador
//             type: 'POST',
//             data: $(this).serialize(),
//             dataType: 'json',
//             beforeSend: function() {
//                 console.log("Iniciando solicitud AJAX para guardar inicial...");
//                 console.log("Datos enviados:", $(this).serializeArray());
//             },
//             success: function(response) {
//                 console.log("Respuesta AJAX recibida:", response);
//                 if (response.success) {
//                     currentCertId = response.cert_id;
//                     currentNroComprobante = response.nro_comprobante;
//                     console.log("Certificación inicial guardada con éxito. currentCertId:", currentCertId, "currentNroComprobante:", currentNroComprobante);

//                     // Ocultar el formulario inicial
//                     $('#initial_form_panel').hide();
//                     console.log("Formulario inicial oculto.");
//                     // Mostrar la sección de detalles
//                     $('#cert_details_section').show();
//                     console.log("Sección de detalles mostrada.");

//                     // Cargar los datos de la certificación en la sección de detalles
//                     $('#cert_id_display').text(currentCertId);
//                     $('#display_nro_comprobante').text(response.nro_comprobante);
//                     $('#display_rif_cont').text(response.rif_cont);
//                     $('#display_nombre').text(response.nombre);
//                     $('#display_objetivo').text(response.objetivo);
//                     console.log("Datos de certificación actualizados en la vista.");

//                     // Pasar el ID de la certificación a todos los formularios de los modales
//                     $('#cert_id_modal_pn').val(currentCertId);
//                     $('#cert_id_modal_fp').val(currentCertId);
//                     $('#cert_id_modal_fmc').val(currentCertId);
//                     $('#cert_id_modal_ec').val(currentCertId);
//                     $('#cert_id_modal_ed').val(currentCertId);
//                     console.log("ID de certificación asignado a los campos ocultos de los modales.");

//                     // Notificación de éxito
//                     alert('Certificación inicial guardada con éxito. Ahora puede agregar los detalles.');
//                 } else {
//                     console.error("Error al guardar la certificación inicial:", response.message);
//                     alert('Error al guardar la certificación inicial: ' + response.message);
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error("Error en la solicitud AJAX para guardar inicial.");
//                 console.error("Status:", status, "Error:", error);
//                 console.error("Respuesta completa del servidor (xhr.responseText):", xhr.responseText);
//                 alert('Error en la comunicación con el servidor al guardar la certificación inicial. Revise la consola para más detalles.');
//             },
//             complete: function() {
//                 // Habilitar el botón de nuevo
//                 $('#btn_save_initial').prop('disabled', false).text('Guardar Certificación Inicial');
//                 console.log("Botón de guardar inicial habilitado.");
//             }
//         });
//     });

//     // --- Lógica para cada modal ---

//     // Función para guardar Información de Persona Natural (si se hace en un modal)
//     window.saveInforPerNatu = function() {
//         console.log("Función saveInforPerNatu iniciada.");
//         const certId = $('#cert_id_modal_pn').val();
//         console.log("ID de Certificación para PN:", certId);

//         const formData = {
//             cert_id: certId,
//             nombre_ape: $('#nombre_ape_modal').val(),
//             cedula: $('#cedula_modal').val(),
//             rif: $('#rif_modal').val(),
//             bolivar_estimado: $('#bolivar_estimado_modal').val(),
//             iva_estimado: $('#iva_estimado_modal').val(),
//             monto_estimado: $('#monto_estimado_modal').val()
//         };
//         console.log("Datos del formulario PN:", formData);

//         var base_url = window.location.origin + '/asnc/index.php/Certificacion/guardar_infor_persona_natural';
//         console.log("URL de AJAX para PN:", base_url);

//         $.ajax({
//             url: base_url,
//             type: 'POST',
//             data: formData,
//             dataType: 'json',
//             success: function(response) {
//                 console.log("Respuesta AJAX de PN recibida:", response);
//                 if (response.success) {
//                     alert('Información de persona natural guardada con éxito.');
//                     $('#modalPersonaNatural').modal('hide');
//                     console.log("Modal de PN oculto.");
//                     // Opcional: Actualizar la sección de detalles para mostrar esta información
//                 } else {
//                     console.error("Error al guardar información PN:", response.message);
//                     alert('Error: ' + response.message);
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error("Error en la solicitud AJAX para PN.");
//                 console.error("Status:", status, "Error:", error);
//                 console.error("Respuesta completa del servidor (xhr.responseText):", xhr.responseText);
//                 alert('Error al guardar la información de la persona natural. Revise la consola.');
//             }
//         });
//     };

//     // Función para agregar Formación Profesional
//     window.addFormacionProfesional = function() {
//         console.log("Función addFormacionProfesional iniciada.");
//         const certId = $('#cert_id_modal_fp').val();
//         console.log("ID de Certificación para Formación Profesional:", certId);

//         const formData = {
//             cert_id: certId,
//             nro_comprobante: currentNroComprobante, // Usar el nro_comprobante de la principal
//             rif_cont: $('#display_rif_cont').text(), // Obtener el RIF de la principal
//             for_academica: $('#for_academica_modal').val(),
//             titulo: $('#titulo_modal').val(),
//             ano: $('#ano_modal').val(),
//             culminacion: $('#culminacion_modal').val(),
//             curso: $('#curso_modal').val()
//         };
//         console.log("Datos del formulario Formación Profesional:", formData);

//         var base_url = window.location.origin + '/asnc/index.php/Certificacion/agregar_formacion_profesional';
//         console.log("URL de AJAX para Formación Profesional:", base_url);

//         $.ajax({
//             url: base_url,
//             type: 'POST',
//             data: formData,
//             dataType: 'json',
//             success: function(response) {
//                 console.log("Respuesta AJAX de Formación Profesional recibida:", response);
//                 if (response.success) {
//                     alert('Formación profesional agregada.');
//                     $('#modalFormacionProfesional').modal('hide');
//                     $('#form_for_prof')[0].reset(); // Limpiar el formulario del modal
//                     console.log("Modal de Formación Profesional oculto y formulario reseteado.");
//                     loadFormacionProfesionalTable(certId); // Recargar la tabla resumen
//                 } else {
//                     console.error("Error al agregar Formación Profesional:", response.message);
//                     alert('Error: ' + response.message);
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error("Error en la solicitud AJAX para Formación Profesional.");
//                 console.error("Status:", status, "Error:", error);
//                 console.error("Respuesta completa del servidor (xhr.responseText):", xhr.responseText);
//                 alert('Error al agregar formación profesional. Revise la consola.');
//             }
//         });
//     };

//     // Función para cargar la tabla de Formación Profesional
//     function loadFormacionProfesionalTable(certId) {
//         console.log("Cargando tabla de Formación Profesional para certId:", certId);
//         var base_url = window.location.origin + '/asnc/index.php/Certificacion/get_formacion_profesional/' + certId;
//         console.log("URL de AJAX para cargar tabla FP:", base_url);

//         $.ajax({
//             url: base_url,
//             type: 'GET',
//             dataType: 'json',
//             success: function(data) {
//                 console.log("Datos de Formación Profesional recibidos para la tabla:", data);
//                 const tbody = $('#table_formacion_prof tbody');
//                 tbody.empty(); // Limpiar tabla
//                 if (data.length > 0) {
//                     data.forEach(item => {
//                         tbody.append(`
//                             <tr>
//                                 <td>${item.for_academica}</td>
//                                 <td>${item.titulo}</td>
//                                 <td>${item.ano}</td>
//                                 <td>${item.culminacion}</td>
//                                 <td>${item.curso}</td>
//                                 <td>
//                                     <button class="btn btn-danger btn-sm" onclick="deleteFormacionProfesional(${item.id_infor_prof})">Eliminar</button>
//                                 </td>
//                             </tr>
//                         `);
//                     });
//                     console.log("Tabla de Formación Profesional actualizada con", data.length, "ítems.");
//                 } else {
//                     tbody.append('<tr><td colspan="6" class="text-center">No hay formaciones agregadas.</td></tr>');
//                     console.log("No hay formaciones profesionales para mostrar.");
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error al cargar la tabla de formación profesional.');
//                 console.error("Status:", status, "Error:", error);
//                 console.error("Respuesta completa del servidor (xhr.responseText):", xhr.responseText);
//             }
//         });
//     }

//     // Funciones similares para los demás modales: addFormacionContratacion, addExperienciaComisiones, addExperienciaDictado
//     // y sus respectivas funciones loadTableX y deleteX.

//     // Lógica para el botón de Declaración
//     window.confirmarDeclaracion = function() {
//         console.log("Función confirmarDeclaracion iniciada.");
//         if (confirm('¿Está seguro de que desea enviar su declaración y finalizar el registro de detalles?')) {
//             console.log("Confirmación de usuario aceptada.");
//             const certId = currentCertId;
//             console.log("ID de Certificación para Declaración:", certId);

//             var base_url = window.location.origin + '/asnc/index.php/Certificacion/finalizar_registro_pn';
//             var base_url_2 = window.location.origin + "/asnc/index.php/Certificacion/Listado_certificacion_interno_contralodira"; // Asegúrate que esta URL es correcta

//             console.log("URL de AJAX para finalizar:", base_url);
//             console.log("URL de redirección final:", base_url_2);

//             $.ajax({
//                 url: base_url,
//                 type: 'POST',
//                 data: {
//                     cert_id: certId,
//                     declara: $('#declara').val(),
//                     acepto: 'Si'
//                 },
//                 dataType: 'json',
//                 success: function(response) {
//                     console.log("Respuesta AJAX de Declaración recibida:", response);
//                     if (response.success) {
//                         alert('Registro finalizado y declaración aceptada.');
//                         console.log("Redirigiendo a:", base_url_2);
//                         window.location.href = base_url_2;
//                     } else {
//                         console.error("Error al finalizar el registro:", response.message);
//                         alert('Error al finalizar el registro: ' + response.message);
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.error("Error en la solicitud AJAX para finalizar registro.");
//                     console.error("Status:", status, "Error:", error);
//                     console.error("Respuesta completa del servidor (xhr.responseText):", xhr.responseText);
//                     alert('Error en la comunicación con el servidor al finalizar el registro. Revise la consola.');
//                 }
//             });
//         } else {
//             console.log("Confirmación de usuario cancelada.");
//         }
//     };
// });

// // Tus funciones existentes de mayusculas y formato de monto_trans
// function mayusculas(e) {
//     e.value = e.value.toUpperCase();
// }

// $("#monto_trans, #monto_estimado_modal, #bolivar_estimado_modal, #iva_estimado_modal").on({
//     "focus": function(event) {
//         $(event.target).select();
//     },
//     "keyup": function(event) {
//         $(event.target).val(function(index, value) {
//             // Log para ver el valor antes de la manipulación
//             console.log("Valor original del monto en keyup:", value);

//             // Elimina caracteres no numéricos excepto la coma para los decimales
//             // Reemplaza la coma por punto para el formato numérico JavaScript si es necesario en el backend
//             let cleanValue = value.replace(/\D/g, ""); // Elimina todo lo que no sea dígito
//             console.log("Valor limpio (solo dígitos):", cleanValue);

//             // Añade la coma para los decimales
//             if (cleanValue.length > 2) {
//                 cleanValue = cleanValue.replace(/([0-9])([0-9]{2})$/, '$1,$2');
//             }
//             console.log("Valor con coma decimal:", cleanValue);

//             // Añade separadores de miles
//             cleanValue = cleanValue.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
//             console.log("Valor final formateado:", cleanValue);

//             return cleanValue;
//         });
//     }
// });