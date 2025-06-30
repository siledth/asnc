<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-1"></div>

                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-11" style="margin-left: 40px;">
                        <div class="table-responsive mt-3">
                            <div class="col-12 text-center">
                                <h4 style="color:red;">Datos Personales</h4>
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
                    <div class="col-11 mt-3">
                        <h3 class="text-center"> Informaciòn academica
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
                                            <a onclick="modal_exp(<?php echo $data['id_participante'] ?>);"
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
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <!-- <div class="col-10 mt-4">
                        <h3 class="text-center">Capacitación </h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Razon social</th>
                                    <th>Nombre del Curso o Formación Relacionadas
                                        con Procedimientos de Selección, Administración de Contratos o Materias
                                        vinculadas</th>
                                    <th>Horas</th>
                                    <th>Nº Cert.</th>
                                    <th>Fecha Certificado</th>
                                    <th>vigencia</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($con_p as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <?php if ($data['exit_rnc'] = 1) : ?>
                                            <td><?= $data['sel_rif_nombre'] ?> </td>
                                            <td><?= $data['nombre_contratista'] ?> </td>


                                        <?php else: ?>
                                            <td><?= $data['rif_contr_no_rnc'] ?> </td>
                                            <td><?= $data['razon_social_no_rnc'] ?> </td>

                                        <?php endif; ?>

                                        <td><?= $data['namecurso'] ?> </td>
                                        <td><?= $data['horas'] ?> </td>
                                        <td><?= $data['ncertificado'] ?> </td>
                                        <td><?= $data['fcerti'] ?> </td>
                                        <td><?= $data['vigencia'] ?> </td>




                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> -->
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <!-- <div class="col-10 mt-4">
                        <h3 class="text-center">Capacitación en Comisión de Contrataciones (15%)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Razon social</th>
                                    <th>Taller o Curso de Comisión de Contrataciones</th>
                                    <th>Horas</th>
                                    <th>Nº Cert.</th>
                                    <th>Fecha Certificado</th>
                                    <th>vigencia</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($con_c as $data): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <?php if ($data['exit_rnc'] == 1) : ?>
                                    <td><?= $data['sel_rif_nombre'] ?> </td>
                                    <td><?= $data['nombre_contratista'] ?> </td>


                                    <?php else: ?>
                                    <td><?= $data['rif_contr_no_rnc'] ?> </td>
                                    <td><?= $data['razon_social_no_rnc'] ?> </td>

                                    <?php endif; ?>

                                    <td><?= $data['namecurso'] ?> </td>
                                    <td><?= $data['horas'] ?> </td>
                                    <td><?= $data['ncertificado'] ?> </td>
                                    <td><?= $data['fcerti'] ?> </td>
                                    <td><?= $data['vigencia'] ?> </td>




                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> -->
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
                                <!-- <div class="form-group col-4">
                                        <label>En Curso:</label>
                                        <select name="curso" id="curso">
                                            <option value="0">Selecciones</option>

                                            <option value="1">No</option>
                                            <option value="2">Si</option>

                                        </select>
                                    </div> -->
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
                                <div class="form-group col-12">
                                    <label>Órgano/Ente/Institución/Empresa:</label>
                                    <input class="form-control" type="text" name="descripcion" id="descripcion"
                                        readonly>

                                    <input class="form-control" type="text" name="arif" id="arif" readonly>
                                    <input class="form-control" type="text" name="id_inf_exp5" id="id_inf_exp5"
                                        readonly>

                                </div>
                                <div class="form-group col-12">
                                    <label> Cambiar Órgano/Ente/Institución/Empresa <i
                                            title="Si quiere cambiar la Formación Académica, debe seleccionarla en este campo"
                                            class="fas fa-question-circle"></i></b></label> <br>
                                    <select class="form-control" name="cam_org" id="cam_org">
                                        <option value="0">Seleccione Órgano/Ente/Institución/Empresa que desea cambiar
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label>Area:</label>
                                    <input class="form-control" type="text" name="area" id="area">
                                </div>
                                <div class="form-group col-4">
                                    <label>cargo</label>
                                    <input class="form-control" type="text" name="cargo" id="cargo">
                                </div>
                                <div class="form-group col-4">
                                    <label>desde:</label>
                                    <input class="form-control" type="date" name="desde" id="desde">
                                </div>
                                <div class="form-group col-4">
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
                <button type="button" id="save_exp" onclick="save_modif_exp();" class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/js/diplomado/edit_pn.js"></script>



<script type="text/javascript">
    $(document).ready(function() {
        $("#cam_org").select2({
            dropdownParent: $("#guardar_expe")
        });
    });
</script>