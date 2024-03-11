function modal(id){
    $('#id').val(id);
}
function guardar_solicitud(){
    var id              = $("#id").val();
    var cedula_solc     = $("#cd").val();
    var nom_ape_solc    = $("#nom_ape_solc").val();
    var cargo           = $("#cargo").val();
    
    var telf_solc       = $("#telf_solc").val();
    var motivo       = $("#motivo").val();

   if (cedula_solc == '') {
    alert("Debe ingresar Cédula del Sol.")

        document.getElementById("cd").focus();
    }else if (nom_ape_solc == '') {
    alert("Debe ingresar Nombre y Apellido del solicitante.")

        document.getElementById("nom_ape_solc").focus();
    }else if (cargo == '') {
    alert("Debe ingresar cargo.")

        document.getElementById("cargo").focus();
    } else if (telf_solc == '') {
    alert("Debe ingresar Télefono del Solicitante")

        document.getElementById("telf_solc").focus();
    }
    else if (motivo == '') {
    alert("Debe ingresar Breve descripción de la Solicitud.(motivo)")

        document.getElementById("motivo").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: '¿Solicitad Editar Programació?',
            text: '¿Esta seguro que desea realizar la solicitud?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            if (result.value == true) {

                event.preventDefault();
                var datos = new FormData($("#resgistrar_solicitud")[0]);
                var base_url = '/index.php/Auth_prog/resgistrar_solicitud_edit';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                                var menj = 'Se ha Enviado la Solicitud Nroº: ';
                            swal.fire({
                                title: 'Registro Exitoso',
                                text: menj + response,
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value == true){
                                    location.reload();
                                    // $('#registrar_eval').attr("disabled", true)
                                    // $('#exampleModal').modal('show');
                                    // $('#id').val(response);
                                }
                            });
                        }
                    }
                })
            }
        });
    }
}