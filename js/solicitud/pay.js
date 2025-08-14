// pay.js

// // --- 1. VARIABLES GLOBALES ---
// const today = new Date();
// const year = today.getFullYear();
// const month = (today.getMonth() + 1).toString().padStart(2, '0');
// const day = today.getDate().toString().padStart(2, '0');
// const maxDate = `${year}-${month}-${day}`; // Formatoレンダー-MM-DD

// // --- 2. FUNCIONES AUXILIARES GENERALES Y DE UTILIDAD ---

// function allowOnlyNumbers(inputElement) {
//     if (inputElement) { inputElement.value = inputElement.value.replace(/[^0-9]/g, ''); }
// }
// function allowNumbersAndDecimals(inputElement) {
//     if (inputElement) {
//         inputElement.value = inputElement.value.replace(/[^0-9.]/g, '');
//         const parts = inputElement.value.split('.');
//         if (parts.length > 2) { inputElement.value = parts[0] + '.' + parts.slice(1).join(''); }
//     }
// }
// function isInteger(value) { return /^\d+$/.test(value); }
// function isNumeric(value) { return !isNaN(parseFloat(value)) && isFinite(value); }

// // Función para mostrar un mensaje de error visual bajo un campo de formulario (Bootstrap invalid-feedback)
// function showFieldError(fieldElement, message) {
//     fieldElement.addClass('is-invalid');
//     let feedbackDiv = fieldElement.siblings('.invalid-feedback');
//     if (feedbackDiv.length === 0) {
//         feedbackDiv = $('<div class="invalid-feedback d-block"></div>');
//         fieldElement.after(feedbackDiv);
//     }
//     feedbackDiv.text(message).show();
// }

// // Función para limpiar un mensaje de error visual de un campo de formulario
// function clearFieldError(fieldElement) {
//     fieldElement.removeClass('is-invalid');
//     fieldElement.siblings('.invalid-feedback').text('').hide();
// }

// // Validar formato de fecha (YYYY-MM-DD)
// function isValidDate(dateString) {
//     const regEx = /^\d{4}-\d{2}-\d{2}$/;
//     if(!dateString.match(regEx)) return false;
//     const d = new Date(dateString + 'T00:00:00');
//     return !isNaN(d.getTime());
// }

// // --- NUEVA FUNCIÓN: Actualiza el indicador visual de estado (luz verde/roja) ---
// function updateStatusLight(elementId, isMet) {
//     const light = $(`#${elementId}`);
//     light.removeClass('green red').addClass(isMet ? 'green' : 'red');
// }


// // --- 3. FUNCIONES DE CÁLCULO DE MONTOS (Contado y Crédito) ---
// // Función para calcular contado (total_pago)
// function calcularContado() {
//     var totalPagoStr = $('#total_pago').val().replace(/[^0-9.-]/g, '');
//     var totalPago = parseFloat(totalPagoStr) || 0;
    
//     var iva = totalPago * 0.16;
//     var totalConIVA = totalPago + iva;
    
//     $('#iva').val(iva.toFixed(2));
//     $('#total_iva').val(totalConIVA.toFixed(2));
// }

// // Función para calcular crédito (pay)
// function calcularCredito() {
//     // Obtener valor del crédito
//     var creditoStr = $('#pay').val().replace(/[^0-9.-]/g, '');
//     var credito = parseFloat(creditoStr) || 0;
    
//     // Calcular IVA (16%)
//     var ivaCredito = credito * 0.16;
    
//     // Calcular total con IVA
//     var totalConIVACredito = credito + ivaCredito;
    
//     // Calcular la mitad del total
//     var mitadTotal = totalConIVACredito / 2;
    
//     // Mostrar resultados
//     $('#iva_credito').val(ivaCredito.toFixed(2));
//     $('#total_iva_credito').val(totalConIVACredito.toFixed(2));
//     $('#mitad_total_credito').val(mitadTotal.toFixed(2));
// }


// // --- 4. FUNCIONES DE LÓGICA DE INTERFAZ Y ESTADO (Toggle Fields, Toggle Buttons) ---

// // Muestra/oculta campos de pago según el tipo de pago seleccionado
// function togglePagoFields() {
//     const tipoPago = $('#tipo_pago').val();

//     $('#prontoPagoField').hide();
//     $('#creditoPagoField').hide();

//     if (tipoPago == '1') { $('#prontoPagoField').show(); } 
//     else if (tipoPago == '2') { $('#creditoPagoField').show(); }

//     // Al cambiar el tipo de pago, restablecer el pago como NO verificado
//     $('#pagoVerificado').val('0'); 
//     toggleGuardarPagoButton(); // Re-evaluar el estado del botón Guardar
// }

// // Controla la habilitación/deshabilitación del botón "Guardar Pago Final"
// function toggleGuardarPagoButton() {
//     console.log("--- toggleGuardarPagoButton INICIADO ---"); // CONSOLE LOG
//     const declaracionPagoCheckbox = $('#declaracionPago');
//     const guardarPagoButton = $('#guardarPagoFinalBtn'); 
//     const recaptchaResponse = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : ''; // Obtener de forma segura
//     const declaracionPagoFeedback = $('#declaracionPago-feedback'); 
//     const recaptchaFeedback = $('#recaptcha-pay-feedback'); 

//     // Limpiar errores visuales de la declaración y reCAPTCHA
//     clearFieldError(declaracionPagoCheckbox);
//     recaptchaFeedback.hide().text('');

//     // Condición para habilitar el botón "Guardar Pago Final":
//     const planillaEncontrada = $('#id_inscripcion').val().trim() !== '' && $('#codigo_planilla_hidden').val().trim() !== '';
//     const pagoVerificadoConExito = $('#pagoVerificado').val() === '1'; // ¡CLAVE!
//     const declaracionAceptada = declaracionPagoCheckbox.is(':checked');
//     const recaptchaCompleto = recaptchaResponse.length > 0;

//     console.log("Estado de condiciones:"); // CONSOLE LOG
//     console.log("  1. Planilla Encontrada:", planillaEncontrada);
//     console.log("  2. Pago Verificado con Éxito:", pagoVerificadoConExito, "(Valor #pagoVerificado:", $('#pagoVerificado').val(), ")");
//     console.log("  3. Declaración Aceptada:", declaracionAceptada);
//     console.log("  4. reCAPTCHA Completo:", recaptchaCompleto, "(Longitud de respuesta:", recaptchaResponse.length, ")");

//     // Actualizar indicadores visuales
//     updateStatusLight('status-planilla-datos', planillaEncontrada);
//     updateStatusLight('status-pago-verificado', pagoVerificadoConExito);
//     updateStatusLight('status-declaracion', declaracionAceptada);
//     updateStatusLight('status-recaptcha', recaptchaCompleto);


//     if (planillaEncontrada && pagoVerificadoConExito && declaracionAceptada && recaptchaCompleto) {
//         guardarPagoButton.prop('disabled', false); 
//         console.log("Botón 'Guardar Pago' HABILITADO."); // CONSOLE LOG
//     } else {
//         guardarPagoButton.prop('disabled', true); 
//         console.log("Botón 'Guardar Pago' DESHABILITADO."); // CONSOLE LOG

//         // Mostrar mensajes de error visual si no cumplen las condiciones
//         if (!declaracionAceptada) {
//             declaracionPagoFeedback.text('Debe aceptar la declaración de pago para continuar.').show();
//         }
//         if (!recaptchaCompleto) {
//             recaptchaFeedback.text('Por favor, complete el reCAPTCHA.').show();
//         }
//     }
//     console.log("--- toggleGuardarPagoButton FINALIZADO ---"); // CONSOLE LOG
// }


// // --- 5. FUNCIONES PRINCIPALES DE FLUJO (Llamadas por botones o eventos) ---

// // FUNCIÓN PARA CONSULTAR PLANILLA (GLOBAL PARA onclick="Consultarplanilla()")
// window.Consultarplanilla = function() { 
//     console.log("--- Consultarplanilla INICIADO ---"); // CONSOLE LOG
//     var rif_b = $('#rif_b').val().trim();

//     clearFieldError($('#rif_b')); 

//     if (!rif_b) {
//         swal("¡ATENCIÓN!", "El campo 'Código de la planilla' no puede estar vacío.", "warning");
//         showFieldError($('#rif_b'), 'El código de la planilla es requerido.');
//         resetRecaptchaPay(); 
//         $("#existe").hide(); // Ocultar secciones de pago si el código está vacío
//         toggleGuardarPagoButton(); 
//         console.log("Consultarplanilla: Código de planilla vacío. Retornando."); // CONSOLE LOG
//         return;
//     }

