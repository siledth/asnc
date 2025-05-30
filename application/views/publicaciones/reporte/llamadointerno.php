<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>llamados a concurso</title>
</head>

<body>
    <section>
        <div class="content">
            <div class="panel-body">
                <div class="col-12 ml-1">
                    <div class="card card-outline-danger text-center bg-white">
                        <div class="card-block">
                            <blockquote class="card-blockquote" style="margin-bottom: -15px;">
                                <img style="width: 100%" height="100%" src=" <?= base_url() ?>Plantilla/img/loij.png"
                                    alt="Card image">
                            </blockquote>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                href="javascript:history.back()"> Volver</a>
                            <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                href="javascript:history.back()"> Regresar</a>
                        </div>

                    </div>

                    <div class="col-12 text-center">
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        <h2> Llamados a Concurso </h2>
                    </div>
                    <!-- application/views/llamado_concurso_view.php -->
                    <div class="col-12 mb-3">
                        <form method="get" action="<?php echo base_url('index.php/Publicaciones/llamadointerno'); ?>">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar..."
                                    value="<?php echo $this->input->get('search'); ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel panel-inverse">
                        <div class="panel-heading"></div>
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr style="text-align:center">
                                        <th style="color:black;">Rif</th>
                                        <th style="color:black;">Denominación social</th>
                                        <th style="color:black;">Num. Proceso</th>
                                        <th style="color:black;">Fecha Disp.</th>
                                        <th style="color:black;">Estatus</th>
                                        <th style="color:black;">Obj. Contr</th>
                                        <th style="color:black;">Den.proceso</th>
                                        <th style="color:black;">Estado</th>
                                        <th style="color:black;">Descargar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($exonerado)): ?>
                                    <?php foreach ($exonerado as $data): ?>
                                    <tr style="text-align:center">
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
                                        <?php elseif   ( $data['estatus'] == 'Terminado_m' ): ?>
                                        <td style="color:#339FFF;"><b><?=$data['estatus']?></b> </td>
                                        <?php elseif   ( $data['estatus'] == 'Finalizado' ): ?>
                                        <td style="color:#0E3DFC;"><b><?=$data['estatus']?></b> </td>
                                        <?php elseif   ( $data['estatus'] == 'Terminado' ): ?>
                                        <td style="color:#01F2FD ;"><b><?=$data['estatus']?></b> </td>
                                        <?php elseif   ( $data['estatus'] == 'Anulado' ): ?>
                                        <td style="color:#FD1401;"><b><?=$data['estatus']?></b> </td>
                                        <?php else: ?>
                                        <td style="color:green;"><?=$data['estatus']?></td>
                                        <?php endif; ?>
                                        <td><?=$data['objeto_contratacion']?> </td>
                                        <td><?=$data['denominacion_proceso']?> </td>
                                        <td><?=$data['estado']?> </td>

                                        <td class="center">
                                            <h6 style="color:white;"><?=$data['fecha_disponible_llamado']?> </h6>
                                            <a class="button">
                                                <!-- <a class="button">
                                                    <i title="Descargar"
                                                        onclick="modal_ver('<?php echo $data['numero_proceso']?>');"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        class="fas fa-2x  fa-cloud-download-alt" style="color:blue"></i>
                                                    <a /> -->
                                                <a href="<?php echo base_url();?>index.php/Llamados_e/pdfrt?rif=<?php echo $data['rif_organoente'];?>&numero=<?php echo $data['numero_proceso'];?>"
                                                    class="button">

                                                    <i class="fas fa-lg fa-cloud-download-alt"
                                                        title="Descargar llamado a concurso" style="color: blue;"></i>

                                                </a>



                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="4" style="text-align:center;">No hay registros disponibles.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- Paginación -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <?php
                                $limit = 10; // Número de registros por página
                                $total_pages = ceil($total_rows / $limit); // Total de páginas
                                $current_page = ($this->uri->segment(3) ? (int)$this->uri->segment(3) / $limit : 0); // Página actual

                                // Enlace a la página anterior
                                if ($current_page > 0): ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="<?php echo base_url('index.php/Publicaciones/llamadointerno/' . (($current_page - 1) * $limit) . '?search=' . $search); ?>">«
                                            Anterior</a>
                                    </li>
                                    <?php endif; ?>

                                    <!-- Mostrar páginas del 1 al 5 -->
                                    <?php for ($i = 0; $i < min(10, $total_pages); $i++): ?>
                                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                        <a class="page-link"
                                            href="<?php echo base_url('index.php/Publicaciones/llamadointerno/'. ($i * $limit) . '?search=' . $search); ?>">
                                            <?= $i + 1 ?>
                                        </a>
                                    </li>
                                    <?php endfor; ?>

                                    <!-- Enlace a la página siguiente si hay más de 5 páginas -->
                                    <?php if ($total_pages > 10): ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="<?php echo base_url('index.php/Publicaciones/llamadointerno/'. (5 * $limit). '?search=' . $search);?>">Siguiente
                                            »</a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>


            </div>

















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
                                        <input class="form-control" type="text" name="rif_organoente"
                                            id="rif_organoente" readonly>
                                    </div>
                                    <div class="form-group col-8">
                                        <label>Denominación social </label>
                                        <input type="text" class="form-control" id="organoente" name="organoente"
                                            readonly>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Siglas</label>
                                        <input class="form-control" type="text" name="siglas" id="siglas" readonly>
                                    </div>
                                    <div class="form-group col-8">
                                        <label>Pagina Web</label>
                                        <input class="form-control" type="text" name="web_contratante"
                                            id="web_contratante" readonly>
                                    </div>
                                    <div class="col-12 text-center">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                        <h5> Llamados a Concurso </h5>
                                    </div>


                                    <div class="form-group col-4">
                                        <label>Número de Proceso</label>
                                        <input class="form-control" type="text" name="numero_proceso"
                                            id="numero_proceso" readonly>
                                    </div>
                                    <div class="form-group col-8">
                                        <label>Denominación del Proceso </label>
                                        <textarea class="form-control" id="denominacion_proceso"
                                            name="denominacion_proceso" rows="6" cols="80" readonly>  </textarea>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Fecha de Llamado </label>
                                        <input type="text" class="form-control" id="fecha_llamado" name="fecha_llamado"
                                            readonly>
                                    </div>

                                    <div class="form-group col-2">
                                        <label>Estatus </label>
                                        <input type="text" class="form-control" id="estatus" name="estatus" readonly>
                                    </div>
                                    <div class="form-group col-8">
                                        <label>Descripción de Contratación </label>
                                        <textarea class="form-control" id="descripcion_contratacion"
                                            name="descripcion_contratacion" rows="15" cols="80" readonly>  </textarea>

                                    </div>
                                    <div class="col-12 text-center">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                        <h5> LAPSOS</h5>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Modalidad </label>
                                        <input type="text" class="form-control" id="modalidad" name="modalidad"
                                            readonly>
                                    </div>
                                    <div class="form-group col-5">
                                        <label>Mecanismo </label>
                                        <input type="text" class="form-control" id="mecanismo" name="mecanismo"
                                            readonly>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Objeto de Contratación </label>
                                        <input type="text" class="form-control" id="objeto_contratacion"
                                            name="objeto_contratacion" readonly>
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
                                        <input type="text" class="form-control" id="fecha_fin_llamado"
                                            name="fecha_fin_llamado" readonly>
                                    </div>
                                    <br><br><br><br><br><br>
                                    <div class="col-12 text-center">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                        <h5> DIRECCIÓN PARA ADQUISICIÓN DE RETIRO DE PLIEGO</h5>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Hora desde</label>
                                        <input type="text" class="form-control" id="hora_desde" name="hora_desde"
                                            readonly>
                                    </div>
                                    <!-- <div class="form-group col-6">
                                        <label>Hora desde</label>
                                        <input type="text" class="form-control" id="hora_desdes" name="hora_desdes"
                                            readonly>
                                    </div> -->
                                    <div class="form-group col-2">
                                        <label>Hora hasta</label>
                                        <input type="text" class="form-control" id="hora_hasta" name="hora_hasta"
                                            readonly>
                                    </div>
                                    <div class="form-group col-8">
                                        <label>Dirección</label>
                                        <textarea class="form-control" id="direccion" name="direccion" rows="6"
                                            cols="80" readonly>  </textarea>
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
                                        <input type="text" class="form-control" id="fecha_tope" name="fecha_tope"
                                            readonly>
                                    </div>
                                    <div class="col-12 text-center">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                        <h5>APERTURA DE SOBRES</h5>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Fecha de Entrega</label>
                                        <input type="text" class="form-control" id="fecha_fin_llamados"
                                            name="fecha_fin_llamados" readonly>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Hora Desde:</label>
                                        <input type="text" class="form-control" id="hora_desde_sobre"
                                            name="hora_desde_sobre" readonly>
                                    </div>
                                    <div class="form-group col-8">
                                        <label>Lugar de Entrega</label>
                                        <textarea class="form-control" id="lugar_entrega" name="lugar_entrega" rows="6"
                                            cols="80" readonly>  </textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Dirección</label>
                                        <textarea class="form-control" id="direccion_sobre" name="direccion_sobre"
                                            rows="6" cols="80" readonly>  </textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Observaciones</label>


                                        <textarea class="form-control" id="observaciones" name="observaciones"
                                            rows="12">  </textarea>

                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="10"
                                            cols="80" readonly>  </textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>Especificación</label>

                                        <textarea class="form-control" id="especifique_anulacion"
                                            name="especifique_anulacion" rows="2" cols="80" readonly>  </textarea>
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
        </div>
    </section>
</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
    integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous">
</script>

<script src="<?=base_url()?>/js/publicaciones/llamado_externo.js"></script>

</html>
<?php if (!$this->session->userdata('session')) { ?>
<style>
.content {
    margin-left: 0;
}
</style>
<?php } ?>