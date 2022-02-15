<script>
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
                let datos = new FormData();
                datos.append("id_agregar_alumno", id_alumno);

                fetch("<?php echo SERVERURL?>ajax/admin/padreAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    var alumno_repetido=false;
                    $('#alumno_reg').find('input[type=hidden]').each(function() {
                        if(this.value==respuesta.ID){
                            alumno_repetido=true;
                        }
                    });

                    if(alumno_repetido==false && respuesta.Alerta!="simple"){
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
                            text: 'El alumno ya se encuentra seleccionado, por favor seleccione otro',
                            type: 'warning',
                            confirmButtonText:'Aceptar'
                        });
                        $('#ModalAlumno').modal('show');
                    }
                });
            }else{
                $('#ModalAlumno').modal('show');
            }
        });
    }

    /** Agregar alumnos actualizar */
    function llenar_datos_alumno(id){
        let datos = new FormData();
        datos.append("buscar_todos_alumnos", id);
        fetch("<?php echo SERVERURL?>ajax/admin/padreAjax.php",{
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
                $('#alumno_reg').find('input[type=text]').each(function() {
                    this.value = respuesta[position].NOMBRE_A+' '+respuesta[position].APELLIDOP_A+' '+respuesta[position].APELLIDOM_A;
                    position++;
                });

                position = 0;
                $('#alumno_reg').find('input[type=hidden]').each(function() {
                    encriptar_id(respuesta[position].ALUMNO_ID).then(value => this.value = value);
                    position++;
                });
            }
        });
    }

    /** Encriptar id */
    function encriptar_id(id){
        let id_alumno = new FormData();
        id_alumno.append("id_alumno", id);
        return fetch("<?php echo SERVERURL?>ajax/admin/padreAjax.php",{
            method: 'POST',
            body: id_alumno
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
             return respuesta.ID; 
        }); 
        
    }

    /** Ver datos completo */
    function verDatos(){
        fila.find('input').each(function() {
            id_padre = this.value;
           
        });
        id_padre=id_padre.trim();

        let datos = new FormData();
        datos.append("id_padre_verDatos", id_padre);


        fetch("<?php echo SERVERURL?>ajax/admin/padreAjax.php",{
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            if(respuesta.Alerta){
                return alertas_ajax(respuesta);
            }else{
                $("#padre_ci").val(respuesta.CI_FA);
                $("#padre_nombre").val(respuesta.NOMBRE_FA+' '+respuesta.APELLIDOP_FA+' '+respuesta.APELLIDOM_FA);
                $("#padre_fecha_nac").val(respuesta.FECHANAC_FA);
                $("#padre_sexo").val(respuesta.SEXO_FA);
                $("#padre_rol").val(respuesta.ROL_FA);
                $("#padre_email").val(respuesta.CORREO_FA);
                $("#padre_telefono").val(respuesta.TELEFONO_FA);

                $('#alumno_reg').find('.itemDate').each(function() {
                    this.remove();
                });
                $('#alumno_reg').find('input').each(function() {
                    this.value='';
                });

                encriptar_id(respuesta.FAMILAR_ID).then(value => llenar_datos_alumno_verDatos(value));
                $('#ModalInfo').modal('show');      
            } 
        });
    }

    /** Agreggar alumno ver Datos */
    function llenar_datos_alumno_verDatos(id){
        let datos = new FormData();
        datos.append("buscar_todos_alumnos", id);
        fetch("<?php echo SERVERURL?>ajax/admin/padreAjax.php",{
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
                $('#alumno_reg').find('input[type=text]').each(function() {
                    this.value = respuesta[position].NOMBRE_A+' '+respuesta[position].APELLIDOP_A+' '+respuesta[position].APELLIDOM_A;
                    position++;
                });
            }
        });
    }

    // Borrar contenido de la fila tutor formulario tutro
    function vaciar_campo() {
        fila.find('input').each(function() {
            this.value = '';
        });
        $('#ModalAlumno').modal('hide');
    }
</script>