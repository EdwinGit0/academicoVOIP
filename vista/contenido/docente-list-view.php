<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DOCENTE
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum delectus eos enim numquam fugit optio accusantium, aperiam eius facere architecto facilis quibusdam asperiores veniam omnis saepe est et, quod obcaecati.
    </p>
</div>
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>docente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE</a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>docente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DOCENTES</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>docente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR DOCENTE</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
    <?php
		require_once "./controlador/controlador_docente.php";
		$ins_docente = new controlador_docente();

		echo $ins_docente->paginador_docente_controlador($pagina[1],15,$_SESSION['privilegio_sa'],$pagina[0],"",$_SESSION['ua_id']);
	?>
</div>