<?php
	if($cl->encryption($_SESSION['id_sa'])!=$pagina[2]){
		if($_SESSION['privilegio_sa']!=1){
			echo $cl->forzar_cierre_sesion_controlador();
			exit();
		}
	}
?>
<div class="full-box page-header mb-0 y pb-0">
	<h3 class="text-left">
		<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR ADMINISTRADOR
	</h3>
</div>

<?php if($_SESSION['privilegio_sa']==1){ ?>
<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>admin/user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO ADMINISTRADOR</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>admin/user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ADMINISTRADOR</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>admin/user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR</a>
		</li>
	</ul>	
</div>
<?php } ?>

<div class="container-fluid">
	<?php
		require_once "./controlador/admin/controlador_usuario.php";
		$ins_usuario= new controlador_usuario();

		$datos_usuario=$ins_usuario->datos_usuario_controlador("Unico",$pagina[2]);

		if($datos_usuario->rowCount()==1){
			$campos=$datos_usuario->fetch();
	?>
	<form  class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/usuarioAjax.php" method="POST" data-form="update" autocomplete="off" novalidate onsubmit="return admin_update_validata()">
		<input type="hidden" name="usuario_id_up" value="<?php echo $pagina[2]; ?>">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
			<div class="container-fluid">
				<div class="row">				
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_nombre" class="bmd-label-floating">Nombres</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="usuario_nombre_up" 
							id="usuario_nombre" maxlength="30" required="" value="<?php echo $campos['NOMBRE_AD']; ?>" onchange="deleteErrorMessage('usuario_nombre_error')">
							<div class='message-error' id="usuario_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_apellido" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="usuario_apellidoP_up" 
							id="usuario_apellidoP" maxlength="50" required="" value="<?php echo $campos['APELLIDOP_AD']; ?>" onchange="deleteErrorMessage('usuario_apellidoP_error')">
							<div class='message-error' id="usuario_apellidoP_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_apellido" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="usuario_apellidoM_up" 
							id="usuario_apellidoM" maxlength="50" required="" value="<?php echo $campos['APELLIDOM_AD']; ?>" onchange="deleteErrorMessage('usuario_apellidoM_error')">
							<div class='message-error' id="usuario_apellidoM_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{8,15}" class="form-control" name="usuario_telefono_up" 
							id="usuario_telefono" maxlength="15" value="<?php echo $campos['TELEFONO_AD']; ?>" onchange="deleteErrorMessage('usuario_telefono_error')">
							<div class='message-error' id="usuario_telefono_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,255}" class="form-control" name="usuario_direccion_up" 
							id="usuario_direccion" maxlength="255" value="<?php echo $campos['DIRECCION_AD']; ?>" onchange="deleteErrorMessage('usuario_direccion_error')">
							<div class='message-error' id="usuario_direccion_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_tipo" class="bmd-label-floating">Tipo de usuario</label>
							<select class="form-control" name="usuario_tipo_up" 
							id="usuario_tipo" required="" onchange="deleteErrorMessage('usuario_tipo_error')">>
								<option value="Administrador"  <?php if($campos['TIPO'] == "Administrador"){ echo 'selected=""'; } ?>>Administrador</option>
								<option value="Director"  <?php if($campos['TIPO'] == "Director"){ echo 'selected=""'; } ?>>Director</option>
							</select>
							<div class='message-error' id="usuario_tipo_error"></div>
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
							<label for="usuario_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="usuario_email_up" 
							id="usuario_email" maxlength="150" required="" value="<?php echo $campos['CORREO_AD']; ?>" onchange="deleteErrorMessage('usuario_email_error')">
							<div class='message-error' id="usuario_email_error"></div>
						</div>
					</div>

					<?php if($_SESSION['privilegio_sa']==1 && $campos['ADMIN_ID']!=1){ ?>
					<div class="col-12">
						<div class="form-group">
							<span>Estado de la cuenta &nbsp; <?php if($campos['ESTADO'] == 1){ echo '<span class="badge badge-info">Activa</span>'; }else{ echo '<span class="badge badge-danger">Deshabilitada</span>'; }?></span>
							<select class="form-control" name="usuario_estado_up">
								<option value="1" <?php if($campos['ESTADO'] == 1){ echo 'selected=""'; } ?> >Activa</option>
								<option value="0" <?php if($campos['ESTADO'] == 0){ echo 'selected=""'; } ?> >Deshabilitada</option>
							</select>
						</div>
					</div>
					<?php } ?>

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
							<label for="usuario_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="usuario_clave_nueva_1" 
							id="usuario_clave_nueva_1" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" onchange="deleteErrorMessage('usuario_clave_1_error')">
							<div class='message-error' id="usuario_clave_1_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="usuario_clave_nueva_2" 
							id="usuario_clave_nueva_2" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" onchange="deleteErrorMessage('usuario_clave_1_error')">
							<div class='message-error' id="usuario_clave_2_error"></div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<?php if($_SESSION['privilegio_sa']==1 && $campos['ADMIN_ID']!=1){ ?>
		<br><br><br>
		<fieldset>
			<legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<p><span class="badge badge-info">Control total</span> Permisos para registrar, actualizar y eliminar</p>
						<p><span class="badge badge-success">Edición</span> Permisos para registrar y actualizar</p>
						<p><span class="badge badge-dark">Registrar</span> Solo permisos para registrar</p>
						<div class="form-group">
							<select class="form-control" name="usuario_privilegio_up" required="" 
							id="usuario_privilegio" onchange="deleteErrorMessage('usuario_privilegio_error')">
								<option value="1" <?php if($campos['PRIVILEGIO']==1){ echo 'selected=""'; } ?>>Control total <?php if($campos['PRIVILEGIO']==1){ echo '(Actual)'; } ?></option>
								<option value="2"  <?php if($campos['PRIVILEGIO']==2){ echo 'selected=""'; } ?>>Edición <?php if($campos['PRIVILEGIO']==2){ echo '(Actual)'; } ?></option>
								<option value="3"  <?php if($campos['PRIVILEGIO']==3){ echo 'selected=""'; } ?>>Registrar <?php if($campos['PRIVILEGIO']==3){ echo '(Actual)'; } ?></option>
							</select>
							<div class='message-error' id="usuario_privilegio_error"></div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<?php } ?>
		<br><br><br>
		<fieldset>
			<p class="text-center">Para poder guardar los cambios en esta cuenta debe de ingresar su correo y contraseña</p>
			<div class="container-fluid">
				<div class="row">
				<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="email_admin" 
							id="email_admin" maxlength="150" required="" onchange="deleteErrorMessage('email_admin_error')">
							<div class='message-error' id="email_admin_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="clave_admin" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="clave_admin" 
							id="clave_admin" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('clave_admin_error')">
							<div class='message-error' id="clave_admin_error"></div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<?php if($cl->encryption($_SESSION['id_sa'])!=$pagina[2]){?>
			<input type="hidden" name="tipo_cuenta" value="Impropia">
		<?php }else{ ?>
			<input type="hidden" name="tipo_cuenta" value="Propia">
		<?php } ?> 

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