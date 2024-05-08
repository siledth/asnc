
function validateMaxLength(input) {
    var maxLength = 20;
    var errorMsg = document.getElementById("errorMsg");
   
    if (input.value.length > maxLength) {
       input.value = input.value.slice(0, maxLength);
       errorMsg.style.color = "red";
       errorMsg.innerHTML = "El texto ingresado no puede superar los 20 caracteres.";
       $("#guardar_organo").prop('disabled', true)

    } else {
       errorMsg.innerHTML = "";
       $("#guardar_organo").prop('disabled', false)

    }
   }
function guardar_b(){
    var organo = $("#organo").val();
    var cod_onapre = $("#cod_onapre").val();
    var siglas = $("#siglas").val();
    var rif = $("#rif").val();
    var tel_local = $("#tel_local").val();
    var tel_local_2 = $("#tel_local_2").val();
    var tel_movil = $("#tel_movil").val();
    var tel_movil_2 = $("#tel_movil_2").val();
    var pag_web = $("#pag_web").val();
    var direccion_fiscal = $("#direccion_fiscal").val();
    var email = $("#email").val();
    var gaceta_oficial = $("#gaceta_oficial").val();
    var fecha_gaceta = $("#fecha_gaceta").val();

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
              
            
            if ($("#id_clasificacion option:selected").val() == 0) {
                alert("Debe Seleccionar Clasificaciòn *");
                document.getElementById("id_clasificacion").focus();
                return false;
            }
             if ($("#id_estado_n option:selected").val() == 0) {
                alert("Debe Seleccionar un estado *");
                document.getElementById("id_estado_n").focus();
                return false;
            }
             if ($("#id_municipio_n option:selected").val() == 0) {
                alert("Debe Seleccionar municipio *");
                document.getElementById("id_municipio_n").focus();
                return false;
            }
             if ($("#id_parroquia_n option:selected").val() == 0) {
                alert("Debe Seleccionar parroquia *");
                document.getElementById("id_parroquia_n").focus();
                return false;
            }
            if(organo == ''){
                alert("Debe ingresar Razon Social")
                document.getElementById("organo").focus();
                return false;
            }
            if(cod_onapre == ''){
                alert("Debe ingresar un Codigo Onapre")
                document.getElementById("cod_onapre").focus();
                return false;
            }
            if(siglas == ''){
                alert("Debe ingresar siglas")
                document.getElementById("siglas").focus();
                return false;
            }
            if(rif == ''){
                alert("Debe ingresar Rif")
                document.getElementById("rif").focus();
                return false;
            }
            if(tel_local == ''){
                alert("Debe ingresar Telèfono")
                document.getElementById("tel_local").focus();
                return false;
            }
            if(tel_local_2 == ''){
                alert("Debe ingresar Telèfono 2 ")
                document.getElementById("tel_local_2").focus();
                return false;
            }
            if(tel_movil == ''){
                alert("Debe ingresar telefono Movil ")
                document.getElementById("tel_movil").focus();
                return false;
            }         
            if(tel_movil_2 == ''){
                alert("Debe ingresar fecha designaciòn ")
                document.getElementById("tel_movil_2").focus();
                return false;
            }
            if(pag_web == ''){
                alert("Debe ingresar numero gaceta ")
                document.getElementById("pag_web").focus();
                return false;
            }
           if(email == ''){
                alert("Debe ingresar Correo Institucional ")
                document.getElementById("email").focus();
                return false;
            } if(direccion_fiscal == ''){
                alert("Debe ingresar Direcciòn Fiscal ")
                document.getElementById("direccion_fiscal").focus();
                return false;
            }
            if(gaceta_oficial == ''){
                alert("Debe ingresar Gaseta Oficial ")
                document.getElementById("gaceta_oficial").focus();
                return false;
            }
            if(fecha_gaceta == ''){
                alert("Debe ingresar Fecha gaceta ")
                document.getElementById("fecha_gaceta").focus();
                return false;
            }
         
            if (result.value == true) {
                event.preventDefault();
                var datos = new FormData($("#guardar_ba")[0]);
                //            var base_url =window.location.origin+'/asnc/index.php/Programacion/guardar_rendi_bienes_acc';
                var base_url = '/index.php/Configuracion/save_org_';
                
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