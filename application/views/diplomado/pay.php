<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-M-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pago Inscripción</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="<?= base_url('css/diplomado.css') ?>" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackPay&render=explicit" async defer></script>

    <script type="text/javascript">
        // Clave de sitio de reCAPTCHA (asegúrate de que esta variable PHP imprima la clave correcta)
        var RECAPTCHA_SITE_KEY_PAY = '<?php echo $this->config->item('recaptcha_site_key_pay') ?: ''; ?>';
        var recaptchaWidgetIdPay; // Variable global para almacenar el ID del widget de reCAPTCHA

        // Esta función se llama AUTOMÁTICAMENTE por la API de reCAPTCHA cuando está lista.
        // Aquí es donde garantizamos que grecaptcha está definido y renderizamos el widget.
        var onloadCallbackPay = function() {
            if (RECAPTCHA_SITE_KEY_PAY && document.getElementById('recaptcha-widget-pay')) {
                // Renderizar el widget reCAPTCHA en el div especificado
                recaptchaWidgetIdPay = grecaptcha.render('recaptcha-widget-pay', {
                    'sitekey': RECAPTCHA_SITE_KEY_PAY,
                    'theme': 'light', // O 'dark'
                    'callback': recaptchaCallback, // Función a llamar cuando el usuario completa el reCAPTCHA
                    'expired-callback': recaptchaExpired // Función a llamar si el token reCAPTCHA expira
                });
                console.log("reCAPTCHA widget Pago renderizado. ID:", recaptchaWidgetIdPay);
                // Llamar a toggleGuardarPagoButton aquí para establecer el estado inicial CORRECTO
                // justo después de que el reCAPTCHA se ha renderizado y su estado puede ser leído.
                toggleGuardarPagoButton();
            } else {
                console.error(
                    "Error: Elemento 'recaptcha-widget-pay' no encontrado o RECAPTCHA_SITE_KEY_PAY está vacío. No se pudo renderizar reCAPTCHA."
                );
            }
        };

        // --- FUNCIONES DE CALLBACK DE RECAPTCHA (DEBEN SER GLOBALES) ---
        // Estas funciones son llamadas por la API de reCAPTCHA, no por tu jQuery.
        window.recaptchaCallback = function(response) {
            console.log("reCAPTCHA completado. Response length:", response.length);
            toggleGuardarPagoButton(); // Actualiza el botón cuando el reCAPTCHA se completa
        };

        window.recaptchaExpired = function() {
            console.log("reCAPTCHA expirado.");
            resetRecaptchaPay(); // Reinicia el reCAPTCHA (limpia el token)
            toggleGuardarPagoButton(); // Deshabilita el botón
        };

        // Función para reiniciar el reCAPTCHA (llamada desde tu JS)
        function resetRecaptchaPay() {
            // Solo intentar resetear si grecaptcha está definido Y el widget ya fue renderizado
            if (typeof grecaptcha !== 'undefined' && typeof grecaptcha.reset === 'function' && recaptchaWidgetIdPay !==
                undefined) {
                grecaptcha.reset(recaptchaWidgetIdPay);
                console.log("reCAPTCHA widget Pago reiniciado.");
            } else {
                console.warn(
                    "No se pudo reiniciar reCAPTCHA Pago: grecaptcha no definido o widgetId inválido. (Puede ser llamado antes de que la API termine de cargar)"
                );
            }
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <img src="<?= base_url() ?>Plantilla/img/loij.png" alt="Logo" class="img-fluid">

                <div class="card-container">
                    <div class="card-header">
                        <h4>Pago Inscripción Diplomado</h4>
                        <h6 class="mb-0">Sistema Integrado SNC</h6>
                    </div>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>Siga los pasos para registrar su pago.
                    </div>

                    <form id="sav_ext" method="POST" action="">
                        <div class="form-section mb-4 p-3 border rounded">
                            <h5><i class="fas fa-search mr-2"></i>Paso 1: Consultar Planilla</h5>
                            <div class="form-row align-items-end">
                                <div class="form-group col-md-8 mb-0">
                                    <label for="rif_b" class="required-field"><i
                                            class="fas fa-tag text-danger mr-1"></i>Código de la Planilla</label>
                                    <input class="form-control form-control-lg" type="text" name="rif_b" id="rif_b"
                                        onKeyUp="this.value=this.value.toUpperCase();"
                                        placeholder="Ingrese el código de la planilla">
                                    <div class="invalid-feedback">Debe ingresar el código de la planilla.</div>
                                </div>
                                <div class="col-md-4 mb-0">
                                    <button type="button" class="btn btn-primary btn-lg w-100"
                                        onclick="Consultarplanilla()">
                                        <i class="fas fa-search mr-2"></i>Consultar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="loading" class="text-center py-3" style="display: none;">
                            <i class="fas fa-spinner fa-spin fa-2x"></i>
                            <p>Consultando planilla...</p>
                        </div>

                        <div id="existe" style="display: none;">
                            <div class="alert alert-success mt-3">
                                <i class="fas fa-check-circle mr-2"></i>Planilla encontrada. ¡Ahora complete los datos
                                del pago!
                            </div>
                            <div class="alert alert-info small" role="alert">
                                <i class="fas fa-exclamation-circle mr-1"></i> Para "Guardar
                                Pago", debe:
                                <br>
                                <ul class="list-unstyled mb-3">
                                    <li>1. Planilla consultada y datos de pago llenos: <span id="status-planilla-datos"
                                            class="status-light"></span></li>
                                    <li>2. Datos de pago verificados: <span id="status-pago-verificado"
                                            class="status-light"></span></li>
                                    <li>3. Declaración de pago aceptada: <span id="status-declaracion"
                                            class="status-light"></span></li>
                                    <li>4. Verificación de seguridad (reCAPTCHA) completa: <span id="status-recaptcha"
                                            class="status-light"></span></li>
                                </ul>
                                <strong>El botón "Guardar Pago" se habilitará automáticamente cuando todas las
                                    condiciones se cumplan.</strong>
                            </div>
                            <div class="text-center mb-4">
                                <img src="<?= base_url() ?>baner/bdv.jpeg" alt="Métodos de pago" class="img-fluid"
                                    style="max-height: 450px;">
                            </div>

                            <div class="form-section mb-4 p-3 border rounded">
                                <h5><i class="fas fa-credit-card mr-2"></i>Paso 2: Detalles del Pago</h5>

                                <div class="form-group">
                                    <label for="tipo_pago" class="required-field">Forma de Pago</label>
                                    <select class="form-control" name="tipo_pago" id="tipo_pago"
                                        onchange="togglePagoFields()">
                                        <option value="0">Seleccione una opción</option>
                                        <option value="1">Pronto Pago</option>
                                        <option value="2">Crédito</option>
                                    </select>
                                    <div class="invalid-feedback">Debe seleccionar una forma de pago.</div>
                                </div>

                                <div id="prontoPagoField" style="display: none;">
                                    <h6><i class="fas fa-money-bill-alt mr-2"></i>Montos Pronto Pago</h6>
                                    <div class="form-row align-items-center mb-3">
                                        <div class="form-group col-md-4 mb-md-0">
                                            <label for="total_pago" class="required-field">Monto sin IVA</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">Bs.</span></div>
                                                <input type="text" id="total_pago" name="total_pago"
                                                    class="form-control text-right font-weight-bold" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 mb-md-0">
                                            <label for="iva">IVA (16%)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">Bs.</span></div>
                                                <input type="text" id="iva" name="iva"
                                                    class="form-control text-right font-weight-bold" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 mb-md-0">
                                            <label for="total_iva">Total a Pagar</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">Bs.</span></div>
                                                <input type="text" id="total_iva" name="total_iva"
                                                    class="form-control text-right font-weight-bold" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="creditoPagoField" style="display: none;">
                                    <h6><i class="fas fa-wallet mr-2"></i>Montos Pago a Crédito</h6>
                                    <div class="mb-3">
                                        <label for="pay" class="required-field">Total a Pagar (Crédito)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Bs.</span>
                                            </div>
                                            <input type="text" id="pay" name="pay"
                                                class="form-control text-right font-weight-bold" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="iva_credito">IVA (16%) Crédito</label>
                                            <input type="text" id="iva_credito" name="iva_credito"
                                                class="form-control text-right font-weight-bold" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="total_iva_credito">Total con IVA (Crédito)</label>
                                            <input type="text" id="total_iva_credito" name="total_iva_credito"
                                                class="form-control text-right font-weight-bold" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mitad_total_credito">1ra Cuota (Crédito)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">Bs.</span></div>
                                                <input type="text" id="mitad_total_credito" name="mitad_total_credito"
                                                    class="form-control text-right font-weight-bold" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section mb-4 p-3 border rounded">
                                <h5><i class="fas fa-info-circle mr-2"></i>Paso 3: Datos de la Transacción</h5>
                                <input type="hidden" id="id_inscripcion" name="id_inscripcion">
                                <input type="hidden" id="codigo_planilla_hidden" name="codigo_planilla">

                                <div class="form-group">
                                    <label for="fecha_limite_pago" class="required-field">Pague antes de</label>
                                    <input type="text" id="fecha_limite_pago" name="fecha_limite_pago"
                                        class="form-control" readonly>
                                    <div class="invalid-feedback">Fecha límite de pago es requerida.</div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="bancoOrigen" class="required-field">Banco de Origen</label>
                                        <select id="bancoOrigen" name="bancoOrigen" class="form-control">
                                            <option value="0">Seleccione una opción</option>
                                            <option value="0102">Banco de Venezuela</option>
                                            <option value="0114">Bancaribe</option>
                                            <option value="0172">Banca Amiga</option>
                                        </select>
                                        <div class="invalid-feedback">Debe seleccionar un banco.</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="referencia" class="required-field">Número de Referencia</label>
                                        <input type="text" id="referencia" name="referencia" class="form-control"
                                            placeholder="Número de referencia del pago" maxlength="15">
                                        <div class="invalid-feedback">Debe ingresar la referencia.</div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cedulaPagador" class="required-field">Cédula del Pagador</label>
                                        <input type="text" id="cedulaPagador" name="cedulaPagador" class="form-control"
                                            placeholder="Ej: 12345678" maxlength="12">
                                        <div class="invalid-feedback">Debe ingresar la cédula.</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="telefonoPagador" class="required-field">Teléfono del Pagador</label>
                                        <input type="text" id="telefonoPagador" name="telefonoPagador"
                                            class="form-control" placeholder="Ej: 04121234567" maxlength="12">
                                        <div class="invalid-feedback">Debe ingresar el teléfono.</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="telefonoDestino">Teléfono Destino</label>
                                        <input type="text" id="telefonoDestino" name="telefonoDestino"
                                            class="form-control" placeholder="Ej: 04126010945" maxlength="12"
                                            value='04126010945' readonly>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fechaPago" class="required-field">Fecha de Pago</label>
                                        <input type="date" id="fechaPago" name="fechaPago" class="form-control">
                                        <div class="invalid-feedback">Debe ingresar la fecha de pago.</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="importe" class="required-field">Importe Cancelado</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Bs.</span>
                                            </div>
                                            <input type="text" id="importe" name="importe" class="form-control"
                                                placeholder="0.00" maxlength="12" readonly>
                                            <div class="invalid-feedback">Debe ingresar el importe.</div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="pagoVerificado" name="pagoVerificado" value="0" readonly>

                                <!-- <div class="text-center mt-4">
                                    <button type="button" id="btnVerificarDatosPago" class="btn btn-info btn-lg">
                                        <i class="fas fa-check-circle mr-2"></i>Verificar Datos del Pago
                                    </button>
                                </div> -->
                            </div>

                            <div class="form-section mt-4 p-3 border rounded">
                                <h5><i class="fas fa-lock mr-2"></i>Paso 4: Confirmación y Seguridad</h5>


                                <div class="form-group form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="declaracionPago"
                                        name="declaracionPago" required>
                                    <label class="form-check-label" for="declaracionPago">
                                        Declaro que la información del pago suministrada es veraz y autorizo su
                                        verificación.
                                    </label>
                                    <div class="invalid-feedback" id="declaracionPago-feedback" style="display: none;">
                                        Debe aceptar la declaración de pago para continuar.
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <div id="recaptcha-widget-pay" data-callback="recaptchaCallback"
                                        data-expired-callback="recaptchaExpired"></div>
                                    <div class="invalid-feedback text-center mt-2" id="recaptcha-pay-feedback"
                                        style="display: none;">
                                        Por favor, complete el reCAPTCHA.
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="button" id="guardarPagoFinalBtn" class="btn btn-success btn-lg" disabled>
                                    <i class="fas fa-save mr-2"></i>Guardar Pago
                                </button>
                            </div>
                        </div>
                    </form>

                    <div id="no_existe" class="alert alert-warning mt-3" style="display: none;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        NO EXISTE EL NÚMERO DE PLANILLA
                    </div>
                </div>
            </div>
        </div>

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

        <script src="<?= base_url() ?>/js/solicitud/pay.js"></script>
</body>

</html>