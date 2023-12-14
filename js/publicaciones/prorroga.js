function guardar_prorroga(){
    var fecha_fin_llamado = $("#fecha_fin_llamado").val();
    var fecha_tope = $("#fecha_tope").val();
    var numero_proceso = $("#numero_proceso").val();
    var causa_prorroga = $("#causa_prorroga").val();
    var hora_desde = $("#hora_desde").val();
    var hora_hasta = $("#hora_hasta").val();
    var hora_desde_sobre = $("#hora_desde_sobre").val();
    var observaciones = $("#observaciones").val();
    var especifique_anulacion = $("#especifique_anulacion").val();
    
    if (fecha_fin_llamado == '') {
        document.getElementById("fecha_fin_llamado").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: '¿Registrar prorroga?',
            text: '¿Esta seguro de Guardar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            if (document.guardar_ba.fecha_tope.value.length==0){
                alert("No puede dejar el campo fecha tope vacio, seleciones una Nueva Fecha fin para continuar con la prorroga")
                document.guardar_ba.fecha_tope.focus()
                return 0;
                }
            if (document.guardar_ba.especifique_anulacion.value.length==0){
                alert("No Puede dejar el campo Observación sobre la Prorroga  vacio, Ingrese una Observación sobre la Prorroga ")
                document.guardar_ba.especifique_anulacion.focus()
                return 0;
         }
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_ba")[0]);
            //    var base_url =window.location.origin+'/asnc/index.php/publicaciones/guardar_Prorroga';
            //     var base_url_2 =window.location.origin+'/asnc/index.php/publicaciones/anulacion';
                var base_url = '/index.php/publicaciones/guardar_Prorroga';
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
                                title: 'LLamado a concurso Prorrogado',
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



function guardar_suspencion(){
    
    var numero_proceso = $("#numero_proceso").val();
    
    
    if (numero_proceso == '') {
        document.getElementById("numero_proceso").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: '¿Suspender nùmero de procedimiento?',
            text: '¿Esta seguro de realizar la suspenciòn?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
        //     if (document.guardar_ba.fecha_tope.value.length==0){
        //         alert("No puede dejar el campo fecha tope vacio, seleciones una Nueva Fecha fin para continuar con la prorroga")
        //         document.guardar_ba.fecha_tope.focus()
        //         return 0;
        //         }
        //     if (document.guardar_ba.especifique_anulacion.value.length==0){
        //         alert("No Puede dejar el campo especifique anulacion vacio, Ingrese un especifique anulacion en el menu Programa del curso o taller")
        //         document.guardar_ba.especifique_anulacion.focus()
        //         return 0;
        //  }
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_ba")[0]);
               // var base_url =window.location.origin+'/asnc/index.php/publicaciones/guardar_Prorroga';
                var base_url = '/index.php/publicaciones/guardar_suspencion';
                //var base_url_2 =window.location.origin+'/asnc/index.php/publicaciones/anulacion';
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
                                title: 'Suspenciòn Exitoso',
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

function guardar_termino_manual(){
    
    var numero_proceso = $("#numero_proceso2").val();
    
    
    if (numero_proceso == '') {
        document.getElementById("numero_proceso2").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: '¿Terminar manual LLamado a Concurso?',
            text: '¿Esta seguro de Guardar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
        //     if (document.guardar_ba.fecha_tope.value.length==0){
        //         alert("No puede dejar el campo fecha tope vacio, seleciones una Nueva Fecha fin para continuar con la prorroga")
        //         document.guardar_ba.fecha_tope.focus()
        //         return 0;
        //         }
        //     if (document.guardar_ba.especifique_anulacion.value.length==0){
        //         alert("No Puede dejar el campo especifique anulacion vacio, Ingrese un especifique anulacion en el menu Programa del curso o taller")
        //         document.guardar_ba.especifique_anulacion.focus()
        //         return 0;
        //  }
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_ba")[0]);
            //    var base_url =window.location.origin+'/asnc/index.php/publicaciones/guardar_terminados';
            //     var base_url_2 =window.location.origin+'/asnc/index.php/publicaciones/anulacion';
                var base_url = '/index.php/publicaciones/guardar_terminados';
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
                                title: 'LLamado a concurso Terminado manual , Exito!',
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