<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>Solicitudes Revisión RNC</h2>
    <div class="row">

        <div class="col-10 mt-4">
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">

                </div>
            </div>
        </div>
        <div class="col-lg-13">

            <div class="panel panel-inverse">
                <div class="panel-heading"></div>
                <div class="table-responsive">
                    <table id="data-table" data-order='[[ 4, "desc" ]]' class="table table-bordered table-hover">
                        <thead style="background:#01cdb2">
                            <tr style="text-align:center">
                                <th style="color:white;">Cédula</th>
                                <th style="color:white;">N° de Oficio</th>
                                <th style="color:white;">Causa</th>
                                <th style="color:white;">Tipo inv.</th>
                                <th style="color:white;">Observación</th>
                                <th style="color:white;">Información</th>
                                <th style="color:white;">Fecha de Consulta</th>
                                <th style="color:white;">Usuario</th>
                                <th style="color:white;">N° de consultas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $data): ?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?= $data['cedula_c'] ?> </td>
                                    <td><?= $data['n_oficio'] ?> </td>
                                    <td><?= $data['causa'] ?> </td>
                                    <td><?= $data['desc_tipo_invs'] ?> </td>
                                    <td><?= $data['observacion'] ?> </td>
                                    <td> <?= $data['existe'] == 1 ? "sí" : "no"; ?></td>
                                    <td><?= $data['datecreat'] ?> </td>
                                    <td><?= $data['nombrefun'] ?> </td>
                                    <td><?= $data['id_contadorbusqueda_'] ?> </td>



                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL PARA EDITAR INFORMACION DE CADA FILA -->


    <!-- /////////////////////////////editar items de bienes este-->
    <script src="<?= base_url() ?>/js/configuracion/updatelist.js"></script>