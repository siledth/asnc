$("#precio_rend_ejecu").on({
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
$("#paridad_rendi").on({
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
$("#monto_factura_rend").on({
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
$("#paridad_rendi_factura").on({
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
$("#base_imponible_rendi").on({
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
function modal(id) {
    var id_p_items = id;
        // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_item_modal_servicio';
        // var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_modalidad';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url4 =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
        // var base_url5 =window.location.origin+'/asnc/index.php/Programacion/llenar_tipo_doc_contrata';
        // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/llenar_comp_resp_social'; 
        // var base_url7 =window.location.origin+'/asnc/index.php/Programacion/llenar_trimestre';       
        var base_url = '/index.php/Programacion/consultar_item_modal_servicio';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url4 = '/index.php/Programacion/consultar_contratista';
         var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';
         var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';
         var base_url7 = '/index.php/Programacion/llenar_trimestre';

    $.ajax({
        url: base_url,
        method: "post",
        data: { id_p_items: id_p_items },
        dataType: "json",
        success: function(data) {
            $('#id_items_b').val(id);
            $("#id_p_items").val(id_p_items);
            $("#id_accion_centralizada1").val(data["id_accion_centralizada"]);
            $("#id_enlace1").val(data["id_enlace"]);
            $("#desc_accion_centralizada1").val(data["desc_accion_centralizada"]);
            $("#id_obj_comercial2").val(data["id_obj_comercial"]);
            $("#desc_objeto_contrata2").val(data["desc_objeto_contrata"]);
            
            $("#id_programacion2").val(data["id_programacion"]);
             $("#codigopartida_presupuestaria").val(data["codigopartida_presupuestaria"]);
             $("#desc_partida_presupuestaria").val(data["desc_partida_presupuestaria"]);
             $("#codigo_ccnu").val(data["codigo_ccnu"]);
             $("#desc_ccnu").val(data["desc_ccnu"]);
             $("#id_estado").val(data["id_estado"]);
             $("#id_fuente_financiamiento").val(data["id_fuente_financiamiento"]);
             $("#desc_fuente_financiamiento").val(data["desc_fuente_financiamiento"]);
             
             $("#porcentaje").val(data["porcentaje"]);            
            $("#especificacion").val(data["especificacion"]);
            $('#id_unid_med_b').val(data['id_unidad_medida']);
            $('#unid_med_b').val(data['desc_unidad_medida']);
            $('#rendido').val(data['descripcion_trimestre']);
            $('#rendidoa').val(data['trimestre']);

            
            $('#cantidad_mod_b').val(data['cantidad']);
            $('#primero_b').val(data['i']);
            $('#segundo_b').val(data['ii']);
            $('#tercero_b').val(data['iii']);
            $('#cuarto_b').val(data['iv']);
            $('#cant_total_distribuir_mod_b').val(data['cant_total_distribuir']);

            $('#costo_unitario_mod_b').val(data['costo_unitario']);
            $('#precio_total_mod_b').val(data['precio_total']);
            $('#ali_iva_e_b').val(data['alicuota_iva']);
            $('#iva_estimado_mod_b').val(data['iva_estimado']);
            $('#monto_estimado_mod_b').val(data['monto_estimado']);

            $('#estimado_primer').val(data['est_trim_1']);
            $('#estimado_segundo').val(data['est_trim_2']);
            $('#estimado_tercer').val(data['est_trim_3']);
            $('#estimado_cuarto').val(data['est_trim_4']);
            $('#estimado_total_t_mod').val(data['estimado_total_t_acc']);
            $('#fecha_desde').val(data['fecha_desde']);
            $('#fecha_hasta').val(data['fecha_hasta']);
            
          
          
           

            // llena el selectde trimestre
$.ajax({
    url:base_url7,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#llenar_trimestre').append('<option value="'+data['id_trimestre']+'">'+data['descripcion_trimestre']+'</option>');
        });
    }
})
// llena el selectde modalidad
var rifced = data['rifced'];
$.ajax({
    url:base_url4,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#rif_rendi').append('<option value="'+data['rifced']+'">'+data['rifced']+'</option>');
        });
    }
})
// llena el selectde cotratista
var id = data['id'];
$.ajax({
    url:base_url2,
    method: 'post',
    data: {id: id},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#modalida_rendi').append('<option value="'+data['id']+'">'+data['descripcion']+'</option>');
        });
    }
})

// llena el select de unidad de medida
            var id_unid_med = data['id_unidad_medida'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_unid_med: id_unid_med},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#camb_unid_medi_b').append('<option value="'+data['id_unidad_medida']+'">'+data['desc_unidad_medida']+'</option>');
                    });
                }
            })


//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_unid_med: id_unid_med},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva2 = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_alic_iva2: id_alic_iva2},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi2').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

// llena el selectde tipo_doc_contrato
var id1 = data['id'];
$.ajax({
    url:base_url5,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_tipo_doc_contrata').append('<option value="'+data['id_tipo_doc_contrata']+'">'+data['desc_tipo_doc_contrata']+'</option>');
        });
    }
})
// llena el select de COMPROMISO DE RESPONSABILIDAD SOCIAL
var id1 = data['id'];
$.ajax({
    url:base_url6,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_com_res_social').append('<option value="'+data['id_comp_resp_social']+'">'+data['desc_comp_resp_social']+'</option>');
        });
    }
})
        },
    });
}



function calculos_rendi_servicio(){

    var cantidad = 100;
    var i = $('#I').val();
    var ii = $('#II').val();
    var iii = $('#III').val();
    var iv = $('#IV').val();
   
 

        //Remplazar decimales para caculos
            var precio_total = $('#precio_rend_ejecu').val();
            var newstr = precio_total.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

        //calculo de Iva Estimado
            var id_alicuota_iva = $('#selc_iva_rendi').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = precio*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado_rend').val(iva_estimado2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi').val(monto_total_estimado);



            //Remplazar decimales para caculos
            var precio_total = $('#precio_rend_ejecu').val();
            var newstr = precio_total.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

        //calculo de paridad
        var paridad_rendi = $('#paridad_rendi').val();
        var newstr1 = paridad_rendi.replace('.', "");
        var newstr6 = newstr1.replace('.', "");
        var newstr7 = newstr6.replace('.', "");
        var newstr8 = newstr7.replace('.', "");
        var paridad = newstr8.replace(',', ".");

            var subtotal = precio/paridad;
            var subtoral = parseFloat(subtotal).toFixed(2);
            var subtoral2 = Intl.NumberFormat("de-DE").format(subtoral);
            $('#subtotal_rendi').val(subtoral2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi').val(monto_total_estimado);

        //Remplazar decimales para caculos
        var montofactura = $('#monto_factura_rend').val();
        var newst1 = montofactura.replace('.', "");
        var newst5 = newst1.replace('.', "");
        var newst6 = newst5.replace('.', "");
        var newst7 = newst6.replace('.', "");
        var montofactura1 = newst7.replace(',', ".");
        //calculo de Iva Estimado2
        var id_alicuota_iva3 = $('#selc_iva_rendi2').val();
        var separar1 = id_alicuota_iva3.split("/");
        var porcentaje1 = separar1['0'];
        var monto_iva_estimado2 = montofactura1*porcentaje1;
        var iva_estimado3 = parseFloat(monto_iva_estimado2).toFixed(2);
        var iva_estimado4 = Intl.NumberFormat("de-DE").format(iva_estimado3);
      //  $('#iva_estimado_rend').val(iva_estimado4);

        // var monto_total_est4 = Number(montofactura1) + Number(iva_estimado4);
        // var monto_total_estimado5 = Intl.NumberFormat("de-DE").format(monto_total_est4);
        // $('#total_pago_rendi').val(monto_total_estimado5);
//////////paridad factura
       
        var paridad_rendi_factura = $('#paridad_rendi_factura').val();
        var news1 = paridad_rendi_factura.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var paridad_rendi_factura2 = news8.replace(',', ".");
        
        var base_imponible_rendi = $('#base_imponible_rendi').val();
        var new1 = base_imponible_rendi.replace('.', "");
        var new6 = new1.replace('.', "");
        var new7 = new6.replace('.', "");
        var new8 = new7.replace('.', "");
        var base_imponible_rendi = new8.replace(',', ".");



            var subtotal_rendi_factura = base_imponible_rendi/paridad_rendi_factura2;
            var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_factura).toFixed(2);
            var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
            $('#subtotal_rendi_factura').val(subtotal_rendi_factura3);




            var monto3_rendi = base_imponible_rendi*0.03;
            var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
            var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
            $('#monto3_rendi').val(monto3_rendi3);
        
           

           
           
            
    }

    function buscar_rif(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
        var ccnu_b_m = $('#rif_nombre').val();
    
        //console.log(ccnu_b_m);
        //var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
       var base_url = '/index.php/Programacion/consultar_contratista';
        $.ajax({
            url:base_url,
            method: 'post',
            data: {ccnu_b_m: ccnu_b_m},
            dataType: 'json',
            success: function(data){
                $('#sel_rif_nombre').find('option').not(':first').remove();
                $.each(data, function(index, response){
                    $('#sel_rif_nombre').append('<option value="'+response['rifced']+'">'+response['nombre']+'</option>');
                });
            }
        })
    }

    function check(e) {
        tecla = (document.all) ? e.keyCode : e.which;
    
        //Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            return true;
        }
    
        // Patrón de entrada, en este caso solo acepta numeros y letras
        patron = /[A-Za-z0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }

    //////////////Guardar rendicion servicio
function guardar_proc_pago(){
    var rendido  = $("#rendidoa").val();
    var llenar_trimestre  = $("#llenar_trimestre").val();

    
    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de registrar rendición ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
           if (llenar_trimestre == rendido) {
            alert("El trimestre Seleccionado ya fue rendido.")
            }
        //     if (document.guardar_proc_pag.dolar.value.length==0){
        //         alert("No Puede dejar el campo Valor Dolar vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.dolar.focus()
        //         return 0;
        //  } 
        //     if (document.guardar_proc_pag.cantidad_pagar_otra.value.length==0){
        //         alert("No Puede dejar el campo la Cantidad a pagar $ vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.cantidad_pagar_otra.focus()
        //         return 0;
        //  }  
            	if (document.guardar_proc_pag.llenar_trimestre.selectedIndex==0){
            alert("Debe seleccionar un Trimestre.")
            document.guardar_proc_pag.llenar_trimestre.focus()
            return 0;
     }
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_proc_pag")[0]);
                          //  var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_servicio_acc';
                          var base_url = '/index.php/Programacion/guardar_rendi_servicio_acc';
                
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var menj = 'Rendido';
                       
                       if (response != '') {
                        swal.fire({
                            title: 'Registro Exitoso ',
                            text: menj ,
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
                        
                    },
                });
            }
        });
    
}



