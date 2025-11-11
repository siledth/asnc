<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Reporte de Transacciones de Pago</h2>
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">Seleccionar Filtros de Búsqueda</h4>
        </div>
        <div class="panel-body">
            <form id="form_reporte_pagos" class="form-horizontal">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="col-form-label">Fecha Desde</label>
                        <input type="date" class="form-control" id="fecha_desde" name="fecha_desde">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label">Fecha Hasta</label>
                        <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="col-form-label">Nro. de Proceso</label>
                        <input type="text" class="form-control" id="proceso_id" name="proceso_id"
                            placeholder="ID Proceso">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="col-form-label">RIF Contratista</label>
                        <input type="text" class="form-control" id="rif_contratista" name="rif_contratista"
                            placeholder="J123456789">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="col-form-label">Nombre Contratista</label>
                        <input type="text" class="form-control" id="nombre_contratista" name="nombre_contratista"
                            placeholder="Razón Social">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="col-form-label">Nro. de Referencia</label>
                        <input type="text" class="form-control" id="transactionid" name="transactionid"
                            placeholder="ID Transacción">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="col-form-label">Tipo de Transacción</label>
                        <select class="form-control" id="id_tptrans" name="id_tptrans">
                            <option value="">Todos</option>
                            <option value="1">Botón de Pago</option>
                            <option value="2">Transferencia</option>
                            <option value="3">Pago Móvil</option>
                        </select>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="my-button">Consultar Pagos</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="panel panel-inverse" style="display: none;" id="tabla_reporte_container">
        <div class="panel-heading">
            <h4 class="panel-title">Resultados de Transacciones de Pago</h4>
        </div>
        <div class="panel-body">
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-success" id="btn_exportar_csv" disabled>
                        <i class="fas fa-file-csv"></i> Exportar CSV
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="data-table-reporte" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID Proceso</th>
                            <th>Fecha Pago</th>
                            <th>RIF Contratista</th>
                            <th>Nombre Contratista</th>
                            <th>Monto</th>
                            <th>Tipo Transacción</th>
                            <th>Método Pago</th>
                            <th>Referencia</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example" class="mt-3">
                <ul class="pagination" id="paginacion_tabla">
                    <li class="page-item" id="anterior_li">
                        <a class="page-link" href="#" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Anterior</span>
                        </a>
                    </li>
                    <li class="page-item" id="siguiente_li">
                        <a class="page-link" href="#" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<!-- <link href="<?= base_url() ?>assets/css/reporte_pagos.css" rel="stylesheet" /> -->
<link href="<?= base_url('css/reporte_pagos.css') ?>" rel="stylesheet">
<script src="<?= base_url() ?>js/pagosrnc.js"></script>