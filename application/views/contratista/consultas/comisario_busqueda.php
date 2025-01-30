<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Seleccione tipo de persona <b style="color:red">*</b></label>
                            <select class="form-control" name="id_estado_n" id="id_estado_n"
                                onchange="redirectToView()">
                                <option value="0">Seleccione</option>
                                <option value="1">Persona Natural</option>
                                <option value="2">Persona Juridica</option>
                            </select>

                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

<script>
function redirectToView() {
    var select = document.getElementById("id_estado_n");
    var value = select.value;

    if (value == "1") {
        // Redirigir a la vista de Persona Natural
        window.location.href = "<?php echo base_url('index.php/Contratista/infor_contrat_comi_conta'); ?>";
    } else if (value == "2") {
        // Redirigir a la vista de Persona Juridica
        window.location.href = "<?php echo base_url('index.php/Contratista/infor_contrat_comi_conta_rif'); ?>";
        // echo base_url('index.php/Publicaciones/llamadointerno/'
    }
}
</script>