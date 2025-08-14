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
    <?php
    // Check if the user is an admin and if there are pending payments
    if (($perfil_id == 1 || $perfil_id == 9) && count($pending_payments) > 0):
    ?>
        <div id="content2" class="content2">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Notificación de Pagos Pendientes
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-secondary">Se han detectado planillas con pagos pendientes o incompletos que requieren su
                        atención.</p>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Código Planilla</th>
                                    <th>Fecha Inscripción</th>
                                    <th>Tipo Inscripción</th>
                                    <th>Monto de la Deuda</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_payments as $payment): ?>
                                    <tr>
                                        <td><?= $payment['codigo_planilla'] ?></td>
                                        <td><?= $payment['fecha_inscripcion'] ?></td>
                                        <td><?= $payment['tipo_inscripcion'] ?></td>
                                        <td>
                                            <?php
                                            // Calculate and display the debt amount based on the status
                                            if ($payment['estatus'] == 2) {
                                                // For credit payments, the debt is half of the total pay + IVA
                                                $total_con_iva = $payment['pay'] + ($payment['pay'] * 0.16);
                                                $monto_deuda = $total_con_iva / 2;
                                                echo number_format($monto_deuda, 2, ',', '.') . ' Bs';
                                            } else {
                                                // For pending pronto pago, the debt is the pronto pago amount + IVA
                                                $total_con_iva = $payment['pronto_pago'] + ($payment['pronto_pago'] * 0.16);
                                                echo number_format($total_con_iva, 2, ',', '.') . ' Bs';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($payment['estatus'] == 2) {
                                                echo '<span class="badge badge-warning">Pago Incompleto (Crédito)</span>';
                                            } else {
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
            </div>
        </div>
    <?php endif; ?>


</body>