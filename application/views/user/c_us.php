<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>

    <link href="<?= base_url('css/user.css') ?>" rel="stylesheet">

</head>

<body>

    <div class="sidebar-bg"></div>
    <div id="content" class="content">
        <h2>Registro de Usuarios</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                        enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="id_unidad">Seleccione Órgano/Ente <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <select id="id_unidad" name="id_unidad" class="form-control default-select2"
                                        required>
                                        <option value="0">-- Seleccione --</option>
                                        <?php if (!empty($final)): ?>
                                            <?php foreach ($final as $data): ?>
                                                <option value="<?= $data['codigo'] ?>/<?= $data['rif'] ?>">
                                                    <?= $data['descripcion'] ?> /
                                                    <?= $data['rif'] ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="0">No se pudieron cargar Órganos/Entes</option>
                                        <?php endif; ?>
                                    </select>
                                    <input type="hidden" id="perfil" name="perfil" value="0" class="form-control">

                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nombrefun">Nombre Completo <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="text" id="nombrefun" name="nombrefun" onkeyup="mayusculas(this);"
                                        maxlength="50" class="form-control" placeholder="Ingrese el nombre completo"
                                        required>

                                </div>
                                <div class="form-group">
                                    <label for="apellido">Apellido Completo <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="text" id="apellido" name="apellido" onkeyup="mayusculas(this);"
                                        maxlength="50" class="form-control" placeholder="Ingrese el apellido completo"
                                        required>

                                </div>
                                <div class="form-group">
                                    <label for="cedula">Cédula de Identidad <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <div class="cedula-group">
                                        <select class="form-control" id="tipo_ced" name="tipo_ced">
                                            <option value="V">V</option>
                                            <option value="E">E</option>
                                            <option value="P">P</option>
                                        </select>
                                        <input type="text" id="cedula" name="cedula" maxlength="8"
                                            onblur="validateUsers();"
                                            placeholder="Ingrese la Cédula sin puntos ni comas" class="form-control"
                                            required>
                                    </div>
                                    <div id="result-cedula" class="alert"></div>
                                </div>

                                <div class="form-group">
                                    <label for="cargo">Cargo <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="text" id="cargo" name="cargo" placeholder="Cargo"
                                        onkeyup="mayusculas(this);" maxlength="50" class="form-control" required>

                                </div>
                                <div class="form-group">
                                    <label for="oficina">Oficina <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="text" id="oficina" name="oficina" placeholder="Oficina" maxlength="20"
                                        onkeyup="mayusculas(this);" class="form-control" required>

                                </div>
                                <div class="form-group">
                                    <label for="tele_1">Teléfono Principal <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="text" id="tele_1" name="tele_1" placeholder="Ej: 04XX-XXXXXXX"
                                        maxlength="20" class="form-control" required>

                                </div>
                                <div class="form-group">
                                    <label for="tele_2">Teléfono Secundario</label>
                                    <input type="text" id="tele_2" name="tele_2" placeholder="Opcional: 04XX-XXXXXXX"
                                        maxlength="20" class="form-control">

                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="fecha_designacion">Fecha de Designación/Solicitud <b
                                            title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input type="date" id="fecha_designacion" name="fecha_designacion"
                                        class="form-control" required>

                                </div>
                                <div class="form-group">
                                    <label for="numero_gaceta">Número de Gaceta/Resolución/Oficio de Solicitud: <b
                                            title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input type="text" id="numero_gaceta" name="numero_gaceta"
                                        placeholder="Número gaceta/oficio" onkeyup="mayusculas(this);" maxlength="50"
                                        class="form-control" required>

                                </div>
                                <div class="form-group">
                                    <label for="obser">Observaciones: <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <textarea id="obser" name="obser" placeholder="Observaciones adicionales"
                                        maxlength="255" class="form-control" rows="3" required></textarea>

                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="email">Correo Institucional <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="email" id="email" name="email" maxlength="100" onblur="validateEmail()"
                                        class="form-control" placeholder="Correo electrónico" required>
                                    <div id="result-email" class="alert"></div>

                                </div>
                                <div class="form-group">
                                    <label for="usuario">Ingrese Un Usuario <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="text" name="usuario" id="usuario" class="form-control"
                                        placeholder="Usuario para iniciar sesión" readonly required>
                                    <div id="result-usuario" class="alert"></div>

                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Contraseña" required>

                                </div>
                                <div class="form-group">
                                    <label for="repeatPassord">Repite la Contraseña <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="password" name="repeatPassord" id="repeatPassord" class="form-control"
                                        placeholder="Repite la contraseña" required>

                                </div>
                            </div>

                        </div>
                        <div class="form-group col 12 text-center button-group">
                            <button type="button" class="btn-cancel" onclick="location.reload();">Cancelar</button>
                            <button type="submit" id="guardar_user" name="guardar_user" class="btn-save">Registrar
                                Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('/js/usuario/user.js'); ?>"></script>

</body>

</html>