<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-building fa-fw"></i> &nbsp; INFORMACÓN DEL ESTABLECIMIENTO EDUCATIVO
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero nam eaque nostrum, voluptates, rerum quo. Consequuntur ut, maxime? Quibusdam ipsum maxime non veritatis dignissimos qui reiciendis, amet eum nihil! Et!
    </p>
</div>

<?php
    require_once "./controlador/controlador_educativo.php";
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
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/educativoAjax.php" method="POST" data-form="save" autocomplete="off">
        <input type="hidden" name="admin_id_up" value="<?php echo $cl->encryption($_SESSION['id_sa']); ?>">
        <fieldset>
            <legend><i class="far fa-building"></i> &nbsp; Información del establecimiento</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_codigo" class="bmd-label-floating">Código</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,20}" class="form-control" name="educativo_codigo_reg" id="educativo_codigo" maxlength="20" required="">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_nombre" class="bmd-label-floating">Nombre</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,150}" class="form-control" name="educativo_nombre_reg" id="educativo_nombre" maxlength="150" required="">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_direccion" class="bmd-label-floating">Dirección</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="educativo_direccion_reg" id="educativo_direccion" maxlength="150">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_descripcion" class="bmd-label-floating">Descripción</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,255}" class="form-control" name="educativo_descripcion_reg" id="educativo_descripcion" maxlength="255">
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
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/educativoAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="educativo_id_up" value="<?php echo $campos['UA_ID']; ?>">
        <fieldset>
            <legend><i class="far fa-building"></i> &nbsp; Información del establecimiento</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_codigo" class="bmd-label-floating">Código</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,20}" class="form-control" name="educativo_codigo_up" id="educativo_codigo" maxlength="20" value="<?php echo $campos['COD_UA']; ?>" required="">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_nombre" class="bmd-label-floating">Nombre</label>
                            <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{3,150}" class="form-control" name="educativo_nombre_up" id="educativo_nombre" maxlength="150" value="<?php echo $campos['NOMBRE_UA']; ?>" required="">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_direccion" class="bmd-label-floating">Dirección</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,150}" class="form-control" name="educativo_direccion_up" id="educativo_direccion" maxlength="150" value="<?php echo $campos['DIRECCION_UA']; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="educativo_descripcion" class="bmd-label-floating">Descripción</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,255}" class="form-control" name="educativo_descripcion_up" id="educativo_descripcion" maxlength="255" value="<?php echo $campos['DESCRIPCION_UA']; ?>">
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

<?php include_once "./vista/inc/company.php"; ?>