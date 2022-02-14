<script>
    /** buscar area */
    function  buscar_area(input_docente){
        $('#ModalArea').modal('show');
        input_docente=input_docente.trim();

        let datos = new FormData();
        datos.append("docente_id_buscar", input_docente);

        fetch("<?php echo SERVERURL?>ajax/admin/docenteAjax.php",{
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.text())
        .then(respuesta => {
            let tabla_area=document.querySelector('#tabla_areas');
            tabla_area.innerHTML=respuesta;
        });
    }

    /**Agregar area */
    function agregar_area(id_area){
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
                datos.append("id_agregar_area", id_area);

                fetch("<?php echo SERVERURL?>ajax/admin/docenteAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    let id_area=document.querySelector('#docente_id_area').value;
                    id_area=id_area.trim();
                    if(id_area!=respuesta.ID && respuesta.Alerta!="simple"){
                        $('#docente_name_area').val(respuesta.Nombre);
                        $('#docente_id_area').val(respuesta.ID);          
                    }else if(respuesta.Alerta){
                        return alertas_ajax(respuesta);
                    }else{
                        Swal.fire({
                            title: 'Advertencia',
                            text: 'El área ya se encuentra seleccionado, por favor seleccione otro',
                            type: 'warning',
                            confirmButtonText:'Aceptar'
                        });
                        $('#ModalArea').modal('show');
                    }
                });
            }else{
                $('#ModalArea').modal('show');
            }
        });
    }

    /** Ver datos completo */
    function verDatos(){
        fila.find('input').each(function() {
            id_docente = this.value;
        });
        id_docente=id_docente.trim();

        let datos = new FormData();
        datos.append("id_docente_verDatos", id_docente);


        fetch("<?php echo SERVERURL?>ajax/admin/docenteAjax.php",{
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            if(respuesta.Alerta){
                    return alertas_ajax(respuesta);
            }else{
                $("#docente_ci").val(respuesta.CI_P);
                $("#docente_nombre").val(respuesta.NOMBRE_P+' '+respuesta.APELLIDOP_P+' '+respuesta.APELLIDOM_P);
                $("#docente_fecha_nac").val(respuesta.FECHANAC_P);
                $("#docente_sexo").val(respuesta.SEXO_P);
                $("#docente_fechIng").val(respuesta.FECHA_INGRESO_P);
                $("#docente_email").val(respuesta.CORREO_P);
                $("#docente_direccion").val(respuesta.DIRECCION_P);
                $("#docente_telefono").val(respuesta.TELEFONO_P);
                $("#docente_educativo").val(respuesta.NOMBRE_UA);
                $("#docente_area").val(respuesta.NOMBRE_AREA);             
                $('#ModalInfo').modal('show');      
            } 
        });
    }

    /** buscar educativo */
    function  buscar_educativo(){
        let input_educativo=document.querySelector('#input_educativo').value;
        input_educativo=input_educativo.trim();

        if(input_educativo!=""){
            let datos = new FormData();
            datos.append("buscar_educativo", input_educativo);

            fetch("<?php echo SERVERURL?>ajax/admin/docenteAjax.php",{
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
    function agregar_educativo(id_educativo){
        $('#ModalEducativo').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar este establecimieto?",
        text: 'Se asignará este establecimieto para el docente',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_educativo", id_educativo);

                fetch("<?php echo SERVERURL?>ajax/admin/docenteAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    let id_educativo=document.querySelector('#docente_id_educativo').value;
                    id_educativo=id_educativo.trim();
                    if(id_educativo!=respuesta.ID && respuesta.Alerta!="simple"){
                        $('#docente_name_educativo').val(respuesta.Nombre);
                        $('#docente_id_educativo').val(respuesta.ID);          
                    }else if(respuesta.Alerta){
                        return alertas_ajax(respuesta);
                    }else{
                        Swal.fire({
                            title: 'Advertencia',
                            text: 'El establecimiento ya se encuentra seleccionado, por favor seleccione otro',
                            type: 'warning',
                            confirmButtonText:'Aceptar'
                        });
                        $('#ModalEducativo').modal('show');
                    }
                });
            }else{
                $('#ModalEducativo').modal('show');
            }
        });
    }

</script>