///////modal obras //////////////////////////////////////////////////////////////////////
function modal_obras(id) {
    var id_p_items = id;
        // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_item_modal_servicio';
        // var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_modalidad';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url4 =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
        // var base_url5 =window.location.origin+'/asnc/index.php/Programacion/llenar_tipo_doc_contrata';
        // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/llenar_comp_resp_social'; 
        // var base_url7 =window.location.origin+'/asnc/index.php/Programacion/llenar_trimestre';       
        var base_url = '/index.php/Programacion/consultar_item_modal_servicio';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url4 = '/index.php/Programacion/consultar_contratista';
         var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';
         var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';
         var base_url7 = '/index.php/Programacion/llenar_trimestre';

    $.ajax({
        url: base_url,
        method: "post",
        data: { id_p_items: id_p_items },
        dataType: "json",
        success: function(data) {
            $('#id_items_b3').val(id);
            $("#id_p_items3").val(id_p_items);
            $("#id_accion_centralizada3").val(data["id_accion_centralizada"]);
            $("#id_enlace3").val(data["id_enlace"]);
            $("#desc_accion_centralizada3").val(data["desc_accion_centralizada"]);
            $("#desc_objeto_contrata3").val(data["desc_objeto_contrata"]);
            $("#id_obj_comercial3").val(data["id_obj_comercial"]);
            $("#id_tip_obra").val(data["id_tip_obra"]);
            $("#id_alcance_obra").val(data["id_alcance_obra"]);
            $("#id_obj_obra").val(data["id_obj_obra"]);
            $("#descripcion_tip_obr").val(data["descripcion_tip_obr"]);
            $("#descripcion_alcance_obra").val(data["descripcion_alcance_obra"]);
            $("#descripcion_obj_obra").val(data["descripcion_obj_obra"]);
            $("#id_programacion3").val(data["id_programacion"]);
             $("#codigopartida_presupuestaria3").val(data["codigopartida_presupuestaria"]);
             $("#desc_partida_presupuestaria3").val(data["desc_partida_presupuestaria"]);
             $("#codigo_ccnu3").val(data["codigo_ccnu"]);
             $("#desc_ccnu3").val(data["desc_ccnu"]);
             $("#id_estado3").val(data["id_estado"]);
             $("#id_fuente_financiamiento3").val(data["id_fuente_financiamiento"]);
             $("#desc_fuente_financiamiento3").val(data["desc_fuente_financiamiento"]);
             $("#porcentaje3").val(data["porcentaje"]);            
            $("#especificacion3").val(data["especificacion"]);
            $('#id_unid_med_b3').val(data['id_unidad_medida']);
            $('#unid_med_b3').val(data['desc_unidad_medida']);
            $('#rendido3').val(data['descripcion_trimestre']);
            $('#rendid3').val(data['trimestre']);
            
            $('#cantidad_mod_b3').val(data['cantidad']);
            $('#primero_b3').val(data['i']);
            $('#segundo_b3').val(data['ii']);
            $('#tercero_b3').val(data['iii']);
            $('#cuarto_b3').val(data['iv']);
            $('#cant_total_distribuir_mod_b3').val(data['cant_total_distribuir']);

            $('#costo_unitario_mod_b3').val(data['costo_unitario']);
            $('#precio_total_mod_b3').val(data['precio_total']);
            $('#ali_iva_e_b3').val(data['alicuota_iva']);
            $('#iva_estimado_mod_b3').val(data['iva_estimado']);
            $('#monto_estimado_mod_b3').val(data['monto_estimado']);

            $('#estimado_primer3').val(data['est_trim_1']);
            $('#estimado_segundo3').val(data['est_trim_2']);
            $('#estimado_tercer3').val(data['est_trim_3']);
            $('#estimado_cuarto3').val(data['est_trim_4']);
            $('#estimado_total_t_mod3').val(data['estimado_total_t_acc']);
            $('#fecha_desde3').val(data['fecha_desde']);
            $('#fecha_hasta3').val(data['fecha_hasta']);
            
          
          
           

            // llena el selectde trimestre
$.ajax({
    url:base_url7,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#llenar_trimestre3').append('<option value="'+data['id_trimestre']+'">'+data['descripcion_trimestre']+'</option>');
        });
    }
})
// llena el selectde modalidad
var rifced = data['rifced'];
$.ajax({
    url:base_url4,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#rif_rendi3').append('<option value="'+data['rifced']+'">'+data['rifced']+'</option>');
        });
    }
})
// llena el selectde cotratista
var id = data['id'];
$.ajax({
    url:base_url2,
    method: 'post',
    data: {id: id},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#modalida_rendi3').append('<option value="'+data['id']+'">'+data['descripcion']+'</option>');
        });
    }
})

// llena el select de unidad de medida
            var id_unid_med = data['id_unidad_medida'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_unid_med: id_unid_med},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#camb_unid_medi_b3').append('<option value="'+data['id_unidad_medida']+'">'+data['desc_unidad_medida']+'</option>');
                    });
                }
            })


//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_unid_med: id_unid_med},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi3').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva2 = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_alic_iva2: id_alic_iva2},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi4').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

// llena el selectde tipo_doc_contrato
var id1 = data['id'];
$.ajax({
    url:base_url5,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_tipo_doc_contrata3').append('<option value="'+data['id_tipo_doc_contrata']+'">'+data['desc_tipo_doc_contrata']+'</option>');
        });
    }
})
// llena el select de COMPROMISO DE RESPONSABILIDAD SOCIAL
var id1 = data['id'];
$.ajax({
    url:base_url6,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_com_res_social3').append('<option value="'+data['id_comp_resp_social']+'">'+data['desc_comp_resp_social']+'</option>');
        });
    }
})
        },
    });
}

function buscar_rif3(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var ccnu_b_m = $('#rif_nombre3').val();

    //console.log(ccnu_b_m);
   // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
    var base_url = '/index.php/Programacion/consultar_contratista';
    $.ajax({
        url:base_url,
        method: 'post',
        data: {ccnu_b_m: ccnu_b_m},
        dataType: 'json',
        success: function(data){
            $('#sel_rif_nombre3').find('option').not(':first').remove();
            $.each(data, function(index, response){
                $('#sel_rif_nombre3').append('<option value="'+response['rifced']+'">'+response['nombre']+'</option>');
            });
        }
    })
}
 //////////////Guardar rendicion obras
 function rendirobras(){
    var rendido  = $("#rendid3").val();
    var llenar_trimestre  = $("#llenar_trimestre3").val();
    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de registrar rendición ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
            if (document.rendirobra3.llenar_trimestre3.selectedIndex==0){
                alert("Debe seleccionar un Trimestre.")
                document.rendirobra3.llenar_trimestre3.focus()
                return 0;
         }
            if (llenar_trimestre == rendido) {
                alert("El trimestre Seleccionado ya fue rendido.")
                }
            //     if (document.guardar_proc_pag.dolar.value.length==0){
        //         alert("No Puede dejar el campo Valor Dolar vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.dolar.focus()
        //         return 0;
        //  } 
        //     if (document.guardar_proc_pag.cantidad_pagar_otra.value.length==0){
        //         alert("No Puede dejar el campo la Cantidad a pagar $ vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.cantidad_pagar_otra.focus()
        //         return 0;
        //  }  
            	
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#rendirobra3")[0]);
              //              var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_obra_acc';
                 var base_url = '/index.php/Programacion/guardar_rendi_obra_acc';
                
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var menj = 'Rendido';
                       
                       if (response != '') {
                        swal.fire({
                            title: 'Registro Exitoso ',
                            text: menj ,
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
                        
                    },
                });
            }
        });
    
}

