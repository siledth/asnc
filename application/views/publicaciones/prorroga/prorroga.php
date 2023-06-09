<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">

                    <!-- <form id="reg_bien" action="<?=base_url()?>index.php/Publicaciones/guardar_Prorroga" method="POST"
                        class="form-horizontal"> -->
                    <form class="form-horizontal" id="guardar_ba" name="guardar_ba" data-parsley-validate="true" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-1"></div>
                            <div class="col-10 mt-4">
                                <div class="card card-outline-danger text-center bg-white">
                                    <div class="card-block">
                                        <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                            <p class="f-s-18 text-inverse f-w-600">
                                                <?=$descripcion?>.</p>
                                            <p class="f-s-16">RIF.: <?=$rif?> <br>
                                            <H2>Prorroga de un LLamado a concurso</H2>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php foreach($causa_prorroga as $causa_prorroga):?><?php endforeach;?>
                            <div class="col-12  form-group">
                                <div class="form-group col-10">
                                    <label>Marco Legal</label>
                                    <textarea class="form-control" name="causa_prorroga" id="causa_prorroga" rows="5"
                                        cols="200" readonly>  <?=$causa_prorroga['descripcion']?></textarea>
                                </div>
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            </div>
                            <?php foreach($inf_1 as $inf_1):?>
                            <div class="col-12  form-group">
                                <label>Número Proceso a Prorrogar <b style="color:red">*</b></label>
                                <input id="numero_proceso" name="numero_proceso" value="<?=$inf_1['numero_proceso']?>"
                                    type="hidden" class="form-control" readonly>
                                <input id="numero_proceso2" name="numero_proceso2"
                                    value="<?=$inf_1['numero_proceso']?> " type="text" class="form-control" readonly>
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            </div>
                            <div class="col-4  form-group">
                                <label>Fecha Fin de llamado <b style="color:red">*</b><i style="color: red;"
                                        title="Ingresar Nueva fecha" class="fas fa-question-circle"></i></label>
                                <input id="fecha_fin_llamado" name="fecha_fin_llamado"
                                    value="<?=$inf_1['fecha_fin_llamado']?>" type="date" class="form-control"
                                    min="<?=$inf_1['fecha_fin_llamado']?>" onchange="getSinFestivosNiFinDeSemana();">

                                    <div id="result-finde"></div>
                                
                            </div>
                           
                            <div class="col-4  form-group">
                                <label>Fecha Tope <b style="color:red">*</b></label>
                                <input id="fecha_tope" name="fecha_tope" type="date" class="form-control" readonly>


                            </div>
                            <div class="col-12  form-group">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                                <h4> Hora para Retiro de Pliego </h4>
                            </div>
                            <div class="col-4  form-group">
                                <label>Hora desde <b style="color:red">*</b><i style="color: red;"
                                        title="Si desea modificar, ingrese nueva hora desde para de retiro de pliego" class="fas fa-question-circle"></i></label>
                                <input id="hora_desde" name="hora_desde" value="<?=$inf_1['hora_desde']?>" type="time"
                                    class="form-control" min="<?=$inf_1['hora_desde']?>">
                            </div>
                            <div class="col-4  form-group">
                                <label>Hora hasta <b style="color:red">*</b><i style="color: red;"
                                        title="Si desea modificar, ingrese nueva hora hasta para de retiro de pliego" class="fas fa-question-circle"></i></label>
                                <input id="hora_hasta" name="hora_hasta" value="<?=$inf_1['hora_hasta']?>" type="time"
                                    class="form-control" min="<?=$inf_1['hora_hasta']?>">
                            </div>
                            <div class="col-12  form-group">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                                <h4> Acto de Recepciòn y Apertura de sobre </h4>
                            </div>
                            <div class="col-4  form-group">
                                <label>Fecha Entrega de Sobre <b style="color:red">*</b></label>
                                <input id="fecha_entrega_sobre" name="fecha_entrega_sobre" type="date"
                                    class="form-control" readonly>
                            </div>
                            <div class="col-4  form-group">
                                <label>Hora de Inicio del Acto Público <b style="color:red">*</b><i style="color: red;"
                                        title="Si desea modificar, ingrese nueva hora desde para entrega de sobre" class="fas fa-question-circle"></i></label>
                                <input id="hora_desde_sobre" name="hora_desde_sobre" value="<?=$inf_1['hora_desde_sobre']?>" type="time"
                                    class="form-control" min="<?=$inf_1['hora_desde_sobre']?>">
                            </div>
                            <div class="col-4  form-group">
                                <label>Observaciones del LLamado a Concurso <b style="color:red">*</b><i style="color: red;"
                                        title="Si desea modificar, ingrese nueva observacion" class="fas fa-question-circle"></i></label>
                                        <textarea class="form-control" name="observaciones" value=""
                                        id="observaciones" rows="5" cols="200">  <?=$inf_1['observaciones']?></textarea>
                            </div>
                            
                            <?php endforeach;?>

                            <div class="form-group mt-20  col-5">
                                <div class="form-group">
                                    <label for="">Ingrese una Observación sobre la Prorroga <b style="color:red">*</b><i style="color: red;"
                                        title="Ingrese Motivo de la Prorroga" class="fas fa-question-circle"></i></label>
                                        <textarea class="form-control" name="especifique_anulacion" id="especifique_anulacion" rows="3"
                                                cols="70" onkeyup="mayusculas(this);"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="form-group col 12 text-center">
                            <button type="button" onclick="guardar_prorroga();" id="guardar" name="guardar"
                                class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary">Guardar</button>
                            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                href="javascript:history.back()"> Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>/js/publicaciones/dias_fer_habi.js"></script>
    <script src="<?=base_url()?>/js/publicaciones/prorroga.js"></script>

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