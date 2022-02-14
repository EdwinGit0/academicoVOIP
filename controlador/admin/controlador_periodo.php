<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_periodo.php";
    }else{
        require_once "./modelo/admin/modelo_periodo.php";
    }

    
    class controlador_periodo extends modelo_periodo{

        /**Controlador agregar periodo */
        public function agregar_periodo_controlador(){

            $nombre=main_model::limpiar_cadena($_POST['periodo_nombre_reg']);
            $creado=main_model::limpiar_cadena($_POST['periodo_creado_reg']);
    

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
            if(main_model::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,50}",$nombre)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El Nombre no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_PER FROM periodo WHERE NOMBRE_PER='$nombre'");
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

            $datos_periodo_reg=[
                "Nombre"=>$nombre,
                "Creado"=>$creado,
            ];

            $agregar_periodo=modelo_periodo::agregar_periodo_modelo($datos_periodo_reg);
            
            if($agregar_periodo->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Periodo registrado",
                    "Texto"=>"Los datos del periodo han sido registrados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el periodo",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador paginar periodo*/
        public function paginador_periodo_controlador($pagina,$registros,$privilegio,$url,$busqueda){
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
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM periodo WHERE NOMBRE_PER LIKE '%$busqueda%' 
                OR CREADO_PER LIKE '%$busqueda%'
                ORDER BY NOMBRE_PER ASC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM periodo ORDER BY NOMBRE_PER ASC LIMIT $inicio,$registros";
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
                        <td>'.$rows['NOMBRE_PER'].'</td>
                        <td>'.$rows['CREADO_PER'].'</td>';

                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'admin/periodo-update/'.main_model::encryption($rows['COD_PER']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/admin/periodoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="periodo_id_del" value="'.main_model::encryption($rows['COD_PER']).'">
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
                $tabla.='<p class="text-right">Mostrando periodo '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }

        /* controlador datos periodo */
        public function datos_periodo_controlador($tipo,$id){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);

            return modelo_periodo::datos_periodo_modelo($tipo,$id);
        }

        /* controlador actualizar periodo */
        public function actualizar_periodo_controlador(){
            // Recibiendo el ID
            $id=main_model::decryption($_POST['periodo_id_up']);
            $id=main_model::limpiar_cadena($id);

            // comprobar el periodo en la BD
            $check_periodo=main_model::ejecutar_consulta_simple("SELECT * FROM periodo WHERE COD_PER='$id'");
            if($check_periodo->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el periodo en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_periodo->fetch();
            }

            $nombre=main_model::limpiar_cadena($_POST['periodo_nombre_up']);

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
            if($nombre!=$campos['NOMBRE_PER'] && $nombre!=""){
                if(main_model::verificar_datos("[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,20}",$nombre)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El Nombre no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    $check_nombre=main_model::ejecutar_consulta_simple("SELECT NOMBRE_PER FROM periodo WHERE NOMBRE_PER='$nombre'");
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
            $datos_periodo_up=[
                "ID"=>$id,
                "Nombre"=>$nombre,
            ];

            if(modelo_periodo::actualizar_periodo_modelo($datos_periodo_up)){
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

        /* controlador eliminar periodo*/
        public function eliminar_periodo_controlador(){
            /* recibiendo id del periodo */
            $id=main_model::decryption($_POST['periodo_id_del']);
            $id=main_model::limpiar_cadena($id);

            /* Comprobar el periodo en BD */
            $check_periodo=main_model::ejecutar_consulta_simple("SELECT COD_PER FROM periodo WHERE COD_PER='$id'");
            if($check_periodo->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El periodo que intenta eliminar no existe en el sistema",
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

            $eliminar_periodo=modelo_periodo::eliminar_periodo_modelo($id);

            if($eliminar_periodo->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Periodo eliminado",
                    "Texto"=>"El periodo ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el periodo, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

    }
