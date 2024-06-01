
/// bienes accion centralizada

function guardar_acc_bien(){
    var par_presupuestaria_acc = $("#par_presupuestaria_acc").val();
    var id_estado_acc = $("#id_estado_acc").val();
    var fuente_financiamiento_acc = $("#fuente_financiamiento_acc").val();
    var porcentaje_acc = $("#porcentaje_acc").val();
    var id_ccnu_acc = $("#id_ccnu_acc").val();
    var especificacion_acc = $("#especificacion_acc").val();
    var id_unidad_medida_acc = $("#id_unidad_medida_acc").val();
    var cantidad_acc = $("#cantidad_acc").val();
    var cant_total_distribuir_acc = $("#cant_total_distribuir_acc").val();

    var I_acc = $("#I_acc").val();
    var II_acc = $("#II_acc").val();
    var III_acc = $("#III_acc").val();
    var IV_acc = $("#IV_acc").val();
    var costo_unitario_acc1 = $("#costo_unitario_acc").val();
    var precio_total_acc = $("#precio_total_acc").val();
    var id_alicuota_iva_acc = $("#id_alicuota_iva_acc").val();
    var iva_estimado_acc = $("#iva_estimado_acc").val();
    var monto_estimado_acc = $("#monto_estimado_acc").val();
    var estimado_i_acc = $("#estimado_i_acc").val();
    var estimado_ii_acc = $("#estimado_ii_acc").val();
    var estimado_iii_acc = $("#estimado_iii_acc").val();
    var estimado_iV_acc = $("#estimado_iV_acc").val();
    var estimado_total_t_acc = $("#estimado_total_t_acc").val();
    var newstr6 = costo_unitario_acc1.replace(".", "");
    var newstr7 = newstr6.replace(".", "");
    var newstr8 = newstr7.replace(".", "");
    var newstr9 = newstr8.replace(".", "");
    var costo_unitario_acc = newstr9.replace(",", ".");

    //console.log(costo_unitario_acc);

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
        document.getElementById("par_presupuestaria_acc").focus();
      
    }
    else if(id_estado_acc == ''){
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
        // alert("Debe ingresar un estado")
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
    }else if($("#id_ccnu_acc option:selected").val() == 0) {
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
       // alert("Debe Seleccionar un CCNU");
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
       // alert("Debe Seleccionar una unidad de medida");
        document.getElementById("id_unidad_medida_acc").focus();
        return false;
    }
    else if(cantidad_acc == ''){
        swal.fire({
            title: 'Debe ingresar una Cantidad (obligatotio)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("Debe ingresar una Cantidad (obligatotio)")
        document.getElementById("cantidad_acc").focus();
    }
  
    else if(cant_total_distribuir_acc > '1'){
        //alert("la cantidad a Distribuir debe ser igual a cero (obligatotio) (Debe distribuir la cantidad ingresada en los campos de trimestres I,II,III,IV segun su programación)")
        swal.fire({
            title: 'la cantidad a Distribuir debe ser igual a cero (obligatotio) (Debe distribuir la cantidad ingresada en los campos de trimestres I,II,III,IV segun su programación)',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("cant_total_distribuir_acc").focus();
    }
    else if(costo_unitario_acc == ''){
       // alert("Debe ingresar un Costo Unitario (Obligatorio)")
       swal.fire({
        title: 'Debe ingresar un Costo Unitario (Obligatorio)',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
        document.getElementById("costo_unitario_acc").focus();
    }
    else if (isNaN(costo_unitario_acc)) {
        // Mostrar mensaje de error
        swal.fire({
            title: 'En Costo Unitario debe ingresar un número (Obligatorio) , por favor revisar.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        document.getElementById("costo_unitario_acc").focus();
    }
     else if($("#id_alicuota_iva_acc option:selected").val() == 0) {
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
        document.getElementById("id_alicuota_iva_acc").focus();
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
                //var base_url =window.location.origin+'/asnc/index.php/Programacion/Guardar_mas_item_acc';
                var base_url = '/index.php/Programacion/Guardar_mas_item_acc';
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

//se actualizo
