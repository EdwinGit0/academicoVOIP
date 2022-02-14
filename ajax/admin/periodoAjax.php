<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['periodo_nombre_reg']) || isset($_POST['periodo_id_up']) || isset($_POST['periodo_id_del'])){

        /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_periodo.php";
        $ins_periodo = new controlador_periodo();

        /* agregar periodo */
        if(isset($_POST['periodo_nombre_reg'])){
            echo $ins_periodo->agregar_periodo_controlador();
        }

          /* actualizar periodo */
          if(isset($_POST['periodo_id_up'])){
            echo $ins_periodo->actualizar_periodo_controlador();
        }

          /* eliminar periodo */
          if(isset($_POST['periodo_id_del'])){
            echo $ins_periodo->eliminar_periodo_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
     }