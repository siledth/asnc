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
                        
                        <div class="form-group col-4" style="font-size:20px">
                        <label>Nombre Usuario<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <h5><?=$ver_usuarios['nombre']?> </h5>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Nombre Funcionario<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <h5><?=$ver_usuarios['nombrefun']?> <?=$ver_usuarios['apellido']?></h5>
                        </div>
                        <div class="form-group col-3" style="font-size:20px">
                            <label>Cedula<b title="Campo Obligatorio" style="color:red">*</b></label>
                            <h5><?=$ver_usuarios['cedula']?></h5>
                        </div>
                        
                        <div class="col-12">
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                        </div>
                        <div class="col-12 text-center">
                            <h5 style="color:red;">información Detallada</h5>
                        </div>
                        <div class="col-3" style="font-size:20px">
                            <label>Cargo</label>
                            <h5><b><?=$ver_usuarios['cargo']?></b> </h5>
                        </div>
                        <div class="col-3" style="font-size:20px">
                            <label>Oficina </label>
                            <h5><b><?=$ver_usuarios['oficina']?></b> </h5>
                        </div>
                        <div class="col-3" style="font-size:20px">
                            <label>Telefono</label>
                            <h5><b><?=$ver_usuarios['tele_1']?></b> </h5>
                        </div>
                        <div class="form-group col-2" style="font-size:20px">
                            <label>Telefono 2</label>
                            <h5><b><?=$ver_usuarios['tele_2']?></b> </h5>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Correo</label>
                            <h5><b><?=$ver_usuarios['email']?></b> </h5>
                        </div>
                        <div class="form-group col-4" style="font-size:20px">
                            <label>Organo o Ente</label>
                            <h5><b><?=$ver_usuarios['descripcion']?></b> </h5>
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