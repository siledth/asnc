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
                                <h4 class="mb-3">Agregar Nueva Información:</h4>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <button type="button" class="btn btn-primary m-2" data-toggle="modal"
                                        data-target="#dede"
                                        onclick="prepareAcademicModal('<?php echo htmlspecialchars($id_miembros_actual); ?>', '<?php echo htmlspecialchars($cedula_del_miembro_actual); ?>', '<?php echo htmlspecialchars($nro_comprobante_del_miembro_actual); ?>');">
                                        <i class="fas fa-graduation-cap mr-2"></i> Información Académica
                                    </button>
                                    <button type="button" class="btn btn-info m-2" data-toggle="modal"
                                        data-target="#modalContratacionPublica"
                                        onclick="prepareContratacionPublicaModal('<?php echo htmlspecialchars($id_miembros_actual); ?>', '<?php echo htmlspecialchars($cedula_del_miembro_actual); ?>', '<?php echo htmlspecialchars($nro_comprobante_del_miembro_actual); ?>');">
                                        <i class="fas fa-book-reader mr-2"></i> Formación Contratación Pública
                                    </button>



                                    <button type="button" class="btn btn-warning m-2" data-toggle="modal"
                                        data-target="#modalComisiones"
                                        onclick="prepareExperienciaComisionModal('<?php echo htmlspecialchars($id_miembros_actual); ?>', '<?php echo htmlspecialchars($cedula_del_miembro_actual); ?>', '<?php echo htmlspecialchars($nro_comprobante_del_miembro_actual); ?>');">
                                        <i class="fas fa-handshake mr-2"></i> Experiencia en Comisiones
                                    </button>

                                    <button type="button" class="btn btn-success m-2" data-toggle="modal"
                                        data-target="#modalDictadoCapacitacion"
                                        onclick="prepareDictadoCapacitacionModal('<?php echo htmlspecialchars($id_miembros_actual); ?>', '<?php echo htmlspecialchars($cedula_del_miembro_actual); ?>', '<?php echo htmlspecialchars($nro_comprobante_del_miembro_actual); ?>');">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i> Dictado de Capacitación
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-11" style="margin-left: 40px;">
                        <div class="table-responsive mt-3">
                            <div class="col-12 text-center">
                                <h4 style="color:red;">Información académica</h4>
                            </div>
                            <table id="data-table-buttons" class="table table-bordered table-hover">
                                <thead style="background:#e4e7e8;">
                                    <tr class="text-center">
                                        <th>Nivel Académico</th>
                                        <th>Título</th>
                                        <th>Año de inicio</th>
                                        <th>Año Fin</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($academico as $data): ?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td><?= $data['desc_academico'] ?></td>
                                            <td><?= $data['titulo'] ?></td>
                                            <td><?= $data['ano'] ?></td>
                                            <td><?= $data['culminacion'] ?></td>

                                            <td class="center">
                                                <a onclick="modal(<?php echo $data['id_per'] ?>);" data-toggle="modal"
                                                    data-target="#exampleModal" style="color: white">
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
                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center"> Formación Contratación Pública
                        </h3>
                        <table id="data-table-default" class="table table-striped">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Taller o Curso de Comisión de Contrataciones</th>
                                    <th>Institución donde realizó la Formación</th>
                                    <th>Horas de Duración</th>
                                    <th>N.º del Certificado </th>
                                    <th>Fecha Certificado</th>
                                    <th>Vigencia</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($formc as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?= $data['taller'] ?> </td>
                                        <td><?= $data['institucion'] ?> </td>
                                        <td><?= $data['hor_dura'] ?> </td>
                                        <td><?= $data['certi'] ?> </td>
                                        <td><?= $data['fech_cert'] ?> </td>
                                        <td class="center">
                                            <a onclick="modal_contr_pub(<?php echo $data['id_form']; ?>);"
                                                data-toggle="modal" data-target="#modalEditContratacionPublica"
                                                style="color: white">
                                                <i title="Editar" class="fas fa-lg fa-fw fa-highlighter"
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
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Experiencia de participación en comisiones de contrataciones (Ultimos 10
                            años)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Órgano o Ente de la Comisión de Contrataciones</th>
                                    <th>Acto Administrativo de Designación</th>
                                    <th>N° del Acto </th>
                                    <th>Fecha</th>
                                    <th>Área</th>
                                    <th>Duración en la Comisión (tiempo)</th>
                                    <th>Acción</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($con_p as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">


                                        <td><?= $data['organo10'] ?> </td>
                                        <td><?= $data['act_adminis_desid'] ?> </td>
                                        <td><?= $data['n_acto'] ?> </td>
                                        <td><?= $data['fecha_act'] ?> </td>
                                        <td><?= $data['area_10'] ?> </td>

                                        <td><?= $data['dura_comi'] ?> </td>
                                        <td class="center">
                                            <a onclick="modal_exp_comis(<?php echo $data['id_exp_10']; ?>);"
                                                data-toggle="modal" data-target="#modalEditExpComisiones"
                                                style="color: white">
                                                <i title="Editar" class="fas fa-lg fa-fw fa-highlighter"
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
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Experiencia en Dictado de Capacitación en materia de Comisión de
                            Contrataciones (Ultimos 3 años)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Órgano o Ente de la Comisión de Contrataciones</th>
                                    <th>Actividad</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Acción</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($con_c as $data): ?>
                                    <tr class="odd gradeX" style="text-align:center">


                                        <td><?= $data['organo3'] ?> </td>
                                        <td><?= $data['actividad3'] ?> </td>
                                        <td><?= $data['desde3'] ?> </td>
                                        <td><?= $data['hasta3'] ?> </td>
                                        <td class="center">
                                            <a onclick="modal_dictado_cap(<?php echo $data['id_dic_cap_3']; ?>);"
                                                data-toggle="modal" data-target="#modalEditDictadoCapacitacion"
                                                style="color: white">
                                                <i title="Editar" class="fas fa-lg fa-fw fa-highlighter"
                                                    style="color: darkgreen;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Editar Información académica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_edit_academica" name="form_edit_academica"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>INFORMACIÓN ACADÉMICA</b></h5>
                            <div class="row ">
                                <input type="hidden" name="id_per_edit" id="id_per_edit">

                                <div class="form-group col-4">
                                    <label>Formación Académica Actual:</label>
                                    <input class="form-control" type="text" name="fm_ac1_display" id="fm_ac1_display"
                                        readonly>
                                    <input class="form-control" type="hidden" name="id_academico_current"
                                        id="id_academico_current" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label> Cambiar Formación Académica <i
                                            title="Si quiere cambiar la Formación Académica, debe seleccionarla en este campo"
                                            class="fas fa-question-circle"></i></label>
                                    <select class="form-control" name="camb_id_academico" id="camb_id_academico">
                                        <option value="0">Seleccione</option>
                                        <?php foreach ($carrera as $data_carrera) : ?>
                                            <option value="<?= $data_carrera['id_academico'] ?>">
                                                <?= $data_carrera['desc_academico'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Título Obtenido:</label>
                                    <input class="form-control" type="text" name="titulo_edit" id="titulo_edit">
                                </div>
                                <div class="form-group col-4">
                                    <label> Año de Inicio (aaaa)</label>
                                    <input class="form-control" type="text" name="anioi_edit" id="anioi_edit">
                                </div>
                                <div class="form-group col-4">
                                    <label>Culminación:</label>
                                    <input class="form-control" type="text" name="anioc_edit" id="anioc_edit">
                                </div>
                                <div class="form-group col-4">
                                    <label>En Curso:</label>
                                    <select name="curso_edit" id="curso_edit">
                                        <option value="0">Seleccione</option>
                                        <option value="1">No</option>
                                        <option value="2">Si</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_modificacion_academica" onclick="save_modif_inf_acad();"
                    class="my-button">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditContratacionPublica" tabindex="-1" role="dialog"
    aria-labelledby="modalEditContratacionPublicaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditContratacionPublicaLabel">Editar Formación en Materia de
                    Contratación Pública</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_edit_contratacion_publica" name="form_edit_contratacion_publica"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>INFORMACIÓN DE CAPACITACIÓN EN CONTRATACIÓN PÚBLICA</b></h5>
                            <div class="row ">
                                <input type="hidden" name="id_form_edit" id="id_form_edit">

                                <div class="form-group col-8">
                                    <label> Taller o Curso de Comisión de Contrataciones <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="taller_edit" id="taller_edit"
                                        placeholder="Nombre" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Institución donde realizó la Formación<b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="institucion_edit"
                                        id="institucion_edit" placeholder="institucion" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Horas de Duración <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="number" name="hor_dura_edit" id="hor_dura_edit">
                                </div>
                                <div class="form-group col-4">
                                    <label>N.º del Certificado <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="certi_edit" id="certi_edit"
                                        onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Fecha Certificado <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="date" name="fech_cert_edit" id="fech_cert_edit">
                                </div>
                                <div class="form-group col-4">
                                    <label>Vigencia<b title="Campo Obligatorio" style="color:red">no
                                            debe dar mas de 2 años</b></label>
                                    <input class="form-control" type="text" name="vigencia_edit" id="vigencia_edit"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_modificacion_contr_pub" onclick="save_modif_contr_pub();"
                    class="my-button">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditExpComisiones" tabindex="-1" role="dialog"
    aria-labelledby="modalEditExpComisionesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditExpComisionesLabel">Editar Experiencia en Comisiones de
                    Contrataciones (Últimos 10 Años)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_edit_exp_comisiones" name="form_edit_exp_comisiones"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>EXPERIENCIA EN COMISIONES DE CONTRATACIONES</b></h5>
                            <div class="row ">
                                <input type="hidden" name="id_exp_10_edit" id="id_exp_10_edit">

                                <div class="form-group col-8">
                                    <label> Órgano o Ente de la Comisión de Contrataciones <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="organo10_edit" id="organo10_edit"
                                        placeholder="Nombre" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-6">
                                    <label>Acto Administrativo de Designación<b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <select style="width: 100%;" class="default-select2 form-control"
                                        id="act_adminis_desid_edit" name="act_adminis_desid_edit">
                                        <option value="Gaceta">Gaceta</option>
                                        <option value="Providencia">Providencia</option>
                                        <option value="Resolución">Resolución</option>
                                        <option value="Punto de Cuenta">Punto de Cuenta</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>N° del Acto <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="number" name="n_acto_edit" id="n_acto_edit">
                                </div>
                                <div class="form-group col-4">
                                    <label>Fecha <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="date" name="fecha_act_edit" id="fecha_act_edit">
                                </div>
                                <div class="form-group col-6">
                                    <label>Área <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <select style="width: 100%;" class="default-select2 form-control" id="area_10_edit"
                                        name="area_10_edit">
                                        <option value="Legal">Legal</option>
                                        <option value="Económica Financiera">Económica Financiera</option>
                                        <option value="Técnica">Técnica</option>
                                        <option value="Secretario">Secretario</option>
                                        <option value="Secretaria">Secretaria</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Duración en la Comisión (tiempo) <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="dura_comi_edit" id="dura_comi_edit">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_modificacion_exp_comis" onclick="save_modif_exp_comis();"
                    class="my-button">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditDictadoCapacitacion" tabindex="-1" role="dialog"
    aria-labelledby="modalEditDictadoCapacitacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditDictadoCapacitacionLabel">Editar Experiencia en Dictado de
                    Capacitación (Últimos 3 Años)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_edit_dictado_capacitacion" name="form_edit_dictado_capacitacion"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>EXPERIENCIA EN DICTADO DE CAPACITACIÓN</b></h5>
                            <div class="row ">
                                <input type="hidden" name="id_dic_cap_3_edit" id="id_dic_cap_3_edit">

                                <div class="form-group col-8">
                                    <label> Órgano o Ente de la Comisión de Contrataciones <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="organo3_edit" id="organo3_edit"
                                        placeholder="Nombre" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Actividad<b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="actividad3_edit" id="actividad3_edit"
                                        placeholder="Actividad" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="date" name="desde3_edit" id="desde3_edit">
                                </div>
                                <div class="form-group col-4">
                                    <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="date" name="hasta3_edit" id="hasta3_edit">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_modificacion_dictado_cap" onclick="save_modif_dictado_cap();"
                    class="my-button">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Experiencia (Últimos 5 años) Orden Cronológico desde
                    el actual o Último</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_expe" name="guardar_expe" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>Experiencias</b></h5>
                            <div class="row ">
                                <div class="form-group col-12">
                                    <label>Órgano/Ente/Institución/Empresa:</label>
                                    <input class="form-control" type="text" name="descripcion" id="descripcion"
                                        readonly>
                                    <input class="form-control" type="hidden" name="arif" id="arif" readonly>
                                    <input class="form-control" type="hidden" name="id_inf_exp5" id="id_inf_exp5"
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
                                    <label>Área:</label>
                                    <input class="form-control" type="text" name="area" id="area">
                                </div>
                                <div class="form-group col-4">
                                    <label>Cargo:</label>
                                    <input class="form-control" type="text" name="cargo" id="cargo">
                                </div>
                                <div class="form-group col-4">
                                    <label>Desde:</label>
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

<div class="modal fade" id="dede" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Información Académica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_add_academica" name="form_add_academica"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>INFORMACIÓN ACADÉMICA</b></h5>
                            <div class="row ">
                                <div class="form-group col-4">
                                    <label> Formación Académica <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <select style="width: 100%;" id="fm_ac" name="fm_ac" class="form-control"
                                        data-show-subtext="true" data-live-search="true">
                                        <option value="0">Seleccione</option>
                                        <?php foreach ($carrera as $data_carrera) : ?>
                                            <option value="<?= $data_carrera['id_academico'] ?>">
                                                <?= $data_carrera['desc_academico'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input class="form-control" type="hidden" name="id_comision_academica_add"
                                        id="id_comision_academica_add"
                                        value="<?= htmlspecialchars($id_comision ?? '') ?>" readonly>
                                    <input class="form-control" type="hidden" name="id_miembros_natu_academica_add"
                                        id="id_miembros_natu_academica_add" readonly>
                                    <input class="form-control" type="hidden" name="cedula_modal_academica_add"
                                        id="cedula_modal_academica_add" readonly>
                                    <input class="form-control" type="hidden" name="nro_comprobante_modal_academica_add"
                                        id="nro_comprobante_modal_academica_add" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Título Obtenido:</label>
                                    <input class="form-control" type="text" name="titulo_add" id="titulo_add">
                                </div>
                                <div class="form-group col-4">
                                    <label> Año de Inicio (aaaa)</label>
                                    <input class="form-control" type="text" name="anioi_add" id="anioi_add">
                                </div>
                                <div class="form-group col-4">
                                    <label>Culminación:</label>
                                    <input class="form-control" type="text" name="anioc_add" id="anioc_add">
                                </div>
                                <div class="form-group col-4">
                                    <label>En Curso:</label>
                                    <select name="curso_add" id="curso_add">
                                        <option value="0">Seleccione</option>
                                        <option value="1">No</option>
                                        <option value="2">Si</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="save_inf_ac_new();" class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalContratacionPublica" tabindex="-1" role="dialog"
    aria-labelledby="modalContratacionPublicaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalContratacionPublicaLabel">Agregar Formación en Materia de Contratación
                    Pública</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_add_contratacion_publica" name="form_add_contratacion_publica"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>INFORMACIÓN DE CAPACITACIÓN EN CONTRATACIÓN PÚBLICA</b></h5>
                            <div class="row ">
                                <div class="form-group col-8">
                                    <label> Taller o Curso de Comisión de Contrataciones <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="taller" id="taller"
                                        placeholder="Nombre" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Institución donde realizó la Formación<b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="institucion" id="institucion"
                                        placeholder="institucion" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Horas de Duración <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="number" name="hor_dura" id="hor_dura">
                                </div>
                                <div class="form-group col-4">
                                    <label>N.º del Certificado <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="certi" id="certi"
                                        onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Fecha Certificado <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="date" name="fech_cert" id="fech_cert">
                                </div>
                                <div class="form-group col-4">
                                    <label>Vigencia<b title="Campo Obligatorio" style="color:red">no
                                            debe dar mas de 2 años</b></label>
                                    <input class="form-control" type="text" name="vigencia" id="vigencia" readonly>
                                </div>
                                <input class="form-control" type="hidden" name="id_comision_cp" id="id_comision_cp"
                                    value="<?= htmlspecialchars($id_comision ?? '') ?>" readonly>
                                <input class="form-control" type="hidden" name="cedula_cp" id="cedula_cp" readonly>
                                <input class="form-control" type="hidden" name="nro_comprobante_cp"
                                    id="nro_comprobante_cp" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_form_cp" onclick="save_formacion_cp();"
                    class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalComisiones" tabindex="-1" role="dialog" aria-labelledby="modalComisionesLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComisionesLabel">Agregar Experiencia en Comisiones de Contrataciones
                    (Últimos 10 Años)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_add_experiencia_comision" name="form_add_experiencia_comision"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>EXPERIENCIA EN COMISIONES DE CONTRATACIONES</b></h5>
                            <div class="row ">
                                <div class="form-group col-8">
                                    <label> Órgano o Ente de la Comisión de Contrataciones <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="organo10" id="organo10"
                                        placeholder="Nombre">
                                </div>
                                <div class="form-group col-6">
                                    <label>Acto Administrativo de Designación<b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <select style="width: 100%;" class="default-select form-control"
                                        id="act_adminis_desid" name="act_adminis_desid">
                                        <option value="Gaceta">Gaceta</option>
                                        <option value="Providencia">Providencia</option>
                                        <option value="Resolución">Resolución</option>
                                        <option value="Punto de Cuenta">Punto de Cuenta</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>N° del Acto <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="number" name="n_acto" id="n_acto">
                                </div>
                                <div class="form-group col-4">
                                    <label>Fecha <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="date" name="fecha_act" id="fecha_act"
                                        max="<?= $time ?>">
                                </div>
                                <div class="form-group col-6">
                                    <label>Área <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <select style="width: 100%;" class="default-select form-control" id="area_10"
                                        name="area_10">
                                        <option value="Legal">Legal</option>
                                        <option value="Económica Financiera">Económica Financiera</option>
                                        <option value="Técnica">Técnica</option>
                                        <option value="Secretario">Secretario</option>
                                        <option value="Secretaria">Secretaria</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Duración en la Comisión (tiempo) <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="dura_comi" id="dura_comi">
                                </div>
                                <input class="form-control" type="hidden" name="id_comision_exp_comis"
                                    id="id_comision_exp_comis" value="<?= htmlspecialchars($id_comision ?? '') ?>"
                                    readonly>
                                <input class="form-control" type="hidden" name="cedula_exp_comis" id="cedula_exp_comis"
                                    readonly>
                                <input class="form-control" type="hidden" name="nro_comprobante_exp_comis"
                                    id="nro_comprobante_exp_comis" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="save_experiencia_comision();" class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDictadoCapacitacion" tabindex="-1" role="dialog"
    aria-labelledby="modalDictadoCapacitacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDictadoCapacitacionLabel">Agregar Experiencia en Dictado de
                    Capacitación (Últimos 3 Años)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_add_dictado_capacitacion" name="form_add_dictado_capacitacion"
                    data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card card-outline-danger">
                            <h5 class="mt-0 text-center"><b>EXPERIENCIA EN DICTADO DE CAPACITACIÓN</b></h5>
                            <div class="row ">
                                <div class="form-group col-8">
                                    <label> Órgano o Ente de la Comisión de Contrataciones <b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="organo3" id="organo3"
                                        placeholder="Nombre" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Actividad<b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="text" name="actividad3" id="actividad3"
                                        placeholder="Actividad" onkeyup="mayusculas(this);">
                                </div>
                                <div class="form-group col-4">
                                    <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="date" name="desde3" id="desde3"
                                        max="<?= $time ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                    <input class="form-control" type="date" name="hasta3" id="hasta3"
                                        max="<?= $time ?>">
                                </div>
                                <input class="form-control" type="hidden" name="id_comision_dictado"
                                    id="id_comision_dictado" value="<?= htmlspecialchars($id_comision ?? '') ?>"
                                    readonly>
                                <input class="form-control" type="hidden" name="cedula_dictado" id="cedula_dictado"
                                    readonly>
                                <input class="form-control" type="hidden" name="nro_comprobante_dictado"
                                    id="nro_comprobante_dictado" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="save_dictado_capacitacion();" class="my-button">Guardar</button>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>/js/comision/editar_inf_academica.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#cam_org").select2({
            dropdownParent: $("#guardar_expe")
        });

        // Configuración para el nuevo modal de agregar información académica
        $("#fm_ac").select2({
            dropdownParent: $("#dede") // Asegúrate de que el select2 se inicialice con el modal correcto
        });
        $("#act_adminis_desid").select2({
            dropdownParent: $("#modalComisiones")
        });
        $("#area_10").select2({
            dropdownParent: $("#modalComisiones")
        });


    });

    // Función para preparar el modal de agregar información académica
    function prepareAcademicModal() {
        // Asume que tienes acceso a estos valores globalmente o los pasas desde el controlador
        // Aquí los dejo vacíos, pero deberías llenarlos con la cedula y nro_comprobante del miembro actual
        // Por ejemplo, si tienes un input hidden con la cédula del miembro en la página principal:
        // var cedula_miembro_actual = $('#cedula_del_miembro_actual').val();
        // var nro_comprobante_actual = $('#nro_comprobante_del_miembro_actual').val();

        // Para fines de este ejemplo, si no los tienes globalmente, tendrías que obtenerlos de la misma manera que para los modales de edición.
        // O podrías obtenerlos de la primera fila de la tabla si siempre estás trabajando con un miembro específico.
        // Por ahora, los dejaré vacíos, necesitarás implementar la lógica para obtenerlos.
        $('#id_miembros_natu_academica_add').val(''); // Debe ser el ID del miembro al que se le añade la info
        $('#cedula_modal_academica_add').val('');
        $('#nro_comprobante_modal_academica_add').val('');

        // Limpiar campos del formulario cada vez que se abre el modal
        $('#form_add_academica')[0].reset();
        $('#fm_ac').val('0').trigger('change'); // Reiniciar select2
        $('#curso_add').val('0');
    }

    // Funciones placeholders para guardar la nueva información
    // DEBERÁS CREAR ESTAS FUNCIONES EN TU ARCHIVO JS (ej. certificacion_oeu.js o un nuevo archivo)
    // Y TAMBIÉN CREAR LAS RUTAS Y FUNCIONES EN TU CONTROLADOR Y MODELO
    // function save_inf_ac_new() {
    //     alert('Funcionalidad para guardar nueva información académica. Debes implementarla.');
    //     // Aquí iría tu lógica de AJAX para guardar la nueva información académica
    //     // Asegúrate de enviar los valores de id_comision_academica_add, cedula_modal_academica_add, nro_comprobante_modal_academica_add
    //     // junto con los demás campos del formulario.
    // }

    // function save_formacion_cp() {
    //     alert('Funcionalidad para guardar Formación en Materia de Contratación Pública. Debes implementarla.');
    //     // Lógica AJAX similar a save_inf_ac_new()
    // }

    // function save_experiencia_comision() {
    //     alert('Funcionalidad para guardar Experiencia en Comisiones de Contrataciones. Debes implementarla.');
    //     // Lógica AJAX similar a save_inf_ac_new()
    // }

    // function save_dictado_capacitacion() {
    //     alert('Funcionalidad para guardar Experiencia en Dictado de Capacitación. Debes implementarla.');
    //     // Lógica AJAX similar a save_inf_ac_new()
    // }

    // Función para convertir a mayúsculas (si no la tienes ya en otro JS)
    function mayusculas(e) {
        e.value = e.value.toUpperCase();
    }
