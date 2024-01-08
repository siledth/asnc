$('#matricular').on('select2:select', function (e) {
    var id_p_items = e.params.data['id'];
   
        var base_url = '/index.php/Programacion/tolist_info';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';
    
        var base_url4 = '/index.php/Programacion/consultar_contratista';
         var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';
         
         var base_url7 = '/index.php/Programacion/llenar_trimestre';

    
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_p_items: id_p_items },
        dataType: "json",

        success: function(response) {
            $("#nombre_a").val(response["desc_ccnu"]);
            $("#id_p_items5").val(id_p_items);
            $("#id_accion_centralizada5").val(response["id_accion_centralizada"]);
            $("#id_enlace5").val(response["id_enlace"]);
            $("#desc_accion_centralizada5").val(response["desc_accion_centralizada"]);
            $("#id_obj_comercial5").val(response["id_obj_comercial"]);
            $("#id_obj_comercial5").val(response["id_obj_comercial"]);
            $("#desc_objeto_contrata5").val(response["desc_objeto_contrata"]);            
            $("#id_programacion5").val(response["id_programacion"]);
            $("#id_estado5").val(response["id_estado"]);
            $("#id_fuente_financiamiento5").val(response["id_fuente_financiamiento"]);
            $("#desc_fuente_financiamiento5").val(response["desc_fuente_financiamiento"]);
            $("#codigopartida_presupuestaria5").val(response["codigopartida_presupuestaria"]);
            $("#desc_partida_presupuestaria5").val(response["desc_partida_presupuestaria"]);
            $("#especificacion5").val(response["especificacion"]);
            $('#id_unid_med_b5').val(response['id_unidad_medida']);
            $('#unid_med_b5').val(response['desc_unidad_medida']);
            $('#cantidad_mod_b5').val(response['cantidad']);
            $('#primero_b5').val(response['i']);
            $('#segundo_b5').val(response['ii']);
            $('#tercero_b5').val(response['iii']);
            $('#cuarto_b5').val(response['iv']);
            $('#costo_unitario_mod_b5').val(response['costo_unitario']);
            $('#subtbd').val(response['precio_total']);
            $('#precio_total_mod_b5').val(response['precio_total']);
            $('#ali_iva_e_b5').val(response['alicuota_iva']);
            $('#iva_estimado_mod_b5').val(response['iva_estimado']);
            $('#monto_estimado_mod_b5').val(response['monto_estimado']);
            $('#estimado_primer5').val(response['est_trim_1']);
            $('#estimado_segundo5').val(response['est_trim_2']);
            $('#estimado_tercer5').val(response['est_trim_3']);
            $('#estimado_cuarto5').val(response['est_trim_4']);
            $('#estimado_total_t_mod5').val(response['estimado_total_t_acc']);

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

           
          
        },
    });
});

