$('#ccnu').on('select2:select', function (e) {
    var id_p_items = e.params.data['id'];
               
   
        var base_url = '/index.php/Programacion/tolist_info_py';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';    

    $.ajax({
        url: base_url,
        method: "post",
        data: { id_p_items: id_p_items },
        dataType: "json",

        success: function(response) {
            $("#desc_ccnu7").val(response["desc_ccnu"]);
            $("#codigo_ccnu7").val(response["codigo_ccnu"]);

             $("#id_p_items7").val(id_p_items);
             $("#id_enlace7").val(response["id_enlace"]);
             $("#id_p_proyecto7").val(response["id_p_proyecto"]);
             $("#nombre_proyecto7").val(response["nombre_proyecto"]);
             $("#id_obj_comercial7").val(response["id_obj_comercial"]);
             $("#desc_objeto_contrata7").val(response["desc_objeto_contrata"]);            
             $("#id_proyecto7").val(response["id_proyecto"]);
             $("#id_estado7").val(response["id_estado"]);
             $("#id_fuente_financiamiento7").val(response["id_fuente_financiamiento"]);
             $("#desc_fuente_financiamiento7").val(response["desc_fuente_financiamiento"]);
             $("#codigopartida_presupuestaria7").val(response["codigopartida_presupuestaria"]);
             $("#desc_partida_presupuestaria7").val(response["desc_partida_presupuestaria"]);
             $("#especificacion7").val(response["especificacion"]);
             $('#id_unid_med_b7').val(response['id_unidad_medida']);
             $('#unid_med_b7').val(response['desc_unidad_medida']);
            
             $('#cantidad_mod_b7').val(response['cantidad']);
            $('#primero_b7').val(response['i']);
            $('#segundo_b7').val(response['ii']);
            $('#tercero_b7').val(response['iii']);
            $('#cuarto_b7').val(response['iv']);
            $('#costo_unitario_mod_b7').val(response['costo_unitario']);
            $('#subtb7').val(response['precio_total']);
            $('#precio_total_mod_b7').val(response['precio_total']);
            $('#ali_iva_e_b7').val(response['alicuota_iva']);
            $('#iva_estimado_mod_b7').val(response['iva_estimado']);
            $('#monto_estimado_mod_b7').val(response['monto_estimado']);
            $('#estimado_primer7').val(response['est_trim_1']);
            $('#estimado_segundo7').val(response['est_trim_2']);
            $('#estimado_tercer7').val(response['est_trim_3']);
            $('#estimado_cuarto7').val(response['est_trim_4']);
            $('#estimado_total_t_mod7').val(response['estimado_total_t_acc']);
            $("#id_tip_obra7").val(response["id_tip_obra"]);
            $("#id_alcance_obra7").val(response["id_alcance_obra"]);
            $("#id_obj_obra7").val(response["id_obj_obra"]);
            $("#descripcion_tip_obr7").val(response["descripcion_tip_obr"]);
            $("#descripcion_alcance_obra7").val(response["descripcion_alcance_obra"]);
            $("#descripcion_obj_obra7").val(response["descripcion_obj_obra"]);
             $('#fecha_desde7').val(response['fecha_desde']);
             $('#fecha_hasta7').val(response['fecha_hasta']);

            

           
          
        },
    });
});

