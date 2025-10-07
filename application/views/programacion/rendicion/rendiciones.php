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


                    <div class="col-3">
                        <?php
                        $anio_actual = $anio_actual;
                        $mes_actual  = $mes_actual;
                        ?>
                    </div>
                    <div class="col-6 text-center mt-1">
                        <h3 class="text-center">Disponibles para Rendir</h3>
                        <table id="tabla-programaciones-anios" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Año de la Programación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_programaciones as $lista): ?>
                                    <?php
                                    $anio_programacion = $lista['anio'];
                                    $puede_rendir = false;

                                    // Regla: se puede rendir el año actual o hasta marzo del siguiente
                                    if ($anio_programacion == $anio_actual) {
                                        $puede_rendir = true;
                                    } elseif ($anio_programacion == $anio_actual - 1 && $mes_actual <= 3) {
                                        $puede_rendir = true;
                                    }
                                    ?>

                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $lista['anio'] ?></td>
                                        <td class="center">
                                            <?php if ($puede_rendir): ?>
                                                <a href="<?= base_url(); ?>index.php/programacion/consultar_item_rendir2?id=<?= $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-registered fa-lg" title="Rendir" style="color: red;"></i>
                                                </a>
                                            <?php else: ?>
                                                <i class="fas fa-ban fa-lg" title="No disponible para rendir"
                                                    style="color: gray;"></i>
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
<div class="modal fade" id="proyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notificar Rendición </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="rendir_py" name="rendir_py" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12"></div>
                        <div class="col-12">
                            <input class="form-control" type="hidden" name="id_programacion" id="id_programacion"
                                readonly>

                            <label style="color:red;">Seleccione Trimestre a Notificar (Obligatorio).leer <b
                                    style="color:red">*</b></label><i style="color: red;"
                                title="Seleccione un Trimestre." class="fas fa-question-circle"></i>

                            <select class="form-control" name="llenar_trimestre7" id="llenar_trimestre7">
                                <option value="0">Seleccione</option>
                                <option value="1">Primer Trimestre</option>
                                <option value="2">Segundo Trimestre</option>
                                <option value="3">Tercer Trimestre</option>
                                <option value="4">Cuarto Trimestre</option>



                            </select>
                        </div>


                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="my-button"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="rendi_py1" onclick="enviar();" class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url() ?>/js/programacion.js"></script>
<script src="<?= base_url() ?>/js/programacion/enviar_rendi.js"></script>