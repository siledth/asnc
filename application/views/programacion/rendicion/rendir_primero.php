<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                                    <p class="f-s-16">RIF.: <?=$rif?> <br>
                                        Código ONAPRE: <?=$codigo_onapre?> <br>
                                        Año: <b><?=$anio?></b></p>
                                    <input type="hidden" id="id_programacion" name="id_programacion"
                                        value="<?=$id_programacion?>">
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="row">
                            <div class="col-4">
                                <button
                                    onclick="location.href='<?php echo base_url()?>index.php/Programacion/ver_rendicion_realizadas?id=<?php echo $id_programacion;?>'"
                                    type="button" class="btn btn-lg btn-default" name="button">
                                    Ver items Rendidos 1 er trimestres
                                </button>
                                <input type="hidden" id="id_programacion" name="id_programacion"
                                    value="<?=$id_programacion?>">
                            </div>
                            <div class="col-4">

                                <label>Total Partida presupuestaria</label>
                                <input type="hidden" name="id_part_pres_b5" id="id_part_pres_b5">
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center">Tabla Referente a Proyectos para Rendir</h3>
                        <table id="data-table-default" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>id</th>
                                    <th>Nombre Proyecto</th>
                                    <th>CCNU</th>
                                    <th>Objeto de Contratación</th>

                                    <th>Rendir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_proyectos as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$data['id_p_items']?> </td>
                                    <td><?=$data['nombre_proyecto']?> </td>
                                    <?php if ($data['id_ccnu'] == 0) : ?>
                                    <td>Obra</td>

                                    <?php else: ?>
                                    <td><?=$data['desc_ccnu']?> </td>
                                    <?php endif; ?>
                                    <td><?=$data['desc_objeto_contrata']?> </td>

                                    <td class="center">


                                        <?php if ($data['id_obj_comercial'] == 1) : ?>
                                        <a onclick="modal_bienespy(<?php echo $data['id_p_items'] ?>);"
                                            data-toggle="modal" data-target="#bienespy" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($data['id_obj_comercial'] == 2) : ?>
                                        <a onclick="modal_servi_py(<?php echo $data['id_p_items'] ?>);"
                                            data-toggle="modal" data-target="#serv_pro" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($data['id_obj_comercial'] == 3) : ?>
                                        <a onclick="modal_obraspy(<?php echo $data['id_p_items'] ?>);"
                                            data-toggle="modal" data-target="#obrapy" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Tabla Referente a Acción Centralizada Registradas Rendir</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">

                                    <th>id</th>
                                    <th>Objeto de Contratación</th>
                                    <th>partida presupuestaria</th>
                                    <th>Especificación</th>
                                    <th>CCNU</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_acc_centralizada as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <?php if (($data['estatus_rendi'] >= 1) ) : ?>

                                    <td style="color:red;"><?=$data['id_p_items']?> </td>
                                    <td style="color:red;"><?=$data['desc_objeto_contrata']?> </td>
                                    <td style="color:red;"><?=$data['desc_partida_presupuestaria']?> </td>
                                    <td style="color:red;"><?=$data['especificacion']?> </td>
                                    <?php if ($data['id_ccnu'] == 0) : ?>
                                    <td style="color:red;">Obra</td>

                                    <?php else: ?>
                                    <td style="color:red;"><?=$data['desc_ccnu']?> </td>
                                    <?php endif; ?>
                                    <td class="center">
                                        <?php if ($data['id_obj_comercial'] == 1) : ?>
                                        <a onclick="modal_bienes(<?php echo $data['id_p_items'] ?>);"
                                            data-toggle="modal" data-target="#bienes" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($data['id_obj_comercial'] == 2) : ?>
                                        <a onclick="modal(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                            data-target="#exampleModal" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($data['id_obj_comercial'] == 3) : ?>
                                        <a onclick="modal_obras(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                            data-target="#obra" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <?php else: ?>

                                    <td><?=$data['id_p_items']?> </td>
                                    <td><?=$data['desc_objeto_contrata']?> </td>
                                    <td><?=$data['desc_partida_presupuestaria']?> </td>
                                    <td><?=$data['especificacion']?> </td>
                                    <?php if ($data['id_ccnu'] == 0) : ?>
                                    <td>Obra</td>

                                    <?php else: ?>
                                    <td><?=$data['desc_ccnu']?> </td>
                                    <?php endif; ?>

                                    <td class="center">
                                        <?php if ($data['id_obj_comercial'] == 1) : ?>
                                        <a onclick="modal_bienes(<?php echo $data['id_p_items'] ?>);"
                                            data-toggle="modal" data-target="#bienes" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($data['id_obj_comercial'] == 2) : ?>
                                        <a onclick="modal(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                            data-target="#exampleModal" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($data['id_obj_comercial'] == 3) : ?>
                                        <a onclick="modal_obras(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                            data-target="#obra" style="color: white">
                                            <i title="Rendir" class="fas fa-registered fa-lg" title="Rendir"
                                                style="color: red;" style="color: darkgreen;"></i>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <?php endif; ?>
                                </tr>

                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                            href="javascript:history.back()"> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- servicios acc -->
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
                <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <label style="color:red;">Ya ha rendido el Trimestre : <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="rendido" id="rendido" readonly>
                            <input class="form-control" type="hidden" name="rendidoa" id="rendidoa" readonly>

                        </div>
                        <div class="col-12">

                            <label style="color:red;">Seleccione Trimestre (Obligatorio).leer <b
                                    style="color:red">*</b></label><i style="color: red;"
                                title="Seleccione un Trimestre." class="fas fa-question-circle"></i>
                            <select class="form-control" name="llenar_trimestre" id="llenar_trimestre">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-5">
                            <label>Acción Centralizada</label>
                            <input class="form-control" type="hidden" name="id_p_items" id="id_p_items" readonly>
                            <input class="form-control" type="hidden" name="id_enlace1" id="id_enlace1" readonly>
                            <input class="form-control" type="hidden" name="id_accion_centralizada1"
                                id="id_accion_centralizada1" readonly>
                            <input class="form-control" type="text" name="desc_accion_centralizada1"
                                id="desc_accion_centralizada1" readonly>

                        </div>
                        <div class="form-group col-4">
                            <label>Objeto Comercial</label>
                            <input class="form-control" type="hidden" name="id_obj_comercial2" id="id_obj_comercial2"
                                readonly>
                            <input class="form-control" type="text" name="desc_objeto_contrata2"
                                id="desc_objeto_contrata2" readonly>
                            <input class="form-control" type="hidden" name="id_programacion2" id="id_programacion2"
                                readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Estado</label>
                            <input class="form-control" type="text" name="id_estado" id="id_estado" readonly>
                            <input class="form-control" type="hidden" name="id_fuente_financiamiento"
                                id="id_fuente_financiamiento" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b" id="id_part_pres_b">
                            <input id="codigopartida_presupuestaria" name="codigopartida_presupuestaria"
                                class="form-control" class="form-control" readonly>
                        </div>
                        <div class="form-group col-8">
                            <label>Descripción Partida Presupuestaria</label>
                            <input id="desc_partida_presupuestaria" name="desc_partida_presupuestaria"
                                class="form-control" class="form-control" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Fuente Financiamiento</label>
                            <input class="form-control" type="text" name="desc_fuente_financiamiento"
                                id="desc_fuente_financiamiento" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Porcentaje</label>
                            <input class="form-control" type="text" name="porcentaje" id="porcentaje" readonly>
                        </div>

                        <div class="form-group col-12">
                            <label>CCNU</label>
                            <input type="text" class="form-control" name="codigo_ccnu" id="codigo_ccnu" readonly>
                            <input type="text" class="form-control" name="desc_ccnu" id="desc_ccnu" readonly>
                        </div>

                        <div class="form-group col-10">
                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion" id="especificacion" readonly>

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
                            <input id="precio_total_mod_b" name="precio_total_mod_b" type="text" class="form-control"
                                readonly>
                        </div>

                        <div class="form-group col-3">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label>
                            <input type="text" class="form-control" onblur="calcular_mod_bienes();" name="ali_iva_e_b"
                                id="ali_iva_e_b" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado_mod_b" name="iva_estimado_mod_b" type="text" class="form-control"
                                readonly>
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
                        <div class="card card-outline-danger">
                            <h5 class="mt-3 text-center"><b>Contratado</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>Cantidad % ejecutada</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="cantidad0" id="cantidad0">
                                </div>
                                <div class="form-group col-2">
                                    <label>Costo Unitario Contratado</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_servicio();" name="precio_rend_ejecu"
                                        id="precio_rend_ejecu">
                                </div>
                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi" id="selc_iva_rendi"
                                        onchange="calculos_rendi_servicio();">
                                        <option value="0">Seleccione</option>
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
                                    <input id="paridad_rendi" name="paridad_rendi" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_servicio();" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi" name="subtotal_rendi" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label> PROCEDIMIENTO DE CONTRATACIÓN </label><br><br>
                                    <select class="form-control" onclick="llenar_sub_mod0();" name="modalida_rendi"
                                        id="modalida_rendi">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Supuestos del Procedimiento de la Selección del Contratista: <b
                                            title="Campo Obligatorio" style="color:red">*</b></label>
                                    <select class="form-control" name="id_sub_modalidad0" id="id_sub_modalidad0">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Ingrese Rif del Contratista <i style="color: red;"
                                                    title="Ingrese el Rif del Contratista, para continuar."
                                                    class="fas fa-question-circle">Leer*</i></label>
                                            <input class="form-control" type="text" name="rif_b0" id="rif_b0"
                                                onkeypress="may(this);" placeholder="J123456789"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                                onKeyUp="this.value=this.value.toUpperCase();"
                                                onblur="consultar_rif0();">


                                        </div>
                                        <!-- <div class="form-group col-2">
                                        <label><i style="color: red;"
                                            title="Clic para Buscar  Rif del Contratista"
                                            class="fas fa-question-circle"></i></label>
                                            <button type="button" class="btn btn-default" onclick="consultar_rif();" name="button"> <i class="fas fa-search"></i> </button>

                                        </div> -->

                                    </div>
                                </div>
                                <!-- <div class="form-group col-12">

                                    <label>Selecione Contratista <i style="color: red;"
                                            title="Seleccione Una Opción, obligatorio"
                                            class="fas fa-question-circle"></i></label>
                                    <select class="form-control" name="id_tipo_pago0" id="id_tipo_pago0"
                                        onclick="llenar_pago0();">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Registrada en SNC</option>
                                        <option value="2">No Registrada en SNC</option>

                                    </select>
                                </div> -->
                                <div class="form-group col-12" id='existe0' style="display: none;">

                                    <!-- <div class="form-group col-12"> -->
                                    <label>Ingrese Rif del contratista <i style="color: red;"
                                            title="Para llenar el campo de contratista debe ingresar el rif del contratista, esto buscara al contratista para mostrarlo en el select"
                                            class="fas fa-question-circle"></i></label>
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Rif del Contratista</label>
                                            <input class="form-control" type="text" name="sel_rif_nombre"
                                                id="sel_rif_nombre" readonly>

                                        </div>
                                        <div class="col-8">
                                            <label>Denominación o Razón Social</label>
                                            <input type="text" name="nombre_conta_0" id="nombre_conta_0"
                                                class="form-control" readonly>


                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12" id='no_existe0' style="display: none;">

                                    <div class="row">
                                        <div class="col-4">
                                            <label>Ingrese Rif del contratista <i style="color: red;"
                                                    title="Ingrese el Rif del contratista, sin guiones ni punto."
                                                    class="fas fa-question-circle"></i></label>
                                            <input title="Debe ingresar una palabra para realizar la busqueda"
                                                type="text" class="form-control"
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_50" id="rif_50"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-8">
                                            <label>Razón Social <b style="color:red">*</b> </label>
                                            <input id="razon_social50" name="razon_social50" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label>NÚMERO DE CONTRATO <b style="color:red">*</b> <br><br></label>
                                    <input id="num_contrato" name="num_contrato" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA (OC, OS, CONTRATO) <b style="color:red">*</b> <br><br></label>
                                    <input type="date" id="fecha_contrato" name="fecha_contrato" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>TIPO DOCUMENTO CONTRATACIÓN </label>
                                    <select class="form-control" name="selc_tipo_doc_contrata"
                                        id="selc_tipo_doc_contrata" onchange="calculos_rendi_servicio();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="form-group col-12">
                            <label>¿Desea Registrar Facturación y Pago? </label>
                            <select class="form-control" name="facturacion0" id="facturacion0"
                                onclick="llenar_factura0();">
                                <option value="0">Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">NO</option>

                            </select>
                        </div>
                        <div class="card card-outline-green" id='campos6' style="display: none;">

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
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO FACTURA</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_servicio();" name="monto_factura_rend"
                                        id="monto_factura_rend" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL PAGO <b style="color:red">*</b><br><br></label>
                                    <input id="total_pago_rendi" name="total_pago_rendi" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi_factura" name="paridad_rendi_factura"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_servicio();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi_factura" name="subtotal_rendi_factura" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DEL PAGO</label>
                                    <input type="date" class="form-control" name="fecha_pago_rendi"
                                        id="fecha_pago_rendi">
                                </div>
                                <div class="form-group col-2">
                                    <label>COMPROMISO DE RESPONSABILIDAD SOCIAL </label>
                                    <select class="form-control" name="selc_com_res_social" id="selc_com_res_social"
                                        onchange="calculos_rendi_servicio();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO 3% CRS <b style="color:red">*</b><br><br></label>
                                    <input id="monto3_rendi" name="monto3_rendi" onkeyup="verif();"
                                        class="form-control">
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
<!-- modal obras acc-->
<div class="modal fade" id="obra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rendir Items Obras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="rendirobra3" name="rendirobra3" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <label style="color:red;">Ya ha rendido el Trimestre : <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="rendido3" id="rendido3" readonly>
                            <input class="form-control" type="hidden" name="rendid3" id="rendid3" readonly>

                        </div>
                        <div class="col-12">

                            <label style="color:red;">Seleccione Trimestre (Obligatorio).leer <b
                                    style="color:red">*</b></label><i style="color: red;"
                                title="Seleccione un Trimestre." class="fas fa-question-circle"></i>
                            <select class="form-control" name="llenar_trimestre3" id="llenar_trimestre3">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>ID - ITEMS</label>
                            <input class="form-control" type="hidden" name="id_p_items3" id="id_p_items3" readonly>
                            <input class="form-control" type="hidden" name="id_enlace3" id="id_enlace3" readonly>
                            <input class="form-control" type="hidden" name="id_accion_centralizada3"
                                id="id_accion_centralizada3" readonly>
                            <input class="form-control" type="text" name="desc_accion_centralizada3"
                                id="desc_accion_centralizada3" readonly>
                            <input class="form-control" type="hidden" name="id_obj_comercial3" id="id_obj_comercial3"
                                readonly>
                            <input class="form-control" type="text" name="desc_objeto_contrata3"
                                id="desc_objeto_contrata3" readonly>

                            <input class="form-control" type="hidden" name="id_programacion3" id="id_programacion3"
                                readonly>
                            <input class="form-control" type="text" name="id_estado3" id="id_estado3" readonly>
                            <input class="form-control" type="hidden" name="id_fuente_financiamiento3"
                                id="id_fuente_financiamiento3" readonly>

                        </div>
                        <div class="form-group col-6">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b3" id="id_part_pres_b3">
                            <input id="codigopartida_presupuestaria3" name="codigopartida_presupuestaria3"
                                class="form-control" class="form-control" readonly>
                            <input id="desc_partida_presupuestaria3" name="desc_partida_presupuestaria3"
                                class="form-control" class="form-control" readonly>
                            <label>Fuente Financiamiento</label>
                            <input class="form-control" type="text" name="desc_fuente_financiamiento3"
                                id="desc_fuente_financiamiento3" readonly>
                            <input class="form-control" type="text" name="porcentaje3" id="porcentaje3" readonly>
                        </div>
                        <div class="form-group col-6">

                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion3" id="especificacion3"
                                readonly>

                        </div>
                        <div class="form-group col-6">


                            <label>UND.</label>
                            <input type="text" class="form-control" name="unid_med_b3" id="unid_med_b3" readonly>
                            <input type="hidden" name="id_unid_med_b3" id="id_unid_med_b3" readonly>

                        </div>
                        <div class="form-group col-6">
                            <label>Tipo de Obra</label>
                            <input type="hidden" class="form-control" name="id_tip_obra" id="id_tip_obra" readonly>
                            <input type="text" class="form-control" name="descripcion_tip_obr" id="descripcion_tip_obr"
                                readonly>

                        </div>

                        <div class="form-group col-3">
                            <label>Alcance de la Obra</label>
                            <input type="hidden" class="form-control" name="id_alcance_obra" id="id_alcance_obra"
                                readonly>
                            <input type="text" class="form-control" name="descripcion_alcance_obra"
                                id="descripcion_alcance_obra" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Objeto de obra</label>
                            <input type="hidden" class="form-control" name="id_obj_obra" id="id_obj_obra" readonly>
                            <input type="text" class="form-control" name="descripcion_obj_obra"
                                id="descripcion_obj_obra" readonly>
                        </div>

                        <div class="form-group col-3">
                            <label>Fecha de Ejecución obra Desde</label>
                            <input type="text" class="form-control" name="fecha_desde3" id="fecha_desde3" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Fecha de Ejecución obra Hasta</label><br>
                            <input type="text" class="form-control" name="fecha_hasta3" id="fecha_hasta3" readonly>
                        </div>

                        <div class="card card-outline-black">
                            <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b>
                            </h5>
                            <div class="row ">
                                <div class="form-group col-1">

                                    <input type="hidden" id="cantidad_mod_b3" name="cantidad_mod_b3"
                                        onblur="calcular_mod_bienes();" class="form-control"
                                        onkeypress="return valideKey(event);" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>I Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="primero_b3" id="primero_b3" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>II Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="segundo_b3" id="segundo_b3" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>III Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="tercero_b3" id="tercero_b3" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>IV Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="cuarto_b3" id="cuarto_b3" readonly>
                                </div>
                                <div class="form-group col-2">

                                    <input type="hidden" id="cant_total_distribuir_mod_b3"
                                        name="cant_total_distribuir_mod_b3" onkeyup="verif();" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label>Precio Total Estimado<b style="color:red">*</b></label>
                            <input id="precio_total_mod_b3" name="precio_total_mod_b3" type="text" class="form-control"
                                readonly>
                        </div>

                        <div class="form-group col-3">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label>
                            <input type="text" class="form-control" onblur="calcular_mod_bienes();" name="ali_iva_e_b3"
                                id="ali_iva_e_b3" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado_mod_b3" name="iva_estimado_mod_b3" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado_mod_b3" name="monto_estimado_mod_b3" type="text"
                                class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-2">
                            <label>Est. I Trimestre</b></label>
                            <input id="estimado_primer3" name="estimado_i3" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. II Trimestre</label>
                            <input id="estimado_segundo3" name="estimado_ii3" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. III Trimestre</label>
                            <input id="estimado_tercer3" name="estimado_iii3" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. IV Trimestre</label>
                            <input id="estimado_cuarto3" name="estimado_iV3" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Est. Total Trimestres</label>
                            <input id="estimado_total_t_mod3" name="estimado_total_t3" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="card card-outline-danger">
                            <h5 class="mt-3 text-center"><b>Contratado</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>Cantidad % ejecutada</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="cantidad3" id="cantidad3">
                                </div>
                                <div class="form-group col-2">
                                    <label>Precio (costo del servicio)</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_obritas();" name="precio_rend_ejecu3"
                                        id="precio_rend_ejecu3">
                                </div>
                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi3" id="selc_iva_rendi3"
                                        onchange="calculos_rendi_obritas();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                    <input id="iva_estimado_rend3" name="iva_estimado_rend3" type="text"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_obritas();" name="total_rendi3" id="total_rendi3"
                                        readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi3" name="paridad_rendi3"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_obritas();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi3" name="subtotal_rendi3" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label> PROCEDIMIENTO DE CONTRATACIÓN </label><br><br>
                                    <select class="form-control" onclick="llenar_sub_mod3();" name="modalida_rendi3"
                                        id="modalida_rendi3">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Supuestos del Procedimiento de la Selección del Contratista: <b
                                            title="Campo Obligatorio" style="color:red">*</b></label>
                                    <select class="form-control" name="id_sub_modalidad3" id="id_sub_modalidad3">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>Ingrese Rif del Contratista <i style="color: red;"
                                            title="Ingrese el Rif del Contratista, para continuar."
                                            class="fas fa-question-circle">Leer*</i></label>
                                    <input class="form-control" type="text" name="rif_b3" id="rif_b3"
                                        onkeypress="may(this);" placeholder="J123456789"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                        onKeyUp="this.value=this.value.toUpperCase();" onblur="consultar_rif3();">


                                </div>
                                <div class="form-group col-12" id='existe3' style="display: none;">

                                    <label>Ingrese Rif del contratista <i style="color: red;"
                                            title="Para llenar el campo de contratista debe ingresar el rif del contratista, esto buscara al contratista para mostrarlo en el select"
                                            class="fas fa-question-circle"></i></label>
                                    <div class="row">
                                        <div class="col-4">
                                            <input class="form-control" type="text" name="sel_rif_nombre3"
                                                id="sel_rif_nombre3" readonly>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" name="nombre_conta_3" id="nombre_conta_3"
                                                class="form-control" readonly>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12" id='no_existe3' style="display: none;">

                                    <div class="row">
                                        <div class="col-4">
                                            <label>Ingrese Rif del contratista <i style="color: red;"
                                                    title="Ingrese el Rif del contratista, sin guiones ni punto."
                                                    class="fas fa-question-circle"></i></label>
                                            <input title="Debe ingresar una palabra para realizar la busqueda"
                                                type="text" class="form-control"
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_3" id="rif_3"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-8">
                                            <label>Razón Social <b style="color:red">*</b> </label>
                                            <input id="razon_social3" name="razon_social3" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label>NÚMERO DE CONTRATO <b style="color:red">*</b> <br><br></label>
                                    <input id="num_contrato3" name="num_contrato3" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA (OC, OS, CONTRATO) <b style="color:red">*</b> <br><br></label>
                                    <input type="date" id="fecha_contrato3" name="fecha_contrato3" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>TIPO DOCUMENTO CONTRATACIÓN </label>
                                    <select class="form-control" name="selc_tipo_doc_contrata3"
                                        id="selc_tipo_doc_contrata3" onchange="calculos_rendi_obritas();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="form-group col-12">
                            <label>¿Desea Registrar Facturación y Pago? </label>
                            <select class="form-control" name="facturacion3" id="facturacion3"
                                onclick="llenar_factura3();">
                                <option value="0">Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">NO</option>

                            </select>
                        </div>
                        <div class="card card-outline-green" id='campos9' style="display: none;">

                            <h5 class="mt-3 text-center"><b>FACTURACIÓN Y PAGO</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>N° FACTURA<b style="color:red">*</b><br><br></label>
                                    <input id="nfactura_rendi3" name="nfactura_rendi3" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DE LA FACTURA</label>
                                    <input type="date" class="form-control" name="datefactura_rendi3"
                                        id="datefactura_rendi3">
                                </div>
                                <div class="form-group col-2">
                                    <label>BASE IMPONIBLE <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_obritas();" name="base_imponible_rendi3"
                                        id="base_imponible_rendi3">
                                </div>

                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi4" id="selc_iva_rendi4"
                                        onchange="calculos_rendi_obritas();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO FACTURA</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_obritas();" name="monto_factura_rend3"
                                        id="monto_factura_rend3" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL PAGO <b style="color:red">*</b><br><br></label>
                                    <input id="total_pago_rendi3" name="total_pago_rendi3" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi_factura3" name="paridad_rendi_factura3"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_obritas();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL PAGO US$ <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi_factura3" name="subtotal_rendi_factura3"
                                        onkeyup="verif();" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DEL PAGO</label>
                                    <input type="date" class="form-control" name="fecha_pago_rendi3"
                                        id="fecha_pago_rendi3">
                                </div>
                                <div class="form-group col-2">
                                    <label>COMPROMISO DE RESPONSABILIDAD SOCIAL </label>
                                    <select class="form-control" name="selc_com_res_social3" id="selc_com_res_social3"
                                        onchange="calculos_rendi_obritas();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO 3% CRS <b style="color:red">*</b><br><br></label>
                                    <input id="monto3_rendi3" name="monto3_rendi3" onkeyup="verif();"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_pago_fin" onclick="rendirobras();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- modal Bienes acc-->