function consultar_rif(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var rif_b = $('#rif_b').val();
    if (rif_b == ''){
        swal({
            title: "¡ATENCION!",
            text: "El campo no puede estar vacio.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#ueba').attr("disabled", true);
    }else{
        $("#items").show();
        // var base_url  = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista';
        // var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

      var base_url = '/index.php/evaluacion_desempenio/llenar_contratista';
        var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

        $.ajax({
            url:base_url,
            method: 'post',
            data: {rif_b: rif_b},
            dataType: 'json',
            success: function(data){
                if (data == null) {
                    $("#no_existe").show();
                    $("#existe").hide();

                   // $('#exitte').val(0);

                }else{
                    $("#existe").show();
                    $("#no_existe").hide();                  

                    $('#sel_rif_nombre5').val(data['rifced']);
                    $('#nombre_conta_5').val(data['nombre']);
                    

                    var rif_cont_nr = data['rifced'];
                    var ultprocaprob = data['ultprocaprob'];
                    $.ajax({
                        url:base_url2,
                        method: 'post',
                        data: {ultprocaprob: ultprocaprob,
                              rif_cont_nr: rif_cont_nr},
                        dataType: 'json',
                        success: function(data){
                            $.each(data, function(index, response){
                            });
                        }
                    });
                }
            }
        })
    }
}
function llenar_factura5() {
    var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
    var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';
    var factura = $("#facturacion5").val();
    if (factura <= "1") {
        $("#campos3").show();
    } else {
        $("#campos3").hide();
    }


    var id_alic_iva2 = 1;
    $.ajax({
        url:base_url3,
        method: 'post',
        data: {id_alic_iva2: id_alic_iva2},
        dataType: 'json',
        success: function(data){
         //   console.log(data);
            $.each(data, function(index, data){
                $('#selc_iva_rendi55').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
            });
        }
    })

    var id1 = 1;
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


}
function calculos_rendi_bienessacc(){
    var trimestres7 = $('#llenar_trimestre5').val();
    
        var cantidades = $('#cantidad_rendi5').val();
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
        var id_alicuota_iva = $('#selc_iva_ret').val();
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
    
    


        var base_imponible_rendi52 = $('#base_imponible_rendi5').val();
        var news1 = base_imponible_rendi52.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var base_imponible_rendi5 = news8.replace(',', ".");
        
        var selc_iva_rendi55 = $('#selc_iva_rendi55').val();
        var separar1 = selc_iva_rendi55.split("/");
        var porcentaje1 = separar1['0'];
            // calcular  monto_factura_rend5
        var monto_factura_rend55 = base_imponible_rendi5*porcentaje1;
        var monto_factura_rend500 = parseFloat(monto_factura_rend55).toFixed(2);
        var monto_factura_rend501 = Intl.NumberFormat("de-DE").format(monto_factura_rend500);
        $('#monto_factura_rend5').val(monto_factura_rend501);

        // calculo total pago
        

    
        var montoend5 = $('#monto_factura_rend5').val();
        var montoend51 = montoend5.replace('.', "");
        var montoend52= montoend51.replace('.', "");
        var montoend53 = montoend52.replace('.', "");
        var montoend54 = montoend53.replace('.', "");
        var montoend55 = montoend54.replace(',', "."); //hasta aca para poder sumar '??
       
         //Calculo total pago
         var total_pago_rendi51 = Number(base_imponible_rendi5) + Number(montoend55);
         var total_pago_rendi52 = Intl.NumberFormat("de-DE").format(total_pago_rendi51);
         $('#total_pago_rendi5').val(total_pago_rendi52);


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





        // var monto3_rendi = base_imponible_rendi5*0.03;
        // var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
        // var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
        // $('#monto3_rendibines').val(monto3_rendi3);
        
        
            
    }
function llenar() {
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';

         
    
    
        var id_alic_iva2 = 1;
        $.ajax({
            url:base_url3,
            method: 'post',
            data: {id_alic_iva2: id_alic_iva2},
            dataType: 'json',
            success: function(data){
             //   console.log(data);
                $.each(data, function(index, data){
                    $('#selc_iva_ret').append('<option value="'+data['desc_alicuota_iva']+'">'+data['desc_porcentaj']+'</option>');
                });
            }
        })
    
        var id1 = 1;
        $.ajax({
            url:base_url2,
            method: 'post',
            data: {id1: id1},
            dataType: 'json',
            success: function(data){
                $.each(data, function(index, data){
                    $('#modalida_rendi5').append('<option value="'+data['id']+'">'+data['descripcion']+'</option>');
                });
            }
        })
    
    
    }
    function llenar_sub_mod5(){
        var id_modalidad = $('#modalida_rendi5').val();
        // var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_sub_modalidad';
        var base_url = '/index.php/evaluacion_desempenio/llenar_sub_modalidad';
    
        $.ajax({
            url: base_url,
            method:'post',
            data: {id_modalidad: id_modalidad},
            dataType:'json',
            
            success: function(response){
                $('#id_sub_modalidad5').find('option').not(':first').remove();
                $.each(response, function(index, data){
                    $('#id_sub_modalidad5').append('<option value="'+data['descripcion']+'">'+data['descripcion']+'</option>');
                });
            }
        });
        var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';

        var id1 = 1;
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
    }

    $("#monto3_rendibines").on({
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