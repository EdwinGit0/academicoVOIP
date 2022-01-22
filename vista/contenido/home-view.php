		<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; DASHBOARD
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
    </p>
</div>

<!-- Content -->
<div class="full-box tile-container">
    <?php 
            require_once "./controlador/controlador_alumno.php";
            $ins_alumno = new controlador_alumno();
            $total_alumno = $ins_alumno->datos_alumno_controlador("Conteo",0,$_SESSION['ua_id']); 
    ?>
    <a href="<?php echo SERVERURL; ?>alumno-list/" class="tile">
        <div class="tile-tittle">Alumnos</div>
        <div class="tile-icon">
            <i class="fas fa-user-graduate fa-fw"></i>
            <p><?php echo $total_alumno->rowCount(); ?> Registrados</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/controlador_padre.php";
            $ins_padre = new controlador_padre();
            $total_padre = $ins_padre->datos_padre_controlador("Conteo",0,$_SESSION['ua_id']); 
    ?>
    <a href="<?php echo SERVERURL; ?>padre-list/" class="tile">
        <div class="tile-tittle">Tutores</div>
        <div class="tile-icon">
            <i class="fas fa-users fa-fw"></i>
            <p><?php echo $total_padre->rowCount(); ?> Registrados</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/controlador_docente.php";
            $ins_docente = new controlador_docente();
            $total_docente = $ins_docente->datos_docente_controlador("Conteo",0,$_SESSION['ua_id']); 
    ?>
    <a href="<?php echo SERVERURL; ?>docente-list/" class="tile">
        <div class="tile-tittle">Docentes</div>
        <div class="tile-icon">
            <i class="fas fa-user-tie"></i>
            <p><?php echo $total_docente->rowCount(); ?> Registrados</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/controlador_curso.php";
            $ins_curso = new controlador_curso();
            $total_curso = $ins_curso->datos_curso_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>curso-list/" class="tile">
        <div class="tile-tittle">Cursos</div>
        <div class="tile-icon">
            <i class="fas fa-spell-check"></i>
            <p><?php echo $total_curso->rowCount(); ?> Registradas</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/controlador_periodo.php";
            $ins_periodo = new controlador_periodo();
            $total_periodo = $ins_periodo->datos_periodo_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>periodo-list/" class="tile">
        <div class="tile-tittle">Periodos</div>
        <div class="tile-icon">
            <i class="fas fa-layer-group"></i>
            <p><?php echo $total_periodo->rowCount(); ?> Registradas</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/controlador_area.php";
            $ins_area = new controlador_area();
            $total_area = $ins_area->datos_area_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>area-list/" class="tile">
        <div class="tile-tittle">Áreas</div>
        <div class="tile-icon">
            <i class="fas fa-book"></i>
            <p><?php echo $total_area->rowCount(); ?> Registradas</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/controlador_anio.php";
            $ins_anio = new controlador_anio();
            $total_anio = $ins_anio->datos_anio_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>anio-list/" class="tile">
        <div class="tile-tittle">Año académico</div>
        <div class="tile-icon">
            <i class="fas fa-tasks"></i>
            <p><?php echo $total_anio->rowCount(); ?>  Registradas</p>
        </div>
    </a>

    <?php 
        if($_SESSION['privilegio_sa']==1){
            require_once "./controlador/controlador_usuario.php";
            $ins_usuario = new controlador_usuario();
            $total_usuario = $ins_usuario->datos_usuario_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>user-list/" class="tile">
        <div class="tile-tittle">Administradores</div>
        <div class="tile-icon">
            <i class="fas fa-user-secret fa-fw"></i>
            <p><?php echo $total_usuario->rowCount(); ?> Registrados</p>
        </div>
    </a>
    <?php } ?>
    
    <a href="<?php echo SERVERURL; ?>company/" class="tile">
        <div class="tile-tittle">Establecimientos</div>
        <div class="tile-icon">
            <i class="fas fa-store-alt fa-fw"></i>
            <p>1 Registrada</p>
        </div>
    </a>
</div>