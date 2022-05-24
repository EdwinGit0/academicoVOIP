<?php
    session_start(['name'=>'SA']);
    require_once "../../config/APP.php";

    if(isset($_POST['busqueda_inicial']) || isset($_POST['eliminar_busqueda'])){
            $data_url=[
                "usuario"=>"user-search",
                "alumno"=>"alumno-list",
                "padre"=>"padre-list",
                "docente"=>"docente-search",
                "curso"=>"curso-list",
                "periodo"=>"periodo-list",
                "area"=>"area-list",
                "anio"=>"anio-list",
            ];

        if(isset($_POST['modulo'])){
            $modulo=$_POST['modulo'];
            if(!isset($data_url[$modulo])){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No podemos continuar con la busqueda debido a un error",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }else{
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"No podemos continuar con la busqueda debido a un error de configuracion",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }

            $name_var="busqueda_".$modulo;

            /** iniciar busqueda */
            if(isset($_POST['busqueda_inicial'])){
                if($_POST['busqueda_inicial']==""){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Tipo"=>"validation",
                        "Input"=>$modulo,
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $_SESSION[$name_var]=$_POST['busqueda_inicial'];
            }
            //eliminar busqueda
            if(isset($_POST['eliminar_busqueda'])){
                unset($_SESSION[$name_var]);
            }

        //redireccionar 

        $url=$data_url[$modulo];
        $alerta=[
            "Alerta"=>"redireccionar",
            "URL"=>SERVERURL."admin/".$url."/"
        ];

        echo json_encode($alerta);

    }else{
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
    }