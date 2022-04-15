<?php
    if($peticionAjax){
        require_once "../../modelo/admin/main_model.php";
    }else{
        require_once "./modelo/admin/main_model.php";
    }

    class modelo_cuadernoP extends main_model{

        /* modelo agregar cuadernoP */
        protected static function agregar_cuadernoP_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO calificacion(ALUMNO_ID,COD_PER,PROFESOR_ID,COD_CUR,COD_ANIO,VAL_ID,NOTA) 
            VALUES(:Alumno_id,:Periodo_id,:Docente_id,:Curso_id,:Anio_id,:Val_id,:Nota_id)");

            foreach ($datos as $value) {
                $sql->bindParam(":Alumno_id",$value['Alumno_id']);
                $sql->bindParam(":Periodo_id",$value['Periodo_id']);
                $sql->bindParam(":Docente_id",$value['Docente_id']);
                $sql->bindParam(":Curso_id",$value['Curso_id']);
                $sql->bindParam(":Anio_id",$value['Anio_id']);
                $sql->bindParam(":Val_id",$value['Val_id']);
                $sql->bindParam(":Nota_id",$value['Nota_id']);

                $sql->execute();
            }
            return$sql;
        }

        protected static function update_cuadernoP_modelo($datos){

            $sql=main_model::conectar()->prepare("INSERT INTO calificacion(ALUMNO_ID,COD_PER,PROFESOR_ID,COD_CUR,COD_ANIO,VAL_ID,NOTA) 
            VALUES(:Alumno_id,:Periodo_id,:Docente_id,:Curso_id,:Anio_id,:Val_id,:Nota_id) ON DUPLICATE KEY UPDATE NOTA=:Nota_id");

            foreach ($datos as $value) {
                $sql->bindParam(":Alumno_id",$value['Alumno_id']);
                $sql->bindParam(":Periodo_id",$value['Periodo_id']);
                $sql->bindParam(":Docente_id",$value['Docente_id']);
                $sql->bindParam(":Curso_id",$value['Curso_id']);
                $sql->bindParam(":Anio_id",$value['Anio_id']);
                $sql->bindParam(":Val_id",$value['Val_id']);
                $sql->bindParam(":Nota_id",$value['Nota_id']);

                $sql->execute();
            }

            return$sql;
        }
    }