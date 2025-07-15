let movimientosBDVData = [];
let currentMovBDVPage = 1;
const itemsPerMovBDVPage = 5; // Mostrar 5 registros por página

function buscarMovimientosBDV() {
    const cuenta = document.getElementById('cuenta_bdv').value;
    const fechad = document.getElementById('fechad_bdv').value;
    const fechah = document.getElementById('fechah_bdv').value;

    if (!cuenta || !fechad || !fechah) {
        Swal.fire({
            icon: 'warning',
            title: 'Datos requeridos',
            text: 'Por favor complete todos los campos: Cuenta, Fecha Desde y Fecha Hasta.',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const dateFrom = new Date(fechad);
    const dateTo = new Date(fechah);

    // Validar rango de fechas (máximo 30 días)
    const diffTime = Math.abs(dateTo - dateFrom);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays > 30) {
        Swal.fire({
            icon: 'warning',
            title: 'Rango de fechas excedido',
            text: 'El rango de fechas no puede ser mayor a 30 días. Por favor, ajuste las fechas.',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    // Validar que la fecha hasta no sea menor que la fecha desde
    if (dateTo < dateFrom) {
        Swal.fire({
            icon: 'error',
            title: 'Fechas inválidas',
            text: 'La fecha hasta no puede ser menor que la fecha desde.',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    document.getElementById('loadingMovimientosBDV').style.display = 'block';
    document.getElementById('movimientosResultadosBDV').style.display = 'none';

    const baseUrl = '/index.php/'; // Asegúrate de que esta URL sea correcta
//    const baseUrl = window.location.origin + '/asnc/index.php/';

    // Formatear fechas a DD/MM/YYYY para la API
    const fechaIniFormatted = new Date(fechad).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });
    const fechaFinFormatted = new Date(fechah).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });

    const postData = {
        cuenta: cuenta,
        fechaIni: fechaIniFormatted,
        fechaFin: fechaFinFormatted,
        tipoMoneda: "VES",
        nroMovimiento: "" // Dejamos vacío según la especificación
    };

    fetch(baseUrl + 'Diplomado/generarReporteMovimientosBDV', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', // Importante para enviar JSON al controlador
        },
        body: JSON.stringify(postData) // Convertir el objeto a JSON string
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos de BDV:', data);
        document.getElementById('loadingMovimientosBDV').style.display = 'none';

        if (data.success) {
            movimientosBDVData = data.data && data.data.movs ? data.data.movs : [];
            if (movimientosBDVData.length > 0) {
                document.getElementById('movimientosResultadosBDV').style.display = 'block';
                currentMovBDVPage = 1; // Reiniciar a la primera página al buscar
                displayMovimientosBDV(currentMovBDVPage);
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin resultados',
                    text: data.message || 'No se encontraron movimientos para el rango de fechas especificado.',
                    confirmButtonText: 'Entendido'
                });
                document.getElementById('movimientosResultadosBDV').style.display = 'none';
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Error desconocido al consultar movimientos.',
                confirmButtonText: 'Entendido'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loadingMovimientosBDV').style.display = 'none';
        Swal.fire({
            icon: 'error',
            title: 'Error de Conexión',
            text: 'Ocurrió un error al procesar la solicitud: ' + error.message,
            confirmButtonText: 'Entendido'
        });
    });
}

function displayMovimientosBDV(page) {
    const tbody = document.querySelector('#tabla-movimientos-bdv tbody');
    tbody.innerHTML = ''; // Limpiar tabla

    const start = (page - 1) * itemsPerMovBDVPage;
    const end = start + itemsPerMovBDVPage;
    const paginatedItems = movimientosBDVData.slice(start, end);

    if (paginatedItems.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6">No hay movimientos para mostrar en esta página.</td></tr>`;
    } else {
        paginatedItems.forEach(mov => {
            tbody.innerHTML += `
                <tr>
                    <td>${mov.referencia || 'N/A'}</td>
                    <td>${mov.fecha || 'N/A'}</td>
                    <td>${mov.mov || 'N/A'}</td>
                    <td>${mov.importe ? formatCurrencyBDV(mov.importe) : 'Bs 0,00'}</td>
                    <td>${mov.saldo ? formatCurrencyBDV(mov.saldo) : 'Bs 0,00'}</td>
                    <td>${mov.observacion || 'Sin observación'}</td>
                </tr>
            `;
        });
    }
    setupMovimientosBDVPagination(movimientosBDVData.length, page);
}

function setupMovimientosBDVPagination(totalItems, currentPage) {
    const paginationElement = document.getElementById('movimientos-pagination-bdv');
    paginationElement.innerHTML = ''; // Limpiar paginación

    const pageCount = Math.ceil(totalItems / itemsPerMovBDVPage);

    for (let i = 1; i <= pageCount; i++) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        if (i === currentPage) {
            li.classList.add('active');
        }
        const a = document.createElement('a');
        a.classList.add('page-link');
        a.href = '#';
        a.textContent = i;
        a.addEventListener('click', (e) => {
            e.preventDefault();
            currentMovBDVPage = i;
            displayMovimientosBDV(currentMovBDVPage);
        });
        li.appendChild(a);
        paginationElement.appendChild(li);
    }
}

// Función auxiliar para formatear moneda con formato europeo (coma como decimal)
function formatCurrencyBDV(amount) {
    // Eliminar posibles puntos como separadores de miles y reemplazar coma por punto para parseFloat
    let cleanAmount = String(amount).replace(/\./g, '').replace(/,/g, '.');
    const numAmount = parseFloat(cleanAmount);
    if (isNaN(numAmount)) {
        return 'Bs 0,00';
    }
    // Formatear a moneda con coma como separador decimal y punto como separador de miles
    return 'Bs ' + numAmount.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}


// Función para exportar a Excel
function exportToExcelMovimientosBDV() {
    if (movimientosBDVData.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'No hay datos',
            text: 'Primero realice una búsqueda para exportar',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const wb = XLSX.utils.book_new();

    const headers = [
        "Referencia", "Fecha", "Tipo Movimiento", "Importe", "Saldo", "Observación"
    ];
    const dataForExcel = [headers];

    movimientosBDVData.forEach(mov => {
        dataForExcel.push([
            mov.referencia || 'N/A',
            mov.fecha || 'N/A',
            mov.mov || 'N/A',
            mov.importe ? formatCurrencyBDV(mov.importe) : 'Bs 0,00',
            mov.saldo ? formatCurrencyBDV(mov.saldo) : 'Bs 0,00',
            mov.observacion || 'Sin observación'
        ]);
    });

    const ws = XLSX.utils.aoa_to_sheet(dataForExcel);
    XLSX.utils.book_append_sheet(wb, ws, "MovimientosBDV");

    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_Movimientos_BDV_${fechaReporte}.xlsx`);
}

// Función para exportar a PDF
function exportToPDFMovimientosBDV() {
    if (movimientosBDVData.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'No hay datos',
            text: 'Primero realice una búsqueda para exportar',
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

    const fechaReporte = new Date().toLocaleDateString();
    doc.setFontSize(16);
    doc.text('Reporte de Movimientos BDV', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });
    doc.setFontSize(12);
    doc.text(`Generado el: ${fechaReporte}`, doc.internal.pageSize.getWidth() / 2, 22, { align: 'center' });

    const tableColumn = [
        "Referencia", "Fecha", "Mov. Tipo", "Importe", "Saldo", "Observación"
    ];
    const tableRows = [];

    movimientosBDVData.forEach(mov => {
        tableRows.push([
            mov.referencia || 'N/A',
            mov.fecha || 'N/A',
            mov.mov || 'N/A',
            mov.importe ? formatCurrencyBDV(mov.importe) : 'Bs 0,00',
            mov.saldo ? formatCurrencyBDV(mov.saldo) : 'Bs 0,00',
            mov.observacion || 'Sin observación'
        ]);
    });

    doc.autoTable({
        head: [tableColumn],
        body: tableRows,
        startY: 30,
        theme: 'grid',
        headStyles: {
            fillColor: [228, 231, 232],
            textColor: 0,
            fontStyle: 'bold',
            fontSize: 8
        },
        styles: {
            fontSize: 7,
            cellPadding: 1,
            overflow: 'linebreak'
        },
        columnStyles: {
            0: { cellWidth: 30 }, // Referencia
            1: { cellWidth: 20 }, // Fecha
            2: { cellWidth: 20 }, // Mov. Tipo
            3: { cellWidth: 25 }, // Importe
            4: { cellWidth: 25 }, // Saldo
            5: { cellWidth: 'auto' } // Observación (ajuste automático)
        },
        didDrawPage: function (data) {
            let str = 'Página ' + doc.internal.getNumberOfPages();
            doc.setFontSize(10);
            doc.text(str, doc.internal.pageSize.getWidth() / 2, doc.internal.pageSize.getHeight() - 10, { align: 'center' });
        }
    });

    doc.save(`Reporte_Movimientos_BDV_${new Date().toISOString().slice(0, 10)}.pdf`);
}