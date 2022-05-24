<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-building fa-fw"></i> &nbsp; INFORMACÓN DEL ESTABLECIMIENTO EDUCATIVO
    </h3>
</div>

<?php
    require_once "./controlador/admin/controlador_educativo.php";
    $ins_educativo = new controlador_educativo();

    $datos_educativo = $ins_educativo->datos_educativo_controlador($_SESSION['id_sa']);

    if($datos_educativo->rowCount()==0){
?>

<div class="alert alert-warning text-center" role="alert">
    <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
    <h4 class="alert-heading">¡Usted no pertenece a un Establecimiento educativo!</h4>
    <p class="mb-0">Puede crear un nueva Establecimiento o registrarse en una ya existenete en <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEducativo"><i class="fas fa-building"></i> &nbsp; Agregar Establecimiento</button></p>
</div>

<div class="container-fluid">
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/educativoAjax.php" method="POST" data-form="save" autocomplete="off" novalidate onsubmit="return company_new_validata()">
        <input type="hidden" name="admin_id_up" value="<?php echo $cl->encryption($_SESSION['id_sa']); ?>">
        <fieldset>
            <legend><i class="far fa-building"></i> &nbsp; Datos Generales</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_codigo" class="bmd-label-floating">Código RUE</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,20}" class="form-control" name="educativo_codigo_reg" 
                            id="educativo_codigo" maxlength="20" required="" onchange="deleteErrorMessage('educativo_codigo_error')">
                            <div class='message-error' id="educativo_codigo_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_nombre" class="bmd-label-floating">Nombre</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,150}" class="form-control" name="educativo_nombre_reg" 
                            id="educativo_nombre" maxlength="150" required="" onchange="deleteErrorMessage('educativo_nombre_error')">
                            <div class='message-error' id="educativo_nombre_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                        <label for="educativo_dependecia" class="bmd-label-floating">Dependencia</label>
							<select class="form-control" name="educativo_dependecia_reg" 
                            id="educativo_dependecia" required="" onchange="deleteErrorMessage('educativo_dependecia_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="Fiscal">Fiscal</option>
							</select>
                            <div class='message-error' id="educativo_dependecia_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_descripcion" class="bmd-label-floating">Descripción</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,255}" class="form-control" name="educativo_descripcion_reg" 
                            id="educativo_descripcion" maxlength="255" onchange="deleteErrorMessage('educativo_descripcion_error')">
                            <div class='message-error' id="educativo_descripcion_error"></div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <fieldset>
            <legend><i class="far fa-building"></i> &nbsp; Localización del Establecimiento educativo</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                        <label for="educativo_dpto" class="bmd-label-floating">Departamento</label>
							<select class="form-control" name="educativo_dpto_reg" 
                            id="educativo_dpto" required="" onchange="deleteErrorMessage('educativo_dpto_error')">
								<option value="" selected="" disabled="">Seleccione una opción</option>
								<option value="Beni">Beni</option>
								<option value="Chuquisaca">Chuquisaca</option>
                                <option value="Cochabamba">Cochabamba</option>
								<option value="La Paz">La Paz</option>
                                <option value="Oruro">Oruro</option>
								<option value="Pando">Pando</option>
                                <option value="Potosí">Potosí</option>
								<option value="Santa Cruz">Santa Cruz</option>
                                <option value="Tarija">Tarija</option>
							</select>
                            <div class='message-error' id="educativo_dpto_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_localidad" class="bmd-label-floating">Localidad</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="educativo_localidad_reg" 
                            id="educativo_localidad" maxlength="150" onchange="deleteErrorMessage('educativo_localidad_error')">
                            <div class='message-error' id="educativo_localidad_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_direccion" class="bmd-label-floating">Dirección</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}" class="form-control" name="educativo_direccion_reg" 
                            id="educativo_direccion" maxlength="255" onchange="deleteErrorMessage('educativo_direccion_error')">
                            <div class='message-error' id="educativo_direccion_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_distrito" class="bmd-label-floating">Distrito</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="educativo_distrito_reg" 
                            id="educativo_distrito" maxlength="255" onchange="deleteErrorMessage('educativo_distrito_error')">
                            <div class='message-error' id="educativo_distrito_error"></div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <fieldset>
            <legend><i class="far fa-building"></i> &nbsp; Niveles / Áreas de atención</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <span>Niveles Autorizados</span>
                            <input type="text" class="form-control form-block" value="Secundaria Comunitaria Productiva" disabled>
                        </div>
                    </div>
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

