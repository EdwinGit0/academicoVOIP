<?php
    $peticionAjax = true;
    header("Content-Type: application/json");

    require_once "./controlador_alumno.php";
    require_once "./controlador_login.php";
    require_once "../docente/controlador_agenda.php";
    include_once "../respuestas.class.php";

    $ins_alumno = new controlador_alumno();
    $ins_login = new controlador_login();
    $ins_agenda = new controlador_agenda();
    $_respuesta = new respuestas;

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
        case "get-qualification":
            $data=$ins_alumno->getQualification($body);
            echo json_encode($data);
            break;
        case "token-validate":
            $data=$ins_login->validate_token_jwt($body['token']);
            echo json_encode($data);
            break;
        case "teacher-diary":
            $data=$ins_agenda->datos_agenda_controlador();
            echo json_encode($data);
            break;
        case "course-diary":
            $data=$ins_agenda->datos_cursos_controlador();
            echo json_encode($data);
            break;
        default:
            echo json_encode($_respuesta->error_405());
            break;
    }