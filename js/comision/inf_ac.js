function modal_ce(id_miembros) {
    var id = id_miembros;

   var base_url = '/index.php/Comision_contrata/consultar_t';
      // var base_url2 = '/index.php/certificacion/llenar_contratista_rp';

    //  var base_url =
    //      window.location.origin + "/asnc/index.php/Certificacion/consultar_certificacion";

   

    $.ajax({
        url: base_url,
        method: "post",
        data: { id: id },
        dataType: "json",
        success: function(data) {
            $("#id_mesualidad_ver").val(id);
          
            

        },
    });
}
function modal(id) {
    var id_miembros = id;          
    var base_url = '/index.php/Comision_contrata/check_comision_inf';    
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_miembros: id_miembros },
        dataType: "json",
        success: function(data) {
            $("#id_miembros").val(id_miembros);
            $("#rif_organoente2").val(data["rif_organoente"]);
            $("#id_comision").val(data["id_comision"]);


          

        },
        
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'ocurrio un error, por favor vuelva a intentar.'
                    });
                }
    });
}
function modal_(id) {
    var id_miembros = id;          
    var base_url = '/index.php/Comision_contrata/check_comision_inf';    
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_miembros: id_miembros },
        dataType: "json",
        success: function(data) {
            $("#id_miembros3").val(id_miembros);
            $("#rif_organoente3").val(data["rif_organoente"]);
            $("#id_comision3").val(data["id_comision"]);


          

        },
        
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'ocurrio un error, por favor vuelva a intentar.'
                    });
                }
    });
}
function modal_contrata(id) {
    var id_miembros = id;          
    var base_url = '/index.php/Comision_contrata/check_comision_inf';    
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_miembros: id_miembros },
        dataType: "json",
        success: function(data) {
            $("#id_miembros4").val(id_miembros);
            $("#rif_organoente4").val(data["rif_organoente"]);
            $("#id_comision4").val(data["id_comision"]);


          

        },
        
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'ocurrio un error, por favor vuelva a intentar.'
                    });
                }
    });
}
function modal_comis(id) {
    var id_miembros = id;          
    var base_url = '/index.php/Comision_contrata/check_comision_inf';    
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_miembros: id_miembros },
        dataType: "json",
        success: function(data) {
            $("#id_miembros8").val(id_miembros);
            $("#rif_organoente8").val(data["rif_organoente"]);
            $("#id_comision8").val(data["id_comision"]);


          

        },
        
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'ocurrio un error, por favor vuelva a intentar.'
                    });
                }
    });
}
function save_inf_ac(){
    event.preventDefault();

    swal.fire({
        title: '¿Guardar',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si!'
    }).then((result) => {
        if (result.value == true) {
            var id_comision = $('#id_comision').val();
            var rif_organoente = $('#rif_organoente2').val();
            var id_miembros = $('#id_miembros').val();

            var fm_ac = $('#fm_ac').val();
            var titulo= $('#titulo').val();
            var anioi = $('#anioi').val();
            var anioc = $('#anioc').val();
            var curso = $('#curso').val();
           
              if(titulo == ''){
                alert("el campo titulo no puede quedar vacio")            
                document.getElementById("titulo").focus();
                return false;
            }
             if(anioi == ''){
                alert("el campo Año de Inicio no puede quedar vacio")            
                document.getElementById("anioi").focus();
                return false;
            }
          
            if ($("#fm_ac option:selected").val() == 0) {
                alert("Seleccione Área");
                document.getElementById("fm_ac").focus();
                return false;
            }
            if ($("#curso option:selected").val() == 0) {
                alert("Seleccione Cursando");
                document.getElementById("curso").focus();
                return false;
            }
            // if ($("#datedsg").val() === "") {
            //     alert("debe ingresar Fecha de Designación .");
            //     event.preventDefault();
            //   }
            //   if ($("#acto").val() === "") {
            //     alert("debe ingresar Acto Administrativo de Designación .");
            //     event.preventDefault();
            //   }
           

            var base_url = '/index.php/Comision_contrata/save_inff';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                     id_comision: id_comision,                        
                    rif_organoente: rif_organoente,
                    id_miembros:id_miembros,
                   
                    fm_ac: fm_ac,
                    titulo: titulo,
                    anioi: anioi,
                    anioc: anioc,
                    curso: curso,       


                },
                
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Guardado.',
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
                   
                } ,
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'ocurrio un error, por favor vuelva a intentar.'
                    });
                }
                
            }) 
        }
    });
}
function save_expe(){
    event.preventDefault();

    swal.fire({
        title: '¿Guardar',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si!'
    }).then((result) => {
        if (result.value == true) {
            var id_comision = $('#id_comision3').val();
            var rif_organoente = $('#rif_organoente3').val();
            var id_miembros = $('#id_miembros3').val();

            var id_unidad = $('#id_unidad').val();
            var area= $('#area').val();
            var cargo = $('#cargo').val();
            var desde = $('#desde').val();
            var hasta = $('#hasta').val();
            var act = $('#act').val();

           
              if(area == ''){
                alert("el campo area no puede quedar vacio")            
                document.getElementById("area").focus();
                return false;
            }
             if(cargo == ''){
                alert("el campo cargo no puede quedar vacio")            
                document.getElementById("cargo").focus();
                return false;
            }
            if(desde == ''){
                alert("el campo desde no puede quedar vacio")            
                document.getElementById("desde").focus();
                return false;
            }  if(hasta == ''){
                alert("el campo hasta no puede quedar vacio")            
                document.getElementById("hasta").focus();
                return false;
            }
          
            if ($("#id_unidad option:selected").val() == 0) {
                alert("Seleccione Organo/ente");
                document.getElementById("id_unidad").focus();
                return false;
            }
            if ($("#act option:selected").val() == 0) {
                alert("Seleccione Actual");
                document.getElementById("act").focus();
                return false;
            }
            // if ($("#datedsg").val() === "") {
            //     alert("debe ingresar Fecha de Designación .");
            //     event.preventDefault();
            //   }
            //   if ($("#acto").val() === "") {
            //     alert("debe ingresar Acto Administrativo de Designación .");
            //     event.preventDefault();
            //   }
           

            var base_url = '/index.php/Comision_contrata/save_exp';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                     id_comision: id_comision,                        
                    rif_organoente: rif_organoente,
                    id_miembros:id_miembros,
                   
                    id_unidad: id_unidad,
                    area: area,
                    cargo: cargo,
                    desde: desde,
                    hasta: hasta, 
                    act: act,       



                },
                
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Guardado.',
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
                   
                } ,
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire({
                        title: 'Error',
                        type: 'error',
                        text: 'ocurrio un error, por favor vuelva a intentar.'
                    });
                }
                
            }) 
        }
    });
}

function consultar_rif7(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var rif_b = $('#rif_b7').val();
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
        // var base_url  = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista';
        // var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

      var base_url = '/index.php/evaluacion_desempenio/llenar_contratista_2';
        var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

        $.ajax({
            url:base_url,
            method: 'post',
            data: {rif_b: rif_b},
            dataType: 'json',
            success: function(data){
                if (data == null) {
                    $("#no_existe1").show();
                    $("#existe1").hide();

                   // $('#exitte').val(0);

                }else{
                    $("#existe1").show();
                    $("#no_existe1").hide();                  

                    $('#sel_rif_nombre7').val(data['rifced']);
                    $('#nombre_conta_7').val(data['nombre']);
                    

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
function validateMaxLength4(input) {
    var maxLength = 10;
    var errorMsg = document.getElementById("errorMsg4");
   
    if (input.value.length < maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El Rif ingresado no puede ser menor de 10 caracteres. por favor ingrese un rif correcto";
       $("#rendi_py1").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#rendi_py1").prop('disabled', false)

    }
   }
   function validateMaxLength3(input) {
    var maxLength = 10;
    var errorMsg = document.getElementById("errorMsg3");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El Rif ingresado no puede superar los 11 caracteres.por favor ingrese un rif correcto";
       $("#rendi_py1").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#rendi_py1").prop('disabled', false)

    }
   }
   function validateMaxLength1(input) {
    var maxLength = 10;
    var errorMsg = document.getElementById("errorMsg1");
   
    if (input.value.length < maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El Rif ingresado no puede ser menor de 10 caracteres. por favor ingrese un rif correcto";
       $("#rendi_py1").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#rendi_py1").prop('disabled', false)

    }
   }
   function validateMaxLength2(input) {
    var maxLength = 10;
    var errorMsg = document.getElementById("errorMsg2");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El Rif ingresado no puede superar los 11 caracteres.por favor ingrese un rif correcto";
       $("#rendi_py1").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#rendi_py1").prop('disabled', false)

    }
   }
   function rendi_py101(){
    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de registrar ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
           
 if (document.rendir_py.rif_b7.value.length==0){
    alert("No Puede dejar el campo Rif Contratista vacio, Ingrese un valor")
    document.rendir_py.rif_b7.focus()
    return 0;
}  
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#rendir_py")[0]);
                //            var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_bienes_acc';
                var base_url = '/index.php/Comision_contrata/save_rtre';
                
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var menj = 'ok';
                       
                       if (response != '') {
                        swal.fire({
                            title: 'Registro Exitoso ',
                            text: menj ,
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true){
                                location.reload();
                            }
                        });
                        }
                        
                    }, 
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error',
                            text: 'ocurrio un error, por favor vuelva a intentar.'
                        });
                    }
                });
            }
        });
    
}

////////////
function consultar_rif8(){ //PARA LLENAR EN SELECT DE CCNNU DENTRO DEL MODAL
    var rif_b = $('#rif_b8').val();
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
        // var base_url  = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista';
        // var base_url2 = window.location.origin+'/asnc/index.php/evaluacion_desempenio/llenar_contratista_rp';

      var base_url = '/index.php/evaluacion_desempenio/llenar_contratista_2';
        var base_url2 = '/index.php/evaluacion_desempenio/llenar_contratista_rp';

        $.ajax({
            url:base_url,
            method: 'post',
            data: {rif_b: rif_b},
            dataType: 'json',
            success: function(data){
                if (data == null) {
                    $("#no_existe8").show();
                    $("#existe8").hide();

                   // $('#exitte').val(0);

                }else{
                    $("#existe8").show();
                    $("#no_existe8").hide();                  

                    $('#sel_rif_nombre8').val(data['rifced']);
                    $('#nombre_conta_8').val(data['nombre']);
                    

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
function validateMaxLength8(input) {
    var maxLength = 10;
    var errorMsg = document.getElementById("errorMsg5");
   
    if (input.value.length < maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El Rif ingresado no puede ser menor de 10 caracteres. por favor ingrese un rif correcto";
       $("#tt").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#tt").prop('disabled', false)

    }
   }
   function validateMaxLength9(input) {
    var maxLength = 10;
    var errorMsg = document.getElementById("errorMsg6");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El Rif ingresado no puede superar los 11 caracteres.por favor ingrese un rif correcto";
       $("#tt").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#tt").prop('disabled', false)

    }
   }
   function validateMaxLength10(input) {
    var maxLength = 10;
    var errorMsg = document.getElementById("errorMsg7");
   
    if (input.value.length < maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El Rif ingresado no puede ser menor de 10 caracteres. por favor ingrese un rif correcto";
       $("#tt").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#tt").prop('disabled', false)

    }
   }
   function validateMaxLength11(input) {
    var maxLength = 10;
    var errorMsg = document.getElementById("errorMsg8");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El Rif ingresado no puede superar los 11 caracteres.por favor ingrese un rif correcto";
       $("#tt").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#tt").prop('disabled', false)

    }
   }
   function rendi_py1012(){
    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de registrar ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
           
 if (document.rendir_py8.rif_b8.value.length==0){
    alert("No Puede dejar el campo Rif Contratista vacio, Ingrese un valor")
    document.rendir_py8.rif_b8.focus()
    return 0;
}  
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#rendir_py8")[0]);
                //            var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_bienes_acc';
                var base_url = '/index.php/Comision_contrata/save_rtre8';
                
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var menj = 'ok';
                       
                       if (response != '') {
                        swal.fire({
                            title: 'Registro Exitoso ',
                            text: menj ,
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true){
                                location.reload();
                            }
                        });
                        }
                        
                    }, 
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Error',
                            type: 'error',
                            text: 'ocurrio un error, por favor vuelva a intentar.'
                        });
                    }
                });
            }
        });
    
}

