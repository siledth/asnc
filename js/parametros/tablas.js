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

//CRUD BANCO
	//GUARDAR BANCO
	function guardar_b(){
		//var codigo_b = $("#codigo_b").val();
		var nombre_b = $("#nombre_b").val();

		if (nombre_b == '') {
			document.getElementById("nombre_b").focus();
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
					//var base_url =window.location.origin+'/asnc/index.php/Certificaciones/registrar_b';
					var base_url = '/index.php/Tablas_com/registrar_b';
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
	//BUSCAR BANCO PARA EDITAR
	function modal_ver(id){
		var id_academico = id;
		//var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b';
		var base_url = '/index.php/Tablas_com/consulta_b';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_academico: id_academico},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_academico']);
				//$('#cod_banco_edit').val(response['codigopartida_presupuestaria']);
				$('#nombre_banco_edit').val(response['desc_academico']);
			}
		});
	}
	//EDITAR BANCO
	function editar_b(){
		var id_banco = $("#id").val();
		//var codigo_b = $("#cod_banco_edit").val();
		var nombre_b = $("#nombre_banco_edit").val();

		var datos = new FormData($("#editar")[0]);
		if (nombre_b == '') {
			document.getElementById("nombre_b").focus();
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
					var datos = new FormData($("#editar")[0]);
					//var base_urls =window.location.origin+'/asnc/index.php/Certificaciones/editar_b';
					var base_urls = '/index.php/Tablas_com/editar_b';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_banco: id_banco,
							//codigo_b: codigo_b,
							nombre_b: nombre_b
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

    function guardar_acto(){
		//var codigo_b = $("#codigo_b").val();
		var nombre_b = $("#nombre_b").val();

		if (nombre_b == '') {
			document.getElementById("nombre_b").focus();
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
					//var base_url =window.location.origin+'/asnc/index.php/Certificaciones/registrar_b';
					var base_url = '/index.php/Tablas_com/registrar_actoadmin';
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
	//BUSCAR BANCO PARA EDITAR
	function modal_veracto(id){
		var id_acto_admin = id;
		//var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b';
		var base_url = '/index.php/Tablas_com/consulta_actoadmin';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_acto_admin: id_acto_admin},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_acto_admin']);
				//$('#cod_banco_edit').val(response['codigopartida_presupuestaria']);
				$('#nombre_banco_edit').val(response['desc_acto_admin']);
			}
		});
	}
	//EDITAR BANCO
	function editar_acto(){
		var id_banco = $("#id").val();
		//var codigo_b = $("#cod_banco_edit").val();
		var nombre_b = $("#nombre_banco_edit").val();

		var datos = new FormData($("#editar")[0]);
		if (nombre_b == '') {
			document.getElementById("nombre_b").focus();
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
					var datos = new FormData($("#editar")[0]);
					//var base_urls =window.location.origin+'/asnc/index.php/Certificaciones/editar_b';
					var base_urls = '/index.php/Tablas_com/editar_actoadmin';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_banco: id_banco,
							//codigo_b: codigo_b,
							nombre_b: nombre_b
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
    ////////////////////////////////////////////////////////////////
     function guardar_area(){
		//var codigo_b = $("#codigo_b").val();
		var nombre_b = $("#nombre_b").val();

		if (nombre_b == '') {
			document.getElementById("nombre_b").focus();
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
					//var base_url =window.location.origin+'/asnc/index.php/Certificaciones/registrar_b';
					var base_url = '/index.php/Tablas_com/registrar_area_mb';
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
	//BUSCAR BANCO PARA EDITAR
	function modal_area(id){
		var id_area_miembro = id;
		//var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b';
		var base_url = '/index.php/Tablas_com/consulta_area_mb';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_area_miembro: id_area_miembro},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_area_miembro']);
				//$('#cod_banco_edit').val(response['codigopartida_presupuestaria']);
				$('#nombre_banco_edit').val(response['desc_area_miembro']);
			}
		});
	}
	//EDITAR BANCO
	function editar_area(){
		var id_banco = $("#id").val();
		//var codigo_b = $("#cod_banco_edit").val();
		var nombre_b = $("#nombre_banco_edit").val();

		var datos = new FormData($("#editar")[0]);
		if (nombre_b == '') {
			document.getElementById("nombre_b").focus();
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
					var datos = new FormData($("#editar")[0]);
					//var base_urls =window.location.origin+'/asnc/index.php/Certificaciones/editar_b';
					var base_urls = '/index.php/Tablas_com/editar_area_mb';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_banco: id_banco,
							//codigo_b: codigo_b,
							nombre_b: nombre_b
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

    //////////////////////////////////////////////////
    function guardar_estatus_mb(){
		//var codigo_b = $("#codigo_b").val();
		var nombre_b = $("#nombre_b").val();

		if (nombre_b == '') {
			document.getElementById("nombre_b").focus();
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
					//var base_url =window.location.origin+'/asnc/index.php/Certificaciones/registrar_b';
					var base_url = '/index.php/Tablas_com/registrar_estatus_mb';
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
	//BUSCAR BANCO PARA EDITAR
	function modal_estatus_mb(id){
		var id_status_miembro = id;
		//var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b';
		var base_url = '/index.php/Tablas_com/consulta_estatus_mb';
		$.ajax({
			url: base_url,
			method:'post',
			data: {id_status_miembro: id_status_miembro},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_status_miembro']);
				//$('#cod_banco_edit').val(response['codigopartida_presupuestaria']);
				$('#nombre_banco_edit').val(response['desc_status_miembro']);
			}
		});
	}
	//EDITAR BANCO
	function editar_estatus_mb(){
		var id_banco = $("#id").val();
		//var codigo_b = $("#cod_banco_edit").val();
		var nombre_b = $("#nombre_banco_edit").val();

		var datos = new FormData($("#editar")[0]);
		if (nombre_b == '') {
			document.getElementById("nombre_b").focus();
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
					var datos = new FormData($("#editar")[0]);
					//var base_urls =window.location.origin+'/asnc/index.php/Certificaciones/editar_b';
					var base_urls = '/index.php/Tablas_com/editar_estatus_mb';
					$.ajax({
						url: base_urls,
						method:'post',
						data: {id_banco: id_banco,
							//codigo_b: codigo_b,
							nombre_b: nombre_b
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