<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_area.php";
    }else{
        require_once "./modelo/admin/modelo_area.php";
    }

    
    class controlador_area extends modelo_area{

        /**Controlador agregar area */
        public function agregar_area_controlador(){

            $nombre=main_model::limpiar_cadena($_POST['area_nombre_reg']);
            $info=main_model::limpiar_cadena($_POST['area_info_reg']);
            $campo=main_model::limpiar_cadena($_POST['area_campo_reg']);
            $creado=main_model::limpiar_cadena($_POST['area_creado_reg']);
    

            /* comprobar campos vacios */
            if($nombre=="" || $nombre==null){
                $alerta=[
                    "Alerta"=>"simple",
                    "Tipo"=>"validation",
                    "Input"=>"area_nombre",
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Verficando integridad de los datos */
            if(main_model::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,50}",$nombre)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Tipo"=>"validation",
                    "Input"=>"area_nombre",
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_AREA FROM area WHERE NOMBRE_AREA='$nombre'");
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

            if($campo=="" || $campo==null){
                $alerta=[
                    "Alerta"=>"simple",
                    "Tipo"=>"validation",
                    "Input"=>"area_campo",
                ];
                echo json_encode($alerta);
                exit();
            }

            if($info!=""){
                if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}",$info)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Tipo"=>"validation",
                        "Input"=>"area_info",
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            $datos_area_reg=[
                "Nombre"=>$nombre,
                "Campo"=>$campo,
                "Info"=>$info,
                "Creado"=>$creado
            ];

            $agregar_area=modelo_area::agregar_area_modelo($datos_area_reg);
            if($agregar_area->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"area registrado",
                    "Texto"=>"Los datos del área han sido registrados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el area",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador paginar area*/
        public function paginador_area_controlador($pagina,$registros,$privilegio,$url,$busqueda){
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
                $consulta="SELECT DISTINCT SQL_CALC_FOUND_ROWS * FROM area WHERE NOMBRE_AREA LIKE '%$busqueda%' 
                OR INFO LIKE '%$busqueda%' OR CREADO_AREA LIKE '%$busqueda%' 
                ORDER BY NOMBRE_AREA ASC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT DISTINCT SQL_CALC_FOUND_ROWS * FROM area ORDER BY NOMBRE_AREA ASC LIMIT $inicio,$registros";
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
                                <th>INFORMACIÓN</th>';
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
                        <td>'.$rows['NOMBRE_AREA'].'</td>
                        <td>'.$rows['CREADO_AREA'].'</td>
                        <td><button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="'.$rows['NOMBRE_AREA'].'" data-content="'.$rows['INFO'].'">
                        <i class="fas fa-info-circle"></i>
                        </button></td>';
                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'admin/area-update/'.main_model::encryption($rows['COD_AREA']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/admin/areaAjax.php" method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="area_id_del" value="'.main_model::encryption($rows['COD_AREA']).'">
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
                $tabla.='<p class="text-right">Mostrando area '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }

        /* controlador datos area */
        public function datos_area_controlador($tipo,$id){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);

            return modelo_area::datos_area_modelo($tipo,$id);
        }

        /* controlador actualizar area */
        public function actualizar_area_controlador(){
            // Recibiendo el ID
            $area_id=main_model::decryption($_POST['area_id_up']);
            $area_id=main_model::limpiar_cadena($area_id);
    
            // comprobar el area en la BD
            $check_area=main_model::ejecutar_consulta_simple("SELECT * FROM area WHERE COD_AREA='$area_id'");
            if($check_area->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el área en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_area->fetch();
            }

            $nombre=main_model::limpiar_cadena($_POST['area_nombre_up']);
            $campo=main_model::limpiar_cadena($_POST['area_campo_up']);
            $info=main_model::limpiar_cadena($_POST['area_info_up']);

            /* comprobar campos vacios */
            if($nombre=="" || $nombre==null){
                $alerta=[
                    "Alerta"=>"simple",
                    "Tipo"=>"validation",
                    "Input"=>"area_nombre",
                ];
                echo json_encode($alerta);
                exit();
            }

            /* Verficando integridad de los datos */
            if($nombre!=$campos['NOMBRE_AREA'] && $nombre!=""){
                if(main_model::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,50}",$nombre)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Tipo"=>"validation",
                        "Input"=>"area_nombre",
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_AREA FROM area WHERE NOMBRE_AREA='$nombre'");
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

            if($campo=="" || $campo==null){
                $alerta=[
                    "Alerta"=>"simple",
                    "Tipo"=>"validation",
                    "Input"=>"area_campo",
                ];
                echo json_encode($alerta);
                exit();
            }

            if($info!=""){
                if(main_model::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}",$info)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Tipo"=>"validation",
                        "Input"=>"area_info",
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
            $datos_area_up=[
                "ID"=>$area_id,
                "Campo"=>$campo,
                "Nombre"=>$nombre,
                "Info"=>$info,
            ];

            if(modelo_area::actualizar_area_modelo($datos_area_up)){
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

        /* controlador eliminar area*/
        public function eliminar_area_controlador(){
            /* recibiendo id del area */
            $id=main_model::decryption($_POST['area_id_del']);
            $id=main_model::limpiar_cadena($id);

            /* Comprobar el area en BD */
            $check_area=main_model::ejecutar_consulta_simple("SELECT COD_AREA FROM area WHERE COD_AREA='$id'");
            if($check_area->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El área que intenta eliminar no existe en el sistema",
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

            $eliminar_area=modelo_area::eliminar_area_modelo($id);
            if($eliminar_area->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"area eliminado",
                    "Texto"=>"El área ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el area, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }
    }
