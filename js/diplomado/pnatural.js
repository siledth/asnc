// Definición de las variables globales necesarias
let capacitacionCount = 0;
const maxCapacitaciones = 3;
let experienciaCount = 0;
const maxExperiencias = 3;

// Obtener la fecha actual en formato YYYY-MM-DD para la validación de fecha 'Hasta'
const today = new Date();
const year = today.getFullYear();
const month = (today.getMonth() + 1).toString().padStart(2, '0');
const day = today.getDate().toString().padStart(2, '0');
const maxDate = `${year}-${month}-${day}`;

// Variable para almacenar los cursos disponibles (se llenará vía AJAX)
let cursosDisponibles = [];
let institucionesDisponibles = []; // Asegúrate que esta variable global esté aquí

// --- YA NO HAY BLOQUE DE PARSLEY.JS addCatalog AQUÍ ---
// Función para limpiar y permitir solo números enteros
function allowOnlyNumbers(inputElement) {
    inputElement.value = inputElement.value.replace(/[^0-9]/g, '');
}
// --- FUNCIONES DE GESTIÓN DE RIF DE EXPERIENCIA LABORAL ---
window.validarRIFExperiencia = function(inputElement, experienciaNum) {
    const rif = inputElement.value;
    const rifError = $(`#rifError_laboral_${experienciaNum}`);
    const consultarBtn = $(`#consultar_rif_laboral_btn_${experienciaNum}`);
    const missingCharsSpan = $(`#missingChars_laboral_${experienciaNum}`);

    if (rif.length === 10 && /^[JGVCEPDWjgvcepdw]\d{9}$/i.test(rif)) {
        rifError.addClass('d-none');
        consultarBtn.prop('disabled', false);
    } else {
        rifError.removeClass('d-none');
        const missingChars = 10 - rif.length;
        missingCharsSpan.text(missingChars > 0 ? missingChars : 0);
        consultarBtn.prop('disabled', true);
    }
};

window.consultar_rif_experiencia = function(experienciaNum) {
    const rifInput = $(`#rif_laboral_${experienciaNum}`);
    const existeDiv = $(`#existe_laboral_${experienciaNum}`);
    const noExisteDiv = $(`#no_existe_laboral_${experienciaNum}`);
    const selRifNombre5 = $(`#sel_rif_nombre5_laboral_${experienciaNum}`);
    const nombreConta5 = $(`#nombre_conta_5_laboral_${experienciaNum}`);
    const rif55 = $(`#rif_55_laboral_${experienciaNum}`);
    const razonSocialNoExiste = $(`#razon_social_laboral_${experienciaNum}`);
    const telLocalNoExiste = $(`#tel_local_laboral_${experienciaNum}`);
    const direccionFiscalNoExiste = $(`#direccion_fiscal_laboral_${experienciaNum}`);
    const consultarBtn = $(`#consultar_rif_laboral_btn_${experienciaNum}`);

    const rif_b = rifInput.val();

    if (rif_b === '') {
        swal({
            title: "¡ATENCION!",
            text: "El campo RIF no puede estar vacío.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: true
        });
        consultarBtn.prop("disabled", true);
        return;
    } else {
        consultarBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Consultando...');
        existeDiv.hide();
        noExisteDiv.hide();

        selRifNombre5.val('');
        nombreConta5.val('');
        rif55.val('');
        razonSocialNoExiste.val('').prop('required', false);
        telLocalNoExiste.val('').prop('required', false);
        direccionFiscalNoExiste.val('').prop('required', false);

        // var base_url_gestion = window.location.origin+'/asnc/index.php/gestion/consulta_og';
        var base_url_gestion = '/index.php/gestion/consulta_og';
        $.ajax({
            url: base_url_gestion,
            method: 'post',
            data: { rif_b: rif_b },
            dataType: 'json',
            success: function(data) {
                if (data === null || data.error) {
                    noExisteDiv.show();
                    rif55.val(rif_b);
                    razonSocialNoExiste.prop('required', true);
                    telLocalNoExiste.prop('required', true);
                    direccionFiscalNoExiste.prop('required', true);

                } else {
                    existeDiv.show();
                    selRifNombre5.val(data['rif']);
                    nombreConta5.val(data['descripcion']);
                }
            },
            error: function(xhr) {
                console.error("Error AJAX al consultar RIF de gestión:", xhr.responseText);
                swal("Error", "Hubo un problema al consultar el RIF. Intente de nuevo.", "error");
                noExisteDiv.show();
                rif55.val(rif_b);
                razonSocialNoExiste.prop('required', true);
                telLocalNoExiste.prop('required', true);
                direccionFiscalNoExiste.prop('required', true);
            },
            complete: function() {
                consultarBtn.prop('disabled', false).html('<i class="fas fa-search"></i> Consultar');
            }
        });
    }
};

// --- FIN DE FUNCIONES DE GESTIÓN DE RIF DE EXPERIENCIA LABORAL ---

// --- NUEVA FUNCIÓN: Cargar instituciones formadoras ---
function cargarInstituciones() {
    var base_url = '/index.php/Diplomado/obtener_inst_formadora_json'; // Use the appropriate base_url for your environment

    // var base_url = window.location.origin+'/asnc/index.php/Diplomado/obtener_inst_formadora_json';
    $.ajax({
        url: base_url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                institucionesDisponibles = response.instituciones;
                console.log('Instituciones cargadas:', institucionesDisponibles);
            } else {
                console.error('Error al cargar las instituciones:', response.message);
                swal('Error', 'No se pudieron cargar las instituciones formadoras. Por favor, intente de nuevo.', 'error');
            }
        },
        error: function(xhr) {
            console.error('Error AJAX al cargar instituciones:', xhr.responseText);
            swal('Error', 'Hubo un problema de conexión al cargar las instituciones formadoras.', 'error');
        }
    });
}

