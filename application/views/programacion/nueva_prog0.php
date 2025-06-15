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
                                    <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?= $des_unidad ?>.</p>
                                    <p class="f-s-16">RIF.: <?= $rif ?> <br>
                                        Código ONAPRE: <?= $codigo_onapre ?> <br>
                                        Año: <b><?= $anio ?></b></p>
                                    <input type="hidden" id="id_programacion" name="id_programacion"
                                        value="<?= $id_programacion ?>">
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="col-12 text-center">
                            <h4 style="color:black;">Carga Plan de Compra (Versión:
                                <?= $programacion_anio['num_reprogramacion'] ?>)</h4>
                            <?php if ($programacion_anio['estatus'] == 0): ?>
                                <p class="text-danger">Estás editando una reprogramación o una nueva programación. Los
                                    cambios se guardarán en esta versión.</p>
                            <?php elseif ($programacion_anio['estatus'] == 4): ?>
                                <p class="text-info">Estás viendo una versión **HISTÓRICA** de la programación. No puedes
                                    realizar cambios aquí.</p>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <?php if ($programacion_anio['estatus'] == 0): // Solo permitir agregar si está en modo edición 
                                ?>
                                    <button type="button" class="my-button4"
                                        onclick="bienes(<?php echo $id_programacion ?>);" data-toggle="modal"
                                        data-target="#bienes">
                                        Cargar Acción Centralizada o Proyecto
                                    </button>
                                <?php endif; ?>

                                <button type="button" class="my-button4"
                                    onclick="location.href='#proyectos-registrados'">Ver Proyectos</button>


                                <button type="button" class="my-button4" onclick="location.href='#acc-registrados'">Ver
                                    Acciones Centralizadas</button>

                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-11" style="margin-left: 40px;">
                        <div class="table-responsive mt-3">
                            <div class="col-12 text-center">
                                <h4>Tablas de Totales por Partida Presupuestaria</h4>
                            </div>
                            <table id="data-tablepdfpt" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8;">
                                    <tr class="text-center">
                                        <th>Código Part. Presupuestaria</th>
                                        <th>Partida Presupuestaria</th>
                                        <th>Total Sin iva</th>
                                        <th>Total con iva</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($totalespartida as $totalespartida): ?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td><?= $totalespartida['codigopartida_presupuestaria'] ?></td>
                                            <td><?= $totalespartida['desc_partida_presupuestaria'] ?></td>
                                            <td><?= number_format($totalespartida['precio_total'], 2, ',', '.') ?></td>
                                            <td><?= number_format($totalespartida['monto_estimado'], 2, ',', '.') ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 id="proyectos-registrados" class="text-center">Tabla Referente a Proyectos Registrados</h3>
                        <table id="data-table-default" class="table table-striped">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Nº</th>
                                    <th>Nombre Proyecto</th>
                                    <th>Objeto de Contratación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_proyectos as $ver_proyecto): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $ver_proyecto['id_p_proyecto'] ?> </td>
                                        <td><?= $ver_proyecto['nombre_proyecto'] ?> </td>
                                        <td><?= $ver_proyecto['desc_objeto_contrata'] ?> </td>
                                        <td class="center">
                                            <a href="<?php echo base_url(); ?>index.php/programacion/ver_programacion_proy?id=<?php echo $ver_proyecto['id_p_proyecto']; ?>/<?php echo $ver_proyecto['id_programacion']; ?>/<?php echo $ver_proyecto['id_obj_comercial']; ?>"
                                                class="button">
                                                <i class="fas fa-lg fa-fw fa-eye" style="color: green;"
                                                    title="Ver Informaciòn Cargada"></i>
                                            </a>
                                            <?php if ($programacion_anio['estatus'] == 0): // Solo permitir editar/eliminar si está en modo edición 
                                            ?>
                                                <a href="<?php echo base_url(); ?>index.php/programacion/agregar_items_proyecto?id=<?php echo $ver_proyecto['id_p_proyecto']; ?>/<?php echo $ver_proyecto['id_obj_comercial']; ?>/<?php echo $ver_proyecto['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-edit" title="Cargar/Modificar Información">
                                                    </i>
                                                </a>
                                                <a onclick="eliminar_proy_logico(<?php echo $ver_proyecto['id_p_proyecto']; ?>);"
                                                    class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"
                                                        title="Eliminar Proyecto"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <h3 id="acc-registrados" class="text-center">Tabla Referente a Acción Centralizada Registradas
                        </h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Nº</th>
                                    <th>Acción Centralizada</th>
                                    <th>Objeto de Contratación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_acc_centralizada as $ver_acc_centralizad): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $ver_acc_centralizad['id_p_acc_centralizada'] ?> </td>
                                        <td><?= $ver_acc_centralizad['desc_accion_centralizada'] ?> </td>
                                        <td><?= $ver_acc_centralizad['desc_objeto_contrata'] ?> </td>
                                        <td class="center">
                                            <a href="<?php echo base_url(); ?>index.php/programacion/ver_programacion_acc?id=<?php echo $ver_acc_centralizad['id_p_acc_centralizada']; ?>/<?php echo $ver_acc_centralizad['id_programacion']; ?>/<?php echo $ver_acc_centralizad['id_obj_comercial']; ?>"
                                                class="button">
                                                <i class="fas fa-lg fa-fw fa-eye" style="color: green;"
                                                    title="Ver Informaciòn Cargada"></i>
                                            </a>
                                            <?php if ($programacion_anio['estatus'] == 0): // Solo permitir editar/eliminar si está en modo edición 
                                            ?>
                                                <a href="<?php echo base_url(); ?>index.php/programacion/agregar_items_accioncentralizada_bienes?id=<?php echo $ver_acc_centralizad['id_p_acc_centralizada']; ?>/<?php echo $ver_acc_centralizad['id_obj_comercial']; ?>/<?php echo $ver_acc_centralizad['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw  fa-edit"
                                                        title="Cargar/Modificar Informaciòn"></i>
                                                </a>
                                                <a onclick="eliminar_acc_logico(<?php echo $ver_acc_centralizad['id_p_acc_centralizada']; ?>);"
                                                    class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"
                                                        title="Eliminar Acciòn Centralizada"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <?php if ($programacion_anio['estatus'] == 0): // Solo mostrar botón de finalizar si está en modo edición 
                        ?>
                            <button type="button" class="my-button3"
                                onclick="finalizarProgramacion(<?= $id_programacion ?>);" name="button">
                                Finalizar y Guardar Reprogramación
                            </button>
                        <?php endif; ?>
                        <button onclick="location.href='<?php echo base_url() ?>index.php/programacion/reprogramar'"
                            type="button" class="my-button3" name="button">
                            Volver al Historial de Programaciones
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function valideKey(evt) {
        var code = (evt.which) ? evt.which : evt.keyCode;
        if (code == 8) {
            return true;
        } else if (code >= 48 && code <= 57) {
            return true;
        } else {
            return false;
        }
    }

    // Funciones JS para eliminar (actualizar a delete_logico)
    // Asegúrate de que eliminar.js y accopy.js llamen a los nuevos métodos
    function eliminar_proy_logico(id_p_proyecto) {
        swal.fire({
            title: '¿Eliminar Proyecto?',
            text: '¿Está seguro de eliminar este proyecto? Se registrará como inactivo.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Sí, eliminar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/programacion/delete_proyecto_logico/' +
                        id_p_proyecto,
                    method: 'POST',
                    success: function(response) {
                        if (response == 1) { // Asumo que el controlador retorna 1 en éxito
                            swal.fire({
                                title: 'Eliminado Lógicamente',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal.fire('Error', 'No se pudo eliminar el proyecto.', 'error');
                        }
                    }
                });
            }
        });
    }

    function eliminar_acc_logico(id_p_acc_centralizada) {
        swal.fire({
            title: '¿Eliminar Acción Centralizada?',
            text: '¿Está seguro de eliminar esta acción centralizada? Se registrará como inactivo.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Sí, eliminar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/programacion/delete_acc_centralizada_logico/' +
                        id_p_acc_centralizada,
                    method: 'POST',
                    success: function(response) {
                        if (response == 1) {
                            swal.fire({
                                title: 'Eliminado Lógicamente',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal.fire('Error', 'No se pudo eliminar la acción centralizada.', 'error');
                        }
                    }
                });
            }
        });
    }


    function finalizarProgramacion(id_programacion) {
        swal.fire({
            title: '¿Finalizar Reprogramación?',
            text: '¡Atención! Al finalizar, esta versión de la programación se marcará como activa y no podrá ser modificada directamente. ¿Desea continuar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Sí, Finalizar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/programacion/finalizar_programacion_version',
                    method: 'POST',
                    data: {
                        id_programacion: id_programacion
                    },
                    dataType: 'json', // Esperar JSON como respuesta
                    success: function(response) {
                        if (response == 1) { // Asumo que el controlador retorna 1 en éxito
                            swal.fire({
                                title: 'Reprogramación Finalizada',
                                text: 'La programación ha sido marcada como activa.',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                window.location.href =
                                    '<?php echo base_url(); ?>index.php/programacion/reprogramar'; // Redirigir al historial
                            });
                        } else {
                            swal.fire('Error', 'Hubo un error al finalizar la reprogramación.',
                                'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        swal.fire('Error', 'Error de comunicación con el servidor al finalizar.',
                            'error');
                    }
                });
            }
        });
    }
</script>
<script src="<?= base_url() ?>/js/eliminar.js"></script>
<script src="<?= base_url() ?>/js/programacion/accopy.js"></script>