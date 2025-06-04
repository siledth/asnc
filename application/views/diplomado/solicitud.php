<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscripción del Diplomado - Sistema Integrado SNC</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="<?= base_url('css/diplomado.css') ?>" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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
                        <form id="inscripcionForm" name="inscripcionForm" method="POST" enctype="multipart/form-data">

                            <div class="form-section">
                                <h5><i class="fas fa-graduation-cap mr-2"></i>Información del Diplomado</h5>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="id_diplomado" class="required-field">Seleccione el Diplomado</label>
                                        <select id="id_diplomado" name="id_diplomado" class="form-control" required>
                                            <option value="">Seleccione una opción</option>
                                            <?php foreach ($diplomado as $data): ?>
                                                <option value="<?= $data['id_diplomado'] ?>">
                                                    <?= $data['name_d'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

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

                            <div class="form-section">
                                <h5><i class="fas fa-user-circle mr-2"></i>Datos del Participante</h5>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="cedula_f" class="required-field">Cédula de Identidad</label>
                                        <input type="text" id="cedula_f" name="cedula_f" placeholder="Ej: 12345678"
                                            class="form-control" min="10000" max="9999999999" required />
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
                                                placeholder="Ej: usuario@dominio.com" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="edad">Edad</label>
                                        <input type="text" id="edad" name="edad" class="form-control" required />
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <label for="direccion_fiscal_" class="required-field">Dirección Completa</label>
                                        <textarea class="form-control" id="direccion_fiscal_" name="direccion_fiscal_"
                                            rows="3" placeholder="Ej: Av. Principal, Edificio XYZ, Piso 3, Oficina 301"
                                            required></textarea>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <label for="obser">Observación (Opcional)</label>
                                        <textarea class="form-control" id="obser" name="obser" rows="3"
                                            placeholder="Ej: puede ingresar una observacion"></textarea>
                                    </div>
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
                                        <label for="t_contrata_p" class="required-field">¿Tiene experiencia en
                                            Contrataciones Públicas?</label>
                                        <select class="form-control" name="t_contrata_p" id="t_contrata_p" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Sí</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" id='experiencia_publicas_container' style="display: none;">
                                    <div class="col-md-4 form-group">
                                        <label for="experiencia_publicas" class="required-field">Años de Experiencia en
                                            Contrataciones Públicas</label>
                                        <input type="text" id="experiencia_publicas" name="experiencia_publicas"
                                            class="form-control" min="0" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="tiene_capacitacion" class="required-field">¿Ha realizado
                                            capacitaciones en Contrataciones Públicas?</label>
                                        <select class="form-control" name="tiene_capacitacion" id="tiene_capacitacion"
                                            required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Sí</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="capacitaciones-container" style="display: none;">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle mr-2"></i>Debe agregar al menos una capacitación
                                        relacionada con Contrataciones Públicas (máximo 3).
                                    </div>

                                    <div id="lista-capacitaciones">
                                    </div>

                                    <button type="button" id="btn-add-capacitacion"
                                        class="btn btn-primary btn-sm btn-add-capacitacion">
                                        <i class="fas fa-plus mr-2"></i>Agregar otra capacitación
                                    </button>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6 form-group">
                                        <label for="tiene_experiencia_laboral" class="required-field">¿Tiene experiencia
                                            laboral formal?</label>
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
                                        <i class="fas fa-info-circle mr-2"></i>Agregue sus experiencias laborales más
                                        recientes (máximo 3).
                                        Marque la casilla "Es su empleo actual?" si aplica.
                                    </div>

                                    <div id="lista-experiencias">
                                    </div>

                                    <button type="button" id="btn-add-experiencia"
                                        class="btn btn-primary btn-sm btn-add-experiencia">
                                        <i class="fas fa-plus mr-2"></i>Añadir Experiencia Laboral
                                    </button>
                                </div>
                            </div>
                            <div class="form-section mt-4">
                                <h5><i class="fas fa-file-signature mr-2"></i>Declaración Jurada</h5>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="declaracionJurada"
                                        name="declaracionJurada" required>
                                    <label class="form-check-label" for="declaracionJurada">
                                        Declaro que la información y datos suministrados en esta Ficha son fidedignos,
                                        por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a
                                        comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí
                                        suministrados, quedará sin efecto la Preinscripción.
                                    </label>
                                    <div class="invalid-feedback" id="declaracionJurada-feedback">
                                        Debe aceptar la declaración jurada para continuar.
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" id="guardarInscripcionBtn" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save mr-2"></i>Guardar Inscripción
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="<?= base_url() ?>/js/diplomado/pnatural.js"></script>
    <script src="<?= base_url() ?>/js/diplomado/val_user.js"></script>

</body>

</html>