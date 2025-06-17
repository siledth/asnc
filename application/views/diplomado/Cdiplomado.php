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
                                <input class="form-control" type="number" name="topmax" id="topmax">
                            </div>
                            <div class="form-group col-6">
                                <label>Numero de Participantes Exonerados<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="number" name="topmin" id="topmin">
                            </div>

                            <div class="form-group col-6">
                                <label>Costo del Diplomado<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="number" name="pay" id="pay" placeholder=" "
                                    oninput="dividirCosto()">
                            </div>
                            <div class="form-group col-6">
                                <label>Costo pronto pago<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="number" name="pronto_pago" id="pronto_pago"
                                    placeholder=" ">
                            </div>
                            <div class="form-group col-6">
                                <label>Primer Pago (50%)</label>
                                <input class="form-control" type="number" name="pay1" id="pay1" placeholder=" "
                                    readonly>
                            </div>

                            <div class="form-group col-6">
                                <label>Segundo Pago (50%)</label>
                                <input class="form-control" type="number" name="pay2" id="pay2" placeholder=" "
                                    readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Fecha desde SEGUNDO PAGO CREDITO<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="date" name="pago2desde" id="pago2desde"
                                    placeholder=" ">
                            </div>

                            <div class="form-group col-6">
                                <label>Fecha hasta SEGUNDO PAGO CREDITO<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="date" name="pago2hasta" id="pago2hasta"
                                    placeholder=" ">
                            </div>

                            <div class="form-group col-6">
                                <label>Duración horas<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="number" name="d_hrs" id="d_hrs">
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
                        <table id="data-table" class="table table-bordered table-hover">
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
                                            <a class="button">
                                                <i title="Editar" onclick="modal_ver(<?php echo $data['id_diplomado'] ?>);"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                                <a />

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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Diplomado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-sortable-id="form-validation-1">
                    <form class="form-horizontal" id="editar_diplomado_form" data-parsley-validate="true" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nombre del Diplomado <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" onkeypress="may(this);" type="text" name="name_d_edit"
                                    id="name_d_edit">
                                <input type="hidden" name="id_diplomado_edit" id="id_diplomado_edit" readonly>

                            </div>
                            <div class="form-group col-md-6">
                                <label>Fecha de Inicio<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="fdesde_edit" id="fdesde_edit">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Fecha de Culminación<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="fhasta_edit" id="fhasta_edit">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Selecione Modalidad<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <select class="form-control" name="id_modalidad_edit" id="id_modalidad_edit">
                                    <option value="0">Seleccione</option>
                                    <option value="1">OnLine</option>
                                    <option value="2">Presencial</option>
                                    <option value="3">Bimodal</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Numero de Participantes Maximo<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="number" name="topmax_edit" id="topmax_edit">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Numero de Participantes Exonerados<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="number" name="topmin_edit" id="topmin_edit">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Costo del Diplomado<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="number" name="pay_edit" id="pay_edit" placeholder=" "
                                    oninput="dividirCostoEdit()">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Costo pronto pago<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="number" name="pronto_pago_edit" id="pronto_pago_edit"
                                    placeholder=" ">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Primer Pago (50%)</label>
                                <input class="form-control" type="number" name="pay1_edit" id="pay1_edit"
                                    placeholder=" " readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Segundo Pago (50%)</label>
                                <input class="form-control" type="number" name="pay2_edit" id="pay2_edit"
                                    placeholder=" " readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Fecha desde SEGUNDO PAGO CREDITO<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="date" name="pago2desde_edit" id="pago2desde_edit"
                                    placeholder=" ">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Fecha hasta SEGUNDO PAGO CREDITO<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="date" name="pago2hasta_edit" id="pago2hasta_edit"
                                    placeholder=" ">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Duración horas<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="number" name="d_hrs_edit" id="d_hrs_edit">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="editar_diplomado();" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dividirCostoEdit() {
            const costoTotal = document.getElementById('pay_edit').value;
            const mitad = costoTotal / 2;
            document.getElementById('pay1_edit').value = mitad;
            document.getElementById('pay2_edit').value = mitad;
        }
    </script>

    <script>
        function dividirCosto() {
            // Obtener el valor del campo principal
            const costoTotal = document.getElementById('pay').value;

            // Calcular la mitad
            const mitad = costoTotal / 2;

            // Asignar el valor a los otros dos campos
            document.getElementById('pay1').value = mitad;
            document.getElementById('pay2').value = mitad;
        }
    </script>