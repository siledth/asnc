let capacitacionCount = 0;
const maxCapacitaciones = 3;
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
        //  var base_url  = window.location.origin+'/asnc/index.php/gestion/consulta_og';
        //  var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

      var base_url = '/index.php/gestion/consulta_og';
        var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

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

           function llenar_2() {
      
        var factura = $("#t_contrata_p").val();
        if (factura <= "1") {
            $("#cmp1").show();
        } else {
            $("#cmp1").hide();
        }
        }

 
function llenar_3() {
    var seleccion = $("#t_contrata_p").val();
    if (seleccion == "1") {
        $("#cmp1").show();
    } else {
        $("#cmp1").hide();
        $("#experiencia_publicas").val("");
    }
}
    
    
    
   
 
  function loadDiplomadoInfo(idDiplomado) {
            if(idDiplomado == 0) {
                $('#diplomadoInfoContainer').hide();
                return;
            }
        // var base_url = window.location.origin+'/asnc/index.php/diplomado/getDiplomadoInfo/' + idDiplomado;
        var base_url = '/index.php/diplomado/getDiplomadoInfo/' + idDiplomado;
            
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
                // Agrega más modalidades según corresponda
            };
            return modalidades[idModalidad] || 'No especificado';
        }

    
    // Validar que el importe no sea mayor al total
    $('#importe').on('change', function() {
        const total = parseFloat($('#total_iva').val()) || 0;
        const importe = parseFloat($(this).val()) || 0;
        
        if(importe > total) {
            alert('El importe cancelado no puede ser mayor al total a pagar');
            $(this).val(total.toFixed(2));
        }
    });

//     function verificarPago() {
//     if($('#tipo_pago').val() != 1) {
//         alert('Esta función solo aplica para pagos al contado');
//         return;
//         }

//     // Validar campos obligatorios
//     const camposRequeridos = ['total_pago', 'bancoOrigen', 'cedulaPagador', 'telefonoPagador', 'referencia', 'fechaPago', 'importe'];
//     let validacionOk = true;
    
//     camposRequeridos.forEach(campo => {
//         if(!$(`#${campo}`).val()) {
//             $(`#${campo}`).addClass('is-invalid');
//             validacionOk = false;
//         } else {
//             $(`#${campo}`).removeClass('is-invalid');
//         }
//     });
    
//     if(!validacionOk) {
//         alert('Por favor complete todos los campos requeridos');
//         return;
//     }

//     // Mostrar loader
//     $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Verificando pago...');

//     // Preparar datos para enviar
//     const datosPago = {
//         cedulaPagador: $('#cedulaPagador').val(),
//         telefonoPagador: $('#telefonoPagador').val(),
//         telefonoDestino: $('#telefonoDestino').val() || '',
//         referencia: $('#referencia').val(),
//         fechaPago: $('#fechaPago').val(),
//         importe: $('#importe').val(),
//         bancoOrigen: $('#bancoOrigen').val()
//     };
//     //  var base_url = window.location.origin+'/asnc/index.php/diplomado/verificar_pago/';
//        var base_url = '/index.php/diplomado/verificar_pago';

//     // Enviar a tu backend de CodeIgniter
//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         data: datosPago,
//         success: function(response) {
//             if(response.success) {
//                 // Pago verificado correctamente
//                 alert('Pago verificado correctamente. Puede continuar .');
//                 $('#pagoVerificado').val('1'); // Campo oculto para marcar como verificado
//                 $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar ');
//             } else {
//                 // Error en la verificación
//                 alert(response.message || 'Error al verificar el pago: ' + (response.error || ''));
//                 $('#guardar').prop('disabled', true).html('<i class="fas fa-save mr-2"></i>Guardar ');
//             }
//         },
//         error: function(xhr) {
//             alert('Error de conexión con el servidor');
//             $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar ');
//         }
//     });
// }
 function verificarPago() {
    // Limpiar errores previos
    $('.is-invalid').removeClass('is-invalid');
    
    if($('#tipo_pago').val() != 1) {
        alert('Esta función solo aplica para pagos al contado');
        return;
    }

    // Validar campos obligatorios
    const camposRequeridos = ['bancoOrigen', 'telefonoPagador', 'referencia', 'fechaPago', 'importe'];
    let validacionOk = true;
    
    camposRequeridos.forEach(campo => {
        if(!$(`#${campo}`).val()) {
            $(`#${campo}`).addClass('is-invalid');
            validacionOk = false;
        }
    });
    
    if(!validacionOk) {
        alert('Por favor complete todos los campos requeridos');
        return;
    }

    // Mostrar loader
    $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Verificando pago...');

    // Preparar datos para enviar (usando los mismos nombres que en el ejemplo funcional)
    const datosPago = {
        telefonoPagador: $('#telefonoPagador').val(),
        telefonoDestino: $('#telefonoDestino').val() || '',
        referencia: $('#referencia').val(),
        fechaPago: $('#fechaPago').val(),
        importe: $('#importe').val(),
        bancoOrigen: $('#bancoOrigen').val()
    };
        var base_url = '/index.php/diplomado/verificar_pago';


    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: datosPago,
        success: function(response) {
            if(response.success) {
                alert('Pago verificado correctamente. Puede continuar.');
                $('#pagoVerificado').val('1');
            } else {
                let errorMsg = response.message || 'Error al verificar el pago';
                if (response.code) errorMsg += ` (Código: ${response.code})`;
                if (response.error && typeof response.error === 'object') {
                    errorMsg += '\n' + JSON.stringify(response.error);
                } else if (response.error) {
                    errorMsg += '\n' + response.error;
                }
                alert(errorMsg);
            }
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar');
        },
        error: function(xhr) {
            let errorMsg = 'Error de conexión con el servidor';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            alert(errorMsg);
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar');
        }
    });
}
// function savei(event) {
//     event.preventDefault();
    
//     // 1. Validar pago al contado
//     if($('#tipo_pago').val() == 1 && $('#pagoVerificado').val() != '1') {
//         alert('Debe verificar el pago antes de continuar');
//         verificarPago();
//         return false;
//     }
    
//     // 2. Validación manual de campos requeridos
//     if(!validarFormulario()) {
//         return false;
//     }
    
//     // 3. Mostrar estado de carga
//     $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...');
    
//     // 4. Obtener datos del formulario
//     let formData = {
//         id_inscripcion: $('#id_inscripcion').val(),
//         codigo_planilla: $('#rif_b').val(),
//         importe: $('#importe').val(),
//         fechaPago: $('#fechaPago').val(),
//         referencia: $('#referencia').val(),
//         cedulaPagador: $('#cedulaPagador').val(),
//         telefonoPagador: $('#telefonoPagador').val(),
//         telefonoDestino: $('#telefonoDestino').val(),
//         banco: $('#bancoOrigen').val(),
//         tipo_pago: $('#tipo_pago').val(),
        


//         //banco: $('#banco').val() || null
//     };

//     // 5. Enviar datos por AJAX
//     //  var base_url = window.location.origin + '/asnc/index.php/Diplomado/guardar_pago';
//     //     var base_url2 = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; //redirigir

//        var base_url = '/index.php/Diplomado/guardar_pago';
//         var base_url2 = '/index.php/Diplomado/preinscrip';
        

//     $.ajax({
//         url: base_url,
//         type: 'POST',
//         dataType: 'json',
//         data: formData,
//         success: function(response) {
//             if(response.success) {
//                 alert('Pago registrado exitosamente');
//                 // Redirigir a comprobante o página de éxito
//                 if(response.pago_id) {
//                      setTimeout(function() {
//         window.location.href = base_url2 ; 
//     }, 1000);
//                     // window.location.href = base_url.replace('guardar_pago', 'comprobante') + '/' + response.pago_id;
//                 }
//             } else {
//                 alert('Error: ' + response.message);
//                 $('#guardar').prop('disabled', false).html('Guardar');
//             }
//         },
//         error: function(xhr, status, error) {
//             alert('Error al conectar con el servidor: ' + error);
//             $('#guardar').prop('disabled', false).html('Guardar');
//         }
//     });
// }

// Función de validación manual completa
function savei(event) {
    event.preventDefault();
    
    // // 1. Validar pago al contado
    if($('#tipo_pago').val() >= 1 && $('#pagoVerificado').val() != '1') {
        alert('Debe verificar el pago antes de continuar');
        verificarPago();
        return false;
    }
    
    // 2. Validación manual de campos requeridos
    if(!validarFormulario()) {
        return false;
    }
    
    // 3. Mostrar estado de carga
    $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...');
    
    // 4. Obtener datos del formulario
    let formData = {
        id_inscripcion: $('#id_inscripcion').val(),
        codigo_planilla: $('#rif_b').val(),

        codigo_planilla: $('#rif_b').val(),
        importe: $('#importe').val(),
        fechaPago: $('#fechaPago').val(),
        referencia: $('#referencia').val(),
        cedulaPagador: $('#cedulaPagador').val(),
        telefonoPagador: $('#telefonoPagador').val(),
        telefonoDestino: $('#telefonoDestino').val(),
        banco: $('#bancoOrigen').val(),
        tipo_pago: $('#tipo_pago').val()
    };

    // 5. Enviar datos por AJAX
    var base_url = '/index.php/Diplomado/guardar_pago';
    var pdf_url = '/index.php/Preinscripcionnatural/pdfrt?id=' + $('#rif_b').val();

    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(response) {
            if(response.success) {
                alert('Pago registrado exitosamente');
                // Abrir el PDF en una nueva pestaña
               window.location.href = pdf_url;
                
                // Redirigir después de mostrar el PDF
                setTimeout(function() {
                    window.location.href = '/index.php/Diplomado/preinscrip'; 
                }, 1000);
            } else {
                alert('Error: ' + response.message);
                $('#guardar').prop('disabled', false).html('Guardar');
            }
        },
        error: function(xhr, status, error) {
            alert('Error al conectar con el servidor: ' + error);
            $('#guardar').prop('disabled', false).html('Guardar');
        }
    });
}

function validarFormulario() {
    let isValid = true;
    
    // Limpiar errores previos
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    
    // Validar cada campo requerido
    const camposRequeridos = [
        // { id: '#id_inscripcion', nombre: 'ID Inscripción' },
        { id: '#rif_b', nombre: 'Código Planilla' },
        { id: '#importe', nombre: 'Importe', tipo: 'numero', min: 0.01 },
        { id: '#fechaPago', nombre: 'Fecha de Pago', tipo: 'fecha' },
        { id: '#referencia', nombre: 'Referencia' },
        { id: '#cedulaPagador', nombre: 'Cédula Pagador', tipo: 'cedula' },
        { id: '#telefonoPagador', nombre: 'Teléfono Pagador', tipo: 'telefono' }
    ];
    
    camposRequeridos.forEach(campo => {
        // const $element = $(campo.id);
        
        // Verificar si el elemento existe en el DOM
        // if($element.length === 0) {
        //     console.error(`Elemento no encontrado: ${campo.id}`);
        //     mostrarError($(`[name="${campo.id.substring(1)}"]`), `Campo ${campo.nombre} no encontrado`);
        //     isValid = false;
        //     return;
        // }
        
        // Obtener valor y hacer trim solo si existe
        // const valor = $element.val() ? $element.val().trim() : '';
        
        // // Validar campo vacío
        // if(valor === '') {
        //     mostrarError($element, `${campo.nombre} es requerido`);
        //     isValid = false;
        //     return;
        // }
        
        // Validaciones específicas por tipo
        // switch(campo.tipo) {
            // case 'numero':
            //     if(isNaN(valor)) {
            //         mostrarError($element, `${campo.nombre} debe ser un número`);
            //         isValid = false;
            //     } else if(campo.min && parseFloat(valor) < campo.min) {
            //         mostrarError($element, `${campo.nombre} debe ser mayor a ${campo.min}`);
            //         isValid = false;
            //     }
            //     break;
                
            // case 'fecha':
            //     if(!isValidDate(valor)) {
            //         mostrarError($element, 'Fecha inválida (Formato: YYYY-MM-DD)');
            //         isValid = false;
            //     }
            //     break;
                
            // case 'cedula':
            //     if(!/^[VEJPGvejpg]?\d{5,9}$/.test(valor)) {
            //         mostrarError($element, 'Cédula inválida. Ej: V12345678');
            //         isValid = false;
            //     }
            //     break;
                
            // case 'telefono':
            //     if(!/^0[0-9]{10}$/.test(valor)) {
            //         mostrarError($element, 'Teléfono inválido. Ej: 04121234567');
            //         isValid = false;
            //     }
            //     break;
        // }
    });
    
    return isValid;
}
// Función auxiliar para mostrar errores
function mostrarError($element, mensaje) {
    $element.addClass('is-invalid');
    if($element.next('.invalid-feedback').length === 0) {
        $element.after(`<div class="invalid-feedback">${mensaje}</div>`);
    } else {
        $element.next('.invalid-feedback').text(mensaje);
    }
}

