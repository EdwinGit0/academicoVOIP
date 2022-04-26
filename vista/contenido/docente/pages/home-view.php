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

    <a href="<?php echo SERVERURL; ?>docente/gestion-academico/" class="tile">
        <div class="tile-tittle">Año académico</div>
        <div class="tile-icon">
            <i class="fas fa-tasks"></i>
            <p><?php echo $_SESSION['anio_academico']; ?></p>
        </div>
    </a>

    <?php 
        require_once "./controlador/docente/controlador_cuadernoP.php";
        $ins_cuadernoP = new controlador_cuadernoP();
        $total_cuadernoP = $ins_cuadernoP->cursos_asignadosCP_controlador(); 
    ?>
    <a href="<?php echo SERVERURL; ?>docente/pedagogico-cuaderno/" class="tile">
        <div class="tile-tittle">Cuaderno pedagógico </div>
        <div class="tile-icon">
            <i class="fas fa-book"></i>
            <p><?php echo $total_cuadernoP;?> Cursos Asignadas</p>
        </div>
    </a>

    <?php 
        require_once "./controlador/docente/controlador_registroP.php";
        $ins_cuadernoP = new controlador_registroP();
        $total_cuadernoP = $ins_cuadernoP->cursos_asignadosRP_controlador(); 
    ?>
    <a href="<?php echo SERVERURL; ?>docente/pedagogico-registro/" class="tile">
        <div class="tile-tittle">Registro pedagógico </div>
        <div class="tile-icon">
            <i class="fas fa-book"></i>
            <p><?php echo $total_cuadernoP;?> Cursos Asignadas</p>
        </div>
    </a>
 
</div>

<script src="<?php echo SERVERURL;?>vista/js/star-time.js" ></script>


