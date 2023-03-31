<div class="sidebar-bg"></div>
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse">

                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 mt-4">
                        <div class="card card-outline-danger text-center bg-white">
                            <div class="card-block">
                                <blockquote class="card-blockquote" style="margin-bottom: -19px;">
                                    <p class="f-s-16 text-inverse f-w-600">Nombre Órgano / Ente: <?=$des_unidad?>.</p>
                                    <p class="f-s-14">RIF.: <?=$rif?> <br>
                                        Código ONAPRE: <?=$codigo_onapre?></p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-6 text-center mt-3">
                        <h3 class="text-center"> Programaciones Registradas</h3>
                        <table id="data-table-default" class="table table-bordered table-hover">
                            <thead style="background:#e4e7e8">
                                <tr class="text-center">
                                    <th>Rif</th>
                                    <th>Denominacion Social</th>
                                    <th>Año de Programacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ver_programaciones as $lista):?>
                                <tr class="odd gradeX" style="text-align:center">
                                    <td><?=$lista['rif']?></td>
                                    <td><?=$lista['descripcion']?> </td>
                                    <td><?=$lista['anio']?> </td>
                                    <td class="center">
                                        <a href="<?php echo base_url();?>index.php/programacion/nueva_prog?id=<?php echo $lista['id_programacion'];?>"
                                            class="button">
                                            <i class="fas fa-lg fa-fw fa-edit"
                                                title="Cargar información de la programación"></i>
                                            <a />

                                    </td>

                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function valideKey(evt) {
    var code = (evt.which) ? evt.which : evt.keyCode;
    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        return false;
    }
}
</script>
<script src="<?=base_url()?>/js/programacion.js"></script>