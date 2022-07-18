<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_login.php";
        include_once "../respuestas.class.php";
    }else{
        require_once "./modelo/admin/modelo_login.php";
    }

    class controlador_login extends modelo_login{
        /* controlador para iniciar sesion */
        public function iniciar_sesion_controlador(){
            $email=main_model::limpiar_cadena($_POST['usuario_correo_lo']);
            $clave=main_model::limpiar_cadena($_POST['usuario_clave_lo']);

            /* controlador para iniciar sesion */
            if($email=="" || $clave==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos que son requeridos",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Verificar  la integridada de los datos */
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El CORREO no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[a-zA-Z0-9@#$%&.-]{7,20}",$clave)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La CLAVE no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $clave=main_model::encryption($clave);

            $datos_login=[
                "Correo"=>$email,
                "Clave"=>$clave
            ];

            $datos_cuenta=modelo_login::iniciar_sesion_admin_modelo($datos_login);

            if($datos_cuenta->rowCount()==1){
                $row=$datos_cuenta->fetch();
                $token = main_model::token_jwt($row['ADMIN_ID'],"admin");

                session_start(['name'=>'SA']);

                $_SESSION['id_sa']=$row['ADMIN_ID'];
                $_SESSION['ua_id']=$row['UA_ID'];
                $_SESSION['nombre_sa']=$row['NOMBRE_AD'];
                $_SESSION['apellidoP_sa']=$row['APELLIDOP_AD'];
                $_SESSION['apellidoM_sa']=$row['APELLIDOM_AD'];
                $_SESSION['correo_sa']=$row['CORREO_AD'];
                $_SESSION['privilegio_sa']=$row['PRIVILEGIO'];
                $_SESSION['usuario']="admin";
                $_SESSION['anio_academico']=date("Y");
                $_SESSION['token_sa']=$token;

                $alerta=[
                    "Alerta"=>"redireccionar",
                    "URL"=>SERVERURL."admin/home/",
                    "token" => $token,
                ];

                echo json_encode($alerta);
                exit();
            }else{
                $datos_cuenta=modelo_login::iniciar_sesion_docente_modelo($datos_login);
                if($datos_cuenta->rowCount()==1){
                    $row=$datos_cuenta->fetch();
                    $token = main_model::token_jwt($row['PROFESOR_ID'],"docente");

                    session_start(['name'=>'SA']);

                    $_SESSION['id_sa']=$row['PROFESOR_ID'];
                    $_SESSION['id_area']=$row['COD_AREA'];
                    $_SESSION['ua_id']=$row['UA_ID'];
                    $_SESSION['ci_sa']=$row['CI_P'];
                    $_SESSION['nombre_sa']=$row['NOMBRE_P'];
                    $_SESSION['apellidoP_sa']=$row['APELLIDOP_P'];
                    $_SESSION['apellidoM_sa']=$row['APELLIDOM_P'];
                    $_SESSION['correo_sa']=$row['CORREO_P'];
                    $_SESSION['telefono_sa']=$row['TELEFONO_P'];
                    $_SESSION['usuario']="docente";
                    $_SESSION['anio_academico']=date("Y");
                    $_SESSION['token_sa']=$token;

                    $alerta=[
                        "Alerta"=>"redireccionar",
                        "URL"=>SERVERURL."docente/home/",
                        "token" => $token,
                    ];
    
                    echo json_encode($alerta);
                    exit();
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El USUARIO y/o CLAVE son incorrectos",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                }
            }
        }

        /* controlador para iniciar sesion con token*/
        public function iniciar_sesion_token_controlador(){
            $token=main_model::limpiar_cadena($_POST['token_login']);
            try {
                $decoded = main_model::validate_token_jwt($token);
            } catch (\Exception $e) {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El TOKEN ha expirado",
                    "Tipo"=>"error",
                ];
                session_start(['name'=>'SA']);
                session_unset();
                session_destroy();

                echo json_encode($alerta);
                exit();
            }
            $token_decoded=json_decode($decoded,true);
         
            $datos_login=[
                "Id"=>$token_decoded['id'],
            ];

            if($token_decoded['rol']=='admin'){
                $datos_cuenta=modelo_login::iniciar_sesion_admin_token_modelo($datos_login);
                if($datos_cuenta->rowCount()==1){
                    $row=$datos_cuenta->fetch();
                    $token_new = main_model::token_jwt($row['ADMIN_ID'],"admin");
    
                    session_start(['name'=>'SA']);
    
                    $_SESSION['id_sa']=$row['ADMIN_ID'];
                    $_SESSION['ua_id']=$row['UA_ID'];
                    $_SESSION['nombre_sa']=$row['NOMBRE_AD'];
                    $_SESSION['apellidoP_sa']=$row['APELLIDOP_AD'];
                    $_SESSION['apellidoM_sa']=$row['APELLIDOM_AD'];
                    $_SESSION['correo_sa']=$row['CORREO_AD'];
                    $_SESSION['privilegio_sa']=$row['PRIVILEGIO'];
                    $_SESSION['usuario']="admin";
                    $_SESSION['anio_academico']=date("Y");
                    $_SESSION['token_sa']=$token_new;
    
                    $alerta=[
                        "Alerta"=>"redireccionar",
                        "URL"=>SERVERURL."admin/home/",
                        "token" => $token_new,
                    ];
    
                    echo json_encode($alerta);
                    exit();
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El TOKEN es invalido",
                        "Tipo"=>"error",
                    ];
                    session_start(['name'=>'SA']);
                    session_unset();
                    session_destroy();

                    echo json_encode($alerta);
                    exit();
                }
            }

            if($token_decoded['rol']=='docente'){
                $datos_cuenta=modelo_login::iniciar_sesion_docente_token_modelo($datos_login);
                if($datos_cuenta->rowCount()==1){
                    $row=$datos_cuenta->fetch();
                    $token_new = main_model::token_jwt($row['PROFESOR_ID'],"docente");

                    session_start(['name'=>'SA']);

                    $_SESSION['id_sa']=$row['PROFESOR_ID'];
                    $_SESSION['id_area']=$row['COD_AREA'];
                    $_SESSION['ua_id']=$row['UA_ID'];
                    $_SESSION['ci_sa']=$row['CI_P'];
                    $_SESSION['nombre_sa']=$row['NOMBRE_P'];
                    $_SESSION['apellidoP_sa']=$row['APELLIDOP_P'];
                    $_SESSION['apellidoM_sa']=$row['APELLIDOM_P'];
                    $_SESSION['correo_sa']=$row['CORREO_P'];
                    $_SESSION['telefono_sa']=$row['TELEFONO_P'];
                    $_SESSION['usuario']="docente";
                    $_SESSION['anio_academico']=date("Y");
                    $_SESSION['token_sa']=$token_new;

                    $alerta=[
                        "Alerta"=>"redireccionar",
                        "URL"=>SERVERURL."docente/home/",
                        "token" => $token_new,
                    ];
    
                    echo json_encode($alerta);
                    exit();
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El TOKEN es invalido",
                        "Tipo"=>"error",
                    ];
                    session_start(['name'=>'SA']);
                    session_unset();
                    session_destroy();

                    echo json_encode($alerta);
                }
            }
        }

        /* controlador para iniciar sesion estudiante o tutor*/
        public function iniciar_sesion_student_controlador($datos){
            $_respuesta = new respuestas;
            if(!isset($datos['phone']) || !isset($datos['clave'])){
                return $_respuesta->error_400();
            }else{
                $phone = $datos['phone'];
                $clave = $datos['clave'];
                $clave = main_model::encryption($clave);
                $datos_alumno=[
                    "phone"=>$phone,
                    "clave"=>$clave,
                ];
                $datos_cuenta=modelo_login::iniciar_sesion_alumno_modelo($datos_alumno);
                if($datos_cuenta->rowCount()==1){
                    $datos_cuenta = $datos_cuenta->fetch();
                    $token = main_model::token_jwt($datos_cuenta['ALUMNO_ID'],"alumno");
                    $result = $_respuesta->$response;
                    $result["status"] = "ok";
                    $result["result"]= array(
                        "user" => "student",
                        "token" => $token,
                    );
                    return $result;
                }else{
                    $datos_cuenta=modelo_login::iniciar_sesion_tutor_modelo($datos_alumno);
                    if($datos_cuenta->rowCount()==1){
                        $datos_cuenta = $datos_cuenta->fetch();
                        $token = main_model::token_jwt($datos_cuenta['FAMILAR_ID'],"familiar");
                        $result = $_respuesta->$response;
                        $result["status"] = "ok";
                        $result["result"]= array(
                            "user" => "family",
                            "token" => $token,
                        );
                        return $result;
                    }else{
                        return $_respuesta->error_200("El usuario $phone no existe");
                    }
                }
            }
        }

        /* boorar*/
        /* public function fecha_hora(){
            $fechaActual=new DateTime();
            $fechaActual->setTimeZone(new DateTimeZone('America/La_Paz'));
            return $fechaActual->format('Y-m-d H:i');
        } */
        
        /* controlador forzar cierre de sesion */
        public function forzar_cierre_sesion_controlador(){
            session_unset();
            session_destroy();

            if(headers_sent()){
                return "<script> window.location.href='".SERVERURL."login/';</script>";
            }else{
                return header("Location: ".SERVERURL."login/");
            }
        }

        /* controlador cierre de sesion */
        public function cierre_sesion_controlador(){
            session_start(['name'=>'SA']);
            $token=$_POST['token'];
            $email=main_model::decryption($_POST['email']);

            if($token==$_SESSION['token_sa'] && $email==$_SESSION['correo_sa']){
                session_unset();
                session_destroy();

                $alerta=[
                    "Alerta"=>"redireccionar",
                    "URL"=>SERVERURL."login/"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No se pudo cerrar la sesion en el sistema".$token,
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }
    }