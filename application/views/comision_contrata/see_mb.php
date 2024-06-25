<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Miembros de Comisión </h2>
    <div class="row">

        <div class="col-12 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                    <button type="button" class="my-button4"
                                    onclick="modal(<?php echo $id_comision ?>);" data-toggle="modal"
                                    data-target="#dede">
                                    Ingresar Miembros de Comisión
                                </button>
                                <br><br>
               

                            <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
          
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <table id="data-table-default" data-order='[[ 0, "asc" ]]'
                        class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">
                                <th style="color:white;">ID</th>
                                <th style="color:white;">Cedula</th>
                                <th style="color:white;">Nombre</th>
                                <th style="color:white;">Àrea</th>
                                <th style="color:white;">Tipo integrante</th>
                                <th style="color:white;">Estatus</th>



                               
                                <th style="color:white;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ver as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['id_miembros']?> </td>
                                <td><?=$data['cedula']?> </td>
                                <td><?=$data['nombre']?>  <?=$data['apellido']?> </td>
                                <td><?=$data['desc_area_miembro']?> </td>
                                <td><?=$data['desc_tp_miembro']?> </td>
                                <td><?=$data['desc_status']?> </td>



                                <td class="center">
                                <a class="button">
                                        <i title="Editar" onclick="modal_ver(<?php echo $data['id_miembros']?>);" 
                                        data-toggle="modal" data-target="#exampleModal" class="fas fa-2x fa-fw fa-edit" 
                                        style="color:green"></i>
                                    <a/>
                                <!-- <a onclick="modal(<?php echo $data['id_comision'] ?>);" data-toggle="modal"
                                                data-target="#dede" style="color: white">
                                                <i title="Ingresar Miembros de Comisión"
                                                    class="fas fa-2x fa-fw fa-address-card"
                                                    style="color: darkblue;"></i>
                                                    
                                            </a> -->
                                <?php if ($data['id_status'] == 1) : ?>

                                <a title="Desactivar Miembro"
                                                    onclick="inactivar(<?php echo $data['id_miembros'];?>);"
                                                    class="button">
                                                    <i  class="fas fa-2x fa-fw  fa-ban"
                                                    style="color: red;"></i>
                                                    <a />
                                                    <?php else: ?>
                                                <a onclick="modal(<?php echo $data['id_comision'] ?>);" data-toggle="modal"
                                                data-target="#dede" style="color: white">
                                                <i title="Ingresar Miembros de Comisión"
                                                    class="fas fa-2x fa-fw fa-address-card"
                                                    style="color: darkblue;"></i>
                                                    
                                            </a>
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
    <div class="modal fade" id="dede" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Miembros de Comisión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag"
                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <!-- <div class="form-group col-7">
                                <label>Seleccione Tipo de Comisión <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <select style="width: 100%;" onclick="ver_obs();" id="tipo_comi" name="tipo_comi"
                                    class="form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($tp_contrata as $data) : ?>
                                    <option value="<?= $data['id_tipo_comision']?>"><?= $data['descripcion']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> -->
                            <div class="row" id='campos' style="display: none;">


                                <div class="form-group col-6">
                                    <label>Indique el Objeto de la Comisión Temporal</label>
                                    <textarea name="observacion1" id="observacion1" rows="5" cols="100"></textarea>
                                </div>
                            </div>

                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b>DATOS DEL MIEMBRO DESIGNADO</b></h5>
                                <div class="row ">
                                    <div class="form-group col-4">
                                        <label>Cédula de Identidad/ Pasaporte</label>
                                        <input class="form-control" type="text" name="cedula" id="cedula">
                                        <input class="form-control" type="hidden" name="id_comision" id="id_comision"
                                            readonly>
                                        <input class="form-control" type="hidden" name="rif_organoente2"
                                            id="rif_organoente2" readonly>


                                    </div>
                                    <div class="form-group col-4">
                                        <label>Nombres</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Apellidos</label>
                                        <input class="form-control" type="text" name="apellido" id="apellido">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Seleccione Área <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select style="width: 100%;" id="tipo_area" name="tipo_area"
                                            class="form-control" data-show-subtext="true" data-live-search="true">
                                            <option value="0">Seleccione</option>
                                            <?php foreach ($area as $data) : ?>
                                            <option value="<?= $data['id_area_miembro']?>">
                                                <?= $data['desc_area_miembro']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Seleccione Tipo Integrante <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select style="width: 100%;" id="tp_miembro" name="tp_miembro"
                                            class="form-control" data-show-subtext="true" data-live-search="true">
                                            <option value="0">Seleccione</option>
                                            <?php foreach ($tipo as $data) : ?>
                                            <option value="<?= $data['id_tp_miembro']?>"><?= $data['desc_tp_miembro']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Dirección de Correo Electrónico</label>
                                        <input class="form-control" type="text" name="correo" id="correo">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Teléfono</label>
                                        <input class="form-control" type="text" name="telf" id="telf">
                                    </div>
                                </div>

                            </div>




                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_pago_fin" onclick="save_miembros1();"
                        class="my-button">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" data-sortable-id="form-validation-1">
				<form class="form-horizontal" id="editar" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
			    	<div class="row">
                        <div class="form-group col-4"> 
                            <label>ID</label>
                            <input class="form-control" type="text" name="id" id="id" readonly>
                        </div>
                        <div class="col-8"></div>
                        <div class="form-group col-4">
                            <label>Cedula</label>
                            <input class="form-control" type="text" onkeypress="return valideKey(event);" 
                             name="cod_banco_edit" id="cod_banco_edit">
                        </div>
                        <div class="form-group col-8">
                            <label>Nombre </label>
                            <input type="text" class="form-control"  onkeypress="may(this);" 
                            id="nombre_banco_edit" name="nombre_banco_edit">
                        </div>
                        <div class="form-group col-6">
                            <label>Apellido </label>
                            <input type="text" class="form-control"  onkeypress="may(this);" 
                            id="apellido_mb_edit" name="apellido_mb_edit">
                        </div>
                        <div class="form-group col-6">
                            <label>Area Miembro</label>
                            <input type="text" class="form-control" name="desc_are_edit" 
                            id="desc_are_edit" disabled>
                            <input type="hidden" name="id_amb_edit" id="id_amb_edit">
                        </div>
                        <div class="form-group col-6">
                            <label> Cambiar area miembro <i
                                    title="Si quiere cambiar area miembro, debe seleccionarla en este campo"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="camb_unid_medi_b" id="camb_unid_medi_b">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>Tipo Miembro</label>
                            <input type="text" class="form-control" name="desc_tipo_edit" id="desc_tipo_edit" disabled>
                            <input type="hidden" name="id_tipo_edit" id="id_tipo_edit">
                        </div>
                        <div class="form-group col-6">
                            <label> Cambiar Tipo miembro <i
                                    title="Si quiere cambiar tipo miembro, debe seleccionarla en este campo"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="camb_tipo_medi_b" id="camb_tipo_medi_b">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_tabla_b1();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

    <script src="<?=base_url()?>/js/comision/miemb.js">   </script>

 <script type="text/javascript">
    $(document).ready(function() {
        $("#id_miembro4").select2({
            dropdownParent: $("#academico")
        });
    });
    </script>