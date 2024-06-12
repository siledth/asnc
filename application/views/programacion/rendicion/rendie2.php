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
                                    <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                                    <p class="f-s-16">RIF.: <?=$rif?> <br>
                                        Código ONAPRE: <?=$codigo_onapre?> <br>
                                        Año: <b><?=$anio?></b></p>
                                    <input type="hidden" id="id_programacion" name="id_programacion"
                                        value="<?=$id_programacion?>">
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="row">
                            <div class="col-4">
                                <!-- <button
                                    onclick="location.href='<?php echo base_url()?>index.php/programacion/consultar_item_rendir_primero?id=<?php echo $id_programacion;?>'"
                                    type="button" class="btn btn-lg btn-default" name="button">
                                    Rendir Primer Trimestre
                                </button> -->

                            </div>
                            <div class="col-4">
                                <button
                                    onclick="location.href='<?php echo base_url()?>index.php/programacion/surrender?id=<?php echo $id_programacion;?>'"
                                    type="button" class="btn btn-lg btn-default" name="button">
                                    Realizar Rendiciones
                                </button>

                            </div>
                            <div class="col-4">
                                <!-- <button
                                    onclick="location.href='<?php echo base_url()?>index.php/Programacion/ver_rendicion_realizadas?id=<?php echo $id_programacion;?>'"
                                    type="button" class="btn btn-lg btn-default" name="button">
                                    Ver items Rendidos 1 er trimestres
                                </button> -->

                            </div>

                        </div>
                    </div>
                    <div class="col-1"></div>

                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-11" style="margin-left: 40px;">
                        <div class="table-responsive mt-3">
                            <div class="col-12 text-center">
                                <h4 style="color:red;">Total Rendido por partida Presupuestaria</h4>
                            </div>
                            <!-- <table id="data-table-default" class="table table-bordered table-hover"> -->
                            <!-- <table id="data-table-buttons" data-order='[[ 0, "desc" ]]' class="table table-bordered"> -->
                            <table id="data-tablepdfpt" data-order='[[ 0, "desc" ]]' class="table table-bordered">

                                <thead style="background:#e4e7e8;">
                                    <tr class="text-center">
                                        <th>Código Part. Presupuestaria</th>
                                        <th>Partida Presupuestaria</th>
                                        <th>Total Rendido Sin iva</th>
                                        <th>Total Rendido con iva</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($totalespartidattt as $totalespartida):?>
                                    <tr class="odd gradeX" style="text-align:center">
                                        <td><?=$totalespartida['codigopartida_presupuestaria']?></td>
                                        <td><?=$totalespartida['desc_partida_presupuestaria']?></td>

                                        <td><?=number_format($totalespartida['precio_rend_ejecu'], 2, ',', '.')?></td>
                                        <td><?=number_format($totalespartida['total_rendi'], 2, ',', '.')?></td>

                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-11" style="margin-left: 40px;">
                            <div class="table-responsive mt-3">
                                <div class="col-12 text-center">
                                    <h4 style="color:red;">Total Programación Anual Por partida Presupuestaria</h4>
                                </div>
                                <table id="data-table-default" data-order='[[ 0, "desc" ]]' class="table table-bordered table-hover">
                                    <thead style="background:#e4e7e8;">
                                        <tr class="text-center">
                                            <th>Código Part. Presupuestaria</th>
                                            <th>Partida Presupuestaria</th>                                         
                                                <th>Total Sin iva</th>
                                                <th>Total con iva</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($totalespartidas as $totalespartidat):?>
                                            <tr class="odd gradeX" style="text-align:center">
                                                <td ><?=$totalespartidat['codigopartida_presupuestaria']?></td>
                                                <td><?=$totalespartidat['desc_partida_presupuestaria']?></td>
                                                <td><?=number_format($totalespartidat['precio_total'], 2, ',', '.')?></td>
                                                <td><?=number_format($totalespartidat['monto_estimado'], 2, ',', '.')?></td>

                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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




<script src="<?=base_url()?>/js/programacion/calculos_rendir.js"></script>


<script src="<?=base_url()?>/js/programacion/rendir2.js"></script>



<script src="<?=base_url()?>/js/eliminar.js"></script>