
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
            <div  class="panel panel-inverse" >
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                                    <p class="f-s-16">RIF.: <?=$rif?> <br>
                                    Código ONAPRE: <?=$codigo_onapre?> <br>
                                    Año: <b><?=$anio?></b></p>
                                    <input type="hidden" id="id_programacion" name="id_programacion" value="<?=$id_programacion?>">
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                                    <h1 style="color:red;">Modificación de una Programación</h1>
                                </div>
                    <div class="col-12 text-center">
                        <div class="row">
                            <div class="col-4">
                              CREAR NUEVA ACCIÓN CENTRALIZADA O PROYECTO ->>>> <a onclick="bienes(<?php echo $id_programacion ?>);" data-toggle="modal"
                                    data-target="#bienes" style="color: white" > 
                                    <i title="Crear" class="fas fa-clipboard" title="Crear" style='font-size:48px;color:red'></i>
                                </a>                              
                                  
                            </div>
                           
                           
                            <!-- <div class="col-4">
                                <button onclick="location.href='<?php echo base_url()?>index.php/Programacion/add?id=<?php echo $id_programacion;?>'" type="button" class="btn btn-lg btn-default"  name="button">
                                    Agregar Información de todas
                                </button>
                            </div> -->
                        </div>

                            
                        <!-- <button onclick="location.href='<?php echo base_url()?>index.php/Programacion/pdf_compl?id=<?php echo $id_programacion;?>'" type="button" class="btn btn-lg mt-2 mb-2 btn-default"  name="button">
                            Ver PDF con Información Completa
                        </button> -->
                    </div>
                    <div class="col-11" style="margin-left: 40px;">
                            <div class="table-responsive mt-3">
                                <div class="col-12 text-center">
                                    <h4 style="color:red;">Totales Por partida Presupuestaria</h4>
                                </div>
                                <table id="data-table-default" class="table table-bordered table-hover">
                                    <thead style="background:#e4e7e8;">
                                        <tr class="text-center">
                                            <th>Código Part. Presupuestaria</th>
                                            <th>Partida Presupuestaria</th>                                         
                                                <th>Total Sin iva</th>
                                                <th>Total con iva</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($totalespartida as $totalespartida):?>
                                            <tr class="odd gradeX" style="text-align:center">
                                                <td ><?=$totalespartida['codigopartida_presupuestaria']?></td>
                                                <td><?=$totalespartida['desc_partida_presupuestaria']?></td>
                                                <td><?=number_format($totalespartida['precio_total'], 2, ',', '.')?></td>
                                                <td><?=number_format($totalespartida['monto_estimado'], 2, ',', '.')?></td>

                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center">Tabla Referente a Proyectos para Modificar</h3>
                        <table id="data-table-default" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Nombre Programación</th>
                                    <th>Objeto de Contratación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_proyectos as $ver_proyecto):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$ver_proyecto['nombre_proyecto']?> </td>
                                    <td><?=$ver_proyecto['desc_objeto_contrata']?> </td>
                                    <td class="center">
                                        <a href="<?php echo base_url();?>index.php/programacion/ver_programacion_proy?id=<?php echo $ver_proyecto['id_p_proyecto'];?>/<?php echo $ver_proyecto['id_programacion'];?>/<?php echo $ver_proyecto['id_obj_comercial'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                        <a/>
                                      
                                        <?php if ($ver_proyecto['estatus'] == 2) : ?>
                                        <a title="Reprogramación" href="<?php echo base_url();?>index.php/programacion/reprogramar_items_py?id=<?php echo $ver_proyecto['id_p_proyecto'];?>/<?php echo $ver_proyecto['id_obj_comercial'];?>/<?php echo $ver_proyecto['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-marker fa-lg"></i>
                                        <a />
                                        
                                        <a onclick="eliminar_acc(<?php echo $ver_proyecto['id_p_proyecto'];?>);" class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"></i><a />
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Tabla Referente a Acción Centralizada Registradas</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Acción Centralizada</th>
                                    <th>Objeto de Contratación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_acc_centralizada as $ver_acc_centralizad):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$ver_acc_centralizad['desc_accion_centralizada']?> </td>
                                    <td><?=$ver_acc_centralizad['desc_objeto_contrata']?> </td>
                                    <td class="center">
                                        <a href="<?php echo base_url();?>index.php/programacion/ver_programacion_acc?id=<?php echo $ver_acc_centralizad['id_p_acc_centralizada'];?>/<?php echo $ver_acc_centralizad['id_programacion'];?>/<?php echo $ver_acc_centralizad['id_obj_comercial'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                        <a/>
                                        <?php if ($ver_acc_centralizad['estatus'] == 2) : ?>
                                        <a title="Reprogramación" href="<?php echo base_url();?>index.php/programacion/reprogramar_items_?id=<?php echo $ver_acc_centralizad['id_p_acc_centralizada'];?>/<?php echo $ver_acc_centralizad['id_obj_comercial'];?>/<?php echo $ver_acc_centralizad['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-marker fa-lg"></i>
                                        <a />
                                        
                                        <a onclick="eliminar_acc(<?php echo $ver_acc_centralizad['id_p_acc_centralizada'];?>);" class="button"><i class="fas fa-lg fa-fw  fa-trash-alt" style="color:red"></i><a />
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary" href="javascript:history.back()"> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bienes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Bien </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="save" name="save" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">

                        <div class="card card-outline-green">
                            <h5 class="mt-3 text-center"><b>Seleccione si desea Cargar Un Bien , Un Servicio o Una
                                    Obra</b></h5>
                            <div class="row ">

                                <div class="col-6 mt-3">
                                    <label>Acción a Cargar</label>
                                    <input id="id_programacion1" name="id_programacion1" type="hidden"
                                        class="form-control">
                                    <select id="acc_cargar" name="acc_cargar" class="select2 form-control"
                                        onclick="llenar_();">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Proyecto</option>
                                        <option value="2">Acción Centralizada</option>
                                    </select>
                                </div>

                                <div class="col-6 mt-3 form-group" id="acc_s" style="display:none;">
                                    <label>Acción Centralizada<b style="color:red">*</b></label><br>
                                    <select class="form-control" name="selec_acc" id="selec_acc">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>

                                <div class="col-6 mt-3 form-group" id="campos" style="display:none;">
                                    <label>Nombre del Proyecto
                                        <b style="color:red">*</b></label><br>
                                    <input id="nombre_proyecto" name="nombre_proyecto" type="text" class="form-control">

                                    </select>
                                </div>

                                <div class="form-group mt-3 col-6">
                                    <label>Objeto de Contratación</label>
                                    <select class="form-control" name="selec_obj" id="selec_obj">
                                        <option value="s">Seleccione</option>
                                    </select>
                                </div>


                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="saves" onclick="save_();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function valideKey(evt){
   var code = (evt.which) ? evt.which : evt.keyCode;
    if(code==8) { // backspace.
        return true;
    }else if(code>=48 && code<=57) { // is a number.
        return true;
    }else{ // other keys.
        return false;
    }
}
</script>
<?php if ($this->session->flashdata('sa-success2')) { ?>
    <div hidden id="sa-success2"> <?= $this->session->flashdata('sa-success2') ?> </div>
<?php } ?>
<script src="<?=base_url()?>/js/eliminar.js"></script>
<script src="<?=base_url()?>/js/programacion/accopy.js"></script>

