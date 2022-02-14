<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['usuario_nombre_reg']) || isset($_POST['usuario_id_del']) || isset($_POST['usuario_id_up'])){

        /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_usuario.php";
        $ins_usuario = new controlador_usuario();

         /* Agregar un  usuario */
        if(isset($_POST['usuario_nombre_reg']) && isset($_POST['usuario_apellidoP_reg'])){
            echo $ins_usuario->agregar_usuario_controlador();
        }

            /* elimnar un  usuario */
        if(isset($_POST['usuario_id_del'])){
            echo $ins_usuario->eliminar_usuario_controlador();
        }

            /* actualizar un  usuario */
        if(isset($_POST['usuario_id_up'])){
            echo $ins_usuario->actualizar_usuario_controlador();
        }
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }