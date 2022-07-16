<?php
    class modelo_vista{
        /* Modelo para obteer vistas */
        protected static function obtener_vistas_admin_modelo($vista){
            $listaBlanca=["home","alumno-list","alumno-new","alumno-update","padre-list","padre-new","padre-update",
            "docente-list","docente-new","docente-search","docente-update","company","user-list","user-new","user-search",
            "user-update","curso-list","curso-new","curso-update","periodo-list","periodo-new","periodo-update",
            "area-list","area-new","area-update","anio-list","anio-new","anio-update","curso-asignacion"];
            if(in_array($vista, $listaBlanca)){
                if(is_file("./vista/contenido/admin/pages/".$vista."-view.php")){
                    $contenido="./vista/contenido/admin/pages/".$vista."-view.php";
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

        protected static function obtener_vistas_docente_modelo($vista){
            $listaBlanca=["home","pedagogico-cuaderno","alumno-libreta","pedagogico-registro","user-update","calendar",
            "gestion-academico"];
            if(in_array($vista, $listaBlanca)){
                if(is_file("./vista/contenido/docente/pages/".$vista."-view.php")){
                    $contenido="./vista/contenido/docente/pages/".$vista."-view.php";
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