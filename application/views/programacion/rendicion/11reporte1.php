<div id="content" class="content">
    <h2>Rendidición</h2>
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
        <div class="col-12 mt-4">
        <div class="panel panel-inverse">
            <div class="panel-heading"></div>
            <div class="table-responsive">
                <!-- <table id="example" class="table table-striped table-bordered table-responsive nowrap" style="width:100%"> -->
                <table id="data-table-buttons" data-order='[[ 0, "desc" ]]' class="table table-bordered">
                    <thead style="background:#01cdb2">
                        <tr style="text-align:center">
                            <th style="color:white;" colspan="5">Información General</th>
                            <th style="color:white;" colspan="2">Fecha estimada de Ejecución </th>
                            <th style="color:white;" colspan="4">Distribución Porcentual de la Ejecución Trimestral</th>
                            <th style="color:white;" colspan="5">Costos Estimados</th>
                            <th style="color:white;" colspan="23">Rendición</th>
                        </tr>

                        <tr style="text-align:center">
                        <th style="color:white; width: 55px">ID Rendición</th>

                            <th style="color:white; width: 55px">ID_programación</th>
                            <th style="color:white; width: 55px">Rif Organo/Ente</th>
                            <th style="color:white; width: 55px">Proyecto/ACC</th>
                            <th style="color:white; width: 55px">Desc.accion centralizada</th> 
                            <th style="color:white; width: 55px">objeto contrata</th> 
                          
                            <th style="color:white; width: 55px">Partida Pres.</th>
                            <th style="color:white; width: 55px">Fuente Financiamiento</th> 

                            <th style="color:white; width: 80px">CCNU</th>
                            <th style="color:white; width: 80px">Esp.</th>
                            <th style="color:white; width: 40px">Unid. Medida</th>
                            <th style="color:white; width: 40px">Fecha Desde</th>
                            <th style="color:white; width: 40px">Fecha Hasta</th>
                            <th style="color:white; width: 25px">% a Ejecutar I</th>
                            <th style="color:white; width: 25px" > % a Ejecutar II</th>
                            <th style="color:white; width: 25px">% a Ejecutar III</th>
                            <th style="color:white; width: 25px">% a Ejecutar IV</th>
                            <th style="color:white; width: 40px">Costo Unit.</th>
                            <th style="color:white; width: 40px">Precio Total</th>
                            <th style="color:white; width: 40px">IVA </th>
                            <th style="color:white; width: 40px">Monto Iva Est.</th>
                            <th style="color:white; width: 40px">Monto Total Est.</th>
                            <th style="color:white; width: 40px">Cantidad Rendida:</th>
    
                            <th style="color:white;">cost.U rend_ejecu</th>
                            <th style="color:white;">Precio rend ejecu</th>
                            <th style="color:white;">iva rendi</th>
                            <th style="color:white;">iva estimado rend</th>
                            <th style="color:white;">Total rendi</th>
                            <th style="color:white;">Paridad_rendi</th>
                            <th style="color:white;">subtotal Rendi</th>
                            <th style="color:white;">Modalidad Rendi</th>
                            <th style="color:white;">supuestos Rendi</th>
                            <th style="color:white;">Rif Contratista</th>
                            <th style="color:white;">Razon Social</th>

                            <th style="color:white;">num_contrato</th>
                            <th style="color:white;">fecha_contrato</th>
                            <th style="color:white;">tipo_doc_contrata</th>
                            <th style="color:white;">Comp.Res Social</th>
                            <th style="color:white;">monto3_rendim</th>
                            <th style="color:white;">nfactura_rendi</th>
                            <th style="color:white;">datefactura_rendi</th>
                            <th style="color:white;">base_imponible_rendi</th>
                            <th style="color:white;">selc_iva_rendi2</th>
                            <th style="color:white;">monto_factura_rend</th>
                            <th style="color:white;">total_pago_rendi</th>
                            <th style="color:white;">paridad_rendi_factura</th>
                            <th style="color:white;">subtotal_rendi_factura</th>
                            <th style="color:white;">fecha_pago_rendi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rendir as $data):?>
                        <tr class="odd gradeX" style="text-align:center">
                        <td><?=$data['id_rendicion']?> </td>

                            <td><?=$data['id_p_items']?> </td>
                            <td><?=$data['rif_organoente']?> </td>
                            <?php if ($data['id_p_acc'] == 0) : ?>
                                    <td >Proyecto</td>

                                    <?php else: ?>
                                    <td >Acción Centralizada</td>
                                    <?php endif; ?>     
                          
                            <td><?=$data['desc_accion_centralizada']?> </td>                          
                            <td><?=$data['desc_objeto_contrata']?> </td>                           

                            <td><?=$data['codigopartida_presupuestaria']?> <?=$data['desc_partida_presupuestaria']?></td>
                            <td><?=$data['desc_fuente_financiamiento']?> </td>
                            <?php if ($data['codigo_ccnu'] == 0) : ?>
                                    <td >Es una Obra</td>

                                    <?php else: ?>
                                        <td><?=$data['codigo_ccnu']?>/<?=$data['desc_ccnu']?></td>      

                                    <?php endif; ?> 
                            <td><?=$data['especificacion']?> </td>
                            <td><?=$data['id_unidad_medida']?> </td>
                            <td><?=$data['fecha_desde']?> </td>
                            <td><?=$data['fecha_hasta']?> </td>
                            <td><?=$data['i']?> </td>
                            <td><?=$data['ii']?> </td>
                            <td><?=$data['iii']?> </td>
                            <td><?=$data['iv']?> </td>
                            <td><?=$data['costo_unitario']?> </td>
                            <td><?=$data['precio_total']?> </td>
                            
                            <?php if ($data['alicuota_iva'] == '0.16') : ?>
                                <td >16 %</td>

                                    <?php else: ?>
                                        <td><?=$data['alicuota_iva']?> </td>
                                    <?php endif; ?>    
                            <td><?=$data['iva_estimado']?> </td>
                            <td><?=$data['monto_estimado']?> </td>
                            <td><?=$data['cantidad_ejecu']?> </td>

                            
                            <td><?=$data['costo_unitario_rend_ejecu']?> </td>
                            <td><?=$data['precio_rend_ejecu']?> </td>
                            <td><?=$data['selc_iva_rendi']?> </td>
                            <td><?=$data['iva_estimado_rend']?> </td>
                            <td><?=$data['total_rendi']?> </td>
                            <td><?=$data['paridad_rendi']?> </td>
                            <td><?=$data['subtotal_rendi']?> </td>
                            <td><?=$data['descripcion']?> </td>
                            <td><?=$data['supuestos_procedimiento']?> </td>
                            <?php if ($data['exit_rnc'] == 0) : ?>
                                
                            <td><?=$data['rif_contr_no_rnc']?> </td>
                            <td><?=$data['razon_social_no_rnc']?> </td>
                                    <?php else: ?>
                                <td><?=$data['sel_rif_nombre']?> </td>
                            <td><?=$data['nombre_contratista']?> </td>
                                    <?php endif; ?> 
                                    
                            

                            <td><?=$data['num_contrato']?> </td>
                            <td><?=$data['fecha_contrato']?> </td>
                            <td><?=$data['desc_tipo_doc_contrata']?> </td>
                            <td><?=$data['desc_comp_resp_social']?> </td>
                            <td><?=$data['monto3_rendim']?> </td>
                            <td><?=$data['nfactura_rendi']?> </td>
                            <td><?=$data['datefactura_rendi']?> </td>
                            <td><?=$data['base_imponible_rendi']?> </td>
                            <td><?=$data['selc_iva_rendi2']?> </td>
                            <td><?=$data['monto_factura_rend']?> </td>
                            <td><?=$data['total_pago_rendi']?> </td>
                            <td><?=$data['paridad_rendi_factura']?> </td>
                            <td><?=$data['subtotal_rendi_factura']?> </td>
                            <td><?=$data['fecha_pago_rendi']?> </td>                       
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>