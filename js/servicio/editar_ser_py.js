function modal(id) {
    var id_p_items = id;
        // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_item_modal_bienes';
        // var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_uni_med_mod';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url4 =window.location.origin+'/asnc/index.php/Programacion/llenar_tipo_obra';
        // var base_url5 =window.location.origin+'/asnc/index.php/Programacion/llenar_alcance_obra';
        // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/llenar_objeto_obra';


        var base_url = '/index.php/Programacion/consultar_item_modal_bienes';
        var base_url2 = '/index.php/Programacion/llenar_uni_med_mod';
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url4 = '/index.php/Programacion/llenar_tipo_obra';
        var base_url5 = '/index.php/Programacion/llenar_alcance_obra';
        var base_url6 = '/index.php/Programacion/llenar_objeto_obra';
        var base_url7 = '/index.php/Programacion/llenar_ff_';


    $.ajax({
        url: base_url,
        method: "post",
        data: { id_p_items: id_p_items },
        dataType: "json",
        success: function(data) {
            $('#id_items_b').val(id);
            $("#id_p_items").val(id_p_items);
             $("#codigopartida_presupuestaria").val(data["codigopartida_presupuestaria"]);
             $("#desc_partida_presupuestaria").val(data["desc_partida_presupuestaria"]);
             $("#tipo_obra").val(data["descripcion_tip_obr"]);
           
             $("#itipo_obra").val(data["id_tip_obra"]);
             $('#ialcance_obra').val(data['id_alcance_obra']);    
             $('#iobj_obra').val(data['id_obj_obra']); 
            $("#especificacion").val(data["especificacion"]);

            $('#id_unid_med_b').val(data['id_unidad_medida']);
            $('#unid_med_b').val(data['desc_unidad_medida']);

            $('#id_ff_b').val(data['id_fuente_financiamiento']);
            $('#ff_b').val(data['desc_fuente_financiamiento']);

            $('#alcance_obra').val(data['descripcion_alcance_obra']);    
            $('#obj_obra').val(data['descripcion_obj_obra']); 

            $('#fecha_desde1').val(data['fecha_desde']);
            $('#fecha_hasta1').val(data['fecha_hasta']);

            $('#cantidad_mod_b').val(data['cantidad']);
            $('#primero_b').val(data['i']);
            $('#segundo_b').val(data['ii']);
            $('#tercero_b').val(data['iii']);
            $('#cuarto_b').val(data['iv']);
            $('#cant_total_distribuir_mod_b').val(data['cant_total_distribuir']);

            $('#costo_unitario_mod_b').val(data['costo_unitario']);
            $('#precio_total_mod_b1').val(data['precio_total']);
            $('#ali_iva_e_b').val(data['alicuota_iva']);
            $('#iva_estimado_mod_b1').val(data['iva_estimado']);
            $('#monto_estimado_mod_b1').val(data['monto_estimado']);

            $('#estimado_primer').val(data['est_trim_1']);
            $('#estimado_segundo').val(data['est_trim_2']);
            $('#estimado_tercer').val(data['est_trim_3']);
            $('#estimado_cuarto').val(data['est_trim_4']);
            $('#estimado_total_t_mod').val(data['estimado_total_t_acc']);
            
                    // llena el select de ff
                    var id_fuente_financiamiento = data['id_ff_b'];
                    $.ajax({
                        url:base_url7,
                        method: 'post',
                        data: {id_fuente_financiamiento: id_fuente_financiamiento},
                        dataType: 'json',
                        success: function(data){
                            $.each(data, function(index, data){
                                $('#camb_ff_b1').append('<option value="'+data['id_fuente_financiamiento']+'">'+data['desc_fuente_financiamiento']+'</option>');
                            });
                        }
                    })            
                        // llena el select de objto obra
                    var id_unid_med = data['id_tip_obra'];
                    $.ajax({
                        url:base_url6,
                        method: 'post',
                        data: {id_unid_med: id_unid_med},
                        dataType: 'json',
                        success: function(data){
                            $.each(data, function(index, data){
                                $('#camb_id_obj_obra').append('<option value="'+data['id_obj_obra']+'">'+data['descripcion_obj_obra']+'</option>');
                            });
                        }
                    })   
                     // llena el select de alcance obra
                var id_unid_med = data['id_tip_obra'];
                $.ajax({
                    url:base_url5,
                    method: 'post',
                    data: {id_unid_med: id_unid_med},
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(index, data){
                            $('#camb_id_alcance_obra').append('<option value="'+data['id_alcance_obra']+'">'+data['descripcion_alcance_obra']+'</option>');
                        });
                    }
                })       

                // llena el select de tipo obra
                var id_unid_med = data['id_tip_obra'];
                $.ajax({
                    url:base_url4,
                    method: 'post',
                    data: {id_unid_med: id_unid_med},
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(index, data){
                            $('#camb_tipo_obra').append('<option value="'+data['id_tip_obra']+'">'+data['descripcion_tip_obr']+'</option>');
                        });
                    }
                })


