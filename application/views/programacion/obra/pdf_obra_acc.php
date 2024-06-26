<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
			<div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-body">
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
                                        <input type="hidden" id="id_programacion" name="id_programacion" value="<?=$id_programacion?>">
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                         <?php foreach($inf_1_acc as $inf_1):?><?php endforeach;?>
                        <div class="col-9 mt-2 form-group">
                            <label>Acción Centralizada <b style="color:red">*</b></label>
                            <input value="<?=$inf_1['desc_accion_centralizada']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-2  col-3">
                            <label>Objeto de Contratación</label>
                            <input value="<?=$inf_1['desc_objeto_contrata']?>" type="text" class="form-control" disabled>
                        </div>
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                        <div class="table-responsive mt-3">
                            <div class="col-12 text-center">
                                <h4 style="color:red;">Información Items Fuente Financiamiento (IFF)</h4>
                            </div>
                            <table id="data-table-autofill" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8;">
                                    <tr class="text-center">
                                        <th>Código Part. Presupuestaria</th>
                                        <th>Partida Presupuestaria</th>
                                       
                                        <th>Fuente de Financiamiento</th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($inf_2_acc as $inf_2):?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td ><?=$inf_2['codigopartida_presupuestaria']?></td>
                                            <td><?=$inf_2['desc_partida_presupuestaria']?></td>
                                            
                                            <td><?=$inf_2['desc_fuente_financiamiento']?></td>
                                          
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                        <div class="table-responsive mt-4">
                            <div class="col-12 mt-2 text-center">
                                <h4 style="color:red;">Información Items Productos (IP)</h4>
                            </div>
                            <table id="data-table-default" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8;">
                                    <tr class="text-center">
                                        <th>Partida Pres.</th>
                                        <th>Tp. Obra</th>
                                        <th>Alc. Obra</th>
                                        <th>Obj. Obra</th>
                                        <th>Esp.</th>
                                        <th>Unid. Medida</th>
                                        <th>I</th>
                                        <th>II</th>
                                        <th>III</th>
                                        <th>IV</th>
                                        <th>Costo Unitario</th>
                                        <th>Precio Total Est.</th>
                                        <th>IVA Estimado</th>
                                        <th>Monto Iva Est.</th>
                                        <th>Monto Total Est.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($inf_3_acc as $inf_3):?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td><?=$inf_3['codigopartida_presupuestaria']?></td>
                                            <td><?=$inf_3['descripcion_tip_obr']?></td>
                                            <td><?=$inf_3['descripcion_alcance_obra']?></td>
                                            <td><?=$inf_3['descripcion_obj_obra']?></td>
                                            <td><?=$inf_3['especificacion']?></td>
                                            <td><?=$inf_3['desc_unidad_medida']?></td>
                                            <td><?=$inf_3['i']?></td>
                                            <td><?=$inf_3['ii']?></td>
                                            <td><?=$inf_3['iii']?></td>
                                            <td><?=$inf_3['iv']?></td>
                                            <td><?=$inf_3['costo_unitario']?></td>
                                            <td><?=$inf_3['precio_total']?></td>
                                            <td><?=$inf_3['alicuota_iva']?></td>
                                            <td><?=$inf_3['iva_estimado']?></td>
                                            <td><?=$inf_3['monto_estimado']?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button
                            onclick="location.href='<?php echo base_url()?>index.php/programacion?id=<?php echo $id_programacion;?>'"
                            type="button" class="my-button3" name="button">
                            Ir a Período de Programaciones Cargadas
                        </button>
                        <button
                            onclick="location.href='<?php echo base_url()?>index.php/programacion/nueva_prog?id=<?php echo $id_programacion;?>'"
                            type="button" class="my-button3" name="button">
                            Ir a Cargar Acción Centralizada o Proyecto
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
