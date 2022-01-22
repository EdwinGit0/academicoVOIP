<?php
    if($peticionAjax){
        require_once "../modelo/modelo_curso.php";
    }else{
        require_once "./modelo/modelo_curso.php";
    }

    
    class controlador_curso extends modelo_curso{

        /**Controlador agregar curso */
        public function agregar_curso_controlador(){

            $turno=main_model::limpiar_cadena($_POST['curso_turno_reg']);
            $grado=main_model::limpiar_cadena($_POST['curso_grado_reg']);
            $seccion=main_model::limpiar_cadena($_POST['curso_seccion_reg']);
            $capacidad=main_model::limpiar_cadena($_POST['curso_capacidad_reg']);
            $creado=main_model::limpiar_cadena($_POST['curso_creado_reg']);
    

            /* comprobar campos vacios */
            if($turno=="" || $grado=="" || $seccion=="" || $capacidad==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $datos_curso_reg=[
                "Turno"=>$turno,
                "Grado"=>$grado,
                "Seccion"=>$seccion,
                "Capacidad"=>$capacidad,
                "Creado"=>$creado,
            ];

            $agregar_curso=modelo_curso::agregar_curso_modelo($datos_curso_reg);
            
            if($agregar_curso->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Curso registrado",
                    "Texto"=>"Los datos del curso han sido registrados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el curso",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador paginar curso*/
        public function paginador_curso_controlador($pagina,$registros,$privilegio,$url,$busqueda){
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
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM curso WHERE TURNO_CUR LIKE '%$busqueda%' 
                OR GRADO_CUR LIKE '%$busqueda%' OR SECCION_CUR LIKE '%$busqueda%' OR CAPACIDAD_CUR LIKE '%$busqueda%'
                ORDER BY GRADO_CUR ASC LIMIT $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM curso ORDER BY GRADO_CUR ASC LIMIT $inicio,$registros";
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
                                <th>TURNO</th>
                                <th>GRADO</th>
                                <th>SECCIÓN</th>
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
                        <td>'.$rows['TURNO_CUR'].'</td>
                        <td>'.$rows['GRADO_CUR'].'</td>
                        <td>'.$rows['SECCION_CUR'].'</td>
                        <td>'.$rows['CAPACIDAD_CUR'].'</td>
                        <td>'.$rows['CREADO_CUR'].'</td>';

                        if($privilegio==1 || $privilegio ==2){
                            $tabla.='<td>
                                        <a href="'.SERVERURL.'curso-update/'.main_model::encryption($rows['COD_CUR']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                        }
                        
                        if($privilegio==1){
                            $tabla.='<td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/cursoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="curso_id_del" value="'.main_model::encryption($rows['COD_CUR']).'">
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
                $tabla.='<p class="text-right">Mostrando curso '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }

        /* controlador datos curso */
        public function datos_curso_controlador($tipo,$id){
            $tipo=main_model::limpiar_cadena($tipo);
            $id=main_model::decryption($id);
            $id=main_model::limpiar_cadena($id);

            return modelo_curso::datos_curso_modelo($tipo,$id);
        }

        /* controlador actualizar curso */
        public function actualizar_curso_controlador(){
            // Recibiendo el ID
            $id=main_model::decryption($_POST['curso_id_up']);
            $id=main_model::limpiar_cadena($id);

            // comprobar el curso en la BD
            $check_curso=main_model::ejecutar_consulta_simple("SELECT * FROM curso WHERE COD_CUR='$id'");
            if($check_curso->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el curso en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_curso->fetch();
            }

            $turno=main_model::limpiar_cadena($_POST['curso_turno_up']);
            $grado=main_model::limpiar_cadena($_POST['curso_grado_up']);
            $seccion=main_model::limpiar_cadena($_POST['curso_seccion_up']);
            $capacidad=main_model::limpiar_cadena($_POST['curso_capacidad_up']);

            /* comprobar campos vacios */
            if($turno=="" || $grado=="" || $seccion=="" || $capacidad==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos obligatorios",
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
            $datos_curso_up=[
                "ID"=>$id,
                "Turno"=>$turno,
                "Grado"=>$grado,
                "Seccion"=>$seccion,
                "Capacidad"=>$capacidad,
            ];

            if(modelo_curso::actualizar_curso_modelo($datos_curso_up)){
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

        /* controlador eliminar curso*/
        public function eliminar_curso_controlador(){
            /* recibiendo id del curso */
            $id=main_model::decryption($_POST['curso_id_del']);
            $id=main_model::limpiar_cadena($id);

            /* Comprobar el curso en BD */
            $check_curso=main_model::ejecutar_consulta_simple("SELECT COD_CUR FROM curso WHERE COD_CUR='$id'");
            if($check_curso->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El curso que intenta eliminar no existe en el sistema",
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

            $eliminar_curso=modelo_curso::eliminar_curso_modelo($id);

            if($eliminar_curso->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Curso eliminado",
                    "Texto"=>"El curso ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el curso, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

    }
