<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['asignar_alumno']) || isset($_POST['id_agregar_alumno'])
    || isset($_POST['id_eliminar_alumno']) || isset($_POST['asignar_docente']) 
    || isset($_POST['id_agregar_docente']) || isset($_POST['id_eliminar_docente'])
    || isset($_POST['buscar_docente'])){

        /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_asignacion.php";
        $ins_asignacion = new controlador_asignacion();

        /**------------------------------------- ALUMNO -------------------------------------- */
        /* agregar tabla alumnos cursos */
        if(isset($_POST['asignar_alumno'])){
            echo $ins_asignacion->asignar_curso_controlador("alumno");
        }

        /* agregar un  alumno a curso */
        if(isset($_POST['id_agregar_alumno'])){
            echo $ins_asignacion->agregar_alumno_controlador();
        }

        /* eliminar alumno de curso*/
        if(isset($_POST['id_eliminar_alumno'])){
            echo $ins_asignacion->eliminar_alumno_controlador();
        }

        /**------------------------------------- DOCENTE -------------------------------------- */
        /* agregar tabla docentes cursos */
        if(isset($_POST['asignar_docente'])){
            echo $ins_asignacion->asignar_curso_controlador("docente");
        }

        /* buscar un  docente */
        if(isset($_POST['buscar_docente'])){
            echo $ins_asignacion->buscar_docente_controlador();
        }

        /* agregar un  docente a curso */
        if(isset($_POST['id_agregar_docente'])){
            echo $ins_asignacion->agregar_docente_controlador();
        }

        /* eliminar docente de curso*/
        if(isset($_POST['id_eliminar_docente'])){
            echo $ins_asignacion->eliminar_docente_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
    }