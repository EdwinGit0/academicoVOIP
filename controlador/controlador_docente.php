<?php
    if($peticionAjax){
        require_once "../modelo/modelo_docente.php";
    }else{
        require_once "./modelo/modelo_docente.php";
    }

    
    class controlador_docente extends modelo_docente{
        
        /**Controlador agregar docente */
        public function agregar_docente_controlador(){
            $ci=main_model::limpiar_cadena($_POST['docente_ci_reg']);
            $nombre=main_model::limpiar_cadena($_POST['docente_nombre_reg']);
            $apellidoP=main_model::limpiar_cadena($_POST['docente_apellidoP_reg']);
            $apellidoM=main_model::limpiar_cadena($_POST['docente_apellidoM_reg']);
            $fechaNac=main_model::limpiar_cadena($_POST['docente_fechaNac_reg']);
            $sexo=main_model::limpiar_cadena($_POST['docente_sexo_reg']);
            $fechaIng=main_model::limpiar_cadena($_POST['docente_fechaIng_reg']);
            $direccion=main_model::limpiar_cadena($_POST['docente_direccion_reg']);

            $telefono=main_model::limpiar_cadena($_POST['docente_telefono_reg']);
            $email=main_model::limpiar_cadena($_POST['docente_email_reg']);
            $clave1=main_model::limpiar_cadena($_POST['docente_clave_1_reg']);
            $clave2=main_model::limpiar_cadena($_POST['docente_clave_2_reg']);

            /* comprobar campos vacios */
            if($ci=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $email=="" || $telefono=="" || $clave1=="" || $clave2==""){
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

            session_start(['name'=>'SA']);
            if($_SESSION['ua_id']=="" || empty($_SESSION['ua_id'])){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No estas registrado a un Establecimiento, registrese o cree un nuevo Establecimiento por favor",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $ua=$_SESSION['ua_id'];
            }

            $datos_docente_reg=[
                "Ua"=>$ua,
                "CI"=>$ci,
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "FechaNac"=>$fechaNac,
                "Sexo"=>$sexo,
                "FechaIng"=>$fechaIng,
                "Correo"=>$email,
                "Direccion"=>$direccion,
                "Telefono"=>$telefono,
                "Contra"=>$clave,
                "Estado"=>1,
            ];
            $agregar_docente=modelo_docente::agregar_docente_modelo($datos_docente_reg);
            
            if($agregar_docente->rowCount()==1){
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

        /* controlador paginar docente*/
        public function paginador_docente_controlador($pagina,$registros,$privilegio,$url,$busqueda,$ue){
            $pagina=main_model::limpiar_cadena($pagina);
            $registros=main_model::limpiar_cadena($registros);
            $privilegio=main_model::limpiar_cadena($privilegio);
            $url=main_model::limpiar_cadena($url);
            $url=SERVERURL.$url."/";
            $busqueda=main_model::limpiar_cadena($busqueda);
            $ue=main_model::limpiar_cadena($ue);

            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM profesor WHERE (CI_P LIKE '%$busqueda%' OR NOMBRE_P LIKE '%$busqueda%'
                OR APELLIDOP_P LIKE '%$busqueda%' OR APELLIDOM_P LIKE '%$busqueda%' OR FECHANAC_P LIKE '%$busqueda%' 
                OR SEXO_P LIKE '%$busqueda%' OR FECHA_INGRESO_P LIKE '%$busqueda%' OR CORREO_P LIKE '%$busqueda%' 
                OR TELEFONO_P LIKE '%$busqueda%' OR DIRECCION_P LIKE '%$busqueda%') AND UA_ID='$ue'
                ORDER BY NOMBRE_P ASC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM profesor WHERE UA_ID='$ue' ORDER BY NOMBRE_P ASC LIMIT $inicio,$registros";
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
                                <th>CI</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>SEXO</th>
                                <th>F. NACIMIENTO</th>
                                <th>F. INGRESO</th>
                                <th>CORREO</th>
                                <th>TELÉFONO</th>
                                <th>DIRECCIÓN</th>';
                                if($privilegio==1 || $privilegio ==2){
                                    $tabla.='<th>ACTUALIZAR</th>';
                                }

                                if($privilegio==1){
                                    $tabla.='<th>ELIMINAR</th>';
                                }
                        $tabla.='</tr>
                        </thead>
                        <tbody>';
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='<tr class="text-center" >
                        <td>'.$contador.'</td>
                        <td>'.$rows['CI_P'].'</td>
                        <td>'.$rows['NOMBRE_P'].'</td>
                        <td>'.$rows['APELLIDOP_P'].' '.$rows['APELLIDOM_P'].'</td>
                        <td>'.$rows['SEXO_P'].'</td>
                        <td>'.$rows['FECHANAC_P'].'</td>
                        <td>'.$rows['FECHA_INGRESO_P'].'</td>
                        <td>'.$rows['CORREO_P'].'</td>
                        <td>'.$rows['TELEFONO_P'].'</td>
                        <td><button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="'.$rows['NOMBRE_P'].' '.$rows['APELLIDOP_P'].' '.$rows['APELLIDOM_P'].'" data-content="'.$rows['DIRECCION_P'].'">
                        <i class="fas fa-info-circle"></i>
                        </button></td>';

                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'docente-update/'.main_model::encryption($rows['PROFESOR_ID']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/docenteAjax.php" method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="docente_id_del" value="'.main_model::encryption($rows['PROFESOR_ID']).'">
                                            <button type="submit" class="btn btn-warning">
                                                    <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>';
                        }
                
                        $tabla.='</tr>';
                    $contador++;
                }
                $reg_final=$contador-1;
            }else{
                if($total>=1){
                    $tabla.='<tr class="text-center"><td colspan="12">
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="12">No hay registros en el sistema</td></tr>';
                }
            }
            $tabla.='</tbody></table></div>';

            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando docente '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }
        
        /* controlador eliminar docente*/
        public function eliminar_docente_controlador(){
            /* recibiendo id del docente */
            $id=main_model::decryption($_POST['docente_id_del']);
            $id=main_model::limpiar_cadena($id);

            /* Comprobar el docente en BD */
            $check_docente=main_model::ejecutar_consulta_simple("SELECT PROFESOR_ID FROM profesor WHERE PROFESOR_ID='$id'");
            if($check_docente->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El docente que intenta eliminar no existe en el sistema",
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

            $eliminar_docente=modelo_docente::eliminar_docente_modelo($id);

            if($eliminar_docente->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Docente eliminado",
                    "Texto"=>"EL Docente ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
                }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el Docente, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador datos docente */
        public function datos_docente_controlador($tipo,$id,$ue){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);
            $ue=main_model::limpiar_cadena($ue);

            return modelo_docente::datos_docente_modelo($tipo,$id,$ue);
        }

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
            $sexo=main_model::limpiar_cadena($_POST['docente_sexo_up']);
            $fechaIng=main_model::limpiar_cadena($_POST['docente_fechaIng_up']);

            $email=main_model::limpiar_cadena($_POST['docente_email_up']);
            $direccion=main_model::limpiar_cadena($_POST['docente_direccion_up']);

            $telefono=main_model::limpiar_cadena($_POST['docente_telefono_up']);

            $estado=main_model::limpiar_cadena($_POST['docente_estado_up']);

            /* comprobar campos vacios */
            if($ci=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $fechaNac=="" || $sexo=="" || $fechaIng=="" || $telefono=="" || $email==""){
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

            if($estado!=0 && $estado!=1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El estodo no corresponde a un valor valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
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
            $datos_docente_up=[
                "CI"=>$ci,
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "FechaNac"=>$fechaNac,
                "Sexo"=>$sexo,
                "FechaIng"=>$fechaIng,
                "Correo"=>$email,
                "Direccion"=>$direccion,
                "Telefono"=>$telefono,
                "Contra"=>$clave,
                "Estado"=>$estado,
                "ID"=>$id
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

        /**----------------------------------------------------------------------------------------- */

         /**Controlador buscar area */
        public function buscar_area_controlador(){
            /**Recuperar texto */
            $area=main_model::limpiar_cadena($_POST['buscar_area']);
            $id_docente=main_model::decryption($_POST['buscar_docente']);
            $id_docente=main_model::limpiar_cadena($id_docente);

            /**comprobar texto */
            if($area==""){
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                Debes introducir el Nombre, Creado
                            </p>
                        </div>';
                exit();
            }

            /**Seleccionando area en la BD */
            $datos_area=main_model::ejecutar_consulta_simple("SELECT * FROM area WHERE 
            NOMBRE_AREA LIKE '%$area%' OR CREADO_AREA LIKE '%$area%' ORDER BY NOMBRE_AREA ASC");

            if($datos_area->rowCount()>=1){
                $datos_area=$datos_area->fetchAll();

                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_area as $rows){
                    $tabla.='<tr class="text-center">
                                <td>'.$rows['NOMBRE_AREA'].' - '.$rows['CREADO_AREA'].'</td>
                                <td>';

                                if($id_docente!=""){
                                    $tabla.='<button type="button" class="btn btn-primary" onclick="agregar_area('.$rows['COD_AREA'].','.$id_docente.')"><i class="fas fa-plus fa-fw"></i></button>';
                                }else{
                                    $tabla.='<button type="button" class="btn btn-primary" onclick="agregar_area('.$rows['COD_AREA'].','."-1".')"><i class="fas fa-plus fa-fw"></i></button>';
                                }

                            $tabla.='</td>
                            </tr>';
                }

                $tabla.='</tbody></table></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No hemos encontrado ningún área en el sistema que coincida con <strong>'.$area.'</strong>
                            </p>
                        </div>';
                exit();
            }
        }

        /**Controlador buscar seccion */
        public function buscar_seccion_controlador(){
            /**Recuperar texto */
            $seccion=main_model::limpiar_cadena($_POST['buscar_seccion']);
            $id_docente=main_model::decryption($_POST['buscar_docente']);
            $id_docente=main_model::limpiar_cadena($id_docente);

            /**comprobar texto */
            if($seccion==""){
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                Debes introducir el Nombre, Creado
                            </p>
                        </div>';
                exit();
            }

            /**Seleccionando seccion en la BD */
            $datos_seccion=main_model::ejecutar_consulta_simple("SELECT * FROM seccion WHERE 
            NOMBRE_SEC LIKE '%$seccion%' OR CREADO_SEC LIKE '%$seccion%' ORDER BY NOMBRE_SEC ASC");

            if($datos_seccion->rowCount()>=1){
                $datos_seccion=$datos_seccion->fetchAll();

                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_seccion as $rows){
                    $tabla.='<tr class="text-center">
                                <td>'.$rows['NOMBRE_SEC'].' - '.$rows['CREADO_SEC'].'</td>
                                <td>';

                                    if($id_docente!=""){
                                        $tabla.='<button type="button" class="btn btn-primary" onclick="agregar_seccion('.$rows['COD_SEC'].','.$id_docente.')"><i class="fas fa-plus fa-fw"></i></button>';
                                    }else{
                                        $tabla.='<button type="button" class="btn btn-primary" onclick="agregar_seccion('.$rows['COD_SEC'].','."-1".')"><i class="fas fa-plus fa-fw"></i></button>';
                                    }

                                $tabla.='</td>
                                </tr>';
                }

                $tabla.='</tbody></table></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No hemos encontrado ningún establecimiento en el sistema que coincida con <strong>'.$seccion.'</strong>
                            </p>
                        </div>';
                exit();
            }
        }

        /**Controlador aqgregar area */
        public function agregar_area_controlador(){
            /**Recuperar id */
            $id=main_model::limpiar_cadena($_POST['id_agregar_area']);
            $id_docente=main_model::limpiar_cadena($_POST['id_agregar_docente']);

            /** Comprobando el area en la BD */
            $check_area=main_model::ejecutar_consulta_simple("SELECT * FROM area WHERE COD_AREA='$id'");

            if($check_area->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar el área en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_area->fetch();
            }

            if($id_docente=="-1"){
                /**Iniciando la sesion */
                session_start(['name'=>'SA']);

                if(empty($_SESSION['datos_area'])){
                    $_SESSION['datos_area']=[
                        "ID"=>$campos['COD_AREA'],
                        "Nombre"=>$campos['NOMBRE_AREA'],
                        "Creado"=>$campos['CREADO_AREA']
                    ];

                    $alerta=[
                        "Alerta"=>"recargar",
                        "Titulo"=>"Área Agregado",
                        "Texto"=>"El area se agrego para el docente",
                        "Tipo"=>"success"
                    ];
                    echo json_encode($alerta);
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"No hemos podido agregar el área",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                }
            }else{
                $datos_area_up=[
                    "CodAr"=>$campos['COD_AREA'],
                    "Nombre"=>$campos['NOMBRE_AREA'],
                    "Creado"=>$campos['CREADO_AREA']
                ];
                $agregar_area=modelo_docente::agregar_area_docente_up_modelo($datos_area_up,$id_docente);

                if($agregar_area->rowCount()==1){
                    $alerta=[
                        "Alerta"=>"recargar",
                        "Titulo"=>"Área Agregado",
                        "Texto"=>"El área se agrego",
                        "Tipo"=>"success"
                    ];
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"No hemos podido agregar el área",
                        "Tipo"=>"error"
                    ];
                }
                echo json_encode($alerta);
            }
        }

        /**Controlador aqgregar seccion */
        public function agregar_seccion_controlador(){
            /**Recuperar id */
            $id=main_model::limpiar_cadena($_POST['id_agregar_seccion']);
            $id_docente=main_model::limpiar_cadena($_POST['id_agregar_docente']);

            /** Comprobando el seccion en la BD */
            $check_seccion=main_model::ejecutar_consulta_simple("SELECT * FROM seccion WHERE COD_SEC='$id'");

            if($check_seccion->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar el seccion en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_seccion->fetch();
            }

            if($id_docente=="-1"){
                /**Iniciando la sesion */
                session_start(['name'=>'SA']);

                if(empty($_SESSION['datos_seccion'])){
                    $_SESSION['datos_seccion']=[
                        "ID"=>$campos['COD_SEC'],
                        "Nombre"=>$campos['NOMBRE_SEC'],
                        "Creado"=>$campos['CREADO_SEC']
                    ];

                    $alerta=[
                        "Alerta"=>"recargar",
                        "Titulo"=>"Sección Agregado",
                        "Texto"=>"El sección se agrego para el docente",
                        "Tipo"=>"success"
                    ];
                    echo json_encode($alerta);
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"No hemos podido agregar el secciónn",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                }
            }else{
                $datos_seccion_up=[
                    "CodSec"=>$campos['COD_SEC'],
                    "Nombre"=>$campos['NOMBRE_SEC'],
                    "Creado"=>$campos['CREADO_SEC'],
                ];
                $agregar_seccion=modelo_docente::agregar_seccion_docente_up_modelo($datos_seccion_up,$id_docente);

                if($agregar_seccion->rowCount()==1){
                    $alerta=[
                        "Alerta"=>"recargar",
                        "Titulo"=>"Sección Agregado",
                        "Texto"=>"La Sección se agrego",
                        "Tipo"=>"success"
                    ];
                }else{
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"No hemos podido agregar la Sección",
                        "Tipo"=>"error"
                    ];
                }
                echo json_encode($alerta);
            }
        }
    }