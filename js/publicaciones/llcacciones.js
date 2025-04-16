function consultar_nombre6() {
    // Destruir la tabla si ya está inicializada
    if ($.fn.DataTable.isDataTable('#tabla')) {
        $('#tabla').DataTable().destroy();
    }

    var nombre = $('#nombre').val();
    if (nombre == '') {
        alert('Por favor ingrese un numero de proceso.');
        return;
    } else {
        $("#items").show();
        $("#loading").show();
        // var base_url = window.location.origin + '/asnc/index.php/Publicaciones/busquedallcacciones';
        var base_url = '/index.php/Publicaciones/busquedallcacciones';
        // var delete_url = window.location.origin + '/asnc/index.php/Publicaciones/eliminarRegistro';

        $.ajax({
            url: base_url,
            method: 'post',
            data: { nombre: nombre },
            dataType: 'json',
            success: function(response) {
                $("#loading").hide();

                // Verificación correcta de respuesta vacía o error
                if ((response.error === true) || (Array.isArray(response) && response.length === 0)) {
                    $('#tabla').hide();
                    $('#items').hide();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(0);
                    
                    // Mostrar alerta con el mensaje del servidor o uno por defecto
                 Swal.fire({
                    icon: 'info',
                    title: 'Sin resultados',
                    text: 'No se encontraron resultados para el número de proceso ingresado',
                    confirmButtonText: 'Entendido'
                });
                    return;
                }

                // Si hay datos válidos (array no vacío)
                if (Array.isArray(response) && response.length > 0) {
                    $('#tabla').show();
                    $('#items').show();
                    $('#inputs').show();
                    $('#cedula').val(nombre);
                    $('#existe').val(1);

                    $('#tabla tbody').empty(); // Limpiar tabla
                    
                    $.each(response, function(index, item) {
                        $('#tabla tbody').append(`
                            <tr>
                                <td>${item.numero_proceso}</td>
                                <td>${item.desc_org}</td>
                                <td>${item.desc_acciones}</td>
                                <td>${item.num_contrato}</td>
                                <td>${item.monto_contrato}</td>
                                <td>${item.total_contrato}</td>
                                <td>
                                    <button class="btn btn-danger btn-eliminar" 
                                            data-proceso="${item.numero_proceso}">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `);
                    });

                    // Inicializar DataTable
                    $('#tabla').DataTable({
                        "paging": true,
                        "pageLength": 10,
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "excel",
                            text: "Exportar Hoja de Cálculo"
                        }]
                    });
                } else {
                    // Respuesta inesperada
                     Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al eliminar: ' + (response.message || 'Por favor intente nuevamente'),
                    confirmButtonText: 'Entendido'
                });
                    // alert('Respuesta inesperada del servidor');
                   // console.error('Respuesta inesperada:', response);
                }
            },
            error: function(xhr, status, error) {
                $("#loading").hide();
                alert('Error al cargar los datos: ' + error);
            }
        });
    }
}

// Evento de eliminación (mejorado)
$(document).on('click', '.btn-eliminar', function() {
    if (confirm('¿Está seguro que desea eliminar este registro?')) {
        var $btn = $(this);
        var proceso = $btn.data('proceso');
        var $row = $btn.closest('tr');
        // var delete_url = window.location.origin + '/asnc/index.php/Publicaciones/eliminarRegistro';
        var delete_url = '/index.php/Publicaciones/eliminarRegistro';

        
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Eliminando...');
        
        $.ajax({
            url: delete_url,
            method: 'POST',
            data: { numero_proceso: proceso },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $row.fadeOut(400, function() {
                        $(this).remove();
                    });
                    Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Registro eliminado correctamente',
                    confirmButtonText: 'Aceptar'
                });
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al eliminar: ' + (response.message || 'Error al eliminar el registro'),
                    confirmButtonText: 'Entendido'
                });
                    // alert(response.message || 'Error al eliminar el registro');
                    $btn.prop('disabled', false).text('Eliminar');
                }
            },
            error: function() {
                 Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al eliminar: ' + (response.message || 'Por favor, intente de nuevo.'),
                    confirmButtonText: 'Entendido'
                });
                $btn.prop('disabled', false).text('Eliminar');
            }
        });
    }
});