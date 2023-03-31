<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-1 mb-3">
            <a class="btn btn-circle waves-effect  waves-circle waves-float btn-primary"
                href="javascript:history.back()"> Volver</a>
        </div>
        <div class="col-1 mb-3">
            <button class="btn btn-circle waves-effect waves-circle waves-float btn-primary" type="submit"
                onclick="printDiv('areaImprimir');" name="action">Imprimir</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <img style="width: 100%" height="100%"
                                        src=" <?= base_url() ?>Plantilla/img/loij.png" alt="Card image">
                                    <br><br>
                                    <p class="f-s-18 text-inverse f-w-600"> <?=$descripcion?>.</p>
                                    <p class="f-s-16">RIF.: <?=$rif?> <br>

                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center">Estatus de Certificaciones </h3>
                        <table id="data-table-default" data-order='[[ 2, "desc" ]]'
                            class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Razon Social</th>
                                    <th>Rif</th>
                                    <th>Estatus </th>
                                    <th>Fecha Solicitud</th>
                                    <th>Tipo </th>
                                    <th>QR </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_certi as $datos):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$datos['nombre']?> </td>
                                    <td><?=$datos['rif_cont']?> </td>
                                    <?php if   (($datos['status'] == 1 )  ): ?>
                                    <td style="color:red;">Pendiente Revisión </td>
                                    <?php elseif   ( $datos['status'] == 2 ): ?>
                                    <td>Aprobado</td>

                                    <?php else: ?>
                                    <td style="color:red;">Rechazado</td>
                                    <?php endif; ?>


                                    <td><?=date("d/m/Y", strtotime($datos['fecha_solic']));?> </td>

                                    <?php if (($datos['tipo_pers'] < 2) ) : ?>
                                    <td>Juridico </td>
                                    <?php endif; ?>
                                    <?php if (($datos['tipo_pers'] > 1) ) : ?>
                                    <td>Persona Nat. </td>
                                    <?php endif; ?>

                                    <td><?=$datos['qrcode_data']?> </td>

                                    <td class="center">
                                        <a href="<?php echo base_url();?>index.php/Certificacion/ver_certifi?id=<?php echo $datos['rif_cont'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                            <a />
                                            <?php if (($datos['status'] == 2) ) : ?>
                                            <a href="<?php echo base_url();?>index.php/Certificacion/verpdf?id=<?php echo $datos['id'];?>"
                                                class="button">
                                                <i class='fas fa-align-justify'> </i>
                                                <a />
                                                <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
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
<script type="text/javascript">
function printDiv(nombreDiv) {
    var contenido = document.getElementById('imp1').innerHTML;
    var contenidoOriginal = document.body.innerHTML;
    document.body.innerHTML = contenido;
    window.print();
    document.body.innerHTML = contenidoOriginal;
}
</script>