<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Participantes para seleccionar Persona Juridica</h2>
    <div class="row">


        <div class="col-lg-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <table id="data-table-default" data-order='[[ 2, "asc" ]]' class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">
                                <th style="color:white;">Cedula</th>
                                <th style="color:white;">Nombres</th>

                                <!-- <th style="color:white;">estatus</th> -->
                                <th style="color:white;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($participantes as $data): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?= $data['cedula'] ?> </td>

                                    <td><?= $data['nombres'] ?> <?= $data['apellidos'] ?></td>


                                    <td>

                                        <a href="<?php echo base_url(); ?>index.php/Prei_juridico/pdfrt?id=<?php echo $data['codigo_planilla']; ?>"
                                            class="button">
                                            <i class="fas   fa-2x  fa-cloud-download-alt" title="Certificado"
                                                style="color: blue;"></i>
                                            <a />



                                            <a onclick="cargarIdInscripcion(<?php echo $data['id_participante'] ?>);"
                                                data-toggle="modal" data-target="#dede" style="color: white">
                                                <i title="Decisión" class="fas fa-2x fa-fw fa-address-card"
                                                    style="color: darkred;"></i>
                                            </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="dede" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingresar Desición</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag"
                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                        <div class="row">




                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b>Decisión</b></h5>
                                <div class="row ">
                                    <div class="form-group col-6">
                                        <label> Aceptado<b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <select style="width: 100%;" id="fm_ac" name="fm_ac" class="form-control"
                                            onchange="llenar_20()" data-show-subtext="true" data-live-search="true">
                                            <option value="0">Seleccione</option>
                                            <option value="2">Aceptada Solicitud</option>
                                            <option value="6">Aprobado/Proxima Corte</option>
                                            <option value="3">No Califica</option>
                                            <option value="5">Aprobado/Exonerado de pago</option>



                                        </select>
                                        <input class="form-control" type="text" name="id_inscripcion"
                                            id="id_inscripcion" readonly>


                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="direccion_fiscal" class="required-field">Observación</label>
                                        <textarea class="form-control" id="obser" name="obser" rows="3" cols="80"
                                            placeholder="Ej: puede ingresar una observacion"></textarea>
                                    </div>

                                    <div class="form-section" id='cmp1' style="display: none;">
                                        <div class="col-md-12 form-group">
                                            <label for="experiencia_publicas" class="required-field">Forma de
                                                pago</label>
                                            <select style="width: 100%;" id="tipo_pago" name="tipo_pago"
                                                class="form-control" data-show-subtext="true" data-live-search="true">
                                                <option value="0">Seleccione</option>
                                                <option value="1">Pronto Pago</option>
                                                <option value="2">Crédito</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_pago_fin" onclick="save_dec_pj();"
                        class="my-button">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cargarIdInscripcion(id) {
            // Asigna el ID al input del modal
            document.getElementById('id_inscripcion').value = id;
        }
    </script>

    <script src="<?= base_url() ?>/js/diplomado/diplomado.js"></script>