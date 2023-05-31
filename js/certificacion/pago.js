function modal(id){ //consulta el registro a pagar
    var id = id;
   // var base_url = window.location.origin+'/asnc/index.php/Certificacion/consulta_pago2';
    var base_url = '/index.php/Certificacion/consulta_pago2';
    $.ajax({
        url: base_url,
        method:'post',
        data: {id: id},
        dataType:'json',

        success: function(response){
            $('#id').val(response['id']);
            $('#rif_cont').val(response['rif_cont']);
            $('#total_bss').val(response['total_bss']);
        }
    });
}

//EDITAR el pago de la segunda revision
function guardar_pago_2(){
    var id = $("#id").val();
    var pago2 = $("#pago2").val();
    var banco_e2 = $("#banco_e2").val();
    var nro_referencia2 = $("#nro_referencia2").val();
    var fechatrnas2 = $("#fechatrnas2").val();
    var motivo_pago_2 = $("#motivo_pago_2").val();
    var banco_rec_2 = $("#banco_rec_2").val();

    var datos = new FormData($("#guardar_pago_2_")[0]);
    if (pago2 == '') {
        document.getElementById("pago2").focus();
    }else if(nro_referencia2 == ''){
        document.getElementById("nro_referencia2").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: 'Registrar pago?',
            text: '¿Esta seguro de procesar el pago?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_pago_2_")[0]);
                //var base_urls =window.location.origin+'/asnc/index.php/Certificacion/guardar_pago2';
                var base_urls = '/index.php/Certificacion/guardar_pago2';
                $.ajax({
                    url: base_urls,
                    method:'post',
                    data: {id: id,
                        pago2: pago2,
                        banco_e2: banco_e2,
                        banco_rec_2: banco_rec_2,
                         nro_referencia2: nro_referencia2,
                          fechatrnas2: fechatrnas2,
                          motivo_pago_2: motivo_pago_2
                    },
                dataType:'json',
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Registo de pago Exitoso, Espere respuesta del SNC',
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
