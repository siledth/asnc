function llenar_() {
    var tipo_pago = $("#acc_cargar").val();
    if (tipo_pago == "2") {
        $("#acc_s").show();
        $("#campos").hide();
    } else {
        $("#campos").show();
        $("#acc_s").hide();
    }
}

function selectipo() {
        
    var tipo_comi = $("#selec_acc").val();
    if (tipo_comi == "5") {
        $("#campos3").show();
    } else {
        $("#campos3").hide();
    }




}

	//GUARDAR acomisionccion llamado
	function guardar_b(){
		var numero_proceso = $("#numero_proceso").val();   
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
                if ($("#acc_cargar option:selected").val() == 0) {
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
                    document.getElementById("acc_cargar").focus();
                    return false;
                   // $("#guardar").prop('disabled', true)   

                }

				if (result.value == true) {
					event.preventDefault();
					var datos = new FormData($("#guardar_ba")[0]);
					var base_url = '/index.php/Publicaciones/acciones3';
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
						},error: function(jqXHR, textStatus, errorThrown) {
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
    function consultar_rif(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
        var rif_b = $('#rif_b').val();
        if (rif_b == ''){
            swal({
                title: "¡ATENCION!",
                text: "El campo no puede estar vacio.",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#00897b",
                confirmButtonText: "CONTINUAR",
                closeOnConfirm: false
            }, function(){
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
            $('#ueba').attr("disabled", true);
        }else{
            $("#items").show();
            // var base_url  = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista';
            // var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';
    
          var base_url = '/index.php/evaluacion_desempenio/llenar_contratista_2';
            var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';
    
            $.ajax({
                url:base_url,
                method: 'post',
                data: {rif_b: rif_b},
                dataType: 'json',
                success: function(data){
                    if (data == null) {
                        $("#no_existe").show();
                        $("#existe").hide();
    
                       // $('#exitte').val(0);
    
                    }else{
                        $("#existe").show();
                        $("#no_existe").hide();                  
    
                        $('#sel_rif_nombre5').val(data['rifced']);
                        $('#nombre_conta_5').val(data['nombre']);
                        
    
                        var rif_cont_nr = data['rifced'];
                        var ultprocaprob = data['ultprocaprob'];
                        $.ajax({
                            url:base_url2,
                            method: 'post',
                            data: {ultprocaprob: ultprocaprob,
                                  rif_cont_nr: rif_cont_nr},
                            dataType: 'json',
                            success: function(data){
                                $.each(data, function(index, response){
                                });
                            }
                        });
                    }
                }
            })
        }
    }
    $("#total_rendi5").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });
    $("#paridad_rendi5").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });
    function calculos_rendi_bienessacc(){

        var subt_rend_ejecu2 = $('#total_rendi5').val();
        var news1 = subt_rend_ejecu2.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var subt_rend_ejecu = news8.replace(',', ".");
    
        var paridad_rendi5 = $('#paridad_rendi5').val();
        var new1 = paridad_rendi5.replace('.', "");
        var new6 = new1.replace('.', "");
        var new7 = new6.replace('.', "");
        var new8 = new7.replace('.', "");
        var paridad_rendi55 = new8.replace(',', ".");
        var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
        var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
        var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
        $('#subtotal_rendi5').val(subtotal_rendi_factura3);    
              
    
             
        }
        function modal_ver(id){
            var id_accion = id;
            //var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b';
            var base_url = '/index.php/Publicaciones/consulta_accll';
            $.ajax({
                url: base_url,
                method:'post',
                data: {id_accion: id_accion},
                dataType:'json',
    
                success: function(response){
                    $('#id').val(response['id_accion']);
                    $('#cod_banco_edit').val(response['numero_proceso']);
                    $('#nombre_banco_edit').val(response['num_contrato']);
                }
            });
        }
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
                        var base_urls = '/index.php/Publicaciones/editar_accll';
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
        function enviar(numero_proceso) {
            event.preventDefault();
            swal
                .fire({
                    title: "¿Seguro que desea notificar la Informacion cargada?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "¡Si, Enviar!",
                })
                .then((result) => {
                    if (result.value == true) {
                        var id = numero_proceso;
                     //  var base_url =window.location.origin+'/asnc/index.php/Programacion/enviar_snc';
                       var base_url = '/index.php/Publicaciones/enviar_notificar_llc';
                           
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
                            },
                        });
                    }
                });
            }