<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Reporte de Transacciones de Pago</h2>
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">Seleccionar Filtros de Búsqueda</h4>
        </div>
        <div class="panel-body">
            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <title>Dashboard de Pagos</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
                <style>
                    /* Ajuste de Contenedor de Gráficos para armonía y mejor lectura */
                    .chart-container {
                        position: relative;
                        height: 350px;
                        /* Reducido de 400px a 350px para ser más compacto */
                        width: 95%;
                        margin: 15px auto;
                        /* Reducido el margen */
                    }

                    .card-header.bg-info {
                        background-color: #20c997 !important;
                    }

                    /* Estilos para las Tarjetas de Sumario (KPIs) */
                    .kpi-card {
                        border-radius: .5rem;
                        text-align: center;
                        padding: 15px 0;
                        color: white;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, .15);
                        margin-bottom: 20px;
                    }

                    .kpi-card h4 {
                        font-size: 1.5rem;
                        margin-bottom: 0;
                        font-weight: 700;
                    }

                    .kpi-card p {
                        font-size: 0.9rem;
                        margin-top: 5px;
                        opacity: 0.9;
                    }

                    /* Colores Consistentes con los gráficos */
                    .bg-transferencia {
                        background-color: #1e7e34;
                    }

                    .bg-boton-pago {
                        background-color: #007bff;
                    }

                    .bg-transferencia-multiple {
                        background-color: #ffc107;
                        color: #333;
                    }

                    .bg-pago-movil {
                        background-color: #dc3545;
                    }
                </style>
            </head>

            <body>

                <div class="container mt-5">
                    <h2 class="mb-4 text-center"> Dashboard de Estadísticas de Pagos</h2>
                    <hr>

                    <div class="card p-4 shadow-sm mb-5">
                        <form method="POST" action="<?= site_url('Dashboard_controller/index') ?>">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="fecha_desde">Fecha Desde:</label>
                                    <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" required
                                        value="<?= html_escape($fecha_desde) ?>">
                                </div>
                                <div class="col-md-5">
                                    <label for="fecha_hasta">Fecha Hasta:</label>
                                    <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" required
                                        value="<?= html_escape($fecha_hasta) ?>">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-block">🔎 Filtrar Gráficos</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if (empty($graficos_data) || (empty($fecha_desde) || empty($fecha_hasta))): ?>
                        <div class="alert alert-warning text-center" role="alert">
                            Por favor, selecciona un rango de fechas para cargar los gráficos.
                        </div>
                    <?php else:
                        // Pre-procesar datos para las Tarjetas KPI
                        $ingresos_map = [];
                        $total_general = 0;
                        foreach ($graficos_data['ingresos'] as $item) {
                            $key = strtolower(str_replace(' ', '_', $item['tipo_transaccion']));
                            $ingresos_map[$key] = $item['total_ingresos'];
                            $total_general += $item['total_ingresos'];
                        }
                    ?>

                        <h3 class="mb-4">Totales Consolidados de Ingresos <small class="text-muted">(Monto Total:
                                <?= number_format($total_general, 2, ',', '.') ?>)</small></h3>
                        <div class="row mb-5">

                            <div class="col-md-3">
                                <div class="kpi-card bg-transferencia">
                                    <h4><?= number_format($ingresos_map['transferencia'] ?? 0, 2, ',', '.') ?></h4>
                                    <p>Transferencia</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="kpi-card bg-boton-pago">
                                    <h4><?= number_format($ingresos_map['botón_de_pago'] ?? 0, 2, ',', '.') ?></h4>
                                    <p>Botón de Pago</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="kpi-card bg-transferencia-multiple">
                                    <h4><?= number_format($ingresos_map['transferencia_multiple'] ?? 0, 2, ',', '.') ?></h4>
                                    <p>Transferencia Múltiple</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="kpi-card bg-pago-movil">
                                    <h4><?= number_format($ingresos_map['pago_móvil'] ?? 0, 2, ',', '.') ?></h4>
                                    <p>Pago Móvil</p>
                                </div>
                            </div>
                        </div>

                        <h3 class="mb-4">Visualización de Tendencias y Comparación</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">Total de Ingresos por Tipo de Transacción</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="ingresosChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0">Evolución Mensual de Transacciones por Tipo</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="evolucionTransaccionesChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="card shadow-sm h-100">
                                    <?php
                                    $ano_actual_comp = $graficos_data['comparacion_anual']['ano_actual'] ?? date('Y');
                                    $ano_anterior_comp = $graficos_data['comparacion_anual']['ano_anterior'] ?? date('Y') - 1;
                                    ?>
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">📈 Comparación Anual de Ingresos (<?= $ano_actual_comp ?> vs.
                                            <?= $ano_anterior_comp ?>)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="width: 90%; height: 400px;">
                                            <canvas id="comparacionAnualChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Registrar el plugin de DataLabels globalmente
                            Chart.register(ChartDataLabels);

                            // Datos traídos desde PHP
                            const ingresosData = <?= json_encode($graficos_data['ingresos']) ?>;
                            const evolucionTransaccionesData = <?= json_encode($graficos_data['evolucion_transacciones']) ?>;
                            const comparacionAnualData = <?= json_encode($graficos_data['comparacion_anual']) ?>;

                            // Helper para colores (usando los mismos que las tarjetas)
                            function getColor(tipo) {
                                switch (tipo) {
                                    case 'Transferencia':
                                        return '#1e7e34';
                                    case 'Botón de Pago':
                                        return '#007bff';
                                    case 'Transferencia multiple':
                                        return '#ffc107';
                                    case 'Pago Móvil':
                                        return '#dc3545';
                                    default:
                                        return '#6c757d';
                                }
                            }

                            // Helper para formatear números como moneda
                            function formatCurrency(value) {
                                if (value === null || value === undefined) return '0,00';
                                if (typeof value === 'string') {
                                    value = parseFloat(value);
                                }
                                return value.toLocaleString('es-VE', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }


                            // ------------------------------------------------------------------
                            // GRAFICO 1: Ingresos por Tipo de Transacción (Barras)
                            // ------------------------------------------------------------------
                            if (ingresosData.length > 0) {
                                const labelsIngresos = ingresosData.map(d => d.tipo_transaccion);
                                const dataIngresos = ingresosData.map(d => parseFloat(d.total_ingresos));

                                const maxIngreso = Math.max(...dataIngresos);

                                new Chart(document.getElementById('ingresosChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labelsIngresos,
                                        datasets: [{
                                            label: 'Total de Ingresos (Monto)',
                                            data: dataIngresos,
                                            // Usar el helper para asignar los colores
                                            backgroundColor: labelsIngresos.map(getColor),
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top',
                                            },
                                            datalabels: {
                                                anchor: 'end',
                                                align: 'top',
                                                offset: 8,
                                                formatter: function(value, context) {
                                                    return formatCurrency(value);
                                                },
                                                color: '#444',
                                                font: {
                                                    weight: 'bold',
                                                    size: 10
                                                }
                                            },
                                            title: {
                                                display: false
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Monto Total'
                                                },
                                                suggestedMax: maxIngreso > 0 ? maxIngreso * 1.15 : 100
                                            }
                                        }
                                    }
                                });
                            }


                            // ------------------------------------------------------------------
                            // GRAFICO 2: Evolución Mensual de Transacciones por Tipo (Líneas)
                            // ------------------------------------------------------------------
                            if (evolucionTransaccionesData.length > 0) {
                                const allMonths = [...new Set(evolucionTransaccionesData.map(item => item.mes))].sort();
                                const allTipos = [...new Set(evolucionTransaccionesData.map(item => item.tipo_transaccion))];

                                const datasets = allTipos.map((tipo, index) => {
                                    const dataPoints = allMonths.map(mes => {
                                        const record = evolucionTransaccionesData.find(item => item.mes ===
                                            mes && item
                                            .tipo_transaccion === tipo);
                                        return record ? parseInt(record.cantidad_transacciones) : 0;
                                    });
                                    const color = getColor(tipo); // Usar el helper de color
                                    return {
                                        label: tipo,
                                        data: dataPoints,
                                        borderColor: color,
                                        backgroundColor: color + '40',
                                        fill: false,
                                        tension: 0.3,
                                        pointRadius: 5,
                                        pointHoverRadius: 8
                                    };
                                });

                                new Chart(document.getElementById('evolucionTransaccionesChart'), {
                                    type: 'line',
                                    data: {
                                        labels: allMonths,
                                        datasets: datasets
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top',
                                            },
                                            datalabels: {
                                                display: false
                                            },
                                            title: {
                                                display: false
                                            }
                                        },
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Mes'
                                                }
                                            },
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Cantidad de Transacciones'
                                                },
                                                ticks: {
                                                    precision: 0
                                                }
                                            }
                                        }
                                    }
                                });
                            }

                            // ------------------------------------------------------------------
                            // GRAFICO 3: Comparación Anual de Ingresos (Barra y Línea)
                            // ------------------------------------------------------------------
                            const dataActual = Object.values(comparacionAnualData.actual).slice(1);
                            const dataAnterior = Object.values(comparacionAnualData.anterior).slice(1);

                            const hasDataAnual = dataActual.some(v => v > 0) || dataAnterior.some(v => v > 0);

                            if (hasDataAnual) {

                                const mesesLabels = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
                                    'Nov', 'Dic'
                                ];
                                const anoActual = comparacionAnualData.ano_actual;
                                const anoAnterior = comparacionAnualData.ano_anterior;

                                new Chart(document.getElementById('comparacionAnualChart'), {
                                    data: {
                                        labels: mesesLabels,
                                        datasets: [{
                                                type: 'bar',
                                                label: `Ingresos Año Actual (${anoActual})`,
                                                data: dataActual,
                                                backgroundColor: '#007bff', // Azul
                                                yAxisID: 'y'
                                            },
                                            {
                                                type: 'line',
                                                label: `Ingresos Año Anterior (${anoAnterior})`,
                                                data: dataAnterior,
                                                borderColor: '#dc3545', // Rojo
                                                borderWidth: 3,
                                                fill: false,
                                                tension: 0.4,
                                                pointRadius: 5,
                                                yAxisID: 'y'
                                            }
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top'
                                            },
                                            datalabels: {
                                                anchor: 'end',
                                                align: 'top',
                                                offset: 5,
                                                color: '#007bff',
                                                font: {
                                                    weight: 'bold',
                                                    size: 10
                                                },
                                                formatter: function(value, context) {
                                                    if (context.dataset.type === 'bar' && value > 0) {
                                                        return (value / 1000).toFixed(0) + 'k';
                                                    }
                                                    return null;
                                                }
                                            }
                                        },
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Mes'
                                                }
                                            },
                                            y: {
                                                id: 'y',
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: 'Ingresos (miles de Bolívares)'
                                                },
                                                ticks: {
                                                    callback: function(value, index, values) {
                                                        return (value / 1000).toFixed(0) + 'k';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            } else {
                                document.getElementById('comparacionAnualChart').parentElement.innerHTML =
                                    '<div class="text-center p-5 text-muted">No se encontraron datos de ingresos para la comparación anual.</div>';
                            }
                        </script>

                    <?php endif; ?>
                </div>

            </body>

            </html>
        </div>
    </div>



</div>