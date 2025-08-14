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
        <div class="row justify-content-Left">
            <div class="col-md-8">
                <div class="card card-outline-danger text-center bg-white">
                    <div class="card-block">
                        <blockquote class="card-blockquote" style="margin-bottom: -30px;">
                            <p class="f-s-16 text-inverse f-w-600">Nombre Órgano / Ente:
                                <?php echo $this->session->userdata('unidad');
                                ?>.</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <style>
        /* Estilos personalizados para el contenedor principal */
        .wide-container {
            width: 60%;
            /* Ajusta el ancho del contenedor al 90% de la pantalla */
            margin: auto;
            /* Centra el contenedor horizontalmente */
        }

        /* Estilos personalizados para la tabla */
        .table-responsive table {
            table-layout: fixed;
            /* Mantiene las columnas con un ancho fijo */
            width: 100%;
        }

        .table-responsive .col-id {
            width: 25%;
            /* Ajusta el ancho de la columna de Código Planilla */
        }

        .table-responsive .col-fecha {
            width: 20%;
            /* Ajusta el ancho de la columna de Fecha Inscripción */
        }

        .table-responsive .col-deuda {
            width: 15%;
            /* Ajusta el ancho de la columna de Monto de la Deuda */
        }

        .table-responsive .col-estatus {
            width: 18%;
            /* Ajusta el ancho de la columna de Estatus */
        }

        .table-responsive td {
            font-size: 14px;
            /* Aumenta el tamaño de la letra en las celdas de datos */
            white-space: normal;
            /* Permite que el texto se ajuste si es demasiado largo */
            word-wrap: break-word;
            /* Rompe palabras largas para evitar que se desborden */
        }

        .table-responsive th {
            font-size: 14px;
            /* Aumenta el tamaño de la letra en los encabezados */
        }
    </style>
    <?php
    // Check if the user is an admin and if there are pending payments
    if (($perfil_id == 1 || $perfil_id == 9) && count($pending_payments) > 0):
    ?>
        <div class="wide-container mt-2">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-warning">
                        <div class="card-header bg-warning text-dark d-flex align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Notificación de Pagos Pendientes
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-secondary">Se han detectado planillas con pagos pendientes o incompletos que
                                requieren su
                                atención.</p>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="col-id">Código Planilla</th>

                                            <th>Tipo Inscripción</th>
                                            <th class="col-deuda">Monto de la Deuda</th>
                                            <th class="col-estatus">Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pending_payments as $payment): ?>
                                            <tr>
                                                <td><?= $payment['codigo_planilla'] ?></td>

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
            </div>
        </div>

    <?php endif; ?>


</body>