//     $('#loading').show();
//     $("#existe").hide();
//     $("#no_existe").hide();

//     // var base_url = window.location.origin+'/asnc/index.php/Diplomado/consulta_og'; 
//      var base_url = '/index.php/Diplomado/consulta_og';


//     $.ajax({
//         url: base_url,
//         method: 'POST',
//         data: { rif_b: rif_b },
//         dataType: 'json',
//         success: function(response) {
//             console.log("Consultarplanilla: Respuesta exitosa:", response); // CONSOLE LOG
//             $('#loading').hide();

//             if (response.success && response.data) {
//                 $("#existe").show();
//                 $("#no_existe").hide();

//                 $('#fecha_limite_pago').val(response.data.fecha_limite_pago || '');
//                 $('#id_inscripcion').val(response.data.id_inscripcion || '');
//                 $('#total_pago').val(response.data.pronto_pago || '');
//                 $('#pay').val(response.data.pay || '');
//                 $('#codigo_planilla_hidden').val(response.data.codigo_planilla || '');

//                 calcularContado();
//                 calcularCredito();
//                 togglePagoFields(); 

//                 $('#pagoVerificado').val('0'); 
//                 resetRecaptchaPay(); // Reiniciar reCAPTCHA tras una consulta exitosa (para nuevo intento de pago)
//                 toggleGuardarPagoButton(); 
//                 console.log("Consultarplanilla: Planilla encontrada."); // CONSOLE LOG
//             } else {
//                 $("#no_existe").show();
//                 $("#existe").hide();

//                 $('#fecha_limite_pago').val(''); $('#id_inscripcion').val('');
//                 $('#total_pago').val(''); $('#pay').val(''); $('#codigo_planilla_hidden').val('');
//                 $('#iva').val(''); $('#total_iva').val('');
//                 $('#iva_credito').val(''); $('#total_iva_credito').val(''); $('#mitad_total_credito').val('');

//                 $('#tipo_pago').val('0'); 
//                 togglePagoFields(); 

//                 swal("No encontrado", response.message || 'Planilla no encontrada.', "info");

//                 resetRecaptchaPay(); 
//                 toggleGuardarPagoButton(); 
//                 console.log("Consultarplanilla: Planilla NO encontrada."); // CONSOLE LOG
//             }
//         },
//         error: function(xhr) {
//             console.error("Consultarplanilla: Error AJAX:", xhr); // CONSOLE LOG
//             $('#loading').hide();
//             swal("Error", "Ocurrió un error al consultar la planilla. Intente de nuevo.", "error");
//             $("#existe").hide();
//             $("#no_existe").hide();

//             resetRecaptchaPay();
//             toggleGuardarPagoButton(); 
//         }
//     });
//     console.log("--- Consultarplanilla FINALIZADO ---"); // CONSOLE LOG
// }

// // FUNCIÓN PARA VERIFICAR DATOS DEL PAGO (GLOBAL PARA onclick="verificarDatosPago()")
// // window.verificarDatosPago = function(event) {
// //     console.log("--- verificarDatosPago INICIADO ---"); // CONSOLE LOG
// //     event.preventDefault(); 

// //     let isValid = true;
// //     let firstInvalidField = null;

// //     // Limpiar errores previos al iniciar la validación
// //     $('.is-invalid').removeClass('is-invalid');
// //     $('.invalid-feedback').hide().text(''); 

// //     // Validar que la planilla haya sido consultada y encontrada (pre-requisito)
// //     if ($('#id_inscripcion').val().trim() === '' || $('#codigo_planilla_hidden').val().trim() === '') {
// //         swal('Atención', 'Primero debe consultar la planilla con un código válido antes de verificar los datos del pago.', "warning");
// //         showFieldError($('#rif_b'), 'Debe consultar la planilla.'); 
// //         resetRecaptchaPay(); 
// //         $('#pagoVerificado').val('0'); 
// //         toggleGuardarPagoButton(); 
// //         console.log("verificarDatosPago: Planilla no consultada/encontrada. Retornando."); 
// //         return;
// //     }

// //     // Validar que se haya seleccionado una forma de pago
// //     const tipoPagoField = $('#tipo_pago');
// //     if (tipoPagoField.val() === '0') {
// //         showFieldError(tipoPagoField, 'Debe seleccionar una forma de pago.');
// //         if (!firstInvalidField) firstInvalidField = tipoPagoField; isValid = false;
// //     } else { clearFieldError(tipoPagoField); }

// //     // Validar Importe
// //     const importeField = $('#importe');
// //     const importeValue = parseFloat(importeField.val().replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(',', '.')); 
// //     if (importeField.val().trim() === '' || isNaN(importeValue) || importeValue <= 0) {
// //         showFieldError(importeField, 'El importe cancelado es obligatorio y debe ser un número positivo.');
// //         if (!firstInvalidField) firstInvalidField = importeField; isValid = false;
// //     } else { clearFieldError(importeField); }

// //     // Validar Fecha de Pago
// //     const fechaPagoField = $('#fechaPago');
// //     if (fechaPagoField.val().trim() === '') {
// //         showFieldError(fechaPagoField, 'La fecha de pago es obligatoria.');
// //         if (!firstInvalidField) firstInvalidField = fechaPagoField; isValid = false;
// //     } else if (!isValidDate(fechaPagoField.val())) {
// //         showFieldError(fechaPagoField, 'Formato de fecha de pago inválido (YYYY-MM-DD).');
// //         if (!firstInvalidField) firstInvalidField = fechaPagoField; isValid = false;
// //     } else { clearFieldError(fechaPagoField); }

// //     // Validar Referencia
// //     const referenciaField = $('#referencia');
// //     if (referenciaField.val().trim() === '') {
// //         showFieldError(referenciaField, 'El número de referencia es obligatorio.');
// //         if (!firstInvalidField) firstInvalidField = referenciaField; isValid = false;
// //     } else { clearFieldError(referenciaField); }

// //     // Validar Cédula del Pagador
// //     const cedulaPagadorField = $('#cedulaPagador');
// //     if (cedulaPagadorField.val().trim() === '' || !isInteger(cedulaPagadorField.val()) || cedulaPagadorField.val().length < 5) {
// //         showFieldError(cedulaPagadorField, 'La cédula del pagador es obligatoria y debe ser numérica (mín. 5 dígitos).');
// //         if (!firstInvalidField) firstInvalidField = cedulaPagadorField; isValid = false;
// //     } else { clearFieldError(cedulaPagadorField); }

// //     // Validar Teléfono del Pagador
// //     const telefonoPagadorField = $('#telefonoPagador');
// //     if (telefonoPagadorField.val().trim() === '' || !isInteger(telefonoPagadorField.val()) || telefonoPagadorField.val().length < 7) {
// //         showFieldError(telefonoPagadorField, 'El teléfono del pagador es obligatorio y debe ser numérico (mín. 7 dígitos).');
// //         if (!firstInvalidField) firstInvalidField = telefonoPagadorField; isValid = false;
// //     } else { clearFieldError(telefonoPagadorField); }

// //     // Validar Banco de Origen
// //     const bancoOrigenField = $('#bancoOrigen');
// //     if (bancoOrigenField.val() === '0') {
// //         showFieldError(bancoOrigenField, 'Debe seleccionar el Banco de Origen.');
// //         if (!firstInvalidField) firstInvalidField = bancoOrigenField; isValid = false;
// //     } else { clearFieldError(bancoOrigenField); }

// //     // Si alguna validación frontend falla, mostrar SweetAlert y reiniciar reCAPTCHA
// //     if (!isValid) {
// //         if (firstInvalidField) {
// //             $('html, body').animate({ scrollTop: firstInvalidField.offset().top - 80 }, 500);
// //             firstInvalidField.focus();
// //         }
// //         swal('Error', 'Por favor complete todos los datos de la transacción correctamente.', 'error');
// //         resetRecaptchaPay(); 
// //         $('#pagoVerificado').val('0'); 
// //         toggleGuardarPagoButton(); 
// //         console.log("verificarDatosPago: Validaciones frontend fallaron."); 
// //         return;
// //     }

    // const datosVerificacion = {
    //     id_inscripcion: $('#id_inscripcion').val(),
    //     codigo_planilla: $('#codigo_planilla_hidden').val(), 
    //     referencia: referenciaField.val(),
    //     importe: importeField.val(),
    //     fechaPago: fechaPagoField.val(),
    //     bancoOrigen: bancoOrigenField.val(),
    //     cedulaPagador: cedulaPagadorField.val(),
    //     telefonoPagador: telefonoPagadorField.val(),
    //     telefonoDestino: $('#telefonoDestino').val() || '' 
    // };