<div class="modal fade" id="bienes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rendir Items Bienes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="rendi_bienes1" name="rendi_bienes1" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <label style="color:red;">Ya ha rendido el Trimestre : <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="rendido5" id="rendido5" readonly>
                            <input class="form-control" type="hidden" name="rendidoa5" id="rendidoa5" readonly>

                        </div>
                        <div class="col-12">

                            <label style="color:red;">Seleccione Trimestre (Obligatorio).leer <b
                                    style="color:red">*</b></label><i style="color: red;"
                                title="Seleccione un Trimestre." class="fas fa-question-circle"></i>
                            <select class="form-control" name="llenar_trimestre5" id="llenar_trimestre5">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label>Acción Centralizada</label>
                            <input class="form-control" type="hidden" name="id_p_items5" id="id_p_items5" readonly>
                            <input class="form-control" type="hidden" name="id_enlace5" id="id_enlace5" readonly>
                            <input class="form-control" type="hidden" name="id_accion_centralizada5"
                                id="id_accion_centralizada5" readonly>
                            <input class="form-control" type="text" name="desc_accion_centralizada5"
                                id="desc_accion_centralizada5" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Objeto Comercial</label>
                            <input class="form-control" type="hidden" name="id_obj_comercial5" id="id_obj_comercial5"
                                readonly>
                            <input class="form-control" type="text" name="desc_objeto_contrata5"
                                id="desc_objeto_contrata5" readonly>
                            <input class="form-control" type="hidden" name="id_programacion5" id="id_programacion5"
                                readonly>


                        </div>
                        <div class="form-group col-3">
                            <label>Estado</label>
                            <input class="form-control" type="text" name="id_estado5" id="id_estado5" readonly>
                            <input class="form-control" type="hidden" name="id_fuente_financiamiento5"
                                id="id_fuente_financiamiento5" readonly>

                        </div>
                        <div class="form-group col-12">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b5" id="id_part_pres_b5">
                            <input id="codigopartida_presupuestaria5" name="codigopartida_presupuestaria5"
                                class="form-control" class="form-control" readonly>
                            <input id="desc_partida_presupuestaria5" name="desc_partida_presupuestaria5"
                                class="form-control" class="form-control" readonly>

                        </div>
                        <div class="form-group col-4">
                            <label>Fuente Financiamiento</label>

                            <input class="form-control" type="text" name="desc_fuente_financiamiento5"
                                id="desc_fuente_financiamiento5" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Porcentaje</label>
                            <input class="form-control" type="text" name="porcentaje5" id="porcentaje5" readonly>
                        </div>

                        <div class="form-group col-6">
                            <label>CCNU</label>
                            <input type="text" class="form-control" name="codigo_ccnu5" id="codigo_ccnu5" readonly>
                            <input type="text" class="form-control" name="desc_ccnu5" id="desc_ccnu5" readonly>


                        </div>
                        <div class="form-group col-4">

                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion5" id="especificacion5"
                                readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>UND.</label>
                            <input type="text" class="form-control" name="unid_med_b5" id="unid_med_b5" readonly>
                            <input type="hidden" name="id_unid_med_b5" id="id_unid_med_b5" readonly>

                        </div>

                        <div class="card card-outline-black">
                            <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b>
                            </h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>Cantidad<b style="color:red">*</b></label>
                                    <input id="cantidad_mod_b5" name="cantidad_mod_b5" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>I Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="primero_b5" id="primero_b5" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>II Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="segundo_b5" id="segundo_b5" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>III Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="tercero_b5" id="tercero_b5" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>IV Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="cuarto_b5" id="cuarto_b5" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-2"><br>
                            <label>Costo Unitario<b style="color:red">*</b></label>
                            <input id="costo_unitario_mod_b5" name="costo_unitario_mod_b5" type="text"
                                class="form-control" readonly>
                        </div>
                        <div class="form-group col-2"><br>
                            <label>Sub Total<b style="color:red">*</b></label>
                            <input id="subtbd" name="subtbd" type="text" class="form-control" readonly>
                            <input id="precio_total_mod_b5" name="precio_total_mod_b5" type="hidden"
                                class="form-control" readonly>
                        </div>

                        <div class="form-group col-2">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label>
                            <input type="text" class="form-control" name="ali_iva_e_b5" id="ali_iva_e_b5" readonly>
                        </div>
                        <div class="form-group col-3"><br>
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado_mod_b5" name="iva_estimado_mod_b5" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group col-3"><br>
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado_mod_b5" name="monto_estimado_mod_b5" type="text"
                                class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-2">
                            <label>Est. I Trimestre</b></label>
                            <input id="estimado_primer5" name="estimado_i5" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. II Trimestre</label>
                            <input id="estimado_segundo5" name="estimado_ii5" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. III Trimestre</label>
                            <input id="estimado_tercer5" name="estimado_iii5" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. IV Trimestre</label>
                            <input id="estimado_cuarto5" name="estimado_iV5" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Est. Total Trimestres</label>
                            <input id="estimado_total_t_mod5" name="estimado_total_t5" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="card card-outline-danger">
                            <h5 class="mt-3 text-center"><b>Contratado</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>Cantidad</label>
                                    <input id="cantidad_rendi5" name="cantidad_rendi5"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_bienessacc();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>Costo Unitario</label>
                                    <input id="costo_unitario_remd" name="costo_unitario_remd"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_bienessacc();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>Sub Total</label>
                                    <input type="text" class="form-control" name="subt_rend_ejecu" id="subt_rend_ejecu"
                                        readonly>
                                </div>

                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA </label>
                                    <select class="form-control" name="selc_iva_re" id="selc_iva_re"
                                        onchange="calculos_rendi_bienessacc();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>Monto IVA<b style="color:red">*</b></label>
                                    <input id="iva_estimado_red5" name="iva_estimado_red5" type="text"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL </label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="total_rendi5" id="total_rendi5" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi5" name="paridad_rendi5"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_bienessacc();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi5" name="subtotal_rendi5" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-4"><br>
                                    <label> PROCEDIMIENTO DE CONTRATACIÓN </label>
                                    <select class="form-control" name="modalida_rendi5" id="modalida_rendi5"
                                        onclick="llenar_sub_mod5();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Supuestos del Procedimiento de la Selección del Contratista: <b
                                            title="Campo Obligatorio" style="color:red">*</b></label>
                                    <select class="form-control" name="id_sub_modalidad5" id="id_sub_modalidad5">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Ingrese Rif del Contratista <i style="color: red;"
                                                    title="Ingrese el Rif del Contratista, para continuar."
                                                    class="fas fa-question-circle">Leer*</i></label>
                                            <input class="form-control" type="text" name="rif_b" id="rif_b"
                                                onkeypress="may(this);" placeholder="J123456789"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                                onKeyUp="this.value=this.value.toUpperCase();"
                                                onblur="consultar_rif();">


                                        </div>
                                        <!-- <div class="form-group col-2">
                                        <label><i style="color: red;"
                                            title="Clic para Buscar  Rif del Contratista"
                                            class="fas fa-question-circle"></i></label>
                                            <button type="button" class="btn btn-default" onclick="consultar_rif();" name="button"> <i class="fas fa-search"></i> </button>

                                        </div> -->

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
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_55" id="rif_55"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-8">
                                            <label>Razón Social <b style="color:red">*</b> </label>
                                            <input id="razon_social" name="razon_social" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label>NÚMERO DE CONTRATO <b style="color:red">*</b> <br><br></label>
                                    <input id="num_contrato5" name="num_contrato5" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA (OC, OS, CONTRATO) <b style="color:red">*</b> <br><br></label>
                                    <input type="date" id="fecha_contrato5" name="fecha_contrato5" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>TIPO DOCUMENTO CONTRATACIÓN </label>
                                    <select class="form-control" name="selc_tipo_doc_contrata5"
                                        id="selc_tipo_doc_contrata5" onchange="calculos_rendi_bienessacc();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="form-group col-12">
                            <label>¿Desea Registrar Facturación y Pago? </label>
                            <select class="form-control" name="facturacion5" id="facturacion5"
                                onclick="llenar_factura5();">
                                <option value="0">Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">NO</option>

                            </select>
                        </div>

                        <!-- opcional -->

                        <div class="card card-outline-green" id='campos3' style="display: none;">
                            <h5 class="mt-3 text-center"><b>FACTURACIÓN Y PAGO</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>N° FACTURA<b style="color:red">*</b><br><br></label>
                                    <input id="nfactura_rendi5" name="nfactura_rendi5" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DE LA FACTURA</label>
                                    <input type="date" class="form-control" name="datefactura_rendi5"
                                        id="datefactura_rendi5">
                                </div>
                                <div class="form-group col-2">
                                    <label>BASE IMPONIBLE <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_bieness();" name="base_imponible_rendi5"
                                        id="base_imponible_rendi5">
                                </div>

                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi55" id="selc_iva_rendi55"
                                        onchange="calculos_rendi_bienessacc();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO FACTURA</label>
                                    <input type="text" class="form-control" onblur="calculos_rendi_bienessacc();"
                                        name="monto_factura_rend5" id="monto_factura_rend5">
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL PAGO <b style="color:red">*</b><br><br></label>
                                    <input onblur="calculos_rendi_bienessacc();" id="total_pago_rendi5"
                                        name="total_pago_rendi5" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi_factura5" name="paridad_rendi_factura5"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_bienessacc();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi_factura5" name="subtotal_rendi_factura5"
                                        onkeyup="verif();" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>COMPROMISO DE RESPONSABILIDAD SOCIAL </label>
                                    <select class="form-control" name="selc_com_res_social5" id="selc_com_res_social5"
                                        onchange="calculos_rendi_bienessacc();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO 3% CRS <b style="color:red">*</b><br><br></label>
                                    <input id="monto3_rendibines" name="monto3_rendibines" onkeyup="verif();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DEL PAGO</label>
                                    <input type="date" class="form-control" name="fecha_pago_rendi5"
                                        id="fecha_pago_rendi5">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="rendi_bienes" onclick="rendi_bienes();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- modal Bienes py-->
