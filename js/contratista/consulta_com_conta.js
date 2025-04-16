// function consultar_nombre(){
//     var nombre = $('#nombre').val();
//     if (nombre == '') {
//         //...
//     } else {
//         $("#items").show();
//         // var base_url = '/index.php/Contratista/llenar_contratista_comi_conta1';
//         var base_url =window.location.origin+'/asnc/index.php/Contratista/llenar_contratista_comi_conta1';
//         $.ajax({
//             url: base_url,
//             method: 'post',
//             data: { nombre: nombre },
//             dataType: 'json',
//             success: function(data) {
//                 if (data.error) {
//                     // Mostrar inputs en lugar de la tabla
//                     $('#tabla').hide();
//                     $('#items').hide();
//                     $('#inputs').show();
//                     $('#cedula').val(nombre);
//                     $('#existe').val(0);
//                 } else {
//                     $('#tabla').show();
//                     $('#items').show();
//                     $('#inputs').show();
//                     $('#cedula').val(nombre);
//             $("#namec").val(response["nombre"]);

//                     $('#existe').val(1);

//                     $('#tabla tbody').children().remove()
//                     $.each(data, function(index, response){
//                         $('#tabla tbody').append('<tr><td>' + response['rifced'] + '</td><td>'
//                                                         + response['nombre'] + '</td><td>'
//                                                         + response['nomacc'] + '</td><td>'
//                                                         + response['apecom'] + '</td></tr>'
//                                                         // + '<button class="boton2 btn"> <a href="llenar_contratista_nombre_ind?id='+ response['rifced'] +'">VER</button></td></tr>'
//                                                     );
//                     });

//                     // Inicializar DataTables y configurar la paginación
//                     $('#tabla').DataTable({
//                         "paging": true,
//                         "pageLength": 10, // número de filas por página
//                         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],// opciones de número de filas por página
//         dom: "Bfrtip",
//          buttons: [{
//             extend: "excel",
//             text: "Exportar Hoja de Cálculo"
//         }]

//                     });
//                 }
//             }
//         });
//     }
// }
// function consultar_nombre3() {
//      if ($.fn.DataTable.isDataTable('#tabla')) {
//                         $('#tabla').DataTable().destroy();
//                     }

//     $('#namec').val(''); // Reiniciar el input de nombre
//     $('#apellidoc').val(''); // Reiniciar el input de apellido
//     var nombre = $('#nombre').val();
//     if (nombre == '') {
//         alert('Por favor ingrese un número de cédula.');
//         return;
//     } else {
//         $("#items").show();
//         var base_url = window.location.origin + '/asnc/index.php/Contratista/llenar_contratista_comi_conta1';
//         var base_url_3 = window.location.origin + '/asnc/index.php/Planilla_r_todo/pdfrt?id=';

//         $.ajax({
//             url: base_url,
//             method: 'post',
//             data: { nombre: nombre },
//             dataType: 'json',
//             success: function(data) {
//                 if (data.error) {
//                     // Mostrar inputs en lugar de la tabla
//                     $('#tabla').hide();
//                     $('#items').hide();
//                     $('#inputs').show();
//                     $('#cedula').val(nombre);
//                     $('#existe').val(0);
//                 } else {
//                     $('#tabla').show();
//                     $('#items').show();
//                     $('#inputs').show();
//                     $('#cedula').val(nombre);
//                     $('#existe').val(1);

//                     // Limpiar la tabla antes de llenarla
//                     $('#tabla tbody').children().remove();
//                     $.each(data, function(index, response) {
//                         $('#tabla tbody').append('<tr><td>' + response['rifced'] + '</td><td>'
//                             + response['nombre'] + '</td><td>'
//                             + response['proceso_id'] + '</td><td>'
//                             + '<button class="boton2 btn" onclick="window.location.href=\'' + base_url_3 + response['proceso_id'] + '\'">VER</button></td></tr>');

//                         // Mostrar el nombre en el input fuera de la tabla
//                         $("#namec").val(response['nomacc']); // Asignar el nombre al input
//                         $("#apellidoc").val(response['apecom']); // Asignar el apellido al input
//                     });

//                     // Destruir la tabla si ya está inicializada
//                     if ($.fn.DataTable.isDataTable('#tabla')) {
//                         $('#tabla').DataTable().destroy();
//                     }

