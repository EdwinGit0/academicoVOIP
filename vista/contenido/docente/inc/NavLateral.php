    <section class="full-box nav-lateral">
        <div class="full-box nav-lateral-bg show-nav-lateral"></div>
        <div class="full-box nav-lateral-content">
            <figure class="full-box nav-lateral-avatar">
                <i class="far fa-times-circle show-nav-lateral"></i>
                <img src="<?php echo SERVERURL;?>vista/assets/avatar/Avatar.png" class="img-fluid" alt="Avatar">
                <figcaption class="roboto-medium text-center">
                    <?php echo $_SESSION['nombre_sa']." ".$_SESSION['apellidoP_sa']." ".$_SESSION['apellidoM_sa']; ?> <br><small class="roboto-condensed-light"><?php echo $_SESSION['correo_sa'];?></small>
                </figcaption>
                <figcaption class="roboto-medium text-center">
                    <?php
                        require_once "./controlador/admin/controlador_educativo.php";
                        $ins_educativo = new controlador_educativo();
                        $datos_educativo = $ins_educativo->datos_educativo_alumno_controlador(main_model::encryption($_SESSION['ua_id']));
                        if($datos_educativo->rowCount()==1){
                            $campos_educativo = $datos_educativo->fetch();
                        ?>
                        
                        <small class="roboto-condensed-light"><?php echo $campos_educativo['NOMBRE_UA'];?> - <?php echo $_SESSION['anio_academico']; ?></small>

                        <?php }else{ ?>

                            <div class="alert alert-warning text-center" role="alert">
                                <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                                <h4 class="alert-heading">¡Usted no pertenece a un Establecimiento educativo!</h4>
                                <p class="mb-0">Comuniquese con su administrador</p>
                            </div>

                        <?php } ?>
                </figcaption>
            </figure>
            <div class="full-box nav-lateral-bar"></div>
            <nav class="full-box nav-lateral-menu">
                <ul>
                    <li>
                        <a href="<?php echo SERVERURL; ?>docente/home/"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Dashboard</a>
                    </li>

                    <li>
                        <a href="<?php echo SERVERURL; ?>docente/gestion-academico/"><i class="fas fa-tasks"></i> &nbsp; Gestión académico</a>
                    </li>

                    <li>
                        <a href="#" class="nav-btn-submenu"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; Calificación <i class="fas fa-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a href="<?php echo SERVERURL; ?>docente/pedagogico-cuaderno/"><i class="fas fa-book"></i> &nbsp; Cuaderno pedagógico</a>
                            </li>
                            <li>
                                <a href="<?php echo SERVERURL; ?>docente/pedagogico-registro/"><i class="fas fa-book"></i> &nbsp; Registro pedagógico</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo SERVERURL; ?>docente/calendar/"><i class="fas fa-calendar"></i> &nbsp; Agenda de conferencias</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>