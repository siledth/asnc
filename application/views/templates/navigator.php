<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <div id="header" class="header navbar-default">
        <div class="navbar-header">
            <a href="." class="navbar-brand"><span class="navbar-logo"><i style="color:darkred"
                        class="fas fa-briefcase"></i></span> <b>Sistema Integrado</b> SNC</a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <ul class="navbar-nav navbar-right">
            <li></li>
            <li class="dropdown"></li>
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url() ?>Plantilla/admin/assets/img/user/user-13.jpg" alt="" />
                    <span class="d-none d-md-inline"><?= $this->session->userdata('nombre') ?></span>
                    <b class="caret"></b>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="<?= base_url() ?>index.php/login/logout" class="dropdown-item">Cerrar Sesión</a>
                    <a href="<?= base_url() ?>index.php/login/v_camb_clave" class="dropdown-item">Cambio de
                        Contraseña</a>
                    <a href="<?= base_url() ?>index.php/perfilinstitucional" class="dropdown-item">Perfil
                        Intitucional</a>

                </div>
            </li>
        </ul>
    </div>

    <div id="sidebar" class="sidebar">
        <div data-scrollbar="true" data-height="100%">
            <ul class="nav">
                <li class="nav-profile">
                    <a href="javascript:;" data-toggle="nav-profile">
                        <div class="cover with-shadow"></div>
                        <div class="image text-center ml-5">
                            <img src="<?= base_url() ?>Plantilla/admin/assets/img/user/user-13.jpg" alt="" />
                        </div>
                        <div class="info ml-5">
                            <b class=""></b>
                            <?= $this->session->userdata('nombre') ?>
                            <small>Bienvenido</small>
                        </div>
                    </a>
                </li>
                <!-- <li>
                        <ul class="nav nav-profile">
                                <li><a href="javascript:;"><i class="ion-ios-cog"></i> Settings</a></li>
                                <li><a href="javascript:;"><i class="ion-ios-share-alt"></i> Send Feedback</a></li>
                                <li><a href="javascript:;"><i class="ion-ios-help"></i> Helps</a></li>
                        </ul>
                </li> -->
            </ul>
            <ul class="nav">
                <li class="nav-header">Navegador</li>
                <?php if (($this->session->userdata('menu_rnce') == 1)) : ?>


                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fas fa-sliders-h" style="background:darkred;"></i>
                        <span>RNCE</span>
                    </a>


                    <ul class="sub-menu">
                        <?php if (($this->session->userdata('menu_progr') == 1)) : ?>

                        <li class="has-sub">
                            <?php if (($this->session->userdata('rif_organoente') == "G200024518")) : ?>
                            <a href="javascript:;">
                                <b class="caret"></b>
                                <span>Comisión de contrataciones</span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?= base_url() ?>index.php/Comision_contrata/logger_type_snc">-
                                        Registro por SNC</a></li>
                                <li><a href="<?= base_url() ?>index.php/Comision_contrata/certificadosnc">-
                                        Certificar por SNC</a></li>

                                <li><a href="<?= base_url() ?>index.php/Comision_contrata/logger_type_c">-
                                        Notificaciòn al SNC</a></li>


                                <li><a href="<?= base_url() ?>index.php/Comision_contrata/certificado">-
                                        Certificar Miembros</a></li>
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        <span>Consultas</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a
                                                href="<?= base_url() ?>index.php/Comision_contrata/logger_type_sncinactivo">
                                                - Consulta Comisiones Inactivas
                                            </a>

                                        </li>
                                        <li>
                                            <a
                                                href="<?= base_url() ?>index.php/Comision_contrata/logger_type_sncactivo">
                                                - Consulta Comisiones Activas
                                            </a>

                                        </li>


                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        <span>Estatus Miembros</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a
                                                href="<?= base_url() ?>index.php/Comision_contrata/logger_type_snc_vencidos">
                                                - Consulta certificado miembros vencidos
                                            </a>

                                        </li>
                                        <li>
                                            <a
                                                href="<?= base_url() ?>index.php/Comision_contrata/logger_type_snc_condicionado">
                                                - Consulta certificado miembros condicionados
                                            </a>

                                        </li>
                                        <li>
                                            <a
                                                href="<?= base_url() ?>index.php/Comision_contrata/logger_type_snc_certificados">
                                                - Consulta certificado miembros Certificado
                                            </a>

                                        </li>



                                    </ul>
                                </li>

                            </ul>
                            <?php endif; ?>

                            <a href="javascript:;">
                                <b class="caret"></b>
                                <span>Programación</span>
                            </a>
                            <?php endif; ?>
                            <ul class="sub-menu">
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        <span>Programaciòn Anual</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="<?= base_url() ?>index.php/programacion">
                                                - Programación Anual
                                            </a>

                                        </li>

                                        <li>
                                            <a href="<?= base_url() ?>index.php/programacion/reprogramar">
                                                - Modificaciòn-Programación Anual
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/programacion/rendiciones">
                                                - Rendición
                                            </a>
                                        </li>
                                        <?php if (($this->session->userdata('menu_noregi_eval_desem') == 1)) : ?>

                                        <!-- <li>
                                            <a href="<?= base_url() ?>index.php/Auth_prog/requests_prog">
                                                - Solicitar Editar Programaciòn Anual
                                            </a>

                                        </li>
                                        <li><a href="<?= base_url() ?>index.php/Auth_prog/see_prog">-
                                                Autorizar Editar <b>Programaciòn Anual</b></a></li> -->
                                        <?php endif; ?>

                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        <span>Consultas</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sending_rendiciones_1">
                                                - Consulta Rendiciones Notificadas Primer Trimestre
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sending_rendiciones_2">
                                                - Consulta Rendiciones Notificadas Segundo Trimestre
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sending_rendiciones_3">
                                                - Consulta Rendiciones Notificadas Tercer Trimestre
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sending_rendiciones_4">
                                                - Consulta Rendiciones Notificadas Cuarto Trimestre
                                            </a>
                                        </li>
                                        <?php if (($this->session->userdata('rif_organoente') == "G200024518")) : ?>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sending_p">
                                                - Consulta Programación Enviada
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if (($this->session->userdata('rif_organoente') == "G200024518")) : ?>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sending_upd">
                                                - Consulta Modificaciones Enviada
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if (($this->session->userdata('rif_organoente') == "G200024518")) : ?>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sending_rend">
                                                - Consulta Rendiciones Enviada
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (($this->session->userdata('pdvsa') == 1)) : ?>

                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sending_pdvsa">
                                                - Programaciones enviada PDVSA
                                            </a>

                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/sendig_upd_pdvsa">
                                                - Programaciones Modificadas Según Ley enviada PDVSA
                                            </a>

                                        </li>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Programacion/senrendi_pdvsa">
                                                - Rendiciones enviadas de PDVSA
                                            </a>

                                        </li>

                                        <?php endif; ?>
                                        <?php if (($this->session->userdata('menu_noregi_eval_desem') == 1)) : ?>

                                        <!-- <li>
                                            <a href="<?= base_url() ?>index.php/Auth_prog/requests_prog">
                                                - Solicitar Editar Programaciòn Anual
                                            </a>

                                        </li>
                                        <li><a href="<?= base_url() ?>index.php/Auth_prog/see_prog">-
                                                Autorizar Editar <b>Programaciòn Anual</b></a></li> -->
                                        <?php endif; ?>

                                    </ul>
                                </li>

                                <?php if (($this->session->userdata('ver_user_exter') == 1)) : ?>
                                <!-- <li>
                                    <a href="<?= base_url() ?>index.php/Programacion/consulta_general">
                                        - Programación General
                                    </a>
                                </li> -->
                                <?php endif; ?>



                            </ul>
                        </li>
                        <?php if (($this->session->userdata('menu_eval_desem') == 1)) : ?>
                        <li class="has-sub">

                            <a href="javascript:;">
                                <b class="caret"></b>
                                <span>Evaluación de</span>
                                <span class="ml-1">Desempeño</span>
                            </a>
                            <ul class="sub-menu">
                                <?php if (($this->session->userdata('rif_organoente') == "G200024518")) : ?>
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        SNC
                                    </a>
                                    <ul class="sub-menu">

                                        <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio/registro_snc">-
                                                Registrar Evalu. SNC</a></li>


                                        <li><a href="<?= base_url() ?>index.php/Evaluacion_desempenio/consultar_snc">-
                                                Listar Eval.</a></li>

                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if (($this->session->userdata('menu_reg_eval_desem') == 1)) : ?>
                                <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio">Registrar</a></li>
                                <?php endif; ?>
                                <?php if (($this->session->userdata('menu_anulacion') == 1)) : ?>
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        Anulación
                                    </a>
                                    <ul class="sub-menu">
                                        <?php if (($this->session->userdata('menu_soli_anular_eval_desem') == 1)) : ?>
                                        <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio/anulacion">- Sol.
                                                Anulación</a></li>
                                        <?php endif; ?>
                                        <?php if (($this->session->userdata('menu_proc_anular_eval_desem') == 1)) : ?>
                                        <li><a href="<?= base_url() ?>index.php/Evaluacion_desempenio/proc_anulacion">-
                                                Proc. Anulaciones</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if (($this->session->userdata('menu_repor_evalu') == 1)) : ?>

                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        Reportes
                                    </a>
                                    <ul class="sub-menu">
                                        <?php if (($this->session->userdata('menu_comprobante_eval_desem') == 1)) : ?>
                                        <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio/reporte">-
                                                Comprobante Registro</a></li>
                                        <?php endif; ?>
                                        <?php if (($this->session->userdata('menu_estdi_eval_desem') == 1)) : ?>
                                        <li><a href="<?= base_url() ?>index.php/evaluacion_desempenio/consulta">-
                                                Estadistica</a></li>
                                        <?php endif; ?>
                                        <?php if (($this->session->userdata('menu_noregi_eval_desem') == 1)) : ?>
                                        <li><a
                                                href="<?= base_url() ?>index.php/Evaluacion_desempenio/estatus_contratista">-
                                                Comprobante de Empresa <b>NO REGISTRADA</b></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if (($this->session->userdata('menu_llamado') == 1)) : ?>
                        <li class="has-sub">
                            <a href="javascript:;">
                                <b class="caret"></b>
                                <span>Llamado a Concurso</span>
                            </a>
                            <ul class="sub-menu">
                                <?php if (($this->session->userdata('consultar_llamado') == 1)) : ?>

                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        - Consultar
                                    </a>
                                    <ul class="sub-menu">

                                        <!-- <li><a href="<?= base_url() ?>index.php/llamadoconcurso">-
                                                Consultar ant</a></li> -->
                                        <li><a href="<?= base_url() ?>index.php/Publicaciones/llamadointerno">-
                                                Consultar nuevo</a></li>
                                        <li><a href="<?= base_url() ?>index.php/Publicaciones/rp_estatus">-
                                                Histórico Procesos asociados al Llamado a Concursoo</a></li>
                                        <?php if (($this->session->userdata('ver_anul_llamado') == 1)) : ?>
                                        <li><a href="<?= base_url() ?>index.php/Publicaciones/anulaciones_general">-Anulaciones
                                                General</b></a></li>
                                        <li>
                                            <a href="<?= base_url() ?>index.php/Publicaciones/Accion2_snc">-Consultar
                                                Acciones al Final de
                                                LLamados a Concurso</a>
                                        </li>
                                        <?php endif; ?>




                                    </ul>
                                </li>

                                <?php endif; ?>
                                <?php if (($this->session->userdata('reg_llamado') == 1)) : ?>
                                <li>
                                    <a href="<?= base_url() ?>index.php/regllamadoconcurso">
                                        - Registro llamado a consurso
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if (($this->session->userdata('anul_llamado') == 1)) : ?>
                                <li>
                                    <a href="<?= base_url() ?>index.php/Publicaciones/anulacion">-Procesos asociados al
                                        Llamado a Concurso </a>
                                </li>


                                <?php endif; ?>
                                <?php if (($this->session->userdata('accion_llamado') == 1)) : ?>

                                <li>
                                    <a href="<?= base_url() ?>index.php/Publicaciones/acciones">-Acciones
                                        Llamado a Concurso </a>
                                </li>
                                <?php endif; ?>

                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if (($this->session->userdata('certificacion') == 1)) : ?>

                        <?php endif; ?>
                        <?php if (($this->session->userdata('ver_conf') == 8)) : ?>


                        <?php endif; ?>

                </li>

            </ul>
            </li>
            <?php endif; ?>
            <?php if (($this->session->userdata('ver_rnc') == 1)) : ?>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-server" style="background:darkred;"></i>
                    <span>RNC</span>
                </a>
                <ul class="sub-menu">
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <span>Consulta de Contratista</span>
                        </a>
                        <ul class="sub-menu">

                            <li><a href="<?= base_url() ?>index.php/Contratista/infor_contratista">- Planilla
                                    Resumen</a></li>
                            <li><a href="<?= base_url() ?>index.php/Contratista/infor_contrat_nombre">- Planilla
                                    Resumen por Nombre</a></li>
                            <li><a href="<?= base_url() ?>index.php/Contratista/infor_contrat_objCont">- Busqueda de
                                    Contratista</a></li>
                            <?php if (($this->session->userdata('rif_organoente') == "G200024518")) : ?>
                            <li><a href="<?= base_url() ?>index.php/Contratista/infor_contrat_comi_conta">-Consulta de
                                    Contratistas por Comisario o Contador por número de Cédula</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                </ul>

            </li>
            <?php endif; ?>

            <?php if (($this->session->userdata('menu_certi') == 1)) : ?>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-paste fa-lg" style="background:darkred;"></i>
                    <span>CCP</span>
                </a>
                <ul class="sub-menu">
                    <li class="has-sub">
                        <a href="javascript:;">
                        </a>
                        <?php if (($this->session->userdata('certificacion') == 1)) : ?>
                    <li class="has-sub">
                    <li><a href="<?= base_url() ?>index.php/certificacion/Listado_certificacion"><i
                                class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>Solicitud de
                            Certificación de Privado</a>
                    </li>
                    <li><a href="<?= base_url() ?>index.php/certificacion/ver_facilitador"><i
                                class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>Facilitador</a>
                    </li>
                    <li>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('certi_externo') == 1)) : ?>
                    <li class="has-sub">
                    <li><a href="<?= base_url() ?>index.php/certificacion/Listado_certificacion_exter"><i
                                class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>Certificación de Privado</a>
                    </li>
                    <li><a href="<?= base_url() ?>index.php/certificacion/ver_facilitador"><i
                                class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>Facilitador</a>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('certificacion') == 1)) : ?>

                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            Reportes
                        </a>
                        <ul class="sub-menu">

                            <li><a href="<?= base_url() ?>index.php/certificacion/Consulta_certificacion"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i> General </a>
                            </li>

                            <li><a href="<?= base_url() ?>index.php/certificacion/fecha_vencimiento"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>Fecha de vencimiento </a>
                            </li>
                            <li><a href="<?= base_url() ?>index.php/certificacion/status"><i
                                        class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>Estatus </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>
            </li>
            </ul>

            </li>
            <?php endif; ?>
            <?php if (($this->session->userdata('ver_conf') == 1)) : ?>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="ion-gear-b fa-spin" style="background:darkred;"></i>
                    <span>Configuración</span>
                </a>

                <ul class="sub-menu">

                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            Entes
                        </a>
                        <ul class="sub-menu">
                            <li class="has-sub">
                            <li>
                                <a href="<?= base_url() ?>index.php/configuracion/orga">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-landmark"></i>Organo
                                </a>
                            </li>


                            <li>
                                <a href="<?= base_url() ?>index.php/configuracion/ent">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-building"></i>Entes
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url() ?>index.php/configuracion/entes_adscrito">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-city"></i>Entes Adscritos
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>index.php/configuracion/filiares">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-city"></i>Unidades Ejecutoras locales
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>index.php/configuracion/list">
                                    <i class="fas fa-lg fa-fw m-r-10 fa-city"></i>Listado
                                </a>
                            </li>
                    </li>
                </ul>
            </li>
            <?php endif; ?>

            <?php if (($this->session->userdata('ver_parametro') == 1)) : ?>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <span>Tablas Parametros</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= base_url() ?>index.php/Certificacion/registrar_exonerado">
                            - Exonerados
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/index">
                            - Fuente de Financiamiento
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/alicuotaiva">
                            - Alicuota
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/registrar_pa">
                            - Partida Presupuestaria
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/centra">
                            - Acción Centralizada
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/und">
                            - Unidad de Medida
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/ccnu">
                            - CCNU
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/diasferiados">
                            - Dias Feriados
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/estado">
                            - Estado
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/municipio">
                            - Municipio
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/parroquia">
                            - Parroquia
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/ciudades">
                            - Ciudades
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/operador">
                            - Operadora
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/proce">
                            - Procedimiento Selección de Contratista
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/supuestos">
                            - Supuestos de Procedimientos
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/edocivil">
                            - Estado Civil
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Fuentefinanc/Casificacion">
                            - Clasificación
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Tablas_com/registrar_cm">
                            - Nivel Academico
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Tablas_com/actoadmin">
                            - Acto Administrativo
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Tablas_com/area_mb">
                            - Area Miembros
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Tablas_com/estatus_mb">
                            - Estatus Miembros Certificado
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if (($this->session->userdata('ver_conf_publ') == 1)) : ?>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <span>Configuración de Públicaciones</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= base_url() ?>index.php/Publicaciones/banco">
                            - Banco
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Publicaciones/tipo_cuenta">
                            - Tipo de Cuenta
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Publicaciones/datosbancarios">
                            - Datos Bancarios
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Publicaciones/modalidad">
                            - Modalidad
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Publicaciones/mecanismo">
                            - Mécanismo
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/Publicaciones/actividad">
                            - Actividad
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/gestionlapsos">
                            - Gestion: Lapsos
                        </a>
                    </li>

                </ul>
            </li>
            <?php endif; ?>

            <?php if (($this->session->userdata('ver_user') == 1)) : ?>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>

                    <span>Usuarios</span>
                </a>
                <ul class="sub-menu">
                    <?php if (($this->session->userdata('ver_user_exter') == 1)) : ?>
                    <!-- <li>
                            <a href="<?= base_url() ?>index.php/user">
                                <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Registros
                            </a>
                        </li> -->


                    <!-- <li>
                        <a href="<?= base_url() ?>index.php/user/int">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Registros Usuarios
                        </a>
                    </li> -->
                    <li>
                        <a href="<?= base_url() ?>index.php/user/create_user">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Registro Usuarios
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('ver_user_desb') == 1)) : ?>
                    <li>
                        <a href="<?= base_url() ?>index.php/user/bloquear_usuario">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Inhabilitar Usuarios
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('ver_user_desb') == 1)) : ?>
                    <li>
                        <a href="<?= base_url() ?>index.php/user/desblo_usuario">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Desbloqueo de Usuarios
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('ver_user_lista') == 1)) : ?>
                    <li>
                        <a href="<?= base_url() ?>index.php/user/modif_usuarios">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Lista Usuarios SNC activos
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('ver_user_lista') == 1)) : ?>
                    <li>
                        <a href="<?= base_url() ?>index.php/user/lista_user_inactivos_snc">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Lista Usuarios SNC inactivos
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('ver_user_lista') == 1)) : ?>
                    <li>
                        <a href="<?= base_url() ?>index.php/user/listado_usuarios">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Lista Usuarios externos
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('ver_user_perfil') == 1)) : ?>
                    <li>
                        <a href="<?= base_url() ?>index.php/user/perfil_">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Perfiles
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('ver_user_perfil') == 1)) : ?>
                    <li>
                        <a href="<?= base_url() ?>index.php/User/see_ses">
                            <i class="fas fa-lg fa-fw m-r-10 fa-list-alt"></i>- Sesiones Abiertas
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>

            </ul>
            </li>

            <?php endif; ?>

            <li class="mt-5"><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="ion-ios-arrow-back"></i> <span>Cerrar Navegador</span></a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar-bg"></div>