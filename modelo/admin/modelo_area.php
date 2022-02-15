<?php
    require_once "main_model.php";

    class modelo_area extends main_model{

        /**Modelo agregar area */
        protected static function agregar_area_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO area(NOMBRE_AREA,INFO,CREADO_AREA) 
            VALUES(:Nombre,:Info,:Creado)");
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":Info",$datos['Info']);
            $sql->bindParam(":Creado",$datos['Creado']);
            $sql->execute();

            return $sql;
        }

        /**Modelo eli8minar area */
        protected static function eliminar_area_modelo($id){
            $sql=main_model::conectar()->prepare("DELETE FROM area WHERE COD_AREA=:ID");   
            $sql->bindParam(":ID",$id);
            $sql->execute();
            
            return $sql;
        }

        /**Modelo datos area */
        protected static function datos_area_modelo($tipo,$id){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT * FROM area WHERE COD_AREA=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT COD_AREA FROM area");
            }
            $sql->execute();

            return $sql;
        }

        /* modelo actualizar area */
        protected static function actualizar_area_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE area SET NOMBRE_AREA=:Nombre,
            INFO=:Info WHERE COD_AREA=:ID");
            
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":Info",$datos['Info']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();
            
            return $sql;
        }

    }