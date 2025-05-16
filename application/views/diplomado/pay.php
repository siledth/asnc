<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pago Inscripción</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="<?= base_url('css/diplomado.css') ?>" rel="stylesheet">

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
                    <h5><i class="fas fa-briefcase mr-2"></i>Datos Pago</h5>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>Complete la información
                    </div>

                    <form id="sav_ext" method="POST" action="tu_url_de_procesamiento">
                        <div class="form-group">
                            <label for="rif_b"><i class="fas fa-question-circle text-danger mr-1"></i>Codigo de la
                                planilla <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="rif_b" id="rif_b"
                                onKeyUp="this.value=this.value.toUpperCase();" onblur="Consultarplanilla();">
                            <small class="form-text text-muted">Ingrese </small>
                            <div class="invalid-feedback">Debe ingresar </div>
                        </div>

                        <!-- Loader -->
                        <div id="loading" style="display: none;">
                            <div class="text-center py-3">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p>Consultando planilla...</p>
                            </div>
                        </div>

                        <!-- Mensaje cuando EXISTE -->
                        <div id="existe" style="display: none;">
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle mr-2"></i>Planilla encontrada
                            </div>
                            <!-- Contenido del formulario cuando existe -->
                            <div class="text-center mb-12">
                                <img src="<?= base_url() ?>baner/bdv.jpeg" alt="Métodos de pago" class="img-fluid"
                                    style="max-height: 390px;">
                            </div>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle mr-2"></i>Perfecto. por favor seleccione el pago
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <h5><i class="fas fa-credit-card mr-2"></i>Forma de Pago</h5>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="tipo_pago" class="required-field">Forma de Pago</label>
                                        <select class="form-control" name="tipo_pago" id="tipo_pago"
                                            onchange="togglePagoFields()">
                                            <option value="0">Seleccione una opción</option>
                                            <option value="1">Pronto Pago</option>
                                            <option value="2">Crédito</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 form-group" id="prontoPagoField" style="display: none;">
                                        <label for="total_pago" class="required-field">Pronto
                                            Pago</label>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-4 mb-4 mb-md-0">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Bs.</span>
                                                    </div>
                                                    <input type="text" id="total_pago" name="total_pago"
                                                        class="form-control text-right font-weight-bold"
                                                        style="font-size: 1.2rem;" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-2 mb-md-0">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">IVA</span>
                                                    </div>
                                                    <input type="text" id="iva" name="iva"
                                                        class="form-control text-right font-weight-bold"
                                                        style="font-size: 1.2rem;" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-2 mb-md-0">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Total + IVA</span>
                                                    </div>
                                                    <input type="text" id="total_iva" name="total_iva"
                                                        class="form-control text-right font-weight-bold"
                                                        style="font-size: 1.2rem;" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-group" id="creditoPagoField" style="display: none;">
                                        <!-- Campo principal - Total a Pagar -->
                                        <div class="mb-3">
                                            <label for="pay" class="form-label required-field fw-semibold">Total a Pagar
                                                (Crédito)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">Bs.</span>
                                                <input type="text" id="pay" name="pay"
                                                    class="form-control text-end fw-bold py-2"
                                                    style="font-size: 1.1rem; background-color: #f8f9fa;" readonly>
                                            </div>
                                        </div>

                                        <!-- Sección de desglose en fila -->
                                        <div class="row g-6">
                                            <!-- IVA Crédito -->
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <label class="form-label fw-semibold">IVA (16%) Crédito:</label>
                                                <input type="text" id="iva_credito" name="iva_credito"
                                                    class="form-control text-end fw-bold py-2"
                                                    style="font-size: 1.1rem; background-color: #f8f9fa;" readonly>
                                            </div>

                                            <!-- Total con IVA -->
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <label class="form-label fw-semibold">Total con IVA (Crédito):</label>
                                                <input type="text" id="total_iva_credito" name="total_iva_credito"
                                                    class="form-control text-end fw-bold py-2"
                                                    style="font-size: 1.1rem; background-color: #f8f9fa;" readonly>
                                            </div>

                                            <!-- 1ra Cuota -->
                                            <div class="col-xl-6 col-lg-6">
                                                <label class="form-label fw-semibold">Total a pagar 1 cuota
                                                    (Crédito):</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">Bs.</span>
                                                    <input type="text" id="mitad_total_credito"
                                                        name="mitad_total_credito"
                                                        class="form-control text-end fw-bold py-2"
                                                        style="font-size: 1.1rem; background-color: #f8f9fa;" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- Campos comunes (siempre visibles) -->
                                    <div class="col-md-6 form-group">

                                        <div class="col-md-6 form-group">
                                            <label for="fecha_limite_pago" class="required-field">Pague antes de</label>
                                            <input type="text" id="fecha_limite_pago" name="fecha_limite_pago"
                                                class="form-control" readonly>

                                            <input type="hidden" id="id_inscripcion" name="id_inscripcion">
                                            <input type="hidden" id="codigo_planilla" name="codigo_planilla">

                                        </div>
                                    </div>
                                    <form id="sav_ext" method="POST" action="tu_url_de_procesamiento">

                                        <div class="col-md-6 form-group">
                                            <label for="bancoo" class="required-field">Banco de
                                                Origen</label>
                                            <select id="bancoOrigen" name="bancoOrigen" class="form-control">
                                                <option value="0">Seleccione una opción</option>
                                                <option value="0102">Banco de venezuela </option>
                                                <option value="0114">Bancaribe </option>
                                                <option value="0172">Banca amiga </option>


                                            </select>
                                        </div>



                                        <div class="col-md-4 form-group">
                                            <label for="cedulaPagador" class="required-field">Cédula del
                                                Pagador</label>
                                            <input type="text" id="cedulaPagador" name="cedulaPagador"
                                                class="form-control" placeholder="Ej: 12345678" maxlength="12" required
                                                data-parsley-trigger="change">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="telefonoPagador" class="required-field">Teléfono del
                                                Pagador</label>
                                            <input type="text" id="telefonoPagador" name="telefonoPagador"
                                                class="form-control" placeholder="Ej: 04121234567" maxlength="12"
                                                required data-parsley-trigger="change">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="telefonoDestino">Teléfono Destino</label>
                                            <input type="text" id="telefonoDestino" name="telefonoDestino"
                                                class="form-control" placeholder="Ej: 02121234567" maxlength="12"
                                                required data-parsley-trigger="change">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="referencia" class="required-field">Número de
                                                Referencia</label>
                                            <input type="text" id="referencia" name="referencia" class="form-control"
                                                placeholder="Número de referencia del pago" maxlength="15" required
                                                data-parsley-trigger="change">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="fechaPago" class="required-field">Fecha de
                                                Pago</label>
                                            <input type="date" id="fechaPago" name="fechaPago" class="form-control"
                                                maxlength="12" required data-parsley-trigger="change">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="importe" class="required-field">Importe
                                                Cancelado</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" step="0.01" id="importe" name="importe"
                                                    class="form-control" placeholder="0.00" maxlength="12" required
                                                    data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <input type="hidden" id="pagoVerificado" name="pagoVerificado" value="0">
                                    </form>
                                    <!-- <button type="button" id="guardar" class="btn btn-primary"
                                        onclick="enviarDatos(event)">Guardar</button> -->
                                    <div class="text-center mt-4">
                                        <button type="button" id="guardar" onclick="savei(event);"
                                            class="btn btn-primary btn-lg">
                                            <i class="fas fa-save mr-2"></i>Guardar Inscripción
                                        </button>
                                    </div>


                                </div>



                            </div>
                        </div>
                    </form>

                    <!-- Mensaje cuando NO EXISTE (FUERA del formulario) -->
                    <div id="no_existe" style="display: none;">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            NO EXISTE EL NÚMERO DE PLANILLA
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- </form> -->



    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Tu script personalizado -->
    <script src="<?= base_url() ?>/js/solicitud/solicitud.js"></script>
</body>

</html>