// llena el select de unidad de medida
            var id_unid_med = data['id_unidad_medida'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_unid_med: id_unid_med},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#camb_unid_medi_b').append('<option value="'+data['id_unidad_medida']+'">'+data['desc_unidad_medida']+'</option>');
                    });
                }
            })


//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_unid_med: id_unid_med},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#sel_id_alic_iva_b1').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

//             $("#canon").val(data["canon"]);
// //esto cambie
//             let canon = data["canon"];
//             // var newstr5 = canon.replace(".", "");
//             // var newstr6 = newstr5.replace(".", "");
//             // var newstr7 = newstr6.replace(".", "");
//             // var newstr8 = newstr7.replace(".", "");
//             // var canonn = newstr8.replace(",", ".");

//             $("#id_dolar").val(data["id_dolar"]);
//             $("#dolar").val(data["valor"]);
//             let dolar = data["valor"];
//             var dolarr = dolar.replace(",", ".");
//             let calculo = canon * dolarr;
//             var calculo_t = parseFloat(calculo).toFixed(2);
//             var calculo_tt = Intl.NumberFormat("de-DE").format(calculo_t);
//             $("#bs").val(calculo_tt);
        },
    });
}
$("#precio_total_mod_b1").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }
});
/////////////Guardar reprograma modal proyecto-servicio
function guardar_reprogramacion_servi_py(){//////////
    event.preventDefault();

    swal.fire({
        title: '¿Seguro desea editar ? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items_b').val();
            var especificacion = $('#especificacion').val();
            var unid_med = $('#id_unid_med_b').val();
            var sel_camb_unid_medi = $('#camb_unid_medi_b').val();

            var fecha_desde1 = $('#fecha_desde1').val();
            var fecha_hasta1 = $('#fecha_hasta1').val();

            var primero = $('#primero_b').val();
            var segundo = $('#segundo_b').val();
            var tercero = $('#tercero_b').val();
            var cuarto = $('#cuarto_b').val();
            var cantidad_distribuir = $('#cant_total_distribuir1').val();

            var prec_t = $('#precio_total_mod_b1').val();

            var ali_iva_e = $('#ali_iva_e_b').val();
            var sel_id_alic_iva = $('#sel_id_alic_iva_b1').val();

            var monto_iva_e = $('#iva_estimado_mod_b1').val();
            var monto_tot_est = $('#monto_estimado_mod_b1').val();
            var est_trim_1 = $('#estimado_primer').val();
            var est_trim_2 = $('#estimado_segundo').val();
            var est_trim_3 = $('#estimado_tercer').val();
            var est_trim_4 = $('#estimado_cuarto').val();
            var estimado_total_t_acc = $('#estimado_total_t_mod').val();
            var cantidad=0;
            var cost_uni=0;
            //var base_url =window.location.origin+'/asnc/index.php/Programacion/Repro_modal_py_servicios';
            var base_url = '/index.php/Programacion/edit_modal_py_servicios'; 

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    // partida_pre: partida_pre,
                    // selc_part_pres:selc_part_pres,
                    // ccnu: ccnu,
                    // sel_ccnu: sel_ccnu,
                    fecha_desde1: fecha_desde1,
                    fecha_hasta1: fecha_hasta1,
                    especificacion: especificacion,
                    unid_med: unid_med,
                    sel_camb_unid_medi: sel_camb_unid_medi,
                    cantidad:cantidad,
                    primero: primero,
                    segundo: segundo,
                    tercero: tercero,
                    cuarto: cuarto,
                    cantidad_distribuir:cantidad_distribuir,
                    cost_uni:cost_uni,
                    prec_t: prec_t,
                    ali_iva_e: ali_iva_e,
                    sel_id_alic_iva:sel_id_alic_iva,
                    monto_iva_e: monto_iva_e,
                    monto_tot_est: monto_tot_est,
                    est_trim_1: est_trim_1,
                    est_trim_2: est_trim_2,
                    est_trim_3: est_trim_3,
                    est_trim_4: est_trim_4,
                    estimado_total_t_acc: estimado_total_t_acc

                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se edito la información con exito.',
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