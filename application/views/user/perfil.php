<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">
                    <form id="reg_bien" method="POST" class="form-horizontal">
                        <div class="row">
                            <div class="col-12 card card-outline-danger text-center bg-white">
                                <h4 class="mt-2"> <b><?= $descripcion ?></b></h4>
                                <h5>RIF.: <?= $rif ?></h5>
                                <h5>Fecha.: <?= $time ?> </h5>
                            </div>
                            <div class="col-9"></div>
                            <div class="col-1 mb-3">
                                <a data-toggle="modal" data-target="#exampleModal1"
                                    class="btn btn-green btn-circle waves-effect waves-circle waves-float">
                                    Asignar Permisos
                                </a>
                            </div>

                            <div class="col-md-12">
                                <div class="panel-body">
                                    <div class="col-12 text-center">
                                        <h4>Permisos</h4>
                                    </div>

                                    <table id="data-table-default" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th width="15%" class="text-nowrap">Nombre </th>
                                                <th width="25%" class="text-nowrap">Fecha de Creación</th>

                                                <th width="20%" class="text-nowrap">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ver_perfil as $data) : ?>
                                            <tr class="odd gradeX">
                                                <td><?= $data['nombrep'] ?></td>
                                                <td><?= date("d-m-Y", strtotime($data['fecha_creacion'])); ?></td>

                                                <td>
                                                    <a class="button"
                                                        href="<?php echo base_url() ?>index.php/User/verPerfil?id=<?php echo $data['id_perfil']; ?>">
                                                        <i title="Ver Pago" class="fas fa-lg fa-fw fa-eye"
                                                            style="color: midnightblue;"></i>
                                                        <a />

                                                        <a onclick="perfiles(<?php echo $data['id_perfil'] ?>);"
                                                            data-toggle="modal" data-target="#perfilm"
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Permisos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_perfiles" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Seleccione nombre del usuario <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select style="width: 100%;" id="id_user" name="id_user" class="form-control"
                                data-show-subtext="true" data-live-search="true">

                                <option value="0">Seleccione</option>
                                <?php foreach ($final as $data):?>
                                <option value="<?=$data['id']?>/<?=$data['nombre']?>"><?=$data['nombre']?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label>Visualizar Módulo RNCE <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_rnce" name="menu_rnce" onclick="selectipo();">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-12" id='campos3' style="display: none;">
                            <div class="row">
                                <div class="card card-outline-black">
                                    <div class="form-group col-6">
                                        <label>Menú Comisión de Contrataciones <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select class=" form-control " id="menu_comisiones" name="menu_comisiones"
                                            onclick="selectipo2();">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-12" id='campos4' style="display: none;">
                                        <div class="row">

                                            <div class="form-group col-2">
                                                <label>Registrar Miembros por SNC <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="comisiones_interna_mieb"
                                                    name="comisiones_interna_mieb">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Registrar Certificación por SNC <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="comisiones_interna_certifi"
                                                    name="comisiones_interna_certifi">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Registrar Notificación Miembros al SNC <b
                                                        title="Campo Obligatorio" style="color:red"></b></label>
                                                <select class=" form-control " id="notif_comisi_externa_mib"
                                                    name="notif_comisi_externa_mib">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Registrar Certificación Miembros <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="certi_miemb_externo"
                                                    name="certi_miemb_externo">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-2">
                                                <label>Consultar por SNC <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="consulta_snc_certi_mb"
                                                    name="consulta_snc_certi_mb">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Consultas Notificaciones de Miembros al SNC <b
                                                        title="Campo Obligatorio" style="color:red"></b></label>
                                                <select class=" form-control " id="consultas_exter_miembros"
                                                    name="consultas_exter_miembros">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Consultas de Certificaciones de Miembros <b
                                                        title="Campo Obligatorio" style="color:red"></b></label>
                                                <select class=" form-control " id="consultas_exter_mb_certificado"
                                                    name="consultas_exter_mb_certificado">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card card-outline-black">
                                    <div class="form-group col-8">
                                        <label>Menú Programación <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select class=" form-control " id="menu_progr" name="menu_progr"
                                            onclick="selectipo3();">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-12" id='campos5' style="display: none;">
                                        <div class="row">

                                            <div class="form-group col-4">
                                                <label>Registrar Programación Anual <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="registrar_prog_anual"
                                                    name="registrar_prog_anual">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Modificación de programación Anual <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="modi_prog_anual_ley"
                                                    name="modi_prog_anual_ley">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Registrar Rendición de la programación anual <b
                                                        title="Campo Obligatorio" style="color:red"></b></label>
                                                <select class=" form-control " id="reg_rend_anual"
                                                    name="reg_rend_anual">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Consultar programación Anual <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="consul_prog_anual"
                                                    name="consul_prog_anual">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Consultar Modificaciones <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="consul_mod_ley_anual"
                                                    name="consul_mod_ley_anual">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Consultar rendiciones <b title="Campo Obligatorio"
                                                        style="color:red"></b> </label>
                                                <select class=" form-control " id="consultar_rendi_anual"
                                                    name="consultar_rendi_anual">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card card-outline-black">
                                    <div class="form-group col-8">
                                        <label>Menú Evaluación de Desempeño <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select class=" form-control " id="menu_eval_desem" name="menu_eval_desem"
                                            onclick="selectipo4();">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-12" id='campos6' style="display: none;">
                                        <div class="row">

                                            <div class="form-group col-4">
                                                <label>Registrar Evaluación de Desempeño <b title="Campo Obligatorio"
                                                        style="color:red"></b><br><br></label>
                                                <select class=" form-control " id="menu_reg_eval_desem"
                                                    name="menu_reg_eval_desem">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Menú Anulación Eval. de Desempeño <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="menu_anulacion"
                                                    name="menu_anulacion">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Solicitar Anulación Eval. de Desempeño<b
                                                        title="Campo Obligatorio" style="color:red"></b></label>
                                                <select class=" form-control " id="menu_soli_anular_eval_desem"
                                                    name="menu_soli_anular_eval_desem">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Procesar Anulación Eval. de Desempeño <b
                                                        title="Campo Obligatorio" style="color:red"></b></label>
                                                <select class=" form-control " id="menu_proc_anular_eval_desem"
                                                    name="menu_proc_anular_eval_desem">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Menú Reporte Eval. de Desempeño <b title="Campo Obligatorio"
                                                        style="color:red"></b><br><br></label>
                                                <select class=" form-control " id="menu_repor_evalu"
                                                    name="menu_repor_evalu">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Comprobante Eval. de Desempeño<b title="Campo Obligatorio"
                                                        style="color:red"></b> </label>
                                                <select class=" form-control " id="menu_comprobante_eval_desem"
                                                    name="menu_comprobante_eval_desem">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Estadistica Evalua. de Desempeño<b title="Campo Obligatorio"
                                                        style="color:red"></b> </label>
                                                <select class=" form-control " id="menu_estdi_eval_desem"
                                                    name="menu_estdi_eval_desem">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Empresa no Reg. Eval. de Desempeño<b title="Campo Obligatorio"
                                                        style="color:red"></b> </label>
                                                <select class=" form-control " id="menu_noregi_eval_desem"
                                                    name="menu_noregi_eval_desem">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card card-outline-black">
                                    <div class="form-group col-8">
                                        <label>Menú Llamado a concurso <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select class=" form-control " id="menu_llamado" name="menu_llamado"
                                            onclick="selectipo5();">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-12" id='campos7' style="display: none;">
                                        <div class="row">

                                            <div class="form-group col-4">
                                                <label>Consultar Llamado a concurso <b title="Campo Obligatorio"
                                                        style="color:red"></b><br><br></label>
                                                <select class=" form-control " id="consultar_llamado"
                                                    name="consultar_llamado">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Registrar Llamado a concurso <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="reg_llamado" name="reg_llamado">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Procesos Llamado a concurso<b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="anul_llamado" name="anul_llamado">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Acciones Llamados a concurso <b title="Campo Obligatorio"
                                                        style="color:red"></b></label>
                                                <select class=" form-control " id="accion_llamado"
                                                    name="accion_llamado">
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label>Visualizar Menú RNC <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_rnc" name="ver_rnc">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>

                        <div class="form-group col-8">
                            <label>Visualizar Menú Configuración<b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="ver_conf" name="ver_conf" onclick="selectipo6();">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="card card-outline-black">
                            <div class="form-group col-12" id='campos8' style="display: none;">
                                <div class="row">

                                    <div class="form-group col-4">
                                        <label>Visualizar Tablas Parametro<b title="Campo Obligatorio"
                                                style="color:red"></b><br><br></label>
                                        <select class=" form-control " id="ver_parametro" name="ver_parametro">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Visualizar Conf. Publicaciones <b title="Campo Obligatorio"
                                                style="color:red"></b></label>
                                        <select class=" form-control " id="ver_conf_publ" name="ver_conf_publ">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Menú Usuarios<b title="Campo Obligatorio" style="color:red"></b></label>
                                        <select class=" form-control " id="ver_user" name="ver_user">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Usuarios Exter. <b title="Campo Obligatorio"
                                                style="color:red"></b></label>
                                        <select class=" form-control " id="ver_user_exter" name="ver_user_exter">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Desb. Usuarios <b title="Campo Obligatorio"
                                                style="color:red"></b></label>
                                        <select class=" form-control " id="ver_user_desb" name="ver_user_desb">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Lista Usuarios <b title="Campo Obligatorio"
                                                style="color:red"></b></label>
                                        <select class=" form-control " id="ver_user_lista" name="ver_user_lista">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Permisos de Usuarios<b title="Campo Obligatorio"
                                                style="color:red"></b></label>
                                        <select class=" form-control " id="ver_user_perfil" name="ver_user_perfil">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_adelanto_pag_b" onclick="guardar_perfil();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="perfilm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Permisos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_perfiles" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-10"></div>
                        <div class="form-group col-3">
                            <label>Nombre del Perfil <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="nombrep1" id="nombrep1" class="form-control" readonly>
                            <input type="hidden" name="id2" id="id2" class="form-control" readonly>
                            <input type="hidden" name="id3" id="id3" class="form-control" readonly>


                        </div>
                        <div class="form-group col-4">
                            <label>Menú RNCE <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="menu_rnce1" id="menu_rnce1" class="form-control" readonly>
                            <input type="text" name="menu_rnce3" id="menu_rnce3" class="form-control" readonly>


                        </div>
                        <div class="form-group col-4">
                            <label> Camb.Menú RNCE <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_rnce2" name="menu_rnce2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Menú Programación <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="menu_progr1" id="menu_progr1" class="form-control" readonly>
                            <input type="text" name="menu_progr3" id="menu_progr3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Menú Programación <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_progr2" name="menu_progr2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Menú Evaluación de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_eval_desem1" id="menu_eval_desem1" class="form-control"
                                readonly>
                            <input type="text" name="menu_eval_desem3" id="menu_eval_desem3" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Visualizar Menú Evaluación de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_eval_desem2" name="menu_eval_desem2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Registrar Evaluación de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_reg_eval_desem1" id="menu_reg_eval_desem1"
                                class="form-control" readonly>
                            <input type="text" name="menu_reg_eval_desem3" id="menu_reg_eval_desem3"
                                class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Registrar Evaluación de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_reg_eval_desem2" name="menu_reg_eval_desem2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Menú Anulación Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_anulacion1" id="menu_anulacion1" class="form-control"
                                readonly>
                            <input type="text" name="menu_anulacion3" id="menu_anulacion3" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Visualizar Menú Anulación Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_anulacion2" name="menu_anulacion2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Solicitar Anulación Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_soli_anular_eval_desem1" id="menu_soli_anular_eval_desem1"
                                class="form-control" readonly>
                            <input type="text" name="menu_soli_anular_eval_desem3" id="menu_soli_anular_eval_desem3"
                                class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb. Solicitar Anulación Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_soli_anular_eval_desem2"
                                name="menu_soli_anular_eval_desem2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Procesar Anulación Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_proc_anular_eval_desem1" id="menu_proc_anular_eval_desem1"
                                class="form-control" readonly>
                            <input type="text" name="menu_proc_anular_eval_desem3" id="menu_proc_anular_eval_desem3"
                                class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Procesar Anulación Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_proc_anular_eval_desem2"
                                name="menu_proc_anular_eval_desem2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>


                        <div class="form-group col-2">
                            <label>Comprobante Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_comprobante_eval_desem1" id="menu_comprobante_eval_desem1"
                                class="form-control" readonly>
                            <input type="text" name="menu_comprobante_eval_desem3" id="menu_comprobante_eval_desem3"
                                class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Comprobante Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_comprobante_eval_desem2"
                                name="menu_comprobante_eval_desem2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Estadistica Evalua. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_estdi_eval_desem1" id="menu_estdi_eval_desem1"
                                class="form-control" readonly>
                            <input type="text" name="menu_estdi_eval_desem3" id="menu_estdi_eval_desem3"
                                class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Estadistica Evalua. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_estdi_eval_desem2" name="menu_estdi_eval_desem2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Empresa no Reg. Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_noregi_eval_desem1" id="menu_noregi_eval_desem1"
                                class="form-control" readonly>
                            <input type="text" name="menu_noregi_eval_desem3" id="menu_noregi_eval_desem3"
                                class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Empresa no Reg. Eval. de Desempeño <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_noregi_eval_desem2" name="menu_noregi_eval_desem2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Menu Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="menu_llamado1" id="menu_llamado1" class="form-control" readonly>
                            <input type="text" name="menu_llamado3" id="menu_llamado3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Visualizar Menu Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="menu_llamado2" name="menu_llamado2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Consultar Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="consultar_llamado1" id="consultar_llamado1" class="form-control"
                                readonly>
                            <input type="text" name="consultar_llamado3" id="consultar_llamado3" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Consultar Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="consultar_llamado2" name="consultar_llamado2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Registrar Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="reg_llamado1" id="reg_llamado1" class="form-control" readonly>
                            <input type="text" name="reg_llamado3" id="reg_llamado3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Registrar Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="reg_llamado2" name="reg_llamado2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Anulaciones Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="anul_llamado1" id="anul_llamado1" class="form-control" readonly>
                            <input type="text" name="anul_llamado3" id="anul_llamado3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Anulaciones Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="anul_llamado2" name="anul_llamado2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Ver Anulaciones de Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="ver_anul_llamado1" id="ver_anul_llamado1" class="form-control"
                                readonly>
                            <input type="text" name="ver_anul_llamado3" id="ver_anul_llamado3" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Ver Anulaciones de Llamado a concurso <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="ver_anul_llamado2" name="ver_anul_llamado2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Menu RNC <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="ver_rnc1" id="ver_rnc1" class="form-control" readonly>
                            <input type="text" name="ver_rnc3" id="ver_rnc3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Visualizar Menu RNC <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_rnc2" name="ver_rnc2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Busqueda Investigación <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="invest_contratista1" id="invest_contratista1" class="form-control"
                                readonly>
                            <input type="text" name="invest_contratista3" id="invest_contratista3" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Busqueda Investigación <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="invest_contratista2" name="invest_contratista2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Configuración <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="ver_conf1" id="ver_conf1" class="form-control" readonly>
                            <input type="text" name="ver_conf3" id="ver_conf3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Visualizar Configuración <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="ver_conf2" name="ver_conf2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Tablas Parametro <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="ver_parametro1" id="ver_parametro1" class="form-control" readonly>
                            <input type="text" name="ver_parametro3" id="ver_parametro3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Tablas Parametro <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="ver_parametro2" name="ver_parametro2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Conf. Publicaciones <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <input type="text" name="ver_conf_publ1" id="ver_conf_publ1" class="form-control" readonly>
                            <input type="text" name="ver_conf_publ3" id="ver_conf_publ3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Visualizar Conf. Publicaciones <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>
                            <select class=" form-control " id="ver_conf_publ2" name="ver_conf_publ2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Menú Usuarios <b title="Campo Obligatorio" style="color:red">*</b><br><br> </label>
                            <input type="text" name="ver_user1" id="ver_user1" class="form-control" readonly>
                            <input type="text" name="ver_user3" id="ver_user3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Menú Usuarios <b title="Campo Obligatorio" style="color:red">*</b><br><br></label>
                            <select class=" form-control " id="ver_user2" name="ver_user2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Usuarios Exter. <b title="Campo Obligatorio" style="color:red">*</b><br><br></label>
                            <input type="text" name="ver_user_exter1" id="ver_user_exter1" class="form-control"
                                readonly>
                            <input type="text" name="ver_user_exter3" id="ver_user_exter3" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Usuarios Exter. <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user_exter2" name="ver_user_exter2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Desb. Usuarios <b title="Campo Obligatorio" style="color:red">*</b><br><br></label>
                            <input type="text" name="ver_user_desb1" id="ver_user_desb1" class="form-control" readonly>
                            <input type="text" name="ver_user_desb3" id="ver_user_desb3" class="form-control" readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Desb. Usuarios<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user_desb2" name="ver_user_desb2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Lista Usuarios<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="ver_user_lista1" id="ver_user_lista1" class="form-control"
                                readonly>
                            <input type="text" name="ver_user_lista3" id="ver_user_lista3" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Lista Usuarios<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user_lista2" name="ver_user_lista2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Perfiles<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="ver_user_perfil1" id="ver_user_perfil1" class="form-control"
                                readonly>
                            <input type="text" name="ver_user_perfil3" id="ver_user_perfil3" class="form-control"
                                readonly>

                        </div>
                        <div class="form-group col-2">
                            <label>Camb.Perfiles Usuarios<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user_perfil2" name="ver_user_perfil2">
                                <option value="2">Sel</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_adelanto_pag_b" onclick="edit_perfil();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/js/usuario/usuario.js"></script>
<script src="<?= base_url() ?>/js/usuario/editar_perfil.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    $("#id_user").select2({
        dropdownParent: $("#guardar_perfiles")
    });
});
</script>