function calculos_rendi_obritas(){

    var cantidad = 100;
    var i = $('#I').val();
    var ii = $('#II').val();
    var iii = $('#III').val();
    var iv = $('#IV').val();
   
 

        //Remplazar decimales para caculos
            var precio_total = $('#precio_rend_ejecu3').val();
            var newstr = precio_total.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

        //calculo de Iva Estimado
            var id_alicuota_iva = $('#selc_iva_rendi3').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = precio*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado_rend3').val(iva_estimado2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi3').val(monto_total_estimado);



            //Remplazar decimales para caculos
            var precio_total = $('#precio_rend_ejecu3').val();
            var newstr = precio_total.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

        //calculo de paridad
        var paridad_rendi = $('#paridad_rendi3').val();
        var newstr1 = paridad_rendi.replace('.', "");
        var newstr6 = newstr1.replace('.', "");
        var newstr7 = newstr6.replace('.', "");
        var newstr8 = newstr7.replace('.', "");
        var paridad = newstr8.replace(',', ".");

            var subtotal = precio/paridad;
            var subtoral = parseFloat(subtotal).toFixed(2);
            var subtoral2 = Intl.NumberFormat("de-DE").format(subtoral);
            $('#subtotal_rendi3').val(subtoral2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi3').val(monto_total_estimado);

        //Remplazar decimales para caculos
        var montofactura6 = $('#monto_factura_rend3').val();
        var newst1 = montofactura6.replace('.', "");
        var newst5 = newst1.replace('.', "");
        var newst6 = newst5.replace('.', "");
        var newst7 = newst6.replace('.', "");
        var montofactura8 = newst7.replace(',', ".");
        //calculo de Iva Estimado2
        var id_alicuota_iva3 = $('#selc_iva_rendi4').val();
        var separar1 = id_alicuota_iva3.split("/");
        var porcentaje1 = separar1['0'];
        var monto_iva_estimado2 = montofactura8*porcentaje1;
        var iva_estimado3 = parseFloat(monto_iva_estimado2).toFixed(2);
        var iva_estimado8 = Intl.NumberFormat("de-DE").format(iva_estimado3);
      //  $('#iva_estimado_rend').val(iva_estimado4);

        // var monto_tolest = Number(montofactura8) + Number(iva_estimado8);
        // var monto_total__es = Intl.NumberFormat("de-DE").format(monto_tolest);
        // $('#total_pago_rendi3').val(monto_total__es);
            //////////paridad factura
       
        var paridad_rendi_facturas = $('#paridad_rendi_factura3').val();
        var news1 = paridad_rendi_facturas.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var paridad_rendi_factura22 = news8.replace(',', ".");
        
        var base_imponible_rendis = $('#base_imponible_rendi3').val();
        var new1 = base_imponible_rendis.replace('.', "");
        var new6 = new1.replace('.', "");
        var new7 = new6.replace('.', "");
        var new8 = new7.replace('.', "");
        var base_imponible_rendis = new8.replace(',', ".");



            var subtotal_rendi_facturas = base_imponible_rendis/paridad_rendi_factura22;
            var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
            var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
            $('#subtotal_rendi_factura3').val(subtotal_rendi_factura3);




            var monto3_rendi = base_imponible_rendis*0.03;
            var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
            var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
            $('#monto3_rendi3').val(monto3_rendi3);
        
           

           
           
            
    }

    $("#precio_rend_ejecu3").on({
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
    $("#paridad_rendi3").on({
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
    $("#monto_factura_rend3").on({
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
    $("#paridad_rendi_factura3").on({
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
    $("#base_imponible_rendi3").on({
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

    //////////////////////Bienes

    function modal_bienes(id) {
        var id_p_items = id;
            // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_item_modal_servicio';
            // var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_modalidad';
            // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';
            // var base_url4 =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
            // var base_url5 =window.location.origin+'/asnc/index.php/Programacion/llenar_tipo_doc_contrata';
            // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/llenar_comp_resp_social'; 
            // var base_url7 =window.location.origin+'/asnc/index.php/Programacion/llenar_trimestre';       
            var base_url = '/index.php/Programacion/consultar_item_modal_servicio';
            var base_url2 = '/index.php/Programacion/llenar_modalidad';
            var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
            var base_url4 = '/index.php/Programacion/consultar_contratista';
             var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';
             var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';
             var base_url7 = '/index.php/Programacion/llenar_trimestre';
    
        $.ajax({
            url: base_url,
            method: "post",
            data: { id_p_items: id_p_items },
            dataType: "json",
            success: function(data) {
                $('#id_items_b5').val(id);
                $("#id_p_items5").val(id_p_items);
                $("#id_accion_centralizada5").val(data["id_accion_centralizada"]);
                $("#id_enlace5").val(data["id_enlace"]);
                $("#desc_accion_centralizada5").val(data["desc_accion_centralizada"]);
                $("#id_obj_comercial5").val(data["id_obj_comercial"]);
                $("#desc_objeto_contrata5").val(data["desc_objeto_contrata"]);
                
                $("#id_programacion5").val(data["id_programacion"]);
                 $("#codigopartida_presupuestaria5").val(data["codigopartida_presupuestaria"]);
                 $("#desc_partida_presupuestaria5").val(data["desc_partida_presupuestaria"]);
                 $("#codigo_ccnu5").val(data["codigo_ccnu"]);
                 $("#desc_ccnu5").val(data["desc_ccnu"]);
                 $("#id_estado5").val(data["id_estado"]);
                 $("#id_fuente_financiamiento5").val(data["id_fuente_financiamiento"]);
                 $("#desc_fuente_financiamiento5").val(data["desc_fuente_financiamiento"]);
                 
                 $("#porcentaje5").val(data["porcentaje"]);            
                $("#especificacion5").val(data["especificacion"]);
                $('#id_unid_med_b5').val(data['id_unidad_medida']);
                $('#unid_med_b5').val(data['desc_unidad_medida']);
                $('#rendido5').val(data['descripcion_trimestre']);
                $('#rendidoa5').val(data['trimestre']);
                $('#cantidad_mod_b5').val(data['cantidad']);
                $('#primero_b5').val(data['i']);
                $('#segundo_b5').val(data['ii']);
                $('#tercero_b5').val(data['iii']);
                $('#cuarto_b5').val(data['iv']);
                $('#cant_total_distribuir_mod_b5').val(data['cant_total_distribuir']);
    
                $('#costo_unitario_mod_b5').val(data['costo_unitario']);
                $('#subtbd').val(data['precio_total']);
                $('#precio_total_mod_b5').val(data['precio_total']);
                $('#ali_iva_e_b5').val(data['alicuota_iva']);
                $('#iva_estimado_mod_b5').val(data['iva_estimado']);
                $('#monto_estimado_mod_b5').val(data['monto_estimado']);
    
                $('#estimado_primer5').val(data['est_trim_1']);
                $('#estimado_segundo5').val(data['est_trim_2']);
                $('#estimado_tercer5').val(data['est_trim_3']);
                $('#estimado_cuarto5').val(data['est_trim_4']);
                $('#estimado_total_t_mod5').val(data['estimado_total_t_acc']);
                $('#fecha_desde5').val(data['fecha_desde']);
                $('#fecha_hasta5').val(data['fecha_hasta']);
                
              
              
               
    
                // llena el selectde trimestre
    $.ajax({
        url:base_url7,
        method: 'post',
        data: {rifced: rifced},
        dataType: 'json',
        success: function(data){
            $.each(data, function(index, data){
                $('#llenar_trimestre5').append('<option value="'+data['id_trimestre']+'">'+data['descripcion_trimestre']+'</option>');
            });
        }
    })
    // llena el selectde modalidad
    var rifced = data['rifced'];
    $.ajax({
        url:base_url4,
        method: 'post',
        data: {rifced: rifced},
        dataType: 'json',
        success: function(data){
            $.each(data, function(index, data){
                $('#sel_rif_nombre5').append('<option value="'+data['rifced']+'">'+data['rifced']+'</option>');
            });
        }
    })
    // llena el selectde cotratista
    var id = data['id'];
    $.ajax({
        url:base_url2,
        method: 'post',
        data: {id: id},
        dataType: 'json',
        success: function(data){
            $.each(data, function(index, data){
                $('#modalida_rendi5').append('<option value="'+data['id']+'">'+data['descripcion']+'</option>');
            });
        }
    })
    
    // llena el select de unidad de medida
                var id_unid_med = data['id_unidad_medida'];
                $.ajax({
                    url:base_url2,
                    method: 'post',
                    data: {id_unid_med: id_unid_med},
                    dataType: 'json',
                    success: function(data){
                        $.each(data, function(index, data){
                            $('#camb_unid_medi_b5').append('<option value="'+data['id_unidad_medida']+'">'+data['desc_unidad_medida']+'</option>');
                        });
                    }
                })
    
    
    //FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
    var id_alic_iva = data['alicuota_iva'];
    $.ajax({
        url:base_url3,
        method: 'post',
        data: {id_unid_med: id_unid_med},
        dataType: 'json',
        success: function(data){
            console.log(data);
            $.each(data, function(index, data){
                $('#selc_iva_re').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
            });
        }
    })
    
    //FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
    var id_alic_iva2 = data['alicuota_iva'];
    $.ajax({
        url:base_url3,
        method: 'post',
        data: {id_alic_iva2: id_alic_iva2},
        dataType: 'json',
        success: function(data){
            console.log(data);
            $.each(data, function(index, data){
                $('#selc_iva_rendi55').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
            });
        }
    })
    
    // llena el selectde tipo_doc_contrato
    var id1 = data['id'];
    $.ajax({
        url:base_url5,
        method: 'post',
        data: {id1: id1},
        dataType: 'json',
        success: function(data){
            $.each(data, function(index, data){
                $('#selc_tipo_doc_contrata5').append('<option value="'+data['id_tipo_doc_contrata']+'">'+data['desc_tipo_doc_contrata']+'</option>');
            });
        }
    })
    // llena el select de COMPROMISO DE RESPONSABILIDAD SOCIAL
    var id1 = data['id'];
    $.ajax({
        url:base_url6,
        method: 'post',
        data: {id1: id1},
        dataType: 'json',
        success: function(data){
            $.each(data, function(index, data){
                $('#selc_com_res_social5').append('<option value="'+data['id_comp_resp_social']+'">'+data['desc_comp_resp_social']+'</option>');
            });
        }
    })
            },
        });
    }
    function calculos_rendi_bienessacc(){
        var trimestres7 = $('#llenar_trimestre5').val();
        if (trimestres7=='1') {
            var cantidades = $('#primero_b5').val();
            var cantidad1 = cantidades.replace('.', "");
            var cantidad2 = cantidad1.replace('.', "");
            var cantidad3 = cantidad2.replace('.', "");
            var cantidad4 = cantidad3.replace('.', "");
            var cantidad = cantidad4.replace(',', ".");
            //Remplazar decimales para caculos
            var costos = $('#costo_unitario_remd').val();
            var costos1 = costos.replace('.', "");
            var costos2 = costos1.replace('.', "");
            var costos3 = costos2.replace('.', "");
            var costos4 = costos3.replace('.', "");
            var costos_un = costos4.replace(',', ".");
            
            
            
            var subtotales = Number(cantidad) * Number(costos_un);
            var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
            $('#subt_rend_ejecu').val(subtotales1);
           
           
            var subt_rend_ejecu = $('#subt_rend_ejecu').val();
            var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
            var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
            var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
            var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
            var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
            //calculo de Iva Estimado
            var id_alicuota_iva = $('#selc_iva_re').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = subt_rend_ejecus*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado_red5').val(iva_estimado2);
        
              
            var iva_estimado_red5 = $('#iva_estimado_red5').val();
            var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
            var iva_estimado_red52= iva_estimado_red51.replace('.', "");
            var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
            var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
            var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
           
            //Calculo Monto Total Estimado
                var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
                var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
                $('#total_rendi5').val(monto_total_estimado);
        
            var subt_rend_ejecu2 = $('#subt_rend_ejecu').val();
            var news1 = subt_rend_ejecu2.replace('.', "");
            var news6 = news1.replace('.', "");
            var news7 = news6.replace('.', "");
            var news8 = news7.replace('.', "");
            var subt_rend_ejecu = news8.replace(',', ".");
        
            var paridad_rendi5 = $('#paridad_rendi5').val();
            var new1 = paridad_rendi5.replace('.', "");
            var new6 = new1.replace('.', "");
            var new7 = new6.replace('.', "");
            var new8 = new7.replace('.', "");
            var paridad_rendi55 = new8.replace(',', ".");
            var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
            var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
            var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
            $('#subtotal_rendi5').val(subtotal_rendi_factura3);
        
        }
        if (trimestres7=='2') {
            var cantidades = $('#primero_b5').val();
            var cantidad1 = cantidades.replace('.', "");
            var cantidad2 = cantidad1.replace('.', "");
            var cantidad3 = cantidad2.replace('.', "");
            var cantidad4 = cantidad3.replace('.', "");
            var cantidad = cantidad4.replace(',', ".");
            //Remplazar decimales para caculos
            var costos = $('#costo_unitario_remd').val();
            var costos1 = costos.replace('.', "");
            var costos2 = costos1.replace('.', "");
            var costos3 = costos2.replace('.', "");
            var costos4 = costos3.replace('.', "");
            var costos_un = costos4.replace(',', ".");
            
            
            
            var subtotales = Number(cantidad) * Number(costos_un);
            var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
            $('#subt_rend_ejecu').val(subtotales1);
           
           
            var subt_rend_ejecu = $('#subt_rend_ejecu').val();
            var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
            var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
            var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
            var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
            var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
            //calculo de Iva Estimado
            var id_alicuota_iva = $('#selc_iva_re').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = subt_rend_ejecus*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado_red5').val(iva_estimado2);
        
              
            var iva_estimado_red5 = $('#iva_estimado_red5').val();
            var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
            var iva_estimado_red52= iva_estimado_red51.replace('.', "");
            var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
            var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
            var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
           
            //Calculo Monto Total Estimado
                var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
                var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
                $('#total_rendi5').val(monto_total_estimado);
        
            var subt_rend_ejecu2 = $('#subt_rend_ejecu').val();
            var news1 = subt_rend_ejecu2.replace('.', "");
            var news6 = news1.replace('.', "");
            var news7 = news6.replace('.', "");
            var news8 = news7.replace('.', "");
            var subt_rend_ejecu = news8.replace(',', ".");
        
            var paridad_rendi5 = $('#paridad_rendi5').val();
            var new1 = paridad_rendi5.replace('.', "");
            var new6 = new1.replace('.', "");
            var new7 = new6.replace('.', "");
            var new8 = new7.replace('.', "");
            var paridad_rendi55 = new8.replace(',', ".");
            var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
            var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
            var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
            $('#subtotal_rendi5').val(subtotal_rendi_factura3);
        
        }
        if (trimestres7=='3') {
            var cantidades = $('#primero_b5').val();
            var cantidad1 = cantidades.replace('.', "");
            var cantidad2 = cantidad1.replace('.', "");
            var cantidad3 = cantidad2.replace('.', "");
            var cantidad4 = cantidad3.replace('.', "");
            var cantidad = cantidad4.replace(',', ".");
            //Remplazar decimales para caculos
            var costos = $('#costo_unitario_remd').val();
            var costos1 = costos.replace('.', "");
            var costos2 = costos1.replace('.', "");
            var costos3 = costos2.replace('.', "");
            var costos4 = costos3.replace('.', "");
            var costos_un = costos4.replace(',', ".");
            
            
            
            var subtotales = Number(cantidad) * Number(costos_un);
            var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
            $('#subt_rend_ejecu').val(subtotales1);
           
           
            var subt_rend_ejecu = $('#subt_rend_ejecu').val();
            var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
            var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
            var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
            var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
            var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
            //calculo de Iva Estimado
            var id_alicuota_iva = $('#selc_iva_re').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = subt_rend_ejecus*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado_red5').val(iva_estimado2);
        
              
            var iva_estimado_red5 = $('#iva_estimado_red5').val();
            var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
            var iva_estimado_red52= iva_estimado_red51.replace('.', "");
            var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
            var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
            var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
           
            //Calculo Monto Total Estimado
                var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
                var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
                $('#total_rendi5').val(monto_total_estimado);
        
            var subt_rend_ejecu2 = $('#subt_rend_ejecu').val();
            var news1 = subt_rend_ejecu2.replace('.', "");
            var news6 = news1.replace('.', "");
            var news7 = news6.replace('.', "");
            var news8 = news7.replace('.', "");
            var subt_rend_ejecu = news8.replace(',', ".");
        
            var paridad_rendi5 = $('#paridad_rendi5').val();
            var new1 = paridad_rendi5.replace('.', "");
            var new6 = new1.replace('.', "");
            var new7 = new6.replace('.', "");
            var new8 = new7.replace('.', "");
            var paridad_rendi55 = new8.replace(',', ".");
            var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
            var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
            var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
            $('#subtotal_rendi5').val(subtotal_rendi_factura3);
        
        }
        if (trimestres7=='4') {
            var cantidades = $('#primero_b5').val();
            var cantidad1 = cantidades.replace('.', "");
            var cantidad2 = cantidad1.replace('.', "");
            var cantidad3 = cantidad2.replace('.', "");
            var cantidad4 = cantidad3.replace('.', "");
            var cantidad = cantidad4.replace(',', ".");
            //Remplazar decimales para caculos
            var costos = $('#costo_unitario_remd').val();
            var costos1 = costos.replace('.', "");
            var costos2 = costos1.replace('.', "");
            var costos3 = costos2.replace('.', "");
            var costos4 = costos3.replace('.', "");
            var costos_un = costos4.replace(',', ".");
            
            
            
            var subtotales = Number(cantidad) * Number(costos_un);
            var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
            $('#subt_rend_ejecu').val(subtotales1);
           
           
            var subt_rend_ejecu = $('#subt_rend_ejecu').val();
            var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
            var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
            var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
            var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
            var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
            //calculo de Iva Estimado
            var id_alicuota_iva = $('#selc_iva_re').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = subt_rend_ejecus*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado_red5').val(iva_estimado2);
        
              
            var iva_estimado_red5 = $('#iva_estimado_red5').val();
            var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
            var iva_estimado_red52= iva_estimado_red51.replace('.', "");
            var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
            var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
            var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
           
            //Calculo Monto Total Estimado
                var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
                var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
                $('#total_rendi5').val(monto_total_estimado);
        
            var subt_rend_ejecu2 = $('#subt_rend_ejecu').val();
            var news1 = subt_rend_ejecu2.replace('.', "");
            var news6 = news1.replace('.', "");
            var news7 = news6.replace('.', "");
            var news8 = news7.replace('.', "");
            var subt_rend_ejecu = news8.replace(',', ".");
        
            var paridad_rendi5 = $('#paridad_rendi5').val();
            var new1 = paridad_rendi5.replace('.', "");
            var new6 = new1.replace('.', "");
            var new7 = new6.replace('.', "");
            var new8 = new7.replace('.', "");
            var paridad_rendi55 = new8.replace(',', ".");
            var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
            var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
            var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
            $('#subtotal_rendi5').val(subtotal_rendi_factura3);
        
        }
     
    //         //Remplazar decimales para caculos
    //         var cantidades = $('#cantidad_mod_b5').val();
    //         var cantidad1 = cantidades.replace('.', "");
    //         var cantidad2 = cantidad1.replace('.', "");
    //         var cantidad3 = cantidad2.replace('.', "");
    //         var cantidad4 = cantidad3.replace('.', "");
    //         var cantidad = cantidad4.replace(',', ".");
    //         //Remplazar decimales para caculos
    //         var costos = $('#costo_unitario_remd').val();
    //         var costos1 = costos.replace('.', "");
    //         var costos2 = costos1.replace('.', "");
    //         var costos3 = costos2.replace('.', "");
    //         var costos4 = costos3.replace('.', "");
    //         var costos_un = costos4.replace(',', ".");
            
            
            
    //         var subtotales = Number(cantidad) * Number(costos_un);
    //         var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
    //         $('#subt_rend_ejecu').val(subtotales1);
           
           
    //         var subt_rend_ejecu = $('#subt_rend_ejecu').val();
    //         var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
    //         var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
    //         var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
    //         var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
    //         var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
    //   //calculo de Iva Estimado
    //   var id_alicuota_iva = $('#selc_iva_re').val();
    //   var separar = id_alicuota_iva.split("/");
    //   var porcentaje = separar['0'];
    //   var monto_iva_estimado = subt_rend_ejecus*porcentaje;
    //   var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
    //   var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
    //   $('#iva_estimado_red5').val(iva_estimado2);

              
    //   var iva_estimado_red5 = $('#iva_estimado_red5').val();
    //         var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
    //         var iva_estimado_red52= iva_estimado_red51.replace('.', "");
    //         var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
    //         var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
    //         var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
           
      
    
    //         //Calculo Monto Total Estimado
    //             var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
    //             var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
    //             $('#total_rendi5').val(monto_total_estimado);
        
    //     var subt_rend_ejecu2 = $('#subt_rend_ejecu').val();
    //     var news1 = subt_rend_ejecu2.replace('.', "");
    //     var news6 = news1.replace('.', "");
    //     var news7 = news6.replace('.', "");
    //     var news8 = news7.replace('.', "");
    //     var subt_rend_ejecu = news8.replace(',', ".");
        
    //     var paridad_rendi5 = $('#paridad_rendi5').val();
    //     var new1 = paridad_rendi5.replace('.', "");
    //     var new6 = new1.replace('.', "");
    //     var new7 = new6.replace('.', "");
    //     var new8 = new7.replace('.', "");
    //     var paridad_rendi55 = new8.replace(',', ".");
    //         var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
    //         var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
    //         var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
    //         $('#subtotal_rendi5').val(subtotal_rendi_factura3);



            var base_imponible_rendi52 = $('#base_imponible_rendi5').val();
            var news1 = base_imponible_rendi52.replace('.', "");
            var news6 = news1.replace('.', "");
            var news7 = news6.replace('.', "");
            var news8 = news7.replace('.', "");
            var base_imponible_rendi5 = news8.replace(',', ".");
           
            var paridad_rendi_factura55 = $('#paridad_rendi_factura5').val();
            var new1 = paridad_rendi_factura55.replace('.', "");
            var new6 = new1.replace('.', "");
            var new7 = new6.replace('.', "");
            var new8 = new7.replace('.', "");
            var paridad_rendi_factura5 = new8.replace(',', ".");
           
            


            var subtotal_rendi_facturas5 = base_imponible_rendi5/paridad_rendi_factura5;
            var subtotal_rendi_factura25 = parseFloat(subtotal_rendi_facturas5).toFixed(2);
            var subtotal_rendi_factura35 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura25);
            $('#subtotal_rendi_factura5').val(subtotal_rendi_factura35);





            var monto3_rendi = base_imponible_rendi5*0.03;
            var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
            var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
            $('#monto3_rendibines').val(monto3_rendi3);
            
               
    
               
               
                
        }
        function buscar_rif5(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
            var ccnu_b_m = $('#rif_5').val();
        
            //console.log(ccnu_b_m);
          //  var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
           var base_url = '/index.php/Programacion/consultar_contratista';
            $.ajax({
                url:base_url,
                method: 'post',
                data: {ccnu_b_m: ccnu_b_m},
                dataType: 'json',
                success: function(data){
                    $('#sel_rif_nombre5').find('option').not(':first').remove();
                    $.each(data, function(index, response){
                        $('#sel_rif_nombre5').append('<option value="'+response['rifced']+'">'+response['nombre']+'</option>');
                    });
                }
            })
        }
        $("#costo_unitario_remd").on({
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
        $("#paridad_rendi5").on({
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
        $("#monto_factura_rend5").on({
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
        $("#total_pago_rendi5").on({
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
        $("#paridad_rendi_factura5").on({
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
        $("#base_imponible_rendi5").on({
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

    //////////////Guardar rendicion bienes acc
    function rendi_bienes(){
        var rendido  = $("#rendidoa5").val();
        var llenar_trimestre  = $("#llenar_trimestre5").val();
        event.preventDefault();
        swal
            .fire({
                title: "¿Registrar?",
                text: "¿Esta seguro de registrar rendición Bienes, si desea Modificar , solicitar modificación al snc ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, guardar!",
            })
            .then((result) => {
                if (llenar_trimestre == rendido) {
                    alert("El trimestre Seleccionado ya fue rendido.")
                    }
            //     if (document.guardar_proc_pag.dolar.value.length==0){
            //         alert("No Puede dejar el campo Valor Dolar vacio, Ingrese un Monto")
            //         document.guardar_proc_pag.dolar.focus()
            //         return 0;
            //  } 
            //     if (document.guardar_proc_pag.cantidad_pagar_otra.value.length==0){
            //         alert("No Puede dejar el campo la Cantidad a pagar $ vacio, Ingrese un Monto")
            //         document.guardar_proc_pag.cantidad_pagar_otra.focus()
            //         return 0;
            //  }  
                    if (document.rendi_bienes1.llenar_trimestre5.selectedIndex==0){
                alert("Debe seleccionar un Trimestre.")
                document.rendi_bienes1.llenar_trimestre5.focus()
                return 0;
         }
                if (result.value == true) {
                    event.preventDefault();
                    var datos = new FormData($("#rendi_bienes1")[0]);
                    //            var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_bienes_acc';
                    var base_url = '/index.php/Programacion/guardar_rendi_bienes_acc';
                    
                    $.ajax({
                        url: base_url,
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            var menj = 'Rendido';
                           
                           if (response != '') {
                            swal.fire({
                                title: 'Registro Exitoso ',
                                text: menj ,
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
                            
                        },
                    });
                }
            });
        
    }


////////////////////////////////////proyecto///////////////////////
function modal_bienespy(id) {
    var id_p_items = id;
        // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_item_modal_PY_bienes';
        // var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_modalidad';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url4 =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
        // var base_url5 =window.location.origin+'/asnc/index.php/Programacion/llenar_tipo_doc_contrata';
        // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/llenar_comp_resp_social'; 
        // var base_url7 =window.location.origin+'/asnc/index.php/Programacion/llenar_trimestre';       
        var base_url = '/index.php/Programacion/consultar_item_modal_PY_bienes';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url4 = '/index.php/Programacion/consultar_contratista';
         var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';
         var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';
         var base_url7 = '/index.php/Programacion/llenar_trimestre';

    $.ajax({
        url: base_url,
        method: "post",
        data: { id_p_items: id_p_items },
        dataType: "json",
        success: function(data) {
            $('#id_items_b7').val(id);
            $("#id_p_items7").val(id_p_items);
            $("#nombre_proyecto7").val(data["nombre_proyecto"]);
            $("#id_enlace7").val(data["id_enlace"]);
            
            $('#rendid7').val(data['trimestre']);

            $("#id_obj_comercial7").val(data["id_obj_comercial"]);
            $("#desc_objeto_contrata7").val(data["desc_objeto_contrata"]);
            
            $("#id_programacion7").val(data["id_programacion"]);
             $("#codigopartida_presupuestaria7").val(data["codigopartida_presupuestaria"]);
             $("#desc_partida_presupuestaria7").val(data["desc_partida_presupuestaria"]);
             $("#codigo_ccnu7").val(data["codigo_ccnu"]);
             $("#desc_ccnu7").val(data["desc_ccnu"]);
             $("#id_estado7").val(data["id_estado"]);
             $("#id_fuente_financiamiento7").val(data["id_fuente_financiamiento"]);
             $("#desc_fuente_financiamiento7").val(data["desc_fuente_financiamiento"]);
             
             $("#porcentaje7").val(data["porcentaje"]);            
            $("#especificacion7").val(data["especificacion"]);
            $('#id_unid_med_b7').val(data['id_unidad_medida']);
            $('#unid_med_b7').val(data['desc_unidad_medida']);

            $('#rendido7').val(data['descripcion_trimestre']);
            $('#cantidad_mod_b7').val(data['cantidad']);
            $('#primero_b7').val(data['i']);
            $('#segundo_b7').val(data['ii']);
            $('#tercero_b7').val(data['iii']);
            $('#cuarto_b7').val(data['iv']);
            $('#cant_total_distribuir_mod_b7').val(data['cant_total_distribuir']);

            $('#costo_unitario_mod_b7').val(data['costo_unitario']);
            $('#subtbd7').val(data['precio_total']);
            $('#precio_total_mod_b7').val(data['precio_total']);
            $('#ali_iva_e_b7').val(data['alicuota_iva']);
            $('#iva_estimado_mod_b7').val(data['iva_estimado']);
            $('#monto_estimado_mod_b7').val(data['monto_estimado']);

            $('#estimado_primer7').val(data['est_trim_1']);
            $('#estimado_segundo7').val(data['est_trim_2']);
            $('#estimado_tercer7').val(data['est_trim_3']);
            $('#estimado_cuarto7').val(data['est_trim_4']);
            $('#estimado_total_t_mod7').val(data['estimado_total_t_acc']);
            $('#fecha_desde7').val(data['fecha_desde']);
            $('#fecha_hasta7').val(data['fecha_hasta']);
            
          
          
           

            // llena el selectde trimestre
$.ajax({
    url:base_url7,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#llenar_trimestre7').append('<option value="'+data['id_trimestre']+'">'+data['descripcion_trimestre']+'</option>');
        });
    }
})
// llena el selectde modalidad
var rifced = data['rifced'];
$.ajax({
    url:base_url4,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#sel_rif_nombre7').append('<option value="'+data['rifced']+'">'+data['rifced']+'</option>');
        });
    }
})
// llena el selectde cotratista
var id = data['id'];
$.ajax({
    url:base_url2,
    method: 'post',
    data: {id: id},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#modalida_rendi7').append('<option value="'+data['id']+'">'+data['descripcion']+'</option>');
        });
    }
})

// llena el select de unidad de medida
            var id_unid_med = data['id_unidad_medida'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_unid_med: id_unid_med},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#camb_unid_medi_b7').append('<option value="'+data['id_unidad_medida']+'">'+data['desc_unidad_medida']+'</option>');
                    });
                }
            })


//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_unid_med: id_unid_med},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_re7').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva2 = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_alic_iva2: id_alic_iva2},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi7').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

// llena el selectde tipo_doc_contrato
var id1 = data['id'];
$.ajax({
    url:base_url5,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_tipo_doc_contrata7').append('<option value="'+data['id_tipo_doc_contrata']+'">'+data['desc_tipo_doc_contrata']+'</option>');
        });
    }
})
// llena el select de COMPROMISO DE RESPONSABILIDAD SOCIAL
var id1 = data['id'];
$.ajax({
    url:base_url6,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_com_res_social7').append('<option value="'+data['id_comp_resp_social']+'">'+data['desc_comp_resp_social']+'</option>');
        });
    }
})
        },
    });
}
function calculos_rendi_bieness(){

    var trimestres7 = $('#llenar_trimestre7').val();
    if (trimestres7=='1') {
        var cantidades = $('#primero_b7').val();
        var cantidad1 = cantidades.replace('.', "");
        var cantidad2 = cantidad1.replace('.', "");
        var cantidad3 = cantidad2.replace('.', "");
        var cantidad4 = cantidad3.replace('.', "");
        var cantidad = cantidad4.replace(',', ".");
        //Remplazar decimales para caculos
        var costos = $('#costo_unitario_remd7').val();
        var costos1 = costos.replace('.', "");
        var costos2 = costos1.replace('.', "");
        var costos3 = costos2.replace('.', "");
        var costos4 = costos3.replace('.', "");
        var costos_un = costos4.replace(',', ".");
        
        
        
        var subtotales = Number(cantidad) * Number(costos_un);
        var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
        $('#subt_rend_ejecu7').val(subtotales1);
       
       
        var subt_rend_ejecu = $('#subt_rend_ejecu7').val();
        var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
        var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
        var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
        var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
        var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
        //calculo de Iva Estimado
        var id_alicuota_iva = $('#selc_iva_re7').val();
        var separar = id_alicuota_iva.split("/");
        var porcentaje = separar['0'];
        var monto_iva_estimado = subt_rend_ejecus*porcentaje;
        var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
        var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
        $('#iva_estimado_red7').val(iva_estimado2);
    
          
        var iva_estimado_red5 = $('#iva_estimado_red7').val();
        var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
        var iva_estimado_red52= iva_estimado_red51.replace('.', "");
        var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
        var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
        var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
       
        //Calculo Monto Total Estimado
            var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi7').val(monto_total_estimado);
    
        var subt_rend_ejecu2 = $('#subt_rend_ejecu7').val();
        var news1 = subt_rend_ejecu2.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var subt_rend_ejecu = news8.replace(',', ".");
    
        var paridad_rendi5 = $('#paridad_rendi7').val();
        var new1 = paridad_rendi5.replace('.', "");
        var new6 = new1.replace('.', "");
        var new7 = new6.replace('.', "");
        var new8 = new7.replace('.', "");
        var paridad_rendi55 = new8.replace(',', ".");
        var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
        var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
        var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
        $('#subtotal_rendi7').val(subtotal_rendi_factura3);
    
    }
    else if(trimestres7=='2'){
    var cantidades = $('#segundo_b7').val();
    var cantidad1 = cantidades.replace('.', "");
    var cantidad2 = cantidad1.replace('.', "");
    var cantidad3 = cantidad2.replace('.', "");
    var cantidad4 = cantidad3.replace('.', "");
    var cantidad = cantidad4.replace(',', ".");
    //Remplazar decimales para caculos
    var costos = $('#costo_unitario_remd7').val();
    var costos1 = costos.replace('.', "");
    var costos2 = costos1.replace('.', "");
    var costos3 = costos2.replace('.', "");
    var costos4 = costos3.replace('.', "");
    var costos_un = costos4.replace(',', ".");
    
    
    
    var subtotales = Number(cantidad) * Number(costos_un);
    var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
    $('#subt_rend_ejecu7').val(subtotales1);
   
   
    var subt_rend_ejecu = $('#subt_rend_ejecu7').val();
    var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
    var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
    var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
    var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
    var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
    //calculo de Iva Estimado
    var id_alicuota_iva = $('#selc_iva_re7').val();
    var separar = id_alicuota_iva.split("/");
    var porcentaje = separar['0'];
    var monto_iva_estimado = subt_rend_ejecus*porcentaje;
    var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
    var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
    $('#iva_estimado_red7').val(iva_estimado2);

      
    var iva_estimado_red5 = $('#iva_estimado_red7').val();
    var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
    var iva_estimado_red52= iva_estimado_red51.replace('.', "");
    var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
    var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
    var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
   
    //Calculo Monto Total Estimado
        var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
        var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
        $('#total_rendi7').val(monto_total_estimado);

    var subt_rend_ejecu2 = $('#subt_rend_ejecu7').val();
    var news1 = subt_rend_ejecu2.replace('.', "");
    var news6 = news1.replace('.', "");
    var news7 = news6.replace('.', "");
    var news8 = news7.replace('.', "");
    var subt_rend_ejecu = news8.replace(',', ".");

    var paridad_rendi5 = $('#paridad_rendi7').val();
    var new1 = paridad_rendi5.replace('.', "");
    var new6 = new1.replace('.', "");
    var new7 = new6.replace('.', "");
    var new8 = new7.replace('.', "");
    var paridad_rendi55 = new8.replace(',', ".");
    var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
    var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
    var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
    $('#subtotal_rendi7').val(subtotal_rendi_factura3);



    }
    else if(trimestres7=='3'){
        var cantidades = $('#tercero_b7').val();
        var cantidad1 = cantidades.replace('.', "");
        var cantidad2 = cantidad1.replace('.', "");
        var cantidad3 = cantidad2.replace('.', "");
        var cantidad4 = cantidad3.replace('.', "");
        var cantidad = cantidad4.replace(',', ".");
        //Remplazar decimales para caculos
        var costos = $('#costo_unitario_remd7').val();
        var costos1 = costos.replace('.', "");
        var costos2 = costos1.replace('.', "");
        var costos3 = costos2.replace('.', "");
        var costos4 = costos3.replace('.', "");
        var costos_un = costos4.replace(',', ".");
        
        
        
        var subtotales = Number(cantidad) * Number(costos_un);
        var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
        $('#subt_rend_ejecu7').val(subtotales1);
    
    
        var subt_rend_ejecu = $('#subt_rend_ejecu7').val();
        var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
        var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
        var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
        var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
        var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
        //calculo de Iva Estimado
        var id_alicuota_iva = $('#selc_iva_re7').val();
        var separar = id_alicuota_iva.split("/");
        var porcentaje = separar['0'];
        var monto_iva_estimado = subt_rend_ejecus*porcentaje;
        var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
        var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
        $('#iva_estimado_red7').val(iva_estimado2);

        
        var iva_estimado_red5 = $('#iva_estimado_red7').val();
        var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
        var iva_estimado_red52= iva_estimado_red51.replace('.', "");
        var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
        var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
        var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
    
        //Calculo Monto Total Estimado
            var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi7').val(monto_total_estimado);

        var subt_rend_ejecu2 = $('#subt_rend_ejecu7').val();
        var news1 = subt_rend_ejecu2.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var subt_rend_ejecu = news8.replace(',', ".");

        var paridad_rendi5 = $('#paridad_rendi7').val();
        var new1 = paridad_rendi5.replace('.', "");
        var new6 = new1.replace('.', "");
        var new7 = new6.replace('.', "");
        var new8 = new7.replace('.', "");
        var paridad_rendi55 = new8.replace(',', ".");
        var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
        var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
        var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
        $('#subtotal_rendi7').val(subtotal_rendi_factura3);



    } 
    else if (trimestres7=='4'){
    var cantidades = $('#cuarto_b7').val();
    var cantidad1 = cantidades.replace('.', "");
    var cantidad2 = cantidad1.replace('.', "");
    var cantidad3 = cantidad2.replace('.', "");
    var cantidad4 = cantidad3.replace('.', "");
    var cantidad = cantidad4.replace(',', ".");
    //Remplazar decimales para caculos
    var costos = $('#costo_unitario_remd7').val();
    var costos1 = costos.replace('.', "");
    var costos2 = costos1.replace('.', "");
    var costos3 = costos2.replace('.', "");
    var costos4 = costos3.replace('.', "");
    var costos_un = costos4.replace(',', ".");
    
    
    
    var subtotales = Number(cantidad) * Number(costos_un);
    var subtotales1 = Intl.NumberFormat("de-DE").format(subtotales);
    $('#subt_rend_ejecu7').val(subtotales1);
   
   
    var subt_rend_ejecu = $('#subt_rend_ejecu7').val();
    var subt_rend_ejecu2 = subt_rend_ejecu.replace('.', "");
    var subt_rend_ejecu3= subt_rend_ejecu2.replace('.', "");
    var subt_rend_ejecu4 = subt_rend_ejecu3.replace('.', "");
    var subt_rend_ejecu5 = subt_rend_ejecu4.replace('.', "");
    var subt_rend_ejecus = subt_rend_ejecu5.replace(',', ".");
    //calculo de Iva Estimado
    var id_alicuota_iva = $('#selc_iva_re7').val();
    var separar = id_alicuota_iva.split("/");
    var porcentaje = separar['0'];
    var monto_iva_estimado = subt_rend_ejecus*porcentaje;
    var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
    var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
    $('#iva_estimado_red7').val(iva_estimado2);

      
    var iva_estimado_red5 = $('#iva_estimado_red7').val();
    var iva_estimado_red51 = iva_estimado_red5.replace('.', "");
    var iva_estimado_red52= iva_estimado_red51.replace('.', "");
    var iva_estimado_red53 = iva_estimado_red52.replace('.', "");
    var subt_rend_ejecu54 = iva_estimado_red53.replace('.', "");
    var iva_estimado_red56 = subt_rend_ejecu54.replace(',', ".");
   
    //Calculo Monto Total Estimado
        var monto_total_est = Number(subt_rend_ejecus) + Number(iva_estimado_red56);
        var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
        $('#total_rendi7').val(monto_total_estimado);

    var subt_rend_ejecu2 = $('#subt_rend_ejecu7').val();
    var news1 = subt_rend_ejecu2.replace('.', "");
    var news6 = news1.replace('.', "");
    var news7 = news6.replace('.', "");
    var news8 = news7.replace('.', "");
    var subt_rend_ejecu = news8.replace(',', ".");

    var paridad_rendi5 = $('#paridad_rendi7').val();
    var new1 = paridad_rendi5.replace('.', "");
    var new6 = new1.replace('.', "");
    var new7 = new6.replace('.', "");
    var new8 = new7.replace('.', "");
    var paridad_rendi55 = new8.replace(',', ".");
    var subtotal_rendi_facturas = subt_rend_ejecu/paridad_rendi55;
    var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
    var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
    $('#subtotal_rendi7').val(subtotal_rendi_factura3);



} 

    var base_imponible_rendi52 = $('#base_imponible_rendi7').val();
    var news1 = base_imponible_rendi52.replace('.', "");
    var news6 = news1.replace('.', "");
    var news7 = news6.replace('.', "");
    var news8 = news7.replace('.', "");
    var base_imponible_rendi5 = news8.replace(',', ".");
   
    var paridad_rendi_factura55 = $('#paridad_rendi_factura7').val();
    var new1 = paridad_rendi_factura55.replace('.', "");
    var new6 = new1.replace('.', "");
    var new7 = new6.replace('.', "");
    var new8 = new7.replace('.', "");
    var paridad_rendi_factura5 = new8.replace(',', ".");
    var subtotal_rendi_facturas5 = base_imponible_rendi5/paridad_rendi_factura5;
    var subtotal_rendi_factura25 = parseFloat(subtotal_rendi_facturas5).toFixed(2);
    var subtotal_rendi_factura35 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura25);
    $('#subtotal_rendi_factura7').val(subtotal_rendi_factura35);
    var monto3_rendi = base_imponible_rendi5*0.03;
    var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
    var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
    $('#monto3_rendibines7').val(monto3_rendi3);      
}

function buscar_rif7(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var ccnu_b_m = $('#rif_7').val();

    //console.log(ccnu_b_m);
   // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
    var base_url = '/index.php/Programacion/consultar_contratista';
    $.ajax({
        url:base_url,
        method: 'post',
        data: {ccnu_b_m: ccnu_b_m},
        dataType: 'json',
        success: function(data){
            $('#sel_rif_nombre7').find('option').not(':first').remove();
            $.each(data, function(index, response){
                $('#sel_rif_nombre7').append('<option value="'+response['rifced']+'">'+response['nombre']+'</option>');
            });
        }
    })
}
$("#costo_unitario_remd7").on({
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
$("#paridad_rendi5").on({
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
$("#paridad_rendi7").on({
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
$("#total_pago_rendi7").on({
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
$("#paridad_rendi_factura7").on({
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
$("#base_imponible_rendi7").on({
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

  //////////////Guardar rendicion bienes proyecto
  function rendi_bienes_py(){
        var rendido  = $("#rendid7").val();
        var llenar_trimestre  = $("#llenar_trimestre7").val();

    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de registrar rendición Bienes Proyecto",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
            if (llenar_trimestre == rendido) {
                alert("El trimestre Seleccionado ya fue rendido.")
                }
        //     if (document.guardar_proc_pag.dolar.value.length==0){
        //         alert("No Puede dejar el campo Valor Dolar vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.dolar.focus()
        //         return 0;
        //  } 
        //     if (document.guardar_proc_pag.cantidad_pagar_otra.value.length==0){
        //         alert("No Puede dejar el campo la Cantidad a pagar $ vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.cantidad_pagar_otra.focus()
        //         return 0;
        //  }  
                if (document.rendi_bienespy.llenar_trimestre7.selectedIndex==0){
            alert("Debe seleccionar un Trimestre.")
            document.rendi_bienespy.llenar_trimestre7.focus()
            return 0;
     }
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#rendi_bienespy")[0]);
                       //     var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_bienes_py';
                 var base_url = '/index.php/Programacion/guardar_rendi_bienes_py';
                
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var menj = 'Rendido, Cuando termine la rendicion del trimestre, Debe Enviar al SNC';
                       
                       if (response != '') {
                        swal.fire({
                            title: 'Registro Exitoso ',
                            text: menj ,
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
                        
                    },
                });
            }
        });
    
}
///////////////////servicio proyecto///////////////////////////////////
$("#precio_rend_ejecu8").on({
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
$("#paridad_rendi8").on({
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
$("#monto_factura_rend8").on({
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
$("#paridad_rendi_factura8").on({
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
$("#base_imponible_rendi8").on({
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
$("#total_pago_rendi8").on({
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

//////////////////////////////////modal servicio proyecto
function modal_servi_py(id) {
    var id_p_items = id;
        // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_item_modal_PY_bienes';
        // var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_modalidad';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url4 =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
        // var base_url5 =window.location.origin+'/asnc/index.php/Programacion/llenar_tipo_doc_contrata';
        // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/llenar_comp_resp_social'; 
        // var base_url7 =window.location.origin+'/asnc/index.php/Programacion/llenar_trimestre';       
        var base_url = '/index.php/Programacion/consultar_item_modal_PY_bienes';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url4 = '/index.php/Programacion/consultar_contratista';
         var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';
         var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';
         var base_url7 = '/index.php/Programacion/llenar_trimestre';

    $.ajax({
        url: base_url,
        method: "post",
        data: { id_p_items: id_p_items },
        dataType: "json",
        success: function(data) {
            $('#id_items_b8').val(id);
            $("#id_p_items8").val(id_p_items);
            $("#nombre_proyecto9").val(data["nombre_proyecto"]);
            $("#id_enlace8").val(data["id_enlace"]);
            
            $("#id_obj_comercial8").val(data["id_obj_comercial"]);
            $("#desc_objeto_contrata8").val(data["desc_objeto_contrata"]);
            
            $("#id_programacion8").val(data["id_programacion"]);
             $("#codigopartida_presupuestaria8").val(data["codigopartida_presupuestaria"]);
             $("#desc_partida_presupuestaria8").val(data["desc_partida_presupuestaria"]);
             $("#codigo_ccnu8").val(data["codigo_ccnu"]);
             $("#desc_ccnu8").val(data["desc_ccnu"]);
             $("#id_estado8").val(data["id_estado"]);
             $("#id_fuente_financiamiento8").val(data["id_fuente_financiamiento"]);
             $("#desc_fuente_financiamiento8").val(data["desc_fuente_financiamiento"]);
             
             $("#porcentaje8").val(data["porcentaje"]);            
            $("#especificacion8").val(data["especificacion"]);
            $('#id_unid_med_b8').val(data['id_unidad_medida']);
            $('#unid_med_b8').val(data['desc_unidad_medida']);
            $('#rendido8').val(data['descripcion_trimestre']);
            $('#rendid8').val(data['trimestre']);
        
            $('#primero_b8').val(data['i']);
            $('#segundo_b8').val(data['ii']);
            $('#tercero_b8').val(data['iii']);
            $('#cuarto_b8').val(data['iv']);
            
            $('#costo_unitario_mod_b8').val(data['costo_unitario']);
            $('#precio_total_mod_b8').val(data['precio_total']);
            $('#ali_iva_e_b8').val(data['alicuota_iva']);
            $('#iva_estimado_mod_b8').val(data['iva_estimado']);
            $('#monto_estimado_mod_b8').val(data['monto_estimado']);

            $('#estimado_primer8').val(data['est_trim_1']);
            $('#estimado_segundo8').val(data['est_trim_2']);
            $('#estimado_tercer8').val(data['est_trim_3']);
            $('#estimado_cuarto8').val(data['est_trim_4']);
            $('#estimado_total_t_mod8').val(data['estimado_total_t_acc']);
            $('#fecha_desde8').val(data['fecha_desde']);
            $('#fecha_hasta8').val(data['fecha_hasta']);
            
          
          
           

            // llena el selectde trimestre
$.ajax({
    url:base_url7,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#llenar_trimestre8').append('<option value="'+data['id_trimestre']+'">'+data['descripcion_trimestre']+'</option>');
        });
    }
})
// llena el selectde modalidad
var rifced = data['rifced'];
$.ajax({
    url:base_url4,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#rif_rendi8').append('<option value="'+data['rifced']+'">'+data['rifced']+'</option>');
        });
    }
})
// llena el selectde cotratista
var id = data['id'];
$.ajax({
    url:base_url2,
    method: 'post',
    data: {id: id},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#modalida_rendi8').append('<option value="'+data['id']+'">'+data['descripcion']+'</option>');
        });
    }
})

// llena el select de unidad de medida
            var id_unid_med = data['id_unidad_medida'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_unid_med: id_unid_med},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#camb_unid_medi_b8').append('<option value="'+data['id_unidad_medida']+'">'+data['desc_unidad_medida']+'</option>');
                    });
                }
            })


//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_unid_med: id_unid_med},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi8').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva2 = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_alic_iva2: id_alic_iva2},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi28').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

// llena el selectde tipo_doc_contrato
var id1 = data['id'];
$.ajax({
    url:base_url5,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_tipo_doc_contrata8').append('<option value="'+data['id_tipo_doc_contrata']+'">'+data['desc_tipo_doc_contrata']+'</option>');
        });
    }
})
// llena el select de COMPROMISO DE RESPONSABILIDAD SOCIAL
var id1 = data['id'];
$.ajax({
    url:base_url6,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_com_res_social8').append('<option value="'+data['id_comp_resp_social']+'">'+data['desc_comp_resp_social']+'</option>');
        });
    }
})
        },
    });
}



function calculos_rendi_servicio_py(){

    //Remplazar decimales para caculos
    var precio_total = $('#precio_rend_ejecu8').val();
    var newstr = precio_total.replace('.', "");
    var newstr2 = newstr.replace('.', "");
    var newstr3 = newstr2.replace('.', "");
    var newstr4 = newstr3.replace('.', "");
    var precio = newstr4.replace(',', ".");

//calculo de Iva Estimado
    var id_alicuota_iva = $('#selc_iva_rendi8').val();
    var separar = id_alicuota_iva.split("/");
    var porcentaje = separar['0'];
    var monto_iva_estimado = precio*porcentaje;
    var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
    var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
    $('#iva_estimado_rend8').val(iva_estimado2);

//Calculo Monto Total Estimado
    var monto_total_est = Number(precio) + Number(iva_estimado);
    var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
    $('#total_rendi8').val(monto_total_estimado);



    //Remplazar decimales para caculos
    var precio_total = $('#precio_rend_ejecu8').val();
    var newstr = precio_total.replace('.', "");
    var newstr2 = newstr.replace('.', "");
    var newstr3 = newstr2.replace('.', "");
    var newstr4 = newstr3.replace('.', "");
    var precio = newstr4.replace(',', ".");

        //calculo de paridad
        var paridad_rendi = $('#paridad_rendi8').val();
        var newstr1 = paridad_rendi.replace('.', "");
        var newstr6 = newstr1.replace('.', "");
        var newstr7 = newstr6.replace('.', "");
        var newstr8 = newstr7.replace('.', "");
        var paridad = newstr8.replace(',', ".");

            var subtotal = precio/paridad;
            var subtoral = parseFloat(subtotal).toFixed(2);
            var subtoral2 = Intl.NumberFormat("de-DE").format(subtoral);
            $('#subtotal_rendi8').val(subtoral2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi8').val(monto_total_estimado);

        //Remplazar decimales para caculos
        var montofactura = $('#monto_factura_rend8').val();
        var newst1 = montofactura.replace('.', "");
        var newst5 = newst1.replace('.', "");
        var newst6 = newst5.replace('.', "");
        var newst7 = newst6.replace('.', "");
        var montofactura1 = newst7.replace(',', ".");
        //calculo de Iva Estimado2
        var id_alicuota_iva3 = $('#selc_iva_rendi2').val();
        var separar1 = id_alicuota_iva3.split("/");
        var porcentaje1 = separar1['0'];
        var monto_iva_estimado2 = montofactura1*porcentaje1;
        var iva_estimado3 = parseFloat(monto_iva_estimado2).toFixed(2);
        var iva_estimado4 = Intl.NumberFormat("de-DE").format(iva_estimado3);

//////////paridad factura
       
        var paridad_rendi_factura = $('#paridad_rendi_factura8').val();
        var news1 = paridad_rendi_factura.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var paridad_rendi_factura2 = news8.replace(',', ".");
        
        var base_imponible_rendi = $('#base_imponible_rendi8').val();
        var new1 = base_imponible_rendi.replace('.', "");
        var new6 = new1.replace('.', "");
        var new7 = new6.replace('.', "");
        var new8 = new7.replace('.', "");
        var base_imponible_rendi = new8.replace(',', ".");



            var subtotal_rendi_factura = base_imponible_rendi/paridad_rendi_factura2;
            var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_factura).toFixed(2);
            var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
            $('#subtotal_rendi_factura8').val(subtotal_rendi_factura3);




            var monto3_rendi = base_imponible_rendi*0.03;
            var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
            var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
            $('#monto3_rendi8').val(monto3_rendi3);
        
           

           
           
            
    }

    function buscar_rif8(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
        var ccnu_b_m = $('#rif_nombre8').val();
    
        //console.log(ccnu_b_m);
      //  var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
        var base_url = '/index.php/Programacion/consultar_contratista';
        $.ajax({
            url:base_url,
            method: 'post',
            data: {ccnu_b_m: ccnu_b_m},
            dataType: 'json',
            success: function(data){
                $('#sel_rif_nombre8').find('option').not(':first').remove();
                $.each(data, function(index, response){
                    $('#sel_rif_nombre8').append('<option value="'+response['rifced']+'">'+response['nombre']+'</option>');
                });
            }
        })
    }

    function check(e) {
        tecla = (document.all) ? e.keyCode : e.which;
    
        //Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            return true;
        }
    
        // Patrón de entrada, en este caso solo acepta numeros y letras
        patron = /[A-Za-z0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }

    //////////////Guardar rendicion servicio py
function guardar_rendi_servicio_py(){
    var rendido  = $("#rendid8").val();
    var llenar_trimestre  = $("#llenar_trimestre8").val();

    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de registrar rendición",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
            if (llenar_trimestre == rendido) {
                alert("El trimestre Seleccionado ya fue rendido.")
                }
        //     if (document.guardar_proc_pag.dolar.value.length==0){
        //         alert("No Puede dejar el campo Valor Dolar vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.dolar.focus()
        //         return 0;
        //  } 
        //     if (document.guardar_proc_pag.cantidad_pagar_otra.value.length==0){
        //         alert("No Puede dejar el campo la Cantidad a pagar $ vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.cantidad_pagar_otra.focus()
        //         return 0;
        //  }  
            	if (document.serviciopy.llenar_trimestre8.selectedIndex==0){
            alert("Debe seleccionar un Trimestre.")
            document.serviciopy.llenar_trimestre8.focus()
            return 0;
     }
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#serviciopy")[0]);
                        //    var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_servicio_py';
                 var base_url = '/index.php/Programacion/guardar_rendi_servicio_py';
                
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var menj = 'Rendido';
                       
                       if (response != '') {
                        swal.fire({
                            title: 'Registro Exitoso ',
                            text: menj ,
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
                        
                    },
                });
            }
        });
    
}

