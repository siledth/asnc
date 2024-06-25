function inactivar(id_comision) {


    event.preventDefault();
    swal
        .fire({
            title: "¿Seguro que desea inactivar Miembro seleccionado?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, Inactivar!",
        })
        .then((result) => {
            if (result.value == true) {
                var id = id_comision;
               var base_url = '/index.php/Comision_contrata/incactiva_mb';
                   
                $.ajax({
                    url: base_url,
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response == 1) {
                            swal
                                .fire({
                                    title: "Miembro incactivo",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Ok",
                                })
                                .then((result) => {
                                    if (result.value == true) {
                                        location.reload();
                                    }
                                });
                        }
                    },error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Atenciòn',
                            type: 'error',
                            text: 'Vuelva a intentar'
                        });
                    }
                });
            }
        });
    }
    function save_miembros1(){
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
                var id_comision = $('#id_comision').val();
                var rif_organoente = $('#rif_organoente2').val();
                var tipo_comision = $('#tipo_comi').val();
                var cedula= $('#cedula').val();
                var nombre = $('#nombre').val();
                var apellido = $('#apellido').val();
                var id_area_miembro = $('#tipo_area').val();
                var id_tp_miembro = $('#tp_miembro').val();
                // var fecha_desig = $('#datedsg').val();
                // var acto_adm = $('#acto').val();
                // var num_acto = $('#nacto').val();
                // var fecha_acto = $('#facto').val();
                var correo = $('#correo').val();
                var telf = $('#telf').val();
                var obj_comision = $('#observacion1').val();
                // if ($("#tipo_comi option:selected").val() == 0) {
                //     alert("seleccione Tipo de Comisión");
                //     document.getElementById("tipo_comi").focus();
                //     return false;
                // }
                  if(cedula == ''){
                    alert("el campo cedula no puede quedar vacio")            
                    document.getElementById("cedula").focus();
                    return false;
                }
                 if(nombre == ''){
                    alert("el campo nombre no puede quedar vacio")            
                    document.getElementById("nombre").focus();
                    return false;
                }
                if(apellido == ''){
                    alert("el campo apellido no puede quedar vacio")            
                    document.getElementById("apellido").focus();
                    return false;
                }
                if ($("#tipo_area option:selected").val() == 0) {
                    alert("Seleccione Área");
                    document.getElementById("tipo_area").focus();
                    return false;
                }
                if ($("#tp_miembro option:selected").val() == 0) {
                    alert("Seleccione Tipo Integrante");
                    document.getElementById("tp_miembro").focus();
                    return false;
                }
                // if ($("#datedsg").val() === "") {
                //     alert("debe ingresar Fecha de Designación .");
                //     event.preventDefault();
                //   }
                //   if ($("#acto").val() === "") {
                //     alert("debe ingresar Acto Administrativo de Designación .");
                //     event.preventDefault();
                //   }
                //   if ($("#nacto").val() === "") {
                //     alert("debe ingresar Número Acto .");
                //     event.preventDefault();
                //   }
                //   if ($("#facto").val() === "") {
                //     alert("debe ingresar Fecha Acto .");
                //     event.preventDefault();
                //   }
                  if ($("#correo").val() === "") {
                    alert("debe ingresar Dirección de Correo Electrónico .");
                    event.preventDefault();
                  }
                  if ($("#telf").val() === "") {
                    alert("debe ingresar Teléfono .");
                    event.preventDefault();
                  }

                var base_url = '/index.php/Comision_contrata/save1';
    
                $.ajax({
                    url:base_url,
                    method: 'post',
                    data:{
                         id_comision: id_comision,                        
                        rif_organoente: rif_organoente,
                       
                        cedula: cedula,
                        nombre: nombre,
                        apellido: apellido,
                        id_area_miembro: id_area_miembro,
                        id_tp_miembro: id_tp_miembro,
                        // fecha_desig: fecha_desig,
                        // acto_adm: acto_adm,
                        // num_acto: num_acto,
                        // fecha_acto: fecha_acto,
                        correo: correo,
                        telf: telf,  
                        obj_comision: obj_comision ,         

    
                    },
                    
                    dataType: 'json',
                    success: function(response){
                        if(response == 1) {
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
                       
                    } ,
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error',
                            text: 'ocurrio un error, por favor vuelva a intentar.'
                        });
                    }
                    
                }) 
            }
        });
    }

    function modal_ce(id) {
        var id_comision = id;          
        var base_url = '/index.php/Comision_contrata/check_comision';    
        $.ajax({
            url: base_url,
            method: "post",
            data: { id_comision: id_comision },
            dataType: "json",
            success: function(data) {
                $("#id_comision").val(id_comision);
                $("#rif_organoente2").val(data["rif_organoente"]);
                $("#rif_organoente2").val(data["rif_organoente"]);

              
    
            },
            
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error',
                            text: 'ocurrio un error, por favor vuelva a intentar.'
                        });
                    }
        });
    }

    function modal_ver(id){
		var id_miembros = id;
		//var base_url = window.location.origin+'/asnc/index.php/Certificaciones/consulta_b';
		var base_url = '/index.php/Comision_contrata/consulta_mb';
        var base_url2 = '/index.php/Comision_contrata/llenar_area';
        var base_url3 = '/index.php/Comision_contrata/llenar_tipo';

		$.ajax({
			url: base_url,
			method:'post',
			data: {id_miembros: id_miembros},
			dataType:'json',

			success: function(response){
				$('#id').val(response['id_miembros']);
				$('#cod_banco_edit').val(response['cedula']);
				$('#nombre_banco_edit').val(response['nombre']);
				$('#apellido_mb_edit').val(response['apellido']);
				$('#id_amb_edit').val(response['id_area_miembro']);
				$('#desc_are_edit').val(response['desc_area_miembro']);
				$('#desc_tipo_edit').val(response['desc_tp_miembro']);
				$('#id_tipo_edit').val(response['id_tp_miembro']);




                var id_unid_med = response['id_area_miembro'];
                $.ajax({
                    url:base_url2,
                    method: 'post',
                    data: {id_unid_med: id_unid_med},
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(index, data){
                            $('#camb_unid_medi_b').append('<option value="'+data['id_area_miembro']+'">'+data['desc_area_miembro']+'</option>');
                        });
                    }
                })

                var id_unid_med = response['id_area_miembro'];
                $.ajax({
                    url:base_url3,
                    method: 'post',
                    data: {id_unid_med: id_unid_med},
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(index, data){
                            $('#camb_tipo_medi_b').append('<option value="'+data['id_tp_miembro']+'">'+data['desc_tp_miembro']+'</option>');
                        });
                    }
                })

			}
		});
	}

    function guardar_tabla_b1(){
        var costo_unitario_mod_b = 1;
             
            if (  costo_unitario_mod_b <= 0) {
                swal.fire({
                    title: 'El costo unitario debe ser un número mayor que cero, intente de nuevo',
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
            title: '¿Seguro que desea guardar el registro?  ',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, Modificar!'
        }).then((result) => {
            if (result.value == true) {
                var id= $('#id').val();       
                var unid_med = $('#id_unid_med_b').val();
                var sel_camb_unid_medi = $('#camb_unid_medi_b').val();
                var cedula = $('#cod_banco_edit').val(); 
                var nombre = $('#nombre_banco_edit').val(); 
                var apellido = $('#apellido_mb_edit').val();
                var unid_med = $('#id_amb_edit').val(); 
                var sel_camb_unid_medi = $('#camb_unid_medi_b').val();     
                var tipo = $('#id_tipo_edit').val(); 
                var sel_camb_tipo_medi = $('#camb_tipo_medi_b').val();  
 
              //  var base_url =window.location.origin+'/asnc/index.php/Programacion/editar_fila_ip_b';
                var base_url = '/index.php/Comision_contrata/editar_fila_ip_b';
    
                $.ajax({
                    url:base_url,
                    method: 'post',
                    data:{
                        id: id,                     
                        cedula: cedula,
                        nombre: nombre,
                        apellido: apellido,
                        unid_med: unid_med,
                        sel_camb_unid_medi: sel_camb_unid_medi,
                        tipo: tipo,
                        sel_camb_tipo_medi: sel_camb_tipo_medi,
                       
    
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
    