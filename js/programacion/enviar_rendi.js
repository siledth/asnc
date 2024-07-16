function modal1(id_programacion) {
    // Asigna el valor al input id_programacion
    document.getElementById('id_programacion77').value = id_programacion;
    // Muestra el modal
    $('#notif').modal('show');
  }
  function enviar() {
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
        if (document.notificar_snc.llenar_trimestre77.selectedIndex==0){
            swal.fire({
                title: 'Debe seleccionar un Trimestre, para continuar',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
           // alert("Debe seleccionar un Trimestre.")
            document.notificar_snc.llenar_trimestre77.focus()
            return 0;
     }
            if (result.value == true) {
                var id = $('#id_programacion77').val();
                var trimestre = $('#llenar_trimestre77').val();

                var base_url = '/index.php/Programacion/enviar_rendi';

                $.ajax({
                    url: base_url,
                    method: "post",
                    data: {
                        id: id,
                        trimestre: trimestre,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response == 1) {
                            swal
                               .fire({
                                    title: "Proceso Enviado, para visualizar su comprobante diríjase al menú programación luego en consultas seleccione el trimestre deseado ",
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
                    error: function(xhr, status, error) {
                        swal
                           .fire({
                                title: "Error al guardar datos",
                                text: "No se pudieron guardar los datos Intente nuevamente.",
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "Ok",
                            });
                    },
                });
            }
        });
}

    function rendi_py1(){
        event.preventDefault();
        swal
            .fire({
                title: "¿Registrar?",
                text: "¿Esta seguro de Notificar al SNC ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, guardar!",
            })
            .then((result) => {
                if (document.rendir_py.llenar_trimestre7.selectedIndex==0){
                    swal.fire({
                        title: 'Debe seleccionar un Trimestre.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value == true) {
                        }
                    });
                   // alert("Debe seleccionar un Trimestre.")
                    document.rendir_py.llenar_trimestre7.focus()
                    return 0;
             }
                if (result.value == true) {
                    event.preventDefault();
                    var datos = new FormData($("#rendir_py")[0]);
                    //            var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_bienes_acc';
                    var base_url = '/index.php/Programacion/save_rendi_pry';
                    
                    $.ajax({
                        url: base_url,
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            var menj = 'Rendido';
                           
                           if (response != '') {
                            swal.fire({
                                title: 'Registro Exitoso ',
                                text: menj ,
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
                            
                        },
                    });
                }
            });
        
    }
    