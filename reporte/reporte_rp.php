<?php
	if(isset($_SESSION['id_sa'])){
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit(); 
	}
?>
<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Reporte</title>

    <style type="text/css">
    html {
        margin: 2cm 2cm 2cm 2cm;

    }

    .size-text12 {
        font-size: 12pt;
    }

    .size-text14 {
        font-size: 14pt;
    }

    .size-text11 {
        font-size: 11pt;
    }

    .size-text10 {
        font-size: 10pt;
    }

    .verticalText2 {
        writing-mode: tb-rl;
	    transform: rotate(-90deg);
    }

    .table.table-libreta2 th, td {
        vertical-align: middle !important;
    }

    #rotate{
        height:125px;
    }

    #vertical{
        -webkit-transform:rotate(-90deg);
        -moz-transform:rotate(-90deg);
        -o-transform: rotate(-90deg);
        margin-left: -50px;
        margin-right: -50px;
    }

    .table.table-libreta td {
        border: 10px solid !important;
    }

    .valor-promedio2 {
        background-color: #dbfff2;
        font-weight: bold;
    }
    </style>

</head>
    <body>

       <!--  Lista de alumnos -->
    <?php
    
        session_start(['name'=>'SA']);

        require_once "../controlador/docente/controlador_reporte.php";
        $ins_afiliacion = new controlador_reporte();

        echo $ins_afiliacion->referencial_curso_controlador($_GET['id'],"AFILIACIÓN DE ESTUDIANTES");
        echo $ins_afiliacion->paginador_alumno_controlador($_GET['id']);

    ?>

    <!--  periodos -->
    
    <?php
 
        $datos_periodo = $ins_afiliacion->datos_periodo_controlador();
        if($datos_periodo->rowCount()>=1){
            $campos_periodo = $datos_periodo->fetchAll();
            foreach($campos_periodo as $rows){ ?>
                <div style="page-break-after:always;"></div>
          <?php 
                echo $ins_afiliacion->referencial_curso_controlador($_GET['id'],"CENTRALIZADOR DE NOTAS - ".$rows['NOMBRE_PER']);
                echo $ins_afiliacion->tabla_periodo_controlador($_GET['id'],$rows['COD_PER']);
            } 
        }

    ?>

    <!--  final -->
    <div style="page-break-after:always;"></div>
    <?php

        echo $ins_afiliacion->referencial_curso_controlador($_GET['id'],"CUADRO CENTRALIZADOR ANUAL ");
        echo $ins_afiliacion->resumen_cuadroP_controlador($_GET['id']);

    ?>
    </body>
</html>

<?php $html = ob_get_clean(); 
//echo $html;

require_once "../libreria/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$html .= '<link type="text/css" href="http://localhost/academicoVOIP/vista/css/bootstrap.min.css" rel="stylesheet">';
$html .= '<link type="text/css" href="http://localhost/academicoVOIP/vista/css/style.css" rel="stylesheet">';


$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

//$dompdf->setPaper('letter');
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("reporte.pdf", array("Attachment" => false));
?>