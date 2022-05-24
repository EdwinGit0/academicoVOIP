<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR DOCENTE
    </h3>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>admin/docente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE</a>
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

	<?php
		require_once "./controlador/admin/controlador_docente.php";
		$ins_docente = new controlador_docente();

		$datos_docente = $ins_docente->datos_docente_controlador("Unico",$pagina[2],"");

		if($datos_docente->rowCount()==1){
			$campos = $datos_docente->fetch();
	?>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/docenteAjax.php" method="POST" data-form="update" autocomplete="off" novalidate onsubmit="return teacher_update_validata()">
		<input type="hidden" name="docente_id_up" value="<?php echo $pagina[2]; ?>">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="docente_ci_up" 
							id="docente_ci" maxlength="15" value="<?php echo $campos['CI_P']; ?>" required="" onchange="deleteErrorMessage('docente_ci_error')">
							<div class='message-error' id="docente_ci_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="docente_nombre_up" 
							id="docente_nombre" maxlength="30" value="<?php echo $campos['NOMBRE_P']; ?>" required=""onchange="deleteErrorMessage('docente_nombre_error')">
							<div class='message-error' id="docente_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_apellido" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoP_up" 
							id="docente_apellidoP" maxlength="50" value="<?php echo $campos['APELLIDOP_P']; ?>" required=""onchange="deleteErrorMessage('docente_apellidoP_error')">
							<div class='message-error' id="docente_apellidoP_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_apellido" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoM_up" 
							id="docente_apellidoM" maxlength="50" value="<?php echo $campos['APELLIDOM_P']; ?>" required=""onchange="deleteErrorMessage('docente_apellidoM_error')">
							<div class='message-error' id="docente_apellidoM_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="docente_fechaNac_up" 
							id="docente_fecha_nac" value="<?php echo $campos['FECHANAC_P']; ?>" required=""onchange="deleteErrorMessage('docente_fecha_nac_error')">
							<div class='message-error' id="docente_fecha_nac_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_sexo" class="bmd-label-floating">Sexo</label>
							<select class="form-control" name="docente_sexo_up" 
							id="docente_sexo" required=""onchange="deleteErrorMessage('docente_sexo_error')">
								<option value="Masculino" <?php if($campos['SEXO_P'] == "Masculino"){ echo 'selected=""'; } ?>>Masculino</option>
								<option value="Femenino" <?php if($campos['SEXO_P'] == "Femenino"){ echo 'selected=""'; } ?>>Femenino</option>
							</select>
							<div class='message-error' id="docente_sexo_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaIng">Fecha de Ingreso</label>
							<input type="date" class="form-control" name="docente_fechaIng_up" 
							id="docente_fechaIng" value="<?php echo $campos['FECHA_INGRESO_P']; ?>" required=""onchange="deleteErrorMessage('docente_fechaIng_error')">
							<div class='message-error' id="docente_fechaIng_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="docente_telefono_up" 
							id="docente_telefono" maxlength="15" value="<?php echo $campos['TELEFONO_P']; ?>" required=""onchange="deleteErrorMessage('docente_telefono_error')">
							<div class='message-error' id="docente_telefono_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="docente_direccion_up" 
							id="docente_direccion" maxlength="150" value="<?php echo $campos['DIRECCION_P']; ?>"onchange="deleteErrorMessage('docente_direccion_error')">
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
							id="docente_email" maxlength="70" value="<?php echo $campos['CORREO_P']; ?>" required=""onchange="deleteErrorMessage('docente_email_error')">
							<div class='message-error' id="docente_email_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<span>Estado de la cuenta &nbsp; <?php if($campos['ESTADO_P'] == 1){ echo '<span class="badge badge-info">Activa</span>'; }else{ echo '<span class="badge badge-danger">Deshabilitada</span>'; }?></span>
							<select class="form-control" name="docente_estado_up">
								<option value="1" <?php if($campos['ESTADO_P'] == 1){ echo 'selected=""'; } ?>>Activa</option>
								<option value="0" <?php if($campos['ESTADO_P'] == 0){ echo 'selected=""'; } ?>>Deshabilitada</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<fieldset>
			<legend><i class="fas fa-user-plus"></i> &nbsp; Información adicional</legend>
			<div class="container-fluid">
				<label for="docente_educativo" class="">Establecimiento educativo</label>
				<div class="input-group">
					<input type="text" class="form-control form-block" name="docente_name_educativo_up" id="docente_name_educativo" value="<?php echo $campos['NOMBRE_UA']; ?>"  required="" disabled>
					<input type="hidden" name="docente_id_educativo_up" 
					id="docente_id_educativo" value="<?php echo main_model::encryption($campos['UA_ID']); ?>"  required=""onchange="deleteErrorMessage('docente_id_educativo_error')">
					<div class="input-group-addon"></div>
					<button type="button" class="btn btn-raised btn-info" data-toggle="modal" data-target="#ModalEducativo" id="docente_button_educativo"><i class="fas fa-search-plus"></i></button>
				</div>
				<div class='message-error' id="docente_id_educativo_error"></div>
				<br><br>
				<label for="docente_area" class="">Área</label>
				<div class="input-group">
					<input type="text" class="form-control form-block" name="docente_name_area_up" id="docente_name_area" value="<?php echo $campos['NOMBRE_AREA']; ?>"  required="" disabled>
					<input type="hidden" name="docente_id_area_up" 
					id="docente_id_area" value="<?php echo main_model::encryption($campos['COD_AREA']); ?>" required=""onchange="deleteErrorMessage('docente_id_area_error')">
					<div class="input-group-addon"></div>
					<button type="button" class="area-update btn btn-raised btn-info" onclick="buscar_area('<?php echo $pagina[2]; ?>')"><i class="fas fa-search-plus"></i></button>
				</div>
				<div class='message-error' id="docente_id_area_error"></div>
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
							id="docente_clave_nueva_1" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" onchange="deleteErrorMessage('docente_clave_nueva_1_error')">
							<div class='message-error' id="docente_clave_nueva_1_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="docente_clave_nueva_2" 
							id="docente_clave_nueva_2" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" onchange="deleteErrorMessage('docente_clave_nueva_2_error')">
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

<!-- MODAL ESTABLECIMIENTO -->
<div class="modal fade" id="ModalEducativo" tabindex="-1" role="dialog" aria-labelledby="ModalEducativo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEducativo">Agregar establecimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_educativo" class="bmd-label-floating">Código, Nombre</label>
                        <input type="text" class="form-control" name="input_educativo" 
						id="input_educativo" required="" onchange="deleteErrorMessage('input_educativo_error')">
						<div class='message-error' id="input_educativo_error"></div>
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_educativos"></div>

            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="buscar_educativo()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
				&nbsp; &nbsp;
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
        </div>
    </div>
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