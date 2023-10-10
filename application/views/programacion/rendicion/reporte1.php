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
        <div class="col-10 mt-4">
        <div class="panel panel-inverse">
            <div class="panel-heading"></div>
            <div class="table-responsive">
                <!-- <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%"> -->
                <table id="data-table-default" data-order='[[ 0, "desc" ]]' class="table table-bordered table-hover">
                    <thead style="background:#01cdb2">
                        <tr style="text-align:center">
                            <th style="color:white;" colspan="5">Información General</th>
                            <th style="color:white;" colspan="2">Fecha estimada de Ejecución </th>
                            <th style="color:white;" colspan="4">Distribución Porcentual de la Ejecución Trimestral
                            </th>
                            <th style="color:white;" colspan="5">Costos Estimados</th>
                            <th style="color:white;" colspan="23">Rendición</th>
                   

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
                            <td><?=$data['i']?> </td>
                            <td><?=$data['ii']?> </td>
                            <td><?=$data['iii']?> </td>
                            <td><?=$data['iv']?> </td>
                            <td><?=$data['costo_unitario']?> </td>
                            <td><?=$data['precio_total']?> </td>
                            <td><?=$data['alicuota_iva']?> </td>
                            <td><?=$data['iva_estimado']?> </td>
                            <td><?=$data['monto_estimado']?> </td>
                            <td><?=$data['costo_unitario_rend_ejecu']?> </td>
                            <td><?=$data['precio_rend_ejecu']?> </td>
                            <td><?=$data['selc_iva_rendi']?> </td>
                            <td><?=$data['iva_estimado_rend']?> </td>
                            <td><?=$data['total_rendi']?> </td>
                            <td><?=$data['paridad_rendi']?> </td>
                            <td><?=$data['subtotal_rendi']?> </td>
                            <td><?=$data['id_modalida_rendi']?> </td>
                            <td><?=$data['sel_rif_nombre']?> </td>
                            <td><?=$data['num_contrato']?> </td>
                            <td><?=$data['fecha_contrato']?> </td>
                            <td><?=$data['selc_tipo_doc_contrata']?> </td>
                            <td><?=$data['selc_com_res_social']?> </td>
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