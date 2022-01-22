<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-spell-check"></i> &nbsp; SECCIÓN
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium quod harum vitae, fugit quo soluta. Molestias officiis voluptatum delectus doloribus at tempore, iste optio quam recusandae numquam non inventore dolor.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVERURL; ?>academico-seccion/"><i class="fas fa-spell-check"></i> &nbsp; SECCIÓN</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>academico-grado/"> <i class="fas fa-list-ol"></i> &nbsp; GRADO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>academico-periodo/"><i class="fas fa-layer-group"></i> &nbsp; PERIODO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>academico-area/"><i class="fas fa-book"></i> &nbsp; ÁREA</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>academico-anio/"><i class="fas fa-tasks"></i> &nbsp; AÑO ACADÉMICO</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
	<div class="container-fluid form-neon">
        <div class="container-fluid">
            <p class="text-center roboto-medium">REGISTRAR Ó AGREGAR</p>
            <p class="text-center">
                <?php if(empty($_SESSION['datos_docente'])){ ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalDocente"><i class="fas fa-user-plus"></i> &nbsp; Agregar docente</button>
                <?php } ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAlumno"><i class="fas fa-box-open"></i> &nbsp; Agregar alumno</button>
            </p>
            <div>
                <span class="roboto-medium">CLIENTE:</span> 

                <?php if(empty($_SESSION['datos_docente'])){ ?>

                <span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione un cliente</span>
      			
                <?php }else{ ?>

                <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/seccionAjax.php" method="POST" data-form="load" style="display: inline-block !important;">
                    <input type="hidden" name="id_eliminar_docente" value="<?php echo $_SESSION['datos_docente']['ID']; ?>">
                	<?php echo $_SESSION['datos_docente']['Nombre']." ".$_SESSION['datos_docente']['ApellidoP']." ".$_SESSION['datos_docente']['ApellidoM']." (".$_SESSION['datos_docente']['CI'].")"; ?>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-user-times"></i></button>
                </form>

                <?php } ?>

            </div>
            <div class="table-responsive">
                <table class="table table-dark table-sm">
                    <thead>
                        <tr class="text-center roboto-medium">
                            <th>ITEM</th>
                            <th>CANTIDAD</th>
                            <th>TIEMPO</th>
                            <th>COSTO</th>
                            <th>SUBTOTAL</th>
                            <th>DETALLE</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_SESSION['datos_alumno']) && count($_SESSION['datos_alumno'])>=1){
                                $_SESSION['cantidad_alumno']=0;
                                foreach($_SESSION['datos_alumno'] as $alumnos){
        
                        ?>
                        <tr class="text-center" >
                            <td><?php echo $alumnos['Nombre'] ?></td>
                            <td><?php echo $alumnos['Cantidad'] ?></td>
                            <td><?php echo $alumnos['Tiempo']." ".$alumnos['Formato'] ?></td>
                            <td><?php echo $alumnos['Costo']." x1" ?></td>
                            <td>$35.00</td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="Nombre del item" data-content="Detalle completo del item">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </td>
                            <td>
                                <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/seccionAjax.php" method="POST" data-form="load" autocomplete="off">
                                    <input type="hidden" name="id_eliminar_alumno" value="<?php echo $alumnos['ID']; ?>">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                                    
                        <?php 
                                $_SESSION['cantidad_alumno']=+1;
                            } 
                        }else{
                        ?>

                        <tr class="text-center" >
                            <td colspan="7">No has seleccionado alumnos</td>
                        </tr>

                         <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        

		<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/seccionAjax.php" method="POST" data-form="save" autocomplete="off">
            <fieldset>
                <legend><i class="far fa-clock"></i> &nbsp; Fecha y hora de préstamo</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="prestamo_fecha_inicio">Fecha de préstamo</label>
                                <input type="date" class="form-control" name="prestamo_fecha_inicio_reg" id="prestamo_fecha_inicio" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="prestamo_hora_inicio">Hora de préstamo</label>
                                <input type="time" class="form-control" name="prestamo_hora_inicio_reg" value="<?php echo date("H:i"); ?>" id="prestamo_hora_inicio">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><i class="fas fa-history"></i> &nbsp; Fecha y hora de entrega</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="prestamo_fecha_final">Fecha de entrega</label>
                                <input type="date" class="form-control" name="prestamo_fecha_final_reg" id="prestamo_fecha_final">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="prestamo_hora_final">Hora de entrega</label>
                                <input type="time" class="form-control" name="prestamo_hora_final_reg" id="prestamo_hora_final">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
			<fieldset>
				<legend><i class="fas fa-cubes"></i> &nbsp; Otros datos</legend>
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="prestamo_estado" class="bmd-label-floating">Estado</label>
                                <select class="form-control" name="prestamo_estado_reg" id="prestamo_estado">
                                    <option value="" selected="">Seleccione una opción</option>
                                    <option value="Reservacion">Reservación</option>
                                    <option value="Prestamo">Préstamo</option>
                                    <option value="Finalizado">Finalizado</option>
                                </select>
                            </div>
                        </div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="prestamo_total" class="bmd-label-floating">Total a pagar en <?php echo MONEDA ?></label>
                                <input type="text" pattern="[0-9.]{1,10}" class="form-control" readonly="" value="100.00" id="prestamo_total" maxlength="10">
							</div>
						</div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="prestamo_pagado" class="bmd-label-floating">Total depositado en <?php echo MONEDA ?></label>
                                <input type="text" pattern="[0-9.]{1,10}" class="form-control" name="prestamo_pagado_reg" id="prestamo_pagado" maxlength="10">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prestamo_observacion" class="bmd-label-floating">Observación</label>
                                <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ#() ]{1,400}" class="form-control" name="prestamo_observacion_reg" id="prestamo_observacion" maxlength="400">
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
</div>


<!-- MODAL DOCENTE -->
<div class="modal fade" id="ModalDocente" tabindex="-1" role="dialog" aria-labelledby="ModalDocente" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalDocente">Agregar Docente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_cliente" class="bmd-label-floating">CI, Nombre, Apellido, Telefono</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_docente" id="input_docente" maxlength="30">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_docentes"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_docente()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL ALUMNO -->
<div class="modal fade" id="ModalAlumno" tabindex="-1" role="dialog" aria-labelledby="ModalAlumno" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAlumno">Agregar alumno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_alumno" class="bmd-label-floating">CI, Nombre, Apellido, Telefono</label>
                        <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_alumno" id="input_alumno" maxlength="30">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_alumnos"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_alumno()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR ITEM -->
<div class="modal fade" id="ModalSeccion" tabindex="-1" role="dialog" aria-labelledby="ModalSeccion" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content FormularioAjax" action="<?php echo SERVERURL; ?>ajax/seccionAjax.php" method="POST" data-form="default" autocomplete="off">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalSeccion">Selecciona el formato, cantidad de items, tiempo y costo del préstamo del item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_agregar_seccion" id="id_agregar_seccion">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="detalle_formato" class="bmd-label-floating">Formato de préstamo</label>
                                <select class="form-control" name="detalle_formato" id="detalle_formato">
                                    <option value="Horas" selected="" >Horas</option>
                                    <option value="Dias">Días</option>
                                    <option value="Evento">Evento</option>
                                    <option value="Mes">Mes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="detalle_cantidad" class="bmd-label-floating">Cantidad de items</label>
                                <input type="num" pattern="[0-9]{1,7}" class="form-control" name="detalle_cantidad" id="detalle_cantidad" maxlength="7" required="" >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="detalle_tiempo" class="bmd-label-floating">Tiempo (según formato)</label>
                                <input type="num" pattern="[0-9]{1,7}" class="form-control" name="detalle_tiempo" id="detalle_tiempo" maxlength="7" required="" >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="detalle_costo_tiempo" class="bmd-label-floating">Costo por unidad de tiempo</label>
                                <input type="text" pattern="[0-9.]{1,15}" class="form-control" name="detalle_costo_tiempo" id="detalle_costo_tiempo" maxlength="15" required="" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Agregar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" onclick="modal_buscar_alumno()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<?php include_once "./vista/inc/seccion.php"; ?>