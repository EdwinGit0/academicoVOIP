<?php 
	if($_SESSION['privilegio_sa']!=1){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header mb-0 y pb-0">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO ADMINISTRADOR
	</h3>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>admin/user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO ADMINISTRADOR</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>admin/user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ADMINISTRADOR</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>admin/user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/usuarioAjax.php" method="POST" data-form="save" autocomplete="off" novalidate onsubmit="return admin_new_validata()">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_nombre" class="bmd-label-floating">Nombres</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="usuario_nombre_reg" 
							id="usuario_nombre" maxlength="30" required="" onchange="deleteErrorMessage('usuario_nombre_error')">
							<div class='message-error' id="usuario_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_apellidoP" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="usuario_apellidoP_reg" 
							id="usuario_apellidoP" maxlength="50" required="" onchange="deleteErrorMessage('usuario_apellidoP_error')">
							<div class='message-error' id="usuario_apellidoP_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_apellidoM" class="bmd-label-floating">Apellidos Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="usuario_apellidoM_reg" 
							id="usuario_apellidoM" maxlength="50" required="" onchange="deleteErrorMessage('usuario_apellidoM_error')">
							<div class='message-error' id="usuario_apellidoM_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="usuario_telefono_reg" 
							id="usuario_telefono" maxlength="15" onchange="deleteErrorMessage('usuario_telefono_error')">
							<div class='message-error' id="usuario_telefono_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,255}" class="form-control" name="usuario_direccion_reg" 
							id="usuario_direccion" maxlength="255" onchange="deleteErrorMessage('usuario_direccion_error')">
							<div class='message-error' id="usuario_direccion_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="usuario_tipo" class="bmd-label-floating">Tipo de usuario</label>
							<select class="form-control" name="usuario_tipo_reg" 
							id="usuario_tipo" required="" onchange="deleteErrorMessage('usuario_tipo_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="Administrador">Administrador</option>
								<option value="Director">Director</option>
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
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="usuario_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="usuario_email_reg" 
							id="usuario_email" maxlength="150" required="" onchange="deleteErrorMessage('usuario_email_error')">
							<div class='message-error' id="usuario_email_error"></div>
						</div>
					</div>
					<div class="col">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="usuario_clave_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="usuario_clave_1_reg" 
							id="usuario_clave_1" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('usuario_clave_1_error')">
							<div class='message-error' id="usuario_clave_1_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="usuario_clave_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="usuario_clave_2_reg" 
							id="usuario_clave_2" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('usuario_clave_2_error')">
							<div class='message-error' id="usuario_clave_2_error"></div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</fieldset>
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
							<select class="form-control" name="usuario_privilegio_reg" 
							id="usuario_privilegio" required="" onchange="deleteErrorMessage('usuario_privilegio_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="1">Control total</option>
								<option value="2">Edición</option>
								<option value="3">Registrar</option>
							</select>
							<div class='message-error' id="usuario_privilegio_error"></div>
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