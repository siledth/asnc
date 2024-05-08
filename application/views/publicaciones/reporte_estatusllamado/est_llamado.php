<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
    <div class="row">
            <div class="col-1 mb-3">
                <a class="btn btn-circle waves-effect  waves-circle waves-float btn-primary"
                    href="javascript:history.back()"> Volver</a>
            </div>
            <div class="col-1 mb-3">
                <button class="btn btn-circle waves-effect waves-circle waves-float btn-primary" type="submit"
                    onclick="printDiv('areaImprimir');" name="action">Imprimir</button>
            </div>
        </div>
        <div class="row" id="imp1">
            <div class="panel panel-inverse">

                <div class="row">
                    <div class="card card-outline-danger text-center bg-white">
                        <div class="card-block">
                            <blockquote class="card-blockquote" style="margin-bottom: -15px;">
                                <img style="width: 100%" height="100%" src=" <?= base_url() ?>Plantilla/img/loij.png"
                                    alt="Card image">
                            </blockquote>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        <h4> Llamado a Concurso </h4>
                    </div>
                    <?php foreach($inf_2 as $inf_1):?>
                    <div class="col-12 text-center">
                        <h6> Datos del Organo o Ente</h6>
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                    </div>
                    <div class="form-group col-3">
                        <label>Rif</label>
                        <input class="form-control" type="text" name="rif_organoente" id="rif_organoente" value="<?=$inf_1['rif_organoente']?>" readonly>
                    </div>
                    <div class="form-group col-8">
                        <label>Denominación social </label>
                        <input type="text" class="form-control" id="organoente" name="organoente" value="<?=$inf_1['organoente']?>" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label>Siglas</label>
                        <input class="form-control" type="text" name="siglas" id="siglas" value="<?=$inf_1['siglas']?>" readonly>
                    </div>
                    <div class="form-group col-8">
                        <label>Pagina Web</label>
                        <input class="form-control" type="text" name="web_contratante" id="web_contratante" value="<?=$inf_1['web_contratante']?>" readonly>
                    </div>
                    <div class="col-12 text-center">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        <h5> Llamados a Concurso </h5>
                    </div>


                    <div class="form-group col-4">
                        <label>Número de Proceso</label>
                        <input class="form-control" type="text" name="numero_proceso" id="numero_proceso" value="<?=$inf_1['numero_proceso']?>"readonly>
                    </div>
                    <div class="form-group col-8">
                        <label>Denominación del Proceso </label>
                        <textarea class="form-control" id="denominacion_proceso" name="denominacion_proceso" rows="6"
                            cols="80"  readonly> <?=$inf_1['denominacion_proceso']?> </textarea>
                    </div>

                    <div class="form-group col-4">
                        <label>Fecha de Llamado </label>
                        <input type="text" class="form-control" id="fecha_llamado" name="fecha_llamado" value="<?=date("d/m/Y", strtotime($inf_1['fecha_llamado']));?>" readonly>
                    </div>

                    <div class="form-group col-2">
                        <label>Estatus </label>
                        <input type="text" class="form-control" id="estatus" name="estatus" value="<?=$inf_1['estatus']?>" readonly>
                    </div>
                    <div class="form-group col-8">
                        <label>Descripción de Contratación </label>
                        <textarea class="form-control" id="descripcion_contratacion" name="descripcion_contratacion"
                            rows="15" cols="80" readonly>   <?=$inf_1['descripcion_contratacion']?> </textarea>

                    </div>
                    <div class="col-12 text-center">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        <h5> LAPSOS</h5>
                    </div>
                    <div class="form-group col-3">
                        <label>Modalidad </label>
                        <input type="text" class="form-control" id="modalidad" name="modalidad" value="<?=$inf_1['modalidad']?>" readonly>
                    </div>
                    <div class="form-group col-5">
                        <label>Mecanismo </label>
                        <input type="text" class="form-control" id="mecanismo" name="mecanismo" value="<?=$inf_1['mecanismo']?>"readonly>
                    </div>
                    <div class="form-group col-3">
                        <label>Objeto de Contratación </label>
                        <input type="text" class="form-control" id="objeto_contratacion" name="objeto_contratacion"
                        value="<?=$inf_1['objeto_contratacion']?>" readonly >
                    </div>
                    <!-- <div class="form-group col-2">
                                        <label>Días hábiles</label>
                                        <input type="text" class="form-control" id="dias_habiles" name="dias_habiles"
                                            readonly>
                                    </div> -->
                    <div class="form-group col-5">
                        <label>Fecha de Disponibilidad</label>
                        <input type="text" class="form-control" id="fecha_disponible_llamado"
                            name="fecha_disponible_llamado"    value="<?=date("d/m/Y", strtotime($inf_1['fecha_disponible_llamado']));?>"readonly>
                    </div>
                    <div class="form-group col-5">
                        <label>Fecha Fin</label>
                        <input type="text" class="form-control" id="fecha_fin_llamado" name="fecha_fin_llamado"
                        value="<?=date("d/m/Y", strtotime($inf_1['fecha_fin_llamado']));?>"readonly>
                    </div>
                    <br><br><br><br><br><br>
                    <div class="col-12 text-center">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        <h5> DIRECCIÓN PARA ADQUISICIÓN DE RETIRO DE PLIEGO</h5>
                    </div>
                    <div class="form-group col-6">
                        <label>Hora desde</label>
                        <input type="text" class="form-control" id="hora_desde" name="hora_desde" value="<?=$inf_1['hora_desde']?>" readonly>
                    </div>
                    <!-- <div class="form-group col-6">
                                        <label>Hora desde</label>
                                        <input type="text" class="form-control" id="hora_desdes" name="hora_desdes"
                                            readonly>
                                    </div> -->
                    <div class="form-group col-2">
                        <label>Hora hasta</label>
                        <input type="text" class="form-control" id="hora_hasta" name="hora_hasta"  value="<?=$inf_1['hora_hasta']?>"readonly>
                    </div>
                    <div class="form-group col-8">
                        <label>Dirección</label>
                        <textarea class="form-control" id="direccion" name="direccion" rows="6" cols="80"
                            readonly> <?=$inf_1['direccion']?> </textarea>
                    </div>
                    <div class="col-12 text-center">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        <h5> PERÍODOS DE ACLARATORIA</h5>
                    </div>
                    <div class="form-group col-4">
                        <label>Fecha Inicio de Aclaratoria</label>
                        <input type="text" class="form-control" id="fecha_inicio_aclaratoria"
                            name="fecha_inicio_aclaratoria" value="<?=date("d/m/Y", strtotime($inf_1['fecha_inicio_aclaratoria']));?>"readonly>
                    </div>
                    <div class="form-group col-4">
                        <label>Fecha Fin de Aclaratoria:</label>
                        <input type="text" class="form-control" id="fecha_fin_aclaratoria" name="fecha_fin_aclaratoria"
                        value="<?=date("d/m/Y", strtotime($inf_1['fecha_fin_aclaratoria']));?>" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label>Fecha Tope</label>
                        <input type="text" class="form-control" id="fecha_tope" name="fecha_tope" value="<?=date("d/m/Y", strtotime($inf_1['fecha_tope']));?>" readonly>
                    </div>
                    <div class="col-12 text-center">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        <h5>APERTURA DE SOBRES</h5>
                    </div>
                    <div class="form-group col-2">
                        <label>Fecha de Entrega</label>
                        <input type="text" class="form-control" id="fecha_fin_llamados" name="fecha_fin_llamados"
                        value="<?=date("d/m/Y", strtotime($inf_1['fecha_fin_llamado']));?>"  readonly>
                    </div>
                    <div class="form-group col-2">
                        <label>Hora Desde:</label>
                        <input type="text" class="form-control" id="hora_desde_sobre" name="hora_desde_sobre" value="<?=$inf_1['hora_desde_sobre']?>"  readonly>
                    </div>
                    <div class="form-group col-8">
                        <label>Lugar de Entrega</label>
                        <textarea class="form-control" id="lugar_entrega" name="lugar_entrega" rows="9" cols="80"
                            readonly> <?=$inf_1['lugar_entrega']?>"   </textarea>
                    </div>
                    <div class="form-group col-12">
                        <label>Dirección</label>
                        <textarea class="form-control" id="direccion_sobre" name="direccion_sobre" rows="6" cols="80"
                            readonly> <?=$inf_1['direccion_sobre']?>  </textarea>
                    </div>
                    <div class="form-group col-12">
                        <label>Observaciones</label>

                        <textarea class="form-control" id="observaciones" name="observaciones" rows="6" cols="80"
                            readonly>  <?=$inf_1['observaciones']?> </textarea>
                    </div>

                    <div class="form-group col-12">
                        <label>Especificación</label>

                        <textarea class="form-control" id="especifique_anulacion" name="especifique_anulacion" rows="2"
                            cols="80" readonly>  <?=$inf_1['especifique_anulacion']?>   </textarea>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>

    </div>


    <script type="text/javascript">
    function printDiv(nombreDiv) {
        var contenido = document.getElementById('imp1').innerHTML;
        var contenidoOriginal = document.body.innerHTML;

        document.body.innerHTML = contenido;

        window.print();

        document.body.innerHTML = contenidoOriginal;
    }
    </script>