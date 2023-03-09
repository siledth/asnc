<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-1 mb-3">
                <a class="btn btn-circle waves-effect  waves-circle waves-float btn-primary"
                    href="javascript:history.back()"> Volver</a>
            </div>
            <div class="col-1 mb-3">
                <button class="btn btn-circle waves-effect waves-circle waves-float btn-primary" type="submit"
                    onclick="printDiv('areaImprimir');" name="action">Imprimir</button>
            </div>
        </div>
        <div class="row" id="imp1">
            <div class="panel panel-inverse">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-1">

                        </div>
                        <div class="col-1"></div>
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <img style="width: 100%" height="100%"
                                        src=" <?= base_url() ?>Plantilla/img/loij.png" alt="Card image">
                                </blockquote>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>

                        <div class="col-2 text-center">


                            <img style="width: 100%" height="100%"
                                src=" <?= base_url() ?>assets/img/qrcode/<?=$inf_pdf['qrcode_path']?>" alt="Card image">
                        </div>
                        <div class="col-10 text-center">

                            <h2> REGISTRO ÚNICO DE PERSONAS<br>
                                NATURALES Y JURÍDICAS DE CARÁCTER<br>
                                PRIVADO </h2> <br>

                        </div>
                        <div class="col-12 text-center">
                            <h4> Esta Dirección de Capacitación de Contrataciones Públicas, certifica que el
                                Contratista detallado a continuación de conformidad a los criterios técnicos emitidos
                                por el Servicio Nacional de Contrataciones (SNC), se encuentra acreditado para
                                impartir los programas, cursos y talleres en materia de Comisión de Contrataciones
                                Públicas:</h4> <br>

                            <?php if   (($inf_pdf['tipo_pers'] == 1 )  ): ?>
                            <h4>INFORMACIÓN DE LA PERSONA JURÍDICA</h4>


                            <?php else: ?>
                            <h4>INFORMACIÓN DE LA PERSONA NATURAL <br> FACILITADOR(A)</h4>
                            <?php endif; ?>

                        </div>
                        <div class="col-12 mt-4">
                            <table BORDER=10 id="data-table" class="table table-striped " style="font-size:18px "
                                padding: 0;>
                                <thead>
                                    <tr>
                                        <?php if   (($inf_pdf['tipo_pers'] == 1 )  ): ?>
                                        <th style="text-align:right">Razón Social:</th>
                                        <th><?=$inf_pdf['nombre']?></th>

                                        <?php else: ?>
                                        <th style="text-align:right">Nombres Y Apellido</th>
                                        <th><?=$inf_pdf['nombre_ape']?> </th>
                                        <?php endif;  ?>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php if (($inf_pdf['tipo_pers'] > 1) ) : ?>
                                    <tr>
                                        <th style="text-align:right"> Cédula de Identidad:</th>
                                        <th> <?=$inf_pdf['cedula']?> </th>

                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th style="text-align:right">Número de Identificación Fiscal RIF:</th>
                                        <th><?=$inf_pdf['rif_cont']?></th>

                                    </tr>

                                    <tr>
                                        <th style="text-align:right">N° de Certificado Registro <br>Nacional de
                                            Contratista RNC:</th>
                                            <?php if (($inf_pdf['status'] == 2) ) : ?>
                                        <th><?=$inf_pdf['n_certif']?></th>
                                        <?php else: ?>
                                        <th style="color:red;">RECHAZADO</th>
                                        
                                        <?php endif;  ?>
                                    </tr>
                                    <tr>
                                        <th style="text-align:right">N° de Comprobante Registro:</th>
                                        <?php if (($inf_pdf['status'] == 2) ) : ?>
                                        <th><?=$inf_pdf['nro_comprobante']?></th>
                                        <?php else: ?>
                                        <th style="color:red;">RECHAZADO. Por Favor contacte a un analista</th>
                                        
                                        <?php endif;  ?>
                                    </tr>
                                    <tr>
                                   
                                        <th style="text-align:right">Vigencia de la Certificación</th>
                                        <?php if (($inf_pdf['status'] == 2) ) : ?>
                                        <th>Desde <?=date("d/m/Y", strtotime($inf_pdf['vigen_cert_desde']));?> / Hasta
                                            <?=date("d/m/Y", strtotime($inf_pdf['vigen_cert_hasta']));?> </th>

                                            <?php else: ?>
                                        <th style="color:red;">RECHAZADO</th>
                                        
                                        <?php endif;  ?>
                                    </tr>
                                    <?php if (($inf_pdf['tipo_pers'] < 2) ) : ?>
                                    <td style="text-align:center" colspan="2"> INFORMACIÓN DEL FACILITADOR(A)</td>
                                    <tr>
                                        <th style="text-align:right">Nombres Y Apellido</th>
                                        <th><?=$inf_pdf['nombre_ape']?> </th>

                                    </tr>
                                    <tr>
                                        <th style="text-align:right"> Cédula de Identidad:</th>
                                        <th> <?=$inf_pdf['cedula']?> </th>

                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <br><br><br>
                            <div class="col-12 text-center">
                                <h5> <b>Neudys Nahir Inojosa Rios </b>
                                    <h4>Directora Adjunta de la Dirección General </h4>
                                    Según Providencias N° DG/2018/033 de fecha 28 de diciembre de 2018 y<br>
                                    N° DG/2019/003 de fecha 15 de enero de 2019, publicadas en<br>
                                    la Gaceta Oficial de la República Bolivariana de Venezuela N° 41.562<br>
                                    de fecha 11 de enero de 2019 y N° 41.589 de fecha 19 de febrero de 2019
                                </h5>
                            </div>
                            <div class="col-12 text-right">
                            
                                <div class="form-group col-12">
                                    <label class="col-form-label col-md-6 text-leff"> Fecha de Consulta <?=$time ?>
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    function printDiv(nombreDiv) {
        var contenido = document.getElementById('imp1').innerHTML;
        var contenidoOriginal = document.body.innerHTML;

        document.body.innerHTML = contenido;

        window.print();

        document.body.innerHTML = contenidoOriginal;
    }
    </script>