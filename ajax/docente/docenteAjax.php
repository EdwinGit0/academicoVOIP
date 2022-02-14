<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['docente_id_up'])){

        /* Instancia al controlador */
        require_once "../../controlador/docente/controlador_docente.php";
        $ins_docente = new controlador_docente();

            /* actualizar un  docente */
        if(isset($_POST['docente_id_up'])){
            echo $ins_docente->actualizar_docente_controlador();
        }

    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }