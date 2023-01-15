<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Clasificación</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="guardar_tcu" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
					<div class="panel-body">
						<div class="row">
						<div class="form-group col-6">
							<label>Clasificación <b title="Campo Obligatorio" style="color:red">*</b></label>
							<input class="form-control" onkeypress="may(this);"  type="text" name="desc_clasificacion" id="desc_clasificacion" placeholder="Descripción de la Clasificación">
						</div>
						</div>
					</div>
					<div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_tc();" id="guardar" name="guardar" class="btn btn-primary mb-3">Guardar</button>
                    </div>
				</form>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-inverse">
                <div class="panel-heading"></div>
				<div class="table-responsive">
					<table id="records" class="table table-bordered table-hover">
						<thead style="background:#e4e7e8">
							<tr>
								<th>ID</th>
								<th>Descripción de la Clasificación</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($clasificacion as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_clasificacion']?> </td>
                                <td><?=$data['desc_clasificacion']?> </td>
                                <td class="center">
									<a class="button">
                                        <i title="Editar" onclick="modal_ver_tc(<?php echo $data['id_clasificacion']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                    <a/>
									
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

<script src="<?=base_url()?>/js/tablas_parametro.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Descripción de la Clasificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="editar" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
			    	<div class="row">
                        <div class="form-group col-4">
                            <label>ID </label>
                            <input class="form-control" type="text" name="id_clasificacion" id="id_clasificacion" readonly>
                        </div>
                        <div class="col-8"></div>
                        <div class="form-group col-12">
                            <label>Descripción de la Clasificación </label>
                            <input type="text" class="form-control"  onkeypress="may(this);" id="desc_clasificacion_edit" name="desc_clasificacion_edit">
                        </div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="editar_tc();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
