<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Registro de Preguntas de seguridad</h2>
    <h4>Debe agregar 3 preguntas de seguridad para poder continuar</h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <form class="form-horizontal" id="guardar_ba" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Preguntas <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <select id="pregunta" name="pregunta" class="default-select2 form-control">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($preguntas as $data): ?>
                                        <option value="<?= $data['id'] ?>">
                                            <?= $data['despregunta'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Respuesta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                <input class="form-control" type="text" name="nombre_b" id="nombre_b"
                                    placeholder="Denominacion social">
                            </div>
                            <!-- <h4>Debe agregar 3 preguntas de seguridad para poder continuar <span
                                    id="preguntas-counter">(0/3)</span></h4> -->


                        </div>
                    </div>
                    <div class="form-group col 12 text-center">
                        <button type="button" onclick="guardar_b();" id="guardar" name="guardar"
                            class="btn btn-primary mb-3">Guardar</button>
                    </div>
                    </from>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading"></div>
                    <div class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const guardarPreguntaUrl = "<?= base_url('index.php/Preguntas_controller/guardar') ?>";
    </script>
    <script src="<?= base_url() ?>/js/usuario/preguntas.js"></script>