<body style="background-image: url('<?php echo base_url('baner/fondo4.jpg'); ?>');  min-height: 100vh;
 
    background-size: cover;
    background-position: center;
    padding-top: 60px;">

    <div class="sidebar-bg"></div>
    <div id="content2" class="content2">

        <div class="header-container">
            <!-- Nuevo contenedor flex -->
            <h3 class="nav-logo"></h3>
            <h3 class="title1">
                Sistema Integrado del Servicio Nacional de Contrataciones
            </h3>
        </div>
        <!-- <div class="row justify-content-Left">
            <div class="col-md-8">
                <div class="card card-outline-danger text-center bg-white">
                    <div class="card-block">
                        <blockquote class="card-blockquote" style="margin-bottom: -30px;">
                            <p class="f-s-16 text-inverse f-w-600">Nombre Órgano / Ente:
                                <?php //echo $this->session->userdata('unidad'); 
                                ?>.</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div> -->



    </div>
    <div class="modal fade" id="pendingPaymentsModal" tabindex="-1" role="dialog"
        aria-labelledby="pendingPaymentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark d-flex align-items-center">
                    <h5 class="modal-title" id="pendingPaymentsModalLabel">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Notificación de Pagos Pendientes
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-secondary">Se han detectado planillas con pagos pendientes o incompletos que
                        requieren su atención.</p>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Código Planilla</th>
                                    <th>Fecha Inscripción</th>
                                    <th>Monto Pronto Pago</th>
                                    <th>Monto Crédito</th>
                                    <th>Tipo Inscripción</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_payments as $payment): ?>
                                    <tr>
                                        <td><?= $payment['codigo_planilla'] ?></td>
                                        <td><?= $payment['fecha_inscripcion'] ?></td>
                                        <td><?= number_format($payment['pronto_pago'], 2, ',', '.') ?> Bs</td>
                                        <td><?= number_format($payment['pay'], 2, ',', '.') ?> Bs</td>
                                        <td><?= $payment['tipo_inscripcion'] ?></td>
                                        <td>
                                            <?php
                                            if ($payment['estatus'] == 2) {
                                                echo '<span class="badge badge-warning">Pago Incompleto (Crédito)</span>';
                                            } else {
                                                // Considerar otros estatus si los tienes
                                                echo '<span class="badge badge-secondary">Pendiente</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    $(document).ready(function() {
        const perfilId = <?php echo json_encode($perfil_id); ?>;
        const pendingCount = <?php echo json_encode(count($pending_payments)); ?>;

        if ((perfilId === 1 || perfilId === 9) && pendingCount > 0) {
            $('#pendingPaymentsModal').modal('show');
        }
    });
</script>