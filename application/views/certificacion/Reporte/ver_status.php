<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-1 mb-3">
            <a class="btn btn-circle waves-effect  waves-circle waves-float btn-primary"
                href="javascript:history.back()"> Volver</a>
        </div>
        <div class="col-1 mb-3">
            <button class="btn btn-circle waves-effect waves-circle waves-float btn-primary" type="submit"
                onclick="printDiv('areaImprimir');" name="action">Imprimir</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="row" id="imp1">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <img style="width: 100%" height="100%"
                                        src=" <?= base_url() ?>Plantilla/img/loij.png" alt="Card image">
                                    
                                </blockquote>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-11 ml-5">
                    <h2 class="mt-2 text-center"> <b>Cerificados Por Estatus</b></h2>
                        <table id="data-table-default"
                            class="table table-striped table-bordered display responsive nowrap" style="width:100%">
                            <thead class="h5 text-center">
                                <tr><th>Denominacion Social</th>
                                    <th>Rif</th>

                                    <th>Nro comprobante</th>
                                    <th>Tipo de Persona</th>
                                    <th>Estatu</th>
                                    <th>Vencimiento</th>
                                </tr>
                            </thead>
                            <tbody class="h5" style="color: black;">
                                <?php if($results != 0){ ?>
                                <?php foreach($results as $result):?>
                                <tr class="odd gradeX" style="text-align:center">
                                <td><?=$result['nombre']?></td>
                                    <td><?=$result['rif_cont']?></td>
                                    
                                    <td><?=$result['nro_comprobante']?> </td>

                                    <?php if (($result['tipo_pers'] < 2) ) : ?>
                                    <td>Juridico </td>
                                    <?php endif; ?>
                                    <?php if (($result['tipo_pers'] > 1) ) : ?>
                                    <td>Persona Nat. </td>
                                    <?php endif; ?>
                                    <?php if   (($result['status'] == 1 )  ): ?>
                                    <td style="color:red;">Pendiente Revisión </td>
                                    <?php elseif   ( $result['status'] == 2 ): ?>
                                    <td>Aprobado</td>

                                    <?php else: ?>
                                    <td style="color:red;">Rechazado</td>
                                    <?php endif; ?>


                                    <td style="color:red;"><?=date("d/m/Y", strtotime($result['vigen_cert_hasta']));?>
                                    </td>
                                    
                                    
                                </tr>
                                <?php endforeach;?>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-1"></div>



                    <div class="col-7"></div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function printDiv(nombreDiv) {
    var contenido = document.getElementById('imp1').innerHTML;
    var contenidoOriginal = document.body.innerHTML;
    document.body.innerHTML = contenido;
    window.print();
    document.body.innerHTML = contenidoOriginal;
}
</script>