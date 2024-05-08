function guardar_reinicio(){
    var fecha_fin_llamado = $("#fecha_fin_llamado").val();
   
    
    if (fecha_fin_llamado == '') {
        document.getElementById("fecha_fin_llamado").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: '¿Re-Iniciar Número de Proceso?',
            text: '¿Esta seguro de Guardar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            if (document.guardar_ba.fecha_tope.value.length==0){
                alert("No puede dejar el campo fecha tope vacio, seleciones una Nueva Fecha fin para continuar.")
                document.guardar_ba.fecha_tope.focus()
                return 0;
                }
            if (document.guardar_ba.especifique_anulacion.value.length==0){
                alert("No Puede dejar el campo observacion reinicio  vacio, Ingrese una observacion Re-inicio")
                document.guardar_ba.especifique_anulacion.focus()
                return 0;
         }
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_ba")[0]);
            //     var base_url =window.location.origin+'/asnc/index.php/publicaciones/guardar_reinicio';
            //    var base_url_2 =window.location.origin+'/asnc/index.php/publicaciones/anulacion';
               var base_url = '/index.php/publicaciones/guardar_reinicio';
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
                                title: 'LLamado Re-Iniciado',
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