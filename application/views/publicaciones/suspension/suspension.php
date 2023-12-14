<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">

                    <!-- <form id="reg_bien" action="<?=base_url()?>index.php/Publicaciones/guardar_Prorroga" method="POST"
                        class="form-horizontal"> -->
                    <form class="form-horizontal" id="guardar_ba" name="guardar_ba" data-parsley-validate="true"
                        method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-1"></div>
                            <div class="col-10 mt-4">
                                <div class="card card-outline-danger text-center bg-white">
                                    <div class="card-block">
                                        <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                            <p class="f-s-18 text-inverse f-w-600">
                                                <?=$descripcion?>.</p>
                                            <p class="f-s-16">RIF.: <?=$rif?> <br>
                                            <H2>Suspensiòn de un LLamado a concurso</H2>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php foreach($causa_suspencion as $causa_suspencion):?><?php endforeach;?>
                            <div class="col-12  form-group">
                                <div class="form-group col-10">
                                    <label>Marco Legal</label>
                                    <textarea class="form-control" name="articulo" id="articulo"
                                        rows="5" cols="200" readonly>  <?=$causa_suspencion['descripcion']?></textarea>
                                </div>
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            </div>
                            <?php foreach($inf_1 as $inf_1):?>
                            <div class="col-12  form-group">
                                <label>Número Proceso a Suspender <b style="color:red">*</b></label>
                                <input id="numero_proceso" name="numero_proceso" value="<?=$inf_1['numero_proceso']?>"
                                    type="hidden" class="form-control" readonly>
                                <input id="numero_proceso2" name="numero_proceso2"
                                    value="<?=$inf_1['numero_proceso']?> " type="text" class="form-control" readonly>
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            </div>
                            <div class="col-4  form-group">
                                <label>Fecha de Suspención </label>
                                <input class="form-control" type="text" name="fechapago" id="fechapago"
                                    value="<?=$time?>" readonly>


                            </div>
                            <?php endforeach;?>
                            <div class="form-group   col-5">
                                <label>Artículo 123 Procedencia de la suspensión
                                    Las causales para la, suspensión de los procedimientos de selección de
                                    contratista
                                    previstos en la
                                    Ley de Contrataciones Públicas, son: </label>
                                <select class="form-control" name="supuesto" id="supuesto" onclick="llenar_pago();">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($supuestos as $data) : ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="row" id='campos' style="display: none;">
                                <div class="form-group col-3">
                                    <label>Ingrese una Observación sobre la Suspensión</label>
                                    <textarea name="especifique_anulacion" id="especifique_anulacion" rows="5"
                                        cols="100"></textarea>
                                </div>
                            </div>
                        
                        </div>
                        <div class="form-group col 12 text-center">
                            <button type="button" onclick="guardar_suspencion();" id="guardar" name="guardar"
                                class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary">Guardar</button>
                            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                href="javascript:history.back()"> Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Registrar -->
    <script src="<?=base_url()?>/js/publicaciones/suspender.js"></script>
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