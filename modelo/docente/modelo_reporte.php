<?php
    require_once "../modelo/docente/main_model.php";

    class modelo_reporte extends main_model{
        /**Modelo datos periodo */
        protected static function datos_periodo_modelo(){
            $sql=main_model::conectar()->prepare("SELECT * FROM periodo");
            $sql->execute();

            return $sql;
        }
    }