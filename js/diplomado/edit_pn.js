function modal(id) {
    var id_participante = id;
        var base_url =window.location.origin+'/asnc/index.php/Diplomado/consulta_datos_pn';
        // var base_url2 =window.location.origin+'/asnc/index.php/Comision_contrata/llenar_forma_aca_mod';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';

        // var base_url = '/index.php/Programacion/consultar_item_modal_bienes';
        //  var base_url2 = '/index.php/ccccc';
        // var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url7 = '/index.php/Programacion/llenar_ff_';
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_participante: id_participante },
        dataType: "json",
        success: function(data) {
            $('#id_participante').val(id); //cedula, nombres, apellidos, telefono, correo, edad, direccion
            
             $("#fm_ac1").val(data["cedula"]);
             $("#titulo").val(data["nombres"]);
             $("#anioi").val(data["apellidos"]);
             $("#anioc").val(data["telefono"]);
             $("#correo").val(data["correo"]);
             $("#edad").val(data["edad"]);
             $("#direccion").val(data["direccion"]);

            //  $("#desc_ccnu").val(data["desc_ccnu"]);
            // $("#especificacion").val(data["especificacion"]);
            // $('#id_unid_med_b').val(data['id_unidad_medida']);
            // $('#unid_med_b').val(data['desc_unidad_medida']);

            // $('#id_ff_b').val(data['id_fuente_financiamiento']);
            // $('#ff_b').val(data['desc_fuente_financiamiento']);


//  llena el select de unidad de medida
            // var id_academico = data['id_academico'];
            // $.ajax({
            //     url:base_url2,
            //     method: 'post',
            //     data: {id_academico: id_academico},
            //     dataType: 'json',
            //     success: function(data){
            //         $.each(data, function(index, data){
            //             $('#camb_id_academico').append('<option value="'+data['id_academico']+'">'+data['desc_academico']+'</option>');
            //         });
            //     }
            // })
 
        },
    });
}
function save_modif_inf_acad(){

    // var edad = $("#edad").val();        
    //     if (  edad <= 90) {
    //         swal.fire({
    //             title: 'número mayor que cero, intente de nuevo',
    //             type: 'warning',
    //             showCancelButton: false,
    //             confirmButtonColor: '#3085d6',
    //             confirmButtonText: 'Ok'
    //         }).then((result) => {
    //             if (result.value == true) {
    //             }
    //         });
    //        // return false; // no dejar guardar
    //     }
          
    //     else{
    event.preventDefault();

    swal.fire({
        title: '¿Seguro que desea guardar el registro?  ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_participante = $('#id_participante').val();
           // var id_academico = $('#id_academico').val();
           // var camb_id_academico = $('#camb_id_academico').val();
            var nombres = $('#titulo').val();
            var apellidos = $('#anioi').val();
            var telefono = $('#anioc').val();
            var correo = $('#correo').val();
            var edad = $('#edad').val();
            var direccion = $('#direccion').val();

        var base_url =window.location.origin+'/asnc/index.php/Diplomado/editar_datos_pn';

            // var base_url = '/index.php/Programacion/editar_fila_ip_b';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_participante: id_participante,
                    nombres: nombres,
                    apellidos: apellidos,
                    telefono: telefono,
                    correo:correo,
                    edad:edad,
                    direccion:direccion,
                    
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se Modificó la información con exito.',
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
// }

function modal_exp(id) {
    var id_inf_exp5 = id;
        var base_url =window.location.origin+'/asnc/index.php/Comision_contrata/consulta_infomr_modal_exp_miembro';
       var base_url2 =window.location.origin+'/asnc/index.php/Comision_contrata/llenar_ente';

        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';

        // var base_url = '/index.php/Programacion/consultar_item_modal_bienes';
        //  var base_url2 = '/index.php/ccccc';
        // var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url7 = '/index.php/Programacion/llenar_ff_';
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_inf_exp5: id_inf_exp5 },
        dataType: "json",
        success: function(data) {
            $('#id_inf_exp5').val(id);
            $("#arif").val(data["rif"]);
            $("#descripcion").val(data["descripcion"]);
            $("#area").val(data["areas"]);
             $("#cargo").val(data["cargo"]);
             $("#id_comision").val(data["id_comision"]);
             $("#desde").val(data["desde"]);
             $("#hasta").val(data["hasta"]);

               var rif = data['rif'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {rif: rif},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#cam_org').append('<option value="'+data['rif']+'">'+data['descripcion']+'</option>');
                    });
                }
            })
         
 
        },
    });
}

function save_modif_exp(){

   // var anioi = 2024       
        if ( area == '') {
            swal.fire({
                title: 'no puede dejar campos vacios , intente de nuevo',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
           // return false; // no dejar guardar
        }
          
        else{
    event.preventDefault();

    swal.fire({
        title: '¿Seguro que desea guardar el registro?  ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_inf_exp5 = $('#id_inf_exp5').val();
            var arif = $('#arif').val();
            var cam_org = $('#cam_org').val();
            var areas = $('#area').val();
            var cargo = $('#cargo').val();
            var desde = $('#desde').val();
            var hasta = $('#hasta').val();
        var base_url =window.location.origin+'/asnc/index.php/Comision_contrata/editar_modal_exp_miembro';

            // var base_url = '/index.php/Programacion/editar_fila_ip_b';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_inf_exp5: id_inf_exp5,
                    arif: arif,
                    cam_org: cam_org,
                    areas: areas,
                    cargo:cargo,
                    desde:desde,
                    hasta:hasta                    
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se Modificó la información con exito.',
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
}
