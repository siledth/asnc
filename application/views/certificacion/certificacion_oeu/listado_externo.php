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
                                    <p class="f-s-18 text-inverse f-w-600"> <?= $descripcion ?>.</p>
                                    <p class="f-s-16">Fecha: <?= $time ?> <br>
                                </blockquote>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 text-center">

                        <div class="row">


                            <?php if (isset(($ver['user_soli']))) {

                                if ($ver['tipo_pers'] == 2) { ?>
                                    <div class="col-4">
                                        <button
                                            onclick="location.href='<?php echo base_url() ?>index.php/Certificacion/registrar2'"
                                            type="button" class="btn btn-lg btn-default" name="button">
                                            Registrar Certificación PJ
                                        </button>
                                    </div>
                                <?php     }
                                if ($ver['tipo_pers'] == 1) { ?>
                                    <div class="col-4">
                                        <button onclick="location.href='<?php echo base_url() ?>index.php/Certificacion/reg_pn'"
                                            type="button" class="btn btn-lg btn-default" name="button">
                                            Registrar Certificación PN
                                        </button>
                                    </div>

                                <?php
                                }
                            } else {  ?>

                                <div class="col-4">
                                    <button
                                        onclick="location.href='<?php echo base_url() ?>index.php/Certificacion/registrar2'"
                                        type="button" class="btn btn-lg btn-default" name="button">
                                        Registrar Certificación PJ

                                    </button>
                                </div>
                                <div class="col-4">
                                    <button onclick="location.href='<?php echo base_url() ?>index.php/Certificacion/reg_pn'"
                                        type="button" class="btn btn-lg btn-default" name="button">
                                        Registrar Certificación PN
                                    </button>
                                </div>
                            <?php }

                            ?>

                        </div>

                    </div>

                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center">Estatus de solicitud de Certificaciones </h3>
                        <table id="data-table-default" data-order='[[ 3, "asc" ]]'
                            class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Razon Social</th>
                                    <th>Rif</th>
                                    <th>Estatus </th>
                                    <th>Fecha Solicitud</th>
                                    <th>Tipo </th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_certi as $datos): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $datos['nombre'] ?> </td>
                                        <td><?= $datos['rif_cont'] ?> </td>
                                        <?php if (($datos['status'] == 1)): ?>
                                            <td style="color:red;">Pendiente Revisión </td>
                                        <?php elseif ($datos['status'] == 2): ?>
                                            <td>Aprobado</td>

                                        <?php else: ?>
                                            <td style="color:red;">Rechazado</td>
                                        <?php endif; ?>
                                        <td><?= date("d/m/Y", strtotime($datos['fecha_solic'])); ?> </td>

                                        <?php if (($datos['tipo_pers'] < 2)) : ?>
                                            <td>Juridico </td>
                                        <?php endif; ?>
                                        <?php if (($datos['tipo_pers'] > 1)) : ?>
                                            <td>Persona Nat. </td>
                                        <?php endif; ?>
                                        <td class="center">
                                            <a href="<?php echo base_url(); ?>index.php/Certificacion/ver_ficha_tecnica?id=<?php echo $datos['id']; ?>"
                                                class="button">
                                                <i class="fas fa-lg fa-fw fa-eye" style="color: green;"> </i>
                                                <a />
                                                <?php if ($datos['status'] == 3) : ?>
                                                    <a onclick="modal(<?php echo $datos['id'] ?>);" data-toggle="modal"
                                                        data-target="#exampleModal" style="color: white">
                                                        <i title="Pagar" class="fas fa-lg fa-fw fa-donate"
                                                            style="color: darkgreen;"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (($datos['vigen_cert_hasta'] > $time) && $datos['status'] > 1) : ?>
                                                    <a href="<?php echo base_url(); ?>index.php/Certificacion/verpdf?id=<?php echo $datos['id']; ?>"
                                                        class="button">
                                                        <i class='fas fas fa-lg fa-fw fa-align-justify'></i>
                                                        <a />
                                                    <?php elseif (($datos['tipo_pers'] == 1) && ($datos['status'] == 2)) : ?>

                                                        <!-- <a href="<?php echo base_url(); ?>index.php/Certificacion/renovar_certificacion1?id=<?php echo $datos['rif_cont']; ?>"
                                                            class="button">
                                                            <i class="fas fa-lg fa-fw  fa-edit" style="color: red;"><br><br>
                                                                Renovar</i>
                                                            <a /> -->
                                                    <?php elseif (($datos['tipo_pers'] == 2) && ($datos['status'] == 2)) : ?>

                                                        <a href="<?php echo base_url(); ?>index.php/Certificacion/renovar_certificacion_pn?id=<?php echo $datos['rif_cont']; ?>"
                                                            class="button">
                                                            <i class="fas fa-lg fa-fw  fa-edit" style="color: red;"><br><br>
                                                                Renovar pn</i>
                                                            <a />
                                                        <?php endif; ?>
                                                        <?php if (($datos['tipo_pers'] == 1) && $datos['status'] == 1) : ?>
                                                            <!-- <a href="<?php echo base_url(); ?>index.php/Certificacion/editar_certificacion?id=<?php echo $datos['rif_cont']; ?>"
                                                                class="button">
                                                                <i class="fas fa-lg fa-fw  fa-edit"></i>
                                                                <a /> -->

                                                            <a href="<?php echo base_url(); ?>index.php/Certificacion/miemb2?id=<?php echo $datos['id']; ?>"
                                                                class="button">
                                                                <i title="Agregar Facilitadores"
                                                                    class="fas fa-2x fa-fw fa-clipboard-list"
                                                                    style="color: red;"></i>
                                                                <a />
                                                            <?php elseif (($datos['tipo_pers'] == 2) && $datos['status'] == 1): ?>


                                                                <a href="<?php echo base_url(); ?>index.php/Certificacion/editar_certificacion_pn?id=<?php echo $datos['rif_cont']; ?>"
                                                                    class="button">
                                                                    <i class="fas fa-lg fa-fw  fa-edit"></i>
                                                                    <a />


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

                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                            href="javascript:history.back()"> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/js/certificacion/pago.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_pago_2_" name="guardar_pago_2_" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">



                        <div class="col-10"></div>

                        <div class="form-group col-4">
                            <label>Rif-Cedula</label>
                            <input class="form-control" type="text" name="rif_cont" id="rif_cont" readonly>
                            <input class="form-control" type="hidden" name="id" id="id" readonly>
                        </div>

                        <div class="form-group col-3">
                            <label>Cantidad a pagar </label>
                            <input class="form-control" type="text" id="total_bss" name="total_bss" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Cantidad cancelado</label>
                            <input class="form-control" type="text" id="pago2" name="pago2"
                                onkeypress="return valideKey(event);">
                        </div>
                        <div class="col-4">
                            <label>Banco Emisor</label>
                            <select style="width: 100%;" name="banco_e2" id="banco_e2" class="form-control ">
                                <option value="">SELECCIONE</option>
                                <?php foreach ($bancos as $data): ?>
                                    <option value="<?= $data['nombre_b'] ?>">
                                        <?= $data['nombre_b'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label>Banco Receptor</label>
                            <input class="form-control" type="text" id="banco_rec_2" name="banco_rec_2"
                                value="Banco de Venezuela" readonly>
                        </div>
                        <div class="col-4">
                            <label>Número de referencia:</label>
                            <input class="form-control" type="text" name="nro_referencia2" id="nro_referencia2">
                        </div>
                        <div class="col-4">
                            <label>Fecha de Tranferencia:</label>
                            <input class="form-control" type="date" name="fechatrnas2" id="fechatrnas2">
                        </div>

                    </div>

                    <div class="form-group col-3">
                        <label>Motivo</label>
                        <textarea name="motivo_pago_2" id="motivo_pago_2" rows="5" cols="100"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_pago_2();" class="btn btn-primary">Guardar</button>
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
    $("#pago2").on({
        "focus": function(event) {
            $(event.target).select();
        },
        "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });
</script>