<div class="modal fade" id="bienespy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rendir Items Bienes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="rendi_bienespy" name="rendi_bienespy" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <label style="color:red;">Ya ha rendido el Trimestre : <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="rendido7" id="rendido7" readonly>
                            <input class="form-control" type="text" name="rendid7" id="rendid7" readonly>

                        </div>
                        <div class="col-12">

                            <label style="color:red;">Nombre del proyecto <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="nombre_proyecto7" id="nombre_proyecto7"
                                readonly>
                        </div>
                        <div class="col-12">

                            <label style="color:red;">Seleccione Trimestre (Obligatorio).leer <b
                                    style="color:red">*</b></label><i style="color: red;"
                                title="Seleccione un Trimestre." class="fas fa-question-circle"></i>
                            <select class="form-control" name="llenar_trimestre7" id="llenar_trimestre7"
                                onblur="calculos_rendi_bieness();">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>ID - ITEMS</label>
                            <input class="form-control" type="text" name="id_p_items7" id="id_p_items7" readonly>
                            <input class="form-control" type="hidden" name="id_enlace7" id="id_enlace7" readonly>
                            <input class="form-control" type="hidden" name="id_obj_comercial7" id="id_obj_comercial7"
                                readonly>
                            <label>Objeto Contratación</label>
                            <input class="form-control" type="text" name="desc_objeto_contrata7"
                                id="desc_objeto_contrata7" readonly>

                            <input class="form-control" type="hidden" name="id_programacion7" id="id_programacion7"
                                readonly>
                            <label>estado</label>
                            <input class="form-control" type="text" name="id_estado7" id="id_estado7" readonly>
                            <input class="form-control" type="hidden" name="id_fuente_financiamiento7"
                                id="id_fuente_financiamiento7" readonly>
                            <label>UND.</label>
                            <input type="text" class="form-control" name="unid_med_b7" id="unid_med_b7" readonly>
                            <input type="hidden" name="id_unid_med_b7" id="id_unid_med_b7" readonly>

                        </div>
                        <div class="form-group col-4">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b7" id="id_part_pres_b7">
                            <input id="codigopartida_presupuestaria7" name="codigopartida_presupuestaria7"
                                class="form-control" class="form-control" readonly>
                            <input id="desc_partida_presupuestaria7" name="desc_partida_presupuestaria7"
                                class="form-control" class="form-control" readonly>
                            <label>Fuente Financinancamiento</label>
                            <input class="form-control" type="text" name="desc_fuente_financiamiento7"
                                id="desc_fuente_financiamiento7" readonly>
                            <label>Procentaje</label>
                            <input class="form-control" type="text" name="porcentaje7" id="porcentaje7" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>CCNU</label>
                            <input type="text" class="form-control" name="codigo_ccnu7" id="codigo_ccnu7" readonly>
                            <input type="text" class="form-control" name="desc_ccnu7" id="desc_ccnu7" readonly>
                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion7" id="especificacion7"
                                readonly>

                        </div>
                        <div class="card card-outline-black">
                            <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b>
                            </h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>Cantidad<b style="color:red">*</b></label>
                                    <input id="cantidad_mod_b7" name="cantidad_mod_b7" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>I Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="primero_b7" id="primero_b7" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>II Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="segundo_b7" id="segundo_b7" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>III Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="tercero_b7" id="tercero_b7" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>IV Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="cuarto_b7" id="cuarto_b7" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label>Costo Unitario<b style="color:red">*</b></label>
                            <input id="costo_unitario_mod_b7" name="costo_unitario_mod_b7" type="text"
                                class="form-control" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Sub Total<b style="color:red">*</b></label>
                            <input id="precio_total_mod_b7" name="precio_total_mod_b7" type="text" class="form-control"
                                readonly>

                        </div>

                        <div class="form-group col-3">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label>
                            <input type="text" class="form-control" name="ali_iva_e_b7" id="ali_iva_e_b7" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado_mod_b7" name="iva_estimado_mod_b7" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado_mod_b7" name="monto_estimado_mod_b7" type="text"
                                class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-2">
                            <label>Est. I Trimestre</b></label>
                            <input id="estimado_primer7" name="estimado_i7" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. II Trimestre</label>
                            <input id="estimado_segundo7" name="estimado_ii7" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. III Trimestre</label>
                            <input id="estimado_tercer7" name="estimado_iii7" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. IV Trimestre</label>
                            <input id="estimado_cuarto7" name="estimado_iV7" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Est. Total Trimestres</label>
                            <input id="estimado_total_t_mod7" name="estimado_total_t7" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="card card-outline-danger">
                            <h5 class="mt-3 text-center"><b>Contratado</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>Cantidad</label>
                                    <input id="cantidad_rendi7" name="cantidad_rendi7"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_bieness();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>Costo Unitario</label>
                                    <input id="costo_unitario_remd7" name="costo_unitario_remd7"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_bieness();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>Sub Total</label>
                                    <input type="text" class="form-control" name="subt_rend_ejecu7"
                                        id="subt_rend_ejecu7" readonly>
                                </div>

                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA </label>
                                    <select class="form-control" name="selc_iva_re7" id="selc_iva_re7"
                                        onchange="calculos_rendi_bieness();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>Monto IVA<b style="color:red">*</b></label>
                                    <input id="iva_estimado_red7" name="iva_estimado_red7" type="text"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="total_rendi7" id="total_rendi7" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi7" name="paridad_rendi7"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_bieness();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi7" name="subtotal_rendi7" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label> PROCEDIMIENTO DE CONTRATACIÓN </label><br><br>
                                    <select class="form-control" onclick="llenar_sub_mod7();" name="modalida_rendi7"
                                        id="modalida_rendi7">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Supuestos del Procedimiento de la Selección del Contratista: <b
                                            title="Campo Obligatorio" style="color:red">*</b></label>
                                    <select class="form-control" name="id_sub_modalidad7" id="id_sub_modalidad7">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">

                                <label>Ingrese Rif del Contratista <i style="color: red;"
                                                    title="Ingrese el Rif del Contratista, para continuar."
                                                    class="fas fa-question-circle">Leer*</i></label>
                                            <input class="form-control" type="text" name="rif_b7" id="rif_b7"
                                                onkeypress="may(this);" placeholder="J123456789"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                                onKeyUp="this.value=this.value.toUpperCase();"
                                                onblur="consultar_rif7();">

                                </div>

                                <div class="form-group col-12" id='existe7' style="display: none;">
                                    <label>Ingrese Rif del contratista <i style="color: red;"
                                            title="Ingrese el Rif del Contratista"
                                            class="fas fa-question-circle"></i></label>
                                    <div class="row">

                                        <div class="form-group col-3">
                                            <label>Rif del Contratista</label>
                                            <input class="form-control" type="text" name="sel_rif_nombre7"
                                                id="sel_rif_nombre7" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Denominación o Razón Social</label>
                                            <input type="text" name="nombre_conta_7" id="nombre_conta_7"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12" id='no_existe7' style="display: none;">

                                    <div class="row">
                                        <div class="col-4">
                                            <label>Ingrese Rif del contratista <i style="color: red;"
                                                    title="Ingrese el Rif del contratista, sin guiones ni punto."
                                                    class="fas fa-question-circle"></i></label>
                                            <input title="Debe ingresar una palabra para realizar la busqueda"
                                                type="text" class="form-control"
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_7" id="rif_7"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-8">
                                            <label>Razón Social <b style="color:red">*</b> </label>
                                            <input id="razon_social7" name="razon_social7" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label>NÚMERO DE CONTRATO <b style="color:red">*</b> <br><br></label>
                                    <input id="num_contrato7" name="num_contrato7" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA (OC, OS, CONTRATO) <b style="color:red">*</b> <br><br></label>
                                    <input type="date" id="fecha_contrato7" name="fecha_contrato7" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>TIPO DOCUMENTO CONTRATACIÓN </label>
                                    <select class="form-control" name="selc_tipo_doc_contrata7"
                                        id="selc_tipo_doc_contrata7" onchange="calculos_rendi_servicio();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="form-group col-12">
                            <label>¿Desea Registrar Facturación y Pago? </label>
                            <select class="form-control" name="facturacion7" id="facturacion7"
                                onclick="llenar_factura7();">
                                <option value="0">Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">NO</option>

                            </select>
                        </div>
                        <div class="card card-outline-green" id='campo7' style="display: none;">
                      
                            <h5 class="mt-3 text-center"><b>FACTURACIÓN Y PAGO</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>N° FACTURA<b style="color:red">*</b><br><br></label>
                                    <input id="nfactura_rendi7" name="nfactura_rendi7" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DE LA FACTURA</label>
                                    <input type="date" class="form-control" name="datefactura_rendi7"
                                        id="datefactura_rendi7">
                                </div>
                                <div class="form-group col-2">
                                    <label>BASE IMPONIBLE <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_bieness();" name="base_imponible_rendi7"
                                        id="base_imponible_rendi7">
                                </div>

                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi7" id="selc_iva_rendi7"
                                        onchange="calculos_rendi_bieness();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO FACTURA</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_bieness();" name="monto_factura_rend7"
                                        id="monto_factura_rend7" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL PAGO <b style="color:red">*</b><br><br></label>
                                    <input id="total_pago_rendi7" name="total_pago_rendi7" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi_factura7" name="paridad_rendi_factura7"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_bieness();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi_factura7" name="subtotal_rendi_factura7"
                                        onkeyup="verif();" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DEL PAGO</label>
                                    <input type="date" class="form-control" name="fecha_pago_rendi7"
                                        id="fecha_pago_rendi7">
                                </div>
                                <div class="form-group col-2">
                                    <label>COMPROMISO DE RESPONSABILIDAD SOCIAL </label>
                                    <select class="form-control" name="selc_com_res_social7" id="selc_com_res_social7"
                                        onchange="calculos_rendi_servicio();">
                                        <option value="0">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO 3% CRS <b style="color:red">*</b><br><br></label>
                                    <input id="monto3_rendibines7" name="monto3_rendibines7" onkeyup="verif();"
                                        class="form-control" >
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="rendi_bienes_py" onclick="rendi_bienes_py();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- servicios PY -->
<div class="modal fade" id="serv_pro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rendir Items Servicio Proyecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="serviciopy" name="serviciopy" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">

                            <label style="color:red;">Nombre del proyecto <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="nombre_proyecto9" id="nombre_proyecto9"
                                readonly>
                        </div>
                        <div class="col-12">
                            <label style="color:red;">Ya ha rendido el Trimestre : <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="rendido8" id="rendido8" readonly>
                            <input class="form-control" type="text" name="rendid8" id="rendid8" readonly>


                        </div>
                        <div class="col-12">

                            <label style="color:red;">Seleccione Trimestre (Obligatorio).leer <b
                                    style="color:red">*</b></label><i style="color: red;"
                                title="Seleccione un Trimestre." class="fas fa-question-circle"></i>
                            <select class="form-control" name="llenar_trimestre8" id="llenar_trimestre8">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>ID - ITEMS</label>
                            <input class="form-control" type="hidden" name="id_p_items8" id="id_p_items8" readonly>
                            <input class="form-control" type="hidden" name="id_enlace8" id="id_enlace8" readonly>
                            <input class="form-control" type="hidden" name="id_obj_comercial8" id="id_obj_comercial8"
                                readonly>
                            <input class="form-control" type="text" name="desc_objeto_contrata8"
                                id="desc_objeto_contrata8" readonly>

                            <input class="form-control" type="hidden" name="id_programacion8" id="id_programacion8"
                                readonly>
                            <input class="form-control" type="text" name="id_estado8" id="id_estado8" readonly>
                            <input class="form-control" type="hidden" name="id_fuente_financiamiento8"
                                id="id_fuente_financiamiento8" readonly>

                        </div>
                        <div class="form-group col-4">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b8" id="id_part_pres_b8">
                            <input id="codigopartida_presupuestaria8" name="codigopartida_presupuestaria8"
                                class="form-control" class="form-control" readonly>
                            <label>Descripción Partida Presupuestaria</label>
                            <input id="desc_partida_presupuestaria8" name="desc_partida_presupuestaria8"
                                class="form-control" class="form-control" readonly>
                            <label>Descripción Fuente Financiamiento</label>
                            <input class="form-control" type="text" name="desc_fuente_financiamiento8"
                                id="desc_fuente_financiamiento8" readonly>
                            <label>Procentaje ff</label>
                            <input class="form-control" type="text" name="porcentaje8" id="porcentaje8" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>CCNU</label>
                            <input type="text" class="form-control" name="codigo_ccnu8" id="codigo_ccnu8" readonly>
                            <label>Descripción CCNU</label>
                            <input type="text" class="form-control" name="desc_ccnu8" id="desc_ccnu8" readonly>
                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion8" id="especificacion8"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>UND.</label>
                            <input type="text" class="form-control" name="unid_med_b8" id="unid_med_b8" readonly>
                            <input type="hidden" name="id_unid_med_b8" id="id_unid_med_b8" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de Ejecución Servicio Desde</label>
                            <input type="text" class="form-control" name="fecha_desde8" id="fecha_desde8" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de Ejecución Servicio Hasta</label><br>
                            <input type="text" class="form-control" name="fecha_hasta8" id="fecha_hasta8" readonly>
                        </div>

                        <div class="card card-outline-black">
                            <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b>
                            </h5>
                            <div class="row ">

                                <div class="form-group col-2">
                                    <label>I Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        name="primero_b8" id="primero_b8" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>II Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="segundo_b8" id="segundo_b8" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>III Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="tercero_b8" id="tercero_b8" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>IV Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="cuarto_b8" id="cuarto_b8" readonly>
                                </div>

                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label>Precio Total Estimado<b style="color:red">*</b></label>
                            <input id="precio_total_mod_b8" name="precio_total_mod_b8" type="text" class="form-control"
                                readonly>
                        </div>

                        <div class="form-group col-3">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label>
                            <input type="text" class="form-control" onblur="calcular_mod_bienes();" name="ali_iva_e_b8"
                                id="ali_iva_e_b8" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado_mod_b8" name="iva_estimado_mod_b8" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado_mod_b8" name="monto_estimado_mod_b8" type="text"
                                class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-2">
                            <label>Est. I Trimestre</b></label>
                            <input id="estimado_primer8" name="estimado_i8" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. II Trimestre</label>
                            <input id="estimado_segundo8" name="estimado_ii8" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. III Trimestre</label>
                            <input id="estimado_tercer8" name="estimado_iii8" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. IV Trimestre</label>
                            <input id="estimado_cuarto8" name="estimado_iV8" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Est. Total Trimestres</label>
                            <input id="estimado_total_t_mod8" name="estimado_total_t8" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="card card-outline-danger">
                            <h5 class="mt-3 text-center"><b>Ejecutado</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>Precio (costo del servicio)</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_servicio_py();" name="precio_rend_ejecu8"
                                        id="precio_rend_ejecu8">
                                </div>

                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi8" id="selc_iva_rendi8"
                                        onchange="calculos_rendi_servicio_py();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                    <input id="iva_estimado_rend8" name="iva_estimado_rend8" type="text"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_servicio_py();" name="total_rendi8" id="total_rendi8"
                                        readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi8" name="paridad_rendi8"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_servicio_py();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi8" name="subtotal_rendi8" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label> PROCEDIMIENTO DE CONTRATACIÓN </label>
                                    <select class="form-control" name="modalida_rendi8" id="modalida_rendi8">
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
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_nombre8"
                                                id="rif_nombre8" onblur="buscar_rif8();"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-8">
                                            <select
                                                title="Depende de la palabra ingresada en el campo anterior, se listaran las opciones."
                                                class="form-control" name="sel_rif_nombre8" id="sel_rif_nombre8">
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label>NÚMERO DE CONTRATO <b style="color:red">*</b> <br><br></label>
                                    <input id="num_contrato8" name="num_contrato8" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA (OC, OS, CONTRATO) <b style="color:red">*</b> <br><br></label>
                                    <input type="date" id="fecha_contrato8" name="fecha_contrato8" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>TIPO DOCUMENTO CONTRATACIÓN </label>
                                    <select class="form-control" name="selc_tipo_doc_contrata8"
                                        id="selc_tipo_doc_contrata8" onchange="calculos_rendi_servicio();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>COMPROMISO DE RESPONSABILIDAD SOCIAL </label>
                                    <select class="form-control" name="selc_com_res_social8" id="selc_com_res_social8"
                                        onchange="calculos_rendi_servicio();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO 3% CRS <b style="color:red">*</b><br><br></label>
                                    <input id="monto3_rendi8" name="monto3_rendi8" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="card card-outline-green">
                            <h5 class="mt-3 text-center"><b>FACTURACIÓN Y PAGO</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>N° FACTURA<b style="color:red">*</b><br><br></label>
                                    <input id="nfactura_rendi8" name="nfactura_rendi8" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DE LA FACTURA</label>
                                    <input type="date" class="form-control" name="datefactura_rendi8"
                                        id="datefactura_rendi8">
                                </div>
                                <div class="form-group col-2">
                                    <label>BASE IMPONIBLE <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_servicio_py();" name="base_imponible_rendi8"
                                        id="base_imponible_rendi8">
                                </div>

                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi28" id="selc_iva_rendi28"
                                        onchange="calculos_rendi_servicio_py();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO FACTURA</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_servicio_py();" name="monto_factura_rend8"
                                        id="monto_factura_rend8">
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL PAGO <b style="color:red">*</b><br><br></label>
                                    <input id="total_pago_rendi8" name="total_pago_rendi8" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi_factura8" name="paridad_rendi_factura8"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_servicio_py();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi_factura8" name="subtotal_rendi_factura8"
                                        onkeyup="verif();" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DEL PAGO</label>
                                    <input type="date" class="form-control" name="fecha_pago_rendi8"
                                        id="fecha_pago_rendi8">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_pago_fin" onclick="guardar_rendi_servicio_py();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal obras PY-->
