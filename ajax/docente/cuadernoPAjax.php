<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['curso_id_referencial'])){

        /* Instancia al controlador */
        require_once "../../controlador/docente/controlador_cuadernoP.php";
        $ins_cuadernoP = new controlador_cuadernoP();

        /**------------------------------------- ALUMNO -------------------------------------- */
        /* agregar tabla alumnos cursos */
        if(isset($_POST['curso_id_referencial'])){
            echo $ins_cuadernoP->referencial_curso_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
    }