<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body"> 
                    <form id="reg_bien" method="POST" class="form-horizontal">
                        <div class="row">
                            <div class="col-12 card card-outline-danger text-center bg-white">
                            <h3 class="mt-2"> <b>Desbloquear Usuario</b></h3>

                                <h5>Fecha.: <?=$time ?> </h5>
                                
                            </div>
                            <div class="col-md-12" >
                            
                                <div class="panel-body">
                                    <table id="data-table-default" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="1%"></th>
                                                <th class="text-nowrap">Usuario</th>
                                                <th class="text-nowrap">Nombre y Apellido</th>
                                                <th class="text-nowrap">Status</th>
                                                <th class="text-nowrap">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($usuarios as $lista):?>
                                                <tr class="odd gradeX">
                                                    <td><?=$lista['id']?></td>
                                                    <td><?=$lista['nombre']?></td>
                                                    <td><?=$lista['nombrefun']?> <?=$lista['apellido']?></td>
                                                    <td>
                                                    <?php 
                                                    if ($lista['id_estatus'] == 4): ?>
                                                            Bloqueado
                                                        <?php endif; ?>
                                                        <?php 
                                                    if ($lista['id_estatus'] < 4): ?>
                                                            Activo
                                                        <?php endif; ?>
                                                        
                                                        </td>
                                                    
                                                    <td>
                                                      
                                                        <?php if ($lista['id_estatus'] == 4): ?>
                                                            <a title="Desbloquear" onclick="desbloquear_usuario(<?php echo $lista['id'];?>);" class="button">
                                                                <i class="fas fa-lg fa-fw fa-times-circle" style="color:#d84600"></i>
                                                            <a/>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                
                                            <?php endforeach;?>
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
</div><script src="<?=base_url()?>/js/usuario/usuario.js"></script>