// --- FUNCIONES DE GESTIÓN DE CAPACITACIONES ---

// Función para cargar los cursos desde el backend
function cargarCursos() {
    var base_url = '/index.php/Diplomado/obtener_cursos_json'; 
    
    // var base_url = window.location.origin+'/asnc/index.php/Diplomado/obtener_cursos_json';

    $.ajax({
        url: base_url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                cursosDisponibles = response.cursos;
            } else {
                console.error('Error al cargar los cursos:', response.message);
                swal('Error', 'No se pudieron cargar los cursos disponibles. Por favor, intente de nuevo.', 'error');
            }
        },
        error: function(xhr) {
            console.error('Error AJAX al cargar cursos:', xhr.responseText);
            swal('Error', 'Hubo un problema de conexión al cargar los cursos.', 'error');
        }
    });
}

// Función para agregar un nuevo formulario de capacitación
function agregarCapacitacion() {
    if (capacitacionCount >= maxCapacitaciones) return;

    capacitacionCount++;
    const newId = 'capacitacion-' + capacitacionCount;

    let optionsHtmlCursos = '<option value="">Seleccione un curso</option>';
    cursosDisponibles.forEach(curso => {
        optionsHtmlCursos += `<option value="${curso.id_cursos}">${curso.descripcion_cursos}</option>`;
    });
    optionsHtmlCursos += '<option value="8">Otros</option>';

    let optionsHtmlInstituciones = '<option value="">Seleccione una institución</option>';
    institucionesDisponibles.forEach(institucion => {
        optionsHtmlInstituciones += `<option value="${institucion.id_inst_formadora}">${institucion.descripcion_f}</option>`;
    });

    const html = `
        <div class="capacitacion-item" id="${newId}">
            <h6>Capacitación #${capacitacionCount}</h6>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="id_curso_${capacitacionCount}" class="required-field">Curso / Diplomado</label>
                    <select id="id_curso_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][id_curso]" class="form-control curso-select" required>
                        ${optionsHtmlCursos}
                    </select>
                </div>
                <div class="col-md-6 form-group" id="otros_cursos_container_${capacitacionCount}" style="display: none;">
                    <label for="nombre_curso_otro_${capacitacionCount}" class="required-field">Nombre del Curso (Especifique)</label>
                    <input type="text" id="nombre_curso_otro_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][nombre_curso_otro]" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="id_institucion_formadora_${capacitacionCount}" class="required-field">Institución Formadora</label>
                    <select id="id_institucion_formadora_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][id_institucion_formadora]" class="form-control inst-formadora-select" required>
                        ${optionsHtmlInstituciones}
                    </select>
                </div>
                <div class="col-md-6 form-group" id="otros_institucion_formadora_container_${capacitacionCount}" style="display: none;">
                    <label for="nombre_institucion_formadora_otro_${capacitacionCount}" class="required-field">Nombre de la Institución (Especifique)</label>
                    <input type="text" id="nombre_institucion_formadora_otro_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][nombre_institucion_formadora_otro]" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="anio_${capacitacionCount}" class="required-field">Año de Realización</label>
                    <input type="text" id="anio_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][anio]" class="form-control" min="1900" max="${new Date().getFullYear()}" required>
                </div>
                <div class="col-md-3 form-group">
                    <label for="horas_${capacitacionCount}">Horas </label>
                    <input type="text" id="horas_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][horas]" class="form-control" min="0">
                </div>
            </div>
            ${capacitacionCount > 1 ? `
            <button type="button" class="btn btn-danger btn-sm btn-remove-capacitacion">
                <i class="fas fa-trash mr-1"></i>Eliminar esta capacitación
            </button>
            ` : ''}
            <hr>
        </div>
    `;

    $('#lista-capacitaciones').append(html);

    // Adjuntar evento de cambio para el select del curso
    $(`#id_curso_${capacitacionCount}`).on('change', function() {
        const selectedValue = $(this).val();
        if (selectedValue === '8') {
            $(`#otros_cursos_container_${capacitacionCount}`).show();
            $(`#nombre_curso_otro_${capacitacionCount}`).prop('required', true);
        } else {
            $(`#otros_cursos_container_${capacitacionCount}`).hide();
            $(`#nombre_curso_otro_${capacitacionCount}`).prop('required', false).val('');
        }
    });

    // Adjuntar evento de cambio para el select de institución formadora
    $(`#id_institucion_formadora_${capacitacionCount}`).on('change', function() {
        const selectedValue = $(this).val();
        if (selectedValue === '5' || selectedValue === '6') {
            $(`#otros_institucion_formadora_container_${capacitacionCount}`).show();
            $(`#nombre_institucion_formadora_otro_${capacitacionCount}`).prop('required', true);
        } else {
            $(`#otros_institucion_formadora_container_${capacitacionCount}`).hide();
            $(`#nombre_institucion_formadora_otro_${capacitacionCount}`).prop('required', false).val('');
        }
    });

    // Adjuntar evento de click para el botón de eliminar capacitacion
    $(`#${newId} .btn-remove-capacitacion`).on('click', function() {
        eliminarCapacitacion(newId);
    });

    // Ocultar o mostrar botón de agregar si llegamos al máximo
    if (capacitacionCount >= maxCapacitaciones) {
        $('#btn-add-capacitacion').hide();
    } else {
        $('#btn-add-capacitacion').show();
    }
     // --- AÑADIR ESTOS EVENTOS 'input' para anio y horas (si las horas también son solo números) ---
    $(`#anio_${capacitacionCount}`).on('input', function() {
        allowOnlyNumbers(this);
    });
    $(`#horas_${capacitacionCount}`).on('input', function() {
        allowOnlyNumbers(this); // Usa allowOnlyNumbers si las horas son solo números enteros.
                               // Si las horas pueden ser decimales (ej. 1.5 horas), usa allowNumbersAndDecimals.
    });
}

