<?php
    if($peticionAjax){
        require_once "../../modelo/docente/modelo_agenda.php";
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
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Evento Guardado",
                    "Texto"=>"Los datos del Evento han sido registrados con exito",
                    "Tipo"=>"success"
                ];   
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

            session_start(['name'=>'SA']);
            $anio_academico = main_model::limpiar_cadena($_SESSION['anio_academico']);
            $id_docente = main_model::limpiar_cadena($_SESSION['id_sa']);

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

            $agregar_agenda=modelo_agenda::update_agenda_modelo($datos_agenda_up);

            if($agregar_agenda->rowCount()==1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Evento Guardado",
                    "Texto"=>"Los datos del Evento han sido actualizados con exito",
                    "Tipo"=>"success"
                ];
                $this->send_mail();
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

        private function sala_agenda($id_docente,$id_curso,$anio,$ua){
            $random = rand(0, 9999);
            $acortar = substr($random, 0, 6); 
            $sala = $id_curso.$acortar.$id_docente.$anio.$ua;
			return $sala;
		}

        private function send_mail($para,$titulo,$mensaje,$cabecera){
            $para      = 'edwin.roquecd@gmail.com';
            $titulo    = 'El título';
            $mensaje   = 'Hola';
            $cabeceras = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/';
            mail($para, $titulo, $mensaje, $cabeceras);
        }
    }