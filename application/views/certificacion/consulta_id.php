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
                                    <img style="width: 100%" height="100%" src=" <?= base_url() ?>Plantilla/img/loij.png"
                                alt="Card image">
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <?php foreach($inf_1 as $inf_1):?><?php endforeach;?>
                            <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h4 style="color:red;">FICHA TÉCNICA DE CERTIFICACIÓN PARA PERSONA NATURAL Y JURÍDICA DE CARÁCTER PRIVADO<br></h4>
                            <h6 style="color:red;">INFORMACIÓN DE LA PERSONA JURÍDICA</h6>
                            
                        </div>
                            
                        <div class="col-5 mt-1 form-group">
                            <label>N° de Comprobante Registro Unico</label>
                            <input value="<?=$inf_1['nro_comprobante']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-3">
                            <label>Registro de Información Fiscal (RIF)</label>
                            <input value="<?=$inf_1['rif_cont']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-5">
                            <label>Razón Social</label>
                            <input value="<?=$inf_1['nombre']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-5">
                            <label>N° de Comprobante del Registro Nacional de Contratistas (RNC)</label>
                            <input value="<?=$inf_1['n_certif']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">Fecha solicitud</label>
                            <input value="<?=date("d/m/Y", strtotime($inf_1['fecha_solic']));?>" type="text"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-3">
                            <label style="color:red;">Banco Emisor</label>
                            <input value="<?=$inf_1['banco_e']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-3">
                            <label style="color:red;">Banco Receptor</label>
                            <input value="<?=$inf_1['banco_rec']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">Fecha de Trasferencia</label>
                            <input value="<?=date("d/m/Y", strtotime($inf_1['fecha_trans']));?>" type="text"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-1">
                            <label style="color:red;">Bolivares Cancelar</label>
                            <input value="<?=$inf_1['total_bss']?>" type="text" class="form-control" disabled>
                        </div>

                        <div class="form-group mt-1  col-1">
                            <label style="color:red;">Monto transferido</label>
                            <input value="<?=$inf_1['monto_trans']?>" type="text" class="form-control" disabled>
                        </div>

                        <div class="form-group mt-1  col-1">
                            <label style="color:red;">N° de Referencia</label>
                            <input value="<?=$inf_1['n_ref']?>" type="text" class="form-control" disabled>
                        </div>

                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;">PROGRAMA DEL CURSO O TALLER</h6>
                        </div>
                        <div class="form-group mt-0  col-9">
                            <label>Objetivo</label>
                            <input value="<?=$inf_1['objetivo']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-0  col-9">
                            <label>Contenido Programático</label>
                            <input value="<?=$inf_1['cont_prog']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;">Experiencia de la Empresa en Capacitación en Materias Relacionadas
                                Con Contratación Pública (en los últimos 5 años)</h6>
                        </div>
                        <div class="col-11" style="margin-left: 40px;">
                            <div class="table-responsive mt-3">

                                <table id="target_ff" class="table table-bordered table-hover">
                                    <thead style="background:#e4e7e8;">
                                        <tr class="text-center">
                                            <th>Órgano/Ente/Institución/Empresa</th>
                                            <th>Actividad</th>
                                            <th>Desde</th>
                                            <th>Hasta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($inf_2 as $inf_2):?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td><?=$inf_2['organo_experi_empre_capa']?></td>
                                            <td><?=$inf_2['actividad_experi_empre_capa']?></td>
                                            <td><?=$inf_2['desde_experi_empre_capa']?></td>
                                            <td><?=$inf_2['hasta_experi_empre_capa']?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;"> Experiencia de la Empresa en Capacitación en Comisión de
                                Contrataciones (en los últimos 3 años)</h6>
                        </div>
                        <table id="target_req" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8;">
                                <tr class="text-center">
                                    <th>Órgano/Ente/Institución/Empresa</th>
                                    <th>Actividad</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inf_3 as $inf_3):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$inf_3['organo_expe']?></td>
                                    <td><?=$inf_3['actividad_exp']?></td>
                                    <td><?=$inf_3['desde_exp']?></td>
                                    <td><?=$inf_3['hasta_exp']?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;"> INFORMACIÓN DE LA PERSONA NATURAL (que dicta la capacitación)</h6>
                        </div>
                        <table id="target_req" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8;">
                                <tr class="text-center">
                                    <th>Nombres y Apellidos</th>
                                    <th>N.º. Cédula de Identidad.</th>
                                    <th>N.º. RIF</th>
                                    <th>Monto a cancelar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inf_4 as $inf_4):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$inf_4['nombre_ape']?></td>
                                    <td><?=$inf_4['cedula']?></td>
                                    <td><?=$inf_4['rif']?></td>
                                    <td><?=$inf_4['total_final']?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;"> Información de la Formación Profesional</h6>
                        </div>
                        <table id="target_req" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8;">
                                <tr class="text-center">
                                    <th>Formación Académica</th>
                                    <th>Título Obtenido</th>
                                    <th>Año de Inicio</th>
                                    <th>Culminación</th>
                                    <th>En Curso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inf_5 as $inf_5):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$inf_5['for_academica']?></td>
                                    <td><?=$inf_5['titulo']?></td>
                                    <td><?=$inf_5['ano']?></td>
                                    <td><?=$inf_5['culminacion']?></td>
                                    <td><?=$inf_5['curso']?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;"> Formación en Materia de Contratación Pública</h6>
                        </div>
                        <table id="target_req" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8;">
                                <tr class="text-center">
                                    <th>Taller o Curso</th>
                                    <th>Institución</th>
                                    <th>Horas de Duración</th>
                                    <th>N.º del Certificado</th>
                                    <th>Fecha Certificado</th>
                                    <th>Vigencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inf_6 as $inf_6):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$inf_6['taller']?></td>
                                    <td><?=$inf_6['institucion']?></td>
                                    <td><?=$inf_6['hor_dura']?></td>
                                    <td><?=$inf_6['certi']?></td>
                                    <td><?=$inf_6['fech_cert']?></td>
                                    <td>
                                        <?php if ($inf_6['vigencia'] == 2)  : ?>
                                        <?=$inf_6['vigencia']?>
                                        <?php endif; ?>

                                        <?php if ($inf_6['vigencia'] > 2)  : ?>
                                        <h5 style="color:red;"> <?=$inf_6['vigencia']?> </h5>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                        <div class="col-12 mt-5 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;"> Experiencia de Participación en Comisiones de Contrataciones (en los últimos 10 años)</h6>
                        </div>
                        <table id="target_req" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8;">
                                <tr class="text-center">
                                    <th>Órgano/Ente/Institución/Empresa</th>
                                    <th>Acto Administrativo de Designación</th>
                                    <th>N° del Acto</th>
                                    <th>Fecha</th>
                                    <th>Área</th>
                                    <th>Duración en la Comisión</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inf_7 as $inf_7):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$inf_7['organo10']?></td>
                                    <td><?=$inf_7['act_adminis_desid']?></td>
                                    <td><?=$inf_7['n_acto']?></td>
                                    <td><?=$inf_7['fecha_act']?></td>
                                    <td><?=$inf_7['area_10']?></td>
                                    <td><?=$inf_7['dura_comi']?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;">Experiencia en Dictado de Capacitación en Materia de Comisión de Contrataciones (en los últimos 3 años)</h6>
                        </div>
                        <table id="target_req" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8;">
                                <tr class="text-center">
                                    <th>Órgano o Ente de la Comisión de Contrataciones</th>
                                    <th>Actividad.</th>
                                    <th>Desde.</th>
                                    <th>Hasta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inf_8 as $inf_8):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$inf_8['organo3']?></td>
                                    <td><?=$inf_8['actividad3']?></td>
                                    <td><?=$inf_8['desde3']?></td>
                                    <td><?=$inf_8['hasta3']?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>

                </div>
                <!--////////////////////////////SEGUNDA PARTE DE LA CARGA -->


            </div>
        </div>
        <div class="col 12 text-center">
            <button class="btn btn-default mt-1 mb-1" type="button" id="print" onclick="printContent('imp1');">Imprimir
            </button>
        </div>
        <div class="col-12 text-center mt-3">
            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-grey"
                href="javascript:history.back()"> Volver</a>
        </div>
    </div>
</div>
</div>
<script>
function printContent(imp1) {
    var restorepage = $('body').html();
    var printcontent = $('#' + imp1).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
}
</script>