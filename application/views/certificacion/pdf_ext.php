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
                            <div class="col-12 mt-2">
                                <table BORDER=10 id="data-table" class="table table-striped " style="font-size:15px">
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
                                        <tr> <?php if (($inf_pdf['tipo_pers'] > 1) ) : ?>
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
                                            <th><?=$inf_pdf['n_certif']?></th>

                                        </tr>
                                        <tr>
                                            <th style="text-align:right">N° de Comprobante Registro:</th>
                                            <th><?=$inf_pdf['nro_comprobante']?></th>

                                        </tr>
                                        <tr>
                                            <th style="text-align:right">Vigencia de la Certificación</th>
                                            <th>Desde <?=date("d/m/Y", strtotime($inf_pdf['vigen_cert_desde']));?> /
                                                Hasta
                                                <?=date("d/m/Y", strtotime($inf_pdf['vigen_cert_hasta']));?> </th>

                                        </tr>
                                        <?php if (($inf_pdf['tipo_pers'] < 2) ) : ?>
                                            <td style="text-align:center" colspan="2"> INFORMACIÓN DEL FACILITADOR(A)</td>
                                    <tr class="text-center">
                                            <th>Nombre y Apellido</th>
                                            <th>Cedula</th>
                                            
                                        </tr>
                                        <?php foreach ($ver_pdfs_2 as $data): ?>
                                        <tr class="text-center">
                                            <th> <?=$data['nombre_ape']?></th>
                                            <th> <?=$data['cedula']?></th>
                                            
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <br><br><br><br><br><br>
                            <div class="col-12 text-center">
                                <h3> <b>Anthoni Camilo Torres </b></h3>
                                    <h4>Director General </h4>
                                    "Resolución CCP/DGCJ N° 001/2014 de fecha 07 de enero de 2014, Publicada <br>
                                         en la Gaceta Oficial de la República Bolivariana de Venezuela <br>
                                                        Nº 40.334 de fecha 15 de enero de 2014."
                                </h5>
                            </div>
                            <div class="col-12 text-right">
                            
                            <div class="form-group col-12">
                                <label class="col-form-label col-md-6 text-leff"> Fecha de Consulta <?=$time ?>
                                </label>

                            </div>
                        </div>
                        <br><br><br>
                            
                            <div class="col-12 mt-5">
                            <FONT SIZE=1>Firma electrónica de datos consultados: <br>
                XaN-cixoSyPa5Kyop8k-Ac7TzWROZ4iUzQmlhcayO9eGIi-9964 <br>
                a132BUqtwdDIIDdT8BxYlAjIsd61Wnsqobpb01742NPUUjM2J21BhdUOcoRd3sZELb8yx5fAw+k5ch8- <br>
                Firmado electrónico por Anthoni Camilo Torres, avalado por la autoridad certificadora Fundación Instituto 
                de Ingeniería, adscrito a SUSCERTE <br>
                La validez del presente certificado debe ser consultado en la dirección electrónica www.snc.gob.ve y se 
                           exhorta a todos los Órganos y Entes del Estado responsables de las contrataciones públicas a imprimir 
                un ejemplar a objeto de ser incorporado al expediente de la contratación o concurso a ejecutar.</FONT>
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