<?php
    require_once "../../modelo/admin/main_model.php";

    /**Modelo agregar docente */
    class modelo_docente extends main_model{

        /* modelo actualizar docente */
        protected static function actualizar_docente_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE profesor SET CI_P=:CI,NOMBRE_P=:Nombre,
            APELLIDOP_P=:ApellidoP,APELLIDOM_P=:ApellidoM,FECHANAC_P=:FechaNac,
            CORREO_P=:Correo,CONTRA_P=:Contra,TELEFONO_P=:Telefono,DIRECCION_P=:Direccion WHERE PROFESOR_ID=:ID");
            
            $sql->bindParam(":CI",$datos['CI']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":FechaNac",$datos['FechaNac']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();
            
            return $sql;
        }

    }