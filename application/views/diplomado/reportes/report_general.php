<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <h2 class="text-center">Reporte General de Participantes</h2>

                    <form id="filtroParticipantesForm" method="post"
                        action="<?php echo base_url(); ?>index.php/Diplomado/reportesgeneral">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_diplomado" class="form-label">Seleccionar Diplomado:</label>
                                <select class="form-control" id="id_diplomado" name="id_diplomado">
                                    <option value="">Seleccione un Diplomado</option>
                                    <?php foreach ($diplomados as $diplomado): ?>
                                        <option value="<?= $diplomado['id_diplomado'] ?>"
                                            <?php echo (isset($selected_diplomado) && $selected_diplomado == $diplomado['id_diplomado']) ? 'selected' : ''; ?>>
                                            <?= $diplomado['name_d'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_estatus" class="form-label">Seleccionar Estatus:</label>
                                <select class="form-control" id="id_estatus" name="id_estatus" required>
                                    <option value="">Seleccione un Estatus</option>
                                    <?php foreach ($estatus_inscripcion as $estatus): ?>
                                        <option value="<?= $estatus['id_estatus'] ?>"
                                            <?php echo (isset($selected_estatus) && $selected_estatus == $estatus['id_estatus']) ? 'selected' : ''; ?>>
                                            <?= $estatus['nombre'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-4">
                        <?php if (empty($participantes) && (empty($selected_diplomado) && empty($selected_estatus))): ?>
                            <div class="alert alert-info text-center" role="alert">
                                Por favor, seleccione al menos un Diplomado o un Estatus para ver los participantes.
                            </div>
                        <?php elseif (empty($participantes) && (!empty($selected_diplomado) || !empty($selected_estatus))): ?>
                            <div class="alert alert-warning text-center" role="alert">
                                No se encontraron participantes con los filtros seleccionados.
                            </div>
                        <?php else: ?>
                            <table id="data-table" data-order='[[ 2, "asc" ]]' class="table table-bordered table-hover">
                                <thead style="background:#01cdb2">
                                    <tr style="text-align:center">
                                        <th style="color:white;">Nombre del Diplomado</th>
                                        <th style="color:white;">Cédula</th>
                                        <th style="color:white;">Nombres</th>
                                        <th style="color:white;">Estatus</th>
                                        <th style="color:white;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($participantes as $data): ?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td><?= $data['name_d'] ?> </td>
                                            <td><?= $data['cedula'] ?> </td>
                                            <td><?= $data['nombres'] ?> <?= $data['apellidos'] ?></td>
                                            <td><?= $data['des_estatus'] ?> </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>index.php/Preinscripcionnatural/pdfrt?id=<?php echo $data['codigo_planilla']; ?>"
                                                    class="button">
                                                    <i class="fas fa-2x fa-cloud-download-alt" title="Certificado"
                                                        style="color: blue;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cargarIdInscripcion(id) {
            document.getElementById('id_inscripcion').value = id;
        }
    </script>
    <script src="<?= base_url() ?>/js/diplomado/diplomado.js"></script>
</div>