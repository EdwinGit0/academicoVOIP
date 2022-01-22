<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR DOCENTE
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque laudantium necessitatibus eius iure adipisci modi distinctio. Earum repellat iste et aut, ullam, animi similique sed soluta tempore cum quis corporis!
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>docente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR DOCENTE</a>
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

	<?php
		require_once "./controlador/controlador_docente.php";
		$ins_docente = new controlador_docente();

		$datos_docente = $ins_docente->datos_docente_controlador("Unico",$pagina[1],"");

		if($datos_docente->rowCount()==1){
			$campos = $datos_docente->fetch();
	?>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/docenteAjax.php" method="POST" data-form="update" autocomplete="off">
		<input type="hidden" name="docente_id_up" value="<?php echo $pagina[1]; ?>">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="docente_ci_up" id="docente_ci" maxlength="15" value="<?php echo $campos['CI_P']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="docente_nombre_up" id="docente_nombre" maxlength="30" value="<?php echo $campos['NOMBRE_P']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_apellido" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoP_up" id="docente_apellidoP" maxlength="50" value="<?php echo $campos['APELLIDOP_P']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="docente_apellido" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="docente_apellidoM_up" id="docente_apellidoM" maxlength="50" value="<?php echo $campos['APELLIDOM_P']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="docente_fechaNac_up" id="docente_fecha_nac" value="<?php echo $campos['FECHANAC_P']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_sexo" class="bmd-label-floating">Sexo</label>
							<select class="form-control" name="docente_sexo_up" id="docente_sexo" required="">
								<option value="Masculino" <?php if($campos['SEXO_P'] == "Masculino"){ echo 'selected=""'; } ?>>Masculino</option>
								<option value="Femenino" <?php if($campos['SEXO_P'] == "Femenino"){ echo 'selected=""'; } ?>>Femenino</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="docente_fechaIng">Fecha de Ingreso</label>
							<input type="date" class="form-control" name="docente_fechaIng_up" id="docente_fechaIng" value="<?php echo $campos['FECHA_INGRESO_P']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="docente_telefono_up" id="docente_telefono" maxlength="15" value="<?php echo $campos['TELEFONO_P']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="docente_direccion_up" id="docente_direccion" maxlength="150" value="<?php echo $campos['DIRECCION_P']; ?>">
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
							<input type="email" class="form-control" name="docente_email_up" id="docente_email" maxlength="70" value="<?php echo $campos['CORREO_P']; ?>" required="">
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
			<legend style="margin-top: 40px;"><i class="fas fa-lock"></i> &nbsp; Nueva contraseña</legend>
			<p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla debe dejar vacíos los dos campos de las contraseñas.</p>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="docente_clave_nueva_1" id="docente_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="docente_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="docente_clave_nueva_2" id="docente_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
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