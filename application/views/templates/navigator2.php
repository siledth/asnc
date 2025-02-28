<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand text-dark" href="<?php echo site_url('dashboard'); ?>">
            <span class="navbar-logo"><i style="color:darkred" class="fas fa-briefcase"></i>
                <b>SISINTSNC</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-dark" href="<?php echo site_url('dashboard'); ?>">Inicio</a>
                </li>

                <?php if($menu_rnce == 1): ?>
                <!-- Admin-only menu items -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="adminDropdown" role="button"
                        data-toggle="dropdown">
                        RNCE
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo site_url('logger_type_snc'); ?>">Gestión de
                            Usuarios</a>
                        <a class="dropdown-item" href="<?php echo site_url('perfiles'); ?>">Gestión de Perfiles</a>
                        <a class="dropdown-item" href="<?php echo site_url('configuracion'); ?>">Configuración</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="adminDropdown" role="button"
                        data-toggle="dropdown">
                        RNC
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo site_url('usuarios'); ?>">Gestión de Usuarios</a>
                        <a class="dropdown-item" href="<?php echo site_url('perfiles'); ?>">Gestión de Perfiles</a>
                        <a class="dropdown-item" href="<?php echo site_url('configuracion'); ?>">Configuración</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="adminDropdown" role="button"
                        data-toggle="dropdown">
                        CPC
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo site_url('usuarios'); ?>">Gestión de Usuarios</a>
                        <a class="dropdown-item" href="<?php echo site_url('perfiles'); ?>">Gestión de Perfiles</a>
                        <a class="dropdown-item" href="<?php echo site_url('configuracion'); ?>">Configuración</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="adminDropdown" role="button"
                        data-toggle="dropdown">
                        Configuración
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo site_url('usuarios'); ?>">Gestión de Usuarios</a>
                        <a class="dropdown-item" href="<?php echo site_url('perfiles'); ?>">Gestión de Perfiles</a>
                        <a class="dropdown-item" href="<?php echo site_url('configuracion'); ?>">Configuración</a>
                    </div>
                </li>
                <?php endif; ?>

                <!-- Common menu items -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo site_url('reportes'); ?>">Reportes</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown">
                        <i class="fas fa-user mr-1"></i> <?php echo $username; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo site_url('perfil'); ?>">Mi Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo site_url('auth/logout'); ?>">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>