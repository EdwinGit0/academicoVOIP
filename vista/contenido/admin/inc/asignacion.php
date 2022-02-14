<script>
    /**--------------------------------- ALUMNO --------------------------------- */
    function asignacion(tipo) {
        if(tipo!=""){
            let alumno_id=document.querySelector('#alumno_id_curso').value;
            let url=document.querySelector('#alumno_url_cursop').value;
            let anio_academico=document.querySelector('#gestion_academico').value;
            alumno_id=alumno_id.trim();
            url=url.trim();
            anio_academico=anio_academico.trim();

            fila.find('input[type=hidden]').each(function() {
                id_curso = this.value;
            });
            id_curso = id_curso.trim();
        
            if(id_curso!=""){
                let datos = new FormData();
                if(tipo=="alumno"){
                    datos.append("asignar_alumno", id_curso);
                }else if(tipo=="docente"){
                    datos.append("asignar_docente", id_curso);
                }
                datos.append("alumno_id", alumno_id);
                datos.append("url", url);
                datos.append("anio_academico", anio_academico);

                fetch("<?php echo SERVERURL?>ajax/admin/asignacionAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.text())
                .then(respuesta => {
                    let tabla_padre=document.querySelector('#asignarCurso');
                    tabla_padre.innerHTML=respuesta;
                });
            }else{
                Swal.fire({
                    title: 'Ocurrio un error',
                    text: 'El curso que selecciono no existe',
                    type: 'error',
                    confirmButtonText:'Aceptar'
                });
            }
        }
    } 

    /** buscar alumno */
    function buscar_alumno(){
        let input_alumno=document.querySelector('#input_alumno').value;
        input_alumno=input_alumno.trim();

        if(input_alumno!=""){
            let datos = new FormData();
            datos.append("buscar_alumno", input_alumno);

            fetch("<?php echo SERVERURL?>ajax/admin/padreAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_alumno=document.querySelector('#tabla_alumnos');
                tabla_alumno.innerHTML=respuesta;
            });
        }else{
            Swal.fire({
                title: 'Ocurrio un error',
                text: 'Debes introducir el CI, Nombre, Apellido',
                type: 'error',
                confirmButtonText:'Aceptar'
            });
        }
    }

    /**Agregar alumno */
    function agregar_alumno(id_alumno){
        $('#ModalAlumno').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar el alumno?",
        text: 'Se asignará el alumno para el tutor',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                fila.find('input[type=hidden]').each(function() {
                    id_curso = this.value;
                });
                let alumno_fechaIni=document.querySelector('#alumno_fechaIni').value;
                let alumno_fechaFin=document.querySelector('#alumno_fechaFin').value;
                alumno_fechaIni=alumno_fechaIni.trim();
                alumno_fechaFin=alumno_fechaFin.trim();
                id_curso = id_curso.trim();

                let datos = new FormData();
                datos.append("id_agregar_alumno", id_alumno);
                datos.append("id_agregar_curso", id_curso);
                datos.append("alumno_fechaIni_as", alumno_fechaIni);
                datos.append("alumno_fechaFin_as", alumno_fechaFin);

                fetch("<?php echo SERVERURL?>ajax/admin/asignacionAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    if(respuesta.CI){
                        asignacion("alumno");
                    }else if(respuesta.Alerta){
                        $('#ModalAlumno').modal('show');
                        return alertas_ajax(respuesta);
                    }
                });
            }else{
                $('#ModalAlumno').modal('show');
            }
        });
    }

    /** buscar alumno */
    function eliminar_alumno_curso(id_alumno){

        Swal.fire({
        title: "¿Quieres eliminar el alumno?",
        text: 'Se eliminara el alumno del curso',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                fila.find('input[type=hidden]').each(function() {
                    id_curso = this.value;
                });
                id_curso = id_curso.trim();
                id_alumno = id_alumno.trim();
                
                let datos = new FormData();
                datos.append("id_eliminar_alumno", id_alumno);
                datos.append("id_eliminar_curso", id_curso);

                fetch("<?php echo SERVERURL?>ajax/admin/asignacionAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    asignacion("alumno");
                    return alertas_ajax(respuesta);
                });
            }
        });
    }

    /**--------------------------------- DOCENTE --------------------------------- */
    /** buscar docente */
    function buscar_docente(){
        let input_docente=document.querySelector('#input_docente').value;
        input_docente=input_docente.trim();

        if(input_docente!=""){
            let datos = new FormData();
            datos.append("buscar_docente", input_docente);

            fetch("<?php echo SERVERURL?>ajax/admin/asignacionAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_docente=document.querySelector('#tabla_docentes');
                tabla_docente.innerHTML=respuesta;
            });
        }else{
            Swal.fire({
                title: 'Ocurrio un error',
                text: 'Debes introducir el CI, Nombre, Apellido, Área',
                type: 'error',
                confirmButtonText:'Aceptar'
            });
        }
    }

    /**Agregar docente */
    function agregar_docente(id_docente){
        $('#ModalDocente').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar el docente?",
        text: 'Se asignará el docente para el tutor',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                fila.find('input[type=hidden]').each(function() {
                    id_curso = this.value;
                });
                let docente_fechaIni=document.querySelector('#docente_fechaIni').value;
                let docente_fechaFin=document.querySelector('#docente_fechaFin').value;
                docente_fechaIni=docente_fechaIni.trim();
                docente_fechaFin=docente_fechaFin.trim();
                id_curso = id_curso.trim();

                var docente_responsable;
                if(document.querySelector('#docente_responsable').checked){
                    docente_responsable = 1;
                }
                
                let datos = new FormData();
                datos.append("id_agregar_docente", id_docente);
                datos.append("id_agregar_curso", id_curso);
                datos.append("docente_fechaIni_as", docente_fechaIni);
                datos.append("docente_fechaFin_as", docente_fechaFin);
                datos.append("docente_responsable_as", docente_responsable);

                fetch("<?php echo SERVERURL?>ajax/admin/asignacionAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    if(respuesta.CI){
                        asignacion("docente");
                    }else if(respuesta.Alerta){
                        $('#ModalDocente').modal('show');
                        return alertas_ajax(respuesta);
                    }
                });
            }else{
                $('#ModalDocente').modal('show');
            }
        });
    }

    /** buscar docente */
    function eliminar_docente_curso(id_docente){

        Swal.fire({
        title: "¿Quieres eliminar el docente?",
        text: 'Se eliminara el docente del curso',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                fila.find('input[type=hidden]').each(function() {
                    id_curso = this.value;
                });
                id_curso = id_curso.trim();
                id_docente = id_docente.trim();
                
                let datos = new FormData();
                datos.append("id_eliminar_docente", id_docente);
                datos.append("id_eliminar_curso", id_curso);

                fetch("<?php echo SERVERURL?>ajax/admin/asignacionAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    asignacion("docente");
                    return alertas_ajax(respuesta);
                });
            }
        });
    }
</script>