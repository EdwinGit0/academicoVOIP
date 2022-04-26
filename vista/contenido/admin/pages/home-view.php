		<!-- Page header -->
<div class="full-box page-header mb-0 y pb-0" >
    <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; DASHBOARD
    </h3>
</div>
<div class="full-box page-header-next">
<h5>
        <div class="input-group">
            <strong>Tu último acceso es:</strong>
            <span class="input-group-addon">&nbsp;</span>
            <div id="date" ></div>
        </div>
    </h5>			
    <?php
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        function getBrowser($user_agent){
            if(strpos($user_agent, 'MSIE') !== FALSE)
                return 'Internet explorer';
            elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
                return 'Microsoft Edge';
            elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
                return 'Internet explorer';
            elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
                return "Opera Mini";
            elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
                return "Opera";
            elseif(strpos($user_agent, 'Firefox') !== FALSE)
                return 'Mozilla Firefox';
            elseif(strpos($user_agent, 'Chrome') !== FALSE)
                return 'Google Chrome';
            elseif(strpos($user_agent, 'Safari') !== FALSE)
                return "Safari";
            else
                return 'No hemos podido detectar su navegador';
        }
        $navegador = getBrowser($user_agent);
        echo "<strong>Navegador</strong>: ".$navegador;
    ?>
</div>

<!-- Content -->
<div class="full-box tile-container">
    <?php 
            require_once "./controlador/admin/controlador_alumno.php";
            $ins_alumno = new controlador_alumno();
            $total_alumno = $ins_alumno->datos_alumno_controlador("Conteo",0,$_SESSION['ua_id']); 
    ?>
    <a href="<?php echo SERVERURL; ?>admin/alumno-list/" class="tile">
        <div class="tile-tittle">Alumnos</div>
        <div class="tile-icon">
            <i class="fas fa-user-graduate fa-fw"></i>
            <p><?php echo $total_alumno->rowCount(); unset($total_alumno);?> Registrados</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/admin/controlador_padre.php";
            $ins_padre = new controlador_padre();
            $total_padre = $ins_padre->datos_padre_controlador("Conteo",0,$_SESSION['ua_id']); 
    ?>
    <a href="<?php echo SERVERURL; ?>admin/padre-list/" class="tile">
        <div class="tile-tittle">Tutores</div>
        <div class="tile-icon">
            <i class="fas fa-users fa-fw"></i>
            <p><?php echo $total_padre->rowCount(); unset($total_padre);?> Registrados</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/admin/controlador_docente.php";
            $ins_docente = new controlador_docente();
            $total_docente = $ins_docente->datos_docente_controlador("Conteo",0,$_SESSION['ua_id']); 
    ?>
    <a href="<?php echo SERVERURL; ?>admin/docente-list/" class="tile">
        <div class="tile-tittle">Docentes</div>
        <div class="tile-icon">
            <i class="fas fa-user-tie"></i>
            <p><?php echo $total_docente->rowCount(); unset($total_docente);?> Registrados</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/admin/controlador_curso.php";
            $ins_curso = new controlador_curso();
            $total_curso = $ins_curso->datos_curso_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>admin/curso-list/" class="tile">
        <div class="tile-tittle">Cursos</div>
        <div class="tile-icon">
            <i class="fas fa-spell-check"></i>
            <p><?php echo $total_curso->rowCount(); unset($total_curso);?> Registradas</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/admin/controlador_periodo.php";
            $ins_periodo = new controlador_periodo();
            $total_periodo = $ins_periodo->datos_periodo_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>admin/periodo-list/" class="tile">
        <div class="tile-tittle">Periodos</div>
        <div class="tile-icon">
            <i class="fas fa-layer-group"></i>
            <p><?php echo $total_periodo->rowCount(); unset($total_periodo);?> Registradas</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/admin/controlador_area.php";
            $ins_area = new controlador_area();
            $total_area = $ins_area->datos_area_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>admin/area-list/" class="tile">
        <div class="tile-tittle">Áreas</div>
        <div class="tile-icon">
            <i class="fas fa-book"></i>
            <p><?php echo $total_area->rowCount(); unset($total_area);?> Registradas</p>
        </div>
    </a>

    <?php 
            require_once "./controlador/admin/controlador_anio.php";
            $ins_anio = new controlador_anio();
            $total_anio = $ins_anio->datos_anio_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>admin/anio-list/" class="tile">
        <div class="tile-tittle">Año académico</div>
        <div class="tile-icon">
            <i class="fas fa-tasks"></i>
            <p><?php echo $total_anio->rowCount(); unset($total_anio);?>  Registradas</p>
        </div>
    </a>

    <?php 
        if($_SESSION['privilegio_sa']==1){
            require_once "./controlador/admin/controlador_usuario.php";
            $ins_usuario = new controlador_usuario();
            $total_usuario = $ins_usuario->datos_usuario_controlador("Conteo",0); 
    ?>
    <a href="<?php echo SERVERURL; ?>admin/user-list/" class="tile">
        <div class="tile-tittle">Administradores</div>
        <div class="tile-icon">
            <i class="fas fa-user-secret fa-fw"></i>
            <p><?php echo $total_usuario->rowCount(); unset($total_usuario);?> Registrados</p>
        </div>
    </a>
    <?php } ?>
    
    <a href="<?php echo SERVERURL; ?>admin/company/" class="tile">
        <div class="tile-tittle">Establecimientos</div>
        <div class="tile-icon">
            <i class="fas fa-store-alt fa-fw"></i>
            <p>1 Registrada</p>
        </div>
    </a>
</div>

<script src="<?php echo SERVERURL;?>vista/js/star-time.js" ></script>


