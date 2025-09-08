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
                        Reporte de Usuarios Creados
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <!-- <button type="button" class="btn btn-primary" onclick="buscar();" name="button">
                                <i class="fas fa-search"></i> Generar Reporte
                            </button> -->
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
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Total de Usuarios Creados por Mes</b></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="tabla-usuarios" class="table table-bordered table-hover">
                                <thead style="background:#dc3545; color:#fff;">
                                    <tr class="text-center" style="font-size: 3em;">
                                        <th style="color: #fff;">Mes</th>
                                        <th id="anio_actual" style="color: #fff;"></th>
                                        <th id="anio_anterior" style="color: #fff;"></th>
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
        </div>
    </div>
</div>
<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url() ?>js/reportesG/reporteusuarios.js"></script>