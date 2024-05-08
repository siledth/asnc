function guardar_comprobante(){
   
  
    var objeto_acc = $("#objeto_acc").val();


    if (objeto_acc == '') {
        alert("no se puede guardar")
        document.getElementById("objeto_acc").focus();
    }else{
        event.preventDefault();
        swal.fire({
            title: '¿Generar PDF?',
            text: '¿Esta seguro ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_tcu")[0]);
              //  var base_url =window.location.origin+'/asnc/index.php/Programacion/Guar_reprogramar_mas_item_acc';
                var base_url = '/index.php/Programacion/guardar_comprobante_totales';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Exitoso',
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