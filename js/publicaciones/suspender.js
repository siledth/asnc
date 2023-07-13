function llenar_pago() {
    var tipo_pago = $("#supuesto").val();
    if (tipo_pago > "7") {
        $("#campos").show();
    } else {
        $("#campos").hide();
    }
}


function guardar_suspencion(){

    var numero_proceso = $("#numero_proceso").val();
    
    if (numero_proceso == '') {
        document.getElementById("numero_proceso").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: '¿Realizar Suspensión?',
            text: '¿Esta seguro de Guardar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            
          
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_ba")[0]);
            //     var base_url =window.location.origin+'/asnc/index.php/publicaciones/guardar_suspencion';
            //    var base_url_2 = window.location.origin+'/asnc/index.php/publicaciones/anulacion';
                var base_url = '/index.php/publicaciones/guardar_suspencion';
                var base_url_2 = '/index.php/publicaciones/anulacion';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Suspensión Exitosa',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value == true){
                                    window.location.href = base_url_2;
                                }
                            });
                        }
                    }
                })
            }
        });
    }
}