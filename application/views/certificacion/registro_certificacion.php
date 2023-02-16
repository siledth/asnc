<div class="sidebar-bg"></div>
<div id="content" class="content">
    <h2>REGISTRO PARA CERTIFICACIÓN JURÍDICA DE CARÁCTER PRIVADO</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-4">
                            <label>N° de Comprobante del Registro Nacional de Contratistas (RNC):</label>
                            <input class="form-control" type="text" name="rif_b" id="rif_b" onkeypress="may(this);"
                                placeholder="J123456789">
                        </div>
                        <div class="col- mt-4">
                            <button type="button" class="btn btn-default" onclick="consultar_rif();" name="button"> <i
                                    class="fas fa-search"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="display: none" id="items">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><b>FICHA TÉCNICA DE CERTIFICACIÓN PARA PERSONA NATURAL Y
                            JURÍDICA DE CARÁCTER PRIVADO</b></h4>
                </div>
                <div class="panel-body" id="no_existe">
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <h4 class="mt-2"><label>Por Favor revise el Rif ingresado! y vuelva a intentar.</label></h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body" id="existe">
                    <form class="form-horizontal" id="resgistrar_eva" data-parsley-validate="true" method="POST"
                        enctype="multipart/form-data">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4 class="panel-title"><b>INFORMACIÓN DE LA PERSONA JURÍDICA</b></h4>
                            </div>
                            <div class="panel-body" id="existe">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label>Rif del Contratista</label>
                                        <input class="form-control" type="text" name="rif_cont" id="rif_cont" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Denominación o Razón Social</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Estado</label>
                                        <input type="text" name="estado" id="estado" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Municipio</label>
                                        <input type="text" name="municipio" id="municipio" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Ciudad</label>
                                        <input type="text" name="ciudad" id="ciudad" class="form-control" readonly>
                                    </div>
                                    <br>
                                    <div class="col-11"></div>
                                    <div class="col-3"></div>
                                    <div id="tabla_rep" class="col-6">
                                        <table class="table table-bordered table-hover">
                                            <thead style="background:#e4e7e8">
                                                <tr>
                                                    <th class="text-center" colspan="3">Datos del Representante de la
                                                        Empresa:
                                                    </th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th>Nombre y Apellido</th>
                                                    <th>Cédula</th>
                                                    <th>Rif</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="exitte" id="exitte">
                            <div class="panel-heading">
                                <h4 class="panel-title"><b>PROGRAMA DEL CURSO O TALLER</b></h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="form-group col-5">
                                        <label>Objetivo: <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <textarea class="form-control" name="desc_contratacion" id="desc_contratacion"
                                            rows="3" cols="70"></textarea>
                                    </div>
                                    <div class="form-group col-5">
                                        <label>Contenido Programático: <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <textarea class="form-control" name="desc_contratacion" id="desc_contratacion"
                                            rows="3" cols="70"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <h4 class="panel-title"><b>Experiencia de la Empresa en Capacitación en Materias
                                        Relacionadas
                                        Con Contratación Pública (en los últimos 5 años)</b></h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-8">
                                        <label>Órgano/Ente/Institución/Empresa <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="organo" id="organo"
                                            placeholder="Nombre">
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Actividad <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="actividad" id="actividad"
                                            placeholder="Actividad">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <input class="form-control" type="date" name="desde" id="desde">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <input class="form-control" type="date" name="hasta" id="hasta">
                                    </div>

                                    <div class="col-12">
                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                    </div>
                                    <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe tener al menos
                                        un
                                        registro agregado, para proceder con la solicitud.</h5>

                                    <div class="col-12 text-center">
                                        <button type="button" onclick="agregar_ccnu_acc(this);"
                                            class="btn btn-lg btn-default">
                                            Agregar
                                        </button>
                                    </div>

                                    <div class="table-responsive mt-4">
                                        <h5 class="text-center">Lista de Requerimiento</h5>
                                        <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe tener al
                                            menos un
                                            requerimiento agregado, para proceder con la solicitud.</h5>
                                        <table id="target_req_acc" class="table table-bordered table-hover">
                                            <thead style="background:#e4e7e8;">
                                                <tr class="text-center">
                                                    <th>Órgano/Ente/Institución/Empresa</th>
                                                    <th>Actividad.</th>
                                                    <th>Desde.</th>
                                                    <th>Hasta</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <h4 class="panel-title"><b> Experiencia de la Empresa en Capacitación en Comisión de
                                        Contrataciones (en los últimos 3 años)</b></h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-8">
                                        <label>Órgano/Ente/Institución/Empresa <b title="Campo Obligatorio"
                                                style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="organo_expe" id="organo_expe"
                                            placeholder="Nombre">
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Actividad <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <input class="form-control" type="text" name="actividad_exp" id="actividad_exp"
                                            placeholder="Actividad">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <input class="form-control" type="date" name="desde_exp" id="desde_exp">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                        <input class="form-control" type="date" name="hasta_exp" id="hasta_exp">
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="text-center"><b style="color:red;">NOTA:</b> Debe llenar
                                                    todos lo
                                                    items para
                                                    llenar la tabla. <br>

                                                </h5>
                                            </div>
                                            <div class="col-5"></div>
                                            <div class="col-7 mt-4">
                                                <button type="button" onclick="agregar_ff(this);"
                                                    class="btn btn-lg btn-default" id="prueba2">
                                                    Agregar <b>Experiencia</b>
                                                </button>
                                            </div>
                                            <div class="table-responsive mt-3">

                                                <table id="target_acc_ff" class="table table-bordered table-hover">
                                                    <thead style="background:#e4e7e8;">
                                                        <tr class="text-center">
                                                            <th>Órgano/Ente/Institución/Empresa</th>
                                                            <th>Actividad.</th>
                                                            <th>Desde.</th>
                                                            <th>Hasta</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <h4 class="panel-title"><b>INFORMACIÓN DE LA PERSONA NATURAL (que dicta la
                                        capacitación)</b></h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label>Nombres y Apellidos <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="nombre_ape" id="nombre_ape"
                                                placeholder="Nombre">
                                        </div>

                                        <div class="form-group col-4">
                                            <label>N.º. Cédula de Identidad: <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="cedula" id="cedula"
                                                placeholder="cedula">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>N.º. RIF: <b title="Campo Obligatorio"
                                                    style="color:red">*</b></label>
                                            <input class="form-control" type="text" name="rif" id="rif"
                                                placeholder="Rif">
                                        </div>
                                        <div class="form-group col-2">
                                            <label>tarifa <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input id="valor" name="valor" value="<?=$inf_1['valor']?>"
                                            readonly>

                                        </div>

                                        <div class="col-12">
                                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                        </div>
                                        <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe tener al
                                            menos
                                            un
                                            registro agregado, para proceder con la solicitud.</h5>

                                        <div class="col-12 text-center">
                                            <button type="button" onclick="agregar_persona(this);"
                                                class="btn btn-lg btn-default">
                                                Agregar
                                            </button>
                                        </div>

                                        <div class="table-responsive mt-4">
                                            <h5 class="text-center">Lista de Requerimiento</h5>
                                            <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla debe tener
                                                al
                                                menos un
                                                requerimiento agregado, para proceder con la solicitud.</h5>
                                            <table id="target_persona" class="table table-bordered table-hover">
                                                <thead style="background:#e4e7e8;">
                                                    <tr class="text-center">
                                                        <th>Nombres y Apellidos</th>
                                                        <th>N.º. Cédula de Identidad.</th>
                                                        <th>N.º. RIF</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div class="row text-center mt-3">
                                <div class="col-6">
                                    <button
                                        class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-success"
                                        type="button" onclick="guardar_bien();" id="btn_guar_2" name="button"
                                        disabled>Guardar Certificación</button>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-primary"
                                        href="javascript:history.back()"> Volver</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>/js/certificacion/certificacion.js"></script>
    <script src="<?=base_url()?>/js/certificacion/agregar_organo.js"></script>
    <script src="<?=base_url()?>/js/certificacion/expe_capa.js"></script>
    <script src="<?=base_url()?>/js/certificacion/agregar_persona.js"></script>
    <script type="text/javascript">
    function may(e) {
        e.value = e.value.toUpperCase();
    }
    </script>