<div class="modal fade" id="obrapy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rendir Items Obras PY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="obrapy1" name="obrapy1" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">

                            <label style="color:red;">Nombre del proyecto <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="nombre_proyecto10" id="nombre_proyecto10"
                                readonly>
                        </div>
                        <div class="col-12">
                            <label style="color:red;">Ya ha rendido el Trimestre : <b style="color:red">*</b></label>
                            <input class="form-control" type="text" name="rendido9" id="rendido9" readonly>
                            <input class="form-control" type="text" name="rendid9" id="rendid9" readonly>


                        </div>
                        <div class="col-12">

                            <label style="color:red;">Seleccione Trimestre (Obligatorio).leer <b
                                    style="color:red">*</b></label><i style="color: red;"
                                title="Seleccione un Trimestre." class="fas fa-question-circle"></i>
                            <select class="form-control" name="llenar_trimestre9" id="llenar_trimestre9">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>ID - ITEMS</label>
                            <input class="form-control" type="hidden" name="id_p_items9" id="id_p_items9" readonly>
                            <input class="form-control" type="hidden" name="id_enlace9" id="id_enlace9" readonly>


                            <input class="form-control" type="hidden" name="id_obj_comercial9" id="id_obj_comercial9"
                                readonly>
                            <input class="form-control" type="text" name="desc_objeto_contrata9"
                                id="desc_objeto_contrata9" readonly>

                            <input class="form-control" type="hidden" name="id_programacion9" id="id_programacion9"
                                readonly>
                            <input class="form-control" type="text" name="id_estado9" id="id_estado9" readonly>
                            <input class="form-control" type="hidden" name="id_fuente_financiamiento9"
                                id="id_fuente_financiamiento9" readonly>

                        </div>
                        <div class="form-group col-4">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b9" id="id_part_pres_b9">
                            <input id="codigopartida_presupuestaria9" name="codigopartida_presupuestaria9"
                                class="form-control" class="form-control" readonly>
                            <input id="desc_partida_presupuestaria9" name="desc_partida_presupuestaria9"
                                class="form-control" class="form-control" readonly>
                            <input class="form-control" type="text" name="desc_fuente_financiamiento9"
                                id="desc_fuente_financiamiento9" readonly>
                            <input class="form-control" type="text" name="porcentaje9" id="porcentaje9" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Tipo de Obra</label>
                            <input type="hidden" class="form-control" name="id_tip_obra9" id="id_tip_obra9" readonly>
                            <input type="text" class="form-control" name="descripcion_tip_obr9"
                                id="descripcion_tip_obr9" readonly>
                            <label>Especificación</label>
                            <input type="text" class="form-control" name="especificacion9" id="especificacion9"
                                readonly>
                            <label>UND.</label>
                            <input type="text" class="form-control" name="unid_med_b9" id="unid_med_b9" readonly>
                            <input type="hidden" name="id_unid_med_b9" id="id_unid_med_b9" readonly>

                        </div>
                        <div class="form-group col-3">
                            <label>Alcance de la Obra</label><br><br>
                            <input type="hidden" class="form-control" name="id_alcance_obra9" id="id_alcance_obra9"
                                readonly>
                            <input type="text" class="form-control" name="descripcion_alcance_obra9"
                                id="descripcion_alcance_obra9" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Objeto de obra</label><br><br>
                            <input type="hidden" class="form-control" name="id_obj_obra9" id="id_obj_obra9" readonly>
                            <input type="text" class="form-control" name="descripcion_obj_obra9"
                                id="descripcion_obj_obra9" readonly>
                        </div>

                        <div class="form-group col-3">
                            <label>Fecha de Ejecución Obra Desde</label>
                            <input type="text" class="form-control" name="fecha_desde9" id="fecha_desde9" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Fecha de Ejecución Servicio Hasta</label><br>
                            <input type="text" class="form-control" name="fecha_hasta9" id="fecha_hasta9" readonly>
                        </div>

                        <div class="card card-outline-black">
                            <h5 class="mt-3 text-center"><b>Distribución Porcentual de la Ejecución Trimestral</b>
                            </h5>
                            <div class="row ">
                                <div class="form-group col-1">

                                    <input type="hidden" id="cantidad_mod_b9" name="cantidad_mod_b9"
                                        onblur="calcular_mod_bienes();" class="form-control"
                                        onkeypress="return valideKey(event);" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>I Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="primero_b9" id="primero_b9" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>II Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="segundo_b9" id="segundo_b9" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>III Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="tercero_b9" id="tercero_b9" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>IV Trimestre</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calcular_mod_bienes();" name="cuarto_b3" id="cuarto_b3" readonly>
                                </div>
                                <div class="form-group col-2">

                                    <input type="hidden" id="cant_total_distribuir_mod_b9"
                                        name="cant_total_distribuir_mod_b9" onkeyup="verif();" class="form-control"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label>Precio Total Estimado<b style="color:red">*</b></label>
                            <input id="precio_total_mod_b9" name="precio_total_mod_b9" type="text" class="form-control"
                                readonly>
                        </div>

                        <div class="form-group col-3">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label>
                            <input type="text" class="form-control" onblur="calcular_mod_bienes();" name="ali_iva_e_b9"
                                id="ali_iva_e_b9" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado_mod_b9" name="iva_estimado_mod_b9" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado_mod_b9" name="monto_estimado_mod_b9" type="text"
                                class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-2">
                            <label>Est. I Trimestre</b></label>
                            <input id="estimado_primer9" name="estimado_i9" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. II Trimestre</label>
                            <input id="estimado_segundo9" name="estimado_ii9" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. III Trimestre</label>
                            <input id="estimado_tercer9" name="estimado_iii9" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Est. IV Trimestre</label>
                            <input id="estimado_cuarto9" name="estimado_iV9" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Est. Total Trimestres</label>
                            <input id="estimado_total_t_mod9" name="estimado_total_t9" type="text" class="form-control"
                                readonly>
                        </div>
                        <div class="card card-outline-danger">
                            <h5 class="mt-3 text-center"><b>Ejecutado</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>Precio (costo del servicio)</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_obritaspy();" name="precio_rend_ejecu9"
                                        id="precio_rend_ejecu9">
                                </div>
                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi9" id="selc_iva_rendi9"
                                        onchange="calculos_rendi_obritaspy();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                    <input id="iva_estimado_rend9" name="iva_estimado_rend9" type="text"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_obritaspy();" name="total_rendi9" id="total_rendi9"
                                        readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi9" name="paridad_rendi9"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_obritaspy();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>SUB TOTAL (us$) <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi9" name="subtotal_rendi9" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label> PROCEDIMIENTO DE CONTRATACIÓN </label>
                                    <select class="form-control" name="modalida_rendi9" id="modalida_rendi9">
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
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_nombre9"
                                                id="rif_nombre9" onblur="buscar_rif9();"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-8">
                                            <select
                                                title="Depende de la palabra ingresada en el campo anterior, se listaran las opciones."
                                                class="form-control" name="sel_rif_nombre9" id="sel_rif_nombre9">
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2">
                                    <label>NÚMERO DE CONTRATO <b style="color:red">*</b> <br><br></label>
                                    <input id="num_contrato9" name="num_contrato9" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA (OC, OS, CONTRATO) <b style="color:red">*</b> <br><br></label>
                                    <input type="date" id="fecha_contrato9" name="fecha_contrato9" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>TIPO DOCUMENTO CONTRATACIÓN </label>
                                    <select class="form-control" name="selc_tipo_doc_contrata9"
                                        id="selc_tipo_doc_contrata9" onchange="calculos_rendi_obritaspy();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>COMPROMISO DE RESPONSABILIDAD SOCIAL </label>
                                    <select class="form-control" name="selc_com_res_social9" id="selc_com_res_social9"
                                        onchange="calculos_rendi_obritaspy();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO 3% CRS <b style="color:red">*</b><br><br></label>
                                    <input id="monto3_rendi99" name="monto3_rendi99" onkeyup="verif();"
                                        class="form-control" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="card card-outline-green">
                            <h5 class="mt-3 text-center"><b>FACTURACIÓN Y PAGO</b></h5>
                            <div class="row ">
                                <div class="form-group col-2">
                                    <label>N° FACTURA<b style="color:red">*</b><br><br></label>
                                    <input id="nfactura_rendi9" name="nfactura_rendi9" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DE LA FACTURA</label>
                                    <input type="date" class="form-control" name="datefactura_rendi9"
                                        id="datefactura_rendi9">
                                </div>
                                <div class="form-group col-2">
                                    <label>BASE IMPONIBLE <br><br></label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_obritaspy();" name="base_imponible_rendi9"
                                        id="base_imponible_rendi9">
                                </div>

                                <div class="form-group col-2">
                                    <label>ALÍCUOTA IVA <br><br></label>
                                    <select class="form-control" name="selc_iva_rendi99" id="selc_iva_rendi99"
                                        onchange="calculos_rendi_obritaspy();">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-2">
                                    <label>MONTO FACTURA</label>
                                    <input type="text" class="form-control" onkeypress="return valideKey(event);"
                                        onblur="calculos_rendi_obritaspy();" name="monto_factura_rend9"
                                        id="monto_factura_rend9">
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL PAGO <b style="color:red">*</b><br><br></label>
                                    <input id="total_pago_rendi9" name="total_pago_rendi9" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>Paridad US$ <b style="color:red">*</b> <br><br></label>
                                    <input id="paridad_rendi_factura9" name="paridad_rendi_factura9"
                                        onkeypress="return valideKey(event);" onblur="calculos_rendi_obritaspy();"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>TOTAL PAGO US$ <b style="color:red">*</b></label>
                                    <input id="subtotal_rendi_factura9" name="subtotal_rendi_factura9"
                                        onkeyup="verif();" class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>FECHA DEL PAGO</label>
                                    <input type="date" class="form-control" name="fecha_pago_rendi9"
                                        id="fecha_pago_rendi9">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_pago_fin" onclick="rendirobraspy();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>



<script src="<?=base_url()?>/js/programacion/calculos_rendir.js"></script>


<script src="<?=base_url()?>/js/programacion/rendir2.js"></script>



<script src="<?=base_url()?>/js/eliminar.js"></script>