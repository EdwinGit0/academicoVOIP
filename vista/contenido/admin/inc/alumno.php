<script>
    /** buscar padre */
    function buscar_padre(){
        let input_padre=document.querySelector('#input_padre').value;
        input_padre=input_padre.trim();

        if(input_padre!=""){
            let datos = new FormData();
            datos.append("buscar_padre", input_padre);

            fetch("<?php echo SERVERURL?>ajax/admin/alumnoAjax.php",{
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
    function agregar_padre(id_docente){
        $('#ModalPadre').modal('hide');

        Swal.fire({
        title: "¿Quieres agregar este tutor?",
        text: 'Se asignará el tutor para el alumno',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let datos = new FormData();
                datos.append("id_agregar_padre", id_docente);

                fetch("<?php echo SERVERURL?>ajax/admin/alumnoAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
<<<<<<< HEAD:vista/contenido/admin/inc/alumno.php
                    var tutor_repetido=false;
                    $('#docente_tutor_reg').find('input[type=hidden]').each(function() {
                        if(this.value==respuesta.ID){
                            tutor_repetido=true;
                        }
                    });

                    if(tutor_repetido==false && respuesta.Alerta!="simple"){
                        fila.find('input[type=text]').each(function() {
                            this.value = respuesta.Nombre+' '+respuesta.ApellidoP+' '+respuesta.ApellidoM;
                        });
                        fila.find('input[type=hidden]').each(function() {
                            this.value = respuesta.ID;
                        });
                    }else if(respuesta.Alerta){
                        return alertas_ajax(respuesta);
                    }else{
                        Swal.fire({
                            title: 'Advertencia',
                            text: 'El tutor ya se encuentra seleccionado, por favor seleccione otro',
                            type: 'warning',
                            confirmButtonText:'Aceptar'
                        });
                        $('#ModalPadre').modal('show');
                    }
=======
                    var valor = document.getElementById(fila);
	                valor.value = respuesta.Nombre+' '+respuesta.ApellidoP+' '+respuesta.ApellidoM;
                    valor.username = respuesta.ID;
>>>>>>> origin:vista/inc/alumno.php
                });
            }else{
                $('#ModalPadre').modal('show');
            }
        });
    }

    /** Agreggar padre actualizar */
    function llenar_datos_tutor(id){
        let datos = new FormData();
        datos.append("buscar_todos_tutores", id);
        fetch("<?php echo SERVERURL?>ajax/admin/alumnoAjax.php",{
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
       
            for (var i = 0; i < respuesta.length-1; i++) {
                add();
            }
            if(respuesta.length>0){
                var position = 0;
                $('#docente_tutor_reg').find('input[type=text]').each(function() {
                    this.value = respuesta[position].NOMBRE_FA+' '+respuesta[position].APELLIDOP_FA+' '+respuesta[position].APELLIDOM_FA;
                    position++;
                });

                position = 0;
                $('#docente_tutor_reg').find('input[type=hidden]').each(function() {
                    encriptar_id(respuesta[position].FAMILAR_ID).then(value => this.value = value);
                    position++;
                });
            }
        });
    }

    /** Encriptar id */
    function encriptar_id(id){

        let id_tutor = new FormData();
        id_tutor.append("id_tutor", id);
        return fetch("<?php echo SERVERURL?>ajax/admin/alumnoAjax.php",{
            method: 'POST',
            body: id_tutor
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
             return respuesta.ID; 
        }); 
        
    }

    /** Ver datos completo */
    function verDatos(){
        fila.find('input').each(function() {
            id_alumno = this.value;
           
        });
        id_alumno=id_alumno.trim();

        let datos = new FormData();
        datos.append("id_alumno_verDatos", id_alumno);


        fetch("<?php echo SERVERURL?>ajax/admin/alumnoAjax.php",{
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            if(respuesta.Alerta){
                return alertas_ajax(respuesta);
            }else{
                $("#alumno_ci").val(respuesta.CI_A);
                $("#alumno_rude").val(respuesta.RUDE_A);
                $("#alumno_nombre").val(respuesta.NOMBRE_A+' '+respuesta.APELLIDOP_A+' '+respuesta.APELLIDOM_A);
                $("#alumno_fecha_nac").val(respuesta.FECHANAC_A);
                $("#alumno_sexo").val(respuesta.SEXO_A);
                $("#alumno_lugarNac").val(respuesta.LUGARNAC_A);
                $("#alumno_email").val(respuesta.CORREO_A);
                $("#alumno_direccion").val(respuesta.DIRECCION_A);
                $("#alumno_telefono").val(respuesta.TELEFONO_A);
                $("#alumno_educativo").val(respuesta.NOMBRE_UA);

                $('#docente_tutor_reg').find('.itemDate').each(function() {
                    this.remove();
                });
                $('#docente_tutor_reg').find('input').each(function() {
                    this.value='';
                });

                encriptar_id(respuesta.ALUMNO_ID).then(value => llenar_datos_tutor_verDatos(value));
                $('#ModalInfo').modal('show');      
            } 
        });
    }

    /** Agreggar padre ver Datos */
    function llenar_datos_tutor_verDatos(id){
        let datos = new FormData();
        datos.append("buscar_todos_tutores", id);
        fetch("<?php echo SERVERURL?>ajax/admin/alumnoAjax.php",{
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
       
            if(respuesta.length>0){
                for (var i = 0; i < respuesta.length-1; i++) {
                    add_alumno();
                }
                var position = 0;
                $('#docente_tutor_reg').find('input[type=text]').each(function() {
                    this.value = respuesta[position].NOMBRE_FA+' '+respuesta[position].APELLIDOP_FA+' '+respuesta[position].APELLIDOM_FA;
                    position++;
                });
            }
        });
    }

    /** buscar educativo */
    function buscar_educativo(){
        let input_educativo=document.querySelector('#input_educativo').value;
        input_educativo=input_educativo.trim();

        if(input_educativo!=""){
            let datos = new FormData();
            datos.append("buscar_educativo", input_educativo);

            fetch("<?php echo SERVERURL?>ajax/admin/alumnoAjax.php",{
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
        text: 'Se asignará este establecimieto para el alumno',
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

                fetch("<?php echo SERVERURL?>ajax/admin/alumnoAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    let id_educativo=document.querySelector('#alumno_id_educativo').value;
                    id_educativo=id_educativo.trim();
                    if(id_educativo!=respuesta.ID && respuesta.Alerta!="simple"){
                        $('#alumno_name_educativo').val(respuesta.Nombre);
                        $('#alumno_id_educativo').val(respuesta.ID);          
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

    // Borrar contenido de la fila tutor formulario alumno
    function vaciar_campo() {
        fila.find('input').each(function() {
            this.value = '';
        });
        $('#ModalPadre').modal('hide');
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