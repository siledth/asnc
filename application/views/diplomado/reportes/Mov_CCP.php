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
                        Reporte de Movimientos BDV
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Número de Cuenta</label>
                            <input class="form-control" type="text" name="cuenta_bdv" id="cuenta_bdv"
                                value="01020552270000042877" readonly>
                        </div>
                        <div class="col-4">
                            <label>Fecha Desde</label>
                            <input class="form-control" type="date" name="fechad_bdv" id="fechad_bdv"
                                value="<?= date('Y-m-d', strtotime('-30 days')) ?>">
                        </div>
                        <div class="col-4">
                            <label>Fecha Hasta</label>
                            <input class="form-control" type="date" name="fechah_bdv" id="fechah_bdv"
                                value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button type="button" class="btn btn-primary" onclick="buscarMovimientosBDV();"
                                name="button">
                                <i class="fas fa-search"></i> Buscar Movimientos
                            </button>
                            <button type="button" class="btn btn-success" onclick="exportToExcelMovimientosBDV();">
                                <i class="fas fa-file-excel"></i> Excel
                            </button>
                            <button type="button" class="btn btn-danger" onclick="exportToPDFMovimientosBDV();">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loadingMovimientosBDV" style="display: none; text-align: center; margin: 20px;">
            <h4 class="text-center mb-3 mt-3">Consultando movimientos, por favor espere...</h4>
        </div>

        <div class="col-lg-12" style="display: none" id="movimientosResultadosBDV">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Resultados de Movimientos BDV</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tabla-movimientos-bdv" class="table table-bordered table-hover">
                                    <thead style="background:#e4e7e8">
                                        <tr class="text-center">
                                            <th>Referencia</th>
                                            <th>Fecha</th>
                                            <th>Mov. Tipo</th>
                                            <th>Importe</th>
                                            <th>Saldo</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <ul class="pagination" id="movimientos-pagination-bdv"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>js/reportesG/reporte_movimientos_bdv.js"></script>