<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Cotinuar la carga de la programación Obras-acc</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                        <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                        <p class="f-s-16">RIF.: <?=$rif?> <br>
                            Código ONAPRE: <?=$codigo_onapre?> <br>


                            <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                <?php foreach($inf_1_acc as $inf_1_acc):?><?php endforeach;?>

                <div class="col-6 mt-3 form-group">
                    <label>Acción Centralizada<b style="color:red">*</b></label><br>
                    <select style="width: 100%;" name="id_accion_centralizada" id="id_accion_centralizada"
                        class="default-select2 form-control" readonly>
                        <option value="<?=$inf_1_acc['id_accion_centralizada']?>">
                            <?=$inf_1_acc['desc_accion_centralizada']?></option>

                    </select>
                </div>

                <div class="form-group mt-2 col-3">
                    <label>Objeto de Contratación</label><br>
                    <input type="hidden" id="id_obj_comercial" name="id_obj_comercial"
                        value="<?=$inf_1_acc['id_obj_comercial']?>">
                    <input type="text" id="desc_objeto_contrata" name="desc_objeto_contrata"
                        value="<?=$inf_1_acc['desc_objeto_contrata']?>" class="form-control" readonly>
                </div>
                <div class="col-12">
                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                </div>

                <form class="form-horizontal" id="guardar_tcu" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <input type="hidden" id="id_programacion" name="id_programacion"
                                value="<?=$id_p_acc_centralizada?>">
                                <input type="hidden" id="id_proyectoii" name="id_proyectoii"
                            value="<?=$id_programacion?>">
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
                                        value="<?=$data['id_partida_presupuestaria']?>/<?=$data['desc_partida_presupuestaria']?>/<?=$data['codigopartida_presupuestaria']?>">
                                        <?=$data['codigopartida_presupuestaria']?>/<?=$data['desc_partida_presupuestaria']?>
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
                                    <option value="<?=$data['descedo']?>"><?=$data['descedo']?></option>
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
                                        value="<?=$data['id_fuente_financiamiento']?>/<?=$data['desc_fuente_financiamiento']?>">
                                        <?=$data['desc_fuente_financiamiento']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <input id="porcentaje_acc" name="porcentaje_acc" value="0" type="hidden" class="form-control">
                            </div>

                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="col-12 mt-2 text-center">
                                <h4 style="color:red;">Información Items obras (IP)</h4>
                            </div>

                            <div class="form-group col-4">
                                <label>Tipo de Obra <b style="color:red">*</b> <i style="color: red;"
                                        title="Seleccione el tipo de Obra a realizar"
                                        class="fas fa-question-circle"></i></label><br>
                                <select  id="id_tip_obra" name="id_tip_obra" class="form-control">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($tip_obra as $data): ?>
                                        <option value="<?=$data['id_tip_obra']?>"><?=$data['descripcion_tip_obr']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group col-3">
                                <label>Alcance de la Obra <b style="color:red">*</b> <i style="color: red;"
                                        title="Seleccione el alcance de la Obra a realizar"
                                        class="fas fa-question-circle"></i></label><br>
                                <select  id="id_alcance_obra" name="id_alcance_obra" class="form-control">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($alcance_obra as $data): ?>
                                        <option value="<?=$data['id_alcance_obra']?>"><?=$data['descripcion_alcance_obra']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label>Objeto de la Obra <b style="color:red">*</b> <i style="color: red;"
                                        title="Seleccione el objeto de la Obra a realizar"
                                        class="fas fa-question-circle"></i></label><br>
                                <select  id="id_obj_obra" name="id_obj_obra" class="form-control">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($obj_obra as $data): ?>
                                        <option value="<?=$data['id_obj_obra']?>"><?=$data['descripcion_obj_obra']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                                                 
                            <div class="form-group col-6">
                                <label>Especificación <b style="color:red">*</b> <i style="color: red;" title="Ingrese Especificación de CCNU seleccionada, de no existir , elegir no codificado y colocar detalle en la especificación."
                                        class="fas fa-question-circle"></i> </label>
                                <input id="especificacion_acc" name="especificacion_acc" type="text"
                                    class="form-control" onkeypress="may(this);">
                            </div>
                            <div class="form-group col-6">
                                <label>Unidad de Medida <b style="color:red">*</b> </label><i style="color: red;" title="Seleccione la Unidad de medida correspondiente."
                                        class="fas fa-question-circle"></i> <br>
                                <select style="width: 100%;" id="id_unidad_medida_acc" name="id_unidad_medida_acc"
                                    class="form-control default-select2">
                                    <option value="">SELECCIONE</option>
                                    <?php foreach ($unid as $data): ?>
                                    <option value="<?=$data['id_unidad_medida']?>/<?=$data['desc_unidad_medida']?>">
                                        <?=$data['desc_unidad_medida']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label style="color:red;">Ingrese Rango de Fecha Estimado para Ejecución de La Obra (Obligatorio). <b style="color:red">*</b></label><i style="color: red;" title="Seleccione la Fecha estimada de ejecución del Servicio."
                                        class="fas fa-question-circle"></i>
                                    <div class="input-group input-daterange">
                                        <input type="text" class="form-control" id="fecha_desde" onchange="verif_d();" onblur="habilitar_trim();" name="start" placeholder="Desde" />
                                        <span class="input-group-addon">-</span>
                                        <input type="text" class="form-control"  id="fecha_hasta" onchange="verif_h();" onblur="habilitar_trim();" name="end" placeholder="Hasta" />
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
                                            <input id="I" name="I" type="text" onblur="calculo();" value="0"
                                                class="form-control" onkeypress="return valideKey(event);" >
                                        </div>
                                        <div class="form-group col-2">
                                            <label>II<b style="color:red">*</b></label>
                                            <input id="II" name="II" type="text" onblur="calculo();" value="0"
                                                class="form-control" onkeypress="return valideKey(event);" >
                                        </div>
                                        <div class="form-group col-2">
                                            <label>III<b style="color:red">*</b></label>
                                            <input id="III" name="III" type="text" onblur="calculo();" value="0"
                                                class="form-control" onkeypress="return valideKey(event);" >
                                        </div>
                                        <div class="form-group col-2">
                                            <label>IV<b style="color:red">*</b></label>
                                            <input id="IV" name="IV" type="text" onblur="calculo();" value="0"
                                                class="form-control" onkeypress="return valideKey(event);" >
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Cantd. Total Distribuir <b style="color:red">*</b> <i style="color: red;" title="Restara con los valores ingresados en los campos de trimestres, debe dar un Valor de Cero(0)."
                                        class="fas fa-question-circle"></i></label>
                                            <input id="cant_total_distribuir" value="100" onblur="calculo();"
                                                name="cant_total_distribuir" type="number" class="form-control"
                                                readonly >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label>Precio Total <b style="color:red">*</b></label><i style="color: red;" title="Ingrese el Costo Total del Servicio para realizar los siguientes cálculos."
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
                                    <option value="<?=$data['desc_alicuota_iva']?>/<?=$data['desc_porcentaj']?>">
                                        <?=$data['desc_porcentaj']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                <input id="iva_estimado" name="iva_estimado" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group col-3">
                                <label>Monto total Estimado<b style="color:red">*</b></label>
                                <input id="monto_estimado" name="monto_estimado" type="text" class="form-control" readonly>
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
                                <input id="estimado_total_t" name="estimado_total_t" type="text" class="form-control"readonly>
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_acc_servicio();" id="guardar" name="guardar"
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
                                <th style="color:white;" colspan="5">Información de la Obra</th>
                                <th style="color:white;" colspan="2">Fecha estimada de Ejecución Obra</th>
                                <th style="color:white;" colspan="6">Distribución Porcentual de la Ejecución Trimestral</th>
                                <th style="color:white;" colspan="1">Costos Estimados</th>
                                <th style="color:white;"></th>

                            </tr>

                            <tr style="text-align:center">
                                <th style="color:white;">ID</th>
                                <th style="color:white;">Partida Pres.</th>
                                <th style="color:white;">Tipo de Obra</th>
                                <th style="color:white;">Esp.</th>
                                <th style="color:white;">Unid. Medida</th>
                                <th style="color:white;">Fecha Desde</th>
                                <th style="color:white;">Fecha Hasta</th>
                                <th style="color:white;">%I</th>
                                <th style="color:white;">%II</th>
                                <th style="color:white;">%III</th>
                                <th style="color:white;">%IV</th>                              
                                <th style="color:white;">Precio Total</th>
                                <th style="color:white;">IVA </th>
                                <th style="color:white;">Monto Iva Est.</th>
                                <th style="color:white;">Monto Total Est.</th>
                                <!-- <th style="color:white;">Acción</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($accion as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_p_items']?> </td>
                                <td><?=$data['codigopartida_presupuestaria']?> </td>
                                <td><?=$data['descripcion_tip_obr']?> </td>
                                <td><?=$data['especificacion']?> </td>
                                <td><?=$data['desc_unidad_medida']?> </td>
                                <td><?=$data['fecha_desde']?> </td>
                                <td><?=$data['fecha_hasta']?> </td>
                                <td><?=$data['i']?> </td>
                                <td><?=$data['ii']?> </td>
                                <td><?=$data['iii']?> </td>
                                <td><?=$data['iv']?> </td>
                                <td><?=$data['precio_total']?> </td>
                                <td><?=$data['alicuota_iva']?> </td>
                                <td><?=$data['iva_estimado']?> </td>
                                <td><?=$data['monto_estimado']?> </td>
                                <!-- <td class="center">
                                     <a onclick="modal(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                        data-target="#myModal_bienes" style="color: white">
                                        <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                            style="color: darkgreen;"></i>
                                    </a> -->

                                    <!-- <a href="<?php echo base_url();?>index.php/programacion/editar_item_servicio_acc?id=<?php echo $data['id_p_items'];?>/<?php echo $data['id_p_items'];?>"
                                            class="button">
                                            <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                            style="color: darkgreen;"></i>
                                        <a /> 
                                        <a onclick="eliminar_items_servi(<?php echo $data['id_p_items'];?>);"
                                         class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"></i><a />
                                   
                                </td> --> 
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL PARA EDITAR INFORMACION DE CADA FILA -->

    

    <!-- ////////////////////////////////////////////GUARDA MAS ITEM EN LA BD DE SERVICIOS -->
    <!-- <script src="<?=base_url()?>/js/programacion.js"></script> -->
<script src="<?=base_url()?>/js/calculos.js"></script>
<!-- <script src="<?=base_url()?>/js/servicio/agregar_ff.js"></script>
<script src="<?=base_url()?>/js/servicio/agregar_ip.js"></script>
<script src="<?=base_url()?>/js/servicio/registro.js"></script> -->

    <script src="<?=base_url()?>/js/obra/guardar_acc_obras.js"></script>



    <script src="<?=base_url()?>/js/eliminar.js"></script>

  


    <!-- <script src="<?=base_url()?>/js/bien/llenar_editar_acc_b.js"></script> -->
    <!-- <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_edit.js"></script>
    <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_ff.js"></script> -->

    <!-- <script src="<?=base_url()?>/js/bien/calculos_bienes_edit.js"></script> -->
