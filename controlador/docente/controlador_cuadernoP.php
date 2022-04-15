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
                                '.controlador_cuadernoP::tree_curso_grado($rows['TURNO_CUR'],$id_docente,$anio).'
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

            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);

            $id_ua=$_SESSION['ua_id'];
            $id_area=$_SESSION['id_area'];
            $check_referencial=main_model::ejecutar_consulta_simple("SELECT C.GRADO_CUR, C.SECCION_CUR, UA.DISTRITO_UA, UA.NOMBRE_UA, A.NOMBRE_AREA, A.CAMPO_AREA
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
                                <th>CAMPO</th>
                                <td>'.$campos['CAMPO_AREA'].'</td>      
                            </tr>
                            <tr>
                                <th>DIRECTORA/OR</th>';
                                $check_director=main_model::ejecutar_consulta_simple("SELECT NOMBRE_AD, APELLIDOP_AD, APELLIDOM_AD FROM admin WHERE UA_ID='$id_ua' AND TIPO='Director'");
                                if($check_director->rowCount()>=1){
                                    $campos_dir=$check_director->fetch();
                                    $tabla.='<td>'.$campos_dir['NOMBRE_AD'].' '.$campos_dir['APELLIDOP_AD'].' '.$campos_dir['APELLIDOM_AD'].'</td>'; 
                                }else{
                                    $tabla.='<td></td>';
                                }
                                     
                            $tabla.=' <th>ÁREA</th>
                            <td>'.$campos['NOMBRE_AREA'].'</td>  </tr>
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

        /* controlador paginar alumno*/
        public function paginador_alumno_controlador(){
            $id_curso = main_model::decryption($_POST['curso_id_afiliacion']);
            $id_curso = main_model::limpiar_cadena($id_curso);
            $pagina = main_model::limpiar_cadena($_POST['docente_id']);
            $url = main_model::limpiar_cadena($_POST['url']);
            $id_cp = main_model::limpiar_cadena($_POST['cuaderno_pedagogico']);
            $registros=15;

            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);
            $url=SERVERURL.$url."/";

            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            $consulta="SELECT SQL_CALC_FOUND_ROWS A.* FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ORDER BY A.ALUMNO_ID ASC LIMIT $inicio,$registros";

            $val_tutor=main_model::ejecutar_consulta_simple("SELECT F.FAMILAR_ID, F.NOMBRE_FA, F.APELLIDOP_FA, F.APELLIDOM_FA, A.ALUMNO_ID, F.ROL_FA FROM cur_alum AS CA, familiar AS F, fa_alumno AS FA, alumno AS A WHERE  
            CA.ALUMNO_ID=A.ALUMNO_ID AND A.UA_ID='$ue' AND A.ALUMNO_ID=FA.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND F.FAMILAR_ID=FA.FAMILAR_ID");
            $dato_tutor=$val_tutor->fetchAll();

            $conexion = main_model::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();
            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();
            $Npaginas=ceil($total/$registros);

            $tabla.='<div class="table-responsive">
                    <table class="table table-dark table-sm" id="tabla_asignar_curso">
                        <thead>
                            <tr class="text-center roboto-medium">
                                <th rowspan="2">#</th>
                                <th rowspan="2">RUDE</th>
                                <th rowspan="2">APELLIDOS Y NOMBRES</th>
                                <th rowspan="2">CI</th>
                                <th rowspan="2"><div class="verticalText">GÉNERO</div></th>
                                <th colspan="2">NACIMIENTO</th>
                                <th rowspan="2"><div class="verticalText">EDAD</div></th>
                                <th>PADRE O TUTOR</th>
                                <th>MADRE O TUTORA</th>';
                                if($id_cp=="registroPedagogico"){
                                    $tabla.='<th rowspan="2">LIBRETA</th>';
                                }
                            $tabla.='</tr>
                            <tr class="text-center roboto-medium">
                                <th>LUGAR</th>
                                <th>FECHA</th>
                                <th>APELLIDOS Y NOMBRES</th>
                                <th>APELLIDOS Y NOMBRES</th>
                            </tr>
                        </thead>
                        <tbody>';
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
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
                        if($id_cp=="registroPedagogico"){
                            $tabla.='<td class="text-center">
                                        <a href="'.SERVERURL.'docente/alumno-libreta/'.main_model::encryption($rows['ALUMNO_ID']).'/'.$id_curso.'/" class="btn btn-success">
                                            <i class="fas fa-id-badge"></i>
                                        </a>
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

            return $tabla;
        }

        /* controlador datos del periodo*/
        public function tabla_periodo_controlador(){
            $id_curso = main_model::decryption($_POST['curso_id_periodo']);
            $id_curso = main_model::limpiar_cadena($id_curso);
            $periodo_id = main_model::limpiar_cadena($_POST['periodo_id']);

            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

            $tabla="";

            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch(); unset($val_anio);
            $id_anio_a=$id_anio['COD_ANIO'];
            $val_calificacion=main_model::ejecutar_consulta_simple("SELECT * FROM calificacion WHERE COD_PER='$periodo_id' AND PROFESOR_ID='$id_docente' 
            AND COD_CUR='$id_curso' AND COD_ANIO='$id_anio_a'");
            $val_num_calificacion = $val_calificacion->rowCount(); unset($val_calificacion);

            if($val_num_calificacion > 0){
                $tabla.=controlador_cuadernoP::tabla_periodo_llenar($periodo_id,$id_curso,$anio_academico,$id_anio_a);
            }else{
                $tabla.=controlador_cuadernoP::tabla_periodo_vacio($periodo_id,$id_curso,$anio_academico);
            }

            return $tabla;
        }

        /* controlador agregar cuadro pedagogico*/
        public function agregar_cuadroP_controlador(){
            $id_cuaderno = main_model::limpiar_cadena($_POST['id_cuaderno_reg']);
            $id_curso = main_model::decryption($_POST['id_agregar_curso']);
            $id_curso = main_model::limpiar_cadena($id_curso);
            $id_periodo = main_model::decryption($_POST['id_agregar_periodo']);
            $id_periodo = main_model::limpiar_cadena($id_periodo);
            $tabla = json_decode($_POST['tabla'], true);

            session_start(['name'=>'SA']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch();
            
            $array_data = [];
            foreach($tabla as $value){
                foreach($value['parciales'] as $value_par){
                    $id_val=main_model::decryption($value_par['parcial']);
                    if($value_par['nota'] == "") $nota_cal = 0;
                    else $nota_cal=$value_par['nota'];

                    $datos_cp_reg=[
                        "Alumno_id"=>main_model::decryption($value['id_alumno']),
                        "Periodo_id"=>$id_periodo,
                        "Docente_id"=>$id_docente,
                        "Curso_id"=>$id_curso,
                        "Anio_id"=>$id_anio['COD_ANIO'],
                        "Val_id"=>$id_val,
                        "Nota_id"=>$nota_cal
                    ];
                    array_push($array_data,$datos_cp_reg);
                }
            }
            if($id_cuaderno=="save"){
                $agregar_cp=modelo_cuadernoP::agregar_cuadernoP_modelo($array_data);
                if($agregar_cp->rowCount()<1){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"No hemos podido registrar los datos",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }elseif($id_cuaderno=="update"){
                $agregar_cp=modelo_cuadernoP::update_cuadernoP_modelo($array_data);
            }

            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Datos registrados",
                "Texto"=>"El cuaderno pedagógico ha sido registrado con exito",
                "Tipo"=>"success"
            ];
            echo json_encode($alerta);
        }

        /* tabla cuadernoP vacio*/
        public function tabla_periodo_vacio($periodo_id,$id_curso,$anio_academico){
            $pagina = main_model::limpiar_cadena($_POST['docente_id']);
            $url = main_model::limpiar_cadena($_POST['url']);
            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);
            $url=SERVERURL.$url."/";

            $val_docente=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE USUARIO_VAL='Docente'");
            $val_docente_n=$val_docente->rowCount()+2; unset($val_docente);

            $val_prom_total=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE CRITERIO_VAL='Promedio'");
            $dato_prom_total = $val_prom_total->fetch(); unset($val_prom_total);

            $val_SD=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE CRITERIO_VAL LIKE '%Ser%' OR CRITERIO_VAL LIKE '%Decir%' ");
            $dato_SD = $val_SD->fetchAll();
            $val_SD_num = $val_SD->rowCount(); unset($val_SD);
            
            $val_parcial=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE CRITERIO_VAL LIKE '%Parcial%'");
            $val_actividad=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE CRITERIO_VAL LIKE '%Actividad%'");

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
            $total = $conexion->query("SELECT FOUND_ROWS()"); unset($conexion);
            $total = (int) $total->fetchColumn();
            $Npaginas=ceil($total/$registros);

            
            $val_parcial_n=$val_parcial->rowCount()+1;
            $dato_parcial = $val_parcial->fetchAll();

            $val_actividad_n=$val_actividad->rowCount()+1;
            $dato_actividad = $val_actividad->fetchAll();

            $tabla.='<div class="table-responsive">
            <input type="hidden" id="cuaderno_reg" value="save">
            <input type="hidden" id="id_curso_table" value="'.$_POST['curso_id_periodo'].'">
            <input type="hidden" id="id_periodo_table" value="'.main_model::encryption($periodo_id).'">
            <input type="hidden" id="aprob_trim'.$periodo_id.'" value="0">
            <input type="hidden" id="reprob_trim'.$periodo_id.'" value="'.$total.'">
            <table class="table table-bordered table-secondary table-sm" id="table_cp">
                <thead>
                    <tr class="text-center roboto-medium">
                        <th colspan="3" rowspan="3"><span class="text-dark">Alumnos aprobados y reprobados</span><canvas class="grafico-pastel" id="myChart'.$periodo_id.'" ></canvas></th>
                        <th class="tabla-parcial" colspan="'.$val_docente_n.'">EVALUACION MAESTRA/O</th>
                        <th class="tabla-parcial" colspan="3">EV. Alumno</th>
                        <th class="tabla-parcial" rowspan="4"><div class="verticalText">TOTAL TRIMESTRAL</div></th>
                        <th class="tabla-parcial" rowspan="4"><div class="verticalText">SITUACIÓN TRIMESTRAL</div></th>
                    </tr>
                    <tr class="text-center roboto-medium">
                        <th class="tabla-parcial" colspan="'.$val_parcial_n.'">SABER - 35</th>
                        <th class="tabla-parcial" colspan="'.$val_actividad_n.'">HACER - 35</th>
                        <th class="tabla-parcial" colspan="2">S-D 20</th>
                        <th class="tabla-parcial" colspan="2">S-D 10</th>
                        <th class="tabla-parcial"></th>
                    </tr>
                    <tr class="text-center roboto-medium">';
                        if($val_parcial->rowCount()>0){
     
                            foreach($dato_parcial as $rows){
                                $tabla.='<th class="tabla-parcial">35</th>';
                            }
                        }
                        $tabla.='<th class="tabla-promedio">35</th>';

                        if($val_actividad->rowCount()>0){
                            foreach($dato_actividad as $rows){
                                $tabla.='<th class="tabla-parcial">35</th>';
                            }
                        }
                        $tabla.='<th class="tabla-promedio">35</th>

                        <th class="tabla-parcial">10</th>
                        <th class="tabla-parcial">10</th>
                        <th class="tabla-parcial">5</th>
                        <th class="tabla-parcial">5</th>
                        <th class="tabla-promedio">30</th>
                        
                    </tr>
                    <tr class="text-center roboto-medium tabla-evaluacion">
                        <th>#</th>
                        <th>APELLIDOS Y NOMBRES</th>
                        <th height="80" style="font-size: 10px;"><div class="verticalText">CRITERIOS DE EVALUACIÓN</div></th>';
                        
                        if($val_parcial->rowCount()>0){
                            foreach($dato_parcial as $rows){
                                $tabla.='<th style="font-size: 10px;"><div class="verticalText">'.$rows['CRITERIO_VAL'].'</div></th>';
                            }
                        }
                        $tabla.='<th class="tabla-promedio" style="font-size: 10px;"><div class="verticalText">PROMEDIO</div></th>';
                        
                        if($val_actividad->rowCount()>0){
                            foreach($dato_actividad as $rows){
                                $tabla.='<th style="font-size: 10px;"><div class="verticalText">'.$rows['CRITERIO_VAL'].'</div></th>';
                            }
                        }
                        $tabla.='<th class="tabla-promedio" style="font-size: 10px;"><div class="verticalText">PROMEDIO</div></th>
                        
                        <th style="font-size: 10px;"><div class="verticalText">Ser</div></th>
                        <th style="font-size: 10px;"><div class="verticalText">Decidir</div></th>
                        <th style="font-size: 10px;"><div class="verticalText">Ser</div></th>
                        <th style="font-size: 10px;"><div class="verticalText">Decidir</div></th>
                        <th class="tabla-promedio" style="font-size: 10px;"><div class="verticalText">PROMEDIO</div></th>
                    </tr>
                </thead>
                <tbody>';
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='<tr>
                    <input type="hidden" value="'.main_model::encryption($rows['ALUMNO_ID']).'">
                    <td>'.$contador.'</td>
                    <td colspan="2">'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].' '.$rows['NOMBRE_A'].'</td>';
                    $cont_val=0;


                    if($val_parcial->rowCount()>0){
                        foreach($dato_parcial as $rows){
                            $tabla.='<td class="campo_par" id="'.main_model::encryption($rows['VAL_ID']).'" contenteditable="true"></td>';
                        }
                    }
                    $tabla.='<td class="valor-promedio" id="prom_par">0.00</td>';

                    if($val_actividad->rowCount()>0){
                        foreach($dato_actividad as $rows){
                            $tabla.='<td class="campo_act" id="'.main_model::encryption($rows['VAL_ID']).'" contenteditable="true"></td>';
                        }
                    }
                    $tabla.='<td class="valor-promedio" id="prom_act">0.00</td>';

                    if($val_SD_num>0){
                        foreach($dato_SD as $rows){
                            $tabla.='<td class="campo_sd" id="'.main_model::encryption($rows['VAL_ID']).'" contenteditable="true"></td>';
                        }
                    }
                    $tabla.='<td class="valor-promedio" id="prom_SD">0.00</td>';

                    $tabla.='<td class="campo_total" id="'.main_model::encryption($dato_prom_total['VAL_ID']).'">0</td>';
                    $tabla.='<td class="prom_estado"></td>';

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
            $tabla.='</tbody></table></div>
                    <div class="input-group">
                        <p class="mr-auto">
                            <button type="button" class="btn_cp btn btn-raised btn-info" name="Enviar"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                        </p>';

            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p>Mostrando alumno '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.='</div>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }
            return $tabla;
        }

        /* tabla cuadernoP lleno*/
        public function tabla_periodo_llenar($periodo_id,$id_curso,$anio_academico,$id_anio_a){
            $pagina = main_model::limpiar_cadena($_POST['docente_id']);
            $url = main_model::limpiar_cadena($_POST['url']);
            $ue = main_model::limpiar_cadena($_SESSION['ua_id']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);
            $url=SERVERURL.$url."/";

            $val_docente=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE USUARIO_VAL='Docente'");
            $val_docente_n=$val_docente->rowCount()+2; unset($val_docente);

            $val_prom_total=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE CRITERIO_VAL='Promedio'");
            $dato_prom_total = $val_prom_total->fetch(); unset($val_prom_total);

            $val_SD=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE CRITERIO_VAL LIKE '%Ser%' OR CRITERIO_VAL LIKE '%Decir%' ");
            $dato_SD = $val_SD->fetchAll();
            $val_SD_num = $val_SD->rowCount(); unset($val_SD);
            
            $val_parcial=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE CRITERIO_VAL LIKE '%Parcial%'");
            $val_actividad=main_model::ejecutar_consulta_simple("SELECT * FROM valoracion WHERE CRITERIO_VAL LIKE '%Actividad%'");

            $tabla="";

            $registros=15;
            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            $cal_parcial=main_model::ejecutar_consulta_simple("SELECT V.VAL_ID,C.ALUMNO_ID,C.NOTA FROM valoracion AS V, calificacion AS C 
            WHERE V.CRITERIO_VAL LIKE '%Parcial%' AND C.VAL_ID=V.VAL_ID AND COD_PER='$periodo_id' AND PROFESOR_ID='$id_docente' 
            AND COD_CUR='$id_curso' AND COD_ANIO='$id_anio_a'");
            $dato_parcial_cal = $cal_parcial->fetchAll(); unset($cal_parcial);

            $cal_actividad=main_model::ejecutar_consulta_simple("SELECT V.VAL_ID,C.ALUMNO_ID,C.NOTA FROM valoracion AS V, calificacion AS C 
            WHERE V.CRITERIO_VAL LIKE '%Actividad%' AND C.VAL_ID=V.VAL_ID AND COD_PER='$periodo_id' AND PROFESOR_ID='$id_docente' 
            AND COD_CUR='$id_curso' AND COD_ANIO='$id_anio_a'");
            $dato_actividad_cal = $cal_actividad->fetchAll(); unset($cal_actividad);

            $cal_SD=main_model::ejecutar_consulta_simple("SELECT V.VAL_ID,C.ALUMNO_ID,C.NOTA FROM valoracion AS V, calificacion AS C 
            WHERE (CRITERIO_VAL LIKE '%Ser%' OR CRITERIO_VAL LIKE '%Decir%') AND C.VAL_ID=V.VAL_ID AND COD_PER='$periodo_id' AND PROFESOR_ID='$id_docente' 
            AND COD_CUR='$id_curso' AND COD_ANIO='$id_anio_a'");
             $dato_SD_cal = $cal_SD->fetchAll(); unset($cal_SD);

            $cal_promedio=main_model::ejecutar_consulta_simple("SELECT C.NOTA FROM valoracion AS V, calificacion AS C 
            WHERE  CRITERIO_VAL='Promedio' AND C.VAL_ID=V.VAL_ID AND COD_PER='$periodo_id' AND PROFESOR_ID='$id_docente' 
            AND COD_CUR='$id_curso' AND COD_ANIO='$id_anio_a'");
            $dato_prom_cal = $cal_promedio->fetchAll(); unset($cal_promedio);

            $consulta="SELECT SQL_CALC_FOUND_ROWS A.* FROM cur_alum AS CA, alumno AS A WHERE 
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ORDER BY A.ALUMNO_ID ASC LIMIT $inicio,$registros";
            
            $conexion = main_model::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();
            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();
            $Npaginas=ceil($total/$registros);

            $val_parcial_n=$val_parcial->rowCount()+1;
            $dato_parcial = $val_parcial->fetchAll();

            $val_actividad_n=$val_actividad->rowCount()+1;
            $dato_actividad = $val_actividad->fetchAll();

            $num_aprobados = controlador_cuadernoP::aprobado("ArrayBD",$dato_prom_cal);
            $num_reprobados = $total-$num_aprobados;
            $tabla.='<div class="table-responsive">
            <input type="hidden" id="cuaderno_reg" value="update">
            <input type="hidden" id="id_curso_table" value="'.$_POST['curso_id_periodo'].'">
            <input type="hidden" id="id_periodo_table" value="'.main_model::encryption($periodo_id).'">
            <input type="hidden" id="aprob_trim'.$periodo_id.'" value="'.$num_aprobados.'">
            <input type="hidden" id="reprob_trim'.$periodo_id.'" value="'.$num_reprobados.'">

            <table class="table table-bordered table-secondary table-sm" id="table_cp">
                <thead>
                    <tr class="text-center roboto-medium">
                        <th colspan="3" rowspan="3"><span class="text-dark">Alumnos aprobados y reprobados</span><canvas class="grafico-pastel" id="myChart'.$periodo_id.'" ></canvas></th>
                        <th class="tabla-parcial" colspan="'.$val_docente_n.'">EVALUACION MAESTRA/O</th>
                        <th class="tabla-parcial" colspan="3">EV. Alumno</th>
                        <th class="tabla-parcial" rowspan="4"><div class="verticalText">TOTAL TRIMESTRAL</div></th>
                        <th class="tabla-parcial" rowspan="4"><div class="verticalText">SITUACIÓN TRIMESTRAL</div></th>
                    </tr>
                    <tr class="text-center roboto-medium">
                        <th class="tabla-parcial" colspan="'.$val_parcial_n.'">SABER - 35</th>
                        <th class="tabla-parcial" colspan="'.$val_actividad_n.'">HACER - 35</th>
                        <th class="tabla-parcial" colspan="2">S-D 20</th>
                        <th class="tabla-parcial" colspan="2">S-D 10</th>
                        <th class="tabla-parcial"></th>
                    </tr>
                    <tr class="text-center roboto-medium">';
     
                        foreach($dato_parcial as $rows){
                            $tabla.='<th class="tabla-parcial">35</th>';
                        }
                        $tabla.='<th class="tabla-promedio">35</th>';

                        foreach($dato_actividad as $rows){
                            $tabla.='<th class="tabla-parcial">35</th>';
                        }
                        $tabla.='<th class="tabla-promedio">35</th>

                        <th class="tabla-parcial">10</th>
                        <th class="tabla-parcial">10</th>
                        <th class="tabla-parcial">5</th>
                        <th class="tabla-parcial">5</th>
                        <th class="tabla-promedio">30</th>
                        
                    </tr>
                    <tr class="text-center roboto-medium tabla-evaluacion">
                        <th>#</th>
                        <th>APELLIDOS Y NOMBRES</th>
                        <th height="80" style="font-size: 10px;"><div class="verticalText">CRITERIOS DE EVALUACIÓN</div></th>';
                
                        foreach($dato_parcial as $rows){
                            $tabla.='<th style="font-size: 10px;"><div class="verticalText">'.$rows['CRITERIO_VAL'].'</div></th>';
                        }
                        $tabla.='<th class="tabla-promedio" style="font-size: 10px;"><div class="verticalText">PROMEDIO</div></th>';
                        
                        foreach($dato_actividad as $rows){
                            $tabla.='<th style="font-size: 10px;"><div class="verticalText">'.$rows['CRITERIO_VAL'].'</div></th>';
                        }
                        $tabla.='<th class="tabla-promedio" style="font-size: 10px;"><div class="verticalText">PROMEDIO</div></th>
                        
                        <th style="font-size: 10px;"><div class="verticalText">Ser</div></th>
                        <th style="font-size: 10px;"><div class="verticalText">Decidir</div></th>
                        <th style="font-size: 10px;"><div class="verticalText">Ser</div></th>
                        <th style="font-size: 10px;"><div class="verticalText">Decidir</div></th>
                        <th class="tabla-promedio" style="font-size: 10px;"><div class="verticalText">PROMEDIO</div></th>
                    </tr>
                </thead>
                <tbody>';
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='<tr>
                    <input type="hidden" value="'.main_model::encryption($rows['ALUMNO_ID']).'">
                    <td>'.$contador.'</td>
                    <td colspan="2">'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].' '.$rows['NOMBRE_A'].'</td>';
                    $cont_val=0;

                    $suma_par=0;$cont_total=0;$isempty=true;
                    foreach($dato_parcial_cal as $campos){
                        if($rows['ALUMNO_ID']==$campos['ALUMNO_ID']){
                            $tabla.='<td class="campo_par" id="'.main_model::encryption($campos['VAL_ID']).'" contenteditable="true">'.intval($campos['NOTA']).'</td>';
                            $suma_par=$suma_par+intval($campos['NOTA']);
                            $cont_total++;
                            $isempty=false;
                        }   
                    }
                    if($isempty){
                        if($val_parcial->rowCount()>0){
                            foreach($dato_parcial as $rows){
                                $tabla.='<td class="campo_par" id="'.main_model::encryption($rows['VAL_ID']).'" contenteditable="true">0</td>';
                            }
                        }
                        $tabla.='<td class="valor-promedio" id="prom_par">0.00</td>';
                    }else{
                        $promedio_par=($suma_par/$cont_total)*0.35;
                        $tabla.='<td class="valor-promedio" id="prom_par">'.number_format($promedio_par, 2, '.', ' ').'</td>';
                    }
                    
                    $suma_act=0;$cont_total=0;$isempty=true;
                    foreach($dato_actividad_cal as $campos){
                        if($rows['ALUMNO_ID']==$campos['ALUMNO_ID']){
                            $tabla.='<td class="campo_act" id="'.main_model::encryption($campos['VAL_ID']).'" contenteditable="true">'.intval($campos['NOTA']).'</td>';
                            $suma_act=$suma_act+intval($campos['NOTA']);
                            $cont_total++;
                            $isempty=false;
                        }  
                    }
                    if($isempty){
                        if($val_actividad->rowCount()>0){
                            foreach($dato_actividad as $rows){
                                $tabla.='<td class="campo_act" id="'.main_model::encryption($rows['VAL_ID']).'" contenteditable="true">0</td>';
                            }
                        }
                        $tabla.='<td class="valor-promedio" id="prom_act">0.00</td>';
                    }else{
                        $pomedio_act=($suma_act/$cont_total)*0.35;
                        $tabla.='<td class="valor-promedio" id="prom_act">'.number_format($pomedio_act, 2, '.', ' ').'</td>';
                    }

                    $suma_sd=0;$isempty=true;
                    foreach($dato_SD_cal as $campos){
                        if($rows['ALUMNO_ID']==$campos['ALUMNO_ID']){
                            $tabla.='<td class="campo_sd" id="'.main_model::encryption($campos['VAL_ID']).'" contenteditable="true">'.intval($campos['NOTA']).'</td>';
                            $suma_sd=$suma_sd+intval($campos['NOTA']);
                            $isempty=false;
                        }
                    }
                    if($isempty){
                        if($val_SD_num>0){
                            foreach($dato_SD as $rows){
                                $tabla.='<td class="campo_sd" id="'.main_model::encryption($rows['VAL_ID']).'" contenteditable="true">0</td>';
                            }
                        }
                        $tabla.='<td class="valor-promedio" id="prom_SD">0.00</td>';
    
                        $tabla.='<td class="campo_total" id="'.main_model::encryption($dato_prom_total['VAL_ID']).'">0</td>';
                        $tabla.='<td class="prom_estado"></td>';
                    }else{
                        $tabla.='<td class="valor-promedio" id="prom_SD">'.number_format($suma_sd, 2, '.', ' ').'</td>';
                        $promedio_total=number_format($promedio_par+$pomedio_act+$suma_sd);
                        if($promedio_total<51){
                            $tabla.='<td class="campo_total" id="'.main_model::encryption($dato_prom_total['VAL_ID']).'" style="color: red;">'.$promedio_total.'</td>';
                            $tabla.='<td class="prom_estado" style="color: red;">REPROBADO</td>';
                        }else{
                            $tabla.='<td class="campo_total" id="'.main_model::encryption($dato_prom_total['VAL_ID']).'">'.$promedio_total.'</td>';
                            $tabla.='<td class="prom_estado">APROBADO</td>';
                        }
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
            $tabla.='</tbody></table></div>
                    <div class="input-group">
                        <p class="mr-auto">
                            <button type="button" class="btn_cp btn btn-raised btn-info" name="Enviar"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                        </p>';

            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p>Mostrando alumno '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.='</div>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }

            return $tabla;
        }

        /** funcion para conttar aprobado/reprobado */
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

        /* resumen cuadernoP*/
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
            A.UA_ID='$ue' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$id_curso' AND YEAR(FECHA_INI_CA)='$anio_academico' 
            GROUP BY A.ALUMNO_ID ORDER BY A.ALUMNO_ID ASC LIMIT $inicio,$registros";

            $conexion = main_model::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();
            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();
            $Npaginas=ceil($total/$registros);

            $val_periodo=main_model::ejecutar_consulta_simple("SELECT * FROM periodo");
            $cal_promedio=main_model::ejecutar_consulta_simple("SELECT C.NOTA, C.ALUMNO_ID, C.COD_PER FROM valoracion AS V, calificacion AS C 
            WHERE  CRITERIO_VAL='Promedio' AND C.VAL_ID=V.VAL_ID AND PROFESOR_ID='$id_docente' 
            AND COD_CUR='$id_curso' AND COD_ANIO='$id_anio_a'");
            $dato_periodo = $val_periodo->fetchAll();
            $dato_prom_cal = $cal_promedio->fetchAll();
          
            $tabla.='<div class="row">
                    <div class="col">
                    <div class="table-responsive">
                    <table class="table table-bordered table-secondary table-sm" id="tabla_asignar_curso">
                        <thead>
                            <tr class="text-center roboto-medium tabla-evaluacion">
                                <th>#</th>
                                <th>APELLIDOS Y NOMBRES</th>';
                                if($val_periodo->rowCount()>=1){
                                    foreach($dato_periodo as $rows){
                                        $tabla.='<th style="font-size: 10px;"><div class="verticalText">'.$rows['NOMBRE_PER'].'</div></th>';
                                    }
                                }
                                $tabla.='<th class="tabla-promedio" style="font-size: 10px;"><div class="verticalText">ANUAL</div></th>
                            </tr>
                        </thead>
                        <tbody>';
            $nota_promedio = array();
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                
                foreach($datos as $rows){
                    $fecha_nacimiento = new DateTime($rows['FECHANAC_A']);
                    $hoy = new DateTime();
                    $edad = $hoy->diff( $fecha_nacimiento);

                    $tabla.='<tr>
                        <td>'.$contador.'</td>
                        <td>'.$rows['APELLIDOP_A'].' '.$rows['APELLIDOM_A'].' '.$rows['NOMBRE_A'].'</td>';
                        $suma_act=0;$pomedio_act=0;

                        if($val_periodo->rowCount()>1){
                            foreach($dato_periodo as $campos_p){
                                $nota_alumno=0;
                                foreach($dato_prom_cal as $campos_n){
                                    if($rows['ALUMNO_ID']==$campos_n['ALUMNO_ID'] && $campos_p['COD_PER']==$campos_n['COD_PER']){
                                        $nota_alumno=$campos_n['NOTA'];
                                        $suma_act=$suma_act+intval($campos_n['NOTA']);
                                    }
                                }
                                $tabla.='<td>'.$nota_alumno.'</td>';
                            }

                            $pomedio_act=($suma_act/$val_periodo->rowCount());
                            $nota_promedio[] = number_format($pomedio_act);
                        }else{
                            $tabla.='<td></td>';
                        }


                        if(number_format($pomedio_act)<51){
                            $tabla.='<td class="valor-promedio" style="color: red;">'.number_format($pomedio_act).'</td>';
                        }else{
                            $tabla.='<td class="valor-promedio">'.number_format($pomedio_act).'</td>';
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
            $tabla.='</tbody></table></div></div>';

            $num_aprobados = controlador_cuadernoP::aprobado("Array",$nota_promedio);
            $num_reprobados = $total-$num_aprobados;
            $tabla.='<div class="col">
                        <input type="hidden" id="aprob_anual" value="'.$num_aprobados.'">
                        <input type="hidden" id="reprob_anual" value="'.$num_reprobados.'">
                        <canvas id="grafico-anual" class="grafico-pastel-anual""></canvas>
                    </div>
                </div><br>';

                $tabla.='<br><div class="input-group">
                    <p class="mr-auto">
                        <a type="button" href="'.SERVERURL.'reporte/reporte_cp.php?id='.main_model::encryption($id_curso).'" class=" btn btn-raised btn-warning">
                            <i class="fas fa-file-excel"></i> &nbsp; EXPORTAR A PDF
                        </a>
                    </p>';
            
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando alumno '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p></div>';
                $tabla.=main_model::paginador_tablas($pagina, $Npaginas, $url, 7);
            }
            return $tabla;
        }

        /* cursos asignados a docentes*/
        public function cursos_asignadosCP_controlador(){
            session_start(['name'=>'SA']);
            $anio=main_model::limpiar_cadena($_SESSION['anio_academico']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

            $turno=main_model::ejecutar_consulta_simple("SELECT C.TURNO_CUR FROM curso AS C, cur_prof AS CP, 
            profesor AS P WHERE C.COD_CUR=CP.COD_CUR AND CP.PROFESOR_ID=P.PROFESOR_ID 
            AND P.PROFESOR_ID='$id_docente' AND YEAR(FECHA_INI_CP)='$anio'");

            $total_cuadernoP = $turno->rowCount(); unset($turno);
            return $total_cuadernoP;
        }
  
    }