<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show col-lg-8 mx-auto" role="alert" style="font-size: 1.2rem;">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show col-lg-8 mx-auto" role="alert" style="font-size: 1.2rem;">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<div class="content" style="font-size: 1.15rem;">
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow border-0"
                style="background: linear-gradient(90deg, #007bff, #00bfff); color: white;">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-unlock-alt fa-2x me-3"></i>
                    <div>
                        <h2 class="fw-bold mb-0" style="font-size: 2rem;">Excepciones de Rendición</h2>
                        <p class="mb-0" style="font-size: 1.25rem;">
                            Habilita temporalmente modificaciones y rendiciones por RIF y año.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buscar RIF -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-white fw-bold" style="font-size: 1.35rem;">
                    <i class="fas fa-search me-2"></i> Buscar Ente por RIF
                </div>
                <div class="card-body">
                    <form method="get" class="row gy-3 align-items-end">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 1.25rem;">RIF:</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                <input class="form-control form-control-lg" name="rif" placeholder="Ej: G200012345"
                                    value="<?= htmlspecialchars($rif) ?>" />
                            </div>
                        </div>
                        <div class="col-md-4 d-grid">
                            <button class="btn btn-lg btn-success fw-bold">
                                <i class="fas fa-search me-2"></i> Buscar
                            </button>
                        </div>
                    </form>

                    <?php if (!$rif): ?>
                        <div class="alert alert-info mt-3" style="font-size: 1.2rem;">
                            <i class="fas fa-info-circle me-1"></i>
                            Ingresa un RIF y presiona <b>Buscar</b> para ver los años programados.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ($rif): ?>
        <!-- Información del ente -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow border-success">
                    <div class="card-body">
                        <h3 class="fw-bold text-success mb-3">
                            <i class="far fa-building me-2"></i> Datos del Órgano / Ente
                        </h3>

                        <?php if (!empty($razon_social)): ?>
                            <p style="font-size: 1.35rem; margin-bottom:.5rem;">
                                <b>Nombre / Razón Social:</b>
                                <span class="badge" style="background:#28a745; font-size:1.1rem;">
                                    <?= htmlspecialchars($razon_social) ?>
                                </span>
                            </p>
                        <?php endif; ?>

                        <p style="font-size: 1.3rem; margin-bottom:.5rem;">
                            <b>RIF:</b>
                            <span class="badge bg-success" style="font-size:1.1rem;">
                                <?= htmlspecialchars($rif) ?>
                            </span>
                        </p>

                        <p style="font-size: 1.3rem; margin-bottom:0;">
                            <b>Años programados:</b>
                            <?php if (!empty($anios)): ?>
                                <?php foreach ($anios as $a): ?>
                                    <span class="badge bg-primary" style="font-size:1.1rem;"><?= $a['anio'] ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="text-danger">Sin registros</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Crear Excepción -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow border-warning">
                    <div class="card-header bg-warning fw-bold" style="font-size: 1.35rem;">
                        <i class="fas fa-plus-circle me-2"></i> Crear Excepción
                    </div>
                    <div class="card-body" style="font-size: 1.2rem;">
                        <form id="form-exc">
                            <input type="hidden" name="rif" value="<?= htmlspecialchars($rif) ?>">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Año <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-lg" name="anio" placeholder="Ej: 2024" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Fecha Inicio</label>
                                    <input type="date" class="form-control form-control-lg" name="fecha_inicio">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Fecha Fin</label>
                                    <input type="date" class="form-control form-control-lg" name="fecha_fin">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Motivo</label>
                                    <input class="form-control form-control-lg" name="motivo"
                                        placeholder="Describe el motivo (opcional)">
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                <button type="button" class="btn btn-lg btn-success fw-bold" onclick="crearExc()">
                                    <i class="fas fa-save me-2"></i> Guardar Excepción
                                </button>
                            </div>
                        </form>
                        <div class="alert alert-warning mt-3 mb-0" style="font-size: 1.1rem;">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Permite habilitar temporalmente la modificación/rendición de un año fuera del período normal.
                            Define fechas si quieres acotar la vigencia.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Excepciones -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow border-info">
                    <div class="card-header bg-info text-white fw-bold" style="font-size: 1.35rem;">
                        <i class="fas fa-list me-2"></i> Excepciones Vigentes / Históricas
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover align-middle mb-0" style="font-size: 1.2rem;">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Año</th>
                                    <th>Estado</th>
                                    <th>Vigencia</th>
                                    <th>Motivo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($excepciones)): ?>
                                    <?php foreach ($excepciones as $e): ?>
                                        <?php
                                        // Robustez: interpreta booleano que puede venir como true/false, 't'/'f', 1/0
                                        $activo = false;
                                        if (isset($e['habilitado'])) {
                                            $v = $e['habilitado'];
                                            // Usamos in_array para manejar los valores 'true', 1, o 't' (lo que retorne el driver para TRUE)
                                            // Usamos strtolower((string)$v) para estandarizar el valor de la base de datos
                                            $activo = in_array(strtolower((string)$v), ['t', 'true', '1', 1], true);
                                        }
                                        ?>
                                        <tr class="text-center">
                                            <td><?= (int)$e['id'] ?></td>
                                            <td>
                                                <span class="badge bg-primary" style="font-size:1.1rem;">
                                                    <?= htmlspecialchars($e['anio']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($activo): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Activo
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i>Inactivo
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= $e['fecha_inicio'] ?: '—' ?> → <?= $e['fecha_fin'] ?: '—' ?>
                                            </td>
                                            <td>
                                                <?= $e['motivo'] !== '' ? htmlspecialchars($e['motivo']) : '<span>Sin motivo</span>' ?>
                                            </td>
                                            <td>
                                                <?php if ($activo): ?>
                                                    <form method="POST"
                                                        action="<?= base_url('index.php/RendicionExcepciones/deshabilitar_tradicional') ?>">
                                                        <input type="hidden" name="id" value="<?= (int)$e['id'] ?>">
                                                        <input type="hidden" name="rif_actual" value="<?= htmlspecialchars($rif) ?>">

                                                        <button type="submit" class="btn btn-sm btn-danger fw-bold"
                                                            onclick="return confirm('¿Deshabilitar excepción? Esta acción la desactivará inmediatamente.')">
                                                            <i class="fas fa-ban me-1"></i> Deshabilitar
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <span>—</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="text-center text-danger">
                                        <td colspan="6">
                                            <i class="fas fa-folder-open me-2"></i> No hay excepciones registradas
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Scripts -->
<script>
    const BASE_URL = '<?= base_url() ?>';

    function usarSwal(icon, title, text, cb) {
        if (window.Swal) {
            Swal.fire({
                icon,
                title,
                text: text || '',
                confirmButtonColor: (icon === 'success') ? '#198754' : '#d33'
            }).then(() => {
                if (typeof cb === 'function') cb();
            });
        } else {
            alert(title + (text ? ('\n' + text) : ''));
            if (typeof cb === 'function') cb();
        }
    }

    function crearExc() {
        const form = document.getElementById('form-exc');
        const data = new FormData(form);

        fetch(BASE_URL + 'index.php/RendicionExcepciones/crear', {
                method: 'POST',
                body: data
            })
            .then(r => r.json())
            .then(ok => {
                // ok es 1/0 según tu controlador crear()
                console.log('crearExcepcion -> resp:', ok);
                usarSwal(ok == 1 ? 'success' : 'error',
                    ok == 1 ? 'Excepción creada correctamente' : 'No se pudo crear la excepción',
                    '',
                    () => {
                        if (ok == 1) location.reload();
                    });
            })
            .catch((e) => usarSwal('error', 'Error de comunicación', e?.message || ''));
    }
</script>