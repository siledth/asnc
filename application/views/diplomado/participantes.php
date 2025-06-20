    <link href="<?= base_url('css/diplomado.css') ?>" rel="stylesheet">

    <div class="sidebar-bg"></div>
    <div id="content" class="content">
        <h2>Participantes para seleccionar Persona Natural</h2>
        <div class="row">

        </div>

        <div class="row">


            <div class="col-lg-12">

                <div class="panel panel-inverse">
                    <div class="panel-heading"></div>
                    <div class="table-responsive">
                        <table id="data-table-default" data-order='[[ 2, "asc" ]]'
                            class="table table-bordered table-hover">
                            <thead style="background:#01cdb2">
                                <tr style="text-align:center">
                                    <th style="color:white;">Nombre del Diplomado</th>
                                    <th style="color:white;">Cedula</th>
                                    <th style="color:white;">Nombres</th>

                                    <!-- <th style="color:white;">estatus</th> -->
                                    <th style="color:white;">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($participantes as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $data['name_d'] ?> </td>
                                        <td><?= $data['cedula'] ?> </td>

                                        <td><?= $data['nombres'] ?> <?= $data['apellidos'] ?></td>


                                        <td>

                                            <a href="<?php echo base_url(); ?>index.php/Preinscripcionnatural/pdfrt?id=<?php echo $data['codigo_planilla']; ?>"
                                                class="button">
                                                <i class="fas   fa-2x  fa-cloud-download-alt" title="Certificado"
                                                    style="color: blue;"></i>
                                                <a />



                                                <a onclick="cargarIdInscripcion(<?php echo $data['id_inscripcion'] ?>);"
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

            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Inscripciones Persona Natural</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h5 class="m-t-0 m-b-3">Por Diplomado</h5>
                                        <ul class="list-group">
                                            <?php foreach ($inscripcion_stats['by_diplomado'] as $diplomado_stat): ?>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>Nombre del Diplomado : <?= $diplomado_stat['name_d'] ?></strong>
                                                    <span class="badge badge-primary badge-pill" title="Total Inscritos">
                                                        <?= $diplomado_stat['total_inscritos_diplomado'] ?>
                                                    </span>
                                                </li>
                                                <ul style="list-style: none; padding-left: 20px; font-size: 1.3em;">
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        Preinscrito
                                                        <span class="badge badge-info badge-pill">
                                                            <?= $diplomado_stat['total_preinscrito'] ?>
                                                        </span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        Aceptado / Espera Pago
                                                        <span class="badge badge-warning badge-pill">
                                                            <?= $diplomado_stat['total_aceptado_espera_pago'] ?>
                                                        </span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        Aprobado / Exonerado
                                                        <span class="badge badge-success badge-pill">
                                                            <?= $diplomado_stat['total_exonerado'] ?>
                                                        </span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        Aprobado / Próxima Corte
                                                        <span class="badge badge-danger badge-pill">
                                                            <?= $diplomado_stat['total_aprobado_proxima_corte'] ?>
                                                        </span>
                                                    </li>
                                                </ul>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center justify-content-around h-50">
                                    <div class="circle-stat bg-warning text-white">
                                        <span class="stat-value"><?= $inscripcion_stats['total_general'] ?? 0 ?></span>
                                        <span class="stat-label">TOTAL INSCRITOS</span>
                                    </div>

                                    <!-- <div class="circle-stat bg-info text-white">
                                        <span class="stat-value">
                                            <?php
                                            // $total_aprobados = 0;
                                            // foreach ($inscripcion_stats['by_diplomado'] as $d_stat) {
                                            //     $total_aprobados += $d_stat['total_aceptado_espera_pago'] + $d_stat['total_exonerado'];
                                            //     // ESTO ES LO QUE ESTABA SUMANDO ANTES
                                            // }
                                            // echo $total_aprobados;
                                            ?>
                                        </span>
                                        <span class="stat-label">TOTAL APROBADOS incluye aceptados y exonerados </span>
                                    </div> -->
                                    <div class="circle-stat bg-danger text-white">
                                        <span class="stat-value">
                                            <?php
                                            $total_preinscritos_global = 0;
                                            foreach ($inscripcion_stats['global_by_estatus'] as $global_stat) {
                                                if ($global_stat['estatus'] == 1) {
                                                    $total_preinscritos_global = $global_stat['total_global_estatus'];
                                                    break;
                                                }
                                            }
                                            echo $total_preinscritos_global;
                                            ?>
                                        </span>
                                        <span class="stat-label">PREINSCRITOS EN ESPERA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <input class="form-control" type="hidden" name="id_inscripcion"
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
                                                    class="form-control" data-show-subtext="true"
                                                    data-live-search="true">
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
                        <button type="button" id="guardar_pago_fin" onclick="save_inf_ac();"
                            class="my-button">Guardar</button>
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
                        <form class="form-horizontal" id="rrr" name="rrr" data-parsley-validate="true" method="POST"
                            enctype="multipart/form-data">
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

                                    <input type="hidden" id="vigen_cert_desde" name="vigen_cert_desde"
                                        class="form-control" value="<?= $time ?>" />
                                    <input type="hidden" id="vigen_cert_hasta" name="vigen_cert_hasta"
                                        class="form-control" />

                                </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                            data-dismiss="modal">Cerrar</button>
                        <button type="button" id="guardar_pago_fin" onclick="guardar_nuevoestatus();"
                            class="btn btn-primary">ACEPTO</button>
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