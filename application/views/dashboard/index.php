<body style="background-image: url('<?php echo base_url('baner/123456.jpg'); ?>');">

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Bienvenido al Sistema Integrado del Servicio Nacional de Contrataciones </h4>
                    </div>

                    <div class="card-body">
                        <h5>Bienvenido, <?php echo $username; ?></h5>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6>Información del Usuario</h6>
                                        <p><strong>Usuario:</strong> <?php echo $username; ?></p>
                                        <p><strong>Perfil:</strong> <?php echo $perfil_nombre; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div
                                    class="card <?php echo ($perfil_id == 1) ? 'bg-info' : 'bg-success'; ?> text-white">
                                    <div class="card-body">
                                        <?php if($perfil_id == 1): ?>
                                        <h6>Acceso según Perfil</h6>

                                        <p>Como administrador, tienes acceso completo al sistema.</p>
                                        <ul>
                                            <li>Gestión de usuarios</li>
                                            <li>Configuración del sistema</li>
                                            <li>Reportes avanzados</li>
                                        </ul>
                                        <?php else: ?>
                                        <!-- <p>Como usuario regular, tienes acceso a:</p>
                                        <ul>
                                            <li>Ver y editar tu perfil</li>
                                            <li>Acceder a reportes básicos</li>
                                            <li>Realizar operaciones estándar</li>
                                        </ul> -->
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>