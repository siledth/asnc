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

function handleGacetaInputModal() {
    const gacetaInput = document.getElementById('gaceta__max_a_f_modal');
    const gfechaInput = document.getElementById('gfecha__max_a_f_modal');
    const gacetaValue = gacetaInput.value.trim().toLowerCase();

    if (gacetaValue === 's/i' || gacetaValue === 'sin informacion' || gacetaValue === 'si') {
        const today = new Date();
        const year = today.getFullYear();
        const month = (today.getMonth() + 1).toString().padStart(2, '0');
        const day = today.getDate().toString().padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;

        gfechaInput.value = formattedDate;
        gfechaInput.readOnly = true;
        gfechaInput.style.backgroundColor = '#e9ecef';
    } else {
        gfechaInput.value = '';
        gfechaInput.readOnly = false;
        gfechaInput.style.backgroundColor = '';
    }
}

// Función para abrir el modal de Máxima Autoridad y cargar sus datos
function openMaximaAutoridadModal(id_organoente) {
    // 1. Limpiar los campos del modal y restablecer su estado
    $('#form_max_autoridad').trigger('reset'); // Limpia todos los campos del formulario
    $('#id_organoente_max_auth').val(id_organoente); // Establece el ID del órgano en el campo oculto

    // Asegurarse de que los campos estén editables por defecto antes de cargar datos
    $('#cedula__max_a_f_modal').prop('readonly', false).val('');
    $('#name_max_a_f_modal').prop('readonly', false).val('');
    $('#cargo__max_a_f_modal').prop('readonly', false).val('');
    $('#actoad__max_a_f_modal').prop('disabled', false).val('0'); // Habilitar select y resetear
    $('#n__max_a_f_modal').prop('readonly', false).val('');
    $('#fecha__max_a_f_modal').prop('readonly', false).val('');
    $('#gaceta__max_a_f_modal').prop('readonly', false).val('');
    $('#gfecha__max_a_f_modal').prop('readonly', false).val('');
    $('#gfecha__max_a_f_modal').css('background-color', ''); // Restablecer estilo de fecha

    // 2. Realizar la llamada AJAX para obtener los datos de la Máxima Autoridad
     var base_url = '/index.php/Configuracion/get_maxima_autoridad_data';

    // var base_url = window.location.origin + '/asnc/index.php/Configuracion/get_maxima_autoridad_data';


    $.ajax({
        url: base_url,
        method: 'POST',
        data: { id_organoente: id_organoente },
        dataType: 'json',
        success: function(response) {
            console.log("Respuesta AJAX Máxima Autoridad:", response);
            if (response.status === 'success' && response.data) {
                const data = response.data;
                // Rellenar los campos del modal con los datos obtenidos
                $('#cedula__max_a_f_modal').val(data.cedula);
                $('#name_max_a_f_modal').val(data.nombre);
                $('#cargo__max_a_f_modal').val(data.cargo);
                $('#actoad__max_a_f_modal').val(data.id_acto_admin).prop('disabled', false); // Seleccionar opción y habilitar
                $('#n__max_a_f_modal').val(data.n_acto_admin);
                $('#fecha__max_a_f_modal').val(data.fecha_acto_admin);
                $('#gaceta__max_a_f_modal').val(data.gaceta);
                $('#gfecha__max_a_f_modal').val(data.fecha_gaceta);

                // Re-aplicar la lógica de Gaceta por si ya viene S/I
                handleGacetaInputModal();

            } else {
                // Si no hay datos, los campos ya están limpios por el trigger('reset')
                // y editables por el seteo inicial.
                swal.fire({
                    title: "Información no encontrada",
                    text: "No se encontraron datos de Máxima Autoridad para este Órgano/Ente. Por favor, ingréselos.",
                    type: "info",
                    timer: 3000
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar datos de Máxima Autoridad:", status, error, xhr.responseText);
            swal.fire("Error", "No se pudieron cargar los datos de la Máxima Autoridad.", "error");
        }
    });

    // 3. Abrir el modal
    $('#myModal_max_autoridad').modal('show');
}


// Función para guardar los datos de la Máxima Autoridad
function saveMaximaAutoridad() {
    var form = $('#form_max_autoridad')[0];
    var formData = new FormData(form);

    // Validaciones de los campos del modal
    if (formData.get('cedula__max_a_f_modal').trim().length === 0) {
        swal.fire('Atención', 'Debe ingresar la Cédula de Identidad de la Máxima Autoridad.', 'warning').then(() => {
            $('#cedula__max_a_f_modal').focus();
        });
        return;
    }
    if (formData.get('name_max_a_f_modal').trim().length === 0) {
        swal.fire('Atención', 'Debe ingresar el Nombre(s) y Apellido(s) de la Máxima Autoridad.', 'warning').then(() => {
            $('#name_max_a_f_modal').focus();
        });
        return;
    }
    if (formData.get('cargo__max_a_f_modal').trim().length === 0) {
        swal.fire('Atención', 'Debe ingresar el Cargo de la Máxima Autoridad.', 'warning').then(() => {
            $('#cargo__max_a_f_modal').focus();
        });
        return;
    }
    if (formData.get('actoad__max_a_f_modal') === '0') {
        swal.fire('Atención', 'Debe seleccionar el Acto Administrativo de Designación.', 'warning').then(() => {
            $('#actoad__max_a_f_modal').focus();
        });
        return;
    }
    if (formData.get('n__max_a_f_modal').trim().length === 0) {
        swal.fire('Atención', 'Debe ingresar el Nº de Acto Administrativo.', 'warning').then(() => {
            $('#n__max_a_f_modal').focus();
        });
        return;
    }
    if (formData.get('fecha__max_a_f_modal').trim().length === 0) {
        swal.fire('Atención', 'Debe ingresar la Fecha del Acto Administrativo.', 'warning').then(() => {
            $('#fecha__max_a_f_modal').focus();
        });
        return;
    }
    if (formData.get('gaceta__max_a_f_modal').trim().length === 0) {
        swal.fire('Atención', 'Debe ingresar la Gaceta.', 'warning').then(() => {
            $('#gaceta__max_a_f_modal').focus();
        });
        return;
    }
    if (formData.get('gfecha__max_a_f_modal').trim().length === 0) {
        swal.fire('Atención', 'Debe ingresar la Fecha de la Gaceta.', 'warning').then(() => {
            $('#gfecha__max_a_f_modal').focus();
        });
        return;
    }


    swal.fire({
        title: "¿Confirmar?",
        text: "¿Está seguro de guardar la información de la Máxima Autoridad?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "¡Sí, Guardar!",
    }).then((result) => {
        if (result.value) {
             var base_url = '/index.php/Configuracion/save_maxima_autoridad_data';

            // var base_url = window.location.origin + '/asnc/index.php/Configuracion/save_maxima_autoridad_data';
            

            $.ajax({
                url: base_url,
                method: "POST",
                data: formData,
                processData: false, // Importante para FormData
                contentType: false, // Importante para FormData
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        swal.fire("Guardado", response.message, "success").then(() => {
                            $('#myModal_max_autoridad').modal('hide'); // Cerrar el modal
                            // Opcional: Recargar la tabla si es necesario, o solo un mensaje de éxito
                            // location.reload();
                        });
                    } else {
                        swal.fire("Error", response.message, "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error al guardar datos de Máxima Autoridad:", status, error, xhr.responseText);
                    swal.fire("Error", "Ocurrió un error al intentar guardar los datos.", "error");
                }
            });
        }
    });
}


// --- Llama a estas funciones en el document.ready para adjuntar eventos ---
$(document).ready(function() {
    // Adjuntar el evento 'input' para la lógica de S/I en el campo Gaceta del MODAL
    $('#gaceta__max_a_f_modal').on('input', handleGacetaInputModal);

    // Opcional: Si el modal podría precargarse con datos y tener S/I en la Gaceta al abrirse
    // Es buena práctica llamar a la función al mostrar el modal también
    $('#myModal_max_autoridad').on('shown.bs.modal', function () {
        handleGacetaInputModal();
    });
});