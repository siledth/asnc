function modal(id) {
    var id_inf_academ = id;
        var base_url =window.location.origin+'/asnc/index.php/Comision_contrata/consulta_infomr_acade_miembro';
        var base_url2 =window.location.origin+'/asnc/index.php/Comision_contrata/llenar_forma_aca_mod';
        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';

        // var base_url = '/index.php/Programacion/consultar_item_modal_bienes';
        //  var base_url2 = '/index.php/ccccc';
        // var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url7 = '/index.php/Programacion/llenar_ff_';
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_inf_academ: id_inf_academ },
        dataType: "json",
        success: function(data) {
            $('#id_inf_academ').val(id);
            $("#id_miembros").val(data["id_miembros"]);
             $("#id_academico").val(data["id_academico"]);
             $("#id_comision").val(data["id_comision"]);
             $("#fm_ac1").val(data["desc_academico"]);
             $("#titulo").val(data["titulo"]);
             $("#anioi").val(data["anio_inicio"]);
             $("#anioc").val(data["anio_fin"]);
            //  $("#desc_ccnu").val(data["desc_ccnu"]);
            // $("#especificacion").val(data["especificacion"]);
            // $('#id_unid_med_b').val(data['id_unidad_medida']);
            // $('#unid_med_b').val(data['desc_unidad_medida']);

            // $('#id_ff_b').val(data['id_fuente_financiamiento']);
            // $('#ff_b').val(data['desc_fuente_financiamiento']);


//  llena el select de unidad de medida
            var id_academico = data['id_academico'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_academico: id_academico},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#camb_id_academico').append('<option value="'+data['id_academico']+'">'+data['desc_academico']+'</option>');
                    });
                }
            })
 
        },
    });
}
function save_modif_inf_acad(){

    var anioi = $("#anioi").val();        
        if (  anioi <= 1920) {
            swal.fire({
                title: 'número mayor que cero, intente de nuevo',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
           // return false; // no dejar guardar
        }
          
        else{
    event.preventDefault();

    swal.fire({
        title: '¿Seguro que desea guardar el registro?  ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_inf_academ = $('#id_inf_academ').val();
            var id_academico = $('#id_academico').val();
            var camb_id_academico = $('#camb_id_academico').val();
            var titulo = $('#titulo').val();
            var anioi = $('#anioi').val();
            var anioc = $('#anioc').val();
        var base_url =window.location.origin+'/asnc/index.php/Comision_contrata/editar_informacion_academica';

            // var base_url = '/index.php/Programacion/editar_fila_ip_b';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_inf_academ: id_inf_academ,
                    id_academico: id_academico,
                    camb_id_academico: camb_id_academico,
                    titulo: titulo,
                    anioi:anioi,
                    anioc:anioc,

                    
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se Modificó la información con exito.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        }
    });
}
}

function modal_exp(id) {
    var id_inf_exp5 = id;
        var base_url =window.location.origin+'/asnc/index.php/Comision_contrata/consulta_infomr_modal_exp_miembro';
       var base_url2 =window.location.origin+'/asnc/index.php/Comision_contrata/llenar_ente';

        // var base_url3 =window.location.origin+'/asnc/index.php/Programacion/llenar_alic_iva_mod';

        // var base_url = '/index.php/Programacion/consultar_item_modal_bienes';
        //  var base_url2 = '/index.php/ccccc';
        // var base_url3 = '/index.php/Programacion/llenar_alic_iva_mod';
        // var base_url7 = '/index.php/Programacion/llenar_ff_';
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_inf_exp5: id_inf_exp5 },
        dataType: "json",
        success: function(data) {
            $('#id_inf_exp5').val(id);
            $("#arif").val(data["rif"]);
            $("#descripcion").val(data["descripcion"]);
            $("#area").val(data["areas"]);
             $("#cargo").val(data["cargo"]);
             $("#id_comision").val(data["id_comision"]);
             $("#desde").val(data["desde"]);
             $("#hasta").val(data["hasta"]);

               var rif = data['rif'];
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {rif: rif},
                dataType: 'json',
                success: function(data){
                    $.each(data, function(index, data){
                        $('#cam_org').append('<option value="'+data['rif']+'">'+data['descripcion']+'</option>');
                    });
                }
            })
         
 
        },
    });
}

