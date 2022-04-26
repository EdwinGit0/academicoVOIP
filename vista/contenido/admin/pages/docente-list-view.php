<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DOCENTE
    </h3>
</div>
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>admin/docente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE</a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>admin/docente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DOCENTES</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/docente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR DOCENTE</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
    <?php
		require_once "./controlador/admin/controlador_docente.php";
		$ins_docente = new controlador_docente();

		echo $ins_docente->paginador_docente_controlador($pagina[2],15,$_SESSION['privilegio_sa'],$pagina[1],"",$_SESSION['ua_id']);
	?>
</div>

<!-- MODAL INFO -->
<div class="modal fade" id="ModalInfo" tabindex="-1" role="dialog" aria-labelledby="ModalInfo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalInfo">Docente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
						<div class="col-12 text-center">
							<div class="form-espace">
								<img src ="<?php echo SERVERURL;?>vista/assets/img/user02.png" class="size-img">
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>CI</span>
								<input type="text" class="form-control form-block" name="docente_ci_see" id="docente_ci" disabled >
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Nombre Completo</span>
								<input type="text" class="form-control form-block" name="docente_nombre_see" id="docente_nombre" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Fecha de Nacimiento</span>
								<input type="date" class="form-control form-block" name="docente_fechaNac_see" id="docente_fecha_nac" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Fecha de Ingreso</span>
								<input type="text" class="form-control form-block" name="docente_fechIng_see" id="docente_fechIng" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Sexo</span>
								<input type="text" class="form-control form-block" name="docente_sexo_see" id="docente_sexo" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Dirección</span>
								<input type="text" class="form-control form-block" name="docente_direccion_see" id="docente_direccion" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Correo</span>
								<input type="email" class="form-control form-block" name="docente_email_see" id="docente_email" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Teléfono</span>
								<input type="text" class="form-control form-block" name="docente_telefono_see" id="docente_telefono" disabled>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Establecimiento Educativo</span>
								<input type="text" class="form-control form-block" name="docente_educativo_see" id="docente_educativo" disabled>
							</div>
						</div>
                        <div class="col-12 col-md-6">
							<div class="form-espace">
								<span>Área</span>
								<input type="text" class="form-control form-block" name="docente_area_see" id="docente_area" disabled>
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

<?php include_once "./vista/contenido/admin/inc/docente.php"; ?>