function calculos_rendi_py(){
    
        var cantidades = $('#cantidad_rendi7').val();
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
        var id_alicuota_iva = $('#selc_iva_ret7').val();
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
    
    


        var base_imponible_rendi52 = $('#base_imponible_rendi7').val();
        var news1 = base_imponible_rendi52.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var base_imponible_rendi5 = news8.replace(',', ".");
        
        var selc_iva_rendi55 = $('#selc_iva_rendi7').val();
        var separar1 = selc_iva_rendi55.split("/");
        var porcentaje1 = separar1['0'];
            // calcular  monto_factura_rend5
        var monto_factura_rend55 = base_imponible_rendi5*porcentaje1;
        var monto_factura_rend500 = parseFloat(monto_factura_rend55).toFixed(2);
        var monto_factura_rend501 = Intl.NumberFormat("de-DE").format(monto_factura_rend500);
        $('#monto_factura_rend7').val(monto_factura_rend501);

        // calculo total pago
        

    
        var montoend5 = $('#monto_factura_rend7').val();
        var montoend51 = montoend5.replace('.', "");
        var montoend52= montoend51.replace('.', "");
        var montoend53 = montoend52.replace('.', "");
        var montoend54 = montoend53.replace('.', "");
        var montoend55 = montoend54.replace(',', "."); //hasta aca para poder sumar '??
       
         //Calculo total pago
         var total_pago_rendi51 = Number(base_imponible_rendi5) + Number(montoend55);
         var total_pago_rendi52 = Intl.NumberFormat("de-DE").format(total_pago_rendi51);
         $('#total_pago_rendi7').val(total_pago_rendi52);


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





        // var monto3_rendi = base_imponible_rendi5*0.03;
        // var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
        // var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
        // $('#monto3_rendibines').val(monto3_rendi3);
        
        
            
    }

