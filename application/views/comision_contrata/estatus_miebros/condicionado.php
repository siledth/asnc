<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Miembros Certificados Condicionados</h2>
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
                                                <th>Cedula</th>
                                                <th>Nombres</th>

                                                <th>Apellidos</th>
                                                <th>Area</th>
                                                <th>Tipo</th>

                                                <th>Estatus</th>
                                                <th>Notificado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($miembros as $data):?>
                                            <tr class="odd gradeX" style="text-align:center">
                                                <td><?=$data['rif_organoente']?> </td>
                                                <td><?=$data['cedula']?> </td>
                                                <td><?=$data['nombre']?> </td>
                                                <td><?=$data['apellido']?> </td>

                                                <td><?=$data['desc_area_miembro']?> </td>
                                                <td><?=$data['desc_tp_miembro']?> </td>





                                                <td><?=$data['desc_status_miembro']?> </td>

                                                <td><?=$data['desc_status_snc']?> </td>


                                                <td class="center">
                                                    <?php if ($data['id_status'] == 2) : ?>

                                                    <?php else: ?>
                                                    <?php if ($data['snc'] == 1) : ?>

                                                    <!-- <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb?id=<?php echo $data['id_comision'];?>"
                                                        class="button">
                                                        <i title="ver Integrantes"
                                                            class="fas fa-2x fa-fw fa-clipboard-list"
                                                            style="color: pink;"></i>
                                                        <a />
                                                        <a title="Notificar al SNC"
                                                            onclick="enviar(<?php echo $data['id_comision'];?>);"
                                                            class="button">
                                                            <i class="fas fa-2x fa-fw fas ffas fa-bullhorn"
                                                                style="color: black;"></i>
                                                            <a /> -->

                                                            <?php else: ?>
                                                            <!-- <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb?id=<?php echo $data['id_comision'];?>"
                                                                class="button">
                                                                <i title="ver Integrantes"
                                                                    class="fas fa-2x fa-fw fa-clipboard-list"
                                                                    style="color: pink;"></i>
                                                                <a /> -->
                                                                <button
                                                                    onclick="location.href='<?php echo base_url()?>index.php/Pdfcerti_miem/pdfrt?id=<?php echo $data['id_comision'];?>'"
                                                                    type="button"
                                                                    class="fas fa-2x  fa-cloud-download-alt"
                                                                    style="color:blue" name="button">
                                                                </button>

                                                              

                                                                    <!-- <a onclick="modal_ce(<?php echo $data['id_miembros']?>);"
                                                                        data-toggle="modal" data-target="#exampleModal"
                                                                        style="color: white">
                                                                        <i title="Certificar Miembro 2 años"
                                                                            class="fas fa-2x fa-fw fa-file-import"
                                                                            style="color: crimson;"></i>

                                                                    </a> -->
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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">enviar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="rrr" name="rrr"
                                data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="form-group col-2">

                                        <input class="form-control" type="text" name="id_mesualidad_ver"
                                            id="id_mesualidad_ver" readonly>
                                    </div>




                                    <div class="form-group col-12">
                                        <label>Declaro que la información y datos suministrados en esta Ficha son
                                            fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo
                                            que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en
                                            los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.<b
                                                title="Campo Obligatorio" style="color:red">*</b></label>

                                        <select class=" form-control " id="status1" name="status1"
                                            onchange="cambiarEndDate();">
                                            <option value="0">Seleccionar</option>

                                            <option value="2">Si</option>

                                        </select>



                                    </div>
                                   
                                    <div class="form-group col-3">

                                        <input type="text" id="vigen_cert_desde" name="vigen_cert_desde"
                                            class="form-control" value="<?=$time?>" />
                                        <input type="text" id="vigen_cert_hasta" name="vigen_cert_hasta"
                                            class="form-control" />

                                    </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="javascript:window.location.reload()"
                                class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="guardar_pago_fin" onclick="guardar_nuevoestatus();"
                                class="btn btn-primary">ACEPTO</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="<?=base_url()?>/js/comision/condicionado.js">   </script>
            