function save_modif_exp(){

   // var anioi = 2024       
        if ( area == '') {
            swal.fire({
                title: 'no puede dejar campos vacios , intente de nuevo',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value == true) {
                }
            });
           // return false; // no dejar guardar
        }
          
        else{
    event.preventDefault();

    swal.fire({
        title: '¿Seguro que desea guardar el registro?  ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_inf_exp5 = $('#id_inf_exp5').val();
            var arif = $('#arif').val();
            var cam_org = $('#cam_org').val();
            var areas = $('#area').val();
            var cargo = $('#cargo').val();
            var desde = $('#desde').val();
            var hasta = $('#hasta').val();
        // var base_url =window.location.origin+'/asnc/index.php/Comision_contrata/editar_modal_exp_miembro';
            var base_url = '/index.php/Comision_contrata/editar_modal_exp_miembro';

            // var base_url = '/index.php/Programacion/editar_fila_ip_b';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_inf_exp5: id_inf_exp5,
                    arif: arif,
                    cam_org: cam_org,
                    areas: areas,
                    cargo:cargo,
                    desde:desde,
                    hasta:hasta                    
                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se Modificó la información con exito.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        }
    });
}
}


function save_formacion_cp() {
    event.preventDefault();

    swal.fire({
        title: '¿Guardar?',
        text: '¿Deseas guardar la información de capacitación en contratación pública?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, Guardar!'
    }).then((result) => {
        if (result.value == true) {
            // Obtener los valores de los campos ocultos y visibles del modal
            var id_comision_cp = $('#id_comision_cp').val(); // ID de la comisión si aplica
            var cedula_cp = $('#cedula_cp').val(); // Cédula del miembro
            var nro_comprobante_cp = $('#nro_comprobante_cp').val(); // Número de comprobante

            var taller = $('#taller').val();
            var institucion = $('#institucion').val();
            var hor_dura = $('#hor_dura').val();
            var certi = $('#certi').val();
            var fech_cert = $('#fech_cert').val();
            var vigencia = $('#vigencia').val(); // Este campo es readonly, asegúrate de que se calcule en el front o back

            // Validaciones básicas (puedes añadir más según tus necesidades)
            if (taller === '') {
                Swal.fire('Atención', 'El campo "Taller o Curso" no puede estar vacío.', 'warning');
                $('#taller').focus();
                return false;
            }
            if (institucion === '') {
                Swal.fire('Atención', 'El campo "Institución" no puede estar vacío.', 'warning');
                $('#institucion').focus();
                return false;
            }
            if (hor_dura === '' || parseInt(hor_dura) <= 0) {
                Swal.fire('Atención', 'El campo "Horas de Duración" no puede estar vacío y debe ser mayor que cero.', 'warning');
                $('#hor_dura').focus();
                return false;
            }
            if (certi === '') {
                Swal.fire('Atención', 'El campo "N.º del Certificado" no puede estar vacío.', 'warning');
                $('#certi').focus();
                return false;
            }
            if (fech_cert === '') {
                Swal.fire('Atención', 'El campo "Fecha Certificado" no puede estar vacío.', 'warning');
                $('#fech_cert').focus();
                return false;
            }
             
            var base_url = '/index.php/certificacion/save_formacion_cp';
           
            // var base_url = window.location.origin + '/asnc/index.php/Certificacion/save_formacion_cp';  

            $.ajax({
                url: base_url,
                method: 'POST',
                data: {
                    id_comision: id_comision_cp, // Si necesitas pasar el id de la comisión principal
                    cedula: cedula_cp,
                    nro_comprobante: nro_comprobante_cp,
                    taller: taller,
                    institucion: institucion,
                    hor_dura: hor_dura,
                    certi: certi,
                    fech_cert: fech_cert,
                    vigencia: vigencia
                },
                dataType: 'json',
                success: function(response) {
                    if (response == 1) { // Asumiendo que el controlador devuelve 1 para éxito
                        swal.fire({
                            title: '¡Guardado!',
                            text: 'La información de capacitación se ha guardado correctamente.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload(); // Recargar la página para ver los cambios
                            }
                        });
                    } else {
                        swal.fire({
                            title: 'Error',
                            text: 'No se pudo guardar la información de capacitación. Intente de nuevo.',
                            type: 'error'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error: ", textStatus, errorThrown);
                    console.log(jqXHR.responseText); // Muestra la respuesta del servidor para depuración
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'Ocurrió un error al procesar la solicitud. Por favor, intente de nuevo.'
                    });
                }
            });
        }
    });
}

