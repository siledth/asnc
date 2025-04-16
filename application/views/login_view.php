<body class="hold-transition login-page fondo">
    <div class="login-box r">
        <div class="card r">
            <div class="card-body r login-card-body">
                <div class="login-logo text-center">
                    <a href="https://www.snc.gob.ve/" target="_blank">
                        <img class="img" src="<?php echo base_url('baner/logo2.png'); ?>" alt="Logo SNC">
                    </a>
                </div>
                <h2 class="login-box-msg ">Sistema Integrado SNC</h2>
                <h5 class="login-box-msg ">Ingrese con sus datos para iniciar sesión</h5>
                <form class="form form-register" form action="<?php echo site_url('Login/autenticar'); ?>" method="post"
                    novalidate>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Nombre Usuario">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/recuperar'"
                            class="btn btn-grey btn-lg"
                            style="background: none; border: none; color: #0000EE; text-decoration: underline; cursor: pointer;">
                            ¿Olvidaste tu clave?
                        </button>
                        <div class="col-6 center">


                            <button class="btn btn-success btn-block" type="submit">Ingresar</button>
                            <?php if (isset($error)): ?>
                            <div style="color: red;"><?php echo $error; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-info btn-block r"
                            onclick="location.href='<?php echo base_url() ?>index.php/llamadoxterno'">
                            <a style="color: white;" class="text-center">Llamados a Concursos</a>
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-info btn-block r"
                            onclick="location.href='<?php echo base_url() ?>index.php/solicitud'"
                            style="color: white;">Gestión
                            de Usuarios
                        </button>
                    </div>


                </div>

            </div>
        </div>
    </div>
</body>