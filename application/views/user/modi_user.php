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

<script src="<?= base_url() ?>/js/usuario/usuario.js"></script>

