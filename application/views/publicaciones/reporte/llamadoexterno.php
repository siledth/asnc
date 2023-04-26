<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">

            <div class="col-1 mb-3">
                <button class="btn btn-circle waves-effect waves-circle waves-float btn-primary" type="submit"
                    onclick="printDiv('areaImprimir');" name="action">Imprimir</button>
            </div>
        </div>
        <div class="row" id="imp1">
            <div class="panel panel-inverse">
                <div class="panel-body">
                    
                    <div class="col-lg-12">
                        <div class="panel panel-inverse">
                            <div class="panel-heading"></div>
                            <div class="table-responsive">
                            <table id="data-table-default" data-order='[[ 4, "asc" ]]'
                            class="table table-bordered table-hover">
                                    <thead style="background:#01cdb2">
                                        <tr style="text-align:center">
                                            <th style="color:white;">Rif</th>
                                            <th style="color:white;">Denominación social</th>
                                            <th style="color:white;">Número de Proceso</th>
                                            <th style="color:white;">Fecha de Fin</th>
                                            <th style="color:white;">Estatus</th>
                                            <th style="color:white;">Obj. Contr</th>
                                            <th style="color:white;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($exonerado as $data):?>
                                        <tr class="odd gradeX" style="text-align:center">
                                            <td><?=$data['rif_organoente']?> </td>
                                            <td><?=$data['organoente']?> </td>
                                            <td><?=$data['numero_proceso']?> </td>
                                            <td><?=$data['fecha_fin_llamado']?> </td>
                                            <td><?=$data['estatus']?> </td>
                                            <td><?=$data['objeto_contratacion']?> </td>
                                           
                                            <td class="center">
                                                <a class="button">
                                                    <i title="Editar"
                                                        onclick="modal_ver(<?php echo $data['numero_proceso']?>);"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        class="fas fa-lg fa-fw fa-edit" style="color:green"></i>
                                                    <a />
                                                    <a class="button"><i
                                                            onclick="eliminar_b(<?php echo $data['numero_proceso']?>);"
                                                            class="fas fa-lg fa-fw fa-trash-alt"
                                                            style="color:red"></i><a />
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
            <script src="<?=base_url()?>/js/publicaciones/llamado_externo.js"></script>

            <script type="text/javascript">
            function printDiv(nombreDiv) {
                var contenido = document.getElementById('imp1').innerHTML;
                var contenidoOriginal = document.body.innerHTML;

                document.body.innerHTML = contenido;

                window.print();

                document.body.innerHTML = contenidoOriginal;
            }
            </script>