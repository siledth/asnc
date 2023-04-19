function guardar(){
    var cedula_prop = $("#cedula_prop").val();
    var nombre = $("#nombre").val();
    var email = $("#email").val();
    var tipo = $("#tipo").val();
    var matricula = $("#matricula").val();
    var rif = $("#rif").val();
    var tele_1 = $("#tele_1").val();
    var propietario = $("#propietario").val();

    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de Registrarse?",
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
               //var base_url = window.location.origin + '/asnc/index.php/Login/registrar_prp'
              
                    var base_url = '/index.php/Login/registrar_prp';
                $.ajax({
                    url: base_url,
                    method: 'post',
                    data: {cedula_prop: cedula_prop,
                           nombre: nombre,
                           email:email
                        },
                    dataType: 'json',
                    success: function(data) {
                       // console.log(response);
                        var menj = 'La contraseña se envío al correo electronico ingresado.';
                        var menj2 = 'Ocurrido un error, por favor comunicarse con los administradores.';
                         if(data == true) {
                            $("#btn_guar_2").prop('disabled', true);
                             swal.fire({
                                 title: 'Registro Exitoso. ',
                                 text: menj,
                                 type: 'success',
                                 showCancelButton: false,
                                 confirmButtonColor: '#3085d6',
                                 confirmButtonText: 'Ok'
                             }).then((result) => {
                                 if (result.value == true){
                                    location.reload();
                                 }
                                 $("#btn_guar_2").prop('disabled', true);
                             });
                         }else{
                            $("#btn_guar_2").prop('disabled', true);
                            swal.fire({
                                title: 'Error',
                                text: menj2,
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value == true){
                                   location.reload();
                                   $("#btn_guar_2").prop('disabled', true);
                                }
                            });
                         }
                    },
                     
                });
            }
        });
}

