<?php
	if($_SESSION['privilegio_sa']<1 || $_SESSION['privilegio_sa']>2){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; ACTUALIZAR CURSO
    </h3>
</div>
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a  href="<?php echo SERVERURL; ?>admin/curso-list/"><i class="fas fa-spell-check"></i> &nbsp; CURSO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/periodo-list/"><i class="fas fa-layer-group"></i> &nbsp; PERIODO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/area-list/"><i class="fas fa-book"></i> &nbsp; ÁREA</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>admin/anio-list/"><i class="fas fa-tasks"></i> &nbsp; AÑO ACADÉMICO</a>
        </li>
    </ul>
</div>

<div class="container-fluid">

    <?php
		require_once "./controlador/admin/controlador_curso.php";
		$ins_curso = new controlador_curso();

		$datos_curso = $ins_curso->datos_curso_controlador("Unico",$pagina[2]);

		if($datos_curso->rowCount()==1){
			$campos = $datos_curso->fetch();
	?>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/cursoAjax.php" method="POST" data-form="update" autocomplete="off" novalidate onsubmit="return course_new_validata()">
        <input type="hidden" name="curso_id_up" value="<?php echo $pagina[2]; ?>">
        <fieldset>
			<legend><i class="far fa-plus-square"></i> &nbsp; Información de la curso</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="curso_turno" class="bmd-label-floating">Turno</label>
							<select class="form-control" name="curso_turno_up" 
							id="curso_turno" required="" onchange="deleteErrorMessage('curso_turno_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="Mañana" <?php if($campos['TURNO_CUR'] == "Mañana"){ echo 'selected=""'; } ?>>Mañana</option>
								<option value="Tarde" <?php if($campos['TURNO_CUR'] == "Tarde"){ echo 'selected=""'; } ?>>Tarde</option>
								<option value="Noche" <?php if($campos['TURNO_CUR'] == "Noche"){ echo 'selected=""'; } ?>>Noche</option>
							</select>
							<div class='message-error' id="curso_turno_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="curso_grado" class="bmd-label-floating">Grado</label>
							<select class="form-control" name="curso_grado_up" 
							id="curso_grado" required="" onchange="deleteErrorMessage('curso_grado_error')">
								<option value="Primero" <?php if($campos['GRADO_CUR'] == "Primero"){ echo 'selected=""'; } ?>>Primero</option>
								<option value="Segundo" <?php if($campos['GRADO_CUR'] == "Segundo"){ echo 'selected=""'; } ?>>Segundo</option>
								<option value="Tercero" <?php if($campos['GRADO_CUR'] == "Tercero"){ echo 'selected=""'; } ?>>Tercero</option>
								<option value="Cuarto" <?php if($campos['GRADO_CUR'] == "Cuarto"){ echo 'selected=""'; } ?>>Cuarto</option>
								<option value="Quinto" <?php if($campos['GRADO_CUR'] == "Quinto"){ echo 'selected=""'; } ?>>Quinto</option>
								<option value="Sexto" <?php if($campos['GRADO_CUR'] == "Sexto"){ echo 'selected=""'; } ?>>Sexto</option>
							</select>
							<div class='message-error' id="curso_grado_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="curso_seccion" class="bmd-label-floating">sección</label>
							<select class="form-control" name="curso_seccion_up" 
							id="curso_seccion" required="" onchange="deleteErrorMessage('curso_seccion_error')">
								<option value="A" <?php if($campos['SECCION_CUR'] == "A"){ echo 'selected=""'; } ?>>A</option>
								<option value="B" <?php if($campos['SECCION_CUR'] == "B"){ echo 'selected=""'; } ?>>B</option>
								<option value="C" <?php if($campos['SECCION_CUR'] == "C"){ echo 'selected=""'; } ?>>C</option>
								<option value="D" <?php if($campos['SECCION_CUR'] == "D"){ echo 'selected=""'; } ?>>D</option>
								<option value="E" <?php if($campos['SECCION_CUR'] == "E"){ echo 'selected=""'; } ?>>E</option>
								<option value="F" <?php if($campos['SECCION_CUR'] == "F"){ echo 'selected=""'; } ?>>F</option>
								<option value="G" <?php if($campos['SECCION_CUR'] == "G"){ echo 'selected=""'; } ?>>G</option>
								<option value="H" <?php if($campos['SECCION_CUR'] == "H"){ echo 'selected=""'; } ?>>H</option>
								<option value="I" <?php if($campos['SECCION_CUR'] == "I"){ echo 'selected=""'; } ?>>I</option>
								<option value="J" <?php if($campos['SECCION_CUR'] == "J"){ echo 'selected=""'; } ?>>J</option>
								<option value="K" <?php if($campos['SECCION_CUR'] == "K"){ echo 'selected=""'; } ?>>K</option>
								<option value="L" <?php if($campos['SECCION_CUR'] == "L"){ ecHo 'selected=""'; } ?>>L</option>
								<option value="M" <?php if($campos['SECCION_CUR'] == "M"){ echo 'selected=""'; } ?>>M</option>
							</select>
							<div class='message-error' id="curso_seccion_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="curso_capacidad" class="bmd-label-floating">Capacidad</label>
							<input type="text" pattern="[0-9]{1,2}" class="form-control" name="curso_capacidad_up" 
							id="curso_capacidad" maxlength="2" value="<?php echo $campos['CAPACIDAD_CUR']; ?>" required="" onchange="deleteErrorMessage('curso_capacidad_error')">
							<div class='message-error' id="curso_capacidad_error"></div>
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