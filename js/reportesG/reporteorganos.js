// Variable global para almacenar los datos procesados del reporte para la exportación
let processedReportData = [];
let anioActual;
let anioAnterior;

window.onload = function() {
    buscar();
};

function buscar() {
    document.getElementById('loading').style.display = 'block';
    document.getElementById('items').style.display = 'none';

    const baseUrl = window.location.origin + '/asnc/index.php/';

    fetch(baseUrl + 'ReporteOrganos/generarReporte', {
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
            const rawData = data.data.monthly_data;
            const baseCount = data.data.base_count;
            anioActual = data.anio_actual;
            anioAnterior = data.anio_anterior;

            if (rawData.length > 0) {
                document.getElementById('items').style.display = 'block';
                const tbody = document.querySelector('#tabla-organos tbody');
                tbody.innerHTML = '';
                
                document.getElementById('anio_actual').innerText = anioActual;
                document.getElementById('anio_anterior').innerText = anioAnterior;

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

                // Calculamos el total acumulado al final del año anterior
                const acumuladoAnteriorTotal = anioAnteriorData.reduce((acc, val) => acc + val, baseCount);
                
                let acumuladoActual = acumuladoAnteriorTotal; // Aquí empieza la acumulación para el año actual
                let acumuladoAnterior = baseCount; // Esto se mantiene como la base para el año anterior
                
                let totalActualFinal = 0;
                let totalAnteriorFinal = 0;
                
                processedReportData = [];
                for (let i = 0; i < lastMonth; i++) {
                    acumuladoActual += anioActualData[i];
                    acumuladoAnterior += anioAnteriorData[i]; // El acumulado para el año anterior también se recalcula aquí
                    
                    const diferencia = acumuladoActual - acumuladoAnterior;
                    const variacion = acumuladoAnterior > 0 ? ((diferencia / acumuladoAnterior) * 100).toFixed(2) : 0;
                    
                    processedReportData.push({
                        mes_nombre: meses[i],
                        total_actual: acumuladoActual,
                        total_anterior: acumuladoAnterior,
                        diferencia: diferencia,
                        variacion: `${variacion}%`
                    });

                    tbody.innerHTML += `
                        <tr>
                            <td>${meses[i]}</td>
                            <td>${acumuladoActual}</td>
                            <td>${acumuladoAnterior}</td>
                            <td>${diferencia}</td>
                            <td>${variacion}%</td>
                        </tr>
                    `;
                    
                    totalActualFinal = acumuladoActual;
                    totalAnteriorFinal = acumuladoAnterior;
                }

                const totalDiferencia = totalActualFinal - totalAnteriorFinal;
                const totalVariacion = totalAnteriorFinal > 0 ? ((totalDiferencia / totalAnteriorFinal) * 100).toFixed(2) : 0;
                const promedioActual = (totalActualFinal / lastMonth).toFixed(0);
                const promedioAnterior = (totalAnteriorFinal / lastMonth).toFixed(0);
                
                const summaryHtml = `
                    <tr><td colspan="5"></td></tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>${totalActualFinal}</td>
                        <td>${totalAnteriorFinal}</td>
                        <td>${totalDiferencia}</td>
                        <td>${totalVariacion}%</td>
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
                        <td>${totalActualFinal}</td>
                        <td>${totalAnteriorFinal}</td>
                        <td>${totalDiferencia}</td>
                        <td>${totalVariacion}%</td>
                    </tr>
                `;
                tbody.innerHTML += summaryHtml;
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin resultados',
                    text: data.message,
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
// --- COMIENZO DE LAS FUNCIONES DE EXPORTACIÓN ---

/**
 * Exporta los datos del reporte a un archivo Excel.
 */
function exportToExcel() {
    if (processedReportData.length === 0 || document.getElementById('items').style.display === 'none') {
        Swal.fire({
            icon: 'warning',
            title: 'No hay datos',
            text: 'Primero genere el reporte para exportar',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.table_to_sheet(document.getElementById('tabla-organos'));
    XLSX.utils.book_append_sheet(wb, ws, 'Organos-Entes');

    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_Organos_${fechaReporte}.xlsx`);
}

/**
 * Exporta los datos del reporte a un archivo PDF.
 */
function exportToPDF() {
    if (processedReportData.length === 0 || document.getElementById('items').style.display === 'none') {
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
        orientation: 'portrait',
        unit: 'mm',
        format: 'a4'
    });
    const anioActual = new Date().getFullYear();
    const anioAnterior = anioActual - 1;

    doc.setFontSize(16);
    doc.text('Informe Ejecutivo RNCE ' + anioActual, doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });
    doc.setFontSize(12);
    doc.text('Órganos/Entes/Unidades Locales Ejecutoras', doc.internal.pageSize.getWidth() / 2, 22, { align: 'center' });
    
    const headers = [['Mes', anioActual, anioAnterior, 'Diferencia', 'Variación (%)']];

    const body = [];
    const lastMonth = new Date().getMonth() + 1;
    processedReportData.slice(0, lastMonth).forEach(item => {
        body.push([
            item.mes_nombre, 
            item.total_actual, 
            item.total_anterior, 
            item.diferencia, 
            item.variacion
        ]);
    });

    const summaryRows = [
        ['TOTAL', document.querySelector('#tabla-organos tbody tr:last-child').previousElementSibling.previousElementSibling.cells[1].innerText, document.querySelector('#tabla-organos tbody tr:last-child').previousElementSibling.previousElementSibling.cells[2].innerText, document.querySelector('#tabla-organos tbody tr:last-child').previousElementSibling.previousElementSibling.cells[3].innerText, document.querySelector('#tabla-organos tbody tr:last-child').previousElementSibling.previousElementSibling.cells[4].innerText],
        ['PROMEDIO', document.querySelector('#tabla-organos tbody tr:last-child').previousElementSibling.cells[1].innerText, document.querySelector('#tabla-organos tbody tr:last-child').previousElementSibling.cells[2].innerText, '-', '-'],
        ['A la fecha:', document.querySelector('#tabla-organos tbody tr:last-child').cells[1].innerText, document.querySelector('#tabla-organos tbody tr:last-child').cells[2].innerText, document.querySelector('#tabla-organos tbody tr:last-child').cells[3].innerText, document.querySelector('#tabla-organos tbody tr:last-child').cells[4].innerText]
    ];

    doc.autoTable({
        head: headers,
        body: body,
        startY: 30,
        headStyles: { fillColor: [228, 231, 232], textColor: 0, fontStyle: 'bold' },
        styles: { fontSize: 9 }
    });

    const finalY = doc.lastAutoTable.finalY + 10;
    doc.autoTable({
        head: [['Resumen', anioActual, anioAnterior, 'Diferencia', 'Variación (%)']],
        body: summaryRows,
        startY: finalY,
        headStyles: { fillColor: [228, 231, 232], textColor: 0, fontStyle: 'bold' },
        styles: { fontSize: 9 }
    });

    doc.save(`Reporte_Organos_${new Date().toISOString().slice(0, 10)}.pdf`);
}

// --- FIN DE LAS FUNCIONES DE EXPORTACIÓN ---