// Objeto para almacenar todos los datos en cache (empresa y participantes)
const cacheFormulario = {
    empresa: {},
    participantes: []
};

// Variables globales para los catálogos de datos y contadores
let cursosDisponibles = [];
let institucionesDisponibles = [];
let clasificacionData = []; // Para los grados de instrucción
let modalCapacitacionCounter = 0; // Contador para las capacitaciones dentro del modal (por participante)

// Obtener la fecha actual para validaciones de fecha de fin (YYYY-MM-DD)
const today = new Date();
const year = today.getFullYear();
const month = (today.getMonth() + 1).toString().padStart(2, '0');
const day = today.getDate().toString().padStart(2, '0');
const maxDate = `${year}-${month}-${day}`;

// --- FUNCIONES AUXILIARES DE VALIDACIÓN Y UTILIDAD ---

// Función para limpiar y permitir solo números enteros en un input
function allowOnlyNumbers(inputElement) {
    if (inputElement) {
        inputElement.value = inputElement.value.replace(/[^0-9]/g, '');
    }
}

// Función para validar si una cadena es un número entero
function isInteger(value) {
    return /^\d+$/.test(value);
}

// Función para mostrar un mensaje de error visual bajo un campo de formulario
function showFieldError(fieldElement, message) {
    fieldElement.addClass('is-invalid');
    let feedbackDiv = fieldElement.siblings('.invalid-feedback');
    if (feedbackDiv.length === 0) {
        // Si no existe un div invalid-feedback, lo creamos
        feedbackDiv = $('<div class="invalid-feedback d-block"></div>');
        fieldElement.after(feedbackDiv);
    }
    feedbackDiv.text(message).show();
}

// Función para limpiar un mensaje de error visual de un campo de formulario
function clearFieldError(fieldElement) {
    fieldElement.removeClass('is-invalid');
    fieldElement.siblings('.invalid-feedback').text('').hide();
}

// Función para formatear fechas a DD/MM/YYYY
function formatDate(dateString) {
    const date = new Date(dateString + 'T00:00:00'); // Añadir T00:00:00 para consistencia horaria
    if (isNaN(date.getTime())) {
        return dateString; // Retorna original si es inválida
    }
    return date.toLocaleDateString('es-ES', { year: 'numeric', month: '2-digit', day: '2-digit' });
}

// Función para obtener el texto de la modalidad
function getModalidadText(idModalidad) {
    const modalidades = {
        1: 'Presencial',
        2: 'Virtual',
        3: 'Bimodal'
    };
    return modalidades[idModalidad] || 'No especificado';
}

// Función para gestionar la visibilidad del botón "Añadir Experiencia Laboral"
// (Asegúrate de que esta lógica es la que deseas para el formulario de persona jurídica)
function toggleAddParticipanteButton() {
    const totalParticipantes = cacheFormulario.participantes.length;
    const maxParticipantes = 15; // Define tu límite máximo de participantes

    if (totalParticipantes >= maxParticipantes) {
        $('#btn-agregar-participante').hide();
    } else {
        $('#btn-agregar-participante').show();
    }
}


// --- FUNCIONES PARA CARGAR CATÁLOGOS DESDE EL BACKEND ---

function cargarInstituciones() {
    // var base_url = window.location.origin + '/asnc/index.php/Diplomado/obtener_inst_formadora_json';
   var base_url = '/index.php/Diplomado/obtener_inst_formadora_json';

    $.ajax({
        url: base_url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                institucionesDisponibles = response.instituciones;
            } else {
                Swal.fire('Error', 'No se pudieron cargar las instituciones formadoras.', 'error');
            }
        },
        error: function(xhr) {
            Swal.fire('Error', 'Problema de conexión al cargar instituciones.', 'error');
        }
    });
}

function cargarCursosModal() {
    // var base_url = window.location.origin + '/asnc/index.php/Diplomado/obtener_cursos_json';
     var base_url = '/index.php/Diplomado/obtener_cursos_json';
    $.ajax({
        url: base_url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                cursosDisponibles = response.cursos;
            } else {
                Swal.fire('Error', 'No se pudieron cargar los cursos.', 'error');
            }
        },
        error: function(xhr) {
            Swal.fire('Error', 'Problema de conexión al cargar cursos.', 'error');
        }
    });
}

function cargarClasificacionAcademica() {
    // var base_url = window.location.origin + '/asnc/index.php/Diplomado/obtener_clasificacion_academica_json';
     var base_url = '/index.php/Diplomado/obtener_clasificacion_academica_json';

    $.ajax({
        url: base_url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                clasificacionData = response.clasificaciones;
            } else {
                Swal.fire('Error', 'No se pudo cargar la clasificación académica.', 'error');
            }
        },
        error: function(xhr) {
            Swal.fire('Error', 'Problema de conexión al cargar clasificación académica.', 'error');
        }
    });
}

