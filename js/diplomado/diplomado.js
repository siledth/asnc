
//TODO MAYUSCULA
function may(e){
	e.value = e.value.toUpperCase();
}

function may(obj, id) {
    obj.value = obj.value.toUpperCase();
}
//SOLO NÚMEROS
function valideKey(evt){
	var code = (evt.which) ? evt.which : evt.keyCode;
	if(code==8) { // backspace.
		return true;
	}else if(code>=48 && code<=57) { // is a number.
		return true;
	}else{ // other keys.
		return false;
	}
}

//CRUD BANCO
	//GUARDAR BANCO
	function guardar_b(){
		var name_d = $("#name_d").val();
		var fdesde = $("#fdesde").val();
		var fhasta = $("#fhasta").val();
		var id_modalidad = $("#id_modalidad").val();


		if (name_d == '') {
			document.getElementById("name_d").focus();
		}else if(fdesde == ''){
			document.getElementById("fdesde").focus();
		}
		else if(fhasta == ''){
			document.getElementById("fhasta").focus();
		}
		else if(id_modalidad == ''){
			document.getElementById("id_modalidad").focus();
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
					var datos = new FormData($("#guardar_ba")[0]);
					// var base_url =window.location.origin+'/asnc/index.php/Diplomado/registrar_b';
					var base_url = '/index.php/Diplomado/registrar_b';
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
										location.reload();
									}
								});
							}
						}
					})
				}
			});
		}
	}
	// //BUSCAR BANCO PARA EDITAR
	// function modal_ver(id){
	// 	var id_exonerado = id;
	// 	//var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b';
	// 	var base_url = '/index.php/Certificacion/consulta_b';
	// 	$.ajax({
	// 		url: base_url,
	// 		method:'post',
	// 		data: {id_exonerado: id_exonerado},
	// 		dataType:'json',

	// 		success: function(response){
	// 			$('#id').val(response['id_exonerado']);
	// 			$('#cod_banco_edit').val(response['rif']);
	// 			$('#nombre_banco_edit').val(response['descripcion']);
	// 		}
	// 	});
	// }
	// //EDITAR BANCO
	// function editar_b(){
	// 	var id_banco = $("#id").val();
	// 	var codigo_b = $("#cod_banco_edit").val();
	// 	var nombre_b = $("#nombre_banco_edit").val();

	// 	var datos = new FormData($("#editar")[0]);
	// 	if (codigo_b == '') {
	// 		document.getElementById("codigo_b").focus();
	// 	}else if(nombre_b == ''){
	// 		document.getElementById("nombre_b").focus();
	// 	}else {
	// 		event.preventDefault();
	// 		swal.fire({
	// 			title: 'Modificar?',
	// 			text: '¿Esta seguro de Modificar este registro?',
	// 			type: 'warning',
	// 			showCancelButton: true,
	// 			confirmButtonColor: '#3085d6',
	// 			cancelButtonColor: '#d33',
	// 			cancelButtonText: 'Cancelar',
	// 			confirmButtonText: '¡Si, guardar!'
	// 		}).then((result) => {
	// 			if (result.value == true) {
	// 				event.preventDefault();
	// 				var datos = new FormData($("#editar")[0]);
	// 				//var base_urls =window.location.origin+'/asnc/index.php/Certificaciones/editar_b';
	// 				var base_urls = '/index.php/Certificacion/editar_b';
	// 				$.ajax({
	// 					url: base_urls,
	// 					method:'post',
	// 					data: {id_banco: id_banco,
	// 						codigo_b: codigo_b,
	// 						nombre_b: nombre_b
	// 					},
	// 				dataType:'json',
	// 					success: function(response){
	// 						if(response != '') {
	// 							swal.fire({
	// 								title: 'Modificación Exitosa',
	// 								type: 'success',
	// 								showCancelButton: false,
	// 								confirmButtonColor: '#3085d6',
	// 								confirmButtonText: 'Ok'
	// 							}).then((result) => {
	// 								if (result.value == true){
	// 									location.reload();
	// 								}
	// 							});
	// 						}
	// 					}
	// 				})
	// 			}
	// 		});
	// 	}
	// }
	// //ELIMINAR
	// function eliminar_b(id){
	// 	event.preventDefault();
	// 	swal.fire({
	// 		title: '¿Seguro que desea Deshabilitar el Contratista?',
	// 		type: 'warning',
	// 		showCancelButton: true,
	// 		confirmButtonColor: '#3085d6',
	// 		cancelButtonColor: '#d33',
	// 		cancelButtonText: 'Cancelar',
	// 		confirmButtonText: '¡Si, guardar!'
	// 	}).then((result) => {
	// 		if (result.value == true) {
	// 			var id_exonerado = id
	// 			//var base_url =window.location.origin+'/asnc/index.php/Certificaciones/eliminar_b';
	// 			var base_url = '/index.php/Certificacion/eliminar_b';

	// 			$.ajax({
	// 				url:base_url,
	// 				method: 'post',
	// 				data:{
	// 					id_exonerado: id_exonerado
	// 				},
	// 				dataType: 'json',
	// 				success: function(response){
	// 					if(response == 1) {
	// 						swal.fire({
	// 							title: 'Deshabilitar Exitosa',
	// 							type: 'success',
	// 							showCancelButton: false,
	// 							confirmButtonColor: '#3085d6',
	// 							confirmButtonText: 'Ok'
	// 						}).then((result) => {
	// 							if (result.value == true) {
	// 								location.reload();
	// 							}
	// 						});
	// 					}
	// 				}
	// 			})
	// 		}
	// 	});
	// }



