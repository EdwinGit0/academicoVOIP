<div class="full-box page-header mb-0 y pb-0">
    <h3 class="text-left">
		<i class="fas fa-calendar"></i> &nbsp; AGENDA DE CONFERENCIAS
    </h3>
</div>

<!-- Content here-->
<div class="container-fluid">
  <dvi class="row">
    <div class="col"></div>
    <div class='col-10'>
      <div id='calendar'></div>
      <div id='error'></div>
    </div>
    <div class="col"></div>
  </dvi>
</div>

<!-- MODAL AGENDA -->
<div class="modal fade" id="ModalAgenda" tabindex="-1" role="dialog" aria-labelledby="ModalAgenda" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agenda-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                  <form  action="" method="POST" id="form-agenda" autocomplete="off" novalidate >
                  <input type="hidden" id="agenda_id_up">
                    <div class="row">
                      <div class="col-12 col-md-12">
                        <div class="form-group">
                          <label for="agenda_titulo">Titulo</label>
                          <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{3,255}" class="form-control" name="agenda_titulo_reg" id="agenda_titulo" maxlength="255" required="" onchange="deleteErrorMessage('agenda_titulo_error')">
                          <div class='message-error' id="agenda_titulo_error"></div>
                        </div>
                      </div>
                      <div class="col-12 col-md-12">
                        <div class="form-group">
                          <label for="agenda_descripcion">Descripción</label>
                          <textarea class="form-control" name="agenda_descripcion_reg" id="agenda_descripcion"></textarea>
                        </div>
                      </div>
                      <div class="col-12 col-md-12">
                        <div class="form-group">
                          <label for="agenda_curso">Curso</label>
                          <select class="form-control" name="agenda_curso_reg" id="agenda_curso" required="" onchange="deleteErrorMessage('agenda_curso_error')">
                            
                          </select>
                          <div class='message-error' id="agenda_curso_error"></div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="form-group">
                          <label for="agenda_start">Fecha inicio</label>
                          <input type="datetime-local" class="form-control" name="agenda_start_reg" id="agenda_start" required="" onchange="deleteErrorMessage('agenda_start_error')">
                          <div class='message-error' id="agenda_start_error"></div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="form-group">
                          <label for="agenda_end">Fecha fin</label>
                          <input type="datetime-local" class="form-control" name="agenda_end_reg" id="agenda_end" onchange="deleteErrorMessage('agenda_end_error')">
                          <div class='message-error' id="agenda_end_error"></div>
                        </div>
                      </div>
                      <div class="col-12 col-md-4">
                          <label for="agenda_sala">N° Sala</label>
                          <input type="text" class="form-control form-block" name="agenda_sala_reg" id="agenda_sala" disabled>
                      </div>
                      <div class="col-12 col-md-4">
                        <div class="form-group">
                          <label for="agenda_color">Color</label>
                          <input type="color" class="form-control" list="rainbow" name="agenda_color_reg" id="agenda_color" required="" value="#007bff" onchange="deleteErrorMessage('agenda_color_error')">
                            <datalist id="rainbow">
                              <option value="#007bff">azul</option>
                              <option value="#6c757d">gris</option>
                              <option value="#28a745">verde</option>
                              <option value="#dc3545">rojo</option>
                              <option value="#ffc107">amarillo</option>
                              <option value="#17a2b8">celeste</option>
                            </datalist>
                            <div class='message-error' id="agenda_color_error"></div>
                        </div>
                      </div>
                      <div class="col-12 col-md-4">
                        <div class="form-group">
                          <label for="agenda_max">Cantidad maxima</label>
                          <select class="form-control" name="agenda_max_reg" id="agenda_max" required="" onchange="deleteErrorMessage('agenda_max_error')">
                            <option value="" selected="" disabled="">Seleccione una opción</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="40">40</option>
                            <option value="60">60</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                          </select>
                          <div class='message-error' id="agenda_max_error"></div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-save"><i class="far fa-save"></i> &nbsp; Guardar</button>
              <button type="button" class="btn btn-danger" id="btn-delete"><i class="fas fa-trash-alt"></i> &nbsp; Eliminar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar:{
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      visibleRange: {
        start: '2022-03-22',
        end: '2023-03-25'
      },

      dateClick: function(info) {
        let start = new Date(info.dateStr.replace(/-/g, '\/'));
        if(start){
          start.setMinutes(start.getMinutes() - start.getTimezoneOffset());
          start = start.toISOString().slice(0, 16)
        }
        $('#agenda-title').html("Sin titulo");
        document.getElementById("form-agenda").reset();
        $('#agenda_curso').val("");
        $('#agenda_id_up').val("");
        $('#agenda_start').val(start);
        $('#agenda_end').val(start);
        $('#btn-delete').hide();
        $('#ModalAgenda').modal('show');
        //calendar.addEvent({title: 'evento', start:info.dateStr});
      },
      eventClick: function(info){
        let start = info.event.start;
        let end = info.event.end;

        if(start){
          start.setMinutes(start.getMinutes() - start.getTimezoneOffset());
          start = start.toISOString().slice(0, 16)
        }
        if(end){
          end.setMinutes(end.getMinutes() - end.getTimezoneOffset());
          end = end.toISOString().slice(0, 16)
        }

        $('#agenda_id_up').val(info.event.id);
        $('#agenda-title').html(info.event.title);
        $('#agenda_titulo').val(info.event.title);
        $('#agenda_descripcion').val(info.event.extendedProps.descripcion);
        $('#agenda_start').val(start);
        $('#agenda_end').val(end);
        $('#agenda_sala').val(info.event.extendedProps.sala);
        $('#agenda_max').val(info.event.extendedProps.cantmax);
        $('#agenda_color').val(info.event.backgroundColor);
        $('#agenda_curso').val(info.event.extendedProps.idcur);

        $('#ModalAgenda').modal('show');
      },
      events: '<?php echo SERVERURL;?>controlador/admin/ApiController.php?op=teacher-diary',

    });

    calendar.setOption('locale','es');
    calendar.render();

    $('#btn-save').click(function(){
      save_agenda()
      calendar.refetchEvents()
    });

    $('#btn-delete').click(function(){
      delete_agenda()
      calendar.refetchEvents()
    });

    $('.fc-next-button').click(function(){
      $('.fc-prev-button').prop( "disabled", false );
      let date = document.getElementById("fc-dom-1");
      let datePart = date.innerHTML.split(' ');
      let yearNow = new Date().getFullYear();
      if(datePart[0] === 'diciembre' && parseInt(datePart[2]) === parseInt(yearNow)){
        $('.fc-next-button').prop( "disabled", true );
      }
    });

    $('.fc-prev-button').click(function(){
      $('.fc-next-button').prop( "disabled", false );
      let date = document.getElementById("fc-dom-1");
      let datePart = date.innerHTML.split(' ');
      let yearNow = new Date().getFullYear();
      if(datePart[0] === 'enero' && parseInt(datePart[2]) === parseInt(yearNow)){
        $('.fc-prev-button').prop( "disabled", true );
      }
    });

    //bloquear botton next y prev
    let date = document.getElementById("fc-dom-1");
    let datePart = date.innerHTML.split(' ');
    if(datePart[0] === 'enero'){
      $('.fc-prev-button').prop( "disabled", true );
    }
    if(datePart[0] === 'diciembre'){
      $('.fc-next-button').prop( "disabled", true );
    }

  });

  const select = document.getElementById("agenda_curso")

  //empty option
  const option = document.createElement("option")
  option.value = ""
  option.disabled = true
  option.selected = true
  option.innerHTML = "Seleccione una opción"
  select.appendChild(option)

  let url='<?php echo SERVERURL;?>controlador/admin/ApiController.php?op=course-diary';

  fetch(url,{
      method: 'GET',
  })
  .then(respuesta => respuesta.json())
  .then(respuesta => {
      if(respuesta.length===0){
        $('#calendar').hide();
        let calendar=document.querySelector('#error');
        calendar.innerHTML='<div class="alert alert-warning" role="alert">'+
                            '<p class="text-center mb-0">'+
                                '<i class="fas fa-exclamation-triangle fa-2x"></i><br>'+
                                'No tiene permisos de acceso'+
                            '</p></div>';

      }else{
        respuesta.forEach(obj => {
          const option = document.createElement("option")
          option.value = obj.COD_CUR
          option.innerHTML = obj.nombre
          select.appendChild(option)
        })
        
      } 
  });

</script>

<?php include_once "./vista/contenido/docente/inc/agenda.php"?>
