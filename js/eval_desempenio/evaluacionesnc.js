$(document).ready(function() {
    var reporte_data = [];
    var filas_por_pagina = 10;
    var pagina_actual = 1;
    var max_paginas_visibles = 5;

    // function mostrar_pagina(pagina) {
    //     var inicio = (pagina - 1) * filas_por_pagina;
    //     var fin = inicio + filas_por_pagina;
    //     var filas_a_mostrar = reporte_data.slice(inicio, fin);

    //     var tbody = $('#data-table-reporte tbody');
    //     tbody.empty();

    //     if (filas_a_mostrar.length > 0) {
    //         $.each(filas_a_mostrar, function(index, item) {
    //             //var url_ver = '/index.php/Evaluacion_desempenio/ver_evaluacion?id='+ item.id;

    //              var url_ver = '<?= base_url("index.php/Evaluacion_desempenio/ver_evaluacion?id=") ?>' + item.id;
                
    //             tbody.append('<tr>' +
    //                 '<td>' + item.id + '</td>' +
    //                 '<td>' + item.fecha_reg_eval + '</td>' +
    //                 '<td>' + item.rif_organoente + '</td>' +
    //                 '<td>' + item.organo_ente + '</td>' +
    //                 '<td>' + item.rif_contrat + '</td>' +
    //                 '<td>' + item.contratista_ev + '</td>' +
    //                 '<td>' + item.calificacion + '</td>' +
    //                 '<td>' +
    //                 '<a title="Visualizar e Imprimir la Evaluación de Desempeño" href="' + url_ver + '" class="button">' +
    //                 '<i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>' +
    //                 '</a>' +
    //                 '</td>' +
    //                 '</tr>');
    //         });
    //     } else {
    //         tbody.append('<tr><td colspan="8" class="text-center">No se encontraron evaluaciones para el rango de fechas seleccionado.</td></tr>');
    //     }
    // }

    // --- FUNCIÓN AUXILIAR PARA OBTENER EL ESTATUS Y COLOR ---
    function obtener_estatus(id_estatus) {
        let nombre_estatus = '';
        let color_class = ''; // Usaremos clases de Bootstrap (badge o text-*)

        // Convertir a número por si viene como string
        const estatus = parseInt(id_estatus); 

        switch (estatus) {
            case 1:
                nombre_estatus = 'Procesado';
                color_class = 'text-white bg-success'; // Fondo Verde
                break;
            case 2:
                nombre_estatus = 'Solicitud Anulación';
                color_class = 'text-dark bg-warning'; // Fondo Anaranjado
                break;
            case 3:
                nombre_estatus = 'Anulado';
                color_class = 'text-white bg-danger'; // Fondo Rojo
                break;
            default:
                nombre_estatus = 'Desconocido';
                color_class = 'text-dark bg-secondary';
                break;
        }

        // Devolvemos el HTML con la clase de Bootstrap
        return '<span class="badge ' + color_class + '">' + nombre_estatus + '</span>';
    }
    // --------------------------------------------------------


    function mostrar_pagina(pagina) {
        var inicio = (pagina - 1) * filas_por_pagina;
        var fin = inicio + filas_por_pagina;
        var filas_a_mostrar = reporte_data.slice(inicio, fin);

        var tbody = $('#data-table-reporte tbody');
        tbody.empty();

        if (filas_a_mostrar.length > 0) {
            $.each(filas_a_mostrar, function(index, item) {
                
                // Obtener el HTML del estatus formateado
                const estatus_html = obtener_estatus(item.id_estatus);
                var url_ver = '/index.php/Evaluacion_desempenio/ver_evaluacion?id='+ item.id;
                
             //   var url_ver = '<?= base_url("index.php/Evaluacion_desempenio/ver_evaluacion?id=") ?>' + item.id;
                
                tbody.append('<tr>' +
                    '<td>' + item.id + '</td>' +
                    '<td>' + item.fecha_reg_eval + '</td>' +
                    '<td>' + item.rif_organoente + '</td>' +
                    '<td>' + item.organo_ente + '</td>' +
                    '<td>' + item.rif_contrat + '</td>' +
                    '<td>' + item.contratista_ev + '</td>' +
                    '<td>' + item.calificacion + '</td>' +
                    // NUEVA COLUMNA DE ESTATUS
                    '<td>' + estatus_html + '</td>' +
                    '<td>' +
                    '<a title="Visualizar e Imprimir la Evaluación de Desempeño" href="' + url_ver + '" class="button">' +
                    '<i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>' +
                    '</a>' +
                    '</td>' +
                    '</tr>');
            });
        } else {
            // Asegúrate que el colspan sea 9 (8 columnas de datos + 1 columna de Acciones)
            tbody.append('<tr><td colspan="9" class="text-center">No se encontraron evaluaciones para el rango de fechas seleccionado.</td></tr>');
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

    $('#form_reporte_evaluaciones').on('submit', function(e) {
        e.preventDefault();

        var fecha_desde_val = $('#fecha_desde').val();
        var fecha_hasta_val = $('#fecha_hasta').val();
        
        // Obtener valores de los nuevos filtros
        var id_evaluacion = $('#id_evaluacion').val();
        var rif_organoente = $('#rif_organoente').val();
        var organo_ente = $('#organo_ente').val();
        var rif_contrat = $('#rif_contrat').val();
        var contratista_ev = $('#contratista_ev').val();
        var calificacion = $('#calificacion').val();

        // Validar rango de 30 días solo si se seleccionan ambas fechas
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
        var base_url = '/index.php/evaluacion_desempenio/generar_reporte_evaluacionessnc';

        
        //  var base_url = window.location.origin + '/asnc/index.php/evaluacion_desempenio/generar_reporte_evaluacionessnc';

        $.ajax({
            url: base_url,
            method: 'POST',
            data: {
                fecha_desde: fecha_desde_val,
                fecha_hasta: fecha_hasta_val,
                id_evaluacion: id_evaluacion,
                rif_organoente: rif_organoente,
                organo_ente: organo_ente,
                rif_contrat: rif_contrat,
                contratista_ev: contratista_ev,
                calificacion: calificacion
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#tabla_reporte_container').show();
                    reporte_data = response.data;
                    
                    if (reporte_data.length > 0) {
                        pagina_actual = 1; // Reinicia la página a 1 al cargar nuevos datos
                        crear_paginacion();
                        mostrar_pagina(pagina_actual);
                    } else {
                        var tbody = $('#data-table-reporte tbody');
                        tbody.empty();
                        tbody.append('<tr><td colspan="8" class="text-center">No se encontraron evaluaciones para el rango de fechas seleccionado.</td></tr>');
                        $('#paginacion_tabla').empty();
                    }
                    $('#form_reporte_evaluaciones')[0].reset();
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Ocurrió un error al generar el reporte.');
            }
        });
    });
});