<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['padre_ci_reg']) || isset($_POST['padre_id_del']) || isset($_POST['padre_id_up']) 
    || isset($_POST['buscar_alumno']) || isset($_POST['id_agregar_alumno']) 
    || isset($_POST['id_eliminar_alumno']) || isset($_POST['id_eliminar_alumno_up']) 
    || isset($_POST['id_eliminar_padre_up'])){

        /* Instancia al controlador */
        require_once "../controlador/controlador_padre.php";
        $ins_padre = new controlador_padre();

        /* Agregar un  padre */
        if(isset($_POST['padre_ci_reg']) && isset($_POST['padre_nombre_reg'])){
            echo $ins_padre->agregar_padre_controlador();
        }

            /* elimnar un  padre */
        if(isset($_POST['padre_id_del'])){
            echo $ins_padre->eliminar_padre_controlador();
        }

            /* actualizar un  padre */
        if(isset($_POST['padre_id_up'])){
            echo $ins_padre->actualizar_padre_controlador();
        }

        /* buscar un  alumno */
        if(isset($_POST['buscar_alumno'])){
            echo $ins_padre->buscar_alumno_controlador();
        }

        /* agregar un  alumno */
        if(isset($_POST['id_agregar_alumno'])){
            echo $ins_padre->agregar_alumno_controlador();
        }

        /* eliminar alumno */
        if(isset($_POST['id_eliminar_alumno'])){
            echo $ins_padre->eliminar_alumno_controlador();
        }

        /* eliminar alumno padre up */
        if(isset($_POST['id_eliminar_alumno_up']) && isset($_POST['id_eliminar_padre_up'])){
            echo $ins_padre->eliminar_alumno_padre_up_controlador();
        }
       
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }