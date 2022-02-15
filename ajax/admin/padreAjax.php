<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['padre_ci_reg']) || isset($_POST['padre_id_del']) || isset($_POST['padre_id_up']) 
    || isset($_POST['buscar_alumno']) || isset($_POST['id_agregar_alumno']) 
    || isset($_POST['buscar_todos_alumnos'])
    || isset($_POST['id_alumno']) || isset($_POST['id_padre_verDatos'])){

        /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_padre.php";
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

        /* Ver datos del padre */
        if(isset($_POST['id_padre_verDatos'])){
            echo $ins_padre->ver_datos_padre_controlador();
        }
        /**------------------------------------ ALUMNO ------------------------------------------*/
        /* buscar un  alumno */
        if(isset($_POST['buscar_alumno'])){
            echo $ins_padre->buscar_alumno_controlador();
        }

        /* agregar un  alumno */
        if(isset($_POST['id_agregar_alumno'])){
            echo $ins_padre->agregar_alumno_controlador();
        }

        /* buscar todos los tutores */
        if(isset($_POST['buscar_todos_alumnos'])){
            echo $ins_padre->datos_alumno_padre_controlador();
        }

        /* encriptar alumno padre up */
        if(isset($_POST['id_alumno'])){
            echo $ins_padre->encriptar_alumno_controlador();
        }
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }