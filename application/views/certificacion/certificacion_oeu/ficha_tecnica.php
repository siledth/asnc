<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fas fa-clipboard-list fa-fw mr-2"></i> FICHA TÉCNICA DE CERTIFICACIÓN
                    </h4>
                </div>
                <div class="panel-body">

                    <?php if (isset($certificacion_info) && $certificacion_info): ?>

                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i> Información General</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row">
                                        <dt class="col-sm-5">Registro de Información Fiscal (RIF):</dt>
                                        <dd class="col-sm-7">
                                            <strong><?= htmlspecialchars($certificacion_info['rif_cont'] ?? 'N/A') ?></strong>
                                        </dd>

                                        <dt class="col-sm-5">Razón Social:</dt>
                                        <dd class="col-sm-7">
                                            <strong><?= htmlspecialchars($certificacion_info['nombre'] ?? 'N/A') ?></strong>
                                        </dd>

                                        <dt class="col-sm-5">Fecha Solicitud:</dt>
                                        <dd class="col-sm-7">
                                            <?= htmlspecialchars($certificacion_info['fecha_solic'] ?? 'N/A') ?></dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row">
                                        <dt class="col-sm-5">Número de Comprobante:</dt>
                                        <dd class="col-sm-7">
                                            <?= htmlspecialchars($certificacion_info['nro_comprobante'] ?? 'N/A') ?>
                                        </dd>

                                        <dt class="col-sm-5">Monto Total (BsS):</dt>
                                        <dd class="col-sm-7">
                                            <?= number_format($certificacion_info['total_bss'] ?? 0, 2, ',', '.') ?>
                                        </dd>





                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-book-open mr-2"></i> Programa del Curso o Taller</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="font-weight-bold">Objetivo:</label>
                                    <p class="card-text">
                                        <?= nl2br(htmlspecialchars($certificacion_info['objetivo'] ?? 'N/A')) ?></p>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="font-weight-bold">Contenido Programático:</label>
                                    <p class="card-text">
                                        <?= nl2br(htmlspecialchars($certificacion_info['cont_prog'] ?? 'N/A')) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0"><i class="fas fa-building mr-2"></i> Experiencia de la Empresa en
                                Capacitación en Comisión de Contrataciones (en los últimos 3 años)</h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($experiencia_empresa) && !empty($experiencia_empresa)): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Órgano/Ente</th>
                                            <th>Actividad</th>
                                            <th>Desde</th>
                                            <th>Hasta</th>
                                            <th>Nº Cert.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($experiencia_empresa as $exp_emp): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($exp_emp['organo_expe'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($exp_emp['actividad_exp'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($exp_emp['desde_exp'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($exp_emp['hasta_exp'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($exp_emp['n_certif'] ?? 'N/A') ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <p class="text-center text-muted">No hay experiencia de la empresa en capacitación cargada.
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-building mr-2"></i> Experiencia de la Empresa en
                                Capacitación en Materias Relacionadas Con Contratación Pública (en los últimos 5 años)
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($experiencia_empresa10) && !empty($experiencia_empresa10)): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Órgano/Ente</th>
                                            <th>Actividad</th>
                                            <th>Desde</th>
                                            <th>Hasta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($experiencia_empresa10 as $exp_emp10): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($exp_emp10['organo_experi_empre_capa'] ?? 'N/A') ?>
                                            </td>
                                            <td><?= htmlspecialchars($exp_emp10['actividad_experi_empre_capa'] ?? 'N/A') ?>
                                            </td>
                                            <td><?= htmlspecialchars($exp_emp10['desde_experi_empre_capa'] ?? 'N/A') ?>
                                            </td>
                                            <td><?= htmlspecialchars($exp_emp10['hasta_experi_empre_capa'] ?? 'N/A') ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <p class="text-center text-muted">No hay experiencia de la empresa en capacitación cargada.
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-users mr-2"></i> Información de Facilitadores</h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($facilitadores_detalles) && !empty($facilitadores_detalles)): ?>
                            <div id="accordionFacilitadores">
                                <?php $facilitador_count = 1;
                                        foreach ($facilitadores_detalles as $facilitador): ?>
                                <div class="card mb-2">
                                    <div class="card-header" id="heading<?= $facilitador_count ?>">
                                        <h6 class="mb-0">
                                            <button class="btn btn-link btn-block text-left font-weight-bold"
                                                type="button" data-toggle="collapse"
                                                data-target="#collapse<?= $facilitador_count ?>" aria-expanded="true"
                                                aria-controls="collapse<?= $facilitador_count ?>">
                                                Facilitador #<?= $facilitador_count ?>:
                                                <?= htmlspecialchars($facilitador['nombre_ape'] ?? 'N/A') ?> (C.I.:
                                                <?= htmlspecialchars($facilitador['cedula'] ?? 'N/A') ?>)
                                                <i class="fas fa-chevron-down float-right"></i>
                                            </button>
                                        </h6>
                                    </div>

                                    <div id="collapse<?= $facilitador_count ?>"
                                        class="collapse <?= ($facilitador_count == 1) ? 'show' : '' ?>"
                                        aria-labelledby="heading<?= $facilitador_count ?>"
                                        data-parent="#accordionFacilitadores">
                                        <div class="card-body">
                                            <h6 class="mt-2 text-primary"><i
                                                    class="fas fa-graduation-cap mr-2"></i>Formación Académica:</h6>
                                            <?php if (!empty($facilitador['formacion_academica'])): ?>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Nivel Académico</th>
                                                            <th>Título</th>
                                                            <th>Año Inicio</th>
                                                            <th>Año Fin</th>
                                                            <th>En Curso</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($facilitador['formacion_academica'] as $acad): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($acad['desc_academico'] ?? 'N/A') ?>
                                                            </td>
                                                            <td><?= htmlspecialchars($acad['titulo'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($acad['ano'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($acad['culminacion'] ?? 'N/A') ?>
                                                            </td>
                                                            <td><?= (isset($acad['curso']) && $acad['curso'] == 2) ? 'Sí' : 'No' ?>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php else: ?>
                                            <p class="text-muted">No hay información académica cargada.</p>
                                            <?php endif; ?>

                                            <h6 class="mt-3 text-primary"><i class="fas fa-gavel mr-2"></i>Formación en
                                                Materia de Contratación Pública:</h6>
                                            <?php if (!empty($facilitador['formacion_cp'])): ?>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Curso/Taller</th>
                                                            <th>Institución</th>
                                                            <th>Horas</th>
                                                            <th>Nº Cert.</th>
                                                            <th>Fecha Cert.</th>
                                                            <th>Vigencia</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($facilitador['formacion_cp'] as $fcp): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($fcp['taller'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($fcp['institucion'] ?? 'N/A') ?>
                                                            </td>
                                                            <td><?= htmlspecialchars($fcp['hor_dura'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($fcp['certi'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($fcp['fech_cert'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($fcp['vigencia'] ?? 'N/A') ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php else: ?>
                                            <p class="text-muted">No hay formación en contratación pública cargada.</p>
                                            <?php endif; ?>

                                            <h6 class="mt-3 text-primary"><i
                                                    class="fas fa-handshake mr-2"></i>Experiencia en Comisiones de
                                                Contrataciones (Últimos 10 años):</h6>
                                            <?php if (!empty($facilitador['experiencia_comisiones'])): ?>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Órgano/Ente</th>
                                                            <th>Acto Admin.</th>
                                                            <th>Nº Acto</th>
                                                            <th>Fecha Acto</th>
                                                            <th>Área</th>
                                                            <th>Duración</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($facilitador['experiencia_comisiones'] as $exc): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($exc['organo10'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($exc['act_adminis_desid'] ?? 'N/A') ?>
                                                            </td>
                                                            <td><?= htmlspecialchars($exc['n_acto'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($exc['fecha_act'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($exc['area_10'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($exc['dura_comi'] ?? 'N/A') ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php else: ?>
                                            <p class="text-muted">No hay experiencia en comisiones cargada.</p>
                                            <?php endif; ?>

                                            <h6 class="mt-3 text-primary"><i
                                                    class="fas fa-chalkboard-teacher mr-2"></i>Experiencia en Dictado de
                                                Capacitación (Últimos 3 años):</h6>
                                            <?php if (!empty($facilitador['dictado_capacitacion'])): ?>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered table-hover">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Órgano/Ente</th>
                                                            <th>Actividad</th>
                                                            <th>Desde</th>
                                                            <th>Hasta</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($facilitador['dictado_capacitacion'] as $edc): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($edc['organo3'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($edc['actividad3'] ?? 'N/A') ?>
                                                            </td>
                                                            <td><?= htmlspecialchars($edc['desde3'] ?? 'N/A') ?></td>
                                                            <td><?= htmlspecialchars($edc['hasta3'] ?? 'N/A') ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php else: ?>
                                            <p class="text-muted">No hay experiencia en dictado de capacitación cargada.
                                            </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $facilitador_count++;
                                        endforeach; ?>
                            </div>
                            <?php else: ?>
                            <p class="text-center text-muted">No hay facilitadores asociados a esta certificación o a la
                                Razón Social de la empresa.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php else: ?>
                    <div class="alert alert-warning text-center" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i> No se encontró información para la
                        certificación solicitada.
                    </div>
                    <?php endif; ?>

                    <div class="col-12 text-center mt-4">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary mr-2"
                            href="javascript:history.back()"> <i class="fas fa-arrow-left mr-2"></i> Volver</a>

                        <?php
                        // Obtener el ID de la certificación principal para pasarlo al modal
                        $current_cert_id = $certificacion_info['id'] ?? null;
                        $current_rif_organoente = $this->session->userdata('rif'); // Asumo que $rif_organoente es el RIF del usuario logeado
                        $current_status = $certificacion_info['status'] ?? null; // Asumo que el status de la certificación está en $certificacion_info
                        ?>

                        <?php if ($current_cert_id && $current_rif_organoente == "G200024518") : ?>
                        <?php if ($current_status == 1 || $current_status == 3) : ?>
                        <button type="button"
                            class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-info ml-2"
                            data-toggle="modal" data-target="#modalGestionCertificacion"
                            onclick="prepareGestionModal(<?php echo htmlspecialchars($current_cert_id); ?>);">
                            <i class="fas fa-file-import mr-2"></i> Decisión
                        </button>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/js/certificacion/aprobar_certi.js"></script>

<div class="modal fade" id="modalGestionCertificacion" tabindex="-1" role="dialog"
    aria-labelledby="modalGestionCertificacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGestionCertificacionLabel">Gestión de Registro de Certificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_gestion_certificacion" name="form_gestion_certificacion"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">

                        <div class="form-group col-12">
                            <input class="form-control" type="text" name="id_certificacion_gestion"
                                id="id_certificacion_gestion" readonly>
                        </div>

                        <input class="form-control" type="text" name="users" id="users"
                            value="<?= htmlspecialchars($this->session->userdata('id_user') ?? '') ?>" readonly>

                        <div class="form-group col-md-6">
                            <label>Razón Social:</label>
                            <input class="form-control" type="text" name="nombre_gestion" id="nombre_gestion" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>RIF:</label>
                            <input class="form-control" type="text" name="rif_cont_gestion" id="rif_cont_gestion"
                                readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Seleccione estatus de la certificación <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class="form-control" id="status_gestion" name="status"
                                onchange="calculateVigenciaGestion();">
                                <option value="">Seleccionar</option>
                                <option value="2">Aprobado</option>
                                <option value="3">Rechazado</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" id="vigen_cert_desde_gestion" name="vigen_cert_desde"
                                class="form-control" value="<?= date('Y-m-d') ?>" /> <input type="text"
                                id="vigen_cert_hasta_gestion" name="vigen_cert_hasta" class="form-control" />
                        </div>

                        <div class="form-group col-md-12">
                            <label>Observación:</label>
                            <textarea name="observacion" id="observacion_gestion" rows="5"
                                class="form-control"></textarea>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_decision_certificacion" onclick="save_decision_certificacion();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>