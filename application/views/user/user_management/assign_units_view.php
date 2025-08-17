<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Unidades a Usuario</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-save {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Asignar Unidades Adicionales a Usuario</h2>
        <form id="assignUnitsForm">
            <div class="form-group">
                <label for="userSelect">Seleccionar Usuario:</label>
                <select id="userSelect" name="id_usuario" class="form-control" required>
                    <option value="">-- Seleccione un usuario --</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id'] ?>"><?= $usuario['nombre'] ?> (<?= $usuario['email'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="unitsSelect">Seleccionar Unidades (RIF / Código):</label>
                <select id="unitsSelect" name="unidades[]" class="form-control" multiple="multiple" required>
                    <?php foreach ($organos_entes as $oe): ?>
                        <option value="<?= $oe['rif'] . '/' . $oe['codigo'] ?>">
                            <?= $oe['descripcion'] ?> (<?= $oe['rif'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-save">Guardar Asignaciones</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('#userSelect').select2();
            $('#unitsSelect').select2();

            $('#assignUnitsForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                $.ajax({
                    url: "<?= base_url('index.php/User_management_controller/assign_additional_units') ?>",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Éxito', response.message, 'success');
                            $('#assignUnitsForm')[0].reset();
                            $('#userSelect').val(null).trigger('change');
                            $('#unitsSelect').val(null).trigger('change');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Ocurrió un error en la conexión. Intente de nuevo.',
                            'error');
                    }
                });
            });
        });
    </script>
</body>

</html>