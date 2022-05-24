<!-- Page header -->
<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-user-graduate fa-fw"></i> &nbsp; TUTOR
    </h3>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>admin/alumno-list/"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; ALUMNO</a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>admin/padre-list/"><i class="fas fa-users fa-fw"></i> &nbsp; TUTOR</a>
        </li>
    </ul>	
</div>

<!-- Content here-->

<div class="container-fluid">
	<p class="text-center">
		<a href="<?php echo SERVERURL; ?>admin/padre-new/" class="btn btn-primary"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR TUTOR</a>
	</p>
</div>

<?php
	if(!isset($_SESSION['busqueda_padre']) && empty($_SESSION['busqueda_padre'])){
?>

<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="default" autocomplete="off" novalidate onsubmit="return search_validata('padre')">
		<input type="hidden" name="modulo" value="padre">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-12">
					<div class="form-group input-group">
						<label for="inputSearch" class="bmd-label-floating">¿Qué padre estas buscando?</label>
						<input type="text" class="form-control" name="busqueda_inicial" id="padre" required="" onchange="deleteErrorMessage('padre_error')">
						<div class="input-group-addon"></div>
						<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
					</div>
					<div class='message-error' id="padre_error"></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="container-fluid">
    <?php
		require_once "./controlador/admin/controlador_padre.php";
		$ins_padre = new controlador_padre();

		echo $ins_padre->paginador_padre_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$pagina[1],"",$_SESSION['ua_id']);
	?>
</div>

<?php }else{ ?>

<div class="container-fluid">
	<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
		<input type="hidden" name="modulo" value="padre">
		<input type="hidden" name="eliminar_busqueda" value="eliminar">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-6">
					<p class="text-center" style="font-size: 20px;">
						Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_padre'];?>”</strong>
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
		require_once "./controlador/admin/controlador_padre.php";
		$ins_padre = new controlador_padre();

		echo $ins_padre->paginador_padre_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$pagina[1],$_SESSION['busqueda_padre'],$_SESSION['ua_id']);
	?>
</div>

<?php } ?>

<!-- MODAL INFO -->
<div class="modal fade" id="ModalInfo" tabindex="-1" role="dialog" aria-labelledby="ModalInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalInfo">Tutor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
						<div class="col-12 text-center">
							<div class="form-espace">
								<img src ="<?php echo SERVERURL;?>vista/assets/img/user05.png" class="size-img">
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>CI</span>
								<input type="text" class="form-control form-block" name="padre_ci_see" id="padre_ci" disabled >
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Nombre Completo</span>
								<input type="text" class="form-control form-block" name="padre_nombre_see" id="padre_nombre" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Fecha de Nacimiento</span>
								<input type="date" class="form-control form-block" name="padre_fechaNac_see" id="padre_fecha_nac" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Sexo</span>
								<input type="text" class="form-control form-block" name="padre_sexo_see" id="padre_sexo" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Correo</span>
								<input type="email" class="form-control form-block" name="padre_email_see" id="padre_email" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Teléfono</span>
								<input type="text" class="form-control form-block" name="padre_telefono_see" id="padre_telefono" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Rol</span>
								<input type="text" class="form-control form-block" name="padre_rol_see" id="padre_rol" disabled>
							</div>
						</div>
						
						<div class="col-12 col-md-12">
							<div id="alumno_reg">
								<div class="form-espace">
									<span>Tutor de:</span>
									<div id="itemDate">
										<input type="text" class="form-control form-block" name="field_name[]" placeholder="Sin designar" disabled>
									</div>
									<div id="item-add"></div>
								</div>
							</div>
						</div>

					</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vista/contenido/admin/inc/padre.php"; ?>