function save_inf_ac() {
    var id_inscripcion = $('#id_inscripcion').val();
    var estatus = $('#fm_ac').val(); // 2 (Aceptada) o 3 (No Califica) 4 aprobado/ exonerado de pago
    var observacion = $('#obser').val();
    var tipo_pago = $('#tipo_pago').val();

    // var id_usuario = <?php echo $_SESSION['id_usuario'] ?>; // Asegúrate de tener la sesión

    if (estatus == "0") {
        alert("Seleccione una opción válida");
        return false;
    }
	   //var base_url =window.location.origin+'/asnc/index.php/Diplomado/actualizar_inscripcion';
					var base_url = '/index.php/Diplomado/actualizar_inscripcion';

    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: {
            id_inscripcion: id_inscripcion,
            estatus: estatus,
            observacion: observacion,
            tipo_pago: tipo_pago,

            // id_usuario: id_usuario
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                window.location.reload();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr) {
            alert("Error en la conexión");
        }
    });
}

function save_dec_pj() {
    var id_inscripcion = $('#id_inscripcion').val();
    var estatus = $('#fm_ac').val(); // 2 (Aceptada) o 3 (No Califica) 4 aprobado/ exonerado de pago
    var observacion = $('#obser').val();
    var tipo_pago = $('#tipo_pago').val();

    // var id_usuario = <?php echo $_SESSION['id_usuario'] ?>; // Asegúrate de tener la sesión

    if (estatus == "0") {
        alert("Seleccione una opción válida");
        return false;
    }
	//var base_url =window.location.origin+'/asnc/index.php/Diplomado/actualizar_inscripcion_pj';
					var base_url = '/index.php/Diplomado/actualizar_inscripcion_pj';

	

    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: {
            id_inscripcion: id_inscripcion,
            estatus: estatus,
            observacion: observacion,
             tipo_pago: tipo_pago
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                window.location.reload();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr) {
            alert("Error en la conexión");
        }
    });
}

 function llenar_20() {
      
        var factura = $("#fm_ac").val();
        if (factura == "2") {
            $("#cmp1").show();
        } else {
            $("#cmp1").hide();
        }
        }

