<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['area_nombre_reg']) || isset($_POST['area_id_up']) || isset($_POST['area_id_del'])){

        /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_area.php";
        $ins_area = new controlador_area();

        /* agregar area */
        if(isset($_POST['area_nombre_reg'])){
            echo $ins_area->agregar_area_controlador();
        }

          /* actualizar area */
          if(isset($_POST['area_id_up'])){
            echo $ins_area->actualizar_area_controlador();
        }

          /* eliminar area */
          if(isset($_POST['area_id_del'])){
            echo $ins_area->eliminar_area_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
     }