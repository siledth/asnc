
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-300">
            <div  class="panel panel-inverse">
                <div class="col-12">
                    <br>

                    <div class="col-20 mt-1">
                        <div class="card card-outline-danger text-center bg-white">
                                <div class="card-block">
                                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                        <img style="width: 100%" height="100%"
                                            src=" <?= base_url() ?>Plantilla/img/loij.png" alt="Card image">
                                    </blockquote>
                                </div>
                            </div>
                    </div>


                    <div class="col-1"></div>
                    <div class="col-300 mt-3">
                        <h3 class="text-center"> Certificaciones Privadas</h3>
                        <table id="data-table-default" data-order='[[ 3, "asc" ]]'
                            class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
								<th>N° Comprobante</th>
                                    <th>Razon Social</th>
                                    <th>Rif</th>
                                    <th>Vigencia</th>
                                    <th>Tipo </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_certi as $datos):?>
                                <tr class="odd gradeX" style="text-align:center">
								    <td><?=$datos['nro_comprobante']?> </td>
                                    <td><?=$datos['nombre']?> </td>
                                    <td><?=$datos['rif_cont']?> </td>
                                    <td><?=date("d/m/Y", strtotime($datos['vigen_cert_desde']));?> 
									al <?=date("d/m/Y", strtotime($datos['vigen_cert_hasta']));?> </td>

                                    <?php if (($datos['tipo_pers'] < 2) ) : ?>
                                    <td>Juridico </td>
                                    <?php endif; ?>
                                    <?php if (($datos['tipo_pers'] > 1) ) : ?>
                                    <td>Persona Nat. </td>
                                    <?php endif; ?>
                                    <td class="center">
                                        <?php if (($datos['status'] == 2) ) : ?>
                                        <a href="<?php echo base_url();?>index.php/pdf?id=<?php echo $datos['id'];?>"
                                            class="button">
                                            <i class='fas fa-align-justify'> </i>
                                            <a />
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

                    
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function valideKey(evt) {
    var code = (evt.which) ? evt.which : evt.keyCode;
    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        return false;
    }
}
</script>