// Función para eliminar una capacitación
window.eliminarCapacitacion = function(id) {
    $('#' + id).remove();
    reindexarYReajustarCapacitaciones();
};

// Helper para reindexar y reajustar capacitaciones
function reindexarYReajustarCapacitaciones() {
    capacitacionCount = 0;
    $('#lista-capacitaciones .capacitacion-item').each(function(index) {
        capacitacionCount++;
        const newNum = capacitacionCount;
        const currentItem = $(this);

        currentItem.attr('id', 'capacitacion-' + newNum);
        currentItem.find('h6').text('Capacitación #' + newNum);

        currentItem.find('input, select, textarea').each(function() {
            const oldName = $(this).attr('name');
            if (oldName) {
                // ESTA ES LA LÍNEA CLAVE PARA REINDEXAR EL 'name' DEL ARRAY
                // Usamos 'index' (0-basado) para el nombre del array en PHP
                const newName = oldName.replace(/capacitaciones\[\d+\]/, `capacitaciones[${index}]`);
                $(this).attr('name', newName);
            }
            const oldId = $(this).attr('id');
            if (oldId) {
                const newId = oldId.replace(/_(\d+)/, `_${newNum}`);
                $(this).attr('id', newId);
            }
        });

        // Re-adjuntar el evento change para el select de curso y institución
        $(`#id_curso_${newNum}`).off('change').on('change', function() {
            const selectedValue = $(this).val();
            if (selectedValue === '8') {
                $(`#otros_cursos_container_${newNum}`).show();
                $(`#nombre_curso_otro_${newNum}`).prop('required', true);
            } else {
                $(`#otros_cursos_container_${newNum}`).hide();
                $(`#nombre_curso_otro_${newNum}`).prop('required', false).val('');
            }
        });

        $(`#id_institucion_formadora_${newNum}`).off('change').on('change', function() {
            const selectedValue = $(this).val();
            if (selectedValue === '5' || selectedValue === '6') {
                $(`#otros_institucion_formadora_container_${newNum}`).show();
                $(`#nombre_institucion_formadora_otro_${newNum}`).prop('required', true);
            } else {
                $(`#otros_institucion_formadora_container_${newNum}`).hide();
                $(`#nombre_institucion_formadora_otro_${newNum}`).prop('required', false).val('');
            }
        });
         $(`#anio_${newNum}`).off('input').on('input', function() {
            allowOnlyNumbers(this);
        });
        $(`#horas_${newNum}`).off('input').on('input', function() {
            allowOnlyNumbers(this); // O allowNumbersAndDecimals
        });

        // Re-adjuntar el evento click para el botón de eliminar
        if (currentItem.find('.btn-remove-capacitacion').length) {
            currentItem.find('.btn-remove-capacitacion').off('click').on('click', function() {
                eliminarCapacitacion(`capacitacion-${newNum}`);
            });
        }
    });

    // Mostrar/ocultar el botón de añadir después de reindexar
    if (capacitacionCount < maxCapacitaciones) {
        $('#btn-add-capacitacion').show();
    } else {
        $('#btn-add-capacitacion').hide();
    }
}

// --- FIN DE FUNCIONES DE GESTIÓN DE CAPACITACIONES ---


// --- FUNCIONES DE GESTIÓN DE EXPERIENCIA LABORAL ---

