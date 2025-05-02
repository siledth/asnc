<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Resultado del llamado</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-12  form-group">

                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            </div>
                            <?php foreach ($inf_1 as $inf_1): ?>
                            <div class="col-12  form-group">

                                <label>Número de Proceso <b style="color:red">*</b></label>
                                <input id="numero_proceso" name="numero_proceso" value="<?= $inf_1['numero_proceso'] ?>"
                                    type="text" class="form-control" readonly>

                            </div>
                            <div class="col-12  form-group">
                                <label>Para Enviar (Notificar) la Información ingresada <b
                                        style="color:red">*</b></label>

                                <!-- <a title="Enviar" onclick="enviar(<?php echo $inf_1['numero_proceso']; ?>);"
                                                class="button">
                                                <i class="fas fa-lg fa-fw fa-upload" style="color: green;"></i>
                                                <a /> -->
                                <a title="Enviar" onclick="enviar('<?php echo $inf_1['numero_proceso']; ?>');"
                                    class="button">
                                    <i class="fas fa-lg fa-fw fa-upload" style="color: green;"></i>
                                    <a />
                                    <!-- <a href="#" onclick="show_modal('Accion2?id=ISA-2023-31', 'Acción 2', 'modal-100p');" class="btn btn-primary btn-sm">Acción 2</a> -->



                                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">

                            </div>
                            <?php endforeach; ?>
                            <div class="col-12  form-group">
                                <div class="row">
                                    <div class="col-12  form-group">
                                        <label>Seleccione una Acción a Cargar</label>
                                        <select id="acc_cargar" name="acc_cargar" class="select2 form-control"
                                            onclick="llenar_();">
                                            <option value="0">Seleccione</option>
                                            <option value="2">Desierto</option>
                                            <option value="1">Adjudicado</option>
                                        </select>
                                    </div>

                                    <div class="col-6 mt-3 form-group" id="acc_s" style="display:none;">
                                        <label>Artículo 113. El contratante deberá declarar desierta la contratación
                                            cuando:<b style="color:red">*</b></label><br>
                                        <select class="form-control" name="selec_acc" id="selec_acc"
                                            onclick="selectipo();">
                                            <option value="0">Seleccione</option>

                                            <option value="1"> 1. Ninguna oferta haya sido presentada.</option>
                                            <option value="2">2. Todas las ofertas resulten rechazadas o los oferentes
                                                descalificados, de conformidad con lo establecido en el pliego de
                                                condiciones.</option>
                                            <option value="3">3. Esté suficientemente justificado que de continuar el
                                                procedimiento podría causarse perjuicio al contratante.</option>
                                            <option value="4">4. En caso de que los oferentes beneficiarios de la
                                                primera, segunda y tercera opción no mantengan su oferta,
                                                se nieguen a firmar el contrato, no suministren las garantías requeridas
                                                o le sea anulada la adjudicación por
                                                haber suministrado información falsa.</option>
                                            <option value="5">5. Ocurra algún otro supuesto expresamente previsto en el
                                                pliego de condiciones.”</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6" id='campos3' style="display: none;">

                                        <div class="row ">
                                            <label>Indique una Observaciòn (Obligatorio) <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" onkeypress="may(this);" type="text"
                                                name="observacion" id="observacion">


                                        </div>
                                    </div>

                                    <div class="form-group col-12" id="campos" style="display:none;">
                                        <div class="form-group col-6">
                                            <label>Selecciona<b style="color:red">*</b></label><br>

                                            <select id="total" name="total" class="select2 form-control">
                                                <option value="0">Seleccione</option>
                                                <option value="1">Total</option>
                                                <option value="2">Parcial</option>
                                            </select>
                                        </div>


                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Es obligatorio Ingrese Rif del Contratista Completo<i
                                                            style="color: red;"
                                                            title="Ingrese el Rif del Contratista, para continuar."
                                                            class="fas fa-question-circle">Leer*</i></label>
                                                    <input class="form-control" type="text" name="rif_b" id="rif_b"
                                                        onkeypress="may(this);" placeholder="J123456789"
                                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                                        onKeyUp="this.value=this.value.toUpperCase();"
                                                        onblur="consultar_rif();">


                                                </div>


                                            </div>
                                        </div>

                                        <div class="form-group col-12" id='existe' style="display: none;">
                                            <label>Ingrese Rif del contratista <i style="color: red;"
                                                    title="Ingrese el Rif del Contratista"
                                                    class="fas fa-question-circle"></i></label>
                                            <div class="row">

                                                <div class="form-group col-3">
                                                    <label>Rif del Contratista</label>
                                                    <input class="form-control" type="text" name="sel_rif_nombre5"
                                                        id="sel_rif_nombre5" readonly>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Denominación o Razón Social</label>
                                                    <input type="text" name="nombre_conta_5" id="nombre_conta_5"
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12" id='no_existe' style="display: none;">

                                            <div class="row">
                                                <div class="col-4">
                                                    <label>Ingrese Rif del contratista <i style="color: red;"
                                                            title="Ingrese el Rif del contratista, sin guiones ni punto."
                                                            class="fas fa-question-circle"></i></label>
                                                    <input title="Debe ingresar una palabra para realizar la busqueda"
                                                        type="text" class="form-control"
                                                        onKeyUp="this.value=this.value.toUpperCase();" name="rif_55"
                                                        id="rif_55"
                                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                                </div>
                                                <div class="col-8">
                                                    <label>Razón Social <b style="color:red">*</b> </label>
                                                    <input id="razon_social" name="razon_social" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">

                                            <div class="row">

                                                <div class="form-group col-3">
                                                    <label>Objeto de Contratación</label>
                                                    <select class="form-control" name="selec_obj" id="selec_obj">
                                                        <option value="0">Seleccione</option>
                                                        <option value="1">Bien</option>
                                                        <option value="2">Servicio</option>
                                                        <option value="3">Obra</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Nro. de Contrato<b style="color:red">*</b></label>
                                                    <input id="num_con" name="num_con" type="text" class="form-control">

                                                </div>
                                                <div class="form-group col-6">
                                                    <label> Monto de la Contratación Adjudicada en Bs. y/o $<b
                                                            style="color:red">*</b></label>
                                                    <input type="text" class="form-control"
                                                        oninput="return valideKey(event);" name="total_rendi5"
                                                        id="total_rendi5">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label> Paridad de cambio<b style="color:red">*</b></label>
                                                    <input id="paridad_rendi5" name="paridad_rendi5"
                                                        onkeypress="return valideKey(event);"
                                                        onblur="calculos_rendi_bienessacc();" class="form-control">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                                    <input id="subtotal_rendi5" name="subtotal_rendi5"
                                                        onkeyup="verif();" class="form-control" readonly>
                                                </div>
                                                <div class="form-group col-3">
                                                    <label> fecha referencial de la paridad<b
                                                            style="color:red">*</b></label>
                                                    <input id="fecha_paridad" name="fecha_paridad" type="date"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>


                                    </div>

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
                        <table id="data-tablepdf" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr>
                                    <th>Organo </th>
                                    <th>Numero proceso</th>
                                    <th>Accion</th>
                                    <th>articulo 113</th>
                                    <th>adjudicado</th>
                                    <th>Contrastista</th>
                                    <th>Objeto</th>
                                    <th># contrato</th>
                                    <th>Monto Contrato</th>
                                    <th>Paridad</th>
                                    <th>Total paridad</th>
                                    <th>Fecha paridad</th>
                                    <th>Total</th>


                                    <th>Notificado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($llamadot as $data): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?= $data['rif_organoente'] ?> </td>
                                    <td><?= $data['numero_proceso'] ?> </td>
                                    <td><?= $data['desc_acciones'] ?> </td>
                                    <?php if ($data['id_accion_cargar'] == 2) : ?>
                                    <td><?= $data['desc_articulo113'] ?> /<?= $data['observacion_desierto'] ?> </td>

                                    <?php else: ?>

                                    <td>No Aplica</td>

                                    <?php endif; ?>

                                    <td><?= $data['desc_adjudicado'] ?> </td>
                                    <?php if ($data['exit_rnc'] == 1) : ?>
                                    <td><?= $data['sel_rif_nombre'] ?> /<?= $data['nombre_contratista'] ?> </td>

                                    <?php else: ?>

                                    <td style="color: red;"><?= $data['rif_contr_no_rnc'] ?>
                                        /<?= $data['razon_social_no_rnc'] ?> </td>


                                    <?php endif; ?>
                                    <?php if ($data['id_accion_cargar'] == 2) : ?>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <?php else: ?>
                                    <td><?= $data['desc_objeto_contrata'] ?></td>
                                    <td><?= $data['num_contrato'] ?></td>
                                    <td><?= $data['monto_contrato'] ?></td>
                                    <td><?= $data['paridad'] ?></td>
                                    <td><?= $data['total_contrato'] ?></td>
                                    <td><?= $data['fecha_paridad'] ?></td>




                                    <?php endif; ?>
                                    <?php if ($data['id_accion_cargar'] == 2) : ?>
                                    <td>No Aplica</td>


                                    <?php else: ?>

                                    <td><?= number_format($results_2['total_mas_iva'], 2, ',', '.') ?></td>

                                    <?php endif; ?>


                                    <td><?= $data['desc_status_snc'] ?> </td>


                                    <td>
                                        <?php if ($data['id_accion_cargar'] == 2) : ?>


                                        <?php else: ?>
                                        <a class="button">
                                            <i title="Editar" onclick="modal_ver(<?php echo $data['id_accion'] ?>);"
                                                data-toggle="modal" data-target="#exampleModal"
                                                class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                            <a />
                                            <?php endif; ?>

                                            <!-- <a class="button"><i onclick="eliminar_b(<?php echo $data['id_accion'] ?>);" class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a/> -->
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3 row">
                <label class="col-md-4 col-form-label"> Total </label>
                <div class="col-md-8">
                    <div class="input-group ">
                        <input class="form-control text-center" type="text"
                            value="<?= number_format($results_2['total_mas_iva'], 2, ',', '.') ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Número de Contrato</h5>
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
                                <label>Número de proceso</label>
                                <input class="form-control" type="text" onkeypress="return valideKey(event);"
                                    name="cod_banco_edit" id="cod_banco_edit" readonly>
                            </div>
                            <div class="form-group col-8">
                                <label>Número de Contrato </label>
                                <input type="text" class="form-control" onkeypress="may(this);" id="nombre_banco_edit"
                                    name="nombre_banco_edit">
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

    <!-- <script src="<?= base_url() ?>/js/comision/comision.js"> -->
    <script src="<?= base_url() ?>/js/accion/accion1.js"></script>






    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#id_miembro4").select2({
            dropdownParent: $("#academico")
        });
    });
    </script>