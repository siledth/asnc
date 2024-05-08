<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="col-12"><br>
                    <h3 class="text-center">Solicitud de editar Programación anual</h3>
                    <table id="data-table-default" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                 <th>Rif</th>
								<th>Razon Social</th>
								<th>Año de Programación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($programacion as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                 <td><?=$data['rif']?> </td>                                
                                <td><?=$data['des_unidad']?> </td>
                                 <td><?=$data['anio']?> </td>
                                <td class="center">
                                    
                                        <a class="button">
                                            <i title="Solicitar Habilitar editar Programaciòn anual" onclick="modal(<?php echo $data['id_programacion']?>);" data-toggle="modal" data-target="#exampleModal" class="fas fa-lg fa-fw fa-times" style="color: red;"></i>
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
<!-- MODAL PARA INGRESAR LA INFORMACIÓN DE slicitud -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitud Editar Programaciòn Anual Enviada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_solicitud" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
				<fieldset class="border border-success p-10 shadow-lg">
                   
                <div class="row">
                        <div class="form-group col-2">
                            <input class="form-control text-center" type="hidden" name="id" id="id" readonly>
                        </div>
                        <div class="col-10"></div>
                       
                        <div class="form-group col-4">
                            <label>Cédula del Sol.</label>
                            <input class="form-control" type="text" name="cd" id="cd">
                        </div>
                        <div class="form-group col-4">
                            <label>Télefono del Solicitante</label>
                            <input class="form-control" type="text" name="telf_solc" id="telf_solc">
                        </div>
                        <div class="form-group col-6">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control" type="text" name="nom_ape_solc" id="nom_ape_solc">
                        </div>

                        <div class="form-group col-6">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo" id="cargo">
                        </div>
                        <div class="form-group col-12">
                            <label>Breve descripción de la Solicitud (motivo)</label>
                            <textarea class="form-control" rows="2" name="motivo" id="motivo"></textarea>
                        </div>
                    </div>
				</fieldset>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_solicitud();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA MOSTRAR LA INFORMACIÓN DE LA ANULACION -->
<!-- <div class="modal fade" id="exampleModal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de la Anulación de Desempeño</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_anulacion" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-2">
                            <label>ID de Evaluación</label>
                            <input class="form-control text-center" type="text" name="id_ver" id="id_ver" readonly>
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Nro. de Oficio de la Solicitud</label>
                            <input class="form-control" type="text" name="nro_oficicio_ver" id="nro_oficicio_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de Notificación</label>
                            <input type="text" class="form-control" id="fec_solicitud_ver" name="fec_solicitud_ver" readonly />
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. del Expediente</label>
                            <input class="form-control" type="text" name="nro_expediente_ver" id="nro_expediente_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. Gaceta, Resolución o Providencia</label>
                            <input class="form-control" type="text" name="nro_gacet_resol_ver" id="nro_gacet_resol_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Cédula del Sol.</label>
                            <input class="form-control" type="text" name="cedula_solc_ver" id="cedula_solc_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Télefono del Solicitante</label>
                            <input class="form-control" type="text" name="telf_solc_ver" id="telf_solc_ver" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control" type="text" name="nom_ape_solc_ver" id="nom_ape_solc_ver" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo_ver" id="cargo_ver" readonly>
                        </div>
                        <div class="form-group col-12">
                            <label>Breve descripción de la Solicitud</label>
                            <textarea class="form-control" rows="2" name="descp_anul_ver" id="descp_anul_ver" readonly></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div> -->
<script src="<?=base_url()?>/js/programacion/auth/auth_prog.js"></script>
