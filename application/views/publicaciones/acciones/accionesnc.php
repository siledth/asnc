<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Resultado del llamado</h2>
    <div class="row">
        <div class="col-lg-12">


            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading"></div>
                    <div class="table-responsive">
                        <table id="data-tablepdf" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr>
                                    <th>Organo </th>
                                    <th>Numero proceso</th>
                                    <th>Accion</th>
                                    <th>articulo 113</th>
                                    <th>adjudicado</th>
                                    <th>Contrastista</th>
                                    <th>Objeto</th>
                                    <th># contrato</th>
                                    <th>Monto Contrato</th>
                                    <th>Paridad</th>
                                    <th>Total paridad</th>
                                    <th>Fecha paridad</th>
                                    


                                    <th>Notificado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($llamadot as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                <?php if ($data['filiar'] > 0) : ?>
                                    <td><?=$data['filiares']?>/<?=$data['desc_org']?></td>
                                    <?php else: ?>
                                        <td><?=$data['rif_organoente']?>/<?=$data['desc_org']?></td>
                                        <?php endif; ?>

                                    <td><?=$data['numero_proceso']?> </td>
                                    <td><?=$data['desc_acciones']?> </td>
                                    <?php if ($data['id_accion_cargar'] == 2) : ?>
                                    <td><?=$data['desc_articulo113']?> /<?=$data['observacion_desierto']?> </td>

                                    <?php else: ?>

                                    <td>No Aplica</td>

                                    <?php endif; ?>

                                    <td><?=$data['desc_adjudicado']?> </td>
                                    <?php if ($data['exit_rnc'] == 1) : ?>
                                    <td><?=$data['sel_rif_nombre']?> /<?=$data['nombre_contratista']?> </td>

                                    <?php else: ?>

                                    <td style="color: red;"><?=$data['rif_contr_no_rnc']?>
                                        /<?=$data['razon_social_no_rnc']?> </td>


                                    <?php endif; ?>
                                    <?php if ($data['id_accion_cargar'] == 2) : ?>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <td>No Aplica</td>
                                    <?php else: ?>
                                    <td><?=$data['desc_objeto_contrata']?></td>
                                    <td><?=$data['num_contrato']?></td>
                                    <td><?=$data['monto_contrato']?></td>
                                    <td><?=$data['paridad']?></td>
                                    <td><?=$data['total_contrato']?></td>
                                    <td><?=date("d/m/Y", strtotime($data['fecha_paridad']));?></td>




                                    <?php endif; ?>
                                    


                                    <td><?=$data['desc_status_snc']?> </td>


                                    <td>
                                        <?php if ($data['id_accion_cargar'] == 2) : ?>


                                        <?php else: ?>
                                        
                                            <?php endif; ?>

                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

   

   
    