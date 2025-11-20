$(document).ready(function() {
    var reporte_data = [];
    var filas_por_pagina = 10;
    var pagina_actual = 1;
    var max_paginas_visibles = 5;

    // --- Definición de Rutas del Controlador Rnc ---
    const URL_CONSULTA = BASE_URL + 'index.php/Rnc/generar_reporte_pagos';
    const URL_EXPORTAR_CSV = BASE_URL + 'index.php/Rnc/exportar_pagos_csv';
    // --------------------------------------------------

    function mostrar_pagina(pagina) {
        var inicio = (pagina - 1) * filas_por_pagina;
        var fin = inicio + filas_por_pagina;
        var filas_a_mostrar = reporte_data.slice(inicio, fin);

        var tbody = $('#data-table-reporte tbody');
        tbody.empty();

        const total_columnas = 10; 

        if (filas_a_mostrar.length > 0) {
            $.each(filas_a_mostrar, function(index, item) {
                // Formateo de Moneda y Fecha
                const monto_formateado = parseFloat(item.amount).toLocaleString('es-VE', { style: 'currency', currency: 'VES' });
                
                // Formateo de fecha y hora para TIMESTAMP
                // const fecha_pago = new Date(item.fecha_registro);
                 const fecha_pago = item.fecha_registro;

                // Ejemplo de formato: 13/11/2025 10:30:00
                const fecha_formateada = isNaN(fecha_pago) 
                    ? 'N/A' 
                    : fecha_pago.toLocaleDateString('es-VE') + ' ' + fecha_pago.toLocaleTimeString('es-VE');

                // ORDEN DE COLUMNAS A MOSTRAR:
                // paymentdate, id, rif_contratista, nombre_contratista, tipo_inscripcion, 
                // tipo_transaccion, transactionid, amount, metodo_pago, clasificacion_tarifa
                
                tbody.append('<tr>' +
                    '<td>' + fecha_pago + '</td>' + // 1. Fecha Pago
                    '<td>' + item.id + '</td>' + // 2. ID Proceso
                    '<td>' + item.rif_contratista + '</td>' + // 3. RIF Contratista
                    '<td>' + item.nombre_contratista + '</td>' + // 4. Nombre Contratista
                    '<td>' + item.tipo_inscripcion + '</td>' + // 5. Tipo Inscripción
                    '<td>' + item.tipo_transaccion + '</td>' + // 6. Tipo Transacción
                    '<td>' + item.transactionid + '</td>' + // 7. Referencia
                    '<td>' + monto_formateado + '</td>' + // 8. Monto
                    '<td>' + item.metodo_pago + '</td>' + // 9. Método Pago
                    '<td>' + item.clasificacion_tarifa + '</td>' + // 10. Clasificación Tarifa
                    '</tr>');
            });
        } else {
            // Asegurarse de usar 10 columnas en el colspan
            tbody.append('<tr><td colspan="' + total_columnas + '" class="text-center">No se encontraron pagos para los filtros seleccionados.</td></tr>');
        }
    }

    function crear_paginacion() {
        var total_filas = reporte_data.length;
        var total_paginas = Math.ceil(total_filas / filas_por_pagina);
        var paginacion_ul = $('#paginacion_tabla');
        
        paginacion_ul.empty();

        if (total_paginas > 1) {
            var inicio_bucle = Math.max(1, pagina_actual - Math.floor(max_paginas_visibles / 2));
            var fin_bucle = Math.min(total_paginas, inicio_bucle + max_paginas_visibles - 1);

            if (fin_bucle - inicio_bucle < max_paginas_visibles - 1) {
                inicio_bucle = Math.max(1, fin_bucle - max_paginas_visibles + 1);
            }

            var anterior_li = $('<li class="page-item" id="anterior_li"><a class="page-link" href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span><span class="sr-only">Anterior</span></a></li>');
            paginacion_ul.append(anterior_li);

            for (var i = inicio_bucle; i <= fin_bucle; i++) {
                var pagina_li = '<li class="page-item"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                paginacion_ul.append(pagina_li);
            }

            var siguiente_li = $('<li class="page-item" id="siguiente_li"><a class="page-link" href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span><span class="sr-only">Siguiente</span></a></li>');
            paginacion_ul.append(siguiente_li);

            $('#anterior_li').toggleClass('disabled', pagina_actual === 1);
            $('#siguiente_li').toggleClass('disabled', pagina_actual === total_paginas);

            paginacion_ul.find('a[data-page="' + pagina_actual + '"]').parent().addClass('active');

            paginacion_ul.find('li:not(#anterior_li, #siguiente_li) a').off('click').on('click', function(e) {
                e.preventDefault();
                pagina_actual = $(this).data('page');
                mostrar_pagina(pagina_actual);
                crear_paginacion();
            });

            paginacion_ul.find('#anterior_li a').off('click').on('click', function(e) {
                e.preventDefault();
                if (pagina_actual > 1) {
                    pagina_actual--;
                    mostrar_pagina(pagina_actual);
                    crear_paginacion();
                }
            });

            paginacion_ul.find('#siguiente_li a').off('click').on('click', function(e) {
                e.preventDefault();
                if (pagina_actual < total_paginas) {
                    pagina_actual++;
                    mostrar_pagina(pagina_actual);
                    crear_paginacion();
                }
            });
        }
    }
    
    function recolectar_filtros() {
        return {
            fecha_desde: $('#fecha_desde').val(),
            fecha_hasta: $('#fecha_hasta').val(),
            proceso_id: $('#proceso_id').val(),
            rif_contratista: $('#rif_contratista').val(),
            nombre_contratista: $('#nombre_contratista').val(),
            transactionid: $('#transactionid').val(),
            id_tptrans: $('#id_tptrans').val()
        };
    }

    function habilitar_exportacion(habilitar) {
        $('#btn_exportar_csv').prop('disabled', !habilitar);
    }
    
    // Evento de Exportar a CSV
    $('#btn_exportar_csv').on('click', function() {
        const filtros = recolectar_filtros();
        const params = $.param(filtros);
        window.location.href = URL_EXPORTAR_CSV + '?' + params; 
    });

    // --------------------------------------------------------
    // --- FUNCIÓN SUBMIT PRINCIPAL ---
    // --------------------------------------------------------

    $('#form_reporte_pagos').on('submit', function(e) { 
        e.preventDefault();

        habilitar_exportacion(false);

        const filtros = recolectar_filtros();
        const fecha_desde_val = filtros.fecha_desde;
        const fecha_hasta_val = filtros.fecha_hasta;

        // Validar rango de 30 días
        if (fecha_desde_val && fecha_hasta_val) {
            var fecha_desde = new Date(fecha_desde_val);
            var fecha_hasta = new Date(fecha_hasta_val);
            var diferencia_en_milisegundos = fecha_hasta - fecha_desde;
            var diferencia_en_dias = diferencia_en_milisegundos / (1000 * 60 * 60 * 24);

            if (fecha_desde > fecha_hasta || diferencia_en_dias > 30) {
                swal.fire({
                    title: 'Atención',
                    text: 'El rango de fechas no puede ser mayor a 30 días.',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                });
                return;
            }
        }
        
        $.ajax({
            url: URL_CONSULTA, 
            method: 'POST',
            data: filtros,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#tabla_reporte_container').show();
                    reporte_data = response.data;
                    
                    if (reporte_data.length > 0) {
                        pagina_actual = 1; 
                        crear_paginacion();
                        mostrar_pagina(pagina_actual);
                        habilitar_exportacion(true); 
                    } else {
                        var tbody = $('#data-table-reporte tbody');
                        tbody.empty();
                        // Importante: Usar 10 columnas en el colspan
                        tbody.append('<tr><td colspan="10" class="text-center">No se encontraron pagos para los filtros seleccionados.</td></tr>');
                        $('#paginacion_tabla').empty();
                        habilitar_exportacion(false);
                    }
                    $('#form_reporte_pagos')[0].reset(); 
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Ocurrió un error al generar el reporte.');
                habilitar_exportacion(false);
            }
        });
    });
});