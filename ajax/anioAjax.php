<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['anio_nombre_reg']) || isset($_POST['anio_id_up']) || isset($_POST['anio_id_del'])){

        /* Instancia al controlador */
        require_once "../controlador/controlador_anio.php";
        $ins_anio = new controlador_anio();

        /* agregar anio */
        if(isset($_POST['anio_nombre_reg'])){
            echo $ins_anio->agregar_anio_controlador();
        }

          /* actualizar anio */
          if(isset($_POST['anio_id_up'])){
            echo $ins_anio->actualizar_anio_controlador();
        }

          /* eliminar anio */
          if(isset($_POST['anio_id_del'])){
            echo $ins_anio->eliminar_anio_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
     }