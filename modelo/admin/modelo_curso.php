<?php
    require_once "main_model.php";

    class modelo_curso extends main_model{

        /**Modelo agregar curso */
        protected static function agregar_curso_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO curso(TURNO_CUR,GRADO_CUR,SECCION_CUR,CAPACIDAD_CUR,CREADO_CUR) 
            VALUES(:Turno,:Grado,:Seccion,:Capacidad,:Creado)");
            $sql->bindParam(":Turno",$datos['Turno']);
            $sql->bindParam(":Grado",$datos['Grado']);
            $sql->bindParam(":Seccion",$datos['Seccion']);
            $sql->bindParam(":Capacidad",$datos['Capacidad']);
            $sql->bindParam(":Creado",$datos['Creado']);
            $sql->execute();

            return $sql;
        }

        /**Modelo eli8minar curso */
        protected static function eliminar_curso_modelo($id){
            $sql=main_model::conectar()->prepare("DELETE FROM curso WHERE COD_CUR=:ID");   
            $sql->bindParam(":ID",$id);
            $sql->execute();
            
            return $sql;
        }

        /**Modelo datos curso */
        protected static function datos_curso_modelo($tipo,$id){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT * FROM curso WHERE COD_CUR=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT COD_CUR FROM curso");
            }
            $sql->execute();

            return $sql;
        }

        /* modelo actualizar curso */
        protected static function actualizar_curso_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE curso SET TURNO_CUR=:Turno,GRADO_CUR=:Grado,
            SECCION_CUR=:Seccion,CAPACIDAD_CUR=:Capacidad WHERE COD_CUR=:ID");
            
            $sql->bindParam(":Turno",$datos['Turno']);
            $sql->bindParam(":Grado",$datos['Grado']);
            $sql->bindParam(":Seccion",$datos['Seccion']);
            $sql->bindParam(":Capacidad",$datos['Capacidad']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();
            
            return $sql;
        }

    }