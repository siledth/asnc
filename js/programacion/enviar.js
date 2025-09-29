function enviar(id_programacion) {
    event.preventDefault();
    swal
        .fire({
            title: "¿Seguro que desea remitir al SNC la Programación seleccionada?.",
            text: "Enviar solo cuando se haya terminado de cargar la programacion.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, Remitir!",
        })
        .then((result) => {
            if (result.value == true) {
                var id = id_programacion;
            //   var base_url =window.location.origin+'/asnc/index.php/Programacion/enviar_snc';
               var base_url = '/index.php/Programacion/enviar_snc';
                   
                $.ajax({
                    url: base_url,
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                  success: function(response) {
    if (response == 1) {
        swal.fire({
            title: "Proceso Enviado",
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Ok",
        }).then((result) => {
            if (result.value == true) {
                location.reload();
            }
        });
    } else if (response == "no_data") {
        swal.fire({
            title: "",
            text: "Debe realizar al menos una carga (acción centralizada o Proyecto) antes de remitir al SNC.",
            type: "error",
            confirmButtonColor: "#d33",
            confirmButtonText: "Cerrar"
        });
    }
}

                });
            }
        });
    }

    function modal(id) {
        var id = id;
       var base_url = '/index.php/User/consultar_user';
        //  var base_url =
        //      window.location.origin + "/asnc/index.php/User/consultar_user";   
    
        $.ajax({
            url: base_url,
            method: "post",
            data: { id: id },
            dataType: "json",
            success: function(data) {
                $("#id_ver").val(id);
                $("#nombrefun").val(data["nombrefun"]);
                $("#apellido").val(data["apellido"]);
                $("#cedula").val(data["cedula"]);
                $("#cargo").val(data["cargo"]);
                $("#email").val(data["email"]);
                $("#oficina").val(data["oficina"]);
                $("#tele_1").val(data["tele_1"]);
                $("#tele_2").val(data["tele_2"]);
                $("#perfil").html('<option value="'+ data[nombrep] +'">'+ data[nombrep] +'</option>');
                
    
                
            },
        });
    }
    //guardar modificacion usuario
    function mod_user() {
        event.preventDefault();
        swal
            .fire({
                title: "Modificar?",
                text: "¿Esta seguro de Modificar el Usuario ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, guardar!",
            })
            .then((result) => {
        //         if (document.guardar_proc_pag.dolar.value.length==0){
        //             alert("No Puede dejar el campo Valor Dolar vacio, Ingrese un Monto")
        //             document.guardar_proc_pag.dolar.focus()
        //             return 0;
        //      } 
        //         if (document.guardar_proc_pag.cantidad_pagar_otra.value.length==0){
        //             alert("No Puede dejar el campo la Cantidad a pagar $ vacio, Ingrese un Monto")
        //             document.guardar_proc_pag.cantidad_pagar_otra.focus()
        //             return 0;
        //      }     	if (document.guardar_proc_pag.id_tipo_pago.selectedIndex==0){
        //         alert("Debe seleccionar un Tipo de pago.")
        //         document.guardar_proc_pag.id_tipo_pago.focus()
        //         return 0;
        //  }
                if (result.value == true) {
                    event.preventDefault();
                    var datos = new FormData($("#guardar_mod_user")[0]);

            //produccion       
             var base_url = '/index.php/User/guardar_proc_pag';
                    // var base_url =
                    //     window.location.origin +
                    //     "/asnc/index.php/User/guardar_proc_pag";
                    //produccion 
                    var base_url_2 = '/index.php/User/modif_usuarios';
                    // var base_url_2 =
                    //     window.location.origin + "/asnc/index.php/User/modif_usuarios";
                        
                        // var base_url_3 =
                        // window.location.origin + "/marina/index.php/Mensualidades/verPago?id=";
                    $.ajax({
                        url: base_url,
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                          //  var menj = 'Numero de Recibo: ';
                            if (response == "true") {
                                swal
                                    .fire({
                                        title: "Modificado Exitoso",
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
                            }
                            // if(response != '') {
                            //     swal.fire({
                            //         title: 'Registro Exitoso ',
                            //         text: menj + response,
                            //         type: 'success',
                            //         showCancelButton: false,
                            //         confirmButtonColor: '#3085d6',
                            //         confirmButtonText: 'Ok'
                            //     }).then((result) => {
                            //         if (result.value == true){
                            //             window.location.href = base_url_3 + response;
                            //         }
                            //     });
                            // }
                        },
                    });
                }
            });
    }
    //guardar perfil
    function guardar_perfil() {
        event.preventDefault();
        swal
            .fire({
                title: "Guardar",
                text: "¿Esta seguro de Guardar Perfil? ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, guardar!",
            })
            .then((result) => {
        //         if (document.guardar_proc_pag.dolar.value.length==0){
        //             alert("No Puede dejar el campo Valor Dolar vacio, Ingrese un Monto")
        //             document.guardar_proc_pag.dolar.focus()
        //             return 0;
        //      } 
        //         if (document.guardar_proc_pag.cantidad_pagar_otra.value.length==0){
        //             alert("No Puede dejar el campo la Cantidad a pagar $ vacio, Ingrese un Monto")
        //             document.guardar_proc_pag.cantidad_pagar_otra.focus()
        //             return 0;
        //      }     	if (document.guardar_proc_pag.id_tipo_pago.selectedIndex==0){
        //         alert("Debe seleccionar un Tipo de pago.")
        //         document.guardar_proc_pag.id_tipo_pago.focus()
        //         return 0;
        //  }
                if (result.value == true) {
                    event.preventDefault();
                    var datos = new FormData($("#guardar_perfiles")[0]);

                    var base_url = '/index.php/User/guardar_perfil'; //produccion
                    //  var base_url =
                    //      window.location.origin +
                    //      "/asnc/index.php/User/guardar_perfil";

                    var base_url_2 = '/index.php/User/perfil_';
                    //  var base_url_2 =
                    //      window.location.origin + "/asnc/index.php/User/perfil_";
                        
                        // var base_url_3 =
                        // window.location.origin + "/marina/index.php/Mensualidades/verPago?id=";
                    $.ajax({
                        url: base_url,
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                          //  var menj = 'Numero de Recibo: ';
                            if (response == "true") {
                                swal
                                    .fire({
                                        title: "Perfil Guardado Exitoso",
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
                            }
                           
                        },
                    });
                }
            });
    }

    function enviarreprogramacion(id_programacion) {
        event.preventDefault();
        swal
            .fire({
                title: "¿Seguro que desea enviar al SNC la Modificación seleccionada?.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, Enviar!",
            })
            .then((result) => {
                if (result.value == true) {
                    var id = id_programacion;
                  // var base_url =window.location.origin+'/asnc/index.php/Programacion/enviar_snc_reprogramacion';
                   var base_url = '/index.php/Programacion/enviar_snc_reprogramacion';
                       
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



        function registrar_anio(){
            var anio  = $("#anio").val();
        
            event.preventDefault();
            swal.fire({
                title: '¿Registrar?',
                text: '¿Esta seguro de Registrar el año?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: '¡Si, guardar!'
            }).then((result) => {
                if (result.value == true) {
        
                    event.preventDefault();
                    var datos = new FormData($("#resgistrar_anio")[0]);
                   // var base_url =window.location.origin+'/asnc/index.php/programacion/agg_programacion_anio';
                   var base_url = '/index.php/programacion/agg_programacion_anio';
                    $.ajax({
                        url:base_url,
                        method: 'POST',
                        data: datos,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if(response == 1) {
                                swal.fire({
                                    title: 'Registro Exitoso',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.value == 1) {
                                        location.reload();
                                    }
                                });
                            }
                        }
                    })
                }
            });
        }

        $(document).ready(function () {
    $('#anio').on('blur', function () {
        var anio = $(this).val();
         var base_url = '/index.php/Programacion/valida_anios';
        //var base_url =window.location.origin+'/asnc/index.php/Programacion/valida_anios';


        if (anio === '') {
            $('#result-anio').html(
                '<div class="alert alert-warning"><strong>Atención!</strong> Debe ingresar un año válido.</div>'
            );
            $("#btn_guar_2").prop('disabled', true);
            return;
        }

        $.ajax({
            type: "POST",
            url: base_url,
            data: { anio: anio },
            success: function (data) {
                // data puede ser "ok", "existe", "fuera_rango"
                if (data === "ok") {
                    $('#result-anio').html(
                        '<div class="alert alert-success"><strong>Bien!</strong> Período disponible.</div>'
                    );
                    $("#btn_guar_2").prop('disabled', false);

                } else if (data === "existe") {
                    $('#result-anio').html(
                        '<div class="alert alert-danger"><strong>Error!</strong> Ese período ya está registrado para esta unidad.</div>'
                    );
                    $("#btn_guar_2").prop('disabled', true);

                } else if (data === "fuera_rango") {
                    var anio_actual = new Date().getFullYear();
                    var anio_siguiente = anio_actual + 1;

                    $('#result-anio').html(
                        '<div class="alert alert-warning"><strong>Atención!</strong> Solo se permite programar los años ' +
                        anio_actual + ' y ' + anio_siguiente + '.</div>'
                    );
                    $("#btn_guar_2").prop('disabled', true);
                } else {
                    $('#result-anio').html(
                        '<div class="alert alert-danger"><strong>Error!</strong> Respuesta inesperada del servidor.</div>'
                    );
                    $("#btn_guar_2").prop('disabled', true);
                }
            },
            error: function () {
                $('#result-anio').html(
                    '<div class="alert alert-danger"><strong>Error!</strong> No se pudo validar el año. Intente de nuevo.</div>'
                );
                $("#btn_guar_2").prop('disabled', true);
            }
        });
    });
});