///editar diplomado
// 		function modal_ver(id_diplomado) {
// 			var base_url = '/index.php/Certificacion/consulta_b'
//     $.ajax({
//         url:base_url }, // Asegúrate de que esta URL sea correcta
//         type: 'POST',
//         data: {
//             id_diplomado: id_diplomado
//         },
//         dataType: 'JSON',
//         success: function(response) {
//             if (response.status === 'success') {
//                 const data = response.data;
//                 $('#id_diplomado_edit').val(data.id_diplomado);
//                 $('#name_d_edit').val(data.name_d);
//                 $('#fdesde_edit').val(data.fdesde);
//                 $('#fhasta_edit').val(data.fhasta);
//                 $('#id_modalidad_edit').val(data.id_modalidad);
//                 $('#topmax_edit').val(data.topmax);
//                 $('#topmin_edit').val(data.topmin);
//                 $('#pay_edit').val(data.pay);
//                 $('#pronto_pago_edit').val(data.pronto_pago);
//                 $('#d_hrs_edit').val(data.d_hrs);
//                 $('#pago2desde_edit').val(data.pago2desde);
//                 $('#pago2hasta_edit').val(data.pago2hasta);

//                 // Calcular y llenar los campos de pago 1 y 2
//                 dividirCostoEdit();

//                 $('#exampleModal').modal('show'); // Muestra el modal
//             } else {
//                 alert('Error al cargar los datos del diplomado: ' + response.message);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//             alert('Error de comunicación con el servidor al cargar datos.');
//         }
//     });
// }

// // Función para guardar los cambios del diplomado
// function editar_diplomado() {
//     var formData = $('#editar_diplomado_form').serialize(); // Serializa todos los datos del formulario del modal

//     $.ajax({
//         url: '<?php echo base_url('tu_controlador/actualizar_diplomado'); ?>', // Asegúrate de que esta URL sea correcta
//         type: 'POST',
//         data: formData,
//         dataType: 'JSON',
//         success: function(response) {
//             if (response.status === 'success') {
//                 alert(response.message);
//                 $('#exampleModal').modal('hide'); // Oculta el modal
//                 location.reload(); // Recarga la página para ver los cambios
//             } else {
//                 alert('Error al guardar los cambios: ' + response.message);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//             alert('Error de comunicación con el servidor al guardar cambios.');
//         }
//     });
// }

// // Función dividirCostoEdit para el modal (debe estar en el mismo JS o accesible globalmente)
// function dividirCostoEdit() {
//     const costoTotal = document.getElementById('pay_edit').value;
//     const mitad = parseFloat(costoTotal) / 2; // Asegúrate de convertir a número flotante
//     document.getElementById('pay1_edit').value = mitad.toFixed(2); // Formatea a 2 decimales
//     document.getElementById('pay2_edit').value = mitad.toFixed(2); // Formatea a 2 decimales
// }

