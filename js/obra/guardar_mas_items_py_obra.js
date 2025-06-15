function buscar_ccnnu(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var ccnu_b = $('#ccnu_b').val();
//esto llena ccnu de cargar nuevos items servicio
    //var base_url =window.location.origin+'/asnc/index.php/Programacion/llenar_selc_ccnu_m';
   var base_url = '/index.php/Programacion/llenar_selc_ccnu_m';
    $.ajax({
        url:base_url,
        method: 'post',
        data: {ccnu_b_m: ccnu_b},
        dataType: 'json',
        success: function(data){
            console.log(data);
            $('#id_ccnu_acc').find('option').not(':first').remove();
            $.each(data, function(index, response){
                $('#id_ccnu_acc').append('<option value="'+response['codigo_ccnu']+'/'+response['desc_ccnu']+'">'+response['desc_ccnu']+'</option>');
            });
        }
    })
}
/// MAS ITEMS obras proyecto

function guardar_py_obra(){
    
    var id_programacion3 = $("#id_programacion2").val();
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_ccnu_acc = $("#id_ccnu_acc").val();
    var especificacion_acc = $("#especificacion_acc").val();
    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    var cantidad_acc = $("#cant_total_distribuir").val();
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
    var cant_total_distribuir = $("#cant_total_distribuir").val();


    if ($("#par_presupuestaria_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar una Partida Presupuestaria',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe Seleccionar una Partida Presupuestaria");
        document.getElementById("par_presupuestaria_acc").focus();
        return false;
    }else if(id_estado_acc == ''){
        //alert("Debe ingresar un estado")
        swal.fire({
            title: 'Debe ingresar un estado',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("id_estado_acc").focus();
    }
    else if($("#fuente_financiamiento_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar una Fuente Financiamiento',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("fuente_financiamiento_acc").focus();
        return false;
    }
//    else if($("#id_ccnu_acc option:selected").val() == 0) {
//         alert("Debe Seleccionar un CCNU");
//         document.getElementById("id_ccnu_acc").focus();
//         return false;
//     }
else if($("#id_tip_obra option:selected").val() == 0) {
    swal.fire({
        title: 'Debe Seleccionar un Tipo de obra',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
    // alert("Debe Seleccionar una Fuente Financiamiento");
    document.getElementById("id_tip_obra").focus();
    return false;
}
else if($("#id_alcance_obra option:selected").val() == 0) {
    swal.fire({
        title: 'Debe Seleccionar un Alcance de Obra',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
    // alert("Debe Seleccionar una Fuente Financiamiento");
    document.getElementById("id_alcance_obra").focus();
    return false;
}
else if($("#id_obj_obra option:selected").val() == 0) {
    swal.fire({
        title: 'Debe Seleccionar un Objeto de Obra',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
    // alert("Debe Seleccionar una Fuente Financiamiento");
    document.getElementById("id_obj_obra").focus();
    return false;
}
else if(especificacion_acc == ''){
    swal.fire({
        title: 'Debe ingresar una especificación',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
    //alert("Debe ingresar una especificación")

    document.getElementById("especificacion_acc").focus();
}else if($("#id_unidad_medida_acc option:selected").val() == 0) {
    swal.fire({
        title: 'Debe Seleccionar una unidad de medida',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
    //  alert("Debe Seleccionar una unidad de medida");
    document.getElementById("id_unidad_medida_acc").focus();
    return false;
}
    else if(cant_total_distribuir > '1'){
        swal.fire({
            title: 'El Porcentaje a Distribuir debe ser igual a cero (obligatotio) (Debe ingresar la distribución porcentual en los campos de trimestres I,II,III,IV segun su programación)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("cant_total_distribuir").focus();
    }
    else if(precio_total == ''){
        // alert("Debe ingresar Un precio (Obligatorio)")
        swal.fire({
         title: 'Debe ingresar un precio (Obligatorio)',
         type: 'warning',
         showCancelButton: false,
         confirmButtonColor: '#3085d6',
         confirmButtonText: 'Ok'
     }).then((result) => {
         if (result.value == true) {
         }
     });
         document.getElementById("precio_total").focus();
     }
     else if($("#id_alicuota_iva option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un iva correspondiente (Obligatorio)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe Seleccionar un iva ");
        document.getElementById("id_alicuota_iva").focus();
        return false;
    }else{
        event.preventDefault();
        swal.fire({
            title: '¿Guardar Nueva Infomación a Obras?',
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
                //var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_mas_item_py_obras';
                var base_url = '/index.php/Programacion/Guardar_mas_item_py_obras';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Registro Exitoso',
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

function may(e){
	e.value = e.value.toUpperCase();
}
//SOLO NÚMEROS
function valideKey(evt){
	var code = (evt.which) ? evt.which : evt.keyCode;
	if(code==8) { // backspace.
		return true;
	}else if(code>=48 && code<=57) { // is a number.
		return true;
	}else{ // other keys.
		return false;
	}
}


function Guardar_mas_item_acc_servicio2(){
    
    var id_programacion3 = $("#id_programacion2").val();
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_ccnu_acc = $("#id_ccnu_acc").val();
    var especificacion_acc = $("#especificacion_acc").val();
    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    var cantidad_acc = $("#cant_total_distribuir").val();
    var I = $("#I").val();
    var II = $("#II").val();
    var III = $("#III").val();
    var IV = $("#IV").val();
    var costo_unitario_acc = $("#costo_unitario_acc").val();
    var precio_total_acc = $("#precio_total_acc").val();
    var id_alicuota_iva_acc = $("#id_alicuota_iva_acc").val();
    var iva_estimado_acc = $("#iva_estimado_acc").val();
    var monto_estimado_acc = $("#monto_estimado_acc").val();
    var estimado_i_acc = $("#estimado_i_acc").val();
    var estimado_ii_acc = $("#estimado_ii_acc").val();
    var estimado_iii_acc = $("#estimado_iii_acc").val();
    var estimado_iV_acc = $("#estimado_iV_acc").val();
    var estimado_total_t_acc = $("#estimado_total_t_acc").val();


    if (par_presupuestaria_acc == '') {
        document.getElementById("par_presupuestaria_acc").focus();
    }else if(id_estado_acc == ''){
        document.getElementById("id_estado_acc").focus();
    }
    else if(fuente_financiamiento_acc == ''){
    document.getElementById("fuente_financiamiento_acc").focus();
    }else if(porcentaje_acc == ''){
        document.getElementById("porcentaje_acc").focus();
    }else if(porcentaje_acc == ''){
            document.getElementById("porcentaje_acc").focus();
    }else if(id_ccnu_acc == ''){
        document.getElementById("id_ccnu_acc").focus();
    }else if(especificacion_acc == ''){
        document.getElementById("especificacion_acc").focus();
    }else{
        event.preventDefault();
        swal.fire({
            title: '¿Guardar Nueva Infomación Reprogramación?',
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
               // var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_mas_item_acc_servicio2';
                var base_url = '/index.php/Programacion/Guardar_mas_item_acc_servicio2';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Reprogramación Exitoso',
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

// function calculo_obras(){

//     var cantidad = 100;
//     var i = $('#primero_b').val();
//     var ii = $('#segundo_b').val();
//     var iii = $('#tercero_b').val();
//     var iv = $('#cuarto_b').val();

//     var cantidad_total = Number(i) + Number(ii) + Number(iii) + Number(iv)

//     var can_x_distr =   cantidad - i - ii - iii - iv
//     $('#cant_total_distribuir1').val(can_x_distr);

//     if (cantidad_total > 100) {
//         swal({
//             title: "¡ATENCION!",
//             text: "La cantidad a distribuir no puede ser mayor a 100! Por favor modifique para seguir con la carga.",
//             type: "warning",
//             showCancelButton: false,
//             confirmButtonColor: "#00897b",
//             confirmButtonText: "CONTINUAR",
//             closeOnConfirm: false
//         }, function(){
//             swal("Deleted!", "Your imaginary file has been deleted.", "success");
//         });

//         $("#precio_total_mod_b1").prop('disabled', true);
//         $("#sel_id_alic_iva_b1").prop('disabled', true);
//     }else{
//         $("#precio_total_mod_b1").prop('disabled', false);
//         $("#sel_id_alic_iva_b1").prop('disabled', false);
//         //Calculo Cantidad x DIstribuir
//             var can_x_distr =   cantidad - i - ii - iii - iv
//             $('#cant_total_distribuir1').val(can_x_distr);

//         //Remplazar decimales para caculos
//             var precio_total = $('#precio_total_mod_b1').val();
//             var newstr = precio_total.replace('.', "");
//             var newstr2 = newstr.replace('.', "");
//             var newstr3 = newstr2.replace('.', "");
//             var newstr4 = newstr3.replace('.', "");
//             var precio = newstr4.replace(',', ".");

//         //calculo de Iva Estimado
//             var id_alicuota_iva = $('#sel_id_alic_iva_b1').val();
//             var separar = id_alicuota_iva.split("/");
//             var porcentaje = separar['0'];
//             var monto_iva_estimado = precio*porcentaje;
//             var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
//             var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
//             $('#iva_estimado_mod_b1').val(iva_estimado2);

//         //Calculo Monto Total Estimado
//             var monto_total_est = Number(precio) + Number(iva_estimado);
//             var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
//             $('#monto_estimado_mod_b1').val(monto_total_estimado);

//         //Calculo estimado por Trimestre

//             var primer = (monto_total_est/cantidad_total)*i;
//             var primer_i = parseFloat(primer).toFixed(2);
//             var i_trim  = Intl.NumberFormat("de-DE").format(primer_i);
//             $('#estimado_primer').val(i_trim);


//             var segun = (monto_total_est/cantidad_total)*ii;
//             var segun_ii = parseFloat(segun).toFixed(2);
//             var ii_trim  = Intl.NumberFormat("de-DE").format(segun_ii);
//             $('#estimado_segundo').val(ii_trim);

//             var tercer = (monto_total_est/cantidad_total)*iii;
//             var tercer_iii = parseFloat(tercer).toFixed(2);
//             var iii_trim  = Intl.NumberFormat("de-DE").format(tercer_iii);
//             $('#estimado_tercer').val(iii_trim);

//             var cuarto = (monto_total_est/cantidad_total)*iv;
//             var cuarto_iv = parseFloat(cuarto).toFixed(2);
//             var iv_trim  = Intl.NumberFormat("de-DE").format(cuarto_iv);
//             $('#estimado_cuarto').val(iv_trim);

//         // Calculo total estimado trimestres
//             var total_est = primer+segun+tercer+cuarto
//             var total_estim = parseFloat(total_est).toFixed(2);
//             var estimado_total_t  = Intl.NumberFormat("de-DE").format(total_estim);
//             $('#estimado_total_t_mod').val(estimado_total_t);
//     }
// }
function calculo_obras() {
    var cantidad = 100; // Total que los porcentajes trimestrales deben sumar (100%)

    // 1. Obtener y validar los porcentajes trimestrales
    // Aseguramos que sean números, si están vacíos o no son válidos, usamos 0.
    var i = Number($('#primero_b').val()) || 0;
    var ii = Number($('#segundo_b').val()) || 0;
    var iii = Number($('#tercero_b').val()) || 0;
    var iv = Number($('#cuarto_b').val()) || 0;

    var cantidad_total = i + ii + iii + iv; // Suma de los porcentajes trimestrales

    // Calcular el porcentaje restante a distribuir
    var can_x_distr = cantidad - i - ii - iii - iv;
    $('#cant_total_distribuir1').val(can_x_distr);

    // 2. Validación de la suma trimestral
    if (cantidad_total > 100) {
        // Alerta si la suma excede el 100%
        swal({
            title: "¡ATENCION!",
            text: "La cantidad a distribuir no puede ser mayor a 100! Por favor modifique para seguir con la carga.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        });

        // Desactivar campos de precio y selección de IVA
        $("#precio_total_mod_b1").prop('disabled', true);
        $("#sel_id_alic_iva_b1").prop('disabled', true);

        // Resetear todos los campos de salida a "0,00"
        $('#iva_estimado_mod_b1').val("0,00");
        $('#monto_estimado_mod_b1').val("0,00");
        $('#estimado_primer').val("0,00");
        $('#estimado_segundo').val("0,00");
        $('#estimado_tercer').val("0,00");
        $('#estimado_cuarto').val("0,00");
        $('#estimado_total_t_mod').val("0,00");

    } else {
        // Si la suma es válida, activar campos
        $("#precio_total_mod_b1").prop('disabled', false);
        $("#sel_id_alic_iva_b1").prop('disabled', false);

        // 3. Obtener y procesar el 'Precio Total Estimado'
        var precio_total_str = $('#precio_total_mod_b1').val();
        // Eliminar puntos de miles y reemplazar coma decimal por punto.
        var precio = Number(precio_total_str.replace(/\./g, "").replace(',', "."));
        
        // Si 'precio' no es un número válido, lo establecemos en 0.
        if (isNaN(precio)) {
            precio = 0;
        }

        // 4. Determinar el Porcentaje de IVA - ¡Lógica definitiva para la prioridad!
        var porcentaje_iva = 0; // Inicializamos el porcentaje de IVA en 0

        var selectedIvaOption = $('#sel_id_alic_iva_b1').val(); // Valor del select (ej. "0.16/16%")
        var currentIvaRateInReadonly = $('#ali_iva_e_b').val(); // Valor actual en el input readonly (ej. "16" o "0.16")

        // === LÓGICA DE PRIORIDAD ===
        // PRIMERO: Intentamos obtener el IVA del SELECT si el usuario ha hecho una selección válida
        if (selectedIvaOption && selectedIvaOption !== "s" && selectedIvaOption.includes('/')) {
            var partes = selectedIvaOption.split("/");
            porcentaje_iva = Number(partes[0]); // Obtenemos el porcentaje (ej. 0.16)

            // OPCIONAL PERO RECOMENDADO: Actualizar el campo de solo lectura 'ali_iva_e_b'
            // para que muestre el valor del IVA que se acaba de seleccionar.
            // Esto es si tu select contiene el decimal (ej. 0.16) y quieres mostrar el porcentaje (ej. 16)
            // en el campo de solo lectura:
            $('#ali_iva_e_b').val(parseFloat(porcentaje_iva * 100).toFixed(0)); // Muestra "16" si partes[0] es 0.16

            // Si tu select contiene el porcentaje entero (ej. "16") y quieres mostrarlo igual:
            // $('#ali_iva_e_b').val(Number(partes[0]));

        } else if (currentIvaRateInReadonly) {
            // SEGUNDO: Si el SELECT está en "Seleccione" (o vacío/inválido),
            // entonces usamos el valor que ya está en el input de solo lectura.
            
            // ***IMPORTANTE: Ajusta esta línea según el formato de tu 'ali_iva_e_b'***
            // Caso 1: 'ali_iva_e_b' tiene el porcentaje como un número entero (ej. "16")
            porcentaje_iva = Number(currentIvaRateInReadonly) / 100;

            // Caso 2 (descomentar si aplica): 'ali_iva_e_b' ya tiene el valor decimal (ej. "0.16")
            // porcentaje_iva = Number(currentIvaRateInReadonly);

            // Caso 3 (descomentar si aplica): 'ali_iva_e_b' tiene el formato "16%"
            // porcentaje_iva = Number(currentIvaRateInReadonly.replace('%', '')) / 100;
            
            // Asegurarnos de que no sea NaN después de la conversión
            if (isNaN(porcentaje_iva)) {
                porcentaje_iva = 0;
            }
        }
        // ============================ FIN LÓGICA DE PRIORIDAD IVA ============================

        // Calcular el 'Monto IVA Estimado'
        var monto_iva_estimado = precio * porcentaje_iva;
        var iva_estimado_formatted = Intl.NumberFormat("de-DE").format(parseFloat(monto_iva_estimado).toFixed(2));
        $('#iva_estimado_mod_b1').val(iva_estimado_formatted);

        // 5. Calcular el 'Monto total Estimado'
        var monto_total_est = precio + monto_iva_estimado; // Usar monto_iva_estimado directo (sin toFixed aún) para mayor precisión
        var monto_total_est_formatted = Intl.NumberFormat("de-DE").format(parseFloat(monto_total_est).toFixed(2));
        $('#monto_estimado_mod_b1').val(monto_total_est_formatted);

        // 6. Cálculos de los Trimestres Estimados - Protección contra división por cero
        if (cantidad_total === 0) {
            // Si la suma de porcentajes es 0, los estimados son 0.
            $('#estimado_primer').val("0,00");
            $('#estimado_segundo').val("0,00");
            $('#estimado_tercer').val("0,00");
            $('#estimado_cuarto').val("0,00");
            $('#estimado_total_t_mod').val("0,00");
        } else {
            // Realizar cálculos solo si la suma de porcentajes es válida
            var primer = (monto_total_est / cantidad_total) * i;
            var segun = (monto_total_est / cantidad_total) * ii;
            var tercer = (monto_total_est / cantidad_total) * iii;
            var cuarto = (monto_total_est / cantidad_total) * iv;

            // Formatear y mostrar los estimados trimestrales
            $('#estimado_primer').val(Intl.NumberFormat("de-DE").format(parseFloat(primer).toFixed(2)));
            $('#estimado_segundo').val(Intl.NumberFormat("de-DE").format(parseFloat(segun).toFixed(2)));
            $('#estimado_tercer').val(Intl.NumberFormat("de-DE").format(parseFloat(tercer).toFixed(2)));
            $('#estimado_cuarto').val(Intl.NumberFormat("de-DE").format(parseFloat(cuarto).toFixed(2)));

            // Calcular y mostrar el total de los trimestres estimados
            var total_est_trimestres = primer + segun + tercer + cuarto;
            $('#estimado_total_t_mod').val(Intl.NumberFormat("de-DE").format(parseFloat(total_est_trimestres).toFixed(2)));
        }
    }
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

/////////////Guardara los cambios de los items editados
function guardar_tabla_obra(){
    var precio = $("#precio_total_mod_b1").val();
    var iva_estimado_mod_b1 = $("#iva_estimado_mod_b1").val();

    
         
        if (  precio <= 0) {
            swal.fire({
                title: 'El precio debe ser un número mayor que cero, intente de nuevo',
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
        else if (isNaN(iva_estimado_mod_b1)) {
            // Mostrar mensaje de error
            swal.fire({
                title: 'Debe Seleccionar un IVA, por favor revisar.',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
            document.getElementById("iva_estimado_mod_b1").focus();
        }
        
        
        
        else{
    event.preventDefault();

    swal.fire({
        title: '¿Seguro que desea guardar los cambios? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items_b').val();

            var tipo_obra = $('#itipo_obra').val();
            var camb_tipo_obra = $('#camb_tipo_obra').val();

            var alcance_obra = $('#ialcance_obra').val();
            var camb_id_alcance_obra = $('#camb_id_alcance_obra').val();

            var obj_obra = $('#iobj_obra').val();
            var camb_id_obj_obra = $('#camb_id_obj_obra').val();

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
          //  var base_url =window.location.origin+'/asnc/index.php/Programacion/editar_fila_py_obra';
            var base_url = '/index.php/Programacion/editar_fila_py_obra';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    // partida_pre: partida_pre,
                    // selc_part_pres:selc_part_pres,
                    // ccnu: ccnu,
                    // sel_ccnu: sel_ccnu,
                    tipo_obra: tipo_obra,
                    camb_tipo_obra: camb_tipo_obra,
                    alcance_obra: alcance_obra,
                    camb_id_alcance_obra: camb_id_alcance_obra,
                    obj_obra: obj_obra,
                    camb_id_obj_obra: camb_id_obj_obra,
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
///reprogramacion
//guardar MOdal obras acc reprogramar de accion centralizada
function guardar_tabla_obra_acc(){//////////////////////////////////////////accion central
    
    event.preventDefault();

    swal.fire({
        title: '¿Seguro desea Modificar? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items_b').val();

            var tipo_obra = $('#itipo_obra').val();
            var camb_tipo_obra = $('#camb_tipo_obra').val();

            var alcance_obra = $('#ialcance_obra').val();
            var camb_id_alcance_obra = $('#camb_id_alcance_obra').val();

            var obj_obra = $('#iobj_obra').val();
            var camb_id_obj_obra = $('#camb_id_obj_obra').val();

            var ff = $('#id_ff_b').val();
            var sel_camb_ff1 = $('#camb_ff_b1').val();

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
            var observaciones = $('#observaciones2').val();

           // var base_url =window.location.origin+'/asnc/index.php/Programacion/reprogramar_fila_acc_obra';
            var base_url = '/index.php/Programacion/reprogramar_fila_acc_obra'; 

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    // partida_pre: partida_pre,
                    // selc_part_pres:selc_part_pres,
                    // ccnu: ccnu,
                    // sel_ccnu: sel_ccnu,
                    tipo_obra: tipo_obra,
                    camb_tipo_obra: camb_tipo_obra,
                    alcance_obra: alcance_obra,
                    camb_id_alcance_obra: camb_id_alcance_obra,
                    obj_obra: obj_obra,
                    camb_id_obj_obra: camb_id_obj_obra,
                    
                    ff: ff,
                    sel_camb_ff1: sel_camb_ff1,

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
function guardar_tabla_obra_acc2(){//////////////////////////////////////////accion central
    var precio = $("#precio_total_mod_b1").val();
    var iva_estimado_mod_b1 = $("#iva_estimado_mod_b1").val();
    var observaciones2 = $("#observaciones2").val();

         
        if (  precio <= 0) {
            swal.fire({
                title: 'El precio debe ser un número mayor que cero, intente de nuevo',
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
        else if (isNaN(iva_estimado_mod_b1)) {
            // Mostrar mensaje de error
            swal.fire({
                title: 'Debe Seleccionar un IVA, por favor revisar.',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
            document.getElementById("iva_estimado_mod_b1").focus();
        }
        else if (observaciones2 == '') {
            swal.fire({
                title: 'Debe ingresar una observación para continuar, por favor intente de nuevo',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
           // alert("Debe ingresar una observación de la reprogramación")
            document.getElementById("observaciones2").focus();
        }
        
        
        
        else{
    event.preventDefault();

    swal.fire({
        title: '¿Seguro desea Modificar? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items_b').val();

            var tipo_obra = $('#itipo_obra').val();
            var camb_tipo_obra = $('#camb_tipo_obra').val();

            var alcance_obra = $('#ialcance_obra').val();
            var camb_id_alcance_obra = $('#camb_id_alcance_obra').val();

            var obj_obra = $('#iobj_obra').val();
            var camb_id_obj_obra = $('#camb_id_obj_obra').val();

            var ff = $('#id_ff_b').val();
            var sel_camb_ff1 = $('#camb_ff_b1').val();

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
            var observaciones = $('#observaciones2').val();

           // var base_url =window.location.origin+'/asnc/index.php/Programacion/reprogramar_fila_acc_obra';
            var base_url = '/index.php/Programacion/reprogramar_fila_acc_obra'; 

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    // partida_pre: partida_pre,
                    // selc_part_pres:selc_part_pres,
                    // ccnu: ccnu,
                    // sel_ccnu: sel_ccnu,
                    tipo_obra: tipo_obra,
                    camb_tipo_obra: camb_tipo_obra,
                    alcance_obra: alcance_obra,
                    camb_id_alcance_obra: camb_id_alcance_obra,
                    obj_obra: obj_obra,
                    camb_id_obj_obra: camb_id_obj_obra,
                    
                    ff: ff,
                    sel_camb_ff1: sel_camb_ff1,

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

}
///reprogramacion obra accion centralizada agregar mas fuera del modal
function guardar_acc_obra_reprograma(){
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
    var cant_total_distribuir = $("#cant_total_distribuir").val();
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


    if (observaciones == '') {
        swal.fire({
            title: 'Debe Ingresar Una Observación para continuar, por favor intente de nuevo',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("observaciones").focus();
    }
   else if ($("#par_presupuestaria_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar una Partida Presupuestaria',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe Seleccionar una Partida Presupuestaria");
        document.getElementById("par_presupuestaria_acc").focus();
        return false;
    }else if(id_estado_acc == ''){
        //alert("Debe ingresar un estado")
        swal.fire({
            title: 'Debe ingresar un estado',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("id_estado_acc").focus();
    }
    else if($("#fuente_financiamiento_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar una Fuente Financiamiento',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("fuente_financiamiento_acc").focus();
        return false;
    }
    else if(porcentaje_acc == ''){
        alert("el campo porcentaje no puede quedar vacio")

        document.getElementById("porcentaje_acc").focus();
    }
    else if(especificacion_acc == ''){
        swal.fire({
            title: 'Debe ingresar una especificación',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe ingresar una especificación")

        document.getElementById("especificacion_acc").focus();
    }
    else if($("#id_unidad_medida_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar una unidad de medida',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //  alert("Debe Seleccionar una unidad de medida");
        document.getElementById("id_unidad_medida_acc").focus();
        return false;
    }
    else if($("#id_tip_obra option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un Tipo de obra',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("id_tip_obra").focus();
        return false;
    }
    else if($("#id_alcance_obra option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un Alcance de Obra',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("id_alcance_obra").focus();
        return false;
    }
    else if($("#id_obj_obra option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un Objeto de Obra',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("id_obj_obra").focus();
        return false;
    }
    else if(cant_total_distribuir > '1'){
        swal.fire({
            title: 'El porcentaje a Distribuir debe ser igual a cero (obligatotio) (Debe ingresar la distribución porcentual en los campos de trimestres I,II,III,IV segun su programación)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("cant_total_distribuir").focus();
    }
    else if(precio_total == ''){
        // alert("Debe ingresar Un precio (Obligatorio)")
        swal.fire({
         title: 'Debe ingresar un precio (Obligatorio)',
         type: 'warning',
         showCancelButton: false,
         confirmButtonColor: '#3085d6',
         confirmButtonText: 'Ok'
     }).then((result) => {
         if (result.value == true) {
         }
     });
         document.getElementById("precio_total").focus();
     }
    else if(fecha_hasta === ""){
        swal.fire({
            title: 'Debe ingresar un fecha hasta (Obligatorio)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("fecha_hasta").focus();
     }
     else if(fecha_desde === ""){
        swal.fire({
            title: 'Debe ingresar un fecha desde (Obligatorio)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("fecha_desde").focus();
     }
     else if($("#id_alicuota_iva option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un iva correspondiente (Obligatorio)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe Seleccionar un iva ");
        document.getElementById("id_alicuota_iva").focus();
        return false;
    }else{
        event.preventDefault();
        swal.fire({
            title: '¿Guardar Modificación?',
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
                var datos = new FormData($("#guardar_tcu1")[0]);
               // var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_repro_item_acc_obra';
                var base_url = '/index.php/Programacion/Guardar_repro_item_acc_obra';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Registro Exitoso',
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

/////////////Guardar reprograma modal proyecto-obra
function guardar_reprogramacion_obra_py(){//////////////////////////////////////////accion central
    var precio = $("#precio_total_mod_b1").val();
    var iva_estimado_mod_b1 = $("#iva_estimado_mod_b1").val();
    var observaciones2 = $("#observaciones2").val();

         
        if (  precio <= 0) {
            swal.fire({
                title: 'El precio debe ser un número mayor que cero, intente de nuevo',
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
        else if (isNaN(iva_estimado_mod_b1)) {
            // Mostrar mensaje de error
            swal.fire({
                title: 'Debe Seleccionar un IVA, por favor revisar.',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
            document.getElementById("iva_estimado_mod_b1").focus();
        }
        else if (observaciones2 == '') {
            swal.fire({
                title: 'Debe ingresar una observación para continuar, por favor intente de nuevo',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
           // alert("Debe ingresar una observación de la reprogramación")
            document.getElementById("observaciones2").focus();
        }
        
        
        
        else{
    event.preventDefault();

    swal.fire({
        title: '¿Seguro desea Modificar? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items_b').val();

            var tipo_obra = $('#itipo_obra').val();
            var camb_tipo_obra = $('#camb_tipo_obra').val();

            var alcance_obra = $('#ialcance_obra').val();
            var camb_id_alcance_obra = $('#camb_id_alcance_obra').val();

            var obj_obra = $('#iobj_obra').val();
            var camb_id_obj_obra = $('#camb_id_obj_obra').val();

            var ff = $('#id_ff_b').val();
            var sel_camb_ff1 = $('#camb_ff_b1').val();

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
            var observaciones = $('#observaciones2').val();

           // var base_url =window.location.origin+'/asnc/index.php/Programacion/reprogramar_fila_acc_obra';
            var base_url = '/index.php/Programacion/Repro_modal_py_obra'; 

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    // partida_pre: partida_pre,
                    // selc_part_pres:selc_part_pres,
                    // ccnu: ccnu,
                    // sel_ccnu: sel_ccnu,
                    tipo_obra: tipo_obra,
                    camb_tipo_obra: camb_tipo_obra,
                    alcance_obra: alcance_obra,
                    camb_id_alcance_obra: camb_id_alcance_obra,
                    obj_obra: obj_obra,
                    camb_id_obj_obra: camb_id_obj_obra,
                    
                    ff: ff,
                    sel_camb_ff1: sel_camb_ff1,

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
}

//guarda un nuevo item de reprogramacion proyecto obra
function Guardar_repro_obra_proyecto(){
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_tip_obra = $("#id_tip_obra").val();
    var id_alcance_obra = $("#id_alcance_obra").val();
    var id_alcance_obra = $("#id_alcance_obra").val();
    var especificacion_acc = $("#especificacion_acc").val();
    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    var cant_total_distribuir = $("#cant_total_distribuir").val();
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
    var fecha_hasta = $("#fecha_hasta").val();
    var fecha_desde = $("#fecha_desde").val();
    var observaciones = $("#observaciones").val();
    if (observaciones == '') {
        swal.fire({
            title: 'Debe Ingresar Una Observación para continuar, por favor intente de nuevo',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("observaciones").focus();
    }

    else if ($("#par_presupuestaria_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar una Partida Presupuestaria',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe Seleccionar una Partida Presupuestaria");
        document.getElementById("par_presupuestaria_acc").focus();
        return false;
    }else if(id_estado_acc == ''){
        //alert("Debe ingresar un estado")
        swal.fire({
            title: 'Debe ingresar un estado',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("id_estado_acc").focus();
    }
    else if($("#fuente_financiamiento_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar una Fuente Financiamiento',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("fuente_financiamiento_acc").focus();
        return false;
    }else if(porcentaje_acc == ''){
        document.getElementById("porcentaje_acc").focus();
    }else if($("#id_tip_obra option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un Tipo de obra',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("id_tip_obra").focus();
        return false;
    }else if($("#id_alcance_obra option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un Alcance de Obra',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("id_alcance_obra").focus();
        return false;
    }else if($("#id_obj_obra option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un Objeto de Obra',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        // alert("Debe Seleccionar una Fuente Financiamiento");
        document.getElementById("id_obj_obra").focus();
        return false;
    }
    else if(cant_total_distribuir > '1'){
        swal.fire({
            title: 'El porcentaje a Distribuir debe ser igual a cero (obligatotio) (Debe ingresar la distribución porcentual en los campos de trimestres I,II,III,IV segun su programación)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("cant_total_distribuir").focus();
    } else if(especificacion_acc == ''){
        swal.fire({
            title: 'Debe ingresar una especificación',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe ingresar una especificación")

        document.getElementById("especificacion_acc").focus();
    }else if($("#id_unidad_medida_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar una unidad de medida',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //  alert("Debe Seleccionar una unidad de medida");
        document.getElementById("id_unidad_medida_acc").focus();
        return false;
    } else if(precio_total == ''){
        // alert("Debe ingresar Un precio (Obligatorio)")
        swal.fire({
         title: 'Debe ingresar un precio (Obligatorio)',
         type: 'warning',
         showCancelButton: false,
         confirmButtonColor: '#3085d6',
         confirmButtonText: 'Ok'
     }).then((result) => {
         if (result.value == true) {
         }
     });
         document.getElementById("precio_total").focus();
     }else if(fecha_hasta === ""){
        swal.fire({
            title: 'Debe ingresar un fecha hasta (Obligatorio)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("fecha_hasta").focus();
     } else if(fecha_desde === ""){
        swal.fire({
            title: 'Debe ingresar un fecha desde (Obligatorio)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("fecha_desde").focus();
     }else if($("#id_alicuota_iva option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un iva correspondiente (Obligatorio)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe Seleccionar un iva ");
        document.getElementById("id_alicuota_iva").focus();
        return false;
    }
    else{
        event.preventDefault();
        swal.fire({
            title: '¿Guardar Modificación?',
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
                //var base_url =window.location.origin+'/asnc/index.php/Programacion/Repro_py_obra';
                var base_url = '/index.php/Programacion/Repro_py_obra';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Registro Exitoso',
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
/////////////////////reprogramo servivios proyestos
//guarda un nuevo item de reprogramacion proyecto servicio
function Guardar_repro_servicio_proyectos(){
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    
    var especificacion_acc = $("#especificacion_acc").val();
    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    var cantidad_acc = $("#cant_total_distribuir").val();
    var I = $("#I").val();
    var II = $("#II").val();
    var III = $("#III").val();
    var IV = $("#IV").val();
    var costo_unitario_acc = $("#costo_unitario_acc").val();
    var precio_total_acc = $("#precio_total_acc").val();
    var id_alicuota_iva_acc = $("#id_alicuota_iva_acc").val();
    var iva_estimado_acc = $("#iva_estimado_acc").val();
    var monto_estimado_acc = $("#monto_estimado_acc").val();
    var estimado_i_acc = $("#estimado_i_acc").val();
    var estimado_ii_acc = $("#estimado_ii_acc").val();
    var estimado_iii_acc = $("#estimado_iii_acc").val();
    var estimado_iV_acc = $("#estimado_iV_acc").val();
    var estimado_total_t_acc = $("#estimado_total_t_acc").val();


    if (par_presupuestaria_acc == '') {
        document.getElementById("par_presupuestaria_acc").focus();
    }else if(id_estado_acc == ''){
        document.getElementById("id_estado_acc").focus();
    }
    else if(fuente_financiamiento_acc == ''){
    document.getElementById("fuente_financiamiento_acc").focus();
    }else if(porcentaje_acc == ''){
        document.getElementById("porcentaje_acc").focus();
    }else if(porcentaje_acc == ''){
            document.getElementById("porcentaje_acc").focus();
    }else if(especificacion_acc == ''){
        document.getElementById("especificacion_acc").focus();
    }else{
        event.preventDefault();
        swal.fire({
            title: '¿Guardar Modificación?',
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
                //var base_url =window.location.origin+'/asnc/index.php/Programacion/Repro_py_servicio';
                var base_url = '/index.php/Programacion/Repro_py_servicio';
                $.ajax({
                    url:base_url,
                    method: 'POST',
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: 'Registro Exitoso',
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
/////////////Guardar reprograma modal proyecto-servicio
function guardar_reprogramacion_servi_py(){//////////////////////////////////////////accion central
    event.preventDefault();

    swal.fire({
        title: '¿Seguro desea Modificar? ',
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
            var base_url = '/index.php/Programacion/Repro_modal_py_servicios'; 

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
function calculo_servi(){

    var cantidad = 100;
    var i = $('#primero_b').val();
    var ii = $('#segundo_b').val();
    var iii = $('#tercero_b').val();
    var iv = $('#cuarto_b').val();

    var cantidad_total = Number(i) + Number(ii) + Number(iii) + Number(iv)

    var can_x_distr =   cantidad - i - ii - iii - iv
    $('#cant_total_distribuir1').val(can_x_distr);

    if (cantidad_total > 100) {
        swal({
            title: "¡ATENCION!",
            text: "La cantidad a distribuir no puede ser mayor a 100! Por favor modifique para seguir con la carga.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#precio_total_mod_b1").prop('disabled', true);
        $("#ali_iva_e_b").prop('disabled', true);
    }else{
        $("#precio_total_mod_b1").prop('disabled', false);
        $("#ali_iva_e_b").prop('disabled', false);
        //Calculo Cantidad x DIstribuir
            var can_x_distr =   cantidad - i - ii - iii - iv
            $('#cant_total_distribuir').val(can_x_distr);


        var id_alicuota_iva1 = $('#ali_iva_e_b').val();

        var sel_id_alic_iva_b = $('#sel_id_alic_iva_b1').val();

        if (sel_id_alic_iva_b == 's') {
            var id_al_iva = id_alicuota_iva1
        }else {
            var id_al_iva = sel_id_alic_iva_b
        }
        //console.log(id_alicuota_iva1);
        //Remplazar decimales para caculos
            var precio_total = $('#precio_total_mod_b1').val();
            var newstr = precio_total.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

        //calculo de Iva Estimado
            var id_alicuota_iva = $('#ali_iva_e_b').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = precio*id_al_iva;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado_mod_b1').val(iva_estimado2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#monto_estimado_mod_b1').val(monto_total_estimado);

        //Calculo estimado por Trimestre

            var primer = (monto_total_est/cantidad_total)*i;
            var primer_i = parseFloat(primer).toFixed(2);
            var i_trim  = Intl.NumberFormat("de-DE").format(primer_i);
            $('#estimado_primer').val(i_trim);


            var segun = (monto_total_est/cantidad_total)*ii;
            var segun_ii = parseFloat(segun).toFixed(2);
            var ii_trim  = Intl.NumberFormat("de-DE").format(segun_ii);
            $('#estimado_segundo').val(ii_trim);

            var tercer = (monto_total_est/cantidad_total)*iii;
            var tercer_iii = parseFloat(tercer).toFixed(2);
            var iii_trim  = Intl.NumberFormat("de-DE").format(tercer_iii);
            $('#estimado_tercer').val(iii_trim);

            var cuarto = (monto_total_est/cantidad_total)*iv;
            var cuarto_iv = parseFloat(cuarto).toFixed(2);
            var iv_trim  = Intl.NumberFormat("de-DE").format(cuarto_iv);
            $('#estimado_cuarto').val(iv_trim);

        // Calculo total estimado trimestres
            var total_est = primer+segun+tercer+cuarto
            var total_estim = parseFloat(total_est).toFixed(2);
            var estimado_total_t  = Intl.NumberFormat("de-DE").format(total_estim);
            $('#estimado_total_t_mod').val(estimado_total_t);
    }
}