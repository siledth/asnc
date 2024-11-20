function desbloquear_usuario(id_fact) {
    event.preventDefault();
    swal
        .fire({
            title: "¿Seguro que desea desbloquear el usuario selecionado?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, Desbloquear!",
        })
        .then((result) => {
            if (result.value == true) {
                var id = id_fact;
         //desbloquear_usuario
              // var base_url =window.location.origin+'/asnc/index.php/User/desbloquear_usuario';
               var base_url = '/index.php/User/desbloquear_usuario';
                    //var base_url = '/index.php//User/desbloquear_usuario';
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
                                    title: "Proceso Exitoso",
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
//bloquear inhabilitar usuario
    function bloquear_usuario(id_fact) {
        event.preventDefault();
        swal
            .fire({
                title: "¿Seguro que desea inhabilitar el usuario selecionado?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, Inhabilitar!",
            })
            .then((result) => {
                if (result.value == true) {
                    var id = id_fact;
             //desbloquear_usuario
                  // var base_url =window.location.origin+'/asnc/index.php/User/desbloquear_usuario';
                   var base_url = '/index.php/User/bloquear_usuario1';
                        //var base_url = '/index.php//User/desbloquear_usuario';
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
                                        title: "Proceso Exitoso",
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
                title: "Asignar Permisos?",
                text: "¿Esta seguro ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, guardar!",
            })
            .then((result) => {
        
                if (result.value == true) {
                    event.preventDefault();
                    var datos = new FormData($("#guardar_perfiles")[0]);
                    var base_url = '/index.php/User/guardar_perfil'; //produccion
                    //  var base_url =window.location.origin+'/asnc/index.php/User/guardar_perfil';
                    var base_url_2 = '/index.php/User/perfil_';
                    //  var base_url_2 =  window.location.origin + "/asnc/index.php/User/perfil_";
             
                    $.ajax({
                        url: base_url,
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                             console.log(response);
                          //  var menj = 'Numero de Recibo: ';
                            if (response.trim() === "1") {
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
                                 } else {
                            // Manejo del caso en que la respuesta es "0"
                            swal.fire({
                                title: 'Error',
                                type: 'error', // Cambié 'type' a 'icon'
                                text: 'No se pudo guardar el perfil, por favor intente de nuevo.'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error', // Cambié 'type' a 'icon'
                            text: 'Ocurrió un error, por favor vuelva a intentar.'
                        });
                    }
                });
            }
        });
         }


 function selectipo() {
        
        var tipo_comi = $("#menu_rnce").val();
        if (tipo_comi == "1") {
            $("#campos3").show();
        } else {
            $("#campos3").hide();    }  
    
    }

     function selectipo2() {
        
        var tipo_comi = $("#menu_comisiones").val();
        if (tipo_comi == "1") {
            $("#campos4").show();
        } else {
            $("#campos4").hide();    }  
    
    }
    function selectipo3() {
        
        var tipo_comi = $("#menu_progr").val();
        if (tipo_comi == "1") {
            $("#campos5").show();
        } else {
            $("#campos5").hide();    }  
    
    }
    function selectipo4() {
        
        var tipo_comi = $("#menu_eval_desem").val();
        if (tipo_comi == "1") {
            $("#campos6").show();
        } else {
            $("#campos6").hide();    }  
    
    }

    function selectipo5() {
        
        var tipo_comi = $("#menu_llamado").val();
        if (tipo_comi == "1") {
            $("#campos7").show();
        } else {
            $("#campos7").hide();    }  
    
    }
     function selectipo6() {
        
        var tipo_comi = $("#ver_conf").val();
        if (tipo_comi == "1") {
            $("#campos8").show();
        } else {
            $("#campos8").hide();    }  
    
    }