<div class="sidebar-bg"></div>
<div id="content" class="content">

    <h2>REGISTRO PARA CERTIFICACIÓN JURÍDICA Interno</h2>
    <div class="row">


        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title text-center"><b>FICHA TÉCNICA DE CERTIFICACIÓN PARA PERSONA JURÍDICA</b></h4>
            </div>

            <div class="panel-body" id="existe">

                <form class="form-horizontal" id="reg_bien" name="reg_bien" data-parsley-validate="true" method="POST"
                    enctype="multipart/form-data">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title" style="background: #FAE5D3"><b>INFORMACIÓN DE LA PERSONA
                                    JURÍDICA</b></h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label>N° de Comprobante Registro Único<b title="Campo Obligatorio"
                                            style="color:red">*</b></label>
                                    <input type="hidden" name="nro_comprobante" id="nro_comprobante"
                                        onkeyup="mayusculas(this);" class="form-control" readonly>
                                    <input type="text" name="nro_comprobantes" id="nro_comprobantes"
                                        onkeyup="mayusculas(this);" class="form-control" readonly>
                                </div>

                                <div class="form-group col-4">
                                    <label>Registro de Información Fiscal (RIF)</label>
                                    <input class="form-control" type="text" name="rif_cont" id="rif_cont"
                                        placeholder="VXXXXXXXX" value="<?= htmlspecialchars($rif_organoente ?? '') ?>"
                                        readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label>Nombre del Ente/Contratista</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control"
                                        onkeyup="mayusculas(this);" value="<?= htmlspecialchars($des_unidad ?? '') ?>"
                                        readonly>
                                </div>
                                <br>
                                <div class="col-11"></div>
                                <div class="col-3"></div>

                            </div>
                        </div>


                        <div class="col-lg-16">
                            <ul class="nav nav-tabs" style="background:#FAE5D3">
                                <li class="nav-items">
                                    <a href="#programa_taller" data-toggle="tab" class="nav-link active">
                                        <span class="d-sm-none">Tab 1</span>
                                        <span class="d-sm-block d-none" style="font-size: 12px;">
                                            Nombre del <br> curso o taller
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-items">
                                    <a href="#experi_empre_capa" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Tab 2</span>
                                        <span class="d-sm-block d-none" style="font-size: 12px;">
                                            Experiencia de la <br> Empresa en
                                            Capacitación <br>en
                                            Materias Relacionadas<br> Con Contratación <br>Pública (en los<br>
                                            últimos
                                            5 años)
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-items">
                                    <a href="#experi_empre_cap_comisi" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Tab 3</span>
                                        <span class="d-sm-block d-none" style="font-size: 12px;">
                                            Experiencia de la <br> Empresa en
                                            Capacitación <br>en
                                            Comisión de <br>Contrataciones(en los <br> últimos 3 años)
                                        </span>
                                    </a>
                                </li>
                                <!-- <li class="nav-items">
                                    <a href="#infor_per_natu" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Tab 4</span>
                                        <span class="d-sm-block d-none" style="font-size: 8px;">
                                            Información de la <br> persona natural <br>
                                            (que dicta la <br>
                                            capacitación)
                                        </span>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-items">
                                    <a href="#infor_per_prof" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Tab 5</span>
                                        <span class="d-sm-block d-none" style="font-size: 8px;">
                                            Información <br>de la <br>Formación<br>
                                            Profesional
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-items">
                                    <a href="#for_mat_contr_publ" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Tab 6</span>
                                        <span class="d-sm-block d-none" style="font-size: 8px;">
                                            Formación en <br> Materia de
                                            <br>Contratación <br> Pública

                                        </span>
                                    </a>
                                </li>
                                <li class="nav-items">
                                    <a href="#exp_par_comi_10" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Tab 7</span>
                                        <span class="d-sm-block d-none" style="font-size: 8px;">
                                            Experiencia de <br>Participación en
                                            <br> Comisiones de<br> Contrataciones <br>(en los <br>últimos 10
                                            años)

                                        </span>
                                    </a>
                                </li>
                                <li class="nav-items">
                                    <a href="#exp_dic_cap_3" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Tab 8</span>
                                        <span class="d-sm-block d-none" style="font-size: 8px;">
                                            Experiencia en <br>Dictado <br>de Capacitación
                                            <br>en Materia de Comisión <br>de Contrataciones (en <br>los últimos
                                            3 años)

                                        </span>
                                    </a>
                                </li> -->

                                <li class="nav-items">
                                    <a href="#declara" data-toggle="tab" class="nav-link">
                                        <span class="d-sm-none">Tab 8</span>
                                        <span class="d-sm-block d-none" style="font-size: 12px;">
                                            Declaración
                                        </span>
                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="programa_taller">
                                    <div class="row">

                                        <div class="form-group col-5">
                                            <label><b title="Campo Obligatorio" style="color:red">*</b>Nombre o
                                                Denominaciòn del Curso:
                                                <i style="color: red;" title="Ingresar Nombre o Denominaciòn del Curso"
                                                    class="fas fa-question-circle"></i>
                                            </label>
                                            <textarea class="form-control" name="objetivo" id="objetivo" rows="3"
                                                cols="70" onkeyup="mayusculas(this);"></textarea>
                                        </div>
                                        <div class="form-group col-5">
                                            <label> <b title="Campo Obligatorio" style="color:red">*</b>Contenido
                                                Programático:
                                                <i style="color: red;"
                                                    title="Ingresar el Contenido Programatico del Curso"
                                                    class="fas fa-question-circle"></i>
                                            </label>
                                            <textarea class="form-control" name="cont_prog" id="cont_prog" rows="3"
                                                cols="70" onkeyup="mayusculas(this);"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="experi_empre_capa">
                                    <div class="panel-body">


                                        <div class="row">
                                            <div class="form-group col-8">
                                                <label> <b title="Campo Obligatorio" style="color:red">*</b>Órgano o
                                                    Ente de la Comisión de Contrataciones
                                                    <i style="color: red;" title="Ingresar nombre de los Organos o Entes a los cuales a prestado servicio
                                                            en los ultimos 5 años" class="fas fa-question-circle"></i>

                                                    <input class="form-control" type="text"
                                                        name="organo_experi_empre_capa" id="organo_experi_empre_capa"
                                                        placeholder="Nombre" onkeyup="mayusculas(this);">
                                            </div>

                                            <div class="form-group col-4">
                                                <label><b title="Campo Obligatorio" style="color:red">*</b>Actividad
                                                    <i style="color: red;"
                                                        title="grese en que consistio la actividad, Ejemplo: Talleres"
                                                        class="fas fa-question-circle"></i>
                                                </label>
                                                <input class="form-control" type="text"
                                                    name="actividad_experi_empre_capa" id="actividad_experi_empre_capa"
                                                    placeholder="Actividad" onkeyup="mayusculas(this);">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Desde <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="date" name="desde_experi_empre_capa"
                                                    id="desde_experi_empre_capa" max="<?= $time ?>">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Hasta <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="date" name="hasta_experi_empre_capa"
                                                    id="hasta_experi_empre_capa" max="<?= $time ?>">
                                            </div>
                                            <div class="col-12">
                                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                            </div>
                                            <h5 class="text-center"><b style="color:red;">NOTA:</b>Los campos con <b
                                                    style="color:red;">*</b> son obligatorios.</h5>

                                            <div class="col-12 text-center">
                                                <button type="button" onclick="agregar_experi_empre_capa(this);"
                                                    class="btn btn-lg btn-default">
                                                    Agregar
                                                </button>
                                            </div>

                                            <div class="table-responsive mt-4">
                                                <h5 class="text-center">Lista de Requerimiento</h5>
                                                <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla
                                                    debe tener al
                                                    menos un
                                                    requerimiento agregado, para proceder con la solicitud.</h5>
                                                <table id="target_es_5a" class="table table-bordered table-hover">
                                                    <thead style="background:#e4e7e8;">
                                                        <tr class="text-center">
                                                            <th>Órgano/Ente/Institución/Empresa</th>
                                                            <th>Actividad.</th>
                                                            <th>Desde</th>
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

                                <div class="tab-pane fade" id="experi_empre_cap_comisi">
                                    <div class="row">
                                        <div class="form-group col-8">
                                            <label><b title="Campo Obligatorio"
                                                    style="color:red">*</b>Órgano/Ente/Institución/Empresa <b title="Ingresar nombre de los Organos o Entes a los cuales a prestado servicio
                                                            en los ultimos 3 años" style="color:red">!</b></label>
                                            <input class="form-control" type="text" name="organo_expe" id="organo_expe"
                                                placeholder="Nombre" onkeyup="mayusculas(this);">
                                        </div>

                                        <div class="form-group col-4">
                                            <b title="Campo Obligatorio" style="color:red">*</b>Actividad<b
                                                title="Ingrese en que consistio la actividad, Ejemplo: Talleres, Asesorias"
                                                style="color:red">!</b></label>
                                            <input class="form-control" type="text" name="actividad_exp"
                                                id="actividad_exp" placeholder="Actividad" onkeyup="mayusculas(this);">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Desde <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="date" name="desde_exp" id="desde_exp"
                                                max="<?= $time ?>">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Hasta <b title="Campo Obligatorio" style="color:red">*</b></label>
                                            <input class="form-control" type="date" name="hasta_exp" id="hasta_exp"
                                                max="<?= $time ?>">
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <h5 class="text-center"><b style="color:red;">NOTA:</b>Los
                                                        campos con <b style="color:red;">*</b> son obligatorios.
                                                    </h5>
                                                </div>
                                                <div class="col-1"></div>
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
                                                                <th>Actividad</th>
                                                                <th>Desde</th>
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

                                <div class="tab-pane fade" id="declara">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-8">
                                                <textarea class="form-control" name="declara" id="declara" rows="3"
                                                    cols="70">Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.</textarea>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Acepto <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>

                                                <select class="default-select2 form-control " id="acepto" name="acepto"
                                                    readonly>
                                                    <option value="">Seleccionar</option>

                                                    <option value="Si">Si</option>
                                                </select>

                                            </div>
                                            <div class="row text-center mt-3">
                                                <div class="col-6">
                                                    <button
                                                        class="btn btn-circle waves-effect btn-lg waves-circle waves-float btn-success"
                                                        style="background: #A93226 " type="button"
                                                        onclick="guardar_registro2();" id="btn_guar_24343"
                                                        name="button">Guardar Certificación</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </div>



                            </div>


                        </div>
                </form>
            </div>

        </div>

    </div>