// **Función para preparar el modal de Capacitación en Contratación Pública**
// DEBES LLAMAR A ESTA FUNCIÓN CUANDO SE ABRE EL MODAL (en el onclick del botón)
function prepareContratacionPublicaModal(id_miembro, cedula, nro_comprobante) {
    // Llenar los campos ocultos del modal con los datos del miembro
    $('#id_comision_cp').val(id_miembro); // Si 'id_comision' es el ID del miembro de infor_per_natu
    $('#cedula_cp').val(cedula);
    $('#nro_comprobante_cp').val(nro_comprobante);

    // Limpiar campos del formulario cada vez que se abre el modal para agregar
    $('#form_add_contratacion_publica')[0].reset();
    // Si tienes selects que necesitan reiniciarse a su valor por defecto:
    // $('#some_select').val('0').trigger('change');
}

 function calculateVigencia() {
    const fechCertInput = $('#fech_cert'); // Mantiene el ID original
    const vigenciaInput = $('#vigencia');
    const fechaCertificadoStr = fechCertInput.val();

    // Resetear el estado visual y de valor antes de cualquier cálculo
    vigenciaInput.val('');
    vigenciaInput.css('border', '');

    if (fechaCertificadoStr) {
        // Usar Moment.js para parsear la fecha. No necesitamos new Date() explícito si Moment.js es el parser.
        const momentFechaCert = moment(fechaCertificadoStr);

        // --- AQUI LA MEJORA CLAVE: Validar si la fecha es realmente válida ANTES de calcular ---
        if (!momentFechaCert.isValid()) {
            // Si la fecha no es válida (ej. incompleta como "202"), NO MOSTRAMOS ALERTAS de negocio.
            // Simplemente no calculamos y dejamos el campo de vigencia vacío.
            return true; // No es un fallo de validación de negocio, solo una fecha incompleta/inválida.
        }

        const momentFechaActual = moment(); // Fecha actual con Moment.js

        // --- Validación: Fecha futura no permitida ---
        if (momentFechaCert.isAfter(momentFechaActual)) {
            vigenciaInput.val('Fecha Futura No Válida');
            vigenciaInput.css('border', '2px solid orange');
            Swal.fire({
                title: 'Advertencia',
                text: 'La fecha del certificado no puede ser en el futuro.',
                icon: 'warning'
            });
            return false; // Fallo de validación
        }

        // Calcular la diferencia en años y meses
        const diffYears = momentFechaActual.diff(momentFechaCert, 'years', true); // Años con decimales para la validación de > 2
        const yearsPassed = momentFechaActual.diff(momentFechaCert, 'years'); // Años completos para el texto
        const monthsPassedRemainder = momentFechaActual.diff(momentFechaCert.clone().add(yearsPassed, 'years'), 'months'); // Meses después de los años completos

        // Formato para mostrar: "X años Y meses"
        let vigenciaText = '';
        if (yearsPassed > 0) {
            vigenciaText += `${yearsPassed} año${yearsPassed !== 1 ? 's' : ''}`;
        }
        if (monthsPassedRemainder > 0) {
            if (vigenciaText !== '') vigenciaText += ' y ';
            vigenciaText += `${monthsPassedRemainder} mes${monthsPassedRemainder !== 1 ? 'es' : ''}`;
        }
        if (yearsPassed === 0 && monthsPassedRemainder === 0) {
            vigenciaText = 'Menos de 1 mes'; // O "0 años 0 meses" si lo prefieres
        }
        vigenciaInput.val(vigenciaText);

        // --- Validación principal: no debe dar más de 2 años ---
        if (diffYears > 2) {
            Swal.fire({
                title: 'Advertencia',
                text: 'La vigencia del certificado excede los 2 años (' + vigenciaText + ').',
                icon: 'warning'
            });
            vigenciaInput.css('border', '2px solid red'); // Resaltar el campo
            return false; // Indicar que la validación falló
        } else {
            vigenciaInput.css('border', ''); // Restablecer el borde
        }
    }
    return true; // Si la fecha está vacía o es válida y no excede los 2 años, consideramos que pasó la validación.
}


