<!-- <div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="col-12"><br>
                    <h3 class="text-center">Anulaciones Solicitadas</h3>
                    <table id="data-table-default" class="table table-bordered table-hover">
                        <thead style="background:#e4e7e8">
                            <tr class="text-center">
                                <th>ID Evaluacion de desempeño</th>
                                <th>ID anulación</th>
                                <th>Fecha Reg. Evaluación</th>
                                <th>Evaluador</th>
                                <th>Rif contratista</th>
                                <th>Denominación Razón Social</th>
                                <th>Clasificación</th>
                                <th>Estatus de Notificación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($anulaciones as $data): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?= $data['id_evaluacion'] ?> </td>

                                    <td><?= $data['id_anulacion'] ?> </td>
                                    <td><?= $data['fech_reg'] ?> </td>
                                    <td><?= $data['rif_ente_evaluador'] ?> <?= $data['nombre_ente_evaluador'] ?></td>

                                    <td><?= $data['rif_contrat'] ?> </td>
                                    <td><?= $data['contratante'] ?> </td>
                                    <td><?= $data['calificacion'] ?></td>
                                    <td><?= $data['estatus'] ?></td>
                                    <td class="center">
                                        <a title="Visualizar e Imprimir la Evaluación de Desempeño"
                                            href="<?php echo base_url(); ?>index.php/Evaluacion_desempenio/ver_evaluacion?id=<?php echo $data['id_evaluacion']; ?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-eye" style="color: green;"></i>
                                            <a />
                                            <a title="ver Imagen"
                                                href="<?php echo base_url(); ?>index.php/Evaluacion_desempenio/ver_evaluacion_img?id=<?php echo $data['id_evaluacion']; ?>"
                                                class="button">
                                                <i class="fas fa-lg 	fas fa-camera-retro" style="color: black;"></i>
                                                <a />
                                                <a class="button">
                                                    <i title="Ver datos de Anulación de Desempeño"
                                                        onclick="modal_ver(<?php echo $data['id_evaluacion'] ?>);"
                                                        data-toggle="modal" data-target="#exampleModal_ver"
                                                        class="fas fa-lg fa-fw fa-file-excel" style="color: blue;"></i>
                                                    <a />
                                                    <?php if ($data['id_estatus'] != 3): ?>
                                                        <a class="button">
                                                            <i title="Aprobar Anulación de Desempeño"
                                                                onclick="aprovar_anul(<?php echo $data['id_evaluacion'] ?>);"
                                                                class="fas fa-lg fa-fw fa-check" style="color: #fbff00;"></i>
                                                            <a />
                                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA INGRESAR LA INFORMACIÓN DE LA ANULACIÓN DE DESEMPEÑO -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Anulación de Desempeño</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_anulacion" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-2">
                            <label>ID de Evaluación</label>
                            <input class="form-control" type="text" name="id" id="id" readonly>
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-3">
                            <label>Nro. de Oficio de la Solicitud</label>
                            <input class="form-control" type="text" name="nro_oficicio" id="nro_oficicio">
                        </div>
                        <div class="form-group col-3">
                            <label>Fecha de Notificación</label>
                            <input type="text" class="form-control" id="datepicker-default" name="fec_solicitud"
                                placeholder="Seleccionar Fecha" />
                        </div>
                        <div class="form-group col-3">
                            <label>Nro. del Expediente</label>
                            <input class="form-control" type="text" name="nro_expediente" id="nro_expediente">
                        </div>
                        <div class="form-group col-3">
                            <label>Nro. Gaceta o Resolución</label>
                            <input class="form-control" type="text" name="nro_gacet_resol" id="nro_gacet_resol">
                        </div>
                        <div class="form-group col-3">
                            <label>Cédula del Sol.</label>
                            <input class="form-control" type="text" name="cedula_solc" id="cedula_solc">
                        </div>
                        <div class="form-group col-6">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control" type="text" name="nom_ape_solc" id="nom_ape_solc">
                        </div>
                        <div class="form-group col-3">
                            <label>Télefono del Solicitante</label>
                            <input class="form-control" type="text" name="telf_solc" id="telf_solc">
                        </div>
                        <div class="form-group col-6">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo" id="cargo">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_anulacion();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA MOSTRAR LA INFORMACIÓN DE LA ANULACION -->
