<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= base_url() ?>css/style1.css" rel="stylesheet" rel="stylesheet" type="text/css">


    <title> INICIAR SESIÓN</title>
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


                <form class="form form-register" form action="<?php echo site_url('login/autenticar'); ?>" method="post"
                    novalidate>
                    <div>
                        <label>
                            <i class='bx bx-user'></i>
                            <input type="text" placeholder="Nombre Usuario" name="username" required>
                        </label>
                    </div>

                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Contraseña" name="password" required>
                        </label>
                    </div>

                    <input type="submit" value="Iniciar Sesión">
                    <?php if (isset($error)): ?>
                    <div style="color: red;"><?php echo $error; ?></div>
                    <?php endif; ?>
                </form>

                <div class="icons">
                    <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/llamadoxterno'">Ver
                        Llamados a Concursos</button>

                </div>
                <p>LLamados a Concursos</p>
            </div>
        </div>
    </div>



    <!-- <script src="js/script.js"></script> -->

</body>

</html>