// //     // const urlVerificarPago = window.location.origin+'/asnc/index.php/Diplomado/verificar_pago'; 
// //      const urlVerificarPago = '/index.php/Diplomado/verificar_pago';

// //     $('#btnVerificarDatosPago').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Verificando...');

// //     $.ajax({
// //         url: urlVerificarPago,
// //         type: 'POST',
// //         dataType: 'json',
// //         data: datosVerificacion,
// //         success: function(response) {
// //             console.log("verificarDatosPago: Respuesta backend:", response); 
// //             if (response.success) {
// //                 swal('Éxito', response.message || 'Datos de pago verificados correctamente. ¡Presione Guardar Pago para finalizar!', 'success');
// //                 $('#pagoVerificado').val('1'); 
// //                 resetRecaptchaPay(); 
// //                 console.log("verificarDatosPago: Verificación exitosa. Pago verificado a '1'."); 
// //             } else {
// //                 swal('Error', response.message || 'Error al verificar los datos de pago.', 'error');
// //                 $('#pagoVerificado').val('0'); //// cabiar en produccion
// //                 resetRecaptchaPay(); 
// //                 console.log("verificarDatosPago: Verificación fallida. Pago verificado a '0'."); 
// //             }
// //             toggleGuardarPagoButton(); 
// //         },
// //         error: function(xhr) {
// //             console.error("verificarDatosPago: Error AJAX:", xhr); 
// //             swal('Error', 'Error de conexión al verificar datos de pago.', 'error');
// //             $('#pagoVerificado').val('0'); 
// //             resetRecaptchaPay(); 
// //             toggleGuardarPagoButton(); 
// //         },
// //         complete: function() {
// //             $('#btnVerificarDatosPago').prop('disabled', false).html('<i class="fas fa-check-circle mr-2"></i>Verificar Datos del Pago');
// //             console.log("verificarDatosPago: Petición AJAX completa."); 
// //         }
// //     });
// //     console.log("--- verificarDatosPago FINALIZADO (Llamada AJAX enviada) ---"); 
// // }


// // FUNCIÓN PRINCIPAL PARA GUARDAR PAGO (Llamada por guardarPagoFinalBtn)
// window.guardarPagoFinal = function(event) { 
//     console.log("--- guardarPagoFinal INICIADO ---"); 
//     event.preventDefault(); 

//     const planillaEncontrada = $('#id_inscripcion').val().trim() !== '' && $('#codigo_planilla_hidden').val().trim() !== '';
//     const pagoVerificadoConExito = $('#pagoVerificado').val() === '1';
//     const declaracionAceptada = $('#declaracionPago').is(':checked');
//     const recaptchaResponse = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : ''; 

//     console.log("guardarPagoFinal: Condiciones antes de guardar:"); 
//     console.log("  Planilla Encontrada:", planillaEncontrada);
//     console.log("  Pago Verificado Con Éxito:", pagoVerificadoConExito);
//     console.log("  Declaración Aceptada:", declaracionAceptada);
//     console.log("  reCAPTCHA Completo:", recaptchaResponse.length > 0);

//     if (!planillaEncontrada || !pagoVerificadoConExito || !declaracionAceptada || recaptchaResponse.length === 0) {
//         console.log("guardarPagoFinal: Validaciones previas fallaron. No se guardará."); 
//         toggleGuardarPagoButton(); // Asegura que los mensajes visuales y el disabled se activen
//         swal('Atención', 'Asegúrese de que la planilla esté consultada, los datos de pago verificados, la declaración aceptada y el reCAPTCHA completo.', 'warning');
//         resetRecaptchaPay(); 
//         return; 
//     }

//     $('#guardarPagoFinalBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Guardando Pago...');
//     // console.log("--- Depurando FormData en guardarPagoFinal ---");
//     // const formData = new FormData($('#sav_ext')[0]); 
//     // formData.append('g-recaptcha-response', recaptchaResponse); 
// const dataToSend = {
//         id_inscripcion: $('#id_inscripcion').val(),
//         codigo_planilla: $('#codigo_planilla_hidden').val(),
//         rif_b: $('#rif_b').val(),

//         referencia: $('#referencia').val(),
//         importe: $('#importe').val(),
//         fechaPago: $('#fechaPago').val(),
//         bancoOrigen: $('#bancoOrigen').val(),
//         cedulaPagador: $('#cedulaPagador').val(),
//         telefonoPagador: $('#telefonoPagador').val(),
//         tipo_pago: $('#tipo_pago').val(),
//         telefonoDestino: $('#telefonoDestino').val() || '',
//         declaracionPago: $('#declaracionPago').is(':checked') ? '1' : '0', // Enviar '1' o '0'
//         'g-recaptcha-response': recaptchaResponse // Clave reCAPTCHA
//         // Añade todos los demás campos de tu formulario aquí
//     };

    
//     // var base_url_guardar_pago = window.location.origin + '/asnc/index.php/Diplomado/guardar_pago';
//     // var base_url_pdf_recibo = window.location.origin + '/asnc/index.php/recibonatural/pdfrt?id=' + $('#rif_b').val();    
//     // var base_url_redirigir = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; 

//      var base_url_guardar_pago = '/index.php/Diplomado/guardar_pago';
//      var base_url_pdf_recibo = '/index.php/recibonatural/pdfrt?id=' + $('#rif_b').val();
//      var base_url_redirigir = '/index.php/Diplomado/preinscrip';

//     $.ajax({
//         url: base_url_guardar_pago,
//         type: 'POST',
//         dataType: 'json',
//         data: dataToSend, 
//         beforeSend: function() {
//             console.log("guardarPagoFinal: Enviando AJAX a guardar_pago."); 
//         },
//          success: function(response) {
//             console.log("guardarPagoFinal: Respuesta de guardar_pago:", response); 
//             if(response.success) {
//                 var downloadUrl = base_url_pdf_recibo; // La URL de descarga

//                 // Creamos el enlace temporal y simulamos el clic
//                 var downloadLink = document.createElement('a');
//                 downloadLink.href = downloadUrl;
//                 downloadLink.target = '_blank'; // Abrir en nueva pestaña para la descarga
//                 downloadLink.download = `Recibo_SNC_${response.codigo_planilla}.pdf`; // Sugiere nombre de archivo
//                 document.body.appendChild(downloadLink); // Añadir al DOM temporalmente
//                 downloadLink.click(); // Simular clic para iniciar la descarga
//                 document.body.removeChild(downloadLink); // Eliminar el enlace del DOM
//                 console.log("Descarga de PDF iniciada.");

//                 swal({
//                     title: '¡Éxito!',
//                     text: response.message || 'Pago registrado exitosamente. El recibo se descargará.',
//                     type: 'success',
//                     showCancelButton: false,
//                     confirmButtonColor: '#3085d6',
//                     confirmButtonText: 'Aceptar',
//                     closeOnConfirm: true // Cerrar el SweetAlert cuando se hace clic en "Aceptar"
//                     // No uses 'timer' si quieres que el usuario haga clic en "Aceptar" para la redirección.
//                     // Si usas timer, el `didClose` (para SweetAlert2) o la función de callback se disparará al expirar.
//                 }, function() { // <-- ESTE ES EL CALLBACK DE SWEETALERT 1.x
//                     // Este código se ejecuta cuando el usuario hace clic en "Aceptar" en el SweetAlert
//                    // console.log("Usuario aceptó SweetAlert. Redirigiendo la página.");
//                     // Redirige la página actual
//                     window.location.href = base_url_redirigir; 
//                 });

