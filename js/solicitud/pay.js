// function Consultarplanilla() {
//     var rif_b = $('#rif_b').val();
    
//     if (!rif_b) {
//         swal("¡ATENCION!", "El campo no puede estar vacío.", "warning");
//         return;
//     }

//     // Mostrar loader mientras se consulta
//     $('#loading').show();
//     $("#existe").hide();
//     $("#no_existe").hide();
//         // var base_url = '/index.php/Diplomado/consulta_og';
//         var base_url = window.location.origin+'/asnc/index.php/Diplomado/consulta_og';


//     base_url
//     $.ajax({
//         url: base_url,
        
//         method: 'POST',
//         data: { rif_b: rif_b },
//         dataType: 'json',
//         success: function(response) {
//             console.log("Respuesta del servidor:", response);
//             $('#loading').hide();
            
//             if (response.success) {
//                 $("#existe").show();
//                 $("#no_existe").hide();
                
//                 if(response.data) {
//                     $('#fecha_limite_pago').val(response.data.fecha_limite_pago || '');
//                     $('#id_inscripcion').val(response.data.id_inscripcion || '');
//                     $('#total_pago').val(response.data.pronto_pago || '');
//                     $('#pay').val(response.data.pay || '');
//                     $('#codigo_planilla').val(response.data.codigo_planilla || '');

//                     // Calcular para contado (total_pago)
//                     calcularContado();
                    
//                     // Calcular para crédito (pay)
//                     calcularCredito();
//                 }
//             } else {
//                 $("#no_existe").show();
//                 $("#existe").hide();
                
//                 // Limpiar todos los campos
//                 $('#fecha_limite_pago').val('');
//                 $('#id_inscripcion').val('');
//                 $('#total_pago').val('');
//                 $('#codigo_planilla').val('');
//                 $('#pay').val('');
                
//                 // Limpiar campos de contado
//                 $('#iva').val('');
//                 $('#total_iva').val('');
                
//                 // Limpiar campos de crédito
//                 $('#iva_credito').val('');
//                 $('#total_iva_credito').val('');
//                 $('#mitad_total_credito').val('');
                
//                 swal("No encontrado", response.message || 'Planilla no encontrada', "info");
//             }
//         },
//         error: function(xhr) {
//             $('#loading').hide();
//             console.error("Error en la consulta:", xhr);
//             swal("Error", "Ocurrió un error al consultar", "error");
//         }
//     });
// }

// // Función para mostrar/ocultar campos según tipo de pago
//  function togglePagoFields() {
//     var tipoPago = $('#tipo_pago').val();
    
//     $('#prontoPagoField').hide();
//     $('#creditoPagoField').hide();
    
//     if (tipoPago == '1') { // Pronto Pago
//         $('#prontoPagoField').show();
//     } else if (tipoPago == '2') { // Crédito
//         $('#creditoPagoField').show();
//     }
// }

// function savei(event) {
//     event.preventDefault();
    
//     // // 1. Validar pago al contado
//     if($('#tipo_pago').val() >= 1 && $('#pagoVerificado').val() != '1') {
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

//         codigo_planilla: $('#rif_b').val(),
//         importe: $('#importe').val(),
//         fechaPago: $('#fechaPago').val(),
//         referencia: $('#referencia').val(),
//         cedulaPagador: $('#cedulaPagador').val(),
//         telefonoPagador: $('#telefonoPagador').val(),
//         telefonoDestino: $('#telefonoDestino').val(),
//         banco: $('#bancoOrigen').val(),
//         tipo_pago: $('#tipo_pago').val()
//     };

//     5. Enviar datos por AJAX
//     var base_url = '/index.php/Diplomado/guardar_pago';
//     var pdf_url = '/index.php/recibonatural/pdfrt?id=' + $('#rif_b').val();
//          var base_url  = window.location.origin+'/asnc/index.php/Diplomado/guardar_pago';
//          var pdf_url  = window.location.origin+'/asnc/index.php/recibonatural/pdfrt?id=' + $('#rif_b').val();


//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         data: formData,
//         success: function(response) {
//             if(response.success) {
//                 alert('Pago registrado exitosamente');
//                 // Abrir el PDF en una nueva pestaña
//                window.location.href = pdf_url;
                
