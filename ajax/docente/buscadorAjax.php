<?php
    session_start(['name'=>'SA']);
    require_once "../../config/APP.php";

    if(isset($_POST['busqueda_inicial']) || isset($_POST['eliminar_busqueda'])){
            $data_url=[
                "anio"=>"gestion-academico",
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

        if($modulo=="prestamo"){

        }else{
            $name_var="busqueda_".$modulo;

            /** iniciar busqueda */
            if(isset($_POST['busqueda_inicial'])){
                if($_POST['busqueda_inicial']==""){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Por favor introduce un termino de busqueda para empezar",
                        "Tipo"=>"error"
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
        }

        //redireccionar 

        $url=$data_url[$modulo];
        $alerta=[
            "Alerta"=>"redireccionar",
            "URL"=>SERVERURL."docente/".$url."/"
        ];

        echo json_encode($alerta);

    }else{
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
    }