// --- FUNCIÓN PARA CARGAR INFORMACIÓN DEL DIPLOMADO SELECCIONADO ---
function loadDiplomadoInfo(idDiplomado) {
    if(idDiplomado == 0) {
        $('#diplomadoInfoContainer').hide();
        return;
    }
    // var base_url = window.location.origin+'/asnc/index.php/diplomado/getDiplomadoInfo/' + idDiplomado;
    var base_url = '/index.php/Diplomado/getDiplomadoInfo/' + id_diplomado; 
    
    $.ajax({
        url: base_url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if(response.success && response.data) {
                const diplomadoData = response.data;

                // Mapear id_modalidad a texto (corregido el tipeo de 'dipladoData')
                let modalidadText = '';
                const idModalidadNumerico = parseInt(diplomadoData.id_modalidad);
                if (idModalidadNumerico === 1) {
                    modalidadText = 'Presencial';
                } else if (idModalidadNumerico === 2) {
                    modalidadText = 'Online'; // O 'Virtual' según tu getModalidadText
                } else {
                    modalidadText = 'Desconocida';
                }

                $('#diplomadoTitle').text(diplomadoData.name_d);
                $('#diplomadoFechaInicio').text(formatDate(diplomadoData.fdesde));
                $('#diplomadoFechaFin').text(formatDate(diplomadoData.fhasta));
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
                Swal.fire('Error', response.message || 'Error al cargar la información del diplomado', 'error');
                $('#diplomadoInfoContainer').hide();
            }
        },
        error: function() {
            Swal.fire('Error', 'Error en la conexión con el servidor al cargar diplomado.', 'error');
            $('#diplomadoInfoContainer').hide();
        }
    });
}

// --- FUNCIONES PARA GESTIÓN DE PARTICIPANTES ---

function agregarParticipante() {
    // Validar campos básicos del formulario de "Agregar Participante"
    const cedulaField = $('#cedula');
    const nombresField = $('#nombres');
    const apellidosField = $('#apellidos');
    const telefonoField = $('#tel_part');
    // const direccionField = $('#direccion_part'); // Si el participante tiene campo de dirección directo aquí

    let isValidParticipanteForm = true;

    // Limpiar errores visuales previos
    clearFieldError(cedulaField);
    clearFieldError(nombresField);
    clearFieldError(apellidosField);
    clearFieldError(telefonoField);
    // if (direccionField.length) clearFieldError(direccionField);

    // Validar Cédula
    if (cedulaField.val().trim() === '' || !isInteger(cedulaField.val()) || cedulaField.val().length < 5 || cedulaField.val().length > 10) {
        showFieldError(cedulaField, 'La cédula es obligatoria y debe ser numérica (5-10 dígitos).');
        isValidParticipanteForm = false;
    }
    // Validar Nombres
    if (nombresField.val().trim() === '') {
        showFieldError(nombresField, 'El nombre es obligatorio.');
        isValidParticipanteForm = false;
    }
    // Validar Apellidos
    if (apellidosField.val().trim() === '') {
        showFieldError(apellidosField, 'El apellido es obligatorio.');
        isValidParticipanteForm = false;
    }
    // Validar Teléfono
    if (telefonoField.val().trim() === '' || !isInteger(telefonoField.val()) || telefonoField.val().length < 7) {
        showFieldError(telefonoField, 'El teléfono es obligatorio y debe ser numérico (mín. 7 dígitos).');
        isValidParticipanteForm = false;
    }
    // Si el participante tiene campo de dirección directo en esta sección:
    // if (direccionField.length && direccionField.val().trim() === '') {
    //     showFieldError(direccionField, 'La dirección del participante es obligatoria.');
    //     isValidParticipanteForm = false;
    // }

    if (!isValidParticipanteForm) {
        Swal.fire('Error', 'Por favor complete los campos obligatorios del participante correctamente.', 'error');
        return;
    }

    // Crear objeto con datos del participante para el cache
    const participante = {
        cedula: cedulaField.val().trim(),
        nombres: nombresField.val().trim(),
        apellidos: apellidosField.val().trim(),
        telefono: telefonoField.val().trim(),
        // Ajusta esto si el participante tiene un campo de dirección directo en este paso
        // direccion: direccionField.length ? direccionField.val().trim() : 'N/A', 
        curriculum: {
            grado_instruccion: '',
            titulo_obtenido: '',
            experiencia_publicas: 0,
            tiene_capacitacion: '0',
            capacitaciones: []
        }
    };

    cacheFormulario.participantes.push(participante);
    
    // Mostrar modal para información curricular del participante recién agregado
    mostrarModalCurriculum(cacheFormulario.participantes.length - 1);
    
    // Limpiar formulario y errores visuales
    cedulaField.val('');
    nombresField.val('');
    apellidosField.val('');
    telefonoField.val('');
    // if (direccionField.length) direccionField.val('');

    Swal.fire('Éxito', 'Participante agregado. Complete sus datos curriculares.', 'success');
    
    // Actualizar lista de participantes y el botón de añadir
    actualizarListaParticipantes();
    toggleAddParticipanteButton(); // Re-evaluar el botón de añadir participante
}

