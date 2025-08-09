<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Evaluaciones de Desempeño</h2>
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">Seleccionar Rango de Fechas</h4>
        </div>
        <div class="panel-body">
            <form id="form_reporte_evaluaciones" class="form-horizontal">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Fecha Desde</label>
                    <div class="col-md-4">
                        <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" required>
                    </div>
                    <label class="col-md-2 col-form-label">Fecha Hasta</label>
                    <div class="col-md-4">
                        <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="my-button">Generar Reporte</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-inverse" style="display: none;" id="tabla_reporte_container">
        <div class="panel-heading">
            <h4 class="panel-title">Resultados de la evaluaciones de desempeño</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="data-table-reporte" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Reg. Evaluación</th>
                            <th>RIF Órgano/Ente</th>
                            <th>Órgano/Ente</th>
                            <th>RIF Contratista</th>
                            <th>Contratista</th>
                            <th>Calificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example" class="mt-3">
                <ul class="pagination" id="paginacion_tabla"></ul>
            </nav>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>js/eval_desempenio/evaluacionesulm.js"></script>