
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
		<div class="col-lg-12">
            <div  class="panel panel-inverse" >

                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <p class="f-s-16 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                                    <p class="f-s-14">RIF.: <?=$rif?> <br>
                                    Código ONAPRE: <?=$codigo_onapre?></p>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                   
                    <div class="col-3">

                    </div>
                    <div class="col-6 text-center mt-1">
                        <h3 class="text-center">Disponibles para Modificación</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Año de la Programación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_programaciones as $lista):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['anio']?> </td>
                                    <td class="center">
                                        <a href="<?php echo base_url();?>index.php/programacion/consultar_item_reprogramacion?id=<?php echo $lista['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-eye" title="Cargar información de la re-programación"></i>
                                        <a/>
                                        <!-- <a href="<?php echo base_url();?>index.php/programacion/certi_progra?id=<?php echo $lista['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-eye" style="color: green;" title="Cargar información de la re-programación"></i>
                                        <a/> -->
                                        <a title="Imprimir" onclick="enviarreprogramacion(<?php echo $lista['id_programacion'];?>);" class="button">
                                                                <i class="fas fa-lg fa-fw fa-upload" style="color: green;"></i>
                                                            <a/>
                                                 <button
                                                        onclick="location.href='<?php echo base_url()?>index.php/programacion/Llamado_1?id=<?php echo $lista['id_programacion'];?>'"
                                                        type="button" class="fas fa-2x  fa-cloud-download-alt" style="color:blue" name="button"> 
                                                    </button>                 
                                                       
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