$(document).ready(function() {
    // ... tus otras inicializaciones de select2 ...

    $("#cam_org").select2({
        dropdownParent: $("#guardar_expe")
    });

    $("#fm_ac").select2({
        dropdownParent: $("#dede")
    });
    $("#act_adminis_desid").select2({
        dropdownParent: $("#modalComisiones")
    });
    $("#area_10").select2({
        dropdownParent: $("#modalComisiones")
    });


    $('#fech_cert').on('blur', function() {
        // Solo disparar si no se disparó ya por 'change'
        // Esto es un pequeño truco para evitar doble ejecución si el navegador dispara ambos
        if ($(this).data('changed') !== true) {
            calculateVigencia();
        }
        $(this).data('changed', false); // Reiniciar el flag
    });

    // $('#fech_cert').on('input', function() {
    //     // Al escribir, limpiamos el campo de vigencia y el borde,
    //     // pero no disparamos la alerta de 2 años hasta que la fecha sea válida.
    //     $('#vigencia').val('');
    //     $('#vigencia').css('border', '');
    //     $(this).data('changed', true); // Marcar que hubo un cambio por input
    // });

    // Asegurarse de que el cálculo se haga si ya hay una fecha al abrir el modal (en caso de edición)
    // Aunque este modal es para AGREGAR, es buena práctica.
    $('#modalContratacionPublica').on('shown.bs.modal', function () {
        calculateVigencia(); // Calcula al abrir el modal si ya hay una fecha
    });
    // --- FIN NUEVA LÓGICA ---
});