//////modal obras PY //////////////////////////////////////////////////////////////////////
function modal_obraspy(id) {
    var id_p_items = id;
        // var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_item_modal_PY_bienes';
        // var base_url2 =window.location.origin+'/asnc/index.php/Programacion/llenar_modalidad';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url4 =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
        // var base_url5 =window.location.origin+'/asnc/index.php/Programacion/llenar_tipo_doc_contrata';
        // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/llenar_comp_resp_social'; 
        // var base_url7 =window.location.origin+'/asnc/index.php/Programacion/llenar_trimestre';       
        var base_url = '/index.php/Programacion/consultar_item_modal_PY_bienes';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url4 = '/index.php/Programacion/consultar_contratista';
         var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';
         var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';
         var base_url7 = '/index.php/Programacion/llenar_trimestre';

    $.ajax({
        url: base_url,
        method: "post",
        data: { id_p_items: id_p_items },
        dataType: "json",
        success: function(data) {
            $('#id_items_b9').val(id);
            $("#id_p_items9").val(id_p_items);
        
            $("#id_enlace9").val(data["id_enlace"]);
            $("#nombre_proyecto10").val(data["nombre_proyecto"]);
            $("#desc_objeto_contrata9").val(data["desc_objeto_contrata"]);
            $("#id_obj_comercial9").val(data["id_obj_comercial"]);
            $("#id_tip_obra9").val(data["id_tip_obra"]);
            $("#id_alcance_obra9").val(data["id_alcance_obra"]);
            $("#id_obj_obra9").val(data["id_obj_obra"]);
            $("#descripcion_tip_obr9").val(data["descripcion_tip_obr"]);
            $("#descripcion_alcance_obra9").val(data["descripcion_alcance_obra"]);
            $("#descripcion_obj_obra9").val(data["descripcion_obj_obra"]);
            $("#id_programacion9").val(data["id_programacion"]);
             $("#codigopartida_presupuestaria9").val(data["codigopartida_presupuestaria"]);
             $("#desc_partida_presupuestaria9").val(data["desc_partida_presupuestaria"]);
             $("#codigo_ccnu9").val(data["codigo_ccnu"]);
             $("#desc_ccnu9").val(data["desc_ccnu"]);
             $("#id_estado9").val(data["id_estado"]);
             $("#id_fuente_financiamiento9").val(data["id_fuente_financiamiento"]);
             $("#desc_fuente_financiamiento9").val(data["desc_fuente_financiamiento"]);
             $("#porcentaje9").val(data["porcentaje"]);            
            $("#especificacion9").val(data["especificacion"]);
            $('#id_unid_med_b9').val(data['id_unidad_medida']);
            $('#unid_med_b9').val(data['desc_unidad_medida']);
            $('#rendido9').val(data['descripcion_trimestre']);
            $('#rendid9').val(data['trimestre']);

            $('#cantidad_mod_b9').val(data['cantidad']);
            $('#primero_b9').val(data['i']);
            $('#segundo_b9').val(data['ii']);
            $('#tercero_b9').val(data['iii']);
            $('#cuarto_b3').val(data['iv']);
            $('#cant_total_distribuir_mod_b9').val(data['cant_total_distribuir']);

            $('#costo_unitario_mod_b9').val(data['costo_unitario']);
            $('#precio_total_mod_b9').val(data['precio_total']);
            $('#ali_iva_e_b9').val(data['alicuota_iva']);
            $('#iva_estimado_mod_b9').val(data['iva_estimado']);
            $('#monto_estimado_mod_b9').val(data['monto_estimado']);

            $('#estimado_primer9').val(data['est_trim_1']);
            $('#estimado_segundo9').val(data['est_trim_2']);
            $('#estimado_tercer9').val(data['est_trim_3']);
            $('#estimado_cuarto9').val(data['est_trim_4']);
            $('#estimado_total_t_mod9').val(data['estimado_total_t_acc']);
            $('#fecha_desde9').val(data['fecha_desde']);
            $('#fecha_hasta9').val(data['fecha_hasta']);
            
          
          
           

            // llena el selectde trimestre
$.ajax({
    url:base_url7,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#llenar_trimestre9').append('<option value="'+data['id_trimestre']+'">'+data['descripcion_trimestre']+'</option>');
        });
    }
})
// llena el selectde modalidad
var rifced = data['rifced'];
$.ajax({
    url:base_url4,
    method: 'post',
    data: {rifced: rifced},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#rif_rendi9').append('<option value="'+data['rifced']+'">'+data['rifced']+'</option>');
        });
    }
})
// llena el selectde cotratista
var id = data['id'];
$.ajax({
    url:base_url2,
    method: 'post',
    data: {id: id},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#modalida_rendi9').append('<option value="'+data['id']+'">'+data['descripcion']+'</option>');
        });
    }
})

// llena el select de unidad de medida
            var id_unid_med = data['id_unidad_medida'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_unid_med: id_unid_med},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#camb_unid_medi_b9').append('<option value="'+data['id_unidad_medida']+'">'+data['desc_unidad_medida']+'</option>');
                    });
                }
            })


//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_unid_med: id_unid_med},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi9').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

//FUNCIO PARA LLENAR EL SELECT DE ALICUOTA IVA
var id_alic_iva2 = data['alicuota_iva'];
$.ajax({
    url:base_url3,
    method: 'post',
    data: {id_alic_iva2: id_alic_iva2},
    dataType: 'json',
    success: function(data){
        console.log(data);
        $.each(data, function(index, data){
            $('#selc_iva_rendi99').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
        });
    }
})

// llena el selectde tipo_doc_contrato
var id1 = data['id'];
$.ajax({
    url:base_url5,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_tipo_doc_contrata9').append('<option value="'+data['id_tipo_doc_contrata']+'">'+data['desc_tipo_doc_contrata']+'</option>');
        });
    }
})
// llena el select de COMPROMISO DE RESPONSABILIDAD SOCIAL
var id1 = data['id'];
$.ajax({
    url:base_url6,
    method: 'post',
    data: {id1: id1},
    dataType: 'json',
    success: function(data){
        $.each(data, function(index, data){
            $('#selc_com_res_social9').append('<option value="'+data['id_comp_resp_social']+'">'+data['desc_comp_resp_social']+'</option>');
        });
    }
})
        },
    });
}

