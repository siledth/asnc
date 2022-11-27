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
                        <div class="col-10 mt-2">
                            <div class="card card-outline-danger text-center bg-white">
                                <h4 class="mt-2"> <b><?=$descripcion?></b></h4>
                                <h4>RIF.: <?=$rif?></h4>
                                <h4>Fecha Impresión: <?=$time ?> </h4>

                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <h4>Detalle Perfiles</h4>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Nombre <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <h5><?=$ver_perfil['nombrep']?> </h5>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Menu RNCE<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <h5>
                                <?php if ($ver_perfil['menu_rnce'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_rnce'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Menu Programación<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <br>
                            <?php if ($ver_perfil['menu_progr'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_progr'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="col-5" style="font-size:20px">
                            <label>Visualizar Menu Evaluación de Desempeño </label>
                            <br>
                            <?php if ($ver_perfil['menu_eval_desem'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_eval_desem'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="col-5" style="font-size:20px">
                            <label>Registrar Evaluación de Desempeño </label>
                            <br>
                            <?php if ($ver_perfil['menu_reg_eval_desem'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_reg_eval_desem'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="col-5" style="font-size:20px">
                            <label>Solicitar Anulación Eval. de Desempeño</label>
                            <br>
                            <?php if ($ver_perfil['menu_soli_anular_eval_desem'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_soli_anular_eval_desem'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="form-group col-5" style="font-size:20px">
                            <label>Procesar Anulación Eval. de Desempeño</label>
                            <br>
                            <?php if ($ver_perfil['menu_proc_anular_eval_desem'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_proc_anular_eval_desem'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="form-group col-5" style="font-size:20px">
                            <label>Comprobante Eval. de Desempeño</label>
                            <br>
                            <?php if ($ver_perfil['menu_comprobante_eval_desem'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_comprobante_eval_desem'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Estadistica Evalua. de Desempeño</label>
                            <?php if ($ver_perfil['menu_estdi_eval_desem'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_estdi_eval_desem'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="form-group col-5" style="font-size:20px">
                            <label>Empresa no Reg. Eval. de Desempeño</label>
                            <br>
                            <?php if ($ver_perfil['menu_noregi_eval_desem'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_noregi_eval_desem'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="form-group col-5" style="font-size:20px">
                            <label>Visualizar Menu Llamado a concurso</label>
                            <br>
                            <?php if ($ver_perfil['menu_llamado'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['menu_llamado'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Consultar Llamado a concurso</label>
                            <br>
                            <?php if ($ver_perfil['consultar_llamado'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['consultar_llamado'] ==  0): ?>
                                No
                                <?php endif; ?>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Registrar Llamado a concurso </label>
                            <br>
                            <?php if ($ver_perfil['reg_llamado'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['reg_llamado'] ==  0): ?>
                                No
                                <?php endif; ?>
                             
                        </div>
                        
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Anulaciones Llamado a concurso</label>
                            <br>
                            <?php if ($ver_perfil['anul_llamado'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['anul_llamado'] ==  0): ?>
                                No
                                <?php endif; ?>
                             
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Ver Anulaciones de Llamado a concurso</label>
                            <?php if ($ver_perfil['ver_anul_llamado'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_anul_llamado'] ==  0): ?>
                                No
                                <?php endif; ?>
                             
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Visualizar Menu RNC</label>
                            <br>
                            <?php if ($ver_perfil['ver_rnc'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_rnc'] ==  0): ?>
                                No
                                <?php endif; ?>
                        
                        </div>
                        
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Visualizar Configuración</label>
                            <br>
                            <?php if ($ver_perfil['ver_conf'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_conf'] ==  0): ?>
                                No
                                <?php endif; ?>
                           
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Visualizar Tablas Parametro</label>
                            <br>
                            <?php if ($ver_perfil['ver_parametro'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_parametro'] ==  0): ?>
                                No
                                <?php endif; ?>
                           
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Visualizar Conf. Publicaciones</label>
                            <br>
                            <?php if ($ver_perfil['ver_conf_publ'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_conf_publ'] ==  0): ?>
                                No
                                <?php endif; ?>
                            
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Menu Usuarios</label>
                            <br>
                            <?php if ($ver_perfil['ver_user'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_user'] ==  0): ?>
                                No
                                <?php endif; ?>
                           
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Usuarios Exter.</label>
                            <br>
                            <?php if ($ver_perfil['ver_user_exter'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_user_exter'] ==  0): ?>
                                No
                                <?php endif; ?>
                            
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Desb. Usuarios</label>
                            <br>
                            <?php if ($ver_perfil['ver_user_desb'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_user_desb'] ==  0): ?>
                                No
                                <?php endif; ?>
                            
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Lista Usuarios</label>
                            <br>
                            <?php if ($ver_perfil['ver_user_lista'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_user_lista'] ==  0): ?>
                                No
                                <?php endif; ?>
                             
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Perfiles Usuarios</label>
                            <br>
                            <?php if ($ver_perfil['ver_user_perfil'] == 1): ?>
                                Si
                                <?php endif; ?>
                                <?php 
                                 if ($ver_perfil['ver_user_perfil'] ==  0): ?>
                                No
                                <?php endif; ?>
                             
                        </div>
                        <div class="col-4"></div>




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