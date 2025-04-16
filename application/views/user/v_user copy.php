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
    <!-- Cargar SweetAlert2 desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title> INGRESE USUARIO</title>
</head>

<body style="background-image: url('<?php echo base_url('baner/123456.jpg'); ?>');">
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenidos</h2>
                <p>Gestión de usuarios</p>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <div class="login-logo">
                    <a href="https://www.snc.gob.ve/" target="_blank">
                        <img class="img" src="<?php echo base_url('baner/logo2.png'); ?>" alt="">
                    </a>
                </div>

                <form class="form form-register" id="validarUsuarioForm" novalidate>
                    <div>
                        <label for="username">Usuario
                            <i class='bx bx-user'></i>
                            <input type="text" name="id_usuario" value="<?= $id_usuario ?>" disabled>
                        </label>
                    </div>
                    <br>
                    <br>

                </form>

                <div class="icons">
                    <!-- <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/re_user'"
                        class="btn btn-grey btn-lg"
                        style="background: none; border: none; color: #0000EE; text-decoration: underline; cursor: pointer;">
                        ¿Olvidaste tu usuario?
                    </button> -->
                    <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/login1'"
                        class="btn btn-grey btn-lg">Continuar</button>
                </div>
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

</html>