
function modal_ce(id_comision) {
    var id = id_comision;

   var base_url = '/index.php/Comision_contrata/consultar_t';
      // var base_url2 = '/index.php/certificacion/llenar_contratista_rp';

    //  var base_url =
    //      window.location.origin + "/asnc/index.php/Certificacion/consultar_certificacion";

   

    $.ajax({
        url: base_url,
        method: "post",
        data: { id: id },
        dataType: "json",
        success: function(data) {
            $("#id_mesualidad_ver").val(id);
          
            

        },
    });
}
function cambiarEndDate(){

    f = $("#vigen_cert_desde").val();; // Acá la fecha leída del INPUT
    vec = f.split('-'); // Parsea y pasa a un vector
    var fecha = new Date(vec[0], vec[1], vec[2]); // crea el Date
    fecha.setFullYear(fecha.getFullYear()+2); // Hace el cálculo
    res = fecha.getFullYear()+'-'+fecha.getMonth()+'-'+fecha.getDate(); // carga el resultado
    $('#vigen_cert_hasta').val(res);
    //console.log(res);f;
}
function cambiarEndDate2() {
    f = $("#vigen_cert_desde2").val();; // Read the date from the INPUT
    vec = f.split('-'); // Parse and convert to a vector
    var fecha = new Date(vec[0], vec[1] - 1, vec[2]); // Create the Date object (note that the month is 0-indexed)
    fecha.setDate(fecha.getDate() + 30); // Add 30 days
    res = fecha.getFullYear() + '-' + ('0' + (fecha.getMonth() + 1)).slice(-2) + '-' + ('0' + fecha.getDate()).slice(-2); // Format the result
    $('#vigen_cert_hasta2').val(res);
}

