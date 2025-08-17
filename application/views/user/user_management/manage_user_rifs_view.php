<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar RIFs de Usuario</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #28a745;
        }

        /* Color verde para activo */
        input:checked+.slider:before {
            transform: translateX(26px);
        }

        .slider.inactive {
            background-color: #dc3545;
        }

        /* Color rojo para inactivo */
    </style>
</head>

<body>
    <div class="container">
        <h2>Gestionar Acceso de Órgano/Ente a Usuario</h2>
        <div class="form-group">
            <label for="userSelect">Seleccionar Usuario:</label>
            <select id="userSelect" name="id_usuario" class="form-control" required>
                <option value="">-- Seleccione un usuario --</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>"><?= $usuario['nombre'] ?> (<?= $usuario['email'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="rifsTableContainer" style="display: none;">
            <h4>RIFs asignados</h4>
            <table id="rifsTable">
                <thead>
                    <tr>
                        <th>RIF Órgano/Ente</th>
                        <th>Unidad</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody id="rifsTableBody">
                    <!-- Los RIFs se cargarán aquí -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#userSelect').select2();

            $('#userSelect').on('change', function() {
                const userId = $(this).val();
                if (userId) {
                    loadUserRifs(userId);
                } else {
                    $('#rifsTableContainer').hide();
                    $('#rifsTableBody').empty();
                }
            });

            function loadUserRifs(userId) {
                $.ajax({
                    url: "<?= base_url('index.php/User_management_controller/get_user_rifs') ?>",
                    method: "POST",
                    data: {
                        id_usuario: userId
                    },
                    dataType: "json",
                    success: function(response) {
                        const tableBody = $('#rifsTableBody');
                        tableBody.empty();
                        if (response.success && response.rifs.length > 0) {
                            response.rifs.forEach(function(rif) {
                                const is_active = rif.status == 1;
                                const slider_class = is_active ? '' : 'inactive';
                                const row = `
                                    <tr>
                                        <td>${rif.rif_organoente}</td>
                                        <td>${rif.unidad}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status-toggle" data-user-id="${rif.id_usuario}" data-rif="${rif.rif_organoente}" ${is_active ? 'checked' : ''}>
                                                <span class="slider ${slider_class}"></span>
                                            </label>
                                        </td>
                                    </tr>
                                `;
                                tableBody.append(row);
                            });
                            $('#rifsTableContainer').show();
                        } else {
                            tableBody.append(
                                `<tr><td colspan="3">No se encontraron RIFs adicionales para este usuario.</td></tr>`
                            );
                            $('#rifsTableContainer').show();
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudieron cargar los RIFs del usuario.', 'error');
                    }
                });
            }

            // Evento para el toggle de estatus
            $('body').on('change', '.status-toggle', function() {
                const userId = $(this).data('user-id');
                const rif = $(this).data('rif');
                const is_checked = $(this).is(':checked');
                const new_status = is_checked ? 1 : 0;

                $.ajax({
                    url: "<?= base_url('index.php/User_management_controller/update_rif_status') ?>",
                    method: "POST",
                    data: {
                        id_usuario: userId,
                        rif_organoente: rif,
                        status: new_status
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Éxito', response.message, 'success');
                            const slider = $(this).next('.slider');
                            if (new_status == 1) {
                                slider.removeClass('inactive');
                            } else {
                                slider.addClass('inactive');
                            }
                        } else {
                            Swal.fire('Error', response.message, 'error');
                            $(this).prop('checked', !is_checked); // Revertir el toggle
                        }
                    }.bind(this), // Usar .bind(this) para mantener el contexto
                    error: function() {
                        Swal.fire('Error', 'Ocurrió un error al actualizar el estado.',
                            'error');
                        $(this).prop('checked', !is_checked); // Revertir el toggle
                    }.bind(this)
                });
            });
        });
    </script>
</body>

</html>