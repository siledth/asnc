function modal(id){
    $('#id').val(id);
}

function mostrar_medio(){
    var medio = $('#medio').val();
    if (medio == '1' || medio == '4') {
        $("#adjunto").show();
        $("#resp_medi").hide();
        $("#correo").hide();
    }else if (medio == '2') {
        $("#correo").hide();
        $("#resp_medi").show();
        $("#adjunto").hide();
    }else if (medio == '3') {
        $("#correo").show();
        $("#resp_medi").hide();
        $("#adjunto").hide();
    }else {
        $("#correo").hide();
        $("#resp_medi").hide();
        $("#adjunto").hide();
    }
}
function modal(id){
    var id = id;
    // var base_url = window.location.origin+'/asnc/index.php/Evaluacion_desempenio/consulta_2';
    var base_url = '/index.php/Evaluacion_desempenio/consulta_2';
    $.ajax({
        url: base_url,
        method:'post',
        data: {id: id},
        dataType:'json',

        success: function(response){
            $('#id').val(response['id']);
            
        }
    });
}
function guardar_not(){
    var id = $("#id").val();
	var fecha_not       = $("#fecha_not").val();
    var medio           = $("#medio").val();
    var nro_oc_os       = $("#nro_oc_os").val();
    var fileImagen      = $("#fileImagen").val();
		
        if (fileImagen ==0) {
            alert("Acuse de Recibido Obligatorio");
            return false;
        }
        var fileSize = $('#fileImagen')[0].files[0].size;
        var siezekiloByte = parseInt(fileSize / 1024);
        var maxSize = parseInt($('#fileImagen').data('size'));
    
        if (siezekiloByte > maxSize) {
            alert("Tamaño del archivo es máximo de 1 megabyte (MB), Intente de Nuevo");
           //$("#registrar_eval").prop('disabled', true)
            return false;
        }
       
        var tipo = fileImagen.split(".")[1];

		if (medio == '') {
			document.getElementById("medio").focus();
		}else if(nro_oc_os == ''){
			document.getElementById("nro_oc_os").focus();
		}
		else if (fecha_not == '') {
            document.getElementById("fecha_not").focus();
        }else if (fileImagen == '') {
            document.getElementById("fileImagen").focus();
        }else if (tipo != 'pdf' && tipo != 'jpg' && tipo != 'img'&& tipo != 'png' && tipo != 'jpeg') {
            swal("Mensaje de alerta!", "El tipo de archivo debe ser en formato pdf, jpg, png, img, jpeg")
            document.getElementById("fileImagen").focus();
        }else {
            
			event.preventDefault();
			swal.fire({
				title: 'Guardar Notificación?',
				text: '¿Esta seguro de guardar esta notificación?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: '¡Si, guardar!'
			}).then((result) => {
				if (result.value == true) {
					event.preventDefault();
					var datos = new FormData($("#resgistrar_not_2")[0]);
					// var base_urls =window.location.origin+'/asnc/index.php/evaluacion_desempenio/resgistrar_asnc';
					var base_urls = '/index.php/Evaluacion_desempenio/resgistrar_asnc';
                    /// var base_url_3 = window.location.origin + "/asnc/index.php/Evaluacion_desempenio/ver_evaluacion?id="; 
                    var base_url_3 = '/index.php/Evaluacion_desempenio/ver_evaluacion?id=';
                $.ajax({
                    url: base_urls,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        var menj = 'Identificador de Evaluación de Desempeño:';

                        if (response != '') {
                            swal.fire({
                                title: 'Norificación  Registrada',
                                text: menj + response,
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value == true) {
                                    window.location.href = base_url_3 + response;
                                }
                            });
                        }
                    },
                })
				}
			});
		}
}