<?php 
    }elseif($datos_educativo->rowCount()==1 && ($_SESSION['privilegio_sa']==1 || $_SESSION['privilegio_sa']==2)){ 
        $campos=$datos_educativo->fetch();
?>

<div class="container-fluid">
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/admin/educativoAjax.php" method="POST" data-form="update" autocomplete="off" novalidate onsubmit="return company_new_validata()">
        <input type="hidden" name="educativo_id_up" value="<?php echo $campos['UA_ID']; ?>">
        <fieldset>
            <legend><i class="far fa-building"></i> &nbsp; Datos Generales</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_codigo" class="bmd-label-floating">Código RUE</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,20}" class="form-control" name="educativo_codigo_up" 
                            id="educativo_codigo" maxlength="20" value="<?php echo $campos['COD_UA']; ?>" required="" onchange="deleteErrorMessage('educativo_codigo_error')">
                            <div class='message-error' id="educativo_codigo_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_nombre" class="bmd-label-floating">Nombre</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,150}" class="form-control" name="educativo_nombre_up" 
                            id="educativo_nombre" maxlength="150" value="<?php echo $campos['NOMBRE_UA']; ?>" required="" onchange="deleteErrorMessage('educativo_nombre_error')">
                            <div class='message-error' id="educativo_nombre_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                        <label for="educativo_dependecia" class="bmd-label-floating">Dependencia</label>
							<select class="form-control" name="educativo_dependecia_up" 
                            id="educativo_dependecia" required="" onchange="deleteErrorMessage('educativo_dependecia_error')">
								<option value="Fiscal" <?php if($campos['DEPENDENCIA_UA'] == "Fiscal"){ echo 'selected=""'; } ?>>Fiscal</option>
							</select>
                            <div class='message-error' id="educativo_dependecia_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_descripcion" class="bmd-label-floating">Descripción</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,255}" class="form-control" name="educativo_descripcion_up" 
                            id="educativo_descripcion" maxlength="255" value="<?php echo $campos['DESCRIPCION_UA']; ?>" onchange="deleteErrorMessage('educativo_descripcion_error')">
                            <div class='message-error' id="educativo_descripcion_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
						<div class="form-group">
							<span>Estado del establecimiento &nbsp; <?php if($campos['ESTADO_UA'] == 1){ echo '<span class="badge badge-info">Abierto</span>'; }else{ echo '<span class="badge badge-danger">Cerrado</span>'; }?></span>
							<select class="form-control" name="educativo_estado_up">
								<option value="1" <?php if($campos['ESTADO_UA'] == 1){ echo 'selected=""'; } ?>>Abierto</option>
								<option value="0" <?php if($campos['ESTADO_UA'] == 0){ echo 'selected=""'; } ?>>Cerrado</option>
							</select>
						</div>
					</div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <fieldset>
            <legend><i class="fas fa-map-marked-alt"></i> &nbsp; Localización del Establecimiento educativo</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                        <label for="educativo_dpto" class="bmd-label-floating">Departamento</label>
							<select class="form-control" name="educativo_dpto_up" 
                            id="educativo_dpto" required="" onchange="deleteErrorMessage('educativo_dpto_error')">
								<option value="Beni" <?php if($campos['DPTO_UA'] == "Beni"){ echo 'selected=""'; } ?>>Beni</option>
								<option value="Chuquisaca" <?php if($campos['DPTO_UA'] == "Chuquisaca"){ echo 'selected=""'; } ?>>Chuquisaca</option>
                                <option value="Cochabamba" <?php if($campos['DPTO_UA'] == "Cochabamba"){ echo 'selected=""'; } ?>>Cochabamba</option>
								<option value="La Paz" <?php if($campos['DPTO_UA'] == "La Paz"){ echo 'selected=""'; } ?>>La Paz</option>
                                <option value="Oruro" <?php if($campos['DPTO_UA'] == "Oruro"){ echo 'selected=""'; } ?>>Oruro</option>
								<option value="Pando" <?php if($campos['DPTO_UA'] == "Pando"){ echo 'selected=""'; } ?>>Pando</option>
                                <option value="Potosí" <?php if($campos['DPTO_UA'] == "Potosí"){ echo 'selected=""'; } ?>>Potosí</option>
								<option value="Santa Cruz" <?php if($campos['DPTO_UA'] == "Santa Cruz"){ echo 'selected=""'; } ?>>Santa Cruz</option>
                                <option value="Tarija" <?php if($campos['DPTO_UA'] == "Tarija"){ echo 'selected=""'; } ?>>Tarija</option>
							</select>
                            <div class='message-error' id="educativo_dpto_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_localidad" class="bmd-label-floating">Localidad</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="educativo_localidad_up" 
                            id="educativo_localidad" value="<?php echo $campos['LOCALIDAD_UA']; ?>" maxlength="150" onchange="deleteErrorMessage('educativo_localidad_error')">
                            <div class='message-error' id="educativo_localidad_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_direccion" class="bmd-label-floating">Dirección</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}" class="form-control" name="educativo_direccion_up" 
                            id="educativo_direccion" value="<?php echo $campos['DIRECCION_UA']; ?>" maxlength="255" onchange="deleteErrorMessage('educativo_direccion_error')">
                            <div class='message-error' id="educativo_direccion_error"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_distrito" class="bmd-label-floating">Distrito</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="educativo_distrito_up" 
                            id="educativo_distrito" maxlength="255" value="<?php echo $campos['DISTRITO_UA']; ?>" onchange="deleteErrorMessage('educativo_distrito_error')">
                            <div class='message-error' id="educativo_distrito_error"></div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <fieldset>
            <legend><i class="fas fa-layer-group"></i> &nbsp; Niveles / Áreas de atención</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <span>Niveles Autorizados</span>
                            <input type="text" class="form-control form-block" value="Secundaria Comunitaria Productiva" disabled>
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
</div>

<?php }else{ ?>

<div class="alert alert-danger text-center" role="alert">
    <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
    <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
    <p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
</div>

<?php } ?>

<!-- MODAL ESTABLECIMIENTO -->
<div class="modal fade" id="ModalEducativo" tabindex="-1" role="dialog" aria-labelledby="ModalEducativo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEducativo">Asignar Establecimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_educativo" class="bmd-label-floating">Código, Nombre</label>
                        <input type="text" class="form-control" name="input_educativo" 
                        id="input_educativo" required="" onchange="deleteErrorMessage('input_educativo_error')" >
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

<?php include_once "./vista/contenido/admin/inc/company.php"; ?>