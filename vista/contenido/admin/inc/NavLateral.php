    <section class="full-box nav-lateral">
        <div class="full-box nav-lateral-bg show-nav-lateral"></div>
        <div class="full-box nav-lateral-content">
            <figure class="full-box nav-lateral-avatar">
                <i class="far fa-times-circle show-nav-lateral"></i>
                <img src="<?php echo SERVERURL;?>vista/assets/avatar/Avatar.png" class="img-fluid" alt="Avatar">
                <figcaption class="roboto-medium text-center">
                    <?php echo $_SESSION['nombre_sa']." ".$_SESSION['apellidoP_sa']." ".$_SESSION['apellidoM_sa']; ?> <br><small class="roboto-condensed-light"><?php echo $_SESSION['correo_sa'];?></small>
                </figcaption>
            </figure>
            <div class="full-box nav-lateral-bar"></div>
            <nav class="full-box nav-lateral-menu">
                <ul>
                    <li>
                        <a href="<?php echo SERVERURL; ?>admin/home/"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Dashboard</a>
                    </li>

                    <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; Alumno <i class="fas fa-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a href="<?php echo SERVERURL; ?>admin/alumno-list/"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; Alumno</a>
                            </li>
                            <li>
                                <a href="<?php echo SERVERURL; ?>admin/padre-list/"><i class="fas fa-users fa-fw"></i> &nbsp; Tutor</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-user-tie"></i> &nbsp; Docente <i class="fas fa-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a href="<?php echo SERVERURL; ?>admin/docente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Docente</a>
                            </li>
                            <li>
                                <a href="<?php echo SERVERURL; ?>admin/docente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Docentes</a>
                            </li>
                            <li>
                                <a href="<?php echo SERVERURL; ?>admin/docente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Docente</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-university"></i> &nbsp; Académico <i class="fas fa-chevron-down"></i></a>
                        <ul>
                        <li>
                            <a href="<?php echo SERVERURL; ?>admin/curso-list/"><i class="fas fa-spell-check"></i> &nbsp; Curso</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>admin/periodo-list/"><i class="fas fa-layer-group"></i> &nbsp; Periodo</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>admin/area-list/"><i class="fas fa-book"></i> &nbsp; Área</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL; ?>admin/anio-list/"><i class="fas fa-tasks"></i> &nbsp; Año académico</a>
                        </li>
                        </ul>
                    </li>

                    <?php if($_SESSION['privilegio_sa']==1){?>
                    <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas  fa-user-secret fa-fw"></i> &nbsp; Administrador <i class="fas fa-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a href="<?php echo SERVERURL; ?>admin/user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo administrador</a>
                            </li>
                            <li>
                                <a href="<?php echo SERVERURL; ?>admin/user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de administradores</a>
                            </li>
                            <li>
                                <a href="<?php echo SERVERURL; ?>admin/user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar administrador</a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                        } 
                        
                        if($_SESSION['privilegio_sa']==1 || $_SESSION['privilegio_sa']==2){
                    ?>

                    <li>
                        <a href="<?php echo SERVERURL; ?>admin/company/"><i class="fas fa-store-alt fa-fw"></i> &nbsp; Establecimiento educativo</a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </section>