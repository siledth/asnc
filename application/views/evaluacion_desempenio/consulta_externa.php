<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="col-12">
                    <br>
                    <h3 class="text-center">Evaluaciones Registradas</h3>
                    <table id="data-table-default" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Fecha Reg. Evaluación</th>
                                <th>Rif de Contratante:</th>
                                <th>Razón Social Contratante</th>
                                <th>Rif contratista</th>
                                <th>Razón Social contratista</th>
                                <th>Calificación</th>
                                <!-- <th>Estatus de Notificación</th> -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($reportes_user as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id']?> </td>
                                <td><?=$data['fecha_reg_eval']?> </td>
                                <td><?=$data['rif_organoente']?> </td>
                                <td><?=$data['organo_ente']?> </td>
                                <td><?=$data['rif_contrat']?> </td>
                                <td><?=$data['contratista_ev']?> </td>
                                <td><?=$data['calificacion']?></td>
                                <td class="center">
                                    <a title="Visualizar e Imprimir la Evaluación de Desempeño"
                                        href="<?php echo base_url();?>index.php/Evaluacion_desempenio/ver_evaluacion?id=<?php echo $data['id'];?>"
                                        class="button">
                                        <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                        <a />
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

<script src="<?=base_url()?>/js/eval_desempenio/notificacion.js"></script>