// Función para eliminar participante
function eliminarParticipante(index) {
    cacheFormulario.participantes.splice(index, 1);
    actualizarListaParticipantes();
    toggleAddParticipanteButton(); // Re-evaluar el botón de añadir participante
}

// Función para actualizar la lista visual de participantes
function actualizarListaParticipantes() {
    const lista = $('#lista-participantes');
    lista.empty();
    
    cacheFormulario.participantes.forEach((p, index) => {
        // Obtener la descripción del grado académico usando clasificacionData
        const gradoAcademicoTexto = clasificacionData.find(g => g.id_academico == p.curriculum.grado_instruccion)?.desc_academico || 'No especificado';

        lista.append(`
            <div class="participante-item mb-3 p-3 border rounded">
                <div class="d-flex justify-content-between">
                    <h6>${p.nombres} ${p.apellidos} <small>(C.I. ${p.cedula})</small></h6>
                    <div>
                        <button class="btn btn-sm btn-info mr-2" onclick="mostrarModalCurriculum(${index})">
                            <i class="fas fa-graduation-cap"></i> Curriculum
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarParticipante(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div><strong>Teléfono:</strong> ${p.telefono || 'No especificado'}</div>
                <div><strong>Grado Inst.:</strong> ${gradoAcademicoTexto}</div>
                <div><strong>Título Obtenido:</strong> ${p.curriculum.titulo_obtenido || 'No especificado'}</div>
                <div><strong>Exp. Contrataciones:</strong> ${p.curriculum.experiencia_publicas || 0} años</div>
                ${p.curriculum.tiene_capacitacion === '1' && p.curriculum.capacitaciones.length > 0 ? 
                    '<div><strong>Capacitaciones:</strong><ul>' + 
                    p.curriculum.capacitaciones.map(c => 
                        `<li>${c.nombre_curso} - ${c.institucion} (${c.anio})</li>`
                    ).join('') + '</ul></div>' : ''}
            </li>
        `);
    });
}


// --- FUNCIONES PARA GESTIÓN DEL MODAL DE CURRICULUM ---

// Función para mostrar modal de curriculum
function mostrarModalCurriculum(index) {
    const participante = cacheFormulario.participantes[index];
    
    // Configurar modal
    $('#modalCurriculumLabel').text(`Curriculum - ${participante.nombres} ${participante.apellidos}`);
    $('#modalCedula').text(participante.cedula);
    
    // Limpiar clases de validación y mensajes de error al abrir el modal
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback.d-block').remove(); 

    // Rellenar campos del currículum básico
    $('#grado_instruccion').val(participante.curriculum.grado_instruccion || ''); 
    $('#titulo_obtenido').val(participante.curriculum.titulo_obtenido || '');
    $('#experiencia_publicas').val(participante.curriculum.experiencia_publicas || 0);
    $('#tiene_capacitacion').val(participante.curriculum.tiene_capacitacion || '0'); 

    // Mostrar/ocultar sección de capacitaciones según valor actual
    toggleSeccionCapacitaciones(participante.curriculum.tiene_capacitacion);
    
    // Limpiar y cargar capacitaciones existentes
    $('#listaCapacitaciones').empty();
    modalCapacitacionCounter = 0; // Reiniciar el contador de capacitaciones del modal ANTES de cargar las existentes
    participante.curriculum.capacitaciones.forEach((cap) => { // Eliminar 'i' ya que no se usa en este bucle
        agregarCapacitacionHTML(++modalCapacitacionCounter, cap); // Pre-incrementa el contador para el ID y el texto
    });

    // Evento para mostrar/ocultar capacitaciones al cambiar el select
    $('#tiene_capacitacion').off('change').on('change', function() {
        toggleSeccionCapacitaciones($(this).val());
    });
    
    // Configurar botón de guardar
    $('#btnGuardarCurriculum').off('click').on('click', function() {
        guardarCurriculum(index);
    });

    // Configurar botón de agregar capacitación dentro del modal
    $('#btnAgregarCapacitacionModal').off('click').on('click', function() {
        agregarCapacitacionModal();
    });
    
    // Mostrar modal
    $('#modalCurriculum').modal('show');
}

// Función para mostrar/ocultar la sección de capacitaciones
function toggleSeccionCapacitaciones(valor) {
    $('#seccionCapacitaciones').toggle(valor === '1');
}

