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
                                    <p class="f-s-18 text-inverse f-w-600"> <?=$descripcion?>.</p>
                                    <p class="f-s-16">RIF.: <?=$rif?> <br>


                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center">  Llamado a Concurso</h3>
                        <table id="data-table-default" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Número de Proceso</th>
                                    <th>Denominación del Proceso</th>
                                    <th> Fecha de Llamado</th>
                                    <th> Fecha de dispo</th>
                                    <th> Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($llamados as $ver):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$ver['numero_proceso']?> </td>
                                    <td><?=$ver['denominacion_proceso']?> </td>
                                    <td><?=$ver['fecha_tope']?> </td>
                                    <td><?=$ver['fecha_disponible_llamado']?> </td>

                                    <td><?=$ver['estatus']?> </td>


                                    <td class="center">
                                        <?php if  ( $ver['id_llcestatus']==1) : ?>
                                            <a href="<?php echo base_url();?>index.php/Publicaciones/Accion2?id=<?php echo $ver['numero_proceso'];?>"
                                                class="button"> 
                                                <i class="far fa-2x fa-handshake" style="color: #900C3F;"
                                                    title="Resultado del llamado "></i>
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

<script src="<?=base_url()?>/js/publicaciones/suspender.js"></script>
<script src="<?=base_url()?>/js/publicaciones/termina.js"></script>
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