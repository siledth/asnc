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
        // var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_evaluaciones_contratistas';

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