function may(e){
	e.value = e.value.toUpperCase();
}
// function validateEmail(){
                
//     // Get our input reference.
//     var emailField = document.getElementById('email');
    
//     // Define our regular expression.
//     var validEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     var errorMsg = document.getElementById("errorMsgc");

//     // Using test we can check if the text match the pattern
//     if( validEmail.test(emailField.value) ){
//         errorMsg.style.color = "green";
//        errorMsg.innerHTML = "Correo valido.";
//         $("#guardar_user").prop('disabled', false)
//         return true;
//     }else{
//         errorMsg.style.color = "red";
//        errorMsg.innerHTML = "Correo No valido.Ingrese Corre Institucional";
//         $("#guardar_user").prop('disabled', true)
//         return false;
//     }
// }
function validateUsers() {
    var cedula = document.getElementById('cedula').value;
   // console.log('cedula:', cedula);
    var base_url = '/index.php/User/valida_ced4';
    var no=0;
    $.ajax({
      type: "POST",
      url: base_url,
      data: {
        cedula: cedula
      },    

      success: function(data) {
       
        data = data.trim();

        if (data == no) {
            alert('La cedula no existe, puede continuar');
       $("#guardar_user").prop('disabled', false)   

        } else {
            alert('La cedula ya existe, Revisa y vuelve a intentar');
            $("#guardar_user").prop('disabled', true)

        }
      }
    });
  }
  
function guardar_b(){
    var nombrefun = $("#nombrefun").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var cargo = $("#cargo").val();
    var tele_1 = $("#tele_1").val();
    var tele_2 = $("#tele_2").val();
    var oficina = $("#oficina").val();
    var fecha_designacion = $("#fecha_designacion").val();
    var numero_gaceta = $("#numero_gaceta").val();
    var obser = $("#obser").val();
    var email = $("#email").val();
    var usuario = $("#usuario").val();
    var nombrefun = $("#nombrefun").val();
    var password = $("#password").val();

    event.preventDefault();
    swal
        .fire({
            title: "¿Registrar?",
            text: "¿Esta seguro de registrar",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "¡Si, guardar!",
        })
        .then((result) => {
              
            if ($("#perfil option:selected").val() == 0) {
                alert("Debe Seleccionar un Perfil");
                document.getElementById("perfil").focus();
                return false;
            }
            if ($("#id_unidad option:selected").val() == 0) {
                alert("Debe Seleccionar  Organo/Ente *");
                document.getElementById("id_unidad").focus();
                return false;
            }
            if(nombrefun == ''){
                alert("Debe ingresar un Nombre")
                document.getElementById("nombrefun").focus();
                return false;
            }
            if(apellido == ''){
                alert("Debe ingresar un Apellido COmpleto")
                document.getElementById("apellido").focus();
                return false;
            }
            if(cedula == ''){
                alert("Debe ingresar Cedula de Indentidad")
                document.getElementById("cedula").focus();
                return false;
            }
            if(cargo == ''){
                alert("Debe ingresar cargo")
                document.getElementById("cargo").focus();
                return false;
            }
            if(tele_1 == ''){
                alert("Debe ingresar Telèfono")
                document.getElementById("tele_1").focus();
                return false;
            }
            if(tele_2 == ''){
                alert("Debe ingresar Telèfono 2 ")
                document.getElementById("tele_2").focus();
                return false;
            }
            if(oficina == ''){
                alert("Debe ingresar oficina ")
                document.getElementById("oficina").focus();
                return false;
            }         
            if(fecha_designacion == ''){
                alert("Debe ingresar fecha designaciòn ")
                document.getElementById("fecha_designacion").focus();
                return false;
            }
            if(numero_gaceta == ''){
                alert("Debe ingresar numero gaceta ")
                document.getElementById("numero_gaceta").focus();
                return false;
            }
            if(obser == ''){
                alert("Debe ingresar obser ")
                document.getElementById("Observaciòn").focus();
                return false;
            } if(email == ''){
                alert("Debe ingresar Correo Institucional ")
                document.getElementById("email").focus();
                return false;
            } if(usuario == ''){
                alert("Debe ingresar usuario ")
                document.getElementById("usuario").focus();
                return false;
            }
            if(password == ''){
                alert("Debe ingresar Contraseña ")
                document.getElementById("password").focus();
                return false;
            }
         
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_ba")[0]);
                //  var base_url =window.location.origin+'/asnc/index.php/User/save_user_c';
                var base_url = '/index.php/User/save_user_c';
                
                $.ajax({
                    url: base_url,
                    method: "POST",
                    data: datos,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var menj = 'Guardado';
                       
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
                        
                    },error: function(jqXHR, textStatus, errorThrown) {
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