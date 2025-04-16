<!-- application/views/llamado_concurso_view.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Llamado Concurso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Llamado Concurso</h1>
        <form method="get" action="<?php echo base_url('llamado_concurso/index'); ?>">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar..."
                    value="<?php echo $this->input->get('search'); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>RIF Organoente</th>
                    <th>Número Proceso</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row->rif_organoente; ?></td>
                    <td><?php echo $row->numero_proceso; ?></td>
                    <td><?php echo $row->estatus; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $pagination; ?>
    </div>
</body>

</html>