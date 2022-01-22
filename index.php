<?php
    require_once "./config/APP.php";
    require_once "./controlador/controlador_vista.php";

    $plantilla = new controlador_vista();
    $plantilla->obtener_plantilla_controlador();