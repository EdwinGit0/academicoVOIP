<?php
    require_once "main_model.php";

    /**Modelo agregar alumno */
    class modelo_educativo extends main_model{
        
        /**Modelo datos educativo */
        protected static function datos_educativo_modelo($id){
            $sql=main_model::conectar()->prepare("SELECT DISTINCT UA.*  FROM admin AS AD, unidad_academico AS UA WHERE AD.ADMIN_ID='$id' AND UA.UA_ID=AD.UA_ID");
            $sql->execute();

            return $sql;
        }

        /**Modelo datos educativo alumno*/
        protected static function datos_educativo_alumno_modelo($id){
            $sql=main_model::conectar()->prepare("SELECT * FROM unidad_academico WHERE UA_ID='$id'");
            $sql->execute();

            return $sql;
        }

        /**Modelo registrar educativo */
        protected static function agregar_educativo_modelo($datos,$id){
            $sql=main_model::conectar()->prepare("INSERT INTO unidad_academico(COD_UA,NOMBRE_UA,
            DIRECCION_UA,DESCRIPCION_UA,DISTRITO_UA,LOCALIDAD_UA,DPTO_UA,DEPENDENCIA_UA,ESTADO_UA) 
            VALUES(:Codigo,:Nombre,:Direccion,:Descripcion,:Distrito,:Localidad,:Dpto,:Dependencia,:Estado)");
            $sql->bindParam(":Codigo",$datos['Codigo']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":Descripcion",$datos['Descripcion']);
            $sql->bindParam(":Dependencia",$datos['Dependencia']);
            $sql->bindParam(":Dpto",$datos['Dpto']);
            $sql->bindParam(":Localidad",$datos['Localidad']);
            $sql->bindParam(":Distrito",$datos['Distrito']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->execute();

            $check_unidad=main_model::ejecutar_consulta_simple("SELECT MAX(UA_ID) AS id FROM unidad_academico");
            $campos=$check_unidad->fetch();
            $ID_UA=$campos['id'];
            
            $agregar_educativo=main_model::conectar()->prepare("UPDATE admin SET UA_ID='$ID_UA' WHERE ADMIN_ID='$id'");
            $agregar_educativo->execute();

            return $sql;
        } 

        /**Modelo registrar educativo admin */
        protected static function agregar_educativo_admin_modelo($datos,$id){     
            $sql=main_model::conectar()->prepare("UPDATE admin SET UA_ID=:ID WHERE ADMIN_ID='$id'");
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();

            return $sql;
        } 

        /**Modelo actualizar educativo */
        protected static function actualizar_educativo_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE unidad_academico SET COD_UA=:Codigo,
            NOMBRE_UA=:Nombre,DIRECCION_UA=:Direccion,DESCRIPCION_UA=:Descripcion,
            DISTRITO_UA=:Distrito,LOCALIDAD_UA=:Localidad,DPTO_UA=:Dpto,DEPENDENCIA_UA=:Dependencia,ESTADO_UA=:Estado
            WHERE UA_ID=:ID");
            $sql->bindParam(":Codigo",$datos['Codigo']);
            $sql->bindParam(":Nombre",$datos['Nombre']);
            $sql->bindParam(":Direccion",$datos['Direccion']);
            $sql->bindParam(":Descripcion",$datos['Descripcion']);
            $sql->bindParam(":Dependencia",$datos['Dependencia']);
            $sql->bindParam(":Dpto",$datos['Dpto']);
            $sql->bindParam(":Localidad",$datos['Localidad']);
            $sql->bindParam(":Distrito",$datos['Distrito']);
            $sql->bindParam(":Estado",$datos['Estado']);
            $sql->bindParam(":ID",$datos['ID']);
            $sql->execute();

            return $sql;
        }
    }