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

    <style>
        .participante-item,
        .capacitacion-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
        }

        .participante-item h5,
        .capacitacion-item h6 {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .btn-add-participante,
        .btn-add-capacitacion {
            margin-bottom: 20px;
        }

        .btn-remove-participante,
        .btn-remove-capacitacion {
            margin-top: 10px;
        }
    </style>
</head>


<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card-container">
                    <img src="<?= base_url() ?>Plantilla/img/loij.png" alt="Logo" class="img-fluid">
                    <div class="card-header">
                        <h4>Persona Jurídica - Inscripción Diplomado</h4>
                    </div>
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
                            <div class="info-item"><strong>Fecha de fin:</strong> <span id="diplomadoFechaFin"></span>
                            </div>
                            <div class="info-item"><strong>Modalidad:</strong> <span id="diplomadoModalidad"></span>
                            </div>
                            <div class="info-item"><strong>Costo por persona:</strong> <span id="diplomadoM"></span>
                            </div>

                        </div>
                    </div>
                    <!-- Paso 1: Datos de la Empresa -->
                    <div class="card-body step" id="step-1">
                        <h5><i class="fas fa-building mr-2"></i>Datos de la Empresa</h5>
                        <!-- Formulario de empresa aquí -->
                        <div id='no_existe'>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Complete los datos de la
                                institución.
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="rif_55"><i
                                            class="fas fa-question-circle text-danger mr-1"></i>RIF</label>
                                    <input type="text" class="form-control"
                                        onKeyUp="this.value=this.value.toUpperCase();" name="rif" id="rif"
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
                                    <label for="tel_local" class="required-field">es un ente Gubernamental?</label>


                                    <select class="form-control" name="ente" id="ente">
                                        <option value="0">Seleccione una opción</option>
                                        <option value="1">Sí</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>

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
                                <textarea class="form-control" id="direccion_fiscal" name="direccion_fiscal" rows="3"
                                    placeholder="Ej: Av. Principal, Edificio XYZ, Piso 3, Oficina 301"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary next-step" data-next="2">Siguiente</button>

                    </div>

                </div>

                <!-- Paso 2: Agregar Participantes -->
                <div class="card-body step" id="step-2" style="display:none;">
                    <h5><i class="fas fa-user-plus mr-2"></i>Agregar Participante</h5>
                    <!-- Formulario de participante aquí -->
                    <!-- Formulario para agregar participantes -->
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Cédula</label>
                            <input type="text" id="cedula" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group">

                            <label>Nombres</label>
                            <input type="text" id="nombres" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group">

                            <label>Apellidos</label>
                            <input type="text" id="apellidos" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="tel_local" class="required-field">Teléfono Local</label>
                            <input type="number" id="tel_part" name="tel_part" class="form-control"
                                placeholder="Ej: 02121234567">
                            <p id="errorMsg" class="text-danger"></p>
                        </div>
                    </div>

                    <!-- <button type="button" id="btn-agregar" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Participante
                    </button> -->

                    <!-- Lista de participantes agregados -->
                    <div id="lista-participantes" class="mt-3"></div>
                    <button type="button" class="btn btn-secondary prev-step" data-prev="1">Anterior</button>
                    <button type="button" class="btn btn-success" id="btn-agregar-participante">Agregar
                        Participante</button>
                    <button type="button" class="btn btn-primary next-step" data-next="3">Siguiente</button>
                </div>

                <!-- Paso 3: Resumen y Confirmación -->


                <div class="card-body step" id="step-3" style="display:none;">
                    <h5><i class="fas fa-list-check mr-2"></i>Resumen</h5>
                    <div id="resumen-empresa"></div>
                    <div id="resumen-participantes" class="mt-4"></div>

                    <div class="form-section mt-4">
                        <h5><i class="fas fa-file-signature mr-2"></i>Declaración Jurada</h5>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="declaracionJurada"
                                name="declaracionJurada" required>
                            <label class="form-check-label" for="declaracionJurada">
                                Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo
                                que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que
                                se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin
                                efecto la Preinscripción.
                            </label>
                            <div class="invalid-feedback" id="declaracionJurada-feedback" style="display: none;">
                                Debe aceptar la declaración jurada para finalizar la inscripción.
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary prev-step" data-prev="2">Anterior</button>
                    <button type="button" class="btn btn-primary" id="btn-finalizar" disabled>
                        Finalizar Inscripción
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="<?= base_url() ?>/js/solicitud/solicitudpj.js"></script>
<!-- <script src="<?= base_url() ?>/js/solicitud/solicitud.js"></script> -->
<!-- test -->


<!-- Modal para Curriculum -->
<div class="modal fade" id="modalCurriculum" tabindex="-1" aria-labelledby="modalCurriculumLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCurriculumLabel">Información Curricular</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Cédula</label>
                    <p id="modalCedula" class="form-control-plaintext"></p>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Grado de Instrucción</label>
                        <select id="grado_instruccion" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <?php foreach ($clasificacion as $data): ?>
                                <option value="<?= $data['id_academico'] ?>"><?= $data['desc_academico'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Título Obtenido</label>
                        <input type="text" id="titulo_obtenido" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Experiencia en contrataciones públicas (años)</label>
                        <input type="number" id="experiencia_publicas" class="form-control" min="0">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>¿Tiene capacitación en contrataciones públicas?</label>
                        <select id="tiene_capacitacion" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                </div>

                <div id="seccionCapacitaciones" style="display: none;">
                    <h5 class="mt-4">Capacitaciones</h5>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>Debe agregar al menos una capacitación relacionada con
                        Contrataciones Públicas (máximo 3).
                    </div>

                    <div id="listaCapacitaciones">
                        <!-- Capacitaciones se agregarán aquí dinámicamente -->
                    </div>

                    <button type="button" class="btn btn-primary btn-sm mt-2" id="btnAgregarCapacitacionModal">
                        <i class="fas fa-plus mr-2"></i>Agregar capacitación
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarCurriculum">Guardar</button>
            </div>
        </div>
    </div>
</div>