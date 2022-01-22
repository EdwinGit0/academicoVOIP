<?php
	if($_SESSION['privilegio_sa']<1 || $_SESSION['privilegio_sa']>2){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR TUTOR
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

	<?php
		require_once "./controlador/controlador_padre.php";
		$ins_padre = new controlador_padre();

		$datos_padre = $ins_padre->datos_padre_controlador("Unico",$pagina[1],"");

		if($datos_padre->rowCount()==1){
			$campos = $datos_padre->fetch();
	?>

	<?php

		require_once "./controlador/controlador_fa_alumno.php";
		require_once "./controlador/controlador_alumno.php";
		$ins_fa_alumno = new controlador_fa_alumno();
		$ins_alumno = new controlador_alumno();

		$datos_alumno = $ins_fa_alumno->datos_fa_alumno_controlador("padre",$cl->encryption($campos['FAMILAR_ID']),"");
		$datos_alumno = $datos_alumno->fetch();
		$datos_alumno = $ins_alumno->datos_alumno_controlador("Unico",$cl->encryption($datos_alumno['ALUMNO_ID']),"");
		$datos_alumno = $datos_alumno->fetch();
	?>
	   
			<!-- ESTRUCTURA ALUMNO -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-4 text-center">
				<span class="roboto-medium">ALUMNO/A:</span> 

				<?php if(empty($datos_alumno)){ ?>

				<span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione un alumno</span>
				
				<?php }else{ ?>

				<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/alumnoAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
					<input type="hidden" name="id_eliminar_alumno_up" value="<?php echo $cl->encryption($datos_alumno['ALUMNO_ID']); ?>">
					<input type="hidden" name="id_eliminar_padre_up" value="<?php echo $cl->encryption($campos['FAMILAR_ID']); ?>">
					<?php echo $datos_alumno['NOMBRE_A']." ".$datos_alumno['APELLIDOP_A']." ".$datos_alumno['APELLIDOM_A']." (".$datos_alumno['CI_A'].")"; ?>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAlumno"><i class="fas fa-edit"></i></button>
				</form>

				<?php } ?>
			</div>
		</div>
	</div>
	<br><br>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/padreAjax.php" method="POST" data-form="update" autocomplete="off">
		<input type="hidden" name="padre_id_up" value="<?php echo $pagina[1]; ?>">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="padre_ci_up" id="padre_ci" maxlength="15" value="<?php echo $campos['CI_FA']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="padre_nombre_up" id="padre_nombre" maxlength="30" value="<?php echo $campos['NOMBRE_FA']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_apellido" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="padre_apellidoP_up" id="padre_apellidoP" maxlength="50" value="<?php echo $campos['APELLIDOP_FA']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_apellido" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="padre_apellidoM_up" id="padre_apellidoM" maxlength="50" value="<?php echo $campos['APELLIDOM_FA']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="padre_fechaNac_up" id="padre_fecha_nac" value="<?php echo $campos['FECHANAC_FA']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="padre_sexo" class="bmd-label-floating">Sexo</label>
                                <select class="form-control" name="padre_sexo_up" id="padre_sexo" required="">
                                    <option value="Masculino"  <?php if($campos['SEXO_FA'] == "Masculino"){ echo 'selected=""'; } ?>>Masculino</option>
                                    <option value="Femenino"  <?php if($campos['SEXO_FA'] == "Femenino"){ echo 'selected=""'; } ?>>Femenino</option>
                                </select>
                            </div>
                        </div>
	
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="padre_email_up" id="padre_email" maxlength="70" value="<?php echo $campos['CORREO_FA']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_rol" class="bmd-label-floating">Rol</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,50}" class="form-control" name="padre_rol_up" id="padre_rol" maxlength="50" value="<?php echo $campos['ROL_FA']; ?>" required="">
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
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="padre_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="padre_telefono_up" id="padre_telefono" maxlength="15" value="<?php echo $campos['TELEFONO_FA']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<span>Estado de la cuenta &nbsp; <?php if($campos['ESTADO_FA'] == 1){ echo '<span class="badge badge-info">Activa</span>'; }else{ echo '<span class="badge badge-danger">Deshabilitada</span>'; }?></span>
							<select class="form-control" name="padre_estado_up">
								<option value="1" <?php if($campos['ESTADO_FA'] == 1){ echo 'selected=""'; } ?>>Activa</option>
								<option value="0" <?php if($campos['ESTADO_FA'] == 0){ echo 'selected=""'; } ?>>Deshabilitada</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<fieldset>
			<legend style="margin-top: 40px;"><i class="fas fa-lock"></i> &nbsp; Nueva contraseña</legend>
			<p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla debe dejar vacíos los dos campos de las contraseñas.</p>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="padre_clave_nueva_1" id="padre_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" >
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="padre_clave_nueva_2" id="padre_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" >
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<p class="text-center" style="margin-top: 40px;">
			<button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
		</p>
	</form>

	<?php }else{ ?>

	<div class="alert alert-danger text-center" role="alert">
		<p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
		<h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
		<p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
	</div>

	<?php } ?>
	
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
                        <input type="hidden" id="alumno_id" value="<?php echo $pagina[1]; ?>">
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