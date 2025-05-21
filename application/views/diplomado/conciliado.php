<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Conciliado</h2>
    <div class="row">
        <div class="card-body">
            <h5><i class="fas fa-briefcase mr-2"></i>Datos Pago</h5>

            <div class="alert alert-info">
                <i class="fas fa-info-circle mr-2"></i>Complete la información
            </div>

            <form id="sav_ext" method="POST" action="tu_url_de_procesamiento">
                <div class="row">

                    <div class="form-group">
                        <label for="rif_b"><i class="fas fa-question-circle text-danger mr-1"></i>Codigo de la
                            planilla <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="rif_b" id="rif_b"
                            onKeyUp="this.value=this.value.toUpperCase();">
                        <small class="form-text text-muted">Ingrese </small>
                        <div class="invalid-feedback">Debe ingresar </div>
                    </div>
                    <div class="col mt-4">
                        <button type="button" class="btn btn-default" onclick="Consultarplanilla()" name="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
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

                    </div>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>Perfecto. por favor seleccione forma del pago
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
                                                <span class="input-group-text" id="ivaLabel">IVA (16%)</span>
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
                                        <label for="iva_credito" class="form-label fw-semibold">IVA (<span
                                                id="ivaPercentLabel">16</span>%) Crédito:</label>
                                        <input type="text" id="iva_credito" name="iva_credito"
                                            class="form-control text-end fw-bold py-2"
                                            style="font-size: 1.1rem; background-color: #f8f9fa;" readonly>
                                    </div>

                                    <!-- Total con IVA -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <label for="iva_credito" class="form-label fw-semibold">IVA (<span
                                                id="ivaPercentLabel">16</span>%) Crédito:</label>
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
                                            <input type="text" id="mitad_total_credito" name="mitad_total_credito"
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
                                    <input type="hidden" id="id_ente" name="id_ente">


                                </div>
                            </div>
                            <form id="sav_ext" method="POST" action="tu_url_de_procesamiento">
                                <div class="col-md-4 form-group">
                                    <label for="cedulaPagador" class="required-field">retencion 1</label>
                                    <input type="text" id="retencion1" name="retencion1" class="form-control"
                                        placeholder="Ej: 12345678" maxlength="12" required
                                        data-parsley-trigger="change">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="cedulaPagador" class="required-field">retencion 2</label>
                                    <input type="text" id="retencion2" name="retencion2" class="form-control"
                                        placeholder="Ej: 12345678" maxlength="12" required
                                        data-parsley-trigger="change">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="cedulaPagador" class="required-field">retencion 3</label>
                                    <input type="text" id="retencion3" name="retencion3" class="form-control"
                                        placeholder="Ej: 12345678" maxlength="12" required
                                        data-parsley-trigger="change">
                                </div>

                                <div class="col-md-12 form-group" id="totalDespuesRetencionesField"
                                    style="display: none;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Total después de retenciones</span>
                                        </div>
                                        <input type="text" id="total_despues_retenciones"
                                            name="total_despues_retenciones"
                                            class="form-control text-right font-weight-bold" style="font-size: 1.2rem;"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group" id="totalDespuesRetencionesCreditoField"
                                    style="display: none;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Total crédito después de retenciones</span>
                                        </div>
                                        <input type="text" id="total_despues_retenciones_credito"
                                            name="total_despues_retenciones_credito"
                                            class="form-control text-right font-weight-bold" style="font-size: 1.2rem;"
                                            readonly>
                                    </div>
                                </div>
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
                                    <label for="cedulaPagador" class="required-field">numero factura siges</label>
                                    <input type="text" id="referencia" name="referencia" class="form-control"
                                        placeholder="Ej: 12345678" maxlength="12" required data-parsley-trigger="change"
                                        value="21151374">
                                </div>


                                <div class="col-md-3 form-group">
                                    <label for="fechaPago" class="required-field">Fecha en que se realizo el
                                        Pago</label>
                                    <input type="date" id="fechaPago" name="fechaPago" class="form-control"
                                        maxlength="12" required data-parsley-trigger="change">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="cedulaPagador" class="required-field">numero factura siges</label>
                                    <input type="text" id="nfsiges" name="nfsiges" class="form-control"
                                        placeholder="Ej: 12345678" maxlength="12" required data-parsley-trigger="change"
                                        value="21151374">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="importe" class="required-field">Importe
                                        Cancelado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">bf</span>
                                        </div>
                                        <input type="number" step="0.01" id="monto" name="monto" class="form-control"
                                            placeholder="0.00" maxlength="12" required data-parsley-trigger="change">
                                    </div>
                                </div>
                                <input type="hidden" id="pagoVerificado" name="pagoVerificado" value="0">
                            </form>
                            <!-- <button type="button" id="guardar" class="btn btn-primary"
                                        onclick="enviarDatos(event)">Guardar</button> -->
                            <div class="text-center mt-4">
                                <button type="button" id="guardar" onclick="sav(event);" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save mr-2"></i>Guardar Pago
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

    <script src="<?= base_url() ?>/js/diplomado/diplomado.js"></script>


    <script src="<?= base_url() ?>/js/diplomado/conciliar.js"></script>

    <script>
        function dividirCosto() {
            // Obtener el valor del campo principal
            const costoTotal = document.getElementById('pay').value;

            // Calcular la mitad
            const mitad = costoTotal / 2;

            // Asignar el valor a los otros dos campos
            document.getElementById('pay1').value = mitad;
            document.getElementById('pay2').value = mitad;
        }
    </script>