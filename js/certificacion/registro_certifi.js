$(document).ready(function() {
    //para consultar y crear el numero de nro_comprobante
    //   var base_url =   window.location.origin + "/asnc/index.php/Certificacion/nro_comprobante";
   var base_url = '/index.php/Certificacion/nro_comprobante';
    $.ajax({
        url: base_url,
        method: "post",
        dataType: "json",

        success: function(response) {
            if (response === null) {
                numero = "1";
            } else {
                numero_c = response["id_comprobante"];
                numero = Number(numero_c) + 1;
                
            }

            function zeroFill(number, width) {
                width -= number.toString().length;
                if (width > 0) {
                    return (
                        new Array(width + (/\./.test(number) ? 2 : 1)).join("0") + number
                    );
                }
                return  number + ""; // siempre devuelve tipo cadena
            }
            
             $("#nro_comprobante").val(zeroFill(numero, 20));
             
             var ret = $('#nro_comprobante').val();
            var pj="PJ-";
            var joined = pj + ret;
            
            $('#nro_comprobantes').val(joined);
            
            //console.log(zeroFill(numero, 5));
        },
    });
});










function guardar_registro(){
    event.preventDefault();
    swal.fire({
        title: '¿Registrar?',
        text: '¿Esta seguro de Registrar ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {

        if (document.reg_bien.objetivo.value.length==0){
            alert("No Puede dejar el campo Objetivo vacio, Ingrese un Objetivo en el menu Programa del curso o taller")
            document.reg_bien.objetivo.focus()
            return 0;
     }
     if (document.reg_bien.acepto.value.length==0){
        alert("Debe aceptar La Declaración Para Continuar con el Registro, en el menu Declaración")
        document.reg_bien.acepto.focus()
        return 0;
 }
 if (document.reg_bien.n_ref.value.length==0){
    alert("No Puede dejar el campo referencia bancaria vacio, Ingrese un dato")
    document.reg_bien.n_ref.focus()
    return 0;
}
 if (document.reg_bien.fecha_trans.value.length==0){
    alert("No Puede dejar el campo fecha de trasferencia vacio, Ingrese una fecha de trasferencia")
    document.reg_bien.fecha_trans.focus()
    return 0;
    }
if (document.reg_bien.monto_trans.value.length==0){
    alert("No Puede dejar el campo Monto de trasferencia vacio")
    document.reg_bien.monto_trans.focus()
    return 0;
}
//  if (document.reg_bien.ubicacion.value.length==0){
//     alert("No Puede dejar el campo ubicacion vacio, Ingrese una ubicacion")
//     document.reg_bien.ubicacion.focus()
//     return 0;
// }
// if (document.reg_bien.pies.value.length==0){
//     alert("No Puede dejar el campo Pie vacio, Ingrese un Pie")
//     document.reg_bien.pies.focus()
//     return 0;
// }
// if (document.reg_bien.canon.value.length==0){
//     alert("No Puede dejar el campo canon vacio, Ingrese un canon")
//     document.reg_bien.canon.focus()
//     return 0;
// }
// if (document.reg_bien.fecha_pago.value.length==0){
//     alert("No Puede dejar el campo  fecha Pago, Ingrese un fecha Pago")
//     document.reg_bien.fecha_pago.focus()
//     return 0;
// }


        if (result.value == true) {

            event.preventDefault();
            var datos = new FormData($("#reg_bien")[0]);
           var base_url  = window.location.origin+'/asnc/index.php/Certificacion/registrar_certificacion';
            // var base_url = '/index.php/Certificacion/registrar_certificacion';
            $.ajax({
                url:base_url,
                method: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == 'true') {
                        swal.fire({
                            title: 'Registro Exitoso, En espera Aprobación por Parte del SNC',
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

function guardar_registro2(){
    event.preventDefault();
    swal.fire({
        title: '¿Registrar?',
        text: '¿Esta seguro de Registrar ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {

        if (document.reg_bien.objetivo.value.length==0){
            alert("No Puede dejar el campo Objetivo vacio, Ingrese un Objetivo en el menu Programa del curso o taller")
            document.reg_bien.objetivo.focus()
            return 0;
     }
     if (document.reg_bien.acepto.value.length==0){
        alert("Debe aceptar La Declaración Para Continuar con el Registro, en el menu Declaración")
        document.reg_bien.acepto.focus()
        return 0;
 }
 
//  if (document.reg_bien.ubicacion.value.length==0){
//     alert("No Puede dejar el campo ubicacion vacio, Ingrese una ubicacion")
//     document.reg_bien.ubicacion.focus()
//     return 0;
// }
// if (document.reg_bien.pies.value.length==0){
//     alert("No Puede dejar el campo Pie vacio, Ingrese un Pie")
//     document.reg_bien.pies.focus()
//     return 0;
// }
// if (document.reg_bien.canon.value.length==0){
//     alert("No Puede dejar el campo canon vacio, Ingrese un canon")
//     document.reg_bien.canon.focus()
//     return 0;
// }
// if (document.reg_bien.fecha_pago.value.length==0){
//     alert("No Puede dejar el campo  fecha Pago, Ingrese un fecha Pago")
//     document.reg_bien.fecha_pago.focus()
//     return 0;
// }


        if (result.value == true) {

            event.preventDefault();
            var datos = new FormData($("#reg_bien")[0]);
        //    var base_url  = window.location.origin+'/asnc/index.php/Certificacion/registrar_certificacion2';
        //        var base_url_2 = window.location.origin + "/asnc/index.php/Certificacion/Listado_certificacion_interno_contralodira";

            var base_url = '/index.php/Certificacion/registrar_certificacion2';
            var base_url_2 = '/index.php/Certificacion/Listado_certificacion_interno_contralodira';

            $.ajax({
                url:base_url,
                method: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == 'true') {
                        swal.fire({
                            title: 'Registro Exitoso, por favor para continuar ingrese sus facilitadores ',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                window.location.href = base_url_2;
                            }
                        });
                    }
                }
            })
        }
    });
}

function registrar_facilitadoresjs(){
		var cedula = $("#cedula").val();
		var nombre_ape = $("#nombre_ape").val();

		if (cedula == '') {
			document.getElementById("cedula").focus();
		}else if(nombre_ape == ''){
			document.getElementById("nombre_ape").focus();
		}else {
			event.preventDefault();
			swal.fire({
				title: '¿Registrar?',
				text: '¿Esta seguro de Guardar?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: '¡Si, guardar!'
			}).then((result) => {
				if (result.value == true) {
					event.preventDefault();
					var datos = new FormData($("#guardar_ba")[0]);
					// var base_url =window.location.origin+'/asnc/index.php/Certificacion/registrar_facilitadoresjs';
					var base_url = '/index.php/Certificacion/registrar_facilitadoresjs';
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

   function modal(id_miembro_natu, cedula, nro_comprobante) {
    $('#id_miembros_natu').val(id_miembro_natu); // This refers to the 'id' from infor_per_natu
    $('#cedula_modal').val(cedula);
    $('#nro_comprobante_modal').val(nro_comprobante);

    // If your existing 'id' input is actually for 'id_comision', keep it as is
    // If it's meant to be the 'id' of the current row from infor_per_natu, then uncomment/adjust:
    // $('#id').val(id_miembro_natu); // Be careful with ID conflicts
}

function save_inf_ac() {
    event.preventDefault();

    swal.fire({
        title: '¿Guardar',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si!'
    }).then((result) => {
        if (result.value == true) {
            // Retrieve values from hidden fields
            var id_miembros_natu = $('#id_miembros_natu').val(); // This is the 'id' from infor_per_natu
            var cedula = $('#cedula_modal').val();
            var nro_comprobante = $('#nro_comprobante_modal').val();

            // The 'id_comision' you are using seems to come from the URL.
            // If it's a fixed value for the entire page, ensure it's correct.
            // Based on your controller `miemb2`, `id_comision` comes from `GET`.
            // So, make sure `id_comision_input_hidden` correctly holds that.
            var id_comision = $('#id_comision_input_hidden').val();

            var fm_ac = $('#fm_ac').val();
            var titulo = $('#titulo').val();
            var anioi = $('#anioi').val();
            var anioc = $('#anioc').val();
            var curso = $('#curso').val();

            if (titulo == '') {
                alert("el campo titulo no puede quedar vacio")
                document.getElementById("titulo").focus();
                return false;
            }
            if (anioi == '') {
                alert("el campo Año de Inicio no puede quedar vacio")
                document.getElementById("anioi").focus();
                return false;
            }

            if ($("#fm_ac option:selected").val() == 0) {
                alert("Seleccione Formación Académica"); // Changed from 'Área' for clarity
                document.getElementById("fm_ac").focus();
                return false;
            }
            if ($("#curso option:selected").val() == 0) {
                alert("Seleccione En Curso"); // Changed from 'Cursando' for clarity
                document.getElementById("curso").focus();
                return false;
            }

            // var base_url = window.location.origin + '/asnc/index.php/Certificacion/save_inff';
					var base_url = '/index.php/Certificacion/save_inff';

            $.ajax({
                url: base_url,
                method: 'post',
                data: {
                    id: id_miembros_natu, // This should be the 'id' from infor_per_natu row
                    cedula: cedula, // Pass cedula
                    nro_comprobante: nro_comprobante, // Pass nro_comprobante
                    fm_ac: fm_ac,
                    titulo: titulo,
                    anioi: anioi,
                    anioc: anioc,
                    curso: curso,
                    // 'id_comision' and 'rif_organoente' and 'id_miembros' are not being used in save_inff model right now.
                    // If you need them for future logic in save_inff, ensure they are correctly passed.
                    // Currently, save_inff only uses 'id', 'cedula', 'titulo', 'anioi', 'anioc', 'curso'
                },
                dataType: 'json',
                success: function(response) {
                    if (response == 1) {
                        swal.fire({
                            title: 'Guardado.',
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
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'Ocurrió un error, por favor vuelva a intentar.'
                    });
                }
            })
        }
    });
}