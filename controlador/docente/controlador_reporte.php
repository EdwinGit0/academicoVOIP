<?php
    require_once "../modelo/docente/modelo_reporte.php";
    include_once "../vista/contenido/docente/inc/conversor.php";

    
    class controlador_reporte extends modelo_reporte{

        /**-------------------------------- ASIGNACION CURSO ALUMNO -------------------------------------- */
        /* controlador paginar alumno*/
        public function paginador_alumno_controlador($id_curso){
            $id_curso = main_model::decryption($id_curso);
            $id_curso = main_model::limpiar_cadena($id_curso);

            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);

            $tabla="";

            $val_alumno=main_model::ejecutar_consulta_simple("SELECT SQL_CALC_FOUND_ROWS A.* FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ASC");

            $val_tutor=main_model::ejecutar_consulta_simple("SELECT F.FAMILAR_ID, F.NOMBRE_FA, F.APELLIDOP_FA, F.APELLIDOM_FA, A.ALUMNO_ID, F.ROL_FA FROM cur_alum AS CA, familiar AS F, fa_alumno AS FA, alumno AS A WHERE  
            CA.ALUMNO_ID=A.ALUMNO_ID AND A.UA_ID='$ue' AND A.ALUMNO_ID=FA.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND F.FAMILAR_ID=FA.FAMILAR_ID");

            $dato_tutor=$val_tutor->fetchAll();
            $datos = $val_alumno->fetchAll();

            $tabla.='
                    <table class="table table-bordered table-sm size-text11" style="table-layout: fixed">
                        <thead>
                            <tr class="text-center">
                                <th style="width:2%;" class="tabla-parcial" rowspan="2">#</th>
                                <th style="width:9%;" class="tabla-parcial" rowspan="2">RUDE</th>
                                <th style="width:20%;" class="tabla-parcial" rowspan="2">APELLIDOS Y NOMBRES</th>
                                <th class="tabla-parcial" style="width:8%;" rowspan="2">CI</th>
                                <th style="width:3%;" class="tabla-parcial" rowspan="2"><div class="verticalText2">GÉNERO</div></th>
                                <th class="tabla-parcial" style="width:20%;" colspan="2">NACIMIENTO</th>
                                <th style="width:3%;" class="tabla-parcial" rowspan="2"><div class="verticalText2">EDAD</div></th>
                                <th style="width:18%;" class="tabla-parcial">PADRE O TUTOR</th>
                                <th style="width:18%;" class="tabla-parcial">MADRE O TUTORA</th>';
                            $tabla.='</tr>
                            <tr class="text-center">
                                <th class="tabla-parcial">LUGAR</th>
                                <th class="tabla-parcial">FECHA</th>
                                <th class="tabla-parcial">APELLIDOS Y NOMBRES</th>
                                <th class="tabla-parcial">APELLIDOS Y NOMBRES</th>
                            </tr>
                        </thead>
                        <tbody class="table-libreta">';

                $contador=1;
                foreach($datos as $rows){
                    $fecha_nacimiento = new DateTime($rows['FECHANAC_A']);
                    $hoy = new DateTime();
                    $edad = $hoy->diff( $fecha_nacimiento);

                    $tabla.='<tr>
                        <td>'.$contador.'</td>
                        <td>'.$rows['RUDE_A'].'</td>
                        <td>'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].' '.$rows['NOMBRE_A'].'</td>
                        <td>'.$rows['CI_A'].'</td>';
                        if($rows['SEXO_A']=="Femenino"){
                            $tabla.='<td class="text-center">F</td>';
                        }else{
                            $tabla.='<td class="text-center">M</td>';
                        }
                        $tabla.='<td>'.$rows['LUGARNAC_A'].'</td> 
                        <td class="text-center">'.$rows['FECHANAC_A'].'</td>
                        <td class="text-center">'.$edad->y.'</td>';
                        if($val_tutor->rowCount()>0){
                            $tiene_tutor=false;
                            foreach($dato_tutor as $campos){
                                if($rows['ALUMNO_ID']==$campos['ALUMNO_ID'] && ($campos['ROL_FA']=="Padre" || $campos['ROL_FA']=="Tutor")){
                                    $tabla.='<td>'.$campos['APELLIDOP_FA'].' '.$campos['APELLIDOM_FA'].' '.$campos['NOMBRE_FA'].'</td>';
                                    $tiene_tutor=true;
                                }
                            }
                            if($tiene_tutor==false){
                                $tabla.='<td></td>';
                            }
                            $tiene_tutor=false;
                            foreach($dato_tutor as $campos){
                                if($rows['ALUMNO_ID']==$campos['ALUMNO_ID']  && ($campos['ROL_FA']=="Madre" || $campos['ROL_FA']=="Tutor")){
                                    $tabla.='<td>'.$campos['APELLIDOP_FA'].' '.$campos['APELLIDOM_FA'].' '.$campos['NOMBRE_FA'].'</td>';
                                    $tiene_tutor=true;
                                }
                            }
                            if($tiene_tutor==false){
                                $tabla.='<td></td>';
                            }
                        }
                    $tabla.='</tr>';
                    $contador++;
                }

            $tabla.='</tbody></table>';

            return $tabla;
        }

        /**Controlador datos referenciales*/
        public function referencial_curso_controlador($id_curso,$tipo){
            $id_curso = main_model::decryption($id_curso);
            $id_curso = main_model::limpiar_cadena($id_curso);

            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);

            $id_ua=$_SESSION['ua_id'];
            $check_referencial=main_model::ejecutar_consulta_simple("SELECT C.GRADO_CUR, C.SECCION_CUR, UA.DISTRITO_UA, UA.NOMBRE_UA
            FROM curso AS C, unidad_academico AS UA WHERE C.COD_CUR='$id_curso' AND UA.UA_ID='$id_ua'");

            if($check_referencial->rowCount()>=1){

                $campos=$check_referencial->fetch();
                $tabla = '<table class="size-text12">
                            <tr class="text-center">
                                <th>UNIDAD EDUCATIVA</th>
                            </tr>
                            <tr class="text-center">
                                <th>'.$campos['NOMBRE_UA'].'</th>
                            </tr>
                            <tr class="text-center">
                                <th>GESTIÓN '.$_SESSION['anio_academico'].'</th>
                            </tr>
                        </table>
                    
                        <div class="full-box page-header">
                            <h5 class="text-center">
                                '.$tipo.'
                            </h5>
                        </div>

                        <table class="table table-libreta2 size-text11 table-sm">
                            <tr>
                                <th>Distrito Educativo</th>
                                <td>'.$campos['DISTRITO_UA'].'</td>
                                <th>Año de Escolaridad</th>
                                <td>'.$campos['GRADO_CUR'].' '.$campos['SECCION_CUR'].'</td>  
                                <th>Nivel</th>
                                <td>Secundaria Comunitaria Productiva</td> 
                            </tr>
                            <tr>
                                <th>Maestra/o</th>
                                <td>'.$_SESSION['nombre_sa'].' '.$_SESSION['apellidoP_sa'].' '.$_SESSION['apellidoM_sa'].'</td>
                                <th>Directora/ro</th>';
                                $check_director=main_model::ejecutar_consulta_simple("SELECT NOMBRE_AD, APELLIDOP_AD, APELLIDOM_AD FROM admin WHERE UA_ID='$id_ua' AND TIPO='Director'");
                                if($check_director->rowCount()>=1){
                                    $campos_dir=$check_director->fetch();
                                    $tabla.='<td>'.$campos_dir['NOMBRE_AD'].' '.$campos_dir['APELLIDOP_AD'].' '.$campos_dir['APELLIDOM_AD'].'</td>'; 
                                }else{
                                    $tabla.='<td></td>';
                                }    
                                
                                $tabla.='                 
                                <th>Fecha</th>
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
        public function tabla_periodo_controlador($id_curso,$periodo_id){
            $id_curso = main_model::decryption($id_curso);
            $id_curso = main_model::limpiar_cadena($id_curso);
            $periodo_id = main_model::limpiar_cadena($periodo_id);

            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);

            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

            $tabla="";

            $val_alumno=main_model::ejecutar_consulta_simple("SELECT SQL_CALC_FOUND_ROWS A.* FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ASC");

            $datos = $val_alumno->fetchAll();

            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch();
            $id_anio_a=$id_anio['COD_ANIO'];
        
            $val_area=main_model::ejecutar_consulta_simple("SELECT COD_AREA, NOMBRE_AREA FROM area ORDER BY NOMBRE_AREA ASC");
            $cal_promedio=main_model::ejecutar_consulta_simple("SELECT C.ALUMNO_ID, C.NOTA, P.COD_AREA FROM valoracion AS V, calificacion AS C, profesor AS P
            WHERE  V.CRITERIO_VAL='Promedio' AND C.VAL_ID=V.VAL_ID AND P.PROFESOR_ID=C.PROFESOR_ID AND C.COD_PER='$periodo_id'
            AND C.COD_CUR='$id_curso' AND C.COD_ANIO='$id_anio_a'");

            $num_area = $val_area->rowCount();
            $dato_area = $val_area->fetchAll();
            $dato_prom_cal = $cal_promedio->fetchAll();
            

            $num_aprobados = $this::aprobado("ArrayBD",$dato_prom_cal);
            $num_reprobados = $val_alumno->rowCount()-$num_aprobados;
            $tabla.='
            <table class="table table-bordered table-sm size-text11" style="table-layout: fixed">
                    <thead>
                        <tr class="text-center">
                            <th style="width:2%;" class="tabla-parcial" rowspan="2">#</th>
                            <th style="width:20%;" class="tabla-parcial" rowspan="2">APELLIDOS Y NOMBRES</th>
                            <th class="tabla-parcial" colspan="'.$num_area.'">CAMPOS DE SABERES Y CONOCIMIENTOS</th>
                            <th id="rotate" class="tabla-parcial" rowspan="2"><div id="vertical">PROMEDIO TRIMESTRAL</div></th>
                            <th style="width:11%;" id="rotate" class="tabla-parcial" rowspan="2"><div id="vertical">SITUACIÓN TRIMESTRAL</div></th>
                        </tr>
                        <tr class="text-center tabla-evaluacion">';
                        foreach($dato_area as $rows){
                            $tabla.='<th id="rotate" style="font-size: 10px;"><div id="vertical">'.$rows['NOMBRE_AREA'].'</div></th>';
                        }
                    $tabla.='</tr>
                    </thead>
                <tbody>';

            $nota_promedio = array();

                $contador=1;
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
                            $tabla.='<td class="text-center">'.$nota_alumno.'</td>'; 
                        }
    
                        $promedio_par=$suma_par/$num_area;
                    }else{
                        $tabla.='<td></td>';
                    }

                    if($promedio_par<51){
                        $tabla.='<td class="valor-promedio2 text-center " style="color: red;">'.number_format($promedio_par).'</td>';
                        $tabla.='<td style="color: red;">REPROBADO</td>';
                    }else{
                        $tabla.='<td class="valor-promedio2 text-center">'.number_format($promedio_par).'</td>';
                        $tabla.='<td>APROBADO</td>';
                    }
                    $nota_promedio[] = number_format($promedio_par);

                    $tabla.='</tr>';
                    $contador++;
                }
                $reg_final=$contador-1;

            $tabla.='</tbody></table>';

            $num_aprobados = $this::aprobado("Array",$nota_promedio);
            $num_reprobados = $val_alumno->rowCount()-$num_aprobados;
            $tabla.='<input type="hidden" id="aprob_trim'.$periodo_id.'" value="'.$num_aprobados.'">
                    <input type="hidden" id="reprob_trim'.$periodo_id.'" value="'.$num_reprobados.'">';

            return $tabla;
        }

        /* cantralizador final registroP*/
        public function resumen_cuadroP_controlador($id_curso){
            $id_curso = main_model::decryption($id_curso);
            $id_curso = main_model::limpiar_cadena($id_curso);
            
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch();
            $id_anio_a=$id_anio['COD_ANIO'];
            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

            $tabla="";

            $val_alumno=main_model::ejecutar_consulta_simple("SELECT SQL_CALC_FOUND_ROWS A.* FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ASC");

            $datos = $val_alumno->fetchAll();

            $val_area=main_model::ejecutar_consulta_simple("SELECT * FROM area");
            $val_periodo=main_model::ejecutar_consulta_simple("SELECT * FROM periodo");
            $cal_promedio=main_model::ejecutar_consulta_simple("SELECT C.NOTA, C.ALUMNO_ID, C.COD_PER, P.COD_AREA FROM valoracion AS V, calificacion AS C, profesor AS P
            WHERE  CRITERIO_VAL='Promedio' AND C.VAL_ID=V.VAL_ID AND P.PROFESOR_ID=C.PROFESOR_ID AND C.COD_CUR='$id_curso' AND C.COD_ANIO='$id_anio_a'");
            $dato_area = $val_area->fetchAll();
            $dato_periodo = $val_periodo->fetchAll();
            $dato_prom_cal = $cal_promedio->fetchAll();
          
            $tabla.='
                    <table class="table table-bordered table-secondary table-sm" id="tabla_asignar_curso">
                        <thead>
                            <tr class="text-center tabla-evaluacion">
                                <th rowspan="2">#</th>
                                <th rowspan="2">APELLIDOS Y NOMBRES</th>
                                <th colspan="'.$val_periodo->rowCount().'">BOLETIN ANUAL</th>
                                <th rowspan="2" class="tabla-promedio" style="font-size: 10px;">PROMEDIO FINAL ANUAL</th>
                            </tr>
                            <tr class="text-center tabla-evaluacion">';
                                if($val_periodo->rowCount()>=1){
                                    foreach($dato_periodo as $rows){
                                        $tabla.='<th style="font-size: 10px;">'.$rows['NOMBRE_PER'].'</th>';
                                    }
                                }else{
                                    $tabla.='<th>No hay periodos registrados</th>';
                                }
                        $tabla.='</tr>
                        </thead>
                        <tbody>';

                $contador=1;
                
                foreach($datos as $rows){
                    $fecha_nacimiento = new DateTime($rows['FECHANAC_A']);
                    $hoy = new DateTime();
                    $edad = $hoy->diff($fecha_nacimiento);

                    $tabla.='<tr>
                        <td class="text-center">'.$contador.'</td>
                        <td>'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].' '.$rows['NOMBRE_A'].'</td>';
                        $suma_periodo=0;$promedio_anual=0;

                        if($val_periodo->rowCount()>1){
                            foreach($dato_periodo as $campos_p){
                                $nota_alumno=0;
                                foreach($dato_prom_cal as $campos_n){
                                    if($rows['ALUMNO_ID']==$campos_n['ALUMNO_ID'] && $campos_p['COD_PER']==$campos_n['COD_PER']){
                                        $nota_alumno= $nota_alumno+$this::comparar_nota($dato_area,$campos_n);
                                    }
                                }
                                $tabla.='<td class="text-center">'.number_format($nota_alumno/$val_area->rowCount()).'</td>';
                                $suma_periodo=$suma_periodo+($nota_alumno/$val_area->rowCount());
                            }

                            $promedio_anual=($suma_periodo/$val_periodo->rowCount());
                            $nota_promedio[] = number_format($promedio_anual);
                        }else{
                            $tabla.='<td></td>';
                        }

                        if(number_format($promedio_anual)<51){
                            $tabla.='<td class="valor-promedio text-center" style="color: red;">'.number_format($promedio_anual).'</td>';
                        }else{
                            $tabla.='<td class="valor-promedio text-center">'.number_format($promedio_anual).'</td>';
                        }
                    $tabla.='</tr>';
                    $contador++;
                }

            $tabla.='</tbody></table>';

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
  
        /* controlador datos periodo */
        public function datos_periodo_controlador(){
            return modelo_reporte::datos_periodo_modelo();
        }
    }