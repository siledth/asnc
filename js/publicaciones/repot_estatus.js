function modal_ver(id) {
    var id = id;
    // var base_url = window.location.origin + '/asnc/index.php/Publicaciones/consulta_estatu';
   var base_url = '/index.php/Publicaciones/consulta_estatu';
    $.ajax({
        url: base_url,
        method: 'post',
        data: { id: id },
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
            $('#modalidad').val(response['modalidad']);
            $('#mecanismo').val(response['mecanismo']);
            $('#objeto_contratacion').val(response['objeto_contratacion']);
            $('#dias_habiles').val(response['dias_habiles']);
          //  $('#fecha_disponible_llamado').val(response['fecha_disponible_llamado']);
           // $('#fecha_fin_llamado').val(response['fecha_fin_llamado']);
            $('#hora_desde').val(response['hora_desde']);
            $('#hora_hasta').val(response['hora_hasta']);
            $('#direccion').val(response['direccion']);
            $('#direccion').val(response['direccion']);
            // $('#fecha_llamados').val(response['fecha_llamado']);
            // $('#fecha_fin_aclaratoria').val(response['fecha_fin_aclaratoria']);
            //$('#fecha_tope').val(response['fecha_tope']);
            /////////////apertura de sobre
            // $('#fecha_fin_llamados').val(response['fecha_fin_llamado']);
            $('#hora_desde_sobre').val(response['hora_desde_sobre']);
            $('#lugar_entrega').val(response['lugar_entrega']);
            $('#direccion_sobre').val(response['direccion_sobre']);
            $('#observaciones').val(response['observaciones']);
            $('#especifique_anulacion').val(response['especifique_anulacion']);
            //////////////////formatear fechas   
            var fecha = Date.parse(response['fecha_llamado'])
            const date = new Date(fecha)
            date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
            const formatFullDate = date.toLocaleDateString()
            $('#fecha_llamado').val(formatFullDate);
            ////////
            var fecha2 = Date.parse(response['fecha_disponible_llamado'])
            const date2 = new Date(fecha2)
            date2.setMinutes(date2.getMinutes() + date2.getTimezoneOffset());
            const formatFullDate2 = date2.toLocaleDateString()
            $('#fecha_disponible_llamado').val(formatFullDate2);
            ////////
            var fecha3 = Date.parse(response['fecha_fin_llamado'])
            const date3 = new Date(fecha3)
            date3.setMinutes(date3.getMinutes() + date3.getTimezoneOffset());
            const formatFullDate3 = date3.toLocaleDateString()
            $('#fecha_fin_llamado').val(formatFullDate3);
            ////
            var fecha4 = Date.parse(response['fecha_inicio_aclaratoria'])
            const date4 = new Date(fecha4)
            date4.setMinutes(date4.getMinutes() + date4.getTimezoneOffset());
            const formatFullDate4 = date4.toLocaleDateString()
            $('#fecha_inicio_aclaratoria').val(formatFullDate4);
            ////
            var fecha5 = Date.parse(response['fecha_fin_aclaratoria'])
            const date5 = new Date(fecha5)
            date5.setMinutes(date5.getMinutes() + date5.getTimezoneOffset());
            const formatFullDate5 = date5.toLocaleDateString()
            $('#fecha_fin_aclaratoria').val(formatFullDate5);
            ////
            var fecha6 = Date.parse(response['fecha_tope'])
            const date6 = new Date(fecha6)
            date6.setMinutes(date6.getMinutes() + date6.getTimezoneOffset());
            const formatFullDate6 = date6.toLocaleDateString()
            $('#fecha_tope').val(formatFullDate6);
            ////
            var fecha7 = Date.parse(response['fecha_fin_llamado'])
            const date7 = new Date(fecha7)
            date7.setMinutes(date7.getMinutes() + date7.getTimezoneOffset());
            const formatFullDate7 = date7.toLocaleDateString()
            $('#fecha_fin_llamados').val(formatFullDate7);

            ////
            // let hoy = response['hora_desde'];
            // let horas = hoy.getHours();
            // let minutos = hoy.getMinutes();
            // let segundos = hoy.getSeconds();
            // let jornada = horas >= 12 ? 'PM' : 'AM';
            // console.log(${horas} ${jornada} : ${minutos} : ${segundos});

            // $('#hora_desdes').val(rtt);
        }

    });
}











$(document).on("click", ".print", function () {
    const section = $("section");
    const modalBody = $(".modal-body").detach();

    const content = $(".content").detach();
    section.append(modalBody);
    window.print();
    section.empty();
    section.append(content);
    $(".modal-body-wrapper").append(modalBody);
});
