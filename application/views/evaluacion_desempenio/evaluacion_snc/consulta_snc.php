<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="col-12">
                    <br>
                    <h3 class="text-center">Evaluaciones Registradas Pendientes Por Notificar</h3>
                    <table id="data-table-default" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Fecha Reg. Evaluación</th>
                                <th>Rif contratista</th>
                                <th>Denominación Razón Social</th>
                                <th>Calificación</th>

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rif_organoente == "G200024518") : ?>
                            <?php foreach($reportes as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id']?> </td>
                                <td><?=$data['fecha']?> </td>
                                <td><?=$data['rif_contrat']?> </td>
                                <td><?=$data['nombre']?> </td>
                                <td><?=$data['calificacion']?></td>

                                <td class="center">
                                    <a title="Visualizar e Imprimir la Evaluación de Desempeño"
                                        href="<?php echo base_url();?>index.php/Evaluacion_desempenio/ver_evaluacion?id=<?php echo $data['id'];?>"
                                        class="button">
                                        <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                        <a />
                                        <a class="button">
                                            <i title="Notificación" onclick="modal(<?php echo $data['id']?>);"
                                                data-toggle="modal" data-target="#exampleModal"
                                                class="fas fas fa-lg fa-fw fa-align-justify" style="color: red;"></i>
                                            <a />
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php else: ?>


                            <?php foreach($reportes_user as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id']?> </td>
                                <td><?=$data['fecha']?> </td>
                                <td><?=$data['rif_contrat']?> </td>
                                <td><?=$data['nombre']?> </td>
                                <td><?=$data['calificacion']?></td>
                                <td><?=$data['descripcion']?></td>
                                <td class="center">
                                    <a title="Visualizar e Imprimir la Evaluación de Desempeño"
                                        href="<?php echo base_url();?>index.php/Evaluacion_desempenio/ver_evaluacion?id=<?php echo $data['id'];?>"
                                        class="button">
                                        <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                        <a />
                                </td>
                            </tr>
                            <?php endforeach;?>



                            <?php endif; ?>
                        </tbody>
                    </table>
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
                <h5 class="modal-title" id="exampleModalLabel">Información de Notificación al Contratista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_not_2" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-4">
                            <label>ID</label>
                            <input class="form-control" type="text" name="id" id="id" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Fecha de la Notificación <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="date" class="form-control" id="fecha_not" name="fecha_not" />
                        </div>
                        <div class="form-group col-6">
                            <label>Medio de envio de la Notificación <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class="selected form-control" name="medio" id="medio">
                                <option value="0">Seleccione</option>
                                <?php foreach ($med_not as $data): ?>
                                <option value="<?=$data['id_medio_notf']?>"><?=$data['descripcion']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>Nro. de Oficio / Fax / Correo Electronico / Otro <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" class="form-control" id="nro_oc_os" name="nro_oc_os"
                                placeholder="Nro. de Oficio / Fax / Correo Electronico / Otro" />
                        </div>
                        <div class="form-group col-6">
                                <label>Acuse de Recibido <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="file" name="fileImagen" id="fileImagen" width="300" height="300" class="form-control">
                            </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_not();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>/js/eval_desempenio/notificacion.js"></script>