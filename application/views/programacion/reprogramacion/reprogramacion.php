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

                    </div>
                    <div class="col-6 text-center mt-1">
                        <h3 class="text-center">Disponibles para "Modificación de la Programación Anual correspondiente
                            al Ejercicio Fiscal de conformidad a lo establecido en el Articulo 38, numeral 2 del
                            DCRVFLCP"</h3>

                        <table id="tabla-programaciones-anios" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Período de Programación Registrados</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_programaciones as $lista): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $lista['anio'] ?> </td>
                                        <td class="center">

                                            <?php
                                            // LÓGICA DE LA VENTANA DE MODIFICACIÓN:
                                            // Variables disponibles: $anio_actual y $mes_actual (desde el controlador)
                                            $anio_programacion = (int)$lista['anio'];
                                            $es_modificable = false;

                                            // 1. Siempre se puede modificar la programación del AÑO SIGUIENTE
                                            if ($anio_programacion == ($anio_actual + 1)) {
                                                $es_modificable = true;
                                            }
                                            // 2. Se puede modificar la programación del AÑO ACTUAL
                                            else if ($anio_programacion == $anio_actual) {
                                                $es_modificable = true;
                                            }
                                            // 3. Se puede modificar el AÑO ANTERIOR, PERO SOLO hasta MARZO
                                            else if ($anio_programacion == ($anio_actual - 1)) {
                                                if ($mes_actual <= 3) {
                                                    $es_modificable = true;
                                                }
                                            }

                                            // La condición para mostrar cualquier acción (editar, notificar, descargar)
                                            // es que la programación caiga en la ventana $es_modificable,
                                            // o que el año sea ANTERIOR y el sistema deba mostrar el comprobante.
                                            // Sin embargo, como confirmaste, el acceso se restringe al máximo.
                                            ?>

                                            <?php if ($es_modificable) : ?>

                                                <a href="<?php echo base_url(); ?>index.php/programacion/consultar_item_reprogramacion?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-edit"
                                                        title="Modificar Carga de Programación, Articulo 38 #2 del DCRVFLCP"></i>
                                                </a>

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

                                            <?php else: ?>
                                                <i class="fas fa-lg fa-fw fa-lock" style="color: grey;"
                                                    title="Fuera del periodo de modificación."></i>
                                                <span style="display: inline-block; width: 34px;"></span>

                                                <?php
                                                // La única excepción: si está cerrado (no es modificable) PERO ya tiene comprobante,
                                                // se debería poder descargar, ya que es un documento final. 
                                                // Si decides que NO se debe ver NADA de años anteriores cerrados, omite el siguiente IF.

                                                // Lógica: Si ya se cerró la ventana de edición, solo permitimos ver el comprobante.
                                                if ($anio_programacion < $anio_actual && $mes_actual > 3 && $lista['modificado'] != 0): ?>
                                                    <a href="<?php echo base_url(); ?>index.php/programacion/modificacion_ley?id=<?php echo $lista['id_programacion']; ?>"
                                                        class="button">
                                                        <i class="fas fa-lg fa-cloud-download-alt"
                                                            title="Descarga certificado de cumplimiento ART.38 N2"
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
<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url() ?>/js/programacion.js"></script>
<script src="<?= base_url() ?>/js/programacion/enviar.js"></script>