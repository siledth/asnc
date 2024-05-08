<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Certificaciòn</h2>
    <div class="row">
        <div class="col-lg-12">


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




                                    <td class="center">




                                        <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb2?id=<?php echo $data['id_comision'];?>"
                                            class="button">
                                            <i title="Certificar" class="fas fa-2x fa-fw fa-clipboard-list"
                                                style="color: red;"></i>
                                            <a />

                                           

                                                <a onclick="modal_ce(<?php echo $data['id_comision']?>);"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    style="color: white">
                                                    <i title="Enviar" class="fas fa-2x fa-fw fa-file-import"
                                                        style="color: crimson;"></i>

                                                </a>
                                                <?php if ($data['snc'] == 2) : ?>

                                                        <a href="<?php echo base_url();?>index.php/Pdfcerti_miem/pdfrt?id=<?php echo $data['id_comision'];?>"
                                                            class="button">
                                                            <i class="fas fa-2x  fa-lg fa-cloud-download-alt"
                                                                title="Comprobante" style="color: blue;"></i>
                                                            <a />

                                                        <?php endif; ?>




                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
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
                            <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag"
                                data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="form-group col-2">

                                        <input class="form-control" type="hidden" name="id_mesualidad_ver"
                                            id="id_mesualidad_ver" readonly>
                                    </div>




                                    <div class="form-group col-12">
                                        <label>Declaro que la información y datos suministrados en esta Ficha son
                                            fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo
                                            que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en
                                            los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.<b
                                                title="Campo Obligatorio" style="color:red">*</b></label>

                                        <select class=" form-control " id="status" name="status"
                                            onchange="cambiarEndDate();cambiarEndDate2();">
                                            <option value="0">Seleccionar</option>

                                            <option value="2">Si</option>

                                        </select>



                                    </div>
                                    <div class="form-group col-3">

                                        <input type="hidden" id="vigen_cert_desde2" name="vigen_cert_desde2"
                                            class="form-control" value="<?=$time?>" />
                                        <input type="hidden" id="vigen_cert_hasta2" name="vigen_cert_hasta2"
                                            class="form-control" />

                                    </div>
                                    <div class="form-group col-3">

                                        <input type="hidden" id="vigen_cert_desde" name="vigen_cert_desde"
                                            class="form-control" value="<?=$time?>" />
                                        <input type="hidden" id="vigen_cert_hasta" name="vigen_cert_hasta"
                                            class="form-control" />

                                    </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="javascript:window.location.reload()"
                                class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="guardar_pago_fin" onclick="guardar_proc_pago();"
                                class="btn btn-primary">ACEPTO</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=base_url()?>/js/comision/comision.js">






    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#id_miembro4").select2({
            dropdownParent: $("#academico")
        });
    });
    </script>