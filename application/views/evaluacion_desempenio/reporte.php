<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Evaluaciones Registradas</title>
</head>

<body>
    <section>
        <div class="content">
            <div class="panel-body">
                <div class="col-12 ml-1">
                    <div class="card card-outline-danger text-center bg-white">
                        <div class="card-block">
                            <blockquote class="card-blockquote" style="margin-bottom: -15px;">
                                <img style="width: 100%" height="100%" src=" <?= base_url() ?>Plantilla/img/loij.png"
                                    alt="Card image">
                            </blockquote>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                href="javascript:history.back()"> Volver</a>
                            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                href="javascript:history.back()"> Regresar</a>
                        </div>

                    </div>

                    <div class="col-12 text-center">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        <h2> Evaluaciones Registradas Órganos/Entes</h2>
                    </div>
                    <div class="panel panel-inverse">
                        <div class="panel-heading"></div>
                        <form method="GET" action="<?php echo base_url('index.php/Evaluacion_desempenio/reporte/') ?>"
                            class="mb-3">

                            <div class="input-group">

                                <input type="text" name="search" class="form-control" placeholder="Buscar..."
                                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">

                                <div class="input-group-append">

                                    <button class="btn btn-primary" type="submit">Buscar</button>

                                </div>

                            </div>

                        </form>
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr style="text-align:center">
                                        <th>ID</th>
                                        <th>Fecha Reg. Evaluación</th>
                                        <th>Rif de Contratante:</th>
                                        <th>Razón Social Contratante</th>
                                        <th>Rif contratista</th>
                                        <th>Razón Social contratista</th>
                                        <th>Calificación</th>
                                        <!-- <th>Estatus de Notificación</th> -->
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($reportes)): ?>
                                    <?php foreach ($reportes as $data): ?>
                                    <tr style="text-align:center">
                                        <td><?=$data['id']?> </td>
                                        <td><?=$data['fecha_reg_eval']?> </td>
                                        <td><?=$data['rif_organoente']?> </td>
                                        <td><?=$data['organo_ente']?> </td>
                                        <td><?=$data['rif_contrat']?> </td>
                                        <td><?=$data['contratista_ev']?> </td>
                                        <td><?=$data['calificacion']?></td>
                                        <td class="center">
                                            <a title="Visualizar e Imprimir la Evaluación de Desempeño"
                                                href="<?php echo base_url();?>index.php/Evaluacion_desempenio/ver_evaluacion?id=<?php echo $data['id'];?>"
                                                class="button">
                                                <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                                <a />
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="4" style="text-align:center;">No hay registros disponibles.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- Paginación -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <?php
        $limit = 10; // Número de registros por página
        $total_pages = ceil($total_rows / $limit); // Total de páginas
        $current_page = ($this->uri->segment(2) ? (int)$this->uri->segment(2) / $limit : 0); // Página actual

        // Enlace a la página anterior
        if ($current_page > 0): ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="<?php echo base_url('index.php/Evaluacion_desempenio/reporte/'. (($current_page - 1) * $limit)) ?>">«
                                            Anterior</a>
                                    </li>
                                    <?php endif; ?>

                                    <!-- Mostrar páginas del 1 al 5 -->
                                    <?php for ($i = 0; $i < min(10, $total_pages); $i++): ?>
                                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                        <a class="page-link"
                                            href="<?php echo base_url('index.php/Evaluacion_desempenio/reporte/'. ($i * $limit)) ?>">
                                            <?= $i + 1 ?>
                                        </a>
                                    </li>
                                    <?php endfor; ?>

                                    <!-- Enlace a la página siguiente si hay más de 5 páginas -->
                                    <?php if ($total_pages > 10): ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="<?php echo base_url('index.php/Evaluacion_desempenio/reporte/'. (5 * $limit)) ?>">Siguiente
                                            »</a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>


            </div>


















        </div>
    </section>
</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
    integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous">
</script>

<script src="<?=base_url()?>/js/eval_desempenio/notificacion.js"></script>


</html>
<?php if (!$this->session->userdata('session')) { ?>
<style>
.content {
    margin-left: 0;
}
</style>
<?php } ?>