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


                                </blockquote>
                            </div>
                        </div>
                    </div>



                    <div class="col-12 text-center mt-3">
                        <h3 class="text-center">Contratistas en espera de Revisión</h3>
                        <h6 class="text-center">Se ordena dese el primero al último recibido</h6>

                        <table id="data-table" data-order='[[ 0, "desc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">
                                    <th>Fecha de Registro</th>
                                    <th>Razón Social</th>
                                    <th>Rif</th>
                                    <th>estatus</th>
                                    <th>Tipo</th>
                                    <th>N transacción</th>
                                    <th>Monto bs</th>
                                    <th>Código Autorización</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($read as $lista):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['date_create']?> </td>
                                    <td><?=$lista['nombre']?> </td>
                                    <td><?=$lista['rifced']?> </td>
                                    <td><?=$lista['descedoproc']?> </td>
                                    <td><?=$lista['descrealizando']?> </td>
                                    <td><?=$lista['transactionid']?> </td>
                                    <td><?=$lista['amount']?> </td>
                                    <td><?=$lista['authorizationcode']?> </td>
                                    <!-- <td class="center">


                                        <a href="<?php echo base_url();?>index.php/programacion/ver_programacion_final?id=<?php echo $lista['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-print fa-lg" title="Imprimir" style="color: black;"></i>
                                            <a />


                                            <a href="<?php echo base_url();?>index.php/programacion/read_send?id=<?php echo $lista['id_programacion'];?>"
                                                class="button">
                                                <i class="fas   fa-lg fa-cloud-download-alt"
                                                    title="Descargar Certificado de Cumplimiento ART.38 #1"
                                                    style="color: blue;"></i>
                                                <a />

                                    </td> -->
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