<script>
    /**--------------------------------- ALUMNO --------------------------------- */
    let alumno_id=document.querySelector('#alumno_id_curso').value;
    let url=document.querySelector('#alumno_url_cursop').value;

    function datosReferenciales() {
   
        alumno_id=alumno_id.trim();
        url=url.trim();

        fila.find('input[type=hidden]').each(function() {
            id_curso = this.value;
        });
        id_curso = id_curso.trim();
    
        if(id_curso!=""){
            let datos = new FormData();

            datos.append("alumno_id", alumno_id);
            datos.append("url", url);
            datos.append("curso_id_referencial", id_curso);

            fetch("<?php echo SERVERURL?>ajax/docente/cuadernoPAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_padre=document.querySelector('#body_referencial');
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
    
</script>