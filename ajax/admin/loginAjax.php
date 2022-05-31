<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    require_once "../../controlador/admin/controlador_login.php";
    $ins_login = new controlador_login();

    if(isset($_POST['token']) || isset($_POST['usuario_correo_lo']) || isset($_POST['token_login'])){
        
        if(isset($_POST['token'])){
            echo $ins_login->cierre_sesion_controlador();
        }
    
        if(isset($_POST['usuario_correo_lo']) && isset($_POST['usuario_clave_lo'])){
           echo $ins_login->iniciar_sesion_controlador();
        }

        if(isset($_POST['token_login'])){
            echo $ins_login->iniciar_sesion_token_controlador();
        }
    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        $alerta=[
             "Alerta"=>"recargar",
             "Titulo"=>"Ocurrio un error inesperado",
             "Texto"=>"Posibles fallas en el sistema",
             "Tipo"=>"error"
         ];
 
         echo json_encode($alerta);
         exit(); 
     }
