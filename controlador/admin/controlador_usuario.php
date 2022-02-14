<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_usuario.php";
    }else{
        require_once "./modelo/admin/modelo_usuario.php";
    }

    class controlador_usuario extends modelo_usuario{
          /* controlador agregar usuario */
        public function agregar_usuario_controlador(){
            $nombre=main_model::limpiar_cadena($_POST['usuario_nombre_reg']);
            $apellidoP=main_model::limpiar_cadena($_POST['usuario_apellidoP_reg']);
            $apellidoM=main_model::limpiar_cadena($_POST['usuario_apellidoM_reg']);
            $telefono=main_model::limpiar_cadena($_POST['usuario_telefono_reg']);
            $direccion=main_model::limpiar_cadena($_POST['usuario_direccion_reg']);

            $email=main_model::limpiar_cadena($_POST['usuario_email_reg']);
            $clave1=main_model::limpiar_cadena($_POST['usuario_clave_1_reg']);
            $clave2=main_model::limpiar_cadena($_POST['usuario_clave_2_reg']);

            $privilegio=main_model::limpiar_cadena($_POST['usuario_privilegio_reg']);
            $tipo_usuario=main_model::limpiar_cadena($_POST['usuario_tipo_reg']);

            /* comprobar campos vacios */
            if($nombre=="" || $apellidoP=="" || $apellidoM=="" || $email=="" || $clave1=="" || $clave2==""){
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

            if(main_model::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}",$apellidoP)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El APELLIDO PATERNO no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}",$apellidoM)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El APELLIDO MATERNO no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($telefono!=""){
                if(main_model::verificar_datos("[0-9()+]{7,20}",$telefono)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El TELEFONO no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            if($direccion!=""){
                if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$direccion)){
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

            if($tipo_usuario!="Administrador" && $tipo_usuario!="Director"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El tipo de usuario no corresponde a un valor valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave1) || main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave2)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Las CLAVES no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando correo */
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $check_correo=main_model::ejecutar_consulta_simple("SELECT CORREO_AD FROM admin WHERE CORREO_AD='$email'");
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

            /* Cpmprobando claves iguales */
            if($clave1!=$clave2){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Las claves que acaba de ingresar no coinciden",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $clave=main_model::encryption($clave1);
            }

            /* Comprovando privilegios */
            if($privilegio<1 || $privilegio>3){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El privilegio no es valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $datos_usuario_reg=[
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "Telefono"=>$telefono,
                "Direccion"=>$direccion,
                "Tipo"=>$tipo_usuario,
                "Correo"=>$email,
                "Contra"=>$clave,
                "Estado"=>1,
                "Privilegio"=>$privilegio
            ];
            $agregar_usuario=modelo_usuario::agregar_usuario_modelo($datos_usuario_reg);
            
            if($agregar_usuario->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Usuario registrado",
                    "Texto"=>"Los datos del usuario han sido registrados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el usuario",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

         /* controlador paginar admin*/
         public function paginador_admin_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda){
            $pagina=main_model::limpiar_cadena($pagina);
            $registros=main_model::limpiar_cadena($registros);
            $privilegio=main_model::limpiar_cadena($privilegio);
            $id=main_model::limpiar_cadena($id);
            $url=main_model::limpiar_cadena($url);
            $url=SERVERURL.$url."/";
            $busqueda=main_model::limpiar_cadena($busqueda);

            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM admin WHERE ((ADMIN_ID!='$id' AND ADMIN_ID!='1') AND 
                (NOMBRE_AD LIKE '%$busqueda%' OR APELLIDOP_AD LIKE '%$busqueda%' OR APELLIDOM_AD LIKE '%$busqueda%' 
                OR TELEFONO_AD LIKE '%$busqueda%' OR DIRECCION_AD LIKE '%$busqueda%' OR CORREO_AD LIKE '%$busqueda%')) 
                ORDER BY NOMBRE_AD ASC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM admin WHERE ADMIN_ID!='$id' AND ADMIN_ID!='1' ORDER BY NOMBRE_AD ASC LIMIT $inicio,$registros";
            }
            $conexion = main_model::conectar();

            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();

            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();

            $Npaginas=ceil($total/$registros);

            $tabla.='<div class="table-responsive">
                    <table class="table table-dark table-sm">
                        <thead>
                            <tr class="text-center roboto-medium">
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>TELÉFONO</th>
                                <th>CORREO</th>
                                <th>TIPO USUARIO</th>
                                <th>ACTUALIZAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>';
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='<tr class="text-center" >
                                <td>'.$contador.'</td>
                                <td>'.$rows['NOMBRE_AD'].'</td>
                                <td>'.$rows['APELLIDOP_AD'].' '.$rows['APELLIDOM_AD'].'</td>
                                <td>'.$rows['TELEFONO_AD'].'</td>
                                <td>'.$rows['CORREO_AD'].'</td>
                                <td>'.$rows['TIPO'].'</td>
                                <td>
                                    <a href="'.SERVERURL.'admin/user-update/'.main_model::encryption($rows['ADMIN_ID']).'/" class="btn btn-success">
                                            <i class="fas fa-sync-alt"></i>	
                                    </a>
                                </td>
                                <td>
                                    <form class="FormularioAjax" action="'.SERVERURL.'ajax/admin/usuarioAjax.php" method="POST" data-form="delete" autocomplete="off">
                                        <input type="hidden" name="usuario_id_del" value="'.main_model::encryption($rows['ADMIN_ID']).'">
                                        <button type="submit" class="btn btn-warning">
                                                <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>';
                            $contador++;
                }
                $reg_final=$contador-1;
            }else{
                if($total>=1){
                    $tabla.='<tr class="text-center"><td colspan="11">
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="11">No hay registros en el sistema</td></tr>';
                }
            }
            $tabla.='</tbody></table></div>';

            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando usuarios '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
         }

         /* controlador eliminar admin*/
         public function eliminar_usuario_controlador(){
             /* recibiendo id del usaurio */
             $id=main_model::decryption($_POST['usuario_id_del']);
             $id=main_model::limpiar_cadena($id);

             /* comprobando el usuario principal*/
             if($id==1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No podemos eliminar el usuario principal del sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
             }

             /* Comprobar el usuario en BD */
             $check_usuario=main_model::ejecutar_consulta_simple("SELECT ADMIN_ID FROM admin WHERE ADMIN_ID='$id'");
             if($check_usuario->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El usuario que intenta eliminar no existe en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
             }

             /* comprobando pribilegios */
             session_start(['name'=>'SA']);
             if($_SESSION['privilegio_sa']!=1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No tienes permisos necesarios para realizar esta operacion",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
             }

             $eliminar_usuario=modelo_usuario::eliminar_usuario_modelo($id);

             if($eliminar_usuario->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Usuario eliminado",
                    "Texto"=>"EL usuario ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
             }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el usuario, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
             }
             echo json_encode($alerta);
         }

         /* controlador datos usuario */
         public function datos_usuario_controlador($tipo,$id){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);

            return modelo_usuario::datos_usuario_modelo($tipo,$id);
        }

        /* controlador actualizar usuario */
        public function actualizar_usuario_controlador(){
            // Recibiendo el ID
            $id=main_model::decryption($_POST['usuario_id_up']);
            $id=main_model::limpiar_cadena($id);

            // comprobar el usuario en la BD
            $check_user=main_model::ejecutar_consulta_simple("SELECT * FROM admin WHERE ADMIN_ID='$id'");
            if($check_user->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el usuario en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_user->fetch();
            }

            $nombre=main_model::limpiar_cadena($_POST['usuario_nombre_up']);
            $apellidoP=main_model::limpiar_cadena($_POST['usuario_apellidoP_up']);
            $apellidoM=main_model::limpiar_cadena($_POST['usuario_apellidoM_up']);
            $telefono=main_model::limpiar_cadena($_POST['usuario_telefono_up']);
            $direccion=main_model::limpiar_cadena($_POST['usuario_direccion_up']);
            $tipo_usuario=main_model::limpiar_cadena($_POST['usuario_tipo_up']);

            $email=main_model::limpiar_cadena($_POST['usuario_email_up']);

            if(isset($_POST['usuario_estado_up'])){
                $estado=main_model::limpiar_cadena($_POST['usuario_estado_up']);
            }else{
                $estado=$campos['ESTADO'];
            }

            if(isset($_POST['usuario_privilegio_up'])){
                $privilegio=main_model::limpiar_cadena($_POST['usuario_privilegio_up']);
            }else{
                $privilegio=$campos['PRIVILEGIO'];
            }

            $admin_email=main_model::limpiar_cadena($_POST['email_admin']);
            $admin_clave=main_model::limpiar_cadena($_POST['clave_admin']);

            $tipo_cuenta=main_model::limpiar_cadena($_POST['tipo_cuenta']);

            /* comprobar campos vacios */
            if($nombre=="" || $apellidoP=="" || $apellidoM=="" 
            || $tipo_usuario=="" || $email=="" || $admin_email=="" || $admin_clave==""){
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

            if(main_model::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}",$apellidoP)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El APELLIDO PATERNO no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}",$apellidoM)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El APELLIDO MATERNO no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($telefono!=""){
                if(main_model::verificar_datos("[0-9()+]{7,20}",$telefono)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El TELEFONO no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            if($direccion!=""){
                if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$direccion)){
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

            /* Comprobando correo */
            if($email!=$campos['CORREO_AD'] && $email!=""){
                if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $check_correo=main_model::ejecutar_consulta_simple("SELECT CORREO_AD FROM admin WHERE CORREO_AD='$email'");
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
            

            if(!filter_var($admin_email,FILTER_VALIDATE_EMAIL)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Tu CORREO no coincide con el formaro  solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$admin_clave)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Tu CLAVE no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $admin_clave=main_model::encryption($admin_clave);

            if($privilegio < 1 || $privilegio > 3){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El privilegio no corresponde a un valor valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($estado!=0 && $estado!=1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El estado no corresponde a un valor valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($tipo_usuario!="Administrador" && $tipo_usuario!="Director"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El tipo de usuario no corresponde a un valor valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
            /* Comprobando claves */
            if($_POST['usuario_clave_nueva_1']!="" || $_POST['usuario_clave_nueva_2']!=""){
                if($_POST['usuario_clave_nueva_1']!=$_POST['usuario_clave_nueva_2']){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Las nuevas Claves ingresadas no coinciden",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    if(main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['usuario_clave_nueva_1']) || main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['usuario_clave_nueva_2'])){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"Las nuevas Claves no coinciden con el formato solicitado",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    $clave=main_model::encryption($_POST['usuario_clave_nueva_1']);
                }
            }else{
                $clave=$campos['CONTRA_AD'];
            }
            /* Comprobacion credenciales para actualizar datos */
            if($tipo_cuenta=="Propia"){
                $check_cuenta=main_model::ejecutar_consulta_simple("SELECT ADMIN_ID FROM admin WHERE CORREO_AD='$admin_email' AND CONTRA_AD='$admin_clave' AND ADMIN_ID='$id'");
            }else{
                session_start(['name'=>'SA']);
                if($_SESSION['privilegio_sa']!=1){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"No tienes los permisos necesarios para realizar esta operacion",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $check_cuenta=main_model::ejecutar_consulta_simple("SELECT ADMIN_ID FROM admin WHERE CORREO_AD='$admin_email' AND CONTRA_AD='$admin_clave'");
            }

            if($check_cuenta->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Correo y/o Clave de administrador no valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /** Preparando datos para enviarlos al modelo */
            $datos_usuario_up=[
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "Telefono"=>$telefono,
                "Direccion"=>$direccion,
                "Correo"=>$email,
                "Contra"=>$clave,
                "Estado"=>$estado,
                "Privilegio"=>$privilegio,
                "Tipo"=>$tipo_usuario,
                "ID"=>$id
            ];

            if(modelo_usuario::actualizar_usuario_modelo($datos_usuario_up)){
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