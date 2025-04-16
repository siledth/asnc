<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url() ?>Plantilla/img/favicon.ico" type="image/vnd.microsoft.icon" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= base_url() ?>css/style1.css" rel="stylesheet" rel="stylesheet" type="text/css">

    <!-- Cargar jQuery desde un CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?=base_url()?>js/usuario/edpass.js"></script>
    <script>
    $(function() {
        $('.password-toggle').click(function() {
            const input = $(this).closest('.input-group').find('input[type="password"]');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).addClass('collapsed');
            } else {
                input.attr('type', 'password');
                $(this).removeClass('collapsed');
            }
        });
    });
    </script>
    <title> Recuperar Acceso</title>
</head>

<body style="background-image: url('<?php echo base_url('baner/123456.jpg'); ?>');">
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenidos</h2>
                <p>Inicia Sesión ingresando con sus datos</p>
                <!-- <input type="button" value="Iniciar Sesión" id="sign-in"> -->
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <div class="login-logo">
                    <a href="https://www.snc.gob.ve/" target="_blank">
                        <img class="img" src="<?php echo base_url('baner/logo2.png'); ?>" alt="">
                    </a>
                </div>


                <form class="form form-register" id="camb_clave" method="post" novalidate>
                    <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <div>
                        <label>Nueva Contraseña
                            <i class='bx bx-lock-alt'></i>
                            <input id="clave" name="clave" type="password" class="form-control" required>

                        </label>
                    </div>

                    <div>
                        <label>Confirmar Contraseña
                            <i class='bx bx-lock-alt'></i>
                            <input id="c_clave" name="c_clave" type="password" class="form-control" required>
                        </label>
                    </div>

                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="camb_clave();" class="my-button5">Cambiar
                            Contraseña</button>
                    </div>
                </form>

                <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/login1'"
                    class="my-button5">
                    Cancelar
                </button>



            </div>
        </div>
    </div>



    <!-- <script src="js/script.js"></script> -->

</body>

</html>