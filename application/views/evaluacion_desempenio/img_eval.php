<style media="screen">
@media print {

    .non-printable,
    .fancybox-outer {
        display: none;
    }

    .printable,
    #printDiv {
        display: block;
        font-size: 26pt;
    }
} 
</style>
<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-3 mb-3">
            <a class="my-button"
                href="javascript:history.back()"> Volver</a>
        </div>
     
        <div class="col-lg-12" id="imp1">
            <div class="col-12 text-center">
                <img class="mb-2" src="<?php echo base_url('Plantilla/img/membretesnc.png'); ?>" height="70" />
            </div>

            <div class="panel panel-inverse">   
               
                <?php if ($eval_ind['snc'] == 1): ?>
              
                <div class="panel-body" style="padding: 0px;">
                    <div class="row" style="margin-bottom: -23px;">
                        <div class="form-group col-6">
                            <h5><b>Fecha de la Notificación:</b></h5>
                            <h5><?=$eval_ind['fecha_not']?></h5>
                        </div>
                        <div class="form-group col-6">
                            <h5><b>Medio de envio de la Notificación:</b></h5>
                            <?php if ($eval_ind['medio'] == 1): ?>
                            <div>
                                <h5>FAX</h5>
                            </div>
                            <?php endif; ?>
                            <?php if ($eval_ind['medio'] == 2): ?>
                            <div>
                                <h5>Correo Electronico</h5>
                            </div>
                            <?php endif; ?>
                            <?php if ($eval_ind['medio'] == 3): ?>
                            <div>
                                <h5>Oficio / Memo / Notificación</h5>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-6">
                            <h5><b>Nro. de Oficio / Fax / Correo Electronico / Otro:</b></h5>
                            <h5><?=$eval_ind['nro_oc_os']?></h5>
                        </div>
                        
                        
                        <?php if ($eval_ind['fileimagen'] == 'N'){ ?>
                            <h5><b>Acuse de Recibido: Error Imagen dañada</b></h5>
                      
                         <?php  }else { ?>
			 
		           
                            <div class="form-group col-12">
                            <h5><b>Acuse de Recibido</b></h5>
                            <?php if ($tipo_img == 'pdf'): ?>
                            <div class="image-inner">
                                <embed type="application/pdf" style="width: 100%; height: 400px;" src="<?=base_url()?>imagenes/<?=$eval_ind['fileimagen'] ?>">
                            </div>
                            <?php endif; ?>
                            <?php if ($tipo_img != 'pdf'): ?>
                            <div class="image-inner">
        						<a href="<?=base_url()?>imagenes/<?=$eval_ind['fileimagen'] ?>" data-lightbox="gallery-group-1">
        							<img style="width: 200px;" height="100" src="<?=base_url()?>imagenes/<?=$eval_ind['fileimagen'] ?>" alt="" />
        						</a>
        					</div>
                          
                            <?php endif; ?>
                            <br><br> <br><br> <br><br> <br><br> <br><br>
                        </div>
                        <?php   }?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
function printContents(imp1) {
    let printElement = document.getElementById(imp1);
    var printWindow = window.open('', 'PRINT');
    printWindow.document.write(document.documentElement.innerHTML);
    setTimeout(() => { // Needed for large documents
        printWindow.document.body.style.margin = '0 0';
        printWindow.document.body.innerHTML = printElement.outerHTML;
        printWindow.document.close(); // necessary for IE >= 10
        printWindow.focus(); // necessary for IE >= 10*/
        printWindow.print();
        printWindow.close();
    }, 1000)
}
</script>