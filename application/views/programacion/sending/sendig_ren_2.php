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


                    <div class="col-3">

                    </div>
                    <div class="col-6 text-center mt-3">
                        <h3 class="text-center">Rendiciones Notificadas Segundo Trimestre</h3>
                        <table id="data-table-autofill" data-order='[[ 0, "desc" ]]' class="table table-bordered">
                            <thead style="background:#01cdb2">
                                <tr class="text-center">
                                    <th>N°</th>

                                    <th>Organo/Ente</th>
                                    <th>Rif</th>
                                    <th>Año de la Programación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($read as $lista):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['id_ainf_enviada']?> </td>

                                    <td><?=$lista['des_unidad']?> </td>
                                    <td><?=$lista['rif']?> </td>
                                    <td><?=$lista['anio']?> </td>
                                    <td class="center">


                                        <a href="<?php echo base_url();?>index.php/Programacion/ver_rendicion_realizadas2?id=<?php echo $lista['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-print fa-lg" title="Imprimir" style="color: black;"></i>
                                            <a />
                                            <a href="<?php echo base_url();?>index.php/programacion/read_send_snc?id=<?php echo $lista['id_ainf_enviada'];?>/<?php echo $lista['id_programacion'];?>"
                                                class="button">
                                                <i class="fas   fa-lg fa-cloud-download-alt" title="Certificado"
                                                    style="color: blue;"></i>
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
</div>


<script src="<?=base_url()?>/js/programacion.js"></script>
<script src="<?=base_url()?>/js/programacion/enviar.js"></script>