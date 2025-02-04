<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />

    <title>Solicitud de Usuarios SNC</title>
</head>

<body>
    <section>
        <div class="content">

            <div class="panel-body">
                <div class="col-12 ml-1">
                    <div class="card card-outline-danger text-center bg-white">
                        <div class="card-block">
                            <blockquote class="card-blockquote" style="margin-bottom: -15px;">
                                <img style="width: 100%" height="100%" src=" <?= base_url() ?>Plantilla/img/loij.png"
                                    alt="Card image">
                            </blockquote>
                        </div>
                    </div>
                    <div class="card card-outline-danger text-center bg-white">
                        <div class="card-block">
                            <blockquote class="card-blockquote" style="margin-bottom: -15px;">
                                <div class="panel-body">
                                    <form class="form-horizontal" id="sav_ext" name="sav_ext"
                                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="text-center"> <b>PLANILLA DE CREACIÓN O ACTUALIZACIÓN DE
                                                        DATOS
                                                    </b></h4>
                                                <h6 class="text-center"> <b>
                                                        Sistema Integrado SNC</b></h6>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <label><i style="color: red;"
                                                                title="Ingrese el Rif, para continuar."
                                                                class="fas fa-question-circle">Ingrese el Rif, para
                                                                continuar*</i></label>
                                                        <input class="form-control" type="text" name="rif_b" id="rif_b"
                                                            onkeypress="may(this);" placeholder="G123456789"
                                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                                            onKeyUp="this.value=this.value.toUpperCase();"
                                                            onblur="consultar_rif();">


                                                    </div>
                                                    <div class="form-group col-12" id='existe' style="display: none;">
                                                        <label>Ingrese Rif <i style="color: red;" title="Ingrese el Rif"
                                                                class="fas fa-question-circle"></i></label>
                                                        <div class="row">

                                                            <div class="form-group col-6">
                                                                <label>Rif del Órgano / Ente</label>
                                                                <input class="form-control" type="text"
                                                                    name="sel_rif_nombre5" id="sel_rif_nombre5"
                                                                    readonly>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label>Nombre del Órgano / Ente: </label>
                                                                <input type="text" name="nombre_conta_5"
                                                                    id="nombre_conta_5" class="form-control" readonly>
                                                            </div>
                                                            <div class="col-4">
                                                                <label>RIF Órgano/Ente de Adscripción: <b ,
                                                                        style="color:red">*</b> </label>
                                                                <input id="rifadscrito1" name="rifadscrito1"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="col-8">
                                                                <label>Nombre Órgano/Ente de Adscripción: <b
                                                                        style="color:red">*</b> </label>
                                                                <input id="nameadscrito1" name="nameadscrito1"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label>Codigo ONAPRE<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label>
                                                                <input type="text" id="cod_onapre1" name="cod_onapre1"
                                                                    onkeyup="mayusculas(this);" class="form-control"
                                                                    placeholder="Codigo Onapre" maxlength="20">

                                                            </div>
                                                            <div class="form-group col-3">
                                                                <label>Siglas<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label>
                                                                <input type="text" id="siglas1" name="siglas1"
                                                                    onkeyup="mayusculas(this);" class="form-control"
                                                                    placeholder="siglas" maxlength="12">

                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Clasificación</label><br>
                                                                <select id="id_clasificacion1" name="id_clasificacion1"
                                                                    class="default-select2 form-control"
                                                                    style="width: 300px;">
                                                                    <option value="0">-Seleccione -</option>
                                                                    <?php foreach ($clasificacion as $data): ?>
                                                                    <option value="<?=$data['id_clasificacion']?>">
                                                                        <?=$data['desc_clasificacion']?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-3 form-group">
                                                                <label>Teléfono Local<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label>
                                                                <input type="number" id="tel_local1" name="tel_local1"
                                                                    class="form-control" placeholder="042XXXXXXX">
                                                                <p id="errorMsg"></p>

                                                            </div>
                                                            <div class="col-3 form-group">
                                                                <label>Página Web<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label>
                                                                <input type="text" id="pag_web1" name="pag_web1"
                                                                    class="form-control" placeholder="pagina web"
                                                                    maxlength="20">

                                                            </div>

                                                            <div class="form-group col-12">
                                                                <label>Dirección Fiscal<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label><br>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Estado</label>
                                                                <select class="form-control" name="id_estado_n1"
                                                                    id="id_estado_n1"
                                                                    onclick="llenar_municipio();listar_ciudades();">
                                                                    <option value="0">Seleccione</option>
                                                                    <?php foreach ($estados as $data): ?>
                                                                    <option value="<?=$data['id']?>">
                                                                        <?=$data['descedo']?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Municipio</label>
                                                                <select class="form-control" name="id_municipio_n1"
                                                                    id="id_municipio_n1" onclick="llenar_parroquia();">
                                                                    <option value="0">Seleccione</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Parroquia</label>
                                                                <select class="form-control" name="id_parroquia_n1"
                                                                    id="id_parroquia_n1">
                                                                    <option value="0">Seleccione</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <label>Dirección Fiscal</label>
                                                                <textarea class="form-control" id="direccion_fiscal1"
                                                                    name="direccion_fiscal1" rows="3"
                                                                    cols="125"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12" id='no_existe'
                                                        style="display: none;">

                                                        <div class="row">
                                                            <div class="col-4">
                                                                <label>Ingrese Rif <i style="color: red;"
                                                                        title="Ingrese el Rif , sin guiones ni punto."
                                                                        class="fas fa-question-circle"></i></label>
                                                                <input
                                                                    title="Debe ingresar una palabra para realizar la busqueda"
                                                                    type="text" class="form-control"
                                                                    onKeyUp="this.value=this.value.toUpperCase();"
                                                                    name="rif_55" id="rif_55"
                                                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                                            </div>
                                                            <div class="col-8">
                                                                <label>Nombre del Órgano / Ente: <b
                                                                        style="color:red">*</b> </label>
                                                                <input id="razon_social" name="razon_social"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>RIF Órgano/Ente de Adscripción: <b ,
                                                                        style="color:red">*</b> </label>
                                                                <input id="rifadscrito" name="rifadscrito"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>Nombre Órgano/Ente de Adscripción: <b
                                                                        style="color:red">*</b> </label>
                                                                <input id="nameadscrito" name="nameadscrito"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <label>Codigo ONAPRE<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label>
                                                                <input type="text" id="cod_onapre" name="cod_onapre"
                                                                    onkeyup="mayusculas(this);" class="form-control"
                                                                    placeholder="Codigo Onapre" maxlength="20">

                                                            </div>
                                                            <div class="form-group col-2">
                                                                <label>Siglas<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label>
                                                                <input type="text" id="siglas" name="siglas"
                                                                    onkeyup="mayusculas(this);" class="form-control"
                                                                    placeholder="siglas" maxlength="12">

                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Clasificación</label><br>
                                                                <select id="id_clasificacion" name="id_clasificacion"
                                                                    class="default-select2 form-control"
                                                                    style="width: 300px;">
                                                                    <option value="0">-Seleccione -</option>
                                                                    <?php foreach ($clasificacion as $data): ?>
                                                                    <option value="<?=$data['id_clasificacion']?>">
                                                                        <?=$data['desc_clasificacion']?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-3 form-group">
                                                                <label>Teléfono Local<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label>
                                                                <input type="number" id="tel_local" name="tel_local"
                                                                    class="form-control" placeholder="042XXXXXXX">
                                                                <p id="errorMsg"></p>

                                                            </div>
                                                            <div class="form-group col-3"><br>
                                                                <label>Página Web<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label>
                                                                <input type="text" id="pag_web" name="pag_web"
                                                                    class="form-control" placeholder="pagina web"
                                                                    maxlength="20">

                                                            </div>

                                                            <div class="form-group col-12">
                                                                <label>Dirección Fiscal<b title="Campo Obligatorio"
                                                                        style="color:red">*</b></label><br>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Estado</label>
                                                                <select class="form-control" name="id_estado_n"
                                                                    id="id_estado_n"
                                                                    onclick="llenar_municipio();listar_ciudades();">
                                                                    <option value="0">Seleccione</option>
                                                                    <?php foreach ($estados as $data): ?>
                                                                    <option value="<?=$data['id']?>">
                                                                        <?=$data['descedo']?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Municipio</label>
                                                                <select class="form-control" name="id_municipio_n"
                                                                    id="id_municipio_n" onclick="llenar_parroquia();">
                                                                    <option value="0">Seleccione</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-4">
                                                                <label>Parroquia</label>
                                                                <select class="form-control" name="id_parroquia_n"
                                                                    id="id_parroquia_n">
                                                                    <option value="0">Seleccione</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <label>Dirección Fiscal</label>
                                                                <textarea class="form-control" id="direccion_fiscal"
                                                                    name="direccion_fiscal" rows="3"
                                                                    cols="125"></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Nombre(s), Apellido(s) de la
                                                            Máxima Autoridad o Cuentadante:<b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input type="text" id="name_max_a_f" name="name_max_a_f"
                                                            onkeyup="mayusculas(this);" maxlength="50"
                                                            class="form-control" placeholder="Nombre completo">

                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Cargo de la Máxima Autoridad o Cuentadante:<b
                                                                title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input type="text" id="cargo__max_a_f" name="cargo__max_a_f"
                                                            onkeyup="mayusculas(this);" maxlength="50"
                                                            class="form-control" placeholder="Nombre completo">

                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>DATOS DEL USUARIO O USUARIA DE LA CLAVE<b
                                                                title="Campo Obligatorio"
                                                                style="color:red">*</b></label><br>
                                                    </div>
                                                    <div class="form-group col-3">
                                                        <label>Cédula de Identidad <b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input type="text" id="cedula_f" name="cedula_f" maxlength="8"
                                                            onblur="validateUsers();"
                                                            placeholder="ingrese la Cédula sin punto ni coma"
                                                            class="form-control" />

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Nombre completo <b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input type="text" id="name_f" name="name_f"
                                                            onkeyup="mayusculas(this);" maxlength="50"
                                                            class="form-control" placeholder="Nombre completo">

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Apellido Completo <b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input type="text" id="apellido_f" name="apellido_f"
                                                            onkeyup="mayusculas(this);" maxlength="50"
                                                            class="form-control" placeholder="Nombre completo">

                                                    </div>

                                                    <div class="form-group col-2">
                                                        <label>Cargo <b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input type="text" id="cargo_f" name="cargo_f"
                                                            placeholder="Cargo" onkeyup="mayusculas(this);"
                                                            maxlength="50" class="form-control" />


                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>Teléfono <b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input type="text" id="telefono_f" name="telefono_f"
                                                            placeholder="Teléfono 1" maxlength="20"
                                                            class="form-control" />

                                                    </div>
                                                    <div class="form-group col-5">
                                                        <label>Correo Electrónico<b title="Campo Obligatorio"
                                                                style="color:red"> (Institucional o cifrado
                                                                seguro)
                                                                A este correo se enviará el usuario y/o
                                                                clave*</b></label>
                                                        <input type="email" id="correo" name="correo"
                                                            class="form-control"
                                                            placeholder="ingrese correo institucional"
                                                            oninput="validateEmail()">

                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label><b title="Campo Obligatorio" style="color:red">SOLICITUD
                                                                DE ACCESO A LOS MÓDULOS*</b></label><br>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="registrar_prog_anual"
                                                                name="registrar_prog_anual">
                                                            Registro de Programación Anual de Compras (Art. 38
                                                            DRVLCP)
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="modi_prog_anual_ley"
                                                                name="modi_prog_anual_ley">
                                                            Registro de la Modificación a la Programación (Art.
                                                            38 numeral 2 DRVLCP)
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="reg_rend_anual"
                                                                name="reg_rend_anual">
                                                            Registro de la Rendición (Art. 38 numeral 3 DRVLCP)
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="consl_p_m_r" name="consl_p_m_r">
                                                            Consulta (Programación, Modificación a la
                                                            Programación y Rendición)
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="reg_llamado" name="reg_llamado">
                                                            Registro de los Llamados a Concurso (Solo para la
                                                            Secretaria o Secretario de la Comisión de
                                                            Contratación) (Art. 79 DRVLCP)
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="consul_ll" name="consul_ll">
                                                            Consulta de los Llamados a Concurso
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="procesos_ll" name="procesos_ll">
                                                            Procesos de los Llamados a Concurso
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="accion_llamado"
                                                                name="accion_llamado">
                                                            Acción de los Llamados a Concurso
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="menu_reg_eval_desem"
                                                                name="menu_reg_eval_desem">
                                                            Registro de la Evaluación de Desempeño (Art. 51
                                                            DRVLCP)
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="menu_soli_anular_eval_desem"
                                                                name="menu_soli_anular_eval_desem">
                                                            Solicitud de anulación de Evaluación de Desempeño
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="menu_comprobante_eval_desem"
                                                                name="menu_comprobante_eval_desem">
                                                            Consulta de Evaluación de Desempeño
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="reg_not_mb_comi"
                                                                name="reg_not_mb_comi">
                                                            Registro de notificación de Miembros de Comisión
                                                            (Art. 14 DRVLCP)
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="reg_cert_mb_comi"
                                                                name="reg_cert_mb_comi">
                                                            Solicitud de Certificación de Miembros de Comisión
                                                            (Art. 14 DRVLCP)
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="consulta_mb_comi"
                                                                name="consulta_mb_comi">
                                                            Consulta Comisión de Contratación
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-4"><br>
                                                        <label>
                                                            <input type="checkbox" id="ver_rnc" name="ver_rnc">
                                                            Consulta de Contratistas Registrados ante el RNC
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">

                                    <button type="button" id="guardar" onclick="save(event);"
                                        class="btn btn-primary">Guardar</button>
                                </div>
                            </blockquote>
                        </div>
                    </div>


                </div>


            </div>
            <style>
            input[type="checkbox"] {
                width: 20px;
                height: 20px;
                margin-right: 10px;
            }
            </style>



        </div>
    </section>
</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
    integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous">
</script>

<script src="<?=base_url()?>/js/solicitud/solicitud.js">
< /html>
<?php if (!$this->session->userdata('session')) { ?>
    <
    style >
    .content {
        margin - left: 0;
    } <
    /style>
<?php } ?>