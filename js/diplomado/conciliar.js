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
        //  var base_url = window.location.origin+'/asnc/index.php/Diplomado/consulta_planilla';
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
        var totalPago = parseFloat($('#total_pago').val().replace(/[^0-9.-]/g, '')) || 0;
        var totalDespuesRetenciones = totalPago - totalRetenciones;
        $('#total_despues_retenciones').val(totalDespuesRetenciones.toFixed(2));
        $('#totalDespuesRetencionesField').show();
        $('#totalDespuesRetencionesCreditoField').hide();
    }
    // Calcular para Crédito
    else if ($('#tipo_pago').val() == 2) {
        var credito = parseFloat($('#pay').val().replace(/[^0-9.-]/g, '')) || 0;
        var totalDespuesRetencionesCredito = credito - totalRetenciones;
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