<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['anio_id_asig'])){

        /* Instancia al controlador */
        require_once "../../controlador/docente/controlador_anio.php";
        $ins_anio = new controlador_anio();

        /* asignar anio */
        if(isset($_POST['anio_id_asig'])){
            echo $ins_anio->asignar_anio_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
    }