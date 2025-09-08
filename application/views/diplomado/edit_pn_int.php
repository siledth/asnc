<div class="sidebar-bg">
</div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-12 text-center mt-4">
                        <h2 style="color:#007bff; font-weight: bold;">Edición de Información de Participante Incripción
                            Persona Natural</h2>
                        <p class="text-muted">Gestione los datos personales, académicos y de experiencia del
                            participante.</p>
                    </div>
                    <div class="col-1"></div>

                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-11" style="margin-left: 40px;">
                        <div class="table-responsive mt-3">
                            <div class="col-12 text-center">
                                <h4 class="card-title text-center text-danger">Datos Personales</h4>
                            </div>
                            <table id="data-table-buttons" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8;">
                                    <tr class="text-center">
                                        <th>Cedula</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($personal as $data): ?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td><?= $data['cedula'] ?></td>
                                            <td><?= $data['nombres'] ?></td>
                                            <td><?= $data['apellidos'] ?></td>
                                            <td><?= $data['telefono'] ?></td>

                                            <td class="center">
                                                <a onclick="modal(<?php echo $data['id_participante'] ?>);"
                                                    data-toggle="modal" data-target="#exampleModal" style="color: white">
                                                    <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                                        style="color: darkgreen;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-11" style="margin-left: 40px;">
                        <h4 class="card-title text-center" style="color:#00a3e0;">Información Académica</h4>
                        </h3>
                        <table id="data-table-default" class="table table-striped">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Grado Instrucción</th>
                                    <th>Titulo</th>
                                    <th>Acciones</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($academico as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $data['desc_academico'] ?> </td>
                                        <td><?= $data['titulo_obtenido'] ?> </td>

                                        <td class="center">
                                            <!-- Se pasa id_curriculum en lugar de id_participante -->
                                            <a onclick="modal_exp(<?php echo $data['id_curriculum'] ?>);"
                                                data-toggle="modal" data-target="#exp" style="color: white">
                                                <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                                    style="color: darkgreen;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Nuevo Bloque de Información de Experiencia -->
                    <div class="col-11" style="margin-left: 40px;">
                        <h4 class="card-title text-center" style="color:#28a745;">Años de Experiencia</h4>
                        </h4>
                        <table id="data-table-experiencia" class="table table-striped">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Años de Experiencia</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($academico as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $data['experiencia_contrataciones_publicas'] ?> </td>


                                        <td class="center">
                                            <a onclick="modal_experiencia(<?php echo $data['id_curriculum'] ?>);"
                                                data-toggle="modal" data-target="#modal-experiencia" style="color: white">
                                                <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                                    style="color: darkgreen;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Nuevo bloque de tabla para Formación en Contrataciones Públicas -->
                    <div class="col-11" style="margin-left: 40px;">

                        <h4 class="card-title text-center" style="color:#ffc107;">Formación en Contrataciones Públicas
                        </h4>
                        <table id="data-table-capacitacion" class="table table-striped">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Nombre del Curso</th>
                                    <th>Institución Formadora</th>
                                    <th>Año de Realización</th>
                                    <th>Horas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($capacitaciones as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $data['nombre_curso'] ?> </td>
                                        <td><?= $data['institucion_formadora'] ?> </td>
                                        <td><?= $data['anio_realizacion'] ?> </td>
                                        <td><?= $data['horas'] ?> </td>
                                        <td class="center">
                                            <a onclick="modal_capacitacion(<?php echo $data['id_capacitacion'] ?>);"
                                                data-toggle="modal" data-target="#modal-capacitacion" style="color: white">
                                                <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                                    style="color: darkgreen;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Nuevo bloque de tabla para Experiencia Laboral en los últimos 5 años -->
                    <div class="col-11" style="margin-left: 40px;">
                        <h4 class="card-title text-center" style="color:#6f42c1;">Experiencia Laboral en los Últimos 5
                            Años</h4>
                        <table id="data-table-experiencia-laboral" class="table table-striped">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Nombre de Institución</th>
                                    <th>Cargo</th>
                                    <th>Tiempo</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($experiencia_laboral as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $data['nombreinstitucion'] ?> </td>
                                        <td><?= $data['cargo'] ?> </td>
                                        <td><?= $data['tiempo'] ?> </td>
                                        <td><?= $data['desde'] ?> </td>
                                        <td><?= $data['hasta'] ?> </td>
                                        <td class="center">
                                            <a onclick="modal_experiencia_laboral(<?php echo $data['id_experienci_5_anio'] ?>);"
                                                data-toggle="modal" data-target="#modal-experiencia-laboral"
                                                style="color: white">
                                                <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                                    style="color: darkgreen;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- fin -->
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <!-- Los bloques comentados no se modifican -->
                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                            href="javascript:history.back()"> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Información Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>INFORMACIÓN PERSONAL</b></h5>
                            <div class="row ">
                                <div class="form-group col-4">
                                    <label>CEDULA :</label>
                                    <input class="form-control" type="text" name="fm_ac1" id="fm_ac1" readonly>
                                    <input class="form-control" type="hidden" name="id_participante"
                                        id="id_participante" readonly>
                                </div>

                                <div class="form-group col-4">
                                    <label>Nombres:</label>
                                    <input class="form-control" type="text" name="titulo" id="titulo">
                                </div>
                                <div class="form-group col-4">
                                    <label>Apellidos</label>
                                    <input class="form-control" type="text" name="anioi" id="anioi">
                                </div>
                                <div class="form-group col-4">
                                    <label>Telefono:</label>
                                    <input class="form-control" type="text" name="anioc" id="anioc">
                                </div>
                                <div class="form-group col-4">
                                    <label>Correo:</label>
                                    <input class="form-control" type="text" name="correo" id="correo">
                                </div>
                                <div class="form-group col-4">
                                    <label>Edad:</label>
                                    <input class="form-control" type="text" name="edad" id="edad">
                                </div>
                                <div class="form-group col-4">
                                    <label>Dirección:</label>
                                    <input class="form-control" type="text" name="direccion" id="direccion">
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_pago_fin" onclick="save_modif_inf_acad();"
                    class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informaciòn academica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_expe" name="guardar_expe" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>Informaciòn academica</b></h5>
                            <div class="row ">
                                <!-- Campo oculto para el id del curriculum -->
                                <input type="hidden" name="id_curriculum_edit" id="id_curriculum_edit">

                                <div class="form-group col-6">
                                    <label>Grado de Instrucción:</label>
                                    <select class="form-control" name="grado_instruccion" id="grado_instruccion">
                                        <!-- Las opciones se cargarán desde el controlador -->
                                        <?php foreach ($grados_instruccion as $grado): ?>
                                            <option value="<?= $grado['id_academico'] ?>"><?= $grado['desc_academico'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label>Título Obtenido:</label>
                                    <input class="form-control" type="text" name="titulo_obtenido" id="titulo_obtenido">
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="save_exp" onclick="save_modif_exp();" class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-experiencia" tabindex="-1" role="dialog" aria-labelledby="modalExperienciaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExperienciaLabel">Editar Años de Experiencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar-experiencia" name="guardar-experiencia"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>Experiencia </b></h5>
                            <div class="row">
                                <input type="hidden" name="id_curriculum_experiencia" id="id_curriculum_experiencia">

                                <div class="form-group col-6">
                                    <label>Experiencia en Contrataciones Públicas (años):</label>
                                    <input class="form-control" type="text" name="exp_5_anio" id="exp_5_anio">
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="save-experiencia" onclick="save_modif_experiencia();"
                    class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-capacitacion" tabindex="-1" role="dialog" aria-labelledby="modalCapacitacionLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCapacitacionLabel">Editar Formación en Contrataciones Públicas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar-capacitacion" name="guardar-capacitacion"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>Detalles de la Capacitación</b></h5>
                            <div class="row">
                                <!-- Campo oculto para el id de la capacitación -->
                                <input type="hidden" name="id_capacitacion_edit" id="id_capacitacion_edit">

                                <div class="form-group col-6">
                                    <label>Nombre del Curso:</label>
                                    <input class="form-control" type="text" name="nombre_curso" id="nombre_curso">
                                </div>
                                <div class="form-group col-6">
                                    <label>Institución Formadora:</label>
                                    <input class="form-control" type="text" name="institucion_formadora"
                                        id="institucion_formadora">
                                </div>
                                <div class="form-group col-6">
                                    <label>Año de Realización:</label>
                                    <input class="form-control" type="text" name="anio_realizacion"
                                        id="anio_realizacion">
                                </div>
                                <div class="form-group col-6">
                                    <label>Horas:</label>
                                    <input class="form-control" type="text" name="horas" id="horas">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="save-capacitacion" onclick="save_modif_capacitacion();"
                    class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Nuevo Modal para editar Experiencia Laboral en los últimos 5 años -->
<div class="modal fade" id="modal-experiencia-laboral" tabindex="-1" role="dialog"
    aria-labelledby="modalExperienciaLaboralLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExperienciaLaboralLabel">Editar Experiencia Laboral</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar-experiencia-laboral" name="guardar-experiencia-laboral"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>Detalles de la Experiencia Laboral</b></h5>
                            <div class="row">
                                <!-- Campo oculto para el id de la experiencia -->
                                <input type="hidden" name="id_experiencia_laboral_edit"
                                    id="id_experiencia_laboral_edit">

                                <div class="form-group col-6">
                                    <label>Nombre de Institución:</label>
                                    <input class="form-control" type="text" name="nombreinstitucion"
                                        id="nombreinstitucion">
                                </div>
                                <div class="form-group col-6">
                                    <label>Cargo:</label>
                                    <input class="form-control" type="text" name="cargo" id="cargo">
                                </div>
                                <div class="form-group col-6">
                                    <label>Tiempo (años):</label>
                                    <input class="form-control" type="text" name="tiempo" id="tiempo">
                                </div>
                                <div class="form-group col-6">
                                    <label>Desde:</label>
                                    <input class="form-control" type="date" name="desde" id="desde">
                                </div>
                                <div class="form-group col-6">
                                    <label>Hasta:</label>
                                    <input class="form-control" type="date" name="hasta" id="hasta">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="save-experiencia-laboral" onclick="save_modif_experiencia_laboral();"
                    class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    const BASE_URL = '<?= base_url() ?>';
</script>
<script src="<?= base_url() ?>/js/diplomado/edit_pn.js"></script>



<script type="text/javascript">
    $(document).ready(function() {
        $("#cam_org").select2({
            dropdownParent: $("#guardar_expe")
        });
    });
</script>