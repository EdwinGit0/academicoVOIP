<?php 
	if($_SESSION['privilegio_sa']!=1){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header mb-0 y pb-0">
	<h3 class="text-left">
		<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR
	</h3>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>admin/user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO ADMINISTRADOR</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>admin/user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ADMINISTRADOR</a>
		</li>
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>admin/user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR</a>
		</li>
	</ul>	
</div>

<?php
	if(!isset($_SESSION['busqueda_usuario']) && empty($_SESSION['busqueda_usuario'])){
?>
<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="default" autocomplete="off" novalidate onsubmit="return search_validata('usuario')">
		<input type="hidden" name="modulo" value="usuario">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<label for="inputSearch" class="bmd-label-floating">¿Qué usuario estas buscando?</label>
						<input type="text" class="form-control" name="busqueda_inicial" 
						id="usuario" required="" onchange="deleteErrorMessage('usuario_error')">
					</div>
					<div class='message-error' id="usuario_error"></div>
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
		<input type="hidden" name="modulo" value="usuario">
		<input type="hidden" name="eliminar_busqueda" value="eliminar">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-6">
					<p class="text-center" style="font-size: 20px;">
						Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_usuario'];?>”</strong>
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
		require_once "./controlador/admin/controlador_usuario.php";
		$ins_admin = new controlador_usuario();

		echo $ins_admin->paginador_admin_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$_SESSION['id_sa'],$pagina[1],$_SESSION['busqueda_usuario']);
	?>
</div>
<?php } ?>