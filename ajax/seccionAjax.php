<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['seccion_nombre_reg']) || isset($_POST['seccion_id_up']) || isset($_POST['seccion_id_del']) || isset($_POST['buscar_docente']) || isset($_POST['id_agregar_docente']) || isset($_POST['id_eliminar_docente']) || isset($_POST['buscar_alumno']) || isset($_POST['id_agregar_seccion']) || isset($_POST['id_eliminar_alumno'])){

        /* Instancia al controlador */
        require_once "../controlador/controlador_seccion.php";
        $ins_seccion = new controlador_seccion();

        /* agregar seccion */
        if(isset($_POST['seccion_nombre_reg'])){
            echo $ins_seccion->agregar_seccion_controlador();
        }

          /* actualizar seccion */
          if(isset($_POST['seccion_id_up'])){
            echo $ins_seccion->actualizar_seccion_controlador();
        }

          /* eliminar seccion */
          if(isset($_POST['seccion_id_del'])){
            echo $ins_seccion->eliminar_seccion_controlador();
        }

        /**------------------------------------------------------------------ */

        /* buscar docente */
        if(isset($_POST['buscar_docente'])){
            echo $ins_seccion->buscar_docente_seccion_controlador();
        }

        /* agregar docente */
        if(isset($_POST['id_agregar_docente'])){
            echo $ins_seccion->agregar_docente_seccion_controlador();
        }

        /* eliminar docente */
        if(isset($_POST['id_eliminar_docente'])){
            echo $ins_seccion->eliminar_docente_seccion_controlador();
        }

        /* buscar alumno */
        if(isset($_POST['buscar_alumno'])){
            echo $ins_seccion->buscar_alumno_seccion_controlador();
        }

        /* eliminar docente */
        if(isset($_POST['id_eliminar_alumno'])){
            echo $ins_seccion->eliminar_alumno_seccion_controlador();
        }

        /* agregar alumno */
        if(isset($_POST['id_agregar_seccion'])){
            echo $ins_seccion->agregar_alumno_seccion_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
     }