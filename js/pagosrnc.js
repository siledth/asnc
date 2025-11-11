$(document).ready(function() {
    var reporte_data = [];
    var filas_por_pagina = 10;
    var pagina_actual = 1;
    var max_paginas_visibles = 5;

    // --- Definición de Rutas del Controlador Rnc ---
    // Asegúrate de que BASE_URL esté definida en la vista HTML antes de este script.
    const URL_CONSULTA = BASE_URL + 'index.php/Rnc/generar_reporte_pagos';
    const URL_EXPORTAR_CSV = BASE_URL + 'index.php/Rnc/exportar_pagos_csv';
    // --------------------------------------------------

    function mostrar_pagina(pagina) {
        var inicio = (pagina - 1) * filas_por_pagina;
        var fin = inicio + filas_por_pagina;
        var filas_a_mostrar = reporte_data.slice(inicio, fin);

        var tbody = $('#data-table-reporte tbody');
        tbody.empty();

        if (filas_a_mostrar.length > 0) {
            $.each(filas_a_mostrar, function(index, item) {
                // Formateo de Moneda y Fecha
                const monto_formateado = parseFloat(item.amount).toLocaleString('es-VE', { style: 'currency', currency: 'VES' });
                const fecha_formateada = item.paymentdate ? new Date(item.paymentdate).toLocaleDateString('es-VE') : 'N/A';

                tbody.append('<tr>' +
                    '<td>' + item.id + '</td>' +
                    '<td>' + fecha_formateada + '</td>' +
                    '<td>' + item.rif_contratista + '</td>' +
                    '<td>' + item.nombre_contratista + '</td>' +
                    '<td>' + monto_formateado + '</td>' +
                    '<td>' + item.tipo_transaccion + '</td>' +
                    '<td>' + item.metodo_pago + '</td>' +
                    '<td>' + item.transactionid + '</td>' +
                    '</tr>');
            });
        } else {
            tbody.append('<tr><td colspan="8" class="text-center">No se encontraron pagos para los filtros seleccionados.</td></tr>');
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
    
    // Funciones auxiliares para Exportación
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
        // Solo maneja el botón CSV
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
                        tbody.append('<tr><td colspan="8" class="text-center">No se encontraron pagos para los filtros seleccionados.</td></tr>');
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