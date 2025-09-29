<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">

                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <p class="f-s-16 text-inverse f-w-600">Nombre Órgano / Ente: <?= $des_unidad ?>.</p>
                                    <p class="f-s-14">RIF.: <?= $rif ?> <br>
                                        Código ONAPRE: <?= $codigo_onapre ?></p>

                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-lg mt-2 mb-2 btn-default" data-toggle="modal"
                            data-target="#agregar_programacion">
                            Agregar Período de Programación
                        </button>
                    </div>
                    <div class="col-3">

                    </div>
                    <div class="col-6 text-center mt-3">
                        <h3 class="text-center">Período de Programación Registrados</h3>
                        <table id="data-table" data-order='[[ 0, "desc" ]]' class="table table-bordered">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Período</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ver_programaciones as $lista): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $lista['anio'] ?> </td>
                                        <td class="center">

                                            <?php if ($lista['estatus'] == 0): ?>
                                                <!-- Si estatus = 0 -->
                                                <a href="<?php echo base_url(); ?>index.php/programacion/nueva_prog?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-fw fa-edit" title="Cargar Programación"></i>
                                                </a>

                                                <a href="javascript:void(0);" title="Remitir al SNC"
                                                    onclick="enviar(<?php echo $lista['id_programacion']; ?>);" class="button">
                                                    <i class="fas fa-lg fa-fw fa-upload" style="color: green;"></i>
                                                </a>

                                            <?php elseif ($lista['estatus'] == 2): ?>
                                                <!-- Si estatus = 2 -->
                                                <a href="<?php echo base_url(); ?>index.php/programacion/ver_programacion_final?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-print fa-lg" title="Imprimir Carga"
                                                        style="color: black;"></i>
                                                </a>

                                                <a href="<?php echo base_url(); ?>index.php/programacion/read_send?id=<?php echo $lista['id_programacion']; ?>"
                                                    class="button">
                                                    <i class="fas fa-lg fa-cloud-download-alt"
                                                        title="Descargar Certificado de Cumplimiento ART.38 #1"
                                                        style="color: blue;"></i>
                                                </a>
                                            <?php endif; ?>

                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="agregar_programacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Agregar Período</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="resgistrar_anio" method="POST" class="form-horizontal">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4>Año a Cargar <b style="color:red">*</b></h4>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-6 text-center form-group" id="proyecto_s">
                            <input id="anio" name="anio" type="text" class="form-control" maxlength="4" minlength="4"
                                required placeholder="2020" onkeypress="return valideKey(event);">
                            <div id="result-anio"></div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                    <button type="button" id="btn_guar_2" onclick="registrar_anio();" class="btn btn-primary"
                        disabled>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function valideKey(evt) {
        var code = (evt.which) ? evt.which : evt.keyCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#anio').on('blur', function() {
            var anio = $(this).val();
            var base_url = '/index.php/Programacion/valida_anios';
            //  var base_url = window.location.origin + '/asnc/index.php/Programacion/valida_anios';


            if (anio === '') {
                $('#result-anio').html(
                    '<div class="alert alert-warning"><strong>Atención!</strong> Debe ingresar un año válido.</div>'
                );
                $("#btn_guar_2").prop('disabled', true);
                return;
            }

            $.ajax({
                type: "POST",
                url: base_url,
                data: {
                    anio: anio
                },
                success: function(data) {
                    // data puede ser "ok", "1", "0"
                    console.log("Respuesta del servidor:", data); // <-- AGREGA ESTO

                    if (data.trim() ===
                        "ok") { // <-- usa .trim() para evitar espacios/saltos de línea
                        $('#result-anio').html(
                            '<div class="alert alert-success"><strong>Bien!</strong>  desea guardar este año de programación.</div>'
                        );
                        $("#btn_guar_2").prop('disabled', false);

                    } else if (data.trim() === "1") {
                        $('#result-anio').html(
                            '<div class="alert alert-danger"><strong>Atención!</strong> Ese período ya se encuentra registrado.</div>'
                        );
                        $("#btn_guar_2").prop('disabled', true);

                    } else if (data.trim() === "0") {
                        var anio_actual = new Date().getFullYear();
                        var anio_siguiente = anio_actual + 1;

                        $('#result-anio').html(
                            '<div class="alert alert-danger"><strong>Atención!</strong> Solo se permite programar los años ' +
                            anio_actual + ' y ' + anio_siguiente + '.</div>'
                        );
                        $("#btn_guar_2").prop('disabled', true);

                    } else {
                        $('#result-anio').html(
                            '<div class="alert alert-danger"><strong>Error!</strong> No se puede registrar el año</div>'
                        );
                        $("#btn_guar_2").prop('disabled', true);
                    }
                },

                error: function() {
                    $('#result-anio').html(
                        '<div class="alert alert-danger"><strong>Error!</strong> No se pudo validar el año. Intente de nuevo.</div>'
                    );
                    $("#btn_guar_2").prop('disabled', true);
                }
            });
        });
    });
</script>
<script src="<?= base_url() ?>/js/programacion.js"></script>
<script src="<?= base_url() ?>/js/programacion/enviar.js"></script>