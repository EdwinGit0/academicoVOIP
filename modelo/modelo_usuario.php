<?php
    require_once "main_model.php";

    class modelo_usuario extends main_model{
         /* modelo agregar usuario */
         protected static function agregar_usuario_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO admin(NOMBRE_AD,APELLIDOP_AD,APELLIDOM_AD,TELEFONO_AD,DIRECCION_AD,CORREO_AD,CONTRA_AD,ESTADO,PRIVILEGIO) VALUES(:Nombre,:ApellidoP,:ApellidoM,:Telefono,:Direccion,:Correo,:Contra,:Estado,:Privilegio)");
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->bindParam(":Privilegio",$datos['Privilegio']);
            $sql->execute();

            return$sql;
         }

        /* modelo eliminar usuario */
        protected static function eliminar_usuario_modelo($id){
            $sql=main_model::conectar()->prepare("DELETE FROM admin WHERE ADMIN_ID=:ID");

            $sql->bindParam(":ID",$id);
            $sql->execute();

            return $sql;
        }

        /* modelo datos usuario */
        protected static function datos_usuario_modelo($tipo,$id){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT * FROM admin WHERE ADMIN_ID=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT ADMIN_ID FROM admin WHERE ADMIN_ID!='1'");
                $sql->bindParam(":ID",$id);
            }
            $sql->execute();
            return $sql;
        }

        /* modelo actualizar usuario */
        protected static function actualizar_usuario_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE admin SET  NOMBRE_AD=:Nombre,APELLIDOP_AD=:ApellidoP,APELLIDOM_AD=:ApellidoM,TELEFONO_AD=:Telefono,DIRECCION_AD=:Direccion,CORREO_AD=:Correo,CONTRA_AD=:Contra,ESTADO=:Estado,PRIVILEGIO=:Privilegio WHERE ADMIN_ID=:ID");
            
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":ApellidoP",$datos['ApellidoP']);
            $sql->bindParam(":ApellidoM",$datos['ApellidoM']);
            $sql->bindParam(":Telefono",$datos['Telefono']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":Correo",$datos['Correo']);
            $sql->bindParam(":Contra",$datos['Contra']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->bindParam(":Privilegio",$datos['Privilegio']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();
            
            return $sql;
        }
    }