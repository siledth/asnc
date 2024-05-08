<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Notificación y Registro</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-6 form-group">
                                <label>Seleccione Organo/Ente <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <select id="id_unidad" name="id_unidad" class="default-select2 form-control" required>
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($final as $data):?>
                                    <option value="<?=$data['descripcion']?>/<?=$data['rif']?>">
                                        <?=$data['descripcion']?> / <?=$data['rif']?>
                                    </option>
                                    <?php endforeach;?>
                                </select>


                            </div>
                            <div class="form-group col-4">
                                <label>Fecha Notificación</label>
                                <input class="form-control" type="date" name="datent" id="datent">
                            </div>
                            <div class="form-group col-6">
                                <label>Seleccione Tipo Comisiòn <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <select class="form-control" name="tipo_com" id="tipo_com" onclick="selectipo();">
                                    <option value="0">Seleccione</option>
                                    <option value="1">Comisión Permanente</option>
                                    <option value="2">Comisión Temporal</option>

                                </select>
                                <input type="hidden" id="unidad" name="unidad" value="<?=$unidad?>" readonly>
                            </div>


                            <div class="form-group col-6" id='campos3' style="display: none;">

                                <div class="row ">
                                    <label>Indique el Objeto de la Comisión Temporal <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" onkeypress="may(this);" type="text" name="observacion"
                                        id="observacion">
                                    <input type="hidden" id="rif_organoente" name="rif_organoente"
                                        value="<?=$rif_organoente?>" readonly>

                                    <div class="form-group col-4">
                                        <label>Desde (fecha estimada)</label>
                                        <input class="form-control" type="date" name="dura_com_desde"
                                            id="dura_com_desde">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Hasta (fecha estimada)</label>
                                        <input class="form-control" type="date" name="dura_com_hasta"
                                            id="dura_com_hasta">
                                    </div>





                                </div>
                            </div>


                            <div class="form-group col-4">
                                <label>Fecha de Designación</label>
                                <input class="form-control" type="date" name="datedsg" id="datedsg">
                            </div>
                            <div class="form-group col-4">
                                <label>Acto Administrativo de Designación</label>

                                <select class="form-control" name="acto" id="acto" onclick="selectipo();">
                                    <option value="0">Seleccione</option>
                                    <option value="1">Providencia</option>
                                    <option value="2">Resoluciòn</option>
                                    <option value="3">Punto de Cuenta</option>


                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label>Número Acto</label>
                                <input class="form-control" type="text" name="nacto" id="nacto">
                            </div>
                            <div class="form-group col-4">
                                <label>Fecha Acto</label>
                                <input class="form-control" type="date" name="facto" id="facto">
                            </div>
                            <div class="form-group col-4">
                                <label>Gaceta</label>
                                <input class="form-control" type="text" name="gaceta" id="gaceta">
                            </div>
                            <div class="form-group col-4">
                                <label>Fecha Gaceta</label>
                                <input class="form-control" type="date" name="fecha_gaceta" id="fecha_gaceta">
                            </div>

                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_b();" id="guardar" name="guardar"
                            class="my-button">Guardar</button>
                    </div>
                    </from>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading"></div>
                    <div class="table-responsive">
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr>
                                    <th>Rif </th>
                                    <th>Nombre de la Comisiòn</th>
                                    <th>Fecha de Desig.</th>

                                    <th>Acto Admin.</th>
                                    <th>Número Acto</th>
                                    <th>Fecha Acto</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>

                                    <th>Estatus</th>
                                    <th>Notificado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($comisiones as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$data['rif_organoente']?> </td>
                                    <td><?=$data['observacion']?> </td>
                                    <td><?=$data['fecha_desig']?> </td>
                                    <td><?=$data['desc_acto_admin']?> </td>

                                    <td><?=$data['num_acto']?> </td>
                                    <td><?=$data['fecha_acto']?> </td>


                                    <?php if ($data['tipo_comi'] == '1') : ?>
                                    <td>Permanente</td>
                                    <td>Permanente</td>


                                    <?php else: ?>
                                    <td><?=$data['dura_com_desde']?> </td>
                                    <td><?=$data['dura_com_hasta']?> </td>
                                    <?php endif; ?>
                                    <td><?=$data['desc_status']?> </td>

                                    <td><?=$data['desc_status_snc']?> </td>


                                    <td class="center">
                                        <?php if ($data['id_status'] == 2) : ?>

                                        <?php else: ?>
                                        <?php if ($data['snc'] == 1) : ?>
                                        <a onclick="modal(<?php echo $data['id_comision'] ?>);" data-toggle="modal"
                                            data-target="#dede" style="color: white">
                                            <i title="Ingresar Miembros de Comisión"
                                                class="fas fa-2x fa-fw fa-address-card" style="color: darkblue;"></i>

                                        </a>
                                        <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb?id=<?php echo $data['id_comision'];?>"
                                            class="button">
                                            <i title="ver Integrantes" class="fas fa-2x fa-fw fa-clipboard-list"
                                                style="color: pink;"></i>
                                            <a />
                                            <a title="Notificar al SNC"
                                                onclick="enviar(<?php echo $data['id_comision'];?>);" class="button">
                                                <i class="fas fa-2x fa-fw fas ffas fa-bullhorn"
                                                    style="color: black;"></i>
                                                <a />

                                                <?php else: ?>
                                                <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb?id=<?php echo $data['id_comision'];?>"
                                                    class="button">
                                                    <i title="ver Integrantes" class="fas fa-2x fa-fw fa-clipboard-list"
                                                        style="color: pink;"></i>
                                                    <a />
                                                    <a class="button">
                                                        <i title="Editar"
                                                            onclick="modal_ver(<?php echo $data['id_comision']?>);"
                                                            data-toggle="modal" data-target="#exampleModal3"
                                                            class="fas fa-2x fa-fw fa-edit" style="color:green"></i>
                                                        <a />

                                                        <a href="<?php echo base_url();?>index.php/Not_snc/pdfrt?id=<?php echo $data['id_comision'];?>"
                                                            class="button">
                                                            <i class="fas fa-2x  fa-lg fa-cloud-download-alt"
                                                                title="Comprobante" style="color: blue;"></i>
                                                            <a />

                                                            <a title="inactivar comisión"
                                                                onclick="inactivar(<?php echo $data['id_comision'];?>);"
                                                                class="button">
                                                                <i class="fas fa-2x fa-fw  fa-ban"
                                                                    style="color: red;"></i>
                                                                <a />
                                                                <?php endif; ?>

                                                                <?php endif; ?>

                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dede" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Miembros de Comisión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag"
                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <!-- <div class="form-group col-7">
                                <label>Seleccione Tipo de Comisión <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <select style="width: 100%;" onclick="ver_obs();" id="tipo_comi" name="tipo_comi"
                                    class="form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($tp_contrata as $data) : ?>
                                    <option value="<?= $data['id_tipo_comision']?>"><?= $data['descripcion']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> -->
                            <div class="row" id='campos' style="display: none;">


                                <div class="form-group col-6">
                                    <label>Indique el Objeto de la Comisión Temporal</label>
                                    <textarea name="observacion1" id="observacion1" rows="5" cols="100"></textarea>
                                </div>
                            </div>

                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b>DATOS DEL MIEMBRO DESIGNADO</b></h5>
                                <div class="row ">
                                    <div class="form-group col-4">
                                        <label>Cédula de Identidad/ Pasaporte</label>
                                        <input class="form-control" type="text" name="cedula" id="cedula">
                                        <input class="form-control" type="hidden" name="id_comision" id="id_comision"
                                            readonly>
                                        <input class="form-control" type="hidden" name="rif_organoente2"
                                            id="rif_organoente2" readonly>


                                    </div>
                                    <div class="form-group col-4">
                                        <label>Nombres</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Apellidos</label>
                                        <input class="form-control" type="text" name="apellido" id="apellido">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Seleccione Área <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select style="width: 100%;" id="tipo_area" name="tipo_area"
                                            class="form-control" data-show-subtext="true" data-live-search="true">
                                            <option value="0">Seleccione</option>
                                            <?php foreach ($area as $data) : ?>
                                            <option value="<?= $data['id_area_miembro']?>">
                                                <?= $data['desc_area_miembro']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Seleccione Tipo Integrante <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select style="width: 100%;" id="tp_miembro" name="tp_miembro"
                                            class="form-control" data-show-subtext="true" data-live-search="true">
                                            <option value="0">Seleccione</option>
                                            <?php foreach ($tipo as $data) : ?>
                                            <option value="<?= $data['id_tp_miembro']?>"><?= $data['desc_tp_miembro']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Dirección de Correo Electrónico</label>
                                        <input class="form-control" type="text" name="correo" id="correo">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Teléfono</label>
                                        <input class="form-control" type="text" name="telf" id="telf">
                                    </div>
                                </div>

                            </div>




                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_pago_fin" onclick="save_miembros1();"
                        class="my-button">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Gaceta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-sortable-id="form-validation-1">
                    <form class="form-horizontal" id="editar" data-parsley-validate="true" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-4">

                                <input class="form-control" type="hidden" name="id" id="id" readonly>
                            </div>
                            <div class="col-8"></div>
                            <div class="form-group col-4">
                                <label>Gaceta</label>
                                <input class="form-control" type="text" onkeypress="return valideKey(event);"
                                    name="gace" id="gace">
                            </div>
                            <div class="form-group col-8">
                                <label>Fecha </label>
                                <input type="date" class="form-control" id="dateg" name="dateg">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="editar_b();" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>/js/comision/snc1.js">






    </script>