// Objeto para almacenar todos los datos en cache
const cacheFormulario = {
    empresa: {},
    participantes: []
};

// Función para cargar información del diplomado
function loadDiplomadoInfo(idDiplomado) {
    if(idDiplomado == 0) {
        $('#diplomadoInfoContainer').hide();
        return;
    }
					var base_url = '/index.php/Diplomado/getDiplomadoInfo/' + idDiplomado;
    
    // var base_url = window.location.origin+'/asnc/index.php/diplomado/getDiplomadoInfo/' + idDiplomado;
        
    $.ajax({
        url: base_url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                $('#diplomadoTitle').text(response.data.name_d);
                $('#diplomadoFechaInicio').text(formatDate(response.data.fdesde));
                $('#diplomadoFechaFin').text(formatDate(response.data.fhasta));
                $('#diplomadoModalidad').text(getModalidadText(response.data.id_modalidad));
                $('#diplomadoM').text(response.data.pay);

                // Calcular duración
                const fechaInicio = new Date(response.data.fdesde);
                const fechaFin = new Date(response.data.fhasta);
                const diffTime = Math.abs(fechaFin - fechaInicio);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                
                $('#diplomadoDuracion').text(diffDays + ' días');
                $('#diplomadoInfoContainer').show();
            } else {
                alert('Error al cargar la información del diplomado');
                $('#diplomadoInfoContainer').hide();
            }
        },
        error: function() {
            alert('Error en la conexión con el servidor');
            $('#diplomadoInfoContainer').hide();
        }
    });
}

// Función para formatear fechas
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('es-ES', options);
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

// Función para agregar participantes
function agregarParticipante() {
    // Validar campos básicos
    const cedula = $('#cedula').val();
    const nombres = $('#nombres').val();
    const apellidos = $('#apellidos').val();
    const telefono = $('#tel_part').val();
    
    if (!cedula || !nombres || !apellidos) {
        Swal.fire('Error', 'Por favor complete los campos obligatorios (Cédula, Nombres y Apellidos)', 'error');
        return;
    }

    // Crear objeto con datos del participante
    const participante = {
        cedula: cedula,
        nombres: nombres,
        apellidos: apellidos,
        telefono: telefono,
        curriculum: {
            grado_instruccion: '',
            titulo_obtenido: '',
            experiencia_publicas: 0,
            tiene_capacitacion: '0',
            capacitaciones: []
        }
    };

    // Agregar al cache
    cacheFormulario.participantes.push(participante);
    
    // Mostrar modal para información curricular
    mostrarModalCurriculum(cacheFormulario.participantes.length - 1);
    
    // Limpiar formulario
    $('#cedula, #nombres, #apellidos, #tel_part').val('');

    // Mostrar mensaje de éxito
    Swal.fire('Éxito', 'Participante agregado. Complete sus datos curriculares.', 'success');
    
    // Actualizar lista de participantes
    actualizarListaParticipantes();
}

// Función para mostrar modal de curriculum
function mostrarModalCurriculum(index) {
    const participante = cacheFormulario.participantes[index];
    
    // Configurar modal
    $('#modalCurriculumLabel').text(`Curriculum - ${participante.nombres} ${participante.apellidos}`);
    $('#modalCedula').text(participante.cedula);
    $('#grado_instruccion').val(participante.curriculum.grado_instruccion);
    $('#titulo_obtenido').val(participante.curriculum.titulo_obtenido);
    $('#experiencia_publicas').val(participante.curriculum.experiencia_publicas);
    $('#tiene_capacitacion').val(participante.curriculum.tiene_capacitacion);
    
    // Mostrar/ocultar sección de capacitaciones según valor actual
    toggleSeccionCapacitaciones(participante.curriculum.tiene_capacitacion);
    
    // Limpiar y cargar capacitaciones
    $('#listaCapacitaciones').empty();
    participante.curriculum.capacitaciones.forEach((cap, i) => {
        agregarCapacitacionHTML(i + 1, cap);
    });
    
    // Evento para mostrar/ocultar capacitaciones al cambiar el select
    $('#tiene_capacitacion').off('change').on('change', function() {
        toggleSeccionCapacitaciones($(this).val());
    });
    
    // Configurar botón de guardar
    $('#btnGuardarCurriculum').off('click').on('click', function() {
        guardarCurriculum(index);
    });
    
    // Mostrar modal
    $('#modalCurriculum').modal('show');
}

