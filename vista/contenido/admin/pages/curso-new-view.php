<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR CURSO
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
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/cursoAjax.php" method="POST" data-form="save" autocomplete="off" novalidate onsubmit="return course_new_validata()">
		<fieldset>
			<legend><i class="far fa-plus-square"></i> &nbsp; Información del curso</legend>
			<div class="container-fluid">
				<div class="row">	
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="curso_turno" class="bmd-label-floating">Turno</label>
							<select class="form-control" name="curso_turno_reg" 
							id="curso_turno" required="" onchange="deleteErrorMessage('curso_turno_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="Mañana">Mañana</option>
								<option value="Tarde">Tarde</option>
								<option value="Noche">Noche</option>
							</select>
							<div class='message-error' id="curso_turno_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="curso_grado" class="bmd-label-floating">Grado</label>
							<select class="form-control" name="curso_grado_reg" 
							id="curso_grado" required="" onchange="deleteErrorMessage('curso_grado_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="Primero">Primero</option>
								<option value="Segundo">Segundo</option>
								<option value="Tercero">Tercero</option>
								<option value="Cuarto">Cuarto</option>
								<option value="Quinto">Quinto</option>
								<option value="Sexto">Sexto</option>
							</select>
							<div class='message-error' id="curso_grado_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="curso_seccion" class="bmd-label-floating">sección</label>
							<select class="form-control" name="curso_seccion_reg" 
							id="curso_seccion" required="" onchange="deleteErrorMessage('curso_seccion_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
								<option value="F">F</option>
								<option value="G">G</option>
								<option value="H">H</option>
								<option value="I">I</option>
								<option value="J">J</option>
								<option value="K">K</option>
								<option value="L">L</option>
								<option value="M">M</option>
							</select>
							<div class='message-error' id="curso_seccion_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="curso_capacidad" class="bmd-label-floating">Capacidad</label>
							<input type="text" pattern="[0-9]{1,2}" class="form-control" name="curso_capacidad_reg" 
							id="curso_capacidad" maxlength="2" required="" onchange="deleteErrorMessage('curso_capacidad_error')">
							<div class='message-error' id="curso_capacidad_error"></div>
						</div>
					</div>
                    <input type="hidden" name="curso_creado_reg" id="curso_creado" value="<?php echo date("Y-m-d H:i:s");?>">
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