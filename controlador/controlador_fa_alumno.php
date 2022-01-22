<?php
    if($peticionAjax){
        require_once "../modelo/modelo_fa_alumno.php";
    }else{
        require_once "./modelo/modelo_fa_alumno.php";
    }

    
    class controlador_fa_alumno extends modelo_fa_alumno{
        
        /**Controlador agregar fa_alumno */
        public function agregar_alumno_controlador(){
            $ci=main_model::limpiar_cadena($_POST['alumno_ci_reg']);
            $nombre=main_model::limpiar_cadena($_POST['alumno_nombre_reg']);
            $apellidoP=main_model::limpiar_cadena($_POST['alumno_apellidoP_reg']);
            $apellidoM=main_model::limpiar_cadena($_POST['alumno_apellidoM_reg']);
            $fechaNac=main_model::limpiar_cadena($_POST['alumno_fechaNac_reg']);
            $sexo=main_model::limpiar_cadena($_POST['alumno_sexo_reg']);
            $lugarNac=main_model::limpiar_cadena($_POST['alumno_lugarNac_reg']);
            $email=main_model::limpiar_cadena($_POST['alumno_email_reg']);
            $direccion=main_model::limpiar_cadena($_POST['alumno_direccion_reg']);

            $telefono=main_model::limpiar_cadena($_POST['alumno_telefono_reg']);
            $clave1=main_model::limpiar_cadena($_POST['alumno_clave_1_reg']);
            $clave2=main_model::limpiar_cadena($_POST['alumno_clave_2_reg']);

            /* comprobar campos vacios */
            if($ci=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $telefono=="" || $clave1=="" || $clave2==""){
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
                $check_ci=main_model::ejecutar_consulta_simple("SELECT CI_A FROM alumno WHERE CI_A='$ci'");
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

            if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}",$lugarNac)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El LUGAR de NACIMIENTO no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Comprobando correo */
            if($email!=""){
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Ha ingresado un CORREO no valido",
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
                $check_telefono=main_model::ejecutar_consulta_simple("SELECT TELEFONO_A FROM alumno WHERE TELEFONO_A='$telefono'");
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

            if(empty($_SESSION['datos_educativo'])){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un erro inesperado",
                    "Texto"=>"No has seleecionado ningun establecimiento",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(empty($_SESSION['datos_grado'])){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un erro inesperado",
                    "Texto"=>"No has seleecionado ningun grado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(empty($_SESSION['datos_seccion'])){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un erro inesperado",
                    "Texto"=>"No has seleecionado ninguna sección",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $datos_alumno_reg=[
                "CI"=>$ci,
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "FechaNac"=>$fechaNac,
                "Sexo"=>$sexo,
                "LugarNac"=>$lugarNac,
                "Correo"=>$email,
                "Direccion"=>$direccion,
                "Telefono"=>$telefono,
                "Contra"=>$clave,
                "Estado"=>1,
                "CodUE"=>$_SESSION['datos_educativo']['ID'],
                "CodGra"=>$_SESSION['datos_grado']['ID'],
                "CodSec"=>$_SESSION['datos_seccion']['ID']
            ];
            $agregar_alumno=modelo_alumno::agregar_alumno_modelo($datos_alumno_reg);
            
            if($agregar_alumno->rowCount()==1){
                unset($_SESSION['datos_educativo']);
                unset($_SESSION['datos_grado']);
                unset($_SESSION['datos_seccion']);
                $alerta=[
                    "Alerta"=>"recargar",
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

        /* controlador paginar fa_alumno*/
        public function paginador_alumno_controlador($pagina,$registros,$privilegio,$url,$busqueda,$ue){
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
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM alumno WHERE (NOMBRE_A LIKE '%$busqueda%' 
                OR APELLIDOP_A LIKE '%$busqueda%' OR APELLIDOM_A LIKE '%$busqueda%' OR TELEFONO_A LIKE '%$busqueda%' 
                OR DIRECCION_A LIKE '%$busqueda%' OR CORREO_A LIKE '%$busqueda%' OR CI_A LIKE '%$busqueda%' 
                OR FECHANAC_A LIKE '%$busqueda%' OR SEXO_A LIKE '%$busqueda%' OR LUGARNAC_A LIKE '%$busqueda%') AND UA_ID='$ue'
                ORDER BY NOMBRE_A ASC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM alumno WHERE UA_ID='$ue' ORDER BY NOMBRE_A ASC LIMIT $inicio,$registros";
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
                                <th>FECHA DE NAC.</th>
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
                        <td>'.$rows['CI_A'].'</td>
                        <td>'.$rows['NOMBRE_A'].'</td>
                        <td>'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].'</td>
                        <td>'.$rows['SEXO_A'].'</td>
                        <td>'.$rows['FECHANAC_A'].'</td>
                        <td>'.$rows['CORREO_A'].'</td>
                        <td>'.$rows['TELEFONO_A'].'</td>
                        <td><button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="'.$rows['NOMBRE_A'].' '.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].'" data-content="'.$rows['DIRECCION_A'].'">
                        <i class="fas fa-info-circle"></i>
                        </button></td>';

                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'alumno-update/'.main_model::encryption($rows['ALUMNO_ID']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/alumnoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="alumno_id_del" value="'.main_model::encryption($rows['ALUMNO_ID']).'">
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
                    $tabla.='<tr class="text-center"><td colspan="11">
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="11">No hay registros en el sistema</td></tr>';
                }
            }
            $tabla.='</tbody></table></div>';

            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando alumno '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }
        
        /* controlador eliminar fa_alumno*/
        public function eliminar_alumno_controlador(){
            /* recibiendo id del alumno */
            $id=main_model::decryption($_POST['alumno_id_del']);
            $id=main_model::limpiar_cadena($id);

            /* Comprobar el alumno en BD */
            $check_alumno=main_model::ejecutar_consulta_simple("SELECT ALUMNO_ID FROM alumno WHERE ALUMNO_ID='$id'");
            if($check_alumno->rowCount()<=0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"El alumno que intenta eliminar no existe en el sistema",
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

            $eliminar_alumno=modelo_alumno::eliminar_alumno_modelo($id);

            if($eliminar_alumno->rowCount()==1){
            $alerta=[
                "Alerta"=>"recargar",
                "Titulo"=>"Alumno eliminado",
                "Texto"=>"EL Alumno ha sido eliminado del sistema exitosamente",
                "Tipo"=>"success"
            ];
            }else{
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"No hemos podido eliminar el Alumno, por favor intente nuevamente",
                "Tipo"=>"error"
            ];
            }
            echo json_encode($alerta);
        }

        /* controlador datos fa_alumno */
        public function datos_fa_alumno_controlador($tipo,$id,$ue){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);
            $ue=main_model::limpiar_cadena($ue);

            return modelo_fa_alumno::datos_fa_alumno_modelo($tipo,$id,$ue);
        }

        /* controlador actualizar fa_alumno */
        public function actualizar_alumno_controlador(){
            // Recibiendo el ID
            $id=main_model::decryption($_POST['alumno_id_up']);
            $id=main_model::limpiar_cadena($id);

            // comprobar el alumno en la BD
            $check_alumno=main_model::ejecutar_consulta_simple("SELECT * FROM alumno WHERE ALUMNO_ID='$id'");
            if($check_alumno->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el alumno en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_alumno->fetch();
            }

            $ci=main_model::limpiar_cadena($_POST['alumno_ci_up']);
            $nombre=main_model::limpiar_cadena($_POST['alumno_nombre_up']);
            $apellidoP=main_model::limpiar_cadena($_POST['alumno_apellidoP_up']);
            $apellidoM=main_model::limpiar_cadena($_POST['alumno_apellidoM_up']);

            $fechaNac=main_model::limpiar_cadena($_POST['alumno_fechaNac_up']);
            $sexo=main_model::limpiar_cadena($_POST['alumno_sexo_up']);
            $lugarNac=main_model::limpiar_cadena($_POST['alumno_lugarNac_up']);

            $email=main_model::limpiar_cadena($_POST['alumno_email_up']);
            $direccion=main_model::limpiar_cadena($_POST['alumno_direccion_up']);

            $telefono=main_model::limpiar_cadena($_POST['alumno_telefono_up']);

            $estado=main_model::limpiar_cadena($_POST['alumno_estado_up']);

            /* comprobar campos vacios */
            if($ci=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $fechaNac=="" || $sexo=="" || $lugarNac=="" || $telefono==""){
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
            if($ci!=$campos['CI_A'] && $ci!=""){
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
                    $check_ci=main_model::ejecutar_consulta_simple("SELECT CI_A FROM alumno WHERE CI_A='$ci'");
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
            if($email!=""){
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Ha ingresado un CORREO no valido",
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

            if($telefono!=$campos['TELEFONO_A'] && $telefono!=""){
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
                    $check_telefono=main_model::ejecutar_consulta_simple("SELECT TELEFONO_A FROM alumno WHERE TELEFONO_A='$telefono'");
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
            if($_POST['alumno_clave_nueva_1']!="" || $_POST['alumno_clave_nueva_2']!=""){
                if($_POST['alumno_clave_nueva_1']!=$_POST['alumno_clave_nueva_2']){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Las nuevas Claves ingresadas no coinciden",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    if(main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['alumno_clave_nueva_1']) || main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$_POST['alumno_clave_nueva_2'])){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"Las nuevas Claves no coinciden con el formato solicitado",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    $clave=main_model::encryption($_POST['alumno_clave_nueva_1']);
                }
            }else{
                $clave=$campos['CONTRA_A'];
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
            $datos_alumno_up=[
                "CI"=>$ci,
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "FechaNac"=>$fechaNac,
                "Sexo"=>$sexo,
                "LugarNac"=>$lugarNac,
                "Correo"=>$email,
                "Direccion"=>$direccion,
                "Telefono"=>$telefono,
                "Contra"=>$clave,
                "Estado"=>$estado,
                "ID"=>$id
            ];

            if(modelo_alumno::actualizar_alumno_modelo($datos_alumno_up)){
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