<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Miembros de Comisión para Certificar</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">



                        <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">

            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <table id="data-table-default" data-order='[[ 2, "asc" ]]' class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">

                                <th style="color:white;">Cedula</th>
                                <th style="color:white;">Nombre</th>
                                <th style="color:white;">Àrea</th>
                                <th style="color:white;">Tipo integrante</th>




                                <th style="color:white;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ver as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['cedula']?> </td>
                                <td><?=$data['nombre']?> <?=$data['apellido']?></td>
                                <td><?=$data['desc_area_miembro']?> </td>
                                <td><?=$data['desc_tp_miembro']?> </td>

                                <?php if ($data['id_cert'] > 1) : ?>
                                <td><a href="<?php echo base_url();?>index.php/Comision_contrata/miemb_inf?id=<?php echo $data['id_miembros'];?>"
                                                class="button">
                                                <i title="ver Información" class="fas fa-2x fa-fw fa-clipboard-list"
                                                    style="color: black;"></i>
                                                <a /></td>
                                        
                                        <?php else: ?>
                                <td class="center">
                                <a href="<?php echo base_url();?>index.php/Comision_contrata/miemb_inf?id=<?php echo $data['id_miembros'];?>"
                                                class="button">
                                                <i title="ver Información" class="fas fa-2x fa-fw fa-clipboard-list"
                                                    style="color: black;"></i>
                                                <a />
                                    <a onclick="modal(<?php echo $data['id_miembros'] ?>);" data-toggle="modal"
                                        data-target="#dede" style="color: white">
                                        <i title="Información Académica" class="fas fa-2x fa-fw fa-address-card"
                                            style="color: darkblue;"></i>

                                    </a>
                                    <a onclick="modal_(<?php echo $data['id_miembros'] ?>);" data-toggle="modal"
                                        data-target="#exp" style="color: white">
                                        <i title="Experiencia (Últimos 5 años) " class="fas fa-2x fa-business-time"
                                            style="color: red;"></i>

                                    </a>
                                    <a onclick="modal_contrata(<?php echo $data['id_miembros'] ?>);" data-toggle="modal"
                                        data-target="#cont" style="color: white">
                                        <i title=" Capacitación Relacionada con Contrataciones Públicas (35%)" 
                                        class="fas fa-2x far fa-clipboard"  style="color: blue;"></i>

                                    </a>
                                    <a onclick="modal_comis(<?php echo $data['id_miembros'] ?>);" data-toggle="modal"
                                        data-target="#comi" style="color: white">
                                        <i title="  Capacitación en Comisión de Contrataciones (15%)" 
                                        class="fas fa-2x   fas fa-archive"  style="color: green;"></i>

                                    </a>
                                    <a title="Informaciòn Cargada"
                                                    onclick="enviar(<?php echo $data['id_miembros'];?>);"
                                                    class="button">
                                                    <i  class="fas fa-2x  fa-fw fa-check"
                                                    style="color: black;"></i>
                                                    <a />
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




                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b>INFORMACIÓN ACADÉMICA</b></h5>
                                <div class="row ">
                                    <div class="form-group col-4">
                                        <label> Formación Académica <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <select style="width: 100%;" id="fm_ac" name="fm_ac" class="form-control"
                                            data-show-subtext="true" data-live-search="true">
                                            <option value="0">Seleccione</option>
                                            <?php foreach ($carrera as $data) : ?>
                                            <option value="<?= $data['id_academico']?>"><?= $data['desc_academico']?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input class="form-control" type="hidden" name="id_comision" id="id_comision"
                                            readonly>
                                        <input class="form-control" type="hidden" name="rif_organoente2"
                                            id="rif_organoente2" readonly>
                                        <input class="form-control" type="hidden" name="id_miembros" id="id_miembros"
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
    <div class="modal fade" id="exp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Experiencia (Últimos 5 años) Orden Cronológico desde
                        el actual o Último</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="guardar_expe" name="guardar_expe"
                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                        <div class="row">

//


                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b>Experiencias</b></h5>
                                <div class="row ">
                                    <div class="form-group col-6">
                                        <label>  Órgano/Ente/Institución/Empresa <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                                <select style="width: 100%;" id="id_unidad" name="id_unidad" class="form-control" data-show-subtext="true" data-live-search="true">
                                              
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($final as $data):?>
                                    <option value="<?=$data['rif']?>"><?=$data['descripcion']?> / <?=$data['rif']?>
                                    </option>
                                    <?php endforeach;?>
                                </select>
                                        <input class="form-control" type="hidden" name="id_comision3" id="id_comision3"
                                            readonly>
                                        <input class="form-control" type="hidden" name="rif_organoente3"
                                            id="rif_organoente3" readonly>
                                        <input class="form-control" type="hidden" name="id_miembros3" id="id_miembros3"
                                            readonly>


                                    </div>
                                    <div class="form-group col-4">
                                        <label>Area:</label>
                                        <input class="form-control" type="text" name="area" id="area">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>cargo</label>
                                        <input class="form-control" type="text" name="cargo" id="cargo">
                                    </div>



                                    <div class="form-group col-4">
                                        <label>desde:</label>
                                        <input class="form-control" type="date" name="desde" id="desde">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Hasta:</label>
                                        <input class="form-control" type="date" name="hasta" id="hasta">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Actual:</label>
                                        <select name="act" id="act" class="form-control"
                                            data-show-subtext="true" data-live-search="true">
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
                    <button type="button" id="guardar_pago_fin" onclick="save_expe();"
                        class="my-button">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cont" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Capacitación Relacionada con Contrataciones Públicas (35%)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="rendir_py" name="rendir_py"
                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                        <div class="row">




                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b>Capacitación Relacionada con Contrataciones Públicas (35%)</b></h5>
                                <div class="row ">
                                <div class="panel-body">
                                    <div class="row">
                                    <div class="form-group col-12">
                                        <label>Nombre del Curso o Formación Relacionadas con Procedimientos
                                             de Selección, Administración de Contratos o Materias vinculadasa:</label>
                                        <input class="form-control" type="text" name="namecurso" id="namecurso">
                                    </div>
                                        <div class="form-group col-12">
                                            <label>Eingrese Rif Institución donde realizó la Formación<i style="color: red;"
                                                    title="Ingrese el Rif , para continuar."
                                                    class="fas fa-question-circle">Leer*</i></label>
                                            <input class="form-control" type="text" name="rif_b7" id="rif_b7"
                                                onkeypress="may(this);" placeholder="G200024518"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                                onKeyUp="this.value=this.value.toUpperCase();"
                                                onblur="consultar_rif7();validateMaxLength4(this);validateMaxLength3(this)">
                                                <p id="errorMsg3"></p>
                                                <p id="errorMsg4"></p>

                                        </div>

                                    </div>
                                </div>
                                <div class="form-group col-12" id='existe1' style="display: none;">
                                    <label>Es obligatorio Ingresar Rif de la Institución donde realizó la Formación<i style="color: red;"
                                            title="Ingrese el Rif del Contratista"
                                            class="fas fa-question-circle"></i></label>
                                    <div class="row">

                                        <div class="form-group col-3">
                                            <label>Rif Institución donde realizó la Formación</label>
                                            <input class="form-control" type="text" name="sel_rif_nombre7"
                                                id="sel_rif_nombre7"       onblur="validateMaxLength1(this);validateMaxLength2(this)" readonly>
                                                <p id="errorMsg1"></p>
                                                <p id="errorMsg2"></p>
                                        </div>
                                        <div class="form-group col-6">
                                            <label> Denominación o Razón Social</label>
                                            <input type="text" name="nombre_conta_7" id="nombre_conta_7"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12" id='no_existe1' style="display: none;">

                                    <div class="row">
                                        <div class="col-12">
                                            <label>Ingrese Rif de Institución donde realizó la Formación <i style="color: red;"
                                                    title="Ingrese el Rif del contratista, sin guiones ni punto."
                                                    class="fas fa-question-circle"></i></label>
                                                    <h5>Es obligatorio Ingrese el Rif Institución donde realizó la Formación, sin guiones ni punto.</h5>
                                            <input title="Debe ingresar una palabra para realizar la busqueda"
                                                type="text" class="form-control"
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_7" id="rif_7"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-12">
                                            <label>Razón Social <b style="color:red">*</b> </label>
                                            <h5>Es obligatorio Ingresar Institución donde realizó la Formación</h5>
                                            <input id="razon_social7" name="razon_social7" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group col-6">
                                       
                                        <input class="form-control" type="hidden" name="id_comision4" id="id_comision4"
                                            readonly>
                                        <input class="form-control" type="hidden" name="rif_organoente4"
                                            id="rif_organoente4" readonly>
                                        <input class="form-control" type="hidden" name="id_miembros4" id="id_miembros4"
                                            readonly>


                                    </div>
                                   
                                    <div class="form-group col-4">
                                        <label>Horas de Duración</label>
                                        <input class="form-control" type="text" name="horasd" id="horasd">
                                    </div>



                                    <div class="form-group col-4">
                                        <label>Nº del Certificado:</label>
                                        <input class="form-control" type="text" name="ncerti" id="ncerti">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Fecha del Certificado:</label>
                                        <input class="form-control" type="date" name="fcerti" id="fcerti">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Vigencia:</label>
                                        <input class="form-control" type="text" name="vigencia" id="vigencia">

                                    </div>
                                </div>

                            </div>




                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_pago_fin" onclick="rendi_py101();"
                        class="my-button">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="comi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Capacitación en Comisión de Contrataciones (15%)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="rendir_py8" name="rendir_py8"
                        data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                        <div class="row">




                            <div class="card card-outline-danger">
                                <h5 class="mt-0 text-center"><b> Capacitación en Comisión de Contrataciones (15%)</b></h5>
                                <div class="row ">
                                <div class="panel-body">
                                    <div class="row">
                                    <div class="form-group col-12">
                                        <label>Nombre del Taller o Curso de Comisión de Contrataciones:</label>
                                        <input class="form-control" type="text" name="namecurso8" id="namecurso8">
                                    </div>
                                        <div class="form-group col-12">
                                            <label>Eingrese Rif Institución donde realizó la Formación<i style="color: red;"
                                                    title="Ingrese el Rif , para continuar."
                                                    class="fas fa-question-circle">Leer*</i></label>
                                            <input class="form-control" type="text" name="rif_b8" id="rif_b8"
                                                onkeypress="may(this);" placeholder="G200024518"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')"
                                                onKeyUp="this.value=this.value.toUpperCase();"
                                                onblur="consultar_rif8();validateMaxLength8(this);validateMaxLength9(this)">
                                                <p id="errorMsg5"></p>
                                                <p id="errorMsg6"></p>

                                        </div>

                                    </div>
                                </div>
                                <div class="form-group col-12" id='existe8' style="display: none;">
                                    <label>Es obligatorio Ingresar Rif de la Institución donde realizó la Formación<i style="color: red;"
                                            title="Ingrese el Rif del Contratista"
                                            class="fas fa-question-circle"></i></label>
                                    <div class="row">

                                        <div class="form-group col-3">
                                            <label>Rif Institución donde realizó la Formación</label>
                                            <input class="form-control" type="text" name="sel_rif_nombre8"
                                                id="sel_rif_nombre8"       onblur="validateMaxLength10(this);validateMaxLength11(this)" readonly>
                                                <p id="errorMsg7"></p>
                                                <p id="errorMsg8"></p>
                                        </div>
                                        <div class="form-group col-6">
                                            <label> Denominación o Razón Social</label>
                                            <input type="text" name="nombre_conta_8" id="nombre_conta_8"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12" id='no_existe8' style="display: none;">

                                    <div class="row">
                                        <div class="col-12">
                                            <label>Ingrese Rif de Institución donde realizó la Formación <i style="color: red;"
                                                    title="Ingrese el Rif del contratista, sin guiones ni punto."
                                                    class="fas fa-question-circle"></i></label>
                                                    <h5>Es obligatorio Ingrese el Rif Institución donde realizó la Formación, sin guiones ni punto.</h5>
                                            <input title="Debe ingresar una palabra para realizar la busqueda"
                                                type="text" class="form-control"
                                                onKeyUp="this.value=this.value.toUpperCase();" name="rif_8" id="rif_8"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
                                        </div>
                                        <div class="col-12">
                                            <label>Razón Social <b style="color:red">*</b> </label>
                                            <h5>Es obligatorio Ingresar Institución donde realizó la Formación</h5>
                                            <input id="razon_social8" name="razon_social8" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group col-6">
                                       
                                        <input class="form-control" type="hidden" name="id_comision8" id="id_comision8"
                                            readonly>
                                        <input class="form-control" type="hidden" name="rif_organoente8"
                                            id="rif_organoente8" readonly>
                                        <input class="form-control" type="hidden" name="id_miembros8" id="id_miembros8"
                                            readonly>


                                    </div>
                                   
                                    <div class="form-group col-4">
                                        <label>Horas de Duración</label>
                                        <input class="form-control" type="text" name="horasd8" id="horasd8">
                                    </div>



                                    <div class="form-group col-4">
                                        <label>Nº del Certificado:</label>
                                        <input class="form-control" type="text" name="ncerti8" id="ncerti8">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Fecha del Certificado:</label>
                                        <input class="form-control" type="date" name="fcerti8" id="fcerti8">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Vigencia:</label>
                                        <input class="form-control" type="text" name="vigencia8" id="vigencia8">

                                    </div>
                                </div>

                            </div>




                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="button" id="tt" onclick="rendi_py1012();"
                        class="my-button">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>/js/comision/inf_ac.js">
    < script type = "text/javascript" >
        $(document).ready(function() {
            $("#id_miembro4").select2({
                dropdownParent: $("#academico")
            });
        });
    </script>
    <script type="text/javascript">

    $(document).ready(function() {
        $("#id_unidad").select2({
            dropdownParent: $("#guardar_expe")
        });
    });
    </script>