function buscar_rif9(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var ccnu_b_m = $('#rif_nombre9').val();

    //console.log(ccnu_b_m);
    //var base_url =window.location.origin+'/asnc/index.php/Programacion/consultar_contratista';
    var base_url = '/index.php/Programacion/consultar_contratista';
    $.ajax({
        url:base_url,
        method: 'post',
        data: {ccnu_b_m: ccnu_b_m},
        dataType: 'json',
        success: function(data){
            $('#sel_rif_nombre9').find('option').not(':first').remove();
            $.each(data, function(index, response){
                $('#sel_rif_nombre9').append('<option value="'+response['rifced']+'">'+response['nombre']+'</option>');
            });
        }
    })
}
 //////////////Guardar rendicion obras Py
 function rendirobraspy(){
    
    var rendido  = $("#rendid9").val();
    var llenar_trimestre  = $("#llenar_trimestre9").val();

    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de registrar rendición ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
            if (llenar_trimestre == rendido) {
                alert("El trimestre Seleccionado ya fue rendido.")
                }
        //     if (document.guardar_proc_pag.dolar.value.length==0){
        //         alert("No Puede dejar el campo Valor Dolar vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.dolar.focus()
        //         return 0;
        //  } 
        //     if (document.guardar_proc_pag.cantidad_pagar_otra.value.length==0){
        //         alert("No Puede dejar el campo la Cantidad a pagar $ vacio, Ingrese un Monto")
        //         document.guardar_proc_pag.cantidad_pagar_otra.focus()
        //         return 0;
        //  }  
            	if (document.obrapy1.llenar_trimestre9.selectedIndex==0){
            alert("Debe seleccionar un Trimestre.")
            document.obrapy1.llenar_trimestre9.focus()
            return 0;
     }
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#obrapy1")[0]);
                       //     var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_obr_py';
                 var base_url = '/index.php/Programacion/guardar_rendi_obr_py';
                
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var menj = 'Rendido';
                       
                       if (response != '') {
                        swal.fire({
                            title: 'Registro Exitoso ',
                            text: menj ,
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
                        
                    },
                });
            }
        });
    
}

