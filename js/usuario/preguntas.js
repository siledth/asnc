// Función para actualizar el contador de preguntas
function actualizarContador() {
    // Opción 1: Usando directamente la variable PHP (recomendado)
    // var contarPreguntasUrl = window.location.origin + '/asnc/index.php/Preguntas_controller/contar_preguntas';
             var contarPreguntasUrl = '/index.php/Preguntas_controller/contar_preguntas';

    
    // Opción 2: Construyendo la URL como en tu ejemplo (alternativa)
    //  var contarPreguntasUrl = window.location.origin + "<?= base_url('index.php/Preguntas_controller/contar_preguntas') ?>";
    
    fetch(contarPreguntasUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            // Verifica si existe el elemento antes de actualizarlo
            const counterElement = document.getElementById('preguntas-counter');
            if (counterElement) {
                counterElement.textContent = `(${data.count}/3)`;
            }
        })
        .catch(error => {
            console.error('Error al actualizar contador:', error);
            // Opcional: Mostrar mensaje al usuario
            // Swal.fire('Error', 'No se pudo actualizar el contador', 'error');
        });
}

// Llamar al cargar la página para mostrar el contador inicial
document.addEventListener('DOMContentLoaded', function() {
    actualizarContador();
});

function guardar_b() {
    // Obtener los valores del formulario
    const pregunta = document.getElementById('pregunta').value;
    const respuesta = document.getElementById('nombre_b').value;

    // Validaciones
    if (pregunta === "0") {
        Swal.fire({
            title: 'Respuesta requerida',
            text: 'Por favor, ingrese una respuesta.'
        });
        return;
    }

    if (respuesta.trim() === "") {
        Swal.fire({
            title: 'Respuesta requerida',
            text: 'Por favor, ingrese una respuesta.'
        });
        return;
    }

    // Si todo está bien, enviar los datos al servidor
    const formData = new FormData();
    formData.append('pregunta', pregunta);
    formData.append('respuesta', respuesta);

    fetch(guardarPreguntaUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar el contador después de guardar
            actualizarContador();
             var base_url2 = '/index.php/Home/index';
          //    var base_url2 = window.location.origin + '/asnc/index.php/Home/index';
                    if (data.completed) {
                Swal.fire({
               // icon: 'success',
                title: '¡Completado!',
                text: '¡Has completado las 3 preguntas de seguridad!',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then(() => {
                window.location.href = base_url2;
            });
            } else {
                // Si aún no completa las 3 preguntas
                Swal.fire({
//                     icon: 'success',
                    title: 'Guardado',
                    html: `Pregunta guardada correctamente.<br><b>(${data.count}/3)</b>`,
                    timer: 2000,
                    timerProgressBar: true

                });
                // Limpiar los campos para la siguiente pregunta
                 $('#pregunta').val('0').trigger('change'); // Esto es para select2
                document.getElementById('nombre_b').value = "";
                                location.reload();

            }
        } else {
            alert("Error al guardar la pregunta: " + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Ocurrió un error al guardar la pregunta.");
    });
}

// function actualizarPreguntasDisponibles() {
//     fetch(contarPreguntasUrl) // Asegúrate de tener esta variable definida
//         .then(response => response.json())
//         .then(data => {
//             // Aquí podrías actualizar dinámicamente el select si lo prefieres
//           //  console.log("Preguntas actualizadas:", data);
//         })
//         .catch(error => {
//             console.error('Error al actualizar preguntas:', error);
//         });
// }
// Función para actualizar el contador de preguntas
// function actualizarContador() {
//     fetch("<?= base_url('index.php/Preguntas_controller/contar_preguntas') ?>")
//         .then(response => response.json())
//         .then(data => {
//             const counter = document.getElementById('preguntas-counter');
//             counter.textContent = `(${data.count}/3)`;
            
//             // Cambiar color según el progreso
//             if (data.count >= 3) {
//                 counter.style.color = '#28a745'; // Verde
//             } else if (data.count >= 1) {
//                 counter.style.color = '#ffc107'; // Amarillo
//             } else {
//                 counter.style.color = '#dc3545'; // Rojo
//             }
//         })
//         .catch(error => {
//             console.error('Error al actualizar contador:', error);
//         });
// }

// // Llamar al cargar la página para mostrar el contador inicial
// document.addEventListener('DOMContentLoaded', function() {
//     actualizarContador();
// });

// function guardar_b() {
//     const pregunta = document.getElementById('pregunta').value;
//     const respuesta = document.getElementById('nombre_b').value;

//     // Validaciones con SweetAlert
//     if (pregunta === "0") {
//         Swal.fire({
//             icon: 'warning',
//             title: 'Seleccione una pregunta',
//             text: 'Por favor, elija una pregunta de la lista.'
//         });
//         return;
//     }

//     if (respuesta.trim() === "") {
//         Swal.fire({
//             icon: 'warning',
//             title: 'Respuesta requerida',
//             text: 'Por favor, ingrese una respuesta.'
//         });
//         return;
//     }

//     const formData = new FormData();
//     formData.append('pregunta', pregunta);
//     formData.append('respuesta', respuesta);

//     fetch(guardarPreguntaUrl, {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             actualizarContador();
//             var base_url2 = window.location.origin + '/asnc/index.php/Home/index';

            
//             if (data.completed) {
//                         // var base_url = '/index.php/Home/index';

//                 // Mensaje de completado con confirmación
//                 Swal.fire({
//                     icon: 'success',
//                     title: '¡Completado!',
//                     html: '¡Has completado las 3 preguntas de seguridad!<br>¿Deseas continuar?',
//                     showCancelButton: true,
//                     confirmButtonText: 'Sí, continuar',
//                     // cancelButtonText: 'No, quedarme aquí'
//                 }).then((result) => {
//                     if (result.isConfirmed) {
//                                 window.location.href = base_url2;

//                     }
//                 });
//             } else {
//                 // Mensaje de éxito normal
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Guardado',
//                     html: `Pregunta guardada correctamente.<br><b>(${data.count}/3)</b>`,
//                     timer: 2000,
//                     timerProgressBar: true
//                 });
//                 // Limpiar campos
//                 document.getElementById('pregunta').value = "0";
//                 document.getElementById('nombre_b').value = "";
//             }
//         } else {
//             // Mensaje de error
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Error',
//                 text: data.message || 'Error al guardar la pregunta'
//             });
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         Swal.fire({
//             icon: 'error',
//             title: 'Error de conexión',
//             text: 'Ocurrió un error al comunicarse con el servidor'
//         });
//     });
// }