//                     // Inicializar DataTables y configurar la paginación
//                     $('#tabla').DataTable({
//                         "paging": true,
//                         "pageLength": 10, // número de filas por página
//                         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
//                         dom: "Bfrtip",
//                         buttons: [{
//                             extend: "excel",
//                             text: "Exportar Hoja de Cálculo"
//                         }]
//                     });
//                 }
//             }
//         });
//     }
// }
function consultar_nombre() {
    // Destruir la tabla si ya está inicializada
    if ($.fn.DataTable.isDataTable('#tabla')) {
        $('#tabla').DataTable().destroy();
    }

    // Reiniciar los inputs
    $('#cedula').val('');
    $('#namec').val('');
    $('#apellidoc').val('');
    $('#existe').val('');

    var nombre = $('#nombre').val();
    if (nombre == '') {
        alert('Por favor ingrese un número de cédula.');
        return;
    } else {
        $("#items").show();
        
        // Mostrar el mensaje de cargando
        $("#loading").show();

        //var base_url = window.location.origin + '/asnc/index.php/Contratista/llenar_contratista_comi_conta1';
        //var base_url_3 = window.location.origin + '/asnc/index.php/Planilla_r_todo/pdfrt?id=';
         var base_url = '/index.php/Contratista/llenar_contratista_comi_conta1';
         var base_url_3 = '/index.php/Planilla_r_todo/pdfrt?id=';

        $.ajax({
            url: base_url,
            method: 'post',
            data: { nombre: nombre },
            dataType: 'json',
            success: function(data) {
                // Ocultar el mensaje de cargando
                $("#loading").hide();

                if (data.error) {
                    $('#tabla').hide();
                    $('#items').hide();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(0);
                } else {
                    $('#tabla').show();
                    $('#items').show();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(1);

                    $('#tabla tbody').children().remove();
                    $.each(data, function(index, response) {
                        $('#tabla tbody').append('<tr><td>' + response['rifced'] + '</td><td>'
                            + response['nombre'] + '</td><td>'
                            + response['proceso_id'] + '</td><td>'
                             + response['tipo'] + '</td><td>'
                            + '<button class="boton2 btn" onclick="window.location.href=\'' + base_url_3 + response['proceso_id'] + '\'">VER</button></td></tr>');

                        $("#namec").val(response['nomacc']);
                        $("#apellidoc").val(response['apecom']);
                    });

                    $('#tabla').DataTable({
                        "paging": true,
                        "pageLength": 10,
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "excel",
                            text: "Exportar Hoja de Cálculo"
                        }]
                    });
                }
            },
            error: function() {
                // Ocultar el mensaje de cargando en caso de error
                $("#loading").hide();
                alert('Error al cargar los datos.');
            }
        });
    }
}
function consultar_nombre2() {
    // Destruir la tabla si ya está inicializada
    if ($.fn.DataTable.isDataTable('#tabla')) {
        $('#tabla').DataTable().destroy();
    }

    // Reiniciar los inputs
    $('#cedula').val('');
    $('#namec').val('');
    $('#apellidoc').val('');
    $('#existe').val('');

    var nombre = $('#nombre').val();
    if (nombre == '') {
        alert('Por favor ingrese un número de cédula.');
        return;
    } else {
        $("#items").show();
        
        // Mostrar el mensaje de cargando
        $("#loading").show();
       // var base_url =window.location.origin+'/asnc/index.php/Contratista/llenar_contratista_comi_conta2';

       // var base_url_3 = window.location.origin + '/asnc/index.php/Planilla_r_todo/pdfrt?id=';
        var base_url = '/index.php/Contratista/llenar_contratista_comi_conta2';
        var base_url_3 = '/index.php/Planilla_r_todo/pdfrt?id=';

        $.ajax({
            url: base_url,
            method: 'post',
            data: { nombre: nombre },
            dataType: 'json',
            success: function(data) {
                // Ocultar el mensaje de cargando
                $("#loading").hide();

                if (data.error) {
                    $('#tabla').hide();
                    $('#items').hide();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(0);
                } else {
                    $('#tabla').show();
                    $('#items').show();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(1);

                    $('#tabla tbody').children().remove();
                    $.each(data, function(index, response) {
                        $('#tabla tbody').append('<tr><td>' + response['proceso_id'] + '</td><td>'
                            + response['rifced'] + '</td><td>'
                            + response['nombre'] + '</td><td>'
                            + response['percontacto'] + '</td><td>'
                             + response['telf1'] + '</td><td>'
                            + '<button class="boton2 btn" onclick="window.location.href=\'' + base_url_3 + response['proceso_id'] + '\'">VER</button></td></tr>');

                        $("#namec").val(response['nombre']);
             
                    });

                    $('#tabla').DataTable({
                        "paging": true,
                        "pageLength": 10,
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "excel",
                            text: "Exportar Hoja de Cálculo"
                        }]
                    });
                }
            },
            error: function() {
                // Ocultar el mensaje de cargando en caso de error
                $("#loading").hide();
                alert('Error al cargar los datos.');
            }
        });
    }
}
function consultar_nombre5() {
    // Destruir la tabla si ya está inicializada
    if ($.fn.DataTable.isDataTable('#tabla')) {
        $('#tabla').DataTable().destroy();
    }

  
    var nombre = $('#nombre').val();
    if (nombre == '') {
        alert('Por favor ingrese un rif.');
        return;
    } else {
        $("#items").show();
        
        // Mostrar el mensaje de cargando
        $("#loading").show();
        //  var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_evaluaciones_contratistas';

        var base_url = '/index.php/evaluacion_desempenio/llenar_evaluaciones_contratistas';
       // var base_url_3 = '/index.php/Planilla_r_todo/pdfrt?id=';

        $.ajax({
            url: base_url,
            method: 'post',
            data: { nombre: nombre },
            dataType: 'json',
            success: function(data) {
                // Ocultar el mensaje de cargando
                $("#loading").hide();

                if (data.error) {
                    $('#tabla').hide();
                    $('#items').hide();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(0);
                } else {
                    $('#tabla').show();
                    $('#items').show();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(1);

                    $('#tabla tbody').children().remove();
                    $.each(data, function(index, response) {
                        $('#tabla tbody').append('<tr><td>' + response['nombre_ente'] + '</td><td>'
                            + response['razon_social'] + '</td><td>'
                            + response['objeto'] + '</td><td>'
                            + response['nombre_calificacion'] + '</td><td>'
                             + response['tipo'] + '</td></tr>'
                          );

                       // $("#namec").val(response['nombre']);
             
                    });

                    $('#tabla').DataTable({
                        "paging": true,
                        "pageLength": 10,
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "excel",
                            text: "Exportar Hoja de Cálculo"
                        }]
                    });
                }
            },
            error: function() {
                // Ocultar el mensaje de cargando en caso de error
                $("#loading").hide();
                alert('Error al cargar los datos.');
            }
        });
    }
}