// Función para agregar capacitación (la que genera el HTML dinámico dentro del modal)
function agregarCapacitacionModal() { 
    const lista = $('#listaCapacitaciones');
    const count = lista.children('.capacitacion-item').length;
    
    if (count >= 3) { 
        Swal.fire('Atención', 'Máximo 3 capacitaciones por participante.', 'warning');
        return;
    }
    
    const newCapacitacionIndex = modalCapacitacionCounter + 1;
    agregarCapacitacionHTML(newCapacitacionIndex, { 
        id_curso_guardado: '', 
        nombre_curso: '', 
        nombre_curso_otro: '',
        id_institucion_guardado: '',
        institucion: '',
        nombre_institucion_otro: '',
        anio: '', 
        horas: '' 
    });
    modalCapacitacionCounter++;
}

// Función para agregar HTML de capacitación (con selects dinámicos y validación numérica)
function agregarCapacitacionHTML(index, capacitacion) {
    let optionsHtmlCursos = '<option value="">Seleccione un curso</option>';
    cursosDisponibles.forEach(curso => {
        const selected = (curso.id_cursos == capacitacion.id_curso_guardado) ? 'selected' : '';
        optionsHtmlCursos += `<option value="${curso.id_cursos}" ${selected}>${curso.descripcion_cursos}</option>`;
    });
    optionsHtmlCursos += `<option value="8" ${capacitacion.id_curso_guardado == '8' ? 'selected' : ''}>Otros</option>`;

    let optionsHtmlInstituciones = '<option value="">Seleccione una institución</option>';
    institucionesDisponibles.forEach(institucion => {
        const selected = (institucion.id_inst_formadora == capacitacion.id_institucion_guardado) ? 'selected' : '';
        optionsHtmlInstituciones += `<option value="${institucion.id_inst_formadora}" ${selected}>${institucion.descripcion_f}</option>`;
    });

    const displayOtrosCursos = (capacitacion.id_curso_guardado == '8') ? '' : 'display: none;';
    const displayOtrosInstitucion = (capacitacion.id_institucion_guardado == '5' || capacitacion.id_institucion_guardado == '6') ? '' : 'display: none;';

    const html = `
        <div class="capacitacion-item mb-3 p-3 border rounded" data-index="${index}">
            <h6>Capacitación ${index}</h6>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="required-field">Nombre del Curso</label>
                    <select id="id_curso_modal_${index}" class="form-control nombre-curso-select" required>
                        ${optionsHtmlCursos}
                    </select>
                </div>
                <div class="col-md-6 form-group" id="otros_cursos_container_modal_${index}" style="${displayOtrosCursos}">
                    <label class="required-field">Especifique el Curso</label>
                    <input type="text" id="nombre_curso_otro_modal_${index}" class="form-control nombre-curso-otro" value="${capacitacion.nombre_curso_otro || ''}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="required-field">Institución Formadora</label>
                    <select id="id_institucion_modal_${index}" class="form-control institucion-select" required>
                        ${optionsHtmlInstituciones}
                    </select>
                </div>
                <div class="col-md-6 form-group" id="otros_institucion_container_modal_${index}" style="${displayOtrosInstitucion}">
                    <label class="required-field">Especifique la Institución</label>
                    <input type="text" id="nombre_institucion_otro_modal_${index}" class="form-control institucion-otro" value="${capacitacion.nombre_institucion_otro || ''}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="required-field">Año</label>
                    <input type="text" id="anio_modal_${index}" class="form-control anio" value="${capacitacion.anio}" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Horas</label>
                    <input type="text" id="horas_modal_${index}" class="form-control horas" value="${capacitacion.horas || ''}">
                </div>
                <div class="col-md-4 form-group text-right">
                    <button type="button" class="btn btn-danger btn-sm mt-4 btn-eliminar-capacitacion-modal">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    `;
    
    $('#listaCapacitaciones').append(html);

    $(`#id_curso_modal_${index}`).on('change', function() {
        const selectedValue = $(this).val();
        if (selectedValue === '8') {
            $(`#otros_cursos_container_modal_${index}`).show().find('input').prop('required', true);
        } else {
            $(`#otros_cursos_container_modal_${index}`).hide().find('input').prop('required', false).val('');
        }
    }).trigger('change'); 

    $(`#id_institucion_modal_${index}`).on('change', function() {
        const selectedValue = $(this).val();
        if (selectedValue === '5' || selectedValue === '6') { 
            $(`#otros_institucion_container_modal_${index}`).show().find('input').prop('required', true);
        } else {
            $(`#otros_institucion_container_modal_${index}`).hide().find('input').prop('required', false).val('');
        }
    }).trigger('change'); 

    $(`#anio_modal_${index}`).on('input', function() {
        allowOnlyNumbers(this);
    });
    $(`#horas_modal_${index}`).on('input', function() {
        allowOnlyNumbers(this); 
    });

    $(`#${newId} .btn-eliminar-capacitacion-modal`).on('click', function() {
        $(this).closest('.capacitacion-item').remove();
        actualizarIndicesCapacitacionesModal();
    });
}

