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
        // var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

    //   var base_url = '/index.php/gestion/consulta_og';
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
   var base_url = window.location.origin+'/asnc/index.php/User/listar_municipio';
    // var base_url = '/index.php/evaluacion_desempenio/listar_municipio';

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
function llenar_parroquia(){
    var id_municipio_n = $('#id_estado_n').val();
   var base_url = window.location.origin+'/asnc/index.php/User/listar_parroquia';
    // var base_url = '/index.php/evaluacion_desempenio/listar_parroquia';

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
            title: "Solicitar?",
            text: "¿Está seguro de enviar la solicitud?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Sí, guardar!",
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
                var base_url = window.location.origin + '/asnc/index.php/User/save_solicitud';
                var base_url_3 = window.location.origin + '/asnc/index.php/Solicitud/pdfrt?id=';

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
                                title: 'Solicitud Exitosa',
                                text: 'Número de Solicitud: ' + response,
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
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
            title: 'Debe ingresar un correo institucional, para continuars',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        });
    }