// Función para generar el gráfico
function generarGraficoCalificaciones(data) {
    // Filtrar solo las evaluaciones actuales
    const evaluacionesActuales = data.filter(item => item.tipo === 'Actual');
    
    // Si no hay evaluaciones actuales, ocultar el gráfico
    if (evaluacionesActuales.length === 0) {
        $("#chart-container").hide();
        return;
    }
    
    // Contar las calificaciones
    const conteoCalificaciones = {};
    evaluacionesActuales.forEach(item => {
        const calificacion = item.nombre_calificacion || 'Sin calificación';
        conteoCalificaciones[calificacion] = (conteoCalificaciones[calificacion] || 0) + 1;
    });
    
    // Convertir a formato que amCharts entiende
    const chartData = Object.keys(conteoCalificaciones).map(calificacion => {
        return {
            calificacion: calificacion,
            cantidad: conteoCalificaciones[calificacion],
            color: getColorForCalificacion(calificacion)
        };
    });
    
    // Si hay datos, mostrar el gráfico
    if (chartData.length > 0) {
        $("#chart-container").show();
        
        // Crear el gráfico
        am5.ready(function() {
            // Create root element
            var root = am5.Root.new("chartdiv");
            
            // Set themes
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            
            // Create chart
            var chart = root.container.children.push(am5percent.PieChart.new(root, {
                layout: root.verticalLayout
            }));
            
            // Create series
          var series = chart.series.push(am5percent.PieSeries.new(root, {
            name: "Calificaciones",
            valueField: "cantidad",
            categoryField: "calificacion",
            legendLabelText: "{category}: {value} ({valuePercentTotal.formatNumber('#.0')}%)",
            legendValueText: "{value}",
        }));

        // Asignar colores personalizados usando `template.setAll`
        series.slices.template.setAll({
          //  fill: am5.color("#607D8B"), // Color por defecto (opcional)
        });

        // Asignar colores específicos para cada categoría
        series.data.setAll(chartData.map(item => ({
            ...item,
            fill: am5.color(item.color) // Usar el color definido en `getColorForCalificacion`
        })));
            series.data.setAll(chartData);
            
            // Add legend
            var legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.percent(50),
                x: am5.percent(50),
                marginTop: 15,
                marginBottom: 15
            }));
            
            legend.data.setAll(series.dataItems);
            
            // Add title
            chart.children.unshift(am5.Label.new(root, {
                text: "Distribución de Calificaciones Actuales",
                fontSize: 18,
                fontWeight: "500",
                textAlign: "center",
                x: am5.percent(50),
                centerX: am5.percent(50),
                paddingTop: 0,
                paddingBottom: 0
            }));
        });
    } else {
        $("#chart-container").hide();
    }
}

