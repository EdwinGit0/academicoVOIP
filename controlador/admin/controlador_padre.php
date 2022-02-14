<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_padre.php";
    }else{
        require_once "./modelo/admin/modelo_padre.php";
    }

    
    class controlador_padre extends modelo_padre{
        
        /**Controlador agregar padre */
        public function agregar_padre_controlador(){
            $ci=main_model::limpiar_cadena($_POST['padre_ci_reg']);
            $nombre=main_model::limpiar_cadena($_POST['padre_nombre_reg']);
            $apellidoP=main_model::limpiar_cadena($_POST['padre_apellidoP_reg']);
            $apellidoM=main_model::limpiar_cadena($_POST['padre_apellidoM_reg']);
            $fechaNac=main_model::limpiar_cadena($_POST['padre_fechaNac_reg']);
            $sexo=main_model::limpiar_cadena($_POST['padre_sexo_reg']);
            $email=main_model::limpiar_cadena($_POST['padre_email_reg']);
            $rol=main_model::limpiar_cadena($_POST['padre_rol_reg']);

            $telefono=main_model::limpiar_cadena($_POST['padre_telefono_reg']);
            $clave1=main_model::limpiar_cadena($_POST['padre_clave_1_reg']);
            $clave2=main_model::limpiar_cadena($_POST['padre_clave_2_reg']);

            $alumnos = $_POST['field_id'];

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
                $check_ci=main_model::ejecutar_consulta_simple("SELECT CI_FA FROM familiar WHERE CI_FA='$ci'");
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

            if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,50}",$rol)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El ROL no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,50}",$clave1) || main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,50}",$clave2)){
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
                $check_telefono=main_model::ejecutar_consulta_simple("SELECT TELEFONO_FA FROM familiar WHERE TELEFONO_FA='$telefono'");
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

            foreach($alumnos as $key => $value){
                if(isset($value) && $value!=""){
                    $id=main_model::decryption($value);
                    $alumno_id=main_model::limpiar_cadena($id);
                    $check_alumno=main_model::ejecutar_consulta_simple("SELECT ALUMNO_ID FROM alumno WHERE ALUMNO_ID='$alumno_id'");
                    if($check_alumno->rowCount()==0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El Alumno que selecciono no esta registrado en el sistema, intentelo nuevamente",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }

            $datos_padre_reg=[
                "CI"=>$ci,
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "FechaNac"=>$fechaNac,
                "Sexo"=>$sexo,
                "Correo"=>$email,
                "Rol"=>$rol,
                "Telefono"=>$telefono,
                "Contra"=>$clave,
                "Estado"=>1,
            ];
            $agregar_padre=modelo_padre::agregar_padre_modelo($datos_padre_reg);
            
            if($agregar_padre->rowCount()==1){
                $valor = main_model::ejecutar_consulta_simple("SELECT MAX(FAMILAR_ID) AS id FROM familiar")->fetch();
                $id_familiar = $valor['id'];
                
                foreach($alumnos as $key => $value){
                    if(isset($value) && $value!=""){
                        $value=main_model::decryption($value);
                        $agregar_alumno=modelo_padre::agregar_tutor_alumno_modelo($id_familiar,main_model::limpiar_cadena($value));
                    }
                }
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

        /* controlador paginar padre*/
        public function paginador_padre_controlador($pagina,$registros,$privilegio,$url,$busqueda,$ue){
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
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM 
                (SELECT F.* FROM familiar AS F, alumno AS A, fa_alumno AS FA WHERE (F.NOMBRE_FA LIKE '%$busqueda%' 
                OR F.APELLIDOP_FA LIKE '%$busqueda%' OR F.APELLIDOM_FA LIKE '%$busqueda%' OR F.FECHANAC_FA LIKE '%$busqueda%' 
                OR F.SEXO_FA LIKE '%$busqueda%' OR F.TELEFONO_FA LIKE '%$busqueda%' OR F.CORREO_FA LIKE '%$busqueda%' 
                OR F.ROL_FA LIKE '%$busqueda%' OR F.CI_FA LIKE '%$busqueda%') AND FA.ALUMNO_ID=A.ALUMNO_ID AND FA.FAMILAR_ID=F.FAMILAR_ID AND A.UA_ID='$ue' GROUP by F.FAMILAR_ID) AS R
                ORDER BY R.NOMBRE_FA ASC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM
                (SELECT F.* FROM familiar AS F, alumno AS A, fa_alumno AS FA WHERE FA.ALUMNO_ID=A.ALUMNO_ID AND FA.FAMILAR_ID=F.FAMILAR_ID AND A.UA_ID='$ue' GROUP BY F.FAMILAR_ID ) AS R 
                ORDER BY R.NOMBRE_FA ASC LIMIT $inicio,$registros";
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
                                <th>VER DATOS</th>';
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
                        <td>'.$rows['CI_FA'].'</td>
                        <td>'.$rows['NOMBRE_FA'].'</td>
                        <td>'.$rows['APELLIDOP_FA'].' '.$rows['APELLIDOM_FA'].'</td>
                        <td>'.$rows['SEXO_FA'].'</td>
                        <td>'.$rows['FECHANAC_FA'].'</td>
                        <td>'.$rows['CORREO_FA'].'</td>
                        <td>'.$rows['TELEFONO_FA'].'</td>
                        <td><input type="hidden" name="padre_id_ver" value="'.main_model::encryption($rows['FAMILAR_ID']).'">
                        <button type="button" class="btnVerDatos btn btn-info"><i class="fas fa-eye"></i>
                        </button></td>';

                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'admin/padre-update/'.main_model::encryption($rows['FAMILAR_ID']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/admin/padreAjax.php" method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="padre_id_del" value="'.main_model::encryption($rows['FAMILAR_ID']).'">
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
                $tabla.='<p class="text-right">Mostrando tutor '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }
        
        /* controlador eliminar padre*/
        public function eliminar_padre_controlador(){
            /* recibiendo id del padre */
            $id=main_model::decryption($_POST['padre_id_del']);
            $id=main_model::limpiar_cadena($id);

            /* Comprobar el padre en BD */
            $check_padre=main_model::ejecutar_consulta_simple("SELECT FAMILAR_ID FROM familiar WHERE FAMILAR_ID='$id'");
            if($check_padre->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El Tutor que intenta eliminar no existe en el sistema",
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

            $eliminar_padre=modelo_padre::eliminar_padre_modelo("del_padre",$id);

            if($eliminar_padre->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Tutor eliminado",
                    "Texto"=>"EL Tutor ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el Tutor, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador datos padre */
        public function datos_padre_controlador($tipo,$id,$ue){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);
            $ue=main_model::limpiar_cadena($ue);

            return modelo_padre::datos_padre_modelo($tipo,$id,$ue);
        }

        /* controlador actualizar padre */
        public function actualizar_padre_controlador(){
            // Recibiendo el ID
            $id=main_model::decryption($_POST['padre_id_up']);
            $id=main_model::limpiar_cadena($id);

            // comprobar el padre en la BD
            $check_padre=main_model::ejecutar_consulta_simple("SELECT * FROM familiar WHERE FAMILAR_ID='$id'");
            if($check_padre->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el tutor en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_padre->fetch();
            }

            $ci=main_model::limpiar_cadena($_POST['padre_ci_up']);
            $nombre=main_model::limpiar_cadena($_POST['padre_nombre_up']);
            $apellidoP=main_model::limpiar_cadena($_POST['padre_apellidoP_up']);
            $apellidoM=main_model::limpiar_cadena($_POST['padre_apellidoM_up']);
            $fechaNac=main_model::limpiar_cadena($_POST['padre_fechaNac_up']);
            $sexo=main_model::limpiar_cadena($_POST['padre_sexo_up']);
            $email=main_model::limpiar_cadena($_POST['padre_email_up']);
            $rol=main_model::limpiar_cadena($_POST['padre_rol_up']);
            $telefono=main_model::limpiar_cadena($_POST['padre_telefono_up']);
            $estado=main_model::limpiar_cadena($_POST['padre_estado_up']);

            $alumnos = $_POST['field_id'];

            /* comprobar campos vacios */
            if($ci=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $fechaNac=="" || $sexo=="" || $telefono==""){
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
            if($ci!=$campos['CI_FA'] && $ci!=""){
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
                    $check_ci=main_model::ejecutar_consulta_simple("SELECT CI_FA FROM familiar WHERE CI_FA='$ci'");
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

            if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,50}",$rol)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La ROL no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }


            if($telefono!=$campos['TELEFONO_FA'] && $telefono!=""){
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
                    $check_telefono=main_model::ejecutar_consulta_simple("SELECT TELEFONO_FA FROM familiar WHERE TELEFONO_FA='$telefono'");
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
                    "Texto"=>"El estado no corresponde a un valor valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
            /* Comprobando claves */
            if($_POST['padre_clave_nueva_1']!="" || $_POST['padre_clave_nueva_2']!=""){
                if($_POST['padre_clave_nueva_1']!=$_POST['padre_clave_nueva_2']){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Las nuevas Claves ingresadas no coinciden",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    if(main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,50}",$_POST['padre_clave_nueva_1']) || main_model::verificar_datos("[a-zA-Z0-9$@.-]{7,50}",$_POST['padre_clave_nueva_2'])){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"Las nuevas Claves no coinciden con el formato solicitado",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    $clave=main_model::encryption($_POST['padre_clave_nueva_1']);
                }
            }else{
                $clave=$campos['CONTRA_FA'];
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
       
            foreach($alumnos as $key => $value){
                if(isset($value) && $value!=""){
                    $alumno_id=main_model::decryption($value);
                    $alumno_id=main_model::limpiar_cadena($alumno_id);
                    $check_alumno=main_model::ejecutar_consulta_simple("SELECT ALUMNO_ID FROM alumno WHERE ALUMNO_ID='$alumno_id'");
                    if($check_alumno->rowCount()==0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El Alumno que selecciono no esta registrado en el sistema, intentelo nuevamente",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }

            /** Preparando datos para enviarlos al modelo */
            $datos_padre_up=[
                "CI"=>$ci,
                "Nombre"=>$nombre,
                "ApellidoP"=>$apellidoP,
                "ApellidoM"=>$apellidoM,
                "FechaNac"=>$fechaNac,
                "Sexo"=>$sexo,
                "Correo"=>$email,
                "Rol"=>$rol,
                "Telefono"=>$telefono,
                "Contra"=>$clave,
                "Estado"=>$estado,
                "ID"=>$id
            ];
            
            if(modelo_padre::actualizar_padre_modelo($datos_padre_up)){
                modelo_padre::eliminar_padre_modelo("del_relacion",$id);

                foreach($alumnos as $key => $value){
                    if(isset($value) && $value!=""){
                        $value=main_model::decryption($value);
                        $agregar_alumno=modelo_padre::agregar_tutor_alumno_modelo($id,main_model::limpiar_cadena($value));
                    }
                }
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

        /* controlador datos padre */
        public function ver_datos_padre_controlador(){
            $id=main_model::decryption($_POST['id_padre_verDatos']);
            $id=main_model::limpiar_cadena($id);
            
            $check_padre=modelo_padre::datos_padre_modelo("Unico",$id,"");
            if($check_padre->rowCount()==0){
                $campos=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar el alumno en el sistema",
                    "Tipo"=>"error"
                ];
            }else{
                $campos=$check_padre->fetch(PDO::FETCH_ASSOC);
            }
            echo json_encode($campos);
        }

        /**------------------------- ALUMNO ------------------------------ */
        /**Controlador buscar alumno */
        public function buscar_alumno_controlador(){
            /**Recuperar texto */
            $alumno=main_model::limpiar_cadena($_POST['buscar_alumno']);

            /**comprobar texto */
            if($alumno==""){
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                Debes introducir el CI, Nombre, Apellido
                            </p>
                        </div>';
                exit();
            }

             /**Iniciando la sesion */
            session_start(['name'=>'SA']);
            $ua = $_SESSION['ua_id'];
            /**Seleccionando alumno en la BD */
            $datos_alumno=main_model::ejecutar_consulta_simple("SELECT * FROM alumno WHERE 
            (CI_A LIKE '%$alumno%' OR NOMBRE_A LIKE '%$alumno%' OR APELLIDOP_A LIKE '%$alumno%' 
            OR APELLIDOM_A LIKE '%$alumno%'  OR TELEFONO_A LIKE '%$alumno%') AND UA_ID=$ua ORDER BY NOMBRE_A ASC");

            if($datos_alumno->rowCount()>=1){
                $datos_alumno=$datos_alumno->fetchAll();

                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_alumno as $rows){
                    $tabla.='<tr class="">
                                <td>'.$rows['CI_A'].'</td>
                                <td>'.$rows['NOMBRE_A'].' '.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].'</td>
                                <td class="text-center"><button type="button" class="btn btn-primary" onclick="agregar_alumno('.$rows['ALUMNO_ID'].')"><i class="fas fa-plus fa-fw"></i></button>
                                </td>
                            </tr>';
                }
                $tabla.='</tbody></table></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No hemos encontrado ningún alumno en el sistema que coincida con <strong>'.$alumno.'</strong>
                            </p>
                        </div>';
                exit();
            }
        }

        /**Controlador aqgregar alumno */
        public function agregar_alumno_controlador(){
            /**Recuperar id */
            $id_alumno=main_model::limpiar_cadena($_POST['id_agregar_alumno']);

            /** Comprobando el alumno en la BD */
            $check_alumno=main_model::ejecutar_consulta_simple("SELECT * FROM alumno WHERE ALUMNO_ID='$id_alumno'");

            if($check_alumno->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar el alumno en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_alumno->fetch();
            }

            $datos_alumno_up=[
                "ID"=>main_model::encryption($campos['ALUMNO_ID']),
                "CI"=>$campos['CI_A'],
                "Nombre"=>$campos['NOMBRE_A'],
                "ApellidoP"=>$campos['APELLIDOP_A'],
                "ApellidoM"=>$campos['APELLIDOM_A']
            ];
            echo json_encode($datos_alumno_up);
        }

         /* controlador datos alumno padre */
         public function datos_alumno_padre_controlador(){
            $id=main_model::decryption($_POST['buscar_todos_alumnos']);
            $id=main_model::limpiar_cadena($id);

            $datos=modelo_padre::datos_padre_modelo("Alumno",$id,"");

            $campos=$datos->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($campos);
        }

        /* controlador datos alumno alumno */
        public function encriptar_alumno_controlador(){
            $id=main_model::encryption($_POST['id_alumno']);
            $id=main_model::limpiar_cadena($id);
            $datos_alumno_up=[
                "ID"=>$id
            ];
            echo json_encode($datos_alumno_up);
        }
    }