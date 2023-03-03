if ($('#id').val().length != " "){//FUNCION EN DONDE SE CARGA LA TABLA DE IFF
    var rif_cont = $('#id').val();
    

    //var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar';
    var base_url = '/index.php/Certificacion/ver_certi_editar';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {rif_cont: rif_cont},
       dataType: 'json',

        success: function(data){
            $("#target_es_5a tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){

                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `
                    <td>${value.organo_experi_empre_capa}<input type="text" name="organo_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${value.organo_experi_empre_capa}"></td>
                    <td>${value.actividad_experi_empre_capa}<input type="text" name="actividad_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${value.actividad_experi_empre_capa}"></td>
                    <td>${value.desde_experi_empre_capa}<input type="text" name="desde_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${value.desde_experi_empre_capa}"></td>
                    <td>${value.hasta_experi_empre_capa}<input type="text" name="hasta_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${value.hasta_experi_empre_capa}"></td>
                  
                    `;

                    var cellremove_ffBtn = createCell();
                    cellremove_ffBtn.appendChild(createremove_ffBtn())
            		newRow.appendChild(cellremove_ffBtn);

                    document.querySelector('#target_es_5a tbody').appendChild(newRow);

                    function remove_ff() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_es_5a tbody')
                           .removeChild(row);
                    }

                    function createremove_ffBtn() {
                        var btnremove_ff = document.createElement('button');
                        btnremove_ff.className = 'btn btn-xs btn-danger';
                        btnremove_ff.onclick = remove_ff;
                        btnremove_ff.innerText = 'Descartar';
                        return btnremove_ff;
                    }
                });
            }
        }
    })
}

if ($('#id').val().length != " "){//FUNCION EN DONDE SE CARGA LA TABLA DE IP

    var rif_cont = $('#id').val();

    //var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar2';
    var base_url = '/index.php/Certificacion/ver_certi_editar2';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {rif_cont: rif_cont},
       dataType: 'json',

        success: function(data){
            $("#target_acc_ff tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){
					
                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `
                    <td>${value.organo_expe}<input type="text" name="organo_expe[]" id="ins-type-${increment}" hidden value="${value.organo_expe}"></td>
                    <td>${value.actividad_exp}<input type="text" name="actividad_exp[]" id="ins-type-${increment}" hidden value="${value.actividad_exp}"></td>
                    <td>${value.desde_exp}<input type="text" name="desde_exp[]" id="ins-type-${increment}" hidden value="${value.desde_exp}"></td>
                    <td>${value.hasta_exp}<input type="text" name="hasta_exp[]" id="ins-type-${increment}" hidden value="${value.hasta_exp}"></td>                  
                    `;

                    var cellremove_medBtn = createCell();
                    cellremove_medBtn.appendChild(createremove_medBtn())
                    newRow.appendChild(cellremove_medBtn);

                    document.querySelector('#target_acc_ff tbody').appendChild(newRow);

                    function remove_med() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_acc_ff tbody')
                           .removeChild(row);
                    }

                    function createremove_medBtn() {
                        var btnremove_med = document.createElement('button');
                        btnremove_med.className = 'btn btn-xs btn-danger';
                        btnremove_med.onclick = remove_med;
                        btnremove_med.innerText = 'Descartar';
                        return btnremove_med;
                    }
                });
            }
        }
    })
}
if ($('#id').val().length != " "){//FUNCION EN DONDE SE CARGA LA TABLA DE persona natural

    var rif_cont = $('#id').val();

    //var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar3';
    var base_url = '/index.php/Certificacion/ver_certi_editar3';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {rif_cont: rif_cont},
       dataType: 'json',

        success: function(data){
            $("#target_persona tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){
					
                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `
                    <td>${value.nombre_ape}<input type="text" name="nombre_ape[]" id="ins-type-${increment}" hidden value="${value.nombre_ape}"></td>
                    <td>${value.cedula}<input type="text" name="cedula[]" id="ins-type-${increment}" hidden value="${value.cedula}"></td>
                    <td>${value.rif}<input type="text" name="rif[]" id="ins-type-${increment}" hidden value="${value.rif}"></td>
                    <td>${value.bolivar_estimado}<input type="text" name="bolivar_estimado[]" id="ins-type-${increment}" hidden value="${value.bolivar_estimado}"></td>
                    
                    `;

                    var cellremove_medBtn = createCell();
                    cellremove_medBtn.appendChild(createremove_medBtn())
                    newRow.appendChild(cellremove_medBtn);

                    document.querySelector('#target_persona tbody').appendChild(newRow);

                    function remove_med() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_persona tbody')
                           .removeChild(row);
                    }

                    function createremove_medBtn() {
                        var btnremove_med = document.createElement('button');
                        btnremove_med.className = 'btn btn-xs btn-danger';
                        btnremove_med.onclick = remove_med;
                        btnremove_med.innerText = 'Descartar';
                        return btnremove_med;
                    }
                });
            }
        }
    })
}

function guardar_tabla(){

    event.preventDefault();

    swal.fire({
        title: '¿Seguro que desea guardar el registro? Se editara en la Base de Datos',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {
        if (result.value == true) {
            var id_items_proy = $('#id_items').val();

            var partida_pre = $('#id_part_pres').val();
            var selc_part_pres = $('#selc_part_pres').val();

            var obra = $('#id_tipo_obra_m').val();
            var sel_obra = $('#selec_tip_obra').val();

			var alc_obr = $('#id_alcance_obra_m').val();
            var sel_alc_obr = $('#selec_alcance_obra').val();

			var obj_obr = $('#id_obj_obra_m').val();
            var sel_obj_obr = $('#selec_obj_obra').val();

            var fecha_desde_e = $('#fecha_desde_e').val();
            var fecha_hasta_e = $('#fecha_hasta_e').val();
            var esp = $('#esp').val();

            var unid_med = $('#id_unid_med').val();
            var sel_camb_unid_medi = $('#camb_unid_medi').val();

			var cant_total_dist_m = $('#cant_total_dist_m').val();
			var prec_t = $('#prec_t').val();
			//var ali_iva_e = $('#ali_iva_e').val();

            var primero = $('#primero').val();
            var segundo = $('#segundo').val();
            var tercero = $('#tercero').val();
            var cuarto = $('#cuarto').val();
            var prec_t = $('#prec_t').val();

            var ali_iva_e = $('#ali_iva_e').val();
            var sel_id_alic_iva = $('#sel_id_alic_iva').val();

            var monto_iva_e = $('#monto_iva_e').val();
            var monto_tot_est = $('#monto_tot_est').val();

            //var base_url =window.location.origin+'/asnc/index.php/Programacion/editar_fila_ip_o';
            var base_url = '/index.php/Programacion/editar_fila_ip_o';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_items_proy: id_items_proy,
                    partida_pre: partida_pre,
                    selc_part_pres: selc_part_pres,

                    obra: obra,
                    sel_obra: sel_obra,

					alc_obr: alc_obr,
                    sel_alc_obr: sel_alc_obr,

					obj_obr: obj_obr,
                    sel_obj_obr: sel_obj_obr,
					cant_total_dist_m1: cant_total_dist_m,

                    fecha_desde_e: fecha_desde_e,
                    fecha_hasta_e: fecha_hasta_e,
                    esp: esp,
                    unid_med: unid_med,
                    sel_camb_unid_medi: sel_camb_unid_medi,
                    primero: primero,
                    segundo: segundo,
                    tercero: tercero,
                    cuarto: cuarto,
                    cant_total_dist_m: cant_total_dist_m,
					prec_t: prec_t,

                    ali_iva_e: ali_iva_e,
                    sel_id_alic_iva:sel_id_alic_iva,
                    monto_iva_e: monto_iva_e,
                    monto_tot_est: monto_tot_est
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Modificacion Exitosa',
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

function verif_d_mod(){
    var fecha_desde = $('#fecha_desde_e').val();
    var fecha_esti = $('#fecha_esti').val();

    var anio_d = fecha_desde.split("-")[0];
    if (anio_d != fecha_esti) {
        swal({
            title: "¡ATENCION!",
            text: "El año en la Fecha Desde ingresada no puede ser diferente al de la Programación.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#esp").prop('disabled', true);
        $("#unid_med").prop('disabled', true);
        $("#prec_t").prop('disabled', true);
    }else {
        $("#esp").prop('disabled', false);
        $("#unid_med").prop('disabled', false);
        $("#prec_t").prop('disabled', false);
    }
}

function verif_h_mod(){
    var fecha_hasta = $('#fecha_hasta_e').val();
    var fecha_esti = $('#fecha_esti').val();

    var anio_h = fecha_hasta.split("-")[0];

    if (anio_h != fecha_esti) {
        swal({
            title: "¡ATENCION!",
            text: "El año en la Fecha Hasta ingresada no puede ser diferente al de la Programación.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

        $("#especificacion").prop('disabled', true);
        $("#id_unidad_medida").prop('disabled', true);
        $("#precio_total").prop('disabled', true);
    }else{
        $("#especificacion").prop('disabled', false);
        $("#id_unidad_medida").prop('disabled', false);
        $("#precio_total").prop('disabled', false);
    }
}

function habilitar_trim_mod(){

  var f_desde = $('#fecha_desde_e').val();
  var mes_d = f_desde.split("-")[1];
  var f_hasta = $('#fecha_hasta_e').val();
  var mes_h = f_hasta.split("-")[1];

    if (mes_d >= 01 && mes_h <= 03) {
        $("#primero").prop('disabled', false);
        $("#segundo").prop('disabled', true);
        $("#tercero").prop('disabled', true);
        $("#cuarto").prop('disabled', true);
    }else if (mes_d >= 01 && mes_h <= 06) {
        $("#primero").prop('disabled', false);
        $("#segundo").prop('disabled', false);
        $("#tercero").prop('disabled', true);
        $("#cuarto").prop('disabled', true);
    } else if (mes_d >= 01 && mes_h <= 09) {
        $("#primero").prop('disabled', false);
        $("#segundo").prop('disabled', false);
        $("#tercero").prop('disabled', false);
        $("#cuarto").prop('disabled', true);
    } else if (mes_d >= 01 && mes_h <= 12) {
        $("#primero").prop('disabled', false);
        $("#segundo").prop('disabled', false);
        $("#tercero").prop('disabled', false);
        $("#cuarto").prop('disabled', false);
    }

    if (mes_d >= 04 && mes_h <= 06){
        $("#primero").prop('disabled', true);
        $("#segundo").prop('disabled', false);
        $("#tercero").prop('disabled', true);
        $("#cuarto").prop('disabled', true);
    }else if (mes_d >= 04 && mes_h <= 09) {
        $("#primero").prop('disabled', true);
        $("#segundo").prop('disabled', false);
        $("#tercero").prop('disabled', false);
        $("#cuarto").prop('disabled', true);
    }else if (mes_d >= 04 && mes_h <= 12) {
        $("#primero").prop('disabled', true);
        $("#segundo").prop('disabled', false);
        $("#tercero").prop('disabled', false);
        $("#cuarto").prop('disabled', false);
    }

    if (mes_d >= 06 && mes_h <= 09) {
        $("#primero").prop('disabled', true);
        $("#segundo").prop('disabled', true);
        $("#tercero").prop('disabled', false);
        $("#cuarto").prop('disabled', true);
    }else if (mes_d >= 06 && mes_h <= 12) {
        $("#primero").prop('disabled', true);
        $("#segundo").prop('disabled', true);
        $("#tercero").prop('disabled', false);
        $("#cuarto").prop('disabled', false);
    }

    if (mes_d >= 09 && mes_h <= 12) {
        $("#primero").prop('disabled', true);
        $("#segundo").prop('disabled', true);
        $("#tercero").prop('disabled', true);
        $("#cuarto").prop('disabled', false);
    }
}
