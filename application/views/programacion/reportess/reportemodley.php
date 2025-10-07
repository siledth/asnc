<div id="content" class="content">
    <h2>Modificación del Plan de Compras Anual</h2>
    <div class="row">

        <div class="col-12 mt-7">
            <div class="card card-outline-danger text-center bg-white" style="border-color: white;">

                <div class="card-block">

                    <div class="col-12 text-center mt-3 mb-3">
                        <button
                            onclick="location.href='<?php echo base_url() ?>index.php/programacion?id=<?php echo $id_programacion; ?>'"
                            type="button" class="my-button3" name="button">
                            Ir a Período de Programaciones Cargadas
                        </button>
                        <button
                            onclick="location.href='<?php echo base_url() ?>index.php/programacion/nueva_prog?id=<?php echo $id_programacion; ?>'"
                            type="button" class="my-button3" name="button">
                            Ir a Cargar Acción Centralizada o Proyecto
                        </button>
                        <!-- <a class="my-button"
                            href="javascript:history.back()"> Volver</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <!-- <table id="example" class="table table-striped table-bordered table-responsive nowrap" style="width:100%"> -->
                    <!-- <table id="data-table-buttons" data-order='[[ 1, "asc" ]]' class="table table-bordered"> -->
                    <table id="data-table" data-order='[[ 1, "asc" ]]' class="table table-bordered">

                        <thead style="background:#01cdb2">


                            <tr style="text-align:center">
                                <th style="color:white; width: 55px">ID</th>
                                <th style="color:white; width: 55px">Proyecto/ACC</th>

                                <th style="color:white; width: 55px">Partida Presupuestaria</th>

                                <th style="color:white; width: 55px">Fuente Financiamiento</th>


                                <th style="color:white; width: 80px">Estado</th>
                                <th style="color:white; width: 55px">CCNU</th>
                                <th style="color:white; width: 80px">Esp.</th>
                                <th style="color:white; width: 40px">Unid. Medida</th>
                                <th style="color:white; width: 40px">Fecha Desde</th>
                                <th style="color:white; width: 40px">Fecha Hasta</th>
                                <th style="color:white; width: 40px">Cantidad</th>
                                <th style="color:white; width: 25px">% a Ejecutar I</th>
                                <th style="color:white; width: 25px"> % a Ejecutar II</th>
                                <th style="color:white; width: 25px">% a Ejecutar III</th>
                                <th style="color:white; width: 25px">% a Ejecutar IV</th>
                                <th style="color:white; width: 40px">Costo Unit.</th>
                                <th style="color:white; width: 40px">Precio Total</th>
                                <th style="color:white; width: 40px">IVA </th>
                                <th style="color:white; width: 40px">Monto Iva Est.</th>
                                <th style="color:white; width: 40px">Monto Total Est.</th>
                                <th style="color:white; width: 40px">Obj. Contr.</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programacion_final as $data): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?= $data['id_p_items'] ?> </td>
                                    <?php if ($data['id_p_acc'] == 0) : ?>
                                        <td>Proyecto</td>

                                    <?php else: ?>
                                        <td>Acción Centralizada</td>
                                    <?php endif; ?>
                                    <td><?= $data['codigopartida_presupuestaria'] ?>/<?= $data['desc_partida_presupuestaria'] ?>
                                    </td>

                                    <td><?= $data['desc_fuente_financiamiento'] ?> </td>


                                    <td><?= $data['id_estado'] ?> </td>
                                    <td><?= $data['codigo_ccnu'] ?>/<?= $data['desc_ccnu'] ?></td>
                                    <td><?= $data['especificacion'] ?> </td>
                                    <td><?= $data['desc_unidad_medida'] ?> </td>
                                    <td><?= date("d/m/Y", strtotime($data['fecha_desde'])); ?> </td>
                                    <td><?= date("d/m/Y", strtotime($data['fecha_hasta'])); ?> </td>
                                    <?php if ($data['id_obj_comercial'] == 1) : ?>
                                        <td><?= $data['cantidad'] ?> </td>

                                    <?php else: ?>
                                        <td>1</td>
                                    <?php endif; ?>


                                    <td><?= $data['i'] ?> </td>
                                    <td><?= $data['ii'] ?> </td>
                                    <td><?= $data['iii'] ?> </td>
                                    <td><?= $data['iv'] ?> </td>
                                    <td><?= $data['costo_unitario'] ?> </td>
                                    <td><?= $data['precio_total'] ?> </td>

                                    <?php if ($data['alicuota_iva'] == '0.16') : ?>
                                        <td>16 %</td>

                                    <?php else: ?>
                                        <td><?= $data['alicuota_iva'] ?> </td>
                                    <?php endif; ?>
                                    <td><?= $data['iva_estimado'] ?> </td>
                                    <td><?= $data['monto_estimado'] ?> </td>
                                    <td><?= $data['desc_objeto_contrata'] ?> </td>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>