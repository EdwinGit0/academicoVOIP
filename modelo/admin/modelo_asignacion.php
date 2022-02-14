<?php
    require_once "main_model.php";

    class modelo_asignacion extends main_model{

        /**------------------------------ ASIGNAR ALUMNO A CURSO -------------------------------------- */
        /**Modelo agregar alumno */
        protected static function agregar_alumno_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO cur_alum(COD_CUR,ALUMNO_ID,FECHA_INI_CA,FECHA_FIN_CA) 
            VALUES(:IdCurso,:IdAlumno,:FechaIni,:FechaFin)");

            $sql->bindParam(":IdAlumno",$datos['IdAlumno']);
            $sql->bindParam(":IdCurso",$datos['IdCurso']);
            $sql->bindParam(":FechaFin",$datos['FechaFin']);
            $sql->bindParam(":FechaIni",$datos['FechaIni']);

            $sql->execute();

            return $sql;
        }

        /* modelo eliminar alumno de curso */
        protected static function eliminar_alumno_modelo($id_alumno,$id_curso){
            $sql=main_model::conectar()->prepare("DELETE FROM cur_alum WHERE COD_CUR=:IdCurso AND ALUMNO_ID=:IdAlumno");
            $sql->bindParam(":IdAlumno",$id_alumno);
            $sql->bindParam(":IdCurso",$id_curso);
            $sql->execute();

            return $sql;
        }

         /**------------------------------ ASIGNAR DOCENTE A CURSO -------------------------------------- */
        /**Modelo agregar docente */
        protected static function agregar_docente_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO cur_prof(COD_CUR,PROFESOR_ID,RESPONSABLE_CP,FECHA_INI_CP,FECHA_FIN_CP) 
            VALUES(:IdCurso,:IdDocente,:Responsable,:FechaIni,:FechaFin)");

            $sql->bindParam(":IdDocente",$datos['IdDocente']);
            $sql->bindParam(":IdCurso",$datos['IdCurso']);
            $sql->bindParam(":Responsable",$datos['Responsable']);
            $sql->bindParam(":FechaFin",$datos['FechaFin']);
            $sql->bindParam(":FechaIni",$datos['FechaIni']);

            $sql->execute();

            return $sql;
        }

        /* modelo eliminar docente de curso */
        protected static function eliminar_docente_modelo($id_docente,$id_curso){
            $sql=main_model::conectar()->prepare("DELETE FROM cur_prof WHERE COD_CUR=:IdCurso AND PROFESOR_ID=:IdDocente");
            $sql->bindParam(":IdDocente",$id_docente);
            $sql->bindParam(":IdCurso",$id_curso);
            $sql->execute();

            return $sql;
        }
    }