<?php
    if($peticionAjax){
        require_once "../modelo/modelo_seccion.php";
    }else{
        require_once "./modelo/modelo_seccion.php";
    }

    
    class controlador_seccion extends modelo_seccion{

        /**Controlador buscar docente seccion */
        public function buscar_docente_seccion_controlador(){
            /**Recuperar texto */
            $docente=main_model::limpiar_cadena($_POST['buscar_docente']);

            /**comprobar texto */
            if($docente==""){
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                Debes introducir el CI, Nombre, Apellido, Telefono
                            </p>
                        </div>';
                exit();
            }

            /**Seleccionando docente en la BD */
            $datos_docente=main_model::ejecutar_consulta_simple("SELECT * FROM profesor WHERE 
            CI_P LIKE '%$docente%' OR NOMBRE_P LIKE '%$docente%' OR APELLIDOP_P LIKE '%$docente%'  
            OR TELEFONO_P LIKE '%$docente%' ORDER BY NOMBRE_P ASC");

            if($datos_docente->rowCount()>=1){
                $datos_docente=$datos_docente->fetchAll();

                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_docente as $rows){
                    $tabla.='<tr class="text-center">
                                <td>'.$rows['CI_P'].' - '.$rows['NOMBRE_P'].' '.$rows['APELLIDOP_P'].'</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="agregar_docente('.$rows['PROFESOR_ID'].')"><i class="fas fa-user-plus"></i></button>
                                    </td>
                            </tr>';
                }

                $tabla.='</tbody></table></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No hemos encontrado ningún docente en el sistema que coincida con <strong>'.$docente.'</strong>
                            </p>
                        </div>';
                exit();
            }
        }

        /**Controlador aqgregar docente seccion */
        public function agregar_docente_seccion_controlador(){
            /**Recuperar id */
            $id=main_model::limpiar_cadena($_POST['id_agregar_docente']);

            /** Comprobando el docente en la BD */
            $check_docente=main_model::ejecutar_consulta_simple("SELECT * FROM profesor WHERE PROFESOR_ID='$id'");

            if($check_docente->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar el docente en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_docente->fetch();
            }

            /**Iniciando la sesion */
            session_start(['name'=>'SA']);

            if(empty($_SESSION['datos_docente'])){
                $_SESSION['datos_docente']=[
                    "ID"=>$campos['PROFESOR_ID'],
                    "CI"=>$campos['CI_P'],
                    "Nombre"=>$campos['NOMBRE_P'],
                    "ApellidoP"=>$campos['APELLIDOP_P'],
                    "ApellidoM"=>$campos['APELLIDOM_P']
                ];

                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Docente Agregado",
                    "Texto"=>"El docente se agrego a la sección",
                    "Tipo"=>"success"
                ];
                echo json_encode($alerta);
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido agregar el docente a la sección",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
            }
        }

        /**Controlador eliminar docente seccion */
        public function eliminar_docente_seccion_controlador(){

            /**Iniciando la sesion */
            session_start(['name'=>'SA']);

            unset($_SESSION['datos_docente']);

            if(empty($_SESSION['datos_docente'])){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Docente removido",
                    "Texto"=>"Los datos del docente se han removido con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido remover los datos del docente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /**Controlador buscar alumno seccion */
        public function buscar_alumno_seccion_controlador(){
            /**Recuperar texto */
            $alumno=main_model::limpiar_cadena($_POST['buscar_alumno']);

            /**comprobar texto */
            if($alumno==""){
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                Debes introducir el CI, Nombre, Apellido, Telefono
                            </p>
                        </div>';
                exit();
            }

            /**Seleccionando alumno en la BD */
            $datos_alumno=main_model::ejecutar_consulta_simple("SELECT * FROM alumno WHERE 
            CI_A LIKE '%$alumno%' OR NOMBRE_A LIKE '%$alumno%' OR APELLIDOP_A LIKE '%$alumno%'  
            OR TELEFONO_A LIKE '%$alumno%' ORDER BY NOMBRE_A ASC");

            if($datos_alumno->rowCount()>=1){
                $datos_alumno=$datos_alumno->fetchAll();

                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_alumno as $rows){
                    $tabla.='<tr class="text-center">
                                <td>'.$rows['CI_A'].' - '.$rows['NOMBRE_A'].' '.$rows['APELLIDOP_A'].'</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="agregar_alumno('.$rows['ALUMNO_ID'].')"><i class="fas fa-user-plus"></i></button>
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

        /**Controlador agregar alumno seccion */
        public function agregar_alumno_seccion_controlador(){

            /**Recuperar id del alumno */
            $id=main_model::limpiar_cadena($_POST['id_agregar_seccion']);

            /**Comprobando alumno */
            $check_alumno=main_model::ejecutar_consulta_simple("SELECT * FROM alumno WHERE ALUMNO_ID='$id' ");
            if($check_alumno->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un erro inesperado",
                    "Texto"=>"No hemos podido seleccionar el alumno, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_alumno->fetch();
            }

            /**Recuperando detalles del alumno */
            $formato=main_model::limpiar_cadena($_POST['detalle_formato']);
            $cantidad=main_model::limpiar_cadena($_POST['detalle_cantidad']);
            $tiempo=main_model::limpiar_cadena($_POST['detalle_tiempo']);
            $costo=main_model::limpiar_cadena($_POST['detalle_costo_tiempo']);

            if($cantidad=="" || $tiempo=="" || $costo==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[0-9]{1,7}",$cantidad)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La cantidad no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[0-9]{1,7}",$tiempo)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El tiempo no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(main_model::verificar_datos("[0-9.]{1,15}",$costo)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El costo no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($formato!="Horas" && $formato!="Dias" && $formato!="Evente" && $formato!="Mes"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El formato no es válido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            session_start(['name'=>'SA']);

            if(empty($_SESSION['datos_alumno'][$id])){
                $costo=number_format($costo,2,'.','');

                $_SESSION['datos_alumno'][$id]=[
                    "ID"=>$campos['ALUMNO_ID'],
                    "CI"=>$campos['CI_A'],
                    "Nombre"=>$campos['NOMBRE_A'],
                    "ApellidoP"=>$campos['APELLIDOP_A'],
                    "ApellidoM"=>$campos['APELLIDOM_A'],
                    "Formato"=>$formato,
                    "Cantidad"=>$cantidad,
                    "Tiempo"=>$tiempo,
                    "Costo"=>$costo
                ];
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Alumno agregado",
                    "Texto"=>"El alumno ha sido agregado a la seccion",
                    "Tipo"=>"success"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El alumno que intenta agregar ya se encuentra seleccionado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /**Controlador eliminar alumno seccion */
        public function eliminar_alumno_seccion_controlador(){

            /**recuperar el id del alumno */
            $id=main_model::limpiar_cadena($_POST['id_eliminar_alumno']);
            /**Iniciando la sesion */
            session_start(['name'=>'SA']);

            unset($_SESSION['datos_alumno'][$id]);

            if(empty($_SESSION['datos_alumno'][$id])){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Alumno removido",
                    "Texto"=>"Los datos del alumno se han removido con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido remover los datos del alumno",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /**Controlador agregar seccion */
        public function apoyo(){

            /*  == EXPRESION REGULAR PARA LAS HORAS ==
            ([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])*/

            /**Iniciando la sesion */
            session_start(['name'=>'SA']);

            /**comprobando alumno */
            if($_SESSION['cantidad_alumno']==0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un erro inesperado",
                    "Texto"=>"No has seleecionado ningun alumno para crear al seccion",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /**comprobando docente */
            if(empty($_SESSION['datos_docente'])){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un erro inesperado",
                    "Texto"=>"No has seleecionado ningun docente para crear al seccion",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /**comrprobnado integridad de las fechas */
            if(main_model::verificar_fecha($fecha)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La fecha no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $datos_seccion_reg=[
                "Nombre"=>$nombre,
                "Docente"=>$_SESSION['datos_docente']['ID']
            ];
        }

        /**------------------------------------- valido ---------------------------------- */

        /**Controlador agregar seccion */
        public function agregar_seccion_controlador(){

            $nombre=main_model::limpiar_cadena($_POST['seccion_nombre_reg']);
            $capacidad=main_model::limpiar_cadena($_POST['seccion_capacidad_reg']);
            $creado=main_model::limpiar_cadena($_POST['seccion_creado_reg']);
    

            /* comprobar campos vacios */
            if($nombre=="" || $capacidad=="" || $creado==""){
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
            if(main_model::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,15}",$nombre)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El Nombre no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_SEC FROM seccion WHERE NOMBRE_SEC='$nombre'");
                if($check_nombre->rowCount()>0){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El Nombre ingresado ya se encuentra registrado en el sistema",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
   
            if(main_model::verificar_datos("[0-9]{1,2}",$capacidad)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $datos_seccion_reg=[
                "Nombre"=>$nombre,
                "Capacidad"=>$capacidad,
                "Creado"=>$creado,
            ];

            $agregar_seccion=modelo_seccion::agregar_seccion_modelo($datos_seccion_reg);
            
            if($agregar_seccion->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Sección registrado",
                    "Texto"=>"Los datos de la sección han sido registrados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar la sección",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador paginar seccion*/
        public function paginador_seccion_controlador($pagina,$registros,$privilegio,$url,$busqueda){
            $pagina=main_model::limpiar_cadena($pagina);
            $registros=main_model::limpiar_cadena($registros);
            $privilegio=main_model::limpiar_cadena($privilegio);
            $url=main_model::limpiar_cadena($url);
            $url=SERVERURL.$url."/";
            $busqueda=main_model::limpiar_cadena($busqueda);

            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM seccion WHERE NOMBRE_SEC LIKE '%$busqueda%' 
                OR CAPACIDAD_SEC LIKE '%$busqueda%' OR CREADO_SEC LIKE '%$busqueda%'
                ORDER BY NOMBRE_SEC ASC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM seccion ORDER BY NOMBRE_SEC ASC LIMIT $inicio,$registros";
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
                                <th>CAPACIDAD</th>
                                <th>CREADO</th>';
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
                        <td>'.$rows['NOMBRE_SEC'].'</td>
                        <td>'.$rows['CAPACIDAD_SEC'].'</td>
                        <td>'.$rows['CREADO_SEC'].'</td>';

                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'seccion-update/'.main_model::encryption($rows['COD_SEC']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/seccionAjax.php" method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="seccion_id_del" value="'.main_model::encryption($rows['COD_SEC']).'">
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
                    $tabla.='<tr class="text-center"><td colspan="6">
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="6">No hay registros en el sistema</td></tr>';
                }
            }
            $tabla.='</tbody></table></div>';

            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando sección '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }

        /* controlador datos seccion */
        public function datos_seccion_controlador($tipo,$id){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);

            return modelo_seccion::datos_seccion_modelo($tipo,$id);
        }

        /* controlador actualizar seccion */
        public function actualizar_seccion_controlador(){
            // Recibiendo el ID
            $id=main_model::decryption($_POST['seccion_id_up']);
            $id=main_model::limpiar_cadena($id);

            // comprobar el seccion en la BD
            $check_seccion=main_model::ejecutar_consulta_simple("SELECT * FROM seccion WHERE COD_SEC='$id'");
            if($check_seccion->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado la seccion en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_seccion->fetch();
            }

            $nombre=main_model::limpiar_cadena($_POST['seccion_nombre_up']);
            $capacidad=main_model::limpiar_cadena($_POST['seccion_capacidad_up']);

            /* comprobar campos vacios */
            if($nombre=="" || $capacidad==""){
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
            if($nombre!=$campos['NOMBRE_SEC'] && $nombre!=""){
                if(main_model::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,15}",$nombre)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El Nombre no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_SEC FROM seccion WHERE NOMBRE_SEC='$nombre'");
                    if($check_nombre->rowCount()>0){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"El Nombre ingresado ya se encuentra registrado en el sistema",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }
            }
   
            if(main_model::verificar_datos("[0-9]{1,2}",$capacidad)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La Capacidad no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
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
            $datos_seccion_up=[
                "ID"=>$id,
                "Nombre"=>$nombre,
                "Capacidad"=>$capacidad,
            ];

            if(modelo_seccion::actualizar_seccion_modelo($datos_seccion_up)){
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

        /* controlador eliminar seccion*/
        public function eliminar_seccion_controlador(){
            /* recibiendo id del seccion */
            $id=main_model::decryption($_POST['seccion_id_del']);
            $id=main_model::limpiar_cadena($id);

            /* Comprobar el seccion en BD */
            $check_seccion=main_model::ejecutar_consulta_simple("SELECT COD_SEC FROM seccion WHERE COD_SEC='$id'");
            if($check_seccion->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La seccion que intenta eliminar no existe en el sistema",
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

            $eliminar_seccion=modelo_seccion::eliminar_seccion_modelo($id);

            if($eliminar_seccion->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Sección eliminado",
                    "Texto"=>"La Sección ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar la Sección, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

    }
