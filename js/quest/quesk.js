 function validarUsuario() {
        const username = document.getElementById('username').value.trim(); // Eliminar espacios en blanco

        // Validar que el campo no esté vacío
        if (username === "") {
            Swal.fire({
                icon: 'error',
                title: '',
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
                    // window.location.href = "<?= base_url() ?>index.php/Validacion_controller/mostrar_preguntas/" +
                    //     data.id_usuario;
                    // window.location.href =
                    //     "<?= base_url() ?>index.php/Validacion_controller/mostrar_preguntas?token=" + data
                    //     .token;
                    cargarPreguntas(data.token);
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




    function cargarPreguntas(token) {
        fetch(`<?= base_url() ?>index.php/Validacion_controller/mostrar_preguntas?token=${token}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Construir el HTML con las preguntas recibidas
                    const formularioPreguntas = construirFormulario(data);

                    // Insertar en la página
                    document.getElementById('contenedor-formulario').innerHTML = formularioPreguntas;
                }
            });
    }

    function cargarPreguntas(token) {
        // Mostrar loader o estado de carga (opcional)
        document.querySelector('.login-card-body').innerHTML =
            '<div class="text-center"><i class="fas fa-spinner fa-spin fa-3x"></i><p>Cargando preguntas...</p></div>';

        // Hacer la petición AJAX para obtener las preguntas
        fetch(`<?= base_url() ?>index.php/Validacion_controller/obtener_preguntas_json?token=${token}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener las preguntas');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Construir el formulario con las preguntas
                    const formularioHTML = `
                <div class="login-logo text-center">
                    <a href="https://www.snc.gob.ve/" target="_blank">
                        <img class="img" src="<?php echo base_url('baner/logo2.png'); ?>" alt="Logo SNC">
                    </a>
                </div>
                <h2 class="login-box-msg">Sistema Integrado SNC</h2>
                <h5 class="login-box-msg">Ingrese sus respuestas</h5>
                <form class="form form-register" id="validarPreguntasForm" novalidate>
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <input type="hidden" name="id_usuario" value="${data.id_usuario}">
                                ${data.preguntas.map(pregunta => `
                                    <div>
                                        <label for="respuesta_${pregunta.id_despregunta}">
                                            ${pregunta.despregunta} <i class='bx bx-notepad'></i>
                                            <input type="text" id="respuesta_${pregunta.id_despregunta}" 
                                                placeholder="Ingrese su respuesta"
                                                name="respuestas[${pregunta.id_despregunta}]" required>
                                        </label>
                                    </div>
                                `).join('')}
                                <div class="mb-4">
                                    <div class="col-6 center">
                                        <button class="btn btn-success btn-block" type="button" onclick="validarPreguntas()">
                                            Validar
                                        </button>
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
            `;

                    // Insertar el formulario en la página
                    document.querySelector('.login-card-body').innerHTML = formularioHTML;
                } else {
                    // Mostrar error si no se obtuvieron preguntas
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'No se pudieron cargar las preguntas',
                        confirmButtonText: 'Entendido'
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al cargar las preguntas',
                    confirmButtonText: 'Entendido'
                });
            });
    }

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