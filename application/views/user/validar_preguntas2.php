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
                <h5 class="login-box-msg ">Ingrese sus respuestas</h5>
                <form class="form form-register" id="validarPreguntasForm" novalidate>
                    <div class="row">
                        <div class="col-12">
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
                                <div class="mb-4">

                                    <div class="col-6 center">

                                        <button class="btn btn-success btn-block" type="button"
                                            onclick="validarPreguntas()">Validar</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mb-4">

                        <div class="col-6 center">
                            <button type="button" onclick="location.href='<?php echo base_url() ?>index.php/login1'"
                                class="btn btn-info btn-block r">
                                Cancelar
                            </button>


                        </div>
                    </div>
                </form>


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
                            "<?= base_url() ?>index.php/Validacion_controller/v_user?token=" + data
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