//             } else { // Si el servidor devuelve success: false
//                 // *** CORRECCIÓN AQUÍ: Usar sintaxis de SweetAlert 1.x para el error ***
//                 swal({
//                     title: 'Error',
//                     text: response.message,
//                     type: 'error',
//                     confirmButtonColor: '#3085d6',
//                     confirmButtonText: 'Ok'
//                 }, function() { // Callback para cuando el usuario hace clic en "Ok"
//                     resetRecaptchaPay(); // ¡Importante! Reiniciar el CAPTCHA si el servidor da error de validación
//                 });
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error("guardarPagoFinal: Error AJAX:", xhr); 
//             let errorMessage = 'Hubo un error desconocido al registrar el pago.';
//             try {
//                 const errorResponse = JSON.parse(xhr.responseText);
//                 if (errorResponse && errorResponse.message) {
//                     errorMessage = errorResponse.message;
//                 }
//             } catch (e) {
//                 // Si la respuesta no es JSON, mostrar el error de texto del XHR
//                 errorMessage = `Error de conexión con el servidor: ${xhr.status} ${xhr.statusText || error}`;
//                 if (xhr.responseText) {
//                     errorMessage += `\nDetalles: ${xhr.responseText.substring(0, 200)}...`; // Muestra parte de la respuesta
//                 }
//             }
//             // *** CORRECCIÓN AQUÍ: Usar sintaxis de SweetAlert 1.x para el error AJAX ***
//             swal({
//                 title: 'Error',
//                 text: errorMessage,
//                 type: 'error',
//                 confirmButtonColor: '#3085d6',
//                 confirmButtonText: 'Ok'
//             }, function() { // Callback para cuando el usuario hace clic en "Ok"
//                 resetRecaptchaPay(); // Reiniciar reCAPTCHA
//             });
//         },
//         complete: function() {
//             // Este bloque se ejecuta SIEMPRE al finalizar la petición AJAX (éxito o error)
//             $('#guardarPagoFinalBtn').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Pago');
//             console.log("guardarPagoFinal: Petición AJAX completa. Botón restaurado."); 
//         }
//     });
//     console.log("--- guardarPagoFinal FINALIZADO (Llamada AJAX enviada) ---"); 
// }



// // --- EVENTOS DEL DOCUMENTO (jQuery ready) ---
// $(document).ready(function() {
//     console.log("Documento listo. Iniciando eventos y estado inicial."); 
//     // --- Eventos para los campos de montos para recálculo ---
//     $('#total_pago').on('input', function() {
//         allowNumbersAndDecimals(this);
//         calcularContado();
//     });

//     $('#pay').on('input', function() {
//         allowNumbersAndDecimals(this);
//         calcularCredito();
//     });

//     // --- Evento para el tipo de pago ---
//     $('#tipo_pago').on('change', togglePagoFields);

//     // --- Eventos input para campos numéricos/de texto que necesitan limpieza ---
//     $('#rif_b').on('input', function() { this.value = this.value.toUpperCase(); }); 
//     $('#cedulaPagador').on('input', function() { allowOnlyNumbers(this); });
//     $('#telefonoPagador').on('input', function() { allowOnlyNumbers(this); });
//     $('#telefonoDestino').on('input', function() { allowOnlyNumbers(this); });
//     $('#referencia').on('input', function() { /* Si puede tener letras, no usar allowOnlyNumbers */ }); 
//     $('#importe').on('input', function() { allowNumbersAndDecimals(this); });

//     // --- Evento del botón Consultar Planilla ---
//     // ESTE BOTÓN TIENE onclick="Consultarplanilla()" DIRECTO EN EL HTML.
//     // No necesita un .on('click') aquí.

//     // --- Botón Verificar Datos del Pago ---
//     $('#btnVerificarDatosPago').on('click', verificarDatosPago); // Adjunta el evento jQuery

//     // --- Control de la Declaración de Pago y reCAPTCHA ---
//     $('#declaracionPago').on('change', toggleGuardarPagoButton);
//     // Disparar toggleGuardarPagoButton al inicio para establecer el estado inicial del botón
//     toggleGuardarPagoButton(); 

//     // --- Botón Final: Guardar Pago ---
//     // Adjunta la función principal de guardado al botón final.
//     $('#guardarPagoFinalBtn').on('click', guardarPagoFinal); 
//     console.log("Eventos iniciales y estado del botón configurados."); 
// });

// pay.js

// --- 1. VARIABLES GLOBALES ---
const today = new Date();
const year = today.getFullYear();
const month = (today.getMonth() + 1).toString().padStart(2, '0');
const day = today.getDate().toString().padStart(2, '0');
const maxDate = `${year}-${month}-${day}`; // Formatoレンダー-MM-DD

// --- 2. FUNCIONES AUXILIARES GENERALES Y DE UTILIDAD ---

function allowOnlyNumbers(inputElement) {
    if (inputElement) { inputElement.value = inputElement.value.replace(/[^0-9]/g, ''); }
}
function allowNumbersAndDecimals(inputElement) {
    if (inputElement) {
        inputElement.value = inputElement.value.replace(/[^0-9.]/g, '');
        const parts = inputElement.value.split('.');
        if (parts.length > 2) { inputElement.value = parts[0] + '.' + parts.slice(1).join(''); }
    }
}
function isInteger(value) { return /^\d+$/.test(value); }
function isNumeric(value) { return !isNaN(parseFloat(value)) && isFinite(value); }

// Función para mostrar un mensaje de error visual bajo un campo de formulario (Bootstrap invalid-feedback)
function showFieldError(fieldElement, message) {
    fieldElement.addClass('is-invalid');
    let feedbackDiv = fieldElement.siblings('.invalid-feedback');
    if (feedbackDiv.length === 0) {
        feedbackDiv = $('<div class="invalid-feedback d-block"></div>');
        fieldElement.after(feedbackDiv);
    }
    feedbackDiv.text(message).show();
}

// Función para limpiar un mensaje de error visual de un campo de formulario
function clearFieldError(fieldElement) {
    fieldElement.removeClass('is-invalid');
    fieldElement.siblings('.invalid-feedback').text('').hide();
}

// Validar formato de fecha (YYYY-MM-DD)
function isValidDate(dateString) {
    const regEx = /^\d{4}-\d{2}-\d{2}$/;
    if(!dateString.match(regEx)) return false;
    const d = new Date(dateString + 'T00:00:00');
    return !isNaN(d.getTime());
}

// --- NUEVA FUNCIÓN: Actualiza el indicador visual de estado (luz verde/roja) ---
function updateStatusLight(elementId, isMet) {
    const light = $(`#${elementId}`);
    light.removeClass('green red').addClass(isMet ? 'green' : 'red');
}


// --- 3. FUNCIONES DE CÁLCULO DE MONTOS (Contado y Crédito) ---


// // --- 3. FUNCIONES DE CÁLCULO DE MONTOS (Contado y Crédito) ---
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


 

// --- 4. FUNCIONES DE LÓGICA DE INTERFAZ Y ESTADO (Toggle Fields, Toggle Buttons) ---

// Muestra/oculta campos de pago según el tipo de pago seleccionado
function togglePagoFields() {
    const tipoPago = $('#tipo_pago').val();

    $('#prontoPagoField').hide();
    $('#creditoPagoField').hide();

    // Resetear el valor del campo importe cada vez que se cambia el tipo de pago
    $('#importe').val(''); 
    clearFieldError($('#importe')); // Limpiar cualquier error previo en el importe

    if (tipoPago == '1') {
        $('#prontoPagoField').show();
        // Asignar el valor de total_iva a importe si es Pronto Pago
        $('#importe').val($('#total_iva').val()); 
    } else if (tipoPago == '2') {
        $('#creditoPagoField').show();
        // Asignar el valor de mitad_total_credito a importe si es Crédito
        $('#importe').val($('#mitad_total_credito').val()); 
    }

    // Al cambiar el tipo de pago, restablecer el pago como NO verificado
    $('#pagoVerificado').val('0'); 
    toggleGuardarPagoButton(); // Re-evaluar el estado del botón Guardar
}

