<?php
	if($_SESSION['privilegio_sa']<1 || $_SESSION['privilegio_sa']>2){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header mb-0 y pb-0">
	<h3 class="text-left">
		<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR ALUMNO
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

	<?php
		require_once "./controlador/admin/controlador_alumno.php";
		$ins_alumno = new controlador_alumno();

		$datos_alumno = $ins_alumno->datos_alumno_controlador("Unico",$pagina[2],"");

		if($datos_alumno->rowCount()==1){
			$campos = $datos_alumno->fetch();
	?>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/alumnoAjax.php" method="POST" data-form="update" autocomplete="off">
		<input type="hidden" name="alumno_id_up" value="<?php echo $pagina[2]; ?>">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="alumno_ci" class="bmd-label-floating">CI</label>
							<input type="text" pattern="[0-9-]{5,15}" class="form-control" name="alumno_ci_up" id="alumno_ci" maxlength="15" value="<?php echo $campos['CI_A']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="alumno_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,30}" class="form-control" name="alumno_nombre_up" id="alumno_nombre" maxlength="30" value="<?php echo $campos['NOMBRE_A']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="alumno_apellido" class="bmd-label-floating">Apellido Paterno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="alumno_apellidoP_up" id="alumno_apellidoP" maxlength="50" value="<?php echo $campos['APELLIDOP_A']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="alumno_apellido" class="bmd-label-floating">Apellido Materno</label>
							<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" class="form-control" name="alumno_apellidoM_up" id="alumno_apellidoM" maxlength="50" value="<?php echo $campos['APELLIDOM_A']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="alumno_fechaNac">Fecha de Nacimiento</label>
							<input type="date" class="form-control" name="alumno_fechaNac_up" id="alumno_fecha_nac" value="<?php echo $campos['FECHANAC_A']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="alumno_sexo" class="bmd-label-floating">Sexo</label>
							<select class="form-control" name="alumno_sexo_up" id="alumno_sexo" required="">
								<option value="Masculino"  <?php if($campos['SEXO_A'] == "Masculino"){ echo 'selected=""'; } ?>>Masculino</option>
								<option value="Femenino"  <?php if($campos['SEXO_A'] == "Femenino"){ echo 'selected=""'; } ?>>Femenino</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="alumno_lugarNac" class="bmd-label-floating">Lugar de nacimiento</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="alumno_lugarNac_up" id="alumno_lugarNac" maxlength="150" value="<?php echo $campos['LUGARNAC_A']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="alumno_email" class="bmd-label-floating">Correo</label>
							<input type="email" class="form-control" name="alumno_email_up" id="alumno_email" maxlength="70" value="<?php echo $campos['CORREO_A']; ?>">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="alumno_direccion" class="bmd-label-floating">Dirección</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="alumno_direccion_up" id="alumno_direccion" maxlength="150" value="<?php echo $campos['DIRECCION_A']; ?>">
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
							<label for="alumno_telefono" class="bmd-label-floating">Teléfono</label>
							<input type="text" pattern="[0-9()+]{7,15}" class="form-control" name="alumno_telefono_up" id="alumno_telefono" maxlength="15" value="<?php echo $campos['TELEFONO_A']; ?>" required="">
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<span>Estado de la cuenta &nbsp; <?php if($campos['ESTADO_A'] == 1){ echo '<span class="badge badge-info">Activa</span>'; }else{ echo '<span class="badge badge-danger">Deshabilitada</span>'; }?></span>
							<select class="form-control" name="alumno_estado_up">
								<option value="1" <?php if($campos['ESTADO_A'] == 1){ echo 'selected=""'; } ?>>Activa</option>
								<option value="0" <?php if($campos['ESTADO_A'] == 0){ echo 'selected=""'; } ?>>Deshabilitada</option>
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
				<label for="alumno_educativo" class="">Establecimiento educativo</label>
				<div class="input-group">
					<input type="text" class="form-control form-block" name="alumno_name_educativo_up" id="alumno_name_educativo" value="<?php echo $campos['NOMBRE_UA']; ?>" required="" disabled>
					<input type="hidden" name="alumno_id_educativo_up" id="alumno_id_educativo" value="<?php echo main_model::encryption($campos['UA_ID']); ?>" required="">
					<div class="input-group-addon"></div>
					<button type="button" class="btn btn-raised btn-info" data-toggle="modal" data-target="#ModalEducativo" id="alumno_button_educativo"><i class="fas fa-search-plus"></i></button>
				</div>
				<br><br>
				<label for="docente_tutor_reg" class="">Tutores</label>
				<div id="docente_tutor_reg">
					<div class="input-group" id="itemDate">
						<input type="text" class="form-control form-block" name="field_name[]" placeholder="Sin designar" disabled>
						<input type="hidden" name="field_id[]">
						<div class="input-group-addon"></div>
						<button type="button" class="item-update btn btn-raised btn-info" data-toggle="modal" data-target="#ModalPadre"><i class="fas fa-search-plus"></i></button>
						<div class="input-group-addon"></div>
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
		<fieldset>
			<legend style="margin-top: 40px;"><i class="fas fa-lock"></i> &nbsp; Nueva contraseña</legend>
			<p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla debe dejar vacíos los dos campos de las contraseñas.</p>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="alumno_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
							<input type="password" class="form-control" name="alumno_clave_nueva_1" id="alumno_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="alumno_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
							<input type="password" class="form-control" name="alumno_clave_nueva_2" id="alumno_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
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
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_educativo" id="input_educativo" maxlength="30">
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
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_padre" id="input_padre" maxlength="30">
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
<?php 
	echo "<script>";
	echo "llenar_datos_tutor('$pagina[2]');";
	echo "</script>"; 
?>
			