</script>

<script type="text/javascript">
    // These variables are populated by PHP when the page loads
    const MEMBER_ID_ACTUAL = '<?php echo htmlspecialchars($id_miembros_actual ?? ''); ?>';
    const MEMBER_CEDULA_ACTUAL = '<?php echo htmlspecialchars($cedula_del_miembro_actual ?? ''); ?>';
    const MEMBER_NRO_COMPROBANTE_ACTUAL = '<?php echo htmlspecialchars($nro_comprobante_del_miembro_actual ?? ''); ?>';

    // Now, you can use console.log to see these values in your browser's console
    console.log('--- PHP Variables passed to JS ---');
    console.log('id_miembros_actual:', MEMBER_ID_ACTUAL);
    console.log('cedula_del_miembro_actual:', MEMBER_CEDULA_ACTUAL);
    console.log('nro_comprobante_del_miembro_actual:', MEMBER_NRO_COMPROBANTE_ACTUAL);
    console.log('---------------------------------');

    // You can then use these const variables in your prepare functions
    // For example, update prepareAcademicModal to use these:
    function prepareAcademicModal(id_miembro, cedula, nro_comprobante) {
        // You can now choose to use the passed parameters or the global consts
        // Using parameters passed from onclick is generally safer for specific button contexts,
        // but global consts are useful if the info is for the entire page.
        // For clarity, let's continue using the parameters passed to the function:
        $('#id_miembros_natu_academica_add').val(id_miembro);
        $('#cedula_modal_academica_add').val(cedula);
        $('#nro_comprobante_modal_academica_add').val(nro_comprobante);

        // Limpiar campos del formulario cada vez que se abre el modal
        $('#form_add_academica')[0].reset();
        $('#fm_ac').val('0').trigger('change');
        $('#curso_add').val('0');
    }

    // (Add similar updates for your other prepare functions like prepareContratacionPublicaModal, etc.)
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>