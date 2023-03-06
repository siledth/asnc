function calcular(){

   // var pies = $('#pies').val();
  //  var dia = $('#dia').val();
  //  var cantidad2 = 30;
  
    var bolivar_estimado = $('#bolivar_estimado').val();
   
        $("#bolivar_estimado").prop('disabled', false);
        $("#id_alicuota_iva").prop('disabled', false);
        
        //Remplazar decimales para caculos
          
            // var newstr5 = canon2.replace('.', "");
            // var newstr6 = newstr5.replace('.', "");
            // var newstr7 = newstr6.replace('.', "");
            // var newstr8 = newstr7.replace('.', "");
            // var canon3 = newstr8.replace(',', ".");
                        
          
            // var bolivares = (canon3 * dolars);
            // var boli_tota2 = parseFloat(bolivares).toFixed(2);
            // var boli_tota3 = Intl.NumberFormat("de-DE").format(boli_tota2);
            // $('#bolivar_estimado').val(boli_tota3);

            var id_alicuota_iva = $('#id_alicuota_iva').val();
            var separar = id_alicuota_iva.split("/");
            var porcentaje = parseFloat(separar['0']);

            var newstr5 = bolivar_estimado.replace('.', "");
            var newstr6 = newstr5.replace('.', "");
            var newstr7 = newstr6.replace('.', "");
            var newstr8 = newstr7.replace('.', "");
            var precio_total_ac = newstr8.replace(',', ".");
    
            var exitte  = $("#cedula").val();
            if (exitte == 'V6429731'){ 
                var finalss = 0;
                $('#iva_estimado').val(finalss);
                var finalsss = 0;
                $('#monto_estimado').val(finalsss);
                


            }else{

            var monto_iva_estimado = precio_total_ac*porcentaje;
            var iva_estimado = parseFloat(monto_iva_estimado).toFixed(2);
            var iva_estimado = Intl.NumberFormat("de-DE").format(iva_estimado);
            $('#iva_estimado').val(iva_estimado);
    
            var newstr9 = iva_estimado.replace('.', "");
            var newstr10 = newstr9.replace('.', "");
            var newstr11 = newstr10.replace('.', "");
            var newstr12 = newstr11.replace('.', "");
            var iva_estimado_ac = newstr12.replace(',', ".");
    
            var monto_t_estimado = Number(precio_total_ac) + Number(iva_estimado_ac);
            var monto_total_estimadoo = parseFloat(monto_t_estimado).toFixed(2);
            var monto_total_estimado = Intl.NumberFormat("de-DE").format(monto_total_estimadoo);
            $('#monto_estimado').val(monto_total_estimado);
            }
    /*}*/
}

function control(){
    var acc_cargar_acc = $('#cambiar').val();

    if (acc_cargar_acc === '1') {
        $("#acc_acc").hide();
        $("#proyecto_acc").show();
    }else if (acc_cargar_acc === '2') {
        $("#proyecto_acc").hide();
        $("#acc_acc").show();
    }
}