// Función auxiliar para asignar colores según la calificación
function getColorForCalificacion(calificacion) {
    const colores = {
        "EXCELENTE": "#4CAF50",
        "Muy Bueno": "#8BC34A",
        "Bueno": "#FFC107",
        "Regular": "#FF9800",
        "Deficiente": "#F44336",
        "Sin calificación": "#607D8B"
    };
    
    // Coincidencia exacta (cambia a includes si necesitas coincidencia parcial)
    return am5.color(colores[calificacion] || colores["Sin calificación"]);
}
// Modificación de tu función consultar_nombre5 para incluir el gráfico
function consultar_grafico() {
    // Destruir la tabla si ya está inicializada
    if ($.fn.DataTable.isDataTable('#tabla')) {
        $('#tabla').DataTable().destroy();
    }
    
    // Ocultar gráfico y contenedores al inicio
    $("#chart-container").hide();
    $("#items").hide();
  
    var nombre = $('#nombre').val();
    if (nombre == '') {
        alert('Por favor ingrese un rif.');
        return;
    } else {
        $("#items").show();
        
        // Mostrar el mensaje de cargando
        $("#loading").show();
        // var base_url = window.location.origin + '/asnc/index.php/evaluacion_desempenio/llenar_evaluaciones_contratistas';
        var base_url = '/index.php/evaluacion_desempenio/llenar_evaluaciones_contratistas';

        $.ajax({
            url: base_url,
            method: 'post',
            data: { nombre: nombre },
            dataType: 'json',
            success: function(data) {
                // Ocultar el mensaje de cargando
                $("#loading").hide();

                if (data.error) {
                    $('#tabla').hide();
                    $('#items').hide();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(0);
                    $("#chart-container").hide();
                } else {
                    $('#tabla').show();
                    $('#items').show();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(1);

                    $('#tabla tbody').children().remove();
                    $.each(data, function(index, response) {
                        $('#tabla tbody').append('<tr><td>' + response['nombre_ente'] + '</td><td>'
                            + response['razon_social'] + '</td><td>'
                            + response['objeto'] + '</td><td>'
                            + response['nombre_calificacion'] + '</td><td>'
                            + response['tipo'] + '</td></tr>'
                        );
                    });

                    $('#tabla').DataTable({
                        "paging": true,
                        "pageLength": 10,
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "excel",
                            text: "Exportar Hoja de Cálculo"
                        }]
                    });
                    
                    // Generar el gráfico con los datos recibidos
                    generarGraficoCalificaciones(data);
                }
            },
            error: function() {
                // Ocultar el mensaje de cargando en caso de error
                $("#loading").hide();
                alert('Error al cargar los datos.');
                $("#chart-container").hide();
            }
        });
    }
}

