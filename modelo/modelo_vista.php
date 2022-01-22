<?php
    class modelo_vista{
        /* Modelo para obteer vistas */
        protected static function obtenerr_vistas_modelo($vista){
            $listaBlanca=["home","alumno-list","alumno-new","alumno-update","padre-list","padre-new","padre-update",
            "docente-list","docente-new","docente-search","docente-update","company","item-list",
            "item-new","item-search","item-update","reservation-list","reservation-new","reservation-pending",
            "reservation-search","reservation-update","user-list","reservation-reservation","user-new","user-search",
            "user-update","curso-list","curso-new","curso-update","periodo-list","periodo-new","periodo-update",
            "area-list","area-new","area-update","anio-list","anio-new","anio-update"];
            if(in_array($vista, $listaBlanca)){
                if(is_file("./vista/contenido/".$vista."-view.php")){
                    $contenido="./vista/contenido/".$vista."-view.php";
                }else{
                    $contenido="404";
                }
            }elseif($vista=="login" || $vista=="index"){
                $contenido="login";
            }else{
                $contenido="404";
            }
            return $contenido;
        }
    }