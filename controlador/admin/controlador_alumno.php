<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_alumno.php";
    }else{
        require_once "./modelo/admin/modelo_alumno.php";
    }

    
    class controlador_alumno extends modelo_alumno{
        
        /**Controlador agregar alumno */
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

            $tutores = $_POST['field_id'];

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

            /** Validad tutores existentes */
            foreach($tutores as $key => $value){
                if(isset($value) && $value!=""){
                    $id=main_model::decryption($value);
                    $padre_id=main_model::limpiar_cadena($id);
                    $check_tutor=main_model::ejecutar_consulta_simple("SELECT FAMILAR_ID FROM familiar WHERE FAMILAR_ID='$padre_id'");
                    if($check_tutor->rowCount()==0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El Tutor que selecciono no esta registrado en el sistema, intentelo nuevamente",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }

            $datos_alumno_reg=[
                "CI"=>$ci,
                "Rude"=>main_model::codigo_aleatorio(),
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
                "CodUE"=>$ua
            ];

            $agregar_alumno=modelo_alumno::agregar_alumno_modelo($datos_alumno_reg);

            if($agregar_alumno->rowCount()==1){

                $valor = main_model::ejecutar_consulta_simple("SELECT MAX(ALUMNO_ID) AS id FROM alumno")->fetch();
                $id_alumno = $valor['id'];
                
                foreach($tutores as $key => $value){
                    if(isset($value) && $value!=""){
                        $value=main_model::decryption($value);
                        $agregar_tutor=modelo_alumno::agregar_tutor_alumno_modelo($id_alumno,main_model::limpiar_cadena($value));
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

        /* controlador paginar alumno*/
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
                        <td>'.$rows['CI_A'].'</td>
                        <td>'.$rows['NOMBRE_A'].'</td>
                        <td>'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].'</td>
                        <td>'.$rows['SEXO_A'].'</td>
                        <td>'.$rows['FECHANAC_A'].'</td>
                        <td>'.$rows['CORREO_A'].'</td>
                        <td>'.$rows['TELEFONO_A'].'</td>
                        <td> <input type="hidden" name="alumno_id_ver" value="'.main_model::encryption($rows['ALUMNO_ID']).'">
                        <button type="button" class="btnVerDatos btn btn-info">
                        <i class="fas fa-eye"></i></button></td>';

                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'admin/alumno-update/'.main_model::encryption($rows['ALUMNO_ID']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/admin/alumnoAjax.php" method="POST" data-form="delete" autocomplete="off">
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
        
        /* controlador eliminar alumno*/
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

            $eliminar_alumno=modelo_alumno::eliminar_alumno_modelo("del_alumno",$id);

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

        /* controlador datos alumno */
        public function datos_alumno_controlador($tipo,$id,$ue){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);
            $ue=main_model::limpiar_cadena($ue);

            return modelo_alumno::datos_alumno_modelo($tipo,$id,$ue);
        }

        /* controlador actualizar alumno */
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
            $id_educativo=main_model::decryption($_POST['alumno_id_educativo_up']);
            $id_educativo=main_model::limpiar_cadena($id_educativo);

            $tutores = $_POST['field_id'];

            /* comprobar campos vacios */
            if($ci=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $fechaNac=="" || $sexo=="" || $lugarNac=="" || $telefono=="" || $id_educativo==""){
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

            /* combrobando tutores existentes  */
            foreach($tutores as $key => $value){
                if(isset($value) && $value!=""){
                    $padre_id=main_model::decryption($value);
                    $padre_id=main_model::limpiar_cadena($padre_id);
                    $check_tutor=main_model::ejecutar_consulta_simple("SELECT FAMILAR_ID FROM familiar WHERE FAMILAR_ID='$padre_id'");
                    if($check_tutor->rowCount()==0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El Tutor que selecciono no esta registrado en el sistema, intentelo nuevamente",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }

            /** Comprobar educativo existente */
            $check_educativo=main_model::ejecutar_consulta_simple("SELECT UA_ID FROM unidad_academico WHERE UA_ID='$id_educativo'");
            if($check_educativo->rowCount()==0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El ESTABLECIMIENTO seleccionado no se encuentra registrado en el sistema",
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
                "ID"=>$id,
                "IdE"=>$id_educativo
            ];

            if(modelo_alumno::actualizar_alumno_modelo($datos_alumno_up)){

                modelo_alumno::eliminar_alumno_modelo("del_relacion",$id);

                foreach($tutores as $key => $value){
                    if(isset($value) && $value!=""){
                        $value=main_model::decryption($value);
                        $agregar_tutor=modelo_alumno::agregar_tutor_alumno_modelo($id,main_model::limpiar_cadena($value));
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

        /* controlador datos alumno */
        public function ver_datos_alumno_controlador(){
            $id=main_model::decryption($_POST['id_alumno_verDatos']);
            $id=main_model::limpiar_cadena($id);
            
            $check_alumno=modelo_alumno::datos_alumno_modelo("Unico",$id,"");
            if($check_alumno->rowCount()==0){
                $campos=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar el alumno en el sistema",
                    "Tipo"=>"error"
                ];
            }else{
                $campos=$check_alumno->fetch(PDO::FETCH_ASSOC);
            }
            echo json_encode($campos);
        }

        /**-------------------------- TUTOR ----------------------------- */

        /**Controlador buscar padre */
        public function buscar_padre_controlador(){
            /**Recuperar texto */
            $padre=main_model::limpiar_cadena($_POST['buscar_padre']);

            /**comprobar texto */
            if($padre==""){
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                Debes introducir el CI, Nombre, Apellido
                            </p>
                        </div>';
                exit();
            }

            /**Seleccionando padre en la BD */
            session_start(['name'=>'SA']);
            $ua=$_SESSION['ua_id'];
            $datos_padre=main_model::ejecutar_consulta_simple("SELECT * FROM familiar WHERE 
            (CI_FA LIKE '%$padre%' OR NOMBRE_FA LIKE '%$padre%' OR APELLIDOP_FA LIKE '%$padre%' OR APELLIDOM_FA LIKE '%$padre%') 
            GROUP BY CI_FA");

            if($datos_padre->rowCount()>=1){
                $datos_padre=$datos_padre->fetchAll();

                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_padre as $rows){
                    $tabla.='<tr class="">
                                <td>'.$rows['CI_FA'].'</td>
                                <td>'.$rows['NOMBRE_FA'].' '.$rows['APELLIDOP_FA'].' '.$rows['APELLIDOM_FA'].'</td>
                                <td class="text-center"><button type="button" class="btn btn-primary" onclick="agregar_padre('.$rows['FAMILAR_ID'].')"><i class="fas fa-plus fa-fw"></i></button>
                                </td>
                            </tr>';
                }

                $tabla.='</tbody></table></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No hemos encontrado ningún Tutor en el sistema que coincida con <strong>'.$padre.'</strong>
                            </p>
                        </div>';
                exit();
            }
        }

        /**Controlador aqgregar padre */
        public function agregar_padre_controlador(){
            /**Recuperar id */
            $id=main_model::limpiar_cadena($_POST['id_agregar_padre']);

            /** Comprobando el padre en la BD */
            $check_padre=main_model::ejecutar_consulta_simple("SELECT * FROM familiar WHERE FAMILAR_ID='$id'");

            if($check_padre->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar el tutor en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_padre->fetch();
            }

            $datos_padre_up=[
                "ID"=>main_model::encryption($campos['FAMILAR_ID']),
                "CI"=>$campos['CI_FA'],
                "Nombre"=>$campos['NOMBRE_FA'],
                "ApellidoP"=>$campos['APELLIDOP_FA'],
                "ApellidoM"=>$campos['APELLIDOM_FA']
            ];
            echo json_encode($datos_padre_up);
        }

        /* controlador datos alumno padre */
        public function datos_alumno_padre_controlador(){
            $id=main_model::decryption($_POST['buscar_todos_tutores']);
            $id=main_model::limpiar_cadena($id);

            $datos=modelo_alumno::datos_alumno_modelo("Padre",$id,"");

            $campos=$datos->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($campos);
        }

        /* controlador datos alumno padre */
        public function encriptar_padre_controlador(){
            $id=main_model::encryption($_POST['id_tutor']);
            $id=main_model::limpiar_cadena($id);
            $datos_padre_up=[
                "ID"=>$id
            ];
            echo json_encode($datos_padre_up);
        }

        /**-------------------------- ESTABLECIMIENTO ----------------------------- */

        /**Controlador buscar educativo */
        public function buscar_educativo_controlador(){
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
                    $tabla.='<tr class="r">
                                <td>'.$rows['COD_UA'].'</td>
                                <td>'.$rows['NOMBRE_UA'].'</td>
                                <td class="text-center"><button type="button" class="btn btn-primary" onclick="agregar_educativo('.$rows['UA_ID'].')"><i class="fas fa-plus fa-fw"></i></button>
                            </td>
                            </tr>';
                }

                $tabla.='</tbody></table></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No hemos encontrado ningún establecimiento en el sistema que coincida con <strong>'.$educativo.'</strong>
                            </p>
                        </div>';
                exit();
            }
        }
    
        /**Controlador aqgregar educativo */
        public function agregar_educativo_controlador(){
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

            $datos_educativo_up=[
                "ID"=>main_model::encryption($campos['UA_ID']),
                "CodUA"=>$campos['COD_UA'],
                "Nombre"=>$campos['NOMBRE_UA']
            ];
            echo json_encode($datos_educativo_up);
        }
    }