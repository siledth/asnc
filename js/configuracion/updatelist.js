function modal(id) {
    var id_organoente = id;
       
        var base_url = '/index.php/Configuracion/read_list';
         var base_url2 = '/index.php/Configuracion/llenar_edo';
        // var base_url7 = '/index.php/Configuracion/llenar_ff_';
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_organoente: id_organoente },
        dataType: "json",
        success: function(data) {
            $('#id_organoentes').val(id);
            $("#id_organoente").val(id_organoente);
            $("#rif").val(data["rif"]);
            $("#descripcion").val(data["descripcion"]);
            $("#cod_onapre").val(data["cod_onapre"]);
            $("#siglas").val(data["siglas"]);
            $("#pagina_web").val(data["pagina_web"]);
            $("#correo").val(data["correo"]);  
            $("#id_estado").val(data["id_estado"]); 
            $("#descedo").val(data["descedo"]); 
            $("#id_municipio").val(data["id_municipio"]);  
            $("#descmun").val(data["descmun"]);  
            $("#id_parroquia").val(data["id_parroquia"]);  
            $("#descparro").val(data["descparro"]);  
            $("#direccion_fiscal").val(data["direccion"])
            $("#gaceta").val(data["gaceta"]);  
            $("#fecha_gaceta").val(data["fecha_gaceta"]);  
            $("#tel1").val(data["tel1"]);  
            $("#tel2").val(data["tel2"]);  
            $("#movil1").val(data["movil1"]);  
            $("#movil2").val(data["movil2"]);  




                   


// llena el select de unidad de medida
            var id_estado = data['id_estado'];
             
        $.ajax({
            url:base_url2,
            method: 'post',
            data: {id_estado: id_estado},
            dataType: 'json',
            success: function(data){
                $.each(data, function(index, data){
                    $('#cambio_edo').append('<option value="'+data['id']+'">'+data['descedo']+'</option>');

                });
            }
        })
            

          
        },
    });
}


function llenar_muni(){
    var id_edos = $('#cambio_edo').val();
    var base_url = '/index.php/Configuracion/llenar_munic';
    var base_url2 = '/index.php/Configuracion/llenar_parroq';


    $.ajax({
        url: base_url,
        method:'post',
        data: {id_edos: id_edos},
        dataType:'json',
        
        success: function(response){
            $('#camb_muni').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#camb_muni').append('<option value="'+data['id']+'">'+data['descmun']+'</option>');
            });
        }
    });

    $.ajax({
        url: base_url2,
        method:'post',
        data: {id_edos: id_edos},
        dataType:'json',
        
        success: function(response){
            $('#camb_parrq').find('option').not(':first').remove();
            $.each(response, function(index, data){
                $('#camb_parrq').append('<option value="'+data['id']+'">'+data['descparro']+'</option>');
            });
        }
    });
}
function validateEmail(){
                
    // Get our input reference.
    var emailField = document.getElementById('correo');
    
    // Define our regular expression.
    var validEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var errorMsg = document.getElementById("errorMsgc");

    // Using test we can check if the text match the pattern
    if( validEmail.test(emailField.value) ){
        errorMsg.style.color = "green";
       errorMsg.innerHTML = "Correo valido.";
        $("#btn_guar_2").prop('disabled', false)
        return true;
    }else{
        errorMsg.style.color = "red";
       errorMsg.innerHTML = "Correo No valido.Ingrese Corre Institucional";
        $("#btn_guar_2").prop('disabled', true)
        return false;
    }
}
function validateMaxLength(input) {
    var maxLength = 11;
    var errorMsg = document.getElementById("errorMsg");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El texto ingresado no puede superar los 11 caracteres.";
       $("#btn_guar_2").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#btn_guar_2").prop('disabled', false)

    }
   }
   function validateMaxLength2(input) {
    var maxLength = 11;
    var errorMsg = document.getElementById("errorMsg2");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El texto ingresado no puede superar los 11 caracteres.";
       $("#btn_guar_2").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#btn_guar_2").prop('disabled', false)

    }
   }
   function validateMaxLength3(input) {
    var maxLength = 11;
    var errorMsg = document.getElementById("errorMsg3");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El texto ingresado no puede superar los 11 caracteres.";
       $("#btn_guar_2").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#btn_guar_2").prop('disabled', false)

    }
   }
   function validateMaxLength4(input) {
    var maxLength = 11;
    var errorMsg = document.getElementById("errorMsg4");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El texto ingresado no puede superar los 11 caracteres.";
       $("#btn_guar_2").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#btn_guar_2").prop('disabled', false)

    }
   }

   function save_modif_org(){//////////////////////////////////////////accion central
    event.preventDefault();

    swal.fire({
        title: '¿Seguro desea Modificar? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_organoente = $('#id_organoente').val();
            var descripcion = $('#descripcion').val();
            var correo = $('#correo').val();
            var cod_onapre = $('#cod_onapre').val();
            var siglas = $('#siglas').val();
            var pagina_web = $('#pagina_web').val();
            var id_estado = $('#id_estado').val();
            var cambio_edo = $('#cambio_edo').val();
            var id_municipio = $('#id_municipio').val();
            var camb_muni = $('#camb_muni').val();
            var id_parroquia = $('#id_parroquia').val();
            var camb_parrq = $('#camb_parrq').val();
            var direccion_fiscal = $('#direccion_fiscal').val();
            var tel1 = $('#tel1').val();
            var tel2 = $('#tel2').val();
            var movil1 = $('#movil1').val();
            var movil2 = $('#movil2').val();
            var gaceta = $('#gaceta').val();

   
            var base_url = '/index.php/Configuracion/save_modif_org1'; 

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_organoente: id_organoente,
                    descripcion: descripcion, 
                    correo: correo, 
                    cod_onapre: cod_onapre,
                    siglas: siglas,
                    pagina_web: pagina_web,
                    id_estado: id_estado,
                    cambio_edo: cambio_edo,
                    id_municipio: id_municipio,
                    camb_muni: camb_muni,
                    id_parroquia: id_parroquia,
                    camb_parrq: camb_parrq,
                    direccion: direccion_fiscal,
                    tel1: tel1,
                    tel2: tel2,
                    movil1: movil1,
                    movil2: movil2,
                    gaceta: gaceta,                   

                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se Modifico la información con exito.',
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