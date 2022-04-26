<!-- Page header -->
<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-user-graduate fa-fw"></i> &nbsp; ALUMNO
    </h3>
</div>


<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>admin/alumno-list/"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; ALUMNO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/padre-list/"><i class="fas fa-users fa-fw"></i> &nbsp; TUTOR</a>
        </li>
    </ul>	
</div>

<!-- Content here-->

<div class="container-fluid">
	<p class="text-center">
		<a href="<?php echo SERVERURL; ?>admin/alumno-new/" class="btn btn-primary"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR ALUMNO</a>
	</p>
</div>

<?php
	if(!isset($_SESSION['busqueda_alumno']) && empty($_SESSION['busqueda_alumno'])){
?>

<div class="container-fluid">
	<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
		<input type="hidden" name="modulo" value="alumno">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-12">
					<div class="form-group input-group">
						<label for="inputSearch" class="bmd-label-floating">¿Qué alumno estas buscando?</label>
						<input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30">
						<div class="input-group-addon"></div>
						<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="container-fluid">
    <?php
		require_once "./controlador/admin/controlador_alumno.php";
		$ins_alumno = new controlador_alumno();
		echo $ins_alumno->paginador_alumno_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$pagina[1],"",$_SESSION['ua_id']);
	?>
</div>

<?php }else{ ?>

<div class="container-fluid">
	<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
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
		require_once "./controlador/admin/controlador_alumno.php";
		$ins_alumno = new controlador_alumno();

		echo $ins_alumno->paginador_alumno_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$pagina[1],$_SESSION['busqueda_alumno'],$_SESSION['ua_id']);
	?>
</div>

<?php } ?>

<!-- MODAL INFO -->
<div class="modal fade" id="ModalInfo" tabindex="-1" role="dialog" aria-labelledby="ModalInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalInfo">Alumno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
						<div class="col-12 text-center">
							<div class="form-espace">
								<img src ="<?php echo SERVERURL;?>vista/assets/img/user03.png" class="size-img">
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>CI</span>
								<input type="text" class="form-control form-block" name="alumno_ci_see" id="alumno_ci" disabled >
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Código RUDE</span>
								<input type="text" class="form-control form-block" name="alumno_rude_see" id="alumno_rude" disabled >
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Nombre Completo</span>
								<input type="text" class="form-control form-block" name="alumno_nombre_see" id="alumno_nombre" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Sexo</span>
								<input type="text" class="form-control form-block" name="alumno_sexo_see" id="alumno_sexo" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Fecha de Nacimiento</span>
								<input type="date" class="form-control form-block" name="alumno_fechaNac_see" id="alumno_fecha_nac" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Lugar de Nacimiento</span>
								<input type="text" class="form-control form-block" name="alumno_lugarNac_see" id="alumno_lugarNac" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Dirección</span>
								<input type="text" class="form-control form-block" name="alumno_direccion_see" id="alumno_direccion" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Correo</span>
								<input type="email" class="form-control form-block" name="alumno_email_see" id="alumno_email" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Teléfono</span>
								<input type="text" class="form-control form-block" name="alumno_telefono_see" id="alumno_telefono" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Establecimiento Educativo</span>
								<input type="text" class="form-control form-block" name="alumno_educativo_see" id="alumno_educativo" disabled>
							</div>
						</div>
						
						<div class="col-12 col-md-12">
							<div id="docente_tutor_reg">
								<div class="form-espace">
									<span>Tutores</span>
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

<?php include_once "./vista/contenido/admin/inc/alumno.php"; ?>