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
        // var base_url  = window.location.origin+'/asnc/index.php/certificacion/llenar_contratista';
        // var base_url2 = window.location.origin+'/asnc/index.php/certificacion/llenar_contratista_rp';

    //   var base_url = '/index.php/certificacion/llenar_contratista';
    //     var base_url2 = '/index.php/certificacion/llenar_contratista_rp';

    var base_url = '/index.php/Certificacion/llenar_contratista';

        $.ajax({
            url:base_url,
            method: 'post',
            data: {rif_b: rif_b},
            dataType: 'json',
            success: function(data){
                if (data == null) {
                    $("#no_existe").show();
                    $("#existe").hide();

                    $('#exitte').val(0);

                }else{
                    $("#existe").show();
                    $("#no_existe").hide();

                    $('#exitte').val(1);

                    $('#rif_cont').val(data['rifced']);
                    $('#nombre').val(data['nombre']);
                    $('#estado').val(data['descedo']);
                    $('#municipio').val(data['descmun']);
                    $('#ciudad').val(data['descciu']);
                    $('#persona_cont').val(data['percontacto']);
                    $('#tel_cont').val(data['telf1']);
                    $('#numcertrnc').val(data['numcertrnc']);
                    

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
                               $('#tabla_rep tbody').append('<tr><td>' + response['cedrif'] + '</td><td>' + response['repr'] + '</td><td>' + response['cargo'] + '</td></tr>');
                            });
                        }
                    });
                }
            }
        })
    }
}