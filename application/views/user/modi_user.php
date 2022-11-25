<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-inverse">
                <div class="panel-body">
                    <form id="reg_bien" method="POST" class="form-horizontal">
                        <div class="row">
                            <div class="col-12 card card-outline-danger text-center bg-white">
                                <h4 class="mt-2"> <b><?= $descripcion ?></b></h4>
                                <h5>RIF.: <?= $rif ?></h5>
                                <h5>Fecha.: <?= $time ?> </h5>
                            </div>
                            <div class="col-9"></div>
                            

                            <div class="col-md-12">
                                <div class="panel-body">
                                    <div class="col-12 text-center">
                                        <h4>Lista de Usuarios</h4>
                                    </div>

                                    <table id="data-table-default" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th width="15%" class="text-nowrap">Usuario</th>
                                                <th width="25%" class="text-nowrap">Organo/Ente</th>
                                                <th width="20%" class="text-nowrap">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ver_usuarios as $lista) : ?>
                                                <tr class="odd gradeX">
                                              
                                                    <td><?= $lista['nombre'] ?></td>
                                                    <td><?= $lista['descripcion'] ?></td>
                                                    <td>
                                                        <a class="button" href="<?php echo base_url() ?>index.php/User/verUsuario?id=<?php echo $lista['id']; ?>">
                                                            <i title="Ver Usuario" class="fas fa-lg fa-fw fa-eye" style="color: midnightblue;"></i>
                                                        <a />
                                                        
                                                        
                                                        
                                                        <?php //if ($lista['id_status'] != 2) : ?>
                                                            <a onclick="modal(<?php echo $lista['id'] ?>);" data-toggle="modal" data-target="#exampleModal" style="color: white">
                                                                <i title="Modificar" class="fas fa-lg fa-fw  fa-edit" style="color: midnightblue;"></i>
                                                            </a>
                                                        <?php //endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_mod_user" name="guardar_mod_user" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-4">
                            <label>Nombre Funcionario <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="nombrefun" id="nombrefun"  class="form-control" >
                            <input type="hidden" name="id_ver" id="id_ver"  class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Apellido Funcionario</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" >
                        </div>
                        <div class="col-3">
                            <label>Cedula de identidad </label>
                            <input class="form-control" type="text" name="cedula" id="cedula" >
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Correo</label>
                            <input class="form-control" type="text" name="email" id="email" >
                        </div>
                        <div class="form-group col-3">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo" id="cargo" >
                        </div>
                        <div class="form-group col-3">
                            <label>Oficina</label>
                            <input class="form-control" type="text" name="oficina" id="oficina" >
                        </div>
                        <div class="form-group col-3">
                            <label>Teléfono</label>
                            <input class="form-control" type="text" name="tele_1" id="tele_1" >
                        </div>
                        <div class="form-group col-3">
                            <label>Telefono Oficina</label>
                            <input class="form-control" type="text" name="tele_2" id="tele_2"  >
                         
                        </div>  
                    
                    </div>
                   
                   
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_pago_fin" onclick="mod_user();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Pago Adelantado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="guardar_adelanto_pag" data-parsley-validate="true" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-10"></div>
                        <div class="form-group col-3">
                            <label>N° Recib <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <input type="text" name="numfactura" id="numfactura" onkeyup="mayusculas(this);" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Embarcación/Matricula <b title="Campo Obligatorio" style="color:red">*</b></label>
                            <select style="width: 100%;" onclick="trae_inf();" id="matricular" name="matricular" class="form-control" data-show-subtext="true" data-live-search="true">
                                <option value="0">Seleccione</option>
                                <?php foreach ($mat as $data) : ?>
                                    <option value="<?= $data['matricula'] ?>">
                                        <?= $data['matricula'] ?> / <?= $data['nombrebuque'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-8">
                            <label>Nombre</label>
                            <input class="form-control" type="text" name="nombre_a" id="nombre_a" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Pies</label>
                            <input class="form-control" type="text" name="pies_a" id="pies_a" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label></label>
                            <input class="form-control" type="hidden" name="dias_a" id="dias_a" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Tarifa</label>
                            <input class="form-control" type="hidden" name="id_tarifa_a" id="id_tarifa_a" readonly>
                            <input class="form-control" type="text" name="tarifa_a" id="tarifa_a" readonly>
                            <input class="form-control" type="hidden" name="tarifa_a1" id="tarifa_a1" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>Valor Dolar</label>
                            <input class="form-control" type="hidden" name="id_dolar_a" id="id_dolar_a" value="1" readonly>
                            <input class="form-control" type="text" name="dolar_a" id="dolar_a" onchange="calcular_dolar_a();">
                        </div>

                        <div class="form-group col-3">
                            <label>Canon</label>
                            <input class="form-control" type="text" name="canon_a" id="canon_a" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Monto en Bs. F</label>
                            <input class="form-control" type="text" name="bs_a" id="bs_a" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Cantidad a pagar $</label>
                            <input class="form-control" type="text" id="cantidad_pagar_otra_a" name="cantidad_pagar_otra_a" onblur="calcular_dol_a();" onkeypress="return valideKey(event);">
                        </div>
                        <div class="form-group col-3">
                            <label>Cantidad a pagar Bs. F</label>
                            <input class="form-control" type="text" id="cantidad_pagar_bs_a" name="cantidad_pagar_bs_a" onkeypress="return valideKey(event);" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Cantidad restante $</label>
                            <input class="form-control" type="text" id="total_otra_a" name="total_otra_a" readonly>
                        </div>
                        <div class="form-group col-3">
                            <label>Cantidad restante Bs. F</label>
                            <input class="form-control" type="text" id="total_bs_pag_a" name="total_bs_pag_a" readonly>
                        </div>
                        <div class="col-3">
                            <label>Tipo de pago</label>
                            <select class="form-control" name="id_tipo_pago_a" id="id_tipo_pago_a" onclick="llenar_pago_a();">
                                <option value="0">Seleccione</option>
                                <?php foreach ($tipoPago as $data) : ?>
                                    <option value="<?= $data['id_tipo_pago'] ?>"><?= $data['descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" id='campos_a' style="display: none;">
                        <div class="col-4">
                            <label>Banco</label>
                            <select class="form-control" name="id_banco_a" id="id_banco_a">
                                <option value="0">Seleccione</option>
                                <?php foreach ($banco as $data) : ?>
                                    <option value="<?= $data['id_banco'] ?>"><?= $data['codigo_b'] ?> / <?= $data['nombre_b'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-3">
                            <label>Número de referencia:</label>
                            <input class="form-control" type="text" name="nro_referencia_a" id="nro_referencia_a">
                        </div>
                        <div class="col-4">
                            <label>Fecha de Tranferencia:</label>
                            <input class="form-control" type="date" name="fechatrnas_a" id="fechatrnas_a">
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label>Nota</label>
                        <textarea name="nota_a" id="nota_a" rows="5" cols="100"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="guardar_adelanto_pag_b" onclick="guardar_adelanto_pag();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>/js/usuario/usuario.js"></script>

