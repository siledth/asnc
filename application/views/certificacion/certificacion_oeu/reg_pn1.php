    <link href="<?= base_url('css/certificacion.css') ?>" rel="stylesheet">

    <div class="sidebar-bg"></div>
    <div id="content" class="content">
        <h2>REGISTRO PARA CERTIFICACIÓN DE PERSONA NATURAL</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title"><b>INFORMACIÓN GENERAL DE LA CERTIFICACIÓN</b></h4>
                    </div>
                    <div class="panel-body" id="initial_form_panel">
                        <form class="form-horizontal" id="reg_cert_initial" name="reg_cert_initial"
                            data-parsley-validate="true" method="POST">
                            <div class="row">

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
                                <div class="form-group col-6">
                                    <label><b title="Campo Obligatorio" style="color:red">*</b>Nombre o Denominación del
                                        Curso:</label>
                                    <textarea class="form-control" name="objetivo" id="objetivo" rows="3" cols="70"
                                        onkeyup="mayusculas(this);"></textarea>
                                </div>
                                <div class="form-group col-6">
                                    <label> <b title="Campo Obligatorio" style="color:red">*</b>Contenido
                                        Programático:</label>
                                    <textarea class="form-control" name="cont_prog" id="cont_prog" rows="3" cols="70"
                                        onkeyup="mayusculas(this);"></textarea>
                                </div>

                                <?php if (!isset($exonerado)) { ?>
                                    <div class="col-12 mt-4">
                                        <hr>
                                        <h5 class="text-center"><b style="color:red;">Ingrese la Información de Pago</b>
                                        </h5>
                                        <div class="form-group col-8 mx-auto">
                                            <label class="col-form-label text-right">Numero de Cuenta </label>
                                            <textarea class="form-control" name="h" id="v" rows="3" cols="50"
                                                readonly>Los pagos deben realizarse en el Banco de Venezuela a la Cuenta Corriente N° 01020552270000042877 a nombre del Servicio Nacional de Contrataciones RIF G-200024518. No se acepta el pago con cheques.</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-3">
                                                <label class="col-form-label text-right">Numero de Referencia </label>
                                                <input id="n_ref" name="n_ref" type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Banco Emisor <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <select style="width: 100%;" name="banco_e" id="banco_e"
                                                    class="default-select2 form-control">
                                                    <option value="">SELECCIONE</option>
                                                    <?php foreach ($bancos as $data): ?>
                                                        <option value="<?= $data['nombre_b'] ?>"><?= $data['nombre_b'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Banco Receptor <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <select style="width: 100%;" name="banco_rec" id="banco_rec"
                                                    class="default-select2 form-control">
                                                    <option value="">SELECCIONE</option>
                                                    <option value="BANCO DE VENEZUELA">BANCO DE VENEZUELA</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Fecha de la Transferencia <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="date" name="fecha_trans" id="fecha_trans"
                                                    max="<?= $time ?>">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Monto de la Transferencia <b title="Campo Obligatorio"
                                                        style="color:red">*</b></label>
                                                <input class="form-control" type="text" name="monto_trans" id="monto_trans"
                                                    onkeypress="return valideKey(event);">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row text-center mt-3">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit" id="btn_save_initial">Guardar
                                        Certificación Inicial</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url() ?>/js/certificacion/registro_cert_pn.js"></script>

        <div class="row mt-4" id="cert_details_section" style="display: none;">
            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title"><b>DETALLES DE LA CERTIFICACIÓN <span id="cert_id_display"></span></b>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <p><strong>Número de Comprobante:</strong> <span id="display_nro_comprobante"></span></p>
                        <p><strong>RIF:</strong> <span id="display_rif_cont"></span></p>
                        <p><strong>Nombre:</strong> <span id="display_nombre"></span></p>
                        <p><strong>Curso:</strong> <span id="display_objetivo"></span></p>

                        <hr>
                        <h5 class="text-center mb-3">**Agregar Información Adicional**</h5>
                        <div class="d-flex justify-content-around flex-wrap">
                            <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                data-target="#modalPersonaNatural">
                                <i class="fas fa-user"></i> Info. Persona Natural
                            </button>
                            <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                data-target="#modalFormacionProfesional">
                                <i class="fas fa-graduation-cap"></i> Formación Profesional
                            </button>
                            <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                data-target="#modalContratacionPublica">
                                <i class="fas fa-book"></i> Formación Contratación Pública
                            </button>
                            <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                data-target="#modalExperienciaComisiones">
                                <i class="fas fa-handshake"></i> Experiencia Comisiones
                            </button>
                            <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                data-target="#modalExperienciaDictado">
                                <i class="fas fa-chalkboard-teacher"></i> Experiencia Dictado
                            </button>
                            <button type="button" class="btn btn-sm btn-success m-1" onclick="confirmarDeclaracion()">
                                <i class="fas fa-check-circle"></i> Confirmar Declaración
                            </button>
                        </div>

                        <hr>
                        <div id="summary_tables_container">
                            <h5>Formación Profesional Agregada:</h5>
                            <table class="table table-bordered table-hover mt-2" id="table_formacion_prof">
                                <thead>
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
        </div>
    </div>

    <div class="modal fade" id="modalPersonaNatural" tabindex="-1" role="dialog"
        aria-labelledby="modalPersonaNaturalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPersonaNaturalLabel">Información de la Persona Natural</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_infor_per_natu">
                        <input type="hidden" name="cert_id_modal" id="cert_id_modal_pn">
                        <div class="form-group">
                            <label>Nombres y Apellidos</label>
                            <input type="text" class="form-control" name="nombre_ape_modal" id="nombre_ape_modal">
                        </div>
                        <div class="form-group">
                            <label>Cédula de Identidad</label>
                            <input type="text" class="form-control" name="cedula_modal" id="cedula_modal">
                        </div>
                        <div class="form-group">
                            <label>RIF</label>
                            <input type="text" class="form-control" name="rif_modal" id="rif_modal">
                        </div>
                        <div class="form-group">
                            <label>Alícuota IVA Estimado</label>
                            <select class="form-control" name="id_alicuota_iva_modal" id="id_alicuota_iva_modal">
                                <option value="">SELECCIONE</option>
                                <?php foreach ($inf_2 as $data): ?>
                                    <option value="<?= $data['desc_alicuota_iva'] ?>/<?= $data['desc_porcentaj'] ?>">
                                        <?= $data['desc_porcentaj'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tasa Bolívares</label>
                            <input type="text" class="form-control" name="bolivar_estimado_modal"
                                id="bolivar_estimado_modal" readonly>
                        </div>
                        <div class="form-group">
                            <label>IVA Estimado</label>
                            <input type="text" class="form-control" name="iva_estimado_modal" id="iva_estimado_modal"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Monto Total</label>
                            <input type="text" class="form-control" name="monto_estimado_modal"
                                id="monto_estimado_modal" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="saveInforPerNatu()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFormacionProfesional" tabindex="-1" role="dialog"
        aria-labelledby="modalFormacionProfesionalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormacionProfesionalLabel">Agregar Formación Profesional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_for_prof">
                        <input type="hidden" name="cert_id_modal_fp" id="cert_id_modal_fp">
                        <div class="form-group col-8">
                            <label>Formación Académica</label>
                            <select class="form-control" id="for_academica_modal" name="for_academica_modal">
                                <option value="Maestria">Maestria</option>
                                <option value="Licenciatura">Licenciatura</option>
                                <option value="Postgrado">Postgrado</option>
                                <option value="Superior">Superior</option>
                                <option value="Bachiller">Bachiller</option>
                                <option value="Especialización">Especialización</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Título Obtenido</label>
                            <input class="form-control" type="text" name="titulo_modal" id="titulo_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>Año de Inicio (aaaa)</label>
                            <input class="form-control" type="number" name="ano_modal" id="ano_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>Culminación (aaaa)</label>
                            <input class="form-control" type="text" name="culminacion_modal" id="culminacion_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>En Curso</label>
                            <select class="form-control" id="curso_modal" name="curso_modal">
                                <option value="">Seleccionar</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="addFormacionProfesional()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalContratacionPublica" tabindex="-1" role="dialog"
        aria-labelledby="modalContratacionPublicaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalContratacionPublicaLabel">Agregar Formación en Contratación Pública
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_for_mat_contr">
                        <input type="hidden" name="cert_id_modal_fmc" id="cert_id_modal_fmc">
                        <div class="form-group col-8">
                            <label>Taller o Curso</label>
                            <input class="form-control" type="text" name="taller_modal" id="taller_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>Institución</label>
                            <input class="form-control" type="text" name="institucion_modal" id="institucion_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>Horas de Duración</label>
                            <input class="form-control" type="number" name="hor_dura_modal" id="hor_dura_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>N.º del Certificado</label>
                            <input class="form-control" type="text" name="certi_modal" id="certi_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha Certificado</label>
                            <input class="form-control" type="date" name="fech_cert_modal" id="fech_cert_modal"
                                max="<?= $time ?>">
                        </div>
                        <div class="form-group col-4">
                            <label>Vigencia</label>
                            <input class="form-control" type="text" name="vigencia_modal" id="vigencia_modal" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="addFormacionContratacion()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExperienciaComisiones" tabindex="-1" role="dialog"
        aria-labelledby="modalExperienciaComisionesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExperienciaComisionesLabel">Agregar Experiencia en Comisiones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_exp_comi">
                        <input type="hidden" name="cert_id_modal_ec" id="cert_id_modal_ec">
                        <div class="form-group col-8">
                            <label>Órgano o Ente</label>
                            <input class="form-control" type="text" name="organo10_modal" id="organo10_modal">
                        </div>
                        <div class="form-group col-6">
                            <label>Acto Administrativo de Designación</label>
                            <select class="form-control" id="act_adminis_desid_modal" name="act_adminis_desid_modal">
                                <option value="Gaceta">Gaceta</option>
                                <option value="Providencia">Providencia</option>
                                <option value="Resolución">Resolución</option>
                                <option value="Punto de Cuenta">Punto de Cuenta</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>N° del Acto</label>
                            <input class="form-control" type="number" name="n_acto_modal" id="n_acto_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>Fecha</label>
                            <input class="form-control" type="date" name="fecha_act_modal" id="fecha_act_modal"
                                max="<?= $time ?>">
                        </div>
                        <div class="form-group col-6">
                            <label>Área</label>
                            <select class="form-control" id="area_10_modal" name="area_10_modal">
                                <option value="Legal">Legal</option>
                                <option value="Económica Financiera">Económica Financiera</option>
                                <option value="Técnica">Técnica</option>
                                <option value="Secretario">Secretario</option>
                                <option value="Secretaria">Secretaria</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Duración en la Comisión (tiempo)</label>
                            <input class="form-control" type="text" name="dura_comi_modal" id="dura_comi_modal">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="addExperienciaComisiones()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExperienciaDictado" tabindex="-1" role="dialog"
        aria-labelledby="modalExperienciaDictadoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExperienciaDictadoLabel">Agregar Experiencia en Dictado de
                        Capacitación
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_exp_dict">
                        <input type="hidden" name="cert_id_modal_ed" id="cert_id_modal_ed">
                        <div class="form-group col-8">
                            <label>Órgano o Ente</label>
                            <input class="form-control" type="text" name="organo3_modal" id="organo3_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>Actividad</label>
                            <input class="form-control" type="text" name="actividad3_modal" id="actividad3_modal">
                        </div>
                        <div class="form-group col-4">
                            <label>Desde</label>
                            <input class="form-control" type="date" name="desde3_modal" id="desde3_modal"
                                max="<?= $time ?>">
                        </div>
                        <div class="form-group col-4">
                            <label>Hasta</label>
                            <input class="form-control" type="date" name="hasta3_modal" id="hasta3_modal"
                                max="<?= $time ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="addExperienciaDictado()">Agregar</button>
                </div>
            </div>
        </div>
    </div>