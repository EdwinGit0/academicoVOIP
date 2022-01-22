<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['alumno_ci_reg']) || isset($_POST['alumno_id_del']) || isset($_POST['alumno_id_up']) 
    || isset($_POST['buscar_padre']) || isset($_POST['id_agregar_padre']) 
    || isset($_POST['id_eliminar_padre']) || isset($_POST['id_eliminar_padre_up']) 
    || isset($_POST['id_eliminar_alumno_up'])){

        /* Instancia al controlador */
        require_once "../controlador/controlador_alumno.php";
        $ins_alumno = new controlador_alumno();

        /* Agregar un  alumno */
        if(isset($_POST['alumno_ci_reg']) && isset($_POST['alumno_nombre_reg'])){
            echo $ins_alumno->agregar_alumno_controlador();
        }

            /* elimnar un  alumno */
        if(isset($_POST['alumno_id_del'])){
            echo $ins_alumno->eliminar_alumno_controlador();
        }

            /* actualizar un  alumno */
        if(isset($_POST['alumno_id_up'])){
            echo $ins_alumno->actualizar_alumno_controlador();
        }

        /**------------------------------------------ TUTOR ---------------------------------------------- */
        /* buscar un  padre */
        if(isset($_POST['buscar_padre'])){
            echo $ins_alumno->buscar_padre_controlador();
        }

        /* agregar un  padre */
        if(isset($_POST['id_agregar_padre'])){
            echo $ins_alumno->agregar_padre_controlador();
        }

        /* eliminar padre */
        if(isset($_POST['id_eliminar_padre'])){
            echo $ins_alumno->eliminar_padre_controlador();
        }

        /* eliminar padre alumno up */
        if(isset($_POST['id_eliminar_padre_up']) && isset($_POST['id_eliminar_alumno_up'])){
            echo $ins_alumno->eliminar_padre_alumno_up_controlador();
        }
       
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }