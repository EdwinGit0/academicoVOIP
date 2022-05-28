<?php
    $peticionAjax = true;
    header("Content-Type: application/json");

    require_once "./controlador_alumno.php";
    require_once "./controlador_login.php";
    $ins_alumno = new controlador_alumno();
    $ins_login = new controlador_login();

    $body = json_decode(file_get_contents("php://input"),true);

    switch ($_GET["op"]) {
        case "get-student-list":
            $data=$ins_alumno->getStudentList();
            echo $data;
        break;
        case "get-student":
            $data=$ins_alumno->getStudent("Unico",$body["student_id"],"");
            echo $data;
            break;
        case "login":
            $data=$ins_login->iniciar_sesion_student_controlador($body);
            echo json_encode($data);
        break;
    }