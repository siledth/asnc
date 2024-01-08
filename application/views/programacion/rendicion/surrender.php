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
                                <div class="col-1 mb-3">
                                    <a data-toggle="modal" data-target="#exampleModal1"
                                        class="btn btn-green btn-circle waves-effect waves-circle waves-float">
                                        Rendir
                                    </a>
                                </div>
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


<!-- modal probando-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Rendición</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_adelanto_pag" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12"></div>
                        <div class="col-12">

                            <label style="color:red;">Seleccione Trimestre (Obligatorio).leer <b
                                    style="color:red">*</b></label><i style="color: red;"
                                title="Seleccione un Trimestre." class="fas fa-question-circle"></i>
                           
                            <select class="form-control" name="llenar_trimestre5" id="llenar_trimestre5"
                                onclick="llenar();">
                                <option value="0">Seleccione</option>
                                <option value="1">Primer Trimestre</option>
                                <option value="2">Segundo Trimestre</option>
                                <option value="3">Tercer Trimestre</option>
                                <option value="4">Cuarto Trimestre</option>

                                

                            </select>
                        </div>

                        <div class="form-group col-7">
                            <label>Seleccione CCNU <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select style="width: 100%;" onclick="trae_inf();" id="matricular" name="matricular"
                                class="form-control" data-show-subtext="true" data-live-search="true">
                                <option value="0">Seleccione</option>
                                <?php foreach ($mat as $data) : ?>
                                <option value="<?= $data['id_p_items']?>">
                                    <?= $data['id_ccnu']?> / <?= $data['desc_ccnu']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>CCNU</label>
                            <input class="form-control" type="text" name="nombre_a" id="nombre_a" readonly>
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

                        <div class="form-group col-6">
                            <label>Fuente Financiamiento</label>
                            <input class="form-control" type="text" name="desc_fuente_financiamiento5"
                                id="desc_fuente_financiamiento5" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Estado</label>
                            <input class="form-control" type="text" name="id_estado5" id="id_estado5" readonly>
                            <input class="form-control" type="hidden" name="id_fuente_financiamiento5"
                                id="id_fuente_financiamiento5" readonly>

                        </div>

                        <div class="form-group col-6">
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="hidden" name="id_part_pres_b5" id="id_part_pres_b5">
                            <input id="codigopartida_presupuestaria5" name="codigopartida_presupuestaria5"
                                class="form-control" class="form-control" readonly>
                            <input id="desc_partida_presupuestaria5" name="desc_partida_presupuestaria5"
                                class="form-control" class="form-control" readonly>

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
                            <h5 class="mt-1 text-center"><b>Distribución Porcentual Ingresada de la Ejecución
                                    Trimestral</b>
                            </h5>
                            <div class="row ">
                                <div class="form-group col-4">
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
                                <div class="form-group col-2">
                                    <label>Costo Unitario<b style="color:red">*</b></label>
                                    <input id="costo_unitario_mod_b5" name="costo_unitario_mod_b5" type="text"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Sub Total<b style="color:red">*</b></label>
                                    <input id="subtbd" name="subtbd" type="text" class="form-control" readonly>
                                    <input id="precio_total_mod_b5" name="precio_total_mod_b5" type="hidden"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group col-2">
                                    <label>Alícuota<b style="color:red">*</b></label>
                                    <input type="text" class="form-control" name="ali_iva_e_b5" id="ali_iva_e_b5"
                                        readonly>
                                </div>
                                <div class="form-group col-3">
                                    <label>Monto IVA Estimado<b style="color:red">*</b></label>
                                    <input id="iva_estimado_mod_b5" name="iva_estimado_mod_b5" type="text"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-3">
                                    <label>Monto total Estimado<b style="color:red">*</b></label>
                                    <input id="monto_estimado_mod_b5" name="monto_estimado_mod_b5" type="text"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Est. II Trimestre</label>
                                    <input id="estimado_segundo5" name="estimado_ii5" type="text" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Est. III Trimestre</label>
                                    <input id="estimado_tercer5" name="estimado_iii5" type="text" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label>Est. IV Trimestre</label>
                                    <input id="estimado_cuarto5" name="estimado_iV5" type="text" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Est. Total Trimestres</label>
                                    <input id="estimado_total_t_mod5" name="estimado_total_t5" type="text"
                                        class="form-control" readonly>
                                </div>

                            </div>
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
                                    <select class="form-control" name="selc_iva_ret" id="selc_iva_ret"
                                        onchange="calculos_rendi_bienessacc();" >
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
                <button type="button" id="guardar_adelanto_pag_b" onclick="guardar_adelanto_pag();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


 


 
<script src="<?=base_url()?>/js/programacion/yield.js"></script>




<script src="<?=base_url()?>/js/eliminar.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#matricular").select2({
        dropdownParent: $("#exampleModal1")
    });
});

function valideKey(evt) {
    var code = (evt.which) ? evt.which : evt.keyCode;
    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        return false;
    }
}
</script>