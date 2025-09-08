<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<style>
    /* Estilos generales para las tablas en la vista general */
    .report-card {
        margin-bottom: 2em;
    }
</style>

<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                </div>
                <div class="col-12 text-center mt-3 mb-3">
                    <h4 class="text-center mb-3 mt-3">
                        Reporte General Consolidado
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary" onclick="buscar();" name="button">
                                <i class="fas fa-sync"></i> Recargar Reporte
                            </button>
                            <button type="button" class="btn btn-success" onclick="exportToExcel();">
                                <i class="fas fa-file-excel"></i> Hoja de Cálculo
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
            <!-- Sección para el Reporte de Órganos/Entes -->
            <div class="panel panel-inverse report-card">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Reporte de Órganos/Entes/Unidades Locales Ejecutoras</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="tabla-organos" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_organos" style="color: #fff;"></th>
                                        <th id="anio_anterior_organos" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección para el Reporte de Usuarios -->
            <div class="panel panel-inverse report-card">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Reporte de Usuarios Creados</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="tabla-usuarios" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_usuarios" style="color: #fff;"></th>
                                        <th id="anio_anterior_usuarios" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección para el Reporte de Comisiones y Miembros -->
            <div class="panel panel-inverse report-card">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Reporte de Comisiones y Miembros</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="text-center">Comisiones Notificadas</h5>
                            <table id="tabla-comisiones" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_comisiones" style="color: #fff;"></th>
                                        <th id="anio_anterior_comisiones" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="text-center">Miembros Certificados</h5>
                            <table id="tabla-miembros" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_miembros" style="color: #fff;"></th>
                                        <th id="anio_anterior_miembros" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección para el Reporte de PAC y Rendiciones -->
            <div class="panel panel-inverse report-card">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Reporte de Plan Anual de Compras (PAC)</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5 class="text-center">PAC Registrados</h5>
                            <table id="tabla-pac-registrados" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_pac-registrados" style="color: #fff;"></th>
                                        <th id="anio_anterior_pac-registrados" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="text-center">PAC en Edición</h5>
                            <table id="tabla-pac-edicion" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_pac-edicion" style="color: #fff;"></th>
                                        <th id="anio_anterior_pac-edicion" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="text-center">PAC Notificados</h5>
                            <table id="tabla-pac-notificados" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_pac-notificados" style="color: #fff;"></th>
                                        <th id="anio_anterior_pac-notificados" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-4">
                            <h5 class="text-center">Rendiciones Registradas</h5>
                            <table id="tabla-rendiciones-registradas" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_rendiciones-registradas" style="color: #fff;"></th>
                                        <th id="anio_anterior_rendiciones-registradas" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="text-center">Rendiciones en Edición</h5>
                            <table id="tabla-rendiciones-edicion" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_rendiciones-edicion" style="color: #fff;"></th>
                                        <th id="anio_anterior_rendiciones-edicion" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="text-center">Rendiciones Notificadas</h5>
                            <table id="tabla-rendiciones-notificadas" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_rendiciones-notificadas" style="color: #fff;"></th>
                                        <th id="anio_anterior_rendiciones-notificadas" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección para el Reporte de Llamados a Concurso -->
            <div class="panel panel-inverse report-card">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Reporte de Llamados a Concurso</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5 class="text-center">Bienes</h5>
                            <table id="tabla-llamados-bienes" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_llamados-bienes" style="color: #fff;"></th>
                                        <th id="anio_anterior_llamados-bienes" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="text-center">Servicios</h5>
                            <table id="tabla-llamados-servicios" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_llamados-servicios" style="color: #fff;"></th>
                                        <th id="anio_anterior_llamados-servicios" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="text-center">Obras</h5>
                            <table id="tabla-llamados-obras" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_llamados-obras" style="color: #fff;"></th>
                                        <th id="anio_anterior_llamados-obras" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección para el Reporte de Evaluaciones de Desempeño -->
            <div class="panel panel-inverse report-card">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Reporte de Evaluaciones de Desempeño</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <h5 class="text-center">Excelente</h5>
                            <table id="tabla-excelente" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_excelente" style="color: #fff;"></th>
                                        <th id="anio_anterior_excelente" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-3">
                            <h5 class="text-center">Bueno</h5>
                            <table id="tabla-bueno" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_bueno" style="color: #fff;"></th>
                                        <th id="anio_anterior_bueno" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-3">
                            <h5 class="text-center">Regular</h5>
                            <table id="tabla-regular" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_regular" style="color: #fff;"></th>
                                        <th id="anio_anterior_regular" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                        <div class="col-lg-3">
                            <h5 class="text-center">Deficiente</h5>
                            <table id="tabla-deficiente" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_deficiente" style="color: #fff;"></th>
                                        <th id="anio_anterior_deficiente" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <h5 class="text-center">Evaluaciones Anuladas</h5>
                            <table id="tabla-anuladas" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual_anuladas" style="color: #fff;"></th>
                                        <th id="anio_anterior_anuladas" style="color: #fff;"></th>
                                        <th style="color: #fff;">Diferencia</th>
                                        <th style="color: #fff;">Variación (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección para el Reporte de Top 10 -->
            <div class="panel panel-inverse report-card">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Top 10 de Productos y Órganos/Entes</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <!-- Top 10 Productos Solicitados -->
                        <div class="col-lg-6">
                            <h5 class="text-center">Top 10 Productos Solicitados (Año: <span
                                    id="anio-top_solicitados"></span>)</h5>
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
                        <!-- Top 10 Productos Rendidos -->
                        <div class="col-lg-6">
                            <h5 class="text-center">Top 10 Productos Rendidos (Año: <span
                                    id="anio-top_rendidos"></span>)
                            </h5>
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
                    <div class="row mt-4">
                        <!-- Top 10 Órganos/Entes con más Llamados -->
                        <div class="col-lg-12">
                            <h5 class="text-center">Top 10 Órganos/Entes con más Llamados (Año: <span
                                    id="anio-top_organos"></span>)</h5>
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
<script src="<?= base_url() ?>js/reportesG/reportegeneralu.js"></script>