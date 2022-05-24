<?php
	if($cl->encryption($_SESSION['id_sa'])!=$pagina[2]){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR MIS DATOS
	</h3>
	<hr align="center" width="95%"/>
</div>

<div class="container-fluid">
<?php
		require_once "./controlador/admin/controlador_docente.php";
		$ins_docente = new controlador_docente();

		$datos_docente = $ins_docente->datos_docente_controlador("Unico",$pagina[2],"");

		if($datos_docente->rowCount()==1){
			$campos = $datos_docente->fetch();
	?>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/docente/docenteAjax.php" method="POST" data-form="update" autocomplete="off" novalidate onsubmit="return teacher_update_2_validata()">
		<input type="hidden" name="docente_id_up" value="<?php echo $pagina[2]; ?>">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="docente_nombre_up" 
							id="docente_nombre" maxlength="30" value="<?php echo $campos['NOMBRE_P']; ?>" required="" onchange="deleteErrorMessage('docente_nombre_error')">
							<div class='message-error' id="docente_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_apellido" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoP_up" 
							id="docente_apellidoP" maxlength="50" value="<?php echo $campos['APELLIDOP_P']; ?>" required="" onchange="deleteErrorMessage('docente_apellidoP_error')">
							<div class='message-error' id="docente_apellidoP_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_apellido" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoM_up" 
							id="docente_apellidoM" maxlength="50" value="<?php echo $campos['APELLIDOM_P']; ?>" required="" onchange="deleteErrorMessage('docente_apellidoM_error')">
							<div class='message-error' id="docente_apellidoM_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="docente_ci_up" 
							id="docente_ci" maxlength="15" value="<?php echo $campos['CI_P']; ?>" required="" onchange="deleteErrorMessage('docente_ci_error')">
							<div class='message-error' id="docente_ci_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="docente_fechaNac_up" 
							id="docente_fecha_nac" value="<?php echo $campos['FECHANAC_P']; ?>" required="" onchange="deleteErrorMessage('docente_fecha_nac_error')">
							<div class='message-error' id="docente_fecha_nac_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="docente_telefono_up" 
							id="docente_telefono" maxlength="15" value="<?php echo $campos['TELEFONO_P']; ?>" required="" onchange="deleteErrorMessage('docente_telefono_error')">
							<div class='message-error' id="docente_telefono_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="docente_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="docente_direccion_up" 
							id="docente_direccion" maxlength="150" value="<?php echo $campos['DIRECCION_P']; ?>" onchange="deleteErrorMessage('docente_direccion_error')">
							<div class='message-error' id="docente_direccion_error"></div>
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
							<label for="docente_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="docente_email_up" 
							id="docente_email" maxlength="70" value="<?php echo $campos['CORREO_P']; ?>" required="" onchange="deleteErrorMessage('docente_email_error')">
							<div class='message-error' id="docente_email_error"></div>
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
							<label for="docente_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="docente_clave_nueva_1" 
							id="docente_clave_nueva_1" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20"  onchange="deleteErrorMessage('docente_clave_nueva_1_error')">
							<div class='message-error' id="docente_clave_nueva_1_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="docente_clave_nueva_2" 
							id="docente_clave_nueva_2" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20"  onchange="deleteErrorMessage('docente_clave_nueva_2_error')">
							<div class='message-error' id="docente_clave_nueva_2_error"></div>
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