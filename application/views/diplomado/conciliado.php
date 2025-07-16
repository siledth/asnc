<style>
    #validarReferencia {
        transition: all 0.3s ease;
    }

    #referenciaInfo {
        transition: all 0.5s ease;
    }

    .input-group-append button {
        border-radius: 0 4px 4px 0;
    }
</style>

<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Conciliado</h2>
    <div class="row">
        <div class="card-body">
            <h5><i class="fas fa-briefcase mr-2"></i>Datos Pago</h5>

            <div class="alert alert-info">
                <i class="fas fa-info-circle mr-2"></i>Complete la información
            </div>

            <form id="sav_ext" method="POST" action="">
                <div class="row">
                    <div class="form-group col-md-6"> <label for="rif_b"><i
                                class="fas fa-question-circle text-danger mr-1"></i>Codigo de la
                            planilla <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="rif_b" id="rif_b"
                            onKeyUp="this.value=this.value.toUpperCase();">
                        <small class="form-text text-muted">Ingrese </small>
                        <div class="invalid-feedback">Debe ingresar </div>
                    </div>
                    <div class="col-md-6 mt-4"> <button type="button" class="btn btn-default"
                            onclick="Consultarplanilla()" name="button">
                            <i class="fas fa-search"></i> Consultar Planilla
                        </button>
                    </div>
                </div>

                <div id="loading" style="display: none;">
                    <div class="text-center py-3">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p>Consultando planilla...</p>
                    </div>
                </div>

                <div id="existe" style="display: none;">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>Planilla encontrada
                    </div>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>Perfecto. por favor seleccione forma del pago
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <h5><i class="fas fa-credit-card mr-2"></i>Forma de Pago</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="tipo_pago" class="required-field">Forma de Pago</label>
                            <select class="form-control" name="tipo_pago" id="tipo_pago" onchange="togglePagoFields()">
                                <option value="0">Seleccione una opción</option>
                                <option value="1">Pronto Pago</option>
                                <option value="2">Crédito</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group" id="prontoPagoField" style="display: none;">
                            <label for="total_pago" class="required-field">Pronto Pago</label>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Bs.</span>
                                        </div>
                                        <input type="text" id="total_pago" name="total_pago"
                                            class="form-control text-right font-weight-bold" style="font-size: 1.2rem;"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="ivaLabel">IVA </span>
                                        </div>
                                        <input type="text" id="iva" name="iva"
                                            class="form-control text-right font-weight-bold" style="font-size: 1.2rem;"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Total + IVA</span>
                                        </div>
                                        <input type="text" id="total_iva" name="total_iva"
                                            class="form-control text-right font-weight-bold" style="font-size: 1.2rem;"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 form-group" id="creditoPagoField" style="display: none;">
                            <div class="mb-3">
                                <label for="pay" class="form-label required-field fw-semibold">Total a Pagar
                                    (Crédito)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">Bs.</span>
                                    <input type="text" id="pay" name="pay" class="form-control text-end fw-bold py-2"
                                        style="font-size: 1.1rem; background-color: #f8f9fa;" readonly>
                                </div>
                            </div>
                            <div class="row g-6">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <label for="iva_credito" class="form-label fw-semibold">IVA <span
                                            id="ivaPercentLabel"></span> Crédito:</label>
                                    <input type="text" id="iva_credito" name="iva_credito"
                                        class="form-control text-end fw-bold py-2"
                                        style="font-size: 1.1rem; background-color: #f8f9fa;" readonly>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <label for="total_iva_credito" class="form-label fw-semibold">Total con IVA
                                        Crédito:</label>
                                    <input type="text" id="total_iva_credito" name="total_iva_credito"
                                        class="form-control text-end fw-bold py-2"
                                        style="font-size: 1.1rem; background-color: #f8f9fa;" readonly>
                                </div>
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
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="fecha_limite_pago" class="required-field">Pague antes de</label>
                            <input type="text" id="fecha_limite_pago" name="fecha_limite_pago" class="form-control"
                                readonly>

                            <input type="hidden" id="id_inscripcion" name="id_inscripcion">
                            <input type="hidden" id="codigo_planilla" name="codigo_planilla">
                            <input type="hidden" id="id_ente" name="id_ente">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="retencion1" class="required-field">retencion 1</label>
                            <input type="text" id="retencion1" name="retencion1" class="form-control"
                                placeholder="Ej: 0.00" required data-parsley-trigger="change">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="retencion2" class="required-field">retencion 2</label>
                            <input type="text" id="retencion2" name="retencion2" class="form-control"
                                placeholder="Ej: 0.00" required data-parsley-trigger="change">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="retencion3" class="required-field">retencion 3</label>
                            <input type="text" id="retencion3" name="retencion3" class="form-control"
                                placeholder="Ej: 0.00" required data-parsley-trigger="change">
                        </div>

                        <div class="col-md-12 form-group" id="totalDespuesRetencionesField" style="display: none;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total después de retenciones</span>
                                </div>
                                <input type="text" id="total_despues_retenciones" name="total_despues_retenciones"
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
                            <label for="bancoOrigen" class="required-field">Banco de Origen</label>
                            <select id="bancoOrigen" name="bancoOrigen" class="form-control">
                                <option value="0">Seleccione una opción</option>
                                <option value="0102">Banco de Venezuela</option>
                                <option value="0114">Bancaribe</option>
                                <option value="0172">Banca Amiga</option>
                                <option value="0105">Banco Mercantil C.A., Banco Universal</option>
                                <option value="0108">Banco Provincial, S.A. Banco Universal</option>
                                <option value="0115">Banco Exterior C.A., Banco Universal</option>
                                <option value="0128">Banco Caroní C.A., Banco Universal </option>
                                <option value="0134">Banesco Banco Universal, C.A.</option>
                                <option value="0137">Banco Sofitasa Banco Universal, C.A</option>
                                <option value="0138">Banco de la Gente Emprendedora C.A.</option>
                                <option value="0151">Banco Fondo Común, C.A Banco Universal</option>
                                <option value="0156">100% Banco, Banco Comercial, C.A</option>
                                <option value="0163">Banco del Tesoro C.A., Banco Universal</option>
                                <option value="0166">Banco Agrícola de Venezuela C.A., Banco Universal
                                </option>
                                <option value="0168">Bancrecer S.A., Banco Microfinanciero</option>
                                <option value="0171">Banco Activo C.A., Banco Universal</option>
                                <option value="0174">Banplus Banco Universal, C.A.</option>
                                <option value="0169">Mi Banco, Banco Microfinanciero, C.A.</option>
                                <option value="0175">Banco Bicentenario del Pueblo, Banco Universal C.A.
                                </option>
                                <option value="0177">Banco de la Fuerza Armada Nacional Bolivariana, B.U
                                </option>
                                <option value="0191">Banco Nacional de Crédito C.A., Banco Universal
                                </option>
                                <option value="0157">DelSur, Banco Universal C.A</option>


                            </select>
                        </div>

                        <div class="col-md-6 form-group"> <label for="referencia" class="required-field">Número
                                Referencia</label>
                            <div class="input-group">
                                <input type="text" id="referencia" name="referencia" class="form-control" placeholder=""
                                    maxlength="18" required data-parsley-trigger="change">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                                    value="<?= $this->security->get_csrf_hash() ?>">
                                <input type="hidden" id="pagoVerificado" name="pagoVerificado" value="0">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="validarReferencia">
                                        <i class="fas fa-check"></i> Validar
                                    </button>
                                </div>
                            </div>
                            <small id="referenciaHelp" class="form-text text-muted"></small>
                        </div>

                        <div id="referenciaInfo" class="col-md-12" style="display: none;">
                            <div class="alert alert-success mt-3">
                                <h5>Información del Pago</h5>
                                <div id="referenciaDetails"></div>
                            </div>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="fechaPago" class="required-field">Fecha en que se realizo el Pago</label>
                            <input type="date" id="fechaPago" name="fechaPago" class="form-control" required
                                data-parsley-trigger="change">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="nfsiges" class="required-field">numero factura siges</label>
                            <input type="text" id="nfsiges" name="nfsiges" class="form-control"
                                placeholder="Ej: 12345678" maxlength="12" required data-parsley-trigger="change">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="monto" class="required-field">Importe Cancelado</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Bs.</span>
                                </div>
                                <input type="number" step="0.01" id="monto" name="monto" class="form-control"
                                    placeholder="0.00" required data-parsley-trigger="change">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="button" id="guardar" onclick="sav(event);" class="btn btn-primary btn-lg">
                            <i class="fas fa-save mr-2"></i>Guardar Pago
                        </button>
                    </div>

                </div>
            </form>
            <div id="no_existe" style="display: none;">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    NO EXISTE EL NÚMERO DE PLANILLA
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/js/diplomado/conciliar.js"></script>

<script>
    function dividirCosto() {
        // Obtener el valor del campo principal
        const costoTotal = document.getElementById('pay').value;
        // Calcular la mitad
        const mitad = costoTotal / 2;
        // Asignar el valor a los otros dos campos
        document.getElementById('pay1').value = mitad; // Asegúrate de que pay1 y pay2 existan si los usas
        document.getElementById('pay2').value = mitad;
    }
</script>