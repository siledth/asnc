// Variable global para almacenar los datos procesados para la exportación
let processedComisionesData = [];
let processedMiembrosData = [];
let anioActual;
let anioAnterior;

window.onload = function() {
    buscar();
};

function buscar() {
    document.getElementById('loading').style.display = 'block';
    document.getElementById('items').style.display = 'none';

    // const baseUrl = window.location.origin + '/asnc/index.php/';

    fetch(BASE_URL + 'index.php/ReporteComisiones/generarReporte', {
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
            const rawComisionesData = data.data.comisiones_data;
            const rawMiembrosData = data.data.miembros_data;
            anioActual = data.anio_actual;
            anioAnterior = data.anio_anterior;

            if (rawComisionesData.length > 0 || rawMiembrosData.length > 0) {
                document.getElementById('items').style.display = 'block';

                // Función para procesar y renderizar una tabla
                const renderTable = (tableId, rawData) => {
                    const tbody = document.querySelector(`#${tableId} tbody`);
                    tbody.innerHTML = '';
                    
                    const anioActualTh = document.getElementById(`anio_actual_${tableId.replace('tabla-', '')}`);
                    const anioAnteriorTh = document.getElementById(`anio_anterior_${tableId.replace('tabla-', '')}`);
                    anioActualTh.innerText = anioActual;
                    anioAnteriorTh.innerText = anioAnterior;

                    const lastMonth = new Date().getMonth() + 1;
                    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                    let anioActualData = new Array(12).fill(0);
                    let anioAnteriorData = new Array(12).fill(0);
                    
                    rawData.forEach(item => {
                        const mesIndex = parseInt(item.mes_numero) - 1;
                        if (parseInt(item.anio) === parseInt(anioActual)) {
                            anioActualData[mesIndex] = parseInt(item.total);
                        } else if (parseInt(item.anio) === parseInt(anioAnterior)) {
                            anioAnteriorData[mesIndex] = parseInt(item.total);
                        }
                    });

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

                    const summaryHtml = `
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
                    tbody.innerHTML += summaryHtml;
                    
                    return processedData;
                };

                processedComisionesData = renderTable('tabla-comisiones', rawComisionesData);
                processedMiembrosData = renderTable('tabla-miembros', rawMiembrosData);

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

// Funciones de exportación (Excel y PDF)
function exportToExcel() {
    if ((!processedComisionesData || processedComisionesData.length === 0) && (!processedMiembrosData || processedMiembrosData.length === 0)) {
        Swal.fire({
            icon: 'warning',
            title: 'No hay datos',
            text: 'Primero genere el reporte para exportar',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const wb = XLSX.utils.book_new();
    const wsComisiones = XLSX.utils.table_to_sheet(document.getElementById('tabla-comisiones'));
    XLSX.utils.book_append_sheet(wb, wsComisiones, 'Comisiones Notificadas');

    const wsMiembros = XLSX.utils.table_to_sheet(document.getElementById('tabla-miembros'));
    XLSX.utils.book_append_sheet(wb, wsMiembros, 'Miembros Certificados');

    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_Comisiones_Miembros_${fechaReporte}.xlsx`);
}

function exportToPDF() {
    if ((!processedComisionesData || processedComisionesData.length === 0) && (!processedMiembrosData || processedMiembrosData.length === 0)) {
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

    const anioActual = new Date().getFullYear();
    const anioAnterior = anioActual - 1;

    doc.setFontSize(16);
    doc.text('Reporte de Comisiones y Miembros', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });
    doc.setFontSize(12);
    doc.text('Total de Comisiones y Miembros por Mes', doc.internal.pageSize.getWidth() / 2, 22, { align: 'center' });

    // Título de la primera tabla
    doc.setFontSize(12);
    doc.text('Comisiones Notificadas', 10, 30);
    // Tabla de Comisiones
    doc.autoTable({
        html: '#tabla-comisiones',
        startY: 35, // Ajustamos la posición inicial para dar espacio al título
        headStyles: { fillColor: [220, 53, 69], textColor: [255, 255, 255], fontStyle: 'bold' },
        styles: { fontSize: 9 }
    });

    // Título de la segunda tabla
    doc.setFontSize(12);
    doc.text('Miembros Certificados', 10, doc.lastAutoTable.finalY + 10);
    // Tabla de Miembros
    doc.autoTable({
        html: '#tabla-miembros',
        startY: doc.lastAutoTable.finalY + 15, // Ajustamos la posición inicial para dar espacio al título
        headStyles: { fillColor: [220, 53, 69], textColor: [255, 255, 255], fontStyle: 'bold' },
        styles: { fontSize: 9 }
    });

    doc.save(`Reporte_Comisiones_Miembros_${new Date().toISOString().slice(0, 10)}.pdf`);
}