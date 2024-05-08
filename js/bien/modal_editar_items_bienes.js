
//llenar el modal para editar items un bien
function modal(id) {
    var id_p_items = id;
        // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_item_modal_bienes';
        // var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_uni_med_mod';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';

        var base_url = '/index.php/Programacion/consultar_item_modal_bienes';
        var base_url2 = '/index.php/Programacion/llenar_uni_med_mod';
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
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
             $("#desc_ccnu").val(data["desc_ccnu"]);
            $("#especificacion").val(data["especificacion"]);
            $('#id_unid_med_b').val(data['id_unidad_medida']);
            $('#unid_med_b').val(data['desc_unidad_medida']);

            $('#id_ff_b').val(data['id_fuente_financiamiento']);
            $('#ff_b').val(data['desc_fuente_financiamiento']);

            $('#cantidad_mod_b').val(data['cantidad']);
            $('#primero_b').val(data['i']);
            $('#segundo_b').val(data['ii']);
            $('#tercero_b').val(data['iii']);
            $('#cuarto_b').val(data['iv']);
            $('#cant_total_distribuir_mod_b').val(data['cant_total_distribuir']);

            $('#costo_unitario_mod_b').val(data['costo_unitario']);
            $('#precio_total_mod_b').val(data['precio_total']);
            $('#ali_iva_e_b').val(data['alicuota_iva']);
            $('#iva_estimado_mod_b').val(data['iva_estimado']);
            $('#monto_estimado_mod_b').val(data['monto_estimado']);

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
            $('#sel_id_alic_iva_b').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
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
//////////////Guardara los cambios de los items editados
function guardar_tabla_b1(){
    var costo_unitario_mod_b = $("#costo_unitario_mod_b").val();
         
        if (  costo_unitario_mod_b <= 0) {
            swal.fire({
                title: 'El costo unitario debe ser un número mayor que cero, intente de nuevo',
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
            var id_items_proy = $('#id_items_b').val();

            // var partida_pre = $('#id_part_pres_b').val();
            // var selc_part_pres = $('#selc_part_pres_b').val();

            // var ccnu = $('#id_ccnu_mod_b').val();
            // var sel_ccnu = $('#sel_ccnu_b_m_b').val();

            var especificacion = $('#especificacion').val();

            var unid_med = $('#id_unid_med_b').val();
            var sel_camb_unid_medi = $('#camb_unid_medi_b').val();

            var cantidad = $('#cantidad_mod_b').val();
            var primero = $('#primero_b').val();
            var segundo = $('#segundo_b').val();
            var tercero = $('#tercero_b').val();
            var cuarto = $('#cuarto_b').val();
            var cantidad_distribuir = $('#cant_total_distribuir_mod_b').val();

            var cost_uni = $('#costo_unitario_mod_b').val();
            var prec_t = $('#precio_total_mod_b').val();

            var ali_iva_e = $('#ali_iva_e_b').val();
            var sel_id_alic_iva = $('#sel_id_alic_iva_b').val();

            var monto_iva_e = $('#iva_estimado_mod_b').val();
            var monto_tot_est = $('#monto_estimado_mod_b').val();
            var est_trim_1 = $('#estimado_primer').val();
            var est_trim_2 = $('#estimado_segundo').val();
            var est_trim_3 = $('#estimado_tercer').val();
            var est_trim_4 = $('#estimado_cuarto').val();
            var estimado_total_t_acc = $('#estimado_total_t_mod').val();

          //  var base_url =window.location.origin+'/asnc/index.php/Programacion/editar_fila_ip_b';
            var base_url = '/index.php/Programacion/editar_fila_ip_b';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    // partida_pre: partida_pre,
                    // selc_part_pres:selc_part_pres,
                    // ccnu: ccnu,
                    // sel_ccnu: sel_ccnu,

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

//////////////reprogramar bienes proyecto
function guardar_tabla_b12(){
    event.preventDefault();

    swal.fire({
        title: '¿Seguro de sea reprogramar?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Reprogramar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items_b').val();

            // var partida_pre = $('#id_part_pres_b').val();
            // var selc_part_pres = $('#selc_part_pres_b').val();

            // var ccnu = $('#id_ccnu_mod_b').val();
            // var sel_ccnu = $('#sel_ccnu_b_m_b').val();

            var especificacion = $('#especificacion').val();

            var unid_med = $('#id_unid_med_b').val();
            var sel_camb_unid_medi = $('#camb_unid_medi_b').val();

            var cantidad = $('#cantidad_mod_b').val();
            var primero = $('#primero_b').val();
            var segundo = $('#segundo_b').val();
            var tercero = $('#tercero_b').val();
            var cuarto = $('#cuarto_b').val();
            var cantidad_distribuir = $('#cant_total_distribuir_mod_b').val();

            var cost_uni = $('#costo_unitario_mod_b').val();
            var prec_t = $('#precio_total_mod_b').val();

            var ali_iva_e = $('#ali_iva_e_b').val();
            var sel_id_alic_iva = $('#sel_id_alic_iva_b').val();

            var monto_iva_e = $('#iva_estimado_mod_b').val();
            var monto_tot_est = $('#monto_estimado_mod_b').val();
            var est_trim_1 = $('#estimado_primer').val();
            var est_trim_2 = $('#estimado_segundo').val();
            var est_trim_3 = $('#estimado_tercer').val();
            var est_trim_4 = $('#estimado_cuarto').val();
            var estimado_total_t_acc = $('#estimado_total_t_mod').val();



            //var base_url =window.location.origin+'/asnc/index.php/Programacion/reprogramar_fila_ip_bien_proyecto';
            var base_url = '/index.php/Programacion/reprogramar_fila_ip_bien_proyecto';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    // partida_pre: partida_pre,
                    // selc_part_pres:selc_part_pres,
                    // ccnu: ccnu,
                    // sel_ccnu: sel_ccnu,

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
                            title: 'Se Reprogramo la información con exito.',
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

//////////////////////guarda la informacion del modar bienes acc reprogrmar modal
function guardar_reprogramacion_bienes_acc(){
    event.preventDefault();

    swal.fire({
        title: '¿Seguro que desea guardar la Modificación de programación?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items_b').val();

            // var partida_pre = $('#id_part_pres_b').val();
            // var selc_part_pres = $('#selc_part_pres_b').val();

            // var ccnu = $('#id_ccnu_mod_b').val();
            // var sel_ccnu = $('#sel_ccnu_b_m_b').val();

            var especificacion = $('#especificacion').val();

            var unid_med = $('#id_unid_med_b').val();
            var sel_camb_unid_medi = $('#camb_unid_medi_b').val();

            var ff = $('#id_ff_b').val();
            var sel_camb_ff1 = $('#camb_ff_b1').val();

            var cantidad = $('#cantidad_mod_b').val();
            var primero = $('#primero_b').val();
            var segundo = $('#segundo_b').val();
            var tercero = $('#tercero_b').val();
            var cuarto = $('#cuarto_b').val();
            var cantidad_distribuir = $('#cant_total_distribuir_mod_b').val();

            var cost_uni = $('#costo_unitario_mod_b').val();
            var prec_t = $('#precio_total_mod_b').val();

            var ali_iva_e = $('#ali_iva_e_b').val();
            var sel_id_alic_iva = $('#sel_id_alic_iva_b').val();

            var monto_iva_e = $('#iva_estimado_mod_b').val();
            var monto_tot_est = $('#monto_estimado_mod_b').val();
            var est_trim_1 = $('#estimado_primer').val();
            var est_trim_2 = $('#estimado_segundo').val();
            var est_trim_3 = $('#estimado_tercer').val();
            var est_trim_4 = $('#estimado_cuarto').val();
            var estimado_total_t_acc = $('#estimado_total_t_mod').val();
            var observaciones = $('#observaciones2').val();


          //  var base_url =window.location.origin+'/asnc/index.php/Programacion/reprogramar_items_acc_bienes';
            var base_url = '/index.php/Programacion/reprogramar_items_acc_bienes';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    // partida_pre: partida_pre,
                    // selc_part_pres:selc_part_pres,
                    // ccnu: ccnu,
                    // sel_ccnu: sel_ccnu,

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
                    ff: ff,
                    sel_camb_ff1: sel_camb_ff1,
                    
                    monto_iva_e: monto_iva_e,
                    monto_tot_est: monto_tot_est,
                    est_trim_1: est_trim_1,
                    est_trim_2: est_trim_2,
                    est_trim_3: est_trim_3,
                    est_trim_4: est_trim_4,
                    estimado_total_t_acc: estimado_total_t_acc,
                    observaciones:observaciones,

                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se Modifico la información con exito.',
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


/// bienes accion centralizada reprogramar agregar mas items

function guardar_acc_bien_rendi(){
    var id_programacion3 = $("#id_programacion2").val();
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_ccnu_acc = $("#id_ccnu_acc").val();
    var especificacion_acc = $("#especificacion_acc").val();
    var fecha_desde = $("#fecha_desde").val();
    var fecha_hasta = $("#fecha_hasta").val();

    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    
    var cantidad_acc = $("#cantidad_acc").val();

    //var cantidad_acc = $("#cant_total_distribuir").val();
    var I = $("#I").val();
    var II = $("#II").val();
    var III = $("#III").val();
    var IV = $("#IV").val();
    var costo_unitario_acc = $("#costo_unitario_acc").val();
    var precio_total = $("#precio_total").val();
    var id_alicuota_iva_acc = $("#id_alicuota_iva_acc").val();
    var iva_estimado_acc = $("#iva_estimado_acc").val();
    var monto_estimado_acc = $("#monto_estimado_acc").val();
    var estimado_i_acc = $("#estimado_i_acc").val();
    var estimado_ii_acc = $("#estimado_ii_acc").val();
    var estimado_iii_acc = $("#estimado_iii_acc").val();
    var estimado_iV_acc = $("#estimado_iV_acc").val();
    var estimado_total_t_acc = $("#estimado_total_t_acc").val();
    var observaciones = $("#observaciones").val();
    var cant_total_distribuir_acc = $("#cant_total_distribuir_acc").val(); 



    if (observaciones == '') {
        alert("Debe ingresar una observación de la reprogramación...")
        document.getElementById("observaciones").focus();
    }
    else if($("#par_presupuestaria_acc option:selected").val() == 0) {
        alert("Debe Seleccionar una Partida Presupuestaria");
        document.getElementById("par_presupuestaria_acc").focus();
        return false;
    }else if(id_estado_acc == ''){
        alert("Debe ingresar un estado")
        document.getElementById("id_estado_acc").focus();
    }
    else if($("#fuente_financiamiento_acc option:selected").val() == 0) {
        alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("fuente_financiamiento_acc").focus();
        return false;
    }
    else if(porcentaje_acc == ''){
        alert("el campo porcentaje no puede quedar vacio")

        document.getElementById("porcentaje_acc").focus();
    }else if($("#id_ccnu_acc option:selected").val() == 0) {
        alert("Debe Seleccionar un CCNU");
        document.getElementById("id_ccnu_acc").focus();
        return false;
    }
    else if(especificacion_acc == ''){
        alert("Debe ingresar una especificación")

        document.getElementById("especificacion_acc").focus();
    }else if($("#id_unidad_medida_acc option:selected").val() == 0) {
        alert("Debe Seleccionar una unidad de medida");
        document.getElementById("id_unidad_medida_acc").focus();
        return false;
    }
    else if(cantidad_acc == ''){
        alert("Debe ingresar una cantidad (Obligatorio)")

        document.getElementById("Cantidad").focus();
    }
    else if(costo_unitario_acc == ''){
        alert("Debe ingresar un Costo Unitario (Obligatorio)")

        document.getElementById("costo_unitario_acc").focus();
    } else if($("#id_alicuota_iva_acc option:selected").val() == 0) {
        alert("Debe Seleccionar un iva ");
        document.getElementById("id_alicuota_iva_acc").focus();
        return false;
    }
    else if (!cant_total_distribuir_acc || isNaN(cant_total_distribuir_acc)) {
        alert("Debe ingresar una cantidad válida (Obligatorio), revise para continuar");
        document.getElementById("cant_total_distribuir_acc").focus();
    }
    
    else{
        event.preventDefault();
        swal.fire({
            title: '¿Guardar Nueva Modificación?',
            text: '¿Esta seguro de agregar esta información?',
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
                var base_url = '/index.php/Programacion/Guar_reprogramar_mas_item_acc';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Modificación Exitoso',
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