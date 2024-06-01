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
/// MAS ITEMS SERVICIO  proyecto

function guardar_acc_servicio(){
    
    var id_programacion3 = $("#id_programacion2").val();
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    //var porcentaje_acc = $("#porcentaje_acc").val();
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
    var id_alicuota_iva = $("#id_alicuota_iva").val();
    var iva_estimado_acc = $("#iva_estimado_acc").val();
    var monto_estimado_acc = $("#monto_estimado_acc").val();
    var estimado_i_acc = $("#estimado_i_acc").val();
    var estimado_ii_acc = $("#estimado_ii_acc").val();
    var estimado_iii_acc = $("#estimado_iii_acc").val();
    var estimado_iV_acc = $("#estimado_iV_acc").val();
    var estimado_total_t_acc = $("#estimado_total_t_acc").val();
    var cant_total_distribuir = $("#cant_total_distribuir").val();
    var fecha_hasta = $("#fecha_hasta").val();
    var fecha_desde = $("#fecha_desde").val();

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
    // else if(cant_total_distribuir_acc >= '1'){
    //     alert("la cantidad restante a Distribuir debe ser igual a cero (obligatotio)")
    //     document.getElementById("cant_total_distribuir_acc").focus();
    // }
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
                //var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_mas_item_py_servicio';
                var base_url = '/index.php/Programacion/Guardar_mas_item_py_servicio';
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
    var iva_estimado_acc = $("#iva_estimado").val();
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
                var base_url = '/index.php/Programacion/Guardar_mas_item_acc_servicio';
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