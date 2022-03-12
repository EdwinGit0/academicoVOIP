<?php
    require_once "main_model.php";

    /**Modelo agregar docente */
    class modelo_docente extends main_model{
        protected static function agregar_docente_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO profesor(COD_AREA,UA_ID,CI_P,NOMBRE_P,APELLIDOP_P,APELLIDOM_P,FECHANAC_P,SEXO_P,FECHA_INGRESO_P,CORREO_P,CONTRA_P,TELEFONO_P,DIRECCION_P,ESTADO_P) 
            VALUES(:CodA,:Ua,:CI,:Nombre,:ApellidoP,:ApellidoM,:FechaNac,:Sexo,:FechaIng,:Correo,:Contra,:Telefono,:Direccion,:Estado)");
            $sql->bindParam(":CodA",$datos['CodA']);
            $sql->bindParam(":Ua",$datos['Ua']);
            $sql->bindParam(":CI",$datos['CI']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":FechaNac",$datos['FechaNac']);
            $sql->bindParam(":Sexo",$datos['Sexo']);
            $sql->bindParam(":FechaIng",$datos['FechaIng']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->execute();

            return$sql;
        }

        /* modelo eliminar docente */
        protected static function eliminar_docente_modelo($id){
            $sql=main_model::conectar()->prepare("DELETE FROM profesor WHERE PROFESOR_ID=:ID");

            $sql->bindParam(":ID",$id);
            $sql->execute();

            return $sql;
        }

        /* modelo datos docente */
        protected static function datos_docente_modelo($tipo,$id,$ue){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT P.*, A.NOMBRE_AREA, UA.NOMBRE_UA FROM profesor AS P, area AS A, unidad_academico AS UA
                WHERE A.COD_AREA=P.COD_AREA AND UA.UA_ID=P.UA_ID AND PROFESOR_ID=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT PROFESOR_ID FROM profesor WHERE UA_ID='$ue'");
            }
            $sql->execute();
            return $sql;
        }

        /* modelo actualizar docente */
        protected static function actualizar_docente_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE profesor SET COD_AREA=:IdA,UA_ID=:IdE,CI_P=:CI,NOMBRE_P=:Nombre,
            APELLIDOP_P=:ApellidoP,APELLIDOM_P=:ApellidoM,FECHANAC_P=:FechaNac,SEXO_P=:Sexo,FECHA_INGRESO_P=:FechaIng,
            CORREO_P=:Correo,CONTRA_P=:Contra,TELEFONO_P=:Telefono,DIRECCION_P=:Direccion,ESTADO_P=:Estado WHERE PROFESOR_ID=:ID");
            
            $sql->bindParam(":CI",$datos['CI']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":FechaNac",$datos['FechaNac']);
            $sql->bindParam(":Sexo",$datos['Sexo']);
            $sql->bindParam(":FechaIng",$datos['FechaIng']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->bindParam(":IdA",$datos['IdA']);
            $sql->bindParam(":IdE",$datos['IdE']);
            $sql->execute();
            
            return $sql;
        }

    }