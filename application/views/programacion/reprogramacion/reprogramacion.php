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
                                    <p class="f-s-16 text-inverse f-w-600">
                                        Nombre Órgano / Ente: <?= $des_unidad ?>.
                                    </p>
                                    <p class="f-s-14">
                                        RIF.: <?= $rif ?> <br>
                                        Código ONAPRE: <?= $codigo_onapre ?>
                                    </p>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 text-center mt-4">
                        <h3 class="text-center">
                            Disponibles para "Modificación de la Programación Anual correspondiente al Ejercicio Fiscal,
                            conforme al Artículo 38 numeral 2 del DCRVFLCP"
                        </h3>

                        <table id="tabla-programaciones-anios" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Período de Programación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Cargamos el modelo dentro de la vista
                                $CI = &get_instance();
                                $CI->load->model('Programacion_model');

                                foreach ($ver_programaciones as $lista):
                                    $anio_programacion = (int)$lista['anio'];
                                    $anio_actual = (int)$anio_actual;
                                    $mes_actual  = (int)$mes_actual;
                                    $es_modificable = false;

                                    // Regla natural:
                                    // - Año actual ✅
                                    // - Año siguiente ✅
                                    // - Año anterior solo hasta marzo ✅
                                    if ($anio_programacion == $anio_actual) {
                                        $es_modificable = true;
                                    } elseif ($anio_programacion == $anio_actual + 1) {
                                        $es_modificable = true;
                                    } elseif ($anio_programacion == $anio_actual - 1 && $mes_actual <= 3) {
                                        $es_modificable = true;
                                    }

                                    // Si no cumple la regla, verificamos si hay una excepción por RIF
                                    if (!$es_modificable) {
                                        if ($CI->Programacion_model->tiene_excepcion_rendicion($rif, $anio_programacion)) {
                                            $es_modificable = true;
                                            $por_excepcion = true;
                                        } else {
                                            $por_excepcion = false;
                                        }
                                    } else {
                                        $por_excepcion = false;
                                    }
                                ?>
                                    <tr class="text-center">
                                        <td><?= $lista['anio'] ?></td>
                                        <td>
                                            <?php if ($es_modificable): ?>
                                                <a href="<?= base_url(); ?>index.php/programacion/consultar_item_reprogramacion?id=<?= $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-edit"
                                                        title="Modificar programación (Art.38 N°2 DCRVFLCP)"></i>
                                                </a>

                                                <a title="Notificar modificación al SNC"
                                                    onclick="enviarreprogramacion(<?= $lista['id_programacion']; ?>);"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-upload" style="color: green;"></i>
                                                </a>

                                                <?php if ($lista['modificado'] != 0): ?>
                                                    <a href="<?= base_url(); ?>index.php/programacion/modificacion_ley?id=<?= $lista['id_programacion']; ?>"
                                                        class="button">
                                                        <i class="fas fa-lg fa-cloud-download-alt"
                                                            title="Descargar certificado de cumplimiento (Art.38 N°2)"
                                                            style="color: blue;"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if ($por_excepcion): ?>
                                                    <i class="fas fa-info-circle" style="color:orange;"
                                                        title="Habilitado por excepción administrativa"></i>
                                                <?php endif; ?>

                                            <?php else: ?>
                                                <i class="fas fa-lg fa-fw fa-lock" style="color: grey;"
                                                    title="Fuera del periodo de modificación."></i>
                                                <span style="display:inline-block;width:34px;"></span>

                                                <?php if ($anio_programacion < $anio_actual && $mes_actual > 3 && $lista['modificado'] != 0): ?>
                                                    <a href="<?= base_url(); ?>index.php/programacion/modificacion_ley?id=<?= $lista['id_programacion']; ?>"
                                                        class="button">
                                                        <i class="fas fa-lg fa-cloud-download-alt"
                                                            title="Descargar certificado (Art.38 N°2)" style="color: blue;"></i>
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

<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url() ?>/js/programacion.js"></script>
<script src="<?= base_url() ?>/js/programacion/enviar.js"></script>