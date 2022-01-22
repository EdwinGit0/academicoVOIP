<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['docente_ci_reg']) || isset($_POST['docente_id_del']) || isset($_POST['docente_id_up'])
    || isset($_POST['buscar_area']) || isset($_POST['buscar_seccion']) || isset($_POST['id_agregar_area'])
    || isset($_POST['id_agregar_seccion'])){ 

        /* Instancia al controlador */
        require_once "../controlador/controlador_docente.php";
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

           /* buscar un  area */
           if(isset($_POST['buscar_area'])){
            echo $ins_docente->buscar_area_controlador();
        }

        /* buscar un  seccion */
        if(isset($_POST['buscar_seccion'])){
            echo $ins_docente->buscar_seccion_controlador();
        }

        /* agregar un  area */
        if(isset($_POST['id_agregar_area'])){
            echo $ins_docente->agregar_area_controlador();
        }

        /* agregar un  seccion */
        if(isset($_POST['id_agregar_seccion'])){
            echo $ins_docente->agregar_seccion_controlador();
        }
       
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }