<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['alumno_ci_reg']) || isset($_POST['alumno_id_del']) || isset($_POST['alumno_id_up']) 
    || isset($_POST['buscar_padre']) || isset($_POST['id_agregar_padre']) || isset($_POST['buscar_todos_tutores'])
    || isset($_POST['id_tutor']) || isset($_POST['id_agregar_educativo'])
    || isset($_POST['buscar_educativo']) || isset($_POST['id_alumno_verDatos'])){ 

        /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_alumno.php";
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

        /* Ver datos del alumno */
        if(isset($_POST['id_alumno_verDatos'])){
            echo $ins_alumno->ver_datos_alumno_controlador();
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

        /* buscar todos los tutores */
        if(isset($_POST['buscar_todos_tutores'])){
            echo $ins_alumno->datos_alumno_padre_controlador();
        }

        /* encriptar padre alumno up */
        if(isset($_POST['id_tutor'])){
            echo $ins_alumno->encriptar_padre_controlador();
        }

        /**------------------------------------------ EDUCATIVO ---------------------------------------------- */
        /* buscar todos los educativos */
        if(isset($_POST['buscar_educativo'])){
            echo $ins_alumno->buscar_educativo_controlador();
        }
        /* agregar un  educativo */
        if(isset($_POST['id_agregar_educativo'])){
            echo $ins_alumno->agregar_educativo_controlador();
        }
       
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }