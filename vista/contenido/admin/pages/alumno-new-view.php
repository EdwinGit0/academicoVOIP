<div class="full-box page-header mb-0 y pb-0">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR ALUMNO
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

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/alumnoAjax.php" method="POST" data-form="save" autocomplete="off" novalidate onsubmit="return student_new_validata()">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="alumno_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="alumno_ci_reg" id="alumno_ci" maxlength="15" required="" onchange="deleteErrorMessage('alumno_ci_error')">
							<div class='message-error' id="alumno_ci_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="alumno_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="alumno_nombre_reg" id="alumno_nombre" maxlength="30" required="" onchange="deleteErrorMessage('alumno_nombre_error')">
							<div class='message-error' id="alumno_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="alumno_apellidoP" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="alumno_apellidoP_reg" id="alumno_apellidoP" maxlength="50" required="" onchange="deleteErrorMessage('alumno_apellidoP_error')">
							<div class='message-error' id="alumno_apellidoP_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="alumno_apellidoM" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="alumno_apellidoM_reg" id="alumno_apellidoM" maxlength="50" required="" onchange="deleteErrorMessage('alumno_apellidoM_error')">
							<div class='message-error' id="alumno_apellidoM_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="alumno_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="alumno_fechaNac_reg" id="alumno_fechaNac" required="" onchange="deleteErrorMessage('alumno_fechaNac_error')">
							<div class='message-error' id="alumno_fechaNac_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="alumno_sexo" class="bmd-label-floating">Sexo</label>
							<select class="form-control" name="alumno_sexo_reg" id="alumno_sexo" required="" onchange="deleteErrorMessage('alumno_sexo_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
							</select>
							<div class='message-error' id="alumno_sexo_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="alumno_lugarNac" class="bmd-label-floating">Lugar de nacimiento</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="alumno_lugarNac_reg" id="alumno_lugarNac" maxlength="150" required="" onchange="deleteErrorMessage('alumno_lugarNac_error')">
							<div class='message-error' id="alumno_lugarNac_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="alumno_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="alumno_email_reg" id="alumno_email" maxlength="70" onchange="deleteErrorMessage('alumno_email_error')">
							<div class='message-error' id="alumno_email_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="alumno_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="alumno_direccion_reg" id="alumno_direccion" maxlength="150" onchange="deleteErrorMessage('alumno_direccion_error')">
							<div class='message-error' id="alumno_direccion_error"></div>
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
							<label for="alumno_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="alumno_telefono_reg" id="alumno_telefono" maxlength="15" required="" onchange="deleteErrorMessage('alumno_telefono_error')">
							<div class='message-error' id="alumno_telefono_error"></div>
						</div>
					</div>
					<div class="col">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="alumno_clave_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="alumno_clave_1_reg" id="alumno_clave_1" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('alumno_clave_1_error')">
							<div class='message-error' id="alumno_clave_1_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="alumno_clave_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="alumno_clave_2_reg" id="alumno_clave_2" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('alumno_clave_2_error')">
							<div class='message-error' id="alumno_clave_2_error"></div>
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
				<label for="docente_tutor_reg" class="">Tutor</label>
				<div id="docente_tutor_reg">
					<div class="input-group" id="itemDate">
							<input type="text" class="form-control form-block" name="field_name[]" placeholder="Sin designar" disabled>
							<input type="hidden" name="field_id[]">
						<span class="input-group-addon"> </span>
							<button type="button" class="item-update btn btn-raised btn-info" data-toggle="modal" data-target="#ModalPadre"><i class="fas fa-search-plus"></i></button>
						<span class="input-group-addon"> </span>
					</div>
					
					<div class="col-12 col-md-12" id="item-add">
						<p class="text-right" style="padding-top: 1.5rem">
							<button type="button" class="btn btn-success" onclick="add();">
								<i class="mi-add"></i>AGREGAR +
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
			<button type="submit" class="btn btn-raised btn-info btn-sm" name="Enviar"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>

<!-- MODAL TUTOR -->
<div class="modal fade" id="ModalPadre" tabindex="-1" role="dialog" aria-labelledby="ModalPadre" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalPadre">Agregar tutor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_padre" class="bmd-label-floating">CI, Nombre, Apellido</label>
                        <input type="text" class="form-control" name="input_padre" id="input_padre" required="" onchange="deleteErrorMessage('input_padre_error')">
						<div class='message-error' id="input_padre_error"></div>
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_padres"></div>

            </div>
            <div class="modal-footer">
				<div class="input-group">
					<button type="button" class="btn btn-danger mr-auto" onclick="vaciar_campo()"><i class="fas fa-trash-alt"></i> &nbsp; Quitar seleccionado</button>
					<button type="button" class="btn btn-primary" onclick="buscar_padre()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
					&nbsp; &nbsp;
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vista/contenido/admin/inc/alumno.php"; ?>
