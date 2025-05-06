function consultar_rif(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var rif_b = $('#rif_b').val();
    if (rif_b == ''){
        swal({
            title: "¡ATENCION!",
            text: "El campo no puede estar vacio.",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#00897b",
            confirmButtonText: "CONTINUAR",
            closeOnConfirm: false
        }, function(){
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });
        $('#ueba').attr("disabled", true);
    }else{
        $("#items").show();
        var base_url  = window.location.origin+'/asnc/index.php/gestion/consulta_og';
        var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

    //   var base_url = '/index.php/gestion/consulta_og';
    //     var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

        $.ajax({
            url:base_url,
            method: 'post',
            data: {rif_b: rif_b},
            dataType: 'json',
            success: function(data){
                if (data == null) {
                    $("#no_existe").show();
                    $("#existe").hide();

                   // $('#exitte').val(0);

                }else{
                    $("#existe").show();
                    $("#no_existe").hide();                  

                    $('#sel_rif_nombre5').val(data['rif']);
                    $('#nombre_conta_5').val(data['descripcion']);
                    

                    var rif_cont_nr = data['rifced'];
                    var ultprocaprob = data['ultprocaprob'];
                    $.ajax({
                        url:base_url2,
                        method: 'post',
                        data: {ultprocaprob: ultprocaprob,
                              rif_cont_nr: rif_cont_nr},
                        dataType: 'json',
                        success: function(data){
                            $.each(data, function(index, response){
                            });
                        }
                    });
                }
            }
        })
    }
}

function llenar_municipio(){
    var id_estado_n = $('#id_estado_n').val();
//    var base_url = window.location.origin+'/asnc/index.php/User/listar_municipio';
    var base_url = '/index.php/User/listar_municipio';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_estado: id_estado_n},
        dataType:'json',

        success: function(response){
            $('#id_municipio_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_municipio_n').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
            });
        }
    });
}
function llenar_municipio2(){
    var id_estado_n = $('#id_estado_n1').val();
//    var base_url = window.location.origin+'/asnc/index.php/User/listar_municipio';
    var base_url = '/index.php/User/listar_municipio';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_estado: id_estado_n},
        dataType:'json',

        success: function(response){
            $('#id_municipio_n1').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_municipio_n1').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
            });
        }
    });
}
function llenar_parroquia2(){
    var id_municipio_n = $('#id_estado_n1').val();
//    var base_url = window.location.origin+'/asnc/index.php/User/listar_parroquia';
    var base_url = '/index.php/User/listar_parroquia';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_municipio: id_municipio_n},
        dataType:'json',

        success: function(response){
            $('#id_parroquia_n1').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_parroquia_n1').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
            });
        }
    });
}
function llenar_parroquia(){
    var id_municipio_n = $('#id_estado_n').val();
//    var base_url = window.location.origin+'/asnc/index.php/User/listar_parroquia';
    var base_url = '/index.php/User/listar_parroquia';

    $.ajax({
        url: base_url,
        method:'post',
        data: {id_municipio: id_municipio_n},
        dataType:'json',

        success: function(response){
            $('#id_parroquia_n').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#id_parroquia_n').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
            });
        }
    });
}

