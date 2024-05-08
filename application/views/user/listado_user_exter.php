<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">
                    <form id="reg_bien" method="POST" class="form-horizontal">
                        <div class="row">
                            <div class="col-12 card card-outline-danger text-center bg-white">
                                <h4 class="mt-2"> <b><?= $descripcion ?></b></h4>
                                <h5>RIF.: <?= $rif ?></h5>
                                <h5>Fecha.: <?= $time ?> </h5>
                            </div>
                            <div class="col-9"></div>


                            <div class="col-md-12">
                                <div class="panel-body">
                                    <div class="col-12 text-center">
                                        <h4>Lista de Usuarios Externos</h4>
                                    </div>

                                    <table id="data-table-default" data-order='[[ 0, "desc" ]]'
                                        class="table table-bordered table-hover">
                                        <thead style="background:#01cdb2">
                                            <tr>

                                                <th width="15%" style="color:white;">Usuario</th>
                                                <th width="25%" style="color:white;">Organo/Ente</th>
                                                <th width="25%" style="color:white;">Perfil</th>
                                                <th width="20%" style="color:white;">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ver_usuarios as $lista) : ?>
                                            <tr class="odd gradeX">

                                                <td><?= $lista['nombre'] ?></td>
                                                <td><?= $lista['descripcion'] ?></td>
                                                <td><?= $lista['nombrep'] ?></td>
                                                <td>
                                                    <a class="button"
                                                        href="<?php echo base_url() ?>index.php/User/verUsuario?id=<?php echo $lista['id'];?>">
                                                        <i title="Ver Usuario" class="fas fa-lg fa-fw fa-eye"
                                                            style="color: midnightblue;"></i>
                                                        <a />
                                                        <a onclick="modal(<?php echo $lista['id'] ?>);"
                                                            data-toggle="modal" data-target="#myModal_bienes"
                                                            style="color: white">
                                                            <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                                                style="color: darkgreen;"></i>
                                                        </a>


                                                        <?php //if ($lista['id_status'] != 2) : ?>

                                                        <?php //endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="myModal_bienes" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modificar </h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <input type="hidden" class="form-control" name="id" id="id">
                    <div class="form-group col-6">
                        <label>Nombre Funcionario</label>
                        <input class="form-control" type="text" name="nombrefun" id="nombrefun" readonly>

                    </div>
                    <div class="form-group col-6">
                        <label>Apellido</label>
                        <input id="apellido" name="apellido" class="form-control" class="form-control" maxlength="100">
                    </div>


                    <div class="form-group col-3">
                        <label>Perfil</label>
                        <input type="hidden" class="form-control" name="id_perfil" id="id_perfil" readonly>
                        <input type="text" class="form-control" name="nombrep" id="nombrep" readonly>

                    </div>
                    <div class="form-group col-3">
                        <label> Cambiar Perfil<i title="Si quiere cambiar el perfil seleccionar"
                                class="fas fa-question-circle"></i></label>
                        <select class="form-control" name="cambio_perf" id="cambio_perf">
                            <option value="0">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label>Organo/ente/ente adscrito/unid ejecutora local</label>
                        <input type="hidden" class="form-control" name="rif_organoente1" id="rif_organoente1" readonly>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" readonly>
                        <input type="hidden" class="form-control" name="unidad1" id="unidad1" readonly>

                    </div>
                    
                    <div class="form-group col-12">
                        <label> Cambiar Organo/ente/ente adscrito/unid ejecutora local<i
                                title="Si quiere cambiar el Organo/ente/ente adscrito/unid ejecutora local seleccionar"
                                class="fas fa-question-circle"></i></label>
                                <select style="width: 100%;" onclick="getSelectedRif();" id="camb_org" name="camb_org"
                             class="form-control" data-show-subtext="true" data-live-search="true">
                            <option value="1">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <input  class="form-control" type="hidden" id="code1" name="code1" readonly>
                        <input  class="form-control" type="hidden" id="rif1" name="rif1" readonly>

                    </div>  
                    <div class="form-group col-6">
                        <label>Cedula de identidad</label>
                        <input id="cedula" name="cedula" class="form-control" class="form-control" maxlength="8">
                    </div>
                    <div class="form-group col-6">
                        <label>cargo</label>
                        <input id="cargo" name="cargo" class="form-control" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group col-6">
                    <label>Correo Electronico</label>
                    <input type="email" class="form-control" name="email" id="email" onblur="return validateEmail()" >
                            <p id="errorMsgc"></p>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="my-button" id="btn_guar_2" onclick="save_modif_user();"
                        data-dismiss="modal">Guardar</button>
                    <button type="button" class="my-button" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>/js/usuario/editar_p.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $("#camb_org").select2({
            dropdownParent: $("#myModal_bienes")
        });
    });
    </script>