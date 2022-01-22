<script>
    /** buscar docente */
    function  buscar_docente(){
        let input_docente=document.querySelector('#input_docente').value;

        input_docente=input_docente.trim();

        if(input_docente!=""){
            let datos = new FormData();
            datos.append("buscar_docente", input_docente);

            fetch("<?php echo SERVERURL?>ajax/seccionAjax.php",{
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
                text: 'Debes introducir el CI, Nombre, Apellido, Telefono',
                type: 'error',
                confirmButtonText:'Aceptar'
            });
        }
    }

    /**Agreggar docente */
    function agregar_docente(id){
        $('#ModalDocente').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar este docente?",
        text: 'Se va agregar este docente a la sección',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_docente", id);

                fetch("<?php echo SERVERURL?>ajax/seccionAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
            }else{
                $('#ModalDocente').modal('show');
            }
        });
    }

    /** buscar alumno */
    function  buscar_alumno(){
        let input_alumno=document.querySelector('#input_alumno').value;

        input_alumno=input_alumno.trim();

        if(input_alumno!=""){
            let datos = new FormData();
            datos.append("buscar_alumno", input_alumno);

            fetch("<?php echo SERVERURL?>ajax/seccionAjax.php",{
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
                text: 'Debes introducir el CI, Nombre, Apellido, Telefono',
                type: 'error',
                confirmButtonText:'Aceptar'
            });
        }
    }

    /** modales alumno */
    function agregar_alumno(id){
        $('#ModalAlumno').modal('hide');

        $('#ModalSeccion').modal('show');
        document.querySelector('#id_agregar_seccion').setAttribute("value",id);
        
    }

    function modal_buscar_alumno(){
        $('#ModalSeccion').modal('hide');
        $('#ModalAlumno').modal('show');
    }
</script>