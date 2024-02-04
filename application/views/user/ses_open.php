<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Sesiones Abiertas</h2>
    <h6  style="color:red">Muestra las Sesiones abiertas por los usuarios, si un usuario no cierra la Sesión debera esperar 20 minutos para poder volver a iniciar sesión, </h6>
    <h6  style="color:red">de lo contratio, en este módulo el analista tendra la opción de liberar la sesión.  </h6>

    <div class="row">
        <div class="col-lg-12">
            

            <div class="col-lg-12">
                <div class="panel panel-inverse">
                <div class="panel-heading"></div>
				<div class="table-responsive">
                <table id="data-table-default" data-order='[[ 0, "desc" ]]'
                        class="table table-bordered table-hover">
						<thead style="background:#e4e7e8">
							<tr>
								
								<th>Nombre de Usuario</th>
								<th>Fecha Login</th>

								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($sseesion as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['nombre']?> </td>
                                <td><?=$data['login_time']?> </td>
                                <td class="center">
									
									<a class="button"><i onclick="delet_sse(<?php echo $data['user_id']?>);" class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a/>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
					</table>
				</div>
            </div>
        </div>
	</div>
</div>

<script src="<?=base_url()?>/js/usuario/sess_user.js"></script>

