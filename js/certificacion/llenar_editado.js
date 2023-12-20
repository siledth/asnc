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

   // var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar2';
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

   // var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar3';
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
if ($('#id').val().length != " "){//FUNCION EN DONDE SE CARGA LA TABLA DE persona natural

    var rif_cont = $('#id').val();

    //var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar4';
    var base_url = '/index.php/Certificacion/ver_certi_editar4';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {rif_cont: rif_cont},
       dataType: 'json',

        success: function(data){
            $("#target_infor_perso tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){
					
                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `
                    <td>${value.cedula}<input type="text" name="cedula[]" id="ins-type-${increment}" hidden value="${value.cedula}"></td>
                    <td>${value.for_academica}<input type="text" name="for_academica[]" id="ins-type-${increment}" hidden value="${value.for_academica}"></td>
                    <td>${value.titulo}<input type="text" name="titulo[]" id="ins-type-${increment}" hidden value="${value.titulo}"></td>
                    <td>${value.ano}<input type="text" name="ano[]" id="ins-type-${increment}" hidden value="${value.ano}"></td>
                    <td>${value.culminacion}<input type="text" name="culminacion[]" id="ins-type-${increment}" hidden value="${value.culminacion}"></td>
                    <td>${value.curso}<input type="text" name="curso[]" id="ins-type-${increment}" hidden value="${value.curso}"></td> 
                   
                    `;
                    
                    var cellremove_medBtn = createCell();
                    cellremove_medBtn.appendChild(createremove_medBtn())
                    newRow.appendChild(cellremove_medBtn);

                    document.querySelector('#target_infor_perso tbody').appendChild(newRow);

                    function remove_med() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_infor_perso tbody')
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

if ($('#id').val().length != " "){ //Formación en Materia de Contratación Pública

    var rif_cont = $('#id').val();

    //var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar5';
    var base_url = '/index.php/Certificacion/ver_certi_editar5';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {rif_cont: rif_cont},
       dataType: 'json',

        success: function(data){
            $("#target_for_mat_cer tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){
					
                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `
                    <td>${value.cedula}<input type="text" name="cedula[]" id="ins-type-${increment}" hidden value="${value.cedula}"></td>
                    <td>${value.taller}<input type="text" name="taller[]" id="ins-type-${increment}" hidden value="${value.taller}"></td>
                    <td>${value.institucion}<input type="text" name="institucion[]" id="ins-type-${increment}" hidden value="${value.institucion}"></td>
                    <td>${value.hor_dura}<input type="text" name="hor_dura[]" id="ins-type-${increment}" hidden value="${value.hor_dura}"></td>
                    <td>${value.certi}<input type="text" name="certi[]" id="ins-type-${increment}" hidden value="${value.certi}"></td>
                    <td>${value.fech_cert}<input type="text" name="fech_cert[]" id="ins-type-${increment}" hidden value="${value.fech_cert}"></td> 
                    <td>${value.vigencia}<input type="text" name="vigencia[]" id="ins-type-${increment}" hidden value="${value.vigencia}"></td>
                    `;
                   

                    var cellremove_medBtn = createCell();
                    cellremove_medBtn.appendChild(createremove_medBtn())
                    newRow.appendChild(cellremove_medBtn);

                    document.querySelector('#target_for_mat_cer tbody').appendChild(newRow);

                    function remove_med() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_for_mat_cer tbody')
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
if ($('#id').val().length != " "){ // Experiencia de Participación en Comisiones de Contrataciones (en los últimos 10 años)

    var rif_cont = $('#id').val();

    //var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar6';
    var base_url = '/index.php/Certificacion/ver_certi_editar6';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {rif_cont: rif_cont},
       dataType: 'json',

        success: function(data){
            $("#target_exp_10 tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){
					
                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `
                    <td>${value.cedula}<input type="text" name="cedul10[]" id="ins-type-${increment}" hidden value="${value.cedula}"></td>
                    <td>${value.organo10}<input type="text" name="organo10[]" id="ins-type-${increment}" hidden value="${value.organo10}"></td>
                    <td>${value.act_adminis_desid}<input type="text" name="act_adminis_desid[]" id="ins-type-${increment}" hidden value="${value.act_adminis_desid}"></td>
                    <td>${value.n_acto}<input type="text" name="n_acto[]" id="ins-type-${increment}" hidden value="${value.n_acto}"></td>
                    <td>${value.area_10}<input type="text" name="area_10[]" id="ins-type-${increment}" hidden value="${value.area_10}"></td>  
                    <td>${value.dura_comi}<input type="text" name="dura_comi[]" id="ins-type-${increment}" hidden value="${value.dura_comi}"></td>
                    <td>${value.fecha_act}<input type="text" name="fecha_act[]" id="ins-type-${increment}" hidden value="${value.fecha_act}"></td>
                    
                   
                    `;
                   
                    var cellremove_medBtn = createCell();
                    cellremove_medBtn.appendChild(createremove_medBtn())
                    newRow.appendChild(cellremove_medBtn);

                    document.querySelector('#target_exp_10 tbody').appendChild(newRow);

                    function remove_med() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_exp_10 tbody')
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
if ($('#id').val().length != " "){ // Experiencia de Participación en Comisiones de Contrataciones (en los últimos 10 años)

    var rif_cont = $('#id').val();

  //  var base_url =window.location.origin+'/asnc/index.php/Certificacion/ver_certi_editar7';
   var base_url = '/index.php/Certificacion/ver_certi_editar7';
    $.ajax({
       url:base_url,
       method: 'post',
       data: {rif_cont: rif_cont},
       dataType: 'json',

        success: function(data){
            $("#target_es_3a tbody").html('');
            if(data != null && $.isArray(data)){
                $.each(data, function(index, value){
					
                    var newRow = document.createElement('tr');

                    var increment = increment +1;
                    newRow.className='myTr';
                    newRow.innerHTML = `
                    <td>${value.cedula}<input type="text" name="cedula[]" id="ins-type-${increment}" hidden value="${value.cedula}"></td>
                    <td>${value.organo3}<input type="text" name="organo3[]" id="ins-type-${increment}" hidden value="${value.organo3}"></td>
                    <td>${value.actividad3}<input type="text" name="actividad3[]" id="ins-type-${increment}" hidden value="${value.actividad3}"></td>
                    <td>${value.desde3}<input type="text" name="desde3[]" id="ins-type-${increment}" hidden value="${value.desde3}"></td>
                    <td>${value.hasta3}<input type="text" name="hasta3[]" id="ins-type-${increment}" hidden value="${value.hasta3}"></td>  
                    `;
                   
                    var cellremove_medBtn = createCell();
                    cellremove_medBtn.appendChild(createremove_medBtn())
                    newRow.appendChild(cellremove_medBtn);

                    document.querySelector('#target_es_3a tbody').appendChild(newRow);

                    function remove_med() {
                	       var row = this.parentNode.parentNode;
                           document.querySelector('#target_es_3a tbody')
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
