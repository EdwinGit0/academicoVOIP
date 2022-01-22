<script>
    /** buscar area */
    function  buscar_area(){
        let input_area=document.querySelector('#input_area').value;
        let input_docente=document.querySelector('#area_id').value;

        input_area=input_area.trim();
        input_docente=input_docente.trim();

        if(input_area!=""){
            let datos = new FormData();
            datos.append("buscar_area", input_area);
            datos.append("buscar_docente", input_docente);

            fetch("<?php echo SERVERURL?>ajax/docenteAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_area=document.querySelector('#tabla_areas');
                tabla_area.innerHTML=respuesta;
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

    /** buscar seccion */
    function  buscar_seccion(){
        let input_seccion=document.querySelector('#input_seccion').value;
        let input_docente=document.querySelector('#seccion_id').value;

        input_seccion=input_seccion.trim();
        input_docente=input_docente.trim();

        if(input_seccion!=""){
            let datos = new FormData();
            datos.append("buscar_seccion", input_seccion);
            datos.append("buscar_docente", input_docente);

            fetch("<?php echo SERVERURL?>ajax/docenteAjax.php",{
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

    /**Agreggar area */
    function agregar_area(id,id_docente){
        $('#ModalArea').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar este área?",
        text: 'Se va agregar este área para el docente',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_area", id);
                datos.append("id_agregar_docente", id_docente);

                fetch("<?php echo SERVERURL?>ajax/docenteAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
            }else{
                $('#ModalArea').modal('show');
            }
        });
    }

    /**Agreggar seccion */
    function agregar_seccion(id,id_docente){
        $('#ModalSeccion').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar esta sección?",
        text: 'Se va agregar esta sección para el docente',
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
                datos.append("id_agregar_docente", id_docente);

                fetch("<?php echo SERVERURL?>ajax/docenteAjax.php",{
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

</script>