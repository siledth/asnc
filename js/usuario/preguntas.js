function guardar_b() {
    // Obtener los valores del formulario
    const pregunta = document.getElementById('pregunta').value;
    const respuesta = document.getElementById('nombre_b').value;

    // Validar que se haya seleccionado una pregunta
    if (pregunta === "0") {
        alert("Por favor, seleccione una pregunta.");
        return;
    }

    // Validar que la respuesta no esté vacía
    if (respuesta.trim() === "") {
        alert("Por favor, ingrese una respuesta.");
        return;
    }

    // Si todo está bien, enviar los datos al servidor
    const formData = new FormData();
    formData.append('pregunta', pregunta);
    formData.append('respuesta', respuesta);

    // Usar la URL definida en la vista
    fetch(guardarPreguntaUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Pregunta guardada correctamente.");
            window.location.reload(); // Recargar la página
        } else {
            alert("Error al guardar la pregunta: " + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}