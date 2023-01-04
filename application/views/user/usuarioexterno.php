<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Registro de Usuarios </h4>
                </div>
                <div class="panel-body">
                    <form action="<?=base_url()?>index.php/User/savedante" class="form-horizontal"
                        data-parsley-validate="true" name="demo-form" method="POST">
                        <div class="row">
                            <div class="form-group col-3">
                                <label>Perfil <b title="Campo Obligatorio" style="color:red">*</b></label>

                                <select
                                        class="default-select2 form-control <?php  echo form_error('perfil') ? 'is-invalid' : ''; ?>"
                                        id="perfil" name="perfil">
                                        <option value="none" <?php // echo set_select('perfil', 'none', true);?>>-
                                            Seleccione -</option>

                                        <?php foreach ($ver_perfil as $data): ?>

                                        <option value="<?=$data['id_perfil']?>"><?=$data['nombrep']?> </option>
                                        <?php endforeach; ?>
                                    </select>
                            
                                <div class="invalid-feedback">
                                    <?php echo form_error('perfil'); ?>
                                </div>
                            </div>
                            <div class=" col-6 form-group">
                                <label>Seleccione Organo/Ente <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <select id="id_unidad" name="id_unidad" class="default-select2 form-control" required>
                                    <option value="0">Seleccione</option>

                                    <?php foreach ($final as $data): ?>
                                    <option value="<?=$data['codigo']?>/<?=$data['rif']?>"><?=$data['descripcion']?> /
                                        <?=$data['rif']?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="form-group col-6">
                                <label>Nombre completo <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" name="nombrefun" onkeyup="mayusculas(this);"
                                    class="form-control  <?php echo form_error('nombrefun') ? 'is-invalid' : ''; ?>"
                                    placeholder="Nombre completo" onKeyUp="mayus(this);"
                                    value="<?php echo set_value('nombrefun'); ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('nombrefun'); ?>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Apellido Completo <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" name="apellido" onkeyup="mayusculas(this);"
                                    class="form-control  <?php echo form_error('apellido') ? 'is-invalid' : ''; ?>"
                                    placeholder="Nombre completo" onKeyUp="mayus(this);"
                                    value="<?php echo set_value('apellido'); ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('apellido'); ?>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <label> </label>
                                <input type="text" class="form-control" id="tipo_ced" name="tipo_ced" value="V"
                                    readonly />
                            </div>
                            <div class="form-group col-3">
                                <label>Cédula de Identidad <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="cedula" name="cedula"
                                    placeholder="ingrese la Cédula sin punto ni coma"
                                    class="form-control  <?php echo form_error('cedula') ? 'is-invalid' : ''; ?>"
                                    value="<?php echo set_value('cedula'); ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('cedula'); ?>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label>Cargo <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="cargo" name="cargo" placeholder="Cargo"
                                    onkeyup="mayusculas(this);"
                                    class="form-control <?php echo form_error('cargo') ? 'is-invalid' : ''; ?>"
                                    value="<?php echo set_value('cargo'); ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('cargo'); ?>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label>Teléfono <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="tele_1" name="tele_1" placeholder="Teléfono 1"
                                    class="form-control <?php echo form_error('tele_1') ? 'is-invalid' : ''; ?>"
                                    value="<?php echo set_value('tele_1'); ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('tele_1'); ?>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label>Teléfono 2 <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="tele_2" name="tele_2" placeholder="Teléfono 2"
                                    class="form-control <?php echo form_error('tele_2') ? 'is-invalid' : ''; ?>"
                                    value="<?php echo set_value('tele_2'); ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('tele_2'); ?>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label>Oficina <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="oficina" name="oficina" placeholder="oficina"
                                    onkeyup="mayusculas(this);"
                                    class="form-control <?php echo form_error('oficina') ? 'is-invalid' : ''; ?>"
                                    value="<?php echo set_value('oficina'); ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('oficina'); ?>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label>Fecha de Designación <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="date" id="fecha_designacion" name="fecha_designacion"
                                    class="form-control <?php echo form_error('fecha_designacion') ? 'is-invalid' : ''; ?>"
                                    value="<?php echo set_value('fecha_designacion'); ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('fecha_designacion'); ?>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label>Número de la Gaceta o la Resolución: <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="text" id="numero_gaceta" name="numero_gaceta" placeholder="Número gaceta"
                                    onkeyup="mayusculas(this);"
                                    class="form-control <?php echo form_error('numero_gaceta') ? 'is-invalid' : ''; ?>"
                                    value="<?php echo set_value('numero_gaceta'); ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('numero_gaceta'); ?>
                                </div>
                            </div>
                            <div class="form-group col-5">
                                <label>Observaciones: <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="text" id="obser" name="obser" placeholder="Observaciones"
                                    onkeyup="mayusculas(this);"
                                    class="form-control <?php echo form_error('obser') ? 'is-invalid' : ''; ?>"
                                    value="<?php echo set_value('obser'); ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('obser'); ?>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label>Correo Institucional <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" name="email"
                                    class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>"
                                    aria-describedby="emailHelp" placeholder="Correo eléctronico"
                                    value="<?php echo set_value('email'); ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('email'); ?>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Ingrese Un Usuario <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" name="usuario"
                                    class="form-control <?php echo form_error('usuario') ? 'is-invalid' : '';?>"
                                    placeholder="usuario completo" value="<?php echo set_value('usuario');?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('usuario'); ?>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputPassword1">Contraseña <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="password" name="password"
                                    class="form-control <?php echo form_error('password') ? 'is-invalid':'' ; ?>"
                                    placeholder="Contraseña" value="<?php echo set_value('password'); ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('password'); ?>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleInputPassword1">Repite la contraseña <b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="password" name="repeatPassord"
                                    class="form-control <?php echo form_error('repeatPassord') ? 'is-invalid':'' ; ?>"
                                    placeholder="Contraseña" value="">
                                <div class="invalid-feedback">
                                    <?php echo form_error('repeatPassord'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col 12 text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($this->session->flashdata('sa-error')) { ?>
<div hidden id="success"> <?= $this->session->flashdata('success') ?> </div>
<?php } ?>
<script type="text/javascript">
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
<?php if($this->session->flashdata("success")): ?>

Swal.fire({
    icon: 'success',
    title: 'Guardado Con exito',
    text: '<?php echo $this->session->flashdata("success"); ?>',
});
<?php endif; ?>
</script>
<script src="<?=base_url()?>/js/contratista/contratista.js"></script>