function prepareExperienciaComisionModal(id_miembro, cedula, nro_comprobante) {
    // Llenar los campos ocultos del modal con los datos del miembro
    $('#id_comision_exp_comis').val(id_miembro);
    $('#cedula_exp_comis').val(cedula);
    $('#nro_comprobante_exp_comis').val(nro_comprobante);

    // Limpiar campos del formulario cada vez que se abre el modal para agregar
    $('#form_add_experiencia_comision')[0].reset();
    $('#act_adminis_desid').val('Gaceta').trigger('change'); // Valor por defecto 'Gaceta'
    $('#area_10').val('Legal').trigger('change'); // Valor por defecto 'Legal'
}
function save_experiencia_comision() {
    event.preventDefault();

    swal.fire({
        title: '¿Guardar?',
        text: '¿Deseas guardar la experiencia en comisiones de contrataciones?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, Guardar!'
    }).then((result) => {
        if (result.value == true) {
            // Obtener los valores de los campos ocultos y visibles del modal
            var id_comision_exp_comis = $('#id_comision_exp_comis').val();
            var cedula_exp_comis = $('#cedula_exp_comis').val();
            var nro_comprobante_exp_comis = $('#nro_comprobante_exp_comis').val();

            var organo10 = $('#organo10').val();
            var act_adminis_desid = $('#act_adminis_desid').val();
            var n_acto = $('#n_acto').val();
            var fecha_act = $('#fecha_act').val();
            var area_10 = $('#area_10').val();
            var dura_comi = $('#dura_comi').val();

            // Validaciones básicas (añade más según tus necesidades)
            if (organo10 === '') {
                Swal.fire('Atención', 'El campo "Órgano o Ente" no puede estar vacío.', 'warning');
                $('#organo10').focus();
                return false;
            }
            if (act_adminis_desid === '') { // Aunque tiene valor por defecto, es buena práctica
                Swal.fire('Atención', 'Seleccione un "Acto Administrativo de Designación".', 'warning');
                $('#act_adminis_desid').focus();
                return false;
            }
            if (n_acto === '') {
                Swal.fire('Atención', 'El campo "N° del Acto" no puede estar vacío.', 'warning');
                $('#n_acto').focus();
                return false;
            }
            if (fecha_act === '') {
                Swal.fire('Atención', 'El campo "Fecha" del acto administrativo no puede estar vacío.', 'warning');
                $('#fecha_act').focus();
                return false;
            }
            if (area_10 === '') { // Aunque tiene valor por defecto
                Swal.fire('Atención', 'Seleccione un "Área".', 'warning');
                $('#area_10').focus();
                return false;
            }
            if (dura_comi === '') {
                Swal.fire('Atención', 'El campo "Duración en la Comisión" no puede estar vacío.', 'warning');
                $('#dura_comi').focus();
                return false;
            }
            // Puedes añadir validación para la fecha_act si no debe ser futura (aunque el max en HTML ayuda)
            const momentFechaAct = moment(fecha_act);
            const momentFechaActual = moment();
            if (momentFechaAct.isAfter(momentFechaActual)) {
                Swal.fire('Advertencia', 'La fecha del acto administrativo no puede ser en el futuro.', 'warning');
                $('#fecha_act').focus();
                return false;
            }

       var base_url = '/index.php/certificacion/save_experiencia_comision';

            // var base_url = window.location.origin + '/asnc/index.php/Certificacion/save_experiencia_comision'; // Nueva ruta en el controlador

            $.ajax({
                url: base_url,
                method: 'POST',
                data: {
                    id_comision: id_comision_exp_comis, // Si necesitas pasar el id de la comisión principal
                    cedula: cedula_exp_comis,
                    nro_comprobante: nro_comprobante_exp_comis,
                    organo10: organo10,
                    act_adminis_desid: act_adminis_desid,
                    n_acto: n_acto,
                    fecha_act: fecha_act,
                    area_10: area_10,
                    dura_comi: dura_comi
                },
                dataType: 'json',
                success: function(response) {
                    if (response == 1) { // Asumiendo que el controlador devuelve 1 para éxito
                        swal.fire({
                            title: '¡Guardado!',
                            text: 'La experiencia en comisiones se ha guardado correctamente.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload(); // Recargar la página para ver los cambios
                            }
                        });
                    } else {
                        swal.fire({
                            title: 'Error',
                            text: 'No se pudo guardar la experiencia en comisiones. Intente de nuevo.',
                            type: 'error'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error: ", textStatus, errorThrown);
                    console.log(jqXHR.responseText); // Muestra la respuesta del servidor para depuración
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'Ocurrió un error al procesar la solicitud. Por favor, intente de nuevo.'
                    });
                }
            });
        }
    });
}

function prepareDictadoCapacitacionModal(id_miembro, cedula, nro_comprobante) {
    // Llenar los campos ocultos del modal con los datos del miembro
    $('#id_comision_dictado').val(id_miembro);
    $('#cedula_dictado').val(cedula);
    $('#nro_comprobante_dictado').val(nro_comprobante);

    // Limpiar campos del formulario cada vez que se abre el modal para agregar
    $('#form_add_dictado_capacitacion')[0].reset();
    // No hay selects con valor por defecto aquí, pero si los hubiera, se resetearían.
}

