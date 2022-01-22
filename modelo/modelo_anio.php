<?php
    require_once "main_model.php";

    class modelo_anio extends main_model{

        /**Modelo agregar anio */
        protected static function agregar_anio_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO anio_academico(NOMBRE_ANIO,CREADO) 
            VALUES(:Nombre,:Creado)");
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":Creado",$datos['Creado']);
            $sql->execute();

            return $sql;
        }

        /**Modelo eli8minar anio */
        protected static function eliminar_anio_modelo($id){
            $sql=main_model::conectar()->prepare("DELETE FROM anio_academico WHERE COD_ANIO=:ID");   
            $sql->bindParam(":ID",$id);
            $sql->execute();
            
            return $sql;
        }

        /**Modelo datos anio */
        protected static function datos_anio_modelo($tipo,$id){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT * FROM anio_academico WHERE COD_ANIO=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT COD_ANIO FROM anio_academico");
            }
            $sql->execute();

            return $sql;
        }

        /* modelo actualizar anio */
        protected static function actualizar_anio_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE anio_academico SET NOMBRE_ANIO=:Nombre WHERE COD_ANIO=:ID");
            
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();
            
            return $sql;
        }

    }