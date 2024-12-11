<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registros Organo</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Órgano Perteneciente</label>
                                <select id="id_organoads" name="id_organoads" class="default-select2 form-control">
                                    <option value="0">Órgano Padre</option>
                                    <?php foreach ($organismos as $data): ?>
                                    <option value="<?=$data['id_organo']?>"><?= $data['desc_organo'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Razon Social Organismo<b title="Campo Obligatorio"
                                        style="color:red">*</b></label>
                                <input type="text" id="organo" name="organo" onkeyup="mayusculas(this);"
                                    class="form-control" placeholder="Nombre completo" maxlength="250">

                            </div>
                            <div class="form-group col-4">
                                <label>Codigo ONAPRE<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="cod_onapre" name="cod_onapre" onkeyup="mayusculas(this);"
                                    class="form-control" placeholder="Codigo Onapre" maxlength="100">

                            </div>
                            <div class="form-group col-4">
                                <label>Siglas del Órgano<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="siglas" name="siglas" onkeyup="mayusculas(this);"
                                    class="form-control" placeholder="siglas" maxlength="12">

                            </div>
                            <div class="form-group col-4">
                                <label>Siglas del Órgano<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="siglas" name="siglas" onkeyup="mayusculas(this);"
                                    class="form-control" placeholder="siglas" maxlength="12">

                            </div>
                            <div class="col-4">
                                <label>Rif del Órgano</label>
                                <div class="row">
                                    <div class="col-3">
                                        <select id="tipo_rif" name="tipo_rif" class="default-select2 form-control">
                                            <?php foreach ($tipo_rif as $data): ?>
                                            <option value="<?=$data['id_rif']?>/<?=$data['desc_rif']?>">
                                                <?=$data['desc_rif']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-9">
                                        <input type="text" id="rif" name="rif" class="form-control" placeholder="Rif"
                                            maxlength="9" minlength="9">

                                    </div>
                                </div>
                            </div>
                            <div class="col-3 form-group">
                                <label>Clasificación</label>
                                <select id="id_clasificacion" name="id_clasificacion"
                                    class="default-select2 form-control <?php  echo form_error('perfil') ? 'is-invalid' : ''; ?>">
                                    <option value="0">-Seleccione -</option>
                                    <?php foreach ($clasificacion as $data): ?>
                                    <option value="<?=$data['id_clasificacion']?>"><?=$data['desc_clasificacion']?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>


                            </div>
                            <div class="col-3 form-group">
                                <label>Teléfono Local<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="number" id="tel_local" name="tel_local" class="form-control"
                                    placeholder="042XXXXXXX">
                                <p id="errorMsg"></p>

                            </div>
                            <div class="col-3 form-group">
                                <label>Teléfono Local 2<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="number" id="tel_local_2" name="tel_local_2" class="form-control"
                                    placeholder="(042XXXXXXXX)" maxlength="20">

                            </div>
                            <div class="col-3 form-group">
                                <label>Teléfono Móvil<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="number" id="tel_movil" name="tel_movil" class="form-control"
                                    placeholder="(042XXXXXXXX)" maxlength="20">

                            </div>
                            <div class="col-3 form-group">
                                <label>Teléfono Móvil 2<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="number" id="tel_movil_2" name="tel_movil_2" class="form-control"
                                    placeholder="(042XXXXXXXX)" maxlength="20">

                            </div>
                            <div class="form-group col-3">
                                <label>Página Web<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="text" id="pag_web" name="pag_web" class="form-control"
                                    placeholder="pagina web" maxlength="20">

                            </div>
                            <div class="form-group col-6">
                                <label>Correo Electronico<b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input type="email" id="email" name="email" onblur="return validateEmail()"
                                    class="form-control" placeholder="ingrese correo institucional">
                                <div id="result-email"></div>

                            </div>
                            <div class="form-group col-12">
                                <label>Direcciòn Fiscal<b title="Campo Obligatorio" style="color:red">*</b></label><br>
                            </div>

                            <div class="form-group col-4">
                                <label>Estado</label>
                                <select class="form-control" name="id_estado_n" id="id_estado_n"
                                    onclick="llenar_municipio();listar_ciudades();">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($estados as $data): ?>
                                    <option value="<?=$data['id']?>"><?=$data['descedo']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label>Municipio</label>
                                <select class="form-control" name="id_municipio_n" id="id_municipio_n"
                                    onclick="llenar_parroquia();">
                                    <option value="0">Seleccione</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label>Parroquia</label>
                                <select class="form-control" name="id_parroquia_n" id="id_parroquia_n">
                                    <option value="0">Seleccione</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label>Dirección</label>
                                <textarea class="form-control" id="direccion_fiscal" name="direccion_fiscal" rows="3"
                                    cols="125"></textarea>
                            </div>
                            <div class="form-group col-6">
                                <label>Gaceta Oficial</label>
                                <input type="text" name="gaceta_oficial" id="gaceta_oficial" class="form-control">

                            </div>
                            <div class="col-6">
                                <label>Fecha de Gaceta</label>
                                <input type="date" class="form-control" id="fecha_gaceta" name="fecha_gaceta"
                                    placeholder="Seleccionar Fecha" />
                            </div>
                        </div>
                    </div>
            </div>
            <div class="form-group col 12 text-center">
                <button type="button" onclick="guardar_b();" id="guardar_organo" name="guardar_organo"
                    class="my-button">Guardar</button>
            </div>
            </from>
        </div>


    </div>
</div>

<script src="<?= base_url() ?>/js/dependientes.js"></script>

<script src="<?=base_url()?>/js/organo/organo.js"></script>



<script type="text/javascript">
$(document).ready(function() {
    $('#email').on('blur', function() {
        // url(http://localhost/asnc/Plantilla/img/images.jpeg);
        $('#result-email').html('<img src="http://localhost/asnc/Plantilla/img/5.gif"/>')
            .fadeOut(1000);
        var no = 0;

        var email = $(this).val();
        var dataString = 'email=' + email;
        var base_url = '/index.php/Configuracion/validad_corre';
        $.ajax({
            type: "POST",
            url: base_url,
            data: dataString,
            success: function(data) {
                console.log(data);
                if (data == no) {
                    $('#result-email').fadeIn(1600).html(
                        '<div class="alert alert-success"><strong>Bien!</strong> Correo disponible.</div>'
                    );
                    $("#guardar_organo").prop('disabled', false)

                } else {
                    $('#result-email').fadeIn(1600).html(
                        '<div class="alert alert-danger"><strong>Correo ya Registrado!</strong> Ingrese otro Correo.</div>'
                    );
                    $("#guardar_organo").prop('disabled', true)

                }





            }
        });
    });
});
</script>