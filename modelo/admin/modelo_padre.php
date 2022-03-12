<?php
    require_once "main_model.php";

    class modelo_padre extends main_model{
        /**Modelo agregar padre */
        protected static function agregar_padre_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO familiar(CI_FA,NOMBRE_FA,APELLIDOP_FA,
            APELLIDOM_FA,FECHANAC_FA,SEXO_FA,TELEFONO_FA,CORREO_FA,CONTRA_FA,ROL_FA,ESTADO_FA) 
            VALUES(:CI,:Nombre,:ApellidoP,:ApellidoM,:FechaNac,:Sexo,:Telefono,:Correo,:Contra,:Rol,
            :Estado)");

            $sql->bindParam(":CI",$datos['CI']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":FechaNac",$datos['FechaNac']);
            $sql->bindParam(":Sexo",$datos['Sexo']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Rol",$datos['Rol']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->execute();

            return$sql;
        }

        /**Modelo agregar alumno tutor */
        protected static function agregar_tutor_alumno_modelo($id_tutor,$id_alumno){
            $sql=main_model::conectar()->prepare("INSERT INTO fa_alumno(FAMILAR_ID,ALUMNO_ID) 
            VALUES(:IdFamilia,:IdAlumno)");
            $sql->bindParam(":IdFamilia",$id_tutor);
            $sql->bindParam(":IdAlumno",$id_alumno);
            $sql->execute();

            return$sql;
        }

        /* modelo eliminar padre */
        protected static function eliminar_padre_modelo($tipo,$id){
            if($tipo=="del_padre"){
                $sql=main_model::conectar()->prepare("DELETE FROM fa_alumno WHERE FAMILAR_ID IN (SELECT FAMILAR_ID FROM familiar WHERE FAMILAR_ID=:ID)");
                $sql->bindParam(":ID",$id);
                $sql->execute();

                $sql=main_model::conectar()->prepare("DELETE FROM familiar WHERE FAMILAR_ID=:ID");
                $sql->bindParam(":ID",$id);
                $sql->execute();
            }elseif($tipo=="del_relacion"){
                $sql=main_model::conectar()->prepare("DELETE FROM fa_alumno WHERE FAMILAR_ID IN (SELECT FAMILAR_ID FROM familiar WHERE FAMILAR_ID=:ID)");
                $sql->bindParam(":ID",$id);
                $sql->execute();
            }
        
            return $sql;
        }

        /* modelo datos padre */
        protected static function datos_padre_modelo($tipo,$id,$ue){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT * FROM familiar WHERE FAMILAR_ID=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT F.FAMILAR_ID FROM familiar AS F, alumno AS A, fa_alumno AS FA WHERE 
                FA.ALUMNO_ID=A.ALUMNO_ID AND FA.FAMILAR_ID=F.FAMILAR_ID AND A.UA_ID='$ue' GROUP BY F.FAMILAR_ID");
            }elseif($tipo=="Alumno"){
                $sql=main_model::conectar()->prepare("SELECT A.* FROM fa_alumno AS FA, alumno AS A WHERE FA.ALUMNO_ID=A.ALUMNO_ID AND FA.FAMILAR_ID=:ID ");
                $sql->bindParam(":ID",$id);
            }
            $sql->execute();
            return $sql;
        }

        /* modelo actualizar padre */
        protected static function actualizar_padre_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE familiar SET  CI_FA=:CI,NOMBRE_FA=:Nombre,
            APELLIDOP_FA=:ApellidoP,APELLIDOM_FA=:ApellidoM,FECHANAC_FA=:FechaNac,SEXO_FA=:Sexo,
            CORREO_FA=:Correo,CONTRA_FA=:Contra,TELEFONO_FA=:Telefono,ROL_FA=:Rol,ESTADO_FA=:Estado WHERE FAMILAR_ID=:ID");
            
            $sql->bindParam(":CI",$datos['CI']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":FechaNac",$datos['FechaNac']);
            $sql->bindParam(":Sexo",$datos['Sexo']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Rol",$datos['Rol']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();
            
            return $sql;
        }
    }