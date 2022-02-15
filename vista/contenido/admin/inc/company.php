<script>
    /** buscar educativo */
    function  buscar_educativo(){
        let input_educativo=document.querySelector('#input_educativo').value;

        input_educativo=input_educativo.trim();

        if(input_educativo!=""){
            let datos = new FormData();
            datos.append("buscar_educativo", input_educativo);

            fetch("<?php echo SERVERURL?>ajax/admin/educativoAjax.php",{
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

    /**Agreggar educativo */
    function agregar_educativo(id){
        $('#ModalEducativo').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar este Establecimiento?",
        text: 'Usted se agregará a este Establecimiento',
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

                fetch("<?php echo SERVERURL?>ajax/admin/educativoAjax.php",{
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
</script>