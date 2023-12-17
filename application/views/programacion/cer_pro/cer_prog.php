<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>COMPROBANTE DE CUMPLIMIENTO</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                        <p class="f-s-18 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                        <p class="f-s-16">RIF.: <?=$rif?> <br>
                            Código ONAPRE: <?=$codigo_onapre?><br>
                            Programaciòn : <?=$id_programacion?> <br>


                            <!-- <input type="hidden" name="fecha_est" id="fecha_est" value=""> -->
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">

                <form class="form-horizontal" id="guardar_tcu" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                            <div class="form-group col-2">
                            <input type="hidden" id="id_programacion" name="id_programacion"
                                    value="<?=$id_programacion?>" class="sinborde" readonly>
                                    <input type="hidden" id="rif" name="rif"
                                    value="<?=$rif?>" class="sinborde" readonly>

                                <label>ACTIVIDAD</label><br>
                                <?php foreach($toal_objeto as $inf_1_acc):?>
                                <input type="text" id="objeto_acc" name="objeto_acc"
                                    value="<?=$inf_1_acc['desc_objeto_contrata']?>" class="sinborde" readonly>
                                <?php endforeach;?>
                            </div>
                            
                            <div class="form-group col-4">
                                <label>ACCIÓN CENTRALIZADA Bs.</label><br>
                                <?php foreach($toal_objeto2 as $inf_1_acc1):?>
                                <input type="text" id="objeto_acc" name="objeto_acc"
                                    value="<?=number_format($inf_1_acc1['precio_total'], 2, ",", ".")?>" class="sinborde" readonly><br>
                                <?php endforeach;?>
                                
                                <?php foreach($toal_objeto as $key):  //otro
                                $sueldo = $sueldo+$key['precio_total']; ?>

                                <?php endforeach;?>
                               <?php $p= $sueldo?>

                            </div>
                            <div class="form-group col-2">
                                <label>%<b style="color:red"><br></b></label><br>
                                <?php foreach($toal_objeto1 as $key):
                             //   $sueldo = $sueldo+$key['precio_total'];
                                $sueldoT = ($key['precio_total'] / $p) *100?>
                                <input id="porcentaje_acc"  name="porcentaje_acc" value="<?=number_format($sueldoT, 2, ",", ".")?>"  type="text" class="sinborde" readonly>

                                <?php endforeach;?>


                            </div>
                            <div class="form-group col-2">
                                <label>PROYECTOS BS.<b style="color:red">*</b></label>
                                <?php foreach($total_py1 as $py):?>
                                    <input type="text" id="precio_py" name="precio_py" class="sinborde"
                                    value="<?=number_format($py['precio_total'], 2, ",", ".")?>"  readonly>
                                <?php endforeach;?>
                                
                                <?php foreach($total_py1 as $key1): //proyecto
                                $proyecto = $proyecto+$key1['precio_total']; ?>

                                <?php endforeach;?>
                               <?php $pyt= $proyecto?>

                            </div>
                            <div class="form-group col-2">
                                <label>%<b style="color:red">*</b></label>
                                <?php foreach($total_py1 as $ke):
                             //   $sueldo = $sueldo+$key['precio_total'];
                                $pyt_ = ($ke['precio_total'] / $pyt) *100?>
                                <input id="porcenta_py"  name="porcenta_py" value="<?=number_format($pyt_, 2, ",", ".")?>"  type="text" class="sinborde" readonly>

                                <?php endforeach;?>

                            </div>
                            <div class="form-group col-3">
                                <label><b style="color:white">__________________</b></label>
                                

                            </div>
                            <div class="form-group col-3">
                                <label>Total<b style="color:red">*</b></label>
                                
                                <input id="total_acc" name="total_acc"   value="<?=number_format($sueldo, 2, ",", ".")?>"type="text" class="sinborde">

                            </div>
                            <div class="form-group col-2">
                                <label><b style="color:white">__________________</b></label>
                                

                            </div>
                            <div class="form-group col-3">
                                <label>Total<b style="color:red">*</b></label>
                                
                                <input id="total_py" name="total_py"   value="<?=number_format($pyt, 2, ",", ".")?>"type="text" class="sinborde">

                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_comprobante();" id="guardar" name="guardar"
                            class="btn btn-primary mb-3">Generar PDF</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
    <script src="<?=base_url()?>/js/bien/comprobante.js"></script>
