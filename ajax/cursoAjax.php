<?php
    $peticionAjax=true;
    require_once "../config/APP.php";

    if(isset($_POST['curso_grado_reg']) || isset($_POST['curso_id_up']) || isset($_POST['curso_id_del'])){

        /* Instancia al controlador */
        require_once "../controlador/controlador_curso.php";
        $ins_curso = new controlador_curso();

        /* agregar curso */
        if(isset($_POST['curso_grado_reg'])){
            echo $ins_curso->agregar_curso_controlador();
        }

          /* actualizar curso */
          if(isset($_POST['curso_id_up'])){
            echo $ins_curso->actualizar_curso_controlador();
        }

          /* eliminar curso */
          if(isset($_POST['curso_id_del'])){
            echo $ins_curso->eliminar_curso_controlador();
        }

    }else{
        session_start(['name'=>'SA']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
     }