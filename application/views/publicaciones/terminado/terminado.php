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
                                            <H2>Terminar Manual un LLamado a concurso</H2>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php foreach($terminar_manual as $terminar_manual):?><?php endforeach;?>
                        <div class="col-12  form-group">
                            <div class="form-group col-10">
                                <label>Marco Legal</label>
                                <textarea class="form-control" name="causa_termino" id="causa_termino" rows="5"
                                    cols="50" readonly>  <?=$terminar_manual['descripcion']?></textarea>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                        </div>
                            <?php foreach($inf_1 as $inf_1):?>
                            <div class="col-12  form-group">
                                <label>Número Proceso a Terminar <b style="color:red">*</b></label>
                                <input id="numero_proceso" name="numero_proceso" value="<?=$inf_1['numero_proceso']?>"
                                    type="hidden" class="form-control" readonly>
                                <input id="numero_proceso2" name="numero_proceso2"
                                    value="<?=$inf_1['numero_proceso']?> " type="text" class="form-control" readonly>
                                    <input id="estatus" name="estatus"
                                    value="0" type="hidden" class="form-control" readonly>
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            </div>
                            <div class="col-4  form-group">
                                <label>Fecha de Terminado </label>
                                <input class="form-control" type="text" name="fechapago" id="fechapago"
                                    value="<?=$time?>" readonly>


                            </div>
                            <?php endforeach;?>
                            <div class="form-group col-3">
                        <label>Ingrese una Observación sobre Terminación Manual</label>
                        <textarea name="especifique_anulacion" id="especifique_anulacion" rows="5" cols="100"></textarea>
                    </div>
                        
                        </div>
                        <div class="form-group col 12 text-center">
                            <button type="button" onclick="guardar_termino_manual();" id="guardar" name="guardar"
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
    <script src="<?=base_url()?>/js/publicaciones/prorroga.js"></script>
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