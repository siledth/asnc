<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-md-5 text-center mt-3">
                        <h3 class="text-center">Programaciones Recibidas</h3>
                        <table id="data-table4" data-order='[[ 1, "asc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Organo/Ente</th>
                                    <th>Año</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($read as $lista): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['rif']?></td>
                                    <td><?=$lista['des_unidad']?></td>
                                    <td><?=$lista['anio']?></td>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 text-center mt-3">
                        <h3 class="text-center">Totales Programaciones Recibidas</h3>
                        <table id="data-table" data-order='[[ 1, "asc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">
                                    <th>Año</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($anio_totales1 as $lista): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['anio']?></td>
                                    <td><?=$lista['total']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 text-center mt-3">
                        <h3 class="text-center">Gráfico</h3>
                        <canvas id="myPieChart" width="350" height="320"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
var ctx = document.getElementById('myPieChart').getContext('2d');
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [
            <?php foreach ($anio_totales as $row): ?> '<?php echo $row->anio; ?>',
            <?php endforeach; ?>
        ],
        datasets: [{
            label: 'Total por Año',
            data: [
                <?php foreach ($anio_totales as $row): ?>
                <?php echo $row->total; ?>,
                <?php endforeach; ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Gráfico de Torta - Total por Año'
            },
            datalabels: {
                color: '#0a0a0a', // Color de las etiquetas (puedes cambiarlo)
                anchor: 'center', // Ancla la etiqueta en el centro del segmento
                align: 'center', // Alinea la etiqueta en el centro
                formatter: (value, context) => {
                    return value; // Muestra el total directamente
                }
            }
        }
    },
    plugins: [ChartDataLabels] // Agregar el plugin de etiquetas
});
</script>
<style>
/* Asegúrate de que el gráfico sea responsivo */
#myPieChart {
    max-width: 100%;
    height: auto;
}

#myPieChart2 {
    max-width: 100%;
    height: auto;
}

#myPieChart3 {
    max-width: 100%;
    height: auto;
}
</style>

<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-md-5 text-center mt-3">
                        <h3 class="text-center">Modificaciones Ley Recibidas</h3>
                        <table id="data-table5" data-order='[[ 2, "desc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">

                                    <th>Organo/Ente</th>
                                    <th>Año</th>

                                    <th>total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($modificaciones as $lista): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['des_unidad']?></td>
                                    <td><?=$lista['anio']?></td>

                                    <td><?=$lista['total_veces']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 text-center mt-3">
                        <h3 class="text-center">Totales de modificaciones realizadas por año</h3>
                        <table id="data-table6" data-order='[[ 1, "asc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">
                                    <th>Año</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($anio_totales_modif as $lista): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['anio']?></td>
                                    <td><?=$lista['total_veces']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 text-center mt-3">
                        <h3 class="text-center">Gráfico</h3>
                        <canvas id="myPieChart2" width="350" height="320"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var ctx = document.getElementById('myPieChart2').getContext('2d');
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [
            <?php foreach ($anio_totales_modi_graf as $row): ?> '<?php echo $row->anio; ?>',
            <?php endforeach; ?>
        ],
        datasets: [{
            label: 'Total por Año',
            data: [
                <?php foreach ($anio_totales_modi_graf as $row): ?>
                <?php echo $row->total_veces; ?>,
                <?php endforeach; ?>
            ],
            backgroundColor: [

                'rgba(54, 162, 235, 0.2)',
                'rgba(144,238,144,1)',

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',

            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: ''
            },
            datalabels: {
                color: '#CC0002', // Color de las etiquetas (puedes cambiarlo)
                anchor: 'center', // Ancla la etiqueta en el centro del segmento
                align: 'center', // Alinea la etiqueta en el centro
                formatter: (value, context) => {
                    return value; // Muestra el total directamente
                }
            }
        }
    },
    plugins: [ChartDataLabels] // Agregar el plugin de etiquetas
});
</script>

<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-md-5 text-center mt-3">
                        <h3 class="text-center">Rendiciones Recibidas</h3>
                        <table id="data-table7" data-order='[[ 2, "desc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">

                                    <th>Organo/Ente</th>
                                    <th>Año</th>

                                    <th>total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rendiciones as $lista): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['rif']?></td>
                                    <td><?=$lista['des_unidad']?></td>
                                    <td><?=$lista['anio']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 text-center mt-3">
                        <h3 class="text-center">Total de rendición realizadas por año</h3>
                        <table id="data-table8" data-order='[[ 1, "asc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">
                                    <th>Año</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($anio_totales_rendi as $lista): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['anio']?></td>
                                    <td><?=$lista['total_rendicion']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 text-center mt-3">
                        <h3 class="text-center">Gráfico</h3>
                        <canvas id="myPieChart3" width="350" height="320"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var ctx = document.getElementById('myPieChart3').getContext('2d');
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [
            <?php foreach ($anio_totales_rendi_graf as $row): ?> '<?php echo $row->anio; ?>',
            <?php endforeach; ?>
        ],
        datasets: [{
            label: 'Total por Año',
            data: [
                <?php foreach ($anio_totales_rendi_graf as $row): ?>
                <?php echo $row->total_rendicion; ?>,
                <?php endforeach; ?>
            ],
            backgroundColor: [

                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(144,238,144,1)',
                'rgba(153, 102, 255, 0.2)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'


            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: ''
            },
            datalabels: {
                color: '#CC0002', // Color de las etiquetas (puedes cambiarlo)
                anchor: 'center', // Ancla la etiqueta en el centro del segmento
                align: 'center', // Alinea la etiqueta en el centro
                formatter: (value, context) => {
                    return value; // Muestra el total directamente
                }
            }
        }
    },
    plugins: [ChartDataLabels] // Agregar el plugin de etiquetas
});
</script>
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-md-5 text-center mt-3">
                        <h3 class="text-center">Total Usuarios por Organo/Ente</h3>
                        <table id="data-table9" data-order='[[ 2, "desc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">
                                    <th>RIF</th>

                                    <th>Organo/Ente</th>

                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($usuarios as $lista): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['rif_organoente']?></td>
                                    <td><?=$lista['razon_social']?></td>
                                    <td><?=$lista['total_usuarios']?></td>


                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 text-center mt-3">

                    </div>
                    <div class="col-md-3 text-center mt-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>