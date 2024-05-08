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
                             
                            </div>
                        </div>
                    </div>
                    
                    <hr style="border-top: 1px solid rgba(0, 0, 0, 0.17);">
                        <div class="col-11" style="margin-left: 40px;">
                            <div class="table-responsive mt-3">
                                <div class="col-12 text-center">
                                    <h4 style="color:red;">Informaciòn academica</h4>
                                </div>
                                <table id="data-table-buttons" class="table table-bordered table-hover">
                                    <thead style="background:#e4e7e8;">
                                        <tr class="text-center">
                                            <th>Nivel Academico</th>
                                            <th>Titulo</th>                                         
                                                <th>Año de inicio</th>
                                                <th>Año Fin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($academico as $data):?>
                                            <tr class="odd gradeX" style="text-align:center">
                                                <td ><?=$data['desc_academico']?></td>
                                                <td><?=$data['titulo']?></td>
                                                <td><?=$data['anio_inicio']?></td>
                                                <td><?=$data['anio_fin']?></td>
                                                                                      

                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-3">
                        <h3 class="text-center"> Experiencia (Últimos 5 años) Orden Cronológico desde el actual o Último</h3>
                        <table id="data-table-default"   class="table table-striped">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Area</th>
                                    <th>Cargo</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($exp5 as $data):?>
                                <tr class="odd gradeX" style="text-align:center">  
                                <td><?=$data['rif']?> </td>
                                    <td><?=$data['areas']?> </td>
                                    <td><?=$data['cargo']?> </td>
                                    <td><?=$data['desde']?> </td>
                                    <td><?=$data['hasta']?> </td>


                                    
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Capacitación Relacionada con Contrataciones Públicas (35%)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Razon social</th>
                                    <th>Nombre del Curso o Formación Relacionadas 
                                        con Procedimientos de Selección, Administración de Contratos o Materias vinculadas</th>
                                    <th>Horas</th>
                                    <th>Nº Cert.</th>
                                    <th>Fecha Certificado</th>
                                    <th>vigencia</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($con_p as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                <?php if ($data['exit_rnc'] = 1) : ?>
                                <td><?=$data['sel_rif_nombre']?> </td>
                                <td><?=$data['nombre_contratista']?> </td>


                                <?php else: ?>
                                    <td><?=$data['rif_contr_no_rnc']?> </td>
                                <td><?=$data['razon_social_no_rnc']?> </td>

                                <?php endif; ?>                      

                                    <td><?=$data['namecurso']?> </td>
                                    <td><?=$data['horas']?> </td>
                                    <td><?=$data['ncertificado']?> </td>
                                    <td><?=$data['fcerti']?> </td>
                                    <td><?=$data['vigencia']?> </td>


                                

                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <hr style=" border-top: 1px solid rgba(0, 0, 0, 0.17);">
                    <div class="col-1"></div>
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <h3 class="text-center">Capacitación en Comisión de Contrataciones (15%)</h3>
                        <table id="data-table-autofill" class="table table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Razon social</th>
                                    <th>Taller o Curso de Comisión de Contrataciones</th>
                                    <th>Horas</th>
                                    <th>Nº Cert.</th>
                                    <th>Fecha Certificado</th>
                                    <th>vigencia</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($con_c as $data):?>
                                <tr class="odd gradeX" style="text-align:center">
                                <?php if ($data['exit_rnc'] == 1) : ?>
                                <td><?=$data['sel_rif_nombre']?> </td>
                                <td><?=$data['nombre_contratista']?> </td>


                                <?php else: ?>
                                    <td><?=$data['rif_contr_no_rnc']?> </td>
                                <td><?=$data['razon_social_no_rnc']?> </td>

                                <?php endif; ?>                      

                                    <td><?=$data['namecurso']?> </td>
                                    <td><?=$data['horas']?> </td>
                                    <td><?=$data['ncertificado']?> </td>
                                    <td><?=$data['fcerti']?> </td>
                                    <td><?=$data['vigencia']?> </td>


                                

                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                            href="javascript:history.back()"> Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



