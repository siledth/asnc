<!-- Para Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<!-- Para PDF -->
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
                        Reporte Programación
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Ingrese Fecha Desde</label>
                            <input class="form-control" type="date" name="fechad" id="fechad">
                        </div>
                        <div class="col-4">
                            <label>Ingrese fecha Hasta</label>
                            <input class="form-control" type="date" name="fechah" id="fechah">
                        </div>
                        <div class="col-4 mt-4">
                            <button type="button" class="btn btn-primary" onclick="buscar();" name="button">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                            <button type="button" class="btn btn-success" onclick="exportToExcel();">
                                <i class="fas fa-file-excel"></i> Cal
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
            <h4 class="text-center mb-3 mt-3">Buscando, por favor espere...</h4>
        </div>

        <div class="col-lg-12" style="display: none" id="items">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Reporte General</b></h4>
                </div>
                <div class="panel-body" id="existe">
                    <div class="row">
                        <div class="col-12">
                            <!-- Tabla de Programación -->
                            <h5 class="mt-3">Programación</h5>
                            <table id="tabla-programacion" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8">
                                    <tr class="text-center">
                                        <th>Total Programación</th>
                                        <th>Total Notificadas</th>
                                        <th>Total Rendidas</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <!-- JS insertará datos aquí -->
                                </tbody>
                            </table>

                            <!-- Tabla de Proyectos -->
                            <h5 class="mt-4">Proyectos</h5>
                            <table id="tabla-proyectos" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8">
                                    <tr class="text-center">
                                        <th>Total Proyectos</th>
                                        <th>Bienes</th>
                                        <th>Servicios</th>
                                        <th>Obras</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <!-- JS insertará datos aquí -->
                                </tbody>
                            </table>

                            <!-- Nueva Tabla de Acciones Centralizadas -->
                            <h5 class="mt-4">Acciones Centralizadas</h5>
                            <table id="tabla-acciones" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8">
                                    <tr class="text-center">
                                        <th>Total ACC</th>
                                        <th>Bienes</th>
                                        <th>Servicios</th>
                                        <th>Obras</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <!-- JS insertará datos aquí -->
                                </tbody>
                            </table>
                            <h5 class="mt-4">Top 10 Productos más utilizados</h5>
                            <table id="tabla-top-productos" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Código CCNU</th>
                                        <th>Descripción</th>
                                        <th>Cantidad Solicitada</th>
                                        <th>Monto Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <!-- Los resultados se insertarán aquí via JavaScript -->
                                </tbody>
                            </table>
                            <!-- Tabla de Comisiones -->
                            <h5 class="mt-4">Comisiones de Contratación</h5>
                            <table id="tabla-comisiones" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8">
                                    <tr class="text-center">
                                        <th>Total Comisiones</th>
                                        <th>Total Miembros Certificados</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <!-- JS insertará datos aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>js/reportesG/reportegeneral.js"></script>