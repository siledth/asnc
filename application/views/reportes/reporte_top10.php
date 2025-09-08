<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                </div>
                <div class="col-12 text-center mt-3 mb-3">
                    <h4 class="text-center mb-3 mt-3">
                        Reporte de Top 10
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary" onclick="buscar();" name="button">
                                <i class="fas fa-search"></i> Generar Reporte
                            </button>
                            <button type="button" class="btn btn-success" onclick="exportToExcel();">
                                <i class="fas fa-file-excel"></i> Excel
                            </button>
                            <button type="button" class="btn btn-danger" onclick="exportToPDF();">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loading" style="display: none; text-align: center; margin: 20px;">
            <h4 class="text-center mb-3 mt-3">Generando reporte, por favor espere...</h4>
        </div>
        <div class="col-lg-12" style="display: none" id="items">
            <div class="row">
                <!-- Tabla para Top 10 de Productos Solicitados -->
                <div class="col-lg-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>Top 10 Productos Solicitados (Año: <span
                                        id="anio-solicitados"></span>)</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-top-solicitados" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Posición</th>
                                        <th>Código CCNU</th>
                                        <th>Descripción</th>
                                        <th>Cantidad Solicitada</th>
                                        <th>Monto Total</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Tabla para Top 10 de Productos Rendidos -->
                <div class="col-lg-6">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>Top 10 Productos Rendidos (Año: <span
                                        id="anio-rendidos"></span>)</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-top-rendidos" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Posición</th>
                                        <th>Código CCNU</th>
                                        <th>Descripción</th>
                                        <th>Cantidad Ejecutada</th>
                                        <th>Monto Total</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <!-- Tabla para Top 10 de Órganos/Entes -->
                <div class="col-lg-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>Top 10 Órganos/Entes con más Llamados (Año: <span
                                        id="anio-organos"></span>)</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-top-organos" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Posición</th>
                                        <th>RIF</th>
                                        <th>Órgano/Ente</th>
                                        <th>Cantidad de Llamados</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url() ?>js/reportesG/reportetop10.js"></script>