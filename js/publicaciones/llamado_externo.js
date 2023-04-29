function llenar_filtro() {
    var tipo = $("#sltTipoFiltro").val();
    if (tipo == "2") {
        $("#camposIdentificadores").show();
        $("#camposFechas").hide();
        $("#camposTextos").hide();
        $("#camposObjetoContratacion").hide();
    } else if (tipo == "3") {
        $("#camposFechas").show();
        $("#camposIdentificadores").hide();
        $("#camposTextos").hide();
        $("#camposObjetoContratacion").hide();
    } else if (tipo == "4") {
        $("#camposFechas").show();
        $("#camposIdentificadores").hide();
        $("#camposTextos").hide();
        $("#camposObjetoContratacion").hide();
    } else if (tipo == "5") {
        $("#camposTextos").show();
        $("#camposFechas").hide();
        $("#camposIdentificadores").hide();
        $("#camposObjetoContratacion").hide();
    } else if (tipo == "6") {
        $("#camposObjetoContratacion").show();
        $("#camposFechas").hide();
        $("#camposIdentificadores").hide();
        $("#camposTextos").hide();

    } else {
        $("#camposIdentificadores").hide();
        $("#camposFechas").hide();
        $("#camposTextos").hide();
        $("#camposObjetoContratacion").hide();

    }
}
// function modal_ver(numero_proceso){
//     var numero_proceso = numero_proceso;
//     //var base_url = window.location.origin+'/asnc/index.php/GeneratePdfController/index';
//         // var base_url = '/index.php/Certificacion/consulta_b';
//     var base_url = window.location.origin+'/asnc/index.php/Gestion/consulta_b';
//     $.ajax({
//         url: base_url,
//         method:'post',
//         data: {numero_proceso: numero_proceso},
//         dataType:'json',

//         success: function(response){
//             $('#numero_proceso').val(response['numero_proceso']);
//             $('#rif_organoente').val(response['rif_organoente']);
//             $('#organoente').val(response['organoente']);
//         }
//     });
// }

function modal_ver(id) {
    var numero_proceso = id;
    // var base_url = window.location.origin + '/asnc/index.php/Gestion/consulta_b';
    var base_url = '/index.php/Gestion/consulta_b';
    $.ajax({
        url: base_url,
        method: 'post',
        data: { numero_proceso: numero_proceso },
        dataType: 'json',

        success: function (response) {
            $('#numero_proceso').val(response['numero_proceso']);
            $('#rif_organoente').val(response['rif_organoente']);
            $('#organoente').val(response['organoente']);
            $('#siglas').val(response['siglas']);
            $('#web_contratante').val(response['web_contratante']);
            $('#denominacion_proceso').val(response['denominacion_proceso']);
            $('#descripcion_contratacion').val(response['descripcion_contratacion']);
            $('#estatus').val(response['estatus']);
            $('#fecha_llamado').val(response['fecha_llamado']);
            //new Date( $('#fecha_llamado').val(response['fecha_llamado'])).toLocaleDateString();
            // let date = new Date(response['fecha_llamado']).toLocaleDateString(); // dar formato a la fecha
            // $('#fecha_llamados').val(date);
            // var date = new Date(response['fecha_llamado']);
            // result = date.toLocaleDateString();
            // $('#fecha_llamados').val(result);

            $('#modalidad').val(response['modalidad']);
            $('#mecanismo').val(response['mecanismo']);
            $('#objeto_contratacion').val(response['objeto_contratacion']);
            $('#dias_habiles').val(response['dias_habiles']);
            $('#fecha_disponible_llamado').val(response['fecha_disponible_llamado']);
            $('#fecha_fin_llamado').val(response['fecha_fin_llamado']);
            $('#hora_desde').val(response['hora_desde']);
            $('#hora_hasta').val(response['hora_hasta']);
            $('#direccion').val(response['direccion']);
            $('#direccion').val(response['direccion']);
            $('#fecha_llamados').val(response['fecha_llamado']);
            $('#fecha_fin_aclaratoria').val(response['fecha_fin_aclaratoria']);
            $('#fecha_tope').val(response['fecha_tope']);
            /////////////apertura de sobre
            $('#fecha_fin_llamados').val(response['fecha_fin_llamado']);
            $('#hora_desde_sobre').val(response['hora_desde_sobre']);
            $('#lugar_entrega').val(response['lugar_entrega']);
            $('#direccion_sobre').val(response['direccion_sobre']);
            $('#observaciones').val(response['observaciones']);





            




            


        }
    });
}

$(document).on("click", ".print", function() {
    const section = $("section");
    const modalBody = $(".modal-body").detach();

    const content = $(".content").detach();
    section.append(modalBody);
    window.print();
    section.empty();
    section.append(content);
    $(".modal-body-wrapper").append(modalBody);
});
