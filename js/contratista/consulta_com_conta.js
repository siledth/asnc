function consultar_nombre(){
    var nombre = $('#nombre').val();
    if (nombre == '') {
        //...
    } else {
        $("#items").show();
        var base_url = '/index.php/Contratista/llenar_contratista_comi_conta1';
        // var base_url =window.location.origin+'/asnc/index.php/Contratista/llenar_contratista_comi_conta1';
        $.ajax({
            url: base_url,
            method: 'post',
            data: { nombre: nombre },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    // Mostrar inputs en lugar de la tabla
                    $('#tabla').hide();
                    $('#items').hide();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                } else {
                    $('#tabla').show();
                    $('#items').show();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#tabla tbody').children().remove()
                    $.each(data, function(index, response){
                        $('#tabla tbody').append('<tr><td>' + response['rifced'] + '</td><td>'
                                                        + response['nombre'] + '</td><td>'
                                                        + '<button class="boton2 btn"> <a href="llenar_contratista_nombre_ind?id='+ response['rifced'] +'">VER</button></td></tr>');
                    });

                    // Inicializar DataTables y configurar la paginación
                    $('#tabla').DataTable({
                        "paging": true,
                        "pageLength": 10, // número de filas por página
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]] // opciones de número de filas por página
                    });
                }
            }
        });
    }
}