function save_dictado_capacitacion() {
    event.preventDefault();

    swal.fire({
        title: '¿Guardar?',
        text: '¿Deseas guardar la experiencia en dictado de capacitación?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, Guardar!'
    }).then((result) => {
        if (result.value == true) {
            // Obtener los valores de los campos ocultos y visibles del modal
            var id_comision_dictado = $('#id_comision_dictado').val();
            var cedula_dictado = $('#cedula_dictado').val();
            var nro_comprobante_dictado = $('#nro_comprobante_dictado').val(); // Aunque no se use en la tabla, es bueno pasarlo

            var organo3 = $('#organo3').val();
            var actividad3 = $('#actividad3').val();
            var desde3 = $('#desde3').val();
            var hasta3 = $('#hasta3').val();

            // Validaciones básicas (añade más según tus necesidades)
            if (organo3 === '') {
                Swal.fire('Atención', 'El campo "Órgano o Ente" no puede estar vacío.', 'warning');
                $('#organo3').focus();
                return false;
            }
            if (actividad3 === '') {
                Swal.fire('Atención', 'El campo "Actividad" no puede estar vacío.', 'warning');
                $('#actividad3').focus();
                return false;
            }
            if (desde3 === '') {
                Swal.fire('Atención', 'El campo "Desde" no puede estar vacío.', 'warning');
                $('#desde3').focus();
                return false;
            }
            if (hasta3 === '') {
                Swal.fire('Atención', 'El campo "Hasta" no puede estar vacío.', 'warning');
                $('#hasta3').focus();
                return false;
            }

            // Validar fechas lógicas y que no sean futuras
            const momentDesde3 = moment(desde3);
            const momentHasta3 = moment(hasta3);
            const momentFechaActual = moment();

            if (!momentDesde3.isValid() || !momentHasta3.isValid()) {
                Swal.fire('Atención', 'Las fechas "Desde" y "Hasta" deben ser válidas.', 'warning');
                return false;
            }
            if (momentDesde3.isAfter(momentHasta3)) {
                Swal.fire('Advertencia', 'La fecha "Desde" no puede ser posterior a la fecha "Hasta".', 'warning');
                $('#desde3').focus();
                return false;
            }
            if (momentHasta3.isAfter(momentFechaActual)) {
                Swal.fire('Advertencia', 'La fecha "Hasta" no puede ser en el futuro.', 'warning');
                $('#hasta3').focus();
                return false;
            }

            // Validar "últimos 3 años" - La fecha 'Desde' no debe ser anterior a 3 años desde hoy
            const threeYearsAgo = momentFechaActual.subtract(3, 'years');
            if (momentDesde3.isBefore(threeYearsAgo)) {
                 Swal.fire('Advertencia', 'La experiencia debe ser de los últimos 3 años.', 'warning');
                 $('#desde3').focus();
                 return false;
            }
       var base_url = '/index.php/certificacion/save_dictado_capacitacion';


            // var base_url = window.location.origin + '/asnc/index.php/Certificacion/save_dictado_capacitacion'; // Nueva ruta en el controlador

            $.ajax({
                url: base_url,
                method: 'POST',
                data: {
                    id_comision: id_comision_dictado, // Si necesitas pasar el id de la comisión principal
                    cedula: cedula_dictado,
                    nro_comprobante: nro_comprobante_dictado, // Se pasa aunque no se use en la tabla directamente
                    organo3: organo3,
                    actividad3: actividad3,
                    desde3: desde3,
                    hasta3: hasta3
                },
                dataType: 'json',
                success: function(response) {
                    if (response == 1) { // Asumiendo que el controlador devuelve 1 para éxito
                        swal.fire({
                            title: '¡Guardado!',
                            text: 'La experiencia en dictado de capacitación se ha guardado correctamente.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload(); // Recargar la página para ver los cambios
                            }
                        });
                    } else {
                        swal.fire({
                            title: 'Error',
                            text: 'No se pudo guardar la experiencia en dictado de capacitación. Intente de nuevo.',
                            type: 'error'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error: ", textStatus, errorThrown);
                    console.log(jqXHR.responseText); // Muestra la respuesta del servidor para depuración
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'Ocurrió un error al procesar la solicitud. Por favor, intente de nuevo.'
                    });
                }
            });
        }
    });
}

function prepareAcademicModal(id_miembro, cedula, nro_comprobante) {
    $('#id_miembros_natu_academica_add').val(id_miembro);
    $('#cedula_modal_academica_add').val(cedula);
    $('#nro_comprobante_modal_academica_add').val(nro_comprobante);

    // Limpiar campos del formulario cada vez que se abre el modal
    $('#form_add_academica')[0].reset();
    $('#fm_ac').val('0').trigger('change'); // Reiniciar select2
    $('#curso_add').val('0'); // Reiniciar select de curso
}

