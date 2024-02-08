<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Programaciones </h2>
    <h6  style="color:red">Muestra las Programaciones </h6>
    <h6  style="color:red"> Este modulo es solo Autorizar la ediciòn de la programaciòn</h6>

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
								<th>Rif</th>
								<th>Razon Social</th>
								<th>Año de Programación</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($programacion as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                            <td><?=$data['rif']?> </td>
                                
                               <td><?=$data['des_unidad']?> </td>
                                <td><?=$data['anio']?> </td>
                                <td class="center">
									
									<a class="button"><i onclick="delet_sse(<?php echo $data['id_programacion']?>);" class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a/>
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

