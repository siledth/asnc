function modal_ce(id_miembros) {
    var id = id_miembros;

   var base_url = '/index.php/Comision_contrata/consultar_t';
      // var base_url2 = '/index.php/certificacion/llenar_contratista_rp';

    //  var base_url =
    //      window.location.origin + "/asnc/index.php/Certificacion/consultar_certificacion";

   

    $.ajax({
        url: base_url,
        method: "post",
        data: { id: id },
        dataType: "json",
        success: function(data) {
            $("#id_mesualidad_ver").val(id);
          
            

        },
    });
}

function cambiarEndDate(){

    f = $("#vigen_cert_desde").val();; // Acá la fecha leída del INPUT
    vec = f.split('-'); // Parsea y pasa a un vector
    var fecha = new Date(vec[0], vec[1], vec[2]); // crea el Date
    fecha.setFullYear(fecha.getFullYear()+2); // Hace el cálculo
    res = fecha.getFullYear()+'-'+fecha.getMonth()+'-'+fecha.getDate(); // carga el resultado
    $('#vigen_cert_hasta').val(res);
    //console.log(res);f;
}
// function cambiarEndDate2() {
//     f = $("#vigen_cert_desde2").val();; // Read the date from the INPUT
//     vec = f.split('-'); // Parse and convert to a vector
//     var fecha = new Date(vec[0], vec[1] - 1, vec[2]); // Create the Date object (note that the month is 0-indexed)
//     fecha.setDate(fecha.getDate() + 30); // Add 30 days
//     res = fecha.getFullYear() + '-' + ('0' + (fecha.getMonth() + 1)).slice(-2) + '-' + ('0' + fecha.getDate()).slice(-2); // Format the result
//     $('#vigen_cert_hasta2').val(res);
// }

    

    function guardar_nuevoestatus(){////////////////////////////////
        event.preventDefault();
    
        swal.fire({
            title: '¿Seguro desea Certificar? ',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si!'
        }).then((result) => {
            if (result.value == true) {
                var id_miembros = $('#id_mesualidad_ver').val();
                var vigen_cert_desde = $('#vigen_cert_desde').val();
                var vigen_cert_hasta = $('#vigen_cert_hasta').val();
                 
                var base_url = '/index.php/Comision_contrata/miembro_condicionado_cer'; 
    
                $.ajax({
                    url:base_url,
                    method: 'post',
                    data:{
                        id_miembros: id_miembros,
                        vigen_cert_desde: vigen_cert_desde, 
                        vigen_cert_hasta: vigen_cert_hasta,
                         
    
                    },
                    dataType: 'json',
                    success: function(response){
                        if(response == 1) {
                            swal.fire({
                                title: ' exito.',
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