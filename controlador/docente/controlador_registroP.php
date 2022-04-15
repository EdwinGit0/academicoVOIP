<?php
    if($peticionAjax){
        require_once "../../modelo/docente/modelo_cuadernoP.php";
        include_once "../../vista/contenido/docente/inc/conversor.php";
    }else{
        require_once "./modelo/docente/modelo_cuadernoP.php";
        include_once "./vista/contenido/docente/inc/conversor.php";
    }
    
    class controlador_registroP extends modelo_cuadernoP{

        /**--------------------------------TREE CURSO-------------------------------------- */
        /**Controlador crear tree curso */
        public function tree_curso_controlador($id_docente){
            $id_docente=main_model::limpiar_cadena($id_docente);

            $anio=$_SESSION['anio_academico'];
            $turno=main_model::ejecutar_consulta_simple("SELECT C.TURNO_CUR FROM curso AS C, cur_prof AS CP, 
            profesor AS P WHERE C.COD_CUR=CP.COD_CUR AND CP.PROFESOR_ID=P.PROFESOR_ID 
            AND P.PROFESOR_ID='$id_docente' AND YEAR(FECHA_INI_CP)='$anio' AND RESPONSABLE_CP=1 GROUP BY C.TURNO_CUR");

            if($turno->rowCount()>=1){
                $turno=$turno->fetchAll();
                $tabla='<div class="card-header text-white bg-dark">
                            <div class="col-12 col-md-12">
                                <div class="input-group">
                                    <div class="mr-auto"><h6>Cursos</h6></div>
                                    <div class="input-group-addon"></div>
                                    <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div> 
                        </div>
                        <div class="card-body"><ul>';
                foreach($turno as $rows){
         
                    $tabla.='<li class="primer-ul">
                                <span><i class="fas fa-plus-circle"></i> &nbsp; '.$rows['TURNO_CUR'].'</span>
                                '.controlador_registroP::tree_curso_grado($rows['TURNO_CUR'],$id_docente,$anio).'
                            </li>';    
                }
                $tabla.='</ul></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                            <p class="text-center mb-0">
                                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                                No tiene cursos asignados para esta gestión
                            </p>
                        </div>';
                exit();
            }
        }

        /**Controlador crear tree curso grado */
        public function tree_curso_grado($turno,$id_docente,$anio){
            $grado=main_model::ejecutar_consulta_simple("SELECT C.TURNO_CUR, C.GRADO_CUR FROM curso AS C, cur_prof AS CP, 
            profesor AS P WHERE C.COD_CUR=CP.COD_CUR AND CP.PROFESOR_ID=P.PROFESOR_ID 
            AND P.PROFESOR_ID='$id_docente' AND C.TURNO_CUR='$turno' AND YEAR(FECHA_INI_CP)='$anio' AND RESPONSABLE_CP=1 GROUP BY C.GRADO_CUR");

            if($grado->rowCount()>=1){
                $grado=$grado->fetchAll();
                $tabla='<ul>';
                foreach($grado as $rows){
                    $tabla.='<li>
                                <span><i class="fas fa-plus-circle"></i> &nbsp; '.$rows['GRADO_CUR'].'</span>
                                '.controlador_registroP::tree_curso_seccion($rows['TURNO_CUR'],$rows['GRADO_CUR'],$id_docente,$anio).'
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
            P.PROFESOR_ID='$id_docente' AND C.TURNO_CUR='$turno' AND C.GRADO_CUR='$grado' AND YEAR(FECHA_INI_CP)='$anio' AND RESPONSABLE_CP=1 GROUP BY C.SECCION_CUR");

            if($seccion->rowCount()>=1){
                $seccion=$seccion->fetchAll();
                $tabla='<ul>';
                foreach($seccion as $rows){
                    $tabla.='<li>
                                <span><i class="fas fa-cog"></i> &nbsp; '.$rows['SECCION_CUR'].'</span>                        
                                <input type="hidden" value="'.main_model::encryption($rows['COD_CUR']).'">                            
                                <button type="button" class="registerPedago btn btn-raised btn-primary btn-circle btn-sm" data-toggle="popover" data-trigger="hover" data-content="Cuaderno pedagógico"><i class="fas fa-book"></i></button>
                            </li>';    
                }
                $tabla.='</ul>';
            }
            return $tabla;
        }

        /**-------------------------------- ASIGNACION CURSO ALUMNO -------------------------------------- */
        /**Controlador datos referenciales*/
        public function referencial_curso_controlador(){
            $id_curso = main_model::decryption($_POST['curso_id_referencial']);
            $id_curso = main_model::limpiar_cadena($id_curso);

            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);

            $id_ua=$_SESSION['ua_id'];
            $id_area=$_SESSION['id_area'];
            $check_referencial=main_model::ejecutar_consulta_simple("SELECT C.GRADO_CUR, C.SECCION_CUR, UA.DISTRITO_UA, UA.NOMBRE_UA, A.NOMBRE_AREA
            FROM curso AS C, unidad_academico AS UA, area AS A WHERE C.COD_CUR='$id_curso' AND UA.UA_ID='$id_ua' AND A.COD_AREA='$id_area'");
            if($check_referencial->rowCount()>=1){

                $campos=$check_referencial->fetch();
                $tabla = '<table class="table table-striped table-sm">
                            <tr>
                                <th>DISTRITO EDUCATIVO</th>
                                <td>'.$campos['DISTRITO_UA'].'</td>
                                <th>AÑO DE ESCOLARIDAD</th>
                                <td>'.$campos['GRADO_CUR'].' '.$campos['SECCION_CUR'].'</td>  
                            </tr>
                            <tr>
                                <th>UNIDAD EDUCATIVA</th>
                                <td>'.$campos['NOMBRE_UA'].'</td>    
                                <th>DIRECTORA/OR</th>';
                                $check_director=main_model::ejecutar_consulta_simple("SELECT NOMBRE_AD, APELLIDOP_AD, APELLIDOM_AD FROM admin WHERE UA_ID='$id_ua' AND TIPO='Director'");
                                if($check_director->rowCount()>=1){
                                    $campos_dir=$check_director->fetch();
                                    $tabla.='<td>'.$campos_dir['NOMBRE_AD'].' '.$campos_dir['APELLIDOP_AD'].' '.$campos_dir['APELLIDOM_AD'].'</td>'; 
                                }else{
                                    $tabla.='<td></td>';
                                }    
                            $tabla.='</tr>
                            <tr>
                                <th>MAESTRA/O</th>
                                <td>'.$_SESSION['nombre_sa'].' '.$_SESSION['apellidoP_sa'].' '.$_SESSION['apellidoM_sa'].'</td>
                                <th>GESTIÓN</th>
                                <td>'.$_SESSION['anio_academico'].'</td>        
                            </tr>
                            <tr>
                                <th>NIVEL</th>
                                <td>Secundaria Comunitaria Productiva</td> 
                                <th>FECHA</th>
                                <td>'.date("Y-m-d").'</td>        
                            </tr>
                        </table>';

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

        /* controlador datos del periodo centralizado*/
        public function tabla_periodo_controlador(){
            $id_curso = main_model::decryption($_POST['curso_id_periodo']);
            $id_curso = main_model::limpiar_cadena($id_curso);
            $periodo_id = main_model::limpiar_cadena($_POST['periodo_id']);

            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);

            $pagina = main_model::limpiar_cadena($_POST['docente_id']);
            $url = main_model::limpiar_cadena($_POST['url']);
            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);
            $url=SERVERURL.$url."/";

            $tabla="";

            $registros=15;
            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            $consulta="SELECT SQL_CALC_FOUND_ROWS A.* FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ORDER BY A.ALUMNO_ID ASC LIMIT $inicio,$registros";
            
            $conexion = main_model::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();
            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();
            $Npaginas=ceil($total/$registros);

            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch(); unset($val_anio);
            $id_anio_a=$id_anio['COD_ANIO'];
        
            $val_area=main_model::ejecutar_consulta_simple("SELECT COD_AREA, NOMBRE_AREA FROM area ORDER BY NOMBRE_AREA ASC");
            $num_area = $val_area->rowCount(); 
            $dato_area = $val_area->fetchAll(); unset($val_area);

            $cal_promedio=main_model::ejecutar_consulta_simple("SELECT C.ALUMNO_ID, C.NOTA, P.COD_AREA FROM valoracion AS V, calificacion AS C, profesor AS P
            WHERE  V.CRITERIO_VAL='Promedio' AND C.VAL_ID=V.VAL_ID AND P.PROFESOR_ID=C.PROFESOR_ID AND C.COD_PER='$periodo_id'
            AND C.COD_CUR='$id_curso' AND C.COD_ANIO='$id_anio_a'");
            $dato_prom_cal = $cal_promedio->fetchAll(); unset($cal_promedio);
            

            $num_aprobados = controlador_registroP::aprobado("ArrayBD",$dato_prom_cal);
            $num_reprobados = $total-$num_aprobados;
            $tabla.='<div class="table-responsive">
            <table class="table table-bordered table-secondary table-sm" id="table_cp">
                <thead>
                    <tr class="text-center roboto-medium">
                        <th colspan="2"><span class="text-dark">Alumnos aprobados y reprobados</span><canvas class="grafico-pastel" id="myChart'.$periodo_id.'" ></canvas></th>
                        <th class="tabla-parcial" colspan="'.$num_area.'">CAMPOS DE SABERES Y CONOCIMIENTOS</th>
                        <th class="tabla-parcial" rowspan="2"><div class="verticalText">PROMEDIO TRIMESTRAL</div></th>
                        <th class="tabla-parcial" rowspan="2"><div class="verticalText">SITUACIÓN TRIMESTRAL</div></th>
                    </tr>
                    <tr class="text-center roboto-medium tabla-evaluacion">
                        <th>#</th>
                        <th>APELLIDOS Y NOMBRES</th>';
                
                        foreach($dato_area as $rows){
                            $tabla.='<th height="150" style="font-size: 10px;"><div class="verticalText">'.$rows['NOMBRE_AREA'].'</div></th>';
                        }
                    $tabla.='</tr>
                </thead>
                <tbody>';

            $nota_promedio = array();
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='<tr>
                    <td>'.$contador.'</td>
                    <td>'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].' '.$rows['NOMBRE_A'].'</td>';

                    $suma_par=0;$promedio_par=0;

                    if($num_area>0){
                        foreach($dato_area as $campos_a){
                            $nota_alumno=0;
                            foreach($dato_prom_cal as $campos_n){
                                if($rows['ALUMNO_ID']==$campos_n['ALUMNO_ID'] && $campos_a['COD_AREA']==$campos_n['COD_AREA']){
                                    $nota_alumno=$campos_n['NOTA'];
                                    $suma_par=$suma_par+intval($campos_n['NOTA']);   
                                }  
                            }
                            $tabla.='<td class="campo_par">'.$nota_alumno.'</td>'; 
                        }
    
                        $promedio_par=$suma_par/$num_area;
                    }else{
                        $tabla.='<td class="campo_par"></td>';
                    }

                    if($promedio_par<51){
                        $tabla.='<td class="valor-promedio" style="color: red;">'.number_format($promedio_par).'</td>';
                        $tabla.='<td class="prom_estado" style="color: red;">REPROBADO</td>';
                    }else{
                        $tabla.='<td class="valor-promedio">'.number_format($promedio_par).'</td>';
                        $tabla.='<td class="prom_estado">APROBADO</td>';
                    }
                    $nota_promedio[] = number_format($promedio_par);

                    $tabla.='</tr>';
                    $contador++;
                }
                $reg_final=$contador-1;
            }else{
                $cont_columna=$num_area+4;
                if($total>=1){
                    $tabla.='<tr class="text-center"><td colspan="'.$cont_columna.'">
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="'.$cont_columna.'">No hay registros en el sistema</td></tr>';
                }
            }
            $tabla.='</tbody></table></div>';

            $num_aprobados = controlador_registroP::aprobado("Array",$nota_promedio);
            $num_reprobados = $total-$num_aprobados;
            $tabla.='<input type="hidden" id="aprob_trim'.$periodo_id.'" value="'.$num_aprobados.'">
                    <input type="hidden" id="reprob_trim'.$periodo_id.'" value="'.$num_reprobados.'">';
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando alumno '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }
            return $tabla;
        }

        /* cantralizador final registroP*/
        public function resumen_cuadroP_controlador(){
            $id_curso = main_model::decryption($_POST['curso_id_resumen']);
            $id_curso = main_model::limpiar_cadena($id_curso);
            $pagina = main_model::limpiar_cadena($_POST['docente_id']);
            $url = main_model::limpiar_cadena($_POST['url']);
            $registros=15;
            
            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch(); unset($val_anio);
            $id_anio_a=$id_anio['COD_ANIO'];
            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);
            $url=SERVERURL.$url."/";

            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            $consulta="SELECT SQL_CALC_FOUND_ROWS A.* FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR=' $id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ORDER BY A.ALUMNO_ID ASC LIMIT $inicio,$registros";

            $conexion = main_model::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();
            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();
            $Npaginas=ceil($total/$registros);

            $val_area=main_model::ejecutar_consulta_simple("SELECT * FROM area");
            $val_periodo=main_model::ejecutar_consulta_simple("SELECT * FROM periodo");
            $cal_promedio=main_model::ejecutar_consulta_simple("SELECT C.NOTA, C.ALUMNO_ID, C.COD_PER, P.COD_AREA FROM valoracion AS V, calificacion AS C, profesor AS P
            WHERE  CRITERIO_VAL='Promedio' AND C.VAL_ID=V.VAL_ID AND P.PROFESOR_ID=C.PROFESOR_ID AND C.COD_CUR='$id_curso' AND C.COD_ANIO='$id_anio_a'");
            $dato_area = $val_area->fetchAll();
            $dato_periodo = $val_periodo->fetchAll();
            $dato_prom_cal = $cal_promedio->fetchAll();
          
            $tabla.='<div class="row">
                    <div class="col">
                    <div class="table-responsive">
                    <table class="table table-bordered table-secondary table-sm" id="tabla_asignar_curso">
                        <thead>
                            <tr class="text-center roboto-medium tabla-evaluacion">
                                <th rowspan="2">#</th>
                                <th rowspan="2">APELLIDOS Y NOMBRES</th>
                                <th colspan="'.$val_periodo->rowCount().'">BOLETIN ANUAL</th>
                                <th rowspan="2" class="tabla-promedio" style="font-size: 10px;"><div class="verticalText">PROMEDIO FINAL ANUAL</div></th>
                            </tr>
                            <tr class="text-center roboto-medium tabla-evaluacion">';
                                if($val_periodo->rowCount()>=1){
                                    foreach($dato_periodo as $rows){
                                        $tabla.='<th style="font-size: 10px;"><div class="verticalText">'.$rows['NOMBRE_PER'].'</div></th>';
                                    }
                                }else{
                                    $tabla.='<th>No hay periodos registrados</th>';
                                }
                        $tabla.='</tr>
                        </thead>
                        <tbody>';
            $nota_promedio = array();
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                
                foreach($datos as $rows){
                    $fecha_nacimiento = new DateTime($rows['FECHANAC_A']);
                    $hoy = new DateTime();
                    $edad = $hoy->diff($fecha_nacimiento);

                    $tabla.='<tr>
                        <td>'.$contador.'</td>
                        <td>'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].' '.$rows['NOMBRE_A'].'</td>';
                        $suma_periodo=0;$promedio_anual=0;

                        if($val_periodo->rowCount()>1){
                            foreach($dato_periodo as $campos_p){
                                $nota_alumno=0;
                                foreach($dato_prom_cal as $campos_n){
                                    if($rows['ALUMNO_ID']==$campos_n['ALUMNO_ID'] && $campos_p['COD_PER']==$campos_n['COD_PER']){
                                        $nota_alumno= $nota_alumno+controlador_registroP::comparar_nota($dato_area,$campos_n);
                                    }
                                }
                                $tabla.='<td>'.number_format($nota_alumno/$val_area->rowCount()).'</td>';
                                $suma_periodo=$suma_periodo+($nota_alumno/$val_area->rowCount());
                            }

                            $promedio_anual=($suma_periodo/$val_periodo->rowCount());
                            $nota_promedio[] = number_format($promedio_anual);
                        }else{
                            $tabla.='<td></td>';
                        }

                        if(number_format($promedio_anual)<51){
                            $tabla.='<td class="valor-promedio" style="color: red;">'.number_format($promedio_anual).'</td>';
                        }else{
                            $tabla.='<td class="valor-promedio">'.number_format($promedio_anual).'</td>';
                        }
                    $tabla.='</tr>';
                    $contador++;
                }
                $reg_final=$contador-1;
                
            }else{
                $cont_columna=$val_periodo->rowCount()+4;
                if($total>=1){
                    $tabla.='<tr class="text-center"><td colspan="11">
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="11">No hay registros en el sistema</td></tr>';
                }
            }
            $tabla.='</tbody></table></div></div>';
   
            
            $num_aprobados = controlador_registroP::aprobado("Array",$nota_promedio);
            $num_reprobados = $total-$num_aprobados;
            $tabla.='<div class="col">
                        <input type="hidden" id="aprob_anual" value="'.$num_aprobados.'">
                        <input type="hidden" id="reprob_anual" value="'.$num_reprobados.'">
                        <canvas id="grafico-anual" class="grafico-pastel-anual""></canvas>
                    </div>
                </div>';


            $tabla.='<br><div class="input-group">
            <p class="mr-auto">
                <a type="button" href="'.SERVERURL.'reporte/reporte_rp.php?id='.main_model::encryption($id_curso).'" class=" btn btn-raised btn-warning">
                    <i class="fas fa-file-excel"></i> &nbsp; EXPORTAR A PDF
                </a>
            </p>';

            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando alumno '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p></div>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }
            return $tabla;
        }

        /* Libreta electronico cregistroP*/
        public function libreta_registroP_controlador($id_alumno,$id_curso){
            $id_alumno = main_model::decryption($id_alumno);
            $id_alumno = main_model::limpiar_cadena($id_alumno);
            $id_curso = main_model::limpiar_cadena($id_curso);
            
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch(); unset($val_anio);
            $id_anio_a=$id_anio['COD_ANIO'];
            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

            $tabla="";

            $val_alumno=main_model::ejecutar_consulta_simple("SELECT A.RUDE_A, A.NOMBRE_A, A.APELLIDOP_A, A.APELLIDOM_A FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND A.ALUMNO_ID='$id_alumno' AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico'");

            if($val_alumno->rowCount()==1){

                $dato_alumno = $val_alumno->fetch(); unset($val_alumno);

                $val_referencial=main_model::ejecutar_consulta_simple("SELECT C.TURNO_CUR, C.GRADO_CUR, C.SECCION_CUR, UA.*
                FROM curso AS C, unidad_academico AS UA WHERE C.COD_CUR='$id_curso' AND UA.UA_ID='$ue'");
                $dato_referencial = $val_referencial->fetch(); unset($val_referencial);

                $cal_promedio=main_model::ejecutar_consulta_simple("SELECT C.ALUMNO_ID, C.NOTA, P.COD_AREA, C.COD_PER FROM valoracion AS V, calificacion AS C, profesor AS P
                WHERE  V.CRITERIO_VAL='Promedio' AND C.VAL_ID=V.VAL_ID AND P.PROFESOR_ID=C.PROFESOR_ID AND C.ALUMNO_ID='$id_alumno' AND C.COD_CUR='$id_curso' AND C.COD_ANIO='$id_anio_a'");
                $dato_prom_cal = $cal_promedio->fetchAll(); unset($cal_promedio);

                $val_area=main_model::ejecutar_consulta_simple("SELECT * FROM area ORDER BY CAMPO_AREA ASC");
                $dato_area = $val_area->fetchAll();

                $val_periodo=main_model::ejecutar_consulta_simple("SELECT * FROM periodo");
                $dato_periodo = $val_periodo->fetchAll();
            
                $tabla.='<div id="tableLibreta" class="desgPDFDoc libreta table-responsive">
                            <table class="table table-sm"> 
                                <tr class="titulo-libreta text-center">
                                    <th colspan="6"><bold>Libreta Escolar Electronica</bold></th>
                                </tr> 
                                <tr class="text-center">
                                    <th colspan="6">Educación  Secundaria  Comunitaria Productiva</th>
                                </tr> 
                                <tr>
                                    <td class="text-center" width="20%" rowspan="3"><img src="'.SERVERURL.'vista/assets/img/escudo.png" class="img-fluid" alt="Avatar"></td>
                                    <th>Unidad Educativa:</th>
                                    <td>'.$dato_referencial['COD_UA'].' - '.$dato_referencial['NOMBRE_UA'].'</td>
                                    <th>Departamento:</th>
                                    <td>'.$dato_referencial['DPTO_UA'].'</td> 
                                    <td class="text-center" width="20%" rowspan="3"><img src="'.SERVERURL.'vista/assets/img/tabla-libreta.png" class="img-fluid" alt="Avatar"></td> 
                                </tr>
                                <tr>
                                    <th>Distrito Educativo:</th>
                                    <td>'.$dato_referencial['DISTRITO_UA'].'</td>
                                    <th>Dependencia:</th>
                                    <td>'.$dato_referencial['DEPENDENCIA_UA'].'</td> 
                                </tr>
                                <tr>
                                    <th>Turno:</th>
                                    <td>'.$dato_referencial['TURNO_CUR'].'</td>
                                    <th>Gestión:</th>
                                    <td>'.$anio_academico.'</td>  
                                </tr>
                        
                            </table>

                            <table id="" class="table table-libreta table-sm">       
                                <tr class="text-center">
                                    <th>Apellidos y Nombres</th>
                                    <td colspan="2">'.$dato_alumno['APELLIDOP_A'].' '.$dato_alumno['APELLIDOM_A'].' '.$dato_alumno['NOMBRE_A'].'</td>
                                    <th>Año Escolaridad</th>
                                    <td>'.$dato_referencial['GRADO_CUR'].' '.$dato_referencial['SECCION_CUR'].'</td>
                                    <th>Código Rude</th>
                                    <td>'.$dato_alumno['RUDE_A'].'</td>
                                </tr>
                                <tr class="text-center">';
                                    $num_periodo=$val_periodo->rowCount()+4;
                                    $tabla.='<th colspan="'.$num_periodo.'">Evaluación (Ser, Saber, Hacer, Decidir)</th>   
                                </tr>
                                <tr class="text-center">
                                    <th rowspan="2">Campo de Saberes y Conocimiento</th>
                                    <th rowspan="2">Áreas Curriculares</th>';
                                    $num_periodo=$val_periodo->rowCount()+2;
                                    $tabla.='<th colspan="'.$num_periodo.'">Valoración Cuantitativa</th>
                                </tr>
                                <tr class="text-center">';
                                    if($val_periodo->rowCount()>=1){
                                        foreach($dato_periodo as $rows){
                                            $tabla.='<th style="font-size: 10px;">'.$rows['NOMBRE_PER'].'</th>';
                                        }
                                    }
                                    $tabla.='<th colspan="2">Promedio anualL</th>
                                </tr>';

                if($val_area->rowCount()>=1){
                    $obtener_campo=controlador_registroP::obtener_campo_area($dato_area,"Ciencia, Tecnología y Producción");
                    $tabla.='<tr>
                    <th rowspan="'.$obtener_campo.'">Ciencia, Tecnología y Producción</th>';
                    $cont_campo=0;
                    foreach($dato_area as $campo_a){
                        if($campo_a['CAMPO_AREA']=="Ciencia, Tecnología y Producción" && $cont_campo<$obtener_campo){
                            $tabla.=controlador_registroP::clasificar_notas_campoArea($val_periodo,$dato_periodo,$campo_a,$dato_prom_cal);
                            $cont_campo++;
                        }
                    } 
                    
                    $obtener_campo=controlador_registroP::obtener_campo_area($dato_area,"Comunidad y Sociedad");
                    $tabla.='<tr>
                    <th rowspan="'.$obtener_campo.'">Comunidad y Sociedad</th>';
                    $cont_campo=0;
                    foreach($dato_area as $campo_a){
                        if($campo_a['CAMPO_AREA']=="Comunidad y Sociedad" && $cont_campo<$obtener_campo){
                            $tabla.=controlador_registroP::clasificar_notas_campoArea($val_periodo,$dato_periodo,$campo_a,$dato_prom_cal);
                            $cont_campo++;
                        }
                    }   

                    $obtener_campo=controlador_registroP::obtener_campo_area($dato_area,"Cosmos y Pensamiento");
                    $tabla.='<tr>
                    <th rowspan="'.$obtener_campo.'">Cosmos y Pensamiento</th>';
                    $cont_campo=0;
                    foreach($dato_area as $campo_a){
                        if($campo_a['CAMPO_AREA']=="Cosmos y Pensamiento" && $cont_campo<$obtener_campo){
                            $tabla.=controlador_registroP::clasificar_notas_campoArea($val_periodo,$dato_periodo,$campo_a,$dato_prom_cal);
                            $cont_campo++;
                        }
                    }   

                    $obtener_campo=controlador_registroP::obtener_campo_area($dato_area,"Vida Tierra Territorio");
                    $tabla.='<tr>
                    <th rowspan="'.$obtener_campo.'">Vida Tierra Territorio</th>';
                    $cont_campo=0;
                    foreach($dato_area as $campo_a){
                        if($campo_a['CAMPO_AREA']=="Vida Tierra Territorio" && $cont_campo<$obtener_campo){
                            $tabla.=controlador_registroP::clasificar_notas_campoArea($val_periodo,$dato_periodo,$campo_a,$dato_prom_cal);
                            $cont_campo++;
                        }
                    }   
                }

                $tabla.='</table></div>';
                $tabla.='<br><div class="input-group">
                                <p class="mr-auto">
                                    <button type="button" class="btnCrearLibretaPdf btn btn-raised btn-warning"><i class="fas fa-file-pdf"></i> &nbsp; EXPORTAR A PDF</button>
                                    <button type="button" class="btnCrearLibretaExcel btn btn-raised btn-success"><i class="fas fa-file-excel"></i> &nbsp; EXPORTAR A XLS</button>
                                </p>
                            </div>';

            }else{
                $tabla.='<div class="alert alert-danger text-center" role="alert">
                            <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                            <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
                            <p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
                        </div>';
            }

            return $tabla;
        }

        /* funcion  obnter cantidad campos*/
        public function obtener_campo_area($datos_area,$campo){
            $result=0;
            foreach($datos_area as $rows){
                if($rows['CAMPO_AREA']==$campo){
                    $result++;
                }
            }
            return $result;
        }

        /* funcion  obtener nota segun  campos y areas*/
        public function clasificar_notas_campoArea($val_periodo,$dato_periodo,$campo_a,$dato_prom_cal){
            $tabla='';
            $tabla.='<td>'.$campo_a['NOMBRE_AREA'].'</td>';
                $suma_par=0;$promedio_par=0;
                if($val_periodo->rowCount()>0){
                    foreach($dato_periodo as $campos_p){
                        $nota_alumno=0;
                        foreach($dato_prom_cal as $campos_n){
                            if($campo_a['COD_AREA']==$campos_n['COD_AREA'] && $campos_p['COD_PER']==$campos_n['COD_PER']){
                                $nota_alumno=$campos_n['NOTA'];
                                $suma_par=$suma_par+intval($campos_n['NOTA']);   
                            }  
                        }
                        $tabla.='<td class="text-center">'.$nota_alumno.'</td>'; 
                    }
                }else{
                    $tabla.='<td class="text-center"></td>';
                }
                $promedio_par=$suma_par/$val_periodo->rowCount();
                $tabla.='<td class="text-center">'.number_format($promedio_par).'</td>';
                $nota_letras=convertir(number_format($promedio_par));
                $tabla.='<td class="text-center">'.$nota_letras.'</td>';
            $tabla.='</tr>';

            return $tabla;
        }

        /* funcion  comparar nota*/
        public function comparar_nota($compare,$nota){
            $result=0;
            foreach($compare as $rows){
                if($rows['COD_AREA']==$nota['COD_AREA']){
                    $result=intval($nota['NOTA']);
                }
            }
            return $result;
        }

        /** funcion para contar aprobado/reprobado */
        public function aprobado($tipo,$dato_prom_cal){
            $result=0;
            if($tipo=="ArrayBD"){
                foreach($dato_prom_cal as $rows){
                    if($rows['NOTA']>50){
                        $result++;
                    }
                }
            }elseif($tipo=="Array"){
                for ($i=0; $i<count($dato_prom_cal); $i++){
                    if($dato_prom_cal[$i]>50){
                        $result++;
                    }
                }
            }
            return $result;
        }

        /* funcion promedio trimestral*/
        public function promedio_trimestral($compare,$nota){
            foreach($dato_area as $campos_a){
                $nota_alumno=0;
                foreach($dato_prom_cal as $campos_n){
                    if($rows['ALUMNO_ID']==$campos_n['ALUMNO_ID'] && $campos_a['COD_AREA']==$campos_n['COD_AREA']){
                        $nota_alumno=$campos_n['NOTA'];
                        $suma_par=$suma_par+intval($campos_n['NOTA']);   
                    }  
                }
                $tabla.='<td class="campo_par">'.$nota_alumno.'</td>'; 
            }
        }

        /* cursos asignados a docentes*/
        public function cursos_asignadosRP_controlador(){
            session_start(['name'=>'SA']);
            $anio=main_model::limpiar_cadena($_SESSION['anio_academico']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

            $turno=main_model::ejecutar_consulta_simple("SELECT C.TURNO_CUR FROM curso AS C, cur_prof AS CP, 
            profesor AS P WHERE C.COD_CUR=CP.COD_CUR AND CP.PROFESOR_ID=P.PROFESOR_ID 
            AND P.PROFESOR_ID='$id_docente' AND YEAR(FECHA_INI_CP)='$anio' AND RESPONSABLE_CP=1");

            $total_cuadernoP = $turno->rowCount(); unset($turno);
            return $total_cuadernoP;
        }
  
    }