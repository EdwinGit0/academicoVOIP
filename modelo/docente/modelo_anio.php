<?php
   if($peticionAjax){
        require_once "../../modelo/admin/main_model.php";
    }else{
        require_once "./modelo/admin/main_model.php";
    }
    
    class modelo_anio extends main_model{

        /**Modelo datos anio */
        protected static function datos_anio_modelo($tipo,$id){
            if($tipo=="Unico"){
                $sql=main_model::conectar()->prepare("SELECT * FROM anio_academico WHERE COD_ANIO=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Conteo"){
                $sql=main_model::conectar()->prepare("SELECT COD_ANIO FROM anio_academico");
            }elseif($tipo=="Todo"){
                $sql=main_model::conectar()->prepare("SELECT * FROM anio_academico");
            }
            $sql->execute();

            return $sql;
        }

    }