//                 // Redirigir después de mostrar el PDF
//                 setTimeout(function() {
//                     window.location.href = '/asnc/index.php/Diplomado/preinscrip'; 
//                 }, 1000);
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

// // Opcional: Escuchar cambios en los campos
// $(document).ready(function() {
//     $('#total_pago').on('change input', function() {
//         calcularContado();
//     });
    
//     $('#pay').on('change input', function() {
//         calcularCredito();
//     });
// });
//  function verificarPago() {
//     // Limpiar errores previos
//     $('.is-invalid').removeClass('is-invalid');
    
//     // if($('#tipo_pago').val() >= 1) {
//     //     alert('Esta función solo aplica para pagos al contado');
//     //     return;
//     // }

//     // Validar campos obligatorios
//     const camposRequeridos = ['bancoOrigen', 'telefonoPagador', 'referencia', 'fechaPago', 'importe'];
//     let validacionOk = true;
    
//     camposRequeridos.forEach(campo => {
//         if(!$(`#${campo}`).val()) {
//             $(`#${campo}`).addClass('is-invalid');
//             validacionOk = false;
//         }
//     });
    
//     if(!validacionOk) {
//         alert('Por favor complete todos los campos requeridos');
//         return;
//     }

//     // Mostrar loader
//     $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Verificando pago...');

//     // Preparar datos para enviar (usando los mismos nombres que en el ejemplo funcional)
//     const datosPago = {
//         telefonoPagador: $('#telefonoPagador').val(),
//         telefonoDestino: $('#telefonoDestino').val() || '',
//         referencia: $('#referencia').val(),
//         fechaPago: $('#fechaPago').val(),
//         importe: $('#importe').val(),
//         bancoOrigen: $('#bancoOrigen').val()
//     };
//         // var base_url = '/index.php/diplomado/verificar_pago';
//         var base_url = window.location.origin+'/asnc/index.php/Diplomado/verificar_pago';


//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         data: datosPago,
//         success: function(response) {
//             if(response.success) {
//                 alert('Pago verificado correctamente. Puede continuar.');
//                 $('#pagoVerificado').val('1');
//             } else {
//                 let errorMsg = response.message || 'Error al verificar el pago';
//                 if (response.code) errorMsg += ` (Código: ${response.code})`;
//                 if (response.error && typeof response.error === 'object') {
//                     errorMsg += '\n' + JSON.stringify(response.error);
//                 } else if (response.error) {
//                     errorMsg += '\n' + response.error;
//                 }
//                 alert(errorMsg);
//             }
//             $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar');
//         },
//         error: function(xhr) {
//             let errorMsg = 'Error de conexión con el servidor';
//             if (xhr.responseJSON && xhr.responseJSON.message) {
//                 errorMsg = xhr.responseJSON.message;
//             }
//             alert(errorMsg);
//             $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar');
//         }
//     });
// }
// function validarFormulario() {
//     let isValid = true;
    
//     // Limpiar errores previos
//     $('.is-invalid').removeClass('is-invalid');
//     $('.invalid-feedback').remove();
    
//     // Validar cada campo requerido
//     const camposRequeridos = [
//         // { id: '#id_inscripcion', nombre: 'ID Inscripción' },
//         { id: '#rif_b', nombre: 'Código Planilla' },
//         { id: '#importe', nombre: 'Importe', tipo: 'numero', min: 0.01 },
//         { id: '#fechaPago', nombre: 'Fecha de Pago', tipo: 'fecha' },
//         { id: '#referencia', nombre: 'Referencia' },
//         { id: '#cedulaPagador', nombre: 'Cédula Pagador', tipo: 'cedula' },
//         { id: '#telefonoPagador', nombre: 'Teléfono Pagador', tipo: 'telefono' }
//     ];
    
//     camposRequeridos.forEach(campo => {
        
//     });
    
//     return isValid;
// }
// // Función auxiliar para mostrar errores
// function mostrarError($element, mensaje) {
//     $element.addClass('is-invalid');
//     if($element.next('.invalid-feedback').length === 0) {
//         $element.after(`<div class="invalid-feedback">${mensaje}</div>`);
//     } else {
//         $element.next('.invalid-feedback').text(mensaje);
//     }
// }

// // Validar formato de fecha (YYYY-MM-DD)
// function isValidDate(dateString) {
//     const regEx = /^\d{4}-\d{2}-\d{2}$/;
//     if(!dateString.match(regEx)) return false;
//     const d = new Date(dateString);
//     return !isNaN(d.getTime());
// }

