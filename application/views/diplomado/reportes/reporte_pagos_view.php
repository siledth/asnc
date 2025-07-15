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
                        Reporte de Pagos de Diplomados
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Ingrese Fecha Desde</label>
                            <input class="form-control" type="date" name="fechad" id="fechad" value="2025-06-20">
                        </div>
                        <div class="col-4">
                            <label>Ingrese fecha Hasta</label>
                            <input class="form-control" type="date" name="fechah" id="fechah" value="2025-07-14">
                        </div>
                        <div class="col-4 mt-4">
                            <button type="button" class="btn btn-primary" onclick="buscarPagos();" name="button">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                            <button type="button" class="btn btn-success" onclick="exportToExcelPagos();">
                                <i class="fas fa-file-excel"></i> Excel
                            </button>
                            <button type="button" class="btn btn-danger" onclick="exportToPDFPagos();">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loadingPagos" style="display: none; text-align: center; margin: 20px;">
            <h4 class="text-center mb-3 mt-3">Buscando pagos, por favor espere...</h4>
        </div>

        <div class="col-lg-12" style="display: none" id="pagosResultados">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Resultados de Pagos</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tabla-pagos" class="table table-bordered table-hover">
                                    <thead style="background:#e4e7e8">
                                        <tr class="text-center">
                                            <th>ID Pago</th>

                                            <th>Cód. Planilla</th>
                                            <th>Diplomado</th>
                                            <th>Monto</th>
                                            <th>Fecha Pago</th>
                                            <th>Referencia</th>
                                            <th>Banco Origen</th>
                                            <th>Forma Pago</th>

                                            <th>Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <ul class="pagination" id="pagos-pagination"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>js/reportesG/reporte_pagos.js"></script>