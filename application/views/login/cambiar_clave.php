<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <h3>Cambio de Contraseña</h3>
            <form class="form-horizontal" id="camb_clave" data-parsley-validate="true" method="POST"
                enctype="multipart/form-data">
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-body">
                        <fieldset class="border border-success p-20 shadow-lg">

                            <div class="row">
                                <div class="col-6 mt-3 form-group" id="proyecto_s">
                                    <label>Nueva Contraseña <b style="color:red">*</b></label>
                                    <div class="input-group">
                                        <input id="clave" name="clave" type="password" class="form-control" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text password-toggle">
                                                <i class="fa fa-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3 form-group" id="proyecto_s">
                                    <label>Confirmar Contraseña <b style="color:red">*</b></label>
                                    <div class="input-group">
                                        <input id="c_clave" name="c_clave" type="password" class="form-control"
                                            required>
                                        <div class="input-group-append">
                                            <span class="input-group-text password-toggle">
                                                <i class="fa fa-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="camb_clave();" class="btn btn-default mb-3">Cambiar
                            Contraseña</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=base_url()?>/js/camb_clave.js"></script>
<script>
$(function() {
    $('.password-toggle').click(function() {
        const input = $(this).closest('.input-group').find('input[type="password"]');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).addClass('collapsed');
        } else {
            input.attr('type', 'password');
            $(this).removeClass('collapsed');
        }
    });
});
</script>