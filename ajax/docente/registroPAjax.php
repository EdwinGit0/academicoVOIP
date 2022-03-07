<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['curso_id_referencial']) || isset($_POST['curso_id_periodo'])
     || isset($_POST['curso_id_resumen'])){

        /* Instancia al controlador */
        require_once "../../controlador/docente/controlador_registroP.php";
        $ins_cuadernoP = new controlador_registroP();

        /**------------------------------------- ALUMNO -------------------------------------- */
        /* agregar tabla datos referenciales */
        if(isset($_POST['curso_id_referencial'])){
            echo $ins_cuadernoP->referencial_curso_controlador();
        }

        /* agregar tabla del periodo */
        if(isset($_POST['curso_id_periodo'])){
            echo $ins_cuadernoP->tabla_periodo_controlador();
        }

        /* resumen cuadro pedagogico */
        if(isset($_POST['curso_id_resumen'])){
            echo $ins_cuadernoP->resumen_cuadroP_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
    }