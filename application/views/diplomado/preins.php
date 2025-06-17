<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Solicitud de Inscripción del Diplomado - Sistema Integrado SNC</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="<?= base_url('css/diplomado.css') ?>" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card-container">
                    <img src="<?= base_url() ?>Plantilla/img/loij.png" alt="Logo" class="img-fluid">

                    <div class="card-header">
                        <h4>Solicitud de Preinscripción Inscripción del Diplomado</h4>
                        <h6 class="mb-0">Sistema Integrado SNC</h6>
                    </div>

                    <div class="card-body">
                        <!-- Sección del Diplomado -->
                        <div class="form-section">
                            <h5><i class="fas fa-graduation-cap mr-2"></i>Información</h5>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="id_tipop" class="required-field">Seleccione una opcion para
                                        continuar</label>
                                    <select id="id_tipop" name="id_tipop" class="default-select2 form-control" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="1">Persona Natural</option>
                                        <option value="2">Persona Juridica</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" id="guardar" onclick="redirectToForm()"
                                class="btn btn-primary btn-lg">
                                <i class="fas fa-arrow-right mr-2"></i>Continuar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery primero (IMPORTANTE) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Luego otros scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Tu archivo JS personalizado -->
    <script>
        function redirectToForm() {
            const tipoPersona = $('#id_tipop').val();

            if (!tipoPersona) {
                alert('Por favor seleccione una opción');
                return;
            }

            // Crear formulario dinámico
            const form = document.createElement('form');
            form.method = 'POST';

            if (tipoPersona == '1') {
                form.action = '<?php echo site_url("Diplomado/solic"); ?>';
            } else {
                form.action = '<?php echo site_url("Diplomado/solic_juridica"); ?>';
            }

            // Agregar campos ocultos
            const tipoField = document.createElement('input');
            tipoField.type = 'hidden';
            tipoField.name = 'tipo_persona';
            tipoField.value = tipoPersona;
            form.appendChild(tipoField);

            const csrfField = document.createElement('input');
            csrfField.type = 'hidden';
            csrfField.name = '<?php echo $this->security->get_csrf_token_name(); ?>';
            csrfField.value = '<?php echo $this->security->get_csrf_hash(); ?>';
            form.appendChild(csrfField);

            // Agregar al documento y enviar
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>

</html>