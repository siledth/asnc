function enviar(numero_proceso) {
    event.preventDefault();
    swal.fire({
        title: "¿Seguro que desea prorrogar?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "¡Si, Enviar!",
    }).then((result) => {
        if (result.value == true) {
            var base_url = window.location.origin + '/asnc/index.php/Publicaciones/enviar_snc';
       //  var base_url = '/index.php/Comision_contrata/enviar_cm1';

            $.ajax({
                url: base_url,
                method: "post",
                data: {
                    numero_proceso: numero_proceso,
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == 1) {  // Cambiado a comparar con 1
                        swal.fire({
                            title: "Llamado prorrogado",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok",
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload();
                            }
                        });
                    } else {
                        swal.fire({
                            title: 'Error',
                            icon: 'error',
                            text: response.error || 'No se pudo completar la operación'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire({
                        title: 'Error de conexión',
                        icon: 'error',
                        text: 'Ocurrió un error al comunicarse con el servidor'
                    });
                }
            });
        }
    });
}