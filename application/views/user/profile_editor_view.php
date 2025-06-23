<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de Usuario</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <link href="<?= base_url('css/profile.css') ?>" rel="stylesheet">


</head>

<body>

    <div class="container">
        <h1>Gestión de Usuario</h1>

        <div class="filter-section">
            <div class="filter-group">
                <label for="filterUserName">Buscar por Nombre de Usuario:</label>
                <input type="text" id="filterUserName">
            </div>
            <div class="filter-group">
                <label for="filterCedula">Buscar por Cédula:</label>
                <input type="text" id="filterCedula" placeholder="Ej: V12345678">
            </div>
            <div class="filter-group">
                <label for="filterOrganoEnte">Buscar por RIF o Nombre de Órgano/Ente:</label>
                <input type="text" id="filterOrganoEnte" placeholder="Ej: J000000000 o Nombre del Organo/Ente">
            </div>
            <div class="filter-buttons">
                <button id="applyFiltersBtn" class="btn-apply">Aplicar Filtros</button>
                <button id="clearFiltersBtn" class="btn-clear">Limpiar Filtros</button>
            </div>
        </div>

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Cédula</th>
                    <th>Perfil Asignado</th>
                    <th>Organo/Ente</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <tr>
                    <td colspan="7" style="text-align: center;">Cargando usuarios...</td>
                </tr>
            </tbody>
        </table>

        <div class="pagination-section">
            <button id="loadMoreUsersBtn">Cargar Más Usuarios</button>
        </div>
    </div>

    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Editar Usuario</h2>
            <form id="profileEditForm">
                <input type="hidden" id="editUserId" name="user_id">

                <div class="form-group">
                    <label for="userName">Nombre de Usuario:</label>
                    <input type="text" id="userName" name="new_nombre" readonly>
                </div>
                <div class="form-group">
                    <label for="usernombrefun">Nombres (Funcionario):</label>
                    <input type="text" id="usernombrefun" name="new_nombrefun">
                </div>

                <div class="form-group">
                    <label for="userApellido">Apellido:</label>
                    <input type="text" id="userApellido" name="new_apellido">
                </div>

                <div class="form-group">
                    <label for="userCedulaTipo">Cédula:</label>
                    <div class="cedula-group">
                        <select id="userCedulaTipo" name="new_cedula_tipo">
                            <option value="V">V</option>
                            <option value="E">E</option>
                            <option value="P">P</option>
                        </select>
                        <input type="text" id="userCedulaNum" name="new_cedula_num" placeholder="Número de cédula">
                    </div>
                </div>

                <div class="form-group">
                    <label for="userEmail">Email:</label>
                    <input type="email" id="userEmail" name="new_email">
                </div>

                <div class="form-group">
                    <label for="userCargo">Cargo:</label>
                    <input type="text" id="userCargo" name="new_cargo">
                </div>

                <div class="form-group">
                    <label for="userOficina">Oficina:</label>
                    <input type="text" id="userOficina" name="new_oficina">
                </div>

                <div class="form-group">
                    <label for="userTele1">Teléfono Principal:</label>
                    <input type="text" id="userTele1" name="new_tele_1" placeholder="Ej: 04XX-XXXXXXX">
                </div>

                <div class="form-group">
                    <label for="profileSelect">Perfil Asignado:</label>
                    <select id="profileSelect" name="new_profile_id">
                    </select>
                </div>

                <div class="permissions-section">
                    <h3>Permisos del Usuario Seleccionado</h3>
                    <div id="permissionsGrid" class="permissions-grid">
                    </div>
                </div>

                <div class="modal-buttons">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-save">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.usersPerPage = <?php echo $per_page; ?>;
        window.totalUsersCount = <?php echo $total_users; ?>;
    </script>

    <script src="<?= base_url() ?>/js/usuario/profile_edit.js"></script>

</body>

</html>