function camb_clave() {
    var clave = $("#clave").val();
    var c_clave = $("#c_clave").val();
    var id_usuario = $("input[name='id_usuario']").val(); // Obtener el ID del usuario
    var token = $("input[name='token']").val(); // Obtener el token

    // Expresión regular para validar la clave
    var regex = /^(?=.*[A-Z])(?=.*\d{2,})(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]$)[a-zA-Z\d!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]{6,16}$/;

    if (clave == '') {
        Swal.fire({
            icon: 'error',
            title: 'Mensaje de alerta!',
            text: 'El Campo Clave no puede estar vacío'
        });
        document.getElementById("clave").focus();
    } else if (c_clave == '') {
        Swal.fire({
            icon: 'error',
            title: 'Mensaje de alerta!',
            text: 'El Campo Confirmar Clave no puede estar vacío'
        });
        document.getElementById("c_clave").focus();
    } else if (id_usuario == '') {
        Swal.fire({
            icon: 'error',
            title: 'Ha ocurrido un error',
            text: 'Por favor vuelva a intentar'
        });
    } else if (!regex.test(clave)) {
        Swal.fire({
            icon: 'error',
            title: 'DISCULPE',
            text: 'La clave debe cumplir con los siguientes requisitos:\n' +
                  '- Al menos una letra mayúscula.\n' +
                  '- Al menos dos números.\n' +
                  '- Un carácter especial al final.\n' +
                  '- Longitud de 8 a 16 caracteres.'
        });
    } else if (clave !== c_clave) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las claves no coinciden.'
        });
    } else {
        event.preventDefault();
        Swal.fire({
            title: '¿Guardar?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Sí, guardar!'
        }).then((result) => {
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#camb_clave")[0]);
                var base_url = window.location.origin + '/asnc/index.php/Validacion_controller/cambiar_clave';
                var base_url2 = window.location.origin + '/asnc/index.php/Login/index';

                $.ajax({
                    url: base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Cambio Exitoso',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                window.location.href = base_url2;
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al procesar la solicitud.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            }
        });
    }
}