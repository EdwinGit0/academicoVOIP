<?php
    require_once "main_model.php";

    class modelo_seccion extends main_model{

        /**Modelo agregar seccion */
        protected static function agregar_seccion_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO seccion(NOMBRE_SEC,CAPACIDAD_SEC,CREADO_SEC) 
            VALUES(:Nombre,:Capacidad,:Creado)");
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":Capacidad",$datos['Capacidad']);
            $sql->bindParam(":Creado",$datos['Creado']);
            $sql->execute();

            return $sql;
        }

        /**Modelo eli8minar seccion */
        protected static function eliminar_seccion_modelo($id){
            $sql=main_model::conectar()->prepare("DELETE FROM seccion WHERE COD_SEC=:ID");   
            $sql->bindParam(":ID",$id);
            $sql->execute();
            
            return $sql;
        }

        /**Modelo datos seccion */
        protected static function datos_seccion_modelo($tipo,$id){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT * FROM seccion WHERE COD_SEC=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT COD_SEC FROM seccion");
            }
            $sql->execute();

            return $sql;
        }

        /* modelo actualizar seccion */
        protected static function actualizar_seccion_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE seccion SET NOMBRE_SEC=:Nombre,
            CAPACIDAD_SEC=:Capacidad WHERE COD_SEC=:ID");
            
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":Capacidad",$datos['Capacidad']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();
            
            return $sql;
        }

    }