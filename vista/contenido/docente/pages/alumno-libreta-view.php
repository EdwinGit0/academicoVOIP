<div class="full-box page-header">
  <h3 class="text-left">
    <i class="fas fa-id-badge"></i> &nbsp; LIBRETA ESCOLAR ELECTRÓNICA
  </h3>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
          <a href="<?php echo SERVERURL; ?>docente/pedagogico-cuaderno/"><i class="fas fa-book"></i> &nbsp; CUADERNO PEDAGÓGICO</a>
        </li>
        <li>
          <a href="<?php echo SERVERURL; ?>docente/pedagogico-registro/"><i class="fas fa-book"></i> &nbsp; REGISTRO PEDAGÓGICO</a>
        </li>
    </ul>	
</div>

<div class="container-fluid">
<?php

    require_once "./controlador/docente/controlador_registroP.php";
    $ins_libreta = new controlador_registroP();

    echo $ins_libreta->libreta_registroP_controlador($pagina[2],$pagina[3]);
    
?>
</div>

<?php include_once "./vista/contenido/docente/inc/imprimir.php"?>