<?php
    if($peticionAjax){
        require_once "../modelo/modelo_educativo.php";
    }else{
        require_once "./modelo/modelo_educativo.php";
    }

    
    class controlador_educativo extends modelo_educativo{

        /**controlador datos educativo */
        public function datos_educativo_controlador($id){
            return modelo_educativo::datos_educativo_modelo($id);
        }

        /**controlador datos educativo alumno */
        public function datos_educativo_alumno_controlador($id){
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);
            return modelo_educativo::datos_educativo_alumno_modelo($id);
        }

        /**Controlador registrar educativo */
        public function agregar_educativo_controlador(){
            $codigo=main_model::limpiar_cadena($_POST['educativo_codigo_reg']);
            $nombre=main_model::limpiar_cadena($_POST['educativo_nombre_reg']);
            $direccion=main_model::limpiar_cadena($_POST['educativo_direccion_reg']);
            $descripcion=main_model::limpiar_cadena($_POST['educativo_descripcion_reg']);

            $id=main_model::decryption($_POST['admin_id_up']);
            $id=main_model::limpiar_cadena($id);

            if($codigo=="" || $nombre==""){
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
            if(main_model::verificar_datos("[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,20}",$codigo)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El codigo no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $check_codigo=main_model::ejecutar_consulta_simple("SELECT COD_UA FROM unidad_academico WHERE COD_UA='$codigo'");
                if($check_codigo->rowCount()>0){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El codigo ingresado ya se encuentra registrado en el sistema",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
   
            if(main_model::verificar_datos("[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,150}",$nombre)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_UA FROM unidad_academico WHERE NOMBRE_UA='$nombre'");
                if($check_nombre->rowCount()>0){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El nombre ingresado ya se encuentra registrado en el sistema",
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
                        "Texto"=>"Ha ingresado una direccion no valido",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }   
            }

            if($descripcion!=""){
                if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,255}",$descripcion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"La descripcion no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            $datos_educativo_reg=[
                "Codigo"=>$codigo,
                "Nombre"=>$nombre,
                "Direccion"=>$direccion,
                "Descripcion"=>$descripcion
            ];

            $agregar_educativo=modelo_educativo::agregar_educativo_modelo($datos_educativo_reg,$id);
            
            if($agregar_educativo->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Establecimiento registrado",
                    "Texto"=>"Los datos del Establecimiento han sido registrados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el Establecimiento",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /**Controlador actualizar educativo */
        public function actualizar_educativo_controlador(){
            $codigo=main_model::limpiar_cadena($_POST['educativo_codigo_up']);
            $nombre=main_model::limpiar_cadena($_POST['educativo_nombre_up']);
            $direccion=main_model::limpiar_cadena($_POST['educativo_direccion_up']);
            $descripcion=main_model::limpiar_cadena($_POST['educativo_descripcion_up']);
            $id=main_model::limpiar_cadena($_POST['educativo_id_up']);

            if($codigo=="" || $nombre==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            // comprobar el alumno en la BD
            $check_educativo=main_model::ejecutar_consulta_simple("SELECT * FROM unidad_academico WHERE UA_ID='$id'");
            if($check_educativo->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el Establecimiento en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_educativo->fetch();
            }

            /* Verficando integridad de los datos */
            if($codigo!=$campos['COD_UA'] && $codigo!=""){
                if(main_model::verificar_datos("[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,20}",$codigo)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El codigo no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    $check_codigo=main_model::ejecutar_consulta_simple("SELECT COD_UA FROM unidad_academico WHERE COD_UA='$codigo'");
                    if($check_codigo->rowCount()>0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El codigo ingresado ya se encuentra registrado en el sistema",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }
   
            if($nombre!=$campos['NOMBRE_UA'] && $nombre!=""){
                if(main_model::verificar_datos("[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,150}",$nombre)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El NOMBRE no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_UA FROM unidad_academico WHERE NOMBRE_UA='$nombre'");
                    if($check_nombre->rowCount()>0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El nombre ingresado ya se encuentra registrado en el sistema",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }

            if($direccion!=""){
                if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}",$direccion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Ha ingresado una direccion no valido",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }   
            }

            if($descripcion!=""){
                if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,255}",$descripcion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"La descripcion no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

             /* Comprobacion credenciales para actualizar datos */
             session_start(['name'=>'SA']);
             if($_SESSION['privilegio_sa']<1 || $_SESSION['privilegio_sa']>2){
                 $alerta=[
                     "Alerta"=>"simple",
                     "Titulo"=>"Ocurrio un error inesperado",
                     "Texto"=>"No tienes los permisos necesarios para realizar esta operacion",
                     "Tipo"=>"error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }

             /** Preparando datos para enviarlos al modelo */
            $datos_educativo_up=[
                "Codigo"=>$codigo,
                "Nombre"=>$nombre,
                "Direccion"=>$direccion,
                "Descripcion"=>$descripcion,
                "ID"=>$id
            ];
            
            if(modelo_educativo::actualizar_educativo_modelo($datos_educativo_up)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Establecimiento registrado",
                    "Texto"=>"Los datos del Establecimiento han sido actualizados con exito",
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

          /**Controlador buscar educativo admin */
        public function buscar_educativo_admin_controlador(){
            /**Recuperar texto */
            $educativo=main_model::limpiar_cadena($_POST['buscar_educativo']);

            /**comprobar texto */
            if($educativo==""){
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                Debes introducir el Código, Nombre
                            </p>
                        </div>';
                exit();
            }

            /**Seleccionando educativo en la BD */
            $datos_educativo=main_model::ejecutar_consulta_simple("SELECT * FROM unidad_academico WHERE 
            COD_UA LIKE '%$educativo%' OR NOMBRE_UA LIKE '%$educativo%' ORDER BY NOMBRE_UA ASC");

            if($datos_educativo->rowCount()>=1){
                $datos_educativo=$datos_educativo->fetchAll();

                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_educativo as $rows){
                    $tabla.='<tr class="text-center">
                                <td>'.$rows['COD_UA'].' - '.$rows['NOMBRE_UA'].'</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="agregar_educativo('.$rows['UA_ID'].')"><i class="fas fa-building fa-fw"></i></button>
                                    </td>
                            </tr>';
                }

                $tabla.='</tbody></table></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No hemos encontrado ningún educativo en el sistema que coincida con <strong>'.$educativo.'</strong>
                            </p>
                        </div>';
                exit();
            }
        }

        /**Controlador aqgregar educativo admin */
        public function agregar_educativo_admin_controlador(){
            /**Recuperar id */
            $id=main_model::limpiar_cadena($_POST['id_agregar_educativo']);

            /** Comprobando el educativo en la BD */
            $check_educativo=main_model::ejecutar_consulta_simple("SELECT * FROM unidad_academico WHERE UA_ID='$id'");

            if($check_educativo->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar el Establecimiento en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_educativo->fetch();
            }

            /**Iniciando la sesion */
            session_start(['name'=>'SA']);

            $datos_educativo_reg=[
                "ID"=>$campos['UA_ID'],
                "Codigo"=>$campos['COD_UA'],
                "Nombre"=>$campos['NOMBRE_UA'],
                "Direccion"=>$campos['DIRECCION_UA'],
                "Descripcion"=>$campos['DESCRIPCION_UA']
            ];

            $agregar_educativo=modelo_educativo::agregar_educativo_admin_modelo($datos_educativo_reg,$_SESSION['id_sa']);
            
            if($agregar_educativo->rowCount()==1){
                $_SESSION['ua_id']=$campos['COD_UA'];
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Establecimiento Agregado",
                    "Texto"=>"El Establecimiento se agrego a la sección",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el Establecimiento",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);

        }

    }