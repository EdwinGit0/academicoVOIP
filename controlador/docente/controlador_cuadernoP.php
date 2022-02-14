<?php
    if($peticionAjax){
        require_once "../../modelo/docente/modelo_cuadernoP.php";
    }else{
        require_once "./modelo/docente/modelo_cuadernoP.php";
    }

    
    class controlador_cuadernoP extends modelo_cuadernoP{

        /**--------------------------------TREE CURSO-------------------------------------- */
        /**Controlador crear tree curso */
        public function tree_curso_controlador($id_docente){
            $id_docente=main_model::limpiar_cadena($id_docente);

            $anio=$_SESSION['anio_academico'];
            $turno=main_model::ejecutar_consulta_simple("SELECT C.TURNO_CUR FROM curso AS C, cur_prof AS CP, 
            profesor AS P WHERE C.COD_CUR=CP.COD_CUR AND CP.PROFESOR_ID=P.PROFESOR_ID 
            AND P.PROFESOR_ID='$id_docente' AND YEAR(FECHA_INI_CP)='$anio' GROUP BY C.TURNO_CUR");

            if($turno->rowCount()>=1){
                $turno=$turno->fetchAll();
                $tabla='<div class="card-header text-white bg-dark text-center"><h6>Cursos</h6></div><ul>';
                foreach($turno as $rows){
         
                    $tabla.='<li>
                                <span><i class="fas fa-plus-circle"></i> &nbsp; '.$rows['TURNO_CUR'].'</span>
                                '.controlador_cuadernoP::tree_curso_grado($rows['TURNO_CUR'],$id_docente,$anio).'
                            </li>';    
                }
                $tabla.='</ul>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No tiene registrado cursos en el sistema
                            </p>
                        </div>';
                exit();
            }
        }

        /**Controlador crear tree curso grado */
        public function tree_curso_grado($turno,$id_docente,$anio){
            $grado=main_model::ejecutar_consulta_simple("SELECT C.TURNO_CUR, C.GRADO_CUR FROM curso AS C, cur_prof AS CP, 
            profesor AS P WHERE C.COD_CUR=CP.COD_CUR AND CP.PROFESOR_ID=P.PROFESOR_ID 
            AND P.PROFESOR_ID='$id_docente' AND C.TURNO_CUR='$turno' AND YEAR(FECHA_INI_CP)='$anio' GROUP BY C.GRADO_CUR");

            if($grado->rowCount()>=1){
                $grado=$grado->fetchAll();
                $tabla='<ul>';
                foreach($grado as $rows){
                    $tabla.='<li>
                                <span><i class="fas fa-plus-circle"></i> &nbsp; '.$rows['GRADO_CUR'].'</span>
                                '.controlador_cuadernoP::tree_curso_seccion($rows['TURNO_CUR'],$rows['GRADO_CUR'],$id_docente,$anio).'
                            </li>';    
                }
                $tabla.='</ul>';
            }
            return $tabla;
        }

        /**Controlador crear tree curso seccion */
        public function tree_curso_seccion($turno,$grado,$id_docente,$anio){
            $seccion=main_model::ejecutar_consulta_simple("SELECT C.COD_CUR, C.SECCION_CUR FROM curso AS C, cur_prof AS CP, 
            profesor AS P WHERE C.COD_CUR=CP.COD_CUR AND CP.PROFESOR_ID=P.PROFESOR_ID AND 
            P.PROFESOR_ID='$id_docente' AND C.TURNO_CUR='$turno' AND C.GRADO_CUR='$grado' AND YEAR(FECHA_INI_CP)='$anio' GROUP BY C.SECCION_CUR");

            if($seccion->rowCount()>=1){
                $seccion=$seccion->fetchAll();
                $tabla='<ul>';
                foreach($seccion as $rows){
                    $tabla.='<li>
                                <span><i class="fas fa-cog"></i> &nbsp; '.$rows['SECCION_CUR'].'</span>                        
                                <input type="hidden" value="'.main_model::encryption($rows['COD_CUR']).'">                            
                                <button type="button" class="bookPedago btn btn-raised btn-primary btn-circle btn-sm" data-toggle="popover" data-trigger="hover" data-content="Cuaderno pedagógico"><i class="fas fa-book"></i></button>
                            </li>';    
                }
                $tabla.='</ul>';
            }
            return $tabla;
        }

        /**-------------------------------- ASIGNACION CURSO ALUMNO -------------------------------------- */
        /**Controlador asignar alumno a curso*/
        public function referencial_curso_controlador(){
            $id_curso = main_model::decryption($_POST['curso_id_referencial']);
            $id_curso = main_model::limpiar_cadena($id_curso);
            $pagina = main_model::limpiar_cadena($_POST['alumno_id']);
            $url = main_model::limpiar_cadena($_POST['url']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);

            $check_curso=main_model::ejecutar_consulta_simple("SELECT * FROM curso WHERE COD_CUR='$id_curso'");
            if($check_curso->rowCount()>=1){
                $campos=$check_curso->fetch();
                session_start(['name'=>'SA']);
                $tabla = '<div class="card-header text-white bg-dark">
                            <div class="col-12 col-md-12">
                                <div class="input-group">
                                    <span class="mr-auto"><h6>Turno: '.$campos['TURNO_CUR'].' &nbsp; | &nbsp; '.$campos['GRADO_CUR'].' - '.$campos['SECCION_CUR'].'</h6></span>
                                    <div class="input-group-addon"></div>
                                    <button type="button" class="'.$tipo.' btn btn-raised btn-success"><i class="fas fa-plus fa-fw"></i> &nbsp; Añadir</button>
                                </div>
                            </div> 
                        </div>';
                        if($tipo=="alumno"){
                            $tabla.=controlador_cuadernoP::paginador_alumno_controlador($pagina,15,$_SESSION['privilegio_sa'],$url,$_SESSION['ua_id'],$id_curso,$anio_academico);
                        }elseif($tipo=="docente"){
                            $tabla.=controlador_cuadernoP::paginador_docente_controlador($pagina,15,$_SESSION['privilegio_sa'],$url,$_SESSION['ua_id'],$id_curso,$anio_academico);
                        }
                return $tabla;
                exit();
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                El curso seleccionado no se encuentra registrado en el sistema
                            </p>
                        </div>';
                exit();
            }
        }

        /* controlador paginar alumno*/
        public function paginador_alumno_controlador($pagina,$registros,$privilegio,$url,$ue,$id_curso,$anio_academico){
            $pagina=main_model::limpiar_cadena($pagina);
            $registros=main_model::limpiar_cadena($registros);
            $privilegio=main_model::limpiar_cadena($privilegio);
            $url=main_model::limpiar_cadena($url);
            $url=SERVERURL.$url."/";
            $ue=main_model::limpiar_cadena($ue);

            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            $consulta="SELECT SQL_CALC_FOUND_ROWS A.* FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ASC LIMIT $inicio,$registros";
            
            $conexion = main_model::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();
            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();
            $Npaginas=ceil($total/$registros);

            $tabla.='<div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-dark table-sm" id="tabla_asignar_curso">
                        <thead>
                            <tr class="text-center roboto-medium">
                                <th>#</th>
                                <th>CI</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>SEXO</th>
                                <th>FECHA DE NAC.</th>
                                <th>TELÉFONO</th>';
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
                        <td>'.$rows['TELEFONO_A'].'</td>';
                        if($privilegio==1){
                            $id_alumno="'".main_model::encryption($rows['ALUMNO_ID'])."'";
                            $tabla.='<td>
                                        <button type="button" class="btn btn-warning" onclick="eliminar_alumno_curso('.$id_alumno.')">
                                                <i class="far fa-trash-alt"></i>
                                        </button>
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

            return $tabla.='</div>';
        }
    }