// Función para agregar un nuevo formulario de experiencia laboral
function agregarExperienciaLaboral() {
    if (experienciaCount >= maxExperiencias) return;

    experienciaCount++;
    const newId = 'experiencia-' + experienciaCount;

    const html = `
        <div class="experiencia-item" id="${newId}">
            <h6>Experiencia Laboral #${experienciaCount}</h6>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="cargo_laboral_${experienciaCount}" class="required-field">Cargo Desempeñado</label>
                    <input type="text" id="cargo_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][cargo]" class="form-control" required>
                </div>

                <div class="col-md-4 form-group">
                    <label for="tiempo_cargo_${experienciaCount}" class="required-field">Tiempo en el Cargo (años)</label>
                    <input type="text" id="tiempo_cargo_${experienciaCount}" name="experiencias[${experienciaCount}][tiempo_cargo]" class="form-control" min="0" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="desde_laboral_${experienciaCount}" class="required-field">Fecha de Inicio</label>
                    <input type="date" id="desde_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][desde]" class="form-control" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="hasta_laboral_${experienciaCount}" class="required-field">Fecha de Fin</label>
                    <input type="date" id="hasta_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][hasta]" class="form-control" max="${maxDate}" required>
                </div>
            </div>

            <div class="card p-3 mt-3">
                <h6>Datos de la Institución donde Laboró</h6>
                <div class="row">
                    <div class="col-md-8 form-group">
                        <label for="rif_laboral_${experienciaCount}" class="required-field">RIF de la Institución</label>
                        <input class="form-control" type="text" name="experiencias[${experienciaCount}][rif_institucion]"
                            id="rif_laboral_${experienciaCount}" placeholder="J123456789" maxlength="10" required>
                        <small id="rifError_laboral_${experienciaCount}" class="text-danger d-none">
                            El RIF debe tener <span id="missingChars_laboral_${experienciaCount}">10</span> caracteres exactos (Ej: J123456789)
                        </small>
                        <div class="invalid-feedback">Debe ingresar el RIF de la institución</div>
                    </div>
                    <div class="col-md-4 form-group d-flex align-items-end">
                        <button type="button" class="btn btn-default w-100" id="consultar_rif_laboral_btn_${experienciaCount}" disabled>
                            <i class="fas fa-search"></i> Consultar
                        </button>
                    </div>
                </div>

                <div id='existe_laboral_${experienciaCount}' style="display: none;">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>La institución está registrada en nuestro sistema.
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>RIF del Órgano / Ente</label>
                            <input class="form-control" type="text" name="experiencias[${experienciaCount}][rif_existente]"
                                id="sel_rif_nombre5_laboral_${experienciaCount}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Nombre del Órgano / Ente</label>
                            <input type="text" name="experiencias[${experienciaCount}][razon_social_existente]"
                                id="nombre_conta_5_laboral_${experienciaCount}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div id='no_existe_laboral_${experienciaCount}' style="display: none;">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Complete los datos de la institución.
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="rif_55_laboral_${experienciaCount}"><i
                                    class="fas fa-question-circle text-danger mr-1"></i>RIF</label>
                            <input type="text" class="form-control" name="experiencias[${experienciaCount}][rif_nuevo]"
                                id="rif_55_laboral_${experienciaCount}" placeholder="Ej: J123456789">
                        </div>
                        <div class="col-md-8 form-group">
                            <label for="razon_social_laboral_${experienciaCount}" class="required-field">Razón Social</label>
                            <input id="razon_social_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][razon_social_nueva]" class="form-control"
                                placeholder="Nombre completo de la institución">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="tel_local_laboral_${experienciaCount}" class="required-field">Teléfono Local</label>
                            <input type="text" id="tel_local_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][tel_local_nuevo]" class="form-control"
                                placeholder="Ej: 02121234567">
                            <p id="errorMsg_laboral_${experienciaCount}" class="text-danger"></p>
                        </div>
                        <div class="col-md-8 form-group">
                            <label for="direccion_fiscal_laboral_${experienciaCount}" class="required-field">Dirección Completa</label>
                            <textarea class="form-control" id="direccion_fiscal_laboral_${experienciaCount}" name="experiencias[${experienciaCount}][direccion_fiscal_nueva]"
                                rows="3" placeholder="Ej: Av. Principal, Edificio XYZ, Piso 3, Oficina 301"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <div class="form-check">
                    <input class="form-check-input es-actual-checkbox" type="checkbox" value="1"
                        id="es_actual_${experienciaCount}" name="experiencias[${experienciaCount}][es_actual]">
                    <label class="form-check-label" for="es_actual_${experienciaCount}">
                        ¿Es su empleo actual? (Esta será la empresa asociada a su inscripción)
                    </label>
                </div>
            </div>

            ${experienciaCount > 1 ? `
            <button type="button" class="btn btn-danger btn-sm btn-remove-experiencia">
                <i class="fas fa-trash mr-1"></i>Eliminar esta experiencia
            </button>
            ` : ''}
            <hr>
        </div>
    `;

    $('#lista-experiencias').append(html);

    // Agrega el evento change para el checkbox "Es su empleo actual?"
    $(`#es_actual_${experienciaCount}`).on('change', function() {
        if ($(this).is(':checked')) {
            $('.es-actual-checkbox').not(this).prop('checked', false).trigger('change');
        }
    });

    // Agrega el evento oninput y onclick para la validación/consulta de RIF
    $(`#rif_laboral_${experienciaCount}`).on('input', function() {
        validarRIFExperiencia(this, experienciaCount);
    });
    $(`#consultar_rif_laboral_btn_${experienciaCount}`).on('click', function() {
        consultar_rif_experiencia(experienciaCount);
    });

    // Adjuntar evento de click para el botón de eliminar experiencia
    $(`#${newId} .btn-remove-experiencia`).on('click', function() {
        eliminarExperienciaLaboral(newId);
    });

    // Ocultar o mostrar botón de agregar si llegamos al máximo
    if (experienciaCount >= maxExperiencias) {
        $('#btn-add-experiencia').hide();
    } else {
        $('#btn-add-experiencia').show();
    }
}

// Función para eliminar una experiencia laboral (DEBE SER GLOBAL para onclick)
window.eliminarExperienciaLaboral = function(id) {
    $('#' + id).remove();
    reindexarYReajustarExperiencias(); // Llama a la función de reindexación
};

// Helper para reindexar y reajustar experiencias laborales
function reindexarYReajustarExperiencias() {
    experienciaCount = 0; // Reiniciar el contador
    $('#lista-experiencias .experiencia-item').each(function(index) {
        experienciaCount++;
        const newNum = experienciaCount;
        const currentItem = $(this);

        currentItem.attr('id', 'experiencia-' + newNum);
        currentItem.find('h6').text('Experiencia Laboral #' + newNum);

        currentItem.find('input, select, textarea').each(function() {
            const oldName = $(this).attr('name');
            if (oldName) {
                // Regex para reemplazar el número de la experiencia en el name del array
                const newName = oldName.replace(/experiencias\[\d+\]/, `experiencias[${index}]`); // Corregido a 'index'
                $(this).attr('name', newName);
            }
            const oldId = $(this).attr('id');
            if (oldId) {
                // Regex para reemplazar el número de la experiencia en el ID
                const newId = oldId.replace(/_(\d+)$/, `_${newNum}`);
                $(this).attr('id', newId);
            }
        });

        // Re-adjuntar el evento change para el checkbox "Es su empleo actual?"
        $(`#es_actual_${newNum}`).off('change').on('change', function() {
            if ($(this).is(':checked')) {
                $('.es-actual-checkbox').not(this).prop('checked', false).trigger('change');
            }
        });

        // Re-adjuntar el evento oninput y onclick para la validación/consulta de RIF
        $(`#rif_laboral_${newNum}`).off('input').on('input', function() {
            validarRIFExperiencia(this, newNum);
        });
        $(`#consultar_rif_laboral_btn_${newNum}`).off('click').on('click', function() {
            consultar_rif_experiencia(newNum);
        });

        // Re-adjuntar el evento click para el botón de eliminar
        if (currentItem.find('.btn-remove-experiencia').length) {
            currentItem.find('.btn-remove-experiencia').off('click').on('click', function() {
                eliminarExperienciaLaboral(`experiencia-${newNum}`);
            });
        }
    });

    // Mostrar/ocultar el botón de añadir después de reindexar
    if (experienciaCount < maxExperiencias) {
        $('#btn-add-experiencia').show();
    } else {
        $('#btn-add-experiencia').hide();
    }
}

