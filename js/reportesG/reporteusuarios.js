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

    // const baseUrl = window.location.origin + '/asnc/index.php/';
            // url: BASE_URL + 'index.php/Diplomado/save_estatus_aprobacion',

    fetch(BASE_URL + 'index.php/ReporteUsuarios/generarReporte', {
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
                const tbody = document.querySelector('#tabla-usuarios tbody');
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

                let totalAnioActual = 0;
                let totalAnioAnterior = 0;
                
                processedReportData = [];
                for (let i = 0; i < lastMonth; i++) {
                    const diferencia = anioActualData[i] - anioAnteriorData[i];
                    const variacion = anioAnteriorData[i] > 0 ? ((diferencia / anioAnteriorData[i]) * 100).toFixed(2) : 0;
                    
                    totalAnioActual += anioActualData[i];
                    totalAnioAnterior += anioAnteriorData[i];

                    processedReportData.push({
                        mes_nombre: meses[i],
                        total_actual: anioActualData[i],
                        total_anterior: anioAnteriorData[i],
                        diferencia: diferencia,
                        variacion: `${variacion}%`
                    });

                    // Agregamos una clase CSS si el valor es negativo
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
                }
                
                const totalDiferencia = totalAnioActual - totalAnioAnterior;
                const totalVariacion = totalAnioAnterior > 0 ? ((totalDiferencia / totalAnioAnterior) * 100).toFixed(2) : 0;
                const promedioActual = (totalAnioActual / lastMonth).toFixed(0);
                const promedioAnterior = (totalAnioAnterior / lastMonth).toFixed(0);
                
                const summaryHtml = `
                    <tr><td colspan="5"></td></tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>${totalAnioActual}</td>
                        <td>${totalAnioAnterior}</td>
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
                        <td>${totalAnioActual}</td>
                        <td>${totalAnioAnterior}</td>
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

// Funciones de exportación (Excel y PDF)

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
    const ws = XLSX.utils.table_to_sheet(document.getElementById('tabla-usuarios'));

    // --- APLICAR ESTILOS A LA CABECERA EN EXCEL ---
    const headerCells = ['A1', 'B1', 'C1', 'D1', 'E1']; // Las celdas del encabezado
    headerCells.forEach(cellRef => {
        if (ws[cellRef]) { // Asegurarse de que la celda existe
            if (!ws[cellRef].s) ws[cellRef].s = {}; // Inicializar el objeto de estilo
            // Aplicar el estilo de relleno rojo (FFDC3545) y texto blanco (FFFFFFFF)
            ws[cellRef].s.fill = { fgColor: { rgb: "FFDC3545" } };
            ws[cellRef].s.font = { color: { rgb: "FFFFFFFF" }, bold: true };
        }
    });
    // --- FIN DE APLICAR ESTILOS ---

    XLSX.utils.book_append_sheet(wb, ws, 'Usuarios Creados');

    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_Usuarios_Creados_${fechaReporte}.xlsx`);
}

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
    doc.text('Reporte de Usuarios Creados', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });
    doc.setFontSize(12);
    doc.text('Total de Usuarios Creados por Mes', doc.internal.pageSize.getWidth() / 2, 22, { align: 'center' });
    
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
    
    doc.autoTable({
        head: headers,
        body: body,
        startY: 30,
        // Usamos un color rojo (RGB: 220, 53, 69) y texto blanco (RGB: 255, 255, 255)
        headStyles: { fillColor: [220, 53, 69], textColor: [255, 255, 255], fontStyle: 'bold' },
        styles: { fontSize: 9 }
    });

    const finalY = doc.lastAutoTable.finalY + 10;
    const totalAnioActual = processedReportData.slice(0, lastMonth).reduce((acc, item) => acc + item.total_actual, 0);
    const totalAnioAnterior = processedReportData.slice(0, lastMonth).reduce((acc, item) => acc + item.total_anterior, 0);
    const totalDiferencia = totalAnioActual - totalAnioAnterior;
    const totalVariacion = totalAnioAnterior > 0 ? ((totalDiferencia / totalAnioAnterior) * 100).toFixed(2) : 0;
    const promedioActual = (totalAnioActual / lastMonth).toFixed(0);
    const promedioAnterior = (totalAnioAnterior / lastMonth).toFixed(0);

    const summaryRows = [
        ['TOTAL', totalAnioActual, totalAnioAnterior, totalDiferencia, totalVariacion + '%'],
        ['PROMEDIO', promedioActual, promedioAnterior, '-', '-'],
        ['A la fecha:', totalAnioActual, totalAnioAnterior, totalDiferencia, totalVariacion + '%']
    ];
    
    doc.autoTable({
        head: [['Resumen', anioActual, anioAnterior, 'Diferencia', 'Variación (%)']],
        body: summaryRows,
        startY: finalY,
        // Usamos un color rojo (RGB: 220, 53, 69) y texto blanco (RGB: 255, 255, 255)
        headStyles: { fillColor: [220, 53, 69], textColor: [255, 255, 255], fontStyle: 'bold' },
        styles: { fontSize: 9 }
    });

    doc.save(`Reporte_Usuarios_Creados_${new Date().toISOString().slice(0, 10)}.pdf`);
}