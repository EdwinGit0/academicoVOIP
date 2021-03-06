<script>
    /* GUARDAR AGENDA*/
    function save_agenda(){
        if(agenda_validata()){
            let url='<?php echo SERVERURL; ?>ajax/docente/agendaAjax.php';
            let title=document.querySelector('#agenda_titulo').value;
            let description=document.querySelector('#agenda_descripcion').value;
            let course=document.querySelector('#agenda_curso').value;
            let start=document.querySelector('#agenda_start').value;
            let end=document.querySelector('#agenda_end').value;
            let color=document.querySelector('#agenda_color').value;
            let max=document.querySelector('#agenda_max').value;
            let sala=document.querySelector('#agenda_sala').value;
            let agenda_id=document.querySelector('#agenda_id_up').value;
            title=title.trim();
            description=description.trim();
            course=course.trim();
            start=start.trim();
            end=end.trim();
            color=color.trim();
            max=max.trim();
            agenda_id=agenda_id.trim();

            let datos = new FormData();
            datos.append("agenda_titulo_reg",title);
            datos.append("agenda_descripcion_reg",description);
            datos.append("agenda_curso_reg",course);
            datos.append("agenda_start_reg",start);
            datos.append("agenda_end_reg",end);
            datos.append("agenda_color_reg",color);
            datos.append("agenda_max_reg",max);
            datos.append("agenda_sala_reg",sala);
            if(agenda_id)
                datos.append("agenda_id_reg",agenda_id);

            fetch(url,{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                if(respuesta.Tipo==="validation"){
                    getIDInput(respuesta.Input).focus();
                    getIDInput(respuesta.InputError).innerHTML = 'Solo puede registrar agendas dentro de la gestion actual, "Verifique la sección GESTION ACADEMICA"';
                }else{
                    swal({
                        title: respuesta.Titulo,
                        text: respuesta.Texto,
                        icon: respuesta.Tipo,
                        button: "Aceptar",
                    });
                    if(respuesta.Tipo==="success") {
                        $('#ModalAgenda').modal('hide');
                    }
                }
            });
        }
    }

    /* ELIMINAR AGENDA*/
    function delete_agenda(){
        let url='<?php echo SERVERURL; ?>ajax/docente/agendaAjax.php';
        let agenda_id=document.querySelector('#agenda_id_up').value;
        agenda_id=agenda_id.trim();

        let datos = new FormData();
        datos.append("agenda_id_del",agenda_id);
        fetch(url,{
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            swal({
                    title: respuesta.Titulo,
                    text: respuesta.Texto,
                    icon: respuesta.Tipo,
                    button: "Aceptar",
            });
            if(respuesta.Tipo==="success") {
                $('#ModalAgenda').modal('hide');
            }
        });
    }

    /* VALIDATION INPUTS AGENDA*/
    function agenda_validata() {
        let title = getIDInput('agenda_titulo');
        let course = getIDInput('agenda_curso');
        let start = getIDInput('agenda_start');
        let end = getIDInput('agenda_end');
        let color = getIDInput('agenda_color');
        let max = getIDInput('agenda_max');

        let message_title= ''
        let message_course = ''
        let message_start = ''
        let message_end = ''
        let message_color = ''
        let message_max = ''

        let focus_title= false
        let focus_course = false
        let focus_start = false
        let focus_end = false
        let focus_color = false
        let focus_max = false

        let enviar = true;

        if(title.value === null || title.value === ''){
            message_title = 'Este campo es requerido'
            focus_title=true;
            enviar = false;
        }
        if(!title.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)) {
            message_title = 'El TITULO no coincide con el formato solicitado'
            focus_title=true;
            enviar = false; 
        }
        if(title.value.length < 3 || title.value.length > 255) {
            message_title = 'El TITULO debe ser mayor a 7 y menor a 255 caracteres'
            focus_title=true;
            enviar = false; 
        }
        
        if(course.value === null || course.value === ''){
            message_course = 'Este campo es requerido'
            focus_course = true;
            enviar = false;
        }

        if(start.value === null || start.value === ''){
            message_start = 'Este campo es requerido'
            focus_start = true;
            enviar = false;
        }

        if(!checkDate(start.value, end.value)){
            message_end = 'La FECHA FIN debe ser mayor a la FECHA INICIO'
            focus_end = true;
            enviar = false;
        }

        if(color.value === null || color.value === ''){
            message_color = 'Este campo es requerido'
            focus_color = true;
            enviar = false;
        }

        if(max.value === null || max.value === ''){
            message_max = 'Este campo es requerido'
            focus_max= true;
            enviar = false;
        }

        if(focus_title) title.focus();
        else if(focus_course) course.focus();
        else if(focus_start) start.focus();
        else if(focus_end) end.focus();
        else if(focus_color) color.focus();
        else if(focus_max) max.focus();

        getIDInput("agenda_titulo_error").innerHTML = message_title;  
        getIDInput("agenda_curso_error").innerHTML = message_course;
        getIDInput("agenda_start_error").innerHTML = message_start;  
        getIDInput("agenda_end_error").innerHTML = message_end;
        getIDInput("agenda_color_error").innerHTML = message_color;  
        getIDInput("agenda_max_error").innerHTML = message_max;
        
        return enviar;
    }

    function checkDate(start, end){
        var mStart = moment(start);
        var mEnd = moment(end);
        return mStart.isBefore(mEnd);
    }

</script>