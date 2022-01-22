<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque laudantium necessitatibus eius iure adipisci modi distinctio. Earum repellat iste et aut, ullam, animi similique sed soluta tempore cum quis corporis!
    </p>
</div>
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>docente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>docente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DOCENTES</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>docente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR DOCENTE</a>
        </li>
    </ul>
</div>


<div class="container-fluid">

	<p class="text-center">
        <?php if(empty($_SESSION['datos_area'])){ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalArea"><i class="fas fa-spell-check"></i> &nbsp; Agregar área</button>
        <?php } ?>
		<?php if(empty($_SESSION['datos_seccion'])){ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalSeccion"><i class="fas fa-book"></i> &nbsp; Agregar sección</button>
        <?php } ?>
    </p>

	<div class="container-fluid">
		<div class="row">
				<!-- ESTRUCTURA AREA -->
			<div class="col-12 col-md-6 text-center">
				<span class="roboto-medium">Área:</span> 

				<?php if(empty($_SESSION['datos_area'])){ ?>

				<span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione un área</span>
				
				<?php }else{ ?>

				<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/docenteAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
					<input type="hidden" name="id_eliminar_area" value="<?php echo $_SESSION['datos_area']['ID']; ?>">
					<?php echo $_SESSION['datos_area']['Nombre']." (".$_SESSION['datos_area']['Creado'].")"; ?>
					<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
				</form>

				<?php } ?>
			</div>	
			
			<!-- ESTRUCTURA SECCION -->
			<div class="col-12 col-md-6 text-center">
				<span class="roboto-medium">Sección:</span> 

				<?php if(empty($_SESSION['datos_seccion'])){ ?>

				<span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione una sección</span>
				
				<?php }else{ ?>

				<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/docenteAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
					<input type="hidden" name="id_eliminar_seccion" value="<?php echo $_SESSION['datos_seccion']['ID']; ?>">
					<?php echo $_SESSION['datos_seccion']['Nombre']." (".$_SESSION['datos_seccion']['Creado'].")"; ?>
					<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
				</form>

				<?php } ?>
			</div>
		</div>
	</div>
	<br><br>

	<!-- formulario -->

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/docenteAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="docente_ci_reg" id="docente_ci" maxlength="15" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="docente_nombre_reg" id="docente_nombre" maxlength="30" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_apellidoP" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoP_reg" id="docente_apellidoP" maxlength="50" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_apellidoM" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoM_reg" id="docente_apellidoM" maxlength="50" required="">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="docente_fechaNac_reg" id="docente_fechaNac" required="">
						</div>
					</div>
					<div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="docente_sexo" class="bmd-label-floating">Sexo</label>
                                <select class="form-control" name="docente_sexo_reg" id="docente_sexo" required="">
                                    <option value="" selected="" disabled="">Seleccione una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaIng">Fecha de Ingreso</label>
							<input type="date" class="form-control" name="docente_fechaIng_reg" id="docente_fechaIng" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="docente_telefono_reg" id="docente_telefono" maxlength="15" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="docente_direccion_reg" id="docente_direccion" maxlength="150">
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<fieldset>
			<legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="docente_email_reg" id="docente_email" maxlength="70" required="">
						</div>
					</div>
					<div class="col">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label for="docente_clave_1" class="bmd-label-floating">Contraseña</label>
								<input type="password" class="form-control" name="docente_clave_1_reg" id="docente_clave_1" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" required="">
							</div>
						</div>
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label for="docente_clave_2" class="bmd-label-floating">Repetir contraseña</label>
								<input type="password" class="form-control" name="docente_clave_2_reg" id="docente_clave_2" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" required="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<br><br><br>
		<fieldset>
			<legend><i class="fas fa-user-lock"></i> &nbsp; Área/Sección</legend>
			<div class="container-fluid">
				<div class="producto-container">
					<div class="producto-row-0">
						<div class="row">
							<div class="col-10 col-md-11">
							
									<label for="docente_seccion" class="">Sección</label>
									<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="docente_seccion_reg" id="docente_seccion" maxlength="15" required="">
					
							</div>
							<div class="col-10 col-md-1">
								<label class="sr-only" for="">Agregar otro Producto</label>
								<button id="add-producto" class="btn btn-primary input-sm"><strong>Más + </strong></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<br><br><br>
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>

<!-- MODAL AREA -->
<div class="modal fade" id="ModalArea" tabindex="-1" role="dialog" aria-labelledby="ModalArea" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalArea">Agregar área</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_area" class="bmd-label-floating">Nombre, Creado</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_area" id="input_area" maxlength="30">
                        <input type="hidden" id="area_id" value="">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_areas"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_area()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SECCION -->
<div class="modal fade" id="ModalSeccion" tabindex="-1" role="dialog" aria-labelledby="ModalSeccion" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalSeccion">Agregar sección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_seccion" class="bmd-label-floating">Nombre, Creado</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_seccion" id="input_seccion" maxlength="30">
                        <input type="hidden" id="seccion_id" value="">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_seccions"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_seccion()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vista/inc/docente.php"; ?>
