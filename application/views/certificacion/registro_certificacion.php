<div class="sidebar-bg"></div>
<div id="content" class="content">

    <h2>REGISTRO PARA CERTIFICACIÓN JURÍDICA</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-4">
                            <label>N° de Comprobante del Registro Nacional de Contratistas (RNC):</label>
                            <input class="form-control" type="text" name="rif_b" id="rif_b"
                                placeholder="XXXXXXXXXXXXXXX">
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
                    <h4 class="panel-title text-center"><b>FICHA TÉCNICA DE CERTIFICACIÓN PARA PERSONA JURÍDICA</b></h4>
                </div>
                <div class="panel-body" id="no_existe">
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <h4 class="mt-2"><label>Por Favor revise el N° de Certificado ingresado! y vuelva a
                                    intentar. <br>
                                    Debe estar Registrado en el Servicio Nacional de Contrataciones para Continuar con
                                    el Registro</label></h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body" id="existe">

                    <form class="form-horizontal" id="reg_bien" name="reg_bien" data-parsley-validate="true"
                        method="POST" enctype="multipart/form-data">
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
                                    <div class="form-group col-3">
                                        <label>N° Certificado</label>
                                        <input type="text" name="numcertrnc" id="numcertrnc" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Registro de Información Fiscal (RIF)</label>
                                        <input class="form-control" type="text" name="rif_cont" id="rif_cont" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Razón Social</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Representante Legal</label>
                                        <input type="text" name="percontacto" id="percontacto" class="form-control"
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
                                            <span class="d-sm-block d-none" style="font-size: 10px;">
                                                Nombre del <br> curso o taller
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-items">
                                        <a href="#experi_empre_capa" data-toggle="tab" class="nav-link">
                                            <span class="d-sm-none">Tab 2</span>
                                            <span class="d-sm-block d-none" style="font-size: 8px;">
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
                                            <span class="d-sm-block d-none" style="font-size: 8px;">
                                                Experiencia de la <br> Empresa en
                                                Capacitación <br>en
                                                Comisión de <br>Contrataciones(en los <br> últimos 3 años)
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-items">
                                        <a href="#infor_per_natu" data-toggle="tab" class="nav-link">
                                            <span class="d-sm-none">Tab 4</span>
                                            <span class="d-sm-block d-none" style="font-size: 8px;">
                                                Información de la <br> persona natural <br>
                                                (que dicta la <br>
                                                capacitación)
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-items">
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
                                    </li>

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
                                                    <i style="color: red;"
                                                        title="Ingresar Nombre o Denominaciòn del Curso"
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
                                                            name="organo_experi_empre_capa"
                                                            id="organo_experi_empre_capa" placeholder="Nombre"
                                                            onkeyup="mayusculas(this);">
                                                </div>

                                                <div class="form-group col-4">
                                                    <label><b title="Campo Obligatorio" style="color:red">*</b>Actividad
                                                        <i style="color: red;"
                                                            title="grese en que consistio la actividad, Ejemplo: Talleres"
                                                            class="fas fa-question-circle"></i>
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        name="actividad_experi_empre_capa"
                                                        id="actividad_experi_empre_capa" placeholder="Actividad"
                                                        onkeyup="mayusculas(this);">
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Desde <b title="Campo Obligatorio"
                                                            style="color:red">*</b></label>
                                                    <input class="form-control" type="date"
                                                        name="desde_experi_empre_capa" id="desde_experi_empre_capa"
                                                        max="<?= $time ?>">
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Hasta <b title="Campo Obligatorio"
                                                            style="color:red">*</b></label>
                                                    <input class="form-control" type="date"
                                                        name="hasta_experi_empre_capa" id="hasta_experi_empre_capa"
                                                        max="<?= $time ?>">
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
                                                <input class="form-control" type="text" name="organo_expe"
                                                    id="organo_expe" placeholder="Nombre" onkeyup="mayusculas(this);">
                                            </div>

                                            <div class="form-group col-4">
                                                <b title="Campo Obligatorio" style="color:red">*</b>Actividad<b
                                                    title="Ingrese en que consistio la actividad, Ejemplo: Talleres, Asesorias"
                                                    style="color:red">!</b></label>
                                                <input class="form-control" type="text" name="actividad_exp"
                                                    id="actividad_exp" placeholder="Actividad"
                                                    onkeyup="mayusculas(this);">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Desde <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="date" name="desde_exp" id="desde_exp"
                                                    max="<?= $time ?>">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Hasta <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
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

                                                        <table id="target_acc_ff"
                                                            class="table table-bordered table-hover">
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
                                    <div class="tab-pane fade" id="infor_per_natu">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="row">
                                                    <div class="form-group col-8">
                                                        <label>Nombres y Apellidos <b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input class="form-control" type="text" name="nombre_ape"
                                                            id="nombre_ape" placeholder="Nombre"
                                                            onkeyup="mayusculas(this);">
                                                    </div>

                                                    <div class="form-group col-4">
                                                        <label>N.º. Cédula de Identidad: <b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input class="form-control" type="text" name="cedula"
                                                            id="cedula" placeholder="VXXXXXXX">
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>N.º. RIF: <b title="Campo Obligatorio"
                                                                style="color:red">*</b></label>
                                                        <input class="form-control" type="text" name="rif" id="rif"
                                                            placeholder="VXXXXXXXX">

                                                    </div>
                                                    <div class="form-group col-2">
                                                        <label>Alícuota IVA Estimado<b
                                                                style="color:red">*</b></label><br>
                                                        <select style="width: 100%;" name="id_alicuota_iva"
                                                            id="id_alicuota_iva" onchange="calcular();"
                                                            class="form-control">
                                                            <option value="">SELECCIONE</option>
                                                            <?php foreach ($inf_2 as $data): ?>
                                                                <option
                                                                    value="<?= $data['desc_alicuota_iva'] ?>/<?= $data['desc_porcentaj'] ?>">
                                                                    <?= $data['desc_porcentaj'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-2">
                                                        <label>Tasa Bolivares<b style="color:red">*</b></label>
                                                        <?php if (isset(($exonerado))) { ?>
                                                            <input id="bolivar_estimado" name="bolivar_estimado" type="text"
                                                                class="form-control" value="0" readonly>

                                                            <?php  } else {

                                                            foreach ($inf_1 as $data): ?>
                                                                <input id="bolivar_estimado" name="bolivar_estimado" type="text"
                                                                    class="form-control" value="<?= $data['valor'] ?>" readonly>
                                                        <?php endforeach;
                                                        } ?>



                                                    </div>

                                                    <div class="form-group col-1">
                                                        <input id="iva_estimado" name="iva_estimado" type="hidden"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-1">
                                                        <input id="monto_estimado" name="monto_estimado" type="hidden"
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="col-12">
                                                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                                    </div>
                                                    <h5 class="text-center"><b style="color:red;">NOTA:</b>Los campos
                                                        con <b style="color:red;">*</b> son obligatorios.</h5>

                                                    <div class="col-12 text-center">
                                                        <button type="button" onclick="agregar_persona(this);"
                                                            class="btn btn-lg btn-default">
                                                            Agregar
                                                        </button>
                                                    </div>

                                                    <div class="table-responsive mt-4">
                                                        <h5 class="text-center">Lista de Requerimiento</h5>
                                                        <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla
                                                            debe tener
                                                            al
                                                            menos un
                                                            requerimiento agregado, para proceder con la solicitud.</h5>
                                                        <table id="target_persona"
                                                            class="table table-bordered table-hover">
                                                            <thead style="background:#e4e7e8;">
                                                                <tr class="text-center">
                                                                    <th>Nombres y Apellidos</th>
                                                                    <th>N.º. Cédula de Identidad.</th>
                                                                    <th>N.º. RIF</th>
                                                                    <th>Tasa Facilitador</th>
                                                                    <th>Monto IVA Estimado</th>
                                                                    <th>Monto total Estimado</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-6"></div>
                                                    <div class="form-group row col-6">
                                                        <label class="col-form-label col-md-6 text-right">Persona
                                                            Jurídica </label>
                                                        <div class="col-md-6">
                                                            <?php if (isset(($exonerado))) { ?>
                                                                <input id="pj" name="pj" type="text" class="form-control"
                                                                    value="0" readonly>


                                                                <?php  } else {
                                                                foreach ($inf_3 as $data): ?>
                                                                    <input id="pj" name="pj" type="text"
                                                                        class="form-control text-center"
                                                                        value="<?= $data['valor'] ?>" readonly>
                                                                <?php endforeach; ?>



                                                            <?php  } ?>
                                                            <input id="total_iva" name="total_iva" type="hidden"
                                                                class="form-control text-center" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-6"></div>
                                                    <div class="form-group row col-6">
                                                        <label
                                                            class="col-form-label col-md-6 text-right">Subtotal</label>
                                                        <div class="col-md-6">

                                                            <input id="sub_total" name="sub_total" type="text"
                                                                class="form-control text-center" readonly>


                                                        </div>
                                                    </div>
                                                    <div class="col-6"></div>
                                                    <div class="form-group row col-6">
                                                        <label class="col-form-label col-md-6 text-right">IVA</label>
                                                        <div class="col-md-6">

                                                            <input id="total_pj" name="total_pj" type="hidden"
                                                                class="form-control text-center" readonly>


                                                            <input id="total_final" name="total_final" type="text"
                                                                class="form-control text-center" readonly>

                                                        </div>
                                                    </div>
                                                    <div class="col-6"></div>
                                                    <div class="form-group row col-6">
                                                        <label class="col-form-label col-md-6 text-right">Bolivares a
                                                            Pagar </label>
                                                        <div class="col-md-6">

                                                            <input id="total_bs" name="total_bs" type="hidden"
                                                                class="form-control text-center" readonly>



                                                            <input id="total_bss" name="total_bss" type="text"
                                                                class="form-control text-center" readonly>

                                                        </div>

                                                    </div>
                                                    <!-- ////////////// aca empiesa datos bancarios-->
                                                    <?php if (isset(($exonerado))) { ?>
                                                        <div class="row">


                                                            <div class="form-group col-3">

                                                                <input id="n_ref" name="n_ref" type="hidden"
                                                                    Value="Exonerado" class="form-control">
                                                            </div>
                                                            <div class="form-group col-4">


                                                                <input id="banco_e" name="banco_e" type="hidden"
                                                                    Value="Exonerado" class="form-control">

                                                            </div>

                                                            <div class="form-group col-4">


                                                                <input id="banco_rec" name="banco_rec" type="hidden"
                                                                    Value="Exonerado" class="form-control">
                                                            </div>
                                                            <div class="form-group col-3">

                                                                <input class="form-control" type="hidden" name="fecha_trans"
                                                                    id="fecha_trans" Value="<?= $time ?>">
                                                            </div>
                                                            <div class="form-group col-3">
                                                                <input id="monto_trans" name="monto_trans" type="hidden"
                                                                    Value="0" class="form-control">
                                                            </div>



                                                        </div>

                                                </div>

                                            <?php  } else { ?>


                                                <div class="form-group col-8">
                                                    <label class="col-form-label col-md-6 text-right">Numero de
                                                        Cuenta </label>
                                                    <textarea class="form-control" name="h" id="v" rows="5" cols="50"
                                                        readonly>Los pagos deben realizarse en el Banco de Venezuela a la Cuenta Corriente N° 01020552270000042877 a nombre del Servicio Nacional de Contrataciones RIF G-200024518. No se acepta el pago con cheques.</textarea>
                                                </div>
                                                <div class="form-group col-3">
                                                    <label class="col-form-label col-md-6 text-right">Numero de
                                                        Referencia </label>
                                                    <input id="n_ref" name="n_ref" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Banco Emisor <b title="Campo Obligatorio"
                                                            style="color:red">*</b></label>

                                                    <select style="width: 100%;" name="banco_e" id="banco_e"
                                                        class="default-select2 form-control ">
                                                        <option value="">SELECCIONE</option>
                                                        <?php foreach ($bancos as $data): ?>
                                                            <option value="<?= $data['nombre_b'] ?>">
                                                                <?= $data['nombre_b'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label>Banco Receptor <b title="Campo Obligatorio"
                                                            style="color:red">*</b></label>
                                                    <select style="width: 100%;" name="banco_rec" id="banco_rec"
                                                        class="default-select2 form-control ">
                                                        <option value="">SELECCIONE</option>
                                                        <option value="BANCO DE VENEZUELA">BANCO DE VENEZUELA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-3">
                                                    <label>Fecha de La trasferencia <b title="Campo Obligatorio"
                                                            style="color:red">*</b></label>
                                                    <input class="form-control" type="date" name="fecha_trans"
                                                        id="fecha_trans" max="<?= $time ?>">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label>Ingrese Monto de la trasferencia <b title="Campo Obligatorio"
                                                            style="color:red">*</b></label>
                                                    <input class="form-control" type="text" name="monto_trans"
                                                        id="monto_trans" onkeypress="return valideKey(event);">
                                                </div>
                                            <?php     } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="infor_per_prof">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-8">
                                                <label> Formación Académica <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <select style="width: 100%;" class="default-select2 form-control "
                                                    id="for_academica" name="for_academica" readonly>
                                                    <option value="Maestria">Maestria</option>
                                                    <option value="Licenciatura">Licenciatura</option>
                                                    <option value="Postgrado">Postgrado</option>
                                                    <option value="Superior">Superior</option>
                                                    <option value="Bachiller">Bachiller</option>
                                                    <option value="Especialización">Especialización</option>
                                                    <option value="Doctorado">Doctorado</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-4">
                                                <label>Título Obtenido <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="titulo" id="titulo"
                                                    placeholder="Actividad" onkeyup="mayusculas(this);">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Año de Inicio (aaaa) <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="number" name="ano" id="ano"
                                                    placeholder="2010">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Culminación (aaaa)<b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="culminacion"
                                                    id="culminacion" placeholder="2020">

                                            </div>
                                            <div class="form-group col-4">
                                                <label>En Curso <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <select class="default-select2 form-control " id="curso" name="curso"
                                                    readonly>
                                                    <option value="">Seleccionar</option>
                                                    <option value="No">No</option>
                                                    <option value="Si">Si</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                            </div>
                                            <h5 class="text-center"><b style="color:red;">NOTA:</b>Los campos con <b
                                                    style="color:red;">*</b> son obligatorios.</h5>

                                            <div class="col-12 text-center">
                                                <button type="button" onclick="agregar_infor_perso(this);"
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
                                                <table id="target_infor_perso" class="table table-bordered table-hover">
                                                    <thead style="background:#e4e7e8;">
                                                        <tr class="text-center">
                                                            <th>Formación Académica</th>
                                                            <th>Título Obtenido</th>
                                                            <th>Año de Inicio</th>
                                                            <th>Culminación</th>
                                                            <th>En Curso</th>

                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="for_mat_contr_publ">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-8">
                                                <label> Taller o Curso de Comisión de Contrataciones <b
                                                        title="Campo Obligatorio" style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="taller" id="taller"
                                                    placeholder="Nombre" onkeyup="mayusculas(this);">
                                            </div>

                                            <div class="form-group col-4">
                                                <label>Institución donde realizó la Formación<b
                                                        title="Campo Obligatorio" style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="institucion"
                                                    id="institucion" placeholder="institucion"
                                                    onkeyup="mayusculas(this);">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Horas de Duración <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="number" name="hor_dura" id="hor_dura">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>N.º del Certificado <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="certi" id="certi"
                                                    onkeyup="mayusculas(this);">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Fecha Certificado <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="date" name="fech_cert" id="fech_cert"
                                                    max="<?= $time ?>">




                                            </div>
                                            <div class="form-group col-4">
                                                <label>Vigencia<b title="Campo Obligatorio" style="color:red">no
                                                        debe dar mas de 2 años</b></label>
                                                <input class="form-control" type="text" name="vigencia" id="vigencia"
                                                    readonly>
                                            </div>
                                            <div class="col-12">
                                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                            </div>
                                            <h5 class="text-center"><b style="color:red;">NOTA:</b>Los campos con <b
                                                    style="color:red;">*</b> son obligatorios.</h5>

                                            <div class="col-12 text-center">
                                                <button type="button" onclick="agregar_for_mat_cert(this);"
                                                    class="btn btn-lg btn-default">
                                                    Agregar
                                                </button>
                                            </div>

                                            <div class="table-responsive mt-4">
                                                <h5 class="text-center">Lista de Requerimiento</h6>
                                                    <h5 class="text-center"><b style="color:red;">NOTA:</b> La tabla
                                                        debe tener al
                                                        menos un
                                                        requerimiento agregado, para proceder con la solicitud.</h6>
                                                        <table id="target_for_mat_cer"
                                                            class="table table-bordered table-hover">
                                                            <thead style="background:#e4e7e8;">
                                                                <tr class="text-center">
                                                                    <th>Taller o Curso</th>
                                                                    <th>Institución</th>
                                                                    <th>Horas de Duración</th>
                                                                    <th>N.º del Certificado</th>
                                                                    <th>Fecha Certificado</th>
                                                                    <th>Vigencia</th>
                                                                    <h>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="exp_par_comi_10">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-8">
                                                <label> Órgano o Ente de la Comisión de Contrataciones <b
                                                        title="Campo Obligatorio" style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="organo10" id="organo10"
                                                    placeholder="Nombre">
                                            </div>

                                            <div class="form-group col-6">
                                                <label>Acto Administrativo de Designación<b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <select style="width: 100%;" class="default-select2 form-control "
                                                    id="act_adminis_desid" name="act_adminis_desid" readonly>
                                                    <option value="Gaceta">Gaceta</option>
                                                    <option value="Providencia">Providencia</option>
                                                    <option value="Resolución">Resolución</option>
                                                    <option value="Punto de Cuenta">Punto de Cuenta</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>N° del Acto <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="number" name="n_acto" id="n_acto">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Fecha <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="date" name="fecha_act" id="fecha_act"
                                                    max="<?= $time ?>">
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Área <b title="Campo Obligatorio" style="color:red">*</b></label>
                                                <select style="width: 100%;" class="default-select2 form-control "
                                                    id="area_10" name="area_10" readonly>
                                                    <option value="Legal">Legal</option>
                                                    <option value="Económica Financiera">Económica Financiera
                                                    </option>
                                                    <option value="Técnica">Técnica</option>
                                                    <option value="Secretario">Secretario</option>
                                                    <option value="Secretaria">Secretaria</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Duración en la Comisión (tiempo) <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="dura_comi" id="dura_comi">
                                            </div>
                                            <div class="col-12">
                                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                            </div>
                                            <h5 class="text-center"><b style="color:red;">NOTA:</b>Los campos con <b
                                                    style="color:red;">*</b> son obligatorios.</h5>

                                            <div class="col-12 text-center">
                                                <button type="button" onclick="agregar_exp_10(this);"
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
                                                <table id="target_exp_10" class="table table-bordered table-hover">
                                                    <thead style="background:#e4e7e8;">
                                                        <tr class="text-center">
                                                            <th>Órgano/Ente/Institución/Empresa</th>
                                                            <th>Acto Administrativo de Designación</th>
                                                            <th>N° del Acto</th>
                                                            <th>Fecha</th>
                                                            <th>Área</th>
                                                            <th>Duración en la Comisión</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="exp_dic_cap_3">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-8">
                                                <label> Órgano o Ente de la Comisión de Contrataciones <b
                                                        title="Campo Obligatorio" style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="organo3" id="organo3"
                                                    placeholder="Nombre" onkeyup="mayusculas(this);">
                                            </div>

                                            <div class="form-group col-4">
                                                <label>Actividad<b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="actividad3"
                                                    id="actividad3" placeholder="Actividad" onkeyup="mayusculas(this);">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Desde <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="date" name="desde3" id="desde3"
                                                    max="<?= $time ?>">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Hasta <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="date" name="hasta3" id="hasta3"
                                                    max="<?= $time ?>">
                                            </div>
                                            <div class="col-12">
                                                <hr style="border-top: 1px solid rgba(0, 0, 0, 0.39);">
                                            </div>
                                            <h5 class="text-center"><b style="color:red;">NOTA:</b>Los campos con <b
                                                    style="color:red;">*</b> son obligatorios.</h5>

                                            <div class="col-12 text-center">
                                                <button type="button" onclick="agregar_ex3a(this);"
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
                                                <table id="target_es_3a" class="table table-bordered table-hover">
                                                    <thead style="background:#e4e7e8;">
                                                        <tr class="text-center">
                                                            <th>Órgano o Ente de la Comisión de Contrataciones</th>
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
                                                        onclick="guardar_registro();" id="btn_guar_2" name="button"
                                                        disabled>Guardar Certificación</button>
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
</div>
<script src="<?= base_url() ?>/js/certificacion/registro_certifi.js"></script>
<script src="<?= base_url() ?>/js/certificacion/certificacion.js"></script>
<script src="<?= base_url() ?>/js/certificacion/agregar_organo.js"></script>
<script src="<?= base_url() ?>/js/certificacion/expe_capa.js"></script>
<script src="<?= base_url() ?>/js/certificacion/agregar_perona.js"></script>
<script src="<?= base_url() ?>/js/certificacion/calcular.js"></script>
<script src="<?= base_url() ?>/js/certificacion/infor_perso.js"></script>
<script src="<?= base_url() ?>/js/certificacion/for_mat_cert.js"></script>
<script src="<?= base_url() ?>/js/certificacion/exp_10.js"></script>
<script src="<?= base_url() ?>/js/certificacion/ex_3a.js"></script>
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