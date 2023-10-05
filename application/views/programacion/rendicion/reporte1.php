<link href="<?= base_url() ?>/css/style.css" rel="stylesheet" />
<div id="content" class="1">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">

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
                    <?php foreach($rendir as $lista):?>
                    <div class="col-6 text-center ">                 
                       
                           
                            <label>Organo Ente</label>
                            <input id="codigopartida_presupuestaria" name="codigopartida_presupuestaria"
                                class="form-control" class="form-control" value="<?=$lista['rif_organoente']?>"
                                readonly>
                            <label>Cod. Partida Presupuestaria</label>
                            <input type="Text"  class="form-control" class="form-control"
                                value="<?=$lista['codigopartida_presupuestaria']?> <?=$lista['desc_partida_presupuestaria']?>"readonly>

                                <label>Fuente Financiamiento</label>
                            <input class="form-control" type="text" name="desc_fuente_financiamiento"
                                id="desc_fuente_financiamiento" value="<?=$lista['especificacion']?>" readonly>
                            
                                <label>Prorcentaje</label>
                            <input class="form-control" type="text" name="porcentaje" id="porcentaje"
                                value="<?=$lista['porcentaje']?>" readonly>
                      
                    </div>
                    <div class="col-6 text-center ">
                   
                       <label>CCNU</label>
                           <input  class="form-control"    value="     <?=$lista['codigo_ccnu']?> <?=$lista['desc_ccnu']?>" readonly>
                           <label>Objeto Contrataciòn</label>
                       
                       <input class="form-control" type="text" value="<?=$lista['desc_objeto_contrata']?>" readonly>
                           <label>Acciòn Centralizada</label>
                       <input class="form-control"  value="<?=$lista['desc_accion_centralizada']?>" readonly>
                       <label>Estado</label>
                       <input class="form-control"  value="<?=$lista['estado']?>" readonly>
                  
               </div>
               <div class="col-12 text-center">
                      <h4 style="color:red;">_____________________________________________________________________________</h4>
                  </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>