// pay.js
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

// function calcularContado() {
//     const totalPagoStr = $('#total_pago').val().replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(',', '.'); 
//     const totalPago = parseFloat(totalPagoStr) || 0;

//     const iva = totalPago * 0.16;
//     const totalConIVA = totalPago + iva;

//     $('#iva').val(iva.toLocaleString('es-VE', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
//     $('#total_iva').val(totalConIVA.toLocaleString('es-VE', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
// }

// function calcularCredito() {
//     const creditoStr = $('#pay').val().replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(',', '.'); 
//     const credito = parseFloat(creditoStr) || 0;

//     const ivaCredito = credito * 0.16;
//     const totalConIVACredito = credito + ivaCredito;
//     const mitadTotal = totalConIVACredito / 2;

//     $('#iva_credito').val(ivaCredito.toLocaleString('es-VE', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
//     $('#total_iva_credito').val(totalConIVACredito.toLocaleString('es-VE', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
//     $('#mitad_total_credito').val(mitadTotal.toLocaleString('es-VE', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
// }

// --- 4. FUNCIONES DE LÓGICA DE INTERFAZ Y ESTADO (Toggle Fields, Toggle Buttons) ---

// Muestra/oculta campos de pago según el tipo de pago seleccionado
function togglePagoFields() {
    const tipoPago = $('#tipo_pago').val();

    $('#prontoPagoField').hide();
    $('#creditoPagoField').hide();

    if (tipoPago == '1') { $('#prontoPagoField').show(); } 
    else if (tipoPago == '2') { $('#creditoPagoField').show(); }

    // Al cambiar el tipo de pago, restablecer el pago como NO verificado
    $('#pagoVerificado').val('0'); 
    toggleGuardarPagoButton(); // Re-evaluar el estado del botón Guardar
}

// Controla la habilitación/deshabilitación del botón "Guardar Pago Final"
function toggleGuardarPagoButton() {
    console.log("--- toggleGuardarPagoButton INICIADO ---"); // CONSOLE LOG
    const declaracionPagoCheckbox = $('#declaracionPago');
    const guardarPagoButton = $('#guardarPagoFinalBtn'); 
    const recaptchaResponse = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : ''; // Obtener de forma segura
    const declaracionPagoFeedback = $('#declaracionPago-feedback'); 
    const recaptchaFeedback = $('#recaptcha-pay-feedback'); 

    // Limpiar errores visuales de la declaración y reCAPTCHA
    clearFieldError(declaracionPagoCheckbox);
    recaptchaFeedback.hide().text('');

    // Condición para habilitar el botón "Guardar Pago Final":
    const planillaEncontrada = $('#id_inscripcion').val().trim() !== '' && $('#codigo_planilla_hidden').val().trim() !== '';
    const pagoVerificadoConExito = $('#pagoVerificado').val() === '1'; // ¡CLAVE!
    const declaracionAceptada = declaracionPagoCheckbox.is(':checked');
    const recaptchaCompleto = recaptchaResponse.length > 0;

    console.log("Estado de condiciones:"); // CONSOLE LOG
    console.log("  1. Planilla Encontrada:", planillaEncontrada);
    console.log("  2. Pago Verificado con Éxito:", pagoVerificadoConExito, "(Valor #pagoVerificado:", $('#pagoVerificado').val(), ")");
    console.log("  3. Declaración Aceptada:", declaracionAceptada);
    console.log("  4. reCAPTCHA Completo:", recaptchaCompleto, "(Longitud de respuesta:", recaptchaResponse.length, ")");

    // Actualizar indicadores visuales
    updateStatusLight('status-planilla-datos', planillaEncontrada);
    updateStatusLight('status-pago-verificado', pagoVerificadoConExito);
    updateStatusLight('status-declaracion', declaracionAceptada);
    updateStatusLight('status-recaptcha', recaptchaCompleto);


    if (planillaEncontrada && pagoVerificadoConExito && declaracionAceptada && recaptchaCompleto) {
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
    }
    console.log("--- toggleGuardarPagoButton FINALIZADO ---"); // CONSOLE LOG
}


// --- 5. FUNCIONES PRINCIPALES DE FLUJO (Llamadas por botones o eventos) ---

