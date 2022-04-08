<?php
	if($_SESSION['privilegio_sa']<1 || $_SESSION['privilegio_sa']>2){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; ACTUALIZAR PERIODO
    </h3>
    <hr align="center" width="95%"/>
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
		require_once "./controlador/admin/controlador_anio.php";
		$ins_anio = new controlador_anio();

		$datos_anio = $ins_anio->datos_anio_controlador("Unico",$pagina[2]);

		if($datos_anio->rowCount()==1){
			$campos = $datos_anio->fetch();
	?>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/anioAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="anio_id_up" value="<?php echo $pagina[2]; ?>">
        <fieldset>
			<legend><i class="far fa-plus-square"></i> &nbsp; Información de la sección</legend>
			<div class="container-fluid">
				<div class="row">	
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="anio_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{4,5}" class="form-control" name="anio_nombre_up" id="anio_nombre" maxlength="5" value="<?php echo $campos['NOMBRE_ANIO']; ?>" required="">
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