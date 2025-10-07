function eliminar_proy(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = id
         //   var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_proy';

            var base_url = '/index.php/Programacion/eliminar_proy';
            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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

function eliminar_proyv2(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_proyecto = id
         //   var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_proy';

            // var base_url = '/index.php/Programacion/eliminar_proy';
            $.ajax({
                url:BASE_URL + 'index.php/Programacion/eliminar_proyv2',
                method: 'post',
                data:{
                    id_proyecto: id_proyecto
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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

function eliminar_acc(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_acc = id
          //  var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_acc';

            // var base_url = '/index.php/Programacion/eliminar_acc';
            $.ajax({
                url: BASE_URL + 'index.php/Programacion/eliminar_acc', 
                method: 'post',
                data:{
                    id_items_acc: id_items_acc
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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
function eliminar_accv2(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_acc = id
          //  var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_acc';

            // var base_url = '/index.php/Programacion/eliminar_acc';
            $.ajax({
                url: BASE_URL + 'index.php/Programacion/eliminar_accv2', 
                method: 'post',
                data:{
                    id_items_acc: id_items_acc
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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
/////////////////////eliminar item servicios 

function eliminar_items_servi(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_p_items = id
           // var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_items_serv';

            // var base_url = '/index.php/Programacion/eliminar_items_servi';
            $.ajax({
             url:BASE_URL + 'index.php/Programacion/eliminar_items_serv',
                method: 'post',
                data:{
                    id_p_items: id_p_items
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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
///versiones ocultar
function eliminar_items_servi2(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_p_items = id
           // var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_items_serv';

            // var base_url = '/index.php/Programacion/eliminar_items_servi';
            $.ajax({
             url:BASE_URL + 'index.php/Programacion/eliminar_items_bienes_versionado',
                method: 'post',
                data:{
                    id_p_items: id_p_items
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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

/////////////////////eliminar item Bienes 

function eliminar_items_bienes(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_p_items = id
           // var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_items_bienes';

            var base_url = '/index.php/Programacion/eliminar_items_bienes';
            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_p_items: id_p_items
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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

function eliminar_rendiciones(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea Borrar Registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_rendicion = id
            
            var base_url = '/index.php/Programacion/eliminar_rendiciones';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_rendicion: id_rendicion
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Borrado Exitosa',
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

function eliminar_items_bienes(id){
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_p_items = id
           // var base_url =window.location.origin+'/asnc/index.php/Programacion/eliminar_items_bienes';

            // var base_url = '/index.php/Programacion/eliminar_items_bienes_versionado';
            $.ajax({
                url:BASE_URL + 'index.php/Programacion/eliminar_items_bienes_versionado',
                method: 'post',
                data:{
                    id_p_items: id_p_items
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Eliminación Exitosa',
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