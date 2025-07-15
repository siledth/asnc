let pagosData = [];
let currentPage = 1;
const itemsPerPage = 5; // Mostrar 5 registros por página

function buscarPagos() {
    const fechad = document.getElementById('fechad').value;
    const fechah = document.getElementById('fechah').value;

    if (!fechad || !fechah) {
        Swal.fire({
            icon: 'warning',
            title: 'Fechas requeridas',
            text: 'Por favor seleccione ambas fechas',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    if (new Date(fechah) < new Date(fechad)) {
        Swal.fire({
            icon: 'error',
            title: 'Fechas inválidas',
            text: 'La fecha hasta no puede ser menor que la fecha desde',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    document.getElementById('loadingPagos').style.display = 'block';
    document.getElementById('pagosResultados').style.display = 'none';
    // // const baseUrl = '/index.php/'; // Ajusta esta URL si tu base_url es diferente
//    const baseUrl = window.location.origin + '/asnc/index.php/';

    fetch(baseUrl + 'Diplomado/generarReportePagos', {
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
        document.getElementById('loadingPagos').style.display = 'none';

        if (data.success) {
            pagosData = data.data || [];
            if (pagosData.length > 0) {
                document.getElementById('pagosResultados').style.display = 'block';
                currentPage = 1; // Reiniciar a la primera página al buscar
                displayPagos(currentPage);
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin resultados',
                    text: data.message || 'No se encontraron pagos para el rango de fechas especificado.',
                    confirmButtonText: 'Entendido'
                });
                document.getElementById('pagosResultados').style.display = 'none';
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
        document.getElementById('loadingPagos').style.display = 'none';
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al procesar la solicitud: ' + error.message,
            confirmButtonText: 'Entendido'
        });
    });
}

function displayPagos(page) {
    const tbody = document.querySelector('#tabla-pagos tbody');
    tbody.innerHTML = ''; // Limpiar tabla

    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = pagosData.slice(start, end);

    if (paginatedItems.length === 0) {
        tbody.innerHTML = `<tr><td colspan="10">No hay pagos para mostrar en esta página.</td></tr>`;
        // Colspan ajustado a 10 porque ahora hay 10 columnas visibles.
    } else {
        paginatedItems.forEach(pago => {
            tbody.innerHTML += `
                <tr>
                    <td>${pago.id_pago}</td>
                    
                    <td>${pago.codigo_planilla || 'N/A'}</td> <td>${pago.name_d || 'N/A'}</td>
                    <td>${formatCurrency(pago.monto)}</td>
                    <td>${pago.fecha_pago}</td>
                    <td>${pago.referencia}</td>
                    <td>${pago.nombre_banco || 'N/A'}</td> <td>${pago.forma_pago_nombre || 'N/A'}</td>  
                    <td>${pago.observaciones}</td>
                </tr>
            `;
        });
    }
    setupPagination(pagosData.length, page);
}

function setupPagination(totalItems, currentPage) {
    const paginationElement = document.getElementById('pagos-pagination');
    paginationElement.innerHTML = ''; // Limpiar paginación

    const pageCount = Math.ceil(totalItems / itemsPerPage);

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
            currentPage = i;
            displayPagos(currentPage);
        });
        li.appendChild(a);
        paginationElement.appendChild(li);
    }
}

// Función auxiliar para formatear moneda
function formatCurrency(amount) {
    // Asegurarse de que el monto sea un número y manejar valores no válidos
    const numAmount = parseFloat(amount);
    if (isNaN(numAmount)) {
        return 'Bs 0.00';
    }
    return 'Bs ' + numAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

// Función para exportar a Excel
function exportToExcelPagos() {
    if (pagosData.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'No hay datos',
            text: 'Primero realice una búsqueda para exportar',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    const wb = XLSX.utils.book_new();

    // Crear un array de arrays para la hoja de Excel, incluyendo encabezados
    const headers = [
        "ID Pago",   "Cód. Planilla", "Diplomado", "Monto", "Fecha Pago",
        "Referencia", "Banco", "Forma Pago",   "Observaciones"
    ];
    const dataForExcel = [headers];

    pagosData.forEach(pago => {
        dataForExcel.push([
            pago.id_pago,
            
            pago.codigo_planilla || 'N/A', // Nueva columna
            pago.name_d || 'N/A',
            formatCurrency(pago.monto),
            pago.fecha_pago,
            pago.referencia,
            pago.nombre_banco || 'N/A', // Usa el alias del modelo
            pago.forma_pago_nombre || 'N/A', // Usa el alias del modelo
           
            pago.observaciones
        ]);
    });

    const ws = XLSX.utils.aoa_to_sheet(dataForExcel);
    XLSX.utils.book_append_sheet(wb, ws, "PagosDiplomados");

    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_Pagos_Diplomados_${fechaReporte}.xlsx`);
}

// Función para exportar a PDF
function exportToPDFPagos() {
    if (pagosData.length === 0) {
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
    doc.text('Reporte de Pagos de Diplomados', doc.internal.pageSize.getWidth() / 2, 15, { align: 'center' });
    doc.setFontSize(12);
    doc.text(`Generado el: ${fechaReporte}`, doc.internal.pageSize.getWidth() / 2, 22, { align: 'center' });

    const tableColumn = [
        "ID Pago",  "Cód. Planilla", "Diplomado", "Monto", "Fecha Pago",
        "Referencia", "Banco", "Forma Pago",   "Observaciones"
    ];
    const tableRows = [];

    pagosData.forEach(pago => {
        tableRows.push([
            pago.id_pago,
            
            pago.codigo_planilla || 'N/A', // Nueva columna
            pago.name_d || 'N/A',
            formatCurrency(pago.monto),
            pago.fecha_pago,
            pago.referencia,
            pago.nombre_banco || 'N/A', // Usa el alias del modelo
            pago.forma_pago_nombre || 'N/A', // Usa el alias del modelo
       
            pago.observaciones
        ]);
    });

    doc.autoTable({
        head: [tableColumn],
        body: tableRows,
        startY: 30,
        theme: 'grid', // 'striped', 'grid', 'plain'
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
            0: { cellWidth: 15 }, // ID Pago
            
            1: { cellWidth: 25 }, // Cód. Planilla (nueva)
            2: { cellWidth: 35 }, // Diplomado
            3: { cellWidth: 20 }, // Monto
            4: { cellWidth: 20 }, // Fecha Pago
            5: { cellWidth: 25 }, // Referencia
            6: { cellWidth: 25 }, // Banco (nueva)
            7: { cellWidth: 25 }, // Forma Pago (nueva)
            8: { cellWidth: 'auto' } // Observaciones (ajuste automático)
        },
        didDrawPage: function (data) {
            // Footer
            let str = 'Página ' + doc.internal.getNumberOfPages();
            doc.setFontSize(10);
            doc.text(str, doc.internal.pageSize.getWidth() / 2, doc.internal.pageSize.getHeight() - 10, { align: 'center' });
        }
    });

    doc.save(`Reporte_Pagos_Diplomados_${new Date().toISOString().slice(0, 10)}.pdf`);
}