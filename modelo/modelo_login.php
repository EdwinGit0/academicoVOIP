<?php
    require_once "main_model.php";

    class modelo_login extends main_model{
        /* Modelo iniciar sesion */
        protected static function iniciar_sesion_modelo($datos){
            $sql=main_model::conectar()->prepare("SELECT * FROM admin WHERE CORREO_AD=:Correo AND CONTRA_AD=:Clave AND ESTADO=1");
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Clave",$datos['Clave']);
            $sql->execute();
            return $sql;
        }
    }