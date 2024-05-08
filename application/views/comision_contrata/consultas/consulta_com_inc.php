<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Historico Comisiones Inactivas de Entes Y Organos del estado</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                     
                     

            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading"></div>
                    <div class="table-responsive">
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr>
                                    <th>Rif </th>
                                    <th>Nombre de la Comisiòn</th>
                                    <th>Fecha de Desig.</th>

                                    <th>Acto Admin.</th>
                                    <th>Número Acto</th>
                                    <th>Fecha Acto</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>

                                    <th>Estatus</th>
                                    <th>Notificado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($comisiones as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$data['rif_organoente']?> </td>
                                    <td><?=$data['observacion']?> </td>
                                    <td><?=$data['fecha_desig']?> </td>
                                    <td><?=$data['desc_acto_admin']?> </td>

                                    <td><?=$data['num_acto']?> </td>
                                    <td><?=$data['fecha_acto']?> </td>


                                    <?php if ($data['tipo_comi'] == '1') : ?>
                                    <td>Permanente</td>
                                    <td>Permanente</td>


                                    <?php else: ?>
                                    <td><?=$data['dura_com_desde']?> </td>
                                    <td><?=$data['dura_com_hasta']?> </td>
                                    <?php endif; ?>
                                    <td><?=$data['desc_status']?> </td>

                                    <td><?=$data['desc_status_snc']?> </td>


                                    <td class="center">
                                        <?php if ($data['id_status'] == 2) : ?>

                                        <?php else: ?>
                                        <?php if ($data['snc'] == 1) : ?>
                                        <a onclick="modal(<?php echo $data['id_comision'] ?>);" data-toggle="modal"
                                            data-target="#dede" style="color: white">
                                            <i title="Ingresar Miembros de Comisión"
                                                class="fas fa-2x fa-fw fa-address-card" style="color: darkblue;"></i>

                                        </a>
                                        <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb?id=<?php echo $data['id_comision'];?>"
                                            class="button">
                                            <i title="ver Integrantes" class="fas fa-2x fa-fw fa-clipboard-list"
                                                style="color: pink;"></i>
                                            <a />
                                            <a title="Notificar al SNC"
                                                onclick="enviar(<?php echo $data['id_comision'];?>);" class="button">
                                                <i class="fas fa-2x fa-fw fas ffas fa-bullhorn"
                                                    style="color: black;"></i>
                                                <a />

                                                <?php else: ?>
                                                <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb?id=<?php echo $data['id_comision'];?>"
                                                    class="button">
                                                    <i title="ver Integrantes" class="fas fa-2x fa-fw fa-clipboard-list"
                                                        style="color: pink;"></i>
                                                    <a />
                                                    <a class="button">
                                                        <i title="Editar"
                                                            onclick="modal_ver(<?php echo $data['id_comision']?>);"
                                                            data-toggle="modal" data-target="#exampleModal3"
                                                            class="fas fa-2x fa-fw fa-edit" style="color:green"></i>
                                                        <a />


                                                        <button
                                                            onclick="location.href='<?php echo base_url()?>index.php/Comision_contrata/read_send?id=<?php echo $data['id_comision'];?>'"
                                                            type="button" class="fas fa-2x  fa-cloud-download-alt"
                                                            style="color:blue" name="button">
                                                        </button>

                                                        <a title="inactivar comisión"
                                                            onclick="inactivar(<?php echo $data['id_comision'];?>);"
                                                            class="button">
                                                            <i class="fas fa-2x fa-fw  fa-ban" style="color: red;"></i>
                                                            <a />
                                                            <?php endif; ?>

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
    
   