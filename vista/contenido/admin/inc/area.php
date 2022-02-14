<script>
    /** buscar docente 
    function  buscar_anio(){
        let input_anio=document.querySelector('#input_anio').value;
        let input_area=document.querySelector('#area_id').value;

        input_anio=input_anio.trim();
        input_area=input_area.trim();

        if(input_anio!=""){
            let datos = new FormData();
            datos.append("buscar_anio", input_anio);
            datos.append("buscar_area", input_area);

            fetch("<?php echo SERVERURL?>ajax/areaAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_anio=document.querySelector('#tabla_anios');
                tabla_anio.innerHTML=respuesta;
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

    /**Agreggar anio 
    function agregar_anio(id,id_area){
        $('#Modalanio').modal('hide');
        Swal.fire({
        title: "¿Quieres agregar este año académico?",
        text: 'Se va agregar este año académico a la sección',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_anio", id);
                datos.append("id_agregar_area", id_area);

                fetch("<?php echo SERVERURL?>ajax/areaAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
            }else{
                $('#Modalanio').modal('show');
            }
        });
    }
    
</script>