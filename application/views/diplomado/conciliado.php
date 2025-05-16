<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Conciliado</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>N planilla <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" onkeypress="may(this);" type="text" name="name_d"
                                    id="name_d">
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>fecha de pago<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="fdesde" id="fdesde"
                                    placeholder="Denominacion social">
                            </div>
                            <div class="form-group col-6">
                                <label>Bolivares Recibo<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="number" name="fhasta" id="fhasta"
                                    placeholder="Denominacion social">
                            </div>

                            <div class="form-group col-6">
                                <label>numero de recibo<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="number" name="topmax" id="topmax"
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