// Controla la habilitación/deshabilitación del botón "Guardar Pago Final"
function toggleGuardarPagoButton() {
    console.log("--- toggleGuardarPagoButton INICIADO ---"); // CONSOLE LOG
    const declaracionPagoCheckbox = $('#declaracionPago');
    const guardarPagoButton = $('#guardarPagoFinalBtn'); 
    const recaptchaResponse = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : ''; 
    const declaracionPagoFeedback = $('#declaracionPago-feedback'); 
    const recaptchaFeedback = $('#recaptcha-pay-feedback'); 

    // Limpiar errores visuales de la declaración y reCAPTCHA
    clearFieldError(declaracionPagoCheckbox);
    recaptchaFeedback.hide().text('');

    // Condición para habilitar el botón "Guardar Pago Final":
    // El botón se habilita cuando la planilla está encontrada, la declaración aceptada y el reCAPTCHA completado.
    // La VERIFICACIÓN DEL PAGO es una ACCIÓN que el botón INICIARÁ.
    const planillaEncontrada = $('#id_inscripcion').val().trim() !== '' && $('#codigo_planilla_hidden').val().trim() !== '';
    // const pagoVerificadoConExito = $('#pagoVerificado').val() === '1'; // <-- ¡ELIMINAR ESTA LÍNEA DE LA CONDICIÓN!
    const declaracionAceptada = declaracionPagoCheckbox.is(':checked');
    const recaptchaCompleto = recaptchaResponse.length > 0;

    console.log("Estado de condiciones para habilitar botón:"); // CONSOLE LOG
    console.log("  1. Planilla Encontrada:", planillaEncontrada);
    // console.log("  2. Pago Verificado con Éxito:", pagoVerificadoConExito); // Ya no es una condición de habilitación visible
    console.log("  2. Declaración Aceptada:", declaracionAceptada);
    console.log("  3. reCAPTCHA Completo:", recaptchaCompleto, "(Longitud de respuesta:", recaptchaResponse.length, ")");

    // --- ¡CORRECCIÓN CLAVE AQUÍ! Condición de Habilitación ---
    if (planillaEncontrada && declaracionAceptada && recaptchaCompleto) { // Se habilita SIN REQUERIR pagoVerificadoConExito
        guardarPagoButton.prop('disabled', false); 
        console.log("Botón 'Guardar Pago' HABILITADO."); // CONSOLE LOG
    } else {
        guardarPagoButton.prop('disabled', true); 
        console.log("Botón 'Guardar Pago' DESHABILITADO."); // CONSOLE LOG

        // Mostrar mensajes de error visual si no cumplen las condiciones
        if (!declaracionAceptada) {
            declaracionPagoFeedback.text('Debe aceptar la declaración de pago para continuar.').show();
        }
        if (!recaptchaCompleto) {
            recaptchaFeedback.text('Por favor, complete el reCAPTCHA.').show();
        }
        // No es necesario un mensaje específico aquí si planillaEncontrada es false,
        // ya que el usuario es guiado por los botones "Consultar".
    }
    console.log("--- toggleGuardarPagoButton FINALIZADO ---"); // CONSOLE LOG
}


// --- 5. FUNCIONES PRINCIPALES DE FLUJO (Llamadas por botones o eventos) ---

// FUNCIÓN PARA CONSULTAR PLANILLA (GLOBAL PARA onclick="Consultarplanilla()")
// function Consultarplanilla()  { 
//     console.log("--- Consultarplanilla INICIADO ---"); // CONSOLE LOG
//     var rif_b = $('#rif_b').val().trim();

//     clearFieldError($('#rif_b')); 

//     if (!rif_b) {
//         swal("¡ATENCIÓN!", "El campo 'Código de la planilla' no puede estar vacío.", "warning");
//         showFieldError($('#rif_b'), 'El código de la planilla es requerido.');
//         resetRecaptchaPay(); 
//         $("#existe").hide(); // Ocultar secciones de pago si el código está vacío
//         toggleGuardarPagoButton(); 
//         console.log("Consultarplanilla: Código de planilla vacío. Retornando."); 
//         return;
//     }

//     $('#loading').show();
//     $("#existe").hide();
//     $("#no_existe").hide();

//     // var base_url = window.location.origin+'/asnc/index.php/Diplomado/consulta_og'; 
//     var base_url = '/index.php/Diplomado/consulta_og';

//     $.ajax({
//         url: base_url,
//         method: 'POST',
//         data: { rif_b: rif_b },
//         dataType: 'json',
//         success: function(response) {
//             console.log("Consultarplanilla: Respuesta exitosa:", response); 
//             $('#loading').hide();

//             if (response.success && response.data) {
//                 $("#existe").show();
//                 $("#no_existe").hide();

//                 $('#fecha_limite_pago').val(response.data.fecha_limite_pago || '');
//                 $('#id_inscripcion').val(response.data.id_inscripcion || '');
//                 $('#total_pago').val(response.data.pronto_pago || '');
//                 $('#pay').val(response.data.pay || '');
//                 $('#codigo_planilla_hidden').val(response.data.codigo_planilla || '');

//                 calcularContado();
//                 calcularCredito();
//                 togglePagoFields(); 

//                 $('#pagoVerificado').val('0'); 
//                 resetRecaptchaPay(); 
//                 toggleGuardarPagoButton(); 
//                 console.log("Consultarplanilla: Planilla encontrada."); 
//             } else {
//                 $("#no_existe").show();
//                 $("#existe").hide();

//                 $('#fecha_limite_pago').val(''); $('#id_inscripcion').val('');
//                 $('#total_pago').val(''); $('#pay').val(''); $('#codigo_planilla_hidden').val('');
//                 $('#iva').val(''); $('#total_iva').val('');
//                 $('#iva_credito').val(''); $('#total_iva_credito').val(''); $('#mitad_total_credito').val('');

//                 $('#tipo_pago').val('0'); 
//                 togglePagoFields(); 

//                 swal("No encontrado", response.message || 'Planilla no encontrada.', "info");

//                 resetRecaptchaPay(); 
//                 toggleGuardarPagoButton(); 
//                 console.log("Consultarplanilla: Planilla NO encontrada."); 
//             }
//         },
//         error: function(xhr) {
//             console.error("Consultarplanilla: Error AJAX:", xhr); 
//             $('#loading').hide();
//             swal("Error", "Ocurrió un error al consultar la planilla. Intente de nuevo.", "error");
//             $("#existe").hide();
//             $("#no_existe").hide();