function enviar(id_comision) {


    event.preventDefault();
    swal
        .fire({
            title: "¿Seguro que desea enviar la comisión seleccionada?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, Enviar!",
        })
        .then((result) => {
            if (result.value == true) {
                var id = id_comision;
             //  var base_url =window.location.origin+'/asnc/index.php/Programacion/enviar_snc';
               var base_url = '/index.php/Comision_contrata/enviar_cm';
                   
                $.ajax({
                    url: base_url,
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response == 1) {
                            swal
                                .fire({
                                    title: "Proceso Enviado",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Ok",
                                })
                                .then((result) => {
                                    if (result.value == true) {
                                        location.reload();
                                    }
                                });
                        }
                    },error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Atenciòn',
                            type: 'error',
                            text: 'revise la informacion que intenta enviar, el total de miembros debe ser impar, vuelva a intentar'
                        });
                    }
                });
            }
        });
    }

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


	//GUARDAR comision
	function guardar_b(){
		var tipo_comi = $("#tipo_com").val();
        
		var observacion = $("#observacion").val();
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
                if ($("#tipo_com option:selected").val() == 0) {
                    swal.fire({
                        title: 'Para continuar debe seleccionar un tipo de contratación',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value == true) {
                        }
                    });
                   // alert("Debe Seleccionartipo de contrataciòn");
                    document.getElementById("tipo_com").focus();
                    return false;
                   // $("#guardar").prop('disabled', true)   

                }

				if (result.value == true) {
					event.preventDefault();
					var datos = new FormData($("#guardar_ba")[0]);
					//var base_url =window.location.origin+'/asnc/index.php/Certificaciones/registrar_b';
					var base_url = '/index.php/Comision_contrata/logger_commission';
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
	//BUSCAR BANCO PARA EDITAR
	function modal_ver(id){
		var id_comision = id;
		 
		var base_url = '/index.php/Comision_contrata/consulta_b';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_comision: id_comision},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_comision']);  
				$('#gace').val(response['gaceta']);
				$('#dateg').val(response['fecha_gaceta']);
			}
		});
	}
	//EDITAR BANCO
	function editar_b(){
		var id_comision = $("#id").val();
		var gace = $("#gace").val();
		var dateg = $("#dateg").val();

		var datos = new FormData($("#editar")[0]);
		if (gace == '') {
			document.getElementById("gace").focus();
		}else if(dateg == ''){
			document.getElementById("dateg").focus();
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
					var base_urls = '/index.php/Comision_contrata/editar_b';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_comision: id_comision,
							gace: gace,
							dateg: dateg
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

    function selectipo() {
        
        var tipo_comi = $("#tipo_com").val();
        if (tipo_comi == "2") {
            $("#campos3").show();
        } else {
            $("#campos3").hide();
        }
    
    
    
    
    }
    function ver_obs() {
        var tipo_pago = $("#tipo_comi").val();
        if (tipo_pago == "2") {
            $("#campos").show();
        } else {
            $("#campos").hide();
        }
    }
    ////miembros
    function modal(id) {
        var id_comision = id;          
        var base_url = '/index.php/Comision_contrata/check_comision';    
        $.ajax({
            url: base_url,
            method: "post",
            data: { id_comision: id_comision },
            dataType: "json",
            success: function(data) {
                $("#id_comision").val(id_comision);
                $("#rif_organoente2").val(data["rif_organoente"]);
              
    
            },
            
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error',
                            text: 'ocurrio un error, por favor vuelva a intentar.'
                        });
                    }
        });
    }

    // function save_miembros(){
    //     var cedula = $("#cedula").val();
    //     var nombre = $("#nombre").val();
    //     var apellido = $("#apellido").val();

    //     event.preventDefault();
    //     swal
    //         .fire({
    //             title: "¿Registrar?",
    //             text: "¿Esta seguro de registrar  ",
    //             type: "warning",
    //             showCancelButton: true,
    //             confirmButtonColor: "#3085d6",
    //             cancelButtonColor: "#d33",
    //             cancelButtonText: "Cancelar",
    //             confirmButtonText: "¡Si, guardar!",
    //         })
    //         .then((result) => {
    //             // if ($("#tipo_comi option:selected").val() == 0) {
    //             //     alert("seleccione Tipo de Comisión");
    //             //     document.getElementById("tipo_comi").focus();
    //             //     return false;
    //             // }
    //             //   if(cedula == ''){
    //             //     alert("el campo cedula no puede quedar vacio")            
    //             //     document.getElementById("cedula").focus();
    //             //     return false;
    //             // }
    //             //  if(nombre == ''){
    //             //     alert("el campo nombre no puede quedar vacio")            
    //             //     document.getElementById("nombre").focus();
    //             //     return false;
    //             // }
    //             // if(apellido == ''){
    //             //     alert("el campo apellido no puede quedar vacio")            
    //             //     document.getElementById("apellido").focus();
    //             //     return false;
    //             // }
    //             // if ($("#tipo_area option:selected").val() == 0) {
    //             //     alert("Seleccione Área");
    //             //     document.getElementById("tipo_area").focus();
    //             //     return false;
    //             // }
    //             // if ($("#tp_miembro option:selected").val() == 0) {
    //             //     alert("Seleccione Tipo Integrante");
    //             //     document.getElementById("tp_miembro").focus();
    //             //     return false;
    //             // }
    //             // if ($("#datedsg").val() === "") {
    //             //     alert("debe ingresar Fecha de Designación .");
    //             //     event.preventDefault();
    //             //   }
    //             //   if ($("#acto").val() === "") {
    //             //     alert("debe ingresar Acto Administrativo de Designación .");
    //             //     event.preventDefault();
    //             //   }
    //             //   if ($("#nacto").val() === "") {
    //             //     alert("debe ingresar Número Acto .");
    //             //     event.preventDefault();
    //             //   }
    //             //   if ($("#facto").val() === "") {
    //             //     alert("debe ingresar Fecha Acto .");
    //             //     event.preventDefault();
    //             //   }
    //             //   if ($("#correo").val() === "") {
    //             //     alert("debe ingresar Dirección de Correo Electrónico .");
    //             //     event.preventDefault();
    //             //   }
    //             //   if ($("#telf").val() === "") {
    //             //     alert("debe ingresar Teléfono .");
    //             //     event.preventDefault();
    //             //   }
           
    //             if (result.value == true) {
    //                 event.preventDefault();
    //                 var datos = new FormData($("#miembros")[0]);
    //                 var base_url = '/index.php/Comision_contrata/save_miembros';
                    
    //                 $.ajax({
    //                     url: base_url,
    //                     method: "POST",
    //                     data: datos,
    //                     contentType: false,
    //                     processData: false,
    //                     success: function(response) {
    //                         var menj = 'Rendido';
                           
    //                        if (response != '') {
    //                         swal.fire({
    //                             title: 'Registro Exitoso ',
    //                             text: menj ,
    //                             type: 'success',
    //                             showCancelButton: false,
    //                             confirmButtonColor: '#3085d6',
    //                             confirmButtonText: 'Ok'
    //                         }).then((result) => {
    //                             if (result.value == true){
    //                                 location.reload();
    //                             }
    //                         });
    //                         }
                            
    //                     },
    //                 });
    //             }
    //         });
        
    // }
    function save_miembros1(){
        event.preventDefault();
    
        swal.fire({
            title: '¿Guardar',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si!'
        }).then((result) => {
            if (result.value == true) {
                var id_comision = $('#id_comision').val();
                var id_cert =1 ;
                var id_remplazo =1 ;


                var rif_organoente = $('#rif_organoente2').val();
                var tipo_comision = $('#tipo_comi').val();
                var cedula= $('#cedula').val();
                var nombre = $('#nombre').val();
                var apellido = $('#apellido').val();
                var id_area_miembro = $('#tipo_area').val();
                var id_tp_miembro = $('#tp_miembro').val();
                // var fecha_desig = $('#datedsg').val();
                // var acto_adm = $('#acto').val();
                // var num_acto = $('#nacto').val();
                // var fecha_acto = $('#facto').val();
                var correo = $('#correo').val();
                var telf = $('#telf').val();
                var obj_comision = $('#observacion1').val();
                // if ($("#tipo_comi option:selected").val() == 0) {
                //     alert("seleccione Tipo de Comisión");
                //     document.getElementById("tipo_comi").focus();
                //     return false;
                // }
                  if(cedula == ''){
                    alert("el campo cedula no puede quedar vacio")            
                    document.getElementById("cedula").focus();
                    return false;
                }
                 if(nombre == ''){
                    alert("el campo nombre no puede quedar vacio")            
                    document.getElementById("nombre").focus();
                    return false;
                }
                if(apellido == ''){
                    alert("el campo apellido no puede quedar vacio")            
                    document.getElementById("apellido").focus();
                    return false;
                }
                if ($("#tipo_area option:selected").val() == 0) {
                    alert("Seleccione Área");
                    document.getElementById("tipo_area").focus();
                    return false;
                }
                if ($("#tp_miembro option:selected").val() == 0) {
                    alert("Seleccione Tipo Integrante");
                    document.getElementById("tp_miembro").focus();
                    return false;
                }
                // if ($("#datedsg").val() === "") {
                //     alert("debe ingresar Fecha de Designación .");
                //     event.preventDefault();
                //   }
                //   if ($("#acto").val() === "") {
                //     alert("debe ingresar Acto Administrativo de Designación .");
                //     event.preventDefault();
                //   }
                //   if ($("#nacto").val() === "") {
                //     alert("debe ingresar Número Acto .");
                //     event.preventDefault();
                //   }
                //   if ($("#facto").val() === "") {
                //     alert("debe ingresar Fecha Acto .");
                //     event.preventDefault();
                //   }
                  if ($("#correo").val() === "") {
                    alert("debe ingresar Dirección de Correo Electrónico .");
                    event.preventDefault();
                  }
                  if ($("#telf").val() === "") {
                    alert("debe ingresar Teléfono .");
                    event.preventDefault();
                  }

                var base_url = '/index.php/Comision_contrata/save1';
    
                $.ajax({
                    url:base_url,
                    method: 'post',
                    data:{
                         id_comision: id_comision,                        
                        rif_organoente: rif_organoente,
                       
                        cedula: cedula,
                        nombre: nombre,
                        apellido: apellido,
                        id_area_miembro: id_area_miembro,
                        id_tp_miembro: id_tp_miembro,
                        id_cert: id_cert,
                         id_remplazo: id_remplazo,
                        // num_acto: num_acto,
                        // fecha_acto: fecha_acto,
                        correo: correo,
                        telf: telf,  
                        obj_comision: obj_comision ,         

    
                    },
                    
                    dataType: 'json',
                    success: function(response){
                        if(response == 1) {
                            swal.fire({
                                title: 'Guardado.',
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
                       
                    } ,
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error',
                            text: 'ocurrio un error, por favor vuelva a intentar.'
                        });
                    }
                    
                }) 
            }
        });
    }
    //academico
    function modalacademico(id) {
        var id_comision = id;          
        var base_url = '/index.php/Comision_contrata/check_comision';  
        var base_url2 = '/index.php/Comision_contrata/check_miembros';

        $.ajax({
            url: base_url,
            method: "post",
            data: { id_comision: id_comision },
            dataType: "json",
            success: function(data) {
                $("#id_comision3").val(id_comision);
                $("#rif_organoente3").val(data["rif_organoente"]);
               // llena el select de ff
              
               var id_comision3 = data['id_comision'];
               $.ajax({
                   url:base_url2,
                   method: 'post',
                   data: {id_comision3: id_comision3},
                   dataType: 'json',
                   success: function(data){
                       $.each(data, function(index, data){
                           $('#id_miembro4').append('<option value="'+data['id_miembros']+'">'+data['cedula']+'</option>');
                       });
                   }
               }) 
    
            },
            
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error',
                            text: 'ocurrio un error, por favor vuelva a intentar.'
                        });
                    }
      
      
      
      
      
                });
               
    }

    $('#id_miembro4').on('select2:select', function (e) {
        var id_miembro = e.params.data['id'];
       
            var base_url = '/index.php/Comision_contrata/check_miembros1';                                      
           
        $.ajax({
            url: base_url,
            method: "post",
            data: { id_miembro: id_miembro },
            dataType: "json",
    
            success: function(response) {
                $("#cedula_miem").val(response["cedula"]);
                $("#name").val(response["nombre"]);
                $("#apellido_m").val(response["apellido"]);                
                $("#id_miembro_m").val(id_miembro);
                
           
            },
        });
    });

    function inactivar(id_comision) {


        event.preventDefault();
        swal
            .fire({
                title: "¿Seguro que desea inactivar la comisión seleccionada?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, Inactivar!",
            })
            .then((result) => {
                if (result.value == true) {
                    var id = id_comision;
                   var base_url = '/index.php/Comision_contrata/incactiva';
                       
                    $.ajax({
                        url: base_url,
                        method: "post",
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response == 1) {
                                swal
                                    .fire({
                                        title: "Comisión incactiva",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#3085d6",
                                        confirmButtonText: "Ok",
                                    })
                                    .then((result) => {
                                        if (result.value == true) {
                                            location.reload();
                                        }
                                    });
                            }
                        },error: function(jqXHR, textStatus, errorThrown) {
                            swal.fire({
                                title: 'Atenciòn',
                                type: 'error',
                                text: 'Vuelva a intentar'
                            });
                        }
                    });
                }
            });
        }
        function guardar_proc_pago() {
            event.preventDefault();
            swal
                .fire({
                    title: "Si?",
                    text: " ",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "¡Si, guardar!",
                })
                .then((result) => {
                   
                         if (document.guardar_proc_pag.status.selectedIndex==0){
                    alert("Debe seleccionar Un status.")
                    document.guardar_proc_pag.status.focus()
                    return 0;
             }
        
             if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_proc_pag")[0]);
                var base_url = '/index.php/Comision_contrata/guardar_proc_pag';
                var base_url_3 = '/index.php/Certificacion/verpdf?id=';
        
              
                //  var base_url =   window.location.origin +  "/asnc/index.php/Comision_contrata/guardar_proc_pag";
                //  var base_url_2 = window.location.origin + "/asnc/index.php/Certificacion/Listado_certificacion";
                //      var base_url_3 = window.location.origin + "/asnc/index.php/Certificacion/verpdf?id=";
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                       var menj = ' ';
                       /* if (response == "true") {
                            swal
                                .fire({
                                    title: "Registro Exitoso",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Ok",
                                })
                                .then((result) => {
                                    if (result.value == true) {
                                        window.location.href = base_url_2;
                                    }
                                });
                        }*/
                        if(response != '') {
                            swal.fire({
                                title: 'Registro Exitoso ',
                                text: menj + response,
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
                    },
                });
            }
                 
                });
        }