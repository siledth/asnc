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
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <p class="f-s-18 text-inverse f-w-600"> <?=$descripcion?>.</p>
                                    <p class="f-s-16">RIF.: <?=$rif?> <br>


                                </blockquote>
                            </div>
                        </div>
                    </div>
                                     <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center">Anulación de Lamado a Concurso de Organos y Entes del Estado</h3>
                        <table id="data-table-default" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                     <th>Rif</th>
                                     <th>Organo/Ente del Estado</th>
                                    <th>Número de Proceso</th>
                                    <th>Denominación del Proceso</th>
                                    <th> Fecha de Llamado</th>
                                    <th> Estatus</th>
                                    <th> Observaciones</th>
                                    <th> Especificación anulación</th>
                                  
                               
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($llamados as $ver_proyecto):?>
                                <tr class="odd gradeX" style="text-align:center">
                                 
                                   <td><?=$ver_proyecto['rif_organoente']?> </td>
                                   <td><?=$ver_proyecto['descripcion']?> </td>
                                   
                                    <td><?=$ver_proyecto['numero_proceso']?> </td>
                                    <td><?=$ver_proyecto['denominacion_proceso']?> </td>
                                    <td><?=$ver_proyecto['fecha_llamado']?> </td>
                                     
                                    <td><?=$ver_proyecto['estatus']?> </td>
                                    <td><?=$ver_proyecto['observaciones']?> </td>
                                    <td><?=$ver_proyecto['especifique_anulacion']?> </td>
                                    
                                  
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>

                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                            href="javascript:history.back()"> Volver</a>
                    </div>
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
