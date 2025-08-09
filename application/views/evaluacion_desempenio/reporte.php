<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Evaluaciones de Desempeño</h2>
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">Seleccionar Filtros de Búsqueda</h4>
        </div>
        <div class="panel-body">
            <form id="form_reporte_evaluaciones" class="form-horizontal">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Fecha Desde</label>
                        <input type="date" class="form-control" id="fecha_desde" name="fecha_desde">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Fecha Hasta</label>
                        <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="col-form-label">ID de Evaluación</label>
                        <input type="text" class="form-control" id="id_evaluacion" name="id_evaluacion"
                            placeholder="ID">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="col-form-label">RIF Órgano/Ente</label>
                        <input type="text" class="form-control" id="rif_organoente" name="rif_organoente"
                            placeholder="G123456789">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="col-form-label">Nombre organo Evaluador</label>
                        <input type="text" class="form-control" id="organo_ente" name="organo_ente"
                            placeholder="Nombre del Órgano/Ente">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="col-form-label">RIF Contratista</label>
                        <input type="text" class="form-control" id="rif_contrat" name="rif_contrat"
                            placeholder="J123456789">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="col-form-label">nombre del Contratista evaluado</label>
                        <input type="text" class="form-control" id="contratista_ev" name="contratista_ev"
                            placeholder="Nombre del Contratista">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="col-form-label">Calificación</label>
                        <select class="form-control" id="calificacion" name="calificacion">

                            <option value="EXCELENTE">EXCELENTE</option>
                            <option value="BUENO">BUENO</option>
                            <option value="REGULAR">REGULAR</option>
                            <option value="DEFICIENTE">DEFICIENTE</option>
                        </select>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="my-button">Consultar Evaluaciones</button>
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


<script src="<?= base_url() ?>js/eval_desempenio/evaluacionesnc.js"></script>