function consultar_nombre6() {
    // Destruir la tabla si ya está inicializada
    if ($.fn.DataTable.isDataTable('#tabla')) {
        $('#tabla').DataTable().destroy();
    }

  
    var nombre = $('#nombre').val();
    if (nombre == '') {
        alert('Por favor ingrese un rif.');
        return;
    } else {
        $("#items").show();
        
        // Mostrar el mensaje de cargando
        $("#loading").show();
        // var base_url =window.location.origin+'/asnc/index.php/Contratista/busquedarendiciones';

       // var base_url_3 = window.location.origin + '/asnc/index.php/Planilla_r_todo/pdfrt?id=';
        var base_url = '/index.php/Contratista/busquedarendiciones';
       // var base_url_3 = '/index.php/Planilla_r_todo/pdfrt?id=';

        $.ajax({
            url: base_url,
            method: 'post',
            data: { nombre: nombre },
            dataType: 'json',
            success: function(data) {
                // Ocultar el mensaje de cargando
                $("#loading").hide();

                if (data.error) {
                    $('#tabla').hide();
                    $('#items').hide();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(0);
                } else {
                    $('#tabla').show();
                    $('#items').show();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(1);

                    $('#tabla tbody').children().remove();
                    $.each(data, function(index, response) {
                        $('#tabla tbody').append('<tr><td>' + response['ente'] + '</td><td>'
                            + response['subtotal_rend_ejecu'] + '</td><td>'
                            + response['descripcion'] + '</td><td>'
                            + response['fecha_contrato'] + '</td><td>'
                             + response['desc_tipo_doc_contrata'] + '</td></tr>'
                          );

                       // $("#namec").val(response['nombre']);
             
                    });

                    $('#tabla').DataTable({
                        "paging": true,
                        "pageLength": 10,
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "excel",
                            text: "Exportar Hoja de Cálculo"
                        }]
                    });
                }
            },
            error: function() {
                // Ocultar el mensaje de cargando en caso de error
                $("#loading").hide();
                alert('Error al cargar los datos.');
            }
        });
    }
}
// function consultar_nombre2(){
//     var nombre = $('#nombre').val();
//     if (nombre == '') {
//         //...
//     } else {
//         $("#items").show();
//         // var base_url = '/index.php/Contratista/llenar_contratista_comi_conta2';
//         var base_url =window.location.origin+'/asnc/index.php/Contratista/llenar_contratista_comi_conta2';
//         $.ajax({
//             url: base_url,
//             method: 'post',
//             data: { nombre: nombre },
//             dataType: 'json',
//             success: function(data) {
//                 if (data.error) {
//                     // Mostrar inputs en lugar de la tabla
//                     $('#tabla').hide();
//                     $('#items').hide();
//                     $('#inputs').show();
//                     $('#cedula').val(nombre);
//                     $('#existe').val(0);
//                 } else {
//                     $('#tabla').show();
//                     $('#items').show();
//                     $('#inputs').show();
//                     $('#cedula').val(nombre);
//                     $('#existe').val(1);

//                     $('#tabla tbody').children().remove()
//                     $.each(data, function(index, response){
//                         $('#tabla tbody').append('<tr><td>' + response['rifced'] + '</td><td>'
//                                                         + response['nombre'] + '</td><td>'
//                                                         + response['percontacto'] + '</td><td>'
//                                                         + response['telf1'] + '</td></tr>'

//                                                         // + '<button class="boton2 btn"> <a href="llenar_contratista_nombre_ind?id='+ response['rifced'] +'">VER</button></td></tr>'
//                                                     );
//                     });

//                     // Inicializar DataTables y configurar la paginación
//                    $('#tabla').DataTable({
//                         "paging": true,
//                         "pageLength": 10, // número de filas por página
//                         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
//                            dom: "Bfrtip",
//          buttons: [{
//             extend: "excel",
//             text: "Exportar Hoja de Cálculo"
//         }] // opciones de número de filas por página
//                     });
//                 }
//             }
//         });
//     }
// }

function registrar(){
		var cedula = $("#cedula").val();
		var numero_oficio = $("#numero_oficio").val();
		var observacion = $("#observacion").val();
		var existe = $("#existe").val();


		if (numero_oficio == '') {
			document.getElementById("numero_oficio").focus();
		}else if(observacion == ''){
			document.getElementById("observacion").focus();
		}else {
			event.preventDefault();
			swal.fire({
				title: '¿Registrar?',
				text: '¿Esta seguro de Guardar?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: '¡Si, guardar!'
			}).then((result) => {
				if (result.value == true) {
					event.preventDefault();
					var datos = new FormData($("#resgistrar_eva")[0]);
					// var base_url =window.location.origin+'/asnc/index.php/Contratista/registrar_busqueda';
					// var base_url_3 =window.location.origin+'/asnc/index.php/Contratista/comisario_busqueda';


					var base_url = '/index.php/Contratista/registrar_busqueda';
                var base_url_3 = '/index.php/Contratista/comisario_busqueda';

					$.ajax({
						url:base_url,
						method: 'POST',
						data: datos,
						contentType: false,
						processData: false,
						success: function(response){
							if(response != '') {
								swal.fire({
									title: 'Registro Exitoso',
									type: 'success',
									showCancelButton: false,
									confirmButtonColor: '#3085d6',
									confirmButtonText: 'Ok'
								}).then((result) => {
									if (result.value == true){
										//location.reload();
                                    window.location.href = base_url_3 ; // Redirige a la URL generada

									}
								});
							}
						}
					})
				}
			});
		}
	}

	function validarInput(input) {
    input.value = input.value.replace(/[^0-9]/g, ''); // Reemplaza cualquier carácter que no sea un número
}

function validarInput2(input) {
    // Reemplaza cualquier carácter que no sea un número o una letra
    input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');
}