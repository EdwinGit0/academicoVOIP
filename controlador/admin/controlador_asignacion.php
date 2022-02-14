<?php
    if($peticionAjax){
        require_once "../../modelo/admin/modelo_asignacion.php";
    }else{
        require_once "./modelo/admin/modelo_asignacion.php";
    }

    
    class controlador_asignacion extends modelo_asignacion{

        /**--------------------------------TREE CURSO-------------------------------------- */
        /**Controlador crear tree curso */
        public function tree_curso_controlador(){
            $turno=main_model::ejecutar_consulta_simple("SELECT TURNO_CUR FROM curso GROUP BY TURNO_CUR");

            if($turno->rowCount()>=1){
                $turno=$turno->fetchAll();
                $tabla='<div class="card-header text-white bg-dark text-center"><h6>Cursos</h6></div><ul>';
                foreach($turno as $rows){
         
                    $tabla.='<li>
                                <span><i class="fas fa-plus-circle"></i> &nbsp; '.$rows['TURNO_CUR'].'</span>
                                '.controlador_asignacion::tree_curso_grado($rows['TURNO_CUR']).'
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
        public function tree_curso_grado($turno){
            $grado=main_model::ejecutar_consulta_simple("SELECT TURNO_CUR, GRADO_CUR FROM curso WHERE TURNO_CUR='$turno' GROUP BY GRADO_CUR");

            if($grado->rowCount()>=1){
                $grado=$grado->fetchAll();
                $tabla='<ul>';
                foreach($grado as $rows){
                    $tabla.='<li>
                                <span><i class="fas fa-plus-circle"></i> &nbsp; '.$rows['GRADO_CUR'].'</span>
                                '.controlador_asignacion::tree_curso_seccion($rows['TURNO_CUR'],$rows['GRADO_CUR']).'
                            </li>';    
                }
                $tabla.='</ul>';
            }
            return $tabla;
        }

        /**Controlador crear tree curso seccion */
        public function tree_curso_seccion($turno,$grado){
            $seccion=main_model::ejecutar_consulta_simple("SELECT COD_CUR, SECCION_CUR FROM curso WHERE TURNO_CUR='$turno' AND GRADO_CUR='$grado' GROUP BY SECCION_CUR");

            if($seccion->rowCount()>=1){
                $seccion=$seccion->fetchAll();
                $tabla='<ul>';
                foreach($seccion as $rows){
                    $tabla.='<li>
                                <span><i class="fas fa-cog"></i> &nbsp; '.$rows['SECCION_CUR'].'</span>                        
                                <input type="hidden" value="'.main_model::encryption($rows['COD_CUR']).'">                            
                                <button type="button" class="asigAlum btn btn-raised btn-primary btn-circle btn-sm" data-toggle="popover" data-trigger="hover" data-content="Añadir estudiantes">+ A</button>
                                <button type="button" class="asigDoc btn btn-raised btn-info btn-circle btn-sm" data-toggle="popover" data-trigger="hover" data-content="Añadir docentes">+ D</button>                           
                            </li>';    
                }
                $tabla.='</ul>';
            }
            return $tabla;
        }

        /**-------------------------------- ASIGNACION CURSO ALUMNO -------------------------------------- */
        /**Controlador asignar alumno a curso*/
        public function asignar_curso_controlador($tipo){
            if($tipo=="alumno"){
                $id_curso = main_model::decryption($_POST['asignar_alumno']);
            }elseif($tipo=="docente"){
                $id_curso = main_model::decryption($_POST['asignar_docente']);
            }
            $id_curso = main_model::limpiar_cadena($id_curso);
            $pagina = main_model::limpiar_cadena($_POST['alumno_id']);
            $url = main_model::limpiar_cadena($_POST['url']);
            $anio_academico = main_model::limpiar_cadena($_POST['anio_academico']);

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
                            $tabla.=controlador_asignacion::paginador_alumno_controlador($pagina,15,$_SESSION['privilegio_sa'],$url,$_SESSION['ua_id'],$id_curso,$anio_academico);
                        }elseif($tipo=="docente"){
                            $tabla.=controlador_asignacion::paginador_docente_controlador($pagina,15,$_SESSION['privilegio_sa'],$url,$_SESSION['ua_id'],$id_curso,$anio_academico);
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

        /**Controlador aqgregar alumno */
        public function agregar_alumno_controlador(){
            /**Recuperar id */
            $id_alumno=main_model::limpiar_cadena($_POST['id_agregar_alumno']);
            $id_curso=main_model::decryption($_POST['id_agregar_curso']);
            $id_curso=main_model::limpiar_cadena($id_curso);
            $fecha_ini=main_model::limpiar_cadena($_POST['alumno_fechaIni_as']);
            $fecha_fin=main_model::limpiar_cadena($_POST['alumno_fechaFin_as']);

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
                $datos=$check_alumno->fetch();
            }

            $datos_asignacion=[
                "IdAlumno"=>$id_alumno,
                "IdCurso"=>$id_curso,
                "FechaFin"=>$fecha_fin,
                "FechaIni"=>$fecha_ini
            ];

            $reg_alumno=modelo_asignacion::agregar_alumno_modelo($datos_asignacion);
            if($reg_alumno->rowCount()>=1){
                $campos=[
                    "ID"=>main_model::encryption($datos['ALUMNO_ID']),
                    "CI"=>$datos['CI_A'],
                    "Nombre"=>$datos['NOMBRE_A'],
                    "ApellidoP"=>$datos['APELLIDOP_A'],
                    "ApellidoM"=>$datos['APELLIDOM_A'],
                    "FechaNac"=>$datos['FECHANAC_A'],
                    "Sexo"=>$datos['SEXO_A'],
                    "Telefono"=>$datos['TELEFONO_A'],
                    "IdCurso"=>main_model::encryption($id_curso)
                ];
            }else{
                $campos=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Advertencia",
                    "Texto"=>"El alumno ya se encuentra registrado, por favor seleccione otro",
                    "Tipo"=>"warning"
                ];
            }
            echo json_encode($campos);
        }

        /* controlador eliminar alumno*/
        public function eliminar_alumno_controlador(){
            /* recibiendo id del alumno */
            $id_alumno=main_model::decryption($_POST['id_eliminar_alumno']);
            $id_alumno=main_model::limpiar_cadena($id_alumno);
            $id_curso=main_model::decryption($_POST['id_eliminar_curso']);
            $id_curso=main_model::limpiar_cadena($id_curso);

            /* Comprobar el alumno en BD */
            $check_alumno=main_model::ejecutar_consulta_simple("SELECT ALUMNO_ID FROM alumno WHERE ALUMNO_ID='$id_alumno'");
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

            $eliminar_alumno=modelo_asignacion::eliminar_alumno_modelo($id_alumno,$id_curso);

            if($eliminar_alumno->rowCount()==1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Alumno eliminado",
                    "Texto"=>"EL Alumno ha sido eliminado del curso exitosamente",
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

        /**-------------------------------- ASIGNACION CURSO DOCENTE- ------------------------------------- */
        /* controlador paginar docente*/
        public function paginador_docente_controlador($pagina,$registros,$privilegio,$url,$ue,$id_curso,$anio_academico){
            $pagina=main_model::limpiar_cadena($pagina);
            $registros=main_model::limpiar_cadena($registros);
            $privilegio=main_model::limpiar_cadena($privilegio);
            $url=main_model::limpiar_cadena($url);
            $url=SERVERURL.$url."/";
            $ue=main_model::limpiar_cadena($ue);

            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            $consulta="SELECT SQL_CALC_FOUND_ROWS P.* FROM cur_prof AS CP, profesor AS P WHERE 
            P.UA_ID='$ue' AND CP.PROFESOR_ID=P.PROFESOR_ID AND CP.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CP)='$anio_academico'
            GROUP BY P.PROFESOR_ID ASC LIMIT $inicio,$registros";
            
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
                        <td>'.$rows['CI_P'].'</td>
                        <td>'.$rows['NOMBRE_P'].'</td>
                        <td>'.$rows['APELLIDOP_P'].' '.$rows['APELLIDOM_P'].'</td>
                        <td>'.$rows['SEXO_P'].'</td>
                        <td>'.$rows['FECHANAC_P'].'</td>
                        <td>'.$rows['TELEFONO_P'].'</td>';
                        if($privilegio==1){
                            $id_docente="'".main_model::encryption($rows['PROFESOR_ID'])."'";
                            $tabla.='<td>
                                        <button type="button" class="btn btn-warning" onclick="eliminar_docente_curso('.$id_docente.')">
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
                $tabla.='<p class="text-right">Mostrando doncente '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla.='</div>';
        }

        /**Controlador buscar docente */
        public function buscar_docente_controlador(){
            /**Recuperar texto */
            $docente=main_model::limpiar_cadena($_POST['buscar_docente']);

            /**comprobar texto */
            if($docente==""){
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
            /**Seleccionando docente en la BD */
            $datos_docente=main_model::ejecutar_consulta_simple("SELECT P.*, A.NOMBRE_AREA FROM profesor AS P, area AS A WHERE 
            (P.CI_P LIKE '%$docente%' OR P.NOMBRE_P LIKE '%$docente%' OR P.APELLIDOP_P LIKE '%$docente%' 
            OR P.APELLIDOM_P LIKE '%$docente%' OR A.NOMBRE_AREA LIKE '%$docente%') AND P.UA_ID=$ua AND P.COD_AREA=A.COD_AREA ORDER BY P.NOMBRE_P ASC");

            if($datos_docente->rowCount()>=1){
                $datos_docente=$datos_docente->fetchAll();

                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_docente as $rows){
                    $tabla.='<tr class="">
                                <td>'.$rows['CI_P'].'</td>
                                <td>'.$rows['NOMBRE_P'].' '.$rows['APELLIDOP_P'].' '.$rows['APELLIDOM_P'].'</td>
                                <td>'.$rows['NOMBRE_AREA'].'</td>
                                <td class="text-center"><button type="button" class="btn btn-primary" onclick="agregar_docente('.$rows['PROFESOR_ID'].')"><i class="fas fa-plus fa-fw"></i></button>
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

        /**Controlador aqgregar docente */
        public function agregar_docente_controlador(){
            /**Recuperar id */
            $id_docente=main_model::limpiar_cadena($_POST['id_agregar_docente']);
            $id_curso=main_model::decryption($_POST['id_agregar_curso']);
            $id_curso=main_model::limpiar_cadena($id_curso);
            $fecha_ini=main_model::limpiar_cadena($_POST['docente_fechaIni_as']);
            $fecha_fin=main_model::limpiar_cadena($_POST['docente_fechaFin_as']);
            $responsable=main_model::limpiar_cadena($_POST['docente_responsable_as']);

            /** Comprobando el docente en la BD */
            $check_docente=main_model::ejecutar_consulta_simple("SELECT * FROM profesor WHERE PROFESOR_ID='$id_docente'");
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
                $datos=$check_docente->fetch();
            }
      
            $datos_asignacion=[
                "IdDocente"=>$id_docente,
                "IdCurso"=>$id_curso,
                "FechaFin"=>$fecha_fin,
                "FechaIni"=>$fecha_ini,
                "Responsable"=>$responsable
            ];

            $reg_docente=modelo_asignacion::agregar_docente_modelo($datos_asignacion);
            if($reg_docente->rowCount()>=1){
                $campos=[
                    "CI"=>$datos['CI_P']
                ];
            }else{
                $campos=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Advertencia",
                    "Texto"=>"El docente ya se encuentra registrado, por favor seleccione otro",
                    "Tipo"=>"warning"
                ];
            }
            echo json_encode($campos);
        }

        /* controlador eliminar docente*/
        public function eliminar_docente_controlador(){
            /* recibiendo id del docente */
            $id_docente=main_model::decryption($_POST['id_eliminar_docente']);
            $id_docente=main_model::limpiar_cadena($id_docente);
            $id_curso=main_model::decryption($_POST['id_eliminar_curso']);
            $id_curso=main_model::limpiar_cadena($id_curso);

            /* Comprobar el docente en BD */
            $check_docente=main_model::ejecutar_consulta_simple("SELECT PROFESOR_ID FROM profesor WHERE PROFESOR_ID='$id_docente'");
            if($check_docente->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El Docente que intenta eliminar no existe en el sistema",
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

            $eliminar_docente=modelo_asignacion::eliminar_docente_modelo($id_docente,$id_curso);

            if($eliminar_docente->rowCount()==1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Docente eliminado",
                    "Texto"=>"EL Docente ha sido eliminado del curso exitosamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el Docente, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }
    }