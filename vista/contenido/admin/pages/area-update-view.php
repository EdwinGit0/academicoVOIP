<?php
	if($_SESSION['privilegio_sa']<1 || $_SESSION['privilegio_sa']>2){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; ACTUALIZAR PERIODO
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
		require_once "./controlador/admin/controlador_area.php";

		$ins_area = new controlador_area();

		$datos_area = $ins_area->datos_area_controlador("Unico",$pagina[2]);

		if($datos_area->rowCount()==1){
			$campos = $datos_area->fetch();
	?>
 
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/areaAjax.php" method="POST" data-form="update" autocomplete="off" novalidate onsubmit="return area_new_validata()">
        <input type="hidden" name="area_id_up" value="<?php echo $pagina[2]; ?>">
        <fieldset>
			<legend><i class="far fa-plus-square"></i> &nbsp; Información del área</legend>
			<div class="container-fluid">
				<div class="row">	
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="area_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,50}" class="form-control" name="area_nombre_up" 
							id="area_nombre" maxlength="50" value="<?php echo $campos['NOMBRE_AREA']; ?>" required="" onchange="deleteErrorMessage('area_nombre_error')">
							<div class='message-error' id="area_nombre_error"></div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="area_campo" class="bmd-label-floating">Campo</label>
							<select class="form-control" name="area_campo_up" 
							id="area_campo" required="" onchange="deleteErrorMessage('area_campo_error')">
								<option value="Ciencia, Tecnología y Producción" <?php if($campos['CAMPO_AREA'] == "Ciencia, Tecnología y Producción"){ echo 'selected=""'; } ?>>Ciencia, Tecnología y Producción</option>
								<option value="Comunidad y Sociedad" <?php if($campos['CAMPO_AREA'] == "Comunidad y Sociedad"){ echo 'selected=""'; } ?>>Comunidad y Sociedad</option>
								<option value="Tierra Territorio" <?php if($campos['CAMPO_AREA'] == "Tierra Territorio"){ echo 'selected=""'; } ?>>Tierra Territorio</option>
								<option value="Cosmos y Pensamiento" <?php if($campos['CAMPO_AREA'] == "Cosmos y Pensamiento"){ echo 'selected=""'; } ?>>Cosmos y Pensamiento</option>
							</select>
							<div class='message-error' id="area_campo_error"></div>
						</div>
					</div>
                    <div class="col-12 col-md-12">
						<div class="form-group">
							<label for="area_info" class="bmd-label-floating">Información</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}" class="form-control" name="area_info_up" 
							id="area_info" maxlength="255" value="<?php echo $campos['INFO']; ?>" onchange="deleteErrorMessage('area_info_error')">
							<div class='message-error' id="area_info_error"></div>
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