</div>
<script src="<?= base_url() ?>/js/certificacion/registro_certifi.js"></script>
<script src="<?= base_url() ?>/js/certificacion/certificacion.js"></script>
<!-- <script src="<?= base_url() ?>/js/certificacion/agregar_organo.js"></script> -->
<script src="<?= base_url() ?>/js/certificacion/expe_capa.js"></script>
<!-- <script src="<?= base_url() ?>/js/certificacion/agregar_perona.js"></script>
<script src="<?= base_url() ?>/js/certificacion/calcular.js"></script>
<script src="<?= base_url() ?>/js/certificacion/infor_perso.js"></script>
<script src="<?= base_url() ?>/js/certificacion/for_mat_cert.js"></script>
<script src="<?= base_url() ?>/js/certificacion/exp_10.js"></script> -->
<!-- <script src="<?= base_url() ?>/js/certificacion/ex_3a.js"></script> -->
<script src="<?= base_url() ?>/js/certificacion/experi_empre_capa.js"></script>
<script src="<?= base_url() ?>/js/certificacion/calcular_vigencia.js"></script>
<script type="text/javascript">
    function mayusculas(e) {
        e.value = e.value.toUpperCase();
    }
    $("#monto_trans").on({
        "focus": function(event) {
            $(event.target).select();
        },
        "keyup": function(event) {
            $(event.target).val(function(index, value) {
                return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });
</script>