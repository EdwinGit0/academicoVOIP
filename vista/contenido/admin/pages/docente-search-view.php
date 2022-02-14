<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR DOCENTE
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum delectus eos enim numquam fugit optio accusantium, aperiam eius facere architecto facilis quibusdam asperiores veniam omnis saepe est et, quod obcaecati.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>admin/docente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/docente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DOCENTES</a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>admin/docente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR DOCENTE</a>
        </li>
    </ul>
</div>

<?php
	if(!isset($_SESSION['busqueda_docente']) && empty($_SESSION['busqueda_docente'])){
?>

<div class="container-fluid">
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
    <input type="hidden" name="modulo" value="docente">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="inputSearch" class="bmd-label-floating">¿Qué docente estas buscando?</label>
                        <input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30">
                    </div>
                </div>
                <div class="col-12">
                    <p class="text-center" style="margin-top: 40px;">
                        <button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<?php }else{ ?>

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
        <input type="hidden" name="modulo" value="docente">
        <input type="hidden" name="eliminar_busqueda" value="eliminar">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-6">
                    <p class="text-center" style="font-size: 20px;">
                        Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_docente'];?>”</strong>
                    </p>
                </div>
                <div class="col-12">
                    <p class="text-center" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="container-fluid">
    <?php
		require_once "./controlador/admin/controlador_docente.php";
		$ins_docente = new controlador_docente();

		echo $ins_docente->paginador_docente_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$pagina[1],$_SESSION['busqueda_docente'],$_SESSION['ua_id']);
	?>
</div>

<?php } ?>