// Validar formato de fecha (YYYY-MM-DD)
function isValidDate(dateString) {
    const regEx = /^\d{4}-\d{2}-\d{2}$/;
    if(!dateString.match(regEx)) return false;
    const d = new Date(dateString);
    return !isNaN(d.getTime());
}
 

// function redirectToForm() {
//     const tipoPersona = $('#id_tipop').val();
    
//     if(!tipoPersona) {
//         alert('Por favor seleccione una opción');
//         return;
//     }
    
//     // Configurar el formulario oculto
//     $('#tipo_persona').val(tipoPersona);
//         var base_url = window.location.origin+'/asnc/index.php/Diplomado/solic';
    
//     // Determinar la ruta según la selección
//     let actionUrl = '';
//     if(tipoPersona == '1') {
//         actionUrl = base_url;
//     } else if(tipoPersona == '2') {
//         actionUrl = '<?php echo site_url("solic_juridica"); ?>';
//     }
    
//     console.log('Redirigiendo a:', actionUrl); // Para depuración
    
//     // Configurar y enviar el formulario
//     $('#redirectForm').attr('action', actionUrl);
//     $('#redirectForm').submit();
    
//     // Forzar el envío si es necesario
//     document.getElementById('redirectForm').submit();
// }



 
function redirectToForm() {
    const tipoPersona = $('#id_tipop').val();
    
    if(!tipoPersona) {
        alert('Por favor seleccione una opción');
        return;
    }
        var base_url = window.location.origin+'/asnc/index.php/Diplomado/solic';
    
    // Crear formulario dinámico
    const form = document.createElement('form');
    form.method = 'POST';
    
    if(tipoPersona == '1') {
        form.action = base_url;
    } else {
        form.action = '<?php echo site_url("solic_juridica"); ?>';
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

 $(document).ready(function() {
            // Contador de capacitaciones
            let capacitacionCount = 0;
            const maxCapacitaciones = 3;

            // Mostrar/ocultar sección de capacitaciones según selección
            $('#tiene_capacitacion').change(function() {
                if ($(this).val() === '1') {
                    $('#capacitaciones-container').show();
                    // Agregar primera capacitación automáticamente
                    if (capacitacionCount === 0) {
                        agregarCapacitacion();
                    }
                } else {
                    $('#capacitaciones-container').hide();
                    // Limpiar capacitaciones si selecciona "No"
                    $('#lista-capacitaciones').empty();
                    capacitacionCount = 0;
                }
            });

            // Agregar nueva capacitación
            $('#btn-add-capacitacion').click(function() {
                if (capacitacionCount < maxCapacitaciones) {
                    agregarCapacitacion();
                } else {
                    alert('Solo puede agregar hasta ' + maxCapacitaciones + ' capacitaciones.');
                }
            });

            // Función para agregar un nuevo formulario de capacitación
            function agregarCapacitacion() {
                if (capacitacionCount >= maxCapacitaciones) return;

                capacitacionCount++;
                const newId = 'capacitacion-' + capacitacionCount;

                const html = `
                    <div class="capacitacion-item" id="${newId}">
                        <h6>Capacitación #${capacitacionCount}</h6>
                        
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="nombre_curso_${capacitacionCount}" class="required-field">Nombre del Curso</label>
                                <input type="text" id="nombre_curso_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][nombre_curso]" class="form-control" required>
                            </div>
                            
                            <div class="col-md-4 form-group">
                                <label for="institucion_${capacitacionCount}" class="required-field">Institución Formadora</label>
                                <input type="text" id="institucion_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][institucion]" class="form-control" required>
                            </div>
                            
                            <div class="col-md-4 form-group">
                                <label for="anio_${capacitacionCount}" class="required-field">Año de Realización</label>
                                <input type="number" id="anio_${capacitacionCount}" name="capacitaciones[${capacitacionCount}][anio]" class="form-control" min="1900" max="${new Date().getFullYear()}" required>
                            </div>
                        </div>
                        
                        ${capacitacionCount > 1 ? `
                        <button type="button" class="btn btn-danger btn-sm btn-remove-capacitacion" onclick="eliminarCapacitacion('${newId}')">
                            <i class="fas fa-trash mr-1"></i>Eliminar esta capacitación
                        </button>
                        ` : ''}
                    </div>
                `;

                $('#lista-capacitaciones').append(html);

                // Ocultar botón de agregar si llegamos al máximo
                if (capacitacionCount >= maxCapacitaciones) {
                    $('#btn-add-capacitacion').hide();
                }
            }
        });

        // Función para eliminar una capacitación (definida en ámbito global)
        function eliminarCapacitacion(id) {
            $('#' + id).remove();

            // Reorganizar los números de las capacitaciones restantes
            const items = $('.capacitacion-item');
            capacitacionCount = items.length;

            items.each(function(index) {
                const newNum = index + 1;
                $(this).find('h6').text('Capacitación #' + newNum);

                // Actualizar los IDs y names de los inputs
                $(this).find('input, select').each(function() {
                    const oldName = $(this).attr('name');
                    if (oldName) {
                        const newName = oldName.replace(/capacitaciones\[\d+\]/,
                            `capacitaciones[${newNum}]`);
                        $(this).attr('name', newName);
                    }

                    const oldId = $(this).attr('id');
                    if (oldId) {
                        const newId = oldId.replace(/_(\d+)_/, `_${newNum}_`);
                        $(this).attr('id', newId);
                    }
                });
            });

            // Mostrar botón de agregar si no estamos en el máximo
            if (capacitacionCount < maxCapacitaciones) {
                $('#btn-add-capacitacion').show();
            }
        }

function Inscribir(event) {
    event.preventDefault();
    // Al inicio del archivo solicitud.js
  // Calcular el número de capacitaciones dinámicamente
    const capacitacionCount = $('#lista-capacitaciones .capacitacion-item').length;
    // Validar campos obligatorios base
    const requiredFields = [
        'id_diplomado', 'cedula_f', 'name_f', 'apellido_f', 
        'telefono_f', 'direccion_fiscal_', 'trabajo'
    ];
    
    let isValid = true;
    
    // Reset validaciones
    $('.is-invalid').removeClass('is-invalid');
    
    // Validar campos requeridos
    requiredFields.forEach(field => {
        const element = $(`[name="${field}"]`);
        if (!element.val()) {
            element.addClass('is-invalid');
            isValid = false;
        }
    });
     
    // Validar si tiene capacitación pero no ha agregado ninguna
    if ($('#tiene_capacitacion').val() === '1' && capacitacionCount === 0) {
        alert('Debe agregar al menos una capacitación relacionada con Contrataciones Públicas.');
        isValid = false;
    }
    // Validar formato cédula
    if (!/^\d{8}$/.test($('#cedula_f').val())) {
        $('#cedula_f').addClass('is-invalid');
        isValid = false;
    }
    
    // Validar email si está presente
    if ($('#correo').val() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($('#correo').val())) {
        $('#correo').addClass('is-invalid');
        isValid = false;
    }
    
    
    // Validar datos laborales si trabaja
    // if ($('#trabajo').val() == '1') {
    //     if (!$('#rif_b').val()) {
    //         $('#rif_b').addClass('is-invalid');
    //         isValid = false;
    //     } else if ($('#no_existe').is(':visible')) {
    //         // Validar campos de empresa si RIF no existe
    //         const requiredEmpresa = [
    //             'razon_social', 'tel_local',  'direccion_fiscal'
    //         ];
            
    //         requiredEmpresa.forEach(field => {
    //             const element = $(`[name="${field}"]`);
    //             if (!element.val()) {
    //                 element.addClass('is-invalid');
    //                 isValid = false;
    //             }
    //         });
    //     }
    // }
     if ($('#trabajo').val() == '1') {
        const rifIngresado = $('#rif_b').val();
        const rifExistente = $('#sel_rif_nombre5').val();
        
        if (!rifIngresado && !rifExistente) {
            $('#rif_b').addClass('is-invalid');
            isValid = false;
        } else if (!rifExistente && $('#no_existe').is(':visible')) {
            // Validar solo si no hay RIF existente y está visible no_existe
            const requiredEmpresa = [
                'razon_social', 'tel_local', 'id_estado_n',
                'id_municipio_n', 'id_parroquia_n', 'direccion_fiscal'
            ];
            
            requiredEmpresa.forEach(field => {
                const element = $(`[name="${field}"]`);
                if (!element.val()) {
                    element.addClass('is-invalid');
                    isValid = false;
                }
            });
        }
    }
    
    if (!isValid) {
        alert('Por favor complete todos los campos requeridos correctamente');
        return;
    }
    
    // Mostrar loader
    $('#guardar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Guardando...');
        // var base_url = window.location.origin+'/asnc/index.php/Diplomado/guardar_inscripcion';//guardar
        // var base_url2 = window.location.origin+'/asnc/index.php/Diplomado/preinscrip'; //redirigir
        // var base_url3 = window.location.origin+'/asnc/index.php/Preinscripcionnatural/pdfrt?id=';//ver la planilla despues de guardar
// Preparar datos para enviar
        var base_url = '/index.php/Diplomado/guardar_inscripcion';
        var base_url2 = '/index.php/Diplomado/preinscrip';
        var base_url3 = '/index.php/Preinscripcionnatural/pdfrt?id=';
         
    
    // Enviar datos
    $.ajax({
        url: base_url,
        type: 'POST',
        dataType: 'json',
        data: $('#sav_ext').serialize(),
        success: function(response) {
            if (response.success) {
                alert('Inscripción registrada con éxito. Código: ' + response.codigo);
                // Redirigir o limpiar formulario
                var link = document.createElement('a');
           var pdfUrl = base_url3 + response.codigo; // URL completa para el PDF
            var link = document.createElement('a');
            link.href = pdfUrl;
           //link.download = 'inscripcion_' + response.codigo ;
            // link.download = 'inscripcion_' + response.codigo + '.pdf';

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
    
    // Redirigir después de 2 segundos
    setTimeout(function() {
        window.location.href = base_url2 ; // Asegúrate que esta sea la ruta correcta
    }, 1000);
            } else {
                alert('Error: ' + response.message);
            }
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Inscripción');
        },
        error: function(xhr) {
            alert('Error en la conexión con el servidor');
            $('#guardar').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Inscripción');
        }
    });
}

// function Consultarplanilla(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
//     var rif_b = $('#rif_b').val();
//     if (rif_b == ''){
//         swal({
//             title: "¡ATENCION!",
//             text: "El campo no puede estar vacio.",
//             type: "warning",
//             showCancelButton: false,
//             confirmButtonColor: "#00897b",
//             confirmButtonText: "CONTINUAR",
//             closeOnConfirm: false
//         }, function(){
//             swal("Deleted!", "Your imaginary file has been deleted.", "success");
//         });
//         $('#ueba').attr("disabled", true);
//     }else{
//         $("#items").show();
//         var base_url  = window.location.origin+'/asnc/index.php/Diplomado/consulta_og';
//        // var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

//     //   var base_url = '/index.php/gestion/consulta_og';
//     //     var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

//         $.ajax({
//             url:base_url,
//             method: 'post',
//             data: {rif_b: rif_b},
//             dataType: 'json',
//             success: function(data){
//                 if (data == null) {
//                     $("#no_existe").show();
//                     $("#existe").hide();

//                    // $('#exitte').val(0);

//                 }else{
//                     $("#existe").show();
//                     $("#no_existe").hide();                  

//                     $('#total_pago').val(data['pay']);
//                     $('#fecha_limite_pago').val(data['fecha_limite_pago']);
                    

                    
                     
//                 }
//             }
//         })
//     }
// }

function Consultarplanilla() {
    var rif_b = $('#rif_b').val();
    
    if (!rif_b) {
        swal("¡ATENCION!", "El campo no puede estar vacío.", "warning");
        return;
    }

    // Mostrar loader mientras se consulta
    $('#loading').show();
    $("#existe").hide();
    $("#no_existe").hide();
        // var base_url = '/index.php/Diplomado/consulta_og';
        // var base_url = window.location.origin+'/asnc/index.php/Diplomado/consulta_og';
       var base_url = '/index.php/Diplomado/consulta_og';


    base_url
    $.ajax({
        url: base_url,
        
        method: 'POST',
        data: { rif_b: rif_b },
        dataType: 'json',
        success: function(response) {
            console.log("Respuesta del servidor:", response);
            $('#loading').hide();
            
            if (response.success) {
                $("#existe").show();
                $("#no_existe").hide();
                
                if(response.data) {
                    $('#fecha_limite_pago').val(response.data.fecha_limite_pago || '');
                    $('#id_inscripcion').val(response.data.id_inscripcion || '');
                    $('#total_pago').val(response.data.pronto_pago || '');
                    $('#pay').val(response.data.pay || '');
                    $('#codigo_planilla').val(response.data.codigo_planilla || '');

                    // Calcular para contado (total_pago)
                    calcularContado();
                    
                    // Calcular para crédito (pay)
                    calcularCredito();
                }
            } else {
                $("#no_existe").show();
                $("#existe").hide();
                
                // Limpiar todos los campos
                $('#fecha_limite_pago').val('');
                $('#id_inscripcion').val('');
                $('#total_pago').val('');
                $('#codigo_planilla').val('');
                $('#pay').val('');
                
                // Limpiar campos de contado
                $('#iva').val('');
                $('#total_iva').val('');
                
                // Limpiar campos de crédito
                $('#iva_credito').val('');
                $('#total_iva_credito').val('');
                $('#mitad_total_credito').val('');
                
                swal("No encontrado", response.message || 'Planilla no encontrada', "info");
            }
        },
        error: function(xhr) {
            $('#loading').hide();
            console.error("Error en la consulta:", xhr);
            swal("Error", "Ocurrió un error al consultar", "error");
        }
    });
}

// Función para calcular contado (total_pago)
function calcularContado() {
    var totalPagoStr = $('#total_pago').val().replace(/[^0-9.-]/g, '');
    var totalPago = parseFloat(totalPagoStr) || 0;
    
    var iva = totalPago * 0.16;
    var totalConIVA = totalPago + iva;
    
    $('#iva').val(iva.toFixed(2));
    $('#total_iva').val(totalConIVA.toFixed(2));
}

// Función para calcular crédito (pay)
function calcularCredito() {
    // Obtener valor del crédito
    var creditoStr = $('#pay').val().replace(/[^0-9.-]/g, '');
    var credito = parseFloat(creditoStr) || 0;
    
    // Calcular IVA (16%)
    var ivaCredito = credito * 0.16;
    
    // Calcular total con IVA
    var totalConIVACredito = credito + ivaCredito;
    
    // Calcular la mitad del total
    var mitadTotal = totalConIVACredito / 2;
    
    // Mostrar resultados
    $('#iva_credito').val(ivaCredito.toFixed(2));
    $('#total_iva_credito').val(totalConIVACredito.toFixed(2));
    $('#mitad_total_credito').val(mitadTotal.toFixed(2));
}

// Opcional: Escuchar cambios en los campos
$(document).ready(function() {
    $('#total_pago').on('change input', function() {
        calcularContado();
    });
    
    $('#pay').on('change input', function() {
        calcularCredito();
    });
});

 // Función para mostrar/ocultar campos según tipo de pago
 function togglePagoFields() {
    var tipoPago = $('#tipo_pago').val();
    
    $('#prontoPagoField').hide();
    $('#creditoPagoField').hide();
    
    if (tipoPago == '1') { // Pronto Pago
        $('#prontoPagoField').show();
    } else if (tipoPago == '2') { // Crédito
        $('#creditoPagoField').show();
    }
}

function validarRIF(input) {
    const errorElement = document.getElementById('rifError');
    const btnBuscar = document.querySelector('button[onclick="consultar_rif()"]');
    let valor = input.value.toUpperCase().replace(/[^JGV0-9]/g, '');  

    // Validación 1: Primer carácter debe ser J, G o V
    if (valor.length > 0 && !['J', 'G', 'V'].includes(valor[0])) {
        errorElement.textContent = "El RIF debe comenzar con J, G o V";
        errorElement.classList.remove('d-none');
        btnBuscar.disabled = true;
        input.value = valor = valor.replace(/[^JGV]/g, '');  
        return;
    }

    // Validación 2: Longitud exacta de 10 caracteres
    if (valor.length !== 10) {
        const faltantes = 10 - valor.length;
        errorElement.innerHTML = `Faltan <strong>${faltantes}</strong> caracteres (Ej: J123456789)`;
        errorElement.classList.remove('d-none');
        btnBuscar.disabled = true;
        return;
    }

    // Si pasa todas las validaciones:
    errorElement.classList.add('d-none');
    btnBuscar.disabled = false;
    input.value = valor; // Asegura el formato correcto
}

