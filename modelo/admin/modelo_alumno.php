<?php
    require_once "main_model.php";

    class modelo_alumno extends main_model{
        /**Modelo agregar alumno */
        protected static function agregar_alumno_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO alumno(RUDE_A,UA_ID,CI_A,NOMBRE_A,APELLIDOP_A,APELLIDOM_A,FECHANAC_A,SEXO_A,LUGARNAC_A,CORREO_A,CONTRA_A,TELEFONO_A,DIRECCION_A,ESTADO_A) 
            VALUES(:Rude,:CodUE,:CI,:Nombre,:ApellidoP,:ApellidoM,:FechaNac,:Sexo,:LugarNac,:Correo,:Contra,:Telefono,:Direccion,:Estado)");
            
            $sql->bindParam(":Rude",$datos['Rude']);
            $sql->bindParam(":CodUE",$datos['CodUE']);
            $sql->bindParam(":CI",$datos['CI']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":FechaNac",$datos['FechaNac']);
            $sql->bindParam(":Sexo",$datos['Sexo']);
            $sql->bindParam(":LugarNac",$datos['LugarNac']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->execute();

            return$sql;
        }

        /**Modelo agregar tutor alumno */
        protected static function agregar_tutor_alumno_modelo($id_alumno,$id_tutor){
            $sql=main_model::conectar()->prepare("INSERT INTO fa_alumno(FAMILAR_ID,ALUMNO_ID) 
            VALUES(:IdFamilia,:IdAlumno)");
            $sql->bindParam(":IdFamilia",$id_tutor);
            $sql->bindParam(":IdAlumno",$id_alumno);
            $sql->execute();

            return$sql;
        }

        /**Modelo agregar educativo alumno */
        protected static function agregar_educativo_alumno_modelo($datos,$id){
            $sql=main_model::conectar()->prepare("UPDATE alumno SET UA_ID=:CodUA WHERE ALUMNO_ID=:ID");
            
            $sql->bindParam(":CodUA",$datos['ID']);
            $sql->bindParam(":ID",$id);
            $sql->execute();
            
            return $sql;
        }

        /* modelo eliminar alumno */
        protected static function eliminar_alumno_modelo($tipo,$id){
            if($tipo=="del_alumno"){
                $sql=main_model::conectar()->prepare("DELETE FROM fa_alumno WHERE ALUMNO_ID IN (SELECT ALUMNO_ID FROM alumno WHERE ALUMNO_ID=:ID)");
                $sql->bindParam(":ID",$id);
                $sql->execute();
    
                $sql=main_model::conectar()->prepare("DELETE FROM alumno WHERE ALUMNO_ID=:ID");
                $sql->bindParam(":ID",$id);
                $sql->execute();
            }elseif($tipo=="del_relacion"){
                $sql=main_model::conectar()->prepare("DELETE FROM fa_alumno WHERE ALUMNO_ID IN (SELECT ALUMNO_ID FROM alumno WHERE ALUMNO_ID=:ID)");
                $sql->bindParam(":ID",$id);
                $sql->execute();
            }
            return $sql;
        }

        /* modelo datos alumno */
        protected static function datos_alumno_modelo($tipo,$id,$ue){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT A.*, UA.NOMBRE_UA FROM alumno AS A, unidad_academico AS UA WHERE A.ALUMNO_ID = :ID AND A.UA_ID = UA.UA_ID ");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT ALUMNO_ID FROM alumno WHERE UA_ID='$ue'");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Padre"){
                $sql=main_model::conectar()->prepare("SELECT F.* FROM fa_alumno AS FA, familiar AS F WHERE FA.FAMILAR_ID=F.FAMILAR_ID AND FA.ALUMNO_ID=:ID ");
                $sql->bindParam(":ID",$id);
            }
            $sql->execute();
            return $sql;
        }

        /* modelo actualizar alumno */
        protected static function actualizar_alumno_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE alumno SET  UA_ID=:IdE,CI_A=:CI,NOMBRE_A=:Nombre,
            APELLIDOP_A=:ApellidoP,APELLIDOM_A=:ApellidoM,FECHANAC_A=:FechaNac,SEXO_A=:Sexo,LUGARNAC_A=:LugarNac,
            CORREO_A=:Correo,CONTRA_A=:Contra,TELEFONO_A=:Telefono,DIRECCION_A=:Direccion,ESTADO_A=:Estado WHERE ALUMNO_ID=:ID");
            
            $sql->bindParam(":CI",$datos['CI']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":FechaNac",$datos['FechaNac']);
            $sql->bindParam(":Sexo",$datos['Sexo']);
            $sql->bindParam(":LugarNac",$datos['LugarNac']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->bindParam(":IdE",$datos['IdE']);
            $sql->execute();
            
            return $sql;
        }
    }