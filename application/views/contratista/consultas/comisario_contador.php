<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Ingrese número de Cédula a consultar</label>
                            <input class="form-control" type="text" name="nombre" id="nombre"
                                oninput="validarInput(this)" placeholder="Cédula a consultar">

                        </div>
                        <div class="col- mt-4">
                            <button type="button" class="btn btn-default" onclick="consultar_nombre();" name="button">
                                <i class="fas fa-search"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="inputs" style="display: none;">
            <form class="form-horizontal" id="resgistrar_eva" data-parsley-validate="true" method="POST"
                enctype="multipart/form-data">

                <div class="row">

                    <div class="col-12">
                        <h4 class="text-center mb-3 mt-3">Por Favor Ingrese estos datos</h4>
                    </div>
                    <div class="form-group col-3">
                        <label>Cedula Consultada <b title="Campo Obligatorio" style="color:red">*</b></label>
                        <input type="text" id="cedula" name="cedula" value="" class="form-control" readonly>
                    </div>

                    <div class="form-group col-3">
                        <label>N Oficio <b title="Campo Obligatorio" style="color:red">*</b></label>
                        <input type="text" name="numero_oficio" id="numero_oficio" class="form-control"
                            placeholder="numero_oficio">
                        <input type="hidden" name="existe" id="existe" class="form-control" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label>Observación <b title="Campo Obligatorio" style="color:red">*</b></label>
                        <textarea class="form-control" id="observacion" name="observacion" rows="4" cols="100"
                            required></textarea>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="registrar();" id="registrar_eval" name="registrar_eval"
                            class="my-button2">Guardar</button>
                    </div>

                </div>
        </div>
        </form>

        <div class="col-lg-12" style="display: none" id="items">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Información del Contratista </b></h4>
                </div>
                <div class="panel-body" id="existe">
                    <div class="row">
                        <div class="col-12">
                            <table id="tabla" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8">
                                    <tr class="text-center">
                                        <th>RIF</th>
                                        <th>Razón Social</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <!-- <th>n</th> -->
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
</script>
<script src="<?=base_url()?>/js/contratista/consulta_com_conta.js"></script>