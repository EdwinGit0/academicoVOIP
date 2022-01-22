<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR ÁREA
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque laudantium necessitatibus eius iure adipisci modi distinctio. Earum repellat iste et aut, ullam, animi similique sed soluta tempore cum quis corporis!
    </p>
</div>
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>curso-list/"><i class="fas fa-spell-check"></i> &nbsp; CURSO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>periodo-list/"><i class="fas fa-layer-group"></i> &nbsp; PERIODO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>area-list/"><i class="fas fa-book"></i> &nbsp; ÁREA</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>anio-list/"><i class="fas fa-tasks"></i> &nbsp; AÑO ACADÉMICO</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
    <p class="text-center">
        <?php if(empty($_SESSION['datos_anio'])){ ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAnio"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar año académico</button>
        <?php } ?>
    </p>
    <div>
        <span class="roboto-medium">AÑO ACADÉMICO:</span> 

        <?php if(empty($_SESSION['datos_anio'])){ ?>

        <span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione un año académico</span>
        
        <?php }else{ ?>

        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/areaAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
            <input type="hidden" name="id_eliminar_anio" value="<?php echo $_SESSION['datos_anio']['ID']; ?>">
            <?php echo $_SESSION['datos_anio']['Nombre']." (".$_SESSION['datos_anio']['Creado'].")"; ?>
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
        </form>

        <?php } ?>

    </div>

	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/areaAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="far fa-plus-square"></i> &nbsp; Información del área</legend>
			<div class="container-fluid">
				<div class="row">	
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="area_nombre" class="bmd-label-floating">Nombre</label>
							<input type="text" pattern="[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]{1,50}" class="form-control" name="area_nombre_reg" id="area_nombre" maxlength="50" required="">
						</div>
					</div>
                    <div class="col-12 col-md-6">
						<div class="form-group">
							<label for="area_info" class="bmd-label-floating">Información</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}" class="form-control" name="area_info_reg" id="area_info" maxlength="255">
						</div>
					</div>
                    <input type="hidden" name="area_creado_reg" id="area_creado" value="<?php echo date("Y-m-d H:i:s");?>">
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

<!-- MODAL ANIO -->
<div class="modal fade" id="ModalAnio" tabindex="-1" role="dialog" aria-labelledby="ModalAnio" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAnio">Agregar año académico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_anio" class="bmd-label-floating">Nombre, Creado</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_anio" id="input_anio" maxlength="30">
                        <input type="hidden" id="area_id" value="">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_anios"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_anio()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vista/inc/area.php"; ?>