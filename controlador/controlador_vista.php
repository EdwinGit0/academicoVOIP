<?php
    require_once "./modelo/modelo_vista.php";

    class controlador_vista extends modelo_vista{

         /* controlador obtener plantillas */
        public function obtener_plantilla_controlador(){
            return require_once "./vista/plantilla.php";
        }

         /* controlador obtener vistas */
         public function obtener_vista_controlador(){
             if(isset($_GET['views'])){
                $ruta=explode("/", $_GET['views']);
                $respuesta=modelo_vista::obtenerr_vistas_modelo($ruta[0]);
             }else{
                $respuesta="login";
             }
             return $respuesta;
         }
    }