function modal_ver(id_diplomado) { // Cambiado el nombre del parámetro para mayor claridad
    // var id_exonerado = id; // Ya no es necesario, el parámetro ya es id_diplomado
    // var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b'; // Ruta anterior
    // var base_url = '<?php echo base_url('tu_controlador/get_diplomado_data'); ?>'; // ¡IMPORTANTE! Asegúrate que 'tu_controlador' sea el nombre real de tu controlador (ej: 'Diplomado')
	var base_url = '/index.php/Diplomado/get_diplomado_data';

    $.ajax({
        url: base_url,
        method: 'post',
        data: {
            id_diplomado: id_diplomado
        }, // Envías el ID del diplomado
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const data = response.data;
                // Llenar los campos del modal con los datos del diplomado
                $('#id_diplomado_edit').val(data.id_diplomado);
				console.log("DEBUG: ID cargado en el modal:", $('#id_diplomado_edit').val()); // ¡Añade este!
                $('#name_d_edit').val(data.name_d);
                $('#fdesde_edit').val(data.fdesde);
                $('#fhasta_edit').val(data.fhasta);
                $('#id_modalidad_edit').val(data.id_modalidad);
                $('#topmax_edit').val(data.topmax);
                $('#topmin_edit').val(data.topmin);
                $('#pay_edit').val(data.pay);
                $('#pronto_pago_edit').val(data.pronto_pago);
                $('#d_hrs_edit').val(data.d_hrs);
                $('#pago2desde_edit').val(data.pago2desde);
                $('#pago2hasta_edit').val(data.pago2hasta);

                // Recalcular los pagos parciales al cargar los datos
                dividirCostoEdit(); // Llama a la función específica para el modal de edición

                $('#exampleModal').modal('show'); // Muestra el modal
            } else {
                Swal.fire({ // Usando SweetAlert2 para mejor UX
                    title: 'Error',
                    text: 'Error al cargar los datos del diplomado: ' + response.message,
                    icon: 'error'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error AJAX en modal_ver:", xhr.responseText);
            Swal.fire({
                title: 'Error de Comunicación',
                text: 'Hubo un problema al intentar conectar con el servidor para obtener los datos del diplomado.',
                icon: 'error'
            });
        }
    });
}

// ---
// **Función para guardar los cambios del Diplomado**
// Esta es la adaptación de tu 'editar_b' original, ahora para diplomados.
// function editar_diplomado() {
//     // ... (validaciones básicas en el cliente)

//     Swal.fire({
//         title: '¿Modificar Diplomado?',
//         text: '¿Está seguro de Modificar este registro del Diplomado?',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         cancelButtonText: 'Cancelar',
//         confirmButtonText: '¡Sí, guardar cambios!'
//     }).then((result) => {
//         if (result.isConfirmed) {
// 					var base_url = '/index.php/Diplomado/actualizar_diplomado';

//             var datos = new FormData($("#editar_diplomado_form")[0]);

//             $.ajax({
//                 url: base_url,
//                 method: 'post',
//                 data: datos,
//                 processData: false,
//                 contentType: false,
//                 dataType: 'json',
//                 success: function(response) {
//                     if (response.status === 'success') {
//                         Swal.fire({
//                             title: 'Operación Exitosa', // Título más genérico
//                             text: response.message, // Usa el mensaje del servidor
//                             icon: 'success',
//                             showCancelButton: false,
//                             confirmButtonColor: '#3085d6',
//                             confirmButtonText: 'Ok'
//                         }).then((result) => {
//                             if (result.isConfirmed) {
//                                 $('#exampleModal').modal('hide');
//                                 location.reload();
//                             }
//                         });
//                     } else {
//                         // Muestra el mensaje de error que viene del servidor
//                         Swal.fire({
//                             title: 'Error al Guardar',
//                             text: response.message, // Usa el mensaje de error del servidor
//                             icon: 'error'
//                         });
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.error("Error AJAX en editar_diplomado:", xhr.responseText);
//                     Swal.fire({
//                         title: 'Error de Comunicación',
//                         text: 'Hubo un problema al intentar conectar con el servidor para guardar los cambios. Intente nuevamente.',
//                         icon: 'error'
//                     });
//                 }
//             });
//         }
//     });
// }
function editar_diplomado() {
    console.log("DEBUG: 1. Función editar_diplomado() iniciada.");

    var id_diplomado_edit = $("#id_diplomado_edit").val();
    var name_d_edit = $("#name_d_edit").val();
    var fdesde_edit = $("#fdesde_edit").val();

    console.log("DEBUG: id_diplomado_edit:", id_diplomado_edit);
    console.log("DEBUG: name_d_edit:", name_d_edit);
    console.log("DEBUG: fdesde_edit:", fdesde_edit);


    if (name_d_edit === '') {
        Swal.fire('Atención', 'El Nombre del Diplomado es obligatorio.', 'warning');
        $("#name_d_edit").focus();
        console.log("DEBUG: 2. Validación fallida: Nombre del Diplomado vacío.");
        return;
    }
    if (fdesde_edit === '') {
        Swal.fire('Atención', 'La Fecha de Inicio es obligatoria.', 'warning');
        $("#fdesde_edit").focus();
        console.log("DEBUG: 3. Validación fallida: Fecha de Inicio vacía.");
        return;
    }

    Swal.fire({
        title: '¿Modificar Diplomado?',
        text: '¿Está seguro de Modificar este registro del Diplomado?',
        type: 'warning', // CAMBIADO a 'type' por la advertencia
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, guardar cambios!'
    }).then((result) => {
        console.log("DEBUG: 4. Resultado de la confirmación de SweetAlert:", result);

        if (result.value === true) {
            console.log("DEBUG: 5. Usuario confirmó la modificación (result.value es TRUE).");

            var datos = {
                id_diplomado_edit: $("#id_diplomado_edit").val(),
                name_d_edit: $("#name_d_edit").val(),
                fdesde_edit: $("#fdesde_edit").val(),
                fhasta_edit: $("#fhasta_edit").val(),
                id_modalidad_edit: $("#id_modalidad_edit").val(),
                topmax_edit: $("#topmax_edit").val(),
                topmin_edit: $("#topmin_edit").val(),
                pay_edit: $("#pay_edit").val(),
                pronto_pago_edit: $("#pronto_pago_edit").val(),
                pay1_edit: $("#pay1_edit").val(),
                pay2_edit: $("#pay2_edit").val(),
                pago2desde_edit: $("#pago2desde_edit").val(),
                pago2hasta_edit: $("#pago2hasta_edit").val(),
                d_hrs_edit: $("#d_hrs_edit").val()
            };
            var base_urls = '/index.php/Diplomado/actualizar_diplomado';

            console.log("DEBUG: 6. URL de la petición AJAX:", base_urls);
            console.log("DEBUG: Datos a enviar (construidos manualmente):", datos); // ¡Revisa esto en la consola!

            $.ajax({
                url: base_urls,
                method: 'post',
                data: datos,
                // --- ¡¡¡ELIMINA ESTAS DOS LÍNEAS!!! ---
                // processData: false,
                // contentType: false,
                // ------------------------------------
                dataType: 'json',
                success: function(response) {
                    console.log("DEBUG: 7. Petición AJAX 'success' callback ejecutado. Respuesta:", response);
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Operación Exitosa',
                            text: response.message,
                            type: 'success', // CAMBIADO a 'type'
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((resultConfirm) => {
                            if (resultConfirm.value === true) {
                                $('#exampleModal').modal('hide');
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error al Guardar',
                            text: response.message,
                            type: 'error' // CAMBIADO a 'type'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("DEBUG: 8. Petición AJAX 'error' callback ejecutado. XHR:", xhr, "Status:", status, "Error:", error);
                    console.error("DEBUG: ResponseText:", xhr.responseText);
                    Swal.fire({
                        title: 'Error de Comunicación',
                        text: 'Hubo un problema al intentar conectar con el servidor para guardar los cambios. Intente nuevamente. Detalles: ' + error,
                        type: 'error' // CAMBIADO a 'type'
                    });
                }
            });
        } else {
            console.log("DEBUG: 9. Usuario canceló la modificación (result.value es FALSE).");
        }
    });
}
// ---
// Función para dividir el costo en el modal de edición
// Es importante que esta función esté definida donde sea accesible
function dividirCostoEdit() {
    const costoTotal = document.getElementById('pay_edit').value;
    const mitad = parseFloat(costoTotal) / 2;
    document.getElementById('pay1_edit').value = mitad.toFixed(2); // Asegura 2 decimales
    document.getElementById('pay2_edit').value = mitad.toFixed(2); // Asegura 2 decimales
}