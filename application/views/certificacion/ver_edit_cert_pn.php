<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">

                    <form id="reg_bien" action="<?=base_url()?>index.php/Certificacion/guardar_editar_certficado_pn"
                        method="POST" class="form-horizontal">
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
                                            <h4 style="color:red;">Editar Persona Natural</h4>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php foreach($inf_1 as $inf_1):?>
                            <div class="col-9 mt-2 form-group">
                                <label>N° de Comprobante Registro Unico <b style="color:red">*</b></label>
                                <input id="nro_comprobante" name="nro_comprobante"
                                    value="<?=$inf_1['nro_comprobante']?>" type="text" class="form-control" readonly>
                                    <input id="id_" name="id_"
                                    value="<?=$inf_1['id']?>" type="hidden" class="form-control" readonly>
                            </div>
                            <div class="col-2 mt-2 form-group">

                                <input id="tipo_pers" name="tipo_pers" value="<?=$inf_1['tipo_pers']?>" type="hidden"
                                    class="form-control" readonly>

                            </div>
                            <div class="form-group col-3">
                                <label>Registro de Información Fiscal (RIF) <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="text" id="rif_cont" name="rif_cont" onkeyup="mayusculas(this);"
                                    class="form-control   " onKeyUp="mayus(this);" value="<?=$inf_1['rif_cont']?>"
                                    readonly>

                            </div>
                            <div class="form-group col-3">
                                <label>Razón Social <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="nombre" name="nombre" onkeyup="mayusculas(this);"
                                    class="form-control   " onKeyUp="mayus(this);" value="<?=$inf_1['nombre']?>"
                                    readonly>

                            </div>
                            <div class="form-group col-3">
                                <label>N° de Comprobante del Registro Nacional de Contratistas (RNC) <b
                                        title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="numcertrnc" name="numcertrnc" onkeyup="mayusculas(this);"
                                    class="form-control   " onKeyUp="mayus(this);" value="<?=$inf_1['n_certif']?>"
                                    readonly>

                            </div>
                            <div class="form-group col-3">
                                <label>Fecha solicitud <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input id="fecha_solic" name="fecha_solic"
                                    value="<?=date("d/m/Y", strtotime($inf_1['fecha_solic']));?>" type="text"
                                    class="form-control" readonly>

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





                            <div class="panel-body">
                                <div class="row">
                                    <?php foreach ($inf__15 as $data): ?>
                                    <div class="form-group col-8">
                                        <label>Nombres y Apellidos <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>

                                        <input class="form-control" type="text" name="nombre_ape" id="nombre_ape"
                                            value="<?=$data['nombre_ape']?>" onkeyup="mayusculas(this);">

                                    </div>

                                    <div class="form-group col-4">
                                        <label>N.º. Cédula de Identidad: <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="cedula" id="cedula"
                                            value="<?=$data['cedula']?>">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>N.º. RIF: <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="rif" id="rif"
                                        value="<?=$data['rif']?>">
                                    </div>
                                    <?php endforeach; ?>
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
                                        <label>Tasa Bolivares<b style="color:red">*</b></label>
                                        <?php foreach ($inf_14 as $data): ?>
                                        <input id="bolivar_estimado" name="bolivar_estimado" type="text"
                                            class="form-control" value="<?=$data['valor']?>" readonly>
                                        <?php endforeach; ?>

                                    </div>


                                    <div class="form-group col-2">
                                        <label>Iva<b style="color:red">*</b></label>
                                        <?php foreach ($inf__15 as $data): ?>
                                        <input id="iva_estimado" name="iva_estimado" type="text" class="form-control"
                                            value="<?=$data['sub_total']?>" readonly>
                                            <?php endforeach; ?>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Total Bolivares<b style="color:red">*</b></label>
                                        <input id="monto_estimado" name="monto_estimado" type="text"
                                            value="<?=$data['total_final']?>" class="form-control" readonly>
                                    </div>
                                   
                                    <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                    </div>
                                    <h5 class="text-center"><b style="color:red;">
                                            Ingrese La Informacion de Pago</b> </h5>


                                    <div class="form-group col-8">
                                        <label class="col-form-label col-md-6 text-right">Numero de
                                            Cuenta </label>
                                        <textarea class="form-control" name="h" id="v" rows="3" cols="50"
                                            readonly>El número de Cuenta Corriente Nº 01020552270000042877 del Banco de Venezuela, a nombre del Servicio Nacional de Contrataciones.</textarea>
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
                                        <label>Bs trasnferidos <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <input type="text" id="monto_trans" name="monto_trans" class="form-control  "
                                            value="<?=$inf_1['monto_trans']?>" />

                                    </div>
                                    <div class="form-group col-2">
                                        <label>N° de Referencia <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <input type="text" id="n_ref" name="n_ref" class="form-control "
                                            value="<?=$inf_1['n_ref']?>" />

                                    </div>

                                    <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 style="color:red;"> Información de la Formación Profesional</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label> Formación Académica <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <select style="width: 100%;" class="default-select2 form-control "
                                                id="for_academica" name="for_academica" readonly>
                                                <option value="Maestria">Maestria</option>
                                                <option value="Licenciatura">Licenciatura</option>
                                                <option value="Postgrado">Postgrado</option>
                                                <option value="Superior">Superior</option>
                                                <option value="Bachiller">Bachiller</option>
                                                <option value="Especialización">Especialización</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-4">
                                            <label>Título Obtenido <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="titulo" id="titulo"
                                                placeholder="Actividad" onkeyup="mayusculas(this);">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Año de Inicio (aaaa) <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="number" name="ano" id="ano"
                                                placeholder="2010">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Culminación (aaaa)<b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="culminacion" id="culminacion"
                                                placeholder="2020">

                                        </div>
                                        <div class="form-group col-4">
                                            <label>En Curso <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <select class="default-select2 form-control " id="curso" name="curso"
                                                readonly>
                                                <option value="">Seleccionar</option>
                                                <option value="No">No</option>
                                                <option value="Si">Si</option>
                                            </select>
                                        </div>

                                        <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe
                                            tener al menos
                                            un
                                            registro agregado, para proceder con la solicitud.</h5>

                                        <div class="col-12 text-center">
                                            <button type="button" onclick="agregar_infor_perso(this);"
                                                class="btn btn-lg btn-default">
                                                Agregar
                                            </button>
                                        </div>

                                        <div class="table-responsive mt-4">
                                            <h6 class="text-center">Nota: si desea editar una fila, debe
                                                <b>Descartar</b> y
                                                Proceder a <b>Agregar</b>.
                                            </h6>
                                            <table id="target_infor_perso" class="table table-bordered table-hover">
                                                <thead style="background:#e4e7e8;">
                                                    <tr class="text-center">
                                                        <th>Formación Académica</th>
                                                        <th>Título Obtenido</th>
                                                        <th>Año de Inicio</th>
                                                        <th>Culminación</th>
                                                        <th>En Curso</th>

                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                    </div>
                                    <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 style="color:red;"> Formación en Materia de Contratación Pública</h4>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label> Taller o Curso de Comisión de Contrataciones <b
                                                    title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="taller" id="taller"
                                                placeholder="Nombre" onkeyup="mayusculas(this);">
                                        </div>

                                        <div class="form-group col-4">
                                            <label>Institución donde realizó la Formación<b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="institucion" id="institucion"
                                                placeholder="institucion" onkeyup="mayusculas(this);">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Horas de Duración <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="number" name="hor_dura" id="hor_dura">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>N.º del Certificado <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="certi" id="certi"
                                                onkeyup="mayusculas(this);">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Fecha Certificado <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="date" name="fech_cert" id="fech_cert"
                                                max="<?=$time?>">


                                        </div>
                                        <div class="form-group col-4">
                                            <label>Vigencia<b title="Campo Obligatorio" style="color:red">no
                                                    debe dar mas de 2 años</b></label>
                                            <input class="form-control" type="text" name="vigencia" id="vigencia"
                                                readonly>
                                        </div>

                                        <h6 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe
                                            tener al menos
                                            un
                                            registro agregado, para proceder con la solicitud.</h6>

                                        <div class="col-12 text-center">
                                            <button type="button" onclick="agregar_for_mat_cert(this);"
                                                class="btn btn-lg btn-default">
                                                Agregar
                                            </button>
                                        </div>

                                        <div class="table-responsive mt-4">
                                            <h6 class="text-center">Nota: si desea editar una fila, debe
                                                <b>Descartar</b> y
                                                Proceder a <b>Agregar</b>.
                                            </h6>
                                            <table id="target_for_mat_cer" class="table table-bordered table-hover">
                                                <thead style="background:#e4e7e8;">
                                                    <tr class="text-center">
                                                        <th>Taller o Curso</th>
                                                        <th>Institución</th>
                                                        <th>Horas de Duración</th>
                                                        <th>N.º del Certificado</th>
                                                        <th>Fecha Certificado</th>
                                                        <th>Vigencia</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 10);">
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 style="color:red;"> Experiencia de Participación en Comisiones de
                                            Contrataciones (en los últimos 10 años)</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label> Órgano o Ente de la Comisión de Contrataciones <b
                                                    title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="organo10" id="organo10"
                                                placeholder="Nombre">
                                        </div>

                                        <div class="form-group col-6">
                                            <label>Acto Administrativo de Designación<b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <select style="width: 100%;" class="default-select2 form-control "
                                                id="act_adminis_desid" name="act_adminis_desid" readonly>
                                                <option value="Gaceta">Gaceta</option>
                                                <option value="Providencia">Providencia</option>
                                                <option value="Resolución">Resolución</option>
                                                <option value="Punto de Cuenta">Punto de Cuenta</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>N° del Acto <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="number" name="n_acto" id="n_acto">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Fecha <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="date" name="fecha_act" id="fecha_act"
                                                max="<?=$time?>">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Área <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <select style="width: 100%;" class="default-select2 form-control "
                                                id="area_10" name="area_10" readonly>
                                                <option value="Legal">Legal</option>
                                                <option value="Económica Financiera">Económica Financiera
                                                </option>
                                                <option value="Técnica">Técnica</option>
                                                <option value="Secretario">Secretario</option>
                                                <option value="Secretaria">Secretaria</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Duración en la Comisión (tiempo) <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="dura_comi" id="dura_comi">
                                        </div>

                                        <h6 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe
                                            tener al menos
                                            un
                                            registro agregado, para proceder con la solicitud.</h6>

                                        <div class="col-12 text-center">
                                            <button type="button" onclick="agregar_exp_10(this);"
                                                class="btn btn-lg btn-default">
                                                Agregar
                                            </button>
                                        </div>

                                        <div class="table-responsive mt-4">
                                            <h6 class="text-center">Nota: si desea editar una fila, debe
                                                <b>Descartar</b> y
                                                Proceder a <b>Agregar</b>.
                                            </h6>
                                            <table id="target_exp_10" class="table table-bordered table-hover">
                                                <thead style="background:#e4e7e8;">
                                                    <tr class="text-center">
                                                        <th>Órgano/Ente/Institución/Empresa</th>
                                                        <th>Acto Administrativo de Designación</th>
                                                        <th>N° del Acto</th>

                                                        <th>Área</th>
                                                        <th>Duración en la Comisión</th>
                                                        <th>Fecha</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 10);">
                                    </div>
                                    <div class="col-12 text-center">
                                        <h4 style="color:red;"> Experiencia en Dictado de Capacitación en Materia de
                                            Comisión de Contrataciones (en los últimos 3 años)</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label> Órgano o Ente de la Comisión de Contrataciones <b
                                                    title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="organo3" id="organo3"
                                                placeholder="Nombre" onkeyup="mayusculas(this);">
                                        </div>

                                        <div class="form-group col-4">
                                            <label>Actividad<b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="actividad3" id="actividad3"
                                                placeholder="Actividad" onkeyup="mayusculas(this);">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="date" name="desde3" id="desde3"
                                                max="<?=$time?>">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="date" name="hasta3" id="hasta3"
                                                max="<?=$time?>">
                                        </div>
                                        <div class="col-12">
                                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                        </div>
                                        <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe
                                            tener al menos
                                            un
                                            registro agregado, para proceder con la solicitud.</h5>

                                        <div class="col-12 text-center">
                                            <button type="button" onclick="agregar_ex3a(this);"
                                                class="btn btn-lg btn-default">
                                                Agregar
                                            </button>
                                        </div>

                                        <div class="table-responsive mt-4">
                                            <h6 class="text-center">Nota: si desea editar una fila, debe
                                                <b>Descartar</b> y
                                                Proceder a <b>Agregar</b>.
                                            </h6>
                                            <table id="target_es_3a" class="table table-bordered table-hover">
                                                <thead style="background:#e4e7e8;">
                                                    <tr class="text-center">
                                                        <th>Órgano o Ente de la Comisión de Contrataciones</th>
                                                        <th>Actividad.</th>
                                                        <th>Desde.</th>
                                                        <th>Hasta</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
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