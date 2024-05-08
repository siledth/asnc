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
                                <a data-toggle="modal" data-target="#exampleModal1" class="btn btn-green btn-circle waves-effect waves-circle waves-float">
                                    Crear Nuevo Perfil
                                </a>
                            </div>

                            <div class="col-md-12">
                                <div class="panel-body">
                                    <div class="col-12 text-center">
                                        <h4>Perfiles</h4>
                                    </div>

                                    <table id="data-table-default" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th width="15%" class="text-nowrap">Nombre del Perfil</th>
                                                <th width="25%" class="text-nowrap">Fecha de Creación</th>
                                                
                                                <th width="20%" class="text-nowrap">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ver_perfil as $lista) : ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $lista['nombrep'] ?></td>
                                                    <td><?= date("d-m-Y", strtotime($lista['fecha_creacion'])); ?></td>
                                        
                                                    <td>
                                                        <a class="button" href="<?php echo base_url() ?>index.php/User/verPerfil?id=<?php echo $lista['id_perfil']; ?>">
                                                            <i title="Ver Pago" class="fas fa-lg fa-fw fa-eye" style="color: midnightblue;"></i>
                                                        <a />
                                                
                                                       
                                                          
                                                     
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




<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_perfiles" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-10"></div>
                        <div class="form-group col-3">
                            <label>Nombre del Perfil <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="nombrep" id="nombrep"  class="form-control" >
                        </div>
                        <div class="form-group col-4">
                            <label>Menu RNCE <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_rnce" name="menu_rnce" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Menu Programación <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_progr" name="menu_progr" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Menu Evaluación de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_eval_desem" name="menu_eval_desem" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Registrar Evaluación de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_reg_eval_desem" name="menu_reg_eval_desem" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Menu Anulación Eval. de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_anulacion" name="menu_anulacion" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Solicitar Anulación Eval. de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_soli_anular_eval_desem" name="menu_soli_anular_eval_desem" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Procesar Anulación Eval. de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_proc_anular_eval_desem" name="menu_proc_anular_eval_desem" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                           
                        </div>
                        <div class="form-group col-2">
                            <label>Menu Reporte Eval. de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_repor_evalu" name="menu_repor_evalu" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        
                        <div class="form-group col-2">
                            <label>Comprobante Eval. de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_comprobante_eval_desem" name="menu_comprobante_eval_desem" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Estadistica Evalua. de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_estdi_eval_desem" name="menu_estdi_eval_desem" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Empresa no Reg. Eval. de Desempeño <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_noregi_eval_desem" name="menu_noregi_eval_desem" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-4">   
                        </div>
                      
                        <div class="form-group col-2">
                            <label>Visualizar Menu Llamado a concurso <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="menu_llamado" name="menu_llamado" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Consultar Llamado a concurso <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="consultar_llamado" name="consultar_llamado" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Registrar Llamado a concurso <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="reg_llamado" name="reg_llamado" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Anulaciones Llamado a concurso <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="anul_llamado" name="anul_llamado" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Ver Anulaciones de Llamado a concurso <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_anul_llamado" name="ver_anul_llamado" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">   
                        </div>
                        
                        <div class="form-group col-2">
                            <label>Visualizar Menu RNC <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_rnc" name="ver_rnc" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Configuración <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_conf" name="ver_conf" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Tablas Parametro <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_parametro" name="ver_parametro" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Visualizar Conf. Publicaciones <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_conf_publ" name="ver_conf_publ" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-4">   
                        </div>
                        <div class="form-group col-2">
                            <label>Menu Usuarios <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user" name="ver_user" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Usuarios Exter. <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user_exter" name="ver_user_exter" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Desb. Usuarios<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user_desb" name="ver_user_desb" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-2">
                            <label>Lista Usuarios<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user_lista" name="ver_user_lista" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
                        <div class="form-group col-3">
                            <label>Perfiles Usuarios<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select class=" form-control " id="ver_user_perfil" name="ver_user_perfil" >
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                        </div>
  
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_adelanto_pag_b" onclick="guardar_perfil();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/js/usuario/usuario.js"></script>
