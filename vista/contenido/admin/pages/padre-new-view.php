<div class="full-box page-header mb-0 y pb-0">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR TUTOR
	</h3>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>admin/alumno-list/"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; ALUMNO</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>admin/padre-list/"><i class="fas fa-users fa-fw"></i> &nbsp; TUTOR</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<!-- formulario -->
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/padreAjax.php" method="POST" data-form="save" autocomplete="off" novalidate onsubmit="return parent_new_validata()">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="padre_ci_reg" 
							id="padre_ci" maxlength="15" required="" onchange="deleteErrorMessage('padre_ci_error')">
							<div class='message-error' id="padre_ci_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="padre_nombre_reg" 
							id="padre_nombre" maxlength="30" required="" onchange="deleteErrorMessage('padre_nombre_error')">
							<div class='message-error' id="padre_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_apellidoP" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="padre_apellidoP_reg" 
							id="padre_apellidoP" maxlength="50" required="" onchange="deleteErrorMessage('padre_apellidoP_error')">
							<div class='message-error' id="padre_apellidoP_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="padre_apellidoM" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="padre_apellidoM_reg" 
							id="padre_apellidoM" maxlength="50" required="" onchange="deleteErrorMessage('padre_apellidoM_error')">
							<div class='message-error' id="padre_apellidoM_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="padre_fechaNac_reg" 
							id="padre_fechaNac" required="" onchange="deleteErrorMessage('padre_fechaNac_error')">
							<div class='message-error' id="padre_fechaNac_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="padre_sexo" class="bmd-label-floating">Sexo</label>
                                <select class="form-control" name="padre_sexo_reg" 
								id="padre_sexo" required="" onchange="deleteErrorMessage('padre_sexo_error')">
                                    <option value="" selected="" disabled="">Seleccione una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
								<div class='message-error' id="padre_sexo_error"></div>
                            </div>
                        </div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="padre_email_reg" 
							id="padre_email" maxlength="70" onchange="deleteErrorMessage('padre_email_error')">
							<div class='message-error' id="padre_email_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="padre_rol" class="bmd-label-floating">Rol</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,50}" class="form-control" name="padre_rol_reg" 
							id="padre_rol" maxlength="50" required="" onchange="deleteErrorMessage('padre_rol_error')">
							<div class='message-error' id="padre_rol_error"></div>
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
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="padre_telefono_reg" 
							id="padre_telefono" maxlength="15" required="" onchange="deleteErrorMessage('padre_telefono_error')">
							<div class='message-error' id="padre_telefono_error"></div>
						</div>
					</div>
					<div class="col">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="padre_clave_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="padre_clave_1_reg" 
							id="padre_clave_1" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('padre_clave_1_error')">
							<div class='message-error' id="padre_clave_1_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="padre_clave_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="padre_clave_2_reg" 
							id="padre_clave_2" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('padre_clave_2_error')">
							<div class='message-error' id="padre_clave_2_error"></div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<fieldset>
			<legend><i class="fas fa-user-plus"></i> &nbsp; Información adicional</legend>
			<div class="container-fluid">
				<label for="alumno_reg" class="">Tutor de:</label>
				<div id="alumno_reg">
					<div class="input-group" id="itemDate">
						<input type="text" class="form-control form-block" name="field_name[]" placeholder="Sin designar" disabled>
						<input type="hidden" name="field_id[]">
						<span class="input-group-addon"></span>
						<button type="button" class="item-update btn btn-raised btn-info" data-toggle="modal" data-target="#ModalAlumno" name="0"><i class="fas fa-search-plus"></i></button>
						<span class="input-group-addon"></span>
					</div>

					<div class="col-12 col.md-12" id="item-add">
						<p class="text-right" style="padding-top: 1.5rem">
							<button type="button" class="btn btn-success" onclick="add();">
								<i class="mi-add">AGREGAR +</i>
							</button>
						</p>
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

<!-- MODAL ALUMNO -->
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
                        <input type="text" class="form-control" name="input_alumno" 
						id="input_alumno" required="" onchange="deleteErrorMessage('input_alumno_error')">
						<div class='message-error' id="input_alumno_error"></div>
					</div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_alumnos"></div>

            </div>
            <div class="modal-footer">
				<div class="input-group">
					<button type="button" class="btn btn-danger mr-auto" onclick="vaciar_campo()"><i class="fas fa-trash-alt"></i> &nbsp; Quitar seleccionado</button>
					<button type="button" class="btn btn-primary" onclick="buscar_alumno()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
					&nbsp; &nbsp;
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vista/contenido/admin/inc/padre.php"; ?>