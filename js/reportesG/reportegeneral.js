function buscar() {
    // Obtener valores de los inputs
    const fechad = document.getElementById('fechad').value;
    const fechah = document.getElementById('fechah').value;
    
    // Validar que ambas fechas estén seleccionadas
    if (!fechad || !fechah) {
        Swal.fire({
            icon: 'warning',
            title: 'Fechas requeridas',
            text: 'Por favor seleccione ambas fechas',
            confirmButtonText: 'Entendido'
        });
        return;
    }
    
    // Validar que la fecha hasta no sea menor que la fecha desde
    if (new Date(fechah) < new Date(fechad)) {
        Swal.fire({
            icon: 'error',
            title: 'Fechas inválidas',
            text: 'La fecha hasta no puede ser menor que la fecha desde',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    // Mostrar loading y ocultar resultados anteriores
    document.getElementById('loading').style.display = 'block';
    document.getElementById('items').style.display = 'none';
    
    // Obtener la ruta base del formulario
    const baseUrl = window.location.origin + '/asnc/index.php/';
    
    // Realizar petición AJAX
    fetch(baseUrl + 'ReporteRNCE/generarReporte', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `fechad=${encodeURIComponent(fechad)}&fechah=${encodeURIComponent(fechah)}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos:', data);
        document.getElementById('loading').style.display = 'none';
        
        if (data.success) {
            // Extraer datos
            const programacion = data.data.total_programacion || 0;
            const notificadas = data.data.total_notificadas || 0;
            
            const proyectos = data.data.proyectos || {};
            const acciones = data.data.acciones || {};
            const topProductos = data.data.top_productos || [];
            
            // Verificar si hay datos
            const hasData = programacion > 0 || notificadas > 0 || 
                          proyectos.total > 0 || acciones.total > 0 ||
                          topProductos.length > 0;
            
            if (!hasData) {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin resultados',
                    text: data.message,
                    confirmButtonText: 'Entendido'
                });
                document.getElementById('items').style.display = 'none';
                return;
            }
            
            // Mostrar resultados
            document.getElementById('items').style.display = 'block';
            
            // Tabla Programación
            document.querySelector('#tabla-programacion tbody').innerHTML = `
                <tr>
                    <td>${programacion}</td>
                    <td>${notificadas}</td>
                </tr>
            `;
            
            // Tabla Proyectos
            document.querySelector('#tabla-proyectos tbody').innerHTML = `
                <tr>
                    <td>${proyectos.total || 0}</td>
                    <td>${proyectos.bienes || 0}</td>
                    <td>${proyectos.servicios || 0}</td>
                    <td>${proyectos.obras || 0}</td>
                </tr>
            `;
            
            // Tabla Acciones
            document.querySelector('#tabla-acciones tbody').innerHTML = `
                <tr>
                    <td>${acciones.total || 0}</td>
                    <td>${acciones.bienes || 0}</td>
                    <td>${acciones.servicios || 0}</td>
                    <td>${acciones.obras || 0}</td>
                </tr>
            `;
            
            // Tabla Top 10 Productos
            const tbodyTopProductos = document.querySelector('#tabla-top-productos tbody');
            tbodyTopProductos.innerHTML = '';
            
            if (topProductos.length > 0) {
                topProductos.forEach((producto, index) => {
                    tbodyTopProductos.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${producto.codigo_ccnu || 'N/A'}</td>
                            <td>${producto.descripcion_producto || 'Sin descripción'}</td>
                            <td>${producto.cantidad_utilizada || 0}</td>
                            <td>${producto.monto_total ? formatCurrency(producto.monto_total) : '$0.00'}</td>
                        </tr>
                    `;
                });
            } else {
                tbodyTopProductos.innerHTML = `
                    <tr>
                        <td colspan="5">No se encontraron productos</td>
                    </tr>
                `;
            }
            
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonText: 'Entendido'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loading').style.display = 'none';
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al procesar la solicitud: ' + error.message,
            confirmButtonText: 'Entendido'
        });
    });
}

// Función auxiliar para formatear moneda (añadir al final del archivo JS)
function formatCurrency(amount) {
    return 'Bs' + parseFloat(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}