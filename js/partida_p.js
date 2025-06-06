
//TODO MAYUSCULA
function may(e){
	e.value = e.value.toUpperCase();
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
	//GUARDAR partida presupuestaria
function guardar_b(){
    var codigo_b = $("#codigo_b").val();
    var nombre_b = $("#nombre_b").val();

    if (codigo_b.trim() === '') {
        document.getElementById("codigo_b").focus();  
        swal.fire('Atención', 'El campo Código no puede estar vacío. Por favor, ingrésalo.', 'warning');
        return; 
    }
    if(nombre_b.trim() === ''){
        document.getElementById("nombre_b").focus(); // Pone el foco en el campo.
        swal.fire('Atención', 'El campo Descripción no puede estar vacío. Por favor, ingrésala.', 'warning');
        return; 
    }

    event.preventDefault();

    // --- 2. ara pedir confirmación al usuario antes de proceder.
    swal.fire({
        title: '¿Registrar?',
        text: '¿Está seguro de que desea guardar esta partida presupuestaria?',
        icon: 'warning', 
        showCancelButton: true, 
        confirmButtonColor: '#3085d6',  
        cancelButtonColor: '#d33', // Color del botón de cancelar.
        cancelButtonText: 'Cancelar', // Texto del botón de cancelar.
        confirmButtonText: '¡Sí, guardar!' // Texto del botón de confirmar.
    }).then((result) => {
        // Si el usuario hace clic en "¡Sí, guardar!" (result.value es true).
        if (result.value === true) {
            // Crea un objeto FormData para recopilar todos los datos del formulario 'guardar_ba'.
            var datos = new FormData($("#guardar_ba")[0]);
            // Define la URL base para la petición AJAX.
            // var base_url = window.location.origin + '/asnc/index.php/Fuentefinanc/registrar_b';
					var base_url = '/index.php/Fuentefinanc/registrar_b';

            
            // --- 3. Envío de datos vía AJAX ---
            // Realiza la petición AJAX al servidor.
            $.ajax({
                url: base_url, // URL a la que se envía la petición.
                method: 'POST', // Método HTTP.
                data: datos, // Datos del formulario.
                contentType: false, // No establecer tipo de contenido, FormData lo hace automáticamente.
                processData: false, // No procesar los datos, FormData ya los formatea.
                success: function(response){
                    // Se ejecuta si la petición AJAX fue exitosa (el servidor respondió).

                    // Importante: Convierte la respuesta del servidor a un número entero.
                    // Esto es crucial para comparar correctamente los códigos de respuesta.
                    response = parseInt(response, 10); 

                    // --- 4. Manejo de las respuestas del servidor y mostrar alertas específicas ---
                    if (response === 1) { // Código 1: Registro Exitoso
                        swal.fire({
                            title: 'Registro Exitoso',
                            text: 'La partida presupuestaria se ha guardado correctamente.',
                            icon: 'success', // Icono de éxito.
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value === true){
                                location.reload(); // Recarga la página si el usuario hace clic en 'Ok'.
                            }
                        });
                    } else if (response === 2) { // Código 2: Código Duplicado
                        swal.fire({
                            title: 'Error de Registro',
                            text: 'El código de partida presupuestaria que intentas registrar ya existe. Por favor, ingresa uno diferente.',
                            icon: 'error', // Icono de error.
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                    } else if (response === 3) { // Código 3: Descripción Duplicada
                        swal.fire({
                            title: 'Error de Registro',
                            text: 'La descripción de partida presupuestaria que intentas registrar ya existe. Por favor, ingresa una diferente.',
                            icon: 'error', // Icono de error.
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                    } else if (response === 0) { // Código 0: Error General al Insertar (información no guardada)
                        swal.fire({
                            title: 'Error al Guardar',
                            text: 'La información no se ha podido guardar debido a un error inesperado. Por favor, inténtalo de nuevo.',
                            icon: 'error', // Icono de error.
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                    } else { // Cualquier otra respuesta inesperada del servidor
                        swal.fire({
                            title: 'Error Inesperado',
                            text: 'Ha ocurrido un problema desconocido al intentar guardar la información. Contacta al soporte técnico. Código de respuesta: ' + response,
                            icon: 'error', // Icono de error.
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Se ejecuta si la petición AJAX falló (ej. problema de red, servidor no responde).
                    swal.fire({
                        title: 'Error de Conexión',
                        text: 'No se pudo conectar con el servidor. Verifica tu conexión a internet o intenta más tarde.',
                        icon: 'error', // Icono de error.
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }
    });
}

	//BUSCAR BANCO PARA EDITAR
	function modal_ver(id){
		var id_exonerado = id;
		//var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b';
		var base_url = '/index.php/Fuentefinanc/consulta_b';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_exonerado: id_exonerado},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_partida_presupuestaria']);
				$('#cod_banco_edit').val(response['codigopartida_presupuestaria']);
				$('#nombre_banco_edit').val(response['desc_partida_presupuestaria']);
			}
		});
	}
	//EDITAR BANCO
	function editar_b(){
		var id_banco = $("#id").val();
		var codigo_b = $("#cod_banco_edit").val();
		var nombre_b = $("#nombre_banco_edit").val();

		var datos = new FormData($("#editar")[0]);
		if (codigo_b == '') {
			document.getElementById("codigo_b").focus();
		}else if(nombre_b == ''){
			document.getElementById("nombre_b").focus();
		}else {
			event.preventDefault();
			swal.fire({
				title: 'Modificar?',
				text: '¿Esta seguro de Modificar este registro?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: '¡Si, guardar!'
			}).then((result) => {
				if (result.value == true) {
					event.preventDefault();
					var datos = new FormData($("#editar")[0]);
					//var base_urls =window.location.origin+'/asnc/index.php/Certificaciones/editar_b';
					var base_urls = '/index.php/Fuentefinanc/editar_b';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_banco: id_banco,
							codigo_b: codigo_b,
							nombre_b: nombre_b
						},
					dataType:'json',
						success: function(response){
							if(response != '') {
								swal.fire({
									title: 'Modificación Exitosa',
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
	//ELIMINAR
	function eliminar_b(id){
		event.preventDefault();
		swal.fire({
			title: '¿Seguro que desea Deshabilitar el Contratista?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: '¡Si, guardar!'
		}).then((result) => {
			if (result.value == true) {
				var id_exonerado = id
				//var base_url =window.location.origin+'/asnc/index.php/Certificaciones/eliminar_b';
				var base_url = '/index.php/Certificacion/eliminar_b';

				$.ajax({
					url:base_url,
					method: 'post',
					data:{
						id_exonerado: id_exonerado
					},
					dataType: 'json',
					success: function(response){
						if(response == 1) {
							swal.fire({
								title: 'Deshabilitar Exitosa',
								type: 'success',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Ok'
							}).then((result) => {
								if (result.value == true) {
									location.reload();
								}
							});
						}
					}
				})
			}
		});
	}
