<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['agenda_titulo_reg']) || isset($_POST['agenda_id_reg']) || isset($_POST['agenda_id_del'])){

        /* Instancia al controlador */
        require_once "../../controlador/docente/controlador_agenda.php";
        $ins_agenda = new controlador_agenda();

        /* asignar agenda */
        if(isset($_POST['agenda_titulo_reg']) && !isset($_POST['agenda_id_reg'])){
            echo $ins_agenda->register_agenda_controlador();
        }

        if(isset($_POST['agenda_titulo_reg']) && isset($_POST['agenda_id_reg'])){
            echo $ins_agenda->update_agenda_controlador();
        }

        if(isset($_POST['agenda_id_del'])){
            echo $ins_agenda->remove_agenda_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
    }