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
       var base_url = '/index.php/Diplomado/consulta_planilla';
        //   var base_url = window.location.origin+'/asnc/index.php/Diplomado/consulta_planilla';
       //var base_url = '/index.php/Diplomado/consulta_og';


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
                    $('#id_inscripcion').val(response.data.id_inscripcion_grupal || '');
                    $('#total_pago').val(response.data.pronto_pago || '');
                    $('#pay').val(response.data.pay || '');
                    $('#codigo_planilla').val(response.data.codigo_planilla || '');
                    $('#id_ente').val(response.data.ente_gubernamental || '');

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
                $('#retencion1, #retencion2, #retencion3').val('');
            $('#total_despues_retenciones, #total_despues_retenciones_credito').val('');
            
            // Ocultar campos hasta que se seleccione tipo de pago
            $('#totalDespuesRetencionesField, #totalDespuesRetencionesCreditoField').hide();
                
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
    
    // Obtener tipo de ente (1: gubernamental, 2: no gubernamental)
    var tipoEnte = $('#id_ente').val();
    var ivaPercent = (tipoEnte == 1) ? 0.08 : 0.16;
    
    var iva = totalPago * ivaPercent;
    var totalConIVA = totalPago + iva;
    
    // Actualizar etiqueta del IVA
    $('label[for="iva"]').text('IVA (' + (ivaPercent * 100) + '%)');
    
    $('#iva').val(iva.toFixed(2));
    $('#total_iva').val(totalConIVA.toFixed(2));
      calcularRetenciones(); // Agregar esta línea al final
}

// Función para calcular crédito (pay)
function calcularCredito() {
    var creditoStr = $('#pay').val().replace(/[^0-9.-]/g, '');
    var credito = parseFloat(creditoStr) || 0;
    
    // Obtener tipo de ente (1: gubernamental, 2: no gubernamental)
    var tipoEnte = $('#id_ente').val();
    var ivaPercent = (tipoEnte == 1) ? 0.08 : 0.16;
    var ivaLabel = (tipoEnte == 1) ? '8' : '16';
    
    var ivaCredito = credito * ivaPercent;
    var totalConIVACredito = credito + ivaCredito;
    var mitadTotal = totalConIVACredito / 2;
    
    // Actualizar etiqueta del IVA
    $('label[for="iva_credito"]').text('IVA (' + ivaLabel + '%) Crédito:');
    
    $('#iva_credito').val(ivaCredito.toFixed(2));
    $('#total_iva_credito').val(totalConIVACredito.toFixed(2));
    $('#mitad_total_credito').val(mitadTotal.toFixed(2));
     calcularRetenciones(); // Agregar esta línea al final
}
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

// Función para calcular retenciones
function calcularRetenciones() {
    // Obtener valores de retenciones y convertirlos a números
    var retencion1 = parseFloat($('#retencion1').val()) || 0;
    var retencion2 = parseFloat($('#retencion2').val()) || 0;
    var retencion3 = parseFloat($('#retencion3').val()) || 0;
    var totalRetenciones = retencion1 + retencion2 + retencion3;

    // Calcular para Pronto Pago
    if ($('#tipo_pago').val() == 1) {
        var totalPago = parseFloat($('#total_iva').val().replace(/[^0-9.-]/g, '')) || 0;
        var totalDespuesRetenciones = totalPago - totalRetenciones;
        $('#total_despues_retenciones').val(totalDespuesRetenciones.toFixed(2));
        $('#totalDespuesRetencionesField').show();
        $('#totalDespuesRetencionesCreditoField').hide();
    }
    // Calcular para Crédito
    else if ($('#tipo_pago').val() == 2) {
        var credito = parseFloat($('#total_iva_credito').val().replace(/[^0-9.-]/g, '')) || 0;
        var mitadTotal = credito / 2;

        
        var totalDespuesRetencionesCredito = mitadTotal - totalRetenciones;
        $('#total_despues_retenciones_credito').val(totalDespuesRetencionesCredito.toFixed(2));
        $('#totalDespuesRetencionesCreditoField').show();
        $('#totalDespuesRetencionesField').hide();
    }
}

// Modificar la función togglePagoFields para manejar los nuevos campos
function togglePagoFields() {
    var tipoPago = $('#tipo_pago').val();
    
    if (tipoPago == 1) {
        $('#prontoPagoField').show();
        $('#creditoPagoField').hide();
        $('#totalDespuesRetencionesField').show();
        $('#totalDespuesRetencionesCreditoField').hide();
    } else if (tipoPago == 2) {
        $('#prontoPagoField').hide();
        $('#creditoPagoField').show();
        $('#totalDespuesRetencionesField').hide();
        $('#totalDespuesRetencionesCreditoField').show();
    } else {
        $('#prontoPagoField').hide();
        $('#creditoPagoField').hide();
        $('#totalDespuesRetencionesField').hide();
        $('#totalDespuesRetencionesCreditoField').hide();
    }
    
    calcularRetenciones(); // Calcular al cambiar tipo de pago
}

// Agregar event listeners a los campos de retención
$('#retencion1, #retencion2, #retencion3').on('input', function() {
    calcularRetenciones();
});

// Función para validar la referencia

// function validarReferencia() {
//     const referencia = $('#referencia').val().trim();
    
//     if (!referencia) {
//         swal("Error", "Por favor ingrese un número de referencia", "warning");
//         return;
//     }

//     // Mostrar loader
//     $('#validarReferencia').html('<i class="fas fa-spinner fa-spin"></i> Validando...');
//     $('#validarReferencia').prop('disabled', true);
    
//     // Usar base_url de CodeIgniter para evitar problemas de ruta
//     var base_url = '<?= base_url("Diplomado/verificar_referencia") ?>';

//     console.log("Enviando solicitud a:", base_url); // Depuración
    
//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         data: { 
//             referencia: referencia,
//             _token: '<?= $this->security->get_csrf_hash() ?>' // Protección CSRF
//         },
//         success: function(response, status, xhr) {
//             console.log("Respuesta recibida:", response); // Depuración
            
//             $('#validarReferencia').html('<i class="fas fa-check"></i> Validar');
//             $('#validarReferencia').prop('disabled', false);

//             if (response && response.success) {
//                 // Mostrar información del movimiento
//                 const mov = response.data;
//                 $('#referenciaInfo').show();
//                 $('#referenciaDetails').html(`
//                     <p><strong>Referencia:</strong> ${mov.referencia || 'N/A'}</p>
//                     <p><strong>Descripción:</strong> ${mov.descripcion || 'N/A'}</p>
//                     <p><strong>Fecha:</strong> ${mov.fecha || 'N/A'}</p>
//                     <p><strong>Hora:</strong> ${mov.hora || 'N/A'}</p>
//                     <p><strong>Tipo:</strong> ${mov.mov || 'N/A'}</p>
//                     <p><strong>Importe:</strong> ${mov.importe || 'N/A'}</p>
//                     <p><strong>Saldo:</strong> ${mov.saldo || 'N/A'}</p>
//                 `);
                
//                 $('#guardar').show();
                
//                 if (mov.importe) {
//                     $('#monto').val(Math.abs(parseFloat(mov.importe))).trigger('change');
//                 }
//                 if (mov.fecha) {
//                     $('#fechaPago').val(mov.fecha.split(' ')[0]); // Tomar solo la fecha si viene con hora
//                 }
                
//                 swal("Éxito", response.message || "Referencia validada correctamente", "success");
//             } else {
//                 $('#referenciaInfo').hide();
//                 $('#guardar').hide();
//                 swal("Error", response.message || "No se encontró la referencia", "error");
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error("Error en la solicitud:", status, error, xhr.responseText); // Depuración
            
//             $('#validarReferencia').html('<i class="fas fa-check"></i> Validar');
//             $('#validarReferencia').prop('disabled', false);
            
//             let errorMsg = "Ocurrió un error al validar la referencia";
//             try {
//                 const response = JSON.parse(xhr.responseText);
//                 errorMsg = response.message || errorMsg;
//             } catch (e) {
//                 errorMsg += ` (${xhr.status}: ${error})`;
//             }
            
//             swal("Error", errorMsg, "error");
//         }
//     });
// }

// function validarReferencia() {
//     const referencia = $('#referencia').val().trim();
    
//     if (!referencia) {
//         Swal.fire({
//             title: 'Error',
//             text: 'Por favor ingrese un número de referencia',
//             icon: 'warning'
//         });
//         return;
//     }

//     // Mostrar loader
//     const boton = $('#validarReferencia');
//     boton.html('<i class="fas fa-spinner fa-spin"></i> Validando...');
//     boton.prop('disabled', true);
    
//     // Limpiar resultados anteriores
//     $('#referenciaInfo').hide();
//     $('#referenciaDetails').html('');
//     $('#guardar').prop('disabled', true);
//     $('#pagoVerificado').val('0');
//          var base_url = '<?= base_url("Diplomado/verificar_referencia_v2") ?>';
     
//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         data: { 
//             referencia: referencia,
//             '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
//         },
//         timeout: 30000, // 30 segundos de timeout
//         success: function(response) {
//             if (response.success) {
//                 // Mostrar información del movimiento
//                 const mov = response.data;
//                 $('#referenciaInfo').show();
//                 $('#referenciaDetails').html(`
//                     <p><strong>Referencia:</strong> ${mov.referencia || 'N/A'}</p>
//                     <p><strong>Descripción:</strong> ${mov.descripcion || 'N/A'}</p>
//                     <p><strong>Fecha:</strong> ${mov.fecha || 'N/A'}</p>
//                     <p><strong>Hora:</strong> ${mov.hora || 'N/A'}</p>
//                     <p><strong>Tipo:</strong> ${mov.mov || 'N/A'}</p>
//                     <p><strong>Importe:</strong> ${mov.importe || 'N/A'}</p>
//                     <p><strong>Saldo:</strong> ${mov.saldo || 'N/A'}</p>
//                 `);
                
//                 // Actualizar campos del formulario
//                 if (mov.importe) {
//                     $('#monto').val(Math.abs(parseFloat(mov.importe))).trigger('change');
//                 }
//                 if (mov.fecha) {
//                     $('#fechaPago').val(mov.fecha.split(' ')[0]); // Tomar solo la fecha si viene con hora
//                 }
                
//                 // Habilitar guardado
//                 $('#guardar').prop('disabled', false);
//                 $('#pagoVerificado').val('1');
                
//                 Swal.fire({
//                     title: 'Éxito',
//                     text: response.message || 'Referencia validada correctamente',
//                     icon: 'success'
//                 });
//             } else {
//                 Swal.fire({
//                     title: 'Error',
//                     text: response.message || 'No se pudo validar la referencia',
//                     icon: 'error'
//                 });
//             }
//         },
//         error: function(xhr, status, error) {
//             let errorMsg = 'Error al conectar con el servidor';
//             if (xhr.responseJSON && xhr.responseJSON.message) {
//                 errorMsg = xhr.responseJSON.message;
//             } else if (status === 'timeout') {
//                 errorMsg = 'El servidor no respondió a tiempo';
//             }
            
//             Swal.fire({
//                 title: 'Error',
//                 text: errorMsg,
//                 icon: 'error'
//             });
//         },
//         complete: function() {
//             boton.html('<i class="fas fa-check"></i> Validar');
//             boton.prop('disabled', false);
//         }
//     });
// }

// $(document).ready(function() {

//     // AHORA SÍ: Definimos la función validarReferencia.
//     // Al estar aquí, se asegura que ya está definida cuando el evento click se asigne.
//     function validarReferencia() {
//         const referencia = $('#referencia').val().trim();
        
//         if (!referencia) {
//             Swal.fire({
//                 title: 'Error',
//                 text: 'Por favor ingrese un número de referencia',
//                 icon: 'warning'
//             });
//             return;
//         }

//         // Mostrar loader en el botón
//         const boton = $('#validarReferencia');
//         boton.html('<i class="fas fa-spinner fa-spin"></i> Validando...');
//         boton.prop('disabled', true);
        
//         // Limpiar resultados anteriores y deshabilitar guardar
//         $('#referenciaInfo').hide();
//         $('#referenciaDetails').html('');
//         $('#guardar').prop('disabled', true); // Asegúrate de que tu botón 'guardar' tenga este ID
//         $('#pagoVerificado').val('0');

//         // *** USANDO LAS VARIABLES GLOBALES QUE DEFINIMOS EN EL HTML ***
//         // Aquí usamos las variables 'BASE_URL', 'CI_CSRF_TOKEN_NAME', 'CI_CSRF_HASH'
//         // que se pasaron de PHP a JavaScript en el paso 1.
//           var base_url = window.location.origin+'/asnc/index.php/Diplomado/verificar_referencia_v2';
//     //    var base_url = '/index.php/Diplomado/verificar_referencia_v2';


