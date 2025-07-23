<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Solicitud de Usuarios SNC </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="<?= base_url('css/solicitud.css') ?>" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

    <script type="text/javascript">
        // Las variables globales y funciones de callback deben estar aquí, ANTES de solcitud.js
        var RECAPTCHA_SITE_KEY = '<?php echo $this->config->item('recaptcha_site_key'); ?>';
        var recaptchaWidgetId; // Global variable to store the widget ID

        // Función de callback de reCAPTCHA - Se ejecuta cuando la API de reCAPTCHA está lista
        var onloadCallback = function() {
            if (document.getElementById('recaptcha-widget-main')) {
                recaptchaWidgetId = grecaptcha.render('recaptcha-widget-main', {
                    'sitekey': RECAPTCHA_SITE_KEY, // Usa la variable global
                    'theme': 'light'
                });
                console.log("reCAPTCHA widget renderizado. ID:", recaptchaWidgetId);
            } else {
                console.error("Error: Elemento 'recaptcha-widget-main' no encontrado en el DOM.");
            }
        };

        // Función para reiniciar el reCAPTCHA - Esto borra la marca "No soy un robot"
        function resetRecaptcha() {
            if (typeof grecaptcha !== 'undefined' && typeof grecaptcha.reset === 'function' && recaptchaWidgetId !==
                undefined) {
                grecaptcha.reset(recaptchaWidgetId);
                console.log("reCAPTCHA widget reiniciado.");
            } else {
                console.warn("No se pudo reiniciar reCAPTCHA: grecaptcha no definido o widgetId inválido.");
            }
        }
    </script>
</head>