//             resetRecaptchaPay();
//             toggleGuardarPagoButton(); 
//         }
//     });
//     console.log("--- Consultarplanilla FINALIZADO ---"); 
// }
function Consultarplanilla()  {
    console.log("--- Consultarplanilla INICIADO ---");
    var rif_b = $('#rif_b').val().trim();

    clearFieldError($('#rif_b'));

    if (!rif_b) {
        swal("¡ATENCIÓN!", "El campo 'Código de la planilla' no puede estar vacío.", "warning");
        showFieldError($('#rif_b'), 'El código de la planilla es requerido.');
        resetRecaptchaPay();
        $("#existe").hide();
        toggleGuardarPagoButton();
        console.log("Consultarplanilla: Código de planilla vacío. Retornando.");
        return;
    }

    $('#loading').show();
    $("#existe").hide();
    $("#no_existe").hide();

    // var base_url = window.location.origin+'/asnc/index.php/Diplomado/consulta_og';
    var base_url = '/index.php/Diplomado/consulta_og';

    $.ajax({
        url: base_url,
        method: 'POST',
        data: { rif_b: rif_b },
        dataType: 'json',
        success: function(response) {
            console.log("Consultarplanilla: Respuesta exitosa:", response);
            $('#loading').hide();

            if (response.success && response.data) {
                $("#existe").show();
                $("#no_existe").hide();

                // Limpiar el estado de los campos antes de llenarlos
                $('#tipo_pago').val('0').prop('disabled', false); // Restablecer select de tipo de pago
                $('#fecha_limite_pago').val('');
                $('#prontoPagoField').hide();
                $('#creditoPagoField').hide();

                $('#id_inscripcion').val(response.data.id_inscripcion || '');
                $('#codigo_planilla_hidden').val(response.data.codigo_planilla || '');

                if (response.data.is_second_payment) {
                    // Lógica para la segunda cuota de pago a crédito
                    $('#tipo_pago').val('2').prop('disabled', true); // Seleccionar y deshabilitar
                    $('#pay').val(response.data.pay); // El backend ya envió el monto de la segunda cuota
                    $('#importe').val(response.data.pay); // Asignar el monto de la segunda cuota al campo de importe
                    $('#creditoPagoField').show();
                    swal("¡Atención!", "Esta planilla tiene un pago a crédito pendiente. Por favor, registre la segunda cuota.", "info");
                } else {
                    // Lógica para el pago inicial (pronto pago o primera cuota de crédito)
                    $('#fecha_limite_pago').val(response.data.fecha_limite_pago || '');
                    $('#total_pago').val(response.data.pronto_pago || '');
                    $('#pay').val(response.data.pay || '');
                    
                    calcularContado();
                    calcularCredito();
                    togglePagoFields();
                }

                $('#pagoVerificado').val('0');
                resetRecaptchaPay();
                toggleGuardarPagoButton();
                console.log("Consultarplanilla: Planilla encontrada.");
            } else {
                // ... (Tu lógica existente para "Planilla no encontrada")
                $("#no_existe").show();
                $("#existe").hide();

                $('#fecha_limite_pago').val(''); $('#id_inscripcion').val('');
                $('#total_pago').val(''); $('#pay').val(''); $('#codigo_planilla_hidden').val('');
                $('#iva').val(''); $('#total_iva').val('');
                $('#iva_credito').val(''); $('#total_iva_credito').val(''); $('#mitad_total_credito').val('');

                $('#tipo_pago').val('0').prop('disabled', false);
                togglePagoFields();

                swal("No encontrado", response.message || 'Planilla no encontrada.', "info");

                resetRecaptchaPay();
                toggleGuardarPagoButton();
                console.log("Consultarplanilla: Planilla NO encontrada.");
            }
        },
        error: function(xhr) {
            console.error("Consultarplanilla: Error AJAX:", xhr);
            $('#loading').hide();
            swal("Error", "Ocurrió un error al consultar la planilla. Intente de nuevo.", "error");
            $("#existe").hide();
            $("#no_existe").hide();

            resetRecaptchaPay();
            toggleGuardarPagoButton();
        }
    });
    console.log("--- Consultarplanilla FINALIZADO ---");
}
async function _ejecutarVerificacionPago(recaptchaResponse) {
    console.log("--- _ejecutarVerificacionPago INICIADO (Etapa 1) ---");

    let isValidTxnFields = true; // Validez de los campos de transacción
    let firstInvalidFieldInTxn = null; // Para enfocar

    // Limpiar errores previos en esta sección
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').hide().text('');

    // Validar que la planilla haya sido consultada y encontrada (pre-requisito)
    const planillaEncontrada = $('#id_inscripcion').val().trim() !== '' && $('#codigo_planilla_hidden').val().trim() !== '';
    if (!planillaEncontrada) {
        swal('Atención', 'Primero debe consultar la planilla con un código válido antes de verificar los datos del pago.', 'warning');
        showFieldError($('#rif_b'), 'Debe consultar la planilla.');
        resetRecaptchaPay();
        $('#pagoVerificado').val('0'); // Asegurar estado
        toggleGuardarPagoButton();
        console.log("_ejecutarVerificacionPago: Planilla no consultada. Retornando false.");
        return false;
    }

    // Validaciones de campos de transacción (copiado de verificarDatosPago)
    const tipoPagoField = $('#tipo_pago');
    if (tipoPagoField.val() === '0') {
        showFieldError(tipoPagoField, 'Debe seleccionar una forma de pago.');
        if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = tipoPagoField; isValidTxnFields = false;
    } else { clearFieldError(tipoPagoField); }

    const importeField = $('#importe');
    const importeValue = parseFloat(importeField.val().replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(',', '.')); 
    if (importeField.val().trim() === '' || isNaN(importeValue) || importeValue <= 0) {
        showFieldError(importeField, 'El importe cancelado es obligatorio y debe ser un número positivo.');
        if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = importeField; isValidTxnFields = false;
    } else { clearFieldError(importeField); }

    const fechaPagoField = $('#fechaPago');
    if (fechaPagoField.val().trim() === '') {
        showFieldError(fechaPagoField, 'La fecha de pago es obligatoria.');
        if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = fechaPagoField; isValidTxnFields = false;
    } else if (!isValidDate(fechaPagoField.val())) {
        showFieldError(fechaPagoField, 'Formato de fecha de pago inválido (YYYY-MM-DD).');
        if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = fechaPagoField; isValidTxnFields = false;
    } else { clearFieldError(fechaPagoField); }

    const referenciaField = $('#referencia');
    if (referenciaField.val().trim() === '') {
        showFieldError(referenciaField, 'El número de referencia es obligatorio.');
        if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = referenciaField; isValidTxnFields = false;
    } else { clearFieldError(referenciaField); }

    const cedulaPagadorField = $('#cedulaPagador');
    if (cedulaPagadorField.val().trim() === '' || !isInteger(cedulaPagadorField.val()) || cedulaPagadorField.val().length < 5) {
        showFieldError(cedulaPagadorField, 'La cédula del pagador es obligatoria y debe ser numérica (mín. 5 dígitos).');
        if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = cedulaPagadorField; isValidTxnFields = false;
    } else { clearFieldError(cedulaPagadorField); }

    const telefonoPagadorField = $('#telefonoPagador');
    if (telefonoPagadorField.val().trim() === '' || !isInteger(telefonoPagadorField.val()) || telefonoPagadorField.val().length < 7) {
        showFieldError(telefonoPagadorField, 'El teléfono del pagador es obligatorio y debe ser numérico (mín. 7 dígitos).');
        if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = telefonoPagadorField; isValidTxnFields = false;
    } else { clearFieldError(telefonoPagadorField); }

    const bancoOrigenField = $('#bancoOrigen');
    if (bancoOrigenField.val() === '0') {
        showFieldError(bancoOrigenField, 'Debe seleccionar el Banco de Origen.');
        if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = bancoOrigenField; isValidTxnFields = false;
    } else { clearFieldError(bancoOrigenField); }
    
    // Si validación de campos de transacción falla
    if (!isValidTxnFields) {
        if (firstInvalidFieldInTxn) {
            $('html, body').animate({ scrollTop: firstInvalidFieldInTxn.offset().top - 80 }, 500);
            firstInvalidFieldInTxn.focus();
        }
        swal('Error', 'Por favor complete todos los datos de la transacción correctamente.', 'error');
        resetRecaptchaPay(); 
        $('#pagoVerificado').val('0'); 
        toggleGuardarPagoButton(); // Actualizar estado del botón final
        $('#guardarPagoFinalBtn').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Pago'); // Restaurar botón
        console.log("_ejecutarVerificacionPago: Validaciones frontend fallaron. Retornando false."); 
        return false; 
    }

    // Si los campos de transacción son válidos, procede a la llamada AJAX de verificación
    // const urlVerificarPago = window.location.origin+'/asnc/index.php/Diplomado/verificar_pago'; 
     const urlVerificarPago = '/index.php/Diplomado/verificar_pago';

    
    // Construimos dataToSend para la llamada de verificación (incluye reCAPTCHA)
    const dataToSendForVerification = {
        id_inscripcion: $('#id_inscripcion').val(),
        codigo_planilla: $('#codigo_planilla_hidden').val(),
        rif_b: $('#rif_b').val(), // Este es el input original del usuario
        referencia: referenciaField.val(),
        importe: importeField.val(),
        fechaPago: fechaPagoField.val(),
        bancoOrigen: bancoOrigenField.val(),
        cedulaPagador: cedulaPagadorField.val(),
        telefonoPagador: telefonoPagadorField.val(),
        tipo_pago: tipoPagoField.val(), // Asegurarse de enviar tipo_pago
        telefonoDestino: $('#telefonoDestino').val() || '',
        declaracionPago: $('#declaracionPago').is(':checked') ? '1' : '0',
        'g-recaptcha-response': recaptchaResponse // ReCAPTCHA aquí
    };

    // Actualizar el botón para mostrar "Verificando..." durante la llamada AJAX
    $('#guardarPagoFinalBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Verificando...');

    try {
        const verificationResponse = await $.ajax({ 
            url: urlVerificarPago,
            type: 'POST',
            dataType: 'json',
            data: dataToSendForVerification // <-- Usamos el objeto para la verificación
            // No processData ni contentType, ya que es un objeto plano.
        });

        if (verificationResponse.success) {
            swal('Éxito', verificationResponse.message || 'Datos de pago verificados correctamente. ¡Presione Guardar Pago nuevamente!', 'success');
            $('#pagoVerificado').val('1'); // Marcar pago como verificado con éxito
            resetRecaptchaPay(); // Reiniciar reCAPTCHA
            console.log("_ejecutarVerificacionPago: Verificación exitosa. Retornando true."); 
            return true; // Éxito en la verificación
        } else {
            swal('Error', verificationResponse.message || 'Error al verificar los datos de pago.', 'error');
            $('#pagoVerificado').val('0'); // No verificado  //siled
            resetRecaptchaPay(); 
            console.log("_ejecutarVerificacionPago: Verificación fallida. Retornando false."); 
            return false; // Falla en la verificación
        }
    } catch (xhr) {
        console.error("_ejecutarVerificacionPago: Error AJAX:", xhr); 
        swal('Error', 'Error de conexión al verificar datos de pago.', 'error');
        $('#pagoVerificado').val('0'); // No verificado
        resetRecaptchaPay(); 
        console.log("_ejecutarVerificacionPago: Error de conexión. Retornando false."); 
        return false; // Falla por error de conexión
    } finally {
        // Restaurar el botón independientemente del resultado de la verificación
        $('#guardarPagoFinalBtn').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Pago');
        toggleGuardarPagoButton(); // Actualizar estado del botón final
        console.log("--- _ejecutarVerificacionPago FINALIZADO ---"); 
    }
}
// --- FUNCIÓN PRINCIPAL PARA PROCESAR EL PAGO (VERIFICAR Y LUEGO GUARDAR) ---
 