function calculos_rendi_obritaspy(){

  
 

        //Remplazar decimales para caculos
            var precio_total = $('#precio_rend_ejecu9').val();
            var newstr = precio_total.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

        //calculo de Iva Estimado
            var id_alicuota_iva = $('#selc_iva_rendi9').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = separar['0'];
            var monto_iva_estimado = precio*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado2 = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado_rend9').val(iva_estimado2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi9').val(monto_total_estimado);



            //Remplazar decimales para caculos
            var precio_total = $('#precio_rend_ejecu9').val();
            var newstr = precio_total.replace('.', "");
            var newstr2 = newstr.replace('.', "");
            var newstr3 = newstr2.replace('.', "");
            var newstr4 = newstr3.replace('.', "");
            var precio = newstr4.replace(',', ".");

        //calculo de paridad
        var paridad_rendi = $('#paridad_rendi9').val();
        var newstr1 = paridad_rendi.replace('.', "");
        var newstr6 = newstr1.replace('.', "");
        var newstr7 = newstr6.replace('.', "");
        var newstr8 = newstr7.replace('.', "");
        var paridad = newstr8.replace(',', ".");

            var subtotal = precio/paridad;
            var subtoral = parseFloat(subtotal).toFixed(2);
            var subtoral2 = Intl.NumberFormat("de-DE").format(subtoral);
            $('#subtotal_rendi9').val(subtoral2);

        //Calculo Monto Total Estimado
            var monto_total_est = Number(precio) + Number(iva_estimado);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_est);
            $('#total_rendi9').val(monto_total_estimado);

        //Remplazar decimales para caculos
        var montofactura6 = $('#monto_factura_rend9').val();
        var newst1 = montofactura6.replace('.', "");
        var newst5 = newst1.replace('.', "");
        var newst6 = newst5.replace('.', "");
        var newst7 = newst6.replace('.', "");
        var montofactura8 = newst7.replace(',', ".");
        //calculo de Iva Estimado2
        var id_alicuota_iva3 = $('#selc_iva_rendi99').val();
        var separar1 = id_alicuota_iva3.split("/");
        var porcentaje1 = separar1['0'];
        var monto_iva_estimado2 = montofactura8*porcentaje1;
        var iva_estimado3 = parseFloat(monto_iva_estimado2).toFixed(2);
        var iva_estimado8 = Intl.NumberFormat("de-DE").format(iva_estimado3);
      //  $('#iva_estimado_rend').val(iva_estimado4);

        // var monto_tolest = Number(montofactura8) + Number(iva_estimado8);
        // var monto_total__es = Intl.NumberFormat("de-DE").format(monto_tolest);
        // $('#total_pago_rendi3').val(monto_total__es);
            //////////paridad factura
       
        var paridad_rendi_facturas = $('#paridad_rendi_factura9').val();
        var news1 = paridad_rendi_facturas.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var paridad_rendi_factura22 = news8.replace(',', ".");
        
        var base_imponible_rendis = $('#base_imponible_rendi9').val();
        var new1 = base_imponible_rendis.replace('.', "");
        var new6 = new1.replace('.', "");
        var new7 = new6.replace('.', "");
        var new8 = new7.replace('.', "");
        var base_imponible_rendis = new8.replace(',', ".");



            var subtotal_rendi_facturas = base_imponible_rendis/paridad_rendi_factura22;
            var subtotal_rendi_factura2 = parseFloat(subtotal_rendi_facturas).toFixed(2);
            var subtotal_rendi_factura3 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura2);
            $('#subtotal_rendi_factura9').val(subtotal_rendi_factura3);




            var monto3_rendi = base_imponible_rendis*0.03;
            var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
            var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
            $('#monto3_rendi99').val(monto3_rendi3);
        
           

           
           
            
    }

    $("#precio_rend_ejecu9").on({
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
    $("#paridad_rendi9").on({
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
    $("#monto_factura_rend9").on({
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
    $("#paridad_rendi_factura9").on({
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
    $("#base_imponible_rendi9").on({
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
    $("#total_pago_rendi9").on({
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