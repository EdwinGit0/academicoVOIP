<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR TUTOR
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem odit amet asperiores quis minus, dolorem repellendus optio doloremque error a omnis soluta quae magnam dignissimos, ipsam, temporibus sequi, commodi accusantium!
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>alumno-list/"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; ALUMNO</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>padre-list/"><i class="fas fa-users fa-fw"></i> &nbsp; TUTOR</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">

	<p class="text-center">
        <?php if(empty($_SESSION['datos_alumno'])){ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAlumno"><i class="fas fa-building fa-fw"></i> &nbsp; Agregar Alumno</button>
        <?php } ?>
    </p>

	<!-- ESTRUCTURA ESTABLECIMIENTO -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-4 text-center">
				<span class="roboto-medium">ALUMNO/A:</span> 

				<?php if(empty($_SESSION['datos_alumno'])){ ?>

				<span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione un establecimiento</span>
				
				<?php }else{ ?>

				<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/padreAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
					<input type="hidden" name="id_eliminar_alumno" value="<?php echo $_SESSION['datos_alumno']['ID']; ?>">
					<?php echo $_SESSION['datos_alumno']['Nombre']." ".$_SESSION['datos_alumno']['ApellidoP']." ".$_SESSION['datos_alumno']['ApellidoM']." (".$_SESSION['datos_alumno']['CI'].")"; ?>
					<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
				</form>

				<?php } ?>
			</div>
		</div>
	</div>
	<br><br>

	<!-- formulario -->

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/padreAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="padre_ci_reg" id="padre_ci" maxlength="15" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="padre_nombre_reg" id="padre_nombre" maxlength="30" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_apellidoP" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="padre_apellidoP_reg" id="padre_apellidoP" maxlength="50" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_apellidoM" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="padre_apellidoM_reg" id="padre_apellidoM" maxlength="50" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="padre_fechaNac_reg" id="padre_fechaNac" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="padre_sexo" class="bmd-label-floating">Sexo</label>
                                <select class="form-control" name="padre_sexo_reg" id="padre_sexo" required="">
                                    <option value="" selected="" disabled="">Seleccione una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="padre_email_reg" id="padre_email" maxlength="70">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_rol" class="bmd-label-floating">Rol</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,50}" class="form-control" name="padre_rol_reg" id="padre_rol" maxlength="50" required="">
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
							<label for="padre_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="padre_telefono_reg" id="padre_telefono" maxlength="15" required="">
						</div>
					</div>
					<div class="col">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="padre_clave_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="padre_clave_1_reg" id="padre_clave_1" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" required="">
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="padre_clave_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="padre_clave_2_reg" id="padre_clave_2" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" required="">
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

<!-- MODAL ESTABLECIMIENTO -->
<div class="modal fade" id="ModalAlumno" tabindex="-1" role="dialog" aria-labelledby="ModalAlumno" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAlumno">Agregar alumno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_alumno" class="bmd-label-floating">CI, Nombre, Apellido</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_alumno" id="input_alumno" maxlength="30">
                        <input type="hidden" id="alumno_id" value="">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_alumnos"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_alumno()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vista/inc/padre.php"; ?>