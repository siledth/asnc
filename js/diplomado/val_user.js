// Validaciones para el campo de cédula
function validateUsers() {
    const cedulaInput = document.getElementById('cedula_f');
    const guardarBtn = document.getElementById('guardar');
    const idDiplomado = document.getElementById('id_diplomado').value;
    
    // Resetear estado
    cedulaInput.classList.remove('is-invalid');
    guardarBtn.disabled = false;
    
    // Validación básica de longitud
    if (cedulaInput.value.length < 5 || cedulaInput.value.length > 10) {
        document.getElementById('cedula-error').textContent = 'La cédula debe tener entre 5 y 10 dígitos';
        cedulaInput.classList.add('is-invalid');
        guardarBtn.disabled = true;
        return;
    }

    // Validar que se haya seleccionado un diplomado
    if (idDiplomado == '0') {
        document.getElementById('cedula-error').textContent = 'Primero seleccione un diplomado';
        cedulaInput.classList.add('is-invalid');
        guardarBtn.disabled = true;
        return;
    }
        var base_url = window.location.origin+'/asnc/index.php/Diplomado/validarCedula';
            // var base_url = '/index.php/Diplomado/validarCedula';


    // Validación de existencia en el mismo diplomado
    fetch(base_url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'cedula=' + encodeURIComponent(cedulaInput.value) + '&id_diplomado=' + encodeURIComponent(idDiplomado)
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la respuesta del servidor');
        return response.json();
    })
    .then(data => {
        if (data.existe) {
            Swal.fire({
                icon: 'error',
                title: 'Cédula ya registrada',
                text: 'Esta cédula ya está preinscrita en el diplomado seleccionado',
                confirmButtonText: 'Entendido'
            });
            cedulaInput.classList.add('is-invalid');
            guardarBtn.disabled = true;
        } else {
            cedulaInput.classList.remove('is-invalid');
            guardarBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al validar la cédula',
            confirmButtonText: 'Entendido'
        });
    });
}

// Validación en tiempo real del input
document.getElementById('cedula_f').addEventListener('input', function() {
    // Validar solo números
    this.value = this.value.replace(/[^0-9]/g, '');
    
    // Validar longitud máxima
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
    
    // Validación básica
    const guardarBtn = document.getElementById('guardar');
    if (this.value.length < 5 || this.value.length > 10) {
        this.classList.add('is-invalid');
        guardarBtn.disabled = true;
    } else {
        this.classList.remove('is-invalid');
    }
});