<!-- Page header -->
<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; CURSO
    </h3>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active"  href="<?php echo SERVERURL; ?>admin/curso-list/"><i class="fas fa-spell-check"></i> &nbsp; CURSO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/periodo-list/"><i class="fas fa-layer-group"></i> &nbsp; PERIODO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/area-list/"><i class="fas fa-book"></i> &nbsp; ÁREA</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/anio-list/"><i class="fas fa-tasks"></i> &nbsp; AÑO ACADÉMICO</a>
        </li>
    </ul>	
</div>

<!-- Content here-->


<div class="container-fluid">
	<p class="text-center">
		<a href="<?php echo SERVERURL; ?>admin/curso-new/" class="btn btn-primary"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR CURSO</a>
		<a href="<?php echo SERVERURL; ?>admin/curso-asignacion/" class="btn btn-primary"><i class="fas fa-plus fa-fw"></i> &nbsp; ASIGNACIÓN</a>
	</p>
</div>

	<?php
		if(!isset($_SESSION['busqueda_curso']) && empty($_SESSION['busqueda_curso'])){
	?>

	<div class="container-fluid">
		<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="default" autocomplete="off" novalidate onsubmit="return search_validata('curso')">
			<input type="hidden" name="modulo" value="curso">
			<div class="container-fluid">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-12">
						<div class="form-group input-group">
							<label for="inputSearch" class="bmd-label-floating">¿Qué curso estas buscando?</label>
							<input type="text" class="form-control" name="busqueda_inicial" 
							id="curso" onchange="deleteErrorMessage('curso_error')">
							<span class="input-group-addon"></span>
							<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
						</div>
						<div class='message-error' id="curso_error"></div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="container-fluid">
		<?php
			require_once "./controlador/admin/controlador_curso.php";
			$ins_curso = new controlador_curso();

			echo $ins_curso->paginador_curso_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$pagina[1],"");
		?>
	</div>

	<?php }else{ ?>

	<div class="container-fluid">
		<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
			<input type="hidden" name="modulo" value="curso">
			<input type="hidden" name="eliminar_busqueda" value="eliminar">
			<div class="container-fluid">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-6">
						<p class="text-center" style="font-size: 20px;">
							Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_curso'];?>”</strong>
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
			require_once "./controlador/admin/controlador_curso.php";
			$ins_curso = new controlador_curso();

			echo $ins_curso->paginador_curso_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$pagina[1],$_SESSION['busqueda_curso']);
		?>
	</div>

	<?php } ?>
