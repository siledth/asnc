<body style="background-image: url('<?php echo base_url('baner/fondo4.jpg'); ?>');  min-height: 100vh;
    background-size: cover;
    background-position: center;
    /* Reducimos el padding-top del body para subir el contenido */
    padding-top: 5px;">

    <div class="sidebar-bg"></div>

    <div id="content" class="content">

        <div class="header-container" style="margin-top: 10px; margin-bottom: 5px;">
            <h3 class="nav-logo" style="display: inline-block;"></h3>
            <h3 class="title1" style="display: inline-block; font-size: 1.8rem;">
                Sistema Integrado del Servicio Nacional de Contrataciones
            </h3>
        </div>

        <div class="row justify-content-Left">
            <div class="col-md-12">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: 5px;">
                        <!-- <h4 class="title1" style="font-size: 1.4rem; margin-top: 0;">
                            Servicio Nacional de Contrataciones
                        </h4> -->
                        <h4 class="title1 unit-name-kpi" style="font-size: 1.2rem; font-weight: 600;">
                            <?php echo $this->session->userdata('unidad'); ?>
                        </h4>
                    </blockquote>
                </div>
            </div>
        </div>

        <?php if (($perfil_id == 1 || $perfil_id == 3) && !empty($kpi_ingresos)):
            $totales = $kpi_ingresos['totales'];
            $total_general = $kpi_ingresos['total_general'];
        ?>
            <div id="kpi-section" class="row">

                <div class="col-md-12">
                    <div class="kpi-card bg-total-general" style="margin-top: 15px;">
                        <p>MONTO TOTAL Ingresado (<?= date('Y') ?>)</p>
                        <h4><?= number_format($total_general, 2, ',', '.') ?> Bs</h4>
                    </div>
                </div>

                <div class="col-md-3 mt-3">
                    <div class="kpi-card bg-transferencia">
                        <h4><?= number_format($totales['transferencia'] ?? 0, 2, ',', '.') ?></h4>
                        <p>Transferencia</p>
                    </div>
                </div>

                <div class="col-md-3 mt-3">
                    <div class="kpi-card bg-boton-pago">
                        <h4><?= number_format($totales['boton_de_pago'] ?? 0, 2, ',', '.') ?></h4>
                        <p>Botón de Pago</p>
                    </div>
                </div>

                <div class="col-md-3 mt-3">
                    <div class="kpi-card bg-transferencia_multiple">
                        <h4><?= number_format($totales['transferencia_multiple'] ?? 0, 2, ',', '.') ?></h4>
                        <p>Transferencia Múltiple</p>
                    </div>
                </div>

                <div class="col-md-3 mt-3">
                    <div class="kpi-card bg-pago_movil">
                        <h4><?= number_format($totales['pago_movil'] ?? 0, 2, ',', '.') ?></h4>
                        <p>Pago Móvil</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        if (($perfil_id == 1 || $perfil_id == 9) && count($pending_payments) > 0):
        ?>
            <div class="mt-4">
                <div class="card border-warning notification-card" style="margin-top: 0 !important;">
                    <div class="card-header bg-warning text-dark d-flex align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Notificación de Pagos Pendientes
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-secondary">Se han detectado planillas con pagos pendientes o incompletos que
                            requieren su atención.</p>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="col-id">Código Planilla</th>
                                        <th class="col-fecha">Fecha Inscripción</th>
                                        <th>Tipo Inscripción</th>
                                        <th class="col-deuda">Monto de la Deuda</th>
                                        <th class="col-estatus">Estatus</th>
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
                                                if ($payment['estatus'] == 2) {
                                                    $total_con_iva = $payment['pay'] + ($payment['pay'] * 0.16);
                                                    $monto_deuda = $total_con_iva / 2;
                                                    echo number_format($monto_deuda, 2, ',', '.') . ' Bs';
                                                } else {
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
    </div>
    <style>
        /* Estilos CSS */

        /* SOLUCIÓN AL PROBLEMA DEL NOMBRE LARGO DE LA UNIDAD */
        .unit-name-kpi {
            white-space: normal !important;
            word-wrap: break-word;
            line-height: 1.3;
            display: block !important;
            max-width: 100%;
        }

        /* Estilos KPI y de Contenedor */
        .header-container {
            margin-left: -15px;
            /* Ajusta la posición del título principal */
        }

        #kpi-section {
            margin-top: 15px !important;
        }

        .kpi-card {
            border-radius: .5rem;
            text-align: center;
            padding: 20px 0;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, .3);
            margin-bottom: 15px;
            font-family: inherit;
        }

        .kpi-card h4 {
            font-size: 2.2rem;
            margin-bottom: 0;
            font-weight: 900;
        }

        .kpi-card p {
            font-size: 1rem;
            margin-top: 5px;
            opacity: 1;
            font-weight: 500;
        }

        /* TARJETA TOTAL GENERAL */
        .bg-total-general {
            background-color: #F8F9CC;
            color: #333 !important;
            text-align: center;
            padding: 25px;
            box-shadow: none;
            margin-bottom: 10px;
            border-radius: 0;
        }

        .bg-total-general h4 {
            font-size: 2.5rem;
            font-weight: 900;
            color: #333;
        }

        .bg-total-general p {
            font-size: 1.5rem;
            color: #333;
            font-weight: 700;
            margin-bottom: 0;
        }

        /* Colores de los Métodos de Pago */
        .bg-transferencia {
            background-color: #5cb85c;
            color: #fff;
        }

        .bg-boton-pago {
            background-color: #3470a3;
            color: #fff;
        }

        .bg-transferencia_multiple {
            background-color: #FFC300;
            color: #333;
        }

        .bg-transferencia_multiple h4,
        .bg-transferencia_multiple p {
            color: #333;
        }

        .bg-pago_movil {
            background-color: #c9302c;
            color: #fff;
        }

        /* Estilos de tabla existentes */
        .table-responsive table {
            table-layout: fixed;
            width: 100%;
        }
    </style>
</body>