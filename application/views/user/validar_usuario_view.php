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
                <h5 class="login-box-msg ">Ingrese su Usuario</h5>
                <form class="form form-register" id="validarUsuarioForm" novalidate>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">

                                <input type="text" id="username" name="username" class="form-control"
                                    placeholder="Nombre Usuario">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mb-4">
                        <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/re_user'"
                            class="btn btn-grey btn-lg"
                            style="background: none; border: none; color: #0000EE; text-decoration: underline; cursor: pointer;">
                            ¿Olvidaste tu usuario?
                        </button>
                        <div class="col-6 center">


                            <button class="btn btn-success btn-block" type="submit">Validar</button>
                            <?php if (isset($error)): ?>
                            <div style="color: red;"><?php echo $error; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>


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