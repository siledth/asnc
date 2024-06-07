function enviar(id_programacion) {
    event.preventDefault();
    swal
        .fire({
            title: "¿Seguro que desea Notificar la Rendición seleccionada.",
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
             //  var base_url =window.location.origin+'/asnc/index.php/Programacion/enviar_snc';
               var base_url = '/index.php/Programacion/enviar_rendi';
                   
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