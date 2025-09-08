// Variable global para almacenar los datos procesados del reporte para la exportación
let processedReportData = {};
let anioActual;
let anioAnterior;

window.onload = function() {
    buscar();
};

function buscar() {
    document.getElementById('loading').style.display = 'block';
    document.getElementById('items').style.display = 'none';

    fetch(BASE_URL + 'index.php/ReportePAC/generarReporte', {
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
        console.log("Datos de PAC Registrados:", data.data.registrados);
        console.log("Datos de PAC Notificados:", data.data.notificados);
        console.log("Datos de Rendiciones Registradas:", data.data.rendidas);
        // --- FIN DE SECCIÓN DE DIAGNÓSTICO ---

        document.getElementById('loading').style.display = 'none';
        
        if (data.success) {
            const rawData = data.data;
            anioActual = data.anio_actual;
            anioAnterior = data.anio_anterior;

            if (Object.keys(rawData).length > 0) {
                document.getElementById('items').style.display = 'block';

                // Usamos una función para procesar y renderizar todas las tablas
                processAndRenderData(rawData);
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin resultados',
                    text: 'No se encontraron datos para el rango de fechas.',
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

function processAndRenderData(rawData) {
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const lastMonth = new Date().getMonth() + 1;

    // Función auxiliar para convertir el array de la API a un Map para un acceso más sencillo
    const getDataByMonth = (dataArray, keyName) => {
        const dataMap = new Map();
        dataArray.forEach(item => {
            // Se asegura que la propiedad exista antes de acceder a ella
            const value = item[keyName] !== undefined ? parseInt(item[keyName]) : 0;
            dataMap.set(parseInt(item.mes_numero), value);
        });
        return dataMap;
    };

    // Procesar y renderizar tablas de PAC
    const pacRegistradosData = {
        [anioActual]: getDataByMonth(rawData.registrados[anioActual], 'total'),
        [anioAnterior]: getDataByMonth(rawData.registrados[anioAnterior], 'total')
    };
    renderTable('tabla-pac-registrados', pacRegistradosData, meses, lastMonth);

    const pacNotificadosData = {
        [anioActual]: getDataByMonth(rawData.notificados[anioActual], 'total_notificadas'),
        [anioAnterior]: getDataByMonth(rawData.notificados[anioAnterior], 'total_notificadas')
    };
    // PASO CLAVE: Se pasa el nombre de la clave correcta para esta tabla
    renderTable('tabla-pac-notificados', pacNotificadosData, meses, lastMonth);

    // Calcular y renderizar PAC en Edición
    const pacEdicionData = {
        [anioActual]: new Map(),
        [anioAnterior]: new Map()
    };
    for(let i = 1; i <= lastMonth; i++) {
        const totalRegistradosActual = pacRegistradosData[anioActual].get(i) || 0;
        const totalRegistradosAnterior = pacRegistradosData[anioAnterior].get(i) || 0;
        const totalNotificadosActual = pacNotificadosData[anioActual].get(i) || 0;
        const totalNotificadosAnterior = pacNotificadosData[anioAnterior].get(i) || 0;
        pacEdicionData[anioActual].set(i, totalRegistradosActual - totalNotificadosActual);
        pacEdicionData[anioAnterior].set(i, totalRegistradosAnterior - totalNotificadosAnterior);
    }
    renderTable('tabla-pac-edicion', pacEdicionData, meses, lastMonth);

    // Procesar y renderizar tablas de Rendiciones
    const rendicionesRegistradasData = {
        [anioActual]: getDataByMonth(rawData.rendidas[anioActual], 'total_rendida'),
        [anioAnterior]: getDataByMonth(rawData.rendidas[anioAnterior], 'total_rendida')
    };
    // PASO CLAVE: Se pasa el nombre de la clave correcta para esta tabla
    renderTable('tabla-rendiciones-registradas', rendicionesRegistradasData, meses, lastMonth);
    
   

    // Calcular y renderizar Rendiciones Notificadas
    const rendicionesNotificadasData = {
        [anioActual]: new Map(),
        [anioAnterior]: new Map()
    };
    for(let i = 1; i <= lastMonth; i++) {
        const totalNotificadosActual = pacNotificadosData[anioActual].get(i) || 0;
        const totalNotificadosAnterior = pacNotificadosData[anioAnterior].get(i) || 0;
        const totalRendidasActual = rendicionesRegistradasData[anioActual].get(i) || 0;
        const totalRendidasAnterior = rendicionesRegistradasData[anioAnterior].get(i) || 0;
        rendicionesNotificadasData[anioActual].set(i, totalNotificadosActual - totalRendidasActual);
        rendicionesNotificadasData[anioAnterior].set(i, totalNotificadosAnterior - totalRendidasAnterior);
    }
    renderTable('tabla-rendiciones-notificadas', rendicionesNotificadasData, meses, lastMonth);

     // Calcular y renderizar Rendiciones en Edición
    const rendicionesEdicionData = {
        [anioActual]: new Map(),
        [anioAnterior]: new Map()
    };
    for(let i = 1; i <= lastMonth; i++) {
        const totalRegistradosActual = rendicionesRegistradasData[anioActual].get(i) || 0;
        const totalRegistradosAnterior = rendicionesRegistradasData[anioAnterior].get(i) || 0;
        const totalRendidasActual = rendicionesNotificadasData[anioActual].get(i) || 0;
        const totalRendidasAnterior = rendicionesNotificadasData[anioAnterior].get(i) || 0;
        rendicionesEdicionData[anioActual].set(i, totalRegistradosActual - totalRendidasActual);
        rendicionesEdicionData[anioAnterior].set(i, totalRegistradosAnterior - totalRendidasAnterior);
    }
    renderTable('tabla-rendiciones-edicion', rendicionesEdicionData, meses, lastMonth);
}

function renderTable(tableId, data, meses, lastMonth) {
    const tbody = document.querySelector(`#${tableId} tbody`);
    if (!tbody) {
        console.error(`Error: tbody no encontrado para la tabla con ID: ${tableId}`);
        return;
    }
    tbody.innerHTML = '';
    
    // El ID se construye a partir del id de la tabla
    const idPrefix = tableId.replace('tabla-', '').replace(/-/g, '_');
    const anioActualTh = document.getElementById(`anio_actual_${idPrefix}`);
    const anioAnteriorTh = document.getElementById(`anio_anterior_${idPrefix}`);
    
    // Verificación de nulidad para evitar el error de `Cannot set properties of null`
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

// Función para exportar a Excel (se mantiene igual)
function exportToExcel() {
    if (document.getElementById('items').style.display === 'none') {
        Swal.fire({
            icon: 'warning',
            title: 'No hay datos',
            text: 'Primero genere el reporte para exportar',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const wb = XLSX.utils.book_new();
    const tables = [
        'tabla-pac-registrados', 'tabla-pac-edicion', 'tabla-pac-notificados',
        'tabla-rendiciones-registradas', 'tabla-rendiciones-edicion', 'tabla-rendiciones-notificadas'
    ];
    const sheetNames = [
        'PAC Registrados', 'PAC en Edición', 'PAC Notificados',
        'Rend. Registradas', 'Rend. en Edición', 'Rend. Notificadas'
    ];

    tables.forEach((tableId, index) => {
        const ws = XLSX.utils.table_to_sheet(document.getElementById(tableId));
        XLSX.utils.book_append_sheet(wb, ws, sheetNames[index]);
    });
    
    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_PAC_${fechaReporte}.xlsx`);
}

// Función para exportar a PDF (se mantiene igual)
function exportToPDF() {
    if (document.getElementById('items').style.display === 'none') {
        Swal.fire({
            icon: 'warning',
            title: 'No hay datos',
            text: 'Primero genere el reporte para exportar',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({
        orientation: 'landscape',
        unit: 'mm',
        format: 'a4'
    });
    
    doc.setFontSize(16);
    doc.text('Reporte de Plan Anual de Compras (PAC)', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });

    let currentY = 30;

    const tablesData = [
        { id: 'tabla-pac-registrados', title: 'PAC Registrados' },
        { id: 'tabla-pac-edicion', title: 'PAC en Edición' },
        { id: 'tabla-pac-notificados', title: 'PAC Notificados' },
        { id: 'tabla-rendiciones-registradas', title: 'Rendiciones Registradas' },
        { id: 'tabla-rendiciones-edicion', title: 'Rendiciones en Edición' },
        { id: 'tabla-rendiciones-notificadas', title: 'Rendiciones Notificadas' }
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

    doc.save(`Reporte_PAC_${new Date().toISOString().slice(0, 10)}.pdf`);
}