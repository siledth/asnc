$(document).ready(function() {
    const participantesContainer = $("#participantes-container");
    const participantesTbody = $("#participantes-tbody");
    const paginationControls = $("#pagination-controls");
    const exportExcelButton = $("#export-excel-button");
    let currentPage = 1;
    let selectedDiplomadoId = null;

    // Maneja el cambio en el menú desplegable de diplomados
    $("#select-diplomado").change(function() {
        selectedDiplomadoId = $(this).val();
        if (selectedDiplomadoId) {
            participantesContainer.show();
            exportExcelButton.show(); // Muestra el botón de exportar
            loadParticipantes(selectedDiplomadoId, 1);
        } else {
            participantesContainer.hide();
            exportExcelButton.hide(); // Oculta el botón de exportar
        }
    });

    // Función para cargar los participantes a través de AJAX
    function loadParticipantes(id_diplomado, page) {
        participantesTbody.html('<tr><td colspan="3" class="text-center">Cargando participantes...</td></tr>');
        currentPage = page;

        $.ajax({
            url: BASE_URL + 'index.php/Diplomado/get_participantes_por_diplomado',
            method: "POST",
            data: { id_diplomado: id_diplomado, page: page },
            dataType: "json",
            success: function(response) {
                renderTable(response.participantes);
                renderPagination(response.total_pages, response.current_page);
            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los participantes:", error);
                participantesTbody.html('<tr><td colspan="3" class="text-center text-danger">Error al cargar la lista de participantes.</td></tr>');
            }
        });
    }

    // Construye la tabla de participantes dinámicamente
    function renderTable(participantes) {
        let html = '';
        if (participantes.length > 0) {
            participantes.forEach(participante => {
                const isApproved = participante.estatus_aprobacion === 't';
                const checked = isApproved ? 'checked' : '';
                
                html += `
                    <tr>
                        <td>${participante.cedula}</td>
                        <td>${participante.nombres} ${participante.apellidos}</td>
                        <td class="text-center">
                            <label class="switch">
                                <input type="checkbox" class="estatus-toggle" data-id-participante="${participante.id_participante}" ${checked}>
                                <span class="slider"></span>
                            </label>
                        </td>
                    </tr>
                `;
            });
        } else {
            html = '<tr><td colspan="3" class="text-center">No hay participantes pagados para este diplomado.</td></tr>';
        }
        participantesTbody.html(html);
    }
    
    // Construye los controles de paginación
    function renderPagination(totalPages, currentPage) {
        paginationControls.empty();
        if (totalPages > 1) {
            let prevDisabled = currentPage === 1 ? 'disabled' : '';
            paginationControls.append(`<li class="page-item ${prevDisabled}"><a class="page-link" href="#" data-page="${currentPage - 1}">Anterior</a></li>`);
            
            for (let i = 1; i <= totalPages; i++) {
                let active = i === currentPage ? 'active' : '';
                paginationControls.append(`<li class="page-item ${active}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`);
            }
            
            let nextDisabled = currentPage === totalPages ? 'disabled' : '';
            paginationControls.append(`<li class="page-item ${nextDisabled}"><a class="page-link" href="#" data-page="${currentPage + 1}">Siguiente</a></li>`);

            // Manejador de clics para los botones de paginación
            paginationControls.on('click', '.page-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                if (page > 0 && page <= totalPages) {
                    loadParticipantes(selectedDiplomadoId, page);
                }
            });
        }
    }

    // Maneja el clic en el botón de aprobación/reprobación
    participantesTbody.on('change', '.estatus-toggle', function() {
        const toggle = $(this);
        const id_participante = toggle.data('id-participante');
        const estatus_aprobacion = toggle.is(':checked');
        
        // Deshabilita el toggle mientras se realiza la petición
        toggle.prop('disabled', true);
        
        $.ajax({
            url: BASE_URL + 'index.php/Diplomado/save_estatus_aprobacion',
            method: "POST",
            data: { 
                id_participante: id_participante,
                id_diplomado: selectedDiplomadoId,
                estatus_aprobacion: estatus_aprobacion
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    alert('Estatus actualizado con éxito.');
                } else {
                    alert('Error al actualizar el estatus.');
                    // Si falla, revertir el estado del toggle
                    toggle.prop('checked', !estatus_aprobacion);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al guardar el estatus:", error);
                alert('Hubo un error en la comunicación con el servidor.');
                // Si falla, revertir el estado del toggle
                toggle.prop('checked', !estatus_aprobacion);
            },
            complete: function() {
                // Habilitar el toggle de nuevo
                toggle.prop('disabled', false);
            }
        });
    });

    // Maneja la acción del botón de exportar a Excel
    exportExcelButton.on('click', function() {
        const table = $('#participantes-table');
        const rows = table.find('tr:has(td)');
        const diplomadoName = $("#select-diplomado option:selected").text(); // Obtiene el nombre del diplomado seleccionado
        
        // Encabezados del archivo CSV, se añade el nombre del diplomado
        let csv = `Diplomado: ${diplomadoName}\n`;
        csv += 'Cédula,Nombre Completo,Estatus de Aprobación\n';
        
        // Recorrer las filas y extraer los datos
        rows.each(function() {
            const row = $(this);
            const cedula = row.find('td:eq(0)').text().trim();
            const nombre = row.find('td:eq(1)').text().trim();
            const estatusToggle = row.find('td:eq(2) input');
            const estatus = estatusToggle.is(':checked') ? 'Aprobado' : 'Reprobado';
            
            csv += `${cedula},"${nombre}",${estatus}\n`;
        });
        
        // Crear un Blob con los datos CSV
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        
        // Crear un enlace de descarga y hacer clic en él
        const link = document.createElement('a');
        if (link.download !== undefined) {
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            // Se usa el nombre del diplomado en el nombre del archivo
            link.setAttribute('download', `participantes_${diplomadoName.replace(/\s+/g, '_')}.csv`);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            alert('Su navegador no soporta la descarga de archivos. Por favor, intente con otro navegador.');
        }
    });
});
