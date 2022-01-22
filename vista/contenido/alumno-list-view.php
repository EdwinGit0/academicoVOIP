<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-user-graduate fa-fw"></i> &nbsp; ALUMNO
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>alumno-list/"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; ALUMNO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>padre-list/"><i class="fas fa-users fa-fw"></i> &nbsp; TUTOR</a>
        </li>
    </ul>	
</div>

<!-- Content here-->

<div class="container-fluid">
	<p class="text-center">
		<a href="<?php echo SERVERURL; ?>alumno-new/" class="btn btn-primary"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR ALUMNO</a>
	</p>
</div>

<?php
	if(!isset($_SESSION['busqueda_alumno']) && empty($_SESSION['busqueda_alumno'])){
?>

<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
		<input type="hidden" name="modulo" value="alumno">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<label for="inputSearch" class="bmd-label-floating">¿Qué alumno estas buscando?</label>
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

<div class="container-fluid">
    <?php
		require_once "./controlador/controlador_alumno.php";
		$ins_alumno = new controlador_alumno();

		echo $ins_alumno->paginador_alumno_controlador($pagina[1],15,$_SESSION['privilegio_sa'],$pagina[0],"",$_SESSION['ua_id']);
	?>
</div>

<?php }else{ ?>

<div class="container-fluid">
	<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
		<input type="hidden" name="modulo" value="alumno">
		<input type="hidden" name="eliminar_busqueda" value="eliminar">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-6">
					<p class="text-center" style="font-size: 20px;">
						Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_alumno'];?>”</strong>
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
		require_once "./controlador/controlador_alumno.php";
		$ins_alumno = new controlador_alumno();

		echo $ins_alumno->paginador_alumno_controlador($pagina[1],15,$_SESSION['privilegio_sa'],$pagina[0],$_SESSION['busqueda_alumno'],$_SESSION['ua_id']);
	?>
</div>

<?php } ?>