// Función para guardar curriculum
function guardarCurriculum(index) {
    const participante = cacheFormulario.participantes[index];
    
    // --- INICIO: VALIDACIÓN MANUAL DENTRO DEL MODAL ANTES DE GUARDAR CURRICULUM ---
    let isValidModal = true;
    let firstInvalidModalField = null;

    function showModalFieldError(fieldElement, message) {
        fieldElement.addClass('is-invalid');
        let feedbackDiv = fieldElement.siblings('.invalid-feedback');
        if (feedbackDiv.length === 0) {
            feedbackDiv = $('<div class="invalid-feedback d-block"></div>');
            fieldElement.after(feedbackDiv);
        }
        feedbackDiv.text(message).show();
        if (!firstInvalidModalField) {
            firstInvalidModalField = fieldElement;
        }
    }
    function clearModalFieldError(fieldElement) {
        fieldElement.removeClass('is-invalid');
        fieldElement.siblings('.invalid-feedback').text('').hide();
    }


    // 1. Validar campos básicos del curriculum
    const gradoInstruccionField = $('#grado_instruccion');
    if (gradoInstruccionField.val() === "") {
        showModalFieldError(gradoInstruccionField, 'El grado de instrucción es obligatorio.');
        isValidModal = false;
    } else { clearModalFieldError(gradoInstruccionField); }

    const tituloObtenidoField = $('#titulo_obtenido');
    if (tituloObtenidoField.val().trim() === '') {
        showModalFieldError(tituloObtenidoField, 'El título obtenido es obligatorio.');
        isValidModal = false;
    } else { clearModalFieldError(tituloObtenidoField); }

    const experienciaPublicasField = $('#experiencia_publicas');
    if (experienciaPublicasField.val().trim() !== '' && (!isInteger(experienciaPublicasField.val()) || parseInt(experienciaPublicasField.val()) < 0)) {
        showModalFieldError(experienciaPublicasField, 'Años de experiencia debe ser un número entero (0 o más).');
        isValidModal = false;
    } else { clearModalFieldError(experienciaPublicasField); }

    const tieneCapacitacionField = $('#tiene_capacitacion');
    if (tieneCapacitacionField.val() === '1') {
        const capacitacionesCount = $('#listaCapacitaciones .capacitacion-item').length;
        if (capacitacionesCount === 0) {
            Swal.fire('Atención', 'Debe agregar al menos una capacitación en Contrataciones Públicas para este participante.', 'warning');
            isValidModal = false;
        } else {
            // Validar cada capacitación individualmente en el modal
            $('#listaCapacitaciones .capacitacion-item').each(function(idx) {
                const currentCapacitacionItem = $(this);
                const idCursoField = currentCapacitacionItem.find('select[id*="id_curso_modal_"]'); // Usar ID parcial
                const nombreCursoOtroField = currentCapacitacionItem.find('input[id*="nombre_curso_otro_modal_"]');
                const idInstitucionFormadoraField = currentCapacitacionItem.find('select[id*="id_institucion_modal_"]'); // Usar ID parcial
                const nombreInstitucionFormadoraOtroField = currentCapacitacionItem.find('input[id*="nombre_institucion_otro_modal_"]');
                const anioField = currentCapacitacionItem.find('input[id*="anio_modal_"]');
                const horasField = currentCapacitacionItem.find('input[id*="horas_modal_"]');

                if (idCursoField.val() === "") {
                    showModalFieldError(idCursoField, `Seleccione un curso para la capacitación #${idx + 1}.`);
                    isValidModal = false;
                } else {
                    clearModalFieldError(idCursoField);
                    if (idCursoField.val() === '8' && nombreCursoOtroField.val().trim() === '') {
                        showModalFieldError(nombreCursoOtroField, `Especifique el nombre del curso para la capacitación #${idx + 1}.`);
                        isValidModal = false;
                    } else { clearModalFieldError(nombreCursoOtroField); }
                }

                if (idInstitucionFormadoraField.val() === "") {
                    showModalFieldError(idInstitucionFormadoraField, `Seleccione una institución formadora para la capacitación #${idx + 1}.`);
                    isValidModal = false;
                } else {
                    clearModalFieldError(idInstitucionFormadoraField);
                    if ((idInstitucionFormadoraField.val() === '5' || idInstitucionFormadoraField.val() === '6') && nombreInstitucionFormadoraOtroField.val().trim() === '') {
                        showModalFieldError(nombreInstitucionFormadoraOtroField, `Especifique la institución formadora para la capacitación #${idx + 1}.`);
                        isValidModal = false;
                    } else { clearModalFieldError(nombreInstitucionFormadoraOtroField); }
                }

                const anioValue = parseInt(anioField.val());
                const currentYear = new Date().getFullYear();
                if (!isInteger(anioField.val()) || isNaN(anioValue) || anioValue < 1900 || anioValue > currentYear) {
                    showModalFieldError(anioField, `Ingrese un año válido para la capacitación #${idx + 1} (ej. 1900-${currentYear}).`);
                    isValidModal = false;
                } else { clearModalFieldError(anioField); }
                
                if (horasField.val().trim() !== '' && (!isInteger(horasField.val()) || parseInt(horasField.val()) < 0)) {
                    showModalFieldError(horasField, `Ingrese un número válido de horas para la capacitación #${idx + 1}.`);
                    isValidModal = false;
                } else { clearModalFieldError(horasField); }
            });
        }
    }

    if (!isValidModal) {
        if (firstInvalidModalField) {
            // Asegúrate de que el modal esté visible antes de intentar scrollear o enfocar
            $('#modalCurriculum').animate({
                scrollTop: firstInvalidModalField.offset().top - $('#modalCurriculum .modal-content').offset().top - 50 // Ajusta el offset dentro del modal
            }, 500);
            firstInvalidModalField.focus();
        }
        return; // Detener si la validación del modal falla
    }

    // Actualizar datos curriculares en el cache
    participante.curriculum = {
        grado_instruccion: gradoInstruccionField.val(),
        titulo_obtenido: tituloObtenidoField.val(),
        experiencia_publicas: experienciaPublicasField.val() || 0,
        tiene_capacitacion: tieneCapacitacionField.val(),
        capacitaciones: []
    };
    
    // Recoger capacitaciones (con los nuevos campos)
    $('#listaCapacitaciones .capacitacion-item').each(function() {
        const currentCapacitacionItem = $(this);
        const idCurso = currentCapacitacionItem.find('select[id*="id_curso_modal_"]').val();
        const nombreCursoOtro = currentCapacitacionItem.find('input[id*="nombre_curso_otro_modal_"]').val();
        const idInstitucion = currentCapacitacionItem.find('select[id*="id_institucion_modal_"]').val();
        const nombreInstitucionOtro = currentCapacitacionItem.find('input[id*="nombre_institucion_otro_modal_"]').val();
        const anio = currentCapacitacionItem.find('input[id*="anio_modal_"]').val();
        const horas = currentCapacitacionItem.find('input[id*="horas_modal_"]').val();

        // Determinar el nombre final del curso para mostrar en resumen o enviar al backend
        let nombreCursoFinal = '';
        const cursoEncontrado = cursosDisponibles.find(c => c.id_cursos == idCurso);
        if (idCurso == '8') {
            nombreCursoFinal = nombreCursoOtro;
        } else if (cursoEncontrado) {
            nombreCursoFinal = cursoEncontrado.descripcion_cursos;
        }

        // Determinar el nombre final de la institución para mostrar en resumen o enviar al backend
        let institucionFinal = '';
        const instEncontrada = institucionesDisponibles.find(inst => inst.id_inst_formadora == idInstitucion);
        if (idInstitucion == '5' || idInstitucion == '6') {
            institucionFinal = nombreInstitucionOtro;
        } else if (instEncontrada) {
            institucionFinal = instEncontrada.descripcion_f;
        }

        participante.curriculum.capacitaciones.push({
            id_curso_guardado: idCurso,
            nombre_curso: nombreCursoFinal,
            nombre_curso_otro: nombreCursoOtro,
            id_institucion_guardado: idInstitucion,
            institucion: institucionFinal,
            nombre_institucion_otro: nombreInstitucionOtro,
            anio: anio,
            horas: horas
        });
    });
    
    // Cerrar modal y actualizar vista
    $('#modalCurriculum').modal('hide');
    generarResumen();
    actualizarListaParticipantes();
}