// --- Función para guardar nueva información académica ---
function save_inf_ac_new() {
    event.preventDefault();

    swal.fire({
        title: '¿Guardar?',
        text: '¿Deseas guardar la nueva información académica?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Sí, Guardar!'
    }).then((result) => {
        if (result.value == true) {
            // Obtener los valores de los campos ocultos y visibles del modal (ID "dede")
            var id_miembros_natu_academica_add = $('#id_miembros_natu_academica_add').val(); // This is the 'id' from infor_per_natu
            var cedula_modal_academica_add = $('#cedula_modal_academica_add').val();
            var nro_comprobante_modal_academica_add = $('#nro_comprobante_modal_academica_add').val();

            var fm_ac = $('#fm_ac').val(); // Formación Académica (select)
            var titulo_add = $('#titulo_add').val(); // Título Obtenido
            var anioi_add = $('#anioi_add').val(); // Año de Inicio
            var anioc_add = $('#anioc_add').val(); // Culminación
            var curso_add = $('#curso_add').val(); // En Curso (select)

            // Validaciones básicas
            if (fm_ac == '0') {
                Swal.fire('Atención', 'Seleccione la "Formación Académica".', 'warning');
                $('#fm_ac').focus();
                return false;
            }
            if (titulo_add === '') {
                Swal.fire('Atención', 'El campo "Título Obtenido" no puede estar vacío.', 'warning');
                $('#titulo_add').focus();
                return false;
            }
            if (anioi_add === '') {
                Swal.fire('Atención', 'El campo "Año de Inicio" no puede estar vacío.', 'warning');
                $('#anioi_add').focus();
                return false;
            }
            // Add validation for anioc_add if 'En Curso' is 'No'
            if (curso_add == '1' && anioc_add === '') { // If not 'En Curso' (value 1 for No), then Culminación must be filled
                Swal.fire('Atención', 'El campo "Culminación" debe estar lleno si no está en curso.', 'warning');
                $('#anioc_add').focus();
                return false;
            }
            if (curso_add == '0') {
                Swal.fire('Atención', 'Seleccione si la formación está "En Curso".', 'warning');
                $('#curso_add').focus();
                return false;
            }
            // Basic year validation (assuming 4 digits)
            if (anioi_add.length !== 4 || isNaN(anioi_add)) {
                Swal.fire('Atención', 'El "Año de Inicio" debe ser un año válido de 4 dígitos.', 'warning');
                $('#anioi_add').focus();
                return false;
            }
            if (curso_add == '1' && anioc_add.length !== 4 || (curso_add == '1' && isNaN(anioc_add))) {
                Swal.fire('Atención', 'El "Año de Culminación" debe ser un año válido de 4 dígitos si no está en curso.', 'warning');
                $('#anioc_add').focus();
                return false;
            }
            if (curso_add == '1' && parseInt(anioi_add) > parseInt(anioc_add)) {
                Swal.fire('Advertencia', 'El "Año de Inicio" no puede ser mayor que el "Año de Culminación".', 'warning');
                $('#anioi_add').focus();
                return false;
            }

            var base_url = '/index.php/certificacion/save_inff';

            // var base_url = window.location.origin + '/asnc/index.php/Certificacion/save_inff';  

            $.ajax({
                url: base_url,
                method: 'POST',
                data: {
                    id_miembro: id_miembros_natu_academica_add,  
                    cedula: cedula_modal_academica_add,
                    nro_comprobante: nro_comprobante_modal_academica_add,
                    fm_ac: fm_ac,
                    titulo: titulo_add,
                    anioi: anioi_add,
                    anioc: anioc_add,
                    curso: curso_add
                },
                dataType: 'json',
                success: function(response) {
                    if (response == 1) { // Assuming the controller returns 1 for success
                        swal.fire({
                            title: '¡Guardado!',
                            text: 'La información académica se ha guardado correctamente.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload(); // Recargar la página para ver los cambios
                            }
                        });
                    } else {
                        swal.fire({
                            title: 'Error',
                            text: 'No se pudo guardar la información académica. Intente de nuevo.',
                            type: 'error'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error: ", textStatus, errorThrown);
                    console.log(jqXHR.responseText); // Display server response for debugging
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'Ocurrió un error al procesar la solicitud. Por favor, intente de nuevo.'
                    });
                }
            });
        }
    });
}