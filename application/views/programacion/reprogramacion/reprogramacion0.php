<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <p class="f-s-16 text-inverse f-w-600">Nombre Órgano / Ente: <?= $des_unidad ?>.</p>
                                    <p class="f-s-14">RIF.: <?= $rif ?> <br>
                                        Código ONAPRE: <?= $codigo_onapre ?></p>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <div class="col-3"></div>
                    <div class="col-6 text-center mt-1">
                        <h3 class="text-center">Historial y Reprogramación de Planes Anuales (Art. 38, Numeral 2
                            DCRVFLCP)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Período</th>
                                    <th>Versión Nº</th>
                                    <th>Estado</th>
                                    <th>Fecha Última Modificación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_programaciones as $lista): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $lista['anio'] ?> </td>
                                        <td><?= $lista['num_reprogramacion'] ?></td>
                                        <td>
                                            <?php if ($lista['estatus'] == 2): ?>
                                                <span class="label label-success">Activa (Vigente)</span>
                                            <?php elseif ($lista['estatus'] == 0): ?>
                                                <span class="label label-info">En Reprogramación</span>
                                            <?php elseif ($lista['estatus'] == 4): ?>
                                                <span class="label label-warning">Histórica</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d/m/Y H:i:s', strtotime($lista['fecha_modifi'])) ?></td>
                                        <td class="center">
                                            <?php if ($lista['estatus'] == 2): ?>
                                                <a href="javascript:void(0);"
                                                    onclick="iniciarReprogramacion(<?= $lista['id_programacion'] ?>);"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-plus-square"
                                                        title="Crear Nueva Versión (Reprogramar)"></i>
                                                </a>
                                                <a title="Ver la versión final de esta Programación"
                                                    href="<?php echo base_url(); ?>index.php/programacion/ver_programacion_final?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-eye" style="color: grey;"></i>
                                                </a>
                                            <?php elseif ($lista['estatus'] == 0): ?>
                                                <a href="<?php echo base_url(); ?>index.php/programacion/consultar_item_reprogramacion?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-pencil-alt"
                                                        title="Continuar Edición/Reprogramación"></i>
                                                </a>
                                            <?php elseif ($lista['estatus'] == 4): ?>
                                                <a title="Ver esta Versión Histórica"
                                                    href="<?php echo base_url(); ?>index.php/programacion/ver_programacion_final?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-history" style="color: blue;"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if ($lista['estatus'] == 2 || $lista['estatus'] == 4): ?>
                                                <a title="Notificar Modificación al SNC"
                                                    onclick="enviarreprogramacion(<?php echo $lista['id_programacion']; ?>);"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-upload" style="color: green;"></i>
                                                </a>
                                                <?php if ($lista['modificado'] != 0) : ?>
                                                    <a href="<?php echo base_url(); ?>index.php/programacion/modificacion_ley?id=<?php echo $lista['id_programacion']; ?>"
                                                        class="button">
                                                        <i class="fas fa-lg fa-cloud-download-alt"
                                                            title="Descargar certificado de cumplimiento ART.38 N2"
                                                            style="color: blue;"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/js/programacion.js"></script>
<script src="<?= base_url() ?>/js/programacion/enviar.js"></script>
<script>
    function iniciarReprogramacion(id_programacion_original) {
        swal.fire({
            title: '¿Iniciar Reprogramación?',
            text: 'Se creará una NUEVA VERSIÓN de esta programación. La versión actual se marcará como histórica. ¿Deseas continuar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Sí, iniciar!'
        }).then((result) => {
            if (result.value) {
                window.location.href =
                    '<?php echo base_url(); ?>index.php/programacion/iniciar_reprogramacion_version?id=' +
                    id_programacion_original;
            }
        });
    }
</script>