// FUNCIÓN PARA CONSULTAR PLANILLA (GLOBAL PARA onclick="Consultarplanilla()")
window.Consultarplanilla = function() { 
    console.log("--- Consultarplanilla INICIADO ---"); // CONSOLE LOG
    var rif_b = $('#rif_b').val().trim();

    clearFieldError($('#rif_b')); 

    if (!rif_b) {
        swal("¡ATENCIÓN!", "El campo 'Código de la planilla' no puede estar vacío.", "warning");
        showFieldError($('#rif_b'), 'El código de la planilla es requerido.');
        resetRecaptchaPay(); 
        $("#existe").hide(); // Ocultar secciones de pago si el código está vacío
        toggleGuardarPagoButton(); 
        console.log("Consultarplanilla: Código de planilla vacío. Retornando."); // CONSOLE LOG
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
            console.log("Consultarplanilla: Respuesta exitosa:", response); // CONSOLE LOG
            $('#loading').hide();

            if (response.success && response.data) {
                $("#existe").show();
                $("#no_existe").hide();

                $('#fecha_limite_pago').val(response.data.fecha_limite_pago || '');
                $('#id_inscripcion').val(response.data.id_inscripcion || '');
                $('#total_pago').val(response.data.pronto_pago || '');
                $('#pay').val(response.data.pay || '');
                $('#codigo_planilla_hidden').val(response.data.codigo_planilla || '');

                calcularContado();
                calcularCredito();
                togglePagoFields(); 

                $('#pagoVerificado').val('0'); 
                resetRecaptchaPay(); // Reiniciar reCAPTCHA tras una consulta exitosa (para nuevo intento de pago)
                toggleGuardarPagoButton(); 
                console.log("Consultarplanilla: Planilla encontrada."); // CONSOLE LOG
            } else {
                $("#no_existe").show();
                $("#existe").hide();

                $('#fecha_limite_pago').val(''); $('#id_inscripcion').val('');
                $('#total_pago').val(''); $('#pay').val(''); $('#codigo_planilla_hidden').val('');
                $('#iva').val(''); $('#total_iva').val('');
                $('#iva_credito').val(''); $('#total_iva_credito').val(''); $('#mitad_total_credito').val('');

                $('#tipo_pago').val('0'); 
                togglePagoFields(); 

                swal("No encontrado", response.message || 'Planilla no encontrada.', "info");

                resetRecaptchaPay(); 
                toggleGuardarPagoButton(); 
                console.log("Consultarplanilla: Planilla NO encontrada."); // CONSOLE LOG
            }
        },
        error: function(xhr) {
            console.error("Consultarplanilla: Error AJAX:", xhr); // CONSOLE LOG
            $('#loading').hide();
            swal("Error", "Ocurrió un error al consultar la planilla. Intente de nuevo.", "error");
            $("#existe").hide();
            $("#no_existe").hide();

            resetRecaptchaPay();
            toggleGuardarPagoButton(); 
        }
    });
    console.log("--- Consultarplanilla FINALIZADO ---"); // CONSOLE LOG
}

