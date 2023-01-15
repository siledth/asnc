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
                            

                            <div class="col-md-12">
                                <div class="panel-body">
                                    <div class="col-12 text-center">
                                        <h4>Lista de Usuarios del SNC</h4>
                                    </div>

                                    <table id="data-table-default" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th width="15%" class="text-nowrap">Usuario</th>
                                                <th width="25%" class="text-nowrap">Organo/Ente</th>
                                                <th width="25%" class="text-nowrap">Perfil</th>
                                                <th width="20%" class="text-nowrap">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ver_usuarios as $lista) : ?>
                                                <tr class="odd gradeX">
                                              
                                                    <td><?= $lista['nombre'] ?></td>
                                                    <td><?= $lista['descripcion'] ?></td>
                                                    <td><?= $lista['nombrep'] ?></td>
                                                    <td>
                                                        <a class="button" href="<?php echo base_url() ?>index.php/User/verUsuario?id=<?php echo $lista['id'];?>">
                                                            <i title="Ver Usuario" class="fas fa-lg fa-fw fa-eye" style="color: midnightblue;"></i>
                                                        <a />
                                                        <a class="button" href="<?php echo base_url() ?>index.php/User/verUsuario_editar?id=<?php echo $lista['id'];?>">
                                                            <i title="Ver Modificar" class="fas fa-lg fa-fw  fa-edit" style="color: midnightblue;"></i>
                                                        <a />
                                                        
                                                        
                                                        <?php //if ($lista['id_status'] != 2) : ?>
                                                            
                                                        <?php //endif; ?>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_mod_user" name="guardar_mod_user" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-4">
                            <label>Nombre Funcionario <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="nombrefun" id="nombrefun"  class="form-control" >
                            <input type="hidden" name="id_ver" id="id_ver"  class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Apellido Funcionario</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" >
                        </div>
                        <div class="col-3">
                            <label>Cedula de identidad </label>
                            <input class="form-control" type="text" name="cedula" id="cedula" >
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Correo</label>
                            <input class="form-control" type="text" name="email" id="email" >
                        </div>
                        <div class="form-group col-3">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo" id="cargo" >
                        </div>
                        <div class="form-group col-3">
                            <label>Oficina</label>
                            <input class="form-control" type="text" name="oficina" id="oficina" >
                        </div>
                        <div class="form-group col-3">
                            <label>Teléfono</label>
                            <input class="form-control" type="text" name="tele_1" id="tele_1" >
                        </div>
                        <div class="form-group col-3">
                            <label>Telefono Oficina</label>
                            <input class="form-control" type="text" name="tele_2" id="tele_2"  >
                         
                        </div> 
                        <div class="form-group col-3">
                            <label>Telefono Oficina</label>
                            <input class="form-control" type="text" name="nombrep" id="nombrep"  >
                         
                        </div> 
                        
                            <div class="col-6 mt-3 form-group" id="acc_acc">
                                <label>Perfil de Usuario<b style="color:red">*</b></label><br>
                                <select style="width: 100%;"  name="perfil" id="perfil" class="default form-control">
                               
                                   
                                <?php foreach ($ver_perfil as $data): ?>
                                    <option value="<?=$data['id_perfil']?>"><?=$data['nombrep']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>



                        <div class="form-group col-3">
                            <label>Perfil de Usuario</label></b>
                            <select
                                        class="default-select2 form-control "
                                        id="perfil" name="perfil">
                                        <option value="none" <?php // echo set_select('perfil', 'none', true);?>>-
                                            Seleccione -</option>

                                        <?php foreach ($ver_perfil as $data): ?>

                                        <option value="<?=$data['id_perfil']?>"><?=$data['nombrep']?> </option>
                                        <?php endforeach; ?>
                                    </select>
                        </div>  
                    </div>
                   
                   
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_pago_fin" onclick="mod_user();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>




<script src="<?= base_url() ?>/js/usuario/usuario.js"></script>

