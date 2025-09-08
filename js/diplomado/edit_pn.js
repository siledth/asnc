function modal(id) {
    var id_participante = id;
    var base_url = BASE_URL + 'index.php/Diplomado/consulta_datos_pn';
        // var base_url =window.location.origin+'/asnc/index.php/Diplomado/consulta_datos_pn';
        
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_participante: id_participante },
        dataType: "json",
        success: function(data) {
            $('#id_participante').val(id); //cedula, nombres, apellidos, telefono, correo, edad, direccion
            
             $("#fm_ac1").val(data["cedula"]);
             $("#titulo").val(data["nombres"]);
             $("#anioi").val(data["apellidos"]);
             $("#anioc").val(data["telefono"]);
             $("#correo").val(data["correo"]);
             $("#edad").val(data["edad"]);
             $("#direccion").val(data["direccion"]);

     
        },
    });
}
function save_modif_inf_acad(){

    // var edad = $("#edad").val();        
    //     if (  edad <= 90) {
    //         swal.fire({
    //             title: 'número mayor que cero, intente de nuevo',
    //             type: 'warning',
    //             showCancelButton: false,
    //             confirmButtonColor: '#3085d6',
    //             confirmButtonText: 'Ok'
    //         }).then((result) => {
    //             if (result.value == true) {
    //             }
    //         });
    //        // return false; // no dejar guardar
    //     }
          
    //     else{
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
            var id_participante = $('#id_participante').val();
           // var id_academico = $('#id_academico').val();
           // var camb_id_academico = $('#camb_id_academico').val();
            var nombres = $('#titulo').val();
            var apellidos = $('#anioi').val();
            var telefono = $('#anioc').val();
            var correo = $('#correo').val();
            var edad = $('#edad').val();
            var direccion = $('#direccion').val();
            var base_url = BASE_URL + 'index.php/Diplomado/editar_datos_pn';

        // var base_url =window.location.origin+'/asnc/index.php/Diplomado/editar_datos_pn';

            // var base_url = '/index.php/Programacion/editar_fila_ip_b';

            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_participante: id_participante,
                    nombres: nombres,
                    apellidos: apellidos,
                    telefono: telefono,
                    correo:correo,
                    edad:edad,
                    direccion:direccion,
                    
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
// }

function modal_exp(id_curriculum) {
    
     var url = BASE_URL + 'index.php/Diplomado/consulta_datos_academico';

    $.ajax({
        url: url,
        method: "post",
        data: { id_curriculum: id_curriculum },
        dataType: "json",
        success: function(data) {
            // Se llena el modal con la información obtenida
            $("#id_curriculum_edit").val(data["id_curriculum"]);
            $("#grado_instruccion").val(data["grado_instruccion"]);
            $("#titulo_obtenido").val(data["titulo_obtenido"]);
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los datos académicos:", error);
            // Opcional: mostrar un mensaje de error en la interfaz
        }
    });
}

function save_modif_exp() {
     var base_url = BASE_URL + 'index.php/Diplomado/save_modif_exp';
    var form_data = new FormData(document.getElementById("guardar_expe"));

    $.ajax({
        url: base_url,
        method: "POST",
        data: form_data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(data) {
            if (data.success) {
                // Mensaje de éxito y recarga de la página para ver los cambios
                alert("Información académica actualizada con éxito.");
                window.location.reload();
            } else {
                alert("Hubo un error al guardar los cambios.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al guardar los datos:", error);
            alert("Hubo un error en la comunicación con el servidor.");
        }
    });
}
// Nueva función para cargar los datos de experiencia en el modal
function modal_experiencia(id_curriculum) {
    var url = BASE_URL + 'index.php/Diplomado/consulta_datos_experiencia';

    $.ajax({
        url: url,
        method: "post",
        data: { id_curriculum: id_curriculum },
        dataType: "json",
        success: function(data) {
            // Se llena el modal con la información obtenida
            $("#id_curriculum_experiencia").val(data["id_curriculum"]);
            $("#exp_5_anio").val(data["experiencia_contrataciones_publicas"]);
            
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los datos de experiencia:", error);
        }
    });
}

// Nueva función para guardar los cambios de experiencia
function save_modif_experiencia() {
    var url = BASE_URL + 'index.php/Diplomado/save_modif_experiencia';
    var form_data = new FormData(document.getElementById("guardar-experiencia"));

    $.ajax({
        url: url,
        method: "POST",
        data: form_data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(data) {
            if (data.success) {
                alert("Años de experiencia actualizados con éxito.");
                window.location.reload();
            } else {
                alert("Hubo un error al guardar los cambios.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al guardar los datos:", error);
            alert("Hubo un error en la comunicación con el servidor.");
        }
    });
}

// Nueva función para cargar los datos de la capacitación en el modal
function modal_capacitacion(id_capacitacion) {
    var url = BASE_URL + 'index.php/Diplomado/consulta_datos_capacitacion';

    $.ajax({
        url: url,
        method: "post",
        data: { id_capacitacion: id_capacitacion },
        dataType: "json",
        success: function(data) {
            // Se llena el modal con la información obtenida
            $("#id_capacitacion_edit").val(data["id_capacitacion"]);
            $("#nombre_curso").val(data["nombre_curso"]);
            $("#institucion_formadora").val(data["institucion_formadora"]);
            $("#anio_realizacion").val(data["anio_realizacion"]);
            $("#horas").val(data["horas"]);
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los datos de capacitación:", error);
        }
    });
}

// Nueva función para guardar los cambios de la capacitación
function save_modif_capacitacion() {
    var url = BASE_URL + 'index.php/Diplomado/save_modif_capacitacion';
    var form_data = new FormData(document.getElementById("guardar-capacitacion"));

    $.ajax({
        url: url,
        method: "POST",
        data: form_data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(data) {
            if (data.success) {
                alert("Capacitación actualizada con éxito.");
                window.location.reload();
            } else {
                alert("Hubo un error al guardar los cambios.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al guardar los datos:", error);
            alert("Hubo un error en la comunicación con el servidor.");
        }
    });
}
// Nueva función para cargar los datos de la experiencia laboral en el modal
function modal_experiencia_laboral(id_experienci_5_anio) {
    var url = BASE_URL + 'index.php/Diplomado/consulta_datos_experiencia_laboral';

    $.ajax({
        url: url,
        method: "post",
        data: { id_experienci_5_anio: id_experienci_5_anio },
        dataType: "json",
        success: function(data) {
            // Se llena el modal con la información obtenida
            $("#id_experiencia_laboral_edit").val(data["id_experienci_5_anio"]);
            $("#nombreinstitucion").val(data["nombreinstitucion"]);
            $("#cargo").val(data["cargo"]);
            $("#tiempo").val(data["tiempo"]);
            $("#desde").val(data["desde"]);
            $("#hasta").val(data["hasta"]);
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los datos de experiencia laboral:", error);
        }
    });
}

// Nueva función para guardar los cambios de la experiencia laboral
function save_modif_experiencia_laboral() {
    var url = BASE_URL + 'index.php/Diplomado/save_modif_experiencia_laboral';
    var form_data = new FormData(document.getElementById("guardar-experiencia-laboral"));

    $.ajax({
        url: url,
        method: "POST",
        data: form_data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(data) {
            if (data.success) {
                alert("Experiencia laboral actualizada con éxito.");
                window.location.reload();
            } else {
                alert("Hubo un error al guardar los cambios.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al guardar los datos:", error);
            alert("Hubo un error en la comunicación con el servidor.");
        }
    });
}