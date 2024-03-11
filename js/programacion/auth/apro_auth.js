function modal_ver(id){
    var id_auth = id;
    var base_url = '/index.php/Auth_prog/read_solic';
    $.ajax({
        url: base_url,
        method:'post',
        data: {id_auth: id_auth},
        dataType:'json',

        success: function(response){
            $('#id_ver').val(response['id_auth']);
            $('#id').val(response['id_programacion']);

            $('#rif').val(response['rif']);
            $('#descripcion').val(response['descripcion']);
            $('#anio').val(response['anio']);
            $('#motivo').val(response['motivo']);
            $('#cedula_solc').val(response['cedula_solc']);
            $('#nom_ape_solc').val(response['nom_ape_solc']);
            $('#telf_solc').val(response['telf_solc']);
            $('#fecha_solicitud').val(response['fecha_solicitud']);
        }
    });
}


function guardar() {
    event.preventDefault();
    
    swal.fire({
        title: '¿Seguro que desea Aprobar?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_auth = $('#id_ver').val();
            var id_programacion = $('#id').val();            
         var base_url = '/index.php/Auth_prog/guardar_solici';
            

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    
                    id_auth: id_auth,
                    id_programacion: id_programacion,               

                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se aprobo con exito.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == 1) {
                                location.reload();
                            }
                        });
                    }
                    },error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error',
                            text: 'ocurrio un error, por favor vuelva a intentar.'
                        });
                }
            })
        }
    });
}