// function modal(id){
//     $('#id').val(id);
// }

// function modal_ver(id){
//     var id_evaluacion = id;
//     //var base_url = window.location.origin+'/asnc/index.php/Evaluacion_desempenio/consulta_anulacion';
//     var base_url = '/index.php/Evaluacion_desempenio/consulta_anulacion';
//     $.ajax({
//         url: base_url,
//         method:'post',
//         data: {id_evaluacion: id_evaluacion},
//         dataType:'json',

//         success: function(response){
//             $('#id_ver').val(response['id_evaluacion']);
//             $('#nro_oficicio_ver').val(response['nro_oficicio']);
//             $('#fec_solicitud_ver').val(response['fecha_anulacion']);
//             $('#nro_expediente_ver').val(response['nro_expediente']);
//             $('#nro_gacet_resol_ver').val(response['nro_gacet_resol']);
//             $('#telf_solc_ver').val(response['telf_solc']);
//             $('#cedula_solc_ver').val(response['cedula_solc']);
//             $('#nom_ape_solc_ver').val(response['nom_ape_solc']);
//             $('#cargo_ver').val(response['cargo']);
//             $('#descp_anul_ver').val(response['descp_anul']);
//         }
//     });
// }

// function guardar_anulacion(){
//     var id              = $("#id").val();
//     var nro_oficicio    = $("#nro_oficicio").val();
//     var fecha           = $("#datepicker-default").val();
//     var nro_expediente  = $("#nro_expediente").val();
//     var cedula_solc     = $("#cedula_solc").val();
//     var nom_ape_solc    = $("#nom_ape_solc").val();
//     var cargo           = $("#cargo").val();
//     var nro_gacet_resol = $("#nro_gacet_resol").val();
//     var telf_solc       = $("#telf_solc").val();

//     if (nro_oficicio == '') {
//         document.getElementById("nro_oficicio").focus();
//     }else if (fecha == '') {
//         document.getElementById("datepicker-default").focus();
//     }else if (nro_expediente == '') {
//         document.getElementById("nro_expediente").focus();
//     }else if (cedula_solc == '') {
//         document.getElementById("cedula_solc").focus();
//     }else if (nom_ape_solc == '') {
//         document.getElementById("nom_ape_solc").focus();
//     }else if (cargo == '') {
//         document.getElementById("cargo").focus();
//     }else if (nro_gacet_resol == '') {
//         document.getElementById("nro_gacet_resol").focus();
//     }else if (telf_solc == '') {
//         document.getElementById("telf_solc").focus();
//     }else {
//         event.preventDefault();
//         swal.fire({
//             title: '¿Anular?',
//             text: '¿Esta seguro que desea solicitar anular la Evaluación de Desempeño?',
//             type: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             cancelButtonText: 'Cancelar',
//             confirmButtonText: '¡Si, guardar!'
//         }).then((result) => {
//             if (result.value == true) {

//                 event.preventDefault();
//                 var datos = new FormData($("#resgistrar_anulacion")[0]);
//                 //var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/resgistrar_anulacion';
//                 var base_url = '/index.php/evaluacion_desempenio/resgistrar_anulacion';
//                 $.ajax({
//                     url:base_url,
//                     method: 'POST',
//                     data: datos,
//                     contentType: false,
//                     processData: false,
//                     success: function(response){
//                         if(response != '') {
//                                 var menj = 'Se ha Enviado la Solicitud de anulación de la Evaluación de Desempeño Nroº: ';
//                             swal.fire({
//                                 title: 'Registro Exitoso',
//                                 text: menj + response,
//                                 type: 'success',
//                                 showCancelButton: false,
//                                 confirmButtonColor: '#3085d6',
//                                 confirmButtonText: 'Ok'
//                             }).then((result) => {
//                                 if (result.value == true){
//                                     location.reload();
//                                     // $('#registrar_eval').attr("disabled", true)
//                                     // $('#exampleModal').modal('show');
//                                     // $('#id').val(response);
//                                 }
//                             });
//                         }
//                     }
//                 })
//             }
//         });
//     }
// }

// function aprovar_anul(id){
//     event.preventDefault();
//     swal.fire({
//         title: '¿Anular?',
//         text: '¿Esta seguro que desea anular la Evaluación de Desempeño?',
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         cancelButtonText: 'Cancelar',
//         confirmButtonText: '¡Si, guardar!'
//     }).then((result) => {
//         if (result.value == true) {
//             event.preventDefault();

