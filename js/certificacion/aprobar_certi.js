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
//        var base_url2 = '/index.php/certificacion/llenar_contratista_rp';

    //  var base_url =  window.location.origin + "/asnc/index.php/Certificacion/consultar_certificacion";

   

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

function prepareGestionModal(id_cert) {
    // Limpiar el formulario
    $('#form_gestion_certificacion')[0].reset();
    $('#id_certificacion_gestion').val(id_cert);
    $('#status_gestion').val(''); // Resetear el select de status
    $('#observacion_gestion').val('');
    $('#vigen_cert_hasta_gestion').val(''); // Limpiar fecha hasta

    // Obtener la fecha actual para 'vigen_cert_desde'
    const today = moment().format('YYYY-MM-DD');
    $('#vigen_cert_desde_gestion').val(today);

    var base_url = '/index.php/Certificacion/consultar_certificacion';
    // Llamada AJAX para obtener los datos de la certificación principal (nombre, rif_cont)
    // var base_url = window.location.origin + '/asnc/index.php/Certificacion/consultar_certificacion';

    $.ajax({
        url: base_url,
        method: 'POST',
        data: { id: id_cert },
        dataType: 'json',
        success: function(data) {
            if (data) {
                $('#nombre_gestion').val(data.nombre);
                $('#rif_cont_gestion').val(data.rif_cont);
                // El status y la observación no se rellenan, ya que el usuario los va a establecer.
                // Si necesitas el status actual, lo obtendrías de data['status'] y lo mostrarías.
            } else {
                Swal.fire('Error', 'No se encontraron datos para la certificación.', 'error');
                $('#modalGestionCertificacion').modal('hide');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error: ", textStatus, errorThrown);
            Swal.fire('Error', 'Error al cargar los datos de la certificación.', 'error');
            $('#modalGestionCertificacion').modal('hide');
        }
    });
}

// --- FUNCIÓN ADAPTADA: calculateVigenciaGestion (para la vigencia de 1 año) ---
function calculateVigenciaGestion() {
    const statusSelect = $('#status_gestion');
    const vigenDesdeInput = $('#vigen_cert_desde_gestion');
    const vigenHastaInput = $('#vigen_cert_hasta_gestion');

    // Solo calcular si el estatus seleccionado es "Aprobado" (valor 2)
    if (statusSelect.val() == '2') {
        const fechaDesdeStr = vigenDesdeInput.val();
        if (fechaDesdeStr) {
            const momentFechaDesde = moment(fechaDesdeStr);
            // Calcular 1 año a partir de la fecha de inicio
            const momentFechaHasta = momentFechaDesde.add(1, 'year');
            vigenHastaInput.val(momentFechaHasta.format('YYYY-MM-DD')); // Formato YYYY-MM-DD
        } else {
            vigenHastaInput.val('');
        }
    } else {
        // Si no es aprobado, la fecha de vigencia "hasta" se borra
        vigenHastaInput.val('');
    }
}

// --- NUEVA FUNCIÓN: save_decision_certificacion ---
function save_decision_certificacion() {
    event.preventDefault();

    swal.fire({
        title: '¿Guardar Decisión?',
        text: '¿Está seguro de cambiar el estatus de la certificación? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, guardar!',
    }).then((result) => {
        if (result.value == true) {
            // Validaciones
            if ($('#observacion_gestion').val().trim().length == 0) {
                Swal.fire('Atención', 'No puede dejar el campo "Observación" vacío.', 'warning');
                $('#observacion_gestion').focus();
                return false;
            }
            if ($('#status_gestion').val() == '') {
                Swal.fire('Atención', 'Debe seleccionar un estatus.', 'warning');
                $('#status_gestion').focus();
                return false;
            }

            // Si el estatus es "Aprobado", asegúrate que la vigencia "hasta" se haya calculado
            if ($('#status_gestion').val() == '2' && $('#vigen_cert_hasta_gestion').val() == '') {
                Swal.fire('Atención', 'La fecha de vigencia "hasta" no se calculó correctamente. Intente de nuevo o contacte a soporte.', 'warning');
                return false;
            }

            // Realiza el cálculo de vigencia una última vez antes de enviar para asegurar
            calculateVigenciaGestion();

            var datos = new FormData($("#form_gestion_certificacion")[0]);
            var base_url = '/index.php/Certificacion/guardar_proc_pag';
            var base_url = '/index.php/Pdfcertificacion/verpdf?id=';

            // var base_url = window.location.origin + '/asnc/index.php/Certificacion/guardar_proc_pag'; // Ruta al controlador para guardar la decisión
            // // var base_url_pdf = window.location.origin + '/asnc/index.php/Certificacion/verpdf?id='; // Ruta para ver el PDF
            // var base_url_pdf = window.location.origin + '/asnc/index.php/Pdfcertificacion/verpdf?id='; // Ruta para ver el PDF

            $.ajax({
                url: base_url,
                method: "POST",
                data: datos,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response) {  
                        var certId = parseInt(response); // Intenta parsear a un entero
                if (isNaN(certId)) {  
                    certId = String(response).replace(/"/g, '');  
                }
                        swal.fire({
                            title: 'Decisión Guardada',
                            text: 'El estatus de la certificación ha sido actualizado.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                // Redirigir al PDF usando el ID devuelto por el controlador
                                window.location.href = base_url_pdf + certId;;
                            }
                        });
                    } else {
                        Swal.fire('Error', 'No se pudo guardar la decisión. Verifique los datos o contacte a soporte.', 'error');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error: ", textStatus, errorThrown);
                    console.log(jqXHR.responseText);
                    Swal.fire('Error', 'Ocurrió un error al procesar la solicitud. Por favor, intente de nuevo.', 'error');
                },
            });
        }
    });
}




