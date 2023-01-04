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
                  <form action="<?=base_url()?>index.php/User/modi_usua" class="form-horizontal"
                        data-parsley-validate="true" name="demo-form" method="POST">
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

                        <?php foreach($ver_usuarios as $ver):?><?php endforeach;?>
                            <div class="col-6 mt-3 form-group" >
                                 <label>Perfil de Usuario<b style="color:red">*</b></label><br>
                                <select style="width: 100%;"  name="perfil" id="perfil" class="default-select2 form-control">
                                    <option value="<?=$ver['id_perfil']?>"><?=$ver['nombrep']?></option>
                                    <?php foreach ($ver_perfil as $data): ?>
                                    <option value="<?=$data['id_perfil']?>"><?=$data['nombrep']?></option>
                                    <?php endforeach; ?>
                                </select>
                                
                            </div>
                           
                            <div class="form-group mt-3 col-6">
                                <label>Nombres del Funcionario</label><br>
                                <input type="hidden" id="id1" name="id1" value="<?=$ver['id1']?>" class="form-control">
                                <input type="text" id="nombrefun" name="nombrefun" value="<?=$ver['nombrefun']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Apellidos del Funcionario</label><br>
                                <input type="text" id="apellido" name="apellido" value="<?=$ver['apellido']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Cedula del Funcionario</label><br>
                                <input type="text" id="cedula" name="cedula" value="<?=$ver['cedula']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Cargo del Funcionario</label><br>
                                <input type="text" id="cargo" name="cargo" value="<?=$ver['cargo']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Oficina del Funcionario</label><br>
                                <input type="text" id="oficina" name="oficina" value="<?=$ver['oficina']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Telefono del Funcionario</label><br>
                                <input type="text" id="tele_1" name="tele_1" value="<?=$ver['tele_1']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Telefono 2 del Funcionario</label><br>
                                <input type="text" id="tele_2" name="tele_2" value="<?=$ver['tele_2']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Fecha designacion del Funcionario</label><br>
                                <input type="text" id="fecha_designacion" name="fecha_designacion" value="<?=$ver['fecha_designacion']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Número Gaceta del Funcionario</label><br>
                                <input type="text" id="numero_gaceta" name="numero_gaceta" value="<?=$ver['numero_gaceta']?>" class="form-control">
                            </div>
                            <div class="form-group mt-3 col-3">
                                <label>Correo del Funcionario</label><br>
                                <input type="text" id="email" name="email" value="<?=$ver['email']?>" class="form-control">
                            </div>
                           
                        
                        
                       
                       


                        <div class="col-4"></div>

                   

                      
                    </div>
                    <div class="row text-center mt-3">
                            <div class="col-6">
                            <button class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary" type="submit" id="btn_guardar" name="button" >Guardar</button>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                    href="javascript:history.back()"> Volver</a>
                            </div>
                        </div>
                    </form>
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