// FUNCIÓN PARA VERIFICAR DATOS DEL PAGO (GLOBAL PARA onclick="verificarDatosPago()")
window.verificarDatosPago = function(event) {
    console.log("--- verificarDatosPago INICIADO ---"); // CONSOLE LOG
    event.preventDefault(); 

    let isValid = true;
    let firstInvalidField = null;

    // Limpiar errores previos al iniciar la validación
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').hide().text(''); 

    // Validar que la planilla haya sido consultada y encontrada (pre-requisito)
    if ($('#id_inscripcion').val().trim() === '' || $('#codigo_planilla_hidden').val().trim() === '') {
        swal('Atención', 'Primero debe consultar la planilla con un código válido antes de verificar los datos del pago.', "warning");
        showFieldError($('#rif_b'), 'Debe consultar la planilla.'); 
        resetRecaptchaPay(); 
        $('#pagoVerificado').val('0'); 
        toggleGuardarPagoButton(); 
        console.log("verificarDatosPago: Planilla no consultada/encontrada. Retornando."); 
        return;
    }

    // Validar que se haya seleccionado una forma de pago
    const tipoPagoField = $('#tipo_pago');
    if (tipoPagoField.val() === '0') {
        showFieldError(tipoPagoField, 'Debe seleccionar una forma de pago.');
        if (!firstInvalidField) firstInvalidField = tipoPagoField; isValid = false;
    } else { clearFieldError(tipoPagoField); }

    // Validar Importe
    const importeField = $('#importe');
    const importeValue = parseFloat(importeField.val().replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(',', '.')); 
    if (importeField.val().trim() === '' || isNaN(importeValue) || importeValue <= 0) {
        showFieldError(importeField, 'El importe cancelado es obligatorio y debe ser un número positivo.');
        if (!firstInvalidField) firstInvalidField = importeField; isValid = false;
    } else { clearFieldError(importeField); }

    // Validar Fecha de Pago
    const fechaPagoField = $('#fechaPago');
    if (fechaPagoField.val().trim() === '') {
        showFieldError(fechaPagoField, 'La fecha de pago es obligatoria.');
        if (!firstInvalidField) firstInvalidField = fechaPagoField; isValid = false;
    } else if (!isValidDate(fechaPagoField.val())) {
        showFieldError(fechaPagoField, 'Formato de fecha de pago inválido (YYYY-MM-DD).');
        if (!firstInvalidField) firstInvalidField = fechaPagoField; isValid = false;
    } else { clearFieldError(fechaPagoField); }

    // Validar Referencia
    const referenciaField = $('#referencia');
    if (referenciaField.val().trim() === '') {
        showFieldError(referenciaField, 'El número de referencia es obligatorio.');
        if (!firstInvalidField) firstInvalidField = referenciaField; isValid = false;
    } else { clearFieldError(referenciaField); }

    // Validar Cédula del Pagador
    const cedulaPagadorField = $('#cedulaPagador');
    if (cedulaPagadorField.val().trim() === '' || !isInteger(cedulaPagadorField.val()) || cedulaPagadorField.val().length < 5) {
        showFieldError(cedulaPagadorField, 'La cédula del pagador es obligatoria y debe ser numérica (mín. 5 dígitos).');
        if (!firstInvalidField) firstInvalidField = cedulaPagadorField; isValid = false;
    } else { clearFieldError(cedulaPagadorField); }

    // Validar Teléfono del Pagador
    const telefonoPagadorField = $('#telefonoPagador');
    if (telefonoPagadorField.val().trim() === '' || !isInteger(telefonoPagadorField.val()) || telefonoPagadorField.val().length < 7) {
        showFieldError(telefonoPagadorField, 'El teléfono del pagador es obligatorio y debe ser numérico (mín. 7 dígitos).');
        if (!firstInvalidField) firstInvalidField = telefonoPagadorField; isValid = false;
    } else { clearFieldError(telefonoPagadorField); }

    // Validar Banco de Origen
    const bancoOrigenField = $('#bancoOrigen');
    if (bancoOrigenField.val() === '0') {
        showFieldError(bancoOrigenField, 'Debe seleccionar el Banco de Origen.');
        if (!firstInvalidField) firstInvalidField = bancoOrigenField; isValid = false;
    } else { clearFieldError(bancoOrigenField); }

    // Si alguna validación frontend falla, mostrar SweetAlert y reiniciar reCAPTCHA
    if (!isValid) {
        if (firstInvalidField) {
            $('html, body').animate({ scrollTop: firstInvalidField.offset().top - 80 }, 500);
            firstInvalidField.focus();
        }
        swal('Error', 'Por favor complete todos los datos de la transacción correctamente.', 'error');
        resetRecaptchaPay(); 
        $('#pagoVerificado').val('0'); 
        toggleGuardarPagoButton(); 
        console.log("verificarDatosPago: Validaciones frontend fallaron."); 
        return;
    }

    const datosVerificacion = {
        id_inscripcion: $('#id_inscripcion').val(),
        codigo_planilla: $('#codigo_planilla_hidden').val(), 
        referencia: referenciaField.val(),
        importe: importeField.val(),
        fechaPago: fechaPagoField.val(),
        bancoOrigen: bancoOrigenField.val(),
        cedulaPagador: cedulaPagadorField.val(),
        telefonoPagador: telefonoPagadorField.val(),
        telefonoDestino: $('#telefonoDestino').val() || '' 
    };

    // const urlVerificarPago = window.location.origin+'/asnc/index.php/Diplomado/verificar_pago'; 
     var urlVerificarPago = '/index.php/Diplomado/verificar_pago';

    $('#btnVerificarDatosPago').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Verificando...');

    $.ajax({
        url: urlVerificarPago,
        type: 'POST',
        dataType: 'json',
        data: datosVerificacion,
        success: function(response) {
            console.log("verificarDatosPago: Respuesta backend:", response); 
            if (response.success) {
                swal('Éxito', response.message || 'Datos de pago verificados correctamente. ¡Presione Guardar Pago para finalizar!', 'success');
                $('#pagoVerificado').val('1'); 
                resetRecaptchaPay(); 
                console.log("verificarDatosPago: Verificación exitosa. Pago verificado a '1'."); 
            } else {
                swal('Error', response.message || 'Error al verificar los datos de pago.', 'error');
                $('#pagoVerificado').val('1'); 
                resetRecaptchaPay(); 
                console.log("verificarDatosPago: Verificación fallida. Pago verificado a '0'."); 
            }
            toggleGuardarPagoButton(); 
        },
        error: function(xhr) {
            console.error("verificarDatosPago: Error AJAX:", xhr); 
            swal('Error', 'Error de conexión al verificar datos de pago.', 'error');
            $('#pagoVerificado').val('0'); 
            resetRecaptchaPay(); 
            toggleGuardarPagoButton(); 
        },
        complete: function() {
            $('#btnVerificarDatosPago').prop('disabled', false).html('<i class="fas fa-check-circle mr-2"></i>Verificar Datos del Pago');
            console.log("verificarDatosPago: Petición AJAX completa."); 
        }
    });
    console.log("--- verificarDatosPago FINALIZADO (Llamada AJAX enviada) ---"); 
}


