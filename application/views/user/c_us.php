<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registros Usuarios</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-3">
                                <label>Perfil <b title="Campo Obligatorio" style="color:red">*</b></label>

                                <select class="default-select2 form-control" id="perfil" name="perfil">
                                    <option value="0">Seleccione</option>

                                    <?php foreach ($ver_perfil as $data): ?>

                                    <option value="<?=$data['id_perfil']?>"><?=$data['nombrep']?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class=" col-6 form-group">
                                <label>Seleccione Organo/Ente <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <select id="id_unidad" name="id_unidad" class="default-select2 form-control" required>
                                    <option value="0">Seleccione</option>

                                    <?php foreach ($final as $data): ?>
                                    <option value="<?=$data['codigo']?>/<?=$data['rif']?>"><?=$data['descripcion']?> /
                                        <?=$data['rif']?></option>
                                    <?php endforeach; ?>
                                </select>

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
                                <label>Fecha de Designación/fecha solicitud <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="date" id="fecha_designacion" name="fecha_designacion"
                                    class="form-control" />

                            </div>
                            <div class="form-group col-4">
                                <label>Número de la Gaceta o la Resolución/número de oficion Solicitud: <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
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
                                <input type="text" name="usuario" id="usuario" class="form-control "
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


    <script src="<?=base_url()?>/js/usuario/user.js">
   


    </script>
   <script type="text/javascript">
        $(document).ready(function() {
            $('#usuario').on('blur', function() {
                // url(http://localhost/asnc/Plantilla/img/images.jpeg);
                $('#result-usuario').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>')
                    .fadeOut(1000);

                var usuario = $(this).val();
                var dataString = 'usuario=' + usuario;
                var no=0;

                // var base_url = window.location.origin + '/asnc/index.php/Login/validad_correo'
                 var base_url = '/index.php/User/validad_users';
                 $.ajax({
                    type: "POST",
                    url: base_url,
                    data: dataString,
                    success: function(data) {
                        // console.log(data);
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
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#email').on('blur', function() {
                // url(http://localhost/asnc/Plantilla/img/images.jpeg);
                $('#result-email').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>')
                    .fadeOut(1000);
                    var no=0;
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