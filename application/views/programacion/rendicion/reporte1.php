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
                <!-- <table id="data-table-buttons" data-order='[[ 0, "desc" ]]' class="table table-bordered"> -->
                <table id="data-table" data-order='[[ 0, "desc" ]]' class="table table-bordered">
                    
                <thead style="background:#01cdb2">
                       <tr style="text-align:center">
                            <th style="color:black;" colspan="17">Programación Anual</th>
                            
                            <th style="color:black;" colspan="25">Información de la Rendición</th>
                        </tr>
                        <tr style="text-align:center">
                            <th style="color:white;" colspan="5">Información General Programado</th>
                            <th style="color:white;" colspan="2">Fecha estimada de Ejecución Programado</th>
                            <th style="color:white;" colspan="4">Distribución Porcentual de la Ejecución Trimestral Programado</th>
                            <th style="color:white;" colspan="6">Costos Estimados Programados</th>
                            <th style="color:white;" colspan="25">Información de la Rendición</th>
                        </tr>

                        <tr style="text-align:center">
                            <th style="color:white; width: 55px">ID</th>
                            <th style="color:white; width: 55px">Partida Pres.</th>
                            <th style="color:white; width: 80px">CCNU</th>
                            <th style="color:white; width: 80px">Esp.</th>
                            <th style="color:white; width: 40px">Unid. Medida</th>

                            <th style="color:white; width: 40px">Fecha Desde</th>
                            <th style="color:white; width: 40px">Fecha Hasta</th>
                            <th style="color:white; width: 40px">Cantidad.Prog</th>


                            <th style="color:white; width: 25px">% a Ejecutar I</th>
                            <th style="color:white; width: 25px" > % a Ejecutar II</th>
                            <th style="color:white; width: 25px">% a Ejecutar III</th>
                            <th style="color:white; width: 25px">% a Ejecutar IV</th>

                            <th style="color:white; width: 40px">Costo Unit.</th>
                            <th style="color:white; width: 40px">Precio Total</th>
                            <th style="color:white; width: 40px">IVA </th>
                            <th style="color:white; width: 40px">Monto Iva Est.</th>
                            <th style="color:white; width: 40px">Monto Total Est.</th>
                           
                            <th style="color:white;">Trimestre Rendido</th>

                            <th style="color:white;">Cantidad.Ejecu</th>

                            <th style="color:white;">cost.U rend_ejecu</th>
                            <th style="color:white;">precio_rend_ejecu</th>
                            <th style="color:white;">selc_iva_rendi</th>
                            <th style="color:white;">iva_estimado_rend</th>
                            <th style="color:white;">total_rendi</th>
                            <th style="color:white;">paridad_rendi</th>
                            <th style="color:white;">subtotal_rendi</th>
                            <th style="color:white;">id_modalida_rendi</th>
                            <th style="color:white;">sel_rif_nombre</th>
                            <th style="color:white;">num_contrato</th>
                            <th style="color:white;">fecha_contrato</th>
                            <th style="color:white;">selc_tipo_doc_contrata</th>
                            <th style="color:white;">selc_com_res_social</th>
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
                            <td><?=$data['id_p_items']?> </td>
                            <td><?=$data['codigopartida_presupuestaria']?> </td>
                            <td><?=$data['desc_ccnu']?> </td>
                            <td><?=$data['especificacion']?> </td>
                            <td><?=$data['id_unidad_medida']?> </td>
                            <td><?=$data['fecha_desde']?> </td>
                            <td><?=$data['fecha_hasta']?> </td>
                            <td><?=$data['cantidad']?> </td>

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
                             <td><?=$data['descripcion_trimestre']?> </td>
                             <td><?=$data['cantidad_ejecu']?> </td>


                            <td><?=$data['costo_unitario_rend_ejecu']?> </td>
                            <td><?=$data['subtotal_rend_ejecu']?> </td>
                            <td><?=$data['selc_iva_rendi']?> </td>
                            <td><?=$data['iva_estimado_rend']?> </td>
                            <td><?=$data['total_rendi']?> </td>
                            <td><?=$data['paridad_rendi']?> </td>
                            <td><?=$data['subtotal_rendiusdt']?> </td>
                            <td><?=$data['descripcion']?> </td>
                            <td><?=$data['sel_rif_nombre']?> </td>
                            <td><?=$data['num_contrato']?> </td>
                            <td><?=$data['fecha_contrato']?> </td>
                            <td><?=$data['desc_tipo_doc_contrata']?> </td>
                           
                            <?php if ($data['selc_com_res_social'] == 0) : ?>
                                <td>No Ingreso Información de Facturación y Pago</td>
                                <td>No Ingreso Información de Facturación y Pago </td>
                            <td>No Ingreso Información de Facturación y Pago</td>
                            <td>No Ingreso Información de Facturación y Pago </td>
                            <td>No Ingreso Información de Facturación y Pago </td>
                            <td>No Ingreso Información de Facturación y Pago </td>
                            <td>No Ingreso Información de Facturación y Pago</td>
                            <td>No Ingreso Información de Facturación y Pago </td>
                            <td>No Ingreso Información de Facturación y Pago</td>
                            <td>No Ingreso Información de Facturación y Pago</td>
                            <td>No Ingreso Información de Facturación y Pago</td> 
                                <?php else: ?>
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
                            <?php endif; ?>                      
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>