// FUNCIÓN PRINCIPAL PARA GUARDAR PAGO (Llamada por guardarPagoFinalBtn)
window.guardarPagoFinal = function(event) { 
    console.log("--- guardarPagoFinal INICIADO ---"); 
    event.preventDefault(); 

    const planillaEncontrada = $('#id_inscripcion').val().trim() !== '' && $('#codigo_planilla_hidden').val().trim() !== '';
    const pagoVerificadoConExito = $('#pagoVerificado').val() === '1';
    const declaracionAceptada = $('#declaracionPago').is(':checked');
    const recaptchaResponse = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : ''; 

    console.log("guardarPagoFinal: Condiciones antes de guardar:"); 
    console.log("  Planilla Encontrada:", planillaEncontrada);
    console.log("  Pago Verificado Con Éxito:", pagoVerificadoConExito);
    console.log("  Declaración Aceptada:", declaracionAceptada);
    console.log("  reCAPTCHA Completo:", recaptchaResponse.length > 0);

    if (!planillaEncontrada || !pagoVerificadoConExito || !declaracionAceptada || recaptchaResponse.length === 0) {
        console.log("guardarPagoFinal: Validaciones previas fallaron. No se guardará."); 
        toggleGuardarPagoButton(); // Asegura que los mensajes visuales y el disabled se activen
        swal('Atención', 'Asegúrese de que la planilla esté consultada, los datos de pago verificados, la declaración aceptada y el reCAPTCHA completo.', 'warning');
        resetRecaptchaPay(); 
        return; 
    }

    $('#guardarPagoFinalBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Guardando Pago...');
    // console.log("--- Depurando FormData en guardarPagoFinal ---");
    // const formData = new FormData($('#sav_ext')[0]); 
    // formData.append('g-recaptcha-response', recaptchaResponse); 
const dataToSend = {
        id_inscripcion: $('#id_inscripcion').val(),
        codigo_planilla: $('#codigo_planilla_hidden').val(),
        rif_b: $('#rif_b').val(),

        referencia: $('#referencia').val(),
        importe: $('#importe').val(),
        fechaPago: $('#fechaPago').val(),
        bancoOrigen: $('#bancoOrigen').val(),
        cedulaPagador: $('#cedulaPagador').val(),
        telefonoPagador: $('#telefonoPagador').val(),
        tipo_pago: $('#tipo_pago').val(),
        telefonoDestino: $('#telefonoDestino').val() || '',
        declaracionPago: $('#declaracionPago').is(':checked') ? '1' : '0', // Enviar '1' o '0'
        'g-recaptcha-response': recaptchaResponse // Clave reCAPTCHA
        // Añade todos los demás campos de tu formulario aquí
    };

    
    // var base_url_guardar_pago = window.location.origin + '/asnc/index.php/Diplomado/guardar_pago';
    // var base_url_pdf_recibo = window.location.origin + '/asnc/index.php/recibonatural/pdfrt?id=' + $('#rif_b').val();
    
    // var base_url_redirigir = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; 

     var base_url_guardar_pago = '/index.php/Diplomado/guardar_pago';
     var base_url_pdf_recibo = '/index.php/recibonatural/pdfrt?id=' + $('#rif_b').val();
     var base_url_redirigir = '/index.php/Diplomado/preinscrip';

    $.ajax({
        url: base_url_guardar_pago,
        type: 'POST',
        dataType: 'json',
        data: dataToSend, 
        beforeSend: function() {
            console.log("guardarPagoFinal: Enviando AJAX a guardar_pago."); 
        },
         success: function(response) {
            console.log("guardarPagoFinal: Respuesta de guardar_pago:", response); 
            if(response.success) {
                swal({
                    title: "¡Éxito!",
                    text: response.message || 'Pago registrado exitosamente.',
                    type: "success",
                    showCancelButton: false, 
                    confirmButtonColor: "#00897b", 
                    confirmButtonText: "Aceptar", 
                    closeOnConfirm: true 
                }, function() { // <-- ESTE ES EL CALLBACK DE SWEETALERT 1.x
                    // Este código se ejecuta cuando el usuario hace clic en "Aceptar" en el SweetAlert
                    
                    if (response.codigo_planilla) { 
                       // console.log("Iniciando descarga de PDF para planilla:", response.codigo_planilla);
                        
                        // --- ¡CORRECCIÓN CLAVE AQUÍ PARA FORZAR LA DESCARGA Y LUEGO REDIRIGIR! ---
                        // Crea un enlace temporal en el DOM
                        const downloadLink = document.createElement('a');
                        downloadLink.href = base_url_pdf_recibo;
                        // downloadLink.download = `Recibo_SNC_${response.codigo_planilla}.pdf`; // Sugiere un nombre de archivo
                        // document.body.appendChild(downloadLink); // Añadir al DOM temporalmente
                        downloadLink.click(); // Simular clic para iniciar la descarga
                        document.body.removeChild(downloadLink); // Eliminar el enlace del DOM

                           setTimeout(function() {
                            window.location.href = base_url_redirigir; // Usa la variable global para mayor seguridad de ruta
                        }, 2000); 
                                  
                    } else {
                        console.warn('guardarPagoFinal: No se recibió código de planilla para generar el recibo PDF.');
                        swal('Advertencia', 'No se pudo generar el recibo PDF. Redirigiendo a la página principal.', 'warning');
                        setTimeout(function() {
                            window.location.href = base_url_redirigir; 
                        }, 1000);
                    }
                });
            } else {
                swal("Error", response.message || 'Error al registrar el pago', "error");
                resetRecaptchaPay(); 
            }
        },
        error: function(xhr, status, error) {
            console.error("guardarPagoFinal: Error AJAX:", xhr); 
            let errorMessage = 'Hubo un error desconocido al registrar la inscripción.';
            try {
                const errorResponse = JSON.parse(xhr.responseText);
                if (errorResponse && errorResponse.message) {
                    errorMessage = errorResponse.message;
                }
            } catch (e) {
            }
            swal("Error", errorMessage, "error");
            resetRecaptchaPay(); 
        },
        complete: function() {
            $('#guardarPagoFinalBtn').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Pago');
            //console.log("guardarPagoFinal: Petición AJAX completa. Botón restaurado."); 
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
    $('#btnVerificarDatosPago').on('click', verificarDatosPago); // Adjunta el evento jQuery

    // --- Control de la Declaración de Pago y reCAPTCHA ---
    $('#declaracionPago').on('change', toggleGuardarPagoButton);
    // Disparar toggleGuardarPagoButton al inicio para establecer el estado inicial del botón
    toggleGuardarPagoButton(); 

    // --- Botón Final: Guardar Pago ---
    // Adjunta la función principal de guardado al botón final.
    $('#guardarPagoFinalBtn').on('click', guardarPagoFinal); 
    console.log("Eventos iniciales y estado del botón configurados."); 
});

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