<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Miembros de Comisión</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                      


                            <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
          
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <table id="data-table-default" data-order='[[ 0, "asc" ]]'
                        class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">
                                <th style="color:white;">ID</th>
                                <th style="color:white;">Cedula</th>
                                <th style="color:white;">Nombre</th>
                               
                                <th style="color:white;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ver as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_miembros']?> </td>
                                <td><?=$data['cedula']?> </td>
                                <td><?=$data['nombre']?> </td>
                                <td class="center">
                                    <!-- <a onclick="modal(<?php echo $data['id_miembros'] ?>);" data-toggle="modal"
                                        data-target="#myModal_bienes" style="color: white">
                                        <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                            style="color: darkgreen;"></i>
                                    </a>
                                    <a onclick="eliminar_items_bienes(<?php echo $data['id_miembros'];?>);"
                                         class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"></i><a /> -->
                                </td>
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
                    <h4 class="modal-title">Editar Items de Bienes</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        <input type="hidden" class="form-control" name="id_items_b" id="id_items_b">
                        <div class="form-group col-3">
                            <label>ID - ITEMS</label>
                            <input class="form-control" type="text" name="id_p_items" id="id_p_items" readonly>
                        </div>
                        <div class="form-group col-9">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b" id="id_part_pres_b">
                            <input id="codigopartida_presupuestaria" name="codigopartida_presupuestaria" class="form-control"
                                class="form-control" disabled>
                                <input id="desc_partida_presupuestaria" name="desc_partida_presupuestaria" class="form-control"
                                class="form-control" disabled>
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

                        <!-- <div class="form-group col-12">
                            <label>Cambiar CCNU <i style="color: red;"
                                    title="Para llenar el campo de CCNU debe ingresar una palabra clave, esto le ayudara con la busqueda"
                                    class="fas fa-question-circle"></i></label>
                            <div class="row">
                                <div class="col-4">
                                    <input title="Debe ingresar una palabra para realizar la busqueda" type="text"
                                        class="form-control" onKeyUp="this.value=this.value.toUpperCase();"
                                        name="ccnu_b_m_b" id="ccnu_b_m_b" onblur="buscar_ccnnu_m_b();">
                                </div>
                                <div class="col-8">
                                    <select
                                        title="Depende de la palabra ingresada en el campo anterior, se listaran las opciones."
                                        class="form-control" name="sel_ccnu_b_m_b" id="sel_ccnu_b_m_b">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group col-6">
                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion" id="especificacion">
                        </div>
                        
                        <div class="form-group col-3">
                            <label>Unidad de Medida</label>
                            <input type="text" class="form-control" name="unid_med_b" id="unid_med_b" disabled>
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
                                        onkeyup="verif();" class="form-control" disabled>
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
                                disabled>
                        </div>

                        <div class="form-group col-4">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
                            <div class="row">
                                <div class="col-5">
                                    <input type="text" class="form-control" onblur="calcular_mod_bienes();"
                                        name="ali_iva_e_b" id="ali_iva_e_b" disabled>
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
                                disabled>
                        </div>
                        <div class="form-group col-6">
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado_mod_b" name="monto_estimado_mod_b" type="text"
                                class="form-control" disabled>
                        </div>
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-2">
                            <label>Est. I Trimestre</b></label>
                            <input id="estimado_primer" name="estimado_i" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. II Trimestre</label>
                            <input id="estimado_segundo" name="estimado_ii" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. III Trimestre</label>
                            <input id="estimado_tercer" name="estimado_iii" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. IV Trimestre</label>
                            <input id="estimado_cuarto" name="estimado_iV" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label>Est. Total Trimestres</label>
                            <input id="estimado_total_t_mod" name="estimado_total_t" type="text" class="form-control"
                                disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="guardar_tabla_b1();"
                            data-dismiss="modal">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /////////////////////////////editar items de bienes -->
    <script src="<?=base_url()?>/js/bien/modal_editar_items_bienes.js"></script>
    <!-- /////////////////////////////editar items de bienes -->
    <script src="<?=base_url()?>/js/bien/llenar_editar_proy_b.js"></script>
    <script src="<?=base_url()?>/js/bien/calculos_bienes_edit.js"></script>

    <script src="<?=base_url()?>/js/bien/guardaritmccs.js"></script>
    <script src="<?=base_url()?>/js/eliminar.js"></script>