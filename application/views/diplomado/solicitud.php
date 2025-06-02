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
    <link href="<?= base_url('css/diplomado.css') ?>" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card-container">
                    <img src="<?= base_url() ?>Plantilla/img/loij.png" alt="Logo" class="img-fluid">

                    <div class="card-header">
                        <h4>Persona Natural Solicitud de Inscripción Diplomado</h4>
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
                                    <div class="info-item"><strong>Costo por persona sin IVA:</strong> <span
                                            id="diplomadoM"></span></div>

                                </div>
                            </div>
                            <!-- Sección de Datos Personales -->
                            <div class="form-section">
                                <h5><i class="fas fa-user-circle mr-2"></i>Datos del Participante</h5>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="cedula_f" class="required-field">Cédula de Identidad</label>
                                        <input type="number" id="cedula_f" name="cedula_f" onblur="validateUsers();"
                                            placeholder="Ej: 12345678" class="form-control" min="10000" max="9999999999"
                                            required />
                                        <small class="form-text text-muted">Solo números, entre 5 y 10 dígitos</small>
                                        <div class="invalid-feedback">
                                            <span id="cedula-error">La cédula debe tener entre 5 y 10 dígitos</span>
                                        </div>
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
                                        <label for="id_clasificacion">Edad</label>
                                        <input type="number" id="edad" name="edad" class="form-control">
                                    </div>



                                    <div class="col-md-8 form-group">
                                        <label for="direccion_fiscal" class="required-field">Dirección Completa</label>
                                        <textarea class="form-control" id="direccion_fiscal_" name="direccion_fiscal_"
                                            rows="3"
                                            placeholder="Ej: Av. Principal, Edificio XYZ, Piso 3, Oficina 301"></textarea>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <label for="direccion_fiscal" class="required-field">Observación</label>
                                        <textarea class="form-control" id="obser" name="obser" rows="3"
                                            placeholder="Ej: puede ingresar una observacion"></textarea>
                                    </div>
                                </div>
                                <div class="form-section">
                                    <h5><i class="fas fa-graduation-cap mr-2"></i>Información Curricular</h5>

                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="grado_instruccion" class="required-field">Grado de
                                                Instrucción</label>
                                            <select id="grado_instruccion" name="grado_instruccion" class="form-control"
                                                required>
                                                <option value="">Seleccione una opción</option>
                                                <?php foreach ($clasificacion as $data): ?>
                                                    <option value="<?= $data['id_academico'] ?>">
                                                        <?= $data['desc_academico'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="titulo_obtenido" class="required-field">Título Obtenido</label>
                                            <input type="text" id="titulo_obtenido" name="titulo_obtenido"
                                                class="form-control" required>
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label for="trabajo"> Tiene experiencia en contrataciones
                                                públicas</label>
                                            <select class="form-control" name="t_contrata_p" id="t_contrata_p"
                                                onclick="llenar_2();">
                                                <option value="0">Seleccione una opción</option>
                                                <option value="1">Sí</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="form-section" id='cmp1' style="display: none;">
                                        <div class="col-md-4 form-group">
                                            <label for="experiencia_publicas" class="required-field">Experiencia en
                                                Contrataciones Públicas (años)</label>
                                            <input type="number" id="experiencia_publicas" name="experiencia_publicas"
                                                class="form-control" min="1" max="4" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="tiene_capacitacion" class="required-field">¿Tiene capacitación
                                                en
                                                Contrataciones Públicas?</label>
                                            <select class="form-control" name="tiene_capacitacion"
                                                id="tiene_capacitacion" required>
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">Sí</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Sección de Capacitaciones (se muestra solo si selecciona "Sí") -->
                                    <div id="capacitaciones-container" style="display: none;">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle mr-2"></i>Debe agregar al menos una
                                            capacitación
                                            relacionada con Contrataciones Públicas (máximo 3).
                                        </div>

                                        <!-- Lista de capacitaciones -->
                                        <div id="lista-capacitaciones">
                                            <!-- Las capacitaciones se agregarán aquí dinámicamente -->
                                        </div>

                                        <!-- Botón para agregar nueva capacitación -->
                                        <button type="button" id="btn-add-capacitacion"
                                            class="btn btn-primary btn-sm btn-add-capacitacion">
                                            <i class="fas fa-plus mr-2"></i>Agregar otra capacitación
                                        </button>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="tiene_experiencia_laboral" class="required-field">¿Tiene
                                                experiencia laboral en los últimos 5 años?</label>
                                            <select class="form-control" name="tiene_experiencia_laboral"
                                                id="tiene_experiencia_laboral" required>
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">Sí</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="experiencia-laboral-container" style="display: none;">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle mr-2"></i>Debe agregar al menos una experiencia
                                            laboral (máximo 3).
                                        </div>

                                        <div id="lista-experiencias">
                                        </div>

                                        <button type="button" id="btn-add-experiencia"
                                            class="btn btn-primary btn-sm btn-add-experiencia">
                                            <i class="fas fa-plus mr-2"></i>Agregar otra experiencia laboral
                                        </button>
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
                                <div class="row">

                                    <div class="form-group">
                                        <label for="rif_b"><i class="fas fa-question-circle text-danger mr-1"></i>RIF de
                                            la
                                            Institución <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="rif_b" id="rif_b"
                                            placeholder="J123456789" maxlength="10" oninput="validarRIF(this)" required>
                                        <small id="rifError" class="text-danger d-none">
                                            El RIF debe tener <span id="missingChars">10</span> caracteres exactos (Ej:
                                            J123456789)
                                        </small>
                                        <div class="invalid-feedback">Debe ingresar el RIF de la institución</div>
                                    </div>
                                    <div class="col mt-4">
                                        <button type="button" class="btn btn-default" onclick="consultar_rif()"
                                            name="button" disabled>
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
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

                                    <div class="form-group">
                                        <label for="direccion_fiscal" class="required-field">Dirección Completa</label>
                                        <textarea class="form-control" id="direccion_fiscal" name="direccion_fiscal"
                                            rows="3"
                                            placeholder="Ej: Av. Principal, Edificio XYZ, Piso 3, Oficina 301"></textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="text-center mt-4">
                        <button type="button" id="guardar" onclick="Inscribir(event);" class="btn btn-primary btn-lg"
                            disabled>
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
    <script src="<?= base_url() ?>/js/diplomado/val_user.js"></script>



    <script>
        // Validación antes de enviar el formulario
        // function Inscribir(event) {
        //     // Validar que si seleccionó "Sí" en capacitación, tenga al menos una
        //     if ($('#tiene_capacitacion').val() === '1' && capacitacionCount === 0) {
        //         alert('Debe agregar al menos una capacitación relacionada con Contrataciones Públicas.');
        //         event.preventDefault();
        //         return false;
        //     }

        //     // Resto de tu lógica de validación...
        //     // ...
        // }
    </script>
</body>

</html>