//             var id_evaluacion = id;
//             //var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/resgistrar_aprv_anulacion';
//             var base_url = '/index.php/evaluacion_desempenio/resgistrar_aprv_anulacion';
//             $.ajax({
//                 url:base_url,
//                 method: 'POST',
//                 data: {
//                     id_evaluacion: id_evaluacion
//                 },
//                 dataType: 'json',
//                 success: function(response){
//                     if(response != '') {
//                             var menj = 'Se ha anulado la Evaluación de Desempeño Nroº: ';
//                         swal.fire({
//                             title: 'Registro Exitoso',
//                             text: menj + response,
//                             type: 'success',
//                             showCancelButton: false,
//                             confirmButtonColor: '#3085d6',
//                             confirmButtonText: 'Ok'
//                         }).then((result) => {
//                             if (result.value == true){
//                                 location.reload();
//                                 // $('#registrar_eval').attr("disabled", true)
//                                 // $('#exampleModal').modal('show');
//                                 // $('#id').val(response);
//                             }
//                         });
//                     }
//                 }
//             })
//         }
//     });


// }

/**
 * Inicialización de DataTables para aplicar estilos, búsqueda, paginación y responsive.
 */
$(document).ready(function() {
    $('#data-table-default58').DataTable({
        "destroy": true,
        "responsive": true, // Habilita la funcionalidad responsive
        "autoWidth": false, // Desactiva el ancho automático para mejor control con CSS
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json" // Idioma español
        },
        "columnDefs": [
            // Definir columnas sin capacidad de ordenamiento si es necesario
            { "orderable": false, "targets": [8] } // Ejemplo: la columna 'Acciones' (índice 8) no se ordena
        ]
    });

    // Inicializar el datepicker (asumiendo que estás usando jQuery UI o similar)
    if ($.fn.datepicker) {
        $('#datepicker-default').datepicker({
            format: 'dd-mm-yyyy', // Asegura el formato correcto
            autoclose: true,
            todayHighlight: true
        });
    }
});

/**
 * Función para cargar el ID de Evaluación en el modal de registro.
 * @param {number} id - ID de la evaluación.
 */
function modal(id){
    $('#id').val(id);
}

/**
 * Función para consultar y mostrar la información de anulación en el modal de ver.
//  * @param {number} id - ID de la evaluación.
//  */
// function modal_ver(id){
//     var id_evaluacion = id;
//     // Uso de una función para obtener la base_url si es necesario,
//     // pero mantendremos la ruta relativa por ahora.
//     // var base_url = '/index.php/Evaluacion_desempenio/consulta_anulacion';

//     $.ajax({
//         url:BASE_URL + 'index.php/Evaluacion_desempenio/consulta_anulacion',
//         method:'post',
//         data: {id_evaluacion: id_evaluacion},
//         dataType:'json',
//         success: function(response){
//             // Verificar si la respuesta no es vacía
//             if (response) {
//                 // Mapeo directo de la respuesta a los campos del modal de ver
//                 $('#id_ver').val(response['id_evaluacion']);
//                 $('#nro_oficicio_ver').val(response['nro_oficicio']);
//                 $('#fec_solicitud_ver').val(response['fecha_anulacion']);
//                 $('#nro_expediente_ver').val(response['nro_expediente']);
//                 $('#nro_gacet_resol_ver').val(response['nro_gacet_resol']);
//                 $('#telf_solc_ver').val(response['telf_solc']);
//                 $('#cedula_solc_ver').val(response['cedula_solc']);
//                 $('#nom_ape_solc_ver').val(response['nom_ape_solc']);
//                 $('#cargo_ver').val(response['cargo']);
//                 $('#descp_anul_ver').val(response['descp_anul']);
//             } else {
//                  Swal.fire('Error', 'No se encontraron datos de anulación para esta evaluación.', 'error');
//             }
//         },
//         error: function() {
//             Swal.fire('Error', 'Hubo un problema al consultar los datos.', 'error');
//         }
//     });
// }
/**
/**
 * Función para consultar y mostrar la información de anulación en el modal de ver.
 * @param {number} id - ID de la evaluación.
 */
function modal_ver(id){
    var id_evaluacion = id;
    
    // Antes de hacer la llamada AJAX, puedes limpiar el contenido por si acaso.
    // Aunque el llenado lo sobrescribe, ayuda a evitar que se muestre contenido viejo.
    $('#exampleModal_ver').modal('hide'); // Ocultar si estaba abierto (opcional)

    $.ajax({
       url:BASE_URL + 'index.php/Evaluacion_desempenio/consulta_anulacion',
        method:'post',
        data: {id_evaluacion: id_evaluacion},
        dataType:'json',
        success: function(response){
            // Verificar si la respuesta no es vacía
            if (response) {
                // Llenado de los campos (Correcto con .text())
                $('#id_ver').text(response['id_evaluacion']);
                $('#nro_oficicio_ver').text(response['nro_oficicio']);
                $('#fec_solicitud_ver').text(response['fecha_anulacion']);
                $('#nro_expediente_ver').text(response['nro_expediente']);
                $('#nro_gacet_resol_ver').text(response['nro_gacet_resol']);
                $('#telf_solc_ver').text(response['telf_solc']);
                $('#cedula_solc_ver').text(response['cedula_solc']);
                $('#nom_ape_solc_ver').text(response['nom_ape_solc']);
                $('#cargo_ver').text(response['cargo']);
                $('#descp_anul_ver').text(response['descp_anul']); 
                
                // >>> ESTO ES LO QUE FALTABA <<<
                // Una vez que los datos están cargados, forzamos la apertura del modal.
                $('#exampleModal_ver').modal('show'); 
                
            } else {
                 Swal.fire('Error', 'No se encontraron datos de anulación para esta evaluación.', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Hubo un problema al consultar los datos.', 'error');
        }
    });
}
/**
 * Función para validar campos y guardar la solicitud de anulación.
 */
function guardar_anulacion(){
    // Array de campos a validar
    const campos = [
        { id: "nro_oficicio", label: "Nro. de Oficio" },
        { id: "datepicker-default", label: "Fecha de Notificación" },
        { id: "nro_expediente", label: "Nro. del Expediente" },
        { id: "cedula_solc", label: "Cédula del Solicitante" },
        { id: "nom_ape_solc", label: "Nombre y Apellido del Solicitante" },
        { id: "cargo", label: "Cargo" },
        { id: "nro_gacet_resol", label: "Nro. Gaceta o Resolución" },
        { id: "telf_solc", label: "Télefono del Solicitante" }
    ];

    let formValido = true;
    let primerCampoVacio = null;

    // Validación simplificada
    for (const campo of campos) {
        if ($("#" + campo.id).val().trim() === '') {
            formValido = false;
            if (!primerCampoVacio) {
                primerCampoVacio = campo;
            }
            // Puedes agregar aquí un indicador visual de error si usas Bootstrap
            // Ejemplo: $("#" + campo.id).addClass('is-invalid');
        } else {
             // Ejemplo: $("#" + campo.id).removeClass('is-invalid');
        }
    }

    if (!formValido) {
        Swal.fire({
            title: 'Campo Requerido',
            text: `Por favor, complete el campo: ${primerCampoVacio.label}`,
            icon: 'warning',
        });
        $("#" + primerCampoVacio.id).focus();
        return;
    }

    // Si es válido, procede con SweetAlert
    event.preventDefault();
    Swal.fire({
        title: '¿Anular?',
        text: '¿Está seguro que desea solicitar anular la Evaluación de Desempeño?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, guardar!'
    }).then((result) => {
        if (result.isConfirmed) {

            event.preventDefault();
            var datos = new FormData($("#resgistrar_anulacion")[0]);
            var base_url = '/index.php/evaluacion_desempenio/resgistrar_anulacion';
            
            $.ajax({
                url:base_url,
                method: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response) {
                        var menj = 'Se ha Enviado la Solicitud de anulación de la Evaluación de Desempeño Nroº: ';
                        Swal.fire({
                            title: 'Registro Exitoso',
                            text: menj + response,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed){
                                location.reload();
                            }
                        });
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Hubo un problema al registrar la solicitud.', 'error');
                }
            });
        }
    });
}

/**
 * Función para aprobar (registrar) la anulación de la evaluación de desempeño.
 * @param {number} id - ID de la evaluación a aprobar su anulación.
 */
function aprovar_anul(id){
    event.preventDefault();
    Swal.fire({
        title: '¿Aprobar Anulación?',
        text: '¿Está seguro que desea aprobar la anulación de la Evaluación de Desempeño?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, aprobar!'
    }).then((result) => {
        if (result.isConfirmed) {
            event.preventDefault();

            var id_evaluacion = id;
            var base_url = '/index.php/evaluacion_desempenio/resgistrar_aprv_anulacion';
            
            $.ajax({
                url:base_url,
                method: 'POST',
                data: {
                    id_evaluacion: id_evaluacion
                },
                dataType: 'json',
                success: function(response){
                    // Asumimos que la respuesta es el número de anulación
                    if(response) {
                        var menj = 'Se ha **anulado** la Evaluación de Desempeño Nroº: ';
                        Swal.fire({
                            title: 'Proceso Exitoso',
                            html: menj + '<strong>' + response + '</strong>', // Usar HTML para negritas
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed){
                                location.reload();
                            }
                        });
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Hubo un problema al aprobar la anulación.', 'error');
                }
            });
        }
    });
}
