<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de Perfiles de Usuario</title>
    <!-- 1. Incluye jQuery (siempre primero) -->

    <!-- 2. Incluye jQuery UI (después de jQuery, antes de scripts que lo usen) -->
    <!-- Este es el script que probablemente te falta o está mal ubicado -->
    <script
        src="[https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js](https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js)">
    </script>
    <!-- Si tienes un CSS para jQuery UI, también lo incluirías aquí, por ejemplo:
    <link rel="stylesheet" href="[https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css](https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css)">
    -->
    <!-- 3. Incluye SweetAlert2 -->
    <script src="[https://cdn.jsdelivr.net/npm/sweetalert2@11](https://cdn.jsdelivr.net/npm/sweetalert2@11)"></script>

    <!-- Tus otros scripts de la plantilla, como apps.min.js o tag-it.min.js,
         deberían cargarse *después* de jQuery UI si dependen de él.
         Si tus archivos de plantilla ya están cargados, asegúrate de que sea después de jQuery UI.
    -->
    <!-- Ejemplo (ajusta las rutas a tu proyecto):
    <script src="http://localhost/asnc/Plantilla/admin/assets/js/tag-it.min.js"></script>
    <script src="http://localhost/asnc/Plantilla/admin/assets/js/apps.min.js"></script>
    -->

    <style>
        /* Mantenemos los estilos CSS en línea por simplicidad, puedes moverlos a un archivo .css */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        h1 {
            text-align: center;
            color: #1a202c;
            margin-bottom: 30px;
            font-size: 2.2em;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .user-table th,
        .user-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .user-table th {
            background-color: #e8f0fe;
            color: #2c5282;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .user-table tr:hover {
            background-color: #f5f8ff;
        }

        .user-table td {
            background-color: #ffffff;
            font-size: 0.95em;
        }

        .user-table button {
            background-color: #4299e1;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.85em;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 5px rgba(66, 153, 225, 0.3);
        }

        .user-table button:hover {
            background-color: #3182ce;
            transform: translateY(-2px);
        }

        .user-table button:active {
            transform: translateY(0);
            box-shadow: none;
        }

        /* Estilos del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.3s forwards;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            border: 1px solid #888;
            width: 90%;
            max-width: 700px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: slideIn 0.3s forwards;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            line-height: 20px;
            margin-top: -10px;
            margin-right: -10px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .close-button:hover,
        .close-button:focus {
            color: #555;
            text-decoration: none;
            cursor: pointer;
        }

        .modal h2 {
            text-align: center;
            color: #1a202c;
            margin-bottom: 25px;
            font-size: 1.8em;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select {
            width: calc(100% - 22px);
            padding: 12px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group select:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.3);
            outline: none;
        }

        .form-group input[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        .permissions-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .permissions-section h3 {
            color: #1a202c;
            margin-bottom: 15px;
            font-size: 1.4em;
            text-align: center;
        }

        .permissions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .permission-item {
            background-color: #f7fafc;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .permission-item label {
            margin-bottom: 0;
            font-weight: normal;
            color: #4a5568;
            font-size: 0.9em;
            cursor: pointer;
        }

        /* Estilo para el switch (toggle) */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 22px;
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
            border-radius: 22px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #4299e1;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #4299e1;
        }

        input:checked+.slider:before {
            transform: translateX(18px);
        }

        /* Botones del modal */
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .modal-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .modal-buttons .btn-save {
            background-color: #48bb78;
            color: white;
            box-shadow: 0 2px 5px rgba(72, 187, 120, 0.3);
        }

        .modal-buttons .btn-save:hover {
            background-color: #38a169;
            transform: translateY(-2px);
        }

        .modal-buttons .btn-cancel {
            background-color: #e2e8f0;
            color: #4a5568;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .modal-buttons .btn-cancel:hover {
            background-color: #cbd5e0;
            transform: translateY(-2px);
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Media queries para responsividad */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin: 10px auto;
            }

            .modal-content {
                width: 95%;
                margin: 2% auto;
            }

            .user-table th,
            .user-table td {
                padding: 10px;
                font-size: 0.85em;
            }

            .user-table button {
                padding: 6px 10px;
                font-size: 0.75em;
            }

            .modal h2 {
                font-size: 1.5em;
            }

            .permissions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Gestión de Perfiles de Usuario</h1>

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Perfil Asignado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['nombre']; ?></td>
                            <td><?php echo $user['perfil_nombre']; ?></td>
                            <td>
                                <button class="edit-profile-btn" data-user-id="<?php echo $user['id']; ?>">Editar
                                    Perfil</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- El Modal de Edición de Perfil -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Editar Perfil de Usuario</h2>
            <form id="profileEditForm">
                <input type="hidden" id="editUserId" name="user_id">

                <div class="form-group">
                    <label for="userName">Nombre de Usuario:</label>
                    <input type="text" id="userName" name="nombre" readonly>
                </div>

                <div class="form-group">
                    <label for="userEmail">Email:</label>
                    <input type="email" id="userEmail" name="email" readonly>
                </div>

                <div class="form-group">
                    <label for="profileSelect">Perfil Asignado:</label>
                    <select id="profileSelect" name="new_profile_id">
                        <!-- Las opciones de perfil se cargarán aquí dinámicamente con JS -->
                    </select>
                </div>

                <div class="permissions-section">
                    <h3>Permisos del Perfil Seleccionado</h3>
                    <div id="permissionsGrid" class="permissions-grid">
                        <!-- Los checkboxes de permisos se cargarán aquí dinámicamente con JS -->
                    </div>
                </div>

                <div class="modal-buttons">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-save">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 4. Tu script personalizado (Cárgalo *después* de jQuery y jQuery UI) -->
    <!-- Asegúrate de la ruta correcta a tu archivo JS -->

    <script src="<?= base_url() ?>/js/usuario/profile_edit.js"> </script>


    <!-- O si tu estructura de assets es diferente:
    <script src="http://localhost/asnc/assets/js/profile_edit.js"></script>
    -->


</body>

</html>