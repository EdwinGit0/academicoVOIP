<script>
    /** buscar alumno */
    function  buscar_alumno(){
        let input_alumno=document.querySelector('#input_alumno').value;
        let id_alumno=document.querySelector('#alumno_id').value;

        input_alumno=input_alumno.trim();
        id_alumno=id_alumno.trim();

        if(input_alumno!=""){
            let datos = new FormData();
            datos.append("buscar_alumno", input_alumno);
            datos.append("buscar_alumno_up", id_alumno);

            fetch("<?php echo SERVERURL?>ajax/padreAjax.php",{
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

    /**Agreggar alumno */
    function agregar_alumno(id,id_alumno){
        $('#ModalAlumno').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar el alumno?",
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
                datos.append("id_agregar_alumno", id);
                datos.append("id_agregar_alumno_up", id_alumno);

                fetch("<?php echo SERVERURL?>ajax/padreAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
            }else{
                $('#ModalAlumno').modal('show');
            }
        });
    }

</script>