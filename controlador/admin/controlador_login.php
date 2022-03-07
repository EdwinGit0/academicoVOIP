<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_login.php";
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
                    Swal.fire({
                        title: "Ocurrio un error inesperado",
                        text: "No has llenado todos los campos que son requeridos",
                        type: "error",
                        confirmButtonText: "Aceptar"
                  });
                </script>';
                exit();
            }

            /* Verificar  la integridada de los datos */
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                echo 
                '<script>
                    Swal.fire({
                        title: "Ocurrio un error inesperado",
                        text: "La CORREO no coincide con el formato solicitado",
                        type: "error",
                        confirmButtonText: "Aceptar"
                  });
                </script>';
                exit();
            }

            if(main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
                echo 
                '<script>
                    Swal.fire({
                        title: "Ocurrio un error inesperado",
                        text: "EL CLAVE no coincide con el formato solicitado",
                        type: "error",
                        confirmButtonText: "Aceptar"
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
                        Swal.fire({
                            title: "Ocurrio un error inesperado",
                            text: "El USUARIO y/o CLAVE son incorrectos",
                            type: "error",
                            confirmButtonText: "Aceptar"
                    });
                    </script>';
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