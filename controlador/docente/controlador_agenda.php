<?php
    if($peticionAjax){
        require_once "../../modelo/docente/modelo_agenda.php";
        include_once "../respuestas.class.php";
    }else{
        require_once "./modelo/docente/modelo_agenda.php";
    }

    
    class controlador_agenda extends modelo_agenda{

        /* controlador datos agenda */
        public function datos_agenda_controlador(){
            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch(); unset($val_anio);
            $id_anio_a=$id_anio['COD_ANIO'];

            $datos=[
                "ProfesorId" => $id_docente,
                "CodAnio" => $id_anio_a
            ];

            $val_agenda = modelo_agenda::datos_agenda_modelo($datos);
            if($val_agenda->rowCount()>0){
                return $val_agenda->fetchAll(PDO::FETCH_ASSOC);
            }else return [];
        }

        /* controlador obtener nombre curso */
        public function datos_cursos_controlador(){
            session_start(['name'=>'SA']);
            $anio = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

            $val_curso=main_model::ejecutar_consulta_simple("SELECT C.COD_CUR, CONCAT(C.TURNO_CUR, ' - ', C.GRADO_CUR, ' ', C.SECCION_CUR) as nombre FROM curso AS C, cur_prof AS CP, 
            profesor AS P WHERE C.COD_CUR=CP.COD_CUR AND CP.PROFESOR_ID=P.PROFESOR_ID 
            AND P.PROFESOR_ID='$id_docente' AND YEAR(FECHA_INI_CP)='$anio' AND RESPONSABLE_CP=1");

            if($val_curso->rowCount()>0){
                return $val_curso->fetchAll(PDO::FETCH_ASSOC);
            }else return array();
        }

        /* controlador guardar agenda */
        public function register_agenda_controlador(){
            $title=main_model::limpiar_cadena($_POST['agenda_titulo_reg']);
            $description=main_model::limpiar_cadena($_POST['agenda_descripcion_reg']);
            $curso=main_model::limpiar_cadena($_POST['agenda_curso_reg']);
            $start=main_model::limpiar_cadena($_POST['agenda_start_reg']);
            $end=main_model::limpiar_cadena($_POST['agenda_end_reg']);
            $color=main_model::limpiar_cadena($_POST['agenda_color_reg']);
            $max=main_model::limpiar_cadena($_POST['agenda_max_reg']);

            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);
            $ua = main_model::limpiar_cadena($_SESSION['ua_id']);

            if($this->getDateTimeYear($start) !== $anio_academico){
                $alerta=[
                    "Tipo"=>"validation",
                    "Input"=>"agenda_start",
                    "InputError"=>"agenda_start_error",
                ];

                echo json_encode($alerta);
                exit();
            }

            if($this->getDateTimeYear($end) !== $anio_academico){
                $alerta=[
                    "Tipo"=>"validation",
                    "Input"=>"agenda_end",
                    "InputError"=>"agenda_end_error",
                ];

                echo json_encode($alerta);
                exit();
            }

            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch(); unset($val_anio);
            $id_anio_a=$id_anio['COD_ANIO'];

            $sala = $this->sala_agenda($id_docente,$curso,$id_anio_a,$ua);

            $datos_agenda_reg=[
                "Title"=>$title,
                "Description"=>$description,
                "Curso"=>$curso,
                "Start"=>$start,
                "End"=>$end,
                "Sala"=>$sala,
                "Color"=>$color,
                "Max"=>$max,
                "DocenteId"=>$id_docente,
                "AnioId"=>$id_anio_a,
            ];

            $agregar_agenda=modelo_agenda::register_agenda_modelo($datos_agenda_reg);

            if($agregar_agenda->rowCount()==1){

                $nombre_d = main_model::limpiar_cadena($_SESSION['nombre_sa']);
                $apellidoP_d = main_model::limpiar_cadena($_SESSION['apellidoP_sa']);
                $apellidoM_d = main_model::limpiar_cadena($_SESSION['apellidoM_sa']);
                
                $val_curso=main_model::ejecutar_consulta_simple("SELECT TURNO_CUR, GRADO_CUR, SECCION_CUR FROM curso WHERE COD_CUR='$curso'");
                $dato_curso = $val_curso->fetch(); unset($val_curso);

                $val_ua=main_model::ejecutar_consulta_simple("SELECT NOMBRE_UA FROM unidad_academico WHERE UA_ID='$ua'");
                $dato_ua = $val_ua->fetch(); unset($val_ua);

                $datos_agenda_reg=[
                    "event"=>'register',
                    "title"=>$title,
                    "description"=>$description,
                    "start"=>$start,
                    "end"=>$end,
                    "sala"=>$sala,
                    "turno"=>$dato_curso['TURNO_CUR'],
                    "grado"=>$dato_curso['GRADO_CUR'],
                    "seccion"=>$dato_curso['SECCION_CUR'],
                    "ua"=>$dato_ua['NOMBRE_UA'],
                    "docente"=>$nombre_d.' '.$apellidoP_d.' '.$apellidoM_d, 
                ];

                $dato_mail=main_model::ejecutar_consulta_simple("SELECT A.CORREO_A FROM cur_alum AS CA, alumno AS A WHERE 
                A.UA_ID='$ua' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$curso' AND YEAR(FECHA_INI_CA)='$anio_academico'");
                $dato_mail = $dato_mail->fetchAll();

                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Evento Guardado",
                    "Texto"=>"Los datos del Evento han sido registrados con exito",
                    "Tipo"=>"success"
                ];   
                
                $send_mail = main_model::send_mail($datos_agenda_reg,$dato_mail);

                if($send_mail!=true){
                    echo $send_mail;
                    exit();
                }
  
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el Evento",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador guardar agenda */
        public function update_agenda_controlador(){
            $title=main_model::limpiar_cadena($_POST['agenda_titulo_reg']);
            $description=main_model::limpiar_cadena($_POST['agenda_descripcion_reg']);
            $curso=main_model::limpiar_cadena($_POST['agenda_curso_reg']);
            $start=main_model::limpiar_cadena($_POST['agenda_start_reg']);
            $end=main_model::limpiar_cadena($_POST['agenda_end_reg']);
            $color=main_model::limpiar_cadena($_POST['agenda_color_reg']);
            $max=main_model::limpiar_cadena($_POST['agenda_max_reg']);
            $agenda_id=main_model::limpiar_cadena($_POST['agenda_id_reg']);
            $sala=main_model::limpiar_cadena($_POST['agenda_sala_reg']);

            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);
            $ua = main_model::limpiar_cadena($_SESSION['ua_id']);

            if($this->getDateTimeYear($start) !== $anio_academico){
                $alerta=[
                    "Tipo"=>"validation",
                    "Input"=>"agenda_start",
                    "InputError"=>"agenda_start_error",
                ];

                echo json_encode($alerta);
                exit();
            }

            if($this->getDateTimeYear($end) !== $anio_academico){
                $alerta=[
                    "Tipo"=>"validation",
                    "Input"=>"agenda_end",
                    "InputError"=>"agenda_end_error",
                ];

                echo json_encode($alerta);
                exit();
            }

            $val_anio=main_model::ejecutar_consulta_simple("SELECT COD_ANIO FROM anio_academico WHERE NOMBRE_ANIO='$anio_academico'");
            $id_anio = $val_anio->fetch(); unset($val_anio);
            $id_anio_a=$id_anio['COD_ANIO'];

            $datos_agenda_up=[
                "Title"=>$title,
                "Description"=>$description,
                "Curso"=>$curso,
                "Start"=>$start,
                "End"=>$end,
                "ID"=>$agenda_id,
                "Color"=>$color,
                "Max"=>$max,
                "DocenteId"=>$id_docente,
                "AnioId"=>$id_anio_a,
            ];

            $val_agenda=main_model::ejecutar_consulta_simple("SELECT * FROM agenda WHERE AGENDA_ID='$agenda_id'");
            $datos_agenda = $val_agenda->fetch(); unset($val_agenda);

            $start = $this->converterDateTime($start);
            $start_db = date($datos_agenda['START_AG']);  

            $end = $this->converterDateTime($end);
            $end_db = date($datos_agenda['END_AG']);  

            if($title !== $datos_agenda['TITULO_AG'] || $description !== $datos_agenda['DESCRIPCION_AG'] || intval($curso) !== $datos_agenda['COD_CUR']
            || $start != $start_db || $end != $end_db ){
                $nombre_d = main_model::limpiar_cadena($_SESSION['nombre_sa']);
                $apellidoP_d = main_model::limpiar_cadena($_SESSION['apellidoP_sa']);
                $apellidoM_d = main_model::limpiar_cadena($_SESSION['apellidoM_sa']);
                
                $val_curso=main_model::ejecutar_consulta_simple("SELECT TURNO_CUR, GRADO_CUR, SECCION_CUR FROM curso WHERE COD_CUR='$curso'");
                $dato_curso = $val_curso->fetch(); unset($val_curso);

                $val_ua=main_model::ejecutar_consulta_simple("SELECT NOMBRE_UA FROM unidad_academico WHERE UA_ID='$ua'");
                $dato_ua = $val_ua->fetch(); unset($val_ua);

                $datos_agenda_reg=[
                    "event"=>'update',
                    "title"=>$title,
                    "description"=>$description,
                    "start"=>$start,
                    "end"=>$end,
                    "sala"=>$sala,
                    "turno"=>$dato_curso['TURNO_CUR'],
                    "grado"=>$dato_curso['GRADO_CUR'],
                    "seccion"=>$dato_curso['SECCION_CUR'],
                    "ua"=>$dato_ua['NOMBRE_UA'],
                    "docente"=>$nombre_d.' '.$apellidoP_d.' '.$apellidoM_d, 
                ];
  
                $dato_mail=main_model::ejecutar_consulta_simple("SELECT A.CORREO_A FROM cur_alum AS CA, alumno AS A WHERE 
                A.UA_ID='$ua' AND CA.ALUMNO_ID=A.ALUMNO_ID AND CA.COD_CUR='$curso' AND YEAR(FECHA_INI_CA)='$anio_academico' GROUP BY A.CORREO_A");

                $dato_mail = $dato_mail->fetchAll();

                $send_mail = main_model::send_mail($datos_agenda_reg,$dato_mail);
                if($send_mail!=true){
                    echo $send_mail;
                    exit();
                }
            }

            $agregar_agenda=modelo_agenda::update_agenda_modelo($datos_agenda_up);

            if($agregar_agenda->rowCount()==1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Evento Guardado",
                    "Texto"=>"Los datos del Evento han sido actualizados con exito",
                    "Tipo"=>"success"
                ];

            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido actualizar el Evento",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador eliminar agenda*/
        public function remove_agenda_controlador(){
            $id=main_model::limpiar_cadena($_POST['agenda_id_del']);
            $eliminar_agenda=modelo_agenda::delete_agenda_modelo($id);

            if($eliminar_agenda->rowCount()==1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Evento eliminado",
                    "Texto"=>"EL Evento ha sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el Evento, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

        /* controlador obtener agenda estudiante*/
        public function datos_conference_controlador($datos){
            $_respuesta = new respuestas;
            if(!isset($datos['sala'])){
                return $_respuesta->error_400();
            }else{
                $sala = $datos['sala'];
                $datos_conference=modelo_agenda::obtener_conferencia_modelo($sala);
                if($datos_conference->rowCount()==1){
                    $datos_conference = $datos_conference->fetch(PDO::FETCH_ASSOC);
                    $nowDate = $this->fecha_hora();
                    if($datos_conference['END_AG'] < $nowDate){
                        $result = $_respuesta->$response;
                        $result["status"] = "ok";
                        $result["result"]= array(
                            "tipo"=>"timeout",
                            "result" => "La sala ha caducado",
                        );
                        return $result;
                    }

                    $result = $_respuesta->$response;
                    $result["status"] = "ok";
                    $result["result"]= array(
                        "tipo"=>"ok",
                        "result" => $datos_conference,
                    );
                    return $result;
                }else{
                    $result = $_respuesta->$response;
                    $result["status"] = "ok";
                    $result["result"]= array(
                        "tipo"=>"error",
                        "result" => "La sala solicitada no existe",
                    );
                    return $result;
                }
            }
        }

        private function sala_agenda($id_docente,$id_curso,$anio,$ua){
            $random = rand(0, 9999);
            $acortar = substr($random, 0, 6); 
            $sala = $id_curso.$acortar.$id_docente.$anio.$ua;
			return $sala;
		}

        private function converterDateTime($date){
            $valores=explode('T', $date);
            return $valores[0].' '.$valores[1].':00';
        }

        private function getDateTimeYear($date){
            $valores=explode('T', $date);
            $part=explode('-', $valores[0]);
            return $part[0];
        }

        public function fecha_hora(){
            $fechaActual=new DateTime();
            $fechaActual->setTimeZone(new DateTimeZone('America/La_Paz'));
            return $fechaActual->format('Y-m-d H:i');
        }
    }