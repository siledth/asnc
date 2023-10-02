<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">
                    <form id="reg_bien" action="<?=base_url()?>index.php/Programacion/guardar_items_modificados_servi_reprogr" method="POST"
                        class="form-horizontal">
                        <div class="row">

                            <div class="col-1"></div>
                            <div class="col-10 mt-4">
                                <div class="card card-outline-danger text-center bg-white">
                                    <div class="card-block">
                                        <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                            <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente:
                                                <?=$des_unidad?>.</p>
                                            <p class="f-s-16">RIF.: <?=$rif?> <br>
                                            <p class="f-s-16">Fecha .: <?=$time ?> <br>
                                                <input type="text" id="id" name="id" value="<?=$id?>">
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php foreach($accion as $inf_1):?>

                            <div class="form-group col-8">
                                <label>editarsss  ID - ITEMS</label>
                                <input class="form-control" type="text" name="id_p_items" id="id_p_items"
                                    value="<?=$inf_1['id_p_items']?>" readonly>
                                    <input class="form-control" type="text" name="id_programacion" id="id_programacion"
                                    value=" <?=$id?>" readonly>
                                   
                            </div>
                            <div class="form-group col-8">
                                <label>Partida Presupuestaria<b style="color:red">*</b></label><br>
                                <input class="form-control" type="text" name="partda" id="partda"
                                    value="<?=$inf_1['codigopartida_presupuestaria']?>" readonly>
                                <input class="form-control" type="text" name="partda" id="partda"
                                    value="<?=$inf_1['desc_partida_presupuestaria']?>" readonly>

                            </div>
                            <div class="form-group col-6">
                                <label>CCNU</label>
                                <input type="text" class="form-control" name="desc_ccnu" id="desc_ccnu"
                                    value="<?=$inf_1['desc_ccnu']?>" disabled>

                            </div>
                            <div class="form-group col-6">
                                <label>Especificación</label>
                                <input type="text" class="form-control" name="especificacion" id="especificacion"
                                    value="<?=$inf_1['especificacion']?>">
                            </div>
                            <div class="form-group col-2">
                                <label>Unidad de Medida</label>
                                <select id="id_unidad_medida" name="id_unidad_medida" class="default-select2 form-control">
                                    <option value="<?=$inf_1['id_unidad_medida']?>"><?=$inf_1['desc_unidad_medida']?></option>
                                    <?php foreach ($unid as $data): ?>
                                        <option value="<?=$data['id_unidad_medida']?>"><?=$data['desc_unidad_medida']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Vuelva a confirmar el Rango de Fecha de ejecución del Servicio</label>
                                    <div class="input-group input-daterange">
                                        <input type="text" class="form-control"     id="start" onchange="verif_d();" onblur="habilitar_trim();" name="start" placeholder="Desde" />
                                        <span class="input-group-addon">-</span>
                                        <input type="text" class="form-control"    id="end" onchange="verif_h();" onblur="habilitar_trim();" name="end" placeholder="Hasta" />
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="card card-outline-danger">
                                    <h5 class="mt-3 text-center"><b>Ingrese Nueva Distribución Porcentual de la Ejecución Trimestral</b> <i style="color: red;" title="Para ingresar los datos correspondientes a cada trimestre, debe ingresar un Rango de Fecha." class="fas fa-question-circle"></i></h5>
                                    <div class="row mt-3">
                                        <div class="form-group col-2">
                                            <label>I<b style="color:red">*</b></label>
                                            <input id="I" name="I" type="text" onblur="calculo();"  class="form-control" onkeypress="return valideKey(event);" value="<?=$inf_1['i']?>" >
                                        </div>
                                        <div class="form-group col-2">
                                            <label>II<b style="color:red">*</b></label>
                                            <input id="II" name="II" type="text" onblur="calculo();"  class="form-control"  onkeypress="return valideKey(event);" value="<?=$inf_1['ii']?>" >
                                        </div>
                                        <div class="form-group col-2">
                                            <label>III<b style="color:red">*</b></label>
                                            <input id="III" name="III" type="text" onblur="calculo();"  class="form-control"  onkeypress="return valideKey(event);" value="<?=$inf_1['iii']?>" >
                                        </div>
                                        <div class="form-group col-2">
                                            <label>IV<b style="color:red">*</b></label>
                                            <input id="IV" name="IV" type="text" onblur="calculo();"  class="form-control"  onkeypress="return valideKey(event);" value="<?=$inf_1['iv']?>" >
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Cantd. Total Distribuir <b style="color:red">*</b></label>
                                            <input id="cant_total_distribuir" value="100" onblur="calculo();" name="cant_total_distribuir" type="number" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-4">
                            <label>Precio Total <b style="color:red">*</b></label>
                            <input id="precio_total" name="precio_total" type="text" onclick="cant_total();"
                                onblur="calculo();" class="form-control">
                        </div>
                        <div class="form-group col-2">
                            <label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
                            <select name="id_alicuota_iva" id="id_alicuota_iva" onchange="calculo();"
                                class="form-control">
                                <option value="">SELECCIONE</option>
                                <?php foreach ($iva as $data): ?>
                                <option value="<?=$data['desc_alicuota_iva']?>/<?=$data['desc_porcentaj']?>">
                                    <?=$data['desc_porcentaj']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto IVA Estimado<b style="color:red">*</b></label>
                            <input id="iva_estimado" name="iva_estimado" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto total Estimado<b style="color:red">*</b></label>
                            <input id="monto_estimado" name="monto_estimado" type="text" class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-2">
                            <label>Estimado I Trimestre</b></label>
                            <input id="estimado_i" name="estimado_i" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Estimado II Trimestre</label>
                            <input id="estimado_ii" name="estimado_ii" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Estimado III Trimestre</label>
                            <input id="estimado_iii" name="estimado_iii" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Estimado IV Trimestre</label>
                            <input id="estimado_iV" name="estimado_iV" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Estimado Total Trimestres</label>
                            <input id="estimado_total_t" name="estimado_total_t" type="text" class="form-control"
                            readonly>
                        </div>


                            <?php endforeach;?>

                        </div>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <button class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
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
<script src="<?=base_url()?>/js/programacion.js"></script>
<script src="<?=base_url()?>/js/calculos.js"></script>
<script src="<?=base_url()?>/js/servicio/agregar_ff.js"></script>
<script src="<?=base_url()?>/js/servicio/agregar_ip.js"></script>
<script src="<?=base_url()?>/js/servicio/registro.js"></script>
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