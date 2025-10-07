<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Modificación Bienes-Proyecto</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                        <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?= $des_unidad ?>.</p>
                        <p class="f-s-16">RIF.: <?= $rif ?> <br>
                            Código ONAPRE: <?= $codigo_onapre ?> <br>


                            <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                <?php foreach ($inf_1_acc as $inf_1_acc): ?><?php endforeach; ?>

                <div class="col-6 mt-3 form-group">
                    <label>Nombre del Proyecto<b style="color:red">*</b></label><br>
                    <input type="text" id="desc_objeto_contrata" name="desc_objeto_contrata"
                        value="<?= $inf_1_acc['nombre_proyecto'] ?>" class="form-control" readonly>

                    </select>
                </div>

                <div class="form-group mt-2 col-3">
                    <label>Objeto de Contratación</label><br>
                    <input type="hidden" id="id_obj_comercial" name="id_obj_comercial"
                        value="<?= $inf_1_acc['id_obj_comercial'] ?>">
                    <input type="text" id="desc_objeto_contrata" name="desc_objeto_contrata"
                        value="<?= $inf_1_acc['desc_objeto_contrata'] ?>" class="form-control" readonly>
                </div>
                <div class="col-12">
                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                </div>

                <form class="form-horizontal" id="guardar_tcu" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <input type="hidden" id="id_obj_comercial" name="id_obj_comercial"
                                value="<?= $inf_1_acc['id_obj_comercial'] ?>">
                            <label style="color: red;">Debe Ingresar una Observación</label> Leer<i style="color: red;"
                                title="Debe ingresar una Observación" class="fas fa-question-circle"></i><br>
                            <textarea class="form-control" rows="2" name="observaciones" id="observaciones"></textarea>
                            <input type="hidden" id="id_programacion3" name="id_programacion3"
                                value="<?= $id_programacion ?>">
                            <input type="hidden" id="id_programacion" name="id_programacion"
                                value="<?= $id_p_proyecto ?>">
                            <div class="col-12 text-center">
                                <h4 style="color:red;">Información Items Fuente Financiamiento (IFF)</h4>
                            </div>
                            <div class="form-group col-12">
                                <label>Partida Presupuestaria</label>

                                <input type="hidden" name="par_presupuestaria_ff" id="par_presupuestaria_ff">
                                <select id="par_presupuestaria_acc" name="par_presupuestaria_acc"
                                    class="default-select2 form-control">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($part_pres as $data): ?>
                                        <option
                                            value="<?= $data['id_partida_presupuestaria'] ?>/<?= $data['desc_partida_presupuestaria'] ?>/<?= $data['codigopartida_presupuestaria'] ?>">
                                            <?= $data['codigopartida_presupuestaria'] ?>/<?= $data['desc_partida_presupuestaria'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <div class="form-group col-6">
                                <label>Estado</label><br>
                                <select style="width: 100%;" id="id_estado_acc" name="id_estado_acc"
                                    class="default-select2 form-control" multiple="multiple">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($estados as $data): ?>
                                        <option value="<?= $data['descedo'] ?>"><?= $data['descedo'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Fuente de Financiamiento</label>
                                <select style="width: 100%;" id="fuente_financiamiento_acc"
                                    name="fuente_financiamiento_acc" class="default-select2 form-control">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($fuente as $data): ?>
                                        <option
                                            value="<?= $data['id_fuente_financiamiento'] ?>/<?= $data['desc_fuente_financiamiento'] ?>">
                                            <?= $data['desc_fuente_financiamiento'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <input id="porcentaje_acc" name="porcentaje_acc" type="hidden" value="0"
                                    class="form-control">
                            </div>

                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="col-12 mt-2 text-center">
                                <h4 style="color:red;">Información Items Productos (IP)</h4>
                            </div>
                            <div class="form-group col-12">
                                <label>Cambiar CCNU <i style="color: red;"
                                        title="Para llenar el campo de CCNU debe ingresar una palabra clave, esto le ayudara con la busqueda"
                                        class="fas fa-question-circle"></i></label>
                                <div class="row">
                                    <div class="col-4">
                                        <input title="Debe ingresar una palabra para realizar la busqueda" type="text"
                                            class="form-control" onKeyUp="this.value=this.value.toUpperCase();"
                                            name="ccnu_b" id="ccnu_b" onblur="buscar_ccnnua();">
                                    </div>
                                    <div class="col-8">
                                        <select
                                            title="Depende de la palabra ingresada en el campo anterior, se listaran las opciones."
                                            class="form-control" name="id_ccnu_acc" id="id_ccnu_acc">
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Especificación <b style="color:red">*</b></label>
                                <input id="especificacion_acc" name="especificacion_acc" type="text"
                                    class="form-control" onkeypress="may(this);">
                            </div>
                            <div class="form-group col-6">
                                <label>Unidad de Medida <b style="color:red">*</b></label><br>
                                <select style="width: 100%;" id="id_unidad_medida_acc" name="id_unidad_medida_acc"
                                    class="form-control default-select2">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($unid as $data): ?>
                                        <option value="<?= $data['id_unidad_medida'] ?>/<?= $data['desc_unidad_medida'] ?>">
                                            <?= $data['desc_unidad_medida'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="card card-outline-danger">
                                <h5 class="mt-3 text-center"><b>Distribución de la cantidad de la Ejecución
                                        Trimestral</b></h5>
                                <div class="row mt-2">
                                    <div class="form-group col-2">
                                        <label>Cantidad<b style="color:red">*</b></label>
                                        <input id="cantidad_acc" name="cantidad_acc" onblur="calcular_bienes();"
                                            type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>I<b style="color:red">*</b></label>
                                        <input id="I_acc" name="I_acc" type="text" onblur="calcular_bienes();" value="0"
                                            class="form-control" style="width: 100%;">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>II<b style="color:red">*</b></label>
                                        <input id="II_acc" name="II_acc" type="text" onblur="calcular_bienes();"
                                            value="0" class="form-control" style="width: 100%;">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>III<b style="color:red">*</b></label>
                                        <input id="III_acc" name="III_acc" type="text" onblur="calcular_bienes();"
                                            value="0" class="form-control" style="width: 100%;">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>IV<b style="color:red">*</b></label>
                                        <input id="IV_acc" name="IV_acc" type="text" onblur="calcular_bienes();"
                                            value="0" class="form-control" style="width: 100%;">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Cantd. restante a Distribuir <b style="color:red">*</b></label>
                                        <input id="cant_total_distribuir_acc" name="cant_total_distribuir_acc"
                                            type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label>Costo Unitario <b style="color:red">*</b></label>
                                <input id="costo_unitario_acc" name="costo_unitario_acc" onblur="calcular_bienes();"
                                    type="text" class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <label>Precio Total Estimado<b style="color:red">*</b></label>
                                <input id="precio_total_acc" name="precio_total_acc" type="text" class="form-control"
                                    readonly>
                            </div>

                            <div class="form-group col-2">
                                <label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
                                <select style="width: 100%;" name="id_alicuota_iva_acc" id="id_alicuota_iva_acc"
                                    onchange="calcular_bienes();" class="form-control default-select2">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($iva as $data): ?>
                                        <option value="<?= $data['desc_alicuota_iva'] ?>/<?= $data['desc_porcentaj'] ?>">
                                            <?= $data['desc_porcentaj'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                <input id="iva_estimado_acc" name="iva_estimado_acc" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group col-3">
                                <label>Monto total Estimado<b style="color:red">*</b></label>
                                <input id="monto_estimado_acc" name="monto_estimado_acc" type="text"
                                    class="form-control">
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="form-group col-2">
                                <label>Estimado I Trimestre</b></label>
                                <input id="estimado_i_acc" name="estimado_i_acc" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Estimado II Trimestre</label>
                                <input id="estimado_ii_acc" name="estimado_ii_acc" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Estimado III Trimestre</label>
                                <input id="estimado_iii_acc" name="estimado_iii_acc" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Estimado IV Trimestre</label>
                                <input id="estimado_iV_acc" name="estimado_iV_acc" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group col-4">
                                <label>Estimado Total Trimestres + Iva Estimado</label>
                                <input id="estimado_total_t_acc" name="estimado_total_t_acc" type="text"
                                    class="form-control" readonly>
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_py_reprogramabien();" id="guardar" name="guardar"
                            class="btn btn-primary mb-3">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <table id="data-table-default" data-order='[[ 0, "desc" ]]'
                        class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">
                                <th style="color:white;">ID</th>
                                <th style="color:white;">Partida Pres.</th>
                                <th style="color:white;">CCNU</th>
                                <th style="color:white;">Esp.</th>
                                <th style="color:white;">Unid. Medida</th>
                                <th style="color:white;">Cantidad</th>
                                <th style="color:white;">I</th>
                                <th style="color:white;">II</th>
                                <th style="color:white;">III</th>
                                <th style="color:white;">IV</th>
                                <th style="color:white;">Total a Distrib.</th>
                                <th style="color:white;">Costo Unit.</th>
                                <th style="color:white;">Precio Total</th>
                                <th style="color:white;">IVA </th>
                                <th style="color:white;">Monto Iva Est.</th>
                                <th style="color:white;">Monto Total Est.</th>
                                <th style="color:white;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($accion as $data): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?= $data['id_p_items'] ?> </td>
                                    <td><?= $data['codigopartida_presupuestaria'] ?> </td>
                                    <td><?= $data['desc_ccnu'] ?> </td>
                                    <td><?= $data['especificacion'] ?> </td>
                                    <td><?= $data['desc_unidad_medida'] ?> </td>
                                    <td><?= $data['cantidad'] ?> </td>
                                    <td><?= $data['i'] ?> </td>
                                    <td><?= $data['ii'] ?> </td>
                                    <td><?= $data['iii'] ?> </td>
                                    <td><?= $data['iv'] ?> </td>
                                    <td><?= $data['cant_total_distribuir'] ?> </td>
                                    <td><?= $data['costo_unitario'] ?> </td>
                                    <td><?= $data['precio_total'] ?> </td>
                                    <td><?= $data['alicuota_iva'] ?> </td>
                                    <td><?= $data['iva_estimado'] ?> </td>
                                    <td><?= $data['monto_estimado'] ?> </td>
                                    <td class="center">
                                        <a onclick="modal(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                            data-target="#myModal_bienes" style="color: white">
                                            <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                                style="color: darkgreen;"></i>
                                        </a>
                                        <a onclick="eliminar_items_servi2(<?php echo $data['id_p_items']; ?>);"
                                            class="button"><i class="fas fa-lg fa-fw  fa-trash-alt"
                                                style="color:red"></i><a />
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
                    <h4 class="modal-title">Modal para editar Items de Bienes</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <input type="text" class="form-control" name="id_items_b" id="id_items_b">
                        <div class="form-group col-8">
                            <label>ID - ITEMS</label>
                            <input class="form-control" type="text" name="id_p_items" id="id_p_items" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b" id="id_part_pres_b">
                            <input id="codigopartida_presupuestaria" name="codigopartida_presupuestaria"
                                class="form-control" class="form-control" readonly>
                            <input id="desc_partida_presupuestaria" name="desc_partida_presupuestaria"
                                class="form-control" class="form-control" readonly>
                        </div>

                        <div class="form-group col-6">
                            <label>CCNU</label>
                            <input type="text" class="form-control" name="desc_ccnu" id="desc_ccnu" readonly>

                        </div>
                        <div class="form-group col-6">
                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion" id="especificacion">
                        </div>
                        <div class="form-group col-3">
                            <label>Unidad de Medida</label>
                            <input type="text" class="form-control" name="unid_med_b" id="unid_med_b" readonly>
                            <input type="text" name="id_unid_med_b" id="id_unid_med_b">
                        </div>
                        <div class="form-group col-3">
                            <label> Cambiar Unid. Medida <i
                                    title="Si quiere cambiar la Unidad de Medida, debe seleccionarla en este campo"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="camb_unid_medi_b" id="camb_unid_medi_b">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="card card-outline-danger">
                            <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b></h5>
                            <div class="row mt-2">
                                <div class="form-group col-2">
                                    <label>Cantidad<b style="color:red">*</b></label>
                                    <input id="cantidad_mod_b" name="cantidad_mod_b" onblur="calcular_mod_bienes();"
                                        class="form-control" onkeypress="return valideKey(event);">
                                </div>
                                <div class="form-group col-2">
                                    <label>I Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="primero_b" id="primero_b">
                                </div>
                                <div class="form-group col-2">
                                    <label>II Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="segundo_b" id="segundo_b">
                                </div>
                                <div class="form-group col-2">
                                    <label>III Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="tercero_b" id="tercero_b">
                                </div>
                                <div class="form-group col-2">
                                    <label>IV Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="cuarto_b" id="cuarto_b">
                                </div>
                                <div class="form-group col-2">
                                    <label>Cantd. restante a Distribuir <b style="color:red">*</b></label>
                                    <input id="cant_total_distribuir_mod_b" name="cant_total_distribuir_mod_b"
                                        onkeyup="verif();" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label>Costo Unitario <b style="color:red">*</b></label>
                            <input style="width: 100%;" id="costo_unitario_mod_b" name="costo_unitario_mod_b"
                                onblur="calcular_mod_bienes();" class="form-control"
                                onkeypress="return valideKey(event);">
                        </div>
                        <div class="form-group col-4">
                            <label>Precio Total Estimado<b style="color:red">*</b></label>
                            <input id="precio_total_mod_b" name="precio_total_mod_b" type="text" class="form-control"
                                readonly>
                        </div>

                        <div class="form-group col-4">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
                            <div class="row">
                                <div class="col-5">
                                    <input type="text" class="form-control" onblur="calcular_mod_bienes();"
                                        name="ali_iva_e_b" id="ali_iva_e_b" readonly>
                                </div>
                                <div class="col-7">
                                    <select title="Para cambiar la Alicuota de IVA debe seleccionarlo en este campo."
                                        class="form-control" name="sel_id_alic_iva_b" id="sel_id_alic_iva_b"
                                        onchange="calcular_mod_bienes();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado_mod_b" name="iva_estimado_mod_b" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado_mod_b" name="monto_estimado_mod_b" type="text"
                                class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-2">
                            <label>Est. I Trimestre</b></label>
                            <input id="estimado_primer" name="estimado_i" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. II Trimestre</label>
                            <input id="estimado_segundo" name="estimado_ii" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. III Trimestre</label>
                            <input id="estimado_tercer" name="estimado_iii" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. IV Trimestre</label>
                            <input id="estimado_cuarto" name="estimado_iV" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Est. Total Trimestres</label>
                            <input id="estimado_total_t_mod" name="estimado_total_t" type="text" class="form-control"
                                readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="guardar_tabla_b12();"
                            data-dismiss="modal">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>
    <!-- /////////////////////////////editar items de bienes -->
    <script src="<?= base_url() ?>/js/bien/modal_editar_items_bienes.js"></script>
    <!-- /////////////////////////////editar items de bienes -->
    <script src="<?= base_url() ?>/js/bien/llenar_editar_proy_b.js"></script>
    <script src="<?= base_url() ?>/js/bien/agregar_acc_centralizada_edit.js"></script>
    <script src="<?= base_url() ?>/js/bien/agregar_acc_centralizada_ff.js"></script>
    <script src="<?= base_url() ?>/js/bien/calculos_bienes_edit.js"></script>

    <!-- ///////////////////////////////////////////////////////guardar items py bienes -->
    <script src="<?= base_url() ?>/js/bien/guardar_items_py_bien.js"></script>


    <!-- <script src="<?= base_url() ?>/js/bien/llenar_editar_acc_b.js"></script> -->
    <script src="<?= base_url() ?>/js/bien/agregar_acc_centralizada_edit.js"></script>
    <script src="<?= base_url() ?>/js/bien/agregar_acc_centralizada_ff.js"></script>

    <script src="<?= base_url() ?>/js/bien/calculos_bienes_edit.js"></script>


    <script src="<?= base_url() ?>/js/eliminar.js"></script>