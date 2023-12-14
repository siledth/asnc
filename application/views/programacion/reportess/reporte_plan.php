<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Cotinuar la carga de la programación Bienes-acc</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                        <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                        <p class="f-s-16">RIF.: <?=$rif?> <br>
                            Código ONAPRE: <?=$codigo_onapre?> <br>


                            <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
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
                                <th style="color:white;">I</th>
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
                            <?php foreach($accion as $data):?>
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
                                    <a onclick="modal(<?php echo $data['id_p_items'] ?>);" data-toggle="modal"
                                        data-target="#myModal_bienes" style="color: white">
                                        <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                            style="color: darkgreen;"></i>
                                    </a>
                                    <a onclick="eliminar_items_bienes(<?php echo $data['id_p_items'];?>);"
                                         class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"></i><a />
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

<!-- /////////////////////////////editar items de bienes -->
    <script src="<?=base_url()?>/js/bien/modal_editar_items_bienes.js"></script>
    <!-- /////////////////////////////editar items de bienes -->
    <script src="<?=base_url()?>/js/bien/llenar_editar_proy_b.js"></script>
    <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_edit.js"></script>
    <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_ff.js"></script>
    <script src="<?=base_url()?>/js/bien/calculos_bienes_edit.js"></script>


    <script src="<?=base_url()?>/js/bien/guardaritmccs.js"></script>


    <!-- <script src="<?=base_url()?>/js/bien/llenar_editar_acc_b.js"></script> -->
    <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_edit.js"></script>
    <script src="<?=base_url()?>/js/bien/agregar_acc_centralizada_ff.js"></script>

    <script src="<?=base_url()?>/js/bien/calculos_bienes_edit.js"></script>


    <script src="<?=base_url()?>/js/eliminar.js"></script>