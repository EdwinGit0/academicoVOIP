<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['token']) && isset($_POST['email'])){
         /* Instancia al controlador */
        require_once "../controlador/controlador_login.php";
        $ins_login = new controlador_login();

        echo $ins_login->cierre_sesion_controlador();
    }else{
       session_start(['name'=>'SA']);
       session_unset();
       session_destroy();
       header("Location: ".SERVERURL."login/");
       exit(); 
    }