<div class="modal fade" id="exampleModal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de la Anulación de Desempeño</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_anulacion" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-2">
                            <label>ID de Evaluación</label>
                            <input class="form-control text-center" type="text" name="id_ver" id="id_ver" readonly>
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Nro. de Oficio de la Solicitud</label>
                            <input class="form-control" type="text" name="nro_oficicio_ver" id="nro_oficicio_ver"
                                readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de Notificación</label>
                            <input type="text" class="form-control" id="fec_solicitud_ver" name="fec_solicitud_ver"
                                readonly />
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. del Expediente</label>
                            <input class="form-control" type="text" name="nro_expediente_ver" id="nro_expediente_ver"
                                readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. Gaceta, Resolución o Providencia</label>
                            <input class="form-control" type="text" name="nro_gacet_resol_ver" id="nro_gacet_resol_ver"
                                readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Cédula del Sol.</label>
                            <input class="form-control" type="text" name="cedula_solc_ver" id="cedula_solc_ver"
                                readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Télefono del Solicitante</label>
                            <input class="form-control" type="text" name="telf_solc_ver" id="telf_solc_ver" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control" type="text" name="nom_ape_solc_ver" id="nom_ape_solc_ver"
                                readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo_ver" id="cargo_ver" readonly>
                        </div>
                        <div class="form-group col-12">
                            <label>Breve descripción de la Solicitud</label>
                            <textarea class="form-control" rows="2" name="descp_anul_ver" id="descp_anul_ver"
                                readonly></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/js/eval_desempenio/anulacion.js"></script> -->

<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">
                <div class="panel-heading bg-primary text-white">
                    <h4 class="panel-title text-center">📜 Anulaciones Solicitadas</h4>
                </div>
                <div class="panel-body p-3">
                    <table id="data-table-default58" class="table table-hover table-striped" style="width:100%">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th class="text-nowrap">ID Eval.</th>
                                <th class="text-nowrap">ID Anul.</th>
                                <th class="text-nowrap">Fecha Reg.</th>
                                <th>Evaluador</th>
                                <th>RIF /Razón Social</th>
                                <th class="text-nowrap">Clasificación</th>
                                <th class="text-nowrap">Estatus</th>
                                <th class="text-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($anulaciones as $data): ?>
                                <tr class="text-center">
                                    <td><?= $data['id_evaluacion'] ?></td>
                                    <td><?= $data['id_anulacion'] ?></td>
                                    <td class="text-nowrap"><?= $data['fech_reg'] ?></td>
                                    <td title="<?= $data['nombre_ente_evaluador'] ?>">
                                        <strong><?= $data['rif_ente_evaluador'] ?></strong>
                                        <br>
                                        <small><?= substr($data['nombre_ente_evaluador'], 0, 15) . '...' ?></small>
                                    </td>
                                    <td title="<?= $data['contratante'] ?>">
                                        <strong><?= $data['rif_contrat'] ?></strong>
                                        <br>
                                        <small><?= substr($data['contratante'], 0, 15) . '...' ?></small>
                                    </td>
                                    <!-- <td><?= $data['rif_contrat'] ?></td>
                                    <td class="text-left" title="<?= $data['contratante'] ?>">
                                        <?= substr($data['contratante'], 0, 20) . '...' ?>
                                    </td> -->
                                    <td><?= $data['calificacion'] ?></td>
                                    <td>
                                        <?php
                                        $estatus_class = 'badge-primary'; // Default
                                        if ($data['id_estatus'] == 3) {
                                            $estatus_class = 'badge-success'; // Aprobado
                                        } elseif ($data['id_estatus'] == 2) {
                                            $estatus_class = 'badge-warning'; // Pendiente (asumido para esta vista)
                                        }
                                        ?>
                                        <span class="badge <?= $estatus_class ?>"><?= $data['estatus'] ?></span>
                                    </td>
                                    <td class="text-nowrap">
                                        <a title="Visualizar e Imprimir Evaluación"
                                            href="<?php echo base_url(); ?>index.php/Evaluacion_desempenio/ver_evaluacion?id=<?php echo $data['id_evaluacion']; ?>"
                                            class="btn btn-sm btn-success p-1">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a title="Ver Imagen"
                                            href="<?php echo base_url(); ?>index.php/Evaluacion_desempenio/ver_evaluacion_img?id=<?php echo $data['id_evaluacion']; ?>"
                                            class="btn btn-sm btn-info p-1">
                                            <i class="fas fa-camera-retro"></i>
                                        </a>

                                        <button title="Ver datos de Anulación"
                                            onclick="modal_ver(<?php echo $data['id_evaluacion'] ?>);" data-toggle="modal"
                                            data-target="#exampleModal_ver" class="btn btn-sm btn-primary p-1">
                                            <i class="fas fa-file-alt"></i>
                                        </button>

                                        <?php if ($data['id_estatus'] != 3): ?>
                                            <button title="Aprobar Anulación de Desempeño"
                                                onclick="aprovar_anul(<?php echo $data['id_evaluacion'] ?>);"
                                                class="btn btn-sm btn-warning p-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

