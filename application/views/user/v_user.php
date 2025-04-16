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
                <h5 class="login-box-msg ">Su usuario es :</h5>
                <form class="form form-register" id="validarUsuarioForm" novalidate>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">

                                <input type="text" name="id_usuario" value="<?= $id_usuario ?>" disabled
                                    class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mb-4">

                        <div class="col-6 center">

                            <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/login1'"
                                class="btn btn-success btn-block">Continuar</button>



                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <script>
    // Redireccionar después de 1 minuto (60000 milisegundos)
    setTimeout(function() {
        window.location.href = "<?= base_url() ?>index.php/login1";
    }, 60000);
    </script>
</body>