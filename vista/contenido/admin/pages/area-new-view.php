<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR ÁREA
    </h3>
</div>
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>admin/curso-list/"><i class="fas fa-spell-check"></i> &nbsp; CURSO</a>
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

	<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/areaAjax.php" method="POST" data-form="save" autocomplete="off" novalidate onsubmit="return area_new_validata()">
		<fieldset>
			<legend><i class="far fa-plus-square"></i> &nbsp; Información del área</legend>
			<div class="container-fluid">
				<div class="row">	
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="area_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,50}" class="form-control" name="area_nombre_reg" 
							id="area_nombre" maxlength="50" required="" onchange="deleteErrorMessage('area_nombre_error')">
							<div class='message-error' id="area_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="area_campo" class="bmd-label-floating">Campo</label>
							<select class="form-control" name="area_campo_reg" 
							id="area_campo" required="" onchange="deleteErrorMessage('area_campo_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="Ciencia, Tecnología y Producción">Ciencia, Tecnología y Producción</option>
								<option value="Comunidad y Sociedad">Comunidad y Sociedad</option>
								<option value="Tierra Territorio">Tierra Territorio</option>
								<option value="Cosmos y Pensamiento">Cosmos y Pensamiento</option>
							</select>
							<div class='message-error' id="area_campo_error"></div>
						</div>
					</div>
                    <div class="col-12 col-md-12">
						<div class="form-group">
							<label for="area_info" class="bmd-label-floating">Información</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}" class="form-control" name="area_info_reg" 
							id="area_info" maxlength="255" onchange="deleteErrorMessage('area_info_error')">
							<div class='message-error' id="area_info_error"></div>
						</div>
					</div>
                    <input type="hidden" name="area_creado_reg" id="area_creado" value="<?php echo date("Y-m-d");?>">
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