//         // var urlApi = BASE_URL + "Diplomado/verificar_referencia_v2";
//         // var csrfTokenName = CI_CSRF_TOKEN_NAME;
//         // var csrfHash = CI_CSRF_HASH;

//         // Preparamos los datos a enviar en la petición AJAX
//          let postData = {
//             referencia: referencia // ¡SOLO ENVÍAS LA REFERENCIA!
//         };
//         // postData[csrfTokenName] = csrfHash; // Agregamos el token CSRF dinámicamente

//         // Realizamos la petición AJAX
//         $.ajax({
//             url: base_url, // Usamos la URL construida con BASE_URL
//             type: 'POST',
//             dataType: 'json',
//             data: postData, // Enviamos el objeto con la referencia y el token
//             timeout: 30000, // 30 segundos de timeout
//             success: function(response) {
//                 if (response.success) {
//                     // Si la API encontró la referencia, mostramos los detalles
//                     const mov = response.data; // 'mov' es el objeto con los detalles de la referencia
//                     $('#referenciaInfo').show();
//                     $('#referenciaDetails').html(`
//                         <p><strong>Referencia:</strong> ${mov.referencia || 'N/A'}</p>
//                         <p><strong>Descripción:</strong> ${mov.descripcion || 'N/A'}</p>
//                         <p><strong>Fecha:</strong> ${mov.fecha || 'N/A'}</p>
//                         <p><strong>Hora:</strong> ${mov.hora || 'N/A'}</p>
//                         <p><strong>Tipo:</strong> ${mov.mov || 'N/A'}</p>
//                         <p><strong>Importe:</strong> ${mov.importe || 'N/A'}</p>
//                         <p><strong>Saldo:</strong> ${mov.saldo || 'N/A'}</p>
//                     `);
                    
//                     // Actualizar campos del formulario con la información del pago
//                     if (mov.importe) {
//                         $('#monto').val(Math.abs(parseFloat(mov.importe))).trigger('change');
//                     }
//                     if (mov.fecha) {
//                         $('#fechaPago').val(mov.fecha.split(' ')[0]); // Solo la fecha
//                     }
                    
//                     // Habilitar el botón de guardar
//                     $('#guardar').prop('disabled', false);
//                     $('#pagoVerificado').val('1'); // Marcar como pago verificado
                    
//                     Swal.fire({
//                         title: 'Éxito',
//                         text: response.message || 'Referencia validada correctamente',
//                         icon: 'success'
//                     });
//                 } else {
//                     // Si la API no encontró la referencia o hubo un error
//                     $('#referenciaInfo').hide(); // Ocultar info si no hay referencia
//                     $('#guardar').prop('disabled', true); // Deshabilitar guardar
//                     $('#pagoVerificado').val('0'); // Marcar como no verificado
//                     Swal.fire({
//                         title: 'Error',
//                         text: response.message || 'No se pudo validar la referencia',
//                         icon: 'error'
//                     });
//                 }
//             },
//             error: function(xhr, status, error) {
//                 // Manejo de errores de la petición AJAX (red, timeout, etc.)
//                 let errorMsg = 'Error al conectar con el servidor';
//                 if (xhr.responseJSON && xhr.responseJSON.message) {
//                     errorMsg = xhr.responseJSON.message;
//                 } else if (status === 'timeout') {
//                     errorMsg = 'El servidor no respondió a tiempo';
//                 }
                
//                 Swal.fire({
//                     title: 'Error',
//                     text: errorMsg,
//                     icon: 'error'
//                 });
//             },
//             complete: function() {
//                 // Esto se ejecuta siempre al finalizar la petición (éxito o error)
//                 // Restablece el botón de validar
//                 boton.html('<i class="fas fa-check"></i> Validar');
//                 boton.prop('disabled', false);
//             }
//         });
//     }

//     // =========================================================================
//     // *** ASIGNACIÓN DEL EVENTO CLICK AL BOTÓN UNA VEZ QUE EL DOM ESTÁ LISTO ***
//     // =========================================================================
//     // Aquí le decimos a jQuery: cuando el elemento con ID 'validarReferencia'
//     // reciba un 'click', ejecuta la función 'validarReferencia' (la que definimos arriba).
//     $('#validarReferencia').on('click', validarReferencia);

//     // =========================================================================
//     // Otros listeners de eventos que tenías, también deben ir aquí dentro
//     // =========================================================================

