<div class="full-box page-header">
  <h3 class="text-left">
    <i class="fas fa-book"></i> &nbsp; CUADERNO PEDAGÓGICO
  </h3>
</div>

<div class="container-fluid">
  <ul class="full-box list-unstyled page-nav-tabs">
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
      
          <div class="col-md-8">
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
      </div>
</div>

<br>
<div class="card cardCuaderno">
  <div class="container-fluid">
    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="cuadernoCp nav-link active" id="pills-afiliacion-tab" data-toggle="pill" href="#pills-afiliacion" role="tab" aria-selected="true"><i class="fas fa-clipboard-list"></i>&nbsp; CUADRO DE AFILIACIÓN</a>
      </li>

      <?php 
          require_once "./controlador/admin/controlador_periodo.php";
          $ins_periodo = new controlador_periodo();
          $datos_periodo = $ins_periodo->datos_periodo_controlador("Todo","");
          if($datos_periodo->rowCount()>=1){
              $campos_periodo = $datos_periodo->fetchAll();
              foreach($campos_periodo as $rows){ ?>
                <li class="nav-item">
                  <a class="cuadernoCp nav-link" id="pills-<?php echo $rows['COD_PER'];?>-tab" data-toggle="pill" href="#pills-<?php echo $rows['COD_PER'];?>" role="tab" aria-selected="false"><i class="fas fa-list-ol"></i>&nbsp; <?php echo $rows['NOMBRE_PER'];?></a>
                </li>
            <?php } 
          }
      ?>
      <li class="nav-item">
        <a class="cuadernoCp nav-link" id="pills-resumen-tab" data-toggle="pill" href="#pills-resumen" role="tab" aria-selected="false"><i class="fas fa-book"></i>&nbsp; RESUMEN PEDAGÓGICO</a>
      </li>
    </ul>
  </div>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-afiliacion" role="tabpanel">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header text-white bg-dark">
                    <div class="col-12 col-md-12">
                        <div class="input-group">
                            <div class="mr-auto"><h6>Registro y cuadro de afiliación </h6></div>
                            <div class="input-group-addon"></div>
                            <button type="button" class="btn btn-expand text-white" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> 
                </div>
                <div class="card-body" id="body_afiliacion">
                  <div class="text-center">Seleccione un curso por favor</div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        if($datos_periodo->rowCount()>=1){
            foreach($campos_periodo as $rows){ ?>
            <div class="tab-pane fade" id="pills-<?php echo $rows['COD_PER'];?>" role="tabpanel">
              <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header text-white bg-dark">
                        <div class="col-12 col-md-12">
                            <div class="input-group">
                                <div class="mr-auto"><h6>Registro de valoración - <?php echo $rows['NOMBRE_PER'];?> </h6></div>
                                <div class="input-group-addon"></div>
                                <button type="button" class="btn btn-expand text-white" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body" id="body-tabla<?php echo $rows['COD_PER'];?>">
                      <div class="text-center">Seleccione un curso por favor</div>
                    </div>
                </div>
              </div>
            </div>
          <?php } 
        }
    ?>

    <div class="tab-pane fade show" id="pills-resumen" role="tabpanel">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header text-white bg-dark">
                    <div class="col-12 col-md-12">
                        <div class="input-group">
                            <div class="mr-auto"><h6>Resumen / Registro pedagógico </h6></div>
                            <div class="input-group-addon"></div>
                            <button type="button" class="btn btn-expand text-white" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> 
                </div>
                <div class="card-body" id="body_resumen">
                  <div class="text-center">Seleccione un curso por favor</div>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>

<?php include_once "./vista/contenido/docente/inc/bookPedagogico.php"?>