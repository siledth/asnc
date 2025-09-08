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

    // const baseUrl = window.location.origin + '/asnc/index.php/';

    fetch(BASE_URL + 'index.php/ReporteLlamados/generarReporte', {
        method: 'POST'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('loading').style.display = 'none';
        
        if (data.success) {
            const rawData = data.data;
            anioActual = data.anio_actual;
            anioAnterior = data.anio_anterior;

            if (Object.keys(rawData).length > 0) {
                document.getElementById('items').style.display = 'block';

                const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                const lastMonth = new Date().getMonth() + 1;
                
                // Procesar los datos crudos por tipo de objeto
                const dataByTipo = {
                    '1': { [anioActual]: [], [anioAnterior]: [] }, // Bienes
                    '2': { [anioActual]: [], [anioAnterior]: [] }, // Servicios
                    '3': { [anioActual]: [], [anioAnterior]: [] }  // Obras
                };

                // Llenar la estructura de datos con los totales de cada mes
                [anioAnterior, anioActual].forEach(anio => {
                    if (rawData[anio]) {
                        rawData[anio].forEach(item => {
                            dataByTipo[item.id_objeto_contratacion][anio].push(item);
                        });
                    }
                });
                
                // Función auxiliar para procesar y renderizar una tabla
                const renderTable = (tableId, rawTableData) => {
                    const tbody = document.querySelector(`#${tableId} tbody`);
                    tbody.innerHTML = '';
                    
                    const idPrefix = tableId.replace('tabla-', '').replace(/-/g, '_');
                    const anioActualTh = document.getElementById(`anio_actual_${idPrefix}`);
                    const anioAnteriorTh = document.getElementById(`anio_anterior_${idPrefix}`);

                    if (anioActualTh && anioAnteriorTh) {
                        anioActualTh.innerText = anioActual;
                        anioAnteriorTh.innerText = anioAnterior;
                    }

                    let anioActualData = new Array(12).fill(0);
                    let anioAnteriorData = new Array(12).fill(0);
                    
                    rawTableData[anioActual].forEach(item => anioActualData[parseInt(item.mes_numero) - 1] = parseInt(item.total));
                    rawTableData[anioAnterior].forEach(item => anioAnteriorData[parseInt(item.mes_numero) - 1] = parseInt(item.total));

                    let totalAnioActual = 0;
                    let totalAnioAnterior = 0;
                    
                    const processedData = [];
                    for (let i = 0; i < lastMonth; i++) {
                        const diferencia = anioActualData[i] - anioAnteriorData[i];
                        const variacion = anioAnteriorData[i] > 0 ? ((diferencia / anioAnteriorData[i]) * 100).toFixed(2) : 0;
                        
                        totalAnioActual += anioActualData[i];
                        totalAnioAnterior += anioAnteriorData[i];

                        const diferenciaClass = diferencia < 0 ? 'text-danger' : '';
                        const variacionClass = diferencia < 0 ? 'text-danger' : '';

                        tbody.innerHTML += `
                            <tr>
                                <td>${meses[i]}</td>
                                <td>${anioActualData[i]}</td>
                                <td>${anioAnteriorData[i]}</td>
                                <td class="${diferenciaClass}">${diferencia}</td>
                                <td class="${variacionClass}">${variacion}%</td>
                            </tr>
                        `;
                        processedData.push({
                            mes_nombre: meses[i],
                            total_actual: anioActualData[i],
                            total_anterior: anioAnteriorData[i],
                            diferencia: diferencia,
                            variacion: `${variacion}%`
                        });
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
                    
                    return processedData;
                };

                // Renderizar cada tabla
                processedReportData['bienes'] = renderTable('tabla-bienes', { [anioActual]: dataByTipo['1'][anioActual], [anioAnterior]: dataByTipo['1'][anioAnterior] });
                processedReportData['servicios'] = renderTable('tabla-servicios', { [anioActual]: dataByTipo['2'][anioActual], [anioAnterior]: dataByTipo['2'][anioAnterior] });
                processedReportData['obras'] = renderTable('tabla-obras', { [anioActual]: dataByTipo['3'][anioActual], [anioAnterior]: dataByTipo['3'][anioAnterior] });

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

function exportToExcel() {
    if (Object.keys(processedReportData).length === 0) {
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
        'tabla-bienes', 'tabla-servicios', 'tabla-obras'
    ];
    const sheetNames = [
        'Bienes', 'Servicios', 'Obras'
    ];

    tables.forEach((tableId, index) => {
        const ws = XLSX.utils.table_to_sheet(document.getElementById(tableId));
        XLSX.utils.book_append_sheet(wb, ws, sheetNames[index]);
    });
    
    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_Llamados_${fechaReporte}.xlsx`);
}

function exportToPDF() {
    if (Object.keys(processedReportData).length === 0) {
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
    doc.text('Reporte de Llamados a Concurso', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });

    let currentY = 30;

    const tablesData = [
        { id: 'tabla-bienes', title: 'Bienes' },
        { id: 'tabla-servicios', title: 'Servicios' },
        { id: 'tabla-obras', title: 'Obras' }
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

    doc.save(`Reporte_Llamados_${new Date().toISOString().slice(0, 10)}.pdf`);
}