function enviar(id_miembros) {


    event.preventDefault();
    swal
        .fire({
            title: "¿Termino de realizar la Carga de Información de este Miembro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si!",
        })
        .then((result) => {
            if (result.value == true) {
                var id = id_miembros;
              var base_url =window.location.origin+'/asnc/index.php/Comision_contrata/carga_completa';
            //    var base_url = '/index.php/Comision_contrata/carga_completa';
                   
                $.ajax({
                    url: base_url,
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response == 1) {
                            swal
                                .fire({
                                    title: "Proceso Enviado",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Ok",
                                })
                                .then((result) => {
                                    if (result.value == true) {
                                        location.reload();
                                    }
                                });
                        }
                    },error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire({
                            title: 'Atenciòn',
                            type: 'error',
                            text: 'revise la informacion y intente de nuevo'
                        });
                    }
                });
            }
        });
    }
    function guardar_nuevoestatus(){////////////////////////////////
        event.preventDefault();
    
        swal.fire({
            title: '¿Seguro desea Certificar? ',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si!'
        }).then((result) => {
            if (result.value == true) {
                var id_miembros = $('#id_mesualidad_ver').val();
                var vigen_cert_desde = $('#vigen_cert_desde').val();
                var vigen_cert_hasta = $('#vigen_cert_hasta').val();
                 
                var base_url = '/index.php/Comision_contrata/miembro_condicionado_cer'; 
    
                $.ajax({
                    url:base_url,
                    method: 'post',
                    data:{
                        id_miembros: id_miembros,
                        vigen_cert_desde: vigen_cert_desde, 
                        vigen_cert_hasta: vigen_cert_hasta,
                         
    
                    },
                    dataType: 'json',
                    success: function(response){
                        if(response == 1) {
                            swal.fire({
                                title: ' exito.',
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
    function cambiarEndDate(){

        f = $("#vigen_cert_desde").val();; // Acá la fecha leída del INPUT
        vec = f.split('-'); // Parsea y pasa a un vector
        var fecha = new Date(vec[0], vec[1], vec[2]); // crea el Date
        fecha.setFullYear(fecha.getFullYear()+2); // Hace el cálculo
        res = fecha.getFullYear()+'-'+fecha.getMonth()+'-'+fecha.getDate(); // carga el resultado
        $('#vigen_cert_hasta').val(res);
        //console.log(res);f;
    }
    //////////////////////////////////////////////////////
    $('#fcerti').on('change', function(){
        $('#vigencia').val(calcular_edad2());
    });
    
    vigencia
    
    function calcular_edad2()
    {
        var fecha_seleccionada = $("#fcerti").val();
        var fehca_nacimiento = new Date (fecha_seleccionada);
        var fecha_actual = new Date();
        var vigencia = (parseInt((fecha_actual- fehca_nacimiento)/(1000*60*60*24*365)));
        return vigencia;
    }
      //////////////////////////////////////////////////////
      $('#fcerti8').on('change', function(){
        $('#vigencia8').val(calcular_edad());
    });
    
    vigencia
    
    function calcular_edad()
    {
        var fecha_seleccionada = $("#fcerti8").val();
        var fehca_nacimiento = new Date (fecha_seleccionada);
        var fecha_actual = new Date();
        var vigencia = (parseInt((fecha_actual- fehca_nacimiento)/(1000*60*60*24*365)));
        return vigencia;
    }

    function modal_ce(id_miembros) {
        var id = id_miembros;
    
       var base_url = '/index.php/Comision_contrata/consultar_t';
          // var base_url2 = '/index.php/certificacion/llenar_contratista_rp';
    
        //  var base_url =
        //      window.location.origin + "/asnc/index.php/Certificacion/consultar_certificacion";
    
       
    
        $.ajax({
            url: base_url,
            method: "post",
            data: { id: id },
            dataType: "json",
            success: function(data) {
                $("#id_mesualidad_ver").val(id);
              
                
    
            },
        });
    }