// Este es el manejador del botón "Guardar Pago" (#guardarPagoFinalBtn).
window.guardarPagoFinal = async function(event) { 
    console.log("--- guardarPagoFinal INICIADO ---"); 
    event.preventDefault(); 

    // Obtener la respuesta del reCAPTCHA al inicio, ya que se usa en ambas etapas
    const recaptchaResponse = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : ''; 

    // CHEQUEO DEL ESTADO ACTUAL (al inicio del clic)
    const planillaEncontrada = $('#id_inscripcion').val().trim() !== '' && $('#codigo_planilla_hidden').val().trim() !== '';
    let pagoVerificadoConExito = $('#pagoVerificado').val() === '1'; // Usamos 'let' porque puede cambiar

    const declaracionAceptada = $('#declaracionPago').is(':checked');
    const recaptchaCompleto = recaptchaResponse.length > 0;

    // --- ¡CORRECCIÓN CLAVE AQUÍ! Declara dataToSend al principio de la función ---
    // dataToSend debe estar disponible para AMBAS etapas
    const dataToSend = {
        id_inscripcion: $('#id_inscripcion').val(),
        codigo_planilla: $('#codigo_planilla_hidden').val(),
        rif_b: $('#rif_b').val(), // Este es el input original del usuario
        referencia: $('#referencia').val(),
        importe: $('#importe').val(),
        fechaPago: $('#fechaPago').val(),
        bancoOrigen: $('#bancoOrigen').val(),
        cedulaPagador: $('#cedulaPagador').val(),
        telefonoPagador: $('#telefonoPagador').val(),
        tipo_pago: $('#tipo_pago').val(), // Asegúrate de que tipo_pago se obtenga correctamente
        telefonoDestino: $('#telefonoDestino').val() || '',
        declaracionPago: $('#declaracionPago').is(':checked') ? '1' : '0',
        'g-recaptcha-response': recaptchaResponse // reCAPTCHA es parte del dataToSend
    };
    // --- FIN CORRECCIÓN CLAVE ---

    console.log("guardarPagoFinal: Condiciones actuales:"); 
    console.log("  Planilla Encontrada:", planillaEncontrada);
    console.log("  Pago Verificado Con Éxito (current):", pagoVerificadoConExito);
    console.log("  Declaración Aceptada:", declaracionAceptada);
    console.log("  reCAPTCHA Completo:", recaptchaCompleto);

    // --- Validación inicial de requisitos mínimos antes de intentar cualquier acción ---
    if (!planillaEncontrada) {
        swal('Atención', 'Primero debe consultar la planilla con un código válido.', 'warning');
        showFieldError($('#rif_b'), 'Debe consultar la planilla.');
        resetRecaptchaPay();
        toggleGuardarPagoButton(); 
        return;
    }
    if (!declaracionAceptada || !recaptchaCompleto) {
        toggleGuardarPagoButton(); 
        swal('Atención', 'Debe aceptar la declaración de pago y completar el reCAPTCHA para continuar.', 'warning');
        resetRecaptchaPay();
        return;
    }

    // Deshabilitar el botón mientras se procesa para evitar doble clic
    $('#guardarPagoFinalBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...');

    // --- ETAPA 1: VERIFICAR DATOS DEL PAGO (si aún no se ha hecho) ---
    if (pagoVerificadoConExito !== true) { 
        console.log("guardarPagoFinal: Iniciando ETAPA 1 - VERIFICACIÓN DE DATOS.");

        let isValidTxnFields = true; // Validez de los campos de transacción
        let firstInvalidFieldInTxn = null; 

        // Limpiar errores previos en esta sección
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').hide().text('');

        // Validaciones de campos de transacción (copiado de verificarDatosPago)
        const tipoPagoField = $('#tipo_pago');
        if (tipoPagoField.val() === '0') {
            showFieldError(tipoPagoField, 'Debe seleccionar una forma de pago.');
            if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = tipoPagoField; isValidTxnFields = false;
        } else { clearFieldError(tipoPagoField); }

        const importeField = $('#importe');
        const importeValue = parseFloat(importeField.val().replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(',', '.')); 
        if (importeField.val().trim() === '' || isNaN(importeValue) || importeValue <= 0) {
            showFieldError(importeField, 'El importe cancelado es obligatorio y debe ser un número positivo.');
            if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = importeField; isValidTxnFields = false;
        } else { clearFieldError(importeField); }

        const fechaPagoField = $('#fechaPago');
        if (fechaPagoField.val().trim() === '') {
            showFieldError(fechaPagoField, 'La fecha de pago es obligatoria.');
            if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = fechaPagoField; isValidTxnFields = false;
        } else if (!isValidDate(fechaPagoField.val())) {
            showFieldError(fechaPagoField, 'Formato de fecha de pago inválido (YYYY-MM-DD).');
            if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = fechaPagoField; isValidTxnFields = false;
        } else { clearFieldError(fechaPagoField); }

        const referenciaField = $('#referencia');
        if (referenciaField.val().trim() === '') {
            showFieldError(referenciaField, 'El número de referencia es obligatorio.');
            if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = referenciaField; isValidTxnFields = false;
        } else { clearFieldError(referenciaField); }

        const cedulaPagadorField = $('#cedulaPagador');
        if (cedulaPagadorField.val().trim() === '' || !isInteger(cedulaPagadorField.val()) || cedulaPagadorField.val().length < 5) {
            showFieldError(cedulaPagadorField, 'La cédula del pagador es obligatoria y debe ser numérica (mín. 5 dígitos).');
            if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = cedulaPagadorField; isValidTxnFields = false;
        } else { clearFieldError(cedulaPagadorField); }

        const telefonoPagadorField = $('#telefonoPagador');
        if (telefonoPagadorField.val().trim() === '' || !isInteger(telefonoPagadorField.val()) || telefonoPagadorField.val().length < 7) {
            showFieldError(telefonoPagadorField, 'El teléfono del pagador es obligatorio y debe ser numérico (mín. 7 dígitos).');
            if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = telefonoPagadorField; isValidTxnFields = false;
        } else { clearFieldError(telefonoPagadorField); }

        const bancoOrigenField = $('#bancoOrigen');
        if (bancoOrigenField.val() === '0') {
            showFieldError(bancoOrigenField, 'Debe seleccionar el Banco de Origen.');
            if (!firstInvalidFieldInTxn) firstInvalidFieldInTxn = bancoOrigenField; isValidTxnFields = false;
        } else { clearFieldError(bancoOrigenField); }
        
        // Si validación de campos de transacción falla
        if (!isValidTxnFields) {
            if (firstInvalidFieldInTxn) {
                $('html, body').animate({ scrollTop: firstInvalidFieldInTxn.offset().top - 80 }, 500);
                firstInvalidFieldInTxn.focus();
            }
            swal('Error', 'Por favor complete todos los datos de la transacción correctamente.', 'error');
            resetRecaptchaPay(); 
            $('#pagoVerificado').val('0'); 
            toggleGuardarPagoButton(); 
            $('#guardarPagoFinalBtn').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Pago'); // Restaurar botón
            console.log("guardarPagoFinal (Verificación): Validaciones frontend fallaron. Retornando."); 
            return; 
        }

        // Si los campos de transacción son válidos, procede a la llamada AJAX de verificación
        // const urlVerificarPago = window.location.origin+'/asnc/index.php/Diplomado/verificar_pago'; 
         const urlVerificarPago = '/index.php/Diplomado/verificar_pago';

        
        try {
            const verificationResponse = await $.ajax({ 
                url: urlVerificarPago,
                type: 'POST',
                dataType: 'json',
                data: dataToSend, // ¡Aquí usamos dataToSend!
                // No processData ni contentType, porque dataToSend es un objeto plano.
            });

            if (verificationResponse.success) {
                swal('Éxito', verificationResponse.message || 'Datos de pago verificados correctamente. ¡Presione Guardar Pago nuevamente!', 'success');
                $('#pagoVerificado').val('1'); // Marcar pago como verificado con éxito
                resetRecaptchaPay(); // Reiniciar reCAPTCHA para la próxima acción
                pagoVerificadoConExito = true; // Actualizar la variable local para el siguiente paso
                console.log("guardarPagoFinal (Verificación): Verificación exitosa."); 
            } else {
                swal('Error', verificationResponse.message || 'Error al verificar los datos de pago.', 'error');
                $('#pagoVerificado').val('0'); // No verificado siled
                resetRecaptchaPay(); 
                pagoVerificadoConExito = false; // Asegurar que sea falso
                console.log("guardarPagoFinal (Verificación): Verificación fallida."); 
            }
        } catch (xhr) {
            console.error("guardarPagoFinal (Verificación AJAX): Error AJAX:", xhr); 
            swal('Error', 'Error de conexión al verificar datos de pago.', 'error');
            $('#pagoVerificado').val('0'); // No verificado  
            resetRecaptchaPay(); 
            pagoVerificadoConExito = false; // Asegurar que sea falso
        } finally {
            // Restaurar el botón independientemente del resultado de la verificación
            $('#guardarPagoFinalBtn').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Pago');
            toggleGuardarPagoButton(); // Actualizar estado del botón final
            console.log("guardarPagoFinal (Verificación AJAX): Petición AJAX completa."); 
        }

        // Si la verificación no fue exitosa, detener la ejecución aquí.
        // El usuario deberá corregir y volver a hacer clic.
        if (pagoVerificadoConExito !== true) {
            console.log("guardarPagoFinal: Verificación no exitosa. Deteniendo ejecución.");
            return;
        }
        console.log("guardarPagoFinal: Verificación exitosa. Continuamos a la etapa de guardado.");

    } // FIN ETAPA 1 (VERIFICACIÓN)


    // --- ETAPA 2: GUARDAR PAGO (solo si pagoVerificadoConExito es TRUE) ---
    // Este código solo se ejecuta si el pago ya fue verificado exitosamente
    const declaracionAceptadaReal = $('#declaracionPago').is(':checked'); 
    const recaptchaResponseReal = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : ''; 

    // Re-validación final antes de guardar (seguridad)
    if (!declaracionAceptadaReal || recaptchaResponseReal.length === 0) {
        console.log("guardarPagoFinal (Guardar): Validaciones Declaración/reCAPTCHA fallaron.");
        toggleGuardarPagoButton(); 
        swal('Atención', 'por favor complete el reCAPTCHA para continuar.', 'warning');
        resetRecaptchaPay(); 
        return;
    }

    // Si todas las condiciones (verificado, declaración, reCAPTCHA) están OK, proceder a guardar
    $('#guardarPagoFinalBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Guardando Pago...');
    
    // Aquí usamos dataToSend para el envío final, ya que contiene todos los campos necesarios.
    // dataToSend ya se definió al principio de la función, incluyendo el reCAPTCHA.
    // Solo actualizamos el g-recaptcha-response si se obtuvo uno nuevo para esta etapa final.
    dataToSend['g-recaptcha-response'] = recaptchaResponseReal; // Asegurar que sea el último token

    // var base_url_guardar_pago_final = window.location.origin + '/asnc/index.php/Diplomado/guardar_pago'; // URL del backend
    // var url_pdf_recibo_final = window.location.origin + '/asnc/index.php/recibonatural/pdfrt?id=' + $('#codigo_planilla_hidden').val();
    // var url_redirigir_final_app = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; 

          var base_url_guardar_pago_final = '/index.php/Diplomado/guardar_pago';
         var url_pdf_recibo_final = '/index.php/recibonatural/pdfrt?id=' + $('#codigo_planilla_hidden').val();
         var url_redirigir_final_app = '/index.php/Diplomado/preinscrip';


    $.ajax({
        url: base_url_guardar_pago_final,
        type: 'POST',
        dataType: 'json',
        data: dataToSend, // <-- ¡Usamos dataToSend aquí también!
        // No processData ni contentType, ya que dataToSend es un objeto plano.
        beforeSend: function() {
            console.log("guardarPagoFinal (Guardar): Enviando AJAX a guardar_pago."); 
        },
        success: function(response) {
            console.log("guardarPagoFinal (Guardar): Respuesta de guardar_pago:", response); 
            if(response.success) {
                swal({
                    title: "¡Éxito!",
                    text: response.message || 'Pago registrado exitosamente. El recibo se descargará a continuación.',
                    type: "success",
                    showCancelButton: false, 
                    confirmButtonColor: "#00897b", 
                    confirmButtonText: "Aceptar", 
                    closeOnConfirm: true 
                }, function() { 
                    if (response.codigo_planilla) { 
                        console.log("Iniciando descarga de PDF para planilla:", response.codigo_planilla);
                        const downloadLink = document.createElement('a');
                        downloadLink.href = url_pdf_recibo_final;
                        downloadLink.download = `Recibo_SNC_${response.codigo_planilla}.pdf`;
                        document.body.appendChild(downloadLink); 
                        downloadLink.click(); 
                        document.body.removeChild(downloadLink); 
                        console.log("Descarga de PDF iniciada.");
                    } else {
                        console.warn('guardarPagoFinal (Guardar): No se recibió código de planilla para generar el recibo PDF.');
                        swal('Advertencia', 'No se pudo generar el recibo PDF. Redirigiendo a la página principal.', 'warning');
                    }
                    
                    // Redirigir la pestaña ACTUAL SIEMPRE al final
                    console.log("Redirigiendo pestaña actual SIEMPRE...");
                    setTimeout(function() {
                        window.location.href = url_redirigir_final_app; 
                    }, 2000); // 2 segundos para dar tiempo a la descarga/SweetAlert
                });
            } else { // Si el backend responde success: false
                swal("Error", response.message || 'Error al registrar el pago', "error");
                resetRecaptchaPay(); 
            }
        },
        error: function(xhr, status, error) {
            console.error("guardarPagoFinal (Guardar): Error AJAX:", xhr); 
            let errorMessage = 'Hubo un error desconocido al registrar el pago.';
            try {
                const errorResponse = JSON.parse(xhr.responseText);
                if (errorResponse && errorResponse.message) {
                    errorMessage = errorResponse.message;
                }
            } catch (e) {
                errorMessage = `Error de conexión con el servidor: ${xhr.status} ${xhr.statusText || error}`;
                if (xhr.responseText) {
                    errorMessage += `\nDetalles: ${xhr.responseText.substring(0, 200)}...`; 
                }
            }
            swal("Error", errorMessage, "error");
            resetRecaptchaPay(); 
        },
        complete: function() {
            $('#guardarPagoFinalBtn').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Pago');
            console.log("guardarPagoFinal (Guardar): Petición AJAX completa. Botón restaurado."); 
        }
    });
    console.log("--- guardarPagoFinal FINALIZADO (Llamada AJAX enviada) ---"); 
}