// --- FIN DE FUNCIONES DE GESTIÓN DE EXPERIENCIA LABORAL ---


// --- FUNCIONES DE INFORMACIÓN DEL DIPLOMADO Y VALIDACIÓN DE CÉDULA ---

// Función para cargar la información del diplomado
window.loadDiplomadoInfo = function(id_diplomado) {
    if (id_diplomado === "" || id_diplomado === "0") {
        $('#diplomadoInfoContainer').hide();
        return;
    }
    //   var base_url = window.location.origin + '/asnc/index.php/diplomado/getDiplomadoInfo/' + id_diplomado;
    var base_url = '/index.php/Diplomado/getDiplomadoInfo/' + id_diplomado; 
      
    $.ajax({
        url: base_url,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success && response.data) {
                const diplomadoData = response.data; // <-- Esta es la variable correctamente declarada

                let modalidadText = '';
                if (diplomadoData.id_modalidad === '1') {
                    modalidadText = 'Presencial';
                } else if (diplomadoData.id_modalidad === '2') { // <-- ¡CORREGIDO AQUÍ!
                    modalidadText = 'Online';
                } else {
                    modalidadText = 'Desconocida';
                }

                $('#diplomadoTitle').text(diplomadoData.name_d);
                $('#diplomadoFechaInicio').text(diplomadoData.fdesde);
                $('#diplomadoFechaFin').text(diplomadoData.fhasta);
                $('#diplomadoModalidad').text(modalidadText);
                
                // Formateo del campo de pago
                const payValue = parseFloat(diplomadoData.pay);
                if (!isNaN(payValue)) {
                    const formatter = new Intl.NumberFormat('es-VE', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    $('#diplomadoM').text(formatter.format(payValue));
                } else {
                    $('#diplomadoM').text(diplomadoData.pay); 
                }

                $('#diplomadoInfoContainer').show();
            } else {
                $('#diplomadoInfoContainer').hide();
                swal('Error', response.message || 'No se pudo obtener la información del diplomado.', 'error');
            }
        },
        error: function(xhr) {
            console.error("Error al cargar información del diplomado:", xhr.responseText);
            $('#diplomadoInfoContainer').hide();
            swal('Error', 'Hubo un problema de conexión al cargar la información del diplomado.', 'error');
        }
    });
};

// --- FIN DE FUNCIONES DE INFORMACIÓN DEL DIPLOMADO Y VALIDACIÓN DE CÉDULA ---


// --- FUNCIÓN DE ENVÍO DEL FORMULARIO PRINCIPAL (Inscribir) ---