// Función para actualizar lista de participantes
function actualizarListaParticipantes() {
    const lista = $('#lista-participantes');
    lista.empty();
    
    cacheFormulario.participantes.forEach((p, index) => {
        const gradoAcademicoTexto = clasificacionData.find(g => g.id_academico == p.curriculum.grado_instruccion)?.desc_academico || 'No especificado';

        lista.append(`
            <div class="participante-item mb-3 p-3 border rounded">
                <div class="d-flex justify-content-between">
                    <h6>${p.nombres} ${p.apellidos} <small>(C.I. ${p.cedula})</small></h6>
                    <div>
                        <button class="btn btn-sm btn-info mr-2" onclick="mostrarModalCurriculum(${index})">
                            <i class="fas fa-graduation-cap"></i> Curriculum
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarParticipante(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div><strong>Teléfono:</strong> ${p.telefono || 'No especificado'}</div>
                <div><strong>Grado Inst.:</strong> ${gradoAcademicoTexto}</div>
                <div><strong>Título Obtenido:</strong> ${p.curriculum.titulo_obtenido || 'No especificado'}</div>
                <div><strong>Exp. Contrataciones:</strong> ${p.curriculum.experiencia_publicas || 0} años</div>
                ${p.curriculum.tiene_capacitacion === '1' && p.curriculum.capacitaciones.length > 0 ? 
                    '<div><strong>Capacitaciones:</strong><ul>' + 
                    p.curriculum.capacitaciones.map(c => 
                        `<li>${c.nombre_curso} - ${c.institucion} (${c.anio})</li>`
                    ).join('') + '</ul></div>' : ''}
            </li>
        `);
    });
}

