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

            $sql->bindParam(":Alumno_id",$datos['Alumno_id']);
            $sql->bindParam(":Periodo_id",$datos['Periodo_id']);
            $sql->bindParam(":Docente_id",$datos['Docente_id']);
            $sql->bindParam(":Curso_id",$datos['Curso_id']);
            $sql->bindParam(":Anio_id",$datos['Anio_id']);
            $sql->bindParam(":Val_id",$datos['Val_id']);
            $sql->bindParam(":Nota_id",$datos['Nota_id']);
           
            $sql->execute();

            return$sql;
        }

        protected static function update_cuadernoP_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE calificacion SET NOTA=:Nota_id WHERE ALUMNO_ID=:Alumno_id AND COD_PER=:Periodo_id AND PROFESOR_ID=:Docente_id AND 
            COD_CUR=:Curso_id AND COD_ANIO=:Anio_id AND VAL_ID=:Val_id");

            $sql->bindParam(":Alumno_id",$datos['Alumno_id']);
            $sql->bindParam(":Periodo_id",$datos['Periodo_id']);
            $sql->bindParam(":Docente_id",$datos['Docente_id']);
            $sql->bindParam(":Curso_id",$datos['Curso_id']);
            $sql->bindParam(":Anio_id",$datos['Anio_id']);
            $sql->bindParam(":Val_id",$datos['Val_id']);
            $sql->bindParam(":Nota_id",$datos['Nota_id']);
           
            $sql->execute();

            return$sql;
        }
    }