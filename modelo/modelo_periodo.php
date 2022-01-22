<?php
    require_once "main_model.php";

    class modelo_periodo extends main_model{

        /**Modelo agregar periodo */
        protected static function agregar_periodo_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO periodo(NOMBRE_PER,CREADO_PER) 
            VALUES(:Nombre,:Creado)");
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":Creado",$datos['Creado']);
            $sql->execute();

            return $sql;
        }

        /**Modelo eli8minar periodo */
        protected static function eliminar_periodo_modelo($id){
            $sql=main_model::conectar()->prepare("DELETE FROM periodo WHERE COD_PER=:ID");   
            $sql->bindParam(":ID",$id);
            $sql->execute();
            
            return $sql;
        }

        /**Modelo datos periodo */
        protected static function datos_periodo_modelo($tipo,$id){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT * FROM periodo WHERE COD_PER=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT COD_PER FROM periodo");
            }
            $sql->execute();

            return $sql;
        }

        /* modelo actualizar periodo */
        protected static function actualizar_periodo_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE periodo SET NOMBRE_PER=:Nombre WHERE COD_PER=:ID");
            
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();
            
            return $sql;
        }

    }