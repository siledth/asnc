<link href="<?= base_url() ?>/css/style.css" rel="stylesheet" />
<div id="content" class="1">
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

                    <div class="col-12 text-center mt-1">
                        <h3 class="text-center">Listado de Items Rendidos</h3>
                        <table id="12" class="">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>id</th>
                                    <th>rif</th>
                                    <th>Detalle</th>
                                 


                                    
                                </tr>
                            </thead>
                            <tbody> 
                                <?php foreach($rendir as $lista):?> 
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['id_rendicion']?> </td>
                                    <td><?=$lista['rif_organoente']?> </td>
                                    <td>Partida Presupuestaria :<?=$lista['codigopartida_presupuestaria']?> <?=$lista['desc_partida_presupuestaria']?> <br>
                                   Tipo: <?php if (($lista['id_p_acc'] == 1) ) : ?>
                                        Acción Centralizada    
                                        <?php else: ?>
                                        Proyecto
                                        <?php endif; ?> <br>
                                        CCNU:
                                        <?=$lista['codigo_ccnu']?> <?=$lista['desc_ccnu']?><br>
                                
                                        Especificación: <?=$lista['especificacion']?> <br>
                                       Objeto de contratación: <?=$lista['desc_objeto_contrata']?><br>
                                       desc_accion_centralizada: <?=$lista['desc_accion_centralizada']?><br>
                                
                                
                                
                                
                                
                                
                                
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