<body>
    <div class="container my-5">
        <div class="card mx-auto" style="max-width: 900px;">
            <img style="max-width: 900px;" src="<?= base_url() ?>Plantilla/img/loij.png" alt="Logo">
            <div class="card-header text-center">

                <h4 class="mb-0 mt-2">PLANILLA DE CREACIÓN O ACTUALIZACIÓN DE DATOS</h4>
                <h5 class="mb-0">Sistema Integrado SNC</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" id="sav_ext" name="sav_ext" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data" data-rif-status="">

                    <div class="form-section">
                        <h5 class="text-primary mb-3"><i class="fas fa-building mr-2"></i>Datos del Órgano / Ente
                            Solicitante</h5>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rif_b">
                                    Ingrese el Rif para continuar
                                    <i class="fas fa-question-circle" style="color: red;"
                                        title="Ingrese el Rif, para continuar."></i>
                                    <span class="required-asterisk">*</span>
                                </label>
                                <input class="form-control" type="text" name="rif_b" id="rif_b" onkeypress="may(this);"
                                    placeholder="G123456789"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                    onkeyup="this.value=this.value.toUpperCase();" onblur="consultar_rif();">
                            </div>
                        </div>

                        <div id='existe' style="display: none;">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sel_rif_nombre5">Rif del Órgano / Ente :</label>
                                    <input class="form-control" type="text" name="sel_rif_nombre5" id="sel_rif_nombre5"
                                        readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre_conta_5">Nombre del Órgano / Ente:</label>
                                    <input type="text" name="nombre_conta_5" id="nombre_conta_5" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cod_onapre_existe">Código ONAPRE:</label>
                                    <input class="form-control" type="text" name="cod_onapre_existe"
                                        id="cod_onapre_existe" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="siglas_existe">Siglas:</label>
                                    <input class="form-control" type="text" name="siglas_existe" id="siglas_existe"
                                        readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="clasificacion_existe">Clasificación Órgano/Ente:</label>
                                    <input class="form-control" type="text" name="clasificacion_existe"
                                        id="clasificacion_existe" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tel_local_existe">Teléfono:</label>
                                    <input class="form-control" type="text" name="tel_local_existe"
                                        id="tel_local_existe" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pag_web_existe">Página Web:</label>
                                    <input class="form-control" type="text" name="pag_web_existe" id="pag_web_existe"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div id='no_existe' style="display: none;">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="rif_55">
                                        Ingrese Rif
                                        <i class="fas fa-question-circle" style="color: red;"
                                            title="Ingrese el Rif , sin guiones ni punto."></i>
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input title="Debe ingresar una palabra para realizar la busqueda" type="text"
                                        class="form-control" onkeyup="this.value=this.value.toUpperCase();"
                                        name="rif_55" id="rif_55"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')" readonly>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="razon_social">
                                        Nombre del Órgano / Ente:
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input id="razon_social" name="razon_social" class="form-control"
                                        data-parsley-required="false"
                                        data-parsley-error-message="Este campo es obligatorio.">

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cod_onapre">
                                            Código ONAPRE Órgano/Ente
                                            <span class="required-asterisk">*</span>
                                        </label>
                                        <input type="text" id="cod_onapre" name="cod_onapre" class="form-control"
                                            placeholder="Código Onapre" maxlength="20">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="siglas">
                                            Siglas Órgano/Ente
                                            <span class="required-asterisk">*</span>
                                        </label>
                                        <input type="text" id="siglas" name="siglas" class="form-control"
                                            placeholder="Siglas" maxlength="12">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="id_clasificacion">Clasificación Órgano/Ente:</label>
                                        <span class="required-asterisk">*</span>

                                        <select id="id_clasificacion" name="id_clasificacion" class="form-control">
                                            <option value="0">-Seleccione -</option>
                                            <?php foreach ($clasificacion as $data): ?>
                                                <option value="<?= htmlspecialchars($data['id_clasificacion']) ?>">
                                                    <?= htmlspecialchars($data['desc_clasificacion']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tel_local">
                                            Teléfono Órgano/Ente
                                            <span class="required-asterisk">*</span>
                                        </label>
                                        <input type="text" id="tel_local" name="tel_local" class="form-control"
                                            placeholder="042XXXXXXXX">
                                        <p id="errorMsg" class="text-danger"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pag_web">
                                            Página Web Órgano/Ente
                                            <span class="required-asterisk">*</span>
                                        </label>
                                        <input type="text" id="pag_web" name="pag_web" class="form-control"
                                            placeholder="ej. www.ejemplo.com" maxlength="20">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h5 class="text-primary mb-3"><i class="fas fa-map-marker-alt mr-2"></i>Dirección Fiscal
                                    Órgano/Ente Solicitante
                                    <span class="required-asterisk">*</span>
                                </h5>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="id_estado_n">Estado:</label>
                                        <select class="form-control" name="id_estado_n" id="id_estado_n"
                                            onchange="llenar_municipio(); ">
                                            <option value="0">Seleccione</option>
                                            <?php foreach ($estados as $data): ?>
                                                <option value="<?= htmlspecialchars($data['id']) ?>">
                                                    <?= htmlspecialchars($data['descedo']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="id_municipio_n">Municipio:</label>
                                        <select class="form-control" name="id_municipio_n" id="id_municipio_n"
                                            onchange="llenar_parroquia();">
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="id_parroquia_n">Parroquia:</label>
                                        <select class="form-control" name="id_parroquia_n" id="id_parroquia_n">
                                            <option value="0">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="direccion_fiscal">Dirección Fiscal Completa:</label>
                                    <textarea class="form-control" id="direccion_fiscal" name="direccion_fiscal"
                                        rows="3" placeholder="Indique la dirección fiscal completa"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>





                    <div class="form-section">
                        <h5 class="text-primary mb-3"><i class="fas fa-user-tie mr-2"></i>Datos de la Máxima Autoridad o
                            Cuentadante
                            <span class="required-asterisk">*</span>
                        </h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cargo__max_a_f">Cédula de Identidad</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="cedula__max_a_f" name="cedula__max_a_f" maxlength="20"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name_max_a_f">Nombre(s) y Apellido(s):</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="name_max_a_f" name="name_max_a_f" maxlength="50"
                                    class="form-control" placeholder="Nombre completo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cargo__max_a_f">Cargo:</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="cargo__max_a_f" name="cargo__max_a_f" maxlength="50"
                                    class="form-control" placeholder="Cargo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cargo__max_a_f">Acto Administrativo de Designación:</label>
                                <span class="required-asterisk">*</span>
                                <select id="actoad__max_a_f" name="actoad__max_a_f" class="form-control">
                                    <option value="0">-Seleccione -</option>
                                    <?php foreach ($acto as $data): ?>
                                        <option value="<?= htmlspecialchars($data['id_acto_admin']) ?>">
                                            <?= htmlspecialchars($data['desc_acto_admin']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>


                            </div>
                            <div class="form-group col-md-6">
                                <label for="cargo__max_a_f"> Nº:</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="n__max_a_f" name="n__max_a_f" maxlength="50" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cargo__max_a_f"> Fecha Acto Administrativoº:</label>
                                <span class="required-asterisk">*</span>
                                <input type="date" id="fecha__max_a_f" name="fecha__max_a_f" maxlength="50"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cargo__max_a_f"> Gaceta:</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="gaceta__max_a_f" name="gaceta__max_a_f" maxlength="50"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cargo__max_a_f"> Fecha de la Gaceta:</label>
                                <span class="required-asterisk">*</span>
                                <input type="date" id="gfecha__max_a_f" name="gfecha__max_a_f" maxlength="50"
                                    class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="text-primary mb-3"><i class="fas fa-building mr-2"></i>Datos del Órgano /
                            Ente
                            de Adscripción</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="rifadscrito">
                                    RIF Órgano/Ente de Adscripción:
                                    <span class="required-asterisk">*</span>
                                </label>
                                <input id="rifadscrito" name="rifadscrito" class="form-control" onkeypress="may(this);"
                                    placeholder="G123456789"
                                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                    onkeyup="this.value=this.value.toUpperCase();">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nameadscrito">
                                    Nombre Órgano/Ente de Adscripción:
                                    <span class="required-asterisk">*</span>
                                </label>
                                <input id="nameadscrito" name="nameadscrito" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="text-primary mb-3"><i class="fas fa-user mr-2"></i>Datos del Usuario o Usuaria de la
                            Clave del Organo u Ente Contratante
                            <span class="required-asterisk">*</span>
                        </h5>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cedula_f">Cédula de Identidad:</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="cedula_f" name="cedula_f" maxlength="8"
                                    placeholder="Sin puntos ni comas" class="form-control" />
                            </div>
                            <div class="form-group col-md-5">
                                <label for="name_f">Nombre completo:</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="name_f" name="name_f" maxlength="50" class="form-control"
                                    placeholder="Nombre completo">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="apellido_f">Apellido Completo:</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="apellido_f" name="apellido_f" maxlength="50" class="form-control"
                                    placeholder="Apellido completo">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cargo_f">Cargo:</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="cargo_f" name="cargo_f" placeholder="Cargo" maxlength="50"
                                    class="form-control" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="telefono_f">Teléfono:</label>
                                <span class="required-asterisk">*</span>
                                <input type="text" id="telefono_f" name="telefono_f" placeholder="Teléfono 1"
                                    maxlength="20" class="form-control" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="correo">
                                    Correo Electrónico
                                    <i class="fas fa-info-circle" style="color: blue;"
                                        title="Institucional o cifrado seguro. A este correo se enviará el usuario y/o clave."></i>
                                    <span class="required-asterisk">*</span>
                                </label>

                                <input type="email" id="correo" name="correo" class="form-control"
                                    placeholder="ingrese correo institucional">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-lock mr-2"></i>Solicitud de Acceso a los Módulos
                            <span class="required-asterisk">*</span>
                        </h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="registrar_prog_anual" name="registrar_prog_anual">
                                    Registro de Programación Anual de Compras (Art. 38 DRVLCP)
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="modi_prog_anual_ley" name="modi_prog_anual_ley">
                                    Registro de la Modificación a la Programación (Art. 38 numeral 2 DRVLCP)
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="reg_rend_anual" name="reg_rend_anual">
                                    Registro de la Rendición (Art. 38 numeral 3 DRVLCP)
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="consl_p_m_r" name="consl_p_m_r">
                                    Consulta (Programación, Modificación a la Programación y Rendición)
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="reg_llamado" name="reg_llamado">
                                    Registro de los Llamados a Concurso (Solo para la Secretaria o Secretario de la
                                    Comisión de Contratación) (Art. 79 DRVLCP)
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="consul_ll" name="consul_ll">
                                    Consulta de los Llamados a Concurso
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="procesos_ll" name="procesos_ll">
                                    Procesos de los Llamados a Concurso
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="accion_llamado" name="accion_llamado">
                                    Acción de los Llamados a Concurso
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="menu_reg_eval_desem" name="menu_reg_eval_desem">
                                    Registro de la Evaluación de Desempeño (Art. 51 DRVLCP)
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="menu_soli_anular_eval_desem"
                                        name="menu_soli_anular_eval_desem">
                                    Solicitud de anulación de Evaluación de Desempeño
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="menu_comprobante_eval_desem"
                                        name="menu_comprobante_eval_desem">
                                    Consulta de Evaluación de Desempeño
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="reg_not_mb_comi" name="reg_not_mb_comi">
                                    Registro de notificación de Miembros de Comisión (Art. 14 DRVLCP)
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="reg_cert_mb_comi" name="reg_cert_mb_comi">
                                    Solicitud de Certificación de Miembros de Comisión (Art. 14 DRVLCP)
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="consulta_mb_comi" name="consulta_mb_comi">
                                    Consulta Comisión de Contratación
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="ver_rnc" name="ver_rnc">
                                    Consulta de Contratistas Registrados ante el RNC
                                </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>
                                    <input type="checkbox" id="ccp_facilitadores" name="ccp_facilitadores">
                                    Solicitud de Certificación de Facilitadores CCP
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div id="recaptcha-widget-main"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nameadscrito">
                                Todos los campos son obligatorios
                                <span class="required-asterisk">*</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" id="guardar" onclick="save(event);" class="btn btn-primary btn-lg">
                            <i class="fas fa-save mr-2"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
        integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous">
    </script>

    <script src="<?= base_url() ?>/js/solicitud/solcitud.js"></script>
</body>

</html>

<?php if (!$this->session->userdata('session')) { ?>
    <style>
        .content {
            margin-left: 0;
        }
    </style>
<?php } ?>