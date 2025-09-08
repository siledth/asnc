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

    fetch(BASE_URL + 'index.php/ReporteGeneral/generarReporte', {
        method: 'POST'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log("Datos completos del reporte general:", data);

        document.getElementById('loading').style.display = 'none';

        if (data.success) {
            const rawData = data.data;
            anioActual = data.anio_actual;
            anioAnterior = data.anio_anterior;

            if (Object.keys(rawData).length > 0) {
                document.getElementById('items').style.display = 'block';
                // Llama a la función que renderiza todos los reportes
                renderAllReports(rawData);
            } else {
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

function renderAllReports(rawData) {
    // Meses para las tablas
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const lastMonth = new Date().getMonth() + 1;

    // --- Renderizar Reporte de Órganos/Entes ---
    const organosData = {
        [anioActual]: rawData.organos.monthly_data.filter(item => parseInt(item.anio) === parseInt(anioActual)),
        [anioAnterior]: rawData.organos.monthly_data.filter(item => parseInt(item.anio) === parseInt(anioAnterior))
    };
    renderTable('tabla-organos', organosData, meses, lastMonth, 'total', 'organos');
    
    // --- Renderizar Reporte de Usuarios ---
    const usuariosData = {
        [anioActual]: rawData.usuarios.monthly_data.filter(item => parseInt(item.anio) === parseInt(anioActual)),
        [anioAnterior]: rawData.usuarios.monthly_data.filter(item => parseInt(item.anio) === parseInt(anioAnterior))
    };
    renderTable('tabla-usuarios', usuariosData, meses, lastMonth, 'total', 'usuarios');

    // --- Renderizar Reporte de Comisiones y Miembros ---
    const comisionesData = {
        [anioActual]: rawData.comisiones.comisiones_data.filter(item => parseInt(item.anio) === parseInt(anioActual)),
        [anioAnterior]: rawData.comisiones.comisiones_data.filter(item => parseInt(item.anio) === parseInt(anioAnterior))
    };
    renderTable('tabla-comisiones', comisionesData, meses, lastMonth, 'total', 'comisiones');
    
    const miembrosData = {
        [anioActual]: rawData.comisiones.miembros_data.filter(item => parseInt(item.anio) === parseInt(anioActual)),
        [anioAnterior]: rawData.comisiones.miembros_data.filter(item => parseInt(item.anio) === parseInt(anioAnterior))
    };
    renderTable('tabla-miembros', miembrosData, meses, lastMonth, 'total', 'miembros');
    
    // --- Renderizar Reporte de PAC y Rendiciones ---
    const pacRegistradosData = {
        [anioActual]: rawData.pac.registrados[anioActual],
        [anioAnterior]: rawData.pac.registrados[anioAnterior]
    };
    renderTable('tabla-pac-registrados', pacRegistradosData, meses, lastMonth, 'total', 'pac_registrados');

    const pacNotificadosData = {
        [anioActual]: rawData.pac.notificados[anioActual],
        [anioAnterior]: rawData.pac.notificados[anioAnterior]
    };
    renderTable('tabla-pac-notificados', pacNotificadosData, meses, lastMonth, 'total_notificadas', 'pac_notificados');

    const pacRegistradosMapActual = new Map(pacRegistradosData[anioActual].map(item => [parseInt(item.mes_numero), parseInt(item.total)]));
    const pacRegistradosMapAnterior = new Map(pacRegistradosData[anioAnterior].map(item => [parseInt(item.mes_numero), parseInt(item.total)]));
    const pacNotificadosMapActual = new Map(pacNotificadosData[anioActual].map(item => [parseInt(item.mes_numero), parseInt(item.total_notificadas)]));
    const pacNotificadosMapAnterior = new Map(pacNotificadosData[anioAnterior].map(item => [parseInt(item.mes_numero), parseInt(item.total_notificadas)]));

    const pacEdicionData = {
        [anioActual]: new Map(),
        [anioAnterior]: new Map()
    };
    for(let i = 1; i <= lastMonth; i++) {
        const totalRegistradosActual = pacRegistradosMapActual.get(i) || 0;
        const totalRegistradosAnterior = pacRegistradosMapAnterior.get(i) || 0;
        const totalNotificadosActual = pacNotificadosMapActual.get(i) || 0;
        const totalNotificadosAnterior = pacNotificadosMapAnterior.get(i) || 0;
        pacEdicionData[anioActual].set(i, totalRegistradosActual - totalNotificadosActual);
        pacEdicionData[anioAnterior].set(i, totalRegistradosAnterior - totalNotificadosAnterior);
    }
    renderTableFromMaps('tabla-pac-edicion', pacEdicionData, meses, lastMonth, 'pac_edicion');
    
    const rendicionesRegistradasData = {
        [anioActual]: rawData.pac.rendidas[anioActual],
        [anioAnterior]: rawData.pac.rendidas[anioAnterior]
    };
    renderTable('tabla-rendiciones-registradas', rendicionesRegistradasData, meses, lastMonth, 'total_rendida', 'rendiciones_registradas');

    const rendicionesRegistradasMapActual = new Map(rendicionesRegistradasData[anioActual].map(item => [parseInt(item.mes_numero), parseInt(item.total_rendida)]));
    const rendicionesRegistradasMapAnterior = new Map(rendicionesRegistradasData[anioAnterior].map(item => [parseInt(item.mes_numero), parseInt(item.total_rendida)]));
    
    const rendicionesEdicionData = {
        [anioActual]: new Map(),
        [anioAnterior]: new Map()
    };
    for (let i = 1; i <= lastMonth; i++) {
        const totalRegistradosActual = pacRegistradosMapActual.get(i) || 0;
        const totalRegistradosAnterior = pacRegistradosMapAnterior.get(i) || 0;
        const totalRendidasActual = rendicionesRegistradasMapActual.get(i) || 0;
        const totalRendidasAnterior = rendicionesRegistradasMapAnterior.get(i) || 0;
        rendicionesEdicionData[anioActual].set(i, totalRegistradosActual - totalRendidasActual);
        rendicionesEdicionData[anioAnterior].set(i, totalRegistradosAnterior - totalRendidasAnterior);
    }
    renderTableFromMaps('tabla-rendiciones-edicion', rendicionesEdicionData, meses, lastMonth, 'rendiciones_edicion');
    
    const rendicionesNotificadasData = {
        [anioActual]: new Map(),
        [anioAnterior]: new Map()
    };
    for(let i = 1; i <= lastMonth; i++) {
        const totalNotificadosActual = pacNotificadosMapActual.get(i) || 0;
        const totalNotificadosAnterior = pacNotificadosMapAnterior.get(i) || 0;
        const totalRendidasActual = rendicionesRegistradasMapActual.get(i) || 0;
        const totalRendidasAnterior = rendicionesRegistradasMapAnterior.get(i) || 0;
        rendicionesNotificadasData[anioActual].set(i, totalNotificadosActual - totalRendidasActual);
        rendicionesNotificadasData[anioAnterior].set(i, totalNotificadosAnterior - totalRendidasAnterior);
    }
    renderTableFromMaps('tabla-rendiciones-notificadas', rendicionesNotificadasData, meses, lastMonth, 'rendiciones_notificadas');

    // --- Renderizar Reporte de Llamados a Concurso ---
    const llamadosData = {
        [anioActual]: rawData.llamados[anioActual],
        [anioAnterior]: rawData.llamados[anioAnterior]
    };
    
    const llamadosByTipo = {
        'bienes': { [anioActual]: [], [anioAnterior]: [] },
        'servicios': { [anioActual]: [], [anioAnterior]: [] },
        'obras': { [anioActual]: [], [anioAnterior]: [] }
    };
    
    llamadosData[anioActual].forEach(item => {
        if (item.id_objeto_contratacion == 1) llamadosByTipo['bienes'][anioActual].push(item);
        if (item.id_objeto_contratacion == 2) llamadosByTipo['servicios'][anioActual].push(item);
        if (item.id_objeto_contratacion == 3) llamadosByTipo['obras'][anioActual].push(item);
    });
    
    llamadosData[anioAnterior].forEach(item => {
        if (item.id_objeto_contratacion == 1) llamadosByTipo['bienes'][anioAnterior].push(item);
        if (item.id_objeto_contratacion == 2) llamadosByTipo['servicios'][anioAnterior].push(item);
        if (item.id_objeto_contratacion == 3) llamadosByTipo['obras'][anioAnterior].push(item);
    });

    renderTable('tabla-llamados-bienes', {
        [anioActual]: llamadosByTipo.bienes[anioActual],
        [anioAnterior]: llamadosByTipo.bienes[anioAnterior]
    }, meses, lastMonth, 'total', 'llamados_bienes');
    
    renderTable('tabla-llamados-servicios', {
        [anioActual]: llamadosByTipo.servicios[anioActual],
        [anioAnterior]: llamadosByTipo.servicios[anioAnterior]
    }, meses, lastMonth, 'total', 'llamados_servicios');
    
    renderTable('tabla-llamados-obras', {
        [anioActual]: llamadosByTipo.obras[anioActual],
        [anioAnterior]: llamadosByTipo.obras[anioAnterior]
    }, meses, lastMonth, 'total', 'llamados_obras');

    // --- Renderizar Reporte de Evaluaciones de Desempeño ---
    const evaluacionesData = rawData.evaluaciones;
    const calificacionesAnioActual = evaluacionesData.calificaciones[anioActual] || [];
    const calificacionesAnioAnterior = evaluacionesData.calificaciones[anioAnterior] || [];
    const anuladasData = evaluacionesData.anuladas;

    const evaluacionesByCalificacion = {
        'EXCELENTE': { [anioActual]: [], [anioAnterior]: [] },
        'BUENO': { [anioActual]: [], [anioAnterior]: [] },
        'REGULAR': { [anioActual]: [], [anioAnterior]: [] },
        'DEFICIENTE': { [anioActual]: [], [anioAnterior]: [] }
    };

    [anioActual, anioAnterior].forEach(anio => {
        evaluacionesData.calificaciones[anio].forEach(item => {
            const calificacion = item.calificacion.toUpperCase();
            if (evaluacionesByCalificacion[calificacion]) {
                evaluacionesByCalificacion[calificacion][anio].push(item);
            }
        });
    });

    renderTable('tabla-excelente', {
        [anioActual]: evaluacionesByCalificacion.EXCELENTE[anioActual],
        [anioAnterior]: evaluacionesByCalificacion.EXCELENTE[anioAnterior]
    }, meses, lastMonth, 'total', 'excelente');

    renderTable('tabla-bueno', {
        [anioActual]: evaluacionesByCalificacion.BUENO[anioActual],
        [anioAnterior]: evaluacionesByCalificacion.BUENO[anioAnterior]
    }, meses, lastMonth, 'total', 'bueno');

    renderTable('tabla-regular', {
        [anioActual]: evaluacionesByCalificacion.REGULAR[anioActual],
        [anioAnterior]: evaluacionesByCalificacion.REGULAR[anioAnterior]
    }, meses, lastMonth, 'total', 'regular');

    renderTable('tabla-deficiente', {
        [anioActual]: evaluacionesByCalificacion.DEFICIENTE[anioActual],
        [anioAnterior]: evaluacionesByCalificacion.DEFICIENTE[anioAnterior]
    }, meses, lastMonth, 'total', 'deficiente');

    renderTable('tabla-anuladas', {
        [anioActual]: anuladasData[anioActual],
        [anioAnterior]: anuladasData[anioAnterior]
    }, meses, lastMonth, 'total', 'anuladas');

    // --- Renderizar Reporte de Top 10 ---
    // Se corrigen los reportKeys para que coincidan con la vista HTML
    renderTopTable('tabla-top-solicitados', rawData.top10.solicitados, 'cantidad_solicitada', 'monto_total', 'top_solicitados');
    renderTopTable('tabla-top-rendidos', rawData.top10.rendidos, 'cantidad_ejecutada', 'monto_total', 'top_rendidos');
    renderOrganosTable('tabla-top-organos', rawData.top10.organos, 'top_organos');
}


function renderTable(tableId, rawData, meses, lastMonth, totalKey, reportKey) {
    const tbody = document.querySelector(`#${tableId} tbody`);
    if (!tbody) {
        console.error(`Error: tbody no encontrado para la tabla con ID: ${tableId}`);
        return;
    }
    tbody.innerHTML = '';
    
    // Construir los datos para el año actual y anterior
    const anioActualData = new Array(12).fill(0);
    const anioAnteriorData = new Array(12).fill(0);

    rawData[anioActual].forEach(item => {
        const mesIndex = parseInt(item.mes_numero) - 1;
        anioActualData[mesIndex] = parseInt(item[totalKey]);
    });

    rawData[anioAnterior].forEach(item => {
        const mesIndex = parseInt(item.mes_numero) - 1;
        anioAnteriorData[mesIndex] = parseInt(item[totalKey]);
    });

    // Actualizar encabezados
    const idPrefix = reportKey.replace(/_/g, '-');
    const anioActualTh = document.getElementById(`anio_actual_${idPrefix}`);
    const anioAnteriorTh = document.getElementById(`anio_anterior_${idPrefix}`);
    
    if (anioActualTh && anioAnteriorTh) {
        anioActualTh.innerText = anioActual;
        anioAnteriorTh.innerText = anioAnterior;
    } else {
        // En lugar de arrojar un error, lo registramos y continuamos.
        console.warn(`Advertencia: Elementos de cabecera no encontrados para el prefijo de ID: anio_${idPrefix}`);
    }

    let totalAnioActual = 0;
    let totalAnioAnterior = 0;
    
    // Almacenar datos para exportación
    processedReportData[reportKey] = [];
    for (let i = 0; i < lastMonth; i++) {
        const diferencia = anioActualData[i] - anioAnteriorData[i];
        const variacion = anioAnteriorData[i] > 0 ? ((diferencia / anioAnteriorData[i]) * 100).toFixed(2) : 0;
        
        totalAnioActual += anioActualData[i];
        totalAnioAnterior += anioAnteriorData[i];

        processedReportData[reportKey].push({
            mes_nombre: meses[i],
            total_actual: anioActualData[i],
            total_anterior: anioAnteriorData[i],
            diferencia: diferencia,
            variacion: `${variacion}%`
        });
        
        const diferenciaClass = diferencia < 0 ? 'text-danger' : '';
        const variacionClass = variacion < 0 ? 'text-danger' : '';

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
}

function renderTableFromMaps(tableId, data, meses, lastMonth, reportKey) {
    const tbody = document.querySelector(`#${tableId} tbody`);
    if (!tbody) {
        console.error(`Error: tbody no encontrado para la tabla con ID: ${tableId}`);
        return;
    }
    tbody.innerHTML = '';
    
    // Corrección: El ID en la vista HTML utiliza guiones.
    const idPrefix = reportKey.replace(/_/g, '-');
    const anioActualTh = document.getElementById(`anio_actual_${idPrefix}`);
    const anioAnteriorTh = document.getElementById(`anio_anterior_${idPrefix}`);

    if (anioActualTh && anioAnteriorTh) {
        anioActualTh.innerText = anioActual;
        anioAnteriorTh.innerText = anioAnterior;
    } else {
        console.error(`Error: Elementos de cabecera no encontrados para el prefijo de ID: anio_actual_${idPrefix}`);
    }

    let totalAnioActual = 0;
    let totalAnioAnterior = 0;
    
    processedReportData[reportKey] = [];
    for (let i = 0; i < lastMonth; i++) {
        const mesNumero = i + 1;
        const anioActualValue = data[anioActual].get(mesNumero) || 0;
        const anioAnteriorValue = data[anioAnterior].get(mesNumero) || 0;
        
        const diferencia = anioActualValue - anioAnteriorValue;
        const variacion = anioAnteriorValue > 0 ? ((diferencia / anioAnteriorValue) * 100).toFixed(2) : 0;
        
        totalAnioActual += anioActualValue;
        totalAnioAnterior += anioAnteriorValue;

        processedReportData[reportKey].push({
            mes_nombre: meses[i],
            total_actual: anioActualValue,
            total_anterior: anioAnteriorValue,
            diferencia: diferencia,
            variacion: `${variacion}%`
        });
        
        const diferenciaClass = diferencia < 0 ? 'text-danger' : '';
        const variacionClass = variacion < 0 ? 'text-danger' : '';

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
}

// --- Funciones para renderizar las tablas de Top 10 ---
// Se ha modificado para manejar números grandes con BigInt y formato manual
function renderTopTable(tableId, data, cantidadKey, montoKey, reportKey) {
    const tbody = document.querySelector(`#${tableId} tbody`);
    if (!tbody) {
        console.error(`Error: tbody no encontrado para la tabla con ID: ${tableId}`);
        return;
    }
    tbody.innerHTML = '';
    
    // Corrección: El ID en la vista HTML utiliza guiones bajos.
    const anioElement = document.getElementById(`anio-${reportKey}`);
    if (anioElement) {
        anioElement.innerText = anioActual;
    } else {
        console.error(`Error: Elemento de año no encontrado para el prefijo de ID: anio-${reportKey}`);
    }

    // Sumar las cantidades y los montos usando BigInt para evitar la pérdida de precisión.
    let totalCantidadAcumulada = data.reduce((acc, item) => {
        const cantidadStr = item[cantidadKey].split('.')[0];
        return acc + BigInt(cantidadStr);
    }, 0n);

    let totalMontoAcumulado = data.reduce((acc, item) => {
        const [intPart, decPart] = item[montoKey].split('.');
        const decValue = decPart ? decPart.padEnd(2, '0').slice(0, 2) : '00';
        return acc + BigInt(intPart + decValue);
    }, 0n);
    
    let html = '';
    let posicion = 1;

    processedReportData[reportKey] = [];

    data.forEach(item => {
        const cantidadItemStr = item[cantidadKey].split('.')[0];
        const cantidadItem = BigInt(cantidadItemStr);
        const porcentaje = totalCantidadAcumulada > 0n ? (Number(cantidadItem * 10000n / totalCantidadAcumulada) / 100).toFixed(2) : 0;
        
        // Se formatea el monto manualmente para mantener la precisión
        const [montoInt, montoDec] = item[montoKey].split('.');
        const formattedMonto = parseInt(montoInt).toLocaleString('es-VE') + ',' + (montoDec ? montoDec.padEnd(2, '0').slice(0, 2) : '00');

        html += `
            <tr>
                <td>${posicion}</td>
                <td>${item.cod_ccnu || item.codigo_ccnu}</td>
                <td>${item.desc_ccnu}</td>
                <td>${cantidadItem.toLocaleString('es-VE')}</td>
                <td>Bs${formattedMonto}</td>
                <td>${porcentaje}%</td>
            </tr>
        `;
        processedReportData[reportKey].push({
            posicion: posicion,
            codigo_ccnu: item.cod_ccnu || item.codigo_ccnu,
            descripcion: item.desc_ccnu,
            cantidad: parseInt(item[cantidadKey]),
            monto: parseFloat(item[montoKey]),
            porcentaje: porcentaje + '%'
        });
        posicion++;
    });
    
    // Formatear el total de monto para la visualización
    const totalMontoStr = totalMontoAcumulado.toString();
    let formattedTotalMonto = totalMontoStr;
    if (totalMontoStr.length > 2) {
        formattedTotalMonto = totalMontoStr.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',' + totalMontoStr.slice(-2);
    } else {
        formattedTotalMonto = `0,${totalMontoStr.padStart(2, '0')}`;
    }
    
    html += `
        <tr>
            <td colspan="3" class="text-end">**TOTAL**</td>
            <td>**${totalCantidadAcumulada.toLocaleString('es-VE')}**</td>
            <td>Bs**${formattedTotalMonto}**</td>
            <td>**100%**</td>
        </tr>
    `;
    tbody.innerHTML = html;
}


function renderOrganosTable(tableId, data, reportKey) {
    const tbody = document.querySelector(`#${tableId} tbody`);
    if (!tbody) {
        console.error(`Error: tbody no encontrado para la tabla con ID: ${tableId}`);
        return;
    }
    tbody.innerHTML = '';
    
    // Corrección: El ID en la vista HTML utiliza guiones bajos.
    const anioElement = document.getElementById(`anio-${reportKey}`);
    if (anioElement) {
        anioElement.innerText = anioActual;
    } else {
        console.error(`Error: Elemento de año no encontrado para el prefijo de ID: anio-${reportKey}`);
    }

    const totalLlamados = data.reduce((acc, item) => acc + parseInt(item.cantidad_llamados), 0);

    let html = '';
    let posicion = 1;

    processedReportData[reportKey] = [];

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
        processedReportData[reportKey].push({
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

// --- COMIENZO DE LAS FUNCIONES DE EXPORTACIÓN ---
function exportToExcel() {
    if (Object.keys(processedReportData).length === 0) {
        Swal.fire('No hay datos', 'Primero genere el reporte para exportar', 'warning');
        return;
    }
    const wb = XLSX.utils.book_new();
    const sheetNames = {
        'organos': 'Organos-Entes',
        'usuarios': 'Usuarios Creados',
        'comisiones': 'Comisiones Notificadas',
        'miembros': 'Miembros Certificados',
        'pac_registrados': 'PAC Registrados',
        'pac_edicion': 'PAC en Edición',
        'pac_notificados': 'PAC Notificados',
        'rendiciones_registradas': 'Rend. Registradas',
        'rendiciones_edicion': 'Rend. en Edición',
        'rendiciones_notificadas': 'Rend. Notificadas',
        'llamados_bienes': 'Llamados Bienes',
        'llamados_servicios': 'Llamados Servicios',
        'llamados_obras': 'Llamados Obras',
        'excelente': 'Evaluaciones Excelente',
        'bueno': 'Evaluaciones Bueno',
        'regular': 'Evaluaciones Regular',
        'deficiente': 'Evaluaciones Deficiente',
        'anuladas': 'Evaluaciones Anuladas',
        'top_solicitados': 'Top 10 Solicitados',
        'top_rendidos': 'Top 10 Rendidos',
        'top_organos': 'Top 10 Organos'
    };

    for (const reportKey in processedReportData) {
        if (processedReportData.hasOwnProperty(reportKey)) {
            // Se genera un ID de tabla que coincide con la vista para la exportación
            const tableId = `tabla-${reportKey.replace(/_/g, '-')}`;
            const ws = XLSX.utils.table_to_sheet(document.getElementById(tableId));
            XLSX.utils.book_append_sheet(wb, ws, sheetNames[reportKey]);
        }
    }
    
    const fechaReporte = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, `Reporte_General_${fechaReporte}.xlsx`);
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

    const tablesData = [
        { id: 'tabla-organos', title: 'Reporte de Órganos/Entes/Unidades Locales Ejecutoras' },
        { id: 'tabla-usuarios', title: 'Reporte de Usuarios Creados' },
        { id: 'tabla-comisiones', title: 'Reporte de Comisiones Notificadas' },
        { id: 'tabla-miembros', title: 'Reporte de Miembros Certificados' },
        { id: 'tabla-pac-registrados', title: 'PAC Registrados' },
        { id: 'tabla-pac-edicion', title: 'PAC en Edición' },
        { id: 'tabla-pac-notificados', title: 'PAC Notificados' },
        { id: 'tabla-rendiciones-registradas', title: 'Rendiciones Registradas' },
        { id: 'tabla-rendiciones-edicion', title: 'Rendiciones en Edición' },
        { id: 'tabla-rendiciones-notificadas', title: 'Rendiciones Notificadas' },
        { id: 'tabla-llamados-bienes', title: 'Llamados - Bienes' },
        { id: 'tabla-llamados-servicios', title: 'Llamados - Servicios' },
        { id: 'tabla-llamados-obras', title: 'Llamados - Obras' },
        { id: 'tabla-excelente', title: 'Evaluaciones - Excelente' },
        { id: 'tabla-bueno', title: 'Evaluaciones - Bueno' },
        { id: 'tabla-regular', title: 'Evaluaciones - Regular' },
        { id: 'tabla-deficiente', title: 'Evaluaciones - Deficiente' },
        { id: 'tabla-anuladas', title: 'Evaluaciones - Anuladas' },
        { id: 'tabla-top-solicitados', title: 'Top 10 Productos Solicitados' },
        { id: 'tabla-top-rendidos', title: 'Top 10 Productos Rendidos' },
        { id: 'tabla-top-organos', title: 'Top 10 Órganos/Entes con más Llamados' }
    ];

    // Obtener la fecha actual para el encabezado
    const today = new Date();
    const dateStr = today.toLocaleDateString('es-VE', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    // Función para añadir el encabezado en cada página
    const addHeader = (doc, title) => {
        const pageWidth = doc.internal.pageSize.getWidth();
        const bannerPath = BASE_URL + 'baner/baner6.png';
        const imageWidth = 150;
        const imageHeight = 15;
        const imageX = (pageWidth - imageWidth) / 2;

        // Añadir el banner
        doc.addImage(bannerPath, 'PNG', imageX, 10, imageWidth, imageHeight);
        
        // Añadir el título
        doc.setFontSize(16);
        doc.text(title, pageWidth / 2, 35, { align: 'center' });

        // Añadir la fecha
        doc.setFontSize(10);
        doc.text(`Fecha de la Consulta: ${dateStr}`, pageWidth - 10, 10, { align: 'right' });
    };

    let isFirstPage = true;

    tablesData.forEach(table => {
        // Añadir una nueva página para cada tabla, excepto la primera
        if (!isFirstPage) {
            doc.addPage();
        }
        isFirstPage = false;

        // Añadir el encabezado a la nueva página
        addHeader(doc, table.title);

        doc.autoTable({
            html: `#${table.id}`,
            startY: 45, // Ajusta la posición inicial para dejar espacio para el encabezado
            headStyles: { fillColor: [220, 53, 69], textColor: [255, 255, 255], fontStyle: 'bold' },
            styles: { fontSize: 12 },
            didDrawPage: function(data) {
                // Si la tabla se extiende a una nueva página, añadir el encabezado
                if (data.pageNumber > 1) {
                    addHeader(doc, table.title);
                }
            }
        });
    });

    doc.save(`Reporte_General_${new Date().toISOString().slice(0, 10)}.pdf`);
}