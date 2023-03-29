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

function guardar_not(){
    var id = $("#id").val();
		var fecha_not = $("#datepicker-default").val();
		var medio = $("#medio").val();
        var nro_oc_os = $("#nro_oc_os").val();

        var fileImagen = $("#fileImagen").val();


		
        if (fileImagen ==0) {
            alert("Acuse de Recibido Obligatorio");
            return false;
        }
        var fileSize = $('#fileImagen')[0].files[0].size;
        var siezekiloByte = parseInt(fileSize / 1024);
        if (siezekiloByte >  $('#fileImagen').attr('size')) {
            alert("Imagen muy grande");
            return false;
        }
       
        var tipo = fileImagen.split(".")[1];

		if (medio == '') {
			document.getElementById("medio").focus();
		}else if(nro_oc_os == ''){
			document.getElementById("nro_oc_os").focus();
		}else {
			event.preventDefault();
			swal.fire({
				title: 'Modificar?',
				text: '¿Esta seguro de Modificar este registro?',
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
					
					var base_urls = '/index.php/Evaluacion_desempenio/resgistrar_asnc';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id: id,
							fecha_not: fecha_not,
							medio: medio,
                            nro_oc_os: nro_oc_os,
                            fileImagen: fileImagen,
						},
					dataType:'json',
						success: function(response){
							if(response != '') {
								swal.fire({
									title: 'Modificación Exitosa',
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