//     // Listener para los campos de retención
//     $('#retencion1, #retencion2, #retencion3').on('input', function() {
//         calcularRetenciones();
//     });

//     // Listener para el cambio del tipo de pago
//     $('#tipo_pago').on('change', togglePagoFields);

//     // Listener para el botón de consultar planilla
//     // Asegúrate de que el botón de consultar planilla tenga un ID, por ejemplo, 'consultarPlanillaBtn'
//     // Si no tiene un ID, tu selector 'button[name="button"]' es más propenso a errores si tienes otros botones sin ID.
//     // Asumiendo que 'Consultarplanilla' es una función definida GLOBALMENTE (fuera de este document.ready)
//     // OJO: Si mueves Consultarplanilla DENTRO de este document.ready, entonces la asignación de evento sería así:
//     // $('#ID_DE_TU_BOTON_CONSULTAR_PLANILLA').on('click', Consultarplanilla);
//     // Por ahora, si Consultarplanilla sigue siendo llamada por 'onclick' en HTML, déjala así.

// }); // FIN de $(document).ready

$(document).ready(function() {

        function validarReferencia() {
        const referenciaBuscada = $('#referencia').val().trim();

        if (!referenciaBuscada) {
            Swal.fire({
                title: 'Error',
                text: 'Por favor ingrese un número de referencia',
                icon: 'warning'
            });
            return;
        }

        const boton = $('#validarReferencia');
        boton.html('<i class="fas fa-spinner fa-spin"></i> Validando...');
        boton.prop('disabled', true);

        $('#referenciaInfo').hide();
        $('#referenciaDetails').html('');
        $('#guardar').prop('disabled', true);
        $('#pagoVerificado').val('0');

        // var base_url = window.location.origin + '/asnc/index.php/Diplomado/verificar_referencia_v2';
       var base_url = '/index.php/Diplomado/verificar_referencia_v2';
        
        let postData = {
            referencia: referenciaBuscada
        };

        $.ajax({
            url: base_url,
            type: 'POST',
            dataType: 'json',
            data: postData,
            timeout: 30000,
            success: function(response) {
                // *** ¡AQUÍ ESTÁ LA SIMPLIFICACIÓN CRÍTICA! ***
                // Tu controlador ya hace el filtro y te devuelve el 'data' limpio.
                if (response.success) { // Si el controlador dice que fue un éxito
                    const mov = response.data; // 'mov' ya es el objeto del movimiento encontrado

                    $('#referenciaInfo').show();
                    $('#referenciaDetails').html(`
                        <p><strong>Referencia:</strong> ${mov.referencia || 'N/A'}</p>
                        <p><strong>Descripción:</strong> ${mov.descripcion || 'N/A'}</p>
                        <p><strong>Fecha:</strong> ${mov.fecha || 'N/A'}</p>
                        <p><strong>Hora:</strong> ${mov.hora || 'N/A'}</p>
                        <p><strong>Tipo:</strong> ${mov.mov || 'N/A'}</p>
                        <p><strong>Importe:</strong> ${mov.importe || 'N/A'}</p>
                        <p><strong>Saldo:</strong> ${mov.saldo || 'N/A'}</p>
                        <p><strong>Observación:</strong> ${mov.observacion || 'N/A'}</p>
                    `);

                    if (mov.importe) {
                        // Limpia el formato de número: elimina puntos de miles, reemplaza coma decimal por punto
                        const importeLimpio = mov.importe.replace(/\./g, '').replace(',', '.');
                        $('#monto').val(Math.abs(parseFloat(importeLimpio))).trigger('change');
                    }
                    if (mov.fecha) {
                        $('#fechaPago').val(mov.fecha.split(' ')[0]);
                    }
                    $('#pagoVerificado').val('1');

                    $('#guardar').prop('disabled', false);

                    Swal.fire({
                        title: 'Éxito', // Título de éxito
                        text: response.message || 'Referencia validada correctamente', // Usa el mensaje del servidor
                        icon: 'success'
                    });

                } else {
                    // Si el controlador PHP devuelve success: false (ej. referencia no encontrada, o error de API)
                    $('#referenciaInfo').hide();
                    $('#pagoVerificado').val('0');

                    $('#guardar').prop('disabled', true);

                    Swal.fire({
                        title: 'Error', // Título de error
                        text: response.message || 'No se pudo validar la referencia.', // Usa el mensaje de error del servidor
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Esta sección maneja errores de red o del servidor antes de recibir una respuesta JSON válida
                let errorMsg = 'Error al conectar con el servidor';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (status === 'timeout') {
                    errorMsg = 'El servidor no respondió a tiempo';
                }

                Swal.fire({
                    title: 'Error',
                    text: errorMsg,
                    icon: 'error'
                });
            },
            complete: function() {
                boton.html('<i class="fas fa-check"></i> Validar');
                boton.prop('disabled', false);
            }
        });
    }


    // =========================================================================
    // *** ASIGNACIÓN DEL EVENTO CLICK AL BOTÓN (ESTO YA ESTÁ CORRECTO) ***
    // =========================================================================
    $('#validarReferencia').on('click', validarReferencia);

    // =========================================================================
    // Otros listeners de eventos (se mantienen igual)
    // =========================================================================
    $('#retencion1, #retencion2, #retencion3').on('input', function() {
        calcularRetenciones();
    });

    $('#tipo_pago').on('change', togglePagoFields);

    // Si tu función Consultarplanilla está definida globalmente (fuera de este document.ready)
    // y es llamada por un onclick en el HTML, se mantiene así.
    // Si la mueves aquí, asegúrate de asignarle el evento con .on('click', Consultarplanilla).
    // Ejemplo:
    // $('#id_del_boton_consultar_planilla').on('click', Consultarplanilla);

     // --- Función para guardar el formulario ---
    window.sav = function(event) { // Hacerla global o definirla dentro de document.ready
        event.preventDefault(); // Prevenir el envío normal del formulario

        // Validar que la referencia haya sido verificada previamente
        // Esto se controla con el campo oculto #pagoVerificado
        if ($('#pagoVerificado').val() !== '1') {
            Swal.fire({
                title: 'Atención',
                text: 'Debe validar la referencia del pago antes de guardar.',
                icon: 'warning'
                // Puedes agregar un botón para cerrar el mensaje si no se cierra automáticamente
            });
            return; // Detener la ejecución si no está verificado
        }

        // Deshabilitar el botón de guardar y mostrar loader
        const botonGuardar = $('#guardar');
        botonGuardar.html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
        botonGuardar.prop('disabled', true);

        // Obtener todos los datos del formulario (la clave es el ID del formulario sav_ext)
        // Asegúrate de que todos los inputs que quieres guardar tengan un atributo 'name'
        const formData = $('#sav_ext').serialize(); 
        
        // Si necesitas CSRF, descomenta estas líneas y asegúrate de que las variables globales existan
        // if (typeof CI_CSRF_TOKEN_NAME !== 'undefined' && typeof CI_CSRF_HASH !== 'undefined') {
        //     formData += '&' + CI_CSRF_TOKEN_NAME + '=' + CI_CSRF_HASH;
        // }

        // var base_url = window.location.origin + '/asnc/index.php/Diplomado/guardar_conciliado';
       var base_url = '/index.php/Diplomado/guardar_conciliado';

        $.ajax({
            url: base_url, // Asegúrate de que BASE_URL esté definida en tu HTML
            type: 'POST',
            data: formData, // Envía todos los datos del formulario
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: '¡Éxito! revise en participantes seleccionados  la planilla de inscripción',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        // Opcional: Redirigir o limpiar el formulario después de guardar
                        window.location.reload(); // Recargar la página
                        $('#sav_ext')[0].reset(); // Limpiar el formulario
                        $('#referenciaInfo').hide(); // Ocultar info de referencia
                        $('#pagoVerificado').val('0'); // Resetear estado de verificación
                        // location.href = BASE_URL + 'otro/url/despues_guardar'; // Redirigir
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Hubo un problema al guardar el pago.',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                let errorMsg = 'Error de conexión al intentar guardar. Intente de nuevo.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (status === 'timeout') {
                    errorMsg = 'La solicitud de guardar el pago ha tardado demasiado.';
                } else if (xhr.status === 404) {
                    errorMsg = 'El punto de guardado no fue encontrado (404).';
                }
                Swal.fire({
                    title: 'Error',
                    text: errorMsg,
                    icon: 'error'
                });
            },
            complete: function() {
                // Restaurar el botón de guardar
                botonGuardar.html('<i class="fas fa-save mr-2"></i>Guardar Pago');
                botonGuardar.prop('disabled', false);
            }
        });
    };

}); // FIN de $(document).ready