window.handleInscripcionSubmit = function(event) {
    event.preventDefault(); // Prevenir el envío tradicional del formulario

    // --- INICIO: VALIDACIÓN MANUAL DE CAMPOS ---
    let isValid = true;
    let firstInvalidField = null; // Para enfocar el primer campo inválido

    // Función auxiliar para mostrar error visualmente
    function showFieldError(fieldElement, message) {
        fieldElement.addClass('is-invalid');
        // Mostrar mensaje en un div 'invalid-feedback' asociado, si existe
        let feedbackDiv = fieldElement.siblings('.invalid-feedback');
        if (feedbackDiv.length === 0) {
            // Si no existe, crear uno. Esto es útil para campos sin un div específico.
            feedbackDiv = $('<div class="invalid-feedback d-block"></div>');
            fieldElement.after(feedbackDiv);
        }
        feedbackDiv.text(message).show();
        if (!firstInvalidField) {
            firstInvalidField = fieldElement;
        }
    }

    // Función auxiliar para limpiar error visualmente
    function clearFieldError(fieldElement) {
        fieldElement.removeClass('is-invalid');
        fieldElement.siblings('.invalid-feedback').text('').hide();
    }

    // 1. Validar campos de Información del Diplomado (id_diplomado)
    const idDiplomadoField = $('#id_diplomado');
    if (idDiplomadoField.val() === "" || idDiplomadoField.val() === "0") {
        showFieldError(idDiplomadoField, 'Debe seleccionar un diplomado.');
        isValid = false;
    } else {
        clearFieldError(idDiplomadoField);
    }

    // 2. Validar Datos del Participante
    const requiredParticipantFields = [
        { id: 'cedula_f', message: 'La cédula es obligatoria y debe tener entre 5 y 10 dígitos.' },
        { id: 'name_f', message: 'El nombre es obligatorio.' },
        { id: 'apellido_f', message: 'El apellido es obligatorio.' },
        { id: 'correo', message: 'El correo es obligatorio.' },
        { id: 'edad', message: 'El edad es obligatorio.' },
        { id: 'telefono_f', message: 'El teléfono es obligatorio.' },

        { id: 'direccion_fiscal_', message: 'La dirección es obligatoria.' }
    ];

    requiredParticipantFields.forEach(field => {
        const element = $(`#${field.id}`);
        if (element.val().trim() === '') {
            showFieldError(element, field.message);
            isValid = false;
        } else {
            clearFieldError(element);
        }
    });
    

    // Validar cédula: longitud específica (si no la validó el onblur o para asegurar)
    const cedulaField = $('#cedula_f');
    if (cedulaField.val().length < 5 || cedulaField.val().length > 10) {
        showFieldError(cedulaField, 'La cédula debe tener entre 5 y 10 dígitos.');
        isValid = false;
    }

    // Validar correo electrónico
     const correoField = $('#correo');
    // Mantenemos la validación de formato aquí, pero el campo vacío ya lo cubre el bucle de arriba.
    if (correoField.val().trim() !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correoField.val().trim())) {
        showFieldError(correoField, 'Por favor, ingrese un formato de correo electrónico válido.');
        isValid = false;
    } else {
        // Solo limpia si el campo no está vacío y el formato es correcto.
        // Si estaba vacío, el requiredParticipantFields ya lo marcó.
        if (correoField.val().trim() !== '') {
            clearFieldError(correoField);
        }
    }

    // --- Validación específica para la EDAD (opcional, si quieres un rango) ---
    const edadField = $('#edad');
    const edadValue = parseInt(edadField.val());
    if (edadField.val().trim() !== '' && (isNaN(edadValue) || edadValue < 18 || edadValue > 80)) { // Ejemplo: edad entre 18 y 99
        showFieldError(edadField, 'Por favor, ingrese una edad válida (entre 18 y 99 años).');
        isValid = false;
    } else {
        if (edadField.val().trim() !== '') {
            clearFieldError(edadField);
        }
    }

    // 3. Validar Información Curricular
    const gradoInstruccionField = $('#grado_instruccion');
    if (gradoInstruccionField.val() === "") {
        showFieldError(gradoInstruccionField, 'El grado de instrucción es obligatorio.');
        isValid = false;
    } else {
        clearFieldError(gradoInstruccionField);
    }

    const tituloObtenidoField = $('#titulo_obtenido');
    if (tituloObtenidoField.val().trim() === '') {
        showFieldError(tituloObtenidoField, 'El título obtenido es obligatorio.');
        isValid = false;
    } else {
        clearFieldError(tituloObtenidoField);
    }

    const tContrataPField = $('#t_contrata_p');
    if (tContrataPField.val() === "") {
        showFieldError(tContrataPField, 'Debe indicar si tiene experiencia en Contrataciones Públicas.');
        isValid = false;
    } else {
        clearFieldError(tContrataPField);
        if (tContrataPField.val() === '1') { // Si tiene experiencia, validar años
            const experienciaPublicasField = $('#experiencia_publicas');
            if (experienciaPublicasField.val().trim() === '' || parseInt(experienciaPublicasField.val()) < 0) {
                showFieldError(experienciaPublicasField, 'Debe indicar los años de experiencia (número válido).');
                isValid = false;
            } else {
                clearFieldError(experienciaPublicasField);
            }
        }
    }

    const tieneCapacitacionField = $('#tiene_capacitacion');
    if (tieneCapacitacionField.val() === "") {
        showFieldError(tieneCapacitacionField, 'Debe indicar si ha realizado capacitaciones.');
        isValid = false;
    } else {
        clearFieldError(tieneCapacitacionField);
        if (tieneCapacitacionField.val() === '1') {
            const capacitacionesCount = $('#lista-capacitaciones .capacitacion-item').length;
            if (capacitacionesCount === 0) {
                swal("Atención", "Debe agregar al menos una capacitación en Contrataciones Públicas.", "warning");
                isValid = false;
            } else {
                // Validar cada capacitación individualmente
                $('#lista-capacitaciones .capacitacion-item').each(function(idx) {
                    const currentCapacitacionItem = $(this);
                    const idCursoField = currentCapacitacionItem.find('select[name*="[id_curso]"]');
                    const nombreCursoOtroField = currentCapacitacionItem.find('input[name*="[nombre_curso_otro]"]');
                    const idInstitucionFormadoraField = currentCapacitacionItem.find('select[name*="[id_institucion_formadora]"]');
                    const nombreInstitucionFormadoraOtroField = currentCapacitacionItem.find('input[name*="[nombre_institucion_formadora_otro]"]');
                    const anioField = currentCapacitacionItem.find('input[name*="[anio]"]');

                    if (idCursoField.val() === "") {
                        showFieldError(idCursoField, `Seleccione un curso para la capacitación #${idx + 1}.`);
                        isValid = false;
                    } else {
                        clearFieldError(idCursoField);
                        if (idCursoField.val() === '8' && nombreCursoOtroField.val().trim() === '') {
                            showFieldError(nombreCursoOtroField, `Especifique el nombre del curso para la capacitación #${idx + 1}.`);
                            isValid = false;
                        } else {
                            clearFieldError(nombreCursoOtroField);
                        }
                    }

                    if (idInstitucionFormadoraField.val() === "") {
                        showFieldError(idInstitucionFormadoraField, `Seleccione una institución formadora para la capacitación #${idx + 1}.`);
                        isValid = false;
                    } else {
                        clearFieldError(idInstitucionFormadoraField);
                        if ((idInstitucionFormadoraField.val() === '5' || idInstitucionFormadoraField.val() === '6') && nombreInstitucionFormadoraOtroField.val().trim() === '') {
                            showFieldError(nombreInstitucionFormadoraOtroField, `Especifique el nombre de la institución formadora para la capacitación #${idx + 1}.`);
                            isValid = false;
                        } else {
                            clearFieldError(nombreInstitucionFormadoraOtroField);
                        }
                    }

                    if (anioField.val().trim() === '' || parseInt(anioField.val()) < 1900 || parseInt(anioField.val()) > new Date().getFullYear()) {
                        showFieldError(anioField, `Ingrese un año válido para la capacitación #${idx + 1}.`);
                        isValid = false;
                    } else {
                        clearFieldError(anioField);
                    }
                });
            }
        }
    }

    const tieneExperienciaLaboralField = $('#tiene_experiencia_laboral');
    if (tieneExperienciaLaboralField.val() === "") {
        showFieldError(tieneExperienciaLaboralField, 'Debe indicar si tiene experiencia laboral formal.');
        isValid = false;
    } else {
        clearFieldError(tieneExperienciaLaboralField);
        if (tieneExperienciaLaboralField.val() === '1') {
            const experienciasCount = $('#lista-experiencias .experiencia-item').length;
            if (experienciasCount === 0) {
                swal("Atención", "Debe agregar al menos una experiencia laboral.", "warning");
                isValid = false;
            } else {
                let hasCurrentEmployment = false;
                // Validar cada experiencia laboral individualmente
                $('#lista-experiencias .experiencia-item').each(function(idx) {
                    const currentExperienciaItem = $(this);
                    const cargoField = currentExperienciaItem.find('input[name*="[cargo]"]');
                    const tiempoCargoField = currentExperienciaItem.find('input[name*="[tiempo_cargo]"]');
                    const desdeField = currentExperienciaItem.find('input[name*="[desde]"]');
                    const hastaField = currentExperienciaItem.find('input[name*="[hasta]"]');
                    const rifInstitucionField = currentExperienciaItem.find('input[name*="[rif_institucion]"]');
                    const esActualCheckbox = currentExperienciaItem.find('input[name*="[es_actual]"]');

                    // Basic fields validation
                    if (cargoField.val().trim() === '') {
                        showFieldError(cargoField, `El cargo es obligatorio para la experiencia #${idx + 1}.`);
                        isValid = false;
                    } else { clearFieldError(cargoField); }
                    if (tiempoCargoField.val().trim() === '' || parseInt(tiempoCargoField.val()) < 0) {
                        showFieldError(tiempoCargoField, `El tiempo en el cargo es obligatorio para la experiencia #${idx + 1}.`);
                        isValid = false;
                    } else { clearFieldError(tiempoCargoField); }
                    if (desdeField.val().trim() === '') {
                        showFieldError(desdeField, `La fecha de inicio es obligatoria para la experiencia #${idx + 1}.`);
                        isValid = false;
                    } else { clearFieldError(desdeField); }
                    if (hastaField.val().trim() === '') {
                        showFieldError(hastaField, `La fecha de fin es obligatoria para la experiencia #${idx + 1}.`);
                        isValid = false;
                    } else {
                        // Validate 'hasta' date not in future
                        if (new Date(hastaField.val()) > new Date(maxDate)) {
                            showFieldError(hastaField, `La fecha de fin para la experiencia #${idx + 1} no puede ser futura.`);
                            isValid = false;
                        } else {
                            clearFieldError(hastaField);
                        }
                    }

                    // RIF and institution data validation
                    if (rifInstitucionField.val().trim() === '') {
                        showFieldError(rifInstitucionField, `El RIF de la institución es obligatorio para la experiencia #${idx + 1}.`);
                        isValid = false;
                    } else if (!/^[JGVCEPDWjgvcepdw]\d{9}$/i.test(rifInstitucionField.val().trim())) {
                        showFieldError(rifInstitucionField, `Formato de RIF inválido para la experiencia #${idx + 1}.`);
                        isValid = false;
                    }
                    else { clearFieldError(rifInstitucionField); }


                    // If it's a "no_existe" institution, validate its fields
                    const noExisteDiv = currentExperienciaItem.find(`#no_existe_laboral_${idx + 1}`); // Note: this ID needs to be adjusted in HTML/JS template if it's based on 'experienciaCount' rather than 'idx+1'
                    if (noExisteDiv.is(':visible')) {
                        const razonSocialNoExiste = currentExperienciaItem.find('input[name*="[razon_social_nueva]"]');
                        const telLocalNoExiste = currentExperienciaItem.find('input[name*="[tel_local_nuevo]"]');
                        const direccionFiscalNoExiste = currentExperienciaItem.find('textarea[name*="[direccion_fiscal_nueva]"]');

                        if (razonSocialNoExiste.val().trim() === '') {
                            showFieldError(razonSocialNoExiste, `La Razón Social es obligatoria para la institución en experiencia #${idx + 1}.`);
                            isValid = false;
                        } else { clearFieldError(razonSocialNoExiste); }
                        if (telLocalNoExiste.val().trim() === '') {
                            showFieldError(telLocalNoExiste, `El Teléfono local es obligatorio para la institución en experiencia #${idx + 1}.`);
                            isValid = false;
                        } else { clearFieldError(telLocalNoExiste); }
                        if (direccionFiscalNoExiste.val().trim() === '') {
                            showFieldError(direccionFiscalNoExiste, `La Dirección es obligatoria para la institución en experiencia #${idx + 1}.`);
                            isValid = false;
                        } else { clearFieldError(direccionFiscalNoExiste); }
                    }

                    if (esActualCheckbox.is(':checked')) {
                        hasCurrentEmployment = true;
                    }
                });

                if (!hasCurrentEmployment) {
                    swal("Atención", "Debe marcar al menos una experiencia como su empleo actual.", "warning");
                    isValid = false;
                }
            }
        }
    }


    // --- FIN: VALIDACIÓN MANUAL DE CAMPOS ---

    if (!isValid) {
        // Enfocar el primer campo inválido si existe
        if (firstInvalidField) {
            $('html, body').animate({
                scrollTop: firstInvalidField.offset().top - 80 // Ajusta el offset si tu header es fijo
            }, 500);
            firstInvalidField.focus();
        }
        return; // Detener el envío si la validación falla
    }

    // Si todo está bien, envía el formulario usando AJAX
    const formData = new FormData($('#inscripcionForm')[0]);
    // var base_url_guardar = window.location.origin+'/asnc/index.php/Diplomado/guardar_inscripcion';
    // var base_url_redirigir = window.location.origin+'/asnc/index.php/Diplomado/preinscrip';
    // var base_url_pdf = window.location.origin+'/asnc/index.php/Preinscripcionnatural/pdfrt?id=';

     var base_url_guardar = '/index.php/Diplomado/guardar_inscripcion';
        var base_url_redirigir = '/index.php/Diplomado/preinscrip';
        var base_url_pdf = '/index.php/Preinscripcionnatural/pdfrt?id=';

    $.ajax({
        url: base_url_guardar,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            $('#guardarInscripcionBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
        },
        success: function(response) {
            if (response.success) {
                swal({
                    title: "¡Éxito!",
                    text: response.message + "\nCódigo de planilla: " + response.codigo,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#00897b",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: true
                }, function() {
                    const pdfUrl = base_url_pdf + response.codigo;
                    window.open(pdfUrl, '_blank');
                    setTimeout(function() {
                        window.location.href = base_url_redirigir;
                    }, 1000);
                });
            } else {
                swal("Error", response.message, "error");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error AJAX:", xhr.responseText);
            let errorMessage = 'Hubo un error desconocido al registrar la inscripción.';
            try {
                const errorResponse = JSON.parse(xhr.responseText);
                if (errorResponse && errorResponse.message) {
                    errorMessage = errorResponse.message;
                }
            } catch (e) {
            }
            swal("Error", errorMessage, "error");
        },
        complete: function() {
            $('#guardarInscripcionBtn').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Inscripción');
        }
    });
};

