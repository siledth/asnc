// Variable global para almacenar los datos procesados para la exportación
let processedReportData = {};
let anioActual;
let anioAnterior;

window.onload = function() {
    buscar();
};

function buscar() {
    document.getElementById('loading').style.display = 'block';
    document.getElementById('items').style.display = 'none';

    fetch(BASE_URL + 'index.php/ReporteEvaluaciones/generarReporte', {
        method: 'POST'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        // --- SECCIÓN DE DIAGNÓSTICO ---
        console.log("Datos completos recibidos del servidor:", data);
        console.log("Datos de Calificaciones:", data.data.calificaciones);
        console.log("Datos de Anuladas:", data.data.anuladas);
        // --- FIN DE SECCIÓN DE DIAGNÓSTICO ---

        document.getElementById('loading').style.display = 'none';
        
        if (data.success) {
            const rawData = data.data;
            anioActual = data.anio_actual;
            anioAnterior = data.anio_anterior;

            if (Object.keys(rawData).length > 0) {
                document.getElementById('items').style.display = 'block';
                processAndRenderData(rawData);
            } else {
                // Se ha ajustado la sintaxis para evitar la advertencia de SweetAlert2
                Swal.fire('Sin resultados', 'No se encontraron datos para el rango de fechas.', 'info');
            }
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loading').style.display = 'none';
        Swal.fire('Error', 'Ocurrió un error al procesar la solicitud: ' + error.message, 'error');
    });
}

function processAndRenderData(rawData) {
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const lastMonth = new Date().getMonth() + 1;

    // Función auxiliar para convertir el array de la API a un Map para un acceso más sencillo
    const getDataByMonth = (dataArray, keyName) => {
        const dataMap = new Map();
        dataArray.forEach(item => {
            const value = item[keyName] !== undefined ? parseInt(item[keyName]) : 0;
            dataMap.set(parseInt(item.mes_numero), value);
        });
        return dataMap;
    };
    
    // Nueva función para procesar los datos de calificaciones
    const processCalificaciones = (data, anio) => {
        const calificacionesMap = {
            'EXCELENTE': new Map(),
            'BUENO': new Map(),
            'REGULAR': new Map(),
            'DEFICIENTE': new Map()
        };
        data.forEach(item => {
            const mesNumero = parseInt(item.mes_numero);
            const total = parseInt(item.total);
            const calificacion = item.calificacion.toUpperCase();
            if (calificacionesMap[calificacion]) {
                calificacionesMap[calificacion].set(mesNumero, total);
            }
        });
        return calificacionesMap;
    };

    // Procesar los datos de calificación de ambos años
    const calificacionesAnioActual = processCalificaciones(rawData.calificaciones[anioActual] || [], anioActual);
    const calificacionesAnioAnterior = processCalificaciones(rawData.calificaciones[anioAnterior] || [], anioAnterior);

    // Renderizar tablas de calificación
    processedReportData['excelente'] = renderTable('tabla-excelente', {
        [anioActual]: calificacionesAnioActual['EXCELENTE'],
        [anioAnterior]: calificacionesAnioAnterior['EXCELENTE']
    }, meses, lastMonth);

    processedReportData['bueno'] = renderTable('tabla-bueno', {
        [anioActual]: calificacionesAnioActual['BUENO'],
        [anioAnterior]: calificacionesAnioAnterior['BUENO']
    }, meses, lastMonth);

    processedReportData['regular'] = renderTable('tabla-regular', {
        [anioActual]: calificacionesAnioActual['REGULAR'],
        [anioAnterior]: calificacionesAnioAnterior['REGULAR']
    }, meses, lastMonth);

    processedReportData['deficiente'] = renderTable('tabla-deficiente', {
        [anioActual]: calificacionesAnioActual['DEFICIENTE'],
        [anioAnterior]: calificacionesAnioAnterior['DEFICIENTE']
    }, meses, lastMonth);
    
    // Renderizar tabla de anuladas
    const anuladasData = {
        [anioActual]: getDataByMonth(rawData.anuladas[anioActual], 'total'),
        [anioAnterior]: getDataByMonth(rawData.anuladas[anioAnterior], 'total')
    };
    processedReportData['anuladas'] = renderTable('tabla-anuladas', anuladasData, meses, lastMonth);

}

function renderTable(tableId, data, meses, lastMonth) {
    const tbody = document.querySelector(`#${tableId} tbody`);
    if (!tbody) {
        console.error(`Error: tbody no encontrado para la tabla con ID: ${tableId}`);
        return;
    }
    tbody.innerHTML = '';
    
    const idPrefix = tableId.replace('tabla-', '').replace(/-/g, '_');
    const anioActualTh = document.getElementById(`anio_actual_${idPrefix}`);
    const anioAnteriorTh = document.getElementById(`anio_anterior_${idPrefix}`);
    
    if (anioActualTh && anioAnteriorTh) {
        anioActualTh.innerText = anioActual;
        anioAnteriorTh.innerText = anioAnterior;
    } else {
        console.error(`Error: Elementos de cabecera no encontrados para el prefijo de ID: anio_${idPrefix}`);
    }

    let totalAnioActual = 0;
    let totalAnioAnterior = 0;

    for (let i = 0; i < lastMonth; i++) {
        const mesNumero = i + 1;
        const anioActualValue = data[anioActual].get(mesNumero) || 0;
        const anioAnteriorValue = data[anioAnterior].get(mesNumero) || 0;
        
        const diferencia = anioActualValue - anioAnteriorValue;
        const variacion = anioAnteriorValue > 0 ? ((diferencia / anioAnteriorValue) * 100).toFixed(2) : 0;
        
        totalAnioActual += anioActualValue;
        totalAnioAnterior += anioAnteriorValue;

        const diferenciaClass = diferencia < 0 ? 'text-danger' : '';
        const variacionClass = diferencia < 0 ? 'text-danger' : '';

        tbody.innerHTML += `
            <tr>
                <td>${meses[i]}</td>
                <td>${anioActualValue}</td>
                <td>${anioAnteriorValue}</td>
                <td class="${diferenciaClass}">${diferencia}</td>
                <td class="${variacionClass}">${variacion}%</td>
            </tr>
        `;
    }
    
    const totalDiferencia = totalAnioActual - totalAnioAnterior;
    const totalVariacion = totalAnioAnterior > 0 ? ((totalDiferencia / totalAnioAnterior) * 100).toFixed(2) : 0;
    const promedioActual = (totalAnioActual / lastMonth).toFixed(0);
    const promedioAnterior = (totalAnioAnterior / lastMonth).toFixed(0);
    
    const totalDiferenciaClass = totalDiferencia < 0 ? 'text-danger' : '';
    const totalVariacionClass = totalDiferencia < 0 ? 'text-danger' : '';
    
    tbody.innerHTML += `
        <tr><td colspan="5"></td></tr>
        <tr>
            <td>TOTAL</td>
            <td>${totalAnioActual}</td>
            <td>${totalAnioAnterior}</td>
            <td class="${totalDiferenciaClass}">${totalDiferencia}</td>
            <td class="${totalVariacionClass}">${totalVariacion}%</td>
        </tr>
        <tr>
            <td>PROMEDIO</td>
            <td>${promedioActual}</td>
            <td>${promedioAnterior}</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td>A la fecha:</td>
            <td>${totalAnioActual}</td>
            <td>${totalAnioAnterior}</td>
            <td class="${totalDiferenciaClass}">${totalDiferencia}</td>
            <td class="${totalVariacionClass}">${totalVariacion}%</td>
        </tr>
    `;
}

function exportToExcel() {
    if (Object.keys(processedReportData).length === 0) {
        Swal.fire('No hay datos', 'Primero genere el reporte para exportar', 'warning');
        return;
    }

    const wb = XLSX.utils.book_new();
    const tables = [
        'tabla-excelente', 'tabla-bueno', 'tabla-regular', 'tabla-deficiente', 'tabla-anuladas'
    ];
    const sheetNames = [
        'Excelente', 'Bueno', 'Regular', 'Deficiente', 'Anuladas'
    ];

    tables.forEach((tableId, index) => {
        const ws = XLSX.utils.table_to_sheet(document.getElementById(tableId));
        XLSX.utils.book_append_sheet(wb, ws, sheetNames[index]);
    });
    
    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_Evaluaciones_${fechaReporte}.xlsx`);
}

function exportToPDF() {
    if (Object.keys(processedReportData).length === 0) {
        Swal.fire('No hay datos', 'Primero genere el reporte para exportar', 'warning');
        return;
    }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({
        orientation: 'landscape',
        unit: 'mm',
        format: 'a4'
    });
    
    doc.setFontSize(16);
    doc.text('Reporte de Evaluaciones de Desempeño', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });

    let currentY = 30;

    const tablesData = [
        { id: 'tabla-excelente', title: 'Excelente' },
        { id: 'tabla-bueno', title: 'Bueno' },
        { id: 'tabla-regular', title: 'Regular' },
        { id: 'tabla-deficiente', title: 'Deficiente' },
        { id: 'tabla-anuladas', title: 'Anuladas' }
    ];

    tablesData.forEach((table, index) => {
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

    doc.save(`Reporte_Evaluaciones_${new Date().toISOString().slice(0, 10)}.pdf`);
}
