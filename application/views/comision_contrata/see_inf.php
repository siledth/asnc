<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                             
                            </div>
                        </div>
                    </div>
                    
                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                        <div class="col-11" style="margin-left: 40px;">
                            <div class="table-responsive mt-3">
                                <div class="col-12 text-center">
                                    <h4 style="color:red;">Informaciòn academica</h4>
                                </div>
                                <table id="data-table-buttons" class="table table-bordered table-hover">
                                    <thead style="background:#e4e7e8;">
                                        <tr class="text-center">
                                            <th>Nivel Academico</th>
                                            <th>Titulo</th>                                         
                                                <th>Año de inicio</th>
                                                <th>Año Fin</th>
                                                <th>Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($academico as $data):?>
                                            <tr class="odd gradeX" style="text-align:center">
                                                <td ><?=$data['desc_academico']?></td>
                                                <td><?=$data['titulo']?></td>
                                                <td><?=$data['anio_inicio']?></td>
                                                <td><?=$data['anio_fin']?></td>
                                                                                      
                                                <td class="center">
                                                <a onclick="modal(<?php echo $data['id_inf_academ'] ?>);" data-toggle="modal"
                                        data-target="#exampleModal" style="color: white">
                                        <i title="Editar" class="fas  fa-lg fa-fw fa-highlighter"
                                            style="color: darkgreen;"></i>
                                    </a>
                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center"> Experiencia (Últimos 5 años) Orden Cronológico desde el actual o Último</h3>
                        <table id="data-table-default"   class="table table-striped">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Area</th>
                                    <th>Cargo</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($exp5 as $data):?>
                                <tr class="odd gradeX" style="text-align:center">  
                                <td><?=$data['rif']?> </td>
                                    <td><?=$data['areas']?> </td>
                                    <td><?=$data['cargo']?> </td>
                                    <td><?=$data['desde']?> </td>
                                    <td><?=$data['hasta']?> </td>


                                    
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Capacitación Relacionada con Contrataciones Públicas (35%)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Razon social</th>
                                    <th>Nombre del Curso o Formación Relacionadas 
                                        con Procedimientos de Selección, Administración de Contratos o Materias vinculadas</th>
                                    <th>Horas</th>
                                    <th>Nº Cert.</th>
                                    <th>Fecha Certificado</th>
                                    <th>vigencia</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($con_p as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                <?php if ($data['exit_rnc'] = 1) : ?>
                                <td><?=$data['sel_rif_nombre']?> </td>
                                <td><?=$data['nombre_contratista']?> </td>


                                <?php else: ?>
                                    <td><?=$data['rif_contr_no_rnc']?> </td>
                                <td><?=$data['razon_social_no_rnc']?> </td>

                                <?php endif; ?>                      

                                    <td><?=$data['namecurso']?> </td>
                                    <td><?=$data['horas']?> </td>
                                    <td><?=$data['ncertificado']?> </td>
                                    <td><?=$data['fcerti']?> </td>
                                    <td><?=$data['vigencia']?> </td>


                                

                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Capacitación en Comisión de Contrataciones (15%)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Razon social</th>
                                    <th>Taller o Curso de Comisión de Contrataciones</th>
                                    <th>Horas</th>
                                    <th>Nº Cert.</th>
                                    <th>Fecha Certificado</th>
                                    <th>vigencia</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($con_c as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                <?php if ($data['exit_rnc'] == 1) : ?>
                                <td><?=$data['sel_rif_nombre']?> </td>
                                <td><?=$data['nombre_contratista']?> </td>


                                <?php else: ?>
                                    <td><?=$data['rif_contr_no_rnc']?> </td>
                                <td><?=$data['razon_social_no_rnc']?> </td>

                                <?php endif; ?>                      

                                    <td><?=$data['namecurso']?> </td>
                                    <td><?=$data['horas']?> </td>
                                    <td><?=$data['ncertificado']?> </td>
                                    <td><?=$data['fcerti']?> </td>
                                    <td><?=$data['vigencia']?> </td>


                                

                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                            href="javascript:history.back()"> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Información academica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag"
                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b>INFORMACIÓN ACADÉMICA</b></h5>
                                <div class="row ">
                                <div class="form-group col-4">
                                        <label>Formación Académica :</label>
                                        <input class="form-control" type="text" name="fm_ac1" id="fm_ac1" readonly>
                                        <input class="form-control" type="text" name="id_academico" id="id_academico" readonly>
                                    </div>
                                    <div class="form-group col-4">
                                    <label> Cambiar Formación Académica <i
                                    title="Si quiere cambiar la Formación Académica, debe seleccionarla en este campo"
                                    class="fas fa-question-circle"></i></label>
                            <select class="form-control" name="camb_id_academico" id="camb_id_academico">
                                <option value="0">Seleccione</option>
                            </select>
                                        <input class="form-control" type="text" name="id_inf_academ" id="id_inf_academ" readonly>
                                        <input class="form-control" type="text" name="id_comision" id="id_comision"
                                            readonly>
                                      
                                        <input class="form-control" type="text" name="id_miembros" id="id_miembros"
                                            readonly>
                                            
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Título Obtenido:</label>
                                        <input class="form-control" type="text" name="titulo" id="titulo">
                                    </div>
                                    <div class="form-group col-4">
                                        <label> Año de Inicio (aaaa)</label>
                                        <input class="form-control" type="text" name="anioi" id="anioi">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Culminación:</label>
                                        <input class="form-control" type="text" name="anioc" id="anioc">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>En Curso:</label>
                                        <select name="curso" id="curso">
                                            <option value="0">Selecciones</option>

                                            <option value="1">No</option>
                                            <option value="2">Si</option>

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
                    <button type="button" id="guardar_pago_fin" onclick="save_inf_ac();"
                        class="my-button">Guardar</button>
                </div>
            </div>
        </div>
</div>



<script src="<?=base_url()?>/js/comision/editar_inf_academica.js"></script>