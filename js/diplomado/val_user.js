// Validaciones para el campo de cédula
function validateUsers() {
    const cedulaInput = document.getElementById('cedula_f');
    // FIX HERE: Use the correct ID for your save button
    const guardarBtn = document.getElementById('guardarInscripcionBtn');
    const idDiplomado = document.getElementById('id_diplomado').value;
    
    // It's good practice to check if the button actually exists before trying to use it
    if (!guardarBtn) {
        console.error("Error: The 'guardarInscripcionBtn' element was not found in the DOM.");
        // If the button isn't found, we can't proceed with disabling it.
        return; 
    }

    // Reset state
    cedulaInput.classList.remove('is-invalid');
    guardarBtn.disabled = false; // Initially enable it, then disable based on validation

    // Basic length validation
    if (cedulaInput.value.length < 5 || cedulaInput.value.length > 10) {
        document.getElementById('cedula-error').textContent = 'La cédula debe tener entre 5 y 10 dígitos';
        cedulaInput.classList.add('is-invalid');
        guardarBtn.disabled = true; // Disable if length is invalid
        return;
    }

    // Validate that a diplomado has been selected
    // Also check for empty string "" as <option value=""> often means empty selection
    if (idDiplomado == '0' || idDiplomado === "") { 
        document.getElementById('cedula-error').textContent = 'Primero seleccione un diplomado';
        cedulaInput.classList.add('is-invalid');
        guardarBtn.disabled = true; // Disable if diplomado is not selected
        return;
    }
    
    var base_url = window.location.origin + '/asnc/index.php/Diplomado/validarCedula';
    // var base_url = '/index.php/Diplomado/validarCedula'; // Use the appropriate base_url for your environment

    // Disable the button while the AJAX call is in progress to prevent multiple submissions
    guardarBtn.disabled = true;

    // Validation for existence in the same diplomado
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
            guardarBtn.disabled = true; // Keep disabled if already registered
        } else {
            cedulaInput.classList.remove('is-invalid');
            guardarBtn.disabled = false; // Enable if valid
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
        cedulaInput.classList.add('is-invalid'); // Mark as invalid visually
        guardarBtn.disabled = true; // Disable if there's an error
    });
}

// Validation in real-time for the input field (this event listener should be attached in pnatural.js)
// I'm keeping this function as you provided it, but remember the best practice is to move this
// event attachment into your main pnatural.js document.ready block.
document.getElementById('cedula_f').addEventListener('input', function() {
    // Validate numbers only
    this.value = this.value.replace(/[^0-9]/g, '');
    
    // Validate maximum length
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
    
    // Basic validation of length (to enable/disable the save button in real-time)
    const guardarBtn = document.getElementById('guardarInscripcionBtn'); 
    if (guardarBtn) { // Check if the button exists
        if (this.value.length < 5 || this.value.length > 10) {
            this.classList.add('is-invalid');
            guardarBtn.disabled = true;
        } else {
            this.classList.remove('is-invalid');
            // Do NOT re-enable the button here. The 'validateUsers' function (on blur/submit)
            // or the main form submission logic should control the final state of the button.
            // This 'input' event is just for immediate visual feedback and basic disable.
        }
    }
});