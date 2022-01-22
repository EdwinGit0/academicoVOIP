<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['area_nombre_reg']) || isset($_POST['area_id_up']) || isset($_POST['area_id_del']) || isset($_POST['buscar_anio']) || isset($_POST['id_agregar_anio']) || isset($_POST['id_eliminar_anio']) || isset($_POST['id_eliminar_anio_up'])){

        /* Instancia al controlador */
        require_once "../controlador/controlador_area.php";
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

        /* buscar anio */
        if(isset($_POST['buscar_anio'])){
            echo $ins_area->buscar_anio_area_controlador();
        }

        /* agregar anio */
        if(isset($_POST['id_agregar_anio'])){
            echo $ins_area->agregar_anio_area_controlador();
        }

        /* eliminar anio */
        if(isset($_POST['id_eliminar_anio'])){
            echo $ins_area->eliminar_anio_area_controlador();
        }

        /* eliminar anio up*/
        if(isset($_POST['id_eliminar_anio_up']) && isset($_POST['id_eliminar_area_up'])){
          echo $ins_area->eliminar_anio_area_up_controlador();
      }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
     }