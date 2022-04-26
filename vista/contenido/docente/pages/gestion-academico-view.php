<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
		<i class="fas fa-tasks"></i> &nbsp; GESTIÓN ACADÉMICO
    </h3>
</div>

<!-- Content here-->

	<?php
		if(!isset($_SESSION['busqueda_anio']) && empty($_SESSION['busqueda_anio'])){
	?>

	<div class="container-fluid">
		<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/docente/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
			<input type="hidden" name="modulo" value="anio">
			<div class="container-fluid">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-12">
						<div class="form-group input-group">
							<label for="inputSearch" class="bmd-label-floating">¿Qué sección estas buscando?</label>
							<input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30">
							<span class="input-group-addon"></span>
							<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="container-fluid">
		<?php
			require_once "./controlador/docente/controlador_anio.php";
			$ins_anio = new controlador_anio();

			echo $ins_anio->paginador_anio_controlador($pagina[2],15,$pagina[1],"");
		?>
	</div>

	<?php }else{ ?>

	<div class="container-fluid">
		<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/docente/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
			<input type="hidden" name="modulo" value="anio">
			<input type="hidden" name="eliminar_busqueda" value="eliminar">
			<div class="container-fluid">
				<div class="row justify-content-md-center">
					<div class="col-12 col-md-6">
						<p class="text-center" style="font-size: 20px;">
							Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_anio'];?>”</strong>
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
			require_once "./controlador/docente/controlador_anio.php";
			$ins_anio = new controlador_anio();

			echo $ins_anio->paginador_anio_controlador($pagina[2],15,$pagina[1],$_SESSION['busqueda_anio']);
		?>
	</div>

	<?php } ?>