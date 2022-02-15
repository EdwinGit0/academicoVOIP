<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['educativo_codigo_reg']) || isset($_POST['educativo_id_up']) || isset($_POST['buscar_educativo'])  || isset($_POST['id_agregar_educativo']) || isset($_POST['id_eliminar_educativo'])){

        /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_educativo.php";
        $ins_educativo = new controlador_educativo();

        /* Agregar educativo */
        if(isset($_POST['educativo_codigo_reg']) && isset($_POST['admin_id_up'])){
            echo $ins_educativo->agregar_educativo_controlador($_POST['admin_id_up']);
        }

        /* ACtualizar educativo */
        if(isset($_POST['educativo_id_up'])){
            echo $ins_educativo->actualizar_educativo_controlador();
        }

        /* buscar educativo */
        if(isset($_POST['buscar_educativo'])){
            echo $ins_educativo->buscar_educativo_admin_controlador();
        }

        /* agregar educativo */
        if(isset($_POST['id_agregar_educativo'])){
            echo $ins_educativo->agregar_educativo_admin_controlador();
        }

        /* eliminar educativo */
        if(isset($_POST['id_eliminar_educativo'])){
            echo $ins_educativo->eliminar_educativo_admin_controlador();
        }
       
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }