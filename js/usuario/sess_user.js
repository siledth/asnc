function delet_sse(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea Eliminar la Sesión?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var user_id = id
            var base_url = '/index.php/User/delet_sse';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    user_id: user_id
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se elimino la sesión',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        }
    });
}
