function desbloquear_usuario(id_fact) {
    event.preventDefault();
    swal
        .fire({
            title: "¿Seguro que desea desbloquear el usuario selecionada?",
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