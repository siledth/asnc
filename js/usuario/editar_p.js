function getSelectedRif() {
    var selectedValue = $('#camb_org').val();
    var rifValue = selectedValue.split('/')[0];
    var codevalue = selectedValue.split('/')[1];
    $('#code1').val(codevalue);
   
    $('#rif1').val(rifValue);
    console.log(rifValue);
    console.log(codevalue);
 

  }
  
  // Luego, puedes llamar a la función cuando quieras obtener el valor del rif seleccionado
  getSelectedRif();
  
  // También puedes asociar la función al evento change del select
  $('#camb_org').on('change', function() {
    getSelectedRif();
  });
//function trae_inf() {
    // $(document).on('select2:select', '#camb_org', function (e) {
    //     var camb_org = e.params.data['id'];
    //     var base_url3 = '/index.php/User/organo_ent1';
    
    //     $.ajax({
    //         url: base_url3,
    //         method: "post",
    //         data: { camb_org: camb_org },
    //         dataType: "json",
    
    //         success: function(response) {
    //             // Ensure that the input element exists in the DOM
    //             if ($("#code1").length) {
    //                 // Show the modal before setting the value of the input field
    //                 $('#myModal_bienes').modal('show');
                
    //                 // Wait for the modal to be fully displayed before setting the value
    //                 setTimeout(function() {
    //                   $("#code1").val(response["codigo"]);
    //                 }, 500);
    //               }
    //         },
    //     });
    // });
function modal(id) {
    var id = id;
       
        var base_url = '/index.php/User/read_list';
         var base_url2 = '/index.php/User/consultar_perfiles1';
         var base_url3 = '/index.php/User/organo_ent';
    $.ajax({
        url: base_url,
        method: "post",
        data: { id: id },
        dataType: "json",
        success: function(data) {
            $('#id').val(id);
         //   $("#id_organoente").val(id_organoente);
            $("#rif_organoente1").val(data["rif_organoente"]);
            $("#descripcion").val(data["descripcion"]);
            $("#nombrep").val(data["nombrep"]);
            $("#id_perfil").val(data["id_perfil"]);
            $("#unidad1").val(data["und"]);
            $("#nombrefun").val(data["nombrefun"]);  
            $("#apellido").val(data["apellido"]);
            $("#cedula").val(data["cedula"]); 
            $("#cargo").val(data["cargo"]); 
            $("#email").val(data["email"]); 



             




                   
          
// llena el select de unidad de medida
            var id_perfil = data['id_perfil'];
             
        $.ajax({
            url:base_url2,
            method: 'post',
            data: {id_perfil: id_perfil},
            dataType: 'json',
            success: function(data){
                $.each(data, function(index, data){
                    $('#cambio_perf').append('<option value="'+data['id_perfil']+'">'+data['nombrep']+'</option>');

                });
            }
        })
            
        var rif = data['rif_organoente'];
             
        $.ajax({
            url:base_url3,
            method: 'post',
            data: {rif: rif},
            dataType: 'json',
            success: function(data){
                $.each(data, function(index, data){
                    $('#camb_org').append('<option value="'+data['rif']+'/' +data['codigo']+'">'+data['descripcion']+'/   ' +data['rif']+'</option>');

                });
            }
        })

        },
    });
}
function validateEmail(){
                
    // Get our input reference.
    var emailField = document.getElementById('email');
    
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

function save_modif_user(){//////////////////////////////////////////accion central
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
            var id = $('#id').val();
            var nombrefun = $('#nombrefun').val();
            var apellido = $('#apellido').val();
            var id_perfil = $('#id_perfil').val();
            var cambio_perf = $('#cambio_perf').val();
            var rif_organoente1 = $('#rif_organoente1').val();
            var unidad1 = $('#unidad1').val();
            var camb_org = $('#camb_org').val();
            var code1 = $('#code1').val();
            var rif1 = $('#rif1').val();
            var cedula = $('#cedula').val();
            var cargo = $('#cargo').val();
            var email = $('#email').val();
            

   
            var base_url = '/index.php/User/save_modif_user1'; 

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id: id,
                    nombrefun: nombrefun, 
                    apellido: apellido, 
                    id_perfil: id_perfil,
                    cambio_perf: cambio_perf,
                    rif_organoente1: rif_organoente1,
                    unidad1: unidad1,
                    camb_org: camb_org,
                    code1: code1,
                    rif1: rif1,
                    cedula: cedula,
                    cargo: cargo,
                    email: email,                   

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
                            if (result.value == 1) {
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
            })
        }
    });
}