<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; ASIGNACIÓN AGREGAR
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
            require_once "./controlador/admin/controlador_educativo.php";
            $ins_educativo = new controlador_educativo();
            $datos_educativo = $ins_educativo->datos_educativo_alumno_controlador(main_model::encryption($_SESSION['ua_id']));
            if($datos_educativo->rowCount()==1){
                $campos_educativo = $datos_educativo->fetch();
        ?>

        <div class="card" style="padding-top: 0.1rem">
            <div class="row">
                <div class="col-md-4">
                    <div class="card tree"  id="treeCurso">
                    <?php
                        require_once "./controlador/admin/controlador_asignacion.php";
                        $ins_alumno = new controlador_asignacion();
                        echo $ins_alumno->tree_curso_controlador();
                    ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="hidden" id="alumno_id_curso" value="<?php echo $pagina[2]; ?>">
                    <input type="hidden" id="alumno_url_cursop" value="<?php echo $pagina[1]; ?>">
                    <div class="card card-primary" id="asignarCurso">
                        <div class="card-header text-white bg-dark">
                            <div class="col-12 col-md-12">
                                <div class="input-group">
                                    <div class="mr-auto"><h6>Turno: </h6></div>
                                    <div class="input-group-addon"></div>
                                    <button type="button" class="btn btn-raised btn-success" disabled><i class="fas fa-plus fa-fw"></i> &nbsp; Añadir</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{ ?>

            <div class="alert alert-warning text-center" role="alert">
                <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                <h4 class="alert-heading">¡Usted no pertenece a un Establecimiento educativo!</h4>
                <p class="mb-0">Puede crear un nueva Establecimiento o registrarse en una ya existenete en  <a href="<?php echo SERVERURL; ?>admin/company/"> &nbsp; Establecimiento educativo</a></p>
            </div>

        <?php } ?>
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
                        <label for="input_alumno" class="bmd-label-floating">CI, Nombre, Apellido</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_alumno" id="input_alumno" maxlength="30">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_alumnos"></div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="alumno_fechaIni">Fecha inicio asignación</label>
                            <input type="date" class="form-control" name="alumno_fechaIni_asig" id="alumno_fechaIni" value="<?php echo date("Y-01-01");?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="alumno_fechaFin">Fecha fin asignación</label>
                            <input type="date" class="form-control" name="alumno_fechaFin_asig" id="alumno_fechaFin" value="<?php echo date("Y-12-31");?>">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modalCurso" onclick="buscar_alumno()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DOCENTE -->
<div class="modal fade" id="ModalDocente" tabindex="-1" role="dialog" aria-labelledby="ModalDocente" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalDocente">Agregar docente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_docente" class="bmd-label-floating">CI, Nombre, Apellido, Área</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_docente" id="input_docente" maxlength="30">
                    </div>
                </div>
                <br>

                <div class="container-fluid" id="tabla_docentes"></div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="docente_fechaIni">Fecha inicio asignación</label>
                                <input type="date" class="form-control" name="docente_fechaIni_asig" id="docente_fechaIni" value="<?php echo date("Y-m-d");?>" required="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="docente_fechaFin">Fecha fin asignación</label>
                                <input type="date" class="form-control" name="docente_fechaFin_asig" id="docente_fechaFin" value="<?php echo date("Y-m-t");?>" required="">
                            </div>
                        </div>
                        <div class="col align-self-end">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input class="custom-control-input" type="checkbox" id="docente_responsable">
                                    <label class="custom-control-label" for="docente_responsable">Docente responsable del año de escolaridad</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modalCurso" onclick="buscar_docente()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vista/contenido/admin/inc/asignacion.php"; ?>