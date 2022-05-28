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
                echo 
                '<script>
                    swal({
                        title: "Ocurrio un error inesperado",
                        text: "No has llenado todos los campos que son requeridos",
                        icon: "error",
                        button: "Aceptar",
                    });
                </script>';
                exit();
            }

            /* Verificar  la integridada de los datos */
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                echo 
                '<script>
                    swal({
                        title: "Ocurrio un error inesperado",
                        text: "El CORREO no coincide con el formato solicitado",
                        icon: "error",
                        button: "Aceptar",
                    });
                </script>';
                exit();
            }

            if(main_model::verificar_datos("[a-zA-Z0-9@#$%&.-]{7,20}",$clave)){
                echo 
                '<script>
                    swal({
                        title: "Ocurrio un error inesperado",
                        text: "La CLAVE no coincide con el formato solicitado",
                        icon: "error",
                        button: "Aceptar",
                    });
                </script>';
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

                session_start(['name'=>'SA']);

                $_SESSION['id_sa']=$row['ADMIN_ID'];
                $_SESSION['ua_id']=$row['UA_ID'];
                $_SESSION['nombre_sa']=$row['NOMBRE_AD'];
                $_SESSION['apellidoP_sa']=$row['APELLIDOP_AD'];
                $_SESSION['apellidoM_sa']=$row['APELIIDOM_AD'];
                $_SESSION['correo_sa']=$row['CORREO_AD'];
                $_SESSION['privilegio_sa']=$row['PRIVILEGIO'];
                $_SESSION['usuario']="admin";
                $_SESSION['anio_academico']=date("Y");
                $_SESSION['token_sa']=md5(uniqid(mt_rand(),true));

                return header("Location: ".SERVERURL."admin/home/");
            }else{
                $datos_cuenta=modelo_login::iniciar_sesion_docente_modelo($datos_login);
                if($datos_cuenta->rowCount()==1){
                    $row=$datos_cuenta->fetch();

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
                    $_SESSION['token_sa']=md5(uniqid(mt_rand(),true));

                return header("Location: ".SERVERURL."docente/home/");
                }else{
                    echo 
                    '<script>
                        swal({
                            title: "Ocurrio un error inesperado",
                            text: "El USUARIO y/o CLAVE son incorrectos",
                            icon: "error",
                            button: "Aceptar",
                        });
                    </script>';
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
                    $token = md5(uniqid(mt_rand(),true));
                    $ins_usuario=[
                        "Id" => $datos_cuenta['ALUMNO_ID'],
                        "Fecha" => date("Y-m-d H:i:s"),
                        "Estado" => 1,
                        "Token" => $token
                    ];
                    $ins_token=modelo_login::insertar_token_modelo($ins_usuario,"ALUMNO_ID");
                    if($ins_token->rowCount()==1){
                        $datos_usuario=[
                            "ALUMNO_ID" => $datos_cuenta['ALUMNO_ID'],
                            "UA_ID" => $datos_cuenta['UA_ID'],
                            "RUDE_A" => $datos_cuenta['RUDE_A'],
                            "CI_A" => $datos_cuenta['CI_A'],
                            "NOMBRE_A" => $datos_cuenta['NOMBRE_A'],
                            "APELLIDOP_A" => $datos_cuenta['APELLIDOP_A'],
                            "APELLIDOM_A" => $datos_cuenta['APELLIDOM_A'],
                            "FECHANAC_A" => $datos_cuenta['FECHANAC_A'],
                            "SEXO_A" => $datos_cuenta['SEXO_A'],
                            "LUGARNAC_A" => $datos_cuenta['LUGARNAC_A'],
                            "CORREO_A" => $datos_cuenta['CORREO_A'],
                            "TELEFONO_A" => $datos_cuenta['TELEFONO_A'],
                            "DIRECCION_A" => $datos_cuenta['DIRECCION_A'],
                            "ESTADO_A" => $datos_cuenta['ESTADO_A'],
                            "TOKEN_A" =>  $token,
                        ];

                        $result = $_respuesta->$response;
                        $result["result"]=$datos_usuario;
                        return $result;
                    }else{
                        return $_respuesta->error_500("Error interno, no hemos podido guardar");
                    }
                }else{
                    return $_respuesta->error_200("El usuario $phone no existe");
                }
            }
        }
        
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
            $token=main_model::decryption($_POST['token']);
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
                    "Texto"=>"No se pudo cerrar la sesion en el sistema",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }
    }