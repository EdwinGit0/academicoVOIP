<script>

    /** buscar padre */
    function  buscar_padre(){
        let input_padre=document.querySelector('#input_padre').value;
        let input_alumno=document.querySelector('#padre_id').value;

        input_padre=input_padre.trim();
        input_alumno=input_alumno.trim();

        if(input_padre!=""){
            let datos = new FormData();
            datos.append("buscar_padre", input_padre);
            datos.append("buscar_alumno", input_alumno);

            fetch("<?php echo SERVERURL?>ajax/alumnoAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_padre=document.querySelector('#tabla_padres');
                tabla_padre.innerHTML=respuesta;
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

    /**Agreggar padre */
    function agregar_padre(fila,id,id_alumno){

        $('#ModalPadre').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar este tutor?",
        text: 'Se va agregar este tutor para el alumno',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_padre", id);
                datos.append("id_agregar_alumno", id_alumno);

                fetch("<?php echo SERVERURL?>ajax/alumnoAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    var valor = document.getElementById(fila);
	                valor.value = respuesta.Nombre+' '+respuesta.ApellidoP+' '+respuesta.ApellidoM;
                    valor.name = respuesta.ID;
                });
            }else{
                $('#ModalPadre').modal('show');
            }
        });
    }

    /** buscar educativo 
    function  buscar_educativo(){
        let input_educativo=document.querySelector('#input_educativo').value;
        let input_alumno=document.querySelector('#educativo_id').value;

        input_educativo=input_educativo.trim();
        input_alumno=input_alumno.trim();

        if(input_educativo!=""){
            let datos = new FormData();
            datos.append("buscar_educativo", input_educativo);
            datos.append("buscar_alumno", input_alumno);

            fetch("<?php echo SERVERURL?>ajax/alumnoAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_educativo=document.querySelector('#tabla_educativos');
                tabla_educativo.innerHTML=respuesta;
            });
        }else{
            Swal.fire({
                title: 'Ocurrio un error',
                text: 'Debes introducir el Código, Nombre',
                type: 'error',
                confirmButtonText:'Aceptar'
            });
        }
    }

    /** buscar grado 
    function  buscar_grado(){
        let input_grado=document.querySelector('#input_grado').value;
        let input_alumno=document.querySelector('#grado_id').value;

        input_grado=input_grado.trim();
        input_alumno=input_alumno.trim();

        if(input_grado!=""){
            let datos = new FormData();
            datos.append("buscar_grado", input_grado);
            datos.append("buscar_alumno", input_alumno);

            fetch("<?php echo SERVERURL?>ajax/alumnoAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_grado=document.querySelector('#tabla_grados');
                tabla_grado.innerHTML=respuesta;
            });
        }else{
            Swal.fire({
                title: 'Ocurrio un error',
                text: 'Debes introducir el Nombre, Creado',
                type: 'error',
                confirmButtonText:'Aceptar'
            });
        }
    }

    /** buscar seccion 
    function  buscar_seccion(){
        let input_seccion=document.querySelector('#input_seccion').value;
        let input_alumno=document.querySelector('#seccion_id').value;

        input_seccion=input_seccion.trim();
        input_alumno=input_alumno.trim();

        if(input_seccion!=""){
            let datos = new FormData();
            datos.append("buscar_seccion", input_seccion);
            datos.append("buscar_alumno", input_alumno);

            fetch("<?php echo SERVERURL?>ajax/alumnoAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_seccion=document.querySelector('#tabla_seccions');
                tabla_seccion.innerHTML=respuesta;
            });
        }else{
            Swal.fire({
                title: 'Ocurrio un error',
                text: 'Debes introducir el Nombre, Creado',
                type: 'error',
                confirmButtonText:'Aceptar'
            });
        }
    }

    /**Agreggar educativo 
    function agregar_educativo(id,id_alumno){
        $('#ModalEducativo').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar este establecimieto?",
        text: 'Se va agregar este establecimieto para el alumno',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_educativo", id);
                datos.append("id_agregar_alumno", id_alumno);

                fetch("<?php echo SERVERURL?>ajax/alumnoAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
            }else{
                $('#ModalEducativo').modal('show');
            }
        });
    }

    /**Agreggar grado 
    function agregar_grado(id,id_alumno){
        $('#ModalGrado').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar este grado?",
        text: 'Se va agregar este grado para el alumno',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_grado", id);
                datos.append("id_agregar_alumno", id_alumno);

                fetch("<?php echo SERVERURL?>ajax/alumnoAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
            }else{
                $('#ModalGrado').modal('show');
            }
        });
    }

    /**Agreggar seccion 
    function agregar_seccion(id,id_alumno){
        $('#ModalSeccion').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar esta sección?",
        text: 'Se va agregar esta sección para el alumno',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_seccion", id);
                datos.append("id_agregar_alumno", id_alumno);

                fetch("<?php echo SERVERURL?>ajax/alumnoAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
            }else{
                $('#ModalSeccion').modal('show');
            }
        });
    }
    */
</script>