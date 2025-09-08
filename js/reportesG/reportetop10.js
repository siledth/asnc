// Variable global para almacenar los datos procesados para la exportación
let processedReportData = {};
let anioActual;

window.onload = function() {
    buscar();
};

function buscar() {
    document.getElementById('loading').style.display = 'block';
    document.getElementById('items').style.display = 'none';

    fetch(BASE_URL + 'index.php/ReporteTop10/generarReporte', {
        method: 'POST'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log("Datos completos del reporte Top 10:", data);
        
        document.getElementById('loading').style.display = 'none';

        if (data.success) {
            const rawData = data.data;
            anioActual = data.anio_actual;

            if (Object.keys(rawData).length > 0) {
                document.getElementById('items').style.display = 'block';

                // Renderizar la tabla de solicitados
                renderTable('tabla-top-solicitados', rawData.top_solicitados, 'cantidad_solicitada', 'monto_total', 'solicitados');

                // Renderizar la tabla de rendidos
                renderTable('tabla-top-rendidos', rawData.top_rendidos, 'cantidad_ejecutada', 'monto_total', 'rendidos');
                
                // Renderizar la tabla de órganos
                renderTableOrganos('tabla-top-organos', rawData.top_organos);

            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin resultados',
                    text: 'No se encontraron datos para el año actual.',
                    confirmButtonText: 'Entendido'
                });
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

/**
 * Renderiza una tabla del top 10 de productos.
 * @param {string} tableId - ID de la tabla HTML.
 * @param {Array} data - Array de objetos con los datos del top.
 * @param {string} cantidadKey - Nombre de la clave para la cantidad (ej. 'cantidad_solicitada').
 * @param {string} montoKey - Nombre de la clave para el monto (ej. 'monto_total').
 * @param {string} reportKey - Nombre de la clave para el reporte en el objeto global.
 */
function renderTable(tableId, data, cantidadKey, montoKey, reportKey) {
    const tbody = document.querySelector(`#${tableId} tbody`);
    tbody.innerHTML = '';
    
    document.getElementById(`anio-${reportKey}`).innerText = anioActual;

    const totalCantidadAcumulada = data.reduce((acc, item) => acc + parseFloat(item[cantidadKey]), 0);

    let html = '';
    let posicion = 1;

    processedReportData[reportKey] = [];

    data.forEach(item => {
        const porcentaje = totalCantidadAcumulada > 0 ? (parseFloat(item[cantidadKey]) / totalCantidadAcumulada) * 100 : 0;
        
        html += `
            <tr>
                <td>${posicion}</td>
                <td>${item.cod_ccnu || item.codigo_ccnu}</td>
                <td>${item.desc_ccnu}</td>
                <td>${parseInt(item[cantidadKey]).toLocaleString()}</td>
                <td>Bs${parseFloat(item[montoKey]).toLocaleString('es-VE', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                <td>${porcentaje.toFixed(2)}%</td>
            </tr>
        `;
        processedReportData[reportKey].push({
            posicion: posicion,
            codigo_ccnu: item.cod_ccnu || item.codigo_ccnu,
            descripcion: item.desc_ccnu,
            cantidad: parseInt(item[cantidadKey]),
            monto: parseFloat(item[montoKey]),
            porcentaje: porcentaje.toFixed(2) + '%'
        });
        posicion++;
    });

    const totalMontoAcumulado = data.reduce((acc, item) => acc + parseFloat(item[montoKey]), 0);

    html += `
        <tr>
            <td colspan="3" class="text-end">**TOTAL**</td>
            <td>**${totalCantidadAcumulada.toLocaleString()}**</td>
            <td>Bs**${totalMontoAcumulado.toLocaleString('es-VE', {minimumFractionDigits: 2, maximumFractionDigits: 2})}**</td>
            <td>**100%**</td>
        </tr>
    `;
    tbody.innerHTML = html;
}

/**
 * Renderiza la tabla de Top 10 de Órganos/Entes.
 * @param {string} tableId - ID de la tabla HTML.
 * @param {Array} data - Array de objetos con los datos de los órganos.
 */
function renderTableOrganos(tableId, data) {
    const tbody = document.querySelector(`#${tableId} tbody`);
    tbody.innerHTML = '';

    document.getElementById(`anio-organos`).innerText = anioActual;

    const totalLlamados = data.reduce((acc, item) => acc + parseInt(item.cantidad_llamados), 0);

    let html = '';
    let posicion = 1;

    processedReportData['organos'] = [];

    data.forEach(item => {
        const porcentaje = totalLlamados > 0 ? (parseInt(item.cantidad_llamados) / totalLlamados) * 100 : 0;
        
        html += `
            <tr>
                <td>${posicion}</td>
                <td>${item.rif}</td>
                <td>${item.descripcion}</td>
                <td>${parseInt(item.cantidad_llamados).toLocaleString()}</td>
                <td>${porcentaje.toFixed(2)}%</td>
            </tr>
        `;
        processedReportData['organos'].push({
            posicion: posicion,
            rif: item.rif,
            descripcion: item.descripcion,
            cantidad_llamados: parseInt(item.cantidad_llamados),
            porcentaje: porcentaje.toFixed(2) + '%'
        });
        posicion++;
    });

    html += `
        <tr>
            <td colspan="3" class="text-end">**TOTAL**</td>
            <td>**${totalLlamados.toLocaleString()}**</td>
            <td>**100%**</td>
        </tr>
    `;
    tbody.innerHTML = html;
}

// --- Funciones de exportación ---
function exportToExcel() {
    if (Object.keys(processedReportData).length === 0) {
        Swal.fire('No hay datos', 'Primero genere el reporte para exportar', 'warning');
        return;
    }

    const wb = XLSX.utils.book_new();

    const tables = [
        'tabla-top-solicitados', 'tabla-top-rendidos', 'tabla-top-organos'
    ];
    const sheetNames = [
        `Top 10 Solicitados ${anioActual}`, `Top 10 Rendidos ${anioActual}`, `Top 10 Organos ${anioActual}`
    ];

    tables.forEach((tableId, index) => {
        const ws = XLSX.utils.table_to_sheet(document.getElementById(tableId));
        XLSX.utils.book_append_sheet(wb, ws, sheetNames[index]);
    });
    
    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_Top10_Productos_Organos_${fechaReporte}.xlsx`);
}

function exportToPDF() {
    if (Object.keys(processedReportData).length === 0) {
        Swal.fire('No hay datos', 'Primero genere el reporte para exportar', 'warning');
        return;
    }
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({
        orientation: 'portrait',
        unit: 'mm',
        format: 'a4'
    });
    
    doc.setFontSize(16);
    doc.text(`Reporte de Top 10`, doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });

    let currentY = 30;

    const tablesData = [
        { id: 'tabla-top-solicitados', title: `Top 10 Productos Solicitados (${anioActual})` },
        { id: 'tabla-top-rendidos', title: `Top 10 Productos Rendidos (${anioActual})` },
        { id: 'tabla-top-organos', title: `Top 10 Órganos/Entes con más Llamados (${anioActual})` }
    ];

    tablesData.forEach(table => {
        doc.setFontSize(12);
        doc.text(table.title, 10, currentY);
        doc.autoTable({
            html: `#${table.id}`,
            startY: currentY + 5,
            headStyles: { fillColor: [220, 53, 69], textColor: [255, 255, 255], fontStyle: 'bold' },
            styles: { fontSize: 9 },
            didDrawPage: function(data) {
                currentY = data.cursor.y + 10;
            }
        });
        currentY = doc.lastAutoTable.finalY + 10;
    });

    doc.save(`Reporte_Top10_Productos_Organos_${new Date().toISOString().slice(0, 10)}.pdf`);
}
