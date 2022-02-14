<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['docente_ci_reg']) || isset($_POST['docente_id_del']) || isset($_POST['docente_id_up'])
    || isset($_POST['docente_id_buscar']) || isset($_POST['id_agregar_area']) || isset($_POST['id_docente_verDatos'])
    || isset($_POST['buscar_educativo']) || isset($_POST['id_agregar_educativo'])){

        /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_docente.php";
        $ins_docente = new controlador_docente();

        /* Agregar un  docente */
        if(isset($_POST['docente_ci_reg']) && isset($_POST['docente_nombre_reg'])){
            echo $ins_docente->agregar_docente_controlador();
        }

            /* elimnar un  docente */
        if(isset($_POST['docente_id_del'])){
            echo $ins_docente->eliminar_docente_controlador();
        }

            /* actualizar un  docente */
        if(isset($_POST['docente_id_up'])){
            echo $ins_docente->actualizar_docente_controlador();
        }

        /* Ver datos del docente */
        if(isset($_POST['id_docente_verDatos'])){
            echo $ins_docente->ver_datos_docente_controlador();
        }

        /**------------------------------------------ AREA ---------------------------------------------- */
        /* buscar un  area */
        if(isset($_POST['docente_id_buscar'])){
            echo $ins_docente->buscar_area_controlador();
        }

        /* agregar un  area */
        if(isset($_POST['id_agregar_area'])){
            echo $ins_docente->agregar_area_controlador();
        }

        /**------------------------------------------ ESTABLECIMIENTO ---------------------------------------------- */
        /* buscar todos los educativos */
        if(isset($_POST['buscar_educativo'])){
            echo $ins_docente->buscar_educativo_controlador();
        }
        /* agregar un  educativo */
        if(isset($_POST['id_agregar_educativo'])){
            echo $ins_docente->agregar_educativo_controlador();
        }
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }