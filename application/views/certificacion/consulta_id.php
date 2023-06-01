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
                        <?php foreach($inf_1 as $inf_1):?><?php endforeach;?>
                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h4 style="color:red;">FICHA TÉCNICA DE CERTIFICACIÓN PARA PERSONA NATURAL Y JURÍDICA DE
                                CARÁCTER PRIVADO<br></h4>
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
                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">Bolivares Cancelar</label>
                            <input value="<?=$inf_1['total_bss']?>" type="text" class="form-control" disabled>
                        </div>

                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">Monto transferido</label>
                            <input value="<?=$inf_1['monto_trans']?>" type="text" class="form-control" disabled>
                        </div>

                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">N° de Referencia</label>
                            <input value="<?=$inf_1['n_ref']?>" type="text" class="form-control" disabled>
                        </div>
                        
                        <?php if   (($inf_1['status'] == 1 )  && $inf_1['revision'] == 1 ): ?>
                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.25);">
                            <h6 style="color:red;">Pago por otra revisión</h6>
                        </div>
                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">Banco Emisor</label>
                            <input value="<?=$inf_1['banco_e2']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">Banco Receptor</label>
                            <input value="<?=$inf_1['banco_rec_2']?>" type="text" class="form-control" disabled>
                        </div>
                      
                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">Bolivares Trasnferidos</label>
                            <input value="<?=$inf_1['pago2']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-2">
                            <label style="color:red;">N° de Referencia</label>
                            <input value="<?=$inf_1['nro_referencia2']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-4">
                            <label style="color:red;">Fecha de la trasferencia</label>
                            <input value="<?=date("d/m/Y", strtotime($inf_1['fechatrnas2']));?>" type="text"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group mt-1  col-4">
                        <label  style="color:red;">Observación</label>
                            <textarea class="form-control" name="h" id="v" rows="8" cols="50"
                            readonly>  <?=$inf_1['motivo_pago_2']?></textarea>

                        </div>
                        <?php else: ?>
                            <?php endif; ?>


                        <?php if   (($inf_1['status'] == 1 )  ): ?>
                        
                        
                            <?php else: ?>
                            
                                <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.25);">
                            <h6 style="color:red;">APROBADO O RECHAZADO POR</h6>
                        </div>
                        <div class="form-group mt-0  col-6">
                        <?php foreach($inf_9 as $inf_9):?>
                            <label>Nombre de Analista</label>
                            <input value="<?=$inf_9['nombrefun']?>,<?=$inf_9['apellido']?>" type="text"
                                class="form-control" disabled>
                                <?php endforeach;?>
                        </div>
                        
                        <div class="form-group mt-0  col-6">
                            <label>Observación</label>
                            <input value="<?=$inf_1['observacion']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-0  col-2">
                            <label>Status</label> <br>
                            <?php if   (($inf_1['status'] == 2 )  ): ?>
                            <label > <h4 style="color:green;">Aprobado </h4></label>
                            <?php elseif   ( $inf_1['status'] == 3 ): ?>
                            <label ><h4 style="color:red;"> Rechazado </h4></label>

                            <?php else: ?>
                     
                            <?php endif; ?>

                        </div>
                        <div class="form-group mt-0  col-2">
                            <label>Fecha de Aprobación o de Rechazo</label>
                            <input value="<?=date("d/m/Y", strtotime($inf_1['fecha_status']));?>" type="text"
                                class="form-control" disabled>
                        </div>
                            <?php endif; ?>
                          
                        
                       
                        
                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.25);">
                            <h6 style="color:red;">PROGRAMA DEL CURSO O TALLER</h6>
                        </div>
                        <div class="form-group mt-0  col-9">
                            <label>Objetivo</label>
                            <input value="<?=$inf_1['objetivo']?>" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-0  col-9">
                            <label>Contenido Programático</label>
                            <textarea class="form-control" name="h" id="v" rows="8" cols="50"
                                                        readonly>  <?=$inf_1['cont_prog']?></textarea>
                        </div>
                        <?php if (($inf_1['tipo_pers'] < 2) ) : ?>
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
                                    <td><?=date("d/m/Y", strtotime($inf_3['desde_exp']));?></td>
                                    <td><?=date("d/m/Y", strtotime($inf_3['hasta_exp']));?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php endif; ?>
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
                                <th>Cedula</th>
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
                                <td><?=$inf_5['cedula']?></td>
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
                                <th>Cedula.</th>
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
                                    <td><?=$inf_6['cedula']?></td>
                                    <td><?=$inf_6['taller']?></td>
                                    <td><?=$inf_6['institucion']?></td>
                                    <td><?=$inf_6['hor_dura']?></td>
                                    <td><?=$inf_6['certi']?></td>
                                    <td><?=date("d/m/Y", strtotime($inf_6['fech_cert']));?></td>
                                    <td>
                                        <?php if ($inf_6['vigencia'] <= 2)  : ?>
                                            <h5 style="color:green;"> <?=$inf_6['vigencia']?>  </h5>
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
                            <h6 style="color:red;"> Experiencia de Participación en Comisiones de Contrataciones (en los
                                últimos 10 años)</h6>
                        </div>
                        <table id="target_req" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8;">
                                <tr class="text-center">
                                   <th>Cedula.</th>
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
                                <td><?=$inf_7['cedula']?></td>
                                    <td><?=$inf_7['organo10']?></td>
                                    <td><?=$inf_7['act_adminis_desid']?></td>
                                    <td><?=$inf_7['n_acto']?></td>
                                    <td><?=date("d/m/Y", strtotime($inf_7['fecha_act']));?></td>
                                    <td><?=$inf_7['area_10']?></td>
                                    <td><?=$inf_7['dura_comi']?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="col-12 mt-0 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <h6 style="color:red;">Experiencia en Dictado de Capacitación en Materia de Comisión de
                                Contrataciones (en los últimos 3 años)</h6>
                        </div>
                        <table id="target_req" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8;">
                                <tr class="text-center">
                                  <th>Cedula.</th>
                                    <th>Órgano o Ente de la Comisión de Contrataciones</th>
                                    <th>Actividad.</th>
                                    <th>Desde.</th>
                                    <th>Hasta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inf_8 as $inf_8):?>
                                <tr class="odd gradeX" style="text-align:center">
                                <td><?=$inf_8['cedula']?></td>
                                    <td><?=$inf_8['organo3']?></td>
                                    <td><?=$inf_8['actividad3']?></td>
                                    <td><?=date("d/m/Y", strtotime($inf_8['desde3']));?></td>
                                    <td><?=date("d/m/Y", strtotime($inf_8['hasta3']));?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>


        <div class="col 12 text-center">
            <?php if (($inf_1['status'] == 1) && $rif_organoente == "G200024518") : ?>
            <a onclick="modal(<?php echo $inf_1['id']?>);" data-toggle="modal" data-target="#exampleModal"
                style="color: white">
                <i title="Aprobar" class="fas fa-4x fa-fw fa-file-import" style="color: crimson;"></i>

            </a>
            <?php elseif (($inf_1['status'] == 3) && $rif_organoente == "G200024518") : ?> 

                <a onclick="modal(<?php echo $inf_1['id']?>);" data-toggle="modal" data-target="#exampleModal"
                style="color: white">
                <i title="Aprobar" class="fas fa-4x fa-fw fa-file-import" style="color: crimson;"></i>

            </a>


            <?php endif; ?>
            <button class="btn btn-default mt-1 mb-1" type="button" id="print" onclick="printContent('imp1');">Imprimir
            </button>

            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-grey"
                href="javascript:history.back()"> Volver</a>
        </div>
        <div class="col-12 text-center mt-3">

        </div>
    </div>
</div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestión de Registro de Certificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_proc_pag" name="guardar_proc_pag" data-parsley-validate="true"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">

                        <div class="form-group col-2">

                            <input class="form-control" type="hidden" name="id_mesualidad_ver" id="id_mesualidad_ver"
                                readonly>
                        </div>
                        <input class="form-control" type="hidden" name="users" id="users" value="<?=$users?>" readonly>


                        <div class="form-group col-4">
                            <label>Razon Social</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Rif</label>
                            <input class="form-control" type="text" name="rif_cont" id="rif_cont" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Seleccione estatus de la certificación <b title="Campo Obligatorio"
                                    style="color:red">*</b></label>

                            <select class=" form-control " id="status" name="status" readonly
                                onchange="cambiarEndDate()">
                                <option value="">Seleccionar</option>

                                <option value="2">Aprobado</option>
                                <option value="3">Rechazado</option>
                            </select>



                        </div>
                        <div class="form-group col-3">

                            <input type="hidden" id="vigen_cert_desde" name="vigen_cert_desde" class="form-control"
                                value="<?=$time?>" />
                            <input type="hidden" id="vigen_cert_hasta" name="vigen_cert_hasta" class="form-control" />

                        </div>
                        <div class="form-group col-3">
                            <label>Observación</label>
                            <textarea name="observacion" id="observacion" rows="5" cols="50"></textarea>
                        </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_pago_fin" onclick="guardar_proc_pago();"
                    class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>



<script src="<?=base_url()?>/js/certificacion/aprobar_certi.js"></script>
<script>
function printContent(imp1) {
    var restorepage = $('body').html();
    var printcontent = $('#' + imp1).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
}
</script>