// --- FIN DE FUNCIÓN DE ENVÍO DEL FORMULARIO PRINCIPAL ---


// --- INICIO DEL DOCUMENT.READY ---

$(document).ready(function() {
    // YA NO HAY INICIALIZACIÓN DE PARSLEY AQUÍ
 // Asociar evento 'change' a la casilla de Declaración Jurada
    $('#declaracionJurada').on('change', function() {
        const guardarBtn = $('#guardarInscripcionBtn');
        const declaracionJuradaField = $(this);
        const feedbackDiv = $('#declaracionJurada-feedback');

        if (declaracionJuradaField.is(':checked')) {
            guardarBtn.prop('disabled', false); // Habilita el botón
            feedbackDiv.hide().text(''); // Oculta cualquier mensaje de error
            declaracionJuradaField.removeClass('is-invalid'); // Remueve el estilo de error
        } else {
            guardarBtn.prop('disabled', true); // Deshabilita el botón
            feedbackDiv.text('Debe aceptar la declaración jurada para continuar.').show(); // Muestra el mensaje de error
            declaracionJuradaField.addClass('is-invalid'); // Añade el estilo de error
        }
    });

    // Disparar el evento 'change' una vez al cargar la página para establecer el estado inicial del botón
    // Esto es útil si el formulario se carga con datos preexistentes donde el checkbox ya podría estar marcado.
    $('#declaracionJurada').trigger('change');
    // Cargar cursos y instituciones al inicio
    cargarCursos();
    cargarInstituciones();

    // Asociar eventos a los elementos del DOM

    // Diplomado Info
    $('#id_diplomado').on('change', function() {
        window.loadDiplomadoInfo($(this).val());
    });

    // Datos del Participante
    $('#cedula_f').on('blur', function() {
        window.validateUsers();
    });
     $('#cedula_f').on('input', function() {
        allowOnlyNumbers(this);
    });
    $('#edad').on('input', function() {
        allowOnlyNumbers(this);
    });
    $('#experiencia_publicas').on('input', function() {
        allowOnlyNumbers(this);
    });
    $('#telefono_f').on('input', function() { // Asumo que el teléfono también es solo números
        allowOnlyNumbers(this);
    });

    // Información Curricular - Experiencia en Contrataciones Públicas
    $('#t_contrata_p').on('change', function() {
        if ($(this).val() === '1') {
            $('#experiencia_publicas_container').show();
            $('#experiencia_publicas').prop('required', true); // Mantener 'required' para compatibilidad con el backend
        } else {
            $('#experiencia_publicas_container').hide();
            $('#experiencia_publicas').prop('required', false).val('');
        }
    }).trigger('change');

    // Información Curricular - Capacitaciones en Contrataciones Públicas
    $('#tiene_capacitacion').on('change', function() {
        if ($(this).val() === '1') {
            $('#capacitaciones-container').show();
            if (capacitacionCount === 0) {
                agregarCapacitacion();
            }
        } else {
            $('#capacitaciones-container').hide();
            $('#lista-capacitaciones').empty();
            capacitacionCount = 0;
            $('#btn-add-capacitacion').show();
        }
    }).trigger('change');

    $('#btn-add-capacitacion').on('click', function() {
        if (capacitacionCount < maxCapacitaciones) {
            agregarCapacitacion();
        } else {
            swal("Límite alcanzado", 'Solo puedes agregar hasta ' + maxCapacitaciones + ' capacitaciones.', "info");
        }
    });

    // Información Curricular - Experiencia Laboral Formal
    $('#tiene_experiencia_laboral').on('change', function() {
        if ($(this).val() === '1') {
            $('#experiencia-laboral-container').show();
            if (experienciaCount === 0) {
                agregarExperienciaLaboral();
            }
        } else {
            $('#experiencia-laboral-container').hide();
            $('#lista-experiencias').empty();
            experienciaCount = 0;
            $('#btn-add-experiencia').show();
        }
    }).trigger('change');

    $('#btn-add-experiencia').on('click', function() {
        if (experienciaCount < maxExperiencias) {
            agregarExperienciaLaboral();
        } else {
            swal("Límite alcanzado", 'Solo puedes agregar hasta ' + maxExperiencias + ' experiencias laborales.', "info");
        }
    });

    // Asociar el envío del formulario al botón principal
    $('#inscripcionForm').on('submit', window.handleInscripcionSubmit);
});

// --- FIN DEL DOCUMENT.READY ---