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
                        <h3 class="text-center">Programaciones Anuales Finalizadas para Reprogramación (Art. 38, Numeral
                            2 DCRVFLCP)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Período de Programación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_programaciones as $lista): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $lista['anio'] ?> </td>
                                        <td>
                                            <?php if ($lista['estatus'] == 2 && empty($lista['id_siguiente_version'])): ?>
                                                <span class="label label-success">Activa (Vigente)</span>
                                            <?php elseif ($lista['estatus'] == 4): ?>
                                                <span class="label label-warning">Histórica (Reemplazada)</span>
                                            <?php else: ?>
                                                <span class="label label-info">En Creación/Reprogramación</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="center">
                                            <?php if ($lista['estatus'] == 2): // Solo si la programación está finalizada y es la versión activa 
                                            ?>
                                                <a href="javascript:void(0);"
                                                    onclick="iniciarReprogramacion(<?= $lista['id_programacion'] ?>);"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-edit"
                                                        title="Iniciar Reprogramación (creará una nueva versión)"></i>
                                                </a>
                                                <a title="Ver detalles de esta Programación"
                                                    href="<?php echo base_url(); ?>index.php/programacion/ver_programacion_final?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-eye" style="color: grey;"></i>
                                                </a>
                                            <?php elseif ($lista['estatus'] == 0): ?>
                                                <a href="<?php echo base_url(); ?>index.php/programacion/nueva_prog?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-pencil-alt" title="Continuar Edición"></i>
                                                </a>
                                            <?php elseif ($lista['estatus'] == 4): // Si es histórica, solo ver detalles 
                                            ?>
                                                <a title="Ver detalles de esta Versión Histórica"
                                                    href="<?php echo base_url(); ?>index.php/programacion/ver_programacion_final?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-history" style="color: blue;"></i>
                                                </a>
                                            <?php endif; ?>

                                            <a title="Notificar Modificación al SNC"
                                                onclick="enviarreprogramacion(<?php echo $lista['id_programacion']; ?>);"
                                                class="button">
                                                <i class="fas fa-lg fa-fw fa-upload" style="color: green;"></i>
                                            </a>
                                            <?php if ($lista['modificado'] != 0) : ?>
                                                <a href="<?php echo base_url(); ?>index.php/programacion/modificacion_ley?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-cloud-download-alt"
                                                        title="Descarga certificado de cumplimiento ART.38 N2"
                                                        style="color: blue;"></i>
                                                </a>
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
            text: 'Se creará una nueva versión de esta programación. Los cambios que realices no afectarán la versión original hasta que finalices esta reprogramación.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Sí, iniciar!'
        }).then((result) => {
            if (result.value) {
                // Redirigir al controlador que duplica la programación
                window.location.href = '<?php echo base_url(); ?>index.php/programacion/duplicar_programacion?id=' +
                    id_programacion_original;
            }
        });
    }
</script>