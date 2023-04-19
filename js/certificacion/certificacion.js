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

       var base_url = '/index.php/certificacion/llenar_contratista';
         var base_url2 = '/index.php/certificacion/llenar_contratista_rp';

   

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
                    $('#percontacto').val(data['percontacto']);
                    
                    
                    
                    $('#numcertrnc').val(data['numcertrnc']);
                    $('#numcertrnc2').val(data['numcertrnc']);
 
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


// esto es facilitador
function modal(id){
    var cedula = id;
    // var base_url = window.location.origin+'/asnc/index.php/Certificacion/consulta_facilitadores';
    var base_url = '/index.php/Certificacion/consulta_facilitadores';
    $.ajax({
        url: base_url,
        method:'post',
        data: {cedula: cedula},
        dataType:'json',

        success: function(response){
            $('#cedula').val(response['cedula']);
            $('#rif_cont').val(response['rif_cont']);
            $('#status').val(response['status']);
           
        }
    });
}
function editar_b(){
    var cedula = $("#cedula").val();
    var rif_cont= $("#rif_cont").val();
    var nombre_desin = $("#nombre_desin").val();
    var cargo_desin = $("#cargo_desin").val();
    var status = $("#status").val();
    var motivo = $("#motivo").val();
    if (nombre_desin == '') {
        document.getElementById("nombre_desin").focus();
    }else if(cargo_desin == ''){
        document.getElementById("cargo_desin").focus();
    }else {
        event.preventDefault();
        swal.fire({
            title: '¿Cambiar Estatus?',
            text: '¿Esta seguro de Realizar esta acciòn?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, guardar!'
        }).then((result) => {
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#editar")[0]);
                // var base_urls =window.location.origin+'/asnc/index.php/Certificacion/cambiar_estatus';
                var base_urls = '/index.php/Certificacion/cambiar_estatus';
                $.ajax({
                    url: base_urls,
                    method:'post',
                    data: {cedula: cedula,
                        rif_cont: rif_cont,
                        nombre_desin: nombre_desin,
                        cargo_desin: cargo_desin,
                        motivo: motivo,
                        status: status
                    },
                dataType:'json',
                    success: function(response){
                        if(response != '') {
                            swal.fire({
                                title: ' Exitoso',
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
                    }
                })
            }
        });
    }
}