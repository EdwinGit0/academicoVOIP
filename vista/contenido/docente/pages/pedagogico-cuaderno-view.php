<div class="full-box page-header">
  <h3 class="text-left">
    <i class="fas fa-book"></i> &nbsp; CUADERNO PEDAGÓGICO
  </h3>
</div>

<div class="container-fluid">
  <ul class="full-box list-unstyled page-nav-tabs">
    <li>
      <a href="<?php echo SERVERURL; ?>docente/alumno-list/"><i class="fas fa-user-graduate fa-fw"></i> &nbsp; LISTA DE ALUMNOS</a>
    </li>
    <li>
      <a class="active" href="<?php echo SERVERURL; ?>docente/pedagogico-cuaderno/"><i class="fas fa-book"></i> &nbsp; CUADERNO PEDAGÓGICO</a>
    </li>
    <li>
      <a href="<?php echo SERVERURL; ?>docente/pedagogico-registro/"><i class="fas fa-book"></i> &nbsp; REGISTRO PEDAGÓGICO</a>
    </li>
  </ul>	
</div>

<div class="container-fluid">

      <div class="row">
          <div class="col-md-4">
              <div class="card tree"  id="treeCurso">
              <?php
                  require_once "./controlador/docente/controlador_cuadernoP.php";
                  $ins_curso = new controlador_cuadernoP();
                  echo $ins_curso->tree_curso_controlador($_SESSION['id_sa']);
              ?>
              </div>
          </div>
          <div class="col">
            <div class="col-md-12">
                <input type="hidden" id="docente_id_curso" value="<?php echo $pagina[2]; ?>">
                <input type="hidden" id="docente_url_curso" value="<?php echo $pagina[1]; ?>">
                <div class="card card-primary">
                    <div class="card-header text-white bg-dark">
                        <div class="col-12 col-md-12">
                            <div class="input-group">
                                <div class="mr-auto"><h6>Datos referenciales </h6></div>
                                <div class="input-group-addon"></div>
                                <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body" id="body_referencial">
                      <div class="text-center">   Seleccione un curso por favor</div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header text-white bg-dark">
                        <div class="col-12 col-md-12">
                            <div class="input-group">
                                <div class="mr-auto"><h6>Registro y cuadro de afiliación </h6></div>
                                <div class="input-group-addon"></div>
                                <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body" id="body_afiliacion">
                      <div class="text-center">   Seleccione un curso por favor</div>
                    </div>
                </div>
            </div>
          </div>
      </div>

</div>

<?php include_once "./vista/contenido/docente/inc/bookPedagogico.php"?>