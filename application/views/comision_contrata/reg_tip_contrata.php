<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro Tipo de Comisión</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Seleccione Tipo Contratación <b title="Campo Obligatorio"
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





                                </div>
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
                                    <td><?=$data['desc_status']?> </td>
                                    <td><?=$data['desc_status_snc']?> </td>

                                    <td class="center">
                                        

                                            <a onclick="modal(<?php echo $data['id_comision'] ?>);" data-toggle="modal"
                                                data-target="#dede" style="color: white">
                                                <i title="Ingresar Miembros de Comisión"
                                                    class="fas fa-2x fa-fw fa-address-card"
                                                    style="color: darkblue;"></i>
                                            </a>
                                            <!-- <a onclick="modalacademico(<?php echo $data['id_comision']?>);"
                                                data-toggle="modal" data-target="#academico" style="color: white">
                                                <i title="Ingresar información Academica"
                                                    class="fas fa-2x fa-fw fa-user-graduate"
                                                    style="color: darkgreen;"></i>
                                            </a> -->
                                            <!-- <a onclick="modal14(<?php echo $data['id_comision']?>);" data-toggle="modal"
                                                data-target="#exampleModal" style="color: white">
                                                <i title="ver Integrantes"
                                                    class="fas fa-2x fa-fw fa-clipboard-list" style="color: pink;"></i>
                                            </a> -->
                                            <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb?id=<?php echo $data['id_comision'];?>"
                                                class="button">
                                                <i title="ver Integrantes" class="fas fa-2x fa-fw fa-clipboard-list"
                                                    style="color: pink;"></i>
                                                <a />
                                               
                                                <a title="Enviar Notificar SNC"
                                                    onclick="enviar(<?php echo $data['id_comision'];?>);"
                                                    class="button">
                                                    <i  class="fas fa-2x fa-fw fas ffas fa-bullhorn"
                                                    style="color: black;"></i>
                                                    <a />
                                                    <a href="<?php echo base_url();?>index.php/Publicaciones/anul?id=<?php echo $data['id_comision'];?>"
                                                        class="button">
                                                        <i class="fas fa-2x fa-fw  fa-ban" style="color: red;"
                                                            title="Anular comisión"></i>
                                                        <a />
                                                        <!--
                                            <a onclick="modal(<?php echo $data['id_comision']?>);" data-toggle="modal"
                                                data-target="#exampleModal" style="color: white">
                                                <i title="Capacitación Relacionada con Contrataciones Públicas"
                                                    class="fas fa-2x fa-fw fas fa-briefcase" style="color: orange;"></i>
                                            </a>
                                            <a onclick="modal(<?php echo $data['id_comision']?>);" data-toggle="modal"
                                                data-target="#exampleModal" style="color: white">
                                                <i title="Capacitación en Comisión de Contrataciones"
                                                    class="fas fa-2x fa-fw fas fas fa-city" style="color: Indigo;"></i>
                                            </a> -->
                                            
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
                                        <label>Cédula de Identidad</label>
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
                                        <label>Fecha de Designación</label>
                                        <input class="form-control" type="date" name="datedsg" id="datedsg">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Acto Administrativo de Designación</label>
                                        <input class="form-control" type="text" name="acto" id="acto">
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
    <div class="modal fade" id="academico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Información Academica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="academicos" name="academicos" data-parsley-validate="true"
                        method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-7">
                                <label>Seleccione Miembro de Comisión <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <select style="width: 100%;" id="id_miembro4" name="id_miembro4" class="form-control"
                                    data-show-subtext="true" data-live-search="true">
                                    <option value="0">Seleccione</option>

                                </select>
                            </div>


                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b>INFORMACIÓN ACADÉMICA</b></h5>
                                <div class="row ">
                                    <div class="form-group col-4">
                                        <label>Cédula de Identidad</label>
                                        <input class="form-control" type="text" name="id_miembro_m" id="id_miembro_m"
                                            readonly>
                                        <input class="form-control" type="text" name="cedula_miem" id="cedula_miem"
                                            readonly>


                                        <input class="form-control" type="hidden" name="id_comision3" id="id_comision3"
                                            readonly>
                                        <input class="form-control" type="hidden" name="rif_organoente3"
                                            id="rif_organoente3" readonly>


                                    </div>
                                    <div class="form-group col-4">
                                        <label>Nombres</label>
                                        <input class="form-control" type="text" name="name" id="name" readonly>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Apellidos</label>
                                        <input class="form-control" type="text" name="apellido_m" id="apellido_"
                                            readonly>
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
                                        <label>Fecha de Designación</label>
                                        <input class="form-control" type="date" name="datedsg" id="datedsg">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Acto Administrativo de Designación</label>
                                        <input class="form-control" type="text" name="acto" id="acto">
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

    <script src="<?=base_url()?>/js/comision/comision.js">
  





    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#id_miembro4").select2({
            dropdownParent: $("#academico")
        });
    });
    </script>