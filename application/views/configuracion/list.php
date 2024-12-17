<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Listado</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                        <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                        <p class="f-s-16">RIF.: <?=$rif?> <br>



                            <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <table id="data-table-default" data-order='[[ 0, "desc" ]]'
                        class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">
                                <th style="color:white;">Rif</th>
                                <th style="color:white;">Descripción</th>
                                <?php if ($this->session->userdata('perfil') == 1 || $this->session->userdata('perfil') == 14) : ?>

                                <th style="color:white;">Acción</th>
                                <?php endif; ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['rif']?> </td>
                                <td><?=$data['descripcion']?> </td>

                                <?php if ($this->session->userdata('perfil') == 1 || $this->session->userdata('perfil') == 14) : ?>

                                <td class="center">
                                    <a onclick="modal(<?php echo $data['id_organoente'] ?>);" data-toggle="modal"
                                        data-target="#myModal_bienes" style="color: white">
                                        <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                            style="color: darkgreen;"></i>
                                    </a>

                                </td>
                                <?php endif; ?>

                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL PARA EDITAR INFORMACION DE CADA FILA -->

    <div id="myModal_bienes" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modificar </h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" class="form-control" name="id_organoentes" id="id_organoentes">
                        <div class="form-group col-3">
                            <label>RIF</label>
                            <input class="form-control" type="hidden" name="id_organoente" id="id_organoente" readonly>
                            <input class="form-control" type="text" name="rif" id="rif" readonly>

                        </div>
                        <div class="form-group col-9">
                            <label>Razón Social</label>
                            <input id="descripcion" name="descripcion" class="form-control" class="form-control"
                                maxlength="250">
                        </div>
                        <div class="form-group col-2">
                            <label>Codigo ONAPRE</label>
                            <input type="text" class="form-control" name="cod_onapre" id="cod_onapre" maxlength="20">
                        </div>
                        <div class="form-group col-3">
                            <label>Siglas</label>
                            <input type="text" class="form-control" name="siglas" id="siglas" maxlength="11">
                        </div>
                        <div class="form-group col-3">
                            <label>Pagina Web</label>
                            <input type="text" class="form-control" name="pagina_web" id="pagina_web" maxlength="50">
                        </div>
                        <div class="form-group col-4">
                            <label>Correo Electronico</label>
                            <input type="email" class="form-control" name="correo" id="correo"
                                onblur="return validateEmail()">
                            <p id="errorMsgc"></p>

                        </div>
                        <div class="form-group col-3">
                            <label>Estado</label>
                            <input type="text" class="form-control" name="descedo" id="descedo" disabled>
                            <input type="hidden" name="id_estado" id="id_estado">
                        </div>
                        <div class="form-group col-3">
                            <label> Cambiar Estado <i title="Si quiere cambiar el estado seleccionar"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="cambio_edo" id="cambio_edo" onclick="llenar_muni();">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <label>Municipio</label>
                            <input type="text" class="form-control" name="descmun" id="descmun" disabled>
                            <input type="hidden" name="id_municipio" id="id_municipio">
                        </div>
                        <div class="form-group col-3">
                            <label> Cambiar Municipio <i title="Si quiere cambiar el municipio seleccionar"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="camb_muni" id="camb_muni">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label>Parroquia</label>
                            <input type="text" class="form-control" name="descparro" id="descparro" disabled>
                            <input type="hidden" name="id_parroquia" id="id_parroquia">
                        </div>
                        <div class="form-group col-3">
                            <label> Cambiar Parroquia <i title="Si quiere cambiar la parroquia seleccionar"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="camb_parrq" id="camb_parrq">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>Dirección Fiscal</label>
                            <textarea class="form-control" id="direccion_fiscal" name="direccion_fiscal" rows="2"
                                cols="125"></textarea>
                        </div>
                        <div class="form-group col-3">
                            <label>Telefono local</label>
                            <input type="number" class="form-control" id="tel1" name="tel1"
                                onkeyup="validateMaxLength(this)" />
                            <p id="errorMsg"></p>
                        </div>
                        <div class="form-group col-3">
                            <label>Telefono local </label>
                            <input type="tenumberxt" class="form-control" name="tel2" id="tel2"
                                onkeyup="validateMaxLength2(this)">
                            <p id="errorMsg2"></p>
                        </div>
                        <div class="form-group col-3">
                            <label>Telefono Movil</label>
                            <input type="number" class="form-control" name="movil1" id="movil1"
                                onkeyup="validateMaxLength3(this)">
                            <p id="errorMsg3"></p>

                        </div>
                        <div class="form-group col-3">
                            <label>Telefono Movil</label>
                            <input type="number" class="form-control" name="movil2" id="movil2"
                                onkeyup="validateMaxLength4(this)">
                            <p id="errorMsg4"></p>
                        </div>
                        <div class="form-group col-3">
                            <label>Gaceta</label>
                            <input type="text" class="form-control" name="gaceta" id="gaceta" maxlength="50">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="my-button" id="btn_guar_2" onclick="save_modif_org();"
                            data-dismiss="modal">Guardar</button>
                        <button type="button" class="my-button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /////////////////////////////editar items de bienes este-->
    <script src="<?=base_url()?>/js/configuracion/updatelist.js"></script>