// function save() {
//     event.preventDefault();
//     swal
//         .fire({
//             title: "¿Registrar?",
//             text: "¿Esta seguro de enviar la solicitud ",
//             type: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             cancelButtonText: "Cancelar",
//             confirmButtonText: "¡Si, guardar!",
//         })
//         .then((result) => {
//     //  var campos = document.querySelectorAll('#sav_ext input[type="text"]');
//     // for (var i = 0; i < campos.length; i++) {
//     //     // Verifica si el campo es visible
//     //     if (campos[i].offsetWidth > 0 && campos[i].offsetHeight > 0) {
//     //         // Solo valida si el campo es visible
//     //         if (campos[i].value.trim() === '') {
//     //             alert('Por favor, complete todos los campos obligatorios.');
//     //             campos[i].focus();
//     //             return false; // Evita el envío del formulario
//     //         }
//     //     }
//     // }

            
//         //     if (document.sav_ext.rif_b.value.length==0){
//         //        swal.fire({
//         //         title: 'Debe ingresar un RIF',
//         //         type: 'warning',
//         //         showCancelButton: false,
//         //         confirmButtonColor: '#3085d6',
//         //         confirmButtonText: 'Ok'
//         //     }).then((result) => {
//         //         if (result.value == true) {
//         //         }
//         //     });
//         //         document.sav_ext.rif_b.focus()
//         //         return 0;
//         //  } 
//         //    if (document.sav_ext.name_f.value.length==0){
//         //        swal.fire({
//         //         title: 'Debe ingresar Nombre completo del funcionario',
//         //         type: 'warning',
//         //         showCancelButton: false,
//         //         confirmButtonColor: '#3085d6',
//         //         confirmButtonText: 'Ok'
//         //     }).then((result) => {
//         //         if (result.value == true) {
//         //         }
//         //     });
//         //         document.sav_ext.name_f.focus()
//         //         return 0;
//         //  } 
//         //       if (document.sav_ext.name_f.value.length==0){
//         //        swal.fire({
//         //         title: 'Debe ingresar Nombre completo del funcionario',
//         //         type: 'warning',
//         //         showCancelButton: false,
//         //         confirmButtonColor: '#3085d6',
//         //         confirmButtonText: 'Ok'
//         //     }).then((result) => {
//         //         if (result.value == true) {
//         //         }
//         //     });
//         //         document.sav_ext.name_f.focus()
//         //         return 0;
//         //  } 
           
            
//             if (result.value == true) {
//                 event.preventDefault();
//                 var datos = new FormData($("#sav_ext")[0]);
//                  var base_url = window.location.origin+'/asnc/index.php/User/save_solicitud';
//                  var base_url_3 = window.location.origin+'/asnc/index.php/Pdfcerti_miem/pdfrt?id=';

// console.log(base_url_3);
//                 // var base_url =
//                 //     window.location.origin +
//                 //     "/asnc/index.php/Mensualidades/guardar_proc_pag";
//                 // var base_url_2 =
//                 //     window.location.origin + "/marina/index.php/Mensualidades/ver";
//                     // var base_url_3 =
//                     // window.location.origin + "/marina/index.php/Mensualidades/verPago?id=";
//                 $.ajax({
//                     url: base_url,
//                     method: "POST",
//                     data: datos,
//                     contentType: false,
//                     processData: false,
//                     success: function(response) {
//                         var menj = 'Numero de Solicitud: ';
                        