---

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">📝 Registro de Anulación de Desempeño</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_anulacion" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-2">
                            <label>ID de Evaluación</label>
                            <input class="form-control" type="text" name="id" id="id" readonly>
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Nro. de Oficio de la Solicitud</label>
                            <input class="form-control" type="text" name="nro_oficicio" id="nro_oficicio">
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de Notificación</label>
                            <input type="text" class="form-control" id="datepicker-default" name="fec_solicitud"
                                placeholder="Seleccionar Fecha" />
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. del Expediente</label>
                            <input class="form-control" type="text" name="nro_expediente" id="nro_expediente">
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. Gaceta o Resolución</label>
                            <input class="form-control" type="text" name="nro_gacet_resol" id="nro_gacet_resol">
                        </div>
                        <div class="form-group col-4">
                            <label>Cédula del Sol.</label>
                            <input class="form-control" type="text" name="cedula_solc" id="cedula_solc">
                        </div>
                        <div class="form-group col-4">
                            <label>Télefono del Solicitante</label>
                            <input class="form-control" type="text" name="telf_solc" id="telf_solc">
                        </div>
                        <div class="form-group col-6">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control" type="text" name="nom_ape_solc" id="nom_ape_solc">
                        </div>
                        <div class="form-group col-6">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo" id="cargo">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_anulacion();" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<style>
    /* Estilos para hacer que los campos readonly se vean como texto plano */
    /* Más específico para input y textarea, y usando !important */
    .form-control.input-sin-fondo[readonly],
    .form-control.input-sin-fondo[readonly]:focus {
        /* También aplica al estado de foco */
        background-color: transparent !important;
        /* Quita el color de fondo gris */
        border-color: transparent !important;
        /* Opcional: Hace el borde transparente */
        box-shadow: none !important;
        /* Elimina cualquier sombra */
        outline: 0 !important;
        /* Quita el outline en focus */
        padding-left: 0.75rem !important;
        /* Restaura el padding si lo habías quitado demasiado */
        color: #333 !important;
        /* Asegura un color de texto oscuro */
        cursor: default !important;
        /* Cambia el cursor para indicar que no es editable */
    }

    /* Opcional: si quieres un borde inferior sutil para simular una línea de texto */
    /*
.form-control.input-sin-fondo[readonly] {
    border-bottom: 1px solid #ced4da !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    border-radius: 0 !important;
}
*/
</style>
<!-- ---

### Modal de Visualización (`#exampleModal_ver`) - Estilizado con `bg-info`

```html -->
<div class="modal fade" id="exampleModal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">🔎 Información de la Anulación de Desempeño</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="resgistrar_anulacion" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-2">
                            <label>ID de Evaluación</label>
                            <input class="form-control text-center input-sin-fondo" type="text" name="id_ver"
                                id="id_ver" readonly>
                        </div>
                        <div class="col-10"></div>
                        <div class="form-group col-4">
                            <label>Nro. de Oficio de la Solicitud</label>
                            <input class="form-control input-sin-fondo" type="text" name="nro_oficicio_ver"
                                id="nro_oficicio_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha de Notificación</label>
                            <input type="text" class="form-control input-sin-fondo" id="fec_solicitud_ver"
                                name="fec_solicitud_ver" readonly />
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. del Expediente</label>
                            <input class="form-control input-sin-fondo" type="text" name="nro_expediente_ver"
                                id="nro_expediente_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Nro. Gaceta, Resolución o Providencia</label>
                            <input class="form-control input-sin-fondo" type="text" name="nro_gacet_resol_ver"
                                id="nro_gacet_resol_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Cédula del Sol.</label>
                            <input class="form-control input-sin-fondo" type="text" name="cedula_solc_ver"
                                id="cedula_solc_ver" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label>Télefono del Solicitante</label>
                            <input class="form-control input-sin-fondo" type="text" name="telf_solc_ver"
                                id="telf_solc_ver" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Nombre y Apellido del Solicitante</label>
                            <input class="form-control input-sin-fondo" type="text" name="nom_ape_solc_ver"
                                id="nom_ape_solc_ver" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>Cargo</label>
                            <input class="form-control input-sin-fondo" type="text" name="cargo_ver" id="cargo_ver"
                                readonly>
                        </div>
                        <div class="form-group col-12">
                            <label>Breve descripción de la Solicitud</label>
                            <textarea class="form-control input-sin-fondo" rows="2" name="descp_anul_ver"
                                id="descp_anul_ver" readonly></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/js/eval_desempenio/anulacion.js"></script>