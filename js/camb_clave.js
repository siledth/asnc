function camb_clave(){

    var clave  = $("#clave").val();
    var c_clave  = $("#c_clave").val();

    if (clave == '') {
        swal("Mensaje de alerta!", "El Campo Clave no pueden estar vacio")
        document.getElementById("clave").focus();

    }else if(c_clave == '') {
        swal("Mensaje de alerta!", "no pueden estar vacios")
        document.getElementById("c_clave").focus();
    }else{
        event.preventDefault();
        swal.fire({
            title: 'Guardar?',
            text: '¿Esta seguro de cambiar su contraseña actual?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#camb_clave")[0]);
                // var base_url =window.location.origin+'/asnc/index.php/Login/cambiar_clave';
                // var base_url2 =window.location.origin+'/asnc/index.php/Login/logout';
                var base_url = '/index.php/Login/cambiar_clave';
                var base_url2 = '/index.php/Login/logout';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response == 1) {
                            swal.fire({
                                title: 'Cambio Exitoso, por Favor Vuelva a Iniciar Sesión',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                window.location.href = base_url2;
                            });
                        }else {
                            swal.fire({
                                title: 'Las claves deben coincidir',
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value == true) {}
                            });
                        }
                    }
                })
            }
        });
    }
}
