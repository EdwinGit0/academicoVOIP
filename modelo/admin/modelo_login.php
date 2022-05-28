<?php
    require_once "main_model.php";

    class modelo_login extends main_model{
        /* Modelo iniciar sesion para admin */
        protected static function iniciar_sesion_admin_modelo($datos){
            $sql=main_model::conectar()->prepare("SELECT * FROM admin WHERE CORREO_AD=:Correo AND CONTRA_AD=:Clave AND ESTADO=1");
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Clave",$datos['Clave']);
            $sql->execute();
            return $sql;
        }

        /* Modelo iniciar sesion para docente */
        protected static function iniciar_sesion_docente_modelo($datos){
            $sql=main_model::conectar()->prepare("SELECT * FROM profesor WHERE CORREO_P=:Correo AND CONTRA_P=:Clave AND ESTADO_P=1");
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Clave",$datos['Clave']);
            $sql->execute();
            return $sql;
        }

        /* Modelo iniciar sesion para alumno */
        protected static function iniciar_sesion_alumno_modelo($datos){
            $sql=main_model::conectar()->prepare("SELECT * FROM alumno WHERE TELEFONO_A=:phone AND CONTRA_A=:clave AND ESTADO_A=1");
            $sql->bindParam(":phone",$datos['phone']);
            $sql->bindParam(":clave",$datos['clave']);
            $sql->execute();
            return $sql;
        }

        /* Modelo iniciar sesion para tutor */
        protected static function iniciar_sesion_tutor_modelo($datos){
            $sql=main_model::conectar()->prepare("SELECT * FROM familiar WHERE TELEFONO_FA=:phone AND CONTRA_FA=:clave AND ESTADO_FA=1");
            $sql->bindParam(":phone",$datos['phone']);
            $sql->bindParam(":clave",$datos['clave']);
            $sql->execute();
            return $sql;
        }
    }