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
								<th>N°</th>

								<th>Rif</th>
								<th>Razon Social</th>
								<th>Año de Programación</th>
								<th>Motivo</th>
								<th>Estatus</th>

								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($programacion as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                            <td><?=$data['id_auth']?> </td>

                            <td><?=$data['rif']?> </td>
                                
                               <td><?=$data['descripcion']?> </td>
                                <td><?=$data['anio']?> </td>
                                <td><?=$data['motivo']?> </td>
                                <td><?=$data['id_estatus']?> </td>


                                <td class="center">
                                <a class="button">
                                <?php if ($data['id_estatus'] != 2): ?>
                                        <i title="Ver datos de solicitud" onclick="modal_ver(<?php echo $data['id_auth']?>);" data-toggle="modal" data-target="#exampleModal_ver" class="fas fa-lg fa-fw fa-file-excel" style="color: blue;"></i>
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
	</div>
</div>
<div class="modal fade" id="exampleModal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de la solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_solicitud" name="resgistrar_solicitud" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-2">
                            <label> </label>
                            <input class="form-control text-center" type="text" name="id_ver" id="id_ver" readonly>
                            <input class="form-control text-center" type="text" name="id" id="id" readonly>

                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Realizada Por</label>
                            <input class="form-control" type="text" name="rif" id="rif" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Razon Social</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" readonly />
                        </div>
                        <div class="form-group col-4">
                            <label>Año de Programación</label>
                            <input class="form-control" type="text" name="anio" id="anio" readonly>
                        </div>
                        
                        <div class="form-group col-12">
                            <label>Breve descripción de la Solicitud</label>
                            <textarea class="form-control" rows="2" name="motivo" id="motivo" readonly></textarea>
                        </div>
                        <div class="form-group col-4">
                            <label>Cedula del Solicitante</label>
                            <input class="form-control" type="text" name="cedula_solc" id="cedula_solc" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control" type="text" name="nom_ape_solc" id="nom_ape_solc" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Telefono del Solicitante</label>
                            <input class="form-control" type="text" name="telf_solc" id="telf_solc" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de solicitud</label>
                            <input class="form-control" type="text" name="fecha_solicitud" id="fecha_solicitud" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_pago_fin" onclick="guardar();"
                    class="btn btn-primary">Guardar</button>
            </div>
            
        </div>
    </div>
</div>
<script src="<?=base_url()?>/js/programacion/auth/apro_auth.js"></script>

