<?php
    if($peticionAjax){
        require_once "../../modelo/docente/modelo_docente.php";
    }else{
        require_once "./modelo/docente/modelo_docente.php";
    }

    
    class controlador_docente extends modelo_docente{

        /* controlador actualizar docente */
        public function actualizar_docente_controlador(){
            // Recibiendo el ID
            $id=main_model::decryption($_POST['docente_id_up']);
            $id=main_model::limpiar_cadena($id);

            // comprobar el docente en la BD
            $check_docente=main_model::ejecutar_consulta_simple("SELECT * FROM profesor WHERE PROFESOR_ID='$id'");
            if($check_docente->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el docente en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_docente->fetch();
            }

            $ci=main_model::limpiar_cadena($_POST['docente_ci_up']);
            $nombre=main_model::limpiar_cadena($_POST['docente_nombre_up']);
            $apellidoP=main_model::limpiar_cadena($_POST['docente_apellidoP_up']);
            $apellidoM=main_model::limpiar_cadena($_POST['docente_apellidoM_up']);
            $fechaNac=main_model::limpiar_cadena($_POST['docente_fechaNac_up']);
            $email=main_model::limpiar_cadena($_POST['docente_email_up']);
            $direccion=main_model::limpiar_cadena($_POST['docente_direccion_up']);
            $telefono=main_model::limpiar_cadena($_POST['docente_telefono_up']);

            /* comprobar campos vacios */
            if($ci=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $fechaNac=="" 
            || $telefono=="" || $email=="" ){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Verficando integridad de los datos */
            if($ci!=$campos['CI_P'] && $ci!=""){
                if(main_model::verificar_datos("[0-9-]{5,15}",$ci)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El CI no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    $check_ci=main_model::ejecutar_consulta_simple("SELECT CI_P FROM profesor WHERE CI_P='$ci'");
                    if($check_ci->rowCount()>0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El CI ingresado ya se encuentra registrado en el sistema",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }
   
            if(main_model::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}",$nombre)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}",$apellidoP)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El APELLIDO PATERNO no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}",$apellidoM)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El APELLIDO MATERNO no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*------------ Falta las fechas --------------- */

            /* Comprobando correo */
            if($email!=$campos['CORREO_P'] && $email!=""){
                if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $check_correo=main_model::ejecutar_consulta_simple("SELECT CORREO_P FROM profesor WHERE CORREO_P='$email'");
                    if($check_correo->rowCount()>0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El CORREO ingresado ya se encuentra registrado en el sistema",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Ha ingresado un correo no valido",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            if($direccion!=""){
                if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}",$direccion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"La DIRECCION no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            if($telefono!=$campos['TELEFONO_P'] && $telefono!=""){
                if(main_model::verificar_datos("[0-9()+]{7,15}",$telefono)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El TELEFONO no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    $check_telefono=main_model::ejecutar_consulta_simple("SELECT TELEFONO_P FROM profesor WHERE TELEFONO_P='$telefono'");
                    if($check_telefono->rowCount()>0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El TELEFONO ingresado ya se encuentra registrado en el sistema",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }
            
            /* Comprobando claves */
            if($_POST['docente_clave_nueva_1']!="" || $_POST['docente_clave_nueva_2']!=""){
                if($_POST['docente_clave_nueva_1']!=$_POST['docente_clave_nueva_2']){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Las nuevas Claves ingresadas no coinciden",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    if(main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['docente_clave_nueva_1']) || main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['docente_clave_nueva_2'])){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"Las nuevas Claves no coinciden con el formato solicitado",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    $clave=main_model::encryption($_POST['docente_clave_nueva_1']);
                }
            }else{
                $clave=$campos['CONTRA_P'];
            }
            

            /** Preparando datos para enviarlos al modelo */
            $datos_docente_up=[
                "CI"=>$ci,
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "FechaNac"=>$fechaNac,
                "Correo"=>$email,
                "Direccion"=>$direccion,
                "Telefono"=>$telefono,
                "Contra"=>$clave,
                "ID"=>$id,
            ];

            if(modelo_docente::actualizar_docente_modelo($datos_docente_up)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Datos actualizados",
                    "Texto"=>"Los datos han sido actualizados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido actualizar los datos, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }
    }