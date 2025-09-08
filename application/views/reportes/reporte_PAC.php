<!-- Cargar librerías y scripts -->
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
                        Reporte de Plan Anual de Compras (PAC)
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 text-center">
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
                <!-- Tablas de PAC -->
                <div class="col-lg-4">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>PAC Registrados</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-pac-registrados" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Mes</th>
                                        <th id="anio_actual_pac_registrados"></th>
                                        <th id="anio_anterior_pac_registrados"></th>
                                        <th>Diferencia</th>
                                        <th>Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>PAC en Edición</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-pac-edicion" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Mes</th>
                                        <th id="anio_actual_pac_edicion"></th>
                                        <th id="anio_anterior_pac_edicion"></th>
                                        <th>Diferencia</th>
                                        <th>Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>PAC Notificados</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-pac-notificados" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Mes</th>
                                        <th id="anio_actual_pac_notificados"></th>
                                        <th id="anio_anterior_pac_notificados"></th>
                                        <th>Diferencia</th>
                                        <th>Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <!-- Tablas de Rendiciones -->
                <div class="col-lg-4">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>Rendiciones Registradas</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-rendiciones-registradas" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Mes</th>
                                        <th id="anio_actual_rendiciones_registradas"></th>
                                        <th id="anio_anterior_rendiciones_registradas"></th>
                                        <th>Diferencia</th>
                                        <th>Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>Rendiciones en Edición</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-rendiciones-edicion" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Mes</th>
                                        <th id="anio_actual_rendiciones_edicion"></th>
                                        <th id="anio_anterior_rendiciones_edicion"></th>
                                        <th>Diferencia</th>
                                        <th>Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center"><b>Rendiciones Notificadas</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="tabla-rendiciones-notificadas" class="table table-bordered table-hover">
                                <thead class="bg-danger text-white">
                                    <tr class="text-center">
                                        <th>Mes</th>
                                        <th id="anio_actual_rendiciones_notificadas"></th>
                                        <th id="anio_anterior_rendiciones_notificadas"></th>
                                        <th>Diferencia</th>
                                        <th>Variación (%)</th>
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
<script src="<?= base_url() ?>js/reportesG/reportepac.js"></script>