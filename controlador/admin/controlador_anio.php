<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_anio.php";
    }else{
        require_once "./modelo/admin/modelo_anio.php";
    }

    
    class controlador_anio extends modelo_anio{

        /**Controlador agregar anio */
        public function agregar_anio_controlador(){

            $nombre=main_model::limpiar_cadena($_POST['anio_nombre_reg']);
            $creado=main_model::limpiar_cadena($_POST['anio_creado_reg']);
    

            /* comprobar campos vacios */
            if($nombre=="" || $creado==""){
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
            if(main_model::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{4,5}",$nombre)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El Nombre no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$nombre'");
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

            $datos_anio_reg=[
                "Nombre"=>$nombre,
                "Creado"=>$creado,
            ];

            $agregar_anio=modelo_anio::agregar_anio_modelo($datos_anio_reg);
            
            if($agregar_anio->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Año académico registrado",
                    "Texto"=>"Los datos del año académico han sido registrados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el anio",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador paginar anio*/
        public function paginador_anio_controlador($pagina,$registros,$privilegio,$url,$busqueda){
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
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM anio_academico WHERE NOMBRE_ANIO LIKE '%$busqueda%' 
                OR CREADO LIKE '%$busqueda%'
                ORDER BY NOMBRE_ANIO DESC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM anio_academico ORDER BY NOMBRE_ANIO DESC LIMIT $inicio,$registros";
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
                                <th>CREADO</th>
                                <th>SELECCIONAR</th>';
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
                        <td>'.$rows['NOMBRE_ANIO'].'</td>
                        <td>'.$rows['CREADO'].'</td>
                        <td>
                            <form class="FormularioAjax" action="'.SERVERURL.'ajax/docente/anioAjax.php" method="POST" data-form="actualizar" autocomplete="off">
                                <input type="hidden" name="anio_id_asig" value="'.main_model::encryption($rows['COD_ANIO']).'">';
                                if($rows['NOMBRE_ANIO']==$_SESSION['anio_academico']){
                                    $tabla.='<button type="submit" class="btn btn-success">
                                                <i class="fas fa-check-circle"></i>
                                            </button>';
                                }else{
                                    $tabla.='<button type="submit" class="btn btn-warning">
                                                <i class="fas fa-times-circle"></i>
                                            </button>';
                                }
                                $tabla.='</form>
                        </td>';

                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'admin/anio-update/'.main_model::encryption($rows['COD_ANIO']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/admin/anioAjax.php" method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="anio_id_del" value="'.main_model::encryption($rows['COD_ANIO']).'">
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
                    $tabla.='<tr class="text-center"><td colspan="5">
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="5">No hay registros en el sistema</td></tr>';
                }
            }
            $tabla.='</tbody></table></div>';

            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando año académico '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }

        /* controlador datos anio */
        public function datos_anio_controlador($tipo,$id){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);

            return modelo_anio::datos_anio_modelo($tipo,$id);
        }

        /* controlador actualizar anio */
        public function actualizar_anio_controlador(){
            // Recibiendo el ID
            $id=main_model::decryption($_POST['anio_id_up']);
            $id=main_model::limpiar_cadena($id);

            // comprobar el anio en la BD
            $check_anio=main_model::ejecutar_consulta_simple("SELECT * FROM anio_academico WHERE COD_ANIO='$id'");
            if($check_anio->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el año caadémico en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_anio->fetch();
            }

            $nombre=main_model::limpiar_cadena($_POST['anio_nombre_up']);

            /* comprobar campos vacios */
            if($nombre==""){
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
            if($nombre!=$campos['NOMBRE_ANIO'] && $nombre!=""){
                if(main_model::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{4,5}",$nombre)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El Nombre no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$nombre'");
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
            $datos_anio_up=[
                "ID"=>$id,
                "Nombre"=>$nombre,
            ];

            if(modelo_anio::actualizar_anio_modelo($datos_anio_up)){
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

        /* controlador eliminar anio*/
        public function eliminar_anio_controlador(){
            /* recibiendo id del anio */
            $id=main_model::decryption($_POST['anio_id_del']);
            $id=main_model::limpiar_cadena($id);

            /* Comprobar el anio en BD */
            $check_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE COD_ANIO='$id'");
            if($check_anio->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El año académico que intenta eliminar no existe en el sistema",
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

            $eliminar_anio=modelo_anio::eliminar_anio_modelo($id);

            if($eliminar_anio->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Año académico eliminado",
                    "Texto"=>"El año académico ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el año académico, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

    }
