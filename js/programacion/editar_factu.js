function editar_factura(id) {
    var id_rendicion = id;
        // var base_url =window.location.origin+'/asnc/index.php/Programacion/consulta_item_edit';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/llenar_comp_resp_social';

    var base_url = '/index.php/Programacion/consulta_item_edit';
    var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
    var base_url6 = '/index.php/Programacion/llenar_comp_resp_social';



       var originalContent = $('#editar_factura .modal-body').html();
        $('#editar_factura .modal-body').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Cargando...</div>');
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_rendicion: id_rendicion },
        dataType: "json",
        success: function(data) {
             $('#editar_factura .modal-body').html(originalContent);
            $('#id_rendiciones').val(id);
            $("#n_factura").val(data["nfactura_rendi"]);
            $("#datefactura_rendisr").val(data["datefactura_rendi"]);

             $("#base_imponible_rendi5s").val(data["base_imponible_rendi"]);
             $("#ivas").val(data["selc_iva_rendi2"]);
             $("#monto_factura_rend5s").val(data["monto_factura_rend"]);
             $("#total_pago_rendi5s").val(data["total_pago_rendi"]);
             $("#paridad_rendi_factura5s").val(data["paridad_rendi_factura"]);
             $("#subtotal_rendi_factura5s").val(data["subtotal_rendi_factura"]);
             $("#fecha_pago_rendi5s").val(data["fecha_pago_rendi"]);
             $("#selc_com_res_social5s").val(data["desc_comp_resp_social"]);
             $('#monto3_rendibiness').val(data['monto3_rendim']);
             $('#id_selc_com_res_social').val(data['selc_com_res_social']);

            // $('#unid_med_b').val(data['desc_unidad_medida']);

            // $('#id_ff_b').val(data['id_fuente_financiamiento']);
            // $('#ff_b').val(data['desc_fuente_financiamiento']);


                            var id_alic_iva2 = 1;
                        $.ajax({
                            url: base_url3,
                            method: 'post',
                            data: { id_alic_iva2: id_alic_iva2 },
                            dataType: 'json',
                            success: function(data) {
                                // Clear any existing options
                                $('#camb_id_iva').empty();
                        
                                // Add the "Seleccione" option
                                $('#camb_id_iva').append('<option value="0">Seleccione</option>');
                        
                                // Iterate through the data and append new options
                                $.each(data, function(index, data) {
                                    $('#camb_id_iva').append('<option value="' + data['desc_alicuota_iva'] + '">' + data['desc_porcentaj'] + '</option>');
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
                            $('#camb_selc_com_res_social5s').empty();
                            $('#camb_selc_com_res_social5s').append('<option value="0">Seleccione</option>');
                            $.each(data, function(index, data) {
                                $('#camb_selc_com_res_social5s').append('<option value="' + data['id_comp_resp_social'] + '">' + data['desc_comp_resp_social'] + '</option>');
                            });
                        }
                    });
 
        },
          error: function(jqXHR, textStatus, errorThrown) {
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

function calculos_factura(){
     
        var base_imponible_rendi52 = $('#base_imponible_rendi5s').val();
        var news1 = base_imponible_rendi52.replace('.', "");
        var news6 = news1.replace('.', "");
        var news7 = news6.replace('.', "");
        var news8 = news7.replace('.', "");
        var base_imponible_rendi5 = news8.replace(',', ".");
        
        var selc_iva_rendi55 = $('#camb_id_iva').val();
        var separar1 = selc_iva_rendi55.split("/");
        var porcentaje1 = separar1['0'];
            // calcular  monto_factura_rend5
        var monto_factura_rend55 = base_imponible_rendi5*porcentaje1;
        var monto_factura_rend500 = parseFloat(monto_factura_rend55).toFixed(2);
        var monto_factura_rend501 = Intl.NumberFormat("de-DE").format(monto_factura_rend500);
        $('#monto_factura_rend5s').val(monto_factura_rend501);

        // calculo total pago
        

    
        var montoend5 = $('#monto_factura_rend5s').val();
        var montoend51 = montoend5.replace('.', "");
        var montoend52= montoend51.replace('.', "");
        var montoend53 = montoend52.replace('.', "");
        var montoend54 = montoend53.replace('.', "");
        var montoend55 = montoend54.replace(',', "."); //hasta aca para poder sumar '??
       
         //Calculo total pago
         var total_pago_rendi51 = Number(base_imponible_rendi5) + Number(montoend55);
         var total_pago_rendi52 = Intl.NumberFormat("de-DE").format(total_pago_rendi51);
         $('#total_pago_rendi5s').val(total_pago_rendi52);


        var paridad_rendi_factura55 = $('#paridad_rendi_factura5s').val();
        var new1 = paridad_rendi_factura55.replace('.', "");
        var new6 = new1.replace('.', "");
        var new7 = new6.replace('.', "");
        var new8 = new7.replace('.', "");
        var paridad_rendi_factura5 = new8.replace(',', ".");

       if (parseFloat(paridad_rendi_factura5) === 0 || isNaN(parseFloat(paridad_rendi_factura5))) {
            // Si es cero, asignar 0 al subtotal
            $('#subtotal_rendi_factura5s').val("0");
        } else {
            // Si no es cero, realizar la división
            var subtotal_rendi_facturas5 = base_imponible_rendi5 / paridad_rendi_factura5;
            var subtotal_rendi_factura25 = parseFloat(subtotal_rendi_facturas5).toFixed(2);
            var subtotal_rendi_factura35 = Intl.NumberFormat("de-DE").format(subtotal_rendi_factura25);
            $('#subtotal_rendi_factura5s').val(subtotal_rendi_factura35);
        }
        // var monto3_rendi = base_imponible_rendi5*0.03;
        // var monto3_rendi2 = parseFloat(monto3_rendi).toFixed(2);
        // var monto3_rendi3 = Intl.NumberFormat("de-DE").format(monto3_rendi2);
        // $('#monto3_rendibines').val(monto3_rendi3);  
            
    }
    
  $(document).ready(function() {
    // Delegación de eventos
    $(document).on("focus", "#monto3_rendibiness", function(event) {
        $(event.target).select();
    });

    $(document).on("keyup", "#monto3_rendibiness", function(event) {
        $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "") // Eliminar caracteres no numéricos
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2') // Formatear los últimos 2 dígitos
                        .replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Agregar puntos para miles
        });
    });
});

  $(document).ready(function() {
    // Delegación de eventos
    $(document).on("focus", "#base_imponible_rendi5s", function(event) {
        $(event.target).select();
    });

    $(document).on("keyup", "#base_imponible_rendi5s", function(event) {
        $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "") // Eliminar caracteres no numéricos
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2') // Formatear los últimos 2 dígitos
                        .replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Agregar puntos para miles
        });
    });
});