//                         if(response != '') {
//                             swal.fire({
//                                 title: 'Registro Exitoso ',
//                                 text: menj + response,
//                                 type: 'success',
//                                 showCancelButton: false,
//                                 confirmButtonColor: '#3085d6',
//                                 confirmButtonText: 'Ok'
//                             }).then((result) => {
//                                 if (result.value == true){
//                                     window.location.href = base_url_3 + response;
//                                 }
//                             });
//                         }
//                     },
//                 });
//             }
//         });
// }
function save(event) {
    event.preventDefault();
    swal
        .fire({
            title: "¿Solicitar?",
            text: "¿Está seguro de enviar la solicitud?, ESTA PLANILLA DEBE REMITIRSE FIRMADA POR LA MAXIMA AUTORIDAD  O CUENTADANTE AL SIGUIENTE CORREO clavesi@snc.gob.ve, números corporativos: 0426-5654730/0426-5654740",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Sí, Descargar!",
        })
        .then((result) => {
if (document.sav_ext.rif_b.value.length==0){
        swal.fire({
            title: 'No Puede dejar campo rif, ingrese un valor',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.rif_b.focus()
        return 0;
       }
         if (document.sav_ext.rifadscrito.value.length==0){
        swal.fire({
            title: 'Debe ingresar RIF Órgano/Ente de Adscripción',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.rifadscrito.focus()
        return 0;
       }
       if (document.sav_ext.nameadscrito.value.length==0){
        swal.fire({
            title: 'Debe ingresar Nombre Órgano/Ente de Adscripción',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.nameadscrito.focus()
        return 0;
       }
      if (document.sav_ext.cod_onapre.value.length==0){
        swal.fire({
            title: 'Debe ingresar Código ONAPRE',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.cod_onapre.focus()
        return 0;
       }
        if (document.sav_ext.siglas.value.length==0){
        swal.fire({
            title: 'Debe ingresar Siglas',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.siglas.focus()
        return 0;
       }
       if (document.sav_ext.tel_local.value.length==0){
        swal.fire({
            title: 'Debe ingresar telefono de contacto',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.tel_local.focus()
        return 0;
       }
        if (document.sav_ext.pag_web.value.length==0){
        swal.fire({
            title: 'Debe ingresar pagina web de contacto',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.pag_web.focus()
        return 0;
       }
      
         if (document.sav_ext.name_max_a_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar Nombre de la maxima autorida o cuentadante',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.name_max_a_f.focus()
        return 0;
       }
    if (document.sav_ext.cargo__max_a_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar Cargo de la maxima autorida o cuentadante',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.cargo__max_a_f.focus()
        return 0;
       }
       if (document.sav_ext.name_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar nombre funcionario',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.name_f.focus()
        return 0;
       }
       
        if (document.sav_ext.apellido_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar Apellido del funcionario',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.apellido_f.focus()
        return 0;
       }
         if (document.sav_ext.cedula_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar cedula de identidad del funcionario',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.cedula_f.focus()
        return 0;
       }
       if (document.sav_ext.cargo_f.value.length==0){
        swal.fire({
            title: 'Debe ingresar cargo del funcionario',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.cargo_f.focus()
        return 0;
       }
         if (document.sav_ext.telefono_f.value.length==0){
        swal.fire({
            title: 'No Puede dejar campo telefono, ingrese un valor',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.telefono_f.focus()
        return 0;
       }
        if (document.sav_ext.correo.value.length==0){
        swal.fire({
            title: 'No Puede dejar campo correo, ingrese un valor',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value == true) {
            }
        });
        //alert("No Puede dejar campo rif contratista vacio, ingrese un valor")
        document.sav_ext.correo.focus()
        return 0;
       }
       


            if (result.value) {
                var datos = new FormData($("#sav_ext")[0]);
                // var base_url = window.location.origin + '/asnc/index.php/User/save_solicitud';
                // var base_url_3 = window.location.origin + '/asnc/index.php/Solicitud/pdfrt?id=';
                var base_url = '/index.php/User/save_solicitud';
                var base_url_3 = '/index.php/Solicitud/pdfrt?id=';


                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log("ID de la solicitud:", response); // Verifica el ID
                        if (response) {
                            swal.fire({
                                title: 'Solicitud Exitosa, ESTA PLANILLA DEBE REMITIRSE FIRMADA POR LA MAXIMA AUTORIDAD  O CUENTADANTE AL SIGUIENTE CORREO clavesi@snc.gob.ve, números corporativos: 0426-5654730/0426-5654740',
                                text: 'Número de Solicitud: ' + response,
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'LA DESCARGA DEBIO INICIAR, SINO DAR CLIC AQUI'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = base_url_3 + response; // Redirige a la URL generada
                                }
                            });
                              setTimeout(function() {
                                window.location.href = base_url_3 + response; // Redirige a la URL generada
                            }, 2000); // 2000 milisegundos = 2 segundos
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en la solicitud:", error);
                        swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al guardar la solicitud.',
                            type: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            }
        });
}

function validateEmail() {
        const emailInput = document.getElementById('correo');
        const guardarButton = document.getElementById('guardar');
        const emailValue = emailInput.value;

        // Expresiones regulares para validar correos de Gmail y Hotmail
        const gmailPattern = /@gmail\.com$/i;
        const hotmailPattern = /@hotmail\.com$/i;

        // Verificar si el correo es de Gmail o Hotmail
        if (gmailPattern.test(emailValue) || hotmailPattern.test(emailValue)) {
            guardarButton.disabled = true; // Deshabilitar el botón
             showAlert(); 
        } else {
            guardarButton.disabled = false; // Habilitar el botón
        }
    }

    function showAlert() {
        Swal.fire({
            title: 'Debe ingresar un correo institucional, para continuar',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        });
    }




      function llenar_() {
      
        var factura = $("#trabajo").val();
        if (factura <= "1") {
            $("#campos7").show();
        } else {
            $("#campos7").hide();
        }
        }

    
    
    
   
 
  function loadDiplomadoInfo(idDiplomado) {
            if(idDiplomado == 0) {
                $('#diplomadoInfoContainer').hide();
                return;
            }
        var base_url = window.location.origin+'/asnc/index.php/diplomado/getDiplomadoInfo/' + idDiplomado;
            
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
                // Agrega más modalidades según corresponda
            };
            return modalidades[idModalidad] || 'No especificado';
        }
 // Función para mostrar/ocultar campos según tipo de pago
    function togglePagoFields() {
        const tipoPago = $('#tipo_pago').val();
        
        // Ocultar todos primero
        $('#pagoContadoFields').hide();
        $('#pagoCreditoFields').hide();
        
        // Mostrar los correspondientes
        if(tipoPago == 1) {
            $('#pagoContadoFields').show();
        } else if(tipoPago == 2) {
            $('#pagoCreditoFields').show();
        }
    }
    
    // Validar que el importe no sea mayor al total
    $('#importe').on('change', function() {
        const total = parseFloat($('#total_pago').val()) || 0;
        const importe = parseFloat($(this).val()) || 0;
        
        if(importe > total) {
            alert('El importe cancelado no puede ser mayor al total a pagar');
            $(this).val(total.toFixed(2));
        }
    });

    function verificarPago() {
    if($('#tipo_pago').val() != 1) {
        alert('Esta función solo aplica para pagos al contado');
        return;
    }

    // Validar campos obligatorios
    const camposRequeridos = ['total_pago', 'bancoo', 'cedulaPagador', 'telefonoPagador', 'referencia', 'fechaPago', 'importe'];
    let validacionOk = true;
    
    camposRequeridos.forEach(campo => {
        if(!$(`#${campo}`).val()) {
            $(`#${campo}`).addClass('is-invalid');
            validacionOk = false;
        } else {
            $(`#${campo}`).removeClass('is-invalid');
        }
    });
    
    if(!validacionOk) {
        alert('Por favor complete todos los campos requeridos');
        return;
    }

    // Mostrar loader
    $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Verificando pago...');

    // Preparar datos para enviar
    const datosPago = {
        cedulaPagador: $('#cedulaPagador').val(),
        telefonoPagador: $('#telefonoPagador').val(),
        telefonoDestino: $('#telefonoDestino').val() || '',
        referencia: $('#referencia').val(),
        fechaPago: $('#fechaPago').val(),
        importe: $('#importe').val(),
        bancoOrigen: $('#bancoo').val()
    };
        var base_url = window.location.origin+'/asnc/index.php/diplomado/verificar_pago/';

    // Enviar a tu backend de CodeIgniter
    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: datosPago,
        success: function(response) {
            if(response.success) {
                // Pago verificado correctamente
                alert('Pago verificado correctamente. Puede continuar con la inscripción.');
                $('#pagoVerificado').val('1'); // Campo oculto para marcar como verificado
                $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Inscripción');
            } else {
                // Error en la verificación
                alert(response.message || 'Error al verificar el pago: ' + (response.error || ''));
                $('#guardar').prop('disabled', true).html('<i class="fas fa-save mr-2"></i>Guardar Inscripción');
            }
        },
        error: function(xhr) {
            alert('Error de conexión con el servidor');
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Inscripción');
        }
    });
}
 
  function savei(event) {
    // Si es pago al contado y no está verificado
    if($('#tipo_pago').val() == 1 && $('#pagoVerificado').val() != '1') {
        event.preventDefault();
        alert('Debe verificar el pago antes de continuar');
        verificarPago();
        return false;
    }
    
    // Si es crédito o pago ya verificado, continuar
    if($('#sav_ext').parsley().validate()) {
        // Mostrar loader
        $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...');
        
        // Continuar con el envío del formulario
       // $('#sav_ext').submit();
    } else {
        alert('Por favor complete todos los campos requeridos');
    }
}
 