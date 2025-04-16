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
                        <label>Nombre de usuario
                            <i class='bx bx-user'></i>
                            <input type="text" placeholder="Nombre Usuario" id="username" name="username" required>
                        </label>
                    </div>



                    <input type="submit" value="Continuar">
                </form>

                <div>
                    <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/re_user'"
                        class="btn btn-grey btn-lg"
                        style="background: none; border: none; color: #0000EE; text-decoration: underline; cursor: pointer;">
                        ¿Olvidaste tu usuario?
                    </button>
                    <!-- <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/solicitud'"
                        class="btn btn-grey btn-lg">CANCELAR</button> -->
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('validarUsuarioForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario
        validarUsuario(); // Llamar a la función de validación
    });

    function validarUsuario() {
        const username = document.getElementById('username').value.trim(); // Eliminar espacios en blanco

        // Validar que el campo no esté vacío
        if (username === "") {
            Swal.fire({
                icon: 'error',
                title: 'Upss!',
                text: 'El campo Nombre de Usuario es obligatorio.',
                timer: 2000, // Mostrar el mensaje durante 5 segundos
                timerProgressBar: true, // Mostrar una barra de progreso
                showConfirmButton: false // Ocultar el botón de confirmación
            }).then((result) => {
                // Recargar la vista después de que el mensaje desaparezca
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
            });
            document.getElementById('username').focus(); // Enfocar el campo
            return; // Detener la ejecución
        }

        // Si el campo no está vacío, continuar con la solicitud
        fetch('<?= base_url() ?>index.php/Validacion_controller/validar_usuario', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    username: username
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirigir a la vista de preguntas de seguridad
                    window.location.href = "<?= base_url() ?>index.php/Validacion_controller/mostrar_preguntas/" +
                        data.id_usuario;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        timer: 5000, // Mostrar el mensaje durante 5 segundos
                        timerProgressBar: true, // Mostrar una barra de progreso
                        showConfirmButton: false // Ocultar el botón de confirmación
                    }).then((result) => {
                        // Recargar la vista después de que el mensaje desaparezca
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al procesar la solicitud.',
                    timer: 5000, // Mostrar el mensaje durante 5 segundos
                    timerProgressBar: true, // Mostrar una barra de progreso
                    showConfirmButton: false // Ocultar el botón de confirmación
                }).then((result) => {
                    // Recargar la vista después de que el mensaje desaparezca
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }
                });
            });
    }
    </script>
</body>

</html>