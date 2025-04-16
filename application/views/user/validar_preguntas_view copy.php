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

    <title> Preguntas</title>
</head>

<body style="background-image: url('<?php echo base_url('baner/123456.jpg'); ?>');">
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenidos</h2>
                <p>Gestión de usuarios</p>
                <p>Preguntas de Seguridad</p>

            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <div class="login-logo">
                    <a href="https://www.snc.gob.ve/" target="_blank">
                        <img class="img" src="<?php echo base_url('baner/logo2.png'); ?>" alt="">
                    </a>
                </div>

                <form class="form form-register" id="validarPreguntasForm" novalidate>
                    <div>
                        <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                        <?php foreach ($preguntas as $pregunta): ?>
                        <div>
                            <label for="username"><?= $pregunta->despregunta ?> <i class='bx bx-notepad'></i>
                                <input type="text" id="username" placeholder="Ingrese su respuesta"
                                    name="respuestas[<?= $pregunta->id_despregunta ?>]" required>
                            </label>
                        </div>
                        <?php endforeach; ?>
                        <button type="button" onclick="validarPreguntas()" class="my-button5">Validar</button>
                    </div>

                    <!-- <input type="submit" value="Continuar"> -->
                </form>
                <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/login1'"
                    class="my-button5">
                    Cancelar
                </button>
                <div class="icons">



                </div>
            </div>
        </div>
    </div>

    <script>
    function validarPreguntas() {
        const inputs = document.querySelectorAll('input[name^="respuestas"]');
        let isValid = true;

        // Validar cada campo de respuesta
        inputs.forEach(input => {
            const value = input.value.trim();

            // Nueva expresión regular: solo letras básicas (A-Z, a-z) y espacios
            if (!/^[a-zA-Z\s]+$/.test(value)) {
                isValid = false;
                input.style.border = '1px solid red'; // Resaltar campo inválido
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las respuestas solo deben contener letras.',
                    confirmButtonText: 'Entendido'
                }).then(() => {
                    input.focus(); // Enfocar el campo con error
                });
            } else {
                input.style.border = ''; // Restablecer borde si es válido
            }
        });

        if (!isValid) {
            return; // Detener el envío si hay errores
        }

        // Resto del código (envío del formulario)...
        const formData = new FormData(document.getElementById('validarPreguntasForm'));
        fetch('<?= base_url() ?>index.php/Validacion_controller/validar_respuestas', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        text: data.message,
                        confirmButtonText: 'Continuar'
                    }).then(() => {
                        window.location.href =
                            "<?= base_url() ?>index.php/Validacion_controller/modificar_clave?token=" + data
                            .token;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Atención',
                        text: data.message,
                        confirmButtonText: 'Entendido'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al validar las respuestas.',
                    confirmButtonText: 'Entendido'
                });
            });
    }
    </script>
</body>

</html>