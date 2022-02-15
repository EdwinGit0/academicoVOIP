<?php
    $peticionAjax=true;
    require_once "../../config/APP.php";

    if(isset($_POST['token']) && isset($_POST['email'])){
         /* Instancia al controlador */
        require_once "../../controlador/admin/controlador_login.php";
        $ins_login = new controlador_login();

        echo $ins_login->cierre_sesion_controlador();
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
