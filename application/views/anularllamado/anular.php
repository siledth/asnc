<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">

                    <form id="reg_bien" action="<?=base_url()?>index.php/Publicaciones/guardar_anulacion" method="POST"
                        class="form-horizontal">
                        <div class="row">

                            <div class="col-1"></div>
                            <div class="col-10 mt-4">
                                <div class="card card-outline-danger text-center bg-white">
                                    <div class="card-block">
                                        <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                            <p class="f-s-18 text-inverse f-w-600">
                                                <?=$descripcion?>.</p>
                                            <p class="f-s-16">RIF.: <?=$rif?> <br>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php foreach($inf_1 as $inf_1):?>
                            <div class="col-9 mt-2 form-group">
                                <label>Número Proceso <b style="color:red">*</b></label>
                                <input id="numero_proceso" name="numero_proceso" value="<?=$inf_1['numero_proceso']?>"
                                    type="hidden" class="form-control" readonly>
                                    <input id="numero_proceso2" name="numero_proceso2" value="<?=$inf_1['numero_proceso']?>."
                                    type="text" class="form-control" readonly>
                                    <input id="estatus" name="estatus" value="ANULADO"
                                    type="hidden" class="form-control" readonly>
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">

                            </div>


                            <div class="form-group mt-20  col-5">
                                <div class="form-group col-10">
                                    <label>CAUSAS DE ANULACIÓN DEL LLAMADO</label>
                                    <select id="observaciones" name="observaciones" class="default-select2 form-control">
                                        
                                        <?php foreach ($causas as $data): ?>
                                        <option value="<?=$data['descripcion']?>"><?=$data['descripcion']?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php endforeach;?>



                            </div>
                            <div class="form-group mt-20  col-5">
                            <div class="form-group">
                                <label for="">Observación</label>
                                <input type="text" class="form-control" id="especifique_anulacion" name="especifique_anulacion">
                            </div>

                            </div>
                            <div class="row text-center mt-3">
                                <div class="col-6">
                                    <button
                                        class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                        type="submit" id="btn_guardar" name="button">Guardar</button>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                        href="javascript:history.back()"> Volver</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>/js/llenar_editar_proy.js"></script>
    <!-- Agegar Propietario -->
    <script src="<?=base_url()?>/js/bien/agregar_ff.js"></script>
    <!-- Agegar Tripulacion -->
    <script src="<?=base_url()?>/js/bien/agregar_ip.js"></script>
    <!-- Calcular cannon -->
    <script src="<?=base_url()?>/js/bien/calculo_canon.js"></script>
    <!-- Registrar -->
    <script src="<?=base_url()?>/js/bien/registro.js"></script>
    <script type="text/javascript">
    function mayusculas(e) {
        e.value = e.value.toUpperCase();
    }
    </script>
    <script type="text/javascript">
    function valideKey(evt) {
        var code = (evt.which) ? evt.which : evt.keyCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    }
    </script>