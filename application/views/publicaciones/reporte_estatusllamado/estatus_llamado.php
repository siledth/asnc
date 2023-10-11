<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                    <h2 class="panel-title">Rif Organo /Ente :<?=$rif?> </h2>
                    <h2 class="panel-title">Historico estatus llamado a concurso </h2>

                </div>
                <?php if   (($rif == 'G200024518') ): ?>

                <div class="panel-body">
                    <form action="<?=base_url()?>index.php/Publicaciones/rp_estatus" class="form-horizontal"
                        data-parsley-validate="true" name="demo-form" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center"> <b>Parametros de Búsqueda</b></h4>
                            </div>
                            <div class="form-group col-6">
                                <label>Seleccione Organo/Ente</label>
                                <div class="col-md-8">
                                    <select id="id_unidad" name="id_unidad" class="default-select2 form-control"
                                        required>
                                        <?php foreach ($final as $data): ?>
                                        <option value="<?=$data['rif']?>"><?=$data['descripcion']?> /
                                            <?=$data['rif']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-2">
                                <label>Fecha de Desde</label>
                                <input type="date" id="desde" name="desde" placeholder="fecha"
                                    class="form-control  <?php echo form_error('desde') ? 'is-invalid' : ''; ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('desde'); ?>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label>Fecha Hasta</label>
                                <input type="date" id="hasta" name="hasta" placeholder="fecha"
                                    class="form-control  <?php echo form_error('hasta') ? 'is-invalid' : ''; ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('hasta'); ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col 12 text-center">
                            <button type="submit" class="btn btn-primary"><i class="ion-search"> </i>Buscar</button>
                        </div>
                    </form>
                </div>
                <?php else: ?>

                <?php endif; ?>
            </div>
            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <table id="data-table-default" data-order='[[ 8, "desc" ]]'
                        class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">
                                <th style="color:white;">Rif</th>
                                <th style="color:white;">Denominación social</th>
                                <th style="color:white;">Num. Proceso</th>
                                <th style="color:white;">Fecha Disp.</th>
                                <th style="color:white;">Estatus</th>
                                <th style="color:white;">Obj. Contr</th>
                                <th style="color:white;">Den.proceso</th>
                                <th style="color:white;">Estado</th>
                                <th style="color:white;">Descargar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($historial as $data):?>
                            <tr class="odd gradeX" style="text-align:center">
                                <td><?=$data['rif_organoente']?> </td>
                                <td><?=$data['organoente']?> </td>
                                <td><?=$data['numero_proceso']?> </td>
                                <td> <?=date("d/m/Y", strtotime($data['formatted_date']));?>
                                </td>

                                <?php if   (($data['estatus'] == 'Prorrogado' )  ): ?>
                                <td style="color:#900C3F;"><b><?=$data['estatus']?></td>
                                <?php elseif   ( $data['estatus'] == 'Suspendido' ): ?>
                                <td style="color:orange;"><?=$data['estatus']?> </td>
                                <?php elseif   ( $data['estatus'] == 'Re-Iniciado' ): ?>
                                <td style="color:#355E3B;"><b><?=$data['estatus']?></b> </td>

                                <?php else: ?>
                                <td style="color:green;"><?=$data['estatus']?></td>
                                <?php endif; ?>



                                <td><?=$data['objeto_contratacion']?> </td>
                                <td><?=$data['denominacion_proceso']?> </td>
                                <td><?=$data['estado']?> </td>

                                <td class="center">
                                    <h6 style="color:white;"><?=$data['fecha_disponible_llamado']?> </h6>

                                    
                                        <a href="<?php echo base_url();?>index.php/Publicaciones/v_estatus_llamado?id=<?php echo $data['id'];?>"
                                            class="button">
                                            <i class="fas fa-2x  fa-cloud-download-alt" style="color: blue;"
                                                title="Descargar"></i>
                                            <a />
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
<script src="<?=base_url()?>/js/publicaciones/repot_estatus.js"></script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-primary print">Imprimir</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body-wrapper">
                <div class="modal-body">
                    <div class="row">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -15px;">
                                    <img style="width: 100%" height="100%"
                                        src=" <?= base_url() ?>Plantilla/img/loij.png" alt="Card image">
                                </blockquote>
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            <h4> Llamado a Concurso </h4>
                        </div>

                        <div class="col-12 text-center">
                            <h6> Datos del Organo o Ente</h6>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="form-group col-3">
                            <label>Rif</label>
                            <input class="form-control" type="text" name="rif_organoente" id="rif_organoente" readonly>
                        </div>
                        <div class="form-group col-8">
                            <label>Denominación social </label>
                            <input type="text" class="form-control" id="organoente" name="organoente" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Siglas</label>
                            <input class="form-control" type="text" name="siglas" id="siglas" readonly>
                        </div>
                        <div class="form-group col-8">
                            <label>Pagina Web</label>
                            <input class="form-control" type="text" name="web_contratante" id="web_contratante"
                                readonly>
                        </div>
                        <div class="col-12 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            <h5> Llamados a Concurso </h5>
                        </div>


                        <div class="form-group col-4">
                            <label>Número de Proceso</label>
                            <input class="form-control" type="text" name="numero_proceso" id="numero_proceso" readonly>
                        </div>
                        <div class="form-group col-8">
                            <label>Denominación del Proceso </label>
                            <textarea class="form-control" id="denominacion_proceso" name="denominacion_proceso"
                                rows="6" cols="80" readonly>  </textarea>
                        </div>

                        <div class="form-group col-4">
                            <label>Fecha de Llamado </label>
                            <input type="text" class="form-control" id="fecha_llamado" name="fecha_llamado" readonly>
                        </div>

                        <div class="form-group col-2">
                            <label>Estatus </label>
                            <input type="text" class="form-control" id="estatus" name="estatus" readonly>
                        </div>
                        <div class="form-group col-8">
                            <label>Descripción de Contratación </label>
                            <textarea class="form-control" id="descripcion_contratacion" name="descripcion_contratacion"
                                rows="15" cols="80" readonly>  </textarea>

                        </div>
                        <div class="col-12 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            <h5> LAPSOS</h5>
                        </div>
                        <div class="form-group col-3">
                            <label>Modalidad </label>
                            <input type="text" class="form-control" id="modalidad" name="modalidad" readonly>
                        </div>
                        <div class="form-group col-5">
                            <label>Mecanismo </label>
                            <input type="text" class="form-control" id="mecanismo" name="mecanismo" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Objeto de Contratación </label>
                            <input type="text" class="form-control" id="objeto_contratacion" name="objeto_contratacion"
                                readonly>
                        </div>
                        <!-- <div class="form-group col-2">
                                        <label>Días hábiles</label>
                                        <input type="text" class="form-control" id="dias_habiles" name="dias_habiles"
                                            readonly>
                                    </div> -->
                        <div class="form-group col-5">
                            <label>Fecha de Disponibilidad</label>
                            <input type="text" class="form-control" id="fecha_disponible_llamado"
                                name="fecha_disponible_llamado" readonly>
                        </div>
                        <div class="form-group col-5">
                            <label>Fecha Fin</label>
                            <input type="text" class="form-control" id="fecha_fin_llamado" name="fecha_fin_llamado"
                                readonly>
                        </div>
                        <br><br><br><br><br><br>
                        <div class="col-12 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            <h5> DIRECCIÓN PARA ADQUISICIÓN DE RETIRO DE PLIEGO</h5>
                        </div>
                        <div class="form-group col-6">
                            <label>Hora desde</label>
                            <input type="text" class="form-control" id="hora_desde" name="hora_desde" readonly>
                        </div>
                        <!-- <div class="form-group col-6">
                                        <label>Hora desde</label>
                                        <input type="text" class="form-control" id="hora_desdes" name="hora_desdes"
                                            readonly>
                                    </div> -->
                        <div class="form-group col-2">
                            <label>Hora hasta</label>
                            <input type="text" class="form-control" id="hora_hasta" name="hora_hasta" readonly>
                        </div>
                        <div class="form-group col-8">
                            <label>Dirección</label>
                            <textarea class="form-control" id="direccion" name="direccion" rows="6" cols="80"
                                readonly>  </textarea>
                        </div>
                        <div class="col-12 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            <h5> PERÍODOS DE ACLARATORIA</h5>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha Inicio de Aclaratoria</label>
                            <input type="text" class="form-control" id="fecha_inicio_aclaratoria"
                                name="fecha_inicio_aclaratoria" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha Fin de Aclaratoria:</label>
                            <input type="text" class="form-control" id="fecha_fin_aclaratoria"
                                name="fecha_fin_aclaratoria" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Fecha Tope</label>
                            <input type="text" class="form-control" id="fecha_tope" name="fecha_tope" readonly>
                        </div>
                        <div class="col-12 text-center">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                            <h5>APERTURA DE SOBRES</h5>
                        </div>
                        <div class="form-group col-2">
                            <label>Fecha de Entrega</label>
                            <input type="text" class="form-control" id="fecha_fin_llamados" name="fecha_fin_llamados"
                                readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Hora Desde:</label>
                            <input type="text" class="form-control" id="hora_desde_sobre" name="hora_desde_sobre"
                                readonly>
                        </div>
                        <div class="form-group col-8">
                            <label>Lugar de Entrega</label>
                            <textarea class="form-control" id="lugar_entrega" name="lugar_entrega" rows="6" cols="80"
                                readonly>  </textarea>
                        </div>
                        <div class="form-group col-12">
                            <label>Dirección</label>
                            <textarea class="form-control" id="direccion_sobre" name="direccion_sobre" rows="6"
                                cols="80" readonly>  </textarea>
                        </div>
                        <div class="form-group col-12">
                            <label>Observaciones</label>

                            <textarea class="form-control" id="observaciones" name="observaciones" rows="6" cols="80"
                                readonly>  </textarea>
                        </div>

                        <div class="form-group col-12">
                            <label>Especificación</label>

                            <textarea class="form-control" id="especifique_anulacion" name="especifique_anulacion"
                                rows="2" cols="80" readonly>  </textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>

            </div>
        </div>
    </div>
</div>