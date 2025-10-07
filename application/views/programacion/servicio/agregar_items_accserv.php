<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Continuar la carga de la programación Servicios-acc</h2>
    <div class="row">

        <div class="col-12 mt-4">
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
                    <label>Acción Centralizada<b style="color:red">*</b></label><br>
                    <select style="width: 100%;" name="id_accion_centralizada" id="id_accion_centralizada"
                        class="default-select2 form-control" readonly>
                        <option value="<?= $inf_1_acc['id_accion_centralizada'] ?>">
                            <?= $inf_1_acc['desc_accion_centralizada'] ?></option>

                    </select>
                </div>

                <div class="form-group mt-2 col-3">
                    <label id="accbienes">Objeto de Contratación</label><br>
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
                            <input type="hidden" id="id_proyectoii" name="id_proyectoii"
                                value="<?= $id_programacion ?>">
                            <input type="hidden" id="id_programacion" name="id_programacion"
                                value="<?= $id_p_acc_centralizada ?>">
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
                                <input id="porcentaje_acc" name="porcentaje_acc" value="0" type="hidden"
                                    class="form-control">
                            </div>

                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="col-12 mt-2 text-center">
                                <h4 style="color:red;">Información Items Productos (IP)</h4>
                            </div>
                            <div class="form-group col-12">
                                <label>Agregar Servicios (CCNU) <b style="color:red">*</b> <i style="color: red;"
                                        title="Para llenar el campo de CCNU debe ingresar una palabra clave, esto le ayudará con la búsqueda"
                                        class="fas fa-question-circle"></i></label>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Leer: Debe ingresar una palabra para realizar la búsqueda<i
                                                style="color: red;"
                                                title="Debe ingresar una palabra para realizar la búsqueda."
                                                class="fas fa-question-circle"></i></label>
                                        <input title="Debe ingresar una palabra para realizar la búsqueda" type="text"
                                            class="form-control" onKeyUp="this.value=this.value.toUpperCase();"
                                            name="ccnu_b" id="ccnu_b" onblur="buscar_ccnnua();">
                                    </div>

                                    <div class="col-8">
                                        <label>Leer: Depende de la palabra ingresada en el campo anterior, se mostrará
                                            las opciones.<i style="color: red;"
                                                title="Depende de la palabra ingresada en el campo anterior, se mostrará las opciones."
                                                class="fas fa-question-circle"></i></label>
                                        <select class="form-control" name="id_ccnu_acc" id="id_ccnu_acc">
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label>Especificación <b style="color:red">*</b> <i style="color: red;"
                                        title="Ingrese Especificación de CCNU seleccionada, de no existir , elegir no codificado y colocar detalle en la especificación."
                                        class="fas fa-question-circle"></i> </label>
                                <input id="especificacion_acc" name="especificacion_acc" type="text"
                                    class="form-control" onkeypress="may(this);">
                            </div>
                            <div class="form-group col-6">
                                <label>Unidad de Medida <b style="color:red">*</b> </label><i style="color: red;"
                                    title="Seleccione la Unidad de medida correspondiente."
                                    class="fas fa-question-circle"></i> <br>
                                <select style="width: 100%;" id="id_unidad_medida_acc" name="id_unidad_medida_acc"
                                    class="form-control default-select2">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($unid as $data): ?>
                                        <option value="<?= $data['id_unidad_medida'] ?>/<?= $data['desc_unidad_medida'] ?>">
                                            <?= $data['desc_unidad_medida'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label style="color:red;">Ingrese Rango de Fecha Estimado para Ejecución del Servicio
                                    (Obligatorio). <b style="color:red">*</b></label><i style="color: red;"
                                    title="Seleccione la Fecha estimada de ejecución del Servicio."
                                    class="fas fa-question-circle"></i><br>
                                <span class="input-group-addon">-</span> <label>Fecha de Desde</label><b
                                    style="color:red">*</b>

                                <input type="date" class="form-control" id="fecha_desde" onchange="verif_d();"
                                    onblur="habilitar_trim();" name="fecha_desde" placeholder="Desde" />
                                <span class="input-group-addon">-</span> <label>Fecha Hasta</label><b
                                    style="color:red">*</b>

                                <input type="date" class="form-control" id="fecha_hasta" onchange="verif_h();"
                                    onblur="habilitar_trim();" name="fecha_hasta" placeholder="Hasta" />
                            </div>
                            <div class="col-12">
                                <div class="card card-outline-danger">
                                    <h5 class="mt-3 text-center"><b>Distribución del porcentaje de la
                                            Ejecución
                                            Trimestral</b><b style="color:red">*Leer</b><i style="color: red;"
                                            title="Para ingresar los datos correspondientes a cada trimestre, debe ingresar un Rango de Fecha."
                                            class="fas fa-question-circle"></i> </h5> <br>
                                    <h6 class="mt-1 text-center">Debe distribuir el porcentaje de ejecución trimestral
                                        en los campos de trimestres I,II,III,IV según su programación</h6>
                                    <h6 class=" text-right">Porcentaje a distribuir debe ser igual a Cero (0)</h6>
                                    <div class="row mt-3">
                                        <div class="form-group col-2">
                                            <label>I<b style="color:red">*</b></label>
                                            <input id="I" name="I" type="text" onblur="calculo();" value="0"
                                                class="form-control" onkeypress="return valideKey(event);">
                                        </div>
                                        <div class="form-group col-2">
                                            <label>II<b style="color:red">*</b></label>
                                            <input id="II" name="II" type="text" onblur="calculo();" value="0"
                                                class="form-control" onkeypress="return valideKey(event);">
                                        </div>
                                        <div class="form-group col-2">
                                            <label>III<b style="color:red">*</b></label>
                                            <input id="III" name="III" type="text" onblur="calculo();" value="0"
                                                class="form-control" onkeypress="return valideKey(event);">
                                        </div>
                                        <div class="form-group col-2">
                                            <label>IV<b style="color:red">*</b></label>
                                            <input id="IV" name="IV" type="text" onblur="calculo();" value="0"
                                                class="form-control" onkeypress="return valideKey(event);">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Porcentaje. Total Distribuir <b style="color:red">*</b> <i
                                                    style="color: red;"
                                                    title="Restara con los valores ingresados en los campos de trimestres, debe dar un Valor de Cero(0)."
                                                    class="fas fa-question-circle"></i></label>
                                            <input id="cant_total_distribuir" value="100" onblur="calculo();"
                                                name="cant_total_distribuir" type="number" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label>Precio Total <b style="color:red">*</b></label><i style="color: red;"
                                    title="Ingrese el Costo Total del Servicio para realizar los siguientes cálculos."
                                    class="fas fa-question-circle"></i>
                                <input id="precio_total" name="precio_total" type="text" onclick="cant_total();"
                                    onblur="calculo();" class="form-control">
                            </div>
                            <div class="form-group col-2">
                                <label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
                                <select name="id_alicuota_iva" id="id_alicuota_iva" onchange="calculo();"
                                    class="form-control">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($iva as $data): ?>
                                        <option value="<?= $data['desc_alicuota_iva'] ?>/<?= $data['desc_porcentaj'] ?>">
                                            <?= $data['desc_porcentaj'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                <input id="iva_estimado" name="iva_estimado" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group col-3">
                                <label>Monto total Estimado<b style="color:red">*</b></label>
                                <input id="monto_estimado" name="monto_estimado" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="form-group col-2">
                                <label>Estimado I Trimestre</b></label>
                                <input id="estimado_i" name="estimado_i" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Estimado II Trimestre</label>
                                <input id="estimado_ii" name="estimado_ii" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Estimado III Trimestre</label>
                                <input id="estimado_iii" name="estimado_iii" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Estimado IV Trimestre</label>
                                <input id="estimado_iV" name="estimado_iV" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label>Estimado Total Trimestres</label>
                                <input id="estimado_total_t" name="estimado_total_t" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_acc_servicio();" id="guardar" name="guardar"
                            class="my-button">Guardar</button>
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
                                <th style="color:white;" colspan="4">Información del Servicio</th>
                                <th style="color:white;" colspan="2">Fecha estimada de Ejecución Servicio</th>
                                <th style="color:white;" colspan="6">Distribución Porcentual de la Ejecución Trimestral
                                </th>
                                <th style="color:white;" colspan="5">Costos Estimados</th>
                                <th style="color:white;"></th>

                            </tr>

                            <tr style="text-align:center">
                                <th style="color:white;">ID</th>
                                <th style="color:white;">Partida Pres.</th>
                                <th style="color:white;">CCNU</th>
                                <th style="color:white;">Esp.</th>
                                <th style="color:white;">Unid. Medida</th>
                                <th style="color:white;">Fecha Desde</th>
                                <th style="color:white;">Fecha Hasta</th>
                                <th style="color:white;">% a Ejecutar</th>
                                <th style="color:white;">I</th>
                                <th style="color:white;">II</th>
                                <th style="color:white;">III</th>
                                <th style="color:white;">IV</th>
                                <th style="color:white;">Total a Distrib.</th>

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
                                    <td><?= $data['fecha_desde'] ?> </td>
                                    <td><?= $data['fecha_hasta'] ?> </td>
                                    <td><?= $data['cantidad'] ?> </td>
                                    <td><?= $data['i'] ?> </td>
                                    <td><?= $data['ii'] ?> </td>
                                    <td><?= $data['iii'] ?> </td>
                                    <td><?= $data['iv'] ?> </td>
                                    <td><?= $data['cant_total_distribuir'] ?> </td>

                                    <td><?= $data['precio_total'] ?> </td>
                                    <td><?= $data['alicuota_iva'] ?> </td>
                                    <td><?= $data['iva_estimado'] ?> </td>
                                    <td><?= $data['monto_estimado'] ?> </td>
                                    <td class="center">
                                        <!-- <a onclick="modal(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                        data-target="#myModal_bienes" style="color: white">
                                        <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                            style="color: darkgreen;"></i>
                                    </a> -->

                                        <!-- <a href="<?php echo base_url(); ?>index.php/programacion/editar_item_servicio_acc?id=<?php echo $data['id_p_items']; ?>/<?php echo $data['id_p_items']; ?>"
                                            class="button">
                                            <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                            style="color: darkgreen;"></i>
                                        <a />  -->
                                        <a onclick="modal(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                            data-target="#myModal_bienes" style="color: white">
                                            <i title="editar" class="fas  fa-lg fa-fw fa-highlighter"
                                                style="color: darkgreen;"></i>
                                        </a>

                                        <a onclick="eliminar_items_servi(<?php echo $data['id_p_items']; ?>);"
                                            class="button"><i class="fas fa-lg fa-fw  fa-trash-alt"
                                                style="color:red"></i><a />

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group col 12 text-center">
                    <button type="button" class="my-button3" onclick="location.href='#accbienes'">Continuar con la Carga
                        de Acciòn Centralizada Servicios</button>
                    <button
                        onclick="location.href='<?php echo base_url() ?>index.php/programacion/nueva_prog?id=<?php echo $id_programacion; ?>'"
                        type="button" class="my-button3" name="button">
                        Ir a Carga Plan de Compra
                    </button>

                </div>
            </div>

        </div>
    </div>

    <!-- MODAL PARA EDITAR INFORMACION DE CADA FILA -->
    <div id="myModal_bienes" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modificar Servicio-acc</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" class="form-control" name="id_items_b" id="id_items_b">
                        <div class="form-group col-8">
                            <label>ID - ITEMS</label>
                            <input class="form-control" type="text" name="id_p_items" id="id_p_items" readonly>
                        </div>
                        <div class="form-group col-12">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b" id="id_part_pres_b">
                            <input id="codigopartida_presupuestaria" name="codigopartida_presupuestaria"
                                class="form-control" class="form-control" readonly>
                            <input id="desc_partida_presupuestaria" name="desc_partida_presupuestaria"
                                class="form-control" class="form-control" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Fuente Financiamiento</label>
                            <input type="text" class="form-control" name="ff_b" id="ff_b" readonly>
                            <input type="hidden" name="id_ff_b" id="id_ff_b" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label> Cambiar Fuente Financiamiento <i style="color:red"
                                    title="Si quiere cambiar la Fuente de Financiamiento, debe seleccionarla en este campo"
                                    class="fas fa-question-circle">leer</i></label>
                            <select class="form-control" name="camb_ff_b1" id="camb_ff_b1">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <!-- <div class="form-group col-12">
                            <label> Cambiar Partida Presupuestaria <i
                                    title="Si requiere cambiar la Partida Presupuestaria, debe seleccionarlo en el siguiente campo"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="selc_part_pres_b" id="selc_part_pres_b">
                                <option value="0">Seleccione</option>
                            </select>
                        </div> -->

                        <div class="form-group col-6">
                            <label>CCNU</label>
                            <input type="text" class="form-control" name="desc_ccnu" id="desc_ccnu" disabled>

                        </div>


                        <div class="form-group col-6">
                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion" id="especificacion">
                        </div>
                        <div class="form-group col-3">
                            <label>Unidad de Medida</label>
                            <input type="text" class="form-control" name="unid_med_b" id="unid_med_b" readonly>
                            <input type="hidden" name="id_unid_med_b" id="id_unid_med_b">
                        </div>
                        <div class="form-group col-3">
                            <label> Cambiar Unid. Medida <i
                                    title="Si quiere cambiar la Unidad de Medida, debe seleccionarla en este campo"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="camb_unid_medi_b" id="camb_unid_medi_b">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label style="color:red;">Ingrese Rango de Fecha Estimado para Ejecución del Servicio
                                (Obligatorio). <b style="color:red">*leer</b></label><i style="color: red;"
                                title="Seleccione la Fecha estimada de ejecución de la obra."
                                class="fas fa-question-circle"></i>
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" id="fecha_desde1" name="start1"
                                    placeholder="Desde" />
                                <span class="input-group-addon">-</span>
                                <input type="text" class="form-control" id="fecha_hasta1" name="end1"
                                    placeholder="Hasta" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-outline-danger">
                                <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución
                                        Trimestral</b> <i style="color: red;"
                                        title="Para ingresar los datos correspondientes a cada trimestre, debe ingresar un Rango de Fecha."
                                        class="fas fa-question-circle"></i></h5>
                                <div class="row mt-3">
                                    <div class="form-group col-2">
                                        <label>I<b style="color:red">*</b></label>
                                        <input id="primero_b" name="primero_b" type="text" onblur="calculo_servi();"
                                            value="0" class="form-control" onkeypress="return valideKey(event);">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>II<b style="color:red">*</b></label>
                                        <input id="segundo_b" name="segundo_b" type="text" onblur="calculo_servi();"
                                            value="0" class="form-control" onkeypress="return valideKey(event);">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>III<b style="color:red">*</b></label>
                                        <input id="tercero_b" name="tercero_b" type="text" onblur="calculo_servi();"
                                            value="0" class="form-control" onkeypress="return valideKey(event);">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>IV<b style="color:red">*</b></label>
                                        <input id="cuarto_b" name="cuarto_b" type="text" onblur="calculo_servi();"
                                            value="0" class="form-control" onkeypress="return valideKey(event);">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Porcentaje. Total Distribuir <b style="color:red">*leer</b> <i
                                                style="color: red;"
                                                title="Restara con los valores ingresados en los campos de trimestres, debe dar un Valor de Cero(0)."
                                                class="fas fa-question-circle"></i></label>
                                        <input id="cant_total_distribuir1" value="100" onblur="calculo_servi();"
                                            name="cant_total_distribui1r" type="number" class="form-control" readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group col-4">
                            <label>Precio Total Estimado<bbbb style="color:red">*</b></label>
                            <input id="precio_total_mod_b1" name="precio_total_mod_b1" type="text" class="form-control"
                                onblur="calculo_servi();">
                        </div>

                        <div class="form-group col-4">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
                            <div class="row">
                                <div class="col-5">
                                    <input type="text" class="form-control" onblur="calculo_servi();" name="ali_iva_e_b"
                                        id="ali_iva_e_b" readonly>
                                </div>
                                <div class="col-7">
                                    <select title="Para cambiar la Alicuota de IVA debe seleccionarlo en este campo."
                                        class="form-control" name="sel_id_alic_iva_b1" id="sel_id_alic_iva_b1"
                                        onchange="calculo_servi();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado_mod_b1" name="iva_estimado_mod_b1" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado_mod_b1" name="monto_estimado_mod_b1" type="text"
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

                        <!-- <div class="form-group mt-2 col-6">
                                <label style="color: red;">Debe Ingresar una Observación (Obligatorio)</label> Leer<i style="color: red;"
                                    title="Debe ingresar una Observación, para reprogramar"
                                    class="fas fa-question-circle"></i><br>
                                <textarea class="form-control" rows="2" name="observaciones2"
                                    id="observaciones2"></textarea>
                            </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="my-button" onclick="guardar_tabla_serv_acc();"
                            data-dismiss="modal">Guardar</button>
                        <button type="button" class="my-button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>

    <!-- ////////////////////////////////////////////GUARDA MAS ITEM EN LA BD DE SERVICIOS -->
    <!-- <script src="<?= base_url() ?>/js/programacion.js"></script> -->
    <script src="<?= base_url() ?>/js/calculos.js"></script>
    <!-- <script src="<?= base_url() ?>/js/servicio/agregar_ff.js"></script>
<script src="<?= base_url() ?>/js/servicio/agregar_ip.js"></script>
<script src="<?= base_url() ?>/js/servicio/registro.js"></script> -->

    <script src="<?= base_url() ?>/js/servicio/Guardar_mas_item_acc_servicio.js"></script>



    <script src="<?= base_url() ?>/js/eliminar.js"></script>




    <!-- <script src="<?= base_url() ?>/js/bien/llenar_editar_acc_b.js"></script> -->
    <!-- <script src="<?= base_url() ?>/js/bien/agregar_acc_centralizada_edit.js"></script>
    <script src="<?= base_url() ?>/js/bien/agregar_acc_centralizada_ff.js"></script> -->

    <!-- <script src="<?= base_url() ?>/js/bien/calculos_bienes_edit.js"></script> -->

    <script>
        $(document).ready(function() {
            $("#precio_total").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#I").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#II").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#III").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#IV").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#primero_b").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#segundo_b").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#tercero_b").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#cuarto_b").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });
            $("#precio_total_mod_b1").on('paste', function(e) {
                e.preventDefault();
                //alert('Esta acción está deshabilitada');
            });


        });
    </script>