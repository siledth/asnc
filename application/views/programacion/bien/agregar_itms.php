<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Cotinuar la carga de la programación</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                        <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                        <p class="f-s-16">RIF.: <?=$rif?> <br>
                            Código ONAPRE: <?=$codigo_onapre?> <br>
                            Año: <b><?=$anio?></b></p>
                        <input type="hidden" id="id_programacion" name="id_programacion"
                            value="<?=$id_programacion?>/<?=$id_p_proyecto?>">
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                <?php foreach($inf_1 as $inf_1):?><?php endforeach;?>

                <div class="col-9 mt-2 form-group">
                    <label>Nombre del Proyecto <b style="color:red">*</b></label>
                    <input id="nombre_proyecto_a" name="nombre_proyecto_a" value="<?=$inf_1['nombre_proyecto']?>"
                        type="text" class="form-control" readonly>
                </div>

                <div class="form-group mt-2 col-3">
                    <label>Objeto de Contratación</label><br>
                    <input type="hidden" id="id_obj_comercial" name="id_obj_comercial"
                        value="<?=$inf_1['id_obj_comercial']?>">
                    <input type="text" id="desc_objeto_contrata" name="desc_objeto_contrata"
                        value="<?=$inf_1['desc_objeto_contrata']?>" class="form-control" readonly>
                </div>
                <div class="col-12">
                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                </div>

                <form class="form-horizontal" id="guardar_tcu" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h4 style="color:red;">Información Items Fuente Financiamiento (IFF)</h4>
                            </div>
                            <input type="hidden" id="id_programacion" name="id_programacion"
                                value="<?=$id_programacion?>/<?=$id_p_proyecto?>">
                            <div class="form-group col-12">
                                <label>Partida Presupuestaria</label><br>
                                <input type="hidden" name="par_presupuestaria_acc_ff" id="par_presupuestaria_acc_ff">
                                <select style="width: 100%;" id="par_presupuestaria_acc" name="par_presupuestaria_acc"
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
                                <label>Porcentaje<b style="color:red">*</b></label>
                                <input id="porcentaje_acc" name="porcentaje_acc" type="text" class="form-control">
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
                                            name="ccnu_b" id="ccnu_b" onblur="buscar_ccnnu();">
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
                                    <option value="<?=$data['id_unidad_medida']?>/<?=$data['desc_unidad_medida']?>">
                                        <?=$data['desc_unidad_medida']?></option>
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
                                    <option value="<?=$data['desc_alicuota_iva']?>/<?=$data['desc_porcentaj']?>">
                                        <?=$data['desc_porcentaj']?></option>
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
                        <button type="button" onclick="guardar_tc();" id="guardar" name="guardar"
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
                                    <th style="color:white;" >I</th>
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
                            <?php foreach($proyecto as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_p_items']?> </td>
                                    <td><?=$data['codigopartida_presupuestaria']?> </td>
                                    <td><?=$data['desc_ccnu']?> </td>
                                    <td><?=$data['especificacion']?> </td>
                                    <td><?=$data['desc_unidad_medida']?> </td>
                                    <td><?=$data['cantidad']?> </td>
                                    <td><?=$data['i']?> </td>
                                    <td><?=$data['ii']?> </td>
                                    <td><?=$data['iii']?> </td>
                                    <td><?=$data['iv']?> </td>
                                    <td><?=$data['cant_total_distribuir']?> </td>
                                    <td><?=$data['costo_unitario']?> </td>
                                    <td><?=$data['precio_total']?> </td>
                                    <td><?=$data['alicuota_iva']?> </td>
                                    <td><?=$data['iva_estimado']?> </td>
                                    <td><?=$data['monto_estimado']?> </td>
                                     <td class="center">
                                        <a class="button">
                                            <i title="Editar"
                                                onclick="modal_ver_tc(<?php echo $data['codigopartida_presupuestaria']?>);"
                                                data-toggle="modal" data-target="#exampleModal"
                                                class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                            <a />
                                            <a class="button"><i
                                                    onclick="eliminar_tc(<?php echo $data['codigopartida_presupuestaria']?>);"
                                                    class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a />
                                    </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
          
        </div>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Anulación de Desempeño</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-sortable-id="form-validation-1">
                    <form class="form-horizontal" id="editar" data-parsley-validate="true" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-4">
                                <label>ID Tipo de Cuenta</label>
                                <input class="form-control" type="text" name="id" id="id" readonly>
                            </div>
                            <div class="col-8"></div>
                            <div class="form-group col-12">
                                <label>Tipo de Cuenta </label>
                                <input type="text" class="form-control" onkeypress="may(this);" id="tipo_cuenta_edit"
                                    name="tipo_cuenta_edit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="editar_tc();" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>/js/bien/llenar_editar_proy_b.js"></script>
    <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_edit.js"></script>
    <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_ff.js"></script>
    <script src="<?=base_url()?>/js/bien/calculos_bienes_edit.js"></script>


    <script src="<?=base_url()?>/js/bien/cargar_mas_item.js"></script>