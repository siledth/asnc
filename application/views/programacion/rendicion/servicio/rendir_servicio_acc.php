<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Rendir Servicio Acc</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                        <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                        <p class="f-s-16">RIF.: <?=$rif?> <br>
                            Código ONAPRE: <?=$codigo_onapre?> <br>
                            <?=$id_programacion?>


                            <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                <?php foreach($inf_1_acc as $inf_1_acc):?><?php endforeach;?>

                <div class="col-4   form-group">
                    <label>Acción Centralizada<b style="color:red">*</b></label><br>
                    <select style="width: 100%;" name="id_accion_centralizada" id="id_accion_centralizada"
                        class="default-select2 form-control" readonly>
                        <option value="<?=$inf_1_acc['id_accion_centralizada']?>">
                            <?=$inf_1_acc['desc_accion_centralizada']?></option>

                    </select>
                </div>

                <div class="col-4   form-group">
                    <label>Objeto de Contratación</label><br>
                    <input type="hidden" id="id_obj_comercial" name="id_obj_comercial"
                        value="<?=$inf_1_acc['id_obj_comercial']?>">
                    <input type="text" id="desc_objeto_contrata" name="desc_objeto_contrata"
                        value="<?=$inf_1_acc['desc_objeto_contrata']?>" class="form-control" readonly>
                </div>
                <div class="col-12">
                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                </div>


            </div>
            <div class="form-group col 12 text-center">
                <a class="btn btn-success" href="<?php echo base_url();?>index.php/Programacion/hojaEnBlanco"
                    target="_blank">
                    Generar hoja en blanco
                </a>
            </div>
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <!-- <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%"> -->
                    <table id="data-table-default" data-order='[[ 0, "desc" ]]'
                        class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">
                                <th style="color:white;" colspan="5">Información del Servicio</th>
                                <th style="color:white;" colspan="2">Fecha estimada de Ejecución Servicio</th>
                                <th style="color:white;" colspan="4">Distribución Porcentual de la Ejecución Trimestral
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
                                <th style="color:white;">% a Ejecutar I</th>
                                <th style="color:white;"> % a Ejecutar II</th>
                                <th style="color:white;">% a Ejecutar III</th>
                                <th style="color:white;">% a Ejecutar IV</th>
                                <th style="color:white;">Costo Unit.</th>
                                <th style="color:white;">Precio Total</th>
                                <th style="color:white;">IVA </th>
                                <th style="color:white;">Monto Iva Est.</th>
                                <th style="color:white;">Monto Total Est.</th>
                                <th style="color:white;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rendir_serv_acc as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_p_items']?> </td>
                                <td><?=$data['codigopartida_presupuestaria']?> </td>
                                <td><?=$data['desc_ccnu']?> </td>
                                <td><?=$data['especificacion']?> </td>
                                <td><?=$data['desc_unidad_medida']?> </td>
                                <td><?=$data['fecha_desde']?> </td>
                                <td><?=$data['fecha_hasta']?> </td>
                                <td><?=$data['i']?> </td>
                                <td><?=$data['ii']?> </td>
                                <td><?=$data['iii']?> </td>
                                <td><?=$data['iv']?> </td>
                                <td><?=$data['costo_unitario']?> </td>
                                <td><?=$data['precio_total']?> </td>
                                <td><?=$data['alicuota_iva']?> </td>
                                <td><?=$data['iva_estimado']?> </td>
                                <td><?=$data['monto_estimado']?> </td>
                                <td class="center">
                                  
                                    <a onclick="modal(<?php echo $data['id_p_items'] ?>);" data-toggle="modal" data-target="#exampleModal" style="color: white">
                                    <i title="Editar" class="fas fa-registered fa-lg" title="Rendir" style="color: red;"
                                            style="color: darkgreen;"></i>
                                                            </a>

                               

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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rendir Items Servicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag"
                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        <div class="col-12">
                        <label style="color:red;">Ya ha rendido el Trimestre : <b style="color:red">*</b></label>
                           <input class="form-control" type="text" name="rendido" id="rendido" readonly>
                           
                           </div>
                           <div class="col-12">
                      
                           <label style="color:red;">Seleccione Trimestre (Obligatorio).leer <b style="color:red">*</b></label><i style="color: red;" title="Seleccione un Trimestre."
                                        class="fas fa-question-circle"></i>
                                <select class="form-control" name="llenar_trimestre" id="llenar_trimestre">
                                    <option value="0">Seleccione</option>                                   
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label>ID - ITEMS</label>
                                <input class="form-control" type="hidden" name="id_p_items" id="id_p_items" readonly>
                                <input class="form-control" type="hidden" name="id_enlace1"
                                    id="id_enlace1" readonly>
                                <input class="form-control" type="hidden" name="id_accion_centralizada1"
                                    id="id_accion_centralizada1" readonly>
                                <input class="form-control" type="text" name="desc_accion_centralizada1"
                                    id="desc_accion_centralizada1" readonly>
                                <input class="form-control" type="hidden" name="id_obj_comercial2" id="id_obj_comercial2"
                                    readonly>
                                <input class="form-control" type="text" name="desc_objeto_contrata2"
                                    id="desc_objeto_contrata2" readonly>

                                <input class="form-control" type="hidden" name="id_programacion2" id="id_programacion2"
                                    readonly>
                                <input class="form-control" type="text" name="id_estado" id="id_estado" readonly>
                                <input class="form-control" type="hidden" name="id_fuente_financiamiento"
                                    id="id_fuente_financiamiento" readonly>
                               
                            </div>
                            <div class="form-group col-4">
                                <label>Cod. Partida Presupuestaria</label>
                                <input type="hidden" name="id_part_pres_b" id="id_part_pres_b">
                                <input id="codigopartida_presupuestaria" name="codigopartida_presupuestaria"
                                    class="form-control" class="form-control" readonly>
                                <input id="desc_partida_presupuestaria" name="desc_partida_presupuestaria"
                                    class="form-control" class="form-control" readonly>
                                    <input class="form-control" type="text" name="desc_fuente_financiamiento"
                                    id="desc_fuente_financiamiento" readonly>
                                <input class="form-control" type="text" name="porcentaje" id="porcentaje" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>CCNU</label>
                                <input type="text" class="form-control" name="codigo_ccnu" id="codigo_ccnu" readonly>
                                <input type="text" class="form-control" name="desc_ccnu" id="desc_ccnu" readonly>
                                <label>Especificación</label>
                                <input type="text" class="form-control" name="especificacion" id="especificacion"
                                    readonly>

                            </div>
                            <div class="form-group col-2">
                                <label>UND.</label>
                                <input type="text" class="form-control" name="unid_med_b" id="unid_med_b" readonly>
                                <input type="hidden" name="id_unid_med_b" id="id_unid_med_b" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label>Fecha de Ejecución Servicio Desde</label>
                                <input type="text" class="form-control" name="fecha_desde" id="fecha_desde" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label>Fecha de Ejecución Servicio Hasta</label><br>
                                <input type="text" class="form-control" name="fecha_hasta" id="fecha_hasta" readonly>
                            </div>

                            <div class="card card-outline-black">
                                <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b>
                                </h5>
                                <div class="row ">
                                    <div class="form-group col-1">
                                        <label>Cantidad<b style="color:red">*</b></label>
                                        <input id="cantidad_mod_b" name="cantidad_mod_b" onblur="calcular_mod_bienes();"
                                            class="form-control" onkeypress="return valideKey(event);" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>I Trimestre</label>
                                        <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                            onblur="calcular_mod_bienes();" name="primero_b" id="primero_b" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>II Trimestre</label>
                                        <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                            onblur="calcular_mod_bienes();" name="segundo_b" id="segundo_b" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>III Trimestre</label>
                                        <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                            onblur="calcular_mod_bienes();" name="tercero_b" id="tercero_b" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>IV Trimestre</label>
                                        <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                            onblur="calcular_mod_bienes();" name="cuarto_b" id="cuarto_b" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Cantd. resta <b style="color:red">*</b></label>
                                        <input id="cant_total_distribuir_mod_b" name="cant_total_distribuir_mod_b"
                                            onkeyup="verif();" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-3">
                                <label>Precio Total Estimado<b style="color:red">*</b></label>
                                <input id="precio_total_mod_b" name="precio_total_mod_b" type="text"
                                    class="form-control" readonly>
                            </div>

                            <div class="form-group col-3">
                                <label>Alícuota IVA Estimado<b style="color:red">*</b></label>
                                <input type="text" class="form-control" onblur="calcular_mod_bienes();"
                                    name="ali_iva_e_b" id="ali_iva_e_b" readonly>
                            </div>
                            <div class="form-group col-3">
                                <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                <input id="iva_estimado_mod_b" name="iva_estimado_mod_b" type="text"
                                    class="form-control" readonly>
                            </div>
                            <div class="form-group col-3">
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
                                <input id="estimado_segundo" name="estimado_ii" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Est. III Trimestre</label>
                                <input id="estimado_tercer" name="estimado_iii" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group col-2">
                                <label>Est. IV Trimestre</label>
                                <input id="estimado_cuarto" name="estimado_iV" type="text" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group col-4">
                                <label>Est. Total Trimestres</label>
                                <input id="estimado_total_t_mod" name="estimado_total_t" type="text"
                                    class="form-control" readonly>
                            </div>
                            <div class="card card-outline-danger">
                                <h5 class="mt-3 text-center"><b>Ejecutado</b></h5>
                                <div class="row ">
                                    <div class="form-group col-2">
                                        <label>Precio (costo del servicio)</label>
                                        <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                            onblur="calculos_rendi_servicio();" name="precio_rend_ejecu"
                                            id="precio_rend_ejecu">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>ALÍCUOTA IVA <br><br></label>
                                        <select class="form-control" name="selc_iva_rendi" id="selc_iva_rendi"
                                            onchange="calculos_rendi_servicio();">
                                            <option value="s">Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                        <input id="iva_estimado_rend" name="iva_estimado_rend" type="text"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>TOTAL <br><br></label>
                                        <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                            onblur="calculos_rendi_servicio();" name="total_rendi" id="total_rendi"
                                            readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                        <input id="paridad_rendi" name="paridad_rendi"
                                            onkeypress="return valideKey(event);" onblur="calculos_rendi_servicio();"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                        <input id="subtotal_rendi" name="subtotal_rendi" onkeyup="verif();"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-4">
                                        <label> PROCEDIMIENTO DE CONTRATACIÓN </label>
                                        <select class="form-control" name="modalida_rendi" id="modalida_rendi">
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Ingrese Rif del contratista <i style="color: red;"
                                                title="Para llenar el campo de contratista debe ingresar el rif del contratista, esto buscara al contratista para mostrarlo en el select"
                                                class="fas fa-question-circle"></i></label>
                                        <div class="row">
                                            <div class="col-4">
                                                <input title="Debe ingresar una palabra para realizar la busqueda"
                                                    type="text" class="form-control"
                                                    onKeyUp="this.value=this.value.toUpperCase();" name="rif_nombre"
                                                    id="rif_nombre" onblur="buscar_rif();"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                            </div>
                                            <div class="col-8">
                                                <select
                                                    title="Depende de la palabra ingresada en el campo anterior, se listaran las opciones."
                                                    class="form-control" name="sel_rif_nombre" id="sel_rif_nombre">
                                                    <option value="0">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>NÚMERO DE CONTRATO <b style="color:red">*</b> <br><br></label>
                                        <input id="num_contrato" name="num_contrato" class="form-control">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>FECHA (OC, OS, CONTRATO) <b style="color:red">*</b> <br><br></label>
                                        <input type="date" id="fecha_contrato" name="fecha_contrato"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>TIPO DOCUMENTO CONTRATACIÓN </label>
                                        <select class="form-control" name="selc_tipo_doc_contrata"
                                            id="selc_tipo_doc_contrata" onchange="calculos_rendi_servicio();">
                                            <option value="s">Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>COMPROMISO DE RESPONSABILIDAD SOCIAL </label>
                                        <select class="form-control" name="selc_com_res_social" id="selc_com_res_social"
                                            onchange="calculos_rendi_servicio();">
                                            <option value="s">Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>MONTO 3% CRS <b style="color:red">*</b><br><br></label>
                                        <input id="monto3_rendi" name="monto3_rendi" onkeyup="verif();"
                                            class="form-control" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="card card-outline-green">
                                <h5 class="mt-3 text-center"><b>FACTURACIÓN Y PAGO</b></h5>
                                <div class="row ">
                                    <div class="form-group col-2">
                                        <label>N° FACTURA<b style="color:red">*</b><br><br></label>
                                        <input id="nfactura_rendi" name="nfactura_rendi" class="form-control">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>FECHA DE LA FACTURA</label>
                                        <input type="date" class="form-control" name="datefactura_rendi"
                                            id="datefactura_rendi">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>BASE IMPONIBLE <br><br></label>
                                        <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                            onblur="calculos_rendi_servicio();" name="base_imponible_rendi"
                                            id="base_imponible_rendi">
                                    </div>

                                    <div class="form-group col-2">
                                        <label>ALÍCUOTA IVA <br><br></label>
                                        <select class="form-control" name="selc_iva_rendi2" id="selc_iva_rendi2"
                                            onchange="calculos_rendi_servicio();">
                                            <option value="s">Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>MONTO FACTURA</label>
                                        <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                            onblur="calculos_rendi_servicio();" name="monto_factura_rend"
                                            id="monto_factura_rend">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>TOTAL PAGO <b style="color:red">*</b><br><br></label>
                                        <input id="total_pago_rendi" name="total_pago_rendi"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                        <input id="paridad_rendi_factura" name="paridad_rendi_factura"
                                            onkeypress="return valideKey(event);" onblur="calculos_rendi_servicio();"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                        <input id="subtotal_rendi_factura" name="subtotal_rendi_factura"
                                            onkeyup="verif();" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>FECHA DEL PAGO</label>
                                        <input type="date" class="form-control" name="fecha_pago_rendi"
                                            id="fecha_pago_rendi">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_pago_fin" onclick="guardar_proc_pago();"
                        class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    
    <!-- ////// modal -->
    <script src="<?=base_url()?>/js/servicio/rendicion/modalrend_servicioacc.js"></script>
    
 
    <script src="<?=base_url()?>/js/calculos.js"></script>
    <!-- <script src="<?=base_url()?>/js/servicio/agregar_ff.js"></script>
<script src="<?=base_url()?>/js/servicio/agregar_ip.js"></script>
<script src="<?=base_url()?>/js/servicio/registro.js"></script> -->

    <script src="<?=base_url()?>/js/servicio/Guardar_mas_item_acc_servicio.js"></script>



    <script src="<?=base_url()?>/js/eliminar.js"></script>




    <!-- <script src="<?=base_url()?>/js/bien/llenar_editar_acc_b.js"></script> -->
    <!-- <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_edit.js"></script>
    <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_ff.js"></script> -->

    <!-- <script src="<?=base_url()?>/js/bien/calculos_bienes_edit.js"></script> -->