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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suspender un llamado a concurso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_proc_suspencion" name="guardar_proc_suspencion" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <?php foreach($causa_suspencion as $causa_suspencion):?><?php endforeach;?>
                        <div class="col-12  form-group">
                            <div class="form-group col-10">
                                <label>Marco Legal</label>
                                <textarea class="form-control" name="causa_prorroga" id="causa_prorroga" rows="10"
                                    cols="50" readonly>  <?=$causa_suspencion['descripcion']?></textarea>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                        </div>
                        <div class="form-group col-8">
                            <label>N° Proceso <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="numero_proceso" id="numero_proceso" class="form-control" readonly>
                        </div>
                        <div class="col-4">
                            <label>Fecha de Suspención </label>
                            <input class="form-control" type="text" name="fechapago" id="fechapago" value="<?=$time?>"
                                readonly>

                        </div>
                        <div class="col-6">
                            <label>Artículo 123 Procedencia de la suspensión
                                Las causales para la, suspensión de los procedimientos de selección de contratista
                                previstos en la
                                Ley de Contrataciones Públicas, son: </label>
                            <select class="form-control" name="supuesto" id="supuesto" onclick="llenar_pago();">
                                <option value="0">Seleccione</option>
                                <?php foreach ($supuestos as $data) : ?>
                                <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" id='campos' style="display: none;">
                    <div class="form-group col-3">
                        <label>Ingrese una Observación sobre la Suspención</label>
                        <textarea name="especifique_anulacion" id="especifique_anulacion" rows="5" cols="100"></textarea>
                    </div>
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_" onclick="guardar_suspencion();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Terminar un llamado a concurso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_terminacion" name="guardar_terminacion" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <?php foreach($terminar_manual as $terminar_manual):?><?php endforeach;?>
                        <div class="col-12  form-group">
                            <div class="form-group col-10">
                                <label>Marco Legal</label>
                                <textarea class="form-control" name="causa_termino" id="causa_termino" rows="5"
                                    cols="50" readonly>  <?=$terminar_manual['descripcion']?></textarea>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                        </div>
                        <div class="form-group col-8">
                            <label>N° Proceso <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="numero_proceso2" id="numero_proceso2" class="form-control" readonly>
                        </div>
                        <div class="col-4">
                            <label>Fecha de  Termino </label>
                            <input class="form-control" type="text" name="fechapago" id="fechapago" value="<?=$time?>"
                                readonly>

                        </div>
                        <div class="form-group col-3">
                        <label>Ingrese una Observación sobre Terminación Manual</label>
                        <textarea name="especifique_anulacion2" id="especifique_anulacion2" rows="5" cols="100"></textarea>
                    </div>
                    </div>
                   
                    

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_" onclick="guardar_ter();"
                    class="btn btn-primary">Guardar</button>
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