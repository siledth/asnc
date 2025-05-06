<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Diplomado</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Nombre del Diplomado <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" onkeypress="may(this);" type="text" name="name_d"
                                    id="name_d">
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Fecha de Inicio<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="fdesde" id="fdesde"
                                    placeholder="Denominacion social">
                            </div>
                            <div class="form-group col-6">
                                <label>Fecha de Culminación<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="fhasta" id="fhasta"
                                    placeholder="Denominacion social">
                            </div>
                            <div class="form-group col-6">
                                <label>Selecione Modalidad<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <select class="form-control" name="id_modalidad" id="id_modalidad">
                                    <option value="0">Seleccione</option>
                                    <option value="1">OnLine</option>
                                    <option value="2">Presencial</option>
                                    <option value="3">Bimodal</option>

                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Numero de Participantes Maximo<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="texto" name="fhasta" id="fhasta"
                                    placeholder="Denominacion social">
                            </div>
                            <div class="form-group col-6">
                                <label>Numero de Participantes Exonerados<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="texto" name="fhasta" id="fhasta"
                                    placeholder="Denominacion social">
                            </div>

                            <div class="form-group col-6">
                                <label>Costo del Diplomado<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="texto" name="fhasta" id="fhasta"
                                    placeholder="Denominacion social">
                            </div>

                            <div class="form-group col-6">
                                <label>Duración horas<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="texto" name="fhasta" id="fhasta"
                                    placeholder="Denominacion social">
                            </div>


                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_b();" id="guardar" name="guardar"
                            class="btn btn-primary mb-3">Guardar</button>
                    </div>
                    </from>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading"></div>
                    <div class="table-responsive">
                        <table id="records" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr>
                                    <th>Nombre Diplomado</th>
                                    <th>Fecha desde</th>
                                    <th>Fecha hasta</th>

                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($exonerado as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $data['name_d'] ?> </td>
                                        <td><?= $data['fdesde'] ?> </td>
                                        <td><?= $data['fhasta'] ?> </td>

                                        <td class="center">
                                            <!-- <a class="button">
                                                <i title="Editar" onclick="modal_ver(<?php echo $data['id_diplomado'] ?>);"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                                <a />
                                                <a class="button"><i
                                                        onclick="eliminar_b(<?php echo $data['id_diplomado'] ?>);"
                                                        class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a /> -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>/js/diplomado/diplomado.js"></script>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Exonerados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-sortable-id="form-validation-1">
                    <form class="form-horizontal" id="editar" data-parsley-validate="true" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-4">
                                <label>ID</label>
                                <input class="form-control" type="text" name="id" id="id" readonly>
                            </div>
                            <div class="col-8"></div>
                            <div class="form-group col-4">
                                <label>Rif</label>
                                <input class="form-control" type="text" onkeypress="return valideKey(event);"
                                    name="cod_banco_edit" id="cod_banco_edit">
                            </div>
                            <div class="form-group col-8">
                                <label>Nombre </label>
                                <input type="text" class="form-control" onkeypress="may(this);" id="nombre_banco_edit"
                                    name="nombre_banco_edit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="editar_b();" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>