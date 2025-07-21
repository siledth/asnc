<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-12 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <p class="f-s-18 text-inverse f-w-600"> <?= $descripcion ?>.</p>
                                    <p class="f-s-16">RIF.: <?= $rif ?> <br>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="row">
                            <div class="col-4">
                                <button
                                    onclick="location.href='<?php echo base_url() ?>index.php/Certificacion/registrar'"
                                    type="button" class="btn btn-lg btn-default" name="button">
                                    Registrar Certificación PJ
                                </button>
                            </div>

                            <div class="col-4">
                                <button
                                    onclick="location.href='<?php echo base_url() ?>index.php/Certificacion/registrar_pn'"
                                    type="button" class="btn btn-lg btn-default" name="button">
                                    Registrar Certificación PN
                                </button>
                            </div>
                        </div>

                        <br>

                    </div>

                    <div class="col-1"></div>
                    <div class="col-12 mt-3">
                        <h3 class="text-center">Registro de Certificaciones en espera de Revisión </h3>
                        <table id="data-table-default" data-order='[[ 3, "asc" ]]'
                            class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Razon Social</th>
                                    <th>Rif</th>
                                    <th>Fecha Solicitud</th>
                                    <th>Tipo </th>
                                    <th>Estatus </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_certi as $datos): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <?php if (($datos['fecha_ven_solici'] == $time)) : ?>
                                            <td style="color:red;"><?= $datos['nombre'] ?> </td>
                                            <td style="color:red;"><?= $datos['rif_cont'] ?> </td>
                                            <td style="color:red;"><?= date("d/m/Y", strtotime($datos['fecha_solic'])); ?> </td>
                                            <?php if (($datos['tipo_pers'] < 2)) : ?>
                                                <td style="color:red;">Juridico </td>
                                            <?php endif; ?>
                                            <?php if (($datos['tipo_pers'] > 1)) : ?>
                                                <td style="color:red;">Persona Nat. </td>
                                            <?php endif; ?>
                                            <?php if (($datos['status'] == 1)): ?>
                                                <td style="color:red;">Pendiente Revisión </td>
                                            <?php elseif ($datos['status'] == 2): ?>
                                                <td style="color:red;">Aprobado</td>

                                            <?php else: ?>
                                                <td style="color:red;">Rechazado</td>
                                            <?php endif; ?>
                                            <td class="center">
                                                <a href="<?php echo base_url(); ?>index.php/Certificacion/ver_ficha_tecnica?id=<?php echo $datos['id']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-eye" style="color: green;"> </i>
                                                    <a />
                                                    <?php if (($datos['status'] > 2)) : ?>
                                                        <a href="<?php echo base_url(); ?>index.php/Certificacion/verpdf?id=<?php echo $datos['id']; ?>"
                                                            class="button">
                                                            <i class='fas fa-align-justify'> </i>
                                                            <a />
                                                        <?php endif; ?>
                                                        <?php if (($datos['status'] == 1)) : ?>
                                                            <a href="<?php echo base_url(); ?>index.php/Certificacion/editar_certificacion?id=<?php echo $datos['rif_cont']; ?>"
                                                                class="button">
                                                                <i class="fas fa-lg fa-fw  fa-edit"></i>
                                                            <?php endif; ?>
                                                            <a />



                                            </td>
                                        <?php else: ?>
                                            <td><?= $datos['nombre'] ?> </td>
                                            <td><?= $datos['rif_cont'] ?> </td>
                                            <td><?= date("d/m/Y", strtotime($datos['fecha_solic'])); ?> </td>
                                            <?php if (($datos['tipo_pers'] < 2)) : ?>
                                                <td>Juridico </td>
                                            <?php endif; ?>
                                            <?php if (($datos['tipo_pers'] > 1)) : ?>
                                                <td>Persona Nat. </td>
                                            <?php endif; ?>
                                            <?php if (($datos['status'] == 1)): ?>
                                                <td style="color:red;">Pendiente Revisión </td>
                                            <?php elseif ($datos['status'] == 2): ?>
                                                <td>Aprobado</td>

                                            <?php else: ?>
                                                <td style="color:red;">Rechazado</td>
                                            <?php endif; ?>
                                            <td class="center">
                                                <a href="<?php echo base_url(); ?>index.php/Certificacion/ver_ficha_tecnica?id=<?php echo $datos['id']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-eye" style="color: green;"> </i>
                                                    <a />
                                                    <?php if (($datos['status'] > 2)) : ?>
                                                        <a href="<?php echo base_url(); ?>index.php/Certificacion/verpdf?id=<?php echo $datos['id']; ?>"
                                                            class="button">
                                                            <i class='fas fa-align-justify'> </i>
                                                            <a />
                                                        <?php endif; ?>
                                                        <?php if (($datos['status'] == 1)) : ?>
                                                            <a href="<?php echo base_url(); ?>index.php/Certificacion/editar_certificacion?id=<?php echo $datos['rif_cont']; ?>"
                                                                class="button">
                                                                <i class="fas fa-lg fa-fw  fa-edit"></i>
                                                            <?php endif; ?>
                                                            <a />

                                                        <?php endif; ?>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>

                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                            href="javascript:history.back()"> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function valideKey(evt) {
        var code = (evt.which) ? evt.which : evt.keyCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    }
</script>