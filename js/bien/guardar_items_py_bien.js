
/// agregar items bienes proyecto

function guardar_py_bien(){
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_ccnu_acc = $("#id_ccnu_acc").val();
    var especificacion_acc = $("#especificacion_acc").val();
    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    var cantidad_acc = $("#cantidad_acc").val();
    var I_acc = $("#I_acc").val();
    var II_acc = $("#II_acc").val();
    var III_acc = $("#III_acc").val();
    var IV_acc = $("#IV_acc").val();
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
    // }else if(porcentaje_acc == ''){
    //     document.getElementById("porcentaje_acc").focus();
    // 

    }else if(id_ccnu_acc == ''){
        document.getElementById("id_ccnu_acc").focus();
    }else if(especificacion_acc == ''){
        document.getElementById("especificacion_acc").focus();
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
               // var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_mas_item_bienes_py';
                var base_url = '/index.php/Programacion/Guardar_mas_item_bienes_py';
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


/// agregar reprogramacion items bienes proyecto

function guardar_py_reprogramabien(){
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_ccnu_acc = $("#id_ccnu_acc").val();
    var especificacion_acc = $("#especificacion_acc").val();
    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    var cantidad_acc = $("#cantidad_acc").val();
    var I_acc = $("#I_acc").val();
    var II_acc = $("#II_acc").val();
    var III_acc = $("#III_acc").val();
    var IV_acc = $("#IV_acc").val();
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
                //var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_reprogramacion_item_bienes_py';
                var base_url = '/index.php/Programacion/Guardar_reprogramacion_item_bienes_py';
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

$("#porcentaje_acc").on({
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