// Función para mostrar/ocultar la sección de capacitaciones
function toggleSeccionCapacitaciones(valor) {
    $('#seccionCapacitaciones').toggle(valor === '1');
}

// Función para guardar curriculum
function guardarCurriculum(index) {
    const participante = cacheFormulario.participantes[index];
    
    // Actualizar datos curriculares
    participante.curriculum = {
        grado_instruccion: $('#grado_instruccion').val(),
        titulo_obtenido: $('#titulo_obtenido').val(),
        experiencia_publicas: $('#experiencia_publicas').val() || 0,
        tiene_capacitacion: $('#tiene_capacitacion').val(),
        capacitaciones: []
    };
    
    // Recoger capacitaciones
    $('#listaCapacitaciones .capacitacion-item').each(function() {
        participante.curriculum.capacitaciones.push({
            nombre_curso: $(this).find('.nombre-curso').val(),
            institucion: $(this).find('.institucion').val(),
            anio: $(this).find('.anio').val()
        });
    });
    
    // Cerrar modal y actualizar vista
    $('#modalCurriculum').modal('hide');
    generarResumen();
    actualizarListaParticipantes();
}

// Función para agregar capacitación
function agregarCapacitacion() {
    const lista = $('#listaCapacitaciones');
    const count = lista.children().length;
    
    if (count >= 3) {
        alert('Máximo 3 capacitaciones por participante');
        return;
    }
    
    agregarCapacitacionHTML(count + 1, { nombre_curso: '', institucion: '', anio: '' });
}

