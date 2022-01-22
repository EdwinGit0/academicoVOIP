<?php
	if($_SESSION['privilegio_sa']<1 || $_SESSION['privilegio_sa']>2){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR ALUMNO
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
		require_once "./controlador/controlador_alumno.php";
		$ins_alumno = new controlador_alumno();

		$datos_alumno = $ins_alumno->datos_alumno_controlador("Unico",$pagina[1],"");

		if($datos_alumno->rowCount()==1){
			$campos = $datos_alumno->fetch();
	?>

	<?php

		require_once "./controlador/controlador_educativo.php";
		require_once "./controlador/controlador_grado.php";
		require_once "./controlador/controlador_seccion.php";
		$ins_educativo = new controlador_educativo();
		$ins_grado = new controlador_grado();
		$ins_seccion = new controlador_seccion();

		$datos_educativo = $ins_educativo->datos_educativo_alumno_controlador($cl->encryption($campos['UA_ID']));
		$datos_educativo = $datos_educativo->fetch();
		$datos_grado = $ins_grado->datos_grado_controlador("Unico",$cl->encryption($campos['COD_GRA']));
		$datos_grado = $datos_grado->fetch();
		$datos_seccion = $ins_seccion->datos_seccion_controlador("Unico",$cl->encryption($campos['COD_SEC']));
		$datos_seccion = $datos_seccion->fetch();
	?>

	<p class="text-center">
        <?php if(empty($datos_educativo)){ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEducativo"><i class="fas fa-building fa-fw"></i> &nbsp; Agregar establecimiento</button>
        <?php } ?>
		<?php if(empty($datos_grado)){ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalGrado"><i class="fas fa-list-ol"></i> &nbsp; Agregar grado</button>
        <?php } ?>
		<?php if(empty($datos_seccion)){ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalSeccion"><i class="fas fa-spell-check"></i> &nbsp; Agregar seccón</button>
        <?php } ?>
   	</p>
	   
			<!-- ESTRUCTURA ESTABLECIMIENTO -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-4 text-center">
				<span class="roboto-medium">ESTABLECIMIENTO:</span> 

				<?php if(empty($datos_educativo)){ ?>

				<span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione un establecimiento</span>
				
				<?php }else{ ?>

				<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/alumnoAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
					<input type="hidden" name="id_eliminar_educativo_up" value="<?php echo $cl->encryption($datos_educativo['UA_ID']); ?>">
					<input type="hidden" name="id_eliminar_alumno_up" value="<?php echo $cl->encryption($campos['ALUMNO_ID']); ?>">
					<?php echo $datos_educativo['NOMBRE_UA']." (".$datos_educativo['COD_UA'].")"; ?>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalEducativo"><i class="fas fa-edit"></i></button>
				</form>

				<?php } ?>
			</div>

			<!-- ESTRUCTURA GRADO -->
			<div class="col-12 col-md-4 text-center">
				<span class="roboto-medium">GRADO:</span> 

				<?php if(empty($datos_grado)){ ?>

				<span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione un grado</span>
				
				<?php }else{ ?>

				<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/alumnoAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
					<input type="hidden" name="id_eliminar_grado_up" value="<?php echo $cl->encryption($datos_grado['COD_GRA']); ?>">
					<input type="hidden" name="id_eliminar_alumno_up" value="<?php echo $cl->encryption($campos['ALUMNO_ID']); ?>">
					<?php echo $datos_grado['NOMBRE_GRA']." (".$datos_grado['CREADO_GRA'].")"; ?>
					<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
				</form>

				<?php } ?>
			</div>

			<!-- ESTRUCTURA SECCION -->

			<div class="col-12 col-md-4 text-center">
				<span class="roboto-medium">SECCIÓN:</span> 

				<?php if(empty($datos_seccion)){ ?>

				<span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione una sección</span>
				
				<?php }else{ ?>

				<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/alumnoAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
					<input type="hidden" name="id_eliminar_seccion_up" value="<?php echo $cl->encryption($datos_seccion['COD_SEC']); ?>">
					<input type="hidden" name="id_eliminar_alumno_up" value="<?php echo $cl->encryption($campos['ALUMNO_ID']); ?>">
					<?php echo $datos_seccion['NOMBRE_SEC']." (".$datos_seccion['CREADO_SEC'].")"; ?>
					<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
				</form>

				<?php } ?>

			</div>
		</div>
	</div>
	<br><br>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/alumnoAjax.php" method="POST" data-form="update" autocomplete="off">
		<input type="hidden" name="alumno_id_up" value="<?php echo $pagina[1]; ?>">
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
                        <input type="hidden" id="educativo_id" value="<?php echo $pagina[1]; ?>">
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

<!-- MODAL GRADO -->
<div class="modal fade" id="ModalGrado" tabindex="-1" role="dialog" aria-labelledby="ModalGrado" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalGrado">Agregar grado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_grado" class="bmd-label-floating">Nombre, Creado</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_grado" id="input_grado" maxlength="30">
                        <input type="hidden" id="grado_id" value="<?php echo $pagina[1]; ?>">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_grados"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_grado()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SECCION -->
<div class="modal fade" id="ModalSeccion" tabindex="-1" role="dialog" aria-labelledby="ModalSeccion" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalSeccion">Agregar sección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_seccion" class="bmd-label-floating">Nombre, Creado</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_seccion" id="input_seccion" maxlength="30">
                        <input type="hidden" id="seccion_id" value="<?php echo $pagina[1]; ?>">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_seccions"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_seccion()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vista/inc/alumno.php"; ?>