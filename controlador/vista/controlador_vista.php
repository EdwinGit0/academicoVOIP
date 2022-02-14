<?php
    require_once "./modelo/vista/modelo_vista.php";

    class controlador_vista extends modelo_vista{

         /* controlador obtener plantillas */
        public function obtener_plantilla_controlador(){
            return require_once "./vista/contenido/plantilla.php";
        }

         /* controlador obtener vistas */
         public function obtener_vista_controlador(){
             if(isset($_GET['views'])){
                $ruta=explode("/", $_GET['views']);
                if($ruta[0]=="admin" && !empty($ruta[1])){
                    $respuesta=modelo_vista::obtener_vistas_admin_modelo($ruta[1]);
                }elseif($ruta[0]=="docente"  && !empty($ruta[1])){
                    $respuesta=modelo_vista::obtener_vistas_docente_modelo($ruta[1]);
                }elseif($ruta[0]=="alumno"  && !empty($ruta[1])){
                    $respuesta=modelo_vista::obtener_vistas_alumno_modelo($ruta[1]);
                }elseif($ruta[0]=="login"){
                    return $ruta[0];
                }else{
                    return "login";
            }
               
             }else{
                $respuesta="login";
             }
             return $respuesta;
         }
    }