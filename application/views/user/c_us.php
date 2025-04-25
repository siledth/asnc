<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Usuarios</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">

                            <div class=" col-12 form-group">
                                <label>Seleccione Organo/Ente <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <select id="id_unidad" name="id_unidad" class="default-select2 form-control" required>
                                    <option value="0">Seleccione</option>

                                    <?php foreach ($final as $data): ?>
                                    <option value="<?= $data['codigo'] ?>/<?= $data['rif'] ?>">
                                        <?= $data['descripcion'] ?> /
                                        <?= $data['rif'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" nid="perfil" name="perfil" value="0" class="form-control">

                            </div>
                            <div class="form-group col-6">
                                <label>Nombre completo <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="nombrefun" name="nombrefun" onkeyup="mayusculas(this);"
                                    maxlength="50" class="form-control" placeholder="Nombre completo">

                            </div>
                            <div class="form-group col-6">
                                <label>Apellido Completo <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="apellido" name="apellido" onkeyup="mayusculas(this);"
                                    maxlength="50" class="form-control" placeholder="Nombre completo">

                            </div>
                            <div class="form-group col-1">
                                <label> </label>
                                <input type="text" class="form-control" id="tipo_ced" name="tipo_ced" value="V"
                                    readonly />
                            </div>
                            <div class="form-group col-3">
                                <label>Cédula de Identidad <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="cedula" name="cedula" maxlength="8" onblur="validateUsers();"
                                    placeholder="ingrese la Cédula sin punto ni coma" class="form-control" />
                                <div id="result-cedula"></div>
                            </div>
                            <div class="form-group col-2">
                                <label>Cargo <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="cargo" name="cargo" placeholder="Cargo"
                                    onkeyup="mayusculas(this);" maxlength="50" class="form-control" />


                            </div>
                            <div class="form-group col-2">
                                <label>Teléfono <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="tele_1" name="tele_1" placeholder="Teléfono 1" maxlength="20"
                                    class="form-control" />

                            </div>
                            <div class="form-group col-2">
                                <label>Teléfono 2 <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="tele_2" name="tele_2" placeholder="Teléfono 2" maxlength="20"
                                    class="form-control" />

                            </div>
                            <div class="form-group col-2">
                                <label>Oficina <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="oficina" name="oficina" placeholder="oficina" maxlength="20"
                                    onkeyup="mayusculas(this);" class="form-control " />

                            </div>
                            <div class="form-group col-2">
                                <label>Fecha de Designación/fecha solicitud <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="date" id="fecha_designacion" name="fecha_designacion"
                                    class="form-control" />

                            </div>
                            <div class="form-group col-4">
                                <label>Número de la Gaceta o la Resolución/número de oficion Solicitud: <b
                                        title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="numero_gaceta" name="numero_gaceta" placeholder="Número gaceta"
                                    onkeyup="mayusculas(this);" maxlength="50" class="form-control" />

                            </div>
                            <div class="form-group col-5">
                                <label>Observaciones: <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="obser" name="obser" placeholder="Observaciones" maxlength="10"
                                    onkeyup="mayusculas(this);" class="form-control " />

                            </div>

                            <div class="form-group col-6">
                                <label>Correo Institucional <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="email" name="email" maxlength="100"
                                    onblur="return validateEmail()" class="form-control " aria-describedby="emailHelp"
                                    placeholder="Correo eléctronico">
                                <div id="result-email"></div>

                            </div>
                            <div class="form-group col-6">
                                <label>Ingrese Un Usuario <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" name="usuario" id="usuario" class="form-control " readonly
                                    placeholder="usuario completo">
                                <div id="result-usuario"></div>


                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputPassword1">Contraseña <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Contraseña">

                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputPassword1">Repite la contraseña <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="password" name="repeatPassord" id="repeatPassord" class="form-control "
                                    placeholder="Contraseña">

                            </div>

                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_b();" id="guardar_user" name="guardar_user"
                            class="my-button">Guardar</button>
                    </div>
                    </from>
            </div>


        </div>
    </div>


    <script src="<?= base_url() ?>/js/usuario/user.js">



    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        // Función para capitalizar la primera letra
        function capitalizar(str) {
            return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
        }

        // Función para generar nombres de usuario
        function generarUsuario(nombre, apellido) {
            let nombres = nombre.split(' ');
            let apellidos = apellido.split(' ');

            // Primera letra del primer nombre + primer apellido completo
            let primeraOpcion = capitalizar(nombres[0].charAt(0).toLowerCase() + apellidos[0].toLowerCase());

            // Primera letra del primer nombre + primer apellido + primera letra segundo apellido
            let segundaOpcion = apellidos.length > 1 ?
                capitalizar(nombres[0].charAt(0).toLowerCase() + apellidos[0].toLowerCase() + apellidos[1]
                    .charAt(0).toLowerCase()) :
                primeraOpcion;

            return [primeraOpcion, segundaOpcion];
        }

        // Cuando se llenen nombre y apellido, generar usuario
        $('#nombrefun, #apellido').on('blur', function() {
            let nombre = $('#nombrefun').val().trim();
            let apellido = $('#apellido').val().trim();

            if (nombre && apellido) {
                // Generar opciones de usuario
                let opciones = generarUsuario(nombre, apellido);

                // Verificar disponibilidad
                verificarDisponibilidad(opciones, 0);
            }
        });

        // Función recursiva para verificar disponibilidad
        function verificarDisponibilidad(opciones, index, contador = 1) {
            if (index >= opciones.length) {
                // Si no hay más opciones, probar con número
                let ultimaOpcion = opciones[opciones.length - 1] + contador;
                verificarUsuario(ultimaOpcion, function(disponible) {
                    if (disponible) {
                        $('#usuario').val(ultimaOpcion);
                        $('#result-usuario').fadeIn(1600).html(
                            '<div class="alert alert-success"><strong>Bien!</strong> Usuario disponible.</div>'
                        );
                        $("#guardar_user").prop('disabled', false);
                    } else {
                        verificarDisponibilidad(opciones, index, contador + 1);
                    }
                });
                return;
            }

            verificarUsuario(opciones[index], function(disponible) {
                if (disponible) {
                    $('#usuario').val(opciones[index]);
                    $('#result-usuario').fadeIn(1600).html(
                        '<div class="alert alert-success"><strong>Bien!</strong> Usuario disponible.</div>'
                    );
                    $("#guardar_user").prop('disabled', false);
                } else {
                    verificarDisponibilidad(opciones, index + 1);
                }
            });
        }

        // Función para verificar un usuario específico
        function verificarUsuario(usuario, callback) {
            // var base_url = window.location.origin + '/asnc/index.php/User/validad_users'
            var base_url = '/index.php/User/validad_users';
            $.ajax({
                type: "POST",
                url: base_url,
                data: {
                    usuario: usuario
                },
                success: function(data) {
                    callback(data == 0);
                },
                error: function() {
                    callback(false);
                }
            });
        }

        // Mantener la validación original cuando el usuario edita manualmente
        $('#usuario').on('blur', function() {
            if ($(this).val().trim() === '') return;

            // Capitalizar la primera letra si el usuario escribe manualmente
            let usuario = capitalizar($(this).val());
            $(this).val(usuario);

            $('#result-usuario').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>')
                .fadeOut(1000);

            var dataString = 'usuario=' + usuario;
            var no = 0;
            // var base_url = window.location.origin + '/asnc/index.php/User/validad_users'
            var base_url = '/index.php/User/validad_users';
            $.ajax({
                type: "POST",
                url: base_url,
                data: dataString,
                success: function(data) {
                    if (data == no) {
                        $('#result-usuario').fadeIn(1600).html(
                            '<div class="alert alert-success"><strong>Bien!</strong> Usuario disponible.</div>'
                        );
                        $("#guardar_user").prop('disabled', false)
                    } else {
                        $('#result-usuario').fadeIn(1600).html(
                            '<div class="alert alert-danger"><strong>Usuario ya Registrado!</strong> Ingrese otro Usuario.</div>'
                        );
                        $("#guardar_user").prop('disabled', true)
                    }
                }
            });
        });
    });
    // $(document).ready(function() {
    //     $('#usuario').on('blur', function() {
    //         // url(http://localhost/asnc/Plantilla/img/images.jpeg);
    //         $('#result-usuario').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>')
    //             .fadeOut(1000);

    //         var usuario = $(this).val();
    //         var dataString = 'usuario=' + usuario;
    //         var no = 0;

    //         // var base_url = window.location.origin + '/asnc/index.php/Login/validad_correo'
    //         var base_url = '/index.php/User/validad_users';
    //         $.ajax({
    //             type: "POST",
    //             url: base_url,
    //             data: dataString,
    //             success: function(data) {
    //                 // console.log(data);
    //                 if (data == no) {
    //                     $('#result-usuario').fadeIn(1600).html(
    //                         '<div class="alert alert-success"><strong>Bien!</strong> Usuario disponible.</div>'
    //                     );
    //                     $("#guardar_user").prop('disabled', false)

    //                 } else {
    //                     $('#result-usuario').fadeIn(1600).html(
    //                         '<div class="alert alert-danger"><strong>Usuario ya Registrado!</strong> Ingrese otro Usuario.</div>'
    //                     );
    //                     $("#guardar_user").prop('disabled', true)

    //                 }
    //             }
    //         });
    //     });
    // });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#email').on('blur', function() {
            // url(http://localhost/asnc/Plantilla/img/images.jpeg);
            $('#result-email').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>')
                .fadeOut(1000);
            var no = 0;
            var email = $(this).val();
            var dataString = 'email=' + email;
            // var base_url = window.location.origin + '/asnc/index.php/Login/validad_correo'
            var base_url = '/index.php/User/validad_correo1';
            $.ajax({
                type: "POST",
                url: base_url,
                data: dataString,
                success: function(data) {
                    // console.log(data);
                    if (data == no) {
                        $('#result-email').fadeIn(1600).html(
                            '<div class="alert alert-success"><strong>Bien!</strong> Correo disponible.</div>'
                        );
                        $("#guardar_user").prop('disabled', false)

                    } else {
                        $('#result-email').fadeIn(1600).html(
                            '<div class="alert alert-danger"><strong>Correo ya Registrado!</strong> Ingrese otro Correo.</div>'
                        );
                        $("#guardar_user").prop('disabled', true)

                    }





                }
            });
        });
    });
    </script>