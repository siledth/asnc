<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">

                    <form id="reg_bien" action="<?=base_url()?>index.php/Certificacion/editar_certficado" method="POST"
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
                                            <p class="f-s-16">Fecha.: <?=date("d/m/Y", strtotime($time)); ?> <br>
                                                <input type="hidden" id="id" name="id" value="<?=$rif_cont?>">

                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php foreach($inf_1 as $inf_1):?>
                            <div class="col-9 mt-2 form-group">
                                <label>N° de Comprobante Registro Unico <b style="color:red">*</b></label>
                                <input id="nro_comprobante" name="nro_comprobante" value="<?=$inf_1['nro_comprobante']?>"
                                    type="text" class="form-control" readonly>
                              
                            </div>
                            <div class="form-group col-3">
                                <label>Registro de Información Fiscal (RIF) <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="text" id="rif_cont" name="rif_cont" onkeyup="mayusculas(this);" class="form-control   "
                                    onKeyUp="mayus(this);" value="<?=$inf_1['rif_cont']?>" readonly>

                            </div>
                            <div class="form-group col-3">
                                <label>Razón Social <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text"id="nombre" name="nombre" onkeyup="mayusculas(this);" class="form-control   "
                                    onKeyUp="mayus(this);" value="<?=$inf_1['nombre']?>" readonly>

                            </div>
                            <div class="form-group col-3">
                                <label>N° de Comprobante del Registro Nacional de Contratistas (RNC) <b
                                        title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="numcertrnc" name="numcertrnc" onkeyup="mayusculas(this);" class="form-control   "
                                    onKeyUp="mayus(this);" value="<?=$inf_1['n_certif']?>" readonly>

                            </div>
                            <div class="form-group col-3">
                                <label>Fecha solicitud <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input id="fecha_solic" name="fecha_solic" value="<?=date("d/m/Y", strtotime($inf_1['fecha_solic']));?>" type="text"
                                    class="form-control" readonly>

                            </div>

                            <div class="form-group col-2">
                                <label>Banco Emisor</label>
                                <select id="banco_e" name="banco_e" class="default-select2 form-control">
                                    <option value="<?=$inf_1['banco_e']?>"><?=$inf_1['banco_e']?></option>
                                    <?php foreach ($bancos as $data): ?>
                                    <option value="<?=$data['nombre_b']?>"><?=$data['nombre_b']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label>Banco Receptor</label>
                                <select id="banco_rec" name="banco_rec" class="default-select2 form-control">
                                    <option value="<?=$inf_1['banco_rec']?>"><?=$inf_1['banco_rec']?></option>
                                    <?php foreach ($bancos as $data): ?>
                                    <option value="<?=$data['nombre_b']?>"><?=$data['nombre_b']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label>Fecha de Trasferencia <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="text" id="fecha_trans" name="fecha_trans" class="form-control  "
                                    value="<?=date("d/m/Y", strtotime($inf_1['fecha_trans']));?>" />

                            </div>
                            <div class="form-group col-2">
                                <label>Bolivares Cancelar <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="monto_trans" name="monto_trans" class="form-control  "
                                    value="<?=$inf_1['monto_trans']?>" />

                            </div>
                            <div class="form-group col-2">
                                <label>N° de Referencia <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="n_ref" name="n_ref" class="form-control "
                                    value="<?=$inf_1['n_ref']?>" />

                            </div>
                            <div class="col-12 mt-0 text-center">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                                <h6 style="color:red;">PROGRAMA DEL CURSO O TALLER</h6>
                            </div>
                            <div class="form-group col-2">
                                <label>Objetivo <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <textarea class="form-control" name="objetivo" id="objetivo" rows="5" cols="70"
                                    onkeyup="mayusculas(this);"><?=$inf_1['objetivo']?></textarea>

                            </div>
                            <div class="form-group col-2">
                                <label>Contenido Programático <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>

                                <textarea class="form-control" name="cont_prog" id="cont_prog" rows="5" cols="100"
                                    onkeyup="mayusculas(this);"><?=$inf_1['cont_prog']?></textarea>
                            </div>
                            <?php endforeach;?>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>
                            <div class="col-12 text-center">
                                <h6 style="color:red;">Experiencia de la Empresa en Capacitación en Materias
                                    Relacionadas
                                    Con Contratación Pública (en los últimos 5 años)</h6>
                            </div>

                            <div class="form-group col-8">
                                <label> Órgano o Ente de la Comisión de Contrataciones <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="text" name="organo_experi_empre_capa"
                                    id="organo_experi_empre_capa" placeholder="Nombre" onkeyup="mayusculas(this);">
                            </div>

                            <div class="form-group col-4">
                                <label>Actividad<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="text" name="actividad_experi_empre_capa"
                                    id="actividad_experi_empre_capa" placeholder="Actividad"
                                    onkeyup="mayusculas(this);">
                            </div>
                            <div class="form-group col-4">
                                <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="desde_experi_empre_capa"
                                    id="desde_experi_empre_capa" max="<?=$time?>">
                            </div>
                            <div class="form-group col-4">
                                <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="hasta_experi_empre_capa"
                                    id="hasta_experi_empre_capa" max="<?=$time?>">
                            </div>




                            <div class="col-12">
                                <h5 class="text-center"><b style="color:red;">NOTA:</b> Debe llenar todos lo items para
                                    llenar la tabla. <br>

                                </h5>
                            </div>
                            <div class="col-5"></div>
                            <div class="col-7 mt-4">
                                <button type="button" onclick="agregar_experi_empre_capa(this);"
                                    class="btn btn-lg btn-default" id="prueba2">
                                    Agregar
                                </button>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <div class="col-11" style="margin-left: 40px;">
                                <div class="table-responsive mt-3">
                                    <h5 class="text-center">Nota: si desea editar una fila, debe <b>Descartar</b> y
                                        Proceder a <b>Agregar</b>.</h5>
                                    <table id="target_es_5a" class="table table-bordered table-hover">
                                        <thead style="background:#e4e7e8;">
                                            <tr class="text-center">
                                                <th>Órgano/Ente/Institución/Empresa</th>
                                                <th>Actividad.</th>
                                                <th>Desde</th>
                                                <th>Hasta</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="inf_ff">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>

                            <div class="col-12 text-center">
                                <h6 style="color:red;"> Experiencia de la Empresa en Capacitación en Comisión de
                                    Contrataciones (en los últimos 3 años)</h6>
                            </div>

                            <div class="form-group col-8">
                                <label>Órgano/Ente/Institución/Empresa <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input class="form-control" type="text" name="organo_expe" id="organo_expe"
                                    placeholder="Nombre" onkeyup="mayusculas(this);">
                            </div>

                            <div class="form-group col-4">
                                <label>Actividad <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="text" name="actividad_exp" id="actividad_exp"
                                    placeholder="Actividad" onkeyup="mayusculas(this);">
                            </div>
                            <div class="form-group col-4">
                                <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="desde_exp" id="desde_exp"
                                    max="<?=$time?>">
                            </div>
                            <div class="form-group col-4">
                                <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="date" name="hasta_exp" id="hasta_exp"
                                    max="<?=$time?>">
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-4">
                                        <h5 class="text-center"><b style="color:red;">NOTA:</b> Debe
                                            llenar
                                            todos lo
                                            items para
                                            llenar la tabla. <br>

                                        </h5>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-7 mt-4">
                                        <button type="button" onclick="agregar_ff(this);" class="btn btn-lg btn-default"
                                            id="prueba2">
                                            Agregar <b>Experiencia</b>
                                        </button>
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <h6 class="text-center">Nota: si desea editar una fila, debe <b>Descartar</b> y
                                            Proceder a <b>Agregar</b>.</h6>
                                        <table id="target_acc_ff" class="table table-bordered table-hover">
                                            <thead style="background:#e4e7e8;">
                                                <tr class="text-center">
                                                    <th>Órgano/Ente/Institución/Empresa</th>
                                                    <th>Actividad</th>
                                                    <th>Desde</th>
                                                    <th>Hasta</th>
                                                    <th>Acciones</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                    </div>

                                    <div class="col-12 text-center">
                                        <h6 style="color:red;"> INFORMACIÓN DE LA PERSONA NATURAL (que dicta la
                                            capacitación)</h6>
                                    </div>
                                    <div class="form-group col-8">
                                        <label>Nombres y Apellidos <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="nombre_ape" id="nombre_ape"
                                            placeholder="Nombre" onkeyup="mayusculas(this);">
                                    </div>

                                    <div class="form-group col-4">
                                        <label>N.º. Cédula de Identidad: <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="cedula" id="cedula"
                                            placeholder="cedula">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>N.º. RIF: <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="rif" id="rif" placeholder="Rif">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Alícuota IVA Estimado<b style="color:red">*</b></label><br>
                                        <select style="width: 100%;" name="id_alicuota_iva" id="id_alicuota_iva"
                                            onchange="calcular();" class="form-control">
                                            <option value="">SELECCIONE</option>
                                            <?php foreach ($inf_12 as $data): ?>
                                            <option
                                                value="<?=$data['desc_alicuota_iva']?>/<?=$data['desc_porcentaj']?>">
                                                <?=$data['desc_porcentaj']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-2">
                                        <label>taza Bolivares<b style="color:red">*</b></label>
                                        <?php foreach ($inf_11 as $data): ?>
                                        <input id="bolivar_estimado" name="bolivar_estimado" type="text"
                                            class="form-control" value="<?=$data['valor']?>" readonly>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="form-group col-1">
                                        <input id="iva_estimado" name="iva_estimado" type="hidden" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="form-group col-1">
                                        <input id="monto_estimado" name="monto_estimado" type="hidden"
                                            class="form-control" readonly>
                                    </div>

                                    <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                    </div>
                                    <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla
                                        debe tener al
                                        menos
                                        un
                                        registro agregado, para proceder con la solicitud.</h5>

                                    <div class="col-12 text-center">
                                        <button type="button" onclick="agregar_persona(this);"
                                            class="btn btn-lg btn-default">
                                            Agregar
                                        </button>
                                    </div>

                                    <div class="table-responsive mt-4">

                                        <h6 class="text-center"><b style="color:red;">NOTA:</b> La tabla
                                            debe tener
                                            al
                                            menos un
                                           dato agregado, para proceder con la solicitud.</h6>

                                        <table id="target_persona" class="table table-bordered table-hover">
                                            <thead style="background:#e4e7e8;">
                                                <tr class="text-center">
                                                    <th>Nombres y Apellidos</th>
                                                    <th>N.º. Cédula de Identidad.</th>
                                                    <th>N.º. RIF</th>
                                                    <th>Taza Facilitador</th>
                                                   
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="form-group row col-6">
                                        <label class="col-form-label col-md-6 text-right">Persona
                                            Jurídica </label>
                                        <div class="col-md-6">


                                            <?php foreach ($inf_14 as $data): ?>
                                            <input id="pj" name="pj" type="text" class="form-control text-center"
                                                value="<?= $data['valor']?>" readonly>
                                            <?php endforeach; ?>

                                            <input id="total_iva" name="total_iva" type="hidden"
                                                class="form-control text-center" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="form-group row col-6">
                                        <label class="col-form-label col-md-6 text-right">Subtotal</label>
                                        <div class="col-md-6">

                                            <input id="sub_total" name="sub_total" type="text"
                                                class="form-control text-center" readonly>


                                        </div>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="form-group row col-6">
                                        <label class="col-form-label col-md-6 text-right">IVA</label>
                                        <div class="col-md-6">

                                            <input id="total_pj" name="total_pj" type="hidden"
                                                class="form-control text-center" readonly>


                                            <input id="total_final" name="total_final" type="text"
                                                class="form-control text-center" readonly>

                                        </div>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="form-group row col-6">
                                        <label class="col-form-label col-md-6 text-right">Bolivares a
                                            Pagar </label>
                                        <div class="col-md-6">
                                            <input id="total_bs" name="total_bs" type="hidden"
                                                class="form-control text-center" readonly>
                                            <input id="total_bss" name="total_bss" type="text"
                                                class="form-control text-center" readonly>
                                        </div>
                                    </div> -->

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


    
    <script src="<?=base_url()?>/js/certificacion/registro_certifi.js"></script>
    <script src="<?=base_url()?>/js/certificacion/certificacion.js"></script>
    <script src="<?=base_url()?>/js/certificacion/agregar_organo.js"></script>
    <script src="<?=base_url()?>/js/certificacion/expe_capa.js"></script>
    <script src="<?=base_url()?>/js/certificacion/agregar_perona.js"></script>
    <script src="<?=base_url()?>/js/certificacion/calcular.js"></script>
    <script src="<?=base_url()?>/js/certificacion/infor_perso.js"></script>
    <script src="<?=base_url()?>/js/certificacion/for_mat_cert.js"></script>
    <script src="<?=base_url()?>/js/certificacion/exp_10.js"></script>
    <script src="<?=base_url()?>/js/certificacion/ex_3a.js"></script>
    <script src="<?=base_url()?>/js/certificacion/experi_empre_capa.js"></script>
    <script src="<?=base_url()?>/js/certificacion/calcular_vigencia.js"></script>

    <script src="<?=base_url()?>/js/certificacion/llenar_editado.js"></script>
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