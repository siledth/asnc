<style>
/* Estilos para el indicador de procesamiento de DataTables */
.dataTables_wrapper .dataTables_processing {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 250px;
    /* Ajusta el ancho si es necesario */
    margin-left: -125px;
    /* Mitad del ancho para centrar */
    margin-top: -20px;
    /* Mitad del alto para centrar */
    padding: 10px 0;
    text-align: center;
    font-size: 1.2em;
    color: #333;
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    z-index: 1000;
    /* Asegúrate de que esté por encima de otros elementos */
    font-weight: bold;
    /* Puedes añadir un spinner si quieres */
    /* background-image: url('URL_DE_TU_SPINNER_GIF.gif'); */
    /* background-repeat: no-repeat; */
    /* background-position: center left; */
    /* padding-left: 30px; */
}

/* Opcional: Estilo para el overlay de carga */
.dataTables_wrapper.dataTables_processing_active {
    position: relative;
}

.dataTables_wrapper.dataTables_processing_active:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7);
    /* Fondo semi-transparente */
    z-index: 999;
    /* Detrás del mensaje pero delante de la tabla */
}
</style>
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="col-12">
                    <br>
                    <h3 class="text-center">Evaluaciones Registradas</h3>
                    <table id="data-table66" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Fecha Reg. Evaluación</th>
                                <th>Rif de Contratante:</th>
                                <th>Razón Social Contratante</th>
                                <th>Rif contratista</th>
                                <th>Razón Social contratista</th>
                                <th>Calificación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#data-table66').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('index.php/Evaluacion_desempenio/get_evaluaciones_ajax'); ?>",
            "type": "POST",
            "error": function(xhr, error, thrown) {
                console.log("AJAX Error:", thrown);
                console.log("Response Text:", xhr.responseText);
                alert(
                    "Error al cargar los datos de la tabla. Por favor, revise la consola para más detalles."
                );
            }
        },
        "columns": [{
                "data": "id"
            },
            {
                "data": "fecha_reg_eval"
            },
            {
                "data": "rif_organoente"
            },
            {
                "data": "organo_ente"
            },
            {
                "data": "rif_contrat"
            },
            {
                "data": "contratista_ev"
            },
            {
                "data": "calificacion"
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return '<a title="Visualizar e Imprimir la Evaluación de Desempeño" href="<?php echo base_url(); ?>index.php/Evaluacion_desempenio/ver_evaluacion?id=' +
                        row.id + '" class="button">' +
                        '<i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>' +
                        '</a>';
                },
                "orderable": false
            }
        ],

        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        "destroy": true // Agrega esta línea si eliges esta opción
    });
});
</script>