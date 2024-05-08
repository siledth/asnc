<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1" id="imp1">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10 mt-1">
                            <div class="card card-outline-danger text-center bg-white">
                                <div class="card-block">
                                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                        <img style="width: 100%" height="100%"
                                            src=" <?= base_url() ?>Plantilla/img/loij.png" alt="Card image">
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                            enctype="multipart/form-data">
                            <?php foreach($inf_1 as $inf_1):?><?php endforeach;?>
                            <div class="col-12 mt-0 text-center">
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                                <h4 style="color:red;">FICHA TÉCNICA DE CERTIFICACIÓN PARA PERSONA NATURAL Y JURÍDICA DE
                                    CARÁCTER PRIVADO<br></h4>
                                <h6 style="color:red;">INFORMACIÓN DE LA PERSONA JURÍDICA</h6>

                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>N° de Comprobante Registro Unico</label>
                                    <input value="<?=$inf_1['id']?>" type="hidden" class="form-control">
                                    <input value="<?=$inf_1['nro_comprobante']?>" type="text" class="form-control"
                                    type="text" name="nro_comprobanter" id="nro_comprobanter" readonly>
                                </div>
                                <div class="form-group col-5">
                                    <label>Registro de Información Fiscal (RIF)</label>
                                    <input value="<?=$inf_1['rif_cont']?>" type="text" class="form-control" name="rif_cont" id="rif_cont" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Razón Social</label>
                                    <input value="<?=$inf_1['nombre']?>" type="text" name="nombre" id="nombre" class="form-control" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>N° de Comprobante del Registro Nacional de Contratistas (RNC)</label>
                                    <input value="<?=$inf_1['n_certif']?>"  name="numcertrnc" id="numcertrnc" type="text" class="form-control" readonly>
                                </div>
                            </div>


                            <div class="col-12">
                                <h4 class="panel-title" style="background: #FAE5D3"><b>Experiencia de la Empresa en
                                        Capacitación en Materias Relacionadas Con Contratación Pública (en los ultimos 5
                                        años)</b></h4>
                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            </div>

                            <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Órgano o Ente de la Comisión de Contrataciones <b
                                                    title="Campo Obligatorio" style="color:red">*</b></label>
                                            <i style="color: red;" title="Ingresar nombre de los Organos o Entes a los cuales a prestado servicio
                                                            en los ultimos 5 años" class="fas fa-question-circle"></i>
                                            <input class="form-control" onkeypress="may(this);" type="text"
                                                name="organo_experi_empre_capa" id="organo_experi_empre_capa">

                                        </div>
                                        <div class="form-group col-2">
                                            <label>Actividad<b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <i style="color: red;"
                                                title="grese en que consistio la actividad, Ejemplo: Talleres"
                                                class="fas fa-question-circle"></i>
                                            <input class="form-control" onkeypress="may(this);" type="text" put
                                                class="form-control" type="text" name="actividad_experi_empre_capa"
                                                id="actividad_experi_empre_capa">
                                        </div>
                                        <div class="form-group col-3">
                                            <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" onkeypress="may(this);" type="date"
                                                name="desde_experi_empre_capa" id="desde_experi_empre_capa"
                                                max="<?=$time?>">
                                        </div>
                                        <div class="form-group col-3">
                                            <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" onkeypress="may(this);" type="date"
                                                name="hasta_experi_empre_capa" id="hasta_experi_empre_capa"
                                                max="<?=$time?>">
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group col 12 text-center">
                                    <button type="button" onclick="guardar_b();" id="guardar" name="guardar"
                                        class="btn btn-primary mb-3">Guardar</button>
                                </div>

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
                                            <th>Rif o cedula</th>
                                            <th>Denominacion social</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($exonerado as $data):?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td><?=$data['rif']?> </td>
                                            <td><?=$data['descripcion']?> </td>
                                            <td class="center">

                                                <a class="button"><i
                                                        onclick="eliminar_b(<?php echo $data['id_exonerado']?>);"
                                                        class="fas fa-lg fa-fw fa-trash-alt" style="color:red"></i><a />
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
        </div>
    </div>







    <script src="<?=base_url()?>/js/certificacion/registro_certifi.js"></script>
    <script>
    function printContent(imp1) {
        var restorepage = $('body').html();
        var printcontent = $('#' + imp1).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
    </script>

    <script type="text/javascript">
    function mayusculas(e) {
        e.value = e.value.toUpperCase();
    }
    </script>