$(document).ready(function() {
    // Delegación de eventos
    $(document).on("focus", "#paridad_rendi_factura5s", function(event) {
        $(event.target).select();
    });

    $(document).on("keyup", "#paridad_rendi_factura5s", function(event) {
        $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "") // Eliminar caracteres no numéricos
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2') // Formatear los últimos 2 dígitos
                        .replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Agregar puntos para miles
        });
    });
});

function save_edit(){

    if (document.guardar_edit.camb_id_iva.selectedIndex==0){
        swal.fire({
            title: 'Debe seleccionar un IVA correspondiente.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
       // alert("Debe seleccionar un IVA correspondiente.")
        document.guardar_edit.camb_id_iva.focus()
        return 0;
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
            var id_rendiciones = $('#id_rendiciones').val();
            var n_factura = $('#n_factura').val();
            var datefactura_rendisr = $('#datefactura_rendisr').val();
            var base_imponible_rendi5s = $('#base_imponible_rendi5s').val();
            var camb_id_iva = $('#camb_id_iva').val();
            var monto_factura_rend5s = $('#monto_factura_rend5s').val();
            var total_pago_rendi5s = $('#total_pago_rendi5s').val();
            var paridad_rendi_factura5s = $('#paridad_rendi_factura5s').val();
            var subtotal_rendi_factura5s = $('#subtotal_rendi_factura5s').val();
            var id_selc_com_res_social = $('#id_selc_com_res_social').val();
            var camb_selc_com_res_social5s = $('#camb_selc_com_res_social5s').val();
            var monto3_rendibiness = $('#monto3_rendibiness').val();
            var fecha_pago_rendi5s = $('#fecha_pago_rendi5s').val();



        // var base_url =window.location.origin+'/asnc/index.php/Programacion/editar_informacion_factura';

            var base_url = '/index.php/Programacion/editar_informacion_factura';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_rendiciones: id_rendiciones,
                    n_factura: n_factura,
                    datefactura_rendisr: datefactura_rendisr,
                    base_imponible_rendi5s:base_imponible_rendi5s,
                    camb_id_iva:camb_id_iva,
                    monto_factura_rend5s:monto_factura_rend5s,
                    total_pago_rendi5s:total_pago_rendi5s,
                    paridad_rendi_factura5s:paridad_rendi_factura5s,
                    subtotal_rendi_factura5s:subtotal_rendi_factura5s,
                    id_selc_com_res_social:id_selc_com_res_social,
                    camb_selc_com_res_social5s:camb_selc_com_res_social5s,
                    monto3_rendibiness:monto3_rendibiness,
                    fecha_pago_rendi5s:fecha_pago_rendi5s,                   
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
                } ,error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            text: 'ocurrio un error, por favor vuelva a intentar.',
                            type: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                    }
            })
        }
    });
}
}