function llenar7() {
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url2 = '/index.php/Programacion/llenar_modalidad';

         
    
    
        var id_alic_iva2 = 1;
        $.ajax({
            url: base_url3,
            method: 'post',
            data: { id_alic_iva2: id_alic_iva2 },
            dataType: 'json',
            success: function(data) {
                $('#selc_iva_ret7').empty();
                $('#selc_iva_ret7').append('<option value="0">Seleccione</option>');
                $.each(data, function(index, data) {
                    $('#selc_iva_ret7').append('<option value="' + data['desc_alicuota_iva'] + '">' + data['desc_porcentaj'] + '</option>');
                });
            }
        });
    
        var id1 = 1;
       
        $.ajax({
            url: base_url2,
            method: 'post',
            data: { id1: id1 },
            dataType: 'json',
            success: function(data) {
                $('#modalida_rendi7').empty();
                $('#modalida_rendi7').append('<option value="0">Seleccione</option>');
                $.each(data, function(index, data) {
                    $('#modalida_rendi7').append('<option value="' + data['id'] + '">' + data['descripcion'] + '</option>');
                });
            }
        });
    
    
    }
    function llenar_sub_mod7(){
        var id_modalidad = $('#modalida_rendi7').val();
        
        // var base_url = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_sub_modalidad';
        var base_url = '/index.php/evaluacion_desempenio/llenar_sub_modalidad';
    
        $.ajax({
            url: base_url,
            method:'post',
            data: {id_modalidad: id_modalidad},
            dataType:'json',
            
            success: function(response){
                $('#id_sub_modalidad7').find('option').not(':first').remove();
                $.each(response, function(index, data){
                    $('#id_sub_modalidad7').append('<option value="'+data['descripcion']+'">'+data['descripcion']+'</option>');
                });
            }
        });
        
        var base_url5 = '/index.php/Programacion/llenar_tipo_doc_contrata';

        var id1 = 1;
        $.ajax({
            url: base_url5,
            method: 'post',
            data: { id1: id1 },
            dataType: 'json',
            success: function(data) {
                $('#selc_tipo_doc_contrata7').empty();
                $('#selc_tipo_doc_contrata7').append('<option value="0">Seleccione</option>');
                $.each(data, function(index, data) {
                    $('#selc_tipo_doc_contrata7').append('<option value="' + data['id_tipo_doc_contrata'] + '">' + data['desc_tipo_doc_contrata'] + '</option>');
                });
            }
        });
    }

    function consultar_rif7(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
        var rif_b = $('#rif_b7').val();
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
    
          var base_url = '/index.php/evaluacion_desempenio/llenar_contratista_2';
            var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';
    
            $.ajax({
                url:base_url,
                method: 'post',
                data: {rif_b: rif_b},
                dataType: 'json',
                success: function(data){
                    if (data == null) {
                        $("#no_existe1").show();
                        $("#existe1").hide();
    
                       // $('#exitte').val(0);
    
                    }else{
                        $("#existe1").show();
                        $("#no_existe1").hide();                  
    
                        $('#sel_rif_nombre7').val(data['rifced']);
                        $('#nombre_conta_7').val(data['nombre']);
                        
    
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

    function llenar_factura7() {
        var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';
        var factura = $("#facturacion7").val();
        if (factura <= "1") {
            $("#campos7").show();
        } else {
            $("#campos7").hide();
        }
    
    
        var id_alic_iva2 = 1;
        
        $.ajax({
            url: base_url3,
            method: 'post',
            data: { id_alic_iva2: id_alic_iva2 },
            dataType: 'json',
            success: function(data) {
                $('#selc_iva_rendi7').empty();
                $('#selc_iva_rendi7').append('<option value="0">Seleccione</option>');
                $.each(data, function(index, data) {
                    $('#selc_iva_rendi7').append('<option value="' + data['desc_alicuota_iva'] + '">' + data['desc_porcentaj'] + '</option>');
                });
            }
        });
        
    
        var id1 = 1;
     
        $.ajax({
            url: base_url6,
            method: 'post',
            data: { id1: id1 },
            dataType: 'json',
            success: function(data) {
                $('#selc_com_res_social7').empty();
                $('#selc_com_res_social7').append('<option value="0">Seleccione</option>');
                $.each(data, function(index, data) {
                    $('#selc_com_res_social7').append('<option value="' + data['id_comp_resp_social'] + '">' + data['desc_comp_resp_social'] + '</option>');
                });
            }
        });
    
    
    }
    $("#monto3_rendibines7").on({
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
    $("#monto_factura_rend7").on({
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
    $("#total_rendi7").on({
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
    $("#monto_estimado_mod_b7").on({
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
 //////////////validar mayor
 function validarmayorpy(){
    /*var totalAmountRendered   = parseFloat(document.rendi_bienes1.total_rendi5.value);
    var totalAmountProgrammed  = parseFloat(document.rendi_bienes1.monto_estimado_mod_b5.value);*/

    var num1 = document.rendir_py.total_rendi7.value;
    var num2 = document.rendir_py.monto_estimado_mod_b7.value;
   // var newstr = num1.replace('.', "");
    //var newstr2 = num2.replace('.', "");
    var newstr0 = num2.replace(".", "");
    var newstr2 = newstr0.replace(".", "");
    var newstr3 = newstr2.replace(".", "");
    var newstr4 = newstr3.replace(".", "");
    var cant_f = newstr4.replace(",", ".");

    var newstr6 = num1.replace(".", "");
    var newstr7 = newstr6.replace(".", "");
    var newstr8 = newstr7.replace(".", "");
    var newstr9 = newstr8.replace(".", "");
    var total_rendi7 = newstr9.replace(",", ".");

    console.log(total_rendi7);
    console.log(cant_f);

    if (parseFloat(total_rendi7) > parseFloat(cant_f)) {
        swal.fire({
            title: 'El Total Contratado es mayor al Monto total Estimado Ingresado en la Programación anual,no puede continuar con la rendición, debe  ir a Programación -Modificación de una programación, luego vuelva a rendición y intente de nuevo',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
       // alert('El Total Contratado es mayor al Monto total Estimado Ingresado en la Programación anual,no puede continuar con la rendiciòn, debe  ir a Programación -Modificación de una programación, luego vuelva a rendición y intente de nuevo');
        //document.rendi_bienes1.total_rendi5.value = "";
       $("#rendi_py1").prop('disabled', true)   
        } else {
            swal.fire({
                title: 'Bien. Puede continuar con la Rendiciòn',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
            //alert('Bien. Puede continuar con la Rendiciòn');
       
       $("#rendi_py1").prop('disabled', false)

    }
};
    function rendi_py11(){
        event.preventDefault();
        swal
            .fire({
                title: "¿Registrar?",
                text: "¿Esta seguro de registrar rendición Proyecto?  ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, guardar!",
            })
            .then((result) => {
                if (document.rendir_py.llenar_trimestre7.selectedIndex==0){
                    swal.fire({
                        title: 'Debe seleccionar un Trimestre.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value == true) {
                        }
                    });
                   // alert("Debe seleccionar un Trimestre.")
                    document.rendir_py.llenar_trimestre7.focus()
                    return 0;
             }
                if (document.rendir_py.ccnu.selectedIndex==0){
                    swal.fire({
                        title: 'Debe seleccionar Ítem a rendir.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value == true) {
                        }
                    });
                    //alert("Debe seleccionar Ítem a rendir.")
                    document.rendir_py.ccnu.focus()
                    return 0;
             }
             if (document.rendir_py.ccnu.selectedIndex==0){
                swal.fire({
                    title: 'Debe seleccionar Ítem a rendir.',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value == true) {
                    }
                });
               // alert("Debe seleccionar Ítem a rendir.")
                document.rendir_py.ccnu.focus()
                return 0;
         }
          
            if (document.rendir_py.selc_tipo_doc_contrata7.selectedIndex==0){
                swal.fire({
                    title: 'Debe seleccionar un TIPO DOCUMENTO CONTRATACIÓN.',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value == true) {
                    }
                });
                //alert("Debe seleccionar un TIPO DOCUMENTO CONTRATACIÓN.")
                document.rendir_py.selc_tipo_doc_contrata7.focus()
                return 0;
         }
            
         if (document.rendir_py.cantidad_rendi7.value.length==0){
            swal.fire({
                title: 'No Puede dejar el campo Cantidad vacio, Ingrese un valor.',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
           // alert("No Puede dejar el campo Cantidad vacio, Ingrese un valor")
            document.rendir_py.cantidad_rendi7.focus()
            return 0;
     }  
     if (document.rendir_py.costo_unitario_remd7.value.length==0){
        swal.fire({
            title: 'No Puede dejar el campo costo unitario vacio, Ingrese un valor.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
       // alert("No Puede dejar el campo costo unitario vacio, Ingrese un valor")
        document.rendir_py.costo_unitario_remd7.focus()
        return 0;
 } 
 if (document.rendir_py.selc_iva_ret7.selectedIndex==0){
    swal.fire({
        title: 'Debe seleccionar el valor del IVA correspondiente.',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
   // alert("Debe seleccionar el valor del IVA correspondiente.")
    document.rendir_py.selc_iva_ret7.focus()
    return 0;
}
if (document.rendir_py.modalida_rendi7.selectedIndex==0){
    swal.fire({
        title: 'Debe seleccionar un ROCEDIMIENTO DE CONTRATACIÓN.',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
    //alert("Debe seleccionar un TIPO DOCUMENTO CONTRATACIÓN.")
    document.rendir_py.modalida_rendi7.focus()
    return 0;
}
if (document.rendir_py.id_sub_modalidad7.selectedIndex==0){
    swal.fire({
        title: 'Debe seleccionar un Supuestos del Procedimiento de la Selección del Contratista.',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
    //alert("Debe seleccionar un TIPO DOCUMENTO CONTRATACIÓN.")
    document.rendir_py.id_sub_modalidad7.focus()
    return 0;
}
         if (document.rendir_py.paridad_rendi7.value.length==0){
            swal.fire({
                title: 'No Puede dejar el campo Paridad US$ vacio, Ingrese un Monto.',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
           // alert("No Puede dejar el campo Paridad US$ vacio, Ingrese un Monto")
            document.rendir_py.paridad_rendi7.focus()
            return 0;
     }
     if (document.rendir_py.rif_b7.value.length==0){
        swal.fire({
            title: 'No Puede dejar el campo Rif Contratista vacio, Ingrese un valor.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
       // alert("No Puede dejar el campo Rif Contratista vacio, Ingrese un valor")
        document.rendir_py.rif_b7.focus()
        return 0;
 }  
 if (document.rendir_py.num_contrato7.value.length==0){
    swal.fire({
        title: 'No Puede dejar el campo numero de contrato vacio, Ingrese un valor.',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
   // alert("No Puede dejar el campo numero de contrato vacio, Ingrese un valor")
    document.rendir_py.num_contrato7.focus()
    return 0;
}   if (document.rendir_py.selc_tipo_doc_contrata7.selectedIndex==0){
    swal.fire({
        title: 'Debe seleccionar un TIPO DOCUMENTO CONTRATACIÓN.',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
        }
    });
    //alert("Debe seleccionar un TIPO DOCUMENTO CONTRATACIÓN.")
    document.rendir_py.selc_tipo_doc_contrata7.focus()
    return 0;
}

     if (document.rendir_py.facturacion7.selectedIndex==0){
        swal.fire({
            title: 'Debe seleccionar una opción ¿Desea Registrar Facturación y Pago?.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        ///alert("Debe seleccionar una opción ¿Desea Registrar Facturación y Pago?.")
        document.rendir_py.facturacion7.focus()
        return 0;
 }
 if (document.rendir_py.fecha_contrato7.value === '') {
    swal.fire({
        title: 'ingrese fecha de contrato',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value == true) {
            document.rendir_py.fecha_contrato7.focus();
        }
    });
    return 0;
}

                if (result.value == true) {
                    event.preventDefault();
                    var datos = new FormData($("#rendir_py")[0]);
                    //            var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_bienes_acc';
                    var base_url = '/index.php/Programacion/save_rendi_pry';
                    
                    $.ajax({
                        url: base_url,
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            var menj = 'Rendido';
                           
                           if (response == 1) {
                            swal.fire({
                                title: 'Registro Exitoso Proyecto',
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
                            }else {
                                swal.fire({
                                    title: 'Error al guardar',
                                    text: 'No se pudo guardar el registro, por favor revise la información ingresada y vuelva a intentar',
                                    type: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                });
                            }
                            
                        },error: function(jqXHR, textStatus, errorThrown) {
                            swal.fire({
                                title: 'Error',
                                text: 'ocurrio un error, por favor vuelva a intentar.',
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            });
                        }
                    });
                }
            });
        
    }
    
    function validateMaxLength4(input) {
        var maxLength = 10;
        var errorMsg = document.getElementById("errorMsg4");
       
        if (input.value.length < maxLength) {
           input.value = input.value.slice(0, maxLength);
           errorMsg.style.color = "red";
           errorMsg.innerHTML = "El Rif ingresado no puede ser menor de 10 caracteres. por favor ingrese un rif correcto";
           $("#rendi_py1").prop('disabled', true)
    
        } else {
           errorMsg.innerHTML = "";
           $("#rendi_py1").prop('disabled', false)
    
        }
       }
       function validateMaxLength3(input) {
        var maxLength = 10;
        var errorMsg = document.getElementById("errorMsg3");
       
        if (input.value.length > maxLength) {
           input.value = input.value.slice(0, maxLength);
           errorMsg.style.color = "red";
           errorMsg.innerHTML = "El Rif ingresado no puede superar los 11 caracteres.por favor ingrese un rif correcto";
           $("#rendi_py1").prop('disabled', true)
    
        } else {
           errorMsg.innerHTML = "";
           $("#rendi_py1").prop('disabled', false)
    
        }
       }
       function validateMaxLength1(input) {
        var maxLength = 10;
        var errorMsg = document.getElementById("errorMsg1");
       
        if (input.value.length < maxLength) {
           input.value = input.value.slice(0, maxLength);
           errorMsg.style.color = "red";
           errorMsg.innerHTML = "El Rif ingresado no puede ser menor de 10 caracteres. por favor ingrese un rif correcto";
           $("#rendi_py1").prop('disabled', true)
    
        } else {
           errorMsg.innerHTML = "";
           $("#rendi_py1").prop('disabled', false)
    
        }
       }
       function validateMaxLength2(input) {
        var maxLength = 10;
        var errorMsg = document.getElementById("errorMsg2");
       
        if (input.value.length > maxLength) {
           input.value = input.value.slice(0, maxLength);
           errorMsg.style.color = "red";
           errorMsg.innerHTML = "El Rif ingresado no puede superar los 11 caracteres.por favor ingrese un rif correcto";
           $("#rendi_py1").prop('disabled', true)
    
        } else {
           errorMsg.innerHTML = "";
           $("#rendi_py1").prop('disabled', false)
    
        }
       }