// Función para eliminar participante
function eliminarParticipante(index) {
    cacheFormulario.participantes.splice(index, 1);
    actualizarListaParticipantes();
}

// Función para guardar paso actual
function guardarPasoActual(paso) {
    switch(paso) {
        case 1:
            // Validar datos de la empresa
            const rifEmpresa = $('#rif').val().trim();
            if (!rifEmpresa) {
                Swal.fire('Error', 'El RIF de la empresa es requerido', 'error');
                return false;
            }

            
            cacheFormulario.empresa = {
                rif: rifEmpresa,
                razon_social: $('#razon_social').val(),
                es_ente: $('#ente').val(),
                telefono: $('#tel_local').val(),
                direccion: $('#direccion_fiscal').val()
            };
            break;
            
        case 2:
            // Validar que al menos haya un participante
            if (cacheFormulario.participantes.length === 0) {
                alert('Debe agregar al menos un participante');
                return false;
            }
            
            // Validar que todos los participantes tengan curriculum completo
            for (let i = 0; i < cacheFormulario.participantes.length; i++) {
                const p = cacheFormulario.participantes[i];
                if (!p.curriculum.grado_instruccion || !p.curriculum.titulo_obtenido) {
                    alert(`El participante ${p.nombres} ${p.apellidos} no tiene información curricular completa`);
                    mostrarModalCurriculum(i);
                    return false;
                }
                
                if (p.curriculum.tiene_capacitacion === '1' && p.curriculum.capacitaciones.length === 0) {
                    alert(`El participante ${p.nombres} ${p.apellidos} debe tener al menos una capacitación`);
                    mostrarModalCurriculum(i);
                    return false;
                }
            }
            break;
    }
    return true;
}

// Función para cargar paso
function cargarPaso(paso) {
    switch (paso) {
        case 3:
            generarResumen();
            break;
    }
}

