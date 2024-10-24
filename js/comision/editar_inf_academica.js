function modal(id) {
    var id_inf_academ = id;
        var base_url =window.location.origin+'/asnc/index.php/Comision_contrata/consulta_infomr_acade_miembro';
        var base_url2 =window.location.origin+'/asnc/index.php/Comision_contrata/llenar_forma_aca_mod';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';

        // var base_url = '/index.php/Programacion/consultar_item_modal_bienes';
        //  var base_url2 = '/index.php/ccccc';
        // var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url7 = '/index.php/Programacion/llenar_ff_';
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_inf_academ: id_inf_academ },
        dataType: "json",
        success: function(data) {
            $('#id_inf_academ').val(id);
            $("#id_miembros").val(data["id_miembros"]);
             $("#id_academico").val(data["id_academico"]);
             $("#fm_ac1").val(data["desc_academico"]);
            //  $("#desc_ccnu").val(data["desc_ccnu"]);
            // $("#especificacion").val(data["especificacion"]);
            // $('#id_unid_med_b').val(data['id_unidad_medida']);
            // $('#unid_med_b').val(data['desc_unidad_medida']);

            // $('#id_ff_b').val(data['id_fuente_financiamiento']);
            // $('#ff_b').val(data['desc_fuente_financiamiento']);


//  llena el select de unidad de medida
            var id_academico = data['id_academico'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_academico: id_academico},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#camb_id_academico').append('<option value="'+data['id_academico']+'">'+data['desc_academico']+'</option>');
                    });
                }
            })
 
        },
    });
}