// Función para agregar HTML de capacitación
function agregarCapacitacionHTML(index, capacitacion) {
    const html = `
        <div class="capacitacion-item mb-3 p-3 border rounded" data-index="${index}">
            <h6>Capacitación ${index}</h6>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Nombre del Curso</label>
                    <input type="text" class="form-control nombre-curso" value="${capacitacion.nombre_curso}" required>
                </div>
                <div class="col-md-4 form-group">
                    <label>Institución</label>
                    <input type="text" class="form-control institucion" value="${capacitacion.institucion}" required>
                </div>
                <div class="col-md-3 form-group">
                    <label>Año</label>
                    <input type="number" class="form-control anio" value="${capacitacion.anio}" min="1900" max="${new Date().getFullYear()}" required>
                </div>
                <div class="col-md-1 form-group">
                    <button type="button" class="btn btn-danger btn-sm mt-4" onclick="$(this).closest('.capacitacion-item').remove()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    
    $('#listaCapacitaciones').append(html);
}

// Función para actualizar lista de participantes
function actualizarListaParticipantes() {
    const lista = $('#lista-participantes');
    lista.empty();
    
    cacheFormulario.participantes.forEach((p, index) => {
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
                <div><strong>Teléfono:</strong> ${p.telefono}</div>
            </div>
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
}

// Función para enviar datos al servidor
// function enviarDatos() {
    
//     // Validar que haya participantes
//     if (cacheFormulario.participantes.length === 0) {
//         Swal.fire('Error', 'Debe incluir al menos un participante', 'error');
//         return;
//     }

//        // 1. Validar RIF
//         const rif = $('#rif').val().trim().toUpperCase().replace(/[^JGVEP0-9]/g, '');
//     if (!rif) {
//         Swal.fire('Error', 'El RIF de la empresa es requerido', 'error');
//         return;
//     }
//           // Formatear RIF (mayúsculas y solo caracteres válidos)
//     const rifFormateado = rif.toUpperCase().replace(/[^JGVEP0-9]/g, '');


//     // Validar curriculum completo para todos los participantes
//     let curriculumCompleto = true;
//     cacheFormulario.participantes.forEach(p => {
//         if (!p.curriculum.grado_instruccion || !p.curriculum.titulo_obtenido) {
//             curriculumCompleto = false;
//         }
        
//         if (p.curriculum.tiene_capacitacion === '1' && p.curriculum.capacitaciones.length === 0) {
//             curriculumCompleto = false;
//         }
//     });
    
//     if (!curriculumCompleto) {
//         Swal.fire('Error', 'Todos los participantes deben tener información curricular completa', 'error');
//         return;
//     }

//     const formData = {
//         id_diplomado: $('#id_diplomado').val(),
//         rif: rif, // Usamos la variable ya formateada
//         razon_social: $('#razon_social').val(),
//         tel_local: $('#tel_local').val(),
//         direccion_fiscal: $('#direccion_fiscal').val(),
//         ente: $('#ente').val(),
//         participantes: cacheFormulario.participantes.map(p => {
//             const participante = {
//                 cedula: p.cedula,
//                 nombres: p.nombres,
//                 apellidos: p.apellidos,
//                 telefono: p.telefono,
//                 direccion: p.direccion || 'Sin dirección', // Campo requerido
//                 grado_instruccion: p.curriculum.grado_instruccion,
//                 titulo_obtenido: p.curriculum.titulo_obtenido,
//                 t_contrata_p: p.curriculum.experiencia_publicas ? '1' : '0',
//                 experiencia_publicas: p.curriculum.experiencia_publicas || 0,
//                 tiene_capacitacion: p.curriculum.tiene_capacitacion
//             };

//             // Solo agregar capacitaciones si existen
//             if (p.curriculum.capacitaciones?.length > 0) {
//                 participante.capacitaciones = p.curriculum.capacitaciones.map(c => ({
//                     nombre_curso: c.nombre_curso,
//                     institucion: c.institucion,
//                     anio: c.anio
//                 }));
//             }

//             return participante;
//         })
//     };
//      // 4. Depuración (opcional)
//     console.log('Datos enviados:', JSON.stringify(formData, null, 2));

//     console.log('Datos a enviar:', formData);

//     // URL para enviar los datos
//     var base_url = window.location.origin + '/asnc/index.php/Diplomado/guardar_inscripcion_persona_juridica';
//     var base_url3 = window.location.origin + '/asnc/index.php/Preinscripcionnatural/pdfrt?id=';

//     // Enviar datos al servidor
//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         contentType: 'application/json',
//         data: JSON.stringify(formData),
//         beforeSend: function() {
//             $('#btn-finalizar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Procesando...');
//         },
//         success: function(response) {
//             if (response.success) {
//                 let mensaje = `Inscripción registrada correctamente para ${response.total_participantes} participantes.<br><br>`;
                
//                 if (response.codigos_planilla && response.codigos_planilla.length > 0) {
//                     mensaje += '<strong>Códigos de planilla generados:</strong><ul>';
//                     response.codigos_planilla.forEach(codigo => {
//                         mensaje += `<li>${codigo}</li>`;
//                     });
//                     mensaje += '</ul>';
//                 }
                
//                 Swal.fire({
//                     title: 'Éxito',
//                     html: mensaje,
//                     icon: 'success'
//                 }).then(() => {
//                     // Redirección después de guardar
//                     window.location.href = base_url3 + response.codigo_principal;
//                 });
//             } else {
//                 Swal.fire('Error', response.message || 'Error al procesar la solicitud', 'error');
//                 $('#btn-finalizar').prop('disabled', false).html('Finalizar Inscripción');
//             }
//         },
//         error: function(xhr, status, error) {
//             Swal.fire('Error', 'Ocurrió un error al comunicarse con el servidor: ' + error, 'error');
//             $('#btn-finalizar').prop('disabled', false).html('Finalizar Inscripción');
//         }
//     });
// }


function enviarDatos() {
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
        if (p.curriculum.capacitaciones?.length > 0) {
            p.curriculum.capacitaciones.forEach((c, capIndex) => {
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][nombre_curso]`, c.nombre_curso);
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][institucion]`, c.institucion);
                formData.append(`participantes[${index}][capacitaciones][${capIndex}][anio]`, c.anio);
            });
        }
    });

    // URL para enviar los datos
    // var base_url = window.location.origin + '/asnc/index.php/Diplomado/guardar_inscripcion_persona_juridica';
    //  var base_url3 = window.location.origin + '/asnc/index.php/Prei_juridico/pdfrt?id=';
    //     var base_url2 = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; //redirigir

					var base_url = '/index.php/Diplomado/guardar_inscripcion_persona_juridica';
					var base_url3 = '/index.php/Diplomado/Prei_juridico/pdfrt?id=';
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
         // Redirigir después de 2 segundos
    setTimeout(function() {
        window.location.href = base_url2 ; // Asegúrate que esta sea la ruta correcta
    }, 8000);
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