// Función para generar resumen
function generarResumen() {
    // Resumen empresa
    let html = `<div class="card mb-3">
        <div class="card-header"><h5>Datos de la Empresa</h5></div>
        <div class="card-body">
            <p><strong>RIF:</strong> ${cacheFormulario.empresa.rif}</p>
            <p><strong>Razón Social:</strong> ${cacheFormulario.empresa.razon_social}</p>
            <p><strong>Teléfono:</strong> ${cacheFormulario.empresa.telefono}</p>
            <p><strong>Dirección:</strong> ${cacheFormulario.empresa.direccion}</p>
        </div>
    </div>`;
    $('#resumen-empresa').html(html);
    
    // Resumen participantes
    html = '<div class="card"><div class="card-header"><h5>Participantes</h5></div><div class="card-body"><ul class="list-group">';
    
    cacheFormulario.participantes.forEach((p, i) => {
        html += `
            <li class="list-group-item mb-3">
                <div class="d-flex justify-content-between">
                    <h6>${p.nombres} ${p.apellidos} <small>(C.I. ${p.cedula})</small></h6>
                    <button class="btn btn-sm btn-info" onclick="mostrarModalCurriculum(${i})">
                        <i class="fas fa-edit"></i> Editar Curriculum
                    </button>
                </div>
                <div><strong>Título:</strong> ${p.curriculum.titulo_obtenido || 'No especificado'}</div>
                <div><strong>Experiencia:</strong> ${p.curriculum.experiencia_publicas || 0} años</div>
                ${p.curriculum.capacitaciones.length > 0 ? 
                    '<div><strong>Capacitaciones:</strong><ul>' + 
                    p.curriculum.capacitaciones.map(c => 
                        `<li>${c.nombre_curso} - ${c.institucion} (${c.anio})</li>`
                    ).join('') + '</ul></div>' : ''}
            </li>
        `;
    });
    
    html += '</ul></div></div>';
    $('#resumen-participantes').html(html);
}  function enviarDatos() {
    // Validar que haya participantes
    if (cacheFormulario.participantes.length === 0) {
        Swal.fire('Error', 'Debe incluir al menos un participante', 'error');
        return;
    }

    // Crear FormData en lugar de objeto JSON
    const formData = new FormData();
    formData.append('id_diplomado', $('#id_diplomado').val());
    formData.append('rif', $('#rif').val().trim().toUpperCase().replace(/[^JGVEP0-9]/g, ''));
    formData.append('razon_social', $('#razon_social').val());
    formData.append('tel_local', $('#tel_local').val());
    formData.append('direccion_fiscal', $('#direccion_fiscal').val());
    formData.append('ente', $('#ente').val());

    // Agregar participantes
    cacheFormulario.participantes.forEach((p, index) => {
        formData.append(`participantes[${index}][cedula]`, p.cedula);
        formData.append(`participantes[${index}][nombres]`, p.nombres);
        formData.append(`participantes[${index}][apellidos]`, p.apellidos);
        formData.append(`participantes[${index}][telefono]`, p.telefono);
        formData.append(`participantes[${index}][direccion]`, p.direccion || 'Sin dirección');
        formData.append(`participantes[${index}][grado_instruccion]`, p.curriculum.grado_instruccion);
        formData.append(`participantes[${index}][titulo_obtenido]`, p.curriculum.titulo_obtenido);
        formData.append(`participantes[${index}][t_contrata_p]`, p.curriculum.experiencia_publicas ? '1' : '0');
        formData.append(`participantes[${index}][experiencia_publicas]`, p.curriculum.experiencia_publicas || 0);
        formData.append(`participantes[${index}][tiene_capacitacion]`, p.curriculum.tiene_capacitacion);

        // Agregar capacitaciones si existen
        // Agregar capacitaciones si existen
        if (p.curriculum.capacitaciones?.length > 0) {
            p.curriculum.capacitaciones.forEach((c, capIndex) => {
                // Aquí usamos los IDs y los nombres "otros" que guardamos en el cacheFormulario
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][id_curso]`, c.id_curso_guardado);
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][nombre_curso_otro]`, c.nombre_curso_otro);
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][id_institucion_formadora]`, c.id_institucion_guardado);
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][nombre_institucion_formadora_otro]`, c.nombre_institucion_otro);
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][anio]`, c.anio);
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][horas]`, c.horas);
            });
        }
    });
    // URL para enviar los datos
    // var base_url = window.location.origin + '/asnc/index.php/Diplomado/guardar_inscripcion_persona_juridica';
    //  var base_url3 = window.location.origin + '/asnc/index.php/Prei_juridico/pdfrt?id=';
    //  var base_url2 = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; //redirigir
     var base_url = '/index.php/Diplomado/guardar_inscripcion_persona_juridica';
     var base_url3 = '/index.php/Prei_juridico/pdfrt?id=';
     var base_url2 = '/index.php/Diplomado/preinscrip';



     
    // Enviar datos al servidor
    $.ajax({
        url: base_url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#btn-finalizar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Procesando...');
        },
        success: function(response) {
       if (response.success) {
        Swal.fire({
            title: 'Éxito',
            html: `Inscripción registrada correctamente para ${response.total_participantes} participantes.<br><br>
                  <strong>Código de planilla:</strong> ${response.codigo_planilla}`,
            icon: 'success'
        }).then(() => {
            window.location.href = base_url3 + response.codigo_planilla;

        });
        setTimeout(function() {
        window.location.href = base_url2 ; // Asegúrate que esta sea la ruta correcta
    }, 9000);
    } else {
                Swal.fire('Error', response.message || 'Error al procesar la solicitud', 'error');
                $('#btn-finalizar').prop('disabled', false).html('Finalizar Inscripción');
            }
        },
        error: function(xhr, status, error) {
          Swal.fire('Error', 'Ocurrió un error al comunicarse con el servidor: ' + error, 'error');
            $('#btn-finalizar').prop('disabled', false).html('Finalizar Inscripción');
        }
    });
}
// Inicialización cuando el documento está listo
$(document).ready(function() {
    // Cargar catálogos al inicio
    cargarCursosModal(); // Asegúrate de llamar a esta función
    cargarInstituciones(); // Asegúrate de llamar a esta función
    // Navegación entre pasos
    $('.next-step').click(function() {
        const nextStep = $(this).data('next');
        const currentStep = $(this).closest('.step').attr('id');

        if (!currentStep) {
            console.error("No se pudo identificar el paso actual");
            return;
        }

        if (guardarPasoActual(parseInt(currentStep.split('-')[1]))) {
            $(`.step`).hide();
            $(`#step-${nextStep}`).show();
            cargarPaso(nextStep);
        }
    });

    $('.prev-step').click(function() {
        const prevStep = $(this).data('prev');
        $(`.step`).hide();
        $(`#step-${prevStep}`).show();
    });

    // Agregar participante
    $('#btn-agregar-participante').click(agregarParticipante);

    // Finalizar inscripción
    $('#btn-finalizar').click(enviarDatos);
});    