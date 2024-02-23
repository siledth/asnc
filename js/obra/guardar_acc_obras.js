/// MAS ITEMS Obra  accion centralizada

function guardar_acc_servicio(){
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_tip_obra = $("#id_tip_obra").val();
    var id_alcance_obra = $("#id_alcance_obra").val();
    var id_alcance_obra = $("#id_alcance_obra").val();
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


    if ($("#par_presupuestaria_acc option:selected").val() == 0) {
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
    else if ($("#id_tip_obra option:selected").val() == 0) {
        alert("Debe Seleccionar un Tipo de obra");
        document.getElementById("id_tip_obra").focus();
        return false;
    
    }
    else if ($("#id_alcance_obra option:selected").val() == 0) {
        alert("Debe Seleccionar un Alcance de Obra");
        document.getElementById("id_alcance_obra").focus();
        return false;
    
    }else if ($("#id_obj_obra option:selected").val() == 0) {
        alert("Debe Seleccionar un Objeto de Obra");
        document.getElementById("id_obj_obra").focus();
        return false;
    
    }else if(precio_total == ''){
        alert("Debe ingresar Un precio (Obligatorio)")
        document.getElementById("precio_total").focus();
    }
     else if($("#id_alicuota_iva option:selected").val() == 0) {
        alert("Debe Seleccionar un iva ");
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
                //var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_mas_item_acc_obra';
                var base_url = '/index.php/Programacion/Guardar_mas_item_acc_obra';
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