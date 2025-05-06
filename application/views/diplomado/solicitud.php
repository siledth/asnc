<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscripción del Diplomado - Sistema Integrado SNC</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            /* --color-primary: #25285A;
            --color-secondary: #E42322; */

            --primary-color: #E42322;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-container {
            max-width: 1200px;
            margin: 2rem auto;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .card-header img {
            width: 1550px;
            max-height: 80px;
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 2rem;
        }

        .form-section {
            background-color: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-section h5 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .required-field::after {
            content: " *";
            color: var(--accent-color);
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            padding: 0.5rem 2rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .form-control {
            border-radius: 4px;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        label {
            font-weight: 500;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .section-divider {
            border-top: 1px dashed #ddd;
            margin: 1.5rem 0;
        }

        .info-text {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .diplomado-info {
            background-color: #f8f9fa;
            border-left: 4px solid var(--secondary-color);
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 4px;
        }

        .diplomado-info h6 {
            color: var(--primary-color);
            font-weight: 600;
        }

        .info-item {
            margin-bottom: 0.5rem;
        }

        .info-item strong {
            min-width: 120px;
            display: inline-block;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .form-section {
                padding: 1rem;
            }

            .info-item strong {
                min-width: 100px;
            }
        }

        /* Estilos para la sección de pago */
        .payment-image {
            max-height: 200px;
            margin: 0 auto 40px;
            display: block;
        }

        .payment-field-group {
            margin-bottom: 1rem;
        }

        .payment-field-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .currency-input {
            position: relative;
        }

        .currency-input .input-group-text {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 80%;
            color: #dc3545;
        }

        .is-invalid~.invalid-feedback {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card-container">
                    <div class="card-header">
                        <img src="<?= base_url() ?>Plantilla/img/loij.png" alt="Logo" class="img-fluid">
                        <h4>Preinscripción Inscripción del Diplomado</h4>
                        <h6 class="mb-0">Sistema Integrado SNC</h6>
                    </div>

                    <div class="card-body">
                        <form id="sav_ext" name="sav_ext" data-parsley-validate="true" method="POST"
                            enctype="multipart/form-data">

                            <!-- Sección del Diplomado -->
                            <div class="form-section">
                                <h5><i class="fas fa-graduation-cap mr-2"></i>Información del Diplomado</h5>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="id_diplomado" class="required-field">Seleccione el Diplomado</label>
                                        <select id="id_diplomado" name="id_diplomado" class="form-control"
                                            onchange="loadDiplomadoInfo(this.value)">
                                            <option value="0">Seleccione una opción</option>
                                            <?php foreach ($diplomado as $data): ?>
                                                <option value="<?= $data['id_diplomado'] ?>">
                                                    <?= $data['name_d'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Contenedor para la información del diplomado -->
                                <div id="diplomadoInfoContainer" class="diplomado-info" style="display: none;">
                                    <h6 id="diplomadoTitle"></h6>
                                    <div class="info-item"><strong>Fecha de inicio:</strong> <span
                                            id="diplomadoFechaInicio"></span></div>
                                    <div class="info-item"><strong>Fecha de fin:</strong> <span
                                            id="diplomadoFechaFin"></span></div>
                                    <div class="info-item"><strong>Modalidad:</strong> <span
                                            id="diplomadoModalidad"></span></div>
                                    <div class="info-item"><strong>Duración:</strong> <span
                                            id="diplomadoDuracion"></span></div>
                                </div>
                            </div>
                            <!-- Sección de Datos Personales -->
                            <div class="form-section">
                                <h5><i class="fas fa-user-circle mr-2"></i>Datos del Participante</h5>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="cedula_f" class="required-field">Cédula de Identidad</label>
                                        <input type="text" id="cedula_f" name="cedula_f" maxlength="8"
                                            onblur="validateUsers();" placeholder="Ej: 12345678" class="form-control"
                                            required />
                                        <small class="form-text text-muted">Sin puntos ni comas</small>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="name_f" class="required-field">Nombres</label>
                                        <input type="text" id="name_f" name="name_f" maxlength="50" class="form-control"
                                            placeholder="Nombres completos" required>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="apellido_f" class="required-field">Apellidos</label>
                                        <input type="text" id="apellido_f" name="apellido_f" maxlength="50"
                                            class="form-control" placeholder="Apellidos completos" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="telefono_f" class="required-field">Teléfono</label>
                                        <input type="text" id="telefono_f" name="telefono_f"
                                            placeholder="Ej: 04121234567" maxlength="20" class="form-control"
                                            required />
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <label for="correo">Correo Electrónico</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" id="correo" name="correo" class="form-control"
                                                placeholder="Ej: usuario@dominio.com">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="id_clasificacion">Grado de instruccion</label>
                                        <select id="id_clasificacion" name="id_clasificacion" class="form-control">
                                            <option value="0">Seleccione una opción</option>
                                            <?php foreach ($clasificacion as $data): ?>
                                                <option value="<?= $data['id_academico'] ?>">
                                                    <?= $data['desc_academico'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <label for="direccion_fiscal" class="required-field">Dirección Completa</label>
                                        <textarea class="form-control" id="direccion_fiscal_" name="direccion_fiscal_"
                                            rows="3"
                                            placeholder="Ej: Av. Principal, Edificio XYZ, Piso 3, Oficina 301"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="trabajo">¿Trabaja Actualmente?</label>
                                        <select class="form-control" name="trabajo" id="trabajo" onclick="llenar_();">
                                            <option value="0">Seleccione una opción</option>
                                            <option value="1">Sí</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Datos Laborales (oculta inicialmente) -->
                            <div class="form-section" id='campos7' style="display: none;">
                                <h5><i class="fas fa-briefcase mr-2"></i>Datos Laborales</h5>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle mr-2"></i>Complete la información de su lugar de
                                    trabajo.
                                </div>

                                <div class="form-group">
                                    <label for="rif_b"><i class="fas fa-question-circle text-danger mr-1"></i>RIF de la
                                        Institución <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="rif_b" id="rif_b"
                                        onkeypress="may(this);" placeholder="Ej: G123456789"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                        onKeyUp="this.value=this.value.toUpperCase();" onblur="consultar_rif();">
                                    <small class="form-text text-muted">Ingrese el RIF sin guiones ni puntos</small>
                                </div>

                                <!-- Sección si existe RIF -->
                                <div id='existe' style="display: none;">
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle mr-2"></i>La institución está registrada en
                                        nuestro sistema.
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>RIF del Órgano / Ente</label>
                                            <input class="form-control" type="text" name="sel_rif_nombre5"
                                                id="sel_rif_nombre5" readonly>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Nombre del Órgano / Ente</label>
                                            <input type="text" name="nombre_conta_5" id="nombre_conta_5"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección si no existe RIF -->
                                <div id='no_existe' style="display: none;">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>Complete los datos de la
                                        institución.
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="rif_55"><i
                                                    class="fas fa-question-circle text-danger mr-1"></i>RIF</label>
                                            <input type="text" class="form-control"
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_55" id="rif_55"
                                                placeholder="Ej: J123456789"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <label for="razon_social" class="required-field">Razón Social</label>
                                            <input id="razon_social" name="razon_social" class="form-control"
                                                placeholder="Nombre completo de la institución">
                                        </div>
                                    </div>

                                    <div class="row">


                                        <div class="col-md-4 form-group">
                                            <label for="tel_local" class="required-field">Teléfono Local</label>
                                            <input type="number" id="tel_local" name="tel_local" class="form-control"
                                                placeholder="Ej: 02121234567">
                                            <p id="errorMsg" class="text-danger"></p>
                                        </div>
                                    </div>

                                    <div class="section-divider"></div>
                                    <h6><i class="fas fa-map-marker-alt mr-2"></i>Dirección Fiscal</h6>

                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="id_estado_n">Estado</label>
                                            <select class="form-control" name="id_estado_n" id="id_estado_n"
                                                onclick="llenar_municipio();listar_ciudades();">
                                                <option value="0">Seleccione</option>
                                                <?php foreach ($estados as $data): ?>
                                                    <option value="<?= $data['id'] ?>">
                                                        <?= $data['descedo'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="id_municipio_n">Municipio</label>
                                            <select class="form-control" name="id_municipio_n" id="id_municipio_n"
                                                onclick="llenar_parroquia();">
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="id_parroquia_n">Parroquia</label>
                                            <select class="form-control" name="id_parroquia_n" id="id_parroquia_n">
                                                <option value="0">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="direccion_fiscal" class="required-field">Dirección Completa</label>
                                        <textarea class="form-control" id="direccion_fiscal" name="direccion_fiscal"
                                            rows="3"
                                            placeholder="Ej: Av. Principal, Edificio XYZ, Piso 3, Oficina 301"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Sección de Forma de Pago  -->
                            <!-- <div class="form-section">
                                <h5><i class="fas fa-credit-card mr-2"></i>Forma de Pago</h5>


                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="tipo_pago" class="required-field">Tipo de Pago</label>
                                        <select class="form-control" name="tipo_pago" id="tipo_pago"
                                            onchange="togglePagoFields()">
                                            <option value="0">Seleccione una opción</option>
                                            <option value="1">Pago al Contado</option>
                                            <option value="2">Crédito</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Campos para Pago al Contado (inicialmente ocultos) -->
                            <div id="pagoContadoFields" style="display: none;">
                                <!-- Imagen de encabezado -->
                                <div class="text-center mb-4">
                                    <img src="<?= base_url() ?>baner/bdv.jpeg" alt="Métodos de pago" class="img-fluid"
                                        style="max-height: 390px;">
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle mr-2"></i>Complete los datos del pago al contado.
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="total_pago" class="required-field">Total a Pagar</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" step="0.01" id="total_pago" name="total_pago"
                                                class="form-control" placeholder="0.00">
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="bancoo" class="required-field">Banco de Origen</label>
                                        <select id="bancoo" name="bancoo" class="form-control">
                                            <option value="0">Seleccione una opción</option>
                                            <?php foreach ($banco as $data): ?>
                                                <option value="<?= $data['cod_banc'] ?>">
                                                    <?= $data['des_banco'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="cedulaPagador" class="required-field">Cédula del Pagador</label>
                                        <input type="text" id="cedulaPagador" name="cedulaPagador" class="form-control"
                                            placeholder="Ej: 12345678" maxlength="12">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="telefonoPagador" class="required-field">Teléfono del
                                            Pagador</label>
                                        <input type="text" id="telefonoPagador" name="telefonoPagador"
                                            class="form-control" placeholder="Ej: 04121234567">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="telefonoDestino">Teléfono Destino (opcional)</label>
                                        <input type="text" id="telefonoDestino" name="telefonoDestino"
                                            class="form-control" placeholder="Ej: 02121234567">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="referencia" class="required-field">Número de Referencia</label>
                                        <input type="text" id="referencia" name="referencia" class="form-control"
                                            placeholder="Número de referencia del pago">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="fechaPago" class="required-field">Fecha de Pago</label>
                                        <input type="date" id="fechaPago" name="fechaPago" class="form-control">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="importe" class="required-field">Importe Cancelado</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" step="0.01" id="importe" name="importe"
                                                class="form-control" placeholder="0.00">
                                        </div>
                                    </div>
                                    <input type="hidden" id="pagoVerificado" name="pagoVerificado" value="0">
                                </div>
                            </div>

                            <!-- Campos para Crédito   -->
                            <div id="pagoCreditoFields" style="display: none;">
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Para pagos a crédito, nuestro
                                    equipo se comunicará con usted para acordar los términos.
                                </div>
                            </div>
                    </div> -->
                    <div class="text-center mt-4">
                        <button type="button" id="guardar" onclick="savei(event);" class="btn btn-primary btn-lg">
                            <i class="fas fa-save mr-2"></i>Guardar Inscripción
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Tu script personalizado -->
    <script src="<?= base_url() ?>/js/solicitud/solicitud.js"></script>
</body>

</html>