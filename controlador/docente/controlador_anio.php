<?php
    if($peticionAjax){
        require_once "../../modelo/docente/modelo_anio.php";
    }else{
        require_once "./modelo/docente/modelo_anio.php";
    }

    
    class controlador_anio extends modelo_anio{

        /* controlador paginar anio*/
        public function paginador_anio_controlador($pagina,$registros,$url,$busqueda){
            $pagina=main_model::limpiar_cadena($pagina);
            $registros=main_model::limpiar_cadena($registros);
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
                                <th>SELECCIONAR</th>
                            </tr>
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
                        </td>
                        </tr>';

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

        /** Asignar Anio academico */
        public function asignar_anio_controlador(){
            $anio=main_model::decryption($_POST['anio_id_asig']);
            $anio=main_model::limpiar_cadena($anio);

            $check_anio=main_model::ejecutar_consulta_simple("SELECT * FROM anio_academico WHERE COD_ANIO='$anio'");
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

            session_start(['name'=>'SA']);
            $_SESSION['anio_academico']=$campos['NOMBRE_ANIO'];

            $alerta=[
                "Alerta"=>"recargar",
                "Titulo"=>"Datos actualizados",
                "Texto"=>"La gestión ha sido actualizados con exito",
                "Tipo"=>"success"
            ];

            echo json_encode($alerta);
        }

    }
