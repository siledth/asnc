function buscar_ccnnua(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var ccnu_b = $('#ccnu_b').val();
//esto llena ccnu de cargar nuevos items bienes
    // var base_url =window.location.origin+'/asnc/index.php/Programacion/llenar_selc_ccnu_m';
  //  var base_url = '/index.php/Programacion/llenar_selc_ccnu_m';
    $.ajax({
        url:BASE_URL + 'index.php/Programacion/llenar_selc_ccnu_m',
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
/// MAS ITEMS SERVICIO  accion centralizada

function guardar_acc_servicio(){
    
    var id_programacion3 = $("#id_programacion2").val();
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_ccnu_acc = $("#id_ccnu_acc").val();
    var especificacion_acc = $("#especificacion_acc").val();
    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    var cant_total_distribuir = $("#cant_total_distribuir").val();
    var precio_total = $("#precio_total").val();
    var fecha_hasta = $("#fecha_hasta").val();
    var fecha_desde = $("#fecha_desde").val();
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
    else if(porcentaje_acc == ''){
        alert("el campo porcentaje no puede quedar vacio")

        document.getElementById("porcentaje_acc").focus();
    }
    else if($("#id_ccnu_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un CCNU',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe Seleccionar un CCNU");
        document.getElementById("id_ccnu_acc").focus();
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
    // else if(cant_total_distribuir ='0'){
    //     //alert("la cantidad a Distribuir debe ser igual a cero (obligatotio) (Debe distribuir la cantidad ingresada en los campos de trimestres I,II,III,IV segun su programación)")
    //     swal.fire({
    //         title: 'la cantidad a Distribuir debe ser igual a cero (obligatotio) (Debe realizar la distribuciòn de ejecución en los campos de trimestres I,II,III,IV segun su programación)',
    //         type: 'warning',
    //         showCancelButton: false,
    //         confirmButtonColor: '#3085d6',
    //         confirmButtonText: 'Ok'
    //     }).then((result) => {
    //         if (result.value == true) {
    //         }
    //     });
    //     document.getElementById("cant_total_distribuir").focus();
    // }
    else if(cant_total_distribuir > '1'){
        swal.fire({
            title: 'El porcentaje a distribuir debe ser igual a cero (obligatotio) (Debe ingresar la distribución porcentual en los campos de trimestres I,II,III,IV según su    programación)',
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
            title: '¿Guardar Nueva Infomación?',
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
                //var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_mas_item_acc_servicio';
                var base_url = '/index.php/Programacion/Guardar_mas_item_acc_servicio';
                $.ajax({
                    url:BASE_URL + 'index.php/Programacion/Guardar_mas_item_acc_servicio',
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
       // alert("Debe ingresar una observación de la reprogramación")
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
    else if($("#id_ccnu_acc option:selected").val() == 0) {
        swal.fire({
            title: 'Debe Seleccionar un CCNU',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe Seleccionar un CCNU");
        document.getElementById("id_ccnu_acc").focus();
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
     else if(cant_total_distribuir > '1'){
        swal.fire({
            title: 'El porcentaje a distribuir debe ser igual a cero (obligatotio) (Debe ingresar la distribución porcentual en los campos de trimestres I,II,III,IV según su    programación)',
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
    }    else{
        event.preventDefault();
        swal.fire({
            title: '¿Guardar Nueva Infomación Modificación.?',
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
                // var base_url = '/index.php/Programacion/Guardar_mas_item_acc_servicio2';
                $.ajax({
                    url:BASE_URL + 'index.php/Programacion/Guardar_mas_item_acc_serviciov2',
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
             $("#desc_ccnu").val(data["desc_ccnu"]);
           
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


//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_unid_med: id_unid_med},
    dataType: 'json',
    success: function(data){
       // console.log(data);
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
}$("#precio_total_mod_b1").on({
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

function guardar_tabla_serv_acc(){//////////////////////////////////////////accion central
        var observaciones2 = $("#precio_total_mod_b1").val();
        
        var precio = $("#precio_total_mod_b1").val();
         
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
        
        
        
        else{
        
        event.preventDefault();
    
        swal.fire({
            title: '¿Seguro desea Editar Servicios? ',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, !'
        }).then((result) => {
            if (result.value == true) {
                var id_items_proy = $('#id_items_b').val();
               
                var especificacion = $('#especificacion').val();
    
                var unid_med = $('#id_unid_med_b').val();
                var sel_camb_unid_medi = $('#camb_unid_medi_b').val();
    
                var ff = $('#id_ff_b').val();
                var sel_camb_ff1 = $('#camb_ff_b1').val();
    
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
                var cantidad=1;
                var cost_uni=0;
                var observaciones = 0;
              
               // var base_url =window.location.origin+'/asnc/index.php/Programacion/reprogramar_fila_acc_obra';
                var base_url = '/index.php/Programacion/reprogramar_fila_acc_serv'; 
    
                $.ajax({
                    url:base_url,
                    method: 'post',
                    data:{
                        id_items_proy: id_items_proy,
                        // partida_pre: partida_pre,
                        // selc_part_pres:selc_part_pres,
                        // ccnu: ccnu,
                        // sel_ccnu: sel_ccnu,
                        // tipo_obra: tipo_obra,
                        // camb_tipo_obra: camb_tipo_obra,
                        // alcance_obra: alcance_obra,
                        // camb_id_alcance_obra: camb_id_alcance_obra,
                        // obj_obra: obj_obra,
                        // camb_id_obj_obra: camb_id_obj_obra,
                        fecha_desde1: fecha_desde1,
                        fecha_hasta1: fecha_hasta1,
                        especificacion: especificacion,
                        unid_med: unid_med,
                        sel_camb_unid_medi: sel_camb_unid_medi,
                        ff: ff,
                        sel_camb_ff1: sel_camb_ff1,
    
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
                        observaciones,observaciones
    
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
    }

    function guardar_tabla_serv_acc2(){//////////////////////////////////////////accion central modificacion servicio
        var observaciones2 = $("#observaciones2").val();
        
        var precio = $("#precio_total_mod_b1").val();
         
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
        else if (observaciones2 == '') {
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
           // alert("Debe ingresar una observación de la reprogramación")
            document.getElementById("observaciones2").focus();
        }
        
        
        
        else{
        
        event.preventDefault();
    
        swal.fire({
            title: '¿Seguro desea Modificar Servicios? ',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, !'
        }).then((result) => {
            if (result.value == true) {
                var id_items_proy = $('#id_items_b').val();
               
                var especificacion = $('#especificacion').val();
    
                var unid_med = $('#id_unid_med_b').val();
                var sel_camb_unid_medi = $('#camb_unid_medi_b').val();
    
                var ff = $('#id_ff_b').val();
                var sel_camb_ff1 = $('#camb_ff_b1').val();
    
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
                var cantidad=1;
                var cost_uni=0;
                var observaciones = $('#observaciones2').val();
              
               // var base_url =window.location.origin+'/asnc/index.php/Programacion/reprogramar_fila_acc_obra';
                var base_url = '/index.php/Programacion/reprogramar_fila_acc_serv'; 
    
                $.ajax({
                    url:base_url,
                    method: 'post',
                    data:{
                        id_items_proy: id_items_proy,
                        // partida_pre: partida_pre,
                        // selc_part_pres:selc_part_pres,
                        // ccnu: ccnu,
                        // sel_ccnu: sel_ccnu,
                        // tipo_obra: tipo_obra,
                        // camb_tipo_obra: camb_tipo_obra,
                        // alcance_obra: alcance_obra,
                        // camb_id_alcance_obra: camb_id_alcance_obra,
                        // obj_obra: obj_obra,
                        // camb_id_obj_obra: camb_id_obj_obra,
                        fecha_desde1: fecha_desde1,
                        fecha_hasta1: fecha_hasta1,
                        especificacion: especificacion,
                        unid_med: unid_med,
                        sel_camb_unid_medi: sel_camb_unid_medi,
                        ff: ff,
                        sel_camb_ff1: sel_camb_ff1,
    
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
                        observaciones,observaciones
    
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
    }
// function calcular_mod_bienes(){

//     //var cantidad_acc = $('#cantidad_mod_b').val();
//    // $('#cant_total_distribuir_mod_b').val(cantidad_acc);

//     var i = $('#primero_b').val();
//     var ii = $('#segundo_b').val();
//     var iii = $('#tercero_b').val();
//     var iv = $('#cuarto_b').val();
//     var cant_total_distribuir = i - ii - iii - iv

//     var cantidad2 = Number(i) + Number(ii) + Number(iii) + Number(iv)
//     $('#cant_total_distribuir1').val(cant_total_distribuir);

//     if (cant_total_distribuir < 0) {
//         swal({
//             title: "¡ATENCION!",
//             text: "La cantidad a distribuir no puede ser menor a la Cantidad estipulada! Por favor modifique para seguir con la carga.",
//             type: "warning",
//             showCancelButton: false,
//             confirmButtonColor: "#00897b",
//             confirmButtonText: "CONTINUAR",
//             closeOnConfirm: false
//         }, function(){
//             swal("Deleted!", "Your imaginary file has been deleted.", "success");
//         });

//         $("#costo_unitario_mod_b").prop('disabled', true);
//         $("#sel_id_alic_iva_b").prop('disabled', true);
//     }else{
//         $("#costo_unitario_mod_b").prop('disabled', false);
//         $("#sel_id_alic_iva_b").prop('disabled', false);
//         //Remplazar decimales para caculos
//         var costo_unitario = $('#costo_unitario_mod_b').val();
//         var newstr = costo_unitario.replace('.', "");
//         var newstr2 = newstr.replace('.', "");
//         var newstr3 = newstr2.replace('.', "");
//         var newstr4 = newstr3.replace('.', "");
//         var precio = newstr4.replace(',', ".");

//         var tota = cantidad2 * precio
//         var tota2 = parseFloat(tota).toFixed(2);
//         var precio_total_acc = Intl.NumberFormat("de-DE").format(tota2);
//         $('#precio_total_mod_b').val(precio_total_acc);

//         var id_alicuota_iva = $('#ali_iva_e_b').val();

//         var sel_id_alic_iva_b = $('#sel_id_alic_iva_b').val();

//         if (sel_id_alic_iva_b == 's') {
//             var id_al_iva = id_alicuota_iva
//         }else {
//             var id_al_iva = sel_id_alic_iva_b
//         }

//         var newstr5 = precio_total_acc.replace('.', "");
//         var newstr6 = newstr5.replace('.', "");
//         var newstr7 = newstr6.replace('.', "");
//         var newstr8 = newstr7.replace('.', "");
//         var precio_total_ac = newstr8.replace(',', ".");

//         var monto_iva_estimado = precio_total_ac*id_al_iva;
//         var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
//         var iva_estimado_acc = Intl.NumberFormat("de-DE").format(iva_estimado);
//         $('#iva_estimado_mod_b').val(iva_estimado_acc);

//         var newstr9 = iva_estimado_acc.replace('.', "");
//         var newstr10 = newstr9.replace('.', "");
//         var newstr11 = newstr10.replace('.', "");
//         var newstr12 = newstr11.replace('.', "");
//         var iva_estimado_ac = newstr12.replace(',', ".");

//         var monto_t_estimado = Number(precio_total_ac) + Number(iva_estimado_ac);
//         var monto_total_estimadoo = parseFloat(monto_t_estimado).toFixed(2);
//         var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_estimadoo);
//         $('#monto_estimado_mod_b').val(monto_total_estimado);

//         var primer =  parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(i)).toFixed(2);
//         var primer_e = parseFloat(primer).toFixed(2);
//         var estimado_i = Intl.NumberFormat("de-DE").format(primer_e);
//         $('#estimado_primer').val(estimado_i);

//         var segun = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(ii)).toFixed(2);
//         var segun_e = parseFloat(segun).toFixed(2);
//         var estimado_i = Intl.NumberFormat("de-DE").format(segun_e);
//         $('#estimado_segundo').val(estimado_i);

//         var terc = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(iii)).toFixed(2);
//         var terc_e = parseFloat(terc).toFixed(2);
//         var estimado_iii = Intl.NumberFormat("de-DE").format(terc_e);
//         $('#estimado_tercer').val(estimado_iii);

//         var cuar = parseFloat(Number(monto_t_estimado) / Number(cantidad2) * Number(iv)).toFixed(2);
//         var cuar_e = parseFloat(cuar).toFixed(2);
//         var estimado_iv = Intl.NumberFormat("de-DE").format(cuar_e);
//         $('#estimado_cuarto').val(estimado_iv);

//         var total_e = Number(primer)+Number(segun)+Number(terc)+Number(cuar)
//         var total_es = parseFloat(total_e).toFixed(2);
//         var total_est = Intl.NumberFormat("de-DE").format(total_es);
//         $('#estimado_total_t_mod').val(total_est);
//     }
// }
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