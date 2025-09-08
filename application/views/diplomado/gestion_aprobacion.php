<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-12 text-center mt-4">
                        <h2 style="color:#007bff; font-weight: bold;">Gestión de Aprobación de Diplomas</h2>
                        <p class="text-muted">Selecciona un diplomado para gestionar el estatus de aprobación de sus
                            participantes.</p>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="card p-4 shadow-sm mb-4">
                            <h4 class="card-title text-center">Seleccionar Diplomado</h4>
                            <div class="form-group">
                                <label for="select-diplomado">Selecciona un Diplomado:</label>
                                <select id="select-diplomado" class="form-control">
                                    <option value="">Seleccione...</option>
                                    <?php foreach ($diplomados as $diplomado): ?>
                                        <option value="<?= $diplomado['id_diplomado'] ?>"><?= $diplomado['name_d'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4" id="participantes-container" style="display:none;">
                        <div class="card p-4 shadow-sm mb-4">
                            <h4 class="card-title text-center" style="color:#00a3e0;">Lista de Participantes</h4>
                            <div class="table-responsive">
                                <table id="participantes-table" class="table table-bordered table-striped table-hover">
                                    <thead class="text-center" style="background:#e4e7e8;">
                                        <tr>
                                            <th>Cédula</th>
                                            <th>Nombre Completo</th>
                                            <th>Estatus de Aprobación</th>
                                        </tr>
                                    </thead>
                                    <tbody id="participantes-tbody">
                                        <!-- Los datos se llenarán dinámicamente aquí -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- Paginación -->
                            <div class="d-flex justify-content-center mt-3">
                                <ul class="pagination" id="pagination-controls"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nuevo botón de exportar a Excel -->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button id="export-excel-button" class="btn btn-info" style="display:none;">
                            <i class="fas fa-file-excel"></i> Exportar a Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url() ?>/js/diplomado/gestion_aprobacion.js"></script>

<style>
    /* Estilos para el toggle switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #dc3545;
        /* Rojo para reprobado */
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #28a745;
        /* Verde para aprobado */
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }
</style>