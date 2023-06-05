function modal(id) {
    var numero_proceso = id;

    var base_url =
        window.location.origin + "/asnc/index.php/Publicaciones/consultar_numeropro";

     

    $.ajax({
        url: base_url,
        method: "post",
        data: { numero_proceso: numero_proceso },
        dataType: "json",
        success: function(data) {
            $("#numero_proceso").val(numero_proceso);
            

            
        },
    });
}
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
            title: '¿Realizar Suspención?',
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
                var datos = new FormData($("#guardar_proc_suspencion")[0]);
                var base_url =window.location.origin+'/asnc/index.php/publicaciones/guardar_suspencion';
                //var base_url = '/index.php/publicaciones/guardar_suspencion';
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
                    }
                })
            }
        });
    }
}