function cambiarEndDate(){

        f = $("#vigen_cert_desde").val();; // Acá la fecha leída del INPUT
        vec = f.split('-'); // Parsea y pasa a un vector
        var fecha = new Date(vec[0], vec[1], vec[2]); // crea el Date
        fecha.setFullYear(fecha.getFullYear()+2); // Hace el cálculo
        res = fecha.getFullYear()+'-'+fecha.getMonth()+'-'+fecha.getDate(); // carga el resultado
        $('#vigen_cert_hasta').val(res);
        //console.log(res);f;
}

//PARA apobar certificacion
function modal(id) {
    var id = id;

   var base_url = '/index.php/Certificacion/consultar_certificacion';
       var base_url2 = '/index.php/certificacion/llenar_contratista_rp';

    //  var base_url =
    //      window.location.origin + "/asnc/index.php/Certificacion/consultar_certificacion";

   

    $.ajax({
        url: base_url,
        method: "post",
        data: { id: id },
        dataType: "json",
        success: function(data) {
            $("#id_mesualidad_ver").val(id);
            $("#nombre").val(data["nombre"]);
            $("#rif_cont").val(data["rif_cont"]);
            

        },
    });
}

function guardar_proc_pago() {
    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de cambiar el Estatu? ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
            if (document.guardar_proc_pag.observacion.value.length==0){
                alert("No Puede dejar el campo observacion vacio")
                document.guardar_proc_pag.observacion.focus()
                return 0;
         } 
             	if (document.guardar_proc_pag.status.selectedIndex==0){
            alert("Debe seleccionar Un status.")
            document.guardar_proc_pag.status.focus()
            return 0;
     }

     if (result.value == true) {
        event.preventDefault();
        var datos = new FormData($("#guardar_proc_pag")[0]);
        var base_url = '/index.php/Certificacion/guardar_proc_pag';
        var base_url_3 = '/index.php/Certificacion/verpdf?id=';

      
        //  var base_url =   window.location.origin +  "/asnc/index.php/Certificacion/guardar_proc_pag";
        //  var base_url_2 = window.location.origin + "/asnc/index.php/Certificacion/Listado_certificacion";
        //      var base_url_3 = window.location.origin + "/asnc/index.php/Certificacion/verpdf?id=";
        $.ajax({
            url: base_url,
            method: "POST",
            data: datos,
            contentType: false,
            processData: false,
            success: function(response) {
               var menj = ' ';
               /* if (response == "true") {
                    swal
                        .fire({
                            title: "Registro Exitoso",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok",
                        })
                        .then((result) => {
                            if (result.value == true) {
                                window.location.href = base_url_2;
                            }
                        });
                }*/
                if(response != '') {
                    swal.fire({
                        title: 'Registro Exitoso ',
                        text: menj + response,
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value == true){
                            window.location.href = base_url_3 + response;
                        }
                    });
                }
            },
        });
    }
         
        });
}






