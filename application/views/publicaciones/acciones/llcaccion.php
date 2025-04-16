<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                </div>

                <div class="col-12 text-center mt-3 mb-3">
                    <h4 class="text-center mb-3 mt-3">Acciones al llamado a concurso SNC</h4>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Ingrese Numero de proceso</label>
                            <input class="form-control" type="text" name="nombre" id="nombre"
                                placeholder="numero de proceso">

                        </div>
                        <div class="col- mt-4">
                            <button type="button" class="btn btn-default" onclick="consultar_nombre6();" name="button">
                                <i class="fas fa-search"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loading" style="display: none; text-align: center; margin: 20px;">
            <h4 class="text-center mb-3 mt-3">Buscando, por favor espere...</h4>
            <!-- Puedes agregar un spinner aquí si lo deseas -->
        </div>


        <div class="col-lg-12" style="display: none" id="items">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>Información </b></h4>
                </div>
                <div class="panel-body" id="existe">
                    <div class="row">
                        <div class="col-12">
                            <table id="tabla" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8">
                                    <tr class="text-center">
                                        <th>Numero de proceso </th>
                                        <th>Organo</th>
                                        <th>Acción</th>
                                        <th># contrato</th>
                                        <th>monto_contrato</th>
                                        <th>total_contrato</th>
                                        <th> Eliminar</th>
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
<script src="<?= base_url() ?>js/publicaciones/llcacciones.js"></script>
<!-- C.A. 2024-14 -->