// --- EVENTOS DEL DOCUMENTO (jQuery ready) ---
$(document).ready(function() {
    console.log("Documento listo. Iniciando eventos y estado inicial."); 
    // --- Eventos para los campos de montos para recálculo ---
    $('#total_pago').on('input', function() {
        allowNumbersAndDecimals(this);
        calcularContado();
    });

    $('#pay').on('input', function() {
        allowNumbersAndDecimals(this);
        calcularCredito();
    });

    // --- Evento para el tipo de pago ---
    $('#tipo_pago').on('change', togglePagoFields);

    // --- Eventos input para campos numéricos/de texto que necesitan limpieza ---
    $('#rif_b').on('input', function() { this.value = this.value.toUpperCase(); }); 
    $('#cedulaPagador').on('input', function() { allowOnlyNumbers(this); });
    $('#telefonoPagador').on('input', function() { allowOnlyNumbers(this); });
    $('#telefonoDestino').on('input', function() { allowOnlyNumbers(this); });
    $('#referencia').on('input', function() { /* Si puede tener letras, no usar allowOnlyNumbers */ }); 
    $('#importe').on('input', function() { allowNumbersAndDecimals(this); });

    // --- Evento del botón Consultar Planilla ---
    // ESTE BOTÓN TIENE onclick="Consultarplanilla()" DIRECTO EN EL HTML.
    // No necesita un .on('click') aquí.

    // --- Botón Verificar Datos del Pago ---
    // Este botón ya no existe en el HTML según la última revisión, su lógica se fusionó.
    // $('#btnVerificarDatosPago').on('click', verificarDatosPago); // Esta línea ya no es necesaria

    // --- Control de la Declaración de Pago y reCAPTCHA ---
    $('#declaracionPago').on('change', toggleGuardarPagoButton);
    // Disparar toggleGuardarPagoButton al inicio para establecer el estado inicial del botón
    toggleGuardarPagoButton(); 

    // --- Botón Final: Guardar Pago ---
    $('#guardarPagoFinalBtn').on('click', guardarPagoFinal); 
    console.log("Eventos iniciales y estado del botón configurados."); 
});