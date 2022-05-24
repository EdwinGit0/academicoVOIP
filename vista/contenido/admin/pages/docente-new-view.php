<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE
    </h3>
</div>
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>admin/docente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/docente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DOCENTES</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/docente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR DOCENTE</a>
        </li>
    </ul>
</div>


<div class="container-fluid">

	<!-- formulario -->

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/docenteAjax.php" method="POST" data-form="save" autocomplete="off" novalidate onsubmit="return teacher_new_validata()">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="docente_ci_reg" 
							id="docente_ci" maxlength="15" required="" onchange="deleteErrorMessage('docente_ci_error')">
							<div class='message-error' id="docente_ci_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="docente_nombre_reg" 
							id="docente_nombre" maxlength="30" required="" onchange="deleteErrorMessage('docente_nombre_error')">
							<div class='message-error' id="docente_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_apellidoP" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoP_reg" 
							id="docente_apellidoP" maxlength="50" required="" onchange="deleteErrorMessage('docente_apellidoP_error')">
							<div class='message-error' id="docente_apellidoP_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_apellidoM" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoM_reg" 
							id="docente_apellidoM" maxlength="50" required="" onchange="deleteErrorMessage('docente_apellidoM_error')">
							<div class='message-error' id="docente_apellidoM_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="docente_fechaNac_reg" 
							id="docente_fechaNac" required="" onchange="deleteErrorMessage('docente_fechaNac_error')">
							<div class='message-error' id="docente_fechaNac_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="docente_sexo" class="bmd-label-floating">Sexo</label>
                                <select class="form-control" name="docente_sexo_reg" 
								id="docente_sexo" required="" onchange="deleteErrorMessage('docente_sexo_error')">
                                    <option value="" selected="" disabled="">Seleccione una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
								<div class='message-error' id="docente_sexo_error"></div>
                            </div>
                        </div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaIng">Fecha de Ingreso</label>
							<input type="date" class="form-control" name="docente_fechaIng_reg" 
							id="docente_fechaIng" required="" onchange="deleteErrorMessage('docente_fechaIng_error')">
							<div class='message-error' id="docente_fechaIng_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="docente_telefono_reg" 
							id="docente_telefono" maxlength="15" required="" onchange="deleteErrorMessage('docente_telefono_error')">
							<div class='message-error' id="docente_telefono_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="docente_direccion_reg" 
							id="docente_direccion" maxlength="150" onchange="deleteErrorMessage('docente_direccion_error')">
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
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="docente_email_reg" 
							id="docente_email" maxlength="70" required="" onchange="deleteErrorMessage('docente_email_error')">
							<div class='message-error' id="docente_email_error"></div>
						</div>
					</div>
					<div class="col">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label for="docente_clave_1" class="bmd-label-floating">Contraseña</label>
								<input type="password" class="form-control" name="docente_clave_1_reg" 
								id="docente_clave_1" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('docente_clave_1_error')">
								<div class='message-error' id="docente_clave_1_error"></div>
							</div>
						</div>
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label for="docente_clave_2" class="bmd-label-floating">Repetir contraseña</label>
								<input type="password" class="form-control" name="docente_clave_2_reg" 
								id="docente_clave_2" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required="" onchange="deleteErrorMessage('docente_clave_2_error')">
								<div class='message-error' id="docente_clave_2_error"></div>
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
				<label for="docente_area" class="">Área</label>
				<div class="input-group">
					<input type="text" class="form-control form-block" name="docente_name_area_reg" id="docente_name_area" placeholder="Sin designar" disabled onchange="deleteErrorMessage('docente_id_area')">
					<input type="hidden" name="docente_id_area_reg" id="docente_id_area" required="">
					<div class="input-group-addon"></div>
					<button type="button" class="area-update btn btn-raised btn-info" onclick="buscar_area('')"><i class="fas fa-search-plus"></i></button>
				</div>
				<div class='message-error' id="docente_id_area_error"></div>
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
                
                <div